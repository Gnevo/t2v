<?php
/*
 * Author: Shaju
 * Date: 2014-02-21
 * Purpose: to get the report signing details
 * 
 */
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/inconvenient.php');
require_once('class/leave.php');
require_once('class/report_signing.php');

$smarty     = new smartySetup(array("user.xml"), FALSE);
$user       = new user();
$employee   = new employee();
$customer   = new customer();
$obj_inconv = new inconvenient();
$obj_leave  = new leave();

$login_employee     = $_SESSION['user_id']; //$_REQUEST['user'];
$selected_year      = $_REQUEST['year'];
$selected_month     = $_REQUEST['month'];
$search_user_id     = trim($_REQUEST['employee']);
$search_customer_id = trim($_REQUEST['customer']);
$search_mode        = trim($_REQUEST['mode']);

$search_emp_details = $employee->get_employee_detail($search_user_id);
$search_cust_ids    = $search_emp_ids = array();
$search_customers   = $customer->customers_list_for_employee_report(-1);
$search_employees   = $employee->employees_list_for_right_click($login_employee, -1);

$login_user         = $login_employee; //$_SESSION['user_id'];
$login_user_role    = $user->user_role($login_user);

if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}

$report_list = array();
if ($search_mode == 'EMPLOYEE' && $search_user_id != '') {
    $search_emp_details = $employee->get_employee_detail($search_user_id);

    if(!empty($search_emp_details)){
        $list_customers = array();
        $search_user_name = $_SESSION['company_sort_by'] == 2 ? $search_emp_details['last_name'] . " " . $search_emp_details['first_name'] : $search_emp_details['first_name'] . " " . $search_emp_details['last_name'];
        $sel_employee = $search_user_id;

        $list_customers = $employee->get_customers_with_tt_connected_previous($sel_employee, $selected_year, $selected_month);
        $list_customers = filter_customer_list_by_employee_have_work($employee, $list_customers, $sel_employee, $selected_year, $selected_month, $search_cust_ids);
        $total_records_count_including_connected = count($list_customers);
        $total_records_count = count($list_customers);
        
        if (!empty($list_customers)) {
            $j = 0;
            foreach ($list_customers as $this_customer) {
                $report_list[$j]['employee_uname']  = $sel_employee;
                $report_list[$j]['customer_uname']  = $this_customer['username'];
                $report_list[$j]['employee_name']   = $search_user_name;
                $report_list[$j]['customer_name']   = $_SESSION['company_sort_by'] == 2 ? $this_customer['last_name'] . " " . $this_customer['first_name'] : $this_customer['first_name'] . " " . $this_customer['last_name'];
                
                $employee_signing_details           = $employee->get_signin_details_by_employee_customer($selected_year, $selected_month, $sel_employee, $this_customer['username']);
                $employee_signing_details_updated   = new stdClass();
                if(!empty($employee_signing_details)){
                    $employee_signing_details_updated = array(
                        'employee'          => $employee_signing_details[$sel_employee]['employee'],
                        'customer'          => $employee_signing_details[$sel_employee]['customer'],
                        'date'              => $employee_signing_details[$sel_employee]['date'],
                        'signin_employee'   => $employee_signing_details[$sel_employee]['signin_employee'],
                        'signin_tl'         => $employee_signing_details[$sel_employee]['signin_tl'],
                        'signin_sutl'       => $employee_signing_details[$sel_employee]['signin_sutl']
                    );
                }
                else{
                    $employee_signing_details_updated = array(
                        'signin_employee'   => "",
                        'signin_tl'         => "",
                        'signin_sutl'       => ""
                    );
                }
                $report_list[$j]['have_work']       = $this_customer['have_work'] ? TRUE : FALSE;
                // $report_list[$j]['sign_details']    = (!empty($employee_signing_details) ? $employee_signing_details[$sel_employee] : array());
                $report_list[$j]['sign_details']    = $employee_signing_details_updated;
                $report_list[$j]['untreated_leave'] = $obj_leave->check_untreated_employee_leave_in_a_customer($sel_employee, $selected_year, $selected_month, $this_customer['username']);
                $report_list[$j]['untreated_candg'] = $obj_inconv->check_untreated_candg_slots($sel_employee, $this_customer['username'], $selected_month, $selected_year);
                $report_list[$j]['future_slots']    = $employee->check_timeslots_after_timestamp_in_the_month($sel_employee, $this_customer['username'], $selected_month, $selected_year);

                $temp_employee_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($selected_month, $selected_year, $sel_employee, $this_customer['username']);
                $have_fk_slots = FALSE;
                if(!empty($temp_employee_slots)){
                    foreach($temp_employee_slots as $es){
                        if($es['fkkn'] == 1 && $es['status'] == 1){
                            $have_fk_slots = TRUE;
                            break;
                        }
                    }
                }
                $report_list[$j]['allow_ordinary_signing'] = $have_fk_slots && $sel_employee == $login_employee && $login_user_role != 1 ? FALSE : TRUE;

                $employee->username             = $sel_employee;
                $employee->rpt_customer         = $this_customer['username'];
                $employee->signing_report_date  = $selected_year . '-' . $selected_month . '-01';
                $sign_existance_flag            = $employee->employee_signing_existance_check();
                $report_list[$j]['sign_status'] = $sign_existance_flag; //0 - FALSE, 1 - TRUE, 2 - BOTH

                $is_able_to_sign = FALSE;
                if((empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$sel_employee]['signin_employee'] == '') && $sel_employee == $_SESSION['user_id'])
                    $is_able_to_sign = TRUE;
                else if($sel_employee != $_SESSION['user_id'] && !empty($employee_signing_details) && (trim($employee_signing_details[$sel_employee]['signin_tl']) == '' || trim($employee_signing_details[$sel_employee]['signin_sutl']) == ''))
                    $is_able_to_sign = TRUE;
                $report_list[$j]['is_able_to_sign'] = $is_able_to_sign;

                $j++;
            }
        }

        if (!empty($report_list)) {
            foreach ($report_list as $key => $record) {
                $obj_inconv->reset_inconvenient_variables();
                $obj_inconv->generate_work_report($record['employee_uname'], $selected_month, $selected_year, $record['customer_uname']);
                $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                        array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby) + array_sum($obj_inconv->sum_dismissal);;

               // $sum_personal = $obj_inconv->sum_personal;
                unset($obj_inconv->sum_normal['Ord. tid']);
                unset($obj_inconv->sum_travel['travel']);
                unset($obj_inconv->sum_break['break']);
                unset($obj_inconv->sum_over['overtime']);
                unset($obj_inconv->sum_quality['qual_overtime']);
                unset($obj_inconv->sum_more['more_time']);
                unset($obj_inconv->sum_some['some_other_time']);
                unset($obj_inconv->sum_training['training']);
                unset($obj_inconv->sum_voluntary['voluntary']);
                unset($obj_inconv->sum_complementary['complementary']);
                unset($obj_inconv->sum_standby['standby']);
                
                
                $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall);
                $sum_total_inconv = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                        array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby);
                $sum_total_leave = array_sum($obj_inconv->sum_leave_normal) + array_sum($obj_inconv->sum_leave_travel) + array_sum($obj_inconv->sum_leave_break) + array_sum($obj_inconv->sum_leave_over) + array_sum($obj_inconv->sum_leave_quality) +
                        array_sum($obj_inconv->sum_leave_more) + array_sum($obj_inconv->sum_leave_some) + array_sum($obj_inconv->sum_leave_training) + array_sum($obj_inconv->sum_leave_voluntary) + array_sum($obj_inconv->sum_leave_standby)+
                        array_sum($obj_inconv->sum_leave_oncall) + array_sum($obj_inconv->sum_leave_calltraining) + array_sum($obj_inconv->sum_leave_more_oncall);        
                
                $report_list[$key]['work_hours'] = array(
                    'total_normal'      => number_format($sum_total_normal- $sum_total_inconv, 2, '.', ''),
                    'total_oncall'      => number_format($sum_total_oncall, 2, '.', ''),
                    'total'             => number_format($sum_total_normal + $sum_total_oncall, 2, '.', ''),
                    'total_working_days'=> count($obj_inconv->days_in_month),
                    'total_leave'       => number_format($sum_total_leave, 2, '.', ''),
                    'total_inconv'      => number_format($sum_total_inconv, 2 , '.', ''));
            }
        }
    }
}

