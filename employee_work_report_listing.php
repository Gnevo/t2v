<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/report_signing.php');
require_once('configs/config.inc.php');
require_once('plugins/pagination.class.php');
require_once('class/inconvenient.php');
//require_once('class/contract.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml"));
$pagination = new pagination();
$customer = new customer();
$employee = new employee();
$obj_inconv = new inconvenient();
//$obj_contract = new contract();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
global $month;
if($_SESSION['url_back_back'] != ''){
    $_SESSION['url_back_back']= '';
    unset($_SESSION['url_back_back']);
}
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$years_combo = $employee->distinct_years('all_year');
$smarty->assign("year_option_values", $years_combo);
$month_num = $month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output_short", $month_name_short);
$smarty->assign("month_option_output_full", $month_name_full);


//$search_customers = $customer->customer_list();
//$search_employees = $employee->employee_list();
//$search_customers = $customer->customers_list_for_employee_report(-1);
//$search_employees = $employee->employees_list_for_right_click($_SESSION['user_id'], -1);

//Only gets active customers and employees
$search_customers = $customer->customers_list_for_employee_report();
$search_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);
$smarty->assign('search_customers', $search_customers);
$smarty->assign('search_employees', $search_employees);

$search_cust_ids = $search_emp_ids = array();
if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}
//echo "<pre>".print_r($search_cust_ids, 1)."</pre>";
//echo "<pre>".print_r($search_emp_ids, 1)."</pre>";


$search_customers_incl_inactive = $customer->customers_list_for_employee_report(-1);
$search_employees_incl_inactive = $employee->employees_list_for_right_click($_SESSION['user_id'], -1);
$search_cust_ids_incl_inactive = $search_emp_ids_incl_inactive = array();
if(!empty($search_customers_incl_inactive)){
    foreach($search_customers_incl_inactive as $this_customer)
        $search_cust_ids_incl_inactive[] = $this_customer['username'];
}
if(!empty($search_employees_incl_inactive)){
    foreach($search_employees_incl_inactive as $this_employee)
        $search_emp_ids_incl_inactive[] = $this_employee['username'];
}

$params = explode('&', $_SERVER['QUERY_STRING']);

$params_count = count($params);
/**
 * parameters order-old: Year/M-monthNo/customer/priv_emp_flag/Sort_ch/page_no/
 * parameters order-old: Year/M-monthNo/cust_emp_flag/empId_or_customerId/privEmpFlag_privCustFlag/Sort_ch/page_no/
 * 
 * Maximum parameters example: 
 *          customer: http://192.168.0.234/works/app/t2v/cirrus/report/work/employee/list/2013/M-11/1/cybr001/Y/
 *          employee: http://192.168.0.234/works/app/t2v/cirrus/report/work/employee/list/2013/M-11/2/maaa001/Y/
 *          unsigned: http://192.168.0.234/works/app/t2v/cirrus/report/work/employee/list/2013/M-11/3/
 * 
 * @param Year : year for listing
 * @param M-monthNo : month for listing (either NULL or month number)
 *                  format: M-monthNo
 * @param cust_emp_flag : search flag (either employee or customer)
 *                  values: 1-customer, 2 - employee, 3 - unsigned employees
 * @param empId_or_customerId : search user id (either employeeid or customer id related to @param cust_emp_flag)
 * @param privEmpFlag_privCustFlag : flag refers show previously connected employees / customers (related to @param cust_emp_flag)
 *                  values: Y, N
 * @param Sort_ch : sort charecter (alphabet charecters)
 * @param page_no : pagination page number
 */

//echo "<pre>".print_r($params, 1)."</pre>";
//$selected_year = isset($_POST['cmb_year'])?$_POST['cmb_year']:(in_array(date('Y'),$years_combo)?date('Y'):'');
$selected_year = trim($params[0]) ? trim($params[0]) : (in_array(date('Y'),$years_combo) ? date('Y') : '');
//$selected_month = in_array(trim($params[1]), $month_num) ? trim($params[1]) : NULL;
$selected_month = trim($params[1]);
if(!is_numeric($selected_month) && $selected_month != ''){
    $split_month_string = explode('-', $selected_month);
    $selected_month = (count($split_month_string) > 1) ? $split_month_string[1] : NULL;
} else
    $selected_month = NULL;
