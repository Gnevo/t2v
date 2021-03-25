<?php
require_once('class/setup.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml", "customer.xml","billing.xml"), FALSE);
require_once('class/company.php');
$company_obj = new company();
require_once('class/user.php');
$user = new user();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('privileges_mc' , $user->get_privileges($_SESSION['user_id'], 3));

require_once('configs/config.inc.php');
global $month, $company;
/* this block for finding year values  */
$years_combo= $company_obj->distinct_billing_years();
$smarty->assign("year_option_values", $years_combo);
/* end-- block for finding year values  */

if(isset($_POST["action"]) && $_POST["action"] != "" && isset($_POST["current_bill"]) && $_POST["current_bill"] != ""){
    $company_obj->create_bill_pdf($_POST["current_bill"],$_SESSION['company_id']);
    exit();
}

/* this block for set current value of combo box  */
$sel_year=(isset($_POST["cmb_year"]) && $_POST["cmb_year"] != "" ? $_POST["cmb_year"] :  ((in_array(date('Y'),$years_combo)) ? date('Y') : ''));
$sel_bill=(isset($_POST["cmb_bills"]) && $_POST["cmb_bills"] != "" ? $_POST["cmb_bills"] : "");
$smarty->assign('selected_bill', $sel_bill);
$smarty->assign('bill_year', $sel_year);

if($sel_year != ""){
    $bills= $company_obj->get_bills_by_year($sel_year);
    $bill_vals=array();
    $bill_disp=array();

    foreach ($bills as $bill)
    {
        $bill_vals[]=$bill['id'];
        $bill_disp[]=$smarty->translate[$month[$bill['bill_month']-1]['month']];
    }
    $smarty->assign("bill_values", $bill_vals);
    $smarty->assign("bill_output", $bill_disp);
}

if($sel_bill != ""){
    $smarty->assign("is_generate", TRUE);
    $bill_info= $company_obj->get_bills_by_id($sel_bill);
//    echo "<pre>".print_r($bill_info, 1)."</pre>";
    $smarty->assign("no_of_customer", $bill_info[0]['no_active_customers']);
    $smarty->assign("price_per_customer", $bill_info[0]['price_per_customer']);
    $smarty->assign("no_of_sms", $bill_info[0]['no_sms']);
    $smarty->assign("price_per_sms", $bill_info[0]['price_per_sms']);
    $smarty->assign("no_of_sign", $bill_info[0]['no_sign']);
    $smarty->assign("price_per_sign", $bill_info[0]['price_per_sign']);
    $smarty->assign("file_number", $bill_info[0]['file_number']);
    $smarty->assign("tbl_id", $bill_info[0]['id']);
    $smarty->assign("bill_date", $bill_info[0]['bill_date']);
    $smarty->assign("pay_date", date("Y-m-d", strtotime($bill_info[0]['bill_date'] . " +15 days")));
    $bill_date = $bill_info[0]['bill_date'];
    $bill_month = $bill_info[0]['bill_month'];
    
    $company_details = $company_obj->get_company_detail($_SESSION['company_id']);
    $smarty->assign("company_details", $company_details);
    $smarty->assign("our_reference", $company['contact_person1']);
    
    $format_bill_date = $smarty->translate[$month[$bill_month-1]['month']] . ' ' . date('Y', strtotime($bill_date));
    $smarty->assign("formated_bill_date", $format_bill_date);
    
    $total_amt = $bill_info[0]['no_active_customers']*$bill_info[0]['price_per_customer'] + $bill_info[0]['no_sms']*$bill_info[0]['price_per_sms'] + $bill_info[0]['no_sign']*$bill_info[0]['price_per_sign'];
    $smarty->assign("total_amt", $total_amt);
    $smarty->assign("quater_percentage", $total_amt / 4);
    $smarty->assign("grand_total", $total_amt + ($total_amt / 4));
}  else {
    $smarty->assign("is_generate", FALSE);
}

//$smarty->display('extends:layouts/dashboard.tpl|billing.tpl');
$smarty->display('billing.tpl');
?>