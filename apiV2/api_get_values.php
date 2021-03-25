<?php
/*
 * Author : Shamsudheen
 * description: to get team customer of an employee
 */
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("user.xml"), FALSE);

$action = strtoupper(trim($_REQUEST['action']));
$obj = array();
$main_obj = new stdClass();
$main_obj->session_status = $session_check;

//get team customers of an employee
if($action == 'GET_EMPLOYEE_CUSTOMERS'){
    $obj_employee = new employee();
    $obj_customer = new customer();
    //$customers_of_employee = $team->customers_for_employee_team_gdschema_alloc($_REQUEST['employee'],$_REQUEST['date']);
    $cust_data = $obj_employee->get_team_customers_of_employee($_REQUEST['employee']);
    $i = 0;
    $obj = array();
    if(!empty($cust_data)){
        $righclick_customers_for_goto = $obj_customer->customer_list();
        $accessible_customer_ids = array();
        if(!empty($righclick_customers_for_goto)){
            foreach($righclick_customers_for_goto as $tc)
                $accessible_customer_ids[] = $tc['username'];
        }

        foreach($cust_data as $data) {
            if(in_array($data['username'], $accessible_customer_ids)){
                $obj[$i]            = new stdClass();
                $obj[$i]->username  = $data['username'];
                $obj[$i]->first_name= $data['first_name'];
                $obj[$i]->last_name = $data['last_name'];
                $obj[$i]->mobile    = $data['mobile'];
                $obj[$i]->email     = $data['email'];
                $obj[$i]->phone     = $data['phone'];
                $obj[$i]->fkkn      = $data['fkkn'];
                $obj[$i]->customer_name = $_SESSION['company_sort_by'] == 1 ? $data['first_name'].' '.$data['last_name'] : $data['last_name'].' '.$data['first_name'];

                $i++;
            }
        }
    }
    // $main_obj->accessible_customer_ids = $accessible_customer_ids;
    $main_obj->data_set = $obj;
}

//get available users for leave replacement
elseif($action == 'LEAVE_REPLACEMENT_EMPLOYEES'){
    $obj_customer = new customer();
    $obj_employee = new employee();
    $obj = new stdClass();
    
    $slot_id        = trim($_REQUEST['id']);
    $leave_format   = trim($_REQUEST['leave_format']);

    if($_SESSION['user_role'] != 3){
        $slot_details = $obj_customer->customer_employee_slot_details($slot_id);
        if($leave_format == '' && isset($_REQUEST['sub_action']) && strtoupper($_REQUEST['sub_action']) == 'GET_AVAIL_EMPS_FOR_2_METHODS'){

            $obj->date_users = $avail_replace_employees_date = $obj_employee->get_available_users_btwn_a_date_range($slot_details['employee'], $slot_details['date'], $slot_details['date']);
            $obj->time_users = $avail_replace_employees = $obj_employee->get_available_users($slot_details['customer'], $slot_details['time_from'], $slot_details['time_to'], $slot_details['date']);

        }else if($leave_format == 1){

            $date_from      = trim($_REQUEST['date_from']);
            $date_to        = trim($_REQUEST['date_to']);
            
            $obj = $avail_replace_employees_date = $obj_employee->get_available_users_btwn_a_date_range($slot_details['employee'], $date_from, $date_to);
            $obj = array_values($obj);
        }else if($leave_format == 2){

            $leave_date = trim($_REQUEST['date']);
            $time_from  = trim($_REQUEST['time_from']);
            $time_to    = trim($_REQUEST['time_to']);

            $obj = $avail_replace_employees = $obj_employee->get_available_users($slot_details['customer'], $time_from, $time_to, $leave_date);
        }
    }
    $main_obj->data_set = $obj;
}

//get available users
elseif($action == 'GET_AVAIL_EMPLOYEES'){
    $obj_employee = new employee();
    $obj_dona = new dona();
    $users = array();
    
    $customer   = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
    $date       = isset($_REQUEST['date']) && trim($_REQUEST['date']) != '' ? trim($_REQUEST['date']) : NULL;
    $time_from  = isset($_REQUEST['time_from']) && trim($_REQUEST['time_from']) != '' ? trim($_REQUEST['time_from']) : NULL;
    $time_to    = isset($_REQUEST['time_to']) && trim($_REQUEST['time_to']) != '' ? trim($_REQUEST['time_to']) : NULL;
    $except_id  = isset($_REQUEST['except_id']) && trim($_REQUEST['except_id']) != '' ? trim($_REQUEST['except_id']) : NULL;

    if($customer != '' && $date != '' && $time_from != '' && $time_to != ''){
        $time_from  = $obj_dona->time_to_sixty($time_from);
        $time_to    = $obj_dona->time_to_sixty($time_to);
        if($time_to == 0) $time_to = 24;

        if($time_from >= $time_to){
            // $users = $obj_employee->get_available_users($customer, $time_from, $time_to, $date, NULL, $except_id);
            $available_users_day1 = $obj_employee->get_available_users($customer, $time_from, 24, $date, NULL, $except_id);
            $next_date = date('Y-m-d', strtotime($date .' +1 day'));
            $available_users_day2 = $obj_employee->get_available_users($customer, 0, $time_to, $next_date, NULL, $except_id);

            $users = array_uintersect($available_users_day1, $available_users_day2, function($value1, $value2) {
                                        return strcmp($value1['username'], $value2['username']);
                                     });
            
        }
        else {
            $users = $obj_employee->get_available_users($customer, $time_from, $time_to, $date, NULL, $except_id);
        }
        if(!empty($users)){
            foreach ($users as $key => $data) {
                unset($users[$key]['name']);
                unset($users[$key]['name_ff']);
            }
        }
    }
    $main_obj->data_set = $users;
}

//get team customers of an employee
elseif($action == 'GET_CUSTOMERS'){
    $obj_customer = new customer();
    $cust_data = $obj_customer->customer_list();
    $i = 0;
    $obj = array();
    if(!empty($cust_data)){
        foreach($cust_data as $data) {
            $obj[$i]            = new stdClass();
            $obj[$i]->username  = $data['username'];
            $obj[$i]->first_name= $data['first_name'];
            $obj[$i]->last_name = $data['last_name'];
            $obj[$i]->mobile    = $data['mobile'];
            $obj[$i]->email     = $data['email'];
            $obj[$i]->phone     = $data['phone'];
            $obj[$i]->fkkn      = $data['fkkn'];
            $obj[$i]->customer_name = $_SESSION['company_sort_by'] == 1 ? $data['first_name'].' '.$data['last_name'] : $data['last_name'].' '.$data['first_name'];

            $i++;
        }
    }
    $main_obj->data_set = $obj;
}

else{
    $main_obj->data_set = array();
}
//header("content-type: text/javascript");
echo json_encode($main_obj);
?>