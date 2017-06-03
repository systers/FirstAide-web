<?php
    require_once(dirname(__FILE__).'/includes/page_top.php');
	require_once($APPLICATION_DIR.'/includes/menu.php');

    echo Utils::getTwig($page['template'], array('page' => $page));

    require_once(dirname(__FILE__).'/includes/page_bottom.php');
?>
