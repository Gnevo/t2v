<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/general.php');
require_once('class/equipment.php');

$company_obj = new company();
$obj_general = new general();
$obj_equipment = new equipment();
$companies = $company_obj->company_list();
$encoded_month = $company_obj->getMonthDetails(date('m'));

// echo "<pre>".print_r($companies, 1)."</pre>"; exit();
foreach($companies as $single_company){
    
   
    $obj_general->utf8_string_array_encode($single_company);
   // if($single_company['id'] != 1)continue;
    if($single_company['billing_status'] == 0){
        continue;
    }
    //echo "<pre>".print_r($single_company, 1)."</pre>";
    
    $customer = new customer();
    $new_company = new company();
   
    $customer->select_db($single_company['db_name']);
    $new_company->select_db($single_company['db_name']);
    
    $no_of_active_customers = $customer->get_active_customer_count_for_billing();
    $no_of_active_customers = $no_of_active_customers[0]['count'];
    
    $no_of_sms = $new_company->get_no_of_outgoing_sms();
    $no_of_sms = $no_of_sms[0]['count'];

    $no_of_sign = $obj_equipment->get_no_of_signs_in_a_month();
    $no_of_sign = $no_of_sign[0]['count'];
    
    $price_per_customer = $single_company['price_per_customer'];
    $price_per_sms = $single_company['price_per_sms'];
    $price_per_sign = $single_company['price_per_sign'];
//    $mail_address = $single_company['contact_person2_email'];
    // $single_company['contact_person2_email'] = 'shamsu@arioninfotech.com';
    $mail_address = $single_company['contact_person2'].'<'.$single_company['contact_person2_email'].'>';
    $file_number = date("ymd");
    $file_number .= (9999 + ((intval(date("Y")) - 2012) * 12) + intval($encoded_month[0]));
    $file_number .= utf8_decode($single_company['name']);
   
    //echo $single_company['name']."<---->".$single_company['db_name']."</br>";
    $new_company->create_bill_entry($file_number, $no_of_active_customers, $price_per_customer, $no_of_sms, $price_per_sms, $price_per_sign, $no_of_sign, $mail_address, $single_company['id']);
    
}



?>
