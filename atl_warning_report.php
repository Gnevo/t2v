<?php
//ini_set('display_errors', 'On');
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once ('class/company.php');
require_once ('configs/config.inc.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "employee.xml","user.xml","reports.xml"));
$obj_equipment = new equipment();
$employee_cls = new employee();
$customer_cls = new customer();
$company = new company();
$month = date('n');
$year = date('Y');
global $week;

$employees = $employee_cls->employees_list_for_right_click($_SESSION['user_id']);
$customers = $customer_cls->customer_list();
$smarty->assign('customers',$customers);
$smarty->assign('search_type','2');

$employees_search[0]['username'] = ''; 
if(isset($_POST['year']) && isset($_POST['year'])){
    $company_detail = $company->get_company_detail($_SESSION['company_id']);
    $smarty->assign('max_daily_hour',$company_detail['max_daily_hour']);
    $smarty->assign('min_daily_rest',$company_detail['min_daily_rest']);
    $smarty->assign('min_weekly_rest','36');
    $month = $_POST['month'];
    $year = $_POST['year'];
    $smarty->assign('search_type',$_POST['search_type']);
    if($_POST['search_type'] == 1 && $_POST['cust_selected'] != '' && $_POST['txt_customer'] != ''){
        $cust_username = $_POST['cust_selected'];
        $smarty->assign('cust_selected',$_POST['cust_selected']);
        $smarty->assign('cust_name',$_POST['txt_customer']);
        $smarty->assign('emp_selected','');
        $smarty->assign('emp_name','');
        $employees_search = $employee_cls->employees_list_for_right_click($cust_username);
    }elseif($_POST['search_type'] == 2 && $_POST['emp_selected'] != '' && $_POST['search_emp'] != ''){
        $smarty->assign('emp_selected',$_POST['emp_selected']);
        $smarty->assign('emp_name',$_POST['search_emp']);
        $smarty->assign('cust_selected','');
        $smarty->assign('cust_name','');
        $employees_search[0]['username'] = $_POST['emp_selected']; 
    }
    $smarty->assign('selected_emp',$_POST['emp_selected']);
    $reports = $obj_equipment->get_reports_atl_warning($month,$year,$employees_search);
    $day_time = $employee_cls->get_employee_start_day($_POST['emp_selected']);
    $emp_start_day = intval(substr($day_time, 0, 1));
    $emp_start_time = substr($day_time, 1);
    $day_key = array_search($emp_start_day,array_column($week,'id'));
    $smarty->assign('emp_start_day', $smarty->translate[$week[$day_key]['day']]);
    $smarty->assign('emp_start_time', sprintf('%05.02f',$emp_start_time));
}
   
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

//echo "<pre>". print_r($employees, 1)."</pre>";



/*$count = $employee->get_reports_atl_warning_count($month,$year);*/
//$employees = $employee_cls->employee_list();
/*if(isset($_POST['action']) && $_POST['action'] == 'print'){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $employee->generate_atl_warning_report_pdf($month,$year);
    exit();
//    echo "<script>alert('hai');</script>";
}
if(isset($_POST['get_report'])){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $emp = $_POST['emp_selected'];
    if($emp == "" || $emp == NULL){
        $reports = $employee->get_reports_atl_warning($month,$year);
        $count = $employee->get_reports_atl_warning_count($month,$year);
    }else{
        $reports = $employee->get_reports_atl_warning($month,$year,$emp);
        $count = $employee->get_reports_atl_warning_count($month,$year,$emp); 
    }
    $smarty->assign('emp',$emp);
}
if($_SERVER['QUERY_STRING']){
    $query_string_data = explode("&", $_SERVER['QUERY_STRING']);
    if(count($query_string_data) == 1){
        $query_string = explode("-", $_SERVER['QUERY_STRING']);
        $page = $query_string[0];
        $emp = $query_string[1];
        $reports = $employee->get_reports_atl_warning($month,$year,$emp,$page);
    }else{
        $query_string = explode("-", $query_string_data[0]);
        $page = $query_string[0];
        $emp = $query_string[1];
        $sort = $query_string_data[1];
        $reports = $employee->get_reports_atl_warning($month,$year,$emp,$page,$sort); 
    }
}else{
    $page = 1;
}*/
//echo "<pre>reports". print_r($reports, 1)."</pre>";
$smarty->assign('reports',$reports);
//$years_report = $employee->get_years_atl_warning();
$employees = $employee_cls->employees_list_for_right_click($_SESSION['user_id']);
$smarty->assign('employees',$employees);
$years_report = array(array('year' => $year-1),array( 'year' =>$year), array('year' =>$year+1));
$smarty->assign('years_report',$years_report);
$smarty->assign('year',$year);
$smarty->assign('month',$month);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>6));
$smarty->display('extends:layouts/dashboard.tpl|atl_warning_report.tpl');
?>