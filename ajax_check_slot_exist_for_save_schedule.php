<?php
/**
 * @author: Shamsudheen<shamsu@arioninfotech.com> on 05-10-2013
 * for: check any of customer slot exist on a specified dates
 * used in: while save customer schedules
*/
//require_once('class/employee.php');
//$employee = new employee();

require_once('class/newcustomer.php');
$obj_customer = new newcustomer();

$return_obj = array( 'exists' => 'no');

$postdataDate = array_unique($_REQUEST['postdataDate']);
$customer_name = $_REQUEST["customer"];
$exist_slot_year_weeks = array();
if(!empty($postdataDate)){
    foreach($postdataDate as $date){
            $date_slot_details = $obj_customer->get_timeslots_by_customer_date($customer_name, $date);
            if(!empty($date_slot_details)){
//                $exist_slot_year_weeks[] = date('Y|W', strtotime($date));
                $exist_slot_year_weeks[] = date('Y|W', strtotime($date));
            }
    }
}
$exist_slot_year_weeks = array_values(array_unique($exist_slot_year_weeks));

/*
$returned_new_year_week_array = array();
if(!empty($exist_slot_year_weeks)){
    foreach($exist_slot_year_weeks as $entries){
        $data_values = explode('|', $entries);
        $returned_new_year_week_array[] = array('year' => $data_values[0], 'week' => $data_values[1]);
    }
}
*/
//echo "<pre>".print_r($exist_slot_year_weeks, 1)."</pre>";
$return_obj['exists'] = (empty($exist_slot_year_weeks) ? 'no' : 'yes');
//if(!empty($exist_slot_year_weeks)) $return_obj['exists_weeks'] = $returned_new_year_week_array;
if(!empty($exist_slot_year_weeks)) $return_obj['exists_weeks'] = $exist_slot_year_weeks;
echo json_encode($return_obj);
?>