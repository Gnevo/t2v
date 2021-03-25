<?php
//error_reporting(E_ERROR);
//error_reporting(E_WARNING);
//ini_set('error_reporting', E_ERROR);
//ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/customer_forms.php');
require_once('class/user.php');
require_once('plugins/form_pdf.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml", "forms.xml", "messages.xml", "button.xml", "survey.xml", "survey_button.xml"));
$messages = new message();
$customer = new customer();
$employee = new employee();
$customer_forms = new customer_forms();
$company = new company();
$user = new user();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('login_user', $_SESSION['user_id']);
$customer_id = ($_REQUEST['customer'] ? $_REQUEST['customer'] : '');
$smarty->assign('customerid', $customer_id);

$customers_datas = $customer->customer_list();
$customers = array();
foreach($customers_datas as $customer_data) {
    $customers[$customer_data['username']] = $customer_data;
}
//print_r($customers);
$smarty->assign('customers', $customers);
$form_data_report = array();
$form_data_descriptions = array();

$form_data_report = $customer_forms->get_form_2_report($customer_id);
$form_data_descriptions = $customer_forms->get_form_2_description_report($customer_id);

$smarty->assign('forms_datas', $form_data_report);
$smarty->assign('forms_descriptions', $form_data_descriptions);
//echo '<pre>' . print_r($form_data_report,1) .'</pre>';exit();

$smarty->assign('message', $messages->show_message());
if(isset($_REQUEST['customer'])) {
	$smarty->display('forms/form_2_report.tpl');
} else {
	$smarty->display('extends:layouts/dashboard.tpl|forms/form_2_report.tpl');
}
