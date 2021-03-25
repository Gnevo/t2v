<?php
require_once('class/setup.php');
require_once('class/customer.php');
//require_once('class/employee.php');
//require_once('class/team.php');
//require_once('class/dona.php');
//require_once('plugins/message.class.php');
//$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
$customer = new customer();
//$employee = new employee();
//$dona = new dona();
//$msg = new message();

if($_POST['action'] == 'check_overlap'){
    $ids = $_POST['ids'];
    $employee_username = $_POST['employee_username'];
    echo $return_value = $customer->check_overlap_slots($ids,$employee_username);
}
?>