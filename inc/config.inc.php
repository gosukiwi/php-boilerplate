<?php
if(!defined('INCLUDED')) exit('This file cannot be opened directly');

// The active template of your site
$config['site_template'] = 'default.tpl.php';

// The title of your site
$config['site_title'] = 'My App Name';

// Your email address, in case of some site errores, this email will be shown
// so users can contact you
$config['contact_mail'] = 'admin@my-website.com';

// Pretty urls will be in the format /index.php/pretty/url
// If you have a .htaccess which rewrites everything paste /index.php/ to
// the site root, disable this
$config['fake_pretty_urls'] = true;

// This is your timezone, it's not really used so leaving this by default will
// do just fine, if you really want to update it, any of these values is valid:
// <http://www.php.net/manual/en/timezones.php>
$config['timezone'] = 'America/Los_Angeles';

// This is the duration of your session when you log-in, it's specified
// in seconds.
$config['session_duration'] = 60 * 60 * 24 * 7; // One week

// This is the absolute path to your app, if it's in the root path, just use '/'
$config['base_path']  = '/php-boilerplate/';

// This is useful for development, it shows errors and ignores caching
$config['debug_mode'] = true;