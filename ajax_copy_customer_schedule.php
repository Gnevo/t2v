<?php
require_once('class/setup.php');
require_once('class/newcustomer.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$customer = new newcustomer();
//$employee = new employee();
$CustomerList = $customer->customer_list(NULL);

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);

$tot = sizeof($pram);

$customer_username = $pram[$tot-3];
$sdate = $pram[$tot-2];
$edate = $pram[$tot-1];

$smarty->assign('customerlist',$CustomerList);
$smarty->assign('customer_username',$customer_username);
$smarty->assign('edate',$edate);
$smarty->assign('sdate',$sdate);
$smarty->display('ajax_copy_customer_schedule.tpl');
?>