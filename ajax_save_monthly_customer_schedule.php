<?php
require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once('class/timetable.php');
require_once('class/employee.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$obj_newcustomer = new newcustomer();
$obj_timetable  = new timetable();
$obj_employee   = new employee();
$obj_message    = new message();

$return_obj = array();
$template_action = trim($_REQUEST['save_action']) == 'replace' ? 'replace' : 'new';

$this_customer = trim($_REQUEST['customer']);
$template_name = trim($_REQUEST['template_new_name']);
$replaced_template = trim($_REQUEST['replaced_template']);
$this_tp_start_month = trim($_REQUEST['start_date']);
$this_tp_end_month = trim($_REQUEST['end_date']);
$result_flag = TRUE;

$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2, $this_customer);

if($privileges_general['create_template'] != 1){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'you_have_no_privilege');
//    $return_obj['return_message'] = $smarty->translate['you_have_no_privilege'];
}
else if($template_action == 'new' && $template_name == ''){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'enter_template_name');
    $return_obj['return_message'] = $smarty->translate['enter_template_name'];
}
else if($template_action == 'replace' && $replaced_template == ''){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'select_a_valid_template_to_replace');
    $return_obj['return_message'] = $smarty->translate['select_a_valid_template_to_replace'];
}
else if($this_customer == '' || $this_tp_start_month == '' || $this_tp_end_month == ''){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'something_wrong');
    $return_obj['return_message'] = $smarty->translate['something_wrong'];
}

$existed_template_id = '';
if($result_flag){
    if($template_action == 'replace'){
        $existed_template_id = $obj_newcustomer->check_exist_template_id($this_customer, $replaced_template);
        if($existed_template_id == ''){
            $result_flag = FALSE;
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'template_not_exist');
            $return_obj['return_message'] = $smarty->translate['template_not_exist'];
        }
    }
}

//$month_sdate = date('Y-m-d', strtotime($this_year .'-'. $this_month . '-01'));
//$month_edate = date('Y-m-t', strtotime($this_year .'-'. $this_month . '-01'));

//echo "<pre>".print_r($selected_month_slots, 1)."</pre>";
if($result_flag){
    
    $this_template_start_month = date('Y-m-d', strtotime($this_tp_start_month));
    $this_template_end_month = date('Y-m-d', strtotime($this_tp_end_month));
    $selected_month_slots = $obj_timetable->customer_slots_btwn_dates($this_customer, $this_template_start_month, $this_template_end_month, array(0, 1));
    // print_r($selected_month_slots);
    // if(empty($selected_month_slots)){
    //     $return_obj['transaction'] = TRUE; // changed on 24-05-2018 old : $return_obj['transaction'] = False
    //     $obj_message->set_message('success', 'template_saved_successfully'); // old: no_slot_available_in_this_period
    //     $return_obj['return_message'] = $smarty->translate['template_saved_successfully'];
    // }
    if(!empty($selected_month_slots) || empty($selected_month_slots)){
        $transaction_flag = TRUE;
        $obj_newcustomer->begin_transaction();

        // delete priviously existed template data
        if($template_action == 'replace'){
            $transaction_flag = $obj_newcustomer->delete_scedule_template_slots($existed_template_id, $this_customer);
            if($transaction_flag){
                //update_template main details
                $transaction_flag = $obj_newcustomer->update_template_main($existed_template_id, $this_template_start_month, $this_template_end_month);
            }
        }
        //create new slot template
        else {
            
            $tmp_template_id = $obj_newcustomer->create_new_template($this_customer, $template_name, $this_template_start_month, $this_template_end_month, $_SESSION['user_id']);
            $return_obj['template_id'] = $tmp_template_id;
            if($tmp_template_id !== FALSE) $existed_template_id = $tmp_template_id;
            else $transaction_flag = FALSE;

            
        }

        if($transaction_flag && !empty($selected_month_slots)){
            $template_slots = array();
            foreach($selected_month_slots as $month_slot){
                    $template_slots[] = array( $existed_template_id, $month_slot['employee'], $month_slot['customer'], $month_slot['date'], (float) $month_slot['time_from'], (float) $month_slot['time_to'],
                        $month_slot['type'], $month_slot['status'], $month_slot['comment'], $month_slot['alloc_emp'], NULL, $month_slot['fkkn'], $month_slot['alloc_comment'], $month_slot['cust_comment']);
            }

            $transaction_flag = $obj_newcustomer->SaveMultipleSlotDatasToTemplate($template_slots);
        }

        if($transaction_flag){
            $obj_newcustomer->commit_transaction();
            $return_obj['transaction'] = TRUE;
            $obj_message->set_message('success', 'template_saved_successfully');
            $return_obj['return_message'] = $smarty->translate['template_saved_successfully'];

            //return updated saved schedule list
            if($this_customer != NULL){
                $return_obj['customer_schedules'] = $obj_newcustomer->customer_template_list($this_customer);
            }

        }
        else{
            $obj_newcustomer->rollback_transaction();
            $return_obj['transaction'] = FALSE;
            $obj_message->set_message('fail', 'template_saving_failed');
            $return_obj['return_message'] = $smarty->translate['template_saving_failed'];
        }
    }
    else {
        $return_obj['transaction'] = FALSE;
        $obj_message->set_message('fail', 'something_wrong');
        $return_obj['return_message'] = $smarty->translate['something_wrong'];
    }
}
$return_obj['full_message'] = $obj_message->show_message();
echo json_encode($return_obj);
//$customer_temp = $customerObj->customer_template_list($customer);
?>