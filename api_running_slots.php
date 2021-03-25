<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/leave.php');
$leave = new leave();
require_once('class/employee.php');
$obj_emp = new employee();
$i = 0;
$user_id =  $_REQUEST['userid'];
$data = $leave->get_running_tasks($user_id);
//echo "<pre>\n".print_r($data , 1)."</pre>";
if(!empty($data)){
    
    $obj['running']['count'] = count($data);
    foreach($data as $slots) {
            //$leave->employee_get_task_slots()
            $obj['running'][$i] = $slots;
            $i++;
    }
    $obj['complete']['count'] = 0;
    $obj['incomplete']['count'] = 0;
}else{
    $obj['running']['count'] = 0;
    
    $data = $leave->get_slots_closer_to_current_time($user_id, 1);
    if(!empty($data)){
        
        $obj['complete']['count'] = count($data);
        $i = 0;
        foreach($data as $slots) {

                $obj['complete'][$i] = $slots;
                $i++;
        }
        $obj['incomplete']['count'] = 0;
         
    }else{
        $obj['running']['count'] = 0;
        $obj['complete']['count'] = 0;
        $data = $leave->get_slots_closer_to_current_time($user_id, 0);
        //echo "<pre>\n".print_r($data , 1)."</pre>";
        if(!empty($data)){
            $obj['incomplete']['count'] = count($data);
            $i = 0;
            foreach($data as $slots) {

                    $obj['incomplete'][$i] = $slots;
                    $i++;
            }
        }else{
            $obj['incomplete']['count'] = 0;
        }
    }
}
$customers = $obj_emp->customers_list_for_right_click($user_id);
$obj['customers_count'] = count($customers);
$obj['customers'] = $customers;
//echo "<pre>\n".print_r($obj , 1)."</pre>";
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>