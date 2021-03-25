<?php
/*
 * created by: shaju
 * purpose : for sending mail notifications to all the employees who forgot to sign in the report
 * the cron will be run on every first of a month about previous month
 */

require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/mail.php');
require_once('class/setup.php');
$smarty_obj = new smartySetup(array("mail.xml"),FALSE);

$company_obj = new company();
$companies = $company_obj->company_list();
//getting previous month and year
$dtz = new DateTime; // current time = server time
$dtz->setTimestamp(time());
$dtz->setTimezone(new DateTimeZone('CET'));
$year = date('Y', strtotime('-1 month', strtotime($dtz->format('Y-m-d H:i:s'))));
$month = (int) date('m', strtotime('-1 month', strtotime($dtz->format('Y-m-d H:i:s'))));

foreach ($companies as $single_company) {
    if ($single_company['signing_mail'] == 1) {
        $customer = new customer();
        $employee = new employee();
        $new_company = new company();

        $customer->select_db($single_company['db_name']);
        $employee->select_db($single_company['db_name']);
        $new_company->select_db($single_company['db_name']);

        // Taking all the employees who are not signed on the previous month

        $employees = $employee->get_employees_not_signed_in($month, $year);
        //echo $single_company['db_name'];
        //echo "<pre>".print_r($employees, 1)."</pre>";

	
        foreach ($employees as $single_employee) {
            $subject = $smarty_obj->translate['mail_subject_notification_signing'] . $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
            if($single_employee['status'] == 1){
                $msg = $smarty_obj->translate['label_hi'] . ' ' . $single_employee['emp_name'];
                $msg .= '<br /><br />' . $smarty_obj->translate['mail_body_notification_signing_start'];
                $msg .= $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
                $msg .= $smarty_obj->translate['mail_body_notification_signing_end'];
                $mailer = new SimpleMail($subject, $msg);
                $mailer->addSender($single_company['email']);
                $mailer->addRecipient($single_employee['email']);
                $mailer->send();
            }
            else{
                $msg = $smarty_obj->translate['mail_employee_has_not_signed'] . ' : ' . $single_employee['emp_name'];
                $msg .= '<br /><br />' . $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
                $mailer = new SimpleMail($subject, $msg);
                $mailer->addSender($single_company['email']);
                
                if(trim($single_company['contact_person2_email']) != '')
                    $mailer->addRecipient(trim($single_company['contact_person2_email']));
                else if(trim($single_company['contact_person1_email']) != '')
                    $mailer->addRecipient(trim($single_company['contact_person1_email']));
                else
                    continue;
                
                $mailer->send();
            }
        }
    }
}
?>
