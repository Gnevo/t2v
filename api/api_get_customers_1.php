<?php
/*
 * Author : Shaju
 * description: to get all the accessible employees
 * 
 */
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$obj_cust = new customer();

$cust_data = $obj_cust->customers_list_for_employee_report(1, $_REQUEST['user']);
$i = 0;
$obj = array();
foreach($cust_data as $data) {

	$obj[$i]->username = $data['username'];
	$obj[$i]->first_name = $data['first_name'];
	$obj[$i]->last_name = $data['last_name'];
        $obj[$i]->mobile = $data['mobile'];
        $obj[$i]->email = $data['email'];
        
	$i++;
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>