<?php
require_once('class/setup.php');
require_once('class/employee.php');
$obj_emp = new employee();
$customer = $_REQUEST['selected_customer'];
//$from_week = $_REQUEST['from_week'];
//$to_week = $_REQUEST['to_week'];
$from_option = $_REQUEST['from_option'];
$slot_from = $_REQUEST['slot_from'];
$slot_to = $_REQUEST['slot_to'];
$days = $_REQUEST['days'];
$first_slot_date = $_REQUEST['date'];

$from_week = str_pad($_REQUEST['from_week'], 2,'0', STR_PAD_LEFT);
$to_week = str_pad($_REQUEST['to_week'], 2,'0', STR_PAD_LEFT);
$paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
$paste_year = substr($to_week, 0, 4);
$paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
$paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
$assign_flag = true;
$paste_date = $paste_start_date;
$sel_days = explode('-', trim($_REQUEST['days']));
array_pop($sel_days);
//$available_users =array();
$i=0;
while (strtotime($paste_date) <= strtotime($paste_end_date)) {
    if (in_array((date('N', strtotime($paste_date)) % 7), $sel_days)) {
        if($slot_to <= $slot_from){
            $temp_available_users_day1 = $obj_emp->get_available_users($customer, $slot_from, 24, $paste_date);
            $cur_date = strtotime($paste_date . ' 00:00:00');
            $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
            $temp_available_users_day2 = $obj_emp->get_available_users($customer, 0, $slot_to, $next_date);
            $temp_available_users = $obj_emp->employee_intersect($temp_available_users_day1,$temp_available_users_day2);
            if($i == 0){
                $available_users =  $temp_available_users;
                $i++;
            }
            else
                 $available_users = $obj_emp->employee_intersect($temp_available_users,$available_users);
            
        }else{
//            $temp_available_users = $obj_emp->get_available_users($customer, $slot_from, $slot_to, $paste_date); 
            $temp_available_users = $obj_emp->get_available_users($customer, $slot_from, $slot_to, $paste_date);
            if($i == 0){
                $available_users =  $temp_available_users;
                $i++;
            }
            else
                 $available_users = $obj_emp->employee_intersect($temp_available_users,$available_users);
        }
        
    }
    
    if (date('N', strtotime($paste_date)) == 7)
        $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
    
}
echo json_encode($available_users);

//$available_users = $obj_emp->get_available_users($selected_customer, $slot_from, $slot_to, $selected_date);
?>