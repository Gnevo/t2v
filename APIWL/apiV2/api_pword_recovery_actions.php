<?php
    require_once('api_common_functions.php');
    $session_check = check_user_session(TRUE, FALSE, NULL);

    $obj = new stdClass();
    $obj->session_status = $session_check;

    require_once('class/setup.php');
    require_once('class/user.php');
    require_once('class/company.php');
    require_once('class/mail.php');
    require_once('class/sms.php');
    // require_once('plugins/message.class.php');

    $smarty         = new smartySetup(array("messages.xml", "user.xml", "mobile_app.xml"), FALSE);
    $obj_user       = new user();
    // $obj_msg        = new message();
    $obj_company    = new company();
    
    $action     = isset($_REQUEST['action']) ? strtoupper(trim($_REQUEST['action'])) : NULL;

    $process_flag       = TRUE;
    $company_details    = array();
    $sel_company        = strip_tags($_REQUEST['sel_company']);
    $smarty_mail        = new smartySetup(array("mail.xml"),FALSE);
    global $preference;

    if ($_SESSION['user_id'] == '' || $_SESSION['user_role'] == 0) {
        $obj->message = $smarty->translate['invalid_user'];
        $process_flag =  FALSE;
    }
    elseif($sel_company == ''){
        $obj->message = $smarty->translate['invalid_company'];
        $process_flag =  FALSE;
    }
    else {
        $avail_companies = $obj_user->get_user_companies($_SESSION['user_id']);
        $avail_company_ids = array();
        if(!empty($avail_companies)){
            foreach($avail_companies as $avail_company)
                $avail_company_ids[] = $avail_company['id'];
        }
        if(!in_array($sel_company, $avail_company_ids)){
            $obj->message = $smarty->translate['invalid_company'];
            $process_flag =  FALSE;
        }
    }

    if($process_flag){
        $company_details = $obj_company->get_company_detail($sel_company);

        if($action == 'SEND_EMAIL_RECOVERY' || $action == 'SEND_MOBILE_RECOVERY'){
            
            $obj_user->username = strip_tags($_REQUEST['username']);
            $obj_user->company_id = strip_tags($sel_company);

            //recovery by mail
            if($action == 'SEND_EMAIL_RECOVERY'){

                $obj_user->email    = strip_tags($_REQUEST['email']);
                if($obj_user->email == ''){
                    $obj->message = $smarty->translate['enter_username_email'];
                    $process_flag =  FALSE;
                }
                if($process_flag){
                    $email_valid = $obj_user->validateEmail($_REQUEST['email']);
                    if (!$email_valid) {
                        $obj->message = $smarty->translate['enter_valid_email'];
                        $process_flag =  FALSE;
                    }
                }
                $valid = array();
                if($process_flag){
                    $valid = $obj_user->check_username_company_email(); 
                    if (empty($valid)){
                        $obj->message = $smarty->translate['username_email_combination_mismatched'];
                        $process_flag =  FALSE;
                    }
                }
                if($process_flag){
                    $email  = new email();
                    $key1   = base64_encode($valid['username']);
                    $key2   = base64_encode($valid['password']);
                    $key3   = base64_encode($sel_company);
                    $url    = $smarty->url.'reset_secondary_password/?key1='.$key1.'&key2='.$key2.'&key3='.$key3;

                    $translate  = $smarty_mail->localise->contents;
                    $from       = $preference['admin_email'];
                    $to         = $_REQUEST['email'];
                    $subject    = $translate['subject_forgot_password'];

                    $array_var  = array('###UserName###','###PasswordResetLink###');
                    $array_value= array($valid['first_name'].' '.$valid['last_name'], $url);          
                    $New_date   = date('F jS Y, l');
                    $date_array = explode(" ", date('F jS Y, l')); 
                    $New_date   = str_replace($date_array[0],$translate['label_'.strtolower($date_array[0])], $New_date);
                    $New_date   = str_replace(end($date_array),$translate['label_'.strtolower(end($date_array))], $New_date);         

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
                    $headers = "MIME-Version: 1.0"  . PHP_EOL;
                    $headers .= "Content-type:text/html;charset=UTF-8"  . PHP_EOL;
                    $headers .= ' From: ' .'cirrus-noreply@time2view.se' . PHP_EOL;

                    $email->addRecipient($to);
                    $email->subject = $subject;
                    $email->message = $message;
                    $send_mail = $email->send();

                    if ($send_mail) {
                        $obj->message = $smarty->translate['email_password_reset_link_sent'];
                    } else {
                        $obj->message = $smarty->translate['mail_send_fail'];
                        $process_flag =  FALSE;
                    }
                }
            }

            //recovery by mobile
            else if($action == 'SEND_MOBILE_RECOVERY' && $company_details['recovery_pw_by_mobile'] != 0){

                $obj_user->mobile   = trim($_REQUEST['mobile']);
                $filtered_mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($obj_user->mobile));
                while (substr($filtered_mobile, 0, 3) == '+46' && strlen($filtered_mobile) > 1) {
                    $filtered_mobile = substr($filtered_mobile, 3, 9999);
                }

                $obj_user->mobile = $filtered_mobile;

                if($obj_user->mobile == ''){
                    $obj->message = $smarty->translate['enter_username_mobile'];
                    $process_flag =  FALSE;
                }
                if($process_flag){
                    $mobile_valid = $obj_user->validateMobile($obj_user->mobile);
                    if (!$mobile_valid) {
                        $obj->message = $smarty->translate['enter_valid_mobile'];
                        $process_flag =  FALSE;
                    }
                }
                $valid = array();
                if($process_flag){
                    $valid = $obj_user->check_username_company_mobile(); 
                    if (empty($valid)){
                        $obj->message = $smarty->translate['username_mobile_combination_mismatched'];
                        $process_flag =  FALSE;
                    }
                }
                if($process_flag){
                    $obj_sms = new sms();
                    $send_sms = FALSE;
                    //insert otp entry to db
                    $generated_otp = $obj_user->sms_otp_add(); 
                    if($generated_otp != FALSE){

                        $obj_sms->login_user = $obj_user->username;
                        // $obj_sms->setCallback('http://demo.arioninfotech.co.in/t2v/sms_callback.php');
                        // $obj_sms->setTag($tag_id);
                        $sms_message = '%0A'.$smarty->translate['otp_message_pre_text'].' '. $generated_otp.'.';
                        $sms_message .= '%0A'.$smarty->translate['username'].' : '. $obj_user->username;
                        $sms_message .= '%0A'.$smarty->translate['company'].' : '. $company_details['name'];
                        $sms_message .= '%0A'.$smarty->translate['otp_message_post_text'];
                        $obj_sms->message = $sms_message;
                        $obj_sms->clearRecipients();
                        $obj_sms->addRecipient($obj_user->mobile);
                        $send_sms = $obj_sms->send_password_otp($obj_user->username, $company_details['db_name']);

                        // $send_sms = TRUE;
                    }

                    if ($send_sms) {
                        $obj->message = $smarty->translate['otp_sent_successfully_check_mobile'];
                        // $obj->generated_otp = $generated_otp;
                    } else {
                        $obj->message = $smarty->translate['otp_send_failed'];
                        $process_flag =  FALSE;
                    }
                }
            }

            else {
                $obj->message = $smarty->translate['invalid_action'];
                $process_flag =  FALSE;
            }
     
        }

        elseif($action == 'VALIDATE_MOBILE_RECOVERY_OTP'){
            $obj_user->company_id   = strip_tags($_REQUEST['sel_company']);
            $obj_user->username     = strip_tags($_REQUEST['username']);
            $otp                    = strip_tags($_REQUEST['otp']);

            if($obj_user->company_id == '' || $obj_user->username == '' || $otp == ''){
                $obj->message = $smarty->translate['invalid_otp'];
                $process_flag =  FALSE;
            }

            if($process_flag){
                $otp_validation_data = $obj_user->validate_otp($otp);

                if (empty($otp_validation_data) || $otp_validation_data == FALSE){
                    $obj->message = $smarty->translate['invalid_otp'];
                    $process_flag =  FALSE;
                }
            }

            if($process_flag){

                $expire_time = date('Y-m-d H:i:s', strtotime($otp_validation_data['date']. ' + 15 minutes'));

                $dtz = new DateTime; // current time = server time
                $dtz->setTimestamp(time());
                $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
                $today = $dtz->format('Y-m-d H:i:s'); 
                // $minutes_to_add = 15;
                // $dtz->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                // echo $today = $dtz->format('Y-m-d H:i:s'); 
                // echo "<pre>".print_r(array($today, $expire_time), 1)."<pre>"; exit();

                if(strtotime($today) <= strtotime($expire_time)){
                    $obj->message = $smarty->translate['otp_has_been_verified'];
                }
                else {
                    $obj->message = $smarty->translate['otp_expired'];
                    $process_flag =  FALSE;
                }
            }
                
        }

        elseif($action == 'RESET_NEW_PASSWORD'){
            $obj_user->company_id   = strip_tags($_REQUEST['sel_company']);
            $obj_user->username     = strip_tags($_REQUEST['username']);
            $otp                = strip_tags($_REQUEST['otp']);
            $password           = strip_tags($_REQUEST['password']);
            $cpassword          = strip_tags($_REQUEST['cpassword']);

            if ($obj_user->company_id == '' || $obj_user->username == '' || $otp == '' || $password == '' || $cpassword == '') {
                $obj->message = $smarty->translate['provide_password'];
                $process_flag =  FALSE;
            }
            elseif ($_REQUEST['cpassword'] != $_REQUEST['password']) {
                $obj->message = $smarty->translate['enter_saime_password_re'];
                $process_flag =  FALSE;
            }

            if ($process_flag) {
                //revalidate OTP for extra security
                $otp_validation_data = $obj_user->validate_otp($otp);
            
                if (empty($otp_validation_data) || $otp_validation_data === FALSE) {
                    $process_flag = FALSE;
                    $obj->message = $smarty->translate['invalid_otp'];
                }
            }

            if ($process_flag) {
                $transaction_flag = $obj_user->change_secondary_password($password);
                if($transaction_flag){
                    //delete current otp record
                    $transaction_flag = $obj_user->delete_otp($otp_validation_data['id']);
                    $obj->message = $smarty->translate['reset_password_success'];
                }
                else{
                    $obj->message = $smarty->translate['password_changing_failed'];
                    $process_flag = FALSE;
                }
            }
        }

        else {
            $obj->message = $smarty->translate['invalid_action'];
            $process_flag =  FALSE;
        }
    }
    $obj->status = $process_flag; 
    // if(!$process_flag)
    //     $obj->message = $obj_msg->show_message_exact();

    echo json_encode($obj);
?>