<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/employee.php');
require_once('configs/config.inc.php');
require_once('class/user.php');
require_once('class/inconvenient.php');
require_once('class/customer.php');
require_once('class/leave.php');
require_once('class/timetable.php');
require_once('class/company.php');
require_once('plugins/message.class.php');
require_once('class/report_signing.php');

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml", "gdschema.xml", 'tooltip.xml' ,'forms.xml'));
$obj_cust      = new customer();
$obj_inconv    = new inconvenient();
$user          = new user();
$employee      = new employee();
$obj_leave     = new leave();
$obj_timetable = new timetable();
$obj_company   = new company();
$msg           = new message();
$obj_rpt       = new report_signing();
global $leave_type;
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$parameters = explode('&', $_SERVER['QUERY_STRING']);
$passed_year = $parameters[0];
$passed_month = $parameters[1];
$passed_employee = $parameters[2];
$passed_customer = $parameters[3];

$signin_sutl        = $obj_rpt->get_report_details($passed_year,$passed_month,$passed_employee,$passed_customer)['signin_sutl'];
$smarty->assign('signin_sutl', $signin_sutl);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);
// echo $smarty->url; exit();

if($_SESSION['saved_url']){
    $smarty->assign("back_url", $_SESSION['saved_url']);
}
$smarty->assign("rpt_month", sprintf('%02d',$passed_month));
//echo $passed_employee. $passed_month. $passed_year;
if($_SESSION['report_return_url'] != ''){
    $smarty->assign("back_url", $_SESSION['url_back_back']);
    $_SESSION['report_return_url'] = '';
    unset($_SESSION['report_return_url']);
}
//$_SESSION['report_return_url'] = '';
if($employee->is_employee_accessible($passed_employee)){        //prevent manual typing on URL
    $smarty->assign('flag_emp_access', 1);
}else{
    $smarty->assign('flag_emp_access', 0);
}
    
if(isset($_POST['action']) && $_POST['action'] == 'print'){
    $employee->generate_pdf_work_report($passed_year,$passed_month,$passed_employee, $passed_customer);
    exit();
}

if ($passed_year % 400 == 0 || ($passed_year % 100 != 0 && $passed_year % 4 == 0))
    $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
else
    $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
$smarty->assign('cur_month_last_date',$month_days[$passed_month-1]);

$employee_combo = $employee->exact_employee_list_for_employee_detailed_report();
$smarty->assign('E_combo', $employee_combo);

$years_combo = $employee->distinct_years();
$smarty->assign("year_option_values", $years_combo);

global $month;
//print_r($month[$passed_month]);
$month_name = $smarty->translate[$month[$passed_month-1]['month']];
$smarty->assign('month_name',$month_name);


$emp = (isset($passed_employee) ? $passed_employee : "");
$yr = (isset($passed_year) ? $passed_year : "");
$month = (isset($passed_month) ? $passed_month : "");
$em_name = $employee->get_employee_name('\''.$emp.'\'');
$cust_name = $obj_cust->getCustomerName($passed_customer);


$smarty->assign('customer_name', $cust_name);
$smarty->assign('employee_name', $em_name);
$smarty->assign('customer_id', $passed_customer);
$smarty->assign('employee_id', $emp);
$smarty->assign('report_month', $month);
$smarty->assign('report_year', $yr);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));


///////////////////////////////////////////////////////////////////////////////////////
$obj_inconv->generate_work_report($passed_employee, $month, $yr, $passed_customer);
// $employee_slots = $obj_inconv->inconv_normal_slots;
$employee_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);
//$obj_inconv->print_arrays();
// echo '<pre>'.print_r($obj_inconv->inconv_normal_slots, 1).'</pre>';exit();

//echo "<pre>".print_r($obj_inconv->sub_keys_dismissal, 1)."</pre>";
////////////////////////////////////////////////////////////////

