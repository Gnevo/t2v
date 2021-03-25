<?php
require_once('api_common_functions.php');
$session_check = check_user_session();
/*
 * Author : Shaju
 * Purpose : To add an employee to the timeslot
 */
require_once('class/setup.php');
require_once ('class/employee.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$obj_employee = new employee();
$obj = new stdClass();

$obj->session_status = $session_check;
$user_id = $_REQUEST['userid'];

if($obj_employee->employee_add_to_slot($_REQUEST['id'], $user_id, $user_id))
    $obj->transaction = 'success';
else
    $obj->transaction = 'fail';

echo json_encode($obj);
?>