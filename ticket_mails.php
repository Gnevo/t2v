<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/support.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "button.xml", "support.xml", "customer.xml", "reports.xml"));

$support = new support();
$user = new user();
$message = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));

$msg = '';
$params = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

if (isset($_POST['mail_update']) && $_POST['mail_update']) {
    
    $update_status = 0;
    for ($i = 1; $i <= 5; $i++) {
        
        if ($_POST['mail_subject_' . $i] && $_POST['mail_body_' . $i] && $_POST['mail_footer_' . $i]) {
            
            $mail_id = $i;
            $sender = trim($_POST['mail_sender_' . $i]);
            $sender_name = trim($_POST['mail_sender_name_' . $i]);
            $subject = trim($_POST['mail_subject_' . $i]);
            $body = trim($_POST['mail_body_' . $i]);
            $footer = trim($_POST['mail_footer_' . $i]);

            if ($support->update_email_model($mail_id, $sender, $sender_name, $subject, $body, $footer)) {
                $update_status++;
            }
        }
    }
    if($update_status == 5) {
        $message->set_message('success', 'mail_updated_success');
    } else {
        $message->set_message('fail', 'mail_updated_fail');
    }
}

$smarty->assign('msg', $msg);
$smarty->assign('permission', $permission);

$email_model_1 = $support->get_email_model(1);
$smarty->assign('email_model_1', $email_model_1);
$email_model_2 = $support->get_email_model(2);
$smarty->assign('email_model_2', $email_model_2);
$email_model_3 = $support->get_email_model(3);
$smarty->assign('email_model_3', $email_model_3);
$email_model_4 = $support->get_email_model(4);
$smarty->assign('email_model_4', $email_model_4);
$email_model_5 = $support->get_email_model(5);
$smarty->assign('email_model_5', $email_model_5);

$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|ticket_mails.tpl');
?>