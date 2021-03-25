<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once ('class/company.php');
require_once('class/dona.php');
require_once('class/customer.php');
require_once ('class/user.php');
//require_once('class/team.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml","gdschema.xml"), FALSE);
$employee = new employee();
$obj_company = new company();
$dona = new dona();
$customer = new customer();
//$team = new team();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);//assign sort by firstname or lastname
$method = intval($_REQUEST['method']);
$ids = $_REQUEST['ids'];
$slots = explode("-", $ids);
$count_slots = count($slots);
$slot_ids = "";
for($i=0;$i < $count_slots;$i++){
    if($slots[$i] != ""){
        if($slot_ids == ""){
            $slot_ids = $slots[$i];
        }else{
           $slot_ids = $slot_ids.",".$slots[$i]; 
        }
    }
}


$page_user = '';
$source_type = '';
//call from gdschema month view
if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['customer']) != ''){
    $page_user = trim($_REQUEST['customer']);
    $source_type = 3;
    $smarty->assign('selected_year', trim($_REQUEST['sel_year']));
    $smarty->assign('selected_month', trim($_REQUEST['sel_month']));
}
else if(isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '') { 
    $page_user = trim($_REQUEST['employee']);
    $source_type = 2;
    $smarty->assign('year_week',$_REQUEST['week_num']);
}else if(isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '') {
    $page_user = trim($_REQUEST['customer']);
    $source_type = 1;
    $smarty->assign('year_week',$_REQUEST['week_num']);
}

$smarty->assign('page_user', $page_user);
$smarty->assign('source_type',$source_type);


//$employee_username = $_REQUEST['employee_username'];
$smarty->assign('method',$method);
$smarty->assign('ids',$ids);


    
switch ($method){
    case 1:
        //change employees
//        $righclick_employees = $employee->employees_list_for_right_click($page_user);
//        $smarty->assign('righclick_employees', $righclick_employees);
        
//        $employees_changable = $customer->get_employees_after_checking_overlap($customer_username,$ids);
//        echo $return_value = $customer->check_overlap_slots($ids,$employee_username);
        //-------------------------------------------------------------------------------
        //get accessible employees dippending their role
        $employee->flush();
        $accessible_employees = array();
        if($source_type == 1)
            $tl_role_on_customer = $employee->get_employee_role_on_customer($page_user, $_SESSION['user_id']);
        if($_SESSION['user_role'] == 3 || $tl_role_on_customer == 3){
            $accessible_employees = $employee->get_employee_ALLdetail($_SESSION['user_id']); 
        }else{
            $accessible_employees = $employee->employees_list_for_right_click($page_user);
        }
        //get selected slot details
        $employee->flush();
        $slots_detail = $dona->customer_employee_multi_slot_details($slot_ids);
        $slots_count = count($slots_detail);
        $slot_customers = array();
        $slot_employees = array();
        $employees_to_add = array();
        // filter unique customers from selected slots
        for($i = 0 ; $i< $slots_count ; $i++){
            if($slots_detail[$i]['customer'] != '' && $slots_detail[$i]['customer'] != NULL){
                if(!in_array($slots_detail[$i]['customer'], $slot_customers))
                    $slot_customers[] = $slots_detail[$i]['customer'];
                    if (!empty($employees_to_add)){
                        $available_users = $employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']);
                        //$employees_to_add = array_intersect($available_users, $employees_to_add);
                        $employees_to_add = $employee->employee_intersect($available_users, $employees_to_add);
                    }else{
                        $employees_to_add = $employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']);
                    }
//                    $available_users = $employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']);
            }else{
               $employees_to_add = $employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']); 
            }
            if($slots_detail[$i]['employee'] != '' && $slots_detail[$i]['employee'] != NULL){
                if(!in_array($slots_detail[$i]['employee'], $slot_employees))
                    $slot_employees[] = $slots_detail[$i]['employee'];
            }
        }
        /*
        //get mutual employees of customers(team) 
        $mutual_employees = array();
        if(!empty($slot_customers)){
            $mutual_employees = $employee->get_mutual_employees_of_customers($slot_customers);
        } else {
            $mutual_employees = $accessible_employees;
        }
        
        //-------------------------------------------------------------------------------
        
        $common_employees = array_uintersect($accessible_employees, $mutual_employees, function($value1, $value2) {
                                    return strcmp($value1['username'], $value2['username']);
                                 });*/
        
        $smarty->assign('list_employees', $employees_to_add);
        break;
    case 2:
        //change customers
//        $righclick_customers = $employee->customers_list_for_right_click($page_user);
//        $smarty->assign('righclick_customers', $righclick_customers);
        
//        $customers_change = $dona->get_mutual_customers_of_multiple_employees($slots_detail);
//        if($customers_change == 1){
//            $customers_change = $customer->customer_list();
//        }
//        $smarty->assign('righclick_customers',$customers_change);
        //-------------------------------------------------------------------------------
        //get accessible customers dippending their role
        $employee->flush();
        $accessible_employees = $customer->customer_list();
        
        //get selected slot details
        $employee->flush();
        $slots_detail = $dona->customer_employee_multi_slot_details($slot_ids);
        $slots_count = count($slots_detail);
        $slot_employees = array();
        // filter unique employees from selected slots
        for($i = 0 ; $i< $slots_count ; $i++){
            if($slots_detail[$i]['employee'] != '' && $slots_detail[$i]['employee'] != NULL){
                if(!in_array($slots_detail[$i]['employee'], $slot_employees))
                    $slot_employees[] = $slots_detail[$i]['employee'];
            }
        }
        
        //get mutual customers of employees(team) 
        $mutual_customers = array();
        if(!empty($slot_employees)){
            $mutual_customers = $employee->get_mutual_customers_of_employees($slot_employees);
        } else {
            $mutual_customers = $accessible_employees;
        }
        
        //-------------------------------------------------------------------------------
        
        $common_customers = array_uintersect($accessible_employees, $mutual_customers, function($value1, $value2) {
                                    return strcmp($value1['username'], $value2['username']);
                                 });
                                 
        $smarty->assign('list_customers', $common_customers);
        
    case 3:
        break;
}

$smarty->assign('privilages_main', $employee->get_privileges($_SESSION['user_id'], 1));
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$smarty->display("ajax_right_click_customers_employees_change.tpl");
?>