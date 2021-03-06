<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
/**
 * Leave Class
 * @author Shamsudheen  <shamsu@arioninfotech.com>
 */

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once ('class/user.php');
require_once ('class/customer.php');
require_once ('class/mail.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/db.php');
require_once ('class/inconvenient_timing.php');
require_once ('plugins/message.class.php');
require_once ('class/employee.php');
require_once('class/sms.php');
require_once('class/timetable.php');
require_once('class/dona.php');
require_once('class/equipment.php');
require_once('class/setup.php');
require_once('class/company.php');

class leave extends db {

    //variable diclaration
    var $reciever_ids = '';
    var $con_status = '';
    var $employee = '';
    var $userid = '';
    var $mreq_id = '';
    var $task_id = '';
    const INPUT_TIME_DEVIATION = 30;

    function __construct() {

        parent::__construct();
    }

    function get_alloc_user_messages($mode = NULL) { //mode is used for identifying call from api_alloc_user_messages.php
        $login_user = $_SESSION['user_id'];
        $login_user_role = $this->user_role($login_user);

        if ($mode == NULL) {
            $this->tables = array('message_request_details', 'timetable');
            $this->fields = array('message_request_details.id', 'message_request_details.message_id', 'message_request_details.userid as senderid', 'message_request_details.reciever_ids', 'message_request_details.read', 'message_request_details.accept', 'message_request_details.rejet', 'message_request_details.apt_time', 'message_request_details.rej_time', 'message_request_details.read_time', 'message_request_details.con_status', 'timetable.employee', 'timetable.date', 'timetable.status', 'timetable.time_from', 'timetable.time_to', 'timetable.relation_id');
            if ($login_user_role == "1" || $login_user_role == "2") {

                $this->conditions = array('OR', array('AND', 'message_request_details.message_id = timetable.id', 'message_request_details.reciever_ids LIKE ?', 'message_request_details.accept NOT LIKE ?', 'message_request_details.rejet NOT LIKE ?'), array('AND', 'message_request_details.message_id = timetable.id', 'message_request_details.userid=?'));
                $this->condition_values = array('%' . $login_user . '%', '%' . $login_user . '%', '%' . $login_user . '%', $login_user);
            } else {

                $this->conditions = array('AND', 'message_request_details.message_id = timetable.id', 'message_request_details.reciever_ids LIKE ?', 'message_request_details.accept NOT LIKE ?', 'message_request_details.rejet NOT LIKE ?');
                $this->condition_values = array('%' . $login_user . '%', '%' . $login_user . '%', '%' . $login_user . '%');
            }
        } else {            // only for api_alloc_user_messages.php
            $this->tables = array('message_request_details', 'timetable');
            $this->fields = array('message_request_details.id', 'message_request_details.message_id', 'message_request_details.userid as senderid', 'message_request_details.reciever_ids', 'message_request_details.read', 'message_request_details.accept', 'message_request_details.rejet', 'message_request_details.apt_time', 'message_request_details.rej_time', 'message_request_details.read_time', 'message_request_details.con_status', 'timetable.employee', 'timetable.date', 'timetable.status', 'timetable.time_from', 'timetable.time_to', 'timetable.relation_id');
            if ($login_user_role == "1" || $login_user_role == "2") {

                $this->conditions = array('OR', array('AND', 'message_request_details.message_id = timetable.id', 'message_request_details.reciever_ids LIKE ?', 'message_request_details.accept NOT LIKE ?', 'message_request_details.rejet NOT LIKE ?'), array('AND', 'message_request_details.message_id = timetable.id', 'message_request_details.userid=?'));
                $this->condition_values = array('%' . $login_user . '%', '%' . $login_user . '%', '%' . $login_user . '%', $login_user);
            } else {

                $this->conditions = array('AND', 'message_request_details.message_id = timetable.id', 'message_request_details.reciever_ids LIKE ?', 'message_request_details.accept NOT LIKE ?', 'message_request_details.rejet NOT LIKE ?');
                $this->condition_values = array('%' . $login_user . '%', '%' . $login_user . '%', '%' . $login_user . '%');
            }
        }
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_slot_by_id($slot_id) {

        $this->tables = array('timetable');
        $this->fields = array('employee,customer,date,time_from,time_to,relation_id,status');
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_leave_request_details_by_id($leave_id, $type = 0) {

        $this->tables = array('message_request_details');
        $this->fields = array('id', 'message_id', 'userid', 'reciever_ids', 'accept', 'rejet', '`read`', 'apt_time', 'rej_time', 'read_time');
        $this->conditions = array('message_id = ?');
        $this->condition_values = array($leave_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($type == 1)
            return $data[0];
        else
            return $data[0]['message_id'];
    }

    function get_leave_request_admin_by_id($message_id) {

        $this->tables = array('message_tm_admin');
        $this->fields = array('id');
        $this->conditions = array('message_id = ?');
        $this->condition_values = array($message_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['id'];
    }

    function get_all_leave_request_admin() {

        $this->tables = array('message_tm_admin');
        $this->fields = array('id', 'userid', 'mreq_id', 'message_id', 'status');
        $this->conditions = array('status = ?');
        $this->condition_values = array('0');
        $this->query_generate();
        return $this->query_fetch();
    }

    function update_user_leave($leave_id) {

        $login_user = $_SESSION['user_id'];
//                echo $login_user.",".$this->reciever_ids.",".$leave_id.",".date('Y-m-d H:i:s').",".$this->con_status;
        if ($this->get_leave_request_details_by_id($leave_id) == "") {
            $this->tables = array('message_request_details');
            $this->fields = array('userid', 'reciever_ids', 'message_id', 'date', 'con_status');
            $this->field_values = array($login_user, $this->reciever_ids, $leave_id, date('Y-m-d H:i:s'), $this->con_status);

            return $this->query_insert();
        } else {
            $this->tables = array('message_request_details');
            $this->fields = array('reciever_ids = CONCAT(reciever_ids,?)');
            $this->field_values = array(',' . $this->reciever_ids);
            $this->conditions = array('message_id = ?');
            $this->condition_values = array($leave_id);
            return $this->query_update(1);
        }
    }

    function update_message_admin($message_id, $notified) {

        if ($notified == "0") {

            if ($this->get_leave_request_admin_by_id($message_id) == "") {

                $this->tables = array('message_tm_admin');
                $this->fields = array('userid', 'mreq_id', 'message_id');
                $this->field_values = array($this->userid, $this->mreq_id, $message_id);
                return $this->query_insert();
            }
        } else {

            $this->tables = array('message_tm_admin');
            $this->fields = array('status');
            $this->field_values = array('1');
            $this->conditions = array('message_id = ?');
            $this->condition_values = array($message_id);
            return $this->query_update();
        }
    }

    function update_message_status($status, $message_id) {

        $obj_emp = new employee();
        $smarty = new smartySetup(array("user.xml", "gdschema.xml", "month.xml", "button.xml", "messages.xml", "mail.xml"), FALSE);

        if ($status == "0") {

            $this->tables = array('message_request_details');
            $this->fields = array('`read`=CONCAT(`read`,?)', '`read_time`=CONCAT(`read_time`,?)');
            $this->field_values = array($this->userid . ",", date('Y-m-d H:i:s') . ",");
            $this->conditions = array('AND', 'id = ?', '`read` NOT LIKE ?');
            $this->condition_values = array($this->mreq_id, '%' . $this->userid . ',%');
            if ($this->query_update(1))
                return true;
            else
                return false;
        } else if ($status == "1") {

            $this->tables = array('message_request_details');
            $this->fields = array('`rejet`=CONCAT(`rejet`,?)', '`rej_time`=CONCAT(`rej_time`,?)');
            $this->field_values = array($this->userid . ",", date('Y-m-d H:i:s') . ",");
            $this->conditions = array('AND', 'id = ?', 'rejet NOT LIKE ?', 'accept NOT LIKE ?');
            $this->condition_values = array($this->mreq_id, '%' . $this->userid . ',%', '%' . $this->userid . ',%');
            if ($this->query_update(1)) {
                $this->tables = array('leave_sms');
                $this->fields = array('status');
                $this->field_values = array(2);
                $this->conditions = array('AND', 'slot = ?', 'employee = ?');
                $this->condition_values = array($message_id, $this->userid);
                if ($this->query_update())
                    return true;
                else
                    return false;
            }
        } else if ($status == "2") {

            $this->tables = array('message_request_details');
            $this->fields = array('`accept`=CONCAT(`accept`,?)', '`apt_time`=CONCAT(`apt_time`,?)');
            $this->field_values = array($this->userid . ",", date('Y-m-d H:i:s') . ",");
            $this->conditions = array('AND', 'id = ?', 'accept NOT LIKE ?', 'rejet NOT LIKE ?');
            $this->condition_values = array($this->mreq_id, '%' . $this->userid . ',%', '%' . $this->userid . ',%');
            $this->query_update(1);

            $this->tables = array('message_request_details');
            $this->fields = array('id', 'message_id', 'con_status');
            $this->conditions = array('id = ?');
            $this->condition_values = array($this->mreq_id);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data[0]['con_status'] == "1") {

                $this->emp = $this->userid;
                if ($this->update_employee_slot($data[0]['message_id'])) {
                    $this->tables = array('leave_sms');
                    $this->fields = array('status');
                    $this->field_values = array(1);
                    $this->conditions = array('AND', 'slot = ?', 'employee = ?');
                    $this->condition_values = array($message_id, $this->userid);
                    if ($this->query_update()) {
                        $this->tables = array('leave_sms');
                        $this->fields = array('status');
                        $this->field_values = array(2);
                        $this->conditions = array('AND', 'slot = ?', 'employee != ?');
                        $this->condition_values = array($message_id, $this->userid);
                        if ($this->query_update()) {

                            $slot_det = $obj_emp->customer_employee_slot_details($message_id);

                            //sending sms to shift accepted user and allocated admin
                            $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';

                            $obj_sms_sender = new sms($sms_message_sender);

                            //sending sms to shift rejected users 
                            $sms_message_rejection = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
                            $sms_message_rejection .= '%0A' . $smarty->translate['shift_rejected'];
                            $obj_sms_rejection = new sms($sms_message_sender);


                            $this->tables = array('leave_sms');
                            $this->fields = array('employee', 'alloc_employee', '(SELECT mobile FROM employee where username = leave_sms.employee) AS mobile');
                            $this->conditions = array('slot = ?');
                            $this->condition_values = array($message_id);
                            $this->query_generate();
                            $sms_datas = $this->query_fetch();
                            foreach ($sms_datas as $sms_data) {
                                if ($sms_data['employee'] == $this->userid) {
                                    $sms_message_sender .= '%0A' . $smarty->translate['employee'] . ' : ' . $this->userid;
                                    $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted'];
                                    $mobile = $this->get_employee_mobile($sms_data['alloc_employee']);
                                    if ($mobile) {
                                        $obj_sms_sender->addRecipient($mobile);
                                    }
                                    if ($sms_data['mobile']) {
                                        $obj_sms_sender->addRecipient($sms_data['mobile']);
                                    }
                                } else {
                                    if ($sms_data['mobile'])
                                        $obj_sms_rejection->addRecipient($sms_data['mobile']);
                                }
                            }
                            if ($obj_sms_sender->recipients)
                                $obj_sms_sender->send();
                            if ($obj_sms_rejection->recipients)
                                $obj_sms_rejection->send();
                            return true;
                        } else {

                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else if ($data[0]['con_status'] == "2") {
                $this->tables = array('leave_sms');
                $this->fields = array('status');
                $this->field_values = array(3);
                $this->conditions = array('AND', 'slot = ?', 'employee = ?');
                $this->condition_values = array($message_id, $this->userid);
                if ($this->query_update()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    function get_task_by_id($id) {

        $this->tables = array('user_task');
        $this->fields = array('userid', 'slotids', 'dag ', 'start_time ', 'end_time', 'dur', 'cast(concat(`dag`, " ", `start_time`) as datetime) as start_date_time', 'customer');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_running_tasks($user_id = '', $page = 'employee') {
        if ($user_id != '') {
            $login_user = $user_id;
            $this->tables = array('user_task');
            $this->fields = array('id', 'userid', 'slotids', 'dag ', 'start_time ', 'end_time', 'TIMEDIFF(NOW(),CONCAT(`dag`,CONCAT(" ",`start_time`))) as `dur`', 'customer', '(SELECT concat(last_name, " ", first_name) FROM customer where username = user_task.customer) AS cust_name', '(SELECT concat(last_name, " ", first_name) FROM employee where username = user_task.userid) AS emp_name');
            if ($page == 'employee') {
                $this->conditions = array('AND', 'userid = ?', 'status=?');
                $this->condition_values = array($login_user, '0');
            } elseif ($page == 'customer') {
                $this->conditions = array('AND', 'customer = ?', 'status=?');
                $this->condition_values = array($login_user, '0');
            }
            $this->query_generate();
            $datas = $this->query_fetch();
            $i = 0;
            foreach ($datas as $data) {
                if ($page == 'employee')
                    $details = $this->employee_get_task_slots($user_id, $data['dag'], $data['start_time'], 'all', '1,4');
                elseif ($page == 'customer')
                    $details = $this->customer_get_task_slots($user_id, $data['dag'], $data['start_time'], 'all', '1,4');
                $datas[$i]['details_count'] = count($details);
                $datas[$i]['details'] = $details;
                if (count($details) == 0) {
                    $obj_emp = new employee();
                }
                $i++;
            }
            return $datas;
        } else {
            $datas = array();
            $this->tables = array('user_task');
            $this->fields = array('id', 'userid', 'slotids', 'dag ', 'start_time ', 'end_time', 'TIMEDIFF(NOW(),CONCAT(`dag`,CONCAT(" ",`start_time`))) as `dur`', 'customer', '(SELECT concat(last_name, " ", first_name) FROM customer where username = user_task.customer) AS cust_name', '(SELECT concat(last_name, " ", first_name) FROM employee where username = user_task.userid) AS emp_name', '(SELECT color FROM employee where username = user_task.userid) AS emp_color');
            if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6){
                $this->conditions = array('AND', 'userid != ?', 'status=?');
                $this->condition_values = array($_SESSION['user_id'], '0');
            }elseif($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
                $obj_emp = new employee();
                $team_employees = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
                $this_employee_string = '\'' . implode('\' , \'', array_column($team_employees, 'username')) . '\'';
                $this->conditions = array('AND', 'userid != ?', 'status=?',array('IN', 'userid', $this_employee_string));
                $this->condition_values = array($_SESSION['user_id'], '0');
            }
            $this->query_generate();
            $datas = $this->query_fetch();
            return $datas;
        }
    }

    function slot_add_custom_type($employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = '', $type = 0, $relation_id = '', $comment = null, $status = 1) {
        $obj_employee = new employee();
        $obj_dona = new dona();
        if ($employee == '' || $customer == '') {
            $status = 0;
            $relation_id = '';
        }

        if ($comment == null || $comment == "") {
            $comment = NULL;
        }
        if ($time_from == $time_to)
            return true;


        $inconv_timings = $obj_employee->get_collided_inconvenients_on_a_day_for_customer($date, $customer, $time_from, $time_to, 3);
        //echo "<pre>\n".print_r($inconv_timings, 1)."</pre>";
        $intervals = array();
        if (!empty($inconv_timings)) {
            $total_count = count($inconv_timings);
            $last_time_to = $time_from;
            foreach ($inconv_timings as $key => $inconv_timing) {
                $cur_time_from = $cur_time_to = $cur_time_type = '';
                if ($inconv_timing['time_from'] <= $last_time_to) {
                    if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                        $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
                        $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                        $cur_time_type = 0;
                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date);
                    }
                    $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
                    $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                    $cur_time_type = 3;
                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date);
                } else if ($inconv_timing['time_from'] > $last_time_to) {
                    //                                    if($key == 0){
                    $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
                    $cur_time_to = $inconv_timing['time_from'];
                    $cur_time_type = 0;
                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date);
                    //                                    }

                    $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
                    $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                    $cur_time_type = 3;
                    //echo "<pre>\n".print_r(array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date), 1)."</pre>";
                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date);
                }

                $last_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                if ($key == $total_count - 1 && $inconv_timing['time_to'] < $time_to) {
                    $cur_time_from = $last_time_to;
                    $cur_time_to = $time_to;
                    $cur_time_type = 0;
                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date);
                }
            }
        } else {
            $cur_time_from = $time_from;
            $cur_time_to = $time_to;
            $cur_time_type = 0;
            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $date);
        }

        //echo "<pre>\n".print_r($intervals, 1)."</pre>";
        $result_flag = '';
        if (!empty($intervals)) {
            foreach ($intervals as $interval) {
                if ($interval['time_from'] == $interval['time_to'])
                    continue;
                if ($obj_dona->customer_employee_slot_add($employee, $customer, $interval['date'], $interval['time_from'], $interval['time_to'], $alloc_emp, $fkkn, $interval['type'], '', '', 4)) {
//                                                if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 

                    $result_flag .= $obj_dona->get_id() . ',';
                } else {

                    $result_flag = FALSE;
                    break;
                }
            }
        } else {
            return '';
        }
        return $result_flag;
    }

    function is_employee_leave_on_time($employee, $date, $time_from) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: check whether the employee is leave or not on a specified date and time interval
         * return TRUE - if employee is leave , else return FALSE
         * return type: leave array | Boolean
         */
        if ($employee == '')
            return FALSE;

        $this->tables = array('leave');
        $this->fields = array('id', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'time_from <= ?', 'time_to > ?', 'date=?', 'employee=?', array('IN', 'status', '0,1'));
        $this->condition_values = array((float) $time_from, $time_from, $date, $employee);
        $this->query_generate();
        $datas = $this->query_fetch();
        return (count($datas) > 0 ? FALSE : TRUE);
    }

    function is_employee_leave($employee, $date, $time_from, $time_to) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: check whether the employee is leave or not on a specified date and time interval
         * return TRUE - if employee is leave , else return FALSE
         * return type: leave array | Boolean
         */
        if ($employee == '')
            return FALSE;

        $this->tables = array('leave');
        $this->fields = array('id', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('IN', 'status', '0,1'));
        $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
        $this->query_generate();
        $datas = $this->query_fetch();
        return (count($datas) > 0 ? FALSE : TRUE);
    }
    function get_employees_on_customer($employee, $customer){
        $this->sql_query = "SELECT t.employee,e.first_name,e.last_name,e.email,e.mobile,t.customer,t.role FROM team t INNER JOIN employee e ON t.employee = e.username AND t.customer='".$customer."' ORDER BY t.role";
        $datas = $this->query_fetch();
        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }
    // function get_employee_role_on_customer($employee, $customer){
    //     $this->sql_query = "SELECT role FROM team customer='".$customer."' AND employee='".$employee."'";
    //     $datas = $this->query_fetch();
    //     if(!empty($datas)){
    //         return $datas[0]['role'];
    //     }else{
    //         return false;
    //     }
    // }

    function get_employees_in_charge($employee, $customer){
        $obj_company = new company();
        $role_hierarchy = array(1=>1,2=>7,3=>2,4=>3);
        $employees_on_customer = $this->get_employees_on_customer($employee,$customer);
        $in_charge_details = array();
        //$employee_role = $obj_user->get_employee_role_on_customer($employee,$customer);
        //echo "<pre>".print_r($employees_on_customer,1)."</pre>";
        $employee_role = $employees_on_customer[array_search($employee, array_column($employees_on_customer, 'employee'))]['role'];
        //echo "<br>";    
        //exit();
        if($employee_role){
            $employee_role_key = array_search($employee_role, $role_hierarchy);
            for($i=$employee_role_key-1; $i>1; $i--){
                $in_change_role = $role_hierarchy[$i];
                $in_charge_key_on_list = array_search($in_change_role, array_column($employees_on_customer, 'role'));
                
                if($in_charge_key_on_list){
                    $in_charge_details = $employees_on_customer[$in_charge_key_on_list];
                    //echo "<pre>".print_r($in_charge_details,1)."</pre>";
                    if($in_charge_details['email']){
                        $in_charge_name = $_SESSION['company_sort_by'] == 1 ? $in_charge_details['first_name'].' '.$in_charge_details['last_name'] : $in_charge_details['last_name']. ' '. $in_charge_details['first_name'];
                       
                        return array('username' => $in_charge_details['employee'], 'name'=> $in_charge_name, 'email' => $in_charge_details['email'], 'mobile' => $in_charge_details['mobile'], 'role' => $in_charge_details['role'], 'type' => 'employee');
                    }
                }
            }
            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
            if(trim($company_details['contact_person2_email']) != ''){
                return array('username' => $company_details['username2'], 'name'=> $company_details['contact_person2'], 'email' => $company_details['contact_person2_email'], 'mobile' => '', 'role' => '', 'type' => 'company');
            }elseif(trim($company_details['contact_person1_email']) != ''){
                return array('username' => $company_details['username1'], 'name'=> $company_details['contact_person1'], 'email' => $company_details['contact_person1_email'], 'mobile' => '', 'role' => '', 'type' => 'company');
            }else{
                return false;
            }

        }else{
            return false;
        }

    }

    function send_internal_external_mail($employee,$customer,$subject,$body, $type='ALL', $mode='ALL'){
        global $firebase_settings;        
        $internal_mail = new mail();
        $employee_in_charge = $this->get_employees_in_charge($employee['username'],$customer);
        //echo "<pre>".print_r($employee_in_charge,1)."</pre>";
        $internal_mail_address = array();
        $mail = new SimpleMail($subject, $body);
        $mail->addSender("cirrus-noreplay@time2view.se");
        $internal_mail->from = 'root001';
        if(($mode == 'ALL' || $mode == 'EMPLOYEE') && $employee['email'] != ''){
            $mail->addRecipient($employee['email']);
        }
        if(($mode == 'ALL' || $mode == 'IN_CHARGE')){
            $mail->addRecipient($employee_in_charge['email']);
        }    
        if($type == 'ALL' || $type == 'EXTERNAL'){        
            $mail->send();
        }
        if($type == 'ALL' || $type == 'INTERNAL'){
            $internal_mail->root_id = 0;
            $internal_mail->method = 2;
            $internal_mail->from = 'root001';
            $internal_mail->subject = $subject;
            $internal_mail->message = $body;
            $internal_mail->status = 0; //indicate unread mail
            if(($mode == 'ALL' || $mode == 'EMPLOYEE')){
                $internal_mail->to = $employee['username'];
                $internal_mail->insert_mail();
            }
            if($employee_in_charge['username'] != '' && ($mode == 'ALL' || $mode == 'IN_CHARGE')){
                $internal_mail->to = $employee_in_charge['username'];
                $internal_mail->insert_mail();
            }  
        }
        
        //echo "<pre>".print_r($employee_in_charge,1)."</pre>";
            
    }

    function update_user_task($user_id, $status, $candg, $customer, $break_time, &$display_message = '',$page = 'employee') {
        $obj_equipment = new equipment();
        $obj_dona = new dona();
        $login_user = $user_id;
        $obj_emp = new employee();
        $obj_cp = new copy_paste();
        //$recipents = $obj_emp->employee_leave_recipients($user_id, 8);
        $smarty = new smartySetup(array("user.xml", "mail.xml"),FALSE);
        
        
        $employe_data = $this->get_employee_detail($login_user);
        $employee_name = $_SESSION['company_sort_by'] == 1?$employe_data['first_name'] . ' ' . $employe_data['last_name'] : $employe_data['last_name'] . ' ' . $employe_data['first_name'];
        $mail_message = $smarty->translate['cg_mail_body_start'].'<br>'.$smarty->translate['employee'].': ' . ($_SESSION['company_sort_by'] == 1?$employe_data['first_name'] . ' ' . $employe_data['last_name'] : $employe_data['last_name'] . ' ' . $employe_data['first_name']) . '<br/>';
        $mail_subject = $smarty->translate['cg_mail_subject'];
        $mail_slots = '';
        if ($status == "0") {
            //$start_time = new DateTime('2014-03-29 16:00:00'); 
            $start_time = new DateTime;
            $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $start_time->setTimestamp(time());
            $current_date_time = $start_time->format('Y-m-d G:i:s');
            $current_date_time_actual = strtotime($start_time->format('Y-m-d G:i:s'));
            $current_date = $start_time->format('Y-m-d');
            $current_time = $start_time->format('G:i:s');
            $start_time->sub(new DateInterval('PT'.self::INPUT_TIME_DEVIATION.'M'));
            $start_date = $start_time->format('Y-m-d G:i:s');
            $start_time = $start_time->format('G:i:s');
            $task_slots = $this->check_slot_start($start_date, $start_time, $page);
            if (count($task_slots) <= 0 && $candg == 0) {
                return -1;
            } else {
                $slot_det = empty($task_slots)?array():$task_slots[0];
                if (!empty($slot_det) && $page == 'employee') {
                    $customer = $slot_det['customer'];
                } elseif (!empty($slot_det) && $page == 'customer') {
                    $login_user = $slot_det['employee'];
                    $employe_data = $this->get_employee_detail($login_user);
                    $employee_name = $_SESSION['company_sort_by'] == 1?$employe_data['first_name'] . ' ' . $employe_data['last_name'] : $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                    $mail_message = 'Skickat från Come & Go<br>Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                }

                
                $current_date_time = round(strtotime($current_date_time) / (5 * 60)) * (5 * 60);
                
                //echo date('Y-m-d G:i:s', $slot_date_time);
                $date = date('Y-m-d', $current_date_time);
                $time_from = date('G.i', $current_date_time);
                
                $flag = 1;
                $second_flag = 1; // for checking more than one slot in the task
                //check for  sign and 
                $check_report_sign = $obj_cp->check_employees_signed_between_dates(array($login_user), $customer, $date, $date);
                $check_leave = $this->is_employee_leave_on_time($login_user, $date, $time_from);
                
                if ($check_report_sign) {
                    if ($check_leave) {
                        $this->begin_transaction();
                        $obj_dona->begin_transaction();
                        if (!empty($slot_det)) {
                            $slot_date_time = strtotime($slot_det['time_from']);
                            $time_to = date('G.i', strtotime($slot_det['time_to']));
                            if ($time_to == 0.00)
                                $time_to = 24.00;
                            if (abs($current_date_time - $slot_date_time) >= 300) { // checkingg whether there is a difference of 5 minutes with start time
                                //echo date("Y-m-d H:i:s", $current_date_time)."-";
                                //echo date("Y-m-d H:i:s", $slot_date_time);
                                if ($current_date_time < $slot_date_time) {
                                    $display_message = str_replace("{{MINUTES}}", ($slot_date_time - $current_date_time)/60, $smarty->translate['cg_early_starting_msg_to_user']);
                              
                                }elseif($current_date_time > $slot_date_time){
                                    //echo "2";exit();
                                    $display_message =str_replace("{{MINUTES}}", ($current_date_time - $slot_date_time)/60, $smarty->translate['cg_late_starting_msg_to_user']);

                                    $late_body = $smarty->translate['cg_late_mail_body_start']."<br>".$smarty->translate['employee'].': '.$employee_name."<br>".$smarty->translate['late_by'].': '.(($current_date_time - $slot_date_time)/60).$smarty->translate['cg_minute_short'];

                                    $this->send_internal_external_mail($employe_data,$customer,$smarty->translate['cg_late_mail_subject'],$late_body);
                                        
                                }

                                if (strtotime(date('Y-m-d', $current_date_time)) > strtotime(date('Y-m-d', $slot_date_time))) {//if work starts in the next day
                                    $display_message = $smarty->translate['cg_early starting_msg_to_user'];
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee');
                                    $this->field_values = array('');
                                    $this->conditions = array('id = ?');
                                    $this->condition_values = array($slot_det['id']);
                                    if ($this->query_update()) {
                                        if (!empty($task_slots[1])) {
                                            $slot_det = $task_slots[1];
                                        } else {
                                            $second_flag = 0;
                                        }
                                    } else {
                                        $flag = 0;
                                    }
                                } 
                                if ($flag == 1 && $second_flag == 1) {
                                    if ($current_date_time > strtotime($slot_det['time_from'])) {
                                        //echo "<pre>".print_r($slot_det,1)."</pre>";
                                        $this->tables = array('timetable');
                                        $this->fields = array('time_from', 'status', 'created_status', 'alloc_emp');
                                        $this->field_values = array($time_from, '4', '1', $login_user);
                                        $this->conditions = array('id = ?');
                                        $this->condition_values = array($slot_det['id']);
                                        if (!$this->query_update()) {
                                            $flag = 0;
                                        }elseif(!$this->slot_add_custom_type('', $customer, $slot_det['date'], date('G.i',strtotime($slot_det['time_from'])), date('G.i',strtotime($time_from)), $login_user, $slot_det['fkkn'], $slot_det['type'], '', null, 4)){
                                            $flag = 0;

                                        }
                                    }
                                }
                            }
                        }
                        if ($flag == 1) {

                            $this->tables = array('user_task');
                            $this->fields = array('userid', 'dag', 'start_time', 'customer');
                            $this->field_values = array($login_user, date('Y-m-d', $current_date_time_actual), date('G:i:s', $current_date_time_actual), $customer);
                            //                    echo "<pre>\n".print_r($this->field_values , 1)."</pre>";
                            //                    exit;
                            if ($this->query_insert()) {

                                $this->commit_transaction();
                                $obj_dona->commit_transaction();
                                if ($mail_slots != '' && $late_body == '') {
                                    $mail = new SimpleMail($mail_subject, $mail_message . "Datum och pass:<br>" . $mail_slots);
                                    $mail->addSender("cirrus-noreplay@time2view.se");
                                    foreach ($recipents as $recipent) {

                                        if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

                                            $mail->addRecipient($recipent['email']);
                                        }
                                    }
                                    $mail->send();
                                }
                                return $this->get_id();
                            } else {
                                $this->rollback_transaction();
                                $obj_dona->rollback_transaction();
                                return 0;
                            }
                        } else {
                            $this->rollback_transaction();
                            $obj_dona->rollback_transaction();
                            return 0;
                        }
                    } else {
                        return -4;
                    }
                } else {
                    return -3;
                }
            }
        } else {
            //echo "hi";
            //$stop_time = new DateTime('2018-12-26 09:45:00');  
            $stop_time = new DateTime();
            $stop_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $stop_time->setTimestamp(time());
            //echo $this->task_id;
            $stop_time = $stop_time->format('Y-m-d G:i:s');
            $data = $this->get_task_by_id($this->task_id);
            $date = $data[0]['dag'];
            $start_time = $data[0]['start_time'];
            $start_date_time = $data[0]['start_date_time'];
            $previous_end = strtotime($start_date_time);
            $datas = $this->employee_get_task_slots($login_user, $date, $start_time, 'all',array(1,4));
            $previous_data = $this->get_previous_slot_details($start_date_time, $login_user);
            $customer_detail = $this->get_customer_detail($customer);
            $employe_data = $this->get_employee_detail($login_user);
            $slot_end = '';
            $late_going_body = $early_going_body = '';
            // echo "<pre>\ndatas".print_r($data , 1)."</pre>";
            //echo "<pre>\ndatas".print_r($datas , 1)."</pre>";
            //exit();
            // echo "<pre>\nprevious data".print_r($previous_data , 1)."</pre>";
            $flag = 1;
            $candg_flag = 0;
            $slots = '';
            //check for report sign and leave
            $round_start = round($previous_end / (5 * 60)) * (5 * 60);
            $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
            
            $check_report_sign = $obj_cp->check_employees_signed_between_dates(array($login_user), $customer, date('Y-m-d', $round_start), date('Y-m-d', $round_stop));
            $check_leave = TRUE;
            $temp_date = strtotime(date('Y-m-d', $round_start));
            while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                $tmp_time_from = 0.00;
                $tmp_time_to = 24.00;
                if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                    $tmp_time_from = date('G.i', $round_start);
                }
                if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                    $tmp_time_to = date('G.i', $round_stop);
                }
                //echo $login_user."date".date('Y-m-d', $temp_date).'timefrom'.$tmp_time_from.'timeto'.$tmp_time_to."---<br>";
                $temp_check_leave = $obj_emp->is_employee_leave($login_user, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to);
                if($temp_check_leave){
                    $check_leave = FALSE;
                    break;
                }
                $temp_date = strtotime('+1 day', $temp_date);        
            }
            
            //////////////////////////////////////////////////////////////////////////////////////////
            if($check_report_sign && $check_leave){
               
                $this->begin_transaction();
                $obj_dona->begin_transaction();
                // if($_SESSION['user_id'] == 'cifo001')
                //             echo "<pre>".print_r($datas,1)."</pre>";
                if ($candg == 1 && empty($datas)) {
                    $candg_flag = 1;
                    if ($page == 'employee')
                        $customer = $data[0]['customer'];
                    elseif ($page == 'customer')
                        $login_user = $data[0]['userid'];
                    if (strtotime($stop_time) - $previous_end >= 300) {
                        $slots_between = $this->get_slots_between_two_times($login_user, date('Y-m-d G:i:s', $previous_end), date('Y-m-d G:i:s', strtotime($stop_time)), '', 'id');
                        //echo "<pre>\ndatas".print_r($slots_between , 1)."</pre>";
                        foreach ($slots_between as $slot_ids) {
                            if (!$obj_dona->customer_employee_slot_remove($slot_ids)) {
                                $flag = 0;
                            }
                        }
                        //$stop_time = "2014-07-01 10:00:00";
                        $round_start = round($previous_end / (5 * 60)) * (5 * 60);
                        $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                        $temp_date = strtotime(date('Y-m-d', $round_start));
                        $previous_break_excess = 0;
                        $test_i = 0;


                        while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                            $test_i++;
                            $tmp_time_from = 0.00;
                            $tmp_time_to = 24.00;
                            if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                                $tmp_time_from = date('G.i', $round_start);
                            }
                            if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                $tmp_time_to = date('G.i', $round_stop);
                            }
                            //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                            if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                //When there is break hours need to be inserted 
                                //$customer = $previous_data['customer'];
                                $slot_time_from = $tmp_time_from;
                                $slot_time_to = $tmp_time_to;

                                if ($previous_break_excess > 0) {
                                    $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                    $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                    if ($slot_time_from != $slot_time_to) {
                                        //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                            $slots .= $tmp_slots;
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                            if ($slot_time_to != $tmp_break_time) {
                                                //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                            $slot_time_from = $tmp_break_time;
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }
                                }


                                $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);


                                while ($tmp_break_time <= $tmp_time_to) {
                                    $previous_break_excess = 0;
                                    $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                    if ($slot_time_from != $slot_time_to) {
                                        //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                            $slots .= $tmp_slots;
                                            //echo $slots;
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                            if ($slot_time_to != $tmp_break_time) {
                                                //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                        //echo "-------------------------------------------------------------------------------------\n";
                                    }
                                    $slot_time_from = $tmp_break_time;
                                    $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                    $slot_time_to = $tmp_time_to;
                                }
                                if ($tmp_break_time > $tmp_time_to) {
                                    if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                        $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                        if ($slot_time_from != $slot_time_to) {
                                            //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";

                                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $tmp_slots;
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                if ($slot_time_to != $tmp_time_to) {
                                                    //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "\n";
                                                    if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                        $slots .= $obj_dona->get_id() . ',';
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                            //echo "-------------------------------------------------------------------------------------\n";
                                        }
                                    } else {
                                        $slot_time_to = $tmp_time_to;
                                        if ($slot_time_from != $slot_time_to) {
                                        //                                        echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                        //                                        echo "-------------------------------------------------------------------------------------\n";
                                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $tmp_slots;
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                        }
                                    }

                                    $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                }
                                /** End of break hours block* */
                            } else {
                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, 1, 0, '', null, 4)) {
                                    $slots .= $tmp_slots;
                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                } else {
                                    $flag = 0;
                                    break;
                                }
                            }
                            $temp_date = strtotime('+1 day', $temp_date);
                        }
                    }
                } else {
                    //echo "<pre>".print_r($previous_data,1)."</pre>";

                    ///////////////////////////////////////////
                    if (!empty($datas))
                        $previous_data = $datas[0];
                    else
                        $previous_data['customer'] = $customer;
                        $previous_data['employee'] = $login_user;
                        $previous_data['fkkn'] = $customer_detail['fkkn'];
                    //////////////////////////////////////////    
                    //echo "<pre>".print_r($previous_data,1)."</pre>";
                    if($candg == 0){
                        $candg_flag = 1;
                        if (strtotime($stop_time) - $previous_end >= 300) {                        
                            $temp_i = 0;
                            // echo "<pre>".print_r($datas,1)."</pre>";
                            // echo "1";
                            foreach ($datas as $slot_between_dets) {
                                $temp_i++;
                                // echo $slot_between_dets['slot_end']."--".$stop_time;
                                // echo "<br>";
                                $temp_slot_end = strtotime($slot_between_dets['slot_end']);
                                if($temp_i == count($datas) &&
                                     strtotime($slot_between_dets['slot_end']) >  $round_stop && 
                                    $obj_equipment->time_difference(date('G.i',$temp_slot_end), date('G.i',$round_stop)) >= $break_time){
                                        
                                        $this->tables = array('timetable');
                                        $this->fields = array('time_to','status');
                                        $this->field_values = array(date('G.i',$round_stop), 4);
                                        $this->conditions = array('id = ?');
                                        $this->condition_values = array($slot_between_dets['id']);
                                        if (!$this->query_update()) {
                                            $flag = 0;
                                            break;
                                        }elseif(!$this->slot_add_custom_type('', $customer, $slot_between_dets['date'], date('G.i',$round_stop), $slot_between_dets['time_to'], $login_user, $slot_between_dets['fkkn'], $slot_between_dets['type'], '', null, 4)){
                                            $flag = 0;
                                            break;
                                        }else{

                                            $early_going_body = $smarty->translate['cg_early_going_mail_body_start']."<br>";
                                            $early_going_body .= $smarty->translate['customer'].": ".$slot_between_dets['cust_name']."<br>";
                                            $early_going_body .= $smarty->translate['employee'].": ".$slot_between_dets['employee_name']."<br>";
                                            $early_going_body .= $smarty->translate['slot'].": ".sprintf('%05.02f',$slot_between_dets['time_from'])." - ".sprintf('%05.02f',$slot_between_dets['time_to'])."<br>";  
                                            $early_going_body .= $smarty->translate['early_by'].": ".gmdate('H:i',(strtotime($slot_between_dets['slot_end']) - $round_stop))."h<br>";
                                            //echo $early_going_body .= $smarty->translate['cg_early_going_mail_body_end']."<br>";
                                            $display_message = str_replace("{{MINUTES}}", gmdate('H:i',(strtotime($slot_between_dets['slot_end']) - $round_stop)), $smarty->translate['cg_early_going_msg_to_user']);
                                            $this->send_internal_external_mail($employe_data,$customer,$smarty->translate['cg_early_going_mail_subject'],$early_going_body);
                                        }

                                }else{
                                    if($temp_i == count($datas) && 
                                    strtotime($slot_between_dets['slot_end']) <  $round_stop && 
                                    $obj_equipment->time_difference($slot_between_dets['slot_end'], $round_stop) >= $break_time){
                                        $display_message = str_replace("{{MINUTES}}", ($slot_date_time - $current_date_time)/60, $smarty->translate['cg_late_going_msg_to_user']);
                                    }
                                    $this->tables = array('timetable');
                                    $this->fields = array('created_status');
                                    $this->field_values = array(4);
                                    $this->conditions = array('id = ?');
                                    $this->condition_values = array($slot_between_dets['id']);
                                    if (!$this->query_update()) {
                                        $flag = 0;
                                        break;
                                    }
                                }
                                
                            }
                            //exit();
                            // //$stop_time = "2014-07-01 10:00:00";
                            // $round_start = round($previous_end / (5 * 60)) * (5 * 60);
                            // $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                            $temp_date = strtotime(date('Y-m-d', $round_start));
                            $previous_break_excess = 0;
                            $test_i = 0;                        
                        }
                       
                    }else{
                        // if($_SESSION['user_id'] == 'cifo001')
                        //     echo "<pre>".print_r($datas,1)."</pre>";
                        //echo "I am here";
                        foreach ($datas as $row) {
                            $slot_start = strtotime($row['slot_start']);
                            $slot_end = strtotime($row['slot_end']);
                            $test_i++;
                            //echo date('Y-m-d H:i:s', $slot_start)."-".date('Y-m-d H:i:s', $previous_end)."-".($slot_start - $previous_end)."<br>";
                            
                            if ($slot_start - $previous_end >= 300) {

                               
                                $round_start = round($previous_end / (5 * 60)) * (5 * 60);
                                $round_stop = round($slot_start / (5 * 60)) * (5 * 60);
                                $temp_date = strtotime(date('Y-m-d', $round_start));
                                $previous_break_excess = 0;
                                while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                                    //echo "inside while<br>";
                                    $tmp_time_from = 0.00;
                                    $tmp_time_to = 24.00;
                                    if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                                        $tmp_time_from = date('G.i', $round_start);
                                    }
                                    if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                        $tmp_time_to = date('G.i', $round_stop);
                                    }

                                    //echo $tmp_time_from."-".$tmp_time_to."<br>";
                                    if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                        
                                        //When there is break hours need to be inserted
                                        //echo "inside break<br>";
                                        $slot_time_from = $tmp_time_from;
                                        $slot_time_to = $tmp_time_to;

                                        if ($previous_break_excess > 0) {
                                            $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                                if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_break_time) {
                                                        //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                    $slot_time_from = $tmp_break_time;
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        }


                                        $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);

                                        while ($tmp_break_time <= $tmp_time_to) {
                                            $previous_break_excess = 0;
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                                if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_break_time) {
                                                        //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                            $slot_time_from = $tmp_break_time;
                                            $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                            $slot_time_to = $tmp_time_to;
                                        }
                                        if ($tmp_break_time > $tmp_time_to) {
                                            if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                                if ($slot_time_from != $slot_time_to) {
                                                    

                                                    if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $obj_dona->get_id() . ',';
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                        if ($slot_time_to != $tmp_time_to) {
                                                            
                                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                                $slots .= $obj_dona->get_id() . ',';
                                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                            } else {
                                                                $flag = 0;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                    //echo "-------------------------------------------------------------------------------------\n";
                                                }
                                            } else {
                                                $slot_time_to = $tmp_time_to;
                                                if ($slot_time_from != $slot_time_to) {
                                                    //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                                    //echo "-------------------------------------------------------------------------------------\n";
                                                    if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $obj_dona->get_id() . ',';
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            }

                                            $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                        }
                                        //End of break hours block
                                    } else {
                                    //echo "shaju<br>";    
                                        // if ($page == 'employee')
                                        //     $customer = $previous_data['customer'];
                                        // elseif ($page == 'customer')
                                        //     $login_user = $previous_data['employee'];
                                        if ($tmp_time_from != $tmp_time_to) {

                                            //echo $test_i . "---" . date('Y-m-d', $temp_date) . "-----" . $tmp_time_from . "--" . $tmp_time_to . "\n";
                                            if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, $previous_data['fkkn'], 0, '', null, 4)) {

                                                $slots .= $obj_dona->get_id() . ',';
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                            } else {

                                                $flag = 0;
                                                break;
                                            }
                                        }
                                    }
                                    $temp_date = strtotime('+1 day', $temp_date);
                                }
                            }
                            if(strtotime($stop_time) > $slot_start && (strtotime($stop_time) - $slot_start) >=300 ){
                                $this->tables = array('timetable');
                                $this->fields = array('status', 'created_status', 'alloc_emp');
                                $this->field_values = array('4', '1', $login_user);
                                $this->conditions = array('id = ?');
                                $this->condition_values = array($row['id']);
                                if ($this->query_update()) {
                                    $flag = 1;
                                    $slots .= $row['id'] . ',';
                                }
                                else{
                                    $flag=0;
                                    break;
                                }
                            }
                            if (strtotime($stop_time) <= $slot_end) {
                                //echo "fjdshfjkhdjkhdjkshhsgkjfhgjkfdshgfdskjghkfdsjg<br>";
                                //Here to fix for break
                                //echo "Here coming<br>";
                                // if($_SESSION['user_id'] == 'cifo001')
                                //     echo "1";
                                if ($slot_end - strtotime($stop_time) >= 300) {
                                    if(date('G.i', $round_stop) != date('G.i', $slot_start)){
                                        //echo "1";
                                        // if($_SESSION['user_id'] == 'cifo001')
                                        //     echo "2";
                                        $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                                        $this->tables = array('timetable');
                                        $this->fields = array('time_to', 'status', 'created_status', 'alloc_emp');
                                        $this->field_values = array(date('G.i', $round_stop), '4', '1', $login_user);
                                        $this->conditions = array('id = ?');
                                        $this->condition_values = array($row['id']);
                                        if ($this->query_update()) {
                                            //echo "1";
                                            $mail_slots .= date('Y-m-d', $round_stop) . " " . date('G.i', $slot_start) . "-" . date('G.i', $round_stop) . "<br>Kund: " . $row['cust_name'] . "<br>";
                                            
                                            if($this->slot_add_custom_type('', $customer, $row['date'], date('G.i',$round_stop), $row['time_to'], $login_user, $row['fkkn'], $row['type'], '', null, 4)){
                                                //echo "2";
                                                $early_going_body = $smarty->translate['cg_early_going_mail_body_start']."<br>";
                                                //$early_going_body .= $smarty->translate['customer'].": ".$row['cust_name']."<br>";
                                                $early_going_body .= $smarty->translate['employee'].": ".$row['employee_name']."<br>";
                                                //$early_going_body .= $smarty->translate['slot'].": ".sprintf('%05.02f',$slot_between_dets['time_from'])." - ".sprintf('%05.02f',$slot_between_dets['time_to'])."<br>";  
                                                $early_going_body .= $smarty->translate['slot'].":<br>".$mail_slots;  
                                                $early_going_body .= $smarty->translate['early_by'].": ".gmdate('H:i',($slot_end - $round_stop))."h<br>";
                                                $early_going_body .= $smarty->translate['cg_early_going_mail_body_end']."<br>";
                                                $display_message = str_replace("{{MINUTES}}", gmdate('H:i',($slot_end - $round_stop)), $smarty->translate['cg_early_going_msg_to_user']);
                                                $this->send_internal_external_mail($employe_data,$customer,$smarty->translate['cg_early_going_mail_subject'],$early_going_body);
                                                $flag = 1;
                                                $slots .= $row['id'] . ',';
                                                break;
                                            }else{
                                                $flag = 0;
                                                break;
                                            }                                            
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }else{
                                        $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                                        $this->tables = array('timetable');
                                        $this->fields = array( 'status', 'created_status', 'alloc_emp');
                                        $this->field_values = array('1', '0', $login_user);
                                        $this->conditions = array('id = ?');
                                        $this->condition_values = array($row['id']);
                                        if ($this->query_update()) {                                            
                                            $flag = 1;
                                            $slots .= $row['id'] . ',';
                                            break;
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }
                                    //echo  "flag".$flag;
                                }
                            }
                            $previous_end = $slot_end;
                        }
                    }
                    
                }
                
                if ($flag == 1) {
                    
                    
                    if ($candg_flag == 0) {

                        if (strtotime($stop_time) > $slot_end || $slot_end == '') {
                            if ($slot_end != '') {
                                
                          
                                $round_start = round($slot_end / (5 * 60)) * (5 * 60);
                                $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                                $temp_date = strtotime(date('Y-m-d', $round_start));
                                $previous_break_excess = 0;

                                while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                                    
                                    if ($temp_date == strtotime(date('Y-m-d', $round_start)) && $temp_date == strtotime(date('Y-m-d', $slot_start))) {
                                        
                                        if ($temp_date == strtotime(date('Y-m-d', $round_stop)))
                                            $time_to = date('G.i', $round_stop);
                                        else
                                            $time_to = 24.00;
                                            ///HERE BREAK NOT INCLUDED
                                            $mail_slots .= date('Y-m-d', $round_stop) . " " . date('G.i', $slot_start) . "-" . date('G.i', $round_stop) . "<br>Kund: " . $slot_det['cust_name'] . "<br>";
                                            $slots .= $row['id'] . ',';
                                            $tmp_time_from = date('G.i', $slot_end);
                                            $tmp_time_to = $time_to;
                                            if ($tmp_time_from != $tmp_time_to) {
                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $this->rollback_transaction();
                                                    $obj_dona->rollback_transaction();
                                                    $flag = 0;
                                                }
                                            }
                                        
                                    } else {
                                        $tmp_time_from = 0.00;
                                        $tmp_time_to = 24.00;
                                        if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                            $tmp_time_to = date('G.i', $round_stop);
                                        }
                                        //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                        if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                            //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                            //When there is break hours need to be inserted 
                                            // if ($page == 'employee')
                                            //     $customer = $previous_data['customer'];
                                            // elseif ($page == 'customer')
                                            //     $login_user = $previous_data['employee'];
                                            $slot_time_from = $tmp_time_from;
                                            $slot_time_to = $tmp_time_to;

                                            if ($previous_break_excess > 0) {
                                                $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                                if ($slot_time_from != $slot_time_to) {
                                                    //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $tmp_slots;
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                                        if ($slot_time_to != $tmp_break_time) {
                                                            //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                                $slots .= $obj_dona->get_id() . ',';
                                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                            } else {
                                                                $flag = 0;
                                                                break;
                                                            }
                                                        }
                                                        $slot_time_from = $tmp_break_time;
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            }


                                            $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);

                                            while ($tmp_break_time <= $tmp_time_to) {
                                                $previous_break_excess = 0;
                                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                                if ($slot_time_from != $slot_time_to) {
                                                    //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
                                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $tmp_slots;
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                        if ($slot_time_to != $tmp_break_time) {
                                                            //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "<br>";
                                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                                $slots .= $obj_dona->get_id() . ',';
                                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                            } else {
                                                                $flag = 0;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                    //echo "-------------------------------------------------------------------------------------<br>";
                                                }
                                                $slot_time_from = $tmp_break_time;
                                                $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                                $slot_time_to = $tmp_time_to;
                                            }
                                            if ($tmp_break_time > $tmp_time_to) {
                                                if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                                    $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                                    if ($slot_time_from != $slot_time_to) {
                                                        //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";

                                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                            $slots .= $tmp_slots;
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                            if ($slot_time_to != $tmp_time_to) {
                                                                //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "<br>";
                                                                if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                                    $slots .= $obj_dona->get_id() . ',';
                                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                                } else {
                                                                    $flag = 0;
                                                                    break;
                                                                }
                                                            }
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                        //echo "-------------------------------------------------------------------------------------<br>";
                                                    }
                                                } else {
                                                    $slot_time_to = $tmp_time_to;
                                                    if ($slot_time_from != $slot_time_to) {
                                                        //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
                                                        //echo "-------------------------------------------------------------------------------------<br>";
                                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                            $slots .= $tmp_slots;
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                }

                                                $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                            }
                                            // End of break hours block
                                        } else {
                                            // if ($page == 'employee')
                                            //     $customer = $previous_data['customer'];
                                            // elseif ($page == 'customer')
                                            //     $login_user = $previous_data['employee'];
                                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, $previous_data['fkkn'], 0, '', null, 4)) {
                                                $slots .= $tmp_slots;
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                        }
                                    }
                                    $temp_date = strtotime('+1 day', $temp_date);
                                }
                                
                            } else {
                                $round_start = round(strtotime($start_date_time) / (5 * 60)) * (5 * 60);
                                $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                                $temp_date = strtotime(date('Y-m-d', $round_start));
                                $previous_break_excess = 0;
                                while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                                    $tmp_time_from = 0.00;
                                    $tmp_time_to = 24.00;
                                    if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                                        $tmp_time_from = date('G.i', $round_start);
                                    }
                                    if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                        $tmp_time_to = date('G.i', $round_stop);
                                    }
                                    //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                    if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                        //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                        //When there is break hours need to be inserted 
                                        // if ($page == 'employee')
                                        //     $customer = $previous_data['customer'];
                                        // elseif ($page == 'customer')
                                        //     $login_user = $previous_data['employee'];
                                        $slot_time_from = $tmp_time_from;
                                        $slot_time_to = $tmp_time_to;

                                        if ($previous_break_excess > 0) {
                                            $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_break_time) {
                                                        //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                    $slot_time_from = $tmp_break_time;
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        }


                                        $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);

                                        while ($tmp_break_time <= $tmp_time_to) {
                                            $previous_break_excess = 0;
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_break_time) {
                                                        //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "<br>";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                                //echo "-------------------------------------------------------------------------------------<br>";
                                            }
                                            $slot_time_from = $tmp_break_time;
                                            $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                            $slot_time_to = $tmp_time_to;
                                        }
                                        if ($tmp_break_time > $tmp_time_to) {
                                            if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                                if ($slot_time_from != $slot_time_to) {
                                                    //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";

                                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $tmp_slots;
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                        if ($slot_time_to != $tmp_time_to) {
                                                            //      echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "<br>";
                                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                                $slots .= $obj_dona->get_id() . ',';
                                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                            } else {
                                                                $flag = 0;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                    //echo "-------------------------------------------------------------------------------------<br>";
                                                }
                                            } else {
                                                $slot_time_to = $tmp_time_to;
                                                if ($slot_time_from != $slot_time_to) {
                                                //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
                                                //echo "-------------------------------------------------------------------------------------<br>";
                                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $tmp_slots;
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            }

                                            $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                        }
                                        /** End of break hours block* */
                                    } else {
                                        // if ($page == 'employee')
                                        //     $customer = $previous_data['customer'];
                                        // elseif ($page == 'customer')
                                        //     $login_user = $previous_data['employee'];
                                        if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, $previous_data['fkkn'], 0, '', null, 4)) {
                                            $slots .= $this->get_id() . ',';
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . /*$previous_data['cust_name']*/$customer . "<br>";
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }
                                    $temp_date = strtotime('+1 day', $temp_date);
                                }
                            }
                        }
                    }

                    if ($flag == 1) {
                        $this->tables = array('user_task');
                        $this->fields = array('slotids=?', 'end_time=?', 'dur=TIMEDIFF(`end_time`,`start_time`)', 'status=?');
                        $this->field_values = array($slots, $stop_time, '1');
                        $this->conditions = array('id = ?');
                        $this->condition_values = array($this->task_id);
                        if ($this->query_update(1)) {
                            $this->commit_transaction();
                            $obj_dona->commit_transaction();
                            if ($mail_slots != '' && $early_going_body == '') {
                               
                                $this->send_internal_external_mail($employe_data,$customer,$mail_subject,$mail_message . "Datum och pass:<br>" . $mail_slots);
                            }
                            return 1;
                        } else {
                            $this->rollback_transaction();
                            $obj_dona->rollback_transaction();
                            return 0;
                        }
                    } else {
                        $this->rollback_transaction();
                        $obj_dona->rollback_transaction();
                        return 0;
                    }
                } else {
                    $this->rollback_transaction();
                    $obj_dona->rollback_transaction();
                    return 0;
                }
                    
            }else{
                    $this->tables = array('user_task');
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($this->task_id);
                    if ($this->query_delete()) {
                        if(!$check_report_sign)
                            return -3;
                        elseif(!$check_leave)
                            return -4;
                    }
            }
        }
    }

    function get_previous_slot_details($start_time, $employee) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'type', 'fkkn');
        $this->conditions = array('AND', 'status =1', 'employee = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
        $this->condition_values = array($employee, $start_time);
        $this->order_by = array('date desc', 'time_from desc');
        $this->query_generate();
        //echo $this->sql_query;
        //echo "<pre>\n".print_r($this->condition_values , 1)."</pre>";
        $data = $this->query_fetch();
        if (!empty($data))
            return $data[0];
        else
            return array();
    }

    function check_slot_start($date, $start_time, $page = 'employee') {
        $this_employ = $_SESSION['user_id'];
//        $min_start_time = new DateTime('2014-03-29 16:00:00');  
//        $min_start_time->sub(new DateInterval('PT15M'));
        
        $min_start_time = new DateTime;
        $min_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $min_start_time->setTimestamp(time());
        $min_start_time->sub(new DateInterval('PT'.self::INPUT_TIME_DEVIATION.'M'));
        $min_start_time = $min_start_time->format('Y-m-d G:i:s');

//          $max_start_time = new DateTime('2014-03-29 16:00:00');
//          $max_start_time->add(new DateInterval('PT15M'));
        $max_start_time = new DateTime;
        $max_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $max_start_time->setTimestamp(time());
        $max_start_time->add(new DateInterval('PT'.self::INPUT_TIME_DEVIATION.'M'));
        $max_start_time = $max_start_time->format('Y-m-d G:i:s');

        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'date', 'cast(concat(`date`, " ", `time_from`) as datetime) as time_from', 'CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), " 00.00") as datetime) ELSE cast(concat(`date`, " ", `time_to`) as datetime) END as time_to', 'type', 'status', 'fkkn', '(time_to - time_from) as total_hours', '(SELECT concat(last_name, " ", first_name) FROM customer where username = timetable.customer) AS cust_name', '(SELECT concat(last_name, " ", first_name) FROM employee where username = timetable.employee) AS emp_name');
        if ($page == 'employee') {
            $this->conditions = array('AND', 'status =1', 'employee = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
        } elseif ($page == 'customer') {
            $this->conditions = array('AND', 'status =1', 'customer = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
        }

        $this->condition_values = array($this_employ, $min_start_time, $max_start_time);
        $this->order_by = array('date desc', 'time_from', 'time_to desc');
        $this->query_generate();
        //echo $this->sql_query;
        //echo "<pre>\n".print_r($this->condition_values , 1)."</pre>";
        return $this->query_fetch();
    }

    function employee_get_task_slots($employee, $date, $time_from, $mod = 'id', $status = '') {
        //Here time to is in php datetime format... formated via strtotime()
        $this_employ = $employee;
        $min_start_time = new DateTime($date . ' ' . $time_from);
        $min_start_time->sub(new DateInterval('PT5M'));
        $min_start_time = $min_start_time->format('Y-m-d G:i:00');

//          $max_start_time = new DateTime('2014-03-29 19:00:00');

        $max_start_time = new DateTime;
        $max_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $max_start_time->setTimestamp(time());
        $max_start_time = $max_start_time->format('Y-m-d G:i:00');
        // if((strtotime($max_start_time)-strtotime($min_start_time)) < 1800){
        //     $max_start_time = new DateTime($date . ' ' . $time_from);
        //     $max_start_time->add(new DateInterval('PT'.(self::INPUT_TIME_DEVIATION*2).'M'));
        //     $max_start_time = $max_start_time->format('Y-m-d G:i:s');
        // }

        $this->tables = array('timetable');
        if ($mod == 'id')
            $this->fields = array('id', 'CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), " 00.00") as datetime) ELSE cast(concat(`date`, " ", `time_to`) as datetime) END as time_to');
        else
            $this->fields = array('(SELECT concat(first_name, " ", last_name) FROM employee where username = timetable.employee) AS employee_name', '(SELECT concat(first_name, " ", last_name) FROM customer where username = timetable.customer) AS cust_name', 'id', 'employee', 'date', 'time_from', 'time_to', 'type', 'status', 'fkkn', '(time_to - time_from) as total_hours', 'cast(concat(`date`, " ", `time_from`) as datetime) as slot_start', 'CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), " 00.00") as datetime) ELSE cast(concat(`date`, " ", `time_to`) as datetime) END as slot_end', 'created_status');
        if ($status == '') {
            $this->conditions = array('AND', 'employee = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
            $this->condition_values = array($this_employ, $min_start_time, $max_start_time);
        } else {

            $this->conditions = array('AND', array('IN', 'status', $status), 'employee = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
            $this->condition_values = array($this_employ, $min_start_time, $max_start_time);
        }


        $this->order_by = array('date', 'time_from', 'time_to desc');
        $this->query_generate();
        // if($_SESSION['user_id'] == 'cifo001'){
        //     echo $this->sql_query;
        //     echo "<pre>\n".print_r($this->condition_values , 1)."</pre>";
        // }
        $slot_datas = $this->query_fetch();
        if ($mod == 'all')
            return $slot_datas;

        foreach ($slot_datas as $slot) {

            $datas[] = $slot['id'];
        }
        return $datas;
    }

    function customer_get_task_slots($customer, $date, $time_from, $mod = 'id', $status = '') {
        //Here time to is in php datetime format... formated via strtotime()
        $this_customer = $customer;
        $min_start_time = new DateTime($date . ' ' . $time_from);
        $min_start_time = $min_start_time->format('Y-m-d G:i:s');

//          $max_start_time = new DateTime('2014-03-29 19:00:00');

        $max_start_time = new DateTime;
        $max_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $max_start_time->setTimestamp(time());
        $max_start_time = $max_start_time->format('Y-m-d G:i:s');

        $this->tables = array('timetable');
        if ($mod == 'id')
            $this->fields = array('id', 'CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), " 00.00") as datetime) ELSE cast(concat(`date`, " ", `time_to`) as datetime) END as time_to');
        else
            $this->fields = array('(SELECT concat(first_name, " ", last_name) FROM customer where username = timetable.customer) AS cust_name', '(SELECT concat(first_name, " ", last_name) FROM employee where username = timetable.employee) AS emp_name', 'id', 'employee', 'date', 'time_from', 'time_to', 'type', 'status', 'fkkn', '(time_to - time_from) as total_hours', 'cast(concat(`date`, " ", `time_from`) as datetime) as slot_start', 'CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), " 00.00") as datetime) ELSE cast(concat(`date`, " ", `time_to`) as datetime) END as slot_end', 'created_status');
        if ($status == '') {
            $this->conditions = array('AND', 'customer = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
            $this->condition_values = array($this_customer, $min_start_time, $max_start_time);
        } else {

            $this->conditions = array('AND', array('IN', 'status', $status), 'customer = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
            $this->condition_values = array($this_customer, $min_start_time, $max_start_time);
        }


        $this->order_by = array('date', 'time_from', 'time_to desc');
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>\n".print_r($this->condition_values , 1)."</pre>";
        $slot_datas = $this->query_fetch();
        if ($mod == 'all')
            return $slot_datas;

        foreach ($slot_datas as $slot) {

            $datas[] = $slot['id'];
        }
        return $datas;
    }

    function get_slots_between_two_times($employee, $start_time, $end_time, $status, $field='') {

        $this_employ = $employee;
        $datas = array();

        if ($field == 'id')
            $this->sql_query = "SELECT id, cast(concat(`date`, ' ', `time_from`) as datetime) as slot_start, CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), ' 00.00') as datetime) ELSE cast(concat(`date`, ' ', `time_to`) as datetime) END as slot_end FROM timetable WHERE ";
        else
            $this->sql_query = "SELECT id, CASE `time_to` WHEN 24 THEN cast(concat(DATE_ADD(`date`, INTERVAL 1 DAY), ' 00.00') as datetime) ELSE cast(concat(`date`, ' ', `time_to`) as datetime) END as slot_end, (SELECT concat(first_name, ' ', last_name) FROM customer where username = timetable.customer) AS cust_name, employee, date, time_from, time_to, type, status, fkkn, (time_to - time_from) as total_hours, cast(concat(`date`, ' ', `time_from`) as datetime) as slot_start FROM timetable WHERE ";
        if ($status == '') {
            $this->sql_query .= "employee = '$this_employ' ";
        } else {
            $this->sql_query .= "status IN ($status) AND employee = '$this_employ' ";
        }
        $this->sql_query .= "HAVING (slot_start >= '$start_time' AND  slot_start < '$end_time') OR (slot_end > '$start_time' AND  slot_end <= '$end_time') OR (slot_start < '$start_time' AND  slot_end > '$end_time') ORDER BY date, time_from, time_to DESC";

        $slot_datas = $this->query_fetch();
        if ($field != 'id')
            return $slot_datas;

        foreach ($slot_datas as $slot) {

            $datas[] = $slot['id'];
        }
        return $datas;
    }

    function employee_get_leave_slot($employee, $date, $time_from, $time_to) {

        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', array('IN', 'status', '2'), 'employee = ?', 'date = ?', 'time_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', array('IN', 'status', '2'), 'employee = ?', 'date = ?', 'time_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($employee, $date, (float) $time_to, $employee, $date, (float) $time_from);
        $this->order_by = array('time_from');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'fkkn', 'type', 'status', 'comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name', '(SELECT id FROM leave_sms where slot = timetable.id and status = 1) AS sms_status');
        $this->conditions = array('IN', 'relation_id', $query_inner);
        $this->condition_values = array($employee, $date, (float) $time_to, $employee, $date, (float) $time_from);
        $this->order_by = array('time_from');
        $this->query_generate();
        $slot_datas = $this->query_fetch();
        foreach ($slot_datas as $slot) {
            $sms_process = '';
            if ($slot['status'] == 1 && $slot['sms_status'] != '')
                $sms_process = 1;
            $datas[] = array('id' => $slot['id'], 'customer' => $slot['customer'], 'employee' => $slot['employee'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'fkkn' => $slot['fkkn'], 'status' => $slot['status'], 'type' => $slot['type'], 'cust_name' => $slot['cust_last_name'] . ' ' . $slot['cust_first_name'], 'cust_name_ff' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_last_name'] . ' ' . $slot['emp_first_name'], 'emp_name_ff' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'sms_status' => $sms_process);
        }
        //echo "<pre>\n".print_r($datas, 1)."</pre>";
        if (!empty($datas))
            return $datas;
        else
            return array();
    }

    function update_employee_slot($slot_id) {
        $slot_det = $this->get_slot_by_id($slot_id);
        $status = 0;
        if ($slot_det['customer'] != '')
            $status = 1;
        $this->tables = array('timetable');
        $this->fields = array('employee', 'status');
        $this->field_values = array($this->emp, $status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        return $this->query_update();
    }

    function get_all_employee_leave($year = NULL, $month = NULL, $start = 0, $mob_app = 1) {

        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($login_user_role == 2 || $login_user_role == 7) {
            $team_members = $employee->team_members_for_employee_report($login_user);
            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
        }
        if ($login_user_role == 3) {
//            $team_members = $employee->team_members($login_user);
//            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
            $team_employee_data = '\'' . $login_user . '\'';
        }
        $this->tables = array('leave', 'employee', 'employee` as `e1');
        $this->fields = array('leave.id as id', 'leave.group_id as group_id', 'leave.type as type', 'MIN(leave.date) as start_date', 'MAX(leave.date) as end_date', 'leave.employee as employee', 'leave.time_from as time_from', 'leave.time_to as time_to', "concat(employee.last_name,' ',employee.first_name) as empname", "concat(employee.first_name,' ',employee.last_name) as empname_ff", 'leave.status as status', 'leave.appr_date as appr_date',
            'leave.appr_emp as appr_emp', "concat(e1.last_name,' ',e1.first_name) as appr_empname", "concat(e1.first_name,' ',e1.last_name) as appr_empname_ff");
        switch ($login_user_role) {
            case 1:
                if ($year != NULL && $month != NULL) {
                    $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                    $this->condition_values = array($year, $month);
                }/* else {
                  $this->conditions = array('AND', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                  } */
                break;

            case 2:
                if ($year != NULL && $month != NULL) {
                    $this->conditions = array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                    $this->condition_values = array($year, $month);
                } /* else {
                  $this->conditions = array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                  } */
                break;

            case 3:
                if ($year != NULL && $month != NULL) {
                    $this->conditions = array('AND',
                        array('OR', 'leave.employee = ?',
                            array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'leave.status = 1')),
                        'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                    $this->condition_values = array($login_user, $year, $month);
                } /* else {
                  $this->conditions = array('AND',
                  array('OR', 'leave.employee = ?',
                  array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'leave.status = 1')),
                  'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                  $this->condition_values = array($login_user);
                  } */
                break;
        }
        $this->group_by = array('leave.group_id');
        $this->order_by = array('leave.date DESC', 'leave.time_from', 'leave.status');
        if ($mob_app == 1)
            $this->limit = '' . $start . ',10';
        $this->query_generate();
        //echo $this->sql_query;
        // echo "<pre>\n".print_r($this->condition_values, 1)."</pre>";
        $datas = $this->query_fetch();
        $result = array();
        //echo "<pre>\n".print_r($datas, 1)."</pre>";
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $this->tables = array('timetable');
                $this->fields = array('id');
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = 2');
                $this->condition_values = array($data['employee'], $data['start_date'], $data['end_date']);
                $this->query_generate();
                $leave_ids = $this->query_fetch();
                $process_status = 0;

                foreach ($leave_ids as $leave_id) {
                    $this->tables = array('timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', 'relation_id = ?', 'status = 0');
                    $this->condition_values = array($leave_id['id']);
                    $this->query_generate();
//                    echo $this->sql_query."<br>";
//                    echo "<pre>\n".print_r($this->condition_values, 1)."</pre>";
                    $relation_ids = $this->query_fetch();
                    if (!empty($relation_ids)) {
//                        echo "<pre>\n".print_r($result, 1)."</pre>";
//                        echo "<pre>\n".print_r($data, 1)."</pre>";
//                        $result[] = array_merge($data, array("process_status" => 1));

                        $process_status = 1;
                        break;
                    }
                }
                $result[] = array_merge($data, array("process_status" => $process_status));
//                if ($process_status == 0)
//                    $result[] = array_merge($data, array("process_status" => 0));
            }
        }

        //echo "<pre>\n".print_r($result, 1)."</pre>";
        $sort = array();
        foreach ($result as $k => $v) {
            $sort['process_status'][$k] = $v['process_status'];
            $sort['start_date'][$k] = strtotime($v['start_date']);
        }
        array_multisort($sort['process_status'], SORT_DESC, $sort['start_date'], SORT_DESC, $result);
        //echo "<pre>\n".print_r($result, 1)."</pre>";
        return $result;
    }

    function get_employee_leave_by_groupid($group_id) {
        /**
         * Author: Shamsu
         * for: get_employee_leave_by_groupid
         */
        // to get from_date and time
        $this->tables = array('leave');
        $this->fields = array('concat( date, " ", CONVERT(`time_from`,CHAR(5)))');
        $this->conditions = array('group_id = gID');
        $this->order_by = array('date ASC ');
        $this->limit = 1;
        $this->query_generate();
        $sub_query_from_date = $this->sql_query;

        // to get to_date and time
        $this->tables = array('leave');
        $this->fields = array('concat( date, " ", CONVERT(`time_to`,CHAR(5)))');
        $this->conditions = array('group_id = gID');
        $this->order_by = array('date DESC ');
        $this->limit = 1;
        $this->query_generate();
        $sub_query_to_date = $this->sql_query;


        $this->tables = array('leave');
        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '(' . $sub_query_from_date . ') AS From_date',
            '(' . $sub_query_to_date . ') AS To_date',
            'leave.employee as employee', "(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.employee) AS empname", "(SELECT concat(last_name,' ',first_name) FROM employee where username = leave.employee) AS empname_lf",
            'leave.status as status', 'leave.appr_date as appr_date',
            'leave.appr_emp as appr_emp', "(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.appr_emp) AS appr_empname", "(SELECT concat(last_name,' ',first_name) FROM employee where username = leave.appr_emp) AS appr_empname_lf", 'leave.comment as comment');
        $this->conditions = array('AND', 'leave.group_id = ?');
        $this->condition_values = array($group_id);
        $this->group_by = array('leave.group_id');
        $this->order_by = array('leave.date desc');
        $this->limit = 0;
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_future_schedule($employee, $year, $month) {

        /* $start = 0;
          $limit = 30;
          if ($navigation < 0)
          $start = (($navigation * -1) - 1) * $limit;
          else
          $start = $navigation * $limit; */

        $this->flush();
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'WEEKOFYEAR(date) as `week`', 'time_from', 'time_to', '(time_to - time_from) as total_hours', 'status', 'type', 'fkkn', 'comment', 'created_status',
            'IF ((SELECT count(id) from report_signing where employee = timetable.employee and customer = timetable.customer and month(date) = month(timetable.date) and year(date) = year(timetable.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        /* if ($navigation < 0)
          $this->conditions = array('AND', 'employee = ?', 'date < ?');
          else
          $this->conditions = array('AND', 'employee = ?', 'date >= ?'); */
        $this->conditions = array('AND', 'employee = ?', 'YEAR(date) = ?', 'MONTH(date) = ?');
        $this->condition_values = array($employee, $year, $month);
        /* if ($navigation < 0)
          $this->order_by = array('date desc');
          else */
        $this->order_by = array('date', 'time_from', 'time_to');

//        $this->limit = $start . ',' . $limit;
        $this->query_generate();
        return $this->query_fetch();
    }
    
    function get_future_schedule_customer($customer, $year, $month) {

        /* $start = 0;
          $limit = 30;
          if ($navigation < 0)
          $start = (($navigation * -1) - 1) * $limit;
          else
          $start = $navigation * $limit; */

        $this->flush();
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'WEEKOFYEAR(date) as `week`', 'time_from', 'time_to', '(time_to - time_from) as total_hours', 'status', 'type', 'fkkn', 'comment', 'created_status',
            'IF ((SELECT count(id) from report_signing where employee = timetable.employee and customer = timetable.customer and month(date) = month(timetable.date) and year(date) = year(timetable.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        /* if ($navigation < 0)
          $this->conditions = array('AND', 'employee = ?', 'date < ?');
          else
          $this->conditions = array('AND', 'employee = ?', 'date >= ?'); */
        $this->conditions = array('AND', 'customer = ?', 'YEAR(date) = ?', 'MONTH(date) = ?');
        $this->condition_values = array($customer, $year, $month);
        /* if ($navigation < 0)
          $this->order_by = array('date desc');
          else */
        $this->order_by = array('date', 'time_from', 'time_to');

//        $this->limit = $start . ',' . $limit;
        $this->query_generate();
        //echo $this->sql_query;
        //print_r($this->condition_values);
        return $this->query_fetch();
    }

    function user_role($username) {

        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('role');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['role'];
    }

    function get_customer_detail($username) {
        $this->tables = array('customer');
        $this->fields = array('first_name', 'last_name','fkkn');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $this->sql_query;
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

    function get_employee_detail($username) {
        $this->tables = array('employee');
        $this->fields = array('first_name', 'last_name','username','mobile','email');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $this->sql_query;
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

    function get_leave_sms_details($id, $employee) {

        $this->tables = array('leave_sms');
        $this->fields = array('id', 'slot', 'employee', 'send_time', 'status', 'receive_time');
        $this->conditions = array('AND', 'slot = ?', 'employee = ?');
        $this->condition_values = array($id, $employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data[0];
        else
            return false;
    }

    function get_sms_status($id) {

        $this->tables = array('leave_sms');
        $this->fields = array('status');
        $this->conditions = array('slot = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data[0]['status'];
        else
            return NULL;
    }

    function update_sms_records($id, $employee, $status) {
        $this->flush();
        $this->tables = array('leave_sms');
        $this->fields = array('slot', 'employee', 'status', 'alloc_employee');
        $this->field_values = array($id, $employee, $status, $_SESSION['user_id']);
        if ($this->query_insert()) {
            $sms_tbl_id = $this->get_id();
            //echo 'local_id: '.$sms_tbl_id;
            return $this->insert_sms_common_entry($sms_tbl_id);
        } else
            return FALSE;
    }

    function insert_sms_common_entry($local_sms_id) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: inserting sms to common sms table
         * This function also delete previous records from global sms table when the tag reaches @ 5000/9999
         * @return tag_id if TRUE, else return FALSE
         * @since 2014-08-29
         */
        if ($local_sms_id == '')
            return FALSE;
        $tag_id = '';
        $transaction_result = TRUE;

        // finding next tag id
        $this->flush();
        $this->tables = array($this->db_master . '.leave_sms_common');
        $this->fields = array('tag_id', 'sms_tbl_id', 'company_id', 'created_date');
        $this->order_by = array('created_date DESC', 'created_date_ms DESC');
        $this->limit = 5;
        $this->query_generate();
        //echo $this->sql_query;
        $common_sms_datas = $this->query_fetch();
        //echo "common_sms_datas<pre>".print_r($common_sms_datas, 1)."</pre>";
        if (empty($common_sms_datas))
            $tag_id = 1;
        else {
            if ($common_sms_datas[0]['tag_id'] == 9999 || $common_sms_datas[0]['tag_id'] == 5000) {
                //deleting previous global sms records
                if ($common_sms_datas[0]['tag_id'] == 9999)
                    $transaction_result = $this->delete_sms_common_entry(1, 5000);
                else if ($common_sms_datas[0]['tag_id'] == 5000)
                    $transaction_result = $this->delete_sms_common_entry(5001, 9999);

                if (!$transaction_result)
                    return FALSE;
            }

            $tag_id = ($common_sms_datas[0]['tag_id'] == 9999 ? 1 : ($common_sms_datas[0]['tag_id'] + 1));
        }
        // finding next tag id -endz

        $this->flush();
        $this->tables = array($this->db_master . '.leave_sms_common');
        $this->fields = array('tag_id', 'sms_tbl_id', 'company_id', 'created_date', 'created_date_ms');
        $ms = explode(".", microtime(true));
//        echo date("Y-m-d H:i:s",$ms[0]).substr((string)$ms[1],1,4);
        $this->field_values = array($tag_id, $local_sms_id, $_SESSION['company_id'], date('Y-m-d H:i:s'), $ms[1]);
        //print_r(array($tag_id, $local_sms_id, $_SESSION['company_id'], date('Y-m-d H:i:s'),$ms[1]));
//        $this->field_values = array($tag_id, $local_sms_id, $_SESSION['company_id'], date('Y-m-d H:i:s'), round(microtime(true) * 1000));
        return ($this->query_insert() ? $tag_id : FALSE);
    }

    function delete_sms_common_entry($start_tag_id, $end_tag_id = NULL) {
        $this->tables = array($this->db_master . '.leave_sms_common');
        if ($end_tag_id != NULL) {
            $this->conditions = array('BETWEEN', 'tag_id', '?', '?');
            $this->condition_values = array($start_tag_id, $end_tag_id);
        } else {
            $this->conditions = array('tag_id = ?');
            $this->condition_values = array($start_tag_id);
        }
        return $this->query_delete();
    }

    function update_sms_records_reply($slot_id, $employee, $time, $status) {

        $this->tables = array('leave_sms');
        $this->fields = array('status', 'receive_time');
        $this->field_values = array($status, $time);
        $this->conditions = array('AND', 'slot = ?', 'employee = ?');
        $this->condition_values = array($slot_id, $employee);
        return $this->query_update();
    }

    function update_sms_records_accept($slot_id, $employee, $conf, $slot_status = 0, $db_name = '') {
        $obj_emp = new employee();

        $temp = array();
        $handle = fopen($filename, 'a');
        fwrite($handle, "Ok\n");
        fclose($handle);
        if ($db_name != '') {
            $this->select_db($db_name);
            $obj_emp->select_db($db_name);
        }
        $this->begin_transaction();
        if ($conf == 1) {
            $this->tables = array('leave_sms');
            $this->fields = array('status');
            $this->field_values = array(1);
            $this->conditions = array('AND', 'slot = ?', 'employee = ?');
            $this->condition_values = array($slot_id, $employee);
        } else if ($conf == 0) {
            $this->tables = array('leave_sms');
            $this->fields = array('status', 'receive_time');
            $this->field_values = array(1, date('Y-m-d H:i:s', time()));
            $this->conditions = array('AND', 'slot = ?', 'employee = ?');
            $this->condition_values = array($slot_id, $employee);
        }

        if ($this->query_update()) {

            $slot_dets = array();
            if ($slot_status == 2) {
                $slot_dets = $obj_emp->check_relations_in_timetable_for_leave($slot_id);
            } else {
                $slot_dets[0] = $obj_emp->customer_employee_slot_details($slot_id);
            }
            //echo "<pre>slot_dets".print_r($slot_dets,1)."</pre>";
            $transaction_flag = TRUE;
            foreach ($slot_dets as $slot_det) {

                $process_params = array(
                    'employee' => $employee,
                    'customer' => $slot_det['customer'],
                    'date' => $slot_det['date'],
                    'type' => $slot_det['type'],
                    'time_from' => $slot_det['time_from'],
                    'time_to' => $slot_det['time_to']);
                //echo "<pre>".print_r($process_params,1)."</pre>";
                if (!$obj_emp->findout_slot_alteration_bug($process_params, $temp, 0)) {

                    $transaction_flag = FALSE;
                    $this->rollback_transaction();
                    return false;
                }
                $this->tables = array('timetable');
                $this->fields = array('employee', 'status');
                $this->field_values = array($employee, 1);
                $this->conditions = array('id = ?');
                $this->condition_values = array($slot_det['id']);
            }
            if ($transaction_flag) {
                if ($this->query_update()) {
                    $this->tables = array('leave_sms');
                    $this->fields = array('status');
                    $this->field_values = array(2);
                    $this->conditions = array('AND', 'slot = ?', 'employee != ?');
                    $this->condition_values = array($slot_id, $employee);
                    if ($this->query_update()) {
                        $this->commit_transaction();
                        return true;
                    } else {
                        $this->rollback_transaction();
                        return false;
                    }
                } else {
                    $this->rollback_transaction();
                    return false;
                }
            }
        } else {
            $this->rollback_transaction();
            return false;
        }
    }

    function get_employee_mobile($employee) {
        $this->tables = array('employee');
        $this->fields = array('mobile');
        $this->conditions = array('username = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['mobile'];
    }

    function get_leave_details($slot_id) {
        $slot_det = $this->get_slot_by_id($slot_id);
        $this->tables = array('leave');
        $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'apply_date', 'appr_emp', 'appr_date', 'appr_comment', 'status');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from <= ?', 'time_to >= ?');
        $this->condition_values = array($slot_det['employee'], $slot_det['date'], (float) $slot_det['time_from'], (float) $slot_det['time_to']);
        $this->query_generate();

        $data = $this->query_fetch();

        if ($data[0]) {

            return $data[0];
        } else {
            return array();
        }
    }

    function get_employee_leave_slots($this_employee, $date, $time_from, $time_to) {
        /**
         * Author: Shamsu
         * for: get employee leave timeslots from timetable using timefrom & timeto
         */
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from >= ?', 'time_to <= ?', 'status = 2');
        $this->condition_values = array($this_employee, $date, (float) $time_from, (float) $time_to);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_untreated_leaves($this_employee, $year, $month) {
        /**
         * Author: Shamsu
         * for: get employees untreated leaves
         */
        $this->flush();
        $this->tables = array('leave');
        $this->fields = array('employee', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'status = 0', 'employee = ?', 'month(date) = ?', 'year(date) = ?');
        $this->condition_values = array($this_employee, $month, $year);
        $this->order_by = array('date', 'time_from', 'time_to desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function check_untreated_employee_leave_in_a_customer($this_employee, $year, $month, $this_customer = '') {
        /**
         * Author: Shamsu
         * for: check there is any untreated leave of employee with a customer
         */
        $untreated_leaves = FALSE;
        $employee_untreated_leaves = $this->get_untreated_leaves($this_employee, $year, $month);

        if (!empty($employee_untreated_leaves) && $this_customer != '') { //checking this slot is affecting $this_customer
            $obj_timetable = new timetable();
            foreach ($employee_untreated_leaves as $leave) {
                $time_table_data = $obj_timetable->employee_customer_work_slots($this_employee, $this_customer, $leave['date'], $leave['time_from'], $leave['time_to']);
                if (!empty($time_table_data)) {
                    $untreated_leaves = TRUE;
                    break;
                }
            }
        } elseif (!empty($employee_untreated_leaves)) {
            $untreated_leaves = TRUE;
        }
        return $untreated_leaves;
    }

    function get_untreated_leave_employees($year, $month, $employees = '') {
        /**
         * Author: shaju
         * for: to get all employees who are having untreated leaves         
         */
        $this->sql_query = 'SELECT distinct l.employee, e.first_name, e.last_name, e.mobile FROM `leave` l INNER JOIN employee e 
                            ON l.employee = e.username WHERE month(l.date) = ' . $month . ' AND year(l.date) = ' . $year . ' AND l.status = 0 AND 
                            e.username IN(' . $employees . ')';
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_slots_closer_to_current_time($user_id, $status, $page = 'employee') {
        $datas = array();
        $this_employ = $user_id;
        $dtz = new DateTime; // current time = server time
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $dtz->setTimestamp(time());

//          $min_start_time = new DateTime('2014-03-29 16:00:00');  
//          $min_start_time->sub(new DateInterval('PT15M'));
        $min_start_time = new DateTime;
        $min_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $min_start_time->setTimestamp(time());
        $min_start_time->sub(new DateInterval('PT'.self::INPUT_TIME_DEVIATION.'M'));
        $min_start_time = $min_start_time->format('Y-m-d G:i:s');

//          $max_start_time = new DateTime('2014-03-29 16:00:00');
//          $max_start_time->add(new DateInterval('PT15M'));
        $max_start_time = new DateTime;
        $max_start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $max_start_time->setTimestamp(time());
        $max_start_time->add(new DateInterval('PT'.self::INPUT_TIME_DEVIATION.'M'));
        $max_start_time = $max_start_time->format('Y-m-d G:i:s');
        if ($page == 'employee') {
            if ($status == 1) {
                $this->tables = array('timetable');
                $this->fields = array('(SELECT concat(first_name, " ", last_name) FROM employee where username = timetable.employee) AS emp_name', '(SELECT concat(first_name, " ", last_name) FROM customer where username = timetable.customer) AS cust_name', 'id', 'customer', 'employee', 'date', 'time_from', 'time_to', 'type', 'status', 'fkkn', '(time_to - time_from) as total_hours', 'created_status');
                $this->conditions = array('AND', 'status = ?', 'employee = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
                $this->condition_values = array($status, $this_employ, $min_start_time, $max_start_time);
                $this->order_by = array('date', 'time_from', 'time_to desc');
                $this->query_generate();
                //echo "<pre>\n".print_r($this->condition_values , 1)."</pre>";
            } else {
                $this->tables = array('timetable');
                $this->fields = array('date', 'time_from', 'time_to', 'created_status');
                $this->conditions = array('AND', 'employee = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?');
                $this->condition_values = array($this_employ, $min_start_time);
                $this->order_by = array('date ', 'time_from', 'time_to desc');
                $this->query_generate();
                $existing_data = $this->query_fetch();
                if (empty($existing_data)) {

                    $this->sql_query = "SELECT concat(c.first_name, ' ', c.last_name) AS cust_name,c.username, tt.id, tt.employee,tt.date,tt.time_from,tt.time_to,tt.type,tt.status,tt.fkkn,(tt.time_to - tt.time_from) as total_hours, tt.created_status FROM timetable tt
                                        INNER JOIN team tm ON tt.customer LIKE tm.customer AND tt.status=0 AND cast(concat(tt.date, ' ', tt.time_from) as datetime) >= '$min_start_time' AND cast(concat(tt.date, ' ', tt.time_from) as datetime) <= '$max_start_time' AND tm.employee = '$this_employ' 
                                        INNER JOIN customer c ON tt.customer LIKE c.username
                                        LEFT JOIN report_signing r ON r.customer LIKE tt.customer AND r.employee='$this_employ' AND MONTH(r.date) = MONTH(tt.date) AND YEAR(r.date) = YEAR(tt.date)
                                        LEFT JOIN  `leave` as `l` ON l.date like tt.date AND ((tt.time_from >= l.time_from AND tt.time_from < l.time_to) OR (tt.time_to > l.time_from AND tt.time_to <= l.time_to ) OR (tt.time_from <  l.time_from AND tt.time_to > l.time_to)) AND l.status!=2 AND l.employee = '$this_employ'    
                                        WHERE r.customer IS NULL AND l.employee IS NULL AND c.status = 1";
                } else {
                    $this->sql_query = "SELECT concat(c.first_name, ' ', c.last_name) AS cust_name, tt.id, tt.employee,tt.date,tt.time_from,tt.time_to,tt.type,tt.status,tt.fkkn,(tt.time_to - tt.time_from) as total_hours, tt.created_status FROM timetable tt 
                                        INNER JOIN team tm ON tt.customer LIKE tm.customer AND tt.status=0 AND cast(concat(tt.date, ' ', tt.time_from) as datetime) >= '$min_start_time' AND cast(concat(tt.date, ' ', tt.time_from) as datetime) <= '$max_start_time' AND cast(concat(tt.date, ' ', tt.time_to) as datetime) <= '" . ($existing_data[0]['date'] . ' ' . $existing_data[0]['time_from']) . "' AND tm.employee = '$this_employ' 
                                        INNER JOIN customer c ON tt.customer LIKE c.username
                                        LEFT JOIN report_signing r ON r.customer LIKE tt.customer AND r.employee='$this_employ' AND MONTH(r.date) = MONTH(tt.date) AND YEAR(r.date) = YEAR(tt.date)
                                        LEFT JOIN  `leave` as `l` ON l.date like tt.date AND ((tt.time_from >= l.time_from AND tt.time_from < l.time_to) OR (tt.time_to > l.time_from AND tt.time_to <= l.time_to ) OR (tt.time_from <  l.time_from AND tt.time_to > l.time_to)) AND l.status!=2 AND l.employee = '$this_employ'    
                                        WHERE r.customer IS NULL AND l.employee IS NULL AND c.status = 1";
                }
            }
        } elseif ($page == 'customer') {
            if ($status == 1) {
                $this->tables = array('timetable');
                $this->fields = array('(SELECT concat(first_name, " ", last_name) FROM employee where username = timetable.employee) AS emp_name', '(SELECT concat(first_name, " ", last_name) FROM customer where username = timetable.customer) AS cust_name', 'id', 'customer', 'employee', 'date', 'time_from', 'time_to', 'type', 'status', 'fkkn', '(time_to - time_from) as total_hours', 'created_status');
                $this->conditions = array('AND', 'status = ?', 'customer = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?', 'cast(concat(`date`, " ", `time_from`) as datetime) <= ?');
                $this->condition_values = array($status, $this_employ, $min_start_time, $max_start_time);
                $this->order_by = array('date', 'time_from', 'time_to desc');
                $this->query_generate();
                //echo "<pre>\n".print_r($this->condition_values , 1)."</pre>";
            } else {
                $this->tables = array('timetable');
                $this->fields = array('date', 'time_from', 'time_to');
                $this->conditions = array('AND', 'customer = ?', 'cast(concat(`date`, " ", `time_from`) as datetime) >= ?');
                $this->condition_values = array($this_employ, $min_start_time);
                $this->order_by = array('date ', 'time_from', 'time_to desc');
                $this->query_generate();
                $existing_data = $this->query_fetch();
                /* if (empty($existing_data)) {

                  $this->sql_query = "SELECT concat(c.first_name, ' ', c.last_name) AS cust_name, tt.id, tt.employee,tt.date,tt.time_from,tt.time_to,tt.type,tt.status,tt.fkkn,(tt.time_to - tt.time_from) as total_hours FROM timetable tt
                  INNER JOIN team tm ON tt.customer LIKE tm.customer AND tt.status=0 AND cast(concat(tt.date, ' ', tt.time_from) as datetime) >= '$min_start_time' AND cast(concat(tt.date, ' ', tt.time_from) as datetime) <= '$max_start_time' AND tm.employee = '$this_employ'
                  INNER JOIN customer c ON tt.customer LIKE c.username
                  LEFT JOIN report_signing r ON r.customer LIKE tt.customer AND r.employee='$this_employ' AND MONTH(r.date) = MONTH(tt.date) AND YEAR(r.date) = YEAR(tt.date)
                  LEFT JOIN  `leave` as `l` ON l.date like tt.date AND ((tt.time_from >= l.time_from AND tt.time_from < l.time_to) OR (tt.time_to > l.time_from AND tt.time_to <= l.time_to ) OR (tt.time_from <  l.time_from AND tt.time_to > l.time_to)) AND l.status!=2 AND l.employee = '$this_employ'
                  WHERE r.customer IS NULL AND l.employee IS NULL AND c.status = 1";
                  } else {
                  $this->sql_query = "SELECT concat(c.first_name, ' ', c.last_name) AS cust_name, tt.id, tt.employee,tt.date,tt.time_from,tt.time_to,tt.type,tt.status,tt.fkkn,(tt.time_to - tt.time_from) as total_hours FROM timetable tt
                  INNER JOIN team tm ON tt.customer LIKE tm.customer AND tt.status=0 AND cast(concat(tt.date, ' ', tt.time_from) as datetime) >= '$min_start_time' AND cast(concat(tt.date, ' ', tt.time_from) as datetime) <= '$max_start_time' AND cast(concat(tt.date, ' ', tt.time_to) as datetime) <= '" . ($existing_data[0]['date'] . ' ' . $existing_data[0]['time_from']) . "' AND tm.employee = '$this_employ'
                  INNER JOIN customer c ON tt.customer LIKE c.username
                  LEFT JOIN report_signing r ON r.customer LIKE tt.customer AND r.employee='$this_employ' AND MONTH(r.date) = MONTH(tt.date) AND YEAR(r.date) = YEAR(tt.date)
                  LEFT JOIN  `leave` as `l` ON l.date like tt.date AND ((tt.time_from >= l.time_from AND tt.time_from < l.time_to) OR (tt.time_to > l.time_from AND tt.time_to <= l.time_to ) OR (tt.time_from <  l.time_from AND tt.time_to > l.time_to)) AND l.status!=2 AND l.employee = '$this_employ'
                  WHERE r.customer IS NULL AND l.employee IS NULL AND c.status = 1";
                  } */
            }
        }

        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_leave_slots_between_dates($this_employee, $date_from, $date_to) {
        /**
         * Author: Niyaz
         * for: get employee leave timeslots from timetable using datefrom & dateto
         */
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'employee = ?', 'date >= ?', 'date <= ?', 'status = 2');
        $this->condition_values = array($this_employee, $date_from, $date_to);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function update_sms_records_accept1($slot_id, $employee, $conf, $slot_status = 0) {
        $obj_emp = new employee();

        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status');
        if ($slot_status == 2)
            $this->conditions = array('relation_id = ?');
        else
            $this->conditions = array('id = ?');

        $this->condition_values = array($slot_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $customers = '';
        $leave_times = '';
        $timetable_times = '';
        $date_month = '';
        $date_year = '';
        $count_i = 0;
        foreach ($datas as $data) {
            $time_from = $data['time_from'];
            $time_to = $data['time_to'];
            if ($count_i == 0) {
                $date_array = explode('-', $data['date']);
                $date_month = $date_array[1];
                $date_year = $date_array[0];
            } else {
                $customers .=",";
                $leave_times .= " OR ";
                $timetable_times .= " OR ";
            }
            $customers .= "'" . $data['customer'] . "'";
            $leave_times .= "(l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")";
            $timetable_times .= "(t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")";
            $count_i++;
        }

        //            $this->sql_query = "SELECT * from `timetable` as `t`
        //                LEFT JOIN `report_signing` as `r` ON r.employee like t.employee AND r.employee='$employee' MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.customer IN ('$customer') 
        //                LEFT JOIN  `leave` as `l` ON l.employee like t.employee AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
        //                INNER JOIN `team` as `tm` on t.employee LIKE tm.employee
        //                WHERE employee = '$employee' AND date='".$data['date']."' ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . "))";
        $this->tables = array('timetable');
        $this->fields = array('employee', 'status');
        $this->field_values = array($employee, 1);
        if ($slot_status == 2)
            $this->conditions = array('relation_id = ?');
        else
            $this->conditions = array('id = ?');

        $this->condition_values = array($slot_id);

        if ($this->query_update()) {
            $this->tables = array('leave_sms');
            $this->fields = array('status');
            $this->field_values = array(2);
            $this->conditions = array('AND', 'slot = ?', 'employee != ?');
            $this->condition_values = array($slot_id, $employee);
            if ($this->query_update()) {

                if ($conf == 1) {
                    $this->tables = array('leave_sms');
                    $this->fields = array('status');
                    $this->field_values = array(1);
                    $this->conditions = array('AND', 'slot = ?', 'employee = ?');
                    $this->condition_values = array($slot_id, $employee);
                } else if ($conf == 0) {
                    $this->tables = array('leave_sms');
                    $this->fields = array('status', 'receive_time');
                    $this->field_values = array(1, date('Y-m-d H:i:s', time()));
                    $this->conditions = array('AND', 'slot = ?', 'employee = ?');
                    $this->condition_values = array($slot_id, $employee);
                }
                if ($this->query_update()) {
                    return true;
                } else {
                    return false;
                }
            } else {

                return false;
            }
        } else {

            return false;
        }
    }


    function get_employees_exceed_candg($exceed_hour, $sort_name_by){
        $this->sql_query = "SELECT e.first_name,e.last_name,c.first_name as customer_first_name,c.last_name as customer_last_name, concat(u.dag, ' ', u.start_time) as start_time, CONCAT(TIMESTAMPDIFF(hour,TIMESTAMP(u.dag, u.start_time), NOW()), ' hours ', MOD( TIMESTAMPDIFF(minute,TIMESTAMP(u.dag, u.start_time),NOW()), 60), ' minutes ', MOD(TIMESTAMPDIFF(second,TIMESTAMP(u.dag, u.start_time),NOW()),60), ' seconds' ) as total_time FROM employee e INNER JOIN customer c INNER JOIN `user_task` u ON u.userid = e.username AND u.customer = c.username AND TIMESTAMPDIFF(HOUR, TIMESTAMP(u.`dag`,u.`start_time`), NOW()) >= ".$exceed_hour." AND u.status = 0";
        if($sort_name_by == 1){
            $this->sql_query .= " ORDER BY convert(cast(convert(`customer_first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`customer_last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(e.`first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(e.`last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci";
        }else{
            $this->sql_query .= " ORDER BY convert(cast(convert(`customer_last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`customer_first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(e.`last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(e.`first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci";
        }
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function cancell_candg_running($task_id){
        $this->tables = array('user_task');
        $this->conditions = array('id = ?');
        $this->condition_values = array($task_id);
        if (!$this->query_delete()) {
            return false;
        }else{
            return true;
        }
    }

    function get_employees_leave_count($from_date, $to_date, $gender = 0, $type = 0) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        // var_dump($from_date, $to_date,$boundary_date);
        // exit('s');
        $employee_count = 0;
        if($from_date <= $boundary_date && $to_date > $boundary_date){

            $this->sql_query = "SELECT COUNT(DISTINCT(l.employee)) AS employee_count FROM `leave` l 
            INNER JOIN employee e ON l.employee = e.username 
            WHERE l.status = 1 AND l.date BETWEEN '$from_date' AND '$to_date'";
            if($gender) {
                $this->sql_query .= " AND e.gender = $gender";
            }
            if($type) {
                if($type == 3) {
                    $this->sql_query .= " AND l.type NOT IN(1, 2)"; 
                } else {
                    $this->sql_query .= " AND l.type = $type"; 
                }
            }
            $real_table_data =  $this->sql_query;

            $this->sql_query = "SELECT COUNT(DISTINCT(l.employee)) AS employee_count FROM `backup_leave` l 
            INNER JOIN employee e ON l.employee = e.username 
            WHERE l.status = 1 AND l.date BETWEEN '$from_date' AND '$to_date'";
            if($gender) {
                $this->sql_query .= " AND e.gender = $gender";
            }
            if($type) {
                if($type == 3) {
                    $this->sql_query .= " AND l.type NOT IN(1, 2)"; 
                } else {
                    $this->sql_query .= " AND l.type = $type"; 
                }
            }
            $backup_table_data =  $this->sql_query;

           $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;

        }
        else if($from_date <= $boundary_date && $to_date <= $boundary_date){
            $table   = 'backup_leave';
            $proceed = true;  
        }
        else if($from_date > $boundary_date && $to_date > $boundary_date){
            $table   = 'leave';
            $proceed = true;
        }
        if($proceed == true){
            $this->sql_query = "SELECT COUNT(DISTINCT(l.employee)) AS employee_count FROM `".$table."` l 
            INNER JOIN employee e ON l.employee = e.username 
            WHERE l.status = 1 AND l.date BETWEEN '$from_date' AND '$to_date'";
            if($gender) {
                $this->sql_query .= " AND e.gender = $gender";
            }
            if($type) {
                if($type == 3) {
                    $this->sql_query .= " AND l.type NOT IN(1, 2)"; 
                } else {
                    $this->sql_query .= " AND l.type = $type"; 
                }
            }
        }
        $datas          = $this->query_fetch();
        $employee_count = $datas[0]['employee_count'];
        return $employee_count;
    }

    function get_employees_attendance_count($from_date, $to_date, $gender = 0) {
        $employee_count = 0;
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        if($from_date <= $boundary_date && $to_date > $boundary_date){
            $this->sql_query = "SELECT COUNT(DISTINCT(t.employee)) AS employee_count FROM `timetable` t 
                INNER JOIN employee e ON t.employee = e.username AND t.status = 1
                WHERE t.date BETWEEN '$from_date' AND '$to_date'";
            if($gender) {
                $this->sql_query .= " AND e.gender = $gender";
            }
            $real_table_data = $this->sql_query;


            $this->sql_query = "SELECT COUNT(DISTINCT(t.employee)) AS employee_count FROM `backup_timetable` t 
                INNER JOIN employee e ON t.employee = e.username AND t.status = 1
                WHERE t.date BETWEEN '$from_date' AND '$to_date'";
            if($gender) {
                $this->sql_query .= " AND e.gender = $gender";
            }
            $backup_table_data = $this->sql_query;

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ; 

        }
        else if($from_date <= $boundary_date && $to_date <= $boundary_date){
            $table   = 'backup_timetable';
            $proceed = true;  
        }
        else if($from_date > $boundary_date && $to_date > $boundary_date){
            $table   = 'timetable';
            $proceed = true;
        }
        if($proceed == true){
            $this->sql_query = "SELECT COUNT(DISTINCT(t.employee)) AS employee_count FROM `".$table."` t 
                INNER JOIN employee e ON t.employee = e.username AND t.status = 1
                WHERE t.date BETWEEN '$from_date' AND '$to_date'";
            if($gender) {
                $this->sql_query .= " AND e.gender = $gender";
            }
        }

            
        $datas = $this->query_fetch();
        $employee_count = $datas[0]['employee_count'];
        return $employee_count;
    }

    function get_employees_appointed_count($from_date, $to_date, $gender = 0) {
        $appointed_count = 0;
        $this->sql_query = "SELECT COUNT(username) AS appointed_count FROM employee WHERE `date` BETWEEN '$from_date' AND '$to_date'";
        if($gender) {
            $this->sql_query .= " AND gender = $gender";
        }
        $datas = $this->query_fetch();
        $appointed_count = $datas[0]['appointed_count'];
        return $appointed_count;
    }

    function get_employees_quit_count($from_date, $to_date, $gender = 0) {
        $quit_count = 0;
        $this->sql_query = "SELECT COUNT(username) AS quit_count FROM employee WHERE `date_inactive` BETWEEN '$from_date' AND '$to_date'";
        if($gender) {
            $this->sql_query .= " AND gender = $gender";
        }
        $datas = $this->query_fetch();
        $quit_count = $datas[0]['quit_count'];
        return $quit_count;
    }

    function get_monthly_employee_leave_comments($this_employee, $year, $month) {
        /**
         * Author: Shamsu
         * for: get employee leave comments in a year-month
         */
        $this->flush();
        $this->tables = array('leave');
        $this->fields = array('employee', 'date', 'comment');
        $this->conditions = array('AND', 'employee = ?', 'month(date) = ?', 'year(date) = ?', 'comment IS NOT NULL', 'comment != ?');
        $this->condition_values = array($this_employee, $month, $year, '');
        $this->group_by = array('group_id');
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        // echo '<pre>'.print_r($this->query_error_details, 1).'</pre>';
        return $datas;
    }

    function check_is_karense($date, $passed_employee){

        require_once('class/converter.php');
        $obj_converter = new Converter(array(), array(), date('Y', strtotime($date)));
        $obj_converter->employeeObj = new employee();

        $leave_date_count = 1;
        $work_status = TRUE;
        $prevDate = date('Y-m-01', strtotime($date));
        $prevDateKarens = $prevDate;
        $karens_percentage_deduction = $karens_percentage_deduction_org = 0;
        $first_leave_day = $date;

        $prev_sick_start_date = date('Y-m-d',  strtotime("-5 day", strtotime($first_leave_day))); 
        $prev_sick_end_date = $first_leave_day;
        $employee_leave_data = $obj_converter->get_all_leaves_for_report_between_dates($passed_employee, $prev_sick_start_date, $prev_sick_end_date);
        $employee_leave_dates = array_unique(array_column($employee_leave_data, 'date'));
        if(count($employee_leave_dates) == 5){
            $prevDate = $prevDateKarens = $prev_sick_start_date;
            $leave_date_count = 6;
            $work_status = FALSE;
        }else{
            $period = $obj_converter->dates_between($prev_sick_start_date, $prev_sick_end_date);
            $non_leave_days = array_diff($period, $employee_leave_dates);
            if(count($non_leave_days) > 0 && in_array($period[0], $employee_leave_dates)){
                //$leave_date_count = ceil(abs(strtotime($first_leave_day) - strtotime(end($non_leave_days))) / 86400);
                $leave_date_count =1;
                $prevDate = $prevDateKarens = $prev_sick_start_date;
            }elseif(in_array(end($period),$employee_leave_dates)){
                $work_status = FALSE;
            }elseif(!in_array(end($period),$employee_leave_dates)){
                $preLeaveDate = strtotime("-1 day", $period[0]);
                foreach($employee_leave_dates as $leave_date){
                    if((ceil(abs(strtotime($leave_date) - $preLeaveDate) / 86400)) > 1){
                        $leave_date_count += ceil(abs(strtotime($leave_date) - $preLeaveDate) / 86400);
                        $karens_percentage_deduction = $karens_percentage_deduction_org = $obj_converter->get_karens_percentage($leave_date, $passed_employee);
                        $karens_date_data = $obj_converter->get_sum_leave_approved_slots_between_dates($passed_employee, $leave_date, $leave_date);
                        $karens_percentage_deduction -= $karens_date_data['hrsmins'];
                        if($karens_percentage_deduction <= 0){
                            $work_status = FALSE;
                            $karens_percentage_deduction = $karens_percentage_deduction_org = $obj_converter->get_karens_percentage($first_leave_day, $passed_employee);
                            break;
                        }
                    }else{
                        $leave_date_count ++;
                    }
                    $preLeaveDate = strtotime($leave_date);
                }
            }
        }
    }

}



if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

?>