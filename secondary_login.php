<?php
//$cookie_name = "user";
//$cookie_value = "Alex Porter";
//setcookie($cookie_name, $cookie_value);

//if(!isset($_COOKIE[$cookie_name])) {
//    echo "Cookie named '" . $cookie_name . "' is not set!";
//} else {
//    echo "Cookie '" . $cookie_name . "' is set!<br>";
//    echo "Value is: " . $_COOKIE[$cookie_name];
//}
//exit();

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/company.php');
require_once('plugins/message.class.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array("messages.xml", "user.xml", "button.xml"), FALSE);
$user = new user();
$obj_company = new company();
$messages = new message();
global $cirrus_password_expiry;

$currentFile = rtrim($_SERVER['PHP_SELF'], "/");
$parts = explode('/', $currentFile);
$page_name = $parts[count($parts) - 1];
$no_of_paswd_try = 8;
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    header("Location: " . $smarty->url);
    exit();
} 

//echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
//            echo "<pre>".print_r($cur_user, 1)."</pre>"; exit();
//else if ($_SESSION['company_id'] == '' && $page_name != '' && $page_name != 'secondary_login.php') {
//    header("Location: " . $smarty->url . "select/company/");
//    exit();
//}

$companies = $user->get_user_companies($_SESSION['user_id']);
$cur_user_last_login = $user->get_user_last_login($_SESSION['user_id']);
//$agreement = (strtotime($cur_user_last_login) > strtotime('2018-05-25 13:00:00')) ? 0 : 1;
//$smarty->assign('agreement', !(strtotime($cur_user_last_login) > strtotime('2018-05-25 13:00:00')));
$smarty->assign('agreement', (strtotime($cur_user_last_login) > strtotime('2018-05-25 13:00:00')));
//$smarty->assign('agreement', $agreement);

if(!isset($_COOKIE["login_data"])) {
  $l_cookie = 0;
} else {
  $l_cookie = 1;
}

$smarty->assign('login_cookie', $l_cookie);

$redirect_url = '';
if (isset($_GET['redirect']) && $_GET['redirect'] != ''){
    $redirect_url = $_GET['redirect'];
    $smarty->assign('redirect', urlencode($redirect_url));
}

//echo "<pre>".print_r($_COOKIE, 1)."</pre>";

