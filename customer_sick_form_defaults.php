<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/customer_ai.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml","common.xml","privilege.xml"));
$employee = new employee();
$customer = new customer();
$messages = new message();
$customer_ai = new customer_ai();
$user = new user();
$obj_general = new general();

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_sick_form_defaults'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

date_default_timezone_set('CET');
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'SICK-DEFAULT'));

//$sel_employee = (isset($_POST["cmb_employee"]) ? $_POST["cmb_employee"] : NULL);

$query_string = explode('&', $_SERVER['QUERY_STRING']);
$customer_username = trim($query_string[0]);

if(isset($_POST) && $_POST['selected_action'] == 'SAVE' && $customer_username != ''){
    // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    
    $transaction_flag = TRUE;

    $uppdrag = trim($_POST['txtUppdrag']);    //Uppgifter om anställning section

    //save form defaults
    $check_box_values = $fullmakt = array();
    $check_box_values['value1'] = (isset($_POST['chkBifogas1']) && trim($_POST['chkBifogas1']) == 1 ? 1 : 0);
    $check_box_values['value2'] = (isset($_POST['chkBifogas2']) && trim($_POST['chkBifogas2']) == 1 ? 1 : 0);
    $check_box_values['value3'] = (isset($_POST['chkBifogas3']) && trim($_POST['chkBifogas3']) == 1 ? 1 : 0);
    $check_box_values['value4'] = (isset($_POST['chkBifogas4']) && trim($_POST['chkBifogas4']) == 1 ? 1 : 0);
    
    $fullmakt['value1'] = (isset($_POST['chkFullmaktBifogas']) && trim($_POST['chkFullmaktBifogas']) == 1 ? 1 : 0);
    $fullmakt['value2'] = (isset($_POST['chkFullmaktTidigareInsant']) && trim($_POST['chkFullmaktTidigareInsant']) == 1 ? 1 : 0);
    
    $transaction_flag = $customer->save_sick_form_defaults($customer_username, $uppdrag, $fullmakt, NULL, $check_box_values, FALSE);
    
    if($transaction_flag)
        $messages->set_message('success', 'data_saved');
    else
        $messages->set_message('fail', 'error_saving');
}


//get sick form defaults
$sick_form_defaults = $customer->get_sick_form_defaults($customer_username);
if(!empty($sick_form_defaults)){
    $sick_form_defaults = $sick_form_defaults[0];
    $check_box_values = explode('||', $sick_form_defaults['check_values']);
    $fullmakt_values = explode('||', $sick_form_defaults['fullmakt']);
    $sick_form_defaults['checkbox_values'] = array('chkBifogas1' => $check_box_values[0], 'chkBifogas2' => $check_box_values[1], 'chkBifogas3' => $check_box_values[2], 'chkBifogas4' => $check_box_values[3]);
    $sick_form_defaults['fullmakt_values'] = array('fullmakt1' => $fullmakt_values[0], 'fullmakt2' => $fullmakt_values[1]);
    
    $smarty->assign('sick_form_defaults',$sick_form_defaults);
}

// echo "<pre>".print_r($sick_form_defaults, 1)."</pre>"; exit();

if (!empty($query_string)) {
    $customer_detail = $customer->customer_detail($customer_username);
    $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
    $smarty->assign('customer_detail', $customer_detail);
    //echo "<pre>".print_r($customer_detail, 1)."</pre>"; exit();
}

$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('message', $messages->show_message());
$smarty->assign('access_flag', ($customer->is_customer_accessible($customer_username)) ? 1 : 0);
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->display('extends:layouts/dashboard.tpl|customer_sick_form_defaults.tpl|layouts/sub_layout_customer_tabs.tpl');
date_default_timezone_set('UTC');
?>