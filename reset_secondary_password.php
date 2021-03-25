<?php
require_once('class/setup.php');
require_once('configs/config.inc.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array('messages.xml'),FALSE);
$messages = new message();

$smarty->assign('message', $messages->show_message());
$smarty->assign('url',$preference['url']); 
$key1 = isset($_GET['key1'])?$_GET['key1']:"";
$key2 = isset($_GET['key2'])?$_GET['key2']:"";
$key3 = isset($_GET['key3'])?$_GET['key3']:"";
$smarty->assign('key1',$key1);
$smarty->assign('key2',$key2);
$smarty->assign('key3',$key3);

//setting layout and page
$smarty->display('reset_secondary_password.tpl');
?>