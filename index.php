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
include 'app/config.inc.php';

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

include 'app/routes.inc.php';
include 'app/core/underscore.inc.php';
include 'app/core/html_helper.inc.php';
$html = new HtmlHelper();
include 'app/core/template.inc.php';

// Router functions

$matched_route = NULL;
// route_exists function, used to match urls
function route_match() {
    global $route;
    global $html;
    global $config;
    global $matched_route;

    $url = explode('index.php', $_SERVER['REQUEST_URI']);
    $url = @str_replace('.', '', substr($url[1], 1));
    if(strpos($url, '?') !== false) {
        $url = explode('?', $url);
        $url = $url[0];
    }

    if(!$url) {
        $matched_route = 'ROOT';
        require_once __DIR__ . '/app/' . $route['ROOT'];
        return true;
    }

    if(substr($url, -1) == '/') {
        $url = substr($url, 0, -1);
    }

    // Check for simple route match
    if(array_key_exists($url, $route)) {
        $matched_route = $url;
        require_once __DIR__ . '/app/' . $route[$url];
        return true;
    }

    // Check for regex
    foreach($route as $r => $page) {
        $matches = array();

        if(preg_match('#' . $r . '$#', $url, $matches)) {
            array_shift($matches);
            $_GET['custom_arguments'] = $matches;

            $matched_route = $r;
            require_once __DIR__ . '/app/' . $page;
            return true;
        }
    }

    return false;
}

function route_is_cached() {
    global $cache_route;
    global $matched_route;
    return $matched_route ? @$cache_route[$matched_route] : NULL;
}

// Include preferred template file
include 'app/templates/' . $config['site_template'];

// Once the page has finished, check for cache generation
if($expires = route_is_cached()) {
    $data = array(
        'expires' => time() + $expires,
        'html' => ob_get_contents()
    );
    file_put_contents($cache_file, serialize($data));
}
