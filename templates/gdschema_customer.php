<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/company.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once('configs/config.inc.php');
require_once('class/timetable.php');
global $week;
//require_once ('class/team.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$date = new datecalc();
$employee = new employee();
$customer = new customer();
$obj_company = new company();
$msg = new message();
//$team = new team();
//setting the menu
$w_day_name = array();
foreach ($week as $w){
    $w_day_name[] = $smarty->translate[$w['label']];
}
$month_name = array();
foreach ($month as $m){
    $month_name[] = $smarty->translate[$m['label']];
}
$smarty->assign("week_day_names", $w_day_name);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('message', $msg->show_message()); //messages of actions
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assigning  sort by first or last name

$fPath = $smarty->url . str_replace('&', '/', $_SERVER['QUERY_STRING']).'/'; 
$smarty->assign('current_full_path', $fPath); //messages of actions
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
        $customer_username = $query_string[1];
    }
    $week_position = 8;
    if (!empty($query_string[2])) {
        $week_position = $query_string[2];
    }
} else {
    $year_week = date('Y') . '|' . date('W');
    $week_position = 8;
}
// var_dump($query_string = explode('&', $_SERVER['QUERY_STRING']));
// var_dump($year_week);
// exit();
$smarty->assign('from_page', isset($_SESSION['from_page']) ? $_SESSION['from_page'] : '');
$smarty->assign('rpt_page_url', isset($_SESSION['report_return_url']) ? $_SESSION['report_return_url'] : '');


$smarty->assign('flag_cust_access', $customer->is_customer_accessible($customer_username) ? 1 : 0);


/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$smarty->assign('year_week', $year_week);
$smarty->assign('cur_week',substr($year_week,5));
$smarty->assign('cur_year_week',$year_week);
$last_week = date("W", mktime(0,0,0,12,31,date('Y')));
$no_weeks = 52;
if($last_week == 53){
    $no_weeks = 53;
}
$smarty->assign('no_of_weeks',$no_weeks);

$smarty->assign('in_user_role', 4);

$smarty->assign('week_position', $week_position);
$smarty->assign('customer', $customer_username);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->assign('emp_alloc', $_SESSION['user_id']);
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$dat = $employee->get_privileges($_SESSION['user_id'], 1, $customer_username);
$smarty->assign('privilages', $dat);
$smarty->assign('privileges_gd', $dat);//setting previlege
$smarty->assign('privileges_mc', $employee->get_privileges($_SESSION['user_id'], 3));  

//get week datas

$week_numbers = $date->get_weeks($year_week, 40, $week_position);
$smarty->assign('week_numbers', $week_numbers);


$months[0] = array("month_value" => date('Y-m', strtotime(substr($year_week,0,4)."W".substr($year_week,5)."7")),
                    "month_name" => date('Y', strtotime(substr($year_week,0,4)."W".substr($year_week,5)."7"))." ".
                                    $month_name[date('m', strtotime(substr($year_week,0,4)."W".substr($year_week,5)."7"))-1]
                  );
$months[1] = array("month_value" => date('Y-m', strtotime(substr($year_week,0,4)."W".substr($year_week,5)."1")),
                    "month_name" => date('Y', strtotime(substr($year_week,0,4)."W".substr($year_week,5)."1"))." ".
                                    $month_name[date('m', strtotime(substr($year_week,0,4)."W".substr($year_week,5)."1"))-1]
                  );
if($months[0]['month_value'] == $months[1]['month_value']){
    unset($months[1]);
}
$smarty->assign('months', $months);
//echo "<pre>".print_r($months, 1)."</pre>";
//gdschema week data
$customer_data = $customer->customer_data($customer_username);
$smarty->assign('in_user', $customer_username);
$smarty->assign('in_user_details', $customer_data);
$smarty->assign('leave_types', $smarty->leave_type);
$employees = $customer->customer_week_employee($customer_username, $year_week);

$memory_slots =  $employee->get_all_customer_memory_slots($customer_username);
$smarty->assign('memory_slots', $memory_slots);

$smarty->assign('customer_data', $customer_data);
$smarty->assign('employees', $employees);
$smarty->assign('customer_search', $employee->customers_list_for_right_click($customer_username));
$smarty->assign('employee_search', $employee->employees_list_for_right_click($customer_username));

