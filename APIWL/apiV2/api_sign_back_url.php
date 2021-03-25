<?php
require_once('api_common_functions.php');
$session_check = check_user_session(); //FALSE, FALSE, NULL

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/dona.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml"), FALSE);
$user = new user();
$employee = new employee();
$msg = new message();
$url_back = '';
global $bank_id;

$debug = FALSE;
$obj = new stdClass();
$obj->session_status = $session_check;

if($_SESSION['url_back_back']){
    
    $url_back = $_SESSION['url_back_back'];
    $url_array = explode("/", $url_back); 
    $_SESSION['url_back_back'] = '';
    unset($_SESSION['url_back_back']);
    $month              = $url_array[count($url_array)-4];
    $year               = $url_array[count($url_array)-5];
    $report_employee    = $url_array[count($url_array)-3];
    $report_customer    = $url_array[count($url_array)-2];
    $mod                = $url_array[count($url_array)-6];

    $signing_message    = '';
    $transaction_flag   = 'TRUE';



    $employee->username         = $report_employee;
    $employee->rpt_customer     = $report_customer;
    $employee->signing_report_date = $year.'-'.$month.'-1';



    $transaction_id = $_REQUEST['txid'];
    //$url = "https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    $url = $bank_id['url']."/".$transaction_id;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);
    $sign_array = json_decode($output);

    file_put_contents('sign_back.txt', print_r($sign_array, true));

    if($sign_array->signResult->status == 'SUCCESS'){
        ///$employee->signauture = $sign_array->signResult->signature;
        $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
        if($debug || $employee_details['century'] == substr($sign_array->signInfo->userData->userId, 0, 2) && $employee_details['social_security'] == substr($sign_array->signInfo->userData->userId, 2)){
            //$employee->signauture = "PQRST78878787TYTY";

                $obj_dona = new dona();
                $employee->signauture   = $sign_array->signResult->signature;
                $employee->ocs          = $sign_array->signResult->ocspResponse;
                $employee->signing_xml_storage = TRUE;
                $data_set_to_send       = $obj_dona->make_fk_export_xml($year, $month, $report_customer, $report_employee);
                $employee->signing_xml  = $data_set_to_send['xml'];
                
                if($employee->employee_signing_Transaction()){
                    
                    if($mod == 'app'){
                        $obj->status = 'success';
                        $obj->message = $smarty->translate['signing_done_sucessfully'];
                    }
                }else{
                    $obj->status = 'error';
                    $obj->message = $smarty->translate['error_occured_in_signing_try_again'];
                }
        }else{
            $obj->status = 'error';
            $obj->message = $smarty->translate['user_missmatch_at_bank_id'];
        }
        
    }else{
        $obj->status = 'error';
        $obj->message = $smarty->translate['error_occured_in_signing_try_again'];
    }

    //$url = "https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    $url = $bank_id['url']."/".$transaction_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //echo json_encode($obj);
    echo '<script>window.location.href="'.$smarty->url.'apiV2/api_sign_back_url_status.php?status='.$obj->status.'&message='.urlencode($obj->message).'"</script>';
    
}else{
    //from employer
    echo "session not existing";
    // echo '<script>window.location.href="'.$smarty->url.'apiV2/api_sign_back_url_status.php?status='.$obj->status.'&message='.urlencode($obj->message).'"</script>';
}
?>