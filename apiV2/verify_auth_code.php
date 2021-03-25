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
require_once('class/notification.php');
require_once('plugins/message.class.php');
require_once('configs/config.inc.php');
global $cirrus_password_expiry;
//
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$messages = new message();
$obj_notification = new notification();
global $db, $customer_location_settings;
//$user->db_master = "t2v_cirrus_common";
//$user->db_master = "time2vie_cirruscomdemo";

$obj = new stdClass();
$process_flag = TRUE;

$user->username     = strip_tags(trim($_REQUEST['user_id']));
$user->auth_code     = strip_tags(trim($_REQUEST['auth_code']));
$user->device_id     = strip_tags(trim($_REQUEST['device_id']));



if($user->username == ''){
	
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_username');
    $obj->error_message = $messages->show_message_exact();
}
else if($user->auth_code == ''){
	
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_otp');
    $obj->error_message = $messages->show_message_exact();
}else if($user->device_id == ''){
	
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_otp');
    $obj->error_message = $messages->show_message_exact();
}

if ($process_flag) 
{
		$user_id  		= $user->username;
		$auth_code 		= $user->auth_code;
		$device_id 		= $user->device_id;
		$authOtp 		= $obj_notification->verify_login_email_auth($user_id,$auth_code,$device_id);
		
		
		if($authOtp)
		{
			$obj->error = 0;
			$obj->error_message = "Authentication Code Is Verified.";
			 
		}else
		{
			 $obj->error = 1;
			 $obj->error_message = "Invalid Authentication Code.";
		}
		
        
}
$obj->my_session = session_id();
$obj->my_session_name = session_name();
$obj->cookies = is_array($_COOKIE) && empty($_COOKIE) ? new stdClass() : $_COOKIE ;
$obj->version_code = 3; 
$obj->version_name = "1.0.2"; //"3.6.0"; //"3.4.6"; //"3.4.3";
$obj->ios_version = "3.4.2";
$obj->ios_update_flag = 0;
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
echo json_encode($obj);
?>
