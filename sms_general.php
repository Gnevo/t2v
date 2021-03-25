<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/mail.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/equipment.php');
require_once('class/sms.php');
require_once('class/general.php');
require_once('class/report_signing.php');
require_once('class/notification.php');
require_once('plugins/firebase.php');
// require_once('plugins/firebase_push.php');
require_once('plugins/message.class.php');

$messages        = new message();
$smarty          = new smartySetup(array("messages.xml","month.xml","button.xml","mail.xml"));
$mail            = new mail();
$email           = new email();
$obj_user        = new user();
$equip           = new equipment();
$employee        = new employee();
$obj_general     = new general();
$obj_rpt_signing = new report_signing();
$customer        = new customer();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));
    
$current_year = date('Y');
$prev_month   = date("m", strtotime("first day of previous month"));

$smarty->assign('current_year',$current_year);
$smarty->assign('prev_month',$prev_month);

// Firebase API Key
// define('FIREBASE_API_KEY', $firebase_settings['api_key']);

$years_combo = $employee->distinct_years();
// var_dump($years_combo);exit('fgf');
$smarty->assign("year_option_values", $years_combo);

$privilege_mc = $employee->get_privileges($_SESSION['user_id'], 3);
$smarty->assign('privilege_mc', $privilege_mc);
if($privilege_mc['sms_general'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$search_customers = $customer->customers_list_for_employee_report();
$search_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);
$smarty->assign('search_customers', $search_customers);
$smarty->assign('search_employees', $search_employees);

$search_cust_ids = $search_emp_ids = array();
if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}

if($current_year && $prev_month) {
    $current_unsigned_employees = get_unsigned_employee($current_year, $prev_month, $search_cust_ids, $search_emp_ids);
    $smarty->assign('current_unsigned_employees',$current_unsigned_employees);
    // echo "<pre>".print_r($current_unsigned_employees,1)."</pre>";
    // exit('dsf');
}



////////           ajax block to get unsigned employee ///////////////////
if(isset($_POST['action']) && $_POST['action'] == 'get_unsigned_employee'){
    $year  =  $_POST['year'];
    $month = $_POST['month'];
    $responce = get_unsigned_employee($year, $month, $search_cust_ids, $search_emp_ids);
    echo json_encode($responce);
    exit();
}
///////////////    end - ajax block to get unsigned employee  //////////////////////


function get_unsigned_employee($year, $month, $search_cust_ids, $search_emp_ids){
    if($year && $month){
        $obj_rpt_signing        = new report_signing();
        $not_signed_employees__ = $obj_rpt_signing->get_unsigned_employees($year, $month);
        $not_signed_employees   = array();
        
        if(!empty($not_signed_employees__)){
            foreach ($not_signed_employees__ as $key => $not_signed_emp) {
                if(empty($not_signed_employees[$not_signed_emp['employee']]['employee_details']))
                    $not_signed_employees[$not_signed_emp['employee']] = array('user_name' => $not_signed_emp['employee'], 'first_name' => $not_signed_emp['employee_fname'], 'last_name' => $not_signed_emp['employee_lname'], 'emp_mob' => $not_signed_emp['employee_mobile']);
            }
        }
        $list_unsigned_employees = filter_customer_employees_list_by_employee_have_work($not_signed_employees, $search_cust_ids, $search_emp_ids);
        
        $i = 0;
        foreach ($list_unsigned_employees as $key => $value) {
            if($i == 4)
                $i = 1;
            else  
                $i++;
              $chunked_unsigned_employee[$i][] =  $value;
        }
        $responce = array('status' =>TRUE, 'data' => $chunked_unsigned_employee);  
    }
    else{
        $responce = array('status' =>FALSE, 'data' => '');
    } 
    return $responce;
}

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$employee_list = $obj_user->get_users_for_chat($_SESSION['user_id'], $_SESSION['user_role'], NULL, 1);
$smarty->assign('employee_list', array());
// unset($employee_list['teams'][15]);
// unset($employee_list['teams'][14]);
// echo count($employee_list['teams']);
// echo "<pre>".print_r($employee_list,1)."</pre>"; exit();
$splitted_teams = array();
if(!empty($employee_list['teams'])){
    // header('Content-Type: text/plain') ;
    $employee_list['teams'] = array_values($employee_list['teams']);
    // echo '<pre>'.print_r($employee_list['teams'], 1).'</pre>'; exit();
    // $splitted_teams = array_chunk_vertical($employee_list['teams'], 4) ;
    $splitted_teams = array_chunk_vertical($employee_list['teams'], 4) ;
    // echo '<pre>'.print_r($splitted_teams, 1).'</pre>'; exit();
}

