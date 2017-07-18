<?php
    $APPLICATION_DIR = dirname(__FILE__);
    require_once($APPLICATION_DIR.'/includes/page_top.php');
    require_once($APPLICATION_DIR.'/includes/menu.php');
    echo FirstAide\Utils::getTwig($page['template'], array('page' => $page));
    
    require_once($APPLICATION_DIR.'/includes/page_bottom.php');
