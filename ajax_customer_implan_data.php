<?php
require( 'class/setup.php');
require_once ('class/customer_ai.php');
//$smarty = new smartySetup("ajax");
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$page = new customer_ai();

$id = $_REQUEST['id'];
$smarty->assign('customer_data', $page->getCustomerData($id));
$smarty->display('customer_implan_edit.tpl');
?>