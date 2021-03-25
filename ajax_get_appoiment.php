<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"), FALSE);

$customer = new customer();
$message = new message();

$appoinment_id = trim($_REQUEST['appoinment_id']);

$return_obj = new stdClass();

$return_obj->transaction_flag = TRUE;
$appoiment_detail = array();
if($appoinment_id == ''){
    $message->set_message('fail', 'appoiment details');
    $return_obj->transaction_flag = FALSE;
}

if($return_obj->transaction_flag){
    if($appoinment_id != '')
        $appoiment_detail = $customer->get_appoiments("", $appoinment_id);
    
    if(empty($appoiment_detail)){
        $message->set_message('fail', 'appoiment details');
        $return_obj->transaction_flag = FALSE;
    }
    else {
        if(trim($appoiment_detail[0]['phone_number']) != "")
            $appoiment_detail[0]['phone_number'] = formatting_phone($appoiment_detail[0]['phone_number']);
        if(trim($appoiment_detail[0]['phone_number_cp']) != "")
            $appoiment_detail[0]['phone_number_cp'] = formatting_phone($appoiment_detail[0]['phone_number_cp']);
        if(trim($appoiment_detail[0]['cust_number']) != "")
            $appoiment_detail[0]['cust_number'] = formatting_phone($appoiment_detail[0]['cust_number']);
    }
}
$return_obj->appoiment_detail = $appoiment_detail[0];
$return_obj->message = $message->show_message();
echo json_encode($return_obj);

function formatting_phone($phone){
    $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags(trim($phone)));
    if($phone != ""){
        if(substr($phone,0,3) == '+46' && strlen($phone )>1)
            $phone = substr($phone,3,9999);
        $length_mobile_display = (strlen($phone)-5)/2;
        $temp_mobile = '';
        $pos = 5;
        for($i=0;$i<$length_mobile_display;$i++){
            $temp_mobile = $temp_mobile." ".substr($phone, $pos,2);
            $pos = $pos +2;
        }
        $phone = "+46".substr($phone, 0,3) . " " . substr($phone, 3,2)." ".$temp_mobile;
    }
    return $phone;
}
?>