<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/company.php');
require_once('class/employee.php');
require_once('class/general.php');
require_once('class/mail.php');
$smarty_obj    = new smartySetup(array("company.xml", "user.xml", "mail.xml", 'forms.xml', "messages.xml"),FALSE);
$company_obj    = new company();
$obj_employee   = new employee();
$obj_general = new general();

global $preference, $company;
//http://192.168.0.234/works/app/t2v/cirrus-r/cron_customer_contract_renewal.php

//$contract_end_date = '2015-06-30';
//$contract_end_date = '2014-11-30';
//$contract_end_date = '2014-04-30';
$contract_end_date = date('Y-m-d', strtotime('+1 year'));
$companies = $company_obj->company_list();
//echo "<pre>".print_r($companies, 1)."</pre>"; exit();
foreach($companies as $single_company){
//    echo $single_company['db_name'].'<br/>';
    
    if($single_company['contract_auto_renewal'] == 1){
        $customer = new customer();
        $customer->select_db($single_company['db_name']);
        $contracts = $customer->get_customer_contracts_end_with_the_date($contract_end_date);
//        echo "<pre>".print_r($contracts, 1)."</pre>";
        
        $mail_content = '';
        if(!empty($contracts)){
            foreach($contracts as $cont){
                if($cont['have_future_contracts'] == 1)                continue;

                //calculate_per_day_hour - <current contract>
                $diff = $obj_employee->date_difference($cont['date_from'], $cont['date_to']);
                $tot_day = abs(floor($diff / (24 * 60 * 60)))+1;
                $per_day_hour = ($cont['hour'] / $tot_day);

                $month_end_day_of_contract_to = date('t', strtotime($cont['date_to']));
                $day_of_contract_start = date('d', strtotime($cont['date_from']));
                $day_of_contract_end = date('d', strtotime($cont['date_to']));

                $new_start_date = $new_end_date = $new_hour = '';

                //Feb 1 - Mar 31
                if($day_of_contract_start == 1 && $day_of_contract_end == $month_end_day_of_contract_to){
                    $new_start_date = date('Y-m-d', strtotime($cont['date_to'] . ' +1 day'));

                    $date1 = new DateTime($cont['date_from']);
                    $date2 = new DateTime($cont['date_to']);
                    $month_diff = $obj_general->diffInMonths($date1, $date2);
                    $new_end_date = date('Y-m-t', strtotime($new_start_date . ' +'.($month_diff-1).' month'));

                    $new_diff = $obj_employee->date_difference($new_start_date, $new_end_date);
                    $new_tot_day = abs(floor($new_diff / (24 * 60 * 60)))+1;
                    $new_hour = round($per_day_hour * $new_tot_day, 1);
                }
                //Jan 11- Mar 10
                else if($day_of_contract_start == ($day_of_contract_end + 1) && date('Y|m', strtotime($cont['date_from'])) != date('Y|m', strtotime($cont['date_to']))){
                    $new_start_date = date('Y-m-d', strtotime($cont['date_to'] . ' +1 day'));

                    $date1 = new DateTime($cont['date_from']);
                    $date2 = new DateTime($cont['date_to']);
                    $month_diff = $obj_general->diffInMonths($date1, $date2);
                    $new_end_date = date('Y-m-'.$day_of_contract_end, strtotime($new_start_date . ' +'.($month_diff-1).' month'));

                    $new_diff = $obj_employee->date_difference($new_start_date, $new_end_date);
                    $new_tot_day = abs(floor($new_diff / (24 * 60 * 60)))+1;
                    $new_hour = round($per_day_hour * $new_tot_day, 1);
                }
                //else part (not have a sequence relation) like, Feb 17 - June 05 
                else {
                    $new_start_date = date('Y-m-d', strtotime($cont['date_to'] . ' +1 day'));
                    $new_end_date = date('Y-m-d', strtotime($new_start_date . ' +'.($tot_day-1).' day'));
                    $new_hour = $cont['hour'];
                }

                $contract_period_details = $customer->get_ful_contract_detail($cont['id']);
    //            echo "<pre>".print_r($contract_period_details, 1)."</pre>";


                $fkkn = $cont['fkkn'];
                if($fkkn == 1){
                    $customer->b_fname  = $contract_period_details[0]['first_name'];
                    $customer->b_lname  = $contract_period_details[0]['last_name'];
                }else{
                    $customer->kn_name  = $contract_period_details[0]['kn_name'];
                    $customer->kn_address = $contract_period_details[0]['kn_address'];
                    $customer->kn_postno= $contract_period_details[0]['kn_postno'];
                    $customer->b_iss    = $contract_period_details[0]['iss'];
                    $customer->b_sol    = $contract_period_details[0]['sol']; 
                    $customer->b_kn_ref_num = $contract_period_details[0]['kn_reference_no']; 
                    $customer->b_box    = $contract_period_details[0]['kn_box']; 
                }

                $customer->b_mobile     = $contract_period_details[0]['mobile'];
                $customer->b_email      = $contract_period_details[0]['email'];
                $customer->b_city       = $contract_period_details[0]['city'];
                $customer->b_oncall     = $contract_period_details[0]['oncall'];
                $customer->b_oncall2    = $contract_period_details[0]['oncall2'];
                $customer->b_awake      = $contract_period_details[0]['awake'];
                $customer->b_something  = $contract_period_details[0]['something'];

                $customer->d_fname      = $contract_period_details[0]['first'];
                $customer->d_lname      = $contract_period_details[0]['last'];
                $customer->d_mobile     = $contract_period_details[0]['mob'];
                $customer->d_email      = $contract_period_details[0]['mail'];
                $customer->d_comment_other = $contract_period_details[0]['comments_other'];
                $customer->d_comment_time = $contract_period_details[0]['comments_time'];
                $customer->d_city       = $contract_period_details[0]['cities'];
                $customer->date_from    = $new_start_date;
                $customer->date_to      = $new_end_date;
                $customer->user         = $cont['customer'];
                $customer->d_document   = $contract_period_details[0]['documents'];

                $transaction_flag = TRUE;
                $customer->begin_transaction();
                $id = $customer->add_customer_contract($cont['customer'], $new_hour, $new_start_date, $new_end_date, $fkkn);
                if($id){
                    if( $customer->b_fname != "" || $customer->b_lname != "" || $customer->b_mobile!= "" || $customer->b_email!= "" || $customer->b_city!= "" || $customer->b_oncall!= "" || $customer->b_oncall2!= "" || $customer->b_awake!= "" || $customer->b_something!= "" ){
                        $customer->customer_contract_billing_insert($id, $fkkn);              
                    }  
                    if( $customer->d_fname != "" || $customer->d_lname != "" || $customer->d_mobile != "" || $customer->d_email != "" || $customer->d_city != "" || $customer->d_comment_time != "" || $customer->d_comment_other != "" || $customer->d_document != ""){
                        $customer->customer_contract_decision_insert($id, $fkkn);
                    }
                    $customer->commit_transaction();
                } else{
                    $customer->rollback_transaction();
                    $transaction_flag = FALSE;
                }

                echo "Customer contract cloneID-".$cont['id']." | fkkn-$fkkn | customer-".$cont['customer']." | (id=$id) created<br/>";
                
                if(trim($single_company['contract_auto_renewal_mail']) != '' && $transaction_flag){
                    
                    $is_first_entry = FALSE;
                    if($mail_content == ''){
                        $is_first_entry = TRUE;
                        $mail_content .= '<table style="text-align: left;">';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['company'].' </th><td> : '.$single_company['name'].' </td></tr>';
                        $mail_content .= '</table>';
                    }
                    
                    $fkkn_label = '';
                    switch ($fkkn){
                        case 1: $fkkn_label = $smarty_obj->translate['fk']; break;
                        case 2: $fkkn_label = $smarty_obj->translate['kn']; break;
                        case 3: $fkkn_label = $smarty_obj->translate['tu']; break;
                    }
                    if(!$is_first_entry) $mail_content .= '<hr />';
                    
                    $mail_content .= '<table style="text-align: left;">';
//                    $mail_content .= '<tr><th> '.$smarty_obj->translate['company'].' </th><td> : '.$single_company['name'].' </td></tr>';
                    $mail_content .= '<tr><th> '.$smarty_obj->translate['customer'].'</th><td> : '.$cont['last_name'] . ' ' . $cont['first_name']. ' </td></tr>';
                    $mail_content .= '<tr><th> '.$smarty_obj->translate['fkkn'].'</th><td> : '.$fkkn_label. ' </td></tr>';
                    $mail_content .= '<tr><th> '.$smarty_obj->translate['date_from'].'</th><td> : '.$new_start_date. ' </td></tr>';
                    $mail_content .= '<tr><th> '.$smarty_obj->translate['date_to'].'</th><td> : '.$new_end_date. ' </td></tr>';
                    $mail_content .= '<tr><th> '.$smarty_obj->translate['hours'].'</th><td> : '.$new_hour. ' </td></tr>';
                    $mail_content .= '<tr><th> '.$smarty_obj->translate['contract_rolled_from'].'</th><td> : '.$cont['date_from'] . ' '. $smarty_obj->translate['to'].' '. $cont['date_to'] . ' (' . $cont['hour'] . ' ' . $smarty_obj->translate['hours'] . ') </td></tr>';
                    $mail_content .= '</table>';
                }
                
            }
        }
        
        if(trim($single_company['contract_auto_renewal_mail']) != '' && $mail_content != ''){
            $mail_content .= '<br /><br />'.$smarty_obj->translate['mail_contract_auto_renewal_footer'] . '<br /><br />';
//            echo $mail_content;
//            echo trim($single_company['contract_auto_renewal_mail']);
            
            $subject = $smarty_obj->translate['mail_subject_contract_auto_renewal'];
            $mailer = new SimpleMail($subject, $mail_content);
            $mailer->addSender($single_company['email']);
            $recipient_mail = trim($single_company['contract_auto_renewal_mail']);
            
//            $recipient_mail = 'shamsu_k12@yahoo.co.in';
            //$recipient_mail = 'shajukt@entraze.com';
//            $recipient_mail = 'shamsu@arioninfotech.com';
            $mailer->addRecipient($recipient_mail);
            $mailer->send();
        }
    }
}
echo 'Cron executed';
exit();
?>