$smarty->assign('sub_keys_leave_normal_head', $obj_inconv->sub_keys_leave_normal_head);
$smarty->assign('sub_keys_leave_travel_head', $obj_inconv->sub_keys_leave_travel_head);
$smarty->assign('sub_keys_leave_break_head', $obj_inconv->sub_keys_leave_break_head);
$smarty->assign('sub_keys_leave_over_head', $obj_inconv->sub_keys_leave_over_head);
$smarty->assign('sub_keys_leave_quality_head', $obj_inconv->sub_keys_leave_quality_head);
$smarty->assign('sub_keys_leave_more_head', $obj_inconv->sub_keys_leave_more_head);
$smarty->assign('sub_keys_leave_some_head', $obj_inconv->sub_keys_leave_some_head);
$smarty->assign('sub_keys_leave_training_head', $obj_inconv->sub_keys_leave_training_head);
$smarty->assign('sub_keys_leave_personal_head', $obj_inconv->sub_keys_leave_personal_head);
$smarty->assign('sub_keys_leave_voluntary_head', $obj_inconv->sub_keys_leave_voluntary_head);
$smarty->assign('sub_keys_leave_oncall_head', $obj_inconv->sub_keys_leave_oncall_head);
$smarty->assign('sub_keys_leave_calltraining_head', $obj_inconv->sub_keys_leave_calltraining_head);
$smarty->assign('sub_keys_leave_more_oncall_head', $obj_inconv->sub_keys_leave_more_oncall_head);
$smarty->assign('sub_keys_leave_standby_head', $obj_inconv->sub_keys_leave_standby_head);


$smarty->assign('sum_normal', $obj_inconv->sum_normal);
$smarty->assign('sum_travel', $obj_inconv->sum_travel);
$smarty->assign('sum_break', $obj_inconv->sum_break);
$smarty->assign('sum_over', $obj_inconv->sum_over);
$smarty->assign('sum_quality', $obj_inconv->sum_quality);
$smarty->assign('sum_more', $obj_inconv->sum_more);
$smarty->assign('sum_some', $obj_inconv->sum_some);
$smarty->assign('sum_training', $obj_inconv->sum_training);
$smarty->assign('sum_personal', $obj_inconv->sum_personal);
$smarty->assign('sum_voluntary', $obj_inconv->sum_voluntary);
$smarty->assign('sum_complementary', $obj_inconv->sum_complementary);
$smarty->assign('sum_oncall', $obj_inconv->sum_oncall);
$smarty->assign('sum_calltraining', $obj_inconv->sum_calltraining);
$smarty->assign('sum_complementary_oncall', $obj_inconv->sum_complementary_oncall);
$smarty->assign('sum_more_oncall', $obj_inconv->sum_more_oncall);
$smarty->assign('sum_standby', $obj_inconv->sum_standby);
$smarty->assign('sum_dismissal', $obj_inconv->sum_dismissal);
$smarty->assign('sum_dismissal_oncall', $obj_inconv->sum_dismissal_oncall);

$smarty->assign('sum_leave_normal', $obj_inconv->sum_leave_normal);
$smarty->assign('sum_leave_normal_inconv', $obj_inconv->sum_leave_normal_inconv);
$smarty->assign('sum_leave_travel', $obj_inconv->sum_leave_travel);
$smarty->assign('sum_leave_travel_inconv', $obj_inconv->sum_leave_travel_inconv);
$smarty->assign('sum_leave_break', $obj_inconv->sum_leave_break);
$smarty->assign('sum_leave_break_inconv', $obj_inconv->sum_leave_break_inconv);
$smarty->assign('sum_leave_over', $obj_inconv->sum_leave_over);
$smarty->assign('sum_leave_over_inconv', $obj_inconv->sum_leave_over_inconv);
$smarty->assign('sum_leave_quality', $obj_inconv->sum_leave_quality);
$smarty->assign('sum_leave_quality_inconv', $obj_inconv->sum_leave_quality_inconv);
$smarty->assign('sum_leave_more', $obj_inconv->sum_leave_more);
$smarty->assign('sum_leave_more_inconv', $obj_inconv->sum_leave_more_inconv);
$smarty->assign('sum_leave_some', $obj_inconv->sum_leave_some);
$smarty->assign('sum_leave_some_inconv', $obj_inconv->sum_leave_some_inconv);
$smarty->assign('sum_leave_training', $obj_inconv->sum_leave_training);
$smarty->assign('sum_leave_training_inconv', $obj_inconv->sum_leave_training_inconv);
$smarty->assign('sum_leave_personal', $obj_inconv->sum_leave_personal);
$smarty->assign('sum_leave_personal_inconv', $obj_inconv->sum_leave_personal_inconv);
$smarty->assign('sum_leave_voluntary', $obj_inconv->sum_leave_voluntary);
$smarty->assign('sum_leave_voluntary_inconv', $obj_inconv->sum_leave_voluntary_inconv);
$smarty->assign('sum_leave_oncall', $obj_inconv->sum_leave_oncall);
$smarty->assign('sum_leave_oncall_inconv', $obj_inconv->sum_leave_oncall_inconv);
$smarty->assign('sum_leave_calltraining', $obj_inconv->sum_leave_calltraining);
$smarty->assign('sum_leave_calltraining_inconv', $obj_inconv->sum_leave_calltraining_inconv);
$smarty->assign('sum_leave_more_oncall', $obj_inconv->sum_leave_more_oncall);
$smarty->assign('sum_leave_more_oncall_inconv', $obj_inconv->sum_leave_more_oncall_inconv);
$smarty->assign('sum_leave_standby', $obj_inconv->sum_leave_standby);
$smarty->assign('sum_leave_standby_inconv', $obj_inconv->sum_leave_standby_inconv);
//$smarty->assign('sum_leave', $sum_leave);

