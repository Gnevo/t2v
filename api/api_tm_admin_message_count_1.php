<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$data = $leave->get_all_leave_request_admin();
$obj = new stdClass();
$obj->count = sizeof($data);
//header("content-type: text/javascript");
echo json_encode($obj);
?>