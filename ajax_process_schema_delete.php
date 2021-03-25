<?php

/**
 * Author: Shamsudheen <shamsu@arioninfotech.com>
 * for: multiple delete gdschema slots as ajax (from b/w 2 weeks)
*/

require_once('class/setup.php');
//require_once ('class/dona.php');
//require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
$msg = new message();
//$obj_cust = new customer();
$obj_emp = new employee();
//$dona = new dona();
//$smarty = new smartySetup(array('messages.xml'), FALSE);
//$slots = array();

$sel_date = trim($_REQUEST['date']);
$sel_slots = trim($_REQUEST['sel_slots']);
$sel_slots_array = explode('-', $sel_slots);
foreach($sel_slots_array as $key => $val){
    if(trim($val) == '') unset ($sel_slots_array[$key]);
}

if($sel_slots == '-' || empty($sel_slots_array))
    $selected_slot_details = $obj_emp->get_multiple_slot_details(NULL, $sel_date, $_REQUEST['customer'], $_REQUEST['employee']);
else
    $selected_slot_details = $obj_emp->get_multiple_slot_details($sel_slots_array, $sel_date, $_REQUEST['customer'], $_REQUEST['employee']);

//echo '<script> var data = '.json_encode($selected_slot_details).'; console.log(data) </script>';

$from_week = trim($_REQUEST['from_week']);
$to_week = trim($_REQUEST['to_week']);
$from_option = trim($_REQUEST['from_option']);
//echo "<pre>".print_r($selected_slot_details, 1)."</pre>";

$days = explode('-', $_REQUEST['days']);
array_pop($days);
if(!empty($selected_slot_details)){
    $result = $obj_emp->delete_multiple_slots_as_week_basis($selected_slot_details, $from_week, $to_week, $from_option, $days);
    echo '<script> $("#schema_delete_process_status").val(1); </script>';
    echo $msg->show_message();
}else{
    $msg->set_message('fail', 'no_slot_available');
    echo $msg->show_message();
}

?>