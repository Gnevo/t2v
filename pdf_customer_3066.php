<?php
require_once('class/setup.php');
require_once('class/customer_pdf.php');
require_once('class/customer_ai.php');
require_once('class/employee.php');
require_once('class/customer.php');

$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"),FALSE);
$customer_pdf = new customer_pdf();
$customer_ai = new customer_ai();
$employee = new employee();
$customer = new customer();

$customer_username = $_GET['username'];
$sel_employee = isset($_GET['sel_emp']) && trim($_GET['sel_emp']) != '' ? trim($_GET['sel_emp']) : NULL;

$emps_details_loaded = array();

if($sel_employee == NULL){
    $team_employees = $customer_ai->customer_team($customer_username, array(7));
    $emps_details_loaded = $team_employees;
}else {
    $sel_emp_details = $employee->get_employee_detail($sel_employee);
    $emps_details_loaded[] = array(
        'employee'      => $sel_emp_details['username'],
        'first_name'    => $sel_emp_details['first_name'],
        'last_name'     => $sel_emp_details['last_name'],
        'social_security'=> $sel_emp_details['social_security'],
        'century'       => $sel_emp_details['century'],
        'activation_date'=> $sel_emp_details['date']
    );
}

if(!empty($emps_details_loaded)){
    
    $tmp_teamp_emp_ids_loaded = array();
    foreach($emps_details_loaded as $te){
        $tmp_teamp_emp_ids_loaded[] = $te['employee'];
    }

    $team_employees_3066_datas = $customer_ai->customer_3066_get($customer_username, $tmp_teamp_emp_ids_loaded);

    //grouping $team_employees_3066_datas as employee as index
    $team_employees_3066_datas_indexed = array();
    if(!empty($team_employees_3066_datas)){
        foreach($team_employees_3066_datas as $data){
            if($data['se_phone'] != "")
                $data['se_phone'] = "0".substr($data['se_phone'], 0,2) . "-" . substr($data['se_phone'], 2);
            if($data['se_mobile'] != "")
                $data['se_mobile'] = "0".substr($data['se_mobile'], 0,2) . "-" . substr($data['se_mobile'], 2);
            $team_employees_3066_datas_indexed[$data['employee']] = $data;
        }
    }
    
    foreach($emps_details_loaded as $key => $te){
        if(isset($team_employees_3066_datas_indexed[$te['employee']]))
            $emps_details_loaded[$key]['saved_data'] = $team_employees_3066_datas_indexed[$te['employee']];
        else
            $emps_details_loaded[$key]['saved_data'] = array();
    }

    foreach($emps_details_loaded as $key => $e){
        $emps_details_loaded[$key]['social_security'] = substr($e['social_security'], 0, -4) . "-" . substr($e['social_security'], 6);;
    }
}

$company_detail = $customer->get_company_detail($_SESSION['company_id']);
if(!empty($company_detail) && trim($company_detail['org_no']) != ''){
    $company_detail['org_no'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_detail['org_no']));
    $company_detail['org_no'] = substr($company_detail['org_no'], 0, 6) . "-" . substr($company_detail['org_no'], 6);
    
    $company_detail['cp_name'] = trim($company_detail['contact_person1']) != '' ? trim($company_detail['contact_person1']) : trim($company_detail['contact_person2']);
    $company_detail['contact_number'] = trim($company_detail['phone']) != '' ? trim($company_detail['phone']) : trim($company_detail['mobile']);
}

$customer_detail = $customer->customer_detail($customer_username);
$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);

$customer_pdf->getCustomer3066($customer_username, $customer_detail, $emps_details_loaded, $company_detail);
?>