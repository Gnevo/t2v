<?php  
require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml"),FALSE);
$smarty_mail = new smartySetup(array("mail.xml"),FALSE);
$user = new user();

$messages = new message();
//echo "<script>alert('hai');</script>";
if (!empty($_POST['username']) && !empty($_POST['email'])) {
    //echo "<script>alert('hai');</script>";
    $user->username = strip_tags($_POST['username']);
    $user->email = strip_tags($_POST['email']);
		
	$email_valid = $user->validateEmail($_POST['email']);
	if (!$email_valid) {
		$message = 'enter_valid_email';
		$type = "error";
		$messages->set_message($type, $message);
		header("Location: " . $smarty->url . "forgotpassword/");
                exit();
	}
		
	$valid = $user->check_username_email(); 
//        echo "<pre>".print_r($_POST, 1)."</pre>";
//        echo "<pre>".print_r($valid, 1)."</pre>"; exit();
	if (!empty($valid)){ 
            $key1 = base64_encode($valid['username']);
            $key2 = base64_encode($valid['password']);
            $url = $smarty->url.'resetpassword/?key1='.$key1.'&key2='.$key2;

            $translate = $smarty_mail->localise->contents;
            $from = $preference['admin_email'];
            $to = $_POST['email'];
            $subject = $translate['subject_forgot_password'];

            $array_var = array('###UserName###','###PasswordResetLink###');
            $array_value = array($valid['first_name'].' '.$valid['last_name'], $url);			
            $New_date = date('F jS Y, l');
            $date_array = explode(" ", date('F jS Y, l')); 
            $New_date = str_replace($date_array[0],$translate['label_'.strtolower($date_array[0])], $New_date);
            $New_date = str_replace(end($date_array),$translate['label_'.strtolower(end($date_array))], $New_date);			

            $content = "<table width='650' border='0' cellspacing='0' cellpadding='0' style=' background-color:#fff; margin:0 auto; margin-top:3%;'>
              <tr>
                    <td>
                            <table width='650'  height='102'border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                    <td width='45' valign='top' style='background:url(" . $preference['url'] . "mail/header_bg_left.jpg) no-repeat;'><img src='" . $preference['url'] . "mail/header_bg_left.jpg' /></td>
                                            <td width='208' valign='top' style='background-image:url(" . $preference['url'] . "mail/logo_newsletter_cirrus.jpg);'><img src='" . $preference['url'] . "mail/logo_newsletter_cirrus.jpg' /></td>
                                    <td width='397' valign='top' style='background:url(" . $preference['url'] . "mail/header_bg_top.jpg) no-repeat;'><img src='" . $preference['url'] . "mail/header_bg_top.jpg' /></td> 
                              </tr>
                      </table>
                    </td>
              </tr>
              <tr>
                    <td width='650' height='267' valign='top'>
                    <table width='650' border='0' cellspacing='0' cellpadding='0'>
                      <tr>
                            <td width='52'>&nbsp;</td>
                            <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                    <td width='329'>&nbsp;</td>
                                    <td width='209' style='font:normal 12px/19px Tahoma, Geneva, sans-serif; text-align:left; color:#a8a8a8;'>".$New_date ."</td>
                              </tr>
                            </table></td>
                            <td width='60'>&nbsp;</td>
                      </tr>
                      <tr>
                            <td width='52'>&nbsp;</td>
                            <td width='538'>&nbsp;</td>
                            <td width='60'>&nbsp;</td>
                      </tr>
                      <tr>
                            <td width='52'>&nbsp;</td>
                            <td width='538'>&nbsp;</td>
                            <td width='60'>&nbsp;</td>
                      </tr>
                      <tr>
                            <td width='52'>&nbsp;</td>
                            <td width='538'>&nbsp;</td>
                            <td width='60'>&nbsp;</td>
                      </tr>
                      <tr>
                            <td width='52'>&nbsp;</td>
                            <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                    <td width='30'>&nbsp;</td>
                                    <td width='508' style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                            <p>".$translate['label_hi']." ###UserName###, </p><p>".$translate['to_reset_your_password']."
                                            <a TARGET='_blank' href='###PasswordResetLink###'>".$translate['click_here']."</a>.</p>
                                            <p>".$translate['link_not_work_copy_url']."</p>
                                                    ###PasswordResetLink###

                                            <p>".$translate['label_thanks']."</p>
                                    </td>
                              </tr>
                            </table>
                            </td>
                            <td width='60'>&nbsp;</td>
                      </tr>
                      <tr>
                            <td width='52' height='50'>&nbsp;</td>
                            <td width='538' height='50'>&nbsp;</td>
                            <td width='60' height='50'>&nbsp;</td>
                      </tr>
                    </table>
                    </td>
              </tr>
            </table>
            </td>
              </tr>
              <tr>
                    <td width='650' height='91' valign='top'><table width='650' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                    <td width='451' height='25'>&nbsp;</td>
                    <td width='139' height='25' style='font:normal 15px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>".$translate['power_by']."</td>
                    <td width='34' height='25'>&nbsp;</td>
              </tr>
              <tr>
                    <td width='451' height='48'>&nbsp;</td>
                    <td width='139' valign='top'><img src='" . $preference['url'] . "mail/t2v_logo_newsletter.jpg' /></td>

                    <td width='34'>&nbsp;</td>
              </tr>
            </table>
            </td>
              </tr>
            </table>";

            $message = str_replace($array_var,$array_value,$content);
//			$headers = 'MIME-Version: 1.0' . "\r\n";
//			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
//			$headers .= "From: Cirrus " . $from . "\r\n";
//			$headers .= "Content-type: text/html\r\n";

            $headers = "MIME-Version: 1.0"  . PHP_EOL;
            $headers .= "Content-type:text/html;charset=UTF-8"  . PHP_EOL;
            $headers .= ' From: ' .'cirrus-noreply@time2view.se' . PHP_EOL;

        $send_mail = mail($to, $subject, $message, $headers, '-f cirrus-noreply@time2view.se');
//        echo "<pre>".print_r($send_mail, 1)."</pre>";
//        echo "<pre>".print_r(array($to, $subject, $message, $headers), 1)."</pre>";
//        echo $send_mail ? 'SUCCESS' : 'FAIL';
//        exit();
        if ($send_mail) {
            $messages->set_message('success', 'email_password_reset_link_sent');
            header("Location: " . $smarty->url);
            exit();
        } else {
            $messages->set_message('fail', 'mail_send_fail');
            header("Location: " . $smarty->url . "forgotpassword/");
            exit();
        }
    }
    $messages->set_message('error', 'enter_username_not_exist');
    header("Location: " . $smarty->url . "forgotpassword/");exit();

} else {
    $messages->set_message('error', 'enter_username_email');
    header("Location: " . $smarty->url . "forgotpassword/");exit();
}
?>
