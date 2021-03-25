<?php
require_once('class/setup.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('class/dona.php');
//require_once ('class/dona.php');
//require_once ('class/customer.php');

$msg = new message();
$obj_emp = new employee();
$obj_dona = new dona();
//$obj_cust = new customer();
//$dona = new dona();
$smarty = new smartySetup(array('messages.xml',"button.xml", "month.xml"), FALSE);
//$url = $smarty->url . 'gdschema_process_main.php?type='.$_REQUEST['type'].'&cur_week='.date('Y').'-'.$_REQUEST['cur_week'].'&user='.$_REQUEST['user'];

if($_REQUEST['type'] == 'copy'){
    unset($_SESSION['fkkn']);
    $copy_start_date = date('Y-m-d H:i:s', strtotime(substr($_REQUEST['cur_week'],0,4)."W".str_pad($_REQUEST['from_week'],2,'0',STR_PAD_LEFT).'1'));
    $copy_start_date_minus = date('Y-m-d H:i:s',strtotime($copy_start_date .' -1 day'));
    $copy_end_date = date('Y-m-d H:i:s', strtotime($copy_start_date_minus.' +'.str_pad($_REQUEST['no_of_weeks'],2,'0',STR_PAD_LEFT).' week'));
    //$copy_end_date = date('Y-m-d H:i:s', strtotime('next sunday',  mktime(0, 0, 0, substr($copy_end_date, 5,2),substr($copy_end_date, 8,2),substr($copy_end_date, 0,4))));
    $paste_year = substr($_REQUEST['to_week'],0,4);
    $paste_week = str_pad(substr($_REQUEST['to_week'],5), 2,'0',STR_PAD_LEFT);
    
    $paste_start_date = date('Y-m-d H:i:s', strtotime($paste_year."W".$paste_week.'1'));
    $paste_start_date_minus = date('Y-m-d H:i:s',strtotime($paste_start_date .' -1 day'));
    $paste_end_date = date('Y-m-d H:i:s', strtotime($paste_start_date_minus.' +'.str_pad(($_REQUEST['no_of_weeks']*$_REQUEST['no_of_times']),2,'0',STR_PAD_LEFT).' week'));
    //$paste_end_date = date('Y-m-d H:i:s', strtotime('next sunday',  mktime(0, 0, 0, substr($paste_end_date, 5,2),substr($paste_end_date, 8,2),substr($paste_end_date, 0,4))));
    //echo "<script>alert(\"".$_REQUEST['employees']."\")</script>";
    $employees = explode('-', $_REQUEST['employees']);
    array_pop($employees);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    //echo $paste_start_date."--".$paste_end_date; 
     
    if($obj_emp->copy_weeks($copy_start_date, $copy_end_date, $paste_start_date, $paste_end_date, $_REQUEST['no_of_times'],$employees, $days,$_REQUEST['with_user'],$_REQUEST['user'], $_REQUEST['unmanned'])){
        //echo '<script>loadContent(\'' . $url . '\')</script>';
        echo $msg->show_message();
        if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                $obj_emp->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
        
    }else{
        //echo '<script>loadContent(\'' . $url . '\')</script>';
        echo $msg->show_message();
    }
    //echo '<script>$("#loading").hide()</script>';
        
}
elseif($_REQUEST['type'] == 'delet'){
    $del_start_date = date('Y-m-d', strtotime(substr($_REQUEST['cur_week'],0,4)."W".str_pad($_REQUEST['from_week'],2,'0',STR_PAD_LEFT).'1'));
    $del_start_date_minus = date('Y-m-d',strtotime($del_start_date .' -1 day'));
    $del_end_date = date('Y-m-d', strtotime($del_start_date_minus.' +'.str_pad($_REQUEST['no_of_weeks'],2,'0',STR_PAD_LEFT).' week'));
    //$del_end_date = date('Y-m-d', strtotime('next sunday',  mktime(0, 0, 0, substr($del_end_date, 5,2),substr($del_end_date, 8,2),substr($del_end_date, 0,4))));
    //echo "<script>alert(\"".$del_start_date."\")</script>";     
      
    $employees = explode('-', $_REQUEST['employees']);
    array_pop($employees);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
   
    if($obj_emp->delete_weeks($del_start_date, $del_end_date, $employees, $days, $_REQUEST['focus'], $_REQUEST['user'], $_REQUEST['unmanned'])){
        //echo '<script>loadContent(\'' . $url . '\')</script>';
        //echo $msg->show_message();
    }else{
        //echo '<script>loadContent(\'' . $url . '\')</script>';
        //echo $msg->show_message();
    }
    //echo '<script>$("#loading").hide()</script>';
        
}
elseif($_REQUEST['type'] == 'load'){
    
    $employees = $obj_emp->employee_list_exact($_REQUEST['employee']);
    foreach($employees as $employee){
        if($employee['username'] != $_REQUEST['employee'])
            echo '<input type="radio" class="rep_radio_rep" name="employee" value = "'.$employee['username'].'">'.$employee['first_name'].' '.$employee['last_name'].'<br />';
    }
}
elseif($_REQUEST['type'] == 'rep_emp_load'){
    
    $start_date = trim($_REQUEST['start_date']);
    $end_date = trim($_REQUEST['end_date']);
    $selected_emp = trim($_REQUEST['selected_emp']);
    $sel_customer = trim($_REQUEST['sel_customer']);
    
    $is_customer_checked = trim($_REQUEST['is_customer_checked']);
    $considered_customer = $is_customer_checked == 1 ? $sel_customer : NULL;
    
    if($start_date != '' && $end_date != '' && $selected_emp != ''){
        $replacing_slots = $obj_dona->get_employee_slots_btwn_dates($selected_emp, $start_date, $end_date, $considered_customer);
//        echo "<pre>".print_r($replacing_slots, 1)."</pre>";
        $avail_employees = array();
        $temp_emps_prev = array();
        if(!empty($replacing_slots)){
            foreach ($replacing_slots as $slot_data) {
                    $avail_replace_employees = $obj_emp->get_available_users($slot_data['customer'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['date']);
                    if(!empty($avail_replace_employees)) {
                        if(empty($avail_employees)){
                            foreach($avail_replace_employees as $avail_replace_employee){
                                $avail_employees[$avail_replace_employee['username']] = $avail_replace_employee;
                            }
                        }else{
                            $temp_emps_prev = array();
                            foreach($avail_replace_employees as $avail_replace_employee){
                                $temp_emps_prev[] = $avail_replace_employee['username'];
                            }
                            foreach($avail_employees as $key => $value){
                                if(!in_array($key, $temp_emps_prev))
                                    unset($avail_employees[$key]);
                            }
                        }
                    }else{
                        $avail_employees = array();
                        break;
                    }
            }
        }
//        echo "<pre>".print_r($avail_employees, 1)."</pre>";
        
        if(!empty($avail_employees)){
            foreach($avail_employees as $employee){
                if($employee['username'] != $selected_emp)
                    echo '<label><input type="radio" class="rep_radio_rep" name="employee" value = "'.$employee['username'].'">'.$employee['name'].'</label><br />';
            }
        } else {
            echo '<div class="info_name" style="width: 91%;">'.$smarty->translate['no_available_employees_for_replacement'].'</div>';
        }
    }
    
    /*$employees = $obj_emp->employee_list_exact($sel_customer);
    foreach($employees as $employee){
        if($employee['username'] != $_REQUEST['employee'])
            echo '<input type="radio" class="rep_radio_rep" name="employee" value = "'.$employee['username'].'">'.$employee['first_name'].' '.$employee['last_name'].'<br />';
    }*/
    
//    if($emp_list = $obj_emp->employee_list_for_process($_REQUEST['start_date'], $_REQUEST['end_date'], $_REQUEST['user'])){
//        $smarty->assign('employee_details',$emp_list);
//        $smarty->assign('type','rep');
//    }
}
elseif($_REQUEST['type'] == 'replace'){
    
    $transaction_result = $obj_emp->replace_employee($_REQUEST['from_date'], $_REQUEST['to_date'], $_REQUEST['employee'], $_REQUEST['employee_rep'], $_REQUEST['focus'], $_REQUEST['user']);
//        if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
//                $obj_emp->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
    
    if(isset($_REQUEST['request_from']) && ($_REQUEST['request_from'] == 'monthly_view' || $_REQUEST['request_from'] == 'gd_customer' || $_REQUEST['request_from'] == 'gd_alloc_window' || $_REQUEST['request_from'] == 'gd_employee' || $_REQUEST['request_from'] == 'gd_timeline_customer' || $_REQUEST['request_from'] == 'gd_timeline_employee')){
        $obj_return = new stdClass();
        $obj_return->result = $transaction_result;
        if(!$transaction_result)
            $obj_return->message = $msg->show_message();
        echo json_encode($obj_return);
        exit();
    }
    else
        echo $msg->show_message();
//    echo '<script>$("#loading").hide()</script>';
}
elseif($_REQUEST['type'] == 'atl'){
    
    $employees = explode('-', $_REQUEST['employees']);
    array_pop($employees);
    $atl_warnings = array();
    $j =0;
    $k =0;
    echo "<ul>";
    foreach ($employees as $employee){
        $j++;
        $atl_warnings = $obj_dona->checkATL_monthly($employee, substr($_REQUEST['year_month'],5), substr($_REQUEST['year_month'],0,4));
        $i = 0;
        foreach ($atl_warnings as $atl_warning) {
            $k++;
            $i++;
            if($i == 1){
                echo '<li class="atl_warnings heads">'.$j.'. '.$atl_warning['employee_name'].'</span></li>';
            }
            $class = 'atl_warnings';
            if($i%2 != 0)
                $class = 'atl_warnings bagcolor';
            
            echo '<li class="'.$class.'">'.$i.'. '.$atl_warning['atl_message'].'</li>';
            
            if(isset($atl_warning['intervals'])){
                $interval_weeks = $atl_warning['intervals'];
                foreach ($interval_weeks as $key => $value) {
                    echo '<li class="'.$class.'" style="padding-left:25px; color:#FF0000;">'. $key . ' ' . $smarty->translate['hours_gap'] . ' '. $value['start'] . ' ' . $smarty->translate['and'] . ' ' . $value['end'] .'</li>';
                    break;
                }
            }

        }
    }
    echo "</ul>";
    if($k == 0){
        echo '<div class="message">'.$smarty->translate['no_atl_warnings']."</div>";
    }
}
?>