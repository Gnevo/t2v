<?php
require_once('class/setup.php');
$smarty = new smartySetup(array(), FALSE);
require_once('class/customer.php');
$customer = new customer();
$first_name = strip_tags($_REQUEST['first_name']);
$last_name = strip_tags($_REQUEST['last_name']);
$first_remove = array();
$last_remove = array();
for($i=0;$i<strlen($first_name);$i++){
    if((ord(substr($first_name,$i,1)) >= 97 && ord(substr($first_name,$i,1)) <= 122) || (ord(substr($first_name,$i,1)) >= 65 && ord(substr($first_name,$i,1)) <= 90)){
        continue;
    }else{
        $first_remove[] = substr($first_name,$i,1);
    }
}
for($i=0;$i<count($first_remove);$i++){
    $first_name = str_replace($first_remove[$i],"",$first_name);
}
for($i=0;$i<strlen($last_name);$i++){
    if((ord(substr($last_name,$i,1)) >= 97 && ord(substr($last_name,$i,1)) <= 122) || (ord(substr($last_name,$i,1)) >= 65 && ord(substr($last_name,$i,1)) <= 90)){
        continue;
    }else{
        $last_remove[] = substr($last_name,$i,1);
    }
}
for($i=0;$i<count($last_remove);$i++){
    $last_name = str_replace($last_remove[$i],"",$last_name);
}
if((ord(substr($first_name,0,1)) >= 97 && ord(substr($first_name,0,1)) <= 122) || (ord(substr($first_name,0,1)) >= 65 && ord(substr($first_name,0,1)) <= 90)){
    $first_name_1 = substr($first_name,0,1);
}else{
    $first_name_1 = "a";
}
if((ord(substr($first_name,1,1)) >= 97 && ord(substr($first_name,1,1)) <= 122) || (ord(substr($first_name,1,1)) >= 65 && ord(substr($first_name,1,1)) <= 90)){
    $first_name_2 = substr($first_name,1,1);
}else{
    $first_name_2 = "a";
}
$customer->first_name = $first_name_1.$first_name_2;
if((ord(substr($last_name,0,1)) >= 97 && ord(substr($last_name,0,1)) <= 122) || (ord(substr($last_name,0,1)) >= 65 && ord(substr($last_name,0,1)) <= 90)){
    $last_name_1 = substr($last_name,0,1);
}else{
    $last_name_1 = "a";
}
if((ord(substr($last_name,1,1)) >= 97 && ord(substr($last_name,1,1)) <= 122) || (ord(substr($last_name,1,1)) >= 65 && ord(substr($last_name,1,1)) <= 90)){
    $last_name_2 = substr($last_name,1,1);
}else{
    $last_name_2 = "0";
}
$customer->last_name = $last_name_1.$last_name_2;
$username = $customer->get_username(strtolower(substr($customer->first_name,0,2)).strtolower(substr($customer->last_name,0,2)));
$smarty->assign('username', $username);
$smarty->display('ajax_generate_username.tpl');
?>