$smarty->assign('days_in_month', $obj_inconv->days_in_month);

$smarty->assign('sub_keys_normal', $obj_inconv->sub_keys_normal);
$smarty->assign('sub_keys_travel', $obj_inconv->sub_keys_travel);
$smarty->assign('sub_keys_break', $obj_inconv->sub_keys_break);
$smarty->assign('sub_keys_over', $obj_inconv->sub_keys_over);
$smarty->assign('sub_keys_quality', $obj_inconv->sub_keys_quality);
$smarty->assign('sub_keys_more', $obj_inconv->sub_keys_more);
$smarty->assign('sub_keys_some', $obj_inconv->sub_keys_some);
$smarty->assign('sub_keys_training', $obj_inconv->sub_keys_training);
$smarty->assign('sub_keys_personal', $obj_inconv->sub_keys_personal);
$smarty->assign('sub_keys_voluntary', $obj_inconv->sub_keys_voluntary);
$smarty->assign('sub_keys_complementary', $obj_inconv->sub_keys_complementary);
$smarty->assign('sub_keys_oncall', $obj_inconv->sub_keys_oncall);
$smarty->assign('sub_keys_calltraining', $obj_inconv->sub_keys_calltraining);
$smarty->assign('sub_keys_complementary_oncall', $obj_inconv->sub_keys_complementary_oncall);
$smarty->assign('sub_keys_more_oncall', $obj_inconv->sub_keys_more_oncall);
$smarty->assign('sub_keys_standby', $obj_inconv->sub_keys_standby);
$smarty->assign('sub_keys_dismissal', $obj_inconv->sub_keys_dismissal);
$smarty->assign('sub_keys_dismissal_oncall', $obj_inconv->sub_keys_dismissal_oncall);

$smarty->assign('sub_keys_leave_normal', $obj_inconv->sub_keys_leave_normal);
$smarty->assign('sub_keys_leave_normal_inconv', $obj_inconv->sub_keys_leave_normal_inconv);
$smarty->assign('sub_keys_leave_travel', $obj_inconv->sub_keys_leave_travel);
$smarty->assign('sub_keys_leave_travel_inconv', $obj_inconv->sub_keys_leave_travel_inconv);
$smarty->assign('sub_keys_leave_break', $obj_inconv->sub_keys_leave_break);
$smarty->assign('sub_keys_leave_break_inconv', $obj_inconv->sub_keys_leave_break_inconv);
$smarty->assign('sub_keys_leave_over', $obj_inconv->sub_keys_leave_over);
$smarty->assign('sub_keys_leave_over_inconv', $obj_inconv->sub_keys_leave_over_inconv);
$smarty->assign('sub_keys_leave_quality', $obj_inconv->sub_keys_leave_quality);
$smarty->assign('sub_keys_leave_quality_inconv', $obj_inconv->sub_keys_leave_quality_inconv);
$smarty->assign('sub_keys_leave_more', $obj_inconv->sub_keys_leave_more);
$smarty->assign('sub_keys_leave_more_inconv', $obj_inconv->sub_keys_leave_more_inconv);
$smarty->assign('sub_keys_leave_some', $obj_inconv->sub_keys_leave_some);
$smarty->assign('sub_keys_leave_some_inconv', $obj_inconv->sub_keys_leave_some_inconv);
$smarty->assign('sub_keys_leave_training', $obj_inconv->sub_keys_leave_training);
$smarty->assign('sub_keys_leave_training_inconv', $obj_inconv->sub_keys_leave_training_inconv);
$smarty->assign('sub_keys_leave_personal', $obj_inconv->sub_keys_leave_personal);
$smarty->assign('sub_keys_leave_personal_inconv', $obj_inconv->sub_keys_leave_personal_inconv);
$smarty->assign('sub_keys_leave_voluntary', $obj_inconv->sub_keys_leave_voluntary);
$smarty->assign('sub_keys_leave_voluntary_inconv', $obj_inconv->sub_keys_leave_voluntary_inconv);
$smarty->assign('sub_keys_leave_oncall', $obj_inconv->sub_keys_leave_oncall);
$smarty->assign('sub_keys_leave_oncall_inconv', $obj_inconv->sub_keys_leave_oncall_inconv);
$smarty->assign('sub_keys_leave_calltraining', $obj_inconv->sub_keys_leave_calltraining);
$smarty->assign('sub_keys_leave_calltraining_inconv', $obj_inconv->sub_keys_leave_calltraining_inconv);
$smarty->assign('sub_keys_leave_more_oncall', $obj_inconv->sub_keys_leave_more_oncall);
$smarty->assign('sub_keys_leave_more_oncall_inconv', $obj_inconv->sub_keys_leave_more_oncall_inconv);
$smarty->assign('sub_keys_leave_standby', $obj_inconv->sub_keys_leave_more_oncall);
$smarty->assign('sub_keys_leave_standby_inconv', $obj_inconv->sub_keys_leave_standby_inconv);
//$smarty->assign('sub_keys_leave', $sub_keys_leave);


