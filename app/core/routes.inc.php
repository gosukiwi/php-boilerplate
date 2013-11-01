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
