<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/leave.php');
$leave = new leave();
$leave->userid = $_REQUEST['userid'];
$leave->mreq_id = $_REQUEST['mreq_id'];
$leave->update_message_status($_REQUEST['status'],$_REQUEST['message_id']);
$obj->success = "0";
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>