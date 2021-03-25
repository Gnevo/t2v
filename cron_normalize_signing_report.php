<?php
error_reporting(E_ALL);
error_reporting(E_WARNING);
ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);

ini_set('memory_limit', '1G');
set_time_limit ( FALSE );
// echo ini_get('memory_limit');

/*
 * created by: Shamsu
 * purpose : Converting signing report table contents to its detailed table
 */
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/timetable.php');


$smarty_obj = new smartySetup(array("company.xml"),FALSE);

$company_obj = new company();
$obj_timetable = new timetable();

$until      = new DateTime();
$until->setTimestamp(time());
$until->setTimezone(new DateTimeZone('Europe/Stockholm'));
// $interval   = new DateInterval('P2M');//2 months
// $until->sub($interval);
$process_date_till = $until->format('Y-m-t');
// echo $process_date_till; exit();

$companies = $company_obj->company_list();
$length_to_compare = 5;

echo "<pre><h2><strong>Report Signing Normalization Results: </strong></h2></pre><br/>";

$counter = 1;
foreach ($companies as $single_company) {
    if($single_company['id'] != 2) continue;

    $obj_timetable->select_db($single_company['db_name']);

    // $signing_datas = array();
    $signing_datas = $obj_timetable->get_report_signings_which_has_sign_data($process_date_till);
    // echo '------------------'.$single_company['name'].'------------------<br/>';
    // echo "<pre>".print_r(count($signing_datas), 1)."</pre>";
    // exit();
    
    // $employee_list_ids = array();
    $transaction_flag = TRUE;
    $record_count = 0;


    if(!empty($signing_datas)){
        $obj_timetable->begin_transaction();
        foreach ($signing_datas as $sdata) {
            $sign_e = $ocs_e = $sign_tl = $ocs_tl = $sign_sutl = $ocs_sutl = FALSE; 
            if(trim($sdata['employee_sign']) != "" && strlen(trim($sdata['employee_sign'])) > $length_to_compare)   $sign_e = TRUE;
            if(trim($sdata['employee_ocs']) != "" && strlen(trim($sdata['employee_ocs'])) > $length_to_compare)     $ocs_e = TRUE;
            if(trim($sdata['tl_sign']) != "" && strlen(trim($sdata['tl_sign'])) > $length_to_compare)               $sign_tl = TRUE;
            if(trim($sdata['tl_ocs']) != "" && strlen(trim($sdata['tl_ocs'])) > $length_to_compare)                 $ocs_tl = TRUE;
            if(trim($sdata['sutl_sign']) != "" && strlen(trim($sdata['sutl_sign'])) > $length_to_compare)           $sign_sutl = TRUE;
            if(trim($sdata['sutl_ocs']) != "" && strlen(trim($sdata['sutl_ocs'])) > $length_to_compare)             $ocs_sutl = TRUE;

            if($sign_e || $ocs_e || $sign_tl || $ocs_tl || $sign_sutl || $ocs_sutl){
                $existing_row = $obj_timetable->get_detailed_report_signing_details_by_id($sdata['id']);

                //already exist
                if(!empty($existing_row)){
                    $transaction_flag = $obj_timetable->update_detailed_report_signing($sdata, $sign_e, $ocs_e, $sign_tl, $ocs_tl, $sign_sutl, $ocs_sutl);
                }
                // create new
                else{
                    $transaction_flag = $obj_timetable->insert_detailed_report_signing($sdata, $sign_e, $ocs_e, $sign_tl, $ocs_tl, $sign_sutl, $ocs_sutl);
                }

                if($transaction_flag){
                    $transaction_flag = $obj_timetable->update_sign_data_on_report_signing($sdata, $sign_e, $ocs_e, $sign_tl, $ocs_tl, $sign_sutl, $ocs_sutl);
                }
            }

            if(!$transaction_flag) break;

            $record_count++;
        }

        if($transaction_flag){
            $obj_timetable->commit_transaction();
            $result_color = '#1c841c';  //green
            echo $counter.'. <b style="color: '.$result_color.'">'.$single_company['name'].'</b> <small>(ID: '.$single_company['id'].' | DB: '.$single_company['db_name'].')</small> - Normalization has been successfully done (Total Records: '.$record_count.').<br/>';
        }
        else{
            $obj_timetable->rollback_transaction();
            $result_color = '#e03e3e';  //red
            echo $counter.'. <b style="color: '.$result_color.'">'.$single_company['name'].'</b> <small>(ID: '.$single_company['id'].' | DB: '.$single_company['db_name'].')</small> - Normalization has been failed.<br/>';
        }
    }
    else{
        $result_color = '#753ee0';  //violet
        echo $counter.'. <b style="color: '.$result_color.'">'.$single_company['name'].'</b> <small>(ID: '.$single_company['id'].' | DB: '.$single_company['db_name'].')</small> - No record to process the Normalization.<br/>';
    }

    $counter++;
    // if(!empty($employee_list_ids))
    //     echo "notification employees: <pre>".print_r($employee_list_ids, 1)."<pre>";
    
}
?>