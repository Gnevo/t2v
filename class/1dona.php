<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of dona
 *
 * @author dona
 */
require_once ('class/user.php');
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/inconvenient.php');        // for inconvenient processing
require_once ('plugins/customize_pdf_customer_work_report.class.php');
require_once ('plugins/customize_pdf_employee_contract.class.php');
require_once ('plugins/customize_pdf_financial_payment.class.php');

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
        if (!empty($datas))
            return $datas;
        else
            return FALSE;
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
        if (!empty($datas))
            return $datas;
        else
            return FALSE;
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

    function employee_privilege() {

        $privileges = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $this->user_role($login_user);
        $customers = $this->customer_list();
        $employees = $this->employee_list();
        switch ($login_user_role) {

            case 1:
                foreach ($customers as $customer) {

                    $privileges[$customer['username']] = array('link' => 1);
                }
                foreach ($employees as $employee) {

                    $privileges[$employee['username']] = array('link' => 1);
                }
                break;

            case 2:
                $team_customers = $this->team_customers($login_user);
                $team_members = $this->team_members($login_user);
                foreach ($customers as $customer) {

                    if (in_array($customer['username'], $team_customers)) {

                        $privileges[$customer['username']] = array('link' => 1);
                    } else {

                        $privileges[$customer['username']] = array('link' => 0);
                    }
                }
                foreach ($employees as $employee) {
                    if (in_array($employee['username'], $team_members)) {

                        $privileges[$employee['username']] = array('link' => 1);
                    } else {

                        $privileges[$employee['username']] = array('link' => 0);
                    }
                }
                break;
            case 3:
                $team_customers = $this->team_employee_customers($login_user);
                foreach ($customers as $customer) {

                    if (in_array($customer['username'], $team_customers)) {

                        $privileges[$customer['username']] = array('link' => 1);
                    } else {

                        $privileges[$customer['username']] = array('link' => 0);
                    }
                }
                foreach ($employees as $employee) {
                    if ($employee['username'] == $login_user) {

                        $privileges[$employee['username']] = array('link' => 1);
                    } else {

                        $privileges[$employee['username']] = array('link' => 0);
                    }
                }
                break;
        }
        return $privileges;
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

    function timetable_week($customers, $employees, $year_week) {

        global $week;

        $privileges = $this->employee_privilege();

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

//getting customer loop
        $datas = array();
        $i = 0;
        if (!empty($customers)) {

            foreach ($customers as $customer) {

//getting into employee loop
                $j = 0;
                if (!empty($employees)) {

                    foreach ($employees as $employee) {

                        $datas[$i][$j]['customer'] = $customer;
                        $datas[$i][$j]['employee'] = $employee;
                        $carry_fwd_time = 0;
                        $day_array = array();
                        foreach ($week as $day) {

                            $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
//getting if it is leave
                            $leave = 0;
                            $leave_data = $this->employee_leave_day($employee['username'], $date);
                            if (!empty($leave_data)) {
                                $leave = 1;
                            }
//getting toatal time for perticulal user and cusomer for the date
                            $time = $this->timetable_customer_employee_time($customer['username'], $employee['username'], $date, $carry_fwd);
                            $total_time = $time['time'];
                            $carry_fwd = $time['carry_fwd'];

                            $day_array[] = array('day' => $day['label'], 'date' => $date, 'time' => $total_time, 'leave' => $leave);
                        }
                        $datas[$i][$j]['week'] = $day_array;
                        $j++;
                    }
                }
                $i++;
            }

            return $datas;
        } else {

            return FALSE;
        }
    }

    function timetable_day($customers, $employees, $date) {

        global $week;

//getting customer loop
        $datas = array();
        $i = 0;
        if (!empty($customers)) {

            foreach ($customers as $customer) {

//getting into employee loop
                $j = 0;
                if (!empty($employees)) {

                    foreach ($employees as $employee) {

                        $datas[$i][$j]['customer'] = $customer;
                        $datas[$i][$j]['employee'] = $employee;
                        $carry_fwd_time = 0;
//getting if it is leave
                        $leave = 0;
                        $leave_data = $this->employee_leave_day($employee['username'], $date);
                        if (!empty($leave_data)) {
                            $leave = 1;
                        }
                        $datas[$i][$j]['date'] = $date;
                        $datas[$i][$j]['leave'] = $leave;
//getting toatal time for perticulal user and cusomer for the date
                        $slots = $this->timetable_customer_employee_slots($customer['username'], $employee['username'], $date);
                        $datas[$i][$j]['slots'] = $slots;
                        $j++;
                    }
                }
                $i++;
            }
            return $datas;
        } else {

            return FALSE;
        }
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
        /*
          //checking overlapping time
          if ($time_data['time_to'] > 24) {

          $cur_carry_fwd = ($time_data['time_to'] - 24);
          $total_time -= $cur_carry_fwd;
          } else {

          $cur_carry_fwd = 0;
          }
         */
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
        if (!empty($contract_data)) {

            return $contract_data;
        } else {

            return FALSE;
        }
    }

    function employee_timetable_week_time($employee, $year_week) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;
        /*
          //getting carry forwaord from sunday
          $date = date("Y-m-d", strtotime($year . 'W' . $week_no . 0));
          $this->tables = array('timetable');
          $this->fields = array('SUM(time_to - time_from) AS total_time', 'time_to');
          $this->conditions = array('AND', 'employee = ?', 'date = ?', 'status = ?');
          $this->condition_values = array($customer, $date, 1);
          $this->query_generate();
          $data_time = $this->query_fetch();
          $time_data = $data_time[0];
          if ($time_data['time_to'] > 24) {

          $total_alloc_time = $time_data['time_to'] - 24;
          }
         */
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

        /*
          //reduse the overlapping time if their
          $date = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
          $this->tables = array('timetable');
          $this->fields = array('SUM(time_to - time_from) AS total_time', 'time_to');
          $this->conditions = array('AND', 'employee = ?', 'date = ?', 'status = ?');
          $this->condition_values = array($employee, $date, 1);
          $this->query_generate();
          $data_time = $this->query_fetch();
          $time_data = $data_time[0];
          if ($time_data['time_to'] > 24) {

          $total_alloc_time -= ($time_data['time_to'] - 24);
          }
         */
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
        } else {

            return FALSE;
        }
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
        if (!empty($employee_pending)) {

            return $employee_pending;
        } else {

            return FALSE;
        }
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
        if (!empty($contract_data)) {

            return $contract_data;
        } else {

            return FALSE;
        }
    }

    function customer_timetable_week_time($customer, $year_week) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;
        /*
          //getting carry forwaord from sunday
          $date = date("Y-m-d", strtotime($year . 'W' . $week_no . 0));
          $this->tables = array('timetable');
          $this->fields = array('SUM(time_to - time_from) AS total_time', 'time_to');
          $this->conditions = array('AND', 'customer = ?', 'date = ?', 'status = ?');
          $this->condition_values = array($customer, $date, 1);
          $this->query_generate();
          $data_time = $this->query_fetch();
          $time_data = $data_time[0];
          if ($time_data['time_to'] > 24) {

          $total_alloc_time = $time_data['time_to'] - 24;
          }
         */

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
        /*
          //reduse the overlapping time if their
          $date = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
          $this->tables = array('timetable');
          $this->fields = array('SUM(time_to - time_from) AS total_time', 'time_to');
          $this->conditions = array('AND', 'customer = ?', 'date = ?', 'status = ?');
          $this->condition_values = array($customer, $date, 1);
          $this->query_generate();
          $data_time = $this->query_fetch();
          $time_data = $data_time[0];
          if ($time_data['time_to'] > 24) {

          $total_alloc_time -= ($time_data['time_to'] - 24);
          }
         */
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
        } else {

            return FALSE;
        }
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
        if (!empty($customer_pending)) {

            return $customer_pending;
        } else {

            return FALSE;
        }
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
    function employee_slot_type_update($id, $type, $time_from = '', $time_to = '') {
//        if ($type == 0) {
//            $status = 1;
//            $slot_det = $this->customer_employee_slot_details($id);
//            if ($slot_det['customer'] == '' || $slot_det['employee'] == '')
//                $status = 0;
//            $this->tables = array('timetable');
//            $this->fields = array('type', 'status');
//            $this->field_values = array($type, $status);
//            $this->conditions = array('id = ?');
//            $this->condition_values = array($id);
//            if ($this->query_update()) {
//                return true;
//            } else {
//                return false;
//            }
//        } else {
            $slot_det = $this->customer_employee_slot_details($id);
            $slot_from = $slot_det['time_from'];
            $slot_to = $slot_det['time_to'];

            if ($time_from == $slot_from && $time_to == $slot_to) {// for same shift only changing the type and status 1
               
                $this->tables = array('timetable');
                $this->fields = array('type');
                $this->field_values = array($type);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                if ($this->query_update()) {
                    return true;
                } else {
                    return false;
                }
            } else if ($time_from == $slot_from && $time_to != $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
                $this->tables = array('timetable');
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp']);
                if ($this->query_insert()) {

                    $this->tables = array('timetable');
                    $this->fields = array('time_from');
                    $this->field_values = array($time_to);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($id);
                    if ($this->query_update()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else if ($time_from != $slot_from && $time_to == $slot_to) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
                $slot_det = $this->customer_employee_slot_details($id);
                $this->tables = array('timetable');
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp');
                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp']);
                if ($this->query_insert()) {
                    $this->tables = array('timetable');
                    $this->fields = array('time_to');
                    $this->field_values = array($time_from);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($id);
                    if ($this->query_update()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {// if slot adds in between updating exiting with new type and status 1 and adding new 2 slots with previous data
                $slot_det = $this->customer_employee_slot_details($id);


                $this->tables = array('timetable');
                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp');
                $this->field_values = array(array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['status'], $slot_det['alloc_emp']),
                    array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['status'], $slot_det['alloc_emp']));
                if ($this->query_insert()) {
                    $this->tables = array('timetable');
                    $this->fields = array('time_from', 'time_to', 'type', 'status');
                    $this->field_values = array($time_from, $time_to, $type, $slot_det['status']);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($id);
                    if ($this->query_update()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        //}
    }

    function employee_slot_split($id, $time_from = '', $time_to = '') {

        $slot_det = $this->customer_employee_slot_details($id);
        $slot_from = $slot_det['time_from'];
        $slot_to = $slot_det['time_to'];

        if ($time_from == $slot_from && $time_to == $slot_to) {// for same shift nothing do
            return true;
        }else if ($time_from == $slot_from && $time_to != $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']);
            if ($this->query_insert()) {

                $this->tables = array('timetable');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                if ($this->query_update()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else if ($time_from != $slot_from && $time_to == $slot_to) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
            $slot_det = $this->customer_employee_slot_details($id);
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']);
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                if ($this->query_update()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {// if slot adds in between updating exiting with new type and status 1 and adding new 2 slots with previous data
            $slot_det = $this->customer_employee_slot_details($id);


            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array(array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']),
                array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']));
            if ($this->query_insert()) {
                $this->tables = array('timetable');
                $this->fields = array('time_from', 'time_to');
                $this->field_values = array($time_from, $time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
                if ($this->query_update()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    //slot addding
    function customer_employee_slot_add($employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = 1, $type = 0, $relation_id = '') {

//        $obj_cust = new customer();
        $obj_emp = new employee();
//$obj_emp = new employee();
        $status = 1;
//        if($_SESSION['fkkn']){
//            $fkkn = $_SESSION['fkkn'];
//        }
//        if($employee != ''){
//            $emp_detail = $this->get_employee_details($employee);
//            if(!empty($emp_detail)){
//                $fkkn = $emp_detail[0]['fkkn'];
//            }
//        }
        if($customer != ''){
            $cust_detail = $this->get_customer_details($customer);
            if(!empty($cust_detail)){
                $fkkn = $cust_detail[0]['fkkn'];
            }
        }

        if ($employee == '' || $customer == '') {
            $status = 0;
            $relation_id = '';
        }
        if ($_SESSION['user_role'] == 4) {
            $status = 3;
        }

        $this->tables = array('timetable');
        if ($relation_id == '') {
            
            $this->fields = array('employee', 'customer', 'fkkn', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp');
            $this->field_values = array($employee, $customer, $fkkn, $type, $date, $time_from, $time_to, $status, $alloc_emp);
        } else {
            
            $this->fields = array('employee', 'customer', 'fkkn', 'type', 'date', 'time_from', 'time_to', 'status', 'relation_id', 'alloc_emp');
            $this->field_values = array($employee, $customer, $fkkn, $type, $date, $time_from, $time_to, $status, $relation_id, $alloc_emp);
        }
        if ($this->query_insert()) {
            return true;
        } else {
            return false;
        }
    }

    //removing skill from a particular slot
    function customer_employee_skill_remove($id, $alloc_emp) {

        $this->tables = array('timetable');
        $this->fields = array('work', 'employee', 'status', 'alloc_emp');
        $this->field_values = array('', '', '0', $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
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
    function customer_employee_multi_slot_details($ids,$status) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if($status){
            $this->conditions = array('AND', array('IN', 'id', $ids), 'status = ?');
            $this->condition_values = array($status);
        }else{
            $this->conditions = array('AND', array('IN','id',$ids));
        }
        $this->order_by = array('date','time_from','time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    //converting an entered time to sixty hours
    function time_to_sixty($time) {
        //$allowed = array(0, 5, 10 15, 30, 45);
        $time_sixty = "";
        if ($time >= 48 && $time <=4800) {
            $minute = intval($time % 100);
            $minute_sixty = intval($time % 100 * 60 / 100);
            if($minute >= 60){
                if($minute_sixty%5 ==0)
                    return ((intval($time / 100))%24 . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                else
                    return false;
            }else if($minute < 60){
                if($minute%5 ==0)
                    return ((intval($time / 100))%24 . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
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

                /*echo "<script>alert(\"".in_array($minute, $allowed)."\")</script>";*/
                $minute_sixty = intval($minute / 100 * 60);
                if($minute >= 60){
                    if($minute_sixty%5 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }else if($minute < 60){
                    if($minute%5 ==0)
                        return ($time_sixty . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }
            else if(substr($time, 0, 2) == '00'){
                
                $time_sixty = 0;
                $minute = intval($time);
                $minute_sixty = intval($minute / 100 * 60);
                if($minute >= 60){
                    if($minute_sixty%5 ==0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }else if($minute < 60){
                    if($minute%5 ==0)
                        return ($time_sixty . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
                
            }else{
                
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
        if ($this->query_delete()){
            if($slot_det['employee'])
                $obj_emp->removeATL($slot_det['employee'], $slot_det['date']);
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
        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '('. $sub_query_from_date .') AS From_date', 
            '('. $sub_query_to_date .') AS To_date',
            'leave.employee as employee',"(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.employee) AS empname", 
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

    function get_all_employee_leave($year = NULL, $month = NULL, $emp = NULL) {
        /**
         * Author: Shamsu
         * for: get all employee leave asper their role
         */
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        
        if ($login_user_role == 7) {
            $get_leaves = array();
            $processed_employees = array();     //used to check previously queried with this employees
            
            /* this section for team leader */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 7);
            foreach($team_customers as $cust_name){
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query
                
                foreach($team_employees as $sel_emp){
                    if(!in_array($sel_emp, $processed_employees)){
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] =  $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 1); // 1 indicates have privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }
            
            /* this section for normal user */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 3);
            foreach($team_customers as $cust_name){
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query
                
                foreach($team_employees as $sel_emp){
                    if(!in_array($sel_emp, $processed_employees)){
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] =  $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 0);   // 0 indicates have no privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }
            return $get_leaves;
        }
        
        if ($login_user_role == 2) {
            $get_leaves = array();
            $processed_employees = array();     //used to check previously queried with this employees
            
            /* this section for team leader */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 2);
            foreach($team_customers as $cust_name){
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query
                
                foreach($team_employees as $sel_emp){
                    if(!in_array($sel_emp, $processed_employees)){
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] =  $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 1); // 1 indicates have privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }
            
            /* this section for normal user */
            $team_customers = $employee->get_team_customer_names_using_emp_role($login_user, 3);
            foreach($team_customers as $cust_name){
                $team_employees = $employee->get_team_members_using_customer_name($cust_name);
                $list_processing_employees = array();       //used to pass list of new employees for query
                
                foreach($team_employees as $sel_emp){
                    if(!in_array($sel_emp, $processed_employees)){
                        $processed_employees[] = $sel_emp;
                        $list_processing_employees[] =  $sel_emp;
                    }
                }
                $team_employee_data = '\'' . implode('\', \'', $list_processing_employees) . '\'';
                $leave_data = $this->get_team_member_leaves_when_TL_login($team_employee_data, $year, $month, 0);   // 0 indicates have no privilege to process this leave
                $get_leaves = array_merge($get_leaves, $leave_data);
            }
            return $get_leaves;
        }
        
        if ($login_user_role == 3) {
            $team_members = $employee->team_members($login_user);
            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
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
        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '('. $sub_query_from_date .') AS From_date', 
            '('. $sub_query_to_date .') AS To_date',
            'leave.employee as employee',"(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.employee) AS empname", 
            'leave.status as status', 'leave.appr_date as appr_date',
            'leave.appr_emp as appr_emp', "(SELECT concat(first_name,' ',last_name) FROM employee where username = leave.appr_emp) AS appr_empname");
//        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '('. $sub_query_from_date .') AS From_date', 
//            '('. $sub_query_to_date .') AS To_date', 'leave.employee as employee',"concat(employee.last_name,' ',employee.first_name) as empname", 
//            'leave.status as status', 'leave.appr_date as appr_date',
//            'leave.appr_emp as appr_emp', "concat(e1.last_name,' ',e1.first_name) as appr_empname");
        switch ($login_user_role) {
            case 1:
                /*if ($year != NULL && $month != NULL) {
                    if ($emp != NULL) {
                        $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                        $this->condition_values = array($year, $month, $emp);
                    }else{
                        $this->conditions = array('AND', 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                        $this->condition_values = array($year, $month);
                    }
                } else {
                    $this->conditions = array('AND', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
                }*/
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

            case 2:
                if ($year != NULL && $month != NULL) {
                    if ($emp != NULL) {
                        $this->conditions = array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee = ?');
                        $this->condition_values = array($year, $month, $emp);
                    }else{
                        $this->conditions = array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'year(leave.date) = ?', 'month(leave.date) = ?');
                        $this->condition_values = array($year, $month);
                    }
                } else {
                    $this->conditions = array('AND', array('IN', '`leave`.`employee`', $team_employee_data));
                }
                break;

            case 3:
                if ($year != NULL && $month != NULL) {
                    if ($emp != NULL) {
                        $this->conditions = array('AND',
                            array('OR', 'leave.employee = ?',
                                array('AND', array('IN', 'leave.employee', $team_employee_data), 'leave.status = 1')),
                            'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee = ?');
                        $this->condition_values = array($login_user, $year, $month, $emp);
                    }else{
                        $this->conditions = array('AND',
                            array('OR', 'leave.employee = ?',
                                array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'leave.status = 1')),
                            'year(leave.date) = ?', 'month(leave.date) = ?');
                        $this->condition_values = array($login_user, $year, $month);
                    }
                } else {
                    $this->conditions = array('OR', 'leave.employee = ?',
                            array('AND', array('IN', '`leave`.`employee`', $team_employee_data), 'leave.status = 1'),
                        );
                    $this->condition_values = array($login_user);
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

    function get_team_member_leaves_when_TL_login($members, $year = NULL, $month = NULL, $editable_flag = 0) {
        
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
        $this->fields = array('leave.id as id', 'leave.group_id as gID', 'leave.type as type', '('. $sub_query_from_date .') AS From_date', 
            '('. $sub_query_to_date .') AS To_date', 'leave.employee as employee',"concat(employee.first_name,' ',employee.last_name) as empname", 
            'leave.status as status', 'leave.appr_date as appr_date',
            'leave.appr_emp as appr_emp', "concat(e1.first_name,' ',e1.last_name) as appr_empname", $editable_flag .' as privilege');
        if ($year != NULL && $month != NULL) {
            $this->conditions = array('AND', array('IN', '`leave`.`employee`', $members), 'year(leave.date) = ?', 'month(leave.date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
            $this->condition_values = array($year, $month);
        } else {
            $this->conditions = array('AND', array('IN', '`leave`.`employee`', $members), 'leave.employee like employee.username', 'leave.appr_emp like e1.username');
        }
        
        $this->group_by = array('leave.group_id');
        $this->order_by = array('leave.date desc');
        $this->limit = 0;
        $this->query_generate();
//        echo $this->sql_query;
        $datas = $this->query_fetch();
        //print_r($datas);
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
                                WHERE mcl.read_users NOT LIKE '%$login_user%'
                                OR mcl.leave_id IS NULL");
        $this->query_generate_leftjoin();
//        echo $this->sql_query;
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
        //print_r($all_list);
    }

    function get_all_unread_leaves($all_list, $unread_list) {

        // this function is used to take all unread leaves according to that loged user when he is first taking message center leave option
        $u_leave = array();
        for ($i = 0; $i < count($all_list); $i++) {
            if (in_array($all_list[$i]['gID'], $unread_list))
                $u_leave[] = $all_list[$i];
        }
        return ($u_leave);
        //print_r($all_list);
    }

    function get_leave_read_users($id) {

        $this->tables = array('mc_leave');
        $this->fields = array('read_users');
        $this->conditions = array('leave_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch(2);
        //print_r($datas);
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
//        print_r($data);
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
                //insertion
//                echo 'get In';
                $this->tables = array('mc_leave');
                $this->fields = array('leave_id', 'leave_status', 'read_users');
                $this->field_values = array($row['gID'], $row['status'], $_SESSION['user_id']);
                $this->query_insert();
            }
            //}
        }
    }

    function Customer_pdf_work_report($customer, $month, $year, $fkkn, $this_bargaining = NULL, $txt_other_bargaining = NULL, $this_agreement = array(), $employee = Null, $sam_sida = Null) {
        /**
         * Author: Shamsu
         * for: FKKN customer work report
         */
        
        require_once ('class/company.php');
        $pdf = new PDF_customer();
        $obj_company = new company();
        $obj_employee = new employee();
        $pdf->tot_normal = 0;
        $pdf->tot_oncall = 0;
        $flag = false;
        $employee_names = array();
        //---------------------------
        $company_data = $obj_company->get_company_detail($_SESSION['company_id']);
        $cust_details = $this->get_customer_details($customer);
        if ($employee == Null){
//            $employee_names = $this->get_Customer_team_members_with_no_trainee($customer);  //take employee names who work for a specific customer
            $employee_namess = $this->get_all_Member_details_for_customer_with_no_trainee($customer,$fkkn,$month,$year);  //take employee names who work for a specific customer
            $employee_names = array();
            if(!empty($employee_namess)){
                foreach ($employee_namess as $employee_s) {
                    $employee_names[] = $employee_s['empID'];
                }
            }
        }else
            $employee_names = array($employee);

        ob_clean ( );
        $no_of_employees_have_slots = 0;
        for ($i = 0; $i < count($employee_names); $i++) {
            $work_details = $this->get_Customer_employee_report_data($employee_names[$i], $customer, $month, $year, $fkkn);
            $emp_details = $this->get_employee_details($employee_names[$i]);
            $sign_details = $this->get_employee_signing_details($employee_names[$i], $month, $year);
            $employer_sign_details = $obj_employee->employer_signing_details($customer, $month, $year, $fkkn, $employee_names[$i]);
			
            if (empty($work_details))
                continue;
            $no_of_employees_have_slots++;
            $work_partition = array_chunk($work_details, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
            foreach ($work_partition as $works) { 
                $flag = TRUE;
                $pdf->AddPage();
                $pagecount = $pdf->setSourceFile('./pdf_forms/FK3059_011_F_001_2013.pdf');
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl, -2, 0, 210);
                
                $pdf->report_top($month, $year, $fkkn);
                $pdf->SubPart1($cust_details);
                $pdf->SubPart2($emp_details);
                $pdf->SubPart3_table($works);
                if($fkkn == 1)
                    $pdf->Sidelabel();
                
                $pdf->AddPage();
                $tppl = $pdf->importPage(2);
                $pdf->useTemplate($tppl, -2, 0, 210);
                //$pdf->summery_report_top_2($cust_details);
                $pdf->SubPart4($emp_details,$sign_details);
                $pdf->SubPart5($this_bargaining, $txt_other_bargaining);
                $pdf->SubPart6($company_data, $employer_sign_details, $this_agreement);
                if($fkkn == 1)
                    $pdf->Sidelabel();
            }
        }

        if ($flag) {
            $pdf->summery_data = $this->get_customer_summery_data($customer, $month, $year);
//            echo "<pre>".print_r($pdf->summery_data, 1)."</pre>";
            
            $pdf->AddPage();
            $pagecount = $pdf->setSourceFile('./pdf_forms/FK3057_013_F_001_2013.pdf');
            $tppl = $pdf->importPage(1);
            $pdf->useTemplate($tppl, -2, 0, 210);
            $pdf->summery_report_top($month, $year);
            $pdf->summery_SubPart1($cust_details);
            $pdf->summery_SubPart2($no_of_employees_have_slots);
            if (!empty($pdf->summery_data)) {
                $pdf->summery_SubPart3();
                $pdf->summery_SubPart4();
            }
            $pdf->summery_Sidelabel();
            
            $pdf->AddPage();
            $tppl = $pdf->importPage(2);
            $pdf->useTemplate($tppl, -2, 0, 210);
            
            $pdf->summery_report_top_2($cust_details);
            if (!empty($pdf->summery_data)) {
                $pdf->summery_SubPart5();
                $pdf->summery_SubPart6();
                $pdf->summery_SubPart7();
            }
            $pdf->summery_Sidelabel();
            
            $pdf->AddPage();
            $tppl = $pdf->importPage(3);
            $pdf->useTemplate($tppl, -2, 0, 210);
            
            $pdf->summery_report_top_2($cust_details);
            if (!empty($pdf->summery_data)) {
                $pdf->summery_SubPart8();
                
                $total_no_of_hours = 0.00;
                $account_date_from = trim($pdf->summery_data[0]['accounting_date_from']);
                $account_date_to = trim($pdf->summery_data[0]['accounting_date_to']);
                if($account_date_from != '' && $account_date_to != ''){     //calculate total no. of hours for the customer
                    $customer_hours = $this->get_customer_slots_btwn_dates($customer,$account_date_from, $account_date_to);
                    if(!empty($customer_hours)){
                        $obj_equipment = new equipment();
                        foreach($customer_hours as $customer_hour){
                            $total_no_of_hours = $obj_equipment->time_sum($total_no_of_hours, $obj_equipment->time_difference($customer_hour['time_to'], $customer_hour['time_from']));
                        }
                    }
                }
                
                $pdf->summery_SubPart9($total_no_of_hours);
            }
            $pdf->summery_Sidelabel();
            
            if ($sam_sida == Null) {
                $c_name = $this->create_pdf_samsida($customer, $month, $year, $fkkn, $employee);
                if($c_name){
                    $company = $this->get_company_directory($_SESSION['company_id']);
                    $pdf->Output("./". $company['upload_dir'] ."/fkkn/".$c_name,'F');
                }
                $pdf->Output();
            }else if ($sam_sida == 1) {
                $output_1 = array('tot_onCall' => $pdf->tot_oncall, 'tot_Normal' => $pdf->tot_normal);
                return $output_1;
            }
        }
    }

    function get_customer_summery_data($customer, $month, $year) {
        $this->tables = array('samsida');
        $this->fields = array('how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hospital', 
                'did_u_included_hospitalized_hours', 'hostpitalized_hours', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'signed_employer_name', 'signed_employer_telephone', 'do_u_hire_asst_provider', 'asst_provider_orgno', 
                'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money','asst_provider1','asst_provider_orgno1','asst_provider2','asst_provider_orgno2',
                'asst_provider3','asst_provider_orgno3','do_u_attach_receipt','money_left_not_to_purchase2','money_left2','do_u_live_outside_EEA_country','accounting_date_from','accounting_date_to',
                'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost','salary_OB_period','assist_expenses_cost','assist_expenses_period','training_cost','training_period','staff_expense_cost','staff_expense_period',
                'administration_cost', 'administration_period');
     
        $this->conditions = array('AND', 'month= ?', 'year= ?', 'customer like ?');
        $this->condition_values = array($month, $year, $customer);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_signing_details($employee, $month, $year) {

        $this->tables = array('report_signing');
        $this->fields = array('signin_date', 'signin_employee');
        $this->conditions = array('AND', 'month(date)= ?', 'year(date)= ?', 'employee like ?');
        $this->condition_values = array($month, $year, $employee);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
	
    function get_employee_not_signing($customer, $month, $year,$nk=1) {
        if($month < 10){ $month =  str_pad((int) $month,2,"0",STR_PAD_LEFT);}
        $year_month = $year.'-'.$month;
        $this->tables = array("SELECT  CONCAT(e.first_name,' ',e.last_name) AS emp  
                                    FROM timetable t
                                    LEFT JOIN employee e ON t.employee = e.username
                                    WHERE  DATE_FORMAT(t.date,'%Y-%m') ='".$year_month."'
                                    AND t.employee NOT IN (SELECT signin_employee  FROM `report_signing` r
                                                        WHERE DATE_FORMAT(r.date,'%Y-%m')='".$year_month."') 
                                    AND t.employee !='' and t.customer = '".$customer."'
                                    GROUP BY t.employee");
        $this->query_generate_leftjoin();
        $datas = $this->query_fetch(); 
        return $datas;
    }

    function summery_edit($customer, $month, $year, $fkkn, $employee = Null) {
        /**
         * Author: Unknown
         * Edited-by: Shamsu
         * for: to calculate total normal/oncall hours using month & year
         */
//        $pdf = new PDF_customer();
//        $pdf->tot_normal = 0.00;
//        $pdf->tot_oncall = 0.00;
//        $flag = false;
        $equipment = new equipment();
        $employee_names = array();

        if ($employee == Null)
            $employee_names = $this->get_Customer_team_members_with_no_trainee($customer, $month, $year);  //take employee names who work for a specific customer
        else
            $employee_names = array($employee);
        
        $__this_tot_normal = 0;
        $__this_tot_oncall = 0;
        $__no_of_employees_have_slots = 0;
        for ($i = 0; $i < count($employee_names); $i++) {
            $work_details = $this->get_Customer_employee_report_data($employee_names[$i], $customer, $month, $year, $fkkn);
            if (empty($work_details))
                continue;
            $__no_of_employees_have_slots++;
//            $work_partition = array_chunk($work_details, 31);   //chunk data in to 31 rows, because max 31 entries included @ one page
//            foreach ($work_partition as $works) {
//                $flag = TRUE;
//                $pdf->AddPage();
//                $pdf->SubPart3_table($works);
//            }
            
            //SMSDN New fashion
            foreach ($work_details as $works) {
                    $total_hour = $equipment->time_difference($works['time_to'],$works['time_from']);
                    $time_in_100= $equipment->time_user_format($total_hour, 100);
                    if (in_array($works['type'], array(0,1,2,4,5,6,7))) 
                        $__this_tot_normal += $time_in_100;
                    else if ($works['type'] == 3) 
                        $__this_tot_oncall += $time_in_100;
            }
        }
//        $output_1 = array('tot_onCall' => $pdf->tot_oncall, 'tot_Normal' => $pdf->tot_normal);
        $output_2 = array('tot_onCall' => $__this_tot_oncall, 'tot_Normal' => $__this_tot_normal, 'no_of_employees_have_slots' => $__no_of_employees_have_slots);
//        echo "<pre>Old fashion: ".print_r($output_1, 1)."</pre>";
//        echo "<pre>New fashion: ".print_r($output_2, 1)."</pre>";
        return $output_2;
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

    function get_Customer_team_members_with_no_trainee($customer, $month='', $year='') {

        $this->tables = array('timetable` as `t',$this->db_master.'.login` as `l');
        $this->fields = array('distinct t.employee');
        $this->conditions = array('AND', 'MONTH(t.date)=?', 'YEAR(t.date)=?', 't.customer like ?', 'l.username LIKE t.employee', 'l.role != 5');
        $this->condition_values = array($month, $year, $customer);
        $this->query_generate();
       
        $emp_names = $this->query_fetch(2);
        return $emp_names;
        
        
        $this->tables = array('team` as `t', 'employee` as `e',$this->db_master.'.login` as `l');
        $this->fields = array('t.employee as empID', 'concat( e.first_name," ", e.last_name ) as empName');
        $this->conditions = array('AND', 't.customer like ?', 't.employee LIKE e.username', 'l.username LIKE e.username', 'l.role != 5');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch();
        return $emp_names;
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

        $this->tables = array('team` as `t', 'employee` as `e',$this->db_master.'.login` as `l');
        $this->fields = array('t.employee as empID', 'concat( e.first_name," ", e.last_name ) as empName');
        $this->conditions = array('AND', 't.customer like ?', 't.employee LIKE e.username', 'l.username LIKE e.username', 'l.role != 5');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch();
        return $emp_names;
    }
   
   	
   function get_all_Member_details_for_customer_with_no_trainee($customer,$nk="1",$month="8",$year="2012") {
        $this->tables = array("SELECT t.employee AS empID, CONCAT( e.first_name,' ', e.last_name ) AS empName, t.fkkn,t.date
                                        FROM timetable t
                                        LEFT JOIN employee e ON t.employee = e.username
                                        LEFT JOIN  ".$this->db_master.".`login` AS `l` ON e.username = l.username
                                        WHERE t.customer LIKE '$customer'
                                        AND l.role != 5
                                        AND t.fkkn = '$nk'
                                        AND MONTH(t.date) = '$month'
                                        AND YEAR(t.date) = '$year'
                                        GROUP BY e.username");
        $this->query_generate_leftjoin();
        $emp_names = $this->query_fetch(); 
        return $emp_names;						
								
        /*$this->tables = array('team` as `t', 'employee` as `e',$this->db_master.'.login` as `l');
        $this->fields = array('t.employee as empID', 'concat( e.first_name," ", e.last_name ) as empName');
        $this->conditions = array('AND', 't.customer like ?', 't.employee LIKE e.username', 'l.username LIKE e.username', 'l.role != 5');
        $this->condition_values = array($customer);
        $this->query_generate();
        $emp_names = $this->query_fetch();
        return $emp_names;*/
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
        $this->fields = array('concat(first_name, " " ,last_name) as fullname', 'social_security', 'city', 'username', 'phone', 'mobile', 'century','fkkn');
        if ($customer_name != Null) {
            $this->conditions = array('username like ?');
            $this->condition_values = array($customer_name);
        }
        $this->order_by = array('LOWER(last_name)');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        //print_r($datas);
        return $datas;
    }

    function get_employee_details($employee = Null) {

        $this->tables = array('employee');
        $this->fields = array('concat(first_name, " " ,last_name) as fullname', 'social_security', 'city', 'username', 'mobile', 'century', 'address', 'post');
        if ($employee != Null) {
            $this->conditions = array('username like ?');
            $this->condition_values = array($employee);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_Customer_employee_report_data($employee="", $customer, $month, $year, $fkkn) {        //last edited 04-10-12 by shamsu

		if($employee!=''){	
			$this->tables = array('timetable');
			$this->fields = array('date', 'time_from', 'time_to', 'type');
			$this->conditions = array('AND', 'customer like ?', 'month(date)= ?', 'year(date)= ?', 'employee like ?', 'status=1', 'fkkn = ?', array('NOT IN','type','7,8,9,10'));
			$this->condition_values = array($customer, $month, $year, $employee, $fkkn);
			$this->group_by = array('date', 'time_from', 'time_to');
			$this->order_by = array('date', 'time_from', 'time_to');
			$this->query_generate();
			$datas = $this->query_fetch();
		}else{
                        $employee_names = $this->get_Customer_team_members_with_no_trainee($customer); 
                        for ($i = 0; $i < count($employee_names); $i++) {
                                $this->tables = array('timetable');
                                $this->fields = array('date', 'time_from', 'time_to', 'type');

                                $this->conditions = array('AND', 'customer like ?', 'month(date)= ?', 'year(date)= ?', 'employee like ?','status=1', 'fkkn = ?', array('NOT IN','type','7,8,9,10'));
                                $this->condition_values = array($customer, $month, $year, $employee_names[$i], $fkkn);
                                $this->group_by = array('date', 'time_from', 'time_to');
                                $this->order_by = array('date', 'time_from', 'time_to');
                                $this->query_generate();
                                //echo $this->sql_query;
                                $data = $this->query_fetch();
                                $Newdatas[] = $data;
                        }

                        foreach($Newdatas as $key=>$val){
                                if(sizeof($val) > 0){
                                        foreach($val as $k=>$v){
                                                $datas[] = $v;
                                        }
                                }
                        }
				
                }
                return $datas;
    }

    function distinct_timetable_years() {
        $this->tables = array('timetable');
        $this->fields = array('distinct(year(date)) as years');
        // $this->conditions = array('employee = ?');
        //$this->condition_values = array($employee);
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    /* function get_all_customers()
      {
      $this->tables = array('customer');
      $this->fields = array('distinct(year(date)) as years');
      // $this->conditions = array('employee = ?');
      //$this->condition_values = array($employee);
      $this->order_by= array('years desc');
      $this->query_generate();
      $datas = $this->query_fetch(2);
      return $datas;

      }


      function get_customer_details($customer_name = Null) {

      $this->tables = array('customer');
      $this->fields = array('concat(first_name, " " ,last_name) as fullname', 'social_security');
      $this->conditions = array('username like ?');
      $this->condition_values = array($customer_name);
      $this->query_generate();
      //echo $this->sql_query;
      $datas = $this->query_fetch();
      //print_r($datas);
      return $datas;
      } */
    function get_employee_name($employee){
        $this->tables = array('employee');
        $this->fields = array('first_name','last_name');
        $this->conditions = array('username = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        $result = $data[0]['first_name']." ".$data[0]['last_name'];
        return $result;
    }
    function Employee_contract_pdf($employee = Null, $id = Null, $customer = Null) {

        $contract_details = $this->get_employee_contract_details($employee, $id);

        $pdf = new PDF_EMP_Contract();
        $obj_emp = new employee();
        ///////////////////////////////////////////page 1///////////////////////////////////////////////

        $pdf->AddPage();        //page1
        $pagecount = $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(1);
        $pdf->useTemplate($tppl, -6, 0, 210);
        
        $pdf->P1_top($contract_details);
        $pdf->P1_SubPartA($obj_emp->employee_data($employee), $obj_emp->company_data());
        $pdf->P1_SubPartB($contract_details);
        $pdf->P1_SubPartC($contract_details);
        $pdf->P1_SubPartD($contract_details);
        $pdf->P1_SubPartE($contract_details);
        $pdf->P1_SubPartF($contract_details);
        $pdf->P1_SubPartG($contract_details);
        if($contract_details[0]['sign_date'] != "" || $contract_details[0]['sign'] != null){
            $pdf->P1_SubPartH($contract_details,$this->get_employee_name($contract_details[0]['alloc_employee']));
            $pdf->P1_SubPartI($contract_details,$this->get_employee_name($contract_details[0]['employee']));
        }
//        $pdf->P1_SubPartH();
//        $pdf->P1_SubPartI();

        $pdf->AddPage();        //page2
        $pagecount = $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(2);
        $pdf->useTemplate($tppl, -6, 0, 210);

        $pdf->AddPage();        //page3
        $pagecount = $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(3);
        $pdf->useTemplate($tppl, -6, 0, 210);

        $pdf->AddPage();        //page4
        $pagecount = $pdf->setSourceFile('./pdf_forms/Contract.pdf');
        $tppl = $pdf->importPage(4);
        $pdf->useTemplate($tppl, -6, 0, 210);

//        $pdf->P4_top();
//        $pdf->P4_table_body();

        $pdf->Output();
    }

    function Employment_certificate_pdf($employee = Null, $id = Null, $customer = Null) {
        
        global $preference;
        require_once ('plugins/customize_pdf_employee_certificate.class.php');

        //$contract_details =  
        $this->get_employee_contract_details($employee, $id);
        $obj_emp = new employee();
        $period_from = explode('/', $this->Certification_period_from);
        $period_to = explode('/', $this->Certification_period_to);
        $pdf = new PDF_EMP_Certificate();
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////        
        $pdf->AddPage();        //page1
        $pagecount = $pdf->setSourceFile('./pdf_forms/AG_hours_edited.pdf');
        $tppl = $pdf->importPage(1);
        $pdf->useTemplate($tppl, -6, 0, 210);

        $emp_details = $obj_emp->employee_data($this->employee_id);
        $pdf->P1_SubPart1($emp_details);
        $pdf->P1_SubPart2($this->employment_period_from, $this->employment_period_to, $this->still_employed, $this->post_held, $this->leave_effective_from, $this->leave_effective_to, $this->coverage_in);
        $pdf->P1_SubPart3($this->open_ended, $this->probationary_to, $this->temporary_employement, $this->Intermittent_employement);
        $pdf->P1_SubPart4($this->Arbetstid_open_ended, $this->parttime, $this->hours_per_week, $this->full_time_position_in_perc, $this->working_hours);
        $pdf->P1_SubPart5($this->employed_by_agency);
        $pdf->P1_SubPart6($this->employment_termination, $this->temporary_employment_closed, $this->own_request, $this->other_reason);
        $pdf->P1_SubPart7($this->termination_compensation);
        $pdf->P1_SubPart8($this->future_work_offer, $this->future_work_From, $this->future_work_to, $this->to_further, $this->full_time_per_week, $this->part_time_per_week, $this->full_time_position_in_perc_Erbjudande, $this->variable_time, $this->employer_accepted, $this->employer_accepted_date_when_no);

        $start_year = $period_from[0];
        $end_year = $period_to[0];
        $start_month = $period_from[1];
        $end_month = $period_to[1];
        $year_difference = $period_to[0] - $period_from[0];
        //echo $year_difference;
        $total_tables_pages = ($year_difference % 2) + floor($year_difference / 2);
        //echo $total_tables_pages;
        for ($i = 0; $i < $total_tables_pages || $total_tables_pages == 0; $i++) {
            if ($i == $total_tables_pages - 1 || $total_tables_pages == 0) {
                $pdf->AddPage();        //page2
                $pagecount = $pdf->setSourceFile('./pdf_forms/AG_hours_edited.pdf');
                $tppl = $pdf->importPage(2);
                $pdf->useTemplate($tppl, -6, 0, 210);

                $pdf->P2_SubPart10($emp_details);
                if ($start_year + 1 <= $end_year) {

                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $start_month, $end_month, $start_year + 1);
                    $start_year = $start_year + 2;
                } else {

                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $start_month, $end_month);
                    $start_year = $start_year + 1;
                }
                $pdf->P2_SubPart12($this->salary_to_year, $this->salary_type, $this->amount_in_sek, $this->hourly_rate_varied, $this->overtime_state, $this->additional_hours, $this->not_included_salary);

                $pdf->P2_SubPart13($this->Employed_with_uppehållslön, $this->Set_earned_uppehållslön, $this->Employed_with_ferielön, $this->no_of_beta_barn_holidays, $this->Set_earned_ferielön);
                $pdf->P2_SubPart14($this->other_information_1, $this->other_information_2);
                $pdf->P2_SubPart15($obj_emp->company_data());
            } else {
                $pdf->AddPage();        //page2
                $pagecount = $pdf->setSourceFile('./pdf_forms/AG_hours_Content_table.pdf');
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl, -6, 0, 210);

                $pdf->P2_SubPart10($emp_details);
                if ($start_year + 1 <= $end_year) {

                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $start_month, $end_month, $start_year + 1);
                    $start_year = $start_year + 2;
                } else {

                    $pdf->P2_SubPart11($this->employee_id, $start_year, $end_year, $start_month, $end_month);
                    $start_year = $start_year + 1;
                }
            }
            if ($total_tables_pages == 0)
                $total_tables_pages = -1;
            //$start_year = $start_year + 2;
        }
        $c_name = $this->create_pdf_certificate($this->employee_id);
        //$pdf->Output($preference['url']."created_pdf_files/".$c_name,'F');
        $company = $this->get_company_directory($_SESSION['company_id']);
        $pdf->Output("./". $company['upload_dir'] ."/created_pdf_files/".$c_name,'F');
        $pdf->Output();
    }

    function create_pdf_certificate($employee){
        /**
         * Author: Shamsu
         * for: create a certificate entry on certificate history table
         */
        $certificate_name= 'Certificate_'. rand().'.pdf';
        $this->tables = array('history_certification_report');
        $this->fields = array('employee','file');
        $this->field_values = array($employee,$certificate_name);
        $data = $this->query_insert();

        if ($data) {

            return $certificate_name;
        }
        else
            return FALSE;
    }

    function create_pdf_sick($employee,$customer){
        /**
         * Author: Shamsu
         * for: create a sick rpt entry on sick history table
         */
        $pdf_name= 'Sick_'. rand().'.pdf';
        $this->tables = array('history_sick_report');
        $this->fields = array('employee','customer','file');
        $this->field_values = array($employee,$customer,$pdf_name);
        $data = $this->query_insert();

        if ($data) {

            return $pdf_name;
        }
        else
            return FALSE;
    }

    function create_pdf_samsida($customer, $month, $year, $fkkn, $employee){
        /**
         * Author: Shamsu
         * for: create a samsida entry on samsida history table
         */
        $pdf_name= 'Samsida_'. rand().'.pdf';
        $this->tables = array('history_samsida_work_report');
        $this->fields = array('month','year','fkkn', 'customer', 'employee', 'file_name');
        $this->field_values = array($month, $year, $fkkn, $customer, $employee, $pdf_name);
        $process_flag = $this->query_insert();
        if ($process_flag)
            return $pdf_name;
        else
            return FALSE;
    }

    function get_pdf_certificate($employee){
       /**
         * Author: Shamsu
         * for: get certificate history entry
         */
        $this->tables = array('history_certification_report');
        $this->fields = array('file','date');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->order_by = array('date');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_pdf_sicks($employee, $customer){
        /**
         * Author: Shamsu
         * for: get sick history entry
         */
        $this->tables = array('history_sick_report');
        $this->fields = array('file','date');
        $this->conditions = array('AND','employee = ?', 'customer = ?');
        $this->condition_values = array($employee, $customer);
        $this->order_by = array('date desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_pdf_samsida($month, $year, $fkkn, $customer){
        /**
         * Author: Shamsu
         * for: get samsida history entry
         */
        $this->tables = array('history_samsida_work_report');
        $this->fields = array('file_name','generated_date');
        $this->conditions = array('AND', 'month = ?', 'year = ?', 'fkkn = ?','customer = ?');
        $this->condition_values = array($month, $year, $fkkn, $customer);
        $this->order_by = array('generated_date desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_company_directory($company_id){
        
        $this->tables = array($this->db_master.'.company');
        $this->fields = array('upload_dir');
        $this->conditions = array('id = ?');
        $this->condition_values = array($company_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }
    
    function get_work_details_For_certification($employee_id, $year, $start_month, $end_month, $end_year) {
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as work_hour');
        $this->conditions = array('AND', 'employee = emp', 'month(date) = month', 'year(date) = year', 'relation_id is null', 'status = 1');
        //$this->condition_values = array($employee_id);
        $this->group_by = array('year(date)', 'month(date)');
        $this->query_generate();
        $work_hour = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as leave_hour');
        $this->conditions = array('AND', 'employee = emp', 'month(date) = month', 'year(date) = year', 'status = 2');
        //$this->condition_values = array($employee_id);
        $this->group_by = array('year(date)', 'month(date)');
        $this->query_generate();
        $leave_hour = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as filling_hour');
        $this->conditions = array('AND', 'employee = emp', 'month(date) = month', 'year(date) = year', 'relation_id is not null', 'status = 1');
        //$this->condition_values = array($employee_id);
        $this->group_by = array('year(date)', 'month(date)');
        $this->query_generate();
        $filling_hour = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('month(date) as month', 'year(date) as year', 'employee as emp', "(" . $work_hour . ") as work_hours", "(" . $leave_hour . ") as leave_hours", "(" . $filling_hour . ") as filling_hours");
        if ($year != $end_year) {
            $this->conditions = array('AND', 'employee = ?', 'year(date) = ?', 'month(date) >= ?');
            $this->condition_values = array($employee_id, $year, $start_month);
        } else {
            $this->conditions = array('AND', 'employee = ?', 'year(date) = ?', 'month(date) >= ?', 'month(date) <= ?');
            $this->condition_values = array($employee_id, $year, $start_month, $end_month);
        }
        $this->group_by = array('year(date)', 'month(date)');
        $this->query_generate();
        //echo $this->sql_query . "<br />";
        $datas = $this->query_fetch();

        //print_r($datas);
        return $datas;
    }

    function employee_contract_month($employee, $year, $month) {
        $month_days = array();
        //calculating start date and end date
        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        //        $start_date = date("Y-m-d", strtotime($year . 'W' . $month_no . '1'));
        //        $end_date = date("Y-m-d", strtotime($year . 'W' . $month_no . $month_days[$month_data[1]-1]));
        $start_date = $year . "-" . $month . "-01";
        $end_date = $year . "-" . $month . "-" . $month_days[$month - 1];

        $this->tables = array('employee_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('employee_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour');
        $this->conditions = array('AND', 'employee = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($employee, $end_date, $employee, $start_date);
        $this->order_by = array('date_from');
        $this->query_generate();
        //echo $this->sql_query;
        $contract_data = $this->query_fetch();
        //print_r($contract_data);
        if (!empty($contract_data)) {

            return $contract_data;
        } else {

            return FALSE;
        }
    }

    function get_least_and_most_timetable_dates($employee_id) {
        $this->tables = array('timetable');
        $this->fields = array('month(min(date)) as least_month', 'year(min(date)) as least_year', 'month(max(date)) as most_month', 'year(max(date)) as most_year');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function attach_employee_age($data_array) {
        
        if($data_array){
            for($i=0 ; $i<count($data_array) ; $i++){
                $this->tables = array('employee');
                $this->fields = array('century', 'social_security');
                $this->conditions = array('username = ?');
                $this->condition_values = array($data_array[$i]['employee_id']);
                $this->query_generate();
                $datas = $this->query_fetch();
                if(!empty($datas)){
                    $yyyy = $datas[0]['century'] . substr($datas[0]['social_security'], 0, 2);
                    $mm = substr($datas[0]['social_security'], 2, 2);
                    $dd = substr($datas[0]['social_security'], 4, 2);
                    //$DOB = $yyyy . "-" . $mm . "-" . $dd;
                    $year_diff  = date("Y") - $yyyy;
                    $month_diff = date("m") - $mm;
                    $day_diff   = date("d") - $dd; 
                    if ($month_diff == 0){ 
                        if($day_diff < 0) 
                            $year_diff--; 
                    } 
                    else if ($month_diff < 0)
                        $year_diff--; 
                    
                    $data_array[$i]['age'] = $year_diff;
                }
                else{
                    $data_array[$i]['age'] = 0;
                }
            }
            
            return $data_array;
        }
        else
            return FALSE;
    }

    function Financial_payment_pdf() {
        
        $obj_emp = new employee();
        $customer = new customer();
        $equipment = new equipment();
        $inconvenient_process_obj = new inconvenient();
        $obj_dona = new dona();
        $customer_details = $customer->customer_detail($this->leave_customer);
        $emp_details = $obj_emp->employee_data($this->leave_employee);
        $all_leave_works = $this->get_employee_leaved_timetable_works($this->leave_employee, $this->leavePeriod_year, $this->leavePeriod_month, $this->leave_customer);
       
        $total_ordinarie_time = 0;
        foreach($all_leave_works as $ord_work){
            $total_ordinarie_time = $equipment->time_sum($total_ordinarie_time, $equipment->time_difference($ord_work['time_to'],$ord_work['time_from']));
        }
        
        $list_relations = $equipment->relations_leave_employee($this->leavePeriod_month,  $this->leavePeriod_year,  $this->leave_customer,  $this->leave_employee);
//        echo "<pre>".print_r($list_relations, 1)."</pre>";
        $list_relation_emp_names = array();
        $total_vikarie_time = 0;
        foreach($list_relations as $rel_works){
            $list_relation_emp_names[] = $rel_works['employee_id'];
            $total_vikarie_time = $equipment->time_sum($total_vikarie_time, $equipment->time_difference($rel_works['time_to'],$rel_works['time_from']));
        }
        
        $qualifying_leave_works = $this->get_employee_leave_Qualifying_day_works($all_leave_works);
//        echo "<pre>Qualifying days: ".print_r($qualifying_leave_works, 1)."</pre>";
        $Q_work_dates = array();
        foreach($qualifying_leave_works as $Qworks)
            $Q_work_dates[] = $Qworks['date'];
		
        $pdf = new PDF_Fin_Payment();
        $pdf->ordinary_pay = $this->words_pay;
        $pdf->sick_pay = $this->kr_h;
        $pdf->on_call = $this->on_call;   
        $pdf->oncall_holiday = $this->oncall_holiday; 
        $pdf->oncall_bigholiday = $this->oncall_bigholiday;  
        $pdf->inconvinient_evening =$this->inconvinient_evening;            
        $pdf->inconvinient_holiday =$this->inconvinient_holiday; 
        $pdf->inconvinient_night = $this->inconvinient_night;           
        $pdf->inconvinient_week_holiday = $this->inconvinient_week_holiday; 
		
        $list_relations_partition = array_chunk($list_relations, 6);
        $Hourly_times_partition = array_chunk($this->Hourly_times, 6);
        ///////////////////////////////////////////page 1///////////////////////////////////////////////
        if($list_relations_partition){ 
            for($p = 0 ; $p <count($list_relations_partition) ; $p++){
                $pdf->AddPage();        //page1
                $pagecount = $pdf->setSourceFile('./pdf_forms/economic_FK.pdf');
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl, -2, 0, 210);

                $pdf->P1_table_1($customer_details);
                $pdf->P1_table_2($obj_emp->company_data(),  $this->assignment,  $this->proxies, $this->submission);
                $pdf->P1_table_3($this->comp_paid_to_account, $this->reference);
                $pdf->P1_table_4($emp_details, $Q_work_dates,$all_leave_works);
                //$pdf->P1_table_5($list_relations, $this->Hourly_times);
                $pdf->P1_table_5($list_relations_partition[$p], $Hourly_times_partition[$p], $list_relations, $this->Hourly_times);
                $pdf->P1_Bifogas($this->sick_leave_reg, $this->copy_of_payroll, $this->time_sheet_h_service, $this->additional_cost);
            }
        }else{
            $pdf->AddPage();        //page1
            $pagecount = $pdf->setSourceFile('./pdf_forms/economic_FK.pdf');
            $tppl = $pdf->importPage(1);
            $pdf->useTemplate($tppl, -2, 0, 210);

            $pdf->P1_table_1($customer_details);
            $pdf->P1_table_2($obj_emp->company_data(),  $this->assignment,  $this->proxies, $this->submission);
            $pdf->P1_table_3($this->comp_paid_to_account, $this->reference);
            $pdf->P1_table_4($emp_details, $Q_work_dates,$all_leave_works);
            //$pdf->P1_table_5($list_relations, $this->Hourly_times);
            $pdf->P1_table_5(array(), array(), $list_relations, $this->Hourly_times);
            $pdf->P1_Bifogas($this->sick_leave_reg, $this->copy_of_payroll, $this->time_sheet_h_service, $this->additional_cost);
        }
        
         ///////////////////////////////////////////page 2///////////////////////////////////////////////
        $pdf->AddPage();
        $pdf->P2_top($this->collective);
        $flag = 0;
        $table_no = 0;
       				
        if($all_leave_works){
            if($qualifying_leave_works && $qualifying_leave_works[0]['date'] != $all_leave_works[0]['date']){   // this block is taken only when first qualifying day not equal to first leave day
                $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                $date2 = date('Y-m-d',strtotime($qualifying_leave_works[0]['date'] .' -1 day'));
                $incov_details = $this->get_employee_inconv_leaved_works_between_two_dates_copy($this->leave_employee, $this->leave_customer, $date1, $date2);
                
                $table_no += 1;
                $pdf->P2_table1($date1,$date2,$this->insurance_word_person,  $this->SS_contibution, $incov_details,array());
                $flag = 1;
            }
            else if(empty($qualifying_leave_works)){
                $date1 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-01";
                $num = cal_days_in_month(CAL_GREGORIAN, $this->leavePeriod_month, $this->leavePeriod_year);
                $date2 = $this->leavePeriod_year . "-" . $this->leavePeriod_month . "-" . $num;
                $incov_details = $this->get_employee_inconv_leaved_works_between_two_dates_copy($this->leave_employee, $this->leave_customer, $date1, $date2);
                $table_no += 1;
                $pdf->P2_table1($date1,$date2,$this->insurance_word_person,  $this->SS_contibution, $incov_details,array());
                $flag = 1;
            }
        }
        if(count($qualifying_leave_works)>1){
            for($i = 0 ; $i<count($qualifying_leave_works) ; $i++){
                $date1 = date('Y-m-d',strtotime($qualifying_leave_works[$i]['date'] .' +1 day'));
                $date2 = '';
                $table_period_date1 = $qualifying_leave_works[$i]['date'];
                if(count($qualifying_leave_works)-1 == $i){
                    $syear = date('Y',strtotime($qualifying_leave_works[$i]['date']));
                    $smonth = date('m',strtotime($qualifying_leave_works[$i]['date']));
                    $num = cal_days_in_month(CAL_GREGORIAN, $smonth, $syear);
                    $date2 = $syear . "-" . $smonth . "-" . $num;
                }else{
                    $date2 = date('Y-m-d',strtotime($qualifying_leave_works[$i+1]['date'] .' -1 day'));
                }
                $table_period_date2 = $date2;
                $qualifying_day_total_hour = $this->get_employee_timetable_leaved_work_details_by_date_copy($qualifying_leave_works[$i]);
                $incov_details = $this->get_employee_inconv_leaved_works_between_two_dates_copy($this->leave_employee, $this->leave_customer, $date1, $date2);
                
                $table_no += 1;
                if($table_no == 3){
                    $table_no = 0;
                    $pdf->AddPage();
                }
                $pdf->P2_table1($table_period_date1,$table_period_date2,$this->insurance_word_person,  $this->SS_contibution, $incov_details, $qualifying_day_total_hour);
            }
        }
        else{
            if(count($qualifying_leave_works) == 1){
                $date1 = date('Y-m-d',strtotime($qualifying_leave_works[0]['date'] .' +1 day'));
                $syear = date('Y',strtotime($qualifying_leave_works[0]['date']));
                $smonth = date('m',strtotime($qualifying_leave_works[0]['date']));
                $num = cal_days_in_month(CAL_GREGORIAN, $smonth, $syear);
                $date2 = $syear . "-" . $smonth . "-" . $num;
                 
                $qualifying_day_total_hour = $this->get_employee_timetable_leaved_work_details_by_date_copy($qualifying_leave_works[0]);
                $incov_details = $this->get_employee_inconv_leaved_works_between_two_dates_copy($this->leave_employee, $this->leave_customer, $date1, $date2);
//                echo "<pre>Qualifying: ".print_r($qualifying_day_total_hour, 1)."</pre>";
//                echo "<pre>Inconv: ".print_r($incov_details, 1)."</pre>";
                $table_no += 1; 
                $pdf->P2_table1($qualifying_leave_works[0]['date'],$date2,$this->insurance_word_person,  $this->SS_contibution, $incov_details,$qualifying_day_total_hour);
            }
            else if($flag == 0){
                $table_no += 1;
                $pdf->P2_table1(null,null,$this->insurance_word_person,  $this->SS_contibution, array(),array());
            }
        }
        
        /////////////////////////////////vikarie/////////////////////////////////////
        $vikaries = $this->get_all_vikaries($this->leavePeriod_month,$this->leavePeriod_year,$this->leave_customer,$this->leave_employee);
        $group_vikaries = $this->grouping_vikaries($vikaries);
        if($group_vikaries){
            $total_vikarie_qualify_time = 0.00;
            for($i=0 ; $i<count($group_vikaries); $i++){
                $qualifying_day_total_hour = array();
                $incov_details = array();
                $vikaries_normal_salary = $inconvenient_process_obj->get_salary($group_vikaries[$i][0]['date'], $group_vikaries[$i][0]['employee_id'], 'normal');
                $vikarie_insurance = $inconvenient_process_obj->get_salary($group_vikaries[$i][0]['date'], $group_vikaries[$i][0]['employee_id'], 'insurance');
                $vikarie_age = $obj_dona->attach_employee_age(array(array('employee_id' => $group_vikaries[$i][0]['employee_id'])));
                if($vikarie_age[0]['age'] < 25) $vikarie_sociala = 15.21;
                else if($vikarie_age[0]['age'] < 65) $vikarie_sociala = 31.42;
                else if($vikarie_age[0]['age'] >= 65) $vikarie_sociala = 15.21;
                
                for($j=0 ; $j<count($group_vikaries[$i]); $j++){
                    $date1 = $group_vikaries[$i][$j]['date'];
                    $date2 = $group_vikaries[$i][$j]['date'];
                    
                    if(in_array($date1, $Q_work_dates)){
                        $qualifying_day_total_hour = $this->process_qualifying_day_hours_copy($group_vikaries[$i][$j], $qualifying_day_total_hour, $total_vikarie_qualify_time);
                        $total_vikarie_qualify_time = $qualifying_day_total_hour['total_vikarie_qualify_time'];
                    }else{
                        $this_incov_details =  $this->get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($group_vikaries[$i][$j]);
//                        echo "<pre>this_incov_details: ".print_r($this_incov_details, 1)."</pre>";
                        if(!empty($this_incov_details) && !empty($incov_details)){
                            foreach ($this_incov_details as $key => $time_values){
                                foreach ($time_values as $inc_salary => $h_values){
                                    if(isset($incov_details[$key][$inc_salary])){
                                        $incov_details[$key][$inc_salary]['hour'] = $equipment->time_sum($incov_details[$key][$inc_salary]['hour'], $h_values['hour']);
                                    }else{
                                        $incov_details[$key][$inc_salary]['hour'] = $h_values['hour'];
                                    }
                                }
                                
                            }
                        }else if(!empty($this_incov_details)){
                            $incov_details = $this_incov_details;
                        }
                    }
                }
//                echo "<pre>Qualifying".print_r($qualifying_day_total_hour, 1)."</pre>*******************************";
//                echo "<pre>Incov : ".print_r($incov_details, 1)."</pre>------------";
                $vikaries_timelon = 0;
                for($m = 0 ; $m<count($list_relation_emp_names); $m++){
                    if($list_relation_emp_names[$m] == $group_vikaries[$i][0]['employee_id']){
                        $vikaries_timelon = $this->Hourly_times[$m];
                        break;
                    }
                }
                if($vikaries_timelon == '') $vikaries_timelon = 0;
                $table_no += 1;
                if($table_no == 3){
                    $table_no = -1;
                    $pdf->AddPage();
                }
                $pdf->P2_table2($group_vikaries[$i][0]['employee'], $vikaries_normal_salary, $vikarie_insurance, $incov_details,$qualifying_day_total_hour, $vikarie_sociala); 
            }
        }
        else
            $pdf->P2_table2(Null,Null,0,Null,array(),0);
        $pdf->P2_table3($total_ordinarie_time);
        $pdf->P2_bottom();
        $leave_form_name = $this->create_pdf_sick($this->leave_employee,$this->leave_customer);
        $company = $this->get_company_directory($_SESSION['company_id']);
        $pdf->Output("./". $company['upload_dir'] ."/created_pdf_files/".$leave_form_name,'F');
        $pdf->Output();
    }

    function get_distint_leave_years_from_timetable(){
        
        $this->tables = array('timetable');
        $this->fields = array('distinct(year(date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }
    function grouping_vikaries($vikaries_array){
        $grouped_array = array();
        for($i = 0 ; $i<count($vikaries_array) ; $i++){
            $flg= 0;
            $j = 0;
            for( ; $j<count($grouped_array) ; $j++){
                if($vikaries_array[$i]['employee_id'] == $grouped_array[$j][0]['employee_id']){
                    $flg = 1;
                    break;
                }
            }

            if($flg == 1){
                $grouped_array[$j][]=$vikaries_array[$i];
            }else
                $grouped_array[][0]=$vikaries_array[$i];
        }
        return $grouped_array;
    }
    
    function get_all_vikaries($month,$year,$cust,$emp){
        
        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND','month(date) = ?','year(date) = ?','status = 2' ,'customer = ?','employee = ?');
        $this->condition_values = array($month,$year,$cust,$emp);
        $this->query_generate();
        //echo $this->sql_query; 
        $time_table_ids = $this->query_fetch(2);
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';
        
        $this->tables = array('timetable` as `t','employee` as `e');
        $this->fields = array('t.id','t.employee as employee_id','concat(first_name ," ", last_name) as employee','t.customer as customer','t.date as date','t.fkkn as fkkn','t.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status','t.relation_id as relation_id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 1',array('IN','t.relation_id',$ids),'t.customer = ?','e.username like t.employee');
        $this->condition_values = array($month,$year,$cust);
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }
    
    function get_employee_inconv_leaved_works_between_two_dates_copy($employee_id, $customer, $sdate, $edate){
        
        /**
         * Author: Shamsu
         * for: Salary report calculation TEST 
         * to refer origial : get_employee_inconv_leaved_works_between_two_dates()
         */
        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();
        $inconv_normal_slots = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee_id, $customer);
//        echo "<pre>".print_r($inconv_normal_slots, 1)."</pre>";
        $total_sal = array();
        if(!empty($inconv_normal_slots)){
//            echo 'Inconvenient groups:         <br>';
//            echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;
            
            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee_id, $sdate, $edate);
            
//            $inconvenient_process_obj->print_arrays();
            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
//            echo "<pre>Salary  ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            
            //calculated total salary for each slot category
            $total_sal = $inconvenient_process_obj->calculate_key_based_perhour_salary_asper_day($employee_id);
//            echo "<pre>Total ".print_r($total_sal, 1)."</pre>";
            //calculate additional salary hours for inconvenients and holidays
            $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee_id);
            if(!empty($addtion_salaries)){
                if(empty($total_sal['normal_0']) || !isset($total_sal['normal_0'])){
                    $total_sal['normal_0'] = $addtion_salaries['normal_0'];
                }else{
                    foreach($addtion_salaries['normal_0'] as $amount => $h_values ){
                        if(!empty($total_sal['normal_0'][$amount]))
                            $total_sal['normal_0'][$amount]['hour'] = $equipment->time_sum($total_sal['normal_0'][$amount]['hour'], $h_values['hour']);
                        else
                            $total_sal['normal_0'][$amount]['hour'] = $h_values['hour'];
                    }
                }
            }
            
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
//            $total_sal = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }
//        echo "<pre>Inc ".print_r($inconv_normal_slots, 1)."</pre>";
//        echo "<pre>Sal ".print_r($total_sal, 1)."</pre>";
        return $total_sal;
    }
    
    function get_employee_inconv_leaved_works_between_two_dates($employee_id, $customer, $sdate, $edate){
        
//        $employee = new employee();
//        $equipment = new equipment();
        $inconvenient_process_obj = new inconvenient();
        $inconv_normal_slots = $this->get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee_id, $customer);
        $total_sal = array();
        if(!empty($inconv_normal_slots)){
//            echo 'Inconvenient groups:         <br>';
//            echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;
            
            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee_id, $sdate, $edate);
            
            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
            
            //calculated total salary for each slot category
            $categorize_salary = $inconvenient_process_obj->calculate_key_based_salary($employee_id);
            
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
            $total_sal = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }
        return $total_sal;
    }
	
    function get_employee_inconv_leaved_works_between_two_dates_for_vikarie_copy($work_data){
        /**
         * Author: Shamsu
         * for: TEST for salary calculation
         */
        
        $inconvenient_process_obj = new inconvenient();
        $equipment = new equipment();
        $inconv_normal_slots = array($work_data);
        $total_salaries = array();
        if(!empty($inconv_normal_slots)){
//            echo 'Inconvenient groups:         <br>';
//            echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;
            
            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($work_data['employee_id'], $work_data['date'], $work_data['date']);
            
            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
//            echo "<pre>salary_hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
            //calculated total salary for each slot category
            $total_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary_asper_day($work_data['employee_id'], FALSE);
//            echo "<pre>Calculated: ".print_r($total_salaries, 1)."</pre>";
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
//            $total_salaries = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
            
            
            //calculate additional salary hours for inconvenients and holidays
            $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($work_data['employee_id'],FALSE);
//            echo "<pre>Total salary: ".print_r($total_salaries, 1)."</pre>";
//            echo "<pre>Additional: ".print_r($addtion_salaries, 1)."</pre>";
            if(!empty($addtion_salaries)){
                foreach($addtion_salaries as $key => $entries ){
                    foreach($entries as $amount => $h_values ){
                        if(!empty($total_salaries[$key][$amount]))
                            $total_salaries[$key][$amount]['hour'] = $equipment->time_sum($total_salaries[$key][$amount]['hour'], $h_values['hour']);
                        else
                            $total_salaries[$key][$amount]['hour'] = $h_values['hour'];
                    }
                }
            }
        }
//        echo "<pre>Result salary".print_r($total_salaries, 1)."</pre>-----";
        return $total_salaries;
	
    }
    
    function get_employee_inconv_leaved_works_between_two_dates_for_vikarie($work_data){
        
        $inconvenient_process_obj = new inconvenient();
        $inconv_normal_slots = array($work_data);
        $total_salaries = array();
        if(!empty($inconv_normal_slots)){
//            echo 'Inconvenient groups:         <br>';
//            echo "<pre>Inconvenient slots: ".print_r($inconv_normal_slots, 1)."</pre>";
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = $inconv_normal_slots;
            
            //categorize different slot type hours between 2 slots
            $inconvenient_process_obj->generate_work_report_using_input_slots($work_data['employee_id'], $work_data['date'], $work_data['date']);
            
            //calculate salary for each slot category
            $inconvenient_process_obj->categorize_salary_hours();
            
            //calculated total salary for each slot category
            $categorize_salary = $inconvenient_process_obj->calculate_key_based_salary($work_data['employee_id']);
            
            //grouping normal[normal_0]/inconvenient[normal_3] salaries, which is excepts holidays and inconvenients
            $total_salaries = $inconvenient_process_obj->group_nomal_inconv_from_calculated_key_based_salary($categorize_salary);
        }
//        echo "<pre>".print_r($total_salaries, 1)."</pre>";
        return $total_salaries;
        
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
//        $this_month = date('m',strtotime($date));
//        $this_year = date('Y',strtotime($date));
        $customer = $work_data['customer'];
        $employee = $work_data['employee'];
        
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from','time_to', 'date', 'type', 'status');
        $this->conditions = array('AND','date = ?','status = 2' ,'customer = ?','employee = ?');
        $this->condition_values = array($date, $customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();
        
//        echo "<pre>work_data: ".print_r($work_data, 1)."</pre>";
//        echo "<pre>Exceeded: ".print_r($data, 1)."</pre>";
        if($data){
            $inconvenient_process_obj = new inconvenient();
            $qualify_exceed_flag = FALSE;
            $data_count = count($data);
            for($i = 0 ; $i < $data_count; $i++){
                $inconvenient_process_obj->reset_inconvenient_variables();
                $inconvenient_process_obj->inconv_normal_slots = array($data[$i]);
                $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date']);
                $inconvenient_process_obj->categorize_salary_hours();
                $total_sal = $inconvenient_process_obj->calculate_total_salary($employee);
                $grand_total_amount += $total_sal;
//                echo 'Employee: '. $employee."<br>";
//                echo 'total salary: '. $total_sal."<br>";
//                $tot_time = $equipment->time_sum($tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                $grand_total_time = $equipment->time_sum($grand_total_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                //grand total only for calculating total hours
                
                if($time_sum >= 8.00 && !$qualify_exceed_flag){
                    $qualify_exceed_flag = TRUE;
                    $amount_to_complete_8 = $equipment->time_difference($time_sum, $qualifying_tot_time);
                    $this_time_diff = $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']);
                    $per_hour_sal = $total_sal / $this_time_diff;
                    $qualifying_tot_time = 8.00;
                    $qualifying_tot_amount += ($amount_to_complete_8 * $per_hour_sal);
                    if($time_sum > 8.00){
                        $balance_time = $equipment->time_difference($time_sum, 8.00);
                        if($data[$i]['type'] == 3){
                            $exceeded_oncall_time = $balance_time;
                            $exceeded_oncall_amount += ($balance_time * $per_hour_sal);
                        }else{
                            $exceeded_normal_time = $balance_time;
                            $exceeded_normal_amount += ($balance_time * $per_hour_sal);
                        }
                    }
                    continue;
                }
                if($qualify_exceed_flag){
                    if($data[$i]['type'] == 3){  //oncall
                        $exceeded_oncall_time = $equipment->time_sum($exceeded_oncall_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                        $exceeded_oncall_amount += $total_sal;
                    }else{
                        $exceeded_normal_time = $equipment->time_sum($exceeded_normal_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                        $exceeded_normal_amount += $total_sal;
                    }
                }else{
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
    
    function get_employee_timetable_leaved_work_details_by_date_copy($work_data) {
        /** TESTING
         * refer original version: get_employee_timetable_leaved_work_details_by_date()
         * Author: Shamsu
         * for: calculate total leave hours
         * this function used in salary payment calculation (LSS Report)
         * assing max value 8 to qualifying-total, remaining split into exceed-normal & exceed-oncall (related to slot type)
         * return array(total_time, qualifying_total_time, exceeded_normal_time, exceeded_oncall_time)
         */
        $equipment = new equipment();
        $qualifying_tot_time = 0;
        $grand_total_time = 0;
        $date = $work_data['date'];
        $customer = $work_data['customer'];
        $employee = $work_data['employee'];
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from','time_to', 'date', 'type', 'status');
        $this->conditions = array('AND','date = ?','status = 2' ,'customer = ?','employee = ?');
        $this->condition_values = array($date, $customer, $employee);
        $this->order_by = array('time_from');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $inconvenient_process_obj = new inconvenient();
            $qualify_exceed_flag = FALSE;
            $data_count = count($data);
            $normal_salary = $inconvenient_process_obj->get_salary($data[0]['date'], $employee, 'normal');
            $exceeded_salaries = array();
            $exceeded_salaries_additional = array();
            for($i = 0 ; $i < $data_count; $i++){
//                echo "************************<pre>$i. data: ".print_r($data[$i], 1)."</pre>";
                $inconvenient_process_obj->reset_inconvenient_variables();
                $inconvenient_process_obj->inconv_normal_slots = array($data[$i]);
                $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date']);
                $inconvenient_process_obj->categorize_salary_hours();
//                echo "<pre>Salary hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                
                $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                $grand_total_time = $equipment->time_sum($grand_total_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                //grand total only for calculating total hours
                
                if($time_sum >= 8.00 && !$qualify_exceed_flag){
                    $qualify_exceed_flag = TRUE;
                    $qualifying_tot_time = 8.00;
                    if($time_sum > 8.00){
                        $balance_time = $equipment->time_difference($time_sum, 8.00);
                        $time_array = explode('.', $balance_time);
                        $new_time_from = date('H.i', strtotime('-'.$time_array[0].' hours - '.$time_array[1].' mins', strtotime($data[$i]['time_to'])));
                        $new_data = array('id' => $data[$i]['id'],
                                        'time_from' => $new_time_from,
                                        'time_to' => $data[$i]['time_to'],
                                        'date' => $data[$i]['date'],
                                        'type' => $data[$i]['type'],
                                        'status' => $data[$i]['status']);
//                        echo "<pre>new_data : ".print_r($new_data, 1)."</pre>";
                        $inconvenient_process_obj->reset_inconvenient_variables();
                        $inconvenient_process_obj->inconv_normal_slots = array($new_data);
                        $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $data[$i]['date'], $data[$i]['date']);
                        $inconvenient_process_obj->categorize_salary_hours();
                        $exceeded_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee);
                        $exceeded_salaries_additional = $inconvenient_process_obj->get_addition_salary_hours($employee);
                    }
//                    echo 'qualify_time: '.$qualifying_tot_time;
//                    echo "<pre>Inner Salary hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
//                    echo "<pre>exceeded: ".print_r($exceeded_salaries, 1)."</pre>";
                    continue;
                }
                if($qualify_exceed_flag){
                    $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee);
//                    echo "<pre>sal hours : ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
//                    echo "<pre>new sal: ".print_r($new_salaries, 1)."</pre>";
                    if(!empty($new_salaries) && !empty($exceeded_salaries)){    //check already exist the salary key
                        foreach($new_salaries as $salary_key => $values){
                            $flag = 0;
                            foreach ($exceeded_salaries as $ex_salary_key => $ex_val){
                                if($ex_salary_key == $salary_key){
                                    $flag = 1;
                                    break;
                                }
                            }
//                            if(in_array($salary_key, $exceeded_salaries)){
                            if($flag == 1){
                                $exceeded_salaries[$salary_key]['hour'] = $equipment->time_sum($exceeded_salaries[$salary_key]['hour'], $values['hour']);
                                $exceeded_salaries[$salary_key]['amount'] = $exceeded_salaries[$salary_key]['amount'] != 0.00 ? $exceeded_salaries[$salary_key]['amount'] : $values['amount'];
                            }else{
                                $exceeded_salaries[$salary_key] = $values;
                            }
                        }
                    }else if(!empty($new_salaries)){
                        $exceeded_salaries = $new_salaries;
                    }
                    $new_exceeded_salaries_additional = $inconvenient_process_obj->get_addition_salary_hours($employee);
                    if(!empty($new_exceeded_salaries_additional)){
                        foreach($new_exceeded_salaries_additional as $key => $entries ){
                            foreach($entries as $amount => $h_values ){
                                if(!empty($exceeded_salaries_additional[$key]))
                                    $exceeded_salaries_additional[$key]['hour'] = $equipment->time_sum($exceeded_salaries_additional[$key]['hour'], $h_values['hour']);
                                else{
                                    $exceeded_salaries_additional[$key]['amount'] = $amount;
                                    $exceeded_salaries_additional[$key]['hour'] = $h_values['hour'];
                                }
                            }
                        }
                    }
                }else{
                    $qualifying_tot_time = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                }
//                echo 'qualify_time: '.$qualifying_tot_time;
//                echo "<pre>exceeded: ".print_r($exceeded_salaries, 1)."</pre>";
            }
        }
        $return_array = array(
            'grand_total_time' => $grand_total_time,
            'qualifying_total_time' => $qualifying_tot_time,
            'nomal_salary_amount' => $normal_salary,
            'exceeded_salaries' => $exceeded_salaries,
            'exceeded_salaries_additional' => $exceeded_salaries_additional
        );
        return $return_array;
    }
    
    function process_qualifying_day_hours_copy($work_data, $output_array = array(), $total_vikarie_qualify_time = 0.00) {
        /**
         * Author: Shamsu
         * for: calculate total qualifying hours for vikaries
         * used for salary calculation in sick report
         * TEST
         * for refer original: process_qualifying_day_hours()
         * this function used in salary payment calculation (LSS Report)
         */
        $equipment = new equipment();
        $inconvenient_process_obj = new inconvenient();
        $qualify_exceed_flag = FALSE;
        if(empty($output_array)){
            $qualifying_tot_time = 0;
            $exceeded_salaries = array();
            $additional_qualify = array();
            $qualifying_group = array();
            $additional_exceeded_salaries = array();
        }else{
            $qualifying_tot_time = $output_array['qualifying_total_time'];
//            if($output_array['qualifying_total_time'] >= 8.00)
//                $qualify_exceed_flag = TRUE;
            $exceeded_salaries = $output_array['exceeded_salaries'];
            $additional_qualify = $output_array['additional_qualify'];
            $qualifying_group = $output_array['qualifying_group'];
            $additional_exceeded_salaries = $output_array['additional_exceeded_salaries'];
        }
        if($total_vikarie_qualify_time >= 8.00) $qualify_exceed_flag = TRUE;
        $date = $work_data['date'];
        $employee = $work_data['employee_id'];
//        $normal_salary = $inconvenient_process_obj->get_salary($date, $employee, 'normal');
            
        $inconvenient_process_obj->reset_inconvenient_variables();
        $inconvenient_process_obj->inconv_normal_slots = array($work_data);
        $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $date, $date);
        $inconvenient_process_obj->categorize_salary_hours();
        $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
//        $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee,FALSE);
//        echo "<pre>new_salaries: ".print_r($new_salaries, 1)."</pre>";
//        echo "<pre>addtion_salaries: ".print_r($addtion_salaries, 1)."</pre>===================";
        
        $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
        $temp_vikarie_total_qtime = $equipment->time_sum($total_vikarie_qualify_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
        $process_flag = TRUE;
        if($temp_vikarie_total_qtime >= 8.00 && !$qualify_exceed_flag){
            $qualify_exceed_flag = TRUE;
            $amount_to_complete_8 = $equipment->time_difference(8.00, $total_vikarie_qualify_time);
            $qualifying_tot_time = 8.00;
            $total_vikarie_qualify_time = 8.00;
            $balance_time = $equipment->time_difference($temp_vikarie_total_qtime, 8.00);
            
            $time_array = explode('.', $amount_to_complete_8);
            $new_time_to = date('H.i', strtotime('+'.$time_array[0].' hours + '.$time_array[1].' mins', strtotime($work_data['time_from'])));
            $new_data = array('id' => $work_data['id'],
                            'time_from' => $work_data['time_from'],
                            'time_to' => $new_time_to,
                            'date' => $work_data['date'],
                            'type' => $work_data['type'],
                            'status' => $work_data['status']);
            
            $inconvenient_process_obj->reset_inconvenient_variables();
            $inconvenient_process_obj->inconv_normal_slots = array($new_data);
            $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $work_data['date'], $work_data['date']);
            $inconvenient_process_obj->categorize_salary_hours();
            $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
//            echo "<pre>preSalary Hours: ".print_r($new_salaries, 1)."</pre>";
            
            /*if(!empty($new_salaries)){    //check already exist the salary key
                foreach($new_salaries as $item => $entries){
                    if($entries['hour'] == 0.00) 
                            continue;
                    if(in_array($entries['amount'], array_keys($qualifying_group)))
                        $qualifying_group[$entries['amount']] = $equipment->time_sum($qualifying_group[$entries['amount']], $entries['hour']);
                    else
                        $qualifying_group[$entries['amount']] = $entries['hour'];
                }
            }*/
            if(!empty($new_salaries)){    //check already exist the salary key
                foreach($new_salaries as $item => $entries){
                    if($entries['hour'] == 0.00) 
                            continue;
                    if(in_array($item, array_keys($qualifying_group)))
                        $qualifying_group[$item]['hour'] = $equipment->time_sum($qualifying_group[$item]['hour'], $entries['hour']);
                    else
                        $qualifying_group[$item] = array('hour' => $entries['hour'], 'amount' => $entries['amount']);
                }
            }
            
            $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee,FALSE);
//            echo "<pre>addtion_salaries--: ".print_r($addtion_salaries, 1)."</pre>";
            if(!empty($addtion_salaries)){
                foreach($addtion_salaries as $key => $entries ){
                    foreach($entries as $amount => $h_values ){
                        if(!empty($additional_qualify[$key]))
                            $additional_qualify[$key]['hour'] = $equipment->time_sum($additional_qualify[$key]['hour'], $h_values['hour']);
                        else{
                            $additional_qualify[$key]['amount'] = $amount;
                            $additional_qualify[$key]['hour'] = $h_values['hour'];
                        }
                    }
                }
            }
            
            if($temp_vikarie_total_qtime > 8.00){
                $balance_time = $equipment->time_difference($temp_vikarie_total_qtime, 8.00);
                $time_array = explode('.', $balance_time);
                $new_time_from = date('H.i', strtotime('-'.$time_array[0].' hours - '.$time_array[1].' mins', strtotime($work_data['time_to'])));
                $new_data = array('id' => $work_data['id'],
                                'time_from' => $new_time_from,
                                'time_to' => $work_data['time_to'],
                                'date' => $work_data['date'],
                                'type' => $work_data['type'],
                                'status' => $work_data['status']);
                $inconvenient_process_obj->reset_inconvenient_variables();
                $inconvenient_process_obj->inconv_normal_slots = array($new_data);
                $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $work_data['date'], $work_data['date']);
                $inconvenient_process_obj->categorize_salary_hours();
                $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
//                echo "<pre>post Salary Hours: ".print_r($new_salaries, 1)."</pre>";
                
                if(!empty($new_salaries)){    //check already exist the salary key
                    foreach($new_salaries as $salary_key => $values){
                        if(isset($exceeded_salaries[$salary_key]) && !empty($exceeded_salaries[$salary_key])){
                            $exceeded_salaries[$salary_key]['hour'] = $equipment->time_sum($exceeded_salaries[$salary_key]['hour'], $values['hour']);
                            $exceeded_salaries[$salary_key]['amount'] = $exceeded_salaries[$salary_key]['amount'] != 0.00 ? $exceeded_salaries[$salary_key]['amount'] : $values['amount'];
                        }else{
                            $exceeded_salaries[$salary_key] = $values;
                        }
                    }
                }
                
                $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee,FALSE);
                if(!empty($addtion_salaries)){
                    foreach($addtion_salaries as $key => $entries ){
                        foreach($entries as $amount => $h_values ){
                            if(!empty($additional_exceeded_salaries[$key]))
                                $additional_exceeded_salaries[$key]['hour'] = $equipment->time_sum($additional_exceeded_salaries[$key]['hour'], $h_values['hour']);
                            else{
                                $additional_exceeded_salaries[$key]['amount'] = $amount;
                                $additional_exceeded_salaries[$key]['hour'] = $h_values['hour'];
                            }
                        }
                    }
                }
            }
            $process_flag = FALSE;
        }
        if($process_flag){
            if($qualify_exceed_flag){
                $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
                if(!empty($new_salaries)){    //check already exist the salary key
                    foreach($new_salaries as $salary_key => $values){
                        if(isset($exceeded_salaries[$salary_key]) && !empty($exceeded_salaries[$salary_key])){
                            $exceeded_salaries[$salary_key]['hour'] = $equipment->time_sum($exceeded_salaries[$salary_key]['hour'], $values['hour']);
                            $exceeded_salaries[$salary_key]['amount'] = $exceeded_salaries[$salary_key]['amount'] != 0.00 ? $exceeded_salaries[$salary_key]['amount'] : $values['amount'];
                        }else{
                            $exceeded_salaries[$salary_key] = $values;
                        }
                    }
                }
                
                $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee,FALSE);
                if(!empty($addtion_salaries)){
                    foreach($addtion_salaries as $key => $entries ){
                        foreach($entries as $amount => $h_values ){
                            if(!empty($additional_exceeded_salaries[$key]))
                                $additional_exceeded_salaries[$key]['hour'] = $equipment->time_sum($additional_exceeded_salaries[$key]['hour'], $h_values['hour']);
                            else{
                                $additional_exceeded_salaries[$key]['amount'] = $amount;
                                $additional_exceeded_salaries[$key]['hour'] = $h_values['hour'];
                            }
                        }
                    }
                }
            }else{
//                echo "<pre>Full SSalary Hours: ".print_r($inconvenient_process_obj->salary_hours, 1)."</pre>";
                $new_salaries = $inconvenient_process_obj->calculate_key_based_perhour_salary($employee, FALSE);
//                echo "<pre>FullSalary Hours--: ".print_r($new_salaries, 1)."</pre>";
                $addtion_salaries = $inconvenient_process_obj->get_addition_salary_hours($employee,FALSE);
                if(!empty($addtion_salaries)){
                    foreach($addtion_salaries as $key => $entries ){
                        foreach($entries as $amount => $h_values ){
                            if(!empty($additional_qualify[$key]))
                                $additional_qualify[$key]['hour'] = $equipment->time_sum($additional_qualify[$key]['hour'], $h_values['hour']);
                            else{
                                $additional_qualify[$key]['amount'] = $amount;
                                $additional_qualify[$key]['hour'] = $h_values['hour'];
                            }
                        }
                    }
                }
                $qualifying_tot_time = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
                $total_vikarie_qualify_time = $equipment->time_sum($total_vikarie_qualify_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
                /*if(!empty($new_salaries)){    //check already exist the salary key
                    foreach($new_salaries as $item => $entries){
                        if($entries['hour'] == 0.00) 
                            continue;
                        if(in_array($entries['amount'], array_keys($qualifying_group)))
                            $qualifying_group[$entries['amount']] = $equipment->time_sum($qualifying_group[$entries['amount']], $entries['hour']);
                        else
                            $qualifying_group[$entries['amount']] = $entries['hour'];
                    }
                }*/
                if(!empty($new_salaries)){    //check already exist the salary key
                    foreach($new_salaries as $item => $entries){
                        if($entries['hour'] == 0.00) 
                                continue;
                        if(in_array($item, array_keys($qualifying_group)))
                            $qualifying_group[$item]['hour'] = $equipment->time_sum($qualifying_group[$item]['hour'], $entries['hour']);
                        else
                            $qualifying_group[$item] = array('hour' => $entries['hour'], 'amount' => $entries['amount']);
                    }
                }
            }
        }
        $return_array = array(
            'qualifying_total_time' => $qualifying_tot_time,
            'total_vikarie_qualify_time' => $total_vikarie_qualify_time,
            'qualifying_group' => $qualifying_group,
            'exceeded_salaries' => $exceeded_salaries,
            'additional_qualify' => $additional_qualify,
            'additional_exceeded_salaries' => $additional_exceeded_salaries
        );
//        echo "<pre>Return Array: ".print_r($return_array, 1)."</pre>****************";
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
        if(empty($output_array)){
            $qualifying_tot_time = 0;
            $exceeded_normal_time = 0;
            $exceeded_oncall_time = 0;
            $qualifying_tot_amount = 0;
            $exceeded_normal_amount = 0;
            $exceeded_oncall_amount = 0;
        }else{
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
        $inconvenient_process_obj->generate_work_report_using_input_slots($employee, $date, $date);
        $inconvenient_process_obj->categorize_salary_hours();
        $total_sal = $inconvenient_process_obj->calculate_total_salary($employee);
        
        $time_sum = $equipment->time_sum($qualifying_tot_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
        if($time_sum >= 8.00 && !$qualify_exceed_flag){
            $qualify_exceed_flag = TRUE;
            $amount_to_complete_8 = $equipment->time_difference($time_sum, $qualifying_tot_time);
            $this_time_diff = $equipment->time_difference($work_data['time_to'], $work_data['time_from']);
            $per_hour_sal = $total_sal / $this_time_diff;
            $qualifying_tot_time = 8.00;
            $qualifying_tot_amount += ($amount_to_complete_8 * $per_hour_sal);
            if($time_sum > 8.00){
                $balance_time = $equipment->time_difference($time_sum, 8.00);
                if($work_data['type'] == 3){
                    $exceeded_oncall_time = $balance_time;
                    $exceeded_oncall_amount += ($balance_time * $per_hour_sal);
                }else{
                    $exceeded_normal_time = $balance_time;
                    $exceeded_normal_amount += ($balance_time * $per_hour_sal);
                }
            }
        }
        if($qualify_exceed_flag){
            if($work_data['type'] == 3){  //oncall
                $exceeded_oncall_time = $equipment->time_sum($exceeded_oncall_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
                $exceeded_oncall_amount += $total_sal;
            }else{
                $exceeded_normal_time = $equipment->time_sum($exceeded_normal_time, $equipment->time_difference($work_data['time_to'], $work_data['time_from']));
                $exceeded_normal_amount += $total_sal;
            }
        }else{
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
        if($norm_or_call == 1)          //normal, travel , break
            $types = '\'0,1,2\'';
        else if($norm_or_call == 2)     //break
            $types = '\'3\'';
        
        $this->tables = array('timetable');
        $this->fields = array('id','time_from','time_to');
        $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'status = 2' ,'customer = ?','employee = ?',array('IN','type',$types));
        $this->condition_values = array($date1, $date2, $customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            for($i=0 ; $i<count($data); $i++){
//                $time_from= $data[$i]['time_from'];
//                $time_to= $data[$i]['time_to'];
                $tot_time += $equipment->time_difference($data[$i]['time_from'], $data[$i]['time_to']);
            }
        }
        return $tot_time;
    }    
    
    function get_employee_timetable_leaved_work_details_by_between_2_date_for_vikarie($employee, $customer, $date1, $date2, $norm_or_call = Null) {
        
        $equipment = new equipment();
        $tot_time = 0;
        $types = '';
        if($norm_or_call == 1)          //normal, travel , break
            $types = '\'0,1,2\'';
        else if($norm_or_call == 2)     //break
            $types = '\'3\'';
        else if($norm_or_call == 3)     //all
            $types = '\'0,1,2,3\'';
        
        $this->tables = array('timetable');
        $this->fields = array('id','time_from','time_to');
        $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'status = 1' ,'customer = ?','employee = ?',array('IN','type',$types));
        $this->condition_values = array($date1, $date2, $customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            for($i=0 ; $i<count($data); $i++){
//                $time_from= $data[$i]['time_from'];
//                $time_to= $data[$i]['time_to'];
                $tot_time += $equipment->time_difference($data[$i]['time_from'], $data[$i]['time_to']);
            }
        }
        return $tot_time;
    }    

    function get_employee_leaved_timetable_works($employee,$year,$month,$customer) {
//        $this->tables = array('timetable` as `t','leave` as `l');
//        $this->fields = array('t.id');
//        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 2' ,'t.customer = ?','t.employee = ?',
//                    'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to');
//        
        
        $this->tables = array('timetable` as `t','leave` as `l');
        $this->fields = array('t.employee as employee','t.customer as customer','t.date as date','t.fkkn as fkkn',
            't.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 2','t.customer = ?','t.employee = ?',
             'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to');
        $this->condition_values = array($month,$year,$customer, $employee);
        $this->order_by = array('t.date');
        $this->query_generate();
//        echo $this->sql_query;
        $data = $this->query_fetch();
        //print_r($data);
        return $data;
    }    

    function get_employee_leave_Qualifying_day_works($leave_works) {
        
        $q_days = array();
        $date_diff_for_qlfying = 5;
        $get_previous_month = date('Y-m-d', strtotime($this->leavePeriod_year.'-'. $this->leavePeriod_month. '-18 -1 month')); // previous month;
        $previous_date_digit = explode('-', $get_previous_month);
        $previous_month_leave_works = $this->get_employee_leaved_timetable_works($this->leave_employee, $previous_date_digit[0], $previous_date_digit[1], $this->leave_customer);
//        print_r($previous_month_leave_works);
//        echo $this->leave_customer;
//        print_r($previous_month_leave_works);
        //echo '<br> hello <br>';
        $previous_month_last_work_date = '';
        if($previous_month_leave_works){
            $previous_month_last_work_date = $previous_month_leave_works[count($previous_month_leave_works)-1]['date'];
            //echo $previous_month_last_work_date;
        }else{
            $previous_month_last_work_date = $previous_date_digit[0].'-'. $previous_date_digit[1]. '-01';
        }
        if($leave_works && $previous_month_last_work_date != ''){
            $datefrom = strtotime($previous_month_last_work_date, 0);
            $dateto = strtotime($leave_works[0]['date'], 0);
            $difference = floor(($dateto - $datefrom) / 86400);
            //$datediff = floor($difference / 86400);
            
            if($difference > $date_diff_for_qlfying)
                $q_days[] = $leave_works[0];
        }
        for($i=0 ; $i<count($leave_works); $i++){
            if($i == 0 )
                $i++;
                //$q_days[] = $leave_works[0];
            else if ($i>0){
                $datefrom = strtotime($leave_works[$i-1]['date'], 0);
                $dateto = strtotime($leave_works[$i]['date'], 0);
                $difference = floor(($dateto - $datefrom) / 86400);
                if($difference > $date_diff_for_qlfying)
                    $q_days[] = $leave_works[$i];
            }
        }
        return $q_days;
    }    
    
    function Employee_info_pdf($emp) {

        require_once ('plugins/customize_pdf_employee_info.class.php');
        $skills = $this->get_employee_skills($emp);
        $employee = new employee();
        $emp_details =  $employee->employee_detail('\''.$emp.'\'');
        //print_r($emp_details);
        $pdf = new PDF_Emp_info();
        ///////////////////////////////////////////page 1///////////////////////////////////////////////
//
        $pdf->AddPage(); 

        $pdf->P1_top($emp_details[0]);
        $pdf->P1_table_2($emp_details[0]);
        $pdf->P1_table_3($skills);

        $pdf->Output();
    }

    function get_employee_contract_details($employee = Null, $id = Null, $customer = Null) {
        $this->tables = array('employee_contract');
        $this->fields = array('employee','date_from', 'customer_name', 'customer_social_secutrity', 'tmp_long_assistance_from', 'tmp_long_assistance_to', 'tmp_assistance_for',
            'absence_from', 'absence_to', 'special_appointment', 'probationary_from', 'probationary_to', 'open_ended_appointment', 'prevailing_collective',
            'fulltime', 'part_time', 'salary_month', 'salary_hour', 'incl_salary', 'excl_salary', 'incl_wages', 'act_salary', 'bank_account', 'leave_per_year',
            'incl_holiday_pay', 'excl_holiday_pay', 'incl_salary_compensation', 'special_condition', 'notes','alloc_employee','alloc_date','sign_date');
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
    
    function get_employee_normal_inconvenient_details_by_between_2_dates_for_leaveReport($sdate, $edate, $employee, $customer) {
		//$sdate = '2012-07-09'; $edate = '2012-09-09';
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to', 'date', 'type', 'status');
        $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'status = 2', 'customer = ?');
        $this->condition_values = array($sdate, $edate, $employee, $customer);
        $this->order_by = array('date','time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
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

                $this->condition_values = array($sdate, $edate, $employee, $customer,$work_data['relation_id'],
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

                        $this->condition_values = array($sdate, $edate, $employee, $customer,$work_data['relation_id'],
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
    
    function get_distinct_inconvenient_details_between_2_dates_for_leaveReport($employee,$customer, $sdate, $edate) {
        
            $this->tables = array('inconvenient_timing');
            $this->fields = array('id', 'name', 'time_from', 'time_to', 'days','type');
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
                    $this->fields = array('id', 'name', 'time_from', 'time_to', 'days','type');
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
    
        function get_employee_distinct_inconvenient_details_between_2_dates_for_workReport($employee="",$customer, $sdate, $edate, $type) {
        
            $this->tables = array('inconvenient_timing');
            $this->fields = array('id', 'name', 'time_from', 'time_to', 'days','type');
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
                $this->fields = array('id','employee','customer','time_from','time_to','date'); 
                if($employee!=''){
				
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
				
				}else{
					
					$this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'customer = ?', 'fkkn = ?', 'status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
						array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
							array('AND', 'time_to > ?', 'time_to <= ?'),
							array('AND', 'time_from <= ?', 'time_to >= ?'))
					); 
					
					$this->condition_values = array($sdate, $edate,  $customer, $type,
						(float) $data['time_from'], (float) $data['time_to'],
						(float) $data['time_from'], (float) $data['time_to'],
						(float) $data['time_from'], (float) $data['time_to']
					);
					
				}
				$this->query_generate();	
				$cnt2 =  $this->query_fetch();
                //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
                if (count($cnt2)) { 
                    $normal[$i] = $data;
					//$new_array[] = $cnt;
                    $i++;
                } else {
                    $this->tables = array('inconvenient_timing');
                    $this->fields = array('id', 'name', 'time_from', 'time_to', 'days','type');
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
                        $this->fields = array('id','employee','customer','time_from','time_to','date');
                       
					    if($employee!=''){
							
							$this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', 'customer = ?', 'fkkn = ?','status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
								array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
									array('AND', 'time_to > ?', 'time_to <= ?'),
									array('AND', 'time_from <= ?', 'time_to >= ?'))
							);
	
							$this->condition_values = array($sdate, $edate, $employee, $customer, $type,
								(float) $data_cont['time_from'], (float) $data_cont['time_to'],
								(float) $data_cont['time_from'], (float) $data_cont['time_to'],
								(float) $data_cont['time_from'], (float) $data_cont['time_to']
							);
							
						}else{
							
							$this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'customer = ?', 'fkkn = ?','status = 1', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
								array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
									array('AND', 'time_to > ?', 'time_to <= ?'),
									array('AND', 'time_from <= ?', 'time_to >= ?'))
							);
	
							$this->condition_values = array($sdate, $edate,  $customer, $type,
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
			foreach($normal as $incontime){
				$total = $equipment->time_sum($total, $equipment->time_difference($incontime['time_to'],$incontime['time_from']));
						
			}
            return $total;
				
        }
	
	
        /*function get_distinct_oncall_inconvenient_details_by_month_and_year_for_leaveReport($month, $year, $employee) {
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
    }*/

    function customer_pdf_report_summery_insert($data) {
        /**
         * Author: Shamsu
         * for: To create new samsida entry
         */
        $this->tables = array('samsida');
        $this->fields = array('month', 'year', 'customer', 'how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hospital', 
                'did_u_included_hospitalized_hours', 'hostpitalized_hours', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'signed_employer_name', 'signed_employer_telephone', 'do_u_hire_asst_provider', 'asst_provider_orgno', 
                'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money','asst_provider1','asst_provider_orgno1','asst_provider2','asst_provider_orgno2',
                'asst_provider3','asst_provider_orgno3','do_u_attach_receipt','money_left_not_to_purchase2','money_left2','do_u_live_outside_EEA_country','accounting_date_from','accounting_date_to',
                'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost','salary_OB_period','assist_expenses_cost','assist_expenses_period','training_cost','training_period','staff_expense_cost','staff_expense_period',
                'administration_cost', 'administration_period');
        $this->field_values = array($data['month'], $data['year'], $data['customer'], $data['section_3_choice'], $data['section_3_org_no'], $data['did_u_hostpilized_this_month'], $data['hospital_date_from'], $data['hospital_date_to'], $data['hospital'], 
                $data['did_u_included_hospitalized_hours'], $data['hostpitalized_hours'], $data['other_info'], $data['info_annex'], $data['section6_phone'], $data['signature_options'], $data['signed_customer_name'], $data['signed_customer_telephone'], $data['do_u_hire_asst_provider'], $data['asst_provider_orgno'], 
                $data['rd_money_left_1'], $data['txt_money_left_1'], $data['is_u_r_ur_asst_provider'], $data['do_u_get_himself_money'], $data['asst_provider1'], $data['asst_provider1_orgno'], $data['asst_provider2'], $data['asst_provider2_orgno'], 
                $data['asst_provider3'], $data['asst_provider3_orgno'], $data['attach_receipt'], $data['rd_money_left_2'], $data['txt_money_left_2'], $data['live_out_EEA_country'], $data['acc_date_from'], $data['acc_date_to'], 
                $data['excl_ob_cost'], $data['excl_ob_period'], $data['ob_cost'], $data['ob_period'], $data['asst_exp_cost'], $data['asst_exp_period'], $data['training_cost'], $data['training_period'], $data['staff_expense_cost'], $data['staff_expense_period'], 
                $data['admin_cost'], $data['admin_period']);
        $result_flag = $this->query_insert();

        if ($result_flag)
            return TRUE;
        else
            return FALSE;
    }

    function customer_pdf_report_summery_update($data) {
        /**
         * Author: Shamsu
         * for: update existing samsida record
         */
        $this->tables = array('samsida');
        $this->fields = array('how_is_asst_provided', 'how_is_asst_provided_orgno', 'did_u_hostpilized_this_month', 'hostpilized_date_from', 'hostpilized_date_to', 'hospital', 
                'did_u_included_hospitalized_hours', 'hostpitalized_hours', 'other_info', 'did_u_provide_info_annex', 'signed_customer_phno', 'signature_options', 'signed_employer_name', 'signed_employer_telephone', 'do_u_hire_asst_provider', 'asst_provider_orgno', 
                'have_money_left_not_to_purchase1', 'money_left1', 'is_u_r_ur_asst_provider', 'do_u_get_himself_money','asst_provider1','asst_provider_orgno1','asst_provider2','asst_provider_orgno2',
                'asst_provider3','asst_provider_orgno3','do_u_attach_receipt','money_left_not_to_purchase2','money_left2','do_u_live_outside_EEA_country','accounting_date_from','accounting_date_to',
                'salary_excl_OB_cost', 'salary_excl_OB_period', 'salary_OB_cost','salary_OB_period','assist_expenses_cost','assist_expenses_period','training_cost','training_period','staff_expense_cost','staff_expense_period',
                'administration_cost', 'administration_period');
        $this->field_values = array($data['section_3_choice'], $data['section_3_org_no'], $data['did_u_hostpilized_this_month'], $data['hospital_date_from'], $data['hospital_date_to'], $data['hospital'], 
                $data['did_u_included_hospitalized_hours'], $data['hostpitalized_hours'], $data['other_info'], $data['info_annex'], $data['section6_phone'], $data['signature_options'], $data['signed_customer_name'], $data['signed_customer_telephone'], $data['do_u_hire_asst_provider'], $data['asst_provider_orgno'], 
                $data['rd_money_left_1'], $data['txt_money_left_1'], $data['is_u_r_ur_asst_provider'], $data['do_u_get_himself_money'], $data['asst_provider1'], $data['asst_provider1_orgno'], $data['asst_provider2'], $data['asst_provider2_orgno'], 
                $data['asst_provider3'], $data['asst_provider3_orgno'], $data['attach_receipt'], $data['rd_money_left_2'], $data['txt_money_left_2'], $data['live_out_EEA_country'], $data['acc_date_from'], $data['acc_date_to'], 
                $data['excl_ob_cost'], $data['excl_ob_period'], $data['ob_cost'], $data['ob_period'], $data['asst_exp_cost'], $data['asst_exp_period'], $data['training_cost'], $data['training_period'], $data['staff_expense_cost'], $data['staff_expense_period'], 
                $data['admin_cost'], $data['admin_period']);
        
        $this->conditions = array('AND', 'customer = ?', 'month = ?','year = ?');
        $this->condition_values = array($data['customer'], $data['month'], $data['year']);
			
        $result_flag = $this->query_update();
        if ($result_flag)
            return TRUE;
        else
            return FALSE;
    }
    
    function get_customer_slots_btwn_dates($customer,$start_date, $end_date) {
        
        /**
         * Author: Shamsu
         * for: get active customer slot details between 2 dates
         */
            $this->tables = array('timetable');
            $this->fields = array('employee', 'date', 'time_from', 'time_to');
            $this->conditions = array('AND', 'customer = ?',array('BETWEEN', 'date', '?', '?'), 'status = 1');
            $this->condition_values = array($customer, $start_date, $end_date);
            $this->order_by = array('date', 'time_from');
            $this->query_generate();
            $datas = $this->query_fetch();
            return $datas;
    }
    /* -------------customer work report-------------- end - shamsu------------------------------ */
    /* -------------customer work report-------------- Niyaz------------------------------ */

    function sign_contract($ids){
        $today = date("Y-m-d H:i:s");  
        $this->tables = array("employee_contract");
        $this->fields = array('sign_date');
        $this->field_values = array($today);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        if($this->query_update()){
            return true;
        }else{
            return false;
        }
    }

    /* -------------customer work report-------------- Niyaz END------------------------------ */
}
?>
