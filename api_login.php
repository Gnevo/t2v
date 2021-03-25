<?php
session_start();
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
global $db;

//$user->db_master = "t2v_cirrus_common";
//$user->db_master = "time2vie_cirruscomdemo";
$user->db_master = $db['database_master'];
$user->username = $_REQUEST['user'];
$user->password = $_REQUEST['passw'];
$data = $user->validate_login();
if($data) {

	$_SESSION['user_id'] = $user->username;
        $_SESSION['company_sort_by'] = 2;
	$obj->company_ids = $data['company_ids'];
	$obj->access = $data['role'];
	$obj->date = $data['date'];
	$obj->lasttime = $data['last_time'];
}
else {
	$obj->error = "1";
}
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>