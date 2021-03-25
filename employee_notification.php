<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/customer.php');
require_once('class/equipment.php');
require_once('plugins/message.class.php');
require_once('class/general.php');
$messages = new message();
$employee = new employee();
$user = new user();
//$customer = new customer();
$equipment = new equipment();
$obj_general = new general();
$smarty = new smartySetup(array( "messages.xml", "button.xml","user.xml"));
//$contact_detail = $equipment->get_contact_detail($_GET['emp']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2, 'tabmenu'=>'employee_notification'));
$smarty->assign('employee_username',$_SERVER['QUERY_STRING']);


$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_notification'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$employee_detail = $employee->employee_detail("'" . $_SERVER['QUERY_STRING'] . "'");

if ($employee_detail[0]['mobile'] != "") {
    $length_mobile_display = (strlen($employee_detail[0]['mobile']) - 5) / 2;
    $temp_mobile = '';
    $pos = 5;
    for ($j = 0; $j < $length_mobile_display; $j++) {
        $temp_mobile = $temp_mobile . " " . substr($employee_detail[0]['mobile'], $pos, 2);
        $pos = $pos + 2;
    }
    $employee_detail[0]['mobile'] = "+46" . substr($employee_detail[0]['mobile'], 0, 3) . " " . substr($employee_detail[0]['mobile'], 3, 2) . " " . $temp_mobile;
}

$smarty->assign('employee_detail',$employee_detail);
$smarty->assign('contact',$contact_detail);
$smarty->assign('employee_role', $user->user_role($_SERVER['QUERY_STRING']));
$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

if(isset($_POST['username'])){
    // var_dump($_POST['new']);
    $mobile = "";
    $mail = "";
    if($_POST['mails'] == 1)
        $mail = $mail."1,";
    if($_POST['phone'] == 1)
        $mobile = $mobile."1,";
    if($_POST['sem_mail'] == 2){
        if($_POST['mails'] == 1)
       $mail = $mail."2,";
    }
    if($_POST['sem_mob'] == 2){
        if($_POST['phone'] == 1)
            $mobile = $mobile."2,";
    }
    if($_POST['vab_mail'] == 3){
        if($_POST['mails'] == 1)
            $mail = $mail."3,";
    }
    if($_POST['vab_mob'] == 3){
        if($_POST['phone'] == 1)
            $mobile = $mobile."3,";
    }
    if($_POST['fp_mail'] == 4){
        if($_POST['mails'] == 1)
            $mail = $mail."4,";
    }
    if($_POST['fp_mob'] == 4){
        if($_POST['phone'] == 1)
            $mobile = $mobile."4,";
    }
    if($_POST['pmote_mail'] == 5){
        if($_POST['mails'] == 1)
            $mail = $mail."5,";
    }
    if($_POST['pmote_mob'] == 5){
        if($_POST['phone'] == 1)
            $mobile = $mobile."5,";
    }
    if($_POST['utbild_mail'] == 6){
        if($_POST['mails'] == 1)
            $mail = $mail."6,";
    }
    if($_POST['utbild_mob'] == 6){
        if($_POST['phone'] == 1)
            $mobile = $mobile."6,";
    }
    if($_POST['ovright_mail'] == 7){
        if($_POST['mails'] == 1)
            $mail = $mail."7,";
    }
    if($_POST['ovright_mob'] == 7){
        if($_POST['phone'] == 1)
            $mobile = $mobile."7,";
    }
    if($_POST['byte_mail'] == 8){
        if($_POST['mails'] == 1)
       $mail = $mail."8,";
    }
    if($_POST['byte_mob'] == 8){
        if($_POST['phone'] == 1)
            $mobile = $mobile."8,";
    }
    if($_POST['atl_mail'] == 9){
        if($_POST['mails'] == 1)
       $mail = $mail."9,";
    }
    if($_POST['atl_mob'] == 9){
        if($_POST['phone'] == 1)
            $mobile = $mobile."9,";
    }
    if($_POST['emp_overtime_mail'] == 10){
        if($_POST['mails'] == 1)
       $mail = $mail."10,";
    }
    if($_POST['emp_overtime_mob'] == 10){
        if($_POST['phone'] == 1)
            $mobile = $mobile."10,";
    }
    if($_POST['cust_overtime_mail'] == 11){
        if($_POST['mails'] == 1)
       $mail = $mail."11,";
    }
    if($_POST['cust_overtime_mob'] == 11){
        if($_POST['phone'] == 1)
            $mobile = $mobile."11,";
    }
    if($_POST['leave_permission_mail'] == 12){
        if($_POST['mails'] == 1)
            $mail = $mail."12,";
    }
    if($_POST['leave_permission_mob'] == 12){
        if($_POST['phone'] == 1)
            $mobile = $mobile."12,";
    }
    if($_POST['employee_profile_mail'] == 25){
        if($_POST['mails'] == 1)
            $mail = $mail."25,";
    }
    if($_POST['customer_profile_mail'] == 26){
        if($_POST['mails'] == 1)
            $mail = $mail."26,";
    }
    if($_POST['employee_non_preferred_time_mail'] == 27){
        if($_POST['mails'] == 1)
            $mail = $mail."27,";
    }
    if($_POST['employee_contract_mail'] == 28){
        if($_POST['mails'] == 1)
            $mail = $mail."28,";
    }
    if($_POST['new'] == "new"){
        if($equipment->add_leave_notification($_POST['username'],$mail,$mobile)){
            $message = 'notification_add_success';
            $type = "success";
            $messages->set_message($type, $message);
        }
        else{
            $message = 'notification_add_fail';
            $type = "fail";
            $messages->set_message($type, $message);
        }
    }
    else{
        if($equipment->update_leave_notification($_POST['username'],$mail,$mobile)){
            
            $message = 'notification_update_success';
            $type = "success";
            $messages->set_message($type, $message);
        }
        else{
            $message = 'notification_update_fail';
            $type = "fail";
            $messages->set_message($type, $message);
        }
    }
    $smarty->assign('message', $messages->show_message());
}
$notifications = $equipment->get_notification_employee($_SERVER['QUERY_STRING']);

// var_dump($notifications);
// exit('gd');

$total = 0;
if(is_array($notifications)){
    foreach ($notifications as $key => $value) {
       if($value != ''){
            $total++;
       }
       if($total > 1)
            break;
    }
}
$smarty->assign('total' , $total);
// echo "<pre>". print_r($notifications, 1)."</pre>";
if($notifications == 1){
    $smarty->assign('new','new');
}
else{
    $smarty->assign('notification',$notifications);
}

if($employee->is_employee_accessible($_SERVER['QUERY_STRING'])){
    $smarty->assign('access_flag',1);
}else{
    $smarty->assign('access_flag',0);
}

$smarty->display('extends:layouts/dashboard.tpl|employee_notification.tpl|layouts/sub_layout_employee_tabs.tpl');
?>
