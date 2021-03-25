<?php
require_once('class/setup.php');
require_once('class/employee.php');
$employee = new employee();
$smarty = new smartySetup(array("button.xml","messages.xml","user.xml","privilege.xml","company.xml"));

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$previlages = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('previlages',$previlages);

$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$company_id = intval(trim($_SESSION['company_id']));
$smarty->assign('company_id', $_SESSION['company_id']); 
$smarty->assign('user_id', $_SESSION['user_id']); 


$smarty->display('extends:layouts/dashboard.tpl|administration.tpl');
?>