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
$company_id = $_SESSION['company_id'];
$user_role = $user->user_role($loggedin_user);
$req_priority = trim($_REQUEST['priority']);
$req_type = trim($_REQUEST['type']);
$req_cat_type = trim($_REQUEST['category_type']);
$req_category = trim($_REQUEST['category']);
$req_title = trim($_REQUEST['title']);
$req_description = trim($_REQUEST['description']);
$req_admin = trim($_REQUEST['admin']);
$req_affected_user = trim($_REQUEST['affected_user']);
$req_affected_user_phone = trim($_REQUEST['affected_user_phone']);

$support->company_id = $company_id;
$support->category_type = $req_cat_type ;
$support->title = $req_title;
$support->description = $req_description;
$support->login_user = $loggedin_user;
$support->admin_user = $req_admin;
$support->ticket_type = $req_type;
$support->category_id = $req_category;
$support->priority = $req_priority;
$support->status = 1; //Open
$support->affected_user = $req_affected_user;
$support->affected_user_phone = $req_affected_user_phone;
$support->attachment = $_FILES['attachment'] ? $_FILES['attachment'] : NULL;
if ($support->insert_ticket())
    $data = TRUE;
else
    $data = FALSE;
echo json_encode($data);