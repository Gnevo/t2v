<?php

session_start();
$app_dir = dirname(dirname(realpath(__FILE__)));
chdir($app_dir);

require_once('class/setup.php');
require_once('class/leave.php');
$user_id = $_REQUEST['userid'];

$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$leave->task_id = $_REQUEST['task_id'];
$stop_time = new DateTime();
$stop_time->setTimezone(new DateTimeZone('CET'));
$stop_time->setTimestamp(time());
$stop_time = $stop_time->format('Y-m-d G:i:s');
$break_time = $_REQUEST['candg_break'];

$obj = new stdClass();
$obj->task_id = $leave->update_user_task($user_id, $_REQUEST['status'], $_REQUEST['candg'], $_REQUEST['customer'], $break_time);
$obj->status = $_REQUEST['status'];
$obj->stop_time = $stop_time;
if ($obj->status == 1) {
    $data = $leave->get_task_by_id($leave->task_id);
//$start_time = urldecode($_REQUEST['start_time']); 
    $start_time = $data[0]['dag'] . " " . $data[0]['start_time'];
    $datetime1 = date_create($start_time);
    $datetime2 = date_create($stop_time);
    $interval = date_diff($datetime1, $datetime2);
    $dur = ($interval->days * 24 + $interval->h) . ":" . $interval->format('%i:%s');
    $obj->duration = $dur;
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>