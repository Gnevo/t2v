<?php
/*
 * Author : Shamsudheen
 * description: to get team customer of an employee
 */
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml"), FALSE);

$action = strtoupper(trim($_REQUEST['action']));
$obj = array();

//get team customers of an employee
if($action == 'GET_EMPLOYEE_CUSTOMERS'){
    $obj_employee = new employee();
    //$customers_of_employee = $team->customers_for_employee_team_gdschema_alloc($_REQUEST['employee'],$_REQUEST['date']);
    $cust_data = $obj_employee->get_team_customers_of_employee($_REQUEST['employee']);
    $i = 0;
    $obj = array();
    if(!empty($cust_data)){
        foreach($cust_data as $data) {
                $obj[$i] = new stdClass();
                $obj[$i]->username = $data['username'];
                $obj[$i]->first_name = $data['first_name'];
                $obj[$i]->last_name = $data['last_name'];
                $obj[$i]->mobile = $data['mobile'];
                $obj[$i]->email = $data['email'];
                $obj[$i]->phone = $data['phone'];

                $i++;
        }
    }
}

//get available users for leave replacement
else if($action == 'LEAVE_REPLACEMENT_EMPLOYEES'){
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
        }else if($leave_format == 2){

            $leave_date = trim($_REQUEST['date']);
            $time_from  = trim($_REQUEST['time_from']);
            $time_to    = trim($_REQUEST['time_to']);

            $obj = $avail_replace_employees = $obj_employee->get_available_users($slot_details['customer'], $time_from, $time_to, $leave_date);
        }
    }
}

//get available users
else if($action == 'GET_AVAIL_EMPLOYEES'){
    $obj_customer = new customer();
    $obj_employee = new employee();
    $obj = new stdClass();
    
    $customer   = trim($_REQUEST['customer']);
    $date       = trim($_REQUEST['date']);
    $time_from  = trim($_REQUEST['time_from']);
    $time_to    = trim($_REQUEST['time_to']);
    $slot_id = NULL;
    if(isset($_REQUEST['slot_id']) && $_REQUEST['slot_id'] != '')
        $slot_id = $_REQUEST['slot_id'];
    if($customer != '' && $date != '' && $time_from != '' && $time_to != ''){
        $obj = $obj_employee->get_available_users($customer, $time_from, $time_to, $date, NULL, $slot_id);
    }
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>