$selected_month_pg_label = 'M-'. ($selected_month != NULL ? $selected_month : '');

$search_type = '';
if(trim($params[2]) == 1) $search_type = 'customer';
else if(trim($params[2]) == 2) $search_type = 'employee';
else if(trim($params[2]) == 3) $search_type = 'unsigned';
else $search_type = 'employee';

//$search_type = (trim($params[2]) == 1 ? 'customer' : 'employee');
$search_user_id = trim($params[3]);
if($_SESSION['user_role'] == 3 && $search_user_id == '' && $search_type == 'employee')  //by default, select the login employee
    $search_user_id = $_SESSION['user_id'];

// $flag_show_previous_connections = (trim($params[4]) == 'Y' ? 'Y' : 'N');
$flag_show_previous_connections = (trim($params[4]) == 'N' ? 'N' : 'Y');
$sort_charecter = ($params_count > 5 && !is_numeric($params[5]) ? trim($params[5]) : NULL);
$page_number = 1;
if($params_count == 6 && is_numeric($params[6]))
    $page_number = trim($params[6]);
else if($params_count == 7 && is_numeric($params[7]))
    $page_number = trim($params[7]);

$total_records_count = 0;
$search_user_name = '';
$report_list = array();
$request_access = ($params_count > 2 ? TRUE : FALSE);    //for checking if page is in first load mode or requested with params