elseif ($search_mode == 'CUSTOMER' && $search_customer_id != '') {
    $search_cust_details = $customer->customer_detail($search_customer_id);
    if(!empty($search_cust_details)) {
        $list_employees = array();
        $search_user_name = $_SESSION['company_sort_by'] == 2 ? $search_cust_details['last_name'] . " " . $search_cust_details['first_name'] : $search_cust_details['first_name'] . " " . $search_cust_details['last_name'];
        $sel_customer = $search_customer_id;
    
        $list_employees = $employee->team_members_with_tt_connected_employees($sel_customer, $selected_year, $selected_month);
        $list_employees = filter_employee_list_by_employee_have_work($employee, $list_employees, $selected_year, $selected_month, $sel_customer, $search_emp_ids);
        $total_records_count_including_connected = count($list_employees);
        $total_records_count = count($list_employees);

        if(!empty($list_employees)){
            $j = 0;
            foreach ($list_employees as $employees) {
                $report_list[$j]['employee_uname']  = $employees['username'];
                $report_list[$j]['customer_uname']  = $sel_customer;
                $report_list[$j]['customer_name']   = $search_user_name;
                $report_list[$j]['employee_name']   = $_SESSION['company_sort_by'] == 2 ? $employees['last_name'] . " " . $employees['first_name'] : $employees['first_name'] . " " . $employees['last_name'];

                $employee_signing_details           = $employee->get_signin_details_by_employee_customer($selected_year, $selected_month, $employees['username'], $sel_customer);
                $employee_signing_details_updated   = new stdClass();
                if(!empty($employee_signing_details)){
                    $employee_signing_details_updated = array(
                        'employee'          => $employee_signing_details[$employees['username']]['employee'],
                        'customer'          => $employee_signing_details[$employees['username']]['customer'],
                        'date'              => $employee_signing_details[$employees['username']]['date'],
                        'signin_employee'   => $employee_signing_details[$employees['username']]['signin_employee'],
                        'signin_tl'         => $employee_signing_details[$employees['username']]['signin_tl'],
                        'signin_sutl'       => $employee_signing_details[$employees['username']]['signin_sutl']
                    );
                }
                else{
                    $employee_signing_details_updated = array(
                        'signin_employee'   => "",
                        'signin_tl'         => "",
                        'signin_sutl'       => ""
                    );
                }
                $report_list[$j]['have_work']       = $employees['have_work'] ? TRUE : FALSE;
                // $report_list[$j]['sign_details']    = (!empty($employee_signing_details) ? $employee_signing_details[$employees['username']] : array());
                $report_list[$j]['sign_details']    = $employee_signing_details_updated;
                $report_list[$j]['untreated_leave'] = $obj_leave->check_untreated_employee_leave_in_a_customer($employees['username'], $selected_year, $selected_month, $sel_customer);
                $report_list[$j]['untreated_candg'] = $obj_inconv->check_untreated_candg_slots($employees['username'], $sel_customer, $selected_month, $selected_year);
                $report_list[$j]['future_slots']    = $employee->check_timeslots_after_timestamp_in_the_month($employees['username'], $sel_customer, $selected_month, $selected_year);

                $temp_employee_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($selected_month, $selected_year, $employees['username'], $sel_customer);
                $have_fk_slots = FALSE;
                if(!empty($temp_employee_slots)){
                    foreach($temp_employee_slots as $es){
                        if($es['fkkn'] == 1 && $es['status'] == 1){
                            $have_fk_slots = TRUE;
                            break;
                        }
                    }
                }
                $report_list[$j]['allow_ordinary_signing'] = $have_fk_slots && $employees['username'] == $login_employee && $login_user_role != 1 ? FALSE : TRUE;

                $employee->username             = $employees['username'];
                $employee->rpt_customer         = $sel_customer;
                $employee->signing_report_date  = $selected_year . '-' . $selected_month . '-01';
                $sign_existance_flag            = $employee->employee_signing_existance_check();
                $report_list[$j]['sign_status'] = $sign_existance_flag; //0 - FALSE, 1 - TRUE, 2 - BOTH

                $is_able_to_sign = FALSE;
                if((empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$employees['username']]['signin_employee'] == '') && $employees['username'] == $_SESSION['user_id'])
                    $is_able_to_sign = TRUE;
                else if($employees['username'] != $_SESSION['user_id'] && !empty($employee_signing_details) && (trim($employee_signing_details[$employees['username']]['signin_tl']) == '' || trim($employee_signing_details[$employees['username']]['signin_sutl']) == ''))
                    $is_able_to_sign = TRUE;
                $report_list[$j]['is_able_to_sign'] = $is_able_to_sign;

                $j++;
            }
        }
        
        if (!empty($report_list)) {
            foreach ($report_list as $key => $record) {
                $obj_inconv->reset_inconvenient_variables();
                $obj_inconv->generate_work_report($record['employee_uname'], $selected_month, $selected_year, $record['customer_uname']);
                $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                        array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby) + array_sum($obj_inconv->sum_dismissal);;

               // $sum_personal = $obj_inconv->sum_personal;
                unset($obj_inconv->sum_normal['Ord. tid']);
                unset($obj_inconv->sum_travel['travel']);
                unset($obj_inconv->sum_break['break']);
                unset($obj_inconv->sum_over['overtime']);
                unset($obj_inconv->sum_quality['qual_overtime']);
                unset($obj_inconv->sum_more['more_time']);
                unset($obj_inconv->sum_some['some_other_time']);
                unset($obj_inconv->sum_training['training']);
                unset($obj_inconv->sum_voluntary['voluntary']);
                unset($obj_inconv->sum_complementary['complementary']);
                unset($obj_inconv->sum_standby['standby']);
                
                
                $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall);
                $sum_total_inconv = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                        array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby);
                $sum_total_leave = array_sum($obj_inconv->sum_leave_normal) + array_sum($obj_inconv->sum_leave_travel) + array_sum($obj_inconv->sum_leave_break) + array_sum($obj_inconv->sum_leave_over) + array_sum($obj_inconv->sum_leave_quality) +
                        array_sum($obj_inconv->sum_leave_more) + array_sum($obj_inconv->sum_leave_some) + array_sum($obj_inconv->sum_leave_training) + array_sum($obj_inconv->sum_leave_voluntary) + array_sum($obj_inconv->sum_leave_standby)+
                        array_sum($obj_inconv->sum_leave_oncall) + array_sum($obj_inconv->sum_leave_calltraining) + array_sum($obj_inconv->sum_leave_more_oncall);        
                
                $report_list[$key]['work_hours'] = array(
                    'total_normal'      => number_format($sum_total_normal- $sum_total_inconv, 2, '.', ''),
                    'total_oncall'      => number_format($sum_total_oncall, 2, '.', ''),
                    'total'             => number_format($sum_total_normal + $sum_total_oncall, 2, '.', ''),
                    'total_working_days'=> count($obj_inconv->days_in_month),
                    'total_leave'       => number_format($sum_total_leave, 2, '.', ''),
                    'total_inconv'      => number_format($sum_total_inconv, 2 , '.', ''));
            }
        }
    }
}

