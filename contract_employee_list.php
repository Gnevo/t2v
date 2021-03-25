<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml"));
require_once('class/employee.php');
require_once('plugins/message.class.php');
require_once('plugins/pagination.class.php');
$contract = new employee();
$pagination = new pagination();
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>2));
//echo $_SERVER['QUERY_STRING'];
$employee_username = explode('&', $_SERVER['QUERY_STRING']);
//print_r($employee_username);
$smarty->assign('employee_username',$employee_username[0]);
$datas=$contract->contract_employee($employee_username[0]);
$paginated_contracts= $pagination->generate($datas, 15);
$smarty->assign('listing', $paginated_contracts);
$smarty->assign('role',$_SESSION['user_role']);
$smarty->assign('pagination', $pagination->links($smarty->url . 'contract/employee/list/'.$employee_username[0].'/'));
$smarty->assign('datas',$datas);
$smarty->display('extends:layouts/dashboard.tpl|contract_employee_list.tpl');

?>