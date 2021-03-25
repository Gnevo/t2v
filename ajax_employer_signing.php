<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
/**
 * Author: Shamsu
 * for: Signing as employer
 * Used In: FKKN report interface
*/
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/dona.php');
require_once('class/report_signing.php');
require_once('class/customer.php');
require_once('class/company.php');
require_once('class/general.php');

$smarty   = new smartySetup(array('messages.xml',"forms.xml", 'user.xml', 'button.xml','mail.xml'), FALSE);
$user     = new user();
$employee = new employee();
$dona     = new dona();
$obj_cus  = new customer();
$obj_rpt  = new report_signing();

global $bank_id;

$action        = trim($_POST['action']);
$month         = trim($_POST['month']);
$year          = trim($_POST['year']);
$fkkn          = trim($_POST['fkkn']);
$this_customer = trim($_POST['cid']);
$this_employee = trim($_POST['emp']);
$sign_employer = trim($_POST['sign_employer']);
$sign_sutl     = trim($_POST['sign_sutl']);

$all_employee_data = array();

$login_user_role= $user->user_role($_SESSION['user_id']);
$message = '';
$message_type = 'success';

$general_privileges = $user->get_privileges($_SESSION['user_id'], 2);
$report_signing_details = $obj_rpt->employer_signing_detail($year,$month,$this_customer,$this_employee,$fkkn);
// var_dump($report_signing_details);
// var_dump($year,$month,$this_customer,$this_employee);

$signed_employer = $report_signing_details['employer'];

$superAccess = FALSE;
if($_SESSION['user_role'] == 1){
    $superAccess = TRUE;
}
elseif($_SESSION['user_role'] != 4) {
    $login_emp_role_in_customer = $employee->get_team_role_of_employee($_SESSION['user_id'], $this_customer);
    $superAccess = (!empty($login_emp_role_in_customer) && ($login_emp_role_in_customer['role'] == 7 || $login_emp_role_in_customer['role'] == 2)) ? TRUE : FALSE;
}

