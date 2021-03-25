<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
require_once('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/customer.php');
$employee = new employee();

$equipment = new equipment();
$cur_month = date('m');
$cur_year = date('Y');
//$customers = $equipment->customers_under_leave_employee($cur_month,$cur_year);
if(isset($_POST['employee'])){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $cust = $_POST['customer'];
    $emp = $_POST['employee'];
    $customers = $equipment->customers_under_leave_employee($month,$year);
    $employees = $equipment->employees_leave_under_customer($month,$year,$cust); 
    $list_relations = $equipment->relations_leave_employee($month,$year,$cust,$emp);
    $smarty->assign('year',$year);
    $smarty->assign('month',$month);
    $smarty->assign('cust',$cust);
    $smarty->assign('customers',$customers);
    $smarty->assign('employees',$employees);
    $smarty->assign('relations',$list_relations);
}
//
if(isset($_GET['month']) && isset($_GET['cust'])){
    $smarty->assign('year',$_GET['year']);
    $smarty->assign('month',$_GET['month']);
    $smarty->assign('cust',$_GET['cust']);
    $customers = $equipment->customers_under_leave_employee($_GET['month'],$_GET['year']);
    $employees = $equipment->employees_leave_under_customer($_GET['month'],$_GET['year'],$_GET['cust']); 
    $smarty->assign('customers',$customers);
    $smarty->assign('employees',$employees);
}
else if(isset($_GET['month'])){
    echo "hello";
    if($_GET['year' == ""]){
        $year = date('Y');        
    }
    else
        $year = $_GET['year'];
    $customers = $equipment->customers_under_leave_employee($_GET['month'],$year);
    echo "customers";
    print_r($customers);
    echo "hello";
    $smarty->assign('year',$year);
    $smarty->assign('month',$_GET['month']);
    $smarty->assign('customers',$customers);
}
$smarty->display('extends:layouts/dashboard.tpl|leave_payment_pdf.tpl');

?>
