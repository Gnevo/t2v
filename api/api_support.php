<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('configs/config.inc.php');
require_once('class/support_new.php');
require_once('class/user.php');
$smarty = new smartySetup(array("user.xml", "support.xml"), FALSE);
$support = new support();
$user = new user();

$loggedin_user = $_SESSION['user_id'];
$user_role = $user->user_role($loggedin_user);
$req_status = trim($_REQUEST['status']);
$req_priority = trim($_REQUEST['priority']);
$req_cat_type = trim($_REQUEST['category_type']);
$req_admin = trim($_REQUEST['admin']);
$req_company = trim($_REQUEST['company']);
$req_hidden = trim($_REQUEST['hidden']);
$req_key = trim($_REQUEST['key']);
$req_user = trim($_REQUEST['user']);
$req_st = trim($_REQUEST['st']);
$req_en = trim($_REQUEST['en']);
$sel_status = ($req_status != '' ? $req_status : "NULL");
$sel_priority = ($req_priority != '' ? $req_priority : "NULL");
$sel_cat_type = ($req_cat_type != '' ? $req_cat_type : "NULL");
$sel_admin = ($req_admin != '' ? $req_admin : "NULL");
if (in_array($loggedin_user, $cirrus_admins)) {
    $sel_cat_type = ($req_cat_type != '' ? $req_cat_type : 2);
} elseif ($user_role == 1) {
    $sel_cat_type = ($req_cat_type != '' ? $req_cat_type : 1);
} else {
    $sel_admin = ($req_admin != '' ? $req_admin : "NULL");
}
$sel_company = ($req_company != '' ? $req_company : "NULL");
$sel_hidden = ($req_hidden != '' ? $req_hidden : 0);
$sel_key = ($req_key != '' ? $req_key : "NULL");
$sel_user = ($req_user != '' ? $req_user : "NULL");
$sel_st = ($req_st != '' ? $req_st : 0);
$sel_en = ($req_en != '' ? $req_en : 10);
$tickets = $support->get_tickets($sel_status, $sel_priority, $sel_cat_type, $sel_key, $sel_admin, $sel_company, $sel_user, $sel_hidden, $sel_st, $sel_en);
$ticket_datas = array();
$i = 0;
foreach ($tickets as $ticket) {
    $ticket['description'] = strip_tags($ticket['description']);
    $ticket_datas[$i] = $ticket;
    $ticket_id = $ticket['id'];
    $answers = $support->get_ticket_answers($ticket_id);
    $answer_count = count($answers);
    $ticket_datas[$i]['answer_count'] = $answer_count;
    $i++;
}
echo json_encode($ticket_datas);