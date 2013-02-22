<?php
// Enable output buffering
ob_start(); 

// Enable sessions
session_start();

// Just in case
set_include_path('.');

// Include files
define('INCLUDED', true);

// Include configuration file
include 'inc/config.inc.php';

$cache_file = 'cache/' . sha1($_SERVER['REQUEST_URI']);
// If we are on release, hide everything and use cache
if(!$config['debug_mode']) {
  error_reporting(0);

  if(file_exists($cache_file)) {
      $data = unserialize(file_get_contents($cache_file));
      if(time() > $data['expires']) {
          unlink($cache_file);
      } else {
          exit($data['html']);
      }
  }
} else {
  error_reporting(E_ALL ^ E_NOTICE);
}

date_default_timezone_set($config['timezone']);
session_set_cookie_params($config['session_duration']);

include 'inc/routes.inc.php';
include 'inc/underscore.inc.php';
include 'inc/html_helper.inc.php';
$html = new HtmlHelper();
include 'inc/template.inc.php';

// Include preferred template file
include 'inc/templates/' . $config['site_template'];

// Once the page has finished, check for cache generation
if($expires = route_is_cached()) {
    $data = array(
        'expires' => time() + $expires,
        'html' => ob_get_contents()
    );
    file_put_contents($cache_file, serialize($data));
}
