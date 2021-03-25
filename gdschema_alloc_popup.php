<?php
/*
 * Done by  Shaju
 * Adding New time slot
 * defining new slots for travel,break and normal
 * For allocation of work, users,customers to a particular time slot
 */

require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
//require_once ('class/dona.php');
require_once ('plugins/date_calc.class.php');
//require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", 'messages.xml'),FALSE);
$week_date = new datecalc();
//$dona = new dona();
$obj_cust = new customer();
$obj_emp = new employee();
//$msg = new message();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname

$cur_employee = array();
$cur_customer = array();
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



if ($_REQUEST['action'] == 'type') {    //actions on type change
    require_once ('class/customer_ai.php');
    $obj_customer_ai = new customer_ai();
    
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('action', 'type');
    $smarty->assign('slot_det', $slot_det);
    $smarty->assign('type', $_REQUEST['type']);
    $smarty->assign('inconv_timings', $obj_emp->get_inconvenient_on_a_day($_REQUEST['date'],3));
//    $smarty->assign('inconv_timings', $obj_emp->get_inconvenient_on_a_day($_REQUEST['date'],14));
    $available_employees = $unavailable_employees = $avail_employee_ids = array();
//    echo "<pre>".print_r($_SESSION, 1)."</pre>";
    
    if(!in_array($_SESSION['user_role'], array(3, 4)) && !empty($slot_det)){
        /*if($slot_det['customer'] != ''){
            $customer_employees = $obj_customer_ai->customer_team($slot_det['customer']);
            $smarty->assign('customer_members', $customer_employees);
    //        echo "<pre>".print_r($customer_employees, 1)."</pre>";
        }
        if($slot_det['employee'] != ''){
            $slot_employee_details = $obj_emp->get_employee_detail($slot_det['employee']);
            $smarty->assign('slot_employee_details', $slot_employee_details);
        }*/
        $customer_employees = array();
        if($slot_det['customer'] != ''){
            $customer_employees = $obj_customer_ai->customer_team($slot_det['customer']);
            $smarty->assign('customer_members', $customer_employees);
        }
        if($slot_det['employee'] != ''){
            $slot_employee_details = $obj_emp->get_employee_detail($slot_det['employee']);
            $smarty->assign('slot_employee_details', $slot_employee_details);
        }

        $this_slot_customer = ($slot_det['customer'] != '' ? $slot_det['customer'] : NULL);
    //    $available_employees = $obj_emp->get_available_users($this_slot_customer, $time_from, $time_to, $slot_det['date']);
        $available_employees = $obj_emp->get_available_users_for_PM($this_slot_customer, $slot_det['time_from'], $slot_det['time_to'], $slot_det['date'], $_REQUEST['id']);

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
    }
    $smarty->assign('available_employees', $available_employees);
    $smarty->assign('unavailable_employees', $unavailable_employees);
    $smarty->assign('avail_employee_ids', $avail_employee_ids);
}
else if ($_REQUEST['action'] == 'add_emp') {//actions on user adding
    $smarty->assign('action', 'add_emp');
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('slot_det', $slot_det);
    if ($slot_det['customer'] != '' && $slot_det['employee'] == '') {
       
            $available_users = $obj_emp->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
            $smarty->assign('unavail_emp_details', $obj_emp->get_unavailable_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']));
            if($available_users){
                $smarty->assign('emp_details', $available_users);
               
            }else{
                $smarty->assign('work', 'error_emp');
                $smarty->assign('message', 'no_employee_available');
            }
    }
} 
else if ($_REQUEST['action'] == 'add_cust') {//actions on customer adding
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
else if($_REQUEST['action'] == 'edit_duration'){
    $smarty->assign('action', 'edit_duration');
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $smarty->assign('slot_det', $slot_det);
    $smarty->assign('type', $_REQUEST['type']);
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

$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_alloc_popup.tpl');
?>