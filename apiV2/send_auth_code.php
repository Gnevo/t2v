<?php
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
$user->device_id   	= strip_tags(trim($_REQUEST['device_id']));
$user->auth_code   	= strip_tags(trim($_REQUEST['auth_code']));

if($user->username == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_username');
    $obj->error_message = $messages->show_message_exact();
}else if($user->device_id == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_device_id');
    $obj->error_message = $messages->show_message_exact();
}else if($user->auth_code == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_device_id');
    $obj->error_message = $messages->show_message_exact();
}


if ($process_flag) 
{
	
	$cur_username_main_login= $user->validate_username();
	$cur_user               = $user->validate_secondary_login();
		
	
    //if valid user do following
    if (!empty($cur_username_main_login)) 
	{
		$user_id  		= 	$cur_username_main_login['username'];
		$db_name 		= 	$_SESSION['db_name'];
		$role			=	$cur_username_main_login['role'];
		$userDataArr	= 	$user->get_email_from_username($user_id, $role, $db_name);
		
		$receipientEmail = $userDataArr['email'];
		//$receipientEmail = "sanket.jayani@gmail.com";
		
		
		$mail_subject = "Cirrus - R Authentication Code For Login.";
		$mail_message = "Your Login Auth Code Is - ". $user->auth_code;
		
		$mail = new SimpleMail($mail_subject, $mail_message);
		$mail->addSender("cirrus-noreplay@time2view.se");
		$mail->addRecipient($receipientEmail);
		//$mail->addRecipient("sanket.jayani@gmail.com");
		$email_send = $mail->send();
		
        if($email_send)
		{
			$obj->error = 0;
			$obj->error_message = "Authentication Code Has Been Sent To Your Registered Email Address.";
		}else
		{
			 $obj->error = 1;
			 $obj->error_message = "Sorry Email Cant Sent";
		}
		
		
	}
	else 
	{  
		//if not valid user
		$cur_user_main = $user->validate_username();
		$cur_username = $user->validate_secondary_login_username();
		if (!empty($cur_user_main) && !empty($cur_username)) {
			if ($cur_username['password'] != NULL) {

				$user->username = $cur_username['username'];
				$user->error = $cur_username['error'];
				if (md5($smarty->hash . strip_tags($_POST['password'])) != $cur_username['password']) {

					if ($cur_username['last_login_time'] != '0000-00-00 00:00:00') {
						$set_error = $user->set_secondary_login_error();
					}
					$messages->set_message('fail', 'invalid_password');
					$process_flag = FALSE;
					$obj->error = 1;
					$obj->error_message = $messages->show_message_exact();
				}
			} else {
				$messages->set_message('fail', 'contact_administrator');
				$process_flag = FALSE;
				$obj->error = 1;
				$obj->error_message = $messages->show_message_exact();
			}
		} else {
			$messages->set_message('fail', 'invalid_user');
			$process_flag = FALSE;
			$obj->error = 1;
			$obj->error_message = $messages->show_message_exact();
		}
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
