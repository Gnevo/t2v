<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml"), FALSE);
require_once('class/employee.php');
require_once('class/customer.php');
$contr = new employee();

 $hrs = $_POST['hours'];
 $date_from = $_POST['date_from'];
 $date_to = $_POST['date_to'];

$diff = $contr->date_difference($date_from,$date_to);

$tot_month = round($diff/(30*24*60*60)) == 0 ? 1 : round($diff/(30*24*60*60));
$tot_week = round($diff/(7*24*60*60)) == 0 ? 1 : round($diff/(7*24*60*60));
$tot_day = round($diff/(24*60*60)) == 0 ? 1 : round($diff/(24*60*60));

$smarty->assign('monthly_hrs',round($hrs/$tot_month));
$smarty->assign('weekly_hrs',round($hrs/$tot_week));
$smarty->assign('daily_hrs',round($hrs/$tot_day));
$smarty->assign('hrs',$_POST['hours']);
//$smarty->assign('week',$var->current_week);
$smarty->display('ajax_contract_hours.tpl');
?>