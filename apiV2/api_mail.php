<?php

require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/equipment.php');
require_once('class/mail.php');
require_once('class/attachment.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$mail = new mail();
$obj = array();
$type_view = trim($_REQUEST['type_view']);

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}
//GET Inbox/Sent/Draft Mails
if ($type_view == 1) {
    $req_category = trim($_REQUEST['category']);  // 1-Inbox, 2-Sent, 3-Draft
    $limit = (isset($_REQUEST['limit']) && trim($_REQUEST['limit']) != "" ? trim($_REQUEST['limit']) : 30);
    $offset = (isset($_REQUEST['offset']) && trim($_REQUEST['offset']) != "" ? trim($_REQUEST['offset']) : 0);

    $data = $mail->get_all_mail($req_category, NULL, NULL, $limit, $offset);
    if (!empty($data)) {
        $obj = $data;
        $obj_user = new user();
        $mail_attachment_upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/mail_attatch/';
        $attachments = new attachment();
        $attachments = $attachments->get_all_attachments();

        foreach ($obj as $key => $mails) {
            if ($obj[$key]['attachments'] == '') {
                $obj[$key]['attachments'] = [];
            }
            $obj[$key]['catg_mail'] = $req_category;
            $obj_user = new user();
            $folder = $obj_user->get_folder_name($_SESSION['company_id']);
            $currentDirectory = getcwd();
            $mailAttachFolder = './' . $folder . '/mail_attatch/';
            if (!empty($attachments) && empty($obj[$key]['attachments'])) {
                foreach ($attachments as $item => $attachment) {
                    if ($attachment->ids_mail !== '' && $attachment->ids_mail !== null) {
                        $strattach = $attachment->ids_male;
                        $ids = explode(',', $strattach);
                        if (in_array($mails['id'], $ids)) {
                            if (file_exists($mailAttachFolder . $attachment->origin_file_name)) {
                                $attachments[$item]['title'] = $attachment->origin_file_name;
                                $attachments[$item]['path'] = 'https://' . substr(strrchr($_SERVER['DOCUMENT_ROOT'], "/"), 1) . '/' . substr(strrchr(getcwd(), "/"), 1) . '/' . $folder . '/mail_attatch/' .                        $fileExtension = strtolower(end(explode('.', $attachment->origin_file_name)));
                            }
                            array_push($obj[$key]['attachments'], $attachments[$item]);
                        }
                    }
                }
            } else {
                $attachments = explode(',', $obj[$key]['attachments']);
                foreach ($attachments as $sss => $attachment) {
                    if (trim($attachment) == '')
                        unset ($attachments[$sss]);
                }

                $obj[$key]['attachments'] = [];
                foreach ($attachments as $index => $attachment) {
//                    $mailAttachments = $mail->get_attachments_for_mail_from_name($attachment);
//                    foreach ($mailAttachments as $mailAttachment) {

//                        if (substr($mailAttachment['ids_mail'], 0, -1) == $mail_id) {

                            $attachments[$index] = [];
                            $attachments[$index]['title'] = $attachment;
                            $attachments[$index]['path'] = 'https://' . substr(strrchr($_SERVER['DOCUMENT_ROOT'], "/"), 1) . '/' . substr(strrchr(getcwd(), "/"), 1) . '/' . $folder . '/mail_attatch/' . $attachment;
                            $obj[$key]['attachments'][] = $attachments[$index];

//                        }
//                    }

                }
                $array = $obj[$key]['attachments'];
                $array = unique_multidim_array($array,'title');
                $obj[$key]['attachments'] = array_values($array);
                foreach ($array as $value=>$item){
                    $array[$value] = (object)$item;
                }

            }
        }
    }

} //GET Employees to send mail
elseif ($type_view == 2) {

    $obj_equip = new equipment();
    $user = trim($_REQUEST['user']);
    // $_SESSION['user_role']  = trim($_REQUEST['role']);
    $exact_employees = $obj_equip->employee_mailable($user);
    if (!empty($exact_employees))
        $obj = $exact_employees;
} //Get Mail details by ID
elseif ($type_view == 3) {
    $user = trim($_REQUEST['user']);

    $mail_id = $_REQUEST['mail_id'];
    $category = $_REQUEST['category'];
    $mail_detail = $mail->get_mail($mail_id, $category);
    if ($category == 1 && $mail_detail)
        $mail->set_as_read_mail($mail_id);
    $obj = !empty($mail_detail) ? $mail_detail : array();
    if ($obj['attachments'] == '') {
        $obj['attachments'] = [];
    }
    $attachments = new attachment();
    $attachments = $attachments->get_all_attachments();
    $obj_user = new user();
    $folder = $obj_user->get_folder_name($_SESSION['company_id']);
    $currentDirectory = getcwd();
    $mailAttachFolder = './' . $folder . '/mail_attatch/';

    if (!empty($mail_detail)) {

        if (!empty($attachments) && empty($obj['attachments'])) {
            foreach ($attachments as $item => $attachment) {
                if ($attachment['ids_mail'] !== '' && $attachment['ids_mail'] !== null) {
                    $strattach = $attachment['ids_mail'];
                    $ids = explode(',', $strattach);
                    $fileExtension = strtolower(end(explode('.', $attachment['origin_file_name'])));
                    if (in_array($mail_id, $ids)) {
                        if (file_exists($mailAttachFolder . $attachment['id'] . '.' . $fileExtension)) {
                            $attachments[$item]['title'] = $attachment['origin_file_name'];
                            $attachments[$item]['path'] = 'https://' . substr(strrchr($_SERVER['DOCUMENT_ROOT'], "/"), 1) . '/' . substr(strrchr(getcwd(), "/"), 1) . '/' . $folder . '/mail_attatch/' . $attachment['id'] . '.' . $fileExtension;
                        } else {
                            die(var_dump($mailAttachFolder . $attachment['id'] . '.' . $fileExtension));
                        }
                        array_push($obj['attachments'], $attachments[$item]);
                    }
                }
            }
        } elseif (!empty($obj['attachments'])) {
            $attachments = explode(',', $obj['attachments'], -1);
            $attachArray = [];
            $obj['attachments'] = [];
            foreach ($attachments as $key => $attachment) {
                $name = $attachment;
                $mailAttachments = $mail->get_attachments_for_mail_from_name($attachment);
                foreach ($mailAttachments as $mailAttachment) {
                    $fileExtension = strtolower(end(explode('.', $mailAttachment['origin_file_name'])));
                    if (substr($mailAttachment['ids_mail'], 0, -1) == $mail_id) {
                        $attachments[$key] = [];
                        $attachments[$key]['title'] = $name;
                        $attachments[$key]['path'] = 'https://' . substr(strrchr($_SERVER['DOCUMENT_ROOT'], "/"), 1) . '/' . substr(strrchr(getcwd(), "/"), 1) . '/' . $folder . '/mail_attatch/' . $mailAttachment['id'] . '.' . $fileExtension;
                        array_push($obj['attachments'], (object)$attachments[$key]);
                    }
                }


            }
            foreach ($obj['attachments'] as $ii => $item) {
                if ($item->scalar) {
                    unset($obj['attachments'][$ii]);
                }
            }
            $obj['attachments'] = array_values($obj['attachments']);
        }
    }

}

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $obj;
//die(var_dump($main_obj));
echo json_encode($main_obj);
?>