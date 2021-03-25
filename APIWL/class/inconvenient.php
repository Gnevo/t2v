<?php

/* class for managing inconvenient timing.
 * Mainly used in employee work report details
 * created by shaju
 */

//ini_set('display_errors', false);
//ini_set('xdebug.var_display_max_depth', 10);
//error_reporting(E_ALL ^ E_NOTICE);
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/employee.php');
require_once ('class/equipment.php');

class inconvenient extends db {
    //slot types
    const NORMAL = 0, TRAVEL = 1, BRK = 2, ONCALL = 3, OVER = 4, QUALITY = 5, MORE = 6, SOME = 7, TRAINING = 8, CALLTRAINING = 9, PERSONAL = 10, VOLUNTARY = 11, COMPLEMENTARY = 12, COMPLEMENTARY_ONCALL = 13, MORE_ONCALL = 14, STANDBY = 15, DISMISSAL = 16, DISMISSAL_ONCALL = 17;

    //general variables
    public $month;
    public $year;
    public $holidays = array();
    public $days_in_month = array();
    public $inconv_normal_category = array();
    public $inconv_oncall_category = array();
    public $leave_category = array();
    public $inconv_normal_slots = array();
    //variables for all slots
    public $rpt_content_normal = array();
    public $rpt_content_travel = array();
    public $rpt_content_break = array();
    public $rpt_content_oncall = array();
    public $rpt_content_over = array();
    public $rpt_content_quality = array();
    public $rpt_content_more = array();
    public $rpt_content_some = array();
    public $rpt_content_training = array();
    public $rpt_content_personal = array();
    public $rpt_content_calltraining = array();
    public $rpt_content_voluntary = array();
    public $rpt_content_complementary = array();
    public $rpt_content_complementary_oncall = array();
    public $rpt_content_more_oncall = array();
    public $rpt_content_standby = array();
    public $rpt_content_dismissal = array();
    public $rpt_content_dismissal_oncall = array();
    
    //variables for leave
    public $rpt_content_leave = array();
    public $rpt_content_leave_travel = array();
    public $rpt_content_leave_break = array();
    public $rpt_content_leave_over = array();
    public $rpt_content_leave_quality = array();
    public $rpt_content_leave_more = array();
    public $rpt_content_leave_some = array();
    public $rpt_content_leave_training = array();
    public $rpt_content_leave_personal = array();
    public $rpt_content_leave_calltraining = array();
    public $rpt_content_leave_oncall = array();
    public $rpt_content_leave_voluntary = array();
    public $rpt_content_leave_more_oncall = array();
    public $rpt_content_leave_standby = array();
    
    //variables for heading
    public $sub_keys_normal = array();
    public $sub_keys_travel = array();
    public $sub_keys_break = array();
    public $sub_keys_over = array();
    public $sub_keys_quality = array();
    public $sub_keys_more = array();
    public $sub_keys_some = array();
    public $sub_keys_training = array();
    public $sub_keys_personal = array();
    public $sub_keys_oncall = array();
    public $sub_keys_calltraining = array();
    public $sub_keys_voluntary = array();
    public $sub_keys_complementary = array();
    public $sub_keys_complementary_oncall = array();
    public $sub_keys_more_oncall = array();
    public $sub_keys_standby = array();
    public $sub_keys_dismissal   = array();
    public $sub_keys_dismissal_oncall   = array();
    
    public $sub_keys_leave_normal = array();
    public $sub_keys_leave_normal_inconv = array();
    public $sub_keys_leave_normal_head = array();
    public $sub_keys_leave_travel = array();
    public $sub_keys_leave_travel_inconv = array();
    public $sub_keys_leave_travel_head = array();
    public $sub_keys_leave_break = array();
    public $sub_keys_leave_break_inconv = array();
    public $sub_keys_leave_break_head = array();
    public $sub_keys_leave_over = array();
    public $sub_keys_leave_over_inconv = array();
    public $sub_keys_leave_over_head = array();
    public $sub_keys_leave_quality = array();
    public $sub_keys_leave_quality_inconv = array();
    public $sub_keys_leave_quality_head = array();
    public $sub_keys_leave_more = array();
    public $sub_keys_leave_more_inconv = array();
    public $sub_keys_leave_more_head = array();
    public $sub_keys_leave_some = array();
    public $sub_keys_leave_some_inconv = array();
    public $sub_keys_leave_some_head = array();
    public $sub_keys_leave_training = array();
    public $sub_keys_leave_training_inconv = array();
    public $sub_keys_leave_training_head = array();
    public $sub_keys_leave_personal = array();
    public $sub_keys_leave_personal_inconv = array();
    public $sub_keys_leave_personal_head = array();
    public $sub_keys_leave_oncall = array();
    public $sub_keys_leave_oncall_inconv = array();
    public $sub_keys_leave_oncall_head = array();
    public $sub_keys_leave_calltraining = array();
    public $sub_keys_leave_calltraining_inconv = array();
    public $sub_keys_leave_calltraining_head = array();
    public $sub_keys_leave_voluntary = array();
    public $sub_keys_leave_voluntary_inconv = array();
    public $sub_keys_leave_voluntary_head = array();
    public $sub_keys_leave_more_oncall = array();
    public $sub_keys_leave_more_oncall_inconv = array();
    public $sub_keys_leave_more_oncall_head = array();
    public $sub_keys_leave_standby = array();
    public $sub_keys_leave_standby_inconv = array();
    public $sub_keys_leave_standby_head = array();
    
    //variables for sum
    public $sum_normal = array();
    public $sum_travel = array();
    public $sum_break = array();
    public $sum_over = array();
    public $sum_quality = array();
    public $sum_more = array();
    public $sum_some = array();
    public $sum_training = array();
    public $sum_personal = array();
    public $sum_oncall = array();
    public $sum_calltraining = array();
    public $sum_voluntary = array();
    public $sum_complementary = array();
    public $sum_complementary_oncall = array();
    public $sum_more_oncall = array();
    public $sum_standby = array();
    public $sum_dismissal = array();
    public $sum_dismissal_oncall = array();
    
    public $sum_leave_normal = array();
    public $sum_leave_normal_inconv = array();
    public $sum_leave_travel = array();
    public $sum_leave_travel_inconv = array();
    public $sum_leave_break = array();
    public $sum_leave_break_inconv = array();
    public $sum_leave_over = array();
    public $sum_leave_over_inconv = array();
    public $sum_leave_quality = array();
    public $sum_leave_quality_inconv = array();
    public $sum_leave_more = array();
    public $sum_leave_more_inconv = array();
    public $sum_leave_some = array();
    public $sum_leave_some_inconv = array();
    public $sum_leave_training = array();
    public $sum_leave_training_inconv = array();
    public $sum_leave_personal = array();
    public $sum_leave_personal_inconv = array();
    public $sum_leave_oncall = array();
    public $sum_leave_oncall_inconv = array();
    public $sum_leave_calltraining = array();
    public $sum_leave_calltraining_inconv = array();
    public $sum_leave_voluntary = array();
    public $sum_leave_voluntary_inconv = array();
    public $sum_leave_more_oncall = array();
    public $sum_leave_more_oncall_inconv = array();
    public $sum_leave_standby = array();
    public $sum_leave_standby_inconv = array();
    
    //for grouping different categories asper different salary amount
    public $salary_hours = array();

    public $fkkn_slots = array();

    public function __construct() {

        parent::__construct();
        //constructor overloading
        $const_args = func_get_args();
        if (count($const_args)) {
            $this->month = $const_args[0];
            $this->year = $const_args[1];
        } else {
            $this->month = date('m');
            $this->year = date('Y');
        }
    }
    
    public function generate_work_report_using_input_slots($passed_employee, $sdate, $edate, $passed_customer = '', $flag_holiday = 1){
        /**
         * Author: Shamsu
         * for: generate work report inconvenient varialbles by using passed $inconv_normal_slots
         * used in salary report
         */
        $employee = new employee();
        $this_month = date('m',strtotime($sdate));
        $this_year = date('Y',strtotime($sdate));
//        $this->inconv_normal_slots is explicitly assigned from calling function
        $this->inconv_normal_category = $employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $passed_employee, 1, $passed_customer);
        $this->inconv_oncall_category = $employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $passed_employee, 3, $passed_customer);
//        echo "<pre>".print_r($this->inconv_oncall_category, 1)."</pre>";
        $this->leave_category = $employee->get_leave_details_btwn_2_dates($sdate, $edate, $passed_employee);
        
        if($employee->is_ob_on_for_a_employee($passed_employee))
            $this->holidays = $employee->get_holiday_details($this_month, $this_year);
        else
            $this->holidays = array();
        
        $this->categorize_slots($passed_employee, '', $flag_holiday);
    }
    
    public function reset_inconvenient_variables(){
        $this->month = '';
        $this->year = '';
        $this->holidays = array();
        $this->days_in_month = array();
        $this->inconv_normal_category = array();
        $this->inconv_oncall_category = array();
        $this->leave_category = array();
        $this->inconv_normal_slots = array();
        
        //variables for all slots
        $this->rpt_content_normal = array();
        $this->rpt_content_travel = array();
        $this->rpt_content_break = array();
        $this->rpt_content_oncall = array();
        $this->rpt_content_over = array();
        $this->rpt_content_quality = array();
        $this->rpt_content_more = array();
        $this->rpt_content_some = array();
        $this->rpt_content_training = array();
        $this->rpt_content_personal = array();
        $this->rpt_content_calltraining = array();
        $this->rpt_content_voluntary = array();
        $this->rpt_content_complementary = array();
        $this->rpt_content_complementary_oncall = array();
        $this->rpt_content_more_oncall = array();
        $this->rpt_content_standby = array();
        $this->rpt_content_dismissal = array();
        $this->rpt_content_dismissal_oncall = array();
        
        $this->rpt_content_leave = array();
        $this->rpt_content_leave_travel = array();
        $this->rpt_content_leave_break = array();
        $this->rpt_content_leave_over = array();
        $this->rpt_content_leave_quality = array();
        $this->rpt_content_leave_more = array();
        $this->rpt_content_leave_some = array();
        $this->rpt_content_leave_training = array();
        $this->rpt_content_leave_personal = array();
        $this->rpt_content_leave_calltraining = array();
        $this->rpt_content_leave_oncall = array();
        $this->rpt_content_leave_voluntary = array();
        $this->rpt_content_leave_more_oncall = array();
        $this->rpt_content_leave_standby = array();
        
        //variables for heading
        $this->sub_keys_normal = array();
        $this->sub_keys_travel = array();
        $this->sub_keys_break = array();
        $this->sub_keys_over = array();
        $this->sub_keys_quality = array();
        $this->sub_keys_more = array();
        $this->sub_keys_some = array();
        $this->sub_keys_training = array();
        $this->sub_keys_personal = array();
        $this->sub_keys_oncall = array();
        $this->sub_keys_calltraining = array();
        $this->sub_keys_voluntary = array();
        $this->sub_keys_complementary = array();
        $this->sub_keys_complementary_oncall = array();
        $this->sub_keys_more_oncall = array();
        $this->sub_keys_standby = array();
        $this->sub_keys_dismissal = array();
        $this->sub_keys_dismissal_oncall = array();
        
        
        $this->sub_keys_leave_normal = array();
        $this->sub_keys_leave_normal_inconv = array();
        $this->sub_keys_leave_normal_head = array();
        $this->sub_keys_leave_travel = array();
        $this->sub_keys_leave_travel_inconv = array();
        $this->sub_keys_leave_travel_head = array();
        $this->sub_keys_leave_break = array();
        $this->sub_keys_leave_break_inconv = array();
        $this->sub_keys_leave_break_head = array();
        $this->sub_keys_leave_over = array();
        $this->sub_keys_leave_over_inconv = array();
        $this->sub_keys_leave_over_head = array();
        $this->sub_keys_leave_quality = array();
        $this->sub_keys_leave_quality_inconv = array();
        $this->sub_keys_leave_quality_head = array();
        $this->sub_keys_leave_more = array();
        $this->sub_keys_leave_more_inconv = array();
        $this->sub_keys_leave_more_head = array();
        $this->sub_keys_leave_some = array();
        $this->sub_keys_leave_some_inconv = array();
        $this->sub_keys_leave_some_head = array();
        $this->sub_keys_leave_training = array();
        $this->sub_keys_leave_training_inconv = array();
        $this->sub_keys_leave_training_head = array();
        $this->sub_keys_leave_personal = array();
        $this->sub_keys_leave_personal_inconv = array();
        $this->sub_keys_leave_personal_head = array();
        $this->sub_keys_leave_oncall = array();
        $this->sub_keys_leave_oncall_inconv = array();
        $this->sub_keys_leave_oncall_head = array();
        $this->sub_keys_leave_calltraining = array();
        $this->sub_keys_leave_calltraining_inconv = array();
        $this->sub_keys_leave_calltraining_head = array();
        $this->sub_keys_leave_voluntary = array();
        $this->sub_keys_leave_voluntary_inconv = array();
        $this->sub_keys_leave_voluntary_head = array();
        $this->sub_keys_leave_more_oncall = array();
        $this->sub_keys_leave_more_oncall_inconv = array();
        $this->sub_keys_leave_more_oncall_head = array();
        $this->sub_keys_leave_standby = array();
        $this->sub_keys_leave_standby_inconv = array();
        $this->sub_keys_leave_standby_head = array();
        
        //variables for sum
        $this->sum_normal = array();
        $this->sum_travel = array();
        $this->sum_break = array();
        $this->sum_over = array();
        $this->sum_quality = array();
        $this->sum_more = array();
        $this->sum_some = array();
        $this->sum_training = array();
        $this->sum_personal = array();
        $this->sum_oncall = array();
        $this->sum_calltraining = array();
        $this->sum_voluntary = array();
        $this->sum_complementary = array();
        $this->sum_complementary_oncall = array();
        $this->sum_more_oncall = array();
        $this->sum_standby = array();
        $this->sum_dismissal = array();
        $this->sum_dismissal_oncall = array();
        
        $this->sum_leave_normal = array();
        $this->sum_leave_normal_inconv = array();
        $this->sum_leave_travel = array();
        $this->sum_leave_travel_inconv = array();
        $this->sum_leave_break = array();
        $this->sum_leave_break_inconv = array();
        $this->sum_leave_over = array();
        $this->sum_leave_over_inconv = array();
        $this->sum_leave_quality = array();
        $this->sum_leave_quality_inconv = array();
        $this->sum_leave_more = array();
        $this->sum_leave_more_inconv = array();
        $this->sum_leave_some = array();
        $this->sum_leave_some_inconv = array();
        $this->sum_leave_training = array();
        $this->sum_leave_training_inconv = array();
        $this->sum_leave_personal = array();
        $this->sum_leave_personal_inconv = array();
        $this->sum_leave_oncall = array();
        $this->sum_leave_oncall_inconv = array();
        $this->sum_leave_calltraining = array();
        $this->sum_leave_calltraining_inconv = array();
        $this->sum_leave_more_oncall = array();
        $this->sum_leave_more_oncall_inconv = array();
        $this->sum_leave_standby = array();
        $this->sum_leave_standby_inconv = array();
        
        $this->salary_hours = array();

        $this->comment_dates = array();

        $this->fkkn_slots = array();
    }
    
    //generating employee mothly work report
    public function generate_work_report($passed_employee, $month, $yr, $passed_customer = '') {
        $employee = new employee();
        $this->inconv_normal_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);
        
//        if($employee->is_ob_on_for_a_employee($passed_employee)){
            //$this->inconv_normal_category = $employee->get_distinct_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);
            //$this->inconv_oncall_category = $employee->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);
            /*if($month == ''){
                $start_date = $yr.'-01-01';
                $end_date   = $yr.'-12-31';
            }
            else{
                $start_date = $yr.'-'.$month.'-'.'01';
                $end_date   = date("Y-m-t", strtotime($start_date));
            }*/

            $sdate = date('Y-m-01', strtotime("$yr-$month-01"));
            $edate = date('Y-m-t', strtotime("$yr-$month-01"));
            $this->inconv_normal_category = $employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $passed_employee, 1, $passed_customer);
            $this->inconv_oncall_category = $employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $passed_employee, 3, $passed_customer);
//            if($_COOKIE['admin'] == 'yes'){
//                echo "<pre>func_get_args".print_r(func_get_args(), 1)."</pre>";
                //echo "<pre>inconv_oncall_category : ".print_r($this->inconv_oncall_category, 1)."</pre>";exit();
//            }
            
