<?php
require_once('class/setup.php');
$smarty = new smartySetup(array(), FALSE);
require_once('class/employee.php');
$employee = new employee();
$smarty->assign('available_works', $employee->get_available_works()); 
$smarty->display('ajax_get_available_works.tpl');
?>