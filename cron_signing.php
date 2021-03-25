<?php
/*
 * created by: shaju
 * purpose : for sending mail notifications to all the employees who forgot to sign in the report
 * the cron will be run on every first of a month about previous month
 */
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/leave.php');
require_once('class/inconvenient.php');
require_once('class/mail.php');
require_once('class/setup.php');
$smarty_obj = new smartySetup(array("company.xml", "mail.xml"),FALSE);

$company_obj = new company();
$companies = $company_obj->company_list();
//getting previous month and year
$dtz = new DateTime; // current time = server time
$dtz->setTimestamp(time());
$dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
$year = date('Y', strtotime('-1 month', strtotime($dtz->format('Y-m-d H:i:s'))));
$month = (int) date('m', strtotime('-1 month', strtotime($dtz->format('Y-m-d H:i:s'))));

//echo "<pre>".print_r($companies, 1)."</pre>";
// exit();
foreach ($companies as $single_company) {

    if ($single_company['id'] == 1) {
    if ($single_company['signing_mail'] == 1) {
        $customer = new customer();
        $employee = new employee();
        $new_company = new company();
        $obj_inconv = new inconvenient();
        $obj_leave = new leave();

        $customer->select_db($single_company['db_name']);
        $employee->select_db($single_company['db_name']);
        $new_company->select_db($single_company['db_name']);

        // Taking all the employees who are not signed on the previous month

        $employees = $employee->get_employees_not_signed_in($month, $year);
        //        echo $single_company['db_name'];
        //echo "<pre>".print_r($employees, 1)."</pre>";
        //exit();
        //$obj_leave->check_untreated_employee_leave_in_a_customer($passed_employee, $yr, $month, $passed_customer);
        //$obj_inconv->check_untreated_candg_slots($passed_employee, $passed_customer, $month, $yr);
        $sended_mail_users_list = array();
        $mail_leave_incharge_list = array();
        $mail_cng_incharge_list = array();
        foreach ($employees as $single_employee) {
            $leave_incharge_list = array();
            $cng_incharge_list = array();
            $untreated_leaves = $obj_leave->get_untreated_leave_slots($single_employee['username'], $year, $month);

            $untreated_slots = $obj_inconv->check_untreated_candg_slots_without_customer($single_employee['username'], $month, $year);
            foreach ($untreated_leaves as $untreated_leave) {
                $employees_incharge = $obj_leave->get_employees_in_charge($untreated_leave['employee'], $untreated_leave['customer']);
                if($employees_incharge['type'] == 'employee') {
                    $mail_leave_incharge_list[$employees_incharge['jobe001']]['data'] = $employees_incharge;
                    $mail_leave_incharge_list[$employees_incharge['jobe001']]['employees'][$single_employee['username']] = $single_employee;
                } else {
                    $mail_leave_incharge_list[$single_company['id']]['data'] = $employees_incharge;
                    $mail_leave_incharge_list[$single_company['id']]['employees'][$single_employee['username']] = $single_employee;
                }
                
            }
            foreach ($untreated_slots as $untreated_slot) {
                $employees_incharge = $obj_leave->get_employees_in_charge($untreated_slot['employee'], $untreated_slot['customer']);
                if($employees_incharge['type'] == 'employee') {
                    $mail_cng_incharge_list[$employees_incharge['jobe001']]['data'] = $employees_incharge;
                    $mail_cng_incharge_list[$employees_incharge['jobe001']]['employees'][$single_employee['username']] = $single_employee;

                } else {
                    $mail_cng_incharge_list[$single_company['id']]['data'] = $employees_incharge;
                    $mail_cng_incharge_list[$single_company['id']]['employees'][$single_employee['username']] = $single_employee;
                }
            }
            
            //echo '<pre>' . print_r($untreated_leaves,1) . '</pre>';
            //echo '<pre>' . print_r($untreated_slots,1) . '</pre>';
            
            $subject = $smarty_obj->translate['mail_subject_notification_signing'] . $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;

            if(empty($untreated_slots) && empty($untreated_leaves)) {
                
                if($single_employee['status'] == 1){
                    if(filter_var($single_employee['email'], FILTER_VALIDATE_EMAIL)){
                        $msg = $smarty_obj->translate['label_hi'] . ' ' . $single_employee['emp_name'];
                        $msg .= '<br /><br />' . $smarty_obj->translate['mail_body_notification_signing_start'];
                        $msg .= $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
                        $msg .= $smarty_obj->translate['mail_body_notification_signing_end'];
                        $mailer = new SimpleMail($subject, $msg);
                        $mailer->addSender($single_company['email']);
                        $mailer->addRecipient($single_employee['email']);
                        $mailer->send();
                        
                        $sended_mail_users_list[] = array('name' => $single_employee['emp_name'], 'email' => $single_employee['email']);
                    }
                } else{
                    $msg = $smarty_obj->translate['mail_employee_has_not_signed'] . ' : ' . $single_employee['emp_name'];
                    $msg .= '<br /><br />' . $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
                    $mailer = new SimpleMail($subject, $msg);
                    $mailer->addSender($single_company['email']);
                    
                    $recipient_mail = NULL;
                    if(trim($single_company['contact_person2_email']) != '')
                        $recipient_mail = trim($single_company['contact_person2_email']);
                    else if(trim($single_company['contact_person1_email']) != '')
                        $recipient_mail = trim($single_company['contact_person1_email']);
                    else
                        continue;
                    
                    $mailer->addRecipient($recipient_mail);
                    $mailer->send();
                    
                    $sended_mail_users_list[] = array('name' => $single_employee['emp_name'], 'email' => $recipient_mail);
                }
            }
        }

        //$mail_leave_incharge_list = array_unique($mail_leave_incharge_list, SORT_REGULAR);
        //$mail_cng_incharge_list = array_unique($mail_cng_incharge_list, SORT_REGULAR);
        //echo '<pre>' . print_r($mail_leave_incharge_list,1) . '</pre>';
        //echo '<pre>' . print_r($mail_cng_incharge_list,1) . '</pre>';

        //send mail to incharge for Unappreved Leaves
        if(!empty($mail_leave_incharge_list)) {
            foreach ($mail_leave_incharge_list as $leave_incharge) {
                if(filter_var($leave_incharge['data']['email'], FILTER_VALIDATE_EMAIL)){
                    $msg = $smarty_obj->translate['label_hi'] . ' ' . $leave_incharge['data']['name'];
                    $msg .= '<br /><br />' . $smarty_obj->translate['mail_body_notification_signing_untreated_leaves_start'];
                    $msg .= $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
                    $msg .= '<br /><br /><table style="margin-left:2.5em;">';
                    foreach($leave_incharge['employees'] as $leave_employee){
                        $msg .= '<tr><td>'. $leave_employee['emp_name'] . '</td><td> : '. $leave_employee['username'] .' </td></tr>';
                    }
                    $msg .= '</table><br />';
                    $msg .= $smarty_obj->translate['mail_body_notification_signing_untreated_leaves_end'];
                    //echo $single_company['email'] .'-'.$leave_incharge['data']['email'];
                    $mailer = new SimpleMail($subject, $msg);
                    $mailer->addSender($single_company['email']);
                    $mailer->addRecipient($leave_incharge['data']['email']);
                    $mailer->send();
                    //$sended_mail_users_list[] = array('name' => $leave_incharge['data']['name'], 'email' => $leave_incharge['data']['email']);
                }
            }
        }
        //send mail to incharge for unmanaged CNG slots
        if(!empty($mail_cng_incharge_list)) {
            foreach ($mail_cng_incharge_list as $cng_incharge) {
                if(filter_var($cng_incharge['data']['email'], FILTER_VALIDATE_EMAIL)){
                    $msg = $smarty_obj->translate['label_hi'] . ' ' . $cng_incharge['data']['name'];
                    $msg .= '<br /><br />' . $smarty_obj->translate['mail_body_notification_signing_untreated_cng_start'];
                    $msg .= $smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year;
                    $msg .= '<br /><br /><table style="margin-left:2.5em;">';
                    foreach($cng_incharge['employees'] as $cng_employee){
                        $msg .= '<tr><td>'. $cng_employee['emp_name'] . '</td><td> : '. $cng_employee['username'] .' </td></tr>';
                    }
                    $msg .= '</table><br/>';
                    $msg .= $smarty_obj->translate['mail_body_notification_signing_untreated_cng_end'];
                    //echo $single_company['email'] .'-'.$cng_incharge['data']['email'];
                    $mailer = new SimpleMail($subject, $msg);
                    $mailer->addSender($single_company['email']);
                    $mailer->addRecipient($cng_incharge['data']['email']);
                    $mailer->send();
                    //$sended_mail_users_list[] = array('name' => $cng_incharge['data']['name'], 'email' => $cng_incharge['data']['email']);
                }
            }
        }


//        echo "<pre>".print_r($sended_mail_users_list, 1)."</pre>";
        if(!empty($sended_mail_users_list)){
            $msg = '<table style="text-align: left;">';
            $msg .= '<tr><th> '.$smarty_obj->translate['company'].' </th><td> : '.$single_company['name'].' </td></tr>';
            $msg .= '<tr><th> '.$smarty_obj->translate['signing_period'].'</th><td> : '.$smarty_obj->translate['label_' . strtolower(date("F", mktime(0, 0, 0, $month, 10)))] . ' ' . $year. ' </td></tr>';
            $msg .= '</table>';
            $msg .= '<br /><b><u>'.$smarty_obj->translate['signing_mails_sent_to'] . '</u></b> : <br /><br />';
            
            $msg_inner = '<table style="margin-left:2.5em;">';
            foreach($sended_mail_users_list as $send_user){
                $msg_inner .= '<tr><td>'. $send_user['name'] . ' </td><td> : '.str_replace('.', '<span class="dot">.</span>', $send_user['email']).' </td></tr>';
            }
            $msg_inner .= '</table>';
            //$msg_inner = str_replace('.', '<span>.&#8203', $msg_inner);
            //$msg_inner = str_replace('.', '<span class="dot">.</span>', $msg_inner);
            $msg .= $msg_inner;
            $mailer = new SimpleMail($subject, $msg);
            $mailer->addSender($single_company['email']);
            $recipient_mail = NULL;
            if(trim($single_company['contact_person2_email']) != '')
                $recipient_mail = trim($single_company['contact_person2_email']);
            else if(trim($single_company['contact_person1_email']) != '')
                $recipient_mail = trim($single_company['contact_person1_email']);
            else
                continue;
            
            //            $recipient_mail = 'shamsu_k12@yahoo.co.in';
            //$recipient_mail = 'shajukt@entraze.com';
            //            $recipient_mail = 'shamsu@arioninfotech.com';

            $mailer->addRecipient($recipient_mail);
            $mailer->addRecipient('support@time2view.se');
            $mailer->send();
        }
    }
    }
}
?>
