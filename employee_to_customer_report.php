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
//if($login_user_role == 0 || $login_user_role == 1 || $login_user_role == 6 || $login_user_role == 7 )
if($privileges['customer_employee_connection'] == 1)
{
	$errormessage = 0;
}
else
{
	$errormessage = 1;
}
$smarty->assign('errormessage',$errormessage);


/*$name = 'tina';
$employees = $employee->getemployee($name);*/

$employees = $employee->employee_list();
$smarty->assign('employees',$employees);

$years_work = $employee->distinct_years();
$currentyear = date('Y');

$smarty->assign("currentyear", $currentyear);
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);

if(isset($_POST['add'])){
    $emp = $_POST['employee'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $month = intval($month);
    $smarty->assign('month',$month);
    $smarty->assign('report_year',$year);
    $smarty->assign('emp',$emp);
    $timetable = $equipment->employee_timetable_month($emp,$month,$year);
    //print_r($timetable);
    $sums = $equipment->employee_week_time_sum($timetable);
    $smarty->assign('reports',$timetable);
    $smarty->assign('sums',$sums);
}
$smarty->display('extends:layouts/dashboard.tpl|employee_to_customer_report.tpl');
?>
