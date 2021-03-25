<?php
 // error_reporting(E_ALL);
 //                         error_reporting(E_WARNING);
 //                  ini_set('error_reporting', E_ALL);
 //                  ini_set("display_errors", 1);
//die(var_dump('ya na mail'));
require_once('class/setup.php');
require_once('class/mail.php');
require_once('plugins/pagination.class.php');
require_once('configs/config.inc.php');
require_once('class/customer.php');
require_once('class/equipment.php');
require_once('class/employee.php');
require_once('class/report_signing.php');
require_once('class/customer.php');
require_once('class/user.php');
//require_once('class/user.php');
$smarty = new smartySetup(array("messages.xml", "month.xml", "button.xml", "mail.xml", 'notes.xml'));
//$user = new user();
$mail            = new mail();
$pagination      = new pagination();
$customer        = new customer();
$equipment       = new equipment();
$obj_emp         = new employee();
$obj_rpt_signing = new report_signing();
$obj_user        = new user();
$customer        = new customer();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('privileges_mc' , $obj_user->get_privileges($_SESSION['user_id'], 3));
$current_year = date('Y');
$prev_month   = date("m", strtotime("first day of previous month"));
$smarty->assign('current_year',$current_year);
$smarty->assign('prev_month',$prev_month);
$search_customers = $customer->customers_list_for_employee_report();
$search_employees = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);

$search_cust_ids = $search_emp_ids = array();
if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}

if($current_year && $prev_month){
    $current_unsigned_employees = get_unsigned_employee($current_year, $prev_month,$search_cust_ids,$search_emp_ids);
    $smarty->assign('current_unsigned_employees',$current_unsigned_employees);
}


/* this block for finding month values  */
global $month;
$month_num = array();
$month_name = array();
foreach ($month as $m_id) {
    $month_name[] = $smarty->translate[$m_id['month']];
}

$month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}



 ////////////                             ajax                                      //////////////
if(isset($_POST['action']) && $_POST['action'] == 'get_unsigned_employee'){
    $year  = $_POST['year'];
    $month = $_POST['month'];
    $responce = get_unsigned_employee($year,$month,$search_cust_ids,$search_emp_ids);   
    echo json_encode($responce);
    exit();
}
//////////////////////                            end                           /////////////////


function get_unsigned_employee($year,$month,$search_cust_ids,$search_emp_ids){
    if($year && $month){
        $obj_rpt_signing = new report_signing();
        $not_signed_employees__ = $obj_rpt_signing->get_unsigned_employees($year, $month);
        $not_signed_employees   = array();
        
        if(!empty($not_signed_employees__)){
            foreach ($not_signed_employees__ as $key => $not_signed_emp) {
                if(empty($not_signed_employees[$not_signed_emp['employee']]['employee_details']))
                    $not_signed_employees[$not_signed_emp['employee']] = array('user_name' => $not_signed_emp['employee'], 'first_name' => $not_signed_emp['employee_fname'], 'last_name' => $not_signed_emp['employee_lname'], 'emp_mob' => $not_signed_emp['employee_mobile']);
            }
        }
        $list_unsigned_employees = filter_customer_employees_list_by_employee_have_work($not_signed_employees, $search_cust_ids, $search_emp_ids);
        $responce = array('status' =>TRUE, 'data' => $list_unsigned_employees);  
    }
    else{
        $responce = array('status' =>FALSE, 'data' => '');
    }
    return $responce;
}


$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name); // take leave type from config.inc.php
/* end-- block for finding month values  */

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

/* this block for finding year values  */
$years_combo_full = $obj_emp->distinct_years();
// var_dump($years_combo);exit('fgf');
$smarty->assign("year_option_values_full", $years_combo_full);

$years_combo = $mail->distinct_mail_years();
$smarty->assign("year_option_values", $years_combo);
/* end-- block for finding year values  */

/* this block for set current value of combo box  */

$sel_year = (isset($_POST["cmb_year"]) ? $_POST["cmb_year"] : 0);
$sel_month = (isset($_POST["cmb_month"]) ? $_POST["cmb_month"] : 0);
$sel_category = (isset($_POST["cmb_category"]) ? $_POST["cmb_category"] : 1);
$smarty->assign('report_month', $sel_month);
$smarty->assign('report_year', $sel_year);
$smarty->assign('report_category', $sel_category);
/* end-- block for set current value of combo box  */

if (isset($_POST['cmb_year']) && isset($_POST['cmb_month']) && isset($_POST['cmb_category']) && $_POST['cmb_year'] != "" && $_POST['cmb_month'] != "" && $_POST['cmb_category'] != "") {

    $mail_list = $pagination->generate($mail->get_all_mail($sel_category, $sel_year, $sel_month), 10);
    $smarty->assign('mail_list', $mail_list);
    $smarty->assign('pagination', $pagination->links($smarty->url . 'mail/list/'));
    $flag = 0;
    $smarty->assign('flag', $flag);
} elseif (!isset($_POST['cmb_year']) && !isset($_POST['cmb_month'])) {

    $smarty->assign('flag', $flag);
    $sel_year = 0;
    $sel_month = 0;
    $_POST['cmb_year'] = $sel_year;
    $_POST['cmb_month'] = $sel_month;
    $_POST['cmb_category'] = $sel_category;
    $smarty->assign('report_month', $sel_month);
    $smarty->assign('report_year', $sel_year);
    $mail_list = $pagination->generate($mail->get_all_mail($sel_category, $sel_year, $sel_month), 10);
    $smarty->assign('mail_list', $mail_list);
    $smarty->assign('pagination', $pagination->links($smarty->url . 'mail/list/'));
}


$smarty->assign('login_user_role',$_SESSION['user_role']);

//for downloading mail attachments
$folder = $customer->get_folder_name($_SESSION['company_id']);
$mail_attachment_folder = $folder."/mail_attatch/";
$smarty->assign('mail_attachment_folder',$mail_attachment_folder);

//autocomplete employees for mail to
$mailable_employees = $equipment->employee_mailable($_SESSION['user_id']);
$smarty->assign('mailable_employees', $mailable_employees);

//all mail recipients for mail sending
$exact_employees_group = $equipment->employee_mailabe_group($_SESSION['user_id']);
$smarty->assign('employees_group',$exact_employees_group);

$smarty->assign('current_year',date('Y'));
$smarty->assign('prev_month',date("m", strtotime("first day of previous month")));
// var_dump(date("/m", strtotime("first day of previous month")));
// exit('gf');
$smarty->assign("month_option_output_full", $month_name_full);
// echo "<pre>".print_r($exact_employees_group, 1)."</pre>"; exit();

$smarty->display('extends:layouts/dashboard.tpl|mail_list.tpl');

function filter_customer_employees_list_by_employee_have_work($not_signed_employees, $allowed_customers = array(), $allowed_employees= array()){
 
    if (!empty($not_signed_employees)){
        foreach ($not_signed_employees as $this_employee => $not_signed_data) {
            if(!in_array($this_employee, $allowed_employees)){
                unset($not_signed_employees[$this_employee]);
                continue;
            }
        }
    }

    return $not_signed_employees;
}

?>