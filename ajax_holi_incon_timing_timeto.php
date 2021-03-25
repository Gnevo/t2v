<?php
require_once('class/setup.php');
$smarty = new smartySetup(array('messages.xml',"inconvenient_timing.xml","month.xml"), FALSE);
require_once('class/inconvenient_timing.php');
$inc_timing = new inconvenient_timing();

$id = $_POST['id'];
$dy = $_POST['day_from'];
$mnth = $_POST['month_from'];

$count=$inc_timing->holidays_count($id);

$start = strtotime('1970-'.$mnth.'-'.$dy);
$dates=array();

if ($count>0)
{
$dates[]=date('d', strtotime("+$count[0] day", $start));
$dates[]=date('m', strtotime("+$count[0] day", $start));
}

$smarty->assign('date',$dates);
$smarty->display('ajax_holi_incon_timing_timeto.tpl');
?>