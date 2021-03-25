<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
require_once ('plugins/date_calc.class.php');

$date = new datecalc();
		
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new newcustomer();
$employee = new newemployee();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$user = new user();
$login_user = $_SESSION['user_id'];
$privileges = $user->get_privileges($login_user, 5);
$login_user_role = $user->user_role($login_user);
//if($login_user_role == 0 || $login_user_role == 1 || $login_user_role == 2 || $login_user_role == 6 || $login_user_role == 7 )
if($privileges['customer_horizontal'] == 1)
{
	$errormessage = 0;
}
else
{
	$errormessage = 1;
}
$CurrentYear = date('Y');
$smarty->assign('CurrentYear',$CurrentYear);
$smarty->assign('errormessage',$errormessage);

$CustomerList = $customer->customer_list(NULL);
$smarty->assign('customerlist',$CustomerList);

$smarty->assign('employees',$employees);
$years_work = $employee->distinct_years('all_year');	
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
$smarty->display('extends:layouts/dashboard.tpl|horizontal_customer_report.tpl');
?>
