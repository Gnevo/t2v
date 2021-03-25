<?php 
// 	error_reporting(E_ALL);
// ini_set("display_errors", 1);

	/*
	 * Created : sreerag m
	 * date    : 26/11/2018
	 * for saving non- prefered timing of employee b/w a date range and show .
	*/

	require_once('configs/config.inc.php');
	require_once('class/setup.php');
	require_once('class/employee.php');
	require_once('class/user.php');
	require_once('class/employee_ext.php');
	require_once('class/copy_paste.php');
	require_once('plugins/message.class.php');
	require_once('class/db.php');

	$employee = new employee();
	$user     = new user();
	$obj_emp  = new employee_ext();
	$obj_copy  = new copy_paste();
	$message  = new message();

	$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "month.xml","month.xml","employee.xml","mail.xml"));
	global $week;
	$smarty->assign('week', $week);
	// var_dump($week);
	// exit('fd');
	$user_roles_login  = $user->user_role($_SESSION['user_id']);
	$query_string      = explode('&', $_SERVER['QUERY_STRING']);
	$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);

	$smarty->assign('user_roles_login', $user_roles_login);
	$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2, 'tabmenu'=>'employee_non_prefered_timing'));
	$smarty->assign('employee_username', $query_string[0]);
	$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
	$smarty->assign('privilege_general', $privilege_general);

	$employee_detail = $employee->employee_detail_main($query_string[0]);
	$employee_role   = $user->user_role($query_string[0]);
    $smarty->assign('employee_action', !empty($employee_detail) ? 'EDIT' : 'NEW');
    $smarty->assign('employee_detail', $employee_detail);
    $preference_mode = $query_string[1];
    $smarty->assign('preference_mode', $preference_mode);

  	//////// ajax block  /////////

    if($_POST['action'] && $_POST['action'] == 'save_time_interval'){
    	$responce = new stdClass();
		$user_name        = $_POST['username'];
		$fromDate         = $_POST['fromDate'];
		$toDate           = $_POST['toDate'];
		$dayInterval      = $_POST['dayInterval'];
		$preference_mode  = $_POST['preference_mode'];
		//echo '<pre>' . print_r($_POST,1) .'</pre>';exit();
		$non_prefered_date = array();
		$sel_date = $fromDate;
		while (strtotime($sel_date) <= strtotime($toDate)) {
			$date = date('Y-m-d', strtotime($sel_date));
			$week_day = date('N', strtotime($sel_date));
			$non_prefered_date[$date] = $dayInterval[$week_day][0];
			$sel_date = date('Y-m-d', strtotime($sel_date . ' +1 day'));
		}
		//echo '<pre>' . print_r($non_prefered_date,1) .'</pre>';exit();

		$overlapedDetails = $obj_emp->check_overlapping_time_peroid($fromDate,$toDate,$dayInterval,$user_name);
		if(!empty($overlapedDetails)){
            // return $responce = array('status'=>'collide','overlapedDetails'=>$overlapedDetails);
            $error_flag = 'collide';
        }
        else{

        	//cheking with query commented by dona
        	//$overlaped_slot_det = $obj_emp->check_time_interval_overlap_with_existing_slots($fromDate,$toDate,$dayInterval,$user_name);
        	//echo $fromDate . '-' . $toDate . '-' . $user_name;
        	$allocated_slots = array();
        	if($preference_mode == 0)
        		$allocated_slots = $obj_copy->get_employee_slot_between_dates(array($user_name), $fromDate, $toDate,array());
			$overlapedSlotDetails = array();
			//echo '<pre>' . print_r($allocated_slots,1) .'</pre>';exit();
			if(!empty($allocated_slots)) {
				foreach ($allocated_slots as $allocated_slot) {
					$date = $allocated_slot['date'];
					if(isset($non_prefered_date[$date])) {
						$non_prefered_time = $non_prefered_date[$date];
						if(($allocated_slot['time_from'] >= (float)$non_prefered_time['timeFrom'] && $allocated_slot['time_from'] < (float)$non_prefered_time['timeTo']) || ($allocated_slot['time_to'] <= (float)$non_prefered_time['timeTo'] && $allocated_slot['time_to'] > (float)$non_prefered_time['timeFrom']) || ($allocated_slot['time_from'] < (float)$non_prefered_time['timeFrom'] && $allocated_slot['time_to'] > (float)$non_prefered_time['timeTo'])) {
							$overlapedSlotDetails = $allocated_slot;
							break;
						}
					}
				}
			}
			//echo '<pre>' . print_r($overlapedSlotDetails,1) .'</pre>';exit();
        	if(!empty($overlapedSlotDetails)){
        		$error_flag = 'collide_slot';
        	}
        	else{
        		$group_id = $obj_emp->get_group_id();
				$result   = $obj_emp->save_employee_non_prefered_time($user_name,$fromDate,$toDate,$dayInterval,$group_id, $preference_mode);

				$result == TRUE ? $error_flag = 'success' :  $error_flag = 'insertion_error';
        	}
        }
		
		if($error_flag == 'success'){
			$employee_old_details = $employee->get_employee_detail($user_name);
	        $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_old_details['first_name']. ' '. $employee_old_details['last_name'] : $employee_old_details['last_name']. ' '. $employee_old_details['first_name'];
	        $mail_sub = $smarty->translate['non_prefered_mail_add_subject'];
	        $mail_msg = $smarty->translate['non_prefered_mail_add_heading'];
	        $mail_msg .= '<br><br>'.'<strong>'.$logged_employee_name.'</strong>'.' '.$smarty->translate['emp_take_non_preferd_time_range'].'<br>'.'<strong>'.$fromDate.'&nbsp;&nbsp;'.$smarty->translate['to'].'&nbsp;&nbsp;'.$toDate.'</strong>'.'<br>';
	        foreach ($dayInterval as $day => $times) {
	            $mail_msg .= '<strong>'.$smarty->translate[$week[$day-1]['day']].'</strong>'.'<br>';
	            foreach ($times as $key => $value) {
	               $mail_msg .= sprintf('%05.02f', $value['timeFrom']).'-'.sprintf('%05.02f', $value['timeTo']).'<br>';
	            }
	        }
	        mail_send_to_admin_tl_stl($mail_sub,$mail_msg,$employee_old_details,$user_name);

			$responce->result_flag = TRUE;
			$message->set_message('success', 'employee_non_prefered_time_saved_successfully');
		}
		else if($error_flag == 'slot_collide') {
			$error_message_translate = $smarty->translate['employee_non_prefered_time_slot_overlap'];
			$error_message = str_replace ('{{date}}', $overlapedSlotDetails['date'], $error_message_translate);
        	$error_message = str_replace ('{{customer}}', $overlapedSlotDetails['customer'] , $error_message);
			$responce->result_flag = FALSE;
			$message->set_message_exact('fail',$error_message);
			$responce->error_message =  $message->show_message();
		}
		else if($error_flag == 'collide') {
			$error_message_translate = $smarty->translate['employee_non_prefered_time_overlap'];
			$error_message = str_replace ('{{fromDate}}', $overlapedDetails[0]['date_from'], $error_message_translate);
        	$error_message = str_replace ('{{toDate}}', $overlapedDetails[0]['date_to'] , $error_message);
			$responce->result_flag = FALSE;
			$message->set_message_exact('fail',$error_message);
			$responce->error_message =  $message->show_message();
		}
		else if($error_flag == 'collide_slot'){
			$error_message = $smarty->translate['collide_with_existing_slot'] . $overlapedSlotDetails['date'].' => '.$overlapedSlotDetails['time_from'].' - '.$overlapedSlotDetails['time_to'];
			$responce->result_flag = FALSE;
			$message->set_message_exact('fail', $error_message);
			$responce->error_message =  $message->show_message();
		}
		else if($error_flag == 'insertion_error'){
			$responce->result_flag = FALSE;
			$message->set_message('fail', "something_went_wrong");
			$responce->error_message =  $message->show_message();
		}
		echo json_encode($responce);
		exit();
    }

    else if($_POST['action'] && $_POST['action'] == 'delete_time_interval'){
    	$responce  = new stdClass();
    	$group_id  = $_POST['group_id']; 
    	$result    = $obj_emp->delete_employee_non_preferd_time($group_id);
    	if($result){
    		$responce->result_flag = $result;
			$message->set_message('success', "deleted_sucessfully");
    	}
    	else{
    		$responce->result_flag = $result;
			$message->set_message('fail', "something_went_wrong");
			$responce->error_message =  $message->show_message();
    	}
    	echo json_encode($responce);
    	exit();
    }

    else if($_POST['action'] && $_POST['action'] == 'edit_time_interval'){
    	$responce    = new stdClass();
		$user_name   = $_POST['username'];
		$fromDate    = $_POST['fromDate'];
		$toDate      = $_POST['toDate'];
		$dayInterval = $_POST['dayInterval'];
		$group_id    = $_POST['group_id']; 
		$preference_mode  = $_POST['preference_mode'];

		$overlapedDetails = $obj_emp->check_overlapping_time_peroid($fromDate,$toDate,$dayInterval,$user_name,$group_id);
		if(!empty($overlapedDetails)){
            $error_flag = 'collide';

        }
        else{
        	$obj_emp->begin_transaction();
			$delete   = $obj_emp->delete_employee_non_preferd_time($group_id);
			$group_id = $obj_emp->get_group_id();
			if($delete){
				$result   = $obj_emp->save_employee_non_prefered_time($user_name,$fromDate,$toDate,$dayInterval,$group_id, $preference_mode);
				if($result){
					$error_flag = 'success';
					$obj_emp->commit_transaction();
					
				}
			}
			else{
				$error_flag = 'update_error';
				$obj_emp->rollback_transaction();
				
			}
		}
		if($error_flag == 'success'){
			$employee_old_details = $employee->get_employee_detail($user_name);
	        $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_old_details['first_name']. ' '. $employee_old_details['last_name'] : $employee_old_details['last_name']. ' '. $employee_old_details['first_name'];
	        $mail_sub = $smarty->translate['non_prefered_mail_edit_subject'];
	        $mail_msg = $smarty->translate['non_prefered_mail_edit_heading'];
	        $mail_msg .= '<br><br>'.'<strong>'.$logged_employee_name.'</strong>'.' '.$smarty->translate['emp_take_non_preferd_time_range'].'<br>'.'<strong>'.$fromDate.'&nbsp;&nbsp;'.$smarty->translate['to'].'&nbsp;&nbsp;'.$toDate.'</strong>'.'<br>';
	        foreach ($dayInterval as $day => $times) {
	            $mail_msg .= '<strong>'.$smarty->translate[$week[$day-1]['day']].'</strong>'.'<br>';
	            foreach ($times as $key => $value) {
	               $mail_msg .= sprintf('%05.02f', $value['timeFrom']).'-'.sprintf('%05.02f', $value['timeTo']).'<br>';

	            }
	        }
	        
	        mail_send_to_admin_tl_stl($mail_sub,$mail_msg,$employee_old_details,$user_name);
			$responce->result_flag = TRUE;
			$message->set_message('success', 'employee_non_prefered_time_saved_successfully');
		}
		else if($error_flag == 'collide') {
			$error_message_translate = $smarty->translate['employee_non_prefered_time_overlap'];
			$error_message = str_replace ('{{fromDate}}', $overlapedDetails[0]['date_from'], $error_message_translate);
        	$error_message = str_replace ('{{toDate}}', $overlapedDetails[0]['date_to'] , $error_message);
			$responce->result_flag = FALSE;
			$message->set_message_exact('fail',$error_message);
			$responce->error_message =  $message->show_message();
		}
		else if($error_flag == 'update_error'){
			$responce->result_flag = FALSE;
			$message->set_message('fail', "something_went_wrong");
			$responce->error_message =  $message->show_message();
		}

    	echo json_encode($responce);
    	exit();
    }

    else if($_POST['action'] && $_POST['action'] == 'delete_single_time_interval'){
		$id       = $_POST['id'];
		$responce = new stdClass();
		$result   = $obj_emp->delete_single_non_preferred_imterval($id);
    	if($result){
    		$responce->result_flag = $result;
			$message->set_message('success', "deleted_sucessfully");
    	}
    	else{
    		$responce->result_flag = $result;
			$message->set_message('fail', "something_went_wrong");
			$responce->error_message =  $message->show_message();
    	}
    	echo json_encode($responce);
    	exit();
    }
    

    
  	////////    end     //////////


  	$allNonPreferedTime = $obj_emp->get_all_employee_non_prefered_rime($query_string[0], $preference_mode);
  	foreach ($allNonPreferedTime as $key => $value) {
  		$orderdAllNonPreferedTime[$value['group_id']][] =  $value;
  	}
  	// $orderdAllNonPreferedTime = [];
  	// echo "<pre>".print_r($orderdAllNonPreferedTime,1)."</pre>";
  	// exit('f');


	function mail_send_to_admin_tl_stl($mail_sub,$mail_msg,$employee_old_details,$emp_id){
	    // $selected_email_options_number = $obj_emp->get_email_option_of_employee($_SESSION['user_id'])['email'];
	    //     $selected_email_options_number = explode(",",$selected_email_options_number);
	    //     array_pop($selected_email_options_number);
	    //     if(in_array(27, $selected_email_options_number) || empty($selected_email_options_number))
	    require_once('class/employee_ext.php');
	    $obj_emp           = new employee_ext();
	    $tl_of_employee    = $obj_emp->get_team_leader_or_super_tl_of_employee($emp_id,2); // get tl
	    array_walk($tl_of_employee, "change_key_name");
	    $stl_of_employee   = $obj_emp->get_team_leader_or_super_tl_of_employee($emp_id,7); // get super tl 
	    array_walk($stl_of_employee, "change_key_name");
	    $admin_of_employee = $obj_emp->get_admin_data();
	    $mailer = new SimpleMail($mail_sub, $mail_msg);
	    $mailer->addSender("cirrus-noreplay@time2view.se");
	    $selected_email_options_number = $obj_emp->get_email_option_of_employee($emp_id)['email'];
    	$selected_email_options_number = explode(",",$selected_email_options_number);
    	array_pop($selected_email_options_number);
    	if(in_array(27, $selected_email_options_number)){
	    	if($employee_old_details['email'] != '')
	    	$mailer->addRecipient($employee_old_details['email'], trim($employee_old_details['first_name']) . ' ' . trim($employee_old_details['last_name']));
	    }
	    $mail_persons     = array_merge($tl_of_employee, $stl_of_employee,$admin_of_employee);
	    if(!empty($mail_persons)){
	        foreach ($mail_persons as $key => $value) {
	            $mail_persons_employee[] = $value['username'];
	        }
	        $mail_persons_with_email_option = $obj_emp->get_email_option_mail_person($mail_persons_employee);
	        foreach ($mail_persons_with_email_option as $key => $value) {
	            if($value['email'] != ''){
	                $mailer->addRecipient($value['email'], trim($value['first_name']) . ' ' . trim($value['last_name']));
	            }
	        }
	        $mailer->send();
	    }
	}

	function change_key_name(& $item){
	    $item['username'] = $item['employee'];
	    unset($item['employee']);
	}



  	$smarty->assign('orderdAllNonPreferedTime', $orderdAllNonPreferedTime);

    $smarty->assign('message', $message->show_message());

    
	$smarty->display('extends:layouts/dashboard.tpl|employee_non_prefered_timings.tpl|layouts/sub_layout_employee_tabs.tpl');
?>