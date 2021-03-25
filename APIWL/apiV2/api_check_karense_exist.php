<?php
require_once('api_common_functions.php');
$session_check = check_user_session();
/**
 * Author: Shamsudheen
 * for: check is this karense day or not
 * Used In: gdschema slot manage => save leave
*/

require_once('class/setup.php');
require_once('class/dona.php');
require_once('class/equipment.php');
require_once ('class/converter.php');

$smarty = new smartySetup(array("gdschema.xml", 'messages.xml'), FALSE);
$obj_dona   = new dona();
$equipment = new equipment();
$obj_convertor = new Converter(array(),array(),date('Y'));

$leave_taken_beween = trim($_REQUEST['leave_taken_beween']);
$leave_date     = trim($_REQUEST['date']);
$leave_employee = trim($_REQUEST['employee']);

$return_obj = new stdClass();
$return_obj->session_status = $session_check;

if($leave_date != '' && $leave_employee != ''){
    
    // $date_diff_for_qlfying = 5;
    if($leave_taken_beween == 'time' || $leave_taken_beween == 'dates'){
        
        $return_obj->transaction = TRUE;

        /*$leave_works = array();
        
        if($leave_taken_beween == 'time')
            $leave_works = $obj_dona->get_employee_leaved_timetable_works_before_the_date($leave_employee, $leave_date, (float) $_REQUEST['leave_time_from']);
        else if($leave_taken_beween == 'dates')
            $leave_works = $obj_dona->get_employee_leaved_timetable_works_before_the_date($leave_employee, $leave_date, 0.00);
        
        $is_karense_day = false;
        if(!empty($leave_works)){
            $dateto = strtotime($leave_date, 0);
            
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
                }else
                    $is_karense_day = false;
            }
        } else
            $is_karense_day = true;
        
        $return_obj->karense = $is_karense_day;
        $return_obj->karense_date = $leave_work_date;*/
        //echo $leave_employee."-".$leave_date."--".$_REQUEST['leave_time_from']."--".$_REQUEST['leave_time_to'];
        $result = $obj_convertor->get_karens_data($leave_employee, null, array(), $date_type='SINGLE_DATE', null, null, $leave_date, $_REQUEST['leave_time_from'], $_REQUEST['leave_time_to'], FALSE);
        if($result !== FALSE){
            $return_obj->karens = $result;
            if(isset($return_obj->karens['deduction'])) $return_obj->karens['deduction'] = round($return_obj->karens['deduction'], 2);
            if(isset($return_obj->karens['karens']))    $return_obj->karens['karens'] = round($return_obj->karens['karens'], 2);
            if(isset($return_obj->karens['deduction'])) $return_obj->karens['karens_deducted'] = round($return_obj->karens['karens_deducted'], 2);
            $return_obj->karens['remaining'] = round($return_obj->karens['deduction'] - $return_obj->karens['karens_deducted'] - $return_obj->karens['karens'], 2);
        }
        else
            $return_obj->karens = json_decode('{}');        
    }
}
if(!isset($return_obj->transaction)){
    $return_obj->transaction = FALSE;
    //$return_obj->error_reason = $smarty->translate['something_wrong'];
}
echo json_encode($return_obj);
?>