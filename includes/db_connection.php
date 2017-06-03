<?php
	// mysqli connection
	//require_once('includes/settings.php');
	$connection = mysqli_connect(
		$_settings['db']['hostname'],
		$_settings['db']['username'],
		$_settings['db']['password'],
		$_settings['db']['database']
	) or die("Connection failed");
?>