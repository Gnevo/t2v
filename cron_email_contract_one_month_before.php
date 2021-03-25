<?php
/*
 *  @auther    : sreerag
 *  date	   : 25-04-2019
 *  purpose    : this cron will execute for mail employee and contact person1 before one month of contract expiry.
*/

require_once ('class/company.php');
require_once ('class/employee_ext.php');
require_once ('class/customer.php');


$obj_cmp = new company();
$obj_emp = new employee_ext();
$obj_cus = new customer();

$smarty = new smartySetup(array("contract.xml"));


$current_date    = date('Y-m-d');
$all_companies   = $obj_cmp->company_list();


foreach ($all_companies as $key => $single_company) {
	$obj_emp->select_db($single_company['db_name']);
	$emp_contracts = $obj_emp->get_employee_contract($current_date);
	if(!empty($emp_contracts)){
		$company_detail = $obj_cus->get_company_detail($single_company['id']);
    	foreach ($emp_contracts as $contract_key => $contract) {
    		$next_month_date = date('Y-m-d', strtotime('+1 month'));
    		if($next_month_date == $contract['date_to']){
    			// mail send to employee and contact person 1.
    			$message = '';
    			$subject = $smarty->translate['employee_contract_expiry_warning_subject'];
    			$message_header = $smarty->translate['employee_contract_expiry_warning_header'].'<br><br>';
    			$message_body  	= $smarty->translate['contract_employee_name'].' : '.$contract['first_name'].' '.$contract['last_name'].'<br>';
    			$message_body	.=  $smarty->translate['mail_contract_period'].' : '.$contract['date_from'].'-'.$contract['date_to'].'<br>';
    			$message 		.= $message_header.$message_body;
    			$mailer = new SimpleMail($subject,$message);
    			$mailer->addSender("cirrus-noreplay@time2view.se");
    			$mailer->addRecipient($contract['email'], trim($contract['first_name']) . ' ' . trim($contract['last_name']));
    			$mailer->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
    			$mailer->send();
    		}
    	}
	}
}




?>