//        } else
//            $this->inconv_normal_category = $this->inconv_oncall_category = array();
//        echo "<pre>inconv_normal_category : ".print_r($this->inconv_normal_slots, 1)."</pre>";exit();
//        echo "<pre>inconv_oncall_category : ".print_r($this->inconv_oncall_category, 1)."</pre>";    
        $this->leave_category = $employee->get_leave_details_by_month_and_year($month, $yr, $passed_employee,$passed_customer, $sdate, $edate);
        if($employee->is_ob_on_for_a_employee($passed_employee))
            $this->holidays = $employee->get_holiday_details($month, $yr);
        else
            $this->holidays = array();
        //echo "<pre>holidays : ".print_r($this->holidays, 1)."</pre>";
        
        $this->categorize_slots($passed_employee, $passed_customer);
        //$this->categorize_salary_hours();
    }
    
    //categorizing the slots under different labels
    public function categorize_slots($passed_employee, $passed_customer = '', $flag_holiday = 1) {
        //       echo "<pre>Innnnnnnnnnnnconvenient: ".print_r($this->inconv_normal_slots, 1)."</pre>";
               // echo "<pre>inconv_normal_category : ".print_r($this->inconv_normal_category, 1)."</pre>";
               // echo "<pre>inconv_oncall_category: ".print_r($this->inconv_oncall_category, 1)."</pre>"; exit('h');
        //        echo "<pre>leave_category: ".print_r($this->leave_category, 1)."</pre>";
        //        echo "<pre>holidays: ".print_r($this->holidays, 1)."</pre>";
        $employee = new employee();
        do {
            foreach ($this->inconv_normal_slots as $key => $inconv_normal_slot) {
                
                $i++;
                $flag = 0;

                if($inconv_normal_slot['comment'] != ''){
                    $this->comment_dates[] = $inconv_normal_slot['date'];
                }
                //                $current_date = mktime(0, 0, 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $slot_time_from = mktime(intval($inconv_normal_slot['time_from']), bcmod($inconv_normal_slot['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $slot_time_to = mktime(intval($inconv_normal_slot['time_to']), bcmod($inconv_normal_slot['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                //echo "<pre>Innnnnnnnnnnnconvenient: ".print_r($this->inconv_normal_slots, 1)."</pre>";
                //if slot type is normal
                if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '0') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_normal, $this->inconv_normal_category, $key);
                }
                //if slot type is travel
                if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '1') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_travel, $this->inconv_normal_category, $key, 2);
                }
                //if slot type is break
                if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '2') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_break, $this->inconv_normal_category, $key);
                }
                //if the  slot type is overtime
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '4') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_over, $this->inconv_normal_category, $key);
                }
                // if the slot type is quality overtime
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '5') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_quality, $this->inconv_normal_category, $key);
                }
                //if the slot type is more time
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '6') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_more, $this->inconv_normal_category, $key);
                }
                //if the slot type is some other time
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '7') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_some, $this->inconv_normal_category, $key, 0);
                }
                //if the slot type is training
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '8') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_training, $this->inconv_normal_category, $key);
                }
                //if the slot type is personal meeting
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '10') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_personal, $this->inconv_normal_category, $key, 0);
                }
                //if the slot type is voluntary
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '11') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_voluntary, $this->inconv_normal_category, $key);
                }
                //if the slot type is complementary
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '12') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_complementary, $this->inconv_normal_category, $key);
                }
                //if the slot type is standby
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '15') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_standby, $this->inconv_normal_category, $key);
                }
                //if the slot type is dismissal
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '16') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_dismissal, $this->inconv_normal_category, $key);
                }
                //if the slot type is oncall
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '3') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_oncall, $this->inconv_oncall_category, $key);
                }
                //if the slot type is oncall training
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '9') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_calltraining, $this->inconv_oncall_category, $key);
                }
                //if the slot type is complementary oncall
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '13') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_complementary_oncall, $this->inconv_oncall_category, $key);
                }
                //if slot type in more_time oncall
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '14') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_more_oncall, $this->inconv_oncall_category, $key);
                }
                //if slot type in dismissal oncall
                else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '17') {
                    $flag = $this->get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_dismissal_oncall, $this->inconv_oncall_category, $key);
                }
                
                //              *STARTING OF LEAVES*
                elseif ($inconv_normal_slot['status'] == 2) {
                    $leave_type = $employee->getLeaveType($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                    if ($leave_type) {
                        //if leave slot is of type normal
                        if ($inconv_normal_slot['type'] == '0') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type travel
                        if ($inconv_normal_slot['type'] == '1') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_travel, $this->inconv_normal_category, $leave_type['type'], $key, 2, $flag_holiday);
                        }
                        //if leave slot is of type break
                        if ($inconv_normal_slot['type'] == '2') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_break, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type overtime
                        else if ($inconv_normal_slot['type'] == '4') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_over, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type quality overtime
                        else if ($inconv_normal_slot['type'] == '5') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_quality, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type more_time
                        else if ($inconv_normal_slot['type'] == '6') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_more, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type some other time
                        else if ($inconv_normal_slot['type'] == '7') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_some, $this->inconv_normal_category, $leave_type['type'], $key, 0, $flag_holiday);
                        }
                        //if leave slot is of type training
                        else if ($inconv_normal_slot['type'] == '8') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_training, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type personal meeting
                        else if ($inconv_normal_slot['type'] == '10') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_personal, $this->inconv_normal_category, $leave_type['type'], $key, 0, $flag_holiday);
                        }
                        //if leave slot is of type voluntary
                        else if ($inconv_normal_slot['type'] == '11') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_voluntary, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type standby
                        else if ($inconv_normal_slot['type'] == '15') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_standby, $this->inconv_normal_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type oncall
                        else if ($inconv_normal_slot['type'] == '3') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_oncall, $this->inconv_oncall_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type oncall
                        else if ($inconv_normal_slot['type'] == '9') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_calltraining, $this->inconv_oncall_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                        //if leave slot is of type more time oncall
                        else if ($inconv_normal_slot['type'] == '14') {
                            $flag = $this->get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, $this->rpt_content_leave_more_oncall, $this->inconv_oncall_category, $leave_type['type'], $key, 1, $flag_holiday);
                        }
                    }
                }
                if($flag == 1){
                    break;
                }
            }
        } while ($flag == 1 && !empty($this->inconv_normal_slots));

        foreach ($this->inconv_normal_slots as $inconv_normal_slot) {

            $slot_time_from = mktime(intval($inconv_normal_slot['time_from']), bcmod($inconv_normal_slot['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            $slot_time_to = mktime(intval($inconv_normal_slot['time_to']), bcmod($inconv_normal_slot['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            $time_duration = 0;
            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '0') {
                
                $this->rpt_content_normal[$inconv_normal_slot['date']]['Ord. tid'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            }elseif ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '1') {
                
                $this->rpt_content_travel[$inconv_normal_slot['date']]['travel'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            }elseif ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '2') {
                
                $this->rpt_content_break[$inconv_normal_slot['date']]['break'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '4')) {

                $this->rpt_content_over[$inconv_normal_slot['date']]['overtime'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '5')) {

                $this->rpt_content_quality[$inconv_normal_slot['date']]['qual_overtime'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '6')) {

                $this->rpt_content_more[$inconv_normal_slot['date']]['more_time'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '7')) {

                $this->rpt_content_some[$inconv_normal_slot['date']]['some_other_time'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '8')) {

                $this->rpt_content_training[$inconv_normal_slot['date']]['training'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '10')) {

                $this->rpt_content_personal[$inconv_normal_slot['date']]['personal_meeting'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '11')) {

                $this->rpt_content_voluntary[$inconv_normal_slot['date']]['voluntary'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '12')) {

                $this->rpt_content_complementary[$inconv_normal_slot['date']]['complementary'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '15')) {

                $this->rpt_content_standby[$inconv_normal_slot['date']]['standby'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '16')) {

                $this->rpt_content_dismissal[$inconv_normal_slot['date']]['dismissal'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '3')) {

                $this->rpt_content_oncall[$inconv_normal_slot['date']]['jour'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '9')) {

                $this->rpt_content_calltraining[$inconv_normal_slot['date']]['call_training'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '13')) {

                $this->rpt_content_complementary_oncall[$inconv_normal_slot['date']]['complementary_oncall'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '14')) {

                $this->rpt_content_more_oncall[$inconv_normal_slot['date']]['more_oncall'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '17')) {

                $this->rpt_content_dismissal_oncall[$inconv_normal_slot['date']]['dismissal_oncall'] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
            } elseif ($inconv_normal_slot['status'] == 2) {
                $leave_type = $employee->getLeaveType($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                if ($leave_type) {
                    if ($inconv_normal_slot['type'] == '0') {

                        $this->rpt_content_leave[$inconv_normal_slot['date']][$leave_type['type']]['Ord. tid'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '1') {

                        $this->rpt_content_leave_travel[$inconv_normal_slot['date']][$leave_type['type']]['travel'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '2') {

                        $this->rpt_content_leave_break[$inconv_normal_slot['date']][$leave_type['type']]['break'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '4') {

                        $this->rpt_content_leave_over[$inconv_normal_slot['date']][$leave_type['type']]['overtime'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '5') {

                        $this->rpt_content_leave_quality[$inconv_normal_slot['date']][$leave_type['type']]['qual_overtime'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '6') {

                        $this->rpt_content_leave_more[$inconv_normal_slot['date']][$leave_type['type']]['more_time'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '7') {

                        $this->rpt_content_leave_some[$inconv_normal_slot['date']][$leave_type['type']]['some_other_time'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '8') {

                        $this->rpt_content_leave_training[$inconv_normal_slot['date']][$leave_type['type']]['training'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '10') {

                        $this->rpt_content_leave_personal[$inconv_normal_slot['date']][$leave_type['type']]['personal_meeting'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '11') {

                        $this->rpt_content_leave_voluntary[$inconv_normal_slot['date']][$leave_type['type']]['voluntary'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '15') {

                        $this->rpt_content_leave_standby[$inconv_normal_slot['date']][$leave_type['type']]['standby'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '3') {

                        $this->rpt_content_leave_oncall[$inconv_normal_slot['date']][$leave_type['type']]['jour'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '9') {

                        $this->rpt_content_leave_calltraining[$inconv_normal_slot['date']][$leave_type['type']]['call_training'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    } elseif ($inconv_normal_slot['type'] == '14') {

                        $this->rpt_content_leave_more_oncall[$inconv_normal_slot['date']][$leave_type['type']]['more_oncall'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    }
                }
            }
            if($time_duration != 0){
                $this->generate_fkkn_separation($inconv_normal_slot['date'], $time_duration, $inconv_normal_slot['type'], $inconv_normal_slot['fkkn']);
            }
        }
       // exit();
        //echo "<pre>normal: ".print_r($this->fkkn_slots, 1)."</pre>";exit();
        // echo "<pre>normal: ".print_r($this->rpt_content_leave, 1)."</pre>";
        // echo "<pre>quality: ".print_r($this->rpt_content_no, 1)."</pre>";exit();
        //Taking the distinct normal types for making the headings
        $this->sub_keys_normal = $this->generate_headings($this->rpt_content_normal, self::NORMAL);
        $this->sub_keys_travel = $this->generate_headings($this->rpt_content_travel, self::TRAVEL);
        $this->sub_keys_break = $this->generate_headings($this->rpt_content_break, self::BRK);
        $this->sub_keys_over = $this->generate_headings($this->rpt_content_over, self::OVER);
        $this->sub_keys_quality = $this->generate_headings($this->rpt_content_quality, self::QUALITY);
        $this->sub_keys_more = $this->generate_headings($this->rpt_content_more, self::MORE);
        $this->sub_keys_some = $this->generate_headings($this->rpt_content_some, self::SOME);
        $this->sub_keys_training = $this->generate_headings($this->rpt_content_training, self::TRAINING);
        $this->sub_keys_personal = $this->generate_headings($this->rpt_content_personal, self::PERSONAL);
        $this->sub_keys_oncall = $this->generate_headings($this->rpt_content_oncall, self::ONCALL);
        $this->sub_keys_calltraining = $this->generate_headings($this->rpt_content_calltraining, self::CALLTRAINING);
        $this->sub_keys_voluntary = $this->generate_headings($this->rpt_content_voluntary, self::VOLUNTARY);
        $this->sub_keys_complementary = $this->generate_headings($this->rpt_content_complementary, self::COMPLEMENTARY);
        $this->sub_keys_complementary_oncall = $this->generate_headings($this->rpt_content_complementary_oncall, self::COMPLEMENTARY_ONCALL);
        $this->sub_keys_more_oncall = $this->generate_headings($this->rpt_content_more_oncall, self::MORE_ONCALL);
        $this->sub_keys_standby = $this->generate_headings($this->rpt_content_standby, self::STANDBY);
        $this->sub_keys_dismissal = $this->generate_headings($this->rpt_content_dismissal, self::DISMISSAL);
        $this->sub_keys_dismissal_oncall = $this->generate_headings($this->rpt_content_dismissal_oncall, self::DISMISSAL_ONCALL);
        //echo "<pre>".print_r($this->sub_keys_dismissal_oncall)."</pre>";;
        //Taking the distinct leave types for making the headings
        $this->sub_keys_leave_normal_head = $this->generate_leave_headings($this->sub_keys_leave_normal, $this->sub_keys_leave_normal_inconv, $this->rpt_content_leave, self::NORMAL);
        $this->sub_keys_leave_travel_head = $this->generate_leave_headings($this->sub_keys_leave_travel, $this->sub_keys_leave_travel_inconv, $this->rpt_content_leave_travel, self::TRAVEL);
        $this->sub_keys_leave_break_head = $this->generate_leave_headings($this->sub_keys_leave_break, $this->sub_keys_leave_break_inconv, $this->rpt_content_leave_break, self::BRK);
        $this->sub_keys_leave_over_head = $this->generate_leave_headings($this->sub_keys_leave_over, $this->sub_keys_leave_over_inconv, $this->rpt_content_leave_over, self::OVER);
        $this->sub_keys_leave_quality_head = $this->generate_leave_headings($this->sub_keys_leave_quality, $this->sub_keys_leave_quality_inconv, $this->rpt_content_leave_quality, self::QUALITY);
        $this->sub_keys_leave_more_head = $this->generate_leave_headings($this->sub_keys_leave_more, $this->sub_keys_leave_more_inconv, $this->rpt_content_leave_more, self::MORE);
        $this->sub_keys_leave_some_head = $this->generate_leave_headings($this->sub_keys_leave_some, $this->sub_keys_leave_some_inconv, $this->rpt_content_leave_some, self::SOME);
        $this->sub_keys_leave_training_head = $this->generate_leave_headings($this->sub_keys_leave_training, $this->sub_keys_leave_training_inconv, $this->rpt_content_leave_training, self::TRAINING);
        $this->sub_keys_leave_personal_head = $this->generate_leave_headings($this->sub_keys_leave_personal, $this->sub_keys_leave_personal_inconv, $this->rpt_content_leave_personal, self::PERSONAL);
        $this->sub_keys_leave_voluntary_head = $this->generate_leave_headings($this->sub_keys_leave_voluntary, $this->sub_keys_leave_voluntary_inconv, $this->rpt_content_leave_voluntary, self::VOLUNTARY);
        $this->sub_keys_leave_oncall_head = $this->generate_leave_headings($this->sub_keys_leave_oncall, $this->sub_keys_leave_oncall_inconv, $this->rpt_content_leave_oncall, self::ONCALL);
        $this->sub_keys_leave_calltraining_head = $this->generate_leave_headings($this->sub_keys_leave_calltraining, $this->sub_keys_leave_calltraining_inconv, $this->rpt_content_leave_calltraining, self::CALLTRAINING);
        $this->sub_keys_leave_more_oncall_head = $this->generate_leave_headings($this->sub_keys_leave_more_oncall, $this->sub_keys_leave_more_oncall_inconv, $this->rpt_content_leave_more_oncall, self::MORE_ONCALL);
        $this->sub_keys_leave_standby_head = $this->generate_leave_headings($this->sub_keys_leave_standby, $this->sub_keys_leave_standby_inconv, $this->rpt_content_leave_standby, self::STANDBY);

        //removing duplicate dates and sortig the dates
        $this->days_in_month = array_unique($this->days_in_month);
        sort($this->days_in_month);

        //getting the sum of each normal heads
        $this->sum_normal = $this->get_sum($this->rpt_content_normal, $this->sub_keys_normal);
        $this->sum_travel = $this->get_sum($this->rpt_content_travel, $this->sub_keys_travel);
        $this->sum_break = $this->get_sum($this->rpt_content_break, $this->sub_keys_break);
        $this->sum_over = $this->get_sum($this->rpt_content_over, $this->sub_keys_over);
        $this->sum_quality = $this->get_sum($this->rpt_content_quality, $this->sub_keys_quality);
        $this->sum_more = $this->get_sum($this->rpt_content_more, $this->sub_keys_more);
        $this->sum_some = $this->get_sum($this->rpt_content_some, $this->sub_keys_some);
        $this->sum_training = $this->get_sum($this->rpt_content_training, $this->sub_keys_training);
        $this->sum_personal = $this->get_sum($this->rpt_content_personal, $this->sub_keys_personal);
        $this->sum_voluntary = $this->get_sum($this->rpt_content_voluntary, $this->sub_keys_voluntary);
        $this->sum_complementary = $this->get_sum($this->rpt_content_complementary, $this->sub_keys_complementary);
        $this->sum_oncall = $this->get_sum($this->rpt_content_oncall, $this->sub_keys_oncall);
        $this->sum_calltraining = $this->get_sum($this->rpt_content_calltraining, $this->sub_keys_calltraining);
        $this->sum_complementary_oncall = $this->get_sum($this->rpt_content_complementary_oncall, $this->sub_keys_complementary_oncall);
        $this->sum_more_oncall = $this->get_sum($this->rpt_content_more_oncall, $this->sub_keys_more_oncall);
        $this->sum_standby = $this->get_sum($this->rpt_content_standby, $this->sub_keys_standby);
        $this->sum_dismissal = $this->get_sum($this->rpt_content_dismissal, $this->sub_keys_dismissal);
        $this->sum_dismissal_oncall = $this->get_sum($this->rpt_content_dismissal_oncall, $this->sub_keys_dismissal_oncall);
        
        //getting the sum of each leave head
        $this->sum_leave_normal_inconv = $this->get_leave_sum($this->sum_leave_normal, $this->rpt_content_leave, $this->sub_keys_leave_normal_head);
        $this->sum_leave_travel_inconv = $this->get_leave_sum($this->sum_leave_travel, $this->rpt_content_leave_travel, $this->sub_keys_leave_travel_head);
        $this->sum_leave_break_inconv = $this->get_leave_sum($this->sum_leave_break, $this->rpt_content_leave_break, $this->sub_keys_leave_break_head);
        $this->sum_leave_over_inconv = $this->get_leave_sum($this->sum_leave_over, $this->rpt_content_leave_over, $this->sub_keys_leave_over_head);
        $this->sum_leave_quality_inconv = $this->get_leave_sum($this->sum_leave_quality, $this->rpt_content_leave_quality, $this->sub_keys_leave_quality_head);
        $this->sum_leave_more_inconv = $this->get_leave_sum($this->sum_leave_more, $this->rpt_content_leave_more, $this->sub_keys_leave_more_head);
        $this->sum_leave_some_inconv = $this->get_leave_sum($this->sum_leave_some, $this->rpt_content_leave_some, $this->sub_keys_leave_some_head);
        $this->sum_leave_training_inconv = $this->get_leave_sum($this->sum_leave_training, $this->rpt_content_leave_training, $this->sub_keys_leave_training_head);
        $this->sum_leave_personal_inconv = $this->get_leave_sum($this->sum_leave_personal, $this->rpt_content_leave_personal, $this->sub_keys_leave_personal_head);
        $this->sum_leave_voluntary_inconv = $this->get_leave_sum($this->sum_leave_voluntary, $this->rpt_content_leave_voluntary, $this->sub_keys_leave_voluntary_head);
        $this->sum_leave_oncall_inconv = $this->get_leave_sum($this->sum_leave_oncall, $this->rpt_content_leave_oncall, $this->sub_keys_leave_oncall_head);
        $this->sum_leave_calltraining_inconv = $this->get_leave_sum($this->sum_leave_calltraining, $this->rpt_content_leave_calltraining, $this->sub_keys_leave_calltraining_head);
        $this->sum_leave_more_oncall_inconv = $this->get_leave_sum($this->sum_leave_more_oncall, $this->rpt_content_leave_more_oncall, $this->sub_keys_leave_more_oncall_head);
        $this->sum_leave_standby_inconv = $this->get_leave_sum($this->sum_leave_standby, $this->rpt_content_leave_standby, $this->sub_keys_leave_standby_head);
        
    }

    //finding sum of each leave heads
    public function get_leave_sum(&$sum_leave, $rpt_contents, $sub_keys_leave_head) {
        
        $sum_leave_inconv = array();
        
        foreach ($rpt_contents as $rpt_content) {
            foreach ($sub_keys_leave_head as $sub_key_leave) {
                foreach ($sub_key_leave as $key => $sub_key) {
                    $sum_leave[$key] += $rpt_content[$key][$sub_key];
                    $sum_leave_inconv[$key][$sub_key] += $rpt_content[$key][$sub_key];
                }
            }
        }
        return $sum_leave_inconv;
    }

    //finding the sum of each heads
    public function get_sum($rpt_contents, $sub_keys) {
        $sum = array();
        foreach ($rpt_contents as $rpt_content) {
            foreach ($sub_keys as $sub_key) {
                if($sub_key != '')
                    $sum[$sub_key] += $rpt_content[$sub_key];
            }
        }
        return $sum;
    }

    //for generating headingd of leave type
    public function generate_leave_headings(&$sub_keys_leave, &$sub_keys_leave_inconv, $rpt_content, $key) {

        $sub_keys_leave_head = array();
        $leave_normal_flag = 0;
        $type = $this->get_key_type($key);
        $this->days_in_month = array_merge($this->days_in_month, array_keys($rpt_content));
        foreach (array_keys($rpt_content) as $main_keys) {

            foreach (array_keys($rpt_content[$main_keys]) as $sub) {

                foreach (array_keys($rpt_content[$main_keys][$sub]) as $sub_inconv) {
                    if (array_key_exists($sub_inconv, $rpt_content[$main_keys][$sub])) {
                        if (!in_array(array($sub => $sub_inconv), $sub_keys_leave_head))
                            array_push($sub_keys_leave_head, array($sub => $sub_inconv));
                    }
                    if (in_array($sub_inconv, $sub_keys_leave_inconv)) {
                        continue;
                    } else {
                        if ($sub_inconv == $type)
                            $leave_normal_flag = 1;
                        else
                            array_push($sub_keys_leave_inconv, $sub_inconv);
                    }
                }
                if (in_array($sub, $sub_keys_leave))
                    continue;
                else
                    array_push($sub_keys_leave, $sub);
            }
        }
        if ($leave_normal_flag == 1)
            array_push($sub_keys_leave_inconv, $type);

        return $sub_keys_leave_head;
    }

    //for genarating headings of normal type
    public function generate_headings($rpt_content, $key) {

        $type = $this->get_key_type($key);
        $sub_keys = array();
        $this->days_in_month = array_merge($this->days_in_month, array_keys($rpt_content));
        $normal_flag = 0;
        foreach (array_keys($rpt_content) as $main_keys) {
            foreach (array_keys($rpt_content[$main_keys]) as $sub) {
                if (in_array($sub, $sub_keys)) {
                    continue;
                } else {
                    if ($sub == $type)
                        $normal_flag = 1;
                    else
                        array_push($sub_keys, $sub);
                }
            }
        }
        if ($normal_flag == 1)
            array_push($sub_keys, $type);
        return $sub_keys;
    }
    
    // getting the type of slot
    public function get_key_type($key) {

        switch ($key) {
            case self::NORMAL:
                return 'Ord. tid';
                break;
            case self::TRAVEL:
                return 'travel';
                break;
            case self::BRK:
                return 'break';
                break;
            case self::ONCALL:
                return 'jour';
                break;
            case self::OVER:
                return 'overtime';
                break;
            case self::QUALITY:
                return 'qual_overtime';
                break;
            case self::MORE:
                return 'more_time';
                break;
            case self::SOME:
                return 'some_other_time';
                break;
            case self::TRAINING:
                return 'training';
                break;
            case self::CALLTRAINING:
                return 'call_training';
                break;
            case self::PERSONAL:
                return 'personal_meeting';
                break;
            case self::VOLUNTARY:
                return 'voluntary';
                break;
            case self::COMPLEMENTARY:
                return 'complementary';
                break;
            case self::COMPLEMENTARY_ONCALL:
                return 'complementary_oncall';
                break;
            case self::MORE_ONCALL:
                return 'more_oncall';
                
            case self::STANDBY:
                return 'standby';

            case self::DISMISSAL:
                return 'dismissal';        

            case self::DISMISSAL_ONCALL:
                return 'dismissal_oncall';        
        }
    }

    public function generate_fkkn_separation($date, $duration, $type, $fkkn){
        $equipment = new equipment();
        $fkkn_slot_types = array(0,1,2,4,5,6,7,12,3,13,14);
        if(in_array($type, $fkkn_slot_types)){
            $this->fkkn_slots[$date][$fkkn] += $duration;
        }
    }

    //categorize the slots under different labels
    public function get_processed_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, &$rpt_content, $inconv_timings, $key, $inconv_mod = 1) {

        $flag = 0;
        $flag_holiday = 0;
        
        if($inconv_mod == 2){
            $inconv_counter = 0;
            $inconv_weekend = $this->get_weekend_inconvenient_group_id();
            foreach ($inconv_timings as $inconv_normal){
                if(!in_array($inconv_normal['group_id'], $inconv_weekend)){
                    unset($inconv_timings[$inconv_counter]);
                }
                $inconv_counter ++;
            }
        }
        
        //checking whether it is a holiday

        $employee = new employee();
        $equipment = new equipment();
        $time_duration = 0;

        foreach ($this->holidays as $holiday) {
            
            
            if ($slot_time_from < $holiday['start'] && $slot_time_to > $holiday['end']) {
                
                $rpt_content[$inconv_normal_slot['date']][$holiday['name']] += $time_duration = round(($holiday['end'] - $holiday['start']) / (60 * 60), 2);
                array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H-i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H-i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                unset($this->inconv_normal_slots[$key]);

                $flag = 1;

                break;
            } else if ($slot_time_from >= $holiday['start'] && $slot_time_from < $holiday['end'] && $slot_time_to >= $holiday['end']) {
                
                $rpt_content[$inconv_normal_slot['date']][$holiday['name']] += $time_duration = round(($holiday['end'] - $slot_time_from) / (60 * 60), 2);
                if ($slot_time_to > $holiday['end']) {
                    array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H.i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                }
                unset($this->inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from <= $holiday['start'] && $slot_time_to > $holiday['start'] && $slot_time_to <= $holiday['end']) {
                $rpt_content[$inconv_normal_slot['date']][$holiday['name']] += $time_duration = round(($slot_time_to - $holiday['start']) / (60 * 60), 2);
                if ($slot_time_from < $holiday['start']) {
                    array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H.i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                }
                unset($this->inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from > $holiday['start'] && $slot_time_to < $holiday['end']) {
                $rpt_content[$inconv_normal_slot['date']][$holiday['name']] +=  $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                unset($this->inconv_normal_slots[$key]);
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) {
            $this->generate_fkkn_separation($inconv_normal_slot['date'], $time_duration, $inconv_normal_slot['type'], $inconv_normal_slot['fkkn']);
            return 1;
        }
        
        //checking whether the slot is included in any inconvenients
        if($inconv_mod != 0){
            foreach ($inconv_timings as $inconv_normal) {
                if(strtotime($inconv_normal_slot['date']) >= strtotime($inconv_normal['effect_from']) && strtotime($inconv_normal_slot['date']) <= strtotime($inconv_normal['effect_to'])){
                $days = explode(',', $inconv_normal['days']);
                $inconv_time_from = mktime(intval($inconv_normal['time_from']), bcmod($inconv_normal['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $inconv_time_to = mktime(intval($inconv_normal['time_to']), bcmod($inconv_normal['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {

                    if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) { 

                        $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                        array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                        array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {

                        $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                        if ($slot_time_to > $inconv_time_to) {
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                        }
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;

                        break;
                    } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                        $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                        if ($slot_time_from < $inconv_time_from) {
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                        }
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                        $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    }
                }
                if ($flag == 1){
                    if($time_duration)
                        $this->generate_fkkn_separation($inconv_normal_slot['date'], $time_duration, $inconv_normal_slot['type'], $inconv_normal_slot['fkkn']);
                    return 1;
                    
                }

                // taking the inconvenient continuations under the same name
                $inconv_timings_cont = $employee->get_distinct_normal_inconvenient_details_by_month_and_year_cont($inconv_normal['id'], $inconv_normal['source']);

                // checking whether the slot is included in the coniuation of the inconvenient above
                foreach ($inconv_timings_cont as $inconv_normal_cont) {

                    $days = explode(',', $inconv_normal_cont['days']);

                    $inconv_time_from = mktime(intval($inconv_normal_cont['time_from']), bcmod($inconv_normal_cont['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                    $inconv_time_to = mktime(intval($inconv_normal_cont['time_to']), bcmod($inconv_normal_cont['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));

                    if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                        if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                            
                            $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                            if ($slot_time_to > $inconv_time_to) {
                                array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                            }
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                            if ($slot_time_from < $inconv_time_from) {
                                array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], 'fkkn' => $inconv_normal_slot['fkkn']));
                            }
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$inconv_normal['name']] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        }
                    }
                }
                if ($flag == 1) {
                    if($time_duration)
                        $this->generate_fkkn_separation($inconv_normal_slot['date'], $time_duration, $inconv_normal_slot['type'], $inconv_normal_slot['fkkn']);
                    return 1;
                }
            }
        }
        }
        if ($flag == 1){
            if($time_duration)
                $this->generate_fkkn_separation($inconv_normal_slot['date'], $time_duration, $inconv_normal_slot['type'], $inconv_normal_slot['fkkn']);
            return 1;
        }
        return 0;
    }

    public function get_processed_leave_slots($inconv_normal_slot, $slot_time_from, $slot_time_to, &$rpt_content, $inconv_timings, $leave_type, $key, $inconv_flag = 1, $flag_holiday = 1) {

        $flag = 0;
        //        $flag_holiday = 0;
        
        if($inconv_mod == 2){
            $inconv_counter = 0;
            $inconv_weekend = $this->get_weekend_inconvenient_group_id();
            foreach ($inconv_timings as $inconv_normal){
                if(!in_array($inconv_normal['group_id'], $inconv_weekend)){
                    unset($inconv_timings[$inconv_counter]);
                }
                $inconv_counter ++;
            }
        }
        
        //checking whether it is a holiday
        $employee = new employee();
        if($flag_holiday == 1){
            foreach ($this->holidays as $holiday) {


                if ($slot_time_from < $holiday['start'] && $slot_time_to > $holiday['end']) {
                    $rpt_content[$inconv_normal_slot['date']][$leave_type][$holiday['name']] += round(($holiday['end'] - $holiday['start']) / (60 * 60), 2);
                    array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H-i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H-i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    unset($this->inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from >= $holiday['start'] && $slot_time_from < $holiday['end'] && $slot_time_to >= $holiday['end']) {
                    $rpt_content[$inconv_normal_slot['date']][$leave_type][$holiday['name']] += round(($holiday['end'] - $slot_time_from) / (60 * 60), 2);
                    if ($slot_time_to > $holiday['end']) {
                        array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H.i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    }
                    unset($this->inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from <= $holiday['start'] && $slot_time_to > $holiday['start'] && $slot_time_to <= $holiday['end']) {
                    $rpt_content[$inconv_normal_slot['date']][$leave_type][$holiday['name']] += round(($slot_time_to - $holiday['start']) / (60 * 60), 2);
                    if ($slot_time_from < $holiday['start']) {
                        array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H.i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    }
                    unset($this->inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from > $holiday['start'] && $slot_time_to < $holiday['end']) {
                    $rpt_content[$inconv_normal_slot['date']][$leave_type][$holiday['name']] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                    unset($this->inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                }
            }
            if ($flag == 1) return 1;
        }

        //checkink whether the slot is included in any inconvenients
        if($inconv_flag != 0){
            foreach ($inconv_timings as $inconv_normal) {
                if(strtotime($inconv_normal_slot['date']) >= strtotime($inconv_normal['effect_from']) && strtotime($inconv_normal_slot['date']) <= strtotime($inconv_normal['effect_to'])){
                $days = explode(',', $inconv_normal['days']);

                $inconv_time_from = mktime(intval($inconv_normal['time_from']), bcmod($inconv_normal['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $inconv_time_to = mktime(intval($inconv_normal['time_to']), bcmod($inconv_normal['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {

                    if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                        $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                        array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {

                        $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                        if ($slot_time_to > $inconv_time_to) {
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        }
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;

                        break;
                    } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                        $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                        if ($slot_time_from < $inconv_time_from) {
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        }
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                        $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        unset($this->inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    }
                }
                if ($flag == 1) return 1;

                // taking the inconvenient continuations under the same name
                $inconv_timings_cont = $employee->get_distinct_normal_inconvenient_details_by_month_and_year_cont($inconv_normal['id'], $inconv_normal['source']);
                // checking whether the slot is included in the coniuation of the inconvenient above
                foreach ($inconv_timings_cont as $inconv_normal_cont) {

                    $days = explode(',', $inconv_normal_cont['days']);

                    $inconv_time_from = mktime(intval($inconv_normal_cont['time_from']), bcmod($inconv_normal_cont['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                    $inconv_time_to = mktime(intval($inconv_normal_cont['time_to']), bcmod($inconv_normal_cont['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));

                    if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                        if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                            array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                            if ($slot_time_to > $inconv_time_to) {
                                array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                            }
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                            if ($slot_time_from < $inconv_time_from) {
                                array_push($this->inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                            }
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                            $rpt_content[$inconv_normal_slot['date']][$leave_type][$inconv_normal['name']] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                            unset($this->inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        }
                    }
                }
                if ($flag == 1) return 1;
            }
        }
     }
        if ($flag == 1) return 1;
        return 0;
    }

    public function categorize_salary_hours() {
        /**
         * Author: Shamsu
         * for: categorize salary hours
         */
        
        //    echo  "<pre>Days in month: ".print_r($this->rpt_content_leave, 1)."</pre>";
        $equipment = new equipment();
        $this->salary_hours = array();
        if(!empty($this->days_in_month)){
            foreach ($this->days_in_month as $day) {
                if(!empty($this->sub_keys_normal)){
                    foreach ($this->sub_keys_normal as $entry) {
                        
                            if(!isset($this->salary_hours[$day][$entry][self::NORMAL]) || $this->salary_hours[$day][$entry][self::NORMAL] == '')
                                $this->salary_hours[$day][$entry][self::NORMAL] = 0;
                            if(isset($this->rpt_content_normal[$day][$entry]) && $this->rpt_content_normal[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_normal[$day][$entry]);
                                $this->salary_hours[$day][$entry][self::NORMAL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::NORMAL]);
                                //$this->salary_hours[$day][$entry] += $this->rpt_content_normal[$day][$entry];
                            }
                    }
                }
                if(!empty($this->sub_keys_travel)){
                    foreach ($this->sub_keys_travel as $entry) {
                            
                            if(!isset($this->salary_hours[$day][$entry][self::TRAVEL]) || $this->salary_hours[$day][$entry][self::TRAVEL] == '')
                                $this->salary_hours[$day][$entry][self::TRAVEL] = 0;
                            if(isset($this->rpt_content_travel[$day][$entry]) && $this->rpt_content_travel[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_travel[$day][$entry]);
                                $this->salary_hours[$day][$entry][self::TRAVEL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::TRAVEL]);
                                // $this->salary_hours[$day][$entry] += $this->rpt_content_normal[$day][$entry];
                            }
                    }
                }
                if(!empty($this->sub_keys_break)){
                    foreach ($this->sub_keys_break as $entry) {
                        
                            if(!isset($this->salary_hours[$day][$entry][self::BRK]) || $this->salary_hours[$day][$entry][self::BRK] == '')
                                $this->salary_hours[$day][$entry][self::BRK] = 0;
                            if(isset($this->rpt_content_break[$day][$entry]) && $this->rpt_content_break[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_break[$day][$entry]);
                                $this->salary_hours[$day][$entry][self::BRK] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::BRK]);
                                //$this->salary_hours[$day][$entry] += $this->rpt_content_normal[$day][$entry];
                            }
                    }
                }
                
                if(!empty($this->sub_keys_over)){
                    foreach ($this->sub_keys_over as $entry) {
                        
                        if(!isset($this->salary_hours[$day][$entry][self::OVER]) || $this->salary_hours[$day][$entry][self::OVER] == '')
                                $this->salary_hours[$day][$entry][self::OVER] = 0;
                        if(isset($this->rpt_content_over[$day][$entry]) && $this->rpt_content_over[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_over[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::OVER] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::OVER]);
                            //$this->salary_hours[$day][$entry] += $this->rpt_content_over[$day][$entry];
                        }
                    }
                }
                if(!empty($this->sub_keys_quality)){
                    foreach ($this->sub_keys_quality as $entry) {
                        
                        if(!isset($this->salary_hours[$day][$entry][self::QUALITY]) || $this->salary_hours[$day][$entry][self::QUALITY] == '')
                                $this->salary_hours[$day][$entry][self::QUALITY] = 0;
                        if(isset($this->rpt_content_quality[$day][$entry]) && $this->rpt_content_quality[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_quality[$day][$entry]);
                            $this->salary_hours[$day][$entry] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::QUALITY]);
                            //$this->salary_hours[$day][$entry] += $this->rpt_content_quality[$day][$entry];
                        }
                    }
                }
                if(!empty($this->sub_keys_more)){
                    foreach ($this->sub_keys_more as $entry) {
                        //$entry = $this->transliterateString($entry);   
                        if(!isset($this->salary_hours[$day][$entry][self::MORE]) || $this->salary_hours[$day][$entry][self::MORE] == '')
                            $this->salary_hours[$day][$entry][self::MORE] = 0;
                        if(isset($this->rpt_content_more[$day][$entry]) && $this->rpt_content_more[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_more[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::MORE] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::MORE]);
                            //$this->salary_hours[$day][$entry] += $this->rpt_content_more[$day][$entry];
                        }
                    }
                }
                if(!empty($this->sub_keys_some)){
                    foreach ($this->sub_keys_some as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::SOME]) || $this->salary_hours[$day][$entry][self::SOME] == '')
                            $this->salary_hours[$day][$entry][self::SOME] = 0;
                        if(isset($this->rpt_content_some[$day][$entry]) && $this->rpt_content_some[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_some[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::SOME] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::SOME]);
                        }
                    }
                }
                if(!empty($this->sub_keys_training)){
                    foreach ($this->sub_keys_training as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::TRAINING]) || $this->salary_hours[$day][$entry][self::TRAINING] == '')
                            $this->salary_hours[$day][$entry][self::TRAINING] = 0;
                        if(isset($this->rpt_content_training[$day][$entry]) && $this->rpt_content_training[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_training[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::TRAINING] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::TRAINING]);
                        }
                    }
                }
                if(!empty($this->sub_keys_personal)){
                    foreach ($this->sub_keys_personal as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::PERSONAL]) || $this->salary_hours[$day][$entry][self::PERSONAL] == '')
                            $this->salary_hours[$day][$entry][self::PERSONAL] = 0;
                        if(isset($this->rpt_content_personal[$day][$entry]) && $this->rpt_content_personal[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_personal[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::PERSONAL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::PERSONAL]);
                        }
                    }
                }
                if(!empty($this->sub_keys_voluntary)){
                    foreach ($this->sub_keys_voluntary as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::VOLUNTARY]) || $this->salary_hours[$day][$entry][self::VOLUNTARY] == '')
                            $this->salary_hours[$day][$entry][self::VOLUNTARY] = 0;
                        if(isset($this->rpt_content_voluntary[$day][$entry]) && $this->rpt_content_voluntary[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_voluntary[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::VOLUNTARY] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::VOLUNTARY]);
                        }
                    }
                }
                if(!empty($this->sub_keys_complementary)){
                    foreach ($this->sub_keys_complementary as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::COMPLEMENTARY]) || $this->salary_hours[$day][$entry][self::COMPLEMENTARY] == '')
                            $this->salary_hours[$day][$entry][self::COMPLEMENTARY] = 0;
                        if(isset($this->rpt_content_complementary[$day][$entry]) && $this->rpt_content_complementary[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_complementary[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::COMPLEMENTARY] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::COMPLEMENTARY]);
                        }
                    }
                }
                if(!empty($this->sub_keys_standby)){
                    foreach ($this->sub_keys_standby as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::STANDBY]) || $this->salary_hours[$day][$entry][self::STANDBY] == '')
                            $this->salary_hours[$day][$entry][self::STANDBY] = 0;
                        if(isset($this->rpt_content_standby[$day][$entry]) && $this->rpt_content_standby[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_standby[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::STANDBY] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::STANDBY]);
                        }
                    }
                }
                if(!empty($this->sub_keys_dismissal)){
                    foreach ($this->sub_keys_dismissal as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::DISMISSAL]) || $this->salary_hours[$day][$entry][self::DISMISSAL] == '')
                            $this->salary_hours[$day][$entry][self::DISMISSAL] = 0;
                        if(isset($this->rpt_content_dismissal[$day][$entry]) && $this->rpt_content_dismissal[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_dismissal[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::DISMISSAL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::DISMISSAL]);
                        }
                    }
                }
                
                if(!empty($this->sub_keys_oncall)){
                    foreach ($this->sub_keys_oncall as $entry) {
                        //echo $day . " // ".  $entry . " // ". self::ONCALL . "// ". $this->salary_hours[$day][$entry][self::ONCALL];
                        //echo $entry."<br>";
                        $entry = $this->transliterateString($entry);
                        //echo "/////".$entry."<br>";
                        if(!isset($this->salary_hours[$day][$entry][self::ONCALL]) || $this->salary_hours[$day][$entry][self::ONCALL] == ''){
                            // if($_SESSION['user_id'] =='dodo001'){
                            //     echo $day."--".$entry."<br>";
                            //     echo "<pre>".print_r($this->salary_hours,1)."</pre>";
                            // }
                            $this->salary_hours[$day][$entry][self::ONCALL] = '0';
                            // if($_SESSION['user_id'] =='dodo001'){
                            //     echo "After<pre>".print_r($this->salary_hours,1)."</pre>";
                            // }
                        }
                        if(isset($this->rpt_content_oncall[$day][$entry]) && $this->rpt_content_oncall[$day][$entry] != ''){
                            
                            $time_in_60= $equipment->time_user_format($this->rpt_content_oncall[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::ONCALL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::ONCALL]);
//                            $this->salary_hours[$day][$entry] += $this->rpt_content_oncall[$day][$entry];
                        }
                    }

                }
                if(!empty($this->sub_keys_calltraining)){
                    foreach ($this->sub_keys_calltraining as $entry) {
                        $entry = $this->transliterateString($entry);    
                        if(!isset($this->salary_hours[$day][$entry][self::CALLTRAINING]) || $this->salary_hours[$day][$entry][self::CALLTRAINING] == '')
                            $this->salary_hours[$day][$entry][self::CALLTRAINING] = 0;
                        if(isset($this->rpt_content_calltraining[$day][$entry]) && $this->rpt_content_calltraining[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_calltraining[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::CALLTRAINING] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::CALLTRAINING]);
//                            $this->salary_hours[$day][$entry] += $this->rpt_content_calltraining[$day][$entry];
                        }
                    }
                }
                if(!empty($this->sub_keys_complementary_oncall)){
                    foreach ($this->sub_keys_complementary_oncall as $entry) {
                        $entry = $this->transliterateString($entry);
                        if(!isset($this->salary_hours[$day][$entry][self::COMPLEMENTARY_ONCALL]) || $this->salary_hours[$day][$entry][self::COMPLEMENTARY_ONCALL] == '')
                            $this->salary_hours[$day][$entry][self::COMPLEMENTARY_ONCALL] = 0;
                        if(isset($this->rpt_content_complementary_oncall[$day][$entry]) && $this->rpt_content_complementary_oncall[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_complementary_oncall[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::COMPLEMENTARY_ONCALL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::COMPLEMENTARY_ONCALL]);
//                            $this->salary_hours[$day][$entry] += $this->rpt_content_personal[$day][$entry];
                        }
                    }
                }
                if(!empty($this->sub_keys_more_oncall)){

                    foreach ($this->sub_keys_more_oncall as $entry) {
                        //echo $day . " // ".  $entry . " // ". self::MORE_ONCALL . "// ". $this->salary_hours[$day][$entry][self::MORE_ONCALL];
                        //echo $entry."<br>";exit();
                        $entry = $this->transliterateString($entry);
                        //echo "/////".$entry."<br>";
                        if(!isset($this->salary_hours[$day][$entry][self::MORE_ONCALL]) || $this->salary_hours[$day][$entry][self::MORE_ONCALL] == '')
                            $this->salary_hours[$day][$entry][self::MORE_ONCALL] = 0;
                        if(isset($this->rpt_content_more_oncall[$day][$entry]) && $this->rpt_content_more_oncall[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_more_oncall[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::MORE_ONCALL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::MORE_ONCALL]);
                        }
                    }
                }
                if(!empty($this->sub_keys_dismissal_oncall)){
                    foreach ($this->sub_keys_dismissal_oncall as $entry) {
                        $entry = $this->transliterateString($entry);
                        if(!isset($this->salary_hours[$day][$entry][self::DISMISSAL_ONCALL]) || $this->salary_hours[$day][$entry][self::DISMISSAL_ONCALL] == '')
                            $this->salary_hours[$day][$entry][self::DISMISSAL_ONCALL] = 0;
                        if(isset($this->rpt_content_dismissal_oncall[$day][$entry]) && $this->rpt_content_dismissal_oncall[$day][$entry] != ''){
                            $time_in_60= $equipment->time_user_format($this->rpt_content_dismissal_oncall[$day][$entry]);
                            $this->salary_hours[$day][$entry][self::DISMISSAL_ONCALL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$entry][self::DISMISSAL_ONCALL]);
                        }
                    }
                }
                
                //echo "<pre>".$day.print_r($this->sub_keys_leave_normal_head, 1)."</pre>";
                if(!empty($this->sub_keys_leave_normal_head)){
                    foreach ($this->sub_keys_leave_normal_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave[$day][$type][$item]) && $this->rpt_content_leave[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_travel_head)){
                    foreach ($this->sub_keys_leave_travel_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_travel[$day][$type][$item]) && $this->rpt_content_leave_travel[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_travel[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_break_head)){
                    foreach ($this->sub_keys_leave_break_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_break[$day][$type][$item]) && $this->rpt_content_leave_break[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_break[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_over_head)){
                    foreach ($this->sub_keys_leave_over_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_over[$day][$type][$item]) && $this->rpt_content_leave_over[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_over[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_over[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_quality_head)){
                    foreach ($this->sub_keys_leave_quality_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_quality[$day][$type][$item]) && $this->rpt_content_leave_quality[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_quality[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_quality[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_more_head)){
                    foreach ($this->sub_keys_leave_more_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_more[$day][$type][$item]) && $this->rpt_content_leave_more[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_more[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_more[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_some_head)){
                    foreach ($this->sub_keys_leave_some_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_some[$day][$type][$item]) && $this->rpt_content_leave_some[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_some[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_some[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_training_head)){
                    foreach ($this->sub_keys_leave_training_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][self::TRAINING]) || $this->salary_hours[$day][$item][self::TRAINING] == '')
                                    $this->salary_hours[$day][$item][self::TRAINING] = 0;
                                if(isset($this->rpt_content_leave_training[$day][$type][$item]) && $this->rpt_content_leave_training[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_training[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][self::TRAINING] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][self::TRAINING]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_training[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_personal_head)){
                    foreach ($this->sub_keys_leave_personal_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_personal[$day][$type][$item]) && $this->rpt_content_leave_personal[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_personal[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_personal[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_voluntary_head)){
                    foreach ($this->sub_keys_leave_voluntary_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_voluntary[$day][$type][$item]) && $this->rpt_content_leave_voluntary[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_voluntary[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_personal[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_standby_head)){
                    foreach ($this->sub_keys_leave_standby_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][0]) || $this->salary_hours[$day][$item][0] == '')
                                    $this->salary_hours[$day][$item][0] = 0;
                                if(isset($this->rpt_content_leave_standby[$day][$type][$item]) && $this->rpt_content_leave_standby[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_standby[$day][$type][$item]);
                                    $this->salary_hours[$day][$item][0] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][0]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_personal[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                
                if(!empty($this->sub_keys_leave_oncall_head)){
//                    echo "sub_keys_leave_oncall_head <pre>".print_r($this->sub_keys_leave_oncall_head, 1)."</pre>";
//                    echo "rpt_content_leave_oncall <pre>".print_r($this->rpt_content_leave_oncall, 1)."</pre>";
                    foreach ($this->sub_keys_leave_oncall_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][self::ONCALL]) || $this->salary_hours[$day][$item][self::ONCALL] == ''){
                                    //echo $day."-".$item."-".self::ONCALL."<br>";
                                    $this->salary_hours[$day][$item][self::ONCALL] = 0;
                                }
//                                echo "Temp sal: <pre>S///".print_r($this->salary_hours, 1)."</pre>";
//                                echo "[$day][$type][$item]";
//                                echo 'val: '.$this->rpt_content_leave_oncall[$day][$type][$item];
                                if(isset($this->rpt_content_leave_oncall[$day][$type][$item]) && $this->rpt_content_leave_oncall[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_oncall[$day][$type][$item]);
//                                    echo "[$time_in_60]--".$this->salary_hours[$day][$item][self::ONCALL];
                                    if(is_array($this->salary_hours[$day][$item]))
                                        $this->salary_hours[$day][$item][self::ONCALL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][self::ONCALL]);
                                    else
                                        $this->salary_hours[$day][$item] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_oncall[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_calltraining_head)){
                    foreach ($this->sub_keys_leave_calltraining_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][self::CALLTRAINING]) || $this->salary_hours[$day][$item][self::CALLTRAINING] == '')
                                    $this->salary_hours[$day][$item][self::CALLTRAINING] = 0;
                                if(isset($this->rpt_content_leave_calltraining[$day][$type][$item]) && $this->rpt_content_leave_calltraining[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_calltraining[$day][$type][$item]);
                                    if(is_array($this->salary_hours[$day][$item]))
                                        $this->salary_hours[$day][$item][self::CALLTRAINING] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][self::CALLTRAINING]);
                                    else
                                        $this->salary_hours[$day][$item] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item]);
//                                    $this->salary_hours[$day][$item] += $this->rpt_content_leave_calltraining[$day][$type][$item];
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_more_oncall_head)){
                    foreach ($this->sub_keys_leave_more_oncall_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!isset($this->salary_hours[$day][$item][self::MORE_ONCALL]) || $this->salary_hours[$day][$item][self::MORE_ONCALL] == '')
                                    $this->salary_hours[$day][$item][self::MORE_ONCALL] = 0;
                                if(isset($this->rpt_content_leave_more_oncall[$day][$type][$item]) && $this->rpt_content_leave_more_oncall[$day][$type][$item] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_leave_more_oncall[$day][$type][$item]);
                                    if(is_array($this->salary_hours[$day][$item]))
                                        $this->salary_hours[$day][$item][self::MORE_ONCALL] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item][self::MORE_ONCALL]);
                                    else
                                        $this->salary_hours[$day][$item] = $equipment->time_sum($time_in_60,$this->salary_hours[$day][$item]);
                                }
                            }
                        }
                    }
                }
