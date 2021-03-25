<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('plugins/calender.class.php');
//require_once('class/contract.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "reports.xml","month.xml"));
$employee = new employee();
$obj_calender   = new calender();
//$obj_contract = new contract();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$quer_string = explode("&",$_SERVER['QUERY_STRING']);
$emp_username = $quer_string[0];
$month_year = explode("-",$quer_string[1]);
$month = intval($month_year[0]);
$year = intval($month_year[1]);
$page = intval($month_year[2]);
$smarty->assign('page',$page);
$smarty->assign('year',$year);

$employee_details = $employee->get_employee_detail($emp_username);
$smarty->assign('employee_details',$employee_details);

$this_Ym = $year.'|'.$month;
//$employee_contracts = $obj_contract->get_employee_contract_records($emp_username, 'year_month', $this_Ym);
//echo "<pre>".print_r($employee_contracts, 1)."</pre>";

$all_weeks = $obj_calender->calender_month_weeks($year, $month);
//$all_weeks = $obj_calender->calender_weeks_of_a_month($year, $month);
//echo "<pre>".print_r($all_weeks, 1)."</pre>";

/*$num_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$week_start_num = date('W', strtotime($year.'-'.$month.'-01'));
$week_end_num = date('W', strtotime($year.'-'. $month.'-'. $num_days_in_month));
$weeks_array = array();
$number_of_weeks = $week_end_num - $week_start_num;
for($i=0 ; $i <= $number_of_weeks ; $i++)
    $weeks_array[] = $week_start_num + $i;*/

$normal_contract_details =  array();
if(!empty($all_weeks)){
    $iteration_index = 0;
    foreach ($all_weeks as $wKey => $this_week) {
//        $this_Yw = $year.'|'.$this_week;
//        $normal_contract_details[$iteration_index]['week_no'] = $this_week;
        if($this_week['month'] == 12 && $this_week['week'] == 1) $this_week['year'] += 1;   //for little problem in $all_weeks
        else if($this_week['month'] == 01 && $this_week['week'] == 53) $this_week['year'] -= 1;   //for little problem in $all_weeks
        
        $this_Yw = $this_week['year'].'|'.$this_week['week'];
        $normal_contract_details[$iteration_index]['year'] = $this_week['year'];
        $normal_contract_details[$iteration_index]['week_no'] = $this_week['week'];
        $normal_contract_details[$iteration_index]['work_hour'] = round($employee->employee_total_work_hours($emp_username, 'year_week', $this_Yw, 0), 2);
        $normal_contract_details[$iteration_index]['contract_hour'] = round($employee->employee_contract_week_hour($emp_username, $this_Yw, TRUE), 2);
        $normal_contract_details[$iteration_index]['difference'] = abs($normal_contract_details[$iteration_index]['work_hour'] - $normal_contract_details[$iteration_index]['contract_hour']);
        $normal_contract_details[$iteration_index]['excess_flag'] = ($normal_contract_details[$iteration_index]['work_hour'] > $normal_contract_details[$iteration_index]['contract_hour'] ? 1 : 0);
        $iteration_index++;
    }
}

$monthly_details =  array();
$monthly_details['work_hours']['normal'] = round($employee->employee_total_work_hours($emp_username, 'year_month', $this_Ym, 0), 2);
$monthly_details['work_hours']['oncall'] = round($employee->employee_total_work_hours($emp_username, 'year_month', $this_Ym, 3), 2);
$monthly_details['contract_hours']['normal'] = round($employee->employee_contract_monthly_normal_hour($emp_username, $this_Ym, TRUE), 2);
$monthly_details['contract_hours']['oncall'] = round($employee->employee_contract_oncall_monthly_hour($emp_username, $this_Ym, TRUE), 2);
$monthly_details['normal_difference'] = abs($monthly_details['work_hours']['normal'] - $monthly_details['contract_hours']['normal']);
$monthly_details['oncall_difference'] = abs($monthly_details['work_hours']['oncall'] - $monthly_details['contract_hours']['oncall']);
$monthly_details['excess_flag_normal'] = ($monthly_details['work_hours']['normal'] > $monthly_details['contract_hours']['normal'] ? 1 : 0);
$monthly_details['excess_flag_oncall'] = ($monthly_details['work_hours']['oncall'] > $monthly_details['contract_hours']['oncall'] ? 1 : 0);
//echo "<pre>".print_r($monthly_details, 1)."</pre>";

//---------------------------------------
//$contract_reports = $employee->get_montly_contract_report_employee($month,$year,$emp_username);
//echo "<pre>".print_r($contract_reports, 1)."</pre>";
$smarty->assign('normal_contract_details',$normal_contract_details);
$smarty->assign('monthly_details',$monthly_details);
//$reports = $employee->set_excess_less_totoal_time($contract_reports);
$smarty->display('extends:layouts/dashboard.tpl|employee_contract_detail_report.tpl');
?>