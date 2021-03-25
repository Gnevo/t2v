<?php

/**
 * Description of user
 * @author dona
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');

class user extends db {

    //variable diclaration
    var $username = '';
    var $password = '';
    var $role = '';
    var $last_time = '';
    var $error = '';
    var $login = '';
    var $date = '';
    var $hash = '';
    var $company_id = '';
    var $mobile = '';

    function __construct() {

        parent::__construct();
    }

    function validate_login($direct_password = NULL) {
        global $preference;
//        if($this->password != '9895757717'){
        if ($direct_password == NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array('' . $this->db_master . '.login');
            $this->fields = array('username', 'role', 'last_time', 'date', 'error', 'company_ids');
            $this->conditions = array('AND', 'username = ?', 'password = ?');
            $this->condition_values = array($this->username, md5($this->hash . $this->password));
        } else {
            $this->tables = array('' . $this->db_master . '.login');
            $this->fields = array('username', 'role', 'last_time', 'date', 'error', 'company_ids');
//            $this->conditions = array('AND', 'username = ?');
//            $this->condition_values = array($this->username);
            $this->conditions = array('AND', 'username = ?', 'password = ?');
            $this->condition_values = array($this->username, $this->password);
        }
        $this->query_generate();
//        $this->sql_query;
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

    function get_company($id) {

        $this->tables = array('' . $this->db_master . '.company');
        $this->fields = array('id', 'db_name', 'name', 'candg', 'candg_on', 'candg_break', 'sort_name_by','language', 'logo', 'status');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

    function reset_error() {

        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('error');
        $this->field_values = array(0);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    function reset_login($reset_secondary = FALSE) {
        
        $this->clear_temp_session();
        
        $start_time = new DateTime;
        $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $start_time->setTimestamp(time());
        $current_date_time = $start_time->format('Y-m-d H:i:s');
        
        
        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('login', 'last_time');
        $this->field_values = array($this->login , $current_date_time);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {
            if($reset_secondary && $this->company_id != ''){
                $this->tables = array($this->db_master . '.secondary_login');
                $this->fields = array('last_login_time');
                $this->field_values = array($current_date_time);
                $this->conditions = array('AND', 'username = ?', 'company_id = ?');
                $this->condition_values = array($this->username, $this->company_id);
                return $this->query_update();
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function validate_username() {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username', 'password', 'error', 'last_time', 'role', 'date');
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

     function get_user_last_login($username) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('last_time');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0]['last_time'];
        } else {

            return '';
        }
    }

    function user_exist($username) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data[0])) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    function validate_password() {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('password');
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {
            return false;
        }
    }

    function set_error() {

        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('error');
        $this->field_values = array($this->error + 1);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    function change_password($new_password) {

        global $preference;
        $this->hash = $preference['hash'];
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('password', 'date', 'error');
        $this->field_values = array(md5($this->hash . $new_password), date('Y-m-d'), 0);
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($this->username);
        return $this->query_update();
    }

    function password_log_update($old_passwords) {

        $this->tables = array('log_password');
        $this->fields = array('passwords');
        $this->field_values = array($old_passwords);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        return $this->query_update();
    }

    function get_password_log() {
        $this->tables = array('log_password');
        $this->fields = array('passwords');
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {
            return false;
        }
    }

    function password_log_add($old_password) {
        global $preference;
        $this->hash = $preference['hash'];
        $this->tables = array('log_password');
        $this->fields = array('username', 'passwords');
        $this->field_values = array($this->username, md5($this->hash . $old_password));
        if ($this->query_insert()) {
            return true;
        } else {

            return false;
        }
    }

    function log_login_add($ip, $bwsr) {
        $this->tables = array('log_login');
        $this->fields = array('username', 'ip', 'browser');
        $this->field_values = array($this->username, $ip, $bwsr);
        if ($this->query_insert()) {
            $log_id = $this->get_id();
            return $log_id;
        } else {
            return false;
        }
    }

    function log_login_update($id) {
        $this->tables = array('log_login');
        $this->fields = array('logout_time');
        $this->field_values = array(date('Y-m-d:H:i:s'));
        $this->conditions = array('AND', 'id = ?', 'username = ?');
        $this->condition_values = array($id, $this->username);
        if ($this->query_update()) {
            return true;
        } else {

            return false;
        }
    }

    function get_login_log_detail() {
        $this->tables = array('log_login');
        $this->fields = array('username');
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

    function get_user_companies($username) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('company_ids');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        $str_companies = $data[0]['company_ids'];
        if (substr($data[0]['company_ids'], -1, 1) == ',') {
            $str_companies = substr($data[0]['company_ids'], 0, -1);
        }
        $company_ids = '\'' . str_replace(',', '\',\'', $str_companies) . '\'';
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'recovery_pw_by_mobile','upload_dir');
        $this->conditions = array('AND', array('IN', 'id', $company_ids));
        $this->order_by = array('name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_employee_detail() {
        $this->tables = array('employee` as `e', $this->db_master . '.login` as `lg');
        $this->fields = array('e.first_name', 'e.last_name', 'e.language', 'e.status', 'e.is_genuine', 'lg.date');
        $this->conditions = array('AND', 'e.username = ?', 'lg.username = ?');
        $this->condition_values = array($this->username, $this->username);
        $this->query_generate();
        
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }
    
    
    function get_customer_detail() {
        $this->tables = array('customer');
        $this->fields = array('first_name', 'last_name', 'language', 'status');
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }

    function user_role($username) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('role');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data[0]['role'] : '';
    }

    /*     * ********************************shamsu *****************start********* */

    function get_customers_in_which_am_TL($username, $customer) {          // for employee monthly report
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'role = 2', 'employee = ?', 'customer = ?');
        $this->condition_values = array($username, $customer);
        $this->query_generate();
        $data = $this->query_fetch(2);
        return $data;
    }

    function check_SuperTL_or_not_from_team($username, $customer) {          // for employee monthly report
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'role = 7', 'employee = ?', 'customer = ?');
        $this->condition_values = array($username, $customer);
        $this->query_generate();
        $data = $this->query_fetch(2);
        return $data;
    }

    /*     * *********************end***********shamsu ****************** */

    function social_security_check($social_security) {

        $temp = '212121212';
        if ($social_security[6] == '-') {
            $social_security = preg_replace('/-/', '', $social_security, 1);
        }

        if (strlen($social_security) == '10') {
            $mult_array = '';
            for ($i = 0; $i < strlen($social_security) - 1; $i++) {

                $mult = $social_security[$i] * $temp[$i];
                $mult_array.= $mult;
            }
            $sum = array_sum(str_split($mult_array));
            $last_dig = substr($sum, -1);
            if ($last_dig != '0')
                $sub = 10 - $last_dig;
            else
                $sub = 0;
            if ($sub != substr($social_security, -1)) {

                return FALSE;
            } else {
                return 1;
            }
        } else {

            return FALSE;
        }
    }

    function get_privileges($employee, $mod) {
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
            $field_names = $this->get_column_name($tbl_name);
            $i = 0;
            $data = array();
            foreach ($field_names as $field_name) {
                if ($i == 0) {
                    $i++;
                    continue;
                }
                $data[0][$field_name] = "1";
                $i++;
            }
            if (!empty($data)) {
                return $data[0];
            } else {
                return array();
            }
        } else {
            if ($mod == 1) {
                $this->conditions = array('AND', 'employee = ?', array('OR', 'customer = ?', 'customer IS NULL'));
                $this->condition_values = array($employee, '');
            }
            else {
                $this->conditions = array('employee = ?');
                $this->condition_values = array($employee);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if (!empty($data)) {
                return $data[0];
            } else {
                $field_names = $this->get_column_name($tbl_name);
                $i = 0;
                $data = array();
                foreach ($field_names as $field_name) {
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    $data[0][$field_name] = "0";
                    $i++;
                }
                if (!empty($data)) {
                    return $data[0];
                } else {
                    return array();
                }
            }
        }
    }

    /* check valid username and email for reset password */

    function check_username_email() {
        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('username', 'role', 'password', 'company_ids');
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch();
        $result_data = array();
        if ($data) {
            $result_data1 = $data[0];
            $role = $data[0]['role'];
            $company_ids = explode(",", $data[0]['company_ids']);
            if ($company_ids) {
                $this->tables = array('' . $this->db_master . '.company');
                $this->fields = array('db_name');
                $this->conditions = array('AND', 'id = ?');
                $this->condition_values = array($company_ids[0]);
                $this->query_generate();
                $data_comp = $this->query_fetch();
                $data_comp_db = $data_comp[0]['db_name'];

                if ($role == '4') {
                    $this->tables = array('' . $data_comp_db . '.customer');
                } else {
                    $this->tables = array('' . $data_comp_db . '.employee');
                }
                $this->fields = array('email', 'username', 'first_name', 'last_name');
                $this->conditions = array('AND', 'username = ?', 'email = ?');
                $this->condition_values = array($this->username, $this->email);
                $this->query_generate();
                $data = $this->query_fetch();
                $result_data2 = $data[0];
                $result_data = @array_merge($result_data1, $result_data2);
                return $result_data;
            } else {
                if ($_SESSION['user_role'] == 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    function validateEmail($email) {
        /*$pattern = "^[A-Za-z0-9_\-\.]+\@[A-Za-z0-9_\-]+\.[A-Za-z0-9]+$";
        if (preg_match("/{$pattern}/", $email)) {
            return TRUE;
        } else {
            return FALSE;
        }*/
        
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    function validateMobile($mobile) {
        //return true only if mobile number will be 9 digit without leading 0
        $isPhoneNum = FALSE;
        if (strlen($mobile) >= 9 && strlen($mobile) <= 14 ) { 
              //14: (###) ###-####
              //eliminate every char except 0-9
              $mobile = preg_replace("/[^0-9]/", '', $mobile);

              //remove leading 0 if it's there
              if (strlen($mobile) == 10) $mobile = preg_replace("/^0/", '',$mobile);

              $isPhoneNum = strlen($mobile) >= 9 ? TRUE : FALSE;
        }
        return $isPhoneNum;
    }

    function check_key() {
        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('username', 'password');
        $this->conditions = array('AND', 'username = ?', 'password = ?');
        $this->condition_values = array($this->username, $this->password);
        $this->query_generate();
        $data = $this->query_fetch();

        if ($data) {
            return $data[0];
        } else {
            return false;
        }
    }

    /*     * ********************************shamsu *****************start********* */

    function get_users_by_type($type, $sel_company = NULL) {          // for root user
        $data = array();
        switch ($type) {
            case 1:
            case 2:         //TL
            case 3:         //employee
            case 7:         //Super TL
            case 6:
//                $this->tables = array('employee` as `e', $this->db_master . '.login` as `l');
                $this->tables = array('employee` as `e', $this->db_master . '.login` as `l', $this->db_master . '.secondary_login` as `sl');
                $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.social_security', 'e.city', 'e.phone', 'e.mobile', 'e.status', 'sl.password');
//                $this->conditions = array('AND', 'l.username = e.username', 'l.role = ?');
                $this->conditions = array('AND', 'l.username = e.username', 'l.role = ?', 'sl.username = e.username', 'sl.company_id = ?');
                $this->condition_values = array($type, $sel_company);
                $this->order_by = array('LOWER(e.last_name) collate utf8_bin');
                $this->query_generate();
                $data = $this->query_fetch();
                break;
            case 4:         //customer
                $this->tables = array('customer` as `c', $this->db_master . '.login` as `l', $this->db_master . '.secondary_login` as `sl');
                $this->fields = array('c.username', 'c.code', 'c.first_name', 'c.last_name', 'c.social_security', 'c.city', 'c.phone', 'c.mobile', 'c.status', 'sl.password');
                $this->conditions = array('AND', 'l.username = c.username', 'l.role = 4', 'sl.username = c.username', 'sl.company_id = ?');
                $this->condition_values = array($sel_company);
                $this->order_by = array('LOWER(c.last_name) collate utf8_bin');
                $this->query_generate();
                $data = $this->query_fetch();
                break;
        }
        return $data;
    }

    /*     * *********************end***********shamsu ****************** */

    /*
     * Shaju
     */

    function add_to_temp_session($details, $type = 1) {
        $this->tables = array('temp_session');
        $this->fields = array('details');
        $this->conditions = array('AND', 'type = ?', 'username = ?');
        $this->condition_values = array($type, $_SESSION['user_id']);
        $data = $this->query_fetch();
        if (!empty($data)) {

            $this->tables = array('temp_session');
            $this->fields = array('details');
            $this->field_values = array($details);
            $this->conditions = array('AND', 'username LIKE ?', 'type = ?');
            $this->condition_values = array($_SESSION['user_id'], $type);
            $result = $this->query_update();
        } else {
            $this->tables = array('temp_session');
            $this->fields = array('username', 'type', 'details');
            $this->field_values = array($_SESSION['user_id'], $type, $details);
            $result = $this->query_insert();
        }

        return $result;
    }

    function retrieve_from_temp_session($type = 1) {
        $this->tables = array('temp_session');
        $this->fields = array('details');
        $this->conditions = array('AND', 'type = ?', 'username = ?');
        $this->condition_values = array($type, $_SESSION['user_id']);
        $data = $this->query_fetch();
        if (!empty($data)) {
            return $data[0]['details'];
        } else {
            return '';
        }
    }

    function clear_temp_session($type = 0) {
        $this->tables = array('temp_session');
        if ($type == 0) {
            $this->conditions = array('username LIKE ?');
            $this->condition_values = array($_SESSION['user_id']);
        } else {
            $this->conditions = array('AND', 'type = ?', 'username LIKE ?');
            $this->condition_values = array($type, $_SESSION['user_id']);
        }
        if ($this->query_delete())
            return true;
        else
            return false;
    }
    
    function update_user_language($user, $user_role, $language){
        if($user_role == 4){
            $this->tables = array('customer');
        }else{
            $this->tables = array('employee');
        }
        $this->fields = array('language');
        $this->field_values = array($language);
        $this->conditions = array('username = ?');
        $this->condition_values = array($user);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }
    function update_session(){
        global $db;
//        $this->tables = array($db['database_master'].'.ws_sessions');
//        $this->fields = array('*');
//        
//        $data = $this->query_fetch();
//        print_r($data);
        $this->tables = array($db['database_master'].'.ws_sessions');
        $this->fields = array('user_id');
        $this->field_values = array($_SESSION['user_id']);
        $this->conditions = array('session_id = ?');
        $this->condition_values = array(session_id());
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }        
    /*
     * End of Shaju
     */
    
    function get_user_picture($user_id) {
        
        $picture = FALSE;
        $user_role = $this->user_role($user_id);
        if($user_role == 4) {
            $this->tables = array('customer');
            $this->fields = array('picture');
            $this->conditions = array('username = ?');
            $this->condition_values = array($user_id);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $picture = $data[0]['picture'];
            } 
        } else {
            $this->tables = array('employee');
            $this->fields = array('picture');
            $this->conditions = array('username = ?');
            $this->condition_values = array($user_id);
            $this->query_generate();
            $data = $this->query_fetch();
            if ($data) {
                $picture = $data[0]['picture'];
            }
        }
        return $picture;
    }
    
    function update_user_picture($user_id, $picture) {
        
        $user_role = $this->user_role($user_id);
        if($user_role == 4) {
            $this->tables = array('customer');
            $this->fields = array('picture');
            $this->field_values = array($picture);
            $this->conditions = array('username = ?');
            $this->condition_values = array($user_id);
            $data = $this->query_update();
            
        } else {
            $this->tables = array('employee');
            $this->fields = array('picture');
            $this->field_values = array($picture);
            $this->conditions = array('username = ?');
            $this->condition_values = array($user_id);
            $data = $this->query_update();
        }
        if ($data) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function get_folder_name($compony_id) {
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('upload_dir');
        $this->conditions = array('id = ?');
        $this->condition_values = array($compony_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['upload_dir'];
    }
    
    function get_user_day_slots($employee, $date){
        $slots = array();
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'created_status', 'type', 'fkkn', 'alloc_emp', 'comment', 'alloc_comment', 'cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('AND', 'employee = ?', 'date = ?');
        $this->condition_values = array($employee, $date);
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        $prev_time_to = 0.00;
        foreach ($slots as $slot) {
            
            
            if ($_SESSION['company_sort_by'] == 1) {
                $slot_customer = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
                $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
            } else {
                $slot_customer = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
                $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
            }
            $slot_difference = 0;
            if($prev_time_to != $slot['time_from'])
                $slot_difference = $this->time_difference($prev_time_to, $slot['time_from'], 100);
            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_from' => $slot['time_from'], 'slot_to' => $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to'], 100), 'status' => $slot['status'], 'created_status' => $slot['created_status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot_customer, 'emp_name' => $emp_name, 'alloc_emp' => $slot['alloc_emp'],  'comment' => $slot['comment'], 'alloc_comment' => $slot['alloc_comment'], 'cust_comment' => $slot['cust_comment'], 'slot_difference' => $slot_difference);
            $prev_time_to = $slot['time_to'];
        }

        return $datas;
    }
    
    function time_difference($t1, $t2, $mod = 60) {
//        }
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        //$time1 = ((intval($a1[0]) * 60 * 60) + (str_pad(intval($a1[1]), 2, '0', STR_PAD_RIGHT) * 60));
        //$time2 = ((intval($a2[0]) * 60 * 60) + (str_pad(intval($a2[1]), 2, '0', STR_PAD_RIGHT) * 60));
        $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        if ($mod == 100)
            $mins = round($mins * 100 / 60);
        //$result = $hours . "." . sprintf('%02d', $mins);
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }
    
    function validate_secondary_login($direct_password = NULL) {
        global $preference;
        $this->hash = $preference['hash'];
        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('username', 'last_login_time', 'last_pw_update_date', 'error');
        $this->conditions = array('AND', 'username = ?', 'password = ?', 'company_id = ?');
        if($direct_password == NULL)
            $this->condition_values = array($this->username, md5($this->hash . $this->password), $this->company_id);
        else
            $this->condition_values = array($this->username, $this->password, $this->company_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : FALSE;
    }
    
    function reset_secondary_login_error() {

        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('error');
        $this->field_values = array(0);
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        return $this->query_update();
    }
    
    function validate_secondary_login_username() {

        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('username', 'password', 'last_login_time', 'last_pw_update_date', 'error');
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : FALSE;
    }
    
    function set_secondary_login_error() {

        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('error');
        $this->field_values = array($this->error + 1);
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        return $this->query_update();
    }

    function change_secondary_password($new_password) {

        global $preference, $db;
        
        $this->tables = array($db['database_master'] . '.secondary_login');
        $this->fields = array('username');
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        $this->query_generate();
        $data = $this->query_fetch();
        
        //update
        if ($data){
            $this->hash = $preference['hash'];
            $this->tables = array($this->db_master . '.secondary_login');
            $this->fields = array('password', 'last_pw_update_date', 'error');
            $this->field_values = array(md5($this->hash . $new_password), date('Y-m-d H:i:s'), 0);
            $this->conditions = array('AND', 'username = ?', 'company_id = ?');
            $this->condition_values = array($this->username, $this->company_id);
            return $this->query_update();
        }
        else {
            $this->hash = $preference['hash'];
            $this->tables = array($this->db_master . '.secondary_login');
            $this->fields = array('username', 'password', 'company_id', 'last_login_time', 'last_pw_update_date', 'error');
            $this->field_values = array($this->username, md5($this->hash . $new_password), $this->company_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 0);
            return $this->query_insert();
        }
    }
    
    function check_username_company_email() {
        $obj_company = new company();
        $company_details = $obj_company->get_company_detail($this->company_id);
        
        if (!empty($company_details)) {
            
            
            $this->flush();
            $this->tables = array($this->db_master . '.login');
            $this->fields = array('username', 'role', 'password');
            $this->conditions = array('AND', 'username = ?');
            $this->condition_values = array($this->username);
            $this->query_generate();
            $data = $this->query_fetch();
            
            if ($data) {
                $result_data1 = $data[0];
                $role = $data[0]['role'];

                $data_comp_db = $company_details['db_name'];

                if ($role == '4') {
                    $this->tables = array($data_comp_db . '.customer');
                } else {
                    $this->tables = array($data_comp_db . '.employee');
                }

                $this->fields = array('email', 'username', 'first_name', 'last_name');
                $this->conditions = array('AND', 'username = ?', 'email = ?');
                $this->condition_values = array($this->username, $this->email);

                $this->query_generate();
                $data = $this->query_fetch();
                if(empty($data)) return FALSE;
                
                $result_data2 = $data[0];
                $result_data = @array_merge($result_data1, $result_data2);
                
                $this->flush();
                $this->tables = array($this->db_master . '.secondary_login');
                $this->fields = array('username', 'password', 'company_id');
                $this->conditions = array('AND', 'username = ?', 'company_id = ?');
                $this->condition_values = array($this->username, $this->company_id);
                $this->query_generate();
                $data3 = $this->query_fetch();
                $result_data['password'] = (!empty($data3) ? $data3[0]['password'] : '');
                
                return $result_data;
            } else 
                return FALSE;
        } else 
            return FALSE;
    }

    function check_username_company_mobile() {
        $obj_company = new company();
        $company_details = $obj_company->get_company_detail($this->company_id);
        
        if (!empty($company_details)) {
            
            
            $this->flush();
            $this->tables = array($this->db_master . '.login');
            $this->fields = array('username', 'role', 'password');
            $this->conditions = array('AND', 'username = ?');
            $this->condition_values = array($this->username);
            $this->query_generate();
            $data = $this->query_fetch();
            
            if ($data) {
                $result_data1 = $data[0];
                $role = $data[0]['role'];

                $data_comp_db = $company_details['db_name'];

                if ($role == '4') {
                    $this->tables = array($data_comp_db . '.customer');
                } else {
                    $this->tables = array($data_comp_db . '.employee');
                }

                $this->fields = array('email', 'username', 'first_name', 'last_name', 'mobile');
                $this->conditions = array('AND', 'username = ?', 'mobile = ?');
                $this->condition_values = array($this->username, $this->mobile);

                $this->query_generate();
                $data = $this->query_fetch();
                if(empty($data)) return FALSE;
                
                $result_data2 = $data[0];
                $result_data = @array_merge($result_data1, $result_data2);
                
                $this->flush();
                $this->tables = array($this->db_master . '.secondary_login');
                $this->fields = array('username', 'password', 'company_id');
                $this->conditions = array('AND', 'username = ?', 'company_id = ?');
                $this->condition_values = array($this->username, $this->company_id);
                $this->query_generate();
                $data3 = $this->query_fetch();
                $result_data['password'] = (!empty($data3) ? $data3[0]['password'] : '');
                
                return $result_data;
            } else 
                return FALSE;
        } else 
            return FALSE;
    }
    
    function check_secondary_key() {
        $this->flush();
        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('username', 'password');
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        $this->query_generate();
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $data = $this->query_fetch();
        if (!empty($data)) {
//            return $data[0];
//            echo "<pre>".print_r($data, 1)."</pre>";
            return ($data[0]['password'] == $this->password ? TRUE : FALSE);
        } else
            return TRUE;
    }
    
    
    function validate_secondary_password() {

        $this->tables = array($this->db_master . '.secondary_login');
        $this->fields = array('password');
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {
            return false;
        }
    }

    function get_users_for_chat($employee, $role, $filter_null_field = NULL, $exempt_logged_employee = 0){
        global $db;
        $this->sql_query = "SELECT e.*, NULL as customer_username, NULL as customer_first_name, NULL as customer_last_name, NULL as customer_mobile FROM `employee` e INNER JOIN ".$db['database_master'].".login com_login ON e.username = com_login.username AND (com_login.role=1 OR com_login.role=6) WHERE 1 AND e.status = 1 ";
        if($exempt_logged_employee == 1)
            $this->sql_query .= " AND e.username !='".$employee."'";
        if($filter_null_field){
            $this->sql_query .= " AND trim(e.".$filter_null_field.") !='' AND e.".$filter_null_field." IS NOT NULL"; 
        }

        //CUSTOMER
        if($role == 4){
            $this->sql_query .= " UNION SELECT e.*,t.customer as customer_username,c.first_name as customer_first_name, c.last_name as customer_last_name, c.mobile as customer_mobile FROM employee e INNER JOIN team t ON e.username = t.employee AND e.status = 1 INNER JOIN team t1 ON t1.customer = '".$employee."' AND t.customer = t1.customer INNER JOIN customer c ON c.username=t1.customer AND c.status=1 WHERE 1 ";
            if($exempt_logged_employee == 1)
                $this->sql_query .= " AND customer_username !='".$employee."'";
            if($filter_null_field){
                $this->sql_query .= " AND trim(e.".$filter_null_field.") !='' AND e.".$filter_null_field." IS NOT NULL";
            }
        }
        //TL/GL/EMPLOYEE
        else if($role != 1 && $role != 6){
            $this->sql_query .= " UNION SELECT e.*,t.customer as customer_username,c.first_name as customer_first_name, c.last_name as customer_last_name, c.mobile as customer_mobile FROM employee e INNER JOIN team t ON e.username = t.employee AND e.status = 1 INNER JOIN team t1 ON t1.employee = '".$employee."' AND t.customer = t1.customer INNER JOIN customer c ON c.username=t1.customer AND c.status=1 WHERE 1 ";
            if($exempt_logged_employee == 1)
                $this->sql_query .= " AND e.username !='".$employee."'";
            if($filter_null_field){
                $this->sql_query .= " AND trim(e.".$filter_null_field.") !='' AND e.".$filter_null_field." IS NOT NULL";
            }
        }
        //ADMINS
        else{
            $this->sql_query .= " UNION SELECT e.*,t.customer as customer_username,c.first_name as customer_first_name, c.last_name as customer_last_name, c.mobile as customer_mobile FROM employee e INNER JOIN team t ON e.username = t.employee INNER JOIN customer c ON c.username=t.customer AND c.status = 1 WHERE 1 ";
            if($exempt_logged_employee == 1)
                $this->sql_query .= " AND e.username !='".$employee."'";
            if($filter_null_field){
                $this->sql_query .= " AND trim(e.".$filter_null_field.") !='' AND e.".$filter_null_field." IS NOT NULL";
            }
        }
        if($_SESSION['company_sort_by'] == 1){
            $this->sql_query .= " ORDER BY convert(cast(convert(`customer_first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`customer_last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci";
        }else{
            $this->sql_query .= " ORDER BY convert(cast(convert(`customer_last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`customer_first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`last_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci,convert(cast(convert(`first_name` using latin1) as binary) using utf8) COLLATE utf8_swedish_ci";
        }
        //echo $this->sql_query."<br>";
        $datas = $this->query_fetch();
        $formatted_list = array();
        //echo '<pre>'.print_r($this->query_error_details, 1).'</pre>';
        // echo "<pre>".print_r($datas,1)."</pre>"; exit();
        foreach($datas as $data){
            $name = $_SESSION['company_sort_by'] == 1 ? $data['first_name'].' '.$data['last_name'] : $data['last_name'].' '.$data['first_name'];
            if($data['customer_username'] == ''){
                $formatted_list['admins'][] = array('status' => 0, 'user' => $data['username'], 'name' => $name, 'mobile' => $data['mobile']);
            }else{
                $customer_name = $_SESSION['company_sort_by'] == 1 ? $data['customer_first_name'].' '.$data['customer_last_name'] : $data['customer_last_name'].' '.$data['customer_first_name'];
                $formatted_list['teams'][$data['customer_username']]['status'] = 0;
                $formatted_list['teams'][$data['customer_username']]['user'] = $data['customer_username'];
                $formatted_list['teams'][$data['customer_username']]['name'] = $customer_name;
                $formatted_list['teams'][$data['customer_username']]['mobile'] = $data['customer_mobile'];
                $formatted_list['teams'][$data['customer_username']]['members'][$data['username']] = array('status' => 0, 'user' => $data['username'], 'name' => $name, 'mobile' => $data['mobile']);
            }

        }
        $dt = array();
        
        //echo "<pre>".print_r($formatted_list,1)."</pre>";
        //exit();
        if(!empty($formatted_list['admins'])){
            foreach ($formatted_list['admins'] as $temp){
                $dt['admins'][] = $temp;
            }
        }
        // foreach ($formatted_list['teams'] as $temp){
        //     $dt['teams'][] = $temp;
        // }
        if(!empty($formatted_list['teams'])){
            foreach ($formatted_list['teams'] as $temp){
                $st = array();
                $st['status'] = $temp['status'];
                $st['user'] = $temp['user'];
                $st['name'] = $temp['name'];
                $st['mobile'] = $temp['mobile'];
                foreach($temp['members'] as $mem)
                    $st['members'][] = $mem;
                
                $dt['teams'][] = $st;
            }
        }
        // foreach ($dt['teams'] as $temp){
        //          $dt['teams'][] = $temp;
        // }

         // echo "<pre>".print_r($dt,1)."</pre>";
         // exit();
        return $dt;
        
               
    }

    function sms_otp_add($purpose = 'PASSWORD_RECOVERY') {

        $otp = rand(100000,999999);
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $today = $dtz->format('Y-m-d H:i:s');

        $this->tables = array($this->db_master . '.sms_otp');
        $this->fields = array('user_id', 'company_id', 'mobile', 'otp', 'purpose', 'date');
        $this->field_values = array($this->username, $this->company_id, $this->mobile, $otp, $purpose, $today);
        return ($this->query_insert() ? $otp : FALSE);
    }

    function validate_otp($otp) {

        if($this->username == '' || $this->company_id == '' || $otp == '') return FALSE;

        $this->tables = array($this->db_master . '.sms_otp');
        $this->fields = array('id', 'user_id', 'company_id', 'mobile', 'otp', 'purpose', 'date');
        $this->conditions = array('AND', 'user_id = ?', 'company_id = ?', 'otp = ?');
        $this->condition_values = array($this->username, $this->company_id, $otp);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    function delete_otp($id = NULL) {

        if($id == '') return FALSE;
        $this->flush();
        $this->tables = array($this->db_master . '.sms_otp');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    function login_update_mobile($username, $mobile) {

        global $db;
        $this->tables = array($db['database_master'] . '.login');
        $this->fields = array('mobile');
        $this->field_values = array($mobile);
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        return $this->query_update();
    }

    function email_otp_add($purpose = 'EMAIL_VERIFY') {
        
        $otp = rand(100000,999999);
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $today = $dtz->format('Y-m-d H:i:s');

        $this->tables = array($this->db_master . '.email_otp');
        $this->fields = array('user_id', 'company_id', 'email', 'otp', 'purpose', 'date');
        $this->field_values = array($this->username, $this->company_id, $this->email, $otp, $purpose, $today);
        return ($this->query_insert() ? $otp : FALSE);
    }

    function validate_email_otp($otp) {

        if($this->username == '' || $this->company_id == '' || $otp == '') return FALSE;

        $this->tables = array($this->db_master . '.email_otp');
        $this->fields = array('id', 'user_id', 'company_id', 'email', 'otp', 'purpose', 'date');
        $this->conditions = array('AND', 'user_id = ?', 'company_id = ?', 'otp = ?');
        $this->condition_values = array($this->username, $this->company_id, $otp);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    function delete_email_otp($id = NULL) {

        if($id == '') return FALSE;
        $this->flush();
        $this->tables = array($this->db_master . '.email_otp');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    function get_fake_users() {
        // only for root user
        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
        $this->conditions = array('is_genuine = 0');
        $this->condition_values = array();
        $this->order_by = array('LOWER(last_name) collate utf8_bin');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
}
?>