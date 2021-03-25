<?php

/*
 * Author : Shaju
 * description: to get all the accessible employees
 * 
 */
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/customer.php');
$obj_cust = new customer();
$cust_data = $obj_cust-> customers_list_for_employee_report(1, $_REQUEST['user']);
$i = 0;
foreach($cust_data as $data) {

	$obj[$i]->username = $data['username'];
	$obj[$i]->first_name = $data['first_name'];
	$obj[$i]->last_name = $data['last_name'];
        $obj[$i]->mobile = $data['mobile'];
        $obj[$i]->email = $data['email'];
        
	$i++;
}
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>