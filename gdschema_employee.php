<?php
require_once ('class/setup.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/team.php');
require_once ('class/company.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/contract.php');
require_once ('class/general.php');
require_once('class/timetable.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","messages.xml", "user.xml","button.xml", 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$date = new datecalc();
$employee = new employee();
$customer = new customer();
$obj_company = new company();
$msg = new message();
$team = new team();
$obj_contract = new contract();

$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('message', $msg->show_message()); //messages of actions
if(isset($_SESSION['max_min'])){
    $smarty->assign('max_min',$_SESSION['max_min']);
}else{
   $_SESSION['max_min'] = 'max'; 
   $smarty->assign('max_min',$_SESSION['max_min']);
}
if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $year_week = $query_string[0];
    
    if (!empty($query_string[1])) {
        $employee_username = $query_string[1];
    }
    $week_position = 8;
    if (!empty($query_string[2])) {
        $week_position = $query_string[2];
    }
} else {
    $year_week = date('Y') . '|' . date('W');
    $week_position = 8;
}

//echo "hihi".$_SESSION['report_return_url'];
$smarty->assign('from_page', isset($_SESSION['from_page']) ? $_SESSION['from_page'] : '');
$smarty->assign('rpt_page_url', isset($_SESSION['report_return_url']) ? $_SESSION['report_return_url'] : '');


if($employee->is_employee_accessible($employee_username)){
    $smarty->assign('flag_emp_access', 1);
}else{
    $smarty->assign('flag_emp_access', 0);
}

$smarty->assign('year_week', $year_week);
$smarty->assign('cur_week',substr($year_week,5));
$smarty->assign('week_position', $week_position);
$smarty->assign('employee', $employee_username);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->assign('emp_alloc', $_SESSION['user_id']);
$smarty->assign('emp_role', $_SESSION['user_role']);
$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('privileges_gd', $employee->get_privileges($_SESSION['user_id'], 1));//setting previlege
$smarty->assign('privileges_mc', $employee->get_privileges($_SESSION['user_id'], 3)); 

$smarty->assign('swap_copied_slot', isset($_SESSION['swap']) ? $_SESSION['swap'] : '');

//get week datas
$week_numbers = $date->get_weeks($year_week, 40, $week_position);
$smarty->assign('week_numbers', $week_numbers);
$last_week = date("W", mktime(0,0,0,12,31,date('Y')));
$no_weeks = 52;
if($last_week == 53){
    $no_weeks = 53;
}
$smarty->assign('no_of_weeks',$no_weeks);

$year_week_params = explode('|', $year_week);
$this_week_start_date = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
$smarty->assign('week_start_date', $this_week_start_date);

//gdschema week data

$employee_data = $employee->employee_data($employee_username);
//$employee_data = $employee->get_employee_detail($employee_username);
//echo "<pre>".print_r($employee_data, 1)."</pre>";
$smarty->assign('employee_data', $employee_data);

$customers = $employee->employee_week_customer($employee_username, $year_week);
$customer_search = $team->customers_for_employee_team($employee_username);
$employee_search = $employee->employee_list_exact($employee_username);
$smarty->assign('customer_search', $customer_search);
$smarty->assign('employee_search', $employee_search);
$smarty->assign('customers', $customers);
$smarty->assign('contract_hour', $employee->employee_contract_week_hour($employee_username, $year_week));
$smarty->assign('assigned_hour', $employee->employee_timetable_week_time($employee_username, $year_week));
$smarty->assign('week', $employee->get_week());
$smarty->assign('privileges', $employee->employee_privilege());
//print_r($employee->employee_slots_week($employee_username, $year_week));
$employee_week = $employee->employee_slots_week($employee_username, $year_week);
$smarty->assign('employee_week', $employee_week);
$holidays = $employee->get_holiday_details_by_date($employee_week[0]['date'], $employee_week[6]['date'], true);
$smarty->assign('holidays', $holidays);
//echo "<pre>".print_r($employee->employee_slots_week($employee_username, $year_week), 1)."</pre>";

$year_week_params = explode('|', $year_week);
$this_week_start_date = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
$this_week_end_date = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 7));
//echo "<pre>".print_r($selected_week_slots, 1)."</pre>";

$smarty->assign('first_date_month', date('m', strtotime($this_week_start_date)));
$smarty->assign('first_date_year', date('Y', strtotime($this_week_start_date)));

//echo "<pre>\n".print_r($employee->employee_slots_week($employee_username, $year_week), 1)."</pre>";
if($_SESSION['user_role'] == 1)
    $smarty->assign('process_previlege', 1);
else
    $smarty->assign('process_previlege', $employee->has_privilege($_SESSION['user_id'], 'process'));

