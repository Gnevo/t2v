<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);
/**
 * @author: Shamsudheen
 * for: Interface for Fkkn report & samsida module
*/
require_once ('class/setup.php');
require_once ('class/dona.php');
require_once ('class/customer.php');
require_once ('configs/config.inc.php');
require_once ('class/company.php');
require_once ('class/user.php');
require_once ('class/general.php');
require_once ('class/employee.php');
require_once ('class/report_signing.php');

$smarty         = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"),FALSE);
$dona           = new dona();
$customer       = new customer();
$obj_company    = new company();
$obj_user       = new user();
$obj_general    = new general();
$obj_rpt        = new report_signing();
$qry_string     = explode('&', $_SERVER['QUERY_STRING']);
/* this block for finding month values  */
global $month;
$month_num = array();
$month_name= array();


$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$smarty->assign('login_user',$_SESSION['user_id']);

foreach ($month as $m_id){
    $month_num[] = $m_id['id'];
    $month_name[]= $smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);

$years_combo= $dona->distinct_timetable_years(TRUE);
$smarty->assign("year_option_values", $years_combo);

//$all_customer = $dona->get_customer_details();
if($qry_string[0] == "")
    $all_customer = $customer->customer_list();
else
    $all_customer = $customer->customer_list($qry_string[0]);

//get default fkkn parameters for each customers
$customers_count = count($all_customer);

//print_r($customers_count);exit();
$general_privileges = $obj_user->get_privileges($_SESSION['user_id'], 2);
$smarty->assign("general_privileges", $general_privileges);
//$general_privileges['employer_signing'];
        
if($_SESSION['user_role'] == 1 || $general_privileges['employer_signing'] == 1){
    $obj_employee = new employee();

    for ($m = 0 ; $m < $customers_count ; $m++){
        $defaults = $dona->check_exists_fkkn_form_defaults($all_customer[$m]['username']);
        //        echo "<pre>".print_r($defaults, 1)."</pre>";
        $all_customer[$m]['defaults'] = array();
        if(!empty($defaults)){  //&& isset($defaults[0]['agreement_types']) && $defaults[0]['agreement_types'] != ''
            $all_customer[$m]['defaults'] = $defaults[0];
        }
        if(!empty($defaults) && isset($defaults[0]['employer_role']) && $defaults[0]['employer_role'] != '')
            $all_customer[$m]['employer_role_text'] = $defaults[0]['employer_role'];
        else
            $all_customer[$m]['employer_role_text'] = $smarty->translate['executive_director'];
        
        if(trim($all_customer[$m]['defaults']['agreement_type2_orgNo']) != ''){
            $all_customer[$m]['defaults']['agreement_type2_orgNo'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($all_customer[$m]['defaults']['agreement_type2_orgNo']));
            $all_customer[$m]['defaults']['agreement_type2_orgNo'] = substr($all_customer[$m]['defaults']['agreement_type2_orgNo'], 0, 6) . "-" . substr($all_customer[$m]['defaults']['agreement_type2_orgNo'], 6);
        }
        if(trim($all_customer[$m]['defaults']['company_cp_phone']) != ''){
            $all_customer[$m]['defaults']['company_cp_phone'] = $obj_general->format_mobile($all_customer[$m]['defaults']['company_cp_phone']);
        }

        $superAccess = FALSE;
        if($_SESSION['user_role'] == 1){
            $superAccess = TRUE;
        }
        elseif($_SESSION['user_role'] != 4) {
            $login_emp_role_in_customer = $obj_employee->get_team_role_of_employee($_SESSION['user_id'], $all_customer[$m]['username']);
            $superAccess = (!empty($login_emp_role_in_customer) && ($login_emp_role_in_customer['role'] == 7 || $login_emp_role_in_customer['role'] == 2)) ? TRUE : FALSE;
        }
        $all_customer[$m]['superAccess'] = $superAccess;
    }
}
//echo "<pre>".print_r($all_customer, 1)."<pre>"; exit();

$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
if(!empty($company_data) && trim($company_data['org_no']) != ''){
    $company_data['org_no'] = $obj_general->format_orgno($company_data['org_no']);
    $company_data['cp_name'] = trim($company_data['contact_person1']) != '' ? trim($company_data['contact_person1']) : trim($company_data['contact_person2']);
    $company_data['contact_number'] = trim($company_data['mobile']) != '' ? trim($company_data['mobile']) : trim($company_data['phone']);
    if(trim($company_data['phone']) != ''){
        $company_data['contact_number'] = $obj_general->format_mobile($company_data['phone']);
    }
}
$smarty->assign("company_data", $company_data);
$smarty->assign("customer_details", $all_customer);
//echo "<pre>".print_r($all_customer, 1)."</pre>"; //exit();
//echo "<pre>".print_r($company_data, 1)."</pre>"; //exit();

