<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/general.php');
require_once('class/mail.php');
require_once('class/root_operation.php');
require_once('class/employee.php');
require_once('class/timetable.php');

$company_obj   = new company();
$obj_general   = new general();
$obj_root      = new root_operation();
$obj_emp       = new employee(); 
$obj_timetable = new timetable();
$smarty_obj    = new smartySetup(array("company.xml", "mail.xml"),FALSE);
$companies     = $company_obj->company_list();

/////  calculating boundary date  ///////

$obj_root->boundary_date = $boundary_date = $obj_general->get_boundary_date();


// var_dump($companies, $boundary_date);exit('sdf');

foreach($companies as $key => $single_company){
    // if($single_company['db_name'] == 'time2vie_cirrusdemo'){
        $obj_root->select_db($single_company['db_name']);
        $obj_emp->select_db($single_company['db_name']);
        $obj_timetable->select_db($single_company['db_name']);
        $transaction_flag = TRUE;
        $obj_root->begin_transaction();

        $transaction_flag = $obj_root->copy_details_to_backup_column();

        // echo $single_company['sem_year_start_month'];
        // $obj_root ->calculate_rem_sem_leave();
        if($single_company['sem_year_start_month'] != '' && $transaction_flag){
            $last_week = date("W", mktime(0,0,0,12,31,date('Y')));
            $no_of_weeks_in_a_year = 52;
            if($last_week == 53){
                $no_of_weeks_in_a_year = 53;
            }
            $show_sem_leave       = TRUE;
            $sem_year_start_month = intval(trim($single_company['sem_year_start_month']));
            $all_employee         = $obj_root->employee_list($single_company['db_name']);
            
            if($all_employee){
                foreach ($all_employee as $key => $employee) {
                    $employee_details = $obj_emp->get_employee_detail($employee['username']);
                    $leave_in_advance = FALSE;
                    if($company_details['leave_in_advance'] == 1) $leave_in_advance = TRUE;
                    else if($employee_details['leave_in_advance'] == 1) $leave_in_advance = TRUE;
                    $include_sick_in_sem_calc = 1;
                    $include_sick_in_sem_calc = $company_details['include_sick'];
                    if($leave_in_advance){

                        $remaining_no_of_sem_leaves     = trim($employee_details['remaining_sem_leave']) != '' ? $employee_details['remaining_sem_leave'] : 0;
                        $remaining_sem_leaves_upto_date = (trim($employee_details['sem_leave_todate']) != '' && trim($employee_details['sem_leave_todate']) != NULL && trim($employee_details['sem_leave_todate']) != '0000-00-00') ? $employee_details['sem_leave_todate'] : NULL;

                        $former_year_sem_start_date = NULL;
                        if($remaining_sem_leaves_upto_date != NULL)
                            $former_year_sem_start_date = date('Y-m-d',strtotime($remaining_sem_leaves_upto_date));
                        else if($employee_details['date'] != '')
                            $former_year_sem_start_date = $employee_details['date'];    //activated date

                        if($former_year_sem_start_date < date('Y-m-d',strtotime($boundary_date))){

                            $former_year_earned_days           = 0;
                            $former_year_takens_sem_leave_days = 0;
                            //echo $employee_details['username']."-".$former_year_sem_start_date."-".$former_year_sem_end_date;
                            $former_year_sem_end_date          = date('Y-m-d',strtotime($boundary_date));
                            $former_year_earned_days           = $obj_timetable->get_earned_sem_leave_days($employee['username'], $former_year_sem_start_date, $former_year_sem_end_date, $no_of_weeks_in_a_year,$single_company['db_name']);
                            //Taken no.of sem leave days from Former years
                            $former_year_takens_sem_leave_days = $obj_timetable->get_taken_sem_leave_days($employee['username'], $former_year_sem_start_date, $former_year_sem_end_date,$single_company['db_name']);
                            $former_year_remaining_days        = $remaining_no_of_sem_leaves + max($former_year_earned_days - $former_year_takens_sem_leave_days, 0);

                            

                            $sem_leave_details_array[$single_company['db_name']][$employee['username']] = array(
                                'former_year_remaining_days'       => $former_year_remaining_days
                            );
                        }
                    }
                    else{
                        //find Former years remaining earned days
                        $remaining_no_of_sem_leaves     = trim($employee_details['remaining_sem_leave']) != '' ? $employee_details['remaining_sem_leave'] : 0;
                        $remaining_sem_leaves_upto_date = trim($employee_details['sem_leave_todate']) != '' ? $employee_details['sem_leave_todate'] : NULL;
                        $former_year_sem_start_date     = NULL;
                        if($remaining_sem_leaves_upto_date != NULL)
                            $former_year_sem_start_date = date('Y-m-d', strtotime($remaining_sem_leaves_upto_date));
                        else if($employee_details['date'] != '')    
                            $former_year_sem_start_date = $employee_details['date'];    //activated date
                        // echo $former_year_sem_start_date;
                        if($former_year_sem_start_date < date('Y-m-d',strtotime($boundary_date))){
                            $former_year_earned_days           = 0;
                            $former_year_takens_sem_leave_days = 0;
                            //echo $employee_details['username']."-".$former_year_sem_start_date."-".$former_year_sem_end_date;
                            $former_year_sem_end_date          = date('Y-m-d',strtotime($sem_start_date));
                            $former_year_earned_days           = $obj_timetable->get_earned_sem_leave_days($employee['username'], $former_year_sem_start_date, $former_year_sem_end_date, $no_of_weeks_in_a_year,$single_company['db_name']);
                            //Taken no.of sem leave days from Former years
                            $former_year_takens_sem_leave_days = $obj_timetable->get_taken_sem_leave_days($employee['username'], $former_year_sem_start_date, $former_year_sem_end_date,$single_company['db_name']);
                            
                            $former_year_remaining_days        = $remaining_no_of_sem_leaves + max($former_year_earned_days - $former_year_takens_sem_leave_days, 0);
                            $sem_leave_details_array[$single_company['db_name']][$employee['username']] = array(
                                'former_year_remaining_days'       => $former_year_remaining_days
                            );
                        }
                    }
                    $transaction_flag = $obj_root ->new_reminaing_semleave_add_employee_table($single_company['db_name'],$employee['username'] ,$former_year_remaining_days); 

                    if(!$transaction_flag) break;
                }
            }
        }

        if($transaction_flag) 
            $transaction_flag = $obj_root->backup_data();
        // $obj_root ->new_reminaing_semleave_add_employee_table($sem_leave_details_array); 

        if($transaction_flag){
            $obj_root->commit_transaction();
            $result_color = '#1c841c';  //green
            echo 'Backup Process - <b style="color: '.$result_color.'">'.$single_company['name'].'</b> <small>(ID: '.$single_company['id'].' | DB: '.$single_company['db_name'].')</small> has been successfully done.<br/>';
        }
        else{
            $obj_root->rollback_transaction();
            $result_color = '#e03e3e';  //red
            echo 'Backup Process - <b style="color: '.$result_color.'">'.$single_company['name'].'</b> <small>(ID: '.$single_company['id'].' | DB: '.$single_company['db_name'].')</small> has been failed.<br/>';

            $subject = $smarty_obj->translate['mail_subject_error_backup_process'];
            $body_msg_template = $smarty_obj->translate['mail_body_error_backup_process'];
            $body_msg_template = str_replace ('{{COMPANY-NAME}}', $single_company['name'] , $body_msg_template);
            $body_msg_template = str_replace ('{{COMPANY-DB}}', $single_company['db_name'] , $body_msg_template);

            $mailer = new SimpleMail($subject, $body_msg_template);
            $mailer->addSender($single_company['email']);
            
            $mailer->addRecipient('shajukt@entraze.com');
            $mailer->addRecipient('shamsu@arioninfotech.com');
            // $mailer->addRecipient('support@time2view.se');
            $mailer->send();

            // echo $recipient_mail. '-- '.$body_msg_template.'<br/>--------------------------<br/><br/><br/><br/>';
        }
    // }
}
// $obj_root ->new_reminaing_semleave_add_employee_table($sem_leave_details_array); 
// echo "<pre>".print_r($sem_leave_details_array, 1)."</pre>"; exit();
?>