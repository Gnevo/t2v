<?php
	// @auther: Sreerag 
	// date   : 18/05/2018
	// saving page for save template slot to table scedule_copy.
	// error_reporting(E_ALL);
	// error_reporting(E_WARNING);
	// ini_set('error_reporting', E_ALL);
	// ini_set("display_errors", 1);
	
	require_once ('class/setup.php');
	require_once ('class/dona.php');
	require_once ('class/customer.php');
	require_once ('class/employee.php');
	require_once ('plugins/message.class.php');
	require_once ('class/template.php');

	$smarty   = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
	$msg      = new message();
	$customer = new customer();
	$employee = new employee();
	$dona     = new dona();
	$obj_temp = new template();

	// ='+schedule_id+'&year='+year+'&month='+month+'&customer='+customer+'', 1);
	$url = '';
	if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'monthly_view' && $_REQUEST['customer'] != ''){
	    $url = $smarty->url . 'gdschema_month_apply_update_schedule.php?id=' . $_REQUEST['template_id'] . '&year=' . $_REQUEST['gd_year'] . '&month=' . $_REQUEST['gd_month']. '&customer=' . $_REQUEST['customer'];
	}
	elseif (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'monthly_view_employee' && $_REQUEST['employee'] != ''){
	    $url = $smarty->url . 'month/gdschema/employee/' . $_REQUEST['gd_year'] . '/' . $_REQUEST['gd_month'] . '/' . $_REQUEST['employee'].'/';
	}
	else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_customer' && $_REQUEST['customer'] != ''){
	    $url = $smarty->url . 'customer/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['customer'].'/8/';
	}
	else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_employee' && $_REQUEST['employee'] != ''){
	    $url = $smarty->url . 'employee/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['employee'].'/8/';
	}
	else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_alloc_window' && $_REQUEST['customer'] != ''){
	    $url = $smarty->url . 'gdschema_alloc_window.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['gd_page_date'];
	}
	else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_alloc_window' && $_REQUEST['employee'] != ''){
	    $url = $smarty->url . 'gdschema_alloc_window_employee.php?employee=' . $_REQUEST['employee'].'&date='.$_REQUEST['gd_page_date'];
	}
	else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_timeline_customer' && $_REQUEST['customer'] != ''){
	    $url = $smarty->url . 'gdschema_day_customer.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['gd_page_date'].'&action=1';
	}
	else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_timeline_employee' && $_REQUEST['employee'] != ''){
	    $url = $smarty->url . 'gdschema_day_employee.php?employee='.$_REQUEST['employee'].'&date='.$_REQUEST['gd_page_date'].'&action=1';
	}
	else if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != ''){
	    $url = $smarty->url . 'gdschema_alloc_window.php?customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
	    $url_slots = $smarty->url . 'ajax_gdschema_alloc_slots.php?customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
	}
	else if ($_REQUEST['employee'] == '' && $_REQUEST['customer'] != ''){
	    $url = $smarty->url . 'gdschema_alloc_window.php?customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
	    $url_slots = $smarty->url . 'ajax_gdschema_alloc_slots.php?customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
	}
	else if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] == ''){
	    $url = $smarty->url . 'gdschema_alloc_window_employee.php?employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
	    $url_slots = $smarty->url . 'ajax_gdschema_alloc_slots.php?employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
	}

	if ($_REQUEST['action'] == 'man_slot_entry') {
		$normal_slot_types = array('0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16');
    	$oncall_slot_types = array('3', '9', '13', '14', '17');

    	if ($_REQUEST['sub_action'] == 'multiple_add') {
    		$proceed_flag = TRUE;
	        $customer_to_add = isset($_REQUEST['selected_customer']) && trim($_REQUEST['selected_customer']) != '' ? trim($_REQUEST['selected_customer']) : NULL;
	        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
	        $employee_to_add = isset($_REQUEST['selected_employee']) && trim($_REQUEST['selected_employee']) != '' ? trim($_REQUEST['selected_employee']) : NULL;
	        if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];

	        $template_id				  = trim($_REQUEST['template_id']);
 			$selected_date                = trim($_REQUEST['selected_date']);
			$slot_periods                 = array();
			$any_slot_enters_to_next_day  = FALSE;
			$split_slots                  = (isset($_REQUEST['split_slots']) && trim($_REQUEST['split_slots']) == 'yes') ? TRUE : FALSE;
			$convert_to_oncall            = isset($_REQUEST['convert_to_oncall']) && $_REQUEST['convert_to_oncall'] == 'yes' ? TRUE : FALSE;
			$flag_employee_slots_collided = FALSE;

			if(!empty($_REQUEST['time_slots'])){
	            foreach($_REQUEST['time_slots'] as $time_slot){

	                $tmp_time_from  = $dona->time_to_sixty(trim($time_slot['time_from']));
	                $tmp_time_to    = $dona->time_to_sixty(trim($time_slot['time_to']));
	                if($tmp_time_to == 0) $tmp_time_to = 24;

	                if($tmp_time_from != false && $tmp_time_to != false){
	                    //if the slot enters next day
	                    if($tmp_time_from >= $tmp_time_to) $any_slot_enters_to_next_day = TRUE;

	                    $slot_periods[] = array( 
	                            'time_from' => $tmp_time_from, 
	                            'time_to'   => $tmp_time_to, 
	                            'customer'  => $customer_to_add != NULL ? $customer_to_add : trim($time_slot['customer']),
	                            'employee'  => $employee_to_add != NULL ? $employee_to_add : trim($time_slot['employee']),
	                            'comment'   => trim($time_slot['comment']),
	                            'fkkn'      => trim($time_slot['fkkn']),
	                            'type'      => ((in_array($time_slot['type'], $normal_slot_types) && $convert_to_oncall) ? 3 : trim($time_slot['type'])) 
	                        );
	                }
	            }
            
            	//checking employee slots collided together from passed slots
	            if(!empty($slot_periods)){
	                $count_slots = count($slot_periods);
	                for($i = 1 ; $i < $count_slots ; $i++){
	                    if ($slot_periods[$i]['employee'] == '') continue;
	                    
	                    for($j = 0 ; $j < $i ; $j++){
	                        
	                        if ($slot_periods[$j]['employee'] == '') continue;
	                        if ($slot_periods[$j]['employee'] != $slot_periods[$i]['employee']) continue;
	                        
	                        if(($slot_periods[$j]['time_from'] >= $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_from'] <  $slot_periods[$i]['time_to']) ||
	                            ($slot_periods[$j]['time_to'] > $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_to'] <= $slot_periods[$i]['time_to']) ||
	                            ($slot_periods[$j]['time_from'] < $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_to'] > $slot_periods[$i]['time_to'])){
	                                $flag_employee_slots_collided = TRUE;
	                                break;
	                        }
	                    }
	                    if($flag_employee_slots_collided) break;
	                }
	            }
       		}

       		if($selected_date == '')
           		$msg->set_message('fail', 'invalid_date');
       		else if(empty($slot_periods))
            	$msg->set_message('fail', 'invalid_time');
        	else if($flag_employee_slots_collided)
            	$msg->set_message('fail', 'employee_slots_collided_within_entered_slots');
        	else {
        		if (isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){

	                /**
	                 * @author: Shamsudheen <shamsu@arioninfotech.com>
	                 * for: enter time slot manually with schema operation
	                */

	                //operation related to weekly pass.
	                $sel_date       = $selected_date;
	                $sel_days       = explode('-', trim($_REQUEST['days']));
	                $from_week      = trim($_REQUEST['from_week']);
	                $to_week        = trim($_REQUEST['to_week']);
	                $from_option    = trim($_REQUEST['from_option']);
	                $template_id    = trim($_REQUEST['template_id']);

	                $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
	                $proceed_flag = $result_flag = $obj_temp->schema_manual_entry_time_slots_multiAdd($template_id,$selected_date, $slot_periods, $from_week, $to_week, $from_option, $sel_days, $_REQUEST['saveTimeslot'], $dont_show_flag, $convert_to_oncall, $split_slots);
           		}
           		else{
           			$net_process_flag = FALSE;
                	$emp_alloc = isset($_REQUEST['emp_alloc']) && trim($_REQUEST['emp_alloc']) != '' ? $_REQUEST['emp_alloc'] : $_SESSION['user_id'];
                	$dona->begin_transaction();
                	$customer->begin_transaction();
                	$employee->begin_transaction();
                	$obj_temp->begin_transaction();
                	$result_flag = TRUE;

                	foreach($slot_periods as $slot_period){

                		/*if($slot_period['customer'] != '' && $slot_period['employee'] != ''){
                        	if($employee->chk_employee_rpt_signed($slot_period['employee'], $slot_period['customer'], $selected_date, TRUE) == 1)
                            $proceed_flag = FALSE;
                    	}*/
                    	if($proceed_flag){
                    		if ($slot_period['time_from'] >= $slot_period['time_to']){ //if the slot enters next day
								$cur_date  = strtotime($selected_date . ' 00:00:00');
								$next_date = date('Y-m-d', ($cur_date + 24 * 3600));

								if ($obj_temp->is_valid_slot($slot_period['employee'], $slot_period['time_from'], 24, $selected_date) && $obj_temp->is_valid_slot($slot_period['employee'], 0, $slot_period['time_to'], $next_date)){
									if($split_slots && in_array($slot_period['type'], $normal_slot_types)){
										$inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($selected_date, $slot_period['customer'], $slot_period['time_from'], 24, 3);
                                    	$intervals = array();
                                    	if(!empty($inconv_timings)){
                                    		$total_count = count($inconv_timings);
	                                        $last_time_to = $slot_period['time_from'];
	                                        foreach ($inconv_timings as $key => $inconv_timing) {
	                                            $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                            if($inconv_timing['time_from'] <= $last_time_to){
	                                                if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
	                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
	                                                    $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
	                                                }
	                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
	                                            }else if($inconv_timing['time_from'] > $last_time_to){
	            //                                    if($key == 0){
	                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
	                                                    $cur_time_to = $inconv_timing['time_from'];
	                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
	            //                                    }

	                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
	                                                $cur_time_to = $inconv_timing['time_to'];
	                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
	                                            }

	                                            $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                            if($key == $total_count - 1 && $inconv_timing['time_to'] < 24){
	                                                $cur_time_from = $last_time_to;
	                                                $cur_time_to = 24;
	                                                $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
	                                            }
	                                        }
                                    	}
                                    	else{
                                    		$cur_time_from = $slot_period['time_from'];
                                        	$cur_time_to = 24;
                                        	$cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                        	$intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                    	}
                                    	$next_day_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day'));
                                    	$inconv_timings_next = $employee->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $slot_period['customer'], 0, $slot_period['time_to'], 3);
                                    	if(!empty($inconv_timings_next)){
	                                    	$total_count = count($inconv_timings_next);
	                                        $last_time_to = 0;
	                                        foreach ($inconv_timings_next as $key => $inconv_timing) {
	                                            $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                            if($inconv_timing['time_from'] <= $last_time_to){
	                                                if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
	                                                    $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
	                                                    $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                                }
	                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                            }else if($inconv_timing['time_from'] > $last_time_to){
	            //                                    if($key == 0){
	                                                    $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
	                                                    $cur_time_to = $inconv_timing['time_from'];
	                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	            //                                    }
	                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                            }

	                                            $last_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                            if($key == $total_count - 1 && $inconv_timing['time_to'] < $slot_period['time_to']){
	                                                $cur_time_from = $last_time_to;
	                                                $cur_time_to = $slot_period['time_to'];
	                                                $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                            }
	                                        }
                                    	}
                                    	else{
                                    		$cur_time_from = 0;
                                        	$cur_time_to = $slot_period['time_to'];
                                        	$cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                        	$intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                    	}
                                    	if(!empty($intervals)){
	                                        foreach ($intervals as $interval) {
	                                            if($interval['time_from'] == $interval['time_to']) continue;
	                                            if ($obj_temp->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $interval['date'], $interval['time_from'], $interval['time_to'], $emp_alloc, $slot_period['fkkn'], $interval['type'], '', $slot_period['comment'])) {
	//                                                if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                                 if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1){ 
	// //                                                    $customer->add_memory_slot($slot_period['customer'], $tmp_time_from, $tmp_time_to, $interval['type']);
	//                                                     $customer->add_memory_slot($slot_period['customer'], $tmp_time_from, $tmp_time_to, $interval['type']);
	//                                                 }
	                                            }
	                                            else{
	                                                $msg->set_message('fail', 'insertion_failed');
	                                                $result_flag = FALSE;
	                                                break;
	                                            }
	                                        }
	                                    }
									}
									else {
	                                    if ($obj_temp->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $selected_date, $slot_period['time_from'], 24, $emp_alloc, $slot_period['fkkn'], $slot_period['type'], '', $slot_period['comment'])) {
	//                                        if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                            $customer->add_memory_slot($slot_period['customer'], $slot_period['time_from'], 24, $slot_period['type']);

	                                        if ($obj_temp->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $next_date, 0, $slot_period['time_to'], $emp_alloc, $slot_period['fkkn'], $slot_period['type'], '', $slot_period['comment'])) {
	//                                            if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                                $customer->add_memory_slot($slot_period['customer'], 0, $slot_period['time_to'], $slot_period['type']);

	                                            $net_process_flag = TRUE;
	                                        }
	                                        else{
	                                            $msg->set_message('fail', 'insertion_failed');
	                                            $result_flag = FALSE;
	                                            break;
	                                        }
	                                        
	                                        // if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1)
	                                        //     $customer->add_memory_slot($slot_period['customer'], $slot_period['time_from'], $slot_period['time_to'], $slot_period['type']);
	                                        
	                                    } 
	                                    else{
	                                        $msg->set_message('fail', 'insertion_failed');
	                                        $result_flag = FALSE;
	                                        break;
	                                    }
	                                }	
								}
								else{
									$msg->set_message('fail', 'slot_collide');
                                	$result_flag = FALSE;
                                	break;
								}
                    		}
                    		//if the time slot is on same day
                    		else{
                    			//checking the time is valid
                    			if ($obj_temp->is_valid_slot($slot_period['employee'], $slot_period['time_from'], $slot_period['time_to'], $selected_date)) {
	                                if($split_slots && in_array($slot_period['type'], $normal_slot_types)){
	                                    $inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($selected_date, $slot_period['customer'], $slot_period['time_from'], $slot_period['time_to'], 3);
	//                                    echo "<pre>".print_r($inconv_timings, 1)."</pre>"; exit();
	                                    $intervals = array();
	                                    if(!empty($inconv_timings)){
	                                        $total_count = count($inconv_timings);
	                                        $last_time_to = $slot_period['time_from'];
	                                        foreach ($inconv_timings as $key => $inconv_timing) {
	                                            $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                            if($inconv_timing['time_from'] <= $last_time_to){
	                                                if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
	                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
	                                                    $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                                }
	                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                            }else if($inconv_timing['time_from'] > $last_time_to){
	            //                                    if($key == 0){
	                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
	                                                    $cur_time_to = $inconv_timing['time_from'];
	                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	            //                                    }
	                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                            }

	                                            $last_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
	                                            if($key == $total_count - 1 && $inconv_timing['time_to'] < $slot_period['time_to']){
	                                                $cur_time_from = $last_time_to;
	                                                $cur_time_to = $slot_period['time_to'];
	                                                $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                            }
	                                        }
	                                    }
	                                    else{
	                                        $cur_time_from = $slot_period['time_from'];
	                                        $cur_time_to = $slot_period['time_to'];
	                                        $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
	                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                    }

	                                    if(!empty($intervals)){
	                                        foreach ($intervals as $interval) {
	                                            if($interval['time_from'] == $interval['time_to']) continue;
	                                            if ($obj_temp->customer_employee_slot_add($template_id,$slot_period['employee'], $slot_period['customer'], $selected_date, $interval['time_from'], $interval['time_to'], $emp_alloc, $slot_period['fkkn'], $interval['type'], '',$slot_period['comment'])) {
	//                                                if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                                    $customer->add_memory_slot($slot_period['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
	                                                // if ($slot_period['customer'] != '') 
	                                                //     $customer->add_memory_slot($slot_period['customer'], $tmp_time_from , $tmp_time_to , $interval['type']);
	                                            }else{
	                                                $msg->set_message('fail', 'insertion_failed');
	                                                $result_flag = FALSE;
	                                                break;
	                                            }
	                                        }
	                                    }
	                                }
	                                else {
	                                    if ($obj_temp->customer_employee_slot_add($template_id,$slot_period['employee'], $slot_period['customer'], $selected_date, $slot_period['time_from'], $slot_period['time_to'], $emp_alloc, $slot_period['fkkn'], $slot_period['type'], '',$slot_period['comment'])) {
	//                                        if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                            $customer->add_memory_slot($slot_period['customer'], $slot_period['time_from'], $slot_period['time_to'], $slot_period['type']);
	                                        if ($slot_period['customer'] != '') 
	                                            // $customer->add_memory_slot($slot_period['customer'], $tmp_time_from, $tmp_time_to, $slot_period['type']);
	                                        $net_process_flag = TRUE;
	                                    }
	                                    else{
	                                        $msg->set_message('fail', 'insertion_failed');
	                                        $result_flag = FALSE;
	                                        break;
	                                    }
	                                }
	                            }
	                            else {
	                                $msg->set_message('fail', 'slot_collide');
	                                $result_flag = FALSE;
	                                break;
	                            }
                    		}
                    	}
                    	if(!$result_flag && $proceed_flag) break;
                	}
                	if($result_flag && $proceed_flag) {
						$msg->set_message('success', 'slot_added_success');
						$dona->commit_transaction ();
						$customer->commit_transaction ();
						$employee->commit_transaction ();
						$obj_temp->commit_transaction ();
                    	$net_process_flag = TRUE;
                	}
                	else {
                    	$proceed_flag = FALSE;
                    	$dona->rollback_transaction ();
                   	 	$customer->rollback_transaction ();
                   		$employee->rollback_transaction ();
                   		$obj_temp->rollback_transaction ();
                	}
           		}
        	}
        	if($_REQUEST['stop_if_any_error'] == TRUE && !$proceed_flag){
            	$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            	$message = $msg->show_message_exact();
            	header($protocol . ' 527 '.utf8_decode($message), true, 527);
				//           	 header($protocol . ' 527 Internal Server Error - test', true, 527);
				//          	  header($protocol . ' 418 '.$message, true, 527);
            	exit();
        	}
        
        	if($_REQUEST['reload'] == 'stop'){
            	exit();
       		}
		}

    	//single time slot *******************************************************************************
		else{
			$time_from        = $dona->time_to_sixty($_REQUEST['time_from']);
			$time_to          = $dona->time_to_sixty($_REQUEST['time_to']);
			$comment_textarea = trim($_REQUEST['comment_textarea']);
			$memslot_type     = trim($_REQUEST['memslottype']) != '' ? trim($_REQUEST['memslottype']) : 0;
			$slot_fkkn        = trim($_REQUEST['slot_fkkn']) != '' ? trim($_REQUEST['slot_fkkn']) : NULL;
			if ($time_to == 0)  $time_to = 24;
			if ($time_from != false && $time_to != false){
				$employee_to_add = trim($_REQUEST['slot_employee']) != '' ? trim($_REQUEST['slot_employee']) : NULL;
            	if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
            	$customer_to_add = trim($_REQUEST['slot_customer']) != '' ? trim($_REQUEST['slot_customer']) : NULL;
            	if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
            	$proceed_flag = TRUE;
            	if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){

	                /**
	                 * @author: Shamsudheen <shamsu@arioninfotech.com>
	                 * for: enter time slot manually with schema operation
	                */
	                // releted to weekly operation.
					$sel_date    = trim($_REQUEST['date']);
					$sel_days    = explode('-', trim($_REQUEST['days']));
					array_pop($sel_days);
					$from_week   = trim($_REQUEST['from_week']);
					$to_week     = trim($_REQUEST['to_week']);
					$from_option = trim($_REQUEST['from_option']);

	   				 // //            $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
	   				 // //            $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
	                $__slot_employee = $employee_to_add;
	                $__slot_customer = $customer_to_add;
	                $time_from       = trim($_REQUEST['time_from']);
	                $time_to         = trim($_REQUEST['time_to']);
	                $slot_type       = trim($_REQUEST['slotType']) != '' ? trim($_REQUEST['slotType']) : 0;;

	                $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
	        //         //-----------------------------------
	                $sketch_slot = array(
	                                'employee'  => $__slot_employee, 
	                                'customer'  => $__slot_customer, 
	                                'date'      => $sel_date, 
	                                'slot_type' => $slot_type, 
	                                'time_from' => $time_from, 
	                                'time_to'   => $time_to,
	                                'fkkn'      => $slot_fkkn,
	                                'comment_textarea'   => $comment_textarea,
	                                'saveTimeslot'   => $_REQUEST['saveTimeslot']);
	                $result_flag = $obj_temp->schema_manual_entry_time_slots_multiAdd($sketch_slot, $from_week, $to_week, $from_option, $sel_days,$_REQUEST['saveTimeslot'], $dont_show_flag);
	        //         //save dont_show flag on general-settings-table only if it set as 1
	                if($dont_show_flag && $result_flag){
	                    $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
	                }
	                if($result_flag){
	                    if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
	                        $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
	                }
        	//    	}
				}
				else{
					$net_process_flag = FALSE;      //for saving atl, if any
	                /*if($employee_to_add != '' && $customer_to_add != ''){
	                    if($employee->chk_employee_rpt_signed($employee_to_add, $customer_to_add, $_REQUEST['date'], TRUE) == 1)
	                        $proceed_flag = FALSE;
	                }*/
	                if($proceed_flag){
	                	if ($time_from >= $time_to){ // if the slot enters next day
							$cur_date  = strtotime($_REQUEST['date'] . ' 00:00:00');
							$next_date = date('Y-m-d', ($cur_date + 24 * 3600));
							if ($obj_temp->is_valid_slot($employee_to_add, $time_from, 24, $_REQUEST['date']) && $employee->is_valid_slot($employee_to_add, 0, $time_to, $next_date)){
								if(isset($_REQUEST['split']) && trim($_REQUEST['split']) == 'yes'){
									$result_flag = TRUE;
									$obj_db      = new db();
									$inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($_REQUEST['date'], $customer_to_add, $time_from, 24, 3);
	                                $obj_db->begin_transaction();
	                                $intervals = array();
	                                if(!empty($inconv_timings)){
										$total_count  = count($inconv_timings);
										$last_time_to = $time_from;
										foreach ($inconv_timings as $key => $inconv_timing) {
											$cur_time_from = $cur_time_to = $cur_time_type = '';
											if($inconv_timing['time_from'] <= $last_time_to){
	                                            if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
													$cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
													$cur_time_to   = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
													$cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
													$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
	                                            }
												$cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
												$cur_time_to   = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
												$cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
												$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
	                                        }else if($inconv_timing['time_from'] > $last_time_to){
	        //                                    if($key == 0){
													$cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
													$cur_time_to   = $inconv_timing['time_from'];
													$cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
													$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
	        //                                    }

												$cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
												$cur_time_to   = $inconv_timing['time_to'];
												$cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
												$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
	                                        }

	                                        $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                        if($key == $total_count - 1 && $inconv_timing['time_to'] < 24){
												$cur_time_from = $last_time_to;
												$cur_time_to   = 24;
												$cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
												$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
	                                        }
										}
	                                }
	                                else{
	                                	$cur_time_from = $time_from;
	                                    $cur_time_to = 24;
	                                    $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
	                                }
									$next_day_date       = date('Y-m-d', strtotime(date('Y-m-d', strtotime($_REQUEST['date'])) . ' +1 day'));
									$inconv_timings_next = $employee->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $customer_to_add, 0, $time_to, 3);
									if(!empty($inconv_timings_next)){
										$total_count  = count($inconv_timings_next);
										$last_time_to = 0;
										foreach ($inconv_timings_next as $key => $inconv_timing) {
											 $cur_time_from = $cur_time_to = $cur_time_type = '';
											 if($inconv_timing['time_from'] <= $last_time_to){
	                                            if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
	                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	    //                                            $cur_time_type = 0;
	                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                            }
	                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	    //                                        $cur_time_type = 3;
	                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                        }else if($inconv_timing['time_from'] > $last_time_to){
	        //                                    if($key == 0){
	                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
	                                                $cur_time_to = $inconv_timing['time_from'];
	    //                                            $cur_time_type = 0;
	                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	        //                                    }
	                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	    //                                        $cur_time_type = 3;
	                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                        }

	                                        $last_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	                                        if($key == $total_count - 1 && $inconv_timing['time_to'] < $time_to){
	                                            $cur_time_from = $last_time_to;
	                                            $cur_time_to = $time_to;
	    //                                        $cur_time_type = 0;
	                                            $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                        }
										}
									}
									else{
										$cur_time_from = 0;
										$cur_time_to   = $time_to;
										$cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
										$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
									}
									foreach ($intervals as $interval) {
	                                    if($interval['time_from'] == $interval['time_to']) continue;
	                                    if ($obj_temp->customer_employee_slot_add($employee_to_add, $customer_to_add, $interval['date'], $interval['time_from'], $interval['time_to'], $_REQUEST['emp_alloc'], $slot_fkkn, $interval['type'], '',$comment_textarea)) {
	//                                        if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                            $customer->add_memory_slot($customer_to_add, $interval['time_from'], $interval['time_to'], $interval['type']);
	                                        // if ($_REQUEST['customer'] != '') 
	                                            // $customer->add_memory_slot($customer_to_add, $tmp_time_from, $tmp_time_to, $interval['type']);
	                                    }else{
	                                        $result_flag = FALSE;
	                                        break;
	                                    }
	                                }
	                                if($result_flag) {
	                                    $msg->set_message('success', 'slot_added_success');
	                                    $obj_db->commit_transaction ();
	                                    $net_process_flag = TRUE;
	                                }
	                                else {
	                                    $msg->set_message('fail', 'insertion_failed');
	                                    $obj_db->rollback_transaction ();
	                                }
								}
								else{
									if ($obj_temp->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_from, 24, $_REQUEST['emp_alloc'], $slot_fkkn,$memslot_type,'',$comment_textarea)) {
	                                    if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1)
	//                                        $customer->add_memory_slot($customer_to_add, $time_from, 24, $memslot_type);

	                                    if ($obj_temp->customer_employee_slot_add($employee_to_add, $customer_to_add, $next_date, 0, $time_to, $_REQUEST['emp_alloc'], $slot_fkkn,$memslot_type,'',$comment_textarea)) {
	//                                        if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1)
	//                                            $customer->add_memory_slot($customer_to_add, 0, $time_to, $memslot_type);

	                                        $net_process_flag = TRUE;
	                                    } else
	                                        $msg->set_message('fail', 'insertion_failed');
	                                    // $customer->add_memory_slot($customer_to_add, $time_from, $time_to, $memslot_type);
	                                } else
	                                    $msg->set_message('fail', 'insertion_failed');
								}
							}
							else 
								 $msg->set_message('fail', 'slot_collide');
	                	}
	                	else{ //if the time slot is on same day
	                		 //checking the time is valid.
	                		if ($obj_temp->is_valid_slot($employee_to_add, $time_from, $time_to, $_REQUEST['date'])) {
	                			if(isset($_REQUEST['split']) && trim($_REQUEST['split']) == 'yes'){
									$result_flag    = TRUE;
									$obj_db         = new db();
									$inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($_REQUEST['date'], $customer_to_add, $time_from, $time_to, 3);
									$obj_db->begin_transaction();
	                                $intervals = array();
	                                if(!empty($inconv_timings)){
										$total_count  = count($inconv_timings);
										$last_time_to = $time_from;
										foreach ($inconv_timings as $key => $inconv_timing) {
	                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                        if($inconv_timing['time_from'] <= $last_time_to){
	                                            if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
	                                                $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	    //                                            $cur_time_type = 0;
	                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                            }
	                                            $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	    //                                        $cur_time_type = 3;
	                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                        }else if($inconv_timing['time_from'] > $last_time_to){
	        //                                    if($key == 0){
	                                                $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
	                                                $cur_time_to = $inconv_timing['time_from'];
	    //                                            $cur_time_type = 0;
	                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	        //                                    }
	                                            $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	    //                                        $cur_time_type = 3;
	                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                        }

	                                        $last_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
	                                        if($key == $total_count - 1 && $inconv_timing['time_to'] < $time_to){
	                                            $cur_time_from = $last_time_to;
	                                            $cur_time_to = $time_to;
	    //                                        $cur_time_type = 0;
	                                            $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                        }
	                                    }
	                                }
	                                else{
										$cur_time_from = $time_from;
										$cur_time_to   = $time_to;
										$cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
										$intervals[]   = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                }
	                                foreach ($intervals as $interval) {
	                                    if($interval['time_from'] == $interval['time_to']) continue;
	                                    if ($$obj_temp->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $interval['time_from'], $interval['time_to'], $_REQUEST['emp_alloc'], $slot_fkkn,$interval['type'],'',$comment_textarea)) {
	//                                        if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                            $customer->add_memory_slot($customer_to_add, $interval['time_from'], $interval['time_to'], $interval['type']);
	                                        // if ($_REQUEST['customer'] != '') 
	                                            // $customer->add_memory_slot($customer_to_add, $tmp_time_from, $tmp_time_to, $interval['type']);
	                                    }else{
	                                        $result_flag = FALSE;
	                                        break;
	                                    }
	                                }
	                                if($result_flag) {
	                                    $msg->set_message('success', 'slot_added_success');
	                                    $obj_db->commit_transaction ();
	                                    $net_process_flag = TRUE;
	                                }
	                                else {
	                                    $msg->set_message('fail', 'insertion_failed');
	                                    $obj_db->rollback_transaction ();
	                                }
	                			}
	                			else{
	                				 if ($obj_temp->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_from, $time_to, $_REQUEST['emp_alloc'], $slot_fkkn,$memslot_type,'',$comment_textarea)) {
	//                                    if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
	//                                        $customer->add_memory_slot($customer_to_add, $time_from, $time_to, $memslot_type);
	                                    // if ($_REQUEST['customer'] != '') 
	                                        // $customer->add_memory_slot($customer_to_add, $time_from, $time_to, $memslot_type);
	                                    $net_process_flag = TRUE;
	                                }else
	                                    $msg->set_message('fail', 'insertion_failed');
	                			}
	                		}
	                		else
	                            $msg->set_message('fail', 'slot_collide');
	                	}
	                	$dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
	                    if($dont_show_flag){
	    //                    $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
	    //                    $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
	                        $employee->save_customer_employee_general_setting($customer_to_add, $employee_to_add, 'dont_show_slot_operation_flag', 1);
	                    }	
	                }
				}
			}
			else
            $msg->set_message('fail', 'invalid_time');
		}
	}
	// var_dump($url);
	header('Location: '.$url);
?>