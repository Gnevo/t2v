<?php

/**
 * Description of timetable
 * @author shamsudheen <shamsu@arioninfotech.com>
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once('class/inconvenient_timing.php');
require_once('class/equipment.php');

class timetable extends db {

    //variable declaration
    var $employee = '';
    var $customer = '';
    var $work = '';
    var $date = '';
    var $time_from = '';
    var $time_to = '';
    var $type = '';
    var $status = '';
    var $comment = '';
    var $alloc_emp = '';
    var $alloc_comment = '';
    var $cust_comment = '';

    function __construct() {
        parent::__construct();
    }

    function employee_shedule_day($employee, $date, $customer = NULL) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'time_from', 'time_to', 'type', 'status', 'comment');
        if ($customer != NULL && $customer != "") {

            $this->conditions = array('AND', 'employee = ?', 'date = ?', 'customer = ?');
            $this->condition_values = array($employee, $date, $customer);
        } else {

            $this->conditions = array('AND', 'employee = ?', 'date = ?');
            $this->condition_values = array($employee, $date);
        }

        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function employee_shedule_week($employee, $week_no, $customer = NULL) {

        global $week;
        foreach ($week as $day) {
            print_r($day);
            $date = date("Y-m-d", strtotime('2012W121'));
        }

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'time_from', 'time_to', 'type', 'status', 'comment');
        if ($customer != NULL && $customer != "") {
            $this->conditions = array('AND', 'employee = ?', 'date = ?', 'customer = ?');
            $this->condition_values = array($employee, $date, $customer);
        } else {

            $this->conditions = array('AND', 'employee = ?', 'date = ?');
            $this->condition_values = array($employee, $date);
        }

        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_works($month, $year, $employee) {
        $inconv = new inconvenient_timing();
        $limits = $inconv->get_date_limits($month, $year);
        $dates = explode("/", $limits);
        $this->tables = array('timetable` as `t', 'work` as `w');
        $this->fields = array('t.employee', 't.customer', 't.date', 't.work', 't.time_from', 't.time_to',
            't.type', 't.status', 't.comment', 'w.id', 'w.name');
        $this->conditions = array('AND', 't.work = w.id', 't.employee = ? ', array('BETWEEN', 't.date', '?', '?'), 't.status = 1', 't.type = 0');
        $this->condition_values = array($employee, $dates[0], $dates[1]);
        $this->order_by = array('date');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /* --------------------------shamsu------------------------- */

    function distinct_years() {
        $this->tables = array('timetable');
        $this->fields = array('distinct(year(date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /* ------------- Niyaz survey begin ---------------------------- */

    function get_all_forms() {
        $this->tables = array('forms');
        $this->fields = array('id', 'title');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    /* ------------- Niyaz survey end ---------------------------- */

    function employee_customer_work_slots($employee, $customer, $date, $time_from, $time_to) {
        /**
         * Author: Shamsu
         * for: get employee-customer work slot between a time_range in a day
         */
        $this->flush();
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'time_from', 'time_to', 'status', 'type');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', array('IN', 'status', '0,1,2'), 'time_from >= ?', 'time_to <= ?');
        $this->condition_values = array($employee, $customer, $date, (float) $time_from, (float) $time_to);
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        return $slots;
    }

    function update_slot_date($id, $date) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-04-08
         * for: updating slot date
         */
        $this->tables = array('timetable');
        $this->fields = array('date');
        $this->field_values = array($date);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function customer_slots_btwn_dates($customer, $sdate, $edate, $allowed_statuses = array(), $fkkn = array()) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-04-08
         * for: get customer slots between two dates
         */
        require_once('class/employee.php');
        $obj_employee = new employee();
        $this->flush();
        $this->tables = array('timetable` as `t');
        $this->fields = array('t.id', 't.employee', 't.customer', 't.fkkn', 't.date', 't.time_from', 't.time_to',
            't.status', 't.relation_id','t.created_status', 't.type', 't.alloc_emp', 't.comment', 't.alloc_comment', 't.cust_comment',
            '(SELECT first_name FROM customer where username = t.customer) AS cust_first_name',
            '(SELECT last_name FROM customer where username = t.customer) AS cust_last_name',
            '(SELECT first_name FROM employee where username = t.employee) AS emp_first_name',
            '(SELECT last_name FROM employee where username = t.employee) AS emp_last_name',
            '(SELECT color FROM employee where username = t.employee) AS emp_color',
            'IF ((SELECT count(id) from report_signing where employee = t.employee and customer = t.customer and month(date) = month(t.date) and year(date) = year(t.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '0,1,2,4'));
        $this->condition_values = array($customer, $sdate, $edate);
        if (!empty($allowed_statuses)) {
            $this->conditions[] = array('IN', 'status', implode(',', $allowed_statuses));
//            $this->condition_values[] = ;
        }
        if (!empty($fkkn)) {
            $this->conditions[] = array('IN', 'fkkn', $fkkn);
//            $this->condition_values[] = ;
        }
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $slots = $this->query_fetch();

        /*
          SELECT * FROM `timetable` t  LEFT JOIN report_signing r ON (t.employee like r.employee and t.customer like r.customer  and month(r.date)= month(t.date) and year(r.date) = year(t.date) and r.employee IS NOT NULL and r.employee !='' )
          WHERE t.customer = 'inan002' and t.date between '2014-03-01' and '2014-03-31'
         */

        $tl_employees = array();

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $obj_employee->employees_list_for_right_click($customer);
            foreach ($temp_tl_employees as $temp_tl_employee) {
                $tl_employees[] = $temp_tl_employee['username'];
            }
        }

        if (!empty($slots)) {
            foreach ($slots as $key => $slot) {
//                $signin_flag = $obj_employee->chk_employee_rpt_signed($slot['employee'], $customer, $slot['date']);

                $tl_flag = 1;
                if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                    if (!in_array($slot['employee'], $tl_employees) && $slot['employee'] != '')
                        $tl_flag = 0;
                }elseif ($_SESSION['user_role'] == 3) {
                    if ($_SESSION['user_id'] != $slot['employee'])
                        $tl_flag = 0;
                }

                if ($_SESSION['company_sort_by'] == 1) {
                    $cust_name = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                    $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
                } elseif ($_SESSION['company_sort_by'] == 2) {
                    $cust_name = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                    $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
                }

                $tmp_array = array(
                    'slot' => $slot['time_from'] . '-' . $slot['time_to'],
                    'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100),
                    'cust_name' => $cust_name,
                    'emp_name' => $emp_name,
//                    'signed'    => $signin_flag, 
                    'tl_flag' => $tl_flag);

                $slots[$key] = array_merge($slots[$key], $tmp_array);
            }
        }
        return $slots;
    }
    
    function employee_slots_btwn_dates($employee, $sdate, $edate, $allowed_statuses = array()) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2015-04-02
         * for: get employee slots between two dates
         */
        require_once('class/employee.php');
        $obj_employee = new employee();
        $smarty = new smartySetup(array("messages.xml"),FALSE);

        $this->flush();
        $this->tables = array('timetable` as `t');
        $this->fields = array('t.id', 't.employee', 't.customer', 't.fkkn', 't.date', 't.time_from', 't.time_to',
            't.status', 't.created_status', 't.type', 't.alloc_emp', 't.comment', 't.alloc_comment', 't.cust_comment',
            '(SELECT first_name FROM customer where username = t.customer) AS cust_first_name',
            '(SELECT last_name FROM customer where username = t.customer) AS cust_last_name',
            '(SELECT first_name FROM employee where username = t.employee) AS emp_first_name',
            '(SELECT last_name FROM employee where username = t.employee) AS emp_last_name',
            '(SELECT color FROM employee where username = t.employee) AS emp_color',
            'IF ((SELECT count(id) from report_signing where employee = t.employee and customer = t.customer and month(date) = month(t.date) and year(date) = year(t.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '0,1,2,4'));
        $this->condition_values = array($employee, $sdate, $edate);
        if (!empty($allowed_statuses)) {
            $this->conditions[] = array('IN', 'status', implode(',', $allowed_statuses));
//            $this->condition_values[] = ;
        }
        //customer filteration - show only loggined customer slots if log as customer
        if(isset($_SESSION) && $_SESSION['user_role'] == 4){
            $this->conditions[] = 't.customer = ?';
            $this->condition_values[] = $_SESSION['user_id'];
        }
        
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        $slots = $this->query_fetch();

        $tl_employees = array();
        $tl_customers = array();

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $obj_employee->employees_list_for_right_click($employee);
            $temp_tl_customers = $obj_employee->customers_list_for_right_click($employee);
            foreach ($temp_tl_employees as $temp_tl_employee) {
                $tl_employees[] = $temp_tl_employee['username'];
            }
            foreach ($temp_tl_customers as $temp_tl_customer) {
                $tl_customers[] = $temp_tl_customer['username'];
            }
            
            $this->flush();
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($_SESSION['user_id']);
            $this->query_generate();

            $temp_datas = $this->query_fetch(2);

            $tl_all_customers = array();
            foreach ($temp_datas as $temp_data) {
                $tl_all_customers[] = $temp_data;
            }
        }

        if (!empty($slots)) {
            foreach ($slots as $key => $slot) {

                if ($_SESSION['company_sort_by'] == 1) {
                    $cust_name = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                    $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
                } elseif ($_SESSION['company_sort_by'] == 2) {
                    $cust_name = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                    $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
                }
                $show_details = 1;
                
                $tl_flag = 1;
                if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                    if ($slot['employee'] != '' && $slot['customer'] != '') {
                        if (!in_array($slot['employee'], $tl_employees) && !in_array($slot['customer'], $tl_customers))
                            $tl_flag = 0;
                        
                        if (!in_array($slot['customer'], $tl_all_customers)) {
                            $cust_name = $smarty->translate['works_on_another_customer'];
                            $tl_flag = 0;
                            $show_details = 0;
                        }
                    }
                }elseif ($_SESSION['user_role'] == 3 && $_SESSION['user_id'] != $slot['employee']) {
                    $tl_flag = 0;
                }elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                    $tl_flag = 0;
                    $cust_name = $smarty->translate['works_on_another_customer'];
                    $show_details = 0;
                }

                $tmp_array = array(
                    'slot' => $slot['time_from'] . '-' . $slot['time_to'],
                    'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100),
                    'cust_name' => $cust_name,
                    'emp_name' => $emp_name,
                    'show_details' => $show_details,
//                    'signed'    => $signin_flag, 
                    'tl_flag' => $tl_flag);

                $slots[$key] = array_merge($slots[$key], $tmp_array);
            }
        }
        return $slots;
    }

    function get_earned_sem_leave_days($employee, $sdate, $edate, $no_of_weeks = 52, $db_name = NULL ) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-04-22
         * for: get employee earned sem leave days
         */
        /*$this->flush();
        $this->tables = array('timetable');
        $this->fields = array('count(id) as count');
        $this->conditions = array('AND', 'employee = ?', array('IN', 'type', '0,3'), 'status = 1');
        $this->condition_values = array($employee);

        if ($sdate == NULL) {
            $this->conditions[] = 'date <= ?';
            $this->condition_values[] = $edate;
        } else {
            $this->conditions[] = array('BETWEEN', 'date', '?', '?');
            $this->condition_values[] = $sdate;
            $this->condition_values[] = $edate;
        }
//        $this->order_by = array('date','time_from', 'time_to');
        $this->query_generate();
        $slots = $this->query_fetch();
        $slots_count = $slots[0]['count'];
        $earned_days = ceil(($slots_count * 25) / (5 * $no_of_weeks));
        return $earned_days;*/
        
        require_once('class/company.php');
        $equipment = new equipment();
        $obj_company = new company();
        
        $db_name != NULL ? $db_company_name = $db_name : $db_company_name = $_SESSION['company_id'];

        $company_details = $obj_company->get_company_detail($db_company_name);

        $company_vacation_percentage_slots = trim($company_details['vacation_percentage_slots']) != '' ? explode('|', $company_details['vacation_percentage_slots']) : array();
