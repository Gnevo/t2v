<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
require_once('class/employee.php');
$employee = new employee();

$test = explode('&', $_SERVER['QUERY_STRING']);
$emplist=$customer->customer_report($test[1], $test[3], $test[2]);
$report_header=$smarty->translate['customer_monthly_report'];
$report_sub_header=$smarty->translate['customer'];
$total_cap=$smarty->translate['total'];
$c_heading_list=array($smarty->translate['date'],$smarty->translate['work'],$smarty->translate['employee'],$smarty->translate['normal'],$smarty->translate['travel'],$smarty->translate['break'],$smarty->translate['total_hour']);
$customer->Customer_pdf_report($emplist,$test[4],$test[5],$test[3],$report_header,$report_sub_header,$c_heading_list,$total_cap);
/* 
$sel_year=(isset($_POST["cmb_year"])?$_POST["cmb_year"]:date('Y'));
$sel_month=(isset($_POST["cmb_month"])? $_POST["cmb_month"] : date('m'));
$smarty->assign('report_month', $sel_month);
$smarty->assign('report_year', $sel_year);
*/
$smarty->display('extends:layouts/dashboard.tpl|message_center_leave.tpl');
 
?>