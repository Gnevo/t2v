<?php

session_start();
$app_dir = dirname(dirname(realpath(__FILE__)));
chdir($app_dir);
require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/employee.php');
require_once('class/sms.php');
$smarty = new smartySetup(array("user.xml", "gdschema.xml", "month.xml", "button.xml", "messages.xml", "mail.xml"), FALSE);
$obj_emp = new employee();
$leave = new leave();

$obj = new stdClass();
$flag = 1;
$sms_message = '%0A' . $smarty->translate['customer'] . ' : ' . $_REQUEST['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $_REQUEST['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $_REQUEST['slot_time'];
if ($_REQUEST['message'])
    $sms_message .= '%0A' . $_REQUEST['message'];
if ($_REQUEST['sender'] == 1) {
    $sms_message .= '%0A' . $smarty->translate['shift_accepted'];
    $obj_sms = new sms($sms_message);
    if ($mobile = $leave->get_employee_mobile($_REQUEST['employee'])) {
        $obj_sms->addRecipient($mobile);
    }
    if (!$obj_sms->send())
        $flag = 0;
}
if ($_REQUEST['rejection'] == 1) {
    $sms_message .= '%0A' . $smarty->translate['shift_rejected'];
    $leave->tables = array('leave_sms');
    $leave->fields = array('employee');
    $leave->conditions = array('AND', 'slot = ?', 'employee != ?');
    $leave->condition_values = array($_REQUEST['id'], $_REQUEST['employee']);
    $leave->query_generate();
    $datas = $leave->query_fetch();
    $obj_sms = new sms($sms_message);
    foreach ($datas as $data) {
        if ($mobile = $leave->get_employee_mobile($data['employee'])) {
            $obj_sms->addRecipient($mobile);
        }
    }
    if ($flag == 1) {
        if (!$obj_sms->send())
            $flag = 0;
    }
}
if ($flag == 1) {
    
    
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    if ($leave->update_sms_records_accept($_REQUEST['id'], $_REQUEST['employee'], 1, $slot_det['status'])) {
	$obj->success = true;
    } else {
        $obj->success = false;
    }
}
echo json_encode($obj);
?>