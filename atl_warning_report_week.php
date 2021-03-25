<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
$employee = new equipment();
$employee_cls = new employee();

$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "employee.xml","user.xml","reports.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>6));
$query_string = explode("&", $_SERVER['QUERY_STRING']);
$month = $query_string[0];
$year = $query_string[1];
$empl = $query_string[2];
$cust = $query_string[3];
$contract_id = $query_string[4];
$employee_detail = $employee_cls->get_employee_detail($empl);

$contract_timing = $employee->get_employee_contract_timing($month,$year,$empl);
$contract_time = explode("/",$contract_timing );

$atl_warnings_week = $employee->get_all_atl_warning_weekly($month,$year,$empl,$cust);
//echo "<pre>". print_r($atl_warnings_week, 1)."</pre>";
$smarty->assign('warning_reports',$atl_warnings_week);
$smarty->assign('monthly',$contract_time[0]);
$smarty->assign('weekly',$contract_time[1]);
$smarty->assign('employee',$employee_detail);
$smarty->assign('month',$month);
$smarty->assign('year',$year);

$smarty->display('extends:layouts/dashboard.tpl|atl_warning_report_week.tpl');
?>