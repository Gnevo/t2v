<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml"), FALSE);
$user = new user();
$employee = new employee();

$month  = trim($_POST['month']);
$year   = trim($_POST['year']);
$report_employee = trim($_POST['emp']);
$report_customer = trim($_POST['customer']);
$smarty->assign('report_month', $month);
$smarty->assign('report_year', $year);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));

$signing_message = '';
$transaction_flag = 'TRUE';

$user->username = strip_tags($_POST['UN']);
$user->password = strip_tags($_POST['PW']);

$employee->username = $report_employee;
$employee->rpt_customer = $report_customer;
$employee->signing_report_date = $year.'-'.$month.'-1';
    
$cur_user = $user->validate_login();
if($_SESSION['user_id'] == $user->username && !empty($cur_user)){
    
    if($employee->employee_signing_Transaction()){
//        $smarty->assign('flg',1);
//        $smarty->assign('insert',"true");
        $signing_message = $smarty->translate['signing_done_sucessfully'];
    }else{
//        $smarty->assign('flg',1);
//        $smarty->assign('insert',"false");
        $signing_message = $smarty->translate['error_occured_in_signing_try_again'];
        $transaction_flag = 'FALSE';
    }
}else{
    $signing_message = $smarty->translate['invalid_username_or_password'];
    $transaction_flag = 'FALSE';
//    $smarty->assign('flg',2);
}
    
$smarty->assign('uname',$_POST['UN']);
$smarty->assign('pword',$_POST['PW']);
$smarty->assign('transaction_flag', $transaction_flag);
$smarty->assign('signing_message',$signing_message);

$sign_existance_flag = $employee->employee_signing_existance_check();
if ($sign_existance_flag == 2)
    $smarty->assign('sign_status', "both");
else if($sign_existance_flag == 1)
    $smarty->assign('sign_status', "true");
else if ($sign_existance_flag == 0)
    $smarty->assign('sign_status', "false");
    
$employee_signing_details = $employee->get_signin_details_by_employee_customer($year, $month, $report_employee, $report_customer);
$smarty->assign('signing_details', $employee_signing_details[$report_employee]);

$login_user = $_SESSION['user_id'];
$smarty->assign('login_user', $login_user);
$smarty->assign('login_user_role',$user->user_role($login_user));

 if ($user->check_SuperTL_or_not_from_team($login_user)) 
    $smarty->assign('is_suTL', TRUE);
 else
    $smarty->assign('is_suTL', FALSE);
         
$smarty->display('ajax_employee_signing.tpl');
?>