switch ($action){
    case 'signing' :

            $employer_role=trim($_POST['employer_role']);
            if(($login_user_role != 1 && $general_privileges['employer_signing'] != 1) || ($general_privileges['employer_signing'] == 1 && !$superAccess)){  //check Permission
                $message = $smarty->translate['permission_denied'];
                $message_type = 'fail';
            }
            elseif($month != '' && $year != '' && $this_customer != '' && $fkkn != '' && $employer_role!= ''){
                $employee->signauture = $sign = filter_var(urldecode($_SESSION['url_back_back']), FILTER_VALIDATE_URL)?'':$_SESSION['url_back_back'];
                $employee->ocs = $ocs = $_SESSION['url_back_back_ocs'];
                $_SESSION['url_back_back'] = '';
                unset($_SESSION['url_back_back']);
                $_SESSION['url_back_back_ocs'] = '';
                unset($_SESSION['url_back_back_ocs']);

                if(($sign != '' && $sign != 1 && $sign != 2) || $_REQUEST['method'] == "normal"){
                    $dona->save_employer_role_defaults($this_customer, $employer_role);
                    $return_flag = $employee->employer_signing_transaction($this_customer, $month, $year, $fkkn, $employer_role, $this_employee);
                    if($return_flag === 'SELF_SIGN_VIOLATED'){
                        $message = $smarty->translate['employees_doesnt_sign_self'];
                        $message_type = 'fail';
                    }else if($return_flag){
                        $message = $smarty->translate['signing_done_sucessfully'];
                        $employer_signing_details = $employee->employer_signing_details($this_customer, $month, $year, $fkkn, '');
                        foreach ($employer_signing_details[0]['employee_data'] as $key => $value) {
                            $employer_signing_details[0]['employee_data'][$key]['signin_sutl'] = $obj_rpt->get_report_details($year,$month,$value['employee'],$this_customer)['signin_sutl'];
                        }
                        $permitted_employees_ids = array();
                        $all_employee_names = array();
                        $permitted_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);
                        if(!empty($permitted_employees)){
                            foreach($permitted_employees as $p_employee){
                                $permitted_employees_ids[] = $p_employee['username'];
                            }
                            $all_employee_names = $dona->get_all_Member_details_for_customer_with_no_trainee($this_customer,$fkkn,$month,$year, $permitted_employees_ids);
                            foreach ($all_employee_names as $key => $value) {
                                 $all_employee_data[$key]['employee_name'] = $_SESSION['company_sort_by'] == 1 ? $value['empName_ff'] : $value['empName'];
                                 $all_employee_data[$key]['employee'] = $value['empID'];
                                 $all_employee_data[$key]['sutl_sign'] = $obj_rpt->get_report_details($year,$month,$value['empID'],$this_customer)['signin_sutl'];
                                 $all_employee_data[$key]['employer_sign'] = $obj_rpt->employer_signing_detail($year, $month,$this_customer , $value['empID'] , $fkkn)['employer'];
                            }
                        }
                        // var_dump($_SESSION['company_sort_by']);
                        // var_dump($all_employee_names);
                        // echo json_encode($all_employee_data); 
                    }

                    else{
                        // echo '<script>alert("hi");</script>';
                        $message = $smarty->translate['error_occured_in_signing_try_again'];
                        $message_type = 'fail';
                    }
                //                    echo "<pre>query_error_details: ".print_r($employee->query_error_details, 1)."</pre>";
                }elseif($sign == 1){//user missmatch
                    $message = $smarty->translate['user_missmatch_at_bank_id'];
                    $message_type = 'fail';
                    
                }elseif($sign == 2){//bank id unsucess
                    $message = $smarty->translate['error_occured_in_signing_try_again'];
                    $message_type = 'fail';
                }
                
            }
            else{
                $message = $smarty->translate['required_missing'];
                $message_type = 'fail';
            }
            break;
    case 'remove' :
            if(($login_user_role != 1 && $general_privileges['employer_signing'] != 1) || ($general_privileges['employer_signing'] == 1 && !$superAccess)){  //check Permission
                $message = $smarty->translate['permission_denied'];
                $message_type = 'fail';
            }elseif($month != '' && $year != '' && $this_customer != '' && $fkkn != ''){
                $report_signing_details = $obj_rpt->employer_signing_detail($year,$month,$this_customer,$this_employee,$fkkn);
                $employer_user_id = $report_signing_details['employer'];
                $employer_email  = $employee->get_employee_detail($employer_user_id)['email'];
                $return_flag = $employee->employer_signing_remove_transaction($this_customer, $month, $year, $fkkn, $this_employee,$sign_employer,$sign_sutl);
                if($return_flag) {
                    $message = $smarty->translate['employer_signing_removed_successfully'];
                  
                } else{
                    $message = $smarty->translate['employer_signing_remove_failed'];
                    $message_type = 'fail';
                }
            }else{
                $message = $smarty->translate['required_missing'];
                $message_type = 'fail';
            }
            break;
    case 'check' :
            
        break;
}

$this_employee__ = $this_employee != '' ? $this_employee : NULL;
$form_defaults = $dona->check_exists_fkkn_form_defaults($this_customer, $this_employee__, TRUE);

$default_employer_role = $smarty->translate['executive_director'];
if(!empty($form_defaults) && isset($form_defaults[0]['employer_role']) && $form_defaults[0]['employer_role'] != '')
    $default_employer_role = $form_defaults[0]['employer_role'];

