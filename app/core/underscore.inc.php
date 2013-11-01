<?php
if(!defined('INCLUDED')) exit('This file cannot be opened directly');

// Collection of random utility functions of the "framework"
// All functions start with underscore

// Gets a custom argument by index, used with the router
function _get($idx) {
    return @$_GET['custom_arguments'][$idx];
}

// Truncates a string to the given length, it stops when a word finishes
// Eg: _truncate('A very long word', 4) -> 'A very'
function _truncate($str, $limit) {
    if(strlen($str) < $limit)
        return $str;
    $uid = uniqid();
    return array_shift(explode($uid, wordwrap($str, $limit, $uid)));
}

// Just a regular expression to check if an email is valid
function _is_valid_email($email) {
    return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email);
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function _gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}