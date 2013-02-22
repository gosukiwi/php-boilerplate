<?php
if(!defined('INCLUDED')) exit('This file cannot be opened directly');

// Returns the content of a page, used for templating
function template_content() {
    if(!route_match())
        header('Location:404.html');
}