$smarty->assign('rpt_content_normal', $obj_inconv->rpt_content_normal);
$smarty->assign('rpt_content_travel', $obj_inconv->rpt_content_travel);
$smarty->assign('rpt_content_break', $obj_inconv->rpt_content_break);
$smarty->assign('rpt_content_over', $obj_inconv->rpt_content_over);
$smarty->assign('rpt_content_quality', $obj_inconv->rpt_content_quality);
$smarty->assign('rpt_content_more', $obj_inconv->rpt_content_more);
$smarty->assign('rpt_content_some', $obj_inconv->rpt_content_some);
$smarty->assign('rpt_content_training', $obj_inconv->rpt_content_training);
$smarty->assign('rpt_content_personal', $obj_inconv->rpt_content_personal);
$smarty->assign('rpt_content_voluntary', $obj_inconv->rpt_content_voluntary);
$smarty->assign('rpt_content_complementary', $obj_inconv->rpt_content_complementary);
$smarty->assign('rpt_content_oncall', $obj_inconv->rpt_content_oncall);
$smarty->assign('rpt_content_calltraining', $obj_inconv->rpt_content_calltraining);
$smarty->assign('rpt_content_complementary_oncall', $obj_inconv->rpt_content_complementary_oncall);
$smarty->assign('rpt_content_more_oncall', $obj_inconv->rpt_content_more_oncall);
$smarty->assign('rpt_content_standby', $obj_inconv->rpt_content_standby);
$smarty->assign('rpt_content_dismissal', $obj_inconv->rpt_content_dismissal);
$smarty->assign('rpt_content_dismissal_oncall', $obj_inconv->rpt_content_dismissal_oncall);

$smarty->assign('rpt_content_leave', $obj_inconv->rpt_content_leave);
$smarty->assign('rpt_content_leave_travel', $obj_inconv->rpt_content_leave_travel);
$smarty->assign('rpt_content_leave_break', $obj_inconv->rpt_content_leave_break);
$smarty->assign('rpt_content_leave_over', $obj_inconv->rpt_content_leave_over);
$smarty->assign('rpt_content_leave_quality', $obj_inconv->rpt_content_leave_quality);
$smarty->assign('rpt_content_leave_more', $obj_inconv->rpt_content_leave_more);
$smarty->assign('rpt_content_leave_some', $obj_inconv->rpt_content_leave_some);
$smarty->assign('rpt_content_leave_training', $obj_inconv->rpt_content_leave_training);
$smarty->assign('rpt_content_leave_personal', $obj_inconv->rpt_content_leave_personal);
$smarty->assign('rpt_content_leave_voluntary', $obj_inconv->rpt_content_leave_voluntary);
$smarty->assign('rpt_content_leave_oncall', $obj_inconv->rpt_content_leave_oncall);
$smarty->assign('rpt_content_leave_calltraining', $obj_inconv->rpt_content_leave_calltraining);
$smarty->assign('rpt_content_leave_more_oncall', $obj_inconv->rpt_content_leave_more_oncall);
$smarty->assign('rpt_content_leave_standby', $obj_inconv->rpt_content_leave_standby);


$smarty->assign('comment_dates', !empty($obj_inconv->comment_dates) ? array_unique($obj_inconv->comment_dates) : array());

