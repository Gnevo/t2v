<?php
require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once('class/timetable.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", 'gdschema.xml'), FALSE);
$obj_newcustomer = new newcustomer();
$obj_employee = new employee();
$obj_message = new message();
$obj_customer   = new customer();

$return_obj = array();

$this_customer = trim($_REQUEST['customer']);
//$this_month = $temp_month = trim($_REQUEST['month']);
//$this_year = $temp_year = trim($_REQUEST['year']);
$this_template = trim($_REQUEST['template']);
$template_action = (isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'delete') ? 'delete' : 'apply';

$result_flag = TRUE;

$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2, $this_customer);
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
        $customer_details = $obj_customer->customer_data($this_customer);

        $customer_schedules_slots = $obj_newcustomer->getTemplateSlots($this_template);
        $transaction_flag = TRUE;

        $temp_start_date = $template_start_date = trim($_REQUEST['PreviewStartDate']); 
        $no_of_times = trim($_REQUEST['no_of_times']) != '' ? trim($_REQUEST['no_of_times']) : 1;

        if(!empty($customer_schedules_slots)){

            $templates_real_customer = $customer_schedules_slots[0]['template_customer'];
            $is_different_customer_for_template = ($this_customer != $templates_real_customer ? TRUE : FALSE);

            $template_start_day_number = date('N', strtotime($template_start_date));
            //if first day of template slot > applying  date day => applying date automatically change to first day of template slot
            if($template_start_day_number < date('N', strtotime($customer_schedules_slots[0]['date']))){
                $first_schedule_slot_date_day_name = date('l', strtotime($customer_schedules_slots[0]['date']));
                $template_start_date = date('Y-m-d', strtotime("next ".$first_schedule_slot_date_day_name." ". $template_start_date));
                $template_start_day_number = date('N', strtotime($template_start_date));
            }
            
            $temp_start_date = $template_start_date;
            
        //    find actual start date of slot for keeping day of the slot after template pasting
            $actual_starting_date_follows_day_number = '';
            $first_slot_week = date('W', strtotime($customer_schedules_slots[0]['date']));
            foreach ($customer_schedules_slots as $slot){
                if(date('W', strtotime($slot['date'])) != $first_slot_week){
                    $temp_date_day_name = date('l', strtotime($slot['date']));
                    $actual_starting_date_follows_day_number = $slot['date'];
                    $template_start_date = date('Y-m-d', strtotime("next ".$temp_date_day_name." ". $template_start_date));
                    break;
                }
                if(date('N', strtotime($slot['date'])) < $template_start_day_number) continue;
                $actual_starting_date_follows_day_number = $slot['date'];
                break;
            }
            
            $temp_start_date = $template_start_date;
            $first_schedule_slot_date_day_name = date('l', strtotime($customer_schedules_slots[0]['date']));

            //grouping as per day slots
            foreach ($customer_schedules_slots as $skey => $slot){
        //        $slot_date_day = date('d', strtotime($slot['date']));
        //        $customer_schedules_slots[$skey]['date'] = date('Y-m-d', strtotime($this_year .'-'. $this_month . '-' .$slot_date_day ));
                if($is_different_customer_for_template){
                    $customer_schedules_slots[$skey]['customer'] = $this_customer;
                    $customer_schedules_slots[$skey]['cust_name'] = $customer_details['first_name'] . ' ' . $customer_details['last_name'];
                    $customer_schedules_slots[$skey]['employee'] = NULL;
                    $customer_schedules_slots[$skey]['emp_name'] = NULL;
                    $customer_schedules_slots[$skey]['status'] = 0;
                }

                if($this_customer != $customer_schedules_slots[$skey]['customer'])
                    $customer_schedules_slots[$skey]['employee'] = NULL;
                if($customer_schedules_slots[$skey]['customer'] == '' || $customer_schedules_slots[$skey]['employee'] == '')
                    $customer_schedules_slots[$skey]['status'] = 0;
                if($customer_schedules_slots[$skey]['customer'] == '' && $customer_schedules_slots[$skey]['employee'] == '')
                    unset($customer_schedules_slots[$skey]);
            }
        }

        if(empty($customer_schedules_slots) || $actual_starting_date_follows_day_number == ''){
            $transaction_flag = FALSE;
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'template_slots_are_empty_in_this_month');
            $return_obj['full_message'] = $obj_message->show_message();
            $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['template_slots_are_empty_in_this_month'].'</div>';
        }

        $processed_slots = array();
        if($transaction_flag){
            $customer_schedules_slots = array_values($customer_schedules_slots);

            $initial_round = TRUE;
            while($no_of_times > 0){
                foreach ($customer_schedules_slots as $slot_key => $slot){
                    
                        if($slot['date'] < $actual_starting_date_follows_day_number && $initial_round) continue;
                        
                        if(($initial_round && $slot['date'] == $actual_starting_date_follows_day_number) || (!$initial_round && $slot_key == 0)){
                            $slot['date'] = date('Y-m-d', strtotime($temp_start_date));
                        } else {
                            $temp_date_difference = (strtotime($customer_schedules_slots[$slot_key]['date']) - strtotime($customer_schedules_slots[$slot_key-1]['date'])) / 86400;    //86400 = 60 * 60 * 24
                            $slot['date'] = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($temp_start_date)) . " +".$temp_date_difference." days")));
                            $temp_start_date = $slot['date'];
                        }

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

                if(!$transaction_flag) break;

//                $temp_start_date = date("Y-m-d",(strtotime($temp_start_date . " +1 days")));
                $temp_start_date = date('Y-m-d', strtotime("next ".$first_schedule_slot_date_day_name." ". $temp_start_date));
                $no_of_times--;
                $initial_round = FALSE;
            }
        }

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

    else if($template_action == 'delete'){
        $customer_schedule = $obj_newcustomer->get_template_main_details($this_template);
        if(empty($customer_schedule)){
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'template_not_exist');
            $return_obj['full_message'] = $obj_message->show_message();
            $return_obj['return_message'] = '<div class="fail this_msg" style="display: none;">'.$smarty->translate['template_not_exist'].'</div>';
        }
        else {
            if ($obj_newcustomer->delete_schedule_template($this_template)){
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