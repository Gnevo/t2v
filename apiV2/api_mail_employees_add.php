<?php

require_once('api_common_functions.php');
require_once('api_upload_attachment.php');
require_once('class/db.php');
require_once('class/user.php');

$request = json_encode($_REQUEST);
$files = json_encode($_FILES);
file_put_contents('./log/request.log', '');
file_put_contents('./log/request.log', $request . "\n" . $files, FILE_APPEND);

$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/mail.php');
// require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$mail = new mail();
$user = new user();
$obj = new stdClass();
$obj->session_status = $session_check;

$method = 1;
$mailable_employees = isset($_REQUEST['to']) && is_array($_REQUEST['to']) ? $_REQUEST['to'] : array();
$subject = urldecode($_REQUEST['subject']);
$mail_body = urldecode($_REQUEST['mail_body']);
$action = $_REQUEST['action'];  // 2-forward, 3-reply
$mail_id = $_REQUEST['mail_id'];

$obj->result = FALSE;

if (!empty($mailable_employees)) {
    $count = count($mailable_employees);

    $mail_root_id = 0;
    if ($action == 2 || $action == 3) {
        $root_id = $mail->get_mail($mail_id, 1);
        if ($root_id) {
            if ($root_id['root_id'] == 0)
                $mail_root_id = $mail_id;
            else
                $mail_root_id = $root_id['root_id'];
        } else
            $mail_root_id = $mail_id;
    }
    $last_insert_ids = [];
    $mail->begin_transaction();
    for ($j = 0; $j < $count; $j++) {
        $error = 0;
        $recipient = $mailable_employees[$j];

        if (trim($recipient) == '') continue;

        $mail->root_id = $mail_root_id;
        $mail->method = 0;
        $mail->from = $_SESSION['user_id']; //$_REQUEST['user'];
        $mail->to = $recipient;
        $mail->subject = $subject;
        //$mail->mail_date = date('Y-m-d H:i:s');
        $mail->message = $mail_body;
        $mail->status = 1; //indicate unread mail
        $attachedFiles = [];
        if (!empty($_FILES)) {
            foreach ($_FILES as $FILE) {
                array_push($attachedFiles, $FILE);
            }
            $attachments = '';
            foreach ($attachedFiles as $file) {
                $attachments = $attachments . $file['name'] . ',';
            }
            $mail->attachments = $attachments;
        }

        $insert_id = $mail->insert_mail();
        $last_insert_ids[] = $insert_id;

        if ($insert_id) {
            $obj->result = TRUE;
        } else {
            $obj->result = FALSE;
            break;
        }

    }
    if (!empty($_FILES)) {
        upload_attachment($method, $user->get_user_companies($_SESSION['user_id']), $_SESSION['user_id'], $last_insert_ids,0);
    }
    if (isset($obj->result) && $obj->result === TRUE)
        $mail->commit_transaction();
    else
        $mail->rollback_transaction();
}
echo json_encode($obj);
?>
