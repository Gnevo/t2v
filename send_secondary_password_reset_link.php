<?php  
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/company.php');
require_once('plugins/message.class.php');
require_once('class/mail.php');
require_once('class/sms.php');
$smarty = new smartySetup(array("user.xml", "messages.xml"),FALSE);
$smarty_mail = new smartySetup(array("mail.xml"),FALSE);
$user = new user();
$messages = new message();
$email = new email();
$obj_company = new company();
$obj_sms = new sms();

if ($_SESSION['user_id'] == '') {
    header("Location: " . $smarty->url);
    exit();
} 
else if($_SESSION['user_role'] == 0){
    header("Location: " . $smarty->url);
    exit();
}
//else if ($_SESSION['company_id'] == '') {
//    header("Location: " . $smarty->url . "select/company/");
//    exit();
//}

$is_valid_company_id = TRUE;
$company_details = array();
if($_SESSION['user_role'] != 0){
    $sel_company = strip_tags($_POST['sel_company']);
    if($sel_company != ''){
        $avail_companies = $user->get_user_companies($_SESSION['user_id']);
        $avail_company_ids = array();
        if(!empty($avail_companies)){
            foreach($avail_companies as $avail_company)
                $avail_company_ids[] = $avail_company['id'];
        }
        if(!in_array($sel_company, $avail_company_ids)){
            $is_valid_company_id = FALSE;
            $messages->set_message('error', 'invalid_company');
            header("Location: " . $smarty->url . "secondary/login/");
            exit();
        }
        else {
            $company_details = $obj_company->get_company_detail($sel_company);
        }
    } else {
        $is_valid_company_id = FALSE;
    }
}
    // echo "<pre>".print_r($_POST, 1)."<pre>"; exit();
    

if ($is_valid_company_id && !empty($_POST['username']) && !empty($_POST['method'])) {


    $recovery_method = strip_tags($_POST['method']);

    $user->username = strip_tags($_POST['username']);
    $user->email    = strip_tags($_POST['email']);
    $user->company_id = strip_tags($sel_company);
    $user->mobile   = strip_tags(trim($_POST['mobile']));

    //recovery by mail
    if($recovery_method == 'MAIL-RECOVERY'){

        if($user->email != ''){
            $email_valid = $user->validateEmail($_POST['email']);
            if (!$email_valid) {
                $messages->set_message('error', 'enter_valid_email');
                header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');
                exit();
            }
            $valid = array();
            if($_SESSION['user_role'] != 0)
                $valid = $user->check_username_company_email(); 
            else
                $valid = $user->check_username_email(); 
            if (!empty($valid)){
                $key1 = base64_encode($valid['username']);
                $key2 = base64_encode($valid['password']);
                $key3 = base64_encode($sel_company);
                $url = $smarty->url.'reset_secondary_password/?key1='.$key1.'&key2='.$key2.'&key3='.$key3;

                $translate = $smarty_mail->localise->contents;
                $from = $preference['admin_email'];
                $to = $_POST['email'];
                $subject = $translate['subject_forgot_password'];

                $array_var = array('###UserName###','###PasswordResetLink###');
                $array_value = array(($_SESSION['user_role'] != 0 ? $valid['first_name'].' '.$valid['last_name'] : 'ROOT'), $url);          
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
                // $headers = 'MIME-Version: 1.0' . "\r\n";
                // $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                // $headers .= "From: Cirrus " . $from . "\r\n";
                // $headers .= "Content-type: text/html\r\n";

                $headers = "MIME-Version: 1.0"  . PHP_EOL;
                $headers .= "Content-type:text/html;charset=UTF-8"  . PHP_EOL;
                $headers .= ' From: ' .'cirrus-noreply@time2view.se' . PHP_EOL;

                //$send_mail = mail($to, $subject, $message, $headers, '-f cirrus-noreply@time2view.se');
                $email->addRecipient($to);
                $email->subject = $subject;
                $email->message = $message;
                $send_mail = $email->send();

               // echo "<pre>".print_r($send_mail, 1)."</pre>";
               // echo "<pre>".print_r(array($to, $subject, $message, $headers), 1)."</pre>";
               // echo $send_mail ? 'SUCCESS' : 'FAIL';
               // exit();
                if ($send_mail) {
                    $messages->set_message('success', 'email_password_reset_link_sent');
                    header("Location: " . $smarty->url . "secondary/login/");
                    exit();
                } else {
                    $messages->set_message('fail', 'mail_send_fail');
                    header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');
                    exit();
                }
            }

            $messages->set_message('error', 'username_email_combination_mismatched');
            header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');exit();
        }
        else {
            $messages->set_message('error', 'enter_username_email');
            header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');exit();
        }
    }

    //recovery by mobile
    else if($recovery_method == 'SMS-RECOVERY' && $company_details['recovery_pw_by_mobile'] != 0){

        $filtered_mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($user->mobile));
        while (substr($filtered_mobile, 0, 3) == '+46' && strlen($filtered_mobile) > 1) {
            $filtered_mobile = substr($filtered_mobile, 3, 9999);
        }

        $user->mobile = $filtered_mobile;

        if($user->mobile != ''){
            $mobile_valid = $user->validateMobile($user->mobile);
            if (!$mobile_valid) {
                $messages->set_message('error', 'enter_valid_mobile');
                header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');
                exit();
            }
            $valid = $user->check_username_company_mobile(); 
            if (!empty($valid)){

                $send_sms = FALSE;
                //insert otp entry to db
                $generated_otp = $user->sms_otp_add(); 
                if($generated_otp != FALSE){

                    $obj_sms->login_user = $user->username;
                    // $obj_sms->setCallback('http://demo.arioninfotech.co.in/t2v/sms_callback.php');
                    // $obj_sms->setTag($tag_id);
                    $sms_message = '%0A'.$smarty->translate['otp_message_pre_text'].' '. $generated_otp.'.';
                    $sms_message .= '%0A'.$smarty->translate['username'].' : '. $user->username;
                    $sms_message .= '%0A'.$smarty->translate['company'].' : '. $company_details['name'];
                    $sms_message .= '%0A'.$smarty->translate['otp_message_post_text'];
                    $obj_sms->message = $sms_message;
                    $obj_sms->clearRecipients();
                    $obj_sms->addRecipient($user->mobile);
                    $send_sms = $obj_sms->send_password_otp($user->username, $company_details['db_name']);

                    // $send_sms = TRUE;
                }

                if ($send_sms) {
                    $messages->set_message('success', 'otp_sent_successfully_check_mobile');
                    header("Location: " . $smarty->url . "pword/reset/sms/".$sel_company.'/');
                    exit();
                } else {
                    $messages->set_message('fail', 'otp_send_failed');
                    header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');
                    exit();
                }
            }
            $messages->set_message('error', 'username_mobile_combination_mismatched');
            header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');exit();
        }
        else {
            $messages->set_message('error', 'enter_username_mobile');
            header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');exit();
        }
    }

    //else return an error
    else {
        $messages->set_message('error', 'fill_required_fields');
        header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');exit();
    }
} else {
    $messages->set_message('error', 'fill_required_fields');
    header("Location: " . $smarty->url . "secondary/login/forgotpassword/".$sel_company.'/');exit();
}
?>