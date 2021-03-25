<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
$smarty = new smartySetup(array('messages.xml'), FALSE);
$employee = new employee();
$customer = new customer();
$mobile_num = $_POST['mobile'];
$ids = $_POST['ids'];
$method = $_POST['method'];
$mob = substr($mobile_num,0,3);
if($mob == '+46'){
    $mobile_num = substr($mobile_num,3);
}
if($method == 1){
    $mobile_user = $employee->mobile_users($mobile_num,$ids);
    if($mobile_user){
        if($mobile_num != ""){
            echo $smarty->translate['mobile_number_present'];
        }
    }
}
if($method == 2){
    $mobile_user = $customer->mobile_users($mobile_num,$ids);
    if($mobile_user){
        if($mobile_num != ""){
            echo $smarty->translate['mobile_number_present'];
        }
    }
}
?>