/* ------------------- calculate work hours - contract hours starts---------------------- */
/*$contract_hours = $work_hours = array();
$year_week_params = explode('|', $year_week);
$this_week_start_date = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 1));
$smarty->assign('week_start_date', $this_week_start_date);
$this_week_end_date = date('Y-m-d', strtotime($year_week_params[0] . 'W' . $year_week_params[1] . 7));
$smarty->assign('week_end_date', $this_week_end_date);
$this_week_start_Ym = date('Y|m', strtotime($this_week_start_date));
$this_week_end_Ym = date('Y|m', strtotime($this_week_end_date));

$emp_list = $employee->employee_list_for_process($this_week_start_date, $this_week_end_date, $customer_username);
if($emp_list){
    $smarty->assign('employee_details',$emp_list);
}

$contract_hours['fk']['week'] = $customer->customer_contract_week_hour($customer_username, $year_week, 1, TRUE);
$contract_hours['kn']['week'] = $customer->customer_contract_week_hour($customer_username, $year_week, 2, TRUE);
$contract_hours['tu']['week'] = $customer->customer_contract_week_hour($customer_username, $year_week, 3, TRUE);

$work_hours['fk']['week'] = $customer->customer_timetable_week_time($customer_username, $year_week, 1, TRUE);
$work_hours['kn']['week'] = $customer->customer_timetable_week_time($customer_username, $year_week, 2, TRUE);
$work_hours['tu']['week'] = $customer->customer_timetable_week_time($customer_username, $year_week, 3, TRUE);

        
if($this_week_start_Ym == $this_week_end_Ym) {
    $date_params = explode('|', $this_week_start_Ym);
    $this_year = $date_params[0];
    $this_month_no = sprintf("%02d", $date_params[1]);
    $first_day_of_this_month = $this_year.'-'.$this_month_no.'-01';
    $this_month_date_from = date("Y-m-01", strtotime($first_day_of_this_month));
    $this_month_date_to = date("Y-m-t", strtotime($first_day_of_this_month));
        
    $work_hours['fk']['month'] = $customer->customer_timetable_time_between_dates($customer_username, $this_month_date_from, $this_month_date_to, 1, FALSE, TRUE);
    $work_hours['kn']['month'] = $customer->customer_timetable_time_between_dates($customer_username, $this_month_date_from, $this_month_date_to, 2, FALSE, TRUE);
    $work_hours['tu']['month'] = $customer->customer_timetable_time_between_dates($customer_username, $this_month_date_from, $this_month_date_to, 3, FALSE, TRUE);
    
    $contract_hours['fk']['month'] = $customer->customer_contract_month_hour($customer_username, $this_week_start_Ym, 1, TRUE);
    $contract_hours['kn']['month'] = $customer->customer_contract_month_hour($customer_username, $this_week_start_Ym, 2, TRUE);
    $contract_hours['tu']['month'] = $customer->customer_contract_month_hour($customer_username, $this_week_start_Ym, 3, TRUE);
}

$contract_period_hours = array('fk' => array(), 'kn' => array());
$customer_week_contracts_fk = $customer->customer_contract_week($customer_username, $year_week, 1, TRUE);
if(!empty($customer_week_contracts_fk) && $customer_week_contracts_fk !== FALSE){
    $i = 0;
    foreach($customer_week_contracts_fk as $fk_contract){
        $contract_period_hours['fk'][$i]['period_from']  = $fk_contract['date_from'];
        $contract_period_hours['fk'][$i]['period_to']    = $fk_contract['date_to'];
        $contract_period_hours['fk'][$i]['work_hours']   = $customer->customer_timetable_time_between_dates($customer_username, $fk_contract['date_from'], $fk_contract['date_to'], 1, FALSE, TRUE);
        $contract_period_hours['fk'][$i]['unmanned_hour'] =  $customer->customer_unmanned_hour_calc($customer_username, $fk_contract['date_from'], $fk_contract['date_to'], 1);
        $contract_period_hours['fk'][$i]['contract_hours'] = round($fk_contract['hour'], 2);
        $i++;
    }
}

$customer_week_contracts_kn = $customer->customer_contract_week($customer_username, $year_week, 2, TRUE);
if(!empty($customer_week_contracts_kn) && $customer_week_contracts_kn !== FALSE){
    $i = 0;
    foreach($customer_week_contracts_kn as $kn_contract){
        $contract_period_hours['kn'][$i]['period_from']  = $kn_contract['date_from'];
        $contract_period_hours['kn'][$i]['period_to']    = $kn_contract['date_to'];
        $contract_period_hours['kn'][$i]['work_hours']   = $customer->customer_timetable_time_between_dates($customer_username, $kn_contract['date_from'], $kn_contract['date_to'], 2, FALSE, TRUE);
        $contract_period_hours['kn'][$i]['unmanned_hour'] =  $customer->customer_unmanned_hour_calc($customer_username, $kn_contract['date_from'], $kn_contract['date_to'], 2);
        $contract_period_hours['kn'][$i]['contract_hours'] = round($kn_contract['hour'], 2);
        $i++;
    }
}
$customer_week_contracts_tu = $customer->customer_contract_week($customer_username, $year_week, 3, TRUE);
if(!empty($customer_week_contracts_tu) && $customer_week_contracts_tu !== FALSE){
    $i = 0;
    foreach($customer_week_contracts_tu as $tu_contract){
        $contract_period_hours['tu'][$i]['period_from']  = $tu_contract['date_from'];
        $contract_period_hours['tu'][$i]['period_to']    = $tu_contract['date_to'];
        $contract_period_hours['tu'][$i]['work_hours']   = $customer->customer_timetable_time_between_dates($customer_username, $tu_contract['date_from'], $tu_contract['date_to'], 3, FALSE, TRUE);
        $contract_period_hours['tu'][$i]['unmanned_hour'] =  $customer->customer_unmanned_hour_calc($customer_username, $tu_contract['date_from'],$tu_contract['date_to'], 3);
        $contract_period_hours['tu'][$i]['contract_hours'] = round($tu_contract['hour'], 2);
        $i++;
    }
}

//echo "<pre>work_hours".print_r($work_hours, 1)."</pre>";
//echo "<pre>contract_hours".print_r($contract_hours, 1)."</pre>";
//echo "<pre>contract_period_hours".print_r($contract_period_hours, 1)."</pre>";
$contract_exist_flag = ($work_hours['fk']['week'] != 0 || $work_hours['kn']['week'] != 0 || $work_hours['tu']['week'] != 0 || 
        $contract_hours['fk']['week'] != 0 || $contract_hours['kn']['week'] != 0 || $contract_hours['tu']['week'] != 0 ||
        $work_hours['fk']['month'] != 0 || $work_hours['kn']['month'] != 0 || $work_hours['tu']['month'] != 0 || 
        $contract_hours['fk']['month'] != 0 || $contract_hours['kn']['month'] != 0 || $contract_hours['tu']['month'] != 0 ||
        !empty($customer_week_contracts_fk) || !empty($customer_week_contracts_kn) || !empty($customer_week_contracts_tu)
        ? TRUE : FALSE);
$smarty->assign('contract_exist_flag', $contract_exist_flag);
$smarty->assign('work_hours', $work_hours);
$smarty->assign('contract_hours', $contract_hours);
$smarty->assign('contract_period_hours', $contract_period_hours);*/


