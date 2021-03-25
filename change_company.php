<?php

require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array(), FALSE);
$user = new user();
$messages = new message();


if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ''){
    header("Location: " . $smarty->url);
    exit();
}

$redirect_url = '';
if (isset($_GET['redirect']) && $_GET['redirect'] != '')
    $redirect_url = $_GET['redirect'];

if (isset($_POST['user_company']) && $_POST['user_company'] != '') {

    if(isset($_SESSION['secondary_auth'])) unset($_SESSION['secondary_auth']);
    
    $company_id = $_POST['user_company'];
    $company_details = $user->get_company($company_id);
    if ($company_details['db_name'] != '') {
        $_SESSION['company_change_access']= TRUE;
        $_SESSION['previous_selected_company_details']= array(
            'db_name'           => $_SESSION['db_name'],
            'company_id'        => $_SESSION['company_id'],
            'company_sort_by'   => $_SESSION['company_sort_by'],
            'lang'              => $_SESSION['lang']
        );
        
        $_SESSION['db_name']        = $company_details['db_name'];
        $_SESSION['company_id']     = $company_id;
        $_SESSION['company_sort_by']= $company_details['sort_name_by'];
        $_SESSION['lang']           = $company_details['language'];
        
    }
    
}
else if (isset($_POST['action']) && $_POST['action'] == 'cancel_selection' && $_SESSION['company_change_access'] && !empty($_SESSION['previous_selected_company_details'])) {
    
    $_SESSION['db_name']        = $_SESSION['previous_selected_company_details']['db_name'];
    $_SESSION['company_id']     = $_SESSION['previous_selected_company_details']['company_id'];
    $_SESSION['company_sort_by']= $_SESSION['previous_selected_company_details']['company_sort_by'];
    $_SESSION['lang']           = $_SESSION['previous_selected_company_details']['lang'];
    
    $_SESSION['secondary_auth'] = TRUE;
    unset($_SESSION['company_change_access']);
    unset($_SESSION['previous_selected_company_details']);
    
    if(isset($_COOKIE['startup_summery_view']) && $_COOKIE['startup_summery_view'] == 'employee')
        header("Location: " . $smarty->url . "all/employee/gdschema/l/1/");
    else
        header("Location: " . $smarty->url . "all/gdschema/l/1/");
    exit();
}

//echo "<pre>QUERY_STRING".print_r($_SERVER['QUERY_STRING'], 1)."</pre>"; exit();
if (!empty($_SERVER['QUERY_STRING'])) {
    
    $user->username = $_SESSION['user_id'];
    $user->company_id = $_SESSION['company_id'];
    $cur_user = $user->validate_secondary_login_username();
    $cur_username_main_login = $user->validate_username();

    $create_date = $cur_user['last_pw_update_date'];
    $date_after = strtotime(date("Y-m-d", strtotime($create_date)) . "+6 month"); // calculating date after 3 month

    $user->select_db($_SESSION['db_name']);
    $user->clear_temp_session();
    $error_active = 0;
    $user_detail = array();
    if ($cur_username_main_login['role'] == '4') {
        $user_detail = $user->get_customer_detail();
        $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
    } else {
        $user_detail = $user->get_employee_detail();
        if (!empty($user_detail)) {
            if ($user_detail['status'] == '1')
                $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
            else
                $error_active = 1;
        } else {
            $user_data = $cur_user['username'];
        }
    }

    if ($error_active == 0) {
        $_SESSION['user_name'] = $user_data;
        if (isset($user_detail['language']) && $user_detail['language'] != "") {
            $_SESSION['lang'] = $user_detail['language'];
        }
        $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
        $_SESSION['log_id'] = $log_id;

        if ($cur_user['last_login_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $date_after)) {
            $_SESSION['secondary_login'] = TRUE;
            $_SESSION['secondary_auth'] = TRUE;
            
            $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
            $_SESSION['log_id'] = $log_id;
            
            header("Location: " . $smarty->url . "change/password/");
            exit();
        } elseif ($cur_user['last_login_time'] != '0000-00-00 00:00:00' && $cur_user['error'] < '4') {
            $user->login = '1';
            $user->reset_login(TRUE);
            if ($cur_user['error'] != '0') {
                $error = $user->reset_error();
            }
//            header("Location: " . $smarty->url . "gdschema/");
            if ($redirect_url != '')
                header("Location: " . urldecode($redirect_url));
            else{
//                header("Location: " . $smarty->url . "all/gdschema/l/1/");
                header("Location: " . $smarty->url . "secondary/login/");
            }
            exit();
        } elseif ($cur_user['last_login_time'] != '0000-00-00 00:00:00' && $cur_user['error'] > '3') {

            $messages->set_message('fail', 'contact_administrator');
            header("Location: " . $smarty->url . "secondary/login/");
            exit();
        }
    } else {
        $messages->set_message('fail', 'user_inactive');
        header("Location: " . $smarty->url . "secondary/login/");
        exit();
    }
} else {
    $_SESSION['flag_gd'] = 1;
//    header('Location: ' . $smarty->url . 'all/gdschema/l/1/');
    header('Location: ' . $smarty->url . 'secondary/login/');
    exit();
}
?>