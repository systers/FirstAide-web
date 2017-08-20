<?php
    require_once $APPLICATION_DIR.'/includes/application.php';
    $page_request = $_GET['page_request'] ?? \FirstAide\Router::INDEX;
    $query = $_GET['query'] ?? '';
    $page = FirstAide\Router::getPage($UserObj, $page_request, $query);
    
    $page['javascripts'][] = 'error.js';

if ($page['type'] == FirstAide\Router::INDEX) {
    $page['javascripts'][] = 'validation.js';
    $page['javascripts'][] = 'index.js';
}
?>
<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

        <!-- Site Properities -->
        <title><?php echo (isset($page['title']) ? $page['title'].' | ' : '');  ?>FirstAide, Peacecorps</title>
        <?php
        echo isset($page['description']) ?
            '<meta name="description" content="'.$page['description'].'" />' :
            '' ?>
        <?php
        echo isset($page['keywords']) ?
        '<meta name="keywords" content="'.$page['keywords'].'"
        />' : '' ?>

        <link rel="stylesheet" type="text/css" class="ui" href="stylesheets/min/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/min/custom.min.css">
    </head>
    <body class="firstaide <?php echo $page['type']?>">
