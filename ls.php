<?php

require_once('class/setup.php');

$smarty = new smartySetup(array('messages.xml','user.xml'),FALSE);
require_once('plugins/message.class.php');
$messages = new message();

$smarty->assign('message', $messages->show_message());
if($_SESSION['inactive_user'] == "1"){
    session_destroy();
}
$files_contents = file_get_contents($smarty->url.'notification.txt');
$smarty->assign('file_content',$files_contents);

if(isset($_GET['redirect']) && $_GET['redirect'] != '')
    $smarty->assign('redirect', urlencode($_GET['redirect']));
// !isset($_SESSION['user_role'])
//setting layout and page
//if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" )
    $smarty->display('extends:layouts/login.tpl|ls.tpl');
//else
//    header("Location: " . $smarty->url . "gdschema/");
