<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$CustomerList = $customer->customer_list(NULL);
$smarty->assign('customerlist',$CustomerList);


/*0-Root, 
1-Admin, 
2-TL, 
3-Employee, 
4-Customer,
5-Trainee, 
6-Econamy, 
7-SuperTL*/
$user = new user();
$login_user = $_SESSION['user_id'];
$privileges = $user->get_privileges($login_user, 5);
$login_user_role = $user->user_role($login_user);
//if($login_user_role == 0 || $login_user_role == 1 || $login_user_role == 2 || $login_user_role == 6 || $login_user_role == 7 )
if($privileges['customer_leave'] == 1)
{
	$errormessage = 0;
}
else
{
	$errormessage = 1;
}
$smarty->assign('errormessage',$errormessage);

$smarty->assign('employees',$employees);
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
$smarty->assign('leave_types', $smarty->leave_type);

$smarty->display('extends:layouts/dashboard.tpl|customer_leave_report.tpl');
?>