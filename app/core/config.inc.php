<?php
if(!defined('INCLUDED')) exit('This file cannot be opened directly');

// The active template of your site
$config['site_template'] = 'default.tpl.php';

// The title of your site
$config['site_title'] = 'My App Name';

// Pretty urls will be in the format /index.php/pretty/url
// If you have a .htaccess which rewrites everything paste /index.php/ to
// the site root, disable this
$config['fake_pretty_urls'] = true;

// This is your timezone, it's used by PHP in all time related calculations
// just leave this to the timezone you want the server to be in
$config['timezone'] = 'America/Los_Angeles';

// The duration of PHP's $_SESSION variable
$config['session_duration'] = 60 * 60 * 24 * 7; // One week

// This is the absolute path to your app, if it's in the root path, just use '/'
$config['base_path']  = '/php-boilerplate/';

// This is useful for development, it shows errors and ignores caching
$config['debug_mode'] = true;
