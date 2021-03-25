<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/user.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();

$company_id = $_REQUEST['company_id'];
$_SESSION['db_name'] = $_REQUEST['db'];
$user->select_db($_SESSION['db_name']);

$user->username = $_REQUEST['user'];
$data = $user->get_employee_detail();
$log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
$_SESSION['log_id'] = $log_id;


if($company_id != NULL){
    $company_db_name = $user->get_company($company_id);
    $_SESSION['company_id']     = $company_db_name['id'];
    $_SESSION['company_sort_by']= $company_db_name['sort_name_by'];
}

$privileges_mc = $user->get_privileges($_REQUEST['user'], 3);
$privileges_general = $user->get_privileges($_REQUEST['user'], 2);
$privileges_rpt = $user->get_privileges($_REQUEST['user'], 5);

$obj = new stdClass();
$obj->first_name = $data['first_name'];
$obj->last_name = $data['last_name'];
$obj->log_id = $log_id;
$obj->privileges_mc = $privileges_mc;
$obj->privileges_rpt = $privileges_rpt;
$obj->privileges_general = $privileges_general;
$obj->candg_wi = $privileges_general['candg_wi'];
$obj->candg_wo = $privileges_general['candg_wo'];

//header("content-type: text/javascript");
echo json_encode($obj);
?>