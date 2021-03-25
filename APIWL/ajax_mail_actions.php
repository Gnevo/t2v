<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
//die(var_dump('ya na ajax.php'));
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/mail.php');
require_once('class/attachment.php');
require_once('class/customer.php');
require_once('class/notification.php');
require_once('plugins/message.class.php');
require_once('plugins/firebase.php');
// require_once('plugins/firebase_push.php');
require_once('class/employee.php');

$smarty = new smartySetup(array("mail.xml", "messages.xml", "month.xml", "button.xml", "notes.xml", "customer.xml"), FALSE);
$customer = new customer();
$message = new message();
$mail = new mail();
// global $firebase_settings;

// Firebase API Key
// define('FIREBASE_API_KEY', $firebase_settings['api_key']);

$mail_id = trim($_REQUEST['mail_id']);
$return_obj = new stdClass();

$return_obj->transaction_flag = TRUE;
$mail_detail = array();

if ($_REQUEST['action'] == 'get') {
    if ($mail_id == '') {
        $message->set_message('fail', 'invalid_mail');
        $return_obj->transaction_flag = FALSE;
    }

    $mail_category = trim($_REQUEST['mail_category']);  //1-inbox, 2-send items

    if ($return_obj->transaction_flag) {
        $mail_detail = $mail->get_mail($mail_id, $mail_category);
//        die(var_dump($mail_detail));
        if (empty($mail_detail) || $mail_detail === FALSE) {
            $message->set_message('fail', 'invalid_mail');
            $return_obj->transaction_flag = FALSE;
        }
    }
    if ($return_obj->transaction_flag) {
        $mail->set_as_read_mail($mail_id);

        $attachments = explode(',', $mail_detail['attachments']);
        $return_obj->mail_details = $mail_detail;
//        $folder = $customer->get_folder_name($_SESSION['company_id']);
        //        $folder = $folder."/mail_attatch/";
        //        $return_obj->folder = $folder;
        if (!empty($attachments)) {
            foreach ($attachments as $key => $attachment) {
                if (trim($attachment) == '')
                    unset ($attachments[$key]);
            }
            $attachments = array_values($attachments);
        }

//        if (!empty($attachments)) {
//            $mail_detail['attachments'] = [];
//            foreach ($attachments as $index => $attachment) {
//                $mailAttachments = $mail->get_attachments_for_mail_from_name($attachment);
//                foreach ($mailAttachments as $mailAttachment) {
//                    $fileExtension = strtolower(end(explode('.', $mailAttachment['origin_file_name'])));
//
//                    if (substr($mailAttachment['ids_mail'], 0, -1) == $mail_id) {
//                        $attachments[$index] = [];
//                        $attachments[$index]['title'] = $mailAttachment['origin_file_name'];
//                        $attachments[$index]['path'] = 'https://' . substr(strrchr($_SERVER['DOCUMENT_ROOT'], "/"), 1) . '/' . substr(strrchr(getcwd(), "/"), 1) . '/' . $folder . 'mail_attatch/' . $mailAttachment['id'] . '.' . $fileExtension;
//                        $mail_detail['attachments'][] = (object)$attachments[$index];
//
//                    }
//                }
//
//            }
//
//            foreach ($mail_detail['attachments'] as $ii => $item) {
//                if ($item->scalar) {
//                    unset($mail_detail['attachments'][$ii]);
//                }
//            }
//
//            $attachments = array_values($mail_detail['attachments']);
//        }
        $return_obj->attachments = $attachments;
        $return_obj->met = $mail_category;
    }
} else if ($_REQUEST['action'] == 'mail_send') {
    // $return_obj->files = $_FILES;
    // $return_obj->post = $_REQUEST;

    if ($_POST['to'] && $_POST['subject'] && $_POST['mail_body']) {

        //forward mail
        if ($_POST['sub_action'] == 'forward') {
            $files_attached_old = $_POST['file_names'];
            $upload_path = $smarty->url . $customer->get_folder_name($_SESSION['company_id']) . '/mail_attatch/';
            $max_size = 50000 * 1024;
            if (strpos($_POST['to'], ', ')) {
                $to_mails = explode(',', $_POST['to']);
                if (substr($_POST['to'], -2) == ', ' || substr($_POST['to'], -2) == '),')
                    $count = count($to_mails) - 1;
                else
                    $count = count($to_mails);
            } else {
                $to_mails[0] = $_POST['to'];
                $count = 1;
            }

            for ($j = 0; $j < $count; $j++) {
                if (strpos($to_mails[$j], '(')) {
                    $mailing = explode('(', $to_mails[$j]);
                    $mailes = substr($mailing[1], 0, -1);
                } else {
                    if (substr($to_mails[$j], 0, 1) == " ") {
                        $mailes = substr($to_mails[$j], 1);
                    } else {
                        $mailes = $to_mails[$i];
                    }
                }
                if ($root_id = $mail->get_mail($_POST['id_mail'], 2)) {
                    if ($root_id['root_id'] == 0) {
                        $mail->root_id = $_POST['id_mail'];
                    } else {
                        $mail->root_id = $root_id['root_id'];
                    }
                } else
                    $mail->root_id = $_POST['id_mail'];

                $temp_files = "";
                for ($i = 0; $i <= count($_FILES['attachments']['name']); $i++) {
                    $temp_path = $_FILES['attachments']['tmp_name'][$i];
                    if ($temp_path != "") {
                        $file_name = $_FILES['attachments']['name'][$i];
                        $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                        $str = str_replace(" ", "_", $file_name);
                        if ($size <= $max_size) {
                            $extension = $customer->get_file_extension($str);
                            if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {
                                $file_path = $upload_path . $str;
                                if (file_exists($file_path)) {
                                    $num = 1;
                                    $x = 0;
                                    $str1 = explode('.', $str);
                                    $str = $str1[0] . "_" . $num . "." . $str1[1];
                                    $file_path = $upload_path . $str;
                                    while ($x == 0) {
                                        if (file_exists($file_path)) {
                                            $num++;
                                            $str1 = explode('.', $str);
                                            $str1[0] = substr($str1[0], 0, -2);
                                            $str = $str1[0] . "_" . $num . "." . $str1[1];
                                            $file_path = $upload_path . $str;
                                        } else
                                            $x++;
                                    }
                                    move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                    $temp_files = $temp_files == "" ? $str : $temp_files . "," . $str;
                                } else {
                                    move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                    $temp_files = $temp_files == "" ? $str : $temp_files . "," . $str;
                                }
                            } else {
                                $message->set_message('fail', 'file_selected_supported_extension');
                                $return_obj->transaction_flag = FALSE;
                            }
                        } else {
                            $message->set_message('fail', 'exceeds_the_limit_file_size');
                            $return_obj->transaction_flag = FALSE;
                        }
                    }
                }

                if ($return_obj->transaction_flag) {
                    if ($root_id = $mail->get_mail($_POST['id_mail'], 2)) {
                        if ($root_id['root_id'] == 0)
                            $mail->root_id = $_POST['id_mail'];
                        else
                            $mail->root_id = $root_id['root_id'];
                    } else
                        $mail->root_id = $_POST['id_mail'];
                    $mail->method = 2;
                    $mail->from = $_SESSION['user_id'];
                    $mail->to = $mailes;
                    $mail->subject = $_POST['subject'];
                    $mail->message = $_POST['mail_body'];
                    if ($files_attached_old != "") {
                        if ($temp_files == "") {
                            $mail->attachments = $files_attached_old;
                        } else {
                            $mail->attachments = $temp_files . "," . $files_attached_old;
                        }
                    } else {
                        $mail->attachments = $temp_files; //$_POST['attachement'];
                    }
                    $mail->status = 0; //indicate unread mail
                    if ($mail->insert_mail()) {
                        $message->set_message('success', 'mail_send_sucesfully');

                        //push notification---------------------------------
                        // send_cirrus_mail_push_notification($smarty, $mail->to, $mail->from);
                    } else {
                        $message->set_message('fail', 'mail_send_fail');
                        $return_obj->transaction_flag = FALSE;
                    }
                }
            }
        } //replay mail
        else if ($_POST['sub_action'] == 'reply') {
            $max_size = 2000 * 1024;
            $compony_id = $_SESSION['company_id'];
            $upload_path = $customer->get_folder_name($compony_id);
            $upload_path = $upload_path . "/mail_attatch/";
            $temp_files = "";
            for ($i = 0; $i <= count($_FILES['attachments']['name']); $i++) {
                $temp_path = $_FILES['attachments']['tmp_name'][$i];
                if ($temp_path != "") {
                    $file_name = $_FILES['attachments']['name'][$i];
                    $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                    $str = str_replace(" ", "_", $file_name);
                    if ($size <= $max_size) {
                        $extension = $customer->get_file_extension($str);
                        if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {
                            $file_path = $upload_path . $str;
                            if (file_exists($file_path)) {
                                $num = 1;
                                $x = 0;
                                $str1 = explode('.', $str);
                                $str = $str1[0] . "_" . $num . "." . $str1[1];
                                $file_path = $upload_path . $str;
                                while ($x == 0) {
                                    if (file_exists($file_path)) {
                                        $num++;
                                        $str1 = explode('.', $str);
                                        $str1[0] = substr($str1[0], 0, -2);
                                        $str = $str1[0] . "_" . $num . "." . $str1[1];
                                        $file_path = $upload_path . $str;
                                    } else
                                        $x++;
                                }
                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                $temp_files = $temp_files == "" ? $str : $temp_files . "," . $str;
                            } else {
                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                $temp_files = $temp_files == "" ? $str : $temp_files . "," . $str;
                            }
                        } else {
                            $message->set_message('fail', 'file_selected_supported_extension');
                            $return_obj->transaction_flag = FALSE;
                        }
                    } else {
                        $message->set_message('fail', 'exceeds_the_limit_file_size');
                        $return_obj->transaction_flag = FALSE;
                    }
                }
            }

            if ($return_obj->transaction_flag) {
                if ($root_id = $mail->get_mail($_POST['id_mail'], 1)) {
                    if ($root_id['root_id'] == 0) {
                        $mail->root_id = $_POST['id_mail'];
                    } else {
                        $mail->root_id = $root_id['root_id'];
                    }
                } else
                    $mail->root_id = $_POST['id_mail'];
                $mail->method = 1;
                $mail->from = $_SESSION['user_id'];
                $mail->to = $_POST['to'];
                $mail->subject = $_POST['subject'];
                $mail->message = $_POST['mail_body'];
                $mail->attachments = $temp_files;
                $mail->status = 0; //indicate unread mail
                if ($mail->insert_mail()) {
                    $message->set_message('success', 'mail_send_sucesfully');

                    //push notification---------------------------------
                    // send_cirrus_mail_push_notification($smarty, $mail->to, $mail->from);
                } else {
                    $message->set_message('fail', 'mail_send_fail');
                    $return_obj->transaction_flag = FALSE;
                }
            }
        } //new mail
        else if ($_POST['sub_action'] == 'new') {
            $max_size = 2000 * 1024;
            $compony_id = $_SESSION['company_id'];
            $upload_path = $customer->get_folder_name($compony_id);
            $upload_path = $upload_path . "/mail_attatch/";

            $temp_files = "";
            for ($i = 0; $i <= count($_FILES['attachments']['name']); $i++) {
                $temp_path = $_FILES['attachments']['tmp_name'][$i];
                if ($temp_path != "") {
                    $file_name = $_FILES['attachments']['name'][$i];
                    $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                    $str = str_replace(" ", "_", $file_name);

                    if ($size <= $max_size) {
                        $extension = $customer->get_file_extension($str);
                        if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                            //$upload_path = "document_decision/";
                            $file_path = $upload_path . $str;
                            if (file_exists($file_path)) {
                                $num = 1;
                                $x = 0;
                                $str1 = explode('.', $str);
                                $str = $str1[0] . "_" . $num . "." . $str1[1];
                                $file_path = $upload_path . $str;
                                while ($x == 0) {
                                    if (file_exists($file_path)) {
                                        $num++;
                                        $str1 = explode('.', $str);
                                        $str1[0] = substr($str1[0], 0, -2);
                                        $str = $str1[0] . "_" . $num . "." . $str1[1];
                                        $file_path = $upload_path . $str;
                                    } else
                                        $x++;
                                }
                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                $temp_files = $temp_files == "" ? $str : $temp_files . "," . $str;
                            } else {
                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                $temp_files = $temp_files == "" ? $str : $temp_files . "," . $str;
                            }
                        } else {
                            $message->set_message('fail', 'file_selected_supported_extension');
                            $return_obj->transaction_flag = FALSE;
                        }
                    } else {
                        $message->set_message('fail', 'exceeds_the_limit_file_size');
                        $return_obj->transaction_flag = FALSE;
                    }
                }
            }

            if ($return_obj->transaction_flag) {
                if (strpos($_POST['to'], ',')) {
                    $to_mails = explode(',', $_POST['to']);
                    if (substr($_POST['to'], -2) == ', ' || substr($_POST['to'], -2) == '),')
                        $count = count($to_mails) - 1;
                    else
                        $count = count($to_mails);
                } else {
                    $to_mails[0] = $_POST['to'];
                    $count = 1;
                }
                for ($i = 0; $i < $count; $i++) {
                    if (strpos($to_mails[$i], '(')) {
                        $mailing = explode('(', $to_mails[$i]);
                        $mailes = substr($mailing[1], 0, -1);
                    } else {
                        if (substr($to_mails[$i], 0, 1) == " ") {
                            $mailes = substr($to_mails[$i], 1);
                        } else {
                            $mailes = $to_mails[$i];
                        }
                    }
                    $mail->root_id = 0;
                    $mail->method = 0;
                    $mail->from = $_SESSION['user_id'];
                    $mail->to = $mailes;
                    $mail->subject = $_POST['subject'];
                    $mail->message = $_POST['mail_body'];
                    $mail->attachments = $temp_files; //$_POST['attachement'];
                    $mail->status = 0; //indicate unread mail
                    if ($mail->insert_mail()) {
                        $message->set_message('success', 'mail_send_sucesfully');

                        //push notification---------------------------------
                        // send_cirrus_mail_push_notification($smarty, $mail->to, $mail->from);
                    } else {
                        // $return_obj->error_details = $mail->query_error_details;
                        $message->set_message('fail', 'mail_send_fail');
                        $return_obj->transaction_flag = FALSE;
                    }
                }
            }
        }
    } else
        $message->set_message('fail', 'incomplete_form_values');

    $return_obj->message = $message->show_message();
    echo json_encode($return_obj);
    exit();
}

