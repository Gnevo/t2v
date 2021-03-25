<?php
session_start();
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$leave = new leave();
$i = 0;

$sel_year = trim($_REQUEST['year']);
$sel_month = trim($_REQUEST['month']);

//$data = $leave->get_future_schedule($_REQUEST['user'], $_REQUEST['date'], $_REQUEST['navigation']);
$data = $leave->get_future_schedule($_REQUEST['user'], $sel_year, $sel_month);
//echo "<pre>".print_r($data, 1)."</pre>";
foreach($data as $slot) {

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
}
//echo "<pre>".print_r($obj, 1)."</pre>";
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';


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