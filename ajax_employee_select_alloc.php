<?php   
require_once('class/setup.php');
require_once ('class/dona.php');
require_once ('class/employee.php');
$dona = new dona();
$sel_date       = trim($_REQUEST['date']);
$sel_days       = explode('-', trim($_REQUEST['days']));
array_pop($sel_days);
$slot_type = trim($_REQUEST['slotType']);
$from_week = trim($_REQUEST['from_week']);
$to_week = trim($_REQUEST['to_week']);
$from_option = trim($_REQUEST['from_option']);

$__slot_employee = trim($_REQUEST['employee']);
$__slot_customer = trim($_REQUEST['customer']);
$time_from       = $dona->time_to_sixty(trim($_REQUEST['time_from']));
$time_to         = $dona->time_to_sixty(trim($_REQUEST['time_to']));
if($time_to == 0) $time_to = 24;
//-----------------------------------
$sketch_slot = array(
                'employee'  => $__slot_employee, 
                'customer'  => $__slot_customer, 
                'date'      => $sel_date, 
                'slot_type' => $slot_type, 
                'time_from' => $time_from, 
                'time_to'   => $time_to);
$result_flag = $employee->schema_drop_time_slots($sketch_slot, $from_week, $to_week, $from_option, $sel_days);

$dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
if($dont_show_flag && $result_flag){
    $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
}
?>