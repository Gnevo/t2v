<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml","month.xml","reports.xml"));
require_once('class/employee.php');
require_once('configs/config.inc.php');
require_once('plugins/pagination.class.php');
$pagination = new pagination();

//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$employee = new employee();

$test = explode('&', $_SERVER['QUERY_STRING']);
/*if($test[0]=='print')
{
    $custlist=$employee->employee_report($test[1], $test[3], $test[2]);
    $report_header=$smarty->translate['employee_monthly_report'];
    $report_sub_header=$smarty->translate['employee'];
    $total_cap=$smarty->translate['total'];
    $c_heading_list=array($smarty->translate['date'],$smarty->translate['work'],$smarty->translate['customer'],$smarty->translate['normal'],$smarty->translate['travel'],$smarty->translate['break'],$smarty->translate['total_hour']);
    $employee->employee_pdf_report($custlist,$test[4],$test[5],$test[3],$report_header,$report_sub_header,$c_heading_list,$total_cap);
}
else
{*/
$employee_combo=$employee->distinct_employee();
$smarty->assign('E_combo', $employee_combo);

$years_combo=$employee->distinct_log_years();
$smarty->assign("year_option_values", $years_combo);


/* for month values  */
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

$emp='';
$yr='';
$months='';
/* end month values  */
if(isset($_POST['submit']))
{
    $emp=(isset($_POST["cmb_employee"])?$_POST["cmb_employee"]:"");
    $yr=(isset($_POST["cmb_year"])?$_POST["cmb_year"]:"");
    $months=(isset($_POST["cmb_month"])? $_POST["cmb_month"] : "");
}
else
{
   $emp =  $test[0] ;
   $yr = $test[1] ;
   $months =  $test[2] ;
}


$smarty->assign('employee_name', $emp);
$smarty->assign('report_month', $months);
$smarty->assign('report_year', $yr);


$dumb_datas=$employee->employee_log_report($emp, $yr, $months);
//$loglist = $pagination->generate($employee->employee_log_report($emp, $yr, $months), 10);
//$loglist = $pagination->generate($dumb_data, 10);
$loglist = $pagination->generate($employee->employee_log_edited($dumb_datas), 10);
$smarty->assign('pagination', $pagination->links($smarty->url . 'login/log/report/'.$emp.'/'.$yr.'/'.$months.'/'));
                //echo $pagination->links($smarty->url . 'rpt_log_login.php');
                
$smarty->assign('employee_log_entries', $loglist);

$smarty->display('extends:layouts/dashboard.tpl|rpt_log_login.tpl');


//}
?>
