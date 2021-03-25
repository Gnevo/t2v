<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/dona.php');
$dona = new dona();

/*$data = $dona->get_all_employee_leave($_REQUEST['year'],$_REQUEST['month']);
$pending_count= 0;
foreach($data as $content){
    if($content["status"] == 0)
        $pending_count++;
}

$total_data_count = count($data);
$obj->count = $total_data_count;
if($total_data_count > 0 && $pending_count > 0){
    $obj->count .= " (". $pending_count.")";
}*/

$leave_list = $dona->get_all_employee_leave();
$unread_leave = $dona->get_unread_leave();
$updated_unread_leave=$dona->get_all_unread_leaves($leave_list,$unread_leave);
$obj->count = count($updated_unread_leave);

header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>