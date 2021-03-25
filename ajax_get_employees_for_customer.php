<?php
/**
 * Author: Shamsudheen
 * for: get relative user data by changing month/year/fkkn
 * Used In: FKKN report interface
*/
require_once('class/setup.php');
require_once('class/dona.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/company.php');
require_once('class/report_signing.php');
$smarty     = new smartySetup(array('messages.xml',"forms.xml", 'user.xml', 'button.xml'), FALSE);//'reports.xml' 
$dona       = new dona();
$user       = new user();
$employee   = new employee();
$obj_rpt    = new report_signing();
$obj_company= new company();

$customer_id    = trim($_REQUEST['cid']);
$fkkn           = trim($_REQUEST['nk']);
$month          = trim($_REQUEST['month']);
$year           = trim($_REQUEST['year']);

$employer_signing_details = $employee->employer_signing_details($customer_id, $month, $year, $fkkn, '');
if(!empty($employer_signing_details[0]['employee_data'])){
    foreach ($employer_signing_details[0]['employee_data'] as $value) {
        $signin_sutl[$value['employee']] = $obj_rpt->get_report_details($year,$month,$value['employee'],$customer_id)['signin_sutl'];

    }
}


$smarty->assign('signin_sutl', $signin_sutl);
// $signin_sutl        = $obj_rpt->get_report_details($year,$month,$passed_employee,$passed_customer)['signin_sutl'];

// $report_signing_details = $obj_rpt->employer_signing_detail($year,$month,$customer_id,$this_employee);
// $signed_employer = $report_signing_details['employer'];
// $smarty->assign('signed_employer', $signed_employer);

$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assigning sort by

$general_privileges = $user->get_privileges($_SESSION['user_id'], 2);
$smarty->assign("general_privileges", $general_privileges);

$permitted_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);
$permitted_employees_ids = array();
$employee_names = array();
if(!empty($permitted_employees)){
    foreach($permitted_employees as $this_employee){
        $permitted_employees_ids[] = $this_employee['username'];
    }
    $employee_names = $dona->get_all_Member_details_for_customer_with_no_trainee($customer_id,$fkkn,$month,$year, $permitted_employees_ids);
    foreach ($employee_names as $key => $value) {
         $employee_names[$key]['sutl_sign']= $obj_rpt->get_report_details($year,$month,$value['empID'],$customer_id)['signin_sutl'];
         $employee_names[$key]['employer_sign'] = $obj_rpt->employer_signing_detail($year, $month,$customer_id , $value['empID'] , $fkkn)['employer'];
    }
    
}


$employee_ids = array();
if(!empty($employee_names)){
    foreach ($employee_names as $e_name)
        $employee_ids[] = $e_name['empID'];
}

$not_sign_emp   = $dona->get_employee_not_signing($customer_id,$month, $year,$fkkn);
$signed_emps   = $dona->get_employees_signed($customer_id,$month, $year,$fkkn);

if(!empty($signed_emps)){
    foreach ($signed_emps as $key => $signed_emps_entry){
        if(!in_array($signed_emps_entry['employee'], $employee_ids))
            unset($signed_emps[$key]);
    }
    $signed_emps = array_values($signed_emps);
}

//  $signed_sutl_array = array();
//  foreach ($signed_emps as $key => $value) {
//     $signed_sutl_array[$value['employee']] = $obj_rpt->get_report_details($year,$month,$value['employee'],$customer_id)['signin_sutl'];

// }
 // var_dump($signed_sutl_array);
 // var_dump($signed_emps);
// $signed_emmployees = array();
// foreach ($employee_names as $key => $employee_s) {
//     if(in_array($employee_s['empID'], array_column($not_sign_emp, 'employee'))){
//         unset($employee_names[$key]);
//     }
// }

//echo "<pre>".print_r($not_sign_emp, 1)."</pre>"; 

/*$NewStr = '';
if(!empty($not_sign_emp)){
        $newArr = array();
	foreach($not_sign_emp as $emp){ 
		$newArr[] = $emp['emp'];
	}
	$NewStr = implode(", ",$newArr);
}*/
if (empty($employee_names))
    $smarty->assign('flg',"false");
