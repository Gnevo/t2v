<?php
require_once('class/setup.php');
require_once('class/equipment.php');
//require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/contract.php');

$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml",'reports.xml','gdschema.xml'));
$equipment = new equipment();
//$customer = new customer();
$employee = new employee();
$obj_contract = new contract();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$employees = $employee->employee_list();
$smarty->assign('employees',$employees);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$querystring = explode('&', $_SERVER['QUERY_STRING']);
$years_work = $employee->distinct_years();
$current_month = date('m');
$current_year = date('Y');
$smarty->assign('start_date',$current_year."-".$current_month."-01");
$smarty->assign('end_date',$current_year."-".$current_month."-".cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year));
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->assign('login_user',$_SESSION['user_id']);
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
$smarty->assign('report_year',date('Y'));
$smarty->assign('start',1);
//$smarty->assign('oncall_worked','0.00');
$smarty->assign('check_values','1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0');
//echo "<pre>".print_r($_POST, 1)."</pre>"; exit();

if(isset($_POST['action']) && $_POST['action'] == 'print'){
    //echo "<script>alert('".$_POST['check_values']."');</script>";
    $check_values = $_POST['check_values'];
    $check_array = explode(',', $check_values);
    $condition_array = array('OR');
    if($check_array[0] == 1) $condition_array[] = 'type = 0';
    if($check_array[1] == 1) $condition_array[] = 'type = 1'; 
    if($check_array[2] == 1) $condition_array[] = 'type = 2'; 
    if($check_array[3] == 1) $condition_array[] = 'type = 3'; 
    if($check_array[4] == 1) $condition_array[] = 'type = 4';
    if($check_array[5] == 1) $condition_array[] = 'type = 5';
    if($check_array[6] == 1) $condition_array[] = 'type = 6';
    if($check_array[7] == 1) $condition_array[] = 'type = 7';
    if($check_array[8] == 1) $condition_array[] = 'type = 8'; 
    if($check_array[9] == 1) $condition_array[] = 'type = 9'; 
    if($check_array[10] == 1) $condition_array[] = 'type = 10'; 
    if($check_array[11] == 1) $condition_array[] = 'type = 11'; 
    if($check_array[12] == 1) $condition_array[] = 'type = 12'; 
    if($check_array[13] == 1) $condition_array[] = 'type = 13'; 
    if($check_array[14] == 1) $condition_array[] = 'type = 14'; 
    if($check_array[15] == 1) $condition_array[] = 'type = 15'; 
    if($check_array[16] == 1) $condition_array[] = 'type = 16';
    if($check_array[17] == 1) $condition_array[] = 'type = 17';
    $smarty->assign('checks',$check_array);
    $smarty->assign('start',0);
    $smarty->assign('check_values',$check_values);
    $equipment->generate_pdf_employee_week_month_report($_POST['employee'],$_POST['start_date'],$_POST['end_date'],$_POST['print_method_input'],$condition_array);
    exit();
}
else if(isset($_POST['action']) && $_POST['action'] == 'EXCEL-PRINT'){
    //echo "<script>alert('".$_POST['check_values']."');</script>";
    $check_values = $_POST['check_values'];
    $check_array = explode(',', $check_values);
    $condition_array = array('OR');
    if($check_array[0] == 1) $condition_array[] = 'type = 0';
    if($check_array[1] == 1) $condition_array[] = 'type = 1'; 
    if($check_array[2] == 1) $condition_array[] = 'type = 2'; 
    if($check_array[3] == 1) $condition_array[] = 'type = 3'; 
    if($check_array[4] == 1) $condition_array[] = 'type = 4';
    if($check_array[5] == 1) $condition_array[] = 'type = 5';
    if($check_array[6] == 1) $condition_array[] = 'type = 6';
    if($check_array[7] == 1) $condition_array[] = 'type = 7';
    if($check_array[8] == 1) $condition_array[] = 'type = 8'; 
    if($check_array[9] == 1) $condition_array[] = 'type = 9'; 
    if($check_array[10] == 1) $condition_array[] = 'type = 10'; 
    if($check_array[11] == 1) $condition_array[] = 'type = 11'; 
    if($check_array[12] == 1) $condition_array[] = 'type = 12'; 
    if($check_array[13] == 1) $condition_array[] = 'type = 13'; 
    if($check_array[14] == 1) $condition_array[] = 'type = 14'; 
    if($check_array[15] == 1) $condition_array[] = 'type = 15'; 
    if($check_array[16] == 1) $condition_array[] = 'type = 16';
    if($check_array[17] == 1) $condition_array[] = 'type = 17';
    $smarty->assign('checks',$check_array);
    $smarty->assign('start',0);
    $smarty->assign('check_values',$check_values);


    $html = '<style type="text/css">br {mso-data-placement:same-cell;}</style><body>';
    $html .= $equipment->generate_pdf_employee_week_month_report($_POST['employee'],$_POST['start_date'],$_POST['end_date'],$_POST['print_method_input'], $condition_array, TRUE);
    $html .= '</body>';
    header("Content-type: application/vnd-ms-excel"); // The function header by sending raw excel
    header("Content-Disposition: attachment; filename=employee-week-report-export.xls"); // Defines the name of the export file "employee-week-report-export.xls"
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $html;
    echo "<script type='application/javascript'>
            window.close();
        </script>";
    exit();
}
else{
    $smarty->assign('time_sum','0.00');
    $smarty->assign('contract_hours','0.00');
    if(isset($_POST['add']) || (isset($querystring[0]) && $querystring[0] != '') || $_SESSION['user_role'] == 3){
        if(isset($_POST['add'])){
            $emp = $_POST['employee'];
            $year = $_POST['year'];
            $month = $_POST['month'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $check_values = $_POST['check_values'];
            $_SESSION['report_check_values'] = $check_values;
        }elseif(isset($querystring[0]) && ($querystring[0] != "" || $querystring[0] != NULL)){
            $emp = $querystring[0];
            $dates = explode(',', $querystring[1]);
            $start_date = $dates[0];
            $end_date = $dates[1];
            $check_values = $_SESSION['report_check_values'];
            $_SESSION['report_return_url'] = '';
        }elseif($_SESSION['user_role'] == 3){
            $emp = $_SESSION['user_id'];
            $year = date('Y');
            $month = date("m");
            $current_month = date('m');
            $current_year = date('Y');
            $start_date = $current_year."-".$current_month."-01";
            $end_date = $current_year."-".$current_month."-".cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
            $check_values = '1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0';
            $_SESSION['report_check_values'] = $check_values;
        }
//        $emp = $_POST['employee'];
//        $year = $_POST['year'];
//        $month = $_POST['month'];
        $smarty->assign('month',$month);
        $smarty->assign('report_year',$year);
        $smarty->assign('emp',$emp);

        //contract hours of the employee
    //    $contract_hours = $employee->get_employee_monthly_contract($emp,$month,$year);
    //    $smarty->assign('contract_hours',$contract_hours);

        /*$cur_employee_contract_nomal = round($employee->employee_total_work_hours($emp, 'date_between', $start_date.'|'.$end_date, 0), 2);
        $cur_employee_contract_oncall = round($employee->employee_total_work_hours($emp, 'date_between', $start_date.'|'.$end_date, 3), 2);
//        echo $cur_employee_contract_oncall;
        if($cur_employee_contract_oncall == '')
            $cur_employee_contract_oncall ='0.00';
        $smarty->assign('oncall_worked',$cur_employee_contract_oncall);*/
        $cur_employee_contracts_oncall = $obj_contract->get_employee_contract_records($emp, 'between_date', $start_date.'|'.$end_date);
        
        $cur_employee_contracts = $obj_contract->get_employee_contract_between_dates($emp, $start_date, $end_date);
        $contract_per_day = $equipment->time_user_format($cur_employee_contracts[0]['hour'])/5;
//        $contract_per_day = $equipment->time_user_format($cur_employee_contracts['contract_hours'])/5;
//        $end_date = date("Y-m-t", strtotime($year."-".$month."-01"));
        $working_days = $obj_contract->get_working_days($start_date, $end_date);
        $contract_monthly_hours = $working_days * $contract_per_day;
        $smarty->assign('contract_hours',$cur_employee_contracts['contract_hours']);
        $smarty->assign('contract_hours_oncall',$cur_employee_contracts_oncall[0]['monthly_oncall_hour']);
        
        $check_array = explode(',', $check_values);
        $condition_array = array('OR');
        if($check_array[0] == 1){
            $condition_array[] = 'type = 0';
        }
        if($check_array[1] == 1){
            $condition_array[] = 'type = 1';
        }
        if($check_array[2] == 1){
            $condition_array[] = 'type = 2';
        }
        if($check_array[3] == 1){
            $condition_array[] = 'type = 3';
        }
        if($check_array[4] == 1){
            $condition_array[] = 'type = 4';
        }
        if($check_array[5] == 1){
            $condition_array[] = 'type = 5';
        }
        if($check_array[6] == 1){
            $condition_array[] = 'type = 6';
        }
        if($check_array[7] == 1){
            $condition_array[] = 'type = 7';
        }
        if($check_array[8] == 1){
            $condition_array[] = 'type = 8';
        }
        if($check_array[9] == 1){
            $condition_array[] = 'type = 9';
        }
        if($check_array[10] == 1){
            $condition_array[] = 'type = 10';
        }
        if($check_array[11] == 1){
            $condition_array[] = 'type = 11';
        }
        if($check_array[12] == 1){
            $condition_array[] = 'type = 12';
        }
        if($check_array[13] == 1){
            $condition_array[] = 'type = 13';
        }
        if($check_array[14] == 1){
            $condition_array[] = 'type = 14';
        }
        if($check_array[15] == 1){
            $condition_array[] = 'type = 15';
        }
        if($check_array[16] == 1){
            $condition_array[] = 'type = 16';
        }
        if($check_array[17] == 1){
            $condition_array[] = 'type = 17';
        }
//        echo "<pre>".print_r($condition_array, 1)."</pre>"; exit();
        $year_diff = intval(date('Y',  strtotime($end_date))) - intval(date('Y',  strtotime($start_date)));
        if($year_diff == 0){
            $timetable = $equipment->employee_timetable_month($emp,$start_date,$end_date,$condition_array);
//            echo "<pre>". print_r($timetable, 1)."</pre>"; exit();
        }else{
            $timetable = array();
            $start_year = intval(date('Y',  strtotime($start_date)));
            $end_year = intval(date('Y',  strtotime($end_date)));
            for($i=0;$i<=$year_diff;$i++){
                $year_check = $start_year + $i;
                if($year_check == $start_year){
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $equipment->employee_timetable_month($emp,$start_date,$temp_end_date,$condition_array);
                }elseif($year_check == $end_year){
                    $temp_start_date = $year_check."-01-01";
                    $timetable_temp = $equipment->employee_timetable_month($emp,$temp_start_date,$end_date,$condition_array);
                    $prev_year = $year_check-1;
                    if(date('W',  strtotime($prev_year."-12-31")) ==  date('W',  strtotime($year_check."-01-01"))){
                        $last_key_timetable = count($timetable) - 1;
                        $timetable[$last_key_timetable]['data']['mon'] = array_merge($timetable[$last_key_timetable]['data']['mon'],$timetable_temp[0]['data']['mon']);
                        $timetable[$last_key_timetable]['data']['tue'] = array_merge($timetable[$last_key_timetable]['data']['tue'],$timetable_temp[0]['data']['tue']);
                        $timetable[$last_key_timetable]['data']['wed'] = array_merge($timetable[$last_key_timetable]['data']['wed'],$timetable_temp[0]['data']['wed']);
                        $timetable[$last_key_timetable]['data']['thu'] = array_merge($timetable[$last_key_timetable]['data']['thu'],$timetable_temp[0]['data']['thu']);
                        $timetable[$last_key_timetable]['data']['fri'] = array_merge($timetable[$last_key_timetable]['data']['fri'],$timetable_temp[0]['data']['fri']);
                        $timetable[$last_key_timetable]['data']['sat'] = array_merge($timetable[$last_key_timetable]['data']['sat'],$timetable_temp[0]['data']['sat']);
                        $timetable[$last_key_timetable]['data']['sun'] = array_merge($timetable[$last_key_timetable]['data']['sun'],$timetable_temp[0]['data']['sun']);
                        $timetable[$last_key_timetable]['data']['sum'] = $timetable[$last_key_timetable]['data']['sum']+$timetable_temp[0]['data']['sum'];
                        unset($timetable_temp[0]);
                        
                    }
                }else{
                    $temp_start_date = $year_check."-01-01";
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $equipment->employee_timetable_month($emp,$temp_start_date,$temp_end_date,$condition_array);
                    $prev_year = $year_check-1;
                    if(date('W',  strtotime($prev_year."-12-31")) == date('W',  strtotime($year_check."-01-01"))){
                        $last_key_timetable = count($timetable) - 1;
                        $timetable[$last_key_timetable]['data']['mon'] = array_merge($timetable[$last_key_timetable]['data']['mon'],$timetable_temp[0]['data']['mon']);
                        $timetable[$last_key_timetable]['data']['tue'] = array_merge($timetable[$last_key_timetable]['data']['tue'],$timetable_temp[0]['data']['tue']);
                        $timetable[$last_key_timetable]['data']['wed'] = array_merge($timetable[$last_key_timetable]['data']['wed'],$timetable_temp[0]['data']['wed']);
                        $timetable[$last_key_timetable]['data']['thu'] = array_merge($timetable[$last_key_timetable]['data']['thu'],$timetable_temp[0]['data']['thu']);
                        $timetable[$last_key_timetable]['data']['fri'] = array_merge($timetable[$last_key_timetable]['data']['fri'],$timetable_temp[0]['data']['fri']);
                        $timetable[$last_key_timetable]['data']['sat'] = array_merge($timetable[$last_key_timetable]['data']['sat'],$timetable_temp[0]['data']['sat']);
                        $timetable[$last_key_timetable]['data']['sun'] = array_merge($timetable[$last_key_timetable]['data']['sun'],$timetable_temp[0]['data']['sun']);
                        $timetable[$last_key_timetable]['data']['sum'] = $timetable[$last_key_timetable]['data']['sum']+$timetable_temp[0]['data']['sum'];
                        unset($timetable_temp[0]);
                        
                    }
                }
                $timetable = array_merge($timetable,$timetable_temp); 
                
            }
        }
//        echo "<pre>". print_r($timetable, 1)."</pre>";
       
//        $timetable = $equipment->employee_timetable_month($emp,$start_date,$end_date,$condition_array);
        $sums = $equipment->employee_week_time_sum($timetable);
        $time_sum = '0.00';
//        echo "<pre>".print_r($timetable, 1)."</pre>";  exit();
        $ordinary_time_sum = $jour_time_sum = 0.00;
        for($i=0;$i<count($timetable);$i++){
            $time_sum =  $employee->time_sum($time_sum, $equipment->time_user_format($timetable[$i]['data']['sum'])); 
            
            if(!empty($timetable[$i]['data'])/* && $check_array[0] == 1*/){
                foreach(array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat') as $day_key){
                    if(!empty($timetable[$i]['data'][$day_key])){
                        foreach($timetable[$i]['data'][$day_key] as $data_elements){
                            $exploded_data_set = explode(',', $data_elements['time']);
                            if(in_array($exploded_data_set[1], array('0','1','2','4','5','6','7','8','10','11','12','15','16')) && $exploded_data_set[2] == 1){ //pick only normal slots
                                $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                $ordinary_time_sum =  $equipment->time_sum($ordinary_time_sum, $equipment->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                            }
                            else if(in_array($exploded_data_set[1], array(3,9,13,14,17)) && $exploded_data_set[2] == 1){ //pick only oncall slots
                                $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                $jour_time_sum =  $equipment->time_sum($jour_time_sum, $equipment->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                            }
                        }
                    }
                }
            }
        }
        $time_sum = $equipment->time_user_format($time_sum,100);
        $ordinary_time_sum = $equipment->time_user_format($ordinary_time_sum,100);
        $jour_time_sum = $equipment->time_user_format($jour_time_sum,100);
        
//        echo "<pre>".print_r($timetable, 1)."</pre>"; exit();
        $smarty->assign('start_date',$start_date);
        $smarty->assign('end_date',$end_date);
        $smarty->assign('reports',$timetable);
        $smarty->assign('time_sum',$time_sum);
        $smarty->assign('sums',$sums);
//echo $ordinary_time_sum; exit();
        $smarty->assign('ordinary_time_sum',$ordinary_time_sum);
        $smarty->assign('jour_time_sum',$jour_time_sum);
        $smarty->assign('checks',$check_array);
        $smarty->assign('start',0);
        $smarty->assign('check_values',$check_values);
        $smarty->assign('open_calender',1);
    }
}
$smarty->display('extends:layouts/dashboard.tpl|employee_week_month_report.tpl');
?>