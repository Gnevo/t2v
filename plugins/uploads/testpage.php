<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("employee.xml","messages.xml"));
require_once('class/employee.php');
require_once('plugins/pagination.class.php');
$employee = new employee();
$pagination = new pagination();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$employee_list = $employee->employee_list();
$smarty->assign('employee_list',$employee_list);
$myArray = $pagination->generate($employee_list, 5);
$smarty->assign('listing', $myArray);
$smarty->assign('pagination', $pagination->links());
$smarty->display('extends:layouts/dashboard.tpl|employee_list.tpl');

?>
