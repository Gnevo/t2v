<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/general.php');

$company_obj = new company();
$obj_general = new general();
$companies = $company_obj->company_list();
$encoded_month = $company_obj->getMonthDetails(date('m'));

//echo "<pre>\n".print_r($companies, 1)."</pre>";
foreach($companies as $single_company){
    $obj_general->utf8_string_array_encode($single_company);
    //    if($single_company['id'] != 6)
    if($single_company['billing_status'] == 0)
        continue;
    $customer = new customer();
    $new_company = new company();
    
    $customer->select_db($single_company['db_name']);
    $new_company->select_db($single_company['db_name']);
    
    $no_of_active_customers = $customer->get_active_customer_count_for_billing();
    $no_of_active_customers = $no_of_active_customers[0]['count'];
    
    $no_of_sms = $new_company->get_no_of_outgoing_sms();
    $no_of_sms = $no_of_sms[0]['count'];
    
    $price_per_customer = $single_company['price_per_customer'];
    $price_per_sms = $single_company['price_per_sms'];
//    $mail_address = $single_company['contact_person2_email'];
    $mail_address = $single_company['contact_person2'].'<'.$single_company['contact_person2_email'].'>';
    $file_number = date("ymd");
    $file_number .= (9999 + ((intval(date("Y")) - 2012) * 12) + intval($encoded_month[0]));
    $file_number .= $single_company['name'];
    
    $new_company->create_bill_entry($file_number, $no_of_active_customers, $price_per_customer, $no_of_sms, $price_per_sms, $mail_address, $single_company['id']);
//    echo "<pre>".print_r($single_company, 1)."</pre>";
}



?>