//                echo "<pre>S+++".print_r($this->salary_hours, 1)."</pre>";
            }
        }
        
    }

    public function transliterateString($txt) {
        return $txt;
        $transliterationTable = array('å' => 'a', 'Å' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'ö' => 'oe', 'Ö' => 'OE', ':' => '', ' ' => '');
        return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
    }
    
    public function get_addition_salary_hours($employee, $merge_normal_oncall_hours = TRUE) {
        /**
         * Author: Shamsu
         * for: get additional salary hours 
         * extract holiday & timings from these 12 rpt arrays
         */
        
        $equipment = new equipment();
        $additional_array = array();
//        echo "===================<pre>1".print_r($this->rpt_content_quality, 1)."</pre>";
//        echo "<pre>2".print_r($this->rpt_content_more, 1)."</pre>";
//        echo "<pre>3".print_r($this->rpt_content_some, 1)."</pre>";
//        echo "<pre>4".print_r($this->rpt_content_training, 1)."</pre>";
//        echo "<pre>5".print_r($this->rpt_content_personal, 1)."</pre>";
//        echo "<pre>6".print_r($this->rpt_content_oncall, 1)."</pre>";
//        echo "<pre>7".print_r($this->rpt_content_calltraining, 1)."</pre>";
//        echo "<pre>8".print_r($this->rpt_content_leave, 1)."</pre>";
//        echo "<pre>9".print_r($this->rpt_content_leave_over, 1)."</pre>";
//        echo "<pre>10".print_r($this->rpt_content_leave_quality, 1)."</pre>";
//        echo "<pre>11".print_r($this->rpt_content_leave_more, 1)."</pre>";
//        echo "<pre>12".print_r($this->rpt_content_leave_some, 1)."</pre>";
//        echo "<pre>13".print_r($this->rpt_content_leave_training, 1)."</pre>";
//        echo "<pre>14".print_r($this->rpt_content_leave_personal, 1)."</pre>";
//        echo "<pre>15".print_r($this->rpt_content_leave_oncall, 1)."</pre>";
//        echo "<pre>16".print_r($this->rpt_content_leave_calltraining, 1)."</pre>============================";
//        $normal_keys = array('normal', 'overtime', 'quality_overtime', 'more_time', 'some_other_time', 'training_time', 'personal_meeting');
//        $oncall_keys = array('oncall', 'call_training');
        $normal_keys = array('Ord. tid', 'travel', 'break', 'overtime', 'qual_overtime', 'more_time', 'some_other_time', 'training', 'personal_meeting', 'voluntary', 'complementary', 'standby', 'dismissal');
        $oncall_keys = array('jour', 'call_training', 'complementary_oncall', 'more_oncall', 'dismissal_oncall');
        if(!empty($this->days_in_month)){
            foreach ($this->days_in_month as $day) {
                if(!empty($this->sub_keys_normal)){
                    foreach ($this->sub_keys_normal as $entry) {
                            if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_normal[$day][$entry] != ''){
                                if(!isset($additional_array[$day]['Ord. tid']) || $additional_array[$day]['Ord. tid'] == '')
                                    $additional_array[$day]['Ord. tid'] = 0;
                                if(isset($this->rpt_content_normal[$day][$entry]) && $this->rpt_content_normal[$day][$entry] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_normal[$day][$entry]);
                                    $additional_array[$day]['Ord. tid'] = $equipment->time_sum($time_in_60,$additional_array[$day]['Ord. tid']);
                                }
                            }
                    }
                }
                if(!empty($this->sub_keys_travel)){
                    foreach ($this->sub_keys_travel as $entry) {
                            if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_travel[$day][$entry] != ''){
                                if(!isset($additional_array[$day]['travel']) || $additional_array[$day]['travel'] == '')
                                    $additional_array[$day]['travel'] = 0;
                                if(isset($this->rpt_content_travel[$day][$entry]) && $this->rpt_content_travel[$day][$entry] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_travel[$day][$entry]);
                                    $additional_array[$day]['travel'] = $equipment->time_sum($time_in_60,$additional_array[$day]['travel']);
                                }
                            }
                    }
                }
                if(!empty($this->sub_keys_break)){
                    foreach ($this->sub_keys_break as $entry) {
                            if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_break[$day][$entry] != ''){
                                if(!isset($additional_array[$day]['break']) || $additional_array[$day]['break'] == '')
                                    $additional_array[$day]['break'] = 0;
                                if(isset($this->rpt_content_break[$day][$entry]) && $this->rpt_content_break[$day][$entry] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_break[$day][$entry]);
                                    $additional_array[$day]['break'] = $equipment->time_sum($time_in_60,$additional_array[$day]['break']);
                                }
                            }
                    }
                }
                if(!empty($this->sub_keys_over)){
                    foreach ($this->sub_keys_over as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_over[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['overtime']) || $additional_array[$day]['overtime'] == '')
                                    $additional_array[$day]['overtime'] = 0;
                            if(isset($this->rpt_content_over[$day][$entry]) && $this->rpt_content_over[$day][$entry] != ''){
                                    $time_in_60= $equipment->time_user_format($this->rpt_content_over[$day][$entry]);
                                    $additional_array[$day]['overtime'] = $equipment->time_sum($time_in_60,$additional_array[$day]['overtime']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_quality)){
                    foreach ($this->sub_keys_quality as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_quality[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['qual_overtime']) || $additional_array[$day]['qual_overtime'] == '')
                                    $additional_array[$day]['qual_overtime'] = 0;
                            if(isset($this->rpt_content_quality[$day][$entry]) && $this->rpt_content_quality[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_quality[$day][$entry]);
                                $additional_array[$day]['qual_overtime'] = $equipment->time_sum($time_in_60,$additional_array[$day]['qual_overtime']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_more)){
                    foreach ($this->sub_keys_more as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_more[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['more_time']) || $additional_array[$day]['more_time'] == '')
                                $additional_array[$day]['more_time'] = 0;
                            if(isset($this->rpt_content_more[$day][$entry]) && $this->rpt_content_more[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_more[$day][$entry]);
                                $additional_array[$day]['more_time'] = $equipment->time_sum($time_in_60,$additional_array[$day]['more_time']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_some)){
                    foreach ($this->sub_keys_some as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_some[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['some_other_time']) || $additional_array[$day]['some_other_time'] == '')
                                $additional_array[$day]['some_other_time'] = 0;
                            if(isset($this->rpt_content_some[$day][$entry]) && $this->rpt_content_some[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_some[$day][$entry]);
                                $additional_array[$day]['some_other_time'] = $equipment->time_sum($time_in_60,$additional_array[$day]['some_other_time']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_training)){
                    foreach ($this->sub_keys_training as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_training[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['training']) || $additional_array[$day]['training'] == '')
                                $additional_array[$day]['training'] = 0;
                            if(isset($this->rpt_content_training[$day][$entry]) && $this->rpt_content_training[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_training[$day][$entry]);
                                $additional_array[$day]['training'] = $equipment->time_sum($time_in_60,$additional_array[$day]['training']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_personal)){
                    foreach ($this->sub_keys_personal as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_personal[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['personal_meeting']) || $additional_array[$day]['personal_meeting'] == '')
                                $additional_array[$day]['personal_meeting'] = 0;
                            if(isset($this->rpt_content_personal[$day][$entry]) && $this->rpt_content_personal[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_personal[$day][$entry]);
                                $additional_array[$day]['personal_meeting'] = $equipment->time_sum($time_in_60,$additional_array[$day]['personal_meeting']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_voluntary)){
                    foreach ($this->sub_keys_voluntary as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_voluntary[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['voluntary']) || $additional_array[$day]['voluntary'] == '')
                                $additional_array[$day]['voluntary'] = 0;
                            if(isset($this->rpt_content_voluntary[$day][$entry]) && $this->rpt_content_voluntary[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_voluntary[$day][$entry]);
                                $additional_array[$day]['voluntary'] = $equipment->time_sum($time_in_60,$additional_array[$day]['voluntary']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_complementary)){
                    foreach ($this->sub_keys_complementary as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_complementary[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['complementary']) || $additional_array[$day]['complementary'] == '')
                                $additional_array[$day]['complementary'] = 0;
                            if(isset($this->rpt_content_complementary[$day][$entry]) && $this->rpt_content_complementary[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_complementary[$day][$entry]);
                                $additional_array[$day]['complementary'] = $equipment->time_sum($time_in_60,$additional_array[$day]['complementary']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_standby)){
                    foreach ($this->sub_keys_standby as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys) && $this->rpt_content_standby[$day][$entry] != ''){
                            if(!isset($additional_array[$day]['standby']) || $additional_array[$day]['standby'] == '')
                                $additional_array[$day]['standby'] = 0;
                            if(isset($this->rpt_content_standby[$day][$entry]) && $this->rpt_content_standby[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_standby[$day][$entry]);
                                $additional_array[$day]['standby'] = $equipment->time_sum($time_in_60,$additional_array[$day]['standby']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_dismissal)){
                    foreach ($this->sub_keys_dismissal as $entry) {
                        if(!in_array($entry, $normal_keys) && !in_array($entry, $oncall_keys)){
                            if(!isset($additional_array[$day]['dismissal']) || $additional_array[$day]['dismissal'] == '')
                                $additional_array[$day]['dismissal'] = 0;
                            if(isset($this->rpt_content_dismissal[$day][$entry]) && $this->rpt_content_dismissal[$day][$entry] != ''){
                                $time_in_60= $equipment->time_user_format($this->rpt_content_dismissal[$day][$entry]);
                                $additional_array[$day]['dismissal'] = $equipment->time_sum($time_in_60,$additional_array[$day]['dismissal']);
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_normal_head)){
                    foreach ($this->sub_keys_leave_normal_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['Ord. tid']) || $additional_array[$day]['Ord. tid'] == '')
                                        $additional_array[$day]['Ord. tid'] = 0;
                                    if(isset($this->rpt_content_leave[$day][$type][$item]) && $this->rpt_content_leave[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave[$day][$type][$item]);
                                        $additional_array[$day]['Ord. tid'] = $equipment->time_sum($time_in_60,$additional_array[$day]['Ord. tid']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_travel_head)){
                    foreach ($this->sub_keys_leave_travel_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_travel[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['travel']) || $additional_array[$day]['travel'] == '')
                                        $additional_array[$day]['travel'] = 0;
                                    if(isset($this->rpt_content_leave_travel[$day][$type][$item]) && $this->rpt_content_leave_travel[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_travel[$day][$type][$item]);
                                        $additional_array[$day]['travel'] = $equipment->time_sum($time_in_60,$additional_array[$day]['travel']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_break_head)){
                    foreach ($this->sub_keys_leave_break_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_break[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['break']) || $additional_array[$day]['break'] == '')
                                        $additional_array[$day]['break'] = 0;
                                    if(isset($this->rpt_content_leave_break[$day][$type][$item]) && $this->rpt_content_leave_break[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_break[$day][$type][$item]);
                                        $additional_array[$day]['break'] = $equipment->time_sum($time_in_60,$additional_array[$day]['break']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_over_head)){
                    foreach ($this->sub_keys_leave_over_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_over[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['overtime']) || $additional_array[$day]['overtime'] == '')
                                        $additional_array[$day]['overtime'] = 0;
                                    if(isset($this->rpt_content_leave_over[$day][$type][$item]) && $this->rpt_content_leave_over[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_over[$day][$type][$item]);
                                        $additional_array[$day]['overtime'] = $equipment->time_sum($time_in_60,$additional_array[$day]['overtime']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_quality_head)){
                    foreach ($this->sub_keys_leave_quality_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_quality[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['qual_overtime']) || $additional_array[$day]['qual_overtime'] == '')
                                        $additional_array[$day]['qual_overtime'] = 0;
                                    if(isset($this->rpt_content_leave_quality[$day][$type][$item]) && $this->rpt_content_leave_quality[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_quality[$day][$type][$item]);
                                        $additional_array[$day]['qual_overtime'] = $equipment->time_sum($time_in_60,$additional_array[$day]['qual_overtime']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_more_head)){
                    foreach ($this->sub_keys_leave_more_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_more[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['more_time']) || $additional_array[$day]['more_time'] == '')
                                        $additional_array[$day]['more_time'] = 0;
                                    if(isset($this->rpt_content_leave_more[$day][$type][$item]) && $this->rpt_content_leave_more[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_more[$day][$type][$item]);
                                        $additional_array[$day]['more_time'] = $equipment->time_sum($time_in_60,$additional_array[$day]['more_time']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_some_head)){
                    foreach ($this->sub_keys_leave_some_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_some[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['some_other_time']) || $additional_array[$day]['some_other_time'] == '')
                                        $additional_array[$day]['some_other_time'] = 0;
                                    if(isset($this->rpt_content_leave_some[$day][$type][$item]) && $this->rpt_content_leave_some[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_some[$day][$type][$item]);
                                        $additional_array[$day]['some_other_time'] = $equipment->time_sum($time_in_60,$additional_array[$day]['some_other_time']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_training_head)){
                    foreach ($this->sub_keys_leave_training_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_training[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['training']) || $additional_array[$day]['training'] == '')
                                        $additional_array[$day]['training'] = 0;
                                    if(isset($this->rpt_content_leave_training[$day][$type][$item]) && $this->rpt_content_leave_training[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_training[$day][$type][$item]);
                                        $additional_array[$day]['training'] = $equipment->time_sum($time_in_60,$additional_array[$day]['training']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_personal_head)){
                    foreach ($this->sub_keys_leave_personal_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_personal[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['personal_meeting']) || $additional_array[$day]['personal_meeting'] == '')
                                        $additional_array[$day]['personal_meeting'] = 0;
                                    if(isset($this->rpt_content_leave_personal[$day][$type][$item]) && $this->rpt_content_leave_personal[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_personal[$day][$type][$item]);
                                        $additional_array[$day]['personal_meeting'] = $equipment->time_sum($time_in_60,$additional_array[$day]['personal_meeting']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_voluntary_head)){
                    foreach ($this->sub_keys_leave_voluntary_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_voluntary[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['voluntary']) || $additional_array[$day]['voluntary'] == '')
                                        $additional_array[$day]['voluntary'] = 0;
                                    if(isset($this->rpt_content_leave_voluntary[$day][$type][$item]) && $this->rpt_content_leave_voluntary[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_voluntary[$day][$type][$item]);
                                        $additional_array[$day]['voluntary'] = $equipment->time_sum($time_in_60,$additional_array[$day]['voluntary']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_standby_head)){
                    foreach ($this->sub_keys_leave_standby_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_standby[$day][$type][$item] != ''){
                                    if(!isset($additional_array[$day]['standby']) || $additional_array[$day]['standby'] == '')
                                        $additional_array[$day]['standby'] = 0;
                                    if(isset($this->rpt_content_leave_standby[$day][$type][$item]) && $this->rpt_content_leave_standby[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_standby[$day][$type][$item]);
                                        $additional_array[$day]['standby'] = $equipment->time_sum($time_in_60,$additional_array[$day]['standby']);
                                    }
                                }
                            }
                        }
                    }
                }
                /*if(!empty($this->sub_keys_leave_oncall_head)){
                    foreach ($this->sub_keys_leave_oncall_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys)){
                                    if(!isset($additional_array[$day]['oncall']) || $additional_array[$day]['oncall'] == '')
                                        $additional_array[$day]['oncall'] = 0;
                                    if(isset($this->rpt_content_leave_oncall[$day][$type][$item]) && $this->rpt_content_leave_oncall[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_oncall[$day][$type][$item]);
                                        $additional_array[$day]['oncall'] = $equipment->time_sum($time_in_60,$additional_array[$day]['oncall']);
                                    }
                                }
                            }
                        }
                    }
                }
                if(!empty($this->sub_keys_leave_calltraining_head)){
                    foreach ($this->sub_keys_leave_calltraining_head as $entry) {
                        if(!empty($entry)){
                            foreach ($entry as $type => $item) {
                                if(!in_array($item, $normal_keys) && !in_array($item, $oncall_keys) && $this->rpt_content_leave_calltraining[$day][$type][$item] != 0.00){
                                    if(!isset($additional_array[$day]['call_training']) || $additional_array[$day]['call_training'] == '')
                                        $additional_array[$day]['call_training'] = 0;
                                    if(isset($this->rpt_content_leave_calltraining[$day][$type][$item]) && $this->rpt_content_leave_calltraining[$day][$type][$item] != ''){
                                        $time_in_60= $equipment->time_user_format($this->rpt_content_leave_calltraining[$day][$type][$item]);
                                        $additional_array[$day]['call_training'] = $equipment->time_sum($time_in_60,$additional_array[$day]['call_training']);
                                    }
                                }
                            }
                        }
                    }
                }*/
            }
        }
//        echo "<pre>additional_array: ".print_r($additional_array, 1)."</pre>";
        $salary_attached_array = array();
        if(!empty($additional_array)){
            if($merge_normal_oncall_hours){
//                $salary_attached_array['normal_0'] = array();
//                $salary_attached_array['normal_3'] = array();
                //db key fields
                $oncall_keys = array('oncall', 'call_training', 'complementary_oncall', 'more_oncall', 'dismissal_oncall');
                $normal_keys = array('normal', 'travel', 'break', 'overtime', 'quality_overtime', 'more_time', 'some_other_time', 'training_time', 'personal_meeting', 'voluntary', 'standby', 'dismissal');
            }
            foreach ($additional_array as $day => $entries){
                foreach ($entries as $item => $value) {
                    $db_key = $this->get_db_key_field($item);
                    if($merge_normal_oncall_hours){
                        if(in_array($db_key, $normal_keys)){    //check is normal type
                            $salary = $this->get_salary($day, $employee, 'normal');
                            if(isset($salary_attached_array['normal_0'][$salary])){
                                $calculated_hour = $equipment->time_sum($salary_attached_array['normal_0'][$salary]['hour'], $value);
                                $salary_attached_array['normal_0'][$salary] = array('hour' => $calculated_hour);
                            }else
                                $salary_attached_array['normal_0'][$salary] = array('hour' => $value);
                        }else if(in_array($db_key, $oncall_keys)){  //check is oncall type
                            $salary = $this->get_salary($day, $employee, 'oncall');
                            if(isset($salary_attached_array['normal_0'][$salary])){
                                $calculated_hour = $equipment->time_sum($salary_attached_array['normal_3'][$salary]['hour'], $value);
                                $salary_attached_array['normal_3'][$salary] = array('hour' => $calculated_hour);
                            }else
                                $salary_attached_array['normal_3'][$salary] = array('hour' => $value);
                        }
                    }else{
                        if($db_key != ''){       // Other hours
                            $salary = $this->get_salary($day, $employee, $db_key);
                            if(isset($salary_attached_array[$item][$salary])){
                                $calculated_hour = $equipment->time_sum($value, $salary_attached_array[$item][$salary]['hour']);
                                $salary_attached_array[$item][$salary] = array('hour' => $calculated_hour);
                            }else{
                                $salary_attached_array[$item][$salary] = array('hour' => $value);
                            }
                        }
                    }
                }
            }

        }
//        echo "<pre>Salary attached".print_r($salary_attached_array, 1)."</pre>";
        return $salary_attached_array;
        
    }

    public function calculate_total_salary($employee) {
        /**
         * Author: Shamsu
         * for: calculate total salary
         */
//        echo "<pre>Salary Hours: ".print_r($this->salary_hours, 1)."</pre>";
        $salary_sum = 0;
        if(!empty($this->salary_hours)){
            foreach ($this->salary_hours as $day => $entries) {
                foreach ($entries as $item => $value) {
                    
                    if(is_array($value)){   
                        // this block only for getting different types of oncall inconvenient salary
                        foreach ($value as $sub_item => $sub_value) {
                            if($sub_value != ''){
                                $is_calculated = FALSE;

                                if(!empty($this->holidays)){    //check is in holiday
                                    foreach ($this->holidays as $holiday) {
                                        if($item == $holiday['name'] && !empty($holiday['timings'])){
                                                foreach ($holiday['timings'] as $timing) {  //check red/ big day
                                                    if($day == $timing['date']){
                                                        $salary = 0;
                                                        $is_calculated = TRUE;
                                                        if($timing['bigred'] == 1)         //1-Red day
                                                            $salary = $this->get_salary($day, $employee, 'holiday_red');
                                                        else if($timing['bigred'] == 2)   //2-Big day
                                                            $salary = $this->get_salary($day, $employee, 'holiday_big');
                                                        $salary_sum += $salary * $sub_value;
                                                        break;
                                                    }
                                                }
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_normal_category)){    //check is in holiday
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_normal_category as $normal_inconv) {
        //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                        if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                
                                                $this_normal_inconv_amount = $normal_inconv['amount'];
                                                $this_normal_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::TRAINING: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_call_training']; 
                                                        $this_normal_slot_name = $item.' Intro'; //väntetid
                                                        break;
                                                    case self::COMPLEMENTARY: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_complementary_oncall']; 
                                                        $this_normal_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::DISMISSAL: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_dismissal_oncall']; 
                                                        $this_normal_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $this_normal_inconv_amount, $sub_item);
                                                $salary_sum += $salary * $sub_value;
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }       //check in normal inconvenients

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                        if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_oncall_inconv_amount = $oncall_inconv['amount'];
                                                $this_oncall_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['amount']; 
                                                        $this_oncall_slot_name = $item;//.' Jour';
                                                        break;
                                                    case self::CALLTRAINING: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_call_training']; 
                                                        $this_oncall_slot_name = $item.' Intro'; //väntetid
                                                        break;
                                                    case self::COMPLEMENTARY_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_complementary_oncall']; 
                                                        $this_oncall_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::MORE_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_more_oncall']; 
                                                        $this_oncall_slot_name = $item.' Timtid';
                                                        break;
                                                    case self::DISMISSAL_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_dismissal_oncall']; 
                                                        $this_oncall_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $this_oncall_inconv_amount, $sub_item);
                                                $salary_sum += $salary * $sub_value;
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }       //check in inconvenients

                                if($is_calculated)  continue;

                                $db_key = $this->get_db_key_field($item);
                                if($this->get_db_key_field($db_key) != ''){       // Other hours
                                        $is_calculated = TRUE;
                                        $salary = $this->get_salary($day, $employee, $db_key);
                                        $salary_sum += $salary * $sub_value;
                                }

                            }
                        }
                    }
                    else{
                        if($value != ''){
                            $is_calculated = FALSE;

                            if(!empty($this->holidays)){    //check is in holiday
                                foreach ($this->holidays as $holiday) {
                                    if($item == $holiday['name'] && !empty($holiday['timings'])){
                                            foreach ($holiday['timings'] as $timing) {  //check red/ big day
                                                if($day == $timing['date']){
                                                    $salary = 0;
                                                    $is_calculated = TRUE;
                                                    if($timing['bigred'] == 1)         //1-Red day
                                                        $salary = $this->get_salary($day, $employee, 'holiday_red');
                                                    else if($timing['bigred'] == 2)   //2-Big day
                                                        $salary = $this->get_salary($day, $employee, 'holiday_big');
                                                    $salary_sum += $salary * $value;
                                                    break;
                                                }
                                            }
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_normal_category)){    //check is in holiday
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_normal_category as $normal_inconv) {
    //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                    if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $normal_inconv['amount']);
                                            $salary_sum += $salary * $value;
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }       //check in normal inconvenients

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                    if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $oncall_inconv['amount']);
                                            $salary_sum += $salary * $value;
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }       //check in inconvenients

                            if($is_calculated)  continue;

                            $db_key = $this->get_db_key_field($item);
                            if($this->get_db_key_field($db_key) != ''){       // Other hours
                                    $is_calculated = TRUE;
                                    $salary = $this->get_salary($day, $employee, $db_key);
                                    $salary_sum += $salary * $value;
                            }

                        }
                    }
                }
            }
        }
        return $salary_sum;
        
    }
    
    public function calculate_key_based_salary($employee) {
        /**
         * Author: Shamsu
         * for: calculate salary for each type category seperately (holiday, different inconvenients, different slot types)
         */
//        echo "<pre>Salary Hours: ".print_r($this->salary_hours, 1)."</pre>";
        $equipment = new equipment();
        $salary_array = array();
        if(!empty($this->salary_hours)){
            foreach ($this->salary_hours as $day => $entries) {
                foreach ($entries as $item => $value) {
                    
                    if(is_array($value)){   
                        // this block only for getting different types of oncall inconvenient salary
                        foreach ($value as $sub_item => $sub_value) {
                            
                            if($sub_value != ''){
                                $is_calculated = FALSE;

                                if(!empty($this->holidays)){    //check is in holiday
                                    foreach ($this->holidays as $holiday) {
                                        if($item == $holiday['name']){
                                                $salary = 0;
                                                $is_calculated = TRUE;
                                                if($holiday['type'] == 1)         //1-Normal Holiday
                                                    $salary = $this->get_salary($day, $employee, 'holiday_red');
                                                else if($holiday['type'] == 2)   //2-Big Holiday
                                                    $salary = $this->get_salary($day, $employee, 'holiday_big');

                                                $calculated_salary = $salary * $sub_value;
                                                if(isset($salary_array[$item])){
                                                    $calculated_salary += $salary_array[$item]['amount'];
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item]['hour']);
                                                    $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                                }else{
                                                    $salary_array[$item] = array('hour' => $sub_value, 'amount' => $calculated_salary);
                                                }
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_normal_category as $normal_inconv) {
        //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                        if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_normal_inconv_amount = $normal_inconv['amount'];
                                                $this_normal_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::TRAINING: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_call_training']; 
                                                        $this_normal_slot_name = $item.' Intro';
                                                        break;
                                                    case self::COMPLEMENTARY: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_complementary_oncall']; 
                                                        $this_normal_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::DISMISSAL: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_dismissal_oncall']; 
                                                        $this_normal_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $this_normal_inconv_amount, $sub_item);
                                                $calculated_salary = $salary * $sub_value;
                                                if(isset($salary_array[$this_normal_slot_name])){
                                                    $calculated_salary += $salary_array[$this_normal_slot_name]['amount'];
//                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item]['hour']);
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_normal_slot_name]['hour']);
                                                    $salary_array[$this_normal_slot_name] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                                }else{
                                                    $salary_array[$this_normal_slot_name] = array('hour' => $sub_value, 'amount' => $calculated_salary);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }       

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                        if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_oncall_inconv_amount = $oncall_inconv['amount'];
                                                $this_oncall_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['amount']; 
                                                        $this_oncall_slot_name = $item;//.' Jour';
                                                        break;
                                                    case self::CALLTRAINING: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_call_training']; 
                                                        $this_oncall_slot_name = $item.' Intro'; //Intro väntetid
                                                        break;
                                                    case self::COMPLEMENTARY_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_complementary_oncall']; 
                                                        $this_oncall_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::MORE_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_more_oncall']; 
                                                        $this_oncall_slot_name = $item.' Timtid';
                                                        break;
                                                    case self::DISMISSAL_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_dismissal_oncall']; 
                                                        $this_oncall_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $this_oncall_inconv_amount, $sub_item);
                                                $calculated_salary = $salary * $sub_value;
                                                if(isset($salary_array[$this_oncall_slot_name])){
                                                    $calculated_salary += $salary_array[$this_oncall_slot_name]['amount'];
//                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item]['hour']);
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_oncall_slot_name]['hour']);
                                                    $salary_array[$this_oncall_slot_name] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                                }else{
                                                    $salary_array[$this_oncall_slot_name] = array('hour' => $sub_value, 'amount' => $calculated_salary);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                $db_key = $this->get_db_key_field($item);
                                if($db_key != ''){       // Other hours
                                        $is_calculated = TRUE;
                                        $salary = $this->get_salary($day, $employee, $db_key);
                                        $calculated_salary = $salary * $sub_value;
                                        if(isset($salary_array[$item])){
                                            $calculated_salary += $salary_array[$item]['amount'];
                                            $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item]['hour']);
                                            $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                        }else{
                                            $salary_array[$item] = array('hour' => $sub_value, 'amount' => $calculated_salary);
                                        }
                                }

                            }
                        }
                        
                    }
                    else {
                        if($value != ''){
                            $is_calculated = FALSE;

                            if(!empty($this->holidays)){    //check is in holiday
                                foreach ($this->holidays as $holiday) {
                                    if($item == $holiday['name']){
                                            $salary = 0;
                                            $is_calculated = TRUE;
                                            if($holiday['type'] == 1)         //1-Normal Holiday
                                                $salary = $this->get_salary($day, $employee, 'holiday_red');
                                            else if($holiday['type'] == 2)   //2-Big Holiday
                                                $salary = $this->get_salary($day, $employee, 'holiday_big');

                                            $calculated_salary = $salary * $value;
                                            if(isset($salary_array[$item])){
                                                $calculated_salary += $salary_array[$item]['amount'];
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                                $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                            }else{
                                                $salary_array[$item] = array('hour' => $value, 'amount' => $calculated_salary);
                                            }
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_normal_category as $normal_inconv) {
    //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                    if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $normal_inconv['amount']);
                                            $calculated_salary = $salary * $value;
                                            if(isset($salary_array[$item])){
                                                $calculated_salary += $salary_array[$item]['amount'];
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                                $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                            }else{
                                                $salary_array[$item] = array('hour' => $value, 'amount' => $calculated_salary);
                                            }
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }       

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                    if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $oncall_inconv['amount']);
                                            $calculated_salary = $salary * $value;
                                            if(isset($salary_array[$item])){
                                                $calculated_salary += $salary_array[$item]['amount'];
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                                $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                            }else{
                                                $salary_array[$item] = array('hour' => $value, 'amount' => $calculated_salary);
                                            }
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;

                            $db_key = $this->get_db_key_field($item);
                            if($db_key != ''){       // Other hours
                                    $is_calculated = TRUE;
                                    $salary = $this->get_salary($day, $employee, $db_key);
                                    $calculated_salary = $salary * $value;
                                    if(isset($salary_array[$item])){
                                        $calculated_salary += $salary_array[$item]['amount'];
                                        $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                        $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                                    }else{
                                        $salary_array[$item] = array('hour' => $value, 'amount' => $calculated_salary);
                                    }
                            }

                        }
                    }
                }
            }
        }
        
        return $salary_array;
        
    }
    
    public function calculate_key_based_perhour_salary($employee, $merge_normal_oncall_hours = TRUE) {
        /**
         * Author: Shamsu
         * for: calculate salary for each type category seperately (holiday, different inconvenients, different slot types)
         * just a copy function of calculate_key_based_salary()
         * assign per-hour salary to 'amount' in resultant array, otherwise totals to be stored.
         */
//        echo "<pre>Salary Hours: ".print_r($this->salary_hours, 1)."</pre>";
        $equipment = new equipment();
        $salary_array = array();
        if(!empty($this->salary_hours)){
            if($merge_normal_oncall_hours){
                $salary_array['normal_0'] = array('hour' => 0, 'amount' => 0);
                $salary_array['normal_3'] = array('hour' => 0, 'amount' => 0);
                $oncall_keys = array('oncall', 'call_training', 'complementary_oncall', 'more_oncall', 'dismissal_oncall');
                $normal_keys = array('normal', 'travel', 'break', 'overtime', 'quality_overtime', 'more_time', 'some_other_time', 'training_time', 'personal_meeting', 'voluntary', 'complementary', 'standby', 'dismissal');
            }
            foreach ($this->salary_hours as $day => $entries) {
                foreach ($entries as $item => $value) {
                    
                    
                    if(is_array($value)){   
                        // this block only for getting different types of oncall inconvenient salary
                        foreach ($value as $sub_item => $sub_value) {
                            if($sub_value != '' && $sub_value != 0.00){
                                $is_calculated = FALSE;
                                $tmp_item_name = $item;

                                /*if(!empty($this->holidays)){    //check is in holiday
                                    foreach ($this->holidays as $holiday) {
                                        if($item == $holiday['name']){
                                                $salary = 0;
                                                $is_calculated = TRUE;
                                                if($holiday['type'] == 1)         //1-Normal Holiday
                                                    $salary = $this->get_salary($day, $employee, 'holiday_red');
                                                else if($holiday['type'] == 2)   //2-Big Holiday
                                                    $salary = $this->get_salary($day, $employee, 'holiday_big');

                                                if(isset($salary_array[$item])){
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item]['hour']);
                                                    $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $salary);
                                                }else{
                                                    $salary_array[$item] = array('hour' => $sub_value, 'amount' => $salary);
                                                }
                                        }
                                        if($is_calculated)  break;
                                    }
                                }*/
                                if(!empty($this->holidays)){    //check is in holiday
                                    foreach ($this->holidays as $holiday) {
                                        if($item == $holiday['name']){
                                                $salary = 0;
                                                $is_calculated = TRUE;
                                                if($holiday['type'] == 1){         //1-Normal Holiday
                                                    switch ($sub_item) {
                                                        case self::ONCALL: 
                                                        case self::CALLTRAINING: 
                                                        case self::COMPLEMENTARY_ONCALL: 
                                                        case self::MORE_ONCALL: 
                                                        case self::DISMISSAL_ONCALL: 
                                                            $salary = $this->get_salary($day, $employee, 'holiday_red_oncall');
                                                            $tmp_item_name = $item. ' Jour';
                                                            break;
                                                        default:
                                                            $salary = $this->get_salary($day, $employee, 'holiday_red');
                                                            break;
                                                            
                                                    }
                                                }else if($holiday['type'] == 2){   //2-Big Holiday
                                                    switch ($sub_item) {
                                                        case self::ONCALL: 
                                                        case self::CALLTRAINING: 
                                                        case self::COMPLEMENTARY_ONCALL: 
                                                        case self::MORE_ONCALL: 
                                                        case self::DISMISSAL_ONCALL: 
                                                            $salary = $this->get_salary($day, $employee, 'holiday_big_oncall');
                                                            $tmp_item_name = $item. ' Jour';
                                                            break;
                                                        default:
                                                            $salary = $this->get_salary($day, $employee, 'holiday_big');
                                                            break;
                                                    }
                                                }

                                                if(isset($salary_array[$tmp_item_name][$salary])){
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$tmp_item_name][$salary]['hour']);
//                                                    $salary_array[$tmp_item_name][$salary] = array('hour' => $calculated_hour);
                                                    $salary_array[$tmp_item_name] = array('hour' => $calculated_hour, 'amount' => $salary);
                                                }else{
//                                                    $salary_array[$tmp_item_name][$salary] = array('hour' => $sub_value);
                                                    $salary_array[$tmp_item_name] = array('hour' => $sub_value, 'amount' => $salary);
                                                }
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_normal_category as $normal_inconv) {
        //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                        if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_normal_inconv_amount = $normal_inconv['amount'];
                                                $this_normal_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::TRAINING: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_call_training']; 
                                                        $this_normal_slot_name = $item.' Intro';
                                                        break;
                                                    case self::COMPLEMENTARY: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_complementary_oncall']; 
                                                        $this_normal_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::DISMISSAL: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_dismissal_oncall']; 
                                                        $this_normal_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $this_normal_inconv_amount, $sub_item);
                                                if(isset($salary_array[$this_normal_slot_name])){
        //                                            $calculated_hour = $sub_value + $salary_array[$item]['hour'];
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_normal_slot_name]['hour']);
                                                    $salary_array[$this_normal_slot_name] = array('hour' => $calculated_hour, 'amount' => $salary);
                                                }else{
                                                    $salary_array[$this_normal_slot_name] = array('hour' => $sub_value, 'amount' => $salary);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }       

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                        if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_oncall_inconv_amount = $oncall_inconv['amount'];
                                                $this_oncall_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['amount']; 
                                                        $this_oncall_slot_name = $item;//.' Jour';
                                                        break;
                                                    case self::CALLTRAINING: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_call_training']; 
                                                        $this_oncall_slot_name = $item.' Intro';//Intro väntetid
                                                        break;
                                                    case self::COMPLEMENTARY_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_complementary_oncall']; 
                                                        $this_oncall_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::MORE_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_more_oncall']; 
                                                        $this_oncall_slot_name = $item.' Timtid';
                                                        break;
                                                    case self::DISMISSAL_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_dismissal_oncall']; 
                                                        $this_oncall_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $this_oncall_inconv_amount, $sub_item);
        //                                        echo "<pre>".print_r(array($day, $employee, $item, $oncall_inconv['group_id'], $oncall_inconv['amount']), 1)."</pre>";
        //                                        echo "<pre>".print_r($salary, 1)."</pre>";
                                                if(isset($salary_array[$this_oncall_slot_name])){
        //                                            $calculated_hour = $sub_value + $salary_array[$item]['hour'];
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_oncall_slot_name]['hour']);
                                                    $salary_array[$this_oncall_slot_name] = array('hour' => $calculated_hour, 'amount' => $salary);
                                                }else{
                                                    $salary_array[$this_oncall_slot_name] = array('hour' => $sub_value, 'amount' => $salary);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                $db_key = $this->get_db_key_field($item);
                                if($merge_normal_oncall_hours){
                                    if(in_array($db_key, $normal_keys)){    //check is normal type
                                        $salary = $this->get_salary($day, $employee, 'normal');
                                        $calculated_hour = $equipment->time_sum($salary_array['normal_0']['hour'], $sub_value);
                                        $salary_array['normal_0'] = array('hour' => $calculated_hour, 'amount' => $salary);
                                    }else if(in_array($db_key, $oncall_keys)){  //check is oncall type
                                        $salary = $this->get_salary($day, $employee, 'oncall');
                                        $calculated_hour = $equipment->time_sum($salary_array['normal_3']['hour'], $sub_value);
                                        $salary_array['normal_3'] = array('hour' => $calculated_hour, 'amount' => $salary);
                                    }
                                }else{
                                    if($db_key != ''){       // Other hours
                                        $salary = $this->get_salary($day, $employee, $db_key);
                                        if(isset($salary_array[$item])){
                                            $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item]['hour']);
                                            $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $salary);
                                        }else{
                                            $salary_array[$item] = array('hour' => $sub_value, 'amount' => $salary);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    else{
                        if($value != '' && $value != 0.00){
                            $is_calculated = FALSE;

                            if(!empty($this->holidays)){    //check is in holiday
                                foreach ($this->holidays as $holiday) {
                                    if($item == $holiday['name']){
                                            $salary = 0;
                                            $is_calculated = TRUE;
                                            if($holiday['type'] == 1)         //1-Normal Holiday
                                                $salary = $this->get_salary($day, $employee, 'holiday_red');
                                            else if($holiday['type'] == 2)   //2-Big Holiday
                                                $salary = $this->get_salary($day, $employee, 'holiday_big');

                                            if(isset($salary_array[$item])){
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                                $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $salary);
                                            }else{
                                                $salary_array[$item] = array('hour' => $value, 'amount' => $salary);
                                            }
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_normal_category as $normal_inconv) {
    //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                    if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $normal_inconv['amount']);
                                            if(isset($salary_array[$item])){
    //                                            $calculated_hour = $value + $salary_array[$item]['hour'];
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                                $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $salary);
                                            }else{
                                                $salary_array[$item] = array('hour' => $value, 'amount' => $salary);
                                            }
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }       

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                    if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $oncall_inconv['amount']);
    //                                        echo "<pre>".print_r(array($day, $employee, $item, $oncall_inconv['group_id'], $oncall_inconv['amount']), 1)."</pre>";
    //                                        echo "<pre>".print_r($salary, 1)."</pre>";
                                            if(isset($salary_array[$item])){
    //                                            $calculated_hour = $value + $salary_array[$item]['hour'];
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                                $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $salary);
                                            }else{
                                                $salary_array[$item] = array('hour' => $value, 'amount' => $salary);
                                            }
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;

                            $db_key = $this->get_db_key_field($item);
                            if($merge_normal_oncall_hours){
                                if(in_array($db_key, $normal_keys)){    //check is normal type
                                    $salary = $this->get_salary($day, $employee, 'normal');
                                    $calculated_hour = $equipment->time_sum($salary_array['normal_0']['hour'], $value);
                                    $salary_array['normal_0'] = array('hour' => $calculated_hour, 'amount' => $salary);
                                }else if(in_array($db_key, $oncall_keys)){  //check is oncall type
                                    $salary = $this->get_salary($day, $employee, 'oncall');
                                    $calculated_hour = $equipment->time_sum($salary_array['normal_3']['hour'], $value);
                                    $salary_array['normal_3'] = array('hour' => $calculated_hour, 'amount' => $salary);
                                }
                            }else{
                                if($db_key != ''){       // Other hours
                                    $salary = $this->get_salary($day, $employee, $db_key);
                                    if(isset($salary_array[$item])){
                                        $calculated_hour = $equipment->time_sum($value, $salary_array[$item]['hour']);
                                        $salary_array[$item] = array('hour' => $calculated_hour, 'amount' => $salary);
                                    }else{
                                        $salary_array[$item] = array('hour' => $value, 'amount' => $salary);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $salary_array;
        
    }
    
    public function calculate_oncall_slots_salary_asper_day($employee){
        /**
         * Author: Shamsu
         * for: calculate salary for each type oncall type slots (3,9,13,14) seperately (only for hogia salary type)
         * since: 2014-09-11
         */
        
        $equipment = new equipment();
        $salary_array = array();
        if(!empty($this->salary_hours)){
            foreach ($this->salary_hours as $day => $entries) {
                foreach ($entries as $item => $value) {
                    if(is_array($value)){  
                        // this block only for getting different types of oncall inconvenient salary
                        foreach ($value as $sub_item => $sub_value) {
                            if($sub_value != ''){
                                $is_calculated = FALSE;

                                if(!empty($this->holidays)){    //check is in holiday
                                    foreach ($this->holidays as $holiday) {
                                        if($item == $holiday['name'])
                                                $is_calculated = TRUE;
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
                                    foreach ($this->inconv_normal_category as $normal_inconv) {
                                        if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day)))
                                                $is_calculated = TRUE;
                                        if($is_calculated)  break;
                                    }
                                }       

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
                                    foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                        if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $db_key = '';
                                                $this_oncall_slot_name = '';
                                                switch ($sub_item) {
                                                    case self::CALLTRAINING: 
                                                        $db_key = $this->get_db_key_field('call_training'); 
                                                        $this_oncall_slot_name = 'Intro väntetid';
                                                        break;
                                                    case self::COMPLEMENTARY_ONCALL: 
                                                        $db_key = $this->get_db_key_field('complementary_oncall'); 
                                                        $this_oncall_slot_name = 'Komp.tid Väntetid';
                                                        break;
                                                    case self::MORE_ONCALL: 
                                                        $db_key = $this->get_db_key_field('more_oncall'); 
                                                        $this_oncall_slot_name = 'Timtid väntetid';
                                                        break;
                                                    case self::DISMISSAL_ONCALL: 
                                                        $db_key = $this->get_db_key_field('dismissal_oncall'); 
                                                        $this_oncall_slot_name = 'Uppsägningslön(J)';
                                                        break;
                                                    case self::ONCALL: 
                                                    default:
                                                        $db_key = $this->get_db_key_field('jour'); 
                                                        $this_oncall_slot_name = 'Jour';
                                                        break;
                                                        
                                                }
//                                                echo "<pre>".print_r(array($day, $employee, $db_key), 1)."</pre>";
                                                $salary = $this->get_salary($day, $employee, $db_key);
                                                if(isset($salary_array[$this_oncall_slot_name][$salary])){
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_oncall_slot_name][$salary]['hour']);
                                                    $salary_array[$this_oncall_slot_name][$salary] = array('hour' => $calculated_hour);
                                                }else{
                                                    $salary_array[$this_oncall_slot_name][$salary] = array('hour' => $sub_value);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $salary_array;
        
    }
    
    public function calculate_key_based_perhour_salary_asper_day($employee, $merge_normal_oncall_hours = TRUE) {
        /**
         * Author: Shamsu
         * for: calculate salary for each type category seperately (holiday, different inconvenients, different slot types)
         * just a copy function of calculate_key_based_perhour_salary()
         * assign per-hour salary to 'amount' in resultant array, otherwise totals to be stored.
         * output array format will entirely different(calculate_key_based_perhour_salary(), this())
         */
//        echo "<pre>Salary Hours: ".print_r($this->salary_hours, 1)."</pre>";
        $equipment = new equipment();
        $salary_array = array();
        if(!empty($this->salary_hours)){
            if($merge_normal_oncall_hours){
                $salary_array['normal_0'] = array();
                $salary_array['normal_3'] = array();
                $oncall_keys = array('oncall', 'call_training', 'complementary_oncall', 'more_oncall', 'dismissal_oncall');
                $normal_keys = array('normal', 'travel', 'break', 'overtime', 'quality_overtime', 'more_time', 'some_other_time', 'training_time', 'personal_meeting', 'voluntary', 'complementary', 'standby', 'dismissal');
            }
            foreach ($this->salary_hours as $day => $entries) {
//                echo "<br/>[$day]";
                foreach ($entries as $item => $value) {
                    
                    if(is_array($value)){   
                        // this block only for getting different types of oncall inconvenient salary
                        foreach ($value as $sub_item => $sub_value) {
                            if($sub_value != ''){
                                $is_calculated = FALSE;
                                $tmp_item_name = $item;

                                if(!empty($this->holidays)){    //check is in holiday
                                    foreach ($this->holidays as $holiday) {
                                        if($item == $holiday['name']){
                                                $salary = 0;
                                                $is_calculated = TRUE;
                                                if($holiday['type'] == 1){         //1-Normal Holiday
                                                    switch ($sub_item) {
                                                        case self::ONCALL: 
                                                        case self::CALLTRAINING: 
                                                        case self::COMPLEMENTARY_ONCALL: 
                                                        case self::MORE_ONCALL: 
                                                        case self::DISMISSAL_ONCALL: 
                                                            $salary = $this->get_salary($day, $employee, 'holiday_red_oncall');
                                                            $tmp_item_name = $item. ' Jour';
                                                            break;
                                                        default:
                                                            $salary = $this->get_salary($day, $employee, 'holiday_red');
                                                            break;
                                                            
                                                    }
                                                }else if($holiday['type'] == 2){   //2-Big Holiday
                                                    switch ($sub_item) {
                                                        case self::ONCALL: 
                                                        case self::CALLTRAINING: 
                                                        case self::COMPLEMENTARY_ONCALL: 
                                                        case self::MORE_ONCALL: 
                                                        case self::DISMISSAL_ONCALL: 
                                                            $salary = $this->get_salary($day, $employee, 'holiday_big_oncall');
                                                            $tmp_item_name = $item. ' Jour';
                                                            break;
                                                        default:
                                                            $salary = $this->get_salary($day, $employee, 'holiday_big');
                                                            break;
                                                    }
                                                }

                                                if(isset($salary_array[$tmp_item_name][$salary])){
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$tmp_item_name][$salary]['hour']);
                                                    $salary_array[$tmp_item_name][$salary] = array('hour' => $calculated_hour);
                                                }else{
                                                    $salary_array[$tmp_item_name][$salary] = array('hour' => $sub_value);
                                                }
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
        //                            $date_day_number = date('N', strtotime($day));
                                    foreach ($this->inconv_normal_category as $normal_inconv) {
        //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                        if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_normal_inconv_amount = $normal_inconv['amount'];
                                                $this_normal_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::TRAINING: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_call_training']; 
                                                        $this_normal_slot_name = $item.' Intro';
                                                        break;
                                                    case self::COMPLEMENTARY: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_complementary_oncall']; 
                                                        $this_normal_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::DISMISSAL: 
                                                        $this_normal_inconv_amount = $normal_inconv['sal_dismissal_oncall']; 
                                                        $this_normal_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $this_normal_inconv_amount, $sub_item);
                                                if(isset($salary_array[$this_normal_slot_name][$salary])){
        //                                            $calculated_hour = $sub_value + $salary_array[$this_normal_slot_name][$salary]['hour'];
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_normal_slot_name][$salary]['hour']);
                                                    $salary_array[$this_normal_slot_name][$salary] = array('hour' => $calculated_hour);
                                                }else{
                                                    $salary_array[$this_normal_slot_name][$salary] = array('hour' => $sub_value);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }       

                                if($is_calculated)  continue;

                                if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
        //                            $date_day_number = date('N', strtotime($day));
//        echo "<pre>".print_r($this->inconv_oncall_category,1)."</pre>";
                                    foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                        if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                                $is_calculated = TRUE;
                                                $this_oncall_inconv_amount = $oncall_inconv['amount'];
                                                $this_oncall_slot_name = $item;
                                                switch ($sub_item) {
                                                    case self::ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['amount']; 
                                                        $this_oncall_slot_name = $item;//.' Jour';
                                                        break;
                                                    case self::CALLTRAINING: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_call_training']; 
                                                        $this_oncall_slot_name = $item.' Intro';//Intro väntetid
                                                        break;
                                                    case self::COMPLEMENTARY_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_complementary_oncall']; 
                                                        $this_oncall_slot_name = $item.' Komp.tid';
                                                        break;
                                                    case self::MORE_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_more_oncall']; 
                                                        $this_oncall_slot_name = $item.' Timtid';
                                                        break;
                                                    case self::DISMISSAL_ONCALL: 
                                                        $this_oncall_inconv_amount = $oncall_inconv['sal_dismissal_oncall']; 
                                                        $this_oncall_slot_name = $item.' Uppsägningslön';
                                                        break;
                                                }
                                                $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $this_oncall_inconv_amount, $sub_item);
//                                                echo $sub_item.'==='.$this_oncall_inconv_amount.'***'.$salary.'<br/>';
                                                if(isset($salary_array[$this_oncall_slot_name][$salary])){
                                                    $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$this_oncall_slot_name][$salary]['hour']);
                                                    $salary_array[$this_oncall_slot_name][$salary] = array('hour' => $calculated_hour);
                                                }else{
                                                    $salary_array[$this_oncall_slot_name][$salary] = array('hour' => $sub_value);
                                                }
                                                break;
                                        }
                                        if($is_calculated)  break;
                                    }
                                }

                                if($is_calculated)  continue;


                                $db_key = $this->get_db_key_field($item);
                                if($merge_normal_oncall_hours){
                                    if(in_array($db_key, $normal_keys)){    //check is normal type
                                        $salary = $this->get_salary($day, $employee, 'normal');

                                        if(isset($salary_array['normal_0'][$salary])){
                                            $calculated_hour = $equipment->time_sum($salary_array['normal_0'][$salary]['hour'], $sub_value);
                                            $salary_array['normal_0'][$salary] = array('hour' => $calculated_hour);
                                        }else
                                            $salary_array['normal_0'][$salary] = array('hour' => $sub_value);
                                    }else if(in_array($db_key, $oncall_keys)){  //check is oncall type
                                        $salary = $this->get_salary($day, $employee, 'oncall');
                                        if(isset($salary_array['normal_0'][$salary])){
                                            $calculated_hour = $equipment->time_sum($salary_array['normal_3'][$salary]['hour'], $sub_value);
                                            $salary_array['normal_3'][$salary] = array('hour' => $calculated_hour);
                                        }else
                                            $salary_array['normal_3'][$salary] = array('hour' => $sub_value);
                                    }
                                }else{
                                    if($db_key != ''){       // Other hours
                                        $salary = $this->get_salary($day, $employee, $db_key);
                                        if(isset($salary_array[$item][$salary])){
                                            $calculated_hour = $equipment->time_sum($sub_value, $salary_array[$item][$salary]['hour']);
                                            $salary_array[$item][$salary] = array('hour' => $calculated_hour);
                                        }else{
                                            $salary_array[$item][$salary] = array('hour' => $sub_value);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    else{
                        if($value != ''){
                            $is_calculated = FALSE;

                            if(!empty($this->holidays)){    //check is in holiday
                                foreach ($this->holidays as $holiday) {
                                    if($item == $holiday['name']){
                                            $salary = 0;
                                            $is_calculated = TRUE;
                                            if($holiday['type'] == 1)         //1-Normal Holiday
                                                $salary = $this->get_salary($day, $employee, 'holiday_red');
                                            else if($holiday['type'] == 2)   //2-Big Holiday
                                                $salary = $this->get_salary($day, $employee, 'holiday_big');
                                            
//                                            echo "B4<pre>".print_r($salary_array, 1)."</pre>";
//                                            echo "[$item][$salary][$value]";
                                            if(isset($salary_array[$item][$salary])){
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item][$salary]['hour']);
                                                $salary_array[$item][$salary] = array('hour' => $calculated_hour);
                                            }else{
                                                $salary_array[$item][$salary] = array('hour' => $value);
                                            }
//                                            echo "A6<pre>".print_r($salary_array, 1)."</pre>";
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_normal_category)){    //check in normal inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_normal_category as $normal_inconv) {
    //                                $inconv_day_array = explode(',', $normal_inconv['days']);
                                    if($item == $normal_inconv['name'] && $normal_inconv['effect_from'] <= $day && (($normal_inconv['effect_to'] == '') || ($normal_inconv['effect_to'] != '' && $normal_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $normal_inconv['group_id'], $normal_inconv['amount']);
                                            if(isset($salary_array[$item][$salary])){
    //                                            $calculated_hour = $value + $salary_array[$item][$salary]['hour'];
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item][$salary]['hour']);
                                                $salary_array[$item][$salary] = array('hour' => $calculated_hour);
                                            }else{
                                                $salary_array[$item][$salary] = array('hour' => $value);
                                            }
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }       

                            if($is_calculated)  continue;

                            if(!empty($this->inconv_oncall_category)){              //check in oncall inconvenients
    //                            $date_day_number = date('N', strtotime($day));
                                foreach ($this->inconv_oncall_category as $oncall_inconv) {
                                    if($item == $oncall_inconv['name'] && $oncall_inconv['effect_from'] <= $day && (($oncall_inconv['effect_to'] == '') || ($oncall_inconv['effect_to'] != '' && $oncall_inconv['effect_to'] >= $day))){
                                            $is_calculated = TRUE;
                                            $salary = $this->get_inconvenient_salary($day, $employee, $item, $oncall_inconv['group_id'], $oncall_inconv['amount']);
                                            if(isset($salary_array[$item][$salary])){
                                                $calculated_hour = $equipment->time_sum($value, $salary_array[$item][$salary]['hour']);
                                                $salary_array[$item][$salary] = array('hour' => $calculated_hour);
                                            }else{
                                                $salary_array[$item][$salary] = array('hour' => $value);
                                            }
                                            break;
                                    }
                                    if($is_calculated)  break;
                                }
                            }

                            if($is_calculated)  continue;


                            $db_key = $this->get_db_key_field($item);
                            if($merge_normal_oncall_hours){
                                if(in_array($db_key, $normal_keys)){    //check is normal type
                                    $salary = $this->get_salary($day, $employee, 'normal');

                                    if(isset($salary_array['normal_0'][$salary])){
                                        $calculated_hour = $equipment->time_sum($salary_array['normal_0'][$salary]['hour'], $value);
                                        $salary_array['normal_0'][$salary] = array('hour' => $calculated_hour);
                                    }else
                                        $salary_array['normal_0'][$salary] = array('hour' => $value);
                                }else if(in_array($db_key, $oncall_keys)){  //check is oncall type
                                    $salary = $this->get_salary($day, $employee, 'oncall');
                                    if(isset($salary_array['normal_0'][$salary])){
                                        $calculated_hour = $equipment->time_sum($salary_array['normal_3'][$salary]['hour'], $value);
                                        $salary_array['normal_3'][$salary] = array('hour' => $calculated_hour);
                                    }else
                                        $salary_array['normal_3'][$salary] = array('hour' => $value);
                                }
                            }else{
                                if($db_key != ''){       // Other hours
                                    $salary = $this->get_salary($day, $employee, $db_key);
                                    if(isset($salary_array[$item][$salary])){
                                        $calculated_hour = $equipment->time_sum($value, $salary_array[$item][$salary]['hour']);
                                        $salary_array[$item][$salary] = array('hour' => $calculated_hour);
                                    }else{
                                        $salary_array[$item][$salary] = array('hour' => $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $salary_array;
        
    }

    public function group_nomal_inconv_from_calculated_key_based_salary($salary_array) {
        /**
         * Author: Shamsu
         * for: Grouping normal/inconvenient form calculated key based salary
         * holidays and inconvenients remains same, but all default remaining hours grouped in either normal / inconvenient
         */
        $grouped_salary_array = array();
        $grouped_salary_array['normal_0'] = array('hour' => 0, 'amount' => 0);
        $grouped_salary_array['normal_3'] = array('hour' => 0, 'amount' => 0);
        if(!empty($salary_array)){
            $oncall_keys = array('oncall', 'call_training', 'complementary_oncall', 'more_oncall', 'dismissal_oncall');
            $normal_keys = array('normal', 'travel', 'break', 'overtime', 'quality_overtime', 'more_time', 'some_other_time', 'training_time', 'personal_meeting', 'voluntary', 'complementary', 'standby', 'dismissal');
            foreach ($salary_array as $item => $value) {
                if(!empty($value) != ''){
                    $db_key = $this->get_db_key_field($item);
                    if($db_key == ''){
                            $grouped_salary_array[$item] = $value;
                    }else{
                        if(in_array($db_key, $normal_keys)){    //check is normal type
                            $calculated_salary = $grouped_salary_array['normal_0']['amount'] + $value['amount'];
                            $calculated_hour = $grouped_salary_array['normal_0']['hour'] + $value['hour'];
                            $grouped_salary_array['normal_0'] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                        }else if(in_array($db_key, $oncall_keys)){  //check is oncall type
                            $calculated_salary = $grouped_salary_array['normal_3']['amount'] + $value['amount'];
                            $calculated_hour = $grouped_salary_array['normal_3']['hour'] + $value['hour'];
                            $grouped_salary_array['normal_3'] = array('hour' => $calculated_hour, 'amount' => $calculated_salary);
                        }
                    }

                }
            }
        }
        return $grouped_salary_array;
        
    }
    
    public function get_db_key_field($key) {
        /**
         * Author: Shamsu
         * for: get normal or holiday salary
         */
        
        $db_field = '';
        switch ($key) {
            case 'Ord. tid': $db_field = 'normal'; break;
            case 'travel': $db_field = 'travel'; break;
            case 'break': $db_field = 'break'; break;
            case 'jour': $db_field = 'oncall'; break;
            case 'overtime': $db_field = 'overtime'; break;
            case 'qual_overtime': $db_field = 'quality_overtime'; break;
            case 'more_time': $db_field = 'more_time'; break;
            case 'some_other_time': $db_field = 'some_other_time'; break;
            case 'training': $db_field = 'training_time'; break;
            case 'call_training': $db_field = 'call_training'; break;
            case 'personal_meeting': $db_field = 'personal_meeting'; break;
            case 'voluntary': $db_field = 'voluntary'; break;
            case 'complementary': $db_field = 'complementary'; break;
            case 'complementary_oncall': $db_field = 'complementary_oncall'; break;
            case 'more_oncall' : $db_field = 'more_oncall'; break;
            case 'standby' : $db_field = 'standby'; break;
            case 'dismissal' : $db_field = 'w_dismissal'; break;
            case 'dismissal_oncall' : $db_field = 'w_dismissal_oncall'; break;
        }
        return $db_field;
    }
    
    public function get_salary($date, $employee, $field) {
        /**
         * Author: Shamsu
         * for: get normal or holiday salary
         */
        
        $db_field = '';
        switch ($field){
            case 'normal': $db_field = 'normal'; break;
            case 'travel': $db_field = 'travel'; break;
            case 'break': $db_field = 'break'; break;
            case 'oncall': $db_field = 'oncall'; break;
            case 'overtime': $db_field = 'overtime'; break;
            case 'quality_overtime': $db_field = 'quality_overtime'; break;
            case 'more_time': $db_field = 'more_time'; break;
            case 'some_other_time': $db_field = 'some_other_time'; break;
            case 'training_time': $db_field = 'training_time'; break;
            case 'call_training': $db_field = 'call_training'; break;
            case 'personal_meeting': $db_field = 'personal_meeting'; break;
            case 'voluntary': $db_field = 'voluntary'; break;
            case 'complementary': $db_field = 'complementary'; break;
            case 'complementary_oncall': $db_field = 'complementary_oncall'; break;
            case 'more_oncall' : $db_field = 'more_oncall'; break;
            case 'holiday_big': $db_field = 'holiday_big'; break;
            case 'holiday_big_oncall': $db_field = 'holiday_big_oncall'; break;
            case 'holiday_red': $db_field = 'holiday_red'; break;
            case 'holiday_red_oncall': $db_field = 'holiday_red_oncall'; break;
            case 'insurance': $db_field = 'insurance'; break;
            case 'standby' : $db_field = 'standby'; break;
            case 'dismissal' : $db_field = 'w_dismissal'; break;
            case 'dismissal_oncall' : 
            case 'w_dismissal_oncall' : $db_field = 'w_dismissal_oncall'; break;
        }
        
        if($db_field == '') return 0.00;
        
        //first find employee salary table
        $this->tables = array('employee_salary');
        $this->fields = array($db_field. ' as salary');
        $this->conditions = array('AND','employee = ?', 
                                        array('OR', 
                                            array('AND',
                                                array('OR', 'effect_to IS NULL', 'effect_to = ""', 'effect_to = "0000-00-00"'),
                                                'effect_from <= ?'
                                                ),
                                            array('AND', 'effect_to IS NOT NULL', 'effect_from <= ?', 'effect_to >= ?')
                                            )
                            );
        $this->condition_values = array($employee, $date, $date, $date);
        $this->order_by = array('id desc');
        $this->query_generate();
        $data = $this->query_fetch();
        
        if(!empty($data) && $data[0]['salary'] !== NULL)
            return $data[0]['salary'];
        else{   //if not find in employee salary table, find in salary main table
            $this->flush();
            $this->tables = array('salary_main');
            $this->fields = array($db_field. ' as salary');
            $this->conditions = array('OR', 
                                        array('AND',
                                            array('OR', 'effect_to IS NULL', 'effect_to = ""', 'effect_to = "0000-00-00"'),
                                            'effect_from <= ?'
                                            ),
                                        array('AND', 'effect_to IS NOT NULL', 'effect_from <= ?', 'effect_to >= ?')
                                );
            $this->condition_values = array( $date, $date, $date);
            $this->order_by = array('id desc');
            $this->query_generate();
            $data = $this->query_fetch();
            if(!empty($data))
                return $data[0]['salary'];
            else
                return 0.00;
        }
    }
    
    public function get_inconvenient_salary($date, $employee, $inconvenient_name, $group_id, $general_amount = NULL, $oncall_slot_type = NULL) {
        /**
         * Author: Shamsu
         * for: get inconvenient salary
         */
        
        //first find employee inconvenient salary table
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('amount as salary', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall');
        $this->conditions = array('AND','employee = ?', 'inconvenient_group_id = ?',
                                        array('OR', 
                                            array('AND',
                                                array('OR', 'effect_to IS NULL', 'effect_to = ""', 'effect_to = "0000-00-00"'),
                                                'effect_from <= ?'
                                                ),
                                            array('AND', 'effect_to IS NOT NULL', 'effect_from <= ?', 'effect_to >= ?')
                                            )
                            );
        $this->condition_values = array($employee, $group_id, $date, $date, $date);
        $this->order_by = array('id desc');
        $this->query_generate();
        
        $data = $this->query_fetch();
        if(!empty($data)){
            if ($oncall_slot_type == NULL){
                return $data[0]['salary'] !== NULL ? $data[0]['salary'] : ($general_amount != NULL ? $general_amount : 0.00);
            }else{
                $inconv_salary = $data[0]['salary'];
                switch ($oncall_slot_type) {
                    case self::ONCALL: 
                        $inconv_salary = ($data[0]['salary'] !== NULL ? $data[0]['salary'] : ($general_amount != NULL ? $general_amount : 0.00)); break;
                    case self::TRAINING: 
                    case self::CALLTRAINING: 
                        $inconv_salary = $data[0]['sal_call_training'] !== NULL ? $data[0]['sal_call_training'] : ($general_amount != NULL ? $general_amount : 0.00); break;
                    case self::COMPLEMENTARY: 
                    case self::COMPLEMENTARY_ONCALL: 
                        $inconv_salary = $data[0]['sal_complementary_oncall'] !== NULL ? $data[0]['sal_complementary_oncall'] : ($general_amount != NULL ? $general_amount : 0.00); break;
                    case self::MORE_ONCALL: 
                        $inconv_salary = $data[0]['sal_more_oncall'] !== NULL ? $data[0]['sal_more_oncall'] : ($general_amount != NULL ? $general_amount : 0.00); break;
                    case self::DISMISSAL: 
                    case self::DISMISSAL_ONCALL: 
                        $inconv_salary = $data[0]['sal_dismissal_oncall'] !== NULL ? $data[0]['sal_dismissal_oncall'] : ($general_amount != NULL ? $general_amount : 0.00); break;
                }
                return $inconv_salary;
            }
        }else{   //if not find in employee inconvenient salary table, find salary in inconvenient main table
            return $general_amount != NULL ? $general_amount : 0.00;
        }
    }
    
    function get_weekend_inconvenient_group_id($mod = 0){
        $this->tables = array('inconvenient_timing');
        $this->fields = array('distinct group_id');
        $this->conditions = array('OR','days LIKE \'%6,%\'', 'days LIKE \'%7,%\'');
        $this->query_generate();        
        $datas = $this->query_fetch();
        $result = array();
        foreach($datas as $data){
            $result[] = $data['group_id'];
        }
        return $result;
    }
        
    public function print_arrays($display_categories = TRUE, $display_keys = TRUE, $display_contents = TRUE){
        if($display_categories){
            echo "<pre>inconv_normal_category : ".print_r($this->inconv_normal_category, 1)."</pre>";
            echo "<pre>inconv_oncall_category: ".print_r($this->inconv_oncall_category, 1)."</pre>";
            echo "<pre>leave_category : ".print_r($this->leave_category, 1)."</pre>";
            echo "<pre>holidays : ".print_r($this->holidays, 1)."</pre>";
        }
        if($display_keys){
            echo "=========Keys==========<pre>0".print_r($this->sub_keys_normal, 1)."</pre>";
            echo "<pre>1".print_r($this->sub_keys_quality, 1)."</pre>";
            echo "<pre>2".print_r($this->sub_keys_more, 1)."</pre>";
            echo "<pre>3".print_r($this->sub_keys_some, 1)."</pre>";
            echo "<pre>4".print_r($this->sub_keys_training, 1)."</pre>";
            echo "<pre>5".print_r($this->sub_keys_personal, 1)."</pre>";
            echo "<pre>6".print_r($this->sub_keys_oncall, 1)."</pre>";
            echo "<pre>7".print_r($this->sub_keys_calltraining, 1)."</pre>";
            echo "<pre>8".print_r($this->sub_keys_leave_normal_head, 1)."</pre>";
            echo "<pre>9".print_r($this->sub_keys_leave_over_head, 1)."</pre>";
            echo "<pre>10".print_r($this->sub_keys_leave_quality_head, 1)."</pre>";
            echo "<pre>11".print_r($this->sub_keys_leave_more_head, 1)."</pre>";
            echo "<pre>12".print_r($this->sub_keys_leave_some_head, 1)."</pre>";
            echo "<pre>13".print_r($this->sub_keys_leave_training_head, 1)."</pre>";
            echo "<pre>14".print_r($this->sub_keys_leave_personal_head, 1)."</pre>";
            echo "<pre>15".print_r($this->sub_keys_leave_oncall_head, 1)."</pre>";
            echo "<pre>16".print_r($this->sub_keys_leave_calltraining_head, 1); 
            echo "<pre>17".print_r($this->sub_keys_leave_voluntary_head, 1); 
            echo "<pre>18".print_r($this->sub_keys_leave_more_oncall_head, 1); 
            echo"</pre>============================";
        }
//        
        if($display_contents){
            echo "=========RPT contents=========="; 
            echo "<pre>rpt_content_normal: ".print_r($this->rpt_content_normal, 1)."</pre>";
            echo "<pre>rpt_content_break: ".print_r($this->rpt_content_break, 1)."</pre>";
            echo "<pre>rpt_content_travel: ".print_r($this->rpt_content_travel, 1)."</pre>";
            echo "<pre>rpt_content_oncall: ".print_r($this->rpt_content_oncall, 1)."</pre>";
            echo "<pre>rpt_content_over: ".print_r($this->rpt_content_over, 1)."</pre>";
            echo "<pre>rpt_content_quality ".print_r($this->rpt_content_quality, 1)."</pre>";
            echo "<pre>rpt_content_more ".print_r($this->rpt_content_more, 1)."</pre>";
            echo "<pre>rpt_content_some ".print_r($this->rpt_content_some, 1)."</pre>";
            echo "<pre>rpt_content_training ".print_r($this->rpt_content_training, 1)."</pre>";
            echo "<pre>rpt_content_personal ".print_r($this->rpt_content_personal, 1)."</pre>";
            echo "<pre>rpt_content_calltraining ".print_r($this->rpt_content_calltraining, 1)."</pre>";
            echo "<pre>rpt_content_voluntary ".print_r($this->rpt_content_voluntary, 1)."</pre>";
            echo "<pre>rpt_content_complementary ".print_r($this->rpt_content_complementary, 1)."</pre>";
            echo "<pre>rpt_content_complementary_oncall ".print_r($this->rpt_content_complementary_oncall, 1)."</pre>";
            echo "<pre>rpt_content_more_oncall ".print_r($this->rpt_content_more_oncall, 1)."</pre>";
            echo "<pre>rpt_content_standby ".print_r($this->rpt_content_standby, 1)."</pre><br/>";
            echo "<pre>rpt_content_dismissal ".print_r($this->rpt_content_dismissal, 1)."</pre><br/>";
            echo "<pre>rpt_content_dismissal_oncall ".print_r($this->rpt_content_dismissal_oncall, 1)."</pre><br/>";
            
            echo "<pre>rpt_content_leave ".print_r($this->rpt_content_leave, 1)."</pre>";
            echo "<pre>rpt_content_leave_travel ".print_r($this->rpt_content_leave_travel, 1)."</pre>";
            echo "<pre>rpt_content_leave_break ".print_r($this->rpt_content_leave_break, 1)."</pre>";
            echo "<pre>rpt_content_leave_over ".print_r($this->rpt_content_leave_over, 1)."</pre>";
            echo "<pre>rpt_content_leave_quality ".print_r($this->rpt_content_leave_quality, 1)."</pre>";
            echo "<pre>rpt_content_leave_more ".print_r($this->rpt_content_leave_more, 1)."</pre>";
            echo "<pre>rpt_content_leave_some ".print_r($this->rpt_content_leave_some, 1)."</pre>";
            echo "<pre>rpt_content_leave_training ".print_r($this->rpt_content_leave_training, 1)."</pre>";
            echo "<pre>rpt_content_leave_personal ".print_r($this->rpt_content_leave_personal, 1)."</pre>";
            echo "<pre>rpt_content_leave_oncall ".print_r($this->rpt_content_leave_oncall, 1)."</pre>";
            echo "<pre>rpt_content_leave_calltraining ".print_r($this->rpt_content_leave_calltraining, 1);
            echo "<pre>rpt_content_leave_voluntary ".print_r($this->rpt_content_leave_voluntary, 1);
            echo "<pre>rpt_content_leave_more_oncall ".print_r($this->rpt_content_leave_more_oncall, 1);
            echo "<pre>rpt_content_leave_standby ".print_r($this->rpt_content_leave_standby, 1);
            echo "</pre>============================";
            
        }
    }
    
    function check_untreated_candg_slots($this_employee, $this_customer, $month, $year){
        $this->tables = array('timetable');
        $this->fields = array('count(id) as candg_status');
        $this->conditions = array('AND', 'status = 4', 'employee = ?', 'customer = ?','month(date) = ?', 'year(date) = ?');
        $this->condition_values = array($this_employee, $this_customer, $month, $year);
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>18".print_r($this->condition_values, 1);
        $datas = $this->query_fetch();
        if($datas[0]['candg_status'] == 0)
            return FALSE;
        else
            return TRUE;
    }
}
?>