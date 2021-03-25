<?php
require_once('class/setup.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
require_once('class/newcustomer.php');
$customerObj = new newcustomer();
$employee = new employee();
$CustomerList = $customerObj->customer_list(NULL);


$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);

$tot = sizeof($pram);

$customer = $pram[$tot-3];
$sdate = $pram[$tot-2];
$edate = $pram[$tot-1];

$customer_temp = $customerObj->customer_template_list($customer);

$smarty->assign('customer_temp',$customer_temp);
$smarty->assign('customerlist',$CustomerList);
$smarty->assign('customer_username',$customer);
$smarty->assign('edate',$edate);
$smarty->assign('sdate',$sdate);
$smarty->display('ajax_save_customer_schedule.tpl');
?>