/* ------------------- calculate work hours - contract hours endz---------------------- */





$smarty->assign('week', $customer->get_week());
$smarty->assign('privileges',$employee->employee_privilege());
$customer_week = $customer->customer_slots_week($customer_username, $year_week);
$smarty->assign('customer_week', $customer_week);
$holidays = $employee->get_holiday_details_by_date($customer_week[0]['date'], $customer_week[6]['date'], true);
$smarty->assign('holidays', $holidays);
//echo "<pre>".print_r($holidays, 1)."</pre>";

$smarty->assign('first_date_month', date('m', strtotime($customer_week[0]['date'])));
$smarty->assign('first_date_year', date('Y', strtotime($customer_week[0]['date'])));

if($_SESSION['user_role'] == 1)
    $smarty->assign('process_previlege', 1);
else
    $smarty->assign('process_previlege', $employee->has_privilege($_SESSION['user_id'], 'process'));

$smarty->assign('show_right_panel', false);
if(isset($_REQUEST['show_right_panel']) && $_REQUEST['show_right_panel'] && isset($_REQUEST['right_panel']) && $_REQUEST['right_panel'] != ''){
    $smarty->assign('show_right_panel', true);
    $smarty->assign('right_panel', $_REQUEST['right_panel']);   //memory_slots
//    echo "<pre>".print_r($_REQUEST, 1)."</pre>";
}
$smarty->assign('swap_copied_slot', isset($_SESSION['swap']) ? $_SESSION['swap'] : '');

$search_customers = $customer->customers_list_for_employee_report();
$smarty->assign('search_customers', $search_customers);

$righclick_employees_for_goto = $employee->employees_list_for_right_click($customer_username);
$smarty->assign('righclick_employees_for_goto', $righclick_employees_for_goto);

if(isset($_COOKIE['opened_weekly_top_widget']) && $_COOKIE['opened_weekly_top_widget'] == TRUE){
    $customers_to_allocate = $customer->non_allocated_customers($year_week);
    $employees_to_allocate = $employee->employee_to_allocate($year_week, $customer_username);
    $leave_employees = $employee->leave_employee_week($year_week);

//    if($customers_to_allocate) 
        $smarty->assign('customers_to_allocate', $customers_to_allocate);
//    if($employees_to_allocate) 
        $smarty->assign('employees_to_allocate', $employees_to_allocate);
//    if($leave_employees)
        $smarty->assign('leave_employees', $leave_employees);
}

$smarty->assign('today_date', date('Y-m-d'));
if(date('Y|W') == $year_week){
    $obj_timetable  = new timetable();
    $customer_running_tasks = $obj_timetable->get_customer_running_tasks($customer_username);
    $smarty->assign('customer_running_tasks', $customer_running_tasks);
}
else{
    $smarty->assign('customer_running_tasks', array());
}

$smarty->assign('translate_json', json_encode($smarty->translate));
$smarty->assign('privileges_gd_json', json_encode($dat));
$smarty->assign('company_id', isset($_SESSION['company_id']) ? $_SESSION['company_id'] : '');
$smarty->display('gdschema_customer.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_customer.tpl');
?>