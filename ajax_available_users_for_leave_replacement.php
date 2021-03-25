<?php
/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * for: Getting Available users for leave replacement
 * Used in: gdschema_slot_manage.php => save leave section
*/
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
//$smarty = new smartySetup(array("gdschema.xml","messages.xml"), FALSE);
$employee = new employee();
$customer = new customer();

$slot_id = trim($_POST['id']);
$leave_format = trim($_POST['leave_format']);
$available_users = array();

if($_SESSION['user_role'] != 3){
    $slot_details = $customer->customer_employee_slot_details($slot_id);
    if($leave_format == '' && $_POST['action'] == 'get_avail_emps_for_2_methods'){
        
        $available_users['date_users'] = $avail_replace_employees_date = $employee->get_available_users_btwn_a_date_range($slot_details['employee'], $slot_details['date'], $slot_details['date']);
        $available_users['time_users'] = $avail_replace_employees = $employee->get_available_users($slot_details['customer'], $slot_details['time_from'], $slot_details['time_to'], $slot_details['date']);
        
    }else if($leave_format == 1){

        $date_from = trim($_POST['date_from']);
        $date_to = trim($_POST['date_to']);

        $available_users = $avail_replace_employees_date = $employee->get_available_users_btwn_a_date_range($slot_details['employee'], $date_from, $date_to);
//        $smarty->assign('avail_replace_employees_date', $avail_replace_employees_date);
    }else if($leave_format == 2){

        $leave_date = trim($_POST['date']);
        $time_from = trim($_POST['time_from']);
        $time_to = trim($_POST['time_to']);

        $available_users = $avail_replace_employees = $employee->get_available_users($slot_details['customer'], $time_from, $time_to, $leave_date);
//        $smarty->assign('avail_replace_employees', $avail_replace_employees);
    }
}

echo json_encode($available_users);
//$smarty->assign('leave_format', $leave_format);
//$smarty->display('ajax_available_users_for_leave_replacement.tpl');
?>