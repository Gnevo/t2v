<?php
require_once('class/setup.php');
$smarty = new smartySetup(array('messages.xml'), FALSE);
require_once('class/inconvenient_timing.php');
$inc_timing = new inconvenient_timing();


$name = $_POST['name'];
$date_from = $_POST['date_from'];

if($inc_timing->from_date_check($name,$date_from))
	$smarty->assign('error',1);
$smarty->display('ajax_incon_timing_from_date_check.tpl');
?>