<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml","month.xml","reports.xml"));
require_once('class/employee.php');
require_once('configs/config.inc.php');

//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$employee = new employee();

$test = explode('&', $_SERVER['QUERY_STRING']);
if($test[0]=='print')
{
    $custlist=$employee->employee_report($test[1], $test[3], $test[2]);
    $report_header=$smarty->translate['employee_monthly_report'];
    $report_sub_header=$smarty->translate['employee'];
    $total_cap=$smarty->translate['total'];
    $c_heading_list=array($smarty->translate['date'],$smarty->translate['work'],$smarty->translate['customer'],$smarty->translate['normal'],$smarty->translate['travel'],$smarty->translate['break'],$smarty->translate['total_hour']);
    $employee->employee_pdf_report($custlist,$test[4],$test[5],$test[3],$report_header,$report_sub_header,$c_heading_list,$total_cap);
}
else
{
$employee_combo=$employee->employee_list_exact();
$smarty->assign('E_combo', $employee_combo);

$years_combo=$employee->distinct_years();
$smarty->assign("year_option_values", $years_combo);

global $month;
$month_num=array();
$month_name=array();

foreach ($month as $m_id)
{
    $month_num[]=$m_id['id'];
    $month_name[]=$smarty->translate[$m_id['month']];
}

$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);

$emp=(isset($_POST["cmb_employee"])?$_POST["cmb_employee"]:"");
$yr=(isset($_POST["cmb_year"])?$_POST["cmb_year"]:"");
$month=(isset($_POST["cmb_month"])? $_POST["cmb_month"] : "");

$smarty->assign('employee_name', $emp);
$smarty->assign('report_month', $month);
$smarty->assign('report_year', $yr);

//$custlist=$employee->employee_report($emp, $yr, $month);
$custlist=$employee->employee_montly_work_details($emp, $month, $yr);
//print_r($emplist);
$smarty->assign('employee_report_entries', $custlist);
$smarty->display('extends:layouts/dashboard.tpl|employee_monthly_report.tpl');


}
?>