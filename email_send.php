<?php
require_once('class/setup.php');
require_once('plugins/message.class.php');
require_once('class/user.php');
require_once('class/mail.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/equipment.php');
$messages = new message();
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","mail.xml"));
$mail = new mail();
$email = new email();
$user = new user();
$equip = new equipment();
$employee = new employee();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$data = $equip->employee_mailable($_SESSION['user_id']);
$smarty->assign('employees',$data);

//all mail recipients for mail sending
$exact_employees_group = $equip->employee_mailabe_group($_SESSION['user_id']);
$smarty->assign('employees_group',$exact_employees_group);
require_once('configs/config.inc.php');
if($_POST['to'] && $_POST['subject'] && $_POST['mail_body']){
    
    //$mail->method = 2;
    $mail->from = $_SESSION['user_id'];
    
    $mail->to = $_POST['to'];
    $mail->subject = $_POST['subject'];
    //$mail->mail_date = date('Y-m-d H:i:s');
    $mail->message = nl2br($_POST['mail_body']);

    // var_dump($_POST['mail_body']);
    // exit('fdf');    
    //$mail->status = 0; //indicate unread mail
    
    if($mail->insert_email()){
        if(strpos($_POST['to'],',')){
            $to_mails = explode(',', $_POST['to']);
            if(substr($_POST['to'],-2) == ', ' || substr($_POST['to'],-2) == '>,'){
                $count = count($to_mails) - 1;
            }
            else{
                $count = count($to_mails);
            }
        }else{
            $to_mails[0] = $_POST['to'];
            $count = 1;
        }
        for($i=0;$i<$count;$i++){
            if(strpos($to_mails[$i],'<')){
                $mailing = explode('<',$to_mails[$i]);
                $mailes = substr($mailing[1], 0, -1);
            }
            else{
               if(substr($to_mails[$i],0,1) == " "){
                    $mailes = substr($to_mails[$i],1);
                }else{
                    $mailes = $to_mails[$i];
                }
            }
            $email->addRecipient($mailes);
            $sender = $equip->get_employee_email($_SESSION['user_id']);
            $email->addSender($sender);
            $email->message = nl2br($_POST['mail_body']);
            $email->subject = $_POST['subject'];
            if($email->send()){
                $message = 'mail_send_sucesfully';
                $type = "success";
                $messages->set_message($type, $message);
                
            }
            else{
                $message = 'mail_send_fail';
                $type = "fail";
                $messages->set_message($type, $message);
            }
        }
        /*$message = 'mail_send_sucesfully';
        $type = "success";
        $messages->set_message($type, $message);*/
        header('Location: '.$smarty->url.'email/');
        exit;
    }
    else{
        $message = 'mail_send_fail';
        $type = "fail";
        $messages->set_message($type, $message);
    }
    
}

$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|email_send.tpl');
?>