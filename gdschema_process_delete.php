<?php

/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * for: multiple delete gdschema slots interface (from b/w 2 weeks)
*/

require_once('class/setup.php');
require_once ('plugins/message.class.php');
//require_once('class/customer.php');
//require_once ('class/employee.php');
//require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$msg = new message();
//$date = new datecalc();
//$obj_cust = new customer();
//$obj_emp = new employee();

$year = date('Y')+1;
$first_monday = date('d',strtotime("first Monday of January ".$year));
$last_day = 31;
if($first_monday > 6){
    $last_day = $last_day - $first_monday;
}

$sel_slots = trim($_REQUEST['sel_slots']);
$sel_date = trim($_REQUEST['date']);
//$sel_slots_array = explode('-', $sel_slots);
//if($sel_slots == '-' || empty($sel_slots_array))
//    $selected_slot_details = $obj_emp->get_multiple_slot_details(NULL, $sel_date);
//else
//    $selected_slot_details = $obj_emp->get_multiple_slot_details($sel_slots_array, $sel_date);

//foreach($sel_slots_array as $key => $val){
//    if(trim($val) == '') unset ($sel_slots_array[$key]);
//}
//$need_popup_open = (!empty($selected_slot_details) ? 'TRUE' : 'FALSE');
//$smarty->assign('need_popup_open',$need_popup_open);

$smarty->assign('sel_slots',$sel_slots);
$smarty->assign('cur_week',date('W',strtotime($sel_date)));
$smarty->assign('cur_date',$sel_date);
$smarty->assign('cur_year_of_week',date('o',strtotime($sel_date)));

$smarty->assign('message', $msg->show_message()); //messages of actions
if(isset($_REQUEST['employee'])){
    $smarty->assign('employee',$_REQUEST['employee']);
}
if(isset($_REQUEST['customer'])){
    $smarty->assign('customer',$_REQUEST['customer']);
}

$smarty->assign('no_of_weeks',52);

$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_process_delete.tpl');
?>