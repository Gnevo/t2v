<?php
//error_reporting(E_ALL);
//error_reporting(E_WARNING);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);

require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
// require_once('class/leave.php');
require_once('class/employee.php');
require_once('class/timetable.php');
require_once('class/general.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
// $leave = new leave();
$obj_employee = new employee();
$obj_timetable = new timetable();
$obj_general = new general();

$start_date = isset($_REQUEST['start_date']) && trim($_REQUEST['start_date']) != '' ? trim($_REQUEST['start_date']) : NULL;
$end_date   = isset($_REQUEST['end_date']) && trim($_REQUEST['end_date']) != '' ? trim($_REQUEST['end_date']) : NULL;
$selected_customer = trim($_REQUEST['user']);
if($start_date != NULL && $end_date != NULL && $selected_customer != ''){
    // $data = $leave->get_customer_schedule_between_dates(trim($_REQUEST['user']), $start_date, $end_date);
    $data = $obj_timetable->customer_slots_btwn_dates($selected_customer, $start_date, $end_date);
}else 
    $data = array();

// echo "<pre>".print_r($data, 1)."</pre>";
$obj = array();
// $prev_week = 0;
$i = 0;

$privileges_gd = $obj_employee->get_privileges($_SESSION['user_id'], 1, $selected_customer);

if(!empty($data)){

    foreach($data as $slot) {
        if ($_SESSION['user_role'] != 3 || ($_SESSION['user_role'] == 3 && ($privileges_gd['not_show_employees']) == 0 || ($privileges_gd['not_show_employees'] == 1 && $slot['employee'] == $_SESSION['user_id']))){
            $obj[$i]            = new stdClass();
            $obj[$i]->id       = $slot['id'];
            $obj[$i]->customer = $slot['customer'];
            $obj[$i]->employee = $slot['employee'];
            // $obj[$i]->customer_name     = $_SESSION['company_sort_by'] == 1 ? $slot['customer_first_name'].' '.$slot['customer_last_name'] : $slot['customer_last_name'].' '.$slot['customer_first_name'];
            // $obj[$i]->employee_name     = $_SESSION['company_sort_by'] == 1 ? $slot['employee_first_name'].' '.$slot['employee_last_name'] : $slot['employee_last_name'].' '.$slot['employee_first_name'];
            // $obj[$i]->employee_color    = $slot['employee_color'];
            $obj[$i]->customer_name     = $slot['cust_name'];
            $obj[$i]->employee_name     = $slot['emp_name'];
            $obj[$i]->employee_color    = $slot['emp_color'];
            $obj[$i]->date     = $slot['date'];
            // $obj[$i]->week  = $prev_week != $slot['week'] ? $slot['week'] : NULL;
            $obj[$i]->time_from= $slot['time_from'];
            $obj[$i]->time_to  = $slot['time_to'];
            // $obj[$i]->total_hours = str_replace('.', ':', time_difference($slot['time_from'], $slot['time_to']));
            $obj[$i]->total_hours = str_replace('.', ':', $slot['slot_hour']);
            $obj[$i]->status   = $slot['status'];
            $obj[$i]->type     = $slot['type'];
            $obj[$i]->fkkn     = $slot['fkkn'];
            $obj[$i]->comment  = $slot['comment'];
            $obj[$i]->created_status = $slot['created_status'];
            $obj[$i]->signed    = $slot['signed'];
            $obj[$i]->tl_flag    = $slot['tl_flag'];
            $obj[$i]->leave_details   = new stdClass();
            if($slot['status'] == 2){
                $leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
                if(!empty($leave_data)){
                    // $obj[$i]->leave_type = $smarty->leave_type[$leave_data[0]['type']];
                    $obj[$i]->leave_details->id         = $leave_data[0]['id'];
                    $obj[$i]->leave_details->group_id   = $leave_data[0]['group_id'];
                    $obj[$i]->leave_details->time_from  = $leave_data[0]['time_from'];
                    $obj[$i]->leave_details->time_to    = $leave_data[0]['time_to'];
                    $obj[$i]->leave_details->type       = $leave_data[0]['type'];
                    $obj[$i]->leave_details->leave_type = $smarty->leave_type[$leave_data[0]['type']];
                    $obj[$i]->leave_details->status     = $leave_data[0]['status'];
                }
            }
            // else
            //     $obj[$i]->leave_type = NULL;

            $i++;
            // $prev_week = $slot['week'];
        }
    }
}

$obj = $obj_general->traverse_all_elements_set_null_to_empty($obj);

$privilege_customers_set = array();
if($selected_customer != ''){
    if(empty($privileges_gd)) $privileges_gd = new stdClass();
    else{ $privileges_gd['customer'] = $selected_customer; }

    $privilege_customers_set[] = $privileges_gd;
}

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $obj;
$main_obj->privilege_customers_set = $privilege_customers_set;
echo json_encode($main_obj);


/*function time_difference($t1, $t2, $mod=60) {
    $a1 = explode(".", $t1);
    $a2 = explode(".", $t2);
    $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
    $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
    $diff = abs($time1 - $time2);
    $hours = floor($diff / (60 * 60));
    $mins = floor(($diff - ($hours * 60 * 60)) / (60));
    if($mod == 100)
        $mins = round($mins*100/60);
    //$result = $hours . "." . sprintf('%02d', $mins);
    $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
    return $result;
}*/
?>