<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml","gdschema.xml"));
$equipment = new equipment();
$customer = new customer();
$employee = new employee();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$smarty->assign('report_year',date('Y'));
$qryString = explode('&', $_SERVER['QUERY_STRING']);
$current_month = date('m');
$current_year = date('Y');
$smarty->assign('start_date',$current_year."-".$current_month."-01");
$smarty->assign('end_date',$current_year."-".$current_month."-".cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year));
$smarty->assign('start',1);
$smarty->assign('check_values','1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0');
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
if(!empty($qryString)  && isset($qryString[1]) && isset($qryString[2])){
    $r_customer = $qryString[0];
    if($r_customer == '-')
        $r_customer = '';
    $s_date = $qryString[1];
    $e_date = $qryString[2];
    $method = $qryString[3];
    $check_values = $qryString[4];
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
    $smarty->assign('checks',$check_array);
    $smarty->assign('start',0);
    $smarty->assign('check_values',$check_values);

    if($method == 'EXCEL'){

        $html = '<style type="text/css">br {mso-data-placement:same-cell;}</style><body>';
        $html .= $equipment->generate_pdf_customer_week_month_report($r_customer,$s_date,$e_date, 2,$condition_array, TRUE);
        $html .= '</body>';
        header("Content-type: application/vnd-ms-excel"); // The function header by sending raw excel
        header("Content-Disposition: attachment; filename=customer-week-report-export.xls"); // Defines the name of the export file "customer-week-report-export.xls"
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $html;
        echo "<script type='application/javascript'>
                window.close();
            </script>";
        exit();
    }
    else {
        $equipment->generate_pdf_customer_week_month_report($r_customer,$s_date,$e_date,$method,$condition_array);
        exit();
    }
}
else{

    $customers = $customer->customer_list();
    $smarty->assign('customers',$customers);
    $month = "";
    $years_work = $employee->distinct_years();
    $smarty->assign("year_option_values", $years_work);
    $smarty->assign('years',$years_work);
    $smarty->assign('time_fk','0.00');
    $smarty->assign('time_kn','0.00');
    $smarty->assign('contract_fk','0.00');
    $smarty->assign('contract_kn','0.00');
     
    if(isset($_POST['add']) || (isset($qryString[0]) && !isset($qryString[2]) && $qryString[0] != '') || $_SESSION['user_role'] == 4){
        
        $smarty->assign('start',0);
        if(isset($_POST['add'])){
            $cust = $_POST['customer'];
            $year = $_POST['year'];
            $month = intval($_POST['month']);
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $check_values = $_POST['check_values'];
            $_SESSION['report_check_values'] = $check_values;
        }elseif(isset($qryString[0]) && $qryString[0]!=""){
            $dates = explode(",", $qryString[1]);
            $cust = $qryString[0];
            $start_date = $dates[0];
            $end_date = $dates[1];
           // $month = intval($month_year[1]);
           // $month = intval($_POST['month']);
           // $start_date = $_POST['start_date'];
           // $start_date = $_POST['start_date'];
            $check_values = $_SESSION['report_check_values'];
            $_SESSION['report_return_url'] = '';
        }elseif($_SESSION['user_role'] == 4){
            $smarty->assign('start',1);
            $cust = $_SESSION['user_id'];
            $year = date("Y");
            $month = intval(date("m"));
            $check_values = '1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0';
            $_SESSION['report_check_values'] = $check_values;
            $current_month = date('m');
            $current_year = date('Y');
            $start_date = $current_year."-".$current_month."-01";
            $end_date = $current_year."-".$current_month."-".cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
            
        }
        $emp = $_SESSION['user_id'];
        $smarty->assign('months',$month);
        $smarty->assign('cust',$cust);
        $smarty->assign('report_year',$year);
        $smarty->assign('start_date',$start_date);
        $smarty->assign('end_date',$end_date);


        $check_array = explode(',', $check_values);
        $condition_array = array('OR');
        if($check_array[0] == 1)
            $condition_array[] = 'type = 0';
        if($check_array[1] == 1)
            $condition_array[] = 'type = 1';
        if($check_array[2] == 1)
            $condition_array[] = 'type = 2';
        if($check_array[3] == 1)
            $condition_array[] = 'type = 3';
        if($check_array[4] == 1)
            $condition_array[] = 'type = 4';
        if($check_array[5] == 1)
            $condition_array[] = 'type = 5';
        if($check_array[6] == 1)
            $condition_array[] = 'type = 6';
        if($check_array[7] == 1)
            $condition_array[] = 'type = 7';
        if($check_array[8] == 1)
            $condition_array[] = 'type = 8';
        if($check_array[9] == 1)
            $condition_array[] = 'type = 9';
        if($check_array[10] == 1)
            $condition_array[] = 'type = 10';
        if($check_array[11] == 1)
            $condition_array[] = 'type = 11';
        if($check_array[12] == 1)
            $condition_array[] = 'type = 12';
        if($check_array[13] == 1)
            $condition_array[] = 'type = 13';
        if($check_array[14] == 1)
            $condition_array[] = 'type = 14';
        if($check_array[15] == 1)
            $condition_array[] = 'type = 15';
        if($check_array[16] == 1)
            $condition_array[] = 'type = 16';
        if($check_array[17] == 1)
            $condition_array[] = 'type = 17';
        $smarty->assign('checks',$check_array);
        
        $smarty->assign('check_values',$check_values);

//        $timetable = $equipment->customer_timetable_month($cust,$month,$year,$emp,$_SESSION['user_role'],$condition_array);
        $year_diff = intval(date('Y',  strtotime($end_date))) - intval(date('Y',  strtotime($start_date)));
        if($year_diff == 0){
            $timetable = $equipment->customer_timetable_month($cust,$start_date,$end_date,$emp,$_SESSION['user_role'],$condition_array);
           // echo "<pre>".print_r($timetable, 1)."</pre>"; exit();
           // exit();
        }else{
            $timetable = array();
            $start_year = intval(date('Y',  strtotime($start_date)));
            $end_year = intval(date('Y',  strtotime($end_date)));
            for($i=0;$i<=$year_diff;$i++){
                $year_check = $start_year + $i;
                if($year_check == $start_year){
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $equipment->customer_timetable_month($cust,$start_date,$temp_end_date,$emp,$_SESSION['user_role'],$condition_array);
                }elseif($year_check == $end_year){
                    $temp_start_date = $year_check."-01-01";
                    $timetable_temp = $equipment->customer_timetable_month($cust,$temp_start_date,$end_date,$emp,$_SESSION['user_role'],$condition_array);
                    $prev_year = $year_check-1;
                    if(date('W',  strtotime($prev_year."-12-31")) == 1 && date('W',  strtotime($year_check."-01-01")) == 1){
                        $last_key_timetable = count($timetable) - 1;
                        for($j=0;$j<count($timetable[$last_key_timetable]['employee']);$j++){
                            for($k=0;$k<count($timetable_temp[0]['employee']);$k++){
                                if($timetable[$last_key_timetable]['employee'][$j]['emp_username'] == $timetable_temp[0]['employee'][$k]['emp_username']){
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Mon']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Mon'][] = $timetable_temp[0]['employee'][$k]['Mon'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Tue']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Tue'][] = $timetable_temp[0]['employee'][$k]['Tue'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Wed']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Wed'][] = $timetable_temp[0]['employee'][$k]['Wed'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Thu']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Thu'][] = $timetable_temp[0]['employee'][$k]['Thu'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Fri']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Fri'][] = $timetable_temp[0]['employee'][$k]['Fri'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sat']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sat'][] = $timetable_temp[0]['employee'][$k]['Sat'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sun']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sun'][] = $timetable_temp[0]['employee'][$k]['Sun'][$x];
                                    }
                                    $timetable[$last_key_timetable]['employee'][$j]['sum'] = $timetable[$last_key_timetable]['employee'][$j]['sum']+$timetable_temp[0]['employee'][$k]['sum'];
                                }
                            }
                        }
                        unset($timetable_temp[0]);
                    }
                }else{
                    $temp_start_date = $year_check."-01-01";
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $equipment->customer_timetable_month($cust,$temp_start_date,$temp_end_date,$emp,$_SESSION['user_role'],$condition_array);
                    if(date('W',  strtotime($prev_year."-12-31")) == 1 && date('W',  strtotime($year_check."-01-01")) == 1){
                        $last_key_timetable = count($timetable) - 1;
                        for($j=0;$j<count($timetable[$last_key_timetable]['employee']);$j++){
                            for($k=0;$k<count($timetable_temp[0]['employee']);$k++){
                                if($timetable[$last_key_timetable]['employee'][$j]['emp_username'] == $timetable_temp[0]['employee'][$k]['emp_username']){
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Mon']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Mon'][] = $timetable_temp[0]['employee'][$k]['Mon'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Tue']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Tue'][] = $timetable_temp[0]['employee'][$k]['Tue'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Wed']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Wed'][] = $timetable_temp[0]['employee'][$k]['Wed'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Thu']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Thu'][] = $timetable_temp[0]['employee'][$k]['Thu'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Fri']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Fri'][] = $timetable_temp[0]['employee'][$k]['Fri'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sat']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sat'][] = $timetable_temp[0]['employee'][$k]['Sat'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sun']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sun'][] = $timetable_temp[0]['employee'][$k]['Sun'][$x];
                                    }
                                    $timetable[$last_key_timetable]['employee'][$j]['sum'] = $timetable[$last_key_timetable]['employee'][$j]['sum']+$timetable_temp[0]['employee'][$k]['sum'];
                                }
                            }
                        }
                        unset($timetable_temp[0]);
                    }
                }
                $timetable = array_merge($timetable,$timetable_temp); 
                
            }
        }
