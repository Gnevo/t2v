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

$download_folder = $customer->get_folder_name($_SESSION['company_id'])."/document_decision";
if($_REQUEST['type'] == 'customer_attachment') {
    $download_folder = $customer->get_folder_name($_SESSION['company_id']).'/customer_attachments';
}
$smarty->assign('download_folder', $download_folder);

$smarty->display('extends:layouts/ajax_popup.tpl|ajax_customer_attachments.tpl');
?>