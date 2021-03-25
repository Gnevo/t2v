<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname(realpath(__FILE__)));
chdir($app_dir);

require_once('class/setup.php');
require_once('class/leave.php');
$user_id = $_REQUEST['userid'];

$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$leave->task_id = isset($_REQUEST['task_id'])?$_REQUEST['task_id']:null;
$stop_time = new DateTime();
$stop_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
$stop_time->setTimestamp(time());
$stop_time = $stop_time->format('Y-m-d G:i:s');
$break_time = $_REQUEST['candg_break'];
$obj = new stdClass();
if($_REQUEST['status'] == 0 && ($_REQUEST['customer'] == '' || $_REQUEST['customer'] == NULL || $_REQUEST['customer'] == '(null)')){
    $obj->task_id = -1;
    $obj->status = $_REQUEST['status'];
    $obj->error_message = $smarty->translate['select_customer_candg'];
    $obj->stop_time = $stop_time;
}else{
    $obj->task_id = $leave->update_user_task($user_id, $_REQUEST['status'], $_REQUEST['candg'], $_REQUEST['customer'], $break_time, $display_message);
    $obj->display_message = $display_message;
    $obj->status = $_REQUEST['status'];
    $obj->stop_time = $stop_time;
    if ($obj->status == 1) {
        $data = $leave->get_task_by_id($leave->task_id);
        //$start_time = urldecode($_REQUEST['start_time']); 
        $start_time = $data[0]['dag'] . " " . $data[0]['start_time'];
        $datetime1 = date_create($start_time);
        $datetime2 = date_create($stop_time);
        $interval = date_diff($datetime1, $datetime2);
        $dur = sprintf("%02d", ($interval->days * 24 + $interval->h)) . ":" . sprintf("%02d", $interval->format('%i')) . ":" . sprintf("%02d", $interval->format('%s'));
        $obj->duration = $dur;
    }
    ////echo "shaju".$obj->task_id;
    if($obj->task_id === -1){
        $obj->error_message = $smarty->translate['no_slots_to_start_candg'];
    }
    if($obj->task_id === -2){
        $obj->error_message = $smarty->translate['slots_exist_between_candg'];
    }
    if($obj->task_id === -3){
        $obj->error_message = $smarty->translate['report_signed_candg'];
    }
    if($obj->task_id === -4){
        $obj->error_message = $smarty->translate['leave_exists_candg'];
    }
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>