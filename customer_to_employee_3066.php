<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/customer_ai.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml","common.xml","privilege.xml"));
$employee = new employee();
$customer = new customer();
$messages = new message();
$customer_ai = new customer_ai();
$user = new user();
$obj_general = new general();
//echo "<pre>";print_r($_SESSION);exit();
$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_3066'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}
$sel_emp_details = $employee->get_employee_detail($_SESSION['user_id']);
$_SESSION['user_ssn'] = $sel_emp_details['century'].''.$sel_emp_details['social_security'];
$_SESSION['user_fname'] = $sel_emp_details['first_name'];
$_SESSION['user_lname'] = $sel_emp_details['last_name'];

date_default_timezone_set('CET');
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'F-3066'));

//$sel_employee = (isset($_POST["cmb_employee"]) ? $_POST["cmb_employee"] : NULL);

$query_string = explode('&', $_SERVER['QUERY_STRING']);
$customer_username = trim($query_string[0]);

$team_employees = $customer_ai->customer_team($customer_username, array(7));
$smarty->assign('team_employees', $team_employees);
// echo "<pre>".print_r($team_employees, 1)."</pre>"; exit();
$teamp_emp_ids = array();
if(!empty($team_employees)){
    foreach($team_employees as $te){
        $teamp_emp_ids[] = $te['employee'];
    }
}

$emps_details_loaded = array();
$sel_employee = NULL;
if(isset($_POST) && $_POST['selected_action'] != ''){
    
    if($_POST['selected_action'] == 'SAVE'){
        $sel_employee = (isset($_POST["selected_employee"]) ? trim($_POST["selected_employee"]) : NULL);
        //echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
        
        $transaction_flag = TRUE;
            
        /*$user->username = strip_tags($_SESSION['user_id']); //strip_tags($_POST['signing_password']);
        $user->password = strip_tags($_POST['signing_password']);
        $user->company_id = strip_tags($_SESSION['company_id']);
        
        $cur_user = $user->validate_secondary_login();
        if(empty($cur_user)){
            $transaction_flag = FALSE;
            $messages->set_message('fail', 'invalid_username_or_password');
        }*/
        
        if($transaction_flag){
            if(!empty($_POST['assi_resi_outside_ees'])){
                $customer_ai->customer = $customer_username;
                $customer_ai->signing_date = date('Y-m-d H:i:s');
                $customer_ai->signing_employee = $_SESSION['user_id'];


                foreach($_POST['assi_resi_outside_ees'] as $emp_key => $assi_resi_outside_ees){
                    $customer_ai->employee              = $emp_key;
                    $customer_ai->is_assi_have_pa       = (isset($_POST['is_assi_have_pa_'.$emp_key]) && $_POST['is_assi_have_pa_'.$emp_key] !== NULL ? $_POST['is_assi_have_pa_'.$emp_key] : NULL);
                    $customer_ai->is_assi_resi_outside_ees = (isset($_POST['is_assi_resi_outside_ees_'.$emp_key]) && $_POST['is_assi_resi_outside_ees_'.$emp_key] !== NULL ? $_POST['is_assi_resi_outside_ees_'.$emp_key] : NULL);
                    $customer_ai->assi_resi_outside_ees = (isset($_POST['assi_resi_outside_ees'][$emp_key]) && $customer_ai->is_assi_resi_outside_ees == 1 ? $_POST['assi_resi_outside_ees'][$emp_key] : NULL);
                    $customer_ai->changes_applies_from  = (isset($_POST['changes_applies_from'][$emp_key]) && trim($_POST['changes_applies_from'][$emp_key]) != '' ? trim($_POST['changes_applies_from'][$emp_key]) : NULL);
                    $customer_ai->i_own_employer        = (isset($_POST['i_own_employer'][$emp_key]) && $_POST['i_own_employer'][$emp_key] !== NULL ? $_POST['i_own_employer'][$emp_key] : NULL);
                    $customer_ai->hire_assi_provider    = (isset($_POST['hire_assi_provider'][$emp_key]) && $_POST['hire_assi_provider'][$emp_key] !== NULL ? $_POST['hire_assi_provider'][$emp_key] : NULL);
                    $customer_ai->company_cp_name       = (isset($_POST['company_cp_name'][$emp_key]) && trim($_POST['company_cp_name'][$emp_key]) !== NULL ? trim($_POST['company_cp_name'][$emp_key]) : NULL);
                    $customer_ai->company_cp_phone      = (isset($_POST['company_cp_phone'][$emp_key]) && trim($_POST['company_cp_phone'][$emp_key]) !== NULL ? trim($_POST['company_cp_phone'][$emp_key]) : NULL);
                    $customer_ai->is_organizer_employers_assi = (isset($_POST['is_organizer_employers_assi_'.$emp_key]) && $_POST['is_organizer_employers_assi_'.$emp_key] !== NULL ? $_POST['is_organizer_employers_assi_'.$emp_key] : NULL);
                    $customer_ai->name_of_another_employer = (isset($_POST['name_of_another_employer'][$emp_key]) && $customer_ai->is_organizer_employers_assi == 2 ? $_POST['name_of_another_employer'][$emp_key] : NULL);
                    $customer_ai->another_employer_org_no = (isset($_POST['another_employer_org_no'][$emp_key]) && $customer_ai->is_organizer_employers_assi == 2 ? $_POST['another_employer_org_no'][$emp_key] : NULL);

                    $transaction_flag = $customer_ai->customer_3066_insert_or_update();
                    if(!$transaction_flag) break;
                }

                if($transaction_flag)
                    $messages->set_message('success', 'data_saved');
                else
                    $messages->set_message('fail', 'error_saving');
            }
        }
    }
    
    if($_POST['selected_action'] == 'LOAD' || $_POST['selected_action'] == 'SAVE'){
        $sel_employee = (isset($_POST["selected_employee"]) ? trim($_POST["selected_employee"]) : NULL);
        
        if($sel_employee == NULL){
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
            
            //$team_employees_3066 = $customer_ai->customer_3066_get($customer_username, $sel_employee);
        }
        //echo "<pre>".print_r($emps_details_loaded, 1)."</pre>"; exit();
        $team_emps_details_loaded = $team_employees;
    }
    
} else {
    $emps_details_loaded = $team_employees;
}

