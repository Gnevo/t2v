<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/customer_forms.php');
require_once('class/general.php');
require_once('class/mail.php');

$company_obj = new company();
$obj_general = new general();
$smarty = new smartySetup(array("company.xml", "mail.xml"),FALSE);
$companies = $company_obj->company_list();


// echo "<pre>".print_r($companies, 1)."</pre>"; exit();
foreach($companies as $single_company){
    $obj_general->utf8_string_array_encode($single_company);
    
    
    $customer_forms = new customer_forms();
    $new_company = new company();
    
    $customer_forms->select_db($single_company['db_name']);
    $new_company->select_db($single_company['db_name']);

    $sort_name_by = $single_company['sort_name_by'];

    $form1_data = $customer_forms->get_form1_notification_details($sort_name_by);


    foreach($form1_data as $data){

        $subject = $smarty->translate['cron_form1_reminder_mail_subject']." ". $data['customer_name']." ". $data['review_next_date'];
        $msg = $smarty->translate['cron_form1_reminder_mail_body_begin'].' <br> ';
        $msg .= $smarty->translate['cron_form1_reminder_mail_body_customer'].' : ' . $data['customer_name'] . '<br>';
        $msg .= $smarty->translate['cron_form1_reminder_mail_body_review_date'].' : ' . $data['review_next_date']."<br>";
        $msg .= $smarty->translate['cron_form1_reminder_mail_body_end'].' <br> ';
        $mailer = new SimpleMail($subject, $msg);
        $mailer->addSender("cirrus-noreplay@time2view.se");
        if($data['created_user_email'] != '')
            $mailer->addRecipient($data['created_user_email'], $data['created_user']);
        else
            $mailer->addRecipient($single_company['contact_person2_email'], $single_company['contact_person2']);
        $mailer->send();
        //echo "Mail Send form1<br>";

    }


    $form4_data = $customer_forms->get_form4_notification_details($sort_name_by);


    foreach($form4_data as $data){

        $subject = $smarty->translate['cron_form4_reminder_mail_subject']." ". $data['customer_name']." ". $data['datum_for_uppfoljning_bokad'];
        $msg = $smarty->translate['cron_form4_reminder_mail_body_begin'].' <br> ';
        $msg .= $smarty->translate['cron_form4_reminder_mail_body_customer'].' : ' . $data['customer_name'] . '<br>';
        $msg .= $smarty->translate['cron_form4_reminder_mail_body_review_date'].' : ' . $data['datum_for_uppfoljning_bokad']."<br>";
        $msg .= $smarty->translate['cron_form4_reminder_mail_body_end'].' <br> ';
        $mailer = new SimpleMail($subject, $msg);
        $mailer->addSender("cirrus-noreplay@time2view.se");
        if($data['created_user_email'] != '')
            $mailer->addRecipient($data['created_user_email'], $data['created_user']);
        else
            $mailer->addRecipient($single_company['contact_person2_email'], $single_company['contact_person2']);
        $mailer->send();
        //echo "Mail Send form 4<br>";

    }


    
}



?>