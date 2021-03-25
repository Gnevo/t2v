<?php
require_once('class/setup.php');
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$smarty->display("ajax_privilege_forms.tpl");
?>