$total_records_count_including_connected = 0;
if ($params_count > 0) 
{
    
    /*if($search_type == 'customer' || $search_type == 'employee'){
        //find total working days in this month
        $this_month_working_days = 0;
        if($selected_month != NULL && $selected_year != NULL){
            $month_start_date = date("Y-m-01", strtotime($selected_year.'-'.$selected_month.'-01'));
            $month_end_date = date("Y-m-t", strtotime($month_start_date));
            $this_month_working_days = $obj_contract->get_working_days($month_start_date, $month_end_date);
        }
        $smarty->assign('this_month_working_days', $this_month_working_days);
    }*/

    if($search_type == 'customer'){
        $search_cust_details = $customer->customer_detail($search_user_id);
        if(empty($search_cust_details)){
            $search_user_id = '';
        } else {
            $list_employees   = array();
            $search_user_name = $search_cust_details['last_name']. " " . $search_cust_details['first_name'];
            $sel_customer     = $search_user_id;
            
           
            /*if($flag_show_previous_connections == 'Y'){
            //            $list_employees_prev = $employee->get_employees_worked_under_customer($sel_customer, $selected_year, NULL, NULL, $sort_charecter);
                $list_employees = $employee->team_members_with_tt_connected_employees($sel_customer, $selected_year, $selected_month, $sort_charecter);
            }else 
                $list_employees = $employee->team_members_for_employee_detailed_report($sel_customer,$sort_charecter);*/
            
            //if $flag_show_previous_connections == 'Y'  => get all connected employees
            $list_employees = $employee->team_members_with_tt_connected_employees($sel_customer, $selected_year, $selected_month, $sort_charecter);
            $list_employees = filter_employee_list_by_employee_have_work($employee, $list_employees, $selected_year, $selected_month, $sel_customer, $search_emp_ids, $flag_show_previous_connections);
            
            $total_records_count_including_connected = count($list_employees);

            if($flag_show_previous_connections != 'Y'){
                $list_employees = $employee->team_members_for_employee_detailed_report($sel_customer,$sort_charecter);
                $list_employees = filter_employee_list_by_employee_have_work($employee, $list_employees, $selected_year, $selected_month, $sel_customer, $search_emp_ids, $flag_show_previous_connections);
            }
            $total_records_count = count($list_employees);
            if(!empty($list_employees))
                $list_employees = $pagination->generate($list_employees, 10);

            if ($sort_charecter != NULL) 
                $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/1/'.$sel_customer.'/'.$flag_show_previous_connections.'/'.$sort_charecter.'/'));
            else
                $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/1/'.$sel_customer.'/'.$flag_show_previous_connections.'/'));
            if(!empty($list_employees)){
                $j = 0;
                foreach ($list_employees as $employees) {
                    $report_list[$j]['username'] = $employees['username'];
                    $report_list[$j]['first_name'] = $employees['first_name'];
                    $report_list[$j]['last_name'] = $employees['last_name'];
                    if($selected_month == NULL){
                        for ($i = 1; $i <= 12; $i++) {
                            $employee_signing_details = $employee->get_signin_details_by_employee_customer($selected_year, $i, $employees['username'], $sel_customer);
                //            $employee_work_details = $employee->get_all_work_details_include_normal_nd_leave($employees['username'], $i, $selected_year, $sel_customer);
                //            $report_list[$j]['have_work'][$i] = (!empty($employee_work_details) ? 1 : 0);
                            $report_list[$j]['have_work'][$i] = $employees['have_work'][$i];
                            $report_list[$j]['Sign_details'][$i] = (!empty($employee_signing_details) ? $employee_signing_details[$employees['username']] : array());
                        }
                    }
                    else {
                        $employee_signing_details = $employee->get_signin_details_by_employee_customer($selected_year, $selected_month, $employees['username'], $sel_customer);
                        $report_list[$j]['have_work'][$selected_month] = $employees['have_work'][$selected_month];
                        $report_list[$j]['Sign_details'][$selected_month] = (!empty($employee_signing_details) ? $employee_signing_details[$employees['username']] : array());
                    }
                    $j++;
                }
            }
            
            if(!empty($report_list) && $selected_month != NULL){
                foreach ($report_list as $key => $record) {
                    $obj_inconv->reset_inconvenient_variables();
                    $obj_inconv->generate_work_report($record['username'], $selected_month, $selected_year, $sel_customer);
                    $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                            array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby);
            //                    $sum_personal = $obj_inconv->sum_personal;
                    $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall);
                    
                    $report_list[$key]['work_hours'] = array(   'total_working_days'  => count($obj_inconv->days_in_month),
                                                                'total_normal'  => round($sum_total_normal, 2),
                                                                'total_oncall'  => round($sum_total_oncall, 2),
                                                                'total'         => round($sum_total_normal+$sum_total_oncall, 2));
                }
            }
        }
    }
    else if($search_type == 'employee'){
        
        $search_emp_details = $employee->get_employee_detail($search_user_id);
        if(empty($search_emp_details)){
            $search_user_id = '';
        } else {
            $list_customers = array();
            $search_user_name = $search_emp_details['last_name']. " " . $search_emp_details['first_name'];
            $sel_employee = $search_user_id;
        
            /*if($flag_show_previous_connections == 'Y'){
                $list_customers = $employee->get_customers_with_tt_connected_previous($sel_employee, $selected_year, $selected_month, $sort_charecter);
            }else 
                $list_customers = $employee->get_team_customers_of_employee($sel_employee,$sort_charecter);*/
            
            //if $flag_show_previous_connections == 'Y'  => get all connected customers
            $list_customers = $employee->get_customers_with_tt_connected_previous($sel_employee, $selected_year, $selected_month, $sort_charecter);
            
           
            // if($_SESSION['user_id'] == 'igro001'){
            //     echo "<pre>".print_r($list_customers, 1)."</pre>";
            // }
            $list_customers = filter_customer_list_by_employee_have_work($employee, $list_customers, $sel_employee, $selected_year, $selected_month, $search_cust_ids, $flag_show_previous_connections);
            $total_records_count_including_connected = count($list_customers);
            


            if($flag_show_previous_connections != 'Y'){
                $list_customers = $employee->get_team_customers_of_employee($sel_employee,$sort_charecter);
                $list_customers = filter_customer_list_by_employee_have_work($employee, $list_customers, $sel_employee, $selected_year, $selected_month, $search_cust_ids, $flag_show_previous_connections);
            }
            
            $total_records_count = count($list_customers);
            if(!empty($list_customers))
                $list_customers = $pagination->generate($list_customers, 10);

            if ($sort_charecter != NULL) 
                $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/2/'.$sel_employee.'/'.$flag_show_previous_connections.'/'.$sort_charecter.'/'));
            else
                $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/2/'.$sel_employee.'/'.$flag_show_previous_connections.'/'));
            
            if(!empty($list_customers)){
                $j = 0;
                //echo "<pre>".print_r($list_customers,1)."</pre>";
                foreach ($list_customers as $this_customer) {
                    $report_list[$j]['username']      = $this_customer['username'];
                    $report_list[$j]['first_name']    = $this_customer['first_name'];
                    $report_list[$j]['last_name']     = $this_customer['last_name'];
                    if($selected_month == NULL)
                    {
                        
                        for ($i = 1; $i <= 12; $i++) {
                            $employee_signing_details = $employee->get_signin_details_by_employee_customer($selected_year, $i, $sel_employee, $this_customer['username']);
                            $report_list[$j]['have_work'][$i] = $this_customer['have_work'][$i];
                            $report_list[$j]['Sign_details'][$i] = (!empty($employee_signing_details) ? $employee_signing_details[$sel_employee] : array());
                        }
                    }
                    else 
                    {
                       
                        $employee_signing_details = $employee->get_signin_details_by_employee_customer($selected_year, $selected_month, $sel_employee, $this_customer['username']);
                        
                       
                        $report_list[$j]['have_work'][$selected_month] = $this_customer['have_work'][$selected_month];
                        $report_list[$j]['Sign_details'][$selected_month] = (!empty($employee_signing_details) ? $employee_signing_details[$sel_employee] : array());
                        //$report_list[$j]['Sign_details'][$selected_month] = (!empty($employee_signing_details) ? $employee_signing_details : array());
                    }
                    $j++;
                }
            }
            
            if(!empty($report_list) && $selected_month != NULL){
                foreach ($report_list as $key => $record) {
                    $obj_inconv->reset_inconvenient_variables();
                    $obj_inconv->generate_work_report($sel_employee, $selected_month, $selected_year, $record['username']);
                    $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                            array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby);
                    
                    //                    $sum_personal = $obj_inconv->sum_personal;
                    $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall);
                    $report_list[$key]['work_hours'] = array(   'total_working_days'  => count($obj_inconv->days_in_month),
                                                                'total_normal'  => round($sum_total_normal, 2),
                                                                'total_oncall'  => round($sum_total_oncall, 2),
                                                                'total'         => round($sum_total_normal+$sum_total_oncall, 2));
                }
                //                echo "<pre>".print_r($report_list, 1)."</pre>";
            }
            
                //            $smarty->assign('this_month_working_days', $this_month_working_days);
        }
    }
    else if($search_type == 'unsigned'){
        $obj_rpt_signing        = new report_signing();
        $not_signed_employees__ = $obj_rpt_signing->get_unsigned_employees($selected_year, $selected_month,'',NULL);
        $not_signed_employees   = array();
        // echo "<pre>".print_r($not_signed_employees__, 1)."</pre>"; exit();
        $not_signed_employee = 0;
        $not_signed_gl       = 0;
        $not_signed_admin    = 0;
        if(!empty($not_signed_employees__)){
            foreach ($not_signed_employees__ as $key => $not_signed_emp) {
                if(empty($not_signed_employees[$not_signed_emp['employee']]['employee_details']))
                    $not_signed_employees[$not_signed_emp['employee']]['employee_details'] = array('user_name' => $not_signed_emp['employee'], 'first_name' => $not_signed_emp['employee_fname'], 'last_name' => $not_signed_emp['employee_lname']);
                if($not_signed_emp['signin_employee'] == '')
                    $not_signed_employee++;
                if($not_signed_emp['signin_tl'] == '')
                    $not_signed_gl++;
                if($not_signed_emp['signin_sutl'] == '')
                    $not_signed_admin++;
                
                $not_signed_employees[$not_signed_emp['employee']]['customers'][] = array(
                                    'user_name'         => $not_signed_emp['customer'], 
                                    'first_name'        => $not_signed_emp['customer_fname'], 
                                    'last_name'         => $not_signed_emp['customer_lname'],
                                    'signing_details'   => array(
                                                            'employee'  => $not_signed_emp['signin_employee'],
                                                            'tl'        => $not_signed_emp['signin_tl'],
                                                            'sutl'      => $not_signed_emp['signin_sutl']
                                                        )
                                );
            }
        }
        
        
        
        $list_unsigned_employees = filter_customer_employees_list_by_employee_have_work($not_signed_employees, $search_cust_ids_incl_inactive, $search_emp_ids_incl_inactive);
        $total_records_count = count($list_unsigned_employees);
        if(!empty($list_unsigned_employees))
            $report_list = $pagination->generate($list_unsigned_employees, 10);

        $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/3/-/'));
        //trailing '-' parameter for priventing default pagination
        
        $smarty->assign('not_signed_employee_count',$not_signed_employee);
        $smarty->assign('not_signed_gl_count',$not_signed_gl);
        $smarty->assign('not_signed_admin_count',$not_signed_admin);
    }
    //echo "<pre>".print_r($_SERVER)."</pre>";
    $_SESSION['saved_url'] = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    
}
//without customer name
/*else{
    //parameters order: Year/M-monthNo/Sort_ch/page_no/
    //get with key
    if ($params_count > 2 && !is_numeric($params[2]) && $selected_year != '') {
        $sel_sort_key = trim($params[2]);
        //get all login employee related employees
        $list_employees = $employee->exact_employee_list_for_employee_detailed_report($sel_sort_key);
        //get scheduled employees of this month
        if($selected_month != NULL){
            $scheduled_employees = $employee->get_employees_who_have_employee($selected_year, $selected_month, NULL, $sel_sort_key);
            //filter as mutual employees (to ensure employee view privilege)
            $list_employees = array_uintersect($list_employees, $scheduled_employees, function($value1, $value2) {
                                    return strcmp($value1['username'], $value2['username']);
                                 });
        }
        
        $list_employees = filter_employee_list_by_employee_have_work($employee, $list_employees, $selected_year, $selected_month);
        $total_records_count = count($list_employees);
        if(!empty($list_employees))
                $employee_list = $pagination->generate($list_employees, 10);
        $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/'.$sel_sort_key.'/'));
    } 
    //get withour key
    else if ($selected_year != "") {
        //get all login employee related employees
        $list_employees = $employee->exact_employee_list_for_employee_detailed_report();
        //get scheduled employees of this month
        if($selected_month != NULL){
            $scheduled_employees = $employee->get_employees_who_have_employee($selected_year, $selected_month);
            //filter as mutual employees (to ensure employee view privilege)
            $list_employees = array_uintersect($list_employees, $scheduled_employees, function($value1, $value2) {
                                    return strcmp($value1['username'], $value2['username']);
                                 });
        }
        $list_employees = filter_employee_list_by_employee_have_work($employee, $list_employees, $selected_year, $selected_month);
        $total_records_count = count($list_employees);
        if($params_count == 1)
            $_SERVER['QUERY_STRING'] .= '&1';  //for pagination
        if(!empty($list_employees)){
            $employee_list = $pagination->generate($list_employees, 10);
        }
        
        $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/list/'.$selected_year.'/'.$selected_month_pg_label.'/'));
    }
}*/

