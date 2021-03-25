<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('plugins/message.class.php');
require_once('class/company.php');
require_once('class/user.php');

$smarty      = new smartySetup(array("messages.xml", "user.xml"),FALSE);
$messages    = new message();
$obj_company = new company();
$user        = new user();
// echo $_SESSION['user_id'];
if ($_SESSION['user_id'] == '') {
    header("Location: " . $smarty->url);
    exit();
} 
else if($_SESSION['user_role'] == 0){
    header("Location: " . $smarty->url);
    exit();
}
//else if ($_SESSION['company_id'] == '') {
//    header("Location: " . $smarty->url . "select/company/");
//    exit();
//}

$query_string            = explode("&", $_SERVER['QUERY_STRING']);
$company_id              = trim($query_string[0]);
$user->username          = $_SESSION['user_id'];
$cur_username_main_login = $user->validate_username();
$company_det             = $user->get_company($company_id);
// var_dump($company_det);

$user->select_db($company_det['db_name']);


if ($cur_username_main_login['role'] == '4') {
    $user_detail = $user->get_customer_detail();
    if (!empty($user_detail)) {
        if ($user_detail['status'] == '1'){
        }
        else
            $error_active = 1;
    }
} 
else {
    $user_detail = $user->get_employee_detail();
    if (!empty($user_detail)) {
        if ($user_detail['status'] == '1' || $user_detail['is_genuine'] == '0'){
        }
        else{
            if($user->username != 'gine001' && $user->username != 'thne001')
                $error_active = 1;
        }
    } 
    else {
    }
}
// var_dump($user_detail);
if($error_active == 1){
    // var_dump($smarty->url);
    header("Location: ". $smarty->url."secondary/login/");
    $messages->set_message('fail', 'user_inactive');
    die();
}
else{
    

    $is_valid_company_id = TRUE;
    $company_details = array();
    if($_SESSION['user_role'] != 0){
        $sel_company = trim($query_string[0]);
        if($sel_company != ''){
            $avail_companies = $user->get_user_companies($_SESSION['user_id']);
            $avail_company_ids = array();
            if(!empty($avail_companies)){
                foreach($avail_companies as $avail_company)
                    $avail_company_ids[] = $avail_company['id'];
            }
            if(!in_array($sel_company, $avail_company_ids)){
                $is_valid_company_id = FALSE;
                $messages->set_message('error', 'invalid_company');
                header("Location: " . $smarty->url . "secondary/login/");
                exit();
            }
            else {
    //            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
                $company_details = $obj_company->get_company_detail($sel_company);
                // echo "<pre>".print_r($company_details, 1)."<pre>"; exit();
            }
        } else {
            $is_valid_company_id = FALSE;
        }
    }

    $smarty->assign('company_details', $company_details);
                
    $smarty->assign('message', $messages->show_message());
    $smarty->assign('url',$preference['url']);

    $smarty->display('forgotpassword_secondary.tpl');
}
?>