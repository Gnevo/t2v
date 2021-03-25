<?php
require_once('class/setup.php');
require_once('class/dona.php');
require_once('class/customer.php');
require_once('class/equipment.php');
require_once('class/company.php');
require_once('class/employee.php');
require_once('class/general.php');
require_once('plugins/message.class.php');

$smarty         = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$dona           = new dona();
$customer       = new customer();
$msg            = new message();
$obj_company    = new company();
$obj_general    = new general();
$obj_equipment  = new equipment();
$obj_employee   = new employee();
$superAccess    = FALSE;

if(isset($_POST['customer']) && trim($_POST['customer']) != '' && isset($_POST['action']) && trim($_POST['action']) == 'save_params'){
    if($_SESSION['user_role'] == 1){
        $superAccess = TRUE;
    }
    elseif($_SESSION['user_role'] != 4) {
        $login_emp_role_in_customer = $obj_employee->get_team_role_of_employee($_SESSION['user_id'], $_POST['customer']);
        $superAccess = (!empty($login_emp_role_in_customer) && ($login_emp_role_in_customer['role'] == 7 || $login_emp_role_in_customer['role'] == 2)) ? TRUE : FALSE;
    }

    //to save default form values from fkkn interface - only for admin
    if($superAccess == TRUE && isset($_POST['customer']) && trim($_POST['customer']) != '' && isset($_POST['action']) && trim($_POST['action']) == 'save_params'){
        
        //    echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
        $__param_customer   = trim($_POST['customer']);
        $this_employee      = trim($_POST['employee']);
        $this_employee      = $this_employee != '' ? $this_employee : NULL;
        $this_bargaining    = trim($_POST['bargaining']);
        //    $txt_other_bargaining = (isset($_POST['bargaining_text']) && trim($_POST['bargaining_text']) != '' && trim($_POST['bargaining']) == 6 ? trim($_POST['bargaining_text']) : NULL);
        $provider_of_pa     = (isset($_POST['provider_of_pa']) && trim($_POST['provider_of_pa']) != '' ? trim($_POST['provider_of_pa']) : NULL);
        // $provider_of_pa = 2;
        $agreement_type = $company_cp_name = $company_cp_phone = $agreement_type2_company = $agreement_type2_orgno = NULL;
        if($provider_of_pa == 2){
            $company_cp_name    = (isset($_POST['company_cp_name']) && trim($_POST['company_cp_name']) != '' ? trim($_POST['company_cp_name']) : NULL);
            $company_cp_phone   = (isset($_POST['company_cp_phone']) && trim($_POST['company_cp_phone']) != '' ? trim($_POST['company_cp_phone']) : NULL);
            if($company_cp_phone != NULL)
                $company_cp_phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_cp_phone));

            $agreement_type = (isset($_POST['agreement_type']) && trim($_POST['agreement_type']) != '' ? trim($_POST['agreement_type']) : 1);

            $agreement_type2_company    = ($agreement_type == 2) ? (isset($_POST['agreement_type2_company']) && trim($_POST['agreement_type2_company']) != '' ? trim($_POST['agreement_type2_company']) : NULL) : NULL;
            $agreement_type2_orgno      = ($agreement_type == 2) ? (isset($_POST['agreement_type2_orgno']) && trim($_POST['agreement_type2_orgno']) != '' ? trim($_POST['agreement_type2_orgno']) : NULL) : NULL;
            if($agreement_type2_orgno != '')
                $agreement_type2_orgno  = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($agreement_type2_orgno));
        }
        
        //save form defaults (Section 5 and Section 6)
        $dona->save_fkkn_form_defaults($__param_customer, $this_bargaining, $provider_of_pa, $company_cp_name, $company_cp_phone, $agreement_type, $agreement_type2_company, $agreement_type2_orgno, $this_employee);
    }

    die("Saved Successfully");
}



$query_string = explode("&", $_SERVER['QUERY_STRING']);
$cid    = trim($query_string[2]);
$month  = trim($query_string[0]);
$year   = trim($query_string[1]);
$type   = trim($query_string[3]);
$emp_string = trim($query_string[4]);

$is_fk_template = ($type == 1 ? TRUE : FALSE);

$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$date = date("Y-m-d",strtotime("01-".$month."-".$year));
$month_name = strtolower(date("F",  strtotime($date)));
$smarty->assign('limit',$num);
$smarty->assign('month_name',$month_name);
$smarty->assign('customer',$cid);
$smarty->assign('rpt_type',$type);
$smarty->assign('rpt_emp',$emp_string);
$smarty->assign("month", $month);
$smarty->assign("year", $year);
$smarty->assign("today_date", date("Y-m-d"));

