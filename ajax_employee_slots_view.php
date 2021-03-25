<?php
require_once('class/setup.php');
require_once ('class/employee.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","month.xml"), FALSE);
$employee = new employee();
$slots_before =  $employee->timetable_customer_employee_slots('', $_REQUEST['empl'], date('Y-m-d', strtotime('-1 day', strtotime($_REQUEST['date']))));
$slots_present =  $employee->timetable_customer_employee_slots('', $_REQUEST['empl'], $_REQUEST['date']);
$slots_after =  $employee->timetable_customer_employee_slots('', $_REQUEST['empl'], date('Y-m-d', strtotime('+1 day', strtotime($_REQUEST['date']))));
$smarty->assign('slots_before',$slots_before);
$smarty->assign('slots_present',$slots_present);
$smarty->assign('slots_after',$slots_after);
$today = date('N',  strtotime($_REQUEST['date']));
$large = 0;
if(count($slots_before) > count($slots_after)){
    $large = count($slots_before);
}elseif(count($slots_after)> count($slots_before)){
    $large = count($slots_after);
}else{
   $large = count($slots_after); 
}
if($large > count($slots_present)){
    $smarty->assign('large_sides',$large);
    $smarty->assign('large_centre','');
}
elseif($large < count($slots_present)){
    $smarty->assign('large_sides','');
    $smarty->assign('large_centre',count($slots_present));
}elseif($large == count($slots_present)){
    $smarty->assign('large_sides','');
    $smarty->assign('large_centre',$large+1);
    $smarty->assign('large_common','1');
}


if($today == 1){
    $yesterday = $smarty->translate[sunday];
    $present = $smarty->translate[monday];
    $tomo = $smarty->translate[tuesday];
}elseif($today == 2){
    $yesterday = $smarty->translate[monday];
    $present = $smarty->translate[tuesday];
    $tomo = $smarty->translate[wednesday];
}elseif($today == 3){
    $yesterday = $smarty->translate[tuesday];
    $present = $smarty->translate[wednesday];
    $tomo = $smarty->translate[thursday];
}elseif($today == 4){
    $yesterday = $smarty->translate[wednesday];
    $present = $smarty->translate[thursday];
    $tomo = $smarty->translate[friday];
}elseif($today == 5){
    $yesterday = $smarty->translate[thursday];
    $present = $smarty->translate[friday];
    $tomo = $smarty->translate[saturday];
}elseif($today == 6){
    $yesterday = $smarty->translate[friday];
    $present = $smarty->translate[saturday];
    $tomo = $smarty->translate[sunday];
}elseif($today == 7){
    $yesterday = $smarty->translate[saturday];
    $present = $smarty->translate[sunday];
    $tomo = $smarty->translate[monday];
}
$smarty->assign('yesterday',$yesterday);
$smarty->assign('today',$present);
$smarty->assign('tomorrow',$tomo);
//echo "<pre>". print_r($slots_before, 1)."</pre>";
//echo "<pre>". print_r($slots_present, 1)."</pre>";
//echo "<pre>". print_r($slots_after, 1)."</pre>";
$smarty->display('ajax_employee_slots_view.tpl');
?>