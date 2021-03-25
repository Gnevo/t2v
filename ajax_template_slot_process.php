<?php
/*
 *	@Auther : Sreerag 
 *  Date    : 23/05/2018
 *  copy & Pasting slots(single slot and whole slots in a day) on template.
 */
set_time_limit(FALSE);
require_once('class/setup.php');
require_once ('class/dona.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('class/user.php');
require_once ('class/copy_paste.php');
require_once ('class/template.php');

$smarty         = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", "messages.xml"), FALSE);
$msg            = new message();
$obj_emp        = new employee();
$dona           = new dona();
$obj_user       = new user();
$obj_copy_paste = new copy_paste();
$obj_tmp		= new template();
//$obj_cust = new customer();

$slot_ids = array();
$url = '';
if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != '')
    $url = $smarty->url . 'gdschema_slot_process.php?customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
if (($_REQUEST['employee'] == '' && $_REQUEST['customer'] != '') || (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_customer'))
    $url = $smarty->url . 'gdschema_slot_process.php?customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] == '')
    $url = $smarty->url . 'gdschema_slot_process.php?employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];

if ($_REQUEST['action'] == 'copy_select') {
    $permission_flag = TRUE;
    $slots = explode('-', $_REQUEST['slots']);
    $slot_ids = array();
    foreach ($slots as $slot) {
        $slot_det = $obj_tmp->customer_employee_slot_details($slot);
        if (!empty($slot_det)) {
            $slot_ids[] = $slot;
        }
        if ($slot_det['employee'] != "") {
            if ($slot_det['employee'] != $_SESSION['user_id'] && $_SESSION['user_role'] == 3)
                $permission_flag = FALSE;
        }
    }
    if ($permission_flag) {
        //$_SESSION['copy_slot'] = $slot_ids;
        $obj_user->add_to_temp_session(implode(",", $slot_ids), 1);
        if ($_REQUEST['message'] == 'TRUE')
            $msg->set_message('success', 'day_shift_will_be_copied');
    }
    else
        $msg->set_message('fail', 'permission_denied');
    echo json_encode(true);
}

else if ($_REQUEST['action'] == 'paste_select') {
	$obj_tmp->template_id = $_REQUEST['template_id'];
    unset($_SESSION['fkkn']);
    $process_flag = 1;
   // echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
    $slot_ids = explode(",", $obj_user->retrieve_from_temp_session(1));
    $slot_details = array();
    if (!empty($slot_ids)) {

        if (isset($_REQUEST['sub_action']) && trim($_REQUEST['sub_action']) == 'past_in_month') {

            $dona->begin_transaction();
            $obj_tmp->begin_transaction();
           // $total_count_copy_slots = count($slot_ids);
            $year_month_params = explode('|', $_REQUEST['date']);
            echo "<pre>".print_r($year_month_params,1)."</pre>";
            $start_date = $year_month_params[0] . "-" . $year_month_params[1] . "-01";
            $end_date = $year_month_params[0] . "-" . $year_month_params[1] . "-" . cal_days_in_month(CAL_GREGORIAN, $year_month_params[1], $year_month_params[0]);
            echo $start_date;
            echo $end_date;
            exit('gf');

            if (!empty($slot_ids)) {
                $slot_details = $obj_tmp->customer_employee_multi_slot_details("'" . implode("','", $slot_ids) . "'");
                if (!$obj_tmp->check_given_slots_copiable_between_dates($slot_details, $start_date, $end_date, 1, $_REQUEST['customer'])) {
                    $process_flag = 0;
                }
            }
            if ($process_flag == 1) {
                //echo "<pre>" . print_r($slot_details, 1) . "</pre>";
                foreach ($slot_details as $slot_det) {
                    $date = date('Y-m-d', strtotime($year_month_params[0] . "-" . $year_month_params[1] . '-' . date("d", strtotime($slot_det['date']))));
                    if(strtotime($date) < strtotime($start_date) || strtotime($date) > strtotime($end_date))
                        continue;
                    $filtered_array = $dona->get_datas_customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], $date, $slot_det['time_from'], $slot_det['time_to'], $_SESSION['user_id'], $slot_det['fkkn'], $slot_det['type']);
                    if (!empty($filtered_array))
                        $insert_data_array[] = $filtered_array;
                    	$insert_data_array[] = $_REQUEST['template_id'];
                }
                echo "<pre>".print_r($insert_data_array)."</pre>";
                exit('gf');
                if (!$obj_tmp->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                    $msg->set_message('fail', 'insertion_failed');
                    $this->rollback_transaction();
                    $process_flag = 0;
                }
            }
            if ($process_flag == 1) {
                $dona->commit_transaction();
                $obj_tmp->commit_transaction();
                $msg->set_message_exact('success', '');
                $msg->set_message('success', 'day_shift_pasted_successfully');
            }
            else
                $dona->rollback_transaction();
            	$obj_tmp->rollback_transaction();
        }

        else {
            $dona->begin_transaction();
            $obj_tmp->begin_transaction();
            $slot_details = $obj_tmp->customer_employee_multi_slot_details("'" . implode("','", $slot_ids) . "'");
            $start_date = $end_date = '';
            if ($_REQUEST['to_single_day'] == "TRUE") {
                $start_date = $end_date = $_REQUEST['date'];
            } else {
                $start_date = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0, 4) . "W" . substr($_REQUEST['date'], 5, 2) . "1"));
                $end_date = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0, 4) . "W" . substr($_REQUEST['date'], 5, 2) . "7"));
            }
            if (count($slot_ids)) {

                $check_type = 2;
                if ($_REQUEST['to_single_day'] == 'TRUE')
                    $check_type = 3;
                if (!$obj_tmp->check_given_slots_copiable_between_dates($slot_details, $start_date, $end_date, $check_type, $_REQUEST['customer'])) {
                    //echo "NO";
                    $process_flag = 0;
                }
            }

            if ($process_flag == 1) {

                foreach ($slot_details as $slot_det) {
                    $date = $_REQUEST['date'];
                    if ($_REQUEST['to_single_day'] != 'TRUE')   // for past into a single day (From gdschema_alloc_window)
                            $date = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0, 4) . "W" . substr($_REQUEST['date'], 5, 2) . date("N", strtotime($slot_det['date']))));
                    if(strtotime($date) < strtotime($start_date) || strtotime($date) > strtotime($end_date))
                        continue;
                    $filtered_array = $obj_tmp->get_datas_customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], $date, $slot_det['time_from'], $slot_det['time_to'], $_SESSION['user_id'], $slot_det['fkkn'], $slot_det['type']);
                    if (!empty($filtered_array)){
                    	$filtered_array['tid']	 = $_REQUEST['template_id'];
                        $insert_data_array[] = $filtered_array;
                    }
                }
                // echo $_REQUEST['date'];
                // echo $start_date;
                // echo $end_date;
                // echo "<pre>".print_r($slot_details,1)."</pre>";
                // echo "<pre>".print_r($insert_data_array,1)."</pre>";
                // exit('	fgf');
                if (!$obj_tmp->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                    $msg->set_message('fail', 'insertion_failed');
                    $this->rollback_transaction();
                    $process_flag = 0;
                }
            }

            if ($process_flag == 1) {
                $dona->commit_transaction();
                $obj_tmp->commit_transaction();
                $msg->set_message_exact('success', '');
                $msg->set_message('success', 'day_shift_pasted_successfully');
            }
        }
    }
    else
        $msg->set_message('warning', 'copy_slots_first');
}