$smarty->assign('total_records_count', $total_records_count);
$smarty->assign('total_records_count_including_connected', $total_records_count_including_connected);
$smarty->assign('search_type', $search_type);
$smarty->assign('search_user_id', $search_user_id);
$smarty->assign('search_user_name', $search_user_name);
//$smarty->assign('search_customer_name', $search_customer_name);
$smarty->assign('flag_show_previous_connections', $flag_show_previous_connections);


//echo "<pre>".print_r($report_list, 1)."</pre>"; exit('fdg');
$smarty->assign('list_year', $selected_year);
$smarty->assign("list_month", $selected_month);
$smarty->assign("selected_month_pg_label", $selected_month_pg_label);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));
//echo "<pre>".print_r($report_list, 1)."</pre>";
$smarty->assign('report_list', $report_list);
$smarty->assign('request_access', $request_access);
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->display('extends:layouts/dashboard.tpl|employee_work_report_listing.tpl');


function filter_employee_list_by_employee_have_work($obj_emp, $employee_list, $year, $month = NULL, $sel_customer = NULL, $allowed_employees = array(), $flag_show_previous_ = 'N'){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
    if (!empty($employee_list)){
        foreach ($employee_list as $key => $employees) {
            if($flag_show_previous_ != 'Y' && !in_array($employees['username'], $allowed_employees)){
                unset($employee_list[$key]);
                continue;
            }
            $work_flag = FALSE;
            if($month == NULL){
                for ($i = 1; $i <= 12; $i++) {
                    $employee_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($employees['username'], $i, $year, $sel_customer);
                    $employee_list[$key]['have_work'][$i] = (!empty($employee_work_details) ? 1 : 0);
                    if (!empty($employee_work_details)){
                        $work_flag = TRUE;
                       // break;
                    }
                }
            } else {
                $employee_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($employees['username'], $month, $year, $sel_customer);
                $employee_list[$key]['have_work'][$month] = (!empty($employee_work_details) ? 1 : 0);
                if (!empty($employee_work_details))
                    $work_flag = TRUE;
            }
            if (!$work_flag)
                unset($employee_list[$key]);
        }
        $employee_list = array_values($employee_list);      //for reindexing array
    }
    return $employee_list;
}