$c_details = $dona->get_customer_details($cid);
$c_mobile = (trim($c_details[0]['phone']) != '') ? trim($c_details[0]['phone']) : trim($c_details[0]['mobile']);
$smarty->assign("SSN", $c_details[0]['century'].$obj_general->format_ssn($c_details[0]['social_security']));
$smarty->assign("customer_phone", $c_mobile);
$smarty->assign("cust_full_name", $c_details[0]['fullname']);
$smarty->assign("cust_ssn", $c_details[0]['century'].$obj_general->format_ssn($c_details[0]['social_security']));

$customer_gardian_details = $customer->customer_getgardins($cid);
//echo "<pre>".print_r($customer_gardian_details, 1)."</pre>"; exit();
if(!empty($customer_gardian_details)){
    $customer_gardian_details[0]['ssn'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($customer_gardian_details[0]['ssn']));
    $customer_gardian_details[0]['ssn2'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($customer_gardian_details[0]['ssn2']));
    $customer_gardian_details[0]['ssn3'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($customer_gardian_details[0]['ssn3']));
    if(trim($customer_gardian_details[0]['ssn']) != '' && strlen(trim($customer_gardian_details[0]['ssn'])) == 10)
        $customer_gardian_details[0]['ssn'] = '19'.trim($customer_gardian_details[0]['ssn']);
    if(trim($customer_gardian_details[0]['ssn2']) != '' && strlen(trim($customer_gardian_details[0]['ssn2'])) == 10)
        $customer_gardian_details[0]['ssn2'] = '19'.trim($customer_gardian_details[0]['ssn2']);
    if(trim($customer_gardian_details[0]['ssn3']) != '' && strlen(trim($customer_gardian_details[0]['ssn3'])) == 10)
        $customer_gardian_details[0]['ssn3'] = '19'.trim($customer_gardian_details[0]['ssn3']);
    $customer_gardian_details[0]['ssn_formated'] = trim($customer_gardian_details[0]['ssn']) != '' ? $obj_general->format_ssn($customer_gardian_details[0]['ssn'], TRUE) : NULL;
    $customer_gardian_details[0]['ssn2_formated'] = trim($customer_gardian_details[0]['ssn2']) != '' ? $obj_general->format_ssn($customer_gardian_details[0]['ssn2'], TRUE) : NULL;
    $customer_gardian_details[0]['ssn3_formated'] = trim($customer_gardian_details[0]['ssn3']) != '' ? $obj_general->format_ssn($customer_gardian_details[0]['ssn3'], TRUE) : NULL;
}
//echo "<pre>".print_r($customer_gardian_details, 1)."</pre>";exit();
$smarty->assign('customer_gardian_details', $customer_gardian_details[0]);

$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$company_organization_no = $company_data['org_no'];
$company_organization_no_formated = substr($company_data['org_no'], 0, -4) . "-" . substr($company_data['org_no'], 6);
$company_phone_formated = '';
if($company_data['phone'] != ""){
    $company_data['phone'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_data['phone']));
    if (substr($company_data['phone'], 0,1) == "0") $company_data['phone'] = substr($company_data['phone'], 1);
    $company_phone_formated = "0".substr($company_data['phone'], 0,2) . "-" . substr($company_data['phone'], 2);
}
$smarty->assign('company_details', $company_data);
$smarty->assign('company_orgnization_no', $company_organization_no);
$smarty->assign('company_organization_no_formated', $company_organization_no_formated);
$smarty->assign('company_phone_formated', $company_phone_formated);
$smarty->assign('company_id', $_SESSION['company_id']);
            
$is_secure_access = TRUE;
if($customer->is_customer_accessible($cid))        //prevent manual typing on URL
    $smarty->assign('flag_cust_access', 1);
else{
    $smarty->assign('flag_cust_access', 0);
    $is_secure_access = FALSE;
}


