<?php
    $APPLICATION_DIR = $APPLICATION_DIR ?? str_replace('includes', '', dirname(__FILE__));
    require_once $APPLICATION_DIR.'/vendor/autoload.php';
    spl_autoload_register(
        function ($class_name) {
            global $APPLICATION_DIR;
            $filename = $APPLICATION_DIR . '/modules/' . str_replace('\\', '/', $class_name) . '.php';
            if (file_exists($filename)) {
                require_once($filename);
            }
        }
    );

    require_once $APPLICATION_DIR.'/includes/settings.php';
    require_once $APPLICATION_DIR.'/includes/db_connection.php';


    $requested_protocol = ((!empty($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS'] != 'off') ||
        $_SERVER['SERVER_PORT'] == 443
    ) ? "https://" : "http://";

    $requested_url = $requested_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    // Start a session if it doesn't exist
    if (!isset($_SESSION)) {
        session_start();
    }

    // Session vaidity set to an hour
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['last_activity'] = time();

    // Create CSRF token if it doesn't exist
    if (!isset($_SESSION['csrf_token'])) {
        $csrf_token = md5(uniqid(rand(), true));
        $_SESSION['csrf_token'] = $csrf_token;
    } else {
        $csrf_token = $_SESSION['csrf_token'];
    }

    $redirect = '';

    $UserObj = new FirstAide\User($DB, '', 0);
    // Validate session token, if exists
    if (!empty($_SESSION['session_token'])) {
        $UserAuth = FirstAide\Authentication::createInstanceWithSessionToken($DB, $_SESSION['session_token']);
        if (empty($UserAuth)) {
            $redirect = HOST;
        } else {
            $UserObj = new FirstAide\User($DB, '', $UserAuth->getUserId());
            $user_email = $UserObj->getEmailAddress();
            if ($requested_url == HOST) {
                $redirect = FirstAide\Router::LOGIN_SUCCESS_URL;
            }
        }
    } else {
        $redirect = HOST;
    }

    // Redirect to correct URL, if already not there
    if (!empty($redirect)
        && $requested_url != $redirect
        && strpos($requested_url, HOST.'request') === false
    ) {
        header("Location: ".$redirect);
        die();
    }

    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
