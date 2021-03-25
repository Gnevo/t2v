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
$week_date = $_POST['week_date'];
$page_limit = 5;


//$week_data = explode('|', $year_week);
//$year = $week_data[0];
//$week_no = sprintf("%02d", $week_data[1]);
//$week_date = date('Y-m-d', strtotime($year . 'W' . $week_no . '1'));
//
//if($week_date <= date('Y-m-d') && (date('Y-m-d', strtotime($year . 'W' . $week_no . '7'))) >= date('Y-m-d')){
//    $week_date = date('Y-m-d');
//}
//if (!empty($query_string[4])) {
//    $week_date = $query_string[4];
//}

//$the_employee = $_POST['employee'];
//$the_customer = $_POST['customer'];


if($_SESSION['user_role'] == 1){
    if($page_key){
        $total_pages = ceil(count($employee->employee_list($page_key))/10);
        if($page_key == 1)
            $employees = $employee->employee_list_limit($page_start-1, $page_limit,null);
        else
            $employees = $employee->employee_list_limit($page_start-1, $page_limit,$page_key);
    }    
    else{
        
        $total_pages = ceil(count($employee->employee_list())/10);
        $employees = $employee->employee_list_limit($page_start-1, $page_limit);
    }
    
    $employees_detail = array();
    $i =0;
    foreach ($employees as $emp_data){
        $employees[$i]['signed_in'] = $employee->chk_employee_rpt_signed($emp_data['username'], $week_date);
        $i++;
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

//$smarty->assign('week_datas', $employee->timetable_week($customers, $employees, $year_week));
$smarty->assign('day_datas', $employee->timetable_day($customers, $employees, $week_date));
$smarty->assign('privileges', $employee->employee_privilege());
$smarty->assign('privileges_gd', $employee->get_privileges($_SESSION['user_id'], 1));//setting previlege

$smarty->assign('year_week', $year_week);
$smarty->display("ajax_day_work_slot_section.tpl");
?>