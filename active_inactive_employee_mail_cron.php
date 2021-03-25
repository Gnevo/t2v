<?php
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');

$company_obj = new company();
$companies = $company_obj->company_list();

foreach($companies as $single_company){
    $customer = new customer();
    $employee = new employee();
    $new_company = new company();
    
    $customer->select_db($single_company['db_name']);
    $employee->select_db($single_company['db_name']);
    $new_company->select_db($single_company['db_name']);
    
    $employees = $employee->get_all_employees_for_activation_mail_cron();
    echo "<pre>".print_r($employees, 1)."</pre>";
//    $new_company->create_bill_entry($no_of_active_customers, $price_per_customer, $no_of_sms, $price_per_sms, $mail_address);
    
}

?>