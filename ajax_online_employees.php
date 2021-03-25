<?php
require_once('class/setup.php');
$smarty = new smartySetup(array(), FALSE);

require_once('class/chat.php');
$chat = new chat();
//echo 'hi';
$online_employees = $chat->online_employee_list();
//echo "<pre>".print_r($online_employees, 1)."</pre>";
//print_r($online_employees);   
$smarty->assign('online_employees', $online_employees);
//$ret_flag = $chat->insert_new_chat('SDN01','a123','welcome to the world');
$smarty->display('ajax_online_employees.tpl');
?>