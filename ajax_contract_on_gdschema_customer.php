<?php
/*
*	Auther  : sreerag
*   date    : 26-04-2019	
*	purpose : to show contract details on gdschema customer views. 
*
*/

// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/customer.php');

$obj_customer = $customer   = new customer();



// call from gdschema_month.php

if($_REQUEST['action'] == 'get_contract_details_gdschema_month'){

    $all_contract_details = array();
    
    $selected_customer    = $_REQUEST['customer'];
    $year                 = $_REQUEST['year'];
    $month                = $_REQUEST['month'];
    $month_sdate          = date('Y-m-d', strtotime($year .'-'. $month . '-01'));
    $month_edate          = date('Y-m-t', strtotime($year .'-'. $month . '-01'));
    $selected_Ym          = date('Y|m', strtotime($month_sdate));

    //  calculting contract houres.
    $customer_hours = array();
    if($_SESSION['user_role'] == 3){
        $customer_hours['work']['customer_hours'] = $obj_customer->customer_empoyee_timetable_time_between_dates($month_sdate, $month_edate, $selected_customer, $_SESSION['user_id']);
        $customer_hours['work']['total_hours'] = $obj_customer->customer_empoyee_timetable_time_between_dates($month_sdate, $month_edate, NULL, $_SESSION['user_id']);
    }
    else{
        $customer_hours['work']['fk'] = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 1, FALSE, TRUE);
        $customer_hours['work']['kn'] = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 2, FALSE, TRUE);
        $customer_hours['work']['tu'] = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 3, FALSE, TRUE);

        $customer_hours['contract']['fk'] = $obj_customer->customer_contract_month_hour($selected_customer, $selected_Ym, 1, TRUE);
        $customer_hours['contract']['kn'] = $obj_customer->customer_contract_month_hour($selected_customer, $selected_Ym, 2, TRUE);
        $customer_hours['contract']['tu'] = $obj_customer->customer_contract_month_hour($selected_customer, $selected_Ym, 3, TRUE);

        $temp_actual_hours_fk = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 1, TRUE, TRUE);
        $customer_hours['actual_hours']['fk']['normal'] = $temp_actual_hours_fk['normal_hours'] + $temp_actual_hours_fk['beredskap_hours'];
        $customer_hours['actual_hours']['fk']['oncall'] = $temp_actual_hours_fk['oncall_hours'];
        $temp_actual_hours_kn = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 2, TRUE, TRUE);
        $customer_hours['actual_hours']['kn']['normal'] = $temp_actual_hours_kn['normal_hours'] + $temp_actual_hours_kn['beredskap_hours'];
        $customer_hours['actual_hours']['kn']['oncall'] = $temp_actual_hours_kn['oncall_hours'];
        $temp_actual_hours_tu = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 3, TRUE, TRUE);
        $customer_hours['actual_hours']['tu']['normal'] = $temp_actual_hours_tu['normal_hours'] + $temp_actual_hours_tu['beredskap_hours'];
        $customer_hours['actual_hours']['tu']['oncall'] = $temp_actual_hours_tu['oncall_hours'];
        //echo "<pre>".print_r($customer_hours, 1)."</pre>";
    }


    if($_SESSION['user_role'] != 3){
        $customer_contract_period_hours = array('fk' => array(), 'kn' => array(), 'tu' => array());
        $customer_month_contracts_fk = $obj_customer->customer_contract_month($selected_customer, $selected_Ym, 1, FALSE, TRUE);
        if(!empty($customer_month_contracts_fk) && $customer_month_contracts_fk !== FALSE){
            $i = 0;
            foreach($customer_month_contracts_fk as $fk_contract){

                $customer_contract_period_hours['fk'][$i]['period_from']  = $fk_contract['date_from'];
                $customer_contract_period_hours['fk'][$i]['period_to']    = $fk_contract['date_to'];
                $customer_contract_period_hours['fk'][$i]['work_hours']   = $obj_customer->customer_timetable_time_between_dates($selected_customer, $fk_contract['date_from'], $fk_contract['date_to'], 1, FALSE, TRUE);
                $customer_contract_period_hours['fk'][$i]['unmanned_hour'] =  $obj_customer->customer_unmanned_hour_calc($selected_customer, $fk_contract['date_from'], $fk_contract['date_to'], 1);

                $customer_contract_period_hours['fk'][$i]['contract_hours'] = round($fk_contract['hour'], 2);
                $i++;
            }
        }
        $customer_month_contracts_kn = $obj_customer->customer_contract_month($selected_customer, $selected_Ym, 2, FALSE, TRUE);
        if(!empty($customer_month_contracts_kn) && $customer_month_contracts_kn !== FALSE){
            $i = 0;
            foreach($customer_month_contracts_kn as $kn_contract){
                $customer_contract_period_hours['kn'][$i]['period_from']  = $kn_contract['date_from'];
                $customer_contract_period_hours['kn'][$i]['period_to']    = $kn_contract['date_to'];
                $customer_contract_period_hours['kn'][$i]['work_hours']   = $obj_customer->customer_timetable_time_between_dates($selected_customer, $kn_contract['date_from'], $kn_contract['date_to'], 2, FALSE, TRUE);
                $customer_contract_period_hours['kn'][$i]['unmanned_hour'] =  $obj_customer->customer_unmanned_hour_calc($selected_customer, $kn_contract['date_from'], $kn_contract['date_to'], 2);
                $customer_contract_period_hours['kn'][$i]['contract_hours'] = round($kn_contract['hour'], 2);
                $i++;
            }
        }
        $customer_month_contracts_tu = $obj_customer->customer_contract_month($selected_customer, $selected_Ym, 3, FALSE, TRUE);
        if(!empty($customer_month_contracts_tu) && $customer_month_contracts_tu !== FALSE){
            $i = 0;
            foreach($customer_month_contracts_tu as $tu_contract){
                $customer_contract_period_hours['tu'][$i]['period_from']  = $tu_contract['date_from'];
                $customer_contract_period_hours['tu'][$i]['period_to']    = $tu_contract['date_to'];
                $customer_contract_period_hours['tu'][$i]['work_hours']   = $obj_customer->customer_timetable_time_between_dates($selected_customer, $tu_contract['date_from'], $tu_contract['date_to'], 3, FALSE, TRUE);
                $customer_contract_period_hours['tu'][$i]['unmanned_hour'] =  $obj_customer->customer_unmanned_hour_calc($selected_customer, $tu_contract['date_from'], $tu_contract['date_to'], 3);
                $customer_contract_period_hours['tu'][$i]['contract_hours'] = round($tu_contract['hour'], 2);
                $i++;
            }
        }

        $contract_exist_flag = ($customer_hours['work']['fk'] != 0 || $customer_hours['work']['kn'] != 0 || $customer_hours['work']['tu'] != 0 || 
                    $customer_hours['contract']['fk'] != 0 || $customer_hours['contract']['kn'] != 0 || $customer_hours['contract']['tu'] != 0 ||
                    !empty($customer_month_contracts_fk) || !empty($customer_month_contracts_kn) || !empty($customer_month_contracts_tu)
                    ? TRUE : FALSE);
    }
    else
        $contract_exist_flag = FALSE;

    $all_contract_details = array(
        'contract_exist_flag' => $contract_exist_flag, 
        'customer_hours' => $customer_hours,
        'customer_contract_period_hours' => $customer_contract_period_hours
        );
    echo json_encode($all_contract_details);
    exit();
}

/// call from gdschema_customer.php

if($_REQUEST['action'] == 'get_contract_details_gdschema_customer'){
	// require_once ('class/employee.php');
	// $employee = new employee();
    $customer_username = $_REQUEST['customer'];
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
        $query_string = explode('&', $_SERVER['QUERY_STRING']);
        // var_dump($query_string);
        // exit('df');
        $year_week = $query_string[0];
        
        if (!empty($query_string[1])) {
            $customer_username = $query_string[1];
        }
        $week_position = 8;
        if (!empty($query_string[2])) {
            $week_position = $query_string[2];
        }
    }else if(isset($_REQUEST['year_week']) && $_REQUEST['year_week'] != '' ){
        $year_week = $_REQUEST['year_week'];
    }else {
        $year_week = date('Y') . '|' . date('W');
        $week_position = 8;
    }
    $contract_hours       = $work_hours = array();
    $year_week_params     = explode('|', $year_week);
    $this_week_start_date = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
    // $smarty->assign('week_start_date', $this_week_start_date);
    $this_week_end_date   = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 7));
    // $smarty->assign('week_end_date', $this_week_end_date);
    $this_week_start_Ym   = date('Y|m', strtotime($this_week_start_date));
    $this_week_end_Ym     = date('Y|m', strtotime($this_week_end_date));

    // $emp_list = $employee->employee_list_for_process($this_week_start_date, $this_week_end_date, $customer_username);
    // if($emp_list){
    //     $smarty->assign('employee_details',$emp_list);
    // }

    $contract_hours['fk']['week'] = $customer->customer_contract_week_hour($customer_username, $year_week, 1, TRUE);
    $contract_hours['kn']['week'] = $customer->customer_contract_week_hour($customer_username, $year_week, 2, TRUE);
    $contract_hours['tu']['week'] = $customer->customer_contract_week_hour($customer_username, $year_week, 3, TRUE);
    
    $work_hours['fk']['week']     = $customer->customer_timetable_week_time($customer_username, $year_week, 1, TRUE);
    $work_hours['kn']['week']     = $customer->customer_timetable_week_time($customer_username, $year_week, 2, TRUE);
    $work_hours['tu']['week']     = $customer->customer_timetable_week_time($customer_username, $year_week, 3, TRUE);

    if($this_week_start_Ym == $this_week_end_Ym) {
        $date_params             = explode('|', $this_week_start_Ym);
        $this_year               = $date_params[0];
        $this_month_no           = sprintf("%02d", $date_params[1]);
        $first_day_of_this_month = $this_year.'-'.$this_month_no.'-01';
        $this_month_date_from    = date("Y-m-01", strtotime($first_day_of_this_month));
        $this_month_date_to      = date("Y-m-t", strtotime($first_day_of_this_month));
            
        $work_hours['fk']['month']     = $customer->customer_timetable_time_between_dates($customer_username, $this_month_date_from, $this_month_date_to, 1, FALSE, TRUE);
        $work_hours['kn']['month']     = $customer->customer_timetable_time_between_dates($customer_username, $this_month_date_from, $this_month_date_to, 2, FALSE, TRUE);
        $work_hours['tu']['month']     = $customer->customer_timetable_time_between_dates($customer_username, $this_month_date_from, $this_month_date_to, 3, FALSE, TRUE);
        
        $contract_hours['fk']['month'] = $customer->customer_contract_month_hour($customer_username, $this_week_start_Ym, 1, TRUE);
        $contract_hours['kn']['month'] = $customer->customer_contract_month_hour($customer_username, $this_week_start_Ym, 2, TRUE);
        $contract_hours['tu']['month'] = $customer->customer_contract_month_hour($customer_username, $this_week_start_Ym, 3, TRUE);
    }

    $contract_period_hours      = array('fk' => array(), 'kn' => array(), 'tu' => array());
    //echo $customer_username."--".$year_week;
    $customer_week_contracts_fk = $customer->customer_contract_week($customer_username, $year_week, 1, TRUE);
    if(!empty($customer_week_contracts_fk) && $customer_week_contracts_fk !== FALSE){
            $i = 0;
            foreach($customer_week_contracts_fk as $fk_contract){
                $contract_period_hours['fk'][$i]['period_from']    = $fk_contract['date_from'];
                $contract_period_hours['fk'][$i]['period_to']      = $fk_contract['date_to'];
                $contract_period_hours['fk'][$i]['work_hours']     = round($customer->customer_timetable_time_between_dates($customer_username, $fk_contract['date_from'], $fk_contract['date_to'], 1, FALSE, TRUE),2);
                $contract_period_hours['fk'][$i]['unmanned_hour']  =  round($customer->customer_unmanned_hour_calc($customer_username, $fk_contract['date_from'], $fk_contract['date_to'], 1),2);
                $contract_period_hours['fk'][$i]['contract_hours'] = round($fk_contract['hour'], 2);
                $i++;
            }
        }

        $customer_week_contracts_kn = $customer->customer_contract_week($customer_username, $year_week, 2, TRUE);
        if(!empty($customer_week_contracts_kn) && $customer_week_contracts_kn !== FALSE){
            $i = 0;
            foreach($customer_week_contracts_kn as $kn_contract){
                $contract_period_hours['kn'][$i]['period_from']    = $kn_contract['date_from'];
                $contract_period_hours['kn'][$i]['period_to']      = $kn_contract['date_to'];
                $contract_period_hours['kn'][$i]['work_hours']     = round($customer->customer_timetable_time_between_dates($customer_username, $kn_contract['date_from'], $kn_contract['date_to'], 2, FALSE, TRUE),2);
                $contract_period_hours['kn'][$i]['unmanned_hour']  =  round($customer->customer_unmanned_hour_calc($customer_username, $kn_contract['date_from'], $kn_contract['date_to'], 2),2);
                $contract_period_hours['kn'][$i]['contract_hours'] = round($kn_contract['hour'], 2);
                $i++;
            }
        }
        $customer_week_contracts_tu = $customer->customer_contract_week($customer_username, $year_week, 3, TRUE);
        if(!empty($customer_week_contracts_tu) && $customer_week_contracts_tu !== FALSE){
            $i = 0;
            foreach($customer_week_contracts_tu as $tu_contract){
                $contract_period_hours['tu'][$i]['period_from']    = $tu_contract['date_from'];
                $contract_period_hours['tu'][$i]['period_to']      = $tu_contract['date_to'];
                $contract_period_hours['tu'][$i]['work_hours']     = round($customer->customer_timetable_time_between_dates($customer_username, $tu_contract['date_from'], $tu_contract['date_to'], 3, FALSE, TRUE),2);
                $contract_period_hours['tu'][$i]['unmanned_hour']  =  round($customer->customer_unmanned_hour_calc($customer_username, $tu_contract['date_from'],$tu_contract['date_to'], 3),2);
                $contract_period_hours['tu'][$i]['contract_hours'] = round($tu_contract['hour'], 2);
                $i++;
            }
        }

        //echo "<pre>work_hours".print_r($work_hours, 1)."</pre>";
        //echo "<pre>contract_hours".print_r($contract_hours, 1)."</pre>";
        // if($_SESSION['user_id'] == 'dodo001'){
        //     echo "<pre>contract_period_hours".print_r($contract_period_hours, 1)."</pre>";
        //     exit();
        // }
        $contract_exist_flag = ($work_hours['fk']['week'] != 0 || $work_hours['kn']['week'] != 0 || $work_hours['tu']['week'] != 0 || 
            $contract_hours['fk']['week'] != 0 || $contract_hours['kn']['week'] != 0 || $contract_hours['tu']['week'] != 0 ||
            $work_hours['fk']['month'] != 0 || $work_hours['kn']['month'] != 0 || $work_hours['tu']['month'] != 0 || 
            $contract_hours['fk']['month'] != 0 || $contract_hours['kn']['month'] != 0 || $contract_hours['tu']['month'] != 0 ||
            !empty($customer_week_contracts_fk) || !empty($customer_week_contracts_kn) || !empty($customer_week_contracts_tu)
            ? TRUE : FALSE);

        $all_contract_details = array(
            'contract_exist_flag' => $contract_exist_flag,
            'work_hours' => $work_hours,
            'contract_hours' => $contract_hours,
            'contract_period_hours' => $contract_period_hours
        );
        echo json_encode($all_contract_details);
        exit();
}


?>