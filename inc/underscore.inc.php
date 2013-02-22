<?php
if(!defined('INCLUDED')) exit('This file cannot be opened directly');

// Collection of random utility functions of the "framework"
// All functions start with underscore

// Gets a custom argument by index, used with the router
function _get($idx) {
    return @$_GET['custom_arguments'][$idx];
}