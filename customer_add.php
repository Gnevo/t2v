<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/team.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/customer_ai.php');
require_once('plugins/message.class.php');
require_once('class/mail.php');
require_once('class/general.php');
require_once('class/timetable.php');
require_once('class/employee_ext.php');
//require_once('class/newcustomer.php');
$smarty = new smartySetup(array('company.xml', "user.xml", "messages.xml", "button.xml","privilege.xml", "reports.xml", "customer.xml", "tooltip.xml", 'month.xml','mail.xml'));
$customer = new customer();
$team = new team();
$employee = new employee();
$user = new user();
$customer_ai = new customer_ai();
$messages = new message();
$obj_timetable = new timetable();
$obj_general = new general();
$obj_emp = new employee_ext();
//Added by rahul 3-10-2012 - create newcustomer object
//$newcustomer = new newcustomer();
$smarty->assign('message', $messages->show_message());
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'REGISTER'));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('url', $smarty->url);


//Added By Rahul : 09-10-2012
//get login user role
$loggedin_user = $_SESSION['user_role'];
$smarty->assign('loggedin_user',$loggedin_user);
//Rahul end 
$smarty->assign('dates', date("Y-m-d"));
$smarty->assign('today', date("Y-m-d"));
//form actions
global $company, $month, $customer_location_settings;

// define('STATIC_MAP_LOCATION_LAT', $customer_location_settings['default_lat']);
// define('STATIC_MAP_LOCATION_LON', $customer_location_settings['default_lon']);
$transaction_flag = TRUE;
$change_msg = '';
$change_health_msg = '';
$change_guardian_msg = '';
$team_msg = '';
$msg = '';
$subject = '';
$team_msg_tl_role_change = '';
$team_msg_gl_role_change = '';

$query_string = $_SERVER['QUERY_STRING'];
$customer_username_temp = '';
if (!empty($query_string)) {
    $customer_username_temp = trim($query_string);
}

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);

