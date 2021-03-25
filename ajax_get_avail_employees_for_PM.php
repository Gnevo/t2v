<?php
/**
 * Author: Shamsudheen
 * for: get relative user data by changing month/year/fkkn
 * Used In: FKKN report interface
*/
require_once('class/setup.php');
require_once('class/employee.php');
require_once ('class/customer_ai.php');
require_once ('class/dona.php');

$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", 'messages.xml'), FALSE);
$obj_emp   = new employee();
$obj_customer_ai = new customer_ai();
$dona = new dona();

$obj_return = new stdClass();

$slot_id    = trim($_REQUEST['slot_id']);
$slot_date  = trim($_REQUEST['slot_date']);
$time_from  = $dona->time_to_sixty(trim($_REQUEST['time_from']));
$time_to    = $dona->time_to_sixty(trim($_REQUEST['time_to']));
if($time_to == 0) $time_to = 24;

$available_employees = $unavailable_employees = $avail_employee_ids = array();
$slot_detail = $obj_emp->customer_employee_slot_details($slot_id);

if(!in_array($_SESSION['user_role'], array(3, 4)) && !empty($slot_detail) && $time_to > $time_from ){
//    $obj_return->slot_det = $slot_detail;
    $customer_employees = array();
    if($slot_detail['customer'] != ''){
        $customer_employees = $obj_customer_ai->customer_team($slot_detail['customer']);
//        $obj_return->customer_members = $customer_employees;
    }
    /*if($slot_detail['employee'] != ''){
        $slot_employee_details = $obj_emp->get_employee_detail($slot_detail['employee']);
        $obj_return->slot_employee_details = $slot_employee_details;
    }*/
    
    $this_slot_customer = ($slot_detail['customer'] != '' ? $slot_detail['customer'] : NULL);
    $available_employees = $obj_emp->get_available_users_for_PM($this_slot_customer, $time_from, $time_to, $slot_date, $slot_id);
    
    if(!empty($available_employees)){
        foreach($available_employees as $avail_emp){
            $avail_employee_ids[] = $avail_emp['username'];
        }
        
        if(!empty($customer_employees)){
            foreach($customer_employees as $cust_emp){
                if(!in_array($cust_emp['employee'], $avail_employee_ids))
                    $unavailable_employees[] = $cust_emp;
            }
        }
    }
//    echo "<pre>".print_r($available_employees, 1)."</pre>";
}

$obj_return->available_employees = $available_employees;
$obj_return->unavailable_employees = $unavailable_employees;
$obj_return->avail_employee_ids = $avail_employee_ids;

echo json_encode($obj_return);
//$smarty->display('ajax_get_avail_employees_for_PM.tpl');
?>