$customers_to_allocate = $customer->non_allocated_customers($year_week);
if($customers_to_allocate)
    $smarty->assign('customers_to_allocate', $customers_to_allocate);

$employees_to_allocate = $employee->employee_to_allocate($year_week, $employee_username);
    $smarty->assign('employees_to_allocate', $employees_to_allocate);
    
$leave_employees = $employee->leave_employee_week($year_week);
if($leave_employees)
    $smarty->assign('leave_employees', $leave_employees);

$smarty->assign('privilages_main', $employee->get_privileges($_SESSION['user_id'], 1));
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */




/* ------------------- calculate work hours - contract hours starts---------------------- */
$work_hours = $contract_hours = array();
$this_week_start_Ym = date('Y|m', strtotime($this_week_start_date));
$this_week_end_Ym = date('Y|m', strtotime($this_week_end_date));
$work_hours['weekly_nomal'] = round($employee->employee_total_work_hours($employee_username, 'year_week', $year_week, 0), 2);
$work_hours['weekly_oncall'] = round($employee->employee_total_work_hours($employee_username, 'year_week', $year_week, 3), 2);
if($this_week_start_Ym == $this_week_end_Ym) {
    $work_hours['monthly_nomal'] = round($employee->employee_total_work_hours($employee_username, 'year_month', $this_week_start_Ym, 0), 2);
    $work_hours['monthly_oncall'] = round($employee->employee_total_work_hours($employee_username, 'year_month', $this_week_start_Ym, 3), 2);
}

