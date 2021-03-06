<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('configs/config.inc.php');
require_once('class/support_new.php');
require_once('class/user.php');
$smarty = new smartySetup(array("user.xml", "support.xml"), FALSE);
$support = new support();
$user = new user();

$obj = new stdClass();
$obj->session_status = $session_check;

$loggedin_user 				= $_SESSION['user_id'];
$company_id 				= $_SESSION['company_id'];
$user_role 					= $user->user_role($loggedin_user);
$ticket_id 					= trim($_REQUEST['ticket_id']);
$support->id 				= $ticket_id;
$support->answer 			= trim($_REQUEST['answer']);
$support->login_user 		= $loggedin_user;
$support->answer_status 	= trim($_REQUEST['status']);
$support->category_type 	= trim($_REQUEST['category_type']);
$support->answer_category_id= trim($_REQUEST['category']);
$support->answer_priority 	= trim($_REQUEST['priority']);
$support->answer_ticket_type= trim($_REQUEST['type']);
$support->answer_attachment = $_FILES['attachment'] ? $_FILES['attachment'] : NULL;
if (is_array($_REQUEST['admin'])) {
    $support->answer_admin_user = implode(',', $_REQUEST['admin']);
} else {
    $support->answer_admin_user = trim($_REQUEST['admin']);
}
$support->answer_hidden = (trim($_REQUEST['is_hidden']) != '' ? trim($_REQUEST['is_hidden']) : 0);
$obj->status = FALSE;
if ((int) $ticket_id > 0) {
    $insert_status = $support->insert_ticket_answer();
    if ($insert_status) {
        $obj->status = TRUE;
    } else {
        $obj->status = FALSE;
    }
}
echo json_encode($obj);