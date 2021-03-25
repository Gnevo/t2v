<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
require_once('class/user.php');
require_once ('class/customer.php');
require_once('plugins/pagination.class.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "month.xml", "button.xml", "customer.xml", "support.xml"));

$pagination    = new pagination();
$support       = new support();
$user          = new user();
$customer      = new customer();
$message       = new message();
$loggedin_user = $_SESSION['user_id'];
$user_role = $user->user_role($_SESSION['user_id']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('user_role', $user_role);
$smarty->assign('loggedin_user', $loggedin_user);
$params = explode('&', $_SERVER['QUERY_STRING']);
$this_status        = ($params[0] != '') ? $params[0] : 1;
$this_priority      = $params[1];
$this_category_type = $params[2];
$this_admin_company = $params[3];
$this_hidden        = $params[4];
$this_search_key    = $params[5];
$this_user          = $params[6];
// var_dump($params);
// exit('df');

// echo "<pre>".print_r($cirrus_admins,1)."</pre>";
// exit();
if(empty($params) || (count($params) == 1 && $params[0] == '')){
    $this_priority = 'NULL';
    $this_admin_company = 'NULL';
    $this_hidden = 'NULL';
    $this_search_key = 'NULL';
    $this_user = 'NULL';
}
if (in_array($loggedin_user, $cirrus_admins)) {
    $this_company = $this_admin_company;
    $this_category_type = ($this_category_type != '') ? $this_category_type : 2;
    $this_admin_user = 'NULL';
} else if ($user_role == 1 || $user_role == 2 ) {
    $this_admin_user = ($this_admin_company ? $this_admin_company : $loggedin_user);
    $this_category_type = ($this_category_type != '') ? $this_category_type : 1;
    $this_company = 'NULL';
} else {
    $this_company = 'NULL';
    $this_admin_user = 'NULL';
    $this_user = 'NULL';
}
$selected_company = ((int) $this_company > 0)? $this_company : $_SESSION['company_id'];
$selected_search_key = ($this_search_key == 'NULL') ? '' : $this_search_key;


$smarty->assign('support_status', $support_status);
$smarty->assign('selected_status', $this_status);
$smarty->assign('support_priority', $support_priority);
$smarty->assign('selected_priority', $this_priority);
$smarty->assign('selected_hidden', $this_hidden);
$smarty->assign('selected_search_key', $selected_search_key);
$smarty->assign('selected_key', $this_search_key);
$smarty->assign('companies', $support->get_all_companies_options());
$smarty->assign('selected_company', $this_company);
$smarty->assign('support_category_types', $support_category_type);
$smarty->assign('selected_category_type', $this_category_type);
$smarty->assign('support_admin_users', $support->get_support_admin_users_options($selected_company));
$smarty->assign('selected_admin_user', $this_admin_user);
$smarty->assign('selected_admin_company', $this_admin_company);
$smarty->assign('cirrus_admins', $cirrus_admins);
$smarty->assign('selected_user', $this_user);
$smarty->assign('users', $support->get_all_user_options($selected_company));
$per_page = 15;
// echo $this_company;
$tickets_list = $support->get_tickets($this_status, $this_priority, $this_category_type, $this_search_key, $this_admin_user, $this_company, $this_user, $this_hidden);
$smarty->assign('total_records', count($tickets_list));
// echo "<pre>".print_r(expression)($tickets_list, 1)."<pre>"; exit();
$url_hidden = 0;
$url_category_type = 'NULL';
$url_status = ($this_status != '') ? $this_status : 'NULL';
$url_priority = ($this_priority != '') ? $this_priority : 'NULL';
$url_user = ($this_user != '') ? $this_user : 'NULL';
if (in_array($loggedin_user, $cirrus_admins)) {
    $url_hidden = ($this_hidden != '') ? $this_hidden : '0';
    $url_category_type = ($this_category_type != '') ? $this_category_type : '2';
    $url_admin = ($this_company != '') ? $this_company : 'NULL';
} else if ($user_role == 1) {
    $url_category_type = ($this_category_type != '') ? $this_category_type : '1';
    $url_admin = ($this_admin_user != '') ? $this_admin_user : $loggedin_user;
} else {
    $url_admin = 'NULL';
}
$url_search_key = ($this_search_key != '') ? $this_search_key : 'NULL';
$tickets_list = $pagination->generate($tickets_list, $per_page);
$smarty->assign('pagination', $pagination->links($smarty->url . 'supporttickets/list/' . $url_status . '/' . $url_priority . '/' . $url_category_type . '/' . $url_admin. '/' . $url_hidden . '/' . $url_search_key . '/' . $url_user . '/'));
$smarty->assign('tickets_list', $tickets_list);

$smarty->assign('selected_page', $pagination->page);
$smarty->assign('this_page_no', $pagination->page - 1);
$smarty->assign('per_page', $per_page);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|support_ticket_list.tpl');
?>