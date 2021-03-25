<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
//if (class_exists('employee'))
require_once('class/employee.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
require_once('class/mail.php');
require_once('class/equipment.php');
require_once('class/dona.php');
require_once('class/customer.php');
require_once('class/team.php');
require_once('class/company.php');
require_once('class/timetable.php');
require_once('class/general.php');
require_once('configs/config.inc.php');
require_once('class/employee_ext.php');

$smarty        = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", 'company.xml','mail.xml'));
$employee      = new employee();
$user          = new user();
$team          = new team();
$messages      = new message();
$equipment     = new equipment();
$customer      = new customer();
$dona          = new dona();
$obj_company   = new company();
$obj_timetable = new timetable();
$obj_general   = new general();
$obj_emp       = new employee_ext();

$msg                    = '';
$subject                = '';
$employee_detail        = array();
$logged_employee_detail = array();

$all_employee_checklist = $obj_emp->get_all_employee_checklist();
$smarty->assign('all_employee_checklist',$all_employee_checklist);

$user_roles_login = $user->user_role($_SESSION['user_id']);
$smarty->assign('user_roles_login', $user_roles_login);

$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$today = date("Y-m-d");
$smarty->assign('today', $today);
global $company, $languages, $role, $month;
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2, 'tabmenu'=>'employee_add'));
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('employee_username', $query_string[0]);
$smarty->assign('selected_employee_role',$user->user_role($query_string[0]));
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$this_company_details = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_detail', $this_company_details);

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
$smarty->assign('privileges_generals', $privilege_general);
// echo "<pre>".print_r($privilege_general, 1)."<pre>"; exit();

if(($query_string[0] != '' && !($privilege_general['edit_employee'] == 1 || $_SESSION['user_id'] == $query_string[0])) ||
    ($query_string[0] == '' && $privilege_general['add_employee'] != 1)){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}


$transaction_flag = TRUE;

if(!empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'print' && $_POST['print_user'] != ''){
    //echo "<pre>".print_r($_POST, 1)."</pre>";
    
    $selected_user = trim($_POST['print_user']);
    $dona->pdf_employee_details_full($selected_user);
    exit();
}

/*if (isset($_POST['emp_username_team'])) {
    if ($_POST['action_change'] == "2") {
        $team->employee_assign_teamleader_team($_POST['emp_username_team'], $_POST['cust_username_team']);
    } else if ($_POST['action_change'] == "1") {
        $change_supertl = $employee->change_superTL_team($_POST['cust_username_team']);
        $change_supertl_new = $employee->change_superTL_team_new($_POST['emp_username_team'], $_POST['cust_username_team']);
    } '';
}*/