if(($customer_username_temp != '' && !($privilege_general['edit_customer'] == 1 || $_SESSION['user_id'] == $customer_username_temp)) ||
    ($customer_username_temp == '' && $privilege_general['add_customer'] != 1)){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if (isset($_POST['username']) && $_POST['username'] != "") {
    //getting customer bassic details
    $mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($_POST['mobile']));
    while (substr($mobile,0,3) == '+46' && strlen($mobile )>1) { $mobile = substr($mobile,3,9999); }
    $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($_POST['phone']));
    while (substr($phone,0,1) == '0' && strlen($phone )>1) { $phone = substr($phone,1,9999); }
    $customer->username        = $_POST['username'];
    $customer->first_name      = strip_tags(trim(urldecode($_POST['first_name'])));
    $customer->last_name       = strip_tags(trim(urldecode($_POST['last_name'])));
    $customer->gender          = strip_tags($_POST['gender']);
    $customer->password        = strip_tags($_POST['password']);
    $customer->code            = strip_tags($_POST['code']);
    $customer->social_security = str_replace("-", "", strip_tags($_POST['social_security']));
    $customer->address         = strip_tags($_POST['adress']);
    $customer->city            = strip_tags($_POST['city']);
    $customer->post            = strip_tags($_POST['post']);
    $customer->phone           = $phone;
    $customer->mobile          = $mobile;
    $customer->email           = strip_tags($_POST['email']);
    $customer->fkkn            = strip_tags($_POST['fkkn']);
    $customer->date            = $_POST['date'];
    $customer->status          = $_POST['status'];
    $customer->century         = $_POST['century'];
    $customer->date_inactive   = $_POST['date_inactive'];

    $customer->kn_name         = $_POST['name'];
    $customer->kn_address      = $_POST['address_kn'];
    $customer->kn_postno       = $_POST['kn_postno'];
    $customer->b_kn_ref_num    = $_POST['breference_no']; 
    $customer->b_box           = $_POST['bbox']; 
    $customer->b_city          = $_POST['bocity'];
    // $customer->map_location    = NULL;
    // echo "<pre>".print_r($_POST, 1)."<pre>"; exit();
    // if(isset($_POST['location_lat']) && isset($_POST['location_lon']) && trim($_POST['location_lat']) != '' && trim($_POST['location_lon']) != ''){
    //     $customer->map_location[0] = trim($_POST['location_lat']) .','. trim($_POST['location_lon']);
    //     $customer->map_location[1] = trim($_POST['location_lat']) .','. trim($_POST['location_lon']);
    // }    
    if($customer->date_inactive == "" || $customer->date_inactive == null)
        $customer->date_inactive = null;
    
    $customer->employee_contract_start_month        = NULL; //$_POST['contract_start_month'] != "" ? $_POST['contract_start_month'] : NULL;
    $customer->employee_contract_month_start_date   = NULL; //($_POST['contract_month_start_date'] != "" &&  $_POST['contract_start_month'] != "") ? $_POST['contract_month_start_date'] : NULL;
    $customer->employee_contract_period_length      = NULL; //($_POST['emp_contract_period_length'] != "" && $_POST['contract_start_month'] != "") ? $_POST['emp_contract_period_length'] : NULL;
        
    $basic_flag = 0;
    $operation_mode = 'EDIT';
    
    if ($user->user_exist($_POST['username'])) {
        
        $operation_mode = 'EDIT';
        //delete slots after of inactivation date if employee will set as inactive
        if(trim($customer->status) == 0 && trim($customer->date_inactive) != ''){
            //echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
            //check any slots after this inactivation date as signed...?
            $signed_slots_after_inactive_date = $obj_timetable->get_signed_slots_after_date($customer->date_inactive, $customer->username, NULL, 5);
            if(!empty($signed_slots_after_inactive_date)){
                $messages->set_message('fail', 'found_signed_slots_after_inactivation_date_cant_edit');
                $transaction_flag = FALSE;
            }
        }
        
        //echo $transaction_flag ? 'M' : 'N';exit();
        if($transaction_flag){
            $customer_detail = $customer->customer_detail($_SERVER['QUERY_STRING']);
            $customer_health = $customer->customer_health($_SERVER['QUERY_STRING']);
            $customer_guardian = $customer->customer_guardian($_SERVER['QUERY_STRING'], TRUE);
            $customer->begin_transaction();
            if ($customer->login_update(TRUE)) {
                if ($customer->customer_update()) {
                    $obj_timetable->begin_transaction();
                    //delete slots after this inactivation date as signed...?
                    if(trim($customer->status) == 0 && trim($customer->date_inactive) != ''){
                        //$transaction_flag = $obj_timetable->delete_slots_after_date($customer->date_inactive, $customer->username, NULL);
                        $transaction_flag = $obj_timetable->delete_slots_and_leaves_after_date($customer->date_inactive, $customer->username);
                    }
                    
                    if($transaction_flag){
                        $customer->commit_transaction();
                        $obj_timetable->commit_transaction();
                        $messages->set_message('success', 'customer_updating_success');
                        $basic_flag = 1;

                        
                        $change_msg = $customer->century.$customer->social_security != $customer_detail['century'].$customer_detail['social_security'] ? $smarty->translate['social_security']. ' : ' .'xxxxxx-xxxx<br>' : '';
                        if($_SESSION['company_sort_by'] == 1){
                            $change_msg .= trim($customer->first_name) . ' ' . trim($customer->last_name) != trim($customer_detail['first_name']) . ' ' . trim($customer_detail['last_name']) ? $smarty->translate['name'] . ' : ' . trim($customer->first_name) . ' ' . trim($customer->last_name). (trim($customer_detail['first_name']) . ' ' . trim($customer_detail['last_name']) != '' ? '('.trim($customer_detail['first_name']) . ' ' . trim($customer_detail['last_name']).')' : '' ).'<br>' : '';
                        }else{
                            $change_msg .= trim($customer->first_name) . ' ' . trim($customer->last_name) != trim($customer_detail['first_name']) . ' ' . trim($customer_detail['last_name']) ? $smarty->translate['name'] . ' : ' . trim($customer->last_name) . ' ' . trim($customer->first_name). (trim($customer_detail['last_name']) . ' ' . trim($customer_detail['first_name']) != '' ? '('.trim($customer_detail['last_name']) . ' ' . trim($customer_detail['first_name']).')' : '' ).'<br>' : '';
                        }
                        // $change_msg .= $customer->gender != $customer_detail['gender'] ? $smarty->translate['gender']. ' : ' .($customer->gender == 1 ? $smarty->translate['male']:$smarty->translate['female']). ' ('. ($customer_detail['gender'] == 1 ? $smarty->translate['male']:$smarty->translate['female']). ')<br>' : '';
                        $change_msg .= $customer->code != $customer_detail['code'] ? $smarty->translate['code']. ' : ' .$customer->code. ($customer_detail['code'] != '' ? '('.$customer_detail['code'].')' : '' ).'<br>' : '';
                        $change_msg .= $customer->address != $customer_detail['address'] ? $smarty->translate['address']. ' : ' .$customer->address. ($customer_detail['address'] != '' ? '('.$customer_detail['address'].')' : '' ).'<br>' : '';
                        $change_msg .= $customer->post != $customer_detail['post'] ? $smarty->translate['post']. ' : ' .$customer->post. ($customer_detail['post'] != '' ? '('.$customer_detail['post'].')' : '' ).'<br>' : '';
                        $change_msg .= $customer->city != $customer_detail['city'] ? $smarty->translate['city']. ' : ' .$customer->city. ($customer_detail['city'] != '' ? '('.$customer_detail['city'].')' : '' ).'<br>' : '';
                        $change_msg .= $customer->phone != $customer_detail['phone'] ? $smarty->translate['phone']. ' : ' .$customer->phone. ($customer_detail['phone'] != '' ? '('.phone_check($customer_detail['phone'],'phone').')' : '' ).'<br>' : '';
                        $change_msg .= $customer->mobile != $customer_detail['mobile'] ? $smarty->translate['mobile']. ' : ' .$customer->mobile. ($customer_detail['mobile'] != '' ? '('.phone_check($customer_detail['mobile'],'mobile').')' : '' ).'<br>' : '';
                        $change_msg .= $customer->email != $customer_detail['email'] ? $smarty->translate['email']. ' : ' .$customer->email. ($customer_detail['email'] != '' ? '('.$customer_detail['email'].')' : '' ).'<br>' : '';
                        $change_msg .= $customer->fkkn != $customer_detail['fkkn'] ? $smarty->translate['fkkn']. ' : ' .($customer->fkkn == 1?$smarty->translate['fk']:$smarty->translate['kn']). ' ('. ($customer_detail['fkkn'] == 1 ? $smarty->translate['fk']:$smarty->translate['kn']). ')<br>' : '';
                        $change_msg .= $customer->date != $customer_detail['date'] ? $smarty->translate['date']. ' : ' .$customer->date. ($customer_detail['date'] != '' ? '('.$customer_detail['date'].')' : '' ).'<br>' : '';
                        // $change_msg .= $customer->employee_contract_start_month != $customer_detail['employee_contract_start_month'] || $customer->employee_contract_month_start_date != $customer_detail['employee_contract_period_date'] ? $smarty->translate['employee_contract_start_month']. ' : ' .$smarty->translate[$month[$customer->employee_contract_start_month-1]['month']]. ' '.$customer->employee_contract_month_start_date.  ($customer_detail['employee_contract_start_month'] || $customer_detail['employee_contract_period_date'] ? '('.$smarty->translate[$month[$customer_detail['employee_contract_start_month']-1]['month']].' '.$customer_detail['employee_contract_period_date'].')' : '').'<br>' : '';
                        // $change_msg .= $customer->employee_contract_period_length != $customer_detail['employee_contract_period_length'] ? $smarty->translate['employee_contract_period_length']. ' : ' .$customer->employee_contract_period_length. ($customer_detail[0]['employee_contract_period_length'] != '' ? '('.$customer_detail[0]['employee_contract_period_length'].')' : '' ).'<br>' : '';                        
                        // $change_msg .= $customer->password != "" ? $smarty->translate['password']. ' : ' .$customer->password.'<br>' : '';

                        $msg_pasword_cus = $customer->password != "" ? $smarty->translate['password']. ' : ' .$customer->password.'<br>' : '';
                        $msg_pasword_con =  $customer->password != "" ? $smarty->translate['employee_password_changed'] : '';

                        $change_msg .= $customer->status != $customer_detail['status'] ? $smarty->translate['status']. ' : ' .($customer->status?$smarty->translate['active']:$smarty->translate['inactive']). ' ('. ($customer_detail['status']?$smarty->translate['active']:$smarty->translate['inactive']). ')<br>' : '';
                        $subject = $smarty->translate['customer_edit'];
                        // echo $change_msg;
                        // die();
                        // exit('df'):
                        
                    } else {
                        $customer->rollback_transaction();
                        $obj_timetable->rollback_transaction();
                        $messages->set_message('fail', 'slot_delete_error_after_inactivation_date');
                    }
                } else {
                    $customer->rollback_transaction();
                    $messages->set_message('fail', 'customer_updating_failed');
                }
            } else {
                $customer->rollback_transaction();
                $messages->set_message('fail', 'customer_updating_failed');
            }
        }
        $customer_username = $customer->username;
        $smarty->assign('customer_username', $customer_username);
        $customer_detail = $customer->customer_detail($customer_username);
        $social_security = $customer_detail['social_security'];
        $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
        if($customer_detail['mobile'] != ""){
            $length_mobile_display = (strlen($customer_detail['mobile'])-5)/2;
            //$customer_detail['mobile'] = "0".substr($customer_detail['mobile'], 0,2) . "-" . substr($customer_detail['mobile'], 2,3)." ".substr($customer_detail['mobile'], 5,2)." ".substr($customer_detail['mobile'], 7,2)." ".substr($customer_detail['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for($i=0;$i<$length_mobile_display;$i++){
                $temp_mobile = $temp_mobile." ".substr($customer_detail['mobile'], $pos,2);
                $pos = $pos +2;
            }
            //$customer_detail['mobile'] = "+46".substr($customer_detail['mobile'], 0,3) . " " . substr($customer_detail['mobile'], 3,2)." ".$temp_mobile;
            $customer_detail['mobile'] = "0".substr($customer_detail['mobile'], 0,2) . "-" . substr($customer_detail['mobile'], 2,3)." ".$temp_mobile;
        }
        if($customer_detail['phone'] != ""){
            $customer_detail['phone'] = "0".substr($customer_detail['phone'], 0,2) . "-" . substr($customer_detail['phone'], 2);
        }
        //$social_security = $customer_detail['social_security'];
        $smarty->assign('social_security_check', $user->social_security_check($social_security));
        $smarty->assign('dates', $customer_detail['date']);
        // $__temp_customer_map = isset($customer_detail['map_location']) && $customer_detail['map_location'] != '' ? explode(',', unserialize($customer_detail['map_location'])) : array();
        // if(!empty($__temp_customer_map)){
        //     $customer_detail['location_lat'] = $__temp_customer_map[0];
        //     $customer_detail['location_lon'] = $__temp_customer_map[1];
        // } else {
        //     $customer_detail['location_lat'] = STATIC_MAP_LOCATION_LAT;
        //     $customer_detail['location_lon'] = STATIC_MAP_LOCATION_LON;
        // }
        $smarty->assign('customer_detail', $customer_detail);
        $smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));
        $smarty->assign('customer_health', $customer->customer_health($customer_username));
        $customer_guardian_details = $customer->customer_guardian($customer_username, TRUE);
        $smarty->assign('customer_guardian', $customer_guardian_details);
        $documents_array = $customer->customer_attachment_documents($customer_username);
        $smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . '/customer_attachments');
        $smarty->assign('customer_documents', $documents_array);
        $smarty->assign('customer_document_string', $customer->customer_attachment_document_sting($customer_username));
        $allocated_employees_array = $customer_ai->customer_team_members($customer_username);
        $allocated_employees = implode(',', $allocated_employees_array);
        $smarty->assign('team_members', $allocated_employees);
        $team_leader = $customer_ai->customer_team_leader($customer_username);
        $super_team_leader = $customer_ai->customer_super_team_leader($customer_username);
        $tl = $stl = '';
        for($i=0;$i<count($team_leader);$i++){
             if($tl == ''){
                 $tl = $team_leader[$i]['employee'];
             }else{
                 $tl = $tl.",".$team_leader[$i]['employee'];
             }
        }
        for($i=0;$i<count($super_team_leader);$i++){
             if($stl == ''){
                 $stl = $super_team_leader[$i]['employee'];
             }else{
                 $stl = $stl.",".$super_team_leader[$i]['employee'];
             }
        }
        //$stl = !empty($super_team_leader) ? $super_team_leader['employee'] : '';
        $smarty->assign('team_leader', $tl);
        $smarty->assign('super_team_leader', $stl);
        $smarty->assign('customer_team',$customer_team =  $customer_ai->customer_alocate_employee($allocated_employees_array, $tl,$stl));
        //$smarty->assign('to_allocate', $customer_ai->customer_employee_list());
        //print_r($customer_team);
        $smarty->assign('to_allocate', $customer_ai->customer_employee_listtoallocate($customer_team));
    }
    else {
        $operation_mode = 'NEW';
        $customer->begin_transaction();
        if ($customer->login_add(TRUE)) {
            if ($customer->customer_add()) {
                $customer->commit_transaction();
                    $messages->set_message('success', 'customer_adding_success');
                    $basic_flag = 1;
                    
                    $change_msg = $customer->century.$customer->social_security ? $smarty->translate['social_security']. ' : ' .'xxxxxx-xxxx<br>' : '';
                    if($_SESSION['company_sort_by'] == 1){
                        $change_msg .= trim($customer->first_name) . ' ' . trim($customer->last_name) ? $smarty->translate['name'] . ' : ' . trim($customer->first_name) . ' ' . trim($customer->last_name). '<br>' : '';
                    }else{
                        $change_msg .= trim($customer->first_name) . ' ' . trim($customer->last_name) ? $smarty->translate['name'] . ' : ' . trim($customer->last_name) . ' ' . trim($customer->first_name). '<br>' : '';
                    }
                    // $change_msg .= $customer->gender ? $smarty->translate['gender']. ' : ' .($customer->gender == 1 ? $smarty->translate['male']:$smarty->translate['female']). '<br>' : '';
                    $change_msg .= $customer->code ? $smarty->translate['code']. ' : ' .$customer->code. '<br>' : '';
                    $change_msg .= $customer->address ? $smarty->translate['address']. ' : ' .$customer->address. '<br>' : '';
                    $change_msg .= $customer->post ? $smarty->translate['post']. ' : ' .$customer->post. '<br>' : '';
                    $change_msg .= $customer->city ? $smarty->translate['city']. ' : ' .$customer->city. '<br>' : '';
                    $change_msg .= $customer->phone ? $smarty->translate['phone']. ' : ' .$customer->phone. '<br>' : '';
                    $change_msg .= $customer->mobile ? $smarty->translate['mobile']. ' : ' .$customer->mobile. ' <br>' : '';
                    $change_msg .= $customer->email ? $smarty->translate['email']. ' : ' .$customer->email. '<br>' : '';
                    $change_msg .= $customer->fkkn ? $smarty->translate['fkkn']. ' : ' .($customer->fkkn == 1?$smarty->translate['fk']:$smarty->translate['kn']). '<br>' : '';
                    $change_msg .= $customer->date ? $smarty->translate['date']. ' : ' .$customer->date. '<br>' : '';
                    // $change_msg .= $customer->employee_contract_start_month || $customer->employee_contract_month_start_date ? $smarty->translate['employee_contract_start_month']. ' : ' .$smarty->translate[$month[$customer->employee_contract_start_month-1]['month']]. ' '.$customer->employee_contract_month_start_date. '<br>' : '';
                    // $change_msg .= $customer->employee_contract_period_length ? $smarty->translate['employee_contract_period_length']. ' : ' .$customer->employee_contract_period_length. '<br>' : '';  

                    // $change_msg .= $customer->password != "" ? $smarty->translate['password']. ' : ' .$customer->password.'<br>' : '';

                    $msg_pasword_cus = $customer->password != "" ? $smarty->translate['password']. ' : ' .$customer->password.'<br>' : '';
                    $msg_pasword_con =  $customer->password != "" ? $smarty->translate['employee_password_changed'] : '';

                    $change_msg .= $customer->status ? $smarty->translate['status']. ' : ' .($customer->status?$smarty->translate['active']:$smarty->translate['inactive']). '<br>' : '';
                    $subject = $smarty->translate['customer_add'];

            } else {
                $customer->rollback_transaction();
                $messages->set_message('fail', 'customer_adding_failed');
            }
        } 
        else {
            $customer->rollback_transaction();
            $messages->set_message('fail', 'customer_adding_failed');
        }
        $customer_username = $customer->username;
        $smarty->assign('customer_username', $customer_username);
        $customer_detail = $customer->customer_detail($customer_username);
        $social_security = $customer_detail['social_security'];
        $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
        if($customer_detail['mobile'] != ""){
            $length_mobile_display = (strlen($customer_detail['mobile'])-5)/2;
            //$customer_detail['mobile'] = "0".substr($customer_detail['mobile'], 0,2) . "-" . substr($customer_detail['mobile'], 2,3)." ".substr($customer_detail['mobile'], 5,2)." ".substr($customer_detail['mobile'], 7,2)." ".substr($customer_detail['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for($i=0;$i<$length_mobile_display;$i++){
                $temp_mobile = $temp_mobile." ".substr($customer_detail['mobile'], $pos,2);
                $pos = $pos +2;
            }
            //$customer_detail['mobile'] = "+46".substr($customer_detail['mobile'], 0,3) . " " . substr($customer_detail['mobile'], 3,2)." ".$temp_mobile;
            $customer_detail['mobile'] = "+46".substr($customer_detail['mobile'], 0,2) . " " . substr($customer_detail['mobile'], 2,3)." ".$temp_mobile;
        }
        if($customer_detail['phone'] != ""){
            $customer_detail['phone'] = "0".substr($customer_detail['phone'], 0,2) . "-" . substr($customer_detail['phone'], 2);
        }
        $smarty->assign('social_security_check', $user->social_security_check($social_security));
        $smarty->assign('dates', $customer_detail['date']);
        // $__temp_customer_map = isset($customer_detail['map_location']) && $customer_detail['map_location'] != '' ? explode(',', unserialize($customer_detail['map_location'])) : array();
        // if(!empty($__temp_customer_map)){
        //     $customer_detail['location_lat'] = $__temp_customer_map[0];
        //     $customer_detail['location_lon'] = $__temp_customer_map[1];
        // } else {
        //     $customer_detail['location_lat'] = STATIC_MAP_LOCATION_LAT;
        //     $customer_detail['location_lon'] = STATIC_MAP_LOCATION_LON;
        // }
        $smarty->assign('customer_detail', $customer_detail);
        $smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));
        $smarty->assign('customer_health', $customer->customer_health($customer_username));
        $customer_guardian_details = $customer->customer_guardian($customer_username, TRUE);
        $smarty->assign('customer_guardian', $customer_guardian_details);
        $documents_array = $customer->customer_attachment_documents($customer_username);
        // echo "<pre>".print_r($documents_array, 1)."<pre>"; exit();
        $smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . '/customer_attachments');
        $smarty->assign('customer_documents', $documents_array);
        $smarty->assign('customer_document_string', $customer->customer_attachment_document_sting($customer_username));
        $allocated_employees_array = $customer_ai->customer_team_members($customer_username);
        $allocated_employees = implode(',', $allocated_employees_array);
        $smarty->assign('team_members', $allocated_employees);
        $team_leader = $customer_ai->customer_team_leader($customer_username);
        $super_team_leader = $customer_ai->customer_super_team_leader($customer_username);
        $tl = $stl = '';
        for($i=0;$i<count($team_leader);$i++){
             if($tl == ''){
                 $tl = $team_leader[$i]['employee'];
             }else{
                 $tl = $tl.",".$team_leader[$i]['employee'];
             }
        }
        for($i=0;$i<count($super_team_leader);$i++){
             if($stl == ''){
                 $stl = $super_team_leader[$i]['employee'];
             }else{
                 $stl = $stl.",".$super_team_leader[$i]['employee'];
             }
        }
        //$stl = !empty($super_team_leader) ? $super_team_leader['employee'] : '';
        $smarty->assign('team_leader', $tl);
        $smarty->assign('super_team_leader', $stl);
        $smarty->assign('customer_team',$customer_team =  $customer_ai->customer_alocate_employee($allocated_employees_array, $tl,$stl));
        //$smarty->assign('to_allocate', $customer_ai->customer_employee_list());
        //print_r($customer_team);
        $smarty->assign('to_allocate', $customer_ai->customer_employee_listtoallocate($customer_team));
    }
    
    /////////////////////********saving customer team structure******////////////////////////////////////////////

    if (/*$_POST['tmp_allocate'] != '' && */$basic_flag == 1 && $transaction_flag) {
        $new_tmp = $_POST['tmp_allocate'] != '' ? explode(',',$_POST['tmp_allocate']) : array();
        $new_employees = $_POST['new_team_member'] != '' ? explode(',',$_POST['new_team_member']) : array();
        $tmp_employee = "";
        
        for($i=0;$i<count($new_tmp);$i++){
            $tag = 0;
           for($j=0;$j<count($new_employees);$j++){
               if($new_employees[$j] == $new_tmp[$i]){
                   $tag = 1;
               }
           } 
           if($tag == 0){
               if($tmp_employee == ""){
                   $tmp_employee = $new_tmp[$i];
               }else{
                   $tmp_employee = $tmp_employee.",".$new_tmp[$i];
               }
           }
        }
        //echo "new members ".$_POST['new_team_member'];
        if($_POST['new_team_member'] != "" || $_POST['new_team_member'] != null){
            $new_employees = $_POST['new_team_member'] != '' ? explode(',',$_POST['new_team_member']) : array();
            for($i=0;$i<count($new_employees);$i++){
                $privileges = $employee->get_privileges_employee($new_employees[$i]);
                if(!$privileges){
                    $privileges_full = $employee->get_privileges_employee($tmp_employee);
                    $all = array();
                     $low = $privileges_full[0]['sum_privilege'];
                    $j=0;
                    for($k=0;$k<count($privileges_full);$k++){
                        if($privileges_full[$k]['sum_privilege'] == $low){
                            $all[$j]=$privileges_full[$k]['privilege'];
                            $j++;
                        }
                    }
                    $new = array_count_values($all);
                    if(count($new) == 1){
                        $priv = explode(',',$all[0]);
                        $employee->swap = $priv[0];
                        $employee->process = $priv[1];
                        $employee->add_slot = $priv[2];
                        $employee->fkkn = $priv[3];
                        $employee->slot_type = $priv[4];
                        $employee->add_customer = $priv[5];
                        $employee->add_employee= $priv[6];
                        $employee->leave = $priv[9];
                        $employee->copy_single_slot = $priv[10];
                        $employee->copy_single_slot_option = $priv[11];
                        $employee->copy_day_slot = $priv[12];
                        $employee->copy_day_slot_option = $priv[13];
                        $employee->delete_slot = $priv[15];
                        $employee->delete_day_slot = $priv[16];
                        $employee->remove_customer = $priv[7];
                        $employee->remove_employee = $priv[8];
                        $employee->split_slot = $priv[14];
                        $data = $employee->add_previleges($new_employees[$i]);
                    }
                }
                $privilege_forms = $employee->get_privileges_forms_employee($new_employees[$i]);
                if(!$privilege_forms){
                    $privilege_full = $employee->get_privileges_forms_employee($tmp_employee);
                    $all = array();
                    $low = $privilege_full[0]['sum_privilege'];
                    $j=0;
                    for($k=0;$k<count($privilege_full);$k++){
                        if($privilege_full[$k]['sum_privilege'] == $low){
                            $all[$j]=$privilege_full[$k]['privilege'];
                            $j++;
                        }
                    }
                    $new = array_count_values($all);
                    if(count($new) == 1){
                        $priv = explode(',',$all[0]);
                        $employee->form_fkkn = $priv[0];
                        $employee->form_leave = $priv[1];
                        $employee->form_certificate = $priv[2];
                        $data = $employee->add_previleges_forms($new_employees[$i]);
                    }
                }
                $privilege_general = $employee->get_privileges_general_employee($new_employees[$i]);
                if(!$privilege_general){
                    $privilege_full = $employee->get_privileges_general_employee($tmp_employee);
                    $all = array();
                    $low = $privilege_full[0]['sum_privilege'];
                    $j=0;
                    for($k=0;$k<count($privilege_full);$k++){
                        if($privilege_full[$k]['sum_privilege'] == $low){
                            $all[$j]=$privilege_full[$k]['privilege'];
                            $j++;
                        }
                    }
                    $new = array_count_values($all);
                    if(count($new) == 1){
                        $priv = explode(',',$all[0]);
                        $employee->general_add_employee = $priv[0];
                        $employee->general_add_customer = $priv[1];
                        $employee->general_inconvenient_timing = $priv[2];
                        $employee->general_administration = $priv[3];
                        $employee->general_chat = $priv[4];
                        $data = $employee->add_previleges_general($new_employees[$i]);
                    }
                }
                $privilege_mc = $employee->get_privileges_mc_employee($new_employees[$i]);
                if(!$privilege_mc){
                    $privilege_full = $employee->get_privileges_mc_employee($tmp_employee);
                    $all = array();
                    $low = $privilege_full[0]['sum_privilege'];
                    $j=0;
                    for($k=0;$k<count($privilege_full);$k++){
                        if($privilege_full[$k]['sum_privilege'] == $low){
                            $all[$j]=$privilege_full[$k]['privilege'];
                            $j++;
                        }
                    }
                    $new = array_count_values($all);
                    if(count($new) == 1){
                        $priv = explode(',',$all[0]);
                        $employee->mc_leave_notification = $priv[0];
                        $employee->mc_leave_approval = $priv[1];
                        $employee->mc_leave_rejection = $priv[2];
                        $employee->mc_leave_edit = $priv[3];
                        $employee->cirrus_mail = $priv[7];
                        $employee->external_mail = $priv[8];
                        $employee->mc_notes = $priv[4];
                        $employee->mc_notes_approval = $priv[5];
                        $employee->mc_notes_rejection = $priv[6];
                        $employee->mc_sms = $priv[9];
                        $data = $employee->add_previleges_mc($new_employees[$i]);
                    }
                }
                $privilege_report = $employee->get_privileges_report_employee($new_employees[$i]);
                if(!$privilege_report){
                    $privilege_full = $employee->get_privileges_report_employee($tmp_employee);
                    $all = array();
                    $low = $privilege_full[0]['sum_privilege'];
                    $j=0;
                    for($k=0;$k<count($privilege_full);$k++){
                        if($privilege_full[$k]['sum_privilege'] == $low){
                            $all[$j]=$privilege_full[$k]['privilege'];
                            $j++;
                        }
                    }
                    $new = array_count_values($all);
                    if(count($new) == 1){
                        $priv = explode(',',$all[0]);
                        $employee->customer_schedule = $priv[0];
                        $employee->employee_schedule = $priv[1];
                        $employee->monthly_work = $priv[2];
                        $data = $employee->add_previleges_reports($new_employees[$i]);
                    }
                }
            }
        }
        if($_POST['remove_member'] != "" || $_POST['remove_member'] != null){
            $remove_employees = $_POST['remove_member'] != '' ? explode(',',$_POST['remove_member']) : array();
            for($i=0;$i<count($remove_employees);$i++){
                $members = $team->get_customers_of_employee($remove_employees[$i]);
                if(count($members) == 1){
                    $team->remove_employee_privileges($remove_employees[$i]);
                    $team->remove_employee_privilege_form($remove_employees[$i]);
                    $team->remove_employee_privilege_general($remove_employees[$i]);
                    $team->remove_employee_privilege_mc($remove_employees[$i]);
                    $team->remove_employee_privilege_report($remove_employees[$i]);
                }
            }
        }
        
        $team_members = $_POST['tmp_allocate'] != '' ? explode(',', $_POST['tmp_allocate']) : array();
        $tl = $_POST['tl'];
        $stl = $_POST['stl'];
        $team_before_save = $customer_team;
        $team_before_save_users = array_column($team_before_save, 'username');
        $customer_ai->begin_transaction();

        if($operation_mode == 'NEW'){
            $user_role_not_to_team = array(1,6,4);
            if(!in_array($loggedin_user, $user_role_not_to_team)){
                $team_members[] = $_SESSION['user_id'];
                $team_members = array_unique($team_members);
            }
        }
        
        if ($customer_ai->customer_team_add($_POST['username'], $team_members, $tl,$stl)) {
            $customer_ai->commit_transaction();
            $allocated_employees_array = $customer_ai->customer_team_members($_POST['username']);
            $allocated_employees = implode(',', $allocated_employees_array);
            $smarty->assign('team_members', $allocated_employees);
            $team_leader = $customer_ai->customer_team_leader($_POST['username']);
            $super_team_leader = $customer_ai->customer_super_team_leader($_POST['username']);
            $tl = $stl = '';
            for($i=0;$i<count($team_leader);$i++){
                 if($tl == ''){
                     $tl = $team_leader[$i]['employee'];
                 }else{
                     $tl = $tl.",".$team_leader[$i]['employee'];
                 }
            }
            for($i=0;$i<count($super_team_leader);$i++){
                 if($stl == ''){
                     $stl = $super_team_leader[$i]['employee'];
                 }else{
                     $stl = $stl.",".$super_team_leader[$i]['employee'];
                 }
            }

            $smarty->assign('team_leader', $tl);
            $smarty->assign('super_team_leader', $stl);
            $smarty->assign('customer_team',$customer_team =  $customer_ai->customer_alocate_employee($allocated_employees_array, $tl,$stl));
            
            $smarty->assign('to_allocate', $customer_ai->customer_employee_listtoallocate($customer_team));
            $messages->set_message('success', 'customer_updating_success');
            $team_after_save = $customer_team;
            $team_after_save_users = array_column($team_after_save, 'username');

            if(!empty(array_diff($team_before_save_users, $team_after_save_users)) || !empty(array_diff($team_after_save_users, $team_before_save_users))){//chk emplye a/r or role change
                if($remianig_array = your_array_diff($team_after_save, $team_before_save)){//chk emply add
                    $team_msg .= $smarty->translate['employees_added_to_customer_team'] . ' : ' ;
                    $it_i = 0;
                    foreach($remianig_array as $remianig_emp){
                        if(in_array($remianig_emp['username'], $team_before_save_users)){
                            if(in_array($remianig_emp['username'], explode(',', $tl))){
                                if($_SESSION['company_sort_by'] == 1)
                                    $team_msg_tl_role_change .=  $remianig_emp['name_ff'].", ";
                                else
                                    $team_msg_tl_role_change .=  $remianig_emp['name'].", ";
                            }elseif(in_array($remianig_emp['username'], explode(',', $stl))){
                                if($_SESSION['company_sort_by'] == 1)
                                    $team_msg_gl_role_change .=  $remianig_emp['name_ff'].", ";
                                else
                                    $team_msg_gl_role_change .=  $remianig_emp['name'].", ";
                            }
                        }else{
                            if($it_i != 0){
                                $team_msg .= ', ';
                            }
                            if($_SESSION['company_sort_by'] == 1)
                                $team_msg .=  $remianig_emp['name_ff'];
                            else
                                $team_msg .=  $remianig_emp['name'];
                            $it_i ++;
                        }
                    }
                    $team_msg .= '<br>';
                               
                }
                if($remianig_array = your_array_diff($team_before_save, $team_after_save)){//chk emply remv
                    $team_msg .= $smarty->translate['employees_removed_from_customer_team'] . ' : ' ;
                    $it_i = 0;
                    foreach($remianig_array as $remianig_emp){
                        if(in_array($remianig_emp['username'], $team_after_save_users)){
                            
                            continue;
                        }else{
                            if($it_i != 0){
                                $team_msg .= ', ';
                            }
                            if($_SESSION['company_sort_by'] == 1)
                                $team_msg .=  $remianig_emp['name_ff'];
                            else
                                $team_msg .=  $remianig_emp['name'];
                            $it_i ++;
                        }
                    }
                    $team_msg .= '<br>';
                     
                }
            }else{
                if($remianig_array = your_array_diff($team_after_save, $team_before_save)){                    
                    foreach($remianig_array as $remianig_emp){
                        if(in_array($remianig_emp['username'], explode(',', $tl))){
                            if($_SESSION['company_sort_by'] == 1)
                                $team_msg_tl_role_change .=  $remianig_emp['name_ff'].", ";
                            else
                                $team_msg_tl_role_change .=  $remianig_emp['name'].", ";
                        }elseif(in_array($remianig_emp['username'], explode(',', $stl))){
                            if($_SESSION['company_sort_by'] == 1)
                                $team_msg_gl_role_change .=  $remianig_emp['name_ff'].", ";
                            else
                                $team_msg_gl_role_change .=  $remianig_emp['name'].", ";
                        }
                    }
                              
                }

            }
            if($team_msg_tl_role_change){
                $team_msg_tl_role_change = $smarty->translate['team_role_changed_to_tl'] . ' : '.$team_msg_tl_role_change.'<br>';
            }
            if($team_msg_gl_role_change){
                $team_msg_gl_role_change = $smarty->translate['team_role_changed_to_gl'] . ' : '.$team_msg_gl_role_change.'<br>';
            }  


        } 
        else {
            $basic_flag = 0;
            $customer_ai->rollback_transaction();
            $messages->set_message('fail', 'customer_updating_failed');
        }
    }
    //////////////////////////////////////END OF TEAM SAVING TEAM///////////////////////////////


    //////////////////////////////**************saving customer helth details******////////////////////////////
    if (($_POST['health_care'] != '' || $_POST['occupational_therapists'] != '' || $_POST['physiotherapists'] != '' || $_POST['aiother'] != '') && $basic_flag == 1 && $transaction_flag) {
        $customer_username = $_POST['username'];
        $customer->health_care = strip_tags($_POST['health_care']);
        $customer->occupational_therapists = strip_tags($_POST['occupational_therapists']);
        $customer->physiotherapists = strip_tags($_POST['physiotherapists']);
        $customer->aiother = strip_tags($_POST['aiother']);
        $customer->begin_transaction();
        if ($customer->customer_health_add($customer_username)) {

            $customer->commit_transaction();
            $messages->set_message('success', 'customer_updating_success');
            $change_health_msg .= $customer->health_care != $customer_health['health_care'] ? $smarty->translate['health_care']. ' : ' .$customer->health_care. ($customer_health['health_care'] != ''? ' ('. $customer_health['health_care']. ')' : '').'<br>' : '';
            $change_health_msg .= $customer->occupational_therapists != $customer_health['occupational_therapists'] ? $smarty->translate['occupational_therapists']. ' : ' .$customer->occupational_therapists. ($customer_health['occupational_therapists'] != '' ? ' ('. $customer_health['occupational_therapists']. ')': '').'<br>' : '';
            $change_health_msg .= $customer->physiotherapists != $customer_health['physiotherapists'] ? $smarty->translate['physiotherapists']. ' : ' .$customer->physiotherapists. ($customer_health['physiotherapists'] != '' ? ' ('. $customer_health['physiotherapists']. ')' : '').'<br>' : '';
            $change_health_msg .= $customer->aiother != $customer_health['other'] ? $smarty->translate['other']. ' : ' .$customer->aiother. ($customer_health['other'] != '' ? ' ('. $customer_health['other']. ')' : ''). '<br>' : '';
            // $change_msg .= $customer->post != $customer_detail['post'] ? $smarty->translate['post']. ' : ' .$customer->post. ($customer_detail['post'] != '' ? '('.$customer_detail['post'].')' : '' ).'<br>' : '';


        } else {
            $basic_flag = 0;
            $customer->rollback_transaction();
            $messages->set_message('fail', 'customer_updating_failed');
        }
    }
    // echo $change_health_msg; exit(); 
     //////////////////////////////////////END OF TEAM SAVING HEALTH///////////////////////////////


    //////////////////////////************saving customer guardian details//////////////////////////////
    if (($_POST['guardian_fname'] != '' || $_POST['guardian_lname'] != '' || $_POST['guardian_mobile'] != '' || $_POST['guardian_email'] != '' || $_POST['guardian_address'] != '') && $basic_flag == 1 && $transaction_flag) {

        $customer_username = $_POST['username'];
        $customer->guardian_type    = in_array(trim($_POST['rb_guardian_type']), array(1,2,3)) ? trim($_POST['rb_guardian_type']) : 1;
        $customer->guardian_fname   = strip_tags($_POST['guardian_fname']);
        $customer->guardian_lname   = strip_tags($_POST['guardian_lname']);
        $customer->guardian_ssn     = strip_tags($_POST['guardian_ssn']);
        $customer->guardian_mobile  = strip_tags($_POST['guardian_mobile']);
        $customer->guardian_email   = strip_tags($_POST['guardian_email']);
        $customer->guardian_address = strip_tags($_POST['guardian_address']);
        /*$customer->guardian_fname2 = strip_tags($_POST['guardian_fname2']);
        $customer->guardian_lname2 = strip_tags($_POST['guardian_lname2']);
        $customer->guardian_ssn2 = strip_tags($_POST['guardian_ssn2']);
        $customer->guardian_mobile2 = strip_tags($_POST['guardian_mobile2']);
        $customer->guardian_email2 = strip_tags($_POST['guardian_email2']);
        $customer->guardian_address2 = strip_tags($_POST['guardian_address2']);*/
        $customer->begin_transaction();
        if ($customer->customer_guardian_add($customer_username)) {
            $customer->commit_transaction();
            $messages->set_message('success', 'customer_updating_success');
            $change_guardian_msg = '';
            $customer_guardian_type = array(1 => $smarty->translate['guardian'], 2 => $smarty->translate['guardian2'], 3 => $smarty->translate['guardian3']);
            $change_guardian_msg .= $customer->guardian_type != $customer_guardian['type'] ? $smarty->translate['guardian']. ' : ' .$customer_guardian_type[$customer->guardian_type]. ($_SERVER['QUERY_STRING'] && $customer_guardian['type'] != ''  ? ' ('.$customer_guardian_type[$customer_guardian['type']]. ')' : '').'<br>' : '';
            if($_SESSION['company_sort_by'] == 1){
                $change_guardian_msg .= $customer->guardian_fname . ' ' . $customer->guardian_lname != trim($customer_guardian['first_name']) . ' ' . trim($customer_guardian['last_name']) ? $smarty->translate['name'] . ' : ' . $customer->guardian_fname . ' ' . $customer->guardian_lname. ($_SERVER['QUERY_STRING'] && trim($customer_guardian['first_name']) ? ' ('.trim($customer_guardian['first_name']) . ' ' . trim($customer_guardian['last_name']).')' : '' ).'<br>' : '';
            }else{
                $change_guardian_msg .= $customer->guardian_lname . ' ' . $customer->guardian_fname != trim($customer_guardian['last_name']) . ' ' . trim($customer_guardian['first_name']) ? $smarty->translate['name'] . ' : ' . $customer->guardian_lname . ' ' . $customer->guardian_fname. ($_SERVER['QUERY_STRING'] && trim($customer_guardian['last_name'])?' ('.trim($customer_guardian['last_name']) . ' ' . trim($customer_guardian['first_name']).')' : '' ). '<br>' : '';
            }
            $change_guardian_msg .= $customer->guardian_ssn != $customer_guardian['ssn'] ? $smarty->translate['social_security']. ' : ' .'xxxxxx-xxxx<br>' : '';
            $change_guardian_msg .= $customer->guardian_mobile != $customer_guardian['mobile'] ? $smarty->translate['mobile']. ' : '. $customer->guardian_mobile.($_SERVER['QUERY_STRING'] && $customer_guardian['mobile'] != '' ? ' ('.$customer_guardian['mobile'].')' : '' ). '<br>' : '';
            $change_guardian_msg .= $customer->guardian_email != $customer_guardian['email'] ? $smarty->translate['email']. ' : ' .$customer->guardian_email.($_SERVER['QUERY_STRING'] && $customer_guardian['email'] != '' ? ' ('.$customer_guardian['email'].')' : '' ). '<br>' : '';
            $change_guardian_msg .= $customer->guardian_address != $customer_guardian['address'] ? $smarty->translate['address']. ' : '. $customer->guardian_address.($_SERVER['QUERY_STRING'] && $customer_guardian['address'] != '' ? ' ('.$customer_guardian['address'].')' : ''). '<br>' : '';
        } else {
            $customer->rollback_transaction();
            $messages->set_message('fail', 'customer_updating_failed');
        }
    }
    /////////////////////////////END OF SAVING GUARDIAN ///////////////////////////////////////////
    // echo $change_guardian_msg; exit();

    ///////////////////////////*************saving attached documents**********///////////////////////////
    $customer_username = $_POST['username'];
    $documents_file = $customer->customer_attachment_documents($customer_username);
    $deleted_docs = array();

    // echo "<pre>".print_r($_POST, 1)."<pre>";
    
    //upload files
    $trustedoc = $_POST['tdocs'];
    $trustedoc_del = $_POST['del_doc'];
    $files_count = $_POST['file_count'];
    //$trustedoc = $_POST['tdocs'];
    $files_deletes = explode(',', $trustedoc_del);
    $app_dir = getcwd();
    if($files_deletes[0] == ""){
        $files_deletes = array();
    }
    $upload_path = $app_dir . "/" . $customer->get_folder_name($_SESSION['company_id']) . "/customer_attachments/";
    for ($j = 0; $j < count($documents_file); $j++) {
        for ($i = 0; $i < count($files_deletes); $i++) {
            if ($documents_file[$j]['file'] == $files_deletes[$i]) {
                
                break;
            }
        }
        if ($i != count($files_deletes)) {
            
            $move_path = $upload_path . "deleted_files/" . $documents_file[$j]['file'];
            $str = $documents_file[$j]['file'];
            if (file_exists($move_path)) {
                           
                $num = 1;
                $x = 0;
                $str1 = explode('.', $str);
                $str = $str1[0] . "_" . $num . "." . $str1[1];
                $move_path = $upload_path . "deleted_files/" . $str;
                while ($x == 0) {
                    if (file_exists($move_path)) {
                        $num++;
                        $str1 = explode('.', $str);
                        $str1[0] = substr($str1[0], 0, -2);
                        $str = $str1[0] . "_" . $num . "." . $str1[1];
                        $move_path = $upload_path . "deleted_files/" . $str;
                    } else {
                        $x++;
                    }
                }
                

                $deleted_docs[] = $documents_file[$j]['file'];

            }
            
            rename($upload_path . $documents_file[$j]['file'] , $move_path);
            //@unlink($upload_path . $documents_file[$j]['file']);
        }
    }
    
    $uploaded_docs = array();
    if ($files_count > 0) {
        
        $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_attachments/';
        $max_size = 50000 * 1024;
        $error = 0;
        for ($i = 1; $i <= $files_count; $i++) {

            if (isset($_FILES['file_' . $i]['name']) && $_FILES['file_' . $i]['name'] != "") {
                $file_no_change = $_FILES['file_' . $i]['name'];
                $file_name = $_FILES['file_' . $i]['name'];
                $size = filesize($_FILES['file_' . $i]['tmp_name']);
                $file_info = pathinfo($file_name);
                // $str = str_replace(" ", "_", $file_name);
                $str = str_replace(array(" ", ","), "_", $file_info['filename']).'_'.date('Y-m-d').'.'.$file_info['extension'];

                if ($size <= $max_size) {

                    // $extension = $customer->get_file_extension($file_name);
                    $extension = $file_info['extension'];
                    if (in_array($extension, array("doc", "docx", 'dot', "pdf", "odt", "txt", 'oxps', 'ppt', 'pptx', 'ppsm', 'ppsx', 'pps', 'ods', 'xls', 'xlsx'))) {
                    // if (!in_array($extension, array("php", "phtml", "sh", "exe"))) {

                        //$upload_path = "customer_attachments/";
                        $file_path = $upload_path . $str;
                        $file_string = $customer->customer_decision_document_string($contract_id);

                        if (file_exists($file_path)) {
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
                                if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                    //rename($upload_path.$file_no_change, $file_path);
                                    if ($trustedoc != "") {
                                        $trustedoc .= "," . $str;
                                    } else {
                                        $trustedoc = $str;
                                    }
                                    $uploaded_docs[] = $str;
                                    $message = 'customer_updating_success';
                                    $type = "success";
                                    $messages->set_message($type, $message);
                                }
                        } else {
                            if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                 //rename($upload_path.$file_no_change, $file_path);
                                if ($trustedoc != "") {
                                    $trustedoc .= "," . $str;
                                } else {
                                    $trustedoc = $str;
                                }
                                $uploaded_docs[] = $str;
                                $message = 'customer_updating_success';
                                $type = "success";
                            } else {
                                $message = 'failed_to_post_documents';
                                $type = "fail";
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
        }
    }
    $documents = array();
    if ($trustedoc != '') {
        $documents = explode(',', $trustedoc);
        
    }
    
    if($transaction_flag){
        $customer->begin_transaction();
        if ($customer->customer_attachment_documents_add($customer_username, $documents)) {
            $customer->commit_transaction();
            $messages->set_message($type, $message);
        } else {
            $customer->rollback_transaction();
            $messages->set_message($type, $message);
        }
    }
    
}
/////////////////////////////////////////////END OF DOCUMENTS////////////////////////////////////////////////////


////////////////////////////////***********MESSAGE SENDING*******///////////////////////////////////////////////
if($team_msg) $change_msg .= $team_msg;
if($team_msg_tl_role_change) $change_msg .= $team_msg_tl_role_change;
if($team_msg_gl_role_change) $change_msg .= $team_msg_gl_role_change;
if($change_health_msg) $change_msg .= "<br><br><b>".$smarty->translate['additional_information']."</b><br>".$change_health_msg;
if($change_guardian_msg) $change_msg .= "<br><br><b>".$smarty->translate['guardian']."</b><br>".$change_guardian_msg;

if(isset($uploaded_docs) && !empty($uploaded_docs)){
    $change_msg .= "<br><br><b>".$smarty->translate['uploaded_documents']."</b>";
    foreach($uploaded_docs as $ud){
        $change_msg .= "<br>".$ud;
    }
}
if(isset($deleted_docs) && !empty($deleted_docs)){
    $change_msg .= "<br><br><b>".$smarty->translate['deleted_documents']."</b>";
    foreach($deleted_docs as $dd){
        $change_msg .= "<br>".$dd;
    }
}

if ($change_msg || $msg_pasword_cus) {
    $logged_employee_detail = $employee->employee_detail_main($_SESSION['user_id']);
    $compony_detail = $customer->get_company_detail($_SESSION['company_id']);
    $company_home = $compony_detail['website'];
    $cirrus_link = $company['website'];
    $contact_person = $compony_detail['contact_person1'];
    $company_name = $compony_detail['name'];
    $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $logged_employee_detail[0]['first_name']. ' '. $logged_employee_detail[0]['last_name'] : $logged_employee_detail[0]['last_name']. ' '. $logged_employee_detail[0]['first_name'];
    $change_msg_con = $change_msg;
    $change_msg     = $change_msg.$msg_pasword_cus;
    $change_msg_con = $change_msg_con.$msg_pasword_con;

    if ($_SERVER['QUERY_STRING']){
        $msg     = $smarty->translate['mail_customer_profile_body1'].'<br><br>'.$change_msg;
        $msg_con = $smarty->translate['mail_customer_profile_body1'].'<br><br>'.$change_msg_con;
        $msg .= '<br>' . $smarty->translate['profile_customer_name'] . ' : ' .  ($_SESSION['company_sort_by'] == 1 ? $$customer_detail['first_name']. ' '. $customer_detail['last_name'] : $customer_detail['last_name']. ' '. $customer_detail['first_name']);
        $msg_con .= '<br>' . $smarty->translate['profile_customer_name'] . ' : ' .  ($_SESSION['company_sort_by'] == 1 ? $$customer_detail['first_name']. ' '. $customer_detail['last_name'] : $customer_detail['last_name']. ' '. $customer_detail['first_name']);
    }else{
        $msg = $change_msg;
        $msg_con = $change_msg_con;
    }

    $msg .= '<br>'.$smarty->translate[contact_person_in_the_office].' : '.$contact_person.'<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link.'<br>'.$smarty->translate['edited_by'] . ' : ' . $logged_employee_name;

    $msg_con .= '<br>'.$smarty->translate[contact_person_in_the_office].' : '.$contact_person.'<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link.'<br>'.$smarty->translate['edited_by'] . ' : ' . $logged_employee_name;

    $mailer     = new SimpleMail($subject, $msg);
    $mailer_con = new SimpleMail($subject, $msg_con);

    $mailer->addSender("cirrus-noreplay@time2view.se");
    $mailer_con->addSender("cirrus-noreplay@time2view.se");
    $mailer->addRecipient($customer->email, trim($customer->first_name).' '.trim($customer->last_name));

    $recipient_mail = NULL;
    if($compony_detail['mail_send_to_contact_person'] == 1){
        if(trim($compony_detail['contact_person2_email']) != '')
            $recipient_mail = trim($compony_detail['contact_person2_email']);
        else if(trim($compony_detail['contact_person1_email']) != '')
            $recipient_mail = trim($compony_detail['contact_person1_email']);
    }
    $mailer_con->addRecipient($recipient_mail);

    $logged_employee_detail = $employee->employee_detail_main($_SESSION['user_id']);
    $selected_email_options_number = $obj_emp->get_email_option_of_employee($logged_employee_detail[0]['username'])['email'];
    $selected_email_options_number = explode(",",$selected_email_options_number);
    array_pop($selected_email_options_number);
    if(in_array(26, $selected_email_options_number)){
        if(trim($logged_employee_detail[0]['email']) != '')
        $mailer_con->addRecipient($logged_employee_detail[0]['email']);
    }
    $mailer->send();
    $mailer_con->send();

}

/////////////////////////////////////////////END MAESSAGE SENDING///////////////////////////////////////////


//end of form actions

$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass', $pass);

$_SESSION['from_page'] = '';
$_SESSION['report_return_url'] = '';
unset($_SESSION['from_page']);
unset($_SESSION['report_return_url']);

$query_string = $_SERVER['QUERY_STRING'];
$customer_username = '';
if (!empty($query_string)) {

    $customer_username = $query_string;
    $contract_details = $customer->contract_customer($customer_username);

    $result = array();
    for ($i = 0; $i < count($contract_details); $i++) {
        $result[$i]['date_from'] = $contract_details[$i]['date_from'];
        $result[$i]['date_to'] = $contract_details[$i]['date_to'];
        $result[$i]['hour'] = $contract_details[$i]['hour'];
        $result[$i]['fkkn'] = $contract_details[$i]['fkkn'];
        $oncall = $customer->oncall_customer($customer_username, $contract_details[$i]['date_from'], $contract_details[$i]['date_to']);
        $result[$i]['oncall'] = $oncall;
        switch ($contract_details[$i]['fkkn']) {
            case 1: $result[$i]['fkkn'] = "fk"; break;
            case 2: $result[$i]['fkkn'] = "kn"; break;
            case 3: $result[$i]['fkkn'] = "tu"; break;
            default: $result[$i]['fkkn'] = "kn"; break;
        }
        /*if ($contract_details[$i]['fkkn'] == 1) {
            $result[$i]['fkkn'] = "fk";
        }
        else
            $result[$i]['fkkn'] = "kn";*/
        $hrs = $contract_details[$i]['hour'];
        $current_date = date('Y-m-d');

        $diff = $employee->date_difference($contract_details[$i]['date_from'], $contract_details[$i]['date_to']);
        $tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
        $tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
        $tot_day = floor($diff / (24 * 60 * 60)) == 0 ? 1 : floor($diff / (24 * 60 * 60));
        $current_date = date('Y-m-d');
        if (strtotime($current_date) < strtotime($contract_details[$i]['date_from'])) {

            $result[$i]['remaining_hour'] = $contract_details[$i]['hour'];
        } else if (strtotime($current_date) > strtotime($contract_details[$i]['date_to'])) {
            $result[$i]['remaining_hour'] = "0";
        } else {
            //$total_hours = $customer->get_timetable_customer($customer_username, $contract_details[$i]['date_from'], $contract_details[$i]['date_to'], $current_date, $contract_details[$i]['fkkn']);
            $total_hours = $customer->customer_timetable_time_between_dates($customer_username, $contract_details[$i]['date_from'], $contract_details[$i]['date_to'], $contract_details[$i]['fkkn'], FALSE, TRUE);
            //$remaining_hours = $customer->time_difference($hrs, $total_hours, 100, 'exact');
            $remaining_hours = $hrs-$total_hours;
            $result[$i]['remaining_hour'] = number_format(round($remaining_hours,2),2, '.','');
        }
    }

    $smarty->assign('contracts', $result);
    $smarty->assign('customer_username', $customer_username);
    $customer_detail = $customer->customer_detail($customer_username);
    $social_security = $customer_detail['social_security'];
    $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
    if($customer_detail['mobile'] != ""){
            $length_mobile_display = (strlen($customer_detail['mobile'])-5)/2;
        //$customer_detail['mobile'] = "0".substr($customer_detail['mobile'], 0,2) . "-" . substr($customer_detail['mobile'], 2,3)." ".substr($customer_detail['mobile'], 5,2)." ".substr($customer_detail['mobile'], 7,2)." ".substr($customer_detail['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for($i=0;$i<$length_mobile_display;$i++){
                $temp_mobile = $temp_mobile." ".substr($customer_detail['mobile'], $pos,2);
                $pos = $pos +2;
            }
            $customer_detail['mobile'] = "+46".substr($customer_detail['mobile'], 0,2) . " " . substr($customer_detail['mobile'], 2,3)." ".$temp_mobile;
    }
    if($customer_detail['phone'] != ""){
        $customer_detail['phone'] = "0".substr($customer_detail['phone'], 0,2) . "-" . substr($customer_detail['phone'], 2);
    }
    $smarty->assign('social_security_check', $user->social_security_check($social_security));
    $smarty->assign('dates', $customer_detail['date']);
    $smarty->assign('customer_detail', $customer_detail);
    $smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));
    $smarty->assign('customer_health', $customer->customer_health($customer_username));
    $customer_guardian_details = $customer->customer_guardian($customer_username, TRUE);
    $smarty->assign('customer_guardian', $customer_guardian_details);
    $documents_array = $customer->customer_attachment_documents($customer_username);
    $smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . '/customer_attachments');
    $smarty->assign('customer_documents', $documents_array);
    $smarty->assign('customer_document_string', $customer->customer_attachment_document_sting($customer_username));
    $allocated_employees_array = $customer_ai->customer_team_members($customer_username);
    $allocated_employees = implode(',', $allocated_employees_array);
    $smarty->assign('team_members', $allocated_employees);
    
    $team_leader = $customer_ai->customer_team_leader($customer_username);
    $super_team_leader = $customer_ai->customer_super_team_leader($customer_username);
    $tl = $stl = '';
    for($i=0;$i<count($team_leader);$i++){
         if($tl == ''){
             $tl = $team_leader[$i]['employee'];
         }else{
             $tl = $tl.",".$team_leader[$i]['employee'];
         }
    }
    for($i=0;$i<count($super_team_leader);$i++){
         if($stl == ''){
             $stl = $super_team_leader[$i]['employee'];
         }else{
             $stl = $stl.",".$super_team_leader[$i]['employee'];
         }
    }
    $smarty->assign('team_leader', $tl);
    $smarty->assign('super_team_leader', $stl);
    $smarty->assign('customer_team',$customer_team =  $customer_ai->customer_alocate_employee($allocated_employees_array, $tl,$stl));
    $smarty->assign('to_allocate', $customer_ai->customer_employee_listtoallocate($customer_team));
} else {
    $smarty->assign('customer_username', '');
    $cust_code = $customer->generate_customer_code();
    $smarty->assign('cust_code', $cust_code);
    $smarty->assign('new', 'new');
    $smarty->assign('to_allocate', $customer_ai->customer_employee_listtoallocate());
}

$access_flag = 1;
if($customer_username){
    $access_flag = ($customer->is_customer_accessible($customer_username) || $customer->is_customer_inactive_accessible($customer_username)) ? 1 : 0;
}

$smarty->assign('access_flag', $access_flag);
if($access_flag != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$smarty->assign('company_id',$_SESSION['company_id']);

if(isset($_POST['username'])){
    header("Location:".$smarty->url."customer/add/".$_POST['username']."/"); exit();
}

if($customer_username != '')
    $cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
else 
    $cust_emp_team_details = array();

$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);

$smarty->display('extends:layouts/dashboard.tpl|customer_add.tpl|layouts/sub_layout_customer_tabs.tpl');


function your_array_diff($arraya, $arrayb) {

    foreach ($arraya as $keya => $valuea) {
        if (in_array($valuea, $arrayb)) {
            unset($arraya[$keya]);
        }
    }
    return $arraya;
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
        }
    }
    if($type == 'phone'){
        if ($phone != "") {
            return $phone = "0" . substr($phone, 0, 2) . "-" . substr($phone, 2);
        }
    }
}


?>