<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "button.xml", "support.xml", "customer.xml", "reports.xml"));

$support = new support();
$message = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));

$smarty->assign('ticket_category_types', $support_category_type);
$category_count = $support->get_ticket_category_count();
$smarty->assign('loggedin_user', $_SESSION['user_id']);
$smarty->assign('cirrus_admins', $cirrus_admins);
$smarty->assign('companies', $support->get_all_companies_options());
$msg = '';
$params = explode('&', $_SERVER['QUERY_STRING']);
if (empty($params[0]) || $params[0] == '') {
    $category_count += 1;
}
$smarty->assign('ticket_category_count', $category_count);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

if ($_POST['cat_name'] && $_POST['cat_type'] && $_POST['cat_id']) {

    $cat_id = $_POST['cat_id'];
    $cat_order = trim($_POST['cat_order']);
    $cat_type = trim($_POST['cat_type']);
    $cat_company = trim($_POST['cat_company']);
    $cat_name = trim($_POST['cat_name']);

    if ($support->update_ticket_category($cat_id, $cat_order, $cat_type, $cat_company, $cat_name))
        $message->set_message('success', 'ticket_category_update_success');
    else
        $message->set_message('fail', 'ticket_category_update_fail');
    $msg = 1;
} else if ($_POST['cat_name'] && $_POST['cat_type']) {
    $cat_order = trim($_POST['cat_order']);
    $cat_type = trim($_POST['cat_type']);
    $cat_name = trim($_POST['cat_name']);
    $cat_company = trim($_POST['cat_company']);

    if ($support->insert_ticket_category($cat_order, $cat_type, $cat_company, $cat_name)) {
        $message->set_message('success', 'ticket_category_added_success');
    } else {
        $message->set_message('fail', 'ticket_category_added_fail');
    }
    $msg = 1;
}

$smarty->assign('msg', $msg);
$company_id = $_SESSION['company_id'];
if ((int) $params[0] > 0) {
    $category_id = $params[0];
    $category_detail = $support->get_ticket_category_details($category_id);
    $smarty->assign("category_detail", $category_detail);
    $company_id = $category_detail['company_id'];
}
$smarty->assign('company_id', $company_id);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|support_ticket_category_add.tpl');
