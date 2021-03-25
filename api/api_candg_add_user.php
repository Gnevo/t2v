<?php

/*
 * Author : Shaju
 * Purpose : To add an employee to the timeslot
 */
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once ('class/employee.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$obj_employee = new employee();
$obj = new stdClass();
$user_id = $_REQUEST['userid'];
//$i = 0;
if($obj_employee->employee_add_to_slot($_REQUEST['id'], $user_id, $user_id))
    $obj->transaction = 'success';
else
    $obj->transaction = 'fail';
//header("content-type: text/javascript");
echo json_encode($obj);
?>