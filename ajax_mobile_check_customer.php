<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
$smarty = new smartySetup(array('messages.xml'), FALSE);
$employee = new employee();
$customer = new customer();
$mobile_num = $_POST['mobile'];
$ids = $_POST['ids'];
$mob = substr($mobile_num,0,1);
if($mob == 0){
    $mobile_num = substr($mobile_num,1);
}
$mobile_user = $customer->mobile_users($mobile_num,$ids);
if($mobile_user){
    echo $smarty->translate['mobile_number_present'];
}
?>