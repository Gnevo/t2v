<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once('class/general.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml", "mail.xml"));
$date = new datecalc();
$employee = new employee();
$customer = new customer();
$msg = new message();
$leave = new leave();
$obj_general = new general();

//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('message', $msg->show_message()); //messages of actions
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);


$privilege_mc = $employee->get_privileges($_SESSION['user_id'], 3);
$smarty->assign('privilege_mc', $privilege_mc);
if($privilege_mc['sms'] != 1){
    $msg->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

/*if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

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
}*/
//$month = date('m');
//$year = date('Y');
$year = '';
$month = '';
if($_REQUEST['month']){
    $month = $_REQUEST['month'];
}
if($_REQUEST['year']){
    $year = $_REQUEST['year'];
}
$smarty->assign("month", $month);
$smarty->assign("year", $year);
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
//echo "<pre>\n".print_r($leave->get_all_employee_leave($year, $month,0,0), 1)."</pre>";
if($year != '' && $month != '')
    $smarty->assign('leave_details', $leave->get_all_employee_leave($year, $month,0,0)); //messages of actions
$smarty->assign('report_year',$year);

//setting layout and page
$smarty->display('extends:layouts/dashboard.tpl|leave_sms_system.tpl');
?>