//echo "<pre>".print_r($emps_details_loaded, 1)."</pre>"; exit();
if(!empty($emps_details_loaded)){
    
    $tmp_teamp_emp_ids_loaded = array();
    foreach($emps_details_loaded as $te){
        $tmp_teamp_emp_ids_loaded[] = $te['employee'];
    }
    
    $team_employees_3066_datas = $customer_ai->customer_3066_get($customer_username, $tmp_teamp_emp_ids_loaded);
    //echo "<pre>";print_r($team_employees_3066_datas);
    if($_POST['selected_action'] == 'LOAD'){
        foreach($team_emps_details_loaded as $te){
        $tmp_teamp_emp_ids_loaded[] = $te['employee'];
        }
    }
    $team_employees_3066_signed_datas = $customer_ai->customer_3066_get_signing_employee($customer_username, $tmp_teamp_emp_ids_loaded);
    $signed_ids_loaded = [];
    
    if(count($team_employees_3066_signed_datas) > 0){
        foreach($team_employees_3066_signed_datas as $te){
            $signed_ids_loaded[] = $te['employee'];
        }
    }
    
    $team_employees_3066_allready_send_to_fk = $customer_ai->allready_send_to_fk($customer_username,$signed_ids_loaded);
    //echo "<pre>";print_r($team_employees_3066_signed_datas);exit();
    $send_ids_loaded = [];
    
    if(count($team_employees_3066_allready_send_to_fk)> 0 ){
        foreach($team_employees_3066_allready_send_to_fk as $te){
            $send_ids_loaded[] = $te['employee'];
        }
    }
    
    $team_employees_3066_send_to_fk = $customer_ai->send_to_fk($customer_username,$send_ids_loaded);
    
    if(count($team_employees_3066_signed_datas) > 0){
        foreach($team_employees_3066_signed_datas as $de){
            $tmp_signed_ids_loaded[] = $de['employee'];
        }
    }
    //echo "<pre>si".print_r($tmp_signed_ids_loaded, 1)."</pre>";exit();
    $team_employees_3066_unsigned_datas = $customer_ai->customer_3066_get_unsigning_employee($customer_username, $tmp_signed_ids_loaded, array(7));
    //echo "<pre>si".print_r($team_employees_3066_send_to_fk, 1)."</pre>";exit();
    //echo "<pre>un".print_r($team_employees_3066_unsigned_datas, 1)."</pre>"; exit();
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
    //exit();
    foreach($emps_details_loaded as $key => $te){
        if(isset($team_employees_3066_datas_indexed[$te['employee']]))
            $emps_details_loaded[$key]['saved_data'] = $team_employees_3066_datas_indexed[$te['employee']];
        else
            $emps_details_loaded[$key]['saved_data'] = array();
    }


    //echo "<pre>".print_r($emps_details_loaded, 1)."</pre>"; exit();
}

$company_detail = $customer->get_company_detail($_SESSION['company_id']);
if(!empty($company_detail) && trim($company_detail['org_no']) != ''){
    $company_detail['org_no'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_detail['org_no']));
    $company_detail['org_no'] = substr($company_detail['org_no'], 0, 6) . "-" . substr($company_detail['org_no'], 6);
    
    $company_detail['cp_name'] = trim($company_detail['contact_person1']) != '' ? trim($company_detail['contact_person1']) : trim($company_detail['contact_person2']);
    $company_detail['contact_number'] = trim($company_detail['phone']) != '' ? trim($company_detail['phone']) : trim($company_detail['mobile']);
}
$smarty->assign('company_detail', $company_detail);
//echo "<pre>".print_r($company_detail, 1)."</pre>"; exit();

if(!empty($emps_details_loaded)){
    foreach($emps_details_loaded as $key => $e){
        $emps_details_loaded[$key]['social_security'] = substr($e['social_security'], 0, -4) . "-" . substr($e['social_security'], 6);;
    }
}

$smarty->assign('emp_unsigned', $team_employees_3066_unsigned_datas);
$smarty->assign('emp_signed', $team_employees_3066_signed_datas);
$smarty->assign('emps_details_loaded', $emps_details_loaded);
$smarty->assign('sel_employee',$sel_employee);


if (!empty($query_string)) {
    $customer_detail = $customer->customer_detail($customer_username);
    $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
    $smarty->assign('customer_detail', $customer_detail);
    //echo "<pre>".print_r($customer_detail, 1)."</pre>"; exit();
}
//echo "<pre>".print_r($cust_emp_team_details)."</pre>";exit();
$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('allready_send_to_fk', $team_employees_3066_allready_send_to_fk);
$smarty->assign('send_to_fk', $team_employees_3066_send_to_fk);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('message', $messages->show_message());
$smarty->assign('access_flag', ($customer->is_customer_accessible($customer_username)) ? 1 : 0);
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->display('extends:layouts/dashboard.tpl|customer_to_employee_3066.tpl|layouts/sub_layout_customer_tabs.tpl');
date_default_timezone_set('UTC');
?>