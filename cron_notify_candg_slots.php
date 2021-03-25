<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
/*
 * created by: Shamsu
 * purpose : Push notification to employees who not started candg slots
 */
require_once('class/company.php');
require_once('class/timetable.php');
require_once('class/notification.php');
require_once('class/mail.php');
require_once('class/setup.php');
require_once('plugins/firebase.php');
// require_once('plugins/firebase_push.php');
$smarty_obj = new smartySetup(array("company.xml", "mail.xml"),FALSE);

$company_obj = new company();
$obj_timetable = new timetable();
$obj_notification = new notification();
// global $firebase_settings;

// Firebase API Key
// define('FIREBASE_API_KEY', $firebase_settings['api_key']);
$firebase_obj = new Firebase();
// $firebase_push_obj = new FirebasePush();

$companies = $company_obj->company_list();
$dtz = new DateTime; // current time = server time
$dtz->setTimestamp(time());
$dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
$cur_time = date('Y-m-d H:i:s', strtotime($dtz->format('Y-m-d H:i:s')));
$time_before_20 = date('Y-m-d H:i:s', strtotime('-20 minutes', strtotime($dtz->format('Y-m-d H:i:s'))));

$__cur_time = (float) date('H.i', strtotime($dtz->format('Y-m-d H:i:s')));
$__time_before_20 = (float) date('H.i', strtotime('-20 minutes', strtotime($dtz->format('Y-m-d H:i:s'))));
// echo "<pre>".print_r($companies, 1)."</pre>";
// echo "<pre>".print_r(array($cur_time, $time_before_20, $__cur_time, $__time_before_20), 1)."</pre>";
// exit();
// echo '__cur_time: '.$__cur_time.'<br/>';
$notification_title = $smarty_obj->translate['app_cand_push_notification_title'];
$notification_description = $smarty_obj->translate['app_cand_push_notification_body'];
$notification_image = NULL; //notification image path | https://api.androidhive.info/images/minion.jpg

