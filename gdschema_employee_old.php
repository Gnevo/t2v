<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
//require_once ('class/dona.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml"));
$employee = new employee();
$customer = new customer();
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));

if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $year_week = $query_string[0];
    
    if (!empty($query_string[1])) {
        $employee_username = $query_string[1];
    }
    $week_position = 8;
    if (!empty($query_string[2])) {
        $week_position = $query_string[2];
    }
} else {

    $year_week = date('Y') . '|' . date('W');
    $week_position = 8;
}

$smarty->assign('year_week', $year_week);
$smarty->assign('week_position', $week_position);
$smarty->assign('employee', $employee_username);
//get week datas
$date = new datecalc();
$week_numbers = $date->get_weeks($year_week, 15, $week_position);
$smarty->assign('week_numbers', $week_numbers);

//gdschema week data
//$dona = new dona();

$employee_data = $employee->employee_data($employee_username);
$smarty->assign('employee_data', $employee_data);

$customers = $employee->employee_week_customer($employee_username, $year_week);
$smarty->assign('customers', $customers);
$smarty->assign('week', $employee->get_week());
$smarty->assign('privileges', $employee->employee_privilege());
$smarty->assign('employee_datas', $employee->employee_timetable_week($employee_username, $year_week));
$smarty->assign('customers_to_allocate', $customer->customer_to_allocate($year_week));
$smarty->assign('employees_to_allocate', $employee->employee_to_allocate($year_week));
$smarty->assign('leave_employees', $employee->leave_employee_week($year_week));


//setting layout and page
$smarty->display('extends:layouts/dashboard.tpl|gdschema_employee_old.tpl');
?>