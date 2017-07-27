<?php
    require_once(dirname(__FILE__).'/../includes/application.php');

    $output = array(
        'response' => false,
        'message' => 'Something went wrong'
    );
    if (!empty($UserObj)) {
        if (isset($_POST) && isset($_POST['type'])) {
            switch ($_POST['type']) {
                case 'send_sms_circle_of_trust':
                    $types = array(
                        'come_get_me',
                        'need_interruption',
                        'need_to_talk'
                    );
                    if (!empty($_POST['msg_type']) &&
                        in_array($_POST['msg_type'], $types)
                    ) {
                        $msg_type = $_POST['msg_type'];
                        $message = '';
                        switch ($msg_type) {
                            case $types[0]:
                                $message = "Come and get me.I need help getting home safely.
                                Call ASAP to get my Location.
                                via FirstAide web app";
                                break;
                            
                            case $types[1]:
                                $message = "Call and pretend you need me.
                                I need an interruption.
                                via FirstAide web app";
                                break;
                            
                            case $types[2]:
                                $message = "I need to talk.
                                via FirstAide web app";
                                break;
                            
                            default:
                                break;
                        }
                        $numbers = $UserObj->getCircleOfTrustNumbers();
                        if (!empty($message) && !empty($numbers)) {
                            $n = new FirstAide\Notification();
                            $output = $n->sendMultipleSms($numbers, $message);
                        } else {
                            $output['message'] = 'Something went wrong';
                        }
                    } else {
                        $output['message'] = "Invalid Request";
                    }
                    break;
                
                default:
                    break;
            }
        }
    } else {
        $output['message'] = 'Invalid Credentials. Please login before updating details.';
    }

    FirstAide\Utils::jsonify($output);
