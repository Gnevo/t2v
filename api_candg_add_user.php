<?php

/*
 * Author : Shaju
 * Purpose : To add an employee to the timeslot
 */
session_start();
require_once('class/setup.php');
require_once ('class/employee.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$obj_employee = new employee();
$obj = array();
$user_id = $_REQUEST['userid'];
$i = 0;
if($obj_employee->employee_add_to_slot($_REQUEST['id'], $user_id, $user_id)){
    $obj[$i]->transaction = 'success';
}else{
    $obj[$i]->transaction = 'fail';
}
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>
