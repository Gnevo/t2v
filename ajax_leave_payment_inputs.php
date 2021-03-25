<?php
/**
 * Author: Shamsu
 * used from sick report form.
 * Not used now......
*/
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/equipment.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","month.xml", "forms.xml"), FALSE);
$dona = new dona();
$equipment = new equipment();
$customer_obj = new customer();

$years_combo = $dona->get_distint_leave_years_from_timetable();
$smarty->assign('years_combo',$years_combo);
$smarty->assign('report_year',date('Y'));

if(isset($_POST['employee'])){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $cust = $_POST['customer'];
    $emp = $_POST['employee'];
    $customers = $equipment->customers_under_leave_employee($month,$year);
    $employees = $equipment->employees_leave_under_customer($month,$year,$cust); 
    $list_relations = $equipment->relations_leave_employee($month,$year,$cust,$emp);    //for vikarie table in html
    //print_r($list_relations);
    $updated_relations = $dona->attach_employee_age($list_relations);
    //print_r($update_relations);
    
    $sel_employee_age = $dona->attach_employee_age(array(array('employee_id' => $emp)));
    //print_r($sel_employee_age);
    $smarty->assign('report_year',$year);
    $smarty->assign('month',$month);
    $smarty->assign('cust',$cust);
    $smarty->assign('emp',$emp);
    $smarty->assign('customers',$customers);
    $smarty->assign('employees',$employees);
    $smarty->assign('sel_employees_age',$sel_employee_age[0]);
    $smarty->assign('relations',$updated_relations);
    
    $sicks = $dona->get_pdf_sicks($emp,$cust);
    $company = $dona->get_company_directory($_SESSION['company_id']);
    $smarty->assign('company', $company['upload_dir']);
}else if(isset($_POST['month']) && isset($_POST['customer'])){
    
    if($customer_obj->is_customer_accessible($_POST['customer'])){        //prevent manual typing on URL
        $smarty->assign('flag_cust_access', 1);
    }else{
        $smarty->assign('flag_cust_access', 0);
    }
    
    $smarty->assign('report_year',$_POST['year']);
    $smarty->assign('month',$_POST['month']);
    $smarty->assign('cust',$_POST['customer']);
    $customers = $equipment->customers_under_leave_employee($_POST['month'],$_POST['year']);
    $employees = $equipment->employees_leave_under_customer($_POST['month'],$_POST['year'],$_POST['customer']); 
    $smarty->assign('customers',$customers);
    $smarty->assign('employees',$employees);
}else if(isset($_POST['month'])){
    if($_POST['year'] == ""){
        $year = date('Y');        
    }
    else
       $year = $_POST['year'];
    $customers = $equipment->customers_under_leave_employee($_POST['month'],$year);
    $smarty->assign('report_year',$year);
    $smarty->assign('month',$_POST['month']);
    $smarty->assign('customers',$customers);
}

define('BELOW_25', '31.42');    //15.21
define('BTWN_25_65', '31.42');
define('ABOVE_65', '16.36');    //31.42//15.21

$smarty->assign('below_25', BELOW_25);
$smarty->assign('btwn_25_65', BTWN_25_65);
$smarty->assign('above_65', ABOVE_65);

$smarty->assign('sicks', $sicks);
$smarty->display("ajax_leave_payment_inputs.tpl");
?>