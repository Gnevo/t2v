<?php
//ini_set('display_errors', true);
//ini_set('xdebug.var_display_max_depth', 10);
//error_reporting(E_ALL ^ E_NOTICE);
session_name('t2v-cirrus');
session_start('t2v-cirrus');

$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
require_once('configs/config.inc.php');
global $cirrus_password_expiry;
//
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$messages = new message();
global $db, $customer_location_settings;
//$user->db_master = "t2v_cirrus_common";
//$user->db_master = "time2vie_cirruscomdemo";

$obj = new stdClass();
$process_flag = TRUE;

$user->username     = strip_tags(trim($_REQUEST['user_id']));
$user->password     = urldecode(strip_tags($_REQUEST['password']));
$user->company_id   = strip_tags(trim($_REQUEST['user_company']));


if($user->username == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_username');
    $obj->error_message = $messages->show_message_exact();
}
else if($user->password == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'invalid_password');
    $obj->error_message = $messages->show_message_exact();
}
else if($user->company_id == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'invalid_company');
    $obj->error_message = $messages->show_message_exact();
}

if ($process_flag) {
        //    $companies = $user->get_user_companies($user->username);
        $cur_username_main_login= $user->validate_username();
        $cur_user               = $user->validate_secondary_login();
        //if valid user do following
        if (!empty($cur_user)) {
            $_SESSION['user_id']    = $cur_username_main_login['username'];
            // $_SESSION['user_id1']    = $cur_username_main_login['username'];
            $_SESSION['user_role']  = $cur_username_main_login['role'];
            $company_id = $user->company_id;
            $company_details = $user->get_company($company_id);
            if ($company_details['db_name'] != '') {
                
                $_SESSION['db_name'] = $company_details['db_name'];
                $_SESSION['company_id'] = $company_id;
                $_SESSION['company_sort_by'] = $company_details['sort_name_by'];
                $_SESSION['lang'] = $company_details['language'];
                
                $obj->company_id    = $company_details['id'];
                $obj->company_db    = $company_details['db_name'];
                $obj->company_name  = $company_details['name'];
            }
            $user->select_db($_SESSION['db_name']);

            $create_date = $cur_user['last_pw_update_date'];
            $date_after = strtotime(date("Y-m-d", strtotime($create_date)) . "+".$cirrus_password_expiry['expire']." month"); // calculating date after 6 month
            $error_active = 0;

            if ($cur_username_main_login['role'] == '4') {
                $user_detail = $user->get_customer_detail();
                if (!empty($user_detail)) {
                    if ($user_detail['status'] == '1')
                        $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                    else
                        $error_active = 1;
                }
            } else {
                $user_detail = $user->get_employee_detail();
                if (!empty($user_detail)) {
                    if ($user_detail['status'] == '1' || $user_detail['is_genuine'] == '0')
                        $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                    else
                        $error_active = 1;
                } else {
                    $user_data = $cur_username_main_login['username'];
                }
            }
            $_SESSION['user_name'] = $user_data;
            if($error_active == 1){
                $_SESSION['inactive_user'] = "1";
                $messages->set_message('fail', 'user_inactive');
                $process_flag = FALSE;
                $obj->error = 1;
                $obj->error_message = $messages->show_message_exact();
            }
            else if ($cur_user['last_login_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $date_after)) {
                $_SESSION['secondary_login'] = TRUE;
                $_SESSION['secondary_auth'] = TRUE;

                $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                $_SESSION['log_id'] = $log_id;

                $obj->error = 0;
                $obj->redirect = 'PWORD_CHANGE';
                $obj->customer_location_radius = $customer_location_settings['max_radius'];
            }
            elseif ($cur_user['last_login_time'] != '0000-00-00 00:00:00' && $cur_user['error'] < '4') {

                $error = $user->reset_secondary_login_error();
                $_SESSION['secondary_auth'] = TRUE;

                $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                $_SESSION['log_id'] = $log_id;

                $user->login = '1';
                $user->reset_login(TRUE);
                $obj->error = 0;
                $obj->redirect = 'DASH';
                $obj->log_id = $log_id;
                $obj->customer_location_radius = $customer_location_settings['max_radius'];
                
                
                $obj->first_name = $user_detail['first_name'];
                $obj->last_name = $user_detail['last_name'];
                
                $_SESSION['login_via'] = 'MOBILE-APP';
                $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
                //            $obj->company_ids = $data['company_ids'];
                $obj->access    = $cur_username_main_login['role'];
                $obj->user_role = $cur_username_main_login['role'];
                $obj->date      = $cur_user['last_pw_update_date'];
                $obj->lasttime  = $cur_user['last_login_time'];
                
                $privileges_mc      = $user->get_privileges($user->username, 3);
                $privileges_general = $user->get_privileges($user->username, 2);
                $privileges_rpt     = $user->get_privileges($user->username, 5);
                $privileges_gd      = $user->get_privileges($user->username, 1);
                
                $obj->privileges_mc     = $privileges_mc;
                $obj->privileges_rpt    = $privileges_rpt;
                $obj->privileges_general= $privileges_general;
                $obj->privileges_gd     = $privileges_gd;
                $obj->candg_wi      = $privileges_general['candg_wi'];
                $obj->candg_wo      = $privileges_general['candg_wo'];
                $obj->candg         = $company_details['candg'];
                $obj->candg_on      = $privileges_general['candg_on'];
                $obj->candg_break   = $company_details['candg_break'];

		if($company_details['candg_on'] == 0){
                    $obj->candg = 0;
                }elseif ($privileges_general['candg_on'] == 0) {
                    $obj->candg = 0;
                }
                
                
                $obj->expire_days = floor(($date_after-strtotime(date('Y-m-d')))/(60*60*24));
                $obj->expire_days_actual = $cirrus_password_expiry['show_expiry'] + 1;
                $obj->company_sort_by = $obj->sort_name_by = $company_details['sort_name_by'];
                $obj->companies = $user->get_user_companies($user->username);
        } 
        elseif ($cur_user['last_login_time'] != '0000-00-00 00:00:00' && $cur_user['error'] > '3') {
            $messages->set_message('fail', 'contact_administrator');
            $process_flag = FALSE;
            $obj->error = 1;
            $obj->error_message = $messages->show_message_exact();
        }
    }
    else {  //if not valid user
        $cur_user_main = $user->validate_username();
        $cur_username = $user->validate_secondary_login_username();
        if (!empty($cur_user_main) && !empty($cur_username)) {
            if ($cur_username['password'] != NULL) {

                $user->username = $cur_username['username'];
                $user->error = $cur_username['error'];
                if (md5($smarty->hash . strip_tags($_POST['password'])) != $cur_username['password']) {

                    if ($cur_username['last_login_time'] != '0000-00-00 00:00:00') {
                        $set_error = $user->set_secondary_login_error();
                    }
                    $messages->set_message('fail', 'invalid_password');
                    $process_flag = FALSE;
                    $obj->error = 1;
                    $obj->error_message = $messages->show_message_exact();
                }
            } else {
                $messages->set_message('fail', 'contact_administrator');
                $process_flag = FALSE;
                $obj->error = 1;
                $obj->error_message = $messages->show_message_exact();
            }
        } else {
            $messages->set_message('fail', 'invalid_user');
            $process_flag = FALSE;
            $obj->error = 1;
            $obj->error_message = $messages->show_message_exact();
        }
    }
}
$obj->my_session = session_id();
$obj->my_session_name = session_name();
$obj->cookies = $_COOKIE;
$obj->version_code = 28;
$obj->version_name = "3.6.1";
$obj->ios_version = "3.5.1";
$obj->ios_update_flag = 1;
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
echo json_encode($obj);
?>