//        echo "<pre>".print_r($company_vacation_percentage_slots, 1)."</pre>"; exit();
        $include_sick_in_sem_calc = 1;
        $include_sick_in_sem_calc = $company_details['include_sick'];
        
        if(empty($company_vacation_percentage_slots)) return 0;
        
        //calculate active work slot hours
        $this->flush();
        $this->tables = array('timetable');
        $this->fields = array('time_from', 'time_to', 'type');
        $this->conditions = array('AND', 'employee = ?', 'status = 1', array('IN', 'type', $company_vacation_percentage_slots));
        $this->condition_values = array($employee);

        if ($sdate == NULL) {
            $this->conditions[] = 'date <= ?';
            $this->condition_values[] = $edate;
        } else {
            $this->conditions[] = array('BETWEEN', 'date', '?', '?');
            $this->condition_values[] = $sdate;
            $this->condition_values[] = $edate;
        }
        $this->query_generate();
        $work_slots = $this->query_fetch();
        
        $__this_tot_normal = $__this_tot_oncall = 0;
        if(!empty($work_slots)){
            foreach ($work_slots as $works) {
                $time_in_100 = $equipment->time_user_format($equipment->time_difference($works['time_to'], $works['time_from']), 100);
                if (in_array($works['type'], array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12, 15)))
                    $__this_tot_normal += $time_in_100;
                else if (in_array($works['type'], array(3, 9, 13, 14)))
                    $__this_tot_oncall += $time_in_100;
            }
        }
        $earned_days = 0;
        if($include_sick_in_sem_calc == 1){
            //calculate leave work slot hours
            $this->flush();
            $this->tables = array('timetable` as `t', 'leave` as `l');
            $this->fields = array('t.time_from as time_from', 't.time_to as time_to', 't.type as type');
            $this->conditions = array('AND', 't.employee = ?', 't.status = 2', 'l.status = 1', 'l.type = 1', array('IN', 't.type', $company_vacation_percentage_slots),
                't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
            $this->condition_values = array($employee);

            if ($sdate == NULL) {
                $this->conditions[] = 't.date <= ?';
                $this->condition_values[] = $edate;
            } else {
                $this->conditions[] = array('BETWEEN', 't.date', '?', '?');
                $this->condition_values[] = $sdate;
                $this->condition_values[] = $edate;
            }
            $this->query_generate();
            $leave_slots = $this->query_fetch();

            $__this_tot_normal_leave = $__this_tot_oncall_leave = 0;
            if(!empty($leave_slots)){
                foreach ($leave_slots as $leaves) {
                    $time_in_100 = $equipment->time_user_format($equipment->time_difference($leaves['time_to'], $leaves['time_from']), 100);
                    if (in_array($leaves['type'], array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12, 15)))
                        $__this_tot_normal_leave += $time_in_100;
                    else if (in_array($leaves['type'], array(3, 9, 13, 14)))
                        $__this_tot_oncall_leave += $time_in_100;
                }
            }

            $earned_days = round($__this_tot_normal + $__this_tot_normal_leave + ($__this_tot_oncall/4) + ($__this_tot_oncall_leave/4), 2);
        }else{
            $earned_days = round($__this_tot_normal  + ($__this_tot_oncall/4) , 2);
        }
        $company_vacation_percentage = $company_details ? $company_details['vacation_percentage'] : 0;
        $earned_days = round(($earned_days * $company_vacation_percentage / 100), 2);
        return $earned_days;
        
    }

    function get_taken_sem_leave_days($employee, $sdate, $edate, $db_name = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-04-22
         * for: get no.of days sem leave takens
         */
        /*$this->flush();
        $this->tables = array('leave');
        $this->fields = array('count(DISTINCT date) as count');
        $this->conditions = array('AND', 'employee = ?', 'type = 2', 'status = 1');
        $this->condition_values = array($employee);

        if ($sdate == NULL) {
            $this->conditions[] = 'date <= ?';
            $this->condition_values[] = $edate;
        } else {
            $this->conditions[] = array('BETWEEN', 'date', '?', '?');
            $this->condition_values[] = $sdate;
            $this->condition_values[] = $edate;
        }

        $this->query_generate();
        $leaves_count = $this->query_fetch();
        return $leaves_count[0]['count'];*/
        
        //-----------------------------------------------------------------------
        if($db_name != NULL){
            $this->select_db($db_name);
        }

        $equipment = new equipment();
        
        $this->flush();
        $this->tables = array('timetable` as `t', 'leave` as `l');
        $this->fields = array('t.time_from as time_from', 't.time_to as time_to', 't.type as type');
        $this->conditions = array('AND', 't.employee = ?', 't.status = 2', 'l.status = 1', 'l.type = 2', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($employee);
        if ($sdate == NULL) {
            $this->conditions[] = 't.date <= ?';
            $this->condition_values[] = $edate;
        } else {
            $this->conditions[] = array('BETWEEN', 't.date', '?', '?');
            $this->condition_values[] = $sdate;
            $this->condition_values[] = $edate;
        }
        $this->query_generate();
        $sem_leave_slots = $this->query_fetch();
        
        $__this_tot_normal_leave = $__this_tot_oncall_leave = 0;
        if(!empty($sem_leave_slots)){
            foreach ($sem_leave_slots as $leaves) {
                $time_in_100 = $equipment->time_user_format($equipment->time_difference($leaves['time_to'], $leaves['time_from']), 100);
                if (in_array($leaves['type'], array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12, 15)))
                    $__this_tot_normal_leave += $time_in_100;
                else if (in_array($leaves['type'], array(3, 9, 13, 14)))
                    $__this_tot_oncall_leave += $time_in_100;
            }
        }
        
        $total_hours = round($__this_tot_normal_leave + ($__this_tot_oncall_leave/4), 2);
        return $total_hours;
    }

    function get_overlapped_slots_of_customer($customer, $date, $filter_insurance = NULL) {
        $obj_equipment = new equipment();
        $this->tables = array('timetable` AS `t', 'employee` AS `e');
        $this->fields = array('t.employee', 't.customer', 't.date', 't.time_from', 't.time_to', 'e.first_name', 'e.last_name', 'e.color');
        $this->conditions = array('AND', 't.date = ?', 't.status = 1', 't.customer = ?', 'e.username LIKE t.employee');
        $this->condition_values = array($date, $customer);

        if($filter_insurance !== NULL){
            $insurance_string = implode(',', $filter_insurance);
            $this->conditions[] = 't.fkkn IN ( '.$insurance_string.' )';
        }

        $this->query_generate();
        // echo $this->sql_query."<br>";
        $data = $this->query_fetch();
        $total_time_collide = 0;
        $stored_collide = array();
        if ($data) {
//            echo "<pre>$i".print_r($data,1)."</pre>";
//            echo "=====================================================================================<br>";
            $result = array();
            for ($i = 0; $i < count($data); $i++) {
                $flag = 0;
                $temp_array = array();
                for ($j = $i + 1; $j < count($data); $j++) {
                     
                    if (($data[$i]['time_from'] >= $data[$j]['time_from'] && $data[$i]['time_from'] < $data[$j]['time_to']) || ($data[$i]['time_to'] > $data[$j]['time_from'] && $data[$i]['time_to'] <= $data[$j]['time_to']) || ($data[$i]['time_from'] < $data[$j]['time_from'] && $data[$i]['time_to'] > $data[$j]['time_to'])) {
                        if ($flag == 0) {
                            if ($this->check_for_identical_slots($result, array('employee' => $data[$i]['employee'], 'time_from' => $data[$i]['time_from'], 'time_to' => $data[$i]['time_to']))) {
                                $time_diff = $obj_equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']);
                                $time_diff = $obj_equipment->time_user_format($time_diff, 100);
                                $time_from = $obj_equipment->time_user_format($data[$i]['time_from'], 100);
                                $data[$i]['width'] = $time_diff * 4;
                                $data[$i]['margin_left'] = $time_from * 4+3;
                                $data[$i]['width_popup'] = $time_diff * 32;
                                $data[$i]['margin_left_popup'] = $time_from * 32;
                                $data[$i]['time_diff'] = $time_diff;
                                $result[] = $data[$i];
                                $flag = 1;
                            }
                        }
                        if ($this->check_for_identical_slots($result, array('employee' => $data[$j]['employee'], 'time_from' => $data[$j]['time_from'], 'time_to' => $data[$j]['time_to']))) {
                            $time_diff = $obj_equipment->time_difference($data[$j]['time_to'], $data[$j]['time_from']);
                            $time_diff = $obj_equipment->time_user_format($time_diff, 100);
                            $time_from = $obj_equipment->time_user_format($data[$j]['time_from'], 100);
                            $data[$j]['width'] = $time_diff * 4;
                            $data[$j]['margin_left'] = $time_from * 4+3;
                            $data[$j]['width_popup'] = $time_diff * 32;
                            $data[$j]['margin_left_popup'] = $time_from * 32;
                            $data[$j]['time_diff'] = $time_diff;
                            $result[] = $data[$j];
                        }
                        
                        ////finding total colliding time
                        $time_from = $data[$i]['time_from'];
                        $time_to = $data[$i]['time_to'];
                        if($time_from < $data[$j]['time_from'])
                            $time_from = $data[$j]['time_from'];
                        if($time_to > $data[$j]['time_to'])
                            $time_to = $data[$j]['time_to'];
                        //echo $i."-------".$time_from."--------".$time_to."<br>";
//                        if($date = '2014-10-13')
//                            echo "<pre>$i$i$i$i$i$i".print_r($stored_collide,1)."</pre>";
                        $slots = $this->split_from_existing_slots($stored_collide, $time_from, $time_to);
//                        if($date = '2014-10-13')
//                            echo "<pre>$i$i$i$i$i$i".print_r($slots,1)."</pre>";
                        foreach($slots as $slot){
                            $time_collide = $obj_equipment->time_user_format($obj_equipment->time_difference($slot['time_to'], $slot['time_from']), 100);
                            
                            $total_time_collide += $time_collide;
                            //echo "<br>";
                            if($this->check_for_identical_slots($temp_array,array('time_from'=>$slot['time_from'], 'time_to'=>$slot['time_to'])) /*&& $this->check_for_identical_slots($stored_collide,array('time_from'=>$time_from, 'time_to'=>$time_to))*/){

                                $temp_array[] = array('time_from'=>$slot['time_from'], 'time_to'=>$slot['time_to']);
                                
                            }
                        }
                    }
                    
                    
                }
                $stored_collide = array_merge($stored_collide,$temp_array);
//                    if($date = '2014-10-13')
//                          echo "<pre>xxxxx".print_r($stored_collide,1)."</pre>";
            }
            //echo $total_time_collide."<br>";
            //if($date = '2014-10-13')
            //echo "<pre>xxxxx".print_r($result,1)."</pre>";
            return array('result'=>$result,'time_collide'=>$total_time_collide);
        } else {
            return array();
        }
    }

    function check_for_identical_slots($check_array, $content_array) {
         
        $flag = 1;
        $flag_ind = 1;
        foreach ($check_array as $check_array_value) {
            foreach ($content_array as $key => $values) {
                if ($check_array_value[$key] != $values) {
                    $flag_ind = 1;
                    break;
                }else{
                    $flag_ind = 0;
                }
            }
            if($flag_ind == 0)
                return 0;
            else 
                $flag = 1;
        }
        
        return $flag;
    }
    
    function split_from_existing_slots($existing_slots , $time_from, $time_to){
        $temp_array[] = array('time_from'=>$time_from,'time_to'=>$time_to);
        foreach($existing_slots as $data){
            foreach ($temp_array as $key=>$value)
            
            if($value['time_from'] < $data['time_from'] && $value['time_to'] > $data['time_from'] && $value['time_to'] <= $data['time_to']){
                $temp_array[$key]['time_from']=$time_from;
                $temp_array[$key]['time_to']=$data['time_from'];
            }
            elseif($time_from >= $data['time_from'] && $time_from < $data['time_to'] && $time_to > $data['time_to']){
                $temp_array[$key]['time_from']=$data['time_to'];
                $temp_array[$key]['time_to']=$time_from;
            }
            elseif($time_from < $data['time_from'] && $time_to > $data['time_to']){
                $temp_array[$key]['time_from']=$time_from;
                $temp_array[$key]['time_to']=$data['time_from'];
                $temp_array[] = array('time_from'=>$data['time_to'],'time_to'=>$time_from);
            }
            else if($time_from >= $data['time_from'] && $time_to <= $data['time_to'])
                
                $temp_array = array();
        }
        
        return $temp_array;
    }
    
    function get_overlapping_customers($year, $month){
        if($_SESSION['user_role'] ==1 || $_SESSION['user_role'] == 6){
            $this->sql_query = "SELECT distinct(t1.customer)AS customers,first_name,last_name FROM timetable t1 INNER JOIN timetable t2 ON t1.customer LIKE t2.customer and t1.date = t2.date  
                            INNER JOIN customer AS cust ON t1.customer LIKE cust.username
                            WHERE t1.status=1 AND t2.status = 1 AND MONTH(t1.date)=$month AND MONTH(t2.date) = $month AND YEAR(t1.date) = $year AND YEAR(t2.date) = $year AND t1.id != t2.id
                            AND((t1.time_from >= t2.time_from AND t1.time_from < t2.time_to) OR (t1.time_to > t2.time_from AND t1.time_to <= t2.time_to) OR (t1.time_from < t2.time_from AND t1.time_to >t2.time_to))";
        }else{
        $this->sql_query = "SELECT distinct(t1.customer)AS customers,first_name,last_name FROM timetable t1 INNER JOIN timetable t2 ON t1.customer LIKE t2.customer and t1.date = t2.date  
                            INNER JOIN customer AS cust ON t1.customer LIKE cust.username
                            INNER JOIN `team` AS `tm` ON tm.customer like cust.username AND tm.employee='" . $_SESSION['user_id'] . "' 
                            WHERE t1.status=1 AND t2.status = 1 AND MONTH(t1.date)=$month AND MONTH(t2.date) = $month AND YEAR(t1.date) = $year AND YEAR(t2.date) = $year AND t1.id != t2.id
                             AND((t1.time_from >= t2.time_from AND t1.time_from < t2.time_to) OR (t1.time_to > t2.time_from AND t1.time_to <= t2.time_to) OR (t1.time_from < t2.time_from AND t1.time_to >t2.time_to))";
        }
        $data = $this->query_fetch();
        return $data;
    }
    
    function get_signed_slots_after_date($date, $customer = NULL, $employee = NULL, $limit = 0) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2015-08-03
         * for: get customer/employee signed slots after a specific date
         * used in employee_add module => while inactivating an employee
         */
        
        if(($customer == NULL && $employee == NULL) || $date == '') return array();
        $this->flush();
        $this->tables = array('timetable` as `t');
        $this->fields = array('t.id', 't.employee', 't.customer', 't.date', 't.time_from', 't.time_to', 't.status', 't.type', 
            'IF ((SELECT count(id) from report_signing where employee = t.employee and customer = t.customer and month(date) = month(t.date) and year(date) = year(t.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        $this->conditions = array('AND', 'date >= ?', 
                '(SELECT count(id) from report_signing where employee = t.employee and customer = t.customer and month(date) = month(t.date) and year(date) = year(t.date) and signin_employee IS NOT NULL and signin_employee != "") > 0'
            );
        $this->condition_values = array($date);
        if($customer != NULL){
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        }
        if($employee != NULL){
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $employee;
        }
        if($limit != 0)
            $this->limit = $limit;
