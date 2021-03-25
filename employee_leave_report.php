<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
//require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$employee = new employee();
$equipment = new equipment();
//$customer = new customer();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$EmployeeList = $employee->employee_list(NULL);
$smarty->assign('employeeslist',$EmployeeList);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
//$smarty->assign('employees',$employees);
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
$smarty->assign('leave_types', $smarty->leave_type);
if(isset($_POST['add'])){
    $emp = $_POST['employee'];
    $year = $_POST['year'];
    $month = intval($_POST['month']);
    $smarty->assign('month',$month);
    $smarty->assign('report_year',$year);
    $smarty->assign('emp',$emp);
    $timetable = $equipment->employee_timetable_month($emp,$month,$year);
    //print_r($timetable);
    $sums = $equipment->employee_week_time_sum($timetable);
    $smarty->assign('reports',$timetable);
    $smarty->assign('sums',$sums);
}
$smarty->display('extends:layouts/dashboard.tpl|employee_leave_report.tpl');
?>