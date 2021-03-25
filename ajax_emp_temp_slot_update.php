<?php
//Rahul : ajax_auto_scheduler.php
require_once('class/customer.php');
require_once ('class/employee.php');
require_once('class/newcustomer.php');
require_once ('class/newemployee.php');
$employee = new employee();
$customer = new customer();	
$newcustomer = new newcustomer();
$newemployee = new newemployee();

$newemployee->temp_employee_slot_update($_POST['slotId'],$_POST['empid'],$_POST['first_name'],$_POST['last_name']);
exit;
