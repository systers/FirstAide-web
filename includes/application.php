<?php
	$APPLICATION_DIR = str_replace("includes","", dirname(__FILE__));

	spl_autoload_register(function ($class_name) {
		global $APPLICATION_DIR;
	    include $APPLICATION_DIR.'/modules/'.$class_name . '.php';
	});
	
	require_once($APPLICATION_DIR.'/includes/settings.php');
	require_once($APPLICATION_DIR.'/includes/db_connection.php');
	require_once($APPLICATION_DIR.'/vendor/autoload.php');
?>