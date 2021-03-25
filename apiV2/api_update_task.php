<?php

require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/user.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();
$obj_user = new user();

$user_id        = $_REQUEST['userid'];
$leave->task_id = isset($_REQUEST['task_id']) ? $_REQUEST['task_id'] : NULL;
$break_time     = $_REQUEST['candg_break'];
$status         = $_REQUEST['status'];
$cng_customer   = $_REQUEST['customer'];

$stop_time = new DateTime();
$stop_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
$stop_time->setTimestamp(time());
$stop_time = $stop_time->format('Y-m-d G:i:s');

$company_details    = $obj_user->get_company($_SESSION['company_id']);
$privileges_general = $obj_user->get_privileges($user_id, 2);
$candg = $company_details['candg'];
if($privileges_general['candg_wi'] == 1 && $privileges_general['candg_wo'] == 0 ){
    $candg = 0;  
}elseif($privileges_general['candg_wi'] == 0 && $privileges_general['candg_wo'] == 1 ){
    $candg = 1;
}

$obj = new stdClass();
$obj->session_status = $session_check;
$obj->candg = $candg;

if($status == 0 && ($cng_customer == '' || $cng_customer == NULL || $cng_customer == '(null)')){
    $obj->task_id = -1;
    $obj->status = $status;
    $obj->error_message = $smarty->translate['select_customer_candg'];
    $obj->stop_time = $stop_time;
}else{
    
    $obj->task_id = $leave->update_user_task($user_id, $status, $candg, $cng_customer, $break_time, $display_message);
    $obj->display_message = $display_message;
    $obj->status = $status;
    $obj->stop_time = $stop_time;
    if ($obj->status == 1) {
        $data = $leave->get_task_by_id($leave->task_id);
        $start_time = $data[0]['dag'] . " " . $data[0]['start_time'];
        $datetime1 = date_create($start_time);
        $datetime2 = date_create($stop_time);
        $interval = date_diff($datetime1, $datetime2);
        $dur = sprintf("%02d", ($interval->days * 24 + $interval->h)) . ":" . sprintf("%02d", $interval->format('%i')) . ":" . sprintf("%02d", $interval->format('%s'));
        $obj->duration = $dur;
    }
    if($obj->task_id === -1){
        $obj->error_message = $smarty->translate['no_slots_to_start_candg'];
    }
    elseif($obj->task_id === -2){
        $obj->error_message = $smarty->translate['slots_exist_between_candg'];
    }
    elseif($obj->task_id === -3){
        $obj->error_message = $smarty->translate['report_signed_candg'];
    }
    elseif($obj->task_id === -4){
        $obj->error_message = $smarty->translate['leave_exists_candg'];
    }elseif($obj->task_id === -5){
        $obj->error_message = $smarty->translate['current_time_beyond_slot_end_candg'];
    }

}
echo json_encode($obj);
?>