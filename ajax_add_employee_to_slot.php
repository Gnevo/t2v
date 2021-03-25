<?php
require_once('class/setup.php');
require_once('class/employee.php');
$employee = new employee();

$ids = str_replace("-", ",", $_REQUEST['ids']);
$select_emp = $_REQUEST['employee_username'];
$alloc_emp = $_REQUEST['emp_alloc'];
$employee->employee_add_to_slot_multiple($ids, $select_emp, $alloc_emp);
echo 'success';
?>
