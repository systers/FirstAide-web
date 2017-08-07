<?php
    require_once $APPLICATION_DIR.'/includes/application.php';
    $page_request = $_GET['page_request'] ?? \FirstAide\Router::INDEX;
    $query = $_GET['query'] ?? '';
    $page = FirstAide\Router::getPage($UserObj, $page_request, $query);

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
        <title><?php echo isset($_page['title']) ? $_page['title'].' | ' : ''  ?>FirstAide, Peacecorps</title>
        <?php
        echo isset($_page['description']) ?
            '<meta name="description" content="'.$_page['description'].'" />' :
            '' ?>
        <?php
        echo isset($_page['keywords']) ?
        '<meta name="keywords" content="'.$_page['keywords'].'"
        />' : '' ?>

        <link rel="stylesheet" type="text/css" class="ui" href="stylesheets/min/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/min/custom.min.css">
    </head>
    <body class="firstaide <?php echo $page['type']?>">
