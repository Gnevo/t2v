<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
require_once('class/user.php');
$user = new user();
$obj_emp = new employee();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","tooltip.xml"), FALSE);
$equipment = new equipment();
$list_type = $_GET['listtype'];
if(isset($_GET['customers']))
    $customers = explode(',',$_GET['customers']);
$employee = $_GET['username'];
if($list_type == 'allocate') {
    $equipment->begin_transaction();
    if($equipment->add_team_employee($customers,$employee)){
            $equipment->commit_transaction ();
    }
    else{
        $equipment->rollback_transaction();
    }
} 
else if($list_type == 'del'){
    $equipment->begin_transaction();
    if($equipment->delete_team_employee($customers,$employee)){
        $equipment->commit_transaction ();
    }
    else{
        $equipment->rollback_transaction();
    }
    
}
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$assigned_customers = $equipment->assigned_customers_to_employee($employee);
if(isset($_GET['searchkey'])){
    $smarty->assign('key',$_GET['searchkey']);
    $to_assign = $equipment->customers_to_assign($assigned_customers,$_GET['searchkey']);
}else{
    $to_assign = $equipment->customers_to_assign($assigned_customers);
}
$assign = '';
$not_assign = '';
for($i=0;$i<count($to_assign);$i++){
    $not_assign = $not_assign.$to_assign[$i]['username'].",";
}
for($i=0;$i<count($assigned_customers);$i++){
    $assign = $assign.$assigned_customers[$i]['username'].",";
    $assign_emp = $assign_emp.$assigned_customers[$i]['employee'].",";
}
$smarty->assign('assigned',$assigned_customers);
$employee_detail = $obj_emp->employee_detail_main($employee);
$smarty->assign('employee_detail', $employee_detail);
$smarty->assign('to_assign',$to_assign);
$smarty->assign('user_roles',$user->user_role($employee));
$smarty->assign('user_role_login',$user->user_role($_SESSION['user_id']));
$smarty->assign('not_assign',$not_assign);
$smarty->assign('assign',$assign);
$smarty->assign('assign_emp',$assign_emp);
$smarty->display('ajax_customer_list.tpl');
?>