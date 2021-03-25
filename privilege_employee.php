<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/customer.php');
require_once('plugins/pagination.class.php');
require_once('class/employee.php');
require_once('class/team.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$employee = new employee();
$user = new user();
$customer = new customer();
$pagination = new pagination();
$employee = new employee();
$team = new team();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname
if(isset($_POST['selected_emp']) && $_POST['selected_emp'] != ""){
    if(isset($_POST['select_all']) && $_POST['select_all'] == '1'){
        $emp_role = $_POST['pre_role'];
        $smarty->assign('emp_roles',$emp_role);
    }else{
        $selecteds = $_POST['selected_emp'];
        $emp_role = $_POST['pre_role'];
        $smarty->assign('selected_emp',$selecteds);
        $smarty->assign('emp_roles',$emp_role);
    }
}
$customers_name = $customer->customer_list();
if(isset($_POST['pre_role'])){
    $employee_autocomplete = $team->get_employee_autocomplete($_POST['pre_cust'],$_POST['pre_role'],1);
    $smarty->assign('employees_autocomplete',$employee_autocomplete);
    $employees_name = $team->get_customer_team_employees($_POST['pre_cust'],$_POST['pre_role'],$_POST['pre_search'],1,1);
    $employee_count = $team->get_customer_team_employees_count($_POST['pre_cust'],$_POST['pre_role'],$_POST['pre_search'],1);
}else{
    $employee_autocomplete = $team->get_employee_autocomplete('','3',1);
    $smarty->assign('employees_autocomplete',$employee_autocomplete);
    $employees_name = $team->get_customer_team_employees('',3,'',1,1);
    $employee_count = $team->get_customer_team_employees_count('',3,'',1); 
}

$smarty->assign('employees',$employees_name);
if($employee_count % 10 == 0){
    $page_count = intval($employee_count/10);
}else{
    $page_count = 1 + intval($employee_count/10);
}
$smarty->assign('page_count',$page_count);
$smarty->assign('count',count($employees_name));
//if(isset($_POST['sub'])){
//    $employees_name = $team->get_customer_team_employees($_POST['pre_cust'],$_POST['pre_role'],$_POST['pre_search']);
//    
//    $smarty->assign('employees',$employees_name);
//}
$smarty->assign('customers',$customers_name);

$smarty->display('extends:layouts/dashboard.tpl|privilege_employee.tpl');
?>