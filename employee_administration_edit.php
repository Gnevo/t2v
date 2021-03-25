<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
$smarty->display('extends:layouts/dashboard.tpl|employee_administration_edit.tpl');
?>
