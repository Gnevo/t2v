<?php
/**
 * Author: Shamsudheen<shamsu@arioninfotech.com>
 * for: multiple Assign employee/customer gdschema slots interface (from b/w 2 weeks)
*/

require_once ('class/setup.php');
require_once ('class/employee.php');
require_once ('class/company.php');
require_once ('plugins/message.class.php');
require_once ('class/customer.php');
require_once ('class/dona.php');
//require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$obj_emp = new employee();
$obj_company = new company();
$msg = new message();
$obj_cust = new customer();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
//$date = new datecalc();

//$year = date('Y')+1;
//$first_monday = date('d',strtotime("first Monday of January ".$year));
//$last_day = 31;
//if($first_monday > 6)
//    $last_day = $last_day - $first_monday;

//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
$sel_date = trim($_REQUEST['date']);    //selected date
$smarty->assign('cur_week',date('W',strtotime($sel_date)));
$smarty->assign('cur_date',$sel_date);
$cur_day = date('l',strtotime($sel_date));
$cur_day_figure = date('w',strtotime($sel_date));
$smarty->assign('cur_year_of_week',date('o',strtotime($sel_date)));
$smarty->assign('cur_day',$smarty->translate[strtolower($cur_day)]);
$smarty->assign('cur_day_figure',$cur_day_figure);
$smarty->assign('privilages',$obj_emp->get_privileges($_SESSION['user_id'], 1));

$action = 'employee_assignment';
//to display selected slot details
$multiple_slot_input = FALSE;
$__this_slot_info = array();
$atl_warning_check_flag = FALSE;

