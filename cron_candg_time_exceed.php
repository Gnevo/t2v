<?php
/*
 * created by: shaju
 * purpose : for sending mail notifications to all the employees who forgot to sign in the report
 * the cron will be run on every first of a month about previous month
 */

require_once('class/company.php');
require_once('class/mail.php');
require_once('class/setup.php');
require_once('class/leave.php');
$smarty_obj = new smartySetup(array("company.xml", "mail.xml"),FALSE);

$company_obj = new company();
$companies = $company_obj->company_list();

$hours_exceed = 24;
//echo "<pre>".print_r($companies, 1)."</pre>";
//exit();
foreach ($companies as $single_company) {
    
        if ($single_company['id'] != 1)
            continue;

    $obj_leave = new leave();
    $obj_leave->select_db($single_company['db_name']);


    $employee_datas = $obj_leave->get_employees_exceed_candg($hours_exceed, $single_company['sort_name_by']);
    
    //echo "<pre>".print_r($employee_datas, 1)."</pre>";
    if(!empty($employee_datas)){
        $subject = $smarty_obj->translate['mail_subject_notification_candg_time_exceed'];       
        $msg = $smarty_obj->translate['mail_body_begin_notification_candg_time_exceed'];
        $msg .= '<br /><br />';
        $msg .= '<table style="text-align: left;" cellpadding="15">';
        $msg .= '<tr><th> '.$smarty_obj->translate['company'].': </th><th>'.$single_company['name'].' </th></tr>';
        $msg .= '</table>';
        $msg .= '<table style="border: 1px solid black; width:800px;" cellpadding="15">';
        $msg .= '<tr style="background-color: #daf2f7;"><td style="border: 1px solid black;">'.$smarty_obj->translate['employee'].'</td><td style="border: 1px solid black;">'.$smarty_obj->translate['customer'].'</td><td style="border: 1px solid black;">'.$smarty_obj->translate['duration'].'</td></tr>';
        foreach ($employee_datas as $single_employee) {
            
            $employee_name = $single_employee['first_name']. ' '. $single_employee['last_name'];
            $customer_name = $single_employee['customer_first_name']. ' '. $single_employee['customer_last_name'];   
            if($single_company['sort_name_by'] == 2){
                $employee_name = $single_employee['last_name']. ' '. $single_employee['first_name'];
                $customer_name = $single_employee['customer_last_name']. ' '. $single_employee['customer_first_name'];   
            }
            
            $msg .= '<tr ><td style="border: 1px solid black;">'. $employee_name . ' </td><td style="border: 1px solid black;">'.$customer_name.'</td><td style="border: 1px solid black;">'.$single_employee['total_time'].'</td></tr>';
            

        }
        $msg .= '</table>';
        //echo $subject."<br><br>";

        // echo $msg;
        // exit();
        $mailer = new SimpleMail($subject, $msg);
        $mailer->addSender('cirrus-noreply@time2view.se');
        $recipient_mail = NULL;
        if(trim($single_company['contact_person2_email']) != '')
            $recipient_mail = trim($single_company['contact_person2_email']);
        else if(trim($single_company['contact_person1_email']) != '')
            $recipient_mail = trim($single_company['contact_person1_email']);
        else
            continue;
        $mailer->addRecipient($recipient_mail);
        //$mailer->addRecipient('support@time2view.se');
        $mailer->send();
    }
        
}

?>
