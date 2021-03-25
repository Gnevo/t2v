<?php
/**
 * Description of contracts
 * @author shamsudheen
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/company.php');
require_once ('class/equipment.php');
require_once ('class/employee.php');

class contract extends db {

    //variable diclaration
    var $user = '';
    var $date_from = '';
    var $date_to = '';
    var $hours = '';
    var $monthly_oncall_hours = '';
    var $customer_name = '';
    var $customer_social_secutrity = '';
    var $tmp_long_assistance_from = '';
    var $tmp_long_assistance_to = '';
    var $tmp_assistance_for = '';
    var $absence_from = '';
    var $absence_to = '';
    var $special_appointment = '';
    var $probationary_from = '';
    var $probationary_to = '';
    var $open_ended_appointment = '';
    var $prevailing_collective = '';
    var $fulltime = '';
    var $part_time = '';
    var $salary_month = '';
    var $salary_hour = '';
    var $incl_salary = '';
    var $excl_salary = '';
    var $incl_wages = '';
    var $act_salary = '';
    var $bank_account = '';
    var $leave_per_year = '';
    var $excl_holiday_pay = '';
    var $incl_salary_compensation = '';
    var $special_condition = '';
    var $notes = '';
    var $normal_week_hr = '';
    var $oncall_week_hr = '';
    var $have_been_agreed = '';
    var $assistanceChecked = '';
    var $other_customer = '';
    var $employmentType = '';
    var $type_of_contract = '';
    var $expiry_date = '';

    function __construct() {
        $this->smarty = new smartySetup(array("contract.xml"),FALSE);
        parent::__construct();
    }

    function date_difference($fdate, $ldate) {
        $diff = strtotime($ldate) - strtotime($fdate);
        return $diff;
    }

    function makeArray($datas = array()) {

        $data_array = array();
        foreach ($datas as $data) {

            $data_array[$data['id']] = $data['name'];
        }
        return $data_array;
    }

    function employee_contract_dates($employee) {
        /*$this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'customer_name');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->order_by = array('date_from desc');
        $this->query_generate();
        $data = $this->query_fetch();*/