$__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : '';
$__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : '';
if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'drop'){
    //this block works, when user drag & drops time slot
    $action = 'drop';
    $time_from = trim($_REQUEST['time_from']);
    $time_to = trim($_REQUEST['time_to']);
    $slot_type = trim($_REQUEST['slotType']);
    $comment_textarea = trim($_REQUEST['comment_textarea']);
    $smarty->assign('time_from', $time_from);
    $smarty->assign('time_to', $time_to);
    $smarty->assign('slot_type', $slot_type);
    
    $slot_customer_name = $slot_employee_name = '';
    if($__slot_customer != ''){
        $__slot_customer_data = $obj_cust->customer_detail($__slot_customer);
        if($_SESSION['company_sort_by'] == 1)
            $slot_customer_name = $__slot_customer_data['first_name'] . ' ' . $__slot_customer_data['last_name'];
        elseif($_SESSION['company_sort_by'] == 2)
            $slot_customer_name = $__slot_customer_data['last_name'] . ' ' . $__slot_customer_data['first_name'];
    }
    if($__slot_employee != ''){
        $__slot_employee_data = $obj_emp->get_employee_detail($__slot_employee);
        if($_SESSION['company_sort_by'] == 1)
            $slot_employee_name = $__slot_employee_data['first_name'] . ' ' . $__slot_employee_data['last_name'];
        elseif($_SESSION['company_sort_by'] == 2)
            $slot_employee_name = $__slot_employee_data['last_name'] . ' ' . $__slot_employee_data['first_name'];
    }
    $__this_slot_info = array(
        'time_from' => sprintf('%.02f',$time_from),
        'time_to'   => sprintf('%.02f',$time_to),
        'comment_textarea'   => $comment_textarea,
        'slot_hour' => $obj_emp->time_difference($time_from, $time_to, 100),
        'fkkn'      => 1,
        'status'    => ($__slot_customer != '' && $__slot_employee != '' ? 1 : 0),
        'type'      => $slot_type,
        'customer'  => $__slot_customer,
        'employee'  => $__slot_employee,
        'cust_name' => $slot_customer_name, 
        'emp_name'  => $slot_employee_name
    );
    $atl_warning_check_flag = ($__slot_customer != '' && $__slot_employee != '') ? TRUE : FALSE;
}
else if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'man_slot_entry'){
    //this block works, when user manually enter time slot period
    $action = 'man_slot_entry';
    
    if ($_REQUEST['sub_action'] == 'multiple_add') {
        $dona = new dona();
        
        $slot_customer_name = $slot_employee_name = '';
        $smarty->assign('sub_action', 'multiple_add');
        
        $customer_to_add = trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
        
        $employee_to_add = trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
        if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
        
        $selected_date = trim($_REQUEST['date']);
        $slot_periods = array();
        $need_atl_checking = FALSE;
        
        if(!empty($_REQUEST['time_slots'])){
            foreach($_REQUEST['time_slots'] as $time_slot){
                
                $tmp_time_from  = $dona->time_to_sixty(trim($time_slot['time_from']));
                $tmp_time_to    = $dona->time_to_sixty(trim($time_slot['time_to']));
                if($tmp_time_to == 0) $tmp_time_to = 24;

                if($tmp_time_from != false && $tmp_time_to != false){
                    
                    $_tmp_customer = $customer_to_add != NULL ? $customer_to_add : trim($time_slot['customer']);
                    $_tmp_employee = $employee_to_add != NULL ? $employee_to_add : trim($time_slot['employee']);
                    //if the slot enters next day
                    if($tmp_time_from >= $tmp_time_to) $multiple_slot_input = TRUE;
                    if($_tmp_customer != '' && $_tmp_employee != '') $need_atl_checking = TRUE;

                    $slot_periods[] = array( 
                            'time_from' => sprintf('%.02f', $tmp_time_from), 
                            'time_to'   => sprintf('%.02f', $tmp_time_to), 
                            'customer'  => $_tmp_customer,
                            'employee'  => $_tmp_employee,
                            'comment'   => trim($time_slot['comment']),
                            'fkkn'      => trim($time_slot['fkkn']),
                            'type'      => trim($time_slot['type']) 
                        );
                }
            }
            
            if(count($slot_periods) > 1) $multiple_slot_input = TRUE;
            
            if(!empty($slot_periods)){
                if($slot_periods[0]['customer'] != ''){
                    $__slot_customer_data = $obj_cust->customer_detail($slot_periods[0]['customer']);
                    if($_SESSION['company_sort_by'] == 1)
                        $slot_customer_name = $__slot_customer_data['first_name'] . ' ' . $__slot_customer_data['last_name'];
                    elseif($_SESSION['company_sort_by'] == 2)
                        $slot_customer_name = $__slot_customer_data['last_name'] . ' ' . $__slot_customer_data['first_name'];
                }
                if($slot_periods[0]['employee'] != ''){
                    $__slot_employee_data = $obj_emp->get_employee_detail($slot_periods[0]['employee']);
                    if($_SESSION['company_sort_by'] == 1)
                        $slot_employee_name = $__slot_employee_data['first_name'] . ' ' . $__slot_employee_data['last_name'];
                    elseif($_SESSION['company_sort_by'] == 2)
                        $slot_employee_name = $__slot_employee_data['last_name'] . ' ' . $__slot_employee_data['first_name'];
                }
                
                $__this_slot_info = array(
                    'time_from' => sprintf('%.02f',$slot_periods[0]['time_from']),
                    'time_to'   => sprintf('%.02f',$slot_periods[0]['time_to']),
                    'comment_textarea'   => $slot_periods[0]['comment'],
                    'slot_hour' => $obj_emp->time_difference((float) $slot_periods[0]['time_from'], (float) $slot_periods[0]['time_to'], 100),
                    'fkkn'      => $slot_periods[0]['fkkn'],
                    'status'    => ($slot_periods[0]['customer'] != '' && $slot_periods[0]['employee'] != '' ? 1 : 0),
                    'type'      => $slot_periods[0]['type'],
                    'customer'  => $slot_periods[0]['customer'],
                    'employee'  => $slot_periods[0]['employee'],
                    'cust_name' => $slot_customer_name, 
                    'emp_name'  => $slot_employee_name
                );
            }
        }
        $atl_warning_check_flag = $need_atl_checking;
    } 
    else {
        $temp_time_from = $time_from = trim($_REQUEST['time_from']);
        $temp_time_to = $time_to = trim($_REQUEST['time_to']);
        $comment_textarea = trim($_REQUEST['comment_textarea']); 
        $slot_customer_name = $slot_employee_name = '';

        $_REQUEST['memslottype'] = trim($_REQUEST['memslottype']) != '' ? trim($_REQUEST['memslottype']) : 0;
        $slot_fkkn = trim($_REQUEST['slot_fkkn']) != '' ? trim($_REQUEST['slot_fkkn']) : 1;
        $__slot_employee = trim($_REQUEST['slot_employee']) != '' ? trim($_REQUEST['slot_employee']) : NULL;
        if ($_SESSION['user_role'] == 3)  $__slot_employee = $_SESSION['user_id'];
        $__slot_customer = trim($_REQUEST['slot_customer']) != '' ? trim($_REQUEST['slot_customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $__slot_customer = $_SESSION['user_id'];

        if($__slot_customer != ''){
            $__slot_customer_data = $obj_cust->customer_detail($__slot_customer);
            if($_SESSION['company_sort_by'] == 1)
                $slot_customer_name = $__slot_customer_data['first_name'] . ' ' . $__slot_customer_data['last_name'];
            elseif($_SESSION['company_sort_by'] == 2)
                $slot_customer_name = $__slot_customer_data['last_name'] . ' ' . $__slot_customer_data['first_name'];
        }
        if($__slot_employee != ''){
            $__slot_employee_data = $obj_emp->get_employee_detail($__slot_employee);
            if($_SESSION['company_sort_by'] == 1)
                $slot_employee_name = $__slot_employee_data['first_name'] . ' ' . $__slot_employee_data['last_name'];
            elseif($_SESSION['company_sort_by'] == 2)
                $slot_employee_name = $__slot_employee_data['last_name'] . ' ' . $__slot_employee_data['first_name'];
        }
        if($time_from > $time_to){
            $temp_time_from = $time_from;
            $temp_time_to = 24;
            $multiple_slot_input = TRUE;
        }
        $__this_slot_info = array(
            'time_from' => sprintf('%.02f',$temp_time_from),
            'time_to'   => sprintf('%.02f',$temp_time_to),
            'comment_textarea'   => $comment_textarea,
            'slot_hour' => $obj_emp->time_difference($temp_time_from, $temp_time_to, 100),
            'fkkn'      => $slot_fkkn,
            'status'    => ($__slot_customer != '' && $__slot_employee != '' ? 1 : 0),
            'type'      => trim($_REQUEST['memslottype']),
            'customer'  => $__slot_customer,
            'employee'  => $__slot_employee,
            'cust_name' => $slot_customer_name, 
            'emp_name'  => $slot_employee_name
        );
        $atl_warning_check_flag = ($__slot_customer != '' && $__slot_employee != '') ? TRUE : FALSE;
    }
}
else if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'multiple_slot_assign'){
    //this block works, when user click employee for slot assignment
    $action = 'employee_assignment';
    $comment_textarea = trim($_REQUEST['comment_textarea']);
    $sel_employee_to_assign = trim($_REQUEST['empl']);    //selected employee to assign
    //$sel_customer = trim($_REQUEST['customer']);    //selected customer
    //$sel_employee = trim($_REQUEST['employee']);    //selected employee
    //$sel_action = trim($_REQUEST['action']);    //selected action
    $__slot_employee = $sel_employee_to_assign != '' ? $sel_employee_to_assign : '';

    $smarty->assign('sel_employee_to_assign',$sel_employee_to_assign);
    $__slot_employee_data = $obj_emp->get_employee_detail($sel_employee_to_assign);
    $smarty->assign('assign_employee_details', $__slot_employee_data);
    
    //to display selected slot details
    if(isset($_REQUEST['ids']) && trim($_REQUEST['ids']) != ''){
        $selected_slot_ids = explode(',', trim($_REQUEST['ids']));
        if(count($selected_slot_ids) > 0){
//            $multiple_slot_input = FALSE;
            $selected_slot_details = $obj_emp->customer_employee_slot_details($selected_slot_ids[0]);
            $slot_customer_name = '';
            if($__slot_customer != ''){
                $__slot_customer_data = $obj_cust->customer_detail($__slot_customer);
                if($_SESSION['company_sort_by'] == 1)
                    $slot_customer_name = $__slot_customer_data['first_name'] . ' ' . $__slot_customer_data['last_name'];
                elseif($_SESSION['company_sort_by'] == 2)
                    $slot_customer_name = $__slot_customer_data['last_name'] . ' ' . $__slot_customer_data['first_name'];
            }
            if($_SESSION['company_sort_by'] == 1)
                $slot_employee_name = $__slot_employee_data['first_name'] . ' ' . $__slot_employee_data['last_name'];
            elseif($_SESSION['company_sort_by'] == 2)
                $slot_employee_name = $__slot_employee_data['last_name'] . ' ' . $__slot_employee_data['first_name'];
            $__this_slot_info = array(
                'time_from' => $selected_slot_details['time_from'],
                'time_to'   => $selected_slot_details['time_to'],
                'comment_textarea'   => $comment_textarea,
                'slot_hour' => $obj_emp->time_difference($selected_slot_details['time_from'], $selected_slot_details['time_to'], 100),
                'fkkn'      => $selected_slot_details['fkkn'],
                'status'    => 1,
                'type'      => $selected_slot_details['type'],
                'customer'  => $selected_slot_details['customer'],
                'employee'  => $__slot_employee,
                'cust_name' => $slot_customer_name, 
                'emp_name'  => $slot_employee_name
            );
        }
        if(count($selected_slot_ids) > 1)
            $multiple_slot_input = TRUE;
    }
    $atl_warning_check_flag = ($__slot_customer != '' && $__slot_employee != '') ? TRUE : FALSE;
}
$smarty->assign('message', $msg->show_message()); //messages of actions

$url_data = array();
if(!empty($_REQUEST)){
    foreach($_REQUEST as $key => $val)
        $url_data[] = $key . '=' . $val;
}

$url_data = implode('&', $url_data);
$smarty->assign('url_data',$url_data);
$smarty->assign('emp_role',$_SESSION['user_role']);
$smarty->assign('no_of_weeks', 52);
$smarty->assign('action', $action);

$smarty->assign('atl_warning_check_flag', $atl_warning_check_flag);

//to display selected slot details
$smarty->assign('multiple_slot_input_flag', $multiple_slot_input);
//if(!$multiple_slot_input){
    $smarty->assign('this_slot_info', $__this_slot_info);
//    echo "<pre>".print_r($__this_slot_info, 1)."</pre>";
//}

/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_process_schemaAssign.tpl');
?>