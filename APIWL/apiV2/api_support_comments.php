<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
require_once('class/user.php');
$smarty = new smartySetup(array("user.xml", "support.xml"), FALSE);
$support = new support();
$user = new user();

$loggedin_user = $_SESSION['user_id'];
$user_role = $user->user_role($loggedin_user);
$ticket_id = trim($_REQUEST['ticket_id']);
$answers = $support->get_ticket_answers($ticket_id);
$answers = $answers !== FALSE ? $answers : array();

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $answers;
echo json_encode($main_obj);