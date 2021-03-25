<?php
/**
 * Author: Shamsudheen
 * for: check inconvenient timing with new time from and time_to entries
 * Used In: gdschema monthly view => manual slot entry
*/
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("gdschema.xml", 'messages.xml'), FALSE);
$obj_emp   = new employee();
$obj_dona   = new dona();

$return_obj = array();
//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
/*if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
    $sel_date       = trim($_REQUEST['selected_date']);
    $sel_days       = explode('-', trim($_REQUEST['days']));
//    array_pop($sel_days);
    $from_week  = trim($_REQUEST['from_week']);
    $to_week    = trim($_REQUEST['to_week']);
    $from_option= trim($_REQUEST['from_option']);
    
    $any_slot_enters_to_next_day = FALSE;
    $customer_slots = array('_no_customer_' => array());
    foreach($_REQUEST['time_slots'] as $time_slot){

        $tmp_time_from  = $obj_dona->time_to_sixty(trim($time_slot['time_from']));
        $tmp_time_to    = $obj_dona->time_to_sixty(trim($time_slot['time_to']));
        if($tmp_time_to == 0) $tmp_time_to = 24;

        if($tmp_time_from != '' && $tmp_time_to != ''){
            //if the slot enters next day
            if($tmp_time_from >= $tmp_time_to) $any_slot_enters_to_next_day = TRUE;

            $slot_periods[] = array( 'time_from' => $tmp_time_from, 'time_to' => $tmp_time_to );

            if($time_slot['customer'] != '')
                $customer_slots[$time_slot['customer']][] = array( 'time_from' => $tmp_time_from, 'time_to' => $tmp_time_to );
            else
                $customer_slots['_no_customer_'][] = array( 'time_from' => $tmp_time_from, 'time_to' => $tmp_time_to );
        }
    }
    if($sel_date == ''){
            $return_obj['transaction'] = FALSE;
            $return_obj['error_reason'] = $smarty->translate['invalid_date'];
    }else if(empty($slot_periods)){
            $return_obj['transaction'] = FALSE;
            $return_obj['error_reason'] = $smarty->translate['incomplete_slot_times'];
    }else {
            $return_obj['transaction'] = TRUE;

            $time_flag = 1;
            $time_flag_next = 1;
            $slot_split_time_flag = 0;
            $slot_split_time_flag_next = 0;
                
            $customer_inconvenients = array();
            
            $first_slot_date = $sel_date;
            $from_week = str_pad($from_week, 2,'0', STR_PAD_LEFT);
            $to_week = str_pad($to_week, 2,'0', STR_PAD_LEFT);
        
            foreach($customer_slots as $customer_id => $c_slot_periods){
                
                $slot_customer = ($customer_id != '_no_customer_' ? $customer_id : NULL);
                if(!empty($c_slot_periods)){
                    foreach($c_slot_periods as $slot_period){
                        
                        $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
                        $paste_year = substr($to_week, 0, 4);
                        $paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
                        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
                        $selected_date = $paste_start_date;
                        
                        while (strtotime($selected_date) <= strtotime($paste_end_date)) {
                            if (in_array((date('N', strtotime($selected_date)) % 7), $sel_days)) {
                        
                                $tmp_time_flag = 1;
                                $tmp_time_flag_next = 1;

                                $time_from = $slot_period['time_from'];
                                $time_to = $slot_period['time_to'];
                                
                                $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));

                                if(!isset($customer_inconvenients[$customer_id][$selected_date])){
                                    $customer_inconvenients[$customer_id][$selected_date] = $obj_emp->get_inconvenient_on_a_day_for_customer($selected_date, $slot_customer, 3);
        //                            echo "<pre>[$customer_id][$selected_date] - ".print_r($customer_inconvenients[$customer_id][$selected_date], 1)."</pre>";
                                }
                                if($time_from >= $time_to){ //if the slot enters next day
                                    
                                    if(!isset($customer_inconvenients[$customer_id][$next_date])){
                                        $customer_inconvenients[$customer_id][$next_date] = $obj_emp->get_inconvenient_on_a_day_for_customer($next_date, $slot_customer, 3);
                                    }
                                }

                                if($time_from >= $time_to){ //if the slot enters next day
                                    $tmp_time_flag = 0;

                                    if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                        foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                            if(((float) $time_from >= (float)$inconv_timing['time_from'] && (float) $time_from < (float)$inconv_timing['time_to'])
                                                && 
                                               (24 > (float)$inconv_timing['time_from'] && 24 <= (float)$inconv_timing['time_to'])){
                                                    $tmp_time_flag = 1;
                                            }
                                        }
                                    }
                                    $tmp_time_flag_next = 0;
                                    if(!empty($customer_inconvenients[$customer_id][$next_date])){
                                        foreach ($customer_inconvenients[$customer_id][$next_date] as $item => $inconv_timing ){
                                            if((0 >= (float) $inconv_timing['time_from'] && 0 < (float) $inconv_timing['time_to'])
                                                && 
                                               ((float) $time_to > (float)$inconv_timing['time_from'] && (float) $time_to <= (float)$inconv_timing['time_to'])){
                                                    $tmp_time_flag_next = 1;
                                            }
                                        }
                                    }


                                    //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                                    if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                        foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                            if(((float) $inconv_timing['time_from'] >= (float) $time_from && (float) $inconv_timing['time_from'] <= 24)
                                                || 
                                               ((float) $inconv_timing['time_to'] >= (float) $time_from && (float) $inconv_timing['time_to'] <= 24)){
                                                    $slot_split_time_flag = 1;
                                            }
                                        }
                                    }

                                    if(!empty($customer_inconvenients[$customer_id][$next_date])){
                                        foreach ($customer_inconvenients[$customer_id][$next_date] as $item => $inconv_timing){
                                            if(((float) $inconv_timing['time_from'] >= 0 && (float) $inconv_timing['time_from'] <= (float) $time_to)
                                                || 
                                               ((float) $inconv_timing['time_to'] >= 0 && (float) $inconv_timing['time_to'] <= (float) $time_to)){
                                                    $slot_split_time_flag_next = 1;
                                            }
                                        }
                                    }

                                }
                                else {
                                    //if the slot time same day

                                    $tmp_time_flag = 0;
                                    if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                        foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                            if(((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to'])
                                                && 
                                               ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])){
                                                    $tmp_time_flag = 1;
                                            }
                                        }
                                    }
                                    //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                                    if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                        foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                            if(((float) $inconv_timing['time_from'] >= (float) $time_from && (float) $inconv_timing['time_from'] <= (float) $time_to)
                                                || 
                                               ((float) $inconv_timing['time_to'] >= (float) $time_from && (float) $inconv_timing['time_to'] <= (float) $time_to)){
                                                    $slot_split_time_flag = 1;
                                            }
                                        }
                                    }
                                }

                                $time_flag      = ($time_flag == 1 && $tmp_time_flag == 1) ? 1: 0;
                                $time_flag_next = ($time_flag_next == 1 && $tmp_time_flag_next == 1) ? 1: 0;
                            }

                            if (date('N', strtotime($selected_date)) == 7)
                                $selected_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +' . $from_option . ' week'));
                            $selected_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day'));
                        }
                    }
                }
            }

            $return_obj['time_flag'] = $time_flag;
            $return_obj['time_flag_next'] = $time_flag_next;
            $return_obj['slot_split_time_flag'] = $slot_split_time_flag;
            $return_obj['slot_split_time_flag_next'] = $slot_split_time_flag_next;
        }
}
else */
if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'multiple_add'){
    
    $selected_date = trim($_REQUEST['selected_date']);
    $slot_periods = $slot_periods_next_day = array();
    if($selected_date == ''){
        $return_obj['transaction'] = FALSE;
        $return_obj['error_reason'] = $smarty->translate['invalid_date'];
    }
    elseif(!empty($_REQUEST['time_slots'])){
        
        $any_slot_enters_to_next_day = FALSE;
        $customer_slots = array('_no_customer_' => array());
        foreach($_REQUEST['time_slots'] as $time_slot){

            $tmp_time_from  = $obj_dona->time_to_sixty(trim($time_slot['time_from']));
            $tmp_time_to    = $obj_dona->time_to_sixty(trim($time_slot['time_to']));
            if($tmp_time_to == 0) $tmp_time_to = 24;

            if($tmp_time_from != '' && $tmp_time_to != ''){
                //if the slot enters next day
                if($tmp_time_from >= $tmp_time_to) $any_slot_enters_to_next_day = TRUE;
                
                $slot_periods[] = array( 'time_from' => $tmp_time_from, 'time_to' => $tmp_time_to );
                
                if($time_slot['customer'] != '')
                    $customer_slots[$time_slot['customer']][] = array( 'time_from' => $tmp_time_from, 'time_to' => $tmp_time_to );
                else
                    $customer_slots['_no_customer_'][] = array( 'time_from' => $tmp_time_from, 'time_to' => $tmp_time_to );
            }
        }
//        echo "<pre>".print_r($customer_slots, 1)."</pre>";

        if(empty($slot_periods)){
            $return_obj['transaction'] = FALSE;
            $return_obj['error_reason'] = $smarty->translate['incomplete_slot_times'];
        }else {
            $return_obj['transaction'] = TRUE;

            $time_flag = 1;
            $time_flag_next = 1;
            $slot_split_time_flag = 0;
            $slot_split_time_flag_next = 0;
                
            $customer_inconvenients = array();
            
            //weekly operation
            if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
                $sel_days       = explode('-', trim($_REQUEST['days']));
                $from_week  = trim($_REQUEST['from_week']);
                $to_week    = trim($_REQUEST['to_week']);
                $from_option= trim($_REQUEST['from_option']);
                
                $first_slot_date = $selected_date;
                $from_week = str_pad($from_week, 2,'0', STR_PAD_LEFT);
                $to_week = str_pad($to_week, 2,'0', STR_PAD_LEFT);

                foreach($customer_slots as $customer_id => $c_slot_periods){

                    $slot_customer = ($customer_id != '_no_customer_' ? $customer_id : NULL);
                    if(!empty($c_slot_periods)){
                        foreach($c_slot_periods as $slot_period){

//                            $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
                            $paste_start_date = $first_slot_date;
                            $paste_year = substr($to_week, 0, 4);
                            $paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
                            $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
                            $selected_date = $paste_start_date;

                            while (strtotime($selected_date) <= strtotime($paste_end_date)) {
                                if (in_array((date('N', strtotime($selected_date)) % 7), $sel_days)) {

                                    $tmp_time_flag = 1;
                                    $tmp_time_flag_next = 1;

                                    $time_from = $slot_period['time_from'];
                                    $time_to = $slot_period['time_to'];

                                    $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));

                                    if(!isset($customer_inconvenients[$customer_id][$selected_date])){
                                        $customer_inconvenients[$customer_id][$selected_date] = $obj_emp->get_inconvenient_on_a_day_for_customer($selected_date, $slot_customer, 3);
            //                            echo "<pre>[$customer_id][$selected_date] - ".print_r($customer_inconvenients[$customer_id][$selected_date], 1)."</pre>";
                                    }
                                    if($time_from >= $time_to){ //if the slot enters next day

                                        if(!isset($customer_inconvenients[$customer_id][$next_date])){
                                            $customer_inconvenients[$customer_id][$next_date] = $obj_emp->get_inconvenient_on_a_day_for_customer($next_date, $slot_customer, 3);
                                        }
                                    }

                                    if($time_from >= $time_to){ //if the slot enters next day
                                        $tmp_time_flag = 0;

                                        if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                            foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                                if(((float) $time_from >= (float)$inconv_timing['time_from'] && (float) $time_from < (float)$inconv_timing['time_to'])
                                                    && 
                                                   (24 > (float)$inconv_timing['time_from'] && 24 <= (float)$inconv_timing['time_to'])){
                                                        $tmp_time_flag = 1;
                                                }
                                            }
                                        }
                                        $tmp_time_flag_next = 0;
                                        if(!empty($customer_inconvenients[$customer_id][$next_date])){
                                            foreach ($customer_inconvenients[$customer_id][$next_date] as $item => $inconv_timing ){
                                                if((0 >= (float) $inconv_timing['time_from'] && 0 < (float) $inconv_timing['time_to'])
                                                    && 
                                                   ((float) $time_to > (float)$inconv_timing['time_from'] && (float) $time_to <= (float)$inconv_timing['time_to'])){
                                                        $tmp_time_flag_next = 1;
                                                }
                                            }
                                        }


                                        //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                                        if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                            foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                                if(((float) $inconv_timing['time_from'] > (float) $time_from && (float) $inconv_timing['time_from'] < 24)
                                                    || 
                                                   ((float) $inconv_timing['time_to'] > (float) $time_from && (float) $inconv_timing['time_to'] < 24)){
                                                        $slot_split_time_flag = 1;
                                                }
                                            }
                                        }

                                        if(!empty($customer_inconvenients[$customer_id][$next_date])){
                                            foreach ($customer_inconvenients[$customer_id][$next_date] as $item => $inconv_timing){
                                                if(((float) $inconv_timing['time_from'] > 0 && (float) $inconv_timing['time_from'] < (float) $time_to)
                                                    || 
                                                   ((float) $inconv_timing['time_to'] > 0 && (float) $inconv_timing['time_to'] < (float) $time_to)){
                                                        $slot_split_time_flag_next = 1;
                                                }
                                            }
                                        }

                                    }
                                    else {
                                        //if the slot time same day

                                        $tmp_time_flag = 0;
                                        if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                            foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                                if(((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to'])
                                                    && 
                                                   ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])){
                                                        $tmp_time_flag = 1;
                                                }
                                            }
                                        }
                                        //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                                        if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                            foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                                if(((float) $inconv_timing['time_from'] > (float) $time_from && (float) $inconv_timing['time_from'] < (float) $time_to)
                                                    || 
                                                   ((float) $inconv_timing['time_to'] > (float) $time_from && (float) $inconv_timing['time_to'] < (float) $time_to)){
                                                        $slot_split_time_flag = 1;
                                                }
                                            }
                                        }
                                    }

                                    $time_flag      = ($time_flag == 1 && $tmp_time_flag == 1) ? 1: 0;
                                    $time_flag_next = ($time_flag_next == 1 && $tmp_time_flag_next == 1) ? 1: 0;
                                }

                                if (date('N', strtotime($selected_date)) == 7)
                                    $selected_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +' . $from_option . ' week'));
                                $selected_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day'));
                            }
                        }
                    }
                }
            }
            
            //without weekly operation
            else{
                $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));

                foreach($customer_slots as $customer_id => $c_slot_periods){

                    $slot_customer = ($customer_id != '_no_customer_' ? $customer_id : NULL);
                    if(!empty($c_slot_periods)){
                        foreach($c_slot_periods as $slot_period){

                            $tmp_time_flag = 1;
                            $tmp_time_flag_next = 1;

                            $time_from = $slot_period['time_from'];
                            $time_to = $slot_period['time_to'];

                            if(!isset($customer_inconvenients[$customer_id][$selected_date])){
                                $customer_inconvenients[$customer_id][$selected_date] = $obj_emp->get_inconvenient_on_a_day_for_customer($selected_date, $slot_customer, 3);
    //                            echo "<pre>[$customer_id][$selected_date] - ".print_r($customer_inconvenients[$customer_id][$selected_date], 1)."</pre>";
                            }
                            if($time_from >= $time_to){ //if the slot enters next day
                                if(!isset($customer_inconvenients[$customer_id][$next_date])){
                                    $customer_inconvenients[$customer_id][$next_date] = $obj_emp->get_inconvenient_on_a_day_for_customer($next_date, $slot_customer, 3);
                                }
                            }

                            if($time_from >= $time_to){ //if the slot enters next day
                                $tmp_time_flag = 0;

                                if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                    foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                        if(((float) $time_from >= (float)$inconv_timing['time_from'] && (float) $time_from < (float)$inconv_timing['time_to'])
                                            && 
                                           (24 > (float)$inconv_timing['time_from'] && 24 <= (float)$inconv_timing['time_to'])){
                                                $tmp_time_flag = 1;
                                        }
                                    }
                                }
                                $tmp_time_flag_next = 0;
                                if(!empty($customer_inconvenients[$customer_id][$next_date])){
                                    foreach ($customer_inconvenients[$customer_id][$next_date] as $item => $inconv_timing ){
                                        if((0 >= (float) $inconv_timing['time_from'] && 0 < (float) $inconv_timing['time_to'])
                                            && 
                                           ((float) $time_to > (float)$inconv_timing['time_from'] && (float) $time_to <= (float)$inconv_timing['time_to'])){
                                                $tmp_time_flag_next = 1;
                                        }
                                    }
                                }


                                //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                                if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                    foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                        if(((float) $inconv_timing['time_from'] > (float) $time_from && (float) $inconv_timing['time_from'] < 24)
                                            || 
                                           ((float) $inconv_timing['time_to'] > (float) $time_from && (float) $inconv_timing['time_to'] < 24)){
                                                $slot_split_time_flag = 1;
                                        }
                                    }
                                }

                                if(!empty($customer_inconvenients[$customer_id][$next_date])){
                                    foreach ($customer_inconvenients[$customer_id][$next_date] as $item => $inconv_timing){
                                        if(((float) $inconv_timing['time_from'] > 0 && (float) $inconv_timing['time_from'] < (float) $time_to)
                                            || 
                                           ((float) $inconv_timing['time_to'] > 0 && (float) $inconv_timing['time_to'] < (float) $time_to)){
                                                $slot_split_time_flag_next = 1;
                                        }
                                    }
                                }

                            }
                            else {
                                //if the slot time same day

                                $tmp_time_flag = 0;
                                if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                    foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                        if(((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to'])
                                            && 
                                           ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])){
                                                $tmp_time_flag = 1;
                                        }
                                    }
                                }
                                //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                                if(!empty($customer_inconvenients[$customer_id][$selected_date])){
                                    foreach ($customer_inconvenients[$customer_id][$selected_date] as $item => $inconv_timing){
                                        if(((float) $inconv_timing['time_from'] > (float) $time_from && (float) $inconv_timing['time_from'] < (float) $time_to)
                                            || 
                                           ((float) $inconv_timing['time_to'] > (float) $time_from && (float) $inconv_timing['time_to'] < (float) $time_to)){
                                                $slot_split_time_flag = 1;
                                        }
                                    }
                                }
                            }

                            $time_flag      = ($time_flag == 1 && $tmp_time_flag == 1) ? 1: 0;
                            $time_flag_next = ($time_flag_next == 1 && $tmp_time_flag_next == 1) ? 1: 0;
                        }
                    }
                }
            }

            $return_obj['time_flag'] = $time_flag;
            $return_obj['time_flag_next'] = $time_flag_next;
            $return_obj['slot_split_time_flag'] = $slot_split_time_flag;
            $return_obj['slot_split_time_flag_next'] = $slot_split_time_flag_next;
        }
    }
}
else {
    $time_from  = $obj_dona->time_to_sixty(trim($_REQUEST['time_from']));
    $time_to    = $obj_dona->time_to_sixty(trim($_REQUEST['time_to']));
    if($time_to == 0) $time_to = 24;
    $selected_date = trim($_REQUEST['selected_date']);

    if ($selected_date != '' && $time_from != '' && $time_to != '') {

        $return_obj['transaction'] = TRUE;
        $inconv_timings = $obj_emp->get_inconvenient_on_a_day($selected_date, 3);

        $time_flag = 1;
        $time_flag_next = 1;
        $slot_split_time_flag = 0;
        $slot_split_time_flag_next = 0;

        if($time_from >= $time_to){ //if the slot enters next day

            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
            $inconv_timings_next = $obj_emp->get_inconvenient_on_a_day($next_date, 3);

            $time_flag = 0;
            if(!empty($inconv_timings)){
                foreach ($inconv_timings as $item => $inconv_timing){
                    if(((float) $time_from >= (float)$inconv_timing['time_from'] && (float) $time_from < (float)$inconv_timing['time_to'])
                        && 
                       (24 > (float)$inconv_timing['time_from'] && 24 <= (float)$inconv_timing['time_to'])){
                            $time_flag = 1;
                    }
                }
            }
            $time_flag_next = 0;
            if(!empty($inconv_timings_next)){
                foreach ($inconv_timings_next as $item => $inconv_timing ){
                    if((0 >= (float) $inconv_timing['time_from'] && 0 < (float) $inconv_timing['time_to'])
                        && 
                       ((float) $time_to > (float)$inconv_timing['time_from'] && (float) $time_to <= (float)$inconv_timing['time_to'])){
                            $time_flag_next = 1;
                    }
                }
            }


            //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
            if(!empty($inconv_timings)){
                foreach ($inconv_timings as $item => $inconv_timing){
                    if(((float) $inconv_timing['time_from'] >= (float) $time_from && (float) $inconv_timing['time_from'] <= 24)
                        || 
                       ((float) $inconv_timing['time_to'] >= (float) $time_from && (float) $inconv_timing['time_to'] <= 24)){
                            $slot_split_time_flag = 1;
                    }
                }
            }

            if(!empty($inconv_timings_next)){
                foreach ($inconv_timings_next as $item => $inconv_timing){
                    if(((float) $inconv_timing['time_from'] >= 0 && (float) $inconv_timing['time_from'] <= (float) $time_to)
                        || 
                       ((float) $inconv_timing['time_to'] >= 0 && (float) $inconv_timing['time_to'] <= (float) $time_to)){
                            $slot_split_time_flag_next = 1;
                    }
                }
            }

        }else {
            //if the slot time same day
            $time_flag = 0;
            if(!empty($inconv_timings)){
                foreach ($inconv_timings as $item => $inconv_timing){
                    if(((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to'])
                        && 
                       ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])){
                            $time_flag = 1;
                    }
                }
            }

            //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
            if(!empty($inconv_timings)){
                foreach ($inconv_timings as $item => $inconv_timing){
                    if(((float) $inconv_timing['time_from'] >= (float) $time_from && (float) $inconv_timing['time_from'] <= (float) $time_to)
                        || 
                       ((float) $inconv_timing['time_to'] >= (float) $time_from && (float) $inconv_timing['time_to'] <= (float) $time_to)){
                            $slot_split_time_flag = 1;
                    }
                }
            }
        }

        $return_obj['time_flag'] = $time_flag;
        $return_obj['time_flag_next'] = $time_flag_next;
        $return_obj['slot_split_time_flag'] = $slot_split_time_flag;
        $return_obj['slot_split_time_flag_next'] = $slot_split_time_flag_next;
    } else {
        $return_obj['transaction'] = FALSE;
        $return_obj['error_reason'] = $smarty->translate['something_wrong'];
    }
}

if(empty($return_obj)){
    $return_obj['transaction'] = FALSE;
    $return_obj['error_reason'] = $smarty->translate['something_wrong'];
}
echo json_encode($return_obj);
//$smarty->display('ajax_get_avail_employees_for_PM.tpl');
?>