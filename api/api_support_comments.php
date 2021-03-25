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
$ticket_id = trim($_REQUEST['ticket_id']);
$answers = $support->get_ticket_answers($ticket_id);
echo json_encode($answers);