<?php
/*
 * this page is executed when click on slot to edit.
 * copy from right panel.
 * delete from right panel.
 * spliting time slots.
*/
require_once('class/user.php');
require_once('class/template.php');
require_once ('plugins/message.class.php');
require_once('class/dona.php');

$obj_user = new user();
$obj_tmp  = new template();
$msg      = new message();
$dona     = new dona();

if ($_REQUEST['action'] == 'copy') {

    $obj_user->add_to_temp_session(implode(",", array($_REQUEST['id'])), 1);
}

//removing the whole slot
else if ($_REQUEST['action'] == 'slot_remove') {
    if ($obj_tmp->customer_employee_slot_remove($_REQUEST['id'])){
        $msg->set_message('success', 'slot_delete_success');
    }
    else {
        $msg->set_message('fail', 'slot_delete_failed');
    }
}

//splitting time slot
else if ($_REQUEST['action'] == 'split') {//adding type
    $slot_from  = $_REQUEST['slot_from'];
    $slot_to    = $_REQUEST['slot_to'];
    $time_from  = $dona->time_to_sixty($_REQUEST['time_from']);
    $time_to    = $dona->time_to_sixty($_REQUEST['time_to']);
    if ($time_to == 0) { $time_to = 24; }
    if ($time_from >= $slot_from && $time_from <= $slot_to && $time_to >= $slot_from && $time_to <= $slot_to) {
        if ($obj_tmp->employee_slot_split($_REQUEST['id'], $time_from, $time_to)) {
            $msg->set_message('success', 'slot_splitted_successfully');
        }  else
            $msg->set_message('fail', 'slot_split_fail');
    } else {
        $msg->set_message('fail', 'not_within_slot');
    }
    
}

else if ($_REQUEST['action'] == 'copy_multiple') {
    unset($_SESSION['fkkn']);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $obj_tmp->copy_single_slot_to_multiple($_REQUEST['template_id'],$_REQUEST['id'],$_REQUEST['from_week'], $_REQUEST['to_week'], $_REQUEST['from_option'], $_REQUEST['with_user'], $days);
    
}
?>