//        $timetable = $equipment->customer_timetable_month($cust,$start_date,$end_date,$emp,$_SESSION['user_role'],$condition_array);
//        echo "<pre>". print_r($timetable, 1)."</pre>"; //exit();
        $time_fk = $time_kn = '0.00';
//        $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s',$month ), $year);
//        $fdate = $year."-".sprintf('%02s',$month )."-01";
//        $tdate = $year."-".sprintf('%02s',$month )."-".$num;
//        $contract_data = $customer->get_filter_date_report($cust,$fdate,$tdate,'10');
        $contract_data = $customer->get_filter_date_report($cust,$start_date,$end_date,'10');
//        echo "<pre>".print_r($contract_data, 1)."</pre>";
        
        $worked_hours_fk = $worked_hours_kn = 0.00;
        for($i=0;$i<count($timetable);$i++){
            if(!empty($timetable[$i]['employee'])){
                foreach($timetable[$i]['employee'] as $emp_data_key => $emp_datas){
                    foreach(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat') as $day_key){
                        if(isset($timetable[$i]['employee'][$emp_data_key][$day_key]) && !empty($timetable[$i]['employee'][$emp_data_key][$day_key])){
                            foreach($timetable[$i]['employee'][$emp_data_key][$day_key] as $data_elements){
                                $exploded_data_set = explode(',', $data_elements);
                                if($exploded_data_set[4] == 1 && $exploded_data_set[2] == 1){ //pick only fk slots
                                    $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                    $worked_hours_fk =  $equipment->time_sum($worked_hours_fk, $equipment->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                                }
                                else if(in_array($exploded_data_set[4], array(2,3)) && $exploded_data_set[2] == 1){ //pick only kn/tu slots
                                    $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                    $worked_hours_kn =  $equipment->time_sum($worked_hours_kn, $equipment->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                                }
                            }
                        }
                    }
                }
            }
        }
//        exit();
        $smarty->assign('contract_fk',$contract_data['fk_granted']);
        $smarty->assign('contract_kn',$contract_data['kn_granted']);
//        $smarty->assign('time_fk', $contract_data['fk_used']);
//        $smarty->assign('time_kn',$contract_data['kn_used']);
        $smarty->assign('time_fk', $equipment->time_user_format($worked_hours_fk,100));
        $smarty->assign('time_kn',$equipment->time_user_format($worked_hours_kn,100));

        $sums = $equipment->customer_week_time_sum($timetable);
        $smarty->assign('reports',$timetable);
        $smarty->assign('sums',$sums);
        // echo "<pre>".print_r($timetable, 1)."</pre>"; exit();
    }
}

$smarty->display('extends:layouts/dashboard.tpl|customer_week_month_report.tpl');
?>