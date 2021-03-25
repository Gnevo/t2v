<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once ('class/customer.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
$employee = new employee();
$customer = new customer();
$msg = new message();

$url = '';
if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['customer']) != '')
    $url = $smarty->url . 'month/gdschema/'.trim($_REQUEST['sel_year']).'/'.trim($_REQUEST['sel_month']).'/'.trim($_REQUEST['customer']).'/';
else if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['employee']) != '')
    $url = $smarty->url . 'month/gdschema/employee/'.trim($_REQUEST['sel_year']).'/'.trim($_REQUEST['sel_month']).'/'.trim($_REQUEST['employee']).'/';
else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_alloc_window' && trim($_REQUEST['customer']) != '')
    $url = $smarty->url . 'gdschema_alloc_window.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['page_date'];
else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_alloc_window' && trim($_REQUEST['employee']) != '')
    $url = $smarty->url . 'gdschema_alloc_window_employee.php?employee='.$_REQUEST['employee'].'&date='.$_REQUEST['page_date'];
else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_timeline_customer' && trim($_REQUEST['customer']) != '')
    $url = $smarty->url . 'gdschema_day_customer.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['page_date'].'&action=1';
else if (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_timeline_employee' && trim($_REQUEST['employee']) != '')
    $url = $smarty->url . 'gdschema_day_employee.php?employee='.$_REQUEST['employee'].'&date='.$_REQUEST['page_date'].'&action=1';
else if (trim($_REQUEST['customer']) != '' || (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_customer'))
    $url = $smarty->url . 'customer/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['customer'].'/8/';
else if (trim($_REQUEST['employee']) != '' || (isset($_REQUEST['request_from']) && $_REQUEST['request_from'] == 'gd_employee'))
    $url = $smarty->url . 'employee/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['employee'].'/8/';

$action = '';
if (trim($_REQUEST['employee_username']) != '')
    $action = 'emploee_add';
else if (trim($_REQUEST['customer_select']) != '')
    $action = 'customer_add';

$process_flag = TRUE;
$slot_ids = explode("-", $_REQUEST['ids']);
$alloc_emp = $_SESSION['user_id'];


//------------------------------------------------------------------------------------

if($action == 'emploee_add'){
    
    $select_emp = $_REQUEST['employee_username'];
    if(!empty($slot_ids)){
        foreach ($slot_ids as $slot_id) {
            if($slot_id == '') continue;
            $slot_det = $customer->customer_employee_slot_details($slot_id);

            if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {
                if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
                    $process_flag = FALSE;
                    break;
                }
            }
            if(!$process_flag) break;

            $process_params = array(
                                'employee'      =>  $select_emp,
                                'customer'      =>  $slot_det['customer'], 
                                'date'          =>  $slot_det['date'], 
                                'time_from'     =>  $slot_det['time_from'], 
                                'time_to'       =>  $slot_det['time_to']); 

            if(!$employee->findout_slot_alteration_bug($process_params)){
                $process_flag = false;
                break;
            }
        }
    }
    $ids = str_replace("-", ",", $_REQUEST['ids']);

    if($process_flag){
        if($employee->employee_add_to_slot_multiple($ids, $select_emp, $alloc_emp))
            $msg->set_message('success', 'slot_employee_change_success');
        else
            $msg->set_message('fail', 'slot_employee_change_fail');
    }
    
}

else if($action == 'customer_add'){
    
    $select_cust = $_REQUEST['customer_select'];
    if(!empty($slot_ids)){
        $customer->begin_transaction();
        foreach ($slot_ids as $slot_id) {
            if($slot_id == '') continue;
            $slot_det = $customer->customer_employee_slot_details($slot_id);
            
            if ($slot_det['employee'] != '' && $slot_det['customer'] != '') {
                if ($employee->chk_employee_rpt_signed($slot_det['employee'], $slot_det['customer'], $slot_det['date'], TRUE)) {   //check already signed
                    $process_flag = FALSE;
                    break;
                }
            }
            
            if(!$process_flag) break;
            
            $process_params = array(
                                'employee'      =>  $slot_det['employee'],
                                'customer'      =>  $select_cust, 
                                'date'          =>  $slot_det['date'], 
                                'type'          =>  $slot_det['type'], 
                                'time_from'     =>  $slot_det['time_from'], 
                                'time_to'       =>  $slot_det['time_to']); 

            if(!$employee->findout_slot_alteration_bug($process_params, array($slot_id))){
                $process_flag = false;
                break;
            }
            
            if(!$customer->customer_add_to_slot($slot_id, $select_cust, $alloc_emp)){
                $process_flag = false;
                $msg->set_message('fail', 'slot_customer_change_fail');
                break;
            }
        }
        
        if($process_flag){
            $customer->commit_transaction ();
            $msg->set_message('success', 'slot_customer_change_success');
        }else
            $customer->rollback_transaction ();
    }
}

if(!isset($_REQUEST['no_refresh_whole']) || $_REQUEST['no_refresh_whole'] != 'TRUE'){
    header('Location: '.$url);
}
/*$ch = curl_init();
if ($ch){
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_SERVER['QUERY_STRING']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true );
    curl_setopt($ch, CURLOPT_COOKIE, $_SERVER['HTTP_COOKIE']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-type: application/x-www-form-urlencoded;charset=utf-8');
    echo $response = curl_exec($ch);
    curl_close($ch);
}*/
?>