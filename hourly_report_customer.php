<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/newcustomer.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new newcustomer();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

//Get current year first date and today date and pass it to tempalte file
$CurrentYear = date('Y');
$FirstDateOfCurrentYear = $CurrentYear.'-01-01';
$TodatDate = date('Y-m-d');
$smarty->assign('TodatDate',$TodatDate);
$smarty->assign('FirstDateOfCurrentYear',$FirstDateOfCurrentYear);

$CustomerList = $customer->customer_list(NULL);
$smarty->assign('customerlist',$CustomerList);

$smarty->display('extends:layouts/dashboard.tpl|hourly_report_customer.tpl');
?>