$need_to_send_mail = TRUE;
// $maximum_error_attemps_to_delete_token = 5;
foreach ($companies as $single_company) {
    // $new_company = new company();

    $obj_timetable->select_db($single_company['db_name']);
    // $new_company->select_db($single_company['db_name']);

    $notify_datas = $obj_timetable->get_notify_candg_slots();
    echo '------------------'.$single_company['name'].'------------------<br/>';
    //echo "<pre>".print_r($notify_datas, 1)."</pre>";
    //exit();
    
    // $employee_list = array();
    $employee_list_ids = array();


    if(!empty($notify_datas)){

        if($need_to_send_mail){
            $cp_mail = NULL;
            if(trim($single_company['contact_person2_email']) != '' && filter_var(trim($single_company['contact_person2_email']), FILTER_VALIDATE_EMAIL))
                $cp_mail = trim($single_company['contact_person2_email']);
            else if(trim($single_company['contact_person1_email']) != '' && filter_var(trim($single_company['contact_person1_email']), FILTER_VALIDATE_EMAIL))
                $cp_mail = trim($single_company['contact_person1_email']);
        }

        foreach ($notify_datas as $ndata) {
            if(/*!in_array($ndata['employee'], $employee_list_ids) && */(float) $ndata['time_from'] <= $__cur_time && (float) $ndata['time_from'] >= $__time_before_20 && (float) $ndata['time_to'] > $__cur_time && $ndata['started_user_task_id'] == NULL){
                // $employee_list[] = $ndata;
                $employee_list_ids[] = $ndata['employee'];
                //echo "<pre>".print_r($ndata, 1)."<pre>";
                    //PUSH Notification ------------------------------------------
                $emp_tokens = $obj_notification->get_user_tokens($ndata['employee']);
                // echo "<pre>".print_r($emp_tokens, 1)."<pre>";
                if(!empty($emp_tokens)){

                    // optional payload
                    $payload = array();
                    // $payload['team'] = 'India';
                    // $payload['score'] = '5.6';
                     
                    // push type - single user / topic
                    // $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';
                    
                    $firebase_obj->setTitle($notification_title);
                    $push_body_msg = str_replace ('{{CUSTOMER_NAME}}', $ndata['customer_lname'].' '.$ndata['customer_fname'] , $notification_description);
                    $push_body_msg = str_replace ('{{TIME}}', $ndata['time_from'] , $push_body_msg);
                    $firebase_obj->setMessage($push_body_msg);
                    if ($notification_image != NULL)
                        $firebase_obj->setImage($notification_image);
                    else 
                        $firebase_obj->setImage('');
                    $firebase_obj->setIsBackground(FALSE);
                    $firebase_obj->setPayload($payload);
             
                    $json = $firebase_obj->getPush();

                    echo "response notify: ".$ndata['employee']."<br/>";

                    foreach ($emp_tokens as $etoken) {

                        if($etoken['fcm_token'] == '') continue;
                 
                        /*if ($push_type == 'topic') {
                            $json = $firebase_obj->getPush();
                            $response = $firebase_obj->sendToTopic('global', $json);
                        } else if ($push_type == 'individual') {
                            $json = $firebase_obj->getPush();
                            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
                            $response = $firebase_obj->send($regId, $json);
                        }*/
                        $regId = $etoken['fcm_token'];
                        $firebase_obj->setDbTokenRecord($etoken);
                        $response = $firebase_obj->send($regId, $json);
                        echo "<pre>".print_r($response, 1)."<pre>";
                    }
                }

                if($need_to_send_mail){
                    //MAIL To User ---------------------------------
                    if($ndata['employee_email'] != "" && filter_var($ndata['employee_email'], FILTER_VALIDATE_EMAIL)){
                        $subject =  $smarty_obj->translate['mail_subject_notification_my_cand_slot_not_started']. ' - '.$ndata['customer_lname'].' '.$ndata['customer_fname'];
                        $msg    =     $smarty_obj->translate['label_hi'];
                        $body_msg_template = nl2br($smarty_obj->translate['mail_body_notification_my_cand_slot_not_started']);
                        $body_msg = str_replace ('{{COMPANY_NAME}}', $single_company['name'] , $body_msg_template);
                        $msg .=     '<br /><br />'.$body_msg.'<br /><br />';
                        $msg .=     '<b>'.$smarty_obj->translate['customer'].'</b> : ' . $ndata['customer_lname'].' '.$ndata['customer_fname'] . '<br />';
                        $msg .=     '<b>'.$smarty_obj->translate['employee'].'</b> : ' . $ndata['employee_lname'].' '.$ndata['employee_fname'] . '<br />';
                        $msg .=     '<b>'.$smarty_obj->translate['date'].'</b> : ' . $ndata['date'] . '<br />';
                        $msg .=     '<b>'.$smarty_obj->translate['slot_time'].'</b> : ' . $ndata['time_from'].' - '.$ndata['time_to'] . '<br />';
                        $mailer = new SimpleMail($subject, $msg);
                        $mailer->addSender($single_company['email']);
                        $mailer->addRecipient($ndata['employee_email']);
                        $mailer->send();
                    }

                    //MAIL To TL/SuTL/CP ---------------------------------
                    $subject =  $smarty_obj->translate['mail_subject_notification_user_cand_slot_not_started']. ' - '.$ndata['customer_lname'].' '.$ndata['customer_fname'];
                    $msg    =     $smarty_obj->translate['label_hi'];
                    $body_msg_template = nl2br($smarty_obj->translate['mail_body_notification_user_cand_slot_not_started']);
                    $body_msg = str_replace ('{{EMPLOYEE_NAME}}', $ndata['employee_lname'].' '.$ndata['employee_fname'] , $body_msg_template);
                    $body_msg = str_replace ('{{COMPANY_NAME}}', $single_company['name'] , $body_msg);
                    $msg .=     '<br /><br />'.$body_msg.'<br /><br />';
                    $msg .=     '<b>'.$smarty_obj->translate['customer'].'</b> : ' . $ndata['customer_lname'].' '.$ndata['customer_fname'] . '<br />';
                    $msg .=     '<b>'.$smarty_obj->translate['employee'].'</b> : ' . $ndata['employee_lname'].' '.$ndata['employee_fname'] . '<br />';
                    $msg .=     '<b>'.$smarty_obj->translate['date'].'</b> : ' . $ndata['date'] . '<br />';
                    $msg .=     '<b>'.$smarty_obj->translate['slot_time'].'</b> : ' . $ndata['time_from'].' - '.$ndata['time_to'] . '<br />';
                    $mailer = new SimpleMail($subject, $msg);
                    $mailer->addSender($single_company['email']);

                    $mail_send_flag = FALSE;
                    $customer_tl_gl_list = $obj_timetable->get_customer_AL_GL($ndata['customer']);
                    if(!empty($customer_tl_gl_list)){
                        foreach ($customer_tl_gl_list as $tl_gl_user) {
                            if($tl_gl_user['email'] != "" && filter_var($tl_gl_user['email'], FILTER_VALIDATE_EMAIL)){
                                $mailer->addRecipient($tl_gl_user['email']);
                                $mail_send_flag = TRUE;
                            }
                        }
                    }
                    if($cp_mail != NULL) $mailer->addRecipient($cp_mail);
                    // $mailer->addRecipient('shamsu@arioninfotech.com');
                    if($mail_send_flag || $cp_mail != NULL) $mailer->send();
                }
            }
        }
    }
    if(!empty($employee_list_ids))
        echo "notification employees: <pre>".print_r($employee_list_ids, 1)."<pre>";
    
}
?>