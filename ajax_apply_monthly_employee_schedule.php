<?php
require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once('class/timetable.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/general.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", 'gdschema.xml'), FALSE);
$obj_newcustomer = new newcustomer();
$obj_employee = new employee();
$obj_message = new message();
$obj_customer   = new customer();
$obj_general = new general();

$return_obj = array();

$this_employee = trim($_REQUEST['employee']);
//$this_month = $temp_month = trim($_REQUEST['month']);
//$this_year = $temp_year = trim($_REQUEST['year']);
$this_template = trim($_REQUEST['template']);
$template_action = (isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'delete') ? 'delete' : 'apply';

$result_flag = TRUE;

$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2);
if($template_action == 'delete' && $privileges_general['create_template'] != 1){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'you_have_no_privilege');
    $return_obj['full_message'] = $obj_message->show_message();
    $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['you_have_no_privilege'].'</div>';
}
else if($template_action == 'apply' && $privileges_general['use_template'] != 1){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'you_have_no_privilege');
    $return_obj['full_message'] = $obj_message->show_message();
    $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['you_have_no_privilege'].'</div>';
}

if($result_flag){
    if($template_action == 'apply'){
        $employee_details = $obj_employee->employee_data($this_employee);

        $transaction_flag = TRUE;
        
        $template_apply_start_date = trim($_REQUEST['PreviewStartDate']); 
        $selected_year = trim($_REQUEST['year']);
        $selected_month = trim($_REQUEST['month']);

        $selected_schedule = $obj_newcustomer->check_exist_employee_template_id($this_employee);
        if($template_apply_start_date == '' || $selected_year == '' || $selected_month == ''){
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'something_wrong');
            $return_obj['full_message'] = $obj_message->show_message();
            $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['something_wrong'].'</div>';
        }
        else if($selected_schedule == FALSE){
            $transaction_flag = FALSE;
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'no_template_exists_for_the_employee');
            $return_obj['full_message'] = $obj_message->show_message();
            $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['template_slots_are_empty_in_this_month'].'</div>';
        }
        
        if($transaction_flag){
            $employee_schedules_slots = $obj_newcustomer->getEmployeeTemplateSlots($selected_schedule);
            
//            echo "<pre>".print_r($employee_schedules_slots, 1)."</pre>";
            if(empty($employee_schedules_slots)){
                $transaction_flag = FALSE;
                $return_obj['transaction'] = FALSE;
                $obj_message->set_message('fail', 'template_slots_are_empty_in_this_month');
                $return_obj['full_message'] = $obj_message->show_message();
                $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['template_slots_are_empty_in_this_month'].'</div>';
            }
            
        }
        if($transaction_flag){
            $template_start_date = $this_month_start_date = date('Y-m-d', strtotime("$selected_year-$selected_month-01")); 
            $this_month_end_date = date('Y-m-t', strtotime($this_month_start_date));
            $selected_month_day_slots = array();
            
            $employee_schedule_main_details = $obj_newcustomer->get_employee_template_main_by_id($selected_schedule);
            $week_difference = $obj_general->datediff('ww', $employee_schedule_main_details['from_date'], $this_month_start_date, false);

            if (!empty($employee_schedules_slots)) {
                $template_start_day_number  = date('N', strtotime($employee_schedule_main_details['from_date']));
                $template_end_day_number    = date('N', strtotime($employee_schedule_main_details['to_date']));
                $total_no_of_weeks_in_template = $obj_general->datediff('ww', $employee_schedule_main_details['from_date'], $employee_schedule_main_details['to_date'], false) + 1;

                //grouping template slots as per day
                $modified_employee_schedules_slots = array();
                foreach ($employee_schedules_slots as $slot) {
                    $modified_employee_schedules_slots[$slot['date']][] = $slot;
                }
            //    echo "<pre>".print_r($modified_employee_schedules_slots, 1)."</pre>";

                $templates_real_employee = $employee_schedules_slots[0]['template_employee'];
                $is_different_employee_for_template = ($this_employee != $templates_real_employee ? TRUE : FALSE);

                if (date('Y-m', strtotime($this_month_start_date)) == date('Y-m', strtotime($employee_schedule_main_details['to_date'])) && $week_difference < 0) {
                    $new_circulation_start_date = $employee_schedule_main_details['from_date'];
                } 
                else if ($week_difference >= 0) {

                    $new_week_to_start_circulation = '';
                    $new_week_to_start_date_circulation = '';
                    //Need seperate week to start new circulation of template slots
                    if ($template_start_day_number <= $template_end_day_number) {
                        $total_no_circulation_completed = (int) ($week_difference / $total_no_of_weeks_in_template);
                        $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
                        $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
                        $new_circulation_start_date = date('Y-m-d', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
                    }
                    //Share the last week to begin next circulation of template slots
                    else {
            //        ++$total_no_of_weeks_in_template;
                        $total_no_circulation_completed = (int) ($week_difference / $total_no_of_weeks_in_template);

                        $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
                        $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
            //        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
                        $new_circulation_start_date = date('Y-m-d', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
                    }
                }

                if ((date('Y-m', strtotime($this_month_start_date)) == date('Y-m', strtotime($employee_schedule_main_details['to_date'])) && $week_difference < 0) || $week_difference >= 0){

                    $date_processed = $new_circulation_start_date;
                    $corresponding_template_date = $employee_schedule_main_details['from_date'];
                    $this_circulation_no = 1;
//                    echo "aa<pre>".print_r($modified_employee_schedules_slots, 1)."</pre>";
                    while ($date_processed <= $this_month_end_date) {
                        if (isset($modified_employee_schedules_slots[$corresponding_template_date]) && $date_processed >= $template_apply_start_date) {
                            foreach ($modified_employee_schedules_slots[$corresponding_template_date] as $slot_key => $slot) {
                                $slot['is_from_schedule'] = TRUE;
                                $slot['date'] = $date_processed;

                                if ($is_different_employee_for_template) {
                                    $slot['customer'] = NULL;
                                    $slot['cust_name'] = NULL;
                                    $slot['employee'] = $this_employee;
                                    $slot['emp_name'] = $employee_details['first_name'] . ' ' . $employee_details['last_name'];
                                    $slot['status'] = 0;
                                }
//                                echo "<pre>".print_r($slot, 1)."</pre>";
                                
                                if($slot['customer'] != '' || $slot['employee'] != '')
                                    $selected_month_day_slots[] = $slot;
                            }
                        }

                        //check next circulation
                        if ($corresponding_template_date == $employee_schedule_main_details['to_date']) {
                            $corresponding_template_date = $employee_schedule_main_details['from_date'];

                            if ($template_start_day_number <= $template_end_day_number) {
                                $tmp_total_weeks_to_completed = $this_circulation_no * $total_no_of_weeks_in_template;
                                $date_processed = date('Y-m-d', strtotime($new_circulation_start_date . " +$tmp_total_weeks_to_completed week"));
                            }
                            //Share the last week to begin next circulation of template slots
                            else {
                                $tmp_total_weeks_to_completed = $this_circulation_no * $total_no_of_weeks_in_template;
                                $date_processed = date('Y-m-d', strtotime($new_circulation_start_date . " +$tmp_total_weeks_to_completed week"));
                            }
                            $this_circulation_no++;
                        } else {
                            $corresponding_template_date = date('Y-m-d', strtotime("$corresponding_template_date +1 day"));
                            $date_processed = date('Y-m-d', strtotime("$date_processed +1 day"));
                        }
                    }
                }
            }
            
            if(empty($selected_month_day_slots)){
                $transaction_flag = FALSE;
                $return_obj['transaction'] = FALSE;
                $obj_message->set_message('fail', 'template_slots_are_empty_in_this_month');
                $return_obj['full_message'] = $obj_message->show_message();
                $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['template_slots_are_empty_in_this_month'].'</div>';
            }
            
            if($transaction_flag){
                $processed_slots = array();
                $selected_month_day_slots = array_values($selected_month_day_slots);

                foreach ($selected_month_day_slots as $slot_key => $slot){
                    $process_params = array(
                        'employee'      =>  $slot['employee'],
                        'customer'      =>  $slot['customer'], 
                        'date'          =>  $slot['date'], 
                        'type'          =>  $slot['type'], 
                        'time_from'     =>  $slot['time_from'], 
                        'time_to'       =>  $slot['time_to']); 

                    if(!$obj_employee->findout_slot_alteration_bug($process_params)){
                        $transaction_flag = FALSE;
                        $return_obj['transaction'] = FALSE;
                        $return_obj['return_message'] = $return_obj['full_message'] = $obj_message->show_message();
                        break;
                    } else {
                        $processed_slots[] = array( $slot['employee'], $slot['customer'], $slot['date'], (float) $slot['time_from'], (float) $slot['time_to'], 
                            $slot['type'], $slot['status'], $slot['comment'], $slot['alloc_emp'], $slot['fkkn']); 
                    }
                }
//                echo "<pre>".print_r($selected_month_day_slots, 1)."</pre>";

                //finally process transactions
                if($transaction_flag){

                    $obj_newcustomer->begin_transaction();
                    $transaction_flag = $obj_newcustomer->save_template_slots_to_timetable($processed_slots);
                    if($transaction_flag){
                        $obj_newcustomer->commit_transaction();
                        $return_obj['transaction'] = TRUE;
                        $return_obj['return_message'] = '<div class="success this_msg" style="display: none;">'.$smarty->translate['schedule_save_success'].'</div>';
                        $obj_message->set_message('success', 'schedule_save_success');
                    }
                    else {
                        $obj_newcustomer->rollback_transaction();
                        $return_obj['transaction'] = FALSE;
                        $obj_message->set_message('fail', 'schedule_save_failed');
                        $return_obj['full_message'] = $obj_message->show_message();
                        $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['schedule_save_failed'].'</div>';
                    }
                }
            }
        }
    }

    else if($template_action == 'delete'){
        $employee_schedule = $obj_newcustomer->check_exist_employee_template_id($this_employee);
        if($employee_schedule == FALSE){
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'template_not_exist');
            $return_obj['full_message'] = $obj_message->show_message();
            $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['template_not_exist'].'</div>';
        }
        else {
            if ($obj_newcustomer->delete_employee_schedule_template($employee_schedule)){
                $return_obj['transaction'] = TRUE;
                $return_obj['return_message'] = '<div class="success this_msg" style="display: none;">'.$smarty->translate['template_deleted_successfully'].'</div>';
                $obj_message->set_message('success', 'template_deleted_successfully');
            }
        }
    }
}
if(empty($return_obj)){
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'something_wrong');
    $return_obj['full_message'] = $obj_message->show_message();
    $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['something_wrong'].'</div>';
}

echo json_encode($return_obj);
?>