elseif ($search_mode == 'UNSIGNED') {
    $obj_rpt_signing        = new report_signing();
    $not_signed_employees__ = $obj_rpt_signing->get_unsigned_employees($selected_year, $selected_month);
    $not_signed_employees__ = filter_customer_employees_list_by_employee_have_work($not_signed_employees__, $search_cust_ids, $search_emp_ids);
    $total_records_count    = count($not_signed_employees__);

    $start_index            = isset($_REQUEST['start_index']) && trim($_REQUEST['start_index']) != '' ? trim($_REQUEST['start_index']) : 0;
    $result_length          = isset($_REQUEST['result_length']) && trim($_REQUEST['result_length']) != '' ? trim($_REQUEST['result_length']) : 15;

    $result_end_index       = $start_index + $result_length - 1;
    // $not_signed_employee = 0;
    // $not_signed_gl=0;
    // $not_signed_admin = 0;
    if(!empty($not_signed_employees__)){
        $j = 0;
        $pagination_counter = -1;
        $proposed_sign_date = date('Y-m-d', strtotime("$selected_year-$selected_month-01"));
        foreach ($not_signed_employees__ as $key => $not_signed_emp) {

            $pagination_counter++;
            if(!($pagination_counter >= $start_index && $pagination_counter <= $result_end_index)) continue;

            // if($not_signed_emp['signin_employee'] == '') $not_signed_employee++;
            // if($not_signed_emp['signin_tl'] == '') $not_signed_gl++;
            // if($not_signed_emp['signin_sutl'] == '') $not_signed_admin++;

            $report_list[$j]['employee_uname']  = $not_signed_emp['employee'];
            $report_list[$j]['customer_uname']  = $not_signed_emp['customer'];
            $report_list[$j]['employee_name']   = $_SESSION['company_sort_by'] == 2 ? $not_signed_emp['employee_lname'] . " " . $not_signed_emp['employee_fname'] : $not_signed_emp['employee_fname'] . " " . $not_signed_emp['employee_lname'];
            $report_list[$j]['customer_name']   = $_SESSION['company_sort_by'] == 2 ? $not_signed_emp['customer_lname'] . " " . $not_signed_emp['customer_fname'] : $not_signed_emp['customer_fname'] . " " . $not_signed_emp['customer_lname'];

            $employee_signing_details_updated = array(
                'employee'          => $not_signed_emp['employee'],
                'customer'          => $not_signed_emp['customer'],
                'date'              => $proposed_sign_date,
                'signin_employee'   => $not_signed_emp['signin_employee'] != '' ? $not_signed_emp['signin_employee'] : "",
                'signin_tl'         => $not_signed_emp['signin_tl'] != '' ? $not_signed_emp['signin_tl'] : "",
                'signin_sutl'       => $not_signed_emp['signin_sutl'] != '' ? $not_signed_emp['signin_sutl'] : ""
            );

            $report_list[$j]['have_work']       = TRUE;
            $report_list[$j]['sign_details']    = $employee_signing_details_updated;
            $report_list[$j]['untreated_leave'] = $obj_leave->check_untreated_employee_leave_in_a_customer($not_signed_emp['employee'], $selected_year, $selected_month, $not_signed_emp['customer']);
            $report_list[$j]['untreated_candg'] = $obj_inconv->check_untreated_candg_slots($not_signed_emp['employee'], $not_signed_emp['customer'], $selected_month, $selected_year);
            $report_list[$j]['future_slots']    = $employee->check_timeslots_after_timestamp_in_the_month($not_signed_emp['employee'], $not_signed_emp['customer'], $selected_month, $selected_year);

            $temp_employee_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($selected_month, $selected_year, $not_signed_emp['employee'], $not_signed_emp['customer']);
            $have_fk_slots = FALSE;
            if(!empty($temp_employee_slots)){
                foreach($temp_employee_slots as $es){
                    if($es['fkkn'] == 1 && $es['status'] == 1){
                        $have_fk_slots = TRUE;
                        break;
                    }
                }
            }
            $report_list[$j]['allow_ordinary_signing'] = $have_fk_slots && $not_signed_emp['employee'] == $login_employee && $login_user_role != 1 ? FALSE : TRUE;
                
            $employee->username             = $not_signed_emp['employee'];
            $employee->rpt_customer         = $not_signed_emp['customer'];
            $employee->signing_report_date  = $selected_year . '-' . $selected_month . '-01';
            $sign_existance_flag            = $employee->employee_signing_existance_check();
            $report_list[$j]['sign_status'] = $sign_existance_flag; //0 - FALSE, 1 - TRUE, 2 - BOTH
            
            $is_able_to_sign = FALSE;
            if($employee_signing_details_updated['signin_employee'] == '' && $not_signed_emp['employee'] == $_SESSION['user_id'])
                $is_able_to_sign = TRUE;
            else if($not_signed_emp['employee'] != $_SESSION['user_id'] && (trim($employee_signing_details_updated['signin_tl']) == '' || trim($employee_signing_details_updated['signin_sutl']) == ''))
                $is_able_to_sign = TRUE;
            $report_list[$j]['is_able_to_sign'] = $is_able_to_sign;

            $j++;
            if($j >= $result_length) break;
        }
    }
    
    if (!empty($report_list)) {
        foreach ($report_list as $key => $record) {
            $obj_inconv->reset_inconvenient_variables();
            $obj_inconv->generate_work_report($record['employee_uname'], $selected_month, $selected_year, $record['customer_uname']);
            $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                    array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby) + array_sum($obj_inconv->sum_dismissal);;

           // $sum_personal = $obj_inconv->sum_personal;
            unset($obj_inconv->sum_normal['Ord. tid']);
            unset($obj_inconv->sum_travel['travel']);
            unset($obj_inconv->sum_break['break']);
            unset($obj_inconv->sum_over['overtime']);
            unset($obj_inconv->sum_quality['qual_overtime']);
            unset($obj_inconv->sum_more['more_time']);
            unset($obj_inconv->sum_some['some_other_time']);
            unset($obj_inconv->sum_training['training']);
            unset($obj_inconv->sum_voluntary['voluntary']);
            unset($obj_inconv->sum_complementary['complementary']);
            unset($obj_inconv->sum_standby['standby']);
            
            
            $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall);
            $sum_total_inconv = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                    array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby);
            $sum_total_leave = array_sum($obj_inconv->sum_leave_normal) + array_sum($obj_inconv->sum_leave_travel) + array_sum($obj_inconv->sum_leave_break) + array_sum($obj_inconv->sum_leave_over) + array_sum($obj_inconv->sum_leave_quality) +
                    array_sum($obj_inconv->sum_leave_more) + array_sum($obj_inconv->sum_leave_some) + array_sum($obj_inconv->sum_leave_training) + array_sum($obj_inconv->sum_leave_voluntary) + array_sum($obj_inconv->sum_leave_standby)+
                    array_sum($obj_inconv->sum_leave_oncall) + array_sum($obj_inconv->sum_leave_calltraining) + array_sum($obj_inconv->sum_leave_more_oncall);        
            
            $report_list[$key]['work_hours'] = array(
                'total_normal'      => number_format($sum_total_normal- $sum_total_inconv, 2, '.', ''),
                'total_oncall'      => number_format($sum_total_oncall, 2, '.', ''),
                'total'             => number_format($sum_total_normal + $sum_total_oncall, 2, '.', ''),
                'total_working_days'=> count($obj_inconv->days_in_month),
                'total_leave'       => number_format($sum_total_leave, 2, '.', ''),
                'total_inconv'      => number_format($sum_total_inconv, 2 , '.', ''));
        }
    }
    
}

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $report_list;
echo json_encode($main_obj);

