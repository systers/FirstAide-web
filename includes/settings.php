
<?php
/*
 * Date       : 9-03-2017
 * Created by : Fatima Rafiqui
 *
 * Note       : Please do not commit your credentials
 */

define("HOST", "http://localhost/");

$_settings = array();

$_settings['reCaptcha'] = array();
$_settings['reCaptcha']['client_key'] = getenv('client_key') ?? '';
$_settings['reCaptcha']['server_key'] = getenv('server_key') ?? '';

$_settings['twilio'] = array();
$_settings['twilio']['account_sid'] = getenv('account_sid') ?? '';
$_settings['twilio']['auth_token'] = getenv('auth_token') ?? '';
$_settings['twilio']['number'] = getenv('number') ?? '';

$_settings['db'] = array();
$_settings['db']['hostname']= getenv('db_hostname') ?? '';
$_settings['db']['database']= getenv('db_name') ?? '';
$_settings['db']['username']= getenv('db_username') ?? '';
$_settings['db']['password']= getenv('db_password') ?? '';
