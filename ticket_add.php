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

$smarty->assign('loggedin_user', $_SESSION['user_id']);
$smarty->assign('support_priority', $support_priority);
$smarty->assign('support_status', $support_status);
$smarty->assign('support_ticket_type', $support_ticket_type);
$smarty->assign('support_categories', $support->get_support_category_options());
$smarty->assign('cirrus_admins', $cirrus_admins);
$smarty->assign('support_admin_users', $support->get_support_admin_users_options());
$smarty->assign('users_json', $support->get_all_user_json($_SESSION['company_id']));

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$msg = '';
$params = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

if ($_POST['title'] && $_POST['description'] && $_POST['sprt_category'] && $_POST['sprt_priority']) {

    $support->title = trim($_POST['title']);
    $support->description = trim($_POST['description']);
    $support->login_user = $_SESSION['user_id'];
    $support->admin_user = ($_POST['sprt_admin'] != '') ? $_POST['sprt_admin'] : NULL;
    $support->ticket_type = $_POST['sprt_ticket_type'];
    $support->category_id = $_POST['sprt_category'];
    $support->priority = $_POST['sprt_priority'];
    $support->status = 1; //Open
    $support->affected_user = $_POST['selected_affected_user'];
    $support->affected_user_phone = $_POST['affected_user_phone'];
    $support->attachment = $_FILES['attachment'] ? $_FILES['attachment'] : NULL;

    if ($support->insert_ticket())
        $message->set_message('success', 'ticket_adding_success');
    else
        $message->set_message('fail', 'ticket_adding_fail');
    $msg = 1;
}

$smarty->assign('msg', $msg);

if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {  //for admin edit
    $ticket_id = (int) $params[0];
    if ($ticket_id > 0) {
        $ticket_detail = $support->get_ticket_details($ticket_id);
        if (empty($ticket_detail)) {
            header("Location: " . $smarty->url . "tickets/add/");
            exit;
        } else {
            $smarty->assign("ticket_detail", $ticket_detail);
        }
    } else {
        header("Location: " . $smarty->url . "tickets/add/");
        exit;
    }
}

$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|ticket_add.tpl');
?>