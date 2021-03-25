<?php
/*
 * Author : Shamsudheen
 * description: to get team customer of an employee
 */
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/dona.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml"), FALSE);

$action = strtoupper(trim($_REQUEST['action']));
$obj = new stdClass();
$obj->session_status = $session_check;

if ($action == 'CHECK_SLOT_CREDENTIALS'){
    
    // $obj = new stdClass();
    $obj_customer   = new customer();
    $obj_employee = new employee();
    $obj_dona = new dona();
    $slot_id        = isset($_REQUEST['slot_id']) && trim($_REQUEST['slot_id']) != '' ? trim($_REQUEST['slot_id']) : NULL;
    
    //find tl-flag
    $tl_flag = FALSE;
    $slot_details = array();

    if($slot_id != NULL)
        $slot_details = $obj_dona->customer_employee_slot_details($slot_id);

    if(!empty($slot_details)){
        if($slot_details['customer'] != '' && $slot_details['employee'] != ''){
            if($obj_employee->check_login_employee_to_access_employee($slot_details['employee']) && $obj_customer->check_login_employee_to_access_customer($slot_details['customer']))
                $tl_flag = TRUE;
        }elseif($slot_details['employee'] != '')
            $tl_flag = $obj_employee->check_login_employee_to_access_employee($slot_details['employee']);
        elseif($slot_details['customer'] != '')
            $tl_flag = $obj_customer->check_login_employee_to_access_customer($slot_details['customer']);
        
        //if($slot_details['customer'] != ''){//commeneted by shaju because privilege is not getting for unmanned slot
            $obj->privileges_gd_customer = $obj_employee->get_privileges($_SESSION['user_id'], 1, $slot_details['customer']);
            if(empty($obj->privileges_gd_customer)) $obj->privileges_gd_customer = new stdClass();
        //}

        if($slot_details['status'] == 2){
            $leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot_details['employee'],$slot_details['date'],$slot_details['time_from'],$slot_details['time_to']);
            $leave_data[0]['leave_name'] = $smarty->leave_type[$leave_data[0]['type']];
            $obj->leave_details = $leave_data[0];
        }

        $obj->slot_details = $slot_details;
    }

    $obj->tl_flag = $tl_flag;
    $obj->swap_button_hide = ($slot_id == $_SESSION['swap'] ? 1 : 0);
    $obj->swap_var = $_SESSION['swap'];
}

else if ($action == 'GET_PRIVILEGE_CUSTOMER'){
    
    // $obj = new stdClass();
    $obj_employee = new employee();
    // $slot_id        = trim($_REQUEST['slot_id']);
    $slot_customer  = trim($_REQUEST['customer']);
    
    if(($slot_customer != '' && $_SESSION['user_role'] != 1  && $_SESSION['user_role'] != 6) || $_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6)
        $obj->privileges_gd_customer = $obj_employee->get_privileges($_SESSION['user_id'], 1, $slot_customer);
}

else if ($action == 'GET_PRIVILEGE_EMPLOYEE'){
    
    // $obj = new stdClass();
    $obj_employee = new employee();
    // $slot_id        = trim($_REQUEST['slot_id']);
    
    $obj->privileges_gd_employee = $obj_employee->get_privileges($_SESSION['user_id'], 1);
}

//remove slot
else if($action == 'SLOT_DELETE'){
    $obj_dona = new dona();
    $msg = new message();
    $obj_employee = new employee();
    // $obj = new stdClass();
    
    $slot_id = trim($_REQUEST['id']);
    $process_flag =  TRUE;
    
    $slot_details = $obj_dona->customer_employee_slot_details($slot_id);

    if(trim($slot_id) == '' || empty($slot_details)){
        $process_flag = FALSE;  
        $msg->set_message('fail', 'slot_not_exist');
    }
    if($process_flag && $slot_details['customer'] != '' && $slot_details['employee'] != ''){
        if($obj_employee->chk_employee_rpt_signed($slot_details['employee'], $slot_details['customer'], $slot_details['date'], TRUE)){
              $process_flag = FALSE;
        }
    }
    
    if($process_flag){
        if ($obj_dona->customer_employee_slot_remove($slot_id))
            $msg->set_message('success', 'slot_delete_success');
        else{
            $process_flag = FALSE;  
            $msg->set_message('fail', 'slot_delete_failed');
        }
    }
    $message_data = $msg->show_message_data_for_gritter();
    $obj->message = $message_data->message;
    $obj->status = $process_flag;  
}

//header("content-type: text/javascript");
echo json_encode($obj);
?>