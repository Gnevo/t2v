<?php
/*
 * created by: shaju
 * purpose : for sending mail notifications to all the employees who forgot to sign in the report
 * the cron will be run on every first of a month about previous month
 */
require_once('configs/config.inc.php');
require_once('class/company.php');
require_once('class/mail.php');
require_once('class/setup.php');

$smarty_obj = new smartySetup(array("company.xml", "mail.xml"),FALSE);
global $company;

$company_obj = new company();
$companies = $company_obj->company_list();

$active_company_ids = array();
if(!empty($companies)){
    foreach($companies as $cmp){
        $active_company_ids[] = $cmp['id'];
    }
}

//getting previous month and year
$dtz = new DateTime; // current time = server time
$dtz->setTimestamp(time());
$dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
$date_after_2_month = date('Y-m-d', strtotime('+2 month', strtotime($dtz->format('Y-m-d H:i:s'))));
//$date_after_2_month = '2016-12-31';

$contract_end_details = $company_obj->get_company_contracts_end_with_date($date_after_2_month, $active_company_ids);
//echo "<pre>".print_r($contract_end_details, 1)."</pre>";
//exit();

if(!empty($contract_end_details)){
    foreach ($contract_end_details as $cd) {
        if ($cd['exist_next_day_contract'] === 0 || $cd['exist_next_day_contract'] === '0') {
//            echo "<pre>".print_r($cd, 1)."</pre>";
            $body_msg_template = $smarty_obj->translate['company_contract_will_expire_soon'];
            $body_msg_template = str_replace ('{{COMPANY-NAME}}', $cd['company_name'] , $body_msg_template);
            $body_msg_template = str_replace ('{{EXPIRE-DATE}}', $cd['contract_to'] , $body_msg_template);
//            continue;
//            exit();
            
            $subject = $smarty_obj->translate['company_contract_will_expire_soon_subject'];
            $msg = $smarty_obj->translate['label_hi'];
            $msg .= '<br /><br />' . $body_msg_template;
            $mailer = new SimpleMail($subject, $msg);
//            $mailer->addSender($single_company['email']);
            $mailer->addRecipient($company['email']);
//            $mailer->addRecipient('shamsu@arioninfotech.com');
//            $mailer->addRecipient('shajukt@entraze.com');
            $result = $mailer->send();
            var_dump($result);
        }
    }
}
?>