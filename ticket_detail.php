<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml", "button.xml", "support.xml", "customer.xml"));
$support = new support();
$user = new user();
$message = new message();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('loggedin_user', $_SESSION['user_id']);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

$params = explode('&', $_SERVER['QUERY_STRING']);
$ticket_id = trim($params[0]);
$company_id = trim($params[1]);

if ($_POST['answer'] != '') {
    $support->id = $ticket_id;
    $support->answer = trim($_POST['answer']);
    $support->login_user = $_SESSION['user_id'];
    $support->status = $_POST['status'];
    $support->category_id = $_POST['sprt_category'];
    $support->priority = $_POST['priority'];
    $support->ticket_type = $_POST['ticket_type'];
    $support->attachment = $_FILES['attachment'] ? $_FILES['attachment'] : NULL;
    if (is_array($_POST['admin'])) {
        $support->admin_user = implode(',', $_POST['admin']);
    } else {
        $support->admin_user = $_POST['admin'];
    }
    $support->hidden = ($_POST['is_hidden'] != '' ? $_POST['is_hidden'] : 0);
    if ((int) $ticket_id > 0) {
        $insert_status = 0;
        if ((int) $company_id > 0) {
            $insert_status = $support->insert_ticket_answer($company_id);
            $url_appent = $ticket_id . "/" . $company_id . "/";
        } else {
            $insert_status = $support->insert_ticket_answer();
            $url_appent = $ticket_id . "/";
        }
        if ($insert_status) {
            $message->set_message('success', 'ticket_answer_success');
            header("Location: " . $smarty->url . "tickets/detail/" . $url_appent);
            exit;
        } else {
            $message->set_message('fail', 'ticket_answer_fail');
            header("Location: " . $smarty->url . "tickets/detail/" . $url_appent);
            exit;
        }
    }
}
$array_keys = array_keys($support_status);
$last_key = end($array_keys);
$closed_status = ($last_key - 1);
$smarty->assign('company_id', $company_id);
$smarty->assign('support_closed_status', $closed_status);
$smarty->assign('support_status', $support_status);
$smarty->assign('support_priority', $support_priority);
$smarty->assign('support_ticket_type', $support_ticket_type);
$smarty->assign('cirrus_admins', $cirrus_admins);
$smarty->assign('support_admin_users', $support->get_support_admin_users_options());

$smarty->assign('message', $message->show_message());
$ticket_data = $support->get_ticket_details($ticket_id, $company_id);
$smarty->assign("ticket", $ticket_data);


$smarty->display('extends:layouts/dashboard.tpl|ticket_detail.tpl');
