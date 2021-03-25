<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml"), FALSE);
$employee = new employee();
$customer = new customer();

$year_week = $_POST['year_week'];
$the_employee = $_POST['employee'];
$the_customer = $_POST['customer'];

//echo "<pre>".print_r(array($year_week,$the_employee,$the_customer), 1)."</pre>";
$out = '';
if(isset($_POST['employee'])){
//    echo 'employee';
    $contract_hour = $employee->employee_contract_week_hour($the_employee, $year_week);
    $assigned_hour = $employee->employee_timetable_week_time($the_employee, $year_week);
    $out = $assigned_hour;
    if ($contract_hour)
        $out .= ' ('. $contract_hour. ')' ;
}else if(isset($_POST['customer'])){
//    echo 'customer';
    $contract_hour_fk = $customer->customer_contract_week_hour($the_customer, $year_week, 1);
    $assigned_hour_fk = $customer->customer_timetable_week_time($the_customer, $year_week, 1);
    $contract_hour_kn = $customer->customer_contract_week_hour($the_customer, $year_week, 2);
    $assigned_hour_kn = $customer->customer_timetable_week_time($the_customer, $year_week, 2);
    $out = 'FK: '. $assigned_hour_fk;
    if ($contract_hour_fk)
        $out .= '('. $contract_hour_fk. ')' ;
    $out .= ' KN: '. $assigned_hour_kn; 
    if ($contract_hour_kn)
        $out .= '('. $contract_hour_kn. ')' ;
}

echo $out;


//$smarty->display("ajax_worker_wrapper_section.tpl");
?>