$smarty->assign('fkkn_slots', $obj_inconv->fkkn_slots);
// echo json_encode($obj_inconv->fkkn_slots);
// echo "s".strpos(json_encode($obj_inconv->fkkn_slots), "\"3\":");exit();

//echo "<pre>".print_r($obj_inconv->comment_dates, 1)."</pre>";exit();

//echo "<pre>".print_r($obj_inconv->sum_leave_normal_inconv, 1)."</pre>";

///////////////////////////////////////////////////////////////////////
$sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                    array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby) + array_sum($obj_inconv->sum_dismissal);

$sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall) + array_sum($obj_inconv->sum_dismissal_oncall);

$sum_total_leave = array_sum($obj_inconv->sum_leave_normal) + array_sum($obj_inconv->sum_leave_travel) + array_sum($obj_inconv->sum_leave_break) + array_sum($obj_inconv->sum_leave_over) + array_sum($obj_inconv->sum_leave_quality) +
                    array_sum($obj_inconv->sum_leave_more) + array_sum($obj_inconv->sum_leave_some) + array_sum($obj_inconv->sum_leave_training) + array_sum($obj_inconv->sum_leave_voluntary) + array_sum($obj_inconv->sum_leave_standby)+
                    array_sum($obj_inconv->sum_leave_oncall) + array_sum($obj_inconv->sum_leave_calltraining) + array_sum($obj_inconv->sum_leave_more_oncall);

$report_list[$passed_employee]['work_hours'] = array(
    'total_working'      => number_format($sum_total_normal+ $sum_total_oncall, 2, '.', ''),
    'total_leave'        => $sum_total_leave,
    'total_working_days'=> count($obj_inconv->days_in_month));

$smarty->assign('rpt_consolidated', json_encode($report_list));
///////////////////////////////////////////////////////////////////////


$login_user = $_SESSION['user_id'];
$login_user_role = $user->user_role($login_user);
$smarty->assign('login_user', $login_user);
$smarty->assign('login_user_role', $login_user_role);
//$smarty->assign('employee_report_entries', $result_set);

/*if ($user->check_SuperTL_or_not_from_team($login_user)) 
   $smarty->assign('is_suTL', TRUE);
else
   $smarty->assign('is_suTL', FALSE);*/
$smarty->assign('leave_types', $leave_type);

if ($passed_employee && $passed_year && $passed_month) {      //check if already signed or not
    $employee->username = $passed_employee;
    $employee->rpt_customer = $passed_customer;
    $employee->signing_report_date = $passed_year . '-' . $passed_month . '-1';
   // $works = $employee->employee_signing_existance_check();
   // $leaves = $employee->get_all_employee_leave($passed_employee, $passed_year, $passed_month);
   // $total_list = array_merge($works, $leaves);
    $sign_existance_flag = $employee->employee_signing_existance_check();
    // var_dump($sign_existance_flag); exit();
    if ($sign_existance_flag == 2)
        $smarty->assign('sign_status', "both");
    else if($sign_existance_flag == 1)
        $smarty->assign('sign_status', "true");
    else if ($sign_existance_flag == 0)
        $smarty->assign('sign_status', "false");
    
    $employee_signing_details = $employee->get_signin_details_by_employee_customer($passed_year, $passed_month, $passed_employee, $passed_customer);
  
    //echo "<pre>".print_r($employee_signing_details, 1)."</pre>"; exit();
    $smarty->assign('signing_details', $employee_signing_details[$passed_employee]);

    $have_fk_slots = FALSE;
    //echo '<pre>'.print_r($employee_slots, 1).'</pre>'; exit();
    if(!empty($employee_slots)){
        foreach($employee_slots as $es){
            if($es['fkkn'] == 1 && $es['status'] == 1){
                $have_fk_slots = TRUE;
                break;
            }
        }
    }
    $smarty->assign('allow_ordinary_signing', ($have_fk_slots && $passed_employee == $login_user && $login_user_role != 1 ? FALSE : TRUE));

    $isGLorAdmin = FALSE;
    if($_SESSION['user_role'] == 1)
        $isGLorAdmin = TRUE;
    elseif($_SESSION['user_role'] != 4) {
        $login_emp_role_in_customer = $employee->get_team_role_of_employee($_SESSION['user_id'], $passed_customer);
        $isGLorAdmin = (!empty($login_emp_role_in_customer) && $login_emp_role_in_customer['role'] == 7) ? TRUE : FALSE;
    }
    $smarty->assign('isGLorAdmin', $isGLorAdmin);
}

//echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
//first report employee should be sign b4 TL/suTL/admin will sign
$is_able_to_sign = FALSE;
if((empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$passed_employee]['signin_employee'] == '') && $passed_employee == $_SESSION['user_id']){
    $is_able_to_sign = TRUE;
//else if($passed_employee != $_SESSION['user_id'] && !empty($employee_signing_details) && $sign_existance_flag == 2)
}else if($passed_employee != $_SESSION['user_id'] && !empty($employee_signing_details) && (trim($employee_signing_details[$passed_employee]['signin_tl']) == '' || trim($employee_signing_details[$passed_employee]['signin_sutl']) == ''))
    $is_able_to_sign = TRUE;
$smarty->assign('is_able_to_sign', $is_able_to_sign);

// var_dump($is_able_to_sign);
// echo "$passed_employee<pre>".print_r($employee_signing_details, 1)."<pre>";
// exit();
//////////////////////////Finding any untreated leaves//////////////////////////////////////
//if($login_user_role == 3){  //only for employees logins
    $untreated_leaves = $obj_leave->check_untreated_employee_leave_in_a_customer($passed_employee, $yr, $month, $passed_customer);
    $smarty->assign('untreated_leaves', $untreated_leaves);
//}

//////////////////////////Finding any untreated Come and go slots//////////////////////////////////////
//if($login_user_role == 3){  //only for employees logins
    $untreated_candg_slots = $obj_inconv->check_untreated_candg_slots($passed_employee, $passed_customer, $month, $yr);
    $smarty->assign('untreated_candg_slots', $untreated_candg_slots);
//}    
    
$have_after_slots = $employee->check_timeslots_after_timestamp_in_the_month($passed_employee, $passed_customer, $month, $yr);
$smarty->assign('have_after_slots', $have_after_slots);
    
if($_SESSION['url_back_back'] == '')
    $_SESSION['url_back_back']= $_SERVER['HTTP_REFERER'];


//////////////////////////Calculate sem leave informations//////////////////////////////////////
$sem_leave_details_array = array();
$show_sem_leave = FALSE;

//get employee details
$company_details = $obj_company->get_company_detail($_SESSION['company_id']);
//echo "<pre>".print_r($company_details, 1)."</pre>";