else if ($_REQUEST['action'] == 'paste_select_day') { // paste slot with days.

    // echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
    $obj_tmp->template_id = $_REQUEST['template_id'];
    $slot_ids = explode(",", $obj_user->retrieve_from_temp_session(1));
    $slot_details = array();
    $process_flag = 1;
    if (!empty($slot_ids)) {
        
            $dona->begin_transaction();
            $obj_tmp->begin_transaction();
            $slot_details = $obj_tmp->customer_employee_multi_slot_details("'" . implode("','", $slot_ids) . "'");
            // echo "<pre>".print_r($slot_details, 1)."</pre>"; exit();
            $wk = date('W', strtotime($slot_details[0]['date']));
            $copy_start =   date("Y-m-d", strtotime(substr($slot_details[0]['date'],0,4)."-W".$wk."-1"));
            //$copy_start =   $slot_details[0]['date'];
            $paste_start = '';
            $paste_start_day = $_REQUEST['date'];
            $paste_end_day = substr($paste_start_day, 0,8) . cal_days_in_month(CAL_GREGORIAN, substr($paste_start_day, 5,2), substr($paste_start_day, 0,4));
            if ($_REQUEST['to_single_day'] == "TRUE") {
                $wk = date('W', strtotime($_REQUEST['date']));
                $paste_start =   date("Y-m-d", strtotime(substr($_REQUEST['date'],0,4)."-W".$wk."-1"));
            } else {
                $paste_start = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0, 4) . "W" . substr($_REQUEST['date'], 5, 2) . "1"));
                $paste_start_day = $paste_start;
                
            }
            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
            $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($slot_details[count($slot_details)-1]['date'])) . " +" . ($date_diff) . " days"));
            $wk = date('W', strtotime($new_date));
            $paste_end =   date("Y-m-d", strtotime(substr($new_date,0,4)."-W".$wk."-7"));
            if ($_REQUEST['to_single_day'] != "TRUE"){
                $paste_end_day = $paste_end;
            }
            //echo $paste_start_day."-----".$paste_end_day;
            //echo '<pre>'.print_r( array($slot_details, $copy_start, '', $paste_start, $paste_end_day, 1), 1).'</pre>';
            if (!$obj_tmp->check_given_slots_copiable($slot_details, $copy_start, '', $paste_start, $paste_end_day, 1)) {
                    $process_flag = 0;
            }
            
           
            if ($process_flag == 1) {
                //echo $paste_start."-".$copy_start;
                $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                 
                foreach ($slot_details as $slot_det) {
                    $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($slot_det['date'])) . " +" . $date_diff . " days"));
                    if(strtotime($new_date) < strtotime($paste_start_day) || strtotime($new_date) > strtotime($paste_end_day))
                        continue;
                    $filtered_array = $obj_tmp->get_datas_customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], $new_date, $slot_det['time_from'], $slot_det['time_to'], $_SESSION['user_id'], $slot_det['fkkn'], $slot_det['type']);
                    if (!empty($filtered_array)){
                    	$filtered_array['tid']	 = $_REQUEST['template_id'];
                        $insert_data_array[] = $filtered_array;
                    }
                }
                // echo $_REQUEST['date'];
                // echo $paste_start;
                // echo $new_date;
                // echo 'date_diff'.$date_diff;
                // echo "<pre>".print_r($insert_data_array, 1)."</pre>"; 
                // exit();
                if (!$obj_tmp->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                    
                    // print_r($dona->query_error_details);
                    $msg->set_message('fail', 'insertion_failed');
                    $dona->rollback_transaction();
                    $obj_tmp->rollback_transaction();
                    $process_flag = 0;
                }
            }
            if ($process_flag == 1) {
                $dona->commit_transaction();
                $obj_tmp->commit_transaction();
                $msg->set_message_exact('success', '');
                $msg->set_message('success', 'day_shift_pasted_successfully');
            }
        
    }
    else
        $msg->set_message('warning', 'copy_slots_first');
}


?>