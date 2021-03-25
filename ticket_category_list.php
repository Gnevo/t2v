<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "button.xml", "support.xml"));

$support = new support();
$message = new message();
$user = new user();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('loggedin_user', $_SESSION['user_id']);

$params = explode('&', $_SERVER['QUERY_STRING']);
if($params[0] == 'delete' && $_POST['cat_id']) {
    $cat_id = $_POST['cat_id'];
    if($support->delete_ticket_category($cat_id)) {
        $message->set_message('success', 'ticket_category_delete_success');
    } else {
        $message->set_message('fail', 'ticket_category_delete_fail');
    }
}

$categories_list = $support->get_ticket_categories();
$smarty->assign('categories_list', $categories_list);

$smarty->assign('message', $message->show_message());

$smarty->display('extends:layouts/dashboard.tpl|ticket_category_list.tpl');
?>