if (!empty($_POST['password'])) {
    $root_access = (isset($_POST['rtacc']) && $_POST['rtacc'] == "TRUE" ? TRUE : FALSE);
    
    $user->username = $root_access ? strip_tags($_POST['username']) : strip_tags($_SESSION['user_id']);
    $user->password = strip_tags($_POST['password']);
    //    $user->company_id = strip_tags($_SESSION['company_id']);
    $user->company_id = strip_tags($_POST['user_company']);
    $cur_username_main_login = $user->validate_username();
    
    if ($cur_username_main_login['role'] == 0 || ($cur_username_main_login['role'] != 0 && $user->company_id != '')) {
       
        $_SESSION['user_id']    = $user->username;
        $_SESSION['user_role']  = $cur_username_main_login['role'];
        
        if ($cur_username_main_login['role'] == 0) {  //root user login
            $cur_user = $user->validate_login();
            if (!empty($cur_user)) {
                $cur_user['last_pw_update_date'] = $cur_user['date'];
                $cur_user['last_login_time'] = $cur_user['last_time'];
            }
        } else{
            $cur_user = $user->validate_secondary_login($root_access ? 'rtacc' : NULL);
        }

        if (!empty($cur_user)) {    //if valid user do following
            
            $company_id = $user->company_id;
            $company_details = $user->get_company($company_id);
            // echo '<pre>'.print_r($company_details, 1).'</pre>'; exit();
            if ($company_details['db_name'] != '') {
                $_SESSION['db_name']        = $company_details['db_name'];
                $_SESSION['company_id']     = $company_id;
                $_SESSION['company_sort_by']= $company_details['sort_name_by'];
                $_SESSION['lang']           = $company_details['language'];
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
                    else{
                        if($user->username != 'gine001' && $user->username != 'thne001')
                            $error_active = 1;
                    }
                } else {
                    $user_data = $cur_username_main_login['username'];
                }
            }
            $_SESSION['user_name'] = $user_data;

                //            echo "<pre>".print_r($user_data, 1)."</pre>";exit();
                //        $_SESSION['secondary_login'] = TRUE;
            if($error_active == 1){
                $_SESSION['inactive_user'] = "1";
                $messages->set_message('fail', 'user_inactive');
            }
            else if($company_details['status'] === 0 || $company_details['status'] === '0'){
                $messages->set_message('fail', 'company_inactive');
            }

            else if ($cur_user['last_login_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $date_after) && !$root_access) {
                $_SESSION['secondary_login'] = TRUE;
                $_SESSION['secondary_auth'] = TRUE;

                $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                $_SESSION['log_id'] = $log_id;

                //            $user->login = '1';
                //            $user->reset_login();


                header("Location: " . $smarty->url . "change/password/");
                exit();
            } elseif ($cur_user['last_login_time'] != '0000-00-00 00:00:00' && $cur_user['error'] < $no_of_paswd_try) {

                if ($_SESSION['user_role'] == 0) {
                    $user_data = $cur_user['username'];
                    $_SESSION['user_name'] = $user_data;

                    $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['log_id'] = $log_id;

                    $_SESSION['secondary_auth'] = TRUE;
                    $user->login = '1';
                    $user->reset_login();
                    if ($cur_user['error'] != '0') {
                        $error = $user->reset_error();
                    }
                    setcookie("login_data", "Login", time() + (86400 * 30), "/"); 
                    header("Location: " . $smarty->url . "dashboard/");
                    exit();
                } else {
                    if ($cur_user['error'] != '0') {
                        $error = $user->reset_secondary_login_error();
                    }
                    $_SESSION['secondary_auth'] = TRUE;

                    $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['log_id'] = $log_id;

                    $user->login = '1';
                    $user->reset_login(TRUE);

                    if (isset($_SESSION['company_change_access']))
                        unset($_SESSION['company_change_access']);
                    if (isset($_SESSION['previous_selected_company_details']))
                        unset($_SESSION['previous_selected_company_details']);
                    
                    setcookie("login_data", "Login", time() + (86400 * 30), "/");
                    
                    if ($redirect_url != '')
                        header("Location: " . urldecode($redirect_url));
                    else{
                        if(isset($_COOKIE['startup_summery_view']) && $_COOKIE['startup_summery_view'] == 'employee')
                            header("Location: " . $smarty->url . "all/employee/gdschema/l/1/");
                        else
                            header("Location: " . $smarty->url . "all/gdschema/l/1/");
                    }
                    exit();
                }
            } elseif ($cur_user['last_login_time'] != '0000-00-00 00:00:00' && $cur_user['error'] >= $no_of_paswd_try) {
                //$messages->set_message('fail', 'contact_administrator');
                $messages->set_message('fail', 'login_blocked_click_on_reset_password');
                /*if ($redirect_url != '')
                    header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                else
                    header("Location: " . $smarty->url . "secondary/login/");
                exit();*/
            }
        }
        else {  //if not valid user
            $cur_user_main = $user->validate_username();

            $cur_username = $user->validate_secondary_login_username();
            if (!empty($cur_user_main) && ($cur_user_main['role'] == 0 || !empty($cur_username))) {
                if ($cur_username['password'] != NULL || $cur_user_main['role'] == 0) {

                    if ($cur_user_main['role'] == 0) {   //root user
                        $user->username = $cur_user_main['username'];
                        $user->error = $cur_user_main['error'];
                        if (md5($smarty->hash . strip_tags($_POST['password'])) != $cur_user_main['password']) {

                            if ($cur_user_main['last_time'] != '0000-00-00 00:00:00') {
                                $set_error = $user->set_error();
                            }

                            $messages->set_message('fail', 'invalid_Password_remainig_try');
                            /*if ($redirect_url != '')
                                header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                            else
                                header("Location: " . $smarty->url . "secondary/login/");
                            exit();*/
                        }
                    }
                    else {
                        $user->username = $cur_username['username'];
                        $user->error = $cur_username['error'];
                        if (md5($smarty->hash . strip_tags($_POST['password'])) != $cur_username['password']) {

                            if ($cur_username['last_login_time'] != '0000-00-00 00:00:00') {
                                $set_error = $user->set_secondary_login_error();
                            }

                            
                            if($user->error < $no_of_paswd_try){
                                $messages->set_message('fail', 'invalid_Password_remainig_try');
                                $messages->set_message_exact('fail', ': '.($no_of_paswd_try - $user->error - 1));
                            }
                            else
                                $messages->set_message('fail', 'login_blocked_click_on_reset_password');

                            /*if ($redirect_url != '')
                                header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                            else
                                header("Location: " . $smarty->url . "secondary/login/");
                            exit();*/
                        }
                    }
                } else {
                    $messages->set_message('fail', 'contact_administrator');
                    /*if ($redirect_url != '')
                        header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "secondary/login/");
                    exit();*/
                }
            } else {
                $messages->set_message('fail', 'invalid_user');
                /*if ($redirect_url != '')
                    header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                else
                    header("Location: " . $smarty->url . "secondary/login/");
                exit();*/
            }
        }
    }
}
else if(isset($_POST) && isset($_POST['password']) && $_POST['password'] === ''){
    $messages->set_message('fail', 'password_should_not_blank');
}

$smarty->assign('user_companies', $companies);
$user_have_multiple_company = count($companies) > 1 ? TRUE : FALSE;
//var_dump($user_have_multiple_company);exit();
$smarty->assign('user_have_multiple_company', $user_have_multiple_company);
//echo "<pre>".print_r($companies, 1)."</pre>";

if(count($companies) == 1){
    $company_id = $companies[0]['id'];
    $company_details = $obj_company->get_company_detail($company_id);
    $smarty->assign('company_details', $company_details);
    $smarty->assign('sel_company_id', $company_id);
}

//$company_details = $obj_company->get_company_detail($_aSESSION['company_id']);
//$smarty->assign('company_details', $company_details);
$smarty->assign('message', $messages->show_message());
$smarty->assign('cancel_button', isset($_SESSION) && isset($_SESSION['previous_selected_company_details']) ? TRUE : FALSE);

$smarty->assign('current_user_role', $_SESSION['user_role']);
//echo "<pre>".print_r($company_details, 1)."</pre>";
//setting layout and page
$smarty->display('extends:layouts/login.tpl|secondary_login.tpl');
?>