<?php
// error_reporting(E_ALL);
//                         error_reporting(E_WARNING);
//                         ini_set('error_reporting', E_ALL);
//                         ini_set("display_errors", 1);
require_once ('class/support_new.php');
require_once ('class/company.php');

$obj_sup     = new support();
$company_obj = new company();
$smarty_obj  = new smartySetup(array("mail.xml"),FALSE);

$companies = $company_obj->company_list();


// var_dump($companies);
// exit('dfd');
$subject = $smarty_obj->translate['mail_subject_support_ticket_remainder'];

foreach ($companies as $key => $company) {
	$obj_sup->select_db($company['db_name']);
	$all_remainder_current_date = $obj_sup->get_all_support_ticket_remainder();
	// var_dump($all_remainder_current_date);
	foreach ($all_remainder_current_date as $key => $remainder) {
		if($remainder['email'] == '' || $remainder['email'] == NULL)
			continue;
		$category = $remainder['category_type'] == 1 ? $smarty_obj->translate['support_ticket_category_internal'] : $smarty_obj->translate['support_ticket_category_external'] ; 
		$message  = $smarty->translate['body_start_support_ticket_remainder'].'<br>';
		$message .= $smarty_obj->translate['remainder_subject'].': '.$remainder['subject'].'<br>';
		$message .= $smarty_obj->translate['remainder_date'].': '.date('Y-m-d',strtotime($remainder['remainder_date'])).'<br>';
		$message .= $smarty_obj->translate['support_ticket_id'].': '.$remainder['ticket_id'].'<br>';
		$message .= $smarty_obj->translate['support_ticket_category'].': '.$category.'<br>';
		$message .= $smarty_obj->translate['company_name'].': '.$company['name'].'<br>';
		$message .= $smarty->translate['body_end_support_ticket_remainder'].'<br>';
		$mailer = new SimpleMail($subject, $message);
		$mailer->addSender("cirrus-noreplay@time2view.se");
		$mailer->addRecipient($remainder['email'], trim($remainder['first_name']) . ' ' . trim($remainder['last_name']));
		$mailer->send();
		$message  = '';

		// echo "<pre>".print_r($mailer,1)."</pre>";
		// break;
	}
}

?>