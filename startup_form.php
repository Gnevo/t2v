<?php
//require_once ('class/php_Session.php');
require_once('class/setup.php');
$smarty = new smartySetup(array('gdschema.xml','month.xml')); 
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('company_id', $_SESSION['company_id']);
//Setting layout and page
$smarty->display('extends:layouts/dashboard.tpl|startup_form.tpl');
?>