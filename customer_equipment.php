<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/inconvenient_timing.php');
require_once('class/employee.php');
require_once('class/timetable.php');
require_once('class/team.php');
require_once('class/user.php');
require_once('class/general.php');
//require_once ('class/work.php');
//require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml","common.xml","privilege.xml"));
$employee = new employee();
$customer = new customer();
$team = new team();
$messages = new message();
$user = new user();
$obj_general = new general();
//$equipment = new equipment();
//$works = new work();

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_equipment'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

date_default_timezone_set('CET');
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
global $month;
$month_num = $month_name=array();
foreach ($month as $m_id){
    $month_num[]  = $m_id['id'];
    $month_name[] = $smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);

//$sel_year=(isset($_POST["year"])?$_POST["year"]:date('Y'));
$sel_year = (isset($_POST["year"]) ? $_POST["year"] : NULL);
$sel_month = (isset($_POST["month"]) ? $_POST["month"] : NULL);
$smarty->assign('report_year', $sel_year);
$smarty->assign('report_month',$sel_month);

$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'EQUIPMENT'));
$smarty->assign('message', $messages->show_message());

$equipments_names = $customer->get_equipments();
$smarty->assign('serial_numbers',$customer->get_serial_number());
$customers_names = $customer->customer_view();
$smarty->assign('customers',$customers_names);
$smarty->assign('equipments',$equipments_names);

//print_r($equipment_issues);
$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}

$smarty->assign('pass', $pass);
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$customer_username = trim($query_string[0]);

$equipment_issues = $team->list_customer_equipment($customer_username, 1, 1, $sel_month, $sel_year);
$count = $team->list_customer_equipment_count($customer_username, 1, $sel_month, $sel_year);
$page_count = intval($count['counts']/12);

if(($count['counts'] % 12) != 0)
    $page_count++;

$smarty->assign('count',$page_count);
$smarty->assign('page','1');
$smarty->assign('equipments',$equipment_issues);
$smarty->assign('method',1);

/*if(isset($_POST['detail'])){
}else{
    $equipment_issues = $team->list_customer_equipment($customer_username, 1, 1, $sel_month, $sel_year);
    $count = $team->list_customer_equipment_count($customer_username, 1, $sel_month, $sel_year);
    if($count['count'] % 12 == 0){
        $page_count = intval($count['counts']/12);
    }else{
        $page_count = 1 + intval($count['counts']/12);
    }
    $smarty->assign('count',$page_count);
    $smarty->assign('page','1');
    $smarty->assign('equipments',$equipment_issues);
    $smarty->assign('method',1);
}
*/
if (!empty($query_string)) {
    if ($query_string == 'print')
        return false;
    else {
        $customer_detail = $customer->customer_detail($customer_username);
        $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
        $smarty->assign('customer_detail', $customer_detail);
        $smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));
    }
} else {
    // generate cust code
    $cust_code = $customer->generate_customer_code();
    $smarty->assign('cust_code', $cust_code);
}

$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);

$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('access_flag', ($customer->is_customer_accessible($customer_username)) ? 1 : 0);
$smarty->display('extends:layouts/dashboard.tpl|customer_equipment.tpl|layouts/sub_layout_customer_tabs.tpl');

date_default_timezone_set('UTC');
?>