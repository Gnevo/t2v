<?php
//require_once('class/setup.php');
require_once ('class/employee.php');
//$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);

/* Json testing */
//$string = '{"foo": "bar", "cool": "attr"}';
//$result = json_decode($string);
//echo json_encode(array("A" => $_REQUEST['tags'], "B" => $_REQUEST['tagmode'], "C" => $_REQUEST['format']));
//echo json_encode($_REQUEST);
/* Json testing endz*/

$employee = new employee();
$__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
$__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
$result = $employee->reset_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag');

//if($result)
//    echo 'good';
//else
//    echo 'bad';
?>