//echo "<pre>".print_r($employee_detail,1)."</pre>";
//exit();
if (!empty($_POST['first_name'])) {
    $_POST['send_mail'] = 1;
      //echo "<pre>".print_r($_POST, 1)."</pre>";
    $mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($_POST['mobile']));
    while (substr($mobile, 0, 3) == '+46' && strlen($mobile) > 1) {
        $mobile = substr($mobile, 3, 9999);
    }
     //echo "<pre>".print_r($mobile, 1)."</pre>";
    //exit();
    $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($_POST['phone']));
    while (substr($phone, 0, 1) == '0' && strlen($phone) > 1) {
        $phone = substr($phone, 1, 9999);
    }

    $employee->first_name = strip_tags(trim(urldecode($_POST['first_name'])));
    $employee->last_name = strip_tags(trim(urldecode($_POST['last_name'])));
    $employee->gender = strip_tags($_POST['gender']);
    $employee->password = strip_tags($_POST['password']);
    $employee->username = $_POST['username'];
    $username_new = $_POST['username'];
    $employee->century = $_POST['century'];
    $employee->role = $_POST['role'];
    $employee->substitute = $_POST['substitute'];
    $employee->code = strip_tags($_POST['code']);
    $employee->social_security = str_replace("-", "", strip_tags($_POST['social_security']));
    $employee->address = strip_tags($_POST['address']);
    $employee->care_of = strip_tags($_POST['care_of']);
    $employee->city = strip_tags($_POST['city']);
    $employee->post = strip_tags($_POST['post']);
    $employee->phone = $phone;
    $employee->mobile = $mobile;
    $employee->email = strip_tags($_POST['email']);
    //Added by viteb
    $employee->max_hours = strip_tags($_POST['max_hours']);
    // end viteb
    $employee->date = $_POST['date'];
    $employee->color_code = $_POST['color_code'];
    $employee->status = $_POST['status'];
    $employee->company_id = $_SESSION['company_id'];
    $employee->global_check = strip_tags($_POST['global_check']);
    $employee->inactive_date = strip_tags($_POST['date_inactive']);
    $employee->ice = trim(strip_tags($_POST['txt_ice'])) != '' ? trim(strip_tags($_POST['txt_ice'])) : NULL;
    $start_time = strip_tags($_POST['start_time']);
    if ($start_time == "" || $start_time == null) {
        $start_time = 0.00;
    }
    $employee->start_day = strip_tags($_POST['start_day']) . $dona->time_to_sixty($start_time);
    if ($employee->inactive_date == "" || $employee->inactive_date == null) {
        $employee->inactive_date = null;
    }
    $employee->remaining_sem_leave = strip_tags($_POST['remaining_sem_leave']);
    $employee->sem_leave_todate = strip_tags($_POST['sem_leave_todate']);
    $employee->leave_in_advance = strip_tags($_POST['leave_in_advance']);
    $employee->office_personal = strip_tags($_POST['office_personal']);
    $employee->salary_type = strip_tags($_POST['salary_type']);
    $employee->sem_leave_days = strip_tags($_POST['sem_leave_days']);
    $employee->vab_leave_days = strip_tags($_POST['vab_leave_days']);
    $employee->fp_leave_days = strip_tags($_POST['fp_leave_days']);
    $employee->nopay_leave_days = strip_tags($_POST['nopay_leave_days']);
    $employee->other_leave_days = strip_tags($_POST['other_leave_days']);
    $employee->candg_follow = strip_tags($_POST['candg_follow']);

    

       // echo "<pre>".print_r($_POST, 1)."</pre>";exit();
    if(isset($_POST['chk_inconvenient_on']) && trim($_POST['chk_inconvenient_on']) == 1)
        $employee->use_inconvenient = 1;
    else if((!isset($_POST['chk_inconvenient_on']) || trim($_POST['chk_inconvenient_on']) == 0)/* && $this_company_details['inconvenient_on'] == 0*/)
        $employee->use_inconvenient = 0;
    
    $employee->begin_transaction();

    $employee->on_call = $_POST['on_call'];
    $employee->oncall_holiday = $_POST['oncall_holiday'];
    $employee->oncall_bigholiday = $_POST['oncall_bigholiday'];
    $employee->inconvinient_evening = $_POST['inconvinient_evening'];
    $employee->inconvinient_night = $_POST['inconvinient_night'];
    $employee->inconvinient_holiday = $_POST['inconvinient_holiday'];
    $employee->inconvinient_week_holiday = $_POST['inconvinient_week_holiday'];

    $employee->salary_per_hour = $_POST['salary_per_hour'];
    $employee->salary_per_month = $_POST['salary_per_month'];
    if ($_POST['monthly_salary'] == NULL || $_POST['monthly_salary'] == "")
        $employee->monthly_salary = 0;
    else 
        $employee->monthly_salary = $_POST['monthly_salary'];

    $employee->employee_contract_start_month        = $_POST['contract_start_month'] != "" ? $_POST['contract_start_month'] : NULL;
    $employee->employee_contract_month_start_date   = ($_POST['contract_month_start_date'] != "" &&  $_POST['contract_start_month'] != "") ? $_POST['contract_month_start_date'] : NULL;
    $employee->employee_contract_period_length      = ($_POST['emp_contract_period_length'] != "" && $_POST['contract_start_month'] != "") ? $_POST['emp_contract_period_length'] : NULL;
      
    if (empty($_POST['user_id'])) {
        if(preg_match('/\d/',strip_tags($_POST['code'])) == 1){
            $unique_emp_code = $obj_emp->check_unique_employee_code(strip_tags($_POST['code']));
            if($unique_emp_code === TRUE){
                if ($employee->login_add(TRUE)) {

                    if ($employee->employee_add()) {

                        if ($employee->company_update()) {
                            $employee->commit_transaction();
                            if ($_POST['role'] == 2) {
                                $equipment->employee_privilege_forms_al($_POST['username']);
                                $equipment->employee_privilege_general_al($_POST['username']);
                                $equipment->employee_privilege_mc_al($_POST['username']);
                                $equipment->employee_privilege_reports_al($_POST['username']);
                                $equipment->employee_privilege_schedule_al($_POST['username']);
                            }
                            if ($_POST['role'] == 7) {
                                $equipment->employee_privilege_forms_gl($_POST['username']);
                                $equipment->employee_privilege_general_gl($_POST['username']);
                                $equipment->employee_privilege_mc_gl($_POST['username']);
                                $equipment->employee_privilege_reports_gl($_POST['username']);
                                $equipment->employee_privilege_schedule_gl($_POST['username']);
                            }
                            //$employee->commit_transaction();
                            $message = 'employee_adding_success';
                            $type = "success";
                            $messages->set_message($type, $message);
                            
                            //if ($_POST['send_mail'] == 1 && $employee->password != "") {



                                // $compony_detail = $customer->get_company_detail($_SESSION['company_id']);

                                // $company_home = $compony_detail['website'];
                                // $cirrus_link = $company['website'];
                                // $contact_person = $compony_detail['contact_person1'];
                                // $logo = $compony_detail['logo'];
                                // $company_name = $compony_detail['name'];
                                $subject = $smarty->translate[employee_add];
                                /*$msg = $smarty->translate[name] . ' : ' . trim($employee->first_name) . ' ' . trim($employee->last_name) . '<br>' . $smarty->translate[address] . ' : ' . $employee->address . '<br>' . $smarty->translate[email] . ' : ' . $employee->email . '<br>' . $smarty->translate[phone] . ' : ' . $employee->phone . '<br>' . $smarty->translate[mobile] . ' : ' . $customer->mobile . '<br>' . $smarty->translate[username] . ' : ' . $employee->username;
                                if ($employee->password != "") {
                                    $msg .= '<br>' . $smarty->translate[password] . ' : ' . $employee->password;
                                }*/

                                $msg = $employee->century.$employee->social_security ? $smarty->translate['social_security']. ' : ' .'xxxxxx-xxxx<br>' : '';
                                if($_SESSION['company_sort_by'] == 1){
                                    $msg .= trim($employee->first_name) . ' ' . trim($employee->last_name) ? $smarty->translate['name'] . ' : ' . trim($employee->first_name) . ' ' . trim($employee->last_name). '<br>' : '';
                                }else{
                                    $msg .= trim($employee->first_name) . ' ' . trim($employee->last_name) ? $smarty->translate['name'] . ' : ' . trim($employee->last_name) . ' ' . trim($employee->first_name). '<br>' : '';
                                }
                                // $msg .= $employee->gender ? $smarty->translate['gender']. ' : ' .($employee->gender?$smarty->translate['male']:$smarty->translate['female']).'<br>' : '';
                                $msg .= $employee->code ? $smarty->translate['code']. ' : ' .$employee->code. '<br>' : '';
                                $msg .= $employee->address ? $smarty->translate['address']. ' : ' .$employee->address. '<br>' : '';
                                $msg .= $employee->care_of ? $smarty->translate['care_off']. ' : ' .$employee->care_of. '<br>' : '';
                                $msg .= $employee->post ? $smarty->translate['post']. ' : ' .$employee->post. '<br>' : '';
                                $msg .= $employee->city ? $smarty->translate['city']. ' : ' .$employee->city. '<br>' : '';
                                $msg .= $employee->phone ? $smarty->translate['phone']. ' : ' .$_POST['phone']. '<br>' : '';
                                $msg .= $employee->mobile ? $smarty->translate['mobile']. ' : ' .$_POST['mobile']. '<br>' : '';
                                $msg .= $employee->email ? $smarty->translate['email']. ' : ' .$employee->email. '<br>' : '';
                                $msg .= $employee->date ? $smarty->translate['date']. ' : ' .$employee->date. '<br>' : '';
                                $msg .= $employee->inactive_date ? $smarty->translate['date_inactive']. ' : ' .$employee->inactive_date. '<br>' : '';
                                // $msg .= $employee->start_day ? $smarty->translate['start_day']. ' : ' .JDDayOfWeek(substr($employee->start_day,0,1),2).substr($employee->start_day,1). '<br>' : '';
                                $msg .= $employee->username ? $smarty->translate['username']. ' : ' .$employee->username.'<br>' : '';
                                $msg .= $employee->password ? $smarty->translate['password']. ' : ' .$employee->password.'<br>' : '';
                                $msg .= $employee->status ? $smarty->translate['status']. ' : ' .($employee->status?$smarty->translate['active']:$smarty->translate['inactive']).'<br>' : '';

                                $msg .= $employee->role ? $smarty->translate['role']. ' : ' .$smarty->translate[$role[$employee->role]].'<br>' : '';
                                $msg .= $employee->substitute ? $smarty->translate['substitute']. ' : ' .($employee->substitute?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                // $msg .= $employee->use_inconvenient ? $smarty->translate['use_inconvenient']. ' : ' .($employee->use_inconvenient?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                $msg .= $employee->max_hours ? $smarty->translate['employee_max_hours']. ' : ' .$employee->max_hours. '<br>' : '';
                                $msg .= $employee->remaining_sem_leave ? $smarty->translate['remaining_sem_leave']. ' : ' .$employee->remaining_sem_leave. '<br>' : '';
                                $msg .= $employee->sem_leave_todate ? $smarty->translate['sem_leave_todate']. ' : ' .$employee->sem_leave_todate. '<br>' : '';
                                $msg .= $employee->leave_in_advance ? $smarty->translate['leave_in_advance']. ' : ' .($employee->leave_in_advance?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                $msg .= $employee->ice ? $smarty->translate['ice']. ' : ' .$employee->ice. '<br>' : '';
                                $msg .= $employee->employee_contract_start_month || $employee->employee_contract_month_start_date ? $smarty->translate['employee_contract_start_month']. ' : ' .$smarty->translate[$month[$employee->employee_contract_start_month-1]['month']]. ' '.$employee->employee_contract_month_start_date. '<br>' : '';
                                $msg .= $employee->employee_contract_period_length ? $smarty->translate['employee_contract_period_length']. ' : ' .$employee->employee_contract_period_length.'<br>' : '';                        
                                $msg .= $employee->color_code ? $smarty->translate['color_code']. ' : ' . '<div style="width:30px;height:10px;display: inline-block;background-color:'.$employee->color_code. ';"></div><br>' : '';
                                $msg .= $employee->sem_leave_days ? $smarty->translate['SEM_in_days']. ' : ' .($employee->sem_leave_days?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                $msg .= $employee->vab_leave_days ? $smarty->translate['VAB_in_days']. ' : ' .($employee->vab_leave_days?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                $msg .= $employee->fp_leave_days ? $smarty->translate['FP_in_days']. ' : ' .($employee->fp_leave_days?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                $msg .= $employee->nopay_leave_days ? $smarty->translate['NOPAY_in_days']. ' : ' .($employee->nopay_leave_days?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';
                                $msg .= $employee->other_leave_days ? $smarty->translate['OTHER_in_days']. ' : ' .($employee->other_leave_days?$smarty->translate['yes']:$smarty->translate['no']). '<br>' : '';

                                $temp_salary_type = array("1" => $smarty->translate['employee_salary_hour_saving_holiday'], "2" => $smarty->translate['employee_salary_hour_paid_vacation'], "3" => $smarty->translate['employee_salary_monthly'], "4" => $smarty->translate['employee_salary_monthly_office'], "5" => $smarty->translate['employee_salary_hour_office']);

                                // $msg .= $employee->salary_type ? $smarty->translate['employee_salary_type']. ' : ' .$temp_salary_type[$employee->salary_type]. '<br>' : '';


                        } else {
                            $transaction_flag = FALSE;
                            $employee->rollback_transaction();
                            $message = 'employee_adding_failed';
                            $type = "fail";
                            $messages->set_message($type, $message);
                        }
                    } else {
                        $transaction_flag = FALSE;
                        $employee->rollback_transaction();
                        $message = 'employee_adding_failed';
                        $type = "fail";
                        $messages->set_message($type, $message);
                    }
                } else {
                    $transaction_flag = FALSE;
                    $employee->rollback_transaction();
                    $message = 'employee_adding_failed';
                    $type = "fail";
                    $messages->set_message($type, $message);
                }
            }
            else{
                $message = 'employee_code_must_be_unique';
                $type = "fail";
                $messages->set_message($type, $message);
            }
        }
        else{
            $message = 'employee_code_must_contain_atlest_one_number';
            $type = "fail";
            $messages->set_message($type, $message);
        }
        /*$employee_detail = $employee->employee_detail_main($username_new);
        $color = $employee_detail[0]['color'];
        $social_security = $employee_detail[0]['social_security'];
        $smarty->assign('social_security_check', $user->social_security_check($social_security));
        $smarty->assign('color_code', $color);
        $smarty->assign("dates", $employee_detail[0]['date']);
        //    echo $social_security;
                $employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
        //    echo "4   ".substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
        //    $employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
                if ($employee_detail[0]['mobile'] != "") {
            $length_mobile_display = (strlen($employee_detail[0]['mobile']) - 5) / 2;
            //$employee_detail[0]['mobile'] = "0".substr($employee_detail[0]['mobile'], 0,2) . "-" . substr($employee_detail[0]['mobile'], 2,3)." ".substr($employee_detail[0]['mobile'], 5,2)." ".substr($employee_detail[0]['mobile'], 7,2)." ".substr($employee_detail[0]['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for ($i = 0; $i < $length_mobile_display; $i++) {
                $temp_mobile = $temp_mobile . " " . substr($employee_detail[0]['mobile'], $pos, 2);
                $pos = $pos + 2;
            }
            $employee_detail[0]['mobile'] = "+46" . substr($employee_detail[0]['mobile'], 0, 3) . " " . substr($employee_detail[0]['mobile'], 3, 2) . " " . $temp_mobile;
        }
        if ($employee_detail[0]['phone'] != "") {
            $employee_detail[0]['phone'] = "0" . substr($employee_detail[0]['phone'], 0, 2) . "-" . substr($employee_detail[0]['phone'], 2);
        }
        $smarty->assign('employee_detail', $employee_detail);
        $val[0] = substr($employee_detail[0]['start_day'], 0, 1);
        $val[1] = substr($employee_detail[0]['start_day'], 1, 5);
        $smarty->assign('vals', $val);
        $employee_role = $user->user_role($username_new);
        $smarty->assign('employee_role', $employee_role);
        $employee->role = $employee_role;
        $current_team = $employee->get_current_team();
        if(!empty($current_team)) $current_team[0]['tl'] = $employee->get_employee_name("'" . $current_team[0]['tl'] . "'");
        $smarty->assign('current_team', $current_team);
        //get team leader name
        $available_team = $employee->get_available_team((!empty($current_team) ? $current_team[0]['id'] : ''));
        for ($i = 0; $i < count($available_team); $i++) {
            $available_team[$i]['tl'] = $employee->get_employee_name("'" . $available_team[$i]['tl'] . "'");
        }
        $smarty->assign('available_team', $available_team);*/
    } 
    else {

        $employee_detail = $employee->employee_detail_main($query_string[0]);
        $employee_role = $user->user_role($query_string[0]);
        //delete slots after of inactivation date if employee will set as inactive
        if(trim($employee->status) == 0 && trim($employee->inactive_date) != ''){
            //            echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
            //check any slots after this inactivation date as signed...?
            $signed_slots_after_inactive_date = $obj_timetable->get_signed_slots_after_date($employee->inactive_date, NULL, $employee->username, 5);
            if(!empty($signed_slots_after_inactive_date)){
                $transaction_flag = FALSE;
                $employee->rollback_transaction();
                $messages->set_message('fail', 'found_signed_slots_after_inactivation_date_cant_edit');
                $transaction_flag = FALSE;
            }
        }

        //        echo "<pre>".print_r($_POST, 1)."</pre>";
        //        echo "<pre>".print_r($employee->username, 1)."</pre>"; exit();
        if($transaction_flag){
            if(preg_match('/\d/',strip_tags($_POST['code'])) == 1){
                $unique_emp_code = $obj_emp->check_unique_employee_code(strip_tags($_POST['code']), $_POST['username']);
                if($unique_emp_code === TRUE){
                    if ($employee->login_update(TRUE)) {

                        // if ($employee->role != $_POST['cur_role']){
                        //     $change = $employee->change_role_employee($employee->username);
                            
                        // }
                        if ($_POST['role_val'] != $_POST['role']) {
                            if ($_POST['role'] == 2) {

                                $equipment->employee_privilege_forms_al($_POST['username']);
                                $equipment->employee_privilege_general_al($_POST['username']);
                                $equipment->employee_privilege_mc_al($_POST['username']);
                                $equipment->employee_privilege_reports_al($_POST['username']);
                                $equipment->employee_privilege_schedule_al($_POST['username']);
                            }
                            if ($_POST['role'] == 7) {
                                $equipment->employee_privilege_forms_gl($_POST['username']);
                                $equipment->employee_privilege_general_gl($_POST['username']);
                                $equipment->employee_privilege_mc_gl($_POST['username']);
                                $equipment->employee_privilege_reports_gl($_POST['username']);
                                $equipment->employee_privilege_schedule_gl($_POST['username']);
                            }
                            if ($_POST['role'] == 3) {
                                $equipment->employee_privilege_forms_delete($_POST['username']);
                                $equipment->employee_privilege_general_delete($_POST['username']);
                                $equipment->employee_privilege_mc_delete($_POST['username']);
                                $equipment->employee_privilege_reports_delete($_POST['username']);
                                $equipment->employee_privilege_schedule_delete($_POST['username']);
                            }
                        }

                        if ($employee->employee_update()) {
                            $obj_timetable->begin_transaction();
                            //delete slots after this inactivation date as signed...?
                            if(trim($employee->status) == 0 && trim($employee->inactive_date) != ''){
                                $transaction_flag = $obj_timetable->delete_slots_after_date($employee->inactive_date, NULL, $employee->username, TRUE);
                            }
                            if($transaction_flag){
                                $employee->commit_transaction();
                                $obj_timetable->commit_transaction();
                                $messages->set_message('success', 'employee_updating_success');
                                //echo "<pre>".print_r($employee_detail, 1)."</pre>";
                                //echo "<pre>".print_r($employee_detail, 1)."</pre>";
                                $change_msg = '';
                                $change_msg = $employee->century.$employee->social_security != $employee_detail[0]['century'].$employee_detail[0]['social_security'] ? $smarty->translate['social_security']. ' : ' .'xxxxxx-xxxx<br>' : '';
                                if($_SESSION['company_sort_by'] == 1){
                                    $change_msg .= trim($employee->first_name) . ' ' . trim($employee->last_name) != trim($employee_detail[0]['first_name']) . ' ' . trim($employee_detail[0]['last_name']) ? $smarty->translate['name'] . ' : ' . trim($employee->first_name) . ' ' . trim($employee->last_name). ' ('.trim($employee_detail[0]['first_name']) . ' ' . trim($employee_detail[0]['last_name']).')<br>' : '';
                                }else{
                                    $change_msg .= trim($employee->first_name) . ' ' . trim($employee->last_name) != trim($employee_detail[0]['first_name']) . ' ' . trim($employee_detail[0]['last_name']) ? $smarty->translate['name'] . ' : ' . trim($employee->last_name) . ' ' . trim($employee->first_name). ' ('.trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']).')<br>' : '';
                                }
                                // $change_msg .= $employee->gender != $employee_detail[0]['gender'] ? $smarty->translate['gender'].' : '. ($employee->gender?$smarty->translate['male']:$smarty->translate['female']). ' ('. ($employee_detail[0]['gender']?$smarty->translate['male']:$smarty->translate['female']). ')<br>' : '';
                                $change_msg .= $employee->code != $employee_detail[0]['code'] ? $smarty->translate['code']. ' : ' .$employee->code. ($employee_detail[0]['code'] != '' ? '('.$employee_detail[0]['code'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->address != $employee_detail[0]['address'] ? $smarty->translate['address']. ' : ' .$employee->address. ($employee_detail[0]['address'] != '' ? '('.$employee_detail[0]['address'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->care_of != $employee_detail[0]['care_of'] ? $smarty->translate['care_off']. ' : ' .$employee->care_of. ($employee_detail[0]['care_of'] != '' ? '('.$employee_detail[0]['care_of'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->post != $employee_detail[0]['post'] ? $smarty->translate['post']. ' : ' .$employee->post. ($employee_detail[0]['post'] != '' ? '('.$employee_detail[0]['post'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->city != $employee_detail[0]['city'] ? $smarty->translate['city']. ' : ' .$employee->city. ($employee_detail[0]['city'] != '' ? '('.$employee_detail[0]['city'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->phone != $employee_detail[0]['phone'] ? $smarty->translate['phone']. ' : ' .$_POST['phone']. ($employee_detail[0]['phone'] != '' ? '('.phone_check($employee_detail[0]['phone'],'phone').')' : '' ).'<br>' : '';
                                $change_msg .= $employee->mobile != $employee_detail[0]['mobile'] ? $smarty->translate['mobile']. ' : ' .$_POST['mobile']. ($employee_detail[0]['mobile'] != '' ? '('.phone_check($employee_detail[0]['mobile'],'mobile').')' : '' ).'<br>' : '';
                                $change_msg .= $employee->email != $employee_detail[0]['email'] ? $smarty->translate['email']. ' : ' .$employee->email. ($employee_detail[0]['email'] != '' ? '('.$employee_detail[0]['email'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->date != $employee_detail[0]['date'] ? $smarty->translate['date']. ' : ' .$employee->date. ($employee_detail[0]['date'] != '' ? '('.$employee_detail[0]['date'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->inactive_date != $employee_detail[0]['date_inactive'] ? $smarty->translate['date_inactive']. ' : ' .$employee->inactive_date. ($employee_detail[0]['date_inactive'] != '' ? '('.$employee_detail[0]['date_inactive'].')' : '' ).'<br>' : '';
                                // $change_msg .= $employee->start_day != $employee_detail[0]['start_day'] ? $smarty->translate['start_day']. ' : ' .JDDayOfWeek(substr($employee->start_day,0,1),2).substr($employee->start_day,1). ' ('. JDDayOfWeek(substr($employee_detail[0]['start_day'], 0,1),2).substr($employee_detail[0]['start_day'],1). ')<br>' : '';
                                // $change_msg .= $employee->password != "" ? $smarty->translate['password']. ' : ' .$employee->password.'<br>' : '';
                                
                                $msg_password_emp = $employee->password != "" ? $smarty->translate['password']. ' : ' .$employee->password.'<br>' : '';
                                $msg_password_con = $employee->password != "" ? $smarty->translate['employee_password_changed']. ' : ' : '';
                                
                                $change_msg .= $employee->status != $employee_detail[0]['status'] ? $smarty->translate['status']. ' : ' .($employee->status?$smarty->translate['active']:$smarty->translate['inactive']). ' ('. ($employee_detail[0]['status']?$smarty->translate['active']:$smarty->translate['inactive']). ')<br>' : '';

                                $change_msg .= $employee->role != $employee_role ? $smarty->translate['role']. ' : ' .$smarty->translate[$role[$employee->role]]. ' ('. $smarty->translate[$role[$employee_role]]. ')<br>' : '';
                                $change_msg .= $employee->substitute != $employee_detail[0]['substitute'] ? $smarty->translate['substitute']. ' : ' .($employee->substitute?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['substitute']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                // $change_msg .= $employee->use_inconvenient != $employee_detail[0]['inconvenient_on'] ? $smarty->translate['use_inconvenient']. ' : ' .($employee->use_inconvenient?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['inconvenient_on']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                $change_msg .= $employee->max_hours != $employee_detail[0]['max_hours'] ? $smarty->translate['employee_max_hours']. ' : ' .$employee->max_hours. ($employee_detail[0]['max_hours'] != '' ? '('.$employee_detail[0]['max_hours'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->remaining_sem_leave != $employee_detail[0]['remaining_sem_leave'] ? $smarty->translate['remaining_sem_leave']. ' : ' .$employee->remaining_sem_leave.($employee_detail[0]['remaining_sem_leave'] != '' ? '('.$employee_detail[0]['remaining_sem_leave'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->sem_leave_todate != $employee_detail[0]['sem_leave_todate'] ? $smarty->translate['sem_leave_todate']. ' : ' .$employee->sem_leave_todate. ($employee_detail[0]['sem_leave_todate'] != '' ? '('.$employee_detail[0]['sem_leave_todate'].')' : '' ).'<br>' : '';
                                    //echo !$employee->leave_in_advance.'-'.$employee_detail[0]['leave_in_advance'];exit();
                                $change_msg .= !$employee->leave_in_advance != !$employee_detail[0]['leave_in_advance'] ? $smarty->translate['leave_in_advance']. ' : ' .($employee->leave_in_advance?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['leave_in_advance']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                $change_msg .= $employee->ice != $employee_detail[0]['ice'] ? $smarty->translate['ice']. ' : ' .$employee->ice. ($employee_detail[0]['ice'] != '' ? '('.$employee_detail[0]['ice'].')' : '' ).'<br>' : '';
                                $change_msg .= $employee->employee_contract_start_month != $employee_detail[0]['employee_contract_start_month'] || $employee->employee_contract_month_start_date != $employee_detail[0]['employee_contract_period_date'] ? $smarty->translate['employee_contract_start_month']. ' : ' .$smarty->translate[$month[$employee->employee_contract_start_month-1]['month']]. ' '.$employee->employee_contract_month_start_date.  ($employee_detail[0]['employee_contract_start_month'] || $employee_detail[0]['employee_contract_period_date'] ? '('.$smarty->translate[$month[$employee_detail[0]['employee_contract_start_month']-1]['month']].' '.$employee_detail[0]['employee_contract_period_date'].')' : '').'<br>' : '';
                                $change_msg .= $employee->employee_contract_period_length != $employee_detail[0]['employee_contract_period_length'] ? $smarty->translate['employee_contract_period_length']. ' : ' .$employee->employee_contract_period_length. ($employee_detail[0]['employee_contract_period_length'] != '' ? '('.$employee_detail[0]['employee_contract_period_length'].')' : '' ).'<br>' : '';                        
                                //$change_msg .= $employee->color_code != $employee_detail[0]['color'] ? $smarty->translate['color_code']. ' : ' .$employee->color_code. ' ('. $employee_detail[0]['color']. ')<br>' : '';
                                $change_msg .= $employee->color_code != $employee_detail[0]['color'] ? $smarty->translate['color_code']. ' : ' . '<div style="width:30px;height:10px;display: inline-block;background-color:'.$employee->color_code. ';"></div> (<div style="width:30px;height:10px;display: inline-block;background-color:'.$employee_detail[0]['color']. ';"></div>)<br>' : '';
                                $change_msg .= $employee->sem_leave_days != $employee_detail[0]['sem_leave_days'] ? $smarty->translate['SEM_in_days']. ' : ' .($employee->sem_leave_days?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['sem_leave_days']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                $change_msg .= $employee->vab_leave_days != $employee_detail[0]['vab_leave_days'] ? $smarty->translate['VAB_in_days']. ' : ' .($employee->vab_leave_days?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['vab_leave_days']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                $change_msg .= $employee->fp_leave_days != $employee_detail[0]['fp_leave_days'] ? $smarty->translate['FP_in_days']. ' : ' .($employee->fp_leave_days?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['fp_leave_days']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                $change_msg .= $employee->nopay_leave_days != $employee_detail[0]['nopay_leave_days'] ? $smarty->translate['NOPAY_in_days']. ' : ' .($employee->nopay_leave_days?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['nopay_leave_days']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';
                                $change_msg .= $employee->other_leave_days != $employee_detail[0]['other_leave_days'] ? $smarty->translate['OTHER_in_days']. ' : ' .($employee->other_leave_days?$smarty->translate['yes']:$smarty->translate['no']). ' ('. ($employee_detail[0]['other_leave_days']?$smarty->translate['yes']:$smarty->translate['no']). ')<br>' : '';

                                $temp_salary_type = array("1" => $smarty->translate['employee_salary_hour_saving_holiday'], "2" => $smarty->translate['employee_salary_hour_paid_vacation'], "3" => $smarty->translate['employee_salary_monthly'], "4" => $smarty->translate['employee_salary_monthly_office'], "5" => $smarty->translate['employee_salary_hour_office']);

                                // $change_msg .= $employee->salary_type != $employee_detail[0]['salary_type'] ? $smarty->translate['employee_salary_type']. ' : ' .$temp_salary_type[$employee->salary_type]. ' ('. $temp_salary_type[$employee_detail[0]['salary_type']].')<br>' : '';

                                $subject = $smarty->translate[employee_edit];
                                // echo $change_msg;
                                // exit();
                                
                            } else {
                                $transaction_flag = FALSE;
                                $employee->rollback_transaction();
                                $obj_timetable->rollback_transaction();
                                $messages->set_message('fail', 'slot_delete_error_after_inactivation_date');
                            }
                        } else {
                            $transaction_flag = FALSE;
                            $employee->rollback_transaction();
                            $messages->set_message('fail', 'employee_updating_failed');
                    //                    echo "<pre>".print_r($employee->query_error_details, 1)."</pre>"; exit();
                        }
                    }
                    else {
                        $messages->set_message('fail', 'employee_updating_failed');
                    }
                }
                else{
                    $message = 'employee_code_must_be_unique';
                    $type    = "fail";
                    $messages->set_message($type, $message);
                }
            }
            else{
                $message = 'employee_code_must_contain_atlest_one_number';
                $type    = "fail";
                $messages->set_message($type, $message);
            }
        }
        /*$employee_detail = $employee->employee_detail_main($username_new);
        $color = $employee_detail[0]['color'];
        $social_security = $employee_detail[0]['social_security'];
        $smarty->assign('social_security_check', $user->social_security_check($social_security));
        $smarty->assign('color_code', $color);
        $smarty->assign("dates", $employee_detail[0]['date']);
        $employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);

        //$employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
        if ($employee_detail[0]['mobile'] != "") {
            $length_mobile_display = (strlen($employee_detail[0]['mobile']) - 5) / 2;
            //$employee_detail[0]['mobile'] = "0".substr($employee_detail[0]['mobile'], 0,2) . "-" . substr($employee_detail[0]['mobile'], 2,3)." ".substr($employee_detail[0]['mobile'], 5,2)." ".substr($employee_detail[0]['mobile'], 7,2)." ".substr($employee_detail[0]['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for ($i = 0; $i < $length_mobile_display; $i++) {
                $temp_mobile = $temp_mobile . " " . substr($employee_detail[0]['mobile'], $pos, 2);
                $pos = $pos + 2;
            }
            $employee_detail[0]['mobile'] = "+46" . substr($employee_detail[0]['mobile'], 0, 3) . " " . substr($employee_detail[0]['mobile'], 3, 2) . " " . $temp_mobile;
        }
        if ($employee_detail[0]['phone'] != "") {
            $employee_detail[0]['phone'] = "0" . substr($employee_detail[0]['phone'], 0, 2) . "-" . substr($employee_detail[0]['phone'], 2);
        }
        $smarty->assign('employee_detail', $employee_detail);
        $val[0] = substr($employee_detail[0]['start_day'], 0, 1);
        $val[1] = substr($employee_detail[0]['start_day'], 1, 5);
        $smarty->assign('vals', $val);
        $employee_role = $user->user_role($username_new);
        $smarty->assign('employee_role', $user->user_role($username_new));
        $employee->role = $employee_role;
        $current_team = $employee->get_current_team();
        if(!empty($current_team)) $current_team[0]['tl'] = $employee->get_employee_name("'" . $current_team[0]['tl'] . "'");
        $smarty->assign('current_team', $current_team);
        //get team leader name
        $available_team = $employee->get_available_team((!empty($current_team) ? $current_team[0]['id'] : ''));
        for ($i = 0; $i < count($available_team); $i++) {
            $available_team[$i]['tl'] = $employee->get_employee_name("'" . $available_team[$i]['tl'] . "'");
        }
        $smarty->assign('available_team', $available_team);*/
    }
    
    
    //setting employee teams
    if($transaction_flag){
        $temp_assigned_customers = array();
        $temp_assigned_customers_username = array();
        $new_team_customers = array();
        $new_team_customers_username = array();
        if($user_roles_login == 1 || $user_roles_login == 6){
            
            if(!empty($_POST['user_id'])){
                $temp_assigned_customers = $equipment->assigned_customers_to_employee($_SERVER['QUERY_STRING']);
                $temp_assigned_customers_username = array_column($temp_assigned_customers, 'customer');
                //echo "<pre>0000".print_r($temp_assigned_customers, 1)."</pre>";
                //delete all existing team customers
                $transaction_flag = $employee->delete_employee_team_customers($employee->username);
            }


            if($transaction_flag){
                $team_customers = array();
                if(isset($_POST['team_cust_uname']) && !empty($_POST['team_cust_uname']) && isset($_POST['team_cust_role']) && !empty($_POST['team_cust_role'])){
                    foreach($_POST['team_cust_uname'] as $ckey => $assigned_customer){
                        if(trim($assigned_customer) != ''){
                            $team_customers[] = array(
                                'customer'  => trim($assigned_customer), 
                                'role'      => (isset($_POST['team_cust_role'][$ckey]) && trim($_POST['team_cust_role'][$ckey]) != '' && $employee->role == $_POST['cur_role']? trim($_POST['team_cust_role'][$ckey]) : 3)
                                );
                        }
                    }
                }
                
                if(!empty($team_customers)){
                    $transaction_flag = $employee->add_team_customers($employee->username, $team_customers);
                }
            }
            $new_team_customers = $equipment->assigned_customers_to_employee($_SERVER['QUERY_STRING']);
            $new_team_customers_username = array_column($new_team_customers, 'customer');
                
        }
        if ($change_msg || $msg_password_emp) {
            $msg .= $change_msg.$msg_password_emp;  
            $msg_con_per .= $change_msg.$msg_password_con;           
        }
        //echo "<pre>0000".print_r(your_array_diff($temp_assigned_customers_username, $new_team_customers_username), 1)."</pre>";
        //echo "<pre>0001".print_r(your_array_diff($temp_assigned_customers), 1)."</pre>";;
        //echo "<pre>0002".print_r(your_array_diff($new_team_customers, $temp_assigned_customers), 1)."</pre>";exit();
        
        if(!empty(array_diff($temp_assigned_customers_username, $new_team_customers_username)) || !empty(array_diff($new_team_customers_username, $temp_assigned_customers_username))){

            if($remianig_array = your_array_diff($new_team_customers, $temp_assigned_customers)){
                $msg .= $smarty->translate['customers_added_to_employee_team'] . ' : ' ;
                $msg_con_per .= $smarty->translate['customers_added_to_employee_team'] . ' : ' ;
                $it_i = 0;
                foreach($remianig_array as $remianig_customer){
                    if($it_i != 0){
                        $msg .= ', ';
                        $msg_con_per .= ', ';
                    }
                    if(in_array($remianig_customer['customer'], $temp_assigned_customers_username   )){
                        if($remianig_customer['role'] == 2){
                            if($_SESSION['company_sort_by'] == 1)
                                $team_msg_tl_role_change .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'].", ";
                            else
                                $team_msg_tl_role_change .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'].", ";
                        }elseif($remianig_customer['role'] == 7){
                            if($_SESSION['company_sort_by'] == 1)
                                $team_msg_gl_role_change .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'].", ";
                            else
                                $team_msg_gl_role_change .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'].", ";
                        }

                    }else{
                        if($_SESSION['company_sort_by'] == 1){
                            $msg .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'];
                            $msg_con_per .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'];

                        }
                        else{
                            $msg .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'];
                            $msg_con_per .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'];

                        }
                        $it_i ++;
                    }
                }
                $msg .= '<br>';
                $msg_con_per .= '<br>';

            }

            if($remianig_array = your_array_diff($temp_assigned_customers, $new_team_customers)){
                $msg .= $smarty->translate['customers_removed_from_employee_team'] . ' : ' ;
                $msg_con_per .= $smarty->translate['customers_removed_from_employee_team'] . ' : ' ;
                $it_i = 0;
                foreach($remianig_array as $remianig_customer){                    
                    if($it_i != 0){
                        $msg .= ', ';
                        $msg_con_per .= ', ';
                    }
                    if(in_array($remianig_customer['customer'], $new_team_customers_username)){
                        continue;
                    }

                    if($_SESSION['company_sort_by'] == 1){
                        $msg .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'];
                        $msg_con_per .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'];
                    }
                    else{
                        $msg .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'];
                        $msg_con_per .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'];
                    }
                    $it_i ++;                    
                }
                $msg .= '<br>';
                $msg_con_per .= '<br>';            
            }
            
        }else{
            if($remianig_array = your_array_diff($new_team_customers, $temp_assigned_customers)){                    
                foreach($remianig_array as $remianig_customer){
                    if($remianig_customer['role'] == 2){
                        if($_SESSION['company_sort_by'] == 1)
                            $team_msg_tl_role_change .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'].", ";
                        else
                            $team_msg_tl_role_change .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'].", ";
                    }elseif($remianig_customer['role'] == 7){
                        if($_SESSION['company_sort_by'] == 1)
                            $team_msg_gl_role_change .=  $remianig_customer['first_name']. ' '. $remianig_customer['last_name'].", ";
                        else
                            $team_msg_gl_role_change .=  $remianig_customer['last_name']. ' '. $remianig_customer['first_name'].", ";
                    }
                }
                          
            }
            
        }
        if($team_msg_tl_role_change){
            $msg .= $smarty->translate['team_role_on_customer_changed_to_tl'] . ' : '.$team_msg_tl_role_change.'<br>';
            $msg_con_per .= $smarty->translate['team_role_on_customer_changed_to_tl'] . ' : '.$team_msg_tl_role_change.'<br>';
        }
        if($team_msg_gl_role_change){
            $msg .= $smarty->translate['team_role_on_customer_changed_to_gl'] . ' : '.$team_msg_gl_role_change.'<br>';
            $msg_con_per .= $smarty->translate['team_role_on_customer_changed_to_gl'] . ' : '.$team_msg_gl_role_change.'<br>';
        }
        //exit();
        if($msg){
            $logged_employee_detail = $employee->employee_detail_main($_SESSION['user_id']);
            $compony_detail = $customer->get_company_detail($_SESSION['company_id']);
            $company_home = $compony_detail['website'];
            $cirrus_link = $company['website'];
            $logo = $compony_detail['logo'];
            $company_name = $compony_detail['name'];
            $contact_person = $compony_detail['contact_person1'];

            

            $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $logged_employee_detail[0]['first_name']. ' '. $logged_employee_detail[0]['last_name'] : $logged_employee_detail[0]['last_name']. ' '. $logged_employee_detail[0]['first_name'];

            if (!empty($_POST['user_id'])){
                $msg = $smarty->translate['mail_employee_profile_body1'].'<br><br>'.$msg;
                $msg_con_per = $smarty->translate['mail_employee_profile_body1'].'<br><br>'.$msg_con_per;

                $msg .= '<br>' . $smarty->translate['profile_employee_name'] . ' : ' .  ($_SESSION['company_sort_by'] == 1 ? $$employee_detail[0]['first_name']. ' '. $employee_detail[0]['last_name'] : $employee_detail[0]['last_name']. ' '. $employee_detail[0]['first_name']);
                $msg_con_per .= '<br>' . $smarty->translate['profile_employee_name'] . ' : ' .  ($_SESSION['company_sort_by'] == 1 ? $$employee_detail[0]['first_name']. ' '. $employee_detail[0]['last_name'] : $employee_detail[0]['last_name']. ' '. $employee_detail[0]['first_name']);
            }

            $msg .= '<br>' . $smarty->translate[contact_person_in_the_office] . ' : ' . $contact_person . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link. '<br>' . $smarty->translate['edited_by'] . ' : ' . $logged_employee_name;

            $msg_con_per .= '<br>' . $smarty->translate[contact_person_in_the_office] . ' : ' . $contact_person . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link. '<br>' . $smarty->translate['edited_by'] . ' : ' . $logged_employee_name;


            $mailer = new SimpleMail($subject, $msg);
            $mailer_con = new SimpleMail($subject, $msg_con_per);
            $mailer->addSender("cirrus-noreplay@time2view.se");
            $mailer_con->addSender("cirrus-noreplay@time2view.se");

            $selected_email_options_number_emp = get_email_option($employee->username);
            if($employee->password){
                $mailer->addRecipient($employee->email, trim($employee->first_name) . ' ' . trim($employee->last_name));
            }
            else{
                if(in_array(25, $selected_email_options_number_emp)){
                    $mailer->addRecipient($employee->email, trim($employee->first_name) . ' ' . trim($employee->last_name));
                }
            }
            
            $recipient_mail = NULL;
            if($compony_detail['mail_send_to_contact_person'] == 1){
                if(trim($compony_detail['contact_person2_email']) != '')
                    $recipient_mail = trim($compony_detail['contact_person2_email']);
                else if(trim($compony_detail['contact_person1_email']) != '')
                    $recipient_mail = trim($compony_detail['contact_person1_email']);
            }
            $mailer_con->addRecipient($recipient_mail);
            $selected_email_options_number_log_emp = get_email_option($logged_employee_detail[0]['username']);
            
            if(in_array(25, $selected_email_options_number_log_emp)){
                if(trim($logged_employee_detail[0]['email']) != '')
                    $mailer_con->addRecipient($logged_employee_detail[0]['email']);
            }
            $mailer->send();
            $mailer_con->send();
        }
        if (empty($_POST['user_id'])){
            header("location:" . $smarty->url . "employee/add/" . $username_new . "/");
            exit();
        }
    }
}

$smarty->assign('message', $messages->show_message());

$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass', $pass);
//default color
$hex_color = '#FFFFFF';
$color = $employee->hex_to_rgb($hex_color);
//echo "<pre>".print_r($color, 1)."</pre>";exit();
$smarty->assign('color_code', $color);
//end of color
$date_now = date("Y-m-d");
$smarty->assign("dates", $date_now);
//$query_string = $_SERVER['QUERY_STRING'];
/*
  //echo "<script>alert(\"".$_SERVER['QUERY_STRING']."\")</script>";
 */

$_SESSION['from_page'] = '';
$_SESSION['report_return_url'] = '';
unset($_SESSION['from_page']);
unset($_SESSION['report_return_url']);

if (!empty($query_string[0])) {
    /* //echo "<script>alert(\"".$_SERVER['QUERY_STRING']."\")</script>"; */
    $employee_detail = $employee->employee_detail_main($query_string[0]);
    $employee_role = $user->user_role($query_string[0]);
    $employee->username = $query_string[0];
    $smarty->assign('employee_action', !empty($employee_detail) ? 'EDIT' : 'NEW');
    $color = $employee_detail[0]['color'];
    $social_security = $employee_detail[0]['social_security'];
    $smarty->assign('social_security_check', $user->social_security_check($social_security));
    $smarty->assign('color_code', $color);
    $smarty->assign("dates", $employee_detail[0]['date']);
    $employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
    //$employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
    if ($employee_detail[0]['mobile'] != "") {
        $length_mobile_display = (strlen($employee_detail[0]['mobile']) - 5) / 2;
        //$employee_detail[0]['mobile'] = "0".substr($employee_detail[0]['mobile'], 0,2) . "-" . substr($employee_detail[0]['mobile'], 2,3)." ".substr($employee_detail[0]['mobile'], 5,2)." ".substr($employee_detail[0]['mobile'], 7,2)." ".substr($employee_detail[0]['mobile'],9,2);
        $temp_mobile = '';
        $pos = 5;
        for ($i = 0; $i < $length_mobile_display; $i++) {
            $temp_mobile = $temp_mobile . " " . substr($employee_detail[0]['mobile'], $pos, 2);
            $pos = $pos + 2;
        }
        
        $employee_detail[0]['mobile'] = "+46" . substr($employee_detail[0]['mobile'], 0, 2) . " " . substr($employee_detail[0]['mobile'], 2, 3) . " " . $temp_mobile;
    //echo $employee_detail[0]['mobile'];exit();
        
    }
    if ($employee_detail[0]['phone'] != "") {
        $employee_detail[0]['phone'] = "0" . substr($employee_detail[0]['phone'], 0, 2) . "-" . substr($employee_detail[0]['phone'], 2);
    }
    // var_dump($employee_detail);
    // exit('fdg');
    $smarty->assign('employee_detail', $employee_detail);
    $val[0] = substr($employee_detail[0]['start_day'], 0, 1);
    $val[1] = substr($employee_detail[0]['start_day'], 1, 5);
    $smarty->assign('vals', $val);
    $smarty->assign('employee_role', $user->user_role($query_string[0]));
    $employee->role = $employee_role;
    $current_team = $employee->get_current_team();
    if(!empty($current_team)) $current_team[0]['tl'] = $employee->get_employee_name("'" . $current_team[0]['tl'] . "'");
    $smarty->assign('current_team', $current_team);
    //get team leader name
    $available_team = $employee->get_available_team((!empty($current_team) ? $current_team[0]['id'] : ''));
    for ($i = 0; $i < count($available_team); $i++) {
        $available_team[$i]['tl'] = $employee->get_employee_name("'" . $available_team[$i]['tl'] . "'");
    }
    $smarty->assign('available_team', $available_team);
}
else {
    // generate emp code
    $smarty->assign('employee_action', 'NEW');
    
    $emp_code = $employee->generate_employee_code();
    $smarty->assign('emp_code', $emp_code);

    //get team leader name
    $available_team = $employee->get_available_team();
    for ($i = 0; $i < count($available_team); $i++) {
        $available_team[$i]['tl'] = $employee->get_employee_name("'" . $available_team[$i]['tl'] . "'");
    }
    $smarty->assign('available_team', $available_team);

    //random colour code for new employee
    //    $color_code = array('r' => mt_rand(127, 255), 'g' => mt_rand(127, 255), 'b' => mt_rand(127, 255));
    $color_code = $obj_general->random_color();
    $smarty->assign('color_code', $color_code);
}


$assigned_customers = $equipment->assigned_customers_to_employee($_SERVER['QUERY_STRING']);
$to_assign = $equipment->customers_to_assign($assigned_customers);
$assign = $assign_emp = '';
$not_assign = '';
for ($i = 0; $i < count($to_assign); $i++) {
    $not_assign = $not_assign . $to_assign[$i]['username'] . ",";
}
//echo "<pre>".print_r($assigned_customers, 1)."</pre>"; exit();
for ($i = 0; $i < count($assigned_customers); $i++) {
    $assign = $assign . $assigned_customers[$i]['username'] . ",";
    $assign_emp = $assign_emp . $assigned_customers[$i]['employee'] . ",";
}
if ($_SERVER['QUERY_STRING']) {
    $string = explode('&', $_SERVER['QUERY_STRING']);
    if ($employee->is_employee_accessible($string[0]) || $employee->is_employee_inactive_accessible($string[0])) {
        $smarty->assign('access_flag', 1);
    } else {
        $smarty->assign('access_flag', 0);
    }
} else {
    $smarty->assign('access_flag', 1);
}
if (!empty($query_string[0])) {
    $employee_detail[0] = $employee->get_employee_detail($query_string[0]);
    $val[0] = substr($employee_detail[0]['start_day'], 0, 1);
    $val[1] = substr($employee_detail[0]['start_day'], 1, 5);
    $smarty->assign('vals', $val);
    $employee_incov_detail[0] = $employee->get_employee_incov_detail($query_string[0]);
    $smarty->assign('employee_incov_detail', $employee_incov_detail);
    $employee_salary = $employee->get_employee_salary($query_string[0]);
    $smarty->assign('employee_salary', $employee_salary);
}
$smarty->assign('tab', '');
if (isset($_POST['save_doc'])) {
    $emp = $_SESSION['user_id'];
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $max_size = 50000 * 1024;
        $file_name = $_FILES['file']['name'];
        $size = filesize($_FILES['file']['tmp_name']);
        $str = str_replace(" ", "_", $file_name);
        if ($size <= $max_size) {
            $extension = $customer->get_file_extension($str);
            if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {
                $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/documents_attach/";
                //$upload_path = "documents_attach/";
                $file_path = $upload_path . $str;
                if (!file_exists($file_path)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                        $datas = $employee->employee_documents_add($emp, $str);
                        $message = 'document_add_success';
                        $type = "success";
                        $messages->set_message($type, $message);
                    } else {
                        $message = 'failed_to_post_documents';
                        $type = "fail";
                    }
                } else {
                    $present = 0;
                    $documents_file = $employee->get_all_files_user($_SESSION['user_id']);

                    for ($x = 0; $x < count($documents_file); $x++) {
                        $str1 = explode('.', $documents_file[$x]['documents']);
                        $str1[0] = substr($str1[0], 0, -2);
                        $str1 = $str1[0] . "." . $str1[1];
                        if ($documents_file[$x]['documents'] == $str || $str == $str1) {
                            $present = 1;
                            break;
                        }
                    }
                    if ($present == 1) {
                        $message = 'file_exists';
                        $type = "fail";
                        $messages->set_message($type, $message);
                        $error = "1";
                    } else {
                        $num = 1;
                        $x = 0;
                        $str1 = explode('.', $str);
                        $str = $str1[0] . "_" . $num . "." . $str1[1];
                        $file_path = $upload_path . $str;
                        while ($x == 0) {
                            if (file_exists($file_path)) {
                                $num++;
                                $str1 = explode('.', $str);
                                $str1[0] = substr($str1[0], 0, -2);
                                $str = $str1[0] . "_" . $num . "." . $str1[1];
                                $file_path = $upload_path . $str;
                            } else {
                                $x++;
                            }
                        }
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                            $datas = $employee->employee_documents_add($emp, $str);
                            $message = 'document_add_success';
                            $type = "success";
                            $messages->set_message($type, $message);
                        }
                    }
                }
            } else {
                $message = 'file_selected_supported_extension';
                $type = "fail";
            }
        } else {
            $message = 'exceeds_the_limit_file_size';
            $type = "fail";
        }
    }
    //$smarty->assign('message', $messages->show_message());
    //$datas = $employee->employee_documents_add($emp,$file_name);
    // header("location:".$smarty->url."employee/administration/03/");
    $smarty->assign('tab', '03');
}
$q_string = explode('&', $_SERVER['QUERY_STRING']);
if (isset($q_string[2]) && $q_string[2]) {
    if (isset($q_string[1]) && $q_string[1] == 'del1') {
        //echo "delete 1";
        $app_dir = getcwd();
        $file_name = $employee->get_file_name_employee_attachment($q_string[2]);
        $folder_name = $customer->get_folder_name($_SESSION['company_id']) . "/documents_attach/";
        @unlink($app_dir . "/" . $folder_name . $file_name['documents']);
        $data = $employee->delete_employee_attachment($q_string[2]);
        //header("location:".$smarty->url."employee/administration/03/");
        $smarty->assign('tab', '03');
    } else if (isset($q_string[1]) && $q_string[1] == 'del2') {
        // echo "delete 2";
        $data = $employee->delete_employee_skill($q_string[2]);
        // header("location:".$smarty->url."employee/administration/02/");
        $smarty->assign('tab', '02');
    }
}
if (isset($_POST['add_skills'])) {
    $skill = $_POST['skills'];
    $description = $_POST['description'];
    $emp = $_SESSION['user_id'];
    $data = $employee->employee_skill_add($skill, $description, $emp);
    $smarty->assign('tab', '02');
}

function phone_check($phone,$type){
     if($type == 'mobile'){   
         if ($phone != "") {
            $length_mobile_display = (strlen($phone) - 5) / 2;
            //$employee_detail[0]['mobile'] = "0".substr($employee_detail[0]['mobile'], 0,2) . "-" . substr($employee_detail[0]['mobile'], 2,3)." ".substr($employee_detail[0]['mobile'], 5,2)." ".substr($employee_detail[0]['mobile'], 7,2)." ".substr($employee_detail[0]['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for ($i = 0; $i < $length_mobile_display; $i++) {
                $temp_mobile = $temp_mobile . " " . substr($phone, $pos, 2);
                $pos = $pos + 2;
            }
            return $phone = "+46" . substr($phone, 0, 2) . " " . substr($phone, 2, 3) . " " . $temp_mobile;
            //$employee_detail[0]['mobile'] = "+46" . substr($employee_detail[0]['mobile'], 0, 2) . " " . substr($employee_detail[0]['mobile'], 2, 3) . " " . $temp_mobile;
        }
    }
    if($type == 'phone'){
        if ($phone != "") {
            return $phone = "0" . substr($phone, 0, 2) . "-" . substr($phone, 2);
        }
    }
}



$smarty->assign('year_in_2_digit', date('y'));
$smarty->assign('user_roles', $user->user_role($_SERVER['QUERY_STRING']));
$smarty->assign('users_in', $_SERVER['QUERY_STRING']);
$smarty->assign('assigned', $assigned_customers);
$smarty->assign('to_assign', $to_assign);
$smarty->assign('not_assign', $not_assign);
$smarty->assign('assign', $assign);
$smarty->assign('assign_emp', $assign_emp);
//echo "<script>navigatePage(".$smarty->url."employee/add/".$_SERVER['QUERY_STRING']."/".",'2');</script>";
//$smarty->display('employee_add.tpl');
$smarty->display('extends:layouts/dashboard.tpl|employee_add.tpl|layouts/sub_layout_employee_tabs.tpl');

function your_array_diff($arraya, $arrayb) {

    foreach ($arraya as $keya => $valuea) {
        if (in_array($valuea, $arrayb)) {
            unset($arraya[$keya]);
        }
    }
    return $arraya;
}

function get_email_option($username){
    require_once('class/employee_ext.php');
    $obj_emp = new employee_ext();
    $selected_email_options_number = $obj_emp->get_email_option_of_employee($username)['email'];
    $selected_email_options_number = explode(",",$selected_email_options_number);
    array_pop($selected_email_options_number);
    return $selected_email_options_number;
}

?>