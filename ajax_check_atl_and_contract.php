<?php

/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * for: combining atl_checking and contract_exceed_checking in one server request
 * return type: Json
*/

//require_once('class/setup.php');
//$smarty = new smartySetup(array(), FALSE);
ob_start();
require_once('configs/config.inc.php');
require_once('class/company.php');
global $preference;
$return_obj = array( 'atl' => 'success', 'contract' => 'success' );
//echo $_SERVER['QUERY_STRING']."<br/>";
//echo "<pre>".print_r($_SERVER, 1)."</pre>";
$ch = curl_init();
if ($ch){
    
    $obj_company = new company();
    $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
    
    if($company_data['atl_check'] == 1){
        
        //check atl - ajax_check_atl.php
        //------------------------------
        //date=2013-09-22&employee=&customer=cybr001&emp_alloc=dodo001&empl=cifo001&action=multiple_slot_assign&dnt_show_flag=0&ids=15636&multi=1
        curl_setopt($ch, CURLOPT_URL, $preference['url'].'ajax_check_atl.php');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $_SERVER['QUERY_STRING']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_REQUEST));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true );
        curl_setopt($ch, CURLOPT_COOKIE, $_SERVER['HTTP_COOKIE']);
        //$header_temp = array()
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $atl_response = curl_exec($ch);
//        echo "<pre>".print_r($atl_response, 1)."</pre>";
        
        $atl_response_decoded = json_decode($atl_response, true);
        $return_obj['atl'] = trim($atl_response_decoded['atl']);
//        $return_obj['test'] = trim($atl_response_decoded['test']);
//        $return_obj['p'] = $_REQUEST;
//        $return_obj['p1'] = $_SERVER['QUERY_STRING'];
        /*if(trim($atl_response_decoded['atl_exceed_hours']) > 0){
            $return_obj['atl_exceed_hours'] = trim($atl_response_decoded['atl_exceed_hours']);
            $return_obj['atl_params'] = $atl_response_decoded['atl_params'];
        }*/
        if(trim($atl_response_decoded['atl']) != 'success'){
    //        $return_obj['atl_exceed_hours'] = trim($atl_response_decoded['atl_exceed_hours']);
            $return_obj['atl_params'] = $atl_response_decoded['atl_params'];
        }
    }
    
    if($company_data['contract_exceed_check'] == 1){
        //check employee-contract - ajax_employee_contract_check.php
        //-----------------------------------------------------------
        //date=2013-09-22&employee=&customer=cybr001&emp_alloc=dodo001&empl=cifo001&action=multiple_slot_assign&dnt_show_flag=0&ids=15636&multi=1&type_check=1
        curl_setopt($ch, CURLOPT_URL, $preference['url'].'ajax_employee_contract_check.php');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $_SERVER['QUERY_STRING']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_REQUEST));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true );
        curl_setopt($ch, CURLOPT_COOKIE, $_SERVER['HTTP_COOKIE']);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-type: application/json');
        $contract_response = curl_exec($ch);

        $contract_response_decoded = json_decode($contract_response, true);
        $return_obj['contract'] = trim($contract_response_decoded['contract']);
        if(trim($contract_response_decoded['contract']) != 'success'){
            $return_obj['contract_params'] = $contract_response_decoded['contract_params'];
        }
    }
    curl_close($ch);
//    if (strpos($atl_response, '200 OK') !== false) {
//        $return_obj['atl'] = $atl_response;
//    }
}
//ob_end_clean();
//echo '<script> var data = ' . json_encode($return_obj) . '; console.log(data) </script>';
echo json_encode($return_obj);
?>