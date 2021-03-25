<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml"), FALSE);
$user = new user();
$employee = new employee();

$month  = trim($_REQUEST['month']);
$year   = trim($_REQUEST['year']);
$report_employee = trim($_REQUEST['employee']);
$report_customer = trim($_REQUEST['customer']);
$user->username = strip_tags($_REQUEST['user']);
$user->password = strip_tags($_REQUEST['password']);
$employee->username = $report_employee;
$employee->rpt_customer = $report_customer;
$employee->signing_report_date = $year.'-'.$month.'-01';
$cur_user = $user->validate_login();
$user_role = $user->user_role($_REQUEST['user']);

$i=0;    
$obj = array();
if($_REQUEST['type'] == 'sav'){
    if(!empty($cur_user)){
        if($employee->employee_signing_Transaction()){
            $obj[$i]->transaction = 'success';
        }else{
            $obj[$i]->transaction = 'fail';
        }
    }else{
        $obj[$i]->transaction = 'fail';
    }
}else{
    
    $employee->username = $report_employee;
    $employee->rpt_customer = $report_customer;
    $employee->signing_report_date = $year.'-'.$month.'-1';
    if($employee->employee_signing_remove()){
        $obj[$i]->transaction = 'success';
    }else{
        $obj[$i]->transaction = 'fail';
    }
    
    
}

//header("content-type: text/javascript");
echo json_encode($obj);
?>