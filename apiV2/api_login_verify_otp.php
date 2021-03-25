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
$user->otp_number     = strip_tags(trim($_REQUEST['otp_number']));
$user->fcm_token     = $_REQUEST['fcm_token'];

function sendLoginAuthPush12($to_user,$from_user=null,$data_to_send)
{
	$obj_notification = new notification();
	$obj_employee   = new employee();
	$firebase_obj   = new Firebase();
	$smarty_obj     = new smartySetup(array("mail.xml"), FALSE);
	
	$notification_title = $smarty_obj->translate['app_cirrus_mail_push_notification_title'];
	$notification_description = $smarty_obj->translate['app_cirrus_mail_push_notification_body_new_auth_verification'];
	$notification_image = NULL; //notification image path | https://api.androidhive.info/images/minion.jpg


	//push notification---------------------------------

	$company_details = $obj_employee->company_data();
	$sender_name = NULL;
	if ($from_user == 'root001')
		$sender_name = $company_details['name'];
	elseif($from_user != ''){
		$obj_user = new user();
		$from_user_role = $obj_user->user_role($from_user);
		$from_user_type = $from_user_role == 4 ? 'CUSTOMER' : 'EMPLOYEE';
		$sender_details = array();
		if($from_user_type == 'EMPLOYEE')
			$sender_details = $obj_employee->get_employee_detail($from_user);
		else{
			$obj_customer = new customer();
			$sender_details = $obj_customer->customer_detail($from_user);
		}
		
		$sender_name = $sender_details['last_name'].' '.$sender_details['first_name'];
	}

	$firebase_obj->setTitle($notification_title);
	//$push_body_msg = str_replace ('{{SENDER_NAME}}', $sender_name , $notification_description);
	//$push_body_msg = str_replace ('{{COMPANY_NAME}}', $company_details['name'] , $push_body_msg);
	$push_body_msg = $notification_description;
	$firebase_obj->setMessage($push_body_msg);
	if ($notification_image != NULL)
		$firebase_obj->setImage($notification_image);
	else 
		$firebase_obj->setImage('');
	$firebase_obj->setIsBackground(FALSE);
	$firebase_obj->setPayload($payload);

	$json = $firebase_obj->getPush();
	

	//$regId = $etoken['fcm_token'];
	$regId = $to_user;
	//$regId = "ch2J525zVtM:APA91bFUmeUHQ3dPoi7DAeXUsGmnEZMzeZrA9xIQsl9ZjYHMIBKEuHbhXvW8Gs9wrb_edJJjkUPDMjEgpY9BVD5xHVIwrLYqBHiqA8QWNvJxKop8t_6xPYDqyMkgfSmlCyM8gwA9BG9_";
	$firebase_obj->setDbTokenRecord($etoken);
	$response = $firebase_obj->send($regId, $json,'',$data_to_send);
	//echo "<pre>".print_r($response, 1)."<pre>";exit;
	
	return TRUE;
}

if($user->username == ''){
	
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_username');
    $obj->error_message = $messages->show_message_exact();
}
else if($user->otp_number == ''){
	
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_otp');
    $obj->error_message = $messages->show_message_exact();
}else if($user->fcm_token == ''){
	
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_otp');
    $obj->error_message = $messages->show_message_exact();
}

if ($process_flag) 
{
		$user_id  		= $user->username;
		$otp_number 	= $user->otp_number;
		$authOtp 		= $obj_notification->verify_login_otp($user_id,$otp_number);
		
		
		if($authOtp)
		{
			$obj->error = 0;
			$obj->error_message = "OTP Verified.";
			 
			if($user->fcm_token != "")
			{
				
				$data_to_send = array('verified'=>true);
				$send_veriffy_push = sendLoginAuthPush12($user->fcm_token,null,$data_to_send);
				
			
			}
		}else
		{
			 $obj->error = 1;
			 $obj->error_message = "Invalid username Or OTP.";
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
