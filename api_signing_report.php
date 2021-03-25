<?php

/*
 * Author: Shaju
 * Date: 2014-02-21
 * Purpose: to get the report signing details
 * 
 */
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/inconvenient.php');
require_once('class/leave.php');


$user = new user();
$employee = new employee();
$customer = new customer();
$obj_inconv = new inconvenient();
$obj_leave = new leave();

$login_employee = $_REQUEST['user'];
$search_user_id = $_REQUEST['employee'];
$selected_year = $_REQUEST['year'];
$selected_month = $_REQUEST['month'];

$search_emp_details = $employee->get_employee_detail($search_user_id);
$search_cust_ids = $search_emp_ids = array();
$search_customers = $customer->customers_list_for_employee_report(-1, $login_employee);
$search_employees = $employee->employees_list_for_right_click($search_user_id, -1, $login_employee);

if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}

if (empty($search_emp_details)) {
    $search_user_id = '';
} else {
    $list_customers = array();
    $search_user_name = $search_emp_details['last_name'] . " " . $search_emp_details['first_name'];
    $sel_employee = $search_user_id;

    /* if($flag_show_previous_connections == 'Y'){
      $list_customers = $employee->get_customers_with_tt_connected_previous($sel_employee, $selected_year, $selected_month, $sort_charecter);
      }else
      $list_customers = $employee->get_team_customers_of_employee($sel_employee,$sort_charecter); */

    //if $flag_show_previous_connections == 'Y'  => get all connected customers
    $list_customers = $employee->get_customers_with_tt_connected_previous($sel_employee, $selected_year, $selected_month, $sort_charecter);
    $list_customers = filter_customer_list_by_employee_have_work($employee, $list_customers, $sel_employee, $selected_year, $selected_month, $search_cust_ids);
    $total_records_count_including_connected = count($list_customers);

//    if ($flag_show_previous_connections != 'Y') {
//        $list_customers = $employee->get_team_customers_of_employee($sel_employee, $sort_charecter);
//        $list_customers = filter_customer_list_by_employee_have_work($employee, $list_customers, $sel_employee, $selected_year, $selected_month, $search_cust_ids);
//    }

    $total_records_count = count($list_customers);
    
    
//    if (!empty($list_customers))
//        $list_customers = $pagination->generate($list_customers, 10);
//
//    if ($sort_charecter != NULL)
//        $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/' . $selected_year . '/' . $selected_month_pg_label . '/2/' . $sel_employee . '/' . $flag_show_previous_connections . '/' . $sort_charecter . '/'));
//    else
//        $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/' . $selected_year . '/' . $selected_month_pg_label . '/2/' . $sel_employee . '/' . $flag_show_previous_connections . '/'));

    
    if (!empty($list_customers)) {
        $j = 0;
        foreach ($list_customers as $this_customer) {
            $report_list[$j]['username'] = $this_customer['username'];
            $report_list[$j]['first_name'] = $this_customer['first_name'];
            $report_list[$j]['last_name'] = $this_customer['last_name'];
            
            $employee_signing_details = $employee->get_signin_details_by_employee_customer($selected_year, $selected_month, $sel_employee, $this_customer['username']);
            $report_list[$j]['have_work'][$selected_month] = $this_customer['have_work'][$selected_month];
            $report_list[$j]['Sign_details'] = (!empty($employee_signing_details) ? $employee_signing_details[$sel_employee] : array());
            $report_list[$j]['untreated'] = $obj_leave->check_untreated_employee_leave_in_a_customer($sel_employee, $selected_year, $selected_month, $this_customer['username']);
            $j++;
        }
    }

    if (!empty($report_list) && $selected_month != NULL) {
        foreach ($report_list as $key => $record) {
            $obj_inconv->reset_inconvenient_variables();
            $obj_inconv->generate_work_report($sel_employee, $selected_month, $selected_year, $record['username']);
            $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                    array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary);

//                    $sum_personal = $obj_inconv->sum_personal;
            $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall);
            $report_list[$key]['work_hours'] = array('total_normal' => round($sum_total_normal, 2),
                'total_oncall' => round($sum_total_oncall, 2),
                'total' => round($sum_total_normal + $sum_total_oncall, 2));
        }
    }
}

//echo "<pre>".print_r($report_list, 1)."</pre>";


header("content-type: text/javascript");
echo $data = $_GET['callback'] . '(' . json_encode($report_list) . ');';


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
            $work_flag = FALSE;
            if($month == NULL){
                for ($i = 1; $i <= 12; $i++) {
                    $employee_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($sel_employee, $i, $year, $this_customer['username']);
                    $customer_list[$key]['have_work'][$i] = (!empty($employee_work_details) ? 1 : 0);
                    if (!empty($employee_work_details)){
                        $work_flag = TRUE;
//                        break;
                    }
                }
            } else {
                $employee_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($sel_employee, $month, $year, $this_customer['username']);
                $customer_list[$key]['have_work'][$month] = (!empty($employee_work_details) ? 1 : 0);
                if (!empty($employee_work_details))
                    $work_flag = TRUE;
            }
            if (!$work_flag)
                unset($customer_list[$key]);
        }
        $customer_list = array_values($customer_list);      //for reindexing array
    }
    return $customer_list;
}
?>
