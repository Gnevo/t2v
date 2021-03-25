<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/leave.php');
$leave = new leave();
$count = 0;
$data = $leave->get_alloc_user_messages();
foreach($data as $row) {
	if($row['employee'] == "")
		$count++;
}
//echo "<pre>\n".print_r($data, 1)."</pre>";
//echo $count;
//exit();
$obj->count = $count;
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>