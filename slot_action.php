<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/dona.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml"),FALSE);
$date = new datecalc();
$customer = new customer();
$dona = new dona();
$employee = new employee();
$customer = new customer();

$slot_id = $_REQUEST['slot_id'];

?>