if($is_secure_access){
    if(!empty($_POST) && isset($_POST['customer'])){
       // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
            $post_data_array = array();
            $post_data_array['customer'] = $cid;
            $post_data_array['employee'] = $emp_string;
            $post_data_array['month'] = $month;
            $post_data_array['year'] = $year;

            //Section 3
            $post_data_array['rd_has_assistance_in_other_activities'] = trim($_POST['rd_has_assistance_in_other_activities']) !== '' && trim($_POST['rd_has_assistance_in_other_activities']) !== null ? trim($_POST['rd_has_assistance_in_other_activities']):NULL;
            $post_data_array['did_u_hostpilized_this_month'] = isset($_POST['did_u_hostpilized_this_month']) && trim($_POST['did_u_hostpilized_this_month']) !== NULL ? trim($_POST['did_u_hostpilized_this_month']) : NULL;
            if($post_data_array['did_u_hostpilized_this_month'] == 1){

                $patterns = array('/\s/', '/,/'); //to remove space from values
                $replaces = array('', '.');

                $post_data_array['hospital_date_from'] = trim($_POST['hospital_date_from']) != '' ? trim($_POST['hospital_date_from']) : NULL;
                $post_data_array['hospital_time_from'] = trim($_POST['hospital_time_from']) != '' && trim($_POST['hospital_time_from']) != ',' ? preg_replace($patterns, $replaces, trim($_POST['hospital_time_from'])) : NULL;
                $post_data_array['hospital_date_to'] = trim($_POST['hospital_date_to']) != '' ? trim($_POST['hospital_date_to']) : NULL;
                $post_data_array['hospital_time_to'] = trim($_POST['hospital_time_to']) != '' && trim($_POST['hospital_time_to']) != ',' ? preg_replace($patterns, $replaces, trim($_POST['hospital_time_to'])) : NULL;

                $post_data_array['hospital_date_from2'] = trim($_POST['hospital_date_from2']) != '' ? trim($_POST['hospital_date_from2']) : NULL;
                $post_data_array['hospital_time_from2'] = trim($_POST['hospital_time_from2']) != '' && trim($_POST['hospital_time_from2']) != ',' ? preg_replace($patterns, $replaces, trim($_POST['hospital_time_from2'])) : NULL;
                $post_data_array['hospital_date_to2'] = trim($_POST['hospital_date_to2']) != '' ? trim($_POST['hospital_date_to2']) : NULL;
                $post_data_array['hospital_time_to2'] = trim($_POST['hospital_time_to2']) != '' && trim($_POST['hospital_time_to2']) != ',' ? preg_replace($patterns, $replaces, trim($_POST['hospital_time_to2'])) : NULL;

                $post_data_array['hospital_date_from3'] = trim($_POST['hospital_date_from3']) != '' ? trim($_POST['hospital_date_from3']) : NULL;
                $post_data_array['hospital_time_from3'] = trim($_POST['hospital_time_from3']) != '' && trim($_POST['hospital_time_from3']) != ',' ? preg_replace($patterns, $replaces, trim($_POST['hospital_time_from3'])) : NULL;
                $post_data_array['hospital_date_to3'] = trim($_POST['hospital_date_to3']) != '' ? trim($_POST['hospital_date_to3']) : NULL;
                $post_data_array['hospital_time_to3'] = trim($_POST['hospital_time_to3']) != '' && trim($_POST['hospital_time_to3']) != ',' ? preg_replace($patterns, $replaces, trim($_POST['hospital_time_to3'])) : NULL;
                //$post_data_array['hospital'] = trim($_POST['hospital']);
                
                $post_data_array['did_u_included_hospitalized_hours'] = (isset($_POST['did_u_included_hospitalized_hours']) && trim($_POST['did_u_included_hospitalized_hours']) == 1) ? 1 : 0;
                
                if($post_data_array['did_u_included_hospitalized_hours'] == 1){
                    $post_data_array['hostpitalized_hours'] = ((int) trim($_POST['hostpitalized_hours_norm_hr']) > 0 || (int) trim($_POST['hostpitalized_hours_norm_min']) > 0) ? ((int) trim($_POST['hostpitalized_hours_norm_hr'])).'.'.((int) trim($_POST['hostpitalized_hours_norm_min'])) : NULL;
                    $post_data_array['hostpitalized_hours_oncall'] = ((int) trim($_POST['hostpitalized_hours_oncall_hr']) > 0 || (int) trim($_POST['hostpitalized_hours_oncall_min']) > 0) ? ((int) trim($_POST['hostpitalized_hours_oncall_hr'])).'.'.((int) trim($_POST['hostpitalized_hours_oncall_min'])) : NULL;
                    $post_data_array['hostpitalized_hours_standby'] = ((int) trim($_POST['hostpitalized_hours_stdby_hr']) > 0 || (int) trim($_POST['hostpitalized_hours_stdby_min']) > 0) ? ((int) trim($_POST['hostpitalized_hours_stdby_hr'])).'.'.((int) trim($_POST['hostpitalized_hours_stdby_min'])) : NULL;
                }
            }else{
                $post_data_array['hospital_date_from'] = $post_data_array['hospital_date_to'] = NULL;
                $post_data_array['hospital_date_from2'] = $post_data_array['hospital_date_to2'] = NULL;
                $post_data_array['hospital_date_from3'] = $post_data_array['hospital_date_to3'] = NULL;
                $post_data_array['hospital_time_from'] = $post_data_array['hospital_time_to'] = NULL;
                $post_data_array['hospital_time_from2'] = $post_data_array['hospital_time_to2'] = NULL;
                $post_data_array['hospital_time_from3'] = $post_data_array['hospital_time_to3'] = NULL;
                $post_data_array['hospital'] = NULL;
                $post_data_array['did_u_included_hospitalized_hours'] = 0;
                $post_data_array['hostpitalized_hours'] = $post_data_array['hostpitalized_hours_oncall'] = $post_data_array['hostpitalized_hours_standby'] = NULL;
            }

            //Section 4
            $section_3_choice = '0||0||0||';
            $section_3_temp = (isset($_POST['section_3_choice_4']) && trim($_POST['section_3_choice_4']) == 1) ? 1 : 0;
            $section_3_choice .= $section_3_temp;

            //$section_3_org_no = (isset($_POST['section_3_choice_2']) && trim($_POST['section_3_choice_2']) == 1 && trim($_POST['section_3_org_no']) != '') ? trim($_POST['section_3_org_no']) : NULL;
            $post_data_array['section_3_choice'] = $section_3_choice;
            //$post_data_array['section_3_org_no'] = $section_3_org_no;


            //Section 5
            $post_data_array['rd_money_left_1'] = trim($_POST['rd_money_left_1']) !== '' && trim($_POST['rd_money_left_1']) !== null ? trim($_POST['rd_money_left_1']):NULL;
            $post_data_array['txt_money_left_1'] = ($post_data_array['rd_money_left_1'] === 0 || $post_data_array['rd_money_left_1'] === '0') ? trim($_POST['txt_money_left_1']) : NULL;

            //Section 6
            $post_data_array['section6_phone'] = trim($_POST['section6_phone']);
            $post_data_array['sign_date'] = trim($_POST['sign_date']) != '' ? trim($_POST['sign_date']) : NULL;

            //Section 7
            $post_data_array['signature_options'] = trim($_POST['who_signed'])?trim($_POST['who_signed']):NULL;
            $post_data_array['signed_customer_name'] = trim($_POST['signed_customer_name']);
            //$post_data_array['signed_customer_telephone'] = trim($_POST['signed_customer_telephone']);
            $post_data_array['signed_customer_ssn'] = trim($_POST['signed_customer_ssn']);

            //Section 8
            $patterns = array('/\s/', '/,/'); //to remove space from values
            $replaces = array('', '.');
            $post_data_array['excl_ob_cost']    = preg_replace($patterns, $replaces, trim($_POST['excl_ob_cost']))?preg_replace($patterns, $replaces, trim($_POST['excl_ob_cost'])):NULL;
            $post_data_array['ob_cost']         = preg_replace($patterns, $replaces, trim($_POST['ob_cost']))?preg_replace($patterns, $replaces, trim($_POST['ob_cost'])):NULL;
            $post_data_array['asst_exp_cost']   = preg_replace($patterns, $replaces, trim($_POST['asst_exp_cost']))?preg_replace($patterns, $replaces, trim($_POST['asst_exp_cost'])):NULL;
            $post_data_array['training_cost']   = preg_replace($patterns, $replaces, trim($_POST['training_cost']))?preg_replace($patterns, $replaces, trim($_POST['training_cost'])):NULL;
            $post_data_array['staff_expense_cost'] = preg_replace($patterns, $replaces, trim($_POST['staff_expense_cost']))?preg_replace($patterns, $replaces, trim($_POST['staff_expense_cost'])):NULL;
            $post_data_array['admin_cost']      = preg_replace($patterns, $replaces, trim($_POST['admin_cost']))?preg_replace($patterns, $replaces, trim($_POST['admin_cost'])):NULL;
            /*$post_data_array['excl_ob_cost']    = trim($_POST['excl_ob_cost']);
            $post_data_array['ob_cost']         = trim($_POST['ob_cost']);
            $post_data_array['asst_exp_cost']   = trim($_POST['asst_exp_cost']);
            $post_data_array['training_cost']   = trim($_POST['training_cost']);
            $post_data_array['staff_expense_cost'] = trim($_POST['staff_expense_cost']);
            $post_data_array['admin_cost']      = trim($_POST['admin_cost']);*/
            
            //$max_cost_size_including_decimal = 11;
            $post_data_array['excl_ob_period']  = preg_replace($patterns, $replaces, trim($_POST['excl_ob_period']))?preg_replace($patterns, $replaces, trim($_POST['excl_ob_period'])):NULL;
            $post_data_array['ob_period']       = preg_replace($patterns, $replaces, trim($_POST['ob_period']))?preg_replace($patterns, $replaces, trim($_POST['ob_period'])):NULL;
            $post_data_array['asst_exp_period'] = preg_replace($patterns, $replaces, trim($_POST['asst_exp_period']))?preg_replace($patterns, $replaces, trim($_POST['asst_exp_period'])):NULL;
            $post_data_array['training_period'] = preg_replace($patterns, $replaces, trim($_POST['training_period']))?preg_replace($patterns, $replaces, trim($_POST['training_period'])):NULL;
            $post_data_array['staff_expense_period'] = preg_replace($patterns, $replaces, trim($_POST['staff_expense_period']))?preg_replace($patterns, $replaces, trim($_POST['staff_expense_period'])):NULL;
            $post_data_array['admin_period']    = preg_replace($patterns, $replaces, trim($_POST['admin_period']))?preg_replace($patterns, $replaces, trim($_POST['admin_period'])):NULL;
            /*$post_data_array['excl_ob_period'] = trim($_POST['excl_ob_period']);
            $post_data_array['ob_period'] = trim($_POST['ob_period']);
            $post_data_array['asst_exp_period'] = trim($_POST['asst_exp_period']);
            $post_data_array['training_period'] = trim($_POST['training_period']);
            $post_data_array['staff_expense_period'] = trim($_POST['staff_expense_period']);
            $post_data_array['admin_period'] = trim($_POST['admin_period']);*/
            $post_data_array['working_hours_4_customer'] = trim($_POST['customer_hours'])?trim($_POST['customer_hours']):0;

            //Section 9
            $post_data_array['acc_date_from']   = trim($_POST['acc_date_from'])?trim($_POST['acc_date_from']):NULL ;
            $post_data_array['acc_date_to']     = trim($_POST['acc_date_to'])?trim($_POST['acc_date_to']):NULL;
            
            $post_data_array['rd_money_left_2'] = trim($_POST['rd_money_left_2']) !== '' && trim($_POST['rd_money_left_2']) !== null ? trim($_POST['rd_money_left_2']):NULL;
            $post_data_array['txt_money_left_2'] = ($post_data_array['rd_money_left_2'] == 1) ? trim($_POST['txt_money_left_2']) : trim($_POST['txt_money_left_2']);
            
            $post_data_array['section_9_choice'] = (isset($_POST['section_9_choice']) && trim($_POST['section_9_choice']) > 0) ? trim($_POST['section_9_choice']) : NULL;

            //echo "<pre>".print_r($post_data_array, 1)."</pre>";

            if(!$is_fk_template){
                $post_data_array['have_received_personal_assistance'] = isset($_POST['rd_have_received_personal_assistance']) && in_array(trim($_POST['rd_have_received_personal_assistance']), array(1,2))  ? trim($_POST['rd_have_received_personal_assistance']) : NULL;
                $post_data_array['have_u_contact_with_assistant_counselors'] = (isset($_POST['have_u_contact_with_assistant_counselors']) && trim($_POST['have_u_contact_with_assistant_counselors']) == 1) ? 1 : 0;
                $post_data_array['hired_assistant_date_from'] = $section_3_temp == 1 && trim($_POST['hired_assistant_date_from']) != '' ? trim($_POST['hired_assistant_date_from']) : NULL;
                $post_data_array['hired_assistant_date_to'] = $section_3_temp == 1 && trim($_POST['hired_assistant_date_to']) != '' ? trim($_POST['hired_assistant_date_to']) : NULL;
                $post_data_array['hired_assistant_normal_hours'] = $section_3_temp == 1 && trim($_POST['hired_assistant_normal_hours']) != '' ? trim($_POST['hired_assistant_normal_hours']) : NULL;
                $post_data_array['hired_assistant_oncall_hours'] = $section_3_temp == 1 && trim($_POST['hired_assistant_oncall_hours']) != '' ? trim($_POST['hired_assistant_oncall_hours']) : NULL;
                $post_data_array['hired_assistant_standby_hours'] = $section_3_temp == 1 && trim($_POST['hired_assistant_standby_hours']) != '' ? trim($_POST['hired_assistant_standby_hours']) : NULL;
                $post_data_array['permission_from_care_inspectorate'] = isset($_POST['rd_permission_from_care_inspectorate']) && in_array(trim($_POST['rd_permission_from_care_inspectorate']), array(1,2))  ? trim($_POST['rd_permission_from_care_inspectorate']) : NULL;
            }


            $this_report = $dona->get_customer_summery_data($cid, $month, $year);
            $edit_flag = FALSE;
            if(!empty($this_report))
                $edit_flag = TRUE;

            if($edit_flag){     //edit existing record
                if($dona->customer_pdf_report_summery_update($post_data_array, $is_fk_template))
                    $msg->set_message ('success', 'report_summery_has_been_successfully_edited');
                else
                    $msg->set_message ('fail', 'report_summery_edit_failed');
                
            }else{              //create new record
                if($dona->customer_pdf_report_summery_insert($post_data_array, $is_fk_template))
                    $msg->set_message ('success', 'report_summery_has_been_successfully_saved');
                else
                    $msg->set_message ('fail', 'report_summery_save_failed');
                // echo "<pre>".print_r($dona->query_error_details, 1)."<pre>"; exit();
                
            }

            if ($_POST['save_print'] == 1){
                $smarty->assign('message', $msg->show_message());
                $dona->samsida = 'print_samsida';
                
                $tmp_rpt_employee = $emp_string != '' ? $emp_string : NULL;
                if($type == 1)
                    $dona->Customer_pdf_work_report($cid, $month, $year, $type, NULL, NULL, array(), $tmp_rpt_employee);
                else if($type == 2 || $type == 3)
                    $dona->Customer_pdf_work_report_for_kn($cid, $month, $year, $type, NULL, NULL, array(), $tmp_rpt_employee);
                exit();
            }
    }

    $pdf_reports = $dona->get_customer_summery_data($cid, $month, $year);
    if(empty($pdf_reports)){
        $pdf_reports_temp = $dona->get_customer_just_previous_summery_data($cid, $month, $year);
        if(!empty($pdf_reports_temp)){
            $pdf_reports_temp['hostpilized_date_from'] = $pdf_reports_temp['hostpilized_date_to'] = '';
            $pdf_reports_temp['did_u_hostpilized_this_month'] = $pdf_reports_temp['did_u_included_hospitalized_hours'] = '';
            $pdf_reports_temp['hostpitalized_hours'] = $pdf_reports_temp['hostpitalized_hours_oncall'] = $pdf_reports_temp['hostpitalized_hours_standby'] = NULL;
            $pdf_reports = array($pdf_reports_temp);
        }
        //$pdf_reports = (!empty($pdf_reports_temp) ? array($pdf_reports_temp) : array());
    }
    $total_cost_hour = 0.00;
    $total_cost_for_period = 0.00;
    $total_customer_no_of_hours = 0.00;
    if(!empty($pdf_reports)){
        $pdf_reports = $pdf_reports[0];

        /*$pdf_reports['hostpitalized_hours_norm_hr'] = $pdf_reports['hostpitalized_hours_norm_min'] = 
                $pdf_reports['hostpitalized_hours_oncall_hr'] = $pdf_reports['hostpitalized_hours_oncall_min'] = 
                $pdf_reports['hostpitalized_hours_stdby_hr'] = $pdf_reports['hostpitalized_hours_stdby_min'] = NULL;
        if($pdf_reports['did_u_hostpilized_this_month'] == 1 && $pdf_reports['did_u_included_hospitalized_hours'] == 1){
            if($pdf_reports['hostpitalized_hours'] != NULL && $pdf_reports['hostpitalized_hours'] != 0){
                $tmp_time_seperation = explode('.', $pdf_reports['hostpitalized_hours']);
                $pdf_reports['hostpitalized_hours_norm_hr'] = $tmp_time_seperation[0];
                $pdf_reports['hostpitalized_hours_norm_min'] = $tmp_time_seperation[1];
            }
            if($pdf_reports['hostpitalized_hours_oncall'] != NULL && $pdf_reports['hostpitalized_hours_oncall'] != 0){
                $tmp_time_seperation = explode('.', $pdf_reports['hostpitalized_hours_oncall']);
                $pdf_reports['hostpitalized_hours_oncall_hr'] = $tmp_time_seperation[0];
                $pdf_reports['hostpitalized_hours_oncall_min'] = $tmp_time_seperation[1];
            }
            if($pdf_reports['hostpitalized_hours_standby'] != NULL && $pdf_reports['hostpitalized_hours_standby'] != 0){
                $tmp_time_seperation = explode('.', $pdf_reports['hostpitalized_hours_standby']);
                $pdf_reports['hostpitalized_hours_stdby_hr'] = $tmp_time_seperation[0];
                $pdf_reports['hostpitalized_hours_stdby_min'] = $tmp_time_seperation[1];
            }
        }*/
        
        $smarty->assign('reports',$pdf_reports);
        
        //echo "<pre>".print_r($pdf_reports, 1)."</pre>";exit();
    
        $sec3_check_values = explode('||', $pdf_reports['how_is_asst_provided']);
        $smarty->assign('sec3_check_values',$sec3_check_values);
        $smarty->assign('edit','true');

        $total_cost_hour = (float) $pdf_reports['salary_excl_OB_cost'] + (float) $pdf_reports['salary_OB_cost'] +
                            (float) $pdf_reports['assist_expenses_cost'] + (float) $pdf_reports['training_cost'] +
                            (float) $pdf_reports['staff_expense_cost'] + (float) $pdf_reports['administration_cost'];

        $total_cost_for_period = (float) $pdf_reports['salary_excl_OB_period'] + (float) $pdf_reports['salary_OB_period'] +
                            (float) $pdf_reports['assist_expenses_period'] + (float) $pdf_reports['training_period'] +
                            (float) $pdf_reports['staff_expense_period'] + (float) $pdf_reports['administration_period'];
        
        $section3_org_no = (($sec3_check_values[1] == 1) ? trim($pdf_reports['how_is_asst_provided_orgno']) : $company_organization_no);
        $section6_phone = (($pdf_reports['signature_options'] == 1 || $pdf_reports['signature_options'] == 2 || $pdf_reports['signature_options'] == 3) ? trim($pdf_reports['signed_customer_phno']) : $c_mobile);
    }
    else{
        $section3_org_no = $company_organization_no;
        $section6_phone = $c_mobile;
        $smarty->assign('edit','false');
        
        $pdf_reports_just_previous = $dona->get_customer_just_previous_summery_data($cid, $month, $year);
        //echo "<pre>".print_r($pdf_reports_just_previous, 1)."</pre>"; exit();
        $prev_sec3_check_values = explode('||', $pdf_reports_just_previous['how_is_asst_provided']);
        $smarty->assign('prev_sec3_check_values',$prev_sec3_check_values);
    }
    if(trim($section3_org_no) != '')
        $section3_org_no = $obj_general->format_orgno($section3_org_no);
    $smarty->assign('section3_org_no', $section3_org_no);
    $smarty->assign('section6_phone', $section6_phone);
    
    //total no.of hours for the customer
    /*$account_date_from = (!empty($pdf_reports) && trim($pdf_reports['accounting_date_from']) != '') ? trim($pdf_reports['accounting_date_from']) : firstOfMonth($month,$year);
    $account_date_to = (!empty($pdf_reports) && trim($pdf_reports['accounting_date_to']) != '') ? trim($pdf_reports['accounting_date_to']) : lastOfMonth($month,$year);*/
    $account_date_from = (!empty($pdf_reports) && trim($pdf_reports['accounting_date_from']) != '') ? trim($pdf_reports['accounting_date_from']) : NULL;
    $account_date_to = (!empty($pdf_reports) && trim($pdf_reports['accounting_date_to']) != '') ? trim($pdf_reports['accounting_date_to']) : NULL;

    if(empty($pdf_reports)){
        /*if($account_date_from != '' && $account_date_to != '')    //commented on 2014-03-11 to avoid starting display of calculated hours
//            $total_customer_no_of_hours = $dona->get_customer_slots_btwn_dates($cid,$account_date_from, $account_date_to, $type, 'HOURS_SUM');
            $total_customer_no_of_hours = $dona->summery_slot_total_btwn_date_range($cid, $account_date_from, $account_date_to, $type);*/
    }else
        $total_customer_no_of_hours = $pdf_reports['working_hours_4_customer'];
    $smarty->assign('total_cost_hour', sprintf('%.02f', round($total_cost_hour, 2)));
    $smarty->assign('total_cost_for_period', sprintf('%.02f', round($total_cost_for_period, 2)));
//    $smarty->assign('total_customer_no_of_hours', sprintf('%.02f', $total_customer_no_of_hours));
    $smarty->assign('total_customer_no_of_hours', round($total_customer_no_of_hours));
    $smarty->assign('start_date', $account_date_from);
    $smarty->assign('end_date', $account_date_to);
    $smarty->assign('message', $msg->show_message());

    $output=array();
    if($emp_string != NULL)
        $output = $dona->summery_edit($cid, $month, $year, $type, $emp_string);
    else
        $output = $dona->summery_edit($cid, $month, $year, $type);
   // echo "<pre>".print_r($output, 1)."</pre>"; 
   // exit();
    if(!$is_fk_template)
        $smarty->assign("no_of_employees_have_slots", $output['no_of_employees_have_slots']);

    $smarty->assign("Tot_normal", sprintf('%.02f', round($obj_equipment->time_user_format($output['tot_Normal'], 60), 2)));
    $smarty->assign("Tot_onCall", sprintf('%.02f', round($obj_equipment->time_user_format($output['tot_onCall'], 60), 2)));
    $smarty->assign("Tot_beredskap", sprintf('%.02f', round($obj_equipment->time_user_format($output['tot_beredskap'], 60), 2)));
    $quarter = $output['tot_onCall']/4;
    $one_seventh = $output['tot_beredskap']/7;
    $smarty->assign("quarter_onCall", sprintf('%.02f', round($obj_equipment->time_user_format($quarter, 60), 2)));
    $smarty->assign("one_seventh_beredskap", sprintf('%.02f', round($obj_equipment->time_user_format($one_seventh, 60), 2)));
//    $smarty->assign("total", ceil($obj_equipment->time_user_format($output['tot_Normal']+ $quarter+$one_seventh, 60)));
    $smarty->assign("total", round($obj_equipment->time_user_format(round($output['tot_Normal']+ $quarter+$one_seventh), 60)));


    if(!$is_fk_template){
        //Maximum 2 records
        $cust_contract_in_this_year_month = $customer->customer_contract_month($cid, $year.'|'.$month, $type, TRUE );
        $cust_contract_in_this_year_month = $cust_contract_in_this_year_month !== FALSE ? $cust_contract_in_this_year_month : array();
        // echo "<pre>".print_r($cust_contract_in_this_year_month, 1)."<pre>"; exit();
        $smarty->assign("cust_contract_in_this_year_month", $cust_contract_in_this_year_month);
    }
    // echo "<pre>".print_r($cust_contract, 1)."<pre>"; exit();
}