if($company_details['sem_year_start_month'] != ''){
    $last_week = date("W", mktime(0,0,0,12,31,date('Y')));
    $no_of_weeks_in_a_year = 52;
    if($last_week == 53){
        $no_of_weeks_in_a_year = 53;
    }
    $show_sem_leave = TRUE;
    $sem_year_start_month = intval(trim($company_details['sem_year_start_month']));
    
    //get employee details
    $employee_details = $employee->get_employee_detail($passed_employee);
    //echo "<pre>".print_r($employee_details, 1)."</pre>";
    
    $leave_in_advance = FALSE;
    if($company_details['leave_in_advance'] == 1) $leave_in_advance = TRUE;
    else if($employee_details['leave_in_advance'] == 1) $leave_in_advance = TRUE;
    
    $include_sick_in_sem_calc = 1;
    $include_sick_in_sem_calc = $company_details['include_sick'];
    
    if($leave_in_advance){
        //Earned days for this Financial year
        $sem_start_date = ($passed_month >= $sem_year_start_month) ? date('Y-m-01', strtotime("$passed_year-$sem_year_start_month-01")) : date('Y-m-01', strtotime(($passed_year-1)."-$sem_year_start_month-01"));
        $sem_end_date = date('Y-m-t', strtotime("$passed_year-$passed_month-01"));
        $this_fyear_earned_days = $obj_timetable->get_earned_sem_leave_days($passed_employee, $sem_start_date, $sem_end_date, $no_of_weeks_in_a_year);
        
        //Taken no.of sem leave days for this Financial year
        $this_fyear_takens_sem_leave_days = $obj_timetable->get_taken_sem_leave_days($passed_employee, $sem_start_date, $sem_end_date);
        
        //find Former years remaining earned days
        $remaining_no_of_sem_leaves = trim($employee_details['remaining_sem_leave']) != '' ? $employee_details['remaining_sem_leave'] : 0;
        $remaining_sem_leaves_upto_date = (trim($employee_details['sem_leave_todate']) != '' && trim($employee_details['sem_leave_todate']) != NULL && trim($employee_details['sem_leave_todate']) != '0000-00-00') ? $employee_details['sem_leave_todate'] : NULL;
        
        $former_year_sem_start_date = NULL;
        if($remaining_sem_leaves_upto_date != NULL)
            $former_year_sem_start_date = date('Y-m-d', strtotime('+1 day', strtotime($remaining_sem_leaves_upto_date)));
        else if($employee_details['date'] != '')
            $former_year_sem_start_date = $employee_details['date'];    //activated date
        
        $former_year_earned_days = 0;
        $former_year_takens_sem_leave_days = 0;
        //echo $employee_details['username']."-".$former_year_sem_start_date."-".$former_year_sem_end_date;
        if($former_year_sem_start_date == NULL || ($former_year_sem_start_date != NULL && $former_year_sem_start_date <= date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date))))){
            $former_year_sem_end_date = date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date)));
            $former_year_earned_days = $obj_timetable->get_earned_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date, $no_of_weeks_in_a_year);
            
            //Taken no.of sem leave days from Former years
            $former_year_takens_sem_leave_days = $obj_timetable->get_taken_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date);
        }
        

        $former_year_remaining_days = $remaining_no_of_sem_leaves + max($former_year_earned_days - $former_year_takens_sem_leave_days, 0);
        
        //Minus this year takens leaves from former year remainings and this year earned leaves as per conditions
        if($this_fyear_takens_sem_leave_days > 0){
            $bal_this_fyear_takens_sem_leave_days = $this_fyear_takens_sem_leave_days;
            if($former_year_remaining_days > 0){
                if($former_year_remaining_days >= $bal_this_fyear_takens_sem_leave_days){
                    $former_year_remaining_days -= $bal_this_fyear_takens_sem_leave_days;
                    $bal_this_fyear_takens_sem_leave_days = 0;
                }else {
                    $former_year_remaining_days = 0;
                    $bal_this_fyear_takens_sem_leave_days -= $former_year_remaining_days;
                }  
            }
            
            if($bal_this_fyear_takens_sem_leave_days > 0 && $this_fyear_earned_days > 0){
                if($this_fyear_earned_days >= $bal_this_fyear_takens_sem_leave_days){
                    $this_fyear_earned_days -= $bal_this_fyear_takens_sem_leave_days;
                    //$bal_this_fyear_takens_sem_leave_days = 0;
                }else {
                    $this_fyear_earned_days = 0;
                    //$bal_this_fyear_takens_sem_leave_days -= $this_fyear_earned_days;
                }
            }
        }
        
        $sem_leave_details_array = array(
            'this_fyear_earned_days' => $this_fyear_earned_days,
            'this_fyear_takens_sem_leave_days' => $this_fyear_takens_sem_leave_days,
            'former_year_remaining_days' => $former_year_remaining_days
        );
    } else {
        //Earned days for this Financial year
        $sem_start_date_nA = ($passed_month >= $sem_year_start_month) ? date('Y-m-01', strtotime(($passed_year-1)."-$sem_year_start_month-01")) : date('Y-m-01', strtotime(($passed_year-2)."-$sem_year_start_month-01"));
        $sem_end_date_nA = date('Y-m-t', strtotime(($passed_year-1)."-$passed_month-01"));
        $this_fyear_earned_days = $obj_timetable->get_earned_sem_leave_days($passed_employee, $sem_start_date_nA, $sem_end_date_nA, $no_of_weeks_in_a_year);

        //Taken no.of sem leave days for this Financial year
        $sem_start_date = ($passed_month >= $sem_year_start_month) ? date('Y-m-01', strtotime("$passed_year-$sem_year_start_month-01")) : date('Y-m-01', strtotime(($passed_year-1)."-$sem_year_start_month-01"));
        $sem_end_date = date('Y-m-t', strtotime("$passed_year-$passed_month-01"));
        $this_fyear_takens_sem_leave_days = $obj_timetable->get_taken_sem_leave_days($passed_employee, $sem_start_date, $sem_end_date);

        //find Former years remaining earned days
        $remaining_no_of_sem_leaves = trim($employee_details['remaining_sem_leave']) != '' ? $employee_details['remaining_sem_leave'] : 0;
        $remaining_sem_leaves_upto_date = trim($employee_details['sem_leave_todate']) != '' ? $employee_details['sem_leave_todate'] : NULL;
        $former_year_sem_start_date = NULL;
        if($remaining_sem_leaves_upto_date != NULL)
            $former_year_sem_start_date = date('Y-m-d', strtotime('+1 day', strtotime($remaining_sem_leaves_upto_date)));
        else if($employee_details['date'] != '')    
            $former_year_sem_start_date = $employee_details['date'];    //activated date
        
        $former_year_earned_days = 0;
        $former_year_takens_sem_leave_days = 0;
        if($former_year_sem_start_date == NULL || ($former_year_sem_start_date != NULL && $former_year_sem_start_date <= date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date_nA))))){
            $former_year_sem_end_date = date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date_nA)));
            $former_year_earned_days = $obj_timetable->get_earned_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date, $no_of_weeks_in_a_year);

            //Taken no.of sem leave days from Former years
            $former_year_takens_sem_leave_days = $obj_timetable->get_taken_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date);
        }
        
        $former_year_remaining_days = $remaining_no_of_sem_leaves + max($former_year_earned_days - $former_year_takens_sem_leave_days, 0);
        
        //Minus this year takens leaves from former year remainings and this year earned leaves as per conditions
        if($this_fyear_takens_sem_leave_days > 0){
            $bal_this_fyear_takens_sem_leave_days = $this_fyear_takens_sem_leave_days;
            if($former_year_remaining_days > 0){
                if($former_year_remaining_days >= $bal_this_fyear_takens_sem_leave_days){
                    $former_year_remaining_days -= $bal_this_fyear_takens_sem_leave_days;
                    $bal_this_fyear_takens_sem_leave_days = 0;
                }else {
                    $former_year_remaining_days = 0;
                    $bal_this_fyear_takens_sem_leave_days -= $former_year_remaining_days;
                }  
            }
            
            if($bal_this_fyear_takens_sem_leave_days > 0 && $this_fyear_earned_days > 0){
                if($this_fyear_earned_days >= $bal_this_fyear_takens_sem_leave_days){
                    $this_fyear_earned_days -= $bal_this_fyear_takens_sem_leave_days;
                    //$bal_this_fyear_takens_sem_leave_days = 0;
                }else {
                    $this_fyear_earned_days = 0;
                    //$bal_this_fyear_takens_sem_leave_days -= $this_fyear_earned_days;
                }
            }
        }
        
        $sem_leave_details_array = array(
            'this_fyear_earned_days' => $this_fyear_earned_days,
            'this_fyear_takens_sem_leave_days' => $this_fyear_takens_sem_leave_days,
            'former_year_remaining_days' => $former_year_remaining_days
        );
    }
}
$smarty->assign('show_sem_leave', $show_sem_leave);
$smarty->assign('sem_leave_details', $sem_leave_details_array);
//echo "<pre>".print_r($sem_leave_details_array, 1)."</pre>";

