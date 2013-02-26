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