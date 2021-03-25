<?php
require_once('class/setup.php');
require_once('plugins/message.class.php');
require_once('class/user.php');
$smarty = new smartySetup(array("messages.xml","user.xml"),FALSE);
$user = new user();
$messages = new message();

if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ''){
    header("Location: " . $smarty->url);
    exit();
}

if (isset($_POST['user_company']) && $_POST['user_company'] != '') {
    
    if(isset($_SESSION['secondary_auth'])) unset($_SESSION['secondary_auth']);
    
    $company_id = $_POST['user_company'];
    $company_details = $user->get_company($company_id);
    if ($company_details['db_name'] != '') {
        $_SESSION['db_name']        = $company_details['db_name'];
        $_SESSION['company_id']     = $company_id;
        $_SESSION['company_sort_by']= $company_details['sort_name_by'];
        $_SESSION['lang']           = $company_details['language'];
    }
    
    if ($redirect_url != '')
        header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
    else
        header("Location: " . $smarty->url . "secondary/login/");
    exit();
}

$redirect_url = '';
if(isset($_GET['redirect']) && $_GET['redirect'] != ''){
    $redirect_url = $_GET['redirect'];
    $smarty->assign('redirect', urlencode($redirect_url));
}

$companies = $user->get_user_companies($_SESSION['user_id']);
//echo "<pre>".print_r($companies, 1)."</pre>"; exit();
if(count($companies) == 1){
    $company_id = $companies[0]['id'];
    $company_details = $user->get_company($company_id);
//    echo "<pre>".print_r($company_details, 1)."</pre>"; exit();
    if($company_details['db_name'] != ''){
        $_SESSION['db_name'] = $company_details['db_name'];
        $_SESSION['company_id'] = $company_id;
        $_SESSION['company_sort_by'] = $company_details['sort_name_by'];
        $_SESSION['lang'] = $company_details['language'];
        $_SESSION['company_id'] = $company_details['id'];
    }
    $user->select_db($_SESSION['db_name']);
    /*$user->username = $_SESSION['user_id'];
    $cur_user = $user->validate_username();

    $create_date = $cur_user['date'];
    $date_after = strtotime(date("Y-m-d", strtotime($create_date)) . "+6 month"); // calculating date after 3 month

    $user->clear_temp_session();
    $user_detail =  array();
    if ($cur_user['role'] == '4') {
        $user_detail = $user->get_customer_detail();
        $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
    } else {
        $user_detail = $user->get_employee_detail();
        if (!empty($user_detail)) {
            $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
        } else {
            $user_data = $cur_user['username'];
        }
    }
    if(isset($user_detail['language']) && $user_detail['language'] != ''){
        $_SESSION['lang'] = $user_detail['language'];
    }
    $_SESSION['user_name'] = $user_data;
    $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
    $_SESSION['log_id'] = $log_id;

    if ($cur_user['last_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $date_after)) {
        //header("Location: " . $smarty->url . "change/password/");
    } elseif ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] < '4') {
        $user->login = '1';
        $user->reset_login();
        if ($cur_user['error'] != '0') {
            $error = $user->reset_error();
        }
        $_SESSION['secondary_auth'] = TRUE;
        header("Location: " . $smarty->url . "all/gdschema/l/1/"); 
    } elseif ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] > '3') {

        $messages->set_message('fail', 'contact_administrator');
        header("Location: " . $smarty->url . "");
    }*/
    
    if ($redirect_url != '')
        header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
    else
        header("Location: " . $smarty->url . "secondary/login/");
    exit();
}
$smarty->assign('user_companies', $companies);

//setting layout and page
$smarty->display('extends:layouts/login.tpl|select_company.tpl');
?>