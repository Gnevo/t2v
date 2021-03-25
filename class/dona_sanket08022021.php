<?php
/**
 * Description of dona
 * @author dona
 */
require_once ('configs/config.inc.php');
require_once ('class/setup.php');
require_once ('class/user.php');
require_once ('class/db.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/inconvenient.php');        // for inconvenient processing
require_once ('plugins/customize_pdf_customer_work_report_new.class.php');
require_once ('plugins/customize_pdf_employee_contract.class.php');
require_once ('plugins/customize_pdf_financial_payment.class.php');
require_once ('class/company.php');
require_once ('class/contract.php');
require_once('class/general.php');

class dona extends db {

    // employee work report 
    var $tot_normal = 0;
    var $tot_oncall = 0;
    var $date = '';
    var $customer = '';
    var $employee = '';
    //for employment certification
    var $employee_id = "";
    var $Certification_period_from = "";
    var $Certification_period_to = "";
    var $employment_period_from = "";       //Uppgifter om anställning section
    var $employment_period_to = "";
    var $still_employed = "";
    var $post_held = "";
    var $leave_effective_from = "";
    var $leave_effective_to = "";
    var $coverage_in = "";
    var $open_ended = "";                   // Anställningsform section
    var $probationary_to = "";
    var $temporary_employement = "";
    var $Intermittent_employement = "";
    var $Arbetstid_open_ended = "";         // Arbetstid Section          
    var $parttime = "";
    var $hours_per_week = "";
    var $full_time_position_in_perc = "";
    var $working_hours = "";
    var $employed_by_agency = "";           // Särskilda upplysningar om anställningen
    var $employment_termination = "";       // Uppgifter om anställning
    var $temporary_employment_closed = "";
    var $own_request = "";
    var $other_reason = "";
    var $termination_compensation = "";     // Ersättning med anledning av anställningens upphörande
    var $future_work_offer = "";            // Erbjudande om fortsatt arbete
    var $future_work_From = "";
    var $future_work_to = "";
    var $to_further = "";
    var $full_time_per_week = "";
    var $part_time_per_week = "";
    var $full_time_position_in_perc_Erbjudande = "";
    var $variable_time = "";
    var $employer_accepted = "";
    var $employer_accepted_date_when_no = "";
    var $salary_to_year = "";               // Uppgifter om lönen
    var $salary_type = "";                  //eg:Månadslön   Veckolön   Daglön   Timlön
    var $amount_in_sek = "";
    var $hourly_rate_varied = "";
    var $overtime_state = "";
    var $additional_hours = "";
    var $not_included_salary = "";
    var $Employed_with_uppehållslön = "";   //Anställd med uppehållslön
    var $Set_earned_uppehållslön = "";
    var $Employed_with_ferielön = "";
    var $no_of_beta_barn_holidays = "";
    var $Set_earned_ferielön = "";
    var $other_information_1 = "";          //Övriga upplysningar
    var $other_information_2 = "";
    //for leave report pdf form
    var $Hourly_times = array();
    var $leavePeriod_month = "";
    var $leavePeriod_year = "";
    var $leave_customer = "";
    var $leave_employee = "";
    var $assignment = "";                   //Övriga fält
    var $proxies = "";
    var $submission = "";
    var $comp_paid_to_account = "";
    var $reference = "";
    var $collective = "";
    var $sick_leave_reg = "";
    var $copy_of_payroll = "";
    var $time_sheet_h_service = "";
    var $additional_cost = "";
    var $words_pay = "";                    //Ord lön kr/tim assistent
    var $kr_h = "";
    var $insurance_word_person = "";        //Försäkring och sociala avgifter    
    var $insurance_substitute = "";
    var $SS_contibution = "";
    var $on_call = "";
    var $oncall_holiday = "";
    var $oncall_bigholiday = "";
    var $inconvinient_evening = "";
    var $inconvinient_night = "";
    var $inconvinient_holiday = "";
    var $inconvinient_week_holiday = "";
    var $samsida = NULL;    //for print only form 3057
    var $oncall_kr_times = array();
    var $ob_kr_times = array();
    var $timers = array();
    var $angearts = array();
    var $work_hour = array(); 
    var $leave_hours = array();
    var $over_time = array();
    var $filling_hours = array();

    function __construct() {

        parent::__construct();
    }

    function get_week() {

        global $week;
        return $week;
    }

    function employee_list() {

        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name', 'prv_swap');
        $this->conditions = array('status = ?');
        $this->condition_values = array(1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return !empty($datas) ? $datas : FALSE;
    }

    function employee_detail_list($date = NULL) {

        global $leave_type;
        $employees = $this->employee_list();
        $employees_list = array();
        foreach ($employees as $employee) {

            if ($date != NULL && $date != '') {

                $username = $employee['username'];
                $this->tables = array('leave');
                $this->fields = array('id', 'type');
                $this->conditions = array('AND', 'date = ?', 'employee = ?', 'status = ?');
                $this->condition_values = array($date, $username, 1);
                $this->query_generate();
                $datas = $this->query_fetch();
                if (!empty($datas)) {
                    $employees_list[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'leave' => 1);
                } else {
                    $employees_list[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'leave' => 0);
                }
            } else {
                $employees_list[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'leave' => 0);
            }
        }
        return $employees_list;
    }

    function customer_list() {

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->conditions = array('status = ?');
        $this->condition_values = array(1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return !empty($datas) ? $datas : FALSE;
    }

    function customer_data($username) {

        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function employee_data($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function user_role($username) {

        $this->tables = array('login');
        $this->fields = array('role');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['role'];
    }

    function team_members($username) {

        $this->tables = array('team');
        $this->fields = array('members');
        $this->conditions = array('tl = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        $members = explode(",", $data[0]['members']);
        $members[] = $username;
        return $members;
    }

    function team_employee_customers($username) {

        $this->tables = array('timetable');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $customers_list = array();
        foreach ($datas as $data) {
            $customers_list[] = $data['customer'];
        }
        return $customers_list;
    }

    function team_customers($username) {

        $members_array = $this->team_members($username);
        $members_field_value = '\'' . $username . '\'';
        if (!empty($members_array)) {
            foreach ($members_array as $member) {
                $members_field_value .= ', \'' . $member . '\'';
            }
        }

        $this->tables = array('timetable');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('IN', 'employee', $members_field_value);
        $this->query_generate();
        $datas = $this->query_fetch();
        $customers_list = array();
        foreach ($datas as $data) {
            $customers_list[] = $data['customer'];
        }
        return $customers_list;
    }

    function customer_timetable_week($customer, $year_week) {

        global $week;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $employees = $this->customer_week_employee($customer, $year_week);
        $datas = array();
        $i = 0;
        foreach ($employees as $employee) {

            $j = 0;
            foreach ($week as $day) {

                $datas[$i][$j]['employee'] = $employee;
                //getting if it is leave
                $leave = 0;
                $leave_data = $this->employee_leave_day($employee['username'], $date);
                if (!empty($leave_data)) {
                    $leave = 1;
                }
                $datas[$i][$j]['leave'] = $leave;
                $datas[$i][$j]['day'] = $day;
                $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
                $slots = $this->timetable_customer_employee_slots($customer, $employee['username'], $date);
                $datas[$i][$j]['slots'] = $slots;
                $j++;
            }
            $i++;
        }
        return $datas;
    }

    function employee_timetable_week($employee, $year_week) {

        global $week;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $customers = $this->employee_week_customer($employee, $year_week);
        $datas = array();
        $i = 0;
        foreach ($customers as $customer) {
            $j = 0;
            foreach ($week as $day) {
                $datas[$i][$j]['customer'] = $customer;
                $datas[$i][$j]['day'] = $day;
                $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
                $slots = $this->timetable_customer_employee_slots($customer['username'], $employee, $date);
                $datas[$i][$j]['slots'] = $slots;
                $j++;
            }
            $i++;
        }
        return $datas;
    }

    function customer_week_employee($customer, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('timetable');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'customer = ?', 'date >= ?', 'date <= ?', 'status = ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name');
        $this->conditions = array('AND', array('IN', 'username', $query_inner), 'status = ?');
        $this->condition_values = array($customer, $start_date, $end_date, 1, 1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function employee_week_customer($employee, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('timetable');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'date >= ?', 'date <= ?', 'status = ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name');
        $this->conditions = array('AND', array('IN', 'username', $query_inner), 'status = ?');
        $this->condition_values = array($employee, $start_date, $end_date, 1, 1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function employee_leave_day($employee, $date) {

        $this->tables = array('leave');
        $this->fields = array('id', 'type', 'comment', 'appr_emp', 'appr_comment');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'status = ?');
        $this->condition_values = array($employee, $date, 1);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function timetable_customer_employee_time($customer, $employee, $date, $carry_fwd = 0) {

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time', 'time_to');
        $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', 'status = ?');
        $this->condition_values = array($customer, $employee, $date, 1);
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $total_time = ($time_data['total_time'] + $carry_fwd);
        $time = array('time' => $total_time, 'carry_fwd' => $cur_carry_fwd);
        return $time;
    }

    function timetable_customer_employee_slots($customer = '', $employee = '', $date = '') {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'alloc_emp', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            $this->conditions = array('AND', 'customer = ?', 'date = ?');
            $this->condition_values = array($customer, $date);
        } else if ($customer == '' && $employee != '') {
            $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2'));
            $this->condition_values = array($employee, $date);
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('LOWER(time_from)');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        foreach ($slots as $slot) {

            $datas[] = array(
                'id' => $slot['id'],
                'employee' => $slot['employee'],
                'customer' => $slot['customer'],
                'date' => $slot['date'],
                'slot' => $slot['time_from'] . '-' . $slot['time_to'],
                'status' => $slot['status'],
                'type' => $slot['type'],
                'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'],
                'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'],
                'alloc_emp' => $slot['alloc_emp']);
        }
        return $datas;
    }

    function employee_contract_week($employee, $year_week) {

        //calculating start date and end date
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('employee_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('employee_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour');
        $this->conditions = array('AND', 'employee = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($employee, $end_date, $employee, $start_date);
        $this->order_by = array('LOWER(date_from)');
        $this->query_generate();
        $contract_data = $this->query_fetch();
        return !empty($contract_data) ? $contract_data : FALSE;
    }

    function employee_timetable_week_time($employee, $year_week) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;

        //getting time for the week
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = ?');
        $this->condition_values = array($employee, $date_from, $date_to, 1);
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $total_time = $time_data['total_time'];
        $total_alloc_time += $total_time;
        return $total_alloc_time;
    }

    function employee_contract_week_hour($employee, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $employee_contracts = $this->employee_contract_week($employee, $year_week);

        if ($employee_contracts) {

            //getting customer contacts
            $contract_hour_week = 0;
            $week_days = 7;
            foreach ($employee_contracts as $employee_contract) {

                $contract_hour_day = round(($employee_contract['hour'] / ($employee_contract['days'] + 1)), 2);
                if (strtotime($end_date) > strtotime($employee_contract['date_to'])) {

                    $day_before = (((strtotime($employee_contract['date_to']) - strtotime($start_date)) / (24 * 60 * 60)) + 1);
                    $week_days -= $day_before;
                    $contract_hour_week += ($day_before * $contract_hour_day);
                } else if (strtotime($start_date) < strtotime($employee_contract['date_from'])) {

                    $contract_hour_week += ($week_days * $contract_hour_day);
                } else {

                    $contract_hour_week = $contract_hour_day * $week_days;
                }
            }
            return $contract_hour_week;
        } else
            return FALSE;
    }

    function employee_to_allocate($year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

//getting all customers
        $employees = $this->employee_list();
        $employee_pending = array();
        foreach ($employees as $employee) {

//getting employee contacts
            $contract_hour_week = $this->employee_contract_week_hour($employee['username'], $year_week);
//getting customer allocated time
            $timetable_hour_week = $this->employee_timetable_week_time($employee['username'], $year_week);
            if ($contract_hour_week > $timetable_hour_week) {

                $employee_pending[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'allocate' => $contract_hour_week, 'allocated' => $timetable_hour_week);
            }
        }
        return !empty($employee_pending) ? $employee_pending : FALSE;
    }

    function customer_contract_week($customer, $year_week) {

//calculating start date and end date
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('customer_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'date_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('customer_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour');
        $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($customer, $end_date, $customer, $start_date);
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch();
        return !empty($contract_data) ? $contract_data : FALSE;
    }

    function customer_timetable_week_time($customer, $year_week) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;

//getting time for the week
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'status = ?');
        $this->condition_values = array($customer, $date_from, $date_to, 1);
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $total_time = $time_data['total_time'];
        $total_alloc_time += $total_time;
        return $total_alloc_time;
    }

    function customer_contract_week_hour($customer, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $customer_contracts = $this->customer_contract_week($customer, $year_week);

        if ($customer_contracts) {

//getting customer contacts
            $contract_hour_week = 0;
            $week_days = 7;
            foreach ($customer_contracts as $customer_contract) {

                $contract_hour_day = round(($customer_contract['hour'] / ($customer_contract['days'] + 1)), 2);
                if (strtotime($end_date) > strtotime($customer_contract['date_to'])) {

                    $day_before = (((strtotime($customer_contract['date_to']) - strtotime($start_date)) / (24 * 60 * 60)) + 1);
                    $week_days -= $day_before;
                    $contract_hour_week += ($day_before * $contract_hour_day);
                } else if (strtotime($start_date) < strtotime($customer_contract['date_from'])) {

                    $contract_hour_week += ($week_days * $contract_hour_day);
                } else {

                    $contract_hour_week = $contract_hour_day * $week_days;
                }
            }
            return $contract_hour_week;
        } else 
            return FALSE;
    }

    function customer_to_allocate($year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

//getting all customers
        $customers = $this->customer_list();
        $customer_pending = array();
        foreach ($customers as $customer) {

//getting customer contacts
            $contract_hour_week = $this->customer_contract_week_hour($customer['username'], $year_week);
//getting customer allocated time
            $timetable_hour_week = $this->customer_timetable_week_time($customer['username'], $year_week);
            if ($contract_hour_week > $timetable_hour_week) {

                $customer_pending[] = array('username' => $customer['username'], 'name' => $customer['first_name'] . ' ' . $customer['last_name'], 'allocate' => $contract_hour_week, 'allocated' => $timetable_hour_week);
            }
        }
        return !empty($customer_pending) ? $customer_pending : FALSE;
    }

    function leave_employee_week($year_week) {

        global $leave_type;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('leave', 'employee');
        $this->fields = array('leave.id AS id', 'leave.employee AS employee', 'employee.first_name AS first_name', 'employee.last_name AS last_name', 'leave.date AS date', 'leave.type AS type', 'leave.comment AS comment');
        $this->conditions = array('AND', 'leave.employee = employee.username', 'leave.status = ?', 'leave.date >= ?', 'leave.date <= ?');
        $this->condition_values = array(1, $start_date, $end_date);
        $this->query_generate();
        $datas = $this->query_fetch();

        $leave_datas = array();
        foreach ($datas as $data) {

            $leave_datas[] = array('id' => $data['id'], 'employee' => $data['employee'], 'name' => $data['first_name'] . " " . $data['last_name'], 'type' => $leave_type[$data['type']], 'date' => $data['date'], 'comment' => $data['comment']);
        }
        return $leave_datas;
    }

    /* ----------------------------------------------shaju--------------------------- */

    // changing the slot type to travel, break or normal
    function employee_slot_type_update($id, $type, $time_from = '', $time_to = '', $customer = NULL) {
        /**
         * @author: Unknown
         * @lastedited: Shamsudheen <shamsu@arioninfotech.com> on 17-08-2013
         * @edited-for: include $customer parameter - used in(slot type change to personal Meeting -ajax alloc action.php)
         * 
         */
        /* if ($type == 0) {
          $status = 1;
          $slot_det = $this->customer_employee_slot_details($id);
          if ($slot_det['customer'] == '' || $slot_det['employee'] == '')
          $status = 0;
          $this->tables = array('timetable');
          $this->fields = array('type', 'status');
          $this->field_values = array($type, $status);
          $this->conditions = array('id = ?');
          $this->condition_values = array($id);
          if ($this->query_update()) {
          return true;
          } else {
          return false;
          }
          } else { */
        $slot_det = $this->customer_employee_slot_details($id);
        $slot_from = $slot_det['time_from'];
        $slot_to = $slot_det['time_to'];
        if ($time_from == '' && $time_to == "") {
            $this->tables = array('timetable');
            $this->fields = array('type');
            $this->field_values = array($type);
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            if ($this->query_update())
                return true;
            else
                return false;
        }
        else if ($time_from == $slot_from && $time_to == $slot_to) {// for same shift only changing the type and status 1
            $this->tables = array('timetable');
            $this->fields = array('type');
            $this->field_values = array($type);
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);

            if ($customer != NULL) {
                $this->fields[] = 'customer';
                $this->field_values[] = $customer;
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields[] = 'status';
                    $this->field_values[] = 1;
                }
            }
            return $this->query_update();
        }
        else if ($time_from == $slot_from && $time_to != $slot_to && $time_to < $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }

            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else 
                return false;
        } else if ($time_from == $slot_from && $time_to != $slot_to && $time_to > $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);

            return $this->query_update();
        } else if ($time_from != $slot_from && $time_to == $slot_to && $time_from > $slot_from) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
//                $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else
                return false;
        } else if ($time_from != $slot_from && $time_to == $slot_to && $time_from < $slot_from) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
//                $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            return $this->query_update();
        } else if ($time_from != $slot_from && $time_to != $slot_to && $time_from < $slot_from && $time_to > $slot_to) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
//                $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            return $this->query_update();
        } else if ($time_from != $slot_from && $time_to != $slot_to && $time_from < $slot_from && $time_to < $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }

            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else 
                return false;
        } else if ($time_from != $slot_from && $time_to != $slot_to && $time_from > $slot_from && $time_to > $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
            $this->tables = array('timetable');
            if ($customer != NULL) {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
                }
            } else {
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
            }
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else 
                return false;
        } else {// if slot adds in between updating exiting with new type and status 1 and adding new 2 slots with previous data
//                $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array(array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']),
                array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']));
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from', 'time_to', 'type', 'status', 'fkkn');
                $this->field_values = array($time_from, $time_to, $type, $slot_det['status'], $slot_det['fkkn']);

                if ($customer != NULL) {
                    $this->fields[] = 'customer';
                    $this->field_values[] = $customer;
                    if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
                        $this->fields[] = 'status';
                        $this->field_values[] = 1;
                    }
                }

                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else 
                return false;
        }
        //}
    }

    function time_slot_type_update_for_PM($exist_slot, $keyindex, $type, $time_from = '', $time_to = '', $customer = NULL, $employee = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 17-08-2013
         * @for: type changing procedure for personal meeting with a list of employees(ajax_alloc_action.php)
         */
        $id = $exist_slot[$keyindex]['id'];
        $slot_det = $this->customer_employee_slot_details($id);
        if (empty($slot_det))
            return FALSE;
        $slot_from = $slot_det['time_from'];
        $slot_to = $slot_det['time_to'];
        $___calculated_customer = ($customer != NULL ? $customer : $slot_det['customer']);
        $___calculated_employee = ($employee != NULL ? $employee : $slot_det['employee']);
        $___calculated_status = ($___calculated_customer != '' && $___calculated_employee != '' && $slot_det['status'] != 2  ? 1 : $slot_det['status']);

        $total_no_of_exist_slots = count($exist_slot);
        $have_prev_slot = ($total_no_of_exist_slots > 1 && $keyindex > 0 ? TRUE : FALSE);
        $have_forw_slot = ($total_no_of_exist_slots > 1 && $keyindex < $total_no_of_exist_slots - 1 ? TRUE : FALSE);

        // for same shift only changing the type and status 1
        if ($time_from == $slot_from && $time_to == $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'status', 'alloc_emp');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $___calculated_status, $_SESSION['user_id']);
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            return $this->query_update();
        }

        // adding new slot with new type, status = 1 @ the begin and updating existing slot's time_from
        else if ($time_from == $slot_from && $time_to < $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $time_from, $time_to, $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);

            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else
                return false;
        }

        // updating existing slots with new time_to and relative credentials (like customer, status)
        else if ($time_from == $slot_from && $time_to > $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $time_from, $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);

            if ($have_forw_slot) {
                $this->fields = array_merge($this->fields, array('time_to'));
                $this->field_values = array_merge($this->field_values, array($exist_slot[$keyindex + 1]['time_from']));
            } else {
                $this->fields = array_merge($this->fields, array('time_to'));
                $this->field_values = array_merge($this->field_values, array($time_to));
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);

            return $this->query_update();
        }

        // updating existing slot's time_to and adding new slot with new type, status 1 @ the end 
        else if ($time_to == $slot_to && $time_from > $slot_from) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $time_from, $time_to, $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);
            
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else
                return false;
        }

        // updating existing slots with new time_from and relative credentials (like customer, status)
        else if ($time_to == $slot_to && $time_from < $slot_from) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_to', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $time_to, $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);
            
            if ($have_prev_slot) {
                $this->fields = array_merge($this->fields, array('time_from'));
//                $this->field_values = array_merge($this->field_values, array($exist_slot[$keyindex - 1]['time_to']));
                $this->field_values = array_merge($this->field_values, array($slot_det['time_from']));  //bcoz, itz prev slot's time_to was just changed to this slot time_from
            } else {
                $this->fields = array_merge($this->fields, array('time_from'));
                $this->field_values = array_merge($this->field_values, array($time_from));
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            return $this->query_update();
        }

        // updating existing slots with new time_from, time_to and relative credentials (like customer, status)
        else if ($time_from < $slot_from && $time_to > $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);
            
            if ($have_prev_slot) {
                $this->fields = array_merge($this->fields, array('time_from'));
//                $this->field_values = array_merge($this->field_values, array($exist_slot[$keyindex - 1]['time_to']));
                $this->field_values = array_merge($this->field_values, array($slot_det['time_from']));  //bcoz, itz prev slot's time_to was just changed to this slot time_from
            } else {
                $this->fields = array_merge($this->fields, array('time_from'));
                $this->field_values = array_merge($this->field_values, array($time_from));
            }

            if ($have_forw_slot) {
                $this->fields = array_merge($this->fields, array('time_to'));
                $this->field_values = array_merge($this->field_values, array($exist_slot[$keyindex + 1]['time_from']));
            } else {
                $this->fields = array_merge($this->fields, array('time_to'));
                $this->field_values = array_merge($this->field_values, array($time_to));
            }

            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            return $this->query_update();
        }

        // adding new slot with new type, new time_from @ the begin and updating existing slot's time_from
        else if ($time_from < $slot_from && $time_to < $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_to', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $time_to, $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);
            
            if ($have_prev_slot) {
                $this->fields = array_merge($this->fields, array('time_from'));
//                $this->field_values = array_merge($this->field_values, array($exist_slot[$keyindex - 1]['time_to']));
                $this->field_values = array_merge($this->field_values, array($slot_det['time_from']));  //bcoz, itz prev slot's time_to was just changed to this slot time_from
            } else {
                $this->fields = array_merge($this->fields, array('time_from'));
                $this->field_values = array_merge($this->field_values, array($time_from));
            }

            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else
                return false;
        }

        // updating existing slot's time_to and adding new slot with new type, new time_to @ the end 
        else if ($time_from > $slot_from && $time_to > $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $slot_det['date'], $time_from, $___calculated_status, $_SESSION['user_id'], $slot_det['fkkn']);
            
            if ($have_forw_slot) {
                $this->fields = array_merge($this->fields, array('time_to'));
                $this->field_values = array_merge($this->field_values, array($exist_slot[$keyindex + 1]['time_from']));
            } else {
                $this->fields = array_merge($this->fields, array('time_to'));
                $this->field_values = array_merge($this->field_values, array($time_to));
            }

            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else 
                return false;
        }

        // if slot adds in between, update exiting with new type and status 1 and adding new 2 slots with previous data
        else if ($time_from > $slot_from && $time_to < $slot_to) {
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
            $this->field_values = array(array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']),
                                        array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']));
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('employee', 'customer', 'type', 'time_from', 'time_to', 'status', 'alloc_emp');
                $this->field_values = array($___calculated_employee, $___calculated_customer, $type, $time_from, $time_to, $___calculated_status, $_SESSION['user_id']);
            
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else 
                return false;
        }
    }

    function employee_slot_split($id, $time_from = '', $time_to = '') {

        $slot_det = $this->customer_employee_slot_details($id);
        $slot_from = $slot_det['time_from'];
        $slot_to = $slot_det['time_to'];

        if ($time_from == $slot_from && $time_to == $slot_to) {// for same shift nothing do
            return true;
        } else if ($time_from == $slot_from && $time_to != $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'fkkn', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_from, $time_to, $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']);
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else {
                return false;
            }
        } else if ($time_from != $slot_from && $time_to == $slot_to) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
            $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'fkkn', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_from, $time_to, $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']);
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else {
                return false;
            }
        } else {// if slot adds in between updating exiting with new type and status 1 and adding new 2 slots with previous data
            $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'fkkn', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array(array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']),
                array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']));
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from', 'time_to');
                $this->field_values = array($time_from, $time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                return $this->query_update();
            } else {
                return false;
            }
        }
    }

    //slot addding
    function customer_employee_slot_add($employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = '', $type = 0, $relation_id = '',$comment = null, $status = 1) {

       // $obj_cust = new customer();
       // $obj_emp = new employee();
        
       // if($_SESSION['fkkn']){
       //     $fkkn = $_SESSION['fkkn'];
       // }
       // if($employee != ''){
       //     $emp_detail = $this->get_employee_details($employee);
       //     if(!empty($emp_detail)){
       //         $fkkn = $emp_detail[0]['fkkn'];
       //     }
       // }
        if($time_from == $time_to) return true;
        
        $created_status = ($status == 4 ? 1 : NULL);
        if($fkkn == ''){
            if ($customer != '') {
                $cust_detail = $this->get_customer_details($customer);
                $fkkn = (!empty($cust_detail) ? $cust_detail[0]['fkkn'] : 1);
            }else
                $fkkn = 1;
        }
       
        if ($employee == '' || $customer == '') {
            $status = 0;
            $relation_id = '';
        }
        if ($_SESSION['user_role'] == 4 && $status != 4) $status = 3; 
        if($comment == NULL || $comment == "") $comment = NULL;

        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'fkkn', 'type', 'date', 'time_from', 'time_to', 'status', 'created_status', 'alloc_emp', 'comment');
        $this->field_values = array($employee, $customer, $fkkn, $type, $date, $time_from, $time_to, $status, $created_status, $alloc_emp, $comment);
        if ($relation_id != '') {
            $this->fields[] = 'relation_id';
            $this->field_values[] = $relation_id;
        }
        return $this->query_insert();
    }
    
    function customer_employee_multiple_slot_direct_add($slot_datas) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: multiple slot adding with single db request
         * This function maily used in $employee->copy_weeks()
         * @warning: order and length of array values should be equal/same
         * @since: 2014-09-17
         */
        $input_array = array();
        if(!empty($slot_datas)){
            foreach($slot_datas as $slot_data){
                if(empty($slot_data)) continue;
                $input_array[] = array($slot_data['employee'], $slot_data['customer'], $slot_data['fkkn'], $slot_data['type'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['status'], $slot_data['created_status'], $slot_data['alloc_emp'], $slot_data['comment'], $slot_data['relation_id']);
            }
        }
        
        if(empty($input_array)) return FALSE;
        
        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'fkkn', 'type', 'date', 'time_from', 'time_to', 'status', 'created_status', 'alloc_emp', 'comment', 'relation_id');
        $this->field_values = $input_array;
        return $this->query_insert();
    }
    
    
    function get_datas_customer_employee_slot_add($employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = NULL, $type = 0, $relation_id = NULL, $comment = null, $status = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: this function will return datas for adding records to timetable asper calling parameter
         * return data logics is derived from the function $dona->customer_employee_slot_add()
         * This function maily used in $employee->copy_weeks()
         * @since: 2014-09-17
         */
        if($time_from == $time_to) return array();
        
        $created_status = ($status == 4 ? 1 : NULL);
        
        if($fkkn == NULL){
            if ($customer != '') {
                $cust_detail = $this->get_customer_details($customer);
                $fkkn = (!empty($cust_detail) ? $cust_detail[0]['fkkn'] : 1);
            }else
                $fkkn = 1;
        }
       
        if ($employee == '' || $customer == '') {
            $status = 0;
            $relation_id = NULL;
        }
        if ($_SESSION['user_role'] == 4) $status = 3; 
        if($comment == NULL || $comment == "") $comment = NULL;
        if($relation_id == '') $relation_id = NULL;

        $return_array = array(
            'employee'  => $employee, 
            'customer'  => $customer, 
            'fkkn'      => $fkkn, 
            'type'      => $type, 
            'date'      => $date, 
            'time_from' => $time_from, 
            'time_to'   => $time_to, 
            'status'    => $status, 
            'created_status'=> $created_status, 
            'alloc_emp' => $alloc_emp, 
            'comment'   => $comment,
            'relation_id'=> $relation_id);
        
        return $return_array;
    }

    //removing skill from a particular slot
    function customer_employee_skill_remove($id, $alloc_emp) {

        $this->tables = array('timetable');
        $this->fields = array('work', 'employee', 'status', 'alloc_emp');
        $this->field_values = array('', '', '0', $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    // details of a particular slot
    function customer_employee_slot_details($id) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_employee_multi_slot_details($ids, $status = NULL) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($status != NULL) {
            $this->conditions = array('AND', array('IN', 'id', $ids), 'status = ?');
            $this->condition_values = array($status);
        } else {
            $this->conditions = array('AND', array('IN', 'id', $ids));
        }
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    //converting an entered time to sixty hours
    function time_to_sixty_old($time) {
        //$allowed = array(0, 5, 10 15, 30, 45);
        $time_sixty = "";
        if ($time >= 48 && $time <= 4800) {
            $minute = intval($time % 100);
            $minute_sixty = intval($time % 100 * 60 / 100);
            if ($minute >= 60) {
                if ($minute_sixty % 5 == 0)
                    return ((intval($time / 100)) % 24 . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                else
                    return false;
            }else if ($minute < 60) {
                if ($minute % 5 == 0)
                    return ((intval($time / 100)) % 24 . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                else
                    return false;
            }
            else
                return false;
        }
        else if ($time < 48) {

            if (strstr($time, '.')) {

                $time_sixty = intval($time) % 24;
                $minute = intval(sprintf(($time - intval($time)) * 100));

                /* echo "<script>alert(\"".in_array($minute, $allowed)."\")</script>"; */
                $minute_sixty = intval($minute / 100 * 60);
                if ($minute >= 60) {
                    if ($minute_sixty % 5 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }else if ($minute < 60) {
                    if ($minute % 5 == 0)
                        return ($time_sixty . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }
            else if (substr($time, 0, 2) == '00') {

                $time_sixty = 0;
                $minute = intval($time);
                $minute_sixty = intval($minute / 100 * 60);
                if ($minute >= 60) {
                    if ($minute_sixty % 5 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }else if ($minute < 60) {
                    if ($minute % 5 == 0)
                        return ($time_sixty . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }else {

                return ($time % 24);
            }
        }
        else
            return false;
    }
    function time_to_sixty($time) {
        $time_sixty = "";
        
        if ($time >= 48 && $time <= 4800) {
            $time = (float) $time;
//            $minute = intval($time % 100);
//            $minute_sixty = intval($time % 100 * 60 / 100);
            $minute = round($time % 100);
            $minute_sixty = round($time % 100 * 60 / 100);
            if ($minute >= 60) {
                if ($minute_sixty % 1 == 0){
//                    return ((intval($time / 100)) % 24 . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                    return ((floor($time / 100)) % 24 . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                }else
                    return false;
            }else if ($minute < 60) {
                if ($minute % 1 == 0){
//                    return ((intval($time / 100)) % 24 . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                    return ((floor($time / 100)) % 24 . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                }else
                    return false;
            }
            else
                return false;
        }
        else if ($time < 48) {
            
            if (strstr($time, '.')) {
//                $time_sixty = intval($time) % 24;
                $time_sixty = floor($time) % 24;
//                $minute = intval(sprintf(($time - intval($time)) * 100));
                $minute = round(($time - floor($time)) * 100);

                /* echo "<script>alert(\"".in_array($minute, $allowed)."\")</script>"; */
//                $minute_sixty = intval($minute / 100 * 60);
                $minute_sixty = round($minute / 100 * 60);
                if ($minute >= 60) {
                    if ($minute_sixty % 1 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }else if ($minute < 60) {
                    if ($minute % 1 == 0)
                        return ($time_sixty . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }
            else if (substr($time, 0, 2) == '00') {

                $time_sixty = 0;
//                $minute = intval($time);
//                $minute_sixty = intval($minute / 100 * 60);
                $minute = round($time);
                $minute_sixty = round($minute / 100 * 60);
                if ($minute >= 60) {
                    if ($minute_sixty % 1 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }else if ($minute < 60) {
                    if ($minute % 1 == 0)
                        return ($time_sixty . '.' . (str_pad($minute, 2, '0', STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }else {

                return ($time % 24);
            }
        }
        else
            return false;
    }

    //removing the whole time_slot 
    function customer_employee_slot_remove($id) {

        $obj_emp = new employee();
        $slot_det = $this->customer_employee_slot_details($id);
        $this->tables = array('timetable');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            if ($slot_det['employee'] && $slot_det['customer'])
                $obj_emp->removeATL($slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['customer']);
            return true;
        }
        else
            return false;
    }

    function get_all_employee_leave_for_export($year = NULL, $month = NULL, $emp = NULL) {
        /**
         * Author: Shaju
         * for: get all employee leave asper their role
         * using at covertor class in visma,hogia and crona functions
         */
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

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
            'leave.employee as employee', "(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.employee) AS empname",
            'leave.status as status', 'leave.appr_date as appr_date',
            'leave.appr_emp as appr_emp', "(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.appr_emp) AS appr_empname");
        switch ($login_user_role) {
            case 1:
                if ($year != NULL && $month != NULL) {
                    if ($emp != NULL) {
                        $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee = ?');
                        $this->condition_values = array($year, $month, $emp);
                    } else {
                        $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?');
                        $this->condition_values = array($year, $month);
                    }
                } else {
                    $this->conditions = array();
                }
                break;
        }
        $this->group_by = array('leave.group_id');
        $this->order_by = array('leave.date desc');
        $this->limit = 0;
        $this->query_generate();
        $datas = $this->query_fetch();

        return $datas;
    }

    /* ----------------------------------------shaju------------------------------- */

    /* ----------------------------------------shamsu------------------------------ */

    function distinct_leave_years() {
        $this->tables = array('leave');
        $this->fields = array('distinct(year(date)) as years');
        // $this->conditions = array('employee = ?');
        //$this->condition_values = array($employee);
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function get_all_employee_leave($year = NULL, $month = NULL, $emp = NULL, $search_text = NULL, $status = NULL, $show = 'LIMIT') {
        /**
         * Author: Shamsu
         * for: get all employee leave asper their role
         */
//        echo "func_get_args<pre>".print_r(func_get_args(), 1)."</pre>";
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        if ($login_user_role == 7) {
            $get_leaves = array();
            $processed_employees = array();     //used to check previously queried with this employees

            /* this section for team leader */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 7);
            foreach ($team_customers as $cust_name) {
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query

                foreach ($team_employees as $sel_emp) {
                    if (!in_array($sel_emp, $processed_employees)) {
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] = $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 1, $search_text, $status); // 1 indicates have privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }

            /* this section for normal user */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 3);
            foreach ($team_customers as $cust_name) {
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query

                foreach ($team_employees as $sel_emp) {
                    if (!in_array($sel_emp, $processed_employees)) {
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] = $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 0, $search_text, $status);   // 0 indicates have no privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }
            return $get_leaves;
        }

        else if ($login_user_role == 2) {
            $get_leaves = array();
            $processed_employees = array();     //used to check previously queried with this employees

            /* this section for team leader */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 2);
            foreach ($team_customers as $cust_name) {
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query

                foreach ($team_employees as $sel_emp) {
                    if (!in_array($sel_emp, $processed_employees)) {
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] = $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 1, $search_text, $status); // 1 indicates have privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }

            /* this section for normal user */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 3);
            foreach ($team_customers as $cust_name) {
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query

                foreach ($team_employees as $sel_emp) {
                    if (!in_array($sel_emp, $processed_employees)) {
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] = $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 0, $search_text, $status);   // 0 indicates have no privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }
            return $get_leaves;
        }

        else if ($login_user_role == 3) {
            //            $team_members = $employee->team_members($login_user);
            //            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
            $team_employee_data = '\'' . $login_user . '\'';
        }

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
        $this->fields = array('`leave`.id as id', '`leave`.group_id as gID', '`leave`.type as type', '(' . $sub_query_from_date . ') AS From_date',
            '(' . $sub_query_to_date . ') AS To_date',
            '`leave`.employee as employee', "(SELECT concat(first_name,' ',last_name) FROM employee where username = `leave`.employee) AS empname","(SELECT concat(last_name,' ',first_name) FROM employee where username = `leave`.employee) AS empname_lf",
            '`leave`.status as status', '`leave`.appr_date as appr_date',
            '`leave`.appr_emp as appr_emp', "(SELECT concat(first_name,' ',last_name) FROM employee where username = `leave`.appr_emp) AS appr_empname","(SELECT concat(last_name,' ',first_name) FROM employee where username = `leave`.appr_emp) AS appr_empname_lf", '`leave`.comment as comment');
            //        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '('. $sub_query_from_date .') AS From_date', 
            //            '('. $sub_query_to_date .') AS To_date', 'leave.employee as employee',"concat(employee.last_name,' ',employee.first_name) as empname", 
            //            'leave.status as status', 'leave.appr_date as appr_date',
            //            'leave.appr_emp as appr_emp', "concat(e1.last_name,' ',e1.first_name) as appr_empname");
        switch ($login_user_role) {
            case 1:
                /* if ($year != NULL && $month != NULL) {
                  if ($emp != NULL) {
                  $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                  $this->condition_values = array($year, $month, $emp);
                  }else{
                  $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                  $this->condition_values = array($year, $month);
                  }
                  } else {
                  $this->conditions = array('AND', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                  } */
                
                if ($year != NULL && $month != NULL) {
                    $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?');
                    $this->condition_values = array($year, $month);
                    
                    if ($emp != NULL) {
                        $this->conditions[] = 'leave.employee = ?';
                        $this->condition_values[] = $emp;
                    }
                    
                    if ($status !== NULL) {
                        $this->conditions[] = 'leave.status = ?';
                        $this->condition_values[] = $status;
                    }
                } else {
                    //$this->conditions = array();
                    $this->conditions = array('leave.status = ?');
                    $this->condition_values[] = array(0);
                }
                break;

            case 2:
                $this->conditions = array('AND', array('IN', '`leave`.`employee`', $team_employee_data));
                
                if ($year != NULL && $month != NULL) {
                    $this->conditions[] = 'year(leave.date) = ?';
                    $this->condition_values[] = $year;
                    $this->conditions[] = 'month(leave.date) = ?';
                    $this->condition_values[] = $month;
                    
                    if ($emp != NULL) {
                        $this->conditions[] = 'leave.employee = ?';
                        $this->condition_values[] = $emp;
                    }
                    if ($status !== NULL) {
                        $this->conditions[] = 'leave.status = ?';
                        $this->condition_values[] = $status;
                    }
                }
                break;

            case 3:
                $this->conditions = array('AND', array('OR', 'leave.employee = ?',
                    array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'leave.status = 1'),
                ));
                $this->condition_values = array($login_user);
                
                if ($year != NULL && $month != NULL) {
                    $this->conditions[] = 'year(leave.date) = ?';
                    $this->condition_values[] = $year;
                    $this->conditions[] = 'month(leave.date) = ?';
                    $this->condition_values[] = $month;
                        
                    if ($emp != NULL) {
                        $this->conditions[] = 'leave.employee = ?';
                        $this->condition_values[] = $emp;
                    }
                    if ($status !== NULL) {
                        $this->conditions[] = 'leave.status = ?';
                        $this->condition_values[] = $status;
                    }
                }
                break;
            default:
                $this->flush();
                return array();
                break;
        }
        //include search text
        if($search_text != NULL)
            $this->conditions[] = 'LOWER(leave.comment) like "%'.strtolower ($search_text).'%"';
        $this->group_by = array('`leave`.group_id');
        $this->order_by = array('`leave`.date desc');
        if ($year == NULL && $month == NULL && $show == 'LIMIT')
            $this->limit = 100;
        else
            $this->limit = 0;
        $this->query_generate();       
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_leave_customer_formation($datas){
        $i= 0;
        foreach($datas as $data){
            // $this->tables = array('timetable` as `t', 'leave` as `l', 'customer` as  `c');
            // $this->fields = array('distinct t.customer as customer', 'CONCAT(c.first_name, " " , c.last_name) as name', 't.date as slot_date');
            // $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 2', 't.employee = ?',
            //     't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to' , 'c.username like t.customer');
            // $this->condition_values = array(date('Y-m-d', strtotime($data['From_date'])), date('Y-m-d', strtotime($data['To_date'])), $data['employee']);
            // $this->group_by = array('customer');
            // $this->query_generate();

            $this->flush();
            $this->sql_query = 'SELECT t.customer as customer, CONCAT(c.first_name, " " , c.last_name) as name, t.date as slot_date, l.id as leave_id
                FROM `timetable` as `t`
                LEFT JOIN `leave` as `l` ON (t.date = l.date AND t.employee like l.employee AND l.time_from <= t.time_from AND l.time_to >= t.time_to )
                LEFT JOIN `customer` as `c` ON ( `t`.customer LIKE `c`.username)
                WHERE (t.date BETWEEN ? AND ?) 
                AND t.employee = ? 
                AND t.status = 2
                GROUP BY `t`.customer 
                HAVING leave_id IS NOT NULL AND name IS NOT NULL ';
            $this->condition_values = array(date('Y-m-d', strtotime($data['From_date'])), date('Y-m-d', strtotime($data['To_date'])), $data['employee']);
            // if(isset($_COOKIE['admin']) && $_COOKIE['admin'] == 'debug'){
            //     echo $this->sql_query;
            //     echo "<pre>".print_r($this->condition_values,1)."</pre>"; 
            //     exit();
            // }
            $temp_data = $this->query_fetch();
            $datas[$i]['customer_data'] = $temp_data;
            $i++;
        }
        return $datas;
    }

    function get_team_member_leaves_when_TL_login($members, $year = NULL, $month = NULL, $editable_flag = 0, $search_text = NULL, $status = NULL) {

        $this->tables = array('leave');
        $this->fields = array('concat( date, " ", `time_from` )');
        $this->conditions = array('group_id = gID');
        $this->order_by = array('date ASC ');
        $this->limit = 1;
        $this->query_generate();
        $sub_query_from_date = $this->sql_query;

        // to get to_date and time
        $this->tables = array('leave');
        $this->fields = array('concat( date, " ", `time_to` )');
        $this->conditions = array('group_id = gID');
        $this->order_by = array('date DESC ');
        $this->limit = 1;
        $this->query_generate();
        $sub_query_to_date = $this->sql_query;


        $this->tables = array('leave', 'employee', 'employee` as `e1');
        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '(' . $sub_query_from_date . ') AS From_date',
            '(' . $sub_query_to_date . ') AS To_date', 'leave.employee as employee', "concat(employee.first_name,' ',employee.last_name) as empname",
            "(SELECT concat(last_name,' ',first_name) FROM employee where username = leave.employee) AS empname_lf",
            'leave.status as status', 'leave.appr_date as appr_date',
            'leave.appr_emp as appr_emp', "concat(e1.first_name,' ',e1.last_name) as appr_empname",
            "(SELECT concat(last_name,' ',first_name) FROM employee where username = leave.appr_emp) AS appr_empname_lf", $editable_flag . ' as privilege');
        if ($year != NULL && $month != NULL) {
            $this->conditions = array('AND', array('IN', '`leave`.`employee`', $members), 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee = employee.username', 'leave.appr_emp = e1.username');
            $this->condition_values = array($year, $month);
        } else {
            $this->conditions = array('AND', array('IN', '`leave`.`employee`', $members), 'leave.employee = employee.username', 'leave.appr_emp = e1.username');
        }

        //include search text
        if($search_text != NULL)
                $this->conditions[] = 'LOWER(leave.comment) like "%'.strtolower ($search_text).'%"';
        
        if ($status !== NULL) {
            $this->conditions[] = 'leave.status = ?';
            $this->condition_values[] = $status;
        }
        
        $this->group_by = array('leave.group_id');
        $this->order_by = array('leave.date desc');
        $this->limit = 0;
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_unread_leave() {

        $login_user = $_SESSION['user_id'];
        /*
          $this->tables = array('mc_leave');
          $this->fields = array('leave_id');
          $this->conditions = array('read_users LIKE \'%' . $login_user . '%\' ');
          //$this->conditions = array('read_users LIKE \'%?%\' ');
          $this->query_generate();
          $sub_query = $this->sql_query;

          $this->tables = array('leave');
          $this->fields = array('group_id');
          $this->conditions = array('group_id NOT IN (' . $sub_query . ')');
          //$this->condition_values = array($login_user);
          $this->query_generate();
         */
        $this->tables = array("SELECT DISTINCT l.group_id
                                FROM `leave` AS l
                                LEFT JOIN `mc_leave` AS mcl ON ( mcl.leave_id = l.group_id )
                                WHERE (mcl.read_users NOT LIKE '%$login_user%'
                                OR mcl.leave_id IS NULL) AND l.status = 0");
        $this->query_generate_leftjoin();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function attach_unread_column($all_list, $unread_list) {         //this function is not used  (first time it is used in  message_center_leave.php
        for ($i = 0; $i < count($all_list); $i++) {
            if (in_array($all_list[$i]['id'], $unread_list)) {
                $all_list[$i]['unread'] = 0; // 0 indicated unread leaves
            } else {
                $all_list[$i]['unread'] = 1; // 1 indicated read leaves
            }
        }
        return ($all_list);
    }

    function get_all_unread_leaves($all_list, $unread_list) {

        // this function is used to take all unread leaves according to that loged user when he is first taking message center leave option
        $u_leave = array();
        for ($i = 0; $i < count($all_list); $i++) {
            if (in_array($all_list[$i]['gID'], $unread_list))
                $u_leave[] = $all_list[$i];
        }
        return ($u_leave);
    }

    function get_leave_read_users($id) {

        $this->tables = array('mc_leave');
        $this->fields = array('read_users');
        $this->conditions = array('leave_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function check_leaveID_exist($id) {

        $this->tables = array('mc_leave');
        $this->fields = array('leave_id');
        $this->conditions = array('leave_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (!empty($datas))
            return TRUE;  //return true if id exist in mc_leave
        else
            return FALSE;  //return false if id not exist in mc_leave
    }

    function set_as_read_leaves($data) {
        $inserted_array = array();            
        foreach ($data as $row) {
            //if($row['unread']==0)
            //{
            if ($this->check_leaveID_exist($row['gID'])) {
                //updation
                $read_users_list = $this->get_leave_read_users($row['gID']); // get already leave readed users

                $this->tables = array('mc_leave');
                $this->fields = array('read_users');
                $this->field_values = array($read_users_list[0] . ',' . $_SESSION['user_id']);
                $this->conditions = array('leave_id = ?');
                $this->condition_values = array($row['gID']);
                $this->query_update();
            } else {
                  $inserted_array[] = array($row['gID'], $row['status'], $_SESSION['user_id']);
            }
            //}
        }
        if(!empty($inserted_array)){
            $this->tables = array('mc_leave');
            $this->fields = array('leave_id', 'leave_status', 'read_users');
            $this->field_values = $inserted_array;
            $this->query_insert();
        }
    }

    function Customer_pdf_work_report($customer, $month, $year, $fkkn, $this_bargaining = NULL, $txt_other_bargaining = NULL, $this_agreement = array(), $employee = Null, $sam_sida = Null, $provider_of_pa = NULL, $obj_pdf = NULL) {
        /**
         * Author: Shamsu
         * for: FKKN customer work report
         * if @param $obj_pdf is not NULL, this function will return pdf object (not the pdf output)
         */
        require_once ('class/company.php');
        if($obj_pdf != NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_customer();

        $obj_company		= new company();
        $obj_employee		= new employee();
        $obj_general		= new general();
        //$obj_contract		= new contract();
        $pdf->tot_normal	= 0;
        $pdf->tot_oncall	= 0;
        $pdf->tot_beredskap	= 0;
        $flag				= FALSE;
        $employee_names		= array();
        if($employee == '') $employee = NULL;
        //---------------------------
        $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details = $this->get_customer_details($customer);
        if ($employee == NULL) {
            $login_user = $_SESSION['user_id'];
            $login_user_team_role = $obj_employee->get_team_role_of_employee($login_user, $customer);
            
            if($_SESSION['user_role'] == 3)   //returns only his data
                $employee_names = array($_SESSION['user_id']);
            else {
                if((!empty($login_user_team_role) && ($login_user_team_role['role'] == 2 || $login_user_team_role['role'] == 7)) || ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6 || $_SESSION['user_role'] == 4)){
                    //$employee_names__ = $obj_employee->get_team_employees_of_customer($customer, -1);
                    $employee_names__ = $obj_employee->team_members_with_tt_connected_employees($customer, $year, $month);
                    if(!empty($employee_names__)){
                        foreach($employee_names__ as $team_em){
                            $employee_names[] = $team_em['username'];
                        }
                    }
                } else //returns only his data
                    $employee_names = array($_SESSION['user_id']);
            }
            
            /*$permitted_employees = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
            $permitted_employees_ids = array();
            if(!empty($permitted_employees)){
                foreach($permitted_employees as $p_employee){
                    $permitted_employees_ids[] = $p_employee['username'];
                }
                $employee_namess = $this->get_all_Member_details_for_customer_with_no_trainee($customer, $fkkn, $month, $year, $permitted_employees_ids);  //take employee names who work for a specific customer
                
                if (!empty($employee_namess)) {
                    foreach ($employee_namess as $employee_s)
                        $employee_names[] = $employee_s['empID'];
                }
            }*/
        }
        else
            $employee_names = array($employee);
        $no_of_employees_have_slots = 0;
        
        //        echo "<pre>".print_r($cust_details, 1)."</pre>";
                //calculate company calculation periods 
        //        $month_start_date = date('Y-m-01', strtotime($year.'-'.$month.'-01'));
        //        $month_end_date = date('Y-m-t', strtotime($year.'-'.$month.'-01'));
        
        /* Beredeskap period calculation based on customer records */
        /*$tmp_calculation_start_month = ($cust_details[0]['employee_contract_start_month'] != '' ? $cust_details[0]['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
        $calculation_period_length = ($cust_details[0]['employee_contract_period_length'] != '' && $cust_details[0]['employee_contract_start_month'] != '' ?  $cust_details[0]['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
        $calculation_period_month_start_date = ($cust_details[0]['employee_contract_period_date'] != '' && $cust_details[0]['employee_contract_start_month'] != '' ?  $cust_details[0]['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
        $flag_found_calculation_period = FALSE;
        $is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
        $is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;
        $contract_calculation_values = array();
        $contract_calculation_previous_values = array();

        if(!$is_month_starting_first_date){     //for keeping previous calculation period
            $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
            $pre_year_start = $year;
            if($pre_month_start < 1){
                $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
                $pre_year_start--;
            }

            $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
            if($is_month_starting_last_date){
                $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($year.'-'.$tmp_calculation_start_month.'-01'));
                $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
            }else
                $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
        }

        while(!$flag_found_calculation_period){
            $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
            if($tmp_calculation_end_month > 12){
                if(($tmp_calculation_start_month <= $month && $month <= 12) || (1 <= $month && $month <= ($tmp_calculation_end_month-12))){
                    $flag_found_calculation_period = TRUE;
                    $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
                    if($tmp_calculation_start_month <= $month && $month <= 12){
                        $contract_calculation_values['start_year'] = $year;
                        $contract_calculation_values['end_year'] = $year+1;
                    }else {
                        $contract_calculation_values['start_year'] = $year - 1;
                        $contract_calculation_values['end_year'] = $year;
                    }
                } 
                else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                    $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
                    $contract_calculation_previous_values['start_year'] = $year;
                    $contract_calculation_previous_values['end_year'] = $year+1;
                }
            }else {
                if($tmp_calculation_start_month <= $month && $month <= $tmp_calculation_end_month){
                    $flag_found_calculation_period = TRUE;
                    $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
                    $contract_calculation_values['start_year'] = $year;
                    $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($year+1) : $year;
                }
                else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                    $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
                    $contract_calculation_previous_values['start_year'] = $year;
                    $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($year+1) : $year;
                }
            }
            if($flag_found_calculation_period){
                if($is_month_starting_first_date)
                    $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
                else
                    $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

                if($is_month_starting_first_date)
                    $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
                else{
                    $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
                    if($is_month_starting_last_date){
                        $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                        $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
                    }else{
                        $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                    }
                }
            }
            else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

                $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
                if($is_month_starting_last_date){
                    $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                }else{
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                }
            }
            $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
        }*/
        
        for ($i = 0; $i < count($employee_names); $i++) {
            $work_details = $this->get_Customer_employee_report_data($employee_names[$i], $customer, $month, $year, $fkkn);
            // echo "<pre>$employee_names[$i]".print_r($work_details, 1)."</pre>";
            $emp_details = $this->get_employee_details($employee_names[$i]);
            $sign_details = $this->get_employee_signing_details($employee_names[$i], $month, $year, $customer);
            $employer_sign_details = $obj_employee->employer_signing_details($customer, $month, $year, $fkkn, $employee_names[$i]);
            $defaults = $this->check_exists_fkkn_form_defaults($customer, $employee_names[$i], TRUE);
            //echo "<pre>$employee_names[$i]".print_r($defaults, 1)."</pre>";
            $this_bargaining = $txt_other_bargaining = $provider_of_pa = NULL;
            $this_agreement = array();
            if(!empty($defaults)){
                $this_bargaining = $defaults[0]['bargaining_new'];
                $txt_other_bargaining = NULL;
                $provider_of_pa = $defaults[0]['provider_of_pa_flag'];
                if($provider_of_pa == 2){
                    $this_agreement['type'] = $defaults[0]['agreement_types_new'];
                    $this_agreement['type2_company'] = $defaults[0]['agreement_type2_company'];
                    $this_agreement['type2_orgno'] = $defaults[0]['agreement_type2_orgNo'];
                    $this_agreement['company_cp_name'] = $defaults[0]['company_cp_name'];
                    $this_agreement['company_cp_phone'] = $obj_general->format_mobile($defaults[0]['company_cp_phone']);
                }
            }
            //$pdf->current_customer_employee_total_normal_hours = 0;
            //$pdf->current_customer_employee_total_oncall_hours = 0;
            
            if (empty($work_details)) continue;

            $tmp_calculation_start_month = ($emp_details[0]['employee_contract_start_month'] != '' ? $emp_details[0]['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
            $calculation_period_length = ($emp_details[0]['employee_contract_period_length'] != '' && $emp_details[0]['employee_contract_start_month'] != '' ?  $emp_details[0]['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
            $calculation_period_month_start_date = ($emp_details[0]['employee_contract_period_date'] != '' && $emp_details[0]['employee_contract_start_month'] != '' ?  $emp_details[0]['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
            $flag_found_calculation_period = FALSE;
            $is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
            $is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;
            $contract_calculation_values = array();
            $contract_calculation_previous_values = array();

            if(!$is_month_starting_first_date){     //for keeping previous calculation period
                $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
                $pre_year_start = $year;
                if($pre_month_start < 1){
                    $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
                    $pre_year_start--;
                }

                $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
                if($is_month_starting_last_date){
                    $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($year.'-'.$tmp_calculation_start_month.'-01'));
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                }else
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
            }

            while(!$flag_found_calculation_period){
                $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
                if($tmp_calculation_end_month > 12){
                    if(($tmp_calculation_start_month <= $month && $month <= 12) || (1 <= $month && $month <= ($tmp_calculation_end_month-12))){
                        $flag_found_calculation_period = TRUE;
                        $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
                        if($tmp_calculation_start_month <= $month && $month <= 12){
                            $contract_calculation_values['start_year'] = $year;
                            $contract_calculation_values['end_year'] = $year+1;
                        }else {
                            $contract_calculation_values['start_year'] = $year - 1;
                            $contract_calculation_values['end_year'] = $year;
                        }
                    } 
                    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                        $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
                        $contract_calculation_previous_values['start_year'] = $year;
                        $contract_calculation_previous_values['end_year'] = $year+1;
                    }
                }else {
                    if($tmp_calculation_start_month <= $month && $month <= $tmp_calculation_end_month){
                        $flag_found_calculation_period = TRUE;
                        $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
                        $contract_calculation_values['start_year'] = $year;
                        $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($year+1) : $year;
                    }
                    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                        $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
                        $contract_calculation_previous_values['start_year'] = $year;
                        $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($year+1) : $year;
                    }
                }
                if($flag_found_calculation_period){
                    if($is_month_starting_first_date)
                        $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
                    else
                        $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

                    if($is_month_starting_first_date)
                        $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
                    else{
                        $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
                        if($is_month_starting_last_date){
                            $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                            $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
                        }else{
                            $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                        }
                    }
                }
                else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                    $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

                    $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
                    if($is_month_starting_last_date){
                        $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                    }else{
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                    }
                }
                $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
            }
            
            //echo "<pre>contract_calculation_previous_values".print_r($contract_calculation_previous_values, 1)."</pre>";
            //echo "<pre>contract_calculation_values".print_r($contract_calculation_values, 1)."</pre>";
            
            $is_rpt_smonth_equal_calc_smonth = date('m', strtotime($contract_calculation_values['start_date'])) == $month ? TRUE : FALSE;
            $calculation_period_start_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['start_date'] : $contract_calculation_values['start_date']);
            $calculation_period_end_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['end_date'] : $contract_calculation_values['end_date']);

            $calculation_end_date = '';
            if(date('m', strtotime($calculation_period_end_date)) == $month)
                    $calculation_end_date = $calculation_period_end_date;
            else
                    $calculation_end_date = date('Y-m-t', strtotime("$year-$month-01"));
            
            $employee_period_actual_hours = $this->customer_employee_total_actual_hours_btwn_dates($customer, $calculation_period_start_date, $calculation_end_date, $fkkn, $employee_names[$i], array(1,2,7,8,9,10,11,15,16,17));
            //echo "<pre>".print_r($employee_period_actual_hours, 1)."</pre>";
            
            $special_calculation_array = array();
            if(!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth){
                $special_calculation_array['calculation_period_start_date'] = $contract_calculation_values['start_date'];
                $special_calculation_array['calculation_period_end_date'] = $contract_calculation_values['end_date'];
                
                $special_calculation_array['calculation_end_date'] = '';
                if(date('m', strtotime($contract_calculation_values['end_date'])) == $month)
                        $special_calculation_array['calculation_end_date'] = $contract_calculation_values['end_date'];
                else
                        $special_calculation_array['calculation_end_date'] = date('Y-m-t', strtotime("$year-$month-01"));
                
                $tmp_special_calc_employee_period_actual_hours = $this->customer_employee_total_actual_hours_btwn_dates($customer, $special_calculation_array['calculation_period_start_date'], $special_calculation_array['calculation_end_date'], $fkkn, $employee_names[$i], array(1,2,7,8,9,10,11,15,16,17));
                $special_calculation_array['total_actual_hours'] = round($tmp_special_calc_employee_period_actual_hours['TOTAL_NORMAL'] + $tmp_special_calc_employee_period_actual_hours['TOTAL_ONCALL'] + $tmp_special_calc_employee_period_actual_hours['TOTAL_BEREDSKAP'], 2);
            }
            
            $no_of_employees_have_slots++;
            // $work_partition = array_chunk($work_details, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
            $work_partition = array_chunk($work_details, 40);   //chunk data in to 40 rows, because max 31 entries included @ one page
            foreach ($work_partition as $works) {
                $flag = TRUE;
                //$pdf->setSourceFile('./pdf_forms/FK3059_015_F_001__16_08_25.pdf');
				$pdf->setSourceFile('./pdf_forms/FK3059_016_F_003.pdf');
                $pdf->AddPage();
                $tppl = $pdf->importPage(1); 
                $pdf->useTemplate($tppl);

                $pdf->report_top($month, $year, $fkkn);
                $pdf->SubPart1($cust_details);
                $pdf->SubPart2($emp_details);
                $pdf->SubPart3($this_bargaining);
                // $pdf->SubPart3_table($works);
                $pdf->SubPart4($calculation_period_start_date, $calculation_period_end_date, $employee_period_actual_hours, $special_calculation_array);    // this new block since 2014-07-16
                $pdf->SubPart5($company_data, $this_agreement, $provider_of_pa);  // Currently this is section 5  since 2016-08-26
                $pdf->SubPart6($employer_sign_details);
                // $pdf->SubPart4($emp_details, $sign_details);

                $pdf->AddPage();
                $tppl = $pdf->importPage(3);
                $pdf->useTemplate($tppl);
                $pdf->page2_3059_header($month, $year, $cust_details, $emp_details);
                $pdf->SubPart7_table($works);
                $pdf->SubPart8($emp_details, $sign_details);
                // $pdf->SubPart5($this_bargaining);
                // $pdf->SubPart6($calculation_period_start_date, $calculation_period_end_date, $employee_period_actual_hours, $special_calculation_array);    // this new block since 2014-07-16
                // $pdf->SubPart7($company_data, $this_agreement, $provider_of_pa);  // Currently this is section 5  since 2016-08-26
                // $pdf->SubPart8($employer_sign_details);
            }
        }

        if($obj_pdf != NULL && is_object($obj_pdf)){
            return $obj_pdf;
        }
        else if ($flag) {
            $pdf->summery_data = $this->get_customer_summery_data($customer, $month, $year);
            $pdf->summery_for_3057 = $this->summery_edit($customer, $month, $year, $fkkn, $employee);
            //echo "<pre>".print_r($pdf->summery_data, 1)."</pre>";
            if ($this->samsida == 'print_samsida')  //for print only form 3057
                $pdf->page = 0;
            $pdf->AddPage();
            // $pdf->setSourceFile('./pdf_forms/FK3057_015_F_001__16_08_25.pdf');
            // $pdf->setSourceFile('./pdf_forms/FK3057_016_F_001__17_05_02.pdf');
			$pdf->setSourceFile('./pdf_forms/FK3057_016_F_002.pdf');
            $tppl = $pdf->importPage(1);
            $pdf->useTemplate($tppl);
            $pdf->summery_report_top($month, $year, $fkkn);
            $pdf->summery_SubPart1($cust_details);
            $pdf->summery_SubPart2($no_of_employees_have_slots);
            if (!empty($pdf->summery_data)) {
                $pdf->summery_SubPart3_new();
                $pdf->summery_SubPart3();
                $pdf->summery_SubPart4();
                $pdf->summery_SubPart5();
                $pdf->summery_SubPart6();
                $pdf->summery_SubPart7();
            }
            //$pdf->summery_Sidelabel();

            $pdf->AddPage();
            $tppl = $pdf->importPage(2);
            $pdf->useTemplate($tppl);

            $pdf->summery_report_top_2($cust_details, $month, $year);
            if (!empty($pdf->summery_data)) {
                $total_no_of_hours = $pdf->summery_data[0]['working_hours_4_customer'];
                //$total_no_of_hours = 0.00;
                //$account_date_from = trim($pdf->summery_data[0]['accounting_date_from']);
                //$account_date_to = trim($pdf->summery_data[0]['accounting_date_to']);
                //if($account_date_from != '' && $account_date_to != ''){     //calculate total no. of hours for the customer
                    //$total_no_of_hours = $this->get_customer_slots_btwn_dates($customer,$account_date_from, $account_date_to, $fkkn, 'HOURS_SUM');
                //} 
                $pdf->summery_SubPart8($total_no_of_hours);
                $pdf->summery_SubPart9();
            }
            //$pdf->summery_Sidelabel();

            if ($sam_sida == NULL) {
                $pre_pdf_title = NULL;
                switch ($fkkn) {
                    case 1: $pre_pdf_title = 'FK'; break;
                    case 2: $pre_pdf_title = 'KN'; break;
                    case 3: $pre_pdf_title = 'TU'; break;
                }
                if($fkkn == 2 || $fkkn == 3)
                    $pre_pdf_title .= '_FK_Duplicate';
                $pdf->Output($pre_pdf_title.'_'.$customer.'_'.date('Y-m-d').'.pdf', 'I');
                if($_SESSION['user_role'] == 1){
                    $c_name = $this->create_pdf_samsida($customer, $month, $year, $fkkn, $employee);
                    if ($c_name) {
                        $company = $this->get_company_directory($_SESSION['company_id']);
                        $pdf->Output("./" . $company['upload_dir'] . "/fkkn/" . $c_name, 'F');
                    }
                }
            } else if ($sam_sida == 1) {
                $output_1 = array('tot_onCall' => $pdf->tot_oncall, 'tot_Normal' => $pdf->tot_normal, 'tot_beredskap' => $pdf->tot_beredskap);
                return $output_1;
            }
        } else {
            echo 'No work available';
        }
    }
    
    function Customer_pdf_work_report_for_kn($customer, $month, $year, $fkkn, $this_bargaining = NULL, $txt_other_bargaining = NULL, $this_agreement = array(), $employee = Null, $sam_sida = Null, $provider_of_pa = NULL, $obj_pdf = NULL) {
        /**
         * Author: Shamsu
         * for: FKKN customer work report
         */
        require_once ('class/company.php');
        if($obj_pdf != NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_customer();

        $obj_company		= new company();
        $obj_employee		= new employee();
        $obj_customer		= new customer();
        $obj_general		= new general();
        //$obj_contract		= new contract();
        $pdf->tot_normal	= 0;
        $pdf->tot_oncall	= 0;
        $pdf->tot_beredskap	= 0;
        $flag				= FALSE;
        $employee_names		= array();
        if($employee == '') $employee = NULL;
        //---------------------------
        $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details = $this->get_customer_details($customer);
        if ($employee == NULL) {
            $login_user = $_SESSION['user_id'];
            $login_user_team_role = $obj_employee->get_team_role_of_employee($login_user, $customer);
            
            if($_SESSION['user_role'] == 3)   //returns only his data
                $employee_names = array($_SESSION['user_id']);
            else {
                if((!empty($login_user_team_role) && ($login_user_team_role['role'] == 2 || $login_user_team_role['role'] == 7)) || ($_SESSION['user_role'] == 1  || $_SESSION['user_role'] == 6 || $_SESSION['user_role'] == 4)){
                    //$employee_names__ = $obj_employee->get_team_employees_of_customer($customer, -1);
                    $employee_names__ = $obj_employee->team_members_with_tt_connected_employees($customer, $year, $month);
                    if(!empty($employee_names__)){
                        foreach($employee_names__ as $team_em){
                            $employee_names[] = $team_em['username'];
                        }
                    }
                } else //returns only his data
                    $employee_names = array($_SESSION['user_id']);
            }
        }
        else
            $employee_names = array($employee);
        
        //--------------------------------------------------------------------------------------
        $kn_contract_periods = $this->get_billing_customer_contract_detail($customer, $fkkn, $year, $month);
        $date_period_from = date('Y-m-d', strtotime($year.'-'.$month.'-01'));
        $date_period_to = date('Y-m-d', strtotime($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN, $month, $year)));
        
        $full_kn_periods = array();
        if(!empty($kn_contract_periods)){
            foreach($kn_contract_periods as $p_key => $contract_period){
                //check first period_from is start from first day of current month or not
                if($p_key == 0 && date('Y-m-d', strtotime($contract_period['date_from'])) > $date_period_from){
                    $full_kn_periods[] = Array(
                                                'date_from' => $date_period_from,
                                                'date_to' => date('Y-m-d', strtotime( $contract_period['date_from'] . ' -1 day')),
                                                'kn_name' => '', 'kn_address' => '', 'mobile' => '',
                                                'email' => '', 'kn_postno' => '', 'city' => '', 
                                                'kn_reference_no' => '', 'kn_box' => '');
                }
                
                //2 periods intermediate blank period
                if($p_key != 0 && date('Y-m-d', strtotime($full_kn_periods[count($full_kn_periods)-1]['date_to'])) < date('Y-m-d', strtotime($contract_period['date_from']))){
                    $full_kn_periods[] = Array(
                                                'date_from' => date('Y-m-d', strtotime( ($full_kn_periods[count($full_kn_periods)-1]['date_to']) . ' +1 day')),
                                                'date_to' => date('Y-m-d', strtotime( $contract_period['date_from'] . ' -1 day')),
                                                'kn_name' => '', 'kn_address' => '', 'mobile' => '',
                                                'email' => '', 'kn_postno' => '', 'city' => '', 
                                                'kn_reference_no' => '', 'kn_box' => '');
                }
                    
                //calculate the accurate date_from and date_to of each periods
                $temp_this_period_date_from = (date('Y-m-d', strtotime($contract_period['date_from'])) < $date_period_from ? $date_period_from : $contract_period['date_from']);
                $temp_this_period_date_to = (date('Y-m-d', strtotime($contract_period['date_to'])) > $date_period_to ? $date_period_to : $contract_period['date_to']);
                $full_kn_periods[] = Array(
                                            'date_from' => $temp_this_period_date_from,
                                            'date_to' => $temp_this_period_date_to,
                                            'kn_name' => $contract_period['kn_name'], 
                                            'kn_address' => $contract_period['kn_address'], 
                                            'mobile' => $contract_period['mobile'],
                                            'email' => $contract_period['email'], 
                                            'kn_postno' => $contract_period['kn_postno'], 
                                            'city' => $contract_period['city'], 
                                            'kn_reference_no' => $contract_period['kn_reference_no'],
                                            'kn_box' => $contract_period['kn_box']);
                
            }
            //check last period not cover end of current month
            if(date('Y-m-d', strtotime($full_kn_periods[count($full_kn_periods)-1]['date_to'])) < date('Y-m-d', strtotime($date_period_to))){
                $full_kn_periods[] = Array(
                                        'date_from' => date('Y-m-d', strtotime( ($full_kn_periods[count($full_kn_periods)-1]['date_to']) . ' +1 day')),
                                        'date_to' => $date_period_to,
                                        'kn_name' => '', 'kn_address' => '', 'mobile' => '',
                                        'email' => '', 'kn_postno' => '', 'city' => '', 
                                        'kn_reference_no' => '', 'kn_box' => '');
            }
        } else {
            $full_kn_periods[] = Array(
                                'date_from' => $date_period_from,
                                'date_to' => $date_period_to,
                                'kn_name' => '', 'kn_address' => '', 'mobile' => '',
                                'email' => '', 'kn_postno' => '', 'city' => '', 
                                'kn_reference_no' => '', 'kn_box' => '');
        }
        //echo "full_kn_periods<pre>".print_r($full_kn_periods, 1)."</pre>";
        //exit();
        //--------------------------------------------------------------------------------------
        /* Beredeskap period calculation based on customer records */
        /*$tmp_calculation_start_month = ($cust_details[0]['employee_contract_start_month'] != '' ? $cust_details[0]['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
        $calculation_period_length = ($cust_details[0]['employee_contract_period_length'] != '' && $cust_details[0]['employee_contract_start_month'] != '' ?  $cust_details[0]['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
        $calculation_period_month_start_date = ($cust_details[0]['employee_contract_period_date'] != '' && $cust_details[0]['employee_contract_start_month'] != '' ?  $cust_details[0]['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
        $flag_found_calculation_period = FALSE;
        $is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
        $is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;
        $contract_calculation_values = array();
        $contract_calculation_previous_values = array();

        if(!$is_month_starting_first_date){     //for keeping previous calculation period
            $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
            $pre_year_start = $year;
            if($pre_month_start < 1){
                $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
                $pre_year_start--;
            }

            $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
            if($is_month_starting_last_date){
                $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($year.'-'.$tmp_calculation_start_month.'-01'));
                $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
            }else
                $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
        }

        while(!$flag_found_calculation_period){
            $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
            if($tmp_calculation_end_month > 12){
                if(($tmp_calculation_start_month <= $month && $month <= 12) || (1 <= $month && $month <= ($tmp_calculation_end_month-12))){
                    $flag_found_calculation_period = TRUE;
                    $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
                    if($tmp_calculation_start_month <= $month && $month <= 12){
                        $contract_calculation_values['start_year'] = $year;
                        $contract_calculation_values['end_year'] = $year+1;
                    }else {
                        $contract_calculation_values['start_year'] = $year - 1;
                        $contract_calculation_values['end_year'] = $year;
                    }
                } 
                else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                    $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
                    $contract_calculation_previous_values['start_year'] = $year;
                    $contract_calculation_previous_values['end_year'] = $year+1;
                }
            }else {
                if($tmp_calculation_start_month <= $month && $month <= $tmp_calculation_end_month){
                    $flag_found_calculation_period = TRUE;
                    $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
                    $contract_calculation_values['start_year'] = $year;
                    $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($year+1) : $year;
                }
                else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                    $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                    $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
                    $contract_calculation_previous_values['start_year'] = $year;
                    $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($year+1) : $year;
                }
            }
            if($flag_found_calculation_period){
                if($is_month_starting_first_date)
                    $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
                else
                    $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

                if($is_month_starting_first_date)
                    $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
                else{
                    $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
                    if($is_month_starting_last_date){
                        $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                        $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
                    }else{
                        $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                    }
                }
            }
            else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

                $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
                if($is_month_starting_last_date){
                    $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                }else{
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                }
            }
            $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
        }*/
        
        //ob_clean();
        $cust_contract_in_this_year_month = $obj_customer->customer_contract_month($customer, $year.'|'.$month, $fkkn, TRUE);
        $pdf->summery_data = $this->get_customer_summery_data($customer, $month, $year);
        $hospital_hours_time_summary = array();
        if (!empty($pdf->summery_data)) {
            $first_day = $last_day = NULL;
            if($pdf->summery_data[0]['hostpilized_date_from'] != '' && $pdf->summery_data[0]['hostpilized_date_from'] != '0000-00-00')
                $first_day = $pdf->summery_data[0]['hostpilized_date_from'] . ' ' . ($pdf->summery_data[0]['hostpilized_time_from'] !== '' && $pdf->summery_data[0]['hostpilized_time_from'] !== NULL ? $pdf->format_time($pdf->summery_data[0]['hostpilized_time_from']) : '00.00');
            else if($pdf->summery_data[0]['hostpilized_date_from2'] != '' && $pdf->summery_data[0]['hostpilized_date_from2'] != '0000-00-00')
                $first_day = $pdf->summery_data[0]['hostpilized_date_from2'] . ' ' . ($pdf->summery_data[0]['hostpilized_time_from2'] !== '' && $pdf->summery_data[0]['hostpilized_time_from2'] !== NULL ? $pdf->format_time($pdf->summery_data[0]['hostpilized_time_from2']) : '00.00');
            else if($pdf->summery_data[0]['hostpilized_date_from3'] != '' && $pdf->summery_data[0]['hostpilized_date_from3'] != '0000-00-00')
                $first_day = $pdf->summery_data[0]['hostpilized_date_from3'] . ' ' . ($pdf->summery_data[0]['hostpilized_time_from3'] !== '' && $pdf->summery_data[0]['hostpilized_time_from3'] !== NULL ? $pdf->format_time($pdf->summery_data[0]['hostpilized_time_from3']) : '00.00');

            if($pdf->summery_data[0]['hostpilized_date_to3'] != '' && $pdf->summery_data[0]['hostpilized_date_to3'] != '0000-00-00')
                $last_day = $pdf->summery_data[0]['hostpilized_date_to3'] . ' ' . ($pdf->summery_data[0]['hostpilized_time_to3'] !== '' && $pdf->summery_data[0]['hostpilized_time_to3'] !== NULL ? $pdf->format_time($pdf->summery_data[0]['hostpilized_time_to3']) : '24.00');
            else if($pdf->summery_data[0]['hostpilized_date_to2'] != '' && $pdf->summery_data[0]['hostpilized_date_to2'] != '0000-00-00')
                $last_day = $pdf->summery_data[0]['hostpilized_date_to2'] . ' ' . ($pdf->summery_data[0]['hostpilized_time_to2'] !== '' && $pdf->summery_data[0]['hostpilized_time_to2'] !== NULL ? $pdf->format_time($pdf->summery_data[0]['hostpilized_time_to2']) : '24.00');
            else if($pdf->summery_data[0]['hostpilized_date_to'] != '' && $pdf->summery_data[0]['hostpilized_date_to'] != '0000-00-00')
                $last_day = $pdf->summery_data[0]['hostpilized_date_to'] . ' ' . ($pdf->summery_data[0]['hostpilized_time_to'] !== '' && $pdf->summery_data[0]['hostpilized_time_to'] !== NULL ? $pdf->format_time($pdf->summery_data[0]['hostpilized_time_to']) : '24.00');

            if($first_day != NULL && $last_day != NULL){
                $hospital_hours_time_summary = $this->summery_edit($customer, $month, $year, $fkkn);
            }
        }

        // echo "<pre>".print_r($cust_contract_in_this_year_month, 1)."</pre>";
        $rpt_tot_oncall = $rpt_tot_normal = $rpt_tot_beredskap = 0;
        foreach($full_kn_periods as $kn_period){
            $no_of_employees_have_slots = 0;
            $flag_local = FALSE;
            $pdf->tot_normal = 0;
            $pdf->tot_oncall = 0;
            $no_of_work_details_pages = 0;  // this used only for samsida summery report
            for ($i = 0; $i < count($employee_names); $i++) {
                $work_details = $this->get_Customer_employee_report_data_btwn_dates($employee_names[$i], $customer, $kn_period['date_from'], $kn_period['date_to'], $fkkn);

                
                //$pdf->current_customer_employee_total_normal_hours = 0;
                //$pdf->current_customer_employee_total_oncall_hours = 0;

                if (empty($work_details))
                    continue;

                $defaults = $this->check_exists_fkkn_form_defaults($customer, $employee_names[$i], TRUE);
                
                $this_bargaining = $txt_other_bargaining = $provider_of_pa = NULL;
                $this_agreement = array();
                if(!empty($defaults)){
                    $this_bargaining = $defaults[0]['bargaining_new'];
                    $txt_other_bargaining = NULL;
                    $provider_of_pa = $defaults[0]['provider_of_pa_flag'];
                    if($provider_of_pa == 2){
                        $this_agreement['type'] = $defaults[0]['agreement_types_new'];
                        $this_agreement['type2_company'] = $defaults[0]['agreement_type2_company'];
                        $this_agreement['type2_orgno'] = $defaults[0]['agreement_type2_orgNo'];
                        $this_agreement['company_cp_name'] = $defaults[0]['company_cp_name'];
                        $this_agreement['company_cp_phone'] = $obj_general->format_mobile($defaults[0]['company_cp_phone']);
                    }
                }
                //echo "<pre>$employee_names[$i]".print_r($defaults, 1)."</pre>";

                $emp_details = $this->get_employee_details($employee_names[$i]);

                $tmp_calculation_start_month = ($emp_details[0]['employee_contract_start_month'] != '' ? $emp_details[0]['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
                $calculation_period_length = ($emp_details[0]['employee_contract_period_length'] != '' && $emp_details[0]['employee_contract_start_month'] != '' ?  $emp_details[0]['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
                $calculation_period_month_start_date = ($emp_details[0]['employee_contract_period_date'] != '' && $emp_details[0]['employee_contract_start_month'] != '' ?  $emp_details[0]['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
                $flag_found_calculation_period = FALSE;
                $is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
                $is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;
                $contract_calculation_values = array();
                $contract_calculation_previous_values = array();

                if(!$is_month_starting_first_date){     //for keeping previous calculation period
                    $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
                    $pre_year_start = $year;
                    if($pre_month_start < 1){
                        $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
                        $pre_year_start--;
                    }

                    $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
                    if($is_month_starting_last_date){
                        $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($year.'-'.$tmp_calculation_start_month.'-01'));
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                    }else
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
                }

                while(!$flag_found_calculation_period){
                    $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
                    if($tmp_calculation_end_month > 12){
                        if(($tmp_calculation_start_month <= $month && $month <= 12) || (1 <= $month && $month <= ($tmp_calculation_end_month-12))){
                            $flag_found_calculation_period = TRUE;
                            $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
                            if($tmp_calculation_start_month <= $month && $month <= 12){
                                $contract_calculation_values['start_year'] = $year;
                                $contract_calculation_values['end_year'] = $year+1;
                            }else {
                                $contract_calculation_values['start_year'] = $year - 1;
                                $contract_calculation_values['end_year'] = $year;
                            }
                        }
                        else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                            $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
                            $contract_calculation_previous_values['start_year'] = $year;
                            $contract_calculation_previous_values['end_year'] = $year+1;
                        }
                    }else {
                        if($tmp_calculation_start_month <= $month && $month <= $tmp_calculation_end_month){
                            $flag_found_calculation_period = TRUE;
                            $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
                            $contract_calculation_values['start_year'] = $year;
                            $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($year+1) : $year;
                        }
                        else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                            $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
                            $contract_calculation_previous_values['start_year'] = $year;
                            $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($year+1) : $year;
                        }
                    }
                    if($flag_found_calculation_period){
                        if($is_month_starting_first_date)
                            $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
                        else
                            $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

                        if($is_month_starting_first_date)
                            $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
                        else{
                            $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
                            if($is_month_starting_last_date){
                                $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                                $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
                            }else{
                                $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                            }
                        }
                    }
                    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                        $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

                        $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
                        if($is_month_starting_last_date){
                            $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                            $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                        }else{
                            $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                        }
                    }
                    $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
                }
                
                $flag_local = TRUE;
                $flag = TRUE;
                
                //echo "<pre>$employee_names[$i]".print_r($work_details, 1)."</pre>";
                $sign_details = $this->get_employee_signing_details($employee_names[$i], $month, $year, $customer);
                $employer_sign_details = $obj_employee->employer_signing_details($customer, $month, $year, $fkkn, $employee_names[$i]);

                $is_rpt_smonth_equal_calc_smonth = date('m', strtotime($contract_calculation_values['start_date'])) == $month ? TRUE : FALSE;
                $calculation_period_start_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['start_date'] : $contract_calculation_values['start_date']);
                $calculation_period_end_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['end_date'] : $contract_calculation_values['end_date']);

                $calculation_end_date = '';
                if(date('m', strtotime($calculation_period_end_date)) == $month)
                        $calculation_end_date = $calculation_period_end_date;
                else
                        $calculation_end_date = date('Y-m-t', strtotime("$year-$month-01"));

                $employee_period_actual_hours = $this->customer_employee_total_actual_hours_btwn_dates($customer, $calculation_period_start_date, $calculation_end_date, $fkkn, $employee_names[$i], array(1,2,7,8,9,10,11,15,16,17));
                //echo "<pre>".print_r($employee_period_actual_hours, 1)."</pre>";

                $special_calculation_array = array();
                if(!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth){
                    $special_calculation_array['calculation_period_start_date'] = $contract_calculation_values['start_date'];
                    $special_calculation_array['calculation_period_end_date'] = $contract_calculation_values['end_date'];

                    $special_calculation_array['calculation_end_date'] = '';
                    if(date('m', strtotime($contract_calculation_values['end_date'])) == $month)
                            $special_calculation_array['calculation_end_date'] = $contract_calculation_values['end_date'];
                    else
                            $special_calculation_array['calculation_end_date'] = date('Y-m-t', strtotime("$year-$month-01"));

                    $tmp_special_calc_employee_period_actual_hours = $this->customer_employee_total_actual_hours_btwn_dates($customer, $special_calculation_array['calculation_period_start_date'], $special_calculation_array['calculation_end_date'], $fkkn, $employee_names[$i], array(1,2,7,8,9,10,11,15,16,17));
                    $special_calculation_array['total_actual_hours'] = round($tmp_special_calc_employee_period_actual_hours['TOTAL_NORMAL'] + $tmp_special_calc_employee_period_actual_hours['TOTAL_ONCALL'] + $tmp_special_calc_employee_period_actual_hours['TOTAL_BEREDSKAP'], 2);
                }
                
                $no_of_employees_have_slots++;
                // $work_partition = array_chunk($work_details, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
                $work_partition = array_chunk($work_details, 40);   //chunk data in to 40 rows, because max 31 entries included @ one page
                foreach ($work_partition as $works) {
                    $pdf->AddPage();
                    $no_of_work_details_pages++;
					//$pdf->setSourceFile('./pdf_forms/FK3059_015_F_001__16_08_25.pdf');
					$pdf->setSourceFile('./pdf_forms/FK3059_016_F_003.pdf');
                    $tppl = $pdf->importPage(1);
                    $pdf->useTemplate($tppl);
                    
                    $pdf->report_top($month, $year, $fkkn, $kn_period, $company_data);
                    $pdf->SubPart1($cust_details);
                    $pdf->SubPart2($emp_details);
                    $pdf->SubPart3($this_bargaining);
                    // $pdf->SubPart3_table($works, $fkkn);
                    //echo "<pre>".print_r($employee_period_actual_hours, 1)."</pre>";
                    $pdf->SubPart4($calculation_period_start_date, $calculation_period_end_date, $employee_period_actual_hours, $special_calculation_array);    // this new block since 2014-07-16
                    $pdf->SubPart5($company_data, $this_agreement, $provider_of_pa);  // Currently this is section 5  since 2016-08-26
                    $pdf->SubPart6($employer_sign_details);
                    //if ($fkkn == 1) $pdf->Sidelabel();
                    // $pdf->SubPart4($emp_details, $sign_details, $fkkn);
                    // $pdf->Sidelabel_remove_for_new_kn();

                    $pdf->AddPage();
                    $tppl = $pdf->importPage(3);
                    $pdf->useTemplate($tppl);
                    $pdf->page2_3059_header($month, $year, $cust_details, $emp_details);
                    $pdf->SubPart7_table($works, $fkkn);
                    $pdf->SubPart8($emp_details, $sign_details, $fkkn);
                    //if ($fkkn == 1) $pdf->Sidelabel();
                    // $pdf->SubPart5($this_bargaining);
                    // $pdf->SubPart6($calculation_period_start_date, $calculation_period_end_date, $employee_period_actual_hours, $special_calculation_array);    // this new block since 2014-07-16
                    // $pdf->SubPart7($company_data, $this_agreement, $provider_of_pa);  // Currently this is section 5  since 2016-08-26
                    // $pdf->SubPart8($employer_sign_details);
                    // $pdf->Sidelabel_remove_for_new_kn();
                }
            }

            // $flag_local = TRUE;
            // $flag = TRUE;
            if ($flag_local && $obj_pdf == NULL) {

                $pdf->summery_for_3057 = $this->summery_edit($customer, $month, $year, $fkkn, $employee);
                // echo "<pre>".print_r(array($customer, $month, $year, $fkkn, $employee), 1)."</pre>";
                // echo "<pre>".print_r($pdf->summery_for_3057, 1)."</pre>";

                //echo "<pre>".print_r($pdf->summery_data, 1)."</pre>";
                if ($this->samsida == 'print_samsida')  //for print only form 3057
                    $pdf->page = $pdf->page - $no_of_work_details_pages;
                $pdf->AddPage();
                // $pdf->setSourceFile('./pdf_forms/FK3057_015_F_001__16_08_25.pdf');
                // $pdf->setSourceFile('./pdf_forms/FK3057_016_F_001__17_05_02.pdf');
                $pdf->setSourceFile('./pdf_forms/KN_3057__30_10_2017.pdf');
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl);
                //     $pdf->summery_report_top($month, $year, $fkkn, $kn_period, $company_data);
                $pdf->summery_report_top_new_kn($month, $year, $fkkn, $kn_period, $company_data);
                // $pdf->summery_SubPart1($cust_details);
                $pdf->summery_SubPart1_kn($cust_details);
                // $pdf->summery_SubPart2($no_of_employees_have_slots);
                $pdf->summery_SubPart2_new_kn($cust_contract_in_this_year_month);
                $pdf->summery_SubPart3_new_kn($no_of_employees_have_slots);
                if (!empty($pdf->summery_data)) {
                    // $pdf->summery_SubPart3_new();
                    // $pdf->summery_SubPart3();
                    // $pdf->summery_SubPart4();
                    $pdf->summery_SubPart4_new_kn($hospital_hours_time_summary);
                    // $pdf->summery_SubPart5();
                    $pdf->summery_SubPart5_new_kn();
                    // $pdf->summery_SubPart6();
                    // $pdf->summery_SubPart7();
                }
                $pdf->summery_SubPart6_new_kn($company_data);
                //$pdf->summery_Sidelabel();

                $pdf->AddPage();
                $tppl = $pdf->importPage(2);
                $pdf->useTemplate($tppl);

                // $pdf->summery_report_top_2($cust_details, $month, $year);
                if (!empty($pdf->summery_data)) {
                    $pdf->summery_SubPart6_part2_new_kn();
                    $pdf->summery_SubPart7_new_kn();
					/*
                    $total_no_of_hours = $pdf->summery_data[0]['working_hours_4_customer'];
					$total_no_of_hours = 0.00;
                      $account_date_from = trim($pdf->summery_data[0]['accounting_date_from']);
                      $account_date_to = trim($pdf->summery_data[0]['accounting_date_to']);
                      if($account_date_from != '' && $account_date_to != ''){     //calculate total no. of hours for the customer
                      $total_no_of_hours = $this->get_customer_slots_btwn_dates($customer,$account_date_from, $account_date_to, $fkkn, 'HOURS_SUM');
                      }
					  $pdf->summery_SubPart8($total_no_of_hours);
					*/
                    $pdf->summery_SubPart8_new_kn();
                    // $pdf->summery_SubPart9();
                }
                //$pdf->summery_Sidelabel();
                
                $rpt_tot_oncall += $pdf->tot_oncall;
                $rpt_tot_normal += $pdf->tot_normal;
                $rpt_tot_beredskap += $pdf->tot_beredskap;
            }
        }
        
        
        if($obj_pdf != NULL && is_object($obj_pdf)){
            return $obj_pdf;
        }
        else if ($flag){
            if ($sam_sida == NULL) {
                $pre_pdf_title = NULL;
                switch ($fkkn) {
                    case 1: $pre_pdf_title = 'FK'; break;
                    case 2: $pre_pdf_title = 'KN'; break;
                    case 3: $pre_pdf_title = 'TU'; break;
                }
                $pdf->Output($pre_pdf_title.'_'.$customer.'_'.date('Y-m-d').'.pdf', 'I');
                if($_SESSION['user_role'] == 1){
                    $c_name = $this->create_pdf_samsida($customer, $month, $year, $fkkn, $employee);
                    if ($c_name) {
                        $company = $this->get_company_directory($_SESSION['company_id']);
                        $pdf->Output("./" . $company['upload_dir'] . "/fkkn/" . $c_name, 'F');
                    }
                }
            } else if ($sam_sida == 1) {
                $output_1 = array('tot_onCall' => $rpt_tot_oncall, 'tot_Normal' => $rpt_tot_normal, 'tot_beredskap' => $rpt_tot_beredskap);
                return $output_1;
            }
        } else
            echo 'No work available';
    }

    function get_customer_summery_data($customer, $month, $year) {
        $this->tables = array('samsida');
        $this->fields = array('id','how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hostpilized_date_from2', 'hostpilized_date_to2', 'hostpilized_date_from3', 'hostpilized_date_to3', 'hostpilized_time_from', 'hostpilized_time_to', 'hostpilized_time_from2', 'hostpilized_time_to2', 'hostpilized_time_from3', 'hostpilized_time_to3', 'hospital',
            'did_u_included_hospitalized_hours', 'has_assistance_in_other_activities', 'hostpitalized_hours', 'hostpitalized_hours_oncall', 'hostpitalized_hours_standby', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'sign_date', 'signed_employer_name', 'signed_employer_telephone', 'signed_employer_ssn', 'do_u_hire_asst_provider', 'asst_provider_orgno',
            'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money', 'asst_provider1', 'asst_provider_orgno1', 'asst_provider_ftax1', 'asst_provider2', 'asst_provider_orgno2', 'asst_provider_ftax2',
            'asst_provider3', 'asst_provider_orgno3', 'asst_provider_ftax3', 'do_u_attach_receipt', 'money_left_not_to_purchase2', 'money_left2', 'do_u_live_outside_EEA_country', 'accounting_date_from', 'accounting_date_to',
            'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost', 'salary_OB_period', 'assist_expenses_cost', 'assist_expenses_period', 'training_cost', 'training_period', 'staff_expense_cost', 'staff_expense_period',
            'administration_cost', 'administration_period', 'working_hours_4_customer', 'compensation_payback',
            'have_u_contact_with_assistant_counselors', 'have_received_personal_assistance', 'hired_assistant_date_from', 'hired_assistant_date_to', 'hired_assistant_normal_hours', 'hired_assistant_oncall_hours', 'hired_assistant_standby_hours', 'permission_from_care_inspectorate');

        $this->conditions = array('AND', 'month= ?', 'year= ?', 'customer like ?');
        $this->condition_values = array($month, $year, $customer);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_customer_just_previous_summery_data($customer, $month, $year) {
        $this->tables = array('samsida');
        $this->fields = array('id', 'how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hospital',
            'did_u_included_hospitalized_hours', 'hostpitalized_hours', 'hostpitalized_hours_oncall', 'hostpitalized_hours_standby', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'signed_employer_name', 'signed_employer_telephone', 'signed_employer_ssn', 'do_u_hire_asst_provider', 'asst_provider_orgno',
            'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money', 'asst_provider1', 'asst_provider_orgno1', 'asst_provider_ftax1', 'asst_provider2', 'asst_provider_orgno2', 'asst_provider_ftax2',
            'asst_provider3', 'asst_provider_orgno3', 'asst_provider_ftax3', 'do_u_attach_receipt', 'money_left_not_to_purchase2', 'money_left2', 'do_u_live_outside_EEA_country', 'accounting_date_from', 'accounting_date_to',
            'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost', 'salary_OB_period', 'assist_expenses_cost', 'assist_expenses_period', 'training_cost', 'training_period', 'staff_expense_cost', 'staff_expense_period',
            'administration_cost', 'administration_period', 'working_hours_4_customer', 'compensation_payback');

        $this->conditions = array('AND', 'customer like ?', array('OR', array('AND', 'year = ?', 'month < ?'), 'year < ?'));
        $this->condition_values = array($customer, $year, $month, $year);
        $this->order_by = array('year desc', 'month desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return !empty($datas) ? $datas[0] : array();
    }

    function get_employee_signing_details($employee, $month, $year, $customer) {

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();

        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));

        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_employee_signing_details_process($employee, $month, $year, $customer, 1);
            $query_2_action = $this->get_employee_signing_details_process($employee, $month, $year, $customer, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_employee_signing_details_process($employee, $month, $year, $customer, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_employee_signing_details_process($employee, $month, $year, $customer, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }

    function get_employee_signing_details_process($employee, $month, $year, $customer, $mode = 1) {

        $report_signing = $mode == 1 ? 'report_signing' : 'backup_report_signing';

        $this->flush();
        $this->tables = array($report_signing);
        $this->fields = array('signin_date', 'signin_employee', 'employee_sign', 'employee_ocs', 'xml');
        $this->conditions = array('AND', 'month(date)= ?', 'year(date)= ?', 'employee like ?', 'customer like ?');
        $this->condition_values = array($month, $year, $employee, $customer);
        $this->query_generate();
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_employee_not_signing($customer, $month, $year, $nk = 1) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_employee_not_signing_process($customer, $month, $year, $nk, 1);
            $query_2_action = $this->get_employee_not_signing_process($customer, $month, $year, $nk, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT DISTINCT employee, emp, emp_lf  
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_employee_not_signing_process($customer, $month, $year, $nk, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_employee_not_signing_process($customer, $month, $year, $nk, 1);
            // echo "<pre>".print_r($query_1_action, 1)."</pre>";
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_employee_not_signing_process($customer, $month, $year, $nk = 1, $mode = 1) {
        /*if ($month < 10)
            $month = str_pad((int) $month, 2, "0", STR_PAD_LEFT);
        $year_month = $year . '-' . $month;
        $this->tables = array("SELECT  DISTINCT t.employee, CONCAT(e.first_name,' ',e.last_name) AS emp  
                                    FROM timetable t
                                    LEFT JOIN employee e ON t.employee = e.username
                                    WHERE  DATE_FORMAT(t.date,'%Y-%m') ='" . $year_month . "'
                                    AND t.employee NOT IN (SELECT signin_employee  FROM `report_signing` r
                                                        WHERE DATE_FORMAT(r.date,'%Y-%m')='" . $year_month . "') 
                                    AND t.employee != '' AND t.employee IS NOT NULL AND t.customer = '" . $customer . "'");
        $this->query_generate_leftjoin();*/
        
        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';

        $this->flush();
        $this->sql_query = "SELECT  DISTINCT t.employee, CONCAT(e.first_name,' ',e.last_name) AS emp, CONCAT(e.last_name,' ',e.first_name) AS emp_lf  
                                    FROM `".$timetable."` As t
                                    LEFT JOIN employee e ON t.employee = e.username
                                    WHERE  MONTH(t.date) = ? AND YEAR(t.date) = ?
                                    AND t.employee NOT IN (SELECT employee  FROM `report_signing` r
                                                        WHERE r.customer = ? AND MONTH(r.date) = ? AND YEAR(r.date) = ?) 
                                    AND t.employee != '' AND t.employee IS NOT NULL AND t.customer = ?";
        $this->condition_values = array($month, $year, $customer, $month, $year, $customer);
        // $datas = $this->query_fetch();
        // return $datas;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_employees_signed($customer, $month, $year, $nk = 1) {
        /*if ($month < 10)
            $month = str_pad((int) $month, 2, "0", STR_PAD_LEFT);
        $year_month = $year . '-' . $month;
        $this->tables = array("SELECT  DISTINCT t.employee, CONCAT(e.first_name,' ',e.last_name) AS emp  
                                    FROM timetable t
                                    LEFT JOIN employee e ON t.employee = e.username
                                    WHERE  DATE_FORMAT(t.date,'%Y-%m') ='" . $year_month . "'
                                    AND t.employee NOT IN (SELECT signin_employee  FROM `report_signing` r
                                                        WHERE DATE_FORMAT(r.date,'%Y-%m')='" . $year_month . "') 
                                    AND t.employee != '' AND t.employee IS NOT NULL AND t.customer = '" . $customer . "'");
        $this->query_generate_leftjoin();*/
        
        $this->flush();
        $this->sql_query = "SELECT  DISTINCT rs.employee, CONCAT(e.first_name,' ',e.last_name) AS emp, CONCAT(e.last_name,' ',e.first_name) AS emp_lf, rs.employee_sign, rs.employee_ocs  
                                    FROM report_signing rs 
                                    INNER JOIN employee e ON rs.employee = e.username AND rs.customer='".$customer."'
                                    WHERE  MONTH(rs.date) = '".$month."' AND YEAR(rs.date) = '".$year."'";
                                     
        //$this->condition_values = array($month, $year, $customer, $month, $year, $customer);
        $datas = $this->query_fetch();
        return $datas;
    }

    function summery_edit($customer, $month, $year, $fkkn, $employee = NULL, $apply_day_light_calc = TRUE) {
        /**
         * Author: Unknown
         * Edited-by: Shamsu
         * for: to calculate total normal/oncall hours using month & year
         */
        
        $equipment = new equipment();
        $__this_tot_normal = $__this_tot_oncall = $__this_tot_beredskap = $__no_of_employees_have_slots = 0;
        
        //------------------------------
        $obj_employee = new employee();
        $employee_names = array();

        if ($employee == NULL){
            
            $login_user = $_SESSION['user_id'];
            $login_user_team_role = $obj_employee->get_team_role_of_employee($login_user, $customer);
            
            if($_SESSION['user_role'] == 3)   //returns only his data
                $employee_names = array($_SESSION['user_id']);
            else {
                if((!empty($login_user_team_role) && ($login_user_team_role['role'] == 2 || $login_user_team_role['role'] == 7)) || ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6 || $_SESSION['user_role'] == 4)){
                   // $employee_names__ = $obj_employee->get_team_employees_of_customer($customer, -1);
                    $employee_names__ = $obj_employee->team_members_with_tt_connected_employees($customer, $year, $month);
                    if(!empty($employee_names__)){
                        foreach($employee_names__ as $team_em){
                            $employee_names[] = $team_em['username'];
                        }
                    }
                } else //returns only his data
                    $employee_names = array($_SESSION['user_id']);
            }
        }else
            $employee_names = array($employee);

        if($apply_day_light_calc && in_array($month, array(3, 10)) ){
            //day light calculation will be effective on every March & October months
            $month_names = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $day_light_date = date('Y-m-d', strtotime('last sunday of ' . $month_names[$month - 1] . ' ' . $year));
            $calculation_mode = $month == 3 ? 'DECREMENT' : 'INCREMENT';    // make half or double
        }
        //echo "<pre>".print_r($employee_names)."</pre>";exit();
        $employees_count = count($employee_names);
        for ($i = 0; $i < $employees_count; $i++) {
            $work_details = $this->get_Customer_employee_report_data($employee_names[$i], $customer, $month, $year, $fkkn);
            
            if (empty($work_details)) continue;
            $__no_of_employees_have_slots++;
            foreach ($work_details as $works) {
                $time_in_100 = round($equipment->time_user_format($equipment->time_difference($works['time_to'], $works['time_from']), 100, FALSE),2);

                if (in_array($works['type'], array(0, 1, 2, 4, 5, 6, 7, 12)))
                    $__this_tot_normal += $time_in_100;
                else if (in_array($works['type'], array(3, 13, 14)))
                    $__this_tot_oncall += $time_in_100;
                else if (in_array($works['type'], array(15)))
                    $__this_tot_beredskap += $time_in_100;
            }
            if($apply_day_light_calc && !empty($work_details) && in_array($month, array(3, 10)) ){
                //day light calculation will be effective on every March & October months
                $__this_tot_normal_dls = $__this_tot_oncall_dls = $__this_tot_beredskap_dls = 0;

                foreach ($work_details as $work) {
                    if($work['date'] == $day_light_date && $work['created_status'] == '' &&
                    (((float) $work['time_from'] >= 2  AND (float) $work['time_from'] <3) OR ((float) $work['time_to'] > 2 AND (float) $work['time_to'] <=3) OR ((float) $work['time_from'] < 2 AND (float) $work['time_to'] > 3))){

                        $___time_from = ((float) $work['time_from'] >= 2  AND (float) $work['time_from'] < 3) ? (float) $work['time_from'] : 2.00;
                        $___time_to = ((float) $work['time_to'] > 2 AND (float) $work['time_to'] <= 3) ? (float) $work['time_to'] : 3.00;

                        $time_in_100 = $equipment->time_user_format($equipment->time_difference($___time_to, $___time_from), 100, FALSE);
                        if (in_array($work['type'], array(0, 1, 2, 4, 5, 6, 7, 12)))
                            $__this_tot_normal_dls += $time_in_100;
                        else if (in_array($work['type'], array(3, 13, 14)))
                            $__this_tot_oncall_dls += $time_in_100;
                        else if (in_array($work['type'], array(15)))
                            $__this_tot_beredskap_dls += $time_in_100;
                    }
                }

                if($__this_tot_normal_dls > 0) $__this_tot_normal = $calculation_mode == 'DECREMENT' ? ($__this_tot_normal - ($__this_tot_normal_dls)) : ($__this_tot_normal + $__this_tot_normal_dls);
                if($__this_tot_oncall_dls > 0) $__this_tot_oncall = $calculation_mode == 'DECREMENT' ? ($__this_tot_oncall - ($__this_tot_oncall_dls)) : ($__this_tot_oncall + $__this_tot_oncall_dls);
                if($__this_tot_beredskap_dls > 0) $__this_tot_beredskap = $calculation_mode == 'DECREMENT' ? ($__this_tot_beredskap - ($__this_tot_beredskap_dls)) : ($__this_tot_beredskap + $__this_tot_beredskap_dls);
            }
        }

        $output_2 = array('tot_onCall'      => round($__this_tot_oncall, 2), 
                    'tot_Normal'            => round($__this_tot_normal, 2), 
                    'tot_beredskap'         => round($__this_tot_beredskap, 2), 
                    'no_of_employees_have_slots' => $__no_of_employees_have_slots);
        //echo "<pre>".print_r( $output_2 , 1)."</pre>"; exit();
        return $output_2;
    }
    
    function summery_slot_total_btwn_date_range($customer, $start_date, $end_date, $fkkn, $employee = Null) {
        /**
         * Author: Shamsu
         * for: to calculate total normal/oncall hours between 2 dates
         */
        
        $equipment = new equipment();
        $__this_tot_normal = $__this_tot_oncall = 0;
        
        //------------------------------
        $obj_employee = new employee();
        $employee_names = array();

        if ($employee == NULL){
            
            $login_user = $_SESSION['user_id'];
            $login_user_team_role = $obj_employee->get_team_role_of_employee($login_user, $customer);
            
            if($_SESSION['user_role'] == 3)   //returns only his data
                $employee_names = array($_SESSION['user_id']);
            else {
                if((!empty($login_user_team_role) && ($login_user_team_role['role'] == 2 || $login_user_team_role['role'] == 7)) || ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4)){
                    //$employee_names__ = $obj_employee->get_team_employees_of_customer($customer, -1);
                    $employee_names__ = $obj_employee->team_members_with_tt_connected_employees_btwn_date_range($customer, $start_date, $end_date);
                    if(!empty($employee_names__)){
                        foreach($employee_names__ as $team_em){
                            $employee_names[] = $team_em['username'];
                        }
                    }
                } else //returns only his data
                    $employee_names = array($_SESSION['user_id']);
            }
        }else
            $employee_names = array($employee);
        
        $employees_count = count($employee_names);
        for ($i = 0; $i < $employees_count; $i++) {
            //$work_details = $this->get_Customer_employee_report_data($employee_names[$i], $customer, $month, $year, $fkkn);
            
            $this->flush();
            $this->tables = array('timetable');
            $this->fields = array('employee', 'date', 'time_from', 'time_to', 'fkkn', 'type');
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1', array('NOT IN', 'type', '1,2,7,8,9,10,11,16,17'));
            $this->condition_values = array($customer, $employee_names[$i], $start_date, $end_date);
            if ($fkkn != NULL) {
                $this->conditions[] = 'fkkn = ?';
                $this->condition_values[] = $fkkn;
            }
            $this->order_by = array('date', 'time_from');
            $this->query_generate();
            $work_details = $this->query_fetch();
        
            if (empty($work_details))
                continue;
            foreach ($work_details as $works) {
                $time_in_100 = $equipment->time_user_format($equipment->time_difference($works['time_to'], $works['time_from']), 100);
                if (in_array($works['type'], array(0, 1, 2, 4, 5, 6, 7, 12)))
                    $__this_tot_normal += $time_in_100;
                else if (in_array($works['type'], array(3, 13, 14)))
                    $__this_tot_oncall += $time_in_100;
            }
        }
        return round($__this_tot_normal + ($__this_tot_oncall/4));
       // $output_2 = array('tot_onCall' => $__this_tot_oncall, 'tot_Normal' => $__this_tot_normal, 'no_of_employees_have_slots' => $__no_of_employees_have_slots);
       // return $output_2;
    }
    
    function customer_employee_total_actual_hours_btwn_dates($customer, $start_date, $end_date, $fkkn, $employee, $ignore_types = array()) {
        /**
         * @author: Shamsu
         * for: to get total actual hours between 2 dates based on customer-employee-fkkn relation
         * since: 2014-08-18
         * used in 3059 pdf report (section 7)
         */
        
        $equipment = new equipment();
        $obj_gen       = new general();
        $__this_tot_normal = $__this_tot_oncall = $__this_tot_beredskap = 0;
        
        $boundary_date = $obj_gen->get_boundary_date();
        $work_details = array();
        $fromdate = $start_date;
        $todate = $end_date;
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->customer_employee_total_actual_hours_btwn_dates_process($customer, $start_date, $end_date, $fkkn, $employee, $ignore_types, 1);
            $query_2_action = $this->customer_employee_total_actual_hours_btwn_dates_process($customer, $start_date, $end_date, $fkkn, $employee, $ignore_types, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $work_details = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->customer_employee_total_actual_hours_btwn_dates_process($customer, $start_date, $end_date, $fkkn, $employee, $ignore_types, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $work_details = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->customer_employee_total_actual_hours_btwn_dates_process($customer, $start_date, $end_date, $fkkn, $employee, $ignore_types, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $work_details = $this->query_fetch();
            }
        }

        if(!empty($work_details)){
            foreach ($work_details as $works) {
                $time_in_100 = $equipment->time_user_format($equipment->time_difference($works['time_to'], $works['time_from']), 100);
                if (in_array($works['type'], array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12)))
                    $__this_tot_normal += $time_in_100;
                else if (in_array($works['type'], array(3, 9, 13, 14)))
                    $__this_tot_oncall += $time_in_100;
                else if (in_array($works['type'], array(15)))
                    $__this_tot_beredskap += $time_in_100;
            }
        }
        
        return array( 
            'TOTAL_NORMAL' => $__this_tot_normal,
            'TOTAL_ONCALL' => $__this_tot_oncall,
            'TOTAL_BEREDSKAP' => $__this_tot_beredskap
        );
    }

    function customer_employee_total_actual_hours_btwn_dates_process($customer, $start_date, $end_date, $fkkn, $employee, $ignore_types = array(), $mode = 1) {

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';

        $this->flush();
        $this->tables = array($timetable);
        $this->fields = array('employee', 'date', 'time_from', 'time_to', 'fkkn', 'type');
        $this->conditions = array('AND', 'customer = ?', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1', 'fkkn = ?');
        $this->condition_values = array($customer, $employee, $start_date, $end_date, $fkkn);
        
        /*if ($fkkn == 2 ||$fkkn == 3){
            $this->conditions[] = array('OR', 'fkkn = 2', 'fkkn = 3');
        }else{
            $this->conditions[] = 'fkkn = ?';
            $this->condition_values[] = $fkkn;
        }*/
        if(!empty($ignore_types)){
            $not_in_types = implode(',', $ignore_types);
            $this->conditions[] = array('NOT IN', 'type', $not_in_types);
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        // $work_details = $this->query_fetch();
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function Customer_pdf_work_report_for_employees($employee, $month, $year, $fkkn, $customer = Null, $sam_sida = Null) {

        $pdf = new PDF_customer();
        $flag = false;
        $pdf->tot_normal = 0;
        $pdf->tot_oncall = 0;
        $customer_names = array();
        //---------------------------

        $emp_details = $this->get_employee_details($employee);

        if ($customer == Null)
            $customer_names = $this->get_Employee_team_customers($employee);  //take employee names who work for a specific customer
        else
            $customer_names = array($customer);

        for ($i = 0; $i < count($customer_names); $i++) {
            $cust_details = $this->get_customer_details($customer_names[$i]);
            $work_details = $this->get_Customer_employee_report_data($employee, $customer_names[$i], $month, $year, $fkkn);
            if (empty($work_details))
                continue;
            $work_partition = array_chunk($work_details, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
            foreach ($work_partition as $works) {
                $flag = TRUE;
                $pdf->AddPage();
                //$pdf->SetMargins(10, 1);
                $pdf->report_top($cust_details, $month, $year, $fkkn);
                $pdf->SubPart1($cust_details);
                $pdf->SubPart2();
                $pdf->SubPart2_table($works);
                $pdf->SubPart3($emp_details);
                $pdf->Sidelabel();
            }
        }

        //---------------------------------------
        if ($flag) {
            if ($sam_sida == Null) {
                $pdf->Output();
            }
            if ($sam_sida == 1) {
                $output_1 = array('tot_onCall' => $pdf->tot_oncall, 'tot_Normal' => $pdf->tot_normal);
                return $output_1;
            }
        }
    }

    function get_Customer_team_members($customer) {

        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('customer like ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch(2);
        return $emp_names;
    }

    function get_Customer_team_members_with_no_trainee($customer, $month = '', $year = '') {

        $this->tables = array('timetable` as `t', $this->db_master . '.login` as `l');
        $this->fields = array('distinct t.employee');
        $this->conditions = array('AND', 'MONTH(t.date)=?', 'YEAR(t.date)=?', 't.customer like ?', 'l.username LIKE t.employee', 'l.role != 5');
        $this->condition_values = array($month, $year, $customer);
        $this->query_generate();

        $emp_names = $this->query_fetch(2);
        return $emp_names;

        /*$this->tables = array('team` as `t', 'employee` as `e', $this->db_master . '.login` as `l');
        $this->fields = array('t.employee as empID', 'concat( e.first_name," ", e.last_name ) as empName');
        $this->conditions = array('AND', 't.customer like ?', 't.employee LIKE e.username', 'l.username LIKE e.username', 'l.role != 5');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch();
        return $emp_names;*/
    }

    function get_Employee_team_customers($employee) {

        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('employee like ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $cust_names = $this->query_fetch(2);
        return $cust_names;
    }

    function get_team_members_details_for_customer($customer) {

        $this->tables = array('team` as `t', 'employee` as `e');
        $this->fields = array('t.employee as empID', 'concat( e.first_name," ", e.last_name ) as empName');
        $this->conditions = array('AND', 't.customer like ?', 't.employee LIKE e.username');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch();
        return $emp_names;
    }

    function get_team_members_details_for_customer_with_no_trainee($customer) {

        $this->tables = array('team` as `t', 'employee` as `e', $this->db_master . '.login` as `l');
        $this->fields = array('t.employee as empID', 'concat( e.first_name," ", e.last_name ) as empName');
        $this->conditions = array('AND', 't.customer like ?', 't.employee LIKE e.username', 'l.username LIKE e.username', 'l.role != 5');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch();
        return $emp_names;
    }

    function get_all_Member_details_for_customer_with_no_trainee($customer, $nk, $month, $year, $included_employees = array()) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_all_Member_details_for_customer_with_no_trainee_process($customer, $nk, $month, $year, $included_employees, 1);
            $query_2_action = $this->get_all_Member_details_for_customer_with_no_trainee_process($customer, $nk, $month, $year, $included_employees, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    GROUP BY empID 
                    ORDER BY LOWER(empName) collate utf8_bin';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_all_Member_details_for_customer_with_no_trainee_process($customer, $nk, $month, $year, $included_employees, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_all_Member_details_for_customer_with_no_trainee_process($customer, $nk, $month, $year, $included_employees, 1);
            //echo "<pre>q1".print_r($query_1_action,1)."</pre>";
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_all_Member_details_for_customer_with_no_trainee_process($customer, $nk, $month, $year, $included_employees = array(), $mode = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: to get employee names from timetable related to specified customer/fkkn/month/year
         * @param $included_employees : if not empty, the employees should be in this array
         */
        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';

        if($nk == '') $nk = NULL;
        $this->flush();
        $this->sql_query = 'SELECT t.employee AS empID, CONCAT( e.last_name," ",  e.first_name ) AS empName,CONCAT( e.first_name," ",  e.last_name ) AS empName_ff, t.fkkn, t.date
                            FROM `'.$timetable.'` As t
                            LEFT JOIN employee e ON t.employee = e.username
                            WHERE t.customer LIKE ?
                            AND MONTH(t.date) = ?
                            AND YEAR(t.date) = ?
                            AND t.status = 1
                            AND t.employee != "" AND t.employee IS NOT NULL 
                            AND t.type NOT IN (1,2,7,8,9,10,11,16,17) ';
        
        $this->condition_values = array($customer, $month, $year);
        
        if($nk != NULL){
            $this->sql_query .= ' AND t.fkkn = ? ';
            $this->condition_values[] = $nk;
        }
        
        if(!empty($included_employees)){
            $in_employees = '\'' . implode('\', \'', $included_employees) . '\'';
            $this->sql_query .= ' AND t.employee IN ('.$in_employees.') ';
        }
        
        $this->sql_query .= 'GROUP BY e.username 
                            ORDER BY LOWER(empName) collate utf8_bin';
        // $emp_names = $this->query_fetch();
        // return $emp_names;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_team_members_details_for_employee($employee) {

        $this->tables = array('team` as `t', 'customer` as `c');
        $this->fields = array('t.customer as custID', 'concat( c.first_name," ", c.last_name ) as custName');
        $this->conditions = array('AND', 't.employee like ?', 't.customer LIKE c.username');
        $this->condition_values = array($employee);
        $this->query_generate();
        $cust_names = $this->query_fetch();
        //$employee_names = '\'' . implode('\',\'', $emp_names) . '\'';
        return $cust_names;
    }

    function get_customer_details($customer_name = Null) {

        $this->tables = array('customer');
        $this->fields = array('concat(first_name, " " ,last_name) as fullname', 'social_security', 'city', 'username', 'phone', 'mobile', 'century', 'fkkn', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length');
        if ($customer_name != Null) {
            $this->conditions = array('username like ?');
            $this->condition_values = array($customer_name);
        }
        $this->order_by = array('LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_details($employee = Null) {

        $this->tables = array('employee');
        $this->fields = array('concat(first_name, " " ,last_name) as fullname', 'social_security', 'city', 'username', 'mobile', 'century', 'address', 'post', 'phone', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length');
        if ($employee != Null) {
            $this->conditions = array('username like ?');
            $this->condition_values = array($employee);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_Customer_employee_report_data($employee, $customer, $month, $year, $fkkn = NULL) {        
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();

        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));

        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_Customer_employee_report_data_process($employee, $customer, $month, $year, $fkkn, 1);
            $query_2_action = $this->get_Customer_employee_report_data_process($employee, $customer, $month, $year, $fkkn, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from, time_to';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_Customer_employee_report_data_process($employee, $customer, $month, $year, $fkkn, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_Customer_employee_report_data_process($employee, $customer, $month, $year, $fkkn, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }

    function get_Customer_employee_report_data_process($employee, $customer, $month, $year, $fkkn = NULL, $mode = 1) {        
        
        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';

        $this->flush();
        $this->tables = array($timetable);
        $this->fields = array('id', 'date', 'time_from', 'time_to', 'type', 'created_status');
        $this->conditions = array('AND', 'customer = ?', 'MONTH(`date`)= ?', 'YEAR(`date`)= ?', 'employee = ?', 'status=1', array('NOT IN', 'type', '1,2,7,8,9,10,11,16,17'));
        $this->condition_values = array($customer, $month, $year, $employee);
        
        if($fkkn != NULL) {
            $this->conditions[] = 'fkkn = ?';
            $this->condition_values[] = $fkkn;
        }
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
        // $datas = $this->query_fetch();
        // return $datas;
    }

    function get_Customer_employee_report_data_btwn_dates($employee, $customer, $sdate, $edate, $fkkn = NULL) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = $sdate;
        $todate = $edate;
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_Customer_employee_report_data_btwn_dates_process($employee, $customer, $sdate, $edate, $fkkn, 1);
            $query_2_action = $this->get_Customer_employee_report_data_btwn_dates_process($employee, $customer, $sdate, $edate, $fkkn, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from, time_to';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_Customer_employee_report_data_btwn_dates_process($employee, $customer, $sdate, $edate, $fkkn, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_Customer_employee_report_data_btwn_dates_process($employee, $customer, $sdate, $edate, $fkkn, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_Customer_employee_report_data_btwn_dates_process($employee, $customer, $sdate, $edate, $fkkn = NULL, $mode = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get customer-employee report datas between 2 dates
         * used in "kn report" of FKKN report module
         */
        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';

        $this->flush();
        $this->tables = array($timetable);
        $this->fields = array('id', 'date', 'time_from', 'time_to', 'type');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'status=1', array('NOT IN', 'type', '1,2,7,8,9,10,11,16,17'));
        $this->condition_values = array($customer, $sdate, $edate, $employee);

        if($fkkn != NULL) {
            $this->conditions[] = 'fkkn = ?';
            $this->condition_values[] = $fkkn;
        }

        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        // $datas = $this->query_fetch();
        // return $datas;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function distinct_timetable_years($all_year = null) {
        if($all_year != null){
            $this->tables = array('timetable');
            $this->fields = array('distinct(year(date)) as years');
            $this->order_by = array('years desc');
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $this->tables = array('backup_timetable');
            $this->fields = array('distinct(year(date)) as years');
            $this->order_by = array('years desc');
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY years DESC ';
            $datas = $this->query_fetch(2);
            return $datas;
        }
        else{
            $this->tables = array('timetable');
            $this->fields = array('distinct(year(date)) as years');
            $this->order_by = array('years desc');
            $this->query_generate();
            $datas = $this->query_fetch(2);
        }
        return $datas;
    }

    function get_employee_name($employee) {
        $this->tables = array('employee');
        $this->fields = array('first_name', 'last_name');
        $this->conditions = array('username = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        $result = $data[0]['first_name'] . " " . $data[0]['last_name'];
        return $result;
    }

    function Employee_contract_pdf($employee = Null, $id = Null, $customer = Null) {

        $contract_details = $this->get_employee_contract_details($employee, $id);
        $pdf = new PDF_EMP_Contract();
        $obj_emp = new employee();
        $obj_contract = new contract();
        $obj_smarty = new smartySetup(array("contract.xml"), FALSE);
        $company_data = $obj_emp->company_data();
        
        $cust_details = $obj_contract->get_customer_details_assigned_customers($contract_details[0]['customer_name']);
        ///////////////////////////////////////////page 1///////////////////////////////////////////////

        $pdf->AddPage();        //page1
        $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(1);
        $pdf->useTemplate($tppl, -6, 0, 210);
        $pdf->P1_top($contract_details, $company_data);
        $pdf->P1_SubPartA($obj_emp->employee_data($employee), $company_data);
        $pdf->P1_SubPartB($contract_details,$cust_details, $obj_smarty);
        $pdf->P1_SubPartC($contract_details);
        $pdf->P1_SubPartD($contract_details);
        $pdf->P1_SubPartE($contract_details);
        $pdf->P1_SubPartF($contract_details);
        $pdf->P1_SubPartG($contract_details);
        if ($contract_details[0]['sign_date'] != "" || $contract_details[0]['sign'] != null) {
            $pdf->P1_SubPartH($contract_details, $this->get_employee_name($contract_details[0]['alloc_employee']));
            $pdf->P1_SubPartI($contract_details, $this->get_employee_name($contract_details[0]['employee']), $company_data);
        }
        //$pdf->P1_SubPartH();
        //$pdf->P1_SubPartI();

        $pdf->AddPage();        //page2
        $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(2);
        $pdf->useTemplate($tppl, -6, 0, 210);

        $pdf->AddPage();        //page3
        $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(3);
        $pdf->useTemplate($tppl, -6, 0, 210);

        $pdf->AddPage();        //page4
        $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(4);
        $pdf->useTemplate($tppl, -6, 0, 210);

        //$pdf->P4_top();
        //$pdf->P4_table_body();

        $pdf->Output('Contract_'.$employee.'_'.date('Y-m-d').'.pdf','I');
    }

    function Employment_certificate_pdf($employee = Null, $id = Null, $customer = Null) {
        require_once ('plugins/customize_pdf_employee_certificate.class.php');

        //$contract_details =   $this->get_employee_contract_details($employee, $id);
        $obj_emp = new employee();
        $obj_company = new company();
        $period_from = explode('/', $this->Certification_period_from);
        $period_to = explode('/', $this->Certification_period_to);
        $pdf = new PDF_EMP_Certificate();
        $emp_details = $obj_emp->employee_data($this->employee_id);
        $certified_emp = $obj_emp->employee_data($_SESSION['user_id']);
        $logged_emp_name = $_SESSION['company_sort_by'] == 1 ? $certified_emp['first_name']. ' '. $certified_emp['last_name'] : $certified_emp['last_name']. ' '. $certified_emp['first_name'];
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////        
        $pdf->AddPage();        //page1
        $pdf->setSourceFile('./pdf_forms/AG_hours_edited.pdf');
        $tppl = $pdf->importPage(1);
        $pdf->useTemplate($tppl, -6, 0, 210);

        $pdf->P1_SubPart1($emp_details);
        $pdf->P1_SubPart2($this->employment_period_from, $this->employment_period_to, $this->still_employed, $this->post_held, $this->leave_effective_from, $this->leave_effective_to, $this->coverage_in);
        $pdf->P1_SubPart3($this->open_ended, $this->probationary_to, $this->temporary_employement, $this->Intermittent_employement);
        $pdf->P1_SubPart4($this->Arbetstid_open_ended, $this->parttime, $this->hours_per_week, $this->full_time_position_in_perc, $this->working_hours);
        $pdf->P1_SubPart5($this->employed_by_agency);
        $pdf->P1_SubPart6($this->employment_termination, $this->temporary_employment_closed, $this->own_request, $this->other_reason);
        $pdf->P1_SubPart7($this->termination_compensation);
        $pdf->P1_SubPart8($this->future_work_offer, $this->future_work_From, $this->future_work_to, $this->to_further, $this->full_time_per_week, $this->part_time_per_week, $this->full_time_position_in_perc_Erbjudande, $this->variable_time, $this->employer_accepted, $this->employer_accepted_date_when_no);
         $pdf->P1_SubPart9( $logged_emp_name);
        $start_year_static = $start_year = $period_from[0];
        $end_year_static = $end_year = $period_to[0];
        $start_year_start_month = $start_month = $period_from[1];
        $end_year_end_month = $end_month = $period_to[1];
        $year_difference = $period_to[0] - $period_from[0]+1;
        
        $total_tables_pages = ($year_difference % 2) + floor($year_difference / 2);
         
         $pdf->work_hour = $this->work_hour;
         $pdf->leave_hours = $this->leave_hours;
         $pdf->over_time = $this->over_time;
         $pdf->filling_hours = $this->filling_hours;


        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);


        
        for ($i = 0; $i < $total_tables_pages || $total_tables_pages == 0; $i++) {
            
            $temp_start_month = ($i == 0 ? $start_year_start_month : 1);
            $temp_end_month = ($i == $total_tables_pages - 1 || $total_tables_pages == 0 ? $end_year_end_month : 12);
                    
            if ($i == $total_tables_pages - 1 || $total_tables_pages == 0) {
                $pdf->AddPage();        //page2
                $pdf->setSourceFile('./pdf_forms/AG_hours_edited.pdf');
                $tppl = $pdf->importPage(2);
                $pdf->useTemplate($tppl, -6, 0, 210);

                $pdf->P2_SubPart10($emp_details);
                if ($start_year + 1 <= $end_year) {
                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $temp_start_month, $temp_end_month, $start_year + 1);
                    $start_year = $start_year + 2;
                } else {
                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $temp_start_month, $temp_end_month,$start_year + 1);
                    $start_year = $start_year + 1;
                }
                $pdf->P2_SubPart12($this->salary_to_year, $this->salary_type, $this->amount_in_sek, $this->hourly_rate_varied, $this->overtime_state, $this->additional_hours, $this->not_included_salary);

                $pdf->P2_SubPart13($this->Employed_with_uppehållslön, $this->Set_earned_uppehållslön, $this->Employed_with_ferielön, $this->no_of_beta_barn_holidays, $this->Set_earned_ferielön);
                $pdf->P2_SubPart14($this->other_information_1, $this->other_information_2);
                $pdf->P2_SubPart15($company_details,$logged_emp_name);
            } else {
                $pdf->AddPage();        //page2
                $pdf->setSourceFile('./pdf_forms/AG_hours_Content_table.pdf');
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl, -6, 0, 210);

                $pdf->P2_SubPart10($emp_details);
                if ($start_year + 1 <= $end_year) {
                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $temp_start_month, $temp_end_month, $start_year + 1);
                    $start_year = $start_year + 2;
                } else {
                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $temp_start_month, $temp_end_month,$start_year + 1);
                    $start_year = $start_year + 1;
                }
            }
            if ($total_tables_pages == 0)
                $total_tables_pages = -1;
            
            //echo $total_tables_pages; exit();
            //$start_year = $start_year + 2;
        }


        $summary_data = $chunked_summary_data = array();
        if($this->employee_id != '' && $this->Certification_period_from != '' && $this->Certification_period_to != '' && ($start_year_static == $end_year_static && $start_month <= $end_month) || ($start_year_static < $end_year_static)){
            $summary_data = $this->get_employee_certification_summery_data($this->employee_id, $start_year_static, $start_month, $end_year_static, $end_month, TRUE);
            $chunked_summary_data = array_chunk($summary_data, 26);
            $chunked_summary_data = !empty($chunked_summary_data) ? $chunked_summary_data : array(array());

        }
        if(!empty($chunked_summary_data)){
            foreach($chunked_summary_data as $sdata){
                $pdf->AddPage();        //page3
                $pdf->setSourceFile('./pdf_forms/Template_Arbgivarintyg.pdf');
                $tppl = $pdf->importPage(3);
                $pdf->useTemplate($tppl, -6, 0, 210);
                $pdf->P3_SubPart1($emp_details);
                if(!empty($sdata)){
                    $pdf->P3_SubPart2($sdata, $this->oncall_kr_times, $this->ob_kr_times, $this->timers,$this->angearts);
                }
            }
            $pdf->P3_SubPart3($company_details,$logged_emp_name);
        }

        $c_name = $this->create_pdf_certificate($this->employee_id);
        $company = $this->get_company_directory($_SESSION['company_id']);
        $pdf->Output("./" . $company['upload_dir'] . "/created_pdf_files/" . $c_name, 'F');
        $pdf->Output($c_name, 'I');
        // $pdf->Output();
    }

    function create_pdf_certificate($employee) {
        /**
         * Author: Shamsu
         * for: create a certificate entry on certificate history table
         */
        $certificate_name = 'Certificate_' . rand() . '.pdf';
        $this->tables = array('history_certification_report');
        $this->fields = array('employee', 'file');
        $this->field_values = array($employee, $certificate_name);
        $data = $this->query_insert();
        return $data ? $certificate_name : FALSE;
    }

    function create_pdf_sick($employee, $customer) {
        /**
         * Author: Shamsu
         * for: create a sick rpt entry on sick history table
         */
        $pdf_name = 'Sick_'. $customer . '_' . rand() . '.pdf';
        $this->tables = array('history_sick_report');
        $this->fields = array('employee', 'customer', 'file');
        $this->field_values = array($employee, $customer, $pdf_name);
        $data = $this->query_insert();
        return $data ? $pdf_name : FALSE;
    }

    function create_pdf_samsida($customer, $month, $year, $fkkn, $employee) {
        /**
         * Author: Shamsu
         * for: create a samsida entry on samsida history table
         */
        $pdf_name = 'Samsida_' . rand() . '.pdf';
        $this->tables = array('history_samsida_work_report');
        $this->fields = array('month', 'year', 'fkkn', 'customer', 'employee', 'file_name');
        $this->field_values = array($month, $year, $fkkn, $customer, $employee, $pdf_name);
        $process_flag = $this->query_insert();
        return $process_flag ? $pdf_name : FALSE;
    }

    function get_pdf_certificate($employee) {
        /**
         * Author: Shamsu
         * for: get certificate history entry
         */
        $this->tables = array('history_certification_report');
        $this->fields = array('file', 'date');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->order_by = array('date');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_pdf_sicks($employee, $customer) {
        /**
         * Author: Shamsu
         * for: get sick history entry
         */
        $this->tables = array('history_sick_report');
        $this->fields = array('file', 'date');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?');
        $this->condition_values = array($employee, $customer);
        $this->order_by = array('date desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_pdf_samsida($month, $year, $fkkn, $customer) {
        /**
         * Author: Shamsu
         * for: get samsida history entry
         */
        $this->tables = array('history_samsida_work_report');
        $this->fields = array('file_name', 'generated_date');
        $this->conditions = array('AND', 'month = ?', 'year = ?', 'fkkn = ?', 'customer = ?');
        $this->conditions = array('AND', 'month = ?', 'year = ?', 'fkkn = ?', 'customer = ?');
        $this->condition_values = array($month, $year, $fkkn, $customer);
        $this->order_by = array('generated_date desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_company_directory($company_id) {

        $this->tables = array($this->db_master . '.company');
        $this->fields = array('upload_dir');
        $this->conditions = array('id = ?');
        $this->condition_values = array($company_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_work_details_For_certification($employee_id, $year, $start_month, $end_month, $overtime_hours = false, $moretime_hours = false) {
        
        //----------------------------------------------------------
        $this->flush();
        // $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
        //         ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) AS work_hours 
        //         FROM `timetable` 
        //         WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND relation_id is null AND status = 1 GROUP BY year(date), month(date)";
        // $this->condition_values = array($employee_id, $year, $start_month, $end_month);
        $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
                ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) AS work_hours 
                FROM (
                    ( SELECT date, time_from, time_to, employee FROM `timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 1 ) 
                    UNION 
                    ( SELECT date, time_from, time_to, employee FROM `backup_timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 1 ) 
                ) As sample1
                GROUP BY year(date), month(date)";
        $this->condition_values = array($employee_id, $year, $start_month, $end_month, $employee_id, $year, $start_month, $end_month);
        $data_work_hour = $this->query_fetch();
        
        $this->flush();
        // $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
        //         ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) as leave_hours 
        //         FROM `timetable` 
        //         WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 2 GROUP BY year(date), month(date)";
        // $this->condition_values = array($employee_id, $year, $start_month, $end_month);
        $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
                ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) as leave_hours 
                FROM (
                    ( SELECT date, time_from, time_to, employee FROM `timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 2 ) 
                    UNION 
                    ( SELECT date, time_from, time_to, employee FROM `backup_timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 2 ) 
                ) As sample1
                GROUP BY year(date), month(date)";
        $this->condition_values = array($employee_id, $year, $start_month, $end_month, $employee_id, $year, $start_month, $end_month);
        $data_leave_hour = $this->query_fetch();
        
        $this->flush();
        // $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
        //         ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) as filling_hours 
        //         FROM `timetable` 
        //         WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND relation_id is not null AND status = 1 GROUP BY year(date), month(date)";
        // $this->condition_values = array($employee_id, $year, $start_month, $end_month);

        //////commented by shaju when told toincludereplaced hours in work hours. from the upper query relation id checking is removed to get all work hours

        /*$this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
                ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) as filling_hours 
                FROM (
                    ( SELECT date, time_from, time_to, employee FROM `timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND relation_id is not null AND status = 1  ) 
                    UNION 
                    ( SELECT date, time_from, time_to, employee FROM `backup_timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND relation_id is not null AND status = 1  ) 
                ) As sample1
                GROUP BY year(date), month(date)";
        $this->condition_values = array($employee_id, $year, $start_month, $end_month, $employee_id, $year, $start_month, $end_month);
        $data_filling_hour = $this->query_fetch();*/
        if($overtime_hours) {
            $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
                ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) AS overtime_hours 
                FROM (
                    ( SELECT date, time_from, time_to, employee FROM `timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 1 AND type IN(4,5)) 
                    UNION 
                    ( SELECT date, time_from, time_to, employee FROM `backup_timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 1 AND type IN(4,5)) 
                ) As sample1
                GROUP BY year(date), month(date)";
            $this->condition_values = array($employee_id, $year, $start_month, $end_month, $employee_id, $year, $start_month, $end_month);
            $data_ot_hour = $this->query_fetch();
            $this->flush();
        }
        if($moretime_hours) {
            $this->sql_query = "SELECT DISTINCT month(date) AS month, YEAR(date) AS year, employee as emp,
                ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),'.',':')) , time(replace(cast(time_from as char),'.',':')))) )/3600,2) AS more_hours 
                FROM (
                    ( SELECT date, time_from, time_to, employee FROM `timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 1 AND type IN(6,14)) 
                    UNION 
                    ( SELECT date, time_from, time_to, employee FROM `backup_timetable` WHERE employee = ? AND year(date) = ? AND month(date) >= ? AND month(date) <= ? AND status = 1 AND type IN(6,14)) 
                ) As sample1
                GROUP BY year(date), month(date)";
            $this->condition_values = array($employee_id, $year, $start_month, $end_month, $employee_id, $year, $start_month, $end_month);
            $data_more_hour = $this->query_fetch();
            $this->flush();
        }
        $data_work_hour_indexed = $data_leave_hour_indexed = $data_filling_hour_indexed = $data_ot_hour_indexed = $data_more_hour_indexed = array();
        if(!empty($data_work_hour)){
            foreach($data_work_hour as $entry)
                $data_work_hour_indexed[$entry['month']] = $entry;
        }
        if(!empty($data_leave_hour)){
            foreach($data_leave_hour as $entry)
                $data_leave_hour_indexed[$entry['month']] = $entry;
        }
        /*if(!empty($data_filling_hour)){
            foreach($data_filling_hour as $entry)
                $data_filling_hour_indexed[$entry['month']] = $entry;
        }*/
        if(!empty($data_ot_hour)){
            foreach($data_ot_hour as $entry)
                $data_ot_hour_indexed[$entry['month']] = $entry;
        }
        if(!empty($data_more_hour)){
            foreach($data_more_hour as $entry)
                $data_more_hour_indexed[$entry['month']] = $entry;
        }
        
        $datas = $data_work_hour_indexed;
        if(!empty($data_leave_hour_indexed)){
            foreach($data_leave_hour_indexed as $entry){
                if(isset($datas[$entry['month']])){
                    $datas[$entry['month']]['leave_hours'] = $entry['leave_hours'];
                }
                else 
                    $datas[$entry['month']] = $entry;
            }
        }
        /*if(!empty($data_filling_hour_indexed)){
            foreach($data_filling_hour_indexed as $entry){
                if(isset($datas[$entry['month']])){
                    $datas[$entry['month']]['filling_hours'] = $entry['filling_hours'];
                }
                else 
                    $datas[$entry['month']] = $entry;
            }
        }*/
        if(!empty($data_ot_hour_indexed)){
            foreach($data_ot_hour_indexed as $entry){
                if(isset($datas[$entry['month']])){
                    $datas[$entry['month']]['overtime_hours'] = $entry['overtime_hours'];
                }
                else 
                    $datas[$entry['month']] = $entry;
            }
        }
        if(!empty($data_more_hour_indexed)){
            foreach($data_more_hour_indexed as $entry){
                if(isset($datas[$entry['month']])){
                    $datas[$entry['month']]['more_hours'] = $entry['more_hours'];
                }
                else 
                    $datas[$entry['month']] = $entry;
            }
        }
        $datas = array_values($datas);
        return $datas;
    }

    function get_least_and_most_timetable_dates($employee_id) {

        /*$this->flush();
        $this->tables = array('timetable');
        $this->fields = array('month(min(date)) as least_month', 'year(min(date)) as least_year', 'month(max(date)) as most_month', 'year(max(date)) as most_year');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];*/

        $this->flush();
        $this->sql_query = 'SELECT month(min(date)) as least_month, year(min(date)) as least_year, month(max(date)) as most_month, year(max(date)) as most_year 
        FROM (
            ( SELECT DISTINCT date FROM `timetable` WHERE employee = ? ) 
            UNION 
            ( SELECT DISTINCT date FROM `backup_timetable` WHERE employee = ? ) 
        ) As sample1';
        $this->condition_values = array($employee_id, $employee_id);
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function attach_employee_age($data_array) {

        if ($data_array) {
            for ($i = 0; $i < count($data_array); $i++) {
                $this->tables = array('employee');
                $this->fields = array('century', 'social_security');
                $this->conditions = array('username = ?');
                $this->condition_values = array($data_array[$i]['employee_id']);
                $this->query_generate();
                $datas = $this->query_fetch();
                if (!empty($datas)) {
                    $yyyy = $datas[0]['century'] . substr($datas[0]['social_security'], 0, 2);
                    $mm = substr($datas[0]['social_security'], 2, 2);
                    $dd = substr($datas[0]['social_security'], 4, 2);
                    $year_diff = date("Y") - $yyyy;
                    $month_diff = date("m") - $mm;
                    $day_diff = date("d") - $dd;
                    if ($month_diff == 0) {
                        if ($day_diff < 0)
                            $year_diff--;
                    }
                    else if ($month_diff < 0)
                        $year_diff--;

                    $data_array[$i]['age'] = $year_diff;
                }
                else {
                    $data_array[$i]['age'] = 0;
                }
            }

            return $data_array;
        }
        else
            return FALSE;
    }

    function Financial_payment_pdf($company_details = array(), $customer_details = array(), $customer_gardian_details = array(), $obj_pdf = NULL, $print_report = TRUE) {

        $obj_emp = new employee();
        $customer = new customer();
        $equipment = new equipment();
        $obj_general     = new general();
        $obj_convertor = new Converter(array(),array(), $this->leavePeriod_year);
        $inconvenient_process_obj = new inconvenient();
        //$obj_dona = new dona();
        
        
        if(empty($company_details)){
            $obj_company = new company();
            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        }

        if(empty($customer_details))
            $customer_details = $customer->customer_detail($this->leave_customer);
        if(empty($customer_gardian_details))
            $customer_gardian_details = $customer->customer_guardian($this->leave_customer);

        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_Fin_Payment();

        $emp_details = $obj_emp->employee_data($this->leave_employee);
        // $all_leave_works = $this->get_employee_leaved_timetable_works($this->leave_employee, $this->leavePeriod_year, $this->leavePeriod_month, $this->leave_customer);
        $all_leave_works = $this->get_employee_leaved_timetable_works($this->leave_employee, $this->leavePeriod_year, $this->leavePeriod_month);
        $all_leave_works_grouped = $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
        
        //echo "<pre>".print_r($all_leave_works_grouped, 1)."</pre>";
        $karense_dataset = $obj_convertor->get_karens_data($this->leave_employee, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $this->leavePeriod_month, $this->leavePeriod_year, null, 0.00, 24.00, FALSE,'FROM_FORM');

        //echo "<pre>".print_r($karense_dataset, 1)."</pre>";
        
        if($karense_dataset) {
            $karense_dataset = array_values($karense_dataset);
            //echo "<pre>".print_r($all_leave_works_grouped, 1)."</pre>";
            //echo "--------------------------------------------------------------------<br>";
            //remove non matched records which has other customers from non-karens list
            foreach ($karense_dataset as $main_key => $karense_data1){
                foreach($karense_data1 as $key => $karens_data){
                    //if((isset($karense_data['non_karens']) && !empty($karense_data['non_karens'])) || (isset($karense_data['karens']) && !empty($karense_data['karens']))){

                    if($key == 'non_karens_2_14' || $key == 'karens' || $key == 'non_karens_15_180' || $key == 'non_karens_180_onwards'){

                        foreach ($karens_data as $dateKey => $non_karense_date_data){
                            if(!empty($non_karense_date_data)){
                                foreach ($non_karense_date_data as $slotKey => $non_karense_slot_data){
                                    if($non_karense_slot_data['customer'] != $this->leave_customer || $non_karense_slot_data['type'] == 10){
                                        unset($karense_dataset[$main_key][$key][$dateKey][$slotKey]);
                                    }
                                }
                                if(empty($karense_dataset[$main_key][$key][$dateKey]))
                                    unset($karense_dataset[$main_key][$key][$dateKey]);
                            }
                        }
                        if(empty($karense_dataset[$main_key][$key]))
                            unset($karense_dataset[$main_key][$key]);
                    }
                }

                if(count($karense_dataset[$main_key]) == 1 && key($karense_dataset[$main_key]) == 'actual_karens'){
                    unset($karense_dataset[$main_key]);
                }
            }
        }
        //echo "<pre>".print_r($karense_dataset,1)."</pre>";exit();
        $pdf->company_details       = $company_details;
        $pdf->ordinary_pay          = $this->words_pay;
        $pdf->sick_pay              = $this->kr_h;
        $pdf->on_call               = $this->on_call;
        $pdf->oncall_holiday        = $this->oncall_holiday;
        $pdf->oncall_bigholiday     = $this->oncall_bigholiday;
        $pdf->inconvinient_evening  = $this->inconvinient_evening;
        $pdf->inconvinient_holiday  = $this->inconvinient_holiday;
        $pdf->inconvinient_night    = $this->inconvinient_night;
        $pdf->inconvinient_week_holiday = $this->inconvinient_week_holiday;
        $pdf->table_sum             = "";
        $pdf->page_ref_no           = NULL;

        
        ///////////////////////////////////////////page 2///////////////////////////////////////////////
        //$pdf->AddPage();
        //$pdf->P2_top($this->collective);
        $flag = 0;
        $table_no = 0;
        
        $referenses_usage_count = 0;

        if($karense_dataset){
            foreach ($karense_dataset as $karense_data){
                $date1 = $date2 = $current_karens_date = NULL;

                if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                    reset($karense_data['karens']);         //reset pointer to its first element (0 index)
                    $current_karens_date = $date1 = key($karense_data['karens']);  //get first key name from the array
                    end($karense_data['karens']);           //navigate pointer to end
                    $date2 = key($karense_data['karens']);  //get last key name from the array
                }

                if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_2_14']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_2_14']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_2_14']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_2_14']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }

                if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_15_180']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_15_180']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_15_180']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_15_180']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }

                if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_180_onwards']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_180_onwards']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_180_onwards']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_180_onwards']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }


                if($date1 == NULL) $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                if($date2 == NULL) $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));

                $qualifying_day_total_hour__ = 0;
                $normal_salary = 0;
                if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                    $normal_salary = $inconvenient_process_obj->get_salary($karense_data['karens'][$date1][0]['date'], $this->leave_employee, 'normal');
                    foreach ($karense_data['karens'] as $dateKey => $karense_date_data){
                        if(!empty($karense_date_data)){
                            foreach ($karense_date_data as $karense_date_data_single){
                                if($karense_date_data_single['customer'] == $this->leave_customer)
                                    $qualifying_day_total_hour__ = $equipment->time_sum($qualifying_day_total_hour__, $equipment->time_difference($karense_date_data_single['time_to'], $karense_date_data_single['time_from']));
                            }
                        }
                    }
                }
                $non_karens_data_set = array();
                //echo "<pre>".print_r($karense_data['non_karens_2_14'], 1)."</pre>";
                if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                    foreach ($karense_data['non_karens_2_14'] as $dateKey => $non_karense_date_data){
                        if(!empty($non_karense_date_data)){
                            $non_karens_data_set = array_merge($non_karens_data_set, $non_karense_date_data);
                        }
                    }
                }

                $non_karens_15_180_data_set = array();
                if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                    foreach ($karense_data['non_karens_15_180'] as $dateKey => $non_karense_date_data){
                        if(!empty($non_karense_date_data)){
                            $non_karens_15_180_data_set = array_merge($non_karens_15_180_data_set, $non_karense_date_data);
                        }
                    }
                }

                $non_karens_180_onwards_data_set = array();
                if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                    foreach ($karense_data['non_karens_180_onwards'] as $dateKey => $non_karense_date_data){
                        if(!empty($non_karense_date_data)){
                            $non_karens_180_onwards_data_set = array_merge($non_karens_180_onwards_data_set, $non_karense_date_data);
                        }
                    }
                }
                // echo "<pre>".print_r($non_karens_data_set, 1)."</pre>";

                // $qualifying_day_total_hour = $this->get_employee_timetable_leaved_work_details_by_date_copy($qualifying_leave_works[$i], $this_qday_exceeded_karense);
                $qualifying_day_total_hour = array(
                    'grand_total_time'      => $qualifying_day_total_hour__,
                    'qualifying_total_time' => $qualifying_day_total_hour__,
                    'nomal_salary_amount'   => $normal_salary
                );

                // $incov_details = $this->get_employee_inconv_leaved_works_between_two_dates_copy($this->leave_employee, $this->leave_customer, $date1, $date_14, $this_qday_exceeded_karense_id, $company_details);
                //echo "<pre>".print_r($non_karens_data_set, 1)."</pre>";
                $vikaries           = $this->get_all_vikaries_btwn_dates($date1, $date2, $this->leave_customer, $this->leave_employee);
                

                /*$incov_details = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $non_karens_data_set, $date1, $date2, $company_details);
                $incov_details['15_180'] = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $non_karens_15_180_data_set, $date1, $date2, $company_details);
                $incov_details['180_onwards'] = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $non_karens_180_onwards_data_set, $date1, $date2, $company_details);*/

                
                //echo "<pre>".print_r($non_karens_data_set, 1)."</pre>";
                $incov_details = $incov_details_claim = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $this->crop_sick_with_vikarie($non_karens_data_set, $vikaries,$all_leave_works_grouped), $date1, $date2, $company_details);
                //echo "<pre>".print_r($this->crop_sick_with_vikarie($non_karens_data_set, $vikaries,$all_leave_works_grouped), 1)."</pre>";
                $incov_details['15_180'] = $incov_details_claim['15_180'] = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $this->crop_sick_with_vikarie($non_karens_15_180_data_set, $vikaries,$all_leave_works_grouped), $date1, $date2, $company_details);
                $incov_details['180_onwards'] = $incov_details_claim['180_onwards'] = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $this->crop_sick_with_vikarie($non_karens_180_onwards_data_set, $vikaries,$all_leave_works_grouped), $date1, $date2, $company_details);




                $cur_karens_date_array = $current_karens_date != NULL ? array($current_karens_date) : array();
                $cur_karense_data_set_array = isset($karense_data['karens']) ? $karense_data['karens'] : array();
                //echo $this->insurance_word_person."--".$this->SS_contibution;
                $ord_table_sum = $pdf->get_P2_table1_sum_copy($date1, $date2, $this->insurance_word_person, $this->SS_contibution, $incov_details_claim, $qualifying_day_total_hour);
                //$ord_table_sum = $this->make_Financial_payment_pdf_table_footer_sum_copy($pdf, $date1, $date2, $cur_karense_data_set_array,$non_karens_data_set,$non_karens_15_180_data_set, $non_karens_180_onwards_data_set, $company_details, $all_leave_works_grouped);
                $this->make_Financial_payment_pdf_table_header($pdf, $date1, $date2, $customer_details, $company_details, $customer_gardian_details, $emp_details, $cur_karens_date_array, $all_leave_works, $this->reference[$referenses_usage_count], $ord_table_sum, $all_leave_works_grouped);
                $pdf->AddPage();
                $pdf->P2_top($this->collective);
                //echo "<pre>".print_r($incov_details, 1)."</pre>";
                $pdf->P2_table1($date1, $date2, $this->insurance_word_person, $this->SS_contibution, $incov_details, $qualifying_day_total_hour);
                

                $this->make_Financial_payment_pdf_table_footer($pdf, $date1, $date2, $cur_karense_data_set_array,$non_karens_data_set,$non_karens_15_180_data_set, $non_karens_180_onwards_data_set, $company_details, $all_leave_works_grouped);

                
                $total_ordinarie_time = $this->calculate_total_time_from_dataset_4_Financial_payment_footer($all_leave_works, $date1, $date2, $equipment);
                $pdf->P2_table3($total_ordinarie_time);
                $pdf->P2_bottom();
                $referenses_usage_count++;
            }
        }
        else{
            //$ord_table_sum = $pdf->get_P2_table1_sum_copy(NULL, NULL, $this->insurance_word_person, $this->SS_contibution, array(), array());
            $ord_table_sum = $this->make_Financial_payment_pdf_table_footer_sum_copy($pdf, NULL, NULL, array(),array(),array(),array(), $company_details, $all_leave_works_grouped);
            $pdf->AddPage();
            $pdf->P2_top($this->collective);
            $pdf->P2_table1(NULL, NULL, $this->insurance_word_person, $this->SS_contibution, array(), array());
            $this->make_Financial_payment_pdf_table_footer($pdf, NULL, NULL, array(),array(),array(),array(), $company_details, $all_leave_works_grouped);
            
            $total_ordinarie_time = $this->calculate_total_time_from_dataset_4_Financial_payment_footer($all_leave_works, NULL, NULL, $equipment);
            $pdf->P2_table3($total_ordinarie_time);
            $pdf->P2_bottom();
        }


        if($print_report){
            $leave_form_name = $this->create_pdf_sick($this->leave_employee,$this->leave_customer);
            $company = $this->get_company_directory($_SESSION['company_id']);
            $pdf->Output("./". $company['upload_dir'] ."/created_pdf_files/".$leave_form_name,'F');
            $pdf->Output($leave_form_name, 'I');    //standard output
            // $pdf->Output();
        }
        else 
            return $pdf;
    }
    
    function make_Financial_payment_pdf_table_header($pdf, $date1, $date2, $customer_details, $company_details, $customer_gardian_details, $emp_details, $Q_work_dates, $all_leave_works, $reference, $ord_table_sum, $leave_works_grouped = array()){
        
        $equipment = new equipment();
        
        if($date1 !== NULL && $date2 !== NULL){
            // $list_relations = $equipment->relations_leave_employee_btwn_dates($date1, $date2, $this->leave_customer, $this->leave_employee);
            $vikaries           = $this->get_all_vikaries_btwn_dates($date1, $date2, $this->leave_customer, $this->leave_employee);
            $list_relations     = $this->crop_vikarie_slots_based_on_its_parent($vikaries, $leave_works_grouped, $this->leave_customer);
        }
        else
            $list_relations = array();
        
        $list_relations_partition = array_chunk($list_relations, 6);
        $Hourly_times_partition = array_chunk($this->Hourly_times, 6);
        
        $extracts_this_period_leaves = array();
        $leave_date_starts = $leave_date_ends = NULL;
        if(!empty($all_leave_works)){
            foreach($all_leave_works as $lw){
                if($lw['date'] >= $date1 && $lw['date'] <= $date2)
                    $extracts_this_period_leaves[] = $lw;
            }
            if(!empty($extracts_this_period_leaves)){
                $leave_date_starts = $extracts_this_period_leaves[0]['date'];
                $leave_date_ends = $extracts_this_period_leaves[count($extracts_this_period_leaves) - 1]['date'];
            }
        }
        
        ///////////////////////////////////////////page 1///////////////////////////////////////////////
        if ($list_relations_partition) {
            for ($p = 0; $p < count($list_relations_partition); $p++) {
                $pdf->AddPage();        //page1
                $pdf->setSourceFile('./pdf_forms/economic_FK.pdf');
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl, -2, 0, 210);
                
                $pdf->page_ref_no = $reference;
                $pdf->P1_table_1($customer_details);
                $pdf->P1_table_2($company_details, $customer_gardian_details, $this->assignment, $this->proxies, $this->submission);
                $pdf->P1_table_3($this->comp_paid_to_account, $reference, $ord_table_sum);
                $pdf->P1_table_4($emp_details, $Q_work_dates, $leave_date_starts, $leave_date_ends);
                $pdf->P1_table_5($list_relations_partition[$p], $Hourly_times_partition[$p], $list_relations, $this->Hourly_times);
                $pdf->P1_Bifogas($this->sick_leave_reg, $this->copy_of_payroll, $this->time_sheet_h_service, $this->additional_cost);
            }
        } else {
            $pdf->AddPage();        //page1
            $pdf->setSourceFile('./pdf_forms/economic_FK.pdf');
            $tppl = $pdf->importPage(1);
            $pdf->useTemplate($tppl, -2, 0, 210);

            $pdf->P1_table_1($customer_details);
            $pdf->P1_table_2($company_details, $customer_gardian_details, $this->assignment, $this->proxies, $this->submission);
            $pdf->P1_table_3($this->comp_paid_to_account, $reference, $ord_table_sum);
            $pdf->P1_table_4($emp_details, $Q_work_dates, $leave_date_starts, $leave_date_ends);
            $pdf->P1_table_5(array(), array(), $list_relations, $this->Hourly_times);
            $pdf->P1_Bifogas($this->sick_leave_reg, $this->copy_of_payroll, $this->time_sheet_h_service, $this->additional_cost);
        }
    }
    
    function make_Financial_payment_pdf_table_footer($pdf, $date_start, $date_end, $karense_data_set, $non_karens_2_14, $non_karens_15_180, $non_karens_181_onwards, $company_details, $leave_works_grouped = array()){
        
        $non_karens_2_14_dates = array_column($non_karens_2_14, 'date');
        $non_karens_15_180_dates = array_column($non_karens_15_180, 'date');
        $non_karens_181_onwards_dates = array_column($non_karens_181_onwards, 'date');

        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();
        $vikaries = $group_vikaries = array();
        if($date_start !== NULL && $date_end !== NULL) {
            $vikaries           = $this->get_all_vikaries_btwn_dates($date_start, $date_end, $this->leave_customer, $this->leave_employee);            
            $updated_vikaries   = $this->crop_vikarie_slots_based_on_its_parent($vikaries, $leave_works_grouped, $this->leave_customer);
            //echo "leave<pre>".print_r($updated_vikaries, 1)."</pre>";
            // $group_vikaries = $this->grouping_vikaries($vikaries);
            if(!empty($updated_vikaries))
                $group_vikaries = $this->grouping_vikaries($updated_vikaries);
        }
            

        //echo "leave<pre>".print_r($group_vikaries, 1)."</pre>";
        if ($group_vikaries) {
            for ($i = 0; $i < count($group_vikaries); $i++) {
                // echo "++++++++++++++<pre>".print_r($group_vikaries[$i][0]['employee_id'], 1)."</pre>";
                // echo "<pre>".print_r($group_vikaries[$i], 1)."</pre>";
                $qualifying_day_total_hour  = array();
                $incov_details              = array('inconv_details' => array(), 'semestersattn_jour_dag_2_14_salaries' => array(), 'oncall_type_salaries' => array());
                $incov_details_15_180              = array('inconv_details' => array(), 'semestersattn_jour_dag_2_14_salaries' => array(), 'oncall_type_salaries' => array());
                $incov_details_181              = array('inconv_details' => array(), 'semestersattn_jour_dag_2_14_salaries' => array(), 'oncall_type_salaries' => array());
                $vikaries_normal_salary     = $inconvenient_process_obj->get_salary($group_vikaries[$i][0]['date'], $group_vikaries[$i][0]['employee_id'], 'normal');
                $vikarie_insurance          = $inconvenient_process_obj->get_salary($group_vikaries[$i][0]['date'], $group_vikaries[$i][0]['employee_id'], 'insurance');
                $vikarie_age                = $this->attach_employee_age(array(array('employee_id' => $group_vikaries[$i][0]['employee_id'])));

                if ($vikarie_age[0]['age'] < 25) $vikarie_sociala = 31.42;// 15.49;
                elseif ($vikarie_age[0]['age'] < 65) $vikarie_sociala = 31.42;
                elseif ($vikarie_age[0]['age'] >= 65) $vikarie_sociala = 16.36;//31.42// 15.49;


                if(!empty($group_vikaries[$i])){
                    $work_data              = $group_vikaries[$i];
                    $total_count_work_data  = count($work_data);
                    $data_set_karensed      = array();
                    $data_set_non_karensed  = array();
                    $data_set_non_karensed_15_180  = array();
                    $data_set_non_karensed_181  = array();
                    for ($j = 0; $j < $total_count_work_data; $j++) {
                        $found_as_karens = FALSE;
                        $founded_karens_data = array();
                        if(!empty($karense_data_set) && isset($karense_data_set[$work_data[$j]['date']])){
                            foreach($karense_data_set[$work_data[$j]['date']] as $key => $shortlistedKarens){
                                if(($shortlistedKarens['time_from'] >= $work_data[$j]['time_from'] && $shortlistedKarens['time_from'] < $work_data[$j]['time_to']) || 
                                    ($shortlistedKarens['time_to'] > $work_data[$j]['time_from'] && $shortlistedKarens['time_to'] <= $work_data[$j]['time_to']) || 
                                    ($shortlistedKarens['time_from'] <= $work_data[$j]['time_from'] && $shortlistedKarens['time_to'] >= $work_data[$j]['time_to'])){
                                    $found_as_karens = TRUE;
                                    $founded_karens_data[] = $karense_data_set[$work_data[$j]['date']][$key];
                                }else
                                {
                                    // $founded_karens_data[] = $karense_data_set[$work_data[$j]['date']][$key];
                                    if(!empty($non_karens_2_14_dates) && in_array($work_data[$j]['date'],$non_karens_2_14_dates))
                                    {
                                        //echo "(t2)";
                                        $data_set_non_karensed[] = $work_data[$j];
                                    }elseif(!empty($non_karens_15_180_dates) && in_array($work_data[$j]['date'],$non_karens_15_180_dates))
                                    {
                                        //echo "(t3)";
                                        $data_set_non_karensed_15_180[] = $work_data[$j];
                                    }elseif(!empty($non_karens_181_onwards_dates) && in_array($work_data[$j]['date'],$non_karens_181_onwards_dates))
                                    {
                                        //echo "(t4)";
                                        $data_set_non_karensed_181[] = $work_data[$j];
                                    }
                                }
                            }
                        }
                        // else{
                        //     $data_set_non_karensed[] = $work_data[$j];
                        // }
                        elseif(!empty($non_karens_2_14_dates) && in_array($work_data[$j]['date'],$non_karens_2_14_dates)){
                            $data_set_non_karensed[] = $work_data[$j];
                        }elseif(!empty($non_karens_15_180_dates) && in_array($work_data[$j]['date'],$non_karens_15_180_dates)){
                            $data_set_non_karensed_15_180[] = $work_data[$j];
                        }elseif(!empty($non_karens_181_onwards_dates) && in_array($work_data[$j]['date'],$non_karens_181_onwards_dates)){
                            $data_set_non_karensed_181[] = $work_data[$j];
                        }
                        
                        if($found_as_karens){
                            foreach($founded_karens_data as $fKarens){
                                if($fKarens['time_from'] > $work_data[$j]['time_from'] && $fKarens['time_to'] < $work_data[$j]['time_to']){
                                    $___temp_data_              = $work_data[$j];
                                    $___temp_data_['time_to']   = $fKarens['time_from'];
                                    $data_set_non_karensed[]    = $___temp_data_;

                                    $___temp_data_              = $work_data[$j];
                                    $___temp_data_['time_from'] = $fKarens['time_from'];
                                    $___temp_data_['time_to']   = $fKarens['time_to'];
                                    $data_set_karensed[]        = $___temp_data_;

                                    $___temp_data_              = $work_data[$j];
                                    $___temp_data_['time_from'] = $fKarens['time_to'];
                                    $data_set_non_karensed[]    = $___temp_data_;
                                    
                                }
                                else{
                                    $ktfrom = $ktto = $nktfrom = $nktto = NULL;
                                    if($fKarens['time_from'] >= $work_data[$j]['time_from'] && $fKarens['time_from'] < $work_data[$j]['time_to']){
                                        $nktfrom = $work_data[$j]['time_from'];
                                        $ktfrom = $fKarens['time_from'];

                                        $nktto = $fKarens['time_from'];
                                        $ktto = $work_data[$j]['time_to'];
                                    }
                                    if($fKarens['time_to'] > $work_data[$j]['time_from'] && $fKarens['time_to'] <= $work_data[$j]['time_to']){
                                        $nktto = $work_data[$j]['time_to'];
                                        $ktto = $fKarens['time_to'];

                                        if($nktfrom == NULL || $fKarens['time_to'] < $work_data[$j]['time_to']) $nktfrom = $fKarens['time_to'];
                                        if($ktfrom == NULL) $ktfrom = $work_data[$j]['time_from'];
                                    }
                                    if($fKarens['time_from'] <= $work_data[$j]['time_from'] && $fKarens['time_to'] >= $work_data[$j]['time_to']){
                                        $ktfrom = $work_data[$j]['time_from'];
                                        $ktto = $work_data[$j]['time_to'];
                                        $nktfrom = $nktto = NULL;
                                    }

                                    if($nktfrom != NULL && $nktto != NULL && $nktfrom != $nktto && $nktfrom < $nktto){
                                        $___temp_data_              = $work_data[$j];
                                        $___temp_data_['time_from'] = $nktfrom;
                                        $___temp_data_['time_to']   = $nktto;
                                        $data_set_non_karensed[]    = $___temp_data_;
                                    }
                                    if($ktfrom != NULL && $ktto != NULL && $ktfrom != $ktto && $ktfrom < $ktto){
                                        $___temp_data_              = $work_data[$j];
                                        $___temp_data_['time_from'] = $ktfrom;
                                        $___temp_data_['time_to']   = $ktto;
                                        $data_set_karensed[]        = $___temp_data_;
                                    }
                                }
                            }
                        }
                    }
                    //echo "<pre>data_set_karensed: ".print_r($data_set_karensed, 1)."</pre>";
                    //echo "<pre>data_set_non_karensed: ".print_r($data_set_non_karensed, 1)."</pre>";
                    //echo "<pre>data_set_non_karensed181: ".print_r($data_set_non_karensed_181, 1)."</pre>";
                    $qualifying_day_total_hour = array();
                    if(!empty($data_set_karensed)){
                        $qualifying_day_total_hour  = $this->process_qualifying_day_hours_copy($data_set_karensed);
                    }
                    $this_incov_details = array();
                    if(!empty($data_set_non_karensed)){
                        $this_incov_details         = $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($data_set_non_karensed, $company_details);
                    }
                    $incov_details              = $this_incov_details;
                    //echo "<pre>incov_details_15_180: ".print_r($incov_details, 1)."</pre>";exit();
                    
                    if(!empty($data_set_non_karensed_15_180)){
                        $incov_details_15_180 = $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($data_set_non_karensed_15_180, $company_details);
                    }

                    
                    if(!empty($data_set_non_karensed_181)){
                        $incov_details_181 = $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($data_set_non_karensed_181, $company_details);
                    }
                    //echo "<pre>this_incov_details: ".print_r($this_incov_details, 1)."</pre>";
                    /* 
                        if (!empty($this_incov_details['inconv_details']) && !empty($incov_details['inconv_details'])) {
                            foreach ($this_incov_details['inconv_details'] as $key => $time_values) {
                                foreach ($time_values as $inc_salary => $h_values) {
                                    if (isset($incov_details['inconv_details'][$key][$inc_salary])) {
                                        $incov_details['inconv_details'][$key][$inc_salary]['hour'] = $equipment->time_sum($incov_details['inconv_details'][$key][$inc_salary]['hour'], $h_values['hour']);
                                    } else {
                                        $incov_details['inconv_details'][$key][$inc_salary]['hour'] = $h_values['hour'];
                                    }
                                }
                            }
                        } else if (!empty($this_incov_details['inconv_details']))
                            $incov_details['inconv_details'] = $this_incov_details['inconv_details'];

                        //merge semestersattn_jour_dag_2_14_salaries
                        if (!empty($this_incov_details['semestersattn_jour_dag_2_14_salaries']) && !empty($incov_details['semestersattn_jour_dag_2_14_salaries'])) {
                            foreach ($this_incov_details['semestersattn_jour_dag_2_14_salaries'] as $sal => $param_values) {
                                if(!empty($incov_details['semestersattn_jour_dag_2_14_salaries'][$sal]) || isset($incov_details['semestersattn_jour_dag_2_14_salaries'][$sal]))
                                    $incov_details['semestersattn_jour_dag_2_14_salaries'][$sal]['hours'] = $equipment->time_sum($incov_details['semestersattn_jour_dag_2_14_salaries'][$sal]['hours'], $param_values['hours']);
                                else
                                    $incov_details['semestersattn_jour_dag_2_14_salaries'][$sal]['hours'] = $param_values['hours'];
                            }
                        } else if (!empty($this_incov_details['semestersattn_jour_dag_2_14_salaries']))
                            $incov_details['semestersattn_jour_dag_2_14_salaries'] = $this_incov_details['semestersattn_jour_dag_2_14_salaries'];
                        
                        
                        //merge oncall_type_salaries
                        if (!empty($this_incov_details['oncall_type_salaries']) && !empty($incov_details['oncall_type_salaries'])) {
                            foreach ($this_incov_details['oncall_type_salaries'] as $jour_key => $jour_attributes) {
                                foreach($jour_attributes as $jour_salary => $jour_hours){
                                    if($jour_hours == '') continue;
                                    if(!empty($incov_details['oncall_type_salaries'][$jour_key][$jour_salary]) || isset($incov_details['oncall_type_salaries'][$jour_key][$jour_salary]))
                                        $incov_details['oncall_type_salaries'][$jour_key][$jour_salary]['hour'] = $equipment->time_sum($incov_details['oncall_type_salaries'][$jour_key][$jour_salary]['hour'], $jour_hours['hour']);
                                    else
                                        $incov_details['oncall_type_salaries'][$jour_key][$jour_salary]['hour'] = $jour_hours['hour'];
                                }
                            }
                        } else if (!empty($this_incov_details['oncall_type_salaries']))
                            $incov_details['oncall_type_salaries'] = $this_incov_details['oncall_type_salaries'];
                    */
                    
                }

                $pdf->P2_table2($group_vikaries[$i][0]['employee'], $vikaries_normal_salary, $vikarie_insurance, $incov_details, $incov_details_15_180, $incov_details_181, $qualifying_day_total_hour, $vikarie_sociala);
                //echo '<br>**********************************************************<br>';
            }
        }
        else
            $pdf->P2_table2(NULL, NULL, 0, array(), array(),array(),array(), 0);
    }


    function make_Financial_payment_pdf_table_footer_sum_copy($pdf, $date_start, $date_end, $karense_data_set, $non_karens_2_14, $non_karens_15_180, $non_karens_181_onwards, $company_details, $leave_works_grouped = array()){
        
        $non_karens_2_14_dates = array_column($non_karens_2_14, 'date');
        $non_karens_15_180_dates = array_column($non_karens_15_180, 'date');
        $non_karens_181_onwards_dates = array_column($non_karens_181_onwards, 'date');

        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();
        $vikaries = $group_vikaries = array();
        
        if($date_start !== NULL && $date_end !== NULL) {
            $vikaries           = $this->get_all_vikaries_btwn_dates($date_start, $date_end, $this->leave_customer, $this->leave_employee);            
            $updated_vikaries   = $this->crop_vikarie_slots_based_on_its_parent($vikaries, $leave_works_grouped, $this->leave_customer);
            //echo "leave<pre>".print_r($updated_vikaries, 1)."</pre>";
            // $group_vikaries = $this->grouping_vikaries($vikaries);
            if(!empty($updated_vikaries))
                $group_vikaries = $this->grouping_vikaries($updated_vikaries);
        }
            

        $val = 0;
        if ($group_vikaries) {
            for ($i = 0; $i < count($group_vikaries); $i++) {
                // echo "++++++++++++++<pre>".print_r($group_vikaries[$i][0]['employee_id'], 1)."</pre>";
                // echo "<pre>".print_r($group_vikaries[$i], 1)."</pre>";
                $qualifying_day_total_hour  = array();
                $incov_details              = array('inconv_details' => array(), 'semestersattn_jour_dag_2_14_salaries' => array(), 'oncall_type_salaries' => array());
                $incov_details_15_180              = array('inconv_details' => array(), 'semestersattn_jour_dag_2_14_salaries' => array(), 'oncall_type_salaries' => array());
                $incov_details_181              = array('inconv_details' => array(), 'semestersattn_jour_dag_2_14_salaries' => array(), 'oncall_type_salaries' => array());
                $vikaries_normal_salary     = $inconvenient_process_obj->get_salary($group_vikaries[$i][0]['date'], $group_vikaries[$i][0]['employee_id'], 'normal');
                $vikarie_insurance          = $inconvenient_process_obj->get_salary($group_vikaries[$i][0]['date'], $group_vikaries[$i][0]['employee_id'], 'insurance');
                $vikarie_age                = $this->attach_employee_age(array(array('employee_id' => $group_vikaries[$i][0]['employee_id'])));

                if ($vikarie_age[0]['age'] < 25) $vikarie_sociala = 31.42;// 15.49;
                elseif ($vikarie_age[0]['age'] < 65) $vikarie_sociala = 31.42;
                elseif ($vikarie_age[0]['age'] >= 65) $vikarie_sociala = 16.36;//31.42// 15.49;


                if(!empty($group_vikaries[$i])){
                    $work_data              = $group_vikaries[$i];
                    $total_count_work_data  = count($work_data);
                    $data_set_karensed      = array();
                    $data_set_non_karensed  = array();
                    $data_set_non_karensed_15_180  = array();
                    $data_set_non_karensed_181  = array();
                    for ($j = 0; $j < $total_count_work_data; $j++) {
                        $found_as_karens = FALSE;
                        $founded_karens_data = array();
                        if(!empty($karense_data_set) && isset($karense_data_set[$work_data[$j]['date']])){
                            foreach($karense_data_set[$work_data[$j]['date']] as $key => $shortlistedKarens){
                                if(($shortlistedKarens['time_from'] >= $work_data[$j]['time_from'] && $shortlistedKarens['time_from'] < $work_data[$j]['time_to']) || 
                                    ($shortlistedKarens['time_to'] > $work_data[$j]['time_from'] && $shortlistedKarens['time_to'] <= $work_data[$j]['time_to']) || 
                                    ($shortlistedKarens['time_from'] <= $work_data[$j]['time_from'] && $shortlistedKarens['time_to'] >= $work_data[$j]['time_to'])){
                                    $found_as_karens = TRUE;
                                    $founded_karens_data[] = $karense_data_set[$work_data[$j]['date']][$key];
                                }
                            }
                        }
                        // else{
                        //     $data_set_non_karensed[] = $work_data[$j];
                        // }
                        elseif(!empty($non_karens_2_14_dates) && in_array($work_data[$j]['date'],$non_karens_2_14_dates)){
                            $data_set_non_karensed[] = $work_data[$j];
                        }elseif(!empty($non_karens_15_180_dates) && in_array($work_data[$j]['date'],$non_karens_15_180_dates)){
                            $data_set_non_karensed_15_180[] = $work_data[$j];
                        }elseif(!empty($non_karens_181_onwards_dates) && in_array($work_data[$j]['date'],$non_karens_181_onwards_dates)){
                            $data_set_non_karensed_181[] = $work_data[$j];
                        }
                        
                        if($found_as_karens){
                            foreach($founded_karens_data as $fKarens){
                                if($fKarens['time_from'] > $work_data[$j]['time_from'] && $fKarens['time_to'] < $work_data[$j]['time_to']){
                                    $___temp_data_              = $work_data[$j];
                                    $___temp_data_['time_to']   = $fKarens['time_from'];
                                    $data_set_non_karensed[]    = $___temp_data_;

                                    $___temp_data_              = $work_data[$j];
                                    $___temp_data_['time_from'] = $fKarens['time_from'];
                                    $___temp_data_['time_to']   = $fKarens['time_to'];
                                    $data_set_karensed[]        = $___temp_data_;

                                    $___temp_data_              = $work_data[$j];
                                    $___temp_data_['time_from'] = $fKarens['time_to'];
                                    $data_set_non_karensed[]    = $___temp_data_;
                                    
                                }
                                else{
                                    $ktfrom = $ktto = $nktfrom = $nktto = NULL;
                                    if($fKarens['time_from'] >= $work_data[$j]['time_from'] && $fKarens['time_from'] < $work_data[$j]['time_to']){
                                        $nktfrom = $work_data[$j]['time_from'];
                                        $ktfrom = $fKarens['time_from'];

                                        $nktto = $fKarens['time_from'];
                                        $ktto = $work_data[$j]['time_to'];
                                    }
                                    if($fKarens['time_to'] > $work_data[$j]['time_from'] && $fKarens['time_to'] <= $work_data[$j]['time_to']){
                                        $nktto = $work_data[$j]['time_to'];
                                        $ktto = $fKarens['time_to'];

                                        if($nktfrom == NULL || $fKarens['time_to'] < $work_data[$j]['time_to']) $nktfrom = $fKarens['time_to'];
                                        if($ktfrom == NULL) $ktfrom = $work_data[$j]['time_from'];
                                    }
                                    if($fKarens['time_from'] <= $work_data[$j]['time_from'] && $fKarens['time_to'] >= $work_data[$j]['time_to']){
                                        $ktfrom = $work_data[$j]['time_from'];
                                        $ktto = $work_data[$j]['time_to'];
                                        $nktfrom = $nktto = NULL;
                                    }

                                    if($nktfrom != NULL && $nktto != NULL && $nktfrom != $nktto && $nktfrom < $nktto){
                                        $___temp_data_              = $work_data[$j];
                                        $___temp_data_['time_from'] = $nktfrom;
                                        $___temp_data_['time_to']   = $nktto;
                                        $data_set_non_karensed[]    = $___temp_data_;
                                    }
                                    if($ktfrom != NULL && $ktto != NULL && $ktfrom != $ktto && $ktfrom < $ktto){
                                        $___temp_data_              = $work_data[$j];
                                        $___temp_data_['time_from'] = $ktfrom;
                                        $___temp_data_['time_to']   = $ktto;
                                        $data_set_karensed[]        = $___temp_data_;
                                    }
                                }
                            }
                        }
                    }
                    //echo "<pre>data_set_karensed: ".print_r($data_set_karensed, 1)."</pre>";
                    //echo "<pre>data_set_non_karensed: ".print_r($data_set_non_karensed, 1)."</pre>";
                    //echo "<pre>data_set_non_karensed181: ".print_r($data_set_non_karensed_181, 1)."</pre>";
                    $qualifying_day_total_hour = array();
                    if(!empty($data_set_karensed)){
                        $qualifying_day_total_hour  = $this->process_qualifying_day_hours_copy($data_set_karensed);
                    }
                    $this_incov_details = array();
                    if(!empty($data_set_non_karensed)){
                        $this_incov_details         = $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($data_set_non_karensed, $company_details);
                    }
                    $incov_details              = $this_incov_details;
                    //echo "<pre>incov_details_15_180: ".print_r($incov_details, 1)."</pre>";exit();
                    
                    if(!empty($data_set_non_karensed_15_180)){
                        $incov_details_15_180 = $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($data_set_non_karensed_15_180, $company_details);
                    }

                    
                    if(!empty($data_set_non_karensed_181)){
                        $incov_details_181 = $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($data_set_non_karensed_181, $company_details);
                    }
                    
                }

                $val +=  $pdf->get_P2_table2_sum_copy($group_vikaries[$i][0]['employee'], $vikaries_normal_salary, $vikarie_insurance, $incov_details, $incov_details_15_180, $incov_details_181, $qualifying_day_total_hour, $vikarie_sociala);
            }
        }
        else
            $val = $pdf->get_P2_table2_sum_copy(NULL, NULL, 0, array(), array(),array(),array(), 0);
        return $val;
    }
    
    function calculate_total_time_from_dataset_4_Financial_payment_footer($all_leave_works, $date1, $date2, $equipment){
        $total_ordinarie_time = 0;
        if(!empty($all_leave_works) && $date1 !== NULL && $date2 !== NULL){
            foreach ($all_leave_works as $ord_work) {
                if($ord_work['date'] >= $date1 && $ord_work['date'] <= $date2 && $ord_work['customer'] == $this->leave_customer){
                    $total_ordinarie_time = $equipment->time_sum($total_ordinarie_time, $equipment->time_difference($ord_work['time_to'], $ord_work['time_from']));
                }
            }
        }
        return $total_ordinarie_time;
    }

    function multi_array_search($key, $value, $stack){
        $result = array();
        foreach($stack as $stack_data){
            if($stack_data[$key] == $value){
                $result[] = $stack_data;
            }
        }
        return $result;
    }

    function crop_sick_with_vikarie($dataset, $vikarie_slots, $all_leave_works_grouped){
        $equipment   = new equipment(); 
        $vikarie_slots = $this->crop_vikarie_slots_based_on_its_parent($vikarie_slots, $all_leave_works_grouped, $this->leave_customer);
        //echo "<pre>".print_r($vikarie_slots, 1)."</pre>";
        $result = array();
        foreach($dataset as $data){
            $curresponding_vikarie_slots = $this->multi_array_search('relation_id', $data['id'], $vikarie_slots);
            
                
            
            if(!empty($curresponding_vikarie_slots)){
                foreach($curresponding_vikarie_slots as $vikarie_slot){
                    if($data['customer'] == $vikarie_slot['customer'] &&  $data['date'] == $vikarie_slot['date'] && ($vikarie_slot['time_from'] >= $data['time_from'] || $vikarie_slot['time_to'] > $data['time_from']) && ($vikarie_slot['time_from'] < $data['time_to'] || $vikarie_slot['time_to'] <= $data['time_to']) ){
                        $temp = $data;
                        if($vikarie_slot['time_from'] > $data['time_from'] && $vikarie_slot['time_from'] < $data['time_to'])
                            $temp['time_from'] = $vikarie_slot['time_from'];
                        if($vikarie_slot['time_to'] < $data['time_to'] && $vikarie_slot['time_to'] > $data['time_from'])
                            $temp['time_to'] = $vikarie_slot['time_to'];
                    }else{
                        $temp['time_from'] = 0;
                        $temp['time_to'] = 0;
                    }
                    
                    $result[] = $temp;
                }   
            }else{
                $temp = $data;
                $temp['time_from'] = 0;
                $temp['time_to'] = 0;
                $result[] = $temp;
            }
            


        }
        return $result;
    }

    function crop_vikarie_slots_based_on_its_parent($vikaries, $leave_works_grouped, $cur_customer){

        $updated_vikaries = array();

        if(!empty($vikaries) && !empty($leave_works_grouped)){
            $equipment = new equipment();
            
            //remove spanned timeslots of vikaries which does not contains in leave slots
            foreach($vikaries as $v){
                if(!empty($leave_works_grouped[$v['date']])){
                    $found_parent_leave = FALSE;
                    $founded_parent_leave = array();
                    foreach($leave_works_grouped[$v['date']] as $lv){
                        if($lv['id'] == $v['relation_id'] && $lv['customer'] == $cur_customer){
                            $found_parent_leave = TRUE;
                            $founded_parent_leave = $lv;
                            break;
                        }
                    }

                    if($found_parent_leave){
                        $___temp_tfrom = $___temp_tto = NULL;
                        if(!(($v['time_from'] < $founded_parent_leave['time_from'] && $v['time_to'] < $founded_parent_leave['time_from']) || ($v['time_from'] > $founded_parent_leave['time_to'] && $v['time_to'] > $founded_parent_leave['time_to']))){
                            if($founded_parent_leave['time_from'] >= $v['time_from'] && $v['time_to'] > $founded_parent_leave['time_from']) 
                                $___temp_tfrom = $founded_parent_leave['time_from'];
                            else
                                $___temp_tfrom = $v['time_from'];
                            if($founded_parent_leave['time_to'] <= $v['time_to'] && $founded_parent_leave['time_to'] > $v['time_from']) 
                                $___temp_tto = $founded_parent_leave['time_to'];
                            else
                                $___temp_tto = $v['time_to'];
                        }

                        if($___temp_tfrom !== NULL && $___temp_tto != NULL && $___temp_tfrom < $___temp_tto){
                            $___temp_data_set               = $v;
                            $___temp_data_set['time_from']  = $___temp_tfrom;
                            $___temp_data_set['time_to']    = $___temp_tto;
                            $___temp_data_set['tot_time']   = $equipment->time_user_format($equipment->time_difference($___temp_tfrom, $___temp_tto), 100);
                            $updated_vikaries[] = $___temp_data_set;
                        }
                    }
                }
            }

            $group_vikaries = $this->grouping_vikaries($updated_vikaries);
        }

        return $updated_vikaries;
    }
    
    function leave_annex_pdf($company_details = array(), $customer_details = array(), $customer_contract_details = array(), $obj_pdf = NULL, $print_report = TRUE) {

        require_once ('plugins/pdf_leave_annex.class.php');
        $obj_emp     = new employee();
        $customer    = new customer();
        $equipment   = new equipment();
        $obj_company = new company();
        $obj_general = new general();
        $inconvenient_process_obj = new inconvenient();
        $obj_convertor = new Converter(array(),array(), $this->leavePeriod_year);

        if(empty($company_details)){
            $obj_company = new company();
            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        }

        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_leave_annex();

        $leave_employees = array();
        if ($this->leave_employee == '') {
            $leave_employees_data = $equipment->employees_leave_under_customer($this->leavePeriod_month, $this->leavePeriod_year, $this->leave_customer);
            if (!empty($leave_employees_data)) {
                foreach ($leave_employees_data as $leave_e) {
                    $leave_employees[] = $leave_e['employee_id'];
                }
            }
        }
        else
            $leave_employees[] = $this->leave_employee;


        //--------------------------------------------------------------------
        if (!empty($leave_employees)) {
            if(empty($customer_details))
                $customer_details = $customer->customer_detail($this->leave_customer);
            
            if(empty($customer_contract_details) && $customer_contract_details !== NULL){
                $first_day_of_month = $this->leavePeriod_year.'-'.$this->leavePeriod_month.'-01';
                $contract_start_date = date("Y-m-01", strtotime($first_day_of_month));
                $contract_end_date = date("Y-m-t", strtotime($first_day_of_month));
                $customer_contract_details = $customer->get_customer_contract_within_a_month($this->leave_customer, $contract_start_date, $contract_end_date, 2);
                if(empty($customer_contract_details))
                    $customer_contract_details = $customer->get_customer_contract_within_a_month($this->leave_customer, $contract_start_date, $contract_end_date, 3);
                if(!empty($customer_contract_details)) $customer_contract_details = $customer_contract_details[0];
            }
            if($customer_contract_details == NULL) $customer_contract_details = array();

            $pdf->company_details = $company_details;

            foreach ($leave_employees as $this->leave_employee) {
                $emp_details = $obj_emp->employee_data($this->leave_employee);
                // $all_leave_works = $this->get_employee_leaved_timetable_works($this->leave_employee, $this->leavePeriod_year, $this->leavePeriod_month, $this->leave_customer);
                $all_leave_works        = $this->get_employee_leaved_timetable_works($this->leave_employee, $this->leavePeriod_year, $this->leavePeriod_month);
                $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
                $vikaries               = $equipment->relations_leave_employee($this->leavePeriod_month, $this->leavePeriod_year, $this->leave_customer, $this->leave_employee);
                $list_relations         = $this->crop_vikarie_slots_based_on_its_parent($vikaries, $all_leave_works_grouped, $this->leave_customer);
                
                //--------------------------------------------------------
                //echo "<pre>".print_r($all_leave_works_grouped, 1)."</pre>";
                $karense_dataset = $obj_convertor->get_karens_data($this->leave_employee, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $this->leavePeriod_month, $this->leavePeriod_year, null, 0.00, 24.00, FALSE,'FROM_FORM');
                if($karense_dataset) {
                    $karense_dataset = array_values($karense_dataset);

                    //remove non matched records which has other customers from non-karens list
                    foreach ($karense_dataset as $main_key => $karense_data){
                        if(isset($karense_data['non_karens']) && !empty($karense_data['non_karens'])){
                            foreach ($karense_data['non_karens'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    foreach ($non_karense_date_data as $slotKey => $non_karense_slot_data){
                                        if($non_karense_slot_data['customer'] != $this->leave_customer || $non_karense_slot_data['type'] == 10){
                                            unset($karense_dataset[$main_key]['non_karens'][$dateKey][$slotKey]);
                                        }
                                    }
                                    if(empty($karense_dataset[$main_key]['non_karens'][$dateKey]))
                                        unset($karense_dataset[$main_key]['non_karens'][$dateKey]);
                                }
                            }
                            if(empty($karense_dataset[$main_key]['non_karens']))
                                unset($karense_dataset[$main_key]['non_karens']);
                        }
                    }
                }


                $pdf->AddPage();
                $pdf->report_top($emp_details, $customer_contract_details,$customer_details);
                $pdf->section2($customer_details, $this->leavePeriod_year, $this->leavePeriod_month);
                //$pdf->content_part($Q_work_dates);

                $flag = 0;
                $table_no = 0;

                if($karense_dataset){

                    $total_count_karense_dataset = count($karense_dataset);
                    foreach ($karense_dataset as $karense_data){
                        $date1 = $date2 = $current_karens_date = NULL;

                        if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                            reset($karense_data['karens']);         //reset pointer to its first element (0 index)
                            $current_karens_date = $date1 = key($karense_data['karens']);  //get first key name from the array
                            end($karense_data['karens']);           //navigate pointer to end
                            $date2 = key($karense_data['karens']);  //get last key name from the array
                        }

                        if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                            if($date1 == NULL){
                                reset($karense_data['non_karens_2_14']);         //reset pointer to its first element (0 index)
                                $date1 = key($karense_data['non_karens_2_14']);  //get first key name from the array
                            }
                            end($karense_data['non_karens_2_14']);           //navigate pointer to end
                            $date2__ = key($karense_data['non_karens_2_14']);
                            if(strtotime($date2) < strtotime($date2__))
                                $date2 = $date2__;
                        }

                        if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                            if($date1 == NULL){
                                reset($karense_data['non_karens_15_180']);         //reset pointer to its first element (0 index)
                                $date1 = key($karense_data['non_karens_15_180']);  //get first key name from the array
                            }
                            end($karense_data['non_karens_15_180']);           //navigate pointer to end
                            $date2__ = key($karense_data['non_karens_15_180']);
                            if(strtotime($date2) < strtotime($date2__))
                                $date2 = $date2__;
                        }

                        if($date1 == NULL) $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                        if($date2 == NULL) $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));

                        $qualifying_day_total_hour__ = 0;
                        // $normal_salary = 0;
                        $normal_salary = $inconvenient_process_obj->get_salary($date1, $this->leave_employee, 'normal');
                        if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                            // $normal_salary = $inconvenient_process_obj->get_salary($karense_data['karens'][$date1][0]['date'], $this->leave_employee, 'normal');
                            foreach ($karense_data['karens'] as $dateKey => $karense_date_data){
                                if(!empty($karense_date_data)){
                                    foreach ($karense_date_data as $karense_date_data_single){
                                        if($karense_date_data_single['customer'] == $this->leave_customer)
                                            $qualifying_day_total_hour__ = $equipment->time_sum($qualifying_day_total_hour__, $equipment->time_difference($karense_date_data_single['time_to'], $karense_date_data_single['time_from']));
                                    }
                                }
                            }
                        }
                        $non_karens_data_set = array();
                        if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                            foreach ($karense_data['non_karens_2_14'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    $non_karens_data_set = array_merge($non_karens_data_set, $non_karense_date_data);
                                }
                            }
                        }
                        $non_karens_15_180_data_set = array();
                        if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                            foreach ($karense_data['non_karens_15_180'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    $non_karens_15_180_data_set = array_merge($non_karens_15_180_data_set, $non_karense_date_data);
                                }
                            }
                        }

                        $non_karens_181_onwards = array();
                        if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                            foreach ($karense_data['non_karens_180_onwards'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    $non_karens_180_onwards = array_merge($non_karens_180_onwards, $non_karense_date_data);
                                }
                            }
                        }
                        // echo "<pre>".print_r($non_karens_15_180_data_set, 1)."</pre>";exit();

                        // $qualifying_day_total_hour = $this->get_employee_timetable_leaved_work_details_by_date_copy($qualifying_leave_works[$i], $this_qday_exceeded_karense);
                        $qualifying_day_total_hour = array(
                            'grand_total_time'      => $qualifying_day_total_hour__,
                            'qualifying_total_time' => $qualifying_day_total_hour__,
                            'nomal_salary_amount'   => $normal_salary
                        );

                        // $incov_details = $this->get_employee_inconv_leaved_works_between_two_dates_copy($this->leave_employee, $this->leave_customer, $date1, $date_14, $this_qday_exceeded_karense_id, $company_details);

                        $incov_details = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $non_karens_data_set, $date1, $date2, $company_details);
                        $incov_details['15_180'] = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $non_karens_15_180_data_set, $date1, $date2, $company_details);
                        $incov_details['181_onwards'] = $this->get_employee_inconv_leaved_works_from_dataset($this->leave_employee, $this->leave_customer, $non_karens_181_onwards, $date1, $date2, $company_details);
                        // echo "<pre>".print_r($incov_details, 1)."</pre>";

                        $cur_karens_date_array = $current_karens_date != NULL ? array($current_karens_date) : array();
                        // $cur_karense_data_set_array = isset($karense_data['karens']) ? $karense_data['karens'] : array();

                        $pdf->karense_work_dates = $cur_karens_date_array;
                        //echo "<pre>".print_r($incov_details, 1)."</pre>";
                        $pdf->P2_table1($date1, $date2, $this->insurance_word_person, $this->SS_contibution, $incov_details, $qualifying_day_total_hour, $normal_salary, $cur_karens_date_array);

                        if($table_no+1 != $total_count_karense_dataset){
                            $pdf->footer_section();
                            $pdf->AddPage();
                            $pdf->report_top($emp_details, $customer_contract_details, $customer_details);
                            $pdf->section2($customer_details, $this->leavePeriod_year, $this->leavePeriod_month);
                        }
                        $table_no += 1;
                    }
                }
                else{
                    $pdf->P2_table1(NULL, NULL, $this->insurance_word_person, $this->SS_contibution, array(), array());
                }

                $pdf->footer_section();
            }
        } else {
            $pdf->AddPage();
            $pdf->no_content_page();
        }

        if($print_report){
            $pdf->Output(utf8_decode('sjukfaktura').'_'.$this->leave_customer.'_'.date('Ymd').'.pdf', 'I');
        }
        else 
            return $pdf;
    }


    
    function sick_leave_complete_for_employee($employee_username, $year, $month) {
        require_once ('class/newcustomer.php');
        require_once ('class/converter.php');
        $obj_emp = new employee();
        $customer = new customer();
        $obj_newcustomer = new newcustomer();
        $equipment = new equipment();
        $obj_general     = new general();
        $obj_convertor = new Converter(array(),array(), $year);
        $inconvenient_process_obj = new inconvenient();
        $pdf = new PDF_Fin_Payment();


        $obj_company = new company();
        $GlobalSetting          = $obj_newcustomer->GetGlobalSetting();
        $this->company_details = $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        $year_month = sprintf('%04d', $year).sprintf('%02d', $month);
        $emp_details = $obj_emp->get_employee_incov_detail($employee_username);
        $sel_employee_age = $this->attach_employee_age(array(array('employee_id' => $employee_username)));
        $sel_employees_age = $sel_employee_age[0]['age'];

        $leave_data = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        $insurance = $inconvenient_process_obj->get_salary($fromdate, $employee_username, 'insurance');
        //echo "<pre>".print_r($insurance, 1)."</pre>";
        $nomal_salary = $inconvenient_process_obj->get_salary($fromdate, $employee_username, 'normal');
        //echo "<pre>".print_r($nomal_salary, 1)."</pre>";
        $this->words_pay            = $nomal_salary; 
        $this->kr_h                 = $company_details['fk_kr_per_time'];
        $this->insurance_word_person= $insurance;
        $this->insurance_substitute = '';     
        $this->SS_contibution       = '16.36'; 
        /*if($sel_employees_age < 25) $this->SS_contibution = BELOW_25;
        else if($sel_employees_age < 65)  $this->SS_contibution = BTWN_25_65;
        else if($sel_employees_age >= 65) $this->SS_contibution = ABOVE_65; 
        //echo $this->SS_contibution;*/
        $this->inconvinient_week_holiday= $GlobalSetting[0]["inconvinient_week_holiday"];
        $this->on_call                  = ($emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ?  $emp_detail['on_call'] : $GlobalSetting[0]["on_call"]);
        $this->oncall_holiday           = ($emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $GlobalSetting[0]["on_call_holiday"]);
        $this->oncall_bigholiday        = ($emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $GlobalSetting[0]["on_call_bigholiday"]);
        $this->inconvinient_evening     = ($emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $GlobalSetting[0]["inconvinient_evening"]);
        $this->inconvinient_night       = ($emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]["inconvinient_night"]);
        $this->inconvinient_holiday     = ($emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]["inconvinient_holiday"]);
        $pdf->company_details       = $company_details;
        $pdf->ordinary_pay          = $this->words_pay;
        $pdf->sick_pay              = $this->kr_h;
        $pdf->on_call               = $this->on_call;
        $pdf->oncall_holiday        = $this->oncall_holiday;
        $pdf->oncall_bigholiday     = $this->oncall_bigholiday;
        $pdf->inconvinient_evening  = $this->inconvinient_evening;
        $pdf->inconvinient_holiday  = $this->inconvinient_holiday;
        $pdf->inconvinient_night    = $this->inconvinient_night;
        $pdf->inconvinient_week_holiday = $this->inconvinient_week_holiday;
        $pdf->table_sum             = "";
        $pdf->page_ref_no           = NULL;

        $leave_hours = $obj_convertor->get_sum_leave_approved_slots_between_dates($employee_username, $fromdate, $todate);
        $leave_days_array = $obj_convertor->get_all_leaves_for_report_between_dates($employee_username, $fromdate, $todate, "FOOL");
        $leave_days = count($leave_days_array);
        //echo "<pre>".print_r($leave_days, 1)."</pre>";
        $this->sql_query = "SELECT DISTINCT t.customer FROM timetable t LEFT JOIN `leave` l ON t.date = l.date and t.employee = l.employee AND l.type=1 AND l.status=1 WHERE t.date BETWEEN '".$fromdate."' AND '".$todate."' AND t.employee LIKE '".$employee_username."'";
        $customer_datas = $this->query_fetch();
        $all_leave_works = $this->get_employee_leaved_timetable_works($employee_username, $year, $month);
        if(!empty($all_leave_works)) {
            $all_leave_works_grouped = $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
            $karense_dataset1 = $karense_dataset = $obj_convertor->get_karens_data($employee_username, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $month, $year, null, 0.00, 24.00, FALSE,'FROM_FORM');
        }
        //echo "<pre>".print_r($karense_dataset, 1)."</pre>";
        if(!empty($customer_datas)) {
            foreach ($customer_datas as $customer_data) {
                $customer_username = $customer_data['customer'];
                //echo "<pre>".print_r($karense_dataset, 1)."</pre>";
                $karense_dataset = $karense_dataset1;
                if($karense_dataset) {
                    $karense_dataset = array_values($karense_dataset);
                    foreach ($karense_dataset as $main_key => $karense_data1){
                        foreach($karense_data1 as $key => $karens_data){
                            if($key == 'non_karens_2_14' || $key == 'karens' || $key == 'non_karens_15_180' || $key == 'non_karens_180_onwards'){

                                foreach ($karens_data as $dateKey => $non_karense_date_data){
                                    if(!empty($non_karense_date_data)){
                                        foreach ($non_karense_date_data as $slotKey => $non_karense_slot_data){
                                            if($non_karense_slot_data['customer'] != $customer_username || $non_karense_slot_data['type'] == 10){
                                                unset($karense_dataset[$main_key][$key][$dateKey][$slotKey]);
                                            }
                                        }
                                        if(empty($karense_dataset[$main_key][$key][$dateKey]))
                                            unset($karense_dataset[$main_key][$key][$dateKey]);
                                    }
                                }
                                if(empty($karense_dataset[$main_key][$key]))
                                    unset($karense_dataset[$main_key][$key]);
                            }
                        }

                        if(count($karense_dataset[$main_key]) == 1 && key($karense_dataset[$main_key]) == 'actual_karens'){
                            unset($karense_dataset[$main_key]);
                        }
                    }
                }
                //echo "<pre>".print_r($karense_dataset,1)."</pre>";
                
                if($karense_dataset){
                    foreach ($karense_dataset as $karense_data){
                        $date1 = $date2 = $current_karens_date = NULL;

                        if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                            reset($karense_data['karens']);         //reset pointer to its first element (0 index)
                            $current_karens_date = $date1 = key($karense_data['karens']);  //get first key name from the array
                            end($karense_data['karens']);           //navigate pointer to end
                            $date2 = key($karense_data['karens']);  //get last key name from the array
                        }

                        if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                            if($date1 == NULL){
                                reset($karense_data['non_karens_2_14']);         //reset pointer to its first element (0 index)
                                $date1 = key($karense_data['non_karens_2_14']);  //get first key name from the array
                            }
                            end($karense_data['non_karens_2_14']);           //navigate pointer to end
                            $date2__ = key($karense_data['non_karens_2_14']);
                            if(strtotime($date2) < strtotime($date2__))
                                $date2 = $date2__;
                        }

                        if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                            if($date1 == NULL){
                                reset($karense_data['non_karens_15_180']);         //reset pointer to its first element (0 index)
                                $date1 = key($karense_data['non_karens_15_180']);  //get first key name from the array
                            }
                            end($karense_data['non_karens_15_180']);           //navigate pointer to end
                            $date2__ = key($karense_data['non_karens_15_180']);
                            if(strtotime($date2) < strtotime($date2__))
                                $date2 = $date2__;
                        }

                        if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                            if($date1 == NULL){
                                reset($karense_data['non_karens_180_onwards']);         //reset pointer to its first element (0 index)
                                $date1 = key($karense_data['non_karens_180_onwards']);  //get first key name from the array
                            }
                            end($karense_data['non_karens_180_onwards']);           //navigate pointer to end
                            $date2__ = key($karense_data['non_karens_180_onwards']);
                            if(strtotime($date2) < strtotime($date2__))
                                $date2 = $date2__;
                        }


                        if($date1 == NULL) $date1 = $year . "-" . $month . "-01";
                        if($date2 == NULL) $date2 = date('Y-m-t', strtotime($year . "-" . $month . "-01"));

                        $qualifying_day_total_hour__ = 0;
                        $normal_salary = 0;
                        if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                            $normal_salary = $inconvenient_process_obj->get_salary($karense_data['karens'][$date1][0]['date'], $this->leave_employee, 'normal');
                            foreach ($karense_data['karens'] as $dateKey => $karense_date_data){
                                if(!empty($karense_date_data)){
                                    foreach ($karense_date_data as $karense_date_data_single){
                                        if($karense_date_data_single['customer'] == $customer_username)
                                            $qualifying_day_total_hour__ = $equipment->time_sum($qualifying_day_total_hour__, $equipment->time_difference($karense_date_data_single['time_to'], $karense_date_data_single['time_from']));
                                    }
                                }
                            }
                        }

                        $non_karens_data_set = array();
                        //echo "<pre>".print_r($karense_data['non_karens_2_14'], 1)."</pre>";
                        if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                            foreach ($karense_data['non_karens_2_14'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    $non_karens_data_set = array_merge($non_karens_data_set, $non_karense_date_data);
                                }
                            }
                        }

                        $non_karens_15_180_data_set = array();
                        if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                            foreach ($karense_data['non_karens_15_180'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    $non_karens_15_180_data_set = array_merge($non_karens_15_180_data_set, $non_karense_date_data);
                                }
                            }
                        }

                        $non_karens_180_onwards_data_set = array();
                        if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                            foreach ($karense_data['non_karens_180_onwards'] as $dateKey => $non_karense_date_data){
                                if(!empty($non_karense_date_data)){
                                    $non_karens_180_onwards_data_set = array_merge($non_karens_180_onwards_data_set, $non_karense_date_data);
                                }
                            }
                        }
                        $qualifying_day_total_hour = array(
                            'grand_total_time'      => $qualifying_day_total_hour__,
                            'qualifying_total_time' => $qualifying_day_total_hour__,
                            'nomal_salary_amount'   => $normal_salary
                        );

                        //echo "<pre>".print_r($qualifying_day_total_hour,1)."</pre>";
                        //echo "<pre>".print_r($non_karens_data_set,1)."</pre>";
                        

                        $incov_details = $this->get_employee_inconv_leaved_works_from_dataset($employee_username, $customer_username, $non_karens_data_set, $date1, $date2, $company_details);
                        $incov_details['15_180'] = $this->get_employee_inconv_leaved_works_from_dataset($employee_username, $customer_username, $non_karens_15_180_data_set, $date1, $date2, $company_details);
                        $incov_details['180_onwards'] = $this->get_employee_inconv_leaved_works_from_dataset($employee_username, $customer_username, $non_karens_180_onwards_data_set, $date1, $date2, $company_details);
                        $cur_karens_date_array = $current_karens_date != NULL ? array($current_karens_date) : array();
                        $cur_karense_data_set_array = isset($karense_data['karens']) ? $karense_data['karens'] : array();
                        //echo "<pre>".print_r($incov_details,1)."</pre>";
                        //echo $this->insurance_word_person .'-';
                        //echo $this->SS_contibution .'-';
                        //echo '<pre>' . print_r($qualifying_day_total_hour,1) . '</pre>';
                        $ord_table_sum = $pdf->get_P2_table1_sum_copy($date1, $date2, $this->insurance_word_person, $this->SS_contibution, $incov_details, $qualifying_day_total_hour);
                        $leave_data['oncall_amount'] += $ord_table_sum;
                      
                    }
                }
                $leave_data['oncall_total'] = $leave_hours;
                $leave_data['year_month'] = $year_month;
                $leave_data['working_days'] = $leave_days;
                $leave_data['ob_total'] = '';
                $leave_data['ob_amount'] = '';
            }
            
        }
        if(!$leave_days) {
            return array();
        }
        return $leave_data;
    }

    function get_distint_leave_years_from_timetable() {

        $this->tables = array('timetable');
        $this->fields = array('distinct(year(date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function grouping_vikaries($vikaries_array) {
        $grouped_array = array();
        for ($i = 0; $i < count($vikaries_array); $i++) {
            $flg = 0;
            $j = 0;
            for (; $j < count($grouped_array); $j++) {
                if ($vikaries_array[$i]['employee_id'] == $grouped_array[$j][0]['employee_id']) {
                    $flg = 1;
                    break;
                }
            }

            if ($flg == 1) {
                $grouped_array[$j][] = $vikaries_array[$i];
            }
            else
                $grouped_array[][0] = $vikaries_array[$i];
        }
        return $grouped_array;
    }

    function get_all_vikaries($month, $year, $cust, $emp) {

        $this->tables = array('timetable` as `t','leave` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND', 'month(t.date) = ?', 'year(t.date) = ?', 't.status = 2', 't.customer = ?', 't.employee = ?', 
                'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to');
        $this->condition_values = array($month, $year, $cust, $emp);
        $this->query_generate();
        //echo $this->sql_query; 
        $time_table_ids = $this->query_fetch(2);
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';

        $this->tables = array('timetable` as `t', 'employee` as `e');
        $this->fields = array('t.id', 't.employee as employee_id', 'concat(first_name ," ", last_name) as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn', 't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 't.relation_id as relation_id');
        $this->conditions = array('AND', 'month(t.date) = ?', 'year(t.date) = ?', 't.status = 1', array('IN', 't.relation_id', $ids), 't.customer = ?', 'e.username like t.employee');
        $this->condition_values = array($month, $year, $cust);
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }
    
    function get_all_vikaries_btwn_dates($date1, $date2, $cust, $emp) {

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = $date1;
        $todate = $date2;
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_all_vikaries_btwn_dates_process($date1, $date2, $cust, $emp, 1);
            $query_2_action = $this->get_all_vikaries_btwn_dates_process($date1, $date2, $cust, $emp, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from, time_to';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_all_vikaries_btwn_dates_process($date1, $date2, $cust, $emp, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_all_vikaries_btwn_dates_process($date1, $date2, $cust, $emp, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }

    function get_all_vikaries_btwn_dates_process($date1, $date2, $cust, $emp, $mode = 1) {

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 2', 't.customer = ?', 't.employee = ?', 
                'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to', 'l.status = 1');
        $this->condition_values = array($date1, $date2, $cust, $emp);
        $this->query_generate();
        $time_table_ids = $this->query_fetch(2);
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';

        $this->tables = array($timetable.'` as `t', 'employee` as `e');
        $this->fields = array('t.id', 't.employee as employee_id', 'concat(first_name ," ", last_name) as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn', 't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 't.relation_id as relation_id');
        $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 1', array('IN', 't.relation_id', $ids), 't.customer = ?', 'e.username like t.employee');
        $this->condition_values = array($date1, $date2, $cust);
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        // $data = $this->query_fetch();
        // return $data;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_employee_inconv_leaved_works_from_dataset($employee_id, $customer, $dataset, $sdate, $edate, $company_details = array()) {

        /**
         * Author: Shamsu
         * for: Salary report calculation TEST 
         * to refer origial : get_employee_inconv_leaved_works_between_two_dates_copy()
         */
        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();



        $inconv_normal_slots = $dataset;
        $total_sal = $semestersattn_jour_dag_2_14_salaries = $oncall_type_salaries = array();
        if (!empty($inconv_normal_slots)) {
           // echo 'Inconvenient groups:         <br>';
           // echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;

            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee_id, $sdate, $edate, $customer);

           // $inconvenient_process_obj->print_arrays();
            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
           // $inconvenient_process_obj->print_arrays();
           // echo "<pre>Salary  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            //calculated total salary for each slot category
            $total_sal = $inconvenient_process_obj->calculate_key_based_perhour_salary_asper_day($employee_id);
            //echo "<pre>total_sal ".print_r($total_sal, 1)."</pre>";
            
            if($company_details['salary_system'] == 3){
                //calculate seperate oncall salaries - only for hogia salary type
                $oncall_type_salaries = $inconvenient_process_obj->calculate_oncall_slots_salary_asper_day($employee_id);
               // echo "<pre>oncall_type_salaries".print_r($oncall_type_salaries, 1)."</pre>";
            }
            //calculate additional salary hours for inconvenients and holidays
            $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee_id);
           // echo "<pre>addtion_salaries ".print_r($addtion_salaries, 1)."</pre>";
           // echo "<pre>".print_r($_SESSION, 1)."</pre>";
            if (!empty($addtion_salaries)) {
                if (empty($total_sal['normal_0']) || !isset($total_sal['normal_0'])) {
                    $total_sal['normal_0'] = $addtion_salaries['normal_0'];
                } else {
                    foreach ($addtion_salaries['normal_0'] as $amount => $h_values) {
                        if (!empty($total_sal['normal_0'][$amount])){
                            $total_sal['normal_0'][$amount]['hour'] = $equipment->time_sum($total_sal['normal_0'][$amount]['hour'], $h_values['hour']);
                        }else
                            $total_sal['normal_0'][$amount]['hour'] = $h_values['hour'];
                    }
                }
            }
            
            //Additionally calculating 1/4th of Jour helg and Jour vardag (to display a row just below of 'Semestersättn dag 2-14' row) 
            $semestersattn_jour_dag_2_14_sal_hours = array();
           //echo "<pre>sal_hours  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            if(!empty($inconvenient_process_obj->salary_hours)){
                //filtering Jour helg and Jour vardag hours
                foreach($inconvenient_process_obj->salary_hours as $this_date => $sl_hours){
                    foreach($sl_hours as $this_type => $this_hours){
                        if(is_array($this_hours)){   
                            foreach ($this_hours as $sub_item => $sub_hours) {
                                if((stripos(strtolower($this_type), 'jour') !== FALSE || 
                                        stripos(strtolower($this_type), 'Vänte') !== FALSE || 
                                        stripos(strtolower($this_type), 'Vänt') !== FALSE || $sub_item  == 3)&& $sub_hours != 0){
                                    if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                        $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $sub_hours);
                                    else
                                        $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $sub_hours;
                                }
                            }
                        } else {
                           // if(($this_type == 'Jour helg' || $this_type == 'Jour vardag') && $this_hours != 0){
                            if((stripos(strtolower($this_type), 'jour') !== FALSE || 
                                        stripos(strtolower($this_type), 'Vänte') !== FALSE || 
                                        stripos(strtolower($this_type), 'Vänt') !== FALSE) && $this_hours != 0){
                                if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $this_hours);
                                else
                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $this_hours;
                            }
                        }
                    }
                }
               // echo "<pre>jour_helg_vardag_splitting_sal_hours  ".print_r($semestersattn_jour_dag_2_14_sal_hours, 1)."</pre>";
                
                if(!empty($semestersattn_jour_dag_2_14_sal_hours)){
                    foreach ($semestersattn_jour_dag_2_14_sal_hours as $date => $params) {
                        $calc_salary = $inconvenient_process_obj->get_salary($date, $employee_id, 'normal');
                        if(!empty($semestersattn_jour_dag_2_14_salaries[$calc_salary]) || isset($semestersattn_jour_dag_2_14_salaries[$calc_salary]))
                            $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'], $params['hours']);
                        else
                            $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $params['hours'];
                    }
                   // echo "<pre>jour_helg_vardag_splitting_salaries  ".print_r($semestersattn_jour_dag_2_14_salaries, 1)."</pre>";
                }
            }
            
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
           // $total_sal = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }

        return array('inconv_details'               => $total_sal, 
            'semestersattn_jour_dag_2_14_salaries'  => $semestersattn_jour_dag_2_14_salaries,
            'oncall_type_salaries'                  => $oncall_type_salaries);
    }


    function get_employee_inconv_leaved_works_between_two_dates_copy($employee_id, $customer, $sdate, $edate, $except_id = NULL, $company_details = array()) {

        /**
         * Author: Shamsu
         * for: Salary report calculation TEST 
         * to refer origial : get_employee_inconv_leaved_works_between_two_dates()
         */
        // $except_id = NULL;
        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();
        $inconv_normal_slots = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee_id, $customer, $except_id);
       // echo "<pre>".print_r($inconv_normal_slots, 1)."</pre>";
        $total_sal = $semestersattn_jour_dag_2_14_salaries = $oncall_type_salaries = array();
        if (!empty($inconv_normal_slots)) {
           // echo 'Inconvenient groups:         <br>';
           // echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;

            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee_id, $sdate, $edate, $customer);

           // $inconvenient_process_obj->print_arrays();
            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
           // $inconvenient_process_obj->print_arrays();
           // echo "<pre>Salary  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            //calculated total salary for each slot category
            $total_sal = $inconvenient_process_obj->calculate_key_based_perhour_salary_asper_day($employee_id);
           // echo "<pre>total_sal ".print_r($total_sal, 1)."</pre>";
            
            if($company_details['salary_system'] == 3){
                //calculate seperate oncall salaries - only for hogia salary type
                $oncall_type_salaries = $inconvenient_process_obj->calculate_oncall_slots_salary_asper_day($employee_id);
               // echo "<pre>oncall_type_salaries".print_r($oncall_type_salaries, 1)."</pre>";
            }
            //calculate additional salary hours for inconvenients and holidays
            $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee_id);
           // echo "<pre>addtion_salaries ".print_r($addtion_salaries, 1)."</pre>";
           // echo "<pre>".print_r($_SESSION, 1)."</pre>";
            if (!empty($addtion_salaries)) {
                if (empty($total_sal['normal_0']) || !isset($total_sal['normal_0'])) {
                    $total_sal['normal_0'] = $addtion_salaries['normal_0'];
                } else {
                    foreach ($addtion_salaries['normal_0'] as $amount => $h_values) {
                        if (!empty($total_sal['normal_0'][$amount])){
                            $total_sal['normal_0'][$amount]['hour'] = $equipment->time_sum($total_sal['normal_0'][$amount]['hour'], $h_values['hour']);
                        }else
                            $total_sal['normal_0'][$amount]['hour'] = $h_values['hour'];
                    }
                }
            }
            
            //Additionally calculating 1/4th of Jour helg and Jour vardag (to display a row just below of 'Semestersättn dag 2-14' row) 
            $semestersattn_jour_dag_2_14_sal_hours = array();
           // echo "<pre>sal_hours  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            if(!empty($inconvenient_process_obj->salary_hours)){
                //filtering Jour helg and Jour vardag hours
                foreach($inconvenient_process_obj->salary_hours as $this_date => $sl_hours){
                    foreach($sl_hours as $this_type => $this_hours){
                        if(is_array($this_hours)){   
                            foreach ($this_hours as $sub_item => $sub_hours) {
                                if(stripos(strtolower($this_type), 'jour') !== FALSE && $sub_hours != 0){
                                    if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                        $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $sub_hours);
                                    else
                                        $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $sub_hours;
                                }
                            }
                        } else {
                           // if(($this_type == 'Jour helg' || $this_type == 'Jour vardag') && $this_hours != 0){
                            if(stripos(strtolower($this_type), 'jour') !== FALSE && $this_hours != 0){
                                if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $this_hours);
                                else
                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $this_hours;
                            }
                        }
                    }
                }
               // echo "<pre>jour_helg_vardag_splitting_sal_hours  ".print_r($semestersattn_jour_dag_2_14_sal_hours, 1)."</pre>";
                
                if(!empty($semestersattn_jour_dag_2_14_sal_hours)){
                    foreach ($semestersattn_jour_dag_2_14_sal_hours as $date => $params) {
                        $calc_salary = $inconvenient_process_obj->get_salary($date, $employee_id, 'normal');
                        if(!empty($semestersattn_jour_dag_2_14_salaries[$calc_salary]) || isset($semestersattn_jour_dag_2_14_salaries[$calc_salary]))
                            $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'], $params['hours']);
                        else
                            $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $params['hours'];
                    }
                   // echo "<pre>jour_helg_vardag_splitting_salaries  ".print_r($semestersattn_jour_dag_2_14_salaries, 1)."</pre>";
                }
            }
            
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
           // $total_sal = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }
       // echo "<pre>Inc ".print_r($inconv_normal_slots, 1)."</pre>";
       // echo "<pre>Sal ".print_r($total_sal, 1)."</pre>";
        return array('inconv_details' => $total_sal, 
            'semestersattn_jour_dag_2_14_salaries' => $semestersattn_jour_dag_2_14_salaries,
            'oncall_type_salaries' => $oncall_type_salaries);
    }

    //deprecated
    function get_employee_inconv_leaved_works_between_two_dates($employee_id, $customer, $sdate, $edate) {

        
       // $employee = new employee();
       // $equipment = new equipment();
        $inconvenient_process_obj = new inconvenient();
        $inconv_normal_slots = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee_id, $customer);
        $total_sal = array();
        if (!empty($inconv_normal_slots)) {
           // echo 'Inconvenient groups:         <br>';
           // echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;

            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee_id, $sdate, $edate, $customer);

            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();

            //calculated total salary for each slot category
            $categorize_salary = $inconvenient_process_obj->calculate_key_based_salary($employee_id);

            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
            $total_sal = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }
        return $total_sal;
    }

    function get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($work_data, $company_details = array()) {
        /**
         * Author: Shamsu
         * for: TEST for salary calculation
         */
        $inconvenient_process_obj   = new inconvenient();
        $equipment                  = new equipment();
        $inconv_normal_slots        = $work_data;
        $total_salaries = $semestersattn_jour_dag_2_14_salaries = $oncall_type_salaries = array();

        if (!empty($inconv_normal_slots)) {

            $sdate      = $work_data[0]['date'];
            $edate      = $work_data[count($work_data) - 1]['date'];
            $employee   = $work_data[0]['employee_id'];
            $customer   = $work_data[0]['customer'];

           // echo 'Inconvenient groups:         <br>';
           // echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;

            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $sdate, $edate, $customer);

            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
            //echo "<pre>salary_hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            //$inconvenient_process_obj->print_arrays();
            //$inconvenient_process_obj->print_arrays(FALSE, FALSE);
            //echo "<pre>Calculated: ".print_r($inconvenient_process_obj->sub_keys_normal, 1)."</pre>";
            //calculated total salary for each slot category
            $total_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary_asper_day($employee, FALSE);
           //echo "<pre>Calculated: ".print_r($total_salaries, 1)."</pre>";
            
            if($company_details['salary_system'] == 3){
                //calculate seperate oncall salaries - only for hogia salary type
                $oncall_type_salaries = $inconvenient_process_obj->calculate_oncall_slots_salary_asper_day($employee);
               // echo "<pre>oncall_type_salaries".print_r($oncall_type_salaries, 1)."</pre>";
            }
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
           // $total_salaries = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
            //calculate additional salary hours for inconvenients and holidays
            $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee, FALSE);
            //echo "<pre>Total salary: ".print_r($total_salaries, 1)."</pre>";
            //echo "<pre>Additional: ".print_r($addtion_salaries, 1)."</pre>";
            if (!empty($addtion_salaries)) {
                foreach ($addtion_salaries as $key => $entries) {
                    foreach ($entries as $amount => $h_values) {
                        if (!empty($total_salaries[$key][$amount]))
                            $total_salaries[$key][$amount]['hour'] = $equipment->time_sum($total_salaries[$key][$amount]['hour'], $h_values['hour']);
                        else
                            $total_salaries[$key][$amount]['hour'] = $h_values['hour'];
                    }
                }
            }
            
            
            //Additionally calculating 1/4th of Jour helg and Jour vardag (to display a row just below of 'Semestersättn dag 2-14' row) 
            $semestersattn_jour_dag_2_14_sal_hours = array();
           // echo "<pre>sal_hours  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            if(!empty($inconvenient_process_obj->salary_hours)){
                //filtering Jour helg and Jour vardag hours
                foreach($inconvenient_process_obj->salary_hours as $this_date => $sl_hours){
                    foreach($sl_hours as $this_type => $this_hours){
                        
                        if(is_array($this_hours)){   
                            foreach ($this_hours as $sub_item => $sub_hours) {
                                if(stripos(strtolower($this_type), 'jour') !== FALSE && $sub_hours != 0){
                                    if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                        $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $sub_hours);
                                    else
                                        $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $sub_hours;
                                }
                            }
                        }
                        else {
                            if(stripos(strtolower($this_type), 'jour') !== FALSE && $this_hours != 0){
                                if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $this_hours);
                                else
                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $this_hours;
                            }
                        }
                    }
                }
               // echo "<pre>jour_helg_vardag_splitting_sal_hours  ".print_r($semestersattn_jour_dag_2_14_sal_hours, 1)."</pre>";
                
                if(!empty($semestersattn_jour_dag_2_14_sal_hours)){
                    foreach ($semestersattn_jour_dag_2_14_sal_hours as $date => $params) {
                        $calc_salary = $inconvenient_process_obj->get_salary($date, $inconv_normal_slots[0]['employee_id'], 'normal');
                        if(!empty($semestersattn_jour_dag_2_14_salaries[$calc_salary]) || isset($semestersattn_jour_dag_2_14_salaries[$calc_salary]))
                            $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'], $params['hours']);
                        else
                            $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $params['hours'];
                    }
                   // echo "<pre>jour_helg_vardag_splitting_salaries  ".print_r($semestersattn_jour_dag_2_14_salaries, 1)."</pre>";
                }
            }
        }
       // echo "<pre>Result salary".print_r($total_salaries, 1)."</pre>-----";
        //return $total_salaries;
       // echo "total_salaries<pre>".print_r($total_salaries, 1)."</pre>";
        return array('inconv_details'               => $total_salaries, 
            'semestersattn_jour_dag_2_14_salaries'  => $semestersattn_jour_dag_2_14_salaries,
            'oncall_type_salaries'                  => $oncall_type_salaries);
    }

    //deprecated
    function get_employee_inconv_leaved_works_between_two_dates_for_vikarie($work_data) {

        $inconvenient_process_obj = new inconvenient();
        $inconv_normal_slots = array($work_data);
        $total_salaries = array();
        if (!empty($inconv_normal_slots)) {
           // echo 'Inconvenient groups:         <br>';
           // echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;

            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($work_data['employee_id'], $work_data['date'], $work_data['date'], $work_data['customer']);

            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();

            //calculated total salary for each slot category
            $categorize_salary = $inconvenient_process_obj->calculate_key_based_salary($work_data['employee_id']);

            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
            $total_salaries = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }
       // echo "<pre>".print_r($total_salaries, 1)."</pre>";
        return $total_salaries;
    }
    
    function get_employee_leaved_works_sum_between_two_dates($employee_id, $customer, $sdate, $edate, $except_id = NULL) {

        /**
         * Author: Shamsu
         * for: Salary report calculation TEST 
         * to refer origial : get_employee_inconv_leaved_works_between_two_dates()
         */
        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();
        $normal_slot_types = array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12, 15);
        $oncall_slot_types = array(3, 9, 13, 14);
                
        $leave_slots = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee_id, $customer, $except_id);
       // echo "<pre>Inc ".print_r($leave_slots, 1)."</pre>";
        
        
        $leave_normal_sum = $leave_oncall_sum = $leave_total_sum = array();
        if(!empty($leave_slots)){
            foreach($leave_slots as $leave_slot){
                // $this_slot_hour_60 = $equipment->time_user_format($leave_slot['time_to'] - $leave_slot['time_from']);
                $this_slot_hour_60 = $equipment->time_difference($leave_slot['time_to'], $leave_slot['time_from']);
                $this_day_normal_salary = $inconvenient_process_obj->get_salary($leave_slot['date'], $employee_id, 'normal');
                if(in_array($leave_slot['type'], $normal_slot_types)){
                    $leave_normal_sum[$this_day_normal_salary] = (isset($leave_normal_sum[$this_day_normal_salary]) ? $equipment->time_sum($leave_normal_sum[$this_day_normal_salary], $this_slot_hour_60) : $this_slot_hour_60);
                    // $leave_total_sum[$this_day_normal_salary] = (isset($leave_total_sum[$this_day_normal_salary]) ? $equipment->time_sum($leave_total_sum[$this_day_normal_salary], $this_slot_hour_60) : $this_slot_hour_60);
                }else if(in_array($leave_slot['type'], $oncall_slot_types)){
                    // echo '<pre>'.print_r($leave_slot, 1).'</pre>';
                    $leave_oncall_sum[$this_day_normal_salary] = (isset($leave_oncall_sum[$this_day_normal_salary]) ? $equipment->time_sum($leave_oncall_sum[$this_day_normal_salary], $this_slot_hour_60) : $this_slot_hour_60);
                    // $this_slot_hour_100 = $equipment->time_user_format($this_slot_hour_60, 100);
                    // $quarter_of_slot_hour = round($this_slot_hour_100 / 4,2);
                    // $quarter_of_slot_hour_60 = $equipment->time_user_format($quarter_of_slot_hour, 60);
                    // $leave_total_sum[$this_day_normal_salary] = (isset($leave_total_sum[$this_day_normal_salary]) ? $equipment->time_sum($leave_total_sum[$this_day_normal_salary], ($this_slot_hour_60 / 4)) : ($this_slot_hour_60/4));
                    // $leave_total_sum[$this_day_normal_salary] = (isset($leave_total_sum[$this_day_normal_salary]) ? $equipment->time_sum($leave_total_sum[$this_day_normal_salary], ($quarter_of_slot_hour_60)) : ($quarter_of_slot_hour_60));
                }
                
            }
        }
        /*if(!empty($leave_total_sum)){
            foreach($leave_total_sum as $key => $leave_sum){
                $leave_total_sum[$key] = round($leave_sum, 2);
            }
        }*/
        if(!empty($leave_normal_sum)){
            foreach($leave_normal_sum as $key => $leave_sum){
                $oncall_sum = isset($leave_oncall_sum[$key]) ? $leave_oncall_sum[$key] : 0.00;
                if($oncall_sum > 0){
                    $oncall_sum_100 = $equipment->time_user_format($oncall_sum, 100);
                    $quarter_of_oncall_sum = round($oncall_sum_100 / 4,2);
                    $quarter_of_oncall_sum_60 = $equipment->time_user_format($quarter_of_oncall_sum, 60);
                    $leave_sum = $equipment->time_sum($leave_sum, $quarter_of_oncall_sum_60);
                }
                $leave_total_sum[$key] = round($leave_sum, 2);
            }
        }
        if(!empty($leave_oncall_sum)){
            foreach($leave_oncall_sum as $key => $leave_sum){
                if(in_array($key, array_keys($leave_normal_sum))) continue;
                if($leave_sum > 0){
                    $oncall_sum_100 = $equipment->time_user_format($leave_sum, 100);
                    $quarter_of_oncall_sum = round($oncall_sum_100 / 4,2);
                    $quarter_of_oncall_sum_60 = $equipment->time_user_format($quarter_of_oncall_sum, 60);
                    $leave_sum = $quarter_of_oncall_sum_60;
                }
                $leave_total_sum[$key] = round($leave_sum, 2);
            }
        }
       // $total_hours = round($leave_normal_sum + ($leave_oncall_sum / 4), 2);
        return array('leave_normal_sum' => $leave_normal_sum, 
            'leave_oncall_sum' => $leave_oncall_sum,
            'leave_total_sum' => $leave_total_sum);
    }
    
    function get_employee_timetable_leaved_work_details_by_date($work_data) {
        /**
         * Author: Shamsu
         * for: calculate total leave hours
         * this function used in salary payment calculation (LSS Report)
         * assing max value 8 to qualifying-total, remaining split into exceed-normal & exceed-oncall (related to slot type)
         * return array(total_time, qualifying_total_time, exceeded_normal_time, exceeded_oncall_time)
         */
        $equipment = new equipment();
        $qualifying_tot_time = 0;
        $exceeded_normal_time = 0;
        $exceeded_oncall_time = 0;
        $grand_total_time = 0;
        $qualifying_tot_amount = 0;
        $exceeded_normal_amount = 0;
        $exceeded_oncall_amount = 0;
        $grand_total_amount = 0;
        $date = $work_data['date'];
       // $this_month = date('m',strtotime($date));
       // $this_year = date('Y',strtotime($date));
        $customer = $work_data['customer'];
        $employee = $work_data['employee'];

        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to', 'date', 'type', 'status');
        $this->conditions = array('AND', 'date = ?', 'status = 2', 'customer = ?', 'employee = ?');
        $this->condition_values = array($date, $customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();

       // echo "<pre>work_data: ".print_r($work_data, 1)."</pre>";
       // echo "<pre>Exceeded: ".print_r($data, 1)."</pre>";
        if ($data) {
            $inconvenient_process_obj = new inconvenient();
            $qualify_exceed_flag = FALSE;
            $data_count = count($data);
            for ($i = 0; $i < $data_count; $i++) {
                $inconvenient_process_obj->reset_inconvenient_variables();
                $inconvenient_process_obj->inconv_normal_slots = array($data[$i]);
                $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date'], $customer);
                $inconvenient_process_obj->categorize_salary_hours();
                $total_sal = $inconvenient_process_obj->calculate_total_salary($employee);
                $grand_total_amount += $total_sal;
               // echo 'Employee: '. $employee."<br>";
               // echo 'total salary: '. $total_sal."<br>";
               // $tot_time = $equipment->time_sum($tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                $grand_total_time = $equipment->time_sum($grand_total_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                //grand total only for calculating total hours

                if ($time_sum >= 8.00 && !$qualify_exceed_flag) {
                    $qualify_exceed_flag = TRUE;
                    $amount_to_complete_8 = $equipment->time_difference($time_sum, $qualifying_tot_time);
                    $this_time_diff = $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']);
                    $per_hour_sal = $total_sal / $this_time_diff;
                    $qualifying_tot_time = 8.00;
                    $qualifying_tot_amount += ($amount_to_complete_8 * $per_hour_sal);
                    if ($time_sum > 8.00) {
                        $balance_time = $equipment->time_difference($time_sum, 8.00);
                        if ($data[$i]['type'] == 3) {
                            $exceeded_oncall_time = $balance_time;
                            $exceeded_oncall_amount += ($balance_time * $per_hour_sal);
                        } else {
                            $exceeded_normal_time = $balance_time;
                            $exceeded_normal_amount += ($balance_time * $per_hour_sal);
                        }
                    }
                    continue;
                }
                if ($qualify_exceed_flag) {
                    if ($data[$i]['type'] == 3) {  //oncall
                        $exceeded_oncall_time = $equipment->time_sum($exceeded_oncall_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                        $exceeded_oncall_amount += $total_sal;
                    } else {
                        $exceeded_normal_time = $equipment->time_sum($exceeded_normal_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                        $exceeded_normal_amount += $total_sal;
                    }
                } else {
                    $qualifying_tot_time = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                    $qualifying_tot_amount += $total_sal;
                }
                //$qualifying_tot_time += $equipment->time_difference($data[$i]['time_from'], $data[$i]['time_to']);
            }
        }
        $return_array = array(
            'grand_total_time' => $grand_total_time,
            'qualifying_total_time' => $qualifying_tot_time,
            'exceeded_normal_total_time' => $exceeded_normal_time,
            'exceeded_oncall_total_time' => $exceeded_oncall_time,
            'grand_total_amount' => $grand_total_amount,
            'qualifying_tot_amount' => $qualifying_tot_amount,
            'exceeded_normal_amount' => $exceeded_normal_amount,
            'exceeded_oncall_amount' => $exceeded_oncall_amount
        );
        return $return_array;
    }

    function get_employee_timetable_leaved_work_details_by_date_copy($work_data, $this_qday_exceeded_karense = array()) {
        /** TESTING
         * refer original version: get_employee_timetable_leaved_work_details_by_date()
         * @author: Shamsu
         * @for:    calculate total leave hours
         *          this function used in salary payment calculation (LSS Report)
         *          adding max value 8 to qualifying-total, remaining split into exceed-normal & exceed-oncall (related to slot type)
         * @return array(total_time, qualifying_total_time, exceeded_normal_time, exceeded_oncall_time)
         */
        $equipment = new equipment();
        $qualifying_tot_time = 0;
        $grand_total_time = 0;
        $qualifying_tot_time_cur_customer = 0;
        $grand_total_time_cur_customer = 0;
        $semestersattn_jour_dag_2_14_salaries = array();
       // echo "<pre>".print_r($work_data, 1)."</pre>";
       // echo "<pre>".print_r($this_qday_exceeded_karense, 1)."</pre>";
        $date = $work_data['date'];
        $customer = $work_data['customer'];
        $employee = $work_data['employee'];
        $this->tables = array('timetable` as `t', 'leave` as `l');
        $this->fields = array('t.id', 't.time_from', 't.time_to', 't.date', 't.customer', 't.type', 't.status');
        // $this->conditions = array('AND', 't.date = ?', 't.status = 2', 't.customer = ?', 't.employee = ?',
        //         'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        // $this->condition_values = array($date, $customer, $employee);
        $this->conditions = array('AND', 't.date = ?', 't.status = 2', 't.employee = ?',
                'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($date, $employee);
        $this->order_by = array('t.time_from');
        $this->query_generate();
        $data = $this->query_fetch();
        
        if(!empty($this_qday_exceeded_karense))
            $data = array_merge($data, array($this_qday_exceeded_karense));
        
       // echo "<pre>".print_r($data, 1)."</pre>";
        if ($data) {
            $inconvenient_process_obj = new inconvenient();
            $qualify_exceed_flag = FALSE;
            $data_count = count($data);
            $normal_salary = $inconvenient_process_obj->get_salary($data[0]['date'], $employee, 'normal');
            $exceeded_salaries = array();
            $exceeded_salaries_additional = array();
            for ($i = 0; $i < $data_count; $i++) {
               // echo "************************<pre>$i. data: ".print_r($data[$i], 1)."</pre>";
                if($data[$i]['customer'] == $this->leave_customer){
                    $inconvenient_process_obj->reset_inconvenient_variables();
                    $inconvenient_process_obj->inconv_normal_slots = array($data[$i]);
                    // $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date'], $customer);
                    $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date'], $data[$i]['customer']);
                    $inconvenient_process_obj->categorize_salary_hours();
                   // echo "<pre>Salary hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                }
                
                $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                $grand_total_time = $equipment->time_sum($grand_total_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                //grand total only for calculating total hours
                if($data[$i]['customer'] == $this->leave_customer){
                    $grand_total_time_cur_customer = $equipment->time_sum($grand_total_time_cur_customer, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                }

                if ($grand_total_time >= 8.00 && !$qualify_exceed_flag && $data[$i]['customer'] == $this->leave_customer) {
                    $qualifying_tot_time_cur_customer =  8.00;
                }
                if ($time_sum >= 8.00 && !$qualify_exceed_flag) {
                    $qualify_exceed_flag = TRUE;
                    $qualifying_tot_time = 8.00;
                    if ($time_sum > 8.00 && $data[$i]['customer'] == $this->leave_customer) {
                        $balance_time = $equipment->time_difference($time_sum, 8.00);
                        $time_array = explode('.', $balance_time);
                        $new_time_from = date('H.i', strtotime('-' . $time_array[0] . ' hours - ' . $time_array[1] . ' mins', strtotime($data[$i]['time_to'])));
                        $new_data = array('id' => $data[$i]['id'],
                            'time_from' => $new_time_from,
                            'time_to' => $data[$i]['time_to'],
                            'date' => $data[$i]['date'],
                            'type' => $data[$i]['type'],
                            'status' => $data[$i]['status']);
                       // echo "<pre>new_data : ".print_r($new_data, 1)."</pre>";
                        $inconvenient_process_obj->reset_inconvenient_variables();
                        $inconvenient_process_obj->inconv_normal_slots = array($new_data);
                        // $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date'], $customer);
                        $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date'], $data[$i]['customer']);
                        $inconvenient_process_obj->categorize_salary_hours();
                        $exceeded_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee);
                        $exceeded_salaries_additional = $inconvenient_process_obj->get_addition_salary_hours($employee);
                       // $inconvenient_process_obj->print_arrays();
                       // echo "<pre>''''''exceeded_salaries".print_r($exceeded_salaries, 1)."</pre>";
                       // echo "<pre>''''''exceeded_salaries_additional".print_r($exceeded_salaries_additional, 1)."</pre>";
                       // echo "<pre>Inner Salary hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                        
                        //calculating 1/4th of all jour hours (to display a row just below of 'Semestersättn dag 2-14' row) 
                        $semestersattn_jour_dag_2_14_sal_hours = array();
                       // echo "<pre>sal_hours  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                        if(!empty($inconvenient_process_obj->salary_hours)){
                            foreach($inconvenient_process_obj->salary_hours as $this_date => $sl_hours){
                                foreach($sl_hours as $this_type => $this_hours){
                                    if(is_array($this_hours)){   
                                        foreach ($this_hours as $sub_item => $sub_hours) {
                                            if(stripos(strtolower($this_type), 'jour') !== FALSE && $sub_hours != 0){
                                                if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $sub_hours);
                                                else
                                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $sub_hours;
                                            }
                                        }
                                    }
                                    else{
                                        if(stripos(strtolower($this_type), 'jour') !== FALSE && $this_hours != 0){
                                            if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                                $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $this_hours);
                                            else
                                                $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $this_hours;
                                        }
                                    }
                                }
                            }
                           // echo "<pre>jour_helg_vardag_splitting_sal_hours  ".print_r($semestersattn_jour_dag_2_14_sal_hours, 1)."</pre>";

                            if(!empty($semestersattn_jour_dag_2_14_sal_hours)){
                                foreach ($semestersattn_jour_dag_2_14_sal_hours as $sal_date => $params) {
                                    $calc_salary = $inconvenient_process_obj->get_salary($sal_date, $employee, 'normal');
                                    if(!empty($semestersattn_jour_dag_2_14_salaries[$calc_salary]) || isset($semestersattn_jour_dag_2_14_salaries[$calc_salary]))
                                        $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'], $params['hours']);
                                    else
                                        $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $params['hours'];
                                }
                               // echo "<pre>jour_helg_vardag_splitting_salaries  ".print_r($semestersattn_jour_dag_2_14_salaries, 1)."</pre>";
                            }
                        }
                    }
                   // echo 'qualify_time: '.$qualifying_tot_time;
                   // echo "<pre>Inner Salary hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                   // echo "<pre>exceeded: ".print_r($exceeded_salaries, 1)."</pre>";
                    continue;
                }
                if ($qualify_exceed_flag) {
                    if($data[$i]['customer'] == $this->leave_customer){
                        $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee);
                       // echo "<pre>sal hours : ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                       // echo "<pre>new sal: ".print_r($new_salaries, 1)."</pre>";
                        
                        //calculating 1/4th of all jour hours (to display a row just below of 'Semestersättn dag 2-14' row) 
                        $semestersattn_jour_dag_2_14_sal_hours = array();
                       // echo "<pre>sal_hours  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                        if(!empty($inconvenient_process_obj->salary_hours)){
                            foreach($inconvenient_process_obj->salary_hours as $this_date => $sl_hours){
                                foreach($sl_hours as $this_type => $this_hours){
                                    if(is_array($this_hours)){   
                                        foreach ($this_hours as $sub_item => $sub_hours) {
                                            if(stripos(strtolower($this_type), 'jour') !== FALSE && $sub_hours != 0){
                                                if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $sub_hours);
                                                else
                                                    $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $sub_hours;
                                            }
                                        }
                                    }
                                    else{
                                        if(stripos(strtolower($this_type), 'jour') !== FALSE && $this_hours != 0){
                                            if(!empty($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']) || isset($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours']))
                                                $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'], $this_hours);
                                            else
                                                $semestersattn_jour_dag_2_14_sal_hours[$this_date]['hours'] = $this_hours;
                                        }
                                    }
                                }
                            }
                           // echo "<pre>jour_helg_vardag_splitting_sal_hours  ".print_r($semestersattn_jour_dag_2_14_sal_hours, 1)."</pre>";

                            if(!empty($semestersattn_jour_dag_2_14_sal_hours)){
                                foreach ($semestersattn_jour_dag_2_14_sal_hours as $sal_date => $params) {
                                    $calc_salary = $inconvenient_process_obj->get_salary($sal_date, $employee, 'normal');
                                    if(!empty($semestersattn_jour_dag_2_14_salaries[$calc_salary]) || isset($semestersattn_jour_dag_2_14_salaries[$calc_salary]))
                                        $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $equipment->time_sum($semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'], $params['hours']);
                                    else
                                        $semestersattn_jour_dag_2_14_salaries[$calc_salary]['hours'] = $params['hours'];
                                }
                               // echo "<pre>jour_helg_vardag_splitting_salaries  ".print_r($semestersattn_jour_dag_2_14_salaries, 1)."</pre>";
                            }
                        }
                       // echo "<pre>exceeded_salaries: ".print_r($exceeded_salaries, 1)."</pre>";
                        //---------------------------------------
                        if (!empty($new_salaries) && !empty($exceeded_salaries)) {    //check already exist the salary key
                            foreach ($new_salaries as $salary_key => $values) {
                                $flag = 0;
                                foreach ($exceeded_salaries as $ex_salary_key => $ex_val) {
                                    if ($ex_salary_key == $salary_key) {
                                        $flag = 1;
                                        break;
                                    }
                                }
                               // if(in_array($salary_key, $exceeded_salaries)){
                                if ($flag == 1) {
                                    $exceeded_salaries[$salary_key]['hour'] = $equipment->time_sum($exceeded_salaries[$salary_key]['hour'], $values['hour']);
                                    $exceeded_salaries[$salary_key]['amount'] = $exceeded_salaries[$salary_key]['amount'] != 0.00 ? $exceeded_salaries[$salary_key]['amount'] : $values['amount'];
                                } else {
                                    $exceeded_salaries[$salary_key] = $values;
                                }
                            }
                        } else if (!empty($new_salaries)) {
                            $exceeded_salaries = $new_salaries;
                        }
                        
                           // echo "<pre>exceeded_salaries: ".print_r($exceeded_salaries, 1)."</pre>";
                           // echo "<pre>Inner Salary hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                        
                        $new_exceeded_salaries_additional = $inconvenient_process_obj->get_addition_salary_hours($employee);
                        if (!empty($new_exceeded_salaries_additional)) {
                            foreach ($new_exceeded_salaries_additional as $key => $entries) {
                                foreach ($entries as $amount => $h_values) {
                                    if (!empty($exceeded_salaries_additional[$key][$amount]))
                                       // $exceeded_salaries_additional[$key]['hour'] = $equipment->time_sum($exceeded_salaries_additional[$key]['hour'], $h_values['hour']);
                                        $exceeded_salaries_additional[$key][$amount]['hour'] = $equipment->time_sum($exceeded_salaries_additional[$key][$amount]['hour'], $h_values['hour']);
                                    else {
                                       // $exceeded_salaries_additional[$key]['amount'] = $amount;
                                       // $exceeded_salaries_additional[$key]['hour'] = $h_values['hour'];
                                        $exceeded_salaries_additional[$key][$amount]['hour'] = $h_values['hour'];
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $qualifying_tot_time = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                    if($data[$i]['customer'] == $this->leave_customer){
                        $qualifying_tot_time_cur_customer = $equipment->time_sum($qualifying_tot_time_cur_customer, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                    }
                }
               // echo 'qualify_time: '.$qualifying_tot_time;
               // echo "<pre>///////////////exceeded: ".print_r($exceeded_salaries_additional, 1)."</pre>";
            }
        }
        $return_array = array(
            // 'grand_total_time' => $grand_total_time,
            // 'qualifying_total_time' => $qualifying_tot_time,
            'grand_total_time' => $grand_total_time_cur_customer,
            'qualifying_total_time' => $qualifying_tot_time_cur_customer,
            'nomal_salary_amount' => $normal_salary,
            'exceeded_salaries' => $exceeded_salaries,
            'exceeded_salaries_additional' => $exceeded_salaries_additional,
            'semestersattn_jour_dag_2_14_salaries' => $semestersattn_jour_dag_2_14_salaries
        );
       // echo "-------------------<pre>return_array".print_r($return_array, 1)."</pre>";
        return $return_array;
    }

    function process_qualifying_day_hours_copy($work_data) {
        /**
         * Author: Shamsu
         * for: calculate total qualifying hours for vikaries
         * used for salary calculation in sick report
         * for refer original: process_qualifying_day_hours()
         * this function used in salary payment calculation (LSS Report)
         */

        $additional_qualify = array();
        $qualifying_group   = array();
        $qualifying_tot_time= 0;

        if(!empty($work_data)){
            $equipment          = new equipment();
            $inconvenient_process_obj = new inconvenient();

            $sdate      = $work_data[0]['date'];
            $edate      = $work_data[count($work_data) - 1]['date'];
            $employee   = $work_data[0]['employee_id'];
            $customer   = $work_data[0]['customer'];
           // $normal_salary = $inconvenient_process_obj->get_salary($date, $employee, 'normal');

            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $work_data;
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $sdate, $edate, $customer);
            $inconvenient_process_obj->categorize_salary_hours();
            $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
           // $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee,FALSE);
           // echo "<pre>new_salaries: ".print_r($new_salaries, 1)."</pre>";
           // echo "<pre>addtion_salaries: ".print_r($addtion_salaries, 1)."</pre>===================";

            foreach($work_data as $w)
                $qualifying_tot_time = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($w['time_to'], $w['time_from']));

           // echo "<pre>Full Salary Hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            $new_salaries       = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
            $addtion_salaries   = $inconvenient_process_obj->get_addition_salary_hours($employee, FALSE);

            if (!empty($addtion_salaries)) {
                foreach ($addtion_salaries as $key => $entries) {
                    foreach ($entries as $amount => $h_values) {
                        if (!empty($additional_qualify[$key]))
                            $additional_qualify[$key]['hour'] = $equipment->time_sum($additional_qualify[$key]['hour'], $h_values['hour']);
                        else {
                            $additional_qualify[$key]['amount'] = $amount;
                            $additional_qualify[$key]['hour'] = $h_values['hour'];
                        }
                    }
                }
            }

            if (!empty($new_salaries)) {    //check already exist the salary key
                foreach ($new_salaries as $item => $entries) {
                    if ($entries['hour'] == 0.00) continue;
                    if (in_array($item, array_keys($qualifying_group)))
                        $qualifying_group[$item]['hour'] = $equipment->time_sum($qualifying_group[$item]['hour'], $entries['hour']);
                    else
                        $qualifying_group[$item] = array('hour' => $entries['hour'], 'amount' => $entries['amount']);
                }
            }
        }

        $return_array = array(
            'qualifying_total_time' => $qualifying_tot_time,
            'qualifying_group'      => $qualifying_group,
            'additional_qualify'    => $additional_qualify
        );
       // echo "<pre>Return Array: ".print_r($return_array, 1)."</pre>****************";
        return $return_array;
    }

    function process_qualifying_day_hours($work_data, $output_array = array()) {
        /**
         * Author: Shamsu
         * for: calculate total leave hours
         * this function used in salary payment calculation (LSS Report)
         * assing max value 8 to qualifying-total, remaining split into exceed-normal & exceed-oncall (related to slot type)
         * return array(total_time, qualifying_total_time, exceeded_normal_time, exceeded_oncall_time)
         */
        $equipment = new equipment();
        $inconvenient_process_obj = new inconvenient();
        if (empty($output_array)) {
            $qualifying_tot_time = 0;
            $exceeded_normal_time = 0;
            $exceeded_oncall_time = 0;
            $qualifying_tot_amount = 0;
            $exceeded_normal_amount = 0;
            $exceeded_oncall_amount = 0;
        } else {
            $qualifying_tot_time = $output_array['qualifying_total_time'];
            $exceeded_normal_time = $output_array['exceeded_normal_total_time'];
            $exceeded_oncall_time = $output_array['exceeded_oncall_total_time'];
            $qualifying_tot_amount = $output_array['qualifying_tot_amount'];
            $exceeded_normal_amount = $output_array['exceeded_normal_amount'];
            $exceeded_oncall_amount = $output_array['exceeded_oncall_amount'];
        }
        $date = $work_data['date'];
        $employee = $work_data['employee'];


        $qualify_exceed_flag = FALSE;
        $inconvenient_process_obj->reset_inconvenient_variables();
        $inconvenient_process_obj->inconv_normal_slots = array($work_data);
        $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $date, $date, $work_data['customer']);
        $inconvenient_process_obj->categorize_salary_hours();
        $total_sal = $inconvenient_process_obj->calculate_total_salary($employee);

        $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
        if ($time_sum >= 8.00 && !$qualify_exceed_flag) {
            $qualify_exceed_flag = TRUE;
            $amount_to_complete_8 = $equipment->time_difference($time_sum, $qualifying_tot_time);
            $this_time_diff = $equipment->time_difference($work_data['time_to'], $work_data['time_from']);
            $per_hour_sal = $total_sal / $this_time_diff;
            $qualifying_tot_time = 8.00;
            $qualifying_tot_amount += ($amount_to_complete_8 * $per_hour_sal);
            if ($time_sum > 8.00) {
                $balance_time = $equipment->time_difference($time_sum, 8.00);
                if ($work_data['type'] == 3) {
                    $exceeded_oncall_time = $balance_time;
                    $exceeded_oncall_amount += ($balance_time * $per_hour_sal);
                } else {
                    $exceeded_normal_time = $balance_time;
                    $exceeded_normal_amount += ($balance_time * $per_hour_sal);
                }
            }
        }
        if ($qualify_exceed_flag) {
            if ($work_data['type'] == 3) {  //oncall
                $exceeded_oncall_time = $equipment->time_sum($exceeded_oncall_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
                $exceeded_oncall_amount += $total_sal;
            } else {
                $exceeded_normal_time = $equipment->time_sum($exceeded_normal_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
                $exceeded_normal_amount += $total_sal;
            }
        } else {
            $qualifying_tot_time = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
            $qualifying_tot_amount += $total_sal;
        }
        $return_array = array(
            'qualifying_total_time' => $qualifying_tot_time,
            'exceeded_normal_total_time' => $exceeded_normal_time,
            'exceeded_oncall_total_time' => $exceeded_oncall_time,
            'qualifying_tot_amount' => $qualifying_tot_amount,
            'exceeded_normal_amount' => $exceeded_normal_amount,
            'exceeded_oncall_amount' => $exceeded_oncall_amount
        );
        return $return_array;
    }

    function get_employee_timetable_leaved_work_details_by_between_2_date($employee, $customer, $date1, $date2, $norm_or_call = Null) {

        $equipment = new equipment();
        $tot_time = 0;
        $types = '';
        if ($norm_or_call == 1)          //normal, travel , break
            $types = '\'0,1,2\'';
        else if ($norm_or_call == 2)     //break
            $types = '\'3\'';

        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'status = 2', 'customer = ?', 'employee = ?', array('IN', 'type', $types));
        $this->condition_values = array($date1, $date2, $customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
               // $time_from= $data[$i]['time_from'];
               // $time_to= $data[$i]['time_to'];
                $tot_time += $equipment->time_difference($data[$i]['time_from'], $data[$i]['time_to']);
            }
        }
        return $tot_time;
    }

    function get_employee_timetable_leaved_work_details_by_between_2_date_for_vikarie($employee, $customer, $date1, $date2, $norm_or_call = Null) {

        $equipment = new equipment();
        $tot_time = 0;
        $types = '';
        if ($norm_or_call == 1)          //normal, travel , break
            $types = '\'0,1,2\'';
        else if ($norm_or_call == 2)     //break
            $types = '\'3\'';
        else if ($norm_or_call == 3)     //all
            $types = '\'0,1,2,3\'';

        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'status = 1', 'customer = ?', 'employee = ?', array('IN', 'type', $types));
        $this->condition_values = array($date1, $date2, $customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $tot_time += $equipment->time_difference($data[$i]['time_from'], $data[$i]['time_to']);
            }
        }
        return $tot_time;
    }

    function get_employee_leaved_timetable_works($employee, $year, $month, $customer = NULL, $excluded_slot_types = array()) {

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_employee_leaved_timetable_works_process($employee, $year, $month, $customer, 1, $excluded_slot_types);
            $query_2_action = $this->get_employee_leaved_timetable_works_process($employee, $year, $month, $customer, 2, $excluded_slot_types);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from, time_to';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_employee_leaved_timetable_works_process($employee, $year, $month, $customer, 2, $excluded_slot_types);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_employee_leaved_timetable_works_process($employee, $year, $month, $customer, 1, $excluded_slot_types);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_employee_leaved_timetable_works_process($employee, $year, $month, $customer = NULL, $mode = 1, $excluded_slot_types = array()) {

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
            't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
        $this->conditions = array('AND', 'month(t.date) = ?', 'year(t.date) = ?', 't.status = 2', 't.employee = ?',
            'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to', 'l.status = 1');
        $this->condition_values = array($month, $year, $employee);
        
        if($customer !== NULL){
            $this->conditions[] = 't.customer = ?';
            $this->condition_values[] = $customer;
        }
        if(!empty($excluded_slot_types)){
            $not_in_types = implode(',', $excluded_slot_types);
            $this->conditions[] = array('NOT IN', 't.type', $not_in_types);
        }
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        // $data = $this->query_fetch();
        // return $data;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }
    
    function get_employee_leaved_timetable_works_between_dates($employee, $sdate, $edate, $customer = NULL) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $this->flush();
        if($sdate <= $boundary_date && $edate > $boundary_date){

            $this->tables = array('timetable` as `t', 'leave` as `l');
            $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
                't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
            $this->conditions = array('AND', array('BETWEEN', 't.date', '"'.$boundary_date.'"', '"'. $edate.'"'), 't.status = 2', 't.employee = "'.$employee.'"',
                'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
            // $this->condition_values = array($boundary_date, $edate, $employee);
            
            if($customer !== NULL){
                $this->conditions[] = 't.customer = ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('t.date', 't.time_from', 't.time_to');
            $this->query_generate();
            $real_table_data = $this->sql_query;
            
            // $this->conditions = array();
            // $this->condition_values = array();

           $this->tables = array('backup_timetable` as `bt', 'backup_leave` as `bl');
           $this->fields = array('bt.id as id', 'bt.employee as employee', 'bt.customer as customer', 'bt.date as date', 'bt.fkkn as fkkn',
                'bt.time_from as time_from', 'bt.time_to as time_to', 'bt.type as type', 'bt.status as status', 'bl.no_pay as no_pay');
            $this->conditions = array('AND', array('BETWEEN', 'bt.date', '"'.$sdate.'"', '"'.$boundary_date.'"'), 'bt.status = 2', 'bt.employee = "'.$employee.'"',
                'bl.type = 1', 'bt.employee like bl.employee', 'bt.date = bl.date', 'bl.time_from <= bt.time_from', 'bl.time_to >= bt.time_to');
            // $this->condition_values = array($sdate, $boundary_date, $employee);
            
            if($customer !== NULL){
                $this->conditions[] = 'bt.customer = ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('bt.date', 'bt.time_from', 'bt.time_to');
            $this->query_generate();
            $backup_table_data = $this->sql_query;


            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;

        }

        else if($sdate <= $boundary_date && $edate <= $boundary_date){
            $this->tables = array('backup_timetable` as `t', 'backup_leave` as `l');
            $proceed = TRUE;
        }
        else if($sdate > $boundary_date && $edate > $boundary_date){
            $this->tables = array('timetable` as `t', 'leave` as `l');
            $proceed = TRUE;
        }
        if($proceed == TRUE){ 
            $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
                't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
            $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 2', 't.employee = ?',
                'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
            $this->condition_values = array($sdate, $edate, $employee);
            
            if($customer !== NULL){
                $this->conditions[] = 't.customer = ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('t.date', 't.time_from', 't.time_to');
            $this->query_generate();
        }
        $data = $this->query_fetch();
        return $data;
    }

    function get_employee_vab_details_timetable_works_between_dates($employee, $sdate, $edate, $customer = NULL) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        if($sdate <= $boundary_date && $edate > $boundary_date){
            $this->tables = array('timetable` as `t', 'leave` as `l');
            $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
                't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
            $this->conditions = array('AND', array('BETWEEN', 't.date', '"'.$boundary_date.'"', '"'.$edate.'"'), 't.status = 2', 't.employee = "'.$employee.'"',
                'l.type = 3', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
            if($customer !== NULL){
                $this->conditions[] = 't.customer = ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('t.date', 't.time_from', 't.time_to');
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $this->tables = array('backup_timetable` as `t', 'backup_leave` as `l');
            $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
                't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
            $this->conditions = array('AND', array('BETWEEN', 't.date', '"'.$sdate.'"', '"'.$boundary_date.'"'), 't.status = 2', 't.employee = "'.$employee.'"',
                'l.type = 3', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
            
            if($customer !== NULL){
                $this->conditions[] = 't.customer = ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('t.date', 't.time_from', 't.time_to');
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;


        }
        else if($sdate <= $boundary_date && $edate <= $boundary_date){
            $this->tables = array('backup_timetable` as `t', 'backup_leave` as `l');
            $proceed = TRUE;
        }
        else if($sdate > $boundary_date && $edate > $boundary_date){
            $this->tables = array('timetable` as `t', 'leave` as `l');
            $proceed = TRUE;
        }
        if($proceed == TRUE){
            $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
                't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
            $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 2', 't.employee = ?',
                'l.type = 3', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
            $this->condition_values = array($sdate, $edate, $employee);
            
            if($customer !== NULL){
                $this->conditions[] = 't.customer = ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('t.date', 't.time_from', 't.time_to');
            $this->query_generate(); 
        }
        
        $data = $this->query_fetch();
        return $data;
    }
    function get_employee_leaved_timetable_works_before_the_date($employee, $date, $time_from = '') {

        $this->tables = array('timetable` as `t', 'leave` as `l');
        $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
            't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
        $this->conditions = array('AND', 't.date < ?'/*array('OR', 't.date < ?', array('AND', 't.date = ?', 't.time_to < ?'))*/, 't.status = 2', 't.employee = ?',
            'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($date, /*$date, $time_from,*/ $employee);
        
        $this->order_by = array('t.date desc', 't.time_to desc');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function get_employee_leave_Qualifying_day_works_using_input_before_leaves($leave_works, $emp, $fromdate) {

        $q_days = array();
        $q_days_dates = array();
        $date_diff_for_qlfying = 5;
        $additional_overlaped_day_karenses = array();
        $total_leave_works_count = count($leave_works);
        
        $get_previous_month = date('Y-m-d', strtotime($fromdate . ' -10 days'));
        $previous_date_digit = explode('-', $get_previous_month);
        $previous_month_leave_works = $this->get_employee_leaved_timetable_works_before_the_date($emp, $fromdate);
        $previous_month_last_work_date = '';
        if (!empty($previous_month_leave_works)) {
            $previous_month_last_work_date = $previous_month_leave_works[0]['date'];
        } else {
            $previous_month_last_work_date = $previous_date_digit[0] . '-' . $previous_date_digit[1] . '-01';
        }
        if ($leave_works && $previous_month_last_work_date != '') {
            $datefrom = strtotime($previous_month_last_work_date, 0);
            $dateto = strtotime($leave_works[0]['date'], 0);
            $difference = floor(($dateto - $datefrom) / 86400);
            //$datediff = floor($difference / 86400);

            if ($difference > $date_diff_for_qlfying && $leave_works[0]['no_pay'] == 1){
                $q_days[] = $leave_works[0];
                $q_days_dates[] = $leave_works[0]['date'];
                
                //check if karense day slot enters next day
                if($total_leave_works_count > 1){
                    if(date('Y-m-d', strtotime('+1 day', strtotime($leave_works[0]['date']))) == $leave_works[1]['date'] && $leave_works[0]['time_to'] == 24.00 && $leave_works[1]['time_from'] == 0.00 && $leave_works[1]['no_pay'] == 1){
                        $additional_overlaped_day_karenses[$leave_works[0]['date']] = $leave_works[1];
                    }
                }
            }
        }
        for ($i = 0; $i < $total_leave_works_count; $i++) {
            if ($i == 0)
                //$i++;
                continue;
            //$q_days[] = $leave_works[0];
            else if ($i > 0) {
                $datefrom = strtotime($leave_works[$i - 1]['date'], 0);
                $dateto = strtotime($leave_works[$i]['date'], 0);
                $difference = floor(($dateto - $datefrom) / 86400);
                if ($difference > $date_diff_for_qlfying && $leave_works[$i]['no_pay'] == 1){
                    $q_days[] = $leave_works[$i];
                    $q_days_dates[] = $leave_works[$i]['date'];
                    
                    /*//check if karense day slot enters next day
                    if($i+1 != $total_leave_works_count){
                        if(date('Y-m-d', strtotime('+1 day', strtotime($leave_works[$i]['date']))) == $leave_works[$i+1]['date'] && $leave_works[$i]['time_to'] == 24.00 && $leave_works[$i+1]['time_from'] == 0.00  && $leave_works[$i+1]['no_pay'] == 1){
                            $additional_overlaped_day_karenses[$leave_works[$i]['date']] = $leave_works[$i+1];
                        }
                    }*/
                }
                
                if (in_array($leave_works[$i]['date'], $q_days_dates) && $leave_works[$i]['no_pay'] == 1){
                    //check if karense day slot enters next day
                    if($i+1 != $total_leave_works_count){
                        if(date('Y-m-d', strtotime('+1 day', strtotime($leave_works[$i]['date']))) == $leave_works[$i+1]['date'] && $leave_works[$i]['time_to'] == 24.00 && $leave_works[$i+1]['time_from'] == 0.00  && $leave_works[$i+1]['no_pay'] == 1){
                            $additional_overlaped_day_karenses[$leave_works[$i]['date']] = $leave_works[$i+1];
                        }
                    }
                }
            }
        }
        return array('Qualifying_days' => $q_days, 'ovarlaped_karenses' => $additional_overlaped_day_karenses);
    }

    function Employee_info_pdf($emp) {

        require_once ('plugins/customize_pdf_employee_info.class.php');
        $skills = $this->get_employee_skills($emp);
        $employee = new employee();
        $emp_details = $employee->employee_detail('\'' . $emp . '\'');
        //print_r($emp_details);
        $pdf = new PDF_Emp_info();
        ///////////////////////////////////////////page 1///////////////////////////////////////////////
        $pdf->AddPage();

        $pdf->P1_top($emp_details[0]);
        $pdf->P1_table_2($emp_details[0]);
        $pdf->P1_table_3($skills);

        $pdf->Output();
    }

    function get_employee_contract_details($employee = Null, $id = Null, $customer = Null) {
        $this->tables = array('employee_contract');
        $this->fields = array('employee', 'date_from', 'customer_name', 'customer_social_secutrity', 'have_been_agreed', 'tmp_long_assistance_from', 'tmp_long_assistance_to', 'tmp_assistance_for',
            'absence_from', 'absence_to', 'special_appointment', 'probationary_from', 'probationary_to', 'open_ended_appointment', 'prevailing_collective',
            'fulltime', 'part_time', 'salary_month', 'salary_hour', 'incl_salary', 'excl_salary', 'incl_wages', 'act_salary', 'bank_account', 'leave_per_year',
            'incl_holiday_pay', 'excl_holiday_pay', 'incl_salary_compensation', 'special_condition', 'notes', 'alloc_employee', 'alloc_date', 'sign_date',
            'assistanceChecked', 'other_customer', 'employmentType');
        $this->conditions = array('AND', 'employee = ?', 'id = ?');
        $this->condition_values = array($employee, $id);
        $this->order_by = array('date_from desc');
        $this->limit = 0;
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_skills($employee = Null) {
        $this->tables = array('employee_skill');
        $this->fields = array('skill', 'description');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->order_by = array('id');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    
    function get_employee_sick_summary_between_2_dates($sdate, $edate, $employee) {
        //$sdate = '2012-07-09'; $edate = '2012-09-09';
        
        $this->tables = array('timetable` as `t', 'leave` as `l');
        $this->fields = array(/*'t.id', 't.time_from', 't.time_to', 't.date', 't.type', 't.status', */'t.customer', 't.fkkn','ROUND(SUM(time_to_sec(timediff(time(replace(cast(t.time_to as char),\'.\',\':\')) , time(replace(cast(t.time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.employee = ?', 't.status = 2', 'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($sdate, $edate, $employee);
        if($except_id != NULL) {
            $this->conditions[] = 't.id != ?';
            $this->condition_values[] = $except_id;
        }
        $this->group_by = array('customer', 'fkkn');
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        $customer_data = array();
        foreach ($datas as $data){
            $customer_data[$data['customer']]['customer'] = $data['customer'];
            if(!array_key_exists('total_time', $customer_data[$data['customer']])){
                $customer_data[$data['customer']]['total_time'] = 0;
            }
            if($data['fkkn'] == 1)
                $customer_data[$data['customer']]['fk'] = $data['total_time'];
            elseif($data['fkkn'] == 2)
                $customer_data[$data['customer']]['kn'] = $data['total_time'];
            elseif($data['fkkn'] == 3)    
                $customer_data[$data['customer']]['tu'] = $data['total_time'];
            $customer_data[$data['customer']]['total_time'] += $data['total_time'];
        }
        //echo "<pre>". print_r($datas, 1)."</pre>";
        return $customer_data;
    }
    

    function get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee, $customer, $except_id = NULL) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = $sdate;
        $todate = $edate;
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport_process($sdate, $edate, $employee, $customer, $except_id, 1);
            $query_2_action = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport_process($sdate, $edate, $employee, $customer, $except_id, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport_process($sdate, $edate, $employee, $customer, $except_id, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport_process($sdate, $edate, $employee, $customer, $except_id, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport_process($sdate, $edate, $employee, $customer, $except_id = NULL, $mode = 1) {
        
        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id', 't.time_from', 't.time_to', 't.date', 't.type', 't.status');
        $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.employee = ?', 't.status = 2', 't.customer = ?', 
            'l.type = 1', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($sdate, $edate, $employee, $customer);
        if($except_id != NULL) {
            $this->conditions[] = 't.id != ?';
            $this->condition_values[] = $except_id;
        }
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
        // $datas = $this->query_fetch();
        // return $datas;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_distinct_inconvenient_details_between_2_dates_for_vikarie_leaveReport($work_data, $sdate, $edate) {

        $employee = $work_data['employee_id'];
        $customer = $work_data['customer'];

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'root_id=0');
        $this->condition_values = array($sdate, $sdate, $edate);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        $i = 0;

        $normal = array();
        foreach ($datas as $data) {
            $d = explode(',', $data['days']);
            $days = array();
            $j = 0;
            $week_days = '';
            foreach ($d as $day) {
                if ($j == 0) {
                    $week_days = '\'';
                }
                if ($day) {
                    if ($j != 0)
                        $week_days .= ',\'';
                    $week_days .= ($day % 7) . '\'';
                    $j++;
                }
            }

            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'status = 1', 'relation_id = ?', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                    array('AND', 'time_to > ?', 'time_to <= ?'),
                    array('AND', 'time_from <= ?', 'time_to >= ?'))
            );

            $this->condition_values = array($sdate, $edate, $employee, $customer, $work_data['relation_id'],
                (float) $data['time_from'], (float) $data['time_to'],
                (float) $data['time_from'], (float) $data['time_to'],
                (float) $data['time_from'], (float) $data['time_to']
            );
            $this->query_generate();
            //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
            if (count($this->query_fetch())) {
                $normal[$i] = $data;

                $i++;
            } else {
                $this->tables = array('inconvenient_timing');
                $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
                $this->conditions = array('root_id=?');
                $this->condition_values = array($data['id']);
                $this->query_generate();
                $datas_cont = $this->query_fetch();
                foreach ($datas_cont as $data_cont) {
                    $d = explode(',', $data_cont['days']);
                    $j = 0;
                    $week_days = '';
                    foreach ($d as $day) {
                        if ($j == 0) {
                            $week_days = '\'';
                        }
                        if ($day) {
                            if ($j != 0)
                                $week_days .= ',\'';
                            $week_days .= ($day % 7) . '\'';
                            $j++;
                        }
                    }

                    $this->tables = array('timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'status = 1', 'relation_id = ?', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $this->condition_values = array($sdate, $edate, $employee, $customer, $work_data['relation_id'],
                        (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                        (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                        (float) $data_cont['time_from'], (float) $data_cont['time_to']
                    );
                    $this->query_generate();
                    //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
                    if (count($this->query_fetch())) {
                        $normal[$i] = $data;

                        $i++;
                        break;
                    }
                }
            }
        }

        return $normal;
    }

    function get_distinct_inconvenient_details_between_2_dates_for_leaveReport($employee, $customer, $sdate, $edate) {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'time_from', 'time_to', 'days', 'type');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'root_id=0');
        $this->condition_values = array($sdate, $sdate, $edate);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        $i = 0;

        $normal = array();
        foreach ($datas as $data) {
            $d = explode(',', $data['days']);
            $days = array();
            $j = 0;
            $week_days = '';
            foreach ($d as $day) {
                if ($j == 0) {
                    $week_days = '\'';
                }
                if ($day) {
                    if ($j != 0)
                        $week_days .= ',\'';
                    $week_days .= ($day % 7) . '\'';
                    $j++;
                }
            }

            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'status = 2', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                    array('AND', 'time_to > ?', 'time_to <= ?'),
                    array('AND', 'time_from <= ?', 'time_to >= ?'))
            );

            $this->condition_values = array($sdate, $edate, $employee, $customer,
                (float) $data['time_from'], (float) $data['time_to'],
                (float) $data['time_from'], (float) $data['time_to'],
                (float) $data['time_from'], (float) $data['time_to']
            );
            $this->query_generate();
            //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
            if (count($this->query_fetch())) {
                $normal[$i] = $data;

                $i++;
            } else {
                $this->tables = array('inconvenient_timing');
                $this->fields = array('id', 'name', 'time_from', 'time_to', 'days', 'type');
                $this->conditions = array('root_id=?');
                $this->condition_values = array($data['id']);
                $this->query_generate();
                $datas_cont = $this->query_fetch();
                foreach ($datas_cont as $data_cont) {
                    $d = explode(',', $data_cont['days']);
                    $j = 0;
                    $week_days = '';
                    foreach ($d as $day) {
                        if ($j == 0) {
                            $week_days = '\'';
                        }
                        if ($day) {
                            if ($j != 0)
                                $week_days .= ',\'';
                            $week_days .= ($day % 7) . '\'';
                            $j++;
                        }
                    }

                    $this->tables = array('timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'status = 2', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $this->condition_values = array($sdate, $edate, $employee, $customer,
                        (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                        (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                        (float) $data_cont['time_from'], (float) $data_cont['time_to']
                    );
                    $this->query_generate();
                    //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
                    if (count($this->query_fetch())) {
                        $normal[$i] = $data;

                        $i++;
                        break;
                    }
                }
            }
        }

        return $normal;
    }

    function get_employee_distinct_inconvenient_details_between_2_dates_for_workReport($employee = "", $customer, $sdate, $edate, $type) {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'time_from', 'time_to', 'days', 'type');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'root_id=0');
        $this->condition_values = array($sdate, $sdate, $edate);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        $i = 0;
        $new_array = array();
        $normal = array();
        foreach ($datas as $data) {
            $d = explode(',', $data['days']);
            $days = array();
            $j = 0;
            $week_days = '';
            foreach ($d as $day) {
                if ($j == 0) {
                    $week_days = '\'';
                }
                if ($day) {
                    if ($j != 0)
                        $week_days .= ',\'';
                    $week_days .= ($day % 7) . '\'';
                    $j++;
                }
            }

            $this->tables = array('timetable');
            $this->fields = array('id', 'employee', 'customer', 'time_from', 'time_to', 'date');
            if ($employee != '') {

                $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'fkkn = ?', 'status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                    array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                        array('AND', 'time_to > ?', 'time_to <= ?'),
                        array('AND', 'time_from <= ?', 'time_to >= ?'))
                );

                $this->condition_values = array($sdate, $edate, $employee, $customer, $type,
                    (float) $data['time_from'], (float) $data['time_to'],
                    (float) $data['time_from'], (float) $data['time_to'],
                    (float) $data['time_from'], (float) $data['time_to']
                );
            } else {

                $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'customer = ?', 'fkkn = ?', 'status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                    array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                        array('AND', 'time_to > ?', 'time_to <= ?'),
                        array('AND', 'time_from <= ?', 'time_to >= ?'))
                );

                $this->condition_values = array($sdate, $edate, $customer, $type,
                    (float) $data['time_from'], (float) $data['time_to'],
                    (float) $data['time_from'], (float) $data['time_to'],
                    (float) $data['time_from'], (float) $data['time_to']
                );
            }
            $this->query_generate();
            $cnt2 = $this->query_fetch();
            //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
            if (count($cnt2)) {
                $normal[$i] = $data;
                //$new_array[] = $cnt;
                $i++;
            } else {
                $this->tables = array('inconvenient_timing');
                $this->fields = array('id', 'name', 'time_from', 'time_to', 'days', 'type');
                $this->conditions = array('root_id=?');
                $this->condition_values = array($data['id']);
                $this->query_generate();
                $datas_cont = $this->query_fetch();
                foreach ($datas_cont as $data_cont) {
                    $d = explode(',', $data_cont['days']);
                    $j = 0;
                    $week_days = '';
                    foreach ($d as $day) {
                        if ($j == 0) {
                            $week_days = '\'';
                        }
                        if ($day) {
                            if ($j != 0)
                                $week_days .= ',\'';
                            $week_days .= ($day % 7) . '\'';
                            $j++;
                        }
                    }

                    $this->tables = array('timetable');
                    $this->fields = array('id', 'employee', 'customer', 'time_from', 'time_to', 'date');

                    if ($employee != '') {

                        $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'fkkn = ?', 'status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                            array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                array('AND', 'time_to > ?', 'time_to <= ?'),
                                array('AND', 'time_from <= ?', 'time_to >= ?'))
                        );

                        $this->condition_values = array($sdate, $edate, $employee, $customer, $type,
                            (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                            (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                            (float) $data_cont['time_from'], (float) $data_cont['time_to']
                        );
                    } else {

                        $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'customer = ?', 'fkkn = ?', 'status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                            array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                array('AND', 'time_to > ?', 'time_to <= ?'),
                                array('AND', 'time_from <= ?', 'time_to >= ?'))
                        );

                        $this->condition_values = array($sdate, $edate, $customer, $type,
                            (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                            (float) $data_cont['time_from'], (float) $data_cont['time_to'],
                            (float) $data_cont['time_from'], (float) $data_cont['time_to']
                        );
                    }
                    $this->query_generate();
                    //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
                    $cnt = $this->query_fetch();
                    if (count($cnt) > 0) {
                        $normal[$i] = $data;
                        //$new_array[] = $cnt;
                        $i++;
                        break;
                    }
                }
            }
        }

        $total = 0;
        $equipment = new equipment();
        foreach ($normal as $incontime) {
            $total = $equipment->time_sum($total, $equipment->time_difference($incontime['time_to'], $incontime['time_from']));
        }
        return $total;
    }

    /* function get_distinct_oncall_inconvenient_details_by_month_and_year_for_leaveReport($month, $year, $employee) {
      $this->tables = array('inconvenient_timing');
      $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
      $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?')), 'root_id=0', 'type=3');
      $this->condition_values = array($month, $year, $month, $year, $month, $year);
      $this->query_generate();
      //echo $this->sql_query;
      $datas = $this->query_fetch();
      $i = 0;

      $normal = array();
      foreach ($datas as $data) {
      $d = explode(',', $data['days']);
      $days = array();
      $j = 0;
      $week_days = '';
      foreach ($d as $day) {
      if ($j == 0) {
      $week_days = '\'';
      }
      if ($day) {
      if ($j != 0)
      $week_days .= ',\'';
      $week_days .= ($day % 7) . '\'';
      $j++;
      }
      }

      $this->tables = array('timetable');
      $this->fields = array('id');
      $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 2', 'type = 3', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
      array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
      array('AND', 'time_to > ?', 'time_to <= ?'),
      array('AND', 'time_from <= ?', 'time_to >= ?'))
      );

      $this->condition_values = array($month, $year, $employee,
      $data['time_from'], $data['time_to'],
      $data['time_from'], $data['time_to'],
      $data['time_from'], $data['time_to']
      );
      $this->query_generate();
      //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
      if (count($this->query_fetch())) {
      $normal[$i] = $data;

      $i++;
      } else {
      $this->tables = array('inconvenient_timing');
      $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
      $this->conditions = array('root_id=?');
      $this->condition_values = array($data['id']);
      $this->query_generate();
      $datas_cont = $this->query_fetch();
      foreach ($datas_cont as $data_cont) {
      $d = explode(',', $data_cont['days']);
      $j = 0;
      $week_days = '';
      foreach ($d as $day) {
      if ($j == 0) {
      $week_days = '\'';
      }
      if ($day) {
      if ($j != 0)
      $week_days .= ',\'';
      $week_days .= ($day % 7) . '\'';
      $j++;
      }
      }

      $this->tables = array('timetable');
      $this->fields = array('id');
      $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 2', 'type = 3', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
      array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
      array('AND', 'time_to > ?', 'time_to <= ?'),
      array('AND', 'time_from <= ?', 'time_to >= ?'))
      );

      $this->condition_values = array($month, $year, $employee,
      $data_cont['time_from'], $data_cont['time_to'],
      $data_cont['time_from'], $data_cont['time_to'],
      $data_cont['time_from'], $data_cont['time_to']
      );
      $this->query_generate();
      //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
      if (count($this->query_fetch())) {
      $normal[$i] = $data;

      $i++;
      break;
      }
      }
      }
      }

      return $normal;
      }
      function get_employee_inconv_hours_summery($employee = Null, $customer = Null, $month, $year) {

      $employee = new employee();
      $inconv_normal_category = $employee->get_distinct_normal_inconvenient_details_by_month_and_year($month, $year, $employee);
      $inconv_oncall_category = $employee->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $year, $employee);
      $inconv_normal_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($month, $year, $employee);

      $this->tables = array('timetable');
      $this->fields = array('sum(time_to - time_from)');
      $this->conditions = array('employee = ?');
      $this->condition_values = array($employee);
      $this->order_by = array('id');
      $this->query_generate();
      $datas = $this->query_fetch();
      return $datas;
      } */

    function customer_pdf_report_summery_insert($data, $is_fk_template = TRUE) {
        /**
         * Author: Shamsu
         * for: To create new samsida entry
         */
        $this->tables = array('samsida');
        /*$this->fields = array('month', 'year', 'customer', 'how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hospital',
            'did_u_included_hospitalized_hours', 'hostpitalized_hours', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'sign_date', 'signed_employer_name', 'signed_employer_telephone', 'do_u_hire_asst_provider', 'asst_provider_orgno',
            'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money', 'asst_provider1', 'asst_provider_orgno1', 'asst_provider_ftax1', 'asst_provider2', 'asst_provider_orgno2', 'asst_provider_ftax2',
            'asst_provider3', 'asst_provider_orgno3', 'asst_provider_ftax3', 'do_u_attach_receipt', 'money_left_not_to_purchase2', 'money_left2', 'do_u_live_outside_EEA_country', 'accounting_date_from', 'accounting_date_to',
            'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost', 'salary_OB_period', 'assist_expenses_cost', 'assist_expenses_period', 'training_cost', 'training_period', 'staff_expense_cost', 'staff_expense_period',
            'administration_cost', 'administration_period', 'working_hours_4_customer');
        $this->field_values = array($data['month'], $data['year'], $data['customer'], $data['section_3_choice'], $data['section_3_org_no'], $data['did_u_hostpilized_this_month'], $data['hospital_date_from'], $data['hospital_date_to'], $data['hospital'],
            $data['did_u_included_hospitalized_hours'], $data['hostpitalized_hours'], $data['other_info'], $data['info_annex'], $data['section6_phone'], $data['signature_options'], $data['sign_date'], $data['signed_customer_name'], $data['signed_customer_telephone'], $data['do_u_hire_asst_provider'], $data['asst_provider_orgno'],
            $data['rd_money_left_1'], $data['txt_money_left_1'], $data['is_u_r_ur_asst_provider'], $data['do_u_get_himself_money'], $data['asst_provider1'], $data['asst_provider1_orgno'], $data['asst_provider1_ftax'], $data['asst_provider2'], $data['asst_provider2_orgno'], $data['asst_provider2_ftax'],
            $data['asst_provider3'], $data['asst_provider3_orgno'], $data['asst_provider3_ftax'], $data['attach_receipt'], $data['rd_money_left_2'], $data['txt_money_left_2'], $data['live_out_EEA_country'], $data['acc_date_from'], $data['acc_date_to'],
            $data['excl_ob_cost'], $data['excl_ob_period'], $data['ob_cost'], $data['ob_period'], $data['asst_exp_cost'], $data['asst_exp_period'], $data['training_cost'], $data['training_period'], $data['staff_expense_cost'], $data['staff_expense_period'],
            $data['admin_cost'], $data['admin_period'], $data['working_hours_4_customer']);*/
        $this->fields = array('month', 'year', 'customer', 'how_is_asst_provided', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hostpilized_time_from', 'hostpilized_time_to',
            'hostpilized_date_from2', 'hostpilized_date_to2', 'hostpilized_time_from2', 'hostpilized_time_to2', 'hostpilized_date_from3', 'hostpilized_date_to3', 'hostpilized_time_from3', 'hostpilized_time_to3',
            'did_u_included_hospitalized_hours', 'has_assistance_in_other_activities', 'hostpitalized_hours', 'hostpitalized_hours_oncall', 'hostpitalized_hours_standby', 
            'signed_customer_phno', 'signature_options', 'sign_date', 'signed_employer_name', 'signed_employer_ssn', 'have_money_left_not_to_purchase1', 'money_left1',
            'money_left_not_to_purchase2', 'money_left2', 'accounting_date_from', 'accounting_date_to',
            'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost', 'salary_OB_period', 'assist_expenses_cost', 'assist_expenses_period', 'training_cost', 'training_period', 'staff_expense_cost', 'staff_expense_period',
            'administration_cost', 'administration_period', 'working_hours_4_customer', 'compensation_payback');
        $this->field_values = array($data['month'], $data['year'], $data['customer'], $data['section_3_choice'], $data['did_u_hostpilized_this_month'], $data['hospital_date_from'], $data['hospital_date_to'], $data['hospital_time_from'], $data['hospital_time_to'],
            $data['hospital_date_from2'], $data['hospital_date_to2'], $data['hospital_time_from2'], $data['hospital_time_to2'], $data['hospital_date_from3'], $data['hospital_date_to3'], $data['hospital_time_from3'], $data['hospital_time_to3'],
            $data['did_u_included_hospitalized_hours'], $data['rd_has_assistance_in_other_activities'], $data['hostpitalized_hours'], $data['hostpitalized_hours_oncall'], $data['hostpitalized_hours_standby'], 
            $data['section6_phone'], $data['signature_options'], $data['sign_date'], $data['signed_customer_name'], $data['signed_customer_ssn'], $data['rd_money_left_1'], $data['txt_money_left_1'], 
            $data['rd_money_left_2'], $data['txt_money_left_2'], $data['acc_date_from'], $data['acc_date_to'],
            $data['excl_ob_cost'], $data['excl_ob_period'], $data['ob_cost'], $data['ob_period'], $data['asst_exp_cost'], $data['asst_exp_period'], $data['training_cost'], $data['training_period'], $data['staff_expense_cost'], $data['staff_expense_period'],
            $data['admin_cost'], $data['admin_period'], $data['working_hours_4_customer'], $data['section_9_choice']);

        if(!$is_fk_template){
            $this->fields = array_merge($this->fields, array('have_u_contact_with_assistant_counselors', 'have_received_personal_assistance', 'hired_assistant_date_from', 'hired_assistant_date_to', 'hired_assistant_normal_hours', 'hired_assistant_oncall_hours', 'hired_assistant_standby_hours', 'permission_from_care_inspectorate'));
            $this->field_values = array_merge($this->field_values, array($data['have_u_contact_with_assistant_counselors'], $data['have_received_personal_assistance'], $data['hired_assistant_date_from'], $data['hired_assistant_date_to'], $data['hired_assistant_normal_hours'], $data['hired_assistant_oncall_hours'], $data['hired_assistant_standby_hours'], $data['permission_from_care_inspectorate']));
        }

        return $this->query_insert();
    }

    function customer_pdf_report_summery_update($data, $is_fk_template = TRUE) {
        /**
         * Author: Shamsu
         * for: update existing samsida record
         */
        $this->tables = array('samsida');
        /*$this->fields = array('how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hospital',
            'did_u_included_hospitalized_hours', 'hostpitalized_hours', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'sign_date', 'signed_employer_name', 'signed_employer_telephone', 'do_u_hire_asst_provider', 'asst_provider_orgno',
            'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money', 'asst_provider1', 'asst_provider_orgno1', 'asst_provider_ftax1', 'asst_provider2', 'asst_provider_orgno2', 'asst_provider_ftax2',
            'asst_provider3', 'asst_provider_orgno3', 'asst_provider_ftax3', 'do_u_attach_receipt', 'money_left_not_to_purchase2', 'money_left2', 'do_u_live_outside_EEA_country', 'accounting_date_from', 'accounting_date_to',
            'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost', 'salary_OB_period', 'assist_expenses_cost', 'assist_expenses_period', 'training_cost', 'training_period', 'staff_expense_cost', 'staff_expense_period',
            'administration_cost', 'administration_period', 'working_hours_4_customer');
        $this->field_values = array($data['section_3_choice'], $data['section_3_org_no'], $data['did_u_hostpilized_this_month'], $data['hospital_date_from'], $data['hospital_date_to'], $data['hospital'],
            $data['did_u_included_hospitalized_hours'], $data['hostpitalized_hours'], $data['other_info'], $data['info_annex'], $data['section6_phone'], $data['signature_options'], $data['sign_date'], $data['signed_customer_name'], $data['signed_customer_telephone'], $data['do_u_hire_asst_provider'], $data['asst_provider_orgno'],
            $data['rd_money_left_1'], $data['txt_money_left_1'], $data['is_u_r_ur_asst_provider'], $data['do_u_get_himself_money'], $data['asst_provider1'], $data['asst_provider1_orgno'], $data['asst_provider1_ftax'], $data['asst_provider2'], $data['asst_provider2_orgno'], $data['asst_provider2_ftax'],
            $data['asst_provider3'], $data['asst_provider3_orgno'], $data['asst_provider3_ftax'], $data['attach_receipt'], $data['rd_money_left_2'], $data['txt_money_left_2'], $data['live_out_EEA_country'], $data['acc_date_from'], $data['acc_date_to'],
            $data['excl_ob_cost'], $data['excl_ob_period'], $data['ob_cost'], $data['ob_period'], $data['asst_exp_cost'], $data['asst_exp_period'], $data['training_cost'], $data['training_period'], $data['staff_expense_cost'], $data['staff_expense_period'],
            $data['admin_cost'], $data['admin_period'], $data['working_hours_4_customer']);*/
        $this->fields = array('how_is_asst_provided', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hostpilized_time_from', 'hostpilized_time_to',
            'hostpilized_date_from2', 'hostpilized_date_to2', 'hostpilized_time_from2', 'hostpilized_time_to2', 'hostpilized_date_from3', 'hostpilized_date_to3', 'hostpilized_time_from3', 'hostpilized_time_to3',
            'did_u_included_hospitalized_hours', 'has_assistance_in_other_activities', 'hostpitalized_hours', 'hostpitalized_hours_oncall', 'hostpitalized_hours_standby', 
            'signed_customer_phno', 'signature_options', 'sign_date', 'signed_employer_name', 'signed_employer_ssn', 'have_money_left_not_to_purchase1', 'money_left1',
            'money_left_not_to_purchase2', 'money_left2', 'accounting_date_from', 'accounting_date_to',
            'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost', 'salary_OB_period', 'assist_expenses_cost', 'assist_expenses_period', 'training_cost', 'training_period', 'staff_expense_cost', 'staff_expense_period',
            'administration_cost', 'administration_period', 'working_hours_4_customer', 'compensation_payback');
        $this->field_values = array($data['section_3_choice'], $data['did_u_hostpilized_this_month'], $data['hospital_date_from'], $data['hospital_date_to'], $data['hospital_time_from'], $data['hospital_time_to'],
            $data['hospital_date_from2'], $data['hospital_date_to2'], $data['hospital_time_from2'], $data['hospital_time_to2'], $data['hospital_date_from3'], $data['hospital_date_to3'], $data['hospital_time_from3'], $data['hospital_time_to3'],
            $data['did_u_included_hospitalized_hours'], $data['rd_has_assistance_in_other_activities'], $data['hostpitalized_hours'], $data['hostpitalized_hours_oncall'], $data['hostpitalized_hours_standby'], 
            $data['section6_phone'], $data['signature_options'], $data['sign_date'], $data['signed_customer_name'], $data['signed_customer_ssn'], $data['rd_money_left_1'], $data['txt_money_left_1'], 
            $data['rd_money_left_2'], $data['txt_money_left_2'], $data['acc_date_from'], $data['acc_date_to'],
            $data['excl_ob_cost'], $data['excl_ob_period'], $data['ob_cost'], $data['ob_period'], $data['asst_exp_cost'], $data['asst_exp_period'], $data['training_cost'], $data['training_period'], $data['staff_expense_cost'], $data['staff_expense_period'],
            $data['admin_cost'], $data['admin_period'], $data['working_hours_4_customer'], $data['section_9_choice']);

        if(!$is_fk_template){
            $this->fields = array_merge($this->fields, array('have_u_contact_with_assistant_counselors', 'have_received_personal_assistance', 'hired_assistant_date_from', 'hired_assistant_date_to', 'hired_assistant_normal_hours', 'hired_assistant_oncall_hours', 'hired_assistant_standby_hours', 'permission_from_care_inspectorate'));
            $this->field_values = array_merge($this->field_values, array($data['have_u_contact_with_assistant_counselors'], $data['have_received_personal_assistance'], $data['hired_assistant_date_from'], $data['hired_assistant_date_to'], $data['hired_assistant_normal_hours'], $data['hired_assistant_oncall_hours'], $data['hired_assistant_standby_hours'], $data['permission_from_care_inspectorate']));
        }

        $this->conditions = array('AND', 'customer = ?', 'month = ?', 'year = ?');
        $this->condition_values = array($data['customer'], $data['month'], $data['year']);

        return $this->query_update();
    }

    function get_customer_slots_btwn_dates($customer, $start_date, $end_date, $fkkn = NULL, $output_format = NULL) {

        /**
         * Author: Shamsu
         * for: get active customer slot details between 2 dates
         */
        $this->tables = array('timetable');
        $this->fields = array('employee', 'date', 'time_from', 'time_to', 'fkkn', 'type');
        if ($fkkn == NULL) {
            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1');
            $this->condition_values = array($customer, $start_date, $end_date);
        } else {
            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1', 'fkkn = ?');
            
            $this->condition_values = array($customer, $start_date, $end_date, $fkkn);
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $customer_hours = $this->query_fetch();
        if ($output_format == NULL)
            return $customer_hours;
        else if ($output_format == 'HOURS_SUM') {
            $obj_equipment = new equipment();
            //$total_customer_no_of_hours = 0.00;
            $__this_tot_normal = $__this_tot_oncall = 0;
            if (!empty($customer_hours)) {
                foreach ($customer_hours as $customer_hour) {
                    //$total_customer_no_of_hours = $obj_equipment->time_sum($total_customer_no_of_hours, $obj_equipment->time_difference($customer_hour['time_to'], $customer_hour['time_from']));
                    $time_in_100 = $obj_equipment->time_user_format($obj_equipment->time_difference($customer_hour['time_to'], $customer_hour['time_from']), 100);
                    if (in_array($customer_hour['type'], array(0, 1, 2, 4, 5, 6, 7)))
                       // $__this_tot_normal = $obj_equipment->time_sum($__this_tot_normal, $obj_equipment->time_difference($customer_hour['time_to'], $customer_hour['time_from']));
                        $__this_tot_normal += $time_in_100;
                    else if ($customer_hour['type'] == 3)
                       // $__this_tot_oncall = $obj_equipment->time_sum($__this_tot_oncall, $obj_equipment->time_difference($customer_hour['time_to'], $customer_hour['time_from']));
                        $__this_tot_oncall += $time_in_100;
                }
            }
            //return round($total_customer_no_of_hours);
            return round($__this_tot_normal + ($__this_tot_oncall/4));
        }
    }

    function check_slot_exist($time_from, $time_to, $date, $employee = NULL, $customer = NULL) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', 'time_from = ?', 'time_to = ?', 'date=?', 'status != 2');
        $this->condition_values = array((float) $time_from, (float) $time_to, $date);
        if ($customer == NULL) {
            $this->conditions[] = array('OR', 'customer is null', 'customer = ?');
            $this->condition_values[] = '';
        } else {
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        }
        if ($employee == NULL) {
            $this->conditions[] = array('OR', 'employee is null', 'employee = ?');
            $this->condition_values[] = '';
        } else {
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $employee;
        }
        $this->query_generate();
        $__founded_slots = $this->query_fetch();
        return $__founded_slots;
    }

    /* -------------customer work report-------------- end - shamsu------------------------------ */
    /* -------------customer work report-------------- Niyaz------------------------------ */

    function sign_contract($ids) {
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        // $today = date("Y-m-d H:i:s");
        $today = $dtz->format('Y-m-d H:i:s');
        $this->tables = array("employee_contract");
        $this->fields = array('sign_date');
        $this->field_values = array($today);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        return $this->query_update();
    }

    /* -------------customer work report-------------- Niyaz END------------------------------ */

    function save_fkkn_form_defaults($this_customer, $this_bargaining, $provider_of_pa, $company_cp_name, $company_cp_phone, $agreement_type, $agreement_type2_company, $agreement_type2_orgno, $this_employee = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to save fkkn form values for defaults usage
         */
        $defaults = $this->check_exists_fkkn_form_defaults($this_customer, $this_employee);
        $result = FALSE;
        if (!empty($defaults)) {
            //updation
            $this->tables = array('fkkn_form_defaults');
            $this->fields = array('bargaining_new', 'company_cp_name', 'company_cp_phone', 'provider_of_pa_flag', 'agreement_types_new', 'agreement_type2_company', 'agreement_type2_orgNo');
            $this->field_values = array($this_bargaining, $company_cp_name, $company_cp_phone, $provider_of_pa, $agreement_type, $agreement_type2_company, $agreement_type2_orgno);
            $this->conditions = array('AND', 'customer = ?');
            $this->condition_values = array($this_customer);
            if($this_employee != NULL){
                $this->conditions[] = 'employee = ?';
                $this->condition_values[] = $this_employee;
            }
            else{
                $this->conditions[] = array('OR', 'employee = ?', 'employee IS NULL');
                $this->condition_values[] = '';
            }
            $result = $this->query_update();
        } else {
            //insertion
            $this->tables = array('fkkn_form_defaults');
            $this->fields = array('customer', 'employee', 'bargaining_new', 'company_cp_name', 'company_cp_phone', 'provider_of_pa_flag', 'agreement_types_new', 'agreement_type2_company', 'agreement_type2_orgNo');
            $this->field_values = array($this_customer, $this_employee, $this_bargaining, $company_cp_name, $company_cp_phone, $provider_of_pa, $agreement_type, $agreement_type2_company, $agreement_type2_orgno);
            $result = $this->query_insert();
        }
        return $result;
    }

    function check_exists_fkkn_form_defaults($this_customer, $this_employee = NULL, $if_not_found_get_from_common = FALSE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to check whether customer entry is exist on fkkn-defualts table or not
         */

        $this_employee = $this_employee != '' ? $this_employee : NULL;

        $this->tables = array('fkkn_form_defaults');
        $this->fields = array('id', 'customer', 'employee', 'bargaining_new', 'company_cp_name', 'company_cp_phone', 'provider_of_pa_flag', 'agreement_types_new', 'agreement_type2_company', 'agreement_type2_orgNo', 'employer_role');
        $this->conditions = array('AND', 'customer = ?');
        $this->condition_values = array($this_customer);
        if($this_employee != NULL){
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $this_employee;
        }
        else{
            $this->conditions[] = array('OR', 'employee = ?', 'employee IS NULL');
            $this->condition_values[] = '';
        }
        $this->query_generate();
        $records = $this->query_fetch();
        if(empty($records) && $this_employee != NULL && $if_not_found_get_from_common)
            return $this->check_exists_fkkn_form_defaults($this_customer);
        else
            return $records;
    }

    function save_employer_role_defaults($this_customer, $employer_role) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to save fkkn employer role for defaults usage
         */
        $employer_role = trim($employer_role) != '' ? trim($employer_role) : NULL;
        $result = FALSE;
        if ($employer_role != NULL) {
            $defaults = $this->check_exists_fkkn_form_defaults($this_customer);
            if (!empty($defaults)) {
                //updation
                $this->tables = array('fkkn_form_defaults');
                $this->fields = array('employer_role');
                $this->field_values = array($employer_role);
                $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee IS NULL'));
                $this->condition_values = array($this_customer, '');
                $result = $this->query_update();
            } else {
                //insertion
                $this->tables = array('fkkn_form_defaults');
                $this->fields = array('customer', 'employer_role');
                $this->field_values = array($this_customer, $employer_role);
                $result = $this->query_insert();
            }
        }
        return $result;
    }

    function get_PM_time_slots_for_atl_checking($exist_slot, $keyindex, $time_from = '', $time_to = '', $customer = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 20-10-2013
         * @for: get expected slot types for checking atl warning(slot type = 10)
         */
        $id = $exist_slot[$keyindex]['id'];
        $slot_det = $this->customer_employee_slot_details($id);
        if (empty($slot_det))
            return FALSE;
        $slot_from = $slot_det['time_from'];
        $slot_to = $slot_det['time_to'];

        $total_no_of_exist_slots = count($exist_slot);
        $have_prev_slot = ($total_no_of_exist_slots > 1 && $keyindex > 0 ? TRUE : FALSE);
        $have_forw_slot = ($total_no_of_exist_slots > 1 && $keyindex < $total_no_of_exist_slots - 1 ? TRUE : FALSE);

        $atl_new_slots = array();
        $exception_slots = array();
        $exception_slot_ids = array();
        // adding new slot with new type, status = 1 @ the begin and updating existing slot's time_from
        if ($time_from == $slot_from && $time_to < $slot_to) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $time_to
            );
            $exception_slot_ids[] = $id;
        }

        // updating existing slots with new time_to and relative credentials (like customer, status)
        else if ($time_from == $slot_from && $time_to > $slot_to) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $___time_to = ($have_forw_slot) ? $exist_slot[$keyindex + 1]['time_from'] : $time_to;
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $___time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $slot_det['time_from'],
                'time_to' => $slot_det['time_to']
            );
            $exception_slot_ids[] = $id;
        }

        // updating existing slot's time_to and adding new slot with new type, status 1 @ the end 
        else if ($time_to == $slot_to && $time_from > $slot_from) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $slot_det['time_from'],
                'time_to' => $slot_det['time_to']
            );
            $exception_slot_ids[] = $id;
        }

        // updating existing slots with new time_from and relative credentials (like customer, status)
        else if ($time_to == $slot_to && $time_from < $slot_from) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $___time_from = ($have_prev_slot) ? $slot_det['time_from'] : $time_from;
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $___time_from,
                'time_to' => $time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $slot_det['time_from'],
                'time_to' => $slot_det['time_to']
            );
            $exception_slot_ids[] = $id;
        }

        // updating existing slots with new time_from, time_to and relative credentials (like customer, status)
        else if ($time_from < $slot_from && $time_to > $slot_to) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $___time_from = ($have_prev_slot) ? $slot_det['time_from'] : $time_from;
            $___time_to = ($have_forw_slot) ? $exist_slot[$keyindex + 1]['time_from'] : $time_to;
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $___time_from,
                'time_to' => $___time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $slot_det['time_from'],
                'time_to' => $slot_det['time_to']
            );
            $exception_slot_ids[] = $id;
        }

        // adding new slot with new type, new time_from @ the begin and updating existing slot's time_from
        else if ($time_from < $slot_from && $time_to < $slot_to) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $___time_from = ($have_prev_slot) ? $slot_det['time_from'] : $time_from;
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $___time_from,
                'time_to' => $time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $slot_det['time_from'],
                'time_to' => $time_to
            );
            $exception_slot_ids[] = $id;
        }

        // updating existing slot's time_to and adding new slot with new type, new time_to @ the end 
        else if ($time_from > $slot_from && $time_to > $slot_to) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $___time_to = ($have_forw_slot) ? $exist_slot[$keyindex + 1]['time_from'] : $time_to;
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $___time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $slot_det['time_to']
            );
            $exception_slot_ids[] = $id;
        }

        // if slot adds in between, update exiting with new type and status 1 and adding new 2 slots with previous data
        else if ($time_from > $slot_from && $time_to < $slot_to) {
            $___customer = ($customer != NULL) ? $customer : $slot_det['customer'];
            $atl_new_slots[] = array(
                'customer' => $___customer,
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $time_to
            );
            $exception_slots[] = array(
                'customer' => $slot_det['customer'],
                'employee' => $slot_det['employee'],
                'date' => $slot_det['date'],
                'time_from' => $time_from,
                'time_to' => $time_to
            );
            $exception_slot_ids[] = $id;
        }

        return array('atl_slots' => $atl_new_slots, 'exception_slot_ids' => $exception_slot_ids, 'exception_slots' => $exception_slots);
    }

    // function to get the  common custoemrs for the multiple employees
    function get_mutual_customers_of_multiple_employees($employees) {
        $count_emp = count($employees);
        $no_emp_count = 0;
        for ($i = 0; $i < $count_emp; $i++) {
            if ($employees[$i]['employee'] == '' || $employees[$i]['employee'] == NULL) {
                $no_emp_count++;
            }
            $this->tables = array('team` AS `t', 'customer` AS `c');
            $this->fields = array('t.customer AS username', 'c.first_name', 'c.last_name');
            $this->conditions = array('AND', 't.employee = "' . $employees[$i]['employee'] . '"', 't.customer = c.username');
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $temp_array = array();
                for ($j = 0; $j < count($data); $j++) {
                    $temp_array[] = $data[$j]['username'];
                }
            }
            if ($i == 0) {
                $intersect_array = $temp_array;
            } else {
                $intersect_array = array_intersect($intersect_array, $temp_array);
            }
        }
        if ($no_emp_count == $count_emp) {
            return 1;
        } else {
            $this->tables = array('customer');
            $this->fields = array('username', 'first_name', 'last_name');
            $this->conditions[] = 'OR';
            foreach ($intersect_array AS $inter) {
                $this->conditions[] = 'username = "' . $inter . '"';
                //$this->condition_values[] = $inter;
            }
            $this->query_generate();
            $data1 = $this->query_fetch();
            return $data1;
        }
    }

    function checkATL_monthly($employee, $month, $year) {
        $obj_emp = new employee();
        $company = new company();
        $smarty = new smartySetup(array('messages.xml'),FALSE);
        $company_detail = $company->get_company_detail($_SESSION['company_id']);
        $max_day_hours = $company_detail['max_daily_hour'];
        $min_day_rest = $company_detail['min_daily_rest'];
        $break_time = 24 - $max_day_hours;
        $unconditional_break = 0;
        $week_break = 36;
        $tot_work_hours = 0;
        $atl_flag = 0;
        $output = '';
        $atl_warning_data = array();


        $employe_data = $obj_emp->get_employee_detail($employee);
        $day_time = $obj_emp->get_employee_start_day($employee);
        $day = intval(substr($day_time, 0, 1));
        $time = floatval(substr($day_time, 1));

        $date = $year . "-" . $month . "-01";
        $date_end = date('Y-m-t', strtotime($date . " 24.00"));
        if ($time > 0) {
            $date = date('Y-m-d', strtotime($date . ' -1 day'));
            $date_end = date('Y-m-d', strtotime($date_end . ' +1 day'));
        }

        $day_start = date('Y-m-d H:i:s', strtotime($date . " " . $time . ".0"));
        $day_end = date('Y-m-d H:i:s', strtotime($day_start . ' +1 day'));

        $week_start = date('Y-m-d H:i:s', strtotime(date('o', strtotime($date)) . "W" . date('W', strtotime($date)) . $day) + $time * 60 * 60);
        $week_end = date('Y-m-d H:i:s', strtotime($week_start . ' +7 days'));
        $week_end_month = date('Y-m-d H:i:s', strtotime(date('o', strtotime($date_end)) . "W" . date('W', strtotime($date_end)) . $day) + $time * 60 * 60);
        

        //echo  $day_start."-------".$day_end."-----".$week_start."-----".$week_end."-----".$week_end_month."<br>";

        if (date('N', strtotime($date_end)) > $day || (date('N', strtotime($date_end)) == $day && $time_from > 24))
            $week_end_month = date('Y-m-d H:i:s', strtotime($week_end_month . ' +7 days'));


        $this->tables = array('timetable');
        $this->fields = array('date', 'time_from', 'time_to', 'customer');
        $this->conditions = array('AND', 'employee = ?', 'date >= ?', 'date <= ?', 'status = 1');
        $this->condition_values = array($employee, date('Y-m-d', strtotime($week_start)), date('Y-m-d', strtotime($week_end_month)));
        $this->order_by = array('date', 'time_from');
        $this->query_generate();

        $datas = $this->query_fetch();

        $prev_end_time = strtotime($week_start);
        $prev_end_time_day = strtotime($day_start);
        $interval_day = 0;

        $user_work = 0;
        $carry_forward = 0;
        $tot_work_hours = 0;
        $i = 0;
        $day_law = 1;
        $week_law = 1;
        $day_law_rest = 1;
        $warning_period = '';
        $week_intervals = array();
        $record_week_interval = 0;
        $between = "";
        $customers_involved = array();
        $customers_involved_week = array();

        foreach ($datas as $row_atl) {
            $temp_row_atl = $row_atl;
            if(!in_array($row_atl['customer'], $customers_involved))
                $customers_involved[] = $row_atl['customer'];
            if(!in_array($row_atl['customer'], $customers_involved_week))
                $customers_involved_week[] = $row_atl['customer'];

            while (!empty($temp_row_atl)) {
                unset($temp_row_atl);
                $i++;
                //Find slot slot start and end time
                $start_time = mktime((int) $row_atl['time_from'], bcmul(bcsub($row_atl['time_from'], (int) $row_atl['time_from'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));
                $end_time = mktime((int) $row_atl['time_to'], bcmul(bcsub($row_atl['time_to'], (int) $row_atl['time_to'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));

                //Going to the next weekend
                //echo date('Y-m-d H:i:s', $prev_end_time)."starttime-".date('Y-m-d H:i:s', $start_time)."weekstart-".($week_start)."weekend-".($week_end)."daystart-".($day_start)."dayend-".($day_end)."<br>";

                if ($start_time >= strtotime($week_end)) {
                    if ($day_law == 1 || $week_law == 1) {
                        //echo "week".$week_law."<br>";
                        //echo date('Y-m-d H:i:s', strtotime($week_end))."-".date('Y-m-d H:i:s', $prev_end_time)."<br>";
                        if ((strtotime($week_end) - $prev_end_time_day) > ($unconditional_break * 60 * 60)) {
                            $interval_week = strtotime($week_end) - $prev_end_time;//$prev_end_time_day to $prev_end_time
                            if($interval_week > $record_week_interval){
                                $record_week_interval = $interval_week;
                                $between = date('Y-m-d H:i', $prev_end_time) . " - " . date('Y-m-d H:i', strtotime($week_end));
                            }
                            
                        }
                        if ((strtotime($day_end) - $prev_end_time_day) > ($unconditional_break * 60 * 60)) {
                            $interval_day += strtotime($day_end) - $prev_end_time_day;
                        }else{ 
                            $tot_work_hours += strtotime($day_end) - $prev_end_time_day;
                        }
                        //echo ($interval_week/3600)."<br>";
                        if ((strtotime($day_end) - $prev_end_time_day) >= ($min_day_rest * 60 * 60)) {
                            $day_law_rest = 0;
                        }

                        if ($interval_day >= ($break_time * 60 * 60)) {
                            $day_law = 0;
                        } 
                        if($day_law_rest == 1){
                            $day_law = 1;
                        }
                        if ($interval_week >= $week_break * 60 * 60) {
                            $week_law = 0;
                            
                        }else{
                            $week_intervals[$interval_week/3600] = array('start' => date('Y-m-d H.i',$prev_end_time_day), 'end' => date('Y-m-d H.i',strtotime($week_end)));
                        }
                    }

                    if ($day_law == 1 || $week_law == 1) {


                        $extr_time = 0;

                        if ($day_law == 1) {

                            $extr_time = round(($tot_work_hours - $max_day_hours * 60 * 60) / (60 * 60), 2);
                            $warning_period = date('Y-m-d', strtotime($day_start)) . " - " . date('Y-m-d', strtotime($day_end));

                            if($extr_time > 0){
                                $output = $warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['extra_hour']."&nbsp;". $extr_time."h</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                                if($day_law_rest == 1){
                                    $output .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['atl_rest_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                                }
                            }else{
                                $output = $warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['atl_rest_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                            }
                            if($_SESSION['company_sort_by'] == 1)
                                $employee_name = $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                            elseif($_SESSION['company_sort_by'] == 2)
                                $employee_name = $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                            $atl_warning_data[] = array(
                                'atl_message' => $output,
                                'employee_name' => $employee_name,
                                'exceed_hours' => $extr_time,
                                'rest' => $day_law_rest,
                                'employee' => $employee,
                                'customer' => $row_atl['customer'],
                                'period' => $warning_period,
                                'i' => $i,
                                'inform' => 'd'
                            );
                        }
                        if ($week_law == 1) {
                                       
                            $extr_time = round((129600 - $record_week_interval) / (60 * 60), 2);
                            $warning_period = date('Y-m-d', strtotime($week_start)) . " - " . date('Y-m-d', strtotime($week_end));
                            $output = $warning_period . "(" . $extr_time . "h ".$smarty->translate['between']." ".$between." ) <b>" . $smarty->translate['break_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                            krsort($week_intervals, SORT_NUMERIC);
                            if($_SESSION['company_sort_by'] == 1)
                                $employee_name = $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                            elseif($_SESSION['company_sort_by'] == 2)
                                $employee_name = $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                            $atl_warning_data[] = array(
                                'atl_message' => $output,
                                'employee_name' => $employee_name,
                                'exceed_hours' => $extr_time,
                                'employee' => $employee,
                                'customer' => $row_atl['customer'],
                                'period' => $warning_period,
                                'i' => $i,
                                'inform' => 'w',
                                'intervals' => $week_intervals
                            );
                        }
                    }
                    $day_start = date('Y-m-d H:i:s', strtotime($row_atl['date'] . " " . $time . ".0"));
                    if ($time > (float) $row_atl['time_from'])
                        $day_start = date('Y-m-d H:i:s', strtotime($day_start . ' -1 day'));
                    $day_end = date('Y-m-d H:i:s', strtotime($day_start . ' +1 day'));
                    $week_start = date('Y-m-d H:i:s', strtotime(date('o', strtotime($row_atl['date'])) . "W" . date('W', strtotime($row_atl['date'])) . $day) + $time * 60 * 60);
                    $week_end = date('Y-m-d H:i:s', strtotime($week_start . ' +7 days'));

                    $interval_week = 0;
                    $record_week_interval = 0;
                    $interval_day = 0;
                    $tot_work_hours = 0;
                    $customers_involved = array($row_atl['customer']);
                    $customers_involved_week = array($row_atl['customer']);
                    $day_law = 1;
                    $week_law = 1;
                    $day_law_rest = 1;
                    $prev_end_time = strtotime($week_start);
                    $prev_end_time_day = strtotime($day_start);
                    unset($interval_week);
                }elseif ($start_time >= strtotime($day_end)) {
                    if ($day_law == 1) {

                        if ((strtotime($day_end) - $prev_end_time_day) > ($unconditional_break * 60 * 60)){
                            $interval_day += strtotime($day_end) - $prev_end_time_day;
                        }
                        else{
                            $tot_work_hours += strtotime($day_end) - $prev_end_time_day;
                        }
                        if((strtotime($day_end) - $prev_end_time_day) >= ($min_day_rest*60*60)){
                            $day_law_rest = 0;
                        }
                        if ($interval_day >= ($break_time * 60 * 60)) {
                            $day_law = 0;
                        }
                        if($day_law_rest == 1){
                            $day_law = 1;
                        } 
                        
                    }

                    if ($day_law == 1) {

                        $extr_time = round(($tot_work_hours - $max_day_hours * 60 * 60) / (60 * 60), 2);
                        $warning_period = date('Y-m-d', strtotime($day_start)) . " - " . date('Y-m-d', strtotime($day_end));
                        //echo "<pre>".print_r($customers_involved,1)."</pre>";echo implode(",", $customers_involved);exit();
                        if($extr_time > 0){
                            $output = $warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['extra_hour']."&nbsp". $extr_time."h</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                            if($day_law_rest == 1){
                                $output .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['atl_rest_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                            }
                        }
                        else
                            $output = $warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['atl_rest_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                        if($_SESSION['company_sort_by'] == 1)
                                $employee_name = $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                            elseif($_SESSION['company_sort_by'] == 2)
                                $employee_name = $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                        $atl_warning_data[] = array(
                            'atl_message' => $output,
                            'employee_name' => $employee_name,
                            'exceed_hours' => $extr_time,
                            'employee' => $employee,
                            'customer' => $row_atl['customer'],
                            'period' => $warning_period,
                            'i' => $i,
                            'inform' => 'd'
                        );
                    }

                    $day_start = date('Y-m-d H:i:s', strtotime($row_atl['date'] . " " . $time . ".0"));
                    if ($time > (float) $row_atl['time_from'])
                        $day_start = date('Y-m-d H:i:s', strtotime($day_start . ' -1 day'));
                    $day_end = date('Y-m-d H:i:s', strtotime($day_start . ' +1 day'));

                    $interval_day = 0;
                    $tot_work_hours = 0;
                    $customers_involved = array($row_atl['customer']);
                    $day_law = 1;
                    $day_law_rest = 1;
                    $prev_end_time_day = strtotime($day_start);
                }
                    //echo date('Y-m-d H:i:s', $start_time) . "----" . date('Y-m-d H:i:s', $end_time) . "----" . $week_end . "<br>";
                    //echo date('Y-m-d H:i:s', $start_time)."----".date('Y-m-d H:i:s', $end_time)."----".$day_start."---".$day_end."---".$week_start."---".$week_end."<br>";
                if ($start_time >= strtotime($week_start) || $end_time > strtotime($week_start)) {
                    //echo "<pre>".print_r($row_atl,1)."</pre>";
                    if ($start_time < strtotime($week_start))
                        $start_time = strtotime($week_start);
                    if ($end_time > strtotime($week_end)) {
                        $end_time = strtotime($week_end);
                    }


                    //echo date('Y-m-d H:i:s', $start_time) . "----" . date('Y-m-d H:i:s', $prev_end_time) . "<br>";
                    $interval_week = $start_time - $prev_end_time;
                    if($interval_week > $record_week_interval){
                        $record_week_interval = $interval_week;
                        $between = date('Y-m-d H:i', $prev_end_time) . " - " . date('Y-m-d H:i', $start_time);
                    }
                    
                    //echo ($interval_week/3600)."<br>";
                    if ($interval_week >= $week_break * 60 * 60) {
                        $week_law = 0;           
                            
                    }else{
                        $week_intervals[$interval_week/3600] = array('start' => date('Y-m-d H.i',$prev_end_time), 'end' => date('Y-m-d H.i',$start_time));
                    }

                    //echo date('Y-m-d H:i:s', $prev_end_time_day)."-".date('Y-m-d H:i:s', $start_time)."-".date('Y-m-d H:i:s', $end_time)."<br>";

                    if (($start_time >= strtotime($day_start) && $start_time < strtotime($day_end)) || ($end_time > strtotime($day_start) && $end_time <= strtotime($day_end))) {
                        // echo date('Y-m-d H:i:s', $prev_end_time_day)."-".date('Y-m-d H:i:s', $start_time)."-".date('Y-m-d H:i:s', $end_time)."<br>";
                        // echo $day_law_rest;
                        //echo ($tot_work_hours/3600)."<br>";
                        $start_time_day = mktime((int) $row_atl['time_from'], bcmul(bcsub($row_atl['time_from'], (int) $row_atl['time_from'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));

                        $end_time_day = mktime((int) $row_atl['time_to'], bcmul(bcsub($row_atl['time_to'], (int) $row_atl['time_to'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));




                        if ($start_time_day < strtotime($day_start))
                            $start_time_day = strtotime($day_start);
                        if ($end_time_day > strtotime($day_end)) {
                            //$carry_forward = $end_time_day - strtotime($day_end);
                            $temp_row_atl = array(
                                'date' => date('Y-m-d', strtotime($day_end)),
                                'time_from' => date('H.i', strtotime($day_end)),
                                'time_to' => date('H.i', $end_time_day),
                                'customer' => $row_atl['customer']
                            );

                            //                        $datas = array_merge(array_slice($datas, 0, $i), $temp_array, array_slice($datas, $i));
                            //                        $datas = array_values($datas);
                            //                        $i++;

                            $end_time_day = strtotime($day_end);
                        }

                        //echo date('Y-m-d H:i:s', $prev_end_time_day)."start_time day-".date('Y-m-d H:i:s', $start_time_day)."endtime day-".date('Y-m-d H:i:s', $end_time_day)."<br>";

                        if (($start_time_day - $prev_end_time_day) > ($unconditional_break * 60 * 60))
                            $interval_day += $start_time_day - $prev_end_time_day;
                        else {
                            $user_work = $start_time_day - $prev_end_time_day;
                            $tot_work_hours += $user_work;
                        }
                        if(($start_time_day - $prev_end_time_day) >= ($min_day_rest*60*60)){
                            $day_law_rest =0;
                        }
                        if ($interval_day >= ($break_time * 60 * 60)) {
                            $day_law = 0;
                        }
                        //echo $day_law_rest."<br>";
                        $user_work = $end_time_day - $start_time_day;
                        $tot_work_hours += $user_work;

                        if ($tot_work_hours > $max_day_hours * 60 * 60) {

                            $day_law = 1;
                        }
                        if($day_law_rest == 1){
                            $day_law = 1;
                        }

                        $prev_end_time_day = $end_time_day;
                        $prev_end_time = $end_time_day;
                    }
                }
                $row_atl = $temp_row_atl;
            }
            

        }   
        //echo $week_law."<br>";exit();     
        if ($day_law == 1 || $week_law == 1) {
            //echo date('Y-m-d H:i:s', strtotime($week_end))."-".date('Y-m-d H:i:s', $prev_end_time_day)."<br>";
            if ((strtotime($week_end) - $prev_end_time_day) > ($unconditional_break * 60 * 60)) {
                //echo date('Y-m-d H:i:s', strtotime($week_end))."-".date('Y-m-d H:i:s', $prev_end_time_day)."<br>";
                $interval_day += strtotime($day_end) - $prev_end_time_day;
                $interval_week = strtotime($week_end) - $prev_end_time;////$prev_end_time_day to $prev_end_time
                if($interval_week > $record_week_interval){
                    $record_week_interval = $interval_week;
                    $between = date('Y-m-d H:i', $prev_end_time) . " - " . date('Y-m-d H:i', strtotime($week_end));
                }
                //echo ($interval_week/3600)."<br>";
            }
            //echo ($interval_day/3600)."<br>";
            if((strtotime($day_end) - $prev_end_time_day) >= ($min_day_rest*60*60)){
                $day_law_rest = 0;
            }
            if ($interval_day >= ($break_time * 60 * 60)) {
                $day_law = 0;
            }/* else {
                $tot_work_hours += strtotime($day_end) - $prev_end_time_day;
            }*///commented  by shaju
            if ($interval_week >= $week_break * 60 * 60) {
                $week_law = 0;
            }else{
                $week_intervals[$interval_week/3600] = array('start' => date('Y-m-d H.i',$prev_end_time_day), 'end' => date('Y-m-d H.i',strtotime($week_end)));
            }
            if($day_law_rest == 1){
                $day_law = 1;
            }
        }
        //echo $tot_work_hours/3600;echo "<br>";exit();
        if ($day_law == 1 || $week_law == 1) {


            $extr_time = 0;

            if ($day_law == 1) {
                //echo $tot_work_hours/3600;exit();
                $extr_time = round(($tot_work_hours - $max_day_hours * 60 * 60) / (60 * 60), 2);
                $warning_period = date('Y-m-d', strtotime($day_start)) . " - " . date('Y-m-d H.i', strtotime($day_end));
                if($extr_time > 0){
                    $output = $warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['extra_hour']."&nbsp;".$extr_time."h</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                    if($day_law_rest == 1){
                        $output .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['atl_rest_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                    }
                }else{
                    $output = $warning_period . "&nbsp;&nbsp;&nbsp;<b>" . $smarty->translate['atl_rest_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved).")";
                }

                if($_SESSION['company_sort_by'] == 1)
                    $employee_name = $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                elseif($_SESSION['company_sort_by'] == 2)
                    $employee_name = $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                $atl_warning_data[] = array(
                    'atl_message' => $output,
                    'employee_name' => $employee_name,
                    'exceed_hours' => $extr_time,
                    'rest' => $day_law_rest,
                    'employee' => $employee,
                    'customer' => $row_atl['customer'],
                    'period' => $warning_period,
                    'i' => $i,
                    'inform' => 'd'
                );
            }
            if ($week_law == 1) {
                $extr_time = round((129600 - $record_week_interval) / (60 * 60), 2);
                $warning_period = date('Y-m-d', strtotime($week_start)) . " - " . date('Y-m-d', strtotime($week_end));
                $output = $warning_period . "(" . $extr_time . "h ".$smarty->translate['between']." ".$between." ) <b>" . $smarty->translate['break_needed']."</b>&nbsp;&nbsp;&nbsp;(".$smarty->translate['customers_involved'].":&nbsp;".implode(",", $customers_involved_week).")";
                krsort($week_intervals, SORT_NUMERIC);
                if($_SESSION['company_sort_by'] == 1)
                    $employee_name = $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                elseif($_SESSION['company_sort_by'] == 2)
                    $employee_name = $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                $atl_warning_data[] = array(
                    'atl_message' => $output,
                    'employee_name' => $employee_name,
                    'exceed_hours' => $extr_time,
                    'employee' => $employee,
                    'customer' => $row_atl['customer'],
                    'period' => $warning_period,
                    'i' => $i,
                    'inform' => 'w',
                    'intervals' => $week_intervals
                );
            }
        }

        return $atl_warning_data;
    }
    
    
    // Function adds the deleted slot gogle_id to the delete_google_calender Table
    function  add_deleted_google_calender_id($slot_id){
        $this->tables = array('timetable');
        $this->fields = array('google_id');
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data && ($data[0]['google_id'] != "" || $data[0]['google_id'] != NULL)){
            $this->tables = array('delete_google_calender');
            $this->fields = array('google_id');
            $this->field_values = array($data[0]['google_id']);
            return $this->query_insert();
        }else
            return TRUE;
    }
    
    // This function makes the google_id field of the table timetable to null
    function delete_google_id_of_slot($slot_id){
        $this->tables = array('timetable');
        $this->fields = array('google_id');
        $this->field_values = array(NULL);
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        return $this->query_update();
    }
    
    function delete_google_id($google_id){
        $this->tables = array('delete_google_calender');
        $this->conditions = array('id = ?');
        $this->condition_values = array($google_id);
        return $this->query_delete();
    }
    
    function get_google_ids_deleted(){
        $this->tables = array('delete_google_calender');
        $this->fields = array('id','google_id');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function Customer_pdf_work_report_from_sick_report($customer, $employee, $year, $month, $print_report = TRUE, $obj_pdf = NULL) {
        /**
         * Author: Shamsu
         * for: customer-employee work report
         * used in sick report
         */
        require_once ('class/company.php');
        require_once ('plugins/pdf_emp_cust_work_report_for_sick_rpt.class.php');
        
        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_work_rpt_from_sick();
            
        $obj_company    = new company();
        $obj_equipment  = new equipment();
        $obj_convertor  = new Converter(array(),array(), $year);
        $obj_general    = new general();

       // $obj_employee = new employee();
        $pdf->tot_normal= 0;
        $pdf->tot_oncall= 0;
        $company_data   = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details   = $this->get_customer_details($customer);
        $this->leavePeriod_month    = $month;
        $this->leavePeriod_year     = $year;
        $this->leave_customer       = $customer;
        $this->leave_employee       = $employee;

        // get karense days--------------------------------------------
        // $sick_details = $this->get_employee_leaved_timetable_works($employee, $year, $month, $customer);
        $sick_details = $this->get_employee_leaved_timetable_works($employee, $year, $month);
        $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($sick_details, 'date');

        $karense_dataset        = $obj_convertor->get_karens_data($employee, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $month, $year, null, 0.00, 24.00, FALSE,'FROM_FORM');
        if($karense_dataset) $karense_dataset = array_values($karense_dataset);

        //calculate qualifying date groups
        $qualifying_date_bounderies = array();
        if($karense_dataset){
            foreach ($karense_dataset as $karense_data){
                $date1 = $date2 = NULL;
                if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                    reset($karense_data['karens']);         //reset pointer to its first element (0 index)
                    $date1 = key($karense_data['karens']);  //get first key name from the array
                    end($karense_data['karens']);           //navigate pointer to end
                    $date2 = key($karense_data['karens']);  //get last key name from the array
                }

                if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_2_14']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_2_14']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_2_14']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_2_14']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_15_180']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_15_180']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_15_180']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_15_180']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_15_180'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_180_onwards']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_180_onwards']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_180_onwards']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_180_onwards']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if($date1 == NULL) $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                if($date2 == NULL) $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));
                $qualifying_date_bounderies[] = array('date1' => $date1, 'date2' => $date2);
            }
        }
        else{
            $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
            $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));
            $qualifying_date_bounderies[] = array('date1' => $date1, 'date2' => $date2);
        }
        // echo "<pre>".print_r($qualifying_date_bounderies, 1)."</pre>";

        $list_relations         = $obj_equipment->relations_leave_employee($month, $year, $customer, $employee);
        $list_relations         = $this->crop_vikarie_slots_based_on_its_parent($list_relations, $all_leave_works_grouped, $customer);

        $list_relations_grouped = array();
        if(!empty($list_relations)){
            foreach ($list_relations as $rel_works) {
                $list_relations_grouped[$rel_works['employee_id']][] = $rel_works;
            }
        }
        // get karense days-- end------------------------------------------

        $pdf->setSourceFile('./pdf_forms/Shortened_work_rpt.pdf');
        
        $flag_work_exist = FALSE;
        if(!empty($list_relations_grouped)){
            foreach($list_relations_grouped as $vikarie_emp => $work_details){
                $emp_details    = $this->get_employee_details($vikarie_emp);
                $sign_details   = $this->get_employee_signing_details($vikarie_emp, $month, $year, $customer);


                $qdate_partioned_work_details = array();
                if(!empty($work_details)){
                    foreach($work_details as $w_data){
                        if(!empty($qualifying_date_bounderies)){
                            foreach($qualifying_date_bounderies as $qd){
                                if($w_data['date'] >= $qd['date1'] && $w_data['date'] <= $qd['date2']){
                                    $qdate_partioned_work_details[strtotime($qd['date1'])][] = $w_data;
                                    break;
                                }
                            }
                        }
                    }
                }
                // echo '<pre>'.print_r($qdate_partioned_work_details, 1).'</pre>';

                if(!empty($qdate_partioned_work_details)){
                    foreach ($qdate_partioned_work_details as $qp_works) {
                        $work_partition = array_chunk($qp_works, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
                        
                        if(!empty($work_partition)){
                            foreach ($work_partition as $works) {
                                $flag_work_exist = TRUE;
                                $pdf->AddPage();
                                $tppl = $pdf->importPage(1);
                                $pdf->useTemplate($tppl, -2, 0, 210);

                                $pdf->report_top($company_data, $month, $year);
                                $pdf->SubPart1($cust_details);
                                $pdf->SubPart2($emp_details);
                                $pdf->SubPart3_table($works);
                                $pdf->SubPart4($emp_details, $sign_details);
                                $pdf->Page2_footer($company_data);
                            }
                        }
                    }
                }
            }
        }
        
        if(!$flag_work_exist){
            $smarty = new smartySetup(array("reports.xml"),FALSE);
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            $pdf->SetXY(13, 50);
            $pdf->Cell(180, 7, utf8_decode($smarty->translate['no_work_data_available']), 0, 0, 'C', FALSE);
        }
        // $pdf->Output();
        
        if($print_report){
            $pdf->Output(utf8_decode('Arbetsrapport').'_'.$customer.'_'.date('ymdHi').'.pdf', 'D');
            // $pdf->Output();
        }else 
            return $pdf;
    }

    function Customer_employee_sick_details_report($customer, $employee, $year, $month, $print_report = TRUE,  $obj_pdf = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-02-14
         * for: customer-employee sick details report
         * used in: sick report (LSS report) module
         */
        require_once ('class/company.php');
        require_once ('plugins/pdf_sick_details_report.class.php');
        
        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_sick_report();
        $obj_company                = new company();
        $inconvenient_process_obj   = new inconvenient();
        $equipment                  = new equipment();
        $obj_employee               = new employee();
        $obj_general                = new general();
        $obj_convertor              = new Converter(array(),array(), $year);
        
        $pdf->login_company_id = $_SESSION['company_id'];
        $jvh = 0;
        //$pdf->login_company_id = 8;    //optimal
        
        //---------------------------
        $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details = $this->get_customer_details($customer);
        $emp_details  = $this->get_employee_details($employee);
        $sign_details = $this->get_employee_signing_details($employee, $month, $year, $customer);
        $sick_details = $this->get_employee_leaved_timetable_works($employee, $year, $month, $customer);
        //echo "<pre>".print_r($sick_details,1)."</pre>";
        $sdate = date('Y-m-d', strtotime($year.'-'.$month.'-01'));
        $end_day_of_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $edate = date('Y-m-d', strtotime($year.'-'.$month.'-'.$end_day_of_month));
        
        $distinct_ob_field_names = array();
        $temp_distinct_ob_field_names = array();
        $all_inconv_names = $obj_employee->get_inconvenient_names(NULL, 0);
        
        if(!empty($all_inconv_names)){
            foreach($all_inconv_names as $inc_name)
                $distinct_ob_field_names[] = $inc_name['name'];
            
            $distinct_ob_field_names = array_unique($distinct_ob_field_names);  //removing dublicate column headings
            
            //sorting as fixed format   - sorting column as OB kväll, OB natt, OB helg, etc
            if(in_array('OB kväll', $distinct_ob_field_names)) {
                $temp_distinct_ob_field_names[] = 'OB kväll';
                if(($dkey = array_search('OB kväll', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
            }
            if(in_array('OB natt', $distinct_ob_field_names)) {
                $temp_distinct_ob_field_names[] = 'OB natt';
                if(($dkey = array_search('OB natt', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
            }
            if(in_array('OB helg', $distinct_ob_field_names)) {
                $temp_distinct_ob_field_names[] = 'OB helg';
                if(($dkey = array_search('OB helg', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
            }
            $distinct_ob_field_names = array_values($distinct_ob_field_names);
            
            //if(!empty($distinct_ob_field_names)){
                //foreach($distinct_ob_field_names as $inc_name){
                    //$temp_distinct_ob_field_names[] = $inc_name['name'];
                //}
            //}
            
            $distinct_ob_field_names = array_merge($distinct_ob_field_names, $temp_distinct_ob_field_names);
        }
        
        //if company salary system is "Hogia-Lön": include all oncall-inconvenient types
        if($company_data['salary_system'] == 3){
            $all_inconv_names = $obj_employee->get_inconvenient_names(NULL, 3);
            //echo "<pre>".print_r($all_inconv_names, 1)."</pre>";
            if(!empty($all_inconv_names)){
                foreach($all_inconv_names as $inc_name)
                    $distinct_ob_field_names[] = $inc_name['name'];
                
                $distinct_ob_field_names = array_unique($distinct_ob_field_names);  //removing dublicate column headings
                
                $temp_distinct_ob_field_names = array();
                //sorting as fixed format   - sorting column as Jour Vardag, Jour helg, etc
                if(in_array(strtolower('Jour Vardag'), array_map('strtolower',$distinct_ob_field_names))) {
                    $temp_distinct_ob_field_names[] = 'Jour Vardag';
                    if(($dkey = array_search(mb_strtolower('Jour Vardag'), array_map('strtolower',$distinct_ob_field_names))) !== false) unset($distinct_ob_field_names[$dkey]);
                }elseif(in_array(strtolower('Väntetid Vardag'), array_map('strtolower',$distinct_ob_field_names))) {
                    $temp_distinct_ob_field_names[] = 'Väntetid Vardag';
                    if(($dkey = array_search(strtolower('Väntetid Vardag'), array_map('strtolower',$distinct_ob_field_names))) !== false) unset($distinct_ob_field_names[$dkey]);
                }
                if(in_array(strtolower('Jour helg'), array_map('strtolower',$distinct_ob_field_names))) {
                    $jvh=0;
                    $temp_distinct_ob_field_names[] = 'Jour helg';
                    if(($dkey = array_search(strtolower('Jour helg'), array_map('strtolower',$distinct_ob_field_names))) !== false) unset($distinct_ob_field_names[$dkey]);
                }

                if(in_array(strtolower('Väntetid helg'), array_map('strtolower',$distinct_ob_field_names))) {
                    $jvh=1;
                    $temp_distinct_ob_field_names[] = 'Väntetid helg';
                    if(($dkey = array_search(strtolower('Väntetid helg'), array_map('strtolower',$distinct_ob_field_names))) !== false) unset($distinct_ob_field_names[$dkey]);
                }
                $distinct_ob_field_names = array_values($distinct_ob_field_names);

                $distinct_ob_field_names = array_merge($distinct_ob_field_names, $temp_distinct_ob_field_names);
            }
            //echo "<pre>".print_r($distinct_ob_field_names,1)."</pre>";
        }
        
        /*if($pdf->login_company_id != 8)
            $distinct_ob_field_names[] = '__holiday_helg__';        // Holiday - Helg 
        else if($pdf->login_company_id == 8 && !in_array('OB helg', $distinct_ob_field_names))  //OB helg = ( OB helg and holidays<helg>)
            $distinct_ob_field_names[] = 'OB helg';
            $distinct_ob_field_names[] = '__holiday__'; 
        */
        if(!in_array('ob helg', array_map('strtolower',$distinct_ob_field_names)))
            $distinct_ob_field_names[] = 'OB helg'; 
        if(!in_array('jour helg', array_map('strtolower',$distinct_ob_field_names)) && !in_array('väntetid helg', array_map('strtolower',$distinct_ob_field_names))){
            $$jvh = 0;
            $distinct_ob_field_names[] = 'Jour helg'; 
        }
        if($pdf->login_company_id == 8)
            $distinct_ob_field_names[] = '__holiday__';        
                    // Holiday - Storhelg 
        //echo "<pre>".print_r($sick_details,1)."</pre>";
        //$sick_details = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee, $customer);
        if (!empty($sick_details)) {
            
            $oncall_included_slot_types = array(3, 9, 13, 14, 17);
            
            foreach($sick_details as $key => $sick){
                //echo "-----------<pre>sick_details $key: ".print_r($sick, 1)."</pre>";
                $inconvenient_process_obj->reset_inconvenient_variables();
                /*$inconvenient_process_obj->inconv_normal_slots = array($sick);
                $inconvenient_process_obj->inconv_normal_category = $obj_employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $employee, 1);
                $inconvenient_process_obj->inconv_oncall_category = array();
                $inconvenient_process_obj->leave_category = array();
                $inconvenient_process_obj->holidays = $obj_employee->get_holiday_details($month, $year);*/
                
                $inconvenient_process_obj->inconv_normal_slots = array($sick);
                if($pdf->login_company_id == 8 && in_array($sick['type'], $oncall_included_slot_types))
                    $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $sdate, $edate, $customer, 0);
                else
                    $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $sdate, $edate, $customer);
                $inconvenient_process_obj->categorize_salary_hours();
                
                
                $holiday_names = $inconv_norm_category_names = $inconv_oncall_category_names = array();

                //echo "<pre>".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                if(!empty($inconvenient_process_obj->holidays)){
                    foreach($inconvenient_process_obj->holidays as $this_holi){
                        //$holiday_names[] = $this_holi['name'];
                        $holiday_names[$this_holi['name']] = array('name' => $this_holi['name'], 'type' => $this_holi['type']);
                    }
                }
                
               
                if(!empty($inconvenient_process_obj->inconv_normal_category)){
                    foreach($inconvenient_process_obj->inconv_normal_category as $this_norm_cat){
                        $inconv_norm_category_names[] = $this_norm_cat['name'];
                    }
                }
                /*if($company_data['salary_system'] == 3 || $pdf->login_company_id == 8){
                    if(!empty($inconvenient_process_obj->inconv_oncall_category)){
                        foreach($inconvenient_process_obj->inconv_oncall_category as $this_oncall_cat){
                            $inconv_oncall_category_names[] = $this_oncall_cat['name'];
                        }
                    }
                }*/


                if(!empty($inconvenient_process_obj->inconv_oncall_category)){
                    foreach($inconvenient_process_obj->inconv_oncall_category as $this_oncall_cat){
                        $inconv_oncall_category_names[] = $this_oncall_cat['name'];
                    }
                }
                
               // echo "<pre>holiday_names".print_r($holiday_names, 1)."</pre>";
               // echo "<pre>inconv_oncall_category".print_r($inconv_oncall_category_names, 1)."</pre>";
               // $inconvenient_process_obj->categorize_slots($employee);
               // $inconvenient_process_obj->print_arrays();
               // echo "<pre>Salary  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                
               // $additional = $inconvenient_process_obj->get_addition_salary_hours($sick['employee']);
               // echo "additional<pre>".print_r($additional, 1)."</pre>";
               //echo "<pre>holiday_names".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                if(!empty($inconvenient_process_obj->salary_hours)){
                    foreach($inconvenient_process_obj->salary_hours as $sal_date => $params){
                        foreach($params as $key_name => $key_hours){
                            
                            //find sum of key hours.. if it is an array of hours
                            if(is_array($key_hours)){
                                $tmp_key_hours = 0;
                                foreach($key_hours as $h){
                                    $tmp_key_hours = $equipment->time_sum($tmp_key_hours, $h);
                                }
                                $key_hours = $tmp_key_hours;
                            }
                            
                            if(in_array($key_name, array_keys($holiday_names))){
                                $temp_holiday_key_index = $holiday_names[$key_name]['type'] == 1 ? '__holiday_helg__' : '__holiday__';
                                if($pdf->login_company_id == 8){
                                    //optimal treat OB helg = ( OB helg and holidays<helg>) => so merge it
                                    if($temp_holiday_key_index == '__holiday_helg__') $temp_holiday_key_index = 'OB helg';
                                }else{
                                    if(in_array($sick['type'], $oncall_included_slot_types)){
                                        if($jvh == 0)
                                            $temp_holiday_key_index = 'Jour helg';
                                        else
                                            $temp_holiday_key_index = 'Väntetid helg';
                                    }else{
                                        $temp_holiday_key_index = 'OB helg';
                                    }
                                }


                                if(isset($sick_details[$key]['inconv_details'][$temp_holiday_key_index]))
                                    $sick_details[$key]['inconv_details'][$temp_holiday_key_index] = $equipment->time_sum($sick_details[$key]['inconv_details'][$temp_holiday_key_index], $key_hours);
                                else
                                    $sick_details[$key]['inconv_details'][$temp_holiday_key_index] = $key_hours;
                                
                               // if(!in_array('__holiday__', $distinct_ob_field_names)) $distinct_ob_field_names[] = '__holiday__';
                                
                               // if($pdf->login_company_id == 8 && in_array($sick['type'], $oncall_included_slot_types) && !emtpy($inconvenient_process_obj->inconv_oncall_category)){
                               //     foreach ($this->inconv_oncall_category as $inconv_normal) {
                               //         if(strtotime($sick['date']) >= strtotime($inconv_normal['effect_from']) && ($inconv_normal['effect_to'] == '' || strtotime($sick['date']) <= strtotime($inconv_normal['effect_to']))){
                               //             $days = explode(',', $inconv_normal['days']);
                               //             $inconv_time_from = mktime(intval($inconv_normal['time_from']), bcmod($inconv_normal['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                               //             $inconv_time_to = mktime(intval($inconv_normal['time_to']), bcmod($inconv_normal['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                               //             if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                                               
                               //             }
                               //         }
                               //     }
                               // }
                            }
                            else if(in_array($key_name, $inconv_norm_category_names)){
                                $sick_details[$key]['inconv_details'][$key_name] = $key_hours;
                               // if(!in_array($key_name, $distinct_ob_field_names)) $distinct_ob_field_names[] = $key_name;
                            }
                            else if(in_array($key_name, $inconv_oncall_category_names)){
                                $sick_details[$key]['inconv_details'][$key_name] = $key_hours;
                               // if(!in_array($key_name, $distinct_ob_field_names)) $distinct_ob_field_names[] = $key_name;
                            }
                        }
                        
                    }
                }
            }
        }
        //echo "<pre>holiday_names".print_r($sick_details, 1)."</pre>";
        
        //----------------------------------------------
        $this->leavePeriod_month= $month;
        $this->leavePeriod_year = $year;
        $this->leave_customer   = $customer;
        $this->leave_employee   = $employee;
        $sick_details__ = $this->get_employee_leaved_timetable_works($employee, $year, $month);
        //echo "<pre>holiday_names".print_r($sick_details__, 1)."</pre>";
        $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($sick_details__, 'date');
        $karense_dataset        = $obj_convertor->get_karens_data($employee, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $month, $year, null, 0.00, 24.00, FALSE,'FROM_FORM');
        if($karense_dataset) $karense_dataset = array_values($karense_dataset);
        //echo "<pre>holiday_names".print_r($karense_dataset, 1)."</pre>";
        //calculate qualifying date groups
        $qualifying_date_bounderies = array();

        if($karense_dataset){
            foreach ($karense_dataset as $karense_data){
                $date1 = $date2 = NULL;
                if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                    reset($karense_data['karens']);         //reset pointer to its first element (0 index)
                    $date1 = key($karense_data['karens']);  //get first key name from the array
                    end($karense_data['karens']);           //navigate pointer to end
                    $date2 = key($karense_data['karens']);  //get last key name from the array
                }

                if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_2_14']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_2_14']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_2_14']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_2_14']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_15_180']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_15_180']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_15_180']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_15_180']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_180_onwards']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_180_onwards']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_180_onwards']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_180_onwards']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if($date1 == NULL) $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                if($date2 == NULL) $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));
                $qualifying_date_bounderies[] = array('date1' => $date1, 'date2' => $date2);
            }
        }
        else{
            $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
            $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));
            $qualifying_date_bounderies[] = array('date1' => $date1, 'date2' => $date2);
        }

        //--------------------------------------------------------
        $qdate_partitioned_sick_details = array();
        //echo "<pre>sick_details".print_r($qualifying_date_bounderies, 1)."</pre>";
        if(!empty($sick_details)){
            foreach($sick_details as $sick_data){
                if(!empty($qualifying_date_bounderies)){
                    foreach($qualifying_date_bounderies as $qd){
                        if($sick_data['date'] >= $qd['date1'] && $sick_data['date'] <= $qd['date2']){
                            $qdate_partitioned_sick_details[strtotime($qd['date1'])][] = $sick_data;
                            break;
                        }
                    }
                }
            }

        }

       //echo "<pre>".print_r($qdate_partitioned_sick_details, 1)."</pre>";
        
       //echo "<pre>Final sick_details".print_r($sick_details_partition, 1)."</pre>";
        
       // ob_clean();
       // echo "<pre>".print_r($sick_details, 1)."</pre>";
        //echo "<pre>".print_r($distinct_ob_field_names, 1)."</pre>";
        if(!empty($qdate_partitioned_sick_details)){
            foreach($qdate_partitioned_sick_details as $qdate_partitioned_sick_block){
                if(!empty($qdate_partitioned_sick_block)){
                    $sick_details_partition = array_chunk($qdate_partitioned_sick_block, 20);   //array split as 20 rows
                    foreach($sick_details_partition as $ind => $sick_datas){

                        $pdf->AddPage();
                        $pdf->report_header($year, $month, $company_data, $cust_details, $emp_details);
                        $pdf->content_table_generation($sick_datas, $distinct_ob_field_names, $company_data['salary_system']);
                        $pdf->signing_part($emp_details, $sign_details);
                        $pdf->Page_footer_content($company_data);
                    }
                }
            }
        }
        
        if($print_report){
            $pdf->Output(utf8_decode(' Avvikelserapport').'_'.$customer.'_'.date('ymdHi').'.pdf', 'D');
           // $pdf->Output();
        }else 
            return $pdf;
    }
    
    function Customer_employee_sick_details_and_work_report($customer, $employee, $year, $month, $print_report = TRUE,  $obj_pdf = NULL){
        
       // echo "pdf_work_repot<pre>".print_r($pdf_work_repot, 1)."</pre>";
       // echo "pdf_sick_details_repot<pre>".print_r($pdf_sick_details_repot, 1)."</pre>";
        
        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else{
            require_once ('plugins/pdf_work_and_sick_details_report.class.php');
            $pdf = new PDF_work_and_sick_details_report();
        }

        $pdf = $this->Customer_pdf_work_report_from_sick_report($customer, $employee, $year, $month, FALSE, $pdf);
        
       // $pdf->AddPage();
        $pdf = $this->Customer_employee_sick_details_report($customer, $employee, $year, $month, FALSE, $pdf);
        
        
        if($print_report){
           // $pdf->Output(date('ymdHi').'.pdf', 'D');
            $pdf->Output(utf8_decode('Arbetsrapport-Avvikelserapport').'_'.$customer.'_'.date('ymdHi').'.pdf', 'D');
           // $pdf->Output();
        }else 
            return $pdf;
    }
    
    function get_all_tt_employees_of_a_customer($customer, $nk, $month, $year, $included_employees = array()) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: to get employee names from timetable related to specified customer/fkkn/month/year
         * @param $included_employees : if not empty, the employees should be in this array
         */
        if($nk == '') $nk = NULL;
        $this->flush();
        $this->sql_query = 'SELECT t.employee AS empID, CONCAT( e.last_name," ",  e.first_name ) AS empName, t.fkkn, t.date
                            FROM timetable t
                            LEFT JOIN employee e ON t.employee = e.username
                            WHERE t.customer LIKE ?
                            AND MONTH(t.date) = ?
                            AND YEAR(t.date) = ?
                            AND t.employee != "" AND t.employee IS NOT NULL 
                            AND t.type NOT IN (1,2,7,8,9,10,11,16,17) ';
        
        $this->condition_values = array($customer, $month, $year);
        
        if($nk != NULL){
            $this->sql_query .= ' AND t.fkkn = ? ';
            $this->condition_values[] = $nk;
        }
        
        if(!empty($included_employees)){
            $in_employees = '\'' . implode('\', \'', $included_employees) . '\'';
            $this->sql_query .= ' AND t.employee IN ('.$in_employees.') ';
        }
        
        $this->sql_query .= 'GROUP BY e.username 
                            ORDER BY LOWER(empName) collate utf8_bin';
        /*$this->tables = array("SELECT t.employee AS empID, CONCAT( e.first_name,' ', e.last_name ) AS empName, t.fkkn,t.date
                                        FROM timetable t
                                        LEFT JOIN employee e ON t.employee = e.username
                                        WHERE t.customer LIKE '$customer'
                                        AND t.fkkn = '$nk'
                                        AND MONTH(t.date) = '$month'
                                        AND YEAR(t.date) = '$year'
                                        AND t.employee != '' AND t.employee IS NOT NULL 
                                        GROUP BY e.username");
        $this->query_generate_leftjoin();*/
        $emp_names = $this->query_fetch();
        return $emp_names;
    }
    
    
    function get_billing_customer_contract_detail($customer, $kkn, $year, $month) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: to get customer contracts within a year-month of customer
         */
        
        $date_from = date('Y-m-d', strtotime($year.'-'.$month.'-01'));
        $date_to = date('Y-m-d', strtotime($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN, $month, $year)));
        
        $this->flush();
        $this->tables = array('customer_contract` as `cc', 'customer_contract_billing` as `ccb');
        $this->fields = array('cc.id', 'cc.date_from', 'cc.date_to', 'ccb.kn_name', 'ccb.kn_address', 'ccb.mobile', 'ccb.email', 'ccb.kn_postno', 'ccb.city', 'ccb.kn_reference_no', 'ccb.kn_box    ');
        $this->conditions = array('AND', 'cc.customer = ?', 'cc.fkkn = ?',
                                        array('OR', 
                                                array('BETWEEN', 'cc.date_from', '?', '?'),
                                                array('BETWEEN', 'cc.date_to', '?', '?'),
                                                array('BETWEEN', '?', 'cc.date_from', 'cc.date_to'),
                                                array('BETWEEN', '?', 'cc.date_from', 'cc.date_to')
                                            ),
                                        'cc.id = ccb.contract_id');
        $this->condition_values = array($customer, $kkn, $date_from, $date_to, $date_from, $date_to, $date_from, $date_to);
        $this->order_by = array('cc.date_from', 'cc.date_to');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function edit_comment_slot($slot_id,$slot_comment){
        $this->tables = array('timetable');
        $this->fields = array('comment');
        $this->field_values = array($slot_comment);
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        return $this->query_update();
    }
    
    function approve_candg_slot($slot_id,$comment = null){
        $this->tables = array('timetable');
        $this->fields = array('status','comment');
        $this->field_values = array('1',$comment);
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        return $this->query_update();
    }
    
    function get_employee_slots_btwn_dates($employee, $sdate, $edate, $customer = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: Get employee slots between 2 dates (only getting status 0, 1 slots)
         */
        if($employee == '') return array();
        
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'time_from', 'time_to', 'date', 'type', 'status');
        $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'status IN (0, 1)');
        $this->condition_values = array($sdate, $edate, $employee);
        
        if($customer != NULL){
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_employee_unread_leave_count() {
        /**
         * Author: Shamsu
         * for: get count of unread leaves
         */
       // echo "_SESSION<pre>".print_r($_SESSION, 1)."</pre>";
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        $team_employee_data_array = array();
        
        if ($login_user_role == 7) {
            $processed_employees = array();     //used to check previously queried with this employees

            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 7);    /* this section for super team leader */
            $team_customers = array_merge($team_customers, $employee->get_team_customer_names_using_emp_role($login_user, 3));  /* this section for normal user */
            foreach ($team_customers as $cust_name) {
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                if(!empty($team_employees)){
                    foreach ($team_employees as $sel_emp) {
                        if (!in_array($sel_emp, $processed_employees)) {
                            $processed_employees[] = $sel_emp;
                            $team_employee_data_array[] = $sel_emp;
                        }
                    }
                }
            }
        }

        else if ($login_user_role == 2) {
            $processed_employees = array();     //used to check previously queried with this employees

            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 2);    /* this section for team leader */
            $team_customers = array_merge($team_customers, $employee->get_team_customer_names_using_emp_role($login_user, 3));  /* this section for normal user */
            foreach ($team_customers as $cust_name) {
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                if(!empty($team_employees)){
                    foreach ($team_employees as $sel_emp) {
                        if (!in_array($sel_emp, $processed_employees)) {
                            $processed_employees[] = $sel_emp;
                            $team_employee_data_array[] = $sel_emp;
                        }
                    }
                }
            }
        }
            
        
        $this->flush();

        $this->sql_query = "SELECT count(DISTINCT l.group_id) as unread_leave_count
                                FROM `leave` AS l
                                LEFT JOIN `mc_leave` AS mcl ON ( mcl.leave_id = l.group_id)
                                WHERE (mcl.read_users NOT LIKE '%$login_user%' OR mcl.leave_id IS NULL) AND l.status=0
                ";

        switch ($login_user_role) {
            case 1:
                break;
            case 2:
            case 7:
                if(!empty($team_employee_data_array)){
                    $team_employee_data = '\'' . implode('\', \'', $team_employee_data_array) . '\'';
                    $this->sql_query .=' AND l.employee IN ('.$team_employee_data.')';
                }
                else{
                    $this->flush();
                    return 0;
                }
                break;

            case 3:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->sql_query .=" AND (l.employee = '$login_user' 
                                            OR (l.employee IN ($team_employee_data) AND l.status = 1)
                                    )";
                break;
            default:
                $this->flush();
                return 0;
                break;
        }
       // $this->sql_query .=' GROUP BY l.group_id';
        $datas = $this->query_fetch();
        return (!empty($datas) ? $datas[0]['unread_leave_count'] : 0);
    }
    
    function pdf_employee_details_full($emp) {

        require_once ('plugins/pdf_employee_full_details.class.php');
        $employee = new employee();
        $obj_user = new user();
        $obj_equipment = new equipment();
        $obj_company = new company();
        $pdf = new PDF_emp_full_details();
        
        $emp_details = $employee->employee_detail_main($emp);
        
        $pdf->emp_details = $emp_details[0];
        
        $color = $emp_details[0]['color'];
        $rgb = $employee->hex_to_rgb($color);
        $pdf->emp_details['color_params'] = $rgb;
        
        $pdf->emp_details['start_day_val']    = substr($emp_details[0]['start_day'], 0, 1);
        $pdf->emp_details['start_time_val']   = substr($emp_details[0]['start_day'], 1, 5);
        $pdf->emp_details['user_role'] = $obj_user->user_role($emp);
        //echo "<pre>".print_r($pdf->emp_details, 1)."</pre>";
        
        $pdf->team_customers = $obj_equipment->assigned_customers_to_employee($emp);
        
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        //echo "<pre>".print_r($pdf->team_customers, 1)."</pre>";
        ///////////////////////////////////////////page 1///////////////////////////////////////////////

        $pdf->AddPage();
        $pdf->report_header($company_details);
       // $pdf->report_title();
        $pdf->personal_information($emp);
        $pdf->account_information();
        $pdf->other_information();
        // echo "sjdhjsh";
        $pdf->contract_info();
        $pdf->export_information();
        $pdf->team_information();

        $pdf->Output();
    }
    
    function make_fk_export_xml($sel_year, $sel_month, $cust_key, $emp_key) {
        $employee = new employee();
        $obj_general = new general();
        
        $fkkn = 1;
        
        $sign_details = $this->get_employee_signing_details($emp_key, $sel_month, $sel_year, $cust_key);
        $employer_sign_details = $employee->employer_signing_details($cust_key, $sel_month, $sel_year, $fkkn, $emp_key);
        $counter = 1; //$customer->get_next_counter_fk_export($sel_year, $sel_month, $cust_key, $emp_key);
        $uuid = $obj_general->generate_custom_uuid($sel_year, $sel_month, $cust_key, $emp_key, $counter);
        
        if($sign_details && $sign_details[0]['xml'] != NULL){
            $xml = $sign_details[0]['xml'];
        }
        else{
            $customer = new customer();
            $obj_company = new company();
        
            $normal_slot_types = array(0, 1, 2, 4, 5, 6, 7, 12);
            $oncall_slot_types = array(3, 13, 14);
            $beredskaps_slot_types = array(15);
            $this_month_first_date = date('Y-m-d', strtotime("$sel_year-$sel_month-01"));
            $this_month_last_date = date('Y-m-t', strtotime($this_month_first_date));
            
            $cust_data_set = $customer->customer_detail($cust_key);
            $emp_data_set = $employee->get_employee_detail($emp_key);
            $work_details = $this->get_Customer_employee_report_data($emp_key, $cust_key, $sel_month, $sel_year, $fkkn);
            $company_data = $obj_company->get_company_detail($_SESSION['company_id']);

            $this_employee__ = $emp_key != '' ? $emp_key : NULL;
            $fkkn_form_defaults = $this->check_exists_fkkn_form_defaults($cust_key, $this_employee__, TRUE);
            //echo "<pre>".print_r($fkkn_form_defaults, 1)."</pre>";

            //----calculate beraknings periods--------------------------------
            /* Beredeskap period calculation based on customer records */
            // $tmp_calculation_start_month = ($cust_data_set['employee_contract_start_month'] != '' ? $cust_data_set['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
            // $calculation_period_length = ($cust_data_set['employee_contract_period_length'] != '' && $cust_data_set['employee_contract_start_month'] != '' ?  $cust_data_set['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
            // $calculation_period_month_start_date = ($cust_data_set['employee_contract_period_date'] != '' && $cust_data_set['employee_contract_start_month'] != '' ?  $cust_data_set['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
            $tmp_calculation_start_month = ($emp_data_set['employee_contract_start_month'] != '' ? $emp_data_set['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
            $calculation_period_length = ($emp_data_set['employee_contract_period_length'] != '' && $emp_data_set['employee_contract_start_month'] != '' ?  $emp_data_set['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
            $calculation_period_month_start_date = ($emp_data_set['employee_contract_period_date'] != '' && $emp_data_set['employee_contract_start_month'] != '' ?  $emp_data_set['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
            $flag_found_calculation_period = FALSE;
            $is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
            $is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;
            $contract_calculation_values = array();
            $contract_calculation_previous_values = array();

            if(!$is_month_starting_first_date){     //for keeping previous calculation period
                $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
                $pre_year_start = $sel_year;
                if($pre_month_start < 1){
                    $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
                    $pre_year_start--;
                }

                $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
                if($is_month_starting_last_date){
                    $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($sel_year.'-'.$tmp_calculation_start_month.'-01'));
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                }else
                    $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($sel_year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
            }
            while(!$flag_found_calculation_period){
                $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
                if($tmp_calculation_end_month > 12){
                    if(($tmp_calculation_start_month <= $sel_month && $sel_month <= 12) || (1 <= $sel_month && $sel_month <= ($tmp_calculation_end_month-12))){
                        $flag_found_calculation_period = TRUE;
                        $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
                        if($tmp_calculation_start_month <= $sel_month && $sel_month <= 12){
                            $contract_calculation_values['start_year'] = $sel_year;
                            $contract_calculation_values['end_year'] = $sel_year+1;
                        }else {
                            $contract_calculation_values['start_year'] = $sel_year - 1;
                            $contract_calculation_values['end_year'] = $sel_year;
                        }
                    } 
                    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                        $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
                        $contract_calculation_previous_values['start_year'] = $sel_year;
                        $contract_calculation_previous_values['end_year'] = $sel_year+1;
                    }
                }else {
                    if($tmp_calculation_start_month <= $sel_month && $sel_month <= $tmp_calculation_end_month){
                        $flag_found_calculation_period = TRUE;
                        $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
                        $contract_calculation_values['start_year'] = $sel_year;
                        $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($sel_year+1) : $sel_year;
                    }
                    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                        $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                        $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
                        $contract_calculation_previous_values['start_year'] = $sel_year;
                        $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($sel_year+1) : $sel_year;
                    }
                }
                if($flag_found_calculation_period){
                    if($is_month_starting_first_date)
                        $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
                    else
                        $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

                    if($is_month_starting_first_date)
                        $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
                    else{
                        $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
                        if($is_month_starting_last_date){
                            $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                            $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
                        }else{
                            $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                        }
                    }
                }
                else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                    $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

                    $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
                    if($is_month_starting_last_date){
                        $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                    }else{
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                    }
                }
                $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
            }


            $is_rpt_smonth_equal_calc_smonth = date('m', strtotime($contract_calculation_values['start_date'])) == $sel_month? TRUE : FALSE;
            $calculation_period_start_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['start_date'] : $contract_calculation_values['start_date']);
            $calculation_period_end_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['end_date'] : $contract_calculation_values['end_date']);

            $calculation_end_date = '';
            if(date('m', strtotime($calculation_period_end_date)) == $sel_month)
                    $calculation_end_date = $calculation_period_end_date;
            else
                    $calculation_end_date = date('Y-m-t', strtotime("$sel_year-$sel_month-01"));
            
            $special_calculation_array = array();
            if(!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth){
                $special_calculation_array['calculation_period_start_date'] = $contract_calculation_values['start_date'];
                $special_calculation_array['calculation_period_end_date'] = $contract_calculation_values['end_date'];
                
                $special_calculation_array['calculation_end_date'] = '';
                if(date('m', strtotime($contract_calculation_values['end_date'])) == $sel_month)
                        $special_calculation_array['calculation_end_date'] = $contract_calculation_values['end_date'];
                else
                        $special_calculation_array['calculation_end_date'] = date('Y-m-t', strtotime("$sel_year-$sel_month-01"));
            }
            //----------------------------------------------------------------

            $xml_work_details = '';
            if (!empty($work_details)) {
                foreach ($work_details as $wdata) {
                    if(in_array($wdata['type'], $normal_slot_types) || in_array($wdata['type'], $oncall_slot_types) || in_array($wdata['type'], $beredskaps_slot_types)){

                        $this_work_type_xml = '';
                        if(in_array($wdata['type'], $normal_slot_types)) $this_work_type_xml = '<ns:aktivTid>true</ns:aktivTid>';
                        else if(in_array($wdata['type'], $oncall_slot_types)) $this_work_type_xml = '<ns:vanteTid>true</ns:vanteTid>';
                        else if(in_array($wdata['type'], $beredskaps_slot_types)) $this_work_type_xml = '<ns:beredskapsTid>true</ns:beredskapsTid>';

                        $xml_work_details .= '<ns:rapportRad>
                                                    <ns:dag>' . date('d', strtotime($wdata['date'])) . '</ns:dag>
                                                    <ns:fromTid>' . sprintf('%05.02f', $wdata['time_from']) . '</ns:fromTid>
                                                    <ns:tomTid>' . sprintf('%05.02f', $wdata['time_to']) . '</ns:tomTid>' 
                                                    . $this_work_type_xml . '
                                                </ns:rapportRad>';
                    }
                }
            }

            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <ns:Tidredovisning xmlns:ns="http://schema.forsakringskassan.se/integration/isassistansersattning/tidredovisning/1">
                    <ns:id>' . $uuid . '</ns:id>
                    <ns:redovisningsmanad>' . $sel_year . '-' . str_pad($sel_month, 2, '0', STR_PAD_LEFT) . '</ns:redovisningsmanad>
                    <ns:personSomHarAssistans>
                      <ns:personnummer>' . $cust_data_set['century'] . $cust_data_set['social_security'] . '</ns:personnummer>
                      <ns:fornamn>' . $cust_data_set['first_name'] . '</ns:fornamn>
                      <ns:efternamn>' . $cust_data_set['last_name'] . '</ns:efternamn>
                    </ns:personSomHarAssistans>
                    <ns:assistent>
                        <ns:personnummer>' . $emp_data_set['century'] . $emp_data_set['social_security'] . '</ns:personnummer>
                        <ns:fornamn>' . $emp_data_set['first_name'] . '</ns:fornamn>
                        <ns:efternamn>' . $emp_data_set['last_name'] . '</ns:efternamn>
                        <ns:kollektivavtal>'.(empty($fkkn_form_defaults) ||  $fkkn_form_defaults[0]['bargaining_new'] == 1 ? 'true' : 'false').'</ns:kollektivavtal>
                    </ns:assistent>
                    <ns:berakningsperiod>
                        <ns:fromDag>' . $calculation_period_start_date /*$this_month_first_date*/ . '</ns:fromDag>
                        <ns:tomDag>' . $calculation_period_end_date /*$this_month_last_date*/ . '</ns:tomDag>
                    </ns:berakningsperiod>';
                    /*$xml .= '<ns:berakningsperiod>
                        <ns:fromDag>' . $this_month_first_date . '</ns:fromDag>
                        <ns:tomDag>' . $this_month_last_date . '</ns:tomDag>
                    </ns:berakningsperiod>';*/
                    if(!empty($special_calculation_array)){
                        $xml .= '<ns:berakningsperiod>
                                    <ns:fromDag>' . $special_calculation_array['calculation_period_start_date'] . '</ns:fromDag>
                                    <ns:tomDag>' . $special_calculation_array['calculation_period_end_date'] . '</ns:tomDag>
                                </ns:berakningsperiod>';
                    }
                    if(!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['provider_of_pa_flag'] == 1){
                        $xml .= '<ns:anstalldAvPersonSomHarAssistans>true</ns:anstalldAvPersonSomHarAssistans>';
                    }
                    else {
                        $xml .= '<ns:assistansanordnare>
                                    <ns:anordnareNamn>' . $company_data['name'] . '</ns:anordnareNamn>
                                    <ns:organisationsnummer>' . $company_data['org_no'] . '</ns:organisationsnummer>
                                    <ns:kontaktperson>' . (!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['provider_of_pa_flag'] == 2 && $fkkn_form_defaults[0]['company_cp_name'] != '' ? $fkkn_form_defaults[0]['company_cp_name'] : ($company_data['contact_person1'] != '' ? $company_data['contact_person1'] : $company_data['contact_person2'])) . '</ns:kontaktperson>';
                                    if((!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['provider_of_pa_flag'] == 2 && $fkkn_form_defaults[0]['company_cp_phone'] != '' && strlen($fkkn_form_defaults[0]['company_cp_phone']) >= 7) || ($company_data['phone'] != '' && strlen($company_data['phone']) >= 7) || ($company_data['mobile'] != '' && strlen($company_data['mobile']) >= 7))
                                        $xml .= '<ns:telefonnummer>' . (!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['provider_of_pa_flag'] == 2 && $fkkn_form_defaults[0]['company_cp_phone'] != '' && strlen($fkkn_form_defaults[0]['company_cp_phone']) >= 7 ? $fkkn_form_defaults[0]['company_cp_phone'] : ($company_data['phone'] != '' && strlen($company_data['phone']) >= 7 ? $company_data['phone'] : $company_data['mobile'])) . '</ns:telefonnummer>';
                                    
                                    if((!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['agreement_types_new'] == 1) || empty($fkkn_form_defaults) || !in_array($fkkn_form_defaults[0]['agreement_types_new'], array(1,2,3)))
                                        $xml .= '<ns:assistentAnstalldAvAnordnare>true</ns:assistentAnstalldAvAnordnare>';
                                    else if(!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['agreement_types_new'] == 2){
                                        $xml .= '<ns:annanArbetsgivare>
                                                    <ns:arbetsgivareNamn>'.$fkkn_form_defaults[0]['agreement_type2_company'].'</ns:arbetsgivareNamn>
                                                    <ns:organisationsnummer>'.$fkkn_form_defaults[0]['agreement_type2_orgNo'].'</ns:organisationsnummer>
                                                </ns:annanArbetsgivare>';
                                    }
                                    else if(!empty($fkkn_form_defaults) && $fkkn_form_defaults[0]['agreement_types_new'] == 3)
                                        $xml .= '<ns:assistentEgenForetagare>true</ns:assistentEgenForetagare>';
                        $xml .= '</ns:assistansanordnare>';
                    }
            $xml .= '<ns:tidrapport>
                        ' . $xml_work_details . '
                    </ns:tidrapport>';
                    //<ns:telefonnummerAnordnare>1933211234</ns:telefonnummerAnordnare>';
                    
                    $xml .= '<ns:telefonnummerAnordnare>' . ($company_data['phone'] != '' && strlen($company_data['phone']) >= 7 ? $company_data['phone'] : ($company_data['mobile'] != '' && strlen($company_data['mobile']) >= 7 ? $company_data['mobile']: '0000000000')) . '</ns:telefonnummerAnordnare>';
                    
                    if(($emp_data_set['phone'] != '' && strlen($emp_data_set['phone']) >= 7) || ($emp_data_set['mobile'] != '' && strlen($emp_data_set['mobile']) >= 7))
                        $xml .= '<ns:telefonnummerAssistent>' . ($emp_data_set['phone'] != '' && strlen($emp_data_set['phone']) >= 7 ? $emp_data_set['phone'] : $emp_data_set['mobile']) . '</ns:telefonnummerAssistent>';
            $xml .= '</ns:Tidredovisning>';

    //        <ns:telefonnummerAnordnare>' . (!empty($employer_sign_details) ? ($employer_sign_details[0]['employee_data'][0]['employer_phone'] != '' ? $employer_sign_details[0]['employee_data'][0]['employer_phone'] : $employer_sign_details[0]['employee_data'][0]['employer_mobile']) : '') . '</ns:telefonnummerAnordnare>
    //                <ns:telefonnummerAssistent>' . (!empty($employer_sign_details) ? ($employer_sign_details[0]['employee_data'][0]['employee_phone'] != '' ? $employer_sign_details[0]['employee_data'][0]['employee_phone'] : $employer_sign_details[0]['employee_data'][0]['employee_mobile']) : '') . '</ns:telefonnummerAssistent>
        }
        return array(
            'uuid'              => $uuid,
            'xml'               => $xml,
            'employee_signing'  => $sign_details,
            'employer_signing'  => $employer_sign_details
        );
    }

    function get_employee_certification_summery_data($employee, $start_year, $start_month, $end_year, $end_month, $remove_if_no_vals = FALSE){
        
        $obj_employee = new employee();
        $summary_data = array();
        $leaves_data = array();
        $oncall_summary_data = array();
        $leaves_summary_data = array();
        for($year = $start_year ; $year <= $end_year ; $year++){
            $iteraton_start_month = ($year == $start_year ? $start_month : 1);
            $iteraton_end_month = ($year == $end_year ? $end_month : 12);

            $tmp_working_days = $this->get_employee_no_of_working_days($employee, $year);
            $tmp_working_days_indexed = array();
            if(!empty($tmp_working_days)){
                foreach($tmp_working_days as $twd){
                    $tmp_working_days_indexed[$twd['month']] = $twd;
                }
            }

            $tmp_slots_indexed = $this->get_employee_slots($employee, $year);
            for($month = $iteraton_start_month ; $month <= $iteraton_end_month ; $month++){
                $tmp_iteration_year_month = sprintf('%04d', $year).sprintf('%02d', $month);
                $tmp_strtotime = strtotime("$year-$month-01");
                $slot_details = array();
                $leaves_summary = $this->sick_leave_complete_for_employee($employee, $year, $month);
                if(!empty($leaves_summary)) {
                    $leaves_summary_data[$tmp_iteration_year_month] = $leaves_summary;
                }
                $tmp_slots_amount_indexed = array();
                $total_oncall_hours = 0;
                $total_oncall_amount = 0;
                $total_ob_hours = 0;
                $total_ob_amount = 0;
                if(!empty($tmp_slots_indexed[(int) $month]['datas'])) {
                    foreach ($tmp_slots_indexed[(int) $month]['datas'] as $slot) {
                        $tmp_slots_amount_indexed[$slot['customer']][] = $slot;
                    }
                    //echo "<pre>".print_r($tmp_slots_amount_indexed,1)."</pre>";
                    foreach ($tmp_slots_amount_indexed as $customer_username => $slots) {
                        //echo "<pre>".$customer_username.print_r($slots,1)."</pre>";
                        $slot_details = $this->get_employee_inconv_leaved_works_from_dataset($employee, $customer_username, $slots, date('Y-m-01', $tmp_strtotime), date('Y-m-t', $tmp_strtotime));
                        //echo "<pre>".$customer_username.print_r($slot_details,1)."</pre>";
                        $ord_inconv_details = $slot_details['inconv_details'];
                        //echo "<pre>".$customer_username.print_r($ord_inconv_details,1)."</pre>";

                        if(!empty($ord_inconv_details)){
                            $ord_amount = 0;
                            foreach ($ord_inconv_details as $key => $values){
                                if($key == 'normal_0'){
                                    foreach ($values as $amount => $h_value){
                                        $ord_amount = $amount;
                                    }
                                }
                                if(stripos($key, 'jour') !== FALSE || stripos($key, 'Vänte') !== FALSE){
                                    foreach ($values as $amount => $h_value){
                                        $total_oncall_amount += ($h_value['hour'] * $amount);
                                        $total_oncall_hours += $h_value['hour'];
                                    }
                                }else if($key == 'normal_3'){
                                    foreach ($values as $amount => $h_value){
                                        $total_oncall_amount += ($h_value['hour'] * $amount);
                                        $total_oncall_hours += $h_value['hour'];
                                    }
                                }
                                if(stripos($key, 'OB ') !== FALSE){
                                    foreach ($values as $amount => $h_value){
                                        $total_ob_amount += (($h_value['hour'] * $amount) + ($h_value['hour'] * $ord_amount));
                                        $total_ob_hours += $h_value['hour'];
                                    }
                                }
                            }
                        }
                    }
                }
                
                // $tmp_working_days = $this->get_employee_no_of_working_days($employee, $year, $month);

                $tmp_ob_works = $obj_employee->get_distinct_inconvenient_details_btwn_2_dates(date('Y-m-01', $tmp_strtotime), date('Y-m-t', $tmp_strtotime), $employee, 1);

                //it will remove the row if all values are 0
                $other_desc = array();
                if($total_ob_hours || $total_ob_amount) {
                    $other_desc[] = array(
                        'desc' => 'OB',
                        'days'      => '',
                        'hours'      => $total_ob_hours,
                        'amount'      => $total_ob_amount
                    );
                }
                if(!empty($leaves_summary_data[$tmp_iteration_year_month]['working_days'] || $leaves_summary_data[$tmp_iteration_year_month]['oncall_total'] || $leaves_summary_data[$tmp_iteration_year_month]['oncall_amount'])) {
                    $leave_sum_data = $leaves_summary_data[$tmp_iteration_year_month];
                    $other_desc[] = array(
                        'desc' => 'Frånvaro',
                        'days'      => $leave_sum_data['working_days'],
                        'hours'      => $leave_sum_data['oncall_total'],
                        'amount'      => $leave_sum_data['oncall_amount']
                    );
                }
                if($remove_if_no_vals 
                    && ((!isset($tmp_working_days_indexed[(int) $month]) || $tmp_working_days_indexed[(int) $month]['no_of_days'] == 0) 
                    || ((!isset($tmp_slots_indexed[(int) $month]['datas']) || $total_oncall_hours == 0)
                    && empty($tmp_ob_works))) && empty($other_desc))
                    continue;
                $oncall_summary_data[] = array(
                    'year_month'    => $tmp_iteration_year_month,
                    'working_days'  => isset($tmp_working_days_indexed[(int) $month]) ? $tmp_working_days_indexed[(int) $month]['no_of_days'] : 0,
                    'oncall_total'  => $total_oncall_hours,
                    'oncall_amount' => $total_oncall_amount,
                    'others'      => $other_desc
                );
            }
        }
        //print_r($oncall_summary_data);
        $summary_data = $oncall_summary_data;
        return $summary_data;
    }

    function get_employee_no_of_working_days($employee, $year){
        /*$this->flush();
        $this->tables = array('timetable');
        $this->fields = array('count(DISTINCT date) as no_of_days', 'MONTH(date) as month', 'YEAR(date) as year');
        $this->conditions = array('AND', 'employee = ?', 'YEAR(date) = ?', array('IN', 'status', '1,2'));
        $this->condition_values = array($employee, $year);
        $this->group_by = array('YEAR(date)', 'MONTH(date)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;*/

        $this->flush();
        $this->sql_query = 'SELECT count(DISTINCT date) as no_of_days, MONTH(date) as month, YEAR(date) as year FROM (
            ( SELECT date FROM `timetable` WHERE employee = ? AND YEAR(date) = ? AND status IN ( 1,2 ) ) 
            UNION 
            ( SELECT date FROM `backup_timetable` WHERE employee = ? AND YEAR(date) = ? AND status IN ( 1,2 ) ) 
        ) As sample1
        GROUP BY YEAR(date), MONTH(date)';
        $this->condition_values = array($employee, $year, $employee, $year);
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_oncall_hour_sum($employee, $year){
        // $this->flush();
        // $this->tables = array('timetable');
        // $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_oncall_time', 'MONTH(date) as month', 'YEAR(date) as year');
        // $this->conditions = array('AND', 'employee = ?', 'YEAR(date) = ?', 'status = 1', array('IN', 'type', '3,9,13,14,17'));
        // $this->condition_values = array($employee, $year);
        // $this->group_by = array('YEAR(date)', 'MONTH(date)');
        // $this->query_generate();
        // $datas = $this->query_fetch();
        // return $datas;

        $this->flush();
        $this->sql_query = 'SELECT ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_oncall_time, MONTH(date) as month, YEAR(date) as year 
        FROM (
            ( SELECT  date, time_from, time_to FROM `timetable` WHERE employee = ? AND YEAR(date) = ? AND status = 1 AND (type IN ( 3,9,13,14,17 )) ) 
            UNION 
            ( SELECT  date, time_from, time_to FROM `backup_timetable` WHERE employee = ? AND YEAR(date) = ? AND status = 1 AND (type IN ( 3,9,13,14,17 )) ) 
        ) As sample1
        GROUP BY YEAR(date), MONTH(date)';
        $this->condition_values = array($employee, $year, $employee, $year);
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_oncall_hours($employee, $year){
        $this->flush();
        $oncall_hours = array();
        $this->sql_query = "SELECT t.id, t.employee, t.customer, t.fkkn, MONTH(t.date) AS date_month, t.date, t.time_from, t.time_to, t.type, t.status, ROUND(time_to_sec(timediff(time(replace(cast(t.time_to as char),'.',':')) , time(replace(cast(t.time_from as char),'.',':'))))/3600,2) AS oncall_time FROM timetable t WHERE t.employee = '$employee' AND YEAR(t.date) = '$year' AND t.status = 1 AND (t.type IN ( 3,9,13,14,17 )) UNION SELECT bt.id, bt.employee, bt.customer, bt.fkkn, MONTH(bt.date) AS date_month, bt.date, bt.time_from, bt.time_to, bt.type, bt.status, ROUND(time_to_sec(timediff(time(replace(cast(bt.time_to as char),'.',':')) , time(replace(cast(bt.time_from as char),'.',':'))))/3600,2) AS oncall_time FROM backup_timetable bt WHERE bt.employee = '$employee' AND YEAR(bt.date) = '$year' AND bt.status = 1 AND (bt.type IN ( 3,9,13,14,17 ))";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach ($datas as $data) {
                $oncall_hours[$data['date_month']]['datas'][] = $data;
                $oncall_hours[$data['date_month']]['total_oncall_time'] += $data['oncall_time'];
            }
        }
        return $oncall_hours;
    }

    function get_employee_slots($employee, $year){
        $this->flush();
        $slots = array();
        $this->sql_query = "SELECT t.id, t.employee, t.customer, t.fkkn, MONTH(t.date) AS date_month, t.date, t.time_from, t.time_to, t.type, t.status, ROUND(time_to_sec(timediff(time(replace(cast(t.time_to as char),'.',':')) , time(replace(cast(t.time_from as char),'.',':'))))/3600,2) AS slot_time FROM timetable t WHERE t.employee = '$employee' AND YEAR(t.date) = '$year' AND t.status = 1 UNION SELECT bt.id, bt.employee, bt.customer, bt.fkkn, MONTH(bt.date) AS date_month, bt.date, bt.time_from, bt.time_to, bt.type, bt.status, ROUND(time_to_sec(timediff(time(replace(cast(bt.time_to as char),'.',':')) , time(replace(cast(bt.time_from as char),'.',':'))))/3600,2) AS slot_time FROM backup_timetable bt WHERE bt.employee = '$employee' AND YEAR(bt.date) = '$year' AND bt.status = 1";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach ($datas as $data) {
                $slots[$data['date_month']]['datas'][] = $data;
            }
        }
        return $slots;
    }

    function get_customer_for_algl_with_role(){
           $this->tables           = array('team');
           $this->fields           = array('DISTINCT customer');
           $this->conditions       = array('AND', 'employee = ?', 'role = ?');
           $this->condition_values = array($_SESSION['user_id'],$_SESSION['user_role']);
           $this->query_generate();
           $tl_accessible_customers_temp = $this->query_fetch();
           foreach ($tl_accessible_customers_temp as $temp_data) {
               $tl_accessible_customers[] = $temp_data['customer'];
           }
           return $tl_accessible_customers = array_column($tl_accessible_customers_temp, 'customer');
    }

    function note_pdf_genaration($notes_detail){
        require_once ('plugins/note_pdf_genaration.class.php');
        $obj_company     = new company();
        $pdf             = new Note_pdf_genarator();
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);

        $pdf->AddPage(); 
        $pdf->heading($company_details);
        $pdf->part1($notes_detail);
        $pdf->description($notes_detail);
        if($notes_detail['cust_name'] != ''){
            $pdf->Output(utf8_decode('Datum_'.$notes_detail['date'].'_'.$notes_detail['customer_name'].'.pdf'), 'I'); 
        }
        else{
            $pdf->Output(utf8_decode('Datum_'.$notes_detail['date'].'.pdf'), 'I'); 
        }

    }

    function get_employee_leaved_vab_timetable_works($employee, $year, $month, $customer = NULL) {
       
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_employee_leaved_vab_timetable_works_process($employee, $year, $month, $customer, 1);
            $query_2_action = $this->get_employee_leaved_vab_timetable_works_process($employee, $year, $month, $customer, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from, time_to';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_employee_leaved_vab_timetable_works_process($employee, $year, $month, $customer, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_employee_leaved_vab_timetable_works_process($employee, $year, $month, $customer, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_employee_leaved_vab_timetable_works_process($employee, $year, $month, $customer = NULL, $mode = 1) {
       
        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        $this->flush();
        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
            't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
        $this->conditions = array('AND', 'month(t.date) = ?', 'year(t.date) = ?', 't.status = 2', 't.employee = ?',
            'l.type = 3', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($month, $year, $employee);
        
        if($customer !== NULL){
            $this->conditions[] = 't.customer = ?';
            $this->condition_values[] = $customer;
        }
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        // $data = $this->query_fetch();
        // return $data;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_employee_vab_leaved_timetable_works($employee, $year, $month, $customer = NULL) {

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->get_employee_vab_leaved_timetable_works_process($employee, $year, $month, $customer, 1);
            $query_2_action = $this->get_employee_vab_leaved_timetable_works_process($employee, $year, $month, $customer, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from, time_to';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->get_employee_vab_leaved_timetable_works_process($employee, $year, $month, $customer, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->get_employee_vab_leaved_timetable_works_process($employee, $year, $month, $customer, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
    }
    function get_employee_vab_leaved_timetable_works_process($employee, $year, $month, $customer = NULL, $mode = 1) {

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        $this->flush();
        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
            't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
        $this->conditions = array('AND', 'month(t.date) = ?', 'year(t.date) = ?', 't.status = 2', 't.employee = ?',
            'l.type = 3', 't.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->condition_values = array($month, $year, $employee);
        
        if($customer !== NULL){
            $this->conditions[] = 't.customer = ?';
            $this->condition_values[] = $customer;
        }
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        // $data = $this->query_fetch();
        // return $data;
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function Customer_employee_vab_details_report($customer, $employee, $year, $month, $print_report = TRUE,  $obj_pdf = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-02-14
         * for: customer-employee sick details report
         * used in: sick report (LSS report) module
         */
            // last edit : 01/06/2018.
            // for leave type 2 (VAB).
        ob_start();
        require_once ('class/company.php');
        require_once ('plugins/pdf_vab_details_report.class.php');
        
        if($obj_pdf !== NULL && is_object($obj_pdf)){
            $pdf = $obj_pdf;
        }
        else{
            $pdf = new PDF_vab_report();
        }
            $obj_company              = new company();
            $inconvenient_process_obj = new inconvenient();
            $equipment                = new equipment();
            $obj_employee             = new employee();

       
        $pdf->login_company_id = $_SESSION['company_id'];
        //$pdf->login_company_id = 8;    //optimal
        
        //---------------------------
        $company_data   = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details   = $this->get_customer_details($customer);
        $emp_details    = $this->get_employee_details($employee);
        $sign_details   = $this->get_employee_signing_details($employee, $month, $year, $customer);
        $sick_details   = $this->get_employee_leaved_vab_timetable_works($employee, $year, $month, $customer);
        
        $sdate = date('Y-m-d', strtotime($year.'-'.$month.'-01'));
        $end_day_of_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $edate = date('Y-m-d', strtotime($year.'-'.$month.'-'.$end_day_of_month));
        
        $distinct_ob_field_names = array();
        $temp_distinct_ob_field_names = array();
        $all_inconv_names = $obj_employee->get_inconvenient_names(NULL, 0);
        if(!empty($all_inconv_names)){
            foreach($all_inconv_names as $inc_name)
                $distinct_ob_field_names[] = $inc_name['name'];
            
            $distinct_ob_field_names = array_unique($distinct_ob_field_names);  //removing dublicate column headings
            //echo "<pre>aa".print_r($distinct_ob_field_names, 1)."</pre>";
            
            //sorting as fixed format   - sorting column as OB kväll, OB natt, OB helg, etc
            if(in_array('OB kväll', $distinct_ob_field_names)) {
                $temp_distinct_ob_field_names[] = 'OB kväll';
                if(($dkey = array_search('OB kväll', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
            }
            if(in_array('OB natt', $distinct_ob_field_names)) {
                $temp_distinct_ob_field_names[] = 'OB natt';
                if(($dkey = array_search('OB natt', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
            }
            if(in_array('OB helg', $distinct_ob_field_names)) {
                $temp_distinct_ob_field_names[] = 'OB helg';
                if(($dkey = array_search('OB helg', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
            }
            $distinct_ob_field_names = array_values($distinct_ob_field_names);
            
            //if(!empty($distinct_ob_field_names)){
                //foreach($distinct_ob_field_names as $inc_name){
                    //$temp_distinct_ob_field_names[] = $inc_name['name'];
                //}
            //}
            
            $distinct_ob_field_names = array_merge($distinct_ob_field_names, $temp_distinct_ob_field_names);
        }
        
        //if company salary system is "Hogia-Lön": include all oncall-inconvenient types
        if($company_data['salary_system'] == 3){
            $all_inconv_names = $obj_employee->get_inconvenient_names(NULL, 3);
            if(!empty($all_inconv_names)){
                foreach($all_inconv_names as $inc_name)
                    $distinct_ob_field_names[] = $inc_name['name'];
                
                $distinct_ob_field_names = array_unique($distinct_ob_field_names);  //removing dublicate column headings
                
                $temp_distinct_ob_field_names = array();
                //sorting as fixed format   - sorting column as Jour Vardag, Jour helg, etc
                if(in_array('Jour Vardag', $distinct_ob_field_names)) {
                    $temp_distinct_ob_field_names[] = 'Jour Vardag';
                    if(($dkey = array_search('Jour Vardag', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
                }
                if(in_array('Jour helg', $distinct_ob_field_names)) {
                    $temp_distinct_ob_field_names[] = 'Jour helg';
                    if(($dkey = array_search('Jour helg', $distinct_ob_field_names)) !== false) unset($distinct_ob_field_names[$dkey]);
                }
                $distinct_ob_field_names = array_values($distinct_ob_field_names);

                $distinct_ob_field_names = array_merge($distinct_ob_field_names, $temp_distinct_ob_field_names);
            }
        }
        if($pdf->login_company_id != 8)
            $distinct_ob_field_names[] = '__holiday_helg__';        // Holiday - Helg 
        else if($pdf->login_company_id == 8 && !in_array('OB helg', $distinct_ob_field_names))  //OB helg = ( OB helg and holidays<helg>)
        //     $distinct_ob_field_names[] = 'OB helg';
        $distinct_ob_field_names[] = '__holiday__';             // Holiday - Storhelg 
        
        if (!empty($sick_details)) {
            
            $oncall_included_slot_types = array(3, 9, 13, 14, 17);
            
            foreach($sick_details as $key => $sick){
                //echo "-----------<pre>sick_details $key: ".print_r($sick, 1)."</pre>";
                $inconvenient_process_obj->reset_inconvenient_variables();
                /*$inconvenient_process_obj->inconv_normal_slots = array($sick);
                $inconvenient_process_obj->inconv_normal_category = $obj_employee->get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $employee, 1);
                $inconvenient_process_obj->inconv_oncall_category = array();
                $inconvenient_process_obj->leave_category = array();
                $inconvenient_process_obj->holidays = $obj_employee->get_holiday_details($month, $year);*/
                
                $inconvenient_process_obj->inconv_normal_slots = array($sick);
                if($pdf->login_company_id == 8 && in_array($sick['type'], $oncall_included_slot_types))
                    $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $sdate, $edate, $customer, 0);
                else
                    $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $sdate, $edate, $customer);
                $inconvenient_process_obj->categorize_salary_hours();
                
                $holiday_names = $inconv_norm_category_names = $inconv_oncall_category_names = array();
                if(!empty($inconvenient_process_obj->holidays)){
                    foreach($inconvenient_process_obj->holidays as $this_holi){
                        //$holiday_names[] = $this_holi['name'];
                        $holiday_names[$this_holi['name']] = array('name' => $this_holi['name'], 'type' => $this_holi['type']);
                    }
                }
                //echo "<pre>".print_r($inconvenient_process_obj->inconv_oncall_category, 1)."</pre>";
                //echo "<pre>".print_r($holiday_names, 1)."</pre>";
                if(!empty($inconvenient_process_obj->inconv_normal_category)){
                    foreach($inconvenient_process_obj->inconv_normal_category as $this_norm_cat){
                        $inconv_norm_category_names[] = $this_norm_cat['name'];
                    }
                }
                if($company_data['salary_system'] == 3 || $pdf->login_company_id == 8){
                    if(!empty($inconvenient_process_obj->inconv_oncall_category)){
                        foreach($inconvenient_process_obj->inconv_oncall_category as $this_oncall_cat){
                            $inconv_oncall_category_names[] = $this_oncall_cat['name'];
                        }
                    }
                }
                
                if(!empty($inconvenient_process_obj->salary_hours)){
                    foreach($inconvenient_process_obj->salary_hours as $sal_date => $params){
                        foreach($params as $key_name => $key_hours){
                            
                            //find sum of key hours.. if it is an array of hours
                            if(is_array($key_hours)){
                                $tmp_key_hours = 0;
                                foreach($key_hours as $h){
                                    $tmp_key_hours = $equipment->time_sum($tmp_key_hours, $h);
                                }
                                $key_hours = $tmp_key_hours;
                            }
                            
                            if(in_array($key_name, array_keys($holiday_names))){
                                $temp_holiday_key_index = $holiday_names[$key_name]['type'] == 1 ? '__holiday_helg__' : '__holiday__';
                                if($pdf->login_company_id == 8){
                                    //optimal treat OB helg = ( OB helg and holidays<helg>) => so merge it
                                    if($temp_holiday_key_index == '__holiday_helg__') $temp_holiday_key_index = 'OB helg';
                                }
                                if(isset($sick_details[$key]['inconv_details'][$temp_holiday_key_index]))
                                    $sick_details[$key]['inconv_details'][$temp_holiday_key_index] = $equipment->time_sum($sick_details[$key]['inconv_details'][$temp_holiday_key_index], $key_hours);
                                else
                                    $sick_details[$key]['inconv_details'][$temp_holiday_key_index] = $key_hours;
                                
                            }
                            else if(in_array($key_name, $inconv_norm_category_names)){
                                $sick_details[$key]['inconv_details'][$key_name] = $key_hours;
                               // if(!in_array($key_name, $distinct_ob_field_names)) $distinct_ob_field_names[] = $key_name;
                            }
                            else if(in_array($key_name, $inconv_oncall_category_names) && ($company_data['salary_system'] == 3 || $pdf->login_company_id == 8)){
                                $sick_details[$key]['inconv_details'][$key_name] = $key_hours;
                               // if(!in_array($key_name, $distinct_ob_field_names)) $distinct_ob_field_names[] = $key_name;
                            }
                        }
                        
                    }
                }
            }
        }
        
       // echo "<pre>Final sick_details".print_r($sick_details, 1)."</pre>";
        
        
        //----------------------------------------------
        $this->leavePeriod_month = $month;
        $this->leavePeriod_year = $year;
        $this->leave_customer = $customer;
        $this->leave_employee = $employee;
        
       // ob_clean();
        if(!empty($sick_details)){
            $sick_details_partition = array_chunk($sick_details, 20);   //array split as 20 rows
            foreach($sick_details_partition as $ind => $sick_datas){
                $pdf->AddPage();
                $pdf->report_header($year, $month, $company_data, $cust_details, $emp_details);
                $pdf->content_table_generation($sick_datas, $distinct_ob_field_names, $company_data['salary_system']);
                $pdf->signing_part($emp_details, $sign_details);
                $pdf->Page_footer_content($company_data);
            }
        }
        
        if($print_report){
            $pdf->Output(utf8_decode('VAB-Avvikelserapport').'_'.$customer.'_'.date('ymdHi').'.pdf', 'I');
            ob_end_flush();
           // $pdf->Output();
        }else 
            return $pdf;
    }

    function Customer_pdf_work_report_from_vab_report($customer, $employee, $year, $month, $print_report = TRUE, $obj_pdf = NULL) {
        /**
         * Author: Shamsu
         * for: customer-employee work report
         * used in sick report
         */
        require_once ('class/company.php');
        require_once ('plugins/pdf_emp_cust_work_report_for_vab_rpt.class.php');
        
        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_work_rpt_from_vab();
            
        $obj_company = new company();
        $obj_equipment = new equipment();
       // $obj_employee = new employee();
        $pdf->tot_normal = 0;
        $pdf->tot_oncall = 0;
        $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details = $this->get_customer_details($customer);

        //ob_clean();
        $list_relations = $obj_equipment->relations_leave_vab_employee($month, $year, $customer, $employee);
        $list_relations_grouped = array();
        if(!empty($list_relations)){
            foreach ($list_relations as $rel_works) {
                $list_relations_grouped[$rel_works['employee_id']][] = $rel_works;
            }
        }

        // get karense days--------------------------------------------
        $sick_details = $this->get_employee_leaved_vab_timetable_works($employee, $year, $month, $customer);
        $this->leavePeriod_month= $month;
        $this->leavePeriod_year = $year;
        $this->leave_customer   = $customer;
        $this->leave_employee   = $employee;

        $pdf->setSourceFile('./pdf_forms/Shortened_work_rpt.pdf');
        
        $flag_work_exist = FALSE;
        if(!empty($list_relations_grouped)){
            foreach($list_relations_grouped as $vikarie_emp => $work_details){
                $emp_details = $this->get_employee_details($vikarie_emp);
                $sign_details = $this->get_employee_signing_details($vikarie_emp, $month, $year, $customer);

                if(!empty($work_details)){
                    $work_partition = array_chunk($work_details, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
                    
                    if(!empty($work_partition)){
                        foreach ($work_partition as $works) {
                            $flag_work_exist = TRUE;
                            $pdf->AddPage();
                            $tppl = $pdf->importPage(1);
                            $pdf->useTemplate($tppl, -2, 0, 210);

                            $pdf->report_top($company_data, $month, $year);
                            $pdf->SubPart1($cust_details);
                            $pdf->SubPart2($emp_details);
                            $pdf->SubPart3_table($works);
                            $pdf->SubPart4($emp_details, $sign_details);
                            $pdf->Page2_footer($company_data);
                        }
                    }
                }
            }
        }
        
        if(!$flag_work_exist){
            $smarty = new smartySetup(array("reports.xml"),FALSE);
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            $pdf->SetXY(13, 50);
            $pdf->Cell(180, 7, utf8_decode($smarty->translate['no_work_data_available']), 0, 0, 'C', FALSE);
        }
        
        if($print_report){
            $pdf->Output(utf8_decode('VAB-Arbetsrapport').'_'.$customer.'_'.date('ymdHi').'.pdf', 'I');
            // $pdf->Output();
        }else 
            return $pdf;
    }

    function Customer_pdf_vikarie_details_report($relations, $company_details, $basic_details, $tot_time_sum,$pdf){
        // require_once('plugins/pdf_leave_payment_edited.class.php');

        // $pdf                  = new PDF_replacement_employee_report();
        $pdf->relations       = $relations;
        $pdf->company_details = $company_details;
        $pdf->basic_details   = $basic_details;
        $pdf->tot_time_sum    = number_format($tot_time_sum,2);
        $pdf->AddPage();
        $pdf->main_part();
        return $pdf;
        exit();
    }

    function get_timeslots_on_daylight($daylight_saving_date){
        $datas = array();
        $this->sql_query = "SELECT t.id as slot_id, t.employee, t.customer, t.time_from, t.time_to,t.type,t.fkkn,t.alloc_emp,t.relation_id,t.status,t.created_status
        FROM `timetable` t 
        WHERE t.date = '".$daylight_saving_date."' AND ((t.time_from >=2  AND t.time_from <3) OR (t.time_to > 2 AND t.time_to <=3) OR (t.time_from < 2 AND t.time_to > 3)) AND t.created_status IS NULL";
        $datas = $this->query_fetch();
        return $datas;

    }

    function Customer_pdf_vikarie_3059_from_sick_report($customer, $employee, $year, $month, $print_report = TRUE, $obj_pdf = NULL) {
        /**
         * Author: Shamsu
         * for: customer-employee work report
         * used in sick report
         */
        require_once ('class/company.php');
        
        if($obj_pdf !== NULL && is_object($obj_pdf))
            $pdf = $obj_pdf;
        else
            $pdf = new PDF_customer();
            
        $obj_company    = new company();
        $obj_equipment  = new equipment();
        $obj_convertor  = new Converter(array(),array(), $year);
        $obj_general    = new general();
        $obj_employee   = new employee();

        $pdf->tot_normal= 0;
        $pdf->tot_oncall= 0;
        $pdf->tot_beredskap = 0;
        $company_data   = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details   = $this->get_customer_details($customer);

        $this->leavePeriod_month    = $month;
        $this->leavePeriod_year     = $year;
        $this->leave_customer       = $customer;
        $this->leave_employee       = $employee;

        // get karense days--------------------------------------------
        // $sick_details = $this->get_employee_leaved_timetable_works($employee, $year, $month, $customer);
        $sick_details = $this->get_employee_leaved_timetable_works($employee, $year, $month);
        $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($sick_details, 'date');

        $karense_dataset        = $obj_convertor->get_karens_data($employee, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $month, $year, null, 0.00, 24.00, FALSE,'FROM_FORM');
        if($karense_dataset) $karense_dataset = array_values($karense_dataset);

        //calculate qualifying date groups
        $qualifying_date_bounderies = array();
        if($karense_dataset){
            foreach ($karense_dataset as $karense_data){
                $date1 = $date2 = NULL;
                if(isset($karense_data['karens']) && !empty($karense_data['karens'])){
                    reset($karense_data['karens']);         //reset pointer to its first element (0 index)
                    $date1 = key($karense_data['karens']);  //get first key name from the array
                    end($karense_data['karens']);           //navigate pointer to end
                    $date2 = key($karense_data['karens']);  //get last key name from the array
                }

                if(isset($karense_data['non_karens_2_14']) && !empty($karense_data['non_karens_2_14'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_2_14']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_2_14']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_2_14']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_2_14']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if(isset($karense_data['non_karens_15_180']) && !empty($karense_data['non_karens_15_180'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_15_180']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_15_180']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_15_180']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_15_180']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if(isset($karense_data['non_karens_180_onwards']) && !empty($karense_data['non_karens_180_onwards'])){
                    if($date1 == NULL){
                        reset($karense_data['non_karens_180_onwards']);         //reset pointer to its first element (0 index)
                        $date1 = key($karense_data['non_karens_180_onwards']);  //get first key name from the array
                    }
                    end($karense_data['non_karens_180_onwards']);           //navigate pointer to end
                    $date2__ = key($karense_data['non_karens_180_onwards']);
                    if(strtotime($date2) < strtotime($date2__))
                        $date2 = $date2__;
                }
                if($date1 == NULL) $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                if($date2 == NULL) $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));
                $qualifying_date_bounderies[] = array('date1' => $date1, 'date2' => $date2);
            }
        }
        else{
            $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
            $date2 = date('Y-m-t', strtotime($this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01"));
            $qualifying_date_bounderies[] = array('date1' => $date1, 'date2' => $date2);
        }
        // echo "<pre>".print_r($qualifying_date_bounderies, 1)."</pre>";

        $list_relations         = $obj_equipment->relations_leave_employee($month, $year, $customer, $employee);
        $list_relations         = $this->crop_vikarie_slots_based_on_its_parent($list_relations, $all_leave_works_grouped, $customer);

        $list_relations_grouped = array();
        if(!empty($list_relations)){
            foreach ($list_relations as $rel_works) {
                $list_relations_grouped[$rel_works['employee_id']][] = $rel_works;
            }
        }
        // get karense days-- end------------------------------------------

        //$pdf->setSourceFile('./pdf_forms/FK3059_015_F_001__16_08_25.pdf');
		$pdf->setSourceFile('./pdf_forms/FK3059_016_F_003.pdf');
        
        $flag_work_exist = FALSE;
        if(!empty($list_relations_grouped)){
            foreach($list_relations_grouped as $vikarie_emp => $work_details){
                $emp_details    = $this->get_employee_details($vikarie_emp);
                $sign_details   = $this->get_employee_signing_details($vikarie_emp, $month, $year, $customer);
                $employer_sign_details = $obj_employee->employer_signing_details($customer, $month, $year, 1, $vikarie_emp);

                $tmp_calculation_start_month = ($emp_details[0]['employee_contract_start_month'] != '' ? $emp_details[0]['employee_contract_start_month'] : ($company_data['employee_contract_start_month'] != '' ? $company_data['employee_contract_start_month'] : 1));
                $calculation_period_length = ($emp_details[0]['employee_contract_period_length'] != '' && $emp_details[0]['employee_contract_start_month'] != '' ?  $emp_details[0]['employee_contract_period_length'] : ($company_data['employee_contract_period_length'] != '' ? $company_data['employee_contract_period_length'] : 1));
                $calculation_period_month_start_date = ($emp_details[0]['employee_contract_period_date'] != '' && $emp_details[0]['employee_contract_start_month'] != '' ?  $emp_details[0]['employee_contract_period_date'] : ($company_data['employee_contract_period_date'] != '' ? $company_data['employee_contract_period_date'] : 1));
                $flag_found_calculation_period = FALSE;
                $is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
                $is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;
                $contract_calculation_values = array();
                $contract_calculation_previous_values = array();

                if(!$is_month_starting_first_date){     //for keeping previous calculation period
                    $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
                    $pre_year_start = $year;
                    if($pre_month_start < 1){
                        $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
                        $pre_year_start--;
                    }

                    $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
                    if($is_month_starting_last_date){
                        $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($year.'-'.$tmp_calculation_start_month.'-01'));
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                    }else
                        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
                }

                while(!$flag_found_calculation_period){
                    $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
                    if($tmp_calculation_end_month > 12){
                        if(($tmp_calculation_start_month <= $month && $month <= 12) || (1 <= $month && $month <= ($tmp_calculation_end_month-12))){
                            $flag_found_calculation_period = TRUE;
                            $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
                            if($tmp_calculation_start_month <= $month && $month <= 12){
                                $contract_calculation_values['start_year'] = $year;
                                $contract_calculation_values['end_year'] = $year+1;
                            }else {
                                $contract_calculation_values['start_year'] = $year - 1;
                                $contract_calculation_values['end_year'] = $year;
                            }
                        } 
                        else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                            $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
                            $contract_calculation_previous_values['start_year'] = $year;
                            $contract_calculation_previous_values['end_year'] = $year+1;
                        }
                    }else {
                        if($tmp_calculation_start_month <= $month && $month <= $tmp_calculation_end_month){
                            $flag_found_calculation_period = TRUE;
                            $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
                            $contract_calculation_values['start_year'] = $year;
                            $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($year+1) : $year;
                        }
                        else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                            $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
                            $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
                            $contract_calculation_previous_values['start_year'] = $year;
                            $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($year+1) : $year;
                        }
                    }
                    if($flag_found_calculation_period){
                        if($is_month_starting_first_date)
                            $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
                        else
                            $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

                        if($is_month_starting_first_date)
                            $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
                        else{
                            $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
                            if($is_month_starting_last_date){
                                $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                                $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
                            }else{
                                $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                            }
                        }
                    }
                    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
                        $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

                        $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
                        if($is_month_starting_last_date){
                            $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                            $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
                        }else{
                            $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
                        }
                    }
                    $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
                }

                $is_rpt_smonth_equal_calc_smonth = date('m', strtotime($contract_calculation_values['start_date'])) == $month ? TRUE : FALSE;
                $calculation_period_start_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['start_date'] : $contract_calculation_values['start_date']);
                $calculation_period_end_date = (!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth ? $contract_calculation_previous_values['end_date'] : $contract_calculation_values['end_date']);

                $calculation_end_date = '';
                if(date('m', strtotime($calculation_period_end_date)) == $month)
                        $calculation_end_date = $calculation_period_end_date;
                else
                        $calculation_end_date = date('Y-m-t', strtotime("$year-$month-01"));
                
                $employee_period_actual_hours = $this->customer_employee_total_actual_hours_btwn_dates($customer, $calculation_period_start_date, $calculation_end_date, 1, $vikarie_emp, array(1,2,7,8,9,10,11,15,16,17));
                
                $special_calculation_array = array();
                if(!$is_month_starting_first_date && $is_rpt_smonth_equal_calc_smonth){
                    $special_calculation_array['calculation_period_start_date'] = $contract_calculation_values['start_date'];
                    $special_calculation_array['calculation_period_end_date'] = $contract_calculation_values['end_date'];
                    
                    $special_calculation_array['calculation_end_date'] = '';
                    if(date('m', strtotime($contract_calculation_values['end_date'])) == $month)
                            $special_calculation_array['calculation_end_date'] = $contract_calculation_values['end_date'];
                    else
                            $special_calculation_array['calculation_end_date'] = date('Y-m-t', strtotime("$year-$month-01"));
                    
                    $tmp_special_calc_employee_period_actual_hours = $this->customer_employee_total_actual_hours_btwn_dates($customer, $special_calculation_array['calculation_period_start_date'], $special_calculation_array['calculation_end_date'], 1, $vikarie_emp, array(1,2,7,8,9,10,11,15,16,17));
                    $special_calculation_array['total_actual_hours'] = round($tmp_special_calc_employee_period_actual_hours['TOTAL_NORMAL'] + $tmp_special_calc_employee_period_actual_hours['TOTAL_ONCALL'] + $tmp_special_calc_employee_period_actual_hours['TOTAL_BEREDSKAP'], 2);
                }

                $defaults = $this->check_exists_fkkn_form_defaults($customer, $vikarie_emp, TRUE);
                $this_bargaining = $txt_other_bargaining = $provider_of_pa = NULL;
                $this_agreement = array();
                if(!empty($defaults)){
                    $this_bargaining = $defaults[0]['bargaining_new'];
                    $txt_other_bargaining = NULL;
                    $provider_of_pa = $defaults[0]['provider_of_pa_flag'];
                    if($provider_of_pa == 2){
                        $this_agreement['type'] = $defaults[0]['agreement_types_new'];
                        $this_agreement['type2_company'] = $defaults[0]['agreement_type2_company'];
                        $this_agreement['type2_orgno'] = $defaults[0]['agreement_type2_orgNo'];
                        $this_agreement['company_cp_name'] = $defaults[0]['company_cp_name'];
                        $this_agreement['company_cp_phone'] = $obj_general->format_mobile($defaults[0]['company_cp_phone']);
                    }
                }

                $qdate_partioned_work_details = array();
                if(!empty($work_details)){
                    foreach($work_details as $w_data){
                        if(!empty($qualifying_date_bounderies)){
                            foreach($qualifying_date_bounderies as $qd){
                                if($w_data['date'] >= $qd['date1'] && $w_data['date'] <= $qd['date2']){
                                    $qdate_partioned_work_details[strtotime($qd['date1'])][] = $w_data;
                                    break;
                                }
                            }
                        }
                    }
                }
                // echo '<pre>'.print_r($qdate_partioned_work_details, 1).'</pre>';

                if(!empty($qdate_partioned_work_details)){
                    foreach ($qdate_partioned_work_details as $qp_works) {
                        $work_partition = array_chunk($qp_works, 40);   //chunk data in to 31 rows, because max 31 entries included @ one page
                        
                        if(!empty($work_partition)){
                            foreach ($work_partition as $works) {
                                $flag_work_exist = TRUE;
                                $pdf->AddPage();
                                $tppl = $pdf->importPage(1);
                                $pdf->useTemplate($tppl);
                                $pdf->report_top($month, $year, 1);
                                $pdf->SubPart1($cust_details);
                                $pdf->SubPart2($emp_details);
                                $pdf->SubPart3($this_bargaining);
                                $pdf->SubPart4($calculation_period_start_date, $calculation_period_end_date, $employee_period_actual_hours, $special_calculation_array);    // this new block since 2014-07-16
                                $pdf->SubPart5($company_data, $this_agreement, $provider_of_pa);  // Currently this is section 5  since 2016-08-26
                                $pdf->SubPart6($employer_sign_details);

                                $pdf->AddPage();
                                $tppl = $pdf->importPage(3);
                                $pdf->useTemplate($tppl);
                                $pdf->page2_3059_header($month, $year, $cust_details, $emp_details);
                                $pdf->SubPart7_table($works);
                                $pdf->SubPart8($emp_details, $sign_details);
                            }
                        }
                    }
                }
            }
        }
        
        if(!$flag_work_exist){
            $smarty = new smartySetup(array("reports.xml"),FALSE);
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            $pdf->SetXY(13, 50);
            $pdf->Cell(180, 7, utf8_decode($smarty->translate['no_work_data_available']), 0, 0, 'C', FALSE);
        }
        // $pdf->Output();
        
        if($print_report){
            $pdf->Output(utf8_decode('Vikarie_3057').'_'.$customer.'_'.date('ymdHi').'.pdf', 'D');
            // $pdf->Output();
        }else 
            return $pdf;
    }
}
?>