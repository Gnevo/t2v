<?php
//ini_set('display_errors', true);
//ini_set('xdebug.var_display_max_depth', 10);
//error_reporting(E_ALL ^ E_NOTICE);
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/report_signing.php');
require_once('configs/config.inc.php');
require_once('plugins/pagination.class.php');
require_once('class/inconvenient.php');
require_once('class/dona.php');
require_once('class/general.php');
require_once ('plugins/customize_pdf_customer_work_report_new.class.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml"));
$pagination = new pagination();
$customer = new customer();
$employee = new employee();
$obj_inconv = new inconvenient();
//$obj_contract = new contract();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
global $month;
if($_SESSION['url_back_back'] != ''){
    $_SESSION['url_back_back']= '';
    unset($_SESSION['url_back_back']);
}
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$years_combo = $employee->distinct_years('all_year');
$smarty->assign("year_option_values", $years_combo);
$month_num = $month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output_short", $month_name_short);
$smarty->assign("month_option_output_full", $month_name_full);


//$search_customers = $customer->customer_list();
//$search_employees = $employee->employee_list();
//$search_customers = $customer->customers_list_for_employee_report(-1);
//$search_employees = $employee->employees_list_for_right_click($_SESSION['user_id'], -1);

//Only gets active customers and employees
$search_customers = $customer->customers_list_for_employee_report();
$search_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);

$search_cust_ids = $search_emp_ids = array();
if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}
//echo "<pre>".print_r($search_cust_ids, 1)."</pre>";
//echo "<pre>".print_r($search_emp_ids, 1)."</pre>";


$params = explode('&', $_SERVER['QUERY_STRING']);

$params_count = count($params);
/**
 * parameters order: Year/M-monthNo/sign_with_bankID/sign_without_bankID/SL-level/page_no/
 * Maximum parameters example: 
 *          unsigned: http://192.168.0.234/works/app/t2v/cirrus-r/report/work/employee/signed/list/2016/M-2/1/1/SL-1/-/
 * 
 * @param Year : year for listing
 * @param M-monthNo : month for listing (either NULL or month number)
 *                  format: M-monthNo
 * @param sign_with_bankID : flag indicates signing report using bankID (either 0/1)
 *                  values: 0-not selected, 1 - selected
 * @param sign_without_bankID : flag indicates signing report without using bankID(normal method) (either 0/1)
 *                  values: 0-not selected, 1 - selected
 * @param SL-level : signing user leve (1-employee 2-TL 3-SuTL)
 *                  format: SL-level
 * @param page_no : pagination page number
 */

//echo "<pre>".print_r($params, 1)."</pre>";
$selected_year = trim($params[0]) ? trim($params[0]) : (in_array(date('Y'),$years_combo) ? date('Y') : '');
$selected_month = $params_count > 1 ? trim($params[1]) : 'M-'.(int) date('m');
if(!is_numeric($selected_month) && $selected_month != ''){
    $split_month_string = explode('-', $selected_month);
    $selected_month = (count($split_month_string) > 1) ? $split_month_string[1] : NULL;
} else
    $selected_month = NULL;
$selected_month_pg_label = 'M-'. ($selected_month != NULL ? $selected_month : '');

$selected_sign_with_bankID = (trim($params[2]) != '' && trim($params[2]) == 1) || $params_count <= 1  ? TRUE : FALSE;
$selected_sign_without_bankID = (trim($params[3]) != '' && trim($params[3]) == 1)  || $params_count <= 1 ? TRUE : FALSE;
$selected_signing_user_level = trim($params[4]);
if(!is_numeric($selected_signing_user_level) && $selected_signing_user_level != ''){
    $split_user_level_string = explode('-', $selected_signing_user_level);
    $selected_signing_user_level = (count($split_user_level_string) > 1) ? $split_user_level_string[1] : NULL;
} else
    $selected_signing_user_level = NULL;
$selected_signing_user_level_pg_label = 'SL-'. ($selected_signing_user_level != NULL ? $selected_signing_user_level : '');