//        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $slots = $this->query_fetch();
        return $slots;
    }
    
    function delete_slots_after_date($date, $customer = NULL, $employee = NULL, $delete_leave_entries = FALSE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2015-08-03
         * for: delete customer/employee slots after a specific date
         * used in employee_add module => while inactivating an employee
         */
        
        if(($customer == NULL && $employee == NULL) || $date == '') return TRUE;
        $this->flush();
        $this->tables = array('timetable');
        $this->conditions = array('AND', 'date >= ?');
        $this->condition_values = array($date);
        if($customer != NULL){
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        }
        if($employee != NULL){
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $employee;
        }
        $process_flag = $this->query_delete();
        if($delete_leave_entries && $process_flag){
            $process_flag = $this->delete_leave_entries_after_date($date, $employee);
        }
        return $process_flag;
    }
    
    function delete_leave_entries_after_date($date, $employee) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2015-08-03
         * for: delete employee leave entries after a specific date
         * used in employee_add module => while inactivating an employee
         */
        
        if($employee == NULL || $date == '') return TRUE;
        $this->flush();
        $this->tables = array('leave');
        $this->conditions = array('AND', 'date >= ?', 'employee = ?');
        $this->condition_values = array($date, $employee);
        return $this->query_delete();
    }
    
    function delete_slots_and_leaves_after_date($date, $customer) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2015-08-03
         * for: delete customer/employee slots after a specific date
         * used in employee_add module => while inactivating an employee
         */
        
        if($customer == NULL || $date == '') return TRUE;
        
        //get all leave entry slots
        $this->flush();
        $this->tables = array('timetable` as `t');
        $this->fields = array('t.id', 't.employee', 't.customer', 't.date', 't.time_from', 't.time_to', 't.status', 't.type');
        $this->conditions = array('AND', 'date >= ?', 'customer = ?', 'status = 2');
        $this->condition_values = array($date, $customer);
        $this->query_generate();
        $leave_slots = $this->query_fetch();
        
        //removing all leave table entries of these leave slots
        if(!empty($leave_slots)){
            require_once('class/employee.php');
            $obj_employee = new employee();
            
            foreach($leave_slots as $leave_slot){
                $this->flush();
                $this->tables = array('leave');
                $this->fields = array('id', 'group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'apply_date', 'appr_emp', 'appr_date', 'appr_comment', 'status');
                $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from <= ?', 'time_to >= ?');
                $this->condition_values = array($leave_slot['employee'], $leave_slot['date'], (float) $leave_slot['time_from'], (float) $leave_slot['time_to']);
                $this->query_generate();
                $leave_details_temp = $this->query_fetch();
                if (!empty($leave_details_temp)) {
                    $leave_details_temp = $leave_details_temp[0];
                    $obj_employee->skip_a_time_slot_from_leave_slot($leave_details_temp['id'], $leave_slot['time_from'], $leave_slot['time_to']);
                }
            }
        }
        
        $this->flush();
        $this->tables = array('timetable');
        $this->conditions = array('AND', 'date >= ?', 'customer = ?');
        $this->condition_values = array($date, $customer);
        return $this->query_delete();
    }
    
    function get_saved_sem_leave_credentials($company_details, $employee_details, $passed_month, $passed_year) {

//    echo "<pre>".print_r($company_details,1)."</pre>";
//    echo "<pre>".print_r($employee_details,1)."</pre>";

        if ($company_details['sem_year_start_month'] != '') {
            $last_week = date("W", mktime(0, 0, 0, 12, 31, $passed_year));
            $no_of_weeks_in_a_year = 52;
            if ($last_week == 53) {
                $no_of_weeks_in_a_year = 53;
            }

            $passed_employee = $employee_details['username'];
            $show_sem_leave = TRUE;
            $sem_year_start_month = intval(trim($company_details['sem_year_start_month']));

            $leave_in_advance = FALSE;
            if ($company_details['leave_in_advance'] == 1)
                $leave_in_advance = TRUE;
            else if ($employee_details['leave_in_advance'] == 1)
                $leave_in_advance = TRUE;
            if ($leave_in_advance) {
                //Earned days for this Financial year
                $sem_start_date = ($passed_month >= $sem_year_start_month) ? date('Y-m-01', strtotime("$passed_year-$sem_year_start_month-01")) : date('Y-m-01', strtotime(($passed_year - 1) . "-$sem_year_start_month-01"));
                $sem_end_date = date('Y-m-t', strtotime("$passed_year-$passed_month-01"));
                //echo $passed_employee.$sem_start_date.$sem_end_date.$no_of_weeks_in_a_year."<br>";
                $this_fyear_earned_days = $this->get_earned_sem_leave_days($passed_employee, $sem_start_date, $sem_end_date, $no_of_weeks_in_a_year);

                //Taken no.of sem leave days for this Financial year
                $this_fyear_takens_sem_leave_days = $this->get_taken_sem_leave_days($passed_employee, $sem_start_date, $sem_end_date);

                //find Former years remaining earned days
                $remaining_no_of_sem_leaves = trim($employee_details['remaining_sem_leave']) != '' ? $employee_details['remaining_sem_leave'] : 0;
                $remaining_sem_leaves_upto_date = (trim($employee_details['sem_leave_todate']) != '' && trim($employee_details['sem_leave_todate']) != NULL && trim($employee_details['sem_leave_todate']) != '0000-00-00') ? $employee_details['sem_leave_todate'] : NULL;

                $former_year_sem_start_date = NULL;
                if ($remaining_sem_leaves_upto_date != NULL)
                    $former_year_sem_start_date = date('Y-m-d', strtotime('+1 day', strtotime($remaining_sem_leaves_upto_date)));
                else if ($employee_details['date'] != '')
                    $former_year_sem_start_date = $employee_details['date'];    //activated date

                $former_year_earned_days = 0;
                $former_year_takens_sem_leave_days = 0;

                if ($former_year_sem_start_date == NULL || ($former_year_sem_start_date != NULL && $former_year_sem_start_date <= date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date))))) {
                    $former_year_sem_end_date = date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date)));
                    //echo $passed_employee."-".$former_year_sem_start_date."-".$former_year_sem_end_date;
                    $former_year_earned_days = $this->get_earned_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date, $no_of_weeks_in_a_year);

                    //Taken no.of sem leave days from Former years
                    $former_year_takens_sem_leave_days = $this->get_taken_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date);
                }


                $former_year_remaining_days = $remaining_no_of_sem_leaves + max($former_year_earned_days - $former_year_takens_sem_leave_days, 0);

                //Minus this year takens leaves from former year remainings and this year earned leaves as per conditions
                if ($this_fyear_takens_sem_leave_days > 0) {
                    $bal_this_fyear_takens_sem_leave_days = $this_fyear_takens_sem_leave_days;
                    if ($former_year_remaining_days > 0) {
                        if ($former_year_remaining_days >= $bal_this_fyear_takens_sem_leave_days) {
                            $former_year_remaining_days -= $bal_this_fyear_takens_sem_leave_days;
                            $bal_this_fyear_takens_sem_leave_days = 0;
                        } else {
                            $former_year_remaining_days = 0;
                            $bal_this_fyear_takens_sem_leave_days -= $former_year_remaining_days;
                        }
                    }

                    if ($bal_this_fyear_takens_sem_leave_days > 0 && $this_fyear_earned_days > 0) {
                        if ($this_fyear_earned_days >= $bal_this_fyear_takens_sem_leave_days) {
                            $this_fyear_earned_days -= $bal_this_fyear_takens_sem_leave_days;
                            //                    $bal_this_fyear_takens_sem_leave_days = 0;
                        } else {
                            $this_fyear_earned_days = 0;
                            //                    $bal_this_fyear_takens_sem_leave_days -= $this_fyear_earned_days;
                        }
                    }
                }
                //echo $this_fyear_takens_sem_leave_days;
                $sem_leave_details_array = array(
                    'this_fyear_earned_days' => $this_fyear_earned_days,
                    'this_fyear_takens_sem_leave_days' => $this_fyear_takens_sem_leave_days,
                    'former_year_remaining_days' => $former_year_remaining_days
                );
            } else {
                //Earned days for this Financial year
                $sem_start_date_nA = ($passed_month >= $sem_year_start_month) ? date('Y-m-01', strtotime(($passed_year - 1) . "-$sem_year_start_month-01")) : date('Y-m-01', strtotime(($passed_year - 2) . "-$sem_year_start_month-01"));
                $sem_end_date_nA = date('Y-m-t', strtotime(($passed_year - 1) . "-$passed_month-01"));
                // $passed_employee . "-" . $sem_start_date . "-" . $sem_end_date;
                $this_fyear_earned_days = $this->get_earned_sem_leave_days($passed_employee, $sem_start_date_nA, $sem_end_date_nA, $no_of_weeks_in_a_year);

                //Taken no.of sem leave days for this Financial year
                $sem_start_date = ($passed_month >= $sem_year_start_month) ? date('Y-m-01', strtotime("$passed_year-$sem_year_start_month-01")) : date('Y-m-01', strtotime(($passed_year - 1) . "-$sem_year_start_month-01"));
                $sem_end_date = date('Y-m-t', strtotime("$passed_year-$passed_month-01"));

                $this_fyear_takens_sem_leave_days = $this->get_taken_sem_leave_days($passed_employee, $sem_start_date, $sem_end_date);

                //find Former years remaining earned days
                $remaining_no_of_sem_leaves = trim($employee_details['remaining_sem_leave']) != '' ? $employee_details['remaining_sem_leave'] : 0;
                $remaining_sem_leaves_upto_date = trim($employee_details['sem_leave_todate']) != '' ? $employee_details['sem_leave_todate'] : NULL;
                $former_year_sem_start_date = NULL;
                if ($remaining_sem_leaves_upto_date != NULL)
                    $former_year_sem_start_date = date('Y-m-d', strtotime('+1 day', strtotime($remaining_sem_leaves_upto_date)));
                else if ($employee_details['date'] != '')
                    $former_year_sem_start_date = $employee_details['date'];    //activated date

                $former_year_earned_days = 0;
                $former_year_takens_sem_leave_days = 0;
                if ($former_year_sem_start_date == NULL || ($former_year_sem_start_date != NULL && $former_year_sem_start_date <= date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date_nA))))) {
                    $former_year_sem_end_date = date('Y-m-d', strtotime('-1 day', strtotime($sem_start_date_nA)));
                    $former_year_earned_days = $this->get_earned_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date, $no_of_weeks_in_a_year);

                    //Taken no.of sem leave days from Former years
                    $former_year_takens_sem_leave_days = $this->get_taken_sem_leave_days($passed_employee, $former_year_sem_start_date, $former_year_sem_end_date);
                }

                $former_year_remaining_days = $remaining_no_of_sem_leaves + max($former_year_earned_days - $former_year_takens_sem_leave_days, 0);

                //Minus this year takens leaves from former year remainings and this year earned leaves as per conditions
                if ($this_fyear_takens_sem_leave_days > 0) {
                    $bal_this_fyear_takens_sem_leave_days = $this_fyear_takens_sem_leave_days;
                    if ($former_year_remaining_days > 0) {
                        if ($former_year_remaining_days >= $bal_this_fyear_takens_sem_leave_days) {
                            $former_year_remaining_days -= $bal_this_fyear_takens_sem_leave_days;
                            $bal_this_fyear_takens_sem_leave_days = 0;
                        } else {
                            $former_year_remaining_days = 0;
                            $bal_this_fyear_takens_sem_leave_days -= $former_year_remaining_days;
                        }
                    }

                    if ($bal_this_fyear_takens_sem_leave_days > 0 && $this_fyear_earned_days > 0) {
                        if ($this_fyear_earned_days >= $bal_this_fyear_takens_sem_leave_days) {
                            $this_fyear_earned_days -= $bal_this_fyear_takens_sem_leave_days;
                            //                    $bal_this_fyear_takens_sem_leave_days = 0;
                        } else {
                            $this_fyear_earned_days = 0;
                            //                    $bal_this_fyear_takens_sem_leave_days -= $this_fyear_earned_days;
                        }
                    }
                }

                $sem_leave_details_array = array(
                    'this_fyear_earned_days' => $this_fyear_earned_days,
                    'this_fyear_takens_sem_leave_days' => $this_fyear_takens_sem_leave_days,
                    'former_year_remaining_days' => $former_year_remaining_days
                );
            }
            return $sem_leave_details_array;
        }
    }
    
    function get_customer_running_tasks($customer){
        if($customer == NULL) return array();
        $this->flush();
        $this->tables = array('user_task` as `t', 'employee` as `e');
        $this->fields = array('t.id', 't.userid', 't.slotids', 't.dag', 't.start_time', 't.end_time', 't.dur', 't.customer', 't.status',
            'e.first_name as employee_first_name', 'e.last_name as employee_last_name');
        $this->conditions = array('AND', 't.customer = ?', 't.status = 0', 't.userid = e.username');
        $this->condition_values = array($customer);
        $this->order_by = array('t.dag', 't.start_time');
        $this->query_generate();
        $tasks = $this->query_fetch();
        return $tasks;
    }
    
    function get_employee_running_tasks($employee){
        if($employee == NULL) return array();
        $this->flush();
        $this->tables = array('user_task` as `t', 'customer` as `c');
        $this->fields = array('t.id', 't.userid', 't.slotids', 't.dag', 't.start_time', 't.end_time', 't.dur', 't.customer', 't.status',
            'c.first_name as customer_first_name', 'c.last_name as customer_last_name');
        $this->conditions = array('AND', 't.userid = ?', 't.status = 0', 't.customer = c.username');
        $this->condition_values = array($employee);
        $this->order_by = array('t.dag', 't.start_time');
        $this->query_generate();
        $tasks = $this->query_fetch();
        return $tasks;
    }

    function get_available_users_btwn_dates($date_from, $date_to, $time_from = NULL, $time_to = NULL, $customer = NULL, $possible_employees = array()) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        $time_from  = $time_from != '' ? trim($time_from) : NULL;
        $time_to    = $time_from != '' && $time_to != '' ? trim($time_to) : NULL;

        if($time_from == NULL && $time_to == NULL){
            $time_from  = 0.00;
            $time_to    = 24.00;
        }

        if ($_SESSION['company_sort_by'] == 1)
            $order_by = ' ORDER BY LOWER(e.first_name) collate utf8_bin ASC,LOWER(e.last_name) collate utf8_bin ASC';
        else
            $order_by = ' ORDER BY LOWER(e.last_name) collate utf8_bin ASC,LOWER(e.first_name) collate utf8_bin ASC';
        
        $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile, e.substitute 
                            FROM `employee` as `e` ";

        if($customer != ''){
            /*$cur_date = strtotime($date . ' 00:00:00');
            $date_array = explode('-', $date);
            $date_month = $date_array[1];
            $date_year = $date_array[0];*/
            $first_day_from_date = date('Y-m-01', strtotime($date_from));
            //MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year
            if($date_from <= $boundary_date && $date_to > $boundary_date){
                $real_table_data = " INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer'
                                     LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND r.date BETWEEN '$first_day_from_date' AND '$date_to' AND r.customer ='$customer'";

                $backup_table_data = " INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer'
                                     LEFT JOIN `backup_report_signing` as `r` ON r.employee like e.username AND r.date BETWEEN '$first_day_from_date' AND '$date_to' AND r.customer ='$customer'";

                 $union_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
                 $this->sql_query .= $union_query;

            }
            else if($date_from <= $boundary_date && $date_to <= $boundary_date){
                $table = 'backup_report_signing';
                $proceed = TRUE;
            }
            else if($date_from > $boundary_date && $date_to > $boundary_date){
                $table = 'report_signing';
                $proceed = TRUE;
            }
            if($proceed == TRUE){
                $this->sql_query .= " INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer'
                                     LEFT JOIN `".$table."` as `r` ON r.employee like e.username AND r.date BETWEEN '$first_day_from_date' AND '$date_to' AND r.customer ='$customer'";
            }
        }
        if($date_from <= $boundary_date && $date_to > $boundary_date){
            $real_table_data = " LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date BETWEEN '$date_from' AND '$date_to' AND l.status!=2
                                LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date BETWEEN '$date_from' AND '$date_to' AND t.employee!='' AND t.status!=2 
                                WHERE t.employee IS NULL ".($customer != '' ? ' AND r.employee IS NULL ' : '')." AND l.employee IS NULL 
                                AND e.username IN ('".  implode('\',\'', $possible_employees) . "') 
                                ".($_SESSION['user_role'] == 3 ? " AND e.username = '".$_SESSION['user_id']."'" : '');


            $backup_table_data = " LEFT JOIN  `backup_leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date BETWEEN '$date_from' AND '$date_to' AND l.status!=2
                                LEFT JOIN  `backup_timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date BETWEEN '$date_from' AND '$date_to' AND t.employee!='' AND t.status!=2 
                                WHERE t.employee IS NULL ".($customer != '' ? ' AND r.employee IS NULL ' : '')." AND l.employee IS NULL 
                                AND e.username IN ('".  implode('\',\'', $possible_employees) . "') 
                                ".($_SESSION['user_role'] == 3 ? " AND e.username = '".$_SESSION['user_id']."'" : '');
            $union_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
            $this->sql_query .= $union_query;

        }
        else if($date_from <= $boundary_date && $date_to <= $boundary_date){
            $table_leave     = 'backup_leave';
            $table_timetable = 'backup_timetable';
            $proceed         = TRUE;
        }
        else if($date_from > $boundary_date && $date_to > $boundary_date){
            $table_leave     = 'leave';
            $table_timetable = 'timetable';
            $proceed         = TRUE;
        }
        if($proceed == true){
            $this->sql_query .= " LEFT JOIN  `".$table_leave."` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date BETWEEN '$date_from' AND '$date_to' AND l.status!=2
                                LEFT JOIN  `".$table_timetable."` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date BETWEEN '$date_from' AND '$date_to' AND t.employee!='' AND t.status!=2 
                                WHERE t.employee IS NULL ".($customer != '' ? ' AND r.employee IS NULL ' : '')." AND l.employee IS NULL 
                                AND e.username IN ('".  implode('\',\'', $possible_employees) . "') 
                                ".($_SESSION['user_role'] == 3 ? " AND e.username = '".$_SESSION['user_id']."'" : '');
        }

            

        $this->sql_query .= ' '. $order_by; 
        // echo $this->sql_query;
        $datas = $this->query_fetch();
        // echo '<pre>'.print_r($this->query_error_details, 1).'</pre>';

        $employees = array();
        foreach ($datas as $data) {
            $employees[] = array('username' => $data['username'], 
                'name' => $data['last_name'] . ' ' . $data['first_name'], 
                'name_ff' => $data['first_name'] . ' ' . $data['last_name'], 
                'ordered_name' => $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . ' ' . $data['last_name'] : $data['last_name'] . ' ' . $data['first_name'], 
                'code' => $data['code'], 
                'substitute' => $data['substitute'], 
                'mobile' => $data['mobile']);
        }

        return count($employees) ? $employees : array();
    }

    function get_available_employees_for_avail_report($from_date, $to_date = NULL, $time_from = NULL, $time_to = NULL, $customer = NULL, $possible_employees = array()) {
        
        /*require_once ('class/employee.php');
        $obj_employee = new employee();

        $i = 0;
        $available_users = array();
        $process_date = $from_date;
        do{
            $temp_available_users = $this->get_available_users_btwn_dates($process_date, $time_from, $time_to, $customer, $possible_employees);
            if($i == 0)
                $available_users = $temp_available_users;
            else
                $available_users = $obj_employee->employee_intersect($available_users, $temp_available_users);
            // $test1 = array_intersect($test1, $test2);
            $process_date = date('Y-m-d', strtotime($process_date . ' +1 day'));
            $i++;
        }
        while (strtotime($process_date) <= strtotime($to_date));
        $available_users = array_values($available_users);*/

        $available_users = $this->get_available_users_btwn_dates($from_date, $to_date, $time_from, $time_to, $customer, $possible_employees);
        return $available_users;
    }

    function get_notify_candg_slots(){
        $this->flush();
        $this->tables = array('notify_candg_slots');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status', 'employee_fname', 'employee_lname', 'customer_fname', 'customer_lname', 'started_user_task_id');
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_customer_AL_GL($customer_username) {

        $recipients = array();
        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'customer = ?', array('OR', 'role = 2', 'role = 7'));
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $sql_query_team_leader = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_team_leader));
        $this->query_generate();
        $team_leader_datas = $this->query_fetch();

        $recipient_datas = $team_leader_datas;

        //print_r($recipient_datas);
        if (!empty($recipient_datas)) {
            foreach ($recipient_datas as $recipient_data) {
                $recipients[] = array('username' => $recipient_data['username'], 'email' => $recipient_data['email'], 'mobile' => $recipient_data['mobile']);
            }
            return (!empty($recipients) ? $recipients : array());
        }
        else
            return array();
    }

    function get_slot_det_of_oncall_from_date($customer,$date){
        $this->sql_query = "SELECT `id`,`employee`,`customer`,`date`,`time_from`,`time_to`,`type`,`status`,`fkkn` FROM `timetable` WHERE `date`>='$date' and (`type`= 3 || `type`= 9 || `type`= 13 || `type`= 14 || `type`= 17) AND `customer` = '$customer' ";
        return $this->query_fetch();

    }

    function update_time_slot($slot_details,$time_from,$time_to){
        $this->tables           = array('timetable');
        $this->fields           = array('time_from','time_to');
        $this->field_values     = array($time_from,$time_to);
        $this->conditions       = array('id = ?');
        $this->condition_values = array($slot_details['id']);
        return $this->query_update();
    }

    function save_new_time_slots($slot_details,$time_from,$time_to,$type = NULL){
        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'date','time_from','time_to','type','status','fkkn');
        $type != null ? $type  : $type = $slot_details['type'];
        $this->field_values = array($slot_details['employee'], $slot_details['customer'], $slot_details['date'], $time_from,$time_to,$type,$slot_details['status'],$slot_details['fkkn']);
        echo $this->query_insert();
    }

    function get_report_signings_which_has_sign_data($till_date){
        $this->flush();
        $this->sql_query = 'SELECT id, employee, customer, date, employee_sign, employee_ocs, tl_sign, tl_ocs, sutl_sign, sutl_ocs 
                FROM `report_signing` 
                WHERE date <= ? AND 
                ( 
                    (employee_sign IS NOT NULL AND employee_sign != "" AND CHAR_LENGTH(employee_sign) > 5) OR
                    (employee_ocs IS NOT NULL AND employee_ocs != "" AND CHAR_LENGTH(employee_ocs) > 5) OR
                    (tl_sign IS NOT NULL AND tl_sign != "" AND CHAR_LENGTH(tl_sign) > 5) OR
                    (tl_ocs IS NOT NULL AND tl_ocs != "" AND CHAR_LENGTH(tl_ocs) > 5) OR
                    (sutl_sign IS NOT NULL AND sutl_sign != "" AND CHAR_LENGTH(sutl_sign) > 5) OR
                    (sutl_ocs IS NOT NULL AND sutl_ocs != "" AND CHAR_LENGTH(sutl_ocs) > 5)
                )';
        $this->condition_values = array($till_date);
        return $this->query_fetch();
    }

    function get_detailed_report_signing_details_by_id($id){
        $this->flush();
        $this->tables = array('report_signing_details');
        $this->fields = array('id', 'signing_id', 'employee_sign', 'employee_ocs', 'tl_sign', 'tl_ocs', 'sutl_sign', 'sutl_ocs');
        $this->conditions = array('signing_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        return $this->query_fetch();
    }

    function insert_detailed_report_signing($sign_data, $sign_e, $ocs_e, $sign_tl, $ocs_tl, $sign_sutl, $ocs_sutl){
        $this->flush();
        $this->tables           = array('report_signing_details');
        $this->fields           = array('signing_id');
        $this->field_values     = array($sign_data['id']);
        if($sign_e){
            $this->fields[]           = 'employee_sign';
            $this->field_values[]     = $sign_data['employee_sign'];
        }
        if($ocs_e){
            $this->fields[]           = 'employee_ocs';
            $this->field_values[]     = $sign_data['employee_ocs'];
        }
        if($sign_tl){
            $this->fields[]           = 'tl_sign';
            $this->field_values[]     = $sign_data['tl_sign'];
        }
        if($ocs_tl){
            $this->fields[]           = 'tl_ocs';
            $this->field_values[]     = $sign_data['tl_ocs'];
        }
        if($sign_sutl){
            $this->fields[]           = 'sutl_sign';
            $this->field_values[]     = $sign_data['sutl_sign'];
        }
        if($ocs_sutl){
            $this->fields[]           = 'sutl_ocs';
            $this->field_values[]     = $sign_data['sutl_ocs'];
        }
        return $this->query_insert();
    }

    function update_detailed_report_signing($sign_data, $sign_e, $ocs_e, $sign_tl, $ocs_tl, $sign_sutl, $ocs_sutl){
        $this->flush();
        $this->tables           = array('report_signing_details');
        $this->fields           = array();
        $this->field_values     = array();
        if($sign_e){
            $this->fields[]           = 'employee_sign';
            $this->field_values[]     = $sign_data['employee_sign'];
        }
        if($ocs_e){
            $this->fields[]           = 'employee_ocs';
            $this->field_values[]     = $sign_data['employee_ocs'];
        }
        if($sign_tl){
            $this->fields[]           = 'tl_sign';
            $this->field_values[]     = $sign_data['tl_sign'];
        }
        if($ocs_tl){
            $this->fields[]           = 'tl_ocs';
            $this->field_values[]     = $sign_data['tl_ocs'];
        }
        if($sign_sutl){
            $this->fields[]           = 'sutl_sign';
            $this->field_values[]     = $sign_data['sutl_sign'];
        }
        if($ocs_sutl){
            $this->fields[]           = 'sutl_ocs';
            $this->field_values[]     = $sign_data['sutl_ocs'];
        }

        if(empty($this->fields)) return TRUE;

        $this->conditions       = array('signing_id = ?');
        $this->condition_values = array($sign_data['id']);
        return $this->query_update();
    }

    function update_sign_data_on_report_signing($sign_data, $sign_e, $ocs_e, $sign_tl, $ocs_tl, $sign_sutl, $ocs_sutl){
        $this->flush();
        $this->tables           = array('report_signing');
        $this->fields           = array();
        $this->field_values     = array();
        if($sign_e){
            $this->fields[]           = 'employee_sign';
            $this->field_values[]     = 1;
        }
        if($ocs_e){
            $this->fields[]           = 'employee_ocs';
            $this->field_values[]     = 1;
        }
        if($sign_tl){
            $this->fields[]           = 'tl_sign';
            $this->field_values[]     = 1;
        }
        if($ocs_tl){
            $this->fields[]           = 'tl_ocs';
            $this->field_values[]     = 1;
        }
        if($sign_sutl){
            $this->fields[]           = 'sutl_sign';
            $this->field_values[]     = 1;
        }
        if($ocs_sutl){
            $this->fields[]           = 'sutl_ocs';
            $this->field_values[]     = 1;
        }

        if(empty($this->fields)) return TRUE;

        $this->conditions       = array('id = ?');
        $this->condition_values = array($sign_data['id']);
        return $this->query_update();
    }
}

?>