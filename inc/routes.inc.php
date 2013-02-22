<?php
if(!defined('INCLUDED')) exit('This file cannot be opened directly');

// ROOT route :)
$route['ROOT'] = 'pages/home.php';

// You can match simple routes
// $route['admin/albums'] = 'pages/admin/albums/index.php';
// That will match http://site.com/index.php/admin/albums and include 
// pages/admin/albums/index.php in the template's content placeholder

// You can use Regular Expressions
// $route['albums-by/(.*)'] = 'pages/albums-by.php';
// That will match "/albums-by/ANYTHING HERE", you can get the grouped 
// parameters using "_get" function, in this case _get(0) will get the first 
// group
//
// Here is a more complex regex
// $route['view-album/(.*?)(/page/(\d+))?'] = 'pages/view-album.php';
// That will match an optional /page/number part

// For caching you specify the route you want to cache, and the duration 
// in seconds, examples:
// $cache_route['ROOT'] =  60 * 60 * 24 * 7; // 1 week
// $cache_route['view-album/(.*?)(/page/(\d+))?'] =  60 * 60 * 2; // 2 hours

// Demo route
$route['hello/(.*)'] = 'pages/hello.php';


// Do not update past this line unless you know what you are doing!
// ROUTER FUNCTIONS

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
        require_once $route['ROOT'];
        return true;
    }

    if(substr($url, -1) == '/') {
        $url = substr($url, 0, -1);
    }

    // Check for simple route match
    if(array_key_exists($url, $route)) {
        $matched_route = $url;
        require_once $route[$url];
        return true;
    }

    // Check for regex
    foreach($route as $r => $page) {
        $matches = array();

        if(preg_match('#' . $r . '$#', $url, $matches)) {
            array_shift($matches);
            $_GET['custom_arguments'] = $matches;

            $matched_route = $r;
            require_once __DIR__ . '/../' . $page;
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