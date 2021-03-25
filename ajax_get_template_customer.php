<?php
//Rahul : ajax_auto_scheduler.php

require_once('class/setup.php');
require_once('class/newcustomer.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml","user.xml"), FALSE);
$customer = new customer();
$newcustomer = new newcustomer();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);

$tot = sizeof($pram);
$customer = $pram[$tot-1];

$ResultArray = array();
$ResultArray = $newcustomer->customer_template_list($customer);

if(sizeof($ResultArray) > 0){
	echo '<option value="">-- '.$smarty->localise->contents['select_template'].' --</option>';	
	foreach($ResultArray as $arr){
		echo  '<option value="'.$arr["tid"].'">'.stripslashes($arr['temp_name']).'</option>';
	}
}else{
	echo '<option value="">-- '.$smarty->localise->contents['select_template'].' --</option>';	
}
exit;
?>