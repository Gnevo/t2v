<?php
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$smarty->display('extends:layouts/ajax_popup.tpl|ajax_gdschema_time_duration_edit.tpl');
?>