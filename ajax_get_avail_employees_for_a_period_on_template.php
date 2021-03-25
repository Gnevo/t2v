<?php

	/*
		AUTHER : Sreerag
		For getting available emloyees for a period of time in templates.

	*/

	require_once('class/setup.php');
	require_once('class/employee.php');
	require_once('class/dona.php');
	require_once('class/template.php');

	$obj_emp    = new employee();
	$obj_dona   = new dona();
	$obj_temp	= new template();

	if(isset($_REQUEST['action']) && trim($_REQUEST['action'] == "new_slot_add")){
		$time_from    = $obj_dona->time_to_sixty(trim($_REQUEST['current_slot']['time_from']));
	    $time_to      = $obj_dona->time_to_sixty(trim($_REQUEST['current_slot']['time_to']));
	    $schedule_id  = trim($_REQUEST['schedule_id']);
	    if($time_to == 0) $time_to = 24;
	    $selected_customer = trim($_REQUEST['selected_customer']);
	    $selected_date 	   = trim($_REQUEST['selected_date']);
	    if ($selected_customer != '' && $selected_date != '' && $time_from != '' && $time_to != '') {
        	// print_r($_REQUEST['other_time_slots'])
	    	$other_slots = array();
       		$other_slots_next_day = array();
       		if(!empty($_REQUEST['other_time_slots'])){
	            foreach($_REQUEST['other_time_slots'] as $tmp_other_slot){
	                $tmp_time_from  = $obj_dona->time_to_sixty(trim($tmp_other_slot['time_from']));
	                $tmp_time_to    = $obj_dona->time_to_sixty(trim($tmp_other_slot['time_to']));
	                if($tmp_time_to == 0) $tmp_time_to = 24;
	                if(trim($tmp_other_slot['employee']) != '' && $tmp_time_from != '' && $tmp_time_to != ''){
	                    //if the slot enters next day
	                    if($tmp_time_from >= $tmp_time_to){
	                        $other_slots[] = array(
								'time_from' => $tmp_time_from,
								'time_to'   => 24,
								'employee'  => trim($tmp_other_slot['employee'])
	                        );
	                        $other_slots_next_day[] = array(
								'time_from' => 0,
								'time_to'   => $tmp_time_to,
								'employee'  => trim($tmp_other_slot['employee'])
	                        );
	                    } else{
	                        $other_slots[] = array(
								'time_from' => $tmp_time_from,
								'time_to'   => $tmp_time_to,
								'employee'  => trim($tmp_other_slot['employee'])
	                        );
	                    }
	                }
	            }
        	}
        	if($time_from >= $time_to){
        		$available_users_day1 = $obj_temp->get_available_users_template($selected_customer, $time_from, 24, $selected_date,$schedule_id);
            
            //removing collided employees from already typed slots
	            if(!empty($other_slots) && !empty($available_users_day1)){
	                foreach($other_slots as $other_slot){
	                    if(($other_slot['time_from'] >= $time_from && $other_slot['time_from'] <  $time_to) ||
	                        ($other_slot['time_to'] > $time_from && $other_slot['time_to'] <= $time_to) ||
	                        ($other_slot['time_from'] < $time_from && $other_slot['time_to'] > $time_to)){
	                            foreach($available_users_day1 as $key => $avail_user){
	                                if($avail_user['username'] == $other_slot['employee']){
	                                    unset($available_users_day1[$key]);
	                                    break;
	                                }
	                            }
	                    }
	                }
	                $available_users_day1 = array_values($available_users_day1);
	            }

            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
            $available_users_day2 = $obj_temp->get_available_users_template($selected_customer, 0, $time_to, $next_date,$schedule_id);
            
            //removing collided employees from already typed slots
	            if(!empty($other_slots_next_day) && !empty($available_users_day2)){
	                foreach($other_slots_next_day as $other_slot){
	                    if(($other_slot['time_from'] >= $time_from && $other_slot['time_from'] <  $time_to) ||
	                        ($other_slot['time_to'] > $time_from && $other_slot['time_to'] <= $time_to) ||
	                        ($other_slot['time_from'] < $time_from && $other_slot['time_to'] > $time_to)){
	                            foreach($available_users_day2 as $key => $avail_user){
	                                if($avail_user['username'] == $other_slot['employee']){
	                                    unset($available_users_day2[$key]);
	                                    break;
	                                }
	                            }
	                    }
	                }
	                $available_users_day2 = array_values($available_users_day2);
	            }
            
            $available_users = array_uintersect($available_users_day1, $available_users_day2, function($value1, $value2) {
                                        return strcmp($value1['username'], $value2['username']);
                                     });
        	}
	   		else{
       		 	$available_users = $obj_temp->get_available_users_template($selected_customer, $time_from, $time_to, $selected_date,$schedule_id);
		    		if(!empty($other_slots) && !empty($available_users)){
		                foreach($other_slots as $other_slot){
		                    if(($other_slot['time_from'] >= $time_from && $other_slot['time_from'] <  $time_to) ||
		                        ($other_slot['time_to'] > $time_from && $other_slot['time_to'] <= $time_to) ||
		                        ($other_slot['time_from'] < $time_from && $other_slot['time_to'] > $time_to)){
		                            foreach($available_users as $key => $avail_user){
		                                if($avail_user['username'] == $other_slot['employee']){
		                                    unset($available_users[$key]);
		                                    break;
		                                }
		                            }
		                    }
		                }
	                $available_users = array_values($available_users);
	            	}
	   		}
        }  
        echo json_encode($available_users); 
	}
	
	else if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'change_slot_employees'){
//    echo "<pre>".print_r($_REQUEST, 1)."</pre>";
		$current_slot_id = trim($_REQUEST['current_slot_id']);
		$schedule_id     = trim($_REQUEST['slot_tid']);
		$time_from       = $obj_dona->time_to_sixty(trim($_REQUEST['current_slot']['time_from']));
		$time_to         = $obj_dona->time_to_sixty(trim($_REQUEST['current_slot']['time_to']));
	    if($time_to == 0) $time_to = 24;
	    $selected_customer = trim($_REQUEST['selected_customer']);
	    $selected_date = trim($_REQUEST['selected_date']);

	    if ($selected_customer != '' && $selected_date != '' && $time_from != '' && $time_to != '' && $current_slot_id != '') {
	        
	//        $current_slot_id = NULL;
	        //get array of time-from/time-to/employee who have already attached with this request
	        $other_slots = array();
	        $other_slots_next_day = array();
	//        echo "<pre>".print_r($other_slots, 1)."</pre>";
	        if($time_from >= $time_to){ //if the slot enters next day
	            $available_users_day1 = $obj_temp->get_available_users_template($selected_customer, $time_from, 24, $selected_date,$schedule_id,$current_slot_id);
	            
	            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
	            $available_users_day2 = $obj_temp->get_available_users_template($selected_customer, 0, $time_to, $next_date,$schedule_id,$current_slot_id);
	            
	            $available_users = array_uintersect($available_users_day1, $available_users_day2, function($value1, $value2) {
	                                        return strcmp($value1['username'], $value2['username']);
	                                     });
	    //        echo "<pre>available_users_day1: ".print_r($available_users_day1, 1)."</pre>";
	    //        echo "<pre>available_users_day2: ".print_r($available_users_day2, 1)."</pre>";
	    //        echo "<pre>available_users: ".print_r($available_users, 1)."</pre>";
	        }else
	            $available_users = $obj_temp->get_available_users_template($selected_customer, $time_from, $time_to, $selected_date,$schedule_id,$current_slot_id);
	            
	//        echo count($available_users);
	//        echo "<pre>".print_r($available_users, 1)."</pre>";
	    }
	    echo json_encode($available_users);
	}

	else {
	    $time_from  = $obj_dona->time_to_sixty(trim($_REQUEST['time_from']));
	    $time_to    = $obj_dona->time_to_sixty(trim($_REQUEST['time_to']));
	    if($time_to == 0) $time_to = 24;
	    $selected_customer = trim($_REQUEST['selected_customer']);
	    $selected_date = trim($_REQUEST['selected_date']);

	    if ($selected_customer != '' && $selected_date != '' && $time_from != '' && $time_to != '') {
	        if($time_from >= $time_to){ //if the slot enters next day
	            $available_users_day1 = $obj_temp->get_available_users_template($selected_customer, $time_from, 24, $selected_date);

	            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
	            $available_users_day2 = $obj_temp->get_available_users_template($selected_customer, 0, $time_to, $next_date);
	            $available_users = array_uintersect($available_users_day1, $available_users_day2, function($value1, $value2) {
	                                        return strcmp($value1['username'], $value2['username']);
	                                     });
	    //        echo "<pre>available_users_day1: ".print_r($available_users_day1, 1)."</pre>";
	    //        echo "<pre>available_users_day2: ".print_r($available_users_day2, 1)."</pre>";
	    //        echo "<pre>available_users: ".print_r($available_users, 1)."</pre>";
	        }else
	            $available_users = $obj_temp->get_available_users_template($selected_customer, $time_from, $time_to, $selected_date);
	    //        echo "<pre>".print_r($available_users, 1)."</pre>";
	    }
	    echo json_encode($available_users);
	}
	

?>