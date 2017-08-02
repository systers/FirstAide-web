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
                    $types = array_keys(FirstAide\Notification::$messages);
                    if (!empty($_POST['msg_type']) &&
                        in_array($_POST['msg_type'], $types)
                    ) {
                        $messages = FirstAide\Notification::$messages;
                        $message = $messages[$_POST['msg_type']];
                        $numbers = $UserObj->getCircleOfTrustNumbers();
                        $n = new FirstAide\Notification();
                        $output = $n->sendMultipleSms($numbers, $message);
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
