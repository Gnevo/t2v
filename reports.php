<?php
require_once('class/setup.php');
//require_once('class/customer.php');
$smarty = new smartySetup(array("reports.xml"));
require_once('plugins/message.class.php');
$messages = new message();
require_once('class/user.php');
$obj_user = new user();

$smarty->assign('privileges_reports' ,$x =  $obj_user->get_privileges($_SESSION['user_id'], 5));
//echo "<pre>". print_r($x, 1)."</pre>";exit();
//print_r($obj_user->get_privileges($_SESSION['user_id'], 5));
$smarty->assign('message', $messages->show_message());
//setting the menu
$smarty->assign('current_year',date('Y'));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$role = $_SESSION['user_role'];
$smarty->assign('role',$role);
$smarty->assign('last_year',date('Y', strtotime("last day of last month")));
$smarty->assign('last_month',date('m', strtotime("last day of last month")));
 

//Setting layout and page
$smarty->display('extends:layouts/dashboard.tpl|reports.tpl');
?>