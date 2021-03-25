<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/material.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"),FALSE);
$smarty->display('material_add.tpl');
?>
