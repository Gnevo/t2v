<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$mail = new mail();

$obj = array();
$mailable_employees = $_REQUEST['to'];
$subject = urldecode($_REQUEST['subject']);
$mail_body = urldecode($_REQUEST['mail_body']);
$action = $_REQUEST['action'];
$mail_id = $_REQUEST['mail_id'];
$mailes = '';
$to_mails = array();
if (strpos($mailable_employees, ', ')) {
    $to_mails = explode(',', $mailable_employees);
    if (substr($mailable_employees, -2) == ', ' || substr($mailable_employees, -2) == '),') {
        $count = count($to_mails) - 1;
    } else {
        $count = count($to_mails);
    }
} else {
    $to_mails[0] = $mailable_employees;
    $count = 1;
}
$mail->begin_transaction();
for ($j = 0; $j < $count; $j++) {
    $error = 0;
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
    

        // $to_emp = explode(',',$_POST['to']);
    $mail->root_id = 0;
    if($action == 2 || $action == 3){
       $root_id = $mail->get_mail($mail_id,1); 
        if($root_id){
            if($root_id['root_id'] == 0){
                $mail->root_id = $mail_id;
            }else{
                $mail->root_id = $root_id['root_id'];
            }
        }
        else{
            $mail->root_id = $mail_id;
        }
    }
    $mail->method = 0;
    $mail->from = $_REQUEST['user'];
    $mail->to = $mailes;
    $mail->subject = $subject;
    //$mail->mail_date = date('Y-m-d H:i:s');
    $mail->message = $mail_body;

    $mail->status = 0; //indicate unread mail
    
    if ($mail->insert_mail()) {
        $obj[0]['result'] =  'success';
    } else {
        $obj[0]['result'] =  'fail'; 
        break;
    }

//        $smarty->assign('message', $messages->show_message());
}
if($obj[0]['result'] ==  'success')
    $mail->commit_transaction ();
else
    $mail->rollback_transaction ();
//header("content-type: text/javascript");
echo json_encode($obj);
?>