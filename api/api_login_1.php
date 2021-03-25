<?php
//ini_set('display_errors', true);
//ini_set('xdebug.var_display_max_depth', 10);
//error_reporting(E_ALL ^ E_NOTICE);
session_name('t2v-cirrus');
session_start('t2v-cirrus');

$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
//echo getcwd().'<br/>';
chdir ($app_dir);
//echo getcwd();

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
//
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
global $db;
//$user->db_master = "t2v_cirrus_common";
//$user->db_master = "time2vie_cirruscomdemo";
$user->db_master = $db['database_master'];
$user->username = $_REQUEST['user'];
$user->password = $_REQUEST['passw'];
$data = $user->validate_login();

$obj = new stdClass();
if($data) {
	$_SESSION['user_id'] = $user->username;
	$obj->company_ids = $data['company_ids'];
	$obj->access = $data['role'];
	$obj->date = $data['date'];
	$obj->lasttime = $data['last_time'];
        $obj->error = 0;
        $user->login = '1';
        $user->reset_login();
        if ($data['error'] != '0') {
            $error = $user->reset_error();
        }
}
else 
	$obj->error = 1;

$obj->my_session = session_id();
$obj->my_session_name = session_name();
//$obj->my_session = $_COOKIE;
//header("content-type: text/javascript");
echo json_encode($obj);
?>