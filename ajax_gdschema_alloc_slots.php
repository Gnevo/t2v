<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/dona.php');
require_once ('class/team.php');
require_once ('class/user.php');
require_once ('plugins/date_calc.class.php');
require_once ('plugins/message.class.php');
//require_once ('class/dona.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml', 'reports.xml'), FALSE);
$week_date = new datecalc();
$customer = new customer();
$dona = new dona();
$team = new team();
$employee = new employee();
$msg = new message();
$obj_user = new user();
//$dona = new dona();
//echo "<pre>". print_r($_REQUEST, 1)."</pre>";

$customer_to_add = $_REQUEST['customer'];
if ($_SESSION['user_role'] == 4)
    $customer_to_add = $_SESSION['user_id'];

$dat = $employee->get_privileges($_SESSION['user_id'], 1, $customer_to_add);

$employee_to_add = $_REQUEST['employee'];
if ($_SESSION['user_role'] == 3)
    $employee_to_add = ($dat['add_employee'] == 1 ? $_SESSION['user_id'] : '');

$memslot_type = trim($_REQUEST['slotType']);


$proceed_flag = TRUE;
if($employee_to_add != '' && $customer_to_add != ''){
    if($employee->chk_employee_rpt_signed($employee_to_add, $customer_to_add, $_REQUEST['date'], TRUE) == 1){
        $proceed_flag = FALSE;
    }
}
if($proceed_flag){
    if(isset($_REQUEST['multiple']) && $_REQUEST['multiple'] != ""){
        $multiple_time_slot = explode(",", $_REQUEST['multiple']);
        $transaction_flag = TRUE;
        $dona->begin_transaction();
        for($i=0;$i<count($multiple_time_slot);$i++){
            $time_slot = explode("-",$multiple_time_slot[$i]);
            if($time_slot[0] > $time_slot[1]){
//                $next_date = date('Y-m-d', ($_REQUEST['date'] + 24 * 3600));
                $next_date = date('Y-m-d', strtotime($_REQUEST['date'] . "+1 days"));
                $process_params = array(
                                    'employee'      =>  $employee_to_add,
                                    'customer'      =>  $customer_to_add, 
                                    'date'          =>  $_REQUEST['date'], 
                                    'type'          =>  $time_slot[2], 
                                    'time_from'     =>  $time_slot[0], 
                                    'time_to'       =>  24); 

                if(!$employee->findout_slot_alteration_bug($process_params)){
                    $transaction_flag = FALSE;
                    break;
                }
                if($transaction_flag){
                    $process_params = array(
                                        'employee'      =>  $employee_to_add,
                                        'customer'      =>  $customer_to_add, 
                                        'date'          =>  $next_date, 
                                        'type'          =>  $time_slot[2], 
                                        'time_from'     =>  0, 
                                        'time_to'       =>  $time_slot[1]); 

                    if(!$employee->findout_slot_alteration_bug($process_params)){
                        $transaction_flag = FALSE;
                        break;
                    }
                }
                if($transaction_flag){

                    if(!$dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_slot[0], 24, $_REQUEST['emp_alloc'], '', $time_slot[2])){
                        $transaction_flag = FALSE;
                        break;
                    }
                    if(!$dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $next_date, 0, $time_slot[1], $_REQUEST['emp_alloc'], '', $time_slot[2])){
                        $transaction_flag = FALSE;
                        break;
                    }
                }
            }
            else{
                $process_params = array(
                                    'employee'      =>  $employee_to_add,
                                    'customer'      =>  $customer_to_add, 
                                    'date'          =>  $_REQUEST['date'], 
                                    'type'          =>  $time_slot[2], 
                                    'time_from'     =>  $time_slot[0], 
                                    'time_to'       =>  $time_slot[1]); 

                if(!$employee->findout_slot_alteration_bug($process_params)){
                    $transaction_flag = FALSE;
                    break;
                }

                if(!$dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_slot[0], $time_slot[1], $_REQUEST['emp_alloc'], '', $time_slot[2])){
                    $transaction_flag = FALSE;
                    break;
                }
            }
        }
        if($transaction_flag){
            $dona->commit_transaction();
//            if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
//                $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
        }else 
            $dona->rollback_transaction ();
