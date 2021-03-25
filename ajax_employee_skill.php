<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
require_once('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/customer.php');
$employee = new employee();
$customer = new customer();
$emp = $_SESSION['user_id'];
$skills = $employee->employee_skills($emp);
$smarty->assign('skills',$skills);
$smarty->assign('emp',$emp);
$smarty->display('ajax_employee_skill.tpl');
?>