<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
require_once('class/general.php');
$messages = new message();
$smarty = new smartySetup(array( "messages.xml", "button.xml","gdschema.xml","user.xml", 'reports.xml'));
$employee = new employee();
$user = new user();
$obj_general = new general();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2, 'tabmenu'=>'employee_list_salary'));
$query_string = explode('&',$_SERVER['QUERY_STRING']);

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_salary'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if(!empty($query_string[0])){
    $employee_detail[0] = $employee->get_employee_detail($query_string[0]);
    $smarty->assign('employee_detail', $employee_detail);
    $smarty->assign('employee_username',$query_string[0]);
    
    $employee_role = $user->user_role($query_string[0]);
    $smarty->assign('employee_role', $user->user_role($query_string[0]));
}
if(!empty($query_string[1])){ 
  if($query_string[1] == "delete" && $query_string[3] == 'n'){
      $employee->delete_normal_salary($query_string[2]);
      header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
  }
  if($query_string[1] == "delete" && $query_string[3] == 'i'){
      $employee->delete_inconvenient_salary($query_string[0],$query_string[2]);
      header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
//      echo "Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/";
  } 
  if($query_string[1] == "delete" && $query_string[3] == 'm'){
      $employee->delete_monthly_salary($query_string[2]);
      header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
  }
}
if(isset($_POST['monthly_salary_add'])){
    $employee->salary_per_month = $_POST['monthly_salary'];
    $employee->salary_per_hour = 0;
    $employee->employee_salary($query_string[0]);
    if($_POST['is_monthly_salary'] == 1){
        $employee->update_employee_monthly_salary($query_string[0],1);
    }else{
       $employee->update_employee_monthly_salary($query_string[0],0); 
    }
}
$normal_salaries = $employee->get_normal_work_salaries($query_string[0]);
$inconveninet_salaries = $employee->get_inconvenient_amount($query_string[0]);
//echo "<pre>".print_r($inconveninet_salaries, 1)."</pre>"; exit();
$effects = $employee->get_inconvenient_amount($query_string[0],1);
$employee_normal_dates = $employee->get_all_salary_dates($query_string[0],1);
$employee_inconvenient_dates = $employee->get_all_salary_dates_inconv($query_string[0]);
$normal_last_id = $employee->get_last_id($query_string[0],1);
$inconv_last_id = $employee->get_last_id($query_string[0],2);
$monthly_last_id = $employee->get_last_id_monthly($query_string[0]);

$monthly_salaries = $employee->get_monthly_sal_acc_id($monthly_last_id);
$employee_monthly_dates = $employee->get_all_monthly_salary_dates($query_string[0]);
$smarty->assign('employee_monthly_dates',$employee_monthly_dates);
//echo $normal_last_id." -- ".$inconv_last_id;
$smarty->assign('normal_last_id',$normal_last_id);
$smarty->assign('inconv_last_id',$inconv_last_id);
$smarty->assign('monthly_last_id',$monthly_last_id);
$smarty->assign('employee_normal_dates',$employee_normal_dates);
$smarty->assign('employee_inconvenient_dates',$employee_inconvenient_dates);
$smarty->assign('normal_salaries',$normal_salaries);
$smarty->assign('monthly_salaries',$monthly_salaries);
$smarty->assign('inconvenient_salaries',$inconveninet_salaries);
$smarty->assign('effects',$effects);
$sals = $employee->get_employee_salary($query_string[0]);
$monthly_sals = $employee->get_employee_salary_monthly($query_string[0]);
$smarty->assign('monthly_sals',$monthly_sals[0]['monthly_salary']);
$smarty->assign('salaries_per_month',$sals[0]['salary_per_month']);

if(isset($_POST['normal_select']) || isset($_POST['inconv_select']) || isset($_POST['monthly_select'])){
    if($_POST['inconv_select'] == '0')
        $_POST['inconv_select'] = $employee->get_last_id($query_string[0],2);
    if($_POST['normal_select'] == '0')
        $_POST['normal_select'] = $employee->get_last_id($query_string[0],1);
    if($_POST['monthly_select'] == '0')
        $_POST['monthly_select'] = $employee->get_last_id_monthly($query_string[0]);
    $smarty->assign('normal_last_id',$_POST['normal_select']);
    $smarty->assign('inconv_last_id',$_POST['inconv_select']);
    $smarty->assign('monthly_last_id',$_POST['monthly_select']);
    $smarty->assign('monthly_salaries',$employee->get_monthly_sal_acc_id($_POST['monthly_select']));
    $smarty->assign('normal_salaries',$employee->get_normal_sal_acc_id($_POST['normal_select']));
    $smarty->assign('inconvenient_salaries',$employee->get_inconv_sal_acc_id($_POST['inconv_select']));
    $smarty->assign('effects',$employee->get_effects_acc_id($_POST['inconv_select']));
    
//    $test = $employee->get_inconv_sal_acc_id($_POST['inconv_select']);
//    echo $_POST['inconv_select'];
//    echo "<pre>".print_r($test, 1)."</pre>"; exit();
}

$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|employee_salary_list.tpl|layouts/sub_layout_employee_tabs.tpl');
?>