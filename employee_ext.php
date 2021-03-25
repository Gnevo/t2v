<?php

/**
 * Description of employee_ext
 * @author dona
 */
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once ('class/user.php');
require_once ('class/customer.php');
require_once ('class/mail.php');
require_once ('class/sms.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/db.php');
require_once ('class/employee.php');
require_once ('class/inconvenient_timing.php');
//require_once ('plugins/message.class.php');
require_once ('class/dona.php');

require_once('class/contract.php');
require_once('class/company.php');
require_once('class/equipment.php');
require_once('class/copy_paste.php');

class employee_ext extends db {

    //variable diclaration
    var $username = '';
    var $password = '';
    var $role = '';
    var $login = 0;
    var $code = '';
    var $rpt_customer = '';
    var $social_security = '';
    var $first_name = '';
    var $last_name = '';
    var $address = '';
    var $city = '';
    var $post = '';
    var $phone = '';
    var $mobile = '';
    var $email = '';
    var $date = '';
    var $works = array();
    var $color_code = '';
    var $status = '';
    var $substitute = 0;
    var $team_id = '';
    var $team_members = '';
    var $tl = '';
    var $user = '';
    var $date_from = '';
    var $date_to = '';
    var $hours = '';
    var $key = '';
    var $works_id = '';
    var $signing_report_date = NULL;
    var $signing_employee = '';
    var $signing_employee_date = NULL;
    var $signing_TL_date = NULL;
    var $signing_TL_employee = '';
    var $signing_suTL_date = NULL;
    var $signing_suTL_employee = '';
    var $signing_xml = NULL;
    var $signing_xml_storage = FALSE;
    var $signauture = '';
    var $ocs = '';
    var $employee_sign = '';
    var $tl_sign = '';
    var $sutl_sign = '';
    var $employee_ocs = '';
    var $tl_ocs = '';
    var $sutl_ocs = '';
    var $inconvient_slots = array();
    var $leave_id = '';
    var $leave_status = '';
    var $swap = '';
    var $process = '';
    var $add_slot = '';
    var $fkkn = '';
    var $slot_type = '';
    var $add_customer = '';
    var $add_employee = '';
    var $leave = '';
    var $copy_single_slot = '';
    var $copy_single_slot_option = '';
    var $copy_day_slot = '';
    var $copy_day_slot_option = '';
    var $delete_slot = '';
    var $delete_day_slot = '';
    var $remove_customer = '';
    var $remove_employee = '';
    var $customer_schedule = '';
    var $employee_schedule = '';
    var $monthly_work = '';
    var $form_fkkn = '';
    var $form_leave = '';
    var $form_certificate = '';
    var $general_add_employee = '';
    var $general_edit_employee = '';
    var $general_edit_customer = '';
    var $general_add_customer = '';
    var $general_inconvenient_timing = '';
    var $general_administration = '';
    var $general_chat = '';
    var $mc_leave_notification = '';
    var $mc_leave_approval = '';
    var $mc_leave_rejection = '';
    var $mc_notes_attchment = '';
    var $mc_leave_edit = '';
    var $cirrus_mail = '';
    var $external_mail = '';
    var $mc_notes = '';
    var $mc_sms = '';
    var $mc_notes_approval = '';
    var $mc_notes_rejection = '';
    var $inactive_date = '';
    var $century = '';
    var $report_customer_data = '';
    var $report_customer_leave = '';
    var $report_customer_granded_vs_used = '';
    var $report_customer_employee_connection = '';
    var $report_customer_horizontal = '';
    var $report_customer_overview = '';
    var $report_customer_vacation_planning = '';
    var $report_employee_data = '';
    var $report_employee_leave = '';
    var $report_employee_percentage = '';
    var $report_atl_warning = '';
    var $report_customer_overlapping = '';
    var $effect_from_normal = '';
    var $effect_to_normal = '';
    var $normal = '';
    var $travel = '';
    var $week_end_travel = '';
    var $break = '';
    var $overtime = '';
    var $quality_overtime = '';
    var $on_call = '';
    var $more_time = '';
    var $some_other_time = '';
    var $training_time = '';
    var $call_training = '';
    var $personal_meeting = '';
    var $voluntary = 0;
    var $complementary = 0;
    var $complementary_oncall = 0;
    var $more_oncall = 0;
    var $standby = 0;
    var $work_for_dismissal = 0;
    var $work_for_dismissal_oncall = 0;
    var $holiday_big = '';
    var $holiday_red = '';
    var $holiday_big_oncall = '';
    var $holiday_red_oncall = '';
    var $insurance = '';
    var $oncall_holiday = '';
    var $oncall_bigholiday = '';
    var $inconvinient_evening = '';
    var $inconvinient_night = '';
    var $inconvinient_holiday = '';
    var $inconvinient_week_holiday = '';
    var $salary_per_hour = '';
    var $salary_per_month = '';
    var $monthly_salary = '';
    var $inconv_group_id = '';
    var $effect_from_inconv = '';
    var $effect_to_inconv = '';
    var $amount_inconv = '';
    var $last_inconv_id = '';
    var $last_normal_id = '';
    var $last_emp_sal_id = '';
    var $hourly_salary = '';
    var $start_day = '';
    var $gender = '';
    var $delete_multiple_slots = '';
    var $atl_override = '';
    var $contract_override = '';
    var $general_survey = '';
    var $change_time = '';
    var $general_create_template = '';
    var $general_use_template = '';
    var $no_pay_leave = '';
    var $general_candg = '';
    var $general_candg_wo = '';
    var $candg_approve = '';
    var $remaining_sem_leave = '';
    var $sem_leave_todate = '';
    var $sem_leave = '';
    var $leave_in_advance = '';
    var $use_inconvenient = NULL;
    var $care_of = NULL;
    var $show_percentage_month = '';
    var $mobile_search = '';
    var $employer_signing = '';
    var $candg_stop_other_emps = '';
    var $mc_document_archive = '';
    var $mc_support = '';
    var $sal_call_training = 0.00;
    var $sal_complementary_oncall = 0.00;
    var $sal_more_oncall = 0.00;
    var $sal_dismissal_oncall = 0.00;
    var $office_personal = 0;
    var $salary_type = 0;
    var $sem_leave_days = 0;
    var $vab_leave_days = 0;
    var $fp_leave_days = 0;
    var $nopay_leave_days = 0;
    var $other_leave_days = 0;
    var $ice = NULL;

    function __construct() {

        parent::__construct();
    }

