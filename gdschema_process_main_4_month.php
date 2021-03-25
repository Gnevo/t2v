<?php
require_once ('class/setup.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/company.php');
require_once ('plugins/message.class.php');
require_once ('configs/config.inc.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$obj_company = new company();
$obj_cust = new customer();
$obj_emp = new employee();
$obj_msg = new message();

$selected_customer = trim($_REQUEST['customer']);
$selected_month = trim($_REQUEST['month']);
$selected_year = trim($_REQUEST['year']);
$selected_slot_id = trim($_REQUEST['slot_id']);


$slot_detail = $obj_emp->customer_employee_slot_details($selected_slot_id);
$smarty->assign('slot_detail', $slot_detail);
//echo "<pre>".print_r($slot_detail, 1)."</pre>";

$smarty->assign('customer_details', $obj_cust->customer_detail($selected_customer));
$smarty->assign('privilages', $obj_emp->get_privileges($_SESSION['user_id'], 1));

/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */


$smarty->assign('message', $obj_msg->show_message()); //messages of actions
$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_process_main_4_month.tpl');
?>