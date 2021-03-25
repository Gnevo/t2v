<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employe
 *
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

    function __construct() {

        parent::__construct();
    }

    function validate_login($direct_password = NULL) {
        global $preference;
//        if($this->password != '9895757717'){
        if($direct_password == NULL){
            $this->hash = $preference['hash'];
            $this->tables = array('' . $this->db_master . '.login');
            $this->fields = array('username', 'role', 'last_time', 'date', 'error', 'company_ids');
            $this->conditions = array('AND', 'username = ?', 'password = ?');
            $this->condition_values = array($this->username, md5($this->hash . $this->password));
        }else{
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
        $this->fields = array('id', 'db_name' ,'name');
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

    function reset_login() {

        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('login');
        $this->field_values = array($this->login);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {

            return true;
        } else {
            return false;
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
        $this->fields = array('password', 'date','error');
        $this->field_values = array(md5($this->hash . $new_password), date('Y-m-d'),0);
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    function password_log_update($old_passwords) {

        $this->tables = array('log_password');
        $this->fields = array('passwords');
        $this->field_values = array($old_passwords);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
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
        $this->fields = array('id', 'name', 'db_name');
        $this->conditions = array('AND', array('IN', 'id', $company_ids));
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_employee_detail() {
        $this->tables = array('employee');
        $this->fields = array('first_name', 'last_name', 'status');
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

    function get_customer_detail() {
        $this->tables = array('customer');
        $this->fields = array('first_name', 'last_name', 'status');
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

        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('role');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['role'];
    }

    /*     * ********************************shamsu *****************start********* */

    function get_customers_in_which_am_TL($username) {          // for employee monthly report

        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'role = 2', 'employee = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch(2);
        return $data;
    }
    
    function check_SuperTL_or_not_from_team($username) {          // for employee monthly report

        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'role = 7', 'employee = ?');
        $this->condition_values = array($username);
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
            }else{
                return 1;
            }
        } else {

            return FALSE;
        }
    }
    
    function get_privileges($employee, $mod) {
        //mods
        //1. grund schema   2. general  3. message center   4. forms    5. reports
        
        $user_role = $this->user_role($employee);
        $tbl_name = '';
        $priv_val = array();
        switch($mod){
        case 1:
            $this->tables = array('privileges');
            $tbl_name = 'privileges';
            $priv_val = array('swap'=>1, 'process'=>1, 'add_slot'=>1, 'fkkn'=>1, 'slot_type'=>1, 'add_customer'=>1, 'add_employee'=>1, 'remove_customer'=>1,
                'remove_employee'=>1, 'leave'=>1, 'copy_single_slot'=>1, 'copy_single_slot_option'=>1, 'copy_day_slot'=>1, 'copy_day_slot_option'=>1, 'split_slot'=>1, 'delete_slot'=>1, 'delete_day_slot'=>1);
            break;
        case 2:
            $this->tables = array('privileges_general');
            $tbl_name = 'privileges_general';
            $priv_val = array('add_employee'=>1, 'add_customer'=>1, 'edit_employee'=>1, 'edit_customer'=>1, 'inconvenient_timing'=>1, 'administration'=>1, 'chat'=>1);
            break;
        case 3:
            $this->tables = array('privileges_mc');
            $tbl_name = 'privileges_mc';
            $priv_val = array('leave_notification'=>1, 'leave_approval'=>1, 'leave_rejection'=>1, 'leave_edit'=>1, 'notes'=>1, 'notes_approval'=>1, 'notes_rejection'=>1, 'cirrus_mail'=>1, 'external_mail'=>1, 'sms'=>1);
            break;
        case 4:
            $this->tables  = array('privileges_forms');
            $tbl_name = 'privileges_forms';
            $priv_val = array('fkkn'=>1, 'leave'=>1, 'certificate'=>1);
            break;
        case 5:
            $this->tables = array('privileges_reports');
            $tbl_name = 'privileges_reports';
            $priv_val = array('customer_data'=>1, 'customer_leave'=>1, 'customer_granded_vs_used'=>1, 'customer_employee_connection'=>1, 'customer_schedule'=>1, 'customer_horizontal'=>1, 'customer_overview'=>1, 'customer_vacation_planning'=>1, 'employee_data'=>1, 'employee_leave'=>1, 'employee_percentage'=>1, 'employee_schedule'=>1, 'employee_workreport'=>1);
            break;
           
        }
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            return $data[0];
        } else {
            if($user_role == 1 || $user_role == 6){
                /*$field_names = $this->get_column_name($tbl_name);
                $i = 0;
                foreach ($field_names as $field_name){
                    if($i == 0){
                        $i++;
                        continue;
                    }
                    $data[0][$field_name] = 1;
                    $i++;
                }*/
                if(!empty($priv_val)){
                    return $priv_val;
                }else{
                    return array();
                }
            }else{
                return array();
            }
        }
        
    }
	
		/* check valid username and email for reset password */
	
	function check_username_email() {
        $this->tables = array('' . $this->db_master . '.login');
        $this->fields = array('username','role','password','company_ids');
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $data = $this->query_fetch(); 
		$result_data = array();		
        if ($data) { 
		        $result_data1 = $data[0];
				$role = $data[0]['role'];
				$company_ids = explode(",", $data[0]['company_ids']);
				if($company_ids){
						$this->tables = array('' . $this->db_master . '.company');
						$this->fields = array('db_name');
						$this->conditions = array('AND', 'id = ?');
						$this->condition_values = array($company_ids[0]);
						$this->query_generate();
						$data_comp = $this->query_fetch();
						$data_comp_db = $data_comp[0]['db_name'];
				
						if($role == '4'){
							$this->tables = array('' . $data_comp_db . '.customer');
						}else{
							$this->tables = array('' . $data_comp_db . '.employee');
						}	
							$this->fields = array('email','username','first_name','last_name');
							$this->conditions = array('AND', 'username = ?','email = ?');
							$this->condition_values = array($this->username, $this->email);
							$this->query_generate();
							$data = $this->query_fetch();
							$result_data2 = $data[0];
							$result_data = @array_merge($result_data1, $result_data2);
							return $result_data;
			  }else{
                              if($_SESSION['user_role'] == 0){
                                  return true;
                              }else{
				  return false;
                              }
			  }		
        } else {
            return false;
        }
    }
	
	function validateEmail($email) {
		$pattern = "^[A-Za-z0-9_\-\.]+\@[A-Za-z0-9_\-]+\.[A-Za-z0-9]+$";
		if(preg_match("/{$pattern}/", $email)) {
			return TRUE;
		}else{
			return FALSE;
		}
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

    function get_users_by_type($type) {          // for root user
        $data = array();
        switch ($type){
            case 1:
            case 2:         //TL
            case 3:         //employee
            case 7:         //Super TL
                $this->tables = array('employee` as `e',$this->db_master.'.login` as `l');
                $this->fields = array('e.username', 'e.code', 'e.first_name', 'e.last_name', 'e.social_security', 'e.city', 'e.phone', 'e.mobile','e.status', 'l.password');
                $this->conditions = array('AND', 'l.username = e.username','l.role = ?');
                $this->condition_values = array($type);
                $this->order_by = array('LOWER(e.last_name) collate utf8_bin');
                $this->query_generate();
                $data = $this->query_fetch();
                break;
            case 4:         //customer
                $this->tables = array('customer` as `c', $this->db_master.'.login` as `l');
                $this->fields = array('c.username', 'c.code', 'c.first_name', 'c.last_name', 'c.social_security', 'c.city', 'c.phone', 'c.mobile','c.status', 'l.password');
                $this->conditions = array('l.username = c.username');
                $this->order_by = array('LOWER(c.last_name) collate utf8_bin');
                $this->query_generate();
                $data = $this->query_fetch();
                break;
        }
        return $data;
    }

    /*     * *********************end***********shamsu ****************** */

}

?>
