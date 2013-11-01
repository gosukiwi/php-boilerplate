# PHP Boilerplate

PHP Boilerplate is a minimal PHP project to help you get started easy and fast.
It's __not__ an MVC framework, it's __not__ a full featured set of libraries, it
gives you the basics, and let's you develop small apps easy and with very little
learning curve.

# Usage

PHP Boilerplate's core is based on routes, routes read the url and include a
file, that file is called a __page__, it's just a regular PHP file which will
be included in a template file, and it has access to some global variables.

## Routes

The first thing you need to do is add some routes, routes matches the current
URL with a PHP file, that's all.

Routes live in ```/app/routes.inc.php```, the file it's documented so you can 
easily add new routes and map them to files.

The file the route maps to is included in the content placeholder of the 
current selected template, the default template lives in 
```/app/templates/default.tpl.php```, you can see it's just a simple PHP which
uses some global variables to display a bootstrap page.

### Caching Routes

Routes can be cached, this means the file will be excecuted only once, then the
output of the file will be saved, and next time the route is called, instead of
excecuting the file, it will just display static HTML loaded from a cache file.

## Templates

As stated before, templates are simple files which wrapper the files you include
using routes, you can do pretty much anything you want in a template file.

## Globals

* __$html__: An instance of a HTML helper, it creates links, lists, gives you
    a relative path, and some nice utilities, check it out at 
    ```/inc/html_helper.inc.php```

* __$config__: The configuration array of ```/inc/config.inc.php```

* **_get**: A function to get a custom route argument, see the documentation
    at ```/inc/routes.inc.php``` for more information

## Vendor

All third party libraries should go in ```/app/vendor```, custom libraries 
should go in ```/app/libs/myLib.php``` or ```/app/libs/mylib/``` if it contains
several files.

## Pagination

PHP Boilerplate includes a pagination class which generates Bootstrap compatible
html for pagination, basically just an html list of links.
