<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/dona.php');
require_once('configs/config.inc.php');
require_once('class/customer.php');
require_once('class/leave.php');
require_once('class/inconvenient.php');
require_once('class/report_signing.php');
require_once('plugins/message.class.php');
//require_once('class/general.php');

$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml","month.xml"), FALSE);
$user = new user();
$employee = new employee();
$dona = new dona();
$obj_cust = new customer();
$obj_leave = new leave();
$obj_inconv = new inconvenient();
$msg = new message();
$obj_rpt    = new report_signing();
//$obj_general = new general();
global $month;
global $bank_id;

$multiple_single = trim($_REQUEST['multiple_single']);
$report_customer = trim($_REQUEST['customer']);
$customer_name = trim($_REQUEST['customer_name']);
$security_no = trim($_REQUEST['security_no']);
$report_employee = trim($_REQUEST['emp']);

$current_day = date('Y').'-'.date('m').'-'.date('d');
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));
$smarty->assign('now_day', date('d'));
$hour_min = date('H:i');

$signing_message = '';
$transaction_flag = 'TRUE';

$_SESSION['url_back_back'] = '';
unset($_SESSION['url_back_back']);

$user->company_id = strip_tags($_SESSION['company_id']);
$employee->username = $report_employee;
//echo $employee->username;exit();
$employee->rpt_customer = $report_customer;
$employee->report_date = $current_day;


if($multiple_single != "multiple"){
    if($employee->employee_signing_remove_3066()){
        $arr['status'] = 'success';
        $msg->set_message('success', 'employee_signing_removed_successfully');
    }else{
        $msg->set_message('fail', 'employee_signing_remove_failed');
        $arr['status'] = 'fail';
    // $msg->set_message_exact('fail', "<pre>".print_r($employee->query_error_details, 1)."</pre>");
    }
}else{
    if($employee->employee_signing_remove_3066_multiple()){
        $arr['status'] = 'success';
        $msg->set_message('success', 'employee_signing_removed_successfully');
    }else{
        $msg->set_message('fail', 'employee_signing_remove_failed');
        $arr['status'] = 'fail';
    // $msg->set_message_exact('fail', "<pre>".print_r($employee->query_error_details, 1)."</pre>");
    }

}
echo json_encode($arr);                   

?>