if($action == 'remove' && $_POST['remove_type'] == 'direct_box'){
    $employer_signing_details = $employee->employer_signing_details($this_customer, $month, $year, $fkkn, '');
    foreach ($employer_signing_details[0]['employee_data'] as $key => $value) {
        // $signin_sutl[$value['employee']] = $obj_rpt->get_report_details($year,$month,$value['employee'],$this_customer)['signin_sutl'];
        $employer_signing_details[0]['employee_data'][$key]['signin_sutl'] = $obj_rpt->get_report_details($year,$month,$value['employee'],$this_customer)['signin_sutl'];
    }
}
else{
    $employer_signing_details = $employee->employer_signing_details($this_customer, $month, $year, $fkkn, $this_employee);
    if(!empty($employer_signing_details[0]['employee_data'])){
        foreach ($employer_signing_details[0]['employee_data'] as $key => $value) {
            // $signin_sutl[$value['employee']] = $obj_rpt->get_report_details($year,$month,$value['employee'],$this_customer)['signin_sutl'];
            $employer_signing_details[0]['employee_data'][$key]['signin_sutl'] = $obj_rpt->get_report_details($year,$month,$value['employee'],$this_customer)['signin_sutl'];
        }
    }
}

$permitted_employees_ids = array();
$all_employee_names = array();
$permitted_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);
if(!empty($permitted_employees)){
    foreach($permitted_employees as $p_employee){
        $permitted_employees_ids[] = $p_employee['username'];
    }
    $all_employee_names = $dona->get_all_Member_details_for_customer_with_no_trainee($this_customer,$fkkn,$month,$year, $permitted_employees_ids);
    // foreach ($all_employee_names as $key => $value) {
    //      $all_employee_data[$key]['employee'] = $value['empID'];
    //      $all_employee_data[$key]['sutl_sign'] = $obj_rpt->get_report_details($year,$month,$value['empID'],$customer_id)['signin_sutl'];
    //      $all_employee_data[$key]['employer_sign'] = $obj_rpt->employer_signing_detail($year, $month,$customer_id , $value['empID'] , $fkkn)['employer'];
    // }
}
$exist_flag = TRUE;
if ($this_employee == '' || ($action == 'remove' && $_POST['remove_type'] == 'direct_box')){
    $signing_employees = array();
    if(!empty($employer_signing_details[0]['employee_data'])){
        foreach ($employer_signing_details[0]['employee_data'] as $sign_data) {
            $signing_employees[] = $sign_data['employee'];
        }
    }
    if(!empty($all_employee_names)){
        foreach ($all_employee_names as $employee_s) {
            if(!in_array($employee_s['empID'], $signing_employees)){
                $exist_flag = FALSE;
                break;
            }
        }
    }
}else{
    if(empty($employer_signing_details[0]['employee_data'])){
        $exist_flag = FALSE;
    }
}

$delete_button_label = '';
if(($action == 'remove' && $_POST['remove_type'] == 'direct_box') || $this_employee == ''){
    $delete_button_label = $smarty->translate['delete_all_employer_signings'];
    $value = 'all';
}
else{
    $delete_button_label = $smarty->translate['delete_employer_signin'];
    $value = '';
}

echo '<div class="Anställd_postions clearfix">';
if($exist_flag){
    echo '<a href="javascript:void(0)" class="signin_delet" id="login" name="login" data_value = "'.$value.'" >'.$delete_button_label.'</a>';
    echo '<input type="hidden" name="employer" id="employer" value="'. $signed_employer .'"';
}else if (!empty($employer_signing_details[0]['employee_data']) && ($this_employee == '' || ($action == 'remove' && $_POST['remove_type'] == 'direct_box'))){
    echo '<label class="employer_role_label">'.$smarty->translate['fkkn_employer_role'].'</label>';
    echo '<input type="text" name="employer_role" class="employer_role" value="'.$default_employer_role.'"/>';
    echo '<a href="javascript:void(0)" class="signin" data_mtd="normal">'.$smarty->translate['signin'].'</a>';
    echo '<a style="margin-left: 8px; float: left; height:22px;" data_mtd="bank_id" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in"></a>';
    echo '<a href="javascript:void(0)" class="signin_delet" id="login" name="login" data_value = "'.$value.'" >'.$delete_button_label.'</a>';
    echo '<input type="hidden" name="employer" id="employer" value="'. $signed_employer .'"';
}else{
    echo '<label class="employer_role_label">'.$smarty->translate['fkkn_employer_role'].'</label>';
    echo '<input type="text" name="employer_role" class="employer_role" value="'.$default_employer_role.'"/>';
    echo '<a href="javascript:void(0)" class="signin" data_mtd="normal">'.$smarty->translate['signin'].'</a>';
    echo '<a style="margin-left: 8px; float: left; height:22px;" data_mtd="bank_id" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in"></a>';
}

