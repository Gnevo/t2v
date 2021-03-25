<?php
/**
 * Author: Shamsudheen
 * for: check is this karense day or not
 * Used In: gdschema slot manage => save leave
*/
require_once('class/setup.php');
//require_once('class/employee.php');
require_once('class/dona.php');
require_once('class/equipment.php');
require_once('class/converter.php');
$smarty = new smartySetup(array("gdschema.xml", 'messages.xml'), FALSE);
//$obj_emp   = new employee();
$obj_dona   = new dona();
$equipment = new equipment();
$obj_converter = new converter(array(), array(), date('Y'));

$leave_taken_beween = trim($_REQUEST['leave_taken_beween']);
$leave_date = trim($_REQUEST['date']);
$leave_employee = trim($_REQUEST['employee']);

$return_obj = array();
if($leave_date != '' && $leave_employee != ''){

    $time_from_leave_taken = $leave_taken_beween == 'time' ? (float) $_REQUEST['leave_time_from'] : 0.00;
    $time_to_leave_taken = $leave_taken_beween == 'time' ? (float) $_REQUEST['leave_time_to'] : 24.00;

    $karense_details = $obj_converter->get_karens_data($leave_employee, '', array(), 'SINGLE_DATE', NULL, NULL, $leave_date, sprintf('%05.02f', $time_from_leave_taken), sprintf('%05.02f', $time_to_leave_taken));
    $return_obj['karense'] = FALSE;
    if($karense_details !== FALSE){
        if(isset($karense_details['deduction'])) $karense_details['deduction'] = round($karense_details['deduction'], 2);
        if(isset($karense_details['karens'])) $karense_details['karens'] = round($karense_details['karens'], 2);
        if(isset($karense_details['karens_deducted'])) $karense_details['karens_deducted'] = round($karense_details['karens_deducted'], 2);
        $return_obj['karense'] = $karense_details;
        $return_obj['karense']['remaining'] = round($karense_details['deduction'] - $karense_details['karens_deducted'] - $karense_details['karens'], 2);
    }
    // $return_obj['karense_parameters'] = array($leave_employee, '', array(), 'SINGLE_DATE', NULL, NULL, $leave_date, sprintf('%05.02f', $time_from_leave_taken), sprintf('%05.02f', $time_to_leave_taken));
    
    $date_diff_for_qlfying = 5;
    $return_obj['transaction'] = TRUE;
    
    /*$this_date_digits = explode('-', $leave_date);
    $this_month_leave_works = $obj_dona->get_employee_leaved_timetable_works($leave_employee, $this_date_digits[0], $this_date_digits[1]);
    
    $get_previous_month = date('Y-m-d', strtotime($leave_date . ' -1 month')); // previous month;
    $previous_date_digit = explode('-', $get_previous_month);
    $previous_month_leave_works = $obj_dona->get_employee_leaved_timetable_works($leave_employee, $previous_date_digit[0], $previous_date_digit[1]);
    */
    
    /*if($leave_taken_beween == 'time' || $leave_taken_beween == 'dates'){
        
        $return_obj['transaction'] = TRUE;
        $leave_works = array();
        
        if($leave_taken_beween == 'time')
            $leave_works = $obj_dona->get_employee_leaved_timetable_works_before_the_date($leave_employee, $leave_date, (float) $_REQUEST['leave_time_from']);
        else if($leave_taken_beween == 'dates')
            $leave_works = $obj_dona->get_employee_leaved_timetable_works_before_the_date($leave_employee, $leave_date, 0.00);
        
        $is_karense_day = false;
        if(!empty($leave_works)){
            $dateto = strtotime($leave_date, 0);
            
            // foreach($leave_works as $leave_work){
            //     $leave_work_date = $leave_work['date'];
            //     $datefrom = strtotime($leave_work_date, 0);
            //     $difference = floor(($dateto - $datefrom) / 86400);

            //     if ($difference > $date_diff_for_qlfying && $leave_work['no_pay'] == 1){
            //         $is_karense_day = true;
            //         break;
            //     }
            // }
            //echo $leave_works[0]['date']."-".$leave_date;
            $leave_work_date = $leave_works[0]['date'];
            $datefrom = strtotime($leave_work_date, 0);
            $difference = floor(($dateto - $datefrom) / 86400);
            
            if ($difference > $date_diff_for_qlfying){
                $is_karense_day = true;
            }elseif($difference == 1){
                
                if($_REQUEST['slot_type'] == $leave_works[0]['type'] && intval($leave_works[0]['time_to'],0) ==24 && $_REQUEST['time_from'] == 0.00){
                    
                    $prev_day_total_time = 0;
                    foreach($leave_works as $leave_work){
                        if(strtotime($leave_work['date'],0) == $leave_work_date){
                            
                            $prev_day_total_time = $equipment->time_sum($prev_day_total_time, $equipment->time_difference($leave_work['time_to'], $leave_work['time_from']));
                        }
                        else
                            break;
                        
                    }
                    if($prev_day_total_time < 8)
                        $is_karense_day = true;
                }else{
                    
                    $is_karense_day = false;
                }
            }
        } else{
            $is_karense_day = true;
        }
        
        $return_obj['karense'] = $is_karense_day;
        $return_obj['karense_date'] = $leave_work_date;
    }*/
}
if(empty($return_obj)){
    $return_obj['transaction'] = FALSE;
    $return_obj['error_reason'] = $smarty->translate['something_wrong'];
}
//echo "<pre>".print_r($return_obj,1)."</pre>";
echo json_encode($return_obj);
//$smarty->display('ajax_get_avail_employees_for_PM.tpl');
?>