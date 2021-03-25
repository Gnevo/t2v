<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customer
 *
 * @author dona
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');

class customer extends db {

    //variable diclaration
    var $username = '';
	var $password = '';
	var $role = 4;
    var $login = 0;
    var $code = '';
    var $ch = '';
    var $first_name = '';
    var $last_name = '';
    var $social_security = '';
    var $address = '';
    var $city = '';
    var $post = '';
    var $phone = '';
    var $mobile = '';
    var $email = '';
    var $date = '';
    var $works = array();
    var $status = 1;
	var $company_name = '';
	var $company_address = '';
    var $company_city = '';
    var $company_post = '';
    var $company_phone = '';
    var $company_mobile = '';
    var $company_email = '';

    function __construct() {

        parent::__construct();
    }

    function customer_list() {

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->conditions = array('status = ?');
        $this->condition_values = array(1);
        $this->order_by = array('first_name', 'last_name');
        $this->query_generate();
        $datas = $this->query_fetch();
        if (!empty($datas))
            return $datas;
        else
            return FALSE;
    }

    function get_customer_allocation($user, $start_date, $end_date) {

		$this->tables = array('customer_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'date_to >= ?');
		$this->order_by = array('date_from');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('customer_contract');
        $this->fields = array('id','date_from','date_to','DATEDIFF(date_to,date_from)','hour');
		$this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
		$this->condition_values = array($user, $end_date, $user, $start_date);
		$this->order_by = array('date_from');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return FALSE;
    }

    function get_customer_weekly_allocation($user) {

        $this->tables = array('timetable');
        $this->fields = array('date','WEEKOFYEAR(date)','DAYNAME(date)','time_from','time_to');
		$this->conditions = array('AND','customer = ?', 'status = \'1\'');
		$this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return FALSE;
    }

	function get_username($name) {
		
	    $this->tables = array("login");
	    $this->fields = array("MAX(username) as username");
		$this->conditions = array("username LIKE ?");
		$this->condition_values = array($name . "%"); 
		$this->query_generate();
		$data = $this->query_fetch();
		if(!empty($data)){
			 $max_count_user = substr($data[0]['username'], (strlen($data[0]['username']) - 3), 3);
             $max_count = $max_count_user + 1;
             $count = sprintf("%03d", $max_count);
             $username = $name.$count;
		}
		else{
			$count = "001";
			$username = $name.$count;
		}
		     
      return $username;
   }
    
    function login_add() {
		
	  if ($this->username != NULL) {

            $this->tables = array("login");
            $this->fields = array("username", "password", "role", "login", "date");
            $this->field_values = array($this->username, $this->password, $this->role, $this->login,date("Y-m-d"));
            if ($this->query_insert()) {
            	
                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function customer_add() {

        if ($this->username != NULL) {

            $this->tables = array("customer");
            $this->fields = array("username", "code","ch", "social_security", "first_name", "last_name", "address", "city", "post", "phone", "mobile", "email", "date", "works", "status");
            $this->field_values = array($this->username, $this->code, $this->ch, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date,$this->works, $this->status);
          
			if ($this->query_insert()) {
           
                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }
	function work_list() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->query_generate();
        $result = $this->query_fetch();
		$datas = $this->makeArray($result);
        if (!empty ($datas))
            return $datas;
        else
            return FALSE;
    }

 function makeArray($datas = array()){
        
        $data_array = array();
        foreach ($datas as $data){
            
            $data_array[$data['id']] = $data['name'];
        }
        return $data_array;
    }

    function employee_social_security_check($social_security) {

        $this->tables = array('t2v_cleaning_common.login');
        $this->fields = array('company_ids');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($social_security);
        $this->query_generate();
        $datas = $this->query_fetch();
        if($datas[0]['company_ids'])
            return $datas[0]['company_ids'];
        else
            return false;
    }

    function get_company_db($company_id) {

        $this->tables = array('t2v_cleaning_common.company');
        $this->fields = array('db_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($company_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['db_name'];
    }

    function get_employee_detail($db,$social_security) {

        $this->tables = array(''.$db.'.employee');
        $this->fields = array('username','code','first_name','last_name','address','city','post','phone','mobile','email','date');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($social_security);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }
}

?>