<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$obj = array();
$i = 0;
$j = 0;
$date = strtotime($_REQUEST['start_date']);

while($date <= strtotime($_REQUEST['end_date'])){
    
    if($j == 0 && $date == strtotime($_REQUEST['end_date'])){
        
        $data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['start_date'],$_REQUEST['time_from'],$_REQUEST['time_to']);
    }
    else if($j == 0){
        $data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['start_date'],$_REQUEST['time_from'],24);
    }
    else if($j != 0 && $date < strtotime($_REQUEST['end_date'])){
        $data = $leave->employee_get_leave_slot($_REQUEST['user'],date('Y-m-d',$date),0,24);
    }
    else if($j != 0 && $date == strtotime($_REQUEST['end_date'])){
        $data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['end_date'],0,$_REQUEST['time_to']);
    }
    
    foreach($data as $slot) {

            $user_details = $leave->get_customer_detail($slot['customer']);
            $obj[$i]->slotid = $slot['id'];
            $obj[$i]->customer = $slot['customer'];
            $obj[$i]->first_name = $user_details['first_name'];
            $obj[$i]->last_name = $user_details['last_name'];
            $obj[$i]->short_name = $user_details['first_name'][0].' '.$user_details['last_name'][0].$user_details['last_name'][1].$user_details['last_name'][2];
            $obj[$i]->date = $slot['date'];
            $obj[$i]->time_from = $slot['time_from'];
            $obj[$i]->time_to = $slot['time_to'];
            $i++;
    }
    $date = strtotime('+1 day', $date);
    $j++;
}
//echo "<pre>\n".print_r($obj, 1)."</pre>";
//header("content-type: text/javascript");
echo json_encode($obj);
?>