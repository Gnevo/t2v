<!--
	Auther : Sreerag
	Date   : 2/08/2018  
 -->

<?php
exit();
require_once('class/setup.php');
require_once('configs/config.inc.php');
require_once('class/company.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/newemployee.php');

$smarty = new smartySetup(array("user.xml", "button.xml","month.xml", "forms.xml", 'company.xml'),FALSE);

$obj_cmp     = new company();
$obj_emp     = new employee();
$obj_usr     = new user();
$obj_new_emp = new newemployee();

$company_detail           = $obj_cmp->get_company_detail($_SESSION['company_id']);
if(!empty($company_detail) && trim($company_detail['org_no']) != ''){
	$company_detail['org_no'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_detail['org_no']));
	$company_detail['org_no'] = substr($company_detail['org_no'], 0, 6) . "-" . substr($company_detail['org_no'], 6);
}
// echo "<pre>".print_r($company_detail)."</pre>";
// exit();
// $employee_detail       = $obj_emp->employee_list_exact();
$login_emp_detail         = $obj_emp->get_employee_detail($_SESSION['user_id']);
if($login_emp_detail['social_security'] != '' ){
	$login_emp_detail['social_security'] = substr($login_emp_detail['social_security'], 0, 6) . "-" . substr($login_emp_detail['social_security'], 6);
}
// echo "<pre>".print_r($login_emp_detail,1)."</pre>";
// exit();
$employee_detail          = $obj_new_emp->get_all_terminated_employee();
// $check_employee_signed = $obj_new_emp->check_employee_signed($_SESSION['user_id']);

$check_employee_signed    = $obj_new_emp->check_signed_or_not($_SESSION['user_id']);

// var_dump($check_employee_signed);
// exit('fdg');

// $query_string = explode('&', $_SERVER['QUERY_STRING']);

// if($query_string[0] == 'print_pdf'){
// 	$obj_new_emp ->print_termination_pdf();
// }
if($_POST['action'] == 'print_pdf'){
	$employee            = $_POST['employee_select'];
	$employer_apprdate   = explode('_',$_POST['employee_terminations']);
	$employer_apprdate[1] != null ? $employer  = $employer_apprdate[1] : $employer  = $_SESSION['user_id'];
	$employer_apprdate[0] != 'Välj' ? $appr_date = $employer_apprdate[0] : $appr_date = $_POST['apprd_date'];
	$termination_details = $obj_new_emp->get_termination_data($employee,$employer,$appr_date);
	$employer_name       = $obj_emp->get_employee_detail($employer);

	$emp_basic_det  = $obj_emp->get_employee_detail($employee);
	$company_detail = $obj_cmp->get_company_detail($_SESSION['company_id']);

	if(!empty($company_detail) && trim($company_detail['org_no']) != ''){
    	$company_detail['org_no'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_detail['org_no']));
    	$company_detail['org_no'] = substr($company_detail['org_no'], 0, 6) . "-" . substr($company_detail['org_no'], 6);
	}

	if($emp_basic_det['social_security'] != ''){
		$emp_basic_det['social_security'] = substr($emp_basic_det['social_security'], 0, 6) . "-" . substr($emp_basic_det['social_security'], 6);
	}

	require_once('plugins/pdf_employee_termination.class.php');
	$pdf       = new PDF_employee_termination();
	$pagecount = $pdf->setSourceFile('./pdf_forms/employee_termination.pdf');
 	ob_start ();
	$pdf->AddPage();
	$tppl = $pdf->importPage(1);
    $pdf->useTemplate($tppl, -2, 0, 210);
	 // var_dump($pagecount,$tppl);
    // exit();
	$pdf->company_details  = $company_detail;
	$pdf->employee_details = $emp_basic_det; 
    
    $pdf->employer_details($company_detail);
    $pdf->employee_details($emp_basic_det,$company_detail,$termination_details);
    $pdf->part1($termination_details,$employer_name,$emp_basic_det);
    $pdf->Output(utf8_decode($smarty->translate['employee_termination_form']),'I');
	ob_end_flush(); 


}
$smarty->assign('check_employee_signed', $check_employee_signed);
$smarty->assign('employee_detail', $employee_detail);
$smarty->assign('login_emp_detail', $login_emp_detail);


$smarty->assign('company_detail',$company_detail);

// if(isset($_POST['save_sign'])){
// 	$obj_usr->username = $_SESSION['user_id'];
// 	$obj_usr->password = $_POST['password'];
// 	$obj_usr->company_id = $_SESSION['company_id'];
// 	if($obj_usr->validate_secondary_login()){
// 		var_dump('expression');
// 	}
// 	else{
// 		var_dump('qwwere');
// 	}
// }
// echo "<pre>".print_r($login_emp_detail,1)."</pre>";
// exit();
function timezone_set(){
	$start_time = new DateTime;
	$start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
	$start_time->setTimestamp(time());
	$current_date_time = $start_time->format('Y-m-d G:i:s');
	return $current_date_time;
} 

$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->assign('current_date',timezone_set());
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->display('employee_termination.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|leave_annex_report.tpl');





