<?php
require_once('class/setup.php');
require_once('class/customer.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$customer = new customer();

if (isset($_REQUEST['docs']) && $_REQUEST['docs'] != "") {
    $tdocs = explode(",", $_REQUEST['docs']);
}
$tdocs = $customer->attachment_array($tdocs);
$smarty->assign('customer_documents', $tdocs);

$smarty->display('extends:layouts/ajax_popup.tpl|ajax_customer_attachments.tpl');
?>