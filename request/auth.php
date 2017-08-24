<?php
    require_once dirname(__FILE__).'/../includes/application.php';
    // variable for storing the response
    $output = array(
        'response' => false,
        'message' => '',
        'redirect_url' => ''
    );

    // Checking if valid post request is made
    if (isset($_POST)) {
        if (isset($_POST['csrf_token']) && FirstAide\Authentication::isValidCsrf($csrf_token, $_POST['csrf_token'])) {
            if (isset($_POST['type'])) {
                switch ($_POST['type']) {
                    case 'login':
                        if (!empty($_POST['email']) && !empty($_POST['password'])) {
                            if (FirstAide\Utils::isValidEmail($_POST['email'])) {
                                $Auth = FirstAide\Authentication::createInstanceWithEmailPassword(
                                    $DB,
                                    $_POST['email'],
                                    $_POST['password']
                                );

                                if (!empty($Auth) && $Auth->isValid()) {
                                    $session_token = FirstAide\Authentication::createSession($DB, $Auth->getUserId());
                                    if ($session_token) {
                                        $_SESSION['session_token'] = $session_token;
                                        $output['response'] = true;
                                        $output['message'] = 'Logged In. Redirecting...';
                                        $output['redirect_url'] = FirstAide\Router::LOGIN_SUCCESS_URL;
                                    } else {
                                        $output['message'] = 'Unable to create session';
                                    }
                                } else {
                                    $output['message'] = 'Invalid credentials.
                                    It seems that you have not signed up on this platform.';
                                }
                            } else {
                                $output['message'] = 'Invalid email';
                            }
                        } else {
                            $output['message'] = 'Invalid credentials';
                        }
                        break;
                    case 'logout':
                        session_unset();
                        session_destroy();
                        break;

                    case 'signup':
                    case 'update':
                        if (!empty($_POST['email'])
                        && !empty($_POST['name'])
                        && !empty($_POST['password'])
                        && !empty($_POST['confirm_password'])
                        && !empty($_POST['country'])
                        && $_POST['password'] == $_POST['confirm_password']
                            ) {
                            if (FirstAide\Utils::isValidEmail($_POST['email'])) {
                                if ($_POST['type'] == 'signup') {
                                    $User = new FirstAide\User($DB, $_POST['email']);
                                    $newUserStatus = $User->addUser(
                                        array(
                                        'email' => $_POST['email'],
                                        'password' => $_POST['password'],
                                        'name' => $_POST['name'],
                                        'country' => $_POST['country']
                                        )
                                    );
                                    if ($newUserStatus) {
                                            $output['response'] = true;
                                            $output['message'] = 'Account created. Welcome aboard.';
                                            $output['redirect_url'] = HOST;
                                    } else {
                                            $output['message'] = 'Something went wrong.';
                                    }
                                } elseif ($_POST['type'] == 'update') {
                                    $output = $UserObj->updateUserInfo(
                                        array(
                                        'email' => $_POST['email'],
                                        'password' => $_POST['password'],
                                        'name' => $_POST['name'],
                                        'country' => $_POST['country']
                                        )
                                    );
                                }
                            } else {
                                $output['message'] = 'Invalid email';
                            }
                        } else {
                            $output['message'] = 'Incomplete data';
                        }
                        break;

                    default:
                        $output['message'] = 'Invalid request';
                        break;
                }
            } else {
                $output['message'] = 'Missing request type';
            }
        }
    } else {
        $output['message'] = 'Code sober or get pulled over. This is not one of the URLs you should visit.';
    }
    
    FirstAide\Utils::jsonify($output);