$return_obj->message = $message->show_message();
echo json_encode($return_obj);
exit();

/*function send_cirrus_mail_push_notification($smarty_obj, $to_user, $from_user){
    $obj_notification = new notification();
    $obj_employee = new employee();
    $firebase_obj = new Firebase();
    // $maximum_error_attemps_to_delete_token = 5;

    $notification_title = $smarty_obj->translate['app_cirrus_mail_push_notification_title'];
    $notification_description = $smarty_obj->translate['app_cirrus_mail_push_notification_body'];
    $notification_image = NULL; //notification image path | https://api.androidhive.info/images/minion.jpg


    //push notification---------------------------------
    $emp_tokens = $obj_notification->get_user_tokens($to_user);
    if(!empty($emp_tokens)){
        $payload = array();
        $sender_details = $obj_employee->get_employee_detail($from_user);
        $company_details = $obj_employee->company_data();

        $firebase_obj->setTitle($notification_title);
        $push_body_msg = str_replace ('{{SENDER_NAME}}', $sender_details['last_name'].' '.$sender_details['first_name'] , $notification_description);
        $push_body_msg = str_replace ('{{COMPANY_NAME}}', $company_details['name'] , $push_body_msg);
        $firebase_obj->setMessage($push_body_msg);
        if ($notification_image != NULL)
            $firebase_obj->setImage($notification_image);
        else 
            $firebase_obj->setImage('');
        $firebase_obj->setIsBackground(FALSE);
        $firebase_obj->setPayload($payload);
 
        $json = $firebase_obj->getPush();
        // echo "response notify: ".$ndata['employee']."<br/>";
        foreach ($emp_tokens as $etoken) {

            if($etoken['fcm_token'] == '') continue;

            $regId = $etoken['fcm_token'];
            $firebase_obj->setDbTokenRecord($etoken);
            $response = $firebase_obj->send($regId, $json);
            // echo "<pre>".print_r($response, 1)."<pre>";
        }
    }
    return TRUE;
}*/

?>