function filter_customer_list_by_employee_have_work($obj_emp, $customer_list, $sel_employee, $year, $month = NULL, $allowed_customers = array(), $flag_show_previous_ = 'N'){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
    if (!empty($customer_list)){
        foreach ($customer_list as $key => $this_customer) {
            if($flag_show_previous_ != 'Y' && !in_array($this_customer['username'], $allowed_customers)){
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
                       // break;
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

function filter_customer_employees_list_by_employee_have_work($not_signed_employees, $allowed_customers = array(), $allowed_employees= array()){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
   //echo "<pre>".print_r($not_signed_employees, 1)."</pre>";
    //   echo "<pre>before".print_r(array_keys($not_signed_employees), 1)."</pre>";
    //   echo "<pre>".print_r($allowed_customers, 1)."</pre>";
    //   echo "<pre>".print_r($allowed_employees, 1)."</pre>";
    if (!empty($not_signed_employees)){
        foreach ($not_signed_employees as $this_employee => $not_signed_data) {
            if(!in_array($this_employee, $allowed_employees)){
                unset($not_signed_employees[$this_employee]);
                continue;
            }
            if(!empty($not_signed_data['customers'])){
                foreach ($not_signed_data['customers'] as $key => $not_signed_customer) {
                    if(!in_array($not_signed_customer['user_name'], $allowed_customers)){
                        unset($not_signed_employees[$this_employee]['customers'][$key]);
                        continue;
                    }
                }
            }
            if(empty($not_signed_employees[$this_employee]['customers']))
                unset($not_signed_employees[$this_employee]);
        }
       // $not_signed_employees = array_values($not_signed_employees);      //for reindexing array
       // echo "<pre>after".print_r(array_keys($not_signed_employees), 1)."</pre>";
       // echo "<pre>after".print_r($not_signed_employees, 1)."</pre>";
    }
    return $not_signed_employees;
}
?>