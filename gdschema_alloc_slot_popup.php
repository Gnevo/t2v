<?php

/*
 * Done by  Shaju
 * Adding New time slot
 * defining new slots for travel,break and normal
 * 
 * For allocation of work, users,customers to a particular time slot
 */
?>
<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
//require_once ('class/dona.php');
require_once ('plugins/date_calc.class.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", "messages.xml"),FALSE);
$week_date = new datecalc();
//$dona = new dona();
$obj_cust = new customer();
$obj_emp = new employee();
$msg = new message();

$cur_date = "";
$cur_employee = array();
$cur_customer = array();
//echo $_REQUEST['date'];
$cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
$week_days = $week_date->get_week_days(date('Y', $cur_date) . '|' . date('W', $cur_date), $_REQUEST['date']);
$smarty->assign('cur_week', date('W', $cur_date));
$smarty->assign('cur_date', $_REQUEST['date']);
$smarty->assign('alloc_week_days', $week_days);
$smarty->assign('emp_alloc', $_SESSION['user_id']);


if (isset($_REQUEST['employee'])) {
    $cur_employee['userid'] = $_REQUEST['employee'];
    $emp = $obj_emp->employee_data($_REQUEST['employee']);
    $cur_employee['name'] = $emp['first_name'] . ' ' . $emp['last_name'];
    $cur_employee['code'] = $emp['code'];
    $cur_employee['contract_week_hour'] = $obj_emp->employee_contract_week_hour($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $cur_employee['week_worked_hour'] = $obj_emp->employee_timetable_week_time($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $smarty->assign('employee', $cur_employee);
}
if (isset($_REQUEST['customer'])) {
    $cur_customer['userid'] = $_REQUEST['customer'];
    $cust = $obj_cust->customer_data($_REQUEST['customer']);
    $cur_customer['name'] = $cust['first_name'] . ' ' . $cust['last_name'];
    $cur_customer['code'] = $cust['code'];
    $cur_customer['contract_week_hour'] = $obj_cust->customer_contract_week_hour($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $cur_customer['week_worked_hour'] = $obj_cust->customer_timetable_week_time($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $smarty->assign('customer', $cur_customer);
}



if ($_REQUEST['action'] == 'type') {//actions on type change
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('action', 'type');
    $smarty->assign('slot_det', $slot_det);
    $smarty->assign('type', $_REQUEST['type']);
    $smarty->assign('action', 'type');
}else if ($_REQUEST['action'] == 'edit_duration') {//actions on type change
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('action', 'edit_duration');
    $smarty->assign('slot_det', $slot_det);
    $smarty->assign('type', $_REQUEST['type']);
    $smarty->assign('action', 'edit_duration');
}else if ($_REQUEST['action'] == 'split') {//actions on type change
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('action', 'split');
    $smarty->assign('slot_det', $slot_det);
    
}else if ($_REQUEST['action'] == 'add_emp') {//actions on user adding
    $smarty->assign('action', 'add_emp');
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('slot_det', $slot_det);
    if ($slot_det['customer'] != '' && $slot_det['employee'] == '') {
       
            $available_users = $obj_emp->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
            //$smarty->assign('unavail_emp_details', $obj_emp->get_unavailable_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']));
            if($available_users){
                $smarty->assign('emp_details', $available_users);
               
            }else{
                $smarty->assign('work', 'error_emp');
                $smarty->assign('message', 'no_employee_available');
            }
                
        
    }
} else if ($_REQUEST['action'] == 'add_cust') {//actions on customer adding
    $smarty->assign('action', 'add_cust');
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('slot_det', $slot_det);
    if ($slot_det['employee'] != '' && $slot_det['customer'] == '') {
        
            $available_customers = $obj_cust->get_available_customers($slot_det['employee'], $slot_det['date']);
            //print_r($obj_cust->get_available_customers($slot_det['work'], $slot_det['date']));
            if($available_customers){
                $smarty->assign('cust_details', $available_customers);
                
            }else{
                $smarty->assign('work', 'error_cust');
                $smarty->assign('message', 'no_customer_available');
            }
        
    }
}

if($_REQUEST['action_right'] == 'change_employee'){
    
}

$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_alloc_slot_popup.tpl');
?>