// var_dump($splitted_teams);
// exit('fgg');
$smarty->assign('splitted_teams', $splitted_teams);
// exit();
if($_REQUEST['mail_body']){
    
    $sms_message = '';
    $sms_process_flag = TRUE;
    $type = 'success';

    if($_REQUEST['mail_body'])
        $sms_message = urldecode($_REQUEST['mail_body']);
    

    //PUSH NOTIFICATION
    if(isset($_REQUEST['special_action']) && trim($_REQUEST['special_action']) == 'PUSH'){
        $obj_notification = new notification();
        $firebase_obj = new Firebase();
        // $firebase_push_obj = new FirebasePush();
        // $maximum_error_attemps_to_delete_token = 5;

        $notification_title = $smarty->translate['app_cirrus_sms_push_notification_title'];
        $notification_description = $sms_message;
        $notification_image = NULL; //notification image path | https://api.androidhive.info/images/minion.jpg

        $company_details = $employee->company_data();
        $notification_title = str_replace ('{{COMPANY_NAME}}', $company_details['name'] , $notification_title);
        // $sender_details = $employee->get_employee_detail($from_user);

        $users = $_REQUEST['mob_no'];
        $filtered_users_list = array();
        if(!empty($users)){
            foreach($users as $user_data){
                $user = substr($user_data,0,7);
                // $mobile = substr($user_data, 8);
                if(trim($user) != '' && trim($user) != '-')
                    $filtered_users_list[] = trim($user);
            }
            if(!empty($filtered_users_list))
                $filtered_users_list = array_unique($filtered_users_list);
        }

        $push_notify_flag = FALSE;
        if(!empty($filtered_users_list)){
            foreach($filtered_users_list as $to_user){
                $emp_tokens = $obj_notification->get_user_tokens($to_user);
                if(!empty($emp_tokens)){
                    $payload = array();
                    $firebase_obj->setTitle($notification_title);
                    $firebase_obj->setMessage($notification_description);
                    if ($notification_image != NULL)
                        $firebase_obj->setImage($notification_image);
                    else 
                        $firebase_obj->setImage('');
                    $firebase_obj->setIsBackground(FALSE);
                    $firebase_obj->setPayload($payload);
             
                    $json = $firebase_obj->getPush();
                    // echo "response notify: ".$ndata['employee']."<br/>";
                    foreach ($emp_tokens as $etoken) {

                        if($etoken['fcm_token'] == '') continue;

                        $regId = $etoken['fcm_token'];
                        $firebase_obj->setDbTokenRecord($etoken);
                        $response = $firebase_obj->send($regId, $json);
                        // echo "<pre>".print_r($response, 1)."<pre>";

                        $decoded_response = array();
                        if($response != '') $decoded_response = json_decode($response);
                        // echo "response notify: <pre>".print_r($decoded_response, 1)."<pre>";

                        if(!empty($decoded_response) && isset($decoded_response->success) && $decoded_response->success == 1){
                            $push_notify_flag = TRUE;
                        }
                    }
                }
            }
        }

        if($push_notify_flag)
            $messages->set_message('success', 'sms_push_send_sucess');
        else
            $messages->set_message('fail', 'sms_push_no_valid_devices');
    }

    //SMS
    else{
        $obj_sms = new sms($sms_message);
        $users = $_REQUEST['mob_no'];
        // echo "<pre>".print_r($users, 1)."</pre>";
        // exit('ddf');
        if(!empty($users)){
            foreach($users as $user_data){
                //echo $user_data;
                $user = substr($user_data,0,7);
                $mobile = substr($user_data, 8);
                $obj_sms->clearRecipients();
                if($mobile){
                    $obj_sms->addRecipient($mobile);
                    if(!$obj_sms->send()){
                        $sms_process_flag = FALSE;
                        $type = 'fail';
                    }
                    
                }
            }
        }
        
        if($sms_process_flag){
            $messages->set_message($type, 'sms_send_sucess');
        }else{
            $messages->set_message($type, 'sms_send_sucess');
        }
    }
}

function array_chunk_vertical($data, $columns) {
    $n = count($data) ;
    $per_column = floor($n / $columns) ;
    $rest = $n % $columns ;

    // The map
    $per_columns = array( ) ;
    for ( $i = 0 ; $i < $columns ; $i++ ) {
        $per_columns[$i] = $per_column + ($i < $rest ? 1 : 0) ;
    }
    // echo '<pre>'.print_r($per_columns, 1).'</pre>';
    $tabular = array( ) ;
    foreach ( $per_columns as $k => $rows ) {
        for ( $i = 0 ; $i < $rows ; $i++ ) {
            // $tabular[$i][ ] = array_shift($data) ;
            $tabular[$k][ ] = array_shift($data) ;
        }
    }
    // echo '<pre>'.print_r($tabular, 1).'</pre>'; exit();

    return $tabular ;
}
$month_num = $month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}


// var_dump($month_num,$month_name_short,$month_name_full); exit();

$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output_short", $month_name_short);
$smarty->assign("month_option_output_full", $month_name_full);
$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|sms_general.tpl');

function filter_customer_employees_list_by_employee_have_work($not_signed_employees, $allowed_customers = array(), $allowed_employees= array()){
 
    if (!empty($not_signed_employees)){
        foreach ($not_signed_employees as $this_employee => $not_signed_data) {
            if(!in_array($this_employee, $allowed_employees)){
                unset($not_signed_employees[$this_employee]);
                continue;
            }
        }
    }
    return $not_signed_employees;
}

?>