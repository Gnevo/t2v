<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml"), FALSE);
$employee = new employee();
$customer = new customer();

$year_week = $_POST['year_week'];
$page_key = $_POST['page_key'];
$page_start = $_POST['page_start'];
$page_limit = 5;
//$the_employee = $_POST['employee'];
//$the_customer = $_POST['customer'];

if($_SESSION['user_role'] == 1){
    if($page_key){
        $total_pages = ceil(count($employee->employee_list($page_key))/10);
        $employees = $employee->employee_list_limit($page_start-1, $page_limit,$page_key);
    }    
    else{
        $total_pages = ceil(count($employee->employee_list())/10);
        $employees = $employee->employee_list_limit($page_start-1, $page_limit);
    }    
    
    $smarty->assign('employees', $employees);
    $formatted_employees = '';
    if(!empty ($employees)){
        $formatted_employees = "'";
        foreach ($employees as $emps){
            if($emps['username'])
                $formatted_employees .= $emps['username']."','";
        }
        $formatted_employees .= "'";
        $customers = $customer->customer_list_limit($formatted_employees);
        $smarty->assign('customers', $customers);
    }    
}else{
    $employees = $employee->employee_list();
    $smarty->assign('employees', $employees);

    $customers = $customer->customer_list();
    $smarty->assign('customers', $customers);
}

$smarty->assign('week_datas', $employee->timetable_week($customers, $employees, $year_week));
$smarty->assign('privileges', $employee->employee_privilege());

$smarty->assign('year_week', $year_week);
$smarty->display("ajax_week_work_slot_section.tpl");
?>