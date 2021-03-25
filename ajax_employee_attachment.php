<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
require_once('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/customer.php');
$employee = new employee();
$customer = new customer();
$emp = $_SESSION['user_id'];
$move = $_GET['move'];
$smarty->assign('move',$move);
$documents = $employee->employee_documents($emp);
$smarty->assign('documents',$documents);
$smarty->assign('employee',$emp);
$smarty->assign('download_folder',$customer->get_folder_name($_SESSION['company_id'])."/documents_attach");
$smarty->display('ajax_employee_attachment.tpl');
?>