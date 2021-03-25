<?php
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/setup.php');
$equipment = new equipment();
$customer = new customer();
$mail = new mail();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","mail.xml"),FALSE);
$exact_employees = $equipment->employee_mailable($_SESSION['user_id']);
$exact_employees_group = $equipment->employee_mailabe_group($_SESSION['user_id']);
//print_r($exact_employees_group);
$smarty->assign('employees',$exact_employees);
$smarty->assign('roles_user',$_SESSION['user_role']);
$smarty->assign('employees_group',$exact_employees_group);
$smarty->display('extends:layouts/ajax_popup.tpl|email_send_popup.tpl');
?>
