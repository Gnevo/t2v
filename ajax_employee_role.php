<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/customer.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$employee = new employee();
$customer = new customer();
$emp = $_SESSION['user_id'];
$customers = $customer->customer_of_employee($emp);
$smarty->assign('customers',$customers);
$smarty->display('ajax_employee_role.tpl');
?>