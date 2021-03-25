<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("gdschema.xml","forms.xml"));
require_once('plugins/message.class.php');
$messages = new message();

require_once('class/user.php');
$obj_user = new user();

//echo "<pre>".print_r($smarty->translate, 1)."</pre>";

$smarty->assign('privileges_forms' , $obj_user->get_privileges($_SESSION['user_id'], 4));
//print_r($obj_user->get_privileges($_SESSION['user_id'], 4));

$smarty->assign('message', $messages->show_message());
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));

$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
//Setting layout and page
$smarty->display('customer_forms.tpl');
?>