if($message != '')
    echo '<span style="margin: 3px 0 0 8px;float:left; font-size:12px; color: '.($message_type == 'success' ? 'green' : 'red').'">'.$message.'</span>';

echo '</div>';

echo '||||';

//if($login_user_role == 1 && !empty($all_employee_names)){
if(($login_user_role == 1 || ($general_privileges['employer_signing'] == 1 && $superAccess)) && !empty($employer_signing_details[0]['employee_data'])){
    if((($action == 'signing' || $action == 'check') && $this_employee == '') || ($action == 'remove' && $_POST['remove_type'] == 'direct_box')){
        echo '<div class="sign_personlist_caption">'.$smarty->translate['employer_signed_employees'].'&nbsp;</div>';
        foreach($employer_signing_details[0]['employee_data'] as $entry){
            echo '<div class="sign_box '.($entry['employer_sign'] != '' ? 'bankID' : '').'">'.($entry['employer_sign'] != '' ? '<img src="'.$smarty->url.'images/bank-id-logo.jpg" style="height: 13px;">&nbsp;&nbsp;' : '').$entry['employee_name'] . /*($entry['employee_sign'] == '' ? '<span style="font-weight: bolder; color: red"> X</span>' : '').*/'<a data-attrib-emp="'.$entry['employee'].'" data_employer="'.$entry['employer'].'" data_sutl = "'.$entry['signin_sutl'].'"></a></div>';
        }
    }
}
echo '||||';
$not_sign_emp   = $dona->get_employee_not_signing($this_customer,$month, $year,$fkkn);
// echo "<pre>".print_r(array($this_customer,$month, $year,$fkkn), 1)."</pre>";
// echo "<pre>".print_r($not_sign_emp, 1)."</pre>";
if(!empty($not_sign_emp)){
    // echo "<pre>".print_r($not_sign_emp, 1)."<pre>";
    //remove all other emp details if a specific employee selected
    if ($this_employee != ''){
        foreach ($not_sign_emp as $key => $not_sign_emp_entry){
            if($not_sign_emp_entry['employee'] != $this_employee) 
                unset($not_sign_emp[$key]);
        }
        $not_sign_emp = array_values($not_sign_emp);
    }
    //$not_sign_emp = array_values($not_sign_emp);
    if(!empty($not_sign_emp)){
         echo '<div class="not_signed_emp span12 no-ml no-min-height" name="not_signed_emp" id="not_signed_emp"><b>'.$smarty->translate['not_signed_report'].'</b>&nbsp;';
                
            
        foreach ($not_sign_emp as $key => $not_sign_emp_entry){
             echo '<span class="label label-default">'.$not_sign_emp_entry['emp'].'</span>&nbsp;';
        }
        echo '</div>';
    }
    
}

echo '||||';
$signed_emps   = $dona->get_employees_signed($this_customer,$month, $year,$fkkn);
// echo "<pre>".print_r($signed_emps, 1)."</pre>";
if(!empty($signed_emps)){

    //remove all other emp details if a specific employee selected
    if ($this_employee != ''){
        foreach ($signed_emps as $key => $signed_emp_entry){
            if($signed_emp_entry['employee'] != $this_employee) 
                unset($signed_emps[$key]);
        }
        $signed_emps = array_values($signed_emps);
    }
    if(!empty($signed_emps)){
        //$not_sign_emp = array_values($not_sign_emp);
         echo '<div class="signed_emp span12 no-ml no-min-height" name="signed_emp" id="signed_emp"><b>'.$smarty->translate['signed_report'].'</b>&nbsp;';
                
            
        foreach ($signed_emps as $key => $signed_emp_entry){
             echo '<span class="label label-default">'.($signed_emp_entry['employee_sign'] != '' ? '<img src="'.$smarty->url.'images/bank-id-logo.jpg" style="height: 13px;">&nbsp;&nbsp;' : '').$signed_emp_entry['emp'].'</span>&nbsp;';
        }
        echo '</div>';
    }
    
}

