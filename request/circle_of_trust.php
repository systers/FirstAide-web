<?php
    require_once dirname(__FILE__).'/../includes/application.php';

    $output = array(
        'response' => false,
        'message' => ''
    );
    if (!empty($UserObj)) {
        if (isset($_POST) && isset($_POST['type'])) {
            switch ($_POST['type']) {
                case 'update_circle_data':
                    if (!empty($_POST['comrades_data']) && is_array($_POST['comrades_data'])) {
                        $output = $UserObj->updateCircleOfTrust($_POST['comrades_data']);
                    } else {
                        $output['message'] = "Please add atleast one comrade's detail.";
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