$cur_employee_contracts = $obj_contract->get_employee_contract_records($employee_username, 'year_week', $year_week);
if(!empty($cur_employee_contracts)){
    $i = 0;
    $obj_general = new general();
    foreach($cur_employee_contracts as $cur_employee_contract){
        $cur_employee_contract_from = $cur_employee_contract['date_from'];
        $cur_employee_contract_to = $cur_employee_contract['date_to'];
        if(date('Y', strtotime($cur_employee_contract_from)) != $year_week_params[0])
                $cur_employee_contract_from = date('Y-01-01', strtotime($this_week_start_date));
        if($cur_employee_contract_to == '' || date('Y', strtotime($cur_employee_contract_to)) != $year_week_params[0])
                $cur_employee_contract_to = date('Y-12-31', strtotime($this_week_end_date));
        
        $work_hours['periods'][$i]['period_from'] = $cur_employee_contract_from;
        $work_hours['periods'][$i]['period_to'] = $cur_employee_contract_to;
        $work_hours['periods'][$i]['work_nomal'] = round($employee->employee_total_work_hours($employee_username, 'date_between', $cur_employee_contract_from.'|'.$cur_employee_contract_to, 0), 2);
        $work_hours['periods'][$i]['work_oncall'] = round($employee->employee_total_work_hours($employee_username, 'date_between', $cur_employee_contract_from.'|'.$cur_employee_contract_to, 3), 2);
        
        $contract_period_working_days = $obj_contract->get_working_days($cur_employee_contract_from, $cur_employee_contract_to);
        $work_hours['periods'][$i]['contract_nomal'] = round(($cur_employee_contract['hour'] / 5 * $contract_period_working_days), 2);
        
        $contract_period_months = $obj_general->get_months_between_dates($cur_employee_contract_from, $cur_employee_contract_to, 'Y-m-01');
        $contract_period_oncall_contracts = 0.00;
        if(!empty($contract_period_months)){
            foreach ($contract_period_months as $contract_period_month) {
                $this_month_start_date = date('Y-m-01', strtotime($contract_period_month));
                $this_month_end_date = date('Y-m-t', strtotime($contract_period_month));
                $this_month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
                
                $this_month_contract_from = $cur_employee_contract_from;
                $this_month_contract_to = $cur_employee_contract_to;
                if(date('Y|m', strtotime($cur_employee_contract_from)) != date('Y|m', strtotime($contract_period_month)))
                        $this_month_contract_from = date('Y-m-01', strtotime ($contract_period_month));
                if(date('Y|m', strtotime($cur_employee_contract_to)) != date('Y|m', strtotime($contract_period_month)))
                        $this_month_contract_to = date('Y-m-t', strtotime ($contract_period_month));
                $this_month_contract_working_days = $obj_contract->get_working_days($this_month_contract_from, $this_month_contract_to);
                $contract_period_oncall_contracts += $cur_employee_contract['monthly_oncall_hour'] / $this_month_working_days * $this_month_contract_working_days;
            }
        }
        $work_hours['periods'][$i]['contract_oncall'] = round($contract_period_oncall_contracts, 2);
        $i++;
    }
    //--------------calculate maximum allowed contract hours------------------------------
    $total_weekly_normal_contract_hours = $total_weekly_oncall_contract_hours = 0.00;
    foreach($cur_employee_contracts as $cur_employee_contract){
        $this_week_contract_from = $cur_employee_contract['date_from'];
        $this_week_contract_to = $cur_employee_contract['date_to'];
        if(date('Y|W', strtotime($this_week_contract_from)) != $year_week)
                $this_week_contract_from = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
        if($this_week_contract_to == '' || date('Y|W', strtotime($this_week_contract_to)) != $year_week)
                $this_week_contract_to = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 7));
        
        $working_days_in_this_contract = $obj_contract->get_working_days($this_week_contract_from, $this_week_contract_to);
        $total_weekly_normal_contract_hours += $cur_employee_contract['hour'] / 5 * $working_days_in_this_contract;
        //----------------------calculate weekly oncall contract hours-------------------
        //if this week have no 2 months
        if($this_week_start_Ym == $this_week_end_Ym){
            $this_month_contract_from = date('Y-m-01', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
            $this_month_contract_to = date('Y-m-t', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
            $this_month_working_days = $obj_contract->get_working_days($this_month_contract_from, $this_month_contract_to);
            $total_weekly_oncall_contract_hours += $cur_employee_contract['monthly_oncall_hour'] / $this_month_working_days * $working_days_in_this_contract;
        } 
        //if this week have 2 months
        else {
            //if this contract in this week not passes through no 2 months
            if(date('Y|m', strtotime($this_week_contract_from)) == date('Y|m', strtotime($this_week_contract_to))){
                $this_month_contract_from = date('Y-m-01', strtotime($this_week_contract_from));
                $this_month_contract_to = date('Y-m-t', strtotime($this_week_contract_from));
                $this_month_working_days = $obj_contract->get_working_days($this_month_contract_from, $this_month_contract_to);
                $total_weekly_oncall_contract_hours += $cur_employee_contract['monthly_oncall_hour'] / $this_month_working_days * $working_days_in_this_contract;
            } 
            //if this contract in this week passes through no 2 months
            else {
                $first_month_contract_from = date('Y-m-01', strtotime($this_week_contract_from));
                $first_month_contract_to = date('Y-m-t', strtotime($this_week_contract_from));
                $first_month_working_days = $obj_contract->get_working_days($first_month_contract_from, $first_month_contract_to);

                $second_month_contract_from = date('Y-m-01', strtotime($this_week_contract_to));
                $second_month_contract_to = date('Y-m-t', strtotime($this_week_contract_to));
                $second_month_working_days = $obj_contract->get_working_days($second_month_contract_from, $second_month_contract_to);

                $calculated_datefrom = strtotime($this_week_contract_from, 0);
                $calculated_dateto = strtotime($first_month_contract_to, 0);
                $this_week_no_of_days_in_first_month = floor(($calculated_dateto - $calculated_datefrom) / 86400);

                $calculated_datefrom = strtotime($second_month_contract_from, 0);
                $calculated_dateto = strtotime($this_week_contract_to, 0);
                $this_week_no_of_days_in_second_month = floor(($calculated_dateto - $calculated_datefrom) / 86400);

                $total_weekly_oncall_contract_hours += ($cur_employee_contract['monthly_oncall_hour'] / $first_month_working_days * $this_week_no_of_days_in_first_month) + 
                                                ($cur_employee_contract['monthly_oncall_hour'] / $second_month_working_days * $this_week_no_of_days_in_second_month);
            }
        }
        
    }
    $contract_hours['weekly_nomal'] = round($total_weekly_normal_contract_hours, 2);
    $contract_hours['weekly_oncall'] = round($total_weekly_oncall_contract_hours, 2);

    //----------------------calculate monthly normal-oncall contract hours-------------------
    //if this week not passes through 2 months
    if($this_week_start_Ym == $this_week_end_Ym) {
        $contract_hours['monthly_oncall'] = round($cur_employee_contracts[0]['monthly_oncall_hour'], 2);

        $this_month_start_date = date('Y-m-01', strtotime($this_week_start_date));
        $this_month_end_date = date('Y-m-t', strtotime($this_week_start_date));
        $month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
        $contract_hours['monthly_nomal'] = round(($cur_employee_contracts[0]['hour'] / 5 * $month_working_days), 2);
    }
} else {
    //--------------calculate maximum allowed contract hours------------------------------
    $contract_hours['weekly_nomal'] = $company_data['weekly_hour'];
    if($this_week_start_Ym == $this_week_end_Ym){
        $this_month_contract_from = date('Y-m-01', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
        $this_month_contract_to = date('Y-m-t', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
        $this_month_working_days = $obj_contract->get_working_days($this_month_contract_from, $this_month_contract_to);
        $contract_hours['weekly_oncall'] = round(($company_data['monthly_oncall_hour'] / $this_month_working_days * 5), 2);
    } else {
        $first_month_contract_from = date('Y-m-01', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
        $first_month_contract_to = date('Y-m-t', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
        $first_month_working_days = $obj_contract->get_working_days($first_month_contract_from, $first_month_contract_to);
        
        $second_month_contract_from = date('Y-m-01', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 7));
        $second_month_contract_to = date('Y-m-t', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 7));
        $second_month_working_days = $obj_contract->get_working_days($second_month_contract_from, $second_month_contract_to);
        
        $calculated_datefrom = strtotime($this_week_start_date, 0);
        $calculated_dateto = strtotime($first_month_contract_to, 0);
        $this_week_no_of_days_in_first_month = floor(($calculated_dateto - $calculated_datefrom) / 86400);
        
        $calculated_datefrom = strtotime($second_month_contract_from, 0);
        $calculated_dateto = strtotime($this_week_end_date, 0);
        $this_week_no_of_days_in_second_month = floor(($calculated_dateto - $calculated_datefrom) / 86400);
            
        $contract_hours['weekly_oncall'] = round(($company_data['monthly_oncall_hour'] / $first_month_working_days * $this_week_no_of_days_in_first_month) + 
                                            ($company_data['monthly_oncall_hour'] / $second_month_working_days * $this_week_no_of_days_in_second_month), 2);
    }
    
    if($this_week_start_Ym == $this_week_end_Ym) {
        $contract_hours['monthly_oncall'] = round($company_data['monthly_oncall_hour'], 2);
        
        $this_month_start_date = date('Y-m-01', strtotime($this_week_start_date));
        $this_month_end_date = date('Y-m-t', strtotime($this_week_start_date));
        $month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
        $contract_hours['monthly_nomal'] = round(($company_data['weekly_hour'] / 5 * $month_working_days), 2);
    }
}
//echo "<pre>work_hours".print_r($work_hours, 1)."</pre>";
//echo "<pre>contract_hours".print_r($contract_hours, 1)."</pre>";
$contract_exist_flag = ($work_hours['weekly_nomal'] != 0 || $work_hours['weekly_oncall'] != 0 || 
        $contract_hours['weekly_nomal'] != 0 || $contract_hours['weekly_oncall'] != 0 ||
        !isset($work_hours['monthly_nomal']) || isset($work_hours['monthly_oncall']) || empty($work_hours['periods'])
        ? TRUE : FALSE);
$smarty->assign('contract_exist_flag', $contract_exist_flag);
$smarty->assign('contract_hours', $contract_hours);
$smarty->assign('work_hours', $work_hours);
/* ------------------- calculate work hours - contract hours-----------endz----------- */

//employees customers whos was not signed
$non_signed_customers_of_employee = $team->customers_for_employee_team_gdschema_alloc($employee_username, $this_week_end_date);
$smarty->assign('non_signed_customers_of_employee', $non_signed_customers_of_employee);
//all customers of this employees (not checking signing)
$all_customers_of_employee = $employee->get_team_customers_of_employee($employee_username);
$smarty->assign('all_customers_of_employee', $all_customers_of_employee);

$search_employees = $employee->employees_list_for_right_click($employee_username);
$smarty->assign('search_employees', $search_employees);

$righclick_customers_for_goto = $customer->customer_list();
$smarty->assign('righclick_customers_for_goto', $righclick_customers_for_goto);

if(isset($_COOKIE['opened_weekly_top_widget']) && $_COOKIE['opened_weekly_top_widget'] == TRUE){
    $customers_to_allocate = $customer->non_allocated_customers($year_week);
    $employees_to_allocate = $employee->employee_to_allocate($year_week, $employee_username);
    $leave_employees = $employee->leave_employee_week($year_week);

    if($customers_to_allocate) 
        $smarty->assign('customers_to_allocate', $customers_to_allocate);
    if($employees_to_allocate) 
        $smarty->assign('employees_to_allocate', $employees_to_allocate);
    if($leave_employees)
        $smarty->assign('leave_employees', $leave_employees);
}

$smarty->assign('today_date', date('Y-m-d'));
if(date('Y|W') == $year_week){
    $obj_timetable  = new timetable();
    $employee_running_tasks = $obj_timetable->get_employee_running_tasks($employee_username);
    $smarty->assign('employee_running_tasks', $employee_running_tasks);
}
else{
    $smarty->assign('employee_running_tasks', array());
}

$smarty->display('gdschema_employee.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_employee.tpl');
?>