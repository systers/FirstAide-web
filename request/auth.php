<?php
    require_once(dirname(__FILE__).'/../includes/application.php');

    $output = array(
        'response' => false,
        'message' => '',
        'redirect_url' => ''
    );

    if (isset($_POST)) {
        if (isset($_POST['csrf_token']) && $_POST['csrf_token'] == $csrf_token) {
            if (isset($_POST['type'])) {
                switch ($_POST['type']) {
                    case 'login':
                        if (!empty($_POST['email']) && !empty($_POST['password'])) {
                            if (Utils::isValidEmail($_POST['email'])) {
                                $Auth = new Authentication($_POST['email'], $_POST['password']);
                                if ($Auth->isValid()) {
                                    $output['response'] = true;
                                    $output['message'] = 'Logged In. Redirecting...';
                                    $output['redirect_url'] = Router::LOGIN_SUCCESS_URL;
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

                    case 'signup':
                        if (!empty($_POST['email']) &&
                            !empty($_POST['name']) &&
                            !empty($_POST['password']) &&
                            !empty($_POST['confirm_password']) &&
                            !empty($_POST['country']) &&
                            $_POST['password'] == $_POST['confirm_password']
                        ) {
                            if (Utils::isValidEmail($_POST['email'])) {
                                $User = new User($_POST['email']);
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
    
    Utils::jsonify($output);
