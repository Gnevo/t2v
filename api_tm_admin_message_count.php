<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/leave.php');
$leave = new leave();
$data = $leave->get_all_leave_request_admin();
$obj->count = sizeof($data);
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>