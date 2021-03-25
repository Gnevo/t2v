<?php
require_once('class/setup.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$customer = new customer();

 //header("location:".$smarty->url."list/employee/");
if (isset($_REQUEST['docs']) && $_REQUEST['docs'] != "") {
    $tdocs = explode(",", $_REQUEST['docs']);
    $tdocs1 = $customer->attachment_array($tdocs);
    $smarty->assign('customer_documents', $tdocs1);
    $smarty->assign('download_folder',$customer->get_folder_name($_SESSION['company_id'])."/document_decision");
}
else{
    $smarty->assign('hello','hello');
}


$smarty->display('ajax_customer_attatchments_insurence.tpl');
?>