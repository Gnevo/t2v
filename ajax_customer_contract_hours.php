<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once ('class/customer.php');
require_once ('class/equipment.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "billing.xml"), FALSE);
$employee = new employee();
$customer = new customer();
$equipment = new equipment();

$hrs        = trim($_REQUEST['hours']);
$date_from  = trim($_REQUEST['sdate']);
$date_to    = trim($_REQUEST['edate']);
$customers  = trim($_REQUEST['customer']);
$fkkn = ($_REQUEST['fkkn'] == 'fk' ? 1 : 2);

if($date_from != '' && $date_to != ''){
    $diff = $employee->date_difference($date_from, $date_to);
//else 
//    $diff = 0;
    //$tot_month = round($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : round($diff / (30 * 24 * 60 * 60));
    //$tot_week = round($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : round($diff / (7 * 24 * 60 * 60));
    //$tot_day = round($diff / (24 * 60 * 60)) == 0 ? 1 : round($diff / (24 * 60 * 60));
    //$tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
    //$tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
    $tot_day = abs(floor($diff / (24 * 60 * 60)))+1;    //adding 1 for including count both boudary dates
    $current_date = date('Y-m-d');
    $oncall = $customer->oncall_customer($customers,$date_from,$date_to);
    if (strtotime($current_date) < strtotime($date_from)) {
        $remaining_hours = $hrs;
    } else if (strtotime($current_date) > strtotime($date_to)) {

        $remaining_hours = "0";
    } else {

        //$total_hours = $customer->get_timetable_customer($customers, $date_from, $date_to,$current_date, $fkkn);
        $total_hours = $customer->customer_timetable_time_between_dates($customers, $date_from, $date_to, $fkkn, FALSE, TRUE);
        //echo "<br>".$hrs."<br>";
        $remaining_hours = $customer->time_difference($hrs, $equipment->time_user_format($total_hours,60), 100,'exact');
        //$remaining_hours = $hrs-$total_hours;
    }
    //$smarty->assign('monthly_hrs', round($hrs / $tot_month));
    //$smarty->assign('weekly_hrs', round($hrs / $tot_week));
    //sprintf("%.02f", $total_time)
    $hrs = $equipment->time_user_format($hrs,100);
    $smarty->assign('no_of_days', $tot_day);
    $smarty->assign('monthly_hrs', round(($hrs / $tot_day) * 30,1));
    $smarty->assign('weekly_hrs', round(($hrs / $tot_day) * 7,1));
    $smarty->assign('remaining_hrs', number_format(round($remaining_hours, 2),2,'.',''));
    $smarty->assign('oncall',$oncall);
}
$smarty->assign('hrs', number_format(round($hrs, 2),2,'.',''));
$smarty->display('ajax_customer_contract_hours.tpl');
?>