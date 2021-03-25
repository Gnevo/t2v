<?php

	set_time_limit ( FALSE );

	require_once ('class/setup.php');
	require_once ('class/dona.php');
	require_once ('class/customer.php');
	require_once ('class/employee.php');
	require_once ('plugins/message.class.php');
	require_once ('class/template.php');


	$smarty      = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
	$customer    = new customer();
	$employee    = new employee();
	$dona        = new dona();
	$obj_message = new message();
	$obj_tmp	 = new template();

	$request_from = '';
	$url          = '';

	if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['customer']) != ''){
   		$request_from = 'gd_month';
   	 	$url = $smarty->url . 'gdschema_month_apply_update_schedule.php?id=' . $_REQUEST['template_id'] . '&year=' . $_REQUEST['sel_year'] . '&month=' . $_REQUEST['sel_month']. '&customer=' . $_REQUEST['customer'];
	}
	else if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['employee']) != ''){
	    $request_from = 'gd_month_employee';
	    $url = $smarty->url . 'month/gdschema/employee/'.trim($_REQUEST['sel_year']).'/'.trim($_REQUEST['sel_month']).'/'.trim($_REQUEST['employee']).'/';
	}
	else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_alloc_window' && trim($_REQUEST['customer']) != ''){
	    $request_from = 'gd_alloc_window';
	    $url = $smarty->url . 'gdschema_alloc_window.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['page_date'];
	}else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_alloc_window' && trim($_REQUEST['employee']) != ''){
	    $request_from = 'gd_alloc_window';
	    $url = $smarty->url . 'gdschema_alloc_window_employee.php?employee='.$_REQUEST['employee'].'&date='.$_REQUEST['page_date'];
	}else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_timeline_customer' && trim($_REQUEST['customer']) != ''){
	    $request_from = 'gd_timeline_customer';
	    $url = $smarty->url . 'gdschema_day_customer.php?date='.$_REQUEST['page_date'].'&customer='.$_REQUEST['customer'].'&action=1';
	}else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_timeline_employee' && trim($_REQUEST['employee']) != ''){
	    $request_from = 'gd_timeline_employee';
	    $url = $smarty->url . 'gdschema_day_employee.php?date='.$_REQUEST['page_date'].'&employee='.$_REQUEST['employee'].'&action=1';
	}else if (trim($_REQUEST['customer']) != '' || (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_customer')){
	    $request_from = 'gd_customer';
	    $url = $smarty->url . 'customer/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['customer'].'/8/';
	}else if (trim($_REQUEST['employee']) != '' || (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_employee')){
	    $request_from = 'gd_employee';
	    $url = $smarty->url . 'employee/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['employee'].'/8/';
	}

	$process_flag = TRUE;

	if ($_REQUEST['action'] == 'multiple_slots_remove') { // for deleting single and multiple slots;
	    $del_ids = explode("-", $_REQUEST['ids']);
	    $del_count = count($del_ids);
	    $obj_tmp->begin_transaction();
	    for($i=0 ; $i < $del_count ; $i++){
	        $slot_det = $obj_tmp->customer_employee_slot_details($del_ids[$i]);
	        if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {

	            /*if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
	                $process_flag = FALSE;
	                break;
	            }*/ 
	        }
	        	
	        if(!$process_flag) break;

	        if(!$obj_tmp->customer_employee_slot_remove($del_ids[$i])){
	            $process_flag = FALSE;
	            $obj_message->set_message('fail', 'slot_delete_failed');
	        }
	        if(!$process_flag) break;
	    }
	    
	    if($process_flag) {
	        $obj_tmp->commit_transaction();
	        $obj_message->set_message('success', 'slot_delete_success');
	    }else{
	        $obj_tmp->rollback_transaction();
	    }
	}

	else if ($_REQUEST['action'] == 'delete_employees') { // Removes employee from particular slot
	    $del_ids = explode("-", $_REQUEST['ids']);
	    $del_count = count($del_ids);
	   	$obj_tmp->begin_transaction();
	    for($i=0 ; $i < $del_count ; $i++){
	        $slot_det = $obj_tmp->customer_employee_slot_details($del_ids[$i]);
	        if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {

	            /*if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
	                $process_flag = FALSE;
	                break;
	            }*/
	        }
	        if(!$process_flag) break;
	        
	        if ($slot_det['customer'] == ''){
	            if(!$obj_tmp->customer_employee_slot_remove($del_ids[$i])){
	                $process_flag = FALSE;
	                $obj_message->set_message('fail', 'slot_employee_delete_fail');
	            }
	        }else{
	            if(!$obj_tmp->remove_from_slot($del_ids[$i])){
	                $process_flag = FALSE;
	                $obj_message->set_message('fail', 'slot_employee_delete_fail');
	            }
	        }
	        
	        if(!$process_flag) break;
	    }
	    
	    if($process_flag){ 
	        $obj_tmp->commit_transaction();
	        $obj_message->set_message('success', 'slot_employee_delete_success');
	    }else{
	        $obj_tmp->rollback_transaction();
	    }
	}

	//change FKKN to FK
	else if ($_REQUEST['action'] == 'change_fk') {
	    $this_ids = explode("-", $_REQUEST['ids']);
	    $ids_count = count($this_ids);
	    $obj_tmp->begin_transaction();
	    for($i=0 ; $i < $ids_count ; $i++){
	        $slot_det = $obj_tmp->customer_employee_slot_details($this_ids[$i]);
	        if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {

	            /*if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
	                $process_flag = FALSE;
	                break;
	            }*/
	        }
	        if(!$process_flag) break;
	        
	        if(!$obj_tmp->employee_fkkn_update($this_ids[$i], 1)){
	            $obj_message->set_message('fail', 'slot_fkkn_change_fail');
	            $process_flag = FALSE;
	        }
	        if(!$process_flag) break;
	    }
	    
	    if($process_flag) {
	        $obj_tmp->commit_transaction();
	        $obj_message->set_message('success', 'slot_fkkn_change_success');
	    }else
	        $obj_tmp->rollback_transaction();
	}

	//change FKKN to KN
	else if ($_REQUEST['action'] == 'change_kn') {
	    $this_ids = explode("-", $_REQUEST['ids']);
	    $ids_count = count($this_ids);
	    $obj_tmp->begin_transaction();
	    for($i=0 ; $i < $ids_count ; $i++){
	        $slot_det = $obj_tmp->customer_employee_slot_details($this_ids[$i]);
	        if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {
	            // if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
	            //     $process_flag = FALSE;
	            //     break;
	            // }
	        }
	        if(!$process_flag) break;
	        
	        if(!$obj_tmp->employee_fkkn_update($this_ids[$i], 2)){
	            $process_flag = FALSE;
	            $obj_message->set_message('fail', 'slot_fkkn_change_fail');
	        }
	        if(!$process_flag) break;
	    }
	    
	    if($process_flag) {
	        $obj_tmp->commit_transaction();
	        $obj_message->set_message('success', 'slot_fkkn_change_success');
	    }else{
	        $obj_tmp->rollback_transaction();
	    }
	}

	else if ($_REQUEST['action'] == 'change_tu') {
	    $this_ids = explode("-", $_REQUEST['ids']);
	    $ids_count = count($this_ids);
	    $obj_tmp->begin_transaction();
	    for($i=0 ; $i < $ids_count ; $i++){
	        $slot_det = $obj_tmp->customer_employee_slot_details($this_ids[$i]);
	        if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {
	            // if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
	            //     $process_flag = FALSE;
	            //     break;
	            // }
	        }
	        if(!$process_flag) break;
	        
	        if(!$obj_tmp->employee_fkkn_update($this_ids[$i], 3)){
	            $obj_message->set_message('fail', 'slot_fkkn_change_fail');
	            $process_flag = FALSE;
	        }
	        if(!$process_flag) break;
	    }
	    
	    if($process_flag) {
	        $obj_tmp->commit_transaction();
	        $obj_message->set_message('success', 'slot_fkkn_change_success');
	    }else{
	        $obj_tmp->rollback_transaction();
	    }

	}

	else if($_REQUEST['action'] == 'change_type'){
	    $id_slots           = explode("-", $_REQUEST['ids']);
	    $proposed_slot_type = $_REQUEST['slot_type'];
	    $ids_count          = count($id_slots);
	    
	    $normal_slot_types  = array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12, 15, 16);
	    $oncall_slot_types  = array(3, 9, 13, 14, 17);
	    $normal_oncall_auto_change = (isset($_REQUEST['normal_oncall_auto_change']) && $_REQUEST['normal_oncall_auto_change'] == TRUE ? TRUE : FALSE); //its only for complementory and complementory-oncall
	                                                
	    $obj_tmp->begin_transaction();
	    for($i=0 ; $i < $ids_count ; $i++){
	        $slot_det = $obj_tmp->customer_employee_slot_details($id_slots[$i]);
	        if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {

	            // if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
	            //     $process_flag = FALSE;
	            //     break;
	            // }
	        }
	        if(!$process_flag) break;
	        
	        if(($proposed_slot_type == 12 || $proposed_slot_type == 13) && $normal_oncall_auto_change){
	            $auto_type = $proposed_slot_type;
	            if($proposed_slot_type == 12 && in_array($slot_det['type'], $oncall_slot_types))
	                $auto_type = 13;
	            else if($proposed_slot_type == 13 && in_array($slot_det['type'], $normal_slot_types))
	                $auto_type = 12;
	            
	            if(!$obj_tmp->employee_slot_type_update($id_slots[$i], $auto_type)){
	                $process_flag = FALSE;
	                $obj_message->set_message('fail', 'slot_fkkn_change_fail');
	                break;
	            }
	        }
	        else if(!$obj_tmp->employee_slot_type_update($id_slots[$i], $proposed_slot_type)){
	            $process_flag = FALSE;
	            $obj_message->set_message('fail', 'slot_fkkn_change_fail');
	            break;
	        }
	        if(!$process_flag) break;
	    }
	    
	    if($process_flag) {
	        $obj_tmp->commit_transaction();
	        $obj_message->set_message('success', 'slot_type_change_success');
	    }else
	        $obj_tmp->rollback_transaction();
	}
	// exit();
	header('Location: '.$url);
	exit();
?>