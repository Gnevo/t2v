<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support.php');
require_once('class/user.php');
require_once ('class/customer.php');
require_once('plugins/pagination.class.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "month.xml", "button.xml", "customer.xml", "support.xml"));

$pagination = new pagination();
$support = new support();
$user = new user();
$customer = new customer();
$message = new message();

$loggedin_user = $_SESSION['user_id'];
$user_role = $user->user_role($_SESSION['user_id']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('user_role', $user_role);
$smarty->assign('loggedin_user', $loggedin_user);
$params = explode('&', $_SERVER['QUERY_STRING']);
$this_status = $params[0];
$this_priority = $params[1];
$this_ticket_type = $params[3];
$this_admin = $params[4];
$this_hidden = $params[5];
$this_search_key = $params[6];
if (in_array($loggedin_user, $cirrus_admins)) {
    $this_company = $this_admin;
    $this_category = ($params[2] == '') ? 'External' : $params[2];
} else if ($user_role == 1) {
    $this_admin_user = $this_admin;
    $this_category = $params[2];
} else {
    $this_company = 'NULL';
    $this_admin_user = 'NULL';
    $this_category = $params[2];
}
$selected_search_key = ($this_search_key == 'NULL') ? '' : $this_search_key;
$support->get_tickets_new();
$smarty->assign('support_status', $support_status);
$smarty->assign('selected_status', $this_status);
$smarty->assign('support_priority', $support_priority);
$smarty->assign('selected_priority', $this_priority);
$smarty->assign('support_ticket_type', $support_ticket_type);
$smarty->assign('selected_ticket_type', $this_ticket_type);
$smarty->assign('selected_hidden', $this_hidden);
$smarty->assign('selected_search_key', $selected_search_key);
$smarty->assign('companies', $support->get_all_companies_options());
$smarty->assign('selected_company', $this_company);
if (in_array($loggedin_user, $cirrus_admins)) {
    $smarty->assign('support_categories', array('Internal' => 'Internal', 'External' => 'External'));
} else {
    $smarty->assign('support_categories', $support->get_support_category_options());
}
//$support->get_user_open_ticket_count();
$smarty->assign('selected_category', $this_category);
$smarty->assign('support_admin_users', $support->get_support_admin_users_options());
$smarty->assign('selected_admin_user', $this_admin_user);
$smarty->assign('cirrus_admins', $cirrus_admins);
$per_page = 10;
//$tickets_list = $support->get_tickets($this_status, $this_priority, $this_category, $this_ticket_type, $this_search_key, $this_admin_user, $this_company, $this_hidden);
$smarty->assign('total_records', count($tickets_list));
$url_status = ($this_status != '') ? $this_status : 'NULL';
$url_priority = ($this_priority != '') ? $this_priority : 'NULL';
$url_category = ($this_category != '') ? $this_category : 'NULL';
$url_ticket_type = ($this_ticket_type != '') ? $this_ticket_type : 'NULL';
if (in_array($loggedin_user, $cirrus_admins)) {
    $url_admin = ($this_company != '') ? $this_company : 'NULL';
} else if ($user_role == 1) {
    $url_admin = ($this_admin_user != '') ? $this_admin_user : 'NULL';
} else {
    $url_admin = 'NULL';
}
$url_search_key = ($this_search_key != '') ? $this_search_key : 'NULL';
$tickets_list = $pagination->generate($tickets_list, $per_page);
$smarty->assign('pagination', $pagination->links($smarty->url . 'tickets/list/' . $url_status . '/' . $url_priority . '/' . $url_category . '/' . $url_ticket_type . '/' . $url_admin . '/' . $url_search_key . '/'));
$smarty->assign('tickets_list', $tickets_list);


$smarty->assign('this_page_no', $pagination->page - 1);
$smarty->assign('per_page', $per_page);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|ticket_list.tpl');
?>