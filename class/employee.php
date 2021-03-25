<?php

/**
 * Description of employee
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
require_once ('class/inconvenient_timing.php');
//require_once ('plugins/message.class.php');
require_once ('class/dona.php');

require_once('class/contract.php');
require_once('class/company.php');
require_once('class/equipment.php');
require_once('class/copy_paste.php');
require_once('class/general.php');

class employee extends db {

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
    var $form_form_1 = '';
    var $form_form_2 = '';
    var $form_form_3 = '';
    var $form_form_4 = '';
    var $form_form_5 = '';
    var $form_form_6 = '';
    var $form_form_7 = '';
    var $form_form_1_report = '';
    var $form_form_2_report = '';
    var $form_form_3_report = '';
    var $general_add_employee = '';
    var $general_edit_employee = '';
    var $general_edit_customer = '';
    var $general_add_customer = '';
    var $general_inconvenient_timing = '';
    var $general_administration = '';
    var $general_chat = '';
    var $mc_leave_notification = '';
    var $mc_leave_approval = '';
    var $mc_approve_all_leave = 0;
    var $mc_leave_rejection = '';
    var $mc_notes_attchment = '';
    var $mc_leave_edit = '';
    var $cirrus_mail = '';
    var $external_mail = '';
    var $mc_notes = '';
    var $mc_sms = '';
    var $mc_sms_general = 0;
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
    var $report_available_employees = '';
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

    var $general_customer_settings_insurance_fk = 0;
    var $general_customer_settings_insurance_kn = 0;
    var $general_customer_settings_insurance_tu = 0;
    var $general_customer_settings_implan = 0;
    var $general_customer_settings_deswork = 0;
    var $general_customer_settings_documentation = 0;
    var $general_customer_settings_equipment = 0;
    var $general_customer_settings_privileges = 0;
    var $general_customer_settings_appointment = 0;
    var $general_customer_settings_oncall = 0;
    var $general_customer_settings_3066 = 0;
    var $general_customer_settings_sick_form_defaults = 0;
    var $general_customer_settings_location = 0;
    var $general_employee_settings_contract = 0;
    var $general_employee_settings_salary = 0;
    var $general_employee_settings_notification = 0;
    var $general_employee_settings_privileges = 0;
    var $general_employee_settings_cv = 0;
    var $general_employee_settings_documentation = 0;
    var $general_employee_settings_preference = 0;
    var $recruitment ='';

    var $employee_contract_start_month = NULL;
    var $employee_contract_month_start_date = NULL;
    var $employee_contract_period_length = NULL;
    var $candg_follow = 0;
    var $general_employee_checklist_preference = 0;
    var $employee_skill_report_privilege = 0;

    var $form_employee_termination = '';
	var $cust_social_security_number = NULL;
    var $emp_social_security_number = NULL;

    function __construct() {

        parent::__construct();
    }

    /*     * ********************************** */
    /* Start Viteb Functions */
    // This Functions are needed to execute viteb reports
    /*     * ********************************** */

    //Employee to customer data 
    function employee_emptocust_data($year, $key) {
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $team_members = $this->team_members($login_user);

        $key = strtolower(urldecode($key));

        switch ($login_user_role) {
            case 1:
            case 6:
                $this->tables = array('employee` as `e', 'customer` as `c', 'team` as `tm');
                $this->fields = array('tm.customer as custid', 'e.first_name AS empfname', 'e.last_name AS emplname', 'c.first_name AS custfname', 'c.last_name AS custlname', 'c.social_security AS custssn', 'e.username', 'e.phone', 'e.status', 'c.status', 'e.mobile');
                $this->conditions = array('AND', 'e.username = tm.employee', 'c.username = tm.customer', 'c.status = 1', 'e.status = 1');
                if ($key != '-')
                    $this->conditions[] = '(LCASE(c.last_name) LIKE "' . $key . '%" OR LCASE(c.last_name) LIKE "' . mb_strtolower($key) . '%")';
                $this->group_by = array('tm.employee', 'tm.customer');
                $this->order_by = array('LOWER(c.last_name)', 'LOWER(c.first_name)', 'LOWER(e.last_name)', 'LOWER(e.first_name)');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;

            case 2:
            case 7:
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee` as `e', 'customer` as `c', 'team` as `tm');
                $this->fields = array('tm.customer as custid', 'e.first_name AS empfname', 'e.last_name AS emplname', 'c.first_name AS custfname', 'c.last_name AS custlname', 'c.social_security AS custssn', 'e.username', 'e.phone', 'e.status', 'c.status', 'e.mobile');
                $this->conditions = array('AND', 'e.username = tm.employee', 'c.username = tm.customer', 'c.status = 1', 'e.status = 1', array('IN', 'tm.employee', $team_employee_data));
                if ($key != '-')
                    $this->conditions[] = '(LCASE(c.last_name) LIKE "' . $key . '%" OR LCASE(c.last_name) LIKE "' . mb_strtolower($key) . '%")';
                $this->group_by = array('tm.employee', 'tm.customer');
                $this->order_by = array('LOWER(c.last_name)', 'LOWER(c.first_name)', 'LOWER(e.last_name)', 'LOWER(e.first_name)');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;

            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->tables = array('employee` as `e', 'customer` as `c', 'team` as `tm');
                $this->fields = array('tm.customer as custid', 'e.first_name AS empfname', 'e.last_name AS emplname', 'c.first_name AS custfname', 'c.last_name AS custlname', 'c.social_security AS custssn', 'e.username', 'e.phone', 'e.status', 'c.status', 'e.mobile');
                $this->conditions = array('AND', 'e.username = tm.employee', 'c.username = tm.customer', 'c.status = 1', 'e.status = 1', array('IN', 'tm.employee', $team_employee_data));
                if ($key != '-')
                    $this->conditions[] = '(LCASE(c.last_name) LIKE "' . $key . '%" OR LCASE(c.last_name) LIKE "' . mb_strtolower($key) . '%")';
                $this->group_by = array('tm.employee', 'tm.customer');
                $this->order_by = array('LOWER(c.last_name)', 'LOWER(c.first_name)', 'LOWER(e.last_name)', 'LOWER(e.first_name)');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;

            case 4:
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee` as `e', 'customer` as `c', 'team` as `tm');
                $this->fields = array('tm.customer as custid', 'e.first_name AS empfname', 'e.last_name AS emplname', 'c.first_name AS custfname', 'c.last_name AS custlname', 'c.social_security AS custssn', 'e.username', 'e.phone', 'e.status', 'c.status', 'e.mobile');
                $this->conditions = array('AND', 'e.username = tm.employee', 'c.username = tm.customer', 'c.status = 1', 'e.status = 1', array('IN', 'tm.employee', $team_employee_data));
                if ($key != '-')
                    $this->conditions[] = '(LCASE(c.last_name) LIKE "' . $key . '%" OR LCASE(c.last_name) LIKE "' . mb_strtolower($key) . '%")';
                $this->group_by = array('tm.employee', 'tm.customer');
                $this->order_by = array('LOWER(c.last_name)', 'LOWER(c.first_name)', 'LOWER(e.last_name)', 'LOWER(e.first_name)');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
        }
        return !empty($employee_data) ? $employee_data : array();
    }

    //Employee active in active data
    function employee_activeinactive_data($key = NULL, $status, $order) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        if ($order == '-')
            $order = 'ascname';

        $search_key = NULL;
        if($key != '-' && $key != ''){
            $fullname = str_replace('_', ' ', $key);
            $search_key = strtolower(urldecode($fullname));
        }

        $order_by = array();
        switch ($order) {
            case 'ascnum':     $order_by = array('e.code'); break;
            case 'descnum':    $order_by = array('e.code DESC'); break;
            case 'ascssn':     $order_by = array('e.social_security ASC'); break;
            case 'descssn':    $order_by = array('e.social_security DESC'); break;
            case 'ascname':    $order_by = array('LOWER(e.last_name) collate utf8_bin ASC, LOWER(e.first_name) collate utf8_bin ASC'); break;
            case 'descname':   $order_by = array('LOWER(e.last_name) collate utf8_bin DESC, LOWER(e.first_name) collate utf8_bin DESC'); break;
            case 'asccustname':    $order_by = array('LOWER(customer_name) collate utf8_bin ASC'); break;
            case 'desccustname':   $order_by = array('LOWER(customer_name) collate utf8_bin DESC'); break;
        }

        switch ($login_user_role) {
            case 1:
            case 6:
                $this->flush();
                $this->sql_query = "SELECT e.username, e.code, e.first_name, e.last_name, e.social_security, e.century, e.city, e.phone, e.mobile, e.status, e.email, e.address, e.post,
                    c.username as customer_username, ".($_SESSION['company_sort_by'] == 1 ? " concat(c.first_name, ' ', c.last_name)" : " concat(c.last_name, ' ', c.first_name)")." as customer_name 
                    FROM `employee` as `e`
                    LEFT JOIN `team` as `t` ON (t.employee = e.username)
                    LEFT JOIN `customer` as `c` ON (c.username = t.customer) ";
                $this->sql_query .= " WHERE 1 ";
                if ($status != '-')
                    $this->sql_query .=  ' AND e.status = ' . $status;
                if($search_key != NULL)
                    $this->sql_query .=  ' AND (LCASE(e.last_name) LIKE "' . $search_key . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($search_key) . '%")';
                if(!empty($order_by))
                    $this->sql_query .= ' ORDER BY '.$order_by[0];
                $employee_data = $this->query_fetch();

                break;
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                
                $this->flush();
                $this->sql_query = "SELECT e.username, e.code, e.first_name, e.last_name, e.social_security, e.century, e.city, e.phone, e.mobile, e.status, e.email, e.address, e.post,
                    c.username as customer_username, ".($_SESSION['company_sort_by'] == 1 ? " concat(c.first_name, ' ', c.last_name)" : " concat(c.last_name, ' ', c.first_name)")." as customer_name 
                FROM `employee` as `e`
                LEFT JOIN `team` as `t` ON (t.employee = e.username)
                LEFT JOIN `customer` as `c` ON (c.username = t.customer) ";
                $this->sql_query .= " WHERE 1 AND (e.username IN ( ".$team_employee_data." ))";
                if ($status != '-')
                    $this->sql_query .=  ' AND e.status = ' . $status;
                if($search_key != NULL)
                    $this->sql_query .=  ' AND (LCASE(e.last_name) LIKE "' . $search_key . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($search_key) . '%")';
                if(!empty($order_by))
                    $this->sql_query .= ' ORDER BY '.$order_by[0];
                $employee_data = $this->query_fetch();
                break;
            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->flush();
                $this->sql_query = "SELECT e.username, e.code, e.first_name, e.last_name, e.social_security, e.century, e.city, e.phone, e.mobile, e.status, e.email, e.address, e.post,
                    c.username as customer_username, ".($_SESSION['company_sort_by'] == 1 ? " concat(c.first_name, ' ', c.last_name)" : " concat(c.last_name, ' ', c.first_name)")." as customer_name 
                FROM `employee` as `e`
                LEFT JOIN `team` as `t` ON (t.employee = e.username)
                LEFT JOIN `customer` as `c` ON (c.username = t.customer) ";
                $this->sql_query .= " WHERE 1 AND (e.username IN ( ".$team_employee_data." ))";
                if ($status != '-')
                    $this->sql_query .=  ' AND e.status = ' . $status;
                if($search_key != NULL)
                    $this->sql_query .=  ' AND (LCASE(e.last_name) LIKE "' . $search_key . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($search_key) . '%")';
                if(!empty($order_by))
                    $this->sql_query .= ' ORDER BY '.$order_by[0];
                $employee_data = $this->query_fetch();
                break;
            case 4:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->flush();
                $this->sql_query = "SELECT e.username, e.code, e.first_name, e.last_name, e.social_security, e.century, e.city, e.phone, e.mobile, e.status, e.email, e.address, e.post,
                    c.username as customer_username, ".($_SESSION['company_sort_by'] == 1 ? " concat(c.first_name, ' ', c.last_name)" : " concat(c.last_name, ' ', c.first_name)")." as customer_name 
                FROM `employee` as `e`
                LEFT JOIN `team` as `t` ON (t.employee = e.username)
                LEFT JOIN `customer` as `c` ON (c.username = t.customer) ";
                $this->sql_query .= " WHERE 1 AND (e.username IN ( ".$team_employee_data." ))";
                if ($status != '-')
                    $this->sql_query .=  ' AND e.status = ' . $status;
                if($search_key != NULL)
                    $this->sql_query .=  ' AND (LCASE(e.last_name) LIKE "' . $search_key . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($search_key) . '%")';
                if(!empty($order_by))
                    $this->sql_query .= ' ORDER BY '.$order_by[0];
                $employee_data = $this->query_fetch();
                break;
        }

        if (!empty($employee_data)) {
            return $employee_data;
        } else {
            return array();
        }
    }

    function empgriddata($name, $fromdate, $todate) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        //check for name parameter it's full name or it's character
        $fullname = str_replace('_', ' ', $name);
        $name = strtolower(urldecode($fullname));

        if (strlen($name) == 2 || strlen($name) == 1) {
            $flag = 2;
        } else {
            $flag = 1;
        }

        switch ($login_user_role) {
            case 1:
            case 6:
                $team_members = $this->team_members($login_user);
                $this->tables = array('employee` as `e', 'customer` as `c', 'timetable` as `t');
                $this->fields = array('e.username', 'e.first_name AS empfname', 'e.last_name AS emplname', 't.customer', 'c.first_name AS custfname', 'c.last_name AS custlname', 'SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`',
                    "SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))) AS totalMinutes",
                    "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");

                $this->conditions = array('AND', 'e.status = 1', 'e.status != " "', 'c.status = 1', 't.status = 1', 'e.username = t.employee', 'c.username = t.customer');
                if ($name != '-') {
                    if ($flag == 1)
                        $this->conditions[] = 'e.username = "' . $name . '"';
                    else 
                        $this->conditions[] = '(LCASE(e.last_name) LIKE "' . $name . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                }

                if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                    $this->conditions[] = 't.date >= "' . $fromdate . '" ';
                elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';
                elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                    $this->conditions[] = 't.date <= "' . $todate . '"';

                $this->group_by = array('t.employee', 't.customer');
                $this->order_by = array('e.last_name collate utf8_bin', 'e.first_name collate utf8_bin', 'c.last_name collate utf8_bin', 'c.first_name collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();

                return !empty($employee_data) && !empty($employee_data[0]['username']) ? $employee_data : array();
                break;

            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';

                $this->tables = array('employee` as `e', 'customer` as `c', 'timetable` as `t');
                $this->fields = array('e.username', 'e.first_name AS empfname', 'e.last_name AS emplname', 't.customer', 'c.first_name AS custfname', 'c.last_name AS custlname', 'SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`', "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
                
                $this->conditions = array('AND', 'e.status = 1', 'c.status = 1', 't.status = 1', 'e.username = t.employee', 'c.username = t.customer', array('IN', 'e.username', $team_employee_data));
                if ($name != '-') {
                    if ($flag == 1)
                        $this->conditions[] = 'e.username = "' . $name . '"';
                    else
                        $this->conditions[] = '(LCASE(e.last_name) LIKE "' . $name . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                }

                if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                    $this->conditions[] = 't.date >= "' . $fromdate . '" ';
                elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date <= "' . $todate . '" ';
                elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                $this->group_by = array('t.employee', 't.customer');
                $this->order_by = array('e.last_name collate utf8_bin', 'e.first_name collate utf8_bin', 'c.last_name collate utf8_bin', 'c.first_name collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();

                return !empty($employee_data) ? $employee_data : array();
                break;

            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->tables = array('employee` as `e', 'customer` as `c', 'timetable` as `t');
                $this->fields = array('e.username', 'e.first_name AS empfname', 'e.last_name AS emplname', 't.customer', 'c.first_name AS custfname', 'c.last_name AS custlname', 'SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`', "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");

                $this->conditions = array('AND', 'e.status = 1', 'c.status = 1', 't.status = 1', 'e.username = t.employee', 'c.username = t.customer', array('IN', 'e.username', $team_employee_data));
                if ($name != '-') {
                    if ($flag == 1)
                        $this->conditions[] = 'e.username = "' . $name . '"';
                    else
                        $this->conditions[] = '(LCASE(e.last_name) LIKE "' . $name . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                }

                if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                    $this->conditions[] = 't.date >= "' . $fromdate . '" ';
                elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date <= "' . $todate . '" ';
                elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                $this->group_by = array('t.employee', 't.customer');
                $this->order_by = array('e.last_name collate utf8_bin', 'e.first_name collate utf8_bin', 'c.last_name collate utf8_bin', 'c.first_name collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();

                return !empty($employee_data) ? $employee_data : array();
                break;

            case 4:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->tables = array('employee` as `e', 'customer` as `c', 'timetable` as `t');
                $this->fields = array('e.username', 'e.first_name AS empfname', 'e.last_name AS emplname', 't.customer', 'c.first_name AS custfname', 'c.last_name AS custlname', 'SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`', "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");

                $this->conditions = array('AND', 'e.status = 1', 'c.status = 1', 't.status = 1', 'e.username = t.employee', 'c.username = t.customer', array('IN', 'e.username', $team_employee_data));
                if ($name != '-') {
                    if ($flag == 1)
                        $this->conditions[] = 'e.username = "' . $name . '"';
                    else
                        $this->conditions[] = '(LCASE(e.last_name) LIKE "' . $name . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                }

                if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                    $this->conditions[] = 't.date >= "' . $fromdate . '" ';
                elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date <= "' . $todate . '" ';
                elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                    $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                $this->group_by = array('t.employee', 't.customer');
                $this->order_by = array('e.last_name collate utf8_bin', 'e.first_name collate utf8_bin', 'c.last_name collate utf8_bin', 'c.first_name collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();

                return !empty($employee_data) ? $employee_data : array();
                break;
        }
    }

    function empgriddata_including_leave($name, $fromdate, $todate, $allowed_leave_types = array()) {
        /*
         * @author: shamsudheen
         */

        $user            = new user();
        $login_user      = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $team_employee_data = '';
        //check for name parameter it's full name or it's character
        $fullname = str_replace('_', ' ', $name);
        $name     = strtolower(urldecode($fullname));

        $flag = ((strlen($name) == 2 || strlen($name) == 1) ? 2 : 1);

        switch ($login_user_role) {
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                break;

            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';                    
                break;

            case 4:
               // $team_members = $this->team_members($login_user);
                //$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $team_employee_data = '\'' . $login_user . '\'';
                break;
        }
        //find all customer-employees they have related leave_slots
        if($fromdate <= $boundary_date && $todate > $boundary_date){
            $this->tables = array('employee', 'customer', 'timetable','leave` as `l');
            $this->fields = array('employee.username', 'employee.first_name AS empfname', 'employee.last_name AS emplname', 'employee.salary_type', 'timetable.customer', 'customer.first_name AS custfname', 'customer.last_name AS custlname',
                '0 AS `Total Hours`', "0 AS totalMinutes", "0 AS hrsmins");

            $this->conditions = array('AND', 'employee.status = 1', 'customer.status = 1', 'timetable.status = 2', 'employee.username = timetable.employee', 'customer.username = timetable.customer',
                'timetable.employee like l.employee', 'timetable.date = l.date','l.time_from <= timetable.time_from','l.time_to >= timetable.time_to');

            if (!empty($allowed_leave_types))
                    $this->conditions[] = array('IN', 'l.type', $allowed_leave_types);
            
            switch ($login_user_role) {
                case 1:
                case 6:if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 2:
                case 7:
                    
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 3:
                case 5:
                    

                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 4:

                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                default:
                    return array();
                    break;
            }

            $this->group_by = array('timetable.employee', 'timetable.customer');
            $this->query_generate();
            $real_table_data = $this->sql_query;



            $this->tables = array('employee', 'customer', 'backup_timetable` as `timetable','backup_leave` as `l');
            $this->fields = array('employee.username', 'employee.first_name AS empfname', 'employee.last_name AS emplname', 'employee.salary_type', 'timetable.customer', 'customer.first_name AS custfname', 'customer.last_name AS custlname',
                '0 AS `Total Hours`', "0 AS totalMinutes", "0 AS hrsmins");

            $this->conditions = array('AND', 'employee.status = 1', 'customer.status = 1', 'timetable.status = 2', 'employee.username = timetable.employee', 'customer.username = timetable.customer',
                'timetable.employee like l.employee', 'timetable.date = l.date','l.time_from <= timetable.time_from','l.time_to >= timetable.time_to');

            if (!empty($allowed_leave_types))
                    $this->conditions[] = array('IN', 'l.type', $allowed_leave_types);
            
            switch ($login_user_role) {
                case 1:
                case 6:
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 2:
                case 7:

                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 3:
                case 5:

                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 4:
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                default:
                    return array();
                    break;
            }

            $this->group_by = array('timetable.employee', 'timetable.customer');
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query = 'SELECT * FROM (( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' )) As sample1 ' ;

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $this->tables = array('employee', 'customer', 'backup_timetable` as `t','backup_leave` as `l');
            $proceed = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $this->tables = array('employee', 'customer', 'timetable` as `t','leave` as `l');
            $proceed = TRUE;
        }

        if($proceed == TRUE){
            $this->fields = array('employee.username', 'employee.first_name AS empfname', 'employee.last_name AS emplname', 'employee.salary_type', 't.customer', 'customer.first_name AS custfname', 'customer.last_name AS custlname',
                '0 AS `Total Hours`', "0 AS totalMinutes", "0 AS hrsmins");

            $this->conditions = array('AND', 'employee.status = 1', 'customer.status = 1', 't.status = 2', 'employee.username = t.employee', 'customer.username = t.customer',
                't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to');

            if (!empty($allowed_leave_types))
                    $this->conditions[] = array('IN', 'l.type', $allowed_leave_types);
            
            switch ($login_user_role) {
                case 1:
                case 6:if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 't.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 't.date <= "' . $todate . '"';
                    }
                    break;

                case 2:
                case 7:
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 't.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 't.date <= "' . $todate . '"';
                    }
                    break;

                case 3:
                case 5:
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 't.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 't.date <= "' . $todate . '"';
                    }
                    break;

                case 4:
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 't.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 't.date <= "' . $todate . '"';
                    }
                    break;

                default:
                    return array();
                    break;
            }

            $this->group_by = array('t.employee', 't.customer');
            $this->query_generate();
        }
        $employee_data = $this->query_fetch();
        //find customer-employees they have related active_slots
        if (!empty($employee_data)) {

            $temp_cust_emp_condition = array('OR');
            foreach ($employee_data as $emp_data) {
                $temp_cust_emp_condition[] = array('AND', 'employee.username = "' . $emp_data['username'] . '"', 'customer.username = "' . $emp_data['customer'] . '"');
            }

            $this->flush();
            $this->tables = array('employee', 'customer', 'timetable');
            $this->fields = array('employee.username', 'employee.first_name AS empfname', 'employee.last_name AS emplname', 'employee.salary_type', 'timetable.customer', 'customer.first_name AS custfname', 'customer.last_name AS custlname', 'SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',
                "SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes",
                "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");

            $this->conditions = array('AND', 'employee.status = 1', 'customer.status = 1', 'timetable.status = 1', 'employee.username = timetable.employee', 'customer.username = timetable.customer');
            $this->conditions[] = $temp_cust_emp_condition;


            switch ($login_user_role) {
                case 1:
                case 6:
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 2:
                case 7:
                    
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 3:
                case 5:

                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;

                case 4:
                    $this->conditions[] = array('IN', 'employee.username', $team_employee_data);
                    if ($name != '-') {
                        if ($flag == 1)
                            $this->conditions[] = 'employee.username = "' . $name . '"';
                        else
                            $this->conditions[] = '(LCASE(employee.last_name) LIKE "' . $name . '%" OR LCASE(employee.last_name) LIKE "' . mb_strtolower($name) . '%" )';
                    }

                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                        $this->conditions[] = 'timetable.date >= "' . $fromdate . '" ';

                    else if ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                        $this->conditions[] = 'timetable.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

                    else if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->conditions[] = 'timetable.date <= "' . $todate . '"';
                    }
                    break;
            }

            $this->group_by = array('timetable.employee', 'timetable.customer');
            $this->order_by = array('employee.last_name collate utf8_bin', 'employee.first_name collate utf8_bin', 'customer.last_name collate utf8_bin', 'customer.first_name collate utf8_bin');
            $this->query_generate();
            $employee_data_active_hours = $this->query_fetch();

            //change active hours in related leave record dataset
            if (!empty($employee_data_active_hours)) {
                foreach ($employee_data_active_hours as $emp_active_data) {
                    foreach ($employee_data as $ekey => $emp_data) {
                        if ($emp_data['username'] == $emp_active_data['username'] && $emp_data['customer'] == $emp_active_data['customer']) {
                            $employee_data[$ekey]['Total Hours'] = $emp_active_data['Total Hours'];
                            $employee_data[$ekey]['totalMinutes'] = $emp_active_data['totalMinutes'];
                            $employee_data[$ekey]['hrsmins'] = $emp_active_data['hrsmins'];
                        }
                    }
                }
            }
            return $employee_data;
        }
        else
            return array();
    }

    function empgriddata_leave($name, $fromdate, $todate, $except_employees) {
       // echo "<pre>func_get_arg".print_r(func_get_args(), 1)."</pre>";
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        //check for name parameter it's full name or it's character
        $fullname = str_replace('_', ' ', $name);
        $name = strtolower(urldecode($fullname));
        $flag = strlen($name) == 2 || strlen($name) == 1 ? 2 : 1;

        switch ($login_user_role) {
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                break;
            case 3:
            case 5:
            case 4:
                $team_employee_data = '\'' . $login_user . '\'';
                break;
        }

        $this->flush();
        $this->tables = array('employee` as `e', 'customer` as `c', 'timetable` as `t');
        $this->fields = array('e.username', 'e.first_name AS empfname', 'e.last_name AS emplname', 't.customer', 'c.first_name AS custfname', 'c.last_name AS custlname', '0 AS `Total Hours`', "0 AS totalMinutes", "0 AS hrsmins");

        $this->conditions = array('AND', array('NOT IN', 'e.username', $except_employees), 'e.status = 1', 'e.status != " "', 'c.status = 1', 't.status = 2', 'e.username = t.employee', 'c.username = t.customer');
        if ($name != '-') {
            if ($flag == 1)
                $this->conditions[] = 'e.username = "' . $name . '"';
            else
                $this->conditions[] = '(LCASE(e.last_name) LIKE "' . $name . '%" OR LCASE(e.last_name) LIKE "' . mb_strtolower($name) . '%" )';
        }

        if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
            $this->conditions[] = 't.date >= "' . $fromdate . '" ';
        elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00')
            $this->conditions[] = 't.date <= "' . $todate . '" ';
        elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
            $this->conditions[] = 't.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';


        switch ($login_user_role) {
            case 1:
            case 6:
                break;
            case 2:
            case 7:
                $this->conditions[] = array('IN', 'e.username', $team_employee_data);
                break;
            case 3:
            case 5:
                $this->conditions[] = array('IN', 'e.username', $team_employee_data);
                break;
            case 4:
                $this->conditions[] = array('IN', 'e.username', $team_employee_data);
                break;
            default: 
                $this->flush();
                return array();
                break;
        }

        $this->group_by = array('t.employee', 't.customer');
        $this->order_by = array('e.last_name collate utf8_bin', 'e.first_name collate utf8_bin', 'c.last_name collate utf8_bin', 'c.first_name collate utf8_bin');
        $this->query_generate();
        $employee_data = $this->query_fetch();

        return !empty($employee_data) ? $employee_data : array();
    }

    function getemptothrs($empunm, $fromdate, $todate) {

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $team_members = $this->team_members($login_user);

        if($fromdate <= $boundary_date && $todate > $boundary_date){
            $this->tables = array('timetable');
            $this->fields = array("FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60) AS hours", "(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60) AS minutes", "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60)) AS hrsmins");
            $this->conditions = array('AND', 'status = 1', 'employee = "' . $empunm . '"');

            if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                $this->conditions[] ='date >= "' . $fromdate . '" ';
            elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions[] ='date <= "' . $todate . '" ';
            elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions[] = 'date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $this->tables = array('backup_timetable');
            $this->fields = array("FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60) AS hours", "(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60) AS minutes", "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60)) AS hrsmins");
            $this->conditions = array('AND', 'status = 1', 'employee = "' . $empunm . '"');

            if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                $this->conditions[] ='date >= "' . $fromdate . '" ';
            elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions[] ='date <= "' . $todate . '" ';
            elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions[] = 'date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $this->tables = array('backup_timetable');
            $proceed = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $this->tables = array('timetable');
            $proceed = TRUE;
        }
        if($proceed == TRUE){
            $this->fields = array("FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60) AS hours", "(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60) AS minutes", "CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60)) AS hrsmins");
            $this->conditions = array('AND', 'status = 1', 'employee = "' . $empunm . '"');

            if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                $this->conditions[] ='date >= "' . $fromdate . '" ';
            elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions[] ='date <= "' . $todate . '" ';
            elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions[] = 'date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';
            $this->query_generate();
        }

        $employee_data = $this->query_fetch();

        return !empty($employee_data) ? $employee_data : array();
    }

    //calculateemployee leaves (Hors are calculated on base of leave hours in shcedule time)
    function getempleave_exclude_some($empunm, $fromdate, $todate) {

        $this->tables = array('leave` as `l', 'timetable` as `t');
        $this->fields = array('t.employee', 't.customer', 't.time_from AS schfrom', 't.time_to AS schto', 'l.time_from AS leafrom', 'l.time_to AS leato', 'l.type', 'l.date As leavedate', 't.date AS schduledate');
        $this->conditions = array('AND', '(t.status = 1 OR t.status = 2)', 'l.employee = "' . $empunm . '"', 't.employee = "' . $empunm . '"', 't.date = l.date', array('OR', 'l.type = 2', 'l.type = 3', 'l.type = 4', 'l.type = 7'));

        if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
            $this->conditions = array_merge($this->conditions, array('l.date >= "' . $fromdate . '" ', 't.date >= "' . $fromdate . '" '));
        elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00')
            $this->conditions = array_merge($this->conditions, array('l.date <= "' . $todate . '" ', 't.date <= "' . $todate . '" '));
        elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
            $this->conditions[] = 'l.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

        $this->group_by = array('l.time_from', 'l.date');
        $this->query_generate();
        $employee_data = $this->query_fetch();

        $totemp = count($employee_data);
        $leavearr = array();
        if ($totemp > 0) {
            for ($w = 0; $w < $totemp; $w++) {
                $empuname = $employee_data[$w]['employee'];
                $custuname = $employee_data[$w]['customer'];
                $schdulefrom = $employee_data[$w]['schfrom'];
                $schduleto = $employee_data[$w]['schto'];
                $leavefrom = $employee_data[$w]['leafrom'];
                $leaveto = $employee_data[$w]['leato'];
                $leavetype = $employee_data[$w]['type'];
                $leavedate = $employee_data[$w]['leavedate'];

                $ltype1 = number_format($schdulefrom, 2, '.', '');
                $divi1 = substr(strstr($ltype1, '.'), 1);
                $base1 = substr($ltype1, 0, -3);
                $schdulefrom = ($base1 * 60) + $divi1;

                $ltype2 = number_format($schduleto, 2, '.', '');
                $divi2 = substr(strstr($ltype2, '.'), 1);
                $base2 = substr($ltype2, 0, -3);
                $schduleto = ($base2 * 60) + $divi2;

                $ltype3 = number_format($leavefrom, 2, '.', '');
                $divi3 = substr(strstr($ltype3, '.'), 1);
                $base3 = substr($ltype3, 0, -3);
                $leavefrom = ($base3 * 60) + $divi3;

                $ltype4 = number_format($leaveto, 2, '.', '');
                $divi4 = substr(strstr($ltype4, '.'), 1);
                $base4 = substr($ltype4, 0, -3);
                $leaveto = ($base4 * 60) + $divi4;

                if ($leavefrom == $schdulefrom && $leaveto == $schduleto) {
                    $total_leave = $leaveto - $leavefrom;
                } elseif ($schdulefrom >= $leavefrom && $schdulefrom >= $leaveto) {
                    $total_leave = 0;
                } elseif ($schduleto <= $leavefrom && $schduleto <= $leaveto) {
                    $total_leave = 0;
                } elseif ($schdulefrom <= $leavefrom && $schduleto >= $leaveto) {
                    $total_leave = $leaveto - $leavefrom;
                } elseif ($schdulefrom >= $leavefrom && $schduleto <= $leaveto) {
                    $total_leave = $schduleto - $schdulefrom;
                } elseif ($schdulefrom <= $leavefrom && $schduleto <= $leaveto && $schduleto >= $leavefrom) {
                    $total_leave = $schduleto - $leavefrom;
                } elseif ($schdulefrom >= $leavefrom && $schdulefrom <= $leaveto && $schduleto >= $leaveto) {
                    $total_leave = $leaveto - $schdulefrom;
                }

                if ($leavearr[$empuname][$custuname][$leavetype] != '') {
                    $leavearr[$empuname][$custuname][$leavetype] += $total_leave;
                } else {
                    $leavearr[$empuname][$custuname][$leavetype] = $total_leave;
                }
            }
        }

        return !empty($leavearr) ? $leavearr : array();
        exit;
    }

    //calculateemployee leaves (Hors are calculated on base of leave hours in shcedule time)
    function getempleave($empunm, $fromdate, $todate) {
        $proceed         = false;
        $obj_gen         = new general();
        $boundary_date = $obj_gen->get_boundary_date();

        if($fromdate <= $boundary_date && $todate > $boundary_date){
            $this->tables = array('leave` as `l', 'timetable` as `t');
            $this->fields = array('t.employee', 't.customer', 't.time_from AS schfrom', 't.time_to AS schto', 'l.time_from AS leafrom', 'l.time_to AS leato', 'l.type', 'l.date As leavedate', 't.date AS schduledate');
            $this->conditions = array('AND', 'l.status= 1', 't.status = 2', 'l.employee = "' . $empunm . '"', 't.employee = "' . $empunm . '"', 't.date = l.date');

            if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                $this->conditions = array_merge($this->conditions, array('l.date >= "' . $fromdate . '" ', 't.date >= "' . $fromdate . '" '));
            elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions = array_merge($this->conditions, array('l.date <= "' . $todate . '" ', 't.date <= "' . $todate . '" '));
            elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                $this->conditions[] = 'l.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $this->tables = array('backup_leave` as `l', 'backup_timetable` as `t');
            $this->fields = array('t.employee', 't.customer', 't.time_from AS schfrom', 't.time_to AS schto', 'l.time_from AS leafrom', 'l.time_to AS leato', 'l.type', 'l.date As leavedate', 't.date AS schduledate');
            $this->conditions = array('AND', 'l.status= 1', 't.status = 2', 'l.employee = "' . $empunm . '"', 't.employee = "' . $empunm . '"', 't.date = l.date');
            
            if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                $this->conditions = array_merge($this->conditions, array('l.date >= "' . $fromdate . '" ', 't.date >= "' . $fromdate . '" '));
            elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions = array_merge($this->conditions, array('l.date <= "' . $todate . '" ', 't.date <= "' . $todate . '" '));
            elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                $this->conditions[] = 'l.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query = 'SELECT * FROM (( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ) As sample1';
            
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
             $this->tables = array('backup_leave` as `l', 'backup_timetable` as `t');
             $proceed = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
             $this->tables = array('leave` as `l', 'timetable` as `t'); 
             $proceed = TRUE;
        }
        if($proceed == TRUE){
            $this->fields = array('t.employee', 't.customer', 't.time_from AS schfrom', 't.time_to AS schto', 'l.time_from AS leafrom', 'l.time_to AS leato', 'l.type', 'l.date As leavedate', 't.date AS schduledate');
            $this->conditions = array('AND', 'l.status= 1', 't.status = 2', 'l.employee = "' . $empunm . '"', 't.employee = "' . $empunm . '"', 't.date = l.date');
            
            if ($fromdate != '0000-00-00' && $todate == '0000-00-00')
                $this->conditions = array_merge($this->conditions, array('l.date >= "' . $fromdate . '" ', 't.date >= "' . $fromdate . '" '));
            elseif ($fromdate == '0000-00-00' && $todate != '0000-00-00') 
                $this->conditions = array_merge($this->conditions, array('l.date <= "' . $todate . '" ', 't.date <= "' . $todate . '" '));
            elseif ($fromdate != '0000-00-00' && $todate != '0000-00-00')
                $this->conditions[] = 'l.date BETWEEN "' . $fromdate . '" AND "' . $todate . '"';

            $this->query_generate();
        }
        $employee_data = $this->query_fetch();
        $totemp = count($employee_data);
        $leavearr = array();
        if ($totemp > 0) {
            for ($w = 0; $w < $totemp; $w++) {
                $empuname = $employee_data[$w]['employee'];
                $custuname = $employee_data[$w]['customer'];
                $schdulefrom = $employee_data[$w]['schfrom'];
                $schduleto = $employee_data[$w]['schto'];
                $leavefrom = $employee_data[$w]['leafrom'];
                $leaveto = $employee_data[$w]['leato'];
                $leavetype = $employee_data[$w]['type'];
                $leavedate = $employee_data[$w]['leavedate'];

                $ltype1 = number_format($schdulefrom, 2, '.', '');
                $divi1 = substr(strstr($ltype1, '.'), 1);
                $base1 = substr($ltype1, 0, -3);
                $schdulefrom = ($base1 * 60) + $divi1;

                $ltype2 = number_format($schduleto, 2, '.', '');
                $divi2 = substr(strstr($ltype2, '.'), 1);
                $base2 = substr($ltype2, 0, -3);
                $schduleto = ($base2 * 60) + $divi2;

                $ltype3 = number_format($leavefrom, 2, '.', '');
                $divi3 = substr(strstr($ltype3, '.'), 1);
                $base3 = substr($ltype3, 0, -3);
                $leavefrom = ($base3 * 60) + $divi3;

                $ltype4 = number_format($leaveto, 2, '.', '');
                $divi4 = substr(strstr($ltype4, '.'), 1);
                $base4 = substr($ltype4, 0, -3);
                $leaveto = ($base4 * 60) + $divi4;


                if ($leavefrom == $schdulefrom && $leaveto == $schduleto) {
                    $total_leave = $leaveto - $leavefrom;
                } elseif ($schdulefrom >= $leavefrom && $schdulefrom >= $leaveto) {
                    //$total_leave = $leaveto - $leavefrom;
                    $total_leave = 0;
                } elseif ($schduleto <= $leavefrom && $schduleto <= $leaveto) {
                    //$total_leave = $leaveto - $leavefrom;
                    $total_leave = 0;
                } elseif ($schdulefrom <= $leavefrom && $schduleto >= $leaveto) {

                    $total_leave = $leaveto - $leavefrom;
                } elseif ($schdulefrom >= $leavefrom && $schduleto <= $leaveto) {
                    //$total_leave = $leaveto - $leavefrom;
                    $total_leave = $schduleto - $schdulefrom;
                } elseif ($schdulefrom <= $leavefrom && $schduleto <= $leaveto && $schduleto >= $leavefrom) {
                    $total_leave = $schduleto - $leavefrom;
                } elseif ($schdulefrom >= $leavefrom && $schdulefrom <= $leaveto && $schduleto >= $leaveto) {
                    $total_leave = $leaveto - $schdulefrom;
                }

                if ($leavearr[$empuname][$custuname][$leavetype] != '') {
                    $leavearr[$empuname][$custuname][$leavetype] += $total_leave;
                } else {
                    $leavearr[$empuname][$custuname][$leavetype] = $total_leave;
                }
            }
        }

        return !empty($leavearr) ? $leavearr : array();
    }

    // This function is for show data of employee with auto suggest
    function getemployee($name) {
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $name = mb_strtolower(urldecode(str_replace('_', ' ', $name)));

        if ($name != NULL) {
            switch ($login_user_role) {
                case 2:
                case 7:
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    break;
                case 3:
                    $team_employee_data = '\'' . $_SESSION['user_id'] . '\'';
                    break;
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    break;
            }

            $this->tables = array('employee');
            $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
            $this->conditions = array('AND', 'status = 1', array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?', 'CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
            $this->condition_values = array(strtolower($name) . "%", strtolower($name) . "%", strtolower($name) . "%");

            switch ($login_user_role) {
                case 1:
                case 6:
                    break;
                case 2:
                case 7:
                case 4:
                case 3:
                case 5:
                    $this->conditions[] = array('IN', 'username', $team_employee_data);
                    break;
                default:
                    $this->flush();
                    return array();
                    break;
            }
            $this->order_by = array('LOWER(last_name) collate utf8_bin');
            $this->query_generate();
            $employee_data = $this->query_fetch();
        }

        return !empty($employee_data) ? $employee_data : array();
    }

    /*     * ***************************************** */
    /* End Viteb Function 					 */
    /*     * ***************************************** */

    // function used to list the contracts of a particular employee using employee id
    function contract_employee($username) {
        $this->tables = array('employee_contract` as `ec', 'employee` as `e');
        $this->fields = array('ec.id', 'ec.employee', 'ec.date_from', 'ec.date_to', 'ec.hour', 'e.username', 'e.first_name', 'e.last_name' );
        $this->conditions = array('AND','ec.employee = e.username','e.username=?');
        $this->condition_values = array($username);
        $this->order_by = array('ec.date_from');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    // Function to check wheather to edit or add
    function contract_add_edit_employee_check($id) {
        return !empty($id[1]) ? 'edit' : 'add';
    }

    //Function to edit the allotted contract 
    function contract_employee_edit($id) {
        $this->tables = array('employee_contract');
        $this->fields = array('date_from', 'date_to', 'hour');
        $this->field_values = array($this->date_from, $this->date_to, $this->hours);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
        return $data ? TRUE : FALSE;
    }

    //Function to take the values from the table according to the particular table
    function contract_employee_edit_get($id) {

        $this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function contract_employee_add() {

        $this->tables = array('employee_contract');
        $this->fields = array('employee', 'date_from', 'date_to', 'hour');
        $this->field_values = array($this->user, $this->date_from, $this->date_to, $this->hours);
        $data = $this->query_insert();
        return $data ? TRUE : FALSE;
    }

    function contract_employee_check($val) {

        $this->tables = array('employee_contract');
        $this->fields = array('employee');
        $this->conditions = array('AND', array('OR', '? BETWEEN date_from AND date_to', '?  BETWEEN date_from AND date_to', 'date_from BETWEEN ? AND ?', 'date_to  BETWEEN ? AND ?'), 'employee = ?',);
        $this->condition_values = array($this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->user);
        if ($val != "") {
            $this->conditions[] = 'id <>?';
            $this->condition_values[] = $val;
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }

    /*function generate_employee_code() {

        $this->tables = array('employee');
        $this->fields = array('MAX(CAST(SUBSTR(code,LOCATE(\'-\',code)+1) AS UNSIGNED)) as code');
        $this->query_generate();
        $data_max = $this->query_fetch();
        $max_code = $data_max[0]['code'];
        $this->tables = array('employee');
        $this->fields = array('LENGTH(SUBSTR(code,LOCATE(\'-\',code)+1)) as code_size', 'SUBSTR(code,1, LOCATE(\'-\',code)-1) as code_start', 'count(*) as code_exists', 'LOCATE(\'-\',code) as format_exists');
        $this->conditions = array('SUBSTR(code,LOCATE(\'-\',code)+1) like ?');
        $this->condition_values = array("%" . $max_code . "%");
        $this->query_generate();
        $data = $this->query_fetch();
        $code = '';
        if (!empty($data)) {
            //$max_count_code = $data[0]['code'];
            $max_count_code = $max_code;
            $max_count = $max_count_code + 1;
            $count = sprintf('%0' . $data[0]['code_size'] . 'd', $max_count);
            if ($data[0]['format_exists']) {
                $temp = $data[0]['code_start'];
                $code = $temp . "-" . $count;
            } else 
                $code = sprintf('%0' . $data[0]['code_size'] . 'd', $max_count);
        } else
            $code = '001-000001';

        return $code;
    }*/

    //  function to increment employee code.

    function generate_employee_code() {
        $this->sql_query = "SELECT `username`, `code` ,`date_of_entry` FROM `employee` WHERE `date_of_entry` = (SELECT MAX(`date_of_entry`) from `employee`)";
        $data = $this->query_fetch()[0];
        $code = $data['code'];
        $new_code;
        // var_dump($code);
        if(!empty($code)){
            if (preg_match("/^\d+$/", $code)) { // checking for only number in a string
               $new_code = $code+1;
            } 
            else {
                $number = 0;
                for ($i = strlen($code); $i >= 0; $i--){
                    if(is_numeric($code[$i]) === TRUE){
                        $number++;
                        $new_code.= $code[$i];
                    }
                    else{
                        if($number > 0)
                            break;
                    }
                }
                
                
                $new_code =substr($code, 0,($i+1)).''. (strrev($new_code)+1);  
            }
        }
        else{
            $new_code = 1;
        }
        return $new_code;
        // var_dump($data,$number);
        //exit();
    }

    function date_difference($fdate, $ldate) {
        return (strtotime($ldate) - strtotime($fdate));
    }

    function makeArray($datas = array()) {
        $data_array = array();
        foreach ($datas as $data) {
            $data_array[$data['id']] = $data['name'];
        }
        return $data_array;
    }

    function employee_list_begin($key = NULL, $sort = NULL) {
        if ($sort != NULL || $sort != "") {
            if ($sort == "n") {
                if ($_SESSION['company_sort_by'] == 1)
                    $sorting = 'LOWER(' . $this->db_name . '.employee.first_name) collate utf8_bin ASC';
                elseif ($_SESSION['company_sort_by'] == 2)
                    $sorting = 'LOWER(' . $this->db_name . '.employee.last_name) collate utf8_bin ASC';
               // $sorting = 'LOWER(' . $this->db_name . '.employee.last_name) collate utf8_bin ASC';
            } elseif ($sort == "el") {
                $sorting = $this->db_master . '.login.error DESC';
            } elseif ($sort == "r") {
                $sorting = $this->db_master . '.login.role';
            } elseif ($sort == "lg") {
                $sorting = $this->db_master . '.login.login DESC';
            }
        } else {
            if ($_SESSION['company_sort_by'] == 1)
                $sorting = 'LOWER(' . $this->db_name . '.employee.first_name) collate utf8_bin ASC';
            elseif ($_SESSION['company_sort_by'] == 2)
                $sorting = 'LOWER(' . $this->db_name . '.employee.last_name) collate utf8_bin ASC';
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "ä", "å", "ö",
        );
        $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö",
        );
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        switch ($login_user_role) {

            case 1:
            case 6:
                $team_members = $this->team_members($login_user);
                $this->tables = array($this->db_name . '.employee', $this->db_master . '.login');
                $this->fields = array($this->db_name . '.employee.username', $this->db_name . '.employee.code', $this->db_name . '.employee.first_name', $this->db_name . '.employee.last_name', $this->db_name . '.employee.social_security', $this->db_name . '.employee.city', $this->db_name . '.employee.phone', $this->db_name . '.employee.mobile', $this->db_name . '.employee.email', $this->db_name . '.employee.status', $this->db_name . '.employee.date_inactive', $this->db_master . '.login.role', $this->db_master . '.login.error AS error_login_common', $this->db_master . '.login.login',
                    '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = '.$this->db_name . '.employee.username AND company_id = '.$_SESSION['company_id'].') AS error_login');

                $this->conditions = array('AND', $this->db_name . '.employee.status = 0', $this->db_name . '.employee.username = ' . $this->db_master . '.login.username');
                if ($key != NULL) {
                    if ($key == "A") {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?'), $this->db_name . '.employee.first_name NOT LIKE "ä%"', $this->db_name . '.employee.first_name NOT LIKE "å%"', $this->db_name . '.employee.first_name NOT LIKE "ö%"', $this->db_name . '.employee.first_name NOT LIKE "Ä%"', $this->db_name . '.employee.first_name NOT LIKE "Å%"', $this->db_name . '.employee.first_name NOT LIKE "Ö%"');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?'), $this->db_name . '.employee.last_name NOT LIKE "ä%"', $this->db_name . '.employee.last_name NOT LIKE "å%"', $this->db_name . '.employee.last_name NOT LIKE "ö%"', $this->db_name . '.employee.last_name NOT LIKE "Ä%"', $this->db_name . '.employee.last_name NOT LIKE "Å%"', $this->db_name . '.employee.last_name NOT LIKE "Ö%"');
                    } else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?');
                    }
                    $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                }
                $this->order_by = array($sorting);
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array($this->db_name . '.employee', $this->db_master . '.login');
                $this->fields = array($this->db_name . '.employee.username', $this->db_name . '.employee.code', $this->db_name . '.employee.first_name', $this->db_name . '.employee.last_name', $this->db_name . '.employee.social_security', $this->db_name . '.employee.city', $this->db_name . '.employee.phone', $this->db_name . '.employee.mobile', $this->db_name . '.employee.email', $this->db_name . '.employee.status', $this->db_name . '.employee.date_inactive', $this->db_master . '.login.role', $this->db_master . '.login.error AS error_login_common', $this->db_master . '.login.login',
                    '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = '.$this->db_name . '.employee.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                $this->conditions = array('AND', array('IN', $this->db_name . '.employee.username', $team_employee_data), $this->db_name . '.employee.status = 0', $this->db_name . '.employee.username = ' . $this->db_master . '.login.username');
                if ($key != NULL) {
                    if ($key == "A") {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?'), $this->db_name . '.employee.first_name NOT LIKE "ä%"', $this->db_name . '.employee.first_name NOT LIKE "å%"', $this->db_name . '.employee.first_name NOT LIKE "ö%"', $this->db_name . '.employee.first_name NOT LIKE "Ä%"', $this->db_name . '.employee.first_name NOT LIKE "Å%"', $this->db_name . '.employee.first_name NOT LIKE "Ö%"');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?'), $this->db_name . '.employee.last_name NOT LIKE "ä%"', $this->db_name . '.employee.last_name NOT LIKE "å%"', $this->db_name . '.employee.last_name NOT LIKE "ö%"', $this->db_name . '.employee.last_name NOT LIKE "Ä%"', $this->db_name . '.employee.last_name NOT LIKE "Å%"', $this->db_name . '.employee.last_name NOT LIKE "Ö%"');
                    } else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?');
                    }
                   $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                }
                $this->order_by = array($sorting);
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->tables = array($this->db_name . '.employee', $this->db_master . '.login');
                $this->fields = array($this->db_name . '.employee.username', $this->db_name . '.employee.code', $this->db_name . '.employee.first_name', $this->db_name . '.employee.last_name', $this->db_name . '.employee.social_security', $this->db_name . '.employee.city', $this->db_name . '.employee.phone', $this->db_name . '.employee.mobile', $this->db_name . '.employee.email', $this->db_name . '.employee.status', $this->db_name . '.employee.date_inactive', $this->db_master . '.login.role', $this->db_master . '.login.error AS error_login_common', $this->db_master . '.login.login',
                    '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = '.$this->db_name . '.employee.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                $this->conditions = array('AND', array('IN', $this->db_name . '.employee.username', $team_employee_data), $this->db_name . '.employee.status = 0', $this->db_name . '.employee.username = ' . $this->db_master . '.login.username');
                if ($key != NULL) {
                    if ($key == "A") {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?'), $this->db_name . '.employee.first_name NOT LIKE "ä%"', $this->db_name . '.employee.first_name NOT LIKE "å%"', $this->db_name . '.employee.first_name NOT LIKE "ö%"', $this->db_name . '.employee.first_name NOT LIKE "Ä%"', $this->db_name . '.employee.first_name NOT LIKE "Å%"', $this->db_name . '.employee.first_name NOT LIKE "Ö%"');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?'), $this->db_name . '.employee.last_name NOT LIKE "ä%"', $this->db_name . '.employee.last_name NOT LIKE "å%"', $this->db_name . '.employee.last_name NOT LIKE "ö%"', $this->db_name . '.employee.last_name NOT LIKE "Ä%"', $this->db_name . '.employee.last_name NOT LIKE "Å%"', $this->db_name . '.employee.last_name NOT LIKE "Ö%"');
                    } else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?');
                    }
                   $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                }
                $this->order_by = array($sorting);
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 4:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array($this->db_name . '.employee', $this->db_master . '.login');
                $this->fields = array($this->db_name . '.employee.username', $this->db_name . '.employee.code', $this->db_name . '.employee.first_name', $this->db_name . '.employee.last_name', $this->db_name . '.employee.social_security', $this->db_name . '.employee.city', $this->db_name . '.employee.phone', $this->db_name . '.employee.mobile', $this->db_name . '.employee.email', $this->db_name . '.employee.status', $this->db_name . '.employee.date_inactive', $this->db_master . '.login.role', $this->db_master . '.login.error AS error_login_common', $this->db_master . '.login.login',
                    '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = '.$this->db_name . '.employee.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                $this->conditions = array('AND', array('IN', $this->db_name . '.employee.username', $team_employee_data), $this->db_name . '.employee.status = 0', $this->db_name . '.employee.username = ' . $this->db_master . '.login.username');
                if ($key != NULL) {
                    if ($key == "A") {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?'), $this->db_name . '.employee.first_name NOT LIKE "ä%"', $this->db_name . '.employee.first_name NOT LIKE "å%"', $this->db_name . '.employee.first_name NOT LIKE "ö%"', $this->db_name . '.employee.first_name NOT LIKE "Ä%"', $this->db_name . '.employee.first_name NOT LIKE "Å%"', $this->db_name . '.employee.first_name NOT LIKE "Ö%"');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('AND', array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?'), $this->db_name . '.employee.last_name NOT LIKE "ä%"', $this->db_name . '.employee.last_name NOT LIKE "å%"', $this->db_name . '.employee.last_name NOT LIKE "ö%"', $this->db_name . '.employee.last_name NOT LIKE "Ä%"', $this->db_name . '.employee.last_name NOT LIKE "Å%"', $this->db_name . '.employee.last_name NOT LIKE "Ö%"');
                    } else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.first_name LIKE ?', $this->db_name . '.employee.first_name LIKE ?');
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $this->conditions[] = array('OR', $this->db_name . '.employee.last_name LIKE ?', $this->db_name . '.employee.last_name LIKE ?');
                    }
                   $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                }
                $this->order_by = array($sorting);
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
        }

        return !empty($employee_data) ? $employee_data : array();
    }

    function employee_list($key = NULL, $sort = NULL, $status = '', $advance_search = FALSE) {
        /*
         * $advance_search only taken if $key is not NULL, it means filter based on name, code, username, ssn
         */
        if ($sort != NULL || $sort != "") {
            if ($sort == "n") {
                $sorting = ($_SESSION['company_sort_by'] == 1 ? 'LOWER(e.first_name) collate utf8_bin' : 'LOWER(e.last_name) collate utf8_bin');
            } elseif ($sort == "el") {
                $sorting = 'l.error DESC';
            } elseif ($sort == "r") {
                $sorting = 'l.role';
            } elseif ($sort == "lg") {
                $sorting = 'l.login DESC';
            }
        } else {
            $sorting = ($_SESSION['company_sort_by'] == 1 ? 'LOWER(e.first_name) collate utf8_bin' : 'LOWER(e.last_name) collate utf8_bin');
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "ä", "å", "ö",
        );
        $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö",
        );
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        
        $login_user_role = $user->user_role($login_user);
    
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    if($status == '')    
                        $this->conditions = array('AND', 'e.status = 1', 'e.username = l.username');
                    else
                        $this->conditions = array('AND', 'e.username = l.username');
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    //echo "<pre>".print_r($this->query_error_details, 1)."</pre>";exit();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    if($status == '')    
                        $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.status = 1', 'e.username = l.username');
                    else
                        $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.username = l.username');
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    if($status == '')    
                        $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.status = 1', 'e.username = l.username');
                    else
                        $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.username = l.username');
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    if($status == '')    
                        $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.status = 1', 'e.username = l.username');
                    else
                        $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.username = l.username');
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        } 
        else {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    
                    $this->conditions = array('AND', 'e.username = l.username');
                    if($advance_search){
                        $this->conditions = array_merge($this->conditions, array(array('OR', 'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'e.social_security LIKE ?', 
                            'e.username LIKE ?', 
                            'e.code LIKE ?')));
                    }
                    else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', 'e.first_name LIKE ?', 'e.first_name LIKE ?');
                        else
                            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                    }
                    
                    if ($key == "A"){
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions = array_merge($this->conditions, array('e.first_name NOT LIKE "ä%"', 'e.first_name NOT LIKE "å%"', 'e.first_name NOT LIKE "ö%"', 'e.first_name NOT LIKE "Ä%"', 'e.first_name NOT LIKE "Å%"', 'e.first_name NOT LIKE "Ö%"'));
                        else
                            $this->conditions = array_merge($this->conditions, array('e.last_name NOT LIKE "ä%"', 'e.last_name NOT LIKE "å%"', 'e.last_name NOT LIKE "ö%"', 'e.last_name NOT LIKE "Ä%"', 'e.last_name NOT LIKE "Å%"', 'e.last_name NOT LIKE "Ö%"'));
                    }
                    if($status == '')  
                        $this->conditions[] = 'e.status = 1';
                    
                    if($advance_search)
                        $this->condition_values = array(
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". $key . "%"
                        );
                    else
                        $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array($sorting);
                    $this->query_generate();

                    $employee_data = $this->query_fetch();
                   // echo "<pre>".print_r($this->query_error_details, 1)."</pre>";
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    
                    $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.username = l.username');
                    if($advance_search){
                        $this->conditions = array_merge($this->conditions, array(array('OR', 'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'e.social_security LIKE ?', 
                            'e.username LIKE ?', 
                            'e.code LIKE ?')));
                    }
                    else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', 'e.first_name LIKE ?', 'e.first_name LIKE ?');
                        else
                            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                    }
                    if ($key == "A"){
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions = array_merge($this->conditions, array('e.first_name NOT LIKE "ä%"', 'e.first_name NOT LIKE "å%"', 'e.first_name NOT LIKE "ö%"', 'e.first_name NOT LIKE "Ä%"', 'e.first_name NOT LIKE "Å%"', 'e.first_name NOT LIKE "Ö%"'));
                        else
                            $this->conditions = array_merge($this->conditions, array('e.last_name NOT LIKE "ä%"', 'e.last_name NOT LIKE "å%"', 'e.last_name NOT LIKE "ö%"', 'e.last_name NOT LIKE "Ä%"', 'e.last_name NOT LIKE "Å%"', 'e.last_name NOT LIKE "Ö%"'));
                    }
                    if($status == '')  
                        $this->conditions[] = 'e.status = 1';
                    //$this->conditions = array('AND', array('IN', $this->db_name.'.employee.username', $team_employee_data), $this->db_name.'.employee.status = 1', array('OR', $this->db_name.'.employee.last_name LIKE ?', $this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.username = '.$this->db_master.'.login.username');
                    if($advance_search)
                        $this->condition_values = array(
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". $key . "%"
                        );
                    else
                        $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    
                    $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.username = l.username');
                    if($advance_search){
                        $this->conditions = array_merge($this->conditions, array(array('OR', 'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'e.social_security LIKE ?', 
                            'e.username LIKE ?', 
                            'e.code LIKE ?')));
                    }
                    else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', 'e.first_name LIKE ?', 'e.first_name LIKE ?');
                        else
                            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                    }
                    if ($key == "A"){
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions = array_merge($this->conditions, array('e.first_name NOT LIKE "ä%"', 'e.first_name NOT LIKE "å%"', 'e.first_name NOT LIKE "ö%"', 'e.first_name NOT LIKE "Ä%"', 'e.first_name NOT LIKE "Å%"', 'e.first_name NOT LIKE "Ö%"'));
                        else
                            $this->conditions = array_merge($this->conditions, array('e.last_name NOT LIKE "ä%"', 'e.last_name NOT LIKE "å%"', 'e.last_name NOT LIKE "ö%"', 'e.last_name NOT LIKE "Ä%"', 'e.last_name NOT LIKE "Å%"', 'e.last_name NOT LIKE "Ö%"'));
                    }
                    if($status == '')  
                        $this->conditions[] = 'e.status = 1';
                   // $this->conditions = array('AND', array('IN', $this->db_name.'.employee.username', $team_employee_data), $this->db_name.'.employee.status = 1', array('OR', $this->db_name.'.employee.last_name LIKE ?', $this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.username = '.$this->db_master.'.login.username');
                    if($advance_search)
                        $this->condition_values = array(
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". $key . "%"
                        );
                    else
                        $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array($this->db_name . '.employee` as `e', $this->db_master . '.login` as `l');
                    $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.century', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.email', 'e.status', 'e.date_inactive', 
                        'l.role', 'l.error AS error_login_common', 'l.login',
                        '(SELECT error FROM '.$this->db_master . '.secondary_login WHERE username = e.username AND company_id = '.$_SESSION['company_id'].') AS error_login');
                    $this->conditions = array('AND', array('IN', 'e.username', $team_employee_data), 'e.username = l.username');
                    if($advance_search){
                        $this->conditions = array_merge($this->conditions, array(array('OR', 'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'CONCAT(e.first_name, " ", e.last_name) LIKE ?', 
                            'CONCAT(e.last_name, " ", e.first_name) LIKE ?', 
                            'e.social_security LIKE ?', 
                            'e.username LIKE ?', 
                            'e.code LIKE ?')));
                    }
                    else {
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions[] = array('OR', 'e.first_name LIKE ?', 'e.first_name LIKE ?');
                        else
                            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                    }
                    if ($key == "A"){
                        if ($_SESSION['company_sort_by'] == 1)
                            $this->conditions = array_merge($this->conditions, array('e.first_name NOT LIKE "ä%"', 'e.first_name NOT LIKE "å%"', 'e.first_name NOT LIKE "ö%"', 'e.first_name NOT LIKE "Ä%"', 'e.first_name NOT LIKE "Å%"', 'e.first_name NOT LIKE "Ö%"'));
                        else
                            $this->conditions = array_merge($this->conditions, array('e.last_name NOT LIKE "ä%"', 'e.last_name NOT LIKE "å%"', 'e.last_name NOT LIKE "ö%"', 'e.last_name NOT LIKE "Ä%"', 'e.last_name NOT LIKE "Å%"', 'e.last_name NOT LIKE "Ö%"'));
                    }
                    if($status == '')  
                        $this->conditions[] = 'e.status = 1';
                   // $this->conditions = array('AND', array('IN', $this->db_name.'.employee.username', $team_employee_data), $this->db_name.'.employee.status = 1', array('OR', $this->db_name.'.employee.last_name LIKE ?', $this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.username = '.$this->db_master.'.login.username');
                    if($advance_search)
                        $this->condition_values = array(
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". str_replace($convert_from, $convert_to, $key) . "%",
                            "%". $key . "%", 
                            "%". $key . "%", 
                            "%". $key . "%"
                        );
                    else
                        $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array($sorting);
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        }

        return !empty($employee_data) ? $employee_data : array();
    }

    function employee_list_privilege($key) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        switch ($login_user_role) {

            case 1:
            case 6:
                $team_members = $this->team_members($login_user);
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                $this->conditions = array('AND', 'status = 1');
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
                $this->limit = $key . ",10";
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
                $this->limit = $key . ",10";
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
                $this->limit = $key . ",10";
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 4:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
                $this->limit = $key . ",10";
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
        }


        if (!empty($employee_data)) {

            return $employee_data;
        }
        else
            return array();
    }

    function employee_list_exact($login_user = '', $key = NULL, $status = '') {

        $user = new user();
        $employee_data = array();
        $team_employee_data = '';
        $login_user_role = '';
        if ($login_user == '') {
            $login_user = $_SESSION['user_id'];
            $login_user_role = $user->user_role($login_user);
        } else {

            $login_user_role = $user->user_role($login_user);
            //shifting the users
            $session_role = $user->user_role($_SESSION['user_id']);
            if (($login_user_role == 1 || $login_user_role == 6) && ($session_role != 1 && $session_role != 6)) {
                $login_user = $_SESSION['user_id'];
                $login_user_role = $session_role;
            } else if ($login_user_role == 7 && ($session_role == 2 || $session_role == 3 || $session_role == 4 || $session_role == 5)) {
                $login_user = $_SESSION['user_id'];
                $login_user_role = $session_role;
            } else if ($login_user_role == 2 && ($session_role == 3 || $session_role == 4 || $session_role == 5)) {
                $login_user = $_SESSION['user_id'];
                $login_user_role = $session_role;
            }
        }


        switch ($login_user_role) {

            case 1:
            case 6:
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'email','date_inactive', 'picture');
                if($status == '')    
                    $this->conditions = array('AND', 'status = 1');

                break;
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                //print_r($team_members);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'email','date_inactive', 'picture');
                if($status == '')    
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                else
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
                
                break;
            case 3:
            case 5:

                if ($_SESSION['user_role'] == '3' || $_SESSION['user_role'] == '5') {
                    $team_employee_data = '\'' . $login_user . '\'';
                } else {
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                }
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'email','date_inactive', 'picture');
                if($status == '')    
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                else
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
                break;
            case 4:
                $customer_query = '';
                if ($_SESSION['user_role'] == '3' || $_SESSION['user_role'] == '5') {
                    $customer_query = '\'' . $_SESSION['user_id'] . '\'';
                } else {
                    $this->tables = array('team');
                    $this->fields = array('employee');
                    $this->conditions = array('customer = ?');
                    $this->query_generate();
                    $customer_query = $this->sql_query;
                }

                //$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'email','date_inactive', 'picture');
                if($status == '')
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1');
                else
                    $this->conditions = array('AND', array('IN', 'username', $customer_query));
                if ($_SESSION['user_role'] != '3' && $_SESSION['user_role'] != '5')
                    $this->condition_values = array($login_user);

                break;
        }

        if ($key != NULL) {
            $mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($key));
            while (substr($mobile, 0, 3) == '+46' && strlen($mobile) > 1) {
                $mobile = substr($mobile, 3, 9999);
            }
            while (substr($mobile, 0, 1) == '0' && strlen($mobile) > 1) {
                $mobile = substr($mobile, 1, 9999);
            }
            $this->conditions[] = array('OR', 'LOWER(last_name) LIKE ?', 'LOWER(first_name) LIKE ?', 'mobile LIKE ?', 'code LIKE ?');
            $this->condition_values[] = "%" . strtolower($key) . "%";
            $this->condition_values[] = "%" . strtolower($key) . "%";
            $this->condition_values[] = "%" . strtolower($mobile) . "%";
            $this->condition_values[] = "%" . strtolower($key) . "%";
        }
        if ($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(first_name) collate utf8_bin ASC');
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(last_name) collate utf8_bin ASC');
        $this->query_generate();
        $employee_data = $this->query_fetch();
        if (count($employee_data))
            return $employee_data;
        else
            return array();
    }

    //using in gdschema_process main
    function employee_list_for_process($start_date, $end_date, $login_user = '', $key = NULL) {

        $user = new user();

        //echo "<script>alert(\"".$start_date." : ".$end_date."\")</script>";
        $employee_data = array();
        $team_employee_data = '';
        $login_user_role = '';
        if ($login_user == '') {
            $login_user = $_SESSION['user_id'];
            $login_user_role = $user->user_role($login_user);
        } else {

            $login_user_role = $user->user_role($login_user);
            //shifting the users
            $session_role = $user->user_role($_SESSION['user_id']);
            if (($login_user_role == 1 || $login_user_role == 6) && ($session_role != 1 && $session_role != 6)) {
                $login_user = $_SESSION['user_id'];
                $login_user_role = $session_role;
            } else if ($login_user_role == 7 && ($session_role == 2 || $session_role == 3 || $session_role == 4 || $session_role == 5)) {
                $login_user = $_SESSION['user_id'];
                $login_user_role = $session_role;
            } else if ($login_user_role == 2 && ($session_role == 3 || $session_role == 4 || $session_role == 5)) {
                $login_user = $_SESSION['user_id'];
                $login_user_role = $session_role;
            }
        }
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $this->tables = array('employee', 'timetable');
                    $this->fields = array('DISTINCT username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', 'timetable.employee like employee.username', 'employee.status = 1', 'timetable.status = 1', array('BETWEEN', 'timetable.date', '?', '?'));
                    $this->condition_values = array($start_date, $end_date);
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    //print_r($team_members);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee', 'timetable');
                    $this->fields = array('DISTINCT username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'employee.status = 1', 'timetable.status = 1', array('BETWEEN', 'timetable.date', '?', '?'));
                    $this->condition_values = array($start_date, $end_date);
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    if ($_SESSION['user_role'] == '3' || $_SESSION['user_role'] == '5') {
                        $team_employee_data = '\'' . $login_user . '\'';
                    } else {
                        $team_members = $this->team_members($_SESSION['user_id']);
                        $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    }
                    $this->tables = array('employee', 'timetable');
                    $this->fields = array('DISTINCT username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'timetable.employee like employee.username', 'employee.status = 1', 'timetable.status = 1', array('BETWEEN', 'timetable.date', '?', '?'));
                    $this->condition_values = array($start_date, $end_date);
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $customer_query = '';
                    if ($_SESSION['user_role'] == '3' || $_SESSION['user_role'] == '5') {
                        $customer_query = '\'' . $_SESSION['user_id'] . '\'';
                    } else {
                        $this->tables = array('team');
                        $this->fields = array('employee');
                        $this->conditions = array('customer = ?');
                        $this->query_generate();
                        $customer_query = $this->sql_query;
                    }

                    //$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee', 'timetable');
                    $this->fields = array('DISTINCT username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'timetable.employee like employee.username', 'employee.status = 1', 'timetable.status = 1', 'timetable.customer = ?', array('BETWEEN', 'timetable.date', '?', '?'));
                    if ($_SESSION['user_role'] != '3' && $_SESSION['user_role'] != '5')
                        $this->condition_values = array($login_user, $login_user, $start_date, $end_date);
                    else
                        $this->condition_values = array($login_user, $start_date, $end_date);
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();

                    $employee_data = $this->query_fetch();
                    break;
            }
        }
        if (count($employee_data))
            return $employee_data;
        else
            return array();
    }

    function employee_list_limit($start, $limit, $key = NULL) {

        $user = new user();
        $start = $start * 5;
        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
        $this->conditions = array('AND', 'status = 1');
        if ($key != NULL) {
            $this->conditions[] = array('OR', 'last_name LIKE ?', 'last_name LIKE ?');
            $this->condition_values = array($key . "%", strtolower($key) . "%");
        }
        $this->order_by = array('LOWER(last_name)');
        $this->limit = $start . ',' . $limit;
        $this->query_generate();
        $employee_data = $this->query_fetch();
        return !empty($employee_data) ? $employee_data : array();
    }

    function employee_slots_week($employee, $year_week) {

        global $week;
        $smarty = new smartySetup(array("messages.xml"),FALSE);
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        
        $w_start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $w_end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        $this->flush();
        $this->tables = array('timetable` as `t');
        $this->fields = array('t.id', 't.employee', 't.customer', 't.fkkn', 't.date', 't.time_from', 't.time_to', 
                't.status', 't.created_status', 't.type', 't.alloc_emp','t.comment','t.alloc_comment','t.cust_comment', 
                '(SELECT first_name FROM customer where username = t.customer) AS cust_first_name', 
                '(SELECT last_name FROM customer where username = t.customer) AS cust_last_name', 
                '(SELECT first_name FROM employee where username = t.employee) AS emp_first_name', 
                '(SELECT last_name FROM employee where username = t.employee) AS emp_last_name', 
                '(SELECT color FROM employee where username = t.employee) AS emp_color',
                'IF ((SELECT count(id) from report_signing where employee = t.employee and customer = t.customer and month(date) = month(t.date) and year(date) = year(t.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '0,1,2,4'));
        $this->condition_values = array($employee, $w_start_date, $w_end_date);
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        $week_slots = $this->query_fetch();
        
        $tl_employees = $tl_customers = array();
        if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
            $temp_tl_employees = $this->employees_list_for_right_click($employee);
            $temp_tl_customers = $this->customers_list_for_right_click($employee);
            foreach($temp_tl_employees as $temp_tl_employee){
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
        
        if(!empty($week_slots)){
            foreach ($week_slots as $key => $slot) {
                $show_details = 1;
                if($_SESSION['company_sort_by'] == 1){
                    $cust_name = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                    $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
                }
                elseif($_SESSION['company_sort_by'] == 2){
                    $cust_name = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                    $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
                }
                
                $tl_flag = 1;
                if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
                    //echo "<pre>".print_r($tl_employees, 1)."</pre>";
                    if($slot['employee'] != '' && $slot['customer'] != ''){
                        if(!in_array($slot['employee'], $tl_employees) && !in_array($slot['customer'], $tl_customers)){
                            $tl_flag = 0;
                        }
                        if (!in_array($slot['customer'], $tl_all_customers)) {
                            $cust_name = $smarty->translate['works_on_another_customer'];
                            $tl_flag = 0;
                            $show_details = 0;
                        }
                    }
                    $cust_name;
                }
                elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                    $cust_name = $smarty->translate['works_on_another_customer'];
                    $show_details = 0;
                    $tl_flag = 0;
                }
                elseif($_SESSION['user_role'] == 3){
                    if($_SESSION['user_id'] != $slot['employee'])
                        $tl_flag = 0;
                }
                $leave_data = array();
                if($slot['status'] == 2){
                    $leave_data = $this->get_leave_details_byTimeTable_data($slot['employee'],$slot['date'],$slot['time_from'],$slot['time_to']);
                    $leave_data[0]['leave_name'] = $smarty->leave_type[$leave_data[0]['type']];
                    
                    $related_slot = $this->check_relations_in_timetable_for_leave($slot['id']);
                    if(!empty($related_slot))
                        $leave_data[0]['is_exist_relation'] = 1;
                    else
                        $leave_data[0]['is_exist_relation'] = 0;
                }
                $tmp_array = array(
                    'slot'      => $slot['time_from'] . '-' . $slot['time_to'], 
                    'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to'], 100), 
                    'cust_name' => $cust_name, 
                    'emp_name'  => $emp_name, 
                    'leave_data'  => !empty($leave_data) ? $leave_data[0] : array(), 
                    'show_details' => $show_details,
                    'tl_flag'   => $tl_flag);
                
                $week_slots[$key] = array_merge($week_slots[$key], $tmp_array);
            }
        }
        
        //grouping as week_basis
        $grouped_week_slots = array();
        if(!empty($week_slots)){
            foreach ($week_slots as $slot)
                $grouped_week_slots[$slot['date']][] = $slot;
        }
        
        $i = 0;
        $datas = array();
        foreach ($week as $day) {
            $datas[$i]['day'] = $day;
            $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
            $datas[$i]['date'] = $date;
            $datas[$i]['slots'] = (isset($grouped_week_slots[$date]) && !empty($grouped_week_slots[$date])) ? $grouped_week_slots[$date] : array();
            $i++;
        }
        
        return $datas;
    }

    function employee_slots_day($employee, $date) {

        $smarty = new smartySetup(array("messages.xml"),FALSE);
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'time_from', 'time_to', 'status', 'created_status', 'type', 'alloc_emp', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name', '(SELECT color FROM employee where username = timetable.employee) AS emp_color', 'date');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2,4'));
        $this->condition_values = array($employee, $date);
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        //cheking the slot is signed
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        $tl_employees = array();
        $tl_customers = array();
        $temp_privilege = $this->get_privileges($_SESSION['user_id'], 1);

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $this->employees_list_for_right_click($employee);
            $temp_tl_customers = $this->customers_list_for_right_click($employee);
            foreach ($temp_tl_employees as $temp_tl_employee) {
                $tl_employees[] = $temp_tl_employee['username'];
            }
            foreach ($temp_tl_customers as $temp_tl_customer) {
                $tl_customers[] = $temp_tl_customer['username'];
            }
        }

        foreach ($slots as $slot) {
            $tl_flag = 1;
            $signin_flag = 0;
            if ($slot['customer']) {
                $employee_username = $slot['employee'];
                $this->tables = array('report_signing');
                $this->fields = array('id');
                $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?', 'signin_employee IS NOT NULL', 'signin_employee !=?');
                $this->condition_values = array($slot['customer'], $employee_username, $date_month, $date_year, '');
                $this->query_generate();
                $signin_data = $this->query_fetch();

                if (!empty($signin_data)) {
                    $signin_flag = 1;
                }
            }
            if ($_SESSION['company_sort_by'] == 2) {
                $cust_name = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
            } elseif ($_SESSION['company_sort_by'] == 1) {
                $cust_name = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
            }
            if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                if ($slot['employee'] != '' && $slot['customer'] != '') {
                    if (!in_array($slot['employee'], $tl_employees) && !in_array($slot['customer'], $tl_customers)) {
                        $tl_flag = 0;
                    }
                }
                $this->tables = array('team');
                $this->fields = array('customer');
                $this->conditions = array('AND', 'employee = ?');
                $this->condition_values = array($_SESSION['user_id']);
                $this->query_generate();

                $temp_datas = $this->query_fetch(2);

                $tl_all_customers = array();
                foreach ($temp_datas as $temp_data) {
                    $tl_all_customers[] = $temp_datas;
                }
                if (!in_array($slot['customer'], $tl_all_customers) && $slot['employee'] != '' && $slot['customer'] != '') {

                    $cust_name = $smarty->translate['works_on_another_customer'];
                    $tl_flag = 0;
                }
            } elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                $cust_name = $smarty->translate['works_on_another_customer'];
                $tl_flag = 0;
            }
            if ($slot['customer'] != '') {
                $temp_privilege = $this->get_privileges($_SESSION['user_id'], 1, $slot['customer']);
            }
            $leave_data = array();
            if ($slot['status'] == 2) {
                $leave_data = $this->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
                $leave_data[0]['leave_name'] = $smarty->leave_type[$leave_data[0]['type']];
            }
            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'fkkn' => $slot['fkkn'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'cust_name' => $cust_name, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'], 'emp_color' => $slot['emp_color'], 'signed' => $signin_flag, 'tl_flag' => $tl_flag, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'leave_data' => $leave_data[0]);
        }

        return $datas;
    }

    function chk_employee_rpt_signed($employee, $customer, $date, $session_msg = FALSE, $group_check = FALSE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @used-for: checking employee is signed in a perticular customer/date
         * @return-type: integer 
         * @return-values: 0 - Unsigned, 1 - Signed.
         * @parameter $employee - username of employee inwhich the employee-customer is signed
         * @parameter $customer - username of customer inwhich the employee-customer is signed
         * @parameter $date - date(yyyy-mm-dd) to check the employee-customer is signed
         * @parameter $session_msg - store signed error message in SESSION if TRUE
         * @parameter $group_check - check sign check as a set of employees as a single query
         */
        require_once ('plugins/message.class.php');
        if ($employee == '' || $customer == '')
            return 0;    //return as unsigned, for ensuring the credentials 
        $obj_msg = new message();
        $obj_customer = new customer();

        //cheking the slot is signed
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];

        $this->tables = array('report_signing');
        $this->fields = array('id');
        if ($group_check == FALSE) {
            $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'MONTH(date) = ?', 'YEAR(date) = ?', 'signin_employee IS NOT NULL', 'signin_employee != ?');
            $this->condition_values = array($employee, $customer, $date_month, $date_year, '');
        } else {
            $this->conditions = array('AND', array('IN', 'employee', $employee), 'customer = ?', 'MONTH(date) = ?', 'YEAR(date) = ?', 'signin_employee IS NOT NULL', 'signin_employee != ?');
            $this->condition_values = array($customer, $date_month, $date_year, '');
        }
        $this->query_generate();
        $signin_data = $this->query_fetch();
        $signin_flag = 0;
        if (!empty($signin_data)) {
            $signin_flag = 1;

            //set signing message in session
            if ($session_msg) {
                $emp_details = $this->get_employee_detail($employee);
                $customer_details = $obj_customer->customer_detail($customer);
                $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                $cust_name = $customer_details['last_name'] . ' ' . $customer_details['first_name'];
                $obj_msg->set_message('fail', 'employee_signed_in');
                $obj_msg->set_message_exact('fail', $emp_name . ' <-> ' . $cust_name . ' => ' . $date);
            }
        }
        return $signin_flag;
    }

    function chk_employee_relation_rpt_signed($employee, $date_from, $date_to, $time_from, $time_to) {
        /**
         * this function used from message center leave, gdschema alloc window leave reject
         */
        $time_table_entries = array();
        $j = 0;
        $date = strtotime($date_from);
       // $leave_start = $leave_end = '';
        $cur_date = '';
       // $return_flag = TRUE;
        while ($date <= strtotime($date_to)) {

            if ($j == 0 && $date == strtotime($date_to)) {

                //$data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['start_date'],$_REQUEST['time_from'],$_REQUEST['time_to']);
                $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, $date_from, $time_from, $time_to));
                $cur_date = $date_from;
                //$leave_start = mktim
            } else if ($j == 0) {
                //$data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['start_date'],$_REQUEST['time_from'],24);
                $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, $date_from, $time_from, 24));
                $cur_date = $date_from;
            } else if ($j != 0 && $date < strtotime($date_to)) {
                //$data = $leave->employee_get_leave_slot($_REQUEST['user'],date('Y-m-d',$date),0,24);
                $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, date('Y-m-d', $date), 0, 24));
                $cur_date = date('Y-m-d', $date);
            } else if ($j != 0 && $date == strtotime($date_to)) {
                //$data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['end_date'],0,$_REQUEST['time_to']);
                $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, $date_to, 0, $time_to));
                $cur_date = $date_to;
            }


           // $date_array = explode('-', $cur_date);
           // $date_month = $date_array[1];
           // $date_year = $date_array[0];

            $leave_ids = '\'' . implode('\', \'', $time_table_entries) . '\'';

            $this->flush();
            $this->tables = array('timetable');
            $this->fields = array('employee', 'customer', 'date');
            $this->conditions = array('AND', 'employee IS not NULL', 'employee != ?', 'customer IS not NULL', 'customer != ?', array('IN', 'relation_id', $leave_ids));
            $this->condition_values = array('', '');
            $this->query_generate();
            $relational_employee_customer_data = $this->query_fetch();

            if (!empty($relational_employee_customer_data)) {
                $this->flush();
                foreach ($relational_employee_customer_data as $relation_data) {
                    if ($this->chk_employee_rpt_signed($relation_data['employee'], $relation_data['customer'], $relation_data['date']) == 1) {
                       // $return_flag = FALSE;
                        return FALSE;
                        break;
                    }
                }
            }

            $date = strtotime('+1 day', $date);
            $j++;
        }
        return TRUE;
    }

    function employee_add_leave($employee_username, $date_from, $date_to, $type, $comments, $replacer_employee = NULL, $no_pay = 0,$leave_approve_on_apply) {
        /**
         * @edited-by: Shamsu<shamsu@arioninfotech.com>
         * @for: save leave between 2 dates.
         * @return-values:  TRUE (boolean) - Successfully saved leave
         *                  FLASE (boolean) - Fail save leave
         *                  array() - Fail save leave with explanation
         */
        $leave_type = array(
            '1' => 'Sjuk',
            '2' => 'Sem',
            '3' => 'VAB',
            '4' => 'FP',
            '5' => 'No Pay',
            //'6' => 'Utbild',
            '7' => 'Övrigt',
                //'8' => 'Byte',
            '9' => 'Permission'
        );
        $this->tables = array('leave');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'));
        $this->condition_values = array($employee_username, $date_from, $date_to);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['id'] == "" || $data[0]['id'] == NULL) {

            $user = new user();
            $date_calc = new datecalc();
            $alloc_employee = $_SESSION['user_id'];
            $enter_user_role = $user->user_role($alloc_employee);
            $appr_date = date('Y-m-d');
            $this->tables = array('timetable');
            $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', array('BETWEEN', 'date', '?', '?'));
            $this->condition_values = array($employee_username, $date_from, $date_to);
            $this->query_generate();
            $slot_datas = $this->query_fetch();
            $duplicate_slots = array();
            $process_flag = TRUE;
            $no_replacer_avail_slot = array();  //store all slot inwhich it have not possible to allocate replacer employee
            foreach ($slot_datas as $slot_data) {
                if ($slot_data['customer']) {
                    if ($replacer_employee != NULL) {     //to check replacer employee is available for this slot - by shamsu 
                        $avail_replace_employees = $this->get_available_users($slot_data['customer'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['date'], $replacer_employee);
                        if (empty($avail_replace_employees)) {
                            $process_flag = FALSE;
                            $no_replacer_avail_slot = array('id' => $slot_data['id'],
                                'date' => $slot_data['date'],
                                'time_from' => $slot_data['time_from'],
                                'time_to' => $slot_data['time_to']);
                            break;
                        }
                    }
                    if ($replacer_employee != NULL && $slot_data['customer'] != '')
                        $duplicate_slots[] = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['type'], $slot_data['fkkn'], 1, $alloc_employee, $slot_data['id'], $replacer_employee);
                    else
                        $duplicate_slots[] = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['type'], $slot_data['fkkn'], 0, $alloc_employee, $slot_data['id'], $replacer_employee);
                }
            }
            if ($process_flag) {
                if (!empty($slot_datas)) {

                    $this->begin_transaction();
                    $this->tables = array('timetable');
                    $this->fields = array('status');
                    $this->field_values = array('2');
                    $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', array('BETWEEN', 'date', '?', '?'));
                    $this->condition_values = array($employee_username, $date_from, $date_to);
                    if ($this->query_update()) {
                        if (!empty($duplicate_slots)) {
                            $this->tables = array('timetable');
                            $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'alloc_emp', 'relation_id', 'employee');
                            $this->field_values = $duplicate_slots;

                            if (!$this->query_insert()) {
                                $this->rollback_transaction();
                                return FALSE;
                            }
                        }
                        $mail_message_days = 'Datum och pass: ';
                        $sms_message_days = '';
                        //getting group id
                        $this->tables = array('leave');
                        $this->fields = array('MAX(group_id) AS group_id');
                        $this->query_generate();
                        $data = $this->query_fetch(2);
                        $new_group_id = (int) ($data[0]) + 1;
                        $days = $date_calc->get_days($date_from, $date_to);
                        if (count($days) > 1) {
                            $leave_days = array();
                            foreach ($days as $day) {

                                $mail_message_days .= $day . ' : 00.00-24.00 (24h)<br/>';
                                $sms_message_days .= 'Datum: ' . $day . '%0APass: 00.00-24.00%0A';
                                /* if ($enter_user_role == 1) {

                                  $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                                  } else { */

                                $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, $leave_approve_on_apply, $no_pay);
                                //}
                            }
                        } else {
                            $mail_message_days .= $days[0] . ' : 00.00-24.00 (24h)<br/>';
                            $sms_message_days .= 'Datum: ' . $days[0] . '%0APass: 00.00-24.00%0A';
                            /* if ($enter_user_role == 1) {

                              $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                              } else { */

                            $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, $leave_approve_on_apply, $no_pay);
                            //}
                        }
                        $this->tables = array('leave');
                        /* if ($enter_user_role == 1) {

                          $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'appr_date', 'status');
                          } else { */

                        $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status', 'no_pay');
                        //}
                        $this->field_values = $leave_days;
                        if ($this->query_insert()) {
                            $this->commit_transaction();
                            $recipents = $this->employee_leave_recipients($employee_username, $type);

                            if (!empty($recipents)) {
                                //sending email
                                $employe_data = $this->get_employee_detail($employee_username);
                                $mail_message = 'Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                                $mail_message .= 'Frånvaro typ: ' . $leave_type[$type] . '<br/>';
                                $mail_message .= $mail_message_days;
                                $mail_subject = 'Frånvaro meddelande: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                                $mail = new SimpleMail($mail_subject, $mail_message);
                                $mail->addSender("cirrus-noreplay@time2view.se");
                                foreach ($recipents as $recipent) {

                                    if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

                                        $mail->addRecipient($recipent['email']);
                                    }
                                }
                                //sending sms
                                $sms_message = '%0A' . $leave_type[$type] . ' : ' . $employe_data['first_name'] . '%20' . $employe_data['last_name'] . '%0A';
                                $sms_message .= $sms_message_days;
                                $sms = new sms($sms_message);
                                foreach ($recipents as $recipient) {
                                    if ($recipient['mobile'] != '' && $recipient['mobile_notification'] == 1) {
                                        $sms->addRecipient($recipient['mobile']);
                                    }
                                }

                                $return_flag = TRUE;
                                if ($sms->recipients) {
                                    if (!$sms->send())
                                        $return_flag = FALSE;
                                }
                                if ($mail->recipients) {
                                    if (!$mail->send())
                                        $return_flag = FALSE;
                                }
                                return $return_flag;
                            } else {
                                return TRUE;
                            }
                        } else {
                            $this->rollback_transaction();
                            return FALSE;
                        }
                    } else {
                        $this->rollback_transaction();
                        return FALSE;
                    }
                } else {
                    $mail_message_days = 'Datum och pass: ';
                    $sms_message_days = '';
                    //getting group id
                    $this->tables = array('leave');
                    $this->fields = array('MAX(group_id) AS group_id');
                    $this->query_generate();
                    $data = $this->query_fetch(2);
                    $new_group_id = (int) ($data[0]) + 1;
                    $this->begin_transaction();
                    $days = $date_calc->get_days($date_from, $date_to);
                    if (count($days) > 1) {
                        $leave_days = array();
                        foreach ($days as $day) {

                            $mail_message_days .= $day . ' : 00.00-24.00 (24h)<br/>';
                            $sms_message_days .= 'Datum: ' . $day . '%0APass: 00.00-24.00%0A';
                            /* if ($enter_user_role == 1) {

                              $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                              } else { */

                            $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, '0', $no_pay);
                            //}
                        }
                    } else {
                        $mail_message_days .= $days[0] . ' : 00.00-24.00 (24h)<br/>';
                        $sms_message_days .= 'Datum: ' . $days[0] . '%0APass: 00.00-24.00%0A';
                        /* if ($enter_user_role == 1) {

                          $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                          } else { */

                        $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, '0', $no_pay);
                        //}
                    }
                    $this->tables = array('leave');
                    /* if ($enter_user_role == 1) {

                      $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'appr_date', 'status');
                      } else { */

                    $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status', 'no_pay');
                    //}
                    $this->field_values = $leave_days;
                    if ($this->query_insert()) {
                        $this->commit_transaction();
                        $recipents = $this->employee_leave_recipients($employee_username, $type);
                        if (!empty($recipents)) {
                            //sending email
                            $employe_data = $this->get_employee_detail($employee_username);
                            $mail_message = 'Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                            $mail_message .= 'Frånvaro typ: ' . $leave_type[$type] . '<br/>';
                            $mail_message .= $mail_message_days;
                            $mail_subject = 'Frånvaro meddelande: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                            $mail = new SimpleMail($mail_subject, $mail_message);
                            $mail->addSender("cirrus-noreplay@time2view.se");
                            foreach ($recipents as $recipent) {

                                if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {
                                    $mail->addRecipient($recipent['email']);
                                }
                            }
                            //sending sms
                            $sms_message = '%0A' . $leave_type[$type] . ' : ' . $employe_data['first_name'] . '%20' . $employe_data['last_name'] . '%0A';
                            $sms_message .= $sms_message_days;
                            $sms = new sms($sms_message);
                            foreach ($recipents as $recipient) {
                                if ($recipient['mobile'] != '' && $recipient['mobile_notification'] == 1) {
                                    $sms->addRecipient($recipient['mobile']);
                                }
                            }
                            if ($sms->recipients && $mail->recipients) {
                                if ($sms->send() && $mail->send()) {
                                    return TRUE;
                                } else {
                                    return FALSE;
                                }
                            } else {
                                return TRUE;
                            }
                        } else {
                            return TRUE;
                        }
                    } else {
                        $this->rollback_transaction();
                        return FALSE;
                    }
                }
            }
            else
                return $no_replacer_avail_slot;
            return array('reason' => 'no_replacer_avail_slot', 'no_replacer_avail_slots' => $no_replacer_avail_slot);
        } else {
            //return FALSE;
            return array('reason' => 'Leave_already_exist', 'leave_ids' => $data);
        }
    }

    function employee_leave_recipients($employee_username, $leave_type) {

        //leave type - 9 will be stored as 12 in employee notification table
        if($leave_type == 9) $leave_type = 12;
        
        $recipients = array();
        //getting administrator role
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username');
        $this->conditions = array('role = 1');
        $this->query_generate();
        $sql_query_admin_in = $this->sql_query;


        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_admin_in));
        $this->query_generate();
        $admin_datas = $this->query_fetch();

        //getting teamleader
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?');
        $this->query_generate();
        $sql_query_customer = $this->sql_query;

        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('AND', array('IN', 'customer', $sql_query_customer), array('OR', 'role = 2', 'role = 7'));
        $this->condition_values = array($employee_username);
        $this->query_generate();
        $sql_query_team_leader = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_team_leader));
        $this->query_generate();
        $team_leader_datas = $this->query_fetch();

        $recipient_datas = array_merge($admin_datas, $team_leader_datas);

        if (!empty($recipient_datas)) {

            foreach ($recipient_datas as $recipient_data) {

                //getting notification privilege for email
                $this->tables = array('leave_notification');
                $this->fields = array('employee');
                $this->conditions = array('AND', 'employee = ?', array('OR', 'email LIKE ?', 'email LIKE ?'));
                $this->condition_values = array($recipient_data['username'], '%,' . $leave_type . ',%', $leave_type . ',%');
                $this->query_generate(); //echo $this->sql_query;
                $data_notification = $this->query_fetch();
                $mail_notification = 0;
                if (!empty($data_notification)) {
                    $mail_notification = 1;
                }
                //getting notification privilege for mobile
                $this->tables = array('leave_notification');
                $this->fields = array('employee');
                $this->conditions = array('AND', 'employee = ?', array('OR', 'mobile LIKE ?', 'mobile LIKE ?'));
                $this->condition_values = array($recipient_data['username'], '%,' . $leave_type . ',%', $leave_type . ',%');
                $this->query_generate(); //echo $this->sql_query;
                $data_notification = $this->query_fetch();
                $mobile_notification = 0;
                if (!empty($data_notification)) {
                    $mobile_notification = 1;
                }
                $recipients[] = array('username' => $recipient_data['username'], 'email' => $recipient_data['email'], 'mobile' => $recipient_data['mobile'], 'email_notification' => $mail_notification, 'mobile_notification' => $mobile_notification);
            }
            return !empty($recipients) ? $recipients : array();
        }else
            return array();
    }

    function check_complementary_exists($employee_username, $date_from, $date_to, $time_from, $time_to) {
        if ($date_to == '') {

            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), array('IN', 'type', '12,13'), 'employee = ?', 'date = ?', 'time_to > ?'); // removed = from tome_to>=
            $this->query_generate();
            $query_inner = $this->sql_query;

            $this->tables = array('timetable');
            $this->fields = array('count(id) as id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), array('IN', 'type', '12,13'), 'employee = ?', 'date = ?', 'time_from < ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($employee_username, $date_from, (float) $time_to, $employee_username, $date_from, (float) $time_from);
            $this->order_by = array('time_from');
        } else {
            $this->tables = array('timetable');
            $this->fields = array('count(id) as id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), array('IN', 'type', '12,13'), 'employee = ?', array('BETWEEN', 'date', '?', '?'));
            $this->condition_values = array($employee_username, $date_from, $date_to);
        }

        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['id'] == 0 ? FALSE : TRUE;
    }
    
    function check_dismissal_exists($employee_username, $date_from, $date_to, $time_from, $time_to) {
        if ($date_to == '') {
            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), array('IN', 'type', '16,17'), 'employee = ?', 'date = ?', 'time_to > ?'); // removed = from tome_to>=
            $this->query_generate();
            $query_inner = $this->sql_query;

            $this->tables = array('timetable');
            $this->fields = array('count(id) as id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), array('IN', 'type', '16,17'), 'employee = ?', 'date = ?', 'time_from < ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($employee_username, $date_from, (float) $time_to, $employee_username, $date_from, (float) $time_from);
            $this->order_by = array('time_from');
        } else {
            $this->tables = array('timetable');
            $this->fields = array('count(id) as id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), array('IN', 'type', '16,17'), 'employee = ?', array('BETWEEN', 'date', '?', '?'));
            $this->condition_values = array($employee_username, $date_from, $date_to);
        }

        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['id'] == 0 ? FALSE : TRUE;
    }

    function employee_add_leave_slot($employee_username, $date, $time_from, $time_to, $type, $comments = NULL, $replacer = NULL, $no_pay = 0,$leave_approve_on_apply = 0) {

        /**
         * @edited-by: Shamsu<shamsu@arioninfotech.com>
         * @for: save leave between a time-range in a date.
         * @return-values:  TRUE (boolean) - Successfully saved leave
         *                  FLASE (boolean) - Fail save leave
         *                  array() - Fail save leave with explanation
         */
        if ($time_to == 0)
            $time_to = 24.00;
        $this->tables = array('leave');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')));
        $this->condition_values = array($employee_username, $date, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to);
        $this->query_generate();

        $data = $this->query_fetch();
        if ($data[0]['id'] == "" || $data[0]['id'] == NULL) {
            $leave_type = array(
                '1' => 'Sjuk',
                '2' => 'Sem',
                '3' => 'VAB',
                '4' => 'FP',
                '5' => 'No Pay',
                //'6' => 'Utbild',
                '7' => 'Övrigt',
                    //'8' => 'Byte',
                '9' => 'Permission'
            );
            $alloc_employee = $_SESSION['user_id'];
            $user = new user();
            $enter_user_role = $user->user_role($alloc_employee);
            $appr_date = date('Y-m-d');
            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', 'date = ?', 'time_to > ?'); // removed = from tome_to>=
            $this->query_generate();
            $query_inner = $this->sql_query;

            $this->tables = array('timetable');
            $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', 'date = ?', 'time_from < ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($employee_username, $date, (float) $time_to, $employee_username, $date, (float) $time_from);
            $this->order_by = array('time_from');
            $this->query_generate();
            $slot_datas = $this->query_fetch();
            if (!empty($slot_datas)) {
                $flag = 0;
                $this->begin_transaction();
                foreach ($slot_datas as $slot_data) {
                    $slot_id = $slot_data['id'];
                    $slot_from_time = $slot_data['time_from'];
                    $slot_to_time = $slot_data['time_to'];
                    if ($slot_from_time >= $time_from) { //= is added by shaju
                        if ($slot_to_time > $time_to) {

                            //splitting slots
                            $this->tables = array('timetable');
                            $this->fields = array('time_to', 'status');
                            $this->field_values = array((float) $time_to, '2');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                $duplicate_flag = 1;
                                if ($slot_data['customer']) {
                                    $this->tables = array('timetable');
                                    $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'comment', 'alloc_emp', 'relation_id');
                                    $this->field_values = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], (float) $time_to, $slot_data['type'], $slot_data['fkkn'], $comments, $alloc_employee, $slot_id);
                                    if ($replacer != NULL) {
                                        $this->fields[] = 'employee';
                                        $this->field_values[] = $replacer;
                                    }
                                    $this->fields[] = 'status';
                                    if ($replacer != NULL)
                                        $this->field_values[] = 1;
                                    else
                                        $this->field_values[] = 0;

                                    if (!$this->query_insert()) {
                                        $duplicate_flag = 0;
                                    }
                                }
                                if ($duplicate_flag) {
                                    //insert remaining time slot
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment', 'alloc_emp');
                                    $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], (float) $time_to, $slot_to_time, $slot_data['type'], $slot_data['fkkn'], $slot_data['status'], $comments, $alloc_employee);
                                    if (!$this->query_insert())
                                        $flag++;
                                }
                                else
                                    $flag++;
                            }
                            else
                                $flag++;
                        } else {

                            $this->tables = array('timetable');
                            $this->fields = array('status');
                            $this->field_values = array('2');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                if ($slot_data['customer']) {
                                    $this->tables = array('timetable');
                                    $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'comment', 'alloc_emp', 'relation_id');
                                    $this->field_values = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['type'], $slot_data['fkkn'], $comments, $alloc_employee, $slot_id);
                                    if ($replacer != NULL) {
                                        $this->fields[] = 'employee';
                                        $this->field_values[] = $replacer;
                                    }
                                    $this->fields[] = 'status';
                                    if ($replacer != NULL)
                                        $this->field_values[] = 1;
                                    else
                                        $this->field_values[] = 0;

                                    if (!$this->query_insert())
                                        $flag++;
                                }
                            }
                            else
                                $flag++;
                        }
                    } else {

                        if ($slot_to_time > $time_to) {

                            //splitting slots
                            $this->tables = array('timetable');
                            $this->fields = array('time_from', 'time_to', 'status');
                            $this->field_values = array((float) $time_from, (float) $time_to, '2');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                $duplicate_flag = 1;
                                if ($slot_data['customer']) {
                                    $this->tables = array('timetable');
                                    $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'comment', 'alloc_emp', 'relation_id');
                                    $this->field_values = array($slot_data['customer'], $slot_data['date'], (float) $time_from, (float) $time_to, $slot_data['type'], $slot_data['fkkn'], $comments, $alloc_employee, $slot_id);
                                    if ($replacer != NULL) {
                                        $this->fields[] = 'employee';
                                        $this->field_values[] = $replacer;
                                    }
                                    $this->fields[] = 'status';
                                    if ($replacer != NULL)
                                        $this->field_values[] = 1;
                                    else
                                        $this->field_values[] = 0;

                                    if (!$this->query_insert()) {
                                        $duplicate_flag = 0;
                                    }
                                }
                                if ($duplicate_flag) {

                                    //insert remaining time slot
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment', 'alloc_emp');
                                    $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], (float) $time_to, $slot_to_time, $slot_data['type'], $slot_data['fkkn'], $slot_data['status'], $comments, $alloc_employee);
                                    if (!$this->query_insert())
                                        $flag++;
                                    if ($time_from > $slot_from_time) {

                                        //insert remaining time slot
                                        $this->tables = array('timetable');
                                        $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment', 'alloc_emp');
                                        $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], $slot_from_time, (float) $time_from, $slot_data['type'], $slot_data['fkkn'], $slot_data['status'], $comments, $alloc_employee);
                                        if (!$this->query_insert())
                                            $flag++;
                                    }
                                }
                                else
                                    $flag++;
                            }
                            else
                                $flag++;
                        } else {

                            $this->tables = array('timetable');
                            $this->fields = array('time_from', 'status'); //time from added by shaju
                            $this->field_values = array($time_from, '2'); //time from added by shaju
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                if ($slot_data['customer']) {
                                    $this->tables = array('timetable');
                                    $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'comment', 'alloc_emp', 'relation_id');
                                    $this->field_values = array($slot_data['customer'], $slot_data['date'], $time_from, $slot_data['time_to'], $slot_data['type'], $slot_data['fkkn'], $comments, $alloc_employee, $slot_id); //time_from added by shaju
                                    if ($replacer != NULL) {
                                        $this->fields[] = 'employee';
                                        $this->field_values[] = $replacer;
                                    }
                                    $this->fields[] = 'status';
                                    if ($replacer != NULL)
                                        $this->field_values[] = 1;
                                    else
                                        $this->field_values[] = 0;

                                    if (!$this->query_insert())
                                        $flag++;
                                }
                                if ($time_from > $slot_from_time) {

                                    //insert remaining time slot
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment', 'alloc_emp');
                                    $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], $slot_from_time, (float) $time_from, $slot_data['type'], $slot_data['fkkn'], $slot_data['status'], $comments, $alloc_employee);
                                    if (!$this->query_insert())
                                        $flag++;
                                }
                            }
                            else
                                $flag++;
                        }
                    }
                }

                if ($flag == 0) {

                    //entry on leave table
                    $mail_message_days = 'Datum och pass: ';
                    $sms_message_days = '';
                    //getting group id
                    $this->tables = array('leave');
                    $this->fields = array('MAX(group_id) AS group_id');
                    $this->query_generate();
                    $data = $this->query_fetch(2);
                    $new_group_id = (int) ($data[0]) + 1;
                    $this->tables = array('leave');
                    $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status', 'no_pay');
                    $mail_message_days .= $date . ' : ' . str_pad(number_format($time_from, 2), 5, '0', STR_PAD_LEFT) . '-' . str_pad(number_format($time_to, 2), 5, '0', STR_PAD_LEFT) . ' (' . $this->time_difference($time_from, $time_to, 100) . 'h)' . '<br/>';
                    $sms_message_days .= 'Datum: ' . $date . '%0APass: ' . $time_from . '-' . $time_to . '%0A';
                    $this->field_values = array($new_group_id, $employee_username, $date, (float) $time_from, (float) $time_to, $type, $comments, $alloc_employee, $leave_approve_on_apply , $no_pay);
                    if ($this->query_insert()) {
                        $this->commit_transaction();
                        $recipents = $this->employee_leave_recipients($employee_username, $type);
                        if (!empty($recipents)) {
                            //sending email
                            $employe_data = $this->get_employee_detail($employee_username);
                            $mail_message = 'Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                            $mail_message .= 'Frånvaro typ: ' . $leave_type[$type] . '<br/>';
                            $mail_message .= $mail_message_days;
                            $mail_subject = 'Datum och tid: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                            $mail = new SimpleMail($mail_subject, $mail_message);
                            $mail->addSender("cirrus-noreplay@time2view.se");
                            foreach ($recipents as $recipent) {
                                if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {
                                    $mail->addRecipient($recipent['email']);
                                }
                            }

                            //sending sms
                            $sms_message = '%0A' . $leave_type[$type] . ' : ' . $employe_data['first_name'] . '%20' . $employe_data['last_name'] . '%0A';
                            $sms_message .= $sms_message_days;
                            $sms = new sms($sms_message);
                            foreach ($recipents as $recipient) {
                                if ($recipient['mobile'] != '' && $recipient['mobile_notification'] == 1) {
                                    $sms->addRecipient($recipient['mobile']);
                                }
                            }

                            $return_flag = TRUE;
                            if ($sms->recipients) {
                                if (!$sms->send())
                                    $return_flag = FALSE;
                            }
                            if ($mail->recipients) {
                                if (!$mail->send())
                                    $return_flag = FALSE;
                            }
                            return $return_flag;
                        } else {
                            return TRUE;
                        }
                    } else {
                        $this->rollback_transaction();
                        return FALSE;
                    }
                } else {
                    $this->rollback_transaction();
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            //return FALSE;
            return array('reason' => 'Leave_already_exist', 'leave_ids' => $data);
        }
    }

    function team_members($username) {
        $user = new user();
        $user_role = $user->user_role($username);
        $cust_query = '';
        if ($user_role == 4) {
            $cust_query = "'" . $username . "'";
        } else {
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer AS customer');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($username);
            $this->query_generate();
            $cust_query = $this->sql_query;
            $data = $this->query_fetch();
        }
        if (count($data) || $user_role == 4) {

            $this->tables = array('team');
            $this->fields = array('DISTINCT employee AS employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $data = $this->query_fetch(2);
        } else {

            $data = array('employee' => $username);
        }
        return $data;
    }

    function login_add($secondary_login = FALSE) {

        global $preference, $db;

        $this->tables = array($db['database_master'] . '.login');
        $this->fields = array('username');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($this->social_security);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['username']){
            if($secondary_login) $this->secondary_login_add();
            return TRUE;
        }

        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($db['database_master'] . '.login');
            if ($this->password != NULL) {
                $this->fields = array('username', 'mobile', 'social_security', 'password', 'role', 'login', 'date', 'company_ids');
                $this->field_values = array($this->username, $this->mobile, $this->social_security, md5($this->hash . $this->password), $this->role, $this->login, date('Y-m-d'), $this->company_id . ',');
            } else {
                $this->fields = array('username', 'mobile', 'social_security', 'role', 'login', 'date', 'company_ids');
                $this->field_values = array($this->username, $this->mobile, $this->social_security, $this->role, $this->login, date('Y-m-d'), $this->company_id . ',');
            }
            // $this->query_insert();
            if ($this->query_insert()) {
                if($secondary_login) $this->secondary_login_add();
                return TRUE;
            } else {
                return FALSE;
            }
        } else
            return FALSE;
    }

    function login_update($secondary_login = FALSE) {

        global $preference, $db;
        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array('' . $db['database_master'] . '.login');
            if ($this->password != NULL) {
                $this->fields = array('password', 'mobile', 'role', 'error', 'date');
                $this->field_values = array(md5($this->hash . $this->password), $this->mobile, $this->role, '0', date('Y-m-d'));
            } else {
                $this->fields = array('role', 'mobile');
                $this->field_values = array($this->role, $this->mobile);
            }
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {
                if($secondary_login) $this->secondary_login_update();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    function secondary_login_add() {

        global $preference, $db;

        $this->tables = array($db['database_master'] . '.secondary_login');
        $this->fields = array('username');
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['username'])
            return TRUE;

        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($db['database_master'] . '.secondary_login');
            $this->fields = array('username', 'company_id', 'last_login_time', 'last_pw_update_date', 'error');
            $this->field_values = array($this->username, $this->company_id, '0000-00-00 00:00:00', date('Y-m-d'), 0);
            if ($this->password != NULL) {
                $this->fields[] = 'password';
                $this->field_values[] = md5($this->hash . $this->password);
            } else {
                $this->fields[] = 'password';
                $this->field_values[] = md5($this->hash . '12345678');
            }
            return $this->query_insert();
        } else
            return FALSE;
    }
    
    function secondary_login_update() {

        global $preference, $db;
        if ($this->username != NULL && $this->password != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($db['database_master'] . '.secondary_login');
            $this->fields = array('password', 'error', 'last_pw_update_date');
            $this->field_values = array(md5($this->hash . $this->password), 0, date('Y-m-d H:i:s'));
            $this->conditions = array('AND', 'username = ?', 'company_id = ?');
            $this->condition_values = array($this->username, $this->company_id);
            return $this->query_update();
        } else 
            return FALSE;
    }

    function employee_work($username) {

        $this->tables = array('employee');
        $this->fields = array('works');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        $work_det = array();
        if (!empty($data)) {

            $works = explode(',', $data[0]['works']);
            foreach ($works as $work) {
                if ($work['id'])
                    $work_det[] = array('id' => $work['id'], 'name' => $this->get_work_details($work['id']));
            }
            return $work_det;
        } else {

            return FALSE;
        }
    }

    function employee_add() {

        $this->tables = array('employee');
        $this->fields = array('username');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($this->social_security);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['username'])
            return TRUE;
        if ($this->username != NULL) {
            $this->inactive_date = trim($this->inactive_date) != '' ? trim($this->inactive_date) : NULL;
            $this->sem_leave_todate = trim($this->sem_leave_todate) != '' ? trim($this->sem_leave_todate) : NULL;
            $this->tables = array('employee');
            $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'gender', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status', 'date_inactive', 'max_hours', 'monthly_salary', 'start_day', 'remaining_sem_leave', 'sem_leave_todate', 'leave_in_advance', 'care_of', 'office_personal', 'substitute', 'salary_type', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days', 'ice', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length', 'candg_follow');
            $this->field_values = array($this->username, $this->century, $this->code, $this->social_security, $this->first_name, $this->last_name, $this->gender, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->color_code, $this->status, $this->inactive_date, $this->max_hours, $this->monthly_salary, $this->start_day, $this->remaining_sem_leave, $this->sem_leave_todate, $this->leave_in_advance, $this->care_of, $this->office_personal, $this->substitute, $this->salary_type, $this->sem_leave_days, $this->vab_leave_days, $this->fp_leave_days, $this->nopay_leave_days, $this->other_leave_days, $this->ice, $this->employee_contract_start_month, $this->employee_contract_month_start_date, $this->employee_contract_period_length, $this->candg_follow);

            if ($this->use_inconvenient !== NULL) {
                $this->fields[] = 'inconvenient_on';
                $this->field_values[] = $this->use_inconvenient;
            }
            return $this->query_insert();
        }
        else
            return FALSE;
    }

    function employee_update() {

        if ($this->username != NULL) {
            $this->tables = array('employee');
            $this->fields = array('code', 'century', 'social_security', 'first_name', 'last_name', 'gender', 'address', 
                'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status', 'date_inactive', 
                'max_hours', 'monthly_salary', 'start_day', 'remaining_sem_leave', 'sem_leave_todate', 'leave_in_advance', 
                'care_of', 'office_personal', 'substitute', 'salary_type', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days', 'ice', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length' , 'candg_follow');
            $this->field_values = array($this->code, $this->century, $this->social_security, $this->first_name, $this->last_name, $this->gender, $this->address, 
                $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->color_code, $this->status, $this->inactive_date, 
                ($this->max_hours != '' ? $this->max_hours : NULL), $this->monthly_salary, $this->start_day, $this->remaining_sem_leave, ($this->sem_leave_todate != '' ? $this->sem_leave_todate : NULL), ($this->leave_in_advance != '' ? $this->leave_in_advance : 0), 
                $this->care_of, ($this->office_personal != '' ? $this->office_personal : 0), $this->substitute, $this->salary_type, $this->sem_leave_days, $this->vab_leave_days, $this->fp_leave_days, $this->nopay_leave_days, $this->other_leave_days, $this->ice, $this->employee_contract_start_month, $this->employee_contract_month_start_date, $this->employee_contract_period_length,$this->candg_follow);
            if ($this->use_inconvenient !== NULL) {
                $this->fields[] = 'inconvenient_on';
                $this->field_values[] = $this->use_inconvenient;
            }

            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {
                $this->employee_inconviniant_time($this->username);
                $this->employee_salary($this->username);
                return TRUE;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    function get_employee_salary($username) {
        $this->tables = array('emp_salary');
        $this->fields = array('*');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($username);
        $this->order_by = array(" salaryId desc");
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function employee_salary($username) {
        //salary_per_hour
        $this->tables = array('emp_salary');
        $this->fields = array('*');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($username);
        $this->order_by = array(" salaryId desc");
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas) > 0) {
            $datas = $datas[0];
            /* check for any data update */

            if ($datas['salary_per_month'] != $this->salary_per_month || $datas['salary_per_hour'] != $this->salary_per_hour) {

                $this->tables = array('emp_salary');
                $this->fields = array('date_to');
                $this->field_values = array(date('Y-m-d'));
                $this->conditions = array('salaryId = ?');
                $this->condition_values = array($datas["salaryId"]);
                $this->query_update();

                $this->tables = array('emp_salary');
                $this->fields = array('emp_username', 'salary_per_month', 'salary_per_hour', 'date_from', 'added_by');
                $this->field_values = array($username, $this->salary_per_month, $this->salary_per_hour, date('Y-m-d'), $_SESSION['user_id']);
                return $this->query_insert() ? TRUE : FALSE;
            }
        } else {
            $this->tables = array('emp_salary');
            $this->fields = array('emp_username', 'salary_per_month', 'salary_per_hour', 'date_from', 'added_by');
            $this->field_values = array($username, $this->salary_per_month, $this->salary_per_hour, date('Y-m-d'), $_SESSION['user_id']);
            return $this->query_insert() ? TRUE : FALSE;
        }
    }

    function add_employee_salary($username) {
        //salary_per_hour
        $this->tables = array('emp_salary');
        $this->fields = array('*');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($username);
        $this->order_by = array("salaryId desc");
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas) > 0) {
            $datas = $datas[0];
            /* check for any data update */

            if ($datas['salary_per_month'] != $this->salary_per_month || $datas['salary_per_hour'] != $this->salary_per_hour) {

                $this->tables = array('emp_salary');
                $this->fields = array('date_to');
                $this->field_values = array(date('Y-m-d'));
                $this->conditions = array('salaryId = ?');
                $this->condition_values = array($datas["salaryId"]);
                $this->query_update();

                $this->tables = array('emp_salary');
                $this->fields = array('emp_username', 'salary_per_month', 'salary_per_hour', 'date_from', 'added_by');
                $this->field_values = array($username, $this->salary_per_month, $this->salary_per_hour, date('Y-m-d'), $_SESSION['user_id']);
                return $this->query_insert() ? TRUE : FALSE;
            }
        } else {
            $this->tables = array('emp_salary');
            $this->fields = array('emp_username', 'salary_per_month', 'salary_per_hour', 'date_from', 'added_by');
            $this->field_values = array($username, $this->salary_per_month, $this->salary_per_hour, date('Y-m-d'), $_SESSION['user_id']);
            return $this->query_insert() ? TRUE : FALSE;
        }
    }

    function employee_inconviniant_time($username) {
        global $db;
        $this->tables = array('emp_inconvinient_time');
        $this->fields = array('*');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($username);
        $this->order_by = array(" time_id desc");
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas) > 0) {
            $datas = $datas[0];
            /* check for any data update */

            if ($datas['on_call'] != $this->on_call || $datas['on_call_holiday'] != $this->oncall_holiday ||
                    $datas['on_call_bigholiday'] != $this->oncall_bigholiday || $datas['inconvinient_night'] != $this->inconvinient_night || $datas['inconvinient_evening'] != $this->inconvinient_evening || $datas['inconvinient_holiday'] != $this->inconvinient_holiday || $datas['inconvinient_week_holiday'] != $this->inconvinient_week_holiday) {

                $this->tables = array('emp_inconvinient_time');
                $this->fields = array('date_to');
                $this->field_values = array(date('Y-m-d'));
                $this->conditions = array('time_id = ?');
                $this->condition_values = array($datas["time_id"]);
                $this->query_update();

                $this->tables = array('emp_inconvinient_time');
                $this->fields = array('emp_username', 'on_call', 'on_call_holiday', 'on_call_bigholiday', 'inconvinient_night', 'inconvinient_evening', 'inconvinient_holiday', 'inconvinient_week_holiday', 'date_from', 'added_by');
                $this->field_values = array($username, $this->on_call, $this->oncall_holiday, $this->oncall_bigholiday, $this->inconvinient_night,
                    $this->inconvinient_evening, $this->inconvinient_holiday, $this->inconvinient_week_holiday, date('Y-m-d'), $_SESSION['user_id']);
                return $this->query_insert() ? TRUE : FALSE;
            }
        } else {
            $this->tables = array('emp_inconvinient_time');
            $this->fields = array('emp_username', 'on_call', 'on_call_holiday', 'on_call_bigholiday', 'inconvinient_night', 'inconvinient_evening', 'inconvinient_holiday', 'inconvinient_week_holiday', 'date_from', 'added_by');
            $this->field_values = array($username, $this->on_call, $this->oncall_holiday, $this->oncall_bigholiday, $this->inconvinient_night,
                $this->inconvinient_evening, $this->inconvinient_holiday, $this->inconvinient_week_holiday, date('Y-m-d'), $_SESSION['user_id']);

            return $this->query_insert() ? TRUE : FALSE;
        }
    }

    function company_update() {

        global $db;
        if ($this->company_id != NULL) {
            $this->tables = array($db['database_master'] . '.login');
            $this->fields = array('company_ids=CONCAT(`company_ids`,?)');
            $this->field_values = array($this->company_id . ',');
            $this->conditions = array('social_security = ? AND company_ids NOT LIKE ?');
            $this->condition_values = array($this->social_security, '%' . $this->company_id . ',%');
            return $this->query_update(1);
        } else 
            return FALSE;
    }

    function team_member_add() {

        if ($this->team_members != NULL) {
            $this->tables = array('team');
            $this->fields = array('members');
            $this->field_values = array($this->team_members);
            $this->conditions = array('id = ?');
            $this->condition_values = array($this->team_id);
            return $this->query_update() ? TRUE : FALSE;
        } else 
            return FALSE;
    }

    function team_member_update($members, $cur_team) {

        if ($this->username != NULL) {

            $this->tables = array('team');
            $this->fields = array('members');
            $this->field_values = array($members);
            $this->conditions = array('id = ?');
            $this->condition_values = array($cur_team);
            return $this->query_update() ? TRUE : FALSE;
        } else 
            return FALSE;
    }

    function tl_update($cur_team = NULL) {

        $this->tables = array('team');
        $this->fields = array('tl');
        if ($cur_team == NULL) {
            $this->field_values = array($this->tl);
            $this->conditions = array('id = ?');
            $this->condition_values = array($this->team_id);
        } else {

            $this->field_values = array("");
            $this->conditions = array('id = ?');
            $this->condition_values = array($cur_team);
        }
        return $this->query_update() ? TRUE : FALSE;
    }

    function get_week() {
        global $week;
        return$week;
    }

    function employee_detail($username = "") {

        $this->tables = array('employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status', 'date_inactive', 'ice');
        if ($this->first_name != NULL) {
            $this->conditions = array('AND', 'first_name LIKE ?');
            $this->condition_values = array($this->first_name . "%");
        } else {
            $this->conditions = array('AND', array('IN', 'username', $username));
        }
        $this->query_generate();

        $datas = $this->query_fetch();
        if (!empty($datas)) {
            $color = $datas[0]['color'];
            $rgb = $this->hex_to_rgb($color);
            $datas[0]['color'] = $rgb;
        }
       // $handle = fopen("check.txt", 'a');
       // fwrite($handle, $datas[0]['username'] . "---" . $datas[0]['status'] . "\n");
       // fclose($handle);
        return $datas;
    }

    function get_employee_detail($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color','date_inactive', 'ice', 'status', 'monthly_salary', 'start_day', 'remaining_sem_leave', 'sem_leave_todate', 'leave_in_advance', 'care_of', 'office_personal', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length', 'max_hours', 'email_verified', 'mobile_verified', 'picture');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (!empty($datas)) {
            $color = $datas[0]['color'];
            $rgb = $this->hex_to_rgb($color);
            $datas[0]['color'] = $rgb;
            return $datas[0];
        } else
            return array();
    }

    function get_employee_ALLdetail($username) {

        $this->tables = array('employee');
        $this->fields = array('*');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_incov_detail($username) {

        $this->tables = array("select * from emp_inconvinient_time 
						WHERE emp_username = '" . $username . "' order by time_id desc");
        $this->query_generate_leftjoin();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function employee_detail_main($username) {
        $this->tables = array('employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'gender', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status', 'date_inactive', 'max_hours', 'monthly_salary', 'start_day', 'remaining_sem_leave', 'sem_leave_todate', 'leave_in_advance', 'inconvenient_on', 'care_of', 'office_personal', 'substitute', 'salary_type', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days', 'ice', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length', 'candg_follow', 'picture');
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_available_works() {
        return array();
    }

    function get_assigned_works() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->conditions = array('AND', array('IN', 'id', $this->works));
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_available_team($current_team = NULL) {

        $this->tables = array('team');
        $this->fields = array('id', 'name', 'tl', 'members');
        if ($current_team != NULL) {
            $this->conditions = array('AND', array('NOT IN', 'id', $current_team));
            $this->query_generate();
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_name($username) {
        $employee_detail = $this->employee_detail($username);
        if(!empty($employee_detail)){
            if ($_SESSION['company_sort_by'] == 1)
                return $name = $employee_detail[0]['first_name'] . ' ' . $employee_detail[0]['last_name'];
            else/* if ($_SESSION['company_sort_by'] == 2)*/
                return $name = $employee_detail[0]['last_name'] . ' ' . $employee_detail[0]['first_name'];
        } else
            return '';
    }

    function get_selected_team_member($cur_team = NULL) {

        $this->tables = array('team');
        $this->fields = array('members');
        $this->conditions = array('id = ?');
        if ($cur_team != NULL) {
            $this->condition_values = array($cur_team);
        } else {
            $this->condition_values = array($this->team_id);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_current_team() {

        $this->tables = array('team');
        $this->fields = array('id', 'name', 'members', 'tl');
        if ($this->role == '3') {
            $this->conditions = array('members LIKE ?');
            $this->condition_values = array('%' . $this->username . '%');
        } else {
            $this->conditions = array('tl = ?');
            $this->condition_values = array($this->username);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_all_employee_leave($employee, $year = NULL, $month = NULL) {

        $this->tables = array('leave', 'employee');
        $this->fields = array('leave.id', 'leave.type', 'date(leave.apply_date) as apply_date', 'leave.employee',
            "concat(employee.first_name,' ',employee.last_name) as empname", 'leave.status', 'leave.appr_date', 'leave.appr_emp',
            "concat(employee.first_name,' ',employee.last_name) as appr_empname");
        if ($year != NULL && $month != NULL) {
            $this->conditions = array('AND', 'leave.employee = ?', 'year(leave.apply_date) = ?', 'month(leave.apply_date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee, $year, $month);
        } elseif ($year != NULL && $month == NULL) {
            $this->conditions = array('AND', 'leave.employee = ?', 'year(leave.apply_date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee, $year);
        } elseif ($year == NULL && $month != NULL) {
            $this->conditions = array('AND', 'leave.employee = ?', 'month(leave.apply_date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee, $month);
        } else {
            $this->conditions = array('leave.employee = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee);
        }
        $this->order_by = array('leave.date');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_leave_year($employee) {
        $this->tables = array('leave');
        $this->fields = array('year(apply_date) as year');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->group_by = array('year(apply_date)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /* ---------------------------------------------------shaju------------------------------------ */

    //removing employee from a particular slot
    function remove_from_slot($id, $alloc_emp = null) {
        $slot_det = $this->customer_employee_slot_details($id);
        $this->tables = array('timetable');
        if ($alloc_emp == null) {
            $this->fields = array('employee', 'status');
            $this->field_values = array(NULL, '0');
        } else {
            $this->fields = array('employee', 'status', 'alloc_emp');
            $this->field_values = array(NULL, '0', $alloc_emp);
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            if ($slot_det['employee'])
                $this->removeATL($slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['customer']);
            return true;
        } else {
            return false;
        }
    }

    //getting slots in memory
    function get_memory_slots($employee, $date, $customer = '') {

        //getting assigned slots
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', 'employee = ?', 'date = ?');
        $this->condition_values = array($employee, $date);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $assigned_slots = $this->query_fetch();

        //getting leave slots
        $this->tables = array('leave');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'status=?');
        $this->condition_values = array($employee, $date, '1');
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $leave_slots = $this->query_fetch();

        $cust_query = '';
        if ($customer == '') {

            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('employee = ?');
            $this->query_generate();
            $cust_query = $this->sql_query;
        }

        $this->tables = array('memory_slots');
        $this->fields = array('distinct time_from', 'time_to', 'id', 'type');
        if ($customer != '') {
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer);
        } else {
            if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
                $this->conditions = array('AND', array('IN', 'customer', $cust_query), array('IN', 'customer', $cust_query));
                $this->condition_values = array($employee, $_SESSION['user_id']);
            } else if ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5 || $_SESSION['user_role'] == 6) {
                $this->conditions = array('AND', array('IN', 'customer', $cust_query));
                $this->condition_values = array($employee);
            }
        }
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        $memory_slots = array();
        foreach ($datas as $free_slots) {
            $memory_flag = true;
            foreach ($assigned_slots as $occ_slots) {
                if (($free_slots['time_from'] >= $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to']) || ($free_slots['time_to'] > $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to'])) {
                    $memory_flag = false;
                }
            }
            if ($memory_flag) {
                foreach ($leave_slots as $occ_slots) {
                    if (($free_slots['time_from'] >= $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to']) || ($free_slots['time_to'] > $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to'])) {
                        $memory_flag = false;
                    }
                }
                if ($memory_flag) {
                    $memory_slots[] = array('id' => $free_slots['id'], 'time_from' => $free_slots['time_from'], 'time_to' => $free_slots['time_to'], 'type' => $free_slots['type']);
                }
            }
        }
        return $memory_slots;
    }
    
    //getting slots in memory
    function get_all_customer_memory_slots($customer) {

        $this->tables = array('memory_slots');
        $this->fields = array('time_from', 'time_to', 'id', 'type');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->group_by = array('time_from', 'time_to');
        $this->order_by = array('time_from', 'time_to', 'type');
        $this->query_generate();
        $memory_slots = $this->query_fetch();
        return $memory_slots;
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
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour', 'fulltime');
        $this->conditions = array('AND', 'employee = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($employee, $end_date, $employee, $start_date);
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch();
        return !empty($contract_data) ? $contract_data : FALSE;
    }

    function employee_timetable_week_time($employee, $year_week, $fkkn = NULL) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        //getting time for the week slot type include normal,travel,break
        $this->tables = array('timetable');
       // $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) AS total_time');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if ($fkkn == 1)
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,1,2,4,5,6,7,8,10'));
            elseif ($fkkn == 2)
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('OR', 'fkkn = 3', 'fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,1,2,4,5,6,7,8,10'));
            elseif ($fkkn == 3)
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('OR', 'fkkn = 2', 'fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,1,2,4,5,6,7,8,10'));
            $this->condition_values = array($employee, $date_from, $date_to, $fkkn);
        } else {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), array('IN', 'type', '0,1,2,4,5,6,7,8,10'));
            $this->condition_values = array($employee, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $normal_time = $time_data['total_time'];

        //getting time for the week sloat type oncall
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if ($fkkn == 1)
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '3,9,14'));
            elseif ($fkkn == 2)
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('OR', 'fkkn = 3', 'fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '3,9,14'));
            elseif ($fkkn == 3)
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('OR', 'fkkn = 2', 'fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '3,9,14'));
            $this->condition_values = array($employee, $date_from, $date_to, $fkkn);
        } else {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), array('IN', 'type', '3,9,14'));
            $this->condition_values = array($employee, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $oncall_time = 0;
        if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) {
            //$oncall_time = round(($time_data['total_time'] / 4), 2);
            $oncall_time = $time_data['total_time']; //edited by shaju full hour on oncall not 1/4th
        }
        $total_alloc_time = $normal_time + $oncall_time;
        return $total_alloc_time;
    }

    function employee_contract_week_hour($employee, $year_week, $return_global_contract = false, $customer = NULL) {
        // $return_global_contract returnes the weekly hour from the global settings of company

        $contract = new contract();
        $company = new company();
        $equipment = new equipment();
        $company_detail = $company->get_company_detail($_SESSION['company_id']);

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        $employee_contracts = $contract->get_employee_contract_records($employee, 'year_week', $year_week, $customer);
        // var_dump($employee, $start_date , $end_date, $employee_contracts);
        if (!empty($employee_contracts)) {

            //getting customer contacts
            $contract_hour_week = 0;
            $week_days = 7;
            $employee_contract_count = count($employee_contracts);
            if ($employee_contract_count == 1) {
                $contract_hour_day = $equipment->time_user_format($employee_contracts[0]['hour'], 100) / 7;

                if (strtotime($end_date) > strtotime($employee_contracts[0]['date_to']) && $employee_contracts[0]['date_to'] != '') {

                    $day_before = (((strtotime($employee_contracts[0]['date_to']) - strtotime($start_date)) / (24 * 60 * 60)) + 1);
                    $week_days -= $day_before;
                    $contract_hour_week += ($day_before * $contract_hour_day);

                    $new_hours_per_day = $company_detail['weekly_hour'] / 7;
                    $new_contract_working_days = $contract->get_working_days(date('Y-m-d', strtotime('+1 day', strtotime($employee_contracts[0]['date_to']))), $end_date);
                    $contract_hour_week += ($new_hours_per_day * $new_contract_working_days);
                } else if (strtotime($start_date) < strtotime($employee_contracts[0]['date_from'])) {
                    $contract_hour_week += ($week_days * $contract_hour_day);
                    $new_hours_per_day = $company_detail['weekly_hour'] / 7;
                    $new_contract_working_days = $contract->get_working_days($start_date, date('Y-m-d', strtotime('-1 day', strtotime($employee_contracts[0]['date_from']))));
                    $contract_hour_week += ($new_hours_per_day * $new_contract_working_days);
                } else {
                    $contract_hour_week = $contract_hour_day * $week_days;
                }
            } else {
                $contract_hour_week = 0.00;
                foreach ($employee_contracts as $employee_contract) {
                    $contract_hour_day = $equipment->time_user_format($employee_contract['hour'], 100) / 7;

                    $this_week_contract_from = $employee_contract['date_from'];
                    $this_week_contract_to = $employee_contract['date_to'];
                    if (date('Y|W', strtotime($this_week_contract_from)) != $year_week)
                        $this_week_contract_from = date('Y-m-d', strtotime($year . 'W' . $week_no . 1));
                    if ($this_week_contract_to == '' || date('Y|W', strtotime($this_week_contract_to)) != $year_week)
                        $this_week_contract_to = date('Y-m-d', strtotime($year . 'W' . $week_no . 7));

                    $working_days_in_this_contract = $contract->get_working_days($this_week_contract_from, $this_week_contract_to);
                    $contract_hour_week += $contract_hour_day * $working_days_in_this_contract;
                    $contract_hour_day * $working_days_in_this_contract;
                }
            }
             $contract_hour_week = $equipment->time_user_format($contract_hour_week, 60);
            return sprintf('%.02f', round($contract_hour_week, 2));
        } else {
            if($customer !== NULL){
                $employee_contracts = $contract->get_employee_contract_records($employee, 'year_week', $year_week);

                if(!empty($employee_contracts)){
                    //getting customer contacts
                    $contract_hour_week = 0;
                    $week_days = 7;
                    $employee_contract_count = count($employee_contracts);
                    if ($employee_contract_count == 1) {
                        $contract_hour_day = $equipment->time_user_format($employee_contracts[0]['hour'], 100) / 7;

                        if (strtotime($end_date) > strtotime($employee_contracts[0]['date_to']) && $employee_contracts[0]['date_to'] != '') {

                            $day_before = (((strtotime($employee_contracts[0]['date_to']) - strtotime($start_date)) / (24 * 60 * 60)) + 1);
                            $week_days -= $day_before;
                            $contract_hour_week += ($day_before * $contract_hour_day);

                            $new_hours_per_day = $company_detail['weekly_hour'] / 7;
                            $new_contract_working_days = $contract->get_working_days(date('Y-m-d', strtotime('+1 day', strtotime($employee_contracts[0]['date_to']))), $end_date);
                            $contract_hour_week += ($new_hours_per_day * $new_contract_working_days);
                        } else if (strtotime($start_date) < strtotime($employee_contracts[0]['date_from'])) {
                            $contract_hour_week += ($week_days * $contract_hour_day);
                            $new_hours_per_day = $company_detail['weekly_hour'] / 7;
                            $new_contract_working_days = $contract->get_working_days($start_date, date('Y-m-d', strtotime('-1 day', strtotime($employee_contracts[0]['date_from']))));
                            $contract_hour_week += ($new_hours_per_day * $new_contract_working_days);
                        } else {
                            $contract_hour_week = $contract_hour_day * $week_days;
                        }
                    } else {
                        $contract_hour_week = 0.00;
                        foreach ($employee_contracts as $employee_contract) {
                            $contract_hour_day = $equipment->time_user_format($employee_contract['hour'], 100) / 7;

                            $this_week_contract_from = $employee_contract['date_from'];
                            $this_week_contract_to = $employee_contract['date_to'];
                            if (date('Y|W', strtotime($this_week_contract_from)) != $year_week)
                                $this_week_contract_from = date('Y-m-d', strtotime($year . 'W' . $week_no . 1));
                            if ($this_week_contract_to == '' || date('Y|W', strtotime($this_week_contract_to)) != $year_week)
                                $this_week_contract_to = date('Y-m-d', strtotime($year . 'W' . $week_no . 7));

                            $working_days_in_this_contract = $contract->get_working_days($this_week_contract_from, $this_week_contract_to);
                            $contract_hour_week += $contract_hour_day * $working_days_in_this_contract;
                        }
                    }
                    $contract_hour_week = 40 - ($equipment->time_user_format($contract_hour_week, 60));
                    return ($contract_hour_week > 0 ? sprintf('%.02f', round($contract_hour_week, 2)) : 0);
                }
                else if ($return_global_contract)
                    return $company_detail['weekly_hour'];
                else
                    return 0; //FALSE;
            }
            else if ($return_global_contract) {
                return $company_detail['weekly_hour'];
            }
            else
                return 0; //FALSE;
        }
    }

    function employee_contract_monthly_normal_hour($employee, $year_month, $return_global_contract = FALSE, $company_detail = array(), $employee_contracts = array()) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting employee monthly normal contract hours
         * @param: $return_global_contract returnes the monthly oncall hour from the global settings of company
         */
        $contract = new contract();

        if(empty($company_detail)){
            $company = new company();
            $company_detail = $company->get_company_detail($_SESSION['company_id']);
        }

        $month_data = explode('|', $year_month);
        $year = $month_data[0];
        $month_no = sprintf("%02d", $month_data[1]);

        $start_date = date("Y-m-01", strtotime($year . '-' . $month_no . '-01'));
        $end_date = date("Y-m-t", strtotime($start_date));

        $global_monthly_nomal_in_day = 0.00;
        if ($return_global_contract)
            $global_monthly_nomal_in_day = $company_detail['weekly_hour'] / 7;

        if(empty($employee_contracts))
            $employee_contracts = $contract->get_employee_contract_records($employee, 'year_month', $year_month);

        if (!empty($employee_contracts)) {
            $contract_normal_hour_month = 0;

            $processing_this_start = $start_date;
            foreach ($employee_contracts as $employee_contract) {
                if (strtotime($processing_this_start) < strtotime($employee_contract['date_from']) && $return_global_contract) {
                    $day_before = date('Y-m-d', strtotime('-1 day', strtotime($employee_contract['date_from'])));
                    $this_period_working_days = $contract->get_working_days($processing_this_start, $day_before);
                    $contract_normal_hour_month += $this_period_working_days * $global_monthly_nomal_in_day;
                }

                $this_month_contract_from = $employee_contract['date_from'];
                $this_month_contract_to = $employee_contract['date_to'];
                if (date('Y|m', strtotime($this_month_contract_from)) != $year_month)
                    $this_month_contract_from = $start_date;
                if ($this_month_contract_to == '' || date('Y|m', strtotime($this_month_contract_to)) != $year_month)
                    $this_month_contract_to = $end_date;
                $working_days_in_this_contract = $contract->get_working_days($this_month_contract_from, $this_month_contract_to);
                $this_contract_nomal_in_day = $employee_contract['hour'] / 7;
                $contract_normal_hour_month += $working_days_in_this_contract * $this_contract_nomal_in_day;

                $processing_this_start = $this_month_contract_to;
            }

            if ($processing_this_start != $end_date && $return_global_contract) {
                $the_last_contract = $employee_contracts[count($employee_contracts) - 1];
                $day_after_last_contract = date('Y-m-d', strtotime('+1 day', strtotime($the_last_contract['date_to'])));
                $this_period_working_days = $contract->get_working_days($day_after_last_contract, $end_date);
                $contract_normal_hour_month += $this_period_working_days * $global_monthly_nomal_in_day;
            }

            return round($contract_normal_hour_month, 2);
        } else {
            if ($return_global_contract) {
                $working_days_in_this_month = $contract->get_working_days($start_date, $end_date);
                return round($working_days_in_this_month * $global_monthly_nomal_in_day, 2);
            }
            else
                return 0.00;
        }
    }

    function employee_contract_oncall_monthly_hour($employee, $year_month, $return_global_contract = FALSE, $company_detail = array(), $employee_contracts = array()) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting employee monthly oncall contract hours
         * @param: $return_global_contract returnes the monthly oncall hour from the global settings of company
         */
        $contract = new contract();

        if(empty($company_detail)){
            $company = new company();
            $company_detail = $company->get_company_detail($_SESSION['company_id']);
        }

        $month_data = explode('|', $year_month);
        $year = $month_data[0];
        $month_no = sprintf("%02d", $month_data[1]);

        $start_date = date("Y-m-01", strtotime($year . '-' . $month_no . '-01'));
        $end_date = date("Y-m-t", strtotime($start_date));

        if(empty($employee_contracts))
            $employee_contracts = $contract->get_employee_contract_records($employee, 'year_month', $year_month);

        if (!empty($employee_contracts)) {
            $working_days_in_this_contract = $contract->get_working_days($start_date, $end_date);

            $contract_oncall_hour_month = 0;
            $global_monthly_oncall_in_day = 0.00;
            if ($return_global_contract) {
                $global_monthly_oncall_in_day = ($working_days_in_this_contract != 0 ? ($company_detail['monthly_oncall_hour'] / $working_days_in_this_contract) : 0);
            }
            $processing_this_start = $start_date;
            foreach ($employee_contracts as $employee_contract) {
//                if($employee_contract['monthly_oncall_hour'] == '') $employee_contract['monthly_oncall_hour'] = 0.00;
                if (strtotime($processing_this_start) < strtotime($employee_contract['date_from']) && $return_global_contract) {
                    $day_before = date('Y-m-d', strtotime('-1 day', strtotime($employee_contract['date_from'])));
                    $this_period_working_days = $contract->get_working_days($processing_this_start, $day_before);
                    $contract_oncall_hour_month += $this_period_working_days * $global_monthly_oncall_in_day;
                }

                $this_month_contract_from = $employee_contract['date_from'];
                $this_month_contract_to = $employee_contract['date_to'];
                if (date('Y|m', strtotime($this_month_contract_from)) != $year_month)
                    $this_month_contract_from = $start_date;
                if ($this_month_contract_to == '' || date('Y|m', strtotime($this_month_contract_to)) != $year_month)
                    $this_month_contract_to = $end_date;

                $working_days_in_this_contract = $contract->get_working_days($this_month_contract_from, $this_month_contract_to);
                $this_contract_oncall_in_day = ($working_days_in_this_contract != 0 ? ($employee_contract['monthly_oncall_hour'] / $working_days_in_this_contract) : 0);
                $contract_oncall_hour_month += $working_days_in_this_contract * $this_contract_oncall_in_day;

                $processing_this_start = $this_month_contract_to;
            }

            if ($processing_this_start != $end_date && $return_global_contract) {
                $the_last_contract = $employee_contracts[count($employee_contracts) - 1];
                $day_after_last_contract = date('Y-m-d', strtotime('+1 day', strtotime($the_last_contract['date_to'])));
                $this_period_working_days = $contract->get_working_days($day_after_last_contract, $end_date);
                $contract_oncall_hour_month += $this_period_working_days * $global_monthly_oncall_in_day;
            }

            return round($contract_oncall_hour_month, 2);
        } else {
            return ($return_global_contract) ? $company_detail['monthly_oncall_hour'] : FALSE;
        }
    }

    function get_available_users($customer, $time_from, $time_to, $date, $possible_employee = NULL, $except_id = NULL) {
        /**
         * last edited by: Shamsu
         * last edited date: 2014-06-12
         * for: if $possible_employee != NULL then check this employee is available for this slot..
         * edited by : sreerag 2018-12-5
         * for : getting available employees without overlapping to non-preferred-time too.
         */
        $days      = [7,1,2,3,4,5,6]; // 7-sunday ... 1-monday table day number.
        $timestamp = strtotime($date);
        $day       = date('w', $timestamp);

        if ($customer == '' || $customer == NULL)
            $customer = NULL;
        if ($_SESSION['company_sort_by'] == 1)
            $order_by = 'ORDER BY LOWER(e.first_name),LOWER(e.last_name)';
        elseif ($_SESSION['company_sort_by'] == 2)
            $order_by = 'ORDER BY LOWER(e.last_name),LOWER(e.first_name)';
        $cur_date = strtotime($date . ' 00:00:00');
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        $tl_customer_role = $_SESSION['user_role'];
        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $this->tables = array('team');
            $this->fields = array('role');
            $this->conditions = array('AND', 'customer = ?', 'employee = ?');
            $this->condition_values = array($customer, $_SESSION['user_id']);
            $this->query_generate();
            $data = $this->query_fetch();
            if(!empty($data))
                $tl_customer_role = $data[0]['role'];
        }
        if ($_SESSION['user_role'] == 3 || $tl_customer_role == 3) {
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile, e.substitute FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer' AND tm.employee='" . $_SESSION['user_id'] . "'
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.customer ='$customer' 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND ". ($except_id != NULL ? "t.id != $except_id" : '1'). "
                            LEFT JOIN `employee_non_preferred_timings` as enpt ON enpt.employee like e.username AND ('$date' BETWEEN enpt.`date_from` AND enpt.`date_to`) AND  enpt.`day`= ".$days[$day]." AND (" .(float) $time_from. " < enpt.`time_to` AND " .(float) $time_to. " > enpt.`time_from`) AND enpt.`mode` = 0 

                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL AND enpt.employee IS NULL";
        } else if ($customer == NULL && $possible_employee != NULL) {   // by shamsu
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile, e.substitute FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.employee='" . $possible_employee . "'
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND ". ($except_id != NULL ? "t.id != $except_id" : '1'). " 
                            LEFT JOIN `employee_non_preferred_timings` as enpt ON enpt.employee like e.username AND ('$date' BETWEEN enpt.`date_from` AND enpt.`date_to`) AND  enpt.`day`= ".$days[$day]." AND (" .(float) $time_from. " < enpt.`time_to` AND " .(float) $time_to. " > enpt.`time_from`) AND enpt.`mode` = 0 

                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL AND enpt.employee IS NULL";
        } else if ($possible_employee != NULL) {   // by shamsu
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile, e.substitute FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer' AND tm.employee='" . $possible_employee . "'
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.customer ='$customer' 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND ". ($except_id != NULL ? "t.id != $except_id" : '1'). " 
                            LEFT JOIN `employee_non_preferred_timings` as enpt ON enpt.employee like e.username AND ('$date' BETWEEN enpt.`date_from` AND enpt.`date_to`) AND  enpt.`day`= ".$days[$day]." AND (" .(float) $time_from. " < enpt.`time_to` AND " .(float) $time_to. " > enpt.`time_from`) AND enpt.`mode` = 0 

                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL AND enpt.employee IS NULL";
        } else if ($customer == NULL) {
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile, e.substitute FROM `employee` as `e` 
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND ". ($except_id != NULL ? "t.id != $except_id" : '1'). " 
                            LEFT JOIN `employee_non_preferred_timings` as enpt ON enpt.employee like e.username AND ('$date' BETWEEN enpt.`date_from` AND enpt.`date_to`) AND  enpt.`day`= ".$days[$day]." AND (" .(float) $time_from. " < enpt.`time_to` AND " .(float) $time_to. " > enpt.`time_from`) AND enpt.`mode` = 0 

                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL AND enpt.employee IS NULL";
        } else {
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile, e.substitute FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer'
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.customer ='$customer' 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND ". ($except_id != NULL ? "t.id != $except_id" : '1'). " 
                            LEFT JOIN `employee_non_preferred_timings` as enpt ON enpt.employee like e.username AND ('$date' BETWEEN enpt.`date_from` AND enpt.`date_to`) AND  enpt.`day`= ".$days[$day]." AND (" .(float) $time_from. " < enpt.`time_to` AND " .(float) $time_to. " > enpt.`time_from`) AND enpt.`mode` = 0 

                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL AND enpt.employee IS NULL";
        }
        
        $this->sql_query .= ' '. $order_by;

        $datas = $this->query_fetch();

        $employees = array();
        foreach ($datas as $data) {
            $contract_hour = $this->employee_contract_week_hour($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $worked_hour = $this->employee_timetable_week_time($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $employees[] = array('username' => $data['username'], 
                'name' => $data['last_name'] . ' ' . $data['first_name'], 
                'name_ff' => $data['first_name'] . ' ' . $data['last_name'], 
                'ordered_name' => $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . ' ' . $data['last_name'] : $data['last_name'] . ' ' . $data['first_name'], 
                'code' => $data['code'], 
                'contract_hour' => $contract_hour, 
                'worked_hour' => $worked_hour, 
                'substitute' => $data['substitute'], 
                'mobile' => $data['mobile']);
        }

        return count($employees) ? $employees : array();
    }

    //using in ajax_leave_sms.php
    function get_sms_processed_users($id) {
        $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile FROM `employee` as `e` 
                            INNER JOIN `leave_sms` as `tm` ON tm.employee like e.username AND tm.slot='$id'";
        $datas = $this->query_fetch();
        $employees = array();
        foreach ($datas as $data) {
            $employees[] = array('username' => $data['username'], 'name' => $data['last_name'] . ' ' . $data['first_name'], 'name_ff' => $data['first_name'] . ' ' . $data['name_name'], 'code' => $data['code'], 'contract_hour' => 0, 'worked_hour' => 0, 'mobile' => $data['mobile']);
        }
        return count($employees) ? $employees : array();
    }

    //get unavailable users
    function get_unavailable_users($customer, $time_from, $time_to, $date) {

        return array();
        //"select username,first_name,last_name,code from employees where work like('$skill') and username not in";
        //"select employee from timetable where date='$date' and (time_from >=(float)$time_from  t and time_from < (float)$time_to) or (time_to > (float)$time_from and time_to <=(float)$time_to) (time_from<(float)$time_from and time_to>(float)$time_to)";
    }

    //checking a slot timing is valid for the user
    function is_valid_slot($employee, $time_from, $time_to, $date, $for_leave_cancel = FALSE) {     //$for_leave_cancel is only for leave cancel module
        if ($employee != '') {
            $this->tables = array('timetable');
            $this->fields = array('id');
            if ($for_leave_cancel)
                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', 'status != 2');
            else        //default condition
                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?');
            $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
            $this->query_generate();
            $datas = $this->query_fetch();

            $this->sql_query    = "SELECT `id` from `employee_non_preferred_timings` WHERE ('$date' BETWEEN `date_from` AND `date_to`) AND  `employee`='".$employee."' AND `day`= ".date('N', strtotime($date))." AND (" .(float) $time_from. " < `time_to` AND " .(float) $time_to. " > `time_from`)  AND enpt.`mode` = 0 ";
            $non_preferred_data = $this->query_fetch();  

            if (count($datas)) {
                return FALSE;
            }elseif (count($non_preferred_data)) {
                return FALSE;
            }elseif ($for_leave_cancel) {
                return TRUE;
            } else {
                $this->tables = array('leave');
                $this->fields = array('id');
                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('IN', 'status', '0,1'));
                $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
                $this->query_generate();
                $datas = $this->query_fetch();
                if (count($datas)) {
                    return FALSE;
                } else {
                    /* $this->tables = array('report_signing');
                      $this->fields = array('id');
                      $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
                      $this->condition_values = array($employee, substr($date, 5,2), substr($date, 0,4));
                      $this->query_generate();
                      $signin_data = $this->query_fetch();
                      if (!empty($signin_data)) {
                      return false;
                      }else{
                      return true;
                      } */
                    return TRUE;
                }
            }
        } else {
            return TRUE;
        }
        //"select id from timetable where  (time_from >=(float)$time_from   and time_from < (float)$time_to) or (time_to > (float)$time_from and time_to <=(float)$time_to) (time_from<(float)$time_from and time_to>(float)$time_to) and date=$date and employee";
    }

    // getting the details of a slot
    function customer_employee_slot_details($id) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'created_status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    //adding skill
    function employee_add_skill($id, $work, $alloc_emp) {

        $slot_det = $this->customer_employee_slot_details($id);
        $status = 1;
        if ($slot_det['customer'] == '' || $slot_det['employee'] == '')
            $status = 0;
        $this->tables = array('timetable');
        $this->fields = array('work', 'status', 'alloc_emp');
        $this->field_values = array($work, $status, $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update() ? TRUE : FALSE;
    }

    //add employee to an existing slot
    function employee_add_to_slot($id, $select_emp, $alloc_emp, $comment = null) {
//        $msg = new message();
        $slot_det = $this->customer_employee_slot_details($id);
        $status = $slot_det['status'];

        /* $fkkn = 1;
          if($select_emp != ''){
          $emp_detail = $this->get_employee_detail($select_emp);
          if(!empty($emp_detail)){
          $fkkn = $emp_detail['fkkn'];
          }
          } */

        if ($status != 3 && $slot_det['customer'] != '')
            $status = 1;

        //$atl_status = $this->checkATL($select_emp, $slot_det['date'], $slot_det['time_from'], $slot_det['time_to']);
        //if($atl_status === TRUE || $_SESSION['user_role'] == 1){    
        $this->tables = array('timetable');
        if ($comment == null) {
            $this->fields = array('status', 'employee', 'alloc_emp');
            $this->field_values = array($status, $select_emp, $alloc_emp);
        } else {
            $this->fields = array('status', 'employee', 'alloc_emp', 'comment');
            $this->field_values = array($status, $select_emp, $alloc_emp, $comment);
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update() ? TRUE : FALSE;
        //}
        //return false;
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

    function employee_data($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'century', 'social_security', 'post', 'city', 'phone', 'address', 'color');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function company_data() {

        $id = $_SESSION['company_id'];
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('name', 'address', 'zipcode', 'city', 'org_no', 'phone', 'logo');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function employee_privilege() {

        $user = new user();
        $customer = new customer();
        $privileges = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $customers = $customer->customer_list();
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
                $team_customers = $customer->team_customers($login_user);
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
                $team_customers = $customer->team_employee_customers($login_user);
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

            case 7:
                $team_customers = $customer->team_customers($login_user);
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

            default:
                $team_customers = $customer->team_employee_customers($login_user);
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
        }
        return $privileges;
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

    /* -----------------------------------------shaju----------------------------------- */

    function employee_to_allocate($year_week, $user = '') {

        
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        $monthly_key = 0;
        if (date('m', strtotime($start_date)) == date('m', strtotime($end_date))) {
            $monthly_key = 1;
            $cur_date_Ym = date('Y|m', strtotime($start_date));
        }
        //getting all customers
        $employees = array();
        if ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6)
            $employees = $this->employee_list_exact($user);
        else
            $employees = $this->employee_list();
        
        
        $employee_pending = array();

        foreach ($employees as $employee) {

            //getting employee contacts
            $contract_hour_week = $this->employee_contract_week_hour($employee['username'], $year_week);
            //getting customer allocated time
            $timetable_hour_week = $this->employee_timetable_week_time($employee['username'], $year_week);
            //if ($contract_hour_week > $timetable_hour_week) {
            $monthly = 0;
            if ($monthly_key == 1) {
                $monthly = round($this->employee_total_work_hours($employee['username'], 'year_month', $cur_date_Ym, 0), 2);
            }
            if ($_SESSION['company_sort_by'] == 1)
                $emp_name = $employee['first_name'] . ' ' . $employee['last_name'];
            elseif ($_SESSION['company_sort_by'] == 2)
                $emp_name = $employee['last_name'] . ' ' . $employee['first_name'];
            $employee_pending[] = array('username' => $employee['username'], 'code' => $employee['code'], 'name' => $emp_name, 'allocate' => $contract_hour_week, 'allocated' => $timetable_hour_week, 'monthly_hour' => $monthly);
            //}
        }

        return !empty($employee_pending) ? $employee_pending : FALSE;
    }

    function leave_employee_week($year_week) {

        global $leave_type;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        $team_employee_data = '';

        if ($_SESSION['user_role'] == 2) {
            $team_members = $this->team_members_for_employee_report($_SESSION['user_id']);
            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
        } else if ($_SESSION['user_role'] == 7) {
            $team_members = $this->super_team_members($_SESSION['user_id']);
            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
        } else if ($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5) {
            $team_employee_data = '\'' . $_SESSION['user_id'] . '\'';
        }

        $this->tables = array('leave', 'employee');
        $this->fields = array('leave.id AS id', 'leave.employee AS employee', 'employee.first_name AS first_name', 'employee.last_name AS last_name', 'employee.code AS code', 'MIN(leave.date) AS date_from', 'MAX(leave.date) AS date_to', 'leave.type AS type', 'leave.comment AS comment');
        if ($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6)
            $this->conditions = array('AND', 'leave.employee = employee.username', 'leave.status = 1', 'leave.date >= ?', 'leave.date <= ?', array('IN', 'leave.employee', $team_employee_data));
        else
            $this->conditions = array('AND', 'leave.employee = employee.username', 'leave.status = 1', 'leave.date >= ?', 'leave.date <= ?');
        $this->condition_values = array($start_date, $end_date);
        $this->group_by = array('group_id');
        $this->query_generate();
        $datas = $this->query_fetch();
        $leave_datas = array();
        foreach ($datas as $data) {

            if ($data['date_from'] == $data['date_to']) {
                $date = $data['date_from'];
            } else {
                $date = $data['date_from'] . '-' . $data['date_to'];
            }
            if ($_SESSION['company_sort_by'] == 1)
                $name = $data['first_name'] . " " . $data['last_name'];
            elseif ($_SESSION['company_sort_by'] == 2)
                $name = $data['last_name'] . " " . $data['first_name'];
            $leave_datas[] = array('id' => $data['id'], 'employee' => $data['employee'], 'name' => $name, 'code' => $data['code'], 'type' => $leave_type[$data['type']], 'date' => $date, 'comment' => $data['comment']);
        }
        return $leave_datas;
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

    function timetable_customer_employee_time($customer_username, $employee_username, $date, $carry_fwd = 0) {

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time', 'time_to');
        $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', 'status = 1');
        $this->condition_values = array($customer_username, $employee_username, $date);
        $this->group_by = array('employee');
        $this->query_generate();
        $data_time_tmp = $this->query_fetch();
        $time_data = $data_time_tmp[0];
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

    function timetable_week($customers, $employees, $year_week) {

        global $week;
        // $employee = new employee();
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
                        $day_array = array();
                        //cheking the relation between customer and employee
                        $this->tables = array('team');
                        $this->fields = array('role');
                        $this->conditions = array('AND', 'employee = ?', 'customer = ?');
                        $this->condition_values = array($employee['username'], $customer['username']);
                        $this->query_generate();
                        $data = $this->query_fetch();
                        if (!empty($data)) {

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
                               // $flag_sign = $this->chk_employee_rpt_signed($employee['username'], $date);
                                $flag_sign = $this->chk_employee_rpt_signed($employee['username'], $customer['username'], $date);

                                $day_array[] = array('day' => $day['label'], 'date' => $date, 'time' => $total_time, 'leave' => $leave, 'signed' => $flag_sign);
                            }
                        }
                        $datas[$i][$j]['week'] = $day_array;
                        $j++;
                    }
                }
                $i++;
            }
            return $datas;
        } else 
            return FALSE;
    }

    function employee_week_customer($employee, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->sql_query = "SELECT distinct c.username, c.code, c.first_name, c.last_name FROM customer c 
                            INNER JOIN timetable t ON t.customer like c.username AND t.employee = '$employee' AND t.date >= '$start_date' AND t.date <= '$end_date' AND t.status = 1 
                            AND c.status = 1";
        $datas = $this->query_fetch();
        return $datas;
    }

    function customer_week_employee($customer, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->sql_query = "SELECT distinct e.username, e.code, e.first_name, e.last_name FROM employee e 
                            INNER JOIN timetable t ON t.employee like e.username AND t.customer = '$customer' AND t.date >= '$start_date' AND t.date <= '$end_date' AND t.status = 1 
                            AND e.status = 1";
        $datas = $this->query_fetch();
        return $datas;
    }

    function timetable_customer_employee_slots($customer = '', $employee = '', $date = '') {
        $smarty = new smartySetup(array('messages.xml'),FALSE);
        $tl_customers = array();
        $tl_employees = array();
        $tl_all_customers = array();
        $temp_privilege = $this->get_privileges($_SESSION['user_id'], 1, $customer);

        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $temp_tl_employees = $this->employees_list_for_right_click($_SESSION['user_id']);
            $temp_tl_customers = $this->customers_list_for_right_click($_SESSION['user_id']);
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

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'created_status', 'type', 'fkkn', 'alloc_emp', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            $this->conditions = array('AND', 'customer = ?', 'date = ?');
            $this->condition_values = array($customer, $date);
        } else if ($customer == '' && $employee != '') {
            $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2,3,4'));
            $this->condition_values = array($employee, $date);
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2,3,4'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        foreach ($slots as $slot) {
            $signed_in = 0;
            $show_details = 1;
            if ($slot['employee'] && $slot['customer']) {
                $signed_in = $this->chk_employee_rpt_signed($slot['employee'], $slot['customer'], $slot['date']);
            }
            if ($_SESSION['company_sort_by'] == 1) {
                $slot_customer = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
            } else {
                $slot_customer = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
            }
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
                   // $slot_customer = $smarty->translate['works_on_another_customer'];
                }
            } elseif ($_SESSION['user_role'] == 4 && $slot['customer'] != $_SESSION['user_id']) {
                $tl_flag = 0;
               // $slot_customer = $smarty->translate['works_on_another_customer'];
            }

            if ($customer == '' && $slot['customer'] != '')
                $temp_privilege = $this->get_privileges($_SESSION['user_id'], 1, $slot['customer']);

            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => $slot['time_from'], 'slot_to' => $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot_customer, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'], 'signed_in' => $signed_in, 'tl_flag' => $tl_flag, 'show_details' => $show_details, 'privileges_gd' => $temp_privilege, 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment']);
        }
        return $datas;
    }

    function timetable_customer_employee_slots_copiable($customer = '', $employee = '', $date = '') {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($customer, $date);
        } else if ($customer == '' && $employee != '') {
            $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($employee, $date);
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        foreach ($slots as $slot) {

            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp'], 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment']);
        }
        return $datas;
    }

    function timetable_customer_employee_slots_copiable_for_copy($customer, $date, $employee = NULL) {

        if ($customer == '') $customer = NULL;
        if ($employee == '') $employee = NULL;
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('AND', 'date = ?', array('IN', 'status', '1'));
        $this->condition_values = array($date);
        if ($customer != NULL) {
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        }
        if ($employee != NULL) {
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $employee;
        }
        if ($employee == NULL && $customer == NULL) {
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = '';
        }
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $slots = $this->query_fetch();

        $datas = array();
        foreach ($slots as $slot) {
            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp'], 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment']);
        }
        return $datas;
    }

    function timetable_customer_employee_slots_copiable_with_options($customer = '', $employee = '', $date = '', $with_user) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            if ($with_user == 1) {
                $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '1'));
                $this->condition_values = array($customer, $date);
            } else {
                $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '0,1'));
                $this->condition_values = array($customer, $date);
            }
        } else if ($customer == '' && $employee != '') {
            if ($with_user == 1) {
                $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
                $this->condition_values = array($employee, $date);
            } else {
                $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '1'));
                $this->condition_values = array($employee, $date);
            }
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();

        $datas = array();
        foreach ($slots as $slot) {
            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp'], 'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment']);
        }
        return $datas;
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
                        //checking for the signined flag
                        $date_array = explode('-', $date);
                        $date_month = $date_array[1];
                        $date_year = $date_array[0];
                        $employee_username = $employee['username'];
                        $this->tables = array('report_signing');
                        $this->fields = array('id');
                        $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
                        $this->condition_values = array($employee_username, $date_month, $date_year);
                        $this->query_generate();
                        $signin_data = $this->query_fetch();
                        $signin_flag = 0;
                        if (!empty($signin_data)) {
                            $signin_flag = 1;
                        }
                        $datas[$i][$j]['signed'] = $signin_flag;
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

    function customer_employee_slot_remove($id, $is_multiple_slots = FALSE) {
        $this->tables = array('timetable');
        if ($is_multiple_slots) {
            if (is_array($id))
                $id_string = '\'' . implode('\', \'', $id) . '\'';
            else
                $id_string = '\'' . $id . '\'';
            $this->conditions = array('IN', 'id', $id_string);
        }else {
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
        }
        return $this->query_delete() ? TRUE : FALSE;
    }

    /*     * ************************** NIYAZ **************************************** */

    function get_total_normal($normal) {
        $total = '0.00';
        for ($i = 0; $i < count($normal); $i++) {
            $total = $this->time_sum($total, $normal[$i]['normal']);
        }
        return $total;
    }

    function get_total_inconvinient($inconvenient, $count) {

        $count1 = count($inconvenient);
        for ($i = 0; $i < $count1; $i++) {
            $total = 0.0;
            for ($j = 0; $j < $count; $j++) {
                $total = $this->time_sum($total, $inconvenient[$i]['work'][$j]['inconvenient']);
            }
            $inconvenient[$i]['total'] = $total;
        }
        return $inconvenient;
    }

    function get_holiday_total($holiday, $work_ids) {
        $big_red[0] = array('name' => 'Holiday Big', 'total' => '0.0');
        $big_red[1] = array('name' => 'Holiday Red', 'total' => '0.0');
        $big_red[2] = array('name' => 'Inconvenient Big', 'total' => '0.0');
        $big_red[3] = array('name' => 'Inconvenient Red', 'total' => '0.0');
        $count1 = count($holiday);
        $count2 = count($work_ids);
        $total = '0.0';
        $total1 = '0.0';
        $val = 0;
        foreach ($big_red as $big) {
            $i = 0;
            foreach ($work_ids as $work_id) {
                $arr[$i] = array('work_id' => $work_id['id'], 'value' => '0.0');
                $i++;
            }
            $big_red[$val]['work'] = $arr;
            $val++;
        }
        for ($i = 0; $i < $count1; $i++) {

            for ($j = 0; $j < $count2; $j++) {

                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[0]['work'][$j]['work_id'])
                    ; {
                    $big_red[0]['work'][$j]['value'] = $this->time_sum($big_red[0]['work'][$j]['value'], $holiday[$i]['work'][$j]['holiday_big']);
                }

                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[1]['work'][$j]['work_id'])
                    ; {
                    $big_red[1]['work'][$j]['value'] = $this->time_sum($big_red[1]['work'][$j]['value'], $holiday[$i]['work'][$j]['holiday_red']);
                }
                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[2]['work'][$j]['work_id'])
                    ; {
                    $big_red[2]['work'][$j]['value'] = $this->time_sum($big_red[2]['work'][$j]['value'], $holiday[$i]['work'][$j]['inconvenient_big']);
                }
                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[3]['work'][$j]['work_id'])
                    ; {
                    $big_red[3]['work'][$j]['value'] = $this->time_sum($big_red[3]['work'][$j]['value'], $holiday[$i]['work'][$j]['inconvenient_big']);
                }
            }
        }
        $count3 = count($big_red);
        for ($i = 0; $i < $count3; $i++) {

            for ($j = 0; $j < $count2; $j++) {
                $total = $this->time_sum($total, $big_red[$i]['work'][$j]['value']);
            }
            $big_red[$i]['total'] = $total;
            $total = '0.0';
        }
        // $big_red[0] = array('name' => 'Holiday Red' , 'value' = );
        return $big_red;
    }

    function check_condition_holiday($work_from, $work_to, $holiday_from, $holiday_to, $inconv_days = null, $work_day = null) {
        if ($work_day != null) {
            $i_day = explode(",", $inconv_days);
            if (!in_array($work_day, $i_day))
                return 5;
        }

        if ($this->convert_time_part($work_from) <= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) >= $this->convert_time_part($holiday_to))
            return 1;
        else if ($this->convert_time_part($work_from) <= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) <= $this->convert_time_part($holiday_to) && ($this->convert_time_part($holiday_from) < $this->convert_time_part($work_to)))
            return 2;
        else if ($this->convert_time_part($work_from) >= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) >= $this->convert_time_part($holiday_to) && !($this->convert_time_part($work_from) > $this->convert_time_part($holiday_to)))
            return 3;
        else if ($this->convert_time_part($work_from) >= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) <= $this->convert_time_part($holiday_to))
            return 4;
        else
            return 5;
    }

    function get_normal_inconvenient_time($time_from, $time_to, $inconv_from, $inconv_to, $method) {
        switch ($method) {
            case 1: {
                    $normal = $this->time_sum($this->time_difference($inconv_from, (float) $time_from), $this->time_difference((float) $time_to, $inconv_to));
                    $inconvinient_time = $this->time_difference($inconv_to, $inconv_from);
                    return $normal . "/" . $inconvinient_time;
                }
            case 2: {
                    $normal = $this->time_difference($inconv_from, (float) $time_from);
                    $inconvinient_time = $this->time_difference((float) $time_to, $inconv_from);
                    return $normal . "/" . $inconvinient_time;
                }
            case 3: {
                    $normal = $this->time_difference((float) $time_to, $inconv_to);
                    $inconvinient_time = $this->time_difference($inconv_to, (float) $time_from);
                    return $normal . "/" . $this->$inconvinient_time;
                }

            case 4: {
                    $normal = 0.00; //($this->convert_time_part($inconv_from) - $this->convert_time_part((float)$time_from)) + ($this->convert_time_part((float)$time_to) - $this->convert_time_part($inconv_to));           
                    $inconvinient_time = $this->time_difference((float) $time_from, (float) $time_to);
                    return $normal . "/" . $inconvinient_time;
                }
            case 5: {
                    $normal = $this->time_difference((float) $time_from, (float) $time_to); //($this->convert_time_part($inconv_from) - $this->convert_time_part((float)$time_from)) + ($this->convert_time_part((float)$time_to) - $this->convert_time_part($inconv_to));           
                    $inconvinient_time = 0.00;
                    return $normal . "/" . $inconvinient_time;
                }
        }
    }

    function format_time_part($time) {
        $hr = ((int) ($time / 100) < 10) ? "0" . (int) ($time / 100) : (int) ($time / 100);
        $min = ((int) ($time % 100) * (60 / 100) < 10) ? "0" . (int) ($time % 100) * (60 / 100) : (int) ($time % 100) * (60 / 100);
        return $hr . '.' . $min;
    }

    function fomate_to_time($time) {
        /**
         * Author: Shamsu
         * for: convert time in 60 to time in 100
         */
        $hr = (int) $time;
        $min = ((($time - $hr) * 100) / 60) * 100;
        return str_pad($hr, 2, '0', STR_PAD_LEFT) . '.' . str_pad(round($min), 2, '0', STR_PAD_RIGHT);
    }

    function convert_time_part($time) {

        $hr = (int) $time;
        $min = ((($time - $hr) * 100) / 60) * 100;
        return ($hr * 100) + ($min);
    }

    function get_date_limits($month, $year) {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lower_limit = $year . "-" . $month . "-01";
        $upper_limit = $year . "-" . $month . "-" . $num;
        return $lower_limit . "/" . $upper_limit;
    }

    function inconvinient_time_details_month($month, $year) {

        $limits = $this->get_date_limits($month, $year);
        $limit = explode('/', $limits);
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'type', 'days');
        $this->conditions = array('OR', array('BETWEEN', 'effect_to', '?', '?'), array('BETWEEN', 'effect_from', '?', '?'));
        $this->condition_values = array($limit[0], $limit[1], $limit[0], $limit[1]);
        $this->order_by = array('effect_from');
        $this->query_generate();
        $data = $this->query_fetch();
        return (!empty($data) ? $data : FALSE);
    }

    function get_inconvinient_details($month, $year) {
        $limits = $this->get_date_limits($month, $year);
        $limit = explode('/', $limits);
        $this->tables = array('inconvenient_timing');
        $this->fields = array('name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        $this->conditions = array('OR', array('BETWEEN', 'effect_to', '?', '?'), array('BETWEEN', 'effect_from', '?', '?'));
        $this->condition_values = array($limit[0], $limit[1], $limit[0], $limit[1]);
        $this->query_generate();
        $data = $this->query_fetch();
        return (!empty($data) ? $data : FALSE);
    }

    function time_difference($t1, $t2, $mod = 60, $round = true) {
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        //$time1 = ((intval($a1[0]) * 60 * 60) + (str_pad(intval($a1[1]), 2, '0', STR_PAD_RIGHT) * 60));
        //$time2 = ((intval($a2[0]) * 60 * 60) + (str_pad(intval($a2[1]), 2, '0', STR_PAD_RIGHT) * 60));
        $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        if ($mod == 100){
            if($round)
                $mins = round($mins * 100 / 60);
            else
                $mins = ($mins * 100 / 60)/100;
        }
        //$result = $hours . "." . sprintf('%02d', $mins);
        if($round)
            $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        else
            $result = $hours . "." . substr($mins,2);
        return $result;
    }

    function time_sum($t1, $t2) {

        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = (($a1[0] * 60 * 60) + (str_pad($a1[1], 2, '0', STR_PAD_RIGHT) * 60));
        $time2 = (($a2[0] * 60 * 60) + (str_pad($a2[1], 2, '0', STR_PAD_RIGHT) * 60));
        $sum = abs($time1 + $time2);
        $hours = floor($sum / (60 * 60));
        $mins = floor(($sum - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }

    function get_inconvinient_details_holiday($month, $year) {

        $result = array();
        $this->tables = array($this->db_master . '.holiday_inconvenient_timing', $this->db_master . '.holiday_block_master');
        $this->fields = array($this->db_master . '.holiday_inconvenient_timing.id AS id',
            $this->db_master . '.holiday_inconvenient_timing.block_master_id AS block_master_id',
            $this->db_master . '.holiday_inconvenient_timing.effect_from AS effect_from',
            $this->db_master . '.holiday_inconvenient_timing.effect_to',
            $this->db_master . '.holiday_inconvenient_timing.date_from AS from_date',
            $this->db_master . '.holiday_inconvenient_timing.date_to AS to_date',
            $this->db_master . '.holiday_block_master.id',
            // $this->db_master . '.holiday_block_master.type AS master_type',
            $this->db_master . '.holiday_block_master.name AS name',
            $this->db_master . '.holiday_block_master.start_time AS start',
            $this->db_master . '.holiday_block_master.end_time AS end',
            $this->db_master . '.holiday_block_master.type'
        );
        $this->conditions = array('AND', 'effect_from = ?', $this->db_master . '.holiday_inconvenient_timing.block_master_id = ' . $this->db_master . '.holiday_block_master.id');
        $this->condition_values = array($year);
        $this->query_generate();
        $datas = $this->query_fetch();
        $i = 0;
        foreach ($datas as $data) {
            $date_from = explode('-', $data['from_date']);
            $date_to = explode('-', $data['to_date']);
            if ($month == $date_from[0] || $month == $date_to[0]) {
                $result[$i] = array('id' => $data['id'], 'block_master_id' => $data['block_master_id'], 'date_from' => $data['effect_from'] . '-' . $data['from_date'], 'date_to' => $data['effect_from'] . '-' . $data['to_date'], 'name' => $data['name'], 'start_time' => $data['start'], 'end_time' => $data['end']);
                $i++;
            }
        }
        return $result;
    }

    function get_inconvenient_block() {
        $result = array();
        $this->tables = array($this->db_master . '.holiday_block_master', $this->db_master . '.holiday_block');
        $this->fields = array(
            $this->db_master . '.holiday_block_master.id AS id',
            $this->db_master . '.holiday_block_master.name AS name',
            $this->db_master . '.holiday_block_master.start_time AS start',
            $this->db_master . '.holiday_block_master.end_time AS end',
            $this->db_master . '.holiday_block_master.type AS master_type',
            $this->db_master . '.holiday_block.block_master_id AS master_id',
            $this->db_master . '.holiday_block.day AS day',
            $this->db_master . '.holiday_block.type AS types',
        );
        $this->conditions = array('AND', $this->db_master . '.holiday_block_master.id = ' . $this->db_master . '.holiday_block.block_master_id');
        //$this->condition_values = array($year);
        $this->order_by = array('master_id');
        $this->query_generate();
        $datas = $this->query_fetch();
        $i = 0;
        foreach ($datas as $data) {
            $result[$i] = array('day' => $data['day'], 'type' => $data['types'], 'id' => $data['id'], 'master_type' => $data['master_type']);
            $i++;
        }
        return $result;
    }

    function get_type_holiday($day, $id) {
        $this->tables = array($this->db_master . '.holiday_block', $this->db_master . '.holiday_block_master');
        $this->fields = array(
            $this->db_master . '.holiday_block.day',
            $this->db_master . '.holiday_block.type',
            $this->db_master . '.holiday_block.block_master_id',
            $this->db_master . '.holiday_block_master.type AS master_type',
            $this->db_master . '.holiday_block_master.id'
        );
        $this->conditions = array('AND', $this->db_master . '.holiday_block.day = ?', $this->db_master . '.holiday_block.block_master_id = ?', $this->db_master . '.holiday_block.block_master_id =' . $this->db_master . '.holiday_block_master.id');
        $this->condition_values = array($day, $id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_inconvenience_month_distinct($month, $year) {
        /* $limits = $inconv->get_date_limits($month, $year);
          $limit = explode("/", $limits); */
        $this->tables = array('inconvenient_timing');
        $this->fields = array('distinct(name)');
        $this->conditions = array('OR', 'month(effect_from) = ?', 'month(effect_to) = ?');
        $this->condition_values = array($month, $month);
        //$this->group_by = array('name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    /* ------------------------NIyaz end---------------------------- */
    /* --------------------------Shamsu----------------------------- */

    function employee_montly_work_details($employee, $month, $year) {

        $this->tables = array('timetable` as `t', 'customer` as `c');
        $this->fields = array('t.date', 't.time_from', 't.time_to', 't.customer', 't.type', 'concat(c.first_name," ",c.last_name) as customer_name');
        $this->conditions = array('AND', 'month(t.date)= ?', 'year(t.date)= ?', 't.employee like ?', 't.status=1', 't.customer like c.username');
        $this->condition_values = array($month, $year, $employee);
        $this->group_by = array('t.date', 't.time_from', 't.time_to');
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        //print_r($datas);
        return $datas;
    }

    /*     * ***************************start*******************employee work report details*************************** */

    function employee_report($employee, $year, $month) {        //not used
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2)');
        $this->conditions = array('AND', 'type = 0', 'customer like c1', 'date like d1', 'work like w1', 'employee like ?', 'status=1');
        $this->query_generate();
        $query_type0 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2)');
        $this->conditions = array('AND', 'type = 1', 'customer like c1', 'date like d1', 'work like w1', 'employee like ?', 'status=1');
        $this->query_generate();
        $query_type1 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2)');
        $this->conditions = array('AND', 'type = 2', 'customer like c1', 'date like d1', 'work like w1', 'employee like ?', 'status=1');
        $this->query_generate();
        $query_type2 = $this->sql_query;

        $this->tables = array('timetable', 'work', 'customer');
        $this->fields = array('timetable.date as d1', 'timetable.work as w1', 'work.name as w_name', 'timetable.customer as c1', 'customer.first_name as cust_name', '(' . $query_type0 . ') as t0', '(' . $query_type1 . ') as t1', '(' . $query_type2 . ') as t2');
        $this->conditions = array('AND', 'timetable.employee like ?', 'month(timetable.date)= ?', 'year(timetable.date)= ?', 'timetable.status=1', 'work.id=timetable.work', 'customer.username like timetable.customer');
        $this->condition_values = array($employee, $employee, $employee, $employee, $month, $year);
        $this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_inconvenient_details_by_month_and_year($month, $year) {
        $this->tables = array('inconvenient_timing');
        $this->fields = array('name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        $this->conditions = array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?'));
        $this->condition_values = array($month, $year, $month, $year, $month, $year);
        //$this->order_by = array('uname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_all_work_details($employee, $month, $year) {
        $this->tables = array('timetable');
        $this->fields = array('date', 'time_from', 'time_to', 'type');
        $this->conditions = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status=1');
        $this->condition_values = array($employee, $month, $year);
        //$this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
        $this->order_by = array('date');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_all_work_details_include_normal_nd_leave($employee, $month, $year, $customer = NULL) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));

        $customer = ($customer != '' && $customer != NULL ? $customer : NULL);
        $this->flush();
        if($fromdate <= $boundary_date && $todate > $boundary_date){
            $this->tables           = array('timetable');
            $this->fields           = array('date', 'time_from', 'time_to', 'type');
            $this->conditions       = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status IN (1,2,4)');
            $this->condition_values = array($employee, $month, $year);
            //$this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
            if ($customer != NULL) {
                $this->conditions[]       = 'customer like ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('date');
            $this->query_generate();
            $real_table_data = $this->sql_query; 


            $this->tables     = array('backup_timetable');
            $this->fields     = array('date', 'time_from', 'time_to', 'type');
            $this->conditions = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status IN (1,2,4)');
            $condition_values = array($employee, $month, $year);
            //$this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
            if ($customer != NULL) {
                $this->conditions[] = 'customer like ?';
                $condition_values[] = $customer;
            }
            $this->order_by = array('date');
            $this->query_generate();
            $backup_table_data      = $this->sql_query; 
            $this->condition_values = array_merge($this->condition_values, $condition_values);

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY date ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $this->tables = array('backup_timetable` as `t');
            $proceed      = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $this->tables = array('timetable` as `t');
            $proceed      = TRUE;
        }
        if($proceed == true){
            $this->fields           = array('date', 'time_from', 'time_to', 'type');
            $this->conditions       = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status IN (1,2,4)');
            $this->condition_values = array($employee, $month, $year);
            if ($customer != NULL) {
                $this->conditions[]       = 'customer like ?';
                $this->condition_values[] = $customer;
            }
            $this->order_by = array('date');
            $this->query_generate();
        }
        $datas = $this->query_fetch(1);
        return $datas;
    }

    function get_holiday_details($month, $year, $reddays = false) {
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'effect_from', 'effect_to', 'date_from', 'date_to', 'name', 'start_time', 'end_time', 'type');
        if ($month == 1) {
            $this->conditions = array('OR', array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), array('OR', 'SUBSTRING(date_from,1,2) = ?', 'SUBSTRING(date_to,1,2) = ?')), array('AND', 'effect_to = ?', 'SUBSTRING(date_from,1,2) = ?', 'SUBSTRING(date_to,1,2) = ?'));
            $this->condition_values = array($year, $year, $year, $month, $month, $year - 1, '12', $month);
        } else {
            $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), array('OR', 'SUBSTRING(date_from,1,2) = ?', 'SUBSTRING(date_to,1,2) = ?'));
            $this->condition_values = array($year, $year, $year, $month, $month);
        }
        $this->query_generate();
        $datas = $this->query_fetch(1);
        $details = array();
        $reddays_array = array();
        $i = 0;
        foreach ($datas as $data) {
            $start_date = strtotime($year . '-' . $data['date_from']);
            if (substr($data['date_from'], 0, 2) == '12' && substr($data['date_to'], 0, 2) == '01' && $month == 1)
                $start_date = strtotime($year - 1 . '-' . $data['date_from']);
            $this->tables = array('holiday_block');
            $this->fields = array('id', 'day', 'type');
            $this->conditions = array('block_master_id = ?');
            $this->condition_values = array($data['id']);
            $this->order_by = array('day');
            $this->query_generate();
            $days = $this->query_fetch();
            $start_time = $data['start_time'];
            $end_time = $data['end_time'];

            $timings = array();
            $start = $end = '';
            foreach ($days as $day) {

                if (date('Y', $start_date) == $year && date('m', $start_date) == $month) {
                    if ($day['day'] == 1) {
                        $start_time = $data['start_time'];
                        $end_time = 24;
                        $start = mktime((int) $start_time, ($start_time - (int) $start_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    } else if ($day['day'] == count($days)) {
                        $start_time = 0;
                        $end_time = $data['end_time'];
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    } else {
                        $start_time = 0;
                        $end_time = 24;
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    }
                    if($reddays && $day['type'] == 1) {
                        $reddays_array[] = date('Y-m-d', $start_date);
                    } else {
                        $timings[] = array('date' => date('Y-m-d', $start_date), 'time_from' => $start_time, 'time_to' => $end_time, 'bigred' => $day['type']);
                    }
                }
                $start_date = strtotime(date("Y-m-d", $start_date) . " +1 day");
            }
            if (!empty($timings)){
                $details[] = array('id' => $data['id'], 'group_id' => $data['group_id'], 'name' => $data['name'], 'type' => $data['type'], 'start' => $start, 'end' => $end, 'timings' => $timings);
            }
            $i++;
        }
        if($reddays) {
            $details = $reddays_array;
        }
        return (!empty($details) ? $details : array());
    }

    function get_holiday_details_by_date($date_from, $date_to, $reddays = false) {
        $from_year = date('Y', strtotime($date_from));
        $to_year = date('Y', strtotime($date_to));
        $from_month = date('m', strtotime($date_from));
        $to_month = date('m', strtotime($date_to));
        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'effect_from', 'effect_to', 'date_from', 'date_to', 'name', 'start_time', 'end_time', 'type');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), array('OR', 'SUBSTRING(date_from,1,2) IN(?, ?)', 'SUBSTRING(date_to,1,2) IN (?, ?)'));
        $this->condition_values = array($from_year, $from_year, $to_year, $from_month, $to_month, $from_month, $to_month);
        $this->query_generate();
        $datas = $this->query_fetch(1);
        $details = array();
        $reddays_array = array();
        $i = 0;
        foreach ($datas as $data) {
            $start_date = strtotime($from_year . '-' . $data['date_from']);
            if (substr($data['date_from'], 0, 2) == '12' && substr($data['date_to'], 0, 2) == '01' && $month == 1)
                $start_date = strtotime($from_year - 1 . '-' . $data['date_from']);
            $this->tables = array('holiday_block');
            $this->fields = array('id', 'day', 'type');
            $this->conditions = array('block_master_id = ?');
            $this->condition_values = array($data['id']);
            $this->order_by = array('day');
            $this->query_generate();
            $days = $this->query_fetch();
            $start_time = $data['start_time'];
            $end_time = $data['end_time'];

            $timings = array();
            $start = $end = '';
            foreach ($days as $day) {

                if ((date('Y', $start_date) == $from_year || date('Y', $start_date) == $to_year) && (date('m', $start_date) == $from_month || date('m', $start_date) == $to_month)) {
                    if ($day['day'] == 1) {
                        $start_time = $data['start_time'];
                        $end_time = 24;
                        $start = mktime((int) $start_time, ($start_time - (int) $start_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    } else if ($day['day'] == count($days)) {
                        $start_time = 0;
                        $end_time = $data['end_time'];
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    } else {
                        $start_time = 0;
                        $end_time = 24;
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    }
                    if($reddays && $day['type'] == 1) {
                        $reddays_array[] = date('Y-m-d', $start_date);
                    } else {
                        $timings[] = array('date' => date('Y-m-d', $start_date), 'time_from' => $start_time, 'time_to' => $end_time, 'bigred' => $day['type']);
                    }
                }
                $start_date = strtotime(date("Y-m-d", $start_date) . " +1 day");
            }
            if (!empty($timings)){
                $details[] = array('id' => $data['id'], 'group_id' => $data['group_id'], 'name' => $data['name'], 'type' => $data['type'], 'start' => $start, 'end' => $end, 'timings' => $timings);
            }
            $i++;
        }
        if($reddays) {
            $details = $reddays_array;
        }
        return (!empty($details) ? $details : array());
    }
    
    function get_distinct_normal_inconvenient_details_by_month_and_year($month, $year, $employee, $customer = '') {

        if (!$this->is_ob_on_for_a_employee($employee))
            return array();

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'time_from', 'time_to', 'days');
        $this->conditions = array('AND', 'root_id=0', 'type=0',
            array('OR',
                array('AND', 'month(effect_from) <= ?', 'year(effect_from) = ?'),
                'year(effect_from) < ?'),
            array('OR', 'effect_to is null',
                array('AND', 'effect_to is not null',
                    array('OR',
                        array('AND', 'month(effect_to) >= ?', 'year(effect_to) = ?'),
                        'year(effect_to) > ?'),
                ),
            )
        );
        $this->condition_values = array($month, $year, $year, $month, $year, $year);
        $this->query_generate();
        $datas = $this->query_fetch();
        $i = 0;

        $normal = array();
        foreach ($datas as $data) {
            $d = explode(',', $data['days']);
            $days = array();
            $j = 0;
            $week_days = '';
            foreach ($d as $day) {
                if ($j == 0)
                    $week_days = '\'';
                if ($day) {
                    if ($j != 0)
                        $week_days .= ',\'';
                    $week_days .= ($day % 7) . '\'';
                    $j++;
                }
            }

            $this->tables = array('timetable');
            $this->fields = array('id');
            if ($customer == '') {
                $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', array('IN', 'status', '1,2'), array('IN', 'type', '0,1,2,4,5,6,7,8,10,11,12,15,16'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                    array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                        array('AND', 'time_to > ?', 'time_to <= ?'),
                        array('AND', 'time_from <= ?', 'time_to >= ?'))
                );

                $this->condition_values = array($month, $year, $employee,
                    $data['time_from'], $data['time_to'],
                    $data['time_from'], $data['time_to'],
                    $data['time_from'], $data['time_to']
                );
            } else {
                $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'customer = ?', array('IN', 'status', '1,2'), array('IN', 'type', '0,1,2,4,5,6,7,8,10,11,12,15,16'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                    array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                        array('AND', 'time_to > ?', 'time_to <= ?'),
                        array('AND', 'time_from <= ?', 'time_to >= ?'))
                );

                $this->condition_values = array($month, $year, $employee, $customer,
                    $data['time_from'], $data['time_to'],
                    $data['time_from'], $data['time_to'],
                    $data['time_from'], $data['time_to']
                );
            }
            $this->query_generate();
            //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
            if (count($this->query_fetch())) {
                $normal[$i] = $data;

                $i++;
            } else {
                $this->tables = array('inconvenient_timing');
                $this->fields = array('id', 'group_id', 'name', 'time_from', 'time_to', 'days');
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
                    if ($customer == '') {
                        $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', array('IN', 'status', '1,2'), array('IN', 'type', '0,1,2,4,5,6,7,8,10,11,12,15,16'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                            array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                array('AND', 'time_to > ?', 'time_to <= ?'),
                                array('AND', 'time_from <= ?', 'time_to >= ?'))
                        );

                        $this->condition_values = array($month, $year, $employee,
                            $data_cont['time_from'], $data_cont['time_to'],
                            $data_cont['time_from'], $data_cont['time_to'],
                            $data_cont['time_from'], $data_cont['time_to']
                        );
                    } else {
                        $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'customer = ?', array('IN', 'status', '1,2'), array('IN', 'type', '0,1,2,4,5,6,7,8,10,11,12,15,16'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                            array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                array('AND', 'time_to > ?', 'time_to <= ?'),
                                array('AND', 'time_from <= ?', 'time_to >= ?'))
                        );

                        $this->condition_values = array($month, $year, $employee, $customer,
                            $data_cont['time_from'], $data_cont['time_to'],
                            $data_cont['time_from'], $data_cont['time_to'],
                            $data_cont['time_from'], $data_cont['time_to']
                        );
                    }
                    $this->query_generate();
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

    function get_distinct_inconvenient_details_btwn_2_dates($sdate, $edate, $employee, $normal_oncall = 1, $customer = '') {
        // $normal_oncall : 1- normal, 3-oncall

        if ($normal_oncall == 1) {
            if (!$this->is_ob_on_for_a_employee($employee))
                return array();
        }
        $datas = array();
        if ($normal_oncall == 1) {
            $this->tables = array('inconvenient_timing');
            $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall', 'sort_order');
            $this->conditions = array('AND',
                array('OR',
                    array('AND', 'effect_to is null', 'effect_from <= ?'),
                    array('AND', 'effect_to is not null',
                        array('OR',
                            array('BETWEEN', 'effect_from', '?', '?'),
                            array('BETWEEN', 'effect_to', '?', '?'),
                            array('BETWEEN', '?', 'effect_from', 'effect_to'),
                            array('BETWEEN', '?', 'effect_from', 'effect_to')
                        )
                    )
                ), 'root_id=0');
            $this->condition_values = array($sdate, $sdate, $edate, $sdate, $edate, $sdate, $edate);
            $this->conditions[] = ($normal_oncall == 1 ? 'type=0' : 'type=3');
            $this->query_generate();
            $datas = $this->query_fetch();
            if (!empty($datas)) {
                foreach ($datas as $t_key => $g_data) {
                    $datas[$t_key]['source'] = 'GLOBAL';
                    $datas[$t_key]['effect_from'] = $g_data['effect_from'] < $sdate ? $sdate : $g_data['effect_from'];
                    $datas[$t_key]['effect_to'] = ($g_data['effect_to'] == '' || $g_data['effect_to'] > $edate ? $edate : $g_data['effect_to']);
                }
            }
        }
        else
            $datas = $this->get_distinct_oncall_inconvenient_btwn_2_dates_for_customer($sdate, $edate, $customer);

       // if($_COOKIE['admin'] == 'yes'){ echo "<pre>emp datas : ".print_r($datas, 1)."</pre>"; }
        $i = 0;

        $normal_oncall_IN_condition = array();
        if ($normal_oncall == 1)
            $normal_oncall_IN_condition = array('IN', 'type', '0,1,2,4,5,6,7,8,10,11,12,15,16');
        else
            $normal_oncall_IN_condition = array('IN', 'type', '3,9,13,14,17');

        $normal = array();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $d = explode(',', $data['days']);
                $j = 0;
                $week_days = '';
                foreach ($d as $day) {
                    if ($j == 0)
                        $week_days = '\'';
                    if ($day) {
                        if ($j != 0)
                            $week_days .= ',\'';
                        $week_days .= ($day % 7) . '\'';
                        $j++;
                    }
                }

                $obj_gen       = new general();
                $boundary_date = $obj_gen->get_boundary_date();
                $proceed = FALSE;

                $this->flush();
                if($sdate <= $boundary_date && $edate > $boundary_date){
                    $this->tables = array('timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), $normal_oncall_IN_condition, array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $this->condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                        $data['time_from'], $data['time_to'],
                        $data['time_from'], $data['time_to'],
                        $data['time_from'], $data['time_to']
                    );
                    if ($customer != '') {
                        $this->conditions[] = 'customer = ?';
                        $this->condition_values[] = $customer;
                    }
                    $this->query_generate();
                    $real_table_data = $this->sql_query;

                    $this->tables = array('backup_timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), $normal_oncall_IN_condition, array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                        $data['time_from'], $data['time_to'],
                        $data['time_from'], $data['time_to'],
                        $data['time_from'], $data['time_to']
                    );
                    if ($customer != '') {
                        $this->conditions[] = 'customer = ?';
                        $condition_values[] = $customer;
                    }
                    $this->query_generate();
                    $backup_table_data = $this->sql_query;
                    $this->condition_values[] = array_merge($this->condition_values, $condition_values);

                    $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
                }
                else if($sdate <= $boundary_date && $edate <= $boundary_date){
                    $this->tables = array('backup_timetable');
                    $proceed = TRUE;
                }
                else if($sdate > $boundary_date && $edate > $boundary_date){
                    $this->tables = array('timetable');
                    $proceed = TRUE;
                }

                if($proceed == true){
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), $normal_oncall_IN_condition, array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $this->condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                        $data['time_from'], $data['time_to'],
                        $data['time_from'], $data['time_to'],
                        $data['time_from'], $data['time_to']
                    );
                    if ($customer != '') {
                        $this->conditions[]       = 'customer = ?';
                        $this->condition_values[] = $customer;
                    }
                    $this->query_generate();
                }

                if (count($this->query_fetch())) {
                    $normal[$i] = $data;
                    $i++;
                } else {
                    $datas_cont = array();
                    if ($data['source'] == 'CUSTOMER')
                        $datas_cont = $this->get_customer_inconvenient_periods_using_root_id($data['id']);
                    else if ($data['source'] == 'GLOBAL')
                        $datas_cont = $this->get_global_inconvenient_periods_using_root_id($data['id']);

                    foreach ($datas_cont as $data_cont) {
                        $d = explode(',', $data_cont['days']);
                        $j = 0;
                        $week_days = '';
                        foreach ($d as $day) {
                            if ($j == 0)
                                $week_days = '\'';
                            if ($day) {
                                if ($j != 0)
                                    $week_days .= ',\'';
                                $week_days .= ($day % 7) . '\'';
                                $j++;
                            }
                        }

                        $proceed = FALSE;
                        $this->flush();
                        if($sdate <= $boundary_date && $edate > $boundary_date){
                            $this->tables = array('timetable');
                            $this->fields = array('id');
                            $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), $normal_oncall_IN_condition, array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                    array('AND', 'time_to > ?', 'time_to <= ?'),
                                    array('AND', 'time_from <= ?', 'time_to >= ?'))
                            );

                            $this->condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to']
                            );
                            if ($customer != '') {
                                $this->conditions[] = 'customer = ?';
                                $this->condition_values[] = $customer;
                            }
                            $this->query_generate();
                            $real_table_data = $this->sql_query;

                            $this->tables = array('backup_timetable');
                            $this->fields = array('id');
                            $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), $normal_oncall_IN_condition, array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                    array('AND', 'time_to > ?', 'time_to <= ?'),
                                    array('AND', 'time_from <= ?', 'time_to >= ?'))
                            );

                            $condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to']
                            );
                            if ($customer != '') {
                                $this->conditions[] = 'customer = ?';
                                $condition_values[] = $customer;
                            }
                            $this->query_generate();
                            $backup_table_data = $this->sql_query;
                            $this->condition_values[] = array_merge($this->condition_values, $condition_values);
                            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
                        }
                        else if($sdate <= $boundary_date && $edate <= $boundary_date){
                            $this->tables = array('backup_timetable');
                            $proceed = TRUE;
                        }
                        else if($sdate > $boundary_date && $edate > $boundary_date){
                            $this->tables = array('timetable');
                            $proceed = TRUE;
                        }
                        if($proceed == TRUE){
                            $this->fields = array('id');
                            $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), $normal_oncall_IN_condition, array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                    array('AND', 'time_to > ?', 'time_to <= ?'),
                                    array('AND', 'time_from <= ?', 'time_to >= ?'))
                            );

                            $this->condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to']
                            );
                            if ($customer != '') {
                                $this->conditions[]       = 'customer = ?';
                                $this->condition_values[] = $customer;
                            }
                            $this->query_generate();
                        }

                            
                        if (count($this->query_fetch())) {
                            $normal[$i] = $data;
                            $i++;
                            break;
                        }
                    }
                }
            }
        }
        return $normal;
    }

    function get_inconvenient_on_a_day($date, $normal_oncall = 1) {
        //for taking inconvenient timings for a day
        // $normal_oncall : 1- normal, 3-oncall

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall');
        if ($normal_oncall == 1)
            $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'days LIKE ?', 'type=0');
        else
            $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'days LIKE ?', 'type=3');
        $this->condition_values = array($date, $date, $date, '%' . date('N', strtotime($date)) . ',%');
        $this->query_generate();
        $datas = $this->query_fetch();
        $timing = array();
        foreach ($datas as $data) {
            $timing[] = array('time_from' => $data['time_from'], 'time_to' => $data['time_to']);
        }
        return $timing;
    }

    function get_inconvenient_on_a_day_for_customer($date, $customer, $normal_oncall = 1, $get_from_global_if_not_exist = TRUE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: geting inconvenient periods related to customer, if no periods, it'll get from global inconvenients
         * @since: 2014-08-02
         * $normal_oncall : 1- normal, 3-oncall
         */
        if ($normal_oncall == 1 || trim($customer) == '') {
            if ($get_from_global_if_not_exist)
                return $this->get_inconvenient_on_a_day($date, $normal_oncall);
            else
                return array();
        } else {
            $timing = array();
            $this->flush();
            //check any customer inconvenience for this date included period
            $this->tables = array('inconvenient_timing_customer');
            $this->fields = array('id', 'group_id', 'customer', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount');
            $this->conditions = array('AND', 'customer = ?', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')));
            $this->condition_values = array($customer, $date, $date, $date);
            $this->query_generate();
            $datas = $this->query_fetch();

            $have_any_datas = FALSE;
            if (!empty($datas)) {
                $have_any_datas = TRUE;
                $cur_date_day = date('N', strtotime($date));
                foreach ($datas as $data) {
                    if (preg_match('/' . $cur_date_day . ',/', $data['days'])) {
                        $timing[] = array('time_from' => $data['time_from'], 'time_to' => $data['time_to']);
                    }
                }
            }
            if ($get_from_global_if_not_exist && !$have_any_datas)
                return $this->get_inconvenient_on_a_day($date, $normal_oncall);
            else
                return $timing;
        }
    }

    function get_collided_inconvenients_on_a_day($date, $time_from, $time_to, $normal_oncall = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @for: getting collided inconvenient time ranges with user time range
         */
       // $normal_oncall : 1- normal, 3-oncall
        $inconv_type = ($normal_oncall == 1 ? 0 : 3);
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'days LIKE ?', 'type = ?',
            array('OR',
                array('BETWEEN', 'time_from', $time_from, $time_to),
                array('BETWEEN', 'time_to', $time_from, $time_to),
                array('BETWEEN', $time_from, 'time_from', 'time_to'),
                array('BETWEEN', $time_to, 'time_from', 'time_to')
            )
        );
        $this->condition_values = array($date, $date, $date, '%' . date('N', strtotime($date)) . ',%', $inconv_type);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        $timing = array();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $timing[] = array('time_from' => $data['time_from'], 'time_to' => $data['time_to']);
            }
        }
        return $timing;
    }

    function get_collided_inconvenients_on_a_day_for_customer($date, $customer, $time_from, $time_to, $normal_oncall = 1, $get_from_global_if_not_exist = TRUE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting collided inconvenient time ranges with user time range related to customer
         * @since: 2014-08-02
         * $normal_oncall : 1- normal, 3-oncall
         */
        if ($normal_oncall == 1 || trim($customer) == '') {
            if ($get_from_global_if_not_exist)
                return $this->get_collided_inconvenients_on_a_day($date, $time_from, $time_to, $normal_oncall);
            else
                return array();
        } else {

            $this->flush();
            $timing = array();
            $this->tables = array('inconvenient_timing_customer');
            $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount');
            $this->conditions = array('AND', 'customer = ?', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')));
            $this->condition_values = array($customer, $date, $date, $date);
            $this->order_by = array('time_from', 'time_to');
            $this->query_generate();
            $datas = $this->query_fetch();

            $have_any_datas = FALSE;
            if (!empty($datas)) {
                $have_any_datas = TRUE;
                $cur_date_day = date('N', strtotime($date));
                foreach ($datas as $data) {
                    if (preg_match('/' . $cur_date_day . ',/', $data['days']) &&
                            ( ( $time_from <= $data['time_from'] && $data['time_from'] <= $time_to) ||
                            ( $time_from <= $data['time_to'] && $data['time_to'] <= $time_to) ||
                            ( $data['time_from'] <= $time_from && $time_from <= $data['time_to']) ||
                            ( $data['time_from'] <= $time_to && $time_to <= $data['time_to'])
                            )
                    ) {
                        $timing[] = array('time_from' => $data['time_from'], 'time_to' => $data['time_to']);
                    }
                }
            }

            /* $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'days LIKE ?', 
              array('OR',
              array('BETWEEN', 'time_from', $time_from, $time_to),
              array('BETWEEN', 'time_to', $time_from, $time_to),
              array('BETWEEN', $time_from, 'time_from', 'time_to'),
              array('BETWEEN', $time_to, 'time_from', 'time_to')
              )
              );
              $this->condition_values = array($date, $date, $date, '%' . date('N', strtotime($date)) . ',%'); */
            if ($get_from_global_if_not_exist && !$have_any_datas)
                return $this->get_collided_inconvenients_on_a_day($date, $time_from, $time_to, $normal_oncall);
            else
                return $timing;
        }
    }

    function get_distinct_oncall_inconvenient_details_by_month_and_year($month, $year, $employee, $customer = '') {

       // if(!$this->is_ob_on_for_a_employee($employee)) return array();

        $datas = $this->get_distinct_oncall_inconvenient_by_month_and_year_for_customer($month, $year, $customer);
        $i = 0;
        $normal = array();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $d = explode(',', $data['days']);
                $j = 0;
                $week_days = '';
                foreach ($d as $day) {
                    if ($j == 0)
                        $week_days = '\'';
                    if ($day) {
                        if ($j != 0)
                            $week_days .= ',\'';
                        $week_days .= ($day % 7) . '\'';
                        $j++;
                    }
                }

                $this->flush();
                $this->tables = array('timetable');
                $this->fields = array('id');
                $this->conditions = array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), array('IN', 'type', '3,9,13,14,17'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days),
                    array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                        array('AND', 'time_to > ?', 'time_to <= ?'),
                        array('AND', 'time_from <= ?', 'time_to >= ?'))
                );

                $this->condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                    $data['time_from'], $data['time_to'],
                    $data['time_from'], $data['time_to'],
                    $data['time_from'], $data['time_to']
                );
                if ($customer != '') {
                    $this->conditions[] = 'customer = ?';
                    $this->condition_values[] = $customer;
                }
                $this->query_generate();
                if (count($this->query_fetch())) {
                    $normal[$i] = $data;
                    $i++;
                } else {
                    $datas_cont = array();
                    if ($data['source'] == 'CUSTOMER')
                        $datas_cont = $this->get_customer_inconvenient_periods_using_root_id($data['id']);
                    else if ($data['source'] == 'GLOBAL')
                        $datas_cont = $this->get_global_inconvenient_periods_using_root_id($data['id']);
                    if (!empty($datas_cont)) {
                        foreach ($datas_cont as $data_cont) {
                            $d = explode(',', $data_cont['days']);
                            $j = 0;
                            $week_days = '';
                            foreach ($d as $day) {
                                if ($j == 0)
                                    $week_days = '\'';
                                if ($day) {
                                    if ($j != 0)
                                        $week_days .= ',\'';
                                    $week_days .= ($day % 7) . '\'';
                                    $j++;
                                }
                            }

                            $this->flush();
                            $this->tables = array('timetable');
                            $this->fields = array('id');
                            $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '?', '?'), 'employee = ?', array('IN', 'status', '1,2'), array('IN', 'type', '3,9,13,14,17'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                                    array('AND', 'time_to > ?', 'time_to <= ?'),
                                    array('AND', 'time_from <= ?', 'time_to >= ?'))
                            );

                            $this->condition_values = array($data['effect_from'], $data['effect_to'], $employee,
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to'],
                                $data_cont['time_from'], $data_cont['time_to']
                            );
                            if ($customer != '') {
                                $this->conditions[] = 'customer = ?';
                                $this->condition_values[] = $customer;
                            }
                            $this->query_generate();
                            if (count($this->query_fetch())) {
                                $normal[$i] = $data;
                                $i++;
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $normal;
    }

    function get_global_inconvenient_periods_using_root_id($root_id) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting contigeous inconvenient periods from global incovenient using root id
         * this function removing root record (root_id = 0)
         * @since: 2014-08-13
         */
        $this->flush();
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'time_from', 'time_to', 'days');
        $this->conditions = array('root_id = ?');
        $this->condition_values = array($root_id);
        $this->query_generate();
        $data_inconvenients = $this->query_fetch();
        return $data_inconvenients;
    }

    function get_customer_inconvenient_periods_using_root_id($root_id) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting contigeous inconvenient periods from customer incovenient using root id
         * this function removing root record (root_id = 0)
         * @since: 2014-08-13
         */
        $this->flush();
        $this->tables = array('inconvenient_timing_customer');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        $this->conditions = array('root_id = ?');
        $this->condition_values = array($root_id);
        $this->query_generate();
        $data_inconvenients = $this->query_fetch();
        return $data_inconvenients;
    }

    function get_global_distinct_oncall_inconvenient_btwn_2_date($sdate, $edate, $group_id = NULL) {
        $this->flush();
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall', 'sort_order');
        $this->conditions = array('AND', 'root_id=0', 'type=3',
            array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'),
                array('AND', 'effect_to is not null',
                    array('OR',
                        array('BETWEEN', 'effect_from', '?', '?'),
                        array('BETWEEN', 'effect_to', '?', '?'),
                        array('BETWEEN', '?', 'effect_from', 'effect_to'),
                        array('BETWEEN', '?', 'effect_from', 'effect_to')))));
        $this->condition_values = array($edate, $sdate, $edate, $sdate, $edate, $sdate, $edate);
        
        if($group_id != NULL){
            $this->conditions[] = 'group_id = ?';
            $this->condition_values[] = $group_id;
        }
        $this->query_generate();
        $datas = $this->query_fetch();

        //set a record label to indicate its from global table
        if (!empty($datas)) {
            foreach ($datas as $dKey => $data) {
                $datas[$dKey]['source'] = 'GLOBAL';

                $datas[$dKey]['effect_from'] = $data['effect_from'] < $sdate ? $sdate : $data['effect_from'];
                $datas[$dKey]['effect_to'] = ($data['effect_to'] == '' || $data['effect_to'] > $edate ? $edate : $data['effect_to']);
            }
        }
        return $datas;
    }

    function get_distinct_oncall_inconvenient_by_month_and_year($month, $year) {
        //This function will need to adjust the output inconvenient periods to this month boundary
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'type', 'amount');
        $this->conditions = array('AND', 'root_id=0', 'type=3',
            array('OR',
                array('AND', 'month(effect_from) <= ?', 'year(effect_from) = ?'),
                'year(effect_from) < ?'),
            array('OR', 'effect_to is null',
                array('AND', 'effect_to is not null',
                    array('OR',
                        array('AND', 'month(effect_to) >= ?', 'year(effect_to) = ?'),
                        'year(effect_to) > ?'),
                ),
            )
        );
        $this->condition_values = array($month, $year, $year, $month, $year, $year);
        $this->query_generate();
        $datas = $this->query_fetch();

        //set a record label to indicate its from global table
        if (!empty($datas)) {
            $month_start_date = date('Y-m-01', strtotime("$year-$month-01"));
            $month_end_date = date('Y-m-t', strtotime("$year-$month-01"));

            foreach ($datas as $dKey => $data) {
                $datas[$dKey]['source'] = 'GLOBAL';

                $datas[$dKey]['effect_from'] = $data['effect_from'] < $month_start_date ? $month_start_date : $data['effect_from'];
                $datas[$dKey]['effect_to'] = ($data['effect_to'] == '' || $data['effect_to'] > $month_end_date ? $month_end_date : $data['effect_to']);
            }
        }
        return $datas;
    }

    function get_distinct_oncall_inconvenient_by_month_and_year_for_customer($month, $year, $customer, $get_from_global_if_not_exist = TRUE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting inconvenient time ranges related to customer
         * get inconvenient periods from global, for the periods which have no inconvenients for that customer
         * @since: 2014-08-12
         */
        if (trim($customer) == '' && $get_from_global_if_not_exist) {
            return $this->get_distinct_oncall_inconvenient_by_month_and_year($month, $year);
        } else {

            $this->flush();
            $timing = array();
            $this->tables = array('inconvenient_timing_customer');
            $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount');
            $this->conditions = array('AND', 'root_id=0', 'customer = ?',
                array('OR',
                    array('AND', 'month(effect_from) <= ?', 'year(effect_from) = ?'),
                    'year(effect_from) < ?'),
                array('OR', 'effect_to is null',
                    array('AND', 'effect_to is not null',
                        array('OR',
                            array('AND', 'month(effect_to) >= ?', 'year(effect_to) = ?'),
                            'year(effect_to) > ?'),
                    ),
                )
            );
            $this->condition_values = array($customer, $month, $year, $year, $month, $year, $year);
            $this->order_by = array('effect_from', 'time_from', 'time_to');
            $this->query_generate();
            $datas = $this->query_fetch();

            $have_any_datas = FALSE;
            $month_start_date = date('Y-m-01', strtotime("$year-$month-01"));
            $month_end_date = date('Y-m-t', strtotime("$year-$month-01"));
            $is_month_completed = FALSE;
            //set a record label to indicate its from customer inconvenient table
            if (!empty($datas)) {
                $have_any_datas = TRUE;
                foreach ($datas as $dKey => $data) {
                    $datas[$dKey]['source'] = 'CUSTOMER';
                    //                    $datas[$dKey]['effect_from'] = $next_date_from_process;
                    $datas[$dKey]['effect_from'] = ($data['effect_from'] < $month_start_date ? $month_start_date : $data['effect_from']);
                    $datas[$dKey]['effect_to'] = ($data['effect_to'] == '' || $data['effect_to'] > $month_end_date ? $month_end_date : $data['effect_to']);
                    $timing[] = $datas[$dKey];

                    if ($datas[$dKey]['effect_to'] == $month_end_date)
                        $is_month_completed = TRUE;
                }
            }

            if (!empty($datas) && $get_from_global_if_not_exist) {

                $next_date_from_process = $month_start_date;
                foreach ($datas as $key => $data) {
                    if ($data['effect_from'] > $next_date_from_process) {

                        //add global inconvenient to timings array
                        $tmp_start_date = $next_date_from_process;
                        $tmp_end_date = date('Y-m-d', strtotime($data['effect_from'] . ' -1 day'));
                        $tmp_global_inconvenients = $this->get_global_distinct_oncall_inconvenient_btwn_2_date($tmp_start_date, $tmp_end_date);
                        if (!empty($tmp_global_inconvenients)) {
                            foreach ($tmp_global_inconvenients as $t_key => $g_data) {

                                $tmp_global_inconvenients[$t_key]['effect_from'] = $g_data['effect_from'] < $tmp_start_date ? $tmp_start_date : $g_data['effect_from'];
                                $tmp_global_inconvenients[$t_key]['effect_to'] = ($g_data['effect_to'] == '' || $g_data['effect_to'] > $tmp_end_date ? $tmp_end_date : $g_data['effect_to']);
                                $timing[] = $tmp_global_inconvenients[$t_key];
                            }
                        }
                    }
                    $next_date_from_process = date('Y-m-d', strtotime($datas[$key]['effect_to'] . ' +1 day'));
                }

                if ($next_date_from_process <= $month_end_date && $get_from_global_if_not_exist && !$is_month_completed) {
                    //add global inconvenient to timings array
                    $tmp_start_date = $next_date_from_process;
                    $tmp_end_date = $month_end_date;
                    $tmp_global_inconvenients = $this->get_global_distinct_oncall_inconvenient_btwn_2_date($tmp_start_date, $tmp_end_date);
                    if (!empty($tmp_global_inconvenients)) {
                        foreach ($tmp_global_inconvenients as $t_key => $g_data) {

                            $tmp_global_inconvenients[$t_key]['effect_from'] = $g_data['effect_from'] < $tmp_start_date ? $tmp_start_date : $g_data['effect_from'];
                            $tmp_global_inconvenients[$t_key]['effect_to'] = ($g_data['effect_to'] == '' || $g_data['effect_to'] > $tmp_end_date ? $tmp_end_date : $g_data['effect_to']);
                            $timing[] = $tmp_global_inconvenients[$t_key];
                        }
                    }
                }
            }

            if ($get_from_global_if_not_exist && !$have_any_datas)
                return $this->get_distinct_oncall_inconvenient_by_month_and_year($month, $year);
            else
                return $timing;
        }
    }

    function get_distinct_oncall_inconvenient_btwn_2_dates_for_customer($sdate, $edate, $customer, $get_from_global_if_not_exist = TRUE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting inconvenient time ranges related to customer between 2 dates
         * get inconvenient periods from global, for the periods which have no inconvenients for that customer
         * @since: 2014-08-12
         */
        if (trim($customer) == '' && $get_from_global_if_not_exist) {
            return $this->get_global_distinct_oncall_inconvenient_btwn_2_date($sdate, $edate);
        } else {

            $timing = array();
            $this->flush();
            $this->tables = array('inconvenient_timing_customer');
            $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall', '(SELECT distinct sort_order FROM inconvenient_timing WHERE group_id=inconvenient_timing_customer.group_id AND root_id = 0) as sort_order');
            $this->conditions = array('AND', 'root_id = 0', 'customer = ?',
                array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'),
                    array('AND', 'effect_to is not null',
                        array('OR',
                            array('BETWEEN', 'effect_from', '?', '?'),
                            array('BETWEEN', 'effect_to', '?', '?'),
                            array('BETWEEN', '?', 'effect_from', 'effect_to'),
                            array('BETWEEN', '?', 'effect_from', 'effect_to')))));
            $this->condition_values = array($customer, $edate, $sdate, $edate, $sdate, $edate, $sdate, $edate);
            $this->order_by = array('effect_from', 'time_from', 'time_to');
            $this->query_generate();
            $datas = $this->query_fetch();

            $have_any_datas = FALSE;
            $is_month_completed = FALSE;
            //set a record label to indicate its from customer inconvenient table
            if (!empty($datas)) {
                $have_any_datas = TRUE;
                
                //calculate empty salary amount from global
                foreach ($datas as $dKey => $data) {
                    $is_any_empty_salary_founds = FALSE;
                    if($data['amount'] === NULL || $data['sal_call_training'] === NULL || $data['sal_complementary_oncall'] === NULL || $data['sal_more_oncall'] === NULL || $data['sal_dismissal_oncall'] === NULL){
                        $is_any_empty_salary_founds = TRUE;
                        $tmp_global_inconvenients = $this->get_global_distinct_oncall_inconvenient_btwn_2_date($sdate, $edate, $data['group_id']);
                        
                        if(!empty($tmp_global_inconvenients)){
                            if($data['amount'] === NULL)
                                $datas[$dKey]['amount'] = $tmp_global_inconvenients[0]['amount'];
                            if($data['sal_call_training'] === NULL)
                                $datas[$dKey]['sal_call_training'] = $tmp_global_inconvenients[0]['sal_call_training'];
                            if($data['sal_complementary_oncall'] === NULL)
                                $datas[$dKey]['sal_complementary_oncall'] = $tmp_global_inconvenients[0]['sal_complementary_oncall'];
                            if($data['sal_more_oncall'] === NULL)
                                $datas[$dKey]['sal_more_oncall'] = $tmp_global_inconvenients[0]['sal_more_oncall'];
                            if($data['sal_dismissal_oncall'] === NULL)
                                $datas[$dKey]['sal_dismissal_oncall'] = $tmp_global_inconvenients[0]['sal_dismissal_oncall'];
                        }
                    }
                }
                
                //set effect from-to
                foreach ($datas as $dKey => $data) {
                    $datas[$dKey]['source'] = 'CUSTOMER';

                    $datas[$dKey]['effect_from'] = ($data['effect_from'] < $sdate ? $sdate : $data['effect_from']);
                    $datas[$dKey]['effect_to'] = ($data['effect_to'] == '' || $data['effect_to'] > $edate ? $edate : $data['effect_to']);
                    $timing[] = $datas[$dKey];

                    if ($datas[$dKey]['effect_to'] == $edate)
                        $is_month_completed = TRUE;
                }
                
            }

            if (!empty($datas) && $get_from_global_if_not_exist) {
                $next_date_from_process = $sdate;
                foreach ($datas as $key => $data) {
                    if ($data['effect_from'] > $next_date_from_process) {

                        //add global inconvenient to timings array
                        $tmp_start_date = $next_date_from_process;
                        $tmp_end_date = date('Y-m-d', strtotime($data['effect_from'] . ' -1 day'));
                        $tmp_global_inconvenients = $this->get_global_distinct_oncall_inconvenient_btwn_2_date($tmp_start_date, $tmp_end_date);
                        if (!empty($tmp_global_inconvenients)) {
                            foreach ($tmp_global_inconvenients as $t_key => $g_data) {

                                $tmp_global_inconvenients[$t_key]['effect_from'] = $g_data['effect_from'] < $tmp_start_date ? $tmp_start_date : $g_data['effect_from'];
                                $tmp_global_inconvenients[$t_key]['effect_to'] = ($g_data['effect_to'] == '' || $g_data['effect_to'] > $tmp_end_date ? $tmp_end_date : $g_data['effect_to']);
                                $timing[] = $tmp_global_inconvenients[$t_key];
                            }
                        }
                    }
                    $next_date_from_process = date('Y-m-d', strtotime($datas[$key]['effect_to'] . ' +1 day'));
                }

                if ($next_date_from_process <= $edate && $get_from_global_if_not_exist && !$is_month_completed) {
                    //add global inconvenient to timings array
                    $tmp_start_date = $next_date_from_process;
                    $tmp_end_date = $edate;
                    $tmp_global_inconvenients = $this->get_global_distinct_oncall_inconvenient_btwn_2_date($tmp_start_date, $tmp_end_date);
                    if (!empty($tmp_global_inconvenients)) {
                        foreach ($tmp_global_inconvenients as $t_key => $g_data) {

                            $tmp_global_inconvenients[$t_key]['effect_from'] = $g_data['effect_from'] < $tmp_start_date ? $tmp_start_date : $g_data['effect_from'];
                            $tmp_global_inconvenients[$t_key]['effect_to'] = ($g_data['effect_to'] == '' || $g_data['effect_to'] > $tmp_end_date ? $tmp_end_date : $g_data['effect_to']);
                            $timing[] = $tmp_global_inconvenients[$t_key];
                        }
                    }
                }
            }

            if ($get_from_global_if_not_exist && !$have_any_datas)
                return $this->get_global_distinct_oncall_inconvenient_btwn_2_date($sdate, $edate);
            else
                return $timing;
        }
    }

    function get_distinct_normal_inconvenient_details_by_month_and_year_cont($id, $inconvenient_source = 'GLOBAL') {
        /**
         * @edited_author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting contigeous inconvenient periods using root id
         * @param $inconvenient_source: indicate from the inconvenient periods taken. that have maximum 2 values
         *      GLOBAL = inconvenient from global inconvenient table 
         *      CUSTOMER = inconvenient from customer inconvenient table 
         * this function removing root record (root_id = 0)
         * @last_edited: 2014-08-13
         */
        $datas = array();
        if ($inconvenient_source == 'CUSTOMER')
            $datas = $this->get_customer_inconvenient_periods_using_root_id($id);
        else //if($inconvenient_source == 'GLOBAL')
            $datas = $this->get_global_inconvenient_periods_using_root_id($id);
        return $datas;
    }
    
    function get_employee_normal_inconvenient_details_by_month_and_year($month, $year, $employee, $customer = '') {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $start_date    = $year.'-'.$month.'-'.'01';
        $end_date      = date("Y-m-t", strtotime($start_date));


        if($start_date <= $boundary_date && $start_date > $boundary_date){
            $this->tables           = array('timetable');
            $this->fields           = array('id', 'time_from', 'time_to', 'date', 'type', 'status', 'customer', 'fkkn', 'comment');
            $this->conditions       = array('AND', 'MONTH(date) = ?', 'YEAR(date) = ?', 'employee = ?', array('IN', 'status', '1,2,4'), array('IN', 'type', '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17'));
            $this->condition_values = array($month, $year, $employee);

            if ($customer != '') {
                if (is_array($customer)) {
                    $customers          = "'" . implode("','", $customer) . "'";
                    $this->conditions[] = array('IN', 'customer', $customers);
                } else {
                    $this->conditions[]       = 'customer = ?';
                    $this->condition_values[] = $customer;
                }
            }
            $this->order_by = array('date');
            $this->query_generate();
            $real_table_data = $this->sql_query();

            $this->tables           = array('backup_timetable');
            $this->fields           = array('id', 'time_from', 'time_to', 'date', 'type', 'status', 'customer', 'fkkn', 'comment');
            $this->conditions       = array('AND', 'MONTH(date) = ?', 'YEAR(date) = ?', 'employee = ?', array('IN', 'status', '1,2,4'), array('IN', 'type', '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17'));
            $condition_values       = array($month, $year, $employee);

            if ($customer != '') {
                if (is_array($customer)) {
                    $customers = "'" . implode("','", $customer) . "'";
                    $this->conditions[] = array('IN', 'customer', $customers);
                } else {
                    $this->conditions[] = 'customer = ?';
                    $condition_values[] = $customer;
                }
            }
            $this->order_by = array('date');
            $this->query_generate();
            $backup_table_data = $this->sql_query();
            $this->condition_values = array_merge($this->condition_values, $condition_values);

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY date' ;
        }
        else if($start_date <= $boundary_date && $start_date <= $boundary_date){
            $this->tables = array('backup_timetable');
            $proceed = TRUE;
        }
        else if($start_date > $boundary_date && $start_date > $boundary_date){
            $this->tables = array('timetable');
            $proceed = TRUE;
        }
        if($proceed == true){
            $this->fields = array('id', 'time_from', 'time_to', 'date', 'type', 'status', 'customer', 'fkkn', 'comment');
            $this->conditions = array('AND', 'MONTH(date) = ?', 'YEAR(date) = ?', 'employee = ?', array('IN', 'status', '1,2,4'), array('IN', 'type', '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17'));
            $this->condition_values = array($month, $year, $employee);

            if ($customer != '') {
                if (is_array($customer)) {
                    $customers = "'" . implode("','", $customer) . "'";
                    $this->conditions[] = array('IN', 'customer', $customers);
                } else {
                    $this->conditions[] = 'customer = ?';
                    $this->condition_values[] = $customer;
                }
            }
            $this->order_by = array('date');
            $this->query_generate(); 
        }
            

        $datas = $this->query_fetch();
        return $datas;
    }

    function get_leave_details_by_month_and_year($month, $year, $employee, $customer = null,$sdate = null, $edate = null) {
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        if($sdate <= $boundary_date && $edate > $boundary_date){
            $this->tables           = array('leave');
            $this->fields           = array('distinct type');
            $this->conditions       = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1'));
            $this->condition_values = array($month, $year, $employee);
            $this->query_generate();
            $real_table_data        = $this->sql_query;

            $this->tables           = array('backup_leave');
            $this->fields           = array('distinct type');
            $this->conditions       = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1'));
            $condition_values       = array($month, $year, $employee);
            $this->query_generate();
            $backup_table_data      = $this->sql_query;

            $this->condition_values = array_merge($this->condition_values, $condition_values);
            $this->sql_query        = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }

        else if($sdate <= $boundary_date && $edate <= $boundary_date){
            $this->tables = array('backup_leave');
            $proceed = TRUE;
        }
        else if($sdate > $boundary_date && $edate > $boundary_date){
            $this->tables = array('leave');
            $proceed = TRUE;
        }
        if($proceed == true){
            $this->fields           = array('distinct type');
            $this->conditions       = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1'));
            $this->condition_values = array($month, $year, $employee);
            $this->query_generate();
        }
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_leave_details_btwn_2_dates($sdate, $edate, $employee) {
        $this->tables = array('leave');
        $this->fields = array('distinct type');
        $this->conditions = array('AND', array('AND', array('BETWEEN', 'date', '\'' . $sdate . '\'', '\'' . $edate . '\''), 'employee = ?', 'status = 1'));
        $this->condition_values = array($employee);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function getLeaveType($employee, $date, $time_from, $time_to) {
        $this->tables = array('leave');
        $this->fields = array('type', 'no_pay');
        $this->conditions = array('AND', 'date = ?', 'employee = ?', 'time_from <= ?', 'time_to >= ?', 'status = 1');
        $this->condition_values = array($date, $employee, (float) $time_from, (float) $time_to);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_leave_max_date($employee, $date, $time_from, $time_to) {
        $this->sql_query = "SELECT max(a.date) as max_date from `leave` a INNER JOIN `leave` b ON a.group_id = b.group_id WHERE 
            b.date = '" . $date . "' AND b.employee = '" . $employee . "' AND b.time_from <= " . (float) $time_from . " AND b.time_to >= " . (float) $time_to . " AND b.status = 1";
        $datas = $this->query_fetch();
        return $datas[0]['max_date'];
    }

    function get_all_leaves_for_report($employee, $month, $year, $type=null, $mode=null) {
        if($mode == 'FOOL'){
            $this->sql_query = "SELECT dt as date FROM (SELECT * FROM (SELECT adddate('".$year."-".$month.".-01', @rownum := @rownum + 1) dt FROM timetable JOIN (SELECT @rownum := -1) r ) temp WHERE MONTH(dt) = ".$month." AND YEAR(dt)=".$year.") temp_date LEFT JOIN timetable t1 ON t1.date=temp_date.dt and t1.employee='".$employee."' and t1.status NOT IN(0,2) where t1.date IS NULL ORDER BY date";
        }else{
            $this->tables = array('leave');
            $this->fields = array('date', 'time_from', 'time_to', 'type');
            $this->conditions = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status=1');
            $this->condition_values = array($employee, $month, $year);
            if($type != null){
                $this->conditions[] = 'type=?';
                $this->condition_values[] = $type;
            }
            $this->order_by = array('date');
            $this->query_generate();
        }
        $datas = $this->query_fetch();
        return $datas;
        
    }

    /*     * ***************************end *******************employee work report details*************************** */

    function distinct_employee() {      //not used
        $this->tables = array('employee');
        $this->fields = array('distinct(username) as uname', 'concat(first_name," ", last_name) as fullname');
        $this->order_by = array('uname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function distinct_years($all_year = null) {

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
            return $datas;
        }
    }

    function distinct_years_appointment() {
        $this->tables = array('customer_appoiments');
        $this->fields = array('distinct(year(appoiment_date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function employee_pdf_report($dataset, $emp_name, $month, $year, $r_heading, $r_sub_head, $col_heading, $total_cap) {
        $pdf = new PDF();
        //$header = array('Date', 'Work', 'Customer', 'Normal', 'Travel', 'Break', 'Total Hour');
        $pdf->AddPage();
        //$pdf->SetFont('Arial','B',8); 
        $pdf->report_Header($r_heading);
        $pdf->SubHeading($r_sub_head, $emp_name, $month, $year);
        $pdf->FancyTable($col_heading, $dataset, $total_cap);
        //$pdf->Footer();
        $pdf->Output();
    }

    function distinct_log_years() {
        $this->tables = array('log_login');
        $this->fields = array('distinct(year(login_time))as years1');
        $this->order_by = array('years1 desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function employee_log_report($employee, $year, $month) {
        $this->tables = array('log_login', 'employee');
        $this->fields = array('log_login.ip as ip', 'log_login.browser as browser', 'log_login.username as empid', "concat(employee.first_name,' ',employee.last_name) as empname", 'date(log_login.login_time) as lin_date', 'time(log_login.login_time) as lin_time', 'time(log_login.logout_time) as lof_time', 'TIMEDIFF(log_login.logout_time,log_login.login_time) as total_time');
        $this->conditions = array('AND', 'month(log_login.login_time)= ?', 'year(log_login.login_time)= ?', 'log_login.username like employee.username');
        $this->condition_values = array($month, $year);
        if ($employee != 'all') {
            $this->conditions[] = 'log_login.username like ?';
            $this->condition_values[] = $employee;
        }
        $this->order_by = array('date(log_login.login_time) desc', 'log_login.username asc', 'time(log_login.login_time) desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    // checks whether the employees of two shift can interchange
    function employee_swap($id1, $id2) {
        require_once ('plugins/message.class.php');
        $equipment = new equipment();
        $obj_sms = new sms('');
        $smarty = new smartySetup(array("messages.xml", "mail.xml"),FALSE);
        $slot_det1 = $this->customer_employee_slot_details($id1);
        $slot_det2 = $this->customer_employee_slot_details($id2);
        $msg = new message();
        if ($slot_det1['employee'] != $slot_det2['employee']) {

            $operation_flag = TRUE;
            //checking user2 is suitable for user1's shift
            $process_params = array(
                'employee' => $slot_det2['employee'],
                'customer' => $slot_det1['customer'],
                'date' => $slot_det1['date'],
                'time_from' => $slot_det1['time_from'],
                'time_to' => $slot_det1['time_to']);

            if (!$this->findout_slot_alteration_bug($process_params)) {
                $operation_flag = FALSE;
                return FALSE;
            }
            //checking user1 is suitable for user2's shift
            $process_params = array(
                'employee' => $slot_det1['employee'],
                'customer' => $slot_det2['customer'],
                'date' => $slot_det2['date'],
                'time_from' => $slot_det2['time_from'],
                'time_to' => $slot_det2['time_to']);

            if (!$this->findout_slot_alteration_bug($process_params)) {
                $operation_flag = FALSE;
                return FALSE;
            }

            /*
              //checking user1 is suitable for user2's shift
              $this->tables = array('timetable');
              $this->fields = array('id', 'date', 'time_from', 'time_to', 'employee', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
              $this->conditions = array('AND',
              array('AND', 'id != ?', 'date = ?', 'employee = ?'),
              array('OR',
              array('AND', 'time_from >= ?', 'time_from < ?'),
              array('AND', 'time_to > ?', 'time_to <= ?'),
              array('AND', 'time_from <= ?', 'time_to >= ?')
              )
              );
              $this->condition_values = array($slot_det1['id'], $slot_det2['date'], $slot_det1['employee'],
              $slot_det2['time_from'], $slot_det2['time_to'],
              $slot_det2['time_from'], $slot_det2['time_to'],
              $slot_det2['time_from'], $slot_det2['time_to']
              );

              $this->query_generate();
              $datas = $this->query_fetch();
              if (count($datas)) {
              $msg->set_message('fail', 'slot_collide');
              $msg->set_message_exact('fail', $datas[0]['emp_last_name'] . ' ' . $datas[0]['emp_first_name'] . ' ' . $datas[0]['date'] . ' ' . str_pad($datas[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($datas[0]['time_to'], 5, '0', STR_PAD_LEFT));
              return false;
              } else if ($this->chk_employee_rpt_signed($slot_det1['employee'], $slot_det2['date']) == 1) {
              $msg->set_message('fail', 'employee_signed_in');
              $msg->set_message_exact('fail', $slot_det1['emp_last_name'] . ' ' . $slot_det1['emp_first_name'] . '=>' . $slot_det2['date']);
              return false;
              } else {
              //checking user2 is suitable for user1's shift
              $this->tables = array('timetable');
              $this->fields = array('id', 'date', 'time_from', 'time_to', 'employee', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
              $this->conditions = array('AND', array('AND', 'id != ?', 'date = ?', 'employee = ?'),
              array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
              array('AND', 'time_to > ?', 'time_to <= ?'),
              array('AND', 'time_from <= ?', 'time_to >= ?')
              )
              );

              $this->condition_values = array($slot_det2['id'], $slot_det1['date'], $slot_det2['employee'],
              $slot_det1['time_from'], $slot_det1['time_to'],
              $slot_det1['time_from'], $slot_det1['time_to'],
              $slot_det1['time_from'], $slot_det1['time_to']
              );

              $this->query_generate();

              $datas = $this->query_fetch();
              if (count($datas)) {
              $msg->set_message('fail', 'slot_collide');
              $msg->set_message_exact('fail', $datas[0]['emp_last_name'] . ' ' . $datas[0]['emp_first_name'] . ' ' . $datas[0]['date'] . ' ' . str_pad($datas[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($datas[0]['time_to'], 5, '0', STR_PAD_LEFT));
              return false;
              } else if ($this->chk_employee_rpt_signed($slot_det2['employee'], $slot_det1['date']) == 1) {
              $msg->set_message('fail', 'employee_signed_in');
              $msg->set_message_exact('fail', $slot_det2['emp_last_name'] . ' ' . $slot_det2['emp_first_name'] . '=>' . $slot_det1['date']);
              return false;
              } else { */
            $this->tables = array('timetable');
            $this->fields = array('employee');
            $this->field_values = array($slot_det2['employee']);
            $this->conditions = array('id=?');
            $this->condition_values = array($slot_det1['id']);
            if ($this->query_update()) {
                $this->tables = array('timetable');
                $this->fields = array('employee');
                $this->field_values = array($slot_det1['employee']);
                $this->conditions = array('id=?');
                $this->condition_values = array($slot_det2['id']);
                if ($this->query_update()) {
                    $msg->set_message('success', 'swap_success');
                    /* $atl1 = $this->checkATL($slot_det1['emp_first_name']. ' '. $slot_det1['emp_last_name'], $slot_det2['date'], $slot_det2['time_from'], $slot_det2['time_to'], $id2);
                      $atl2 = $this->checkATL($slot_det2['emp_first_name']. ' '. $slot_det2['emp_last_name'], $slot_det1['date'], $slot_det1['time_from'], $slot_det1['time_to'], $id1);
                      if (!$atl1 && !$atl2) {
                      $msg->set_message_exact('warning', 'ATL varning=>' . $atl1 . ' , ' . $atl2);
                      } else if (!$atl1) {
                      $msg->set_message_exact('warning', 'ATL varning=>' . $atl1);
                      } else if (!$atl2) {
                      $msg->set_message_exact('warning', 'ATL varning=>' . $atl2);
                      } */
                    $mail_sms_notification1 = $equipment->get_notification_employee($slot_det1['employee']);
                    $mail_sms_notification2 = $equipment->get_notification_employee($slot_det2['employee']);
                    $emp_detail1 = $this->employee_detail_main($slot_det1['employee']);
                    $emp_detail2 = $this->employee_detail_main($slot_det2['employee']);
                    $emp_detail_login = $this->employee_detail_main($_SESSION['user_id']);
                    if ($mail_sms_notification1['byte_mob'] == 1) {
                        $obj_sms->addRecipient($emp_detail1[0]['mobile']);
                        $obj_sms->message = $emp_detail_login[0]['last_name'] . " " . $emp_detail_login[0]['first_name'] . " " . $smarty->translate[made_the_swap] . "<br>" . trim($emp_detail1[0]['last_name']) . ' ' . trim($emp_detail1[0]['first_name']) . " " . $smarty->translate[is_changed_from] . " " . $slot_det1['date'] . " (" . $slot_det1['time_from'] . "-" . $slot_det1['time_to'] . ") " . $smarty->translate[to] . " " . $slot_det2['date'] . " (" . $slot_det2['time_from'] . "-" . $slot_det2['time_to'] . ") " . $smarty->translate[with] . " " . trim($emp_detail2[0]['last_name']) . ' ' . trim($emp_detail2[0]['first_name']);
                        $obj_sms->send();
                    }
                    if ($mail_sms_notification1['byte_mail'] == 1) {

                        $subject = $smarty->translate[slot_change];
                        $msg_mail = $emp_detail_login[0]['last_name'] . " " . $emp_detail_login[0]['first_name'] . " " . $smarty->translate[made_the_swap] . "<br>" . trim($emp_detail1[0]['last_name']) . ' ' . trim($emp_detail1[0]['first_name']) . " " . $smarty->translate[is_changed_from] . " " . $slot_det1['date'] . " (" . $slot_det1['time_from'] . "-" . $slot_det1['time_to'] . ") " . $smarty->translate[to] . " " . $slot_det2['date'] . " (" . $slot_det2['time_from'] . "-" . $slot_det2['time_to'] . ") " . $smarty->translate[with] . " " . trim($emp_detail2[0]['last_name']) . ' ' . trim($emp_detail2[0]['first_name']);
//                                $msg_mail = $smarty->translate[swap_occured_with]." ".$emp_detail2[0]['last_name']." ".$emp_detail2[0]['first_name']."(".$slot_det2['time_from']."-".$slot_det2['time_to'].")";
                        $mailer = new SimpleMail($subject, $msg_mail);
                        $mailer->addSender("cirrus-noreplay@time2view.se");
                        $mailer->addRecipient($emp_detail1[0]['email'], trim($emp_detail1[0]['last_name']) . ' ' . trim($emp_detail1[0]['first_name']));
                        $mailer->send();
                    }
                    if ($mail_sms_notification2['byte_mob'] == 1) {
                        $obj_sms->addRecipient($emp_detail2[0]['mobile']);
                        $obj_sms->message = $emp_detail_login[0]['last_name'] . " " . $emp_detail_login[0]['first_name'] . " " . $smarty->translate[made_the_swap] . "<br>" . trim($emp_detail2[0]['last_name']) . ' ' . trim($emp_detail2[0]['first_name']) . " " . $smarty->translate[is_changed_from] . " " . $slot_det2['date'] . " (" . $slot_det2['time_from'] . "-" . $slot_det2['time_to'] . ") " . $smarty->translate[to] . " " . $slot_det1['date'] . " (" . $slot_det1['time_from'] . "-" . $slot_det1['time_to'] . ") " . $smarty->translate[with] . " " . trim($emp_detail2[0]['last_name']) . ' ' . trim($emp_detail2[0]['first_name']);
                        $obj_sms->send();
                    }
                    if ($mail_sms_notification2['byte_mail'] == 1) {
                        $subject = $smarty->translate[slot_change];
                               // $msg_mail = $smarty->translate[swap_occured_with]." ".$emp_detail1[0]['last_name']." ".$emp_detail1[0]['first_name']."(".$slot_det1['time_from']."-".$slot_det1['time_to'].")";
                        $msg_mail = $emp_detail_login[0]['last_name'] . " " . $emp_detail_login[0]['first_name'] . " " . $smarty->translate[made_the_swap] . "<br>" . trim($emp_detail2[0]['last_name']) . ' ' . trim($emp_detail2[0]['first_name']) . " " . $smarty->translate[is_changed_from] . " " . $slot_det2['date'] . " (" . $slot_det2['time_from'] . "-" . $slot_det2['time_to'] . ") " . $smarty->translate[to] . " " . $slot_det1['date'] . " (" . $slot_det1['time_from'] . "-" . $slot_det1['time_to'] . ") " . $smarty->translate[with] . " " . trim($emp_detail2[0]['last_name']) . ' ' . trim($emp_detail2[0]['first_name']);
                        $mailer = new SimpleMail($subject, $msg_mail);
                        $mailer->addSender("cirrus-noreplay@time2view.se");
                        $mailer->addRecipient($emp_detail2[0]['email'], trim($emp_detail1[0]['last_name']) . ' ' . trim($emp_detail1[0]['first_name']));

                        $mailer->send();
                    }
                    return true;
                } else {
                    $msg->set_message('fail', 'swaping_failed');
                    return false;
                }
            } else {
                $msg->set_message('fail', 'swaping_failed');
                return false;
            }
            /* }
              } */
        } else {
            $msg->set_message('fail', 'swap_emp_should_be_different');
            return false;
        }
    }

    /// setting up slot type fkkkn
    function employee_fkkn_update($id, $type) {
        $this->tables = array('timetable');
        $this->fields = array('fkkn');
        $this->field_values = array($type);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    //direct priliminary settings
    function employee_direct_preliminary_update($id, $type) {
        $slot_det = $this->customer_employee_slot_details($id);
        $this->tables = array('timetable');
        $this->fields = array('status');
        if ($type == 3) {
            $this->field_values = array($type);
        } else {
            if ($slot_det['customer'] == '' || $slot_det['employee'] == '')
                $this->field_values = array('0');
            else
                $this->field_values = array('1');
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    /*     * ********************************shamsu *********employee monthly report*********start********* */

    function employee_signing_Transaction() {

       // $employee->username = $report_employee;
       // $employee->signing_report_date = $year.'-'.$month.'-1';
        $login_user = $_SESSION['user_id'];
        $user = new user();
        $login_user_role = $user->user_role($login_user);
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $employee_sign = $tl_sign = $sutl_sign = '';
        $employee_ocs = $tl_ocs = $sutl_ocs = '';
        if ($login_user_role == 1) {
           // $this->signing_employee = $this->signing_suTL_employee = $this->signing_TL_employee = $login_user;
           // $this->signing_employee_date = $this->signing_suTL_date = $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
           // $this->employee_sign = $this->tl_sign = $this->sutl_sign = $this->signauture;
           // $this->employee_ocs = $this->tl_ocs = $this->sutl_ocs = $this->ocs;
            $this->signing_suTL_employee = $this->signing_TL_employee = $login_user;
            $this->signing_suTL_date = $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
            $this->tl_sign = $this->sutl_sign = $this->signauture;
            $this->tl_ocs = $this->sutl_ocs = $this->ocs;
            if($login_user == $this->username){
                $this->signing_employee = $login_user;
                $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
                $this->employee_sign = $this->signauture;
                $this->employee_ocs = $this->ocs;
            }
        } else {
            if ($login_user == $this->username) {
                $this->signing_employee = $login_user;
                $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
                $this->employee_sign = $this->signauture;
                $this->employee_ocs = $this->ocs;
            }
            
            if ($user->check_SuperTL_or_not_from_team($login_user, $this->rpt_customer)) {
                $this->signing_suTL_date = $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
                $this->signing_suTL_employee = $this->signing_TL_employee = $login_user;
                $this->sutl_sign = $this->tl_sign = $this->signauture;
                $this->sutl_ocs = $this->tl_ocs = $this->ocs;
            }
            else if ($user->get_customers_in_which_am_TL($login_user, $this->rpt_customer)) {
                $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
                $this->signing_TL_employee = $login_user;
                $this->tl_sign = $this->signauture;
                $this->tl_ocs = $this->ocs;
            }
        }

        $sign_data = $this->employee_signing_existance_check_simple();
        if (!empty($sign_data)) {
            if ($sign_data['signin_employee'] != '') {
                if ($sign_data['signin_employee'] != $this->username) {
                    $this->signing_employee = $this->username;
                    $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
                    $this->employee_sign = $this->signauture;
                    $this->employee_ocs = $this->ocs;
                } else {
                    $this->signing_employee = $sign_data['signin_employee'];
                    $this->signing_employee_date = $sign_data['signin_date'];
                    $this->employee_sign = $sign_data['employee_sign'];
                    $this->employee_ocs = $sign_data['employee_ocs'];
                }
            }
            if ($sign_data['signin_sutl'] != '') {
                $this->signing_suTL_date = $sign_data['signin_sutl_date'];
                $this->signing_suTL_employee = $sign_data['signin_sutl'];
                $this->sutl_sign = $sign_data['sutl_sign'];
                $this->sutl_ocs = $sign_data['sutl_ocs'];
            }
            if ($sign_data['signin_tl'] != '') {
                $this->signing_TL_date = $sign_data['signin_tl_date'];
                $this->signing_TL_employee = $sign_data['signin_tl'];
                $this->tl_sign = $sign_data['tl_sign'];
                $this->tl_ocs = $sign_data['tl_ocs'];
            }
            return $this->employee_signing_update($sign_data['id']);
        } else if ($this->employee_signing_insert()) {
            return TRUE;
        }
        else
            return FALSE;
    }

    function employee_signing_insert() {

        $this->tables = array('report_signing');
        $this->fields = array('employee', 'customer', 'date', 'signin_employee', 'signin_date', 'employee_sign', 'employee_ocs', 'signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs', 'signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs');
        $this->field_values = array($this->username, $this->rpt_customer, $this->signing_report_date, $this->signing_employee, $this->signing_employee_date, $this->employee_sign, $this->employee_ocs, $this->signing_TL_employee, $this->signing_TL_date, $this->tl_sign, $this->tl_ocs, $this->signing_suTL_employee, $this->signing_suTL_date, $this->sutl_sign, $this->sutl_ocs);
        
        if($this->signing_xml_storage && $this->signing_xml != NULL){
            $this->fields[] = 'xml';
            $this->field_values[] = $this->signing_xml;
        }
        if($this->query_insert()){
            $last_insert_id = $this->get_id();
            $this->tables = array('report_signing_details');
            $this->fields = array('signing_id', 'employee_sign', 'employee_ocs', 'tl_sign', 'tl_ocs', 'sutl_sign', 'sutl_ocs');
            $this->field_values = array($last_insert_id, $this->employee_sign, $this->employee_ocs, $this->tl_sign, $this->tl_ocs, $this->sutl_sign, $this->sutl_ocs);
           
            return $this->query_insert();
        }
    }
   
    function employee_signing_update($id) {
         //echo "<pre>";print_r($employee);
        $this->tables = array('report_signing');
        $this->fields = array('signin_employee', 'signin_date', 'employee_sign', 'employee_ocs','signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs', 'signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs');
        $this->field_values = array($this->signing_employee, $this->signing_employee_date, $this->employee_sign, $this->employee_ocs, $this->signing_TL_employee, $this->signing_TL_date, $this->tl_sign, $this->tl_ocs, $this->signing_suTL_employee, $this->signing_suTL_date, $this->sutl_sign, $this->sutl_ocs);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
       // $this->conditions = array('AND', 'employee = ?', 'date = ?');
       // $this->condition_values = array($this->username, $this->signing_report_date);
        
        return $this->query_update();
    }

    function employee_signing_remove($type = NULL) {
        $this->flush();
        if ($type == NULL) {          //if no $type, then delete entire row
            
            $this->tables = array('report_signing');
            $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
            $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date);
            if($this->query_delete()){
                //remove employer signing details if any
                $this_month = date('m', strtotime($this->signing_report_date));
                $this_year  = date('Y', strtotime($this->signing_report_date));
                $employer_signing_details_fk = $this->employer_signing_details_for_remove($this->rpt_customer, $this_month, $this_year, 1, $this->username);
                $employer_signing_details_kn = $this->employer_signing_details_for_remove($this->rpt_customer, $this_month, $this_year, 2, $this->username);
                if (!empty($employer_signing_details_fk) && !empty($employer_signing_details_fk[0]['employee_data'])){ 
                    $this->flush();
                    $this->tables = array('signing_employer_data');
                    $this->fields = array('master_id');
                    $this->conditions = array('AND', 'master_id = ?', 'employee = ?');
                    $this->condition_values = array($employer_signing_details_fk[0]['id'], $this->username);
                    if ($this->query_delete()) {
                        //remove entire employer signing data if all none of employees exists
                        $after_result = $this->employer_signing_details_for_remove($this->rpt_customer, $this_month, $this_year, 1);
                        if (empty($after_result[0]['employee_data'])) {
                            $this->tables = array('signing_employer');
                            $this->conditions = array('AND', 'id = ?');
                            $this->condition_values = array($employer_signing_details_fk[0]['id']);
                            $out_flag = ($this->query_delete() ? TRUE : FALSE);
                        }
                    }
                }
                if (!empty($employer_signing_details_kn) && !empty($employer_signing_details_kn[0]['employee_data'])){ 
                    $this->flush();
                    $this->tables = array('signing_employer_data');
                    $this->fields = array('master_id');
                    $this->conditions = array('AND', 'master_id = ?', 'employee = ?');
                    $this->condition_values = array($employer_signing_details_kn[0]['id'], $this->username);
                    if ($this->query_delete()) {
                        //remove entire employer signing data if all none of employees exists
                        $after_result = $this->employer_signing_details_for_remove($this->rpt_customer, $this_month, $this_year, 2);
                        if (empty($after_result[0]['employee_data'])) {
                            $this->tables = array('signing_employer');
                            $this->conditions = array('AND', 'id = ?');
                            $this->condition_values = array($employer_signing_details_kn[0]['id']);
                            $out_flag = ($this->query_delete() ? TRUE : FALSE);
                        }
                    }
                }
                
                
                //store deleted signing details to another table
                $this->tables = array('report_signing_delete');
                $this->fields = array('employee', 'customer', 'report_date','deleted_by');
                $this->field_values = array($this->username, $this->rpt_customer, $this->signing_report_date,$_SESSION['user_id']);
                $this->query_insert();
                return TRUE;
                
            }
        } else {
            if ($type == 1) {
                $this->fields = array('signin_employee', 'signin_date');
            } else if ($type == 2) {
                $this->fields = array('signin_tl', 'signin_tl_date');
            } else if ($type == 3) {
                $this->fields = array('signin_sutl', 'signin_sutl_date');
            }
            else
                return FALSE;

            $this->tables = array('report_signing');
            $this->field_values = array(NULL, '0000-00-00 00:00:00');
            $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
            $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date);
            return $this->query_update();
        }
    }

    function employee_signing_remove_by_user_login($rpt_employee, $month, $year, $rpt_customer) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: employee signing remove using logined employee role
         * working: delete signing entries only if each entries they signed
         * used in: customer work report -> employer signing remove
         */
        $this->tables = array('report_signing');
        $this->fields = array('signin_employee', 'signin_tl', 'signin_sutl');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'YEAR(date) = ?', 'MONTH(date) = ?');
        $this->condition_values = array($rpt_employee, $rpt_customer, $year, $month);
        $this->query_generate();
        $signin_data = $this->query_fetch();
        if (empty($signin_data))
            return TRUE;
        else {
            $login_user = $_SESSION['user_id'];
            $login_user_role = $_SESSION['user_role'];
            $delete_flag = TRUE;
            $this->tables = array('report_signing');
            $this->fields = $this->field_values = array();

            if ($login_user_role != 1 && $login_user_role != 6) {
                if ($signin_data[0]['signin_employee'] == $login_user) {
                    $this->fields[] = 'signin_employee';
                    $this->field_values[] = '';
                    $this->fields[] = 'signin_date';
                    $this->field_values[] = '0000-00-00 00:00:00';
                } else if ($signin_data[0]['signin_employee'] != '')
                    $delete_flag = FALSE;

                if ($signin_data[0]['signin_tl'] == $login_user) {
                    $this->fields[] = 'signin_tl';
                    $this->field_values[] = '';
                    $this->fields[] = 'signin_tl_date';
                    $this->field_values[] = '0000-00-00 00:00:00';
                } else if ($signin_data[0]['signin_tl'] != '')
                    $delete_flag = FALSE;

                if ($signin_data[0]['signin_sutl'] == $login_user) {
                    $this->fields[] = 'signin_sutl';
                    $this->field_values[] = '';
                    $this->fields[] = 'signin_sutl_date';
                    $this->field_values[] = '0000-00-00 00:00:00';
                } else if ($signin_data[0]['signin_sutl'] != '')
                    $delete_flag = FALSE;
            }
            
            $this->fields           = array('signin_tl','signin_tl_date','tl_sign','tl_ocs','signin_sutl','signin_sutl_date','sutl_sign','sutl_ocs');
            $this->field_values     = array('',NULL,'','','',NULL,'','');
            $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'YEAR(date) = ?', 'MONTH(date) = ?');
            $this->condition_values = array($rpt_employee, $rpt_customer, $year, $month);
            if ($delete_flag){
                if($this->query_update()){
                    $this->tables = array('report_signing_delete');
                    $this->fields = array('employee', 'customer', 'report_date','deleted_by');
                    $this->field_values = array($rpt_employee, $rpt_customer, $year."-".$month."-01",$_SESSION['user_id']);
                    return $this->query_insert();
                }
                return FALSE;
            }
            else
                return $this->query_update();
        }
    }

    function employee_signing_existance_check() {

        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $flg = FALSE;
        $isGL = FALSE;
        if ($login_user_role == 7) {
            if ($user->check_SuperTL_or_not_from_team($login_user, $this->rpt_customer)){  // to check atleast onentry with he is SuTL in Team table
                $flg = TRUE;
                $isGL = TRUE;
            }
            else if ($user->get_customers_in_which_am_TL($login_user, $this->rpt_customer))    // to check atleast onentry with he is TL in Team table
                $flg = TRUE;
        }else if ($login_user_role == 2) {
            if ($user->get_customers_in_which_am_TL($login_user, $this->rpt_customer))    // to check atleast onentry with he is TL in Team table
                $flg = TRUE;
        }
        $this->tables = array('report_signing');
        $this->fields = array('signin_employee', 'signin_date', 'signin_tl', 'signin_sutl');
        // $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
        // $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date);
        switch ($login_user_role) {
            case 1:
            case 6:
               // $this->conditions = array('AND', 'employee = ?', 'date = ?', array('AND', 'signin_employee != ""', 'signin_tl != ""', 'signin_sutl != ""'));
                $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
                $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date);
                break;
            case 2:
                if ($flg) {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee != ?', 'signin_employee IS NOT NULL', 'signin_tl != ?', 'signin_tl IS NOT NULL');
                    // $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, $login_user);
                    $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, '', '');
                } else {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee != ?', 'signin_employee IS NOT NULL');
                    // $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, $login_user);
                    $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, '');
                }
                break;
            case 3:
                $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee = ?');
                $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, $login_user);
                break;
            case 7:
                if ($isGL) {
                    // $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee != ?', 'signin_employee IS NOT NULL', 'signin_sutl != ?', 'signin_sutl IS NOT NULL', 'signin_tl != ?', 'signin_tl IS NOT NULL');
                    // $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, '', '', '');
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
                    $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date);
                } else if ($flg) {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee != ?', 'signin_employee IS NOT NULL', 'signin_tl != ?', 'signin_tl IS NOT NULL');
                    // $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee != ?', 'signin_employee IS NOT NULL', 'signin_sutl != ?', 'signin_sutl IS NOT NULL');
                    // $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, $login_user);
                    $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, '', '');
                } else {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?', 'signin_employee != ?', 'signin_employee IS NOT NULL');
                    // $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, $login_user);
                    $this->condition_values = array($this->username, $this->rpt_customer, $this->signing_report_date, '');
                }
                break;
        }

        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            if (($login_user_role == 1 || $isGL || $login_user_role == 6) && (trim($data[0]['signin_employee']) == '' || trim($data[0]['signin_tl']) == '' || trim($data[0]['signin_sutl']) == ''))
                return 2;
            else
                return 1;
        }
        else
            return 0;
    }

    function employee_signing_existance_check_simple() {

        $this->tables = array('report_signing');
        $this->fields = array('id', 'employee', 'customer', 'date', 'signin_employee', 'signin_date', 'employee_sign', 'employee_ocs','signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs', 'signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'customer = ?');
        $this->condition_values = array($this->username, $this->signing_report_date, $this->rpt_customer);
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data[0] : FALSE;
    }

    function get_employees_in_a_Team($customer_name) {      //not used
        $this->tables = array('employee` as `e', 'team` as `t');
        $this->fields = array('distinct(t.employee) as uname', 'concat(e.first_name," ", e.last_name) as fullname');
        $this->conditions = array('AND', 't.customer = ?', 't.employee like e.username');
        $this->condition_values = array($customer_name);
        $this->order_by = array('fullname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    /*     * *********************end***********shamsu ****************** */

    /*   ------------------------------shaju---------------------------   */
    function copy_multiple_slot_to_multiple($slots, $from_wk, $to_wk, $from_option, $with_user, $days, $cur_date) {
        require_once ('plugins/message.class.php');
        $msg = new message();
        $dona = new dona();

        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }
        $from_wk = str_pad($from_wk, 2, '0', STR_PAD_LEFT);
        $to_wk = str_pad($to_wk, 2, '0', STR_PAD_LEFT);

        $first_slot_date = $slots[0]['date'];
        $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_wk . '1'));
        $paste_year = substr($to_wk, 0, 4);
        $paste_week = str_pad(substr($to_wk, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
        $copiable = true;
        $paste_date = $paste_start_date;
        if ($with_user == 1) {

            while (strtotime($paste_date) <= strtotime($paste_end_date)) {

                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    foreach ($slots as $data) {

                        $process_params = array(
                            'employee' => $data['employee'],
                            'customer' => $data['customer'],
                            'date' => $paste_date,
                            'type' => $data['type'],
                            'time_from' => $data['time_from'],
                            'time_to' => $data['time_to']);

                        if (!$this->findout_slot_alteration_bug($process_params)) {
                            $copiable = false;
                            return false;
                        }
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            $this->begin_transaction();
            $paste_date = $paste_start_date;
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    if ($with_user == 1) {
                        foreach ($slots as $data) {

                            if (!$dona->customer_employee_slot_add($data['employee'], $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                $msg->set_message('fail', 'insertion_failed');
                                $this->rollback_transaction();
                                $copiable = false;
                                return false;
                            }
                        }
                    } else {
                        foreach ($slots as $data) {
                            if (!$dona->customer_employee_slot_add('', $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                $msg->set_message('fail', 'insertion_failed');
                                $this->rollback_transaction();
                                $copiable = false;
                                return false;
                            }
                        }
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            $msg->set_message('success', 'copy_success');
            $this->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'insertion_failed');
            $this->rollback_transaction();
            return false;
        }
    }

    function copy_single_slot_to_multiple($id, $from_wk, $to_wk, $from_option, $with_user, $days) {
        require_once ('plugins/message.class.php');
        $msg = new message();
        $dona = new dona();

        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }

        $data = $this->customer_employee_slot_details($id);
        $paste_start_date = '';


        if (date('W', strtotime($data['date'])) == $from_wk) {
            $paste_start_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($data['date'])) . ' +1 day'));
        } else {
            $from_wk = str_pad($from_wk, 2, '0', STR_PAD_LEFT);
            $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($data['date'])) . "W" . $from_wk . '1'));
        }

        $paste_year = substr($to_wk, 0, 4);
        $paste_week = str_pad(substr($to_wk, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));

        $copiable = true;
        $paste_date = $paste_start_date;
        if ($with_user == 1) {
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    $process_params = array(
                        'employee' => $data['employee'],
                        'customer' => $data['customer'],
                        'date' => $paste_date,
                        'type' => $data['type'],
                        'time_from' => $data['time_from'],
                        'time_to' => $data['time_to']);

                    if (!$this->findout_slot_alteration_bug($process_params)) {
                        $copiable = false;
                        return false;
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            $this->begin_transaction();
            $paste_date = $paste_start_date;
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    if ($with_user == 1) {

                        if (!$dona->customer_employee_slot_add($data['employee'], $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            $copiable = false;
                            return false;
                        }
                    } else {

                        if (!$dona->customer_employee_slot_add('', $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            $copiable = false;
                            return false;
                        }
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            $msg->set_message('success', 'copy_success');
            $this->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'insertion_failed');
            $this->rollback_transaction();
            return false;
        }
    }

    function get_copy_slots($copy_start, $copy_end, $employees, $days) {

        $emp = '\'' . implode('\', \'', $employees) . '\'';
        $weeks = '\'' . implode('\', \'', $days) . '\'';

        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('AND', array('IN', 'employee', $emp), array('IN', 'status', '1'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /// from process main
    function copy_weeks($copy_start, $copy_end, $paste_start, $paste_end, $no_of_times, $employees, $days, $with_user, $user = '', $unmanned = 0) {
        require_once ('plugins/message.class.php');
        $msg = new message();
        $dona = new dona();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);
        $obj_cust = new customer();
        $smarty = new smartySetup(array('gdschema.xml'),FALSE);
        $obj_copy_paste = new copy_paste();
        $emp = "'";
        $i = 0;
        foreach ($employees as $employee) {
            if ($i != 0)
                $emp .= ",'";
            $emp .= $employee . "'";
            $i++;
        }
        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }

        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($user_role == 4) {
            $this->conditions = array('AND', 'customer = ?', array('IN', 'employee', $emp), array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
            $this->condition_values = array($user);
        } else {
            $this->conditions = array('AND', array('IN', 'employee', $emp), array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas)) {
            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
            $copiable = true;
            if ($with_user == 1) {
                
                if (!$obj_copy_paste->check_given_slots_copiable($datas, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
                    $copiable = false;
                    return false;
                }
            }
            if ($copiable) {
                $this->begin_transaction();
                if ($with_user == 1) {
                    $insert_data_array = array();

                    for ($i = 1; $i <= $no_of_times; $i++) {
                        foreach ($datas as $data) {
                            $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                            $filtered_array = $dona->get_datas_customer_employee_slot_add($data['employee'], $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type']);
                            if (!empty($filtered_array))
                                $insert_data_array[] = $filtered_array;
                        }
                    }
                    if (!$dona->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                        $msg->set_message('fail', 'insertion_failed');
                        $this->rollback_transaction();
                        $copiable = false;
                        return false;
                    }
                } else {
                    $insert_data_array = array();
                    for ($i = 1; $i <= $no_of_times; $i++) {
                        foreach ($datas as $data) {
                            $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                            if ($data['customer'] != '') {
                                $filtered_array = $dona->get_datas_customer_employee_slot_add('', $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type']);
                                if (!empty($filtered_array))
                                    $insert_data_array[] = $filtered_array;
                            }
                        }
                    }
                    if (!empty($insert_data_array)) {
                        if (!$dona->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            $copiable = false;
                            return false;
                        }
                    }
                }
                if ($unmanned == 1) {
                    $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                    $copiable = true;
                    if ($copiable) {
                        $this->tables = array('timetable');
                        $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status');
                        $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee is NULL'), array('IN', 'status', '0,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                        $this->condition_values = array($user, '');
                        $this->order_by = array('date', 'time_from');
                        $this->query_generate();
                        $datas = $this->query_fetch();
                        if (count($datas)) {
                            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                            $insert_data_array = array();

                            for ($i = 1; $i <= $no_of_times; $i++) {
                                foreach ($datas as $data) {
                                    $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                                    if ($data['customer'] != '') {
                                        $filtered_array = $dona->get_datas_customer_employee_slot_add('', $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type']);
                                        if (!empty($filtered_array))
                                            $insert_data_array[] = $filtered_array;
                                    }
                                }
                            }
                            if (!empty($insert_data_array)) {
                                if (!$dona->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                                    $msg->set_message('fail', 'insertion_failed');
                                    $this->rollback_transaction();
                                    $copiable = false;
                                    return false;
                                }
                            }
                        }
                    }
                }
            } else {
                $copiable = false;
                $msg->set_message('fail', 'slot_collide');
                return false;
            }
            if ($copiable) {
                $msg->set_message('success', 'copy_success');
                $copy_message = '';
                if ($user_role == 4) {
                    $cust_details = $obj_cust->customer_detail($user);
                    $copy_message = ' ' . $cust_details['last_name'] . ' ' . $cust_details['first_name'] . ' =>';
                }
                $copy_message .= ' ' . substr($copy_start, 0, 10) . ' - ' . substr($copy_end, 0, 10) . ' ' . $smarty->translate['to'] . ' ' . substr($paste_start, 0, 10) . ' - ' . substr($paste_end, 0, 10);
                $msg->set_message_exact('success', $copy_message);
                $this->commit_transaction();
                return true;
            } else {
                $msg->set_message('fail', 'insertion_failed');
                $this->rollback_transaction();
                return false;
            }
        } else {
            if ($unmanned == 1) {
                $copiable = true;
                if ($copiable) {
                    $this->tables = array('timetable');
                    $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status');
                    $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee is NULL'), array('IN', 'status', '0,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                    $this->condition_values = array($user, '');
                    $this->order_by = array('date', 'time_from');
                    $this->query_generate();
                    $datas = $this->query_fetch();
                    if (count($datas)) {
                        $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                        $this->begin_transaction();
                        $insert_data_array = array();
                        for ($i = 1; $i <= $no_of_times; $i++) {
                            foreach ($datas as $data) {
                                $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                                if ($data['customer'] != '') {
                                    $filtered_array = $dona->get_datas_customer_employee_slot_add('', $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type']);
                                    if (!empty($filtered_array))
                                        $insert_data_array[] = $filtered_array;
                                }
                            }
                        }
                        if (!empty($insert_data_array)) {
                            if (!$dona->customer_employee_multiple_slot_direct_add($insert_data_array)) {
                                $msg->set_message('fail', 'insertion_failed');
                                $this->rollback_transaction();
                                $copiable = false;
                                return false;
                            }
                        }
                        if ($copiable) {
                            $msg->set_message('success', 'copy_success');
                            $cust_details = $obj_cust->customer_detail($user);
                            $copy_message = ' ' . $cust_details['last_name'] . ' ' . $cust_details['first_name'] . ' =>';
                            $copy_message .= ' ' . substr($copy_start, 0, 10) . ' - ' . substr($copy_end, 0, 10) . ' ' . $smarty->translate['to'] . ' ' . substr($paste_start, 0, 10) . ' - ' . substr($paste_end, 0, 10);
                            $msg->set_message_exact('success', $copy_message);
                            $this->commit_transaction();
                            return true;
                        } else {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            return false;
                        }
                    } else {
                        $msg->set_message('fail', 'no_time_slot_exists');
                        return false;
                    }
                }
            } else {
                $msg->set_message('fail', 'no_time_slot_exists');
                return false;
            }
        }
    }

    function delete_weeks($del_start, $del_end, $employees, $days, $in_focus = 0, $user = '', $unmanned = 0) {
        require_once ('plugins/message.class.php');
        $msg = new message();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);
        $obj_cust = new customer();
        $emp = '\'' . implode('\',\'', $employees) . '\'';
        $weeks = '\'' . implode('\',\'', $days) . '\'';

        //get slots inwhich need to delete/update for checking signed or not
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date');
        $this->conditions = array('AND', 'employee != ?', 'employee IS NOT NULL', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
        $this->condition_values = array('');
        if ($in_focus == 1)
            $this->conditions[] = 'status = 1';
        if ($user_role == 4) {
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $user;
        }
        $this->query_generate();
        $alteration_slots = $this->query_fetch();
        $process_flag = TRUE;
        if (!empty($alteration_slots)) {
            foreach ($alteration_slots as $alteration_slot) {
                if ($alteration_slot['employee'] == '' || $alteration_slot['customer'] == '')
                    continue;

                //check signed or not
                if ($this->chk_employee_rpt_signed($alteration_slot['employee'], $alteration_slot['customer'], $alteration_slot['date'], TRUE)) {   //check already signed
                    $process_flag = FALSE;
                    break;
                }
            }
        }
        if (!$process_flag)
            return false;

        $this->flush();
        $this->tables = array('timetable');
        if ($user_role == 4) {
            if ($in_focus == 1) {
                $this->fields = array('employee', 'status');
                $this->field_values = array('', '0');
                $this->conditions = array('AND', 'customer = ?', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks), 'status = 1');
                $this->condition_values = array($user);
                $data = $this->query_update();
            } else {
                $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee is NULL', array('IN', 'employee', $emp)), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                $this->condition_values = array($user, '');
                $data = $this->query_delete();
            }
        } else {
            if ($in_focus == 1) {
                $this->fields = array('employee', 'status');
                $this->field_values = array('', '0');
                $this->conditions = array('AND', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks), 'status = 1');

                $data = $this->query_update();
            } else {
                $this->conditions = array('AND', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                $data = $this->query_delete();
            }
        }
        if ($data) {
            $del_message = '';
            if ($user_role == 4 && $in_focus == 1) {
                $cust_details = $obj_cust->customer_detail($user);
                $del_message = ' ' . $cust_details['last_name'] . ' ' . $cust_details['first_name'] . ' =>';
            }
            $del_message .= ' ' . $del_start . ' - ' . $del_end;
            $msg->set_message('success', 'delete_success');
            $msg->set_message_exact('success', $del_message);
            return true;
        } else {
            $msg->set_message('fail', 'no_time_slot_exists');
            return false;
        }
    }

    function replace_employee($from_date, $to_date, $employee, $employee_rep, $in_focus = 0, $user = '') {
        require_once ('plugins/message.class.php');
        $msg = new message();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status');
        if ($user_role == 4 && $in_focus == 1) {
            $this->conditions = array('AND', 'customer=?', 'employee=?', array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $from_date . '\'', '\'' . $to_date . '\''));
            $this->condition_values = array($user, $employee);
        } else {
            $this->conditions = array('AND', 'employee=?', array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $from_date . '\'', '\'' . $to_date . '\''));
            $this->condition_values = array($employee);
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas)) {
            $copiable = true;
            $ids = "'";
            $i = 0;
            foreach ($datas as $data) {
                if ($i != 0) {
                    $ids .= ",'";
                }
                $ids .= $data['id'] . "'";
                $this->tables = array('timetable');
                $this->fields = array('id', 'time_from', 'time_to', 'date');
                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('NOT IN', 'status', '2'));
                $this->condition_values = array($data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['date'], $employee_rep);
                $this->query_generate();
                $values = $this->query_fetch();

                if (count($values)) {
                    $copiable = false;
                    $msg->set_message('fail', 'slot_collide');
                    $msg->set_message_exact('fail', $data['date'] . ' ' . $data['time_from'] . '-' . $data['time_to'] . '=>' . $values[0]['date'] . ' ' . $values[0]['time_from'] . '-' . $values[0]['time_to']);
                    return false;
                } elseif ($this->chk_employee_rpt_signed($data['employee'], $data['customer'], $data['date'], TRUE)) {
                    $copiable = false;
                    return false;
                }
                $i++;
            }

            if ($copiable) {

                $this->tables = array('timetable');
                $this->fields = array('employee', 'alloc_emp');
                $this->field_values = array($employee_rep, $_SESSION['user_id']);
                $this->conditions = array('IN', 'id', $ids);

                if ($this->query_update()) {
                    $msg->set_message('success', 'replace_success');
                    return true;
                } else {
                    $msg->set_message('fail', 'replace_failed');
                    return false;
                }
            } else {
                $copiable = false;
                $msg->set_message('fail', 'slot_collide');
                return false;
            }
        } else {
            $msg->set_message('fail', 'no_time_slot_exists');
            return false;
        }
    }

    function hex_to_rgb($hex) {

        if ($hex == '')
            $hex = '#FFFFFF';
        $hex = preg_replace("/#/", "", $hex);
        $color = array();

        if (strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(substr($hex, 2, 1) . $b);
        } else if (strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        }
        return $color;
    }
    /*   ------------------------------shaju---------------------------   */

    /*   ----------------start-------------shamsu---------------------------   */
    function exact_employee_list_for_employee_detailed_report($key = NULL) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        if ($key == "A") {
            $condition_for_A = array(
                'last_name NOT LIKE "ä%"',
                'last_name NOT LIKE "å%"',
                'last_name NOT LIKE "ö%"',
                'last_name NOT LIKE "Ä%"',
                'last_name NOT LIKE "Å%"',
                'last_name NOT LIKE "Ö%"'
            );
            $condition_for_keyA = implode(' AND ', $condition_for_A);
        }

        switch ($login_user_role) {

            case 1:
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null)
                    $this->conditions = array('AND', 'status = 1');
                else {
                    if ($key == "A") {
                        $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), $condition_for_keyA);
                    } else {
                        $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    }

                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 2:
                $team_members = $this->team_members_for_employee_report($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null)
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                else {
                    if ($key == "A")
                        $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), $condition_for_keyA);
                    else
                        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 3:
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null) {
                    $this->conditions = array('AND', 'username LIKE ?', 'status = 1');
                    $this->condition_values = array($login_user);
                } else {
                    if ($key == 'A')
                        $this->conditions = array('AND', 'username LIKE ?', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), $condition_for_keyA);
                    else
                        $this->conditions = array('AND', 'username LIKE ?', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 4:
                $this->tables = array('team');
                $this->fields = array('employee');
                $this->conditions = array('customer = ?');
                $this->query_generate();
                $customer_query = $this->sql_query;
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null) {
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1');
                    $this->condition_values = array($login_user);
                } else {
                    if ($key == 'A')
                        $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), $condition_for_keyA);
                    else
                        $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 7:
                $team_members = $this->super_team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null) {
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                } else {
                    if ($key == 'A')
                        $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), $condition_for_keyA);
                    else
                        $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
        }
        return count($employee_data) ? $employee_data : array();
    }

    function team_members_for_employee_detailed_report($cust_username = NULL, $key = NULL) {
        $this->tables = array('team');
        $this->fields = array('DISTINCT employee AS employee');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($cust_username);
        $this->query_generate();
        $emp_query = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
        if ($key == Null) {

            $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1');
            $this->condition_values = array($cust_username);
        } else {
            if ($key == "A") {
                $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"', 'last_name NOT LIKE "å%"', 'last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"', 'last_name NOT LIKE "Å%"', 'last_name NOT LIKE "Ö%"');
            } else {
                $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
            }
            $this->condition_values = array($cust_username, $key . "%", strtolower($key) . "%");
        }
        $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data : array();
    }

    function team_members_for_employee_report($username, $mod = 1) {          //used for employee report, mode is used for chating purpose & mc_leave
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', array('IN', 'role', '2,7'));
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $data = $this->query_fetch(2);

        if (count($data)) {
            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            return $datas;
        } else if ($mod == 2) { //mod = 2 is used only for mc_leave
            return $this->team_members($_SESSION['user_id']);
        } else {
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?', 'role = 3');
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if (count($datas)) {
                $datas = array();
                $datas = array('employee' => $username);
                return $datas;
            } else {
                return array();
            }
        }
    }

    function get_team_customer_names_using_emp_role($username, $user_role = NULL) {

        $data = array();
        $this->tables = array('team');
        $this->fields = array('customer');
        if ($user_role != NULL) {
            $this->conditions = array('AND', 'employee = ?', 'role = ?');
            $this->condition_values = array($username, $user_role);
        } else {
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($username);
        }
        $this->query_generate();
        $data = $this->query_fetch(2);
        return !empty($data) ? $data : array();
    }

    /* get_team_members_using_customer_name is for mc_leave  */
    function get_team_members_using_customer_name($customer) {

        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        $data = $this->query_fetch(2);
        return !empty($data) ? $data : array();
    }

    function update_leave_status($employee = '', $date_from = '', $date_to = '', $time_from = '', $time_to = '', $vikarie_delete_flag = TRUE) {
        /**
         * Author: Shamsu
         * for: Update leave status using leave group ID
         * Updating status for a group of leave
         */
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $today = $dtz->format('Y-m-d H:i:s');

        $this->begin_transaction();
        $this->tables = array('leave');
        $this->fields = array('status', 'appr_emp', 'appr_date');
        $this->field_values = array($this->leave_status, $_SESSION['user_id'], $today);
        $this->conditions = array('group_id = ?');
        $this->condition_values = array($this->leave_id);
        if ($this->query_update()) {
            if ($this->leave_status == 2) {
                $this->tables = array('leave');
                $this->conditions = array('group_id = ?');
                $this->condition_values = array($this->leave_id);
                $this->query_delete();
                $time_table_entries = array();
                $j = 0;
                $date = strtotime($date_from);
               // $leave_start = "";
               // $leave_end = "";
                while ($date <= strtotime($date_to)) {
                    if ($j == 0 && $date == strtotime($date_to)) {
                        //$data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['start_date'],$_REQUEST['time_from'],$_REQUEST['time_to']);
                        $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, $date_from, $time_from, $time_to));
                    } else if ($j == 0) {
                        //$data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['start_date'],$_REQUEST['time_from'],24);
                        $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, $date_from, $time_from, 24));
                    } else if ($j != 0 && $date < strtotime($date_to)) {
                        //$data = $leave->employee_get_leave_slot($_REQUEST['user'],date('Y-m-d',$date),0,24);
                        $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, date('Y-m-d', $date), 0, 24));
                    } else if ($j != 0 && $date == strtotime($date_to)) {
                        //$data = $leave->employee_get_leave_slot($_REQUEST['user'],$_REQUEST['end_date'],0,$_REQUEST['time_to']);
                        $time_table_entries = array_merge($time_table_entries, $this->get_timetable_leave_entries_id($employee, $date_to, 0, $time_to));
                    }

                    $date = strtotime('+1 day', $date);
                    $j++;
                }
                $id_for_updates_status = '\'' . implode('\', \'', $time_table_entries) . '\'';

                if ($this->update_timetable_status_when_leave_cancel_byID($id_for_updates_status)) {  //update timetable status
                    if ($vikarie_delete_flag) {
                        foreach ($time_table_entries as $tt_entry) {
                            $flg = TRUE;
                            //            $r_id = $tt_entry['id'];
                            $r_id = $tt_entry;
                            while ($flg) {
                                $flg = FALSE;
                                $relations = $this->check_relations_in_timetable_for_leave($r_id);
                                if ($relations) {  //check have substitute exist or not?
                                    $time_for_date = explode('.', $relations[0]['time_from']);
                                    $time_for_date_time = strtotime($relations[0]['date'] . ' ' . str_pad($time_for_date[0], 2, '0', STR_PAD_LEFT) . ':' . str_pad($time_for_date[1], 2, '0', STR_PAD_RIGHT) . ':00');
                                    $report_sign_flag = 0;
                                    if ($relations[0]['employee'] != '' && $relations[0]['customer'] != '')
                                        $report_sign_flag = $this->chk_employee_rpt_signed($relations[0]['employee'], $relations[0]['customer'], $relations[0]['date']);
                                    if ($report_sign_flag == 0 && $time_for_date_time > time()) {
                                        if (!$this->delete_timetable_leave_byRelationID($r_id)) {//delete substitutes record
                                            $this->rollback_transaction();
                                            return false;
                                        }
                                    }
                                    $r_id = $relations[0]['id'];
                                    $flg = TRUE;
                                }
                            }
                        }
                    }
                    $this->commit_transaction();
                    return TRUE;
                } else {
                    $this->rollback_transaction();
                    return FALSE;
                }
            } else {
                $this->commit_transaction();
                return TRUE;
            }
        } else {
            //print_r($this->query_error_details);
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function update_leave_status_by_groupIds($group_id, $status) {
        /**
         * Author: Shamsu
         * for: Update leave status using leave group ID array
         * Updating status for a group of leave
         */
        if(empty($group_id)) return TRUE;

        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $today = $dtz->format('Y-m-d H:i:s');

        $this->begin_transaction();
        $this->flush();
        $this->tables = array('leave');
        $this->fields = array('status', 'appr_emp', 'appr_date');
        $this->field_values = array($status, $_SESSION['user_id'], $today);

        // $this_id_string = '\'' . implode('\' , \'', $group_id) . '\'';
        // $this->conditions = array(array('IN', 'group_id', $this_id_string));
        $this->conditions = array('IN', 'group_id', $group_id);
        // $this->conditions = array('group_id = ?');
        // $this->condition_values = array($this->leave_id);
        if ($this->query_update()) {
            $this->commit_transaction();
            return TRUE;
        } else {
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function update_leave_status_by_ID($employee = '', $Ldate = '', $time_from = '', $time_to = '') {
        /**
         * Author: Shamsu
         * created on 2013-03-13
         * for: Update leave status using leave ID
         * Updating a single leave status
         * not in used now (before, it is used from gdschema alloc window)
         */
        $this->begin_transaction();
        $this->tables = array('leave');
        $this->fields = array('status', 'appr_emp', 'appr_date');
        $this->field_values = array($this->leave_status, $_SESSION['user_id'], date("Y-m-d"));
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->leave_id);
        if ($this->query_update()) {
            if ($this->leave_status == 2) {
                $this->tables = array('leave');
                $this->conditions = array('id = ?');
                $this->condition_values = array($this->leave_id);
                $this->query_delete();

                $time_table_entries = $this->get_timetable_leave_entries_id($employee, $Ldate, $time_from, $time_to);
                $id_for_updates_status = '\'' . implode('\', \'', $time_table_entries) . '\'';

                if ($this->update_timetable_status_when_leave_cancel_byID($id_for_updates_status)) {  //update timetable status
                    foreach ($time_table_entries as $tt_entry) {
                        $flg = TRUE;
                        $r_id = $tt_entry;
                        while ($flg) {
                            $flg = FALSE;
                            $relations = $this->check_relations_in_timetable_for_leave($r_id);
                            if ($relations) {  //check have substitute exist or not?
                                if (!$this->delete_timetable_leave_byRelationID($r_id)) {//delete substitutes record
                                    $this->rollback_transaction();
                                    return false;
                                }
                                $r_id = $relations[0]['id'];
                                $flg = TRUE;
                            }
                        }
                    }
                    $this->commit_transaction();
                    return TRUE;
                } else {
                    $this->rollback_transaction();
                    return false;
                }
            } else {
                $this->commit_transaction();
                return TRUE;
            }
        } else {
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function get_leave_details_byID($id, $get_by_group_ID = TRUE) {  //by group ID
        /**
         * Author: Shamsu
         * for: getting All leave details using group ID
         * by default: get data by group ID
         */

        $this->tables = array('leave` as `l', 'employee` as `e', 'employee` as `e1');
//        $this->fields = array('l.id as id', 'l.group_id as gid', 'l.employee as emp_id', "concat(e1.first_name,' ',e1.last_name) as leave_employee", 'l.date as leave_date', 'l.time_from as time_from', 'l.time_to as time_to', 'l.type as type', 'l.appr_date as date', "concat(e.first_name,' ',e.last_name) as empname");
        $this->fields = array('l.id as id', 'l.group_id as gid', 'l.employee as emp_id', "concat(e1.first_name,' ',e1.last_name) as leave_employee", 'l.date as leave_date', 'l.time_from as time_from', 'l.time_to as time_to', 'l.type as type', 'l.appr_date as appr_date', "concat(e.last_name,' ',e.first_name) as appr_empname", 'l.comment as comment');
        if ($get_by_group_ID)
            $this->conditions = array('AND', 'group_id = ?', 'l.appr_emp like e.username', 'l.employee like e1.username');
        else
            $this->conditions = array('AND', 'id = ?', 'l.appr_emp like e.username', 'l.employee like e1.username');
        $this->condition_values = array($id);
        $this->order_by = array('l.date asc');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_signin_details_by_employee($year, $month, $work_employee) {
        //echo $year. $month . $work_employee."<br>";
//        $this->tables = array('report_signing` as `s', 'employee` as `e1', 'employee` as `e2', 'employee` as `e3');
//        $this->fields = array('s.employee as employee', 's.date as date', 's.signin_employee as signin_employee', 
//            'concat(e1.first_name, " ",e1.last_name) as signin_employee_name', 's.signin_date as signin_date', 
//            's.signin_tl as signin_tl', 'concat(e2.first_name, " ",e2.last_name) as signin_tl_name', 
//            's.signin_tl_date as signin_tl_date', 's.signin_sutl as signin_sutl', 'concat(e3.first_name, " ",e3.last_name) as signin_sutl_name', 's.signin_sutl_date as signin_sutl_date');
//        $this->conditions = array('AND', 'year(s.date) = ?','month(s.date) = ?','s.employee = ?','e1.username like s.signin_employee','e2.username like s.signin_tl','e3.username like s.signin_sutl');
//        $this->condition_values = array($year,$month,$work_employee);
////        $this->order_by = array('first_name', 'last_name');
//        $this->query_generate();
//        echo $this->sql_query;
        $this->sql_query = 'SELECT s.employee AS employee, s.date AS date, s.signin_employee AS signin_employee, 
                concat( e1.first_name, " ", e1.last_name ) AS signin_employee_name, s.signin_date AS signin_date, s.signin_tl AS signin_tl, 
                concat( e2.first_name, " ", e2.last_name ) AS signin_tl_name, s.signin_tl_date AS signin_tl_date, s.signin_sutl AS signin_sutl, 
                concat( e3.first_name, " ", e3.last_name ) AS signin_sutl_name, s.signin_sutl_date AS signin_sutl_date
            FROM `report_signing` AS `s`
            LEFT JOIN `employee` AS `e1` ON ( e1.username LIKE s.signin_employee )
            LEFT JOIN `employee` AS `e2` ON ( e2.username LIKE s.signin_tl )
            LEFT JOIN `employee` AS `e3` ON ( e3.username LIKE s.signin_sutl )
            WHERE 1
            AND year( s.date ) = ' . $year . '
            AND month( s.date ) = ' . $month . '
            AND s.employee = \'' . $work_employee . '\'';
        $data = $this->query_fetch(1);
        return $data ? $data : FALSE;
    }

    function get_signin_details_by_employee_customer($year, $month, $work_employee, $work_customer) {

//        $this->tables = array('report_signing` as `s', 'employee` as `e1', 'employee` as `e2', 'employee` as `e3');
//        $this->fields = array('s.employee as employee', 's.date as date', 's.signin_employee as signin_employee', 
//            'concat(e1.first_name, " ",e1.last_name) as signin_employee_name', 's.signin_date as signin_date', 
//            's.signin_tl as signin_tl', 'concat(e2.first_name, " ",e2.last_name) as signin_tl_name', 
//            's.signin_tl_date as signin_tl_date', 's.signin_sutl as signin_sutl', 'concat(e3.first_name, " ",e3.last_name) as signin_sutl_name', 's.signin_sutl_date as signin_sutl_date');
//        $this->conditions = array('AND', 'year(s.date) = ?','month(s.date) = ?','s.employee = ?','e1.username like s.signin_employee','e2.username like s.signin_tl','e3.username like s.signin_sutl');
//        $this->condition_values = array($year,$month,$work_employee);
////        $this->order_by = array('first_name', 'last_name');
//        $this->query_generate();
//        echo $this->sql_query;
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));

        $this->flush();
        if($fromdate <= $boundary_date && $todate > $boundary_date){
            $this->sql_query = 'SELECT s.employee AS employee, s.customer AS customer, s.date AS date, s.signin_employee AS signin_employee, 
                    concat( e1.last_name, " ", e1.first_name ) AS signin_employee_name_lf,concat( e1.first_name, " ", e1.last_name ) AS signin_employee_name, s.signin_date AS signin_date, s.signin_tl AS signin_tl, 
                    concat( e2.last_name, " ", e2.first_name ) AS signin_tl_name_lf,concat( e2.first_name, " ", e2.last_name ) AS signin_tl_name, s.signin_tl_date AS signin_tl_date, s.signin_sutl AS signin_sutl, 
                    concat( e3.last_name, " ", e3.first_name ) AS signin_sutl_name_lf,concat( e3.first_name, " ", e3.last_name ) AS signin_sutl_name, s.signin_sutl_date AS signin_sutl_date,
                    s.employee_sign, s.employee_ocs, s.tl_sign, s.tl_ocs, s.sutl_sign, s.sutl_ocs
                FROM `report_signing` AS `s`
                LEFT JOIN `employee` AS `e1` ON ( e1.username LIKE s.signin_employee )
                LEFT JOIN `employee` AS `e2` ON ( e2.username LIKE s.signin_tl )
                LEFT JOIN `employee` AS `e3` ON ( e3.username LIKE s.signin_sutl )
                WHERE 1
                AND year( s.date ) = ' . $year . ' 
                AND month( s.date ) = ' . $month . ' 
                AND s.employee = \'' . $work_employee . '\' 
                AND s.customer = \'' . $work_customer . '\'';
            $real_table_data = $this->sql_query;

            $this->sql_query = 'SELECT s.employee AS employee, s.customer AS customer, s.date AS date, s.signin_employee AS signin_employee, 
                    concat( e1.last_name, " ", e1.first_name ) AS signin_employee_name_lf,concat( e1.first_name, " ", e1.last_name ) AS signin_employee_name, s.signin_date AS signin_date, s.signin_tl AS signin_tl, 
                    concat( e2.last_name, " ", e2.first_name ) AS signin_tl_name_lf,concat( e2.first_name, " ", e2.last_name ) AS signin_tl_name, s.signin_tl_date AS signin_tl_date, s.signin_sutl AS signin_sutl, 
                    concat( e3.last_name, " ", e3.first_name ) AS signin_sutl_name_lf,concat( e3.first_name, " ", e3.last_name ) AS signin_sutl_name, s.signin_sutl_date AS signin_sutl_date,
                    s.employee_sign, s.employee_ocs, s.tl_sign, s.tl_ocs, s.sutl_sign, s.sutl_ocs
                FROM `backup_report_signing` AS `s`
                LEFT JOIN `employee` AS `e1` ON ( e1.username LIKE s.signin_employee )
                LEFT JOIN `employee` AS `e2` ON ( e2.username LIKE s.signin_tl )
                LEFT JOIN `employee` AS `e3` ON ( e3.username LIKE s.signin_sutl )
                WHERE 1
                AND year( s.date ) = ' . $year . ' 
                AND month( s.date ) = ' . $month . ' 
                AND s.employee = \'' . $work_employee . '\' 
                AND s.customer = \'' . $work_customer . '\'';
            $backup_table_data = $this->sql_query;

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $table   = 'backup_report_signing';
            $proceed = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $table   = 'report_signing';
            $proceed = TRUE;
        }
        if($proceed == true){
            $this->sql_query = 'SELECT s.employee AS employee, s.customer AS customer, s.date AS date, s.signin_employee AS signin_employee, 
                    concat( e1.last_name, " ", e1.first_name ) AS signin_employee_name_lf,concat( e1.first_name, " ", e1.last_name ) AS signin_employee_name, s.signin_date AS signin_date, s.signin_tl AS signin_tl, 
                    concat( e2.last_name, " ", e2.first_name ) AS signin_tl_name_lf,concat( e2.first_name, " ", e2.last_name ) AS signin_tl_name, s.signin_tl_date AS signin_tl_date, s.signin_sutl AS signin_sutl, 
                    concat( e3.last_name, " ", e3.first_name ) AS signin_sutl_name_lf,concat( e3.first_name, " ", e3.last_name ) AS signin_sutl_name, s.signin_sutl_date AS signin_sutl_date,
                    s.employee_sign, s.employee_ocs, s.tl_sign, s.tl_ocs, s.sutl_sign, s.sutl_ocs
                FROM `'.$table.'` AS `s`
                LEFT JOIN `employee` AS `e1` ON ( e1.username LIKE s.signin_employee )
                LEFT JOIN `employee` AS `e2` ON ( e2.username LIKE s.signin_tl )
                LEFT JOIN `employee` AS `e3` ON ( e3.username LIKE s.signin_sutl )
                WHERE 1
                AND year( s.date ) = ' . $year . ' 
                AND month( s.date ) = ' . $month . ' 
                AND s.customer = \'' . $work_customer . '\'
                AND s.employee = \'' . $work_employee . '\' ';
                
               
        }
        
      //  echo $this->sql_query;exit;
        $data = $this->query_fetch(1);
        
       
        return $data ? $data : FALSE;
    }

    function remove_leave_from_leave_tbl($id) {
        /**
         * Author: Shamsu
         * for Deleting leave table entry using leave ID
         */
        $this->tables = array('leave');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete() ? TRUE : FALSE;
    }
    /*   ---------end-------------shamsu---------------------------   */

    function employee_skills($emp) {
        $this->tables = array('employee_skill');
        $this->fields = array('id', 'employee', 'skill', 'description','attachment1','attachment2','attachment3','alloc_emp','exam_date');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->order_by = array('id DESC');
        $this->query_generate();
        $data = $this->query_fetch();
        $result = array();
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $result[$i]['id'] = $data[$i]['id'];
                $result[$i]['employee'] = $data[$i]['employee'];
                $result[$i]['skill'] = $data[$i]['skill'];
                $result[$i]['attachment1'] = $data[$i]['attachment1'];
                $result[$i]['attachment2'] = $data[$i]['attachment2'];
                $result[$i]['attachment3'] = $data[$i]['attachment3'];
                $result[$i]['alloc_emp'] = $data[$i]['alloc_emp'];
                $result[$i]['exam_date'] = substr($data[$i]['exam_date'],0,10);
                $description = explode("\n", $data[$i]['description']);
                for ($j = 0; $j < count($description); $j++) {
                    $result[$i]['description'][$j]['desc'] = $description[$j];
                }
            }
            return $result;
        } else 
            return array();
    }

    function employee_skill_add($skill, $description,$date_of_exam, $emp,$alloc_emp,$file_names = null) {

        // $attachment_feilds = ['attachment1','attachment2','attachment3'];
        $this->tables = array('employee_skill');
        $this->fields = array('employee', 'skill', 'description','alloc_emp','exam_date');
        $this->field_values = array($emp, $skill, $description,$alloc_emp,$date_of_exam);

        if($file_names !=null){
            if(count($file_names) == 1 ){
                $this->fields[]       = 'attachment1';
                $this->field_values[] = $file_names[0];
            }
            if(count($file_names) == 2 ){
                $this->fields       = array_merge($this->fields, array('attachment1','attachment2'));
                $this->field_values = array_merge($this->field_values, array($file_names[0],$file_names[1]));
            }
            if(count($file_names) == 3 ){
                $this->fields       = array_merge($this->fields,array('attachment1','attachment2','attachment3'));
                $this->field_values = array_merge($this->field_values,array($file_names[0],$file_names[1],$file_names[2]));
            }
        }
        
        $data = $this->query_insert();
        return $data ? TRUE : FALSE;
    }

    function delete_employee_skill($id) {
        $this->tables = array('employee_skill');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete() ? TRUE : FALSE;
    }


    function get_employee_skill_by_id($id) {
        $this->flush();
        $this->tables = array('employee_skill');
        $this->fields = array('id', 'employee', 'skill', 'description','attachment1','attachment2','attachment3');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_fetch();
        return $data[0];
    }

    function employee_documents($emp) {
        $this->tables = array('employee_attachment');
        $this->fields = array('id', 'employee', 'documents', 'date','status','alloc_emp');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->order_by = array('id DESC');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function employee_documents_add($emp, $file_name,$alloc_emp) {
        $date = date('Y-m-d H:i:s');
        $this->tables = array('employee_attachment');
        $this->fields = array('employee', 'documents','alloc_emp');
        $this->field_values = array($emp, $file_name,$alloc_emp);
        $data = $this->query_insert();
        return $data ? TRUE : FALSE;
    }

    function get_file_name_employee_attachment($id_attach) {
        $this->tables = array('employee_attachment');
        $this->fields = array('documents');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id_attach);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : FALSE;
    }

    function get_all_files_user($emp) {
        $this->tables = array('employee_attachment');
        $this->fields = array('documents', 'employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }

    function delete_employee_attachment($id) {
        $this->tables = array('employee_attachment');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete() ? TRUE : FALSE;
    }

    function employee_update_self() {
        $this->tables = array('employee');
        $this->fields = array('code', 'social_security', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'ice');
        $this->field_values = array($this->code, $this->social_security, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->ice);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        return $this->query_update() ? TRUE : FALSE;
    }

    function login_update_self() {

        global $preference, $db;
        if ($this->password != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array('' . $db['database_master'] . '.login');
            $this->fields = array('password');
            $this->field_values = array(md5($this->hash . $this->password));
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            return $this->query_update() ? TRUE : FALSE;
        }
        return true;
    }

    function has_privilege($employee, $type) {
        $user = new user();
        $user_role = $user->user_role($employee);
        if ($user_role == 1 || $user_role == 6 || $user_role == 2 || $user_role == 7) {
            return true;
        } else {
            $this->tables = array('privileges');
            if ($type == 'swap') {
                $this->fields = array('swap as type');
            } else if ($type = 'process') {
                $this->fields = array('process as type');
            }
            $this->conditions = array('employee = ?');
            $this->condition_values = array($employee);
            $this->query_generate();
            $data = $this->query_fetch();
            if (!empty($data)) {
                if ($data[0]['type'] == '1') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    function get_privileges($employee, $mod, $customer = '') {
        //mods
        //1. grund schema   2. general  3. message center   4. forms    5. reports
        
        $user = new user();
        $user_role = $user->user_role($employee);
        $tbl_name = '';
        switch ($mod) {
            case 1:
                $this->tables = array('privileges');
                $tbl_name = 'privileges';
                break;
            case 2:
                $this->tables = array('privileges_general');
                $tbl_name = 'privileges_general';
                break;
            case 3:
                $this->tables = array('privileges_mc');
                $tbl_name = 'privileges_mc';
                break;
            case 4:
                $this->tables = array('privileges_forms');
                $tbl_name = 'privileges_forms';
                break;
            case 5:
                $this->tables = array('privileges_reports');
                $tbl_name = 'privileges_reports';
                break;
        }

        if ($user_role == 1 || $user_role == 6) {
            return $this->set_column_default_values($tbl_name, "1");

            /*$field_names = $this->get_column_name($tbl_name);
            $i = 0;
            $data = array();
            foreach ($field_names as $field_name) {
                if ($i == 0) {
                    $i++;
                    continue;
                }
                $data[0][$field_name] = 1;
                $i++;
            }
            if (!empty($data)) {
                return $data[0];
            } else {
                return array();
            }*/
        } else {

            if ($mod == 1) {
                $data = array();
                if ($customer != '') {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?');
                    $this->condition_values = array($employee, $customer);
                    $this->query_generate();
                    $data = $this->query_fetch();

                }
                if (empty($data) || $customer == '') {
                    $this->tables = array($tbl_name);
                    $this->conditions = array('AND', 'employee = ?', array('OR', 'customer = ?', 'customer IS NULL'));
                    $this->condition_values = array($employee, '');
                    $this->query_generate();
                    $data = $this->query_fetch();
                    if (!empty($data)) {
                        return $data[0];
                    } else {
                        return $this->set_column_default_values($tbl_name, "0");
                    }
                } else {
                    return $data[0];
                }
            } else {
                $this->tables = array($tbl_name);
                $this->conditions = array('AND', 'employee = ?');
                $this->condition_values = array($employee);
                $this->query_generate();
                $data = $this->query_fetch();
                if (!empty($data)) {
                    return $data[0];
                } else {
                    return $this->set_column_default_values($tbl_name, "0");
                }
            }
        }
    }

    function set_column_default_values($tbl_name, $default_value = "0"){
        $field_names = $this->get_column_name($tbl_name);
        $i = 0;
        $data = array();
        foreach ($field_names as $field_name) {
            if ($i == 0) {
                $i++;
                continue;
            }
            $data[0][$field_name] = $default_value;
            $i++;
        }
        if (!empty($data)) {
            return $data[0];
        } else {
            return array();
        }
    }

    function get_signed_date($employee) {
        $this->tables = array('report_signing');
        $this->fields = array('max(date) as date');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data))
            return $data[0]['date'];
        else
            return '0000-00-00';
    }

    function get_employee_start_day($employee) {
        $this->tables = array('employee');
        $this->fields = array('start_day');
        $this->conditions = array('username = ?');
        $this->condition_values = array($employee);
        $this->query_generate();

        $datas = $this->query_fetch();
        if (!empty($datas)) {
            if ($datas[0]['start_day'] != '') {
                return $datas[0]['start_day'];
            }
        }
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('start_day');
        $this->conditions = array('id = ?');
        $this->condition_values = array($_SESSION['company_id']);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['start_day'];
    }

    function checkATL($customer, $employee, $date, $time_from, $time_to, $exceptional_ids = '', $remove = 0, $extra_prev_slots = array()) {
        ///////////////// start of ATL laws///////////////////

        if($time_from >= $time_to){
            $status = $this->checkATL($customer, $employee, $date, $time_from, 24, $exceptional_ids);
            if ($status !== true)
                return $status;
            else {
                $extra_prev_slots = $this->order_slots($extra_prev_slots,array(array('customer' => $customer, 'employee=' => $employee, 'time_from' => $time_from, 'time_to' => 24, 'date' => $date)));
                $date = date('Y-m-d', strtotime($date . ' +1 day'));
                $time_from = 0;
            }
                    
        }
        $company = new company();
        $company_detail = $company->get_company_detail($_SESSION['company_id']);
        $time_from = (float) $time_from;
        $time_to = (float) $time_to;
        $employe_data = $this->get_employee_detail($employee);
        $day_time = $this->get_employee_start_day($employee);
        $day = intval(substr($day_time, 0, 1));
        $time = floatval(substr($day_time, 1));
        $day_start = date('Y-m-d H:i:s', strtotime($date . " " . $time . ".0"));
        $day_end = date('Y-m-d H:i:s', strtotime($day_start . ' +1 day'));
        $week_start = date('Y-m-d H:i:s', strtotime(date('o', strtotime($date)) . "W" . date('W', strtotime($date)) . $day) + $time * 60 * 60);
        if (date('N', strtotime($date)) < $day || (date('N', strtotime($date)) == $day && $time_from < $time))
            $week_start = date('Y-m-d H:i:s', strtotime($week_start . ' -7 days'));
        $week_end = date('Y-m-d H:i:s', strtotime($week_start . ' +1 week'));

        if ($time_from < $time) {

            if ($time_to > $time) {
                //$status = $this->checkATL($customer, $employee, $date, $time, $time_to, $exceptional_ids);
                $status = $this->checkATL($customer, $employee, $date, $time_from, $time, $exceptional_ids);

                if ($status !== true)
                    return $status;
                else {
                    //$time_to == $time;
                    $extra_prev_slots = $this->order_slots($extra_prev_slots, array(array('customer' => $customer, 'employee=' => $employee, 'time_from' => $time_from, 'time_to' => $time, 'date' => $date)));

                    //echo "<pre>".print_r($extra_prev_slots, 1)."</pre>";
                    $time_from = $time;
                }
            }else{
                $day_start = date('Y-m-d H:i:s', strtotime($day_start . ' -1 day'));
                $day_end = date('Y-m-d H:i:s', strtotime($day_start . ' +1 day'));
            }
        }
        //echo "Daystart->".$day_start."----Dayend->".$day_end;
        $max_day_hours = $company_detail['max_daily_hour'];
        $min_day_rest = $company_detail['min_daily_rest'];
        $break_time = 24 - $max_day_hours;
        $unconditional_break = 0;/// avoid any break time less than this time
        $week_break = 36;
        $tot_work_hours = 0;
        $atl_flag = 0;
        $output = '';
        //        $msg = new message();
        //checking before dates



        $this->tables = array('timetable');
        $this->fields = array('date', 'time_from', 'time_to', 'customer');
        if ($exceptional_ids == '') {
            $this->conditions = array('AND', 'employee = ?', 'date >= ?', 'date <= ?', 'status = 1');
            $this->condition_values = array($employee, date('Y-m-d', strtotime($week_start)), date('Y-m-d', strtotime($week_end)));
        } else {
            $this->conditions = array('AND', 'employee = ?', 'date >= ?', 'date <= ?', 'id != ?', 'status = 1');
            $this->condition_values = array($employee, date('Y-m-d', strtotime($week_start)), date('Y-m-d', strtotime($week_end)), $exceptional_ids);
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        
        //echo "<pre>".print_r($datas, 1)."</pre>";
        if (count($extra_prev_slots))
            $datas = $this->order_slots($datas, $extra_prev_slots);
        $start_time = mktime((int) $time_from, bcmod($time_from * 100, 100), 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
        $user_work = (int) ($time_to - $time_from) * 60 * 60 + ($time_to - $time_from - (int) ($time_to - $time_from)) * 100 * 60;
        $prev_end_time = strtotime($week_start);
        $prev_end_time_day = strtotime($day_start);
        $interval_day = 0;
        //echo "<pre>".print_r($datas, 1)."</pre>";
        $day_rest_law = 1;
        $day_law = 1;
        $week_law = 1;
        if (empty($datas)) {
            $day_law = 0;
            $week_law = 0;
        }
        $i = 0;
        // echo "<pre>".print_r($datas, 1)."</pre>";
        // echo "-------------------------------------------------";
        $datas = $this->order_slots($datas, array(0 => array('customer' => $customer, 'employee=' => $employee, 'time_from' => $time_from, 'time_to' => $time_to, 'date' => $date)));

        //$tot_work_hours = $user_work;

        //echo "<pre>I am here".print_r($datas, 1)."</pre>";
        $day_flag = 0;

        foreach ($datas as $row_atl) {
            //echo "<pre>".print_r($row_atl, 1)."</pre>";
            $i++;
            $start_time = mktime((int) $row_atl['time_from'], bcmul(bcsub($row_atl['time_from'], (int) $row_atl['time_from'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));
            $end_time = mktime((int) $row_atl['time_to'], bcmul(bcsub($row_atl['time_to'], (int) $row_atl['time_to'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));
            if ($start_time < strtotime($week_start))
                $start_time = strtotime($week_start);
            if ($end_time > strtotime($week_end))
                $end_time = strtotime($week_end);

            if($start_time >= strtotime($week_end))
                break;
            if($end_time <= strtotime($week_start))
                break;

            $interval_week = $start_time - $prev_end_time;
            if ($interval_week >= $week_break * 60 * 60) {
                $week_law = 0;
            }
            
            //echo "<script>alert(\"".date('Y-m-d H:i:s',$day_start)."\")</script>";
            //echo "<script>alert(\"".$day_start."\")</script>";
            //echo "<script>alert(\"".$day_end."\")</script>";

            if (($start_time >= strtotime($day_start) && $start_time <= strtotime($day_end)) || ($end_time >= strtotime($day_start) && $end_time <= strtotime($day_end))) {
                    
                $day_flag = 1;

                $start_time_day = mktime((int) $row_atl['time_from'], bcmul(bcsub($row_atl['time_from'], (int) $row_atl['time_from'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));

                $end_time_day = mktime((int) $row_atl['time_to'], bcmul(bcsub($row_atl['time_to'], (int) $row_atl['time_to'], 2), 100, 2), 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));

                if ($start_time_day < strtotime($day_start))
                    $start_time_day = strtotime($day_start);
                if ($end_time_day > strtotime($day_end))
                    $end_time_day = strtotime($day_end);

                //echo "day_start".$day_start."day_end-".$day_end."start_time-".date('Y-m-d H:i:s', $start_time_day)."end_time-".date('Y-m-d H:i:s', $end_time)."prev_end_time-".date('Y-m-d H:i:s', $prev_end_time_day)."diif-".(($start_time_day - $prev_end_time_day)/3600)."<br>";

                if (($start_time_day - $prev_end_time_day) > ($unconditional_break * 60 * 60))
                    $interval_day += $start_time_day - $prev_end_time_day;
                else {
                    $tot_work_hours += $start_time_day - $prev_end_time_day;
                }
                if ($interval_day >= ($break_time * 60 * 60)) {
                    $day_law = 0;
                }
                if($start_time_day - $prev_end_time_day >= ($min_day_rest * 60 * 60)){
                    $day_rest_law = 0;
                }
                //echo $day_law."-".$day_rest_law."<br>";
                $user_work = $end_time_day - $start_time_day;
                $tot_work_hours += $user_work;

                if ($tot_work_hours > $max_day_hours * 60 * 60) {

                    $day_law = 1;
                }

                $prev_end_time_day = $end_time_day;
            } else if ($day_flag == 1) {

                $day_flag = 0;
                if ((strtotime($day_end) - $prev_end_time_day) > ($unconditional_break * 60 * 60))
                    $interval_day += strtotime($day_end) - $prev_end_time_day;
                else
                    $tot_work_hours += strtotime($day_end) - $prev_end_time_day;
                if ($interval_day >= ($break_time * 60 * 60)) {
                    $day_law = 0;
                }
                if((strtotime($day_end) - $prev_end_time_day) >= $min_day_rest*60*60){
                    $day_rest_law= 0;
                }

            }
            $prev_end_time = $end_time;
            
        }

        if ($prev_end_time < $start_time_day) {
            $prev_end_time = strtotime($date . ' ' . $time_to . '.0');
            $prev_end_time_day = $prev_end_time;
        }
        if (strtotime($week_end) - $prev_end_time >= $week_break * 60 * 60) {
            $week_law = 0;
        }

        if (strtotime($day_end) - $prev_end_time_day + $interval_day >= $break_time * 60 * 60) {
            $day_law = 0;
        }

        if ((strtotime($day_end) - $prev_end_time_day) >= ($min_day_rest * 60 * 60)) {
            $day_rest_law = 0;
        }

        if($day_rest_law == 1){
            $day_law = 1;
        }

        if ($day_law == 1 || $week_law == 1) {

            //ATL insertion temp -m removed
            $output = "ATL varning " . $employe_data['last_name'] . ' ' . $employe_data['first_name'] . "=>" . $date . " " . sprintf('%05.2f', $time_from) . "-" . sprintf('%05.2f', $time_to);
            $extr_time = 0;
            if ($day_law == 1)
                $extr_time = ($tot_work_hours - $max_day_hours * 60 * 60) / (60 * 60);
            elseif ($week_law == 1)
                $extr_time = 36;
            /*
              $this->tables = array('atl_warnings');
              $this->fields = array('employee', 'date', 'time_from', 'time_to', 'customer', 'extra_hours');
              $this->field_values = array($employee, $date, $time_from, $time_to, $customer, $extr_time);
              if ($this->query_insert()) {
              $email_receipients = $this->employee_leave_recipients($employee, 9);
              if (!empty($email_receipients)) {

              //sending email
              $smarty = new smartySetup(array('mail.xml'),FALSE);
              $mail_message = $smarty->translate['atl_mail_body1'];
              $mail_message .= 'Anställd: ' . $employe_data['last_name'] . ' ' . $employe_data['first_name'] . '<br/>';
              $mail_message .= $date . " " . sprintf('%05.2f', $time_from) . "-" . sprintf('%05.2f', $time_to);
              $mail_message .= $smarty->translate['atl_mail_body2'];
              $mail_subject = $smarty->translate['atl_mail_subject1'] . $employe_data['last_name'] . ' ' . $employe_data['first_name'];
              $mail = new SimpleMail($mail_subject, $mail_message);
              $mail->addSender("cirrus-noreplay@time2view.se");
              foreach ($email_receipients as $recipent) {

              if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

              $mail->addRecipient($recipent['email']);
              }
              }

              $mail->send();
              }
              } */

            //            return array('atl_message' => $output, 'atl_exceed_hours' => $extr_time);
            return array(
                'atl_message' => $output,
                'exceed_hours' => $extr_time,
                'employee' => $employee,
                'customer' => $customer,
                'date' => $date,
                'timefrom' => $time_from,
                'timeto' => $time_to
            );
        } else {

            return true;
        }
        // End of ATL laws
    }

    function saveATL($employee, $date, $time_from, $time_to, $customer, $extr_time) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: save ATL entries in db and send atl waning mail 
         */
       // $output = "ATL varning " . $employe_data['last_name'] . ' ' . $employe_data['first_name'] . "=>" . $date . " " . sprintf('%05.2f', $time_from) . "-" . sprintf('%05.2f', $time_to);

        $this->tables = array('atl_warnings');
        $this->fields = array('employee', 'date', 'time_from', 'time_to', 'customer', 'extra_hours');
        $this->field_values = array($employee, $date, $time_from, $time_to, $customer, $extr_time);
        if ($this->query_insert()) {
            $email_receipients = $this->employee_leave_recipients($employee, 9);
            if (!empty($email_receipients)) {

                //sending email
                $employe_data = $this->get_employee_detail($employee);
                $smarty = new smartySetup(array('mail.xml'),FALSE);
                $mail_message = $smarty->translate['atl_mail_body1'];
                $mail_message .= 'Anställd: ' . $employe_data['last_name'] . ' ' . $employe_data['first_name'] . '<br/>';
                $mail_message .= $date . " " . sprintf('%05.2f', $time_from) . "-" . sprintf('%05.2f', $time_to);
                $mail_message .= $smarty->translate['atl_mail_body2'];
                $mail_subject = $smarty->translate['atl_mail_subject1'] . $employe_data['last_name'] . ' ' . $employe_data['first_name'];
                $mail = new SimpleMail($mail_subject, $mail_message);
                $mail->addSender("cirrus-noreplay@time2view.se");
                foreach ($email_receipients as $recipent) {

                    if ($recipent['email'] != '' && $recipent['email_notification'] == 1)
                        $mail->addRecipient($recipent['email']);
                }

                $mail->send();
            }
            return TRUE;
        }
        else
            return FALSE;
    }

    function removeATL($employee, $date, $time_from = 0, $time_to = 0, $customer = '') {

        if ($employee != '' && $customer != '') {
            $this->tables = array('atl_warnings');
            $this->fields = array('count(id) as `num`');
            $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from = ?', 'time_to = ?', 'customer = ?');
            $this->condition_values = array($employee, $date, (float) $time_from, (float) $time_to, $customer);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data[0]['num'] > 0) {

                $this->tables = array('atl_warnings');
                $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from = ?', 'time_to = ?', 'customer = ?');
                $this->condition_values = array($employee, $date, $time_from, $time_to, $customer);
                if ($this->query_delete()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return TRUE;
    }

    /* ----------------------shamsu start-------------------------------- */
    function super_team_members($username, $mode = 0) {         //mode is used for getting employees and customers on a Super Team (for chat)
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'role = 7');
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $data = $this->query_fetch(2);
        //$TL_customers = '\'' . implode('\', \'', $data) . '\'';
        if (count($data)) {
            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if ($mode == 1) {       // check is data for chat?
                $datas = array_merge($datas, $data);
            }
            return $datas;
        } else if ($mode == 0) {
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?', 'role = 3');
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if (count($datas)) {
                $datas = array();
                $datas = array('employee' => $username);
                return $datas;
            }
            else
                return array();
        }

        return array();
    }

    function mobile_users($mobile_num, $ids) {
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('mobile');
        $this->conditions = array('AND', 'username <> ?', 'mobile = ?', 'role <> 4');
        $this->condition_values = array($ids, $mobile_num);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }

    function get_timetable_leave_entries_id($user, $date, $time_from, $time_to) {
        /**
         * Author: Shamsu
         * for: get leave entries from timetable using timefrom & timeto
         */
        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from >= ?', 'time_to <= ?', 'status = 2');
        $this->condition_values = array($user, $date, (float) $time_from, (float) $time_to);
        $this->query_generate();
        $datas = $this->query_fetch();
        $result = array();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $result[] = $data['id'];
            }
        }
        return $result;
    }

    function delete_timetable_leave_entries_btwn_from_to($user, $date, $time_from, $time_to) {
        /**
         * Author: Shamsu
         * for: delete all leave entries from timetable Using timefrom & timeto
         */
        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', '	time_from >= ?', 'time_to <= ?', 'status = 2');
        $this->condition_values = array($user, $date, (float) $time_from, (float) $time_to);
        return $this->query_delete() ? TRUE : FALSE;
    }

    function check_relations_in_timetable_for_leave($id, $is_id_only = FALSE) {
        $this->tables = array('timetable');
        if (!$is_id_only)
            $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'relation_id');
        else
            $this->fields = array('id', 'relation_id');
        
        if (is_array($id)) {
            $this_id_string = '\'' . implode('\' , \'', $id) . '\'';
            $this->conditions = array('AND', array('IN', 'relation_id', $this_id_string));
        } else {
            $this->conditions = array('relation_id = ?');
            $this->condition_values = array($id);
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function check_employed_relations_in_timetable_for_leave($id) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date');
        $this->conditions = array('AND', 'relation_id = ?', 'employee is NOT NULL', 'employee != ?');
        $this->condition_values = array($id, '');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function delete_timetable_leave_byRelationID($id) {
        $this->tables = array('timetable');
        $this->conditions = array('relation_id = ?');
        $this->condition_values = array($id);
        return $this->query_delete() ? TRUE : FALSE;
    }

    function delete_sick_slots_n_update_relative_slot($id) {
        $this->tables = array('timetable');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            $this->tables = array('timetable');
            $this->fields = array('relation_id');
            $this->field_values = array(NULL);
            $this->conditions = array('relation_id = ?');
            $this->condition_values = array($id);
            $data = $this->query_update();
            return true;
        } else {
            return false;
        }
    }

    function skip_a_time_slot_from_leave_slot($leave_id, $time_from, $time_to) {
        /**
         * Author: Shamsu
         * for: remove a time slot from entire leave slot
         */
        $this->tables = array('leave');
        $this->fields = array('id', 'group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'apply_date', 'appr_emp', 'appr_date', 'appr_comment', 'status');
        $this->conditions = array('id = ?');
        $this->condition_values = array($leave_id);
        $this->query_generate();
        $leave_data = $this->query_fetch();
        $result_flag = FALSE;
        if (!empty($leave_data)) {
            if ($leave_data[0]['time_from'] == $time_from && $leave_data[0]['time_to'] == $time_to) {
                $this->tables = array('leave');
                $this->conditions = array('id = ?');
                $this->condition_values = array($leave_id);
                if ($this->query_delete())
                    $result_flag = TRUE;
            }elseif ($leave_data[0]['time_from'] == $time_from && $leave_data[0]['time_to'] > $time_to) {
                $this->tables = array('leave');
                $this->fields = array('time_from');
                $this->field_values = array($time_to);
                $this->conditions = array('id = ?');
                $this->condition_values = array($leave_id);
                if ($this->query_update())
                    $result_flag = TRUE;
            }elseif ($leave_data[0]['time_to'] == $time_to && $leave_data[0]['time_from'] < $time_from) {
                $this->tables = array('leave');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($leave_id);
                if ($this->query_update())
                    $result_flag = TRUE;
            }elseif ($leave_data[0]['time_from'] < $time_from && $leave_data[0]['time_to'] > $time_to) {
                $this->tables = array('leave');
                $this->fields = array('time_to');
                $this->field_values = array($time_from);
                $this->conditions = array('id = ?');
                $this->condition_values = array($leave_id);
                $update_data = $this->query_update();

                $this->tables = array('leave');
                $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'apply_date', 'appr_emp', 'appr_date', 'appr_comment', 'status');
                $this->field_values = array($leave_data[0]['group_id'], $leave_data[0]['employee'], $leave_data[0]['date'],
                    $time_to, $leave_data[0]['time_to'], $leave_data[0]['type'], $leave_data[0]['comment'],
                    $leave_data[0]['apply_date'], $leave_data[0]['appr_emp'], $leave_data[0]['appr_date'], $leave_data[0]['appr_comment'],
                    $leave_data[0]['status']);
                $insert_data = $this->query_insert();
                if ($insert_data && $update_data)
                    $result_flag = TRUE;
            }
        }
        return $result_flag;
    }

    function update_timetable_status_when_leave_cancel_byID($ids) {
        /**
         * Author: Shamsu
         * for: updating timetable slot status when cancel a leave byID
         */
        $this->tables = array('timetable');
        $this->fields = array('status');
        $this->field_values = array(1);
        $this->conditions = array('AND', array('IN', 'id', $ids), 'customer is NOT NULL', 'customer != ?');
        $this->condition_values = array('');
        $data = $this->query_update();
        if ($data) {
            $this->tables = array('timetable');
            $this->fields = array('status');
            $this->field_values = array(0);
            $this->conditions = array('AND', array('IN', 'id', $ids), array('OR', 'customer is NULL', 'customer = ?'));
            $this->condition_values = array('');
            return $this->query_update();
        }
        else
            return FALSE;
    }

    function generate_pdf_work_report($r_year, $r_month, $r_employee, $r_customer) {
        /**
         * Author: Shamsu
         * for: generating report for monthly work report
         */
        require_once ('plugins/customize_pdf_work_report_details.class.php');

        $obj_cust = new customer();
        $pdf = new PDF_Work_report();
        $pdf->report_employee = $r_employee;
        $pdf->report_customer = $r_customer;
        $pdf->report_month = $r_month;
        $pdf->report_year = $r_year;
        $pdf->AliasNbPages();
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////  
        $employee_details = $this->get_employee_detail($r_employee);
        // $cust_name = $obj_cust->getCustomerName($r_customer);
        $cust_details = $obj_cust->customer_detail($r_customer);
        $cust_name = $cust_details['first_name'] . " " . $cust_details['last_name'];
        $pdf->Process_contents();

        $total_column_count = $pdf->get_total_columns();        //total number of columns
        $normal_column_count = $pdf->get_total_columns(1);      //total number of columns excluding leave columns
        $leave_column_count = $pdf->get_total_columns(2);       //total number of leave columns
        $start = 0;     //start column number for drawing pdf in a page
        $end = 0;       //end column number for drawing pdf in a page
        $max = 16;      //maximum number of columns allowed per page excluding date field
        $flag = TRUE;   //flag is used for printing header of report at once
        while ($end < $total_column_count) {
            $pdf->AddPage('L');        //pages
            if ($flag)
                $pdf->P1_Part1_Landscap($employee_details, $cust_name);
            $flag = FALSE;

            if ($normal_column_count + $leave_column_count <= $max + 5) {     //$max + 3 is used for allow extra 3 columns in a page only if have not exist other field for creating new page +2 for fk/kntu
                $start = $end + 1;
                $end = $start + $normal_column_count + $leave_column_count - 1+2;
                $normal_column_count = 0;
                $leave_column_count = 0;
            } else if ($normal_column_count > 0) {
                if ($normal_column_count > $max) {
                    $start = $end + 1;
                    $end = $start + $max - 1;
                    $normal_column_count -= ($end - $start + 1);
                } else {
                    $start = $end + 1;
                    $end = $start + $normal_column_count - 1;
                    $normal_column_count -= ($end - $start + 1);
                }
            } else if ($leave_column_count > 0) {
                if ($leave_column_count > $max) {
                    $start = $end + 1;
                    $end = $start + $max - 1;
                    $leave_column_count -= ($end - $start + 1);
                } else {
                    $start = $end + 1;
                    $end = $start + $leave_column_count - 1;
                    $leave_column_count -= ($end - $start + 1);
                }
            }
            $pdf->P1_Part2_Landscap($start, $end);
        }
        $pdf->Output();
    }
    /* ----------------------shamsu end-------------------------------- */

    function change_role_employee($emp) {
        $this->tables = array('team');
        $this->fields = array('role');
        if ($this->role == '5') {
            $this->field_values = array(5);
        } else {
            $this->field_values = array(3);
        }
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        return $this->query_update();
    }

    function change_superTL_team($cust) {
        $this->tables = array('team');
        $this->fields = array('role');
        $this->field_values = array('3');
        $this->conditions = array('AND', 'customer = ?', 'role = 7');
        $this->condition_values = array($cust);
        return $this->query_update() ? TRUE : FALSE;
    }

    function change_superTL_team_new($emp, $cust) {
        $this->tables = array('team');
        $this->fields = array('role');
        $this->field_values = array(7);
        $this->conditions = array('AND', 'customer = ?', 'employee = ?');
        $this->condition_values = array($cust, $emp);
        return $this->query_update() ? TRUE : FALSE;
    }

    function get_employee_detail_privilege($employees) {
        $employees = '\'' . implode('\',\'', $employees) . '\'';
        $this->tables = array("employee");
        $this->fields = array("username", "first_name", "last_name", "code");
        $this->conditions = array('IN', "username", $employees);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    /*           --------- Privileges ------ */

    function add_previleges($emp, $cust = null) {
        $t = 0;
        if ($cust == "" || $cust == null) {
            $cust = null;
        }
        $emps = explode(',', $emp);
        for ($i = 0; $i < count($emps); $i++) {
            $this->tables = array('privileges');
            $this->fields = array('employee');
            if ($cust == null || $cust == '') {
                $this->conditions = array('AND', 'employee = ?', 'customer IS NULL');
                $this->condition_values = array($emps[$i]);
            } else {
                $this->conditions = array('AND', 'employee = ?', 'customer = ?');
                $this->condition_values = array($emps[$i], $cust);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $this->tables = array('privileges');
                $this->fields = array('swap', 'process', 'add_slot', 'fkkn', 'slot_type', 'add_customer', 'add_employee', 'remove_customer', 'remove_employee', '`leave`', 'copy_single_slot', 'copy_single_slot_option', 'copy_day_slot', 'copy_day_slot_option', 'split_slot', 'delete_slot', 'delete_day_slot', 'delete_multiple_slots', 'contract_override', 'atl_override', 'change_time', 'no_pay_leave', 'candg_approve', 'show_percentage_monthly', 'not_show_employees');
                $this->field_values = array($this->swap, $this->process, $this->add_slot, $this->fkkn, $this->slot_type, $this->add_customer, $this->add_employee, $this->remove_customer, $this->remove_employee, $this->leave, $this->copy_single_slot, $this->copy_single_slot_option, $this->copy_day_slot, $this->copy_day_slot_option, $this->split_slot, $this->delete_slot, $this->delete_day_slot, $this->delete_multiple_slots, $this->contract_override, $this->atl_override, $this->change_time, $this->no_pay_leave, $this->candg_approve, $this->show_percentage_month, $this->not_show_employees);
                if ($cust == null) {
                    $this->conditions = array('AND', 'employee = ?', 'customer IS NULL');
                    $this->condition_values = array($emps[$i]);
                } else {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?');
                    $this->condition_values = array($emps[$i], $cust);
                }
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            } else {
                $this->tables = array('privileges');
                $this->fields = array('employee', 'customer');
                if ($cust == null) {
                    $this->field_values = array($emps[$i], null);
                } else {
                    $this->field_values = array($emps[$i], $cust);
                }
                if ($this->query_insert()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
                $this->tables = array('privileges');
                $this->fields = array('swap', 'process', 'add_slot', 'fkkn', 'slot_type', 'add_customer', 'add_employee', 'remove_customer', 'remove_employee', '`leave`', 'copy_single_slot', 'copy_single_slot_option', 'copy_day_slot', 'copy_day_slot_option', 'split_slot', 'delete_slot', 'delete_day_slot', 'delete_multiple_slots', 'contract_override', 'atl_override', 'change_time', 'no_pay_leave', 'candg_approve', 'show_percentage_monthly', 'not_show_employees');
                $this->field_values = array($this->swap, $this->process, $this->add_slot, $this->fkkn, $this->slot_type, $this->add_customer, $this->add_employee, $this->remove_customer, $this->remove_employee, $this->leave, $this->copy_single_slot, $this->copy_single_slot_option, $this->copy_day_slot, $this->copy_day_slot_option, $this->split_slot, $this->delete_slot, $this->delete_day_slot, $this->delete_multiple_slots, $this->contract_override, $this->atl_override, $this->change_time, $this->no_pay_leave, $this->candg_approve, $this->show_percentage_month, $this->not_show_employees);
                if ($cust == null) {
                    $this->conditions = array('AND', 'employee = ?', 'customer IS NULL');
                    $this->condition_values = array($emps[$i]);
                } else {
                    $this->conditions = array('AND', 'employee = ?', 'customer = ?');
                    $this->condition_values = array($emps[$i], $cust);
                }
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            }
        }
        return $t == 1 ? TRUE : FALSE;
    }

    function add_previleges_forms($emp) {

        $t = 0;
        $emps = explode(',', $emp);
        for ($i = 0; $i < count($emps); $i++) {
            $this->tables = array('privileges_forms');
            $this->fields = array('employee');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emps[$i]);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $this->tables = array('privileges_forms');
                $this->fields = array('fkkn', '`leave`', 'certificate', 'form_1', 'form_2', 'form_3', 'form_1_report', 'form_2_report', 'form_3_report', 'form_4','form_5','form_6','form_7','form_termination');
                $this->field_values = array($this->form_fkkn, $this->form_leave, $this->form_certificate, $this->form_form_1, $this->form_form_2, $this->form_form_3, $this->form_form_1_report, $this->form_form_2_report, $this->form_form_3_report,$this->form_form_4, $this->form_form_5, $this->form_form_6, $this->form_form_7,$this->form_employee_termination);
                $this->conditions = array('employee = ?');
                $this->condition_values = array($emps[$i]);
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            } else {
                $this->tables = array('privileges_forms');
                $this->fields = array('employee');
                $this->field_values = array($emps[$i]);

                if ($this->query_insert()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
                $this->tables = array('privileges_forms');
                $this->fields = array('fkkn', '`leave`', 'certificate', 'form_1', 'form_2', 'form_3', 'form_1_report', 'form_2_report', 'form_3_report','form_4', 'form_5', 'form_6', 'form_7','form_termination');
                $this->field_values = array($this->form_fkkn, $this->form_leave, $this->form_certificate, $this->form_form_1, $this->form_form_2, $this->form_form_3, $this->form_form_1_report, $this->form_form_2_report, $this->form_form_3_report, $this->form_form_4, $this->form_form_5, $this->form_form_6, $this->form_form_7,$this->form_employee_termination);
                $this->conditions = array('employee = ?');
                $this->condition_values = array($emps[$i]);
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            }
        }
        return $t == 1 ? TRUE : FALSE;
    }

    function add_previleges_general($emp) {
        $t = 0;
        $emps = explode(',', $emp);
        for ($i = 0; $i < count($emps); $i++) {
            $this->tables = array('privileges_general');
            $this->fields = array('employee');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emps[$i]);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $this->tables = array('privileges_general');
                $this->fields = array('add_employee', 'add_customer', 'inconvenient_timing', 'administration', 'chat', 'edit_employee', 'edit_customer', 'survey', 'create_template', 'use_template', 'candg_wi', 'candg_wo', 'mobile_search', 'employer_signing', 'candg_stop_other_emps',
                    'employee_settings_contract', 'employee_settings_salary', 'employee_settings_notification', 'employee_settings_privileges', 'employee_settings_cv', 'employee_settings_documentation', 'employee_settings_preference', 
                    'customer_settings_insurance_fk', 'customer_settings_insurance_kn', 'customer_settings_insurance_tu', 'customer_settings_implan', 'customer_settings_deswork', 'customer_settings_documentation', 'customer_settings_equipment', 'customer_settings_privileges', 'customer_settings_appointment', 'customer_settings_oncall', 'customer_settings_3066', 'customer_settings_sick_form_defaults', 'customer_settings_location','administration_fk_export','candg_on','recruitment','customer_doc_field','employee_check_list');
                $this->field_values = array($this->general_add_employee, $this->general_add_customer, $this->general_inconvenient_timing, $this->general_administration, $this->general_chat, $this->general_edit_employee, $this->general_edit_customer, $this->general_survey, $this->general_create_template, $this->general_use_template, $this->general_candg, $this->general_candg_wo, $this->mobile_search, $this->employer_signing, $this->candg_stop_other_emps, 
                    $this->general_employee_settings_contract, $this->general_employee_settings_salary, $this->general_employee_settings_notification, $this->general_employee_settings_privileges, $this->general_employee_settings_cv, $this->general_employee_settings_documentation, $this->general_employee_settings_preference,
                    $this->general_customer_settings_insurance_fk, $this->general_customer_settings_insurance_kn, $this->general_customer_settings_insurance_tu, $this->general_customer_settings_implan, $this->general_customer_settings_deswork, $this->general_customer_settings_documentation, $this->general_customer_settings_equipment, $this->general_customer_settings_privileges, $this->general_customer_settings_appointment, $this->general_customer_settings_oncall, $this->general_customer_settings_3066, $this->general_customer_settings_sick_form_defaults, $this->general_customer_settings_location, $this->administration_fk_export,$this->come_and_go_on,$this->recruitment,$this->customer_doc_field,$this->general_employee_checklist_preference);
                $this->conditions = array('employee = ?');
                $this->condition_values = array($emps[$i]);
                $t = $this->query_update() ? 1 : 0;
            } else {
                /*$this->tables = array('privileges_general');
                $this->fields = array('employee');
                $this->field_values = array($emps[$i]);
                if ($this->query_insert()) {
                    $t = 1;
                } else {
                    $t = 0;
                }*/
                $this->tables = array('privileges_general');
                $this->fields = array('employee', 'add_employee', 'add_customer', 'inconvenient_timing', 'administration', 'chat', 'edit_employee', 'edit_customer', 'survey', 'create_template', 'use_template', 'candg_wi', 'candg_wo', 'mobile_search', 'employer_signing', 'candg_stop_other_emps',
                    'employee_settings_contract', 'employee_settings_salary', 'employee_settings_notification', 'employee_settings_privileges', 'employee_settings_cv', 'employee_settings_documentation', 'employee_settings_preference', 
                    'customer_settings_insurance_fk', 'customer_settings_insurance_kn', 'customer_settings_insurance_tu', 'customer_settings_implan', 'customer_settings_deswork', 'customer_settings_documentation', 'customer_settings_equipment', 'customer_settings_privileges', 'customer_settings_appointment', 'customer_settings_oncall', 'customer_settings_3066', 'customer_settings_sick_form_defaults', 'customer_settings_location','administration_fk_export','candg_on','recruitment','customer_doc_field','employee_check_list');
                $this->field_values = array($emps[$i], $this->general_add_employee, $this->general_add_customer, $this->general_inconvenient_timing, $this->general_administration, $this->general_chat, $this->general_edit_employee, $this->general_edit_customer, $this->general_survey, $this->general_create_template, $this->general_use_template, $this->general_candg, $this->general_candg_wo, $this->mobile_search, $this->employer_signing, $this->candg_stop_other_emps, 
                    $this->general_employee_settings_contract, $this->general_employee_settings_salary, $this->general_employee_settings_notification, $this->general_employee_settings_privileges, $this->general_employee_settings_cv, $this->general_employee_settings_documentation, $this->general_employee_settings_preference,
                    $this->general_customer_settings_insurance_fk, $this->general_customer_settings_insurance_kn, $this->general_customer_settings_insurance_tu, $this->general_customer_settings_implan, $this->general_customer_settings_deswork, $this->general_customer_settings_documentation, $this->general_customer_settings_equipment, $this->general_customer_settings_privileges, $this->general_customer_settings_appointment, $this->general_customer_settings_oncall, $this->general_customer_settings_3066, $this->general_customer_settings_sick_form_defaults, $this->general_customer_settings_location, $this->administration_fk_export,$this->come_and_go_on,$this->recruitment,$this->customer_doc_field,$this->general_employee_checklist_preference);
                // $this->conditions = array('employee = ?');
                // $this->condition_values = array($emps[$i]);
                $t = $this->query_insert() ? 1 : 0;
            }

            // if($t != 1){
            //     echo (!$data ? 'INSERT' : 'UPDATE');
            //     print_r($this->query_error_details);
            // }
        }
        return $t == 1 ? true : false;
    }

    function add_previleges_mc($emp) {
        $this->mc_notes_attchment = isset($_POST['mc_notes_attchment']) && trim($_POST['mc_notes_attchment']) == 1 ? $_POST['mc_notes_attchment'] : 0;
        // $this->mc_notes_attchment = $_POST['mc_notes_attchment'];
        $t = 0;
        $emps = explode(',', $emp);
        for ($i = 0; $i < count($emps); $i++) {
            $this->tables = array('privileges_mc');
            $this->fields = array('employee');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emps[$i]);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $this->tables = array('privileges_mc');
                $this->fields = array('leave_notification', 'leave_approval', 'leave_rejection', 'leave_edit', 'notes', 'cirrus_mail', 'external_mail', 'sms', 'notes_approval', 'notes_rejection', 'notes_attchment', 'document_archive', 'support', 'sms_general', 'approve_all_leave');
                $this->field_values = array($this->mc_leave_notification, $this->mc_leave_approval, $this->mc_leave_rejection, $this->mc_leave_edit, $this->mc_notes, $this->cirrus_mail, $this->external_mail, $this->mc_sms, $this->mc_notes_approval, $this->mc_notes_rejection, $this->mc_notes_attchment, $this->mc_document_archive, $this->mc_support, $this->mc_sms_general, $this->mc_approve_all_leave);
                $this->conditions = array('employee = ?');
                $this->condition_values = array($emps[$i]);
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            } else {
                $this->tables = array('privileges_mc');
                $this->fields = array('employee');
                $this->field_values = array($emps[$i]);

                if ($this->query_insert()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
                $this->tables = array('privileges_mc');
                $this->fields = array('leave_notification', 'leave_approval', 'leave_rejection', 'leave_edit', 'notes', 'cirrus_mail', 'external_mail', 'sms', 'notes_approval', 'notes_rejection', 'notes_attchment', 'document_archive', 'support', 'sms_general', 'approve_all_leave');
                $this->field_values = array($this->mc_leave_notification, $this->mc_leave_approval, $this->mc_leave_rejection, $this->mc_leave_edit, $this->mc_notes, $this->cirrus_mail, $this->external_mail, $this->mc_sms, $this->mc_notes_approval, $this->mc_notes_rejection, $this->mc_notes_attchment, $this->mc_document_archive, $this->mc_support, $this->mc_sms_general, $this->mc_approve_all_leave);
                $this->conditions = array('employee = ?');
                $this->condition_values = array($emps[$i]);
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            }
        }
        return $t == 1 ? TRUE : FALSE;
    }

    function add_previleges_reports($emp) {
        $t = 0;
        $emps = explode(',', $emp);
        for ($i = 0; $i < count($emps); $i++) {
            $this->tables = array('privileges_reports');
            $this->fields = array('employee');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emps[$i]);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $this->tables = array('privileges_reports');
                $this->fields = array('customer_schedule', 'employee_schedule', 'employee_workreport', 'customer_data', 'customer_leave', 'customer_granded_vs_used', 'customer_employee_connection', 'customer_horizontal', 'customer_overview', 'customer_vacation_planning', 'employee_data', 'employee_leave', 'employee_percentage', 'atl_warning', 'customer_overlapping', 'employee_skill
                    ', 'employee_available');
                $this->field_values = array($this->customer_schedule, $this->employee_schedule, $this->monthly_work, $this->report_customer_data, $this->report_customer_leave, $this->report_customer_granded_vs_used, $this->report_customer_employee_connection, $this->report_customer_horizontal, $this->report_customer_overview, $this->report_customer_vacation_planning, $this->report_employee_data, $this->report_employee_leave, $this->report_employee_percentage, $this->report_atl_warning, $this->report_customer_overlapping,$this->employee_skill_report_privilege, $this->report_available_employees);
                $this->conditions = array('employee = ?');
                $this->condition_values = array($emps[$i]);
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            } else {
                $this->tables = array('privileges_reports');
                $this->fields = array('employee');
                $this->field_values = array($emps[$i]);
                if ($this->query_insert()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
                $this->tables = array('privileges_reports');
                $this->fields = array('customer_schedule', 'employee_schedule', 'employee_workreport', 'customer_data', 'customer_leave', 'customer_granded_vs_used', 'customer_employee_connection', 'customer_horizontal', 'customer_overview', 'customer_vacation_planning', 'employee_data', 'employee_leave', 'employee_percentage', 'atl_warning', 'customer_overlapping','employee_skill
                    ', 'employee_available');
                $this->field_values = array($this->customer_schedule, $this->employee_schedule, $this->monthly_work, $this->report_customer_data, $this->report_customer_leave, $this->report_customer_granded_vs_used, $this->report_customer_employee_connection, $this->report_customer_horizontal, $this->report_customer_overview, $this->report_customer_vacation_planning, $this->report_employee_data, $this->report_employee_leave, $this->report_employee_percentage, $this->report_atl_warning, $this->report_customer_overlapping,$this->employee_skill_report_privilege, $this->report_available_employees);
                $this->conditions = array('employee = ?');
                //print_r($this->field_values);
                $this->condition_values = array($emps[$i]);
                if ($this->query_update()) {
                    $t = 1;
                } else {
                    $t = 0;
                }
            }
        }
        return $t == 1 ? TRUE : FALSE;
    }

    function get_privileges_employee($employees, $cust = NULL) {
        $employees = explode(',', $employees);
        $employees = '\'' . implode('\',\'', $employees) . '\'';
        $this->tables = array('privileges');
        $this->fields = array('employee', 'CONCAT(swap,",",process,",",add_slot,",",fkkn,",",slot_type,",",add_customer,",",add_employee,",",remove_customer,",",remove_employee,",",`leave`,",",copy_single_slot,",",copy_single_slot_option,",",copy_day_slot,",",copy_day_slot_option,",",split_slot,",",delete_slot,",",delete_day_slot,",",delete_multiple_slots,",",contract_override,",",atl_override,",",change_time,",",no_pay_leave,",",candg_approve,",",show_percentage_monthly,",",not_show_employees) AS privilege', '(swap+process+add_slot+fkkn+slot_type+add_customer+add_employee+remove_customer+remove_employee+`leave`+copy_single_slot+copy_single_slot_option+copy_day_slot+copy_day_slot_option+split_slot+delete_slot+delete_day_slot+delete_multiple_slots+contract_override+atl_override+change_time+no_pay_leave+candg_approve+show_percentage_monthly) AS sum_privilege');
        if ($cust == NULL) {
            //$this->conditions = array('IN', "employee", $employees);
            $this->conditions = array('AND', array('IN', "employee", $employees), 'customer IS NULL');
        } else {
            $this->conditions = array('AND', array('IN', "employee", $employees), 'customer = ?');
            $this->condition_values = array($cust);
        }
        $this->order_by = array("sum_privilege");
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function get_privileges_forms_employee($employees) {
        $employees = explode(',', $employees);
        $employees = '\'' . implode('\',\'', $employees) . '\'';
        $this->tables = array('privileges_forms');
        $this->fields = array('employee', 'CONCAT(fkkn,",",`leave`,",",certificate,",",form_1,",",form_2,",",form_3,",",form_1_report,",",form_2_report,",",form_3_report,",",form_4,",",form_5,",",form_6,",",form_7,",",form_termination) AS privilege', '(fkkn+`leave`+certificate+form_1+form_2+form_3+form_4+form_5+form_6+form_7+form_1_report+form_2_report+form_3_report+form_termination)  AS sum_privilege');
        $this->conditions = array('IN', "employee", $employees);
        $this->order_by = array("sum_privilege");
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function get_privileges_general_employee($employees) {
        // print_r($employees);
        // exit('d');
        $employees = explode(',', $employees);
        $employees = '\'' . implode('\',\'', $employees) . '\'';
        $this->tables = array('privileges_general');
        $this->fields = array('employee', 'CONCAT(add_employee,",",add_customer,",",inconvenient_timing,",",administration,",",chat,",",edit_employee,",",edit_customer,",",survey,",",create_template,",",use_template,",",candg_wi,",",candg_wo,",",mobile_search,",",employer_signing,",",candg_stop_other_emps,
            ",",employee_settings_contract,",",employee_settings_salary,",",employee_settings_notification,",",employee_settings_privileges,",",employee_settings_cv,",",employee_settings_documentation,",",employee_settings_preference,
            ",",customer_settings_insurance_fk,",",customer_settings_insurance_kn,",",customer_settings_insurance_tu,",",customer_settings_implan,",",customer_settings_deswork,",",customer_settings_documentation,",",customer_settings_equipment,",",customer_settings_privileges,",",customer_settings_appointment,",",customer_settings_oncall,",",customer_settings_3066,",",customer_settings_sick_form_defaults,",",administration_fk_export,",",candg_on,",",recruitment,",",customer_settings_location,",",customer_doc_field,",",employee_check_list) AS privilege', 
            '(add_employee+add_customer+inconvenient_timing+administration+chat+edit_employee+edit_customer+survey+create_template+use_template+candg_wi+candg_wo+mobile_search+employer_signing+candg_stop_other_emps+employee_settings_contract+employee_settings_salary+employee_settings_notification+employee_settings_privileges+employee_settings_cv+employee_settings_documentation+employee_settings_preference+customer_settings_insurance_fk+customer_settings_insurance_kn+customer_settings_insurance_tu+customer_settings_implan+customer_settings_deswork+customer_settings_documentation+customer_settings_equipment+customer_settings_privileges+customer_settings_appointment+customer_settings_oncall+customer_settings_3066+customer_settings_sick_form_defaults+administration_fk_export+recruitment+customer_settings_location+customer_doc_field+employee_check_list) AS sum_privilege');
        $this->conditions = array('IN', "employee", $employees);
        $this->order_by = array("sum_privilege");
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function get_privileges_mc_employee($employees) {
        $employees = explode(',', $employees);
        $employees = '\'' . implode('\',\'', $employees) . '\'';
        $this->tables = array('privileges_mc');
        $this->fields = array('employee', 'CONCAT(leave_notification,",",leave_approval,",",leave_rejection,",",leave_edit,",",notes,",",cirrus_mail,",",external_mail,",",sms,",",notes_approval,",",notes_rejection,",",notes_attchment,",",document_archive,",",support,",",sms_general,",",approve_all_leave) AS privilege', '(leave_notification+leave_approval+leave_rejection+leave_edit+notes+cirrus_mail+external_mail+sms+notes_approval+notes_rejection+notes_attchment+document_archive+support+sms_general+approve_all_leave) AS sum_privilege');
        $this->conditions = array('IN', "employee", $employees);
        $this->order_by = array("sum_privilege");
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function get_privileges_report_employee($employees) {
        $employees = explode(',', $employees);
        $employees = '\'' . implode('\',\'', $employees) . '\'';
        $this->tables = array('privileges_reports');
        $this->fields = array('employee', 'CONCAT(customer_data,",",customer_leave,",",customer_granded_vs_used,",",customer_employee_connection,",",customer_schedule,",",customer_horizontal,",",customer_overview,",",customer_vacation_planning,",",employee_data,",",employee_leave,",",employee_percentage,",",employee_schedule,",",employee_workreport,",",atl_warning,",",customer_overlapping,",",employee_skill,",",employee_available) AS privilege', '(customer_data+customer_leave+customer_granded_vs_used+customer_employee_connection+customer_schedule+customer_horizontal+customer_overview+customer_vacation_planning+employee_data+employee_leave+employee_percentage+employee_schedule+employee_workreport+atl_warning+employee_skill) AS sum_privilege');
        $this->conditions = array('IN', "employee", $employees);
        $this->order_by = array("sum_privilege");
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function get_all_employees_for_mail_cron($status) {         // to send activation / inactivation conformation mail using cron
        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'email', 'social_security', 'city', 'phone', 'mobile', 'status', 'date', 'date_inactive');
        $this->conditions = array('AND', 'status = ?');
        $this->condition_values = array($status);
//        $this->order_by = array('LOWER(last_name)');
        $this->query_generate();
        $employee_data = $this->query_fetch();
        return $employee_data;
    }

    function update_employee_status_by_username($uname, $status) {         // to send activation / inactivation conformation mail using cron
        $this->tables = array('employee');
        if ($status == 1) {
            $this->fields = array('status', 'date_inactive');
            $this->field_values = array($status, NULL);
        } else if ($status == 0) {
            $this->fields = array('status');
            $this->field_values = array($status);
        }
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($uname);
        $data = $this->query_update();
        return $data;
    }

    //find the entered employee has the right to acceess the particular employee
    //used in gdschema_employee
    function is_employee_accessible($username) {
        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($login_user_role == 1 || $login_user_role == 6)
            return true;
        $employees = $this->employee_list();
        $employee_usernames = array();
        foreach ($employees as $data) {
            $employee_usernames[] = $data['username'];
        }

        if (in_array($username, $employee_usernames)) {
            return true;
        } else {
            return false;
        }
    }

    function is_employee_inactive_accessible($username) {

        $employees = $this->employee_list_begin();
        $employee_usernames = array();
        foreach ($employees as $data) {
            $employee_usernames[] = $data['username'];
        }
        if (in_array($username, $employee_usernames)) {
            return true;
        } else {
            return false;
        }
    }

    function employee_work_slots_day($employee, $date, $time_from, $time_to) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'time_from', 'time_to', 'status', 'type', 'alloc_emp');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2'), 'time_from >= ?', 'time_to <= ?');
        $this->condition_values = array($employee, $date, (float) $time_from, (float) $time_to);
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
//        $date_array = explode('-', $date);
//        $date_month = $date_array[1];
//        $date_year = $date_array[0];
        //cheking the slot is signed
        if (!empty($slots)) {
            foreach ($slots as $slot) {
                $signin_flag = $this->chk_employee_rpt_signed($slot['employee'], $slot['customer'], $date);

                $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'fkkn' => $slot['fkkn'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'alloc_emp' => $slot['alloc_emp'], 'signed' => $signin_flag);
            }
        }
        return $datas;
    }

    function oncall_holiday_priority($date) {
        global $db;
        $date = date('m-d', strtotime($date));
        $this->sql_query = "SELECT `type` as holiday_type FROM 
        " . $this->db_master . ".holiday_inconvenient_timing hit
				LEFT JOIN " . $this->db_master . ".holiday_block_master hbm ON hit.block_master_id = hbm.id 
				WHERE  DATE_FORMAT(CONCAT(effect_from,'-',date_from),'%m-%d') < '04-07' 
				AND DATE_FORMAT(CONCAT(effect_from,'-',date_to),'%m-%d') > '04-07' ";
        $data = $this->query_fetch();
        return $data;
    }

    /*     * **************************** Niyas new ************************************* */

    function employee_add_to_slot_multiple($ids, $select_emp, $alloc_emp) {
//        $msg = new message();
        $ids_array = explode(',', $ids);

        /* $fkkn = 1;
          if($select_emp != ''){
          $emp_detail = $this->get_employee_detail($select_emp);
          if(!empty($emp_detail)){
          $fkkn = $emp_detail['fkkn'];
          }
          } */
        
        $process_flag = TRUE;
        for ($i = 0; $i < count($ids_array); $i++) {
            $slot_det = $this->customer_employee_slot_details($ids_array[$i]);
            $status = $slot_det['status'];

            if ($status != 3 && $slot_det['customer'] != '')
                $status = 1;
            //$this->checkATL($select_emp, $slot_det['date'], $slot_det['time_from'], $slot_det['time_to']); // removed becoz of prechecking of ATL

            $this->tables = array('timetable');
            $this->fields = array('status', 'employee', 'alloc_emp');
            $this->field_values = array($status, $select_emp, $alloc_emp);
            $this->conditions = array('id = ?');
            $this->condition_values = array($ids_array[$i]);
            if(!$this->query_update()){
                $process_flag = FALSE;
                break;
            }
        }
        return $process_flag;
    }

    /*     * *********************************** niyas end ************************************* */

    function get_leave_details_byTimeTable_data($empID, $date, $tt_slot_from, $tt_slot_to) {
        /**
         * Author: Shamsu
         * used for getting leave details using timetable data inputs
         */
        $this->tables = array('leave');
        $this->fields = array('id', 'group_id', 'time_from', 'time_to', 'type', 'status');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'time_from <= ?', 'time_to >= ?');
        $this->condition_values = array($empID, $date, (float) $tt_slot_from, (float) $tt_slot_to);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function update_timetable_leave_slot($slotID, $new_timeto) {
        /**
         * Author: Shamsu
         * update timetable leave entry using slot entry with new time to input
         */
        $this->tables = array('timetable');
        $this->fields = array('time_to');
        $this->field_values = array($new_timeto);
        $this->conditions = array('AND', 'id  = ?', 'status  = 2');
        $this->condition_values = array($slotID);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function update_leave_table_time_to($lID, $new_timeto) {
        /**
         * Author: Shamsu
         * update timetable leave entry using slot entry with new time to input
         */
        $this->tables = array('leave');
        $this->fields = array('time_to');
        $this->field_values = array($new_timeto);
        $this->conditions = array('id  = ?');
        $this->condition_values = array($lID);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function delete_leave_entries_by_group_id($group_id, $date) {
        /**
         * Author: Shamsu
         * for: delete all leave entries from timetable Using timefrom & timeto
         */
        $this->tables = array('leave');
        $this->conditions = array('AND', 'group_id = ?', 'date = ?');
        $this->condition_values = array($group_id, $date);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    function add_monthlysalary_to_employee($username) {
        $this->tables = array('employee');
        $this->fields = array('monthly_salary');
        $this->field_values = array($this->monthly_salary);
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //       salary part begin     
    // function to inconvenients 
    function get_inconvenient_names($ids = NULL, $normal_inconv = NULL) {
        $this->tables = array('inconvenient_timing');
        if ($ids == NULL)
            $this->fields = array('DISTINCT(group_id)', 'name', 'type');
        else
            $this->fields = array('DISTINCT(group_id) as inconvenient_group_id', 'name', 'type');

        if ($normal_inconv !== NULL) {
            $this->conditions = array('type = ?');
            $this->condition_values = array($normal_inconv);
        }
//        $this->order_by =array('type');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    // function to get the inconveneient amount
    function get_inconvenient_amount($emp, $mode = NULL) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('MAX(id) AS ids');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('effect_from', 'effect_to');
        $this->conditions = array('id = ?');
        $this->condition_values = array($data[0]['ids']);
        $this->query_generate();
        $data1 = $this->query_fetch();
        if ($mode != NULL)
            return $data1[0];

        $inconvenients = $this->get_inconvenient_names();
        $result = array();
        for ($i = 0; $i < count($inconvenients); $i++) {

            $this->tables = array('employee_salary_inconvenient` as `esi', 'inconvenient_timing` as `it');
            $this->fields = array('DISTINCT(esi.inconvenient_group_id)', 'esi.amount', 'esi.sal_call_training', 'esi.sal_complementary_oncall', 'esi.sal_more_oncall', 'esi.sal_dismissal_oncall', 'it.type', 'it.name', 'esi.id AS id_i');
            $this->conditions = array('AND', 'esi.effect_from = ?', 'esi.effect_to = ?', 'it.group_id = esi.inconvenient_group_id', 'esi.employee = ?', 'it.group_id = ?');
            $this->condition_values = array($data1[0]['effect_from'], $data1[0]['effect_to'], $emp, $inconvenients[$i]['group_id']);
            $this->query_generate();
            $data2 = $this->query_fetch();
            if ($data2) {
                $result[] = $data2[0];
            } else {
                $result[] = array('inconvenient_group_id' => $inconvenients[$i]['group_id'], 'amount' => '', 'name' => $inconvenients[$i]['name'], 'type' => $inconvenients[$i]['type']);
            }
        }
        return $result ? $result : $this->get_inconvenient_names();
    }

    //function to add inconnvenient amounts for the user

    function add_inconvenient_salary($emp, $clone_from = null, $inc = null, $effect_to = null) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('employee', 'inconvenient_group_id', 'effect_from', 'effect_to', 'amount', 'clone_from', 'increment_percentage', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall');
        $this->field_values = array($emp, $this->inconv_group_id, $this->effect_from_inconv, ($effect_to == null ? '0000-00-00' : $effect_to), $this->amount_inconv, $clone_from, $inc, $this->sal_call_training, $this->sal_complementary_oncall, $this->sal_more_oncall, $this->sal_dismissal_oncall);
        if ($this->query_insert()) {
            $this->last_inconv_id = $this->get_id();
            return true;
        }
        else
            return false;
    }
    
    // function to get the inconveneient amount
    function get_emp_inconvenient_salary_by_id($id) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('employee', 'inconvenient_group_id', 'effect_from', 'effect_to', 'amount', 'clone_from', 'increment_percentage', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return (!empty($data) ? $data[0] : array());
    }

    function get_normal_work_salaries($emp) {
        $this->tables = array('employee_salary');
        $this->fields = array('MAX(id) AS ids');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();

        $this->tables = array('employee_salary');
        $this->fields = array('id', 'effect_from', 'effect_to', 'normal', 'travel', 'break', 'oncall', 'overtime', 'quality_overtime', 'more_time', 'some_other_time', 'training_time', 'call_training', 'personal_meeting', 'holiday_big', 'holiday_big_oncall', 'holiday_red', 'holiday_red_oncall', 'insurance', 'week_end_travel', 'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->conditions = array('id = ?');
        $this->condition_values = array($data[0]['ids']);
        $this->query_generate();
        $data1 = $this->query_fetch();
        return $data1 ? $data1[0] : array();
    }

    function add_normal_time_salary($emp, $clone_from = null, $inc = null) {
        $this->tables = array('employee_salary');
        $this->fields = array('employee', 'effect_from', 'effect_to', 'normal', 'travel', 'break', 'overtime', 'quality_overtime', 'oncall', 'more_time',
            'some_other_time', 'training_time', 'call_training', 'personal_meeting', 'holiday_big', 'holiday_big_oncall', 'holiday_red', 'holiday_red_oncall', 'insurance', 'clone_from', 'increment_percentage', 'week_end_travel',
            'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->field_values = array($emp, $this->effect_from_normal, '', $this->normal, $this->travel, $this->break, $this->overtime, $this->quality_overtime, $this->on_call, $this->more_time,
            $this->some_other_time, $this->training_time, $this->call_training, $this->personal_meeting, $this->holiday_big, $this->holiday_big_oncall, $this->holiday_red, $this->holiday_red_oncall, $this->insurance, $clone_from, $inc, $this->week_end_travel,
            $this->voluntary, $this->complementary, $this->complementary_oncall, $this->more_oncall, $this->standby, $this->work_for_dismissal, $this->work_for_dismissal_oncall);
        if ($this->query_insert()) {
            $this->last_normal_id = $this->get_id();
            return true;
        }
        else
            return false;
    }

    function give_effect_to_old_salary($emp, $effect_from, $group_id) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('MAX(id) AS ids');
        $this->conditions = array('AND', 'employee = ?', 'inconvenient_group_id = ?');
        $this->condition_values = array($emp, $group_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            $this->tables = array('employee_salary_inconvenient');
            $this->fields = array('effect_to');
            $this->field_values = array($effect_from);
            $this->conditions = array('id = ?');
            $this->condition_values = array($data[0]['ids']);
            return $this->query_update();
        }
        else
            return true;
    }

    function check_overlapp_inconvenient_salary($emp, $group_id, $ids = null) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('id', 'effect_from', 'effect_to');
        if ($ids == null) {
            $this->conditions = array('AND', 'employee = ?', 'inconvenient_group_id = ?');
            $this->condition_values = array($emp, $group_id);
        } else {
            $this->conditions = array('AND', 'employee = ?', 'id <> ?', 'inconvenient_group_id = ?');
            $this->condition_values = array($emp, $ids, $group_id);
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function check_overlapp_normal_salary($emp, $ids = null) {
        $this->tables = array('employee_salary');
        $this->fields = array('id', 'effect_from', 'effect_to');
        if ($ids != null) {
            $this->conditions = array('AND', 'id <> ?', 'employee = ?');
            $this->condition_values = array($ids, $emp);
        } else {
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($emp);
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function give_effect_to_old_salary_normal($emp, $effect_from) {
        $this->tables = array('employee_salary');
        $this->fields = array('MAX(id) AS ids');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            $this->tables = array('employee_salary');
            $this->fields = array('effect_to');
            $this->field_values = array($effect_from);
            $this->conditions = array('id = ?');
            $this->condition_values = array($data[0]['ids']);
            return $this->query_update();
        }
        else
            return true;
    }

    function edit_normal_salary($emp, $sal_id) {
        $this->tables = array('employee_salary');
        $this->fields = array('effect_from', 'effect_to', 'normal', 'travel', 'break', 'oncall', 'overtime', 'quality_overtime', 'more_time',
            'some_other_time', 'training_time', 'call_training', 'personal_meeting', 'holiday_big', 'holiday_big_oncall', 'holiday_red', 'holiday_red_oncall', 'insurance', 'week_end_travel',
            'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->field_values = array($this->effect_from_normal, $this->effect_to_normal, $this->normal, $this->travel, $this->break, $this->on_call, $this->overtime, $this->quality_overtime, $this->more_time,
            $this->some_other_time, $this->training_time, $this->call_training, $this->personal_meeting, $this->holiday_big, $this->holiday_big_oncall, $this->holiday_red, $this->holiday_red_oncall, $this->insurance, $this->week_end_travel,
            $this->voluntary, $this->complementary, $this->complementary_oncall, $this->more_oncall, $this->standby, $this->work_for_dismissal, $this->work_for_dismissal_oncall);
        $this->conditions = array('id = ?');
        $this->condition_values = array($sal_id);
        return $this->query_update();
    }

    function delete_normal_salary($sal_id) {
        $this->tables = array('employee_salary');
        $this->conditions = array('id = ?');
        $this->condition_values = array($sal_id);
        return $this->query_delete();
    }

    function get_normal_effect_from_and_to($emp) {
        $this->tables = array('employee_salary');
        $this->fields = array('MAX(effect_from) as e_from');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : array();
    }

    function delete_inconvenient_salary($emp, $sal_id) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('effect_from', 'effect_to');
        $this->conditions = array('id = ?');
        $this->condition_values = array($sal_id);
        $this->query_generate();
        $data = $this->query_fetch();
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('id as sal_id');
        $this->conditions = array('AND', 'effect_from = ?', 'effect_to = ?', 'employee = ?');
        $this->condition_values = array($data[0]['effect_from'], $data[0]['effect_to'], $emp);
        $this->query_generate();
        $data1 = $this->query_fetch();

        for ($i = 0; $i < count($data1); $i++) {
            $this->tables = array('employee_salary_inconvenient');
            $this->conditions = array('id = ?');
            $this->condition_values = array($data1[$i]['sal_id']);
            $this->query_delete();
        }
    }

    function delete_monthly_salary($ids) {
        $this->tables = array('emp_salary');
        $this->conditions = array('salaryId = ?');
        $this->condition_values = array($ids);
        return $this->query_delete();
    }

    function get_inconvenient_effect_from_and_to($emp) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('MAX(effect_from) as e_from');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {
            return array();
        }
    }

    function ids_groupids_inconvenient_salary($sal_ids) {
//        $data = $this->get_inconvenient_effect_from_and_to($sal_ids);
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('effect_from', 'effect_to', 'employee');
        $this->conditions = array('id = ?');
        $this->condition_values = array($sal_ids);
        $this->query_generate();
        $data = $this->query_fetch();
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('id as ids', 'inconvenient_group_id');
        $this->conditions = array('AND', 'effect_from = ?', 'effect_to = ?', 'employee = ?');
        $this->condition_values = array($data[0]['effect_from'], $data[0]['effect_to'], $data[0]['employee']);
        $this->query_generate();
        $data1 = $this->query_fetch();
        return $data1 ? $data1 : array();
    }

    function edit_inconvenient_salary($sal_ids) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('inconvenient_group_id', 'effect_from', 'effect_to', 'amount', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall', 'sal_dismissal_oncall');
        $this->field_values = array($this->inconv_group_id, $this->effect_from_inconv, $this->effect_to_inconv, $this->amount_inconv, $this->sal_call_training, $this->sal_complementary_oncall, $this->sal_more_oncall, $this->sal_dismissal_oncall);
        $this->conditions = array('id = ?');
        $this->condition_values = array($sal_ids);
        
//        echo "<pre>$sal_ids: fields".print_r($this->fields, 1)."</pre>";
//        echo "<pre>field_values".print_r($this->field_values, 1)."</pre>";
        return $this->query_update();
    }

    function get_all_salary_dates($emp, $mode) {
        if ($mode == 1) {
            $this->tables = array('employee_salary');
            $this->fields = array('id', 'effect_from');
        } else {
            $this->tables = array('employee_salary_inconvenient');
            $this->fields = array('effect_from', 'id');
        }
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return array();
        }
    }

    function get_all_monthly_salary_dates($emp) {
        $this->tables = array('emp_salary');
        $this->fields = array('salaryId', 'emp_username', 'salary_per_month', 'date_from', 'date_to',);
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return array();
        }
    }

    function get_last_id($emp, $mode) {
        if ($mode == 1) {
            $this->tables = array('employee_salary');
        } else {
            $this->tables = array('employee_salary_inconvenient');
        }
        $this->fields = array('MAX(id) AS ids');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0]['ids'] : array();
    }

    function get_last_id_monthly($emp) {
        $this->tables = array('emp_salary');
        $this->fields = array('MAX(salaryId) AS ids');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0]['ids'] : array();
    }

    function get_normal_sal_acc_id($ids) {
        $this->tables = array('employee_salary');
        $this->fields = array('id', 'employee', 'effect_from', 'effect_to', 'normal', 'travel', 'break', 'oncall', 'overtime', 'quality_overtime', 'more_time',
            'some_other_time', 'training_time', 'call_training', 'personal_meeting', 'holiday_big', 'holiday_big_oncall', 'holiday_red', 'holiday_red_oncall', 'insurance', 'week_end_travel',
            'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : array();
    }

    function get_monthly_sal_acc_id($ids, $emp = null) {
        if ($emp != null) {
            $this->tables = array('emp_salary');
            $this->fields = array('MAX(salaryId) AS sal_id');
            $this->conditions = array('emp_username = ?');
            $this->condition_values = array($emp);
            $this->query_generate();
            $datas = $this->query_fetch();
            $ids = $datas[0]['sal_id'];
        }
        $this->tables = array('emp_salary');
        $this->fields = array('salaryId', 'emp_username', 'salary_per_month', 'date_from', 'date_to');
        $this->conditions = array('salaryId = ?');
        $this->condition_values = array($ids);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : array();
    }

    function get_inconv_sal_acc_id($ids) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('id', 'effect_from', 'effect_to', 'employee');
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        $this->query_generate();
        $data1 = $this->query_fetch();
        $inconvenients = $this->get_inconvenient_names();
        $result = array();
        for ($i = 0; $i < count($inconvenients); $i++) {
            $this->tables = array('employee_salary_inconvenient` as `esi', 'inconvenient_timing` as `it');
            $this->fields = array('DISTINCT(esi.inconvenient_group_id)', 'esi.amount', 'esi.sal_call_training', 'esi.sal_complementary_oncall', 'esi.sal_more_oncall', 'esi.sal_dismissal_oncall', 'it.type', 'it.name', 'esi.id AS id_i');
            $this->conditions = array('AND', 'esi.effect_from = ?', 'esi.effect_to = ?', 'it.group_id = esi.inconvenient_group_id', 'esi.employee = ?', 'it.group_id = ?');
            $this->condition_values = array($data1[0]['effect_from'], $data1[0]['effect_to'], $data1[0]['employee'], $inconvenients[$i]['group_id']);
//            echo "<pre>". print_r($this->condition_values, 1)."</pre>";  
            $this->query_generate();
//            echo $this->sql_query;
            $data2 = $this->query_fetch();
            if ($data2) {
                $result[] = $data2[0];
            } else {
                $result[] = array('inconvenient_group_id' => $inconvenients[$i]['group_id'], 'amount' => 0, 'name' => $inconvenients[$i]['name'], 'type' => $inconvenients[$i]['type']);
            }
        }
        return $result ? $result : $this->get_inconvenient_names();
    }

    function get_effects_acc_id($ids) {
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('effect_from', 'effect_to');
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        $this->query_generate();
        $data1 = $this->query_fetch();
        return $data1 ? $data1[0] : array();
    }

    function get_all_salary_dates_inconv($emp) {
        $result = array();
        $this->tables = array('employee_salary_inconvenient');
        $this->fields = array('DISTINCT(effect_from)');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        for ($i = 0; $i < count($data); $i++) {
            $this->tables = array('employee_salary_inconvenient');
            $this->fields = array('MAX(id) AS ids');
            $this->conditions = array('AND', 'effect_from = ?');
            $this->condition_values = array($data[$i]['effect_from']);
            $this->query_generate();
            $data1 = $this->query_fetch();
            $result[$i]['effect_from'] = $data[$i]['effect_from'];
            $result[$i]['id'] = $data1[0]['ids'];
        }
        return $result ? $result : array();
    }

    function update_employee_monthly_salary($emp, $val) {
        $this->tables = array('employee');
        $this->fields = array('monthly_salary');
        $this->field_values = array($val);
        $this->conditions = array('username = ?');
        $this->condition_values = array($emp);
        return $this->query_update();
    }

    function get_employee_salary_monthly($emp) {
        $this->tables = array('employee');
        $this->fields = array('monthly_salary');
        $this->conditions = array('username = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }

    function employee_salary_monthly($emp, $effect_from) {
        $this->tables = array('emp_salary');
        $this->fields = array('emp_username', 'date_from', 'date_to');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            $overlap = 0;
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['date_to'] == null) {
                    if (($data[$i]['date_from'] >= $effect_from))
                        $overlap = 1;
                } else {
                    if (($data[$i]['date_from'] <= $effect_from) && ($data[$i]['date_to'] >= $effect_from))
                        $overlap = 1;
                }
            }
            if ($overlap == 0)
                return $this->add_monthly_salary($emp, $effect_from);
            else
                return false;
        }
        else
            return $this->add_monthly_salary($emp, $effect_from);
    }

    function add_monthly_salary($emp, $effect_from) {
        if ($this->give_monthly_salary_date_to($emp, $effect_from)) {
            $this->tables = array('emp_salary');
            $this->fields = array('emp_username', 'date_from', 'date_to', 'salary_per_month', 'salary_per_hour', 'added_by');
            $this->field_values = array($emp, $effect_from, null, $this->salary_per_month, $this->salary_per_hour, $_SESSION['user_id']);
            if ($this->query_insert()) {
                $this->last_emp_sal_id = $this->get_id();
                return TRUE;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    function give_monthly_salary_date_to($emp, $effect_from) {
        $this->tables = array('emp_salary');
        $this->fields = array('MAX(salaryId) AS ids');
        $this->conditions = array('emp_username = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            $this->tables = array('emp_salary');
            $this->fields = array('date_to');
            $this->field_values = array(date('Y-m-d', (strtotime('-1 day', strtotime($effect_from)))));
            $this->conditions = array('salaryId = ?');
            $this->condition_values = array($data[0]['ids']);
            if ($this->query_update()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    function edit_monthly_sal($emp, $effect_from, $effect_to, $ids) {
        $this->tables = array('emp_salary');
        $this->fields = array('emp_username', 'date_from', 'date_to');
        $this->conditions = array('AND', 'emp_username = ?', 'salaryId <> ?');
        $this->condition_values = array($emp, $ids);
        $this->query_generate();
        // echo $this->sql_query;
        // echo '<pre>'.print_r($this->condition_values, 1).'</pre>';
        $data = $this->query_fetch();
        // echo 'data<pre>'.print_r($data, 1).'</pre>';
        if ($data) {
            $overlap = 0;

            for ($i = 0; $i < count($data); $i++) {

                if ($effect_to == null) {

                    if ($data[$i]['date_to'] == null) {
                        if (($data[$i]['date_from'] >= $effect_from)) {
                            $overlap = 1;
                        }
                    } else {
                        if (($data[$i]['date_from'] <= $effect_from) && ($data[$i]['date_to'] >= $effect_from)) {
                            $overlap = 1;
                        }
                    }
                } else {
                    if ($data[$i]['date_to'] == null) {
                        if (($data[$i]['date_from'] >= $effect_from) && ($data[$i]['date_from'] <= $effect_to)) {
                            $overlap = 1;
                        }
                    } else {
                        if (($data[$i]['date_from'] <= $effect_from) && ($data[$i]['date_to'] >= $effect_from) || ($data[$i]['date_from'] <= $effect_to) && ($data[$i]['date_to'] >= $effect_to)) {
                            $overlap = 1;
                        }
                    }
                }
            }
            echo $overlap;
            if ($overlap == 0) {
                $this->tables = array('emp_salary');
                $this->fields = array('emp_username', 'date_from', 'date_to', 'salary_per_month', 'salary_per_hour', 'added_by');
                $this->field_values = array($emp, $effect_from, $effect_to, $this->salary_per_month, $this->salary_per_hour, $_SESSION['user_id']);
                $this->conditions = array('salaryId = ?');
                $this->condition_values = array($ids);
                return $this->query_update();
            }
            else
                return false;
        }
        else {
            $this->tables = array('emp_salary');
            $this->fields = array('emp_username', 'date_from', 'date_to', 'salary_per_month', 'salary_per_hour', 'added_by');
            $this->field_values = array($emp, $effect_from, $effect_to, $this->salary_per_month, $this->salary_per_hour, $_SESSION['user_id']);
            $this->conditions = array('salaryId = ?');
            $this->condition_values = array($ids);
            return $this->query_update();
            // return TRUE;
        }

    }

    function employer_signing_transaction($this_customer, $month, $year, $fkkn, $employer_role = '', $this_employee = '') {
        /**
         * Author: Shamsu
         * for: signing employer - main transaction function
         * Used in: FKKN report interface
         */
        require_once('class/leave.php');
        require_once('class/inconvenient.php');

        $dona = new dona();
        $obj_leave = new leave();
        $obj_inconv = new inconvenient();
        $sign_type = '';    //indicate all employee signing
        if ($this_employee == '') {
            $sign_type = 1;
            $permitted_employees = $this->employees_list_for_right_click($_SESSION['user_id']);
            $permitted_employees_ids = array();
            $all_employee_names = array();
            $employee_names = array();
            if (!empty($permitted_employees)) {
                foreach ($permitted_employees as $p_employee) {
                    $permitted_employees_ids[] = $p_employee['username'];
                }
                $all_employee_names = $dona->get_all_Member_details_for_customer_with_no_trainee($this_customer, $fkkn, $month, $year, $permitted_employees_ids);

                if (!empty($all_employee_names)) {
                    foreach ($all_employee_names as $employee_s) {
                        $employee_names[] = $employee_s['empID'];
                    }
                }
            }
        } else {
            $sign_type = 2;
            $employee_names = array($this_employee);
        }
        
        //check report employee already sign self - monthly sign
        $employee_self_sign_violated_flag = FALSE;
        if (!empty($employee_names)){ 
            foreach ($employee_names as $emp) {
                $employee_signing_details = $this->get_signin_details_by_employee_customer($year, $month, $emp, $this_customer);
                if(empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$emp]['signin_employee'] == ''){
                    if (($key = array_search($emp, $employee_names)) !== false) {
                        unset($employee_names[$key]);
                    }
                    
                }
            }
        }
        if(empty($employee_names)){
            $employee_self_sign_violated_flag = TRUE;
        }
        

        $composed_fkkn = ($fkkn == 3 ? 2 : $fkkn);
        $this->tables = array('signing_employer');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'year = ?', 'month = ?', 'fkkn = ?');
//        $this->condition_values = array($this_customer, $year, $month, $fkkn);
        $this->condition_values = array($this_customer, $year, $month, $composed_fkkn);
        $this->query_generate();
        $sign_data = $this->query_fetch();
        if (!empty($sign_data))
            $exist_flag = TRUE;
        else
            $exist_flag = FALSE;

        //------------------------this for report signing options----------------------
        $this->signing_report_date = $year . '-' . $month . '-1';
        $this->rpt_customer = $this_customer;
        //----------------------- report signing options- endz---------------------

        $out_flag = TRUE;
        if (empty($employee_names))  // have no employees 
            return FALSE;
        else if($employee_self_sign_violated_flag)  //employee not sign self - monthly report
            return 'SELF_SIGN_VIOLATED';
        else if ($exist_flag) {          //if already exists sign details with this month/year/customer/fkkn
            $this->begin_transaction();
            $master_id = $sign_data[0]['id'];
            if ($sign_type == 1) {    //all employee feeding
                /* $this->tables = array('signing_employer_data');
                  $this->conditions = array('master_id = ?');
                  $this->condition_values = array($master_id);
                  if ($this->query_delete()) { */     //delete all existing signing data
                foreach ($employee_names as $emp) {     //re-enter signing data for each employees
                    $this->tables = array('signing_employer_data');
                    $this->fields = array('master_id');
                    $this->conditions = array('AND', 'master_id = ?', 'employee = ?');
                    $this->condition_values = array($master_id, $emp);
                    $this->query_generate();
                    $sign_emp_data = $this->query_fetch();
                    if (empty($sign_emp_data)) { //if not exist data 
                        $this->tables = array('signing_employer_data');
                        $this->fields = array('master_id', 'employee', 'employer', 'employer_role', 'employer_sign', 'employer_ocs');
                        $this->field_values = array($master_id, $emp, $_SESSION['user_id'], $employer_role, $this->signauture, $this->ocs);
                        $transaction_flag = $this->query_insert();
                        if ($transaction_flag && $out_flag) {
                            $out_flag = TRUE;
                            //save employee-monthly-report signing
                            $this->username = $emp;
                            $untreated_leaves = $obj_leave->check_untreated_employee_leave_in_a_customer($emp, $year, $month, $this_customer);
                        $untreated_candg_slots = $obj_inconv->check_untreated_candg_slots($emp, $this_customer, $month, $year);
                        if($untreated_leaves){
                            //echo $signing_message = $smarty->translate['untreated_leave_exists_contact_TL'];
                            $out_flag = FALSE;
                        }elseif($untreated_candg_slots){
                            //echo $signing_message = $smarty->translate['untreated_candg_slot_exists'];
                            $out_flag = FALSE;
                        }else
                            $this->employee_signing_Transaction();
                        } else {
                            $out_flag = FALSE;
                            break;
                        }
                    }
                }
                /* }
                  else
                  $out_flag = FALSE; */
            } else {  //feed only a single employee
                $this->tables = array('signing_employer_data');
                $this->fields = array('master_id');
                $this->conditions = array('AND', 'master_id = ?', 'employee = ?');
                $this->condition_values = array($master_id, $employee_names[0]);
                $this->query_generate();
                $sign_emp_data = $this->query_fetch();
                if (empty($sign_emp_data)) { //if not exist data 
                    $this->tables = array('signing_employer_data');
                    $this->fields = array('master_id', 'employee', 'employer', 'employer_role' ,'employer_sign', 'employer_ocs');
                    $this->field_values = array($master_id, $employee_names[0], $_SESSION['user_id'], $employer_role, $this->signauture, $this->ocs);
                    if ($this->query_insert()) {
                        $out_flag = TRUE;

                        //save employee-monthly-report signing
                        $this->username = $employee_names[0];
                        $untreated_leaves = $obj_leave->check_untreated_employee_leave_in_a_customer($employee_names[0], $year, $month, $this_customer);
                        $untreated_candg_slots = $obj_inconv->check_untreated_candg_slots($employee_names[0], $this_customer, $month, $year);
                        if($untreated_leaves){
                            //echo $signing_message = $smarty->translate['untreated_leave_exists_contact_TL'];
                            $out_flag = FALSE;
                        }elseif($untreated_candg_slots){
                            //echo $signing_message = $smarty->translate['untreated_candg_slot_exists'];
                            $out_flag = FALSE;
                        }else
                        $this->employee_signing_Transaction();
                    }
                    else
                        $out_flag = FALSE;
                }
                else
                    $out_flag = TRUE;
            }
        }else {          //not existed in master signing table (fresh entry)
            $this->begin_transaction();
            $this->flush();
            $this->tables = array('signing_employer');
            $this->fields = array('customer', 'year', 'month', 'fkkn');
//            $this->field_values = array($this_customer, $year, $month, $fkkn);
            $this->field_values = array($this_customer, $year, $month, $composed_fkkn);
            if ($this->query_insert()) {          //create a new master table entry
                $out_flag = TRUE;
                $master_id = $this->get_id();
                foreach ($employee_names as $emp) {     //create signing data entries for each employees
                    $this->flush();
                    $this->tables = array('signing_employer_data');
                    $this->fields = array('master_id', 'employee', 'employer', 'employer_role', 'employer_sign', 'employer_ocs');
                    $this->field_values = array($master_id, $emp, $_SESSION['user_id'], $employer_role, $this->signauture, $this->ocs);
                    $transaction_flag = $this->query_insert();
                    if ($transaction_flag && $out_flag) {
                        $out_flag = TRUE;

                        //save employee-monthly-report signing
                        $this->username = $emp;
                        $untreated_leaves = $obj_leave->check_untreated_employee_leave_in_a_customer($emp, $year, $month, $this_customer);
                        $untreated_candg_slots = $obj_inconv->check_untreated_candg_slots($emp, $this_customer, $month, $year);
                        if($untreated_leaves){
                            //echo $signing_message = $smarty->translate['untreated_leave_exists_contact_TL'];
                            $out_flag = FALSE;
                        }elseif($untreated_candg_slots){
                            //echo $signing_message = $smarty->translate['untreated_candg_slot_exists'];
                            $out_flag = FALSE;
                        }else
                        $this->employee_signing_Transaction();
                    } else {
                        $out_flag = FALSE;
                        break;
                    }
                }
            }
            else
                $out_flag = FALSE;
        }

        if ($out_flag) {
            $this->commit_transaction();
            return TRUE;
        } else {
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function employer_signing_remove_transaction($this_customer, $month, $year, $fkkn, $this_employee = '' ,$sign_employer = null,$sign_sutl = null ) {
        /**
         * Author: Shamsu
         * for: remove employer signing
         * Used in: FKKN report interface
         */

        require_once('class/report_signing.php');
        $obj_rpt = new report_signing();
        $deleted_rpt_signing_details = array();
        $out_flag = TRUE;
        $composed_fkkn = ($fkkn == 3 ? 2 : $fkkn);
        $this->begin_transaction();
        if ($this_employee == '') {
            $all_employer_signed_employees = $this->employer_signing_details($this_customer, $month, $year, $fkkn); // for monthly rpt signing remove
            
            foreach ($all_employer_signed_employees[0]['employee_data'] as $key => $value) {
               $all_employer_signed_employees[0]['employee_data'][$key]['sign_sutl'] = $obj_rpt->get_report_details($year,$month,$value['employee'], $this_customer)['signin_sutl'];
            }
            $this->tables = array('signing_employer');
            $this->conditions = array('AND', 'customer = ?', 'year = ?', 'month = ?', 'fkkn = ?');
//            $this->condition_values = array($this_customer, $year, $month, $fkkn);
            $this->condition_values = array($this_customer, $year, $month, $composed_fkkn);
            if ($this->query_delete()) {
                $out_flag = TRUE;
                $this->tables = array('report_signing_delete');
                $this->fields = array('customer', 'report_date','deleted_by','type');
                $this->field_values = array($this_customer, $year."-".$month."-01",$_SESSION['user_id'],1);
                $this->query_insert();
                //delete monthly rpt signing details
                if (!empty($all_employer_signed_employees) && !empty($all_employer_signed_employees[0]['employee_data'])) {
                    foreach ($all_employer_signed_employees[0]['employee_data'] as $key => $employee_s) {
                        $this_ret_flag = $this->employee_signing_remove_by_user_login($employee_s['employee'], $month, $year, $this_customer);
                            $deleted_rpt_signing_details[$key]['employee'] = $employee_s['employee'];
                            $deleted_rpt_signing_details[$key]['employer'] = $employee_s['employer'];
                            $deleted_rpt_signing_details[$key]['sign_sutl'] = $employee_s['sign_sutl'];
                        $out_flag = ($out_flag && $this_ret_flag ? TRUE : FALSE);
                        if (!$out_flag)
                            break;
                    }
                }
            }
            else
                $out_flag = FALSE;
        } else {

            if($sign_employer != null){
                $deleted_rpt_signing_details[0]['employee'] = $this_employee;
                $deleted_rpt_signing_details[0]['employer'] = $sign_employer;
                $deleted_rpt_signing_details[0]['sign_sutl'] = $sign_employer;

            }
            // var_dump($deleted_rpt_signing_details);
            // exit('d');

            $this->tables = array('signing_employer');
            $this->fields = array('id');
            $this->conditions = array('AND', 'customer = ?', 'year = ?', 'month = ?', 'fkkn = ?');
//            $this->condition_values = array($this_customer, $year, $month, $fkkn);
            $this->condition_values = array($this_customer, $year, $month, $composed_fkkn);
            $this->query_generate();
            $sign_data = $this->query_fetch();
            if (!empty($sign_data)) {
                $master_id = $sign_data[0]['id'];
                $this->tables = array('signing_employer_data');
                $this->fields = array('master_id');
                $this->conditions = array('AND', 'master_id = ?', 'employee = ?');
                $this->condition_values = array($master_id, $this_employee);

                if ($this->query_delete()) {
                    $this->tables = array('report_signing_delete');
                    $this->fields = array('employee', 'customer', 'report_date','deleted_by','type');
                    $this->field_values = array($this_employee, $this_customer, $year."-".$month."-01",$_SESSION['user_id'],1);
                    $this->query_insert();
                    //delete monthly rpt signing details
                    if ($this->employee_signing_remove_by_user_login($this_employee, $month, $year, $this_customer)) {
                        //remove entire employer signing data if all none of employees exists
                        $after_result = $this->employer_signing_details($this_customer, $month, $year, $fkkn);
                                
                        if (empty($after_result[0]['employee_data'])) {
                            $this->tables = array('signing_employer');
                            $this->conditions = array('AND', 'id = ?');
                            $this->condition_values = array($master_id);
                            $out_flag = ($this->query_delete() ? TRUE : FALSE);
                        }
                        else
                            $out_flag = TRUE;
                    }
                    else
                        $out_flag = TRUE;
                }
                else
                    $out_flag = FALSE;
            }
        }
        if ($out_flag) {
            $smarty = new smartySetup(array('messages.xml',"forms.xml", 'user.xml', 'button.xml','mail.xml'), FALSE);
            require_once('class/customer.php');
            $obj_cus = new customer();

            $this->commit_transaction();
            foreach ($deleted_rpt_signing_details as $key => $value) {
                $msg        = '';
                $subject    = '';
                $msg_header = '';
                $employee_detail    = $this->get_employee_detail($deleted_rpt_signing_details[$key]['employee']);
                $employee_name      = $_SESSION['company_sort_by'] == 1 ? $employee_detail['first_name'] . ' ' . $employee_detail['last_name'] : $employee_detail['last_name'] . ' ' . $employee_detail['first_name'];
                
                $deleted_emp_detail = $this->get_employee_detail($_SESSION['user_id']);
                $deleted_emp_name   = $_SESSION['company_sort_by'] == 1 ? $deleted_emp_detail['first_name'] . ' ' . $deleted_emp_detail['last_name'] : $deleted_emp_detail['last_name'] . ' ' . $deleted_emp_detail['first_name'];
                
                $customer_detail    = $obj_cus->customer_detail($this_customer);
                $customer_name      = $_SESSION['company_sort_by'] == 1 ? $customer_detail['first_name'] . ' ' . $customer_detail['last_name'] : $customer_detail['last_name'] . ' ' . $customer_detail['first_name'];

                $employer_email     = $this->get_employee_detail($deleted_rpt_signing_details[$key]['employer'])['email'];

                $sign_sutl_email     = $this->get_employee_detail($deleted_rpt_signing_details[$key]['sign_sutl'])['email'];

                
                $subject     = $smarty->translate[signed_report_delete_mail_subject];
                $msg_header  = $smarty->translate[signed_report_delete_details].'<br><br><br>';
                $msg         = $smarty->translate[year].':'.$year.'<br>';
                $msg        .= $smarty->translate[month].':'.$month.'<br>';
                $msg        .= $smarty->translate[employee].':'.$employee_name.'<br>';
                $msg        .= $smarty->translate[customer].':'.$customer_name.'<br>';
                $msg        .= $smarty->translate[deleted_by].':'.$deleted_emp_name.'<br>';
                $msg        .= $smarty->translate[date].':'.date('Y:m:d h:i:s ').'<br>';

                $msg = $msg_header.$msg;

                $mailer_upadte = new SimpleMail($subject,$msg);
                $mailer_upadte->addSender("cirrus-noreplay@time2view.se");

                if($deleted_rpt_signing_details[$key]['employer'] != $_SESSION['user_id']){
                        $mailer_upadte->addRecipient($employer_email, trim($employer_email));
                        $mailer_upadte->send();
                }   

                if($deleted_rpt_signing_details[$key]['sign_sutl'] != $_SESSION['user_id']){
                        $mailer_upadte->addRecipient($sign_sutl_email, trim($sign_sutl_email));
                        $mailer_upadte->send();
                } 
            }
            return TRUE;
        } else {
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function employer_signing_details($this_customer, $month, $year, $fkkn, $this_employee = '') {
        /**
         * Author: Shamsu
         * for: get employer siging details
         * Used in: FKKN report interface
         */
        //echo "<pre>".print_r(func_get_args(),1)."</pre>";
        $composed_fkkn = ($fkkn == 3 ? 2 : $fkkn);
        $this->tables = array('signing_employer');
        $this->fields = array('id', 'customer', 'year', 'month', 'fkkn');
        $this->conditions = array('AND', 'customer = ?', 'year = ?', 'month = ?', 'fkkn = ?');
//        $this->condition_values = array($this_customer, $year, $month, $fkkn);
        $this->condition_values = array($this_customer, $year, $month, $composed_fkkn);
        $this->query_generate();
        $sign_data = $this->query_fetch();
        
        if (!empty($sign_data)) {
            $this->tables = array('signing_employer_data` as `sed', 'employee` as `e', 'employee` as `e1', 'report_signing` as `rs');
            $this->fields = array('sed.employee', 'concat(e1.first_name, " ", e1.last_name) employee_name', 'concat(e1.last_name, " ", e1.first_name) employee_name_lf', 'sed.signing_date', 'sed.employer', 'sed.employer_role', 'concat(e.last_name, " ", e.first_name) employer_name', 'e.mobile as employer_mobile', 'e.phone as employer_phone', 'e1.mobile as employee_mobile', 'e1.phone as employee_phone', 'sed.employer_sign', 'sed.employer_ocs', 'rs.employee_sign', 'rs.employee_ocs');
            if ($this_employee == '') {  //get all employees data
                $this->conditions = array('AND', 'sed.master_id = ?', 'sed.employer = e.username', 'sed.employee = e1.username', 'rs.employee = sed.employee', 'rs.customer = ?', 'MONTH(rs.date) = ?', 'YEAR(rs.date) = ?');
                $this->condition_values = array($sign_data[0]['id'], $this_customer, $month, $year);
            } else {      //get specific employee data
                $this->conditions = array('AND', 'sed.master_id = ?', 'sed.employee = ?', 'sed.employer = e.username', 'sed.employee = e1.username', 'rs.employee = sed.employee', 'rs.customer = ?', 'MONTH(rs.date) = ?', 'YEAR(rs.date) = ?');
                $this->condition_values = array($sign_data[0]['id'], $this_employee, $this_customer, $month, $year);
            }
            $this->query_generate();
            
            $sign_emp_data = $this->query_fetch();
            
            $sign_data[0]['employee_data'] = $sign_emp_data;

            return $sign_data;
        }
        else
            return array();
    }

    function employer_signing_details_for_remove($this_customer, $month, $year, $fkkn, $this_employee = '') {
        /**
         * Author: Shamsu
         * for: get employer siging details
         * Used in: FKKN report interface
         */
        //echo "<pre>".print_r(func_get_args(),1)."</pre>";
        $composed_fkkn = ($fkkn == 3 ? 2 : $fkkn);
        $this->tables = array('signing_employer');
        $this->fields = array('id', 'customer', 'year', 'month', 'fkkn');
        $this->conditions = array('AND', 'customer = ?', 'year = ?', 'month = ?', 'fkkn = ?');
//        $this->condition_values = array($this_customer, $year, $month, $fkkn);
        $this->condition_values = array($this_customer, $year, $month, $composed_fkkn);
        $this->query_generate();
        $sign_data = $this->query_fetch();
        //echo "<pre>".print_r($sign_data,1)."</pre>";
        if (!empty($sign_data)) {
            $this->tables = array('signing_employer_data` as `sed', 'employee` as `e', 'employee` as `e1');
            $this->fields = array('sed.employee', 'concat(e1.first_name, " ", e1.last_name) employee_name', 'concat(e1.last_name, " ", e1.first_name) employee_name_lf', 'sed.signing_date', 'sed.employer', 'sed.employer_role', 'concat(e.last_name, " ", e.first_name) employer_name', 'e.mobile as employer_mobile', 'e.phone as employer_phone', 'e1.mobile as employee_mobile', 'e1.phone as employee_phone', 'sed.employer_sign', 'sed.employer_ocs');
            if ($this_employee == '') {  //get all employees data
                $this->conditions = array('AND', 'sed.master_id = ?', 'sed.employer = e.username', 'sed.employee = e1.username');
                $this->condition_values = array($sign_data[0]['id']);
            } else {      //get specific employee data
                $this->conditions = array('AND', 'sed.master_id = ?', 'sed.employee = ?', 'sed.employer = e.username', 'sed.employee = e1.username');
                $this->condition_values = array($sign_data[0]['id'], $this_employee);
            }
            $this->query_generate();
            //echo $this->sql_query;
            //echo "<pre>".print_r($this->condition_values,1)."</pre>";
            $sign_emp_data = $this->query_fetch();

            $sign_data[0]['employee_data'] = $sign_emp_data;
            return $sign_data;
        }
        else
            return array();
    }

    // getting the multiple slot details
    function get_multiple_slot_details($array_of_ids = NULL, $date = NULL, $slot_customer = NULL, $slot_employee = NULL) {
        /**
         * Author: Shamsu
         * for: get multiple slot details
         * Used In: gdschema alloc window - schema delete section
         * returns:  
         *      -   all slots(expt leave) in a date when <$array_of_ids = NULL and $date != NULL and ($slot_customer != NULL || $slot_employee != NULL)>
         *      -   all slots(expt leave) by using their ids when <$date = NULL>
         *      -   all slots(expt leave) by ids and date when <$array_of_ids != NULL and $date != NULL>
         */
        $id_string = '';
        if (trim($slot_customer) == '')
            $slot_customer = NULL;
        if (trim($slot_employee) == '')
            $slot_employee = NULL;

        if ($array_of_ids != NULL)
            $id_string = '\'' . implode('\', \'', $array_of_ids) . '\'';

        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id');
        $this->conditions = array('AND', 'status != 2');
        $this->condition_values = array();
        if ($array_of_ids == NULL && $date != NULL && ($slot_customer != NULL || $slot_employee != NULL)) {
            $this->conditions[] = 'date = ?';
            $this->condition_values[] = $date;
            if ($slot_customer != NULL) {
                $this->conditions[] = 'customer = ?';
                $this->condition_values[] = $slot_customer;
            }
            if ($slot_employee != NULL) {
                $this->conditions[] = 'employee = ?';
                $this->condition_values[] = $slot_employee;
            }
        } elseif ($date == NULL)
            $this->conditions[] = array('IN', 'id', $id_string);
        else {
            $this->conditions[] = 'date = ?';
            $this->conditions[] = array('IN', 'id', $id_string);
            $this->condition_values[] = $date;
        }
        $this->order_by = array('date', 'time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function delete_multiple_slots_as_week_basis($slots, $from_wk, $to_wk, $from_option, $days) {

        /**
         * Author: Shamsu <shamsu@arioninfotech.com>
         * for: performing schema delete
         * Used in: gdschema alloc window module
         */
        require_once ('plugins/message.class.php');
        $from_wk = str_pad($from_wk, 2, '0', STR_PAD_LEFT);
        $to_wk = str_pad($to_wk, 2, '0', STR_PAD_LEFT);

        $msg = new message();
//        $dona = new dona();

        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }

//        $paste_start_date = date('Y-m-d', strtotime(date('Y') . "W" . $from_wk . '1'));
        $first_slot_date = $slots[0]['date'];
        $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_wk . '1'));
        $paste_year = substr($to_wk, 0, 4);
        $paste_week = str_pad(substr($to_wk, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
        $delete_flag = true;
        $paste_date = $paste_start_date;
        $deletion_slot_ids = array();
        //this while block checks any employees are signed or not 
        while (strtotime($paste_date) <= strtotime($paste_end_date)) {
            if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                foreach ($slots as $data) {
                    $this->tables = array('timetable');
                    $this->fields = array('id', 'time_from', 'time_to');
                    $this->conditions = array('AND', 'time_from = ?', 'time_to = ?', 'date=?', 'fkkn = ?', 'type = ?', 'status != 2');
                    $this->condition_values = array((float) $data['time_from'], (float) $data['time_to'], $paste_date, $data['fkkn'], $data['type']);

                    if (trim($data['employee']) != '') {
                        $this->conditions[] = 'employee = ?';
                        $this->condition_values[] = $data['employee'];
                    } else {
                        $this->conditions[] = array('OR', 'employee = ?', 'employee IS NULL');
                        $this->condition_values[] = '';
                    }

                    if (trim($data['customer']) != '') {
                        $this->conditions[] = 'customer = ?';
                        $this->condition_values[] = $data['customer'];
                    } else {
                        $this->conditions[] = array('OR', 'customer = ?', 'customer IS NULL');
                        $this->condition_values[] = '';
                    }

                    $this->query_generate();
                    $__founded_slots = $this->query_fetch();
                    if (!empty($__founded_slots)) {
                        if ($data['employee'] != '' && $data['customer'] != '') {
                            if ($this->chk_employee_rpt_signed($data['employee'], $data['customer'], $paste_date, TRUE)) {
                                $delete_flag = false;
                                return false;
                            }
                        }
                        foreach ($__founded_slots as $__founded_slot)
                            $deletion_slot_ids[] = $__founded_slot['id'];
                    }
                }
            }
            if (date('N', strtotime($paste_date)) == 7)
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
            $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
        }
//        echo "<pre>deletion_slot_ids: ".print_r($deletion_slot_ids, 1)."</pre>";
        //deletion operations begins
        if ($delete_flag) {
            $this->begin_transaction();
            if (!$this->customer_employee_slot_remove($deletion_slot_ids, TRUE)) {
                $msg->set_message('fail', 'slot_delete_failed');
                $this->rollback_transaction();
                $delete_flag = false;
                return false;
            }
        }
        if ($delete_flag) {
            $msg->set_message('success', 'slot_delete_success');
            $this->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'slot_delete_failed');
            $this->rollback_transaction();
            return false;
        }
    }

    function schema_employee_assign_to_slot_multiple($sel_employee_to_assign, $sel_slots, $from_week, $to_week, $from_option, $sel_days) {
        /**
         * Author: Shamsu
         * for: performing schema employee assignment as week basis
         * Used in: gdschema alloc window - module
         * Function request from - gdschema_process_schemaAssign.php -> ajax-alloc-action.php<action = multiple_slot_assign>
         */
        require_once ('plugins/message.class.php');
        $from_week = str_pad($from_week, 2, '0', STR_PAD_LEFT);
        $to_week = str_pad($to_week, 2, '0', STR_PAD_LEFT);

        $msg = new message();
        $obj_dona = new dona();
        $obj_customer = new customer();
        $weeks = "'";
        $i = 0;

        foreach ($sel_days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }

//        $paste_start_date = date('Y-m-d', strtotime(date('Y') . "W" . $from_week . '1'));
        $first_slot_date = $sel_slots[0]['date'];
        $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
        $paste_year = substr($to_week, 0, 4);
        $paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
        $assign_flag = true;
        $paste_date = $paste_start_date;
        $slot_ids_for_assign = array();

        $this->begin_transaction();
        $obj_dona->begin_transaction();
        //this while block checks any employee for this slots are collide or not
        while (strtotime($paste_date) <= strtotime($paste_end_date)) {
            if (in_array((date('N', strtotime($paste_date)) % 7), $sel_days)) {
                foreach ($sel_slots as $data) {
                    $this->tables = array('timetable');
                    $this->fields = array('id', 'time_from', 'time_to');
                    $this->conditions = array('AND', 'time_from = ?', 'time_to = ?', 'date=?', 'customer = ?', 'fkkn = ?', 'type = ?', 'status != 2', array('OR', 'employee is null', 'employee = ?'));
                    $this->condition_values = array((float) $data['time_from'], (float) $data['time_to'], $paste_date, $data['customer'], $data['fkkn'], $data['type'], '');
                    $this->query_generate();
                    $__founded_slots = $this->query_fetch();
                    if (!empty($__founded_slots)) {
                        //check this employee is available for this slot
                        $available_user = $this->get_available_users($data['customer'], (float) $data['time_from'], (float) $data['time_to'], $paste_date, $sel_employee_to_assign);
                        if (!empty($available_user)) {
                            $slot_ids_for_assign[] = $__founded_slots[0]['id'];
                        } else {
                            $assign_flag = false;
                            $emp_details = $this->get_employee_detail($sel_employee_to_assign);
                            $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                            //check employee is leave or not
                            $leave_data = $this->is_employee_leave($sel_employee_to_assign, $paste_date, $data['time_from'], $data['time_to']);
                            if ($leave_data !== FALSE) {
                                $msg->set_message('fail', 'employee_took_a_leave');
                                $msg->set_message_exact('fail', $emp_name . ' ' . $leave_data[0]['date'] . ' ' . str_pad($leave_data[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($leave_data[0]['time_to'], 5, '0', STR_PAD_LEFT));
                            } else if ($this->chk_employee_rpt_signed($sel_employee_to_assign, $data['customer'], $paste_date)) {   //check already signed
                                $customer_details = $obj_customer->customer_detail($data['customer']);
                                $cust_name = $customer_details['last_name'] . ' ' . $customer_details['first_name'];
                                $msg->set_message('fail', 'employee_signed_in');
                                $msg->set_message_exact('fail', $emp_name . ' <-> ' . $cust_name . ' => ' . $paste_date);
                            } else {      //otherwise slot collides
                                $msg->set_message('fail', 'slot_collide');
                                $msg->set_message_exact('fail', $emp_name . ' ' . $paste_date . ' ' . str_pad($__founded_slots[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($__founded_slots[0]['time_to'], 5, '0', STR_PAD_LEFT));
                            }
                            $this->rollback_transaction();
                            $obj_dona->rollback_transaction();
                            return false;
                        }
                    } else {
                        //else part is for creating new timeslot with new employee and slot credentials
                        $available_user = $this->get_available_users($data['customer'], (float) $data['time_from'], (float) $data['time_to'], $paste_date, $sel_employee_to_assign);
                        if (!empty($available_user)) {
                            //create new slot
                            if (!$obj_dona->customer_employee_slot_add($sel_employee_to_assign, $data['customer'], $paste_date, (float) $data['time_from'], (float) $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                $msg->set_message('fail', 'slot_operation_failed');
                                $this->rollback_transaction();
                                $obj_dona->rollback_transaction();
                                return false;
                            }
                        } else {
                            $assign_flag = false;
                            $emp_details = $this->get_employee_detail($sel_employee_to_assign);
                            $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                            //check employee is leave or not
                            $leave_data = $this->is_employee_leave($sel_employee_to_assign, $paste_date, $data['time_from'], $data['time_to']);
                            if ($leave_data !== FALSE) {
                                $msg->set_message('fail', 'employee_took_a_leave');
                                $msg->set_message_exact('fail', $emp_name . ' ' . $leave_data[0]['date'] . ' ' . str_pad($leave_data[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($leave_data[0]['time_to'], 5, '0', STR_PAD_LEFT));
                            } else if ($this->chk_employee_rpt_signed($sel_employee_to_assign, $data['customer'], $paste_date)) {   //check already signed
                                $customer_details = $obj_customer->customer_detail($data['customer']);
                                $cust_name = $customer_details['last_name'] . ' ' . $customer_details['first_name'];
                                $msg->set_message('fail', 'employee_signed_in');
                                $msg->set_message_exact('fail', $emp_name . ' <-> ' . $cust_name . ' => ' . $paste_date);
                            } else {      //otherwise slot collides
                                $collided_slots = $this->get_collide_slots($sel_employee_to_assign, $data['time_from'], $data['time_to'], $paste_date); // for getting exact collide slot values
                                $msg->set_message('fail', 'slot_collide');
                                $msg->set_message_exact('fail', $emp_name . ' ' . $paste_date . ' ' . str_pad($collided_slots[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($collided_slots[0]['time_to'], 5, '0', STR_PAD_LEFT));
                            }
                            $this->rollback_transaction();
                            $obj_dona->rollback_transaction();
                            return false;
                        }
                    }
                }
            }
            if (date('N', strtotime($paste_date)) == 7)
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
            $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
        }

        //Assignment operations begins
        if ($assign_flag && !empty($slot_ids_for_assign)) {
            foreach ($slot_ids_for_assign as $slot) {
                if (!$this->employee_add_to_slot($slot, $sel_employee_to_assign, $_SESSION['user_id'])) {
                    $msg->set_message('fail', 'slot_operation_failed');
                    $this->rollback_transaction();
                    $obj_dona->rollback_transaction();
                    $assign_flag = false;
                    return false;
                }
            }
        }
        /* if (empty($slot_ids_for_assign)) {
          $msg->set_message('fail', 'no_slot_available');
          $this->rollback_transaction();
          $obj_dona->rollback_transaction();
          return false;
          } else */if ($assign_flag) {
            $msg->set_message('success', 'slot_operation_success');
            $this->commit_transaction();
            $obj_dona->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'slot_operation_failed');
            $this->rollback_transaction();
            $obj_dona->rollback_transaction();
            return false;
        }
    }

    function schema_drop_time_slots($sketch_slot, $from_week, $to_week, $from_option, $sel_days) {
        /**
         * Author: Shamsu
         * for: performing schema drop time slots as week basis
         * Used in: gdschema alloc window - module
         * Function request from - gdschema_process_schemaAssign.php -> ajax-alloc-action.php<action = drop>
         */
        require_once ('plugins/message.class.php');
        $from_week = str_pad($from_week, 2, '0', STR_PAD_LEFT);
        $to_week = str_pad($to_week, 2, '0', STR_PAD_LEFT);
        $msg = new message();
        $obj_dona = new dona();
//        $obj_customer = new customer();
//        $weeks = '\'' . implode('\', \'', $sel_days) . '\'';
//        $paste_start_date = date('Y-m-d', strtotime(date('Y') . "W" . $from_week . '1'));
        $first_slot_date = $sketch_slot['date'];
        $sketch_employee = $sketch_slot['employee'] != '' ? $sketch_slot['employee'] : NULL;
        $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
        $paste_year = substr($to_week, 0, 4);
        $paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
        $assign_flag = true;
        $paste_date = $paste_start_date;
        $time_flag = 1;     //flag for checking oncall period availability

        $obj_dona->begin_transaction();
        //this while block checks any employee for this slots are collide or not
        while (strtotime($paste_date) <= strtotime($paste_end_date)) {
            if (in_array((date('N', strtotime($paste_date)) % 7), $sel_days)) {
                if ($sketch_slot['slot_type'] == 3) { //checks oncall is available for this period
                    $time_flag = 0;
                    if ($sketch_slot['time_from'] >= $sketch_slot['time_to']) {
                        $inconv_timings1 = $this->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
                        $cur_date = strtotime($paste_date . ' 00:00:00');
                        $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
                        $inconv_timings2 = $this->get_inconvenient_on_a_day_for_customer($next_date, $sketch_slot['customer'], 3);
                        if (!empty($inconv_timings1)) {
                            foreach ($inconv_timings1 as $inconv_timing) {
                                if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
                                        (24 > $inconv_timing['time_from'] && 24 <= $inconv_timing['time_to'])) {
                                    $time_flag = 1;
                                }
                            }
                        }
                        if (!empty($inconv_timings2)) {
                            foreach ($inconv_timings2 as $inconv_timing) {
                                if ((0 >= $inconv_timing['time_from'] && 0 < $inconv_timing['time_to']) &&
                                        ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
                                    $time_flag = 1;
                                }
                            }
                        }
                    } else {
                        $inconv_timings = $this->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
                        if (!empty($inconv_timings1)) {
                            foreach ($inconv_timings as $inconv_timing) {
                                if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
                                        ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
                                    $time_flag = 1;
                                }
                            }
                        }
                    }
                }
                if ($time_flag == 0) {
                    $msg->set_message('fail', 'time_outside_oncall');
                    $msg->set_message_exact('fail', str_pad(sprintf('%.02f', (float) $sketch_slot['time_from']), 5, '0', STR_PAD_LEFT) . ' - ' . str_pad(sprintf('%.02f', (float) $sketch_slot['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . $paste_date);
                    $obj_dona->rollback_transaction();
                    return false;
                } else {
                    $default_process_flag = TRUE;
                    $sub_process_flag = TRUE;
                    if ($sketch_employee != NULL) {   //if employee exist, it checks employee is available for that period
                        $default_process_flag = FALSE;
//                            $available_user = $this->get_available_users($sketch_slot['customer'], (float) $sketch_slot['time_from'], (float) $sketch_slot['time_to'], $paste_date, $sketch_employee);
                        $process_params = array(
                            'employee' => $sketch_employee,
                            'customer' => $sketch_slot['customer'],
                            'date' => $paste_date,
                            'type' => $sketch_slot['slot_type'],
                            'time_from' => (float) $sketch_slot['time_from'],
                            'time_to' => (float) $sketch_slot['time_to']);

                        if (!$this->findout_slot_alteration_bug($process_params)) {
                            $sub_process_flag = FALSE;

                            $assign_flag = FALSE;
                            $obj_dona->rollback_transaction();
                            return FALSE;
                        }
                    }
                    if ($sub_process_flag || $default_process_flag) {
                        //create new slot
                        if ($sketch_slot['time_from'] > $sketch_slot['time_to']) {
                            $cur_date_create = strtotime($paste_date . ' 00:00:00');
                            $next_date_create = date('Y-m-d', ($cur_date_create + 24 * 3600));
                            if (!$obj_dona->customer_employee_slot_add($sketch_slot['employee'], $sketch_slot['customer'], $next_date_create, 0, (float) $sketch_slot['time_to'], $_SESSION['user_id'], 1, $sketch_slot['slot_type'])) {
                                $msg->set_message('fail', 'slot_operation_failed');
                                $obj_dona->rollback_transaction();
                                return false;
                            }

                            if (!$obj_dona->customer_employee_slot_add($sketch_slot['employee'], $sketch_slot['customer'], $paste_date, (float) $sketch_slot['time_from'], 24, $_SESSION['user_id'], 1, $sketch_slot['slot_type'])) {
                                $msg->set_message('fail', 'slot_operation_failed');
                                $obj_dona->rollback_transaction();
                                return false;
                            }
                        } else {
                            if (!$obj_dona->customer_employee_slot_add($sketch_slot['employee'], $sketch_slot['customer'], $paste_date, (float) $sketch_slot['time_from'], (float) $sketch_slot['time_to'], $_SESSION['user_id'], 1, $sketch_slot['slot_type'])) {
                                $msg->set_message('fail', 'slot_operation_failed');
                                $obj_dona->rollback_transaction();
                                return false;
                            }
                        }
                    }/* else {
                      $assign_flag = false;
                      $emp_details = $this->get_employee_detail($sketch_employee);
                      $emp_name = $emp_details['last_name']. ' '. $emp_details['first_name'];
                      if ($this->chk_employee_rpt_signed($sketch_employee, $sketch_slot['customer'], $paste_date)) {   //check already signed
                      $customer_details = $obj_customer->customer_detail($sketch_slot['customer']);
                      $cust_name = $customer_details['last_name']. ' '. $customer_details['first_name'];
                      $msg->set_message('fail', 'employee_signed_in');
                      $msg->set_message_exact('fail', $emp_name .' <-> '.$cust_name .  ' => ' . $paste_date);
                      } else {      //otherwise slot collides
                      $collided_slots = $this->get_collide_slots($sketch_employee, $sketch_slot['time_from'], $sketch_slot['time_to'], $paste_date); // for getting exact collide slot values
                      $msg->set_message('fail', 'slot_collide');
                      $msg->set_message_exact('fail', $emp_name . ' ' . $paste_date . ' ' . str_pad($collided_slots[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($collided_slots[0]['time_to'], 5, '0', STR_PAD_LEFT));
                      }
                      $obj_dona->rollback_transaction();
                      return false;
                      } */
                }
            }
            if (date('N', strtotime($paste_date)) == 7)
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
            $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
        }

        if ($assign_flag) {
            $msg->set_message('success', 'slot_operation_success');
            $obj_dona->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'slot_operation_failed');
            $obj_dona->rollback_transaction();
            return false;
        }
    }

    function schema_manual_entry_time_slots($sketch_slot, $from_week, $to_week, $from_option, $sel_days, $allow_N_to_O_convertion = FALSE, $allow_split_slot = FALSE) {
        /**
         * Author: Shamsu
         * for: performing schema manual entry time slots as week basis
         * Used in: gdschema alloc window - module
         * Function request from - gdschema_process_schemaAssign.php -> ajax-alloc-action.php<action = man_slot_entry>
         * @param: $allow_N_to_O_convertion(allow normal to oncall conversion) => 
         *              TRUE => convert entire normal slot to oncall , if both boundaries are available in oncall period
         * @param: $allow_split_slot (allow splitting of slots to seperate intermixed normal-oncall hours)
         *              TRUE => splitting of slots as normal-oncall , if normal and oncall duration are exist on this time boundary
         */
        require_once ('plugins/message.class.php');
        $from_week = str_pad($from_week, 2, '0', STR_PAD_LEFT);
        $to_week = str_pad($to_week, 2, '0', STR_PAD_LEFT);
        $msg = new message();
        $obj_dona = new dona();
        $obj_customer = new customer();
//        $weeks = '\'' . implode('\', \'', $sel_days) . '\'';
//        $paste_start_date = date('Y-m-d', strtotime(date('Y') . "W" . $from_week . '1'));
        $first_slot_date = $sketch_slot['date'];
        $sketch_employee = $sketch_slot['employee'] != '' ? $sketch_slot['employee'] : NULL;
        $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
        $paste_year = substr($to_week, 0, 4);
        $paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
        $assign_flag = true;
        $paste_date = $paste_start_date;
        $time_flag = 1;     //flag for checking oncall period availability
        $time_flag_next = 1;     //flag for checking oncall period availability

        $slot_split_time_flag = 0;
        $slot_split_time_flag_next = 0;

        $normal_slot_types = array('0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16');
        $oncall_slot_types = array('3', '9', '13', '14', '17');

        $obj_dona->begin_transaction();
        $obj_customer->begin_transaction();
        //this while block checks any employee for this slots are collide or not
        while (strtotime($paste_date) <= strtotime($paste_end_date)) {
            if (in_array((date('N', strtotime($paste_date)) % 7), $sel_days)) {

                if ($sketch_slot['time_from'] > $sketch_slot['time_to']) {      //if the time slot is on same day
//                    if($sketch_slot['slot_type'] == 3){ //checks oncall is available for this period
                    $time_flag = 0;
                    $time_flag_next = 0;
                    $inconv_timings = $this->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
                    $inconv_timings_next = $this->get_inconvenient_on_a_day_for_customer(date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day')), $sketch_slot['customer'], 3);
                    if (!empty($inconv_timings)) {
                        foreach ($inconv_timings as $inconv_timing) {
                            if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
                                    (24 > $inconv_timing['time_from'] && 24 <= $inconv_timing['time_to'])) {
                                $time_flag = 1;
                            }

                            if ($allow_split_slot) {
                                if (($inconv_timing['time_from'] >= $sketch_slot['time_from'] && $inconv_timing['time_from'] <= 24) ||
                                        ($inconv_timing['time_to'] >= $sketch_slot['time_from'] && $inconv_timing['time_to'] <= 24)) {
                                    $slot_split_time_flag = 1;
                                }
                            }
                        }
                    }
                    if (!empty($inconv_timings_next)) {
                        foreach ($inconv_timings_next as $inconv_timing) {
                            if ((0 >= $inconv_timing['time_from'] && 0 < $inconv_timing['time_to']) &&
                                    ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
                                $time_flag_next = 1;
                            }

                            if ($allow_split_slot) {
                                if (($inconv_timing['time_from'] >= 0 && $inconv_timing['time_from'] <= $sketch_slot['time_to']) ||
                                        ($inconv_timing['time_to'] >= 0 && $inconv_timing['time_to'] <= $sketch_slot['time_to'])) {
                                    $slot_split_time_flag_next = 1;
                                }
                            }
                        }
                    }
//                    }
                } else {//if the time slot is on same day
//                    if($sketch_slot['slot_type'] == 3){ //checks oncall is available for this period
                    $time_flag = 0;
                    $inconv_timings = $this->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
                    if (!empty($inconv_timings)) {
                        foreach ($inconv_timings as $inconv_timing) {
                            if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
                                    ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
                                $time_flag = 1;
                            }

                            if ($allow_split_slot) {
                                if (($inconv_timing['time_from'] >= $sketch_slot['time_from'] && $inconv_timing['time_from'] <= $inconv_timing['time_to']) ||
                                        ($inconv_timing['time_to'] >= $sketch_slot['time_from'] && $inconv_timing['time_to'] <= $inconv_timing['time_to'])) {
                                    $slot_split_time_flag = 1;
                                }
                            }
                        }
                    }
//                    }
                }

                $calculated_slot_type = $sketch_slot['slot_type'];
                $split_flag = FALSE;
                if (in_array($sketch_slot['slot_type'], $normal_slot_types)) { //normal slot
                    if ($time_flag == 1 && $time_flag_next == 1) {    //if both are on oncall boundary
                        if ($allow_N_to_O_convertion)
                            $calculated_slot_type = 3;
//                        else $calculated_slot_type = 0;
                        else
                            $calculated_slot_type = $sketch_slot['slot_type']; //updated in 2014-06-07
                    }else if ($slot_split_time_flag == 1 || $slot_split_time_flag_next == 1) {
                        if ($allow_split_slot) {
                            $calculated_slot_type = 3;
                            $split_flag = TRUE;
                        }
                    } else {
//                        $calculated_slot_type = 0;
                        $calculated_slot_type = $sketch_slot['slot_type'];  //updated in 2014-06-07
                    }
                } else if (in_array($sketch_slot['slot_type'], $oncall_slot_types) && $time_flag == 1 && $time_flag_next == 1) {  //oncall slot
//                    $calculated_slot_type = 3;
                    $calculated_slot_type = $sketch_slot['slot_type']; //updated in 2014-06-07
                } else {
                    $msg->set_message('fail', 'time_outside_oncall');
                    $msg->set_message_exact('fail', str_pad(sprintf('%.02f', (float) $sketch_slot['time_from']), 5, '0', STR_PAD_LEFT) . ' - ' . str_pad(sprintf('%.02f', (float) $sketch_slot['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . $paste_date);
                    $obj_customer->rollback_transaction();
                    $obj_dona->rollback_transaction();
                    return false;
                }
                $sketch_slot['slot_type'] = $calculated_slot_type; //updated in 2014-06-07

                if ($sketch_slot['time_from'] >= $sketch_slot['time_to']) { //if the slot enters next day
                    $cur_date = strtotime($paste_date . ' 00:00:00');
                    $next_date = date('Y-m-d', ($cur_date + 24 * 3600));

                    if ($this->is_valid_slot($sketch_employee, $sketch_slot['time_from'], 24, $paste_date) && $this->is_valid_slot($sketch_employee, 0, $sketch_slot['time_to'], $next_date)) {
                        if ($split_flag) {
                            $result_flag = TRUE;
                            $inconv_timings = $this->get_collided_inconvenients_on_a_day_for_customer($paste_date, $sketch_slot['customer'], $sketch_slot['time_from'], 24, 3);
                            $intervals = array();
                            if (!empty($inconv_timings)) {
                                $total_count = count($inconv_timings);
                                $last_time_to = $sketch_slot['time_from'];
                                foreach ($inconv_timings as $key => $inconv_timing) {
                                    $cur_time_from = $cur_time_to = $cur_time_type = '';
                                    if ($inconv_timing['time_from'] <= $last_time_to) {
                                        if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                            $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
//                                            $cur_time_type = 0;//updated in 2014-06-07
                                            $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                        }
                                        $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                        $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
//                                        $cur_time_type = 3;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $oncall_slot_types) ? $sketch_slot['slot_type'] : 3;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                    } else if ($inconv_timing['time_from'] > $last_time_to) {
                                        //                                    if($key == 0){
                                        $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                        $cur_time_to = $inconv_timing['time_from'];
//                                            $cur_time_type = 0;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                        //                                    }

                                        $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                        $cur_time_to = $inconv_timing['time_to'];
//                                        $cur_time_type = 3;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $oncall_slot_types) ? $sketch_slot['slot_type'] : 3;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                    }

                                    $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                    if ($key == $total_count - 1 && $inconv_timing['time_to'] < 24) {
                                        $cur_time_from = $last_time_to;
                                        $cur_time_to = 24;
//                                        $cur_time_type = 0;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                    }
                                }
                            } else {
                                $cur_time_from = $sketch_slot['time_from'];
                                $cur_time_to = 24;
//                                $cur_time_type = 0;//updated in 2014-06-07
                                $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                            }

                            $next_day_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
                            $inconv_timings_next = $this->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $sketch_slot['customer'], 0, $sketch_slot['time_to'], 3);
                            if (!empty($inconv_timings_next)) {
                                $total_count = count($inconv_timings_next);
                                $last_time_to = 0;
                                foreach ($inconv_timings_next as $key => $inconv_timing) {
                                    $cur_time_from = $cur_time_to = $cur_time_type = '';
                                    if ($inconv_timing['time_from'] <= $last_time_to) {
                                        if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
//                                            $cur_time_type = 0;//updated in 2014-06-07
                                            $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        }
                                        $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                        $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
//                                        $cur_time_type = 3;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $oncall_slot_types) ? $sketch_slot['slot_type'] : 3;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                    } else if ($inconv_timing['time_from'] > $last_time_to) {
                                        //                                    if($key == 0){
                                        $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                        $cur_time_to = $inconv_timing['time_from'];
//                                            $cur_time_type = 0;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        //                                    }
                                        $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                        $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
//                                        $cur_time_type = 3;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $oncall_slot_types) ? $sketch_slot['slot_type'] : 3;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                    }

                                    $last_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                    if ($key == $total_count - 1 && $inconv_timing['time_to'] < $sketch_slot['time_to']) {
                                        $cur_time_from = $last_time_to;
                                        $cur_time_to = $sketch_slot['time_to'];
//                                        $cur_time_type = 0;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                    }
                                }
                            } else {
                                $cur_time_from = 0;
                                $cur_time_to = $sketch_slot['time_to'];
//                                $cur_time_type = 0;//updated in 2014-06-07
                                $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                            }

                            foreach ($intervals as $interval) {
                                if ($interval['time_from'] == $interval['time_to'])
                                    continue;
                                if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $interval['date'], $interval['time_from'], $interval['time_to'], $_SESSION['user_id'], 1, $interval['type'])) {
                                    if ($sketch_slot['customer'] != '' && $sketch_slot['saveTimeslot'] == 1)
                                        $obj_customer->add_memory_slot($sketch_slot['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
                                }else {
                                    $result_flag = FALSE;
                                    break;
                                }
                            }
                            if (!$result_flag) {
                                $assign_flag = false;
                                break;
                            }
                        } else {
                            if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $paste_date, $sketch_slot['time_from'], 24, $_SESSION['user_id'], $sketch_slot['fkkn'], $sketch_slot['slot_type'])) {
                                if ($sketch_slot['customer'] != '' && $sketch_slot['saveTimeslot'] == 1)
                                    $obj_customer->add_memory_slot($sketch_slot['customer'], $sketch_slot['time_from'], 24, $sketch_slot['slot_type']);

                                if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $next_date, 0, $sketch_slot['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $sketch_slot['slot_type'])) {
                                    if ($sketch_slot['customer'] != '' && $sketch_slot['saveTimeslot'] == 1)
                                        $obj_customer->add_memory_slot($sketch_slot['customer'], 0, $sketch_slot['time_to'], $sketch_slot['slot_type']);
                                } else {
                                    $assign_flag = false;
                                    break;
                                }
                            } else {
                                $assign_flag = false;
                                break;
                            }
                        }
                    } else {
                        $assign_flag = false;
                        break;
                    }
                } else {//if the time slot is on same day
                    //---------------------------------------------------------------------------
                    //checking the time is valid
                    if ($this->is_valid_slot($sketch_employee, $sketch_slot['time_from'], $sketch_slot['time_to'], $paste_date)) {
                        if ($split_flag) {
                            $result_flag = TRUE;
                            $inconv_timings = $this->get_collided_inconvenients_on_a_day_for_customer($paste_date, $sketch_slot['customer'], $sketch_slot['time_from'], $sketch_slot['time_to'], 3);
                            $intervals = array();
                            if (!empty($inconv_timings)) {
                                $total_count = count($inconv_timings);
                                $last_time_to = $sketch_slot['time_from'];
                                foreach ($inconv_timings as $key => $inconv_timing) {
                                    $cur_time_from = $cur_time_to = $cur_time_type = '';
                                    if ($inconv_timing['time_from'] <= $last_time_to) {
                                        if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
//                                            $cur_time_type = 0;//updated in 2014-06-07
                                            $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        }
                                        $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                        $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
//                                        $cur_time_type = 3;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $oncall_slot_types) ? $sketch_slot['slot_type'] : 3;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                    } else if ($inconv_timing['time_from'] > $last_time_to) {
                                        //                                    if($key == 0){
                                        $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                        $cur_time_to = $inconv_timing['time_from'];
//                                            $cur_time_type = 0;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        //                                    }
                                        $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                        $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
//                                        $cur_time_type = 3;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $oncall_slot_types) ? $sketch_slot['slot_type'] : 3;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                    }

                                    $last_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                    if ($key == $total_count - 1 && $inconv_timing['time_to'] < $sketch_slot['time_to']) {
                                        $cur_time_from = $last_time_to;
                                        $cur_time_to = $sketch_slot['time_to'];
//                                        $cur_time_type = 0;//updated in 2014-06-07
                                        $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                    }
                                }
                            } else {
                                $cur_time_from = $sketch_slot['time_from'];
                                $cur_time_to = $sketch_slot['time_to'];
//                                $cur_time_type = 0;//updated in 2014-06-07
                                $cur_time_type = in_array($sketch_slot['slot_type'], $normal_slot_types) ? $sketch_slot['slot_type'] : 0;
                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                            }

                            foreach ($intervals as $interval) {
                                if ($interval['time_from'] == $interval['time_to'])
                                    continue;
                                if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $paste_date, $interval['time_from'], $interval['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $interval['type'])) {
                                    if ($sketch_slot['customer'] != '' && $sketch_slot['saveTimeslot'] == 1)
                                        $obj_customer->add_memory_slot($sketch_slot['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
                                }else {
                                    $result_flag = FALSE;
                                    break;
                                }
                            }
                            if (!$result_flag) {
                                $assign_flag = false;
                                break;
                            }
                        } else {
                            if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $paste_date, $sketch_slot['time_from'], $sketch_slot['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $sketch_slot['slot_type'])) {
                                if ($sketch_slot['customer'] != '' && $sketch_slot['saveTimeslot'] == 1)
                                    $obj_customer->add_memory_slot($sketch_slot['customer'], $sketch_slot['time_from'], $sketch_slot['time_to'], $sketch_slot['slot_type']);
                            }else {
                                $assign_flag = false;
                                break;
                            }
                        }
                    } else {
                        $assign_flag = false;
                        break;
                    }
                }

                //----------------------------------------------------------------
            }



            if (date('N', strtotime($paste_date)) == 7)
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
            $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
        }

        if ($assign_flag) {
            $msg->set_message('success', 'slot_operation_success');
            $obj_customer->commit_transaction();
            $obj_dona->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'slot_operation_failed');
            $obj_customer->rollback_transaction();
            $obj_dona->rollback_transaction();
            return false;
        }
    }

    function schema_manual_entry_time_slots_multiAdd($selected_date, $sketch_slots, $from_week, $to_week, $from_option, $sel_days, $saveTimeslot, $dont_show_flag, $allow_N_to_O_convertion = FALSE, $allow_split_slot = FALSE) {
        /**
         * Author: Shamsu
         * for: performing schema manual entry time slots as week basis
         * Used in: gdschema alloc window - module
         * Function request from - gdschema_process_schemaAssign.php -> ajax-alloc-action.php<action = man_slot_entry>
         * @param: $allow_N_to_O_convertion(allow normal to oncall conversion) => 
         *              TRUE => convert entire normal slot to oncall , if both boundaries are available in oncall period
         * @param: $allow_split_slot (allow splitting of slots to seperate intermixed normal-oncall hours)
         *              TRUE => splitting of slots as normal-oncall , if normal and oncall duration are exist on this time boundary
         */
        //        echo "<pre>".print_r(func_get_args(), 1)."</pre>";
        if (empty($sketch_slots))
            return FALSE;

        require_once ('plugins/message.class.php');
        $msg = new message();
        $obj_dona = new dona();
        $obj_customer = new customer();

        $first_slot_date = $selected_date;
        $from_week = str_pad($from_week, 2, '0', STR_PAD_LEFT);
        $to_week = str_pad($to_week, 2, '0', STR_PAD_LEFT);
        //        $allow_N_to_O_convertion = FALSE;
        //        $allow_split_slot = FALSE;
        $normal_slot_types = array('0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16');
        $oncall_slot_types = array('3', '9', '13', '14', '17');

        $obj_dona->begin_transaction();
        $obj_customer->begin_transaction();
        $assign_flag = true;

        $already_checked_signing_dates = array();   //format: array( 'employee_name' => array( 'customer_name' => array( 'Y-m' => 1)))

        foreach ($sketch_slots as $sketch_slot) {
            $sketch_employee = $sketch_slot['employee'] != '' ? $sketch_slot['employee'] : NULL;
            //            $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
            $paste_start_date = $first_slot_date;
            $paste_year = substr($to_week, 0, 4);
            $paste_week = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
            $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
            $paste_date = $paste_start_date;
            $time_flag = 1;         //flag for checking oncall period availability
            $time_flag_next = 1;    //flag for checking oncall period availability

            $slot_split_time_flag = 0;
            $slot_split_time_flag_next = 0;


            //this while block checks any employee for this slots are collide or not
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                if (in_array((date('N', strtotime($paste_date)) % 7), $sel_days)) {

                    if ($sketch_slot['customer'] != '' && $sketch_slot['employee'] != '' && !isset($already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($paste_date))])) {
                        if ($this->chk_employee_rpt_signed($sketch_slot['employee'], $sketch_slot['customer'], $paste_date, TRUE) == 1) {
                            $assign_flag = FALSE;
                            $obj_customer->rollback_transaction();
                            $obj_dona->rollback_transaction();
                            return false;
                        } else {
                            $already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($paste_date))] = 1;
                        }
                    }

                    //                    echo "<pre>sketch_slot".print_r($sketch_slot, 1)."</pre>";

                    //if the time slot enters next day
                    if ($sketch_slot['time_from'] >= $sketch_slot['time_to']) {      
                        $next_day = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
                        if ($sketch_slot['customer'] != '' && $sketch_slot['employee'] != '' && !isset($already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($next_day))])) {
                            if ($this->chk_employee_rpt_signed($sketch_slot['employee'], $sketch_slot['customer'], $next_day, TRUE) == 1) {
                                $assign_flag = FALSE;
                                $obj_customer->rollback_transaction();
                                $obj_dona->rollback_transaction();
                                return false;
                            } else {
                                $already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($next_day))] = 1;
                            }
                        }

                        $time_flag = 0;
                        $time_flag_next = 0;
                        $inconv_timings = $this->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
                        $inconv_timings_next = $this->get_inconvenient_on_a_day_for_customer($next_day, $sketch_slot['customer'], 3);

                        if (!empty($inconv_timings)) {
                            foreach ($inconv_timings as $inconv_timing) {
                                if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
                                        (24 > $inconv_timing['time_from'] && 24 <= $inconv_timing['time_to'])) {
                                    $time_flag = 1;
                                }

                                if ($allow_split_slot) {
                                    if (($inconv_timing['time_from'] >= $sketch_slot['time_from'] && $inconv_timing['time_from'] <= 24) ||
                                            ($inconv_timing['time_to'] >= $sketch_slot['time_from'] && $inconv_timing['time_to'] <= 24)) {
                                        $slot_split_time_flag = 1;
                                    }
                                }
                            }
                        }
                        if (!empty($inconv_timings_next)) {
                            foreach ($inconv_timings_next as $inconv_timing) {
                                if ((0 >= $inconv_timing['time_from'] && 0 < $inconv_timing['time_to']) &&
                                        ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
                                    $time_flag_next = 1;
                                }

                                if ($allow_split_slot) {
                                    if (($inconv_timing['time_from'] >= 0 && $inconv_timing['time_from'] <= $sketch_slot['time_to']) ||
                                            ($inconv_timing['time_to'] >= 0 && $inconv_timing['time_to'] <= $sketch_slot['time_to'])) {
                                        $slot_split_time_flag_next = 1;
                                    }
                                }
                            }
                        }
                    }

                    //if the time slot is on same day
                    else {
                        $time_flag = 0;
                        $inconv_timings = $this->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);

                        if (!empty($inconv_timings)) {
                            foreach ($inconv_timings as $inconv_timing) {
                                if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
                                        ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
                                    $time_flag = 1;
                                }

                                if ($allow_split_slot) {
                                    if (($inconv_timing['time_from'] >= $sketch_slot['time_from'] && $inconv_timing['time_from'] < $sketch_slot['time_to']) ||
                                            ($inconv_timing['time_to'] > $sketch_slot['time_from'] && $inconv_timing['time_to'] <= $sketch_slot['time_to'])) {
                                        $slot_split_time_flag = 1;
                                    }
                                }
                            }
                        }
                    }

                    $calculated_slot_type = $sketch_slot['type'];
                    $split_flag = FALSE;
                    if (in_array($sketch_slot['type'], $normal_slot_types)) { //normal slot
                        //echo $paste_date."-".$time_flag."-".$time_flag_next."-";
                        if ($time_flag == 1 && $time_flag_next == 1) {    //if both are on oncall boundary
                            if ($allow_N_to_O_convertion){
                                $calculated_slot_type = 3;
                            }
                            else{
                                $calculated_slot_type = $sketch_slot['type']; //updated in 2014-06-07
                                $split_flag = TRUE;//updated by shaju
                            }
                        }else if ($slot_split_time_flag == 1 || $slot_split_time_flag_next == 1) {
                            if ($allow_split_slot) {
                                $calculated_slot_type = 3;
                                $split_flag = TRUE;
                            }
                        } else {
                            $calculated_slot_type = $sketch_slot['type'];  //updated in 2014-06-07
                        }
                        //echo $split_flag?'YES':'NO';
                        //echo "<br>";
                    } else if (in_array($sketch_slot['type'], $oncall_slot_types) && $time_flag == 1 && $time_flag_next == 1) {  //oncall slot
                        $calculated_slot_type = $sketch_slot['type']; //updated in 2014-06-07
                    } else {
                        $msg->set_message('fail', 'time_outside_oncall');
                        $msg->set_message_exact('fail', str_pad(sprintf('%.02f', (float) $sketch_slot['time_from']), 5, '0', STR_PAD_LEFT) . ' - ' . str_pad(sprintf('%.02f', (float) $sketch_slot['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . $paste_date);
                        $obj_customer->rollback_transaction();
                        $obj_dona->rollback_transaction();
                        return false;
                    }

                    //                    $sketch_slot['type'] = $calculated_slot_type;//updated in 2014-06-07

                    if ($sketch_slot['time_from'] >= $sketch_slot['time_to']) { //if the slot enters next day
                        $cur_date = strtotime($paste_date . ' 00:00:00');
                        $next_date = date('Y-m-d', ($cur_date + 24 * 3600));

                        if (!$this->is_valid_slot($sketch_employee, $sketch_slot['time_from'], 24, $paste_date)) {
                            $msg->set_message('fail', 'employee_not_available');
                            $msg->set_message_exact('fail', sprintf('%.02f', round((float) $sketch_slot['time_from'], 2)) . '-' . sprintf('%.02f', round((float) 24, 2)) . ' => ' . $paste_date);
                            $assign_flag = false;
                            break;
                        } else if (!$this->is_valid_slot($sketch_employee, 0, $sketch_slot['time_to'], $next_date)) {
                            $msg->set_message('fail', 'employee_not_available');
                            $msg->set_message_exact('fail', sprintf('%.02f', round((float) 0.00, 2)) . '-' . sprintf('%.02f', round((float) $sketch_slot['time_to'], 2)) . ' => ' . $paste_date);
                            $assign_flag = false;
                            break;
                        } else {
                            if ($split_flag) {
                                $result_flag = TRUE;
                                $inconv_timings = $this->get_collided_inconvenients_on_a_day_for_customer($paste_date, $sketch_slot['customer'], $sketch_slot['time_from'], 24, 3);
                                $intervals = array();
                                if (!empty($inconv_timings)) {
                                    $total_count = count($inconv_timings);
                                    $last_time_to = $sketch_slot['time_from'];
                                    foreach ($inconv_timings as $key => $inconv_timing) {
                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
                                        if ($inconv_timing['time_from'] <= $last_time_to) {
                                            if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                                                $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                                $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                                $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                            }
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                        } else if ($inconv_timing['time_from'] > $last_time_to) {
                                            //                                    if($key == 0){
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                            $cur_time_to = $inconv_timing['time_from'];
                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                            //                                    }

                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                            $cur_time_to = $inconv_timing['time_to'];
                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                        }

                                        $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                        if ($key == $total_count - 1 && $inconv_timing['time_to'] < 24) {
                                            $cur_time_from = $last_time_to;
                                            $cur_time_to = 24;
                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                        }
                                    }
                                } else {
                                    $cur_time_from = $sketch_slot['time_from'];
                                    $cur_time_to = 24;
                                    $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
                                }

                                $next_day_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
                                $inconv_timings_next = $this->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $sketch_slot['customer'], 0, $sketch_slot['time_to'], 3);
                                if (!empty($inconv_timings_next)) {
                                    $total_count = count($inconv_timings_next);
                                    $last_time_to = 0;
                                    foreach ($inconv_timings_next as $key => $inconv_timing) {
                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
                                        if ($inconv_timing['time_from'] <= $last_time_to) {
                                            if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                                $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                            }
                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        } else if ($inconv_timing['time_from'] > $last_time_to) {
                                            //                                    if($key == 0){
                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                            $cur_time_to = $inconv_timing['time_from'];
                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                            //                                    }
                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        }

                                        $last_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                        if ($key == $total_count - 1 && $inconv_timing['time_to'] < $sketch_slot['time_to']) {
                                            $cur_time_from = $last_time_to;
                                            $cur_time_to = $sketch_slot['time_to'];
                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        }
                                    }
                                } else {
                                    $cur_time_from = 0;
                                    $cur_time_to = $sketch_slot['time_to'];
                                    $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                }

                                if(!empty($intervals)){
                                    foreach ($intervals as $interval) {
                                        if ($interval['time_from'] == $interval['time_to'])
                                            continue;
                                        if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $interval['date'], $interval['time_from'], $interval['time_to'], $_SESSION['user_id'], 1, $interval['type'], '', $sketch_slot['comment'])) {
                                            if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
                                                $obj_customer->add_memory_slot($sketch_slot['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
                                        }else {
                                            $result_flag = FALSE;
                                            break;
                                        }
                                    }
                                }
                                if (!$result_flag) {
                                    $msg->set_message('fail', 'slot_operation_failed');
                                    $assign_flag = false;
                                    break;
                                }
                            } else {
                                if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $paste_date, $sketch_slot['time_from'], 24, $_SESSION['user_id'], $sketch_slot['fkkn'], $calculated_slot_type, '', $sketch_slot['comment'])) {
                                    if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
                                        $obj_customer->add_memory_slot($sketch_slot['customer'], $sketch_slot['time_from'], 24, $calculated_slot_type);

                                    if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $next_date, 0, $sketch_slot['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $calculated_slot_type, '', $sketch_slot['comment'])) {
                                        if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
                                            $obj_customer->add_memory_slot($sketch_slot['customer'], 0, $sketch_slot['time_to'], $calculated_slot_type);
                                    } else {
                                        $msg->set_message('fail', 'slot_operation_failed');
                                        $assign_flag = false;
                                        break;
                                    }
                                } else {
                                    $msg->set_message('fail', 'slot_operation_failed');
                                    $assign_flag = false;
                                    break;
                                }
                            }
                        }
                    } 
                    else {//if the time slot is on same day
                        //---------------------------------------------------------------------------
                        //checking the time is valid

                        if ($this->is_valid_slot($sketch_employee, $sketch_slot['time_from'], $sketch_slot['time_to'], $paste_date)) {
                            if ($split_flag) {
                                $result_flag = TRUE;
                                $inconv_timings = $this->get_collided_inconvenients_on_a_day_for_customer($paste_date, $sketch_slot['customer'], $sketch_slot['time_from'], $sketch_slot['time_to'], 3);
                                //echo "<pre>".print_r($inconv_timings,1)."</pre>";
                                $intervals = array();
                                if (!empty($inconv_timings)) {
                                    $total_count = count($inconv_timings);
                                    $last_time_to = $sketch_slot['time_from'];
                                    foreach ($inconv_timings as $key => $inconv_timing) {
                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
                                        if ($inconv_timing['time_from'] <= $last_time_to) {
                                            if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
                                                $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                                $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            }
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        } else if ($inconv_timing['time_from'] > $last_time_to) {
                                            //                                    if($key == 0){
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
                                            $cur_time_to = $inconv_timing['time_from'];
                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            //                                    }
                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        }

                                        $last_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
                                        if ($key == $total_count - 1 && $inconv_timing['time_to'] < $sketch_slot['time_to']) {
                                            $cur_time_from = $last_time_to;
                                            $cur_time_to = $sketch_slot['time_to'];
                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        }
                                    }
                                } else {
                                    $cur_time_from = $sketch_slot['time_from'];
                                    $cur_time_to = $sketch_slot['time_to'];
                                    $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                }

                                if(!empty($intervals)){
                                    foreach ($intervals as $interval) {
                                        if ($interval['time_from'] == $interval['time_to'])
                                            continue;
                                        if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $paste_date, $interval['time_from'], $interval['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $interval['type'], '', $sketch_slot['comment'])) {
                                            if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
                                                $obj_customer->add_memory_slot($sketch_slot['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
                                        }else {
                                            $result_flag = FALSE;
                                            break;
                                        }
                                    }
                                }
                                if (!$result_flag) {
                                    $msg->set_message('fail', 'slot_operation_failed');
                                    $assign_flag = false;
                                    break;
                                }
                            } else {
                                if ($obj_dona->customer_employee_slot_add($sketch_employee, $sketch_slot['customer'], $paste_date, $sketch_slot['time_from'], $sketch_slot['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $calculated_slot_type, '', $sketch_slot['comment'])) {
                                    if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
                                        $obj_customer->add_memory_slot($sketch_slot['customer'], $sketch_slot['time_from'], $sketch_slot['time_to'], $calculated_slot_type);
                                }else {
                                    $msg->set_message('fail', 'slot_operation_failed');
                                    $assign_flag = false;
                                    break;
                                }
                            }
                        } else {
                            $msg->set_message('fail', 'employee_not_available');
                            $msg->set_message_exact('fail', sprintf('%.02f', round((float) $sketch_slot['time_from'], 2)) . '-' . sprintf('%.02f', round((float) $sketch_slot['time_to'], 2)) . ' => ' . $paste_date);
                            $assign_flag = false;
                            break;
                        }
                    }
                }

                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }

            //save dont_show flag on general-settings-table only if it set as 1
            //            if ($assign_flag && $dont_show_flag) {
            //                $this->save_customer_employee_general_setting($sketch_slot['customer'], $sketch_employee, 'dont_show_slot_operation_flag', 1);
            //            }
        }



        if ($assign_flag) {
            $msg->set_message('success', 'slot_operation_success');
            $obj_customer->commit_transaction();
            $obj_dona->commit_transaction();
            return true;
        } else {
            //            $msg->set_message('fail', 'slot_operation_failed');
            $obj_customer->rollback_transaction();
            $obj_dona->rollback_transaction();
            return false;
        }
    }

    function get_collide_slots($employee, $time_from, $time_to, $date, $exception_ids = array()) {
        /**
         * @Author: Shamsu
         * for: getting collided timeslots
         * used in: schema employee assignement module (schema_employee_assign_to_slot_multiple())
         */
        $this->tables = array('timetable');
        $this->fields = array('id', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', 'status != 2');
        $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
        if (!empty($exception_ids)) {
            $exception_id_string = '\'' . implode('\', \'', $exception_ids) . '\'';
            $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
        }
        $this->query_generate();

        $datas = $this->query_fetch();
        return $datas;
    }

    function get_intersect_slots($date, $time_from, $time_to, $employee = NULL, $customer = NULL) {
        /**
         * @Author: Shamsu
         * for: getting intersected timeslots
         * used in: Personal meeting type change module (ajax_alloc_action.php)
         */
        $this->tables = array('timetable');
        $this->fields = array('id', 'date', 'time_from', 'time_to', 'employee', 'customer');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'status != 2');
        $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date);

        if ($employee == NULL) {      //for testing
            if ($customer == NULL) {
                $this->conditions[] = array('OR', 'customer is null', 'customer = ?');
                $this->condition_values[] = '';
            } else {
                $this->conditions[] = 'customer = ?';
                $this->condition_values[] = $customer;
            }
        }
        if ($employee == NULL) {
            $this->conditions[] = array('OR', 'employee is null', 'employee = ?');
            $this->condition_values[] = '';
        } else {
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $employee;
        }
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_slots_exists_btwn_time_ranges($date, $time_from, $time_to, $employee = NULL, $customer = NULL, $exclude_slot_types = array()) {
        /**
         * @Author: Shamsu
         * for: getting existed time slots between a time ranges
         * used in: Personal meeting type change module (ajax_alloc_action.php)
         */
        $this->tables = array('timetable');
        $this->fields = array('id', 'date', 'time_from', 'time_to', 'employee', 'customer', 'type', 'fkkn');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'status != 2');
        $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date);

        if (!empty($exclude_slot_types)) {
            $exclude_type_string = '\'' . implode('\',\'', $exclude_slot_types) . '\'';
            $this->conditions[] = array('NOT IN', 'type', $exclude_type_string);
        }

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
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function customer_employee_slot_edit($slot_id, $time_from, $time_to) {
        $this->tables = array('timetable');
        $this->fields = array('time_from', 'time_to');
        $this->field_values = array($time_from, $time_to);
        $this->conditions = array('id = ?');
        $this->condition_values = array($slot_id);
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_valid_slot_for_edit_duration($employee, $time_from, $time_to, $date, $slot_id) {     //$for_leave_cancel is only for leave cancel module
        if ($employee != '') {
            $this->tables = array('timetable');
            $this->fields = array('id');      //default condition
            $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', 'id <> ?');
            $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee, $slot_id);
            $this->query_generate();


            $datas = $this->query_fetch();
            if (count($datas)) {
                return false;
            } else {
                $this->tables = array('leave');
                $this->fields = array('id');
                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('IN', 'status', '0,1'));
                $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
                $this->query_generate();
                $datas = $this->query_fetch();

                if (count($datas)) {
                    return false;
                } else {
                    /* $this->tables = array('report_signing');
                      $this->fields = array('id');
                      $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
                      $this->condition_values = array($employee, substr($date, 5,2), substr($date, 0,4));
                      $this->query_generate();
                      $signin_data = $this->query_fetch();
                      if (!empty($signin_data)) {
                      return false;
                      }else{
                      return true;
                      } */
                    return true;
                }
            }
        } else {
            return true;
        }
        //"select id from timetable where  (time_from >=(float)$time_from   and time_from < (float)$time_to) or (time_to > (float)$time_from and time_to <=(float)$time_to) (time_from<(float)$time_from and time_to>(float)$time_to) and date=$date and employee";
    }

    function order_slots($slots1, $slots2) {
        $i = 0;
        $slots = $slots1;
        if (empty($slots1)) {
            return $slots2;
        }
        $slots2 = array_reverse($slots2);
        //echo "<pre>".print_r($slots2, 1)."</pre>";
        foreach ($slots1 as $slot1) {

            $slot1_from = strtotime($slot1['date'] . " " . $slot1['time_from'] . ".0");
            $slot1_to = strtotime($slot1['date'] . " " . $slot1['time_to'] . ".0");

            $j = 0;
            foreach ($slots2 as $slot2) {
                $slot2_from = strtotime($slot2['date'] . " " . $slot2['time_from'] . ".0");
                $slot2_to = strtotime($slot2['date'] . " " . $slot2['time_to'] . ".0");
                if ($i == 0 || count($slots1) == 1) {
                    if ($slot2_to <= $slot1_from) {
                        $slots = array_reverse($slots);
                        array_push($slots, $slot2);
                        $slots = array_reverse($slots);
                        unset($slots2[$j]);
                    }
                    if (count($slots1) == 1) {
                        if ($slot2_from >= $slot1_to) {
                            array_push($slots, $slot2);
                            unset($slots2[$j]);
                        }
                    }
                } elseif ($i == count($slots1) - 1) {
                    if ($slot2_from >= $prev_end && $slot2_from < $slot1_from) {
                        $temp_slots = $slots;
                        $slots = array_merge(array_splice($slots, 0, $i), array($slot2), array_splice($temp_slots, $i));
                        unset($slots2[$j]);
                    }

                    if ($slot2_from >= $slot1_to) {
                        array_push($slots, $slot2);
                        unset($slots2[$j]);
                    }
                } else {

                    if ($slot2_from >= $prev_end && $slot2_from < $slot1_from) {
                        $temp_slots = $slots;
                        $slots = array_merge(array_splice($slots, 0, $i), array($slot2), array_splice($temp_slots, $i));
                        unset($slots2[$j]);
                    }
                }
                $j++;
            }
            $i++;
            $prev_end = $slot1_to;
        }
        return $slots;
    }

    function get_available_users_btwn_a_date_range($employee, $date_from, $date_to) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get available users for slot employee replacement between dates - leave purpose
         * used in : save leave using a date range (save_leave.php => $leave_day_type == 1)
         */
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'comment');
        $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', array('BETWEEN', 'date', '?', '?'));
        $this->condition_values = array($employee, $date_from, $date_to);
        $this->query_generate();
        $slot_datas = $this->query_fetch();
        $avail_employees = array();
        $temp_emps_prev = array();
        if (!empty($slot_datas)) {
            foreach ($slot_datas as $slot_data) {
                $avail_replace_employees = $this->get_available_users($slot_data['customer'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['date']);
                if (!empty($avail_replace_employees)) {
                    if (empty($avail_employees)) {
                        foreach ($avail_replace_employees as $avail_replace_employee) {
                            $avail_employees[$avail_replace_employee['username']] = $avail_replace_employee;
                        }
                    } else {
                        $temp_emps_prev = array();
                        foreach ($avail_replace_employees as $avail_replace_employee) {
                            $temp_emps_prev[] = $avail_replace_employee['username'];
                        }
                        foreach ($avail_employees as $key => $value) {
                            if (!in_array($key, $temp_emps_prev))
                                unset($avail_employees[$key]);
                        }
                    }
                }else {
                    $avail_employees = array();
                    break;
                }
            }
        }

        return $avail_employees;
    }

    function check_employee_total_time($empl, $date, $ids = NULL, $multiple = NULL, $exception_ids = array(), $right_click = 0) {
        if ($right_click == 1) {
            $year_week = explode('|', $date);
            $week_num = $year_week[1];
            $this_year = $year_week[0];
        } else {
            $week_num = date("W", strtotime($date));
            $this_year = date("Y", strtotime($date));
        }
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to', 'date');
        $this->conditions = array('AND', 'employee = ?', 'WEEK(date,1) = ?', 'YEAR(date) = ?', 'status = 1');
        $this->condition_values = array($empl, $week_num, $this_year);

        if (!empty($exception_ids)) {
            $exception_id_string = '\'' . implode('\', \'', $exception_ids) . '\'';
            $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
        }

        $this->query_generate();
        $data = $this->query_fetch();
        $sum = 0.00;
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $sum = $this->time_sum($sum, $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
            }
        }
        if ($ids != NULL) {
            $slot_ids = explode(",", $ids);
            $slot_dets = $this->get_multiple_slot_details($slot_ids);
            if (!empty($slot_dets)) {
                foreach ($slot_dets as $slot_det) {
                    $sum = $this->time_sum($sum, $this->time_difference($slot_det['time_from'], $slot_det['time_to']));
                }
            }
            /* for($i=0;$i<count($slot_ids);$i++){
              $this->tables = array('timetable');
              $this->fields = array('id','time_from','time_to','date');
              $this->conditions = array('id = ?');
              $this->condition_values = array($slot_ids[$i]);
              $this->query_generate();
              $data1= $this->query_fetch();
              $sum = $this->time_sum($sum, $this->time_difference($data1[0]['time_from'], $data1[0]['time_to']));
              } */
        }
        if ($multiple != NULL) {
            $slots = explode(",", $multiple);
            for ($i = 0; $i < count($slots); $i++) {
                $slot_time = explode("-", $slots[$i]);
                $sum = $this->time_sum($sum, $this->time_difference($slot_time[0], $slot_time[1]));
            }
        }
        return $sum;
    }

    function check_employee_contract($empl, $date, $work_hours = array()) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting employee contract records
         * @param: $empl - employee_uname
         * @param: $date - contract date to be checked
         * @param: $work_hours - employee total work hours
         *          format: array('weekly_normal' => ?, 'monthly_oncall' => ?);
         * @param: $normal_oncall - type of slot to be checked
         *          possible values: 0 - Normal, 3 - Oncall
         * @return-type: boolean | array()
         *          if no-contract exceedings - return TRUE
         *          else return array with error contents
         */
        $company = new company();
        $contract = new contract();
        $output = TRUE;
        $contract_normal_weekly_hours = $contract_oncall_monthly_hours = 0.00;

        $this_employee_contracts = $contract->get_employee_contract_records($empl, 'date', $date);
        if (!empty($this_employee_contracts)) {
            $contract_normal_weekly_hours = (float) $this_employee_contracts[0]['hour'];
            $contract_oncall_monthly_hours = (float) $this_employee_contracts[0]['monthly_oncall_hour'];
        } else {
            $company_detail = $company->get_company_detail($_SESSION['company_id']);
            $contract_normal_weekly_hours = round((float) $company_detail['weekly_hour'], 2);
            $contract_oncall_monthly_hours = round((float) $company_detail['monthly_oncall_hour'], 2);
        }

        if ($work_hours['weekly_normal'] > $contract_normal_weekly_hours) {
            $output = array();
            $output['normal'] = array('work_hours' => round($work_hours['weekly_normal'], 2), 'contract_hours' => round($contract_normal_weekly_hours, 2));
        }

        if ($work_hours['monthly_oncall'] > $contract_oncall_monthly_hours) {
            if ($output === TRUE)
                $output = array();
            $output['oncall'] = array('work_hours' => round($work_hours['monthly_oncall'], 2), 'contract_hours' => round($contract_oncall_monthly_hours, 2));
        }
        return $output;
    }

    function check_monthly_salary() {

        $this->tables = array('employee');
        $this->fields = array('count(username) as monthly_salary_count');
        $this->conditions = array('AND', 'status = 1', 'monthly_salary = 1');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['monthly_salary_count'] > 0)
            return true;
        else
            return false;
    }

    function get_salary_code_count($mod, $codes) {
        $time_codes = "'";
        $time_codes .= implode("','", $codes);
        $time_codes .= "'";
        $this->tables = array('export_lon_config');
        $this->fields = array('count(distinct internal) as internal_count');
        if ($mod == 1)
            $this->conditions = array('AND', 'external != ?', 'external != ?', 'external IS NOT NULL', array('IN', 'internal', $time_codes));
        else
            $this->conditions = array('AND', 'monthly != ?', 'monthly != ?', 'monthly IS NOT NULL', array('IN', 'internal', $time_codes));
        $this->condition_values = array('0', '');
        $this->query_generate();

        $data = $this->query_fetch();

        return $data[0]['internal_count'];
    }

    function get_customer_employee_general_setting($customer, $employee, $key) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to get to save general customer-employee relational settings
         */
        $this->tables = array('general_customer_employee_settings');
        $this->fields = array('id', 'settings_owner', 'customer', 'employee', $key);
        $this->conditions = array('AND', 'settings_owner = ?');
        $this->condition_values = array($_SESSION['user_id']);

        if ($customer != '') {
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        } else {
            $this->conditions[] = array('OR', 'customer IS NULL', 'customer = ?');
            $this->condition_values[] = '';
        }

        if ($employee != '') {
            $this->conditions[] = 'employee = ?';
            $this->condition_values[] = $employee;
        } else {
            $this->conditions[] = array('OR', 'employee IS NULL', 'employee = ?');
            $this->condition_values[] = '';
        }

        $this->query_generate();
        $records = $this->query_fetch();
        return $records;
    }

    function save_customer_employee_general_setting($customer, $employee, $key, $value) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to save general customer-employee relational settings
         */
        $available_keys = array('dont_show_slot_operation_flag');
        $settigs_owner = $_SESSION['user_id'];
        $result = FALSE;
        if (in_array($key, $available_keys)) {
            $pre_setting = $this->get_customer_employee_general_setting($customer, $employee, $key);

            if (!empty($pre_setting)) {
                //updation
                $this->tables = array('general_customer_employee_settings');
                $this->fields = array($key);
                $this->field_values = array($value);
                $this->conditions = array('AND', 'settings_owner = ?');
                $this->condition_values = array($settigs_owner);
                if ($customer != '') {
                    $this->conditions[] = 'customer = ?';
                    $this->condition_values[] = $customer;
                } else {
                    $this->conditions[] = array('OR', 'customer IS NULL', 'customer = ?');
                    $this->condition_values[] = '';
                }

                if ($employee != '') {
                    $this->conditions[] = 'employee = ?';
                    $this->condition_values[] = $employee;
                } else {
                    $this->conditions[] = array('OR', 'employee IS NULL', 'employee = ?');
                    $this->condition_values[] = '';
                }
                $result = $this->query_update();
            } else {
                //insertion
                $this->tables = array('general_customer_employee_settings');
                $this->fields = array('settings_owner', 'customer', 'employee', $key);
                $this->field_values = array($settigs_owner, $customer, $employee, $value);
                $result = $this->query_insert();
            }
        }
        return $result;
    }

    function reset_customer_employee_general_setting($customer, $employee, $key) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to reset/remove general customer-employee relational settings
         */
        $available_keys = array('dont_show_slot_operation_flag');
        $settigs_owner = $_SESSION['user_id'];
        $result = FALSE;
        if (in_array($key, $available_keys)) {
            $pre_setting = $this->get_customer_employee_general_setting($customer, $employee, $key);

            if (!empty($pre_setting)) {
                //updation
                $this->tables = array('general_customer_employee_settings');
                $this->fields = array($key);
                $this->field_values = array(NULL);
                $this->conditions = array('AND', 'settings_owner = ?');
                $this->condition_values = array($settigs_owner);
                if ($customer != '') {
                    $this->conditions[] = 'customer = ?';
                    $this->condition_values[] = $customer;
                } else {
                    $this->conditions[] = array('OR', 'customer IS NULL', 'customer = ?');
                    $this->condition_values[] = '';
                }

                if ($customer == '') {    //for gdchema-employee window
                    if ($employee != '') {
                        $this->conditions[] = 'employee = ?';
                        $this->condition_values[] = $employee;
                    } else {
                        $this->conditions[] = array('OR', 'employee IS NULL', 'employee = ?');
                        $this->condition_values[] = '';
                    }
                }
                $result = $this->query_update();
            }
        }
        return $result;
    }

    function get_montly_contract_report($month, $year) {
        $company = new company();
        $contract = new contract();
        $company_details = $company->get_company_detail($_SESSION['company_id']);
//        echo "<pre>". print_r($company_details, 1)."</pre>";
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $week_start_num = date('W', strtotime("01-" . $month . "-" . $year));
        $week_end_num = date('W', strtotime($num . "-" . $month . "-" . $year));
        $weeks_array = array();
        $number_of_weeks = $week_end_num - $week_start_num;
        for ($i = 0; $i <= $number_of_weeks; $i++) {
            $weeks_array[]['num'] = $week_start_num + $i;
        }
        for ($i = 0; $i < count($weeks_array); $i++) {
            $weeks_array[$i]['time_emp'] = '0.00';
        }
        $weeks = $weeks_array;
        $this->tables = array('employee` AS `e', 'employee_contract` AS `c');
        $this->fields = array('e.username', 'e.first_name', 'e.last_name', 'c.date_from', 'date_to', 'c.fulltime', 'c.hour');
        $this->conditions = array('AND', 'e.username = c.employee', array('OR', 'MONTH(c.date_from) = ?', 'MONTH(c.date_to) = ?'), 'YEAR(c.date_from) = ?', 'YEAR(c.date_to) = ?');
        $this->condition_values = array($month, $month, $year, $year);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            $employees = array();
            for ($i = 0; $i < count($data); $i++) {
                $l = 0;
                for ($j = 0; $j < count($employees); $j++) {
                    if ($employees[$j]['name'] == $data[$i]['username']) {
                        break;
                    }
                    $l++;
                }
                if ($l == count($employees)) {
                    $employees[]['name'] = $data[$i]['username'];
                }
            }
            for ($i = 0; $i < count($employees); $i++) {
                $weeks = $weeks_array;
                $this->tables = array('timetable');
                $this->fields = array('time_from', 'time_to', 'date');
                $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?', 'status = 1');
                $this->condition_values = array($employees[$i]['name'], $month, $year);
                $this->query_generate();
                $data1 = $this->query_fetch();
                if ($data1) {
                    for ($j = 0; $j < count($data1); $j++) {
                        $week_num_date = date('W', strtotime($data1[$j]['date']));
                        for ($k = 0; $k < count($weeks); $k++) {
                            $weeks[$k]['time_contract'] = "0.00";
                            if ($week_num_date == $weeks[$k]['num']) {
                                $weeks[$k]['time_emp'] = $this->time_sum($this->time_difference($data1[$j]['time_to'], $data1[$j]['time_from']), $weeks[$k]['time_emp']);
                            }
                        }
                    }
                } else {
                    for ($k = 0; $k < count($weeks); $k++) {
                        $weeks[$k]['time_contract'] = "0.00";
                        $weeks[$k]['time_emp'] = "0.00";
                    }
                }
                $employees[$i]['weeks'] = $weeks;
            }
            for ($i = 0; $i < count($data); $i++) {

                for ($j = 0; $j < count($employees); $j++) {
                    if ($employees[$j]['name'] == $data[$i]['username']) {
                        $employees[$j]['first_name'] = $data[$i]['first_name'];
                        $employees[$j]['last_name'] = $data[$i]['last_name'];
                        $start = strtotime($data[$i]['date_from']);
                        $end = strtotime($data[$i]['date_to']);
                        for ($l = 0; $l < count($employees[$j]['weeks']); $l++) {
                            $contract_week_hour = $this->employee_contract_week_hour($employees[$j]['name'], $year . '|' . $employees[$j]['weeks'][$l]['num']);
                            if ($contract_week_hour == "") {
                                $employees[$j]['weeks'][$l]['time_contract'] = $company_details['weekly_hour'];
                            } else {
                                $employees[$j]['weeks'][$l]['time_contract'] = $this->employee_contract_week_hour($employees[$j]['name'], $year . '|' . $employees[$j]['weeks'][$l]['num']);
                            }
                        }
                    } else {
                        continue;
                    }
                }
            }
            if ($emp_username == null) {
                return $employees;
            } else {
                $temp_array_report = array();
                for ($i = 0; $i < count($employees); $i++) {
                    if ($employees[$i]['name'] == $emp_username) {
                        $temp_array_report = $employees[$i];
                        break;
                    }
                }
//                echo "<pre>". print_r($temp_array_report, 1)."</pre>";
                return $temp_array_report;
            }
        } else {
            return array();
        }
    }

    function set_excess_less_totoal_time($contract_reports) {
        $excess = 0;
        for ($i = 0; $i < count($contract_reports); $i++) {
            $total_time_excess = 0.00;
            $total_time_less = 0.00;
            for ($j = 0; $j < count($contract_reports[$i]['weeks']); $j++) {
                if (floatval($contract_reports[$i]['weeks'][$j]['time_emp']) > floatval($contract_reports[$i]['weeks'][$j]['time_contract'])) {
                    $contract_reports[$i]['weeks'][$j]['excess'] = 1;
                    $excess++;
                    if ($contract_reports[$i]['weeks'][$j]['time_emp'] == "0.00")
                        $total_time_excess = $this->time_sum($contract_reports[$i]['weeks'][$j]['time_contract'], $total_time_excess);
                    else
                        $total_time_excess = $this->time_sum($this->time_difference($contract_reports[$i]['weeks'][$j]['time_emp'], $contract_reports[$i]['weeks'][$j]['time_contract']), $total_time_excess);
                }else {
                    $contract_reports[$i]['weeks'][$j]['excess'] = 0;
                    $excess--;
                    if ($contract_reports[$i]['weeks'][$j]['time_emp'] == "0.00")
                        $total_time_less = $this->time_sum($contract_reports[$i]['weeks'][$j]['time_contract'], $total_time_less);
                    else
                        $total_time_less = $this->time_sum($this->time_difference($contract_reports[$i]['weeks'][$j]['time_contract'], $contract_reports[$i]['weeks'][$j]['time_emp']), $total_time_less);
                }
            }
//            $contract_reports[$i]['total_time'] = $this->time_difference($total_time_excess, $total_time_less);
            if (floatval($total_time_excess) > floatval($total_time_less)) {
                $contract_reports[$i]['total_time'] = $this->time_difference($total_time_excess, $total_time_less);
                $contract_reports[$i]['excess'] = 1;
            } else {
                $contract_reports[$i]['total_time'] = $this->time_difference($total_time_less, $total_time_excess);
                $contract_reports[$i]['excess'] = 0;
            }
        }
        return $contract_reports;
    }

    //deprecated by shamsu
    function get_montly_contract_report_employee($month, $year, $emp_username) {
        $company = new company();
        $equipment = new equipment();
        $company_details = $company->get_company_detail($_SESSION['company_id']);
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $week_start_num = date('W', strtotime("01-" . $month . "-" . $year));
        $week_end_num = date('W', strtotime($num . "-" . $month . "-" . $year));
        $weeks_array = array();
        $number_of_weeks = $week_end_num - $week_start_num;
        for ($i = 0; $i <= $number_of_weeks; $i++) {
            $weeks_array[]['num'] = $week_start_num + $i;
        }
        for ($i = 0; $i < count($weeks_array); $i++) {
            $weeks_array[$i]['time_emp'] = '0.00';
        }

        $this->tables = array('employee` AS `e', 'employee_contract` AS `c');
        $this->fields = array('e.username', 'e.first_name', 'e.last_name', 'c.date_from', 'date_to', 'c.fulltime', 'c.hour');
        $this->conditions = array('AND', 'e.username = c.employee', array('BETWEEN', '?', 'MONTH(c.date_from)', 'MONTH(c.date_to)'), array('BETWEEN', '?', 'YEAR(c.date_from)', 'YEAR(c.date_to)'), 'e.username = ?');
        $this->condition_values = array($month, $year, $emp_username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {

            for ($i = 0; $i < count($data); $i++) {
                $diff = $this->date_difference($data[$i]['date_from'], $data[$i]['date_to']);
                $tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
                $data[$i]['monthly'] = number_format($data[$i]['hour'] / $tot_month, 1);
                $data[$i]['weeks'] = $weeks_array;
                $this->tables = array('timetable');
                $this->fields = array('time_from', 'time_to', 'date');
                $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?', 'status = 1');
                $this->condition_values = array($emp_username, $month, $year);
                $this->query_generate();
                $data1 = $this->query_fetch();
                if ($data1) {
                    for ($j = 0; $j < count($data1); $j++) {
                        $week_num = date('W', strtotime($data1[$j]['date']));
                        for ($k = 0; $k < count($data[$i]['weeks']); $k++) {
                            if ($week_num == $data[$i]['weeks'][$k]['num']) {
                                $data[$i]['weeks'][$k]['time_emp'] = $this->time_sum($this->time_difference($data1[$j]['time_from'], $data1[$j]['time_to']), $data[$i]['weeks'][$k]['time_emp']);
                                $data[$i]['weeks'][$k]['contract_time'] = $this->employee_contract_week_hour($emp_username, $year . '|' . $data[$i]['weeks'][$k]['num']);
//                                $time_emp_tmp = explode(".",$data[$i]['weeks'][$k]['time_emp']);
//                                $time_emp_tmp[1]= str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
//                                $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0].".".$time_emp_tmp[1];

                                if ($data[$i]['weeks'][$k]['contract_time'] == "") {
                                    $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                                }
                                $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['time_emp']);
                                $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                                $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                                $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['contract_time']);
                                $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                                $data[$i]['weeks'][$k]['contract_time'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                                $data[$i]['weeks'][$k]['excess_val'] = $this->time_difference($data[$i]['weeks'][$k]['time_emp'], $data[$i]['weeks'][$k]['contract_time']);

                                $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['excess_val']);
                                $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                                $data[$i]['weeks'][$k]['excess_val'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                                if (floatval($data[$i]['weeks'][$k]['time_emp']) > floatval($data[$i]['weeks'][$k]['contract_time'])) {
                                    $data[$i]['weeks'][$k]['excess'] = 1;
                                } else {
                                    $data[$i]['weeks'][$k]['excess'] = 0;
                                }
                            } else {
//                                $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];

                                $data[$i]['weeks'][$k]['contract_time'] = $this->employee_contract_week_hour($emp_username, $year . '|' . $data[$i]['weeks'][$k]['num']);
//                               

                                if ($data[$i]['weeks'][$k]['contract_time'] == "") {
                                    $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                                }
                                $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['time_emp']);
                                $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                                $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                                $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['contract_time']);
                                $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                                $data[$i]['weeks'][$k]['contract_time'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                                $data[$i]['weeks'][$k]['excess_val'] = $this->time_difference($data[$i]['weeks'][$k]['time_emp'], $data[$i]['weeks'][$k]['contract_time']);

                                $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['excess_val']);
                                $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                                $data[$i]['weeks'][$k]['excess_val'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
//                                $time_excess = explode(".",$data[$i]['weeks'][$k]['excess_val']);
//                                $contract_time = explode(".",$data[$i]['weeks'][$k]['contract_time']);
//                                if($contract_time[1] == "5")
//                                    $contract_time[1]="05";
//                                $data[$i]['weeks'][$k]['contract_time'] = $contract_time[0].".".$contract_time[1];
                                if (floatval($data[$i]['weeks'][$k]['time_emp']) > floatval($data[$i]['weeks'][$k]['contract_time'])) {
                                    $data[$i]['weeks'][$k]['excess'] = 1;
                                } else {
                                    $data[$i]['weeks'][$k]['excess'] = 0;
                                }
                            }
                        }
                    }
                } else {
                    for ($k = 0; $k < count($data[$i]['weeks']); $k++) {

                        $data[$i]['weeks'][$k]['contract_time'] = $this->employee_contract_week_hour($emp_username, $year . '|' . $data[$i]['weeks'][$k]['num']);

                        if ($data[$i]['weeks'][$k]['contract_time'] == "") {
                            $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                        }
                        $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['time_emp']);
                        $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                        $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                        $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['contract_time']);
                        $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                        $data[$i]['weeks'][$k]['contract_time'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                        $data[$i]['weeks'][$k]['excess_val'] = $this->time_difference($data[$i]['weeks'][$k]['time_emp'], $data[$i]['weeks'][$k]['contract_time']);

                        $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['excess_val']);
                        $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                        $data[$i]['weeks'][$k]['excess_val'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                        if (floatval($data[$i]['weeks'][$k]['time_emp']) > floatval($data[$i]['weeks'][$k]['contract_time'])) {
                            $data[$i]['weeks'][$k]['excess'] = 1;
                        } else {
                            $data[$i]['weeks'][$k]['excess'] = 0;
                        }
                    }
                }
            }
            for ($i = 0; $i < count($data); $i++) {
                for ($j = 0; $j < count($data[$i]['weeks']); $j++) {
                    $data[$i]['weeks'][$j]['time_emp'] = $equipment->time_user_format($data[$i]['weeks'][$j]['time_emp'], 100);
                    $data[$i]['weeks'][$j]['excess_val'] = $equipment->time_user_format($data[$i]['weeks'][$j]['excess_val'], 100);
                }
            }
            return $data;
        } else {
            $i = 0;
            $data = $this->employee_detail_main($emp_username);
            $data[0]['weeks'] = $weeks_array;
            $this->tables = array('timetable');
            $this->fields = array('time_from', 'time_to', 'date');
            $this->conditions = array('AND', 'employee = ?', 'status = 1', 'MONTH(date) = ?', 'YEAR(date) = ?');
            $this->condition_values = array($emp_username, $month, $year);
            $this->query_generate();
            $data1 = $this->query_fetch();
//             echo "<pre>". print_r($data1, 1)."</pre>"; 
            if ($data1) {

                for ($j = 0; $j < count($data1); $j++) {
                    $week_num = date('W', strtotime($data1[$j]['date']));
                    for ($k = 0; $k < count($data[$i]['weeks']); $k++) {
                        if ($week_num == $data[$i]['weeks'][$k]['num']) {
                            $data[$i]['weeks'][$k]['time_emp'] = $this->time_sum($this->time_difference($data1[$j]['time_from'], $data1[$j]['time_to']), $data[$i]['weeks'][$k]['time_emp']);
                            $data[$i]['weeks'][$k]['contract_time'] = $this->employee_contract_week_hour($emp_username, $year . '|' . $data[$i]['weeks'][$k]['num']);


                            if ($data[$i]['weeks'][$k]['contract_time'] == "") {
                                $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                            }
                            $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['time_emp']);
                            $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                            $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                            $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['contract_time']);
                            $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                            $data[$i]['weeks'][$k]['contract_time'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                            $data[$i]['weeks'][$k]['excess_val'] = $this->time_difference($data[$i]['weeks'][$k]['time_emp'], $data[$i]['weeks'][$k]['contract_time']);

                            $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['excess_val']);
                            $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                            $data[$i]['weeks'][$k]['excess_val'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                            if (floatval($data[$i]['weeks'][$k]['time_emp']) > floatval($data[$i]['weeks'][$k]['contract_time'])) {
                                $data[$i]['weeks'][$k]['excess'] = 1;
                            } else {
                                $data[$i]['weeks'][$k]['excess'] = 0;
                            }
                        } else {
//                                $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                            $data[$i]['weeks'][$k]['contract_time'] = $this->employee_contract_week_hour($emp_username, $year . '|' . $data[$i]['weeks'][$k]['num']);

                            if ($data[$i]['weeks'][$k]['contract_time'] == "") {
                                $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                            }

                            $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['time_emp']);
                            $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                            $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                            $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['contract_time']);
                            $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                            $data[$i]['weeks'][$k]['contract_time'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                            $data[$i]['weeks'][$k]['excess_val'] = $this->time_difference($data[$i]['weeks'][$k]['time_emp'], $data[$i]['weeks'][$k]['contract_time']);

                            $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['excess_val']);
                            $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                            $data[$i]['weeks'][$k]['excess_val'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                            if (floatval($data[$i]['weeks'][$k]['time_emp']) > floatval($data[$i]['weeks'][$k]['contract_time'])) {
                                $data[$i]['weeks'][$k]['excess'] = 1;
                            } else {
                                $data[$i]['weeks'][$k]['excess'] = 0;
                            }
                        }
                    }
                }
            } else {
                for ($k = 0; $k < count($data[$i]['weeks']); $k++) {

                    $data[$i]['weeks'][$k]['contract_time'] = $this->employee_contract_week_hour($emp_username, $year . '|' . $data[$i]['weeks'][$k]['num']);

                    if ($data[$i]['weeks'][$k]['contract_time'] == "") {
                        $data[$i]['weeks'][$k]['contract_time'] = $company_details['weekly_hour'];
                    }
                    $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['time_emp']);
                    $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                    $data[$i]['weeks'][$k]['time_emp'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                    $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['contract_time']);
                    $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                    $data[$i]['weeks'][$k]['contract_time'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];
                    $data[$i]['weeks'][$k]['excess_val'] = $this->time_difference($data[$i]['weeks'][$k]['time_emp'], $data[$i]['weeks'][$k]['contract_time']);

                    $time_emp_tmp = explode(".", $data[$i]['weeks'][$k]['excess_val']);
                    $time_emp_tmp[1] = str_pad($time_emp_tmp[1], 2, "0", STR_PAD_LEFT);
                    $data[$i]['weeks'][$k]['excess_val'] = $time_emp_tmp[0] . "." . $time_emp_tmp[1];

                    if (floatval($data[$i]['weeks'][$k]['time_emp']) > floatval($data[$i]['weeks'][$k]['contract_time'])) {
                        $data[$i]['weeks'][$k]['excess'] = 1;
                    } else {
                        $data[$i]['weeks'][$k]['excess'] = 0;
                    }
                }
            }
//            echo "<pre>". print_r($data, 1)."</pre>";
            for ($i = 0; $i < count($data); $i++) {
                for ($j = 0; $j < count($data[$i]['weeks']); $j++) {
                    $data[$i]['weeks'][$j]['time_emp'] = $equipment->time_user_format($data[$i]['weeks'][$j]['time_emp'], 100);
//                    $data[$i]['weeks'][$j]['time_emp'] = $equipment->time_user_format($dec_year[0].".".$dec_year[1], 100);
                    $data[$i]['weeks'][$j]['excess_val'] = $equipment->time_user_format($data[$i]['weeks'][$j]['excess_val'], 100);
                }
            }
            return $data;
        }
    }

    //deprecated by shamsu
    function get_all_contract_report($year, $employees) {
        $company = new company();
        $contract = new contract();
        $equipment = new equipment();
//        $dona = new dona();
        $company_details = $company->get_company_detail($_SESSION['company_id']);
        $year_array = array('jan' => '0.00', 'feb' => '0.00', 'mar' => '0.00', 'apr' => '0.00', 'may' => '0.00', 'jun' => '0.00', 'jul' => '0.00', 'aug' => '0.00', 'sep' => '0.00', 'oct' => '0.00', 'nov' => '0.00', 'dec' => '0.00');
        for ($i = 0; $i < count($employees); $i++) {
            $employees[$i]['year'] = $year_array;
            $employees[$i]['contract'] = $year_array;
            $this->tables = array('employee_contract');
            $this->fields = array('date_from', 'date_to', 'fulltime', 'hour');
            $this->conditions = array('AND', 'employee = ?', array('OR', 'YEAR(date_from) = ?', 'YEAR(date_to) = ?', array('BETWEEN', '?', 'YEAR(date_from)', 'YEAR(date_to)')));
            $this->condition_values = array($employees[$i]['username'], $year, $year, $year);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                for ($j = 0; $j < count($data); $j++) {

                    $number_days = floor((strtotime($data[$j]['date_to']) - strtotime($data[$j]['date_from'])) / (60 * 60 * 24));
                    if ($data[$j]['fulltime'] == 1) {
//                        $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $j), $year);
                        $working_days = $contract->get_working_days($data[$j]['date_from'], $data[$j]['date_to']);
                        $hour_per_day = ($working_days != 0 ? ($data[$j]['hour'] / $working_days) : 0);
                        if (date('Y', strtotime($data[$j]['date_from'])) == $year && date('Y', strtotime($data[$j]['date_to'])) == $year) {

                            if (date('m', strtotime($data[$j]['date_from'])) != date('Y', strtotime($data[$j]['date_to']))) {
                                $start = intval(date('m', strtotime($data[$j]['date_from'])));
                                $end = intval(date('m', strtotime($data[$j]['date_to'])));
                                for ($k = $start; $k <= $end; $k++) {
                                    $month_days = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $k), $year);
                                    if ($k == $start) {
                                        $working_days = $contract->get_working_days($data[$j]['date_from'], $year . "-" . $k . "-" . $month_days);
                                    } else if ($k == $end && $month_days != date("d", strtotime($data[$j]['date_to']))) {
                                        $working_days = $contract->get_working_days($year . "-" . $k . "-01", $year . "-" . $k . "-" . $month_days);
                                    } else if ($k == $end) {
                                        $working_days = $contract->get_working_days($year . "-" . $k . "-01", $data[$j]['date_to']);
                                    } else {
                                        $working_days = $contract->get_working_days($year . "-" . $k . "-01", $year . "-" . $k . "-" . $month_days);
                                    }
                                    switch ($k) {
                                        case 1:
                                            $employees[$i]['contract']['jan'] = $this->time_sum($employees[$i]['contract']['jan'], ($working_days * $hour_per_day));
                                            break;

                                        case 2:
                                            $employees[$i]['contract']['feb'] = $this->time_sum($employees[$i]['contract']['feb'], ($working_days * $hour_per_day));
                                            break;
                                        case 3:
                                            $employees[$i]['contract']['mar'] = $this->time_sum($employees[$i]['contract']['mar'], ($working_days * $hour_per_day));
                                            break;
                                        case 4:
                                            $employees[$i]['contract']['apr'] = $this->time_sum($employees[$i]['contract']['apr'], ($working_days * $hour_per_day));
                                            break;
                                        case 5:
                                            $employees[$i]['contract']['may'] = $this->time_sum($employees[$i]['contract']['may'], ($working_days * $hour_per_day));
                                            break;
                                        case 6:
                                            $employees[$i]['contract']['jun'] = $this->time_sum($employees[$i]['contract']['jun'], ($working_days * $hour_per_day));
                                            break;
                                        case 7:
                                            $employees[$i]['contract']['jul'] = $this->time_sum($employees[$i]['contract']['jul'], ($working_days * $hour_per_day));
                                            ;
                                            break;
                                        case 8:
                                            $employees[$i]['contract']['aug'] = $this->time_sum($employees[$i]['contract']['aug'], ($working_days * $hour_per_day));
                                            break;
                                        case 9:
                                            $employees[$i]['contract']['sep'] = $this->time_sum($employees[$i]['contract']['sep'], ($working_days * $hour_per_day));
                                            break;
                                        case 10:
                                            $employees[$i]['contract']['oct'] = $this->time_sum($employees[$i]['contract']['oct'], ($working_days * $hour_per_day));
                                            break;
                                        case 11:
                                            $employees[$i]['contract']['nov'] = $this->time_sum($employees[$i]['contract']['nov'], ($working_days * $hour_per_day));
                                            break;
                                        case 12:
                                            $employees[$i]['contract']['dec'] = $this->time_sum($employees[$i]['contract']['dec'], ($working_days * $hour_per_day));
                                            break;
                                    }
                                }
                            } else {
                                $working_days = $contract->get_working_days($data[$j]['date_from'], $data[$j]['date_to']);
                                $month_contract = date('m', strtotime($data[$j]['date_to']));
                                switch ($month_contract) {
                                    case '01':
                                        $employees[$i]['contract']['jan'] = $this->time_sum($employees[$i]['contract']['jan'], ($working_days * $hour_per_day));
                                        break;

                                    case '02':
                                        $employees[$i]['contract']['feb'] = $this->time_sum($employees[$i]['contract']['feb'], ($working_days * $hour_per_day));
                                        break;
                                    case '03':
                                        $employees[$i]['contract']['mar'] = $this->time_sum($employees[$i]['contract']['mar'], ($working_days * $hour_per_day));
                                        break;
                                    case '04':
                                        $employees[$i]['contract']['apr'] = $this->time_sum($employees[$i]['contract']['apr'], ($working_days * $hour_per_day));
                                        break;
                                    case '05':
                                        $employees[$i]['contract']['may'] = $this->time_sum($employees[$i]['contract']['may'], ($working_days * $hour_per_day));
                                        break;
                                    case '06':
                                        $employees[$i]['contract']['jun'] = $this->time_sum($employees[$i]['contract']['jun'], ($working_days * $hour_per_day));
                                        break;
                                    case '07':
                                        $employees[$i]['contract']['jul'] = $this->time_sum($employees[$i]['contract']['jul'], ($working_days * $hour_per_day));
                                        ;
                                        break;
                                    case '08':
                                        $employees[$i]['contract']['aug'] = $this->time_sum($employees[$i]['contract']['aug'], ($working_days * $hour_per_day));
                                        break;
                                    case '09':
                                        $employees[$i]['contract']['sep'] = $this->time_sum($employees[$i]['contract']['sep'], ($working_days * $hour_per_day));
                                        break;
                                    case '10':
                                        $employees[$i]['contract']['oct'] = $this->time_sum($employees[$i]['contract']['oct'], ($working_days * $hour_per_day));
                                        break;
                                    case '11':
                                        $employees[$i]['contract']['nov'] = $this->time_sum($employees[$i]['contract']['nov'], ($working_days * $hour_per_day));
                                        break;
                                    case '12':
                                        $employees[$i]['contract']['dec'] = $this->time_sum($employees[$i]['contract']['dec'], ($working_days * $hour_per_day));
                                        break;
                                }
                            }
                        } else {
                            $working_days = $contract->get_working_days($data[$j]['date_from'], $data[$j]['date_to']);
                            $hour_per_day = ($working_days != 0 ? ($data[$j]['hour'] / $working_days) : 0);
                            $year_from = date('Y', strtotime($data[$j]['date_from']));
                            $year_to = date('Y', strtotime($data[$j]['date_to']));
                            if ($year_from == $year) {
                                $start = intval(date('m', strtotime($data[$j]['date_from'])));
                                $end = 12;
                                for ($k = $start; $k <= $end; $k++) {
                                    $month_days = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $k), $year);
                                    $last_month_days = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', 12), $year);
                                    if ($k == $start) {
                                        $working_days = $contract->get_working_days($data[$j]['date_from'], $year . "-" . $k . "-" . $month_days);
                                    } else {
                                        $working_days = $contract->get_working_days($year . "-" . $k . "-01", $year . "-" . $k . "-" . $month_days);
                                    }
                                    switch ($k) {
                                        case 1:
                                            $employees[$i]['contract']['jan'] = $this->time_sum($employees[$i]['contract']['jan'], ($working_days * $hour_per_day));
                                            break;

                                        case 2:
                                            $employees[$i]['contract']['feb'] = $this->time_sum($employees[$i]['contract']['feb'], ($working_days * $hour_per_day));
                                            break;
                                        case 3:
                                            $employees[$i]['contract']['mar'] = $this->time_sum($employees[$i]['contract']['mar'], ($working_days * $hour_per_day));
                                            break;
                                        case 4:
                                            $employees[$i]['contract']['apr'] = $this->time_sum($employees[$i]['contract']['apr'], ($working_days * $hour_per_day));
                                            break;
                                        case 5:
                                            $employees[$i]['contract']['may'] = $this->time_sum($employees[$i]['contract']['may'], ($working_days * $hour_per_day));
                                            break;
                                        case 6:
                                            $employees[$i]['contract']['jun'] = $this->time_sum($employees[$i]['contract']['jun'], ($working_days * $hour_per_day));
                                            break;
                                        case 7:
                                            $employees[$i]['contract']['jul'] = $this->time_sum($employees[$i]['contract']['jul'], ($working_days * $hour_per_day));
                                            ;
                                            break;
                                        case 8:
                                            $employees[$i]['contract']['aug'] = $this->time_sum($employees[$i]['contract']['aug'], ($working_days * $hour_per_day));
                                            break;
                                        case 9:
                                            $employees[$i]['contract']['sep'] = $this->time_sum($employees[$i]['contract']['sep'], ($working_days * $hour_per_day));
                                            break;
                                        case 10:
                                            $employees[$i]['contract']['oct'] = $this->time_sum($employees[$i]['contract']['oct'], ($working_days * $hour_per_day));
                                            break;
                                        case 11:
                                            $employees[$i]['contract']['nov'] = $this->time_sum($employees[$i]['contract']['nov'], ($working_days * $hour_per_day));
                                            break;
                                        case 12:
                                            $employees[$i]['contract']['dec'] = $this->time_sum($employees[$i]['contract']['dec'], ($working_days * $hour_per_day));
                                            break;
                                    }
                                }
                            } else if ($year_to == $year) {
                                $start = 01;
                                $end = intval(date('m', strtotime($data[$j]['date_to'])));
                                for ($k = $start; $k <= $end; $k++) {
                                    $month_days = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $k), $year);
                                    if ($k == $end) {
                                        $working_days = $contract->get_working_days($year . "-" . $k . "-01", $data[$j]['date_to']);
                                    } else {
                                        $working_days = $contract->get_working_days($year . "-" . $k . "-01", $year . "-" . $k . "-" . $month_days);
                                    }
                                    switch ($k) {
                                        case 1:
                                            $employees[$i]['contract']['jan'] = $this->time_sum($employees[$i]['contract']['jan'], ($working_days * $hour_per_day));
                                            break;

                                        case 2:
                                            $employees[$i]['contract']['feb'] = $this->time_sum($employees[$i]['contract']['feb'], ($working_days * $hour_per_day));
                                            break;
                                        case 3:
                                            $employees[$i]['contract']['mar'] = $this->time_sum($employees[$i]['contract']['mar'], ($working_days * $hour_per_day));
                                            break;
                                        case 4:
                                            $employees[$i]['contract']['apr'] = $this->time_sum($employees[$i]['contract']['apr'], ($working_days * $hour_per_day));
                                            break;
                                        case 5:
                                            $employees[$i]['contract']['may'] = $this->time_sum($employees[$i]['contract']['may'], ($working_days * $hour_per_day));
                                            break;
                                        case 6:
                                            $employees[$i]['contract']['jun'] = $this->time_sum($employees[$i]['contract']['jun'], ($working_days * $hour_per_day));
                                            break;
                                        case 7:
                                            $employees[$i]['contract']['jul'] = $this->time_sum($employees[$i]['contract']['jul'], ($working_days * $hour_per_day));
                                            ;
                                            break;
                                        case 8:
                                            $employees[$i]['contract']['aug'] = $this->time_sum($employees[$i]['contract']['aug'], ($working_days * $hour_per_day));
                                            break;
                                        case 9:
                                            $employees[$i]['contract']['sep'] = $this->time_sum($employees[$i]['contract']['sep'], ($working_days * $hour_per_day));
                                            break;
                                        case 10:
                                            $employees[$i]['contract']['oct'] = $this->time_sum($employees[$i]['contract']['oct'], ($working_days * $hour_per_day));
                                            break;
                                        case 11:
                                            $employees[$i]['contract']['nov'] = $this->time_sum($employees[$i]['contract']['nov'], ($working_days * $hour_per_day));
                                            break;
                                        case 12:
                                            $employees[$i]['contract']['dec'] = $this->time_sum($employees[$i]['contract']['dec'], ($working_days * $hour_per_day));
                                            break;
                                    }
                                }
                            } else {
                                for ($j = 01; $j <= 12; $j++) {
                                    $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $j), $year);
                                    $working_days = $contract->get_working_days($year . '-' . sprintf('%02s', $j) . "-01", $year . '-' . $j . "-" . $num) . "<br><br>";
                                    $hour_per_day = round($hour_per_day, 2);
                                    switch ($j) {
                                        case 1:
                                            $employees[$i]['contract']['jan'] = $this->time_sum($employees[$i]['contract']['jan'], ($working_days * $hour_per_day));
                                            break;

                                        case 2:
                                            $employees[$i]['contract']['feb'] = $this->time_sum($employees[$i]['contract']['feb'], ($working_days * $hour_per_day));
                                            break;
                                        case 3:
                                            $employees[$i]['contract']['mar'] = $this->time_sum($employees[$i]['contract']['mar'], ($working_days * $hour_per_day));
                                            break;
                                        case 4:
                                            $employees[$i]['contract']['apr'] = $this->time_sum($employees[$i]['contract']['apr'], ($working_days * $hour_per_day));
                                            break;
                                        case 5:
                                            $employees[$i]['contract']['may'] = $this->time_sum($employees[$i]['contract']['may'], ($working_days * $hour_per_day));
                                            break;
                                        case 6:
                                            $employees[$i]['contract']['jun'] = $this->time_sum($employees[$i]['contract']['jun'], ($working_days * $hour_per_day));
                                            break;
                                        case 7:
                                            $employees[$i]['contract']['jul'] = $this->time_sum($employees[$i]['contract']['jul'], ($working_days * $hour_per_day));
                                            ;
                                            break;
                                        case 8:
                                            $employees[$i]['contract']['aug'] = $this->time_sum($employees[$i]['contract']['aug'], ($working_days * $hour_per_day));
                                            break;
                                        case 9:
                                            $employees[$i]['contract']['sep'] = $this->time_sum($employees[$i]['contract']['sep'], ($working_days * $hour_per_day));
                                            break;
                                        case 10:
                                            $employees[$i]['contract']['oct'] = $this->time_sum($employees[$i]['contract']['oct'], ($working_days * $hour_per_day));
                                            break;
                                        case 11:
                                            $employees[$i]['contract']['nov'] = $this->time_sum($employees[$i]['contract']['nov'], ($working_days * $hour_per_day));
                                            break;
                                        case 12:
                                            $employees[$i]['contract']['dec'] = $this->time_sum($employees[$i]['contract']['dec'], ($working_days * $hour_per_day));
                                            break;
                                    }
                                }
                            }
                        }
                    } else {
                        $datediff = strtotime($data[$j]['date_to']) - strtotime($data[$j]['date_from']);
                        $total_days = floor($datediff / (60 * 60 * 24));
                        $hour_per_day = ($total_days != 0 ? ($data[$j]['hour'] / $total_days) : 0);

                        $year_from = date('Y', strtotime($data[$j]['date_from']));
                        $year_to = date('Y', strtotime($data[$j]['date_to']));
                        if ($year_from == $year_to) {
                            $date_from = $data[$j]['date_from'];
                            $date_to = $data[$j]['date_to'];
                        } else {
                            if ($year_from == $year) {
                                $date_from = $data[$j]['date_from'];
                                $date_to = $year . "-12-31";
                            } else if ($year_to == $year) {
                                $date_from = $year . "-01-01";
                                $date_to = $data[$j]['date_to'];
                            } else {
                                $date_from = $year . "-01-01";
                                $date_to = $year . "-12-31";
                            }
                        }
                        $start = date("m", strtotime($date_from));
                        $end = date("m", strtotime($date_to));

                        for ($h = $start; $h <= $end; $h++) {
                            if ($h == $start) {
                                $num_days_month = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $h), $year);
                                $datediff = strtotime($year . "-" . $h . "-" . $num_days_month) - strtotime($date_from);
                                $total_days_month = floor($datediff / (60 * 60 * 24));
                            } else if ($h == $end) {
                                $num_days_month = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $h), $year);
                                $datediff = strtotime($date_to) - strtotime($year . "-" . $h . "-01");
                                $total_days_month = floor($datediff / (60 * 60 * 24));
                            } else {
                                $num_days_month = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $h), $year);
                                $datediff = strtotime($year . "-" . $h . "-" . $num_days_month) - strtotime($year . "-" . $h . "-01");
                                $total_days_month = floor($datediff / (60 * 60 * 24));
                            }
//                            echo $total_days_month."  ".$hour_per_day;

                            switch ($h) {
                                case 1:
                                    $employees[$i]['contract']['jan'] = $this->time_sum($employees[$i]['contract']['jan'], ($total_days_month * $hour_per_day));
                                    break;

                                case 2:
                                    $employees[$i]['contract']['feb'] = $this->time_sum($employees[$i]['contract']['feb'], ($total_days_month * $hour_per_day));
                                    break;
                                case 3:
                                    $employees[$i]['contract']['mar'] = $this->time_sum($employees[$i]['contract']['mar'], ($total_days_month * $hour_per_day));
                                    break;
                                case 4:
                                    $employees[$i]['contract']['apr'] = $this->time_sum($employees[$i]['contract']['apr'], ($total_days_month * $hour_per_day));
                                    break;
                                case 5:
                                    $employees[$i]['contract']['may'] = $this->time_sum($employees[$i]['contract']['may'], ($total_days_month * $hour_per_day));
                                    break;
                                case 6:
                                    $employees[$i]['contract']['jun'] = $this->time_sum($employees[$i]['contract']['jun'], ($total_days_month * $hour_per_day));
                                    break;
                                case 7:
                                    $employees[$i]['contract']['jul'] = $this->time_sum($employees[$i]['contract']['jul'], ($total_days_month * $hour_per_day));
                                    ;
                                    break;
                                case 8:
                                    $employees[$i]['contract']['aug'] = $this->time_sum($employees[$i]['contract']['aug'], ($total_days_month * $hour_per_day));
                                    break;
                                case 9:
                                    $employees[$i]['contract']['sep'] = $this->time_sum($employees[$i]['contract']['sep'], ($total_days_month * $hour_per_day));
                                    break;
                                case 10:
                                    $employees[$i]['contract']['oct'] = $this->time_sum($employees[$i]['contract']['oct'], ($total_days_month * $hour_per_day));
                                    break;
                                case 11:
                                    $employees[$i]['contract']['nov'] = $this->time_sum($employees[$i]['contract']['nov'], ($total_days_month * $hour_per_day));
                                    break;
                                case 12:
                                    $employees[$i]['contract']['dec'] = $this->time_sum($employees[$i]['contract']['dec'], ($total_days_month * $hour_per_day));
                                    break;
                            }
                        }
                    }
                }
            } else {
                $daily_hour = $company_details['weekly_hour'] / 7;
                for ($j = 01; $j <= 12; $j++) {
                    $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $j), $year);
                    $working_days = $contract->get_working_days('01-' . sprintf('%02s', $j) . "-" . $year, $num . '-' . $j . "-" . $year);
                    switch ($j) {
                        case 1:
                            $employees[$i]['contract']['jan'] = $working_days * $daily_hour;
                            break;

                        case 2:
                            $employees[$i]['contract']['feb'] = $working_days * $daily_hour;
                            break;
                        case 3:
                            $employees[$i]['contract']['mar'] = $working_days * $daily_hour;
                            break;
                        case 4:
                            $employees[$i]['contract']['apr'] = $working_days * $daily_hour;
                            break;
                        case 5:
                            $employees[$i]['contract']['may'] = $working_days * $daily_hour;
                            break;
                        case 6:
                            $employees[$i]['contract']['jun'] = $working_days * $daily_hour;
                            break;
                        case 7:
                            $employees[$i]['contract']['jul'] = $working_days * $daily_hour;
                            break;
                        case 8:
                            $employees[$i]['contract']['aug'] = $working_days * $daily_hour;
                            break;
                        case 9:
                            $employees[$i]['contract']['sep'] = $working_days * $daily_hour;
                            break;
                        case 10:
                            $employees[$i]['contract']['oct'] = $working_days * $daily_hour;
                            break;
                        case 11:
                            $employees[$i]['contract']['nov'] = $working_days * $daily_hour;
                            break;
                        case 12:
                            $employees[$i]['contract']['dec'] = $working_days * $daily_hour;
                            break;
                    }
                }
            }
            $this->tables = array('timetable');
            $this->fields = array('time_from', 'time_to', 'date');
            $this->conditions = array('AND', 'employee = ?', 'status = 1', 'YEAR(`date`) = ?');
            $this->condition_values = array($employees[$i]['username'], $year);
//        print_r($this->condition_values );
            $this->query_generate();
//        echo $this->sql_query;
            $time_table = $this->query_fetch();
            if ($time_table) {
                for ($j = 0; $j < count($time_table); $j++) {
                    $month_contract = date("m", strtotime($time_table[$j]['date']));
                    switch ($month_contract) {
                        case "01":
                            $employees[$i]['year']['jan'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['jan']);
//                          $employees[$i]['year']['jan'] = $dona->time_to_sixty($employees[$i]['year']['jan']);
                            break;

                        case '02':
                            $employees[$i]['year']['feb'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['feb']);
                            break;
                        case '03':
                            $employees[$i]['year']['mar'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['mar']);
                            break;
                        case '04':
                            $employees[$i]['year']['apr'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['apr']);
                            break;
                        case '05':
                            $employees[$i]['year']['may'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['may']);
                            break;
                        case '06':
                            $employees[$i]['year']['jun'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['jun']);
                            break;
                        case '07':
                            $employees[$i]['year']['jul'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['jul']);
                            break;
                        case '08':
                            $employees[$i]['year']['aug'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['aug']);
                            break;
                        case '09':
                            $employees[$i]['year']['sep'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['sep']);
                            break;
                        case '10':
                            $employees[$i]['year']['oct'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['oct']);
                            break;
                        case '11':
                            $employees[$i]['year']['nov'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['nov']);
                            break;
                        case '12':
                            $employees[$i]['year']['dec'] = $this->time_sum($this->time_difference($time_table[$j]['time_to'], $time_table[$j]['time_from']), $employees[$i]['year']['dec']);
                            break;
                    }
                }
            }
            $daily_hour = $company_details['weekly_hour'] / 7;
            for ($j = 01; $j <= 12; $j++) {
                $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $j), $year);
                $working_days = $contract->get_working_days('01-' . sprintf('%02s', $j) . "-" . $year, $num . '-' . $j . "-" . $year);
                switch ($j) {
                    case 1:
                        if ($employees[$i]['contract']['jan'] == "0.00")
                            $employees[$i]['contract']['jan'] = $working_days * $daily_hour;
                        break;

                    case 2:
                        if ($employees[$i]['contract']['feb'] == "0.00")
                            $employees[$i]['contract']['feb'] = $working_days * $daily_hour;
                        break;
                    case 3:
                        if ($employees[$i]['contract']['mar'] == "0.00")
                            $employees[$i]['contract']['mar'] = $working_days * $daily_hour;
                        break;
                    case 4:
                        if ($employees[$i]['contract']['apr'] == "0.00")
                            $employees[$i]['contract']['apr'] = $working_days * $daily_hour;
                        break;
                    case 5:
                        if ($employees[$i]['contract']['may'] == "0.00")
                            $employees[$i]['contract']['may'] = $working_days * $daily_hour;
                        break;
                    case 6:
                        if ($employees[$i]['contract']['jun'] == "0.00")
                            $employees[$i]['contract']['jun'] = $working_days * $daily_hour;
                        break;
                    case 7:
                        if ($employees[$i]['contract']['jul'] == "0.00")
                            $employees[$i]['contract']['jul'] = $working_days * $daily_hour;
                        break;
                    case 8:
                        if ($employees[$i]['contract']['aug'] == "0.00")
                            $employees[$i]['contract']['aug'] = $working_days * $daily_hour;
                        break;
                    case 9:
                        if ($employees[$i]['contract']['sep'] == "0.00")
                            $employees[$i]['contract']['sep'] = $working_days * $daily_hour;
                        break;
                    case 10:
                        if ($employees[$i]['contract']['oct'] == "0.00")
                            $employees[$i]['contract']['oct'] = $working_days * $daily_hour;
                        break;
                    case 11:
                        if ($employees[$i]['contract']['nov'] == "0.00")
                            $employees[$i]['contract']['nov'] = $working_days * $daily_hour;
                        break;
                    case 12:
                        if ($employees[$i]['contract']['dec'] == "0.00")
                            $employees[$i]['contract']['dec'] = $working_days * $daily_hour;
                        break;
                }
            }
        }
        for ($i = 0; $i < count($employees); $i++) {
            $jan_year = explode(".", $employees[$i]['year']['jan']);
            $jan_year[1] = str_pad($jan_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['jan'] = $equipment->time_user_format($jan_year[0] . "." . $jan_year[1], 100);

            $feb_year = explode(".", $employees[$i]['year']['feb']);
            $feb_year[1] = str_pad($feb_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['feb'] = $equipment->time_user_format($feb_year[0] . "." . $feb_year[1], 100);

            $mar_year = explode(".", $employees[$i]['year']['mar']);
            $mar_year[1] = str_pad($mar_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['mar'] = $equipment->time_user_format($mar_year[0] . "." . $mar_year[1], 100);
            $apr_year = explode(".", $employees[$i]['year']['apr']);
            $apr_year[1] = str_pad($jan_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['apr'] = $equipment->time_user_format($apr_year[0] . "." . $apr_year[1], 100);

            $jun_year = explode(".", $employees[$i]['year']['jun']);
            $jun_year[1] = str_pad($jun_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['jun'] = $equipment->time_user_format($jun_year[0] . "." . $jun_year[1], 100);

            $may_year = explode(".", $employees[$i]['year']['may']);
            $may_year[1] = str_pad($may_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['may'] = $equipment->time_user_format($may_year[0] . "." . $may_year[1], 100);
//            if($jun_year[1] == "5")
//                $jun_year[1]="05";
//            $employees[$i]['year']['jun'] = $jun_year[0].".".$jun_year[1];

            $jul_year = explode(".", $employees[$i]['year']['jul']);
            $jul_year[1] = str_pad($jul_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['jul'] = $equipment->time_user_format($jul_year[0] . "." . $jul_year[1], 100);
            $aug_year = explode(".", $employees[$i]['year']['aug']);
            $aug_year[1] = str_pad($aug_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['aug'] = $equipment->time_user_format($aug_year[0] . "." . $aug_year[1], 100);

            $sep_year = explode(".", $employees[$i]['year']['sep']);
            $sep_year[1] = str_pad($sep_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['sep'] = $equipment->time_user_format($sep_year[0] . "." . $sep_year[1], 100);

            $oct_year = explode(".", $employees[$i]['year']['oct']);
            $oct_year[1] = str_pad($oct_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['oct'] = $equipment->time_user_format($oct_year[0] . "." . $oct_year[1], 100);

            $nov_year = explode(".", $employees[$i]['year']['nov']);
            $nov_year[1] = str_pad($nov_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['nov'] = $equipment->time_user_format($nov_year[0] . "." . $nov_year[1], 100);

            $dec_year = explode(".", $employees[$i]['year']['dec']);
            $dec_year[1] = str_pad($dec_year[1], 2, "0", STR_PAD_LEFT);
            $employees[$i]['year']['dec'] = $equipment->time_user_format($dec_year[0] . "." . $dec_year[1], 100);
        }
        return $employees;
//                }}} 
    }

    function get_employee_monthly_contract($emp, $month, $year) {
        $contract = new contract();
        $equipment = new equipment();
        $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s', $month), $year);
        $week_start_num = date('W', strtotime("01-" . sprintf('%02s', $month) . "-" . $year));
        $week_end_num = date('W', strtotime($num . "-" . sprintf('%02s', $month) . "-" . $year));
        $number_of_weeks = $week_end_num - $week_start_num;
        for ($i = 0; $i <= $number_of_weeks; $i++) {
            $this_contract = $this->employee_contract_week_hour($emp, $year . '|' . $week, TRUE);
            $contract_hours = $this->time_sum($contract_hours, $this_contract);
        }
        $contract_hours = $equipment->time_user_format($contract_hours, 100);
        return $contract_hours;
    }

    function check_is_team_member($customer, $employee, $return_true_if_any_none = FALSE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: to check is an employee a team member or customer
         * @param: $return_true_if_any_none 
         *      (value: TRUE) - it return TRUE while any of employee or customer becomes ''
         *      (value: FALSE)- it return FALSE while any of employee or customer becomes ''
         * return type: Boolean
         */
        if ($customer == '' || $employee == '')
            return $return_true_if_any_none;

        $this->flush();
        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'customer = ?', 'employee = ?');
        $this->condition_values = array($customer, $employee);
        $this->query_generate();
        $data = $this->query_fetch();

        return (!empty($data) ? TRUE : FALSE);
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
        return (count($datas) > 0 ? $datas : FALSE);
    }

    function findout_slot_alteration_bug($source_data, $exception_ids = array(), $msg_flag = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: find our any bugs when a slot alter
         * if any bugs - the message sets to SESSION message
         * @param: $exception_ids - is used for excepting any ids for slot collide checking
         * return type: Boolean
         */

       


        if ($msg_flag == 1) {
            require_once ('plugins/message.class.php');
            $msg = new message();
        }
        $exception_id_string = '';
        if (!empty($exception_ids)) {
            $exception_id_string = implode(',', $exception_ids);
        }
        $this->sql_query = "CALL findout_slot_alteration_bug(:employee,:customer,:date,:type,:time_from,:time_to,:fkkn,:exception_ids,@fname,@lname,@flag,@message,@cfname,@clname,@ctime_from,@ctime_to)";
        $stmt = $this->con->prepare($this->sql_query);
        $stmt->bindParam(':employee', $source_data['employee']);
        $stmt->bindParam(':customer', $source_data['customer']);
        $stmt->bindParam(':date', $source_data['date']);
        $stmt->bindParam(':type', $source_data['type']);
        $stmt->bindParam(':time_from', $source_data['time_from']);
        $stmt->bindParam(':time_to', $source_data['time_to']);
        $stmt->bindParam(':fkkn', $source_data['fkkn']);
        $stmt->bindParam(':exception_ids', $exception_id_string);

        $stmt->execute();
        $stmt->closeCursor();
        $this->sql_query = "select @flag, @message,@lname,@fname,@cfname,@clname,@ctime_from,@ctime_to";
        $data = $this->query_fetch();
       // echo "<pre>".print_r($data,1)."</pre>";
       // exit('fg');
        //return TRUE;
        if (empty($data)) {
            $msg->set_message_exact('fail', 'Sorry Its Fucked up');
            return FALSE;
        } else {
            if ($data[0]['@flag'] == 1) {
                return TRUE;
            } else {
                $emp_name = $_SESSION['company_sort_by'] == 1 ? $data[0]['@fname'] . " " . $data[0]['@lname'] : $data[0]['@lname'] . " " . $data[0]['@fname'];
                $cust_name = $_SESSION['company_sort_by'] == 1 ? $data[0]['@cfname'] . " " . $data[0]['@clname'] : $data[0]['@clname'] . " " . $data[0]['@cfname'];
                $msg->set_message('fail', $data[0]['@message']);
                //check inconvenient possibility if it is a oncall type slot
                if ($data[0]['@message'] == 'employee_is_inactive') {
                    $msg->set_message_exact('fail', ' - ' . $emp_name);
                    //check customer is inactive
                } elseif ($data[0]['@message'] == 'customer_is_inactive') {
                    $msg->set_message_exact('fail', ' - ' . $emp_name);
                }
                //check inconvenient possibility if it is a oncall type slot
                elseif ($data[0]['@message'] == 'time_outside_oncall') {
                    $msg->set_message_exact('fail', $source_data['date'] . ' => ' . str_pad(sprintf('%.02f', (float) $source_data['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $source_data['time_to']), 5, '0', STR_PAD_LEFT));
                }
                //check report signed in
                elseif ($data[0]['@message'] == 'employee_signed_in') {
                    $msg->set_message_exact('fail', $emp_name . ' <-> ' . $cust_name . ' => ' . $source_data['date']);
                }
                //check slot collide
                elseif ($data[0]['@message'] == 'slot_collide') {
                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_data['date'] . ' ' . str_pad(sprintf('%.02f', (float) $source_data['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $source_data['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . str_pad(sprintf('%.02f', $data[0]['@ctime_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $data[0]['@ctime_to']), 5, '0', STR_PAD_LEFT));
                }
                //check leave taken
                elseif ($data[0]['@message'] == 'employee_took_a_leave') {
                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_data['date'] . ' ' . str_pad(sprintf('%.02f', $data[0]['@ctime_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $data[0]['@ctime_to']), 5, '0', STR_PAD_LEFT));
                }
                // check non_preferred_time
                elseif ($data[0]['@message'] == 'slot_collide_with_non_preferred_time') {
                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_data['date'] . ' ' . str_pad(sprintf('%.02f', $data[0]['@ctime_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $data[0]['@ctime_to']), 5, '0', STR_PAD_LEFT));
                }
                //check leave taken
                elseif ($data[0]['@message'] == 'team_error') {
                    $obj_smarty     = new smartySetup(array('messages.xml'), FALSE);
                    $msg->set_message_exact('fail', $emp_name . ' ' . $obj_smarty->translate['is_not_team_member_of'] . ' ' . $cust_name);
                }
                return FALSE;
            }
        }
    }

    function contract_checking_for_right_click($ids, $week_year, $emp) {

        $employee_slot_details = $this->get_multiple_slot_details($ids);
        $total_new_time = 0.00;
        for ($i = 0; $i < count($employee_slot_details); $i++) {
            $total_new_time = $this->time_sum($total_new_time, $this->time_difference($employee_slot_details[$i]['time_from'], $employee_slot_details[$i]['time_to']));
        }

        $week_year_array = explode('|', $week_year);
        $id_string = '\'' . implode('\', \'', $ids) . '\'';

        $this->tables = array('timetable');
        $this->fields = array('time_from', 'time_to', 'date');
        $this->conditions = array('AND', 'employee = ?', 'WEEK(date,1) = ?', 'YEAR(date) = ?', 'status = 1', array('NOT IN', 'id', $id_string));
        $this->condition_values = array($emp, $week_year_array[1], $week_year_array[0]);
        $this->query_generate();
        $data = $this->query_fetch();

        for ($i = 0; $i < count($data); $i++) {
            $total_new_time = $this->time_sum($total_new_time, $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
        }

        $weekly_contract_hour = floatval($this->employee_contract_week_hour($emp, $week_year, TRUE));
        $total_time = floatval($total_new_time);
        if ($total_time > $weekly_contract_hour) {
            return "overload";
        } else {
            return 1;
        }
    }

    function get_employee_role_on_customer($customer, $employee = '') {
        /**
         * @author: Shaju KT <shajukt@arioninfotech.com>
         * @for: get tl role at a customer

         */
        $user = new user();

        if ($employee == '') {
            $employee = $_SESSION['user_id'];
        }
        $user_role = $user->user_role($employee);
        if ($user_role == 2 || $user_role == 7) {
            $this->tables = array('team');
            $this->fields = array('role');
            $this->conditions = array('AND', 'customer = ?', 'employee = ?');
            $this->condition_values = array($customer, $employee);
            $this->query_generate();
//            $data = $this->query_fetch(2);
            $data = $this->query_fetch();
            return $data[0]['role'];
        }
        else
            return $user_role;
    }

    function employees_list_for_right_click($page_user, $status = 1, $session_user = '') {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @for: get employee list for right click - for goto employees options
         * @param: $page_user may either employee or customer dippending gdschema_employee or gdschema_customer window user
         * @param: $page_type value  - not used now
         *      + 'employee' - request come gdschema_employee
         *      + 'customer' - request come gdschema_customer
         */
        $user = new user();
        $login_user = $session_user;
        if ($session_user == '')
            $login_user = $_SESSION['user_id'];


        $login_user_role = $user->user_role($login_user);
        $page_user_role = $user->user_role($page_user);

        //$page_type indicates: request source page - gdschema_employee/gdschema_customer
        $page_type = ($page_user_role == 4 ? 'customer' : 'employee');
        $employee_data = array();
        // echo 'hi';

        $this->flush();
        switch ($login_user_role) {
            case 1:
            case 6:
                if ($page_type == 'customer') {
                    $employee_data = $this->get_team_employees_of_customer($page_user);
                } else if ($page_type == 'employee') {
                    $this->tables = array('employee');
                    $this->fields = array('username', 'first_name', 'last_name', 'mobile', 'code', 'social_security', 'email', 'picture');
                    if ($status != -1) { //status checking, -1 indiated no need to check status
                        $this->conditions = array('AND', 'status = ?');
                        $this->condition_values = array($status);
                    }
                    if ($_SESSION['company_sort_by'] == 1)
                        $this->order_by = array('LOWER(first_name) collate utf8_bin ASC', 'LOWER(last_name) collate utf8_bin ASC');
                    elseif ($_SESSION['company_sort_by'] == 2)
                        $this->order_by = array('LOWER(last_name) collate utf8_bin ASC', 'LOWER(first_name) collate utf8_bin ASC');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                }
                break;
            case 2:
            case 7:
                if ($page_type == 'customer') {
                    $login_user_team_role = $this->get_team_role_of_employee($login_user, $page_user);
                    $this->flush();
                    if (!empty($login_user_team_role) && ($login_user_team_role['role'] == 2 || $login_user_team_role['role'] == 7)) {
                        $employee_data = $this->get_team_employees_of_customer($page_user, $status);
                    } else {
                        //returns only his data
                        $employee_data = $this->employee_detail_main($login_user);
                    }
                } else if ($page_type == 'employee') {
                    // get all TL/GL customers of him
                    $GLed_customers = $this->get_customers_of_GLed_user($login_user, $status);
                    $this->flush();
                    if (!empty($GLed_customers)) {
                        $GLed_customer_ids = array();
                        foreach ($GLed_customers as $this_customer) {
                            $GLed_customer_ids[] = $this_customer['username'];
                        }
                        $employee_data = $this->get_team_employees_of_customer($GLed_customer_ids, $status);
                    } else {
                        //returns only his data
                        $employee_data = $this->employee_detail_main($login_user);
                    }
                }
                break;
            case 3:
            case 5:
                //returns only his data
                if ($page_type == 'customer' || $page_type == 'employee') {
                    $employee_data = $this->employee_detail_main($login_user);
                }
                break;
            case 4:
                if ($page_type == 'customer' || $page_type == 'employee') {
                    $employee_data = $this->get_team_employees_of_customer($login_user, $status);
                }
                break;
        }
        return $employee_data;
    }

    function customers_list_for_right_click($page_user, $mode=0) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @for: get customers list for right click - for goto customers submenu
         * @param: $page_user may either employee or customer dippending gdschema_employee or gdschema_customer window user
         * @param: $page_type value  - not used now
         *      + 'employee' - request come gdschema_employee
         *      + 'customer' - request come gdschema_customer
         */
        $user = new user();

        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $page_user_role = $user->user_role($page_user);

        //$page_type indicates: request source page - gdschema_employee/gdschema_customer
        $page_type = ($page_user_role == 4 ? 'customer' : 'employee');
        $customer_data = array();

        $this->flush();
        switch ($login_user_role) {
            case 1:
            case 6:
                if ($page_type == 'customer') {
                    $this->tables = array('customer');
                    $this->fields = array('username', 'first_name', 'last_name', 'mobile', 'email', 'phone', 'map_location');
                    $this->conditions = array('AND', 'status = 1');
                    $this->order_by = array('LOWER(last_name)', 'LOWER(first_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                } else if ($page_type == 'employee') {
                    $customer_data = $this->get_team_customers_of_employee($page_user);
                }
                break;
            case 2:
            case 7:
                if($mode == 1){
                    $customer_data = $this->get_team_customers_of_employee($page_user);
                }else{
                    if ($page_type == 'customer') {
                        $customer_data = $this->get_team_customers_of_employee($login_user);
                    } else if ($page_type == 'employee') {
                        //mutual customers of GLed customers and page user customers
                        $GLed_custs = $this->get_customers_of_GLed_user($login_user);
                        $Emp_custs = $this->get_team_customers_of_employee($page_user);
                        $customer_data = array_uintersect($GLed_custs, $Emp_custs, function($value1, $value2) {
                                    return strcmp($value1['username'], $value2['username']);
                                });
                    }
                }
                break;
            case 3:
            case 5:
                //returns only his data
                if ($page_type == 'customer' || $page_type == 'employee') {
                    $customer_data = $this->get_team_customers_of_employee($login_user);
                }
                break;
            case 4:
                if ($page_type == 'customer' || $page_type == 'employee') {
                    $obj_customer = new customer();
                    $customer_data = array($obj_customer->customer_detail($login_user));
                }
                break;
        }
        return $customer_data;
    }

    function get_customers_of_GLed_user($this_employee, $status = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get all customers if this_employee is TL/suTL of that customers
         */
        $this->flush();
        $this->tables = array('team` as `t', 'customer` as `c');
        $this->fields = array('DISTINCT c.username', 'c.first_name', 'c.last_name', 'c.mobile', 'c.phone', 'c.email', 'c.code');
        $this->conditions = array('AND', 't.employee = ?', 'c.username = t.customer', array('IN', 'role', '2,7'));
        $this->condition_values = array($this_employee);
        if ($status != -1) { //status checking, -1 indiated no need to check status
            $this->conditions[] = 'c.status = ?';
            $this->condition_values[] = $status;
        }
        $this->order_by = array('LOWER(c.last_name)', 'LOWER(c.first_name)');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_team_role_of_employee($this_employee, $this_customer) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get team role of employee in a team
         */
        $this->flush();
        $this->tables = array('team');
        $this->fields = array('role');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?');
        $this->condition_values = array($this_employee, $this_customer);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_team_employees_of_customer($this_customer, $status = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get all employees of a customer/customers (team)
         */
        $this->flush();
        $this->tables = array('team` as `t', 'employee` as `e');
        $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name', 'e.mobile', 'e.code', 'e.color', 'e.social_security', 'e.email', 'e.picture');
        $this->condition_values = array();
        if (is_array($this_customer)) {
            $this_customers_string = '\'' . implode('\' , \'', $this_customer) . '\'';
            $this->conditions = array('AND', 'e.username = t.employee', array('IN', 't.customer', $this_customers_string));
        } else {
            $this->conditions = array('AND', 't.customer = ?', 'e.username = t.employee');
            $this->condition_values = array($this_customer);
        }
        if ($status != -1) { //status checking, -1 indiated no need to check status
            $this->conditions[] = 'e.status = ?';
            $this->condition_values[] = $status;
        }
        if ($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(e.first_name) collate utf8_bin ASC', 'LOWER(e.last_name) collate utf8_bin ASC');
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(e.last_name) collate utf8_bin ASC', 'LOWER(e.first_name) collate utf8_bin ASC');
        $this->query_generate();
        $employee_data = $this->query_fetch();
        return $employee_data;
    }

    function get_team_customers_of_employee($this_employee, $key = NULL, $status = 1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get all customers of a employee/employees (team)
         */
        $key = ($key != '' ? $key : NULL);
        $this->flush();
        $this->tables = array('team` as `t', 'customer` as `c');
        $this->fields = array('DISTINCT c.username', 'c.first_name', 'c.last_name', 'c.mobile', 'c.email', 'c.phone', 'c.code', 'c.map_location', 'c.picture', 'c.fkkn');
        $this->conditions = array('AND', 'c.username = t.customer');
        $this->condition_values = array();
        if ($status != -1) { //status checking, -1 indiated no need to check status
            $this->conditions[] = 'c.status = ?';
            $this->condition_values[] = $status;
        }
        if (is_array($this_employee)) {
            $this_employees_string = '\'' . implode('\' , \'', $this_employee) . '\'';
            $this->conditions[] = array('IN', 't.employee', $this_employees_string);
        } else {
            $this->conditions[] = 't.employee = ?';
            $this->condition_values[] = $this_employee;
        }
        if ($key != Null) {
            if ($key == "A") {
                $new_conditions = array(array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"', 'last_name NOT LIKE "å%"', 'last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"', 'last_name NOT LIKE "Å%"', 'last_name NOT LIKE "Ö%"');
                $this->conditions = array_merge($this->conditions, $new_conditions);
            }
            else{
                $this->conditions[] = array('OR', 'last_name LIKE ?', 'last_name LIKE ?');
                $this->condition_values[] = '%'.$key.'%';
                $this->condition_values[] = '%'.$key.'%';
            }
        }
        if ($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(c.first_name) collate utf8_bin', 'LOWER(c.last_name) collate utf8_bin');
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(c.last_name) collate utf8_bin', 'LOWER(c.first_name) collate utf8_bin');
        $this->query_generate();
        
        $customers_data = $this->query_fetch();
        return $customers_data;
    }

    function get_mutual_customers_of_employees($this_employees) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get mutual customers of multiple employees
         * @param $this_employees must be an array with count greater than 1
         */
        $this->flush();
        $mutual_customers = array();
        // if $this_employees contains a single employee name
        if (is_array($this_employees) && empty($this_employees)) {
            // nothing do
        } else if (!is_array($this_employees) || (is_array($this_employees) && count($this_employees) == 1)) {
            $this->tables = array('team` as `t', 'customer` as `c');
            $this->fields = array('DISTINCT c.username', 'c.first_name', 'c.last_name');
            $this->conditions = array('AND', 't.employee = ?', 'c.username = t.customer', 'c.status = 1');
            if (!is_array($this_employees))
                $this->condition_values = array($this_employees);
            else
                $this->condition_values = array($this_employees[0]);
            $this->order_by = array('LOWER(c.last_name)', 'LOWER(c.first_name)');
            $this->query_generate();
            $this->sql_query;
            $mutual_customers = $this->query_fetch();
        } else {
            /* example query
              $global_query = 'SELECT DISTINCT final_result.customer, c.first_name, c.last_name
              FROM (

              SELECT DISTINCT customer FROM
              (
              SELECT customer
              FROM `team`
              WHERE 1
              AND employee = "maaa001"
              ) as result1
              INNER JOIN
              (
              SELECT customer
              FROM `team`
              WHERE 1
              AND employee = "cifo001"
              ) as result2
              USING (customer)
              INNER JOIN
              (
              SELECT customer
              FROM `team`
              WHERE 1
              AND employee = "diya001"
              ) as result3
              USING (customer)
              ) as final_result, `customer` AS `c`
              WHERE final_result.customer = c.username
              order by c.username'; */
            $global_query = 'SELECT DISTINCT final_result.customer as username, c.first_name, c.last_name
                            FROM (
                                    SELECT DISTINCT customer FROM ';
            $employees_count = count($this_employees);
            foreach ($this_employees as $key => $this_employee) {
                $this->flush();
                $this->tables = array('team');
                $this->fields = array('customer');
                $this->conditions = array('AND', 'employee = "' . $this_employee . '"');
                $this->query_generate();
                $global_query .= ' ( ' . $this->sql_query . ' ) AS result' . $key . ' ';
                if ($key != 0)
                    $global_query .= ' USING (customer) ';
                if ($key != $employees_count - 1)
                    $global_query .= ' INNER JOIN ';
            }

            $global_query .= ' ) as final_result, `customer` AS `c`
                                WHERE final_result.customer = c.username
                                order by LOWER(c.last_name), LOWER(c.first_name)';
            $this->flush();
            $this->sql_query = $global_query;
            $mutual_customers = $this->query_fetch();
        }
        return $mutual_customers;
    }

    function get_mutual_employees_of_customers($this_customers) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get mutual employees of multiple customers(team)
         * @param $this_customers must be an array with count greater than 1
         */
        $this->flush();
        $mutual_employees = array();
        // if $this_customers contains a single employee name
        if (is_array($this_customers) && empty($this_customers)) {
            // nothing do
        } else if (!is_array($this_customers) || (is_array($this_customers) && count($this_customers) == 1)) {
            $this->tables = array('team` as `t', 'employee` as `e');
            $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 't.customer = ?', 'e.username = t.employee', 'e.status = 1');
            if (!is_array($this_customers))
                $this->condition_values = array($this_customers);
            else
                $this->condition_values = array($this_customers[0]);
            $this->order_by = array('LOWER(e.last_name)', 'LOWER(e.first_name)');
            $this->query_generate();
            $this->sql_query;
            $mutual_employees = $this->query_fetch();
        } else {
//            $this->db_name
            $global_query = 'SELECT DISTINCT final_result.employee as username, e.first_name, e.last_name
                            FROM (
                                    SELECT DISTINCT employee FROM ';
            $employees_count = count($this_customers);
            foreach ($this_customers as $key => $this_customer) {
                $this->flush();
                $this->tables = array('team');
                $this->fields = array('employee');
                $this->conditions = array('AND', 'customer = "' . $this_customer . '"');
                $this->query_generate();
                $global_query .= ' ( ' . $this->sql_query . ' ) AS result' . $key . ' ';
                if ($key != 0)
                    $global_query .= ' USING (employee) ';
                if ($key != $employees_count - 1)
                    $global_query .= ' INNER JOIN ';
            }

            $global_query .= ' ) as final_result, `employee` AS `e`
                                WHERE final_result.employee = e.username
                                order by LOWER(e.last_name), LOWER(e.first_name)';
            $this->flush();
            $this->sql_query = $global_query;
            $mutual_employees = $this->query_fetch();
        }
        return $mutual_employees;
    }

    function get_employees_worked_under_customer($customer, $year, $month = NULL, $fkkn = NULL, $key = NULL) {

        $this->flush();
        $this->tables = array('timetable` as `t', 'employee` as `e');
        $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
        $this->conditions = array('AND', 't.employee = e.username', 't.customer LIKE ?', 'YEAR(t.date) = ?', 't.employee IS NOT NULL', 't.employee != ?');
        $this->condition_values = array($customer, $year, '');
        $this->order_by = array('LOWER(e.last_name) collate utf8_bin', 'LOWER(e.first_name) collate utf8_bin');

        if ($month != NULL) {
            $this->conditions[] = 'MONTH(t.date) = ?';
            $this->condition_values[] = $month;
        }

        if ($fkkn != NULL) {
            if ($fkkn == 1)
                $this->conditions[] = 't.fkkn = ?';
            elseif ($fkkn == 2)
                $this->conditions[] = array('OR', 't.fkkn = ?', 't.fkkn = 3');
            elseif ($fkkn == 3)
                $this->conditions[] = array('OR', 't.fkkn = ?', 't.fkkn = 2');
            $this->condition_values[] = $fkkn;
        }

        if ($key != Null) {
            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
            $this->condition_values[] = $key . "%";
            $this->condition_values[] = strtolower($key) . "%";
            if ($key == "A") {
                $this->conditions[] = 'e.last_name NOT LIKE "ä%"';
                $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "ö%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Ä%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Ö%"';
            }
        }
        $this->order_by = array('LOWER(e.last_name) collate utf8_bin', 'LOWER(e.first_name) collate utf8_bin');
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $emp_names = $this->query_fetch();
        return $emp_names;
    }

    function get_employees_not_signed_in($month, $year) {

        $this->sql_query = "SELECT distinct e.username, CONCAT(e.last_name,' ',e.first_name) AS emp_name,e.email, e.status FROM `employee` as `e`
                            INNER JOIN `timetable` as `t` ON e.username like t.employee AND MONTH(t.date) = $month AND YEAR(t.date) = $year 
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $month AND YEAR(r.date) = $year 
                            WHERE r.employee IS NULL AND e.email IS NOT NULL AND e.email !=''";
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_contract_hour_of_a_date($empl, $date) {
        $company = new company();
        $contract = new contract();

        $this->tables = array('employee_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fulltime');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', '?', 'date_from', 'date_to'));
        $this->condition_values = array($empl, $date);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            $contract_hours = $data[0]['hour'];
            if ($contract_hours == 0.00)
                return 0.00;

            $working_days = $contract->get_working_days($data[0]['date_from'], $data[0]['date_to']);
            $diff = $this->date_difference($data[0]['date_from'], $data[0]['date_to']);
            $tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
            if ($data[0]['fulltime'] == 1)
                $contract_hours = ( $working_days != 0 ? (($contract_hours / $working_days) * 5 ) : 0);
            else
                $contract_hours = number_format($contract_hours / $tot_week, 1);

            return $contract_hours;
        }else {
            $company_detail = $company->get_company_detail($_SESSION['company_id']);
            return $company_detail['weekly_hour'];
        }
    }

    function employee_total_work_hours($employee, $date_type, $date, $normal_oncall = NULL, $slot_types = NULL, $status=1) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting employee total work hours
         * @param: $date_type - type of passed date value
         *          possible values: year_week, year_month, date_between, date
         *          data-type: string
         * @param: $date - date of timetable data
         *          possible values format: (Y|W)year_week , (Y|m)year_month, (yyyy-mm-dd|yyyy-mm-dd)date_between, (yyyy-mm-dd)date
         *          data-type: string
         * @param: $normal_oncall - indicates which of the slot types are to be processed
         *          possible values: 0 - normal, 3-oncall, NULL-both
         *          data-type: integer | NULL
         */
        //print_r(func_get_args());
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();

        $possible_date_formats = array('year_week', 'year_month', 'date_between', 'date');
        $total_work_hours = 0.00;
        if ($employee == '' || !in_array($date_type, $possible_date_formats))
            return $total_work_hours;

        $process_slot_types = '';
        if ($normal_oncall === 0)
            $process_slot_types = '0,1,2,4,5,6,7,8,10,15';
        else if ($normal_oncall == 3)
            $process_slot_types = '3,9,14';
        else
            $process_slot_types = '0,1,2,3,4,5,6,7,8,9,10,14,15';
        
        if($slot_types)
            $process_slot_types = $slot_types;

        $date_from = $date_to = NULL;

        $this->flush();
        if ($date_type == 'year_week') {
            //$date is in Y|W format
            $week_data = explode('|', $date);
            $year = $week_data[0];
            $week_no = sprintf("%02d", $week_data[1]);
            $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
            $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        } else if ($date_type == 'year_month') {
            //$date is in Y|m format
            $date_params = explode('|', $date);
            $year = $date_params[0];
            $month_no = sprintf("%02d", $date_params[1]);
            $first_day_of_month = $year . '-' . $month_no . '-01';
            $date_from = date("Y-m-01", strtotime($first_day_of_month));
            $date_to = date("Y-m-t", strtotime($first_day_of_month));
        } else if ($date_type == 'date_between') {
            //$date is in yyyy-mm-dd|yyyy-mm-dd format
            $date_params = explode('|', $date);
            $date_from = $date_params[0];
            $date_to = $date_params[1];
        } else if ($date_type == 'date') {
            //$date is in yyyy-mm-dd format
            $date_from = $date;
            $date_to = $date;
        }

        if($date_from != '' && $date_to != ''){
            if($date_from <= $boundary_date && $date_to > $boundary_date){
                $this->flush();
                $this->sql_query = 'SELECT ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time 
                FROM (
                    ( SELECT time_from, time_to FROM `timetable` WHERE employee = ? AND (date BETWEEN ? AND ?) AND (status IN ( '.$status.' )) AND (type IN ( '.$process_slot_types.' )) ) 
                    UNION 
                    ( SELECT time_from, time_to FROM `backup_timetable` WHERE employee = ? AND (date BETWEEN ? AND ?) AND (status IN ( '.$status.' )) AND (type IN ( '.$process_slot_types.' )) ) 
                ) As sample1';
                $this->condition_values = array($employee, $date_from, $date_to, $employee, $date_from, $date_to);
                //echo $this->sql_query;
                $work_time = $this->query_fetch();
                $total_work_hours = (empty($work_time) || $work_time[0]['total_time'] == '') ? 0.00 : $work_time[0]['total_time'];
            }else {
                $timetable = $date_from <= $boundary_date && $date_to <= $boundary_date ? 'backup_timetable' : 'timetable';
                $this->flush();
                $this->tables = array($timetable);
                $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
                $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', $status), array('IN', 'type', $process_slot_types));
                $this->condition_values = array($employee, $date_from, $date_to);
                $this->query_generate();
                $work_time = $this->query_fetch();
                $total_work_hours = (empty($work_time) || $work_time[0]['total_time'] == '') ? 0.00 : $work_time[0]['total_time'];
            }
        }

        return $total_work_hours;
    }

    function team_members_with_tt_connected_employees($cust_username, $year, $month = NULL, $key = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: merging team members with connected employees of customer previously(timetable)
         * used in: employee detailed report listing
         */
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        if ($month == '') $month = NULL;
        if($month == NULL){
            $cmp_date_start   = date('Y-m-d', strtotime("$year-01-01"));
            $cmp_date_end     = date('Y-m-d', strtotime("$year-12-31"));
        }
        else{
            $cmp_date_start   = date('Y-m-d', strtotime("$year-$month-01"));
            $cmp_date_end     = date('Y-m-t', strtotime("$year-$month-01"));
        }

        $this->flush();
        $this->tables = array('team');
        $this->fields = array('DISTINCT employee AS employee');
        $this->conditions = array('customer = ?');
        $this->query_generate();
        $emp_query = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name');
        if ($key == Null) {
            $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1');
            $this->condition_values = array($cust_username);
        } else {
            if ($key == "A")
                $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"', 'last_name NOT LIKE "å%"', 'last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"', 'last_name NOT LIKE "Å%"', 'last_name NOT LIKE "Ö%"');
            else
                $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));

            $this->condition_values = array($cust_username, $key . "%", strtolower($key) . "%");
        }
       // $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
        $this->query_generate();
        $team_members_query = $this->sql_query;
        //---------------------------------------
        if($cmp_date_start <= $boundary_date && $cmp_date_end > $boundary_date){ // union two table
            $this->tables = array('timetable` as `t', 'employee` as `e');
            $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 't.employee = e.username', 't.customer LIKE ?', 'YEAR(t.date) = ?', 't.employee IS NOT NULL', 't.employee != ?');
            $this->condition_values[] = $cust_username;
            $this->condition_values[] = $year;
            $this->condition_values[] = '';

            if ($month != Null) {
                $this->conditions[] = 'MONTH(t.date) = ?';
                $this->condition_values[] = $month;
            }
            if ($key != Null) {
                $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                $this->condition_values[] = $key . "%";
                $this->condition_values[] = strtolower($key) . "%";
                if ($key == "A") {
                    $this->conditions[] = 'e.last_name NOT LIKE "ä%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "ö%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "Ä%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "Å%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "Ö%"';
                }
            }
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $conditions       = array();            
            $this->tables     = array('backup_timetable` as `t', 'employee` as `e');
            $this->fields     = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 't.employee = e.username', 't.customer LIKE ?', 'YEAR(t.date) = ?', 't.employee IS NOT NULL', 't.employee != ?');
            $conditions[]     = $cust_username;
            $conditions[]     = $year;
            $conditions[]     = '';

            if ($month != Null) {
                $conditions[] = 'MONTH(t.date) = ?';
                $conditions[] = $month;
            }
            if ($key != Null) {
                $conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                $conditions[] = $key . "%";
                $conditions[] = strtolower($key) . "%";
                if ($key == "A") {
                    $conditions[] = 'e.last_name NOT LIKE "ä%"';
                    $conditions[] = 'e.last_name NOT LIKE "å%"';
                    $conditions[] = 'e.last_name NOT LIKE "å%"';
                    $conditions[] = 'e.last_name NOT LIKE "ö%"';
                    $conditions[] = 'e.last_name NOT LIKE "Ä%"';
                    $conditions[] = 'e.last_name NOT LIKE "Å%"';
                    $conditions[] = 'e.last_name NOT LIKE "Ö%"';
                }
            }
            $this->query_generate();
            $backup_table_data = $this->sql_query;
            $this->condition_values = array_merge($this->condition_values, $conditions);

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
            $time_table_members_query = $this->sql_query;
            $this->sql_query = '( ' . $team_members_query . ' )' . ' UNION ' . '( ' . $time_table_members_query . ' ) ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
        }
        else if($cmp_date_start <= $boundary_date && $cmp_date_end <= $boundary_date){
            $this->tables = array('backup_timetable` as `t', 'employee` as `e');
            $proceed = TRUE;
        }
        else if($cmp_date_start > $boundary_date && $cmp_date_end > $boundary_date){
            $this->tables = array('timetable` as `t', 'employee` as `e');
            $proceed = TRUE;
        }
        if($proceed == true){
            $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 't.employee = e.username', 't.customer LIKE ?', 'YEAR(t.date) = ?', 't.employee IS NOT NULL', 't.employee != ?');
            $this->condition_values[] = $cust_username;
            $this->condition_values[] = $year;
            $this->condition_values[] = '';

            if ($month != Null) {
                $this->conditions[] = 'MONTH(t.date) = ?';
                $this->condition_values[] = $month;
            }
            if ($key != Null) {
                $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
                $this->condition_values[] = $key . "%";
                $this->condition_values[] = strtolower($key) . "%";
                if ($key == "A") {
                    $this->conditions[] = 'e.last_name NOT LIKE "ä%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "ö%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "Ä%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "Å%"';
                    $this->conditions[] = 'e.last_name NOT LIKE "Ö%"';
                }
            }
           // $this->order_by = array('LOWER(e.last_name) collate utf8_bin', 'LOWER(e.first_name) collate utf8_bin');
            $this->query_generate();
            $time_table_members_query = $this->sql_query;

            $this->sql_query = 'SELECT * FROM (( ' . $team_members_query . ' )' . ' UNION ' . '( ' . $time_table_members_query . ' )) As sample1 ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
        }
        $data = $this->query_fetch();
        return $data;
    }

    function team_members_with_tt_connected_employees_btwn_date_range($cust_username, $start_date, $end_date, $key = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: merging team members with connected employees of customer previously(timetable) using start and end date
         * used in: employee detailed report listing
         */
        $this->flush();
        $this->tables = array('team');
        $this->fields = array('DISTINCT employee AS employee');
        $this->conditions = array('customer = ?');
        $this->query_generate();
        $emp_query = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name');
        if ($key == Null) {

            $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1');
            $this->condition_values = array($cust_username);
        } else {
            if ($key == "A")
                $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"', 'last_name NOT LIKE "å%"', 'last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"', 'last_name NOT LIKE "Å%"', 'last_name NOT LIKE "Ö%"');
            else
                $this->conditions = array('AND', array('IN', 'username', $emp_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));

            $this->condition_values = array($cust_username, $key . "%", strtolower($key) . "%");
        }
       // $this->order_by = array('LOWER(last_name) collate utf8_bin', 'LOWER(first_name) collate utf8_bin');
        $this->query_generate();
        $team_members_query = $this->sql_query;

        //---------------------------------------
        $this->tables = array('timetable` as `t', 'employee` as `e');
        $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
        $this->conditions = array('AND', 't.employee = e.username', 't.customer LIKE ?', array('BETWEEN', 't.date', '?', '?'), 't.employee IS NOT NULL', 't.employee != ?');
        $this->condition_values[] = $cust_username;
        $this->condition_values[] = $start_date;
        $this->condition_values[] = $end_date;
        $this->condition_values[] = '';

        if ($key != Null) {
            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
            $this->condition_values[] = $key . "%";
            $this->condition_values[] = strtolower($key) . "%";
            if ($key == "A") {
                $this->conditions[] = 'e.last_name NOT LIKE "ä%"';
                $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "ö%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Ä%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Ö%"';
            }
        }
       // $this->order_by = array('LOWER(e.last_name) collate utf8_bin', 'LOWER(e.first_name) collate utf8_bin');
        $this->query_generate();
        $time_table_members_query = $this->sql_query;

        $this->sql_query = '( ' . $team_members_query . ' )' . ' UNION ' . '( ' . $time_table_members_query . ' ) ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
        $data = $this->query_fetch();
        return $data;
    }

    function get_customers_with_tt_connected_previous($emp_username, $year, $month = NULL, $key = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: merging team members with connected employees of customer previously(timetable)
         * used in: employee detailed report listing
         */
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        if ($month == '') $month = NULL;
        if($month == NULL){
            $cmp_date_start   = date('Y-m-d', strtotime("$year-01-01"));
            $cmp_date_end     = date('Y-m-d', strtotime("$year-12-31"));
        }
        else{
            $cmp_date_start   = date('Y-m-d', strtotime("$year-$month-01"));
            $cmp_date_end     = date('Y-m-t', strtotime("$year-$month-01"));
        }

        $this->flush();
        $this->tables = array('team');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('employee = ?');
        $this->query_generate();
        $cust_query = $this->sql_query;

        $customer_query_extra = '';
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6 && $emp_username != $_SESSION['user_id']){
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer');
            $this->conditions = array('AND', 'employee = ?', 'role = ?');
            $this->query_generate();
            $customer_query_extra = $this->sql_query;
        }
        //$customer_query_extra = '';
        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        if ($key == Null) {

            $this->conditions = array('AND', array('IN', 'username', $cust_query), 'status = 1');
            $this->condition_values = array($emp_username);
            if($customer_query_extra){
                $this->conditions[] =array('IN', 'username', $customer_query_extra);
                $this->condition_values[] = $_SESSION['user_id'];
                $this->condition_values[] = $_SESSION['user_role'];
            }
        } else {
            if ($key == "A")
                $this->conditions = array('AND', array('IN', 'username', $cust_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"', 'last_name NOT LIKE "å%"', 'last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"', 'last_name NOT LIKE "Å%"', 'last_name NOT LIKE "Ö%"');
            else
                $this->conditions = array('AND', array('IN', 'username', $cust_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));

            $this->condition_values = array($emp_username, $key . "%", strtolower($key) . "%");
            if($customer_query_extra){
                $this->conditions[] =array('IN', 'username', $customer_query_extra);
                $this->condition_values[] = $_SESSION['user_id'];
                $this->condition_values[] = $_SESSION['user_role'];
            }
        }
        $this->query_generate();
        $customers_query_in_team = $this->sql_query;
        //---------------------------------------
        if($cmp_date_start <= $boundary_date && $cmp_date_end > $boundary_date){ // union two table
            $this->tables             = array('timetable` as `t', 'customer` as `c');
            $this->fields             = array('DISTINCT c.username', 'c.first_name', 'c.last_name');
            $this->conditions         = array('AND', 't.customer = c.username', 't.employee LIKE ?', 'YEAR(t.date) = ?', 't.customer IS NOT NULL', 't.customer != ?');
            $this->condition_values[] = $emp_username;
            $this->condition_values[] = $year;
            $this->condition_values[] = '';

            if ($month != Null) {
                $this->conditions[]       = 'MONTH(t.date) = ?';
                $this->condition_values[] = $month;
            }
            if($customer_query_extra){
                $this->conditions[]       =array('IN', 't.customer', $customer_query_extra);
                $this->condition_values[] = $_SESSION['user_id'];
                $this->condition_values[] = $_SESSION['user_role'];
            }
            if ($key != Null) {
                $this->conditions[]       = array('OR', 'c.last_name LIKE ?', 'c.last_name LIKE ?');
                $this->condition_values[] = $key . "%";
                $this->condition_values[] = strtolower($key) . "%";
                if ($key == "A") {
                    $this->conditions[] = 'c.last_name NOT LIKE "ä%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "ö%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Ä%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Ö%"';
                }
            }
            $this->query_generate();
            $real_table_data = $this->sql_query;


            $this->tables             = array('backup_timetable` as `t', 'customer` as `c');
            $this->fields             = array('DISTINCT c.username', 'c.first_name', 'c.last_name');
            $this->conditions         = array('AND', 't.customer = c.username', 't.employee LIKE ?', 'YEAR(t.date) = ?', 't.customer IS NOT NULL', 't.customer != ?');
            $this->condition_values[] = $emp_username;
            $this->condition_values[] = $year;
            $this->condition_values[] = '';

            if ($month != Null) {
                $this->conditions[]       = 'MONTH(t.date) = ?';
                $this->condition_values[] = $month;
            }
            if($customer_query_extra){
                $this->conditions[]       =array('IN', 't.customer', $customer_query_extra);
                $this->condition_values[] = $_SESSION['user_id'];
                $this->condition_values[] = $_SESSION['user_role'];
            }
            if ($key != Null) {
                $this->conditions[]       = array('OR', 'c.last_name LIKE ?', 'c.last_name LIKE ?');
                $this->condition_values[] = $key . "%";
                $this->condition_values[] = strtolower($key) . "%";
                if ($key == "A") {
                    $this->conditions[] = 'c.last_name NOT LIKE "ä%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "ö%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Ä%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Ö%"';
                }
            }
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query              = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
            $customers_query_in_timetable = $this->sql_query;
            $this->sql_query              = '( ' . $customers_query_in_team . ' )' . ' UNION ' . '( ' . $customers_query_in_timetable . ' ) ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
        }
        else if($cmp_date_start <= $boundary_date && $cmp_date_end <= $boundary_date){
            $this->tables = array('backup_timetable` as `t', 'customer` as `c');
            $proceed = TRUE;
        }
        else if($cmp_date_start > $boundary_date && $cmp_date_end > $boundary_date){
            $this->tables = array('timetable` as `t', 'customer` as `c');
            $proceed = TRUE;
        }
        if($proceed == TRUE){
            $this->fields = array('DISTINCT c.username', 'c.first_name', 'c.last_name');
            $this->conditions = array('AND', 't.customer = c.username', 't.employee LIKE ?', 'YEAR(t.date) = ?', 't.customer IS NOT NULL', 't.customer != ?');
            $this->condition_values[] = $emp_username;
            $this->condition_values[] = $year;
            $this->condition_values[] = '';

            if ($month != Null) {
                $this->conditions[] = 'MONTH(t.date) = ?';
                $this->condition_values[] = $month;
            }
            if($customer_query_extra){
                $this->conditions[] =array('IN', 't.customer', $customer_query_extra);
                $this->condition_values[] = $_SESSION['user_id'];
                $this->condition_values[] = $_SESSION['user_role'];
            }
            if ($key != Null) {
                $this->conditions[] = array('OR', 'c.last_name LIKE ?', 'c.last_name LIKE ?');
                $this->condition_values[] = $key . "%";
                $this->condition_values[] = strtolower($key) . "%";
                if ($key == "A") {
                    $this->conditions[] = 'c.last_name NOT LIKE "ä%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "ö%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Ä%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Å%"';
                    $this->conditions[] = 'c.last_name NOT LIKE "Ö%"';
                }
            }
            $this->query_generate();
            $customers_query_in_timetable = $this->sql_query;

            $this->sql_query = '( ' . $customers_query_in_team . ' )' . ' UNION ' . '( ' . $customers_query_in_timetable . ' ) ORDER BY LOWER(last_name) collate utf8_bin, LOWER(first_name) collate utf8_bin;';
        }

        $data = $this->query_fetch();
         
        return $data;
    }

    function get_employee_total_working_hours_by_param($empl, $date, $ids = array(), $multiple = array(), $exception_ids = array(), $customer = NULL, $include_monthly_oncall = TRUE, $inlcude_weekly_oncall = FALSE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting employee total working hours either by weekly or monthly ($work_period)
         * @param: $empl - employee_uname
         * @param: $date - date of timetable data (yyyy-mm-dd format)
         * @param: $ids - to include id work hours in this total work hours
         *          data-type: array() | string
         * @param: $multiple - multiple time_slots to manually add with total work hours
         *          format : array('time_from' => ?, 'time_to' => ?, 'type' => ?) (type is either 0|3)
         *          data-type: array()
         * @param: $exception_ids - to exclude ids  of work hours from total work hours
         *          data-type: array()
         * @return: array('weekly_normal' => ?, 'monthly_oncall' => ?);
         */
//        $possible_work_period_formats = array('weekly', 'monthly');
        $return_sum = array('weekly_normal' => 0.00, 'monthly_oncall' => 0.00, 'weekly_oncall' => 0.00);
        $process_normal_slot_types = '0,1,2,4,5,6,7,8,10,15';
        $process_oncall_slot_types = '3,9,14';
        $process_normal_slot_types_array = explode(',', $process_normal_slot_types);
        $process_oncall_slot_types_array = explode(',', $process_oncall_slot_types);
        $additional_slot_append_details = array();
//        if($empl == '' || !in_array($work_period, $possible_work_period_formats)) return $sum;

        /* if($possible_work_period_formats == 'weekly'){
          $week_num = date("W", strtotime($date));
          $this_year = date("Y", strtotime($date));
          $process_date_from = date("Y-m-d", strtotime($this_year . 'W' . $week_num . 1));
          $process_date_to = date("Y-m-d", strtotime($this_year . 'W' . $week_num . 7));
          } else {
          $process_date_from = date("Y-m-01", strtotime($date));
          $process_date_to = date("Y-m-t", strtotime($date));
          } */

        $this->flush();
        if (is_array($ids) && !empty($ids)) {
            $additional_slot_append_details = $this->get_multiple_slot_details($ids);
        } else if (!is_array($ids) && $ids != NULL && $ids != '') {
            $ids = explode(",", $ids);
            $additional_slot_append_details = $this->get_multiple_slot_details($ids);
        }
        else
            $ids = array();     // for following operations

            
//----------- calculate weekly normal hours--------------------------------
        $week_num = date("W", strtotime($date));
        $this_year = date("Y", strtotime($date));
        $weekly_date_from = date("Y-m-d", strtotime($this_year . 'W' . $week_num . 1));
        $weekly_date_to = date("Y-m-d", strtotime($this_year . 'W' . $week_num . 7));

        $this->flush();
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to', 'date');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1', array('IN', 'type', $process_normal_slot_types));
        $this->condition_values = array($empl, $weekly_date_from, $weekly_date_to);

        if (!empty($exception_ids)) {
            $exception_id_string = '\'' . implode('\', \'', $exception_ids) . '\'';
            $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
        }

        if (!empty($ids)) {
            $exception_id_string = '\'' . implode('\', \'', $ids) . '\'';
            // $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
            $this->conditions[] = array('IN', 'id', $exception_id_string);
        }

        if ($customer !== NULL) {
            $this->conditions[] = 'customer = ?';
            $this->condition_values[] = $customer;
        }

        $this->query_generate();
        $normal_datas = $this->query_fetch();
        if (!empty($normal_datas)) {
            foreach ($normal_datas as $slot_data) {
                $return_sum['weekly_normal'] = $this->time_sum($return_sum['weekly_normal'], $this->time_difference($slot_data['time_from'], $slot_data['time_to']));
            }
        }

        if (!empty($additional_slot_append_details)) {
            foreach ($additional_slot_append_details as $slot_det) {
                if (in_array($slot_det['type'], $process_normal_slot_types_array))
                    $return_sum['weekly_normal'] = $this->time_sum($return_sum['weekly_normal'], $this->time_difference($slot_det['time_from'], $slot_det['time_to']));
            }
        }

        if (!empty($multiple)) {
            //array('time_from' => ?, 'time_to' => ?, 'type' => ?) (type is either 0|3)
            foreach ($multiple as $slot_data) {
                if (isset($slot_data['type']) && in_array($slot_data['type'], $process_normal_slot_types_array))
                    $return_sum['weekly_normal'] = $this->time_sum($return_sum['weekly_normal'], $this->time_difference($slot_data['time_from'], $slot_data['time_to']));
            }
        }

        if($inlcude_weekly_oncall){
            $this->flush();
            $this->tables = array('timetable');
            $this->fields = array('id', 'time_from', 'time_to', 'date');
            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1', array('IN', 'type', $process_oncall_slot_types));
            $this->condition_values = array($empl, $weekly_date_from, $weekly_date_to);

            if (!empty($exception_ids)) {
                $exception_id_string = '\'' . implode('\', \'', $exception_ids) . '\'';
                $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
            }

            if (!empty($ids)) {
                $exception_id_string = '\'' . implode('\', \'', $ids) . '\'';
                // $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
                $this->conditions[] = array('IN', 'id', $exception_id_string);
            }

            if ($customer !== NULL) {
                $this->conditions[] = 'customer = ?';
                $this->condition_values[] = $customer;
            }


            $this->query_generate();
            $oncall_datas = $this->query_fetch();
            if (!empty($oncall_datas)) {
                foreach ($oncall_datas as $slot_data) {
                    $return_sum['weekly_oncall'] = $this->time_sum($return_sum['weekly_oncall'], $this->time_difference($slot_data['time_from'], $slot_data['time_to']));
                }
            }

            if (!empty($additional_slot_append_details)) {
                foreach ($additional_slot_append_details as $slot_det) {
                    if (in_array($slot_det['type'], $process_oncall_slot_types_array))
                        $return_sum['weekly_oncall'] = $this->time_sum($return_sum['weekly_oncall'], $this->time_difference($slot_det['time_from'], $slot_det['time_to']));
                }
            }

            if (!empty($multiple)) {
                //array('time_from' => ?, 'time_to' => ?, 'type' => ?) (type is either 0|3)
                foreach ($multiple as $slot_data) {
                    if (isset($slot_data['type']) && in_array($slot_data['type'], $process_oncall_slot_types_array))
                        $return_sum['weekly_oncall'] = $this->time_sum($return_sum['weekly_oncall'], $this->time_difference($slot_data['time_from'], $slot_data['time_to']));
                }
            }
        }

        if($include_monthly_oncall){
            //----------- calculate Monthly oncall hours--------------------------------
            $montly_date_from = date("Y-m-01", strtotime($date));
            $montly_date_to = date("Y-m-t", strtotime($date));

            $this->flush();
            $this->tables = array('timetable');
            $this->fields = array('id', 'time_from', 'time_to', 'date');
            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'status = 1', array('IN', 'type', $process_oncall_slot_types));
            $this->condition_values = array($empl, $montly_date_from, $montly_date_to);

            if (!empty($exception_ids)) {
                $exception_id_string = '\'' . implode('\', \'', $exception_ids) . '\'';
                $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
            }

            if (!empty($ids)) {
                $exception_id_string = '\'' . implode('\', \'', $ids) . '\'';
                // $this->conditions[] = array('NOT IN', 'id', $exception_id_string);
                $this->conditions[] = array('IN', 'id', $exception_id_string);
            }
            
            if ($customer !== NULL) {
                $this->conditions[] = 'customer = ?';
                $this->condition_values[] = $customer;
            }

            $this->query_generate();
            $oncall_datas = $this->query_fetch();
            if (!empty($oncall_datas)) {
                foreach ($oncall_datas as $slot_data) {
                    $return_sum['monthly_oncall'] = $this->time_sum($return_sum['monthly_oncall'], $this->time_difference($slot_data['time_from'], $slot_data['time_to']));
                }
            }

            if (!empty($additional_slot_append_details)) {
                foreach ($additional_slot_append_details as $slot_det) {
                    if (in_array($slot_det['type'], $process_oncall_slot_types_array))
                        $return_sum['monthly_oncall'] = $this->time_sum($return_sum['monthly_oncall'], $this->time_difference($slot_det['time_from'], $slot_det['time_to']));
                }
            }

            if (!empty($multiple)) {
                //array('time_from' => ?, 'time_to' => ?, 'type' => ?) (type is either 0|3)
                foreach ($multiple as $slot_data) {
                    if (isset($slot_data['type']) && in_array($slot_data['type'], $process_oncall_slot_types_array))
                        $return_sum['monthly_oncall'] = $this->time_sum($return_sum['monthly_oncall'], $this->time_difference($slot_data['time_from'], $slot_data['time_to']));
                }
            }
        }

        return $return_sum;
    }

    function get_employees_who_have_employee($year, $month = NULL, $employee = NULL, $key = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: get emplooyees who have time slots of the year/month
         * used in: employee monthly report listing
         */
        $this->flush();
        $employee = $employee != '' ? $employee : NULL;
        $this->tables = array('timetable` as `t', 'employee` as `e');
        $this->fields = array('DISTINCT e.username', 'e.first_name', 'e.last_name');
        $this->conditions = array('AND', 't.employee = e.username', 'YEAR(t.date) = ?');
        $this->condition_values[] = $year;

        if ($employee != NULL) {
            $this->conditions[] = 't.employee = ?';
            $this->condition_values[] = $employee;
        } else {
            $this->conditions[] = 't.employee IS NOT NULL';
            $this->conditions[] = 't.employee != ?';
            $this->condition_values[] = '';
        }

        if ($month != NULL) {
            $this->conditions[] = 'MONTH(t.date) = ?';
            $this->condition_values[] = $month;
        }
        if ($key != NULL) {
            $this->conditions[] = array('OR', 'e.last_name LIKE ?', 'e.last_name LIKE ?');
            $this->condition_values[] = $key . "%";
            $this->condition_values[] = strtolower($key) . "%";
            if ($key == "A") {
                $this->conditions[] = 'e.last_name NOT LIKE "ä%"';
                $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "ö%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Ä%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Å%"';
                $this->conditions[] = 'e.last_name NOT LIKE "Ö%"';
            }
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function check_login_employee_to_access_employee($check_user) {
        if ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6) {
            return TRUE;
        } else if ($_SESSION['user_role'] == 3) {
            if ($_SESSION['user_id'] == $check_user)
                return TRUE;
            else
                return FALSE;
        }
        elseif ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            if ($_SESSION['user_id'] == $check_user)
                return TRUE;
            else {

                $this->sql_query = "SELECT t1.employee FROM `team` t1 INNER JOIN team t2 
                                ON t1.customer LIKE  t2.customer WHERE t2.employee='" . $_SESSION['user_id'] . "' AND t2.role='" . $_SESSION['user_role'] . "' 
                                    AND t1.employee='" . $check_user . "'";
                $datas = $this->query_fetch();
                if (empty($datas))
                    return FALSE;
                else
                    return TRUE;
            }
        }
    }

    function get_available_users_for_PM($customer, $time_from, $time_to, $date, $except_tt_id = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all available employees for a specific period
         * param $except_tt_id will excepting timetable ids in this query
         * created date: 2014-01-28
         */
        $cur_date = strtotime($date . ' 00:00:00');
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        $tl_customer_role = $_SESSION['user_role'];
        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
            $this->tables = array('team');
            $this->fields = array('role');
            $this->conditions = array('AND', 'customer = ?', 'employee = ?');
            $this->condition_values = array($customer, $_SESSION['user_id']);
            $this->query_generate();
            $data = $this->query_fetch(2);
            $tl_customer_role = $data[0]['role'];
        }
        if ($_SESSION['user_role'] == 3 || $tl_customer_role == 3) {
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer' AND tm.employee='" . $_SESSION['user_id'] . "'
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.customer ='$customer' 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND " . ($except_tt_id != NULL ? "t.id != $except_tt_id" : '1') . " 
                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL ".
                            'ORDER BY '.($_SESSION['company_sort_by'] == 1 ? 'LOWER(e.first_name) collate utf8_bin, LOWER(e.last_name) collate utf8_bin': 'LOWER(e.last_name) collate utf8_bin, LOWER(e.first_name) collate utf8_bin');
        } else {
            $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND e.status=1 AND tm.customer='$customer'
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.customer ='$customer' 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND ((l.time_from >= " . (float) $time_from . " AND l.time_from < " . (float) $time_to . ") OR (l.time_to > " . (float) $time_from . " AND l.time_to <= " . (float) $time_to . ") OR (l.time_from < " . (float) $time_from . " AND l.time_to > " . (float) $time_to . ")) AND l.date='$date' AND l.status!=2
                            LEFT JOIN  `timetable` as `t` ON t.employee like e.username AND ((t.time_from >= " . (float) $time_from . " AND t.time_from < " . (float) $time_to . ") OR (t.time_to > " . (float) $time_from . " AND t.time_to <= " . (float) $time_to . ") OR (t.time_from < " . (float) $time_from . " AND t.time_to > " . (float) $time_to . ")) AND t.date='$date' AND t.employee!='' AND t.status!=2 AND " . ($except_tt_id != NULL ? "t.id != $except_tt_id" : '1') . " 
                            where t.employee IS NULL AND r.employee IS NULL  AND l.employee IS NULL ".
                            'ORDER BY '.($_SESSION['company_sort_by'] == 1 ? 'LOWER(e.first_name) collate utf8_bin, LOWER(e.last_name) collate utf8_bin': 'LOWER(e.last_name) collate utf8_bin, LOWER(e.first_name) collate utf8_bin');
        }

//        if($except_tt_id != NULL){
//            $this->sql_query .= " AND t.id != $except_tt_id";
//        }
//        echo $this->sql_query;
        $datas = $this->query_fetch();

        $employees = array();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $employees[] = array('username' => $data['username'], 'name' => $data['last_name'] . ' ' . $data['first_name'], 'code' => $data['code'], 'mobile' => $data['mobile']);
            }
        }
        return $employees;
    }

    function is_ob_on_for_a_employee($employee) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: check is OB 'on' for a perticular employee
         * @return TRUE - If is ON, FALSE - if is OFF
         */
        $obj_company = new company();
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        if ($company_details['inconvenient_on'] == 0)
            return FALSE;

        $employee_detail = $this->employee_detail_main($employee);
        return ($employee_detail[0]['inconvenient_on'] == 0 && $employee_detail[0]['inconvenient_on'] != '') ? FALSE : TRUE;
    }

    function check_slot_leave($emp, $cust, $date_from, $date_to, $allowed_leave_types = array()) {
        $obj_general = new general();
        $boundary_date = $obj_general->get_boundary_date();

        $employee_data = array();
        if($date_from <= $boundary_date && $date_to > $boundary_date){

            $query_1_action = $this->check_slot_leave_process($emp, $cust, $date_from, $date_to, $allowed_leave_types, 1);
            $query_2_action = $this->check_slot_leave_process($emp, $cust, $date_from, $date_to, $allowed_leave_types, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                // $this->sql_query = '( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' )';
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                // echo "<pre>".print_r($this->condition_values, 1)."</pre>";
                $employee_data = $this->query_fetch();
            }

        }
        else if($date_from <= $boundary_date && $date_to <= $boundary_date){
            $query_1_action = $this->check_slot_leave_process($emp, $cust, $date_from, $date_to, $allowed_leave_types, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $employee_data = $this->query_fetch();
            }
        }
        else if($date_from > $boundary_date && $date_to > $boundary_date){
            $query_1_action = $this->check_slot_leave_process($emp, $cust, $date_from, $date_to, $allowed_leave_types, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $employee_data = $this->query_fetch();
            }
        }

        return $employee_data ? TRUE : FALSE;
    }

    function check_slot_leave_process($emp, $cust, $date_from, $date_to, $allowed_leave_types = array(), $mode = 1) {

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.employee', 't.customer');
        $this->conditions = array('AND', 't.status = 2', 't.date = l.date', 't.employee = l.employee', 't.employee = ?', 't.customer = ?', 'l.status = 1');
        $this->condition_values = array($emp, $cust);

        if ($date_from != '0000-00-00' && $date_to != '0000-00-00') {
            $this->conditions[] = array('BETWEEN', 't.date', '?', '?');
            $this->condition_values = array_merge($this->condition_values, array($date_from, $date_to));
        } elseif ($date_from != '0000-00-00' && $date_to = '0000-00-00') {
            $this->conditions[] = 't.date >= ?';
            $this->condition_values[] = $date_from;
        } elseif ($date_from == '0000-00-00' && $date_to != '0000-00-00') {
            $this->conditions[] = 't.date <= ?';
            $this->condition_values[] = $date_to;
        }
        
        if (!empty($allowed_leave_types))
                $this->conditions[] = array('IN', 'l.type', $allowed_leave_types);
        $this->query_generate();
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
        // $data = $this->query_fetch();
        // return $data ? TRUE : FALSE;
    }

    function customer_AL_GL_contract_exceed_receipients($customer_username) {

        $recipients = array();
        //getting administrator role
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username');
        $this->conditions = array('role = 1');
        $this->query_generate();
        $sql_query_admin_in = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_admin_in));
        $this->query_generate();
        $admin_datas = $this->query_fetch();

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

        $recipient_datas = array_merge($admin_datas, $team_leader_datas);

        //print_r($recipient_datas);
        if (!empty($recipient_datas)) {
            foreach ($recipient_datas as $recipient_data) {
                //getting notification privilege for email
                $this->tables = array('leave_notification');
                $this->fields = array('employee');
                $this->conditions = array('AND', 'employee = ?', array('OR', 'email LIKE ?', 'email LIKE ?'));
                $this->condition_values = array($recipient_data['username'], '%,11,%', '11,%');
                $this->query_generate();
                $data_notification = $this->query_fetch();
                $mail_notification = 0;
                if (!empty($data_notification)) {
                    $mail_notification = 1;
                }
                $recipients[] = array('username' => $recipient_data['username'], 'email' => $recipient_data['email'], 'mobile' => $recipient_data['mobile'], 'email_notification' => $mail_notification);
            }
            return (!empty($recipients) ? $recipients : array());
        }
        else
            return array();
    }

    function get_available_employees_for_selected_slots($slot_ids) {
        $dona = new dona();
        $slots_details = $dona->customer_employee_multi_slot_details($slot_ids);
        $employees_to_add = array();
        for ($i = 0; $i < count($slots_details); $i++) {
            if (!empty($employees_to_add)) {
                $available_users = $this->get_available_users($slots_details[$i]['customer'], $slots_details[$i]['time_from'], $slots_details[$i]['time_to'], $slots_details[$i]['date']);
//                $employees_to_add = array_uintersect($available_users, $employees_to_add,strcmp($available_users['username'], $employees_to_add['username']));
                $employees_to_add = $this->employee_intersect($available_users, $employees_to_add);
            } else {
                $employees_to_add = $this->get_available_users($slots_details[$i]['customer'], $slots_details[$i]['time_from'], $slots_details[$i]['time_to'], $slots_details[$i]['date']);
//                $employees_to_add = array_intersect($available_users, $employees_to_add);
            }
        }
        return $employees_to_add;
    }

    function employee_intersect($new_employees, $old_employees) {
        $temp_array = array();
        for ($i = 0; $i < count($new_employees); $i++) {
            for ($j = 0; $j < count($old_employees); $j++) {
                if ($new_employees[$i]['username'] == $old_employees[$j]['username'])
                    $temp_array[] = $new_employees[$i];
            }
        }
        return $temp_array;
    }

    function check_is_inconvenient_slot_period($date, $customer, $time_from, $time_to, $set_error_session = TRUE) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: check inconvenient possibility if it is a oncall type slot
         * @return TRUE - If is a inconvenient period, FALSE - not a inconvenient period
         * @param $set_error_session, IF TRUE=>  IF slot period is not inconvenient period, it'll set an error message in session
         */
        require_once ('plugins/message.class.php');
        $msg = new message();

        $customer_inconvenient = $this->get_inconvenient_on_a_day_for_customer($date, $customer, 3);
        $is_inconvenient_period = FALSE;
        if (!empty($customer_inconvenient)) {
            foreach ($customer_inconvenient as $item => $inconv_timing) {
                if (((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to']) &&
                        ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])) {
                    $is_inconvenient_period = TRUE;
                }
            }
        }

        if (!$is_inconvenient_period) {
            if ($set_error_session) {
                $msg->set_message('fail', 'time_outside_oncall');
                $msg->set_message_exact('fail', $date . ' => ' . str_pad(sprintf('%.02f', (float) $time_from), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $time_to), 5, '0', STR_PAD_LEFT));
            }
            return FALSE;
        }
        else
            return TRUE;
    }
    
    function update_slot_details($slot_id, $slot_details = array()) {

        if(empty($slot_details)) return FALSE;
        
        $process_flag = TRUE;
        $old_slot_det = $this->customer_employee_slot_details($slot_id);
        if(empty($old_slot_det))
            $process_flag = FALSE;
        else if($old_slot_det['status'] == 2)   //restrict to edit leave slots
            $process_flag = FALSE;
        
        if($process_flag){
            $status = $old_slot_det['status'];
            if ($status != 3 && $slot_details['employee'] != '' && $slot_details['customer'] != '')
                $status = 1;
            else if($status != 3 && ($slot_details['employee'] == '' || $slot_details['customer'] == ''))
                $status = 0;

            $this->tables = array('timetable');
            $this->fields = array('customer', 'employee', 'date', 'time_from', 'time_to', 
                'fkkn', 'type', 'status');
            $this->field_values = array($slot_details['customer'], $slot_details['employee'], $slot_details['date'], $slot_details['time_from'], $slot_details['time_to'],
                $slot_details['fkkn'], $slot_details['type'], $status);
            
            if(array_key_exists('comment', $slot_details)){
                $this->fields[] = 'comment';
                $this->field_values[] = $slot_details['comment'];
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($slot_id);
            $process_flag = $this->query_update();
        }
        return $process_flag;
    }
    
    function delete_employee_team_customers($employee){
        if(trim($employee) == '') return FALSE;
        
        $this->flush();
        $this->tables = array('team');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        return $this->query_delete();
    }
    
    function add_team_customers($employee, $team_customers = array()){
        if(trim($employee) == '' || empty($team_customers)) return FALSE;
        
        $this->flush();
        $this->tables = array('team');
        $this->fields = array('customer', 'employee', 'role');
        $this->field_values = array();
        foreach($team_customers as $team_customer){
            $this->field_values[] = array($team_customer['customer'], $employee, $team_customer['role']);
        }
        return $this->query_insert();
    }
    
    function non_allocated_employees($year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

//        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        //getting all employees
        $employees = $this->employee_list();
//        echo "<pre>".print_r($employees, 1)."</pre>"; exit();

        $list_employees = array();
        foreach ($employees as $employee) {
            $list_employees[] = $employee['username'];
        }
        $filtered_employee_list = '\'' . implode('\' , \'', $list_employees) . '\'';
        $this->tables = array('timetable');
        $this->fields = array('MIN(DATE_FORMAT(date, \'%x|%v\'))');
        $this->conditions = array('AND', 'employee like t.employee', 'date <= ?', 'status != 2', array('OR', 'customer = ?', 'customer is NULL'));
        $this->query_generate();
        $sub_query = $this->sql_query;

        $this->tables = array('timetable` AS `t', 'employee` AS `e');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as total_hours', 't.employee as employee_id', '(' . $sub_query . ') AS first_date', 'concat(COALESCE(e.last_name, ""), " ", e.first_name) as employee_name', 'concat(e.first_name, " ", COALESCE(e.last_name, "")) as employee_name_ff', 'e.code as code');
        $this->conditions = array('AND', array('IN', 't.employee', $filtered_employee_list), 't.date <= ?', array('OR', 't.customer = ?', 't.customer is NULL'), 'e.username like t.employee', 't.status != 2');
//        $this->order_by = array('t.customer', 't.date');
        if ($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(' . $this->db_name . '.e.first_name) collate utf8_bin ASC');
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(' . $this->db_name . '.e.last_name) collate utf8_bin ASC');
        $this->group_by = array('t.employee');
        $this->condition_values = array($end_date, '', $end_date, '');
        $this->limit = 0;
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data : FALSE);
    }

    //flag=1 for trainee excluding
    function employee_weeks_shedule($employees, $year_week, $flag = 0) {

        $date_calc = new datecalc();
        $weeks = $date_calc->get_five_weeks($year_week);
        $week_shedules = array();
        foreach ($employees as $employee) {

            $week_datas = array();
            foreach ($weeks as $week) {

                $total_hours = $this->total_work_hours_for_employees_in_single_week($employee['username'], $week['year_week']);
                if ($flag == 0)
                    $allocated = $this->employee_timetable_week_time($employee['username'], $week['year_week']);
                else
                    $allocated = $this->employee_timetable_week_time_trainee($employee['username'], $week['year_week']);

//                $week_datas[] = array('week' => $week, 'contract' => $contract, 'allocation' => $allocated);
                $week_datas[] = array('week' => $week, 'total_hours' => $total_hours, 'allocation' => $allocated);
            }
            $week_shedules[] = array('employee' => $employee, 'week_datas' => $week_datas);
        }
        return $week_shedules;
    }
    
    function total_work_hours_for_employees_in_single_week($employee, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as total_hours');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1,0,3'));
        $this->condition_values = array($employee, $start_date, $end_date);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['total_hours'] != "" ? $data[0]['total_hours'] : 0;
    }
    
    //excluding trainee
    function employee_timetable_week_time_trainee($employee, $year_week, $fkkn = NULL) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));


        //getting time for the week sloat type include normal,travel,break
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'));
            $this->condition_values = array($employee, $date_from, $date_to, $fkkn);
        } else {
            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'));
            $this->condition_values = array($employee, $date_from, $date_to);
        }
        $this->query_generate();
        //echo $this->sql_query;
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $normal_time = $time_data['total_time'];

        //getting time for the week sloat type oncall
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), 'type = 3');
            $this->condition_values = array($employee, $date_from, $date_to, $fkkn);

            $this->query_generate();
            $data_time = $this->query_fetch();
            $time_data = $data_time[0];
            $oncall_time = 0;
            if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) {
                //$oncall_time = round(($time_data['total_time'] / 4), 2);
                $oncall_time = $time_data['total_time']; //edited by shaju full hour on oncall not 1/4th
            }

            $total_time = $normal_time + $oncall_time;
        } else {
            $total_time = $normal_time;
        }
//        return $total_time;
        return sprintf("%.02f", $total_time);
    }
    
    function check_timeslots_after_timestamp_in_the_month($this_employee, $this_customer, $month, $year, $current_time_stamp = NULL){
        if($current_time_stamp == NULL){
            $start_time = new DateTime;
            $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $current_time_stamp = $start_time->format('Y-m-d H:i:s');
//            $current_time_stamp = date('Y-m-d H:i:s');
        }
        $now_date = date('Y-m-d', strtotime($current_time_stamp));
        $now_time = date('H.i', strtotime($current_time_stamp));
        
        $this->tables = array('timetable');
//        $this->fields = array('*');
        $this->fields = array('count(id) as after_slots');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?','month(date) = ?', 'year(date) = ?', 'status = 1', array('OR', array('AND', 'date = ?', 'time_to > ?'), 'date > ?'));
        $this->condition_values = array($this_employee, $this_customer, $month, $year, $now_date, $now_time, $now_date);
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>18".print_r($this->condition_values, 1);
        $datas = $this->query_fetch();
//        echo "<pre>".print_r($datas, 1)."</pre>";
        return $datas[0]['after_slots'] == 0 ? FALSE : TRUE;
    }

    function check_report_signing_day($employee_username, $leave_date, $range_from, $range_to){
        $this->sql_query = "SELECT rs.id FROM report_signing rs INNER JOIN timetable t ON MONTH(rs.date)=".substr($leave_date, 5,2)." AND YEAR(rs.date) = ".substr($leave_date, 0,4)." AND rs.employee = '".$employee_username."' AND rs.customer = t.customer AND t.date='".$leave_date."' AND t.employee = '".$employee_username."' AND t.time_from < ".(float)$range_to." AND t.time_to > ".(float)$range_from;
        $datas = $this->query_fetch();
        if(empty($datas)){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    function check_report_signing_day_to_day($employee_username, $date_from, $date_to, $range_from, $range_to){
        $temp_date_from = substr($date_from, 0,8)."01";
        $temp_date_to = date('Y-m-t', strtotime($date_to));
        $this->sql_query = "SELECT rs.id FROM report_signing rs INNER JOIN timetable t ON rs.date BETWEEN '".$temp_date_from."' AND '".$temp_date_to."' AND rs.employee = '".$employee_username."' AND rs.customer = t.customer AND t.date BETWEEN '".$date_from."' AND '".$date_to."' AND t.employee = '".$employee_username."'";
        $datas = $this->query_fetch();
        if(empty($datas)){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function change_document_status($id,$value) {
        $this->tables = array('employee_attachment');
        $this->fields = array('status');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }
    function check_documnet_status($id){
        $this->tables = array('employee_attachment');
        $this->fields = array('status');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0]['status'];
        } else {
            return false;
        }
    }   
    function employee_skill_update($skill,$description,$id,$date_of_exam,$alloc_emp,$not_null_array =null){
        $key  = array_keys($not_null_array);
        $this->tables = array('employee_skill');
        $this->fields = array('skill','description','alloc_emp','exam_date');
        $this->field_values = array($skill,$description,$alloc_emp,$date_of_exam);
        if($not_null_array != null){
             $this->fields       = array_merge($this->fields,array($key[0],$key[1],$key[2]));
             $this->field_values = array_merge($this->field_values,array($not_null_array[$key[0]],$not_null_array[$key[1]],$not_null_array[$key[2]]));
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    function generate_pdf_work_report_new($r_year, $r_month, $r_employee, $r_customer) {

        require_once ('plugins/customize_pdf_work_report_details_new.class.php');

        $obj_cust = new customer();
        $pdf      = new PDF_Work_report_new();
        $pdf->report_employee = $r_employee;
        $pdf->report_customer = $r_customer;
        $pdf->report_month    = $r_month;
        $pdf->report_year     = $r_year;
        $pdf->AliasNbPages();
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////  
        $employee_details = $this->get_employee_detail($r_employee);
        $pdf->employee = $employee_details;
        // $cust_name = $obj_cust->getCustomerName($r_customer);
        $cust_details   = $obj_cust->customer_detail($r_customer);
        $cust_name      = $cust_details['first_name'] . " " . $cust_details['last_name'];
        $pdf->cust_name = $cust_name;
         // $pdf->AddPage('L'); 
        // $pdf->P1_Part1_Landscap($employee_details, $cust_name);
        // $pdf->Output();
        $pdf->Process_contents();
        // $total_column_count     = $pdf->get_total_columns();        //total number of columns
        // $normal_column_count    = $pdf->get_total_columns(1);      //total number of columns excluding leave columns
        // $leave_column_count     = $pdf->get_total_columns(2);
               //total number of leave columns
         // total column number. 
         $normal_column_count =  $pdf->get_total_columns_new(1);
         $leave_column_count  =  $pdf->get_total_columns_new(2);
         $fkkn_column_count   =  $pdf->get_total_columns_new(3);
         $total_column_count  = $normal_column_count + $leave_column_count + $fkkn_column_count;
         $pdf->total_column_count = $total_column_count;

        $start = 0;     //start column number for drawing pdf in a page
        $end = 0;       //end column number for drawing pdf in a page
        $max = 16;      //maximum number of columns allowed per page excluding date field
        $flag = TRUE;   //flag is used for printing header of report at onc
        // while ($end <= $total_column_count) {
            if($total_column_count > 22) {
                $pdf->AddPage('L', 'a3');        //pages
            } else {
                $pdf->AddPage('L');        //pages
            }
            if ($flag)
                // $pdf->P1_Part1_Landscap($employee_details, $cust_name);
            $flag = FALSE;

            // if ($normal_column_count + $leave_column_count <= $max + 5) {     //$max + 3 is used for allow extra 3 columns in a page only if have not exist other field for creating new page +2 for fk/kntu
            //     $start = $end + 1;
            //     $end = $start + $normal_column_count + $leave_column_count - 1+2;
            //     $normal_column_count = 0;
            //     $leave_column_count = 0;
            // } else if ($normal_column_count > 0) {
            //     if ($normal_column_count > $max) {
            //         $start = $end + 1;
            //         $end = $start + $max - 1;
            //         $normal_column_count -= ($end - $start + 1);
            //     } else {
            //         $start = $end + 1;
            //         $end = $start + $normal_column_count - 1;
            //         $normal_column_count -= ($end - $start + 1);
            //     }
            // } else if ($leave_column_count > 0) {
            //     if ($leave_column_count > $max) {
            //         $start = $end + 1;
            //         $end = $start + $max - 1;
            //         $leave_column_count -= ($end - $start + 1);
            //     } else {
            //         $start = $end + 1;
            //         $end = $start + $leave_column_count - 1;
            //         $leave_column_count -= ($end - $start + 1);
            //     }
            // }
            $pdf->P1_Part2_Landscap();
        // }
        $pdf->Output();
        // echo "<pre>".print_r($total_column_count,1)."</pre>";
        // echo "<pre>".print_r($normal_column_count,1)."</pre>";
        // echo  $leave_column_count;
        exit();
    }

    function update_employee_email($username, $email, $reset_verify_field = TRUE) {

        $this->tables = array('employee');
        $this->fields = array('email');
        $this->field_values = array($email);
        if($reset_verify_field){
            $this->fields[] = 'email_verified';
            $this->field_values[] = 0;
        }
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        return $this->query_update();
    }

    function update_employee_mobile($username, $mobile, $reset_verify_field = TRUE) {

        $this->tables = array('employee');
        $this->fields = array('mobile');
        $this->field_values = array($mobile);
        if($reset_verify_field){
            $this->fields[] = 'mobile_verified';
            $this->field_values[] = 0;
        }
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        return $this->query_update();
    }

    function update_employee_data_verification_flags($username, $verification_attribute = 'MOBILE', $verification_flag = 0) {

        $field_to_be_verify = NULL;
        switch ($verification_attribute) {
            case 'MOBILE': $field_to_be_verify = 'mobile_verified'; break;
            case 'EMAIL': $field_to_be_verify = 'email_verified'; break;
        }
        if($field_to_be_verify !== NULL){
            $this->tables = array('employee');
            $this->fields = array($field_to_be_verify);
            $this->field_values = array($verification_flag);
            $this->conditions = array('username = ?');
            $this->condition_values = array($username);
            return $this->query_update();
        }
        else 
            return FALSE;
    }
	
	/**************************3066 signing report**************************/
    
    function employee_signing_Transaction_3066() {

       // $employee->username = $report_employee;
       // $employee->signing_report_date = $year.'-'.$month.'-1';
        $login_user = $_SESSION['user_id'];
        $user = new user();
        $login_user_role = $user->user_role($login_user);
        //echo "<pre>"; print_r($login_user_role);
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $employee_sign = $tl_sign = $sutl_sign = '';
        $employee_ocs = $tl_ocs = $sutl_ocs = '';
        if ($login_user_role == 1) {
            $this->signing_employee = $this->signing_suTL_employee = $this->signing_TL_employee = $login_user;
            $this->signing_employee_date = $this->signing_suTL_date = $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
            $this->employee_sign = $this->tl_sign = $this->sutl_sign = $this->signauture;
            $this->employee_ocs = $this->tl_ocs = $this->sutl_ocs = $this->ocs;
            $this->signing_suTL_employee = $this->signing_TL_employee = $login_user;
            $this->signing_suTL_date = $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
            $this->tl_sign = $this->sutl_sign = $this->signauture;
            $this->tl_ocs = $this->sutl_ocs = $this->ocs;
            //echo "login_user";print_r($login_user);
            //echo "Username"; print_r($this->username);exit();
            if($login_user == $this->username){
                $this->signing_employee = $login_user;
                $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
                $this->employee_sign = $this->signauture;
                $this->employee_ocs = $this->ocs;
            }
            $this->signing_employee = $this->username;
            $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
            $this->employee_sign = $this->signauture;
            $this->employee_ocs = $this->ocs;
        } else {
            if ($login_user == $this->username) {
                $this->signing_employee = $login_user;
                $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
                $this->employee_sign = $this->signauture;
                $this->employee_ocs = $this->ocs;
            }
            $this->signing_employee = $this->username;
            $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
            $this->employee_sign = $this->signauture;
            $this->employee_ocs = $this->ocs;
            
            if ($user->check_SuperTL_or_not_from_team($login_user, $this->rpt_customer)) {
                $this->signing_suTL_date = $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
                $this->signing_suTL_employee = $this->signing_TL_employee = $login_user;
                $this->sutl_sign = $this->tl_sign = $this->signauture;
                $this->sutl_ocs = $this->tl_ocs = $this->ocs;
            }
            else if ($user->get_customers_in_which_am_TL($login_user, $this->rpt_customer)) {
                $this->signing_TL_date = $dtz->format('Y-m-d H:i:s');
                $this->signing_TL_employee = $login_user;
                $this->tl_sign = $this->signauture;
                $this->tl_ocs = $this->ocs;
            }
        }
        $cust_social_security_number = $this->cust_social_security_number;
        $emp_social_security_number = $this->emp_social_security_number;

        $sign_data = $this->employee_signing_existance_check_simple_3066();
        if (!empty($sign_data)) {
            if ($sign_data['signin_employee'] != '') {
                if ($sign_data['signin_employee'] != $this->username) {
                    $this->signing_employee = $this->username;
                    $this->signing_employee_date = $dtz->format('Y-m-d H:i:s');
                    $this->employee_sign = $this->signauture;
                    $this->employee_ocs = $this->ocs;
                } else {
                    $this->signing_employee = $sign_data['signin_employee'];
                    $this->signing_employee_date = $sign_data['signin_date'];
                    $this->employee_sign = $sign_data['employee_sign'];
                    $this->employee_ocs = $sign_data['employee_ocs'];
                }
            }
            if ($sign_data['signin_sutl'] != '') {
                $this->signing_suTL_date = $sign_data['signin_sutl_date'];
                $this->signing_suTL_employee = $sign_data['signin_sutl'];
                $this->sutl_sign = $sign_data['sutl_sign'];
                $this->sutl_ocs = $sign_data['sutl_ocs'];
            }
            if ($sign_data['signin_tl'] != '') {
                $this->signing_TL_date = $sign_data['signin_tl_date'];
                $this->signing_TL_employee = $sign_data['signin_tl'];
                $this->tl_sign = $sign_data['tl_sign'];
                $this->tl_ocs = $sign_data['tl_ocs'];
            }
           
            return $this->employee_signing_update_3066($sign_data['id']);
            
        } else if ($this->employee_signing_insert_3066()) {
            return TRUE;
        }
        else
            return FALSE;
    }
    
    function get_signing_detail($customer, $employee){
        $this->sql_query = "SELECT * FROM `report_signing_3066` WHERE employee = '".$employee."' AND customer = '".$customer."'";
        return $data = $this->query_fetch();
    }

    function employee_signing_insert_3066() {

        $this->tables = array('report_signing_3066');
        $this->fields = array('employee', 'customer', 'date', 'transaction_id', 'userId', 'signin_employee', 'signin_date', 'employee_sign', 'employee_ocs', 'signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs', 'signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs', 'emp_social_security_number','cust_social_security_number');
        $this->field_values = array($this->empname, $this->rpt_customer, $this->signing_report_date, $this->transaction_id, $this->userId, $this->signing_employee, $this->signing_employee_date, $this->employee_sign, $this->employee_ocs, $this->signing_TL_employee, $this->signing_TL_date, $this->tl_sign, $this->tl_ocs, $this->signing_suTL_employee, $this->signing_suTL_date, $this->sutl_sign, $this->sutl_ocs, $this->emp_social_security_number, $this->cust_social_security_number);
        
        if($this->signing_xml_storage && $this->signing_xml != NULL){
            $this->fields[] = 'xml';
            $this->field_values[] = $this->signing_xml;
        } 
        return $this->query_insert();
    }

    function employee_signing_update_3066($id) {
     
        $this->tables = array('report_signing_3066');
        $this->fields = array('signin_employee', 'signin_date', 'employee_sign', 'employee_ocs','signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs', 'signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs');
        $this->field_values = array($this->signing_employee, $this->signing_employee_date, $this->employee_sign, $this->employee_ocs, $this->signing_TL_employee, $this->signing_TL_date, $this->tl_sign, $this->tl_ocs, $this->signing_suTL_employee, $this->signing_suTL_date, $this->sutl_sign, $this->sutl_ocs);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
       // $this->conditions = array('AND', 'employee = ?', 'date = ?');
       // $this->condition_values = array($this->username, $this->signing_report_date);
        return $this->query_update();
    }
    
    function employee_signing_existance_check_simple_3066() {

        $this->tables = array('report_signing_3066');
        $this->fields = array('id', 'employee', 'customer', 'date', 'signin_employee', 'signin_date', 'employee_sign', 'employee_ocs','signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs', 'signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?');
        $this->condition_values = array($this->username, $this->rpt_customer);
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data[0] : FALSE;
    }
    
    function employee_signing_remove_3066() {
        
        $this->tables = array('report_signing_3066');
        $this->conditions = array('AND', 'employee = ?', 'customer = ?');
        $this->condition_values = array($this->username, $this->rpt_customer);
        
        return $this->query_delete();
           
    }
    
    function employee_signing_remove_3066_multiple() {
        
        $this->tables = array('report_signing_3066');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($this->rpt_customer);
        
        return $this->query_delete();
           
    }

}
?>
