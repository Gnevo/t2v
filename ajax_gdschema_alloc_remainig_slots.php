<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
//require_once ('class/dona.php');
require_once ('plugins/date_calc.class.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
$week_date = new datecalc();
//$dona = new dona();

$customer = new customer();
$employee = new employee();
$msg = new message();

$cur_employee = array();
$cur_customer = array();
//echo "<script>alert(\"".$employee->checkATL('gine001', '2012-11-22', '0.00', '24.00s')."\")</script>";
$cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
$week_days = $week_date->get_week_days(date('o', $cur_date) . '|' . date('W', $cur_date), $_REQUEST['date']);
$signed_date = $employee->get_signed_date($_REQUEST['employee']);
for($i=0; $i<7;$i++){
    if(strtotime($signed_date) < strtotime($week_days[$i]['date']))
        $week_days[$i]['flag'] = 1;
    else
        $week_days[$i]['flag'] = 0;
}
$customer_for_privilege = '';
if(isset($_REQUEST['customer'])){
    $customer_for_privilege = $_REQUEST['customer'];
}
$dat = $employee->get_privileges($_SESSION['user_id'], 1, $customer_for_privilege);
$smarty->assign('inconv_timings', $employee->get_inconvenient_on_a_day($_REQUEST['date'],3));
$smarty->assign('cur_week', date('W', $cur_date)); //current running week
$smarty->assign('cur_date', $_REQUEST['date']); //clicked date
$smarty->assign('alloc_week_days', $week_days);
$smarty->assign('emp_alloc', $_SESSION['user_id']); //emplyee logged in
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$smarty->assign('message', $msg->show_message()); //messages of actions
$smarty->assign('privileges_gd', $dat);//setting previlege

    
    $smarty->assign('privilege_add_employee',$dat['add_employee']);

$flag_sign = 0;
if($_SESSION['user_role'] == 1)
    $smarty->assign('process_previlege', 1);
else
    $smarty->assign('process_previlege', $employee->has_privilege($_SESSION['user_id'], 'process'));

if (isset($_REQUEST['employee'])) {
    $cur_employee['userid'] = $_REQUEST['employee'];
    $emp = $employee->employee_data($_REQUEST['employee']);
    $cur_employee['name'] = $emp['last_name'] . ' ' . $emp['first_name'];
    $cur_employee['code'] = $emp['code'];
    $cur_employee['contract_week_hour'] = $employee->employee_contract_week_hour($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $cur_employee['week_worked_hour'] = $employee->employee_timetable_week_time($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $smarty->assign('employee', $cur_employee);
}
if (isset($_REQUEST['customer'])) {
    $cur_customer['userid'] = $_REQUEST['customer'];
    $cust = $customer->customer_data($_REQUEST['customer']);
    $cur_customer['name'] = $cust['last_name'] . ' ' . $cust['first_name'];
    $cur_customer['code'] = $cust['code'];
    $cur_customer['contract_week_hour_fk'] = $customer->customer_contract_week_hour($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 1);
    $cur_customer['week_worked_hour_fk'] = $customer->customer_timetable_week_time($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 1);
    $cur_customer['contract_week_hour_kn'] = $customer->customer_contract_week_hour($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 2);
    $cur_customer['week_worked_hour_kn'] = $customer->customer_timetable_week_time($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 2);
    $smarty->assign('customer', $cur_customer);
}

if(isset($_REQUEST['employee']) && isset($_REQUEST['customer'])){
    $flag_sign = $employee->chk_employee_rpt_signed($_REQUEST['employee'], $_REQUEST['customer'], $_REQUEST['date']);
}

 $smarty->assign('flag_sign', $flag_sign);
$memory_slots = array();
if ($_REQUEST['employee'] != "" && $_REQUEST['customer'] != "") {
    
    //print_r($employee->timetable_customer_employee_slots($_REQUEST['customer'],$_REQUEST['employee'],$_REQUEST['date']));
    $smarty->assign('slot_details', $slot_detail = $employee->timetable_customer_employee_slots($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date']));
    
    $memory_slots = $employee->get_memory_slots($_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['customer']);
} else if ($_REQUEST['employee'] != "" && $_REQUEST['customer'] == "") {
    $smarty->assign('slot_details', $slot_detail = $employee->timetable_customer_employee_slots('', $_REQUEST['employee'], $_REQUEST['date']));
    
    $memory_slots = $employee->get_memory_slots($_REQUEST['employee'], $_REQUEST['date']);
} else if ($_REQUEST['employee'] == "" && $_REQUEST['customer'] != "") {
    //print_r($obj_emp->get_available_users('1', '14', '14.30', '2012-03-14'));
    $smarty->assign('slot_details',$slot_detail = $employee->timetable_customer_employee_slots($_REQUEST['customer'], '', $_REQUEST['date']));
   
    if($_SESSION['user_role'] == 3){
        $memory_slots =  $employee->get_memory_slots($_SESSION['user_id'], $_REQUEST['date'], $_REQUEST['customer']);
    }else{
        $memory_slots = $customer->get_memory_slots($_REQUEST['customer'], $_REQUEST['date']);
    }
}
$count_slot_detail = count($slot_detail);
$count_memory_slots = count($memory_slots);

$no_of_slot_entries_for_first_column= ceil($count_slot_detail/2);
$slot_entries_for_first_column = array();
$slot_entries_for_second_column = array();
if($count_slot_detail <= 6){
    $smarty->assign('slots_detail_width',307);
    $slot_entries_for_first_column = $slot_detail;
}else{
    $smarty->assign('slots_detail_width',595);
    $slot_entries_for_first_column = array_slice($slot_detail, 0,$no_of_slot_entries_for_first_column);
    $slot_entries_for_second_column = array_slice($slot_detail, $no_of_slot_entries_for_first_column);
}
$smarty->assign('slot_entries_for_first_column',$slot_entries_for_first_column);
$smarty->assign('slot_entries_for_second_column',$slot_entries_for_second_column);

//to know dont' show again
$__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
$__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
$general_setting_cust_employee = $employee->get_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag');
$dont_show_popup_flag = !empty($general_setting_cust_employee) && $general_setting_cust_employee[0]['dont_show_slot_operation_flag'] == 1 ? TRUE : FALSE;
$smarty->assign('dont_show_popup_flag', $dont_show_popup_flag);



$i=0;
$j = 1;
$memory_slots1 = array();
$memory_slots2 = array();
$memory_slots3 = array();
if($count_memory_slots <= 28){
    $memory_count = ceil(count($memory_slots)/2);
    foreach ($memory_slots as $memory_slot){
        if($i == $memory_count){
            $j++;
            $memory_count += ceil((count($memory_slots) - $memory_count)/(3-$j));
        }
        if($j == 1)
            $memory_slots1[] = $memory_slot;
        else if($j == 2)
            $memory_slots2[] = $memory_slot;
//        else if($j == 3)
//            $memory_slots3[] = $memory_slot;
        $i++;
    }
    $smarty->assign('memory_slots1', $memory_slots1);
    $smarty->assign('memory_slots2', $memory_slots2);
//    $smarty->assign('memory_slots3', $memory_slots3);
}else{
    $memory_count = ceil(count($memory_slots)/3);
    foreach ($memory_slots as $memory_slot){
        if($i == $memory_count){
            $j++;
            $memory_count += ceil((count($memory_slots) - $memory_count)/(4-$j));
        }
        if($j == 1)
            $memory_slots1[] = $memory_slot;
        else if($j == 2)
            $memory_slots2[] = $memory_slot;
        else if($j == 3)
            $memory_slots3[] = $memory_slot;
        $i++;
    }
    $smarty->assign('memory_slots1', $memory_slots1);
    $smarty->assign('memory_slots2', $memory_slots2);
    $smarty->assign('memory_slots3', $memory_slots3);
}
$smarty->display('ajax_gdschema_alloc_remainig_slots.tpl');
?>