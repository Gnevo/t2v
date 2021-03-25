<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/user.php');
//$obj_user = new user();
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$equipment = new equipment();
$customer = new customer();
$employee = new employee();
$user = new user();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$login_user = $_SESSION['user_id'];
$privileges = $user->get_privileges($login_user, 5);
$login_user_role = $user->user_role($login_user);
$errormessage = $privileges['employee_data'] == 1 ? 0 : 1;
$smarty->assign('errormessage',$errormessage);

$employees = $employee->employee_list();
$smarty->assign('employees',$employees);

$years_work = $employee->distinct_years();
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
$smarty->display('extends:layouts/dashboard.tpl|employee_data_report.tpl');
?>