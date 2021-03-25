<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
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
$obj = new stdClass();
$obj->count = $count;
//header("content-type: text/javascript");
echo json_encode($obj);
?>