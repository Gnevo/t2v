<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/company.php');
require_once('plugins/message.class.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array("messages.xml", "user.xml", "button.xml"), FALSE);
$user = new user();
$obj_company = new company();
$messages = new message();


if ($_SESSION['user_id'] == '') {
    header("Location: " . $smarty->url);
    exit();
} 
else if($_SESSION['user_role'] == 0){
    header("Location: " . $smarty->url);
    exit();
}

$query_string = explode("&", $_SERVER['QUERY_STRING']);
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
            header("Location: " . $smarty->url);
            exit();
        }
        else {
           // $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
            $company_details = $obj_company->get_company_detail($sel_company);
            // echo "<pre>".print_r($company_details, 1)."<pre>"; exit();
        }
    } else {
        $is_valid_company_id = FALSE;
    }
}
$smarty->assign('company_details', $company_details);


if (!empty($_POST) && isset($_POST['action']) && trim($_POST['action']) == 'OTP-VALIDATION') {
    // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    
    $user->company_id   = strip_tags($_POST['sel_company']);
    $user->username     = strip_tags($_POST['username']);
    $otp                = strip_tags($_POST['otp']);

    if($user->company_id != '' && $user->username != '' && $otp != ''){
        $otp_validation_data = $user->validate_otp($otp);
        
        if (!empty($otp_validation_data) && $otp_validation_data !== FALSE) {

            $expire_time = date('Y-m-d H:i:s', strtotime($otp_validation_data['date']. ' + 15 minutes'));

            $dtz = new DateTime; // current time = server time
            $dtz->setTimestamp(time());
            $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $today = $dtz->format('Y-m-d H:i:s'); 
            // $minutes_to_add = 15;
            // $dtz->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            // echo $today = $dtz->format('Y-m-d H:i:s'); 
            // echo "<pre>".print_r(array($today, $expire_time), 1)."<pre>"; exit();

            if(strtotime($today) <= strtotime($expire_time)){
                $smarty->assign('sel_company_id', $user->company_id);
                $smarty->assign('sel_username', $user->username);
                $smarty->assign('sel_otp', $otp);
                $smarty->assign('allow_pword_reset', 'YES');
                // $messages->set_message('success', 'otp_sent_successfully_check_mobile');
            }
            else {
                $messages->set_message('fail', 'otp_expired');
                // header("Location: " . $smarty->url.'secondary/login/forgotpassword/'.$user->company_id.'/');
                // exit;
            }


        }
        else
            $messages->set_message('fail', 'invalid_otp');
    }
    else
        $messages->set_message('fail', 'invalid_otp');
}

else if(!empty($_POST) && isset($_POST['action']) && trim($_POST['action']) == 'RESET-PASSWORD'){


    // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    $user->company_id   = strip_tags($_POST['sel_company']);
    $user->username     = strip_tags($_POST['username']);
    $otp                = strip_tags($_POST['otp']);
    $password           = strip_tags($_POST['password']);
    $cpassword          = strip_tags($_POST['cpassword']);

    $smarty->assign('sel_company_id', $user->company_id);
    $smarty->assign('sel_username', $user->username);
    $smarty->assign('sel_otp', $otp);
    $smarty->assign('allow_pword_reset', 'YES');

    $transaction_flag = TRUE;

    if ($user->company_id != '' && $user->username != '' && $otp != '' && $password != '' && $cpassword != '') {

        if ($_POST['cpassword'] != $_POST['password']) {
            $messages->set_message('fail', 'enter_saime_password_re-password');
            $transaction_flag = FALSE;
        }


        //revalidate OTP for extra security
        if($transaction_flag){
            $otp_validation_data = $user->validate_otp($otp);
        
            if (empty($otp_validation_data) || $otp_validation_data === FALSE) {
                $smarty->assign('allow_pword_reset', '');
                $transaction_flag = FALSE;
                $messages->set_message('fail', 'invalid_otp');
            }
        }

        if($transaction_flag){
            $transaction_flag = $user->change_secondary_password($password);
            if($transaction_flag){
                //delete current otp record
                $transaction_flag = $user->delete_otp($otp_validation_data['id']);

                $messages->set_message('success', 'reset_password_success');
                header("Location: " . $smarty->url);
                exit();
            }
            else
                $messages->set_message('success', 'password_changing_failed');
        }
        else {
            $transaction_flag = FALSE;
            $messages->set_message('fail', 'otp_expired');
            header("Location: " . $smarty->url.'secondary/login/forgotpassword/'.$user->company_id.'/');
            exit;
        }
    } else
        $messages->set_message('error', 'provide_password');
}

// $smarty->assign('allow_pword_reset', 'YES');

//$company_details = $obj_company->get_company_detail($_SESSION['company_id']);
//$smarty->assign('company_details', $company_details);
$smarty->assign('message', $messages->show_message());
$smarty->assign('current_user_role', $_SESSION['user_role']);
$smarty->display('extends:layouts/login.tpl|sms_pword_reset.tpl');
?>