    function get_customer_day_slots($date, $customer, $team_employees) {
        if($date == '' || $customer == '') return array();

        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        $obj_emp = new employee();
        $tl_customers = array();
        $tl_employees = array();
        $tl_all_customers = array();
        $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
            $temp_tl_customers = $obj_emp->customers_list_for_right_click($_SESSION['user_id']);
            foreach ($temp_tl_employees as $temp_tl_employee) {
                $tl_employees[] = $temp_tl_employee['username'];
            }
            foreach ($temp_tl_customers as $temp_tl_customer) {
                $tl_customers[] = $temp_tl_customer['username'];
            }

            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($_SESSION['user_id']);
            $this->query_generate();

            $datas = $this->query_fetch(2);
            foreach ($datas as $data) {
                $tl_all_customers[] = $data;
            }
        }

        $team_employee_string = '\'' . implode('\' , \'', $team_employees) . '\'';
        
        $this->sql_query = "SELECT t.id, t.employee, e.first_name as emp_first_name, e.last_name as emp_last_name, c.first_name as cust_first_name, c.last_name as cust_last_name, t.customer, t.date, t.time_from, t.time_to, t.status, t.created_status, t.type, t.fkkn, t.alloc_emp, t.comment, t.alloc_comment, t.cust_comment, r.employee as signed_employee, e.color as employee_color
            FROM timetable t 
            INNER JOIN employee e ON t.employee = e.username 
            LEFT JOIN customer c ON t.customer = c.username 
            LEFT JOIN report_signing r ON t.employee = r.employee AND t.customer = r.customer AND MONTH(r.date) = ".$month." AND YEAR(r.date) = ".$year."
            WHERE t.customer = '".$customer."' 
            AND t.date = '".$date."' 
            AND t.employee IN (".$team_employee_string.") ";
        if($_SESSION['company_sort_by'] == 1){
            $this->sql_query .= " ORDER BY LOWER(e.first_name) collate utf8_bin ASC, LOWER(e.last_name) collate utf8_bin ASC";
        }else{
            $this->sql_query .= " ORDER BY LOWER(e.last_name) collate utf8_bin ASC, LOWER(e.first_name) collate utf8_bin ASC";
        }
        $this->sql_query .= ", time_from";
        