//        return ($data ? $data : FALSE);
        $this->flush();
        $this->sql_query = "SELECT ec.id, ec.employee, ec.date_from, ec.customer_name, c.first_name as customer_first_name, c.last_name  as customer_last_name
            FROM `employee_contract` AS ec
            LEFT JOIN `customer` AS c ON (c.username = ec.customer_name)
            WHERE ec.employee = ? 
            ORDER BY ec.date_from desc";
        $this->condition_values = array($employee);
        $data = $this->query_fetch();
        return $data;
    }

    function employee_contract_full_detail_update($id, $security) {
        $this->tables = array('employee_contract');
        $this->fields = array('date_from', 'date_to', 'hour', 'monthly_oncall_hour', 'customer_name', 'customer_social_secutrity', 'have_been_agreed', 'tmp_long_assistance_from', 'tmp_long_assistance_to',
            'tmp_assistance_for', 'absence_from', 'absence_to', 'special_appointment', 'probationary_from', 'probationary_to', 'open_ended_appointment',
            'prevailing_collective', 'fulltime', 'part_time', 'salary_month', 'salary_hour', 'incl_salary', 'excl_salary', 'incl_wages', 'act_salary',
            'bank_account', 'leave_per_year', 'excl_holiday_pay', 'incl_salary_compensation', 'special_condition', 'notes', 'alloc_employee','normal_week_hr','oncall_week_hr',
            'assistanceChecked', 'other_customer', 'employmentType');
        $this->field_values = array($this->date_from, $this->date_to, $this->hours, $this->monthly_oncall_hours, $this->customer_name, $security, $this->have_been_agreed, $this->tmp_long_assistance_from, $this->tmp_long_assistance_to,
            $this->tmp_assistance_for, $this->absence_from, $this->absence_to, $this->special_appointment, $this->probationary_from, $this->probationary_to, $this->open_ended_appointment,
            $this->prevailing_collective, $this->fulltime, $this->part_time, $this->salary_month, $this->salary_hour, $this->incl_salary, $this->excl_salary, $this->incl_wages, $this->act_salary,
            $this->bank_account, $this->leave_per_year, $this->excl_holiday_pay, $this->incl_salary_compensation, $this->special_condition, $this->notes, $_SESSION['user_id'], $this->normal_week_hr,$this->oncall_week_hr,
            $this->assistanceChecked, $this->other_customer, $this->employmentType);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function employee_contract_add() {
        $this->tables = array('employee_contract');
        $this->fields = array('employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour', 'customer_name', 'customer_social_secutrity', 'have_been_agreed', 'tmp_long_assistance_from', 'tmp_long_assistance_to',
            'tmp_assistance_for', 'absence_from', 'absence_to', 'special_appointment', 'probationary_from', 'probationary_to', 'open_ended_appointment',
            'prevailing_collective', 'fulltime', 'part_time', 'salary_month', 'salary_hour', 'incl_salary', 'excl_salary', 'incl_wages', 'act_salary',
            'bank_account', 'leave_per_year', 'excl_holiday_pay', 'incl_salary_compensation', 'special_condition', 'notes', 'alloc_employee','normal_week_hr','oncall_week_hr',
            'assistanceChecked', 'other_customer', 'employmentType');
        $this->field_values = array($this->user, $this->date_from, $this->date_to, $this->hours, $this->monthly_oncall_hours, $this->customer_name, $this->customer_social_secutrity, $this->have_been_agreed, $this->tmp_long_assistance_from, $this->tmp_long_assistance_to,
            $this->tmp_assistance_for, $this->absence_from, $this->absence_to, $this->special_appointment, $this->probationary_from, $this->probationary_to, $this->open_ended_appointment,
            $this->prevailing_collective, $this->fulltime, $this->part_time, $this->salary_month, $this->salary_hour, $this->incl_salary, $this->excl_salary, $this->incl_wages, $this->act_salary,
            $this->bank_account, $this->leave_per_year, $this->excl_holiday_pay, $this->incl_salary_compensation, $this->special_condition, $this->notes, $_SESSION['user_id'],$this->normal_week_hr,$this->oncall_week_hr,
            $this->assistanceChecked, $this->other_customer, $this->employmentType);

        return $this->query_insert();
    }

    function employee_contract_detail($id) {
        $this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour', 'customer_name', 'customer_social_secutrity', 'have_been_agreed', 'tmp_long_assistance_from', 'tmp_long_assistance_to',
            'tmp_assistance_for', 'absence_from', 'absence_to', 'special_appointment', 'probationary_from', 'probationary_to', 'open_ended_appointment',
            'prevailing_collective', 'fulltime', 'part_time', 'salary_month', 'salary_hour', 'incl_salary', 'excl_salary', 'incl_wages', 'act_salary',
            'bank_account', 'leave_per_year', 'excl_holiday_pay', 'incl_salary_compensation', 'special_condition', 'notes', 'alloc_employee', 'alloc_date', 'sign_date','normal_week_hr','oncall_week_hr',
            'assistanceChecked', 'other_customer', 'employmentType');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function get_working_days($from_date, $to_date) {

        /*if ($from_date > $to_date) {
            $from_date ^= $to_date ^= $from_date ^= $to_date;
        }

        
        // Find the ISO-8601 day of the week for the two dates.
        $sd = date("N", strtotime($from_date));
        $ed = date("N", strtotime($to_date));
        
        // Find the number of weeks between the dates.
        $w = floor((strtotime($to_date) - strtotime($from_date)) / (86400 * 7));    # Divide the difference in the two times by seven days to get the number of weeks.
        if ($ed >= $sd) {
            $w--;
        }        # If the end date falls on the same day of the week or a later day of the week than the start date, subtract a week.
        // Calculate net working days.
        $nwd = max(6 - $sd, 0);     # If the start day is Saturday or Sunday, add zero, otherewise add six minus the weekday number.
        $nwd += min($ed, 5);    # If the end day is Saturday or Sunday, add five, otherwise add the weekday number.
        $nwd += $w * 5;        # Add five days for each week in between.
        // Iterate through the array of holidays. For each holiday between the start and end dates that isn't a Saturday or a Sunday, remove one day.
        */
        /* foreach ($holidays as $h) {
          $h = strtotime($h);
          if ($h > $from_date && $h < $e && date("N", $h) < 6)
          $nwd--;
          } */
        
        //$nwd = ceil(abs($ed - $sd) / 86400);
//        return $nwd;
        return $this->get_days($from_date, $to_date);
    }

    function get_customers() {
        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name', 'social_security');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_contracts_employee($emp) {
        $this->tables = array('employee_contract');
        $this->fields = array('id', "employee", "customer_name", "alloc_employee", "alloc_date", "sign_date");
        $this->conditions = array("employee = ?");
        $this->condition_values = array($emp);
        $this->query_generate();
        $datas = $this->query_fetch();
        if ($datas) {
            return $datas;
        } else {
            return array();
        }
    }

    function remove_sign_contract($ids) {
        $date = null;
        $this->tables = array('employee_contract');
        $this->fields = array('sign_date');
        $this->field_values = array($date);
        $this->conditions = array("id = ?");
        $this->condition_values = array($ids);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    //$this->db_master . '.login'
    function get_password($username) {
        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('password');
        $this->conditions = array('AND', 'username = ?', 'company_id=?');
        $this->condition_values = array($username, $_SESSION['company_id']);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0]['password'];
        } else {
            return false;
        }
    }

    function get_just_previous_contract($customer = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: to get just previous contract of the specified employee
         * $customer added 2017-04-01 - employee contract is based on each customer 
         */
        if($customer == NULL) return array();
        $this->flush();
        $this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour', 'customer_name', 'customer_social_secutrity', 'tmp_long_assistance_from', 'tmp_long_assistance_to',
            'tmp_assistance_for', 'absence_from', 'absence_to', 'special_appointment', 'probationary_from', 'probationary_to', 'open_ended_appointment',
            'prevailing_collective', 'fulltime', 'part_time', 'salary_month', 'salary_hour', 'incl_salary', 'excl_salary', 'incl_wages', 'act_salary',
            'bank_account', 'leave_per_year', 'excl_holiday_pay', 'incl_salary_compensation', 'special_condition', 'notes', 'alloc_employee', 'alloc_date', 'sign_date','normal_week_hr','oncall_week_hr');
        $this->conditions = array('AND', 'employee = ?', 'date_from < ?');
        $this->condition_values = array($this->user, $this->date_from);

        if($customer !== NULL){
            $this->conditions[] = 'customer_name like ?';
            $this->condition_values[] = '%'.$customer.'%';
        }
        $this->order_by = array('date_from DESC');
        $this->limit = 1;
        $this->query_generate();
        $data = $this->query_fetch();
        $this->flush();
        return (!empty($data) ? $data[0] : array());
    }

    function update_contract_time_to($id) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: update just previous contract time_to
         */
        $this->tables = array('employee_contract');
        $this->fields = array('date_to');
        $new_date_to = date('Y-m-d', strtotime('-1 day', strtotime($this->date_from)));
        $this->field_values = array($new_date_to);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function get_collided_contracts($employee, $date_from, $date_to = NULL, $exception_ids = array(), $customer = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @for: getting collided contract time ranges with user time range
         * $customer added 2017-04-01 - employee contract is based on each customer 
         */
        $this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour');
        /* $this->conditions = array('AND', 'employee = ?', 
          array('OR',
          array('AND', 'date_to is null', 'date_from <= ?'),
          array('AND', 'date_to is not null', 'date_from <= ?', 'date_to >= ?'))); */
        if ($date_to != '')
            $date_to_null_conditions = array('AND', 'date_to is null', array('BETWEEN', 'date_from', '\'' . $date_from . '\'', '\'' . $date_to . '\''));
        else
            $date_to_null_conditions = array('AND', 'date_to is null', 'date_from >= \'' . $date_from . '\'');

        $date_to_not_null_conditions = array('OR', array('BETWEEN', '\'' . $date_from . '\'', 'date_from', 'date_to'));
        if ($date_to != '') {
            $date_to_not_null_conditions[] = array('BETWEEN', '\'' . $date_to . '\'', 'date_from', 'date_to');
        }

        $this->conditions = array('AND', 'employee = ?',
            array('OR',
                $date_to_null_conditions,
                array('AND', 'date_to is not null', $date_to_not_null_conditions)));

        if (!empty($exception_ids)) {
            $exception_id_string = '\'' . implode('\', \'', $exception_ids) . '\'';
            $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
        }
        if ($customer !== NULL) {
            $this->conditions[] = 'customer_name like "%'.$customer.'%"';
        }

        $this->condition_values = array($employee);
        $this->order_by = array('date_from', 'date_to');
        $this->query_generate();
       // echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_contract_records($employee, $date_type, $date, $customer = NULL, $mode = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting employee contract records
         * @param: $date_type - type of passed date value
         *          possible values: year_week, date, year_month
         *          data-type: string
         * @param: $date - date of timetable data
         *          possible values format: (Y|W)year_week, (Y|m)year_month, (yyyy-mm-dd)date
         *          data-type: string
         */
        $possible_date_formats = array('year_week', 'date', 'year_month');
        $employee_contracts = array();
        if ($employee == '' || !in_array($date_type, $possible_date_formats))
            return $employee_contracts;

        $this->flush();
        if ($date_type == 'year_week') {
            //$date is in Y|W format
            $week_data = explode('|', $date);
            $year = $week_data[0];
            $week_no = sprintf("%02d", $week_data[1]);
            $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
            $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
            $this->tables = array('employee_contract');
            $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour');
            //            array('IN', 'DATE_FORMAT(date,\'%Y|%v\')', $week_days)
            $this->conditions = array('AND', 'employee = ?',
                array('OR',
                    array('AND', 'date_to is null',
                        array('OR', 'date_from <= ?', 'date_from <= ?')
                    ),
                    array('AND', 'date_to is not null',
                        array('OR',
                            array('BETWEEN', '\'' . $date_from . '\'', 'date_from', 'date_to'),
                            array('BETWEEN', '\'' . $date_to . '\'', 'date_from', 'date_to'),
                            array('BETWEEN', 'date_from', '\'' . $date_from . '\'', '\'' . $date_to . '\''),
                            array('BETWEEN', 'date_to', '\'' . $date_from . '\'', '\'' . $date_to . '\'')
                        )
                    )
                )
            );

            $this->condition_values = array($employee, $date_from, $date_to);
            if($mode == 'HOURS_ONLY'){
                //$this->conditions[] = array('OR', 'hours > 0', 'monthly_oncall_hour > 0');
                $this->conditions[] = array('hour > 0');
            }
            if($customer !== NULL){
                $this->conditions[] = array('OR', 'customer_name like ?', 'customer_name IS NULL', 'customer_name = ?');
                $this->condition_values[] = '%'.$customer.'%';
                $this->condition_values[] = '';
            }
            $this->order_by = array('date_from', 'date_to');
            $this->query_generate();
            $employee_contracts = $this->query_fetch();
        } else if ($date_type == 'year_month') {
            //$date is in Y|m format
            $date_params = explode('|', $date);
            $year = $date_params[0];
            $month_no = sprintf("%02d", $date_params[1]);
            $first_day_of_month = $year . '-' . $month_no . '-01';
            $date_from = date("Y-m-01", strtotime($first_day_of_month));
            $date_to = date("Y-m-t", strtotime($first_day_of_month));
            $this->tables = array('employee_contract');
            $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour');
            $this->conditions = array('AND', 'employee = ?',
                array('OR',
                    array('AND', 'date_to is null',
                        array('OR', 'date_from <= ?', 'date_from <= ?')
                    ),
                    array('AND', 'date_to is not null',
                        array('OR',
                            array('BETWEEN', '\'' . $date_from . '\'', 'date_from', 'date_to'),
                            array('BETWEEN', '\'' . $date_to . '\'', 'date_from', 'date_to'),
                            array('BETWEEN', 'date_from', '\'' . $date_from . '\'', '\'' . $date_to . '\''),
                            array('BETWEEN', 'date_to', '\'' . $date_from . '\'', '\'' . $date_to . '\'')
                        )
                    )
                )
            );
            $this->condition_values = array($employee, $date_from, $date_to);
            if($customer !== NULL){
                $this->conditions[] = array('OR', 'customer_name like ?', 'customer_name IS NULL', 'customer_name = ?');
                $this->condition_values[] = '%'.$customer.'%';
                $this->condition_values[] = '';
            }
            if($mode == 'HOURS_ONLY'){
                $this->conditions[] = array('hour > 0');
            }
            $this->order_by = array('date_from', 'date_to');
            $this->query_generate();
            $employee_contracts = $this->query_fetch();
        } else if ($date_type == 'date') {
            //$date is in yyyy-mm-dd format
            $this->tables = array('employee_contract');
            $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour');
            $this->conditions = array('AND', 'employee = ?',
                array('OR',
                    array('AND', 'date_to is null', 'date_from <= ?'),
                    array('AND', 'date_to is not null', array('BETWEEN', '\'' . $date . '\'', 'date_from', 'date_to'))
                )
            );
            $this->condition_values = array($employee, $date);
            echo $customer;
            if($customer !== NULL){
                $this->conditions[] = array('OR', 'customer_name like ?', 'customer_name IS NULL', 'customer_name = ?');
                $this->condition_values[] = '%'.$customer.'%';
                $this->condition_values[] = '';
            }
            if($mode == 'HOURS_ONLY'){
                //$this->conditions[] = array('OR', 'hours > 0', 'monthly_oncall_hour > 0');
                $this->conditions[] = array('hour > 0');
            }
            $this->order_by = array('date_from', 'date_to');
            $this->query_generate();
            $employee_contracts = $this->query_fetch();
        }

        return $employee_contracts;
    }

    function get_customer_details_assigned_customers($cust) {
        $cust_usernames = explode(",", $cust);
        $condition = array('OR');
        for ($i = 0; $i < count($cust_usernames); $i++) {
            $condition[] = 'username = "' . $cust_usernames[$i] . '"';
        }
        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name', 'social_security', 'century', 'code');
        $this->conditions = $condition;
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return array();
        }
    }

    //to get the expected contract hours between dates
    // expecting no contgract overlap.
    function get_employee_contract_between_dates($employee, $date_from, $date_to) {
        global $preference;
        $days_in_week = $preference['days_in_week'];
        $obj_equipment = new equipment();
        $obj_company = new company();
        $obj_employee = new employee();
        $full_time_hour = 48;
        $contract_details['fulltime'] = 1;
        $contract_details['percentage'] = 100;
        $contract_details['name'] = '';
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        $company_ordinary_contract = round($obj_equipment->time_user_format($company_details['weekly_hour'], 100) / $days_in_week , 2);
        $company_oncall_contract = $company_details['monthly_oncall_hour'];
        $this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour', 'monthly_oncall_hour', 'fulltime', 'part_time', '(SELECT first_name FROM employee where username = employee_contract.employee) AS first_name', '(SELECT last_name FROM employee where username = employee_contract.employee) AS last_name');
        $this->conditions = array('AND', 'employee = ?',
            array('OR',
                array('AND', 'date_to is null', 'date_from <= ?'),
                array('AND', 'date_to is not null', 'date_from <= ?', 'date_to > ?')
            )
        );
        $this->condition_values = array($employee, $date_to, $date_to, $date_from);
        $this->order_by = array('date_from', 'date_to');
        $this->query_generate();
        $employee_contracts = $this->query_fetch();
        //echo "<pre>\n".print_r($employee_contracts, 1)."</pre>";
        $tmp_date_from = $date_from;
        $tmp_date_to = $date_to;
        $contract_hours = 0;
        $i = 0;
        foreach ($employee_contracts as $contract) {
            $i++;
            if ($i == 1) {
                $contract_details['fulltime'] = $contract['fulltime'];
                if ($contract_details['fulltime'] == 2) {
                    $contract_details['percentage'] = round($contract['part_time'] / $full_time_hour * 100, 2);
                }
                $contract_details['last_name'] = $contract['last_name'];
                $contract_details['first_name'] = $contract['first_name'];
                $contract_details['name'] = $contract['last_name'] . " " . $contract['first_name'];
            }
            if (strtotime($tmp_date_from) < strtotime($contract['date_from'])) {
                $working_days = $this->get_days($tmp_date_from, date('Y-m-d H:i:s', strtotime('-1 day', strtotime($contract['date_from']))));
                $tmp_contract = $obj_equipment->time_user_format(round($company_ordinary_contract * $working_days , 2));
                $contract_hours = $obj_equipment->time_sum($contract_hours, $tmp_contract);
                //$contract_hours = $obj_equipment->time_sum($contract_hours, $this->get_oncall_employee_contract_between_days($tmp_date_from, date('Y-m-d H:i:s', strtotime('-1 day', strtotime($contract['date_from']))), $company_oncall_contract));
                
                $tmp_date_from = $contract['date_from'];
            }

            $tmp_date_to = $contract['date_to'];
            if ($contract['date_to'] == '' || strtotime($contract['date_to']) > strtotime($date_to)) {
                $tmp_date_to = $date_to;
            }
            $employee_ordinary_contract = round($obj_equipment->time_user_format($contract['hour'], 100) / $days_in_week , 2);
            //echo $tmp_date_from."----".$tmp_date_to."<br>";
            $working_days = $this->get_days($tmp_date_from, $tmp_date_to);
            //echo $working_days."<br>";
            $tmp_contract = $obj_equipment->time_user_format(round($employee_ordinary_contract * $working_days , 2));
            //echo $contract_hours."-----".$tmp_contract."<br>";
            $contract_hours = $obj_equipment->time_sum($contract_hours, $tmp_contract);
            //$contract_hours = $obj_equipment->time_sum($contract_hours, $this->get_oncall_employee_contract_between_days($tmp_date_from, $tmp_date_to, $employee_oncall_contract));
            //echo $contract_hours."<br>";
            $tmp_date_from = date('Y-m-d', strtotime('+1 day', strtotime($tmp_date_to)));
        }
        if (strtotime($tmp_date_from) < strtotime($date_to)) {

            
            $working_days = $this->get_days($tmp_date_from, $date_to);

            //echo $working_days."<br>";
            //echo $company_ordinary_contract * $working_days . "<br>";
            $tmp_contract = $obj_equipment->time_user_format(round($company_ordinary_contract * $working_days , 2));
            //echo $tmp_contract."<br>";
            $contract_hours = $obj_equipment->time_sum($contract_hours, $tmp_contract);
            //$contract_hours = $obj_equipment->time_sum($contract_hours, $this->get_oncall_employee_contract_between_days($tmp_date_from, $date_to, $company_oncall_contract));
            
        }
        if (empty($employee_contracts)) {
            $employee_details = $obj_employee->get_employee_detail($employee);
            $contract_details['last_name'] = $employee_details['last_name'];
            $contract_details['first_name'] = $employee_details['first_name'];
        }
        $contract_details['contract_hours'] = $obj_equipment->time_user_format($contract_hours,100);
        //echo "<pre>\n".print_r($contract_details, 1)."</pre>";
        return $contract_details;
    }

    
    function get_oncall_employee_contract_between_days($date_from, $date_to, $contract = null){
        $obj_company = new company();
        $obj_equipment = new equipment();
        if($contract === null){
            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
            $company_oncall_contract = $obj_equipment->time_user_format($company_details['monthly_oncall_hour'],100);
        }else{
            $company_oncall_contract = $obj_equipment->time_user_format($contract, 100);
        }
        $year_start = substr($date_from, 0, 4);
        $year_end = substr($date_to, 0, 4);
        $month_start = substr($date_from, 5,2);
        $month_end = substr($date_to, 5,2);
        $month_count = $month_start;
        $year_count = $year_start;
        $contract_hours = 0;
        //echo $year_count."---".$year_end."---".$month_count."---".$month_end."<br>";
        $i = 0;
        while((int)$year_count < (int)$year_end || ((int)$month_count <= (int)$month_end && (int)$year_count == (int)$year_end)){
            
            $num = cal_days_in_month(CAL_GREGORIAN, $month_count, $year_end);
            $month_start_date = $year_count."-".sprintf("%02s",$month_count)."-01";
            $month_end_date = $year_count."-".sprintf("%02s",$month_count)."-".$num;
            //echo $month_start_date."-----".$month_end_date."<br>";
            //echo $date_from."---".$month_start_date."<br>";
            if(strtotime($date_from) <= strtotime($month_start_date) && strtotime($date_to) >= strtotime($month_end_date)){
                $contract_hours += $company_oncall_contract;
                //echo $contract_hours."<br>";
            }elseif(strtotime($date_from) > strtotime($month_start_date)){
                $tot_working_days_in_month = $this->get_working_days($month_start_date, $month_end_date);
                $month_start_date = $date_from;
                if(strtotime($date_to) < strtotime($month_end_date)){
                    $month_end_date = $date_to;
                }
                $tot_period_days_in_month = $this->get_working_days($month_start_date, $month_end_date);
                $contract_hours += round($company_oncall_contract/$tot_working_days_in_month*$tot_period_days_in_month , 2);
            }elseif(strtotime($date_to) < strtotime($month_end_date)){
                $tot_working_days_in_month = $this->get_working_days($month_start_date, $month_end_date);
                $month_end_date = $date_to;
                if(strtotime($date_from) > strtotime($month_start_date)){
                    $month_start_date = $date_from;
                }
                //echo $month_start_date."-----".$month_end_date."<br>";
                $tot_period_days_in_month = $this->get_working_days($month_start_date, $month_end_date);
                //echo " asdddsd ".$company_oncall_contract."----".$tot_working_days_in_month."-----".$tot_period_days_in_month."<br>";
                //echo $contract_hours." result  ".round($company_oncall_contract/$tot_working_days_in_month*$tot_period_days_in_month , 2)."<br>";
                $contract_hours += round($company_oncall_contract/$tot_working_days_in_month*$tot_period_days_in_month , 2);
                //echo $contract_hours."<br>";
            }
            
            if($month_count == 12){
                $month_count = 1;
                $year_count ++;
            }
            else
                $month_count++;
        }
        //echo $contract_hours."divided<br>";
        return $obj_equipment->time_user_format($contract_hours);
        
    }
    

    function per_of_employement_data($name, $fromdate, $todate, $customer_id = NULL) {
        
        //if have a customer - then pick customer belowed employees, else took an employee / all employees
        
        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $name = strtolower(urldecode(str_replace('_', ' ', $name)));
        $obj_employee = new employee();
        $employee_data = array();

        if($customer_id != NULL){
            $team_members = $obj_employee->team_members_for_employee_detailed_report($customer_id);
            if(!empty($team_members)){
               // echo "<pre>".print_r($team_members, 1)."</pre>";
                foreach ($team_members as $employees) {
                    $contract = $this->get_employee_contract_between_dates($employees['username'], $fromdate, $todate);
                    $full_time = '';
                    $part_time = '';
                    if ($contract['fulltime'] == 1)
                        $full_time = '1';
                    else
                        $part_time = '1';
                    $employee_data[] = array(
                        'empusername' => $employees['username'],
                        'tothrs' => $contract['contract_hours'],
                        'fulltime' => $full_time,
                        'part_time' => $part_time,
                        'percentage' => $contract['percentage'],
                        'date_from' => $fromdate,
                        'date_to' => $todate,
                        'first_name' => $contract['first_name'],
                        'last_name' => $contract['last_name'],
                        'contract_weeks' => ''
                    );
                }
            }
        }
        else if ($name == '-' || $name == '') {
            switch ($login_user_role) {
                case 1:
                case 6:
                    $search_employees = $obj_employee->employees_list_for_right_click($_SESSION['user_id'], 1);
                    // echo "<pre>".print_r($search_employees, 1)."<pre>";
                    // $team_members = $obj_employee->team_members($login_user);
                    // echo "<pre>".print_r($team_members, 1)."<pre>";
                    // foreach ($team_members as $employees) {
                    foreach ($search_employees as $employees) {
                        $contract = $this->get_employee_contract_between_dates($employees['username'], $fromdate, $todate);
                        $full_time = '';
                        $part_time = '';
                        if ($contract['fulltime'] == 1) {
                            $full_time = '1';
                        } else {
                            $part_time = '1';
                        }
                        $employee_data[] = array(
                            'empusername' => $employees['username'],
                            'tothrs' => $contract['contract_hours'],
                            'fulltime' => $full_time,
                            'part_time' => $part_time,
                            'percentage' => $contract['percentage'],
                            'date_from' => $fromdate,
                            'date_to' => $todate,
                            'first_name' => $contract['first_name'],
                            'last_name' => $contract['last_name'],
                            'contract_weeks' => ''
                        );
                    }

                    break;

                case 2:
                case 7:
                    $team_members = $obj_employee->team_members($login_user);
                    foreach ($team_members as $employees) {
                        $contract = $this->get_employee_contract_between_dates($employees, $fromdate, $todate);
                        $full_time = '';
                        $part_time = '';
                        if ($contract['fulltime'] == 1) {
                            $full_time = '1';
                        } else {
                            $part_time = '1';
                        }
                        $employee_data[] = array(
                            'empusername' => $employees,
                            'tothrs' => $contract['contract_hours'],
                            'fulltime' => $full_time,
                            'part_time' => $part_time,
                            'percentage' => $contract['percentage'],
                            'date_from' => $fromdate,
                            'date_to' => $todate,
                            'first_name' => $contract['first_name'],
                            'last_name' => $contract['last_name'],
                            'contract_weeks' => ''
                        );
                    }

                    break;

                case 3:
                case 5:

                    $contract = $this->get_employee_contract_between_dates($login_user, $fromdate, $todate);
                    $full_time = '';
                    $part_time = '';
                    if ($contract['fulltime'] == 1) {
                        $full_time = '1';
                    } else {
                        $part_time = '1';
                    }
                    $employee_data[] = array(
                        'empusername' => $login_user,
                        'tothrs' => $contract['contract_hours'],
                        'fulltime' => $full_time,
                        'part_time' => $part_time,
                        'percentage' => $contract['percentage'],
                        'date_from' => $fromdate,
                        'date_to' => $todate,
                        'first_name' => $contract['first_name'],
                        'last_name' => $contract['last_name'],
                        'contract_weeks' => ''
                    );

                    break;
            }
        } else {
            $contract = $this->get_employee_contract_between_dates($name, $fromdate, $todate);
            $full_time = '';
            $part_time = '';
            if ($contract['fulltime'] == 1) {
                $full_time = '1';
            } else {
                $part_time = '1';
            }
            $employee_data[] = array(
                'empusername' => $name,
                'tothrs' => $contract['contract_hours'],
                'fulltime' => $full_time,
                'part_time' => $part_time,
                'percentage' => $contract['percentage'],
                'date_from' => $fromdate,
                'date_to' => $todate,
                'first_name' => $contract['first_name'],
                'last_name' => $contract['last_name'],
                'contract_weeks' => ''
            );
        }

        return (!empty($employee_data) ? $employee_data : array());
    }

    function get_days($start, $end) {
        
        if ($start > $end) {
            $start ^= $end ^= $start ^= $end;
        }
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400) + 1;
    }

    function get_all_employee_contract_details(){
        // echo $this->expiry_date;
        $contract_details = array();
        if($this->type_of_contract == 2){
            $this->sql_query = " SELECT ".($_SESSION['company_sort_by'] == 1 ? " concat(first_name, ' ', last_name)" : " concat(last_name, ' ', first_name)")." as `emp_name`  ,`date_from`, IF(MAX(`date_to`) IS NOT NULL ,MAX(`date_to`),IF(MAX(`date_inactive`) IS NOT NULL,MAX(`date_inactive`),null )) `contract_expiry_date`,`employee`,emc.id FROM `employee` em LEFT JOIN `employee_contract` emc ON em.username = emc.employee WHERE emc.date_from <= '".$this->expiry_date."' AND coalesce(emc.date_to, em.date_inactive) <= '".$this->expiry_date."' GROUP BY `employee` ";
            $contract_details['expired_contract'] = $this->query_fetch();
        }
        else if($this->type_of_contract == 1){
            $this->sql_query = "SELECT  ".($_SESSION['company_sort_by'] == 1 ? " concat(first_name, ' ', last_name)" : " concat(last_name, ' ', first_name)")." as `emp_name` , `date_from`, IF(`date_to` IS NOT NULL ,`date_to`,IF(`date_inactive` IS NOT NULL,`date_inactive`,null )) `contract_expiry_date`,`employee`,emc.id FROM `employee` em LEFT JOIN `employee_contract` emc ON em.username = emc.employee WHERE emc.date_from <='".$this->expiry_date."' AND (coalesce(emc.date_to, em.date_inactive) >= '".$this->expiry_date."' OR (em.date_inactive IS NULL AND emc.date_to IS NULL)) ORDER BY `employee`,`date_from` ";

            // $this->sql_query = "SELECT ".($_SESSION['company_sort_by'] == 1 ? " concat(first_name, ' ', last_name)" : " concat(last_name, ' ', first_name)")." as `emp_name` ,GROUP_CONCAT(`date_from` ORDER BY `date_from` ASC) `date_from`, GROUP_CONCAT(IF(`date_to` IS NOT NULL ,`date_to`,IF(`date_inactive` IS NOT NULL,`date_inactive`,null )) ORDER BY `date_from`) `date_to` FROM `employee` em LEFT JOIN `employee_contract` emc ON em.username = emc.employee WHERE emc.date_from <= CURDATE() AND (coalesce(emc.date_to, em.date_inactive) >= CURDATE() OR (em.date_inactive IS NULL AND emc.date_to IS NULL)) GROUP BY `employee`";  

            $contract_details['active_contract'] = $this->query_fetch();
        }
        else if($this->type_of_contract == 3){
            $this->sql_query = "SELECT ".($_SESSION['company_sort_by'] == 1 ? " concat(first_name, ' ', last_name)" : " concat(last_name, ' ', first_name)")." as `emp_name`  FROM `employee` em LEFT  JOIN `employee_contract` emc  ON (em.username = emc.employee)  WHERE emc.employee IS NULL";
            $contract_details['without_contract'] = $this->query_fetch();
        }
        return $contract_details;
        // exit('chg');
    }

    function print_pdf($contract_details){
        ob_start ();
        require_once('plugins/pdf_contract_employee_report.class.php');
        $pdf                  = new PDF_contract_report();
        $pdf->contract_details = $contract_details;
        $pdf->AddPage();
        $pdf->main_part();
        $pdf->Output(utf8_decode($this->smarty->translate['Contract_Employee_List']).'.pdf','I');
         ob_end_flush(); 
    }
 
}
?>