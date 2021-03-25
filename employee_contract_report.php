<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/team.php');
//require_once('plugins/pagination.class.php');
//require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "reports.xml","month.xml"));
$employee = new employee();
$team = new team();
//$equipment = new equipment();
//$pagination = new pagination();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$years_combo = $employee->distinct_years('all_year');
$smarty->assign("year_option_values", $years_combo);
global $month;
$month_name = array();
foreach ($month as $m_id) {
    $month_name[] = $smarty->translate[$m_id['label']];
}
$params = explode("&", $_SERVER['QUERY_STRING']);
$selected_year = $params[0];
$smarty->assign("month_option_output", $month_name);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$smarty->assign('list_year',$params[0]);
$employees = $team->list_employee_full('',$params[2],'act',$params[1],1);
//echo "<pre>".print_r($employees, 1)."</pre>";
$emp_count = $team->list_employee_count('',$params[2],'act');
if($emp_count['count'] % 10 == 0){
    $page = $emp_count['count'] / 10;
}else{
    $page = intval(($emp_count['count'] / 10) + 1);
}
$smarty->assign('count',$page);
$smarty->assign('page',$params[1]);
$smarty->assign('alph',$params[2]);
//echo "<pre>". print_r($employees, 1)."</pre>";
//$contract_reports = $employee->get_all_contract_report($selected_year ,$employees);
$employees_count = count($employees);
for($i=0 ; $i<$employees_count ; $i++){
    for($iter_month= 01; $iter_month<=12 ; $iter_month++){
        $this_Ym = $selected_year.'|'.$iter_month;

        $employees[$i]['work_hours']['normal'][$iter_month] = round($employee->employee_total_work_hours($employees[$i]['username'], 'year_month', $this_Ym, 0), 2);
        $employees[$i]['work_hours']['oncall'][$iter_month] = round($employee->employee_total_work_hours($employees[$i]['username'], 'year_month', $this_Ym, 3), 2);

//                $max_contract_hours_for_a_week = $this->employee_contract_week_hour($employees[$i]['username'], $paste_year_week, TRUE);
//                
//                $this_month_start_date = date('Y-m-01', $cur_date);
//                $this_month_end_date = date('Y-m-t', $cur_date);
//                $month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
//                $cur_employee['contract_hours']['monthly_nomal'] = round(($cur_employee_contracts[0]['hour'] / 5 * $month_working_days), 2);

        $employees[$i]['contract_hours']['normal'][$iter_month] = round($employee->employee_contract_monthly_normal_hour($employees[$i]['username'], $this_Ym, TRUE), 2);
        $employees[$i]['contract_hours']['oncall'][$iter_month] = round($employee->employee_contract_oncall_monthly_hour($employees[$i]['username'], $this_Ym, TRUE), 2);

    }
}
//echo "<pre>". print_r($employees, 1)."</pre>";
$smarty->assign('contract_reports',$employees);
/*$contract_reports = $employee->get_all_contract_report($year,$emp=null,$cust = NULL);
if(isset($_POST['submit'])){
    $month = $_POST['month'];
    $year = $_POST['year'];
}
$contract_reports = $employee->get_montly_contract_report($month,$year);
$no_contract_report = $eqp->employee_no_contract_report($month,$year);
$reports = $employee->set_excess_less_totoal_time($contract_reports);
$reports_no_contract = $employee->set_excess_less_totoal_time($no_contract_report);
//echo "<pre>". print_r($reports_no_contract, 1)."</pre>";
$smarty->assign('contrat_reports',$reports);
$smarty->assign('no_contract_reports',$reports_no_contract);
$smarty->assign('month',$month);
$smarty->assign('year',$year);*/

$smarty->display('extends:layouts/dashboard.tpl|employee_contract_report.tpl');
?>
