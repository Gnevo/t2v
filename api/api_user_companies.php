<?php
//ini_set('display_errors', true);
//ini_set('xdebug.var_display_max_depth', 10);
//error_reporting(E_ALL ^ E_NOTICE);
session_name('t2v-cirrus');
session_start('t2v-cirrus');

$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$messages = new message();

$obj = new stdClass();
$process_flag = TRUE;

$user->username = strip_tags(trim($_REQUEST['user_id']));

if($user->username == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_username');
    $obj->error_message = $messages->show_message_exact();
}

if($process_flag){
    $cur_user = $user->validate_username(); 
    if (!empty($cur_user)) {
        $obj->error = 0;
        $obj->user_id   = $cur_user['username'];
        $obj->user_role = $cur_user['role'];
        $obj->companies = $user->get_user_companies($user->username);

        $_SESSION['user_id']    = $cur_user['username'];
        $_SESSION['user_role']  = $cur_user['role'];
    }
    else {
        $obj->error = 1;
        $messages->set_message('fail', 'invalid_user');
        $obj->error_message = $messages->show_message_exact();
    }
}

$obj->my_session = session_id();
$obj->my_session_name = session_name();
$obj->version_code = 28;
$obj->version_name = "3.6.1";
$obj->ios_version = "3.5.1";    
$obj->ios_update_flag = 1;
echo json_encode($obj);
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
?>
