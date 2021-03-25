<?php
/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * for: sending mail notifications to all the Admin/TL/GL employees whose customer's contract(FK/KN) exceeds.
 * checking contract hours exceed withing whole contract period
 * the cron will be run on every monday of a week about previous week
*/

require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/mail.php');
require_once('class/setup.php');
$smarty_obj = new smartySetup(array("mail.xml", 'contract.xml', 'reports.xml', 'month.xml'),FALSE);

$company_obj = new company();
$companies = $company_obj->company_list();
//getting previous month and year
$dtz = new DateTime; // current time = server time
$dtz->setTimestamp(time());
$dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
$cur_date = date('Y-m-d');

$customer = new customer();
$employee = new employee();

foreach($companies as $single_company){
//    echo "===================<pre>".print_r($single_company['name'], 1)."</pre>";
    $customer->select_db($single_company['db_name']);
    $employee->select_db($single_company['db_name']);
    
    $company_customers = $customer->get_active_customers();
    if(!empty($company_customers)){
        foreach($company_customers as $this_customer){
            $need_mail = FALSE;
            $subject = $msg = '';
            
            $customer_day_contracts_fk = $customer->customer_contract_in_a_day($this_customer['username'], $cur_date, 1);
            $customer_day_contracts_kn = $customer->customer_contract_in_a_day($this_customer['username'], $cur_date, 2);
            
            if(!empty($customer_day_contracts_fk) && $customer_day_contracts_fk !== FALSE){
                foreach($customer_day_contracts_fk as $fk_contract){
                    $contract_period_employee_work_hours   = $customer->customer_timetable_time_between_dates($this_customer['username'], $fk_contract['date_from'], $fk_contract['date_to'], 1);
                    
                    //checking contract hours exceed working hours
                    if($contract_period_employee_work_hours > $fk_contract['hour']){
                        if(!$need_mail){
                            $need_mail = TRUE;
                            $subject =  $smarty_obj->translate['mail_subject_notification_contract_exceed']. ' - '.$this_customer['last_name'].' '.$this_customer['first_name'];
                            $msg .=     $smarty_obj->translate['label_hi'];
                            $body_msg_template = nl2br($smarty_obj->translate['mail_body_notification_contract_exceed']);
                            $body_msg = str_replace ('{{CUSTOMER_NAME}}', $this_customer['last_name'].' '.$this_customer['first_name'] , $body_msg_template);
                            $msg .=     '<br /><br />'.$body_msg;
                        }
                            
                        
                        $msg .= '<br/><table>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['contract_type']. '</td><td>: FK</td></tr>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['contract_period']. '</td><td>: '.$fk_contract['date_from']. ' '. $smarty_obj->translate['to_time']. ' '. $fk_contract['date_to'].'</td></tr>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['contract_hour']. '</td><td>: '.sprintf('%.02f', round($contract_period_employee_work_hours, 2)).'</td></tr>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['work_hours']. '</td><td>: '.sprintf('%.02f', round($fk_contract['hour'], 2)).'</td></tr>';
                        $msg .= '</table><br/>';
                    }
                }
            }
            
            if(!empty($customer_day_contracts_kn) && $customer_day_contracts_kn !== FALSE){
                foreach($customer_day_contracts_kn as $kn_contract){
                    $contract_period_employee_work_hours   = $customer->customer_timetable_time_between_dates($this_customer['username'], $kn_contract['date_from'], $kn_contract['date_to'], 2);
                    
                    //checking contract hours exceed working hours
                    if($contract_period_employee_work_hours > $kn_contract['hour']){
                        if(!$need_mail){
                            $need_mail = TRUE;
                            $subject =  $smarty_obj->translate['mail_subject_notification_contract_exceed']. ' - '.$this_customer['last_name'].' '.$this_customer['first_name'];
                            $msg .=     $smarty_obj->translate['label_hi'];
                            $body_msg_template = nl2br($smarty_obj->translate['mail_body_notification_contract_exceed']);
                            $body_msg = str_replace ('{{CUSTOMER_NAME}}', $this_customer['last_name'].' '.$this_customer['first_name'] , $body_msg_template);
                            $msg .=     '<br /><br />'.$body_msg;
                        }
                            
                        $msg .= '<br/><table>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['contract_type']. '</td><td>: KN</td></tr>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['contract_period']. '</td><td>: '.$kn_contract['date_from']. ' '. $smarty_obj->translate['to_time']. ' '. $kn_contract['date_to'].'</td></tr>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['contract_hour']. '</td><td>: '.sprintf('%.02f', round($contract_period_employee_work_hours, 2)).'</td></tr>';
                        $msg .= '<tr><td>'.$smarty_obj->translate['work_hours']. '</td><td>: '.sprintf('%.02f', round($kn_contract['hour'], 2)).'</td></tr>';
                        $msg .= '</table><br/>';
                        
                    }
                }
            }
                
            if($need_mail){
                $recipents = $employee->customer_AL_GL_contract_exceed_receipients($this_customer['username']);
                if (!empty($recipents)) {
                    $mailer = new SimpleMail($subject,$msg);
                    $mailer->addSender($single_company['email']);
                    foreach ($recipents as $recipent) {
                        if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {
                            $mailer->addRecipient($recipent['email']);
                        }
                    }
//                    $mailer->addRecipient('shamsu@arioninfotech.com');
                    $mailer->send();
                }
                
//                echo $msg;
            }
        }
    }
}
?>