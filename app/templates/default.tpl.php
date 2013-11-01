<?php if(!defined('INCLUDED')) exit('This file cannot be opened directly'); ?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $config['site_title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php echo $html->css('css/bootstrap.min.css'); ?>
    <?php echo $html->css('css/bootstrap-theme.min.css'); ?>
    <?php echo $html->css('css/app.css'); ?>
  </head>
  <body>

    <!-- This is the content placeholder, pages will be included here -->
    <?php echo template_content(); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <?php echo $html->js('js/bootstrap.min.js'); ?>
    <?php echo $html->js('js/app.js'); ?>
  </body>
</html>
