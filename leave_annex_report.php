<?php
require_once ('configs/config.inc.php');
require_once ('class/setup.php');
require_once ('class/dona.php');
require_once ('class/equipment.php');
require_once ('class/customer.php');
require_once ('class/inconvenient.php');
//require_once ('class/employee.php');
//require_once ('class/newcustomer.php');
//require_once ('class/company.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","month.xml", "forms.xml"),FALSE);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$dona = new dona();
$equipment = new equipment();
$obj_customer = new customer();
//$obj_company = new company();
//$obj_newcustomer = new newcustomer();
//$employee = new employee();


$years_combo = $dona->get_distint_leave_years_from_timetable();
$smarty->assign('years_combo',$years_combo);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assigning sort by
$smarty->assign('flag_cust_access', 1);
//echo "<pre>".print_r($_POST, 1)."</pre>";

if($_POST['action'] == "print" && $_POST['year'] && $_POST['month'] && $_POST['customer']){
	
    $dona->leavePeriod_month = $_POST['month'];
    $dona->leavePeriod_year = $_POST['year'];
    $dona->leave_customer = $_POST['customer'];
//    $dona->leave_employee = $_POST['employee'];
    
    //generate PDF
    $dona->leave_annex_pdf();
    exit();
}

$query_string = explode("&", $_SERVER['QUERY_STRING']);
///////////////////////////////////////start//////////////////////////////////////////////////////
$this_year = NULL;
$this_month = NULL;
$this_customer = NULL;
$this_employee = NULL;
if(!empty($query_string) && trim($query_string[0])!='' && trim($query_string[0]) != 'NULL') { $this_year = trim($query_string[0]); }
else {  $this_year = date('Y'); }

if(!empty($query_string) && trim($query_string[1])!='' && trim($query_string[1]) != 'NULL') { $this_month = trim($query_string[1]); }
else {  $this_month = date('m'); }

if(!empty($query_string) && trim($query_string[2])!='' && trim($query_string[2]) != 'NULL') { $this_customer = trim($query_string[2]); }

if(!empty($query_string) && trim($query_string[3])!='' && trim($query_string[3]) != 'NULL' && $this_customer != NULL) { $this_employee = trim($query_string[3]); }


$customers = $equipment->customers_under_leave_employee($this_month,$this_year);
$smarty->assign('customers',$customers);

if($this_customer != NULL){
    $smarty->assign('cust', $this_customer);
    $smarty->assign('flag_cust_access', ($obj_customer->is_customer_accessible($this_customer) ? 1 : 0));   //prevent manual typing on URL
    
//    $employees = $equipment->employees_leave_under_customer($this_month,$this_year,$this_customer); 
    
}

//$company_details = $obj_company->get_company_detail($_SESSION['company_id']);
    
$smarty->assign('report_year',$this_year);
$smarty->assign('month',$this_month);


$smarty->display('leave_annex_report.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|leave_annex_report.tpl');
?>