<?php

require_once('class/setup.php');
require_once ('plugins/message.class.php');
$msg = new message();
$smarty = new smartySetup(array("messages.xml" , "gdschema.xml"));
$smarty->assign('msg_7', $msg->show_message_exact());
$smarty->display('extends:layouts/dashboard.tpl|comengo_stop.tpl');
?>