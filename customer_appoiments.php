<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
//require_once ('class/timetable.php');
require_once('class/employee.php');
require_once('class/general.php');
require_once('class/user.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml", 'notes.xml',"privilege.xml"));
$employee = new employee();
$customer = new customer();
$messages = new message();
$obj_general = new general();
$user = new user();

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_appointment'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}


date_default_timezone_set('CET');

global $month;
$month_num=array();
$month_name=array();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
foreach ($month as $m_id)
{
    $month_num[]=$m_id['id'];
    $month_name[]=$smarty->translate[$m_id['month']];
}
//$customer_username = $_SERVER['QUERY_STRING'];

$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);
   
$years_work = $employee->distinct_years_appointment();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'APPOINMENT'));
$smarty->assign('message', $messages->show_message());

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$customer_username = $pram[$totparam-1];
$customer_detail = $customer->customer_detail($customer_username);
$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
$smarty->assign('customer_detail', $customer_detail);
if(isset($_POST))
{ 
    $sel_year=(isset($_POST["year"])?$_POST["year"]:"");
    $sel_month=(isset($_POST["month"])? $_POST["month"] : "");//print_r($_POST);exit;
    if($_POST["delete_id"] != ''){ 
        $delete_id = $_POST["delete_id"];
        $delete = $customer->delete_appoiments($delete_id); 
    }
}
if($sel_year =='' && $sel_month == ''){
    $sel_year = date('Y');
    $sel_month = date('m');  
}
//echo $customer_username."---";
//echo $sel_year;exit();
$smarty->assign('month', $sel_month);
$smarty->assign('year', $sel_year); 
$appoiments_arr = $customer->get_appoiments($customer_username,"",$sel_month,$sel_year);
//echo "<pre>".print_r($appoiments_arr, 1)."</pre>";exit();
if(!empty($appoiments_arr)){
    foreach($appoiments_arr as $key => $appmnt){
        if(trim($appmnt['phone_number']) != '')
            $appoiments_arr[$key]['phone_number'] = formatting_phone($appmnt['phone_number']);
        if(trim($appmnt['phone_number_cp']) != '')
            $appoiments_arr[$key]['phone_number_cp'] = formatting_phone($appmnt['phone_number_cp']);
    }
}
$smarty->assign('appoiments_arr', $appoiments_arr);
$smarty->assign('customer', $customer_username);     

$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);

$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->display('extends:layouts/dashboard.tpl|customer_appoiments.tpl|layouts/sub_layout_customer_tabs.tpl');

function formatting_phone($phone){
    $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags(trim($phone)));
    if($phone != ""){
        if(substr($phone,0,3) == '+46' && strlen($phone )>1)
            $phone = substr($phone,3,9999);
        $length_mobile_display = (strlen($phone)-5)/2;
        $temp_mobile = '';
        $pos = 5;
        for($i=0;$i<$length_mobile_display;$i++){
            $temp_mobile = $temp_mobile." ".substr($phone, $pos,2);
            $pos = $pos +2;
        }
        $phone = "+46".substr($phone, 0,3) . " " . substr($phone, 3,2)." ".$temp_mobile;
    }
    return $phone;
}
date_default_timezone_set('UTC');
?>