<?php
require_once('class/setup.php');
require_once('class/dona.php');
//require_once('class/equipment.php');

$dona = new dona();
//$obj_equipment = new equipment();

$account_customer = trim($_POST['customer']);
$account_date_from = trim($_POST['acc_from']);
$account_date_to = trim($_POST['acc_to']);
$fkkn = trim($_POST['fkkn']);

$total_customer_no_of_hours = 0.00;

//total no.of hours for the customer
if($account_customer != '' && $account_date_from != '' && $account_date_to != ''){
//    $total_customer_no_of_hours = $dona->get_customer_slots_btwn_dates($account_customer,$account_date_from, $account_date_to, $fkkn, 'HOURS_SUM');
    $total_customer_no_of_hours = $dona->summery_slot_total_btwn_date_range($account_customer,$account_date_from, $account_date_to, $fkkn);
}

echo round($total_customer_no_of_hours);
?>