<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/team.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/general.php');
require_once('plugins/message.class.php');
$messages = new message();
$customer = new customer();
$employee = new employee();
$team = new team();
$user = new user();
$obj_general = new general();
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","privilege.xml"));
$customer_username = $_SERVER['QUERY_STRING'];

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_privileges'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}
$customer_detail = $customer->customer_detail($customer_username);
$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
$smarty->assign('tab','1');
$employee_select = "";
$role = 3;
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

if(isset($_POST['curr_tab'])){
    //exit('exit');
    
    $curr_tab = $_POST['curr_tab'];
    $new_tab = $_POST['new_tab'];
    $smarty->assign('tab',$new_tab);
    $employees = $_POST['employees'];
    $role = $_POST['roles'];
    // Last Edit sreerag 12/02/2018  privilege setting
    if($curr_tab == 1){
        $employee->swap = isset($_POST['swap']) && trim($_POST['swap']) == 1 ? $_POST['swap'] : 0;
        $employee->process = isset($_POST['process']) && trim($_POST['process']) == 1 ? $_POST['process'] : 0;
        $employee->add_slot =isset($_POST['add_slot']) && trim($_POST['add_slot']) == 1 ? $_POST['add_slot'] : 0;
        $employee->fkkn = isset($_POST['fkkn']) && trim($_POST['fkkn']) == 1 ? $_POST['fkkn'] : 0;
        $employee->slot_type = isset($_POST['slot_type']) && trim($_POST['slot_type']) == 1 ? $_POST['slot_type'] : 0;
        $employee->add_customer = isset($_POST['add_customer']) && trim($_POST['add_customer']) == 1 ? $_POST['add_customer'] : 0;
        $employee->add_employee= isset($_POST['add_employee']) && trim($_POST['add_employee']) == 1 ? $_POST['add_employee'] : 0;
        $employee->leave = isset($_POST['leave']) && trim($_POST['leave']) == 1 ? $_POST['leave'] : 0;
        $employee->copy_single_slot = isset($_POST['copy_single_slot']) && trim($_POST['copy_single_slot']) == 1 ? $_POST['copy_single_slot'] : 0;
        $employee->copy_single_slot_option = isset($_POST['copy_single_slot_option']) && trim($_POST['copy_single_slot_option']) == 1 ? $_POST['copy_single_slot_option'] : 0;
        $employee->copy_day_slot = isset($_POST['copy_day_slot']) && trim($_POST['copy_day_slot']) == 1 ? $_POST['copy_day_slot'] : 0;
        $employee->copy_day_slot_option = isset($_POST['copy_day_slot_option']) && trim($_POST['copy_day_slot_option']) == 1 ? $_POST['copy_day_slot_option'] : 0;
        $employee->delete_slot =isset($_POST['delete_slot']) && trim($_POST['delete_slot']) == 1 ? $_POST['delete_slot'] : 0;
        $employee->delete_day_slot = isset($_POST['delete_day_slot']) && trim($_POST['delete_day_slot']) == 1 ? $_POST['delete_day_slot'] : 0;
        $employee->remove_customer = isset($_POST['remove_customer']) && trim($_POST['remove_customer']) == 1 ? $_POST['remove_customer'] : 0;
        $employee->remove_employee = isset($_POST['remove_employee']) && trim($_POST['remove_employee']) == 1 ? $_POST['remove_employee'] : 0;
        $employee->split_slot = isset($_POST['split_slot']) && trim($_POST['split_slot']) == 1 ? $_POST['split_slot'] : 0;
        $employee->delete_multiple_slots = isset($_POST['delete_multiple_slots']) && trim($_POST['delete_multiple_slots']) == 1 ? $_POST['delete_multiple_slots'] : 0;
        $employee->contract_override =isset($_POST['contract_override']) && trim($_POST['contract_override']) == 1 ? $_POST['contract_override'] : 0;
        $employee->atl_override = isset($_POST['atl_override']) && trim($_POST['atl_override']) == 1 ? $_POST['atl_override'] : 0;
        $employee->change_time = isset($_POST['change_time']) && trim($_POST['change_time']) == 1 ? $_POST['change_time'] : 0;
        $employee->no_pay_leave = isset($_POST['no_pay_leave']) && trim($_POST['no_pay_leave']) == 1 ? $_POST['no_pay_leave'] : 0;
        $employee->candg_approve = isset($_POST['candg_approve']) && trim($_POST['candg_approve']) == 1 ? $_POST['candg_approve'] : 0;
        $employee->show_percentage_month = isset($_POST['show_percentage_month']) && trim($_POST['show_percentage_month']) == 1 ? $_POST['show_percentage_month'] : 0;
        $employee->not_show_employees= isset($_POST['not_show_employees']) && trim($_POST['not_show_employees']) == 1 ? $_POST['not_show_employees'] : 0;
        $data = $employee->add_previleges($employees);
        
    }
    else if($curr_tab == 2){
        $employee->customer_schedule = isset($_POST['customer_schedule']) && trim($_POST['customer_schedule']) == 1 ? $_POST['customer_schedule'] : 0;
        $employee->employee_schedule = isset($_POST['employee_schedule']) && trim($_POST['employee_schedule']) == 1 ? $_POST['employee_schedule'] : 0;
        $employee->monthly_work =isset($_POST['employee_work_report']) && trim($_POST['employee_work_report']) == 1 ? $_POST['employee_work_report'] : 0;
        $employee->report_customer_data = isset($_POST['customer_data']) && trim($_POST['customer_data']) == 1 ? $_POST['customer_data'] : 0;
        $employee->report_customer_leave = isset($_POST['customer_leave']) && trim($_POST['customer_leave']) == 1 ? $_POST['customer_leave'] : 0;
        $employee->report_customer_granded_vs_used = isset($_POST['customer_granded_vs_used']) && trim($_POST['customer_granded_vs_used']) == 1 ? $_POST['customer_granded_vs_used'] : 0;
        $employee->report_customer_employee_connection = isset($_POST['customer_employee_connection']) && trim($_POST['customer_employee_connection']) == 1 ? $_POST['customer_employee_connection'] : 0;
        $employee->report_customer_horizontal = isset($_POST['customer_horizontal']) && trim($_POST['customer_horizontal']) == 1 ? $_POST['customer_horizontal'] : 0;
        $employee->report_customer_overview = isset($_POST['customer_overview']) && trim($_POST['customer_overview']) == 1 ? $_POST['customer_overview'] : 0;
        $employee->report_customer_vacation_planning = isset($_POST['customer_vacation_planning']) && trim($_POST['customer_vacation_planning']) == 1 ? $_POST['customer_vacation_planning'] : 0;
        $employee->report_employee_data = isset($_POST['employee_data']) && trim($_POST['employee_data']) == 1 ? $_POST['employee_data'] : 0;
        $employee->report_employee_leave = isset($_POST['employee_leave']) && trim($_POST['employee_leave']) == 1 ? $_POST['employee_leave'] : 0;
        $employee->report_employee_percentage= isset($_POST['employee_percentage']) && trim($_POST['employee_percentage']) == 1 ? $_POST['employee_percentage'] : 0;
        $employee->report_atl_warning = isset($_POST['atl_warning']) && trim($_POST['atl_warning']) == 1 ? $_POST['atl_warning'] : 0;
        $employee->report_customer_overlapping = isset($_POST['customer_overlapping']) && trim($_POST['customer_overlapping']) == 1 ? $_POST['customer_overlapping'] : 0;
        $employee->employee_skill_report_privilege = isset($_POST['employee_skill_report_privilege']) && trim($_POST['employee_skill_report_privilege']) == 1 ? $_POST['employee_skill_report_privilege'] : 0;
        $data = $employee->add_previleges_reports($employees);
    }
    else if($curr_tab == 3){
        $employee->form_fkkn                 = isset($_POST['form_fkkn']) && trim($_POST['form_fkkn']) == 1 ? $_POST['form_fkkn'] : 0;
        $employee->form_leave                = isset($_POST['form_leave']) && trim($_POST['form_leave']) == 1 ? $_POST['form_leave'] : 0;
        $employee->form_certificate          = isset($_POST['form_certificate']) && trim($_POST['form_certificate']) == 1 ? $_POST['form_certificate'] : 0;
        $employee->form_form_1               = isset($_POST['form_form_1']) && trim($_POST['form_form_1']) == 1 ? $_POST['form_form_1'] : 0;
        $employee->form_form_2               = isset($_POST['form_form_2']) && trim($_POST['form_form_2']) == 1 ? $_POST['form_form_2'] : 0;
        $employee->form_form_3               = isset($_POST['form_form_3']) && trim($_POST['form_form_3']) == 1 ? $_POST['form_form_3'] : 0;
        $employee->form_form_4               = isset($_POST['form_form_4']) && trim($_POST['form_form_4']) == 1 ? $_POST['form_form_4'] : 0;
        $employee->form_form_5               = isset($_POST['form_form_5']) && trim($_POST['form_form_5']) == 1 ? $_POST['form_form_5'] : 0;
        $employee->form_form_6               = isset($_POST['form_form_6']) && trim($_POST['form_form_6']) == 1 ? $_POST['form_form_6'] : 0;
        $employee->form_form_7               = isset($_POST['form_form_7']) && trim($_POST['form_form_7']) == 1 ? $_POST['form_form_7'] : 0;
        $employee->form_form_1_report        = isset($_POST['form_form_1_report']) && trim($_POST['form_form_1_report']) == 1 ? $_POST['form_form_1_report'] : 0;
        $employee->form_form_2_report        = isset($_POST['form_form_2_report']) && trim($_POST['form_form_2_report']) == 1 ? $_POST['form_form_2_report'] : 0;
        $employee->form_form_3_report        = isset($_POST['form_form_3_report']) && trim($_POST['form_form_3_report']) == 1 ? $_POST['form_form_3_report'] : 0;
        $employee->form_employee_termination = isset($_POST['employee_termination']) && trim($_POST['employee_termination']) == 1 ? $_POST['employee_termination'] : 0;
        
        // echo '<pre>'.print_r($_POST, 1).'</pre>'; exit();
        $data = $employee->add_previleges_forms($employees);
        // echo '<pre>'.print_r($employee->query_error_details, 1).'</pre>';
    }
    else if($curr_tab == 4){
        // print_r($_POST);
        $employee->general_add_employee     = isset($_POST['general_add_employee']) && trim($_POST['general_add_employee']) == 1 ? $_POST['general_add_employee'] : 0;
        $employee->general_edit_employee    = isset($_POST['general_edit_employee']) && trim($_POST['general_edit_employee']) == 1 ? $_POST['general_edit_employee'] : 0;
        $employee->general_add_customer     = isset($_POST['general_add_customer']) && trim($_POST['general_add_customer']) == 1 ? $_POST['general_add_customer'] : 0;
        $employee->general_edit_customer    = isset($_POST['general_edit_customer']) && trim($_POST['general_edit_customer']) == 1 ? $_POST['general_edit_customer'] : 0;
        $employee->general_inconvenient_timing = isset($_POST['general_inconvenient_timing']) && trim($_POST['general_inconvenient_timing']) == 1 ? $_POST['general_inconvenient_timing'] : 0;
        $employee->general_administration   = isset($_POST['general_export']) && trim($_POST['general_export'] ) == 1? $_POST['general_export'] : 0;
        $employee->general_chat             = isset($_POST['general_chat']) && trim($_POST['general_chat'] ) == 1 ? $_POST['general_chat'] : 0;
        $employee->general_survey           = isset($_POST['survey']) && trim($_POST['survey'] ) == 1 ? $_POST['survey'] : 0;
        $employee->general_create_template  = isset($_POST['create_template']) && trim($_POST['create_template'] ) == 1 ? $_POST['create_template'] : 0;
        $employee->general_use_template     = isset($_POST['use_template']) && trim($_POST['use_template'] ) == 1 ? $_POST['use_template'] : 0;  
        $employee->come_and_go_on           = isset($_POST['come_and_go_on']) && trim($_POST['come_and_go_on'] ) == 1 ? $_POST['come_and_go_on'] : 0;
        $employee->general_candg            = isset($_POST['general_candg']) && trim($_POST['general_candg'])  == 1 ? (trim($_POST['come_and_go_on'] ) == 1 ? $_POST['general_candg']: 0) : 0;  
        $employee->general_candg_wo         = isset($_POST['general_candg_wo']) && trim($_POST['general_candg_wo'] ) == 1 ? (trim($_POST['come_and_go_on'] ) == 1 ? $_POST['general_candg_wo']: 0) : 0;          
        $employee->mobile_search            = isset($_POST['mobile_search']) && trim($_POST['mobile_search'] ) == 1 ? $_POST['mobile_search'] : 0;          
        $employee->employer_signing         = isset($_POST['general_employer_signing']) && trim($_POST['general_employer_signing'] ) == 1 ? $_POST['general_employer_signing'] : 0;                   
        $employee->candg_stop_other_emps    = isset($_POST['general_candg_stop_for_other_employees']) && trim($_POST['general_candg_stop_for_other_employees'] ) == 1 ? $_POST['general_candg_stop_for_other_employees'] : 0;    

        $employee->general_customer_settings_insurance_fk   = isset($_POST['general_customer_settings_insurance_fk']) && trim($_POST['general_customer_settings_insurance_fk'] ) == 1 ? $_POST['general_customer_settings_insurance_fk'] : 0;
        $employee->general_customer_settings_insurance_kn   = isset($_POST['general_customer_settings_insurance_kn']) && trim($_POST['general_customer_settings_insurance_kn'] ) == 1 ? $_POST['general_customer_settings_insurance_kn'] : 0;
        $employee->general_customer_settings_insurance_tu   = isset($_POST['general_customer_settings_insurance_tu']) && trim($_POST['general_customer_settings_insurance_tu'] ) == 1 ? $_POST['general_customer_settings_insurance_tu'] : 0;
        $employee->general_customer_settings_implan         = isset($_POST['general_customer_settings_implan']) && trim($_POST['general_customer_settings_implan'] ) == 1 ? $_POST['general_customer_settings_implan'] : 0;
        $employee->general_customer_settings_deswork        = isset($_POST['general_customer_settings_deswork']) && trim($_POST['general_customer_settings_deswork'] ) == 1 ? $_POST['general_customer_settings_deswork'] : 0;
        $employee->general_customer_settings_documentation  = isset($_POST['general_customer_settings_documentation']) && trim($_POST['general_customer_settings_documentation'])  == 1 ? $_POST['general_customer_settings_documentation'] : 0;
        $employee->general_customer_settings_equipment      = isset($_POST['general_customer_settings_equipment']) && trim($_POST['general_customer_settings_equipment'])  == 1 ? $_POST['general_customer_settings_equipment'] : 0;
        // $employee->general_customer_settings_privileges     = isset($_POST['general_customer_settings_privileges']) && trim($_POST['general_customer_settings_privileges '] ) == 1 ? $_POST['general_customer_settings_privileges'] : 0;
        $employee->general_customer_settings_privileges     = 0;
        $employee->general_customer_settings_appointment    = isset($_POST['general_customer_settings_appointment']) && trim($_POST['general_customer_settings_appointment'] ) == 1 ? $_POST['general_customer_settings_appointment'] : 0;
        $employee->general_customer_settings_oncall         = isset($_POST['general_customer_settings_oncall']) && trim($_POST['general_customer_settings_oncall'] ) == 1 ? $_POST['general_customer_settings_oncall'] : 0;
        $employee->general_customer_settings_3066           = isset($_POST['general_customer_settings_3066']) && trim($_POST['general_customer_settings_3066'] ) == 1 ? $_POST['general_customer_settings_3066'] : 0;
        $employee->general_customer_settings_sick_form_defaults = isset($_POST['general_customer_settings_sick_form_defaults']) && trim($_POST['general_customer_settings_sick_form_defaults'] ) == 1 ? $_POST['general_customer_settings_sick_form_defaults'] : 0;
        $employee->general_customer_settings_location       = isset($_POST['general_customer_settings_location']) && trim($_POST['general_customer_settings_location'] ) == 1 ? $_POST['general_customer_settings_location'] : 0;
        $employee->general_employee_settings_contract       = isset($_POST['general_employee_settings_contract']) && trim($_POST['general_employee_settings_contract'] ) == 1 ? $_POST['general_employee_settings_contract'] : 0;
        $employee->general_employee_settings_salary         =isset($_POST['general_employee_settings_salary']) && trim($_POST['general_employee_settings_salary'] ) == 1 ? $_POST['general_employee_settings_salary'] : 0;
        $employee->general_employee_settings_notification   = isset($_POST['general_employee_settings_notification']) && trim($_POST['general_employee_settings_notification'] ) == 1 ? $_POST['general_employee_settings_notification'] : 0;
        // $employee->general_employee_settings_privileges     = isset($_POST['general_employee_settings_privileges']) && trim($_POST['general_employee_settings_privileges '] == 1) ? $_POST['general_employee_settings_privileges'] : 0;
        $employee->general_employee_settings_privileges     = 0;
        $employee->general_employee_settings_cv             = isset($_POST['general_employee_settings_cv']) && trim($_POST['general_employee_settings_cv'] ) == 1 ? $_POST['general_employee_settings_cv'] : 0;
        $employee->general_employee_settings_documentation  = isset($_POST['general_employee_settings_documentation']) && trim($_POST['general_employee_settings_documentation'])  == 1 ? $_POST['general_employee_settings_documentation'] : 0;
        $employee->general_employee_settings_preference     = isset($_POST['general_employee_settings_preference']) && trim($_POST['general_employee_settings_preference'] ) == 1 ? $_POST['general_employee_settings_preference'] : 0;
        $employee->administration_fk_export                 = isset($_POST['administration_fk_export']) && trim($_POST['administration_fk_export'] ) == 1 ? $_POST['administration_fk_export'] : 0;
        $employee->recruitment                              = isset($_POST['recruitment']) && trim($_POST['recruitment'] ) == 1 ? $_POST['recruitment'] : 0;
        $employee->customer_doc_field                       = isset($_POST['general_customer_doc_field']) && trim($_POST['general_customer_doc_field'] ) == 1 ? $_POST['general_customer_doc_field'] : 0;
        $employee->general_employee_checklist_preference    = isset($_POST['general_employee_checklist_preference']) && trim($_POST['general_employee_checklist_preference'] ) == 1 ? $_POST['general_employee_checklist_preference'] : 0;
        
        $data = $employee->add_previleges_general($employees);
    }
    else if($curr_tab == 5){
        $employee->mc_leave_notification = isset($_POST['mc_leave_notification']) && trim($_POST['mc_leave_notification']) == 1 ? $_POST['mc_leave_notification'] : 0;
        $employee->mc_leave_approval = isset($_POST['mc_leave_approval']) && trim($_POST['mc_leave_approval']) == 1 ? $_POST['mc_leave_approval'] : 0;
        $employee->mc_leave_rejection = isset($_POST['mc_leave_rejection']) && trim($_POST['mc_leave_rejection']) == 1 ? $_POST['mc_leave_rejection'] : 0;
        $employee->mc_leave_edit = isset($_POST['mc_leave_edit']) && trim($_POST['mc_leave_edit']) == 1 ? $_POST['mc_leave_edit'] : 0;
        $employee->cirrus_mail = isset($_POST['cirrus_mail']) && trim($_POST['cirrus_mail']) == 1 ? $_POST['cirrus_mail'] : 0;
        $employee->external_mail = isset($_POST['external_mail']) && trim($_POST['external_mail']) == 1 ? $_POST['external_mail'] : 0;
        $employee->mc_notes = isset($_POST['mc_notes']) && trim($_POST['mc_notes']) == 1 ? $_POST['mc_notes'] : 0;
        $employee->mc_notes_approval = isset($_POST['mc_notes_approval']) && trim($_POST['mc_notes_approval']) == 1 ? $_POST['mc_notes_approval'] : 0;
        $employee->mc_notes_rejection = isset($_POST['mc_notes_rejection']) && trim($_POST['mc_notes_rejection']) == 1 ? $_POST['mc_notes_rejection'] : 0;
        $employee->mc_sms = isset($_POST['mc_sms']) && trim($_POST['mc_sms']) == 1 ? $_POST['mc_sms'] : 0;
        $employee->mc_sms_general = isset($_POST['mc_sms_general']) && trim($_POST['mc_sms_general']) == 1 ? $_POST['mc_sms_general'] : 0;
        $employee->mc_document_archive = isset($_POST['mc_document_archive']) && trim($_POST['mc_document_archive']) == 1 ? $_POST['mc_document_archive'] : 0;
        $employee->mc_support = isset($_POST['mc_support']) && trim($_POST['mc_support']) == 1 ? $_POST['mc_support'] : 0;
        $employee->mc_approve_all_leave = isset($_POST['mc_approve_all_leave']) && trim($_POST['mc_approve_all_leave']) == 1 ? $_POST['mc_approve_all_leave'] : 0;
        $data = $employee->add_previleges_mc($employees);
        
    }
    // Last Edit sreerag 12/02/2018  privilege setting
    if($data){
        $messages->set_message('success', 'customer_updating_success');
    }else{
        $messages->set_message('fail', 'customer_updating_failed');
    }
}
$employee_datas = $team->get_team_employees($role,$customer_username);
for($i=0;$i<count($employee_datas);$i++){
    if($employee_select == ""){
        $employee_select = $employee_datas[$i]['username'];
    }else{
        $employee_select = $employee_select.",".$employee_datas[$i]['username'];
    }
}
if($customer->is_customer_accessible($customer_username)){
    $smarty->assign('access_flag',1);
}else{
    $smarty->assign('access_flag',0);
}
$smarty->assign('message', $messages->show_message());
$smarty->assign('selected_emp',$employee_select);
$smarty->assign('role',$role);
$smarty->assign('pre_role',$role);
$smarty->assign('customer_detail',$customer_detail);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'PRIVILEGE'));


$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));

$smarty->display('extends:layouts/dashboard.tpl|customer_privilege.tpl|layouts/sub_layout_customer_tabs.tpl');
?>