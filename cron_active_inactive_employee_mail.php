<?php
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/mail.php');
require_once('class/setup.php');
$smarty_obj = new smartySetup(array("mail.xml"),FALSE);
$company_obj = new company();

$companies = $company_obj->company_list();

foreach($companies as $single_company){
    if($single_company['id'] != 1)continue;	
    $customer = new customer();
    $employee = new employee();
    $new_company = new company();
    
    $customer->select_db($single_company['db_name']);
    $employee->select_db($single_company['db_name']);
    $new_company->select_db($single_company['db_name']);
    
    /**************************** inactive mail notification send **************************************/
    $employees = $employee->get_all_employees_for_mail_cron(1);         //1 indicates all active employees
    foreach($employees as $single_employee){
        if($single_employee['date_inactive'] != ""){        //send for future notification of inactive account
            $date_inactive = $single_employee['date_inactive'];
            $date_active = $single_employee['date'];
            $current_date = date('Y-m-d');
            $diff_bet_inact_current = strtotime($date_inactive) - strtotime($current_date);
            $days_bet_inact_current = floor($diff_bet_inact_current / (60*60*24));
            $diff_bet_inact_act = strtotime($date_inactive) - strtotime($date_active);
            $days_bet_inact_act = floor($diff_bet_inact_act / (60*60*24));
            
//            echo $single_employee['username'].'==='.$single_employee['date_inactive'].' == '.date('Y-m-d').'<br/>';
//            echo $single_employee['username'].'==='."$days_bet_inact_current == 10 && $days_bet_inact_act > 10) || ($days_bet_inact_current < 10 && $days_bet_inact_current == $days_bet_inact_act".'<br/>';
            if($single_employee['date_inactive'] == date('Y-m-d')){            //send @ inactivate date
                $res = $employee->update_employee_status_by_username($single_employee['username'],0);
                echo "<br>".'Mail send to '.$single_employee['username']."<br>";
                echo $subject = $smarty_obj->translate['before_subject_user_account_inactive_today']. ' ' . $smarty_obj->translate['today'] . ' ' .$smarty_obj->translate['after_subject_user_account_inactive_today'];
                $msg = $smarty_obj->translate['mail_body_user_account_inactive_today'];
                $msg .= '<br /><br />'.$smarty_obj->translate['contact_person'].': '.$single_company['contact_person2'];
                $msg .= '<br />'.$smarty_obj->translate['e_mail']. ': '.$single_company['contact_person2_email'];
                $mailer = new SimpleMail($subject,$msg);
                $mailer->addSender($single_company['email']);
                $mailer->addRecipient($single_employee['email']);
                $mailer->send();
            }else if($days_bet_inact_current > 10){
                //do nothing 
            }else if(($days_bet_inact_current == 10 && $days_bet_inact_act > 10) || ($days_bet_inact_current < 10 && $days_bet_inact_current == $days_bet_inact_act)){
                //send mail
                echo "<br>".'Mail send to '.$single_employee['username']."<br>";
                echo $subject = $smarty_obj->translate['before_subject_user_account_inactive_future']." ". $date_inactive . " " . $smarty_obj->translate['after_subject_user_account_inactive_future'];
                $msg = $smarty_obj->translate['mail_body_user_account_inactive_future'];
                $msg .= '<br /><br />'.$smarty_obj->translate['contact_person'].': '.$single_company['contact_person2'];
                $msg .= '<br />'.$smarty_obj->translate['e_mail']. ': '.$single_company['contact_person2_email'];
                $mailer = new SimpleMail($subject,$msg);
                $mailer->addSender($single_company['email']);
                $mailer->addRecipient($single_employee['email']);
                $mailer->send();
            }
        }
        
        
    }
    /**************************** active mail notification send **************************************/
    $employees = $employee->get_all_employees_for_mail_cron(0);         //0 indicates all inactive employees
    foreach($employees as $single_employee){
        $date_active = $single_employee['date'];
        $current_date = date('Y-m-d');
        $before_10_days_of_active_date = date('Y-m-d', strtotime($date_active.'-10 days'));
//        $diff_bet_act_current = strtotime($date_active) - strtotime($current_date);
//        $days_bet_act_current = floor($diff_bet_act_current / (60*60*24));
            
        if($date_active == date('Y-m-d')){         //send @ activate date
            $res = $employee->update_employee_status_by_username($single_employee['username'],1);
            echo "<br>".'Mail send to '.$single_employee['username']."<br>";
            echo $subject = $smarty_obj->translate['before_subject_user_account_active_today']. ' ' . $smarty_obj->translate['today'] . ' ' .$smarty_obj->translate['after_subject_user_account_active_today'];
            $msg = $smarty_obj->translate['mail_body_user_account_active_today'];
            $msg .= '<br /><br />'.$smarty_obj->translate['contact_person'].': '.$single_company['contact_person2'];
            $msg .= '<br />'.$smarty_obj->translate['e_mail']. ': '.$single_company['contact_person2_email'];
            $mailer = new SimpleMail($subject,$msg);
            $mailer->addSender($single_company['email']);
            $mailer->addRecipient($single_employee['email']);
            $mailer->send();
        }else if($before_10_days_of_active_date == date('Y-m-d')){      //send for future notification of active account
            //send mail
            echo "<br>".'Mail send to '.$single_employee['username']."<br>";
            echo $subject = $smarty_obj->translate['before_subject_user_account_active_future']. " ".$date_active . " " . $smarty_obj->translate['after_subject_user_account_active_future'];
            $msg = $smarty_obj->translate['mail_body_user_account_active_future'];
            $msg .= '<br /><br />'.$smarty_obj->translate['contact_person'].': '.$single_company['contact_person2'];
            $msg .= '<br />'.$smarty_obj->translate['e_mail']. ': '.$single_company['contact_person2_email'];
            $mailer = new SimpleMail($subject,$msg);
            $mailer->addSender($single_company['email']);
            $mailer->addRecipient($single_employee['email']);
            $mailer->send();
        }
    }
}
?>
