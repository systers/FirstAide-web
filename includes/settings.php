<?php
/*
 * Date       : 9-03-2017
 * Created by : Fatima Rafiqui
 *
 * Note       : Please do not commit your credentials
 */
$APPLICATION_DIR = $APPLICATION_DIR ?? str_replace('includes', '', dirname(__FILE__));
require_once $APPLICATION_DIR.'/includes/constants.php';

$_settings = array();

$_settings['reCaptcha'] = array();
$_settings['reCaptcha']['client_key'] = !empty(getenv('client_key')) ? getenv('client_key') : '';
$_settings['reCaptcha']['server_key'] = !empty(getenv('server_key')) ? getenv('server_key') : '';

$_settings['twilio'] = array();
$_settings['twilio']['account_sid'] = !empty(getenv('account_sid'))
    ? getenv('account_sid')
    : '';
$_settings['twilio']['auth_token'] = !empty(getenv('auth_token'))
    ? getenv('auth_token')
    : '';
$_settings['twilio']['number'] = !empty(getenv('number'))
    ? getenv('number')
    : '';
// Added my test credentials for unit tests
$_settings['twilio']['test_account_sid'] = !empty(getenv('test_account_sid'))
    ? getenv('test_account_sid')
    : 'ACcb7233e2011c2341ab3d2a51bd06aad4';
$_settings['twilio']['test_auth_token'] = !empty(getenv('test_auth_token'))
    ? getenv('test_auth_token')
    : '847f234895dff25f287823d43cbe100b';
// +15005550006 is the test number provided in twilio documentation
$_settings['twilio']['test_number'] = !empty(getenv('test_number'))
    ? getenv('test_number')
    : '+15005550006';

$_settings['db'] = array();
$_settings['db']['hostname']= !empty(getenv('db_hostname')) ? getenv('db_hostname') : 'localhost';
$_settings['db']['database']= !empty(getenv('db_name')) ? getenv('db_name') : 'firstaide';
$_settings['db']['username']= !empty(getenv('db_username')) ? getenv('db_username') : 'root';
$_settings['db']['password']= !empty(getenv('db_password')) ? getenv('db_password') : '';