function filter_customer_list_by_employee_have_work($obj_emp, $customer_list, $sel_employee, $year, $month = NULL, $allowed_customers = array()){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
    if (!empty($customer_list)){
        foreach ($customer_list as $key => $this_customer) {
            if(!in_array($this_customer['username'], $allowed_customers)){
                unset($customer_list[$key]);
                continue;
            }
            $employee_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($sel_employee, $month, $year, $this_customer['username']);
            $customer_list[$key]['have_work'] = (!empty($employee_work_details) ? 1 : 0);
            $work_flag = !empty($employee_work_details) ? TRUE : FALSE;
            if (!$work_flag)
                unset($customer_list[$key]);
        }
        $customer_list = array_values($customer_list);      //for reindexing array
    }
    return $customer_list;
}
function filter_employee_list_by_employee_have_work($obj_emp, $employee_list, $year, $month = NULL, $sel_customer = NULL, $allowed_employees = array()){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
    if (!empty($employee_list)){
        foreach ($employee_list as $key => $employees) {
            if(!in_array($employees['username'], $allowed_employees)){
                unset($employee_list[$key]);
                continue;
            }
            $employee_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($employees['username'], $month, $year, $sel_customer);
            $employee_list[$key]['have_work'] = (!empty($employee_work_details) ? 1 : 0);
            $work_flag = !empty($employee_work_details) ? TRUE : FALSE;
            if (!$work_flag)
                unset($employee_list[$key]);
        }
        $employee_list = array_values($employee_list);      //for reindexing array
    }
    return $employee_list;
}
function filter_customer_employees_list_by_employee_have_work($not_signed_employees, $allowed_customers = array(), $allowed_employees= array()){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
    if (!empty($not_signed_employees)){
        foreach ($not_signed_employees as $key => $not_signed_data) {
            if(!in_array($not_signed_data['employee'], $allowed_employees) || !in_array($not_signed_data['customer'], $allowed_customers)){
                unset($not_signed_employees[$key]);
                continue;
            }
        }
        $not_signed_employees = array_values($not_signed_employees);      //for reindexing array
    }
    return $not_signed_employees;
}
?>