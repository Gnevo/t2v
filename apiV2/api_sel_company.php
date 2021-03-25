<?php
require_once('api_common_functions.php');
$session_check = check_user_session(TRUE, FALSE);

require_once('class/setup.php');
require_once('class/user.php');
require_once('configs/config.inc.php');
global $cirrus_password_expiry;
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();

$company_id = $_REQUEST['company_id'];
$_SESSION['db_name'] = $_REQUEST['db'];
$user->select_db($_SESSION['db_name']);

$user->username = $_REQUEST['user'];
$data = $user->get_employee_detail();
$log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
$_SESSION['log_id'] = $log_id;


$create_date = $data['date'];
$date_after = strtotime(date("Y-m-d", strtotime($create_date)) . "+".$cirrus_password_expiry['expire']." month"); // calculating date after 6 month
$expire_days = floor(($date_after-strtotime(date('Y-m-d')))/(60*60*24));

if($company_id != NULL){
    $company_db_name = $user->get_company($company_id);
    $_SESSION['company_id']     = $company_db_name['id'];
    $_SESSION['company_sort_by']= $company_db_name['sort_name_by'];
}

$privileges_mc = $user->get_privileges($_REQUEST['user'], 3);
$privileges_general = $user->get_privileges($_REQUEST['user'], 2);
$privileges_rpt = $user->get_privileges($_REQUEST['user'], 5);
$privileges_gd = $user->get_privileges($_REQUEST['user'], 1);

$obj = new stdClass();
$obj->session_status = $session_check;
$obj->first_name = $data['first_name'];
$obj->last_name = $data['last_name'];
$obj->log_id = $log_id;
$obj->privileges_mc = $privileges_mc;
$obj->privileges_rpt = $privileges_rpt;
$obj->privileges_general = $privileges_general;
$obj->privileges_gd = $privileges_gd;
$obj->candg_wi = $privileges_general['candg_wi'];
$obj->candg_wo = $privileges_general['candg_wo'];
$obj->candg_wo = $privileges_general['candg_wo'];
$obj->expire_days = $expire_days;
$obj->expire_days_actual = $cirrus_password_expiry['show_expiry'] + 1;
$obj->company_sort_by = $company_db_name['sort_name_by'];
//header("content-type: text/javascript");
echo json_encode($obj);
?>