$page_number = 1;
if($params_count == 6 && is_numeric($params[5]))
    $page_number = trim($params[5]);

$total_records_count = 0;
$search_user_name = '';
$report_list = array();
$request_access = ($params_count > 1 ? TRUE : FALSE);    //for checking if page is in first load mode or requested with params

$total_records_count_including_connected = 0;
if ($params_count > 0) {
    if(($selected_sign_with_bankID || $selected_sign_without_bankID) && in_array($selected_signing_user_level, array(1,2,3))){
        $obj_rpt_signing = new report_signing();
        $signed_employees__ = $obj_rpt_signing->get_signed_employees($selected_year, $selected_month, $selected_signing_user_level, $search_cust_ids, $search_emp_ids);
        $signed_employees = array();
//        echo "<pre>".print_r($signed_employees__, 1)."</pre>"; exit();
        $signed_employee = 0;
        $not_signed_gl=0;
        $not_signed_admin = 0;
        $signing_with_bankID = 0;
        $signing_without_bankID = 0;
        $total_records_count = count($signed_employees__);
        if(!empty($signed_employees__)){
            foreach ($signed_employees__ as $key => $signed_emp) {
                
                $use_this_entry = FALSE;
                switch ($selected_signing_user_level){
                    case 1: 
                        if($signed_emp['employee_sign'] != '') $signing_with_bankID++; 
                        else $signing_without_bankID++;
                        
                        if(($selected_sign_with_bankID && $signed_emp['employee_sign'] != '') || ($selected_sign_without_bankID && trim($signed_emp['employee_sign']) == ''))
                            $use_this_entry = TRUE;
                        break;
                    case 2: 
                        if($signed_emp['tl_sign'] != '') $signing_with_bankID++;
                        else $signing_without_bankID++;
                        
                        if(($selected_sign_with_bankID && $signed_emp['tl_sign'] != '') || ($selected_sign_without_bankID && trim($signed_emp['tl_sign']) == ''))
                            $use_this_entry = TRUE;
                        break;
                    case 3: 
                        if($signed_emp['sutl_sign'] != '') $signing_with_bankID++;
                        else $signing_without_bankID++;
                        
                        if(($selected_sign_with_bankID && $signed_emp['sutl_sign'] != '') || ($selected_sign_without_bankID && trim($signed_emp['sutl_sign']) == ''))
                            $use_this_entry = TRUE;
                        break;
                }
                
                if($use_this_entry){
                    
                    if(empty($signed_employees[$signed_emp['employee']]['employee_details']))
                        $signed_employees[$signed_emp['employee']]['employee_details'] = array('user_name' => $signed_emp['employee'], 'first_name' => $signed_emp['employee_fname'], 'last_name' => $signed_emp['employee_lname']);
                    
                    $signed_employees[$signed_emp['employee']]['customers'][] = array(
                                        'user_name'         => $signed_emp['customer'], 
                                        'first_name'        => $signed_emp['customer_fname'], 
                                        'last_name'         => $signed_emp['customer_lname'],
                                        'signing_details'   => array(
                                                                'signin_employee'  => $signed_emp['signin_employee'],
                                                                'signing_employee_name'  => $signed_emp['signing_employee_lname'].' '.$signed_emp['signing_employee_fname'],
                                                                'signin_date'  => $signed_emp['signin_date'],
                                                                'employee_sign_with_bankID'  => trim($signed_emp['employee_sign']) != '' ? TRUE : FALSE,
                                                                'signin_tl'        => $signed_emp['signin_tl'],
                                                                'signin_tl_name'  => $signed_emp['signing_tl_lname'].' '.$signed_emp['signing_tl_fname'],
                                                                'signin_tl_date'        => $signed_emp['signin_tl_date'],
                                                                'tl_sign_with_bankID'  => trim($signed_emp['tl_sign']) != '' ? TRUE : FALSE,
                                                                'signin_sutl'      => $signed_emp['signin_sutl'],
                                                                'signin_sutl_name'  => $signed_emp['signing_sutl_lname'].' '.$signed_emp['signing_sutl_fname'],
                                                                'signin_sutl_date'        => $signed_emp['signin_sutl_date'],
                                                                'sutl_sign_with_bankID'  => trim($signed_emp['sutl_sign']) != '' ? TRUE : FALSE,
                                                            )
                                    );
                }
                
            }
        }
        
        if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == '3059') {
//            echo "<pre>".print_r($_POST, 1)."</pre>";
//            echo "<pre>" . print_r($signed_employees, 1) . "</pre>";
//            exit();

            $this_fkkn = isset($_POST['slot_type']) && $_POST['slot_type'] == 1 ? 1 : 2;

            if (!empty($signed_employees)) {
                $obj_dona = new dona();
                $obj_general = new general();
                $pdf = new PDF_customer();

                foreach ($signed_employees as $empKey => $empData) {
                    foreach ($empData['customers'] as $custData) {
                        $defaults = $obj_dona->check_exists_fkkn_form_defaults($custData['user_name'], $empKey, TRUE);

                        $this_bargaining = $txt_other_bargaining = $provider_of_pa = NULL;
                        $this_agreement = array();
                        if(!empty($defaults)){
                            $this_bargaining = $defaults[0]['bargaining_new'];
                            $txt_other_bargaining = NULL;
                            $provider_of_pa = $defaults[0]['provider_of_pa_flag'];
                            if($provider_of_pa == 2){
                                $this_agreement['type'] = $defaults[0]['agreement_types_new'];
                                $this_agreement['type2_company'] = $defaults[0]['agreement_type2_company'];
                                $this_agreement['type2_orgno'] = $defaults[0]['agreement_type2_orgNo'];
                                $this_agreement['company_cp_name'] = $defaults[0]['company_cp_name'];
                                $this_agreement['company_cp_phone'] = $obj_general->format_mobile($defaults[0]['company_cp_phone']);
                            }
                        }

                        if($this_fkkn == 1)
                            $pdf = $obj_dona->Customer_pdf_work_report($custData['user_name'], $selected_month, $selected_year, $this_fkkn, $this_bargaining, $txt_other_bargaining, $this_agreement, $empKey, NULL, $provider_of_pa, $pdf);
                        else if($this_fkkn == 2 || $this_fkkn == 3) 
                            $pdf = $obj_dona->Customer_pdf_work_report_for_kn($custData['user_name'], $selected_month, $selected_year, $this_fkkn, $this_bargaining, $txt_other_bargaining, $this_agreement, $empKey, NULL, $provider_of_pa, $pdf);
                    }
                }
            }
                if($pdf->page == 0)
                    echo $smarty->translate['no_work_data_available'];
                else
                    $pdf->Output();
            exit();
        }



        if(!empty($signed_employees))
            $report_list = $pagination->generate($signed_employees, 10);

        $smarty->assign('pagination', $pagination->links($smarty->url . 'report/work/employee/signed/list/'.$selected_year.'/'.$selected_month_pg_label.'/'.($selected_sign_with_bankID ? 1 : 0).'/'.($selected_sign_without_bankID ? 1 : 0).'/'.$selected_signing_user_level_pg_label.'/'));
        //trailing '-' parameter for priventing default pagination
        
        $smarty->assign('total_signings_count',$total_records_count);
        $smarty->assign('signing_with_bankID_count',$signing_with_bankID);
        $smarty->assign('signing_without_bankID_count',$signing_without_bankID);
    }
}

// echo "<pre>".print_r($selected_month, 1)."</pre>";
$smarty->assign('list_year', $selected_year);
$smarty->assign("list_month", $selected_month);
$smarty->assign("selected_sign_with_bankID", $selected_sign_with_bankID);
$smarty->assign("selected_sign_without_bankID", $selected_sign_without_bankID);
$smarty->assign("selected_signing_user_level", $selected_signing_user_level);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));
$smarty->assign('report_list', $report_list);
$smarty->assign('request_access', $request_access);
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->display('extends:layouts/dashboard.tpl|employee_work_report_listing_signed.tpl');

?>