//print pdf
if ($_POST && isset($_POST['cust_id'])){
 
    $obj_employee = new employee();
    $this_customer      = trim($_POST['cust_id']);
    $this_employee      = trim($_POST['cmb_employee']);
    $this_year          = trim($_POST['cmb_year']);
    $this_month         = trim($_POST['cmb_month']);
    $this_fkkn          = trim($_POST['type']);
    $this_action        = trim($_POST['action']);
    $fake_fk            = ($this_action != '' && $this_action == 'FK-COPY' && ($this_fkkn == 2 || $this_fkkn == 3) ? TRUE : FALSE);
    
    $superAccess = FALSE;
    if($_SESSION['user_role'] == 1){
        $superAccess = TRUE;
    }
    elseif($_SESSION['user_role'] != 4) {
        $login_emp_role_in_customer = $obj_employee->get_team_role_of_employee($_SESSION['user_id'], $this_customer);
        $superAccess = (!empty($login_emp_role_in_customer) && ($login_emp_role_in_customer['role'] == 7 || $login_emp_role_in_customer['role'] == 2)) ? TRUE : FALSE;
    }
    
    $this_employee = $this_employee != '' ? $this_employee : NULL;
    $this_bargaining = NULL;
    $this_agreement = array();
	// HD Start
	$provider_of_pa = (isset($_POST['provider_of_pa']) && trim($_POST['provider_of_pa']) != '' ? trim($_POST['provider_of_pa']) : NULL);
    // HD Stopp
	if($superAccess == TRUE && isset($_POST['bargaining']) && $_POST['bargaining'] != ''){        //only for admin 
        $this_bargaining    = trim($_POST['bargaining']);
        //$txt_other_bargaining = (isset($_POST['txtbargaining']) && trim($_POST['txtbargaining']) != '' && trim($_POST['bargaining']) == 6 ? trim($_POST['txtbargaining']) : NULL);
        //$provider_of_pa = (isset($_POST['provider_of_pa']) && trim($_POST['provider_of_pa']) != '' ? trim($_POST['provider_of_pa']) : NULL);
        //$provider_of_pa = 2;
        $agreement_type = $company_cp_name = $company_cp_phone = $agreement_type2_company = $agreement_type2_orgno = NULL;
        if($provider_of_pa == 2){
            $company_cp_name    = (isset($_POST['company_cp_name']) && trim($_POST['company_cp_name']) != '' ? trim($_POST['company_cp_name']) : NULL);
            $company_cp_phone   = (isset($_POST['company_cp_phone']) && trim($_POST['company_cp_phone']) != '' ? trim($_POST['company_cp_phone']) : NULL);
            if($company_cp_phone != NULL)
                $company_cp_phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_cp_phone));

            $agreement_type = (isset($_POST['agreement_type']) && trim($_POST['agreement_type']) != '' ? trim($_POST['agreement_type']) : 1);

            $agreement_type2_company = ($agreement_type == 2) ? (isset($_POST['agreement_type2_company']) && trim($_POST['agreement_type2_company']) != '' ? trim($_POST['agreement_type2_company']) : NULL) : NULL;
            $agreement_type2_orgno = ($agreement_type == 2) ? (isset($_POST['agreement_type2_orgno']) && trim($_POST['agreement_type2_orgno']) != '' ? trim($_POST['agreement_type2_orgno']) : NULL) : NULL;
            if($agreement_type2_orgno != '')
                $agreement_type2_orgno = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($agreement_type2_orgno));
        }
        $this_agreement['type']             = $agreement_type;
        $this_agreement['type2_company']    = $agreement_type2_company;
        $this_agreement['type2_orgno']      = $agreement_type2_orgno;
        $this_agreement['company_cp_name']  = $company_cp_name;
        $this_agreement['company_cp_phone'] = $obj_general->format_mobile($company_cp_phone);
        //save form defaults (Section 5 and Section 6)
        $dona->save_fkkn_form_defaults($this_customer, $this_bargaining, $provider_of_pa, $company_cp_name, $company_cp_phone, $agreement_type, $agreement_type2_company, $agreement_type2_orgno, $this_employee);
    
	}
    if ($this_fkkn == 1 || $fake_fk){
        $dona->Customer_pdf_work_report($this_customer, $this_month, $this_year, $this_fkkn, $this_bargaining, $txt_other_bargaining, $this_agreement, $this_employee, NULL, $provider_of_pa);
    }elseif ($this_fkkn == 2 || $this_fkkn == 3) {
        $dona->Customer_pdf_work_report_for_kn($this_customer, $this_month, $this_year, $this_fkkn, $this_bargaining, $txt_other_bargaining, $this_agreement, $this_employee, NULL, $provider_of_pa);
    }exit();
}

$smarty->assign('report_month', (int) date('m', strtotime("last day of last month")));
$smarty->assign('report_year', date('Y', strtotime("last day of last month")));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->display('pdf_customer_work_report.tpl');
//$smarty->display('pdf_customer_work_report_testing.tpl'); //this is only for testing with accordian animation
//$smarty->display('extends:layouts/dashboard.tpl|pdf_customer_work_report.tpl');
?>
