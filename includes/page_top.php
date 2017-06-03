<?php
	require_once(dirname(__FILE__).'/application.php');
	$query = $_GET['query'] ?? Router::HOME;
	$page = Router::getPage($query);
	$javascripts = array(
		'jquery-3.2.1.min.js',
		'semantic.min.js'
	);
?>
<html>
<head>

<!-- Standard Meta -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<!-- Site Properities -->
<title><?php echo isset($_page['title']) ? $_page['title'].' | ' : ''  ?>FirstAide, Peacecorps</title>
<?php echo isset($_page['description']) ? '<meta name="description" content="'.$_page['description'].'" />' : '' ?>
<?php echo isset($_page['keywords']) ? '<meta name="keywords" content="'.$_page['keywords'].'" />' : '' ?>

<link rel="stylesheet" type="text/css" class="ui" href="stylesheets/semantic.min.css">
<link rel="stylesheet" type="text/css" href="stylesheets/custom.css">
</head>
<body class="firstaide">
