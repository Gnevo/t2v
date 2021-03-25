<?php

/* class for managing inconvenient timing.
 * Mainly used in employee work report details
 * created by shaju
 */

ini_set('display_errors', false);
//ini_set('xdebug.var_display_max_depth', 10);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/general.php');

class inconvenient_new extends db {
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

    public $slot_types = array();



    //All headings
    

    //for grouping different categories asper different salary amount
    public $headings = array();
    public $total = array();
    public $result_data = array();

    public $headings_leave = array();
    public $total_leave = array();
    public $result_data_leave = array();

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
        $this->slot_types = array('Ord. tid',
                                  'travel',
                                   'break',
                                   'overtime',
                                   'qual_overtime',
                                   'more_time',
                                   'some_other_time',
                                   'training',
                                   'personal_meeting',
                                   'voluntary',
                                   'complementary',
                                   'standby',
                                   'dismissal',
                                   // 'jour',
                                   // 'call_training',
                                   // 'complementary_oncall',
                                   // 'more_oncall',
                                   // 'dismissal_oncall',
                                );
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

        $this->headings = array();
        $this->result_data = array();
        $this->total = array();

        $this->headings_leave = array();
        $this->result_data_leave = array();
        $this->total_leave = array();

        $this->fkkn_slots = array();
    }
    
    //generating employee mothly work report
    public function generate_work_report($passed_employee, $month, $yr, $passed_customer = '') {

        $employee = new employee();
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        
        $this->inconv_normal_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);
        
            //        if($employee->is_ob_on_for_a_employee($passed_employee)){
            //$this->inconv_normal_category = $employee->get_distinct_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);
            //$this->inconv_oncall_category = $employee->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $passed_customer);       
            $sdate = date('Y-m-01', strtotime("$yr-$month-01"));
            $edate = date('Y-m-t', strtotime("$yr-$month-01"));
            $this->inconv_normal_category = $employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $passed_employee, 1, $passed_customer);
            $this->inconv_oncall_category = $employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $passed_employee, 3, $passed_customer);
            //            if($_COOKIE['admin'] == 'yes'){
            //                echo "<pre>func_get_args".print_r(func_get_args(), 1)."</pre>";
            //                echo "<pre>inconv_oncall_category : ".print_r($this->inconv_oncall_category, 1)."</pre>";
            //            }
                        
            //        } else
            //            $this->inconv_normal_category = $this->inconv_oncall_category = array();
            //        echo "<pre>inconv_normal_category : ".print_r($this->inconv_normal_slots, 1)."</pre>";exit();
            //        echo "<pre>inconv_oncall_category : ".print_r($this->inconv_oncall_category, 1)."</pre>";exit();    
            //        echo "<pre>inconv_normal_category : ".print_r($this->inconv_normal_category, 1)."</pre>";    
        $this->leave_category = $employee->get_leave_details_by_month_and_year($month, $yr, $passed_employee,$passed_customer);
        if($employee->is_ob_on_for_a_employee($passed_employee))
            $this->holidays = $employee->get_holiday_details($month, $yr);
        else
            $this->holidays = array();
  
        //echo "<pre>".print_r($this->holidays, 1)."</pre>";exit();
        $this->categorize_slots($passed_employee, $passed_customer);
        //$this->categorize_salary_hours();
    }
    
    //categorizing the slots under different labels
    public function categorize_slots($passed_employee, $passed_customer = '', $flag_holiday = 1) {
        //       echo "<pre>Innnnnnnnnnnnconvenient: ".print_r($this->inconv_normal_slots, 1)."</pre>";
        //        echo "<pre>inconv_normal_category : ".print_r($this->inconv_normal_category, 1)."</pre>";
        //        echo "<pre>inconv_oncall_category: ".print_r($this->inconv_oncall_category, 1)."</pre>";
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

                $this->rpt_content_standby[$inconv_normal_slot['date']]['standby'] += $time_duration= round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
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
            if($time_duration != 0 && $inconv_normal_slot['status'] == 1){
                $this->generate_fkkn_separation($inconv_normal_slot['date'], $time_duration, $inconv_normal_slot['type'], $inconv_normal_slot['fkkn']);
            }
        }
        //echo "<pre>normal: ".print_r($this->fkkn_slots, 1)."</pre>";exit();
        //echo "<pre>normal_leave: ".print_r($this->rpt_content_leave, 1)."</pre>";
        //echo "<pre>quality: ".print_r($this->rpt_content_over, 1)."</pre>";
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
        
        $this->sub_keys_voluntary = $this->generate_headings($this->rpt_content_voluntary, self::VOLUNTARY);
        $this->sub_keys_complementary = $this->generate_headings($this->rpt_content_complementary, self::COMPLEMENTARY);

        $this->sub_keys_standby = $this->generate_headings($this->rpt_content_standby, self::STANDBY);
        $this->sub_keys_dismissal = $this->generate_headings($this->rpt_content_dismissal, self::DISMISSAL);
        $this->sub_keys_oncall = $this->generate_headings($this->rpt_content_oncall, self::ONCALL);
        $this->sub_keys_calltraining = $this->generate_headings($this->rpt_content_calltraining, self::CALLTRAINING);
        $this->sub_keys_complementary_oncall = $this->generate_headings($this->rpt_content_complementary_oncall, self::COMPLEMENTARY_ONCALL);
        $this->sub_keys_more_oncall = $this->generate_headings($this->rpt_content_more_oncall, self::MORE_ONCALL);
        $this->sub_keys_dismissal_oncall = $this->generate_headings($this->rpt_content_dismissal_oncall, self::DISMISSAL_ONCALL);
        ksort($this->result_data);
        ksort($this->headings);
        ksort($this->total);
        //echo "<pre>heads".print_r($this->headings,1)."</pre>"; 
        //exit();
        // echo "<pre>result_data".print_r($this->result_data,1)."</pre>";exit();
        //echo "<pre>result_data".print_r($this->total,1)."</pre>";exit();
        //echo "<pre>result_data".print_r($this->result_data,1)."</pre>";
                //Taking the distinct leave types for making the headings
        $this->sub_keys_leave_normal_head = $this->generate_leave_headings($this->sub_keys_leave_normal, $this->sub_keys_leave_normal_inconv, $this->rpt_content_leave, self::NORMAL);
        $this->sub_keys_leave_travel_head = $this->generate_leave_headings($this->sub_keys_leave_travel, $this->sub_keys_leave_travel_inconv, $this->rpt_content_leave_travel, self::TRAVEL);
        $this->sub_keys_leave_break_head = $this->generate_leave_headings($this->sub_keys_leave_break, $this->sub_keys_leave_break_inconv, $this->rpt_content_leave_break, self::BRK);
        $this->sub_keys_leave_over_head = $this->generate_leave_headings($this->sub_keys_leave_over, $this->sub_keys_leave_over_inconv, $this->rpt_content_leave_over, self::OVER);
        $this->sub_keys_leave_quality_head = $this->generate_leave_headings($this->sub_keys_leave_quality, $this->sub_keys_leave_quality_inconv, $this->rpt_content_leave_quality, self::QUALITY);
        $this->sub_keys_leave_more_head = $this->generate_leave_headings($this->sub_keys_leave_more, $this->sub_keys_leave_more_inconv, $this->rpt_content_leave_more, self::MORE);
        $this->sub_keys_leave_some_head = $this->generate_leave_headings($this->sub_keys_leave_some, $this->sub_keys_leave_some_inconv, $this->rpt_content_leave_some, self::SOME);
        $this->sub_keys_leave_training_head = $this->generate_leave_headings($this->sub_keys_leave_training, $this->sub_keys_leave_training_inconv, $this->rpt_content_leave_training, self::TRAINING);
        
        $this->sub_keys_leave_voluntary_head = $this->generate_leave_headings($this->sub_keys_leave_voluntary, $this->sub_keys_leave_voluntary_inconv, $this->rpt_content_leave_voluntary, self::VOLUNTARY);
        $this->sub_keys_leave_standby_head = $this->generate_leave_headings($this->sub_keys_leave_standby, $this->sub_keys_leave_standby_inconv, $this->rpt_content_leave_standby, self::STANDBY);
        $this->sub_keys_leave_personal_head = $this->generate_leave_headings($this->sub_keys_leave_personal, $this->sub_keys_leave_personal_inconv, $this->rpt_content_leave_personal, self::PERSONAL);
        $this->sub_keys_leave_oncall_head = $this->generate_leave_headings($this->sub_keys_leave_oncall, $this->sub_keys_leave_oncall_inconv, $this->rpt_content_leave_oncall, self::ONCALL);
        $this->sub_keys_leave_calltraining_head = $this->generate_leave_headings($this->sub_keys_leave_calltraining, $this->sub_keys_leave_calltraining_inconv, $this->rpt_content_leave_calltraining, self::CALLTRAINING);
        $this->sub_keys_leave_more_oncall_head = $this->generate_leave_headings($this->sub_keys_leave_more_oncall, $this->sub_keys_leave_more_oncall_inconv, $this->rpt_content_leave_more_oncall, self::MORE_ONCALL);
        ksort($this->headings_leave);
        ksort($this->result_data_leave);
        ksort($this->total_leave);
        //echo "<pre>Leave Data".print_r($this->rpt_content_leave,1)."</pre>";;
        //echo count($this->headings_leave[1],1)-(cont($this->headings_leave[1])*3);
        //echo "<pre>Leave Data".print_r($this->total_leave,1)."</pre>";exit();
        //echo "<pre>Leave Data".print_r($this->result_data_leave,1)."</pre>";exit();

        //removing duplicate dates and sortig the dates
        $this->days_in_month = array_unique($this->days_in_month);
        sort($this->days_in_month);
        
        
    }

        //for generating headingd of leave type

    public function generate_leave_headings(&$sub_keys_leave, &$sub_keys_leave_inconv, $rpt_content, $key) {

        $type = $this->get_key_type($key);
        $ob_head = array_column($this->inconv_normal_category, 'name');
        $holiday_head = array_column($this->holidays, 'name');
        $oncall_head = array_column($this->inconv_oncall_category, 'name');
        $this->days_in_month = array_merge($this->days_in_month, array_keys($rpt_content));
        if(!empty($rpt_content))
            $this->headings_leave[100][0]['total'][0]['total'][0] = 'sum';
        if($key == self::NORMAL){
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $leave_type_key => $slot_details){
                    foreach($slot_details as $slot_type_key => $slot_duration){
                        if(in_array($slot_type_key, $ob_head)){
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][0]['normal'][1]['ob_normal'])){
                                $ob_sort_order = $this->inconv_normal_category[array_search($slot_type_key, $ob_head)]['sort_order'];
                                $this->headings_leave[$leave_type_key][0]['normal'][1]['ob_normal'][$ob_sort_order] = $slot_type_key;
                            }
                            if(array_key_exists($slot_type_key, $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][1]['ob_normal']))
                                $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][1]['ob_normal'][$slot_type_key] += $slot_duration;
                            else
                                $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][1]['ob_normal'][$slot_type_key] = $slot_duration;


                            if(array_key_exists($slot_type_key, $this->total_leave[$leave_type_key][0]['normal'][1]))
                                $this->total_leave[$leave_type_key][0]['normal'][1][$slot_type_key] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][0]['normal'][1][$slot_type_key] = $slot_duration;

                            
                        }elseif(in_array($slot_type_key, $holiday_head)){
                            $holiday_type_key = array_search($slot_type_key, $holiday_head);
                            $holiday_name = $this->holidays[$holiday_type_key]['name'];
                            
                            if(!in_array($holiday_name, $this->headings_leave[$leave_type_key][0]['normal'][2]['holiday_normal']))
                                $this->headings_leave[$leave_type_key][0]['normal'][2]['holiday_normal'][] = $holiday_name;
                            if(array_key_exists($holiday_name, $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][2]['holiday_normal']))
                                $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][2]['holiday_normal'][$holiday_name] += $slot_duration;
                            else   
                                $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][2]['holiday_normal'][$holiday_name] = $slot_duration;
                            if(array_key_exists($holiday_name, $this->total_leave[$leave_type_key][0]['normal'][2]))
                                $this->total_leave[$leave_type_key][0]['normal'][2][$holiday_name] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][0]['normal'][2][$holiday_name] = $slot_duration;

                            
                        }else{
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][0]['normal'][0]['base_normal']))
                                $this->headings_leave[$leave_type_key][0]['normal'][0]['base_normal'][] = $slot_type_key;
                            $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][0]['base_normal'][$type] = $slot_duration;

                            if(array_key_exists($type, $this->total_leave[$leave_type_key][0]['normal'][0]))
                                $this->total_leave[$leave_type_key][0]['normal'][0][$type] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][0]['normal'][0][$type] = $slot_duration;
                        }
                        if(!array_key_exists(3, $this->headings_leave[$leave_type_key][0]['normal'])){
                            $this->headings_leave[$leave_type_key][0]['normal'][3]['sum_normal'] = 'sum';                            
                        }
                        if(array_key_exists(3, $this->result_data_leave[$date_key][$leave_type_key][0]['normal']))
                            $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][3]['sum_normal']['sum'] += $slot_duration;
                        else
                            $this->result_data_leave[$date_key][$leave_type_key][0]['normal'][3]['sum_normal']['sum'] = $slot_duration;

                        if(array_key_exists('sum', $this->total_leave[$leave_type_key][0]['normal'][3]))
                            $this->total_leave[$leave_type_key][0]['normal'][3]['sum'] += $slot_duration;
                        else
                            $this->total_leave[$leave_type_key][0]['normal'][3]['sum'] = $slot_duration;

                        $this->result_data_leave[$date_key][100][0]['total'][0]['total']['sum'] += $slot_duration;
                        $this->total_leave[100][0]['total'][0]['sum'] += $slot_duration;
                    }
                    ksort($this->result_data_leave[$date_key]);
                    ksort($this->result_data_leave[$date_key][$leave_type_key][0]['normal']);
                    if(!empty($rpt_content)){
                        ksort($this->headings_leave[$leave_type_key][0]['normal']);
                        if(array_key_exists(1, $this->headings_leave[$leave_type_key][0]['normal']))
                            ksort($this->headings_leave[$leave_type_key][0]['normal'][1]['ob_normal']);
                        ksort($this->headings_leave[$leave_type_key]);
                        ksort($this->total_leave[$leave_type_key][0]['normal']);

                    }
                }

            }    
            
        }elseif($key == self::ONCALL){
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $leave_type_key => $slot_details){
                    foreach($slot_details as $slot_type_key => $slot_duration){
                        if(in_array($slot_type_key, $oncall_head)){
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][1]['oncall'][1]['ob_oncall'])){
                                $ob_oncall_sort_order = $this->inconv_oncall_category[array_search($slot_type_key, $oncall_head)]['sort_order'];
                                $this->headings_leave[$leave_type_key][1]['oncall'][1]['ob_oncall'][$ob_oncall_sort_order] = $slot_type_key;
                            }
                            if(array_key_exists($slot_type_key, $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][1]['ob_oncall']))
                                $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][1]['ob_oncall'][$slot_type_key] += $slot_duration;
                            else
                                $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][1]['ob_oncall'][$slot_type_key] = $slot_duration;
                            if(array_key_exists($slot_type_key, $this->total_leave[$leave_type_key][1]['oncall'][1]))
                                $this->total_leave[$leave_type_key][1]['oncall'][1][$slot_type_key] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][1]['oncall'][1][$slot_type_key] = $slot_duration;

                        }elseif(in_array($slot_type_key, $holiday_head)){            
                            $holiday_type_key = array_search($slot_type_key, $holiday_head);
                            $holiday_name = 'Jour '.$this->holidays[$holiday_type_key]['name'];
                            
                            if(!in_array($holiday_name, $this->headings_leave[$leave_type_key][1]['oncall'][2]['holiday_oncall']))
                                $this->headings_leave[$leave_type_key][1]['oncall'][2]['holiday_oncall'][] = $holiday_name;
                            if(array_key_exists($holiday_name, $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][2]['holiday_oncall']))
                                $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][2]['holiday_oncall'][$holiday_name] += $slot_duration;
                            else   
                                $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][2]['holiday_oncall'][$holiday_name] = $slot_duration;
                            if(array_key_exists($holiday_name, $this->total_leave[$leave_type_key][1]['oncall'][2]))
                                $this->total_leave[$leave_type_key][1]['oncall'][2][$holiday_name] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][1]['oncall'][2][$holiday_name] = $slot_duration;
                        }else{
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][1]['oncall'][0]['base_oncall']))
                                $this->headings_leave[$leave_type_key][1]['oncall'][0]['base_oncall'][] = $slot_type_key;
                            $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][0]['base_oncall'][$type] = $slot_duration;

                            if(array_key_exists($type, $this->total_leave[$leave_type_key][1]['oncall'][0]))
                                $this->total_leave[$leave_type_key][1]['oncall'][0][$type] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][1]['oncall'][0][$type] = $slot_duration;
                        }

                        if(!array_key_exists(3, $this->headings_leave[$leave_type_key][1]['oncall'])){
                            $this->headings_leave[$leave_type_key][1]['oncall'][3]['sum_oncall'] = 'sum';
                        }

                        if(array_key_exists(3, $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'])){
                            $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][3]['sum_oncall']['sum'] += $slot_duration;
                        }else{
                            $this->result_data_leave[$date_key][$leave_type_key][1]['oncall'][3]['sum_oncall']['sum'] = $slot_duration;
                        }
                        

                        if(array_key_exists('sum', $this->total_leave[$leave_type_key][1]['oncall'][3]))
                            $this->total_leave[$leave_type_key][1]['oncall'][3]['sum'] += $slot_duration;
                        else
                            $this->total_leave[$leave_type_key][1]['oncall'][3]['sum'] = $slot_duration;

                        $this->result_data_leave[$date_key][100][0]['total'][0]['total']['sum'] += $slot_duration;
                        $this->total_leave[100][0]['total'][0]['sum'] += $slot_duration;
                    }
                    ksort($this->result_data_leave[$date_key]);
                    ksort($this->result_data_leave[$date_key][$leave_type_key][1]['oncall']);
                    if(!empty($rpt_content)){
                        ksort($this->headings_leave[$leave_type_key][1]['oncall']);
                        if(array_key_exists(1, $this->headings_leave[$leave_type_key][1]['oncall']))
                            ksort($this->headings_leave[$leave_type_key][1]['oncall'][1]['ob_oncall']);
                        ksort($this->headings_leave[$leave_type_key]);
                        ksort($this->total_leave[$leave_type_key][1]['oncall']);

                    }   
                }

            }
             
        }elseif($key == self::CALLTRAINING || $key == self::COMPLEMENTARY_ONCALL || $key == self::MORE_ONCALL || $key == self:: DISMISSAL_ONCALL){
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $leave_type_key => $slot_details){
                    foreach($slot_details as $slot_type_key => $slot_duration){
                        if(in_array($slot_type_key, $oncall_head)){
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][3][$type][1]['ob_oncall'])){
                                $ob_oncall_sort_order = $this->inconv_oncall_category[array_search($slot_type_key, $oncall_head)]['sort_order'];
                                $this->headings_leave[$leave_type_key][3][$type][1]['ob_oncall'][$ob_oncall_sort_order] = $slot_type_key;
                            }
                            if(array_key_exists($slot_type_key, $this->result_data_leave[$date_key][$leave_type_key][3][$type][1]['ob_oncall']))
                                $this->result_data_leave[$date_key][$leave_type_key][3][$type][1]['ob_oncall'][$slot_type_key] += $slot_duration;
                            else
                                $this->result_data_leave[$date_key][$leave_type_key][3][$type][1]['ob_oncall'][$slot_type_key] = $slot_duration;
                            if(array_key_exists($slot_type_key, $this->total_leave[$leave_type_key][3][$type][1]))
                                $this->total_leave[$leave_type_key][3][$type][1][$slot_type_key] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][3][$type][1][$slot_type_key] = $slot_duration;

                        }elseif(in_array($slot_type_key, $holiday_head)){
                            $holiday_type_key = array_search($slot_type_key, $holiday_head);
                            $holiday_name = 'Jour '.$this->holidays[$holiday_type_key]['type'];
                            
                            if(!in_array($holiday_name, $this->headings_leave[$leave_type_key][3][$type][2]['holiday_oncall']))
                                $this->headings_leave[$leave_type_key][3][$type][2]['holiday_oncall'][] = $holiday_name;
                            if(array_key_exists($holiday_name, $this->result_data_leave[$date_key][$leave_type_key][3][$type][2]['holiday_oncall']))
                                $this->result_data_leave[$date_key][$leave_type_key][3][$type][2]['holiday_oncall'][$holiday_name] += $slot_duration;
                            else   
                                $this->result_data_leave[$date_key][$leave_type_key][3][$type][2]['holiday_oncall'][$holiday_name] = $slot_duration;
                            if(array_key_exists($holiday_name, $this->total_leave[$leave_type_key][3][$type][2]))
                                $this->total_leave[$leave_type_key][3][$type][2][$holiday_name] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][3][$type][2][$holiday_name] = $slot_duration;

                        }else{
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][3][$type][0]['base_oncall']))
                                $this->headings_leave[$leave_type_key][3][$type][0]['base_oncall'][] = $slot_type_key;
                            $this->result_data_leave[$date_key][$leave_type_key][3][$type][0]['base_oncall'][$type] = $slot_duration;

                            if(array_key_exists($type, $this->total_leave[$leave_type_key][3][$type][0]))
                                $this->total_leave[$leave_type_key][3][$type][0][$type] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][3][$type][0][$type] = $slot_duration;
                        }

                        if(!array_key_exists(3, $this->headings_leave[$leave_type_key][3][$type])){
                            $this->headings_leave[$leave_type_key][3][$type][3]['sum_oncall'] = 'sum';
                        }

                        if(array_key_exists(3, $this->result_data_leave[$date_key][$leave_type_key][3][$type])){
                            $this->result_data_leave[$date_key][$leave_type_key][3][$type][3]['sum_oncall']['sum'] += $slot_duration;
                        }else{
                            $this->result_data_leave[$date_key][$leave_type_key][3][$type][3]['sum_oncall']['sum'] = $slot_duration;
                        } 

                        if(array_key_exists('sum', $this->total_leave[$leave_type_key][3][$type][3]))
                            $this->total_leave[$leave_type_key][3][$type][3]['sum'] += $slot_duration;
                        else
                            $this->total_leave[$leave_type_key][3][$type][3]['sum'] = $slot_duration;

                        $this->result_data_leave[$date_key][100][0]['total'][0]['total']['sum'] += $slot_duration;
                        $this->total_leave[100][0]['total'][0]['sum'] += $slot_duration;

                    }
                    ksort($this->result_data_leave[$date_key]);
                    ksort($this->result_data_leave[$date_key][$leave_type_key][3][$type]);
                    if(!empty($rpt_content)){
                        ksort($this->headings_leave[$leave_type_key][3][$type]);
                        if(array_key_exists(1, $this->headings_leave[$leave_type_key][3][$type]))
                            ksort($this->headings_leave[$leave_type_key][3][$type][1]['ob_oncall']);
                        ksort($this->headings_leave[$leave_type_key]);
                        ksort($this->total_leave[$leave_type_key][3][$type]);

                    }  
                }

            }

                
        }else{
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $leave_type_key => $slot_details){
                    foreach($slot_details as $slot_type_key => $slot_duration){
                        if(in_array($slot_type_key, $ob_head)){
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][2][$type][1]['ob_normal'])){
                                $ob_sort_order = $this->inconv_normal_category[array_search($slot_type_key, $ob_head)]['sort_order'];
                                $this->headings_leave[$leave_type_key][2][$type][1]['ob_normal'][$ob_sort_order] = $slot_type_key;
                            }
                            if(array_key_exists($slot_type_key, $this->result_data_leave[$date_key][$leave_type_key][2][$type][1]['ob_normal']))
                                $this->result_data_leave[$date_key][$leave_type_key][2][$type][1]['ob_normal'][$slot_type_key] += $slot_duration;
                            else
                                $this->result_data_leave[$date_key][$leave_type_key][2][$type][1]['ob_normal'][$slot_type_key] = $slot_duration;
                            if(array_key_exists($slot_type_key, $this->total_leave[$leave_type_key][2][$type][1]))
                                $this->total_leave[$leave_type_key][2][$type][1][$slot_type_key] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][2][$type][1][$slot_type_key] = $slot_duration;

                        }elseif(in_array($slot_type_key, $holiday_head)){
                            $holiday_type_key = array_search($slot_type_key, $holiday_head);
                            $holiday_name = $this->holidays[$holiday_type_key]['name'];
                            
                            if(!in_array($holiday_name, $this->headings_leave[$leave_type_key][2][$type][2]['holiday_normal']))
                                $this->headings_leave[$leave_type_key][2][$type][2]['holiday_normal'][] = $holiday_name;
                            if(array_key_exists($holiday_name, $this->result_data_leave[$date_key][$leave_type_key][2][$type][2]['holiday_normal']))
                                $this->result_data_leave[$date_key][$leave_type_key][2][$type][2]['holiday_normal'][$holiday_name] += $slot_duration;
                            else   
                                $this->result_data_leave[$date_key][$leave_type_key][2][$type][2]['holiday_normal'][$holiday_name] = $slot_duration;
                            if(array_key_exists($holiday_name, $this->total_leave[$leave_type_key][2][$type][2]))
                                $this->total_leave[$leave_type_key][2][$type][2][$holiday_name] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][2][$type][2][$holiday_name] = $slot_duration;

                        }else{
                            if(!in_array($slot_type_key, $this->headings_leave[$leave_type_key][2][$type][0]['base_normal']))
                                $this->headings_leave[$leave_type_key][2][$type][0]['base_normal'][] = $slot_type_key;
                            $this->result_data_leave[$date_key][$leave_type_key][2][$type][0]['base_normal'][$type] = $slot_duration;

                            if(array_key_exists($type, $this->total_leave[$leave_type_key][2][$type][0]))
                                $this->total_leave[$leave_type_key][2][$type][0][$type] += $slot_duration;
                            else
                                $this->total_leave[$leave_type_key][2][$type][0][$type] = $slot_duration;
                        }

                        if(!array_key_exists(3, $this->headings_leave[$leave_type_key][2][$type])){
                            $this->headings_leave[$leave_type_key][2][$type][3]['sum_normal'] = 'sum';
                        }

                        if(array_key_exists(3, $this->result_data_leave[$date_key][$leave_type_key][2][$type])){
                            $this->result_data_leave[$date_key][$leave_type_key][2][$type][3]['sum_normal']['sum'] += $slot_duration;
                        }else{
                            $this->result_data_leave[$date_key][$leave_type_key][2][$type][3]['sum_normal']['sum'] = $slot_duration;
                        } 

                        if(array_key_exists('sum', $this->total_leave[$leave_type_key][2][$type][3]))
                            $this->total_leave[$leave_type_key][2][$type][3]['sum'] += $slot_duration;
                        else
                            $this->total_leave[$leave_type_key][2][$type][3]['sum'] = $slot_duration;

                        $this->result_data_leave[$date_key][100][0]['total'][0]['total']['sum'] += $slot_duration;
                        $this->total_leave[100][0]['total'][0]['sum'] += $slot_duration;

                    }
                    ksort($this->result_data_leave[$date_key]);
                    ksort($this->result_data_leave[$date_key][$leave_type_key][2][$type]);
                    if(!empty($rpt_content)){
                        ksort($this->headings_leave[$leave_type_key][2][$type]);
                        if(array_key_exists(1, $this->headings_leave[$leave_type_key][2][$type]))
                            ksort($this->headings_leave[$leave_type_key][2][$type][1]['ob_normal']);
                        ksort($this->headings_leave[$leave_type_key]);
                        ksort($this->total_leave[$leave_type_key][2][$type]);

                    }
                }

            }    
            
        }
        
    }

    //for genarating headings of normal type
    public function generate_headings($rpt_content, $key) {

        $type = $this->get_key_type($key);
        $ob_head = array_column($this->inconv_normal_category, 'name');
        $holiday_head = array_column($this->holidays, 'name');
        $oncall_head = array_column($this->inconv_oncall_category, 'name');
        $this->days_in_month = array_merge($this->days_in_month, array_keys($rpt_content));
        //echo "<pre>".print_r($rpt_content, 1)."</pre>";exit();
        if($key == self::NORMAL){
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $slot_type_key => $slot_duration){
                    if(in_array($slot_type_key, $ob_head)){
                        if(!in_array($slot_type_key, $this->headings[0]['normal'][1]['ob_normal'])){
                            $ob_sort_order = $this->inconv_normal_category[array_search($slot_type_key, $ob_head)]['sort_order'];
                            //echo $slot_type_key.$ob_sort_order."<br>";
                            $this->headings[0]['normal'][1]['ob_normal'][$ob_sort_order] = $slot_type_key;
                        }
                        if(array_key_exists($slot_type_key, $this->result_data[$date_key][0]['normal'][1]['ob_normal']))
                            $this->result_data[$date_key][0]['normal'][1]['ob_normal'][$slot_type_key] += $slot_duration;
                        else
                            $this->result_data[$date_key][0]['normal'][1]['ob_normal'][$slot_type_key] = $slot_duration;
                        if(array_key_exists($slot_type_key, $this->total[0]['normal'][1]))
                            $this->total[0]['normal'][1][$slot_type_key] += $slot_duration;
                        else
                            $this->total[0]['normal'][1][$slot_type_key] = $slot_duration;

                    }elseif(in_array($slot_type_key, $holiday_head)){
                        $holiday_type_key = array_search($slot_type_key, $holiday_head);
                        $holiday_name = $this->holidays[$holiday_type_key]['name'];
                        
                        if(!in_array($holiday_name, $this->headings[0]['normal'][2]['holiday_normal']))
                            $this->headings[0]['normal'][2]['holiday_normal'][] = $holiday_name;
                        if(array_key_exists($holiday_name, $this->result_data[$date_key][0]['normal'][2]['holiday_normal']))
                            $this->result_data[$date_key][0]['normal'][2]['holiday_normal'][$holiday_name] += $slot_duration;
                        else   
                            $this->result_data[$date_key][0]['normal'][2]['holiday_normal'][$holiday_name] = $slot_duration;
                        if(array_key_exists($holiday_name, $this->total[0]['normal'][2]))
                            $this->total[0]['normal'][2][$holiday_name] += $slot_duration;
                        else
                            $this->total[0]['normal'][2][$holiday_name] = $slot_duration;

                            
                    }else{
                        //$this->initialise_array($this->headings)
                        if(!in_array($slot_type_key, $this->headings[0]['normal'][0]['base_normal']))
                            $this->headings[0]['normal'][0]['base_normal'][] = $slot_type_key;
                        $this->result_data[$date_key][0]['normal'][0]['base_normal'][$type] = $slot_duration;

                        if(array_key_exists($type, $this->total[0]['normal'][0]))
                            $this->total[0]['normal'][0][$type] += $slot_duration;
                        else
                            $this->total[0]['normal'][0][$type] = $slot_duration;
                    }
                    if(array_key_exists(3, $this->headings[0]['normal'])){
                        $this->result_data[$date_key][0]['normal'][3]['sum_normal']['sum'] += $slot_duration;
                    }else{
                        $this->headings[0]['normal'][3]['sum_normal'] = 'sum';
                        $this->result_data[$date_key][0]['normal'][3]['sum_normal']['sum'] = $slot_duration;
                    } 

                    if(array_key_exists('sum', $this->total[0]['normal'][3]))
                        $this->total[0]['normal'][3]['sum'] += $slot_duration;
                    else
                        $this->total[0]['normal'][3]['sum'] = $slot_duration;
                }
                ksort($this->result_data[$date_key]);
            }
            if(!empty($rpt_content)){
                ksort($this->headings[0]['normal']);
                if(array_key_exists(1, $this->headings[0]['normal']))
                    ksort($this->headings[0]['normal'][1]['ob_normal']);
                ksort($this->headings);
                ksort($this->total[0]['normal']);

            }
        }
        elseif($key == self::ONCALL){
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $slot_type_key => $slot_duration){
                    if(in_array($slot_type_key, $oncall_head)){
                        if(!in_array($slot_type_key, $this->headings[1]['oncall'][1]['ob_oncall'])){
                            $ob_oncall_sort_order = $this->inconv_oncall_category[array_search($slot_type_key, $oncall_head)]['sort_order'];
                            $this->headings[1]['oncall'][1]['ob_oncall'][$ob_oncall_sort_order] = $slot_type_key;
                        }
                        if(array_key_exists($slot_type_key, $this->result_data[$date_key][1]['oncall'][1]['ob_oncall']))
                            $this->result_data[$date_key][1]['oncall'][1]['ob_oncall'][$slot_type_key] += $slot_duration;
                        else
                            $this->result_data[$date_key][1]['oncall'][1]['ob_oncall'][$slot_type_key] = $slot_duration;
                        if(array_key_exists($slot_type_key, $this->total[1]['oncall'][1]))
                            $this->total[1]['oncall'][1][$slot_type_key] += $slot_duration;
                        else
                            $this->total[1]['oncall'][1][$slot_type_key] = $slot_duration;
                                                          
                    }elseif(in_array($slot_type_key, $holiday_head)){
                        $holiday_type_key = array_search($slot_type_key, $holiday_head);
                        $holiday_name = $this->holidays[$holiday_type_key]['name'];
                        
                        if(!in_array('Jour '. $holiday_name, $this->headings[1]['oncall'][2]['holiday_oncall']))
                            $this->headings[1]['oncall'][2]['holiday_oncall'][] = 'Jour '. $holiday_name;
                        if(array_key_exists('Jour '. $holiday_name, $this->result_data[$date_key][1]['oncall'][2]['holiday_oncall']))
                            $this->result_data[$date_key][1]['oncall'][2]['holiday_oncall']['Jour '. $holiday_name] += $slot_duration;
                        else   
                            $this->result_data[$date_key][1]['oncall'][2]['holiday_oncall']['Jour '. $holiday_name] = $slot_duration;
                        if(array_key_exists('Jour '. $holiday_name, $this->total[1]['oncall'][2]))
                            $this->total[1]['oncall'][2]['Jour '. $holiday_name] += $slot_duration;
                        else
                            $this->total[1]['oncall'][2]['Jour '. $holiday_name] = $slot_duration;
                    }else{
                        if(!in_array($slot_type_key, $this->headings[1]['oncall'][0]['base_oncall']))
                            $this->headings[1]['oncall'][0]['base_oncall'][] = $slot_type_key;
                        $this->result_data[$date_key][1]['oncall'][0]['base_oncall'][$type] = $slot_duration;
                        
                        if(array_key_exists($type, $this->total[1]['oncall'][0]))
                            $this->total[1]['oncall'][0][$type] += $slot_duration;
                        else
                            $this->total[1]['oncall'][0][$type] = $slot_duration;
                    }
                    if(array_key_exists(3, $this->headings[1]['oncall'])){
                        $this->result_data[$date_key][1]['oncall'][3]['sum_oncall']['sum'] += $slot_duration;
                    }else{
                        $this->headings[1]['oncall'][3]['sum_oncall'] = 'sum';
                        $this->result_data[$date_key][1]['oncall'][3]['sum_oncall']['sum'] = $slot_duration;
                    }
                    if(array_key_exists('sum', $this->total[1]['oncall'][3]))
                        $this->total[1]['oncall'][3]['sum'] += $slot_duration;
                    else
                        $this->total[1]['oncall'][3]['sum'] = $slot_duration; 
                }
                ksort($this->result_data[$date_key]);
            }
            if(!empty($rpt_content)){
                ksort($this->headings[1]['oncall']);
                if(array_key_exists(1, $this->headings[1]['oncall']))
                    ksort($this->headings[1]['oncall'][1]['ob_oncall']);
                ksort($this->headings);
                ksort($this->total[1]['oncall']);
            }

        }elseif($key == self::CALLTRAINING || $key == self::COMPLEMENTARY_ONCALL || $key == self::MORE_ONCALL || $key == self:: DISMISSAL_ONCALL){

            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $slot_type_key => $slot_duration){
                    if(in_array($slot_type_key, $oncall_head)){
                        if(!in_array($slot_type_key, $this->headings[3][$type][1]['ob_oncall'])){
                            $ob_oncall_sort_order = $this->inconv_oncall_category[array_search($slot_type_key, $oncall_head)]['sort_order'];

                            $this->headings[3][$type][1]['ob_oncall'][$ob_oncall_sort_order] = $slot_type_key;
                        }
                        if(array_key_exists($slot_type_key, $this->result_data[$date_key][3][$type][1]['ob_oncall']))
                            $this->result_data[$date_key][3][$type][1]['ob_oncall'][$slot_type_key] += $slot_duration;
                        else
                            $this->result_data[$date_key][3][$type][1]['ob_oncall'][$slot_type_key] = $slot_duration;
                        if(array_key_exists($slot_type_key, $this->total[3][$type][1]))
                            $this->total[3][$type][1][$slot_type_key] += $slot_duration;
                        else
                            $this->total[3][$type][1][$slot_type_key] = $slot_duration;                              
                    }elseif(in_array($slot_type_key, $holiday_head)){
                        $holiday_type_key = array_search($slot_type_key, $holiday_head);
                        $holiday_name = $this->holidays[$holiday_type_key]['name'];
                        
                        if(!in_array('Jour '. $holiday_name, $this->headings[3][$type][2]['holiday_oncall']))
                            $this->headings[3][$type][2]['holiday_oncall'][] = 'Jour '. $holiday_name;
                        if(array_key_exists('Jour '. $holiday_name, $this->result_data[$date_key][3][$type][2]['holiday_oncall']))
                            $this->result_data[$date_key][3][$type][2]['holiday_oncall']['Jour '. $holiday_name] += $slot_duration;
                         else   
                            $this->result_data[$date_key][3][$type][2]['holiday_oncall']['Jour '. $holiday_name] = $slot_duration;
                        if(array_key_exists('Jour '. $holiday_name, $this->total[3][$type][2]))
                            $this->total[3][$type][2]['Jour '. $holiday_name] += $slot_duration;
                        else
                            $this->total[3][$type][2]['Jour '. $holiday_name] = $slot_duration;
                           
                    }else{
                        if(!in_array($slot_type_key, $this->headings[3][$type][0]['base_oncall']))
                            $this->headings[3][$type][0]['base_oncall'][] = $slot_type_key;
                        $this->result_data[$date_key][3][$type][0]['base_oncall'][$type] = $slot_duration;

                        if(array_key_exists($type, $this->total[3][$type][0]))
                            $this->total[3][$type][0][$type] += $slot_duration;
                        else
                            $this->total[3][$type][0][$type] = $slot_duration;
                    }
                    if(array_key_exists(3, $this->headings[3][$type])){
                        $this->result_data[$date_key][3][$type][3]['sum_'.$type]['sum'] += $slot_duration;
                    }else{
                        $this->headings[3][$type][3]['sum_'.$type] = 'sum';
                        $this->result_data[$date_key][3][$type][3]['sum_'.$type]['sum'] = $slot_duration;
                    }
                    if(array_key_exists('sum', $this->total[3][$type][3]))
                        $this->total[3][$type][3]['sum'] += $slot_duration;
                    else
                        $this->total[3][$type][3]['sum'] = $slot_duration;  

                }
                ksort($this->result_data[$date_key]);
            }
            if(!empty($rpt_content)){
                ksort($this->headings[3][$type]);
                if(array_key_exists(1, $this->headings[3][$type]))
                    ksort($this->headings[3][$type][1]['ob_oncall']);
                ksort($this->headings);
                ksort($this->total[3][$type]);    
            }
        }else{
            foreach($rpt_content as $date_key => $date_array){
                foreach($date_array as $slot_type_key => $slot_duration){
                    if(in_array($slot_type_key, $ob_head)){
                        if(!in_array($slot_type_key, $this->headings[2][$type][1]['ob_normal'])){
                            $ob_sort_order = $this->inconv_normal_category[array_search($slot_type_key, $ob_head)]['sort_order'];
                            $this->headings[2][$type][1]['ob_normal'][$ob_sort_order] = $slot_type_key;
                        }
                        if(array_key_exists($slot_type_key, $this->result_data[$date_key][2][$type][1]['ob_normal']))
                            $this->result_data[$date_key][2][$type][1]['ob_normal'][$slot_type_key] += $slot_duration;
                        else
                            $this->result_data[$date_key][2][$type][1]['ob_normal'][$slot_type_key] = $slot_duration;
                        if(array_key_exists($slot_type_key, $this->total[2][$type][1]))
                            $this->total[2][$type][1][$slot_type_key] += $slot_duration;
                        else
                            $this->total[2][$type][1][$slot_type_key] = $slot_duration;                              
                    }elseif(in_array($slot_type_key, $holiday_head)){
                        $holiday_type_key = array_search($slot_type_key, $holiday_head);
                        $holiday_name = $this->holidays[$holiday_type_key]['name'];
                        
                            if(!in_array($holiday_name, $this->headings[2][$type][2]['holiday_normal']))
                                $this->headings[2][$type][2]['holiday_normal'][] = $holiday_name;
                            if(array_key_exists($holiday_name, $this->result_data[$date_key][2][$type][2]['holiday_normal']))
                                $this->result_data[$date_key][2][$type][2]['holiday_normal'][$holiday_name] += $slot_duration;
                             else   
                                $this->result_data[$date_key][2][$type][2]['holiday_normal'][$holiday_name] = $slot_duration;
                            if(array_key_exists($holiday_name, $this->total[2][$type][2]))
                                $this->total[2][$type][2][$holiday_name] += $slot_duration;
                            else
                                $this->total[2][$type][2][$holiday_name] = $slot_duration;
                    }else{
                        if(!in_array($slot_type_key, $this->headings[2][$type][0]['base_normal']))
                            $this->headings[2][$type][0]['base_normal'][] = $slot_type_key;
                        $this->result_data[$date_key][2][$type][0]['base_normal'][$type] = $slot_duration;
                        if(array_key_exists($type, $this->total[2][$type][0]))
                            $this->total[2][$type][0][$type] += $slot_duration;
                        else
                            $this->total[2][$type][0][$type] = $slot_duration;
                    }
                    if(array_key_exists(3, $this->headings[2][$type])){
                        $this->result_data[$date_key][2][$type][3]['sum_'.$type]['sum'] += $slot_duration;
                    }else{
                        $this->headings[2][$type][3]['sum_'.$type] = 'sum';
                        $this->result_data[$date_key][2][$type][3]['sum_'.$type]['sum'] = $slot_duration;
                    }
                    if(array_key_exists('sum', $this->total[2][$type][3]))
                        $this->total[2][$type][3]['sum'] += $slot_duration;
                    else
                        $this->total[2][$type][3]['sum'] = $slot_duration; 
                }
                ksort($this->result_data[$date_key]);
            }
            if(!empty($rpt_content)){
                ksort($this->headings[2][$type]);
                if(array_key_exists(1, $this->headings[2][$type]))
                    ksort($this->headings[2][$type][1]['ob_normal']);

                ksort($this->headings);
                ksort($this->total[2][$type]);
            }
        }
        
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
        //$fkkn_slot_types = array(0,1,2,4,5,6,7,12,3,13,14);
        $fkkn_slot_types = array(0,3,4,5,6,12,13,14,15);
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
                $rpt_content[$inconv_normal_slot['date']][$holiday['name']] += $time_duration = round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
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
                if ($flag == 1){
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