echo '||||';

foreach ($all_employee_data as $key => $value) {
    if($key == 0) echo '<option value>'.$smarty->translate['all_assistents'].'</option>';
    echo '<option value="'.$value['employee'].'" data-employer-sign ="'.$value['employer_sign'].'" data-sutl-sign ="'.$value['sutl_sign'].'">'.$value['employee_name'].'</option>';
}

echo '||||';

if($login_user_role == 1 or ($general_privileges['employer_signing'] == 1 && $superAccess == TRUE)){
    $obj_company  = new company();
    $obj_general    = new general();
    $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
    if(!empty($company_data) && trim($company_data['org_no']) != ''){
        $company_data['org_no'] = $obj_general->format_orgno($company_data['org_no']);
        $company_data['cp_name'] = trim($company_data['contact_person1']) != '' ? trim($company_data['contact_person1']) : trim($company_data['contact_person2']);
        $company_data['contact_number'] = trim($company_data['mobile']) != '' ? trim($company_data['mobile']) : trim($company_data['phone']);
        if(trim($company_data['phone']) != ''){
            $company_data['contact_number'] = $obj_general->format_mobile($company_data['phone']);
        }
    }

    echo '<div style="padding-bottom:10px; margin-top:4px;"  class="bargaining_group">
            <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">3. Omfattas assistenten av kollektivavtal?</div>
            <div style="border:solid 1px #b8b7b7; margin:0px 7px; padding-bottom:10px;">
                <table style="margin:0px 7px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr><td height="30">Omfattas assistenten av kollektivavtal?</td></tr>
                    <tr>
                        <td width="11%" height="30">
                            <span style="margin-right:10px;" class="pull-left">
                                <label>
                                    <input type="radio" '.((!empty($form_defaults) && $form_defaults[0]['bargaining_new'] == 1) || empty($form_defaults) ? 'checked="checked"' : '').' value="1" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Ja
                                </label>
                            </span>
                            <span style="margin-right:10px;" class="pull-left">
                                <label>
                                    <input type="radio" '.(!empty($form_defaults) && $form_defaults[0]['bargaining_new'] == 2 ? 'checked="checked"' : '').' value="2" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Nej
                                </label>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="agreements_group clearfix" style="background-color:#f6f9f9; margin:6px 0;">
            <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">5. Anordnaren av personlig assistans </div>
            <div style="border: 1px solid rgb(184, 183, 183); margin: 0px 7px;">
                <div class="box-form" style="margin: 9px 7px;">
                    <div class="row-fluid">
                        <div class="span12">
                            <label style="margin-left: 5px;" class="pull-left no-ml">
                                <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="1" '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'checked="checked"' : '').'/>&nbsp;
                                Jag har själv anställt assistenten (Fyll inte i något mer under den här punkten)
                            </label>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <label style="margin-left: 5px;" class="pull-left no-ml">
                                <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="2" '.((!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 2) || empty($form_defaults) ? 'checked="checked"' : '').'/>&nbsp;
                                Personen anlitar en assistans-anordnare
                            </label>
                        </div>
                        <div class="span8">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div style="" class="span12">
                                        <label style="float: left;" class="span12 no-min-height">Namn på anordnaren</label>
                                        <div class="span12 fixed-font" style="margin: 0px;"><strong>'.$company_data['name'].'</strong></div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div style="" class="span12">
                                        <label style="float: left;" class="span12 no-min-height">Organisationsnummer</label>
                                        <div style="margin: 0px;" class="span12 fixed-font"><strong>'.$company_data['org_no'].'</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span8">
                                    <div style="margin: 0px 0px 10px;" class="span12">
                                        <label style="float: left;" class="span12 no-min-height" for="company_cp_name">Kontaktperson</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                            <input type="text" class="form-control span10" name="company_cp_name" id="company_cp_name" value="'.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 2 && $form_defaults[0]['company_cp_name'] != '' ? $form_defaults[0]['company_cp_name'] : $company_data['cp_name']).'" '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'> </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div style="margin: 0px 0px 10px;" class="span12">
                                        <label style="float: left;" class="span12 no-min-height" for="company_cp_phone">Telefon, även riktnummer</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                            <input type="text" class="form-control span10" name="company_cp_phone" id="company_cp_phone" value="'.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 2 && $form_defaults[0]['company_cp_phone'] != '' ? $form_defaults[0]['company_cp_phone'] : $company_data['contact_number'] ).'" '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <label style="float: left;" class="span12 no-min-height">Är anordnaren arbetsgivare för assistenten?</label>
                                    <label style="margin-left: 5px;" class="no-ml"><input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="1" '.((!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 1) || empty($form_defaults) ? 'checked="checked"' : "").' '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'>&nbsp;Ja </label>
                                </div>
                            </div>
                            <div style="margin: 12px 0px;" class="row-fluid">
                                <div class="span4">
                                    <label class="no-ml" style="margin-left: 5px;">
                                        <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="2" '.(!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 2 ? 'checked="checked"' : "").' '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'>&nbsp;
                                        Nej, anordnaren är
                                            uppdragsgivare åt
                                            assistenten som har
                                            en annan arbetsgivare</label>
                                </div>
                                <div class="span4">
                                    <div style="" class="span12">
                                        <label style="float: left;" class="span12 no-min-height" for="name_of_another_employer">Namn på arbetsgivaren</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                            <input type="text" value="'.(!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 2 && $form_defaults[0]['agreement_type2_company'] != '' ? $form_defaults[0]['agreement_type2_company'] : "").'" name="agreement_type2_company" data-company="'.(!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 2 && $form_defaults[0]['agreement_type2_company'] != '' ? $form_defaults[0]['agreement_type2_company'] : $company_data['name'] ).'" class="form-control span10 agreement_type2_company" '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'/></div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div style="" class="span12">
                                        <label style="float: left;" class="span12 no-min-height" for="another_employer_org_no">Organisationsnummer</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                            <input type="text" value="'.(!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 2 && $form_defaults[0]['agreement_type2_orgNo'] != '' ? $form_defaults[0]['agreement_type2_orgNo'] : "").'" name="agreement_type2_orgno" data-org-no="'.(!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 2 && $form_defaults[0]['agreement_type2_company'] != '' ? $form_defaults[0].agreement_type2_orgNo : $company_data['org_no']).'" class="form-control span10 agreement_type2_orgno" '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'/></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <label class="no-ml" style="margin-left: 5px;">
                                        <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="3" '.(!empty($form_defaults) && $form_defaults[0]['agreement_types_new'] == 3 ? 'checked="checked"' : "").' '.(!empty($form_defaults) && $form_defaults[0]['provider_of_pa_flag'] == 1 ? 'disabled="disabled"' : "").'>&nbsp;
                                        Nej, anordnaren är uppdragsgivare åt assistenten som är egenföretagare.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}


function sendPostData($url, $post){
  global $bank_id;
  $headers= array('Accept: application/json',
      'Content-Type: application/json',
      'Connection: keep-alive',
      'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36'
      ); 
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_USERPWD, $bank_id['userpaswd']);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$post);    
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  $response = curl_exec($ch);
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($response, 0, $header_size);
  $headers = get_headers_from_curl_response($header);
  curl_close($ch);
  return $headers;
}



function get_headers_from_curl_response($headerContent){
    $headers = array();
    $arrRequests = explode("\r\n\r\n", $headerContent);

  
    for ($index = 0; $index < count($arrRequests) -1; $index++) {

        foreach (explode("\r\n", $arrRequests[$index]) as $i => $line)
        {
            if ($i === 0)
                $headers[$index]['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                $headers[$index][$key] = $value;
            }
        }
    }

    return $headers;
}
?>