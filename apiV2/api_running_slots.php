<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/employee.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();
$obj_emp = new employee();
$obj_general = new general();

// $i = 0;
$user_id =  $_REQUEST['userid'];
$obj = new stdClass();
$data = $leave->get_running_tasks($user_id);

if(!empty($data)){
    
    $obj->running['count'] = count($data);
    $obj->running['data'] = $data;
    /*foreach($data as $slots) {
            //$leave->employee_get_task_slots()
            $obj->running[$i] = $slots;
            $i++;
    }*/
    $obj->complete['count'] = 0;
    $obj->incomplete['count'] = 0;
}else{
    $obj->running['count'] = 0;
    
    $data = $leave->get_slots_closer_to_current_time($user_id, 1);
    if(!empty($data)){
        
        $obj->complete['count'] = count($data);
        $data = $obj_general->traverse_all_elements_set_null_to_empty($data);
        $obj->complete['data'] = $data;
        /*$i = 0;
        foreach($data as $slots) {

                $obj->complete[$i] = $slots;
                $i++;
        }*/
        $obj->incomplete['count'] = 0;
         
    }else{
        $obj->running['count'] = 0;
        $obj->complete['count'] = 0;
        $data = $leave->get_slots_closer_to_current_time($user_id, 0);
        if(!empty($data)){
            $obj->incomplete['count'] = count($data);
            $data = $obj_general->traverse_all_elements_set_null_to_empty($data);
            $obj->incomplete['data'] = $data;
            /*$i = 0;
            foreach($data as $slots) {

                    $obj->incomplete[$i] = $slots;
                    $i++;
            }*/
        }else{
            $obj->incomplete['count'] = 0;
        }
    }
}

$customers = $obj_emp->customers_list_for_right_click($user_id,1);
//echo "<pre>\n".print_r($customers , 1)."</pre>";
foreach($customers as $key => $customer){
    $__customer_locations_serialized = $customer['map_location'];
    $__customer_locations_deserialized = array();
    if($__customer_locations_serialized != NULL) $__customer_locations_deserialized = unserialize($__customer_locations_serialized);

    $default_locations = array();
    if(!empty($__customer_locations_deserialized)){
        foreach($__customer_locations_deserialized as $this_location){
            if($this_location['is_default']){
                $default_locations[] = $this_location;
            }
        }
    }
    /*if($customer['username'] == 'rabu001'){
    //if($customers[$key]['map_location']){
        //echo $customer['map_location'];
        //print_r(unserialize($customer['map_location']));
        $customers[$key]['map_location'] = unserialize($customer['map_location']);
    }//}
    else
        $customers[$key]['map_location'] = array();*/

    $customers[$key]['map_location'] = $default_locations;
}
$customers = $obj_general->traverse_all_elements_set_null_to_empty($customers);
$obj->customers_count = count($customers);
$obj->customers = $customers;
$min_start_time = new DateTime;
$min_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
$min_start_time->setTimestamp(time());
$min_start_time = $min_start_time->format('Y-m-d G:i:s');
/*$min_start_time = round(strtotime($min_start_time) / (5 * 60)) * (5 * 60);
$obj['server_time'] = date('Y-m-d G:i:s', $min_start_time);*/
$obj->server_time = $min_start_time;
$obj->session_status = $session_check;
echo json_encode($obj);
?>