//////////////////////////Calculate sem leave informations -  Endz/////////////////////////////////////

if($passed_month != '' && $passed_year != '') {
    $strtotime_prv_year_month = strtotime($passed_year .'-'. $passed_month . '-01' . ' -1 month');
    $strtotime_next_year_month = strtotime($passed_year .'-'. $passed_month . '-01' . ' +1 month');
    $smarty->assign('prv_month',    date('m', $strtotime_prv_year_month));
    $smarty->assign('prv_year',     date('Y', $strtotime_prv_year_month));
    $smarty->assign('next_month',   date('m', $strtotime_next_year_month));
    $smarty->assign('next_year',    date('Y', $strtotime_next_year_month));
    //$smarty->assign('report_month', $month);
    //$smarty->assign('report_year', $yr);
    //$month_name
    
    if($passed_employee != ''){
        $permitted_customers = $obj_cust->customers_list_for_employee_report(-1);
        $search_cust_ids = array();
        if(!empty($permitted_customers)){
            foreach($permitted_customers as $this_customer)
                $search_cust_ids[] = $this_customer['username'];
        }
        $list_customers = $employee->get_customers_with_tt_connected_previous($passed_employee, $passed_year, $passed_month);
        $list_customers = filter_customer_list_by_employee_have_work($employee, $list_customers, $passed_employee, $passed_year, $passed_month, $search_cust_ids);
        //echo "<pre>".print_r($list_customers, 1)."</pre>";
        $smarty->assign('list_customers', $list_customers);
    }
}


$leave_comments = $obj_leave->get_monthly_employee_leave_comments($passed_employee, $yr, $month);
// echo '<pre>'.print_r($leave_comments, 1).'</pre>'; exit();
$smarty->assign('leave_comments', $leave_comments);


$smarty->assign('message', $msg->show_message());
$smarty->display('extends:layouts/dashboard.tpl|employee_work_report_details.tpl');

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
                        //break;
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