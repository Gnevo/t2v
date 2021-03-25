<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/leave.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml", "messages.xml"), FALSE);
$employee = new employee();
$obj_leave = new leave();
$obj_customer = new customer();

$leave_data = $employee->get_leave_details_byID($_REQUEST['leave_id'], FALSE);  //$_REQUEST['id']
$employee->leave_id     = $leave_data[0]['gid'];
$employee->leave_status = $_REQUEST['status'];

$obj = new stdClass();
$obj->session_status = $session_check;

$transaction_flag = TRUE;

$privileges_mc = $employee->get_privileges($_SESSION['user_id'], 3);//setting message center previlege

$obj->message = '';

//reject operation
if($employee->leave_status == '2'){
    if ($privileges_mc['leave_rejection'] != 1){
        $obj->message = $smarty->translate['permission_denied'];
        $transaction_flag = FALSE;
    }
    
    
    $leave_details  = $employee->get_leave_details_byID($employee->leave_id);
//    $leave_details  = $obj_leave->get_employee_leave_by_groupid($employee->leave_id);
    //echo "<pre>".print_r($leave_details, 1)."</pre>"; exit();

    $vikarie_delete_flag = $_REQUEST['vikarie_delete'] == 0 ? FALSE : TRUE;
    $date_from = $leave_details[0]['leave_date']; //substr($leave_details[0]['From_date'],0,10); 
    $time_from = $leave_details[0]['time_from']; //substr($leave_details[0]['From_date'], 11); //
    $date_to = $leave_details[count($leave_details)-1]['leave_date']; //substr($leave_details[0]['To_date'],0,10); //
    $time_to = $leave_details[count($leave_details)-1]['time_to']; //substr($leave_details[0]['To_date'], 11); //

    $Lemployee = $leave_details[0]['emp_id'];
    
    if($transaction_flag){
        $cur_time = strtotime(date('Y-m-d H:i:s'). ' -90 days');    //curdate changed to curdate-3month
        $leave_start_time = mktime(intval($time_from, 10), ($time_from - intval($time_from, 10))*100, 0, substr($date_from,5,2), substr($date_from,8,2), substr($date_from,0,4));
        if($cur_time >= $leave_start_time){
            $obj->message = $smarty->translate['date_is_passed_cant_cancel_leave'];
            $transaction_flag = FALSE;
        }
    }
    
    if($transaction_flag){

        //check employee signed or not
        $process_date = strtotime($date_from);
        $leave_entries = array();
        $j = 0;
        while ($process_date <= strtotime($date_to)) {
            if ($j == 0 && $process_date == strtotime($date_to))
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, $date_from, $time_from, $time_to));
            else if ($j == 0)
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, $date_from, $time_from, 24));
            else if ($j != 0 && $process_date < strtotime($date_to))
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, date('Y-m-d', $process_date), 0, 24));
            else if ($j != 0 && $process_date == strtotime($date_to))
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, $date_to, 0, $time_to));

            $process_date = strtotime('+1 day', $process_date);
            $j++;
        }
        
        $report_sign_flag = $vikarie_report_sign_flag = 0;
        if(!empty($leave_entries)){
            //check employee signed or not
            foreach($leave_entries as $lentry){
                if ($employee->chk_employee_rpt_signed($lentry['employee'], $lentry['customer'], $lentry['date']) == 1){
                    $report_sign_flag = 1;
                    $transaction_flag = FALSE;
                    
                    $emp_details = $employee->get_employee_detail($lentry['employee']);
                    $customer_details = $obj_customer->customer_detail($lentry['customer']);
                    $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                    $cust_name = $customer_details['last_name'] . ' ' . $customer_details['first_name'];

                    $obj->message = $smarty->translate['employee_already_signed_cant_cancel_leave']. ' '. $emp_name . ' <-> ' . $cust_name . ' => ' . $lentry['date'];
                    break;
                }
            }

            //check vikaries signed or not
            if ($report_sign_flag == 0 && $report_sign_flag == 0) {
                foreach($leave_entries as $lentry){
                    $pending_child_slots = array( array('id' => $lentry['id'], 'employee' => $lentry['employee'], 'customer' => $lentry['customer'], 'date' => $lentry['date']));
                    while(!empty($pending_child_slots)){
                        $sub_root = array_pop($pending_child_slots);
                        $sub_childs = $employee->check_relations_in_timetable_for_leave($sub_root['id']);
                        if(!empty($sub_childs)){
                            $pending_child_slots = array_merge($pending_child_slots,$sub_childs);
                        }elseif($sub_root['employee'] != '' && $sub_root['customer'] != ''){
                            $vikarie_report_sign_flag = $employee->chk_employee_rpt_signed($sub_root['employee'],$sub_root['customer'], $sub_root['date']);
                            if($vikarie_report_sign_flag == 1){
                                $emp_details = $employee->get_employee_detail($sub_root['employee']);
                                $customer_details = $obj_customer->customer_detail($sub_root['customer']);
                                $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                                $cust_name = $customer_details['last_name'] . ' ' . $customer_details['first_name'];

                                $obj->message = $smarty->translate['substitue_already_signed']. ' '. $emp_name . ' <-> ' . $cust_name . ' => ' . $sub_root['date'];
                                $transaction_flag = FALSE;
                                break;
                            }
                        }
                    }

                    if($vikarie_report_sign_flag == 1) break;
                }
            }
        }
    }
}

//accept operation
else {
    if ($privileges_mc['leave_approval'] != 1){
        $obj->message = $smarty->translate['permission_denied'];
        $transaction_flag = FALSE;
    }
}

if($transaction_flag){
    if($employee->leave_status == '2'){
        if($employee->update_leave_status($Lemployee, $date_from, $date_to, $time_from, $time_to, $vikarie_delete_flag)){
            $obj->result = TRUE;
            $obj->message = $smarty->translate['leave_reject_success'];
        }else{
            $obj->result = FALSE;
            $obj->message = $smarty->translate['leave_reject_fail'];
        }
    }else {
        if($employee->update_leave_status()){
            $obj->result = TRUE;
            $obj->message = $smarty->translate['leave_accept_success'];
        }else{
            $obj->result = FALSE;
            $obj->message = $smarty->translate['leave_accept_fail'];
        }
    }
    
    if($obj->result){
        $leave_details  = $employee->get_leave_details_byID($employee->leave_id);
        $obj->treated_employee_name = $leave_details[0]['appr_empname'];
        $obj->treated_date          = $leave_details[0]['appr_date'];
    }
} else
    $obj->result = FALSE;

echo json_encode($obj);
?>