//        echo '<script>$("#chk_status").val("1")</script>';
    }else{
        if($_REQUEST['time_from'] >= $_REQUEST['time_to']){
            
            $cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
            $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
            $transaction_flag = TRUE;
            
            
            $process_params = array(
                                'employee'      =>  $employee_to_add,
                                'customer'      =>  $customer_to_add, 
                                'date'          =>  $_REQUEST['date'], 
                                'type'          =>  $memslot_type, 
                                'time_from'     =>  $_REQUEST['time_from'], 
                                'time_to'       =>  24); 
            
            if(!$employee->findout_slot_alteration_bug($process_params))
                $transaction_flag = FALSE;
                
            
            if($transaction_flag){
                $process_params = array(
                                    'employee'      =>  $employee_to_add,
                                    'customer'      =>  $customer_to_add, 
                                    'date'          =>  $next_date, 
                                    'type'          =>  $memslot_type, 
                                    'time_from'     =>  0, 
                                    'time_to'       =>  $_REQUEST['time_to']); 
                if(!$employee->findout_slot_alteration_bug($process_params))
                    $transaction_flag = FALSE;
            }
            
            if($transaction_flag){
                if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $_REQUEST['time_from'], 24, $_REQUEST['emp_alloc'],'',$memslot_type)) {
//                    if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
//                        $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], 24, $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
                    echo '<script>$("#chk_status").val("1")</script>';
                } else {
                    $msg->set_message('fail', 'insertion_failed');
                    echo '<script>navigatePage(\'' . $url . '\', 1)</script>';
                }
                if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $next_date, 0, $_REQUEST['time_to'], $_REQUEST['emp_alloc'],'',$memslot_type)) {
//                    if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
//                        $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], 0, $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
                    echo '<script>$("#chk_status").val("1")</script>';
                } else {
                    $msg->set_message('fail', 'insertion_failed');
                    echo '<script>navigatePage(\'' . $url . '\', 1)</script>';
                }
            }
        }else{
            
            $process_params = array(
                                'employee'      =>  $employee_to_add,
                                'customer'      =>  $customer_to_add, 
                                'date'          =>  $_REQUEST['date'], 
                                'type'          =>  $memslot_type, 
                                'time_from'     =>  $_REQUEST['time_from'], 
                                'time_to'       =>  $_REQUEST['time_to']); 
            
            if($employee->findout_slot_alteration_bug($process_params)){
                if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $_REQUEST['time_from'], $_REQUEST['time_to'], $_REQUEST['emp_alloc'],'',$memslot_type)) {
                    if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                        $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
                    echo '<script>$("#chk_status").val("1")</script>';
                } else {
                    $msg->set_message('fail', 'insertion_failed');
                    echo '<script>navigatePage(\'' . $url . '\', 1)</script>';
                }
            }
        }
    }
    $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
    if($dont_show_flag){
        $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
        $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
    }
}

$cur_employee = array();
$cur_customer = array();
$cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
$week_days = $week_date->get_week_days(date('o', $cur_date) . '|' . date('W', $cur_date), $_REQUEST['date']);
$signed_date = $employee->get_signed_date($_REQUEST['employee']);
for($i=0; $i<7;$i++){
    if(strtotime($signed_date) < strtotime($week_days[$i]['date']))
        $week_days[$i]['flag'] = 1;
    else
        $week_days[$i]['flag'] = 0;
}


$smarty->assign('cur_week', date('W', $cur_date)); //current running week
$smarty->assign('cur_date', $_REQUEST['date']); //clicked date
$smarty->assign('alloc_week_days', $week_days);
$smarty->assign('emp_alloc', $_SESSION['user_id']); //emplyee logged in
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$smarty->assign('message', $msg->show_message()); //messages of actions

$smarty->assign('privileges_gd', $dat);//setting gdschema previlege
$smarty->assign('privileges_mc', $employee->get_privileges($_SESSION['user_id'], 3));//setting message center previlege

$flag_sign = 0;
if($_SESSION['user_role'] == 1)
    $smarty->assign('process_previlege', 1);
else
    $smarty->assign('process_previlege', $employee->has_privilege($_SESSION['user_id'], 'process'));

