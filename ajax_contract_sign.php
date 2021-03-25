<?php

require_once('class/setup.php');
require_once ('class/contract.php');
require_once ('class/employee.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "reports.xml","gdschema.xml"), FALSE);
$contract = new contract();
$employee = new employee();

$emp = $_SESSION['user_id'];
$employee_normal_dates = $employee->get_all_salary_dates($emp,1);
$employee_inconvenient_dates = $employee->get_all_salary_dates_inconv($emp);
$smarty->assign('employee_normal_dates',$employee_normal_dates);
$smarty->assign('employee_inconvenient_dates',$employee_inconvenient_dates);
$contract_sign = $contract->get_contracts_employee($emp);
$smarty->assign("contracts",$contract_sign);
if((isset($_GET['normal_select']) && $_GET['normal_select'] != "") || (isset($_GET['inconv_select']) && $_GET['inconv_select'] != "")){
    
    if($_GET['inconv_select'] == '0')
        $_GET['inconv_select'] = $employee->get_last_id($emp,2);
    if($_GET['normal_select'] == '0')
        $_GET['normal_select'] = $employee->get_last_id($emp,1);
    $smarty->assign('normal_last_id',$_GET['normal_select']);
    $smarty->assign('inconv_last_id',$_GET['inconv_select']);
    $smarty->assign('normal_salaries',$employee->get_normal_sal_acc_id($_GET['normal_select']));
    $smarty->assign('inconveninet_salaries',$employee->get_inconv_sal_acc_id($_GET['inconv_select']));
    $smarty->assign('effects',$employee->get_effects_acc_id($_GET['inconv_select']));
}else{
    $normal_salaries = $employee->get_normal_work_salaries($emp);
    $inconveninet_salaries = $employee->get_inconvenient_amount($emp);
    $effects = $employee->get_inconvenient_amount($emp,1);
    $normal_last_id = $employee->get_last_id($emp,1);
    $inconv_last_id = $employee->get_last_id($emp,2);
    $smarty->assign("inconveninet_salaries",$inconveninet_salaries);
    $smarty->assign("normal_salaries",$normal_salaries);
    $smarty->assign('effects',$effects);
    $smarty->assign('inconv_last_id',$inconv_last_id);
    $smarty->assign('normal_last_id',$normal_last_id);
}
$smarty->display('ajax_contract_sign.tpl');
?>