//$InCovStartDate = date("Y-m-d", strtotime($month.'/01/'.$year.' 00:00:00'));
//$InCovEndDate = date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.$year.' 00:00:00'))));

/* temporary disable to calculate $total_inconv_time_emp value & set default value 0.00*/
//	$total_inconv_time_emp = $dona->get_employee_distinct_inconvenient_details_between_2_dates_for_workReport($emp_string,$cid,$InCovStartDate, $InCovEndDate,$type);
//$total_inconv_time_emp = 0.00;
//$smarty->assign("total_inconv_time_emp", $total_inconv_time_emp);

/* temporary disable to calculate $total_emp_work_for_cust & set default value 0.00*/
/*
$total_emp_work_for_cust = 0.00;
$work_details = $dona->get_Customer_employee_report_data($emp_string, $cid, $month, $year, $type);
if(sizeof($work_details) > 0){
        foreach($work_details as $work_detail){
                $intpart = floor( $work_detail['time_from'] );    // results in 3
                $fraction = $work_detail['time_from'] - $intpart;
                $start_fraction = $fraction * 100 /60;
                $start_from = $start_fraction + $intpart;

                $intpart = floor( $work_detail['time_to']);    // results in 3
                $fraction = $work_detail['time_to'] - $intpart;
                $end_fraction = $fraction * 100 /60;
                $end_to = $end_fraction + $intpart;
                $total_time = $end_to - $start_from;
                $total_emp_work_for_cust += number_format(round($total_time,2),2);
        }
$smarty->assign("total_emp_work_for_cust", number_format(round($total_emp_work_for_cust,2),2));
}*/

if($is_fk_template)
    $smarty->display('extends:layouts/dashboard.tpl|pdf_customer_work_report_summery_editing.tpl');
else
    $smarty->display('extends:layouts/dashboard.tpl|pdf_customer_work_report_summery_editing_kn.tpl');

function firstOfMonth($month,$year) {
        return date("Y-m-d", strtotime($month.'/01/'.$year.' 00:00:00'));
}

function lastOfMonth($month,$year) {
        return date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.$year.' 00:00:00'))));
}
?>