if (isset($_REQUEST['employee']) && $_REQUEST['employee'] != "") {
    $cur_employee['userid'] = $_REQUEST['employee'];
    $emp = $employee->employee_data($_REQUEST['employee']);
    $cur_employee['name'] = $emp['last_name'] . ' ' . $emp['first_name'];
    $cur_employee['code'] = $emp['code'];
    $cur_employee['contract_week_hour'] = $employee->employee_contract_week_hour($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $cur_employee['week_worked_hour'] = $employee->employee_timetable_week_time($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $smarty->assign('employee', $cur_employee);
}
if (isset($_REQUEST['customer']) && $_REQUEST['customer'] != "") {
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
if (isset($_REQUEST['employee']) && isset($_REQUEST['customer'])) {
    $smarty->assign('slot_details',$slot_detail = $employee->timetable_customer_employee_slots($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date']));
    $memory_slots = $employee->get_memory_slots($_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['customer']);
} else if (isset($_REQUEST['employee']) && !isset($_REQUEST['customer'])) {
    $smarty->assign('slot_details',$slot_detail = $employee->timetable_customer_employee_slots('', $_REQUEST['employee'], $_REQUEST['date']));
    $memory_slots = $employee->get_memory_slots($_REQUEST['employee'], $_REQUEST['date']);
} else if (!isset($_REQUEST['employee']) && isset($_REQUEST['customer'])) {
    $smarty->assign('slot_details',$slot_detail = $employee->timetable_customer_employee_slots($_REQUEST['customer'], '', $_REQUEST['date']));
    if($_SESSION['user_role'] == 3){
        $memory_slots =  $employee->get_memory_slots($_SESSION['user_id'], $_REQUEST['date'], $_REQUEST['customer']);
    }else{
        $memory_slots = $customer->get_memory_slots($_REQUEST['customer'], $_REQUEST['date']);
    }
}
/* ------------------------------- getting extra details for only leave slots ---------------------- */
$count_slot_detail = count($slot_detail);
$count_memory_slots = count($memory_slots);
for($i=0 ; $i<$count_slot_detail ; $i++){
    if($slot_detail[$i]['status'] == 2){ //getting leave slots only
        $leave_data = $employee->get_leave_details_byTimeTable_data($slot_detail[$i]['employee'],$slot_detail[$i]['date'],$slot_detail[$i]['slot_from'],$slot_detail[$i]['slot_to']);
        $slot_detail[$i]['leave_data'] = $leave_data[0];
        $slot_detail[$i]['leave_data']['leave_name'] = $smarty->leave_type[$leave_data[0]['type']];
        
        $related_slot = $employee->check_relations_in_timetable_for_leave($slot_detail[$i]['id']);
        if(!empty($related_slot))
            $slot_detail[$i]['leave_data']['is_exist_relation'] = 1;
        else
            $slot_detail[$i]['leave_data']['is_exist_relation'] = 0;
    }
}

/* ------------------------------- getting extra leave slot details--endz-------------------- */



/*--------------------- Removing duplicate slots for employee------*/
if($_SESSION['user_role'] == 3){
    $prev = array();
    for($i=0;$i<count($slot_detail);$i++){
        if($slot_detail[$i]['status'] == 0){
            for($j=$i-1;$j>=0;$j--){
                if($slot_detail[$j]['status'] == 1){
                        if(($slot_detail[$i]['slot_from'] >= $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] <= $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_to'])  && $slot_detail[$j]['employee'] == $_SESSION['user_id']){
                        $prev[] = $i;
                    }
                }
            }
            for($j=$i+1;$j<count($slot_detail);$j++){
                if($slot_detail[$j]['status'] == 1){
                    if(($slot_detail[$i]['slot_from'] >= $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] <= $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_to'])  && $slot_detail[$j]['employee'] == $_SESSION['user_id']){
                        $prev[] = $i;
                    }
                }
            }
        }
    }
}
for($i=0;$i<count($prev);$i++){
    unset($slot_detail[$prev[$i]]); 
}
/*--------------------- Removing duplicate slots for employee end------*/


$count_slot_detail = count($slot_detail);
$no_of_slot_entries_for_first_column= ceil($count_slot_detail/2);
$slot_entries_for_first_column = array();
$slot_entries_for_second_column = array();
if($count_slot_detail <= 6){
    $slot_entries_for_first_column = $slot_detail;
}else{
    $slot_entries_for_first_column = array_slice($slot_detail, 0,$no_of_slot_entries_for_first_column);
    $slot_entries_for_second_column = array_slice($slot_detail, $no_of_slot_entries_for_first_column);
}
$smarty->assign('slot_entries_for_first_column',$slot_entries_for_first_column);
$smarty->assign('slot_entries_for_second_column',$slot_entries_for_second_column);


$smarty->assign('flag_copy', 0);
if(count($slot_detail))
    $smarty->assign('flag_copy', 1);
$smarty->assign('flag_paste',0);
if($obj_user->retrieve_from_temp_session(1) != '' && $flag_sign == 0)
    $smarty->assign('flag_paste',1);

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
$tl_role_on_customer = $employee->get_employee_role_on_customer($_REQUEST['customer'], $_SESSION['user_id']);

    $employees_customer = $team->employees_for_customer_team_gdschema_alloc($_REQUEST['customer'],$_REQUEST['date']);



$__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
$__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
$general_setting_cust_employee = $employee->get_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag');
$dont_show_popup_flag = !empty($general_setting_cust_employee) && $general_setting_cust_employee[0]['dont_show_slot_operation_flag'] == 1 ? 1 : 0;
$dont_show_popup_delete_flag = 0;   //common delete flag to identify dont_show popup
//add an additional flag to each employees( to assign) to identify dont_show popup flag
if(!empty($employees_customer)){
    $count_employees_to_assign = count($employees_customer);
    for($b = 0 ; $b < $count_employees_to_assign ; $b++){
        $_this_general_setting_cust_employee = $employee->get_customer_employee_general_setting($_REQUEST['customer'], $employees_customer[$b]['username'], 'dont_show_slot_operation_flag');
        $employees_customer[$b]['dont_popup_flag'] = !empty($_this_general_setting_cust_employee) && $_this_general_setting_cust_employee[0]['dont_show_slot_operation_flag'] == 1 ? 1 : 0;
        $dont_show_popup_delete_flag = $employees_customer[$b]['dont_popup_flag'] == 1 ? 1 : $dont_show_popup_delete_flag;
    }
}
$dont_show_popup_delete_flag = $dont_show_popup_delete_flag == 1 || $dont_show_popup_flag == 1 ? 1 : 0;
$smarty->assign('dont_show_popup_delete_flag', $dont_show_popup_delete_flag);


$customers_of_employee = $team->customers_for_employee_team_gdschema_alloc($_REQUEST['employee'],$_REQUEST['date']);
$smarty->assign('employees_to_assign', $employees_customer);
$smarty->assign('customers_to_assign', $customers_of_employee);

$smarty->display('ajax_gdschema_alloc_slots.tpl');
?>