<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();
$obj_emp = new employee();

$i = 0;
$user_id =  $_REQUEST['userid'];
$obj = array();
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
//header("content-type: text/javascript");
echo json_encode($obj);
?>