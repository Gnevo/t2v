<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/equipment.php');
require_once('plugins/message.class.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml"), FALSE);
$user = new user();
$employee = new employee();
$obj_equipment = new equipment();
$msg = new message();
$url_back = '';

global $bank_id;

$debug = FALSE; 
if($_SESSION['url_back_back']){
    $url_back = $_SESSION['url_back_back'];
    $_SESSION['url_back_back'] = '';
    unset($_SESSION['url_back_back']);
    //echo "<pre>".print_r($url_array, 1)."</pre>";
    $signing_message = '';
    $transaction_flag = 'TRUE';

    $transaction_id = $_REQUEST['txid'];
    //$url = "https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    $url = $bank_id['url']."/".$transaction_id;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);
    $sign_array = json_decode($output);

    file_put_contents('document_sign_back.txt', print_r($sign_array, true));

    //echo "<pre>".print_r($sign_array, 1)."</pre>"; exit();
    if($sign_array->signResult->status == 'SUCCESS'){
        ///$employee->signauture = $sign_array->signResult->signature;
        $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
        if($debug || $employee_details['century'] == substr($sign_array->signInfo->userData->userId, 0, 2) && $employee_details['social_security'] == substr($sign_array->signInfo->userData->userId, 2)){
            //inserting sign data
            $sign_id = $obj_equipment->insert_document_sign($_SESSION['user_id']);
            if($sign_id) {
                $sign = $sign_array->signResult->signature;
                $ocs = $sign_array->signResult->ocspResponse;
                $insert_data = array(
                    'id' => $sign_id,
                    'sign' => $sign,
                    'ocs' => $ocs
                );
                $obj_equipment->insert_document_sign_details($insert_data);
                $msg->set_message('success', 'signing_done_sucessfully');
            } else {
                $msg->set_message('fail', 'error_occured_in_signing_try_again');
            }
        } else {
            $msg->set_message('fail', 'user_missmatch_at_bank_id');
        }
    } else {
        //file_put_contents('sign_back.txt',"Not getting result");
        $msg->set_message('fail', 'error_occured_in_signing_try_again');
        //echo 'error_occured_in_signing_try_again'; exit();
    }
    //$url = "https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    $url = $bank_id['url']."/".$transaction_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    header('Location:'. $url_back);
}
?>