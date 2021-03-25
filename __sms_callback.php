<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/sms.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", "messages.xml",'mail.xml'), FALSE);
$date = new datecalc();
$employee = new employee();
$customer = new customer();
$msg = new message();
$leave = new leave();
$obj_sms = new sms('');
global $db;

$type = $_REQUEST['type'];
$type = 0;
if ($type == 0) {
    $leave->select_db($db['database_master']);
    $user_number = substr($_REQUEST['number'], 2);
    $time = $_REQUEST['time'];
    $slot_id = $_REQUEST['tag'];
    $reply_msg = '';
    if ($type == 0) {
        $reply_msg = $_REQUEST['msg'];
    }
    $test = $_SERVER['QUERY_STRING'];
     /*$user_number = 704434964;
      $time = date('Y-m-d H:i:s',time());
      $type = 0;
      $slot_id = 1150;
      $reply_msg = 'yes'; */

    $tmpw = date("Y-m-d H:i:s", time()) . "\n";
    $filename = "check.txt";
    if (file_exists($filename) && is_writable($filename)) {
        if ($handle = fopen($filename, 'a')) {
            fwrite($handle, $test);
            if (fwrite($handle, $tmpw) == FALSE)
                echo "Cannot write to file ($filename)";
            fclose($handle);
        }
    }

    if (strtolower(trim($reply_msg)) == 'yes' || preg_match('/Ja|ja|j/', $reply_msg)) {
        $leave->tables = array('login');
        $leave->fields = array('company_ids', 'username');
        $leave->conditions = array('mobile = ?');
        $leave->condition_values = array($user_number);
        $leave->query_generate();
        $datas = $leave->query_fetch();
        $company_ids = explode(',', $datas[0]['company_ids']);
        array_pop($company_ids);
        foreach ($company_ids as $company_id) {
            $leave->tables = array('company');
            $leave->fields = array('db_name');
            $leave->conditions = array('id = ?');
            $leave->condition_values = array($company_id);
            $leave->query_generate();
            $db_datas = $leave->query_fetch();
            $leave->select_db($db_datas[0]['db_name']);
            $employee->select_db($db_datas[0]['db_name']);

            $leave->tables = array('leave_sms');
            $leave->fields = array('id');
            $leave->conditions = array('AND','slot = ?', 'status = 1');
            $leave->condition_values = array($slot_id);
            $leave->query_generate();
            
            
            $leave_sms_status = $leave->query_fetch();
            
            if (empty($leave_sms_status)) {
                // getting the sms status
                $leave->tables = array('leave_sms');
                $leave->fields = array('status', 'alloc_employee');
                $leave->conditions = array('AND','slot = ?', 'employee = ?');
                $leave->condition_values = array($slot_id, $datas[0]['username']);
                $leave->query_generate();
                
                    
                
                
                $leave_sms_datas = $leave->query_fetch();
                $leave->begin_transaction();
                
                $handle = fopen($filename, 'a');
                fwrite($handle, $datas[0]['username']."\n");
                fclose($handle);
                if ($leave_sms_datas[0]['status'] == 0) {
                    $leave->update_sms_records_reply($slot_id, $datas[0]['username'], $time, 3);
                }else if($leave_sms_datas[0]['status'] == 4){
                    if ($leave->update_sms_records_reply($slot_id, $datas[0]['username'], $time, 3)) {
                        
                            $slot_det = $employee->customer_employee_slot_details($slot_id);
                            $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                            $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $datas[0]['username'];
                            $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted']. ' '.$smarty->translate['needs_confirmation'];
                            $obj_sms_sender = new sms($sms_message_sender);
                            $mobile = $leave->get_employee_mobile($leave_sms_datas[0]['alloc_employee']);
                            if ($mobile) {
                                $obj_sms_sender->addRecipient($mobile);
                            }
                            $obj_sms_sender->send();
                        
                    }
                }else if ($leave_sms_datas[0]['status'] == 5) {
                    $leave->update_sms_records_accept($slot_id, $datas[0]['username'], 0);
                    //$employee->employee_add_to_slot($slot_id, $datas[0]['username'], $leave_sms_datas[0]['alloc_employee']);
                } else if ($leave_sms_datas[0]['status'] == 6) {
                    if ($leave->update_sms_records_accept($slot_id, $datas[0]['username'], 0)) {
                        
                            $slot_det = $employee->customer_employee_slot_details($slot_id);
                            $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                            $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $datas[0]['username'];
                            $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted'];
                            $obj_sms_sender = new sms($sms_message_sender);
                            $mobile = $leave->get_employee_mobile($leave_sms_datas[0]['alloc_employee']);
                            if ($mobile) {
                                $obj_sms_sender->addRecipient($mobile);
                            }
                            $obj_sms_sender->send();
                        
                    }
                } else if ($leave_sms_datas[0]['status'] == 7) {
                    if ($leave->update_sms_records_accept($slot_id, $datas[0]['username'], 0)) {
                        if ($employee->employee_add_to_slot($slot_id, $datas[0]['username'], $leave_sms_datas[0]['alloc_employee'])) {
                            $slot_det = $employee->customer_employee_slot_details($slot_id);
                            $sms_message_rejection = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                            $sms_message_rejection .= '%0A' . $smarty->translate['shift_rejected'];
                            $obj_sms_rejection = new sms($sms_message_sender);
                            $leave->tables = array('leave_sms');
                            $leave->fields = array('employee','(select mobile from employee where username = leave_sms.employee) AS mobile');
                            $leave->conditions = array('AND','slot = ?', 'employee != ?');
                            $leave->condition_values = array($slot_id, $datas[0]['username']);
                            $leave->query_generate();
                            $leave_sms_employees = $leave->query_fetch();
                            foreach ($leave_sms_employees as $leave_sms_employee){
                                if($leave_sms_employee['mobile'])
                                    $obj_sms_rejection->addRecipient($leave_sms_employee['mobile']);
                            }
                            $obj_sms_rejection->send();
                        }
                    }
                } else if ($leave_sms_datas[0]['status'] == 8) {
                    if ($leave->update_sms_records_accept($slot_id, $datas[0]['username'], 0)) {
                        $slot_det = $employee->customer_employee_slot_details($slot_id);
                        $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                        $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $datas[0]['username'];
                        $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted'];
                        $obj_sms_sender = new sms($sms_message_sender);
                        $mobile = $leave->get_employee_mobile($leave_sms_datas[0]['alloc_employee']);
                        if ($mobile) {
                            $obj_sms_sender->addRecipient($mobile);
                        }
                        $obj_sms_sender->send();
                        $sms_message_rejection = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                        $sms_message_rejection .= '%0A' . $smarty->translate['shift_rejected'];
                        $obj_sms_rejection = new sms($sms_message_sender);
                        $leave->tables = array('leave_sms');
                        $leave->fields = array('employee','(select mobile from employee where username = leave_sms.employee) AS mobile');
                        $leave->conditions = array('AND','slot = ?', 'employee != ?');
                        $leave->condition_values = array($slot_id, $datas[0]['username']);
                        $leave->query_generate();
                        $leave_sms_employees = $leave->query_fetch();
                        foreach ($leave_sms_employees as $leave_sms_employee){
                            if($leave_sms_employee['mobile'])
                                $obj_sms_rejection->addRecipient($leave_sms_employee['mobile']);
                        }
                        $obj_sms_rejection->send();
                    }
                }
            }
        }
        $obj_sms->update_sms_log_incomming($datas[0]['username'], $reply_msg);
        $leave->commit_transaction();
        echo "ok";
    }
}
?>