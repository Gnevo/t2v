<?php
require_once('class/setup.php');
$smarty = new smartySetup(array('messages.xml',"inconvenient_timing.xml","month.xml"), FALSE);
require_once('class/inconvenient_timing.php');
$inc_timing = new inconvenient_timing();


$id = $_POST['id'];
$dy = $_POST['day_from'];
$mnth = $_POST['month_from'];

$rb_day=$inc_timing->holiday_details($id);
$timings=$inc_timing->holiday_time($id);

$start = strtotime('1970-'.$mnth.'-'.$dy);
$dates=array();
/******************************/
//require_once('configs/config.inc.php');
//global $month;

/******************************/
for($i=0,$t=0; $i<count($rb_day); $i++)
{
    $dates[$i][0]=date('d', strtotime("+$i day", $start));
    $dates[$i][1]=date('m', strtotime("+".$i." day", $start));
}

/*for($i=0; $i<count($rb_day);$i++)
{
    $t=$dates[$i][1];
    echo $t;
    $dates[$i][1]=$smarty->translate[$month[$t]['month']];
}*/
$smarty->assign('date',$dates);

if(!empty($rb_day))
{
    
	$smarty->assign('times',$timings);
        //print_r($timings);
        $smarty->assign('rb_days',$rb_day);
}
$smarty->display('ajax_holi_incon_timing_ByID.tpl');
?>