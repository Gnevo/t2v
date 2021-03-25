<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array('messages.xml'),FALSE);
$messages = new message();

$smarty->assign('message', $messages->show_message());
$smarty->assign('url',$preference['url']);

//setting layout and page
$smarty->display('forgotpassword.tpl');
?>