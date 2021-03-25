<?php
    require_once('api_common_functions.php');
    $session_check = check_user_session();

    $obj = new stdClass();
    $obj->session_status = $session_check;

    require_once('class/setup.php');
    require_once('class/user.php');
    require_once('class/company.php');
    require_once('class/mail.php');
    require_once('class/sms.php');
    require_once('class/employee.php');
    require_once('class/customer.php');
    // require_once('plugins/message.class.php');

    $smarty         = new smartySetup(array("user.xml", "mobile_app.xml"), FALSE);
    $obj_user       = new user();
    // $obj_msg        = new message();
    
    $action     = isset($_REQUEST['action']) ? strtoupper(trim($_REQUEST['action'])) : NULL;

    $process_flag       = TRUE;
    $user_id            = strip_tags($_REQUEST['user_id']);
    $company_id         = strip_tags($_REQUEST['company_id']);
    $smarty_mail        = new smartySetup(array("mobile_app.xml", "mail.xml"),FALSE);
    global $preference;

    if ($_SESSION['user_id'] == '' || $_SESSION['user_role'] == 0 || $user_id != $_SESSION['user_id']) {
        $obj->message = $smarty->translate['invalid_user'];
        $process_flag =  FALSE;
    }
    elseif($_SESSION['company_id'] == '' || $_SESSION['company_id'] != $company_id){
        $obj->message = $smarty->translate['invalid_company'];
        $process_flag =  FALSE;
    }
    else {
        $user_type = $_SESSION['user_role'] == 4 ? 'CUSTOMER' : 'EMPLOYEE';
        $user_details = array();
        if($user_type == 'EMPLOYEE'){
            $obj_employee = new employee();
            $user_details = $obj_employee->get_employee_detail($user_id);
        }
        else{
            $obj_customer = new customer();
            $user_details = $obj_customer->customer_detail($user_id);
        }

        if(empty($user_details)){
            $obj->message = $smarty->translate['invalid_user'];
            $process_flag =  FALSE;
        }
    }

    if($process_flag){
        if($action == 'GET_USER_DETAILS'){
            if ($user_details['mobile'] != "") {
                $length_mobile_display = (strlen($user_details['mobile']) - 5) / 2;
                $temp_mobile = '';
                $pos = 5;
                for ($i = 0; $i < $length_mobile_display; $i++) {
                    $temp_mobile = $temp_mobile . " " . substr($user_details['mobile'], $pos, 2);
                    $pos = $pos + 2;
                }
                $user_details['mobile'] = "+46" . substr($user_details['mobile'], 0, 3) . " " . substr($user_details['mobile'], 3, 2) . " " . $temp_mobile;
            }
            if ($user_details['phone'] != "") {
                $user_details['phone'] = "0" . substr($user_details['phone'], 0, 2) . "-" . substr($user_details['phone'], 2);
            }

            $obj->user_details = $user_details;
        }

        else if($action == 'CHANGE_EMAIL'){
            
            $new_email      = strip_tags(trim($_REQUEST['new_email']));
            $email_valid    = $obj_user->validateEmail($new_email);
            if(!isset($_REQUEST['new_email']) || ($new_email != '' && !$email_valid)){
                $obj->message = $smarty->translate['enter_valid_email'];
                $process_flag =  FALSE;
            }
            else {
                if($new_email != $user_details['email']){
                    if($user_type == 'EMPLOYEE'){
                        $obj_employee = new employee();
                        $transaction_flag = $obj_employee->update_employee_email($user_id, $new_email);
                    }
                    else{
                        $obj_customer = new customer();
                        $transaction_flag = $obj_customer->update_customer_email($user_id, $new_email);
                    }

                    if($transaction_flag){
                        $obj->message = $smarty->translate['user_email_updated_successfully'];
                    }
                    else {
                        $obj->message = $smarty->translate['user_email_updation_has_been_failed'];
                        $process_flag =  FALSE;
                    }
                }
                else {
                    $obj->message = $smarty->translate['there_is_no_change_in_field_updation'];
                    $process_flag =  FALSE;
                }
            }
        }

        else if($action == 'CHANGE_MOBILE'){
            
            $new_mobile      = strip_tags(trim($_REQUEST['new_mobile']));

            $filtered_mobile = str_replace(array("-", " ", ",", ".", "_"), "", $new_mobile);
            while (substr($filtered_mobile, 0, 3) == '+46' && strlen($filtered_mobile) > 1) {
                $filtered_mobile = substr($filtered_mobile, 3, 9999);
            }

            $mobile_valid = $obj_user->validateMobile($filtered_mobile);
            if(!isset($_REQUEST['new_mobile']) || ($filtered_mobile != '' && !$mobile_valid)){
                $obj->message = $smarty->translate['enter_valid_mobile'];
                $process_flag =  FALSE;
            }
            else {
                if($filtered_mobile != $user_details['mobile']){

                    if($user_type == 'EMPLOYEE'){
                        $obj_employee = new employee();
                        $transaction_flag = $obj_employee->update_employee_mobile($user_id, $filtered_mobile);
                    }
                    else{
                        $obj_customer = new customer();
                        $transaction_flag = $obj_customer->update_customer_mobile($user_id, $filtered_mobile);
                    }

                    if($transaction_flag)
                        $transaction_flag = $obj_user->login_update_mobile($user_id, $filtered_mobile);

                    if($transaction_flag){
                        $obj->message = $smarty->translate['user_mobile_updated_successfully'];
                    }
                    else {
                        $obj->message = $smarty->translate['user_mobile_updation_has_been_failed'];
                        $process_flag =  FALSE;
                    }
                }
                else {
                    $obj->message = $smarty->translate['there_is_no_change_in_field_updation'];
                    $process_flag =  FALSE;
                }
            }
        }

        else if($action == 'SEND_EMAIL_VERIFICATION'){
            
            $obj_user->username = $user_id;
            $obj_user->company_id = strip_tags($company_id);
            $obj_user->email    = trim($user_details['email']);
            $already_verified = FALSE;

            if($obj_user->email == ''){
                $obj->message = $smarty->translate['no_email_found_to_verify'];
                $process_flag =  FALSE;
            }
            elseif($user_details['email_verified'] == 1){
                $obj->message = $smarty->translate['email_already_verified'];
                $process_flag =  TRUE;
                $already_verified = TRUE;
            }
            if($process_flag && !$already_verified){
                $generated_otp = $obj_user->email_otp_add('EMAIL_VERIFY'); 
                $send_mail = FALSE;

                if($generated_otp != FALSE){
                    $email  = new email();

                    $translate  = $smarty_mail->localise->contents;
                    $from       = $preference['admin_email'];

                    $array_var  = array('###UserName###','{{SECURITY_OTP}}');
                    $array_value= array($user_details['first_name'].' '. $user_details['last_name'], '<b>'.$generated_otp.'</b>');          
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
                                                        <p>".$translate['label_hi']." ###UserName###, </p><br/><br/><p>".$translate['email_verify_mail_content']."</p>
                                                        <br/><p>".$translate['label_thanks']."</p>
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

                    $email->addRecipient($obj_user->email);
                    $email->subject = $translate['email_verify_mail_subject'];
                    $email->message = $message;
                    $send_mail = $email->send();
                }

                if ($send_mail) {
                    $obj->message = $smarty->translate['email_verification_mail_sent_successfully_check_mail'];
                    $obj->recipient_mail = $obj_user->email;
                    $obj->generated_otp = $generated_otp;
                } else {
                    $obj->message = $smarty->translate['email_verification_mail_send_failed'];
                    $process_flag =  FALSE;
                }
            }
        }

        else if($action == 'SEND_MOBILE_VERIFICATION'){
            
            $obj_user->username = $user_id;
            $obj_user->company_id = strip_tags($company_id);
            $obj_user->mobile   = trim($user_details['mobile']);
            $already_verified = FALSE;

            if($obj_user->mobile == ''){
                $obj->message = $smarty->translate['no_mobile_found_to_verify'];
                $process_flag =  FALSE;
            }
            elseif($user_details['mobile_verified'] == 1){
                $obj->message = $smarty->translate['mobile_already_verified'];
                $process_flag =  TRUE;
                $already_verified = TRUE;
            }
            if($process_flag && !$already_verified){
                $obj_sms = new sms();
                $send_sms = FALSE;
                //insert otp entry to db
                $generated_otp = $obj_user->sms_otp_add('MOBILE_VERIFY'); 
                if($generated_otp != FALSE){
                    $obj_company    = new company();
                    $company_details = $obj_company->get_company_detail($obj_user->company_id);
                    $obj_sms->login_user = $obj_user->username;
                    // $obj_sms->setCallback('http://demo.arioninfotech.co.in/t2v/sms_callback.php');
                    // $obj_sms->setTag($tag_id);
                    $sms_message = '%0A'.$smarty->translate['mobile_verify_otp_message_pre_text'].' '. $generated_otp.'.';
                    $sms_message .= '%0A'.$smarty->translate['username'].' : '. $obj_user->username;
                    $sms_message .= '%0A'.$smarty->translate['company'].' : '. $company_details['name'];
                    $sms_message .= '%0A'.$smarty->translate['mobile_verify_otp_message_post_text'];
                    $obj_sms->message = $sms_message;
                    $obj_sms->clearRecipients();
                    $obj_sms->addRecipient($obj_user->mobile);
                    $send_sms = $obj_sms->send_password_otp($obj_user->username, $company_details['db_name']);

                    // $send_sms = TRUE;
                }

                if ($send_sms) {
                    $obj->message = $smarty->translate['mobile_verify_otp_sent_successfully_check_mobile'];
                    $obj->recipient_mobile = $obj_user->mobile;
                    $obj->generated_otp = $generated_otp;
                } else {
                    $obj->message = $smarty->translate['mobile_verify_otp_send_failed'];
                    $process_flag =  FALSE;
                }
            }
        }

        elseif($action == 'VALIDATE_MOBILE_VERIFY_OTP'){
            $obj_user->company_id   = $company_id;
            $obj_user->username     = $user_id;
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
                elseif($otp_validation_data['mobile'] != trim($user_details['mobile'])){
                    $obj->message = $smarty->translate['mobile_verify_otp_does_not_match_current_user_mobile'];
                    $process_flag =  FALSE;
                }
            }

            if($process_flag){

                $expire_time = date('Y-m-d H:i:s', strtotime($otp_validation_data['date']. ' + 15 minutes'));

                $dtz = new DateTime; // current time = server time
                $dtz->setTimestamp(time());
                $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
                $today = $dtz->format('Y-m-d H:i:s'); 

                if(strtotime($today) <= strtotime($expire_time)){
                    if($user_type == 'EMPLOYEE'){
                        $obj_employee = new employee();
                        $transaction_flag = $obj_employee->update_employee_data_verification_flags($user_id, 'MOBILE', 1);
                    }
                    else{
                        $obj_customer = new customer();
                        $transaction_flag = $obj_customer->update_customer_data_verification_flags($user_id, 'MOBILE', 1);
                    }

                    if($transaction_flag){
                        $transaction_flag = $obj_user->delete_otp($otp_validation_data['id']);
                        $obj->message = $smarty->translate['otp_validation_success_mobile_has_been_set_to_be_verified'];
                    }
                    else {
                        $obj->message = $smarty->translate['error_in_mobile_verification_try_again'];
                        $process_flag =  FALSE;
                    }
                }
                else {
                    $obj->message = $smarty->translate['mobile_verify_otp_expired'];
                    $process_flag =  FALSE;
                }
            }
        }

        elseif($action == 'VALIDATE_EMAIL_VERIFY_OTP'){
            $obj_user->company_id   = $company_id;
            $obj_user->username     = $user_id;
            $otp                    = strip_tags($_REQUEST['otp']);

            if($obj_user->company_id == '' || $obj_user->username == '' || $otp == ''){
                $obj->message = $smarty->translate['invalid_otp'];
                $process_flag =  FALSE;
            }

            if($process_flag){
                $otp_validation_data = $obj_user->validate_email_otp($otp);

                if (empty($otp_validation_data) || $otp_validation_data == FALSE){
                    $obj->message = $smarty->translate['invalid_otp'];
                    $process_flag =  FALSE;
                }
                elseif($otp_validation_data['email'] != trim($user_details['email'])){
                    $obj->message = $smarty->translate['email_verify_otp_does_not_match_current_user_email'];
                    $process_flag =  FALSE;
                }
            }

            if($process_flag){

                $expire_time = date('Y-m-d H:i:s', strtotime($otp_validation_data['date']. ' + 15 minutes'));

                $dtz = new DateTime; // current time = server time
                $dtz->setTimestamp(time());
                $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
                $today = $dtz->format('Y-m-d H:i:s'); 

                if(strtotime($today) <= strtotime($expire_time)){
                    if($user_type == 'EMPLOYEE'){
                        $obj_employee = new employee();
                        $transaction_flag = $obj_employee->update_employee_data_verification_flags($user_id, 'EMAIL', 1);
                    }
                    else{
                        $obj_customer = new customer();
                        $transaction_flag = $obj_customer->update_customer_data_verification_flags($user_id, 'EMAIL', 1);
                    }

                    if($transaction_flag){
                        $transaction_flag = $obj_user->delete_email_otp($otp_validation_data['id']);
                        $obj->message = $smarty->translate['otp_validation_success_email_has_been_set_to_be_verified'];
                    }
                    else {
                        $obj->message = $smarty->translate['error_in_email_verification_try_again'];
                        $process_flag =  FALSE;
                    }
                }
                else {
                    $obj->message = $smarty->translate['email_verify_otp_expired'];
                    $process_flag =  FALSE;
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