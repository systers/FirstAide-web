<?php
    $APPLICATION_DIR = $APPLICATION_DIR ?? str_replace('includes', '', dirname(__FILE__));
    spl_autoload_register(function ($class_name) {
        global $APPLICATION_DIR;
        include $APPLICATION_DIR.'/modules/'.$class_name . '.php';
    });

    require_once($APPLICATION_DIR.'/includes/settings.php');
    require_once($APPLICATION_DIR.'/includes/db_connection.php');
    require_once($APPLICATION_DIR.'/vendor/autoload.php');

    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['token'])) {
        $csrf_token = md5(uniqid(rand(), true));
        $_SESSION['token'] = $csrf_token;
        $_SESSION['token_time'] = time();
    } else {
        $csrf_token = $_SESSION['token'];
    }

    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
