<?php
session_start();
require_once('class/setup.php');
require_once('class/user.php');
$smarty = new smartySetup(array("user.xml"));
$user = new user();
$_SESSION['db_name'] = $_REQUEST['db'];
$user->select_db($_SESSION['db_name']);

$user->username = $_REQUEST['user'];
$data = $user->get_employee_detail();
$log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
$_SESSION['log_id'] = $log_id;


$privileges_mc = $user->get_privileges($_REQUEST['user'], 3);
$privileges_general = $user->get_privileges($_REQUEST['user'], 2);
$privileges_rpt = $user->get_privileges($_REQUEST['user'], 5);
$mobi_search = 0;
$cirrus_mail = 0;
if($privileges_mc['cirrus_mail'] == 1)
    $mobi_search = 1;
if($privileges_general['mobile_search'] == 1)
    $cirrus_mail = 1;

$privileges_mc['cirrus_mail'] = $cirrus_mail;
$privileges_general['mobile_search'] = $mobi_search;

$obj->first_name = $data['first_name'];
$obj->last_name = $data['last_name'];
$obj->log_id = $log_id;
$obj->privileges_mc = $privileges_mc;
$obj->privileges_rpt = $privileges_rpt;
$obj->privileges_general = $privileges_general;
$obj->candg_wi = $privileges_general['candg_wi'];
$obj->candg_wo = $privileges_general['candg_wo'];

header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>