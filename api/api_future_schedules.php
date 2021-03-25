<?php
//error_reporting(E_ALL);
//error_reporting(E_WARNING);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/leave.php');
require_once('class/employee.php');
//$_SESSION['db_name'] = 'time2vie_cirrusdemo';
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$leave = new leave();
$obj_employee = new employee();
$i = 0;
$sel_year = trim($_REQUEST['year']);
$sel_month = trim($_REQUEST['month']);

//$data = $leave->get_future_schedule($_REQUEST['user'], $_REQUEST['date'], $_REQUEST['navigation']);
$data = $leave->get_future_schedule($_REQUEST['user'], $sel_year, $sel_month);
//echo "<pre>".print_r($leave->query_error_details, 1)."</pre>";
$obj = array();
$j = 0;

/*foreach($data as $slot) {

	$user->username =  $slot['customer'];
	$tmp = $user->get_customer_detail();
	$obj[$i]->slotid = $slot['id'];
	$obj[$i]->customer = $slot['customer'];
	$obj[$i]->first_name = $tmp['first_name'];
	$obj[$i]->last_name = $tmp['last_name'];
	$obj[$i]->date = $slot['date'];
	$obj[$i]->week = $slot['week'];
	$obj[$i]->time_from = $slot['time_from'];
	$obj[$i]->time_to = $slot['time_to'];
        $obj[$i]->total_hours = str_replace('.', ':', time_difference($slot['time_from'], $slot['time_to']));
	$obj[$i]->status = $slot['status'];
	$obj[$i]->type = $slot['type'];
	$obj[$i]->fkkn = $slot['fkkn'];
	$obj[$i]->comment = $slot['comment'];
	$i++;
}*/

$prev_week = 0;
$j= -1;
//echo "----------------------------------------------";
foreach($data as $slot) {

	$user->username =  $slot['customer'];
	$tmp = $user->get_customer_detail();
        //echo "<pre>".print_r($tmp,1)."</pre>";
        $obj[$i] = new stdClass();
	$obj[$i]->slotid = $slot['id'];
	$obj[$i]->customer = $slot['customer'];
	$obj[$i]->first_name = $tmp['first_name'];
	$obj[$i]->last_name = $tmp['last_name'];
	$obj[$i]->date = $slot['date'];
        if($prev_week != $slot['week'])
            $obj[$i]->week = $slot['week'];
        else
            $obj[$i]->week = NULL;
	$obj[$i]->time_from = $slot['time_from'];
	$obj[$i]->time_to = $slot['time_to'];
        $obj[$i]->total_hours = str_replace('.', ':', time_difference($slot['time_from'], $slot['time_to']));
	$obj[$i]->status = $slot['status'];
	$obj[$i]->type = $slot['type'];
	$obj[$i]->fkkn = $slot['fkkn'];
	$obj[$i]->comment = $slot['comment'];
        $obj[$i]->created_status = $slot['created_status'];
        $obj[$i]->signed = $slot['signed'];
        if($slot['status'] == 2){
            $leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'],$slot['date'],$slot['time_from'],$slot['time_to']);
            $obj[$i]->leave_type = $smarty->leave_type[$leave_data[0]['type']];
        }else{
            $obj[$i]->leave_type = null;
        }
	$i++;
        $prev_week = $slot['week'];
}

//echo "<pre>".print_r($obj, 1)."</pre>";
//header("content-type: text/javascript");
echo json_encode($obj);


function time_difference($t1, $t2, $mod=60) {
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        //$time1 = ((intval($a1[0]) * 60 * 60) + (str_pad(intval($a1[1]), 2, '0', STR_PAD_RIGHT) * 60));
        //$time2 = ((intval($a2[0]) * 60 * 60) + (str_pad(intval($a2[1]), 2, '0', STR_PAD_RIGHT) * 60));
        $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        if($mod == 100)
            $mins = round($mins*100/60);
        //$result = $hours . "." . sprintf('%02d', $mins);
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }
?>