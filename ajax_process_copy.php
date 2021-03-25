<?php

require_once('class/setup.php');
//require_once ('class/dona.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
$msg = new message();
//$obj_cust = new customer();
$obj_emp = new employee();
//$dona = new dona();
$smarty = new smartySetup(array('messages.xml'), FALSE);

$slots = array();
$smarty->assign('emp_role', $_SESSION['user_role']);
if($_REQUEST['customer'] != '' && $_REQUEST['employee'] != ''){
    $url = $smarty->url . 'gdschema_process_copy.php?customer='.$_REQUEST['customer'].'&employee='.$_REQUEST['employee'].'&date='.$_REQUEST['date'];
    $slots = $obj_emp->timetable_customer_employee_slots_copiable_with_options($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['with_user']);
}else if($_REQUEST['customer'] !='' && $_REQUEST['employee'] == ''){
    $url = $smarty->url . 'gdschema_process_copy.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['date'];
     $slots = $obj_emp->timetable_customer_employee_slots_copiable_with_options($_REQUEST['customer'], '', $_REQUEST['date'],$_REQUEST['with_user']);
}    
else if($_REQUEST['customer'] =='' && $_REQUEST['employee'] != ''){
    $slots = $obj_emp->timetable_customer_employee_slots_copiable_with_options('', $_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['with_user']);
    $url = $smarty->url . 'gdschema_process_copy.php?&employee='.$_REQUEST['employee'].'&date='.$_REQUEST['date'];
}    

$days = explode('-', $_REQUEST['days']);
array_pop($days);
    
   
    if($obj_emp->copy_multiple_slot_to_multiple($slots, $_REQUEST['from_week'], $_REQUEST['to_week'], $_REQUEST['from_option'], $_REQUEST['with_user'], $days, $_REQUEST['date'])){
        
        //echo '<script>loadContentCopy(\'' . $url . '\')</script>';
        echo $msg->show_message();
        if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                $obj_emp->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
        
    }else{
        echo $msg->show_message();
        //echo '<script>loadContentCopy(\'' . $url . '\')</script>';
    }
?>