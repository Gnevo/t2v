<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/sms.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", "messages.xml",'mail.xml'),FALSE);
$date = new datecalc();
$employee = new employee();
$customer = new customer();
$msg = new message();
$leave = new leave();
$obj_sms = new sms('');
global $db;

$type = $_REQUEST['type'];
//$type = 0;
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
    $handle = fopen($filename, 'a');
    fwrite($handle, $type."I am here"."\n");
    fclose($handle);
    if ($type == 0) {
    $handle = fopen($filename, 'a');
    fwrite($handle, "I am "."\n");
    fclose($handle);
    $leave->select_db($db['database_master']);
    $user_number = substr($_REQUEST['number'], 2);
    $time = $_REQUEST['time'];
    $tag_id = $_REQUEST['tag'];
    $reply_msg = $_REQUEST['msg'];
    
//      $test = $_SERVER['QUERY_STRING'];
//      $user_number = 704434964;
//      $time = date('Y-m-d H:i:s',time());
//      $type = 0;
//      $tag_id = 16;
//      $reply_msg = 'yes'; 

    
    $handle = fopen($filename, 'a');
    fwrite($handle, $user_number."\n");
    fwrite($handle, $time."\n");
    fwrite($handle, $type."\n");
    fwrite($handle, $tag_id."\n");
    fwrite($handle, $reply_msg."\n");
    fwrite($handle, $db['database_master']."\n");
    fclose($handle);
    
    
    
    if (strtolower(trim($reply_msg)) == 'yes' || preg_match('/Ja|ja|j/', $reply_msg)) {
        $leave->tables = array('leave_sms_common');
        $leave->fields = array('sms_tbl_id' ,'company_id');
        $leave->conditions = array('tag_id = ?');
        $leave->condition_values = array($tag_id);
        $leave->query_generate();
            
        $datas = $leave->query_fetch();
        $updated_db= '';
        
            $company_id = $datas[0]['company_id'];
            $leave->select_db($db['database_master']);
            $leave->tables = array('company');
            $leave->fields = array('db_name');
            $leave->conditions = array('id = ?');
            $leave->condition_values = array($company_id);
            $leave->query_generate();
            
            $db_datas = $leave->query_fetch();
            
            $leave->select_db($db_datas[0]['db_name']);
            $employee->select_db($db_datas[0]['db_name']);
            
            $handle = fopen($filename, 'a');
            fwrite($handle, $leave->sql_query."\n");
            fwrite($handle, $db_datas[0]['db_name']."\n");
            fclose($handle);
            
            $leave->tables = array('leave_sms');
            $leave->fields = array('id','slot','employee');
            $leave->conditions = array('id = ?');
            $leave->condition_values = array($datas[0]['sms_tbl_id']);
            $leave->query_generate();
            
            $handle = fopen($filename, 'a');
            fwrite($handle, $leave->sql_query."\n");
            fwrite($handle, $datas[0]['sms_tbl_id']."\n");
            fclose($handle);
            
            $leave_sms_status = $leave->query_fetch();
            
            
            if (!empty($leave_sms_status)) {
                $slot_id = $leave_sms_status[0]['slot'];
                // getting the sms status
                $leave->tables = array('leave_sms');
                $leave->fields = array('status', 'alloc_employee');
                $leave->conditions = array('AND','slot = ?', 'employee = ?');
                $leave->condition_values = array($slot_id, $leave_sms_status[0]['employee']);
                $leave->query_generate();
                
                $handle = fopen($filename, 'a');
            fwrite($handle, $leave->sql_query."\n");
            fwrite($handle, $slot_id."----".$leave_sms_status[0]['employee']."\n");
            fclose($handle);
                    
                
                
                $leave_sms_datas = $leave->query_fetch();
                
                if(!empty ($leave_sms_datas)){
                
                    if ($leave_sms_datas[0]['status'] == 0) {
                        $updated_db= $db_datas[0]['db_name'];
                        $leave->update_sms_records_reply($slot_id, $leave_sms_status[0]['employee'], $time, 3);

                    }else if($leave_sms_datas[0]['status'] == 4){
                        $updated_db= $db_datas[0]['db_name'];       
                        if ($leave->update_sms_records_reply($slot_id, $leave_sms_status[0]['employee'], $time, 3)) {

                                $slot_det = $employee->customer_employee_slot_details($slot_id);
                                $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                                $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $leave_sms_status[0]['employee'];
                                $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted']. ' '.$smarty->translate['needs_confirmation'];
                                $obj_sms_sender = new sms($sms_message_sender);
                                $obj_sms_sender->select_db($db_datas[0]['db_name']);
                                $mobile = $leave->get_employee_mobile($leave_sms_datas[0]['alloc_employee']);
                                if ($mobile) {
                                    $obj_sms_sender->addRecipient($mobile);
                                }
                                $obj_sms_sender->send();

                        }
                    }else if ($leave_sms_datas[0]['status'] == 5) {
                        
                        $updated_db= $db_datas[0]['db_name'];
                        $slot_det = $employee->customer_employee_slot_details($slot_id);
                        $leave->update_sms_records_accept($slot_id, $leave_sms_status[0]['employee'], 0, $slot_det['status'],$db_datas[0]['db_name']);
                        //$employee->employee_add_to_slot($slot_id, $leave_sms_status[0]['employee'], $leave_sms_datas[0]['alloc_employee']);
                    } else if ($leave_sms_datas[0]['status'] == 6) {
                        $updated_db= $db_datas[0]['db_name'];
                        $slot_det = $employee->customer_employee_slot_details($slot_id);
                        if ($leave->update_sms_records_accept($slot_id, $leave_sms_status[0]['employee'], 0, $slot_det['status'], $db_datas[0]['db_name'])) {
                                
                                $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                                $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $leave_sms_status[0]['employee'];
                                $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted'];
                                $obj_sms_sender = new sms($sms_message_sender);
                                $obj_sms_sender->select_db($db_datas[0]['db_name']);
                                $mobile = $leave->get_employee_mobile($leave_sms_datas[0]['alloc_employee']);
                                if ($mobile) {
                                    $obj_sms_sender->addRecipient($mobile);
                                }
                                $obj_sms_sender->send();

                        }
                    } else if ($leave_sms_datas[0]['status'] == 7) {
                        $updated_db= $db_datas[0]['db_name'];
                        $slot_det = $employee->customer_employee_slot_details($slot_id);
                        if ($leave->update_sms_records_accept($slot_id, $leave_sms_status[0]['employee'], 0, $slot_det['status'], $db_datas[0]['db_name'])) {
                            //if ($employee->employee_add_to_slot($slot_id, $leave_sms_status[0]['employee'], $leave_sms_datas[0]['alloc_employee'])) {
                                //$slot_det = $employee->customer_employee_slot_details($slot_id);
                                $sms_message_rejection = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                                $sms_message_rejection .= '%0A' . $smarty->translate['shift_rejected'];
                                $obj_sms_rejection = new sms($sms_message_sender);
                                $obj_sms_rejection->select_db($db_datas[0]['db_name']);
                                $leave->tables = array('leave_sms');
                                $leave->fields = array('employee','(select mobile from employee where username = leave_sms.employee) AS mobile');
                                $leave->conditions = array('AND','slot = ?', 'employee != ?');
                                $leave->condition_values = array($slot_id, $leave_sms_status[0]['employee']);
                                $leave->query_generate();
                                $leave_sms_employees = $leave->query_fetch();
                                foreach ($leave_sms_employees as $leave_sms_employee){
                                    if($leave_sms_employee['mobile'])
                                        $obj_sms_rejection->addRecipient($leave_sms_employee['mobile']);
                                }
                                $obj_sms_rejection->send();
                            //}
                        }
                    } else if ($leave_sms_datas[0]['status'] == 8) {
                        $updated_db= $db_datas[0]['db_name'];
                        $slot_det = $employee->customer_employee_slot_details($slot_id);
                        if ($leave->update_sms_records_accept($slot_id, $leave_sms_status[0]['employee'], 0, $slot_det['status'],$db_datas[0]['db_name'])) {
                            $slot_det = $employee->customer_employee_slot_details($slot_id);
                            $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                            $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $leave_sms_status[0]['employee'];
                            $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted'];
                            $obj_sms_sender = new sms($sms_message_sender);
                            $obj_sms_sender->select_db($db_datas[0]['db_name']);
                            $mobile = $leave->get_employee_mobile($leave_sms_datas[0]['alloc_employee']);
                            if ($mobile) {
                                $obj_sms_sender->addRecipient($mobile);
                            }
                            $obj_sms_sender->send();
                            $sms_message_rejection = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                            $sms_message_rejection .= '%0A' . $smarty->translate['shift_rejected'];
                            $obj_sms_rejection = new sms($sms_message_sender);
                            $obj_sms_rejection->select_db($db_datas[0]['db_name']);
                            $leave->tables = array('leave_sms');
                            $leave->fields = array('employee','(select mobile from employee where username = leave_sms.employee) AS mobile');
                            $leave->conditions = array('AND','slot = ?', 'employee != ?');
                            $leave->condition_values = array($slot_id, $leave_sms_status[0]['employee']);
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
        
//        $obj_sms->select_db($updated_db);
        $obj_sms->update_sms_log_incomming($leave_sms_status[0]['employee'], $reply_msg);
        
        //echo "ok";
    }
}
?>
