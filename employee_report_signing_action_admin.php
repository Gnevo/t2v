<?php
//ini_set('display_errors', true);
//ini_set('xdebug.var_display_max_depth', 10);
//error_reporting(E_ALL ^ E_NOTICE);
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/report_signing.php');
require_once('class/general.php');
require_once('plugins/message.class.php');
require_once('plugins/pagination.class.php');
$smarty = new smartySetup(array("privilege.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml"));
$pagination = new pagination();
$customer = new customer();
$employee = new employee();

if($_SESSION['user_id'] != 'dodo001'){
    $obj_general = new general();
    $messages = new message();
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'ACTION-ON-SIGNING') {
    $obj_return = new stdClass();
    $obj_return->status = FALSE;

    if (isset($_POST['data']) && !empty($_POST['data'])) {
        switch ($_POST['data']['sign_type']) {
            case 'EMPLOYER':
                $__process_customer = trim($_POST['data']['customer']);
                $__process_employee = trim($_POST['data']['employee']);
                $__process_month    = trim($_POST['data']['month']);
                $__process_year     = trim($_POST['data']['year']);
                $__process_type_    = trim($_POST['data']['sign_mode']);
                $__process_type     = NULL;   
                switch ($__process_type_) {
                    case "FK": $__process_type = 1;break;
                    case "KN": $__process_type = 2;break;
                    case "TU": $__process_type = 3;break;
                }

                if($__process_customer != "" && $__process_employee != "" && $__process_month != "" && $__process_year != "" && in_array($__process_type, array(1, 2, 3))){
                    $obj_rpt_signing = new report_signing();
                    $obj_return->status = $obj_rpt_signing->remove_employer_signing_by_admin($__process_year, $__process_month, $__process_customer, $__process_employee, $__process_type) ? TRUE : FALSE;
                }
                break;
            case 'EMPLOYEE':
                $__process_customer = trim($_POST['data']['customer']);
                $__process_employee = trim($_POST['data']['employee']);
                $__process_month    = trim($_POST['data']['month']);
                $__process_year     = trim($_POST['data']['year']);
                $__process_type     = trim($_POST['data']['sign_mode']);

                if($__process_customer != "" && $__process_employee != "" && $__process_month != "" && $__process_year != "" && in_array($__process_type, array('TL', 'SUTL'))){
                    $obj_rpt_signing = new report_signing();
                    $obj_return->status = $obj_rpt_signing->remove_employee_signing_by_admin($__process_year, $__process_month, $__process_customer, $__process_employee, $__process_type) ? TRUE : FALSE;
                }
                break;
        }
    }
    // if(empty($common_customers))
    //     $obj_return->message = $obj_smarty->translate['no_data_available'];
    echo json_encode($obj_return);
    exit();
}


global $month;
//$obj_contract = new contract();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$years_combo = $employee->distinct_years();
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
 * parameters order: Year/M-monthNo/page_no/
 * Maximum parameters example: 
 *          unsigned: http://192.168.0.234/works/app/t2v/cirrus-r/report/employee/signing/action/admin/2016/M-2/1/1/SL-1/-/
 * 
 * @param Year : year for listing
 * @param M-monthNo : month for listing (either NULL or month number)
 *                  format: M-monthNo
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

$selected_signing_user_level = NULL;

$page_number = 1;
if($params_count == 3 && is_numeric($params[2]))
    $page_number = trim($params[2]);

$total_records_count = 0;
$search_user_name = '';
$report_list = array();
$request_access = ($params_count > 1 ? TRUE : FALSE);    //for checking if page is in first load mode or requested with params

if ($params_count > 0) {
    $obj_rpt_signing = new report_signing();
    $signed_employees__ = $obj_rpt_signing->get_signed_employees_with_employer_details($selected_year, $selected_month, $search_cust_ids, $search_emp_ids);
    $signed_employees = array();
   // echo "<pre>".print_r($signed_employees__, 1)."</pre>"; exit();
    $signed_employee = 0;
    $not_signed_gl=0;
    $not_signed_admin = 0;
    $total_records_count = count($signed_employees__);
    if(!empty($signed_employees__)){
        foreach ($signed_employees__ as $key => $signed_emp) {

                
            if(empty($signed_employees[$signed_emp['employee']]['employee_details']))
                $signed_employees[$signed_emp['employee']]['employee_details'] = array('user_name' => $signed_emp['employee'], 'first_name' => $signed_emp['employee_fname'], 'last_name' => $signed_emp['employee_lname']);
            
            $signed_employees[$signed_emp['employee']]['customers'][] = array(
                                'user_name'         => $signed_emp['customer'], 
                                'first_name'        => $signed_emp['customer_fname'], 
                                'last_name'         => $signed_emp['customer_lname'],
                                'signing_details'   => array(
                                                        'signin_employee'       => $signed_emp['signin_employee'],
                                                        'signing_employee_name' => $signed_emp['signing_employee_lname'].' '.$signed_emp['signing_employee_fname'],
                                                        'signin_date'           => $signed_emp['signin_date'],
                                                        'employee_sign_with_bankID'  => trim($signed_emp['employee_sign']) != '' ? TRUE : FALSE,
                                                        'signin_tl'             => $signed_emp['signin_tl'],
                                                        'signin_tl_name'        => $signed_emp['signing_tl_lname'].' '.$signed_emp['signing_tl_fname'],
                                                        'signin_tl_date'        => $signed_emp['signin_tl_date'],
                                                        'tl_sign_with_bankID'   => trim($signed_emp['tl_sign']) != '' ? TRUE : FALSE,
                                                        'signin_sutl'           => $signed_emp['signin_sutl'],
                                                        'signin_sutl_name'      => $signed_emp['signing_sutl_lname'].' '.$signed_emp['signing_sutl_fname'],
                                                        'signin_sutl_date'      => $signed_emp['signin_sutl_date'],
                                                        'sutl_sign_with_bankID' => trim($signed_emp['sutl_sign']) != '' ? TRUE : FALSE,
                                                        'employer_fk'           => $signed_emp['employer_fk'],
                                                        'employer_fk_name'      => $signed_emp['employer_fk_lname'].' '.$signed_emp['employer_fk_fname'],
                                                        'employer_sign_date_fk' => $signed_emp['employer_sign_date_fk'],
                                                        'employer_sign_fk_with_bankID'  => trim($signed_emp['employer_sign_fk']) != '' ? TRUE : FALSE,
                                                        'employer_kn'           => $signed_emp['employer_kn'],
                                                        'employer_kn_name'      => $signed_emp['employer_kn_lname'].' '.$signed_emp['employer_kn_fname'],
                                                        'employer_sign_date_kn' => $signed_emp['employer_sign_date_kn'],
                                                        'employer_sign_kn_with_bankID'  => trim($signed_emp['employer_sign_kn']) != '' ? TRUE : FALSE,
                                                        'employer_tu'           => $signed_emp['employer_tu'],
                                                        'employer_tu_name'      => $signed_emp['employer_tu_lname'].' '.$signed_emp['employer_tu_fname'],
                                                        'employer_sign_date_tu' => $signed_emp['employer_sign_date_tu'],
                                                        'employer_sign_tu_with_bankID'  => trim($signed_emp['employer_sign_tu']) != '' ? TRUE : FALSE,
                                                    )
                            );
            
        }
    }

    if(!empty($signed_employees))
        $report_list = $pagination->generate($signed_employees, 10);

    $smarty->assign('pagination', $pagination->links($smarty->url . 'report/employee/signing/action/admin/'.$selected_year.'/'.$selected_month_pg_label.'/'));
    //trailing '-' parameter for priventing default pagination
    
    $smarty->assign('total_signings_count',$total_records_count);
}

//echo "<pre>".print_r($report_list, 1)."</pre>";
$smarty->assign('list_year', $selected_year);
$smarty->assign("list_month", $selected_month);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));
//echo "<pre>".print_r($report_list, 1)."</pre>";exit();
$smarty->assign('report_list', $report_list);
$smarty->assign('request_access', $request_access);
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->display('extends:layouts/dashboard.tpl|employee_report_signing_action_admin.tpl');

?>