        $slots = $this->query_fetch();
        //if($_COOKIE['debug'] == 'true') echo '<pre>'.print_r($slots, 1).'</pre>'; exit();
        // echo "<pre>". print_r($this->query_error_details, 1)."</pre>";
        $datas = array();
        $prev_time_to = 0.00;
        $prev_employee = '';
        foreach ($slots as $slot) {
            $signed_in = 0;
            $show_details = 1;
            if($slot['signed_employee']){
                $signed_in = 1;
            }
            
            if ($_SESSION['company_sort_by'] == 1) {
                $slot_customer = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
            } else {
                $slot_customer = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
            }
            $slot_difference = 0;
            if($slot['employee'] !=  $prev_employee)
                $prev_time_to = 0.00;
            if($prev_time_to != $slot['time_from'])
                $slot_difference = $obj_emp->time_difference($prev_time_to, $slot['time_from'], 100);
            $tl_flag = 1;
            if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                if ($slot['employee'] != '' && $slot['customer'] != '') {
                    if (!in_array($slot['employee'], $tl_employees) && !in_array($slot['customer'], $tl_customers)) {
                        $tl_flag = 0;
                    }
                }
                if ((!in_array($slot['customer'], $tl_all_customers)) && $slot['employee'] != '' && $slot['customer'] != '') {
                    $tl_flag = 0;
                    $slot_customer = $smarty->translate['works_on_another_customer'];
                    $show_details = 0;
                } 
            } elseif ($_SESSION['user_role'] == 3) {
                if ($slot['employee'] != '' && $slot['customer'] != '' && $slot['employee'] != $_SESSION['user_id']) {
                    $tl_flag = 0;
                    //$slot_customer = $smarty->translate['works_on_another_customer'];
                }
            } elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                $tl_flag = 0;
                //$slot_customer = $smarty->translate['works_on_another_customer'];
            }

            // if ($customer == '' && $slot['customer'] != '')
            //     $temp_privilege = $this->get_privileges($_SESSION['user_id'], 1, $slot['customer']);

            $slot_type_class = $slot_type_label = '';
            switch($slot['type']){
                case '1': $slot_type_class = 'slot-icon-small-travel'; $slot_type_label = $smarty->translate['travel']; break;
                case '0': $slot_type_class = 'slot-icon-small-normal'; $slot_type_label = $smarty->translate['normal']; break;
                case '2': $slot_type_class = 'slot-icon-small-break'; $slot_type_label = $smarty->translate['break']; break;
                case '3': $slot_type_class = 'slot-icon-small-oncall'; $slot_type_label = $smarty->translate['oncall']; break;
                case '4': $slot_type_class = 'slot-icon-small-over-time'; $slot_type_label = $smarty->translate['overtime']; break;
                case '5': $slot_type_class = 'slot-icon-small-qualtiy-overtime'; $slot_type_label = $smarty->translate['qual_overtime']; break;
                case '6': $slot_type_class = 'slot-icon-small-more-time'; $slot_type_label = $smarty->translate['more_time']; break;
                case '14': $slot_type_class = 'slot-icon-small-oncall-moretime'; $slot_type_label = $smarty->translate['more_oncall']; break;
                case '7': $slot_type_class = 'slot-icon-small-some-other-time'; $slot_type_label = $smarty->translate['some_other_time']; break;
                case '8': $slot_type_class = 'slot-icon-small-training'; $slot_type_label = $smarty->translate['training_time']; break;
                case '9': $slot_type_class = 'slot-icon-small-call-training'; $slot_type_label = $smarty->translate['call_training']; break;
                case '10': $slot_type_class = 'slot-icon-small-personal-meeting'; $slot_type_label = $smarty->translate['personal_meeting']; break;
                case '11': $slot_type_class = 'slot-icon-small-voluntary'; $slot_type_label = $smarty->translate['voluntary']; break;
                case '12': $slot_type_class = 'slot-icon-small-complimentary'; $slot_type_label = $smarty->translate['complementary']; break;
                case '13': $slot_type_class = 'slot-icon-small-complimentary-oncall'; $slot_type_label = $smarty->translate['complementary_oncall']; break;
                case '15': $slot_type_class = 'slot-icon-small-standby'; $slot_type_label = $smarty->translate['oncall_standby']; break;
                case '16': $slot_type_class = 'slot-icon-small-dismissal'; $slot_type_label = $smarty->translate['work_for_dismissal']; break;
                case '17': $slot_type_class = 'slot-icon-small-dismissal-oncall'; $slot_type_label = $smarty->translate['work_for_dismissal_oncall']; break;
            }

            $datas[$slot['employee']]['name'] = $emp_name;
            $datas[$slot['employee']]['show_details'] = $show_details;
            $temp_slots = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => str_pad($slot['time_from'],5,'0',STR_PAD_LEFT), 'slot_to' => str_pad($slot['time_to'],5,'0',STR_PAD_LEFT), 'slot_hour' => $obj_emp->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot_customer, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'], 'signed' => $signed_in, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'slot_difference' => $slot_difference, 'employee_color' => $slot['employee_color'], 'customer_color' => $slot['customer_color'], 'slot_type_class' => $slot_type_class, 'slot_type_label' => $slot_type_label);
            $datas[$slot['employee']]['slots'][] = $temp_slots;
            $prev_time_to = $slot['time_to'];
            $prev_employee = $slot['employee'];
        }
        //print_r($datas);
        return $datas;
    } 

    function get_customer_day_unmanned_slots($date, $customer) {
        if($date == '' || $customer == '') return array();

        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        $obj_emp = new employee();
        $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));


        $this->sql_query = "SELECT t.id, t.employee, '' as emp_first_name, '' as emp_last_name, c.first_name as cust_first_name, c.last_name as cust_last_name, t.customer, t.date, t.time_from, t.time_to, t.status, t.created_status, t.type, t.fkkn, t.alloc_emp, t.comment, t.alloc_comment, t.cust_comment, '' as signed_employee, '' as employee_color
            FROM timetable t 
            LEFT JOIN customer c ON t.customer = c.username 
            WHERE t.customer = '".$customer."' 
            AND t.date = '".$date."' 
            AND (t.employee IS NULL OR t.employee = '') ";
        $this->sql_query .= " ORDER BY  time_from";
        
        $slots = $this->query_fetch();
        // echo '<pre>'.print_r($slots, 1).'</pre>'; exit();
        //if($_COOKIE['debug'] == 'true') echo '<pre>'.print_r($slots, 1).'</pre>'; exit();
        // echo "<pre>". print_r($this->query_error_details, 1)."</pre>";
        $datas = array();
        foreach ($slots as $slot) {
            $signed_in = 0;
            $show_details = 1;
            
            $emp_name = '';
            $slot_customer = $_SESSION['company_sort_by'] == 1 ? $slot['cust_first_name'] . ' ' . $slot['cust_last_name'] : $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];

            $slot_difference = 0;
            $prev_time_to = 0.00;
            if($prev_time_to != $slot['time_from'])
                $slot_difference = $obj_emp->time_difference($prev_time_to, $slot['time_from'], 100);
            $tl_flag = 1;
            if ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                $tl_flag = 0;
                //$slot_customer = $smarty->translate['works_on_another_customer'];
            }

            $slot_type_class = $slot_type_label = '';
            switch($slot['type']){
                case '1': $slot_type_class = 'slot-icon-small-travel'; $slot_type_label = $smarty->translate['travel']; break;
                case '0': $slot_type_class = 'slot-icon-small-normal'; $slot_type_label = $smarty->translate['normal']; break;
                case '2': $slot_type_class = 'slot-icon-small-break'; $slot_type_label = $smarty->translate['break']; break;
                case '3': $slot_type_class = 'slot-icon-small-oncall'; $slot_type_label = $smarty->translate['oncall']; break;
                case '4': $slot_type_class = 'slot-icon-small-over-time'; $slot_type_label = $smarty->translate['overtime']; break;
                case '5': $slot_type_class = 'slot-icon-small-qualtiy-overtime'; $slot_type_label = $smarty->translate['qual_overtime']; break;
                case '6': $slot_type_class = 'slot-icon-small-more-time'; $slot_type_label = $smarty->translate['more_time']; break;
                case '14': $slot_type_class = 'slot-icon-small-oncall-moretime'; $slot_type_label = $smarty->translate['more_oncall']; break;
                case '7': $slot_type_class = 'slot-icon-small-some-other-time'; $slot_type_label = $smarty->translate['some_other_time']; break;
                case '8': $slot_type_class = 'slot-icon-small-training'; $slot_type_label = $smarty->translate['training_time']; break;
                case '9': $slot_type_class = 'slot-icon-small-call-training'; $slot_type_label = $smarty->translate['call_training']; break;
                case '10': $slot_type_class = 'slot-icon-small-personal-meeting'; $slot_type_label = $smarty->translate['personal_meeting']; break;
                case '11': $slot_type_class = 'slot-icon-small-voluntary'; $slot_type_label = $smarty->translate['voluntary']; break;
                case '12': $slot_type_class = 'slot-icon-small-complimentary'; $slot_type_label = $smarty->translate['complementary']; break;
                case '13': $slot_type_class = 'slot-icon-small-complimentary-oncall'; $slot_type_label = $smarty->translate['complementary_oncall']; break;
                case '15': $slot_type_class = 'slot-icon-small-standby'; $slot_type_label = $smarty->translate['oncall_standby']; break;
                case '16': $slot_type_class = 'slot-icon-small-dismissal'; $slot_type_label = $smarty->translate['work_for_dismissal']; break;
                case '17': $slot_type_class = 'slot-icon-small-dismissal-oncall'; $slot_type_label = $smarty->translate['work_for_dismissal_oncall']; break;
            }

            $temp_slots = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => str_pad($slot['time_from'],5,'0',STR_PAD_LEFT), 'slot_to' => str_pad($slot['time_to'],5,'0',STR_PAD_LEFT), 'slot_hour' => $obj_emp->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot_customer, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'], 'signed' => $signed_in, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'slot_difference' => $slot_difference, 'employee_color' => $slot['employee_color'], 'customer_color' => $slot['customer_color'], 'slot_type_class' => $slot_type_class, 'slot_type_label' => $slot_type_label);
            $datas[] = $temp_slots;
            // $prev_time_to = $slot['time_to'];
        }
        //print_r($datas);
        return $datas;
    } 

    function get_employee_day_slots($date, $employee, $team_customers) {
        if($date == '' || $employee == '') return array();

        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        $obj_emp = new employee();
        $tl_customers = array();
        $tl_employees = array();
        $tl_all_customers = array();
        $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
            $temp_tl_customers = $obj_emp->customers_list_for_right_click($_SESSION['user_id']);
            foreach ($temp_tl_employees as $temp_tl_employee) {
                $tl_employees[] = $temp_tl_employee['username'];
            }
            foreach ($temp_tl_customers as $temp_tl_customer) {
                $tl_customers[] = $temp_tl_customer['username'];
            }

            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($_SESSION['user_id']);
            $this->query_generate();

            $datas = $this->query_fetch(2);
            foreach ($datas as $data) {
                $tl_all_customers[] = $data;
            }
        }

        $team_customer_string = '\'' . implode('\' , \'', $team_customers) . '\'';
        
        $this->sql_query = "SELECT t.id, t.employee, e.first_name as emp_first_name, e.last_name as emp_last_name, c.first_name as cust_first_name, c.last_name as cust_last_name, t.customer, t.date, t.time_from, t.time_to, t.status, t.created_status, t.type, t.fkkn, t.alloc_emp, t.comment, t.alloc_comment, t.cust_comment, r.employee as signed_employee, e.color as employee_color
            FROM timetable t 
            INNER JOIN employee e ON t.employee = e.username 
            LEFT JOIN customer c ON t.customer = c.username 
            LEFT JOIN report_signing r ON t.employee = r.employee AND t.customer = r.customer AND MONTH(r.date) = ".$month." AND YEAR(r.date) = ".$year."
            WHERE t.employee = '".$employee."' 
            AND t.date = '".$date."' 
            AND t.customer IN (".$team_customer_string.") ";

        //customer filteration - show only loggined customer slots if log as customer
        if(isset($_SESSION) && $_SESSION['user_role'] == 4){
            $this->sql_query .= ' AND t.customer = "'.$_SESSION['user_id'].'" ';
        }

        if($_SESSION['company_sort_by'] == 1){
            $this->sql_query .= " ORDER BY LOWER(c.first_name) collate utf8_bin ASC, LOWER(c.last_name) collate utf8_bin ASC";
        }else{
            $this->sql_query .= " ORDER BY LOWER(c.last_name) collate utf8_bin ASC, LOWER(c.first_name) collate utf8_bin ASC";
        }
        $this->sql_query .= ", time_from";
        
        $slots = $this->query_fetch();
        //if($_COOKIE['debug'] == 'true') echo '<pre>'.print_r($slots, 1).'</pre>'; exit();
        // echo "<pre>". print_r($this->query_error_details, 1)."</pre>";
        $datas = array();
        $prev_time_to = 0.00;
        $prev_customer = '';
        foreach ($slots as $slot) {
            $signed_in = 0;
            $show_details = 1;
            if($slot['signed_employee']){
                $signed_in = 1;
            }
            
            if ($_SESSION['company_sort_by'] == 1) {
                $slot_customer = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
            } else {
                $slot_customer = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
            }
            $slot_difference = 0;
            if($slot['customer'] !=  $prev_customer)
                $prev_time_to = 0.00;
            if($prev_time_to != $slot['time_from'])
                $slot_difference = $obj_emp->time_difference($prev_time_to, $slot['time_from'], 100);
            $tl_flag = 1;
            if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                if ($slot['employee'] != '' && $slot['customer'] != '') {
                    if (!in_array($slot['employee'], $tl_employees) && !in_array($slot['customer'], $tl_customers)) {
                        $tl_flag = 0;
                    }
                }
                if ((!in_array($slot['customer'], $tl_all_customers)) && $slot['employee'] != '' && $slot['customer'] != '') {
                    $tl_flag = 0;
                    $slot_customer = $smarty->translate['works_on_another_customer'];
                    $show_details = 0;
                } 
            } elseif ($_SESSION['user_role'] == 3) {
                if ($slot['employee'] != '' && $slot['customer'] != '' && $slot['employee'] != $_SESSION['user_id']) {
                    $tl_flag = 0;
                    //$slot_customer = $smarty->translate['works_on_another_customer'];
                }
            } elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                $tl_flag = 0;
                //$slot_customer = $smarty->translate['works_on_another_customer'];
            }

            $slot_type_class = $slot_type_label = '';
            switch($slot['type']){
                case '1': $slot_type_class = 'slot-icon-small-travel'; $slot_type_label = $smarty->translate['travel']; break;
                case '0': $slot_type_class = 'slot-icon-small-normal'; $slot_type_label = $smarty->translate['normal']; break;
                case '2': $slot_type_class = 'slot-icon-small-break'; $slot_type_label = $smarty->translate['break']; break;
                case '3': $slot_type_class = 'slot-icon-small-oncall'; $slot_type_label = $smarty->translate['oncall']; break;
                case '4': $slot_type_class = 'slot-icon-small-over-time'; $slot_type_label = $smarty->translate['overtime']; break;
                case '5': $slot_type_class = 'slot-icon-small-qualtiy-overtime'; $slot_type_label = $smarty->translate['qual_overtime']; break;
                case '6': $slot_type_class = 'slot-icon-small-more-time'; $slot_type_label = $smarty->translate['more_time']; break;
                case '14': $slot_type_class = 'slot-icon-small-oncall-moretime'; $slot_type_label = $smarty->translate['more_oncall']; break;
                case '7': $slot_type_class = 'slot-icon-small-some-other-time'; $slot_type_label = $smarty->translate['some_other_time']; break;
                case '8': $slot_type_class = 'slot-icon-small-training'; $slot_type_label = $smarty->translate['training_time']; break;
                case '9': $slot_type_class = 'slot-icon-small-call-training'; $slot_type_label = $smarty->translate['call_training']; break;
                case '10': $slot_type_class = 'slot-icon-small-personal-meeting'; $slot_type_label = $smarty->translate['personal_meeting']; break;
                case '11': $slot_type_class = 'slot-icon-small-voluntary'; $slot_type_label = $smarty->translate['voluntary']; break;
                case '12': $slot_type_class = 'slot-icon-small-complimentary'; $slot_type_label = $smarty->translate['complementary']; break;
                case '13': $slot_type_class = 'slot-icon-small-complimentary-oncall'; $slot_type_label = $smarty->translate['complementary_oncall']; break;
                case '15': $slot_type_class = 'slot-icon-small-standby'; $slot_type_label = $smarty->translate['oncall_standby']; break;
                case '16': $slot_type_class = 'slot-icon-small-dismissal'; $slot_type_label = $smarty->translate['work_for_dismissal']; break;
                case '17': $slot_type_class = 'slot-icon-small-dismissal-oncall'; $slot_type_label = $smarty->translate['work_for_dismissal_oncall']; break;
            }

            $datas[$slot['customer']]['name'] = $slot_customer;
            $datas[$slot['customer']]['show_details'] = $show_details;
            $temp_slots = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => str_pad($slot['time_from'],5,'0',STR_PAD_LEFT), 'slot_to' => str_pad($slot['time_to'],5,'0',STR_PAD_LEFT), 'slot_hour' => $obj_emp->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot_customer, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'], 'signed' => $signed_in, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'slot_difference' => $slot_difference, 'employee_color' => $slot['employee_color'], 'customer_color' => $slot['customer_color'], 'slot_type_class' => $slot_type_class, 'slot_type_label' => $slot_type_label);
            $datas[$slot['customer']]['slots'][] = $temp_slots;
            $prev_time_to = $slot['time_to'];
            $prev_customer = $slot['customer'];
        }
        //print_r($datas);
        return $datas;
    }  

    function get_employee_day_unallocated_customer_slots($date, $employee) {
        if($date == '' || $employee == '') return array();

        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        $obj_emp = new employee();
        $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));


        $this->sql_query = "SELECT t.id, t.employee, '' as cust_first_name, '' as cust_last_name, e.first_name as emp_first_name, e.last_name as emp_last_name, t.customer, t.date, t.time_from, t.time_to, t.status, t.created_status, t.type, t.fkkn, t.alloc_emp, t.comment, t.alloc_comment, t.cust_comment, '' as signed_employee, '' as employee_color
            FROM timetable t 
            LEFT JOIN employee e ON t.employee = e.username 
            WHERE t.employee = '".$employee."' 
            AND t.date = '".$date."' 
            AND (t.customer IS NULL OR t.customer = '') ";
        $this->sql_query .= " ORDER BY  time_from";
        
        $slots = $this->query_fetch();
        $datas = array();
        foreach ($slots as $slot) {
            $signed_in = 0;
            $show_details = 1;
            
            $cust_name = '';
            $slot_employee = $_SESSION['company_sort_by'] == 1 ? $slot['emp_first_name'] . ' ' . $slot['emp_last_name'] : $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];

            $slot_difference = 0;
            $prev_time_to = 0.00;
            if($prev_time_to != $slot['time_from'])
                $slot_difference = $obj_emp->time_difference($prev_time_to, $slot['time_from'], 100);
            $tl_flag = 1;
            if ($_SESSION['user_role'] == 3 && $slot['employee'] != $_SESSION['user_id']) {
                $tl_flag = 0;
                //$slot_employee = $smarty->translate['works_on_another_customer'];
            }

            $slot_type_class = $slot_type_label = '';
            switch($slot['type']){
                case '1': $slot_type_class = 'slot-icon-small-travel'; $slot_type_label = $smarty->translate['travel']; break;
                case '0': $slot_type_class = 'slot-icon-small-normal'; $slot_type_label = $smarty->translate['normal']; break;
                case '2': $slot_type_class = 'slot-icon-small-break'; $slot_type_label = $smarty->translate['break']; break;
                case '3': $slot_type_class = 'slot-icon-small-oncall'; $slot_type_label = $smarty->translate['oncall']; break;
                case '4': $slot_type_class = 'slot-icon-small-over-time'; $slot_type_label = $smarty->translate['overtime']; break;
                case '5': $slot_type_class = 'slot-icon-small-qualtiy-overtime'; $slot_type_label = $smarty->translate['qual_overtime']; break;
                case '6': $slot_type_class = 'slot-icon-small-more-time'; $slot_type_label = $smarty->translate['more_time']; break;
                case '14': $slot_type_class = 'slot-icon-small-oncall-moretime'; $slot_type_label = $smarty->translate['more_oncall']; break;
                case '7': $slot_type_class = 'slot-icon-small-some-other-time'; $slot_type_label = $smarty->translate['some_other_time']; break;
                case '8': $slot_type_class = 'slot-icon-small-training'; $slot_type_label = $smarty->translate['training_time']; break;
                case '9': $slot_type_class = 'slot-icon-small-call-training'; $slot_type_label = $smarty->translate['call_training']; break;
                case '10': $slot_type_class = 'slot-icon-small-personal-meeting'; $slot_type_label = $smarty->translate['personal_meeting']; break;
                case '11': $slot_type_class = 'slot-icon-small-voluntary'; $slot_type_label = $smarty->translate['voluntary']; break;
                case '12': $slot_type_class = 'slot-icon-small-complimentary'; $slot_type_label = $smarty->translate['complementary']; break;
                case '13': $slot_type_class = 'slot-icon-small-complimentary-oncall'; $slot_type_label = $smarty->translate['complementary_oncall']; break;
                case '15': $slot_type_class = 'slot-icon-small-standby'; $slot_type_label = $smarty->translate['oncall_standby']; break;
                case '16': $slot_type_class = 'slot-icon-small-dismissal'; $slot_type_label = $smarty->translate['work_for_dismissal']; break;
                case '17': $slot_type_class = 'slot-icon-small-dismissal-oncall'; $slot_type_label = $smarty->translate['work_for_dismissal_oncall']; break;
            }

            $temp_slots = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => str_pad($slot['time_from'],5,'0',STR_PAD_LEFT), 'slot_to' => str_pad($slot['time_to'],5,'0',STR_PAD_LEFT), 'slot_hour' => $obj_emp->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $cust_name, 'emp_name' => $slot_employee, 'alloc_emp' => $slot['alloc_emp'], 'signed' => $signed_in, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'slot_difference' => $slot_difference, 'employee_color' => $slot['employee_color'], 'customer_color' => $slot['customer_color'], 'slot_type_class' => $slot_type_class, 'slot_type_label' => $slot_type_label);
            $datas[] = $temp_slots;
            // $prev_time_to = $slot['time_to'];
        }
        //print_r($datas);
        return $datas;
    }    

    function get_all_day_slots($date) {
        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        $obj_emp = new employee();
        $tl_customers = array();
        $tl_employees = array();
        $tl_all_customers = array();
        $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
            $temp_tl_customers = $obj_emp->customers_list_for_right_click($_SESSION['user_id']);
            foreach ($temp_tl_employees as $temp_tl_employee) {
                $tl_employees[] = $temp_tl_employee['username'];
            }
            foreach ($temp_tl_customers as $temp_tl_customer) {
                $tl_customers[] = $temp_tl_customer['username'];
            }

            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($_SESSION['user_id']);
            $this->query_generate();

            $datas = $this->query_fetch(2);
            foreach ($datas as $data) {
                $tl_all_customers[] = $data;
            }
        }

        
        $this->sql_query = "SELECT t.id, t.employee, e.first_name as emp_first_name, e.last_name as emp_last_name, c.first_name as cust_first_name, c.last_name as cust_last_name, t.customer, t.date, t.time_from, t.time_to, t.status, t.created_status, t.type, t.fkkn, t.alloc_emp, t.comment, t.alloc_comment, t.cust_comment, r.employee as signed_employee, e.color as employee_color, c.color as customer_color
            FROM timetable t 
            INNER JOIN employee e ON t.employee = e.username 
            LEFT JOIN customer c ON t.customer = c.username 
            LEFT JOIN report_signing r ON t.employee = r.employee AND t.customer = r.customer AND MONTH(r.date) = ".$month." AND YEAR(r.date) = ".$year."
            WHERE t.employee != '' AND t.employee IS NOT NULL AND t.date = '".$date."'";
        if($_SESSION['company_sort_by'] == 1){
            $this->sql_query .= " ORDER BY LOWER(e.first_name) collate utf8_bin ASC, LOWER(e.last_name) collate utf8_bin ASC";
        }else{
            $this->sql_query .= " ORDER BY LOWER(e.last_name) collate utf8_bin ASC, LOWER(e.first_name) collate utf8_bin ASC";
        }
        $this->sql_query .= ", time_from";
        
        $slots = $this->query_fetch();
        //if($_COOKIE['debug'] == 'true') echo '<pre>'.print_r($slots, 1).'</pre>'; exit();
        //echo "<pre>". print_r($slots, 1)."</pre>";
        $datas = array();
        $prev_time_to = 0.00;
        $prev_employee = '';
        foreach ($slots as $slot) {
            $signed_in = 0;
            $show_details = 1;
            if($slot['signed_employee']){
                $signed_in = 1;
            }
            
            if ($_SESSION['company_sort_by'] == 1) {
                $slot_customer = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
            } else {
                $slot_customer = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
            }
            $slot_difference = 0;
            if($slot['employee'] !=  $prev_employee)
                $prev_time_to = 0.00;
            if($prev_time_to != $slot['time_from'])
                $slot_difference = $obj_emp->time_difference($prev_time_to, $slot['time_from'], 100);
            $tl_flag = 1;
            if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                if ($slot['employee'] != '' && $slot['customer'] != '') {
                    if (!in_array($slot['employee'], $tl_employees) && !in_array($slot['customer'], $tl_customers)) {
                        $tl_flag = 0;
                    }
                }
                if ((!in_array($slot['customer'], $tl_all_customers)) && $slot['employee'] != '' && $slot['customer'] != '') {
                    $tl_flag = 0;
                    $slot_customer = $smarty->translate['works_on_another_customer'];
                    $show_details = 0;
                } 
            } elseif ($_SESSION['user_role'] == 3) {
                if ($slot['employee'] != '' && $slot['customer'] != '' && $slot['employee'] != $_SESSION['user_id']) {
                    $tl_flag = 0;
                    //$slot_customer = $smarty->translate['works_on_another_customer'];
                }
            } elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                $tl_flag = 0;
                //$slot_customer = $smarty->translate['works_on_another_customer'];
            }

            $slot_type_class = $slot_type_label = '';
            switch($slot['type']){
                case '1': $slot_type_class = 'slot-icon-small-travel'; $slot_type_label = $smarty->translate['travel']; break;
                case '0': $slot_type_class = 'slot-icon-small-normal'; $slot_type_label = $smarty->translate['normal']; break;
                case '2': $slot_type_class = 'slot-icon-small-break'; $slot_type_label = $smarty->translate['break']; break;
                case '3': $slot_type_class = 'slot-icon-small-oncall'; $slot_type_label = $smarty->translate['oncall']; break;
                case '4': $slot_type_class = 'slot-icon-small-over-time'; $slot_type_label = $smarty->translate['overtime']; break;
                case '5': $slot_type_class = 'slot-icon-small-qualtiy-overtime'; $slot_type_label = $smarty->translate['qual_overtime']; break;
                case '6': $slot_type_class = 'slot-icon-small-more-time'; $slot_type_label = $smarty->translate['more_time']; break;
                case '14': $slot_type_class = 'slot-icon-small-oncall-moretime'; $slot_type_label = $smarty->translate['more_oncall']; break;
                case '7': $slot_type_class = 'slot-icon-small-some-other-time'; $slot_type_label = $smarty->translate['some_other_time']; break;
                case '8': $slot_type_class = 'slot-icon-small-training'; $slot_type_label = $smarty->translate['training_time']; break;
                case '9': $slot_type_class = 'slot-icon-small-call-training'; $slot_type_label = $smarty->translate['call_training']; break;
                case '10': $slot_type_class = 'slot-icon-small-personal-meeting'; $slot_type_label = $smarty->translate['personal_meeting']; break;
                case '11': $slot_type_class = 'slot-icon-small-voluntary'; $slot_type_label = $smarty->translate['voluntary']; break;
                case '12': $slot_type_class = 'slot-icon-small-complimentary'; $slot_type_label = $smarty->translate['complementary']; break;
                case '13': $slot_type_class = 'slot-icon-small-complimentary-oncall'; $slot_type_label = $smarty->translate['complementary_oncall']; break;
                case '15': $slot_type_class = 'slot-icon-small-standby'; $slot_type_label = $smarty->translate['oncall_standby']; break;
                case '16': $slot_type_class = 'slot-icon-small-dismissal'; $slot_type_label = $smarty->translate['work_for_dismissal']; break;
                case '17': $slot_type_class = 'slot-icon-small-dismissal-oncall'; $slot_type_label = $smarty->translate['work_for_dismissal_oncall']; break;
            }

            $datas[$slot['employee']]['name'] = $emp_name;
            $temp_slots = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => str_pad($slot['time_from'],5,'0',STR_PAD_LEFT), 'slot_to' => str_pad($slot['time_to'],5,'0',STR_PAD_LEFT), 'slot_hour' => $obj_emp->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot_customer, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'], 'signed' => $signed_in, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'slot_difference' => $slot_difference, 'employee_color' => $slot['employee_color'], 'customer_color' => $slot['customer_color'], 'slot_type_class' => $slot_type_class, 'slot_type_label' => $slot_type_label);
            $datas[$slot['employee']]['slots'][] = $temp_slots;
            $prev_time_to = $slot['time_to'];
            $prev_employee = $slot['employee'];
        }
        //print_r($datas);
        return $datas;
    }   

    function get_consolidated_employee_day_between_dates($start_date, $end_date){
        $this->sql_query = "SELECT t.employee, e.first_name, e.last_name, t.date, t.type, ROUND(SUM(time_to_sec(timediff(time(replace(cast(t.time_to as char),'.',':')) , time(replace(cast(t.time_from as char),'.',':')))) )/3600,2) AS total_time 
                    FROM timetable t 
                    INNER JOIN employee e ON t.employee = e.username
                    WHERE t.date BETWEEN '".$start_date."' AND '".$end_date."' AND t.status = 1 
                    GROUP BY t.employee, t.date, t.type 
                    ORDER BY t.employee, t.date, t.type";
        $datas = $this->query_fetch();
        $employee_details = array();
        $prev_employee = '';
        foreach($datas as $data){
            $emp_name = $data['last_name'] . ' ' . $data['first_name'];    
            if ($_SESSION['company_sort_by'] == 1) {
                $emp_name = $data['first_name'] . ' ' . $data['last_name'];
            }
            $employee_details[$data['employee']]['username'] = $data['employee'];
            $employee_details[$data['employee']]['name'] = $emp_name;
            if($data['type'] == 1 || $data['type'] == 2){
                $employee_details[$data['employee']][$data['date']][$data['type']] += $data['total_time'];
                $employee_details[$data['employee']]['totals'][$data['type']] += $data['total_time'];
            }else{
                $employee_details[$data['employee']][$data['date']][0] += $data['total_time'];
                $employee_details[$data['employee']]['totals'][0] += $data['total_time'];
            }

            //total
            $employee_details[$data['employee']][$data['date']]['total'] += $data['total_time'];
            $employee_details[$data['employee']]['totals']['total'] += $data['total_time'];
            ksort($employee_details[$data['employee']]);
        }
        ksort($employee_details);
        return $employee_details;
    }

    function get_all_customer_emps_who_have_no_slots($date, $team_emps, $except_emps = array()) {
        if($date == '' || empty($team_emps)) return array();

        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        // $obj_emp = new employee();
        // $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);

        $team_employee_string = '\'' . implode('\' , \'', $team_emps) . '\'';
        // $except_employee_string = '\'' . implode('\' , \'', $except_emps) . '\'';
        
        $this->sql_query = "SELECT e.username, e.first_name as emp_first_name, e.last_name as emp_last_name, e.color as employee_color
            FROM employee e
            WHERE e.status = 1 AND e.username IN ( ".$team_employee_string." ) ";

        if(!empty($except_emps)){
            $except_emp_string = '\''.implode('\',\'', $except_emps).'\'';
            $this->sql_query .= " AND e.username NOT IN ( ".$except_emp_string." ) ";
        }
        if($_SESSION['company_sort_by'] == 1){
            $this->sql_query .= " ORDER BY LOWER(e.first_name) collate utf8_bin ASC, LOWER(e.last_name) collate utf8_bin ASC";
        }else{
            $this->sql_query .= " ORDER BY LOWER(e.last_name) collate utf8_bin ASC, LOWER(e.first_name) collate utf8_bin ASC";
        }
        
        $employees = $this->query_fetch();
        $datas = array();
        if(!empty($employees)){
            foreach ($employees as $emp) {
                $signed_in = 0;
                $show_details = 1;
                $emp_name = $_SESSION['company_sort_by'] == 1 ? $emp['emp_first_name'] . ' ' . $emp['emp_last_name'] : $emp['emp_last_name'] . ' ' . $emp['emp_first_name'];
                $tl_flag = 1;

                $datas[$emp['username']] = array('username' => $emp['username'], 'name' => $emp_name, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'employee_color' => $emp['employee_color'], 'slots' => array());
            }
        }
        return $datas;
    }

    function get_all_employee_custs_who_have_no_slots($date, $team_custs, $except_custs = array()) {
        if($date == '' || empty($team_custs)) return array();

        $smarty = new smartySetup(array('gdschema.xml','messages.xml'),FALSE);
        // $obj_emp = new employee();
        // $temp_privilege = $obj_emp->get_privileges($_SESSION['user_id'],1);

        $team_customer_string = '\'' . implode('\' , \'', $team_custs) . '\'';
        // $except_customer_string = '\'' . implode('\' , \'', $except_custs) . '\'';
        
        $this->sql_query = "SELECT c.username, c.first_name as cust_first_name, c.last_name as cust_last_name
            FROM customer c
            WHERE c.status = 1 AND c.username IN ( ".$team_customer_string." ) ";

        if(!empty($except_custs)){
            $except_customer_string = '\''.implode('\',\'', $except_custs).'\'';
            $this->sql_query .= " AND c.username NOT IN ( ".$except_customer_string." ) ";
        }
        if($_SESSION['company_sort_by'] == 1){
            $this->sql_query .= " ORDER BY LOWER(c.first_name) collate utf8_bin ASC, LOWER(c.last_name) collate utf8_bin ASC";
        }else{
            $this->sql_query .= " ORDER BY LOWER(c.last_name) collate utf8_bin ASC, LOWER(c.first_name) collate utf8_bin ASC";
        }
        
        $customers = $this->query_fetch();
        $datas = array();
        if(!empty($customers)){

            $this->flush();
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($_SESSION['user_id']);
            $this->query_generate();
            $tl_datas = $this->query_fetch(2);
            $tl_all_customers = array();
            foreach ($tl_datas as $data) {
                $tl_all_customers[] = $data;
            }

            foreach ($customers as $cst) {
                $signed_in = 0;
                $show_details = 1;
                $cust_name = $_SESSION['company_sort_by'] == 1 ? $cst['cust_first_name'] . ' ' . $cst['cust_last_name'] : $cst['cust_last_name'] . ' ' . $cst['cust_first_name'];
                $tl_flag = 1;

                if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                    if ((!in_array($cst['username'], $tl_all_customers))) {
                        $tl_flag = 0;
                        $cust_name = $smarty->translate['works_on_another_customer'];
                        $show_details = 0;
                    } 
                } elseif ($_SESSION['user_role'] == 3) {
                    if ((!in_array($cst['username'], $tl_all_customers))) {
                        $tl_flag = 0;
                        $cust_name = $smarty->translate['works_on_another_customer'];
                        $show_details = 0;
                    }
                } elseif ($_SESSION['user_role'] == 4 && $cst['username'] != $_SESSION['user_id']) {
                    $tl_flag = 0;
                    $cust_name = $smarty->translate['works_on_another_customer'];
                }

                $datas[$cst['username']] = array('username' => $cst['username'], 'name' => $cust_name, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'slots' => array());
            }
        }
        return $datas;
    }


    function check_overlapping_time_peroid($fromDate,$toDate,$dayInterval,$user_name, $group_id = null){
        $this->tables = array('employee_non_preferred_timings');
        $this->fields = array('id','group_id', 'employee','date_from','date_to','day','time_from','time_to');
        if($group_id != null){
            $this->conditions = array('AND',array('AND','date_from <= "'.$toDate.'" ','date_to >= "'.$fromDate.'" '),array('employee = "'.$user_name.'"'),array('group_id != '.$group_id.''));
        }
        else{
            $this->conditions = array('AND',array('AND','date_from <= "'.$toDate.'" ','date_to >= "'.$fromDate.'"'),array('employee = "'.$user_name.'"'));
        }
        
        $sub_conditions = array('OR');

        foreach ($dayInterval as $day => $date_times) {
            foreach ($date_times as $key => $value) {
                $sub_conditions[] = array('AND',''.$value['timeFrom'].'< time_to',''.$value['timeTo'].'>time_from','day = '.$day.'');
            }
        }
        if(count($sub_conditions) > 1)
            $this->conditions[] = $sub_conditions;
        $this->query_generate();
        // $this->sql_query;
        return $this->query_fetch(); 
    }

    function get_group_id(){
        $this->sql_query = "SELECT MAX(`group_id`) `group_id` FROM `employee_non_preferred_timings`";
         return $this->query_fetch()[0]['group_id'];
    }


    function save_employee_non_prefered_time($user_name,$fromDate,$toDate,$dayInterval,$group_id){
        $group_id == null ? $group_id = 1 : $group_id++;
        $this->tables = array('employee_non_preferred_timings');
        $this->fields = array('group_id', 'employee','date_from','date_to','day','time_from','time_to');
        $this->field_values = array();
        foreach ($dayInterval as $day => $date_times) {
            foreach ($date_times as $key => $value) {
                $this->field_values[] = array($group_id,$user_name,$fromDate,$toDate,$day,$value['timeFrom'],$value['timeTo']);
            }
        }
        return $this->query_insert();
    }

    function get_all_employee_non_prefered_rime($employee){
        $this->sql_query = "select * from `employee_non_preferred_timings` WHERE `employee` = '".$employee."' ORDER BY `group_id`,`day` ASC ";
        return $this->query_fetch();
    }

    function delete_employee_non_preferd_time($group_id){
        $this->tables           = array('employee_non_preferred_timings');
        $this->conditions       = array('group_id = ?');
        $this->condition_values = array($group_id);
        return $this->query_delete();
    }

    function delete_single_non_preferred_imterval($id){
        $this->tables           = array('employee_non_preferred_timings');
        $this->conditions       = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete();
    }

    function get_non_preferred_unique_employee($unique_employee_of_slots, $start_date, $end_date){
        $this->sql_query = "SELECT * FROM `employee_non_preferred_timings` WHERE (`date_from`<='".$end_date."' AND `date_to`>='".$start_date."') AND `employee` IN('".implode("','",$unique_employee_of_slots)."')";
        return $this->query_fetch();
    }

    function check_time_interval_overlap_with_existing_slots($fromDate,$toDate,$dayInterval,$user_name){
        $this->tables           = array('timetable');
        $this->fields           = array('id', 'employee','customer','date','time_from','time_to');
        $this->conditions       = array('AND',array('BETWEEN', 'date','?', '?'),array('employee = "'.$user_name.'"'));
        $this->condition_values = array($fromDate, $toDate); 
        foreach ($dayInterval as $day => $date_times) {
            foreach ($date_times as $key => $value) {
                $this->conditions[] = array('AND',array('AND',''.$value['timeFrom'].'< time_to',''.$value['timeTo'].'>time_from'),array('WEEKDAY(`date`)+1  = '.$day.''));
            }
        }
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_team_leader_or_super_tl_of_employee($employee, $role){
        // role  2 = team_leader 7 = super_tl\
        $this->sql_query = "SELECT t.customer,t.employee, t.role , e.email,e.first_name,e.last_name from `team` t left join `employee` e  ON e.username = t.employee WHERE (`customer` IN(SELECT  DISTINCT `customer`  FROM `team` WHERE `employee` LIKE '".$employee."')  AND role = '".$role."')";
        return $this->query_fetch();
    }

    function get_admin_data(){
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username');
        $this->conditions = array('role = 1');
        $this->query_generate();
        $sql_query_admin_in = $this->sql_query;


        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile','first_name','last_name');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_admin_in));
        $this->query_generate();
        return $admin_datas = $this->query_fetch();
    }

    function all_emp_with_non_preferred_times($selected_from_date, $selected_to_date, $selected_from_time = null, $selected_to_time = null, $selected_customer = null){

        $selected_from_time != null ? $selected_from_time = trim($selected_from_time) : $selected_from_time = 0.00 ;
        $selected_to_time   != null ? $selected_to_time = trim($selected_to_time) : $selected_to_time = 24.00 ;

        if ($_SESSION['company_sort_by'] == 1)
            $order_by = ' ORDER BY LOWER(e.`first_name`) collate utf8_bin ASC,LOWER(e.`last_name`) collate utf8_bin ASC, `day` ASC';
        else
            $order_by = ' ORDER BY LOWER(e.`last_name`) collate utf8_bin ASC,LOWER(e.`first_name`) collate utf8_bin ASC, `day` ASC';
        
        if($selected_customer != null){
            $emp_under_cus = $this->get_employees_under_single_customer($selected_customer);
            if(!empty($emp_under_cus)){
                $this->sql_query = "SELECT e.`username`,e.`first_name`, e.`last_name`,e.`code`,e.`mobile`,enpt.`date_from`,enpt.`date_to`,enpt.`day`,enpt.`time_from`,enpt.`time_to` FROM `employee_non_preferred_timings` enpt LEFT JOIN `employee` e ON e.`username` = enpt.`employee` WHERE enpt.`date_from`<='".$selected_to_date."' AND enpt.`date_to`>='".$selected_from_date."' AND  enpt.`time_from`<= ".$selected_to_time." AND enpt.`date_to`>= ".$selected_from_time." AND enpt.`employee` IN ('".  implode("','",$emp_under_cus) . "') ";
            }
        }
        else
            $this->sql_query = "SELECT e.`username`,e.`first_name`, e.`last_name`,e.`code`,e.`mobile`,enpt.`date_from`,enpt.`date_to`,enpt.`day`,enpt.`time_from`,enpt.`time_to` FROM `employee_non_preferred_timings` enpt LEFT JOIN `employee` e ON e.`username` = enpt.`employee` WHERE enpt.`date_from`<='".$selected_to_date."' AND enpt.`date_to`>='".$selected_from_date."' AND  enpt.`time_from`<= ".$selected_to_time." AND enpt.`date_to`>= ".$selected_from_time." ";


        $this->sql_query .= ' '. $order_by;
        $datas = $this->query_fetch();
        $non_prefered_emp = array();
        foreach ($datas as $data) {
            $non_prefered_emp[] = array('username' => $data['username'],  
                'name' => $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . ' ' . $data['last_name'] : $data['last_name'] . ' ' . $data['first_name'], 
                'code' => $data['code'], 
                'mobile' => $data['mobile'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
                'day' => $data['day'],
                'time_from' => $data['time_from'],
                'time_to' => $data['time_to']);
        }
       return count($non_prefered_emp) ? $non_prefered_emp : array();
    }

    function get_employees_under_single_customer($customer){
        // $this->sql_query = "SELECT employee FROM `team` WHERE 1 AND customer = '".$customer."' ";
        $this->tables           = array('team');
        $this->fields           = array('employee');
        $this->conditions       = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch(2) ;
    }

    function save_new_time_to_slots($time_from,$time_to,$ids){
        $this->sql_query = "UPDATE `timetable` SET `time_from` = $time_from , `time_to` = $time_to WHERE `id` IN($ids)";
        $this->query_fetch();
    }
}
?>