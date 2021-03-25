<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
/**
 * @author: shaju
 * @edited-by: Shamsudheen<shamsu@arioninfotech.com>
 * @for: check whether atl warning exist or not
 * @rule: should accept parameters only as $_REQUEST mode... (because it might called from ajax_check_atl_and_contract.php)
*/
require_once('class/employee.php');
//require_once('class/customer.php');
require_once('class/dona.php');
require_once('class/user.php');
$obj_emp = new employee();
$obj_dona = new dona();
$obj_user = new user();
//$obj_cust = new customer();
//$slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
$return_obj = array( 'atl' => 'success');
$return_obj['test'] = 'shaju';
//        echo "<pre>".print_r($_REQUEST, 1)."</pre>";
//echo "sasa".$_REQUEST['right_click']."----".$_REQUEST['multi']."----".$_REQUEST['action'];
//$return_obj['test'] = $_REQUEST['right_click'];
if(isset($_REQUEST['right_click']) && $_REQUEST['right_click'] == "1"){
    /**
     * @author: Shamsudheen <shamsu@arioninfotech.com>
     * for: Perform ATL warning when change employee/customer of multiple slots 
     * @request-from: right-click events from gdschema_employee/gdschema_customer
    */
    /*$_REQUEST['to_single_day'] = 1;
    $ids = explode("-",$_REQUEST['ids']);
    $distinct_dates = $obj_cust->get_distinct_dates_for_slots($ids);
    $atl_status = 0;
    $output = 'success';
    for($i=0 ; $i<count($distinct_dates) ; $i++){
        $extra_prev_slots = array();
        $extra_after_slots = array();
        $slots_detail_ondate = $obj_emp->get_multiple_slot_details($ids,$distinct_dates[$i]['date']);
        foreach($slots_detail_ondate AS $slots){
            extract_slots($slots_detail_ondate,$slots['employee'], $slots['date'], $slots['time_from'], $slots['time_to'], $extra_prev_slots, $extra_after_slots, $slots['date']);
            $status = $obj_emp->checkATL($slots['customer'], $slots['employee'], $slots['date'], $slots['time_from'], $slots['time_to'], '', 0, $extra_prev_slots);
            if($status !== TRUE){
                $atl_status++;
                $output = $status['atl_message'];
                $atl_params = $status;
                break;
            }
        }
        if($atl_status > 0) break;
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
    //    $slots_detail_ondate = $obj_emp->get_multiple_slot_details();
    //    $return_obj['atl'] = $obj_emp->get_distinct_dates($cust,$emp,$ids);
        */
    //    $return_obj['test'] = 2;
    //------------------------------------------------------------------------------------
    $ids = explode("-",$_REQUEST['ids']);
    $slot_dets = $obj_emp->get_multiple_slot_details($ids);
    //    echo "<pre>".print_r($slot_dets, 1)."</pre>";
    $slot_dets_for_process = array();
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            $override_employee = (isset($_REQUEST['employee_username']) && trim($_REQUEST['employee_username']) != '' ? trim($_REQUEST['employee_username']) : $slot_det['employee']);
            $override_customer = (isset($_REQUEST['customer_select']) && trim($_REQUEST['customer_select']) != '' ? trim($_REQUEST['customer_select']) : $slot_det['customer']);
            
            if($override_employee == '' || $override_customer == '') continue;
            $slot_dets_for_process[] = array(
                            'id'            =>  $slot_det['id'], 
                            'employee'      =>  $override_employee,
                            'customer'      =>  $override_customer, 
                            'date'          =>  $slot_det['date'], 
                            'time_from'     =>  $slot_det['time_from'], 
                            'time_to'       =>  $slot_det['time_to'], 
                            'type'          =>  $slot_det['type'], 
                            'status'        =>  $slot_det['status'], 
                            'alloc_emp'     =>  $slot_det['alloc_emp'], 
                            'relation_id'   =>  $slot_det['relation_id'],
                            'fkkn'          =>  $slot_det['fkkn']);
        };
    }
    //echo "<pre>".print_r($slot_dets_for_process, 1)."</pre>";
    
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    if(!empty($slot_dets_for_process)){
        $i=0;
        $extra_prev_slots = array();
        $extra_after_slots = array();
        foreach($slot_dets_for_process as $slot_det){
            $i++;
            $paste_date = $slot_det['date'];
            
            extract_slots($slot_dets_for_process,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);
            $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], $slot_det['id'], 0, $extra_prev_slots);
            
            //            echo "<br>---".$slot_det['employee']."----------";
            //            echo "<pre>".print_r($status, 1)."</pre>";
            if($status !== TRUE){
               
                $atl_status++;
                $output = $status['atl_message'];
                $atl_params = $status;
            }
            if($atl_status > 0) break;
        }
    }
    
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
    
}
else if(isset($_REQUEST['multi']) && $_REQUEST['multi'] == 1){
    
    $ids = explode(",",$_REQUEST['ids']);
    if(trim($_REQUEST['action']) == 'multiple_slot_assign_cust'){
        $selected_cust = isset($_REQUEST['cust']) ? trim($_REQUEST['cust']) : '';
        $tot_id_count = count($ids);
        for($i=0 ; $i < $tot_id_count ; $i++){
            $slot_det = $obj_emp->customer_employee_slot_details($ids[$i]);
            $atl_status = $obj_emp->checkATL( $selected_cust, $slot_det['employee'], $_REQUEST['date'], $slot_det['time_from'], $slot_det['time_to']);
            if($atl_status === TRUE)
                continue;
            else{
                //                echo $atl_status;
                $return_obj['atl'] = $atl_status['atl_message'];
                //                $return_obj['atl_exceed_hours'] = $atl_status['atl_exceed_hours'];
                $return_obj['atl_params'] = $atl_status;
                break;
            }
        }
        if($i == $tot_id_count){
            //            echo "success";
            $return_obj['atl'] = "success";
        }
    }else{ //=> 'action' == 'multiple_slot_assign'
        
        $_REQUEST['select_emp'] = isset($_REQUEST['empl']) ? $_REQUEST['empl'] : '';
        for($i=0;$i<count($ids);$i++){
            $slot_det = $obj_emp->customer_employee_slot_details($ids[$i]);
            $atl_status = $obj_emp->checkATL($slot_det['customer'], $_REQUEST['select_emp'], $_REQUEST['date'], $slot_det['time_from'], $slot_det['time_to']);
            //echo "<script>alert('".$_REQUEST['select_emp']."   ".$_REQUEST['date']."    ".$slot_det['time_from']."    ".$slot_det['time_to']."')</script>";
            if($atl_status === TRUE){
                continue;
            }
            else{
                $return_obj['atl'] = $atl_status['atl_message'];
                $return_obj['atl_params'] = $atl_status;
                break;
            }
        }
        if($i == count($ids)){
            $return_obj['atl'] =  "success";
        }
    }
}
else if(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'drop' || $_REQUEST['action'] == 'man_slot_entry')){
    //multiple time slots
    if (isset($_REQUEST['sub_action']) && $_REQUEST['sub_action'] == 'multiple_add') {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: Perform ATL warning when multiple adding time slots using employee slots
        */
        $atl_status = 0;
        $output = 'success';
        $atl_params = array();
        
        $customer_to_add = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
        
        $employee_to_add = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
        if(trim($_REQUEST['employee']) == '' && $_REQUEST['action'] == 'drop')
           $employee_to_add  = isset($_REQUEST['select_employee']) && trim($_REQUEST['select_employee']) != '' ? trim($_REQUEST['select_employee']) : NULL;
        if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
        
        $selected_date = trim($_REQUEST['date']);
        $slot_periods = array();
        $any_slot_enters_to_next_day = FALSE;
        
        if(!empty($_REQUEST['time_slots'])){
            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));

            foreach($_REQUEST['time_slots'] as $time_slot){

                $tmp_time_from  = $obj_dona->time_to_sixty(trim($time_slot['time_from']));
                $tmp_time_to    = $obj_dona->time_to_sixty(trim($time_slot['time_to']));
                if($tmp_time_to == 0) $tmp_time_to = 24;
                
                $tmp_emp_to_add =  $employee_to_add != NULL ? $employee_to_add : trim($time_slot['employee']);
                $customer_to_add =  $customer_to_add != NULL ? $customer_to_add : trim($time_slot['customer']);

                if($tmp_time_from != false && $tmp_time_to != false && $customer_to_add != '' && $tmp_emp_to_add != ''){
                    //if the slot enters next day
                    if($tmp_time_from >= $tmp_time_to){
                        $any_slot_enters_to_next_day = TRUE;
                        $slot_periods[$tmp_emp_to_add][] = array(
                                'date'      => $selected_date,
                                'time_from' => $tmp_time_from, 
                                'time_to'   => 24, 
                                'customer'  => $customer_to_add,
                                'employee'  => $tmp_emp_to_add,
                                'type'      => trim($time_slot['type']) 
                        );
                        $slot_periods[$tmp_emp_to_add][] = array(
                                'date'      => $next_date,
                                'time_from' => 0, 
                                'time_to'   => $tmp_time_to, 
                                'customer'  => $customer_to_add,
                                'employee'  => $tmp_emp_to_add,
                                'type'      => trim($time_slot['type']) 
                        );
                    } else {
                        $slot_periods[$tmp_emp_to_add][] = array( 
                                'date'      => $selected_date,
                                'time_from' => $tmp_time_from, 
                                'time_to'   => $tmp_time_to, 
                                'customer'  => $customer_to_add,
                                'employee'  => $tmp_emp_to_add,
                                'type'      => trim($time_slot['type']) 
                            );
                    }
                }
            }
        }
        
        $global_failed = false;
        if(!empty($slot_periods)){
            
            if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
                $sel_date = $selected_date;
                $from_option = trim($_REQUEST['from_option']);
                $days = explode('-', $_REQUEST['days']);
                //array_pop($days);
                $from_year = date('o', strtotime($sel_date));
                $from_week = trim($_REQUEST['from_week']);
                $to_year = substr($_REQUEST['to_week'], 0, 4);
                $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);

                $weeks = "'";
                $i = 0;
                $temp_to_week = $to_week;
                //echo "<pre>".print_r($slot_periods,1)."<pre>";
                foreach($slot_periods as $slot_emp => $slot_emp_periods){
                    $extra_prev_slots = array();
                    $extra_after_slots = array();
                    
                    foreach($slot_emp_periods as $slot_det){
                        if($to_year > $from_year) $to_week = 52;
                        $paste_year = $from_year;
                        for($i = $from_week; $i <= $to_week; $i++){
                            $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                            foreach ($days as $day) {
                                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                                if(strtotime($slot_det['date']) > strtotime($selected_date)){
                                    $paste_date = date('Y-m-d', strtotime($paste_date .' +1 day'));
                                }
                                if(strtotime($selected_date) <= strtotime($paste_date)){
                                    if ($slot_det['time_from'] >= $slot_det['time_to']) {
                                        $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], 24, '', 0, $extra_prev_slots);
                                        //getting previous paste slots
                                        $paste_slot = array(
                                                'employee'  => $slot_det['employee'], 
                                                'customer'  => $slot_det['customer'], 
                                                'date'      => $paste_date, 
                                                'time_from' => $slot_det['time_from'], 
                                                'time_to'   => 24);
                                        $extra_prev_slots[] = $paste_slot;

                                        if($status !== TRUE){
                                            $atl_status++;
                                            $output = $status['atl_message'];
                                            $atl_params = $status;
                                            break;
                                        } else {
                                            //echo "from A 00".$nextday."<br>";
                                            //echo "<pre>".print_r($slot_det,1)."</pre>";
                                            //echo "<pre>Extra".print_r($extra_prev_slots,1)."</pre>";
                                            $nextday = date('Y-m-d', strtotime($paste_date . ' +1 day'));
                                            $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $nextday, 0.00, $slot_det['time_to'], '', 0, $extra_prev_slots);

                                            $past_slot = array(
                                                    'employee'  => $slot_det['employee'], 
                                                    'customer'  => $slot_det['customer'], 
                                                    'date'      => $nextday, 
                                                    'time_from' => 0.00, 
                                                    'time_to'   => $slot_det['time_to']);
                                            $extra_prev_slots[] = $paste_slot;

                                            if($status !== TRUE){
                                                $atl_status++;
                                                $output = $status['atl_message'];
                                                $atl_params = $status;
                                                break;
                                            }
                                        }
                                    } 
                                    else {
                                        //echo $paste_date."-".$slot_det['time_from']."-".$slot_det['time_to'];
                                        //echo "from B ".$paste_date."<br>";
                                            //echo "<pre>".print_r($slot_det,1)."</pre>";
                                            //echo "<pre>Extra".print_r($extra_prev_slots,1)."</pre>";
                                        $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);
                                        //echo "<pre>".print_r($status,1)."</pre>";
                                        //getting previous paste slots
                                        $past_slot = array(
                                                'employee'  => $slot_det['employee'], 
                                                'customer'  => $slot_det['customer'], 
                                                'date'      => $paste_date, 
                                                'time_from' => $slot_det['time_from'], 
                                                'time_to'   => $slot_det['time_to']);
                                        $extra_prev_slots[] = $past_slot;
                                        array_multisort(array_column($extra_prev_slots, 'date'), SORT_ASC,
                                        array_column($extra_prev_slots, 'time_from'),      SORT_ASC,
                                        $extra_prev_slots);
                                        //echo "<pre>".print_r($extra_prev_slots,1)."</pre>-----------";
                                        if($status !== TRUE){
                                            $atl_status++;
                                            $output = $status['atl_message'];
                                            $atl_params = $status;
                                            break;
                                        }
                                    }
                                }
                                if($to_year > $from_year && $i == 52){
                                    $i=1;
                                    $to_week = $temp_to_week;
                                    $paste_year = substr($_REQUEST['to_week'],0,4);
                                }
                            }
                            if($atl_status > 0)
                                break;
                            $i++;
                            $i += $from_option;
                        }
                        if($atl_status > 0)
                            break;
                    }
                    if($atl_status > 0)
                        break;
                }
            }
            
            else {
                //echo "<pre>".print_r($slot_periods,1)."</pre>";
                foreach($slot_periods as $slot_emp => $slot_emp_periods){
                    
                    foreach($slot_emp_periods as $slot_det){
                        $extra_prev_slots = array();
                        $extra_after_slots = array();
                        //getting previous paste slots
                        extract_slots($slot_emp_periods, $slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $slot_det['date']);
                        //echo "<pre>".print_r($slot_det,1)."</pre>";
                        //echo "<pre>extra_prev_slots".print_r($extra_prev_slots,1)."</pre>";
                        //echo "<pre>extra_after_slots".print_r($extra_after_slots,1)."</pre>";
                        $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);

                        if($status !== TRUE){
                            $atl_status++;
                            $output = $status['atl_message'];
                            $atl_params = $status;
                            $global_failed = TRUE;
                            break;
                        }
                    }
                    if($atl_status > 0)
                        break;
                }

            }
        }
        $return_obj['atl'] =  $output;
        $return_obj['atl_params'] = $atl_params;
    }
    else if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
        //echo "3<br>";
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: Perform ATL warning when drop time slots with schema operation
        */
        $sel_date = trim($_REQUEST['date']);
        $from_option = trim($_REQUEST['from_option']);
        $days = explode('-', $_REQUEST['days']);
        array_pop($days);
        $from_year = date('o', strtotime($sel_date));
        $from_week = trim($_REQUEST['from_week']);
        $to_year = substr($_REQUEST['to_week'], 0, 4);
        $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
        
        $__slot_employee = trim($_REQUEST['employee']);
        $__slot_customer = trim($_REQUEST['customer']);
        $time_from = trim($_REQUEST['time_from']);
        $time_to = trim($_REQUEST['time_to']);
        //-----------------------------------
        $weeks = "'";
        $i = 0;
        $temp_to_week = $to_week;

        $atl_status = 0;
        $output = 'success';
        $atl_params = array();
        $extra_prev_slots = array();
        $extra_after_slots = array();
        if($to_year > $from_year) $to_week = 52;
        $paste_year = $from_year;
        for($i = $from_week; $i <= $to_week; $i++){
            $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
            $d = 0;
            foreach ($days as $day) {
                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                if ($time_from >= $time_to) {
                    $status = $obj_emp->checkATL($__slot_customer, $__slot_employee, $paste_date, $time_from, 24, '', 0, $extra_prev_slots);
                    //getting previous paste slots
                    $paste_slot = array(
                            'employee'  => $__slot_employee, 
                            'customer'  => $__slot_customer, 
                            'date'      => $paste_date, 
                            'time_from' => $time_from, 
                            'time_to'   => 24);
                    $extra_prev_slots[] = $paste_slot;
                    
                    if($status !== TRUE){
                        $atl_status++;
                        $output = $status['atl_message'];
                        $atl_params = $status;
                        break;
                    } else {
                        $nextday = date('Y-m-d', strtotime($paste_date . ' +1 day'));
                        $status = $obj_emp->checkATL($__slot_customer, $__slot_employee, $nextday, 0.00, $time_to, '', 0, $extra_prev_slots);
                        
                        $past_slot = array(
                                'employee'  => $__slot_employee, 
                                'customer'  => $__slot_customer, 
                                'date'      => $nextday, 
                                'time_from' => 0.00, 
                                'time_to'   => $time_to);
                        $extra_prev_slots[] = $paste_slot;

                        if($status !== TRUE){
                            $atl_status++;
                            $output = $status['atl_message'];
                            $atl_params = $status;
                            break;
                        }
                    }
                } else {
                    $status = $obj_emp->checkATL($__slot_customer, $__slot_employee, $paste_date, $time_from, $time_to, '', 0, $extra_prev_slots);

                    //getting previous paste slots
                    $past_slot = array(
                            'employee'  => $__slot_employee, 
                            'customer'  => $__slot_customer, 
                            'date'      => $paste_date, 
                            'time_from' => $time_from, 
                            'time_to'   => $time_to);
                    $extra_prev_slots[] = $past_slot;

                    if($status !== TRUE){
                        $atl_status++;
                        $output = $status['atl_message'];
                        $atl_params = $status;
                        break;
                    }
                }
                if($to_year > $from_year && $i == 52){
                    $i=1;
                    $to_week = $temp_to_week;
                    $paste_year = substr($_REQUEST['to_week'],0,4);
                }
                $d++;
            }
            if($atl_status > 0)
                break;
            $i++;
            $i += $from_option;
        }

        $return_obj['atl'] =  $output;
        $return_obj['atl_params'] = $atl_params;
    }
    else if(isset($_REQUEST['multiple']) && trim($_REQUEST['multiple']) != '' ){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: Perform ATL warning when drop time slots using multiple check and add button
        */
        $atl_status = 0;
        $output = 'success';
        $atl_params = array();
        
        $multiple_time_slot = explode(",", trim($_REQUEST['multiple']));
        if(!empty($multiple_time_slot)){
            $employee_to_add = ($_SESSION['user_role'] == 3 ? $_SESSION['user_id'] : trim($_REQUEST['employee']));
            $customer_to_add = ($_SESSION['user_role'] == 4 ? $_SESSION['user_id'] : trim($_REQUEST['customer']));
            $paste_date = $_REQUEST['date'];
            $extra_prev_slots = array();
            $extra_after_slots = array();
            if($employee_to_add != '' && $customer_to_add != ''){
                foreach ($multiple_time_slot as $time_slot) {
                    if(trim($time_slot) == '') continue;
                    $time_slot_values = explode("-", $time_slot);
                    $time_from = trim($time_slot_values[0]);
                    $time_to = trim($time_slot_values[1]);
                    
                    $status = $obj_emp->checkATL($employee_to_add, $customer_to_add, $paste_date, $time_from, $time_to, '', 0, $extra_prev_slots);

                    //getting previous paste slots
                    $past_slot = array(
                            'employee'  => $employee_to_add, 
                            'customer'  => $customer_to_add, 
                            'date'      => $paste_date, 
                            'time_from' => $time_from, 
                            'time_to'   => $time_to);
                    $extra_prev_slots[] = $past_slot;

                    if($status !== TRUE){
                        $atl_status++;
                        $output = $status['atl_message'];
                        $atl_params = $status;
                        break;
                    }
                }
            }
        }
        $return_obj['atl'] =  $output;
        $return_obj['atl_params'] = $atl_params;
    }
    else{
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: Perform ATL warning when drop time slots
        */
        if (isset($_REQUEST['time_from']) && isset($_REQUEST['time_to']) && $_REQUEST['time_from'] >= $_REQUEST['time_to']) {
            $output = 'success';
            $atl_params = array();
            $atl_status = $obj_emp->checkATL($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date'], number_format($_REQUEST['time_from'], 2), 24);
            if($atl_status !== TRUE){
                $output = $atl_status['atl_message'];
                $atl_params = $atl_status;
            } else {
                $extra_prev_slots = array(
                            array(
                                'employee'  => $_REQUEST['employee'], 
                                'customer'  => $_REQUEST['customer'], 
                                'date'      => $_REQUEST['date'], 
                                'time_from' => $_REQUEST['time_from'], 
                                'time_to'   => 24));
                $nextday = date('Y-m-d', strtotime($_REQUEST['date'] . ' +1 day'));
                $atl_status = $obj_emp->checkATL($_REQUEST['customer'], $_REQUEST['employee'], $nextday, 0.00, number_format($_REQUEST['time_to'], 2), '', 0, $extra_prev_slots);
                if($atl_status !== TRUE){
                    $output = $atl_status['atl_message'];
                    $atl_params = $atl_status;
                }
            }
            $return_obj['atl'] =  $output;
            $return_obj['atl_params'] = $atl_params;    
        } else {
            $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
            $atl_status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $_REQUEST['date'], number_format($slot_det['time_from'], 2), number_format($slot_det['time_to'], 2), $_REQUEST['id']);
            if($atl_status === TRUE)
                $return_obj['atl'] =  "success";
            else{
                $return_obj['atl'] = $atl_status['atl_message'];
                $return_obj['atl_params'] = $atl_status;
            }
        }
    }
    
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_emp'){
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    
    $atl_status = $obj_emp->checkATL($slot_det['customer'], $_REQUEST['select_emp'], $_REQUEST['date'], $slot_det['time_from'], $slot_det['time_to']);
    
    if($atl_status === TRUE)
        $return_obj['atl'] =  "success";
    else {
        $return_obj['atl'] = $atl_status['atl_message'];
        $return_obj['atl_params'] = $atl_status;
    }
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'swap'){
    $slot_det1 = $obj_emp->customer_employee_slot_details($_SESSION['swap']);
    $slot_det2 = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $atl_status1 = $obj_emp->checkATL($slot_det1['customer'], $slot_det1['employee'], $slot_det2['date'], $slot_det2['time_from'], $slot_det2['time_to'], $_REQUEST['id']);
    $atl_status2 = $obj_emp->checkATL($slot_det2['customer'], $slot_det2['employee'], $slot_det1['date'], $slot_det1['time_from'], $slot_det1['time_to'], $_SESSION['swap']);
    if($atl_status1 === TRUE && $atl_status2 === TRUE)
        $return_obj['atl'] =  "success";
    else{
        if($atl_status1 === TRUE) {
            $return_obj['atl'] =  $atl_status2['atl_message'];
            $return_obj['atl_params'] = $atl_status2;
        } else if($atl_status2 === TRUE) {
            $return_obj['atl'] =  $atl_status1['atl_message'];
            $return_obj['atl_params'] = $atl_status1;
        }
    }
}
else if(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'paste_select' || $_REQUEST['action'] == 'paste' || $_REQUEST['action'] == 'paste_select_day')){
    
    //$slot_ids = $_SESSION['copy_slot'];
    $slot_ids = explode(",", $obj_user->retrieve_from_temp_session(1));
    $slots = "";
    $i = 0;
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    
    if(!empty($slot_ids)){
        foreach($slot_ids as $slot_id){
            if($i != 0) $slots .= ",";
            $slots .= $slot_id;
            $i++;
        }

        $slot_dets = $obj_dona->customer_employee_multi_slot_details($slots, 1);
        $i=0;

        if(!empty($slot_dets)){
            $i=0;
            foreach($slot_dets as $slot_det){
                
                if($slot_det['customer'] == '' || $slot_det['employee'] == '') 
                    continue;
                $i++;
                // if($i!=1)continue;
                $extra_prev_slots = array();
                $extra_after_slots = array();
                $paste_date = '';
                if($_REQUEST['to_single_day'] || $_REQUEST['action'] == 'paste'){
                    $paste_date = $_REQUEST['date'];
                }else{
                    $paste_date = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0,4)."W".substr($_REQUEST['date'], 5,2).date("N", strtotime($slot_det['date']))));
                }
                extract_slots($slot_dets,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);
                //echo "<pre>".print_r($extra_prev_slots,1)."</pre>";
                $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);

                if($status !== TRUE){
                    $atl_status++;
                    $output = $status['atl_message'];
                    $atl_params = $status;
                }
        //        if($atl_status)
        //            break;
            }
        }
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
    //echo date('Y-m-d H:i:s', strtotime('2013-01-01 2.50.00'));
    
}
else if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'copy'){
    $copy_start_date = date('Y-m-d H:i:s', strtotime(substr($_REQUEST['cur_week'],0,4)."W".str_pad($_REQUEST['from_week'],2,'0',STR_PAD_LEFT).'1'));
    $copy_start_date_minus = date('Y-m-d H:i:s',strtotime($copy_start_date .' -1 day'));
    $copy_end_date = date('Y-m-d H:i:s', strtotime($copy_start_date_minus.' +'.str_pad($_REQUEST['no_of_weeks'],2,'0',STR_PAD_LEFT).' week'));
    $employees = explode('-', $_REQUEST['employees']);
    array_pop($employees);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $slot_dets = $obj_emp->get_copy_slots($copy_start_date, $copy_end_date, $employees, $days);
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            $extra_prev_slots = array();
            $extra_after_slots = array();
            $i = 0;
            do{
                $paste_year = substr($_REQUEST['to_week'],0,4);
                $paste_week = str_pad(substr($_REQUEST['to_week'],5), 2,'0',STR_PAD_LEFT);
                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.date("N", strtotime($slot_det['date']))));
                $paste_date = date('Y-m-d', strtotime($paste_date . ' +'.($i*7).' days'));

                extract_slots($slot_dets,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);


                $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);
                if($status !== TRUE){
                    $atl_status++;
                    $output = $status['atl_message'];
                    $atl_params = $status;
                    break;
                }
                $i++;
            }while($i < $_REQUEST['no_of_times']);


            if($atl_status >0)
                break;
        }
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;

}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'copy_multiple'){
    
    $weeks = "'";
    $i = 0;
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    //    $from_year = date('Y');
    $from_year = date('o', strtotime($_REQUEST['date']));
    $from_week = $_REQUEST['from_week'];
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    if($_REQUEST['to_single_slot'])
        $slot_dets[0] = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    else    
        $slot_dets = $obj_emp->timetable_customer_employee_slots_copiable_for_copy($_REQUEST['customer'], $_REQUEST['date']);
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            $extra_prev_slots = array();
            $extra_after_slots = array();
            if($to_year > $from_year)
                $to_week = 52;
            //            $paste_year = date('Y');
            $paste_year = $from_year;
            for($i = $from_week; $i <= $to_week; $i++){

                $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                $d = 0;
                foreach ($days as $day) {
                    $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                    //getting previous paste slots

                    extract_slots($slot_dets,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);

                    $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);

                    if($status !== TRUE){
                        $atl_status++;
                        $output = $status['atl_message'];
                        $atl_params = $status;
                        break;
                    }
                    if($to_year > $from_year && $i == 52){
                        $i=1;
                        $to_week = $temp_to_week;
                        $paste_year = substr($_REQUEST['to_week'],0,4);
                    }
                    $d++;
                }
                if($atl_status > 0)
                    break;
                $i++;
                $i += $_REQUEST['from_option'];
            }

            if($atl_status >0)
                break;
        }
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'release_atl') {
     
     $obj_emp->tables = array('atl_warnings');
     $obj_emp->fields = array('max(id) as id');
     $obj_emp->query_generate();
     $datas = $obj_emp->query_fetch();
     $obj_emp->tables = array('atl_warnings');
     $obj_emp->conditions = array('id = ?');
     $obj_emp->condition_values = array($datas[0]['id']);
     $obj_emp->query_delete();
}     
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_atl') {
     $obj_emp->saveATL($_REQUEST['employee'], $_REQUEST['date'], $_REQUEST['time_from'], $_REQUEST['time_to'], $_REQUEST['customer'], $_REQUEST['extra_time']);
     exit();
}     
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'multiple_slot_assign'){
    /**
     * Author: Shamsu
     * for: Perform ATL warning when schema assignment operation for employees 
    */
    $sel_date = trim($_REQUEST['date']);
    $sel_employee_to_assign = trim($_REQUEST['empl']);
    $from_option = trim($_REQUEST['from_option']);

    $sel_ids = trim($_REQUEST['ids']);
    $sel_slots_array = explode(',', $sel_ids);
    
    if(!empty($sel_slots_array)){
        foreach($sel_slots_array as $key => $val){
            if(trim($val) == '') unset ($sel_slots_array[$key]);
        }
    }
    
    //-----------------------------------
    $weeks = "'";
    $i = 0;
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $from_year = date('o', strtotime($sel_date));
    $from_week = trim($_REQUEST['from_week']);
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    
    $slot_dets = $obj_emp->get_multiple_slot_details($sel_slots_array, $sel_date);
    
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    
    $total_no_of_slots = count($slot_dets);
    for($x = 0 ; $x < $total_no_of_slots; $x++)
        $slot_dets[$x]['employee'] = $sel_employee_to_assign;
    
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            $extra_prev_slots = array();
            $extra_after_slots = array();
            if($to_year > $from_year) $to_week = 52;
            $paste_year = $from_year;
            for($i = $from_week; $i <= $to_week; $i++){
                $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                $d = 0;
                foreach ($days as $day) {
                    $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));

                    //getting previous paste slots
                    extract_slots($slot_dets,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);

                    $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);

                    if($status !== TRUE){
                        $atl_status++;
                        $output = $status['atl_message'];
                        $atl_params = $status;
                        break;
                    }
                    if($to_year > $from_year && $i == 52){
                        $i=1;
                        $to_week = $temp_to_week;
                        $paste_year = substr($_REQUEST['to_week'],0,4);
                    }
                    $d++;
                }
                if($atl_status > 0)
                    break;
                $i++;
                $i += $from_option;
            }
            if($atl_status > 0)
                break;
        }
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'type' && isset($_REQUEST['type']) && $_REQUEST['type'] == 10){
    /**
    * @author: Shamsudheen <shamsu@arioninfotech.com>
    * for: Perform ATL warning when slot type changed to personal meeting with meeting employees
    */
    $slot_from = $_REQUEST['slot_from'];
    $slot_to = $_REQUEST['slot_to'];
    $proposed_slot_type = $_REQUEST['type'];
    
    $time_from = $obj_dona->time_to_sixty($_REQUEST['time_from']);
    $time_to = $obj_dona->time_to_sixty($_REQUEST['time_to']);
    
    $personal_meeting_employees = array();
    if($proposed_slot_type == 10){
        $personal_meeting_emps = trim($_REQUEST['personal_meeting_emps']);
        $personal_meeting_employees = explode('||', $personal_meeting_emps);
    //        array_pop($personal_meeting_employees);
    }

    if ($time_to == 0)  $time_to = 24;
    
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    $extra_prev_slots = array();
    $extra_after_slots = array();
          
    if ($time_from >= $slot_from && $time_from <= $slot_to && $time_to >= $slot_from && $time_to <= $slot_to) {
        if(count($personal_meeting_employees)> 0 && $proposed_slot_type == 10){
            $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
            $this_customer = ($slot_det['customer'] != '' ? $slot_det['customer'] : NULL);
            foreach($personal_meeting_employees as $this_emp){
                if($this_emp != $slot_det['employee']){  //check is this not current slot?
                    $exist_slot = array();
                    
                    $tmp_exist_slot = $obj_emp->get_intersect_slots($slot_det['date'], $time_from, $time_to, $this_emp);
                    if($slot_det['employee'] == '' && empty($tmp_exist_slot)){
                        $exist_slot = $obj_emp->get_intersect_slots($slot_det['date'], $time_from, $time_to, NULL);
                        $slot_det['employee '] = $this_emp;
                    }else
                        $exist_slot = $tmp_exist_slot;
                    
                    if (!empty($exist_slot)) {
                        foreach($exist_slot as $keyindex => $this_exist_slot){
                            if($keyindex > 0){
                                if($exist_slot[$keyindex]['time_from'] < $exist_slot[$keyindex - 1]['time_to']){
                                    $exist_slot[$keyindex]['time_from'] = $exist_slot[$keyindex - 1]['time_to'];
                                    if($exist_slot[$keyindex]['time_to'] >= $exist_slot[$keyindex - 1]['time_to']){
                                        unset($exist_slot[$keyindex]);
                                    }
                                }
                            }
                            $exist_slot  = array_values($exist_slot);       //re-arrange array index values
                        }
                        if(!empty($exist_slot)){
                            foreach($exist_slot as $keyindex => $this_exist_slot){
                                $get_alt_slots_for_processing = $obj_dona->get_PM_time_slots_for_atl_checking($exist_slot, $keyindex, $time_from, $time_to, $this_customer);
                                $atl_slots = $get_alt_slots_for_processing['atl_slots'];
                                $atl_exception_slot_ids = $get_alt_slots_for_processing['exception_slot_ids'];
                                if (!empty($atl_slots)){
                                    $atl_slots = $atl_slots[0];
                                    $status = $obj_emp->checkATL($atl_slots['customer'], $atl_slots['employee'], $atl_slots['date'], $atl_slots['time_from'], $atl_slots['time_to'], $atl_exception_slot_ids);
                                    if($status !== TRUE){
                                        $atl_status++;
                                        $output = $status['atl_message'];
                                        $atl_params = $status;
                                        break;
                                    }
                                }
                                if($this_exist_slot['customer'] != ''){
                                    $status = $obj_emp->checkATL($this_exist_slot['customer'], $this_emp, $this_exist_slot['date'], $this_exist_slot['time_from'], $this_exist_slot['time_to']);
                                    if($status !== TRUE){
                                        $atl_status++;
                                        $output = $status['atl_message'];
                                        $atl_params = $status;
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        //else part is for creating new timeslot with new employee and slot credentials
                        $available_user = $obj_emp->get_available_users($this_customer, $time_from, $time_to, $slot_det['date'], $this_emp);
                        if (!empty($available_user)) {
                            $status = $obj_emp->checkATL($this_customer, $this_emp, $slot_det['date'], (float) $time_from, (float) $time_to);
                            if($status !== TRUE){
                                $atl_status++;
                                $output = $status['atl_message'];
                                $atl_params = $status;
                                break;
                            }
                        }
                    }
                }
                if($atl_status > 0) break;
            }
        }
    }
    
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_duration'){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: Perform ATL warning when drop time slots
    */
    if($_REQUEST['slot_cust'] != '' && $_REQUEST['slot_emp'] != ''){
        $atl_status = $obj_emp->checkATL($_REQUEST['slot_cust'], $_REQUEST['slot_emp'], $_REQUEST['date'], number_format($_REQUEST['time_from'], 2), number_format($_REQUEST['time_to'], 2), $_REQUEST['id']);
        if($atl_status === TRUE)
            $return_obj['atl'] =  "success";
        else {
            $return_obj['atl'] = $atl_status['atl_message'];
            $return_obj['atl_params'] = $atl_status;
        }
    } else 
        $return_obj['atl'] =  "success";

}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_schedule_template'){
    /**
     * @author: Shamsudheen <shamsu@arioninfotech.com>
     * for: Perform ATL warning when save schedule templates
    */
    
    /*
    
    $postdataDate = array_unique($_REQUEST['postdataDate']);
    $customer_name = $_REQUEST["customer"];
    
    $previous_slot_schedules_ids = array();
    $previous_slot_schedules_ids_string = '';
    if(!empty($postdataDate)){
        require_once('class/newcustomer.php');
        $obj_customer = new newcustomer();
    
        foreach($postdataDate as $date){
                $date_slot_details = $obj_customer->get_timeslots_by_customer_date($customer_name, $date);
                if(!empty($date_slot_details)){
                    foreach ($date_slot_details as $data) 
                        $previous_slot_schedules_ids[] = $data['id'];
                }
        }
    }
    //    echo "<pre>\n".print_r($previous_slot_schedules_ids, 1)."</pre>";
    if(!empty($previous_slot_schedules_ids)){
        $previous_slot_schedules_ids_string = implode(',', $previous_slot_schedules_ids);
    }*/
    
    $slot_dets = array();
    if(!empty($_REQUEST['postdata'])){
        foreach($_REQUEST['postdata'] as $postdata){
            if($postdata != ''){
                $data_values = explode(",",$postdata);
                if($data_values[0] == '' || $data_values[1] == '') continue;
                $slot_dets[] = array(
                                'employee'      =>  $data_values[0],
                                'customer'      =>  $data_values[1], 
                                'date'          =>  $data_values[2], 
                                'time_from'     =>  $data_values[3], 
                                'time_to'       =>  $data_values[4], 
                                'type'          =>  $data_values[5], 
                                'status'        =>  $data_values[6], 
                                'comment'       =>  $data_values[7], 
                                'alloc_emp'     =>  $data_values[8], 
                                'relation_id'   =>  $data_values[9],
                                'fkkn'          =>  $data_values[10]);
            }
        }
    }
    
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    if(!empty($slot_dets)){
        $i=0;
        $extra_prev_slots = array();
        $extra_after_slots = array();
        foreach($slot_dets as $slot_det){
            $i++;
            $paste_date = $slot_det['date'];
            
            extract_slots($slot_dets,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);
            $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);
            
            //            echo "<br>---".$slot_det['employee']."-----$status-----";
            if($status !== TRUE){
                $atl_status++;
                $output = $status['atl_message'];
                $atl_params = $status;
            }
            if($atl_status > 0) break;
        }
    }
    
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
    
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'slot_approve_candg'){
    /**
     * @author: Niyaz
     * for: Perform ATL warning when save approval of candg slots
    */
    if($_REQUEST['approve_multi'] == 1){
        $id_slots = explode("-", $_REQUEST['ids']);
        $tot_id_count = count($id_slots);
        for($i=0 ; $i < $tot_id_count ; $i++){
            $slot_det = $obj_emp->customer_employee_slot_details($id_slots[$i]);
            $atl_status = $obj_emp->checkATL( $slot_det['customer'], $slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to']);
            if($atl_status === TRUE)
                continue;
            else{
        //                echo $atl_status;
                $return_obj['atl'] = $atl_status['atl_message'];
        //                $return_obj['atl_exceed_hours'] = $atl_status['atl_exceed_hours'];
                $return_obj['atl_params'] = $atl_status;
                break;
            }
        }
        if($i == $tot_id_count){
        //            echo "success";
            $return_obj['atl'] = "success";
        }
    }else{
        $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
        $atl_status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $_REQUEST['date'], $slot_det['time_from'], $slot_det['time_to']);
        if($atl_status === TRUE)
            $return_obj['atl'] =  "success";
        else {
            $return_obj['atl'] = $atl_status['atl_message'];
            $return_obj['atl_params'] = $atl_status;
        }
    }
    

}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'modify_slot'){
    
    /**
     * @author: Shamsudheen <shamsu@arioninfotech.com>
     * for: Perform ATL warning when editing slot
    */
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();

    $customer_to_add = trim($_REQUEST['slot_customer']) != '' ? trim($_REQUEST['slot_customer']) : NULL;
    $employee_to_add = trim($_REQUEST['slot_employee']) != '' ? trim($_REQUEST['slot_employee']) : NULL;

    $selected_date = trim($_REQUEST['slot_date']);
    $slot_periods = array();
    $any_slot_enters_to_next_day = FALSE;

    $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));

    $tmp_time_from  = $obj_dona->time_to_sixty(trim($_REQUEST['slot_timefrom']));
    $tmp_time_to    = $obj_dona->time_to_sixty(trim($_REQUEST['slot_time_to']));
    if($tmp_time_to == 0) $tmp_time_to = 24;

    if($tmp_time_from != false && $tmp_time_to != false && $customer_to_add != '' && $employee_to_add != ''){
        //if the slot enters next day
        if($tmp_time_from >= $tmp_time_to){
            $any_slot_enters_to_next_day = TRUE;
            $slot_periods[$employee_to_add][] = array(
                    'date'      => $selected_date,
                    'time_from' => $tmp_time_from, 
                    'time_to'   => 24, 
                    'customer'  => $customer_to_add,
                    'employee'  => $employee_to_add,
                    'type'      => trim($_REQUEST['slot_type']) 
            );
            $slot_periods[$employee_to_add][] = array(
                    'date'      => $next_date,
                    'time_from' => 0, 
                    'time_to'   => $tmp_time_to, 
                    'customer'  => $customer_to_add,
                    'employee'  => $employee_to_add,
                    'type'      => trim($_REQUEST['slot_type']) 
            );
        } else {
            $slot_periods[$employee_to_add][] = array( 
                    'date'      => $selected_date,
                    'time_from' => $tmp_time_from, 
                    'time_to'   => $tmp_time_to, 
                    'customer'  => $customer_to_add,
                    'employee'  => $employee_to_add,
                    'type'      => trim($_REQUEST['slot_type']) 
                );
        }
    }
    
    //PM employees
    if(trim($_REQUEST['slot_type']) == 10 && $tmp_time_from != false && $tmp_time_to != false && $customer_to_add != ''){
        $personal_meeting_emps = trim($_REQUEST['personal_meeting_emps']);
        $personal_meeting_employees = explode('||', $personal_meeting_emps);
        
        //removing proposed slot employee name from personal meeting employees list if exists
        if (count($personal_meeting_employees) > 0 && $employee_to_add != ''){
            foreach($personal_meeting_employees as $pkey => $pemp){
                if($pemp == $employee_to_add) unset($personal_meeting_employees[$pkey]);
            }
            $personal_meeting_employees = array_values($personal_meeting_employees);
        }
        
        if (count($personal_meeting_employees) > 0) {
            foreach ($personal_meeting_employees as $this_pm_emp) {
                //if the slot enters next day
                if($tmp_time_from >= $tmp_time_to){
                    $any_slot_enters_to_next_day = TRUE;
                    $slot_periods[$this_pm_emp][] = array(
                            'date'      => $selected_date,
                            'time_from' => $tmp_time_from, 
                            'time_to'   => 24, 
                            'customer'  => $customer_to_add,
                            'employee'  => $this_pm_emp,
                            'type'      => trim($_REQUEST['slot_type']) 
                    );
                    $slot_periods[$this_pm_emp][] = array(
                            'date'      => $next_date,
                            'time_from' => 0, 
                            'time_to'   => $tmp_time_to, 
                            'customer'  => $customer_to_add,
                            'employee'  => $this_pm_emp,
                            'type'      => trim($_REQUEST['slot_type']) 
                    );
                } else {
                    $slot_periods[$this_pm_emp][] = array( 
                            'date'      => $selected_date,
                            'time_from' => $tmp_time_from, 
                            'time_to'   => $tmp_time_to, 
                            'customer'  => $customer_to_add,
                            'employee'  => $this_pm_emp,
                            'type'      => trim($_REQUEST['slot_type']) 
                        );
                }
            }
        }
    }

    $global_failed = false;
    if(!empty($slot_periods)){

        if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
            $sel_date = $selected_date;
            $from_option = trim($_REQUEST['from_option']);
            $days = explode('-', $_REQUEST['days']);
            array_pop($days);
            $from_year = date('o', strtotime($sel_date));
            $from_week = trim($_REQUEST['from_week']);
            $to_year = substr($_REQUEST['to_week'], 0, 4);
            $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);

            $weeks = "'";
            $i = 0;
            $temp_to_week = $to_week;

            foreach($slot_periods as $slot_emp => $slot_emp_periods){
                $extra_prev_slots = array();
                $extra_after_slots = array();

                foreach($slot_emp_periods as $slot_det){
                    if($to_year > $from_year) $to_week = 52;
                    $paste_year = $from_year;
                    for($i = $from_week; $i <= $to_week; $i++){
                        $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                        foreach ($days as $day) {
                            $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                            if ($slot_det['time_from'] >= $slot_det['time_to']) {
                                $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], 24, $_REQUEST['slot_id'], 0, $extra_prev_slots);
                                //getting previous paste slots
                                $paste_slot = array(
                                        'employee'  => $slot_det['employee'], 
                                        'customer'  => $slot_det['customer'], 
                                        'date'      => $paste_date, 
                                        'time_from' => $slot_det['time_from'], 
                                        'time_to'   => 24);
                                $extra_prev_slots[] = $paste_slot;

                                if($status !== TRUE){
                                    $atl_status++;
                                    $output = $status['atl_message'];
                                    $atl_params = $status;
                                    break;
                                } else {
                                    $nextday = date('Y-m-d', strtotime($paste_date . ' +1 day'));
                                    $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $nextday, 0.00, $slot_det['time_to'], $_REQUEST['slot_id'], 0, $extra_prev_slots);

                                    $past_slot = array(
                                            'employee'  => $slot_det['employee'], 
                                            'customer'  => $slot_det['customer'], 
                                            'date'      => $nextday, 
                                            'time_from' => 0.00, 
                                            'time_to'   => $slot_det['time_to']);
                                    $extra_prev_slots[] = $paste_slot;

                                    if($status !== TRUE){
                                        $atl_status++;
                                        $output = $status['atl_message'];
                                        $atl_params = $status;
                                        break;
                                    }
                                }
                            } else {
                                $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], $_REQUEST['slot_id'], 0, $extra_prev_slots);

                                //getting previous paste slots
                                $past_slot = array(
                                        'employee'  => $slot_det['employee'], 
                                        'customer'  => $slot_det['customer'], 
                                        'date'      => $paste_date, 
                                        'time_from' => $slot_det['time_from'], 
                                        'time_to'   => $slot_det['time_to']);
                                $extra_prev_slots[] = $past_slot;

                                if($status !== TRUE){
                                    $atl_status++;
                                    $output = $status['atl_message'];
                                    $atl_params = $status;
                                    break;
                                }
                            }
                            if($to_year > $from_year && $i == 52){
                                $i=1;
                                $to_week = $temp_to_week;
                                $paste_year = substr($_REQUEST['to_week'],0,4);
                            }
                        }
                        if($atl_status > 0)
                            break;
                        $i++;
                        $i += $from_option;
                    }
                    if($atl_status > 0)
                        break;
                }
                if($atl_status > 0)
                    break;
            }
        }

        else {
            foreach($slot_periods as $slot_emp => $slot_emp_periods){
                $extra_prev_slots = array();
                $extra_after_slots = array();
                foreach($slot_emp_periods as $slot_det){

                    //getting previous paste slots
                    extract_slots($slot_emp_periods, $slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $slot_det['date']);

                    $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $_REQUEST['slot_id'], 0, $extra_prev_slots);

                    if($status !== TRUE){
                        $atl_status++;
                        $output = $status['atl_message'];
                        $atl_params = $status;
                        $global_failed = TRUE;
                        break;
                    }
                }
                if($atl_status > 0)
                    break;
            }
        }
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
}
/*else if($_REQUEST['action'] == 'right_click_multi_assign'){
    $slot_ids = explode('-',$_REQUEST['ids']);
    $slots = "";
    $i = 0;
    $_REQUEST['multi']foreach($slot_ids as $slot_id){
        if($i != 0) $slots .= ",";
        $slots .= $slot_id;
        $i++;
    }
    
    $slot_dets = $obj_dona->customer_employee_multi_slot_details($slots, 1);
    
    $atl_status = 0;
    $output = 'success';
    $atl_params = array();
    $i=0;
    foreach($slot_dets as $slot_det){
        
        if($slot_det['customer'] == '' || $slot_det['employee'] == '') 
            continue;
        $i++;
        $extra_prev_slots = array();
        $extra_after_slots = array();
        extract_slots($slot_dets,$slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $extra_prev_slots, $extra_after_slots, $paste_date);
        $status = $obj_emp->checkATL($slot_det['customer'], $slot_det['employee'], $paste_date, $slot_det['time_from'], $slot_det['time_to'], '', 0, $extra_prev_slots);
        
        if($status !== TRUE){
            $atl_status++;
            $output = $status['atl_message'];
            $atl_params = $status;
        }
    //        if($atl_status)
    //            break;
    }
    $return_obj['atl'] =  $output;
    $return_obj['atl_params'] = $atl_params;
}
else if($_REQUEST['action'] == 'right_click_paste'){
    
}*/
echo json_encode($return_obj);
////////////////////////////Function ////////////////////////
function extract_slots($slot_dets,$employee, $date, $time_from, $time_to, &$extra_prev_slots, &$extra_after_slots, $paste_date){
    $obj_emp = new employee();
    $date_from = strtotime($date." ".$time_from.".00");
    $date_to = strtotime($date." ".$time_to.".00");
    $paste_date_org = $paste_date;
    $week = date('o', strtotime($paste_date))."|".date('W', strtotime($paste_date));
    $day_time = $obj_emp->get_employee_start_day($employee);
    $day = intval(substr($day_time,0,1));
    $time = floatval(substr($day_time, 1));
    $day_start = date('Y-m-d H:i:s', strtotime($date." ".$time.".0"));
    $day_end = date('Y-m-d H:i:s',strtotime($day_start .' +1 day'));
    $week_start = date('Y-m-d H:i:s', strtotime(date('Y', strtotime($date))."W".date('W', strtotime($date)).$day)+$time*60*60);
    if(date('N', strtotime($date)) < $day)
        $week_start = date('Y-m-d H:i:s',strtotime($week_start.' -7 days'));
    $week_end = date('Y-m-d H:i:s',strtotime($week_start.' +7 days'));
    
    if(!empty($slot_dets)){
        foreach ($slot_dets as $slot_det){
            $slot_date_from = strtotime($slot_det['date']." ".$slot_det['time_from'].".00");
            $slot_date_to = strtotime($slot_det['date']." ".$slot_det['time_to'].".00");
            
            if((isset($_REQUEST['to_single_day']) && $_REQUEST['to_single_day'] && $_REQUEST['action'] != 'paste_select_day' ) || (isset($_REQUEST['action']) && $_REQUEST['action'] == 'paste'))
                    $paste_date = $paste_date;
            else
                    $paste_date = date('Y-m-d', strtotime(substr($week,0,4)."W".substr($week, 5,2).date("N", strtotime($slot_det['date']))));
            //echo $paste_date."-".$paste_date_org."<br>";    
            if($_REQUEST['action'] == 'paste_select_day'){
                if(strtotime($paste_date) < strtotime($paste_date_org))
                    continue;
            }    
            $slot_det['date'] = $paste_date; 
            if($slot_det['employee'] == $employee && ($slot_date_to <= $date_from || $slot_date_from >= $date_to) && ($slot_date_to > strtotime($week_start) && $slot_date_from < strtotime($week_end))){
                $extra_prev_slots[] = $slot_det;
            } 
        }
    }
    //echo "<pre>".print_r($extra_prev_slots,1)."</pre>";
    return TRUE;
}
?>