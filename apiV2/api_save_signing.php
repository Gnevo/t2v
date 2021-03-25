<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
$smarty     = new smartySetup(array('messages.xml'), FALSE);
$user       = new user();
$employee   = new employee();

$month              = trim($_REQUEST['month']);
$year               = trim($_REQUEST['year']);
$report_employee    = trim($_REQUEST['employee']);
$report_customer    = trim($_REQUEST['customer']);
$employee->username = $report_employee;
$employee->rpt_customer         = $report_customer;
$employee->signing_report_date  = date('Y-m-d', strtotime("$year-$month-01"));

$obj = new stdClass();
$obj->session_status = $session_check;
$obj->transaction = FALSE;
if($_REQUEST['action'] == 'SAVE_PWORD_SIGNING'){
    $user->username     = strip_tags($_REQUEST['user']);
    $user->password     = urldecode(strip_tags($_REQUEST['password']));
    $user->company_id   = $_SESSION['company_id'];
    $cur_user           = $user->validate_secondary_login();
    if(!empty($cur_user)){
        if($employee->employee_signing_Transaction())
            $obj->transaction = TRUE;
        else
            $obj->transaction = FALSE;
    }else
        $obj->transaction = FALSE;
}
elseif($_REQUEST['action'] == 'DELETE_SIGNING'){
    
    if($employee->employee_signing_remove())
        $obj->transaction = TRUE;
    else
        $obj->transaction = FALSE;
}
echo json_encode($obj);
?>