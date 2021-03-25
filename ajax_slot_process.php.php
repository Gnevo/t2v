<?php

/*
 * Pasting slots(single slot and whole slots in a day)
 */
require_once('class/setup.php');
require_once ('class/dona.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
$msg = new message();
$obj_cust = new customer();
$obj_emp = new employee();
$dona = new dona();
$smarty = new smartySetup(array(), FALSE);
//if($_REQUEST['action'] == 'paste'){
//    $slot_ids = $_SESSION['coopy_slot'];
//    foreach ($slot_ids as $slot_id){
//        
//    }
//}
?>