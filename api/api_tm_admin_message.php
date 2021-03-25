<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$obj = new stdClass();
$leave->userid = $_REQUEST['userid'];
$leave->mreq_id = $_REQUEST['mreq_id'];
$leave->update_message_admin($_REQUEST['message_id'],$_REQUEST['notified']);
$obj->success = "0";
//header("content-type: text/javascript");
echo json_encode($obj);
?>