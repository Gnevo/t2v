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
$template_action = 'new';

$this_employee = trim($_REQUEST['employee']);
$this_tp_start_month = trim($_REQUEST['start_date']);
$this_tp_end_month = trim($_REQUEST['end_date']);
$result_flag = TRUE;

$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2);

if($privileges_general['create_template'] != 1){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'you_have_no_privilege');
}
else if($this_employee == '' || $this_tp_start_month == '' || $this_tp_end_month == ''){
    $result_flag = FALSE;
    $return_obj['transaction'] = FALSE;
    $obj_message->set_message('fail', 'something_wrong');
    $return_obj['return_message'] = $smarty->translate['something_wrong'];
}

$existed_template_id = FALSE;
if($result_flag){
    $existed_template_id = $obj_newcustomer->check_exist_employee_template_id($this_employee);
}

//$month_sdate = date('Y-m-d', strtotime($this_year .'-'. $this_month . '-01'));
//$month_edate = date('Y-m-t', strtotime($this_year .'-'. $this_month . '-01'));

//echo "<pre>".print_r($selected_month_slots, 1)."</pre>";
if($result_flag){
    
    $this_template_start_month = date('Y-m-d', strtotime($this_tp_start_month));
    $this_template_end_month = date('Y-m-d', strtotime($this_tp_end_month));
    $selected_month_slots = $obj_timetable->employee_slots_btwn_dates($this_employee, $this_template_start_month, $this_template_end_month, array(0, 1));
    if(empty($selected_month_slots)){
        $return_obj['transaction'] = FALSE;
        $obj_message->set_message('fail', 'no_slot_available_in_this_period');
        $return_obj['return_message'] = $smarty->translate['no_slot_available_in_this_period'];
    }
    else if(!empty($selected_month_slots)){
        $transaction_flag = TRUE;
        $obj_newcustomer->begin_transaction();

        // delete priviously existed template data
        if($existed_template_id !== FALSE){
            $transaction_flag = $obj_newcustomer->delete_employee_schedule_template_slots($existed_template_id, $this_employee);
            if($transaction_flag){
                //update_template main details
                $transaction_flag = $obj_newcustomer->update_employee_template_main($existed_template_id, $this_template_start_month, $this_template_end_month);
            }
        }
        //create new slot template
        else {
            $tmp_template_id = $obj_newcustomer->create_new_employee_template($this_employee, $template_name, $this_template_start_month, $this_template_end_month, $_SESSION['user_id']);
            if($tmp_template_id !== FALSE) $existed_template_id = $tmp_template_id;
            else $transaction_flag = FALSE;
        }

        if($transaction_flag){
            $template_slots = array();
            foreach($selected_month_slots as $month_slot){
                    $template_slots[] = array( $existed_template_id, $month_slot['employee'], $month_slot['customer'], $month_slot['date'], (float) $month_slot['time_from'], (float) $month_slot['time_to'],
                        $month_slot['type'], $month_slot['status'], $month_slot['comment'], $month_slot['alloc_emp'], NULL, $month_slot['fkkn'], $month_slot['alloc_comment'], $month_slot['cust_comment']);
            }

            $transaction_flag = $obj_newcustomer->SaveMultipleSlotDatasToEmployeeTemplate($template_slots);
        }

        if($transaction_flag){
            $obj_newcustomer->commit_transaction();
            $return_obj['transaction'] = TRUE;
            $obj_message->set_message('success', 'template_saved_successfully');
            $return_obj['template_id'] = $existed_template_id;
            $return_obj['return_message'] = $smarty->translate['template_saved_successfully'];

        }else{
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