else{
    $smarty->assign('flg',"true");
    $login_user_role = $user->user_role($_SESSION['user_id']);
    if($login_user_role == 1 || $general_privileges['employer_signing'] == 1){
        $composed_fkkn = ($fkkn == 3 ? 2 : $fkkn);
        //        $employer_signing_details = $employee->employer_signing_details($customer_id, $month, $year, $fkkn, '');
        // var_dump($customer_id, $month, $year, $composed_fkkn);
        $employer_signing_details = $employee->employer_signing_details($customer_id, $month, $year, $composed_fkkn, '');
        
        $exist_flag = TRUE;
        $signing_employees = array();
        $singing_employers = array();
        if(!empty($employer_signing_details[0]['employee_data'])){
                   
            foreach ($employer_signing_details[0]['employee_data'] as $sign_data) {
                $signing_employees[] = $sign_data['employee'];
                $singing_employers[] = $sign_data['employer'];
            }

            $employee_signing_data = $employer_signing_details[0]['employee_data'];
            if(!empty($employee_signing_data)){
                foreach ($employee_signing_data as $key => $employee_signing_data_entry){
                    if(!in_array($employee_signing_data_entry['employee'], $employee_ids))
                        unset($employee_signing_data[$key]);
                }
                $employee_signing_data = array_values($employee_signing_data);
            }
            // $smarty->assign('employee_signing_data',$employer_signing_details[0]['employee_data']);
            $smarty->assign('employee_signing_data',$employee_signing_data);
            $singing_employers = json_encode($singing_employers);
            $smarty->assign('singing_employers',$singing_employers);

        }
        if(!empty($employee_names)){
            foreach ($employee_names as $employee_s) {
                if(!in_array($employee_s['empID'], $signing_employees)){
                    $exist_flag = FALSE;
                    break;
                }
            }
        }
        if($exist_flag)
            $signing_mode = 'remove';
        else if(!empty($employer_signing_details[0]['employee_data']))
                $signing_mode = 'both';
        else
                $signing_mode = 'signing';
        $smarty->assign('signing_mode',$signing_mode);
    }
}

$form_defaults = $dona->check_exists_fkkn_form_defaults($customer_id);
$default_employer_role = $smarty->translate['executive_director'];
if(!empty($form_defaults) && isset($form_defaults[0]['employer_role']) && $form_defaults[0]['employer_role'] != '')
    $default_employer_role = $form_defaults[0]['employer_role'];

$smarty->assign('form_defaults', !empty($form_defaults) ? $form_defaults[0] : array());

$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_data', $company_data);

if($_SESSION['user_role'] == 1){
    $samsida_pdf_files = $dona->get_pdf_samsida($month, $year, $fkkn, $customer_id);
    $smarty->assign('samsida_pdf_files',$samsida_pdf_files);
}
$smarty->assign('employees',$employee_names);

foreach ($employee_ids as $key => $value) {
    $report_signing_details[] = $obj_rpt->employer_signing_detail($year,$month,$customer_id,$value,$fkkn)['employer'];
// $signed_employer = $report_signing_details['employer'];
// $smarty->assign('signed_employer', $signed_employer);
}
    
$smarty->assign('report_signing_details',$report_signing_details);
if(!empty($not_sign_emp)){
    foreach ($not_sign_emp as $key => $not_sign_emp_entry){
        if(!in_array($not_sign_emp_entry['employee'], $employee_ids))
            unset($not_sign_emp[$key]);
    }
    $not_sign_emp = array_values($not_sign_emp);
}

$superAccess = FALSE;
if($_SESSION['user_role'] == 1){
    $superAccess = TRUE;
}
elseif($_SESSION['user_role'] != 4) {
    $login_emp_role_in_customer = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_id);
    $superAccess = (!empty($login_emp_role_in_customer) && ($login_emp_role_in_customer['role'] == 7 || $login_emp_role_in_customer['role'] == 2)) ? TRUE : FALSE;
}

$employer_signing_details = $employee->employer_signing_details($customer_id, $month, $year, $composed_fkkn, '');
// if(!empty($employer_signing_details[0]['employee_data'])){
//     foreach ($employer_signing_details[0]['employee_data'] as $sign_data) {
//         $signing_employees[] = $sign_data['employee'];
//         $singing_employers[] = $sign_data['employer'];
//     }
//     $singing_employers = json_encode($singing_employers);
//     echo $signing_employees;
//     exit('dfds');
//     $smarty->assign('singing_employers',$singing_employers);
// }


$smarty->assign('not_sign_emp',$not_sign_emp);
$smarty->assign('signed_emps',$signed_emps);
$smarty->assign('default_employer_role',$default_employer_role);
$smarty->assign('superAccess',$superAccess);
$smarty->display('ajax_get_employees_for_customer.tpl');
?>