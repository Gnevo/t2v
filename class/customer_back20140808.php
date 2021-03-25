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
require_once ('class/user.php');
require_once ('class/employee.php');
require_once ('class/db.php');
require_once ('plugins/date_calc.class.php');
require_once('plugins/customize_pdf.class.php');
require_once('plugins/customize_pdf_customer.class.php');

class customer extends db {

    //variable declaration
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
    var $status = '';
    var $user = '';
    var $date_from = '';
    var $date_to = '';
    var $hours = '';
    //variables for relatives
    var $relative_name = '';
    var $relative_relation = '';
    var $relative_address = '';
    var $relative_city = '';
    var $relative_phone = '';
    var $relative_work_phone = '';
    var $relative_mobile = '';
    var $relative_email = '';
    var $relative_other = '';
    //customer helth details
    var $health_care = '';
    var $occupational_therapists = '';
    var $physiotherapists = '';
    var $aiother = '';
    //customer gaurdian details
    var $guardian_fname = '';
    var $guardian_lname = '';
    var $guardian_mobile = '';
    var $guardian_email = '';
    var $guardian_address = '';
    var $guardian_fname2 = '';
    var $guardian_lname2 = '';
    var $guardian_mobile2 = '';
    var $guardian_email2 = '';
    var $guardian_address2 = '';
    var $equipment_id = "";
    var $serial_number = "";
    var $customer = "";
    var $employee = "";
    var $issue_date = "";
    var $return_date = "";
    var $subject = "";
    var $note_type = "";
    var $notes = "";
    var $priority = "";
    var $description = "";
    var $work = "";
    var $history = "";
    var $clinical_picture = "";
    var $medications = "";
    var $devolution = "";
    var $special_diet = "";
    var $d_fname = "";
    var $d_lname = "";
    var $d_mobile = "";
    var $d_email = "";
    var $d_comment_other = "";
    var $d_comment_time = "";
    var $d_document = "";
    var $b_fname = "";
    var $b_lname = "";
    var $b_mobile = "";
    var $b_email = "";
    var $b_city = "";
    var $d_city = "";
    var $b_oncall = "";
    var $b_oncall2 = "";
    var $b_awake = "";
    var $b_something = "";
    var $b_comment = "";
    var $b_iss = "";
    var $b_sol = "";
    var $century = "";
    var $date_inactive = "";
    var $fkkn = "";
    var $gender= "";
    var $kn_name= "";
    var $kn_address= "";
    var $kn_postno= "";
    
    var $b_kn_ref_num = ''; 
    var $b_box = ''; 

    function __construct() {

        parent::__construct();
    }

    // Function used to list the all contrats under a particular customer
    function contract_customer($username) {
        $this->tables = array('customer_contract', 'customer');
        $this->fields = array('customer_contract.customer',
            'customer_contract.date_from',
            'customer_contract.date_to',
            'customer_contract.hour',
            'customer_contract.id',
            'customer_contract.fkkn',
            'customer.first_name',
            'customer.last_name',
            'customer.username'
        );
        $this->conditions = array('AND',
            'customer_contract.customer=customer.username',
            'customer_contract.customer=?');
        $this->condition_values = array($username);
        $this->query_generate();

        $data = $this->query_fetch();
        return $data;
    }

    //Function to edit the contract of the customer
    function contract_customer_edit($id) {

        $this->tables = array('customer_contract');
        $this->fields = array('date_from', 'date_to', 'hour');
        $this->field_values = array($this->date_from, $this->date_to, $this->hours);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
        if ($data)
            return true;
        else
            return FALSE;
    }

    //Function to get the values of the customer contract to edit
    function contract_customer_edit_get($id) {

        $this->tables = array('customer_contract');
        $this->fields = array('id', 'customer', 'date_from', 'date_to', 'hour');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    //Function to check wheather the customer contract need to edit or add
    function contract_add_edit_customer_check($id) {
        if (!empty($id[1])) {
            return 'edit';
        } else {
            return 'add';
        }
    }

    function contract_customer_add() {

        $this->tables = array('customer_contract',);
        $this->fields = array('customer', 'date_from', 'date_to', 'hour');
        $this->field_values = array($this->user, $this->date_from, $this->date_to, $this->hours);
        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function contract_customer_check($val,$fkkn = NULL) {

        $this->tables = array('customer_contract');
        $this->fields = array('customer');
        $this->conditions = array('AND', array('OR', '? BETWEEN date_from AND date_to', '?  BETWEEN date_from AND date_to', 'date_from BETWEEN ? AND ?', 'date_to  BETWEEN ? AND ?'), 'customer = ?');
        $this->condition_values = array($this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->user);
        if($fkkn != NULL){
           $this->conditions[] = 'fkkn = ?';
           $this->condition_values[] = $fkkn;
        }
        if ($val != "") {
            $this->conditions[] = 'id <> ?';
            $this->condition_values[] = $val;
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return FALSE;
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
    
    function customer_list_for_export(){
        
        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
       // $this->conditions = array('status = 1');
        $this->order_by = array('LOWER(last_name) collate utf8_bin');
        $this->query_generate();
        $customer_data = $this->query_fetch();
        if (!empty($customer_data))
            return $customer_data;
        else
            return array();
        
    }
            
    
       function customer_list($key = NULL) {
           $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        $user = new user();
        $customer_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $team_customer_data = 'NULL';
        $team_query = '';
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('status = 1');
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 2:
                case 3:    
                case 7:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;

                case 4:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', 'username = ?', 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                
            }
        } else {
            switch ($login_user_role) {

                case 1:
                case 6:    
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    //$this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    if($key == "A"){
                        $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    }
                    $this->condition_values = array($key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;

                case 2:
                case 7:
                case 3:    
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                   //11111111111111
                    if($key == "A"){
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 1', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 1');
                    }
//                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;

                
                case 4:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', 'username = ?', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', 'username = ?', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    }
//                    $this->conditions = array('AND', 'username = ?', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", str_replace($convert_from, $convert_to, $key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                
                
            }
        }


        if (!empty($customer_data))
            return $customer_data;
        else
            return array();
    }
	

	
	//customer active in active data
	function customer_activeinactive_data($key = NULL,$status,$order) {
		
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
		
		if($order == '-')
		{
			$order	= 'ascname';
		}
						
        if ($key == '-') {
			
            switch ($login_user_role) {
                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', 'status = '.$status.'');
					}
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code');							
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
					
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
					}
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
					}
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
					}
					//$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        } else {

			$fullname = str_replace('_',' ',$key);
			$key = strtolower(urldecode($fullname));
						
			//check for name parameter it's full name or it's character
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', 'status = '.$status.'','LCASE(last_name) LIKE ?');
						$this->condition_values = array(strtolower($key)."%");
					}
					else
					{	
						$this->conditions = array('AND','LCASE(last_name) LIKE ?');
						$this->condition_values = array(strtolower($key)."%");
					}					
                    
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\''; 														           
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						 $this->conditions = array('AND', 'status = '.$status.'',array('IN', 'username', $team_employee_data), 'LCASE(last_name) LIKE ?');						
					}
					else
					{	
						 $this->conditions = array('AND',array('IN', 'username', $team_employee_data),'LCASE(last_name) LIKE ?');
					}
					$this->condition_values = array(strtolower($key)."%");
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'', 'LCASE(last_name) LIKE ?');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'LCASE(last_name) LIKE ?');
					}
					$this->condition_values = array(strtolower($key)."%");
					
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'', 'LCASE(last_name) LIKE ?');
					}
					else
					{	
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data),'LCASE(last_name) LIKE ?');
					}                   
					$this->condition_values = array(strtolower($key)."%");
					
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) collate utf8_bin ASC','LOWER(first_name) collate utf8_bin ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) collate utf8_bin DESC','LOWER(first_name) collate utf8_bin DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        }

        if (!empty($employee_data)) {

            return $employee_data;
        }
        else
		{
            return array();
		}
    }
	
	function customer_getgardins($username)
	{
		$this->tables = array('customer_guardian');
		$this->fields = array('first_name','last_name','mobile','email','first_name2','last_name2','mobile2','email2');
		$this->conditions = array('AND', 'customer = "'.$username.'"');
		$this->query_generate();
		$employee_data = $this->query_fetch();
		
		if (!empty($employee_data)) 
		{
			return $employee_data;
		}
		else
		{
			return array();
		}
				
	}
	
	function customer_getrelatives($username)
	{
		$this->tables = array('customer_relative');
		$this->fields = array('name', 'relation', 'phone', 'mobile','email');
		$this->conditions = array('AND', 'customer = "'.$username.'"');
		$this->query_generate();
		$employee_data = $this->query_fetch();
		
		if (!empty($employee_data)) 
		{
			return $employee_data;
		}
		else
		{
			return array();
		}
				
	}
	
	function custgriddata($name,$fromdate,$todate)
	{
			
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);		
		
		//check for name parameter it's full name or it's character
		$fullname = str_replace('_',' ',$name);
		$name = strtolower(urldecode($fullname));
			
		if(strlen($name) == 2 || strlen($name) == 1 ){ $flag = 2;  }else{ $flag = 1;  }
		
			
		switch ($login_user_role) 
		{	
			case 1:
			case 6:			
				$team_members = $this->team_members($login_user);
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',
				"SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes",
				"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");	
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
					}
				}				
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');					}
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
					}
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
					}
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer');
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'"');
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"');
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				}
				
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data) && !empty($employee_data[0]['username'])) 
				{	
					return $employee_data;
				}
				else
				{
					return array();
				}
				break;			
				
				
		case 2:
		case 7:
				$team_members = $this->team_members($login_user);
                                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
	
				$this->tables = array('employee','customer','timetable');
								$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');					
					}
				}		
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date >= "'.$fromdate.'" ');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date >= "'.$fromdate.'" ');
					}
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date <= "'.$todate.'" ');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date <= "'.$todate.'" ');
					}
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					}
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data)) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;
				
			case 3:
			case 5:
				$team_employee_data = '\'' . $login_user . '\'';
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');			
					}
				}			
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date >= "'.$fromdate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date >= "'.$fromdate.'"');
					}
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date <= "'.$todate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date <= "'.$todate.'"');
					}
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					}
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data)) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;
		case 4:			
				$team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
				
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");				
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');				
					}
				}		
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date >= "'.$fromdate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date >= "'.$fromdate.'"');					
					}
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date <= "'.$todate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date <= "'.$todate.'"');				
					}
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					if($flag == 1)
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','customer.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					}
					else
					{
						$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','customer.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					}
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}				
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','timetable.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data)) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;			
			
		}
	}
        
        
	function custgriddata_leave($name,$fromdate,$todate, $except_employees){
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);		
		
		//check for name parameter it's full name or it's character
		$fullname = str_replace('_',' ',$name);
		$name = strtolower(urldecode($fullname));
			
		if(strlen($name) == 2 || strlen($name) == 1 ){ $flag = 2;  }else{ $flag = 1;  }
		
			
		switch ($login_user_role){	
			case 1:
			case 6:			
				$team_members = $this->team_members($login_user);
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','0 AS `Total Hours`',
				"0 AS totalMinutes",
				"0 AS hrsmins");	
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}				
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer');
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'"');
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"');
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				if (!empty($employee_data) && !empty($employee_data[0]['username']))
					return $employee_data;
				else
					return array();
				break;
                        case 2:
                        case 7:
				$team_members = $this->team_members($login_user);
                                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
	
				$this->tables = array('employee','customer','timetable');
                                $this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','0 AS `Total Hours`',"0 AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}		
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date >= "'.$fromdate.'" ');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date >= "'.$fromdate.'" ');
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date <= "'.$todate.'" ');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date <= "'.$todate.'" ');
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data))
					return $employee_data;
				else
					return array();
				break;
			case 3:
			case 5:
				$team_employee_data = '\'' . $login_user . '\'';
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','0 AS `Total Hours`',"0 AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}			
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date >= "'.$fromdate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date >= "'.$fromdate.'"');
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date <= "'.$todate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date <= "'.$todate.'"');
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data))
					return $employee_data;
				else
					return array();
				break;
                        case 4:			
				$team_members = $this->team_members($login_user);
                                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
				
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','0 AS `Total Hours`',"0 AS hrsmins");				
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )');
				}		
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date >= "'.$fromdate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date >= "'.$fromdate.'"');
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','timetable.date <= "'.$todate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','timetable.date <= "'.$todate.'"');
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00'){
					if($flag == 1)
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','customer.username = "'.$name.'"','customer.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					else
						$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),array('IN', 'employee.username', $team_employee_data),'timetable.status = 2','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','(LCASE(customer.last_name) LIKE "'.$name.'%" OR LCASE(customer.last_name) LIKE "'.mb_strtolower($name).'%" )','customer.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'"',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','customer.status = 1','timetable.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions = array('AND', array('NOT IN', 'employee.username', $except_employees),'employee.status = 1','timetable.status = 1','customer.status = 2','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				$this->group_by = array('timetable.customer','timetable.employee');
				$this->order_by = array('customer.last_name collate utf8_bin','customer.first_name collate utf8_bin','employee.last_name collate utf8_bin','employee.first_name collate utf8_bin');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data))
					return $employee_data;
				else
					return array();
				break;
		}
	}
	
	// This function is for show data of CUSTOMER with auto suggest
	function getcustomer($name)
	{		
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);
		$name = str_replace('_',' ',$name);
		  if ($name != NULL) 
		  {
            switch ($login_user_role) {

                case 1:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address');
					$this->conditions = array('AND', 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
				case 2:
					$this->tables = array('team');
					$this->fields = array('customer');
					$this->conditions = array('AND',"employee = '".$login_user."'");
					$this->query_generate();
					$team_members = $this->query_fetch(2);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';					
					/*$team_members = $this->team_members($login_user);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';*/
					$this->tables = array('customer');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;	
				case 3:
					$this->tables = array('team');
					$this->fields = array('customer');
					$this->conditions = array('AND',"employee = '".$login_user."'");
					$this->query_generate();
					$team_members = $this->query_fetch(2);
					$team_data = '\'' . implode('\', \'', $team_members) . '\'';
					
					$this->tables = array('customer');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
				$this->conditions = array('AND', array('IN', 'username', $team_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;												
                case 6:	
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address');
				$this->conditions = array('AND', 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 7:				
                    $this->tables = array('team');
					$this->fields = array('customer');
					$this->conditions = array('AND',"employee = '".$login_user."'");
					$this->query_generate();
					$team_members = $this->query_fetch(2);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';					
					/*$team_members = $this->team_members($login_user);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';*/
					
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");				
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 5:				
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('customer');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;
                case 4:				
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('customer');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');				
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;
            }
        }
		
		if (!empty($employee_data)) 
		{				
			return $employee_data;
		}
		else 
		{
			return array();
		}
	}
	
	function count_cust_employee($year,$custid)
	{
		$team_members = $this->team_members($login_user);
		$this->tables = array('timetable');
		$this->fields = array('customer');
		
		if($year != '-')
		{
			$this->conditions = array('AND', 'timetable.customer = "'.$custid.'"','timetable.status = 1','YEAR(timetable.date) = '.$year.'','timetable.employee != ""');	
		}
		else
		{
			$this->conditions = array('AND', 'timetable.customer = "'.$custid.'"','timetable.status = 1','timetable.employee != ""');	
		}
		$this->group_by = array('timetable.employee','timetable.customer');		
		$this->query_generate();
		$employee_data = $this->query_fetch();		
		$totemployee = count($employee_data);
		if($totemployee > 0)		
		{
			$tot = $totemployee;	
		}
		else
		{
			$tot = 0;
		}
	
		if (!empty($employee_data)) 
		{
            return $tot;
        }
        else
		{
            return $tot;
		}
	}
	/*************************************/
	/* End Viteb Functions 			*/
	/*************************************/
	
         


    function customer_list_begin($key = NULL,$sort_by = NULL) {

        $user = new user();
        $customer_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $team_customer_data = 'NULL';
        $team_query = '';
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('status = 0');
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;

                case 2:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query),'status = 0');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;

                case 3:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query),'status = 0');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 4:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', 'username = ?','status = 0');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 5:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query),'status = 0');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 6:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('status = 0');
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 7:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query),'status = 0');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
            }
        } else {
            switch ($login_user_role) {

                case 1:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;

                case 2:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;

                case 3:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 4:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', 'username = ?', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', 'username = ?', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 5:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 6:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('IN', 'username', $team_query), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 7:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    if($key == "A"){
                        $this->conditions = array('AND', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0', 'last_name NOT LIKE "ä%"','last_name NOT LIKE "å%"','last_name NOT LIKE "ö%"', 'last_name NOT LIKE "Ä%"','last_name NOT LIKE "Å%"','last_name NOT LIKE "Ö%"');        
                    }else{
                        $this->conditions = array('AND', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    }
//                    $this->conditions = array('AND', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'),'status = 0');
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name) collate utf8_bin');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;
            }
        }


        if (!empty($customer_data))
            return $customer_data;
        else
            return array();
    }

    /*function customer_list_limit($employees, $key = NULL) {


        $team_query = '';
        if ($key == NULL) {

            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array("employee IN(" . $employees . ")");
            $this->query_generate();
            $team_query = $this->sql_query;

            $this->tables = array('customer');
            $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
            $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1');
            $this->order_by = array('LOWER(last_name)');
            $this->query_generate();
            $customer_data = $this->query_fetch();
        } else {


            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array("employee IN(" . $employees . ")");
            $this->query_generate();
            $team_query = $this->sql_query;
            $this->tables = array('customer');
            $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
            $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
            $this->condition_values = array($key . "%", strtolower($key) . "%");
            $this->order_by = array('LOWER(last_name)');
            $this->query_generate();
            $customer_data = $this->query_fetch();
        }

        echo "<pre>\n".print_r($customer_data, 1)."</pre>";
        if (!empty($customer_data))
            return $customer_data;
        else
            return array();
    }*/
    
    function customer_list_limit($employees, $key = NULL) {


        $team_query = '';
        if ($key == NULL) {

            $this->sql_query = "SELECT distinct username, code, first_name, last_name, social_security, city, phone, mobile FROM customer INNER JOIN
                                team ON customer.username LIKE team.customer AND team.employee IN($employees) AND customer.status = 1 ORDER BY LOWER(customer.last_name)";
            $customer_data = $this->query_fetch();
        } else {

         
            $this->sql_query = "SELECT distinct username, code, first_name, last_name, social_security, city, phone, mobile FROM customer INNER JOIN
                                team ON customer.username LIKE team.customer AND team.employee IN($employees) AND customer.status = 1 AND (customer.last_name LIKE '$key%' OR customer.last_name LIKE '".strtolower($key)."%') ORDER BY LOWER(customer.last_name)";
            $customer_data = $this->query_fetch();
        }
        
        
        if (!empty($customer_data))
            return $customer_data;
        else
            return array();
    }

    function team_employee_customers($username) {

        $this->tables = array('team');
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

            $this->tables = array('timetable');
            $this->fields = array('DISTINCT customer AS customer');
            $this->conditions = array('IN', 'employee', $members_field_value);
            $this->query_generate();
            $datas = $this->query_fetch();
            $customers_list = array();
            foreach ($datas as $data) {

                $customers_list[] = $data['customer'];
            }
        } else {

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
        }
        return $customers_list;
    }

    /*function team_members($username) {

        //getting related customer employees
        $this->tables = array('team');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('employee = ?');
        $this->query_generate();
        $sql_customers = $this->sql_query;

        $this->tables = array('team');
        $this->fields = array('DISTINCT employee AS employee');
        $this->conditions = array('IN', 'customer', $sql_customers);
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $members = array();
        foreach ($datas as $data) {

            $members[] = $data['employee'];
        }
        return $members;
    }*/

    function team_members($username) {

        $this->sql = "SELECT DISTINCT t1.employee FROM team AS t1
                      INNER JOIN team AS t2 ON t1.customer LIKE t2.customer AND t2.employee = '$username'";
        $datas = $this->query_fetch();
        $members = array();
        foreach ($datas as $data) {

            $members[] = $data['employee'];
        }
        return $members;
    }
    
    function get_customers_for_employees($usernames,$month,$year) {

        //getting related customer employees       
        /*$this->sql_query = "SELECT DISTINCT tm.customer AS customer FROM team tm INNER JOIN timetable t ON tm.customer = t.customer 
                            AND t.customer IS NOT NULL and t.customer != '' AND MONTH(t.date)=$month AND YEAR(t.date)=$year AND t.status != 0 AND tm.employee IN($usernames) and t.employee IN($usernames)";*/
        $this->sql_query = "SELECT DISTINCT t.customer AS customer FROM timetable t WHERE 
                            t.customer IS NOT NULL and t.customer != '' AND MONTH(t.date)=$month AND YEAR(t.date)=$year AND t.status != 0 AND t.employee IN($usernames)";
        $datas = $this->query_fetch();
        $members = array();
        foreach ($datas as $data) {

            $members[] = $data['customer'];
        }
        return $members;
    }
    
    
    function generate_customer_code() {

        $this->tables = array('customer');
        $this->fields = array('MAX(CAST(SUBSTR(code,LOCATE(\'-\',code)+1) AS UNSIGNED)) as code', 'LENGTH(SUBSTR(code,LOCATE(\'-\',code)+1)) as code_size', 'SUBSTR(code,1, LOCATE(\'-\',code)+1) as code_start', 'count(*) as code_exists');
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            $max_count_code = $data[0]['code'];
            $max_count = $max_count_code + 1;
            $count = sprintf('%0' . $data[0]['code_size'] . 'd', $max_count);
            $temp = $data[0]['code_start'];
            $code = $temp ."-". $count;
        } else {
            $code = '001-000001';
        }

        return $code;
    }

    function customer_slots_week($customer, $year_week) {

        require_once('class/employee.php');
        require_once ('class/setup.php');
        $smarty = new smartySetup();
        $obj_employee = new employee();
        global $week;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        /*$datas = array();
        $i = 0;
        foreach ($week as $day) {

            $datas[$i]['day'] = $day;
            $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
            $datas[$i]['date'] = $date;
            $slots = $this->customer_slots_day($customer, $date);
            $datas[$i]['slots'] = $slots;
            $i++;
        }
        return $datas;*/

        $w_start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $w_end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        $this->flush();
        $this->tables = array('timetable` as `t');
        $this->fields = array('t.id', 't.employee', 't.customer', 't.fkkn', 't.date', 't.time_from', 't.time_to', 
                't.status', 't.type', 't.alloc_emp','t.comment','t.alloc_comment','t.cust_comment', 
                '(SELECT first_name FROM customer where username = t.customer) AS cust_first_name', 
                '(SELECT last_name FROM customer where username = t.customer) AS cust_last_name', 
                '(SELECT first_name FROM employee where username = t.employee) AS emp_first_name', 
                '(SELECT last_name FROM employee where username = t.employee) AS emp_last_name', 
                '(SELECT color FROM employee where username = t.employee) AS emp_color',
                'IF ((SELECT count(id) from report_signing where employee = t.employee and customer = t.customer and month(date) = month(t.date) and year(date) = year(t.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '0,1,2,4'));
        $this->condition_values = array($customer, $w_start_date, $w_end_date);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $week_slots = $this->query_fetch();
        
        $tl_employees = array();
        if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
            $temp_tl_employees = $obj_employee->employees_list_for_right_click($customer);
            foreach($temp_tl_employees as $temp_tl_employee){
                $tl_employees[] = $temp_tl_employee['username'];
            }
        }
        
        if(!empty($week_slots)){
            foreach ($week_slots as $key => $slot) {
                $tl_flag = 1;
                if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
                    if(!in_array($slot['employee'], $tl_employees) && $slot['employee'] != '')
                        $tl_flag = 0;
                }elseif($_SESSION['user_role'] == 3){
                    if($_SESSION['user_id'] != $slot['employee'])
                        $tl_flag = 0;
                }
                $leave_data = array();
                if($slot['status'] == 2){
                    $leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'],$slot['date'],$slot['time_from'],$slot['time_to']);
                    $leave_data[0]['leave_name'] = $smarty->leave_type[$leave_data[0]['type']];
                }
                $tmp_array = array(
                    'slot'      => $slot['time_from'] . '-' . $slot['time_to'], 
                    'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100), 
                    'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 
                    'emp_name'  => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 
                    'leave_data'  => $leave_data[0], 
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

    function customer_slots_day($customer, $date) {
        $obj_employee = new employee();
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'time_from', 'time_to', 
                    'status', 'type', 'alloc_emp','comment','alloc_comment','cust_comment', 
                    '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', 
                    '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', 
                    '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', 
                    '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name', 
                    '(SELECT color FROM employee where username = timetable.employee) AS emp_color',
                    'IF ((SELECT count(id) from report_signing where employee = timetable.employee and customer = timetable.customer and month(date) = month(timetable.date) and year(date) = year(timetable.date) and signin_employee IS NOT NULL and signin_employee != ""), "1", "0") as signed');
        $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '0,1,2,4'));
        $this->condition_values = array($customer, $date);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $slots = $this->query_fetch();
        
        $tl_employees = array();
        if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
            $temp_tl_employees = $obj_employee->employees_list_for_right_click($customer);
            foreach($temp_tl_employees as $temp_tl_employee){
                $tl_employees[] = $temp_tl_employee['username'];
            }
        }
        
        $datas = array();
        if(!empty($slots)){
            foreach ($slots as $key => $slot) {
                $tl_flag = 1;
                if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
                    if(!in_array($slot['employee'], $tl_employees) && $slot['employee'] != '')
                        $tl_flag = 0;
                }elseif($_SESSION['user_role'] == 3){
                    if($_SESSION['user_id'] != $slot['employee'])
                        $tl_flag = 0;
                }
                
                $tmp_array = array(
                    'slot'      => $slot['time_from'] . '-' . $slot['time_to'], 
                    'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100), 
                    'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 
                    'emp_name'  => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 
                    'tl_flag'   => $tl_flag);
                
                $datas[] = array_merge($slots[$key], $tmp_array);
            }
        }
        return $datas;
    }

    function get_customer_timetable() {

        $this->tables = array('timetable');
        $this->fields = array('username');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return array();
    }

    function get_username($name) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('MAX(username) as username');
        $this->conditions = array('username LIKE ?');
        $this->condition_values = array($name . '%');
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            $max_count_user = substr($data[0]['username'], (strlen($data[0]['username']) - 3), 3);
            $max_count = $max_count_user + 1;
            $count = sprintf('%03d', $max_count);
            $username = $name . $count;
        } else {
            $count = '001';
            $username = $name . $count;
        }

        return $username;
    }

    function login_add() {
        global $preference;
        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($this->db_master . '.login');
            if ($this->password != NULL) {
                $this->fields = array('username', 'mobile', 'password', 'role', 'login', 'date', 'company_ids','social_security');
                $this->field_values = array($this->username, $this->mobile, md5($this->hash . $this->password), $this->role, $this->login, date('Y-m-d'), $_SESSION['company_id'] . ',',$this->social_security);
            } else {
                $this->fields = array('username', 'mobile', 'role', 'login', 'date', 'company_ids','social_security');
                $this->field_values = array($this->username, $this->mobile, $this->role, $this->login, date('Y-m-d'), $_SESSION['company_id'] . ',',$this->social_security);
            }
            if ($this->query_insert()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function login_update() {
        global $preference;

        if ($this->username != NULL && $this->password != NULL) {

            $this->hash = $preference['hash'];
            $this->tables = array($this->db_master . '.login');
            $this->fields = array('password', 'mobile','social_security');
            $this->field_values = array(md5($this->hash . $this->password), $this->mobile,$this->social_security);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {

                return true;
            } else {

                return false;
            }
        } elseif ($this->username != NULL) {
            $this->tables = array($this->db_master . '.login');
            $this->fields = array('mobile','social_security');
            $this->field_values = array($this->mobile,$this->social_security);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {

                return true;
            } else {

                return false;
            }
        } else {

            return true;
        }
    }

    function customer_add() {

        if ($this->username != NULL) {

            $this->tables = array('customer');
            $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status','date_inactive','fkkn','gender');
            $this->field_values = array($this->username, $this->century, $this->code, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->status,$this->date_inactive,$this->fkkn,$this->gender);

            if ($this->query_insert()) {
                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function customer_relatives_add() {

        if ($this->username != NULL && $this->relative_name != '') {

            $this->tables = array('customer_relative');
            $this->fields = array('customer', 'name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
            $this->field_values = array($this->username, $this->relative_name, $this->relative_relation, $this->relative_address, $this->relative_city, $this->relative_phone, $this->relative_work_phone, $this->relative_mobile, $this->relative_email, $this->relative_other);
            if ($this->query_insert()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function customer_relatives_update($relative_id) {

        if ($relative_id != '' && $this->relative_name != '') {

            $this->tables = array('customer_relative');
            $this->fields = array('name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
            $this->field_values = array($this->relative_name, $this->relative_relation, $this->relative_address, $this->relative_city, $this->relative_phone, $this->relative_work_phone, $this->relative_mobile, $this->relative_email, $this->relative_other);
            $this->conditions = array('id = ?');
            $this->condition_values = array($relative_id);
            if ($this->query_update()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function customer_relative_delete($relative_id, $customer_username) {

        if ($relative_id != '' && $customer_username != '') {

            $this->tables = array('customer_relative');
            $this->conditions = array('AND', 'id = ?', 'customer = ?');
            $this->condition_values = array($relative_id, $customer_username);
            if ($this->query_delete()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function customer_update() {
        if ($this->username != NULL) {

            $this->tables = array('customer');
            $this->fields = array('code', 'century', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status','date_inactive','fkkn','gender');

            $this->field_values = array($this->code, $this->century, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->status,$this->date_inactive,$this->fkkn,$this->gender);

            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            //echo $this->sql_query;
            if ($this->query_update()) {
                return TRUE;
            } else {

                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function company_add() {

        if ($this->username != NULL) {

            $this->tables = array('company');
            $this->fields = array('username', 'name', 'address', 'city', 'post', 'phone', 'mobile', 'email');
            $this->field_values = array($this->username, $this->company_name, $this->company_address, $this->company_city, $this->company_post, $this->company_phone, $this->company_mobile, $this->company_email);

            if ($this->query_insert()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function company_update() {

        if ($this->username != NULL) {

            $this->tables = array('company');
            $this->fields = array('name', 'address', 'city', 'post', 'phone', 'mobile', 'email');
            $this->field_values = array($this->company_name, $this->company_address, $this->company_city, $this->company_post, $this->company_phone, $this->company_mobile, $this->company_email);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function customer_detail($customer_username, $name = NULL) {

        $this->tables = array('customer');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status','date_inactive','fkkn','gender');
        if ($name != NULL) {
            $this->conditions = array('AND', 'first_name LIKE ?');
            $this->condition_values = array($name . "%");
        } else {
            $this->conditions = array('AND', 'username = ?');
            $this->condition_values = array($customer_username);
        }
        $this->query_generate();
        $datas = $this->query_fetch();

        return $datas[0];
    }

    function customer_relatives($customer_username) {

        $this->tables = array('customer_relative');
        $this->fields = array('id', 'name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
	function get_filter_date_report_dropdown($customer,$fkdate='',$kndate='', $per) // For found data from dropdown dates
	{
		$data = array();
		if(!empty($fkdate))
		{
			$this->sql_query = "SELECT * FROM customer_contract WHERE id='$fkdate';";
			$fkdata = $this->query_fetch(); // This will calculate FK used by specified customer	
			$fk_date_from = $fkdata[0]['date_from'];
			$fk_date_to = $fkdata[0]['date_to'];
			$granted_fk = intval($fkdata[0]['hour']);
			
			$this->sql_query = "SELECT SUM(time_to-time_from) AS fk_sum FROM timetable WHERE DATE BETWEEN '$fk_date_from' AND '$fk_date_to' AND customer='$customer' AND fkkn='1' GROUP BY customer;";
			$fk_used = $this->query_fetch(); // This will calculate FK used by specified customer
			
			$fk_used = intval($fk_used[0]['fk_sum']); // FK
			
			$fk_diff = $granted_fk - $fk_used;
	
			$fk_valid_diff = ( ($granted_fk/100) * $per );
			
			$fk_valid_diff = intval($fk_valid_diff);
			
			$fk_valid_lower_range = $granted_fk - $fk_valid_diff;
			$fk_valid_lower_range = intval($fk_valid_lower_range);
			
			$fk_valid_higher_range = $granted_fk + $fk_valid_diff;
			$fk_valid_higher_range = intval($fk_valid_higher_range);
			
			if( ($fk_valid_lower_range <= $fk_used) AND ($fk_used <= $fk_valid_higher_range))
			{
				$fk_text_color = 'BLACK';
			}else{
				$fk_text_color = 'RED';
			}
			
			$data['fk_granted'] = $granted_fk;
			$data['fk_used'] = $fk_used;
			$data['fk_diff'] = $fk_diff;
			$data['fk_color'] = $fk_text_color;
			$data['fk_diff_per'] = ($fk_diff/$granted_fk)*100;	
			$data['fk_diff_per'] = number_format((float)$data['fk_diff_per'], 2, '.', '');
			
			if(empty($kndate))
			{
				$data['hide_kn'] = '1';
			}			
		}
		
		if(!empty($kndate))
		{
			$this->sql_query = "SELECT * FROM customer_contract WHERE id='$kndate';";
			$kndata = $this->query_fetch(); // This will calculate FK used by specified customer	
			$kn_date_from = $kndata[0]['date_from'];
			$kn_date_to = $kndata[0]['date_to'];
			$granted_kn = intval($kndata[0]['hour']);
			
			$this->sql_query = "SELECT SUM(time_to-time_from) AS kn_sum FROM timetable WHERE DATE BETWEEN '$kn_date_from' AND '$kn_date_to' AND customer='$customer' AND fkkn='2' GROUP BY customer;";
			
			$kn_used = $this->query_fetch(); // This will calculate FK used by specified customer
			
			$kn_used = intval($kn_used[0]['kn_sum']); // FK
			
			$kn_diff = $granted_kn - $kn_used;
	
			$kn_valid_diff = ( ($granted_kn/100) * $per );
			
			$kn_valid_diff = intval($kn_valid_diff);
			
			$kn_valid_lower_range = $granted_kn - $kn_valid_diff;
			$kn_valid_lower_range = intval($kn_valid_lower_range);
			
			$kn_valid_higher_range = $granted_kn + $kn_valid_diff;
			$kn_valid_higher_range = intval($kn_valid_higher_range);
			
			if( ($kn_valid_lower_range <= $kn_used) AND ($kn_used <= $kn_valid_higher_range))
			{
				$kn_text_color = 'BLACK';
			}else{
				$kn_text_color = 'RED';
			}
			
			$data['kn_granted'] = $granted_kn;
			$data['kn_used'] = $kn_used;
			$data['kn_diff'] = $kn_diff;
			$data['kn_color'] = $kn_text_color;
			$data['kn_diff_per'] = ($kn_diff/$granted_kn)*100;	
			$data['kn_diff_per'] = number_format((float)$data['kn_diff_per'], 2, '.', '');
			
			if(empty($fkdate))
			{
				$data['hide_fk'] = '1';	
			}			
		}
		
		return $data;	
	
	}

    function customer_relative_details($relative_id) {

        $this->tables = array('customer_relative');
        $this->fields = array('id', 'name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
        $this->conditions = array('id = ?');
        $this->condition_values = array($relative_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_health($customer_username) {

        $this->tables = array('customer_health');
        $this->fields = array('health_care', 'occupational_therapists', 'physiotherapists', 'other');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_health_add($customer_username) {

        $customer_health = $this->customer_health($customer_username);
        if (!empty($customer_health)) {

            $this->tables = array('customer_health');
            $this->fields = array('health_care', 'occupational_therapists', 'physiotherapists', 'other');
            $this->field_values = array($this->health_care, $this->occupational_therapists, $this->physiotherapists, $this->aiother);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            if ($this->query_update()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            $this->tables = array('customer_health');
            $this->fields = array('customer', 'health_care', 'occupational_therapists', 'physiotherapists', 'other');
            $this->field_values = array($customer_username, $this->health_care, $this->occupational_therapists, $this->physiotherapists, $this->aiother);
            if ($this->query_insert()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function customer_guardian($customer_username) {

        $this->tables = array('customer_guardian');
        $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'address','first_name2', 'last_name2', 'mobile2', 'email2', 'address2');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_guardian_add($customer_username) {

        $customer_guardian = $this->customer_guardian($customer_username);
        if (!empty($customer_guardian)) {

            $this->tables = array('customer_guardian');
            $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'address','first_name2', 'last_name2', 'mobile2', 'email2', 'address2');
            $this->field_values = array($this->guardian_fname, $this->guardian_lname, $this->guardian_mobile, $this->guardian_email, $this->guardian_address,
                                    $this->guardian_fname2, $this->guardian_lname2, $this->guardian_mobile2, $this->guardian_email2, $this->guardian_address2);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            return $this->query_update();
        } else {

            $this->tables = array('customer_guardian');
            $this->fields = array('customer', 'first_name', 'last_name', 'mobile', 'email', 'address','first_name2', 'last_name2', 'mobile2', 'email2', 'address2');
            $this->field_values = array($customer_username, $this->guardian_fname, $this->guardian_lname, $this->guardian_mobile, $this->guardian_email, $this->guardian_address,
                                        $this->guardian_fname2, $this->guardian_lname2, $this->guardian_mobile2, $this->guardian_email2, $this->guardian_address2);
            return $this->query_insert();
        }
    }

    function customer_attachment_document_sting($customer_username) {

        $this->tables = array('customer_attachment');
        $this->fields = array('documents');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];
        return $documents_str;
    }

    function attachment_array($documents_array) {

        $documents = array();
        if (!empty($documents_array)) {
            foreach ($documents_array as $document) {

                $extension = $this->get_file_extension($document);
                if ($extension == "odt") {

                    $icon = "odt_icon.gif";
                } else if ($extension == "pdf") {

                    $icon = "pdf.jpg";
                } else {

                    $icon = "word.jpg";
                }
                if (strlen($document) >= 20) {
                    $filename = substr($document, 0, 20) . '...';
                } else {
                    $filename = $document;
                }
                $documents[] = array('file' => $document, 'name' => $filename, 'icon' => $icon);
            }
        }
        return $documents;
    }

    function customer_attachment_documents($customer_username) {

        $this->tables = array('customer_attachment');
        $this->fields = array('documents');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];
        if ($documents_str != '') {

            $documents = array();
            $documents_array = explode(',', $documents_str);
            foreach ($documents_array as $document) {

                $extension = $this->get_file_extension($document);
                if ($extension == "odt") {

                    $icon = "odt_icon.gif";
                } else if ($extension == "pdf") {

                    $icon = "pdf.jpg";
                } else {

                    $icon = "word.jpg";
                }
                if (strlen($document) >= 20) {
                    $filename = substr($document, 0, 20) . '...';
                } else {
                    $filename = $document;
                }
                $documents[] = array('file' => $document, 'name' => $filename, 'icon' => $icon);
            }

            return $documents;
        } else {

            return FALSE;
        }
    }

    function customer_attachment_documents_add($customer_username, $documents) {

        if (!empty($documents)) {

            $document = implode(',', $documents);
            $this->tables = array('customer_attachment');
            $this->fields = array('documents');
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {

                $this->tables = array('customer_attachment');
                $this->fields = array('documents');
                $this->field_values = array($document);
                $this->conditions = array('customer = ?');
                $this->condition_values = array($customer_username);
                if ($this->query_update()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            } else {

                $this->tables = array('customer_attachment');
                $this->fields = array('customer', 'documents');
                $this->field_values = array($customer_username, $document);
                if ($this->query_insert()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            }
        } else {

            $this->tables = array('customer_attachment');
            $this->fields = array('documents');
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {

                $this->tables = array('customer_attachment');
                $this->fields = array('documents');
                $this->field_values = array("");
                $this->conditions = array('customer = ?');
                $this->condition_values = array($customer_username);
                if ($this->query_update()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            }
        }
    }

    function get_available_works() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        if ($this->works != NULL) {
            $this->conditions = array('AND', array('NOT IN', 'id', $this->works));
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_assigned_works() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->conditions = array('AND', array('IN', 'id', $this->works));
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_available_team() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_work_details($id) {

        $this->tables = array('work');
        $this->fields = array('name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {

            return $data[0]['name'];
        } else {

            return FALSE;
        }
    }

    function customer_work($username) {

        $this->tables = array('customer');
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

    function work_common($customer_username, $employee_username) {

        $employee = new employee();
        $customer_works = $this->customer_work($customer_username);
        $employee_works = $employee->employee_work($employee_username);
        if ($customer_works && $employee_works) {

            $works = array_intersect($customer_works, $employee_works);
            $work_det = array();
            if (!empty($works)) {

                foreach ($works as $work) {
                    if ($work['id'])
                        $work_det[] = array('id' => $work['id'], 'name' => $this->get_work_details($work['id']));
                }
                return $work_det;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    /* ------------------------------------------------shaju----------------------- */

    //removing customer from a particular slot
    function remove_from_slot($id, $alloc_emp = null) {
        $employee = new employee();
        $slot_det = $employee->customer_employee_slot_details($id);
        $this->tables = array('timetable');
        if($alloc_emp == null){
            $this->fields = array('customer', 'status');
            $this->field_values = array(NULL, '0'); 
        }else{
            $this->fields = array('customer', 'status', 'alloc_emp');
            $this->field_values = array(NULL, '0', $alloc_emp);
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            if ($slot_det['customer'] != '')
                $employee->removeATL($slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['customer']);
            return TRUE;
        } else {

            return FALSE;
        }
    }

    //getting slots in memory
    function get_memory_slots($customer, $date) {

        $this->tables = array('memory_slots');
        $this->fields = array('time_from', 'time_to', 'id', 'type');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        $memory_slots = array();
        foreach ($datas as $free_slots) {
            $memory_flag = true;
            $memory_slots[] = array('id' => $free_slots['id'], 'time_from' => $free_slots['time_from'], 'time_to' => $free_slots['time_to'], 'type' => $free_slots['type']);
        }
        return $memory_slots; 
    }

    //Adding customer memory slot
    function add_memory_slot($customer, $time_from, $time_to, $type = 0) {
        $this->tables = array('memory_slots');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer=?', 'time_from=?', 'time_to=?', 'type=?');
        $this->condition_values = array($customer, (float)$time_from, (float)$time_to, $type);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas) == 0) {
            $this->tables = array('memory_slots');
            $this->fields = array('customer', 'time_from', 'time_to', 'type');
            $this->field_values = array($customer, $time_from, $time_to, $type);
            if ($this->query_insert()) {
                return true;
            }
        }
    }

    //removing memory slot
    function remove_memory_slot($id) {
        $this->tables = array('memory_slots');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete())
            return true;
        else
            return false;
    }

    function customer_contract_in_a_day($customer, $date, $fkkn = NULL) {

        $this->tables = array('customer_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', '?', 'date_from', 'date_to'));
        $this->condition_values = array($customer, $date);
        if ($fkkn != NULL || $fkkn != '') {
            if($fkkn == 1)
                $this->conditions[] = 'fkkn = 1';
            elseif($fkkn == 2 || $fkkn == 3)
                $this->conditions[] = array('OR','fkkn = 2','fkkn = 3');
        }
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch(1);
        return (!empty($contract_data) ? $contract_data : FALSE);
    }
    
    function customer_contract_week($customer, $year_week, $fkkn = NULL) {

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
        if ($fkkn != NULL || $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', 'fkkn = ?', array('IN', 'id', $query_inner));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('OR','fkkn = ?','fkkn = 3'), array('IN', 'id', $query_inner));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('OR','fkkn = ?','fkkn = 2'), array('IN', 'id', $query_inner));
            
            $this->condition_values = array($customer, $end_date, $fkkn, $customer, $start_date);
        } else {

            $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($customer, $end_date, $customer, $start_date);
        }
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch(1);
        return (!empty($contract_data) ? $contract_data : FALSE);
    }

    function customer_contract_month($customer, $year_month, $fkkn = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: for getting customer contract records in a month
         */
        $date_params = explode('|', $year_month);
        $year = $date_params[0];
        $month_no = sprintf("%02d", $date_params[1]);
        $first_day_of_month = $year.'-'.$month_no.'-01';
        $start_date = date("Y-m-01", strtotime($first_day_of_month));
        $end_date = date("Y-m-t", strtotime($first_day_of_month));

        $this->tables = array('customer_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'date_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;
        $this->tables = array('customer_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from)+1 AS days', 'hour');
        if ($fkkn != NULL || $fkkn != '') {
            if($fkkn == 1){
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', 'fkkn = ?', array('IN', 'id', $query_inner));
                $this->condition_values = array($customer, $end_date, $fkkn, $customer, $start_date);
            }elseif($fkkn == 2){
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('OR','fkkn = ?','fkkn = 3'), array('IN', 'id', $query_inner));
                $this->condition_values = array($customer, $end_date, $fkkn, $customer, $start_date);
            }elseif($fkkn == 3){
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('OR','fkkn = ?','fkkn = 2'), array('IN', 'id', $query_inner));
                $this->condition_values = array($customer, $end_date, $fkkn, $customer, $start_date);
            }
        } else {

            $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($customer, $end_date, $customer, $start_date);
        }
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch(1);
        return (!empty($contract_data) ? $contract_data : FALSE);
    }

    function customer_contract_week_hour($customer, $year_week, $fkkn = NULL) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $customer_contracts = $this->customer_contract_week($customer, $year_week, $fkkn);
        if ($customer_contracts) {
            //getting customer contacts
            $contract_hour_week = 0;
            $week_days = 7;
            foreach ($customer_contracts as $customer_contract) {

                $contract_hour_day = $customer_contract['hour'] / ($customer_contract['days'] + 1);
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
            return round($contract_hour_week, 2);
        } else 
            return 0;
    }

    function customer_contract_month_hour($customer, $year_month, $fkkn = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: for getting customer contract hours as per month
         */
        $date_params = explode('|', $year_month);
        $year = $date_params[0];
        $month_no = sprintf("%02d", $date_params[1]);
        $first_day_of_month = $year.'-'.$month_no.'-01';
        $start_date = date("Y-m-01", strtotime($first_day_of_month));
        $end_date = date("Y-m-t", strtotime($first_day_of_month));

        $customer_contracts = $this->customer_contract_month($customer, $year_month, $fkkn);
        $contract_hour_month = 0;
        if (!empty($customer_contracts)) {
//            $processing_this_start = $start_date;
            foreach ($customer_contracts as $customer_contract) {
                $contract_hour_day = $customer_contract['hour'] / $customer_contract['days'];
                $this_month_contract_from = $customer_contract['date_from'];
                $this_month_contract_to = $customer_contract['date_to'];
                
                if(date('Y|m', strtotime($this_month_contract_from)) != $year_month)
                        $this_month_contract_from = $start_date;
                if(date('Y|m', strtotime($this_month_contract_to)) != $year_month)
                        $this_month_contract_to = $end_date;
                
                $days_in_this_contract = (strtotime($this_month_contract_to) - strtotime($this_month_contract_from)) / (60 * 60 * 24) + 1;
                $contract_hour_month += ($days_in_this_contract * $contract_hour_day);
//                $processing_this_start = $this_month_contract_to;
            }
        }
        return round($contract_hour_month, 2);
    }

    function customer_timetable_week_time($customer, $year_week, $fkkn = NULL) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        
        //getting time for the week sloat type include normal,travel,break
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,14'));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 3','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,14'));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 2','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,14'));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
        } else {
            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'));
            $this->condition_values = array($customer, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $normal_time = $time_data['total_time'];

        //getting time for the week sloat type oncall
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '3,14'));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 3','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '3,14'));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 2','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '3,14'));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
            $this->query_generate();
            $data_time = $this->query_fetch();
            $time_data = $data_time[0];
            $oncall_time = 0;
            if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) {
                $oncall_time = round(($time_data['total_time'] / 4), 2);
            }

            $total_time = $normal_time + $oncall_time;
        }else
            $total_time = $normal_time;
        
        return sprintf("%.02f", $total_time);
    }

    function customer_timetable_time_between_dates($customer, $date_from, $date_to, $fkkn = NULL) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: for getting customer timetable hours between 2 dates
         */
        
        //getting time for the week slot type include normal,travel,break
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,14'));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 3','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,14'));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 2','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,14'));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
        } else {
            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'));
            $this->condition_values = array($customer, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $normal_time = $time_data['total_time'];

        //getting time for the week sloat type oncall
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '3,14'));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 3','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '3,14'));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 2','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '3,14'));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
            $this->query_generate();
            $data_time = $this->query_fetch();
            $time_data = $data_time[0];
            $oncall_time = 0;
            if ($time_data['total_time'] != '' && $time_data['total_time'] > 0)
                $oncall_time = $time_data['total_time'] / 4;

            $total_time = $normal_time + $oncall_time;
        }else
            $total_time = $normal_time;
        
        return sprintf("%.02f", $total_time);
    }
    
    //excluding trainee
    function customer_timetable_week_time_trainee($customer, $year_week, $fkkn = NULL) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        
        
        //getting time for the week sloat type include normal,travel,break
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {

            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
        } else {

            //$this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'), array('IN', 'employee', $sql_not_trainee));
            //
            //For showing tatal time allotted to customers in grundschema.php
            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'));
            $this->condition_values = array($customer, $date_from, $date_to);
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

            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), 'type = 3');
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
         /*else {

            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), 'type = 3', array('IN', 'employee', $sql_not_trainee));
            $this->condition_values = array($customer, $date_from, $date_to);
        }*/
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $oncall_time = 0;
        if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) {
            $oncall_time = round(($time_data['total_time'] / 4), 2);
        }

        $total_time = $normal_time + $oncall_time;
        }else{
            $total_time = $normal_time;
        }
//        return $total_time;
        return sprintf("%.02f", $total_time);
    }

    //flag=1 for trainee excluding
    function customer_weeks_shedule($customers, $year_week,$flag=0) {

        $date_calc = new datecalc();
        $weeks = $date_calc->get_five_weeks($year_week);
        $week_shedules = array();
        foreach ($customers as $customer) {

            $week_datas = array();
            foreach ($weeks as $week) {

//                $contract = $this->customer_contract_week_hour($customer['username'], $week['year_week']);
                $total_hours = $this->total_work_hours_for_customers_in_single_week($customer['username'], $week['year_week']);
                if($flag == 0)
                    $allocated = $this->customer_timetable_week_time($customer['username'], $week['year_week']);
                else
                    $allocated = $this->customer_timetable_week_time_trainee($customer['username'], $week['year_week']);
                    
//                $week_datas[] = array('week' => $week, 'contract' => $contract, 'allocation' => $allocated);
                $week_datas[] = array('week' => $week, 'total_hours' => $total_hours, 'allocation' => $allocated);
            }
            $week_shedules[] = array('customer' => $customer, 'week_datas' => $week_datas);
        }
        return $week_shedules;
    }

    // get available customers 
    function get_available_customers($employee, $date) {
        $cur_date = strtotime($date . ' 00:00:00');
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('employee=?');
        //$this->condition_values = array($time_from, $time_to, $time_from,$time_to,$time_from,$time_to,$date);
        $this->query_generate();
        $cust_query = $this->sql_query;
        if ($_SESSION['user_role'] == 4) {
            $this->sql_query = "SELECT c.username, c.first_name, c.last_name, c.code FROM customer c 
                WHERE c.username='".$_SESSION['user_id']."'";
        }elseif($_SESSION['user_role'] != 2 && $_SESSION['user_role'] != 7 || $_SESSION['user_id'] == $employee){
            $this->sql_query = "SELECT c.username, c.first_name, c.last_name, c.code FROM customer c 
                INNER JOIN team t1 ON c.username LIKE t1.customer AND t1.employee = '$employee' 
                LEFT JOIN `report_signing` as `r` ON r.customer like c.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.employee ='$employee'     
                WHERE c.status = 1 AND r.customer IS NULL";
            
        }else{
            /*$this->tables = array('customer');
            $this->fields = array('username', 'first_name', 'last_name', 'code');
            $this->conditions = array('AND', 'status=1', array('IN', 'username', $cust_query), array('IN', 'username', $tl_query));
            $this->condition_values = array($employee, $_SESSION['user_id'], $_SESSION['user_role']);*/
            $this->sql_query = "SELECT c.username, c.first_name, c.last_name, c.code FROM customer c 
                INNER JOIN team t1 ON c.username LIKE t1.customer AND t1.employee = '$employee'
                INNER JOIN team t2 ON c.username LIKE t2.customer and t2.employee = '".$_SESSION['user_id']."' AND t2.role='".$_SESSION['user_role']."' 
                LEFT JOIN `report_signing` as `r` ON r.customer like c.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year AND r.employee ='$employee'     
                WHERE c.status = 1 AND r.customer IS NULL";
            
        }
       
        $datas = $this->query_fetch();
        $customers = array();
        foreach ($datas as $data) {
            $contract_hour = $this->customer_contract_week_hour($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $worked_hour = $this->customer_timetable_week_time($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $customers[] = array('username' => $data['username'], 'name' => $data['first_name'] . ' ' . $data['last_name'], 'code' => $data['code'], 'contract_hour' => $contract_hour, 'worked_hour' => $worked_hour);
        }
        if (count($customers)) {

            return $customers;
        } else {
            return false;
        }
        // "select username,first_name,last_name,code from customer where work like('$skill')" ;
    }

    //adding customer to a slot
    function customer_add_to_slot($id, $select_cust, $alloc_emp,$comment=null) {

        $slot_det = $this->customer_employee_slot_details($id);
        $status = $slot_det['status'];

        if ($status != 3 && $slot_det['employee'] != '')
            $status = 1;
        $fkkn = 1;
        if($select_cust != ''){
            $cust_detail = $this->customer_detail($select_cust);
            if(!empty($cust_detail))
                $fkkn = $cust_detail['fkkn'];
        }
        $this->tables = array('timetable');
        if($comment == null){
            $this->fields = array('status', 'customer', 'alloc_emp','fkkn');
            $this->field_values = array($status, $select_cust, $alloc_emp, $fkkn);
        }else{
            $this->fields = array('status', 'customer', 'alloc_emp','fkkn','comment');
            $this->field_values = array($status, $select_cust, $alloc_emp, $fkkn,$comment);
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    // details of a particular slot
    function customer_employee_slot_details($id) {
        $obj_emp = new employee();
        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp','comment','alloc_comment','cust_comment', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $slot = $datas[0];
        $signed_in = 0;
        if($slot['employee'] != '' && $slot['customer'] != '')
           $signed_in =  $obj_emp->chk_employee_rpt_signed($slot['employee'], $slot['customer'], $slot['date']);
           
        $result = array(
            'id'        => $slot['id'], 
            'employee'  => $slot['employee'], 
            'customer'  => $slot['customer'], 
            'date'      => $slot['date'], 
            'slot'      => $slot['time_from'] . '-' . $slot['time_to'], 
            'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to'],100), 
            'status'    => $slot['status'], 
            'type'      => $slot['type'], 
            'fkkn'      => $slot['fkkn'], 
            'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 
            'emp_name'  => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 
            'alloc_emp' => $slot['alloc_emp'], 
            'comment'   => $slot['comment'], 
            'alloc_comment' => $slot['alloc_comment'], 
            'cust_comment' => $slot['cust_comment'], 
            'signed_in' => $signed_in);
        return $result;
    }

    /* ----------------------------------------shaju---------------------------- */

    function get_customer_allocation($user, $start_date, $end_date) {

        $this->tables = array('customer_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'date_to >= ?');
        $this->order_by = array('date_from');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'DATEDIFF(date_to,date_from)', 'hour');
        $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($user, $end_date, $user, $start_date);
        $this->order_by = array('date_from');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return array();
    }

    function get_customer_weekly_allocation($user) {

        $this->tables = array('timetable');
        $this->fields = array('date', 'WEEKOFYEAR(date)', 'DAYNAME(date)', 'time_from', 'time_to');
        $this->conditions = array('AND', 'customer = ?', 'status = \'1\'');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return array();
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


            //getting customer contacts for fk
            $contract_hour_week_fk = $this->customer_contract_week_hour($customer['username'], $year_week, 1); //echo $contract_hour_week_fk . "<br/>";
            //getting customer contacts for kn
            $contract_hour_week_kn = $this->customer_contract_week_hour($customer['username'], $year_week, 2); //echo $contract_hour_week_kn . "<br/>";
            //getting customer allocated time for fk
            $timetable_hour_week_fk = $this->customer_timetable_week_time($customer['username'], $year_week, 1); //echo $timetable_hour_week_fk . "<br/>";
            //getting customer allocated time for kn
            $timetable_hour_week_kn = $this->customer_timetable_week_time($customer['username'], $year_week, 2); //echo $timetable_hour_week_kn . "<br/>";
            //echo $customer['username'].'-'.$contract_hour_week.'-'.$timetable_hour_week;
            if ($contract_hour_week_fk > $timetable_hour_week_fk || $contract_hour_week_kn > $timetable_hour_week_kn) {

                $customer_name = $customer['first_name'] . ' ' . $customer['last_name'];
                $customer_pending[] = array('username' => $customer['username'], 'name' => $customer_name, 'fk' => array('allocate' => $contract_hour_week_fk, 'allocated' => $timetable_hour_week_fk), 'kn' => array('allocate' => $contract_hour_week_kn, 'allocated' => $timetable_hour_week_kn));
            }
        }
        if (count($customer_pending)) {

            return $customer_pending;
        } else {

            return array();
        }
    }

    function customer_data($username) {

        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'fkkn');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_week() {

        global $week;
        return$week;
    }

    /*function customer_week_employee($customer, $year_week) {

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
    }*/
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
    /* --------------------------Shamsu----------------------------- */

    function customer_report($customer, $year, $month) {

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2)');
        $this->conditions = array('AND', 'type = 0', 'employee like e1', 'date like d1', 'work like w1', 'customer like ?', 'status=1');
        $this->query_generate();
        $query_type0 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2)');
        $this->conditions = array('AND', 'type = 1', 'employee like e1', 'date like d1', 'work like w1', 'customer like ?', 'status=1');
        $this->query_generate();
        $query_type1 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2)');
        $this->conditions = array('AND', 'type = 2', 'employee like e1', 'date like d1', 'work like w1', 'customer like ?', 'status=1');
        $this->query_generate();
        $query_type2 = $this->sql_query;


        $this->tables = array('timetable', 'work', 'employee');
        $this->fields = array('timetable.date as d1', 'timetable.work as w1', 'work.name as w_name', 'timetable.employee as e1', 'employee.first_name as emp_name', '(' . $query_type0 . ') as t0', '(' . $query_type1 . ') as t1', '(' . $query_type2 . ') as t2');
        $this->conditions = array('AND', 'timetable.customer like ?', 'month(timetable.date)= ?', 'year(timetable.date)= ?', 'timetable.status=1', 'work.id=timetable.work', 'employee.username like timetable.employee');
        $this->condition_values = array($customer, $customer, $customer, $customer, $month, $year);
        $this->group_by = array('timetable.date', 'timetable.employee', 'timetable.work');
        //$this->order_by = array('timetable.date');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function distinct_customers() {
        $this->tables = array('customer');
        $this->fields = array('distinct(username) as uname', 'concat(first_name," ", last_name) as fullname');
        $this->order_by = array('uname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function distinct_years() {
        $this->tables = array('timetable');
        $this->fields = array('distinct(year(date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function Customer_pdf_report($dataset, $cust_name, $month, $year, $r_heading, $r_sub_head, $col_heading, $total_cap) {
        $pdf = new PDF();
        //$header = array('Date', 'Work', 'Employee', 'Normal', 'Travel', 'Break', 'Total Hour');
        $pdf->AddPage();
        //$pdf->SetFont('Arial','I',8); 
        $pdf->report_Header($r_heading);
        $pdf->SubHeading($r_sub_head, $cust_name, $month, $year);
        $pdf->FancyTable($col_heading, $dataset, $total_cap);
        //$pdf->Footer();
        $pdf->Output();
    }

    /* function customer_add_pdf_report()
      {
      $pdf = new PDF();
      //$header = array('Date', 'Work', 'Customer', 'Normal', 'Travel', 'Break', 'Total Hour');
      $pdf->AddPage();
      //$pdf->SetFont('Arial','B',8);
      $pdf->report_Header($r_heading);
      $pdf->SubHeading($r_sub_head,$emp_name,$month,$year);
      $pdf->FancyTable($col_heading,$dataset,$total_cap);
      //$pdf->Footer();
      $pdf->Output();
      } */

    function employee_social_security_check($social_security) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('company_ids');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($social_security);
        $this->query_generate();
        $datas = $this->query_fetch();
        if ($datas[0]['company_ids'])
            return $datas[0]['company_ids'];
        else
            return false;
    }

    function get_company_db($company_id) {

        $this->tables = array('' . $this->db_master . '.company');
        $this->fields = array('db_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($company_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['db_name'];
    }

    function get_employee_detail($db, $social_security) {

        $this->tables = array('' . $db . '.employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($social_security);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_all_issue_data($customer, $year = null, $month = null,$page = 1) {
        //$result = array();
        $this->tables = array('customer_equipment');
        $this->fields = array('id', 'equipment', 'serial_number', 'issue_date', 'return_date');
        if($year == null && $month == null){
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer);
        }else{
            $this->conditions = array('AND', 'customer = ?', 'month(issue_date) = ?', 'year(issue_date) = ?');
            $this->condition_values = array($customer, $month, $year);
        }
        $this->order_by = array('id DESC');
        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    function get_equipments() {
        $this->tables = array('customer_equipment');
        $this->fields = array('distinct(equipment)');
        //$this->conditions = array('equipment.id = equipment_issue.equipment_id');

        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    function get_serial_number() {
        $this->tables = array('customer_equipment');
        $this->fields = array('distinct(serial_number)');
        //$this->conditions = array('equipment.id = equipment_issue.equipment_id');

        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    function add_equipment_issue($type, $name, $num, $issue, $return, $customer, $employee = NULL, $id=NULL) {
        /* $this->tables =array('equipment');
          $this->fields = array('id');
          //$this->field_values = array();
          $this->conditions = array('name = ?');
          $this->condition_values = array($name);
          $this->query_generate();
          $data = $this->query_fetch(); */

        $issue_date = date('Y-m-d', strtotime($issue));
        if($return == "" || $return == NULL)
           $return_date = NULL; 
        else
            $return_date = date('Y-m-d', strtotime($return));
        if ($type == 1) {
            $this->tables = array('customer_equipment');
            $this->fields = array('equipment', 'customer', 'employee', 'issue_date', 'return_date', 'serial_number');
            $this->field_values = array($name, $customer, $employee, $issue_date, $return_date, $num);
            $data = $this->query_insert();
            if ($data)
                return true;
            else
                return FALSE;
        }
        else if ($type == 2) {

            $this->tables = array('customer_equipment');
            $this->fields = array('equipment', 'customer', 'issue_date', 'return_date', 'serial_number');
            $this->field_values = array($name, $customer, $issue_date, $return_date, $num);
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);

            $data = $this->query_update();
            if ($data)
                return TRUE;
            else
                return FALSE;
        }
    }

    function customer_view() {
        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_dates_equipments($cust = NULL,$type = 1) {
        $this->tables = array('customer_documentation');
        $this->fields = array('id', 'created_date');
        $type_name = '';
        if($type == 1){
            $type_name = 'dokumentation';
        }elseif($type == 2){
            $type_name = 'protokoll';
        }elseif($type == 3){
            $type_name = 'minnesanteckning';
        }
        $this->conditions = array('AND','customer = ?','note_type = ?');
        $this->condition_values = array($cust,$type_name);
        $this->order_by = array('created_date DESC');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }

    function get_documentation_date($id) {

        $this->tables = array('customer_documentation');
        $this->fields = array('id', 'created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status', 'writable');
        $this->conditions = array('AND', 'id = ?');
        $this->condition_values = array($id);
        $this->query_generate();

        $data = $this->query_fetch();
        return $data;
    }

    function insert_documentation($read_write = 0) {
//        $created_date = date('Y-m-d H:i:s', strtotime($this->issue_date));
//        $complete_date = date('Y-m-d H:i:s', strtotime($this->return_date));
        $this->tables = array('customer_documentation');
        if($this->issue_date){
            $this->fields = array('created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status', 'writable');

            $this->field_values = array($this->issue_date, $this->customer, $this->employee, $this->return_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status, $read_write);
        }else{
           $this->fields = array( 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status', 'writable');

            $this->field_values = array( $this->customer, $this->employee, $this->return_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status, $read_write);
         
        }
        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function edit_documentation($id, $read_write = 0) {
        $created_date = date('Y-m-d H:i:s', strtotime($this->issue_date));
        $complete_date = date('Y-m-d H:i:s', strtotime($this->return_date));
        $this->tables = array('customer_documentation');
        $this->fields = array('created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status', 'writable');
        $this->field_values = array($created_date, $this->customer, $this->employee, $complete_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status, $read_write);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
        if ($data)
            return TRUE;
        else
            return FALSE;
    }

    function get_dates_customer_work($cust) {
        $this->tables = array('customer_work');
        $this->fields = array('id', 'date');
        $this->conditions = array("customer = ?");
        $this->condition_values = array($cust);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_customer_works_date($id) {
        $this->tables = array('customer_work');
        $this->fields = array('id', 'customer', 'date', 'work', 'history', 'clinical_picture', 'medications', 'devolution', 'special_diet', 'writable');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function insert_work_customer($read_write = 0) {
        $this->tables = array('customer_work');
        $this->fields = array('customer', 'work', 'history', 'clinical_picture', 'devolution', 'medications', 'special_diet', 'writable');
        $this->field_values = array($this->customer, $this->work, $this->history, $this->clinical_picture, $this->devolution, $this->medications, $this->special_diet, $read_write);

        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function edit_work_customer($id, $read_write = 0) {
        // $date = date('Y-m-d');

        $this->tables = array('customer_work');
        $this->fields = array('customer', 'work', 'history', 'clinical_picture', 'devolution', 'medications', 'special_diet', 'writable');
        $this->field_values = array($this->customer, $this->work, $this->history, $this->clinical_picture, $this->devolution, $this->medications, $this->special_diet, $read_write);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);

        $data = $this->query_update();

        if ($data)
            return TRUE;
        else
            return FALSE;
    }
	
	/********************************************/
	/* Start Viteb Function 					*/
	// This Functions are needed to execute viteb reports
	/********************************************/
	
	
	function calculate_day_difference($fdate,$tdate) // Common function for day difference of two dates
	{
		$start = strtotime($fdate);
		$end = strtotime($tdate);
		$days_between = ceil(abs($end - $start) / 86400)+1;
		return $days_between;
	}
	
	function get_filter_date_report($customer,$fdate,$tdate,$per) 
	{  //-//
            require_once ('class/equipment.php');
			//Calculating for Used FK 
                                        $obj_employee = new employee();
                                        $equipment = new equipment();
                                        $full_emp = 1;
                                        $employees_active = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
                                        if($_SESSION['user_role'] != 1){
                                            $team_role = $obj_employee->get_team_role_of_employee($_SESSION['user_id'], $customer);
                                            if($team_role == 7 || $team_role == 2){
                                                $full_emp = 1;
                                            }else{
                                                $full_emp = 0;
                                            }
                                        }
//                                        $employees_active = $obj_employee->get_team_employees_of_customer($customer, -1);
                        //                echo "<pre>". print_r($employees_active, 1)."</pre>";
//                                        $extra_condition = '(';
//                                        for($i=0;$i<count($employees_active);$i++){
//                                            if($i == count($employees_active)-1){
//                                               $extra_condition = $extra_condition." timetable.employee = '".$employees_active[$i]['username']."'";  
//                                            }
//                                            else{
//                                                $extra_condition = $extra_condition." timetable.employee = '".$employees_active[$i]['username']."' OR "; 
//                                            }
//
//                                        }
//                                        $extra_condition = $extra_condition." )";   	
//					 $this->sql_query = "SELECT SUM(time_to-time_from) AS fk_sum FROM timetable WHERE DATE BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND fkkn='1' GROUP BY customer;";
					
                                        if($full_emp == 1){
                                            $this->sql_query = "SELECT id,time_to,time_from,employee,type FROM timetable WHERE `date` BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND fkkn='1' AND status='1' AND ( employee != '' OR employee != NULL ) AND type NOT IN(1,2,7,8,9,10,11,15) order by employee,date,time_from;";
                                        }else{
                                            $this->sql_query = "SELECT id,time_to,time_from,employee,type FROM timetable WHERE `date` BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND employee='".$_SESSION['user_id']."' AND fkkn='1' AND status='1' AND type NOT IN(1,2,7,8,9,10,11,15) order by employee,date,time_from;";
                                        }
//                                        $fk_used = $this->query_fetch(); // This will calculate FK used by specified customer
                                        $fk_used_temp = $this->query_fetch(); // This will calculate FK used by specified customer
//                                        echo "<pre>". print_r($fk_used_temp, 1)."</pre>";
//                                         echo "<pre>". print_r($fk_used_temp, 1)."</pre>";
                                        $fk_used = array();
                                        $fk_used[0]['fk_sum'] = 0.00;
                                        $normal_sum = 0.00;
                                        $oncall_sum = 0.00;
                                        for($i=0;$i<count($fk_used_temp);$i++){
                                            if($fk_used_temp[$i]['type'] != 3 && $fk_used_temp[$i]['type'] != 14){
                                                $normal_sum = $this->time_sum($normal_sum, $this->time_difference($fk_used_temp[$i]['time_to'],$fk_used_temp[$i]['time_from']));
//                                                $fk_used[0]['fk_sum'] = $fk_used[0]['fk_sum'] + $equipment->time_user_format( $this->time_difference($fk_used_temp[$i]['time_to'],$fk_used_temp[$i]['time_from']),100);
                                            }
//                                            elseif($fk_used_temp[$i]['type'] == 15){
//                                                $t1 = $this->time_difference($fk_used_temp[$i]['time_to'],$fk_used_temp[$i]['time_from']);
//                                                $add_time = $equipment->time_user_format($t1,100)/7;
//                                                $fk_used[0]['fk_sum'] = $fk_used[0]['fk_sum'] + $add_time;
//                                            }
                                            else{
                                                $t1 = $this->time_difference($fk_used_temp[$i]['time_to'],$fk_used_temp[$i]['time_from']);
                                                $oncall_sum = $this->time_sum($oncall_sum,$t1);
//                                                $add_time = $equipment->time_user_format($t1,100)/4;
//                                                $fk_used[0]['fk_sum'] = $fk_used[0]['fk_sum'] + $add_time;
//                                                $a1 = explode(".", $t1);
//                                                $time1 = (($a1[0] * 60 * 60) + ($a1[1] * 60));
//                                                $diff = $time1/4;
//                                                $hours = floor($diff / (60 * 60));
//                                                $mins = floor(($diff - ($hours * 60 * 60)) / (60));
//                                                echo $hours." ".$mins;
//                                                echo "<br>".$result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
//                                                echo $fk_used[0]['fk_sum'];
//                                                echo $fk_used[0]['fk_sum'] = $this->time_sum($fk_used[0]['fk_sum'], $result);
                                            }   
                                        }
                                        $time_oncall = $this->time_divide($oncall_sum, 4);
                                        $fk_used[0]['fk_sum'] = $equipment->time_user_format($this->time_sum($normal_sum,$time_oncall),100);
			//Calculation for Used FK over
			
			//Calculating for Used KN
                                        if($full_emp == 1){
                                            $this->sql_query = "SELECT time_to,time_from,employee,type FROM timetable WHERE `date` BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND (fkkn='2' OR fkkn='3') AND status='1' AND ( employee != '' OR employee != NULL ) AND type NOT IN(1,2,7,8,9,10,11,15);";
					}else{
                                            $this->sql_query = "SELECT time_to,time_from,employee,type FROM timetable WHERE `date` BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND employee='".$_SESSION['user_id']."' AND (fkkn='2' OR fkkn='3') AND status='1' AND type NOT IN(1,2,7,8,9,10,11,15);";
					}
//					$this->sql_query = "SELECT SUM(time_to-time_from) AS kn_sum FROM timetable WHERE DATE BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND fkkn='2' GROUP BY customer;";
//					$kn_used = $this->query_fetch(); // This will calculate KN used by specified customer
					$kn_used_temp = $this->query_fetch();
                                        $kn_used = array();
                                        $kn_used[0]['kn_sum'] = 0.00;
                                        $normal_sum = 0.00;
                                        $oncall_sum = 0.00;
                                        for($i=0;$i<count($kn_used_temp);$i++){
                                            if($kn_used_temp[$i]['type'] != 3 && $kn_used_temp[$i]['type'] != 14){
                                                $normal_sum = $this->time_sum($normal_sum ,$this->time_difference($kn_used_temp[$i]['time_to'],$kn_used_temp[$i]['time_from']));
//                                                $kn_used[0]['kn_sum'] =$kn_used[0]['kn_sum'] + $equipment->time_user_format($this->time_difference($kn_used_temp[$i]['time_to'],$kn_used_temp[$i]['time_from']),100);
                                                
                                            }
//                                            elseif($fk_used_temp[$i]['type'] == 15){
//                                                $t1 = $this->time_difference($kn_used_temp[$i]['time_to'],$kn_used_temp[$i]['time_from']);
//                                                $add_time = $equipment->time_user_format($t1,100)/7;
//                                                $kn_used[0]['kn_sum'] = $kn_used[0]['kn_sum']+$add_time;
//                                            }
                                            else{
                                                $t1 = $this->time_difference($kn_used_temp[$i]['time_to'],$kn_used_temp[$i]['time_from']);
                                                $oncall_sum = $this->time_sum($oncall_sum ,$t1);
//                                                $add_time = $equipment->time_user_format($t1,100)/4;
//                                                $kn_used[0]['kn_sum'] = $kn_used[0]['kn_sum']+$add_time;
//                                                
//                                                
//                                                $a1 = explode(".", $t1);
//                                                $time1 = (($a1[0] * 60 * 60) + ($a1[1] * 60));
//                                                $diff = $time1/4;
//                                                $hours = floor($diff / (60 * 60));
//                                                $mins = floor(($diff - ($hours * 60 * 60)) / (60));
//                                                $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
//                                                $kn_used[0]['kn_sum'] = $this->time_sum($kn_used[0]['kn_sum'], $result);    
                                            }
//                                            echo $i."   ".$kn_used_temp[$i]['time_from']." -- ".$kn_used_temp[$i]['time_to']."    ".$this->time_difference($kn_used_temp[$i]['time_to'],$kn_used_temp[$i]['time_from'])."        ". $fk_used[0]['kn_sum']."         ".$kn_used_temp[$i]['employee']."<br><br>";
                                        }
                                        
			//Calculating for Used KN over
                                        $time_oncall = $this->time_divide($oncall_sum, 4);
                                        $kn_used[0]['kn_sum'] = $this->time_sum($normal_sum ,$time_oncall);
					 $fk_used = sprintf ("%.2f", floatval($fk_used[0]['fk_sum'])); // FK
					$kn_used = sprintf ("%.2f", floatval($kn_used[0]['kn_sum'])); // KN
					
					
			//Calculating for Granted FK
					$this->sql_query = "SELECT * FROM customer_contract WHERE
					( 
					 (date_from BETWEEN '$fdate' AND '$tdate' AND date_to BETWEEN '$fdate' AND '$tdate') 
			 			OR ('$fdate' BETWEEN date_from AND date_to) 
			 			OR ('$tdate' BETWEEN date_from AND date_to) 
			 		)
			 		AND customer='$customer' AND fkkn='1'";
					$granted_fk_arr = $this->query_fetch(); // Fetch all FK granted data come in specified date range
					
					$granted_fk = 0;
					foreach($granted_fk_arr as $gfk)
					{		
						$days = $this->calculate_day_difference($gfk['date_from'],$gfk['date_to']);
								
						$hours_per_day = $gfk['hour']/$days;
//						$hours_per_day = $hours_per_day; // Hours per day in partucular month for FK
						
								
						if( $fdate>=$gfk['date_from'] AND $tdate<=$gfk['date_to'] ) // Specified dates are between db dates
						{
							$calculated_days = $this->calculate_day_difference($fdate,$tdate);
							$temp_granted_fk = floatval($calculated_days) * floatval($hours_per_day);
							$granted_fk = $granted_fk + $temp_granted_fk;
                                                        
						}elseif($fdate<=$gfk['date_from'] AND $tdate>=$gfk['date_to'] )  // Specified dates cover db dates
						{
							$calculated_days = $this->calculate_day_difference($gfk['date_from'],$gfk['date_to']);
							$temp_granted_fk = floatval($calculated_days) * floatval($hours_per_day);
							$granted_fk = $granted_fk + $temp_granted_fk;	
						}elseif( $fdate>=$gfk['date_from'] AND $fdate<=$gfk['date_to']) // First date between db from date and to date
						{
							$calculated_days = $this->calculate_day_difference($fdate,$gfk['date_to']);	
							$temp_granted_fk = floatval($calculated_days) * floatval($hours_per_day);
							$granted_fk = $granted_fk + $temp_granted_fk;
						}elseif( $tdate>= $gfk['date_from'] AND $tdate<=$gfk['date_to'] )
						{
							$calculated_days = $this->calculate_day_difference($gfk['date_from'],$tdate);
							$temp_granted_fk = floatval($calculated_days) * floatval($hours_per_day);
							$granted_fk = $granted_fk + $temp_granted_fk;	
						}
					}
			$granted_fk = sprintf ("%.2f", floatval($granted_fk));
			//Calculating for Granted FK over
			
			//Calculating for Granted KN
					$this->sql_query = "SELECT * FROM customer_contract WHERE
					( 
					 (date_from BETWEEN '$fdate' AND '$tdate' AND date_to BETWEEN '$fdate' AND '$tdate') 
			 			OR ('$fdate' BETWEEN date_from AND date_to) 
			 			OR ('$tdate' BETWEEN date_from AND date_to) 
			 		)
			 		AND customer='$customer' AND (fkkn='2' OR fkkn='3')";
					
					$granted_kn_arr = $this->query_fetch(); // Fetch all KN granted data come in specified date range
					
					$granted_kn = 0;
					
					foreach($granted_kn_arr as $gkn)
					{		
						$days = $this->calculate_day_difference($gkn['date_from'],$gkn['date_to']);
						$hours_per_day = $gkn['hour']/$days;
						$hours_per_day = $hours_per_day; // Hours per day in partucular month for KN
						
						if( $fdate>=$gkn['date_from'] AND $tdate<=$gkn['date_to'] ) // Specified dates are between db dates
						{
							$calculated_days = $this->calculate_day_difference($fdate,$tdate);
							$temp_granted_kn = $calculated_days * $hours_per_day;
							$granted_kn = $granted_kn + $temp_granted_kn;
						}elseif($fdate<=$gkn['date_from'] AND $tdate>=$gkn['date_to'] )  // Specified dates cover db dates
						{
							$calculated_days = $this->calculate_day_difference($gkn['date_from'],$gkn['date_to']);
							$temp_granted_kn = $calculated_days * $hours_per_day;
							$granted_kn = $granted_kn + $temp_granted_kn;	
						}elseif( $fdate>=$gkn['date_from'] AND $fdate<=$gkn['date_to']) // First date between db from date and to date
						{
							$calculated_days = $this->calculate_day_difference($fdate,$gkn['date_to']);	
							$temp_granted_kn = $calculated_days * $hours_per_day;
							$granted_kn = $granted_kn + $temp_granted_kn;
						}elseif( $tdate>= $gkn['date_from'] AND $tdate<=$gkn['date_to'] )
						{
							$calculated_days = $this->calculate_day_difference($gkn['date_from'],$tdate);
							$temp_granted_kn = $calculated_days * $hours_per_day;
							$granted_kn = $granted_kn + $temp_granted_kn;	
						}
					}
			$granted_kn = sprintf ("%.2f", floatval($granted_kn));
			//Calculating for Granted KN over
			
			
			$fk_diff = $granted_fk - $fk_used;
			
			$kn_diff = $granted_kn - $kn_used;
			
			$fk_valid_diff = ( ($granted_fk/100) * $per );
			
			$fk_valid_diff = sprintf ("%.2f", floatval($fk_valid_diff));
			
			$fk_valid_lower_range = $granted_fk - $fk_valid_diff;
			$fk_valid_lower_range = sprintf ("%.2f", floatval($fk_valid_lower_range));
			
			$fk_valid_higher_range = $granted_fk + $fk_valid_diff;
			$fk_valid_higher_range = sprintf ("%.2f", floatval($fk_valid_higher_range));
			
			if( ($fk_valid_lower_range <= floatval($fk_used)) AND (floatval($fk_used) <= $fk_valid_higher_range))
			{
				$fk_text_color = 'BLACK';
			}else{
				$fk_text_color = 'RED';
			}
			
			$kn_valid_diff = ( ($granted_kn/100 ) * $per);
			$kn_valid_lower_range = $granted_kn - $kn_valid_diff;
			$kn_valid_lower_range = floatval($kn_valid_lower_range);
			
			$kn_valid_higher_range = $granted_kn + $kn_valid_diff;
			$kn_valid_higher_range = floatval($kn_valid_higher_range);
			
				if( ($kn_valid_lower_range <= $kn_used) AND ($kn_used <= $kn_valid_higher_range))
				{
					$kn_text_color = 'BLACK';
				}else{
					$kn_text_color = 'RED';
				}
				
				$data = array();
				
				$data['fk_granted'] = $granted_fk;
				$data['fk_used'] = $fk_used;
				$data['fk_diff'] = sprintf ("%.2f", $fk_diff);
				$data['fk_color'] = $fk_text_color;
                                if(intval($granted_fk) == 0){
                                  $data['fk_diff_per'] = 0;  
                                }else{
                                    $data['fk_diff_per'] = ($fk_diff/$granted_fk)*100;
                                }
				$data['fk_diff_per'] = number_format((float)$data['fk_diff_per'], 2, '.', '');
				
				$data['kn_granted'] = $granted_kn;
				$data['kn_used'] = $kn_used;
				$data['kn_diff'] = sprintf ("%.2f", $kn_diff);
				$data['kn_color'] = $kn_text_color;
                                if(intval($granted_kn) == 0){
                                  $data['kn_diff_per'] = 0;  
                                }else{
                                    $data['kn_diff_per'] = ($kn_diff/$granted_kn)*100;
                                }
//				$data['kn_diff_per'] = ($kn_diff/$granted_kn)*100;	
				$data['kn_diff_per'] = number_format((float)$data['kn_diff_per'], 2, '.', '');
				return $data;
	}

    function get_date_period($customer, $fkkn) {
        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'customer');
        $this->conditions = array('AND', 'customer = ?','fkkn = ?');
        $this->condition_values = array($customer, $fkkn);
        $this->order_by = array('date_from desc');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_ful_contract_detail($id) {
        //echo "id = ".$id."<br>";
        $result = array();
        $data = array();
        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'hour', 'fkkn');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data1 = $this->query_fetch();
        //print_r($data1);
        $this->tables = array('customer_contract_billing');
        $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'awake', 'oncall2', 'something', 'comments', 'iss', 'sol','kn_name','kn_address','kn_postno','kn_reference_no','kn_box');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data2 = $this->query_fetch();

        $this->tables = array('customer_contract_decision');
        $this->fields = array('first_name AS first', 'last_name AS last', 'mobile AS mob', 'email AS mail', 'city AS cities', 'comments_time', 'comments_other', 'documents');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        //echo $this->sql_query;
        $data3 = $this->query_fetch();

        $result[0] = array('id' => $data1[0]['id'], 'date_from' => $data1[0]['date_from'], 'date_to' => $data1[0]['date_to'], 'hour' => $data1[0]['hour'], 'fkkn' => $data1[0]['fkkn'],
            'first_name' => $data2[0]['first_name'], 'last_name' => $data2[0]['last_name'], 'mobile' => $data2[0]['mobile'], 'email' => $data2[0]['email'], 'city' => $data2[0]['city'], 'oncall' => $data2[0]['oncall'], 'awake' => $data2[0]['awake'], 'oncall2' => $data2[0]['oncall2'], 'something' => $data2[0]['something'], 'comments' => $data2[0]['comments'], 'iss' => $data2[0]['iss'], 'sol' => $data2[0]['sol'],'kn_name' => $data2[0]['kn_name'],'kn_address' => $data2[0]['kn_address'],'kn_postno' => $data2[0]['kn_postno'],'kn_reference_no'=> $data2[0]['kn_reference_no'],'kn_box'=> $data2[0]['kn_box'],
            'first' => $data3[0]['first'], 'last' => $data3[0]['last'], 'mob' => $data3[0]['mob'], 'mail' => $data3[0]['mail'], 'cities' => $data3[0]['cities'], 'comments_time' => $data3[0]['comments_time'], 'comments_other' => $data3[0]['comments_other'], 'documents' => $data3[0]['documents']
        );

        return $result;
    }

    function customer_decision_document_string($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('documents');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];
        return $documents_str;
    }

    function customer_decision_documents($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('documents');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];

        if ($documents_str != '') {

            $documents = array();
            $documents_array = explode(',', $documents_str);
            foreach ($documents_array as $document) {

                $extension = $this->get_file_extension($document);
                if ($extension == "odt") {

                    $icon = "odt_icon.gif";
                } else if ($extension == "pdf") {

                    $icon = "pdf.jpg";
                } else {

                    $icon = "word.jpg";
                }
                if (strlen($document) >= 20) {
                    $filename = substr($document, 0, 20) . '...';
                } else {
                    $filename = $document;
                }
                $documents[] = array('file' => $document, 'name' => $filename, 'icon' => $icon);
            }

            return $documents;
        } else {

//            return FALSE;
            return array();
        }
    }

    function get_file_extension($file) {

        $extension = substr(strrchr($file, '.'), 1);
        return $extension;
    }

    function add_customer_contract($user, $hours, $fromdate, $todate, $fkkn) {
        $from = date('Y-m-d', strtotime($fromdate));
        $to = date('Y-m-d', strtotime($todate));
        $this->tables = array('customer_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fkkn', 'customer');
        $this->field_values = array($hours, $from, $to, $fkkn, $user);
//        $data = $this->query_insert();
//        $id = $this->get_id();
        if ($this->query_insert()){
            $id = $this->get_id();
            return $id;
        }
        else
            return FALSE;
    }

    function customer_contract_billing_insert($id, $fkkn) {
        $this->tables = array('customer_contract_billing');
        if ($fkkn == 2 || $fkkn == 3) {
            $this->fields = array('contract_id', 'kn_name', 'kn_address','kn_postno', 'mobile', 'city', 'oncall', 'oncall2', 'awake', 'something', 'iss', 'sol','kn_reference_no','kn_box');
            $this->field_values = array($id, $this->kn_name, $this->kn_address,$this->kn_postno, $this->b_mobile, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something, $this->b_iss, $this->b_sol,$this->b_kn_ref_num,$this->b_box);
        } else {
            $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something');
            $this->field_values = array($id, $this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something);
        }
        $data2 = $this->query_insert();
        if ($data2)
            return TRUE;
        else
            return FALSE;
    }

    function customer_contract_decision_insert($id) {
        $this->tables = array('customer_contract_decision');
        $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'comments_time', 'comments_other', 'documents');
        $this->field_values = array($id, $this->d_fname, $this->d_lname, $this->d_mobile, $this->d_email, $this->d_city, $this->d_comment_time, $this->d_comment_other, $this->d_document);
        //$this->conditions = array('contract_id')
//        print_r($this->field_values);
//        $data3 = $this->query_insert();


        if ($this->query_insert()){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function customer_contract_update($id, $hours, $fromdate, $todate, $fkkn) {

        $from = date('Y-m-d', strtotime($fromdate));
        $to = date('Y-m-d', strtotime($todate));
        $this->tables = array('customer_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fkkn');
        $this->field_values = array($hours, $from, $to, $fkkn);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
        if ($data)
            return TRUE;
        else
            return FALSE;
    }

    function customer_contract_billing_update($id, $fkkn) {

        $this->tables = array('customer_contract_billing');
        if ($fkkn == 2 || $fkkn == 3) {
            $this->fields = array('kn_name', 'kn_address','kn_postno' ,'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something', 'iss', 'sol','kn_reference_no','kn_box');
            $this->field_values = array($this->kn_name, $this->kn_address,$this->kn_postno, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something, $this->b_iss, $this->b_sol,$this->b_kn_ref_num,$this->b_box);
        } else {
            $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something');
            $this->field_values = array($this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something);
        }

        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $data2 = $this->query_update();
        if ($data2)
            return TRUE;
        else
            return FALSE;
    }

    function customer_contract_decision_update($id) {

        $this->tables = array('customer_contract_decision');

        $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'comments_time', 'comments_other', 'documents');
        $this->field_values = array($this->d_fname, $this->d_lname, $this->d_mobile, $this->d_email, $this->d_city, $this->d_comment_time, $this->d_comment_other, $this->d_document);
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $data3 = $this->query_update();

        if ($data3)
            return TRUE;
        else
            return FALSE;
    }

    function add_new_documents($file_new, $id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('documents');
        $this->field_values = array($file_new);
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();

        if ($data)
            return true;
        else
            return false;
    }

    function check_trainee_employee($employee) {
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username', 'role');
        $this->conditions = array('username = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['role'] == 5) {
            return false;
        } else {
            return true;
        }
    }

    function get_timetable_customer($customer, $from_date, $to_date, $current, $fkkn,$link_from_insurence = 0) {
        $this->tables = array('timetable');

        $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'employee','fkkn');
        if($link_from_insurence == 0){
            if($fkkn == 1){
                $this->conditions = array('AND', 'date BETWEEN ? AND ?', 'fkkn = ?', 'customer = ?', 'type <> 1', 'type <> 2', 'type <> 7', 'type <> 8', 'type <> 9', 'type <> 10', 'type <> 11', 'type <> 15','status = 1');
            }elseif($fkkn == 2)
                $this->conditions = array('AND', 'date BETWEEN ? AND ?', array('OR','fkkn = 3','fkkn = ?'), 'customer = ?','type <> 1', 'type <> 2', 'type <> 7', 'type <> 8', 'type <> 9', 'type <> 10', 'type <> 11', 'type <> 15','status = 1');
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'date BETWEEN ? AND ?', array('OR','fkkn = 2','fkkn = ?'), 'customer = ?', 'type <> 1', 'type <> 2','type <> 7', 'type <> 8', 'type <> 9', 'type <> 10', 'type <> 11', 'type <> 15','status = 1');
        }else{
            $this->conditions = array('AND', 'date BETWEEN ? AND ?', 'fkkn = ?', 'customer = ?', 'type <> 1', 'type <> 2','type <> 7', 'type <> 8', 'type <> 9', 'type <> 10', 'type <> 11', 'type <> 15','status = 1');
        }
        $this->condition_values = array($from_date, $to_date, $fkkn, $customer);
        $this->query_generate();
        $data = $this->query_fetch();
        $oncall_time = "0.00";
        $result = "0.00";
        for ($i = 0; $i < count($data); $i++) {
            if ($this->check_trainee_employee($data[$i]['employee'])) {
                if ($data[$i]['type'] == 3 || $data[$i]['type'] == 14) {
                    $oncall_time = $this->time_sum($oncall_time, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                } else {
                    $result = $this->time_sum($result, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                }
            }
        }
        $time_oncall = $this->time_divide($oncall_time, 4);
        $result = $this->time_sum($result, $time_oncall);
        return $result;
    }


    function time_difference($t1, $t2, $mod=60) {
//        if(floatval($t1) < floatval($t2)){
//            echo "<script>alert('".$t1." ". $t2."')</script>";
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
        if($mod == 100)
            $mins = round($mins*100/60);
        //$result = $hours . "." . sprintf('%02d', $mins);
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
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

    function time_divide($t1, $t2) {
        $a1 = explode(".", $t1);
        $time1 = (($a1[0] * 60 * 60) + (str_pad($a1[1], 2, '0', STR_PAD_RIGHT) * 60));
        $div = floor($time1 / $t2);
        $hours = floor($div / (60 * 60));
        $mins = floor(($div - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . $mins;
        return $result;
    }

    function customer_id_present_decision($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('contract_id');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return TRUE;
        }
        else
            return FALSE;
    }

    function customer_id_present_billing($id) {

        $this->tables = array('customer_contract_billing');
        $this->fields = array('contract_id');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return TRUE;
        }
        else
            return FALSE;
    }

    function oncall_customer($customer, $from, $to) {
        $this->tables = array('timetable');

        $this->fields = array('customer', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'date BETWEEN ? AND ?', 'customer = ?', array('OR','type = 14','type = 3'), 'status = 1');
        $this->condition_values = array($from, $to, $customer);
        $this->query_generate();
        $data = $this->query_fetch();
        $result = "0.00";
        for ($i = 0; $i < count($data); $i++) {

            $result = $this->time_sum($result, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
        }

        return $result;
    }

    function customer_of_employee($emp) {
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'customer <> ""');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->query_generate();
        $data1 = $this->query_fetch();
        $result = array();
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $resut[$i]['username'] = $data[$i]['customer'];
                for ($j = 0; $j < count($data1); $j++) {
                    if ($data[$i]['customer'] == $data1[$j]['username']) {
                        $result[$i]['name'] = $data1[$j]['first_name'] .' '. $data1[$j]['last_name'];
                    }
                }
            }
            return $result;
        } else {
            return array();
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

    function get_company_detail($compony_id) {
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'language', 'logo', 'org_no', 'address', 'email', 'phone', 'mobile', 'website', 'contact_person1', 'contact_person1_email', 'contact_person2', 'contact_person2_email', 'upload_dir', 'status','username1','username2');
        $this->conditions = array('id = ?');
        $this->condition_values = array($compony_id);
        $this->query_generate();
        if ($data = $this->query_fetch()) {
            return $data[0];
        } else {
            return false;
        }
    }

    function mobile_users($mobile_num, $ids) {
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('mobile');
        $this->conditions = array('AND', 'username <> ?', 'mobile = ?','role <> 3');
        $this->condition_values = array($ids, $mobile_num);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    
    /******************************shamsu start***************************/
    
    function non_allocated_customers($year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

//        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
//        echo $week_number = date("W", strtotime($end_date));

//getting all customers
        $customers = $this->customer_list();
        
        $list_customers = array();
        foreach ($customers as $customer) {
            $list_customers[] = $customer['username'];
        }
        $filtered_customer_list =  '\''. implode('\' , \'', $list_customers). '\'';
        $this->tables = array('timetable');
        $this->fields = array('MIN(DATE_FORMAT(date, \'%x|%v\'))');
        $this->conditions = array('AND', 'customer like t.customer', 'date <= ?', 'status != 2',array('OR','employee = ?','employee is NULL'));
//        $this->order_by = array('date');
//        $this->limit = 1;
        $this->query_generate();
        $sub_query = $this->sql_query;
        
        $this->tables = array('timetable` AS `t', 'customer` AS `c');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as total_hours', 't.customer as customer_id', '('. $sub_query .') AS first_date', 'concat(c.last_name, " ", c.first_name) as customer_name', 'c.code as code');
        $this->conditions = array('AND', array('IN','t.customer', $filtered_customer_list), 't.date <= ?', array('OR','t.employee = ?','t.employee is NULL'), 'c.username like t.customer','t.status != 2');
//        $this->order_by = array('t.customer', 't.date');
        $this->order_by = array('LOWER(' . $this->db_name . '.c.last_name) collate utf8_bin ASC');
        $this->group_by = array('t.customer');
        $this->condition_values = array($end_date, '', $end_date, '');
        $this->limit = 0;
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $data = $this->query_fetch();
//        echo count($data);
//        $res = array();
//        foreach ($data as $entries) {
////            echo $entries['customer'];
//            if($entries['customer'] == $res[count($res)-1]['customer']){
//                $res[count($res)-1]['customer'] = $entries['customer'];
//                $res[count($res)-1]['total_time'] += ($entries['time_to'] - $entries['time_from']);
//            }else{
//                $res[]['customer'] = $entries['customer'];
//                $res[]['total_time'] = ($entries['time_to'] - $entries['time_from']);
//                $res[]['date'] = $entries['date'];
//            }
//            
//        }
//        echo "<pre>\n".print_r($data, 1)."</pre>";
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    
    
    function total_work_hours_for_customers_in_single_week($customer, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
//        echo $week_number = date("W", strtotime($end_date));
        
        //ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(time_to_sec(timediff(time(replace(cast(time_to as char),\'.\',\':\')) , time(replace(cast(time_from as char),\'.\',\':\')))) )/3600,2) as total_hours');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'),array('IN','status','1,0,3'));
        $this->condition_values = array($customer, $start_date, $end_date);
        $this->query_generate();
//        echo $this->sql_query."<br>";
        $data = $this->query_fetch();
//        echo "<pre>\n".print_r($data, 1)."</pre>";
        if ($data[0]['total_hours'] != "") {
            return $data[0]['total_hours'];
        } else {
            return 0;
        }
    }
    
    
    /******************************shamsu end***************************/
    
    function get_year_implimentation(){
        $this->tables = array('customer_implimentation');
        $this->fields = array('DISTINCT(YEAR(date)) AS year');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function  get_all_implan_print($username,$search_type,$month,$year,$date_from,$date_to,$search_text){
        $this->tables = array('customer_implimentation');
        $this->fields = array('customer','date','history','diagnosis','mission','intervention','travel','work','email','phone','work_comment','travel_comment');
        if($search_type == 1){
            if($search_text == ""){
                $this->conditions = array('customer = ?');
                $this->condition_values = array($username);
            }else{
                $this->conditions = array('AND','customer = ?',array('OR','history LIKE ?','diagnosis LIKE ?','mission LIKE ?','intervention LIKE ?','work LIKE ?','email LIKE ?','phone LIKE ?','work_comment LIKE ?','travel_comment LIKE ?'));
                $this->condition_values = array($username,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%");
            }
            
        }
        else if($search_type == 2){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?','MONTH(date) = ?','YEAR(date) = ?',array('OR','history LIKE ?','diagnosis LIKE ?','mission LIKE ?','intervention LIKE ?','work LIKE ?','email LIKE ?','phone LIKE ?','work_comment LIKE ?','travel_comment LIKE ?'));
                $this->condition_values = array($username,$month,$year,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%");
            }else{
                $this->conditions = array('AND','customer = ?','MONTH(date) = ?','YEAR(date) = ?');
                $this->condition_values = array($username,$month,$year);
            }
            
        }
        else if($search_type == 3){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?','DATE(date) BETWEEN ? AND ?',array('OR','history LIKE ?','diagnosis LIKE ?','mission LIKE ?','intervention LIKE ?','work LIKE ?','email LIKE ?','phone LIKE ?','work_comment LIKE ?','travel_comment LIKE ?'));
                $this->condition_values = array($username,$date_from,$date_to,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%");
            }else{
                $this->conditions = array('AND','customer = ?','DATE(date) BETWEEN ? AND ?');
                $this->condition_values = array($username,$date_from,$date_to);
            }
            
            
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function get_year_work(){
        $this->tables = array('customer_work');
        $this->fields = array('DISTINCT(YEAR(date)) AS year');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function get_all_deswork_print($username,$search_type,$month,$year,$date_from,$date_to,$search_text){
        $this->tables = array('customer_work');
        $this->fields = array('customer','date','work','history','clinical_picture','medications','devolution','special_diet');
        if($search_type == 1){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?',array('OR','work LIKE ?','history LIKE ?','clinical_picture LIKE ?','medications LIKE ?','devolution LIKE ?','special_diet LIKE ?'));
                $this->condition_values = array($username,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%");
            }else{
                $this->conditions = array('customer = ?');
                $this->condition_values = array($username);
            }
        }
        else if($search_type == 2){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?','MONTH(date) = ?','YEAR(date) = ?',array('OR','work LIKE ?','history LIKE ?','clinical_picture LIKE ?','medications LIKE ?','devolution LIKE ?','special_diet LIKE ?'));
                $this->condition_values = array($username,$month,$year,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%");
            }else{
                $this->conditions = array('AND','customer = ?','MONTH(date) = ?','YEAR(date) = ?');
                $this->condition_values = array($username,$month,$year);
            }
        }
        else if($search_type == 3){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?','DATE(date) BETWEEN ? AND ?',array('OR','work LIKE ?','history LIKE ?','clinical_picture LIKE ?','medications LIKE ?','devolution LIKE ?','special_diet LIKE ?'));
                $this->condition_values = array($username,$date_from,$date_to,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%");
            }else{
                $this->conditions = array('AND','customer = ?','DATE(date) BETWEEN ? AND ?');
                $this->condition_values = array($username,$date_from,$date_to);
            }
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    function get_year_documentation(){
        $this->tables = array('customer_documentation');
        $this->fields = array('DISTINCT(YEAR(created_date)) AS year');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    function get_all_documentation_print($username,$search_type,$month,$year,$date_from,$date_to,$search_text,$type){
        $type_name = '';
        if($type == 1){
            $type_name = 'dokumentation';
        }elseif($type == 2){
            $type_name = 'protokoll';
        }elseif($type == 3){
            $type_name = 'minnesanteckning';
        }
        $this->tables = array('customer_documentation');
        $this->fields = array('customer','created_date','completed_date','subject','employee','note_type','notes','priority','description','status');
        if($search_type == 1){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?',array('OR','subject LIKE ?','note_type LIKE ?','notes LIKE ?','priority LIKE ?','description LIKE ?','status LIKE ?'),'note_type = ?');
                $this->condition_values = array($username,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%",$type_name);
            }else{
                $this->conditions = array('customer = ?','note_type = ?');
                $this->condition_values = array($username,$type_name);
            }
            
        }
        else if($search_type == 2){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?','MONTH(created_date) = ?','YEAR(created_date) = ?',array('OR','subject LIKE ?','note_type LIKE ?','notes LIKE ?','priority LIKE ?','description LIKE ?','status LIKE ?'),'note_type = ?');
                $this->condition_values = array($username,$month,$year,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%",$type_name);
            }else{
                $this->conditions = array('AND','customer = ?','MONTH(created_date) = ?','YEAR(created_date) = ?','note_type = ?');
                $this->condition_values = array($username,$month,$year,$type_name);
            }
        }
        else if($search_type == 3){
            if($search_text != ""){
                $this->conditions = array('AND','customer = ?','DATE(created_date) BETWEEN ? AND ?',array('OR','subject LIKE ?','note_type LIKE ?','notes LIKE ?','priority LIKE ?','description LIKE ?','status LIKE ?'),'note_type = ?');
                $this->condition_values = array($username,$date_from,$date_to,"%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%","%".$search_text."%",$type_name);
            }else{
                $this->conditions = array('AND','customer = ?','DATE(created_date) BETWEEN ? AND ?','note_type = ?');
                $this->condition_values = array($username,$date_from,$date_to,$type_name);
            }
        }
        else if($search_type == 4){
            $this->tables = array('note');
            $this->fields = array('customer','date AS created_date','title AS subject','description');
            $this->conditions = array('customer = ?');
            $this->condition_values = array($username);
            
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($search_type == 4){
            for($i=0;$i<count($data);$i++){
                $this->tables = array('employee');
                $this->fields = array('username','first_name','last_name');
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[$i]['employee']);
                $this->query_generate();
                $data1 = $this->query_fetch();
                $data[$i]['employee_name'] = $data1[$i]['first_name']." ".$data1[$i]['last_name'];
            }
        }
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function all_customers_details(){
        $this->tables = array('customer');
        $this->fields = array('first_name','last_name','username','status');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function get_active_customer_count_for_billing() {
        $this->tables = array('customer');
        $this->fields = array('count(username) as count');
        $this->conditions = array('OR', 'status = 1', array('AND', 'status = 0', 'date_inactive >= ?'));
        $this->condition_values = array(date('Y-m-05'));
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function get_active_customers() {
        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
        $this->conditions = array('status = 1');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    //find the entered employee has the right to acceess the particular customer
    //used in gdschema_customer
    
    function is_customer_accessible($username){
        $customers = $this->customer_list();
        $customer_usernames = array();
        foreach($customers as $data){
            $customer_usernames[] = $data['username'];
        }
        if(in_array($username, $customer_usernames)){
            return true;
        }else{
            return false;
        }
    }
    function is_customer_inactive_accessible($username){
        $customers = $this->customer_list_begin();
        $customer_usernames = array();
        foreach($customers as $data){
            $customer_usernames[] = $data['username'];
        }
        if(in_array($username, $customer_usernames)){
            return true;
        }else{
            return false;
        }
    }
    
    function get_customers_employee_list($company){
        $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
        $this->fields = array($this->db_name.'.customer.first_name',$this->db_name.'.customer.last_name',$this->db_name.'.customer.username');
        $this->conditions = array('AND',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_name.'.customer.username = '.$this->db_master.'.login.username');
        
        $this->condition_values = array($company.",%","%,".$company.",%");
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
	
    /******************************shamsu end***************************/
	
	function getCustomerName($userName){
		
		$this->tables  = array("SELECT CONCAT(last_name, ' ', first_name) AS name from customer where username='$userName'");
		
		$this->query_generate_leftjoin();
		$data_name = $this->query_fetch();
		return $data_name[0]['name'];
	}
        
        function getCustomerData($userName){
		
		$this->tables  = array("SELECT * from customer where username='$userName'");
		
		$this->query_generate_leftjoin();
		$data_name = $this->query_fetch();
		return $data_name;
	}
			
	function add_appoiment($arr) {

            $this->tables = array('customer_appoiments',);
            $this->fields = array('customer','appoiment_date', 'appoiment_address', 'phone_number', 'reason','remarks',
                'contact_person_name','phone_number_cp','email_cp','reminder_before_date','reminder_time','repeat_until_due_date',
                'cust_email','email_alert','sms_alert','cust_number');
            $this->field_values = array($arr["customer"],$arr["appoiment_date"], $arr["appoiment_address"], $arr["phone_number"], $arr["reason"],
               $arr["remarks"], $arr["contact_person_name"],$arr["phone_number_cp"], $arr["email_cp"], $arr["reminder_before_date"],
               $arr["reminder_time"], $arr["repeat_until_due_date"],$arr["cust_email"], $arr["email_alert"], $arr["sms_alert"], $arr["cust_number"]);
            $data = $this->query_insert();
            if ($data)
                return true;
            else
                return FALSE;
            		
        }
        
        function update_appoiment($arr, $id) {

            $this->tables = array('customer_appoiments',);
            $this->fields = array('customer','appoiment_date', 'appoiment_address', 'phone_number', 'reason','remarks',
                'contact_person_name','phone_number_cp','email_cp','reminder_before_date','reminder_time','repeat_until_due_date',
                'cust_email','email_alert','sms_alert','cust_number');
            $this->field_values = array($arr["customer"],$arr["appoiment_date"], $arr["appoiment_address"], $arr["phone_number"], $arr["reason"],
               $arr["remarks"], $arr["contact_person_name"],$arr["phone_number_cp"], $arr["email_cp"], $arr["reminder_before_date"],
               $arr["reminder_time"], $arr["repeat_until_due_date"],$arr["cust_email"], $arr["email_alert"], $arr["sms_alert"], $arr["cust_number"]);
               $this->conditions = array('id = ?');
               $this->condition_values = array($id);
              $data = $this->query_update();
            if ($data)
                return true;
            else
                return FALSE;
            		
        }
        
        function get_appoiments($userName, $id="", $month="", $year=""){
		if($id =='' && $month=="" && $year==""){ 
                    $this->tables  = array("SELECT * from customer_appoiments where customer = '$userName' order by id desc");
                }else if($id != ''){    
                    $this->tables  = array("SELECT * from customer_appoiments where id = '$id' order by id desc");
                }else if($month=="" && $year != ""){    
                    $this->tables  = array("SELECT * from customer_appoiments where 
                        year(appoiment_date) = '$year' and customer ='".$userName."' order by id desc");
                }else if($month !="" && $year != ""){    
                    $this->tables  = array("SELECT * from customer_appoiments where year(appoiment_date) = '$year'
                        and month(appoiment_date) = '$month' and customer ='".$userName."' order by id desc");
                   
                }
              //echo "<pre>";print_r($this->tables);
		$this->query_generate_leftjoin();
		$data_name = $this->query_fetch();
		return $data_name;
	}
        
        function delete_appoiments($id){
		if($id !=''){ 
                $this->tables  = array("delete from customer_appoiments where id = '$id'");
		$this->query_generate_leftjoin();
                $this->query_fetch();
		return true;
                }
                return false;
	}
       
        function get_appoiments_reminder(){
                $date = date('Y-m-d H:i:s');
                $this->tables  = array("SELECT * , TIME_TO_SEC(TIMEDIFF(appoiment_date, '$date')) AS totalSecondLeft, c.first_name, c.last_name,
                    TIME_TO_SEC(TIMEDIFF('$date', last_alert_time)) AS last_alert_sent_before
                    FROM customer_appoiments ca
                    LEFT JOIN customer c ON ca.customer = c.username
                    where (ca.email_alert = '1' OR ca.sms_alert = '1') and
                    TIME_TO_SEC(TIMEDIFF(appoiment_date, '$date')) > 0");
               
                
		$this->query_generate_leftjoin();
                $data_name = $this->query_fetch();
		return $data_name;
            
        }
        
        function last_alert_update($id){
            if($id !=''){ 
                $date = date('Y-m-d H:i:s');
                $this->tables  = array("update customer_appoiments set last_alert_time='".$date."' where id = '$id'");
		$this->query_generate_leftjoin();
                $this->query_fetch();
		return true;
            }  
        }
        
        /******************* niyas*************************/
        
        function customer_add_to_slot_multiple($ids, $select_cust, $alloc_emp) {
            $ids_array = explode(',', $ids);
            
            $fkkn = 1;
            if($select_cust != ''){
                $cust_detail = $this->customer_detail($select_cust);
                if(!empty($cust_detail)){
                    $fkkn = $cust_detail['fkkn'];
                }
            }
            
            for($i=0;$i<count($ids_array);$i++){
                $slot_det = $this->customer_employee_slot_details($ids_array[$i]);
                $status = $slot_det['status'];

                if ($status != 3 && $slot_det['employee'] != '')
                    $status = 1;
                $this->tables = array('timetable');
                $this->fields = array('status', 'customer', 'alloc_emp','fkkn');
                $this->field_values = array($status, $select_cust, $alloc_emp, $fkkn);
                $this->conditions = array('id = ?');
                $this->condition_values = array($ids_array[$i]);
               $this->query_update();
                
            }
        }
        /*******************end**************************/
         /*---------------shaju------for salary..............*/
        
        function get_salary_code($company_id){
            
            global $preference, $db;
            $this->tables = array('' . $db['database_master'] . '.company');
            $this->fields = array('salary_system');
            $this->conditions = array('id = ?');
            $this->condition_values = array($company_id);
            $this->query_generate();
            $data = $this->query_fetch();
            if(!empty($data)){
                return $data[0]['salary_system'];
            }
            else{
                return 0;
            }
        }
        
        

        /*--------------shau--------end of salary...........*/
        
        function create_relation_slot($id) {
            /**
            * Author: Shamsu
            * for: create a relation slot (only for leave slot inwhich it have no related slot)
            */
            $return_flag = '';
            $obj_emp = new employee();
            $slot_det = $obj_emp->customer_employee_slot_details($id);
            $related_slot = $obj_emp->check_relations_in_timetable_for_leave($id);
            if($slot_det['id'] == '' || $slot_det['id'] == NULL || empty($slot_det))
                $return_flag = 'SLOT_NOT_EXIST';
            elseif($slot_det['status'] != 2)
                $return_flag = 'NOT_A_LEAVE_SLOT';
            elseif(!empty($related_slot))
                $return_flag = 'ALREADY_HAVE_RELATED_SLOT';
            else{
                if($slot_det['customer'] != ''){
                    $duplicate_slots = array($slot_det['customer'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['type'], $slot_det['fkkn'], '0', $_SESSION['user_id'], $id);
                    $this->flush();
                    $this->tables = array('timetable');
                    $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'fkkn', 'status', 'alloc_emp', 'relation_id');
                    $this->field_values = $duplicate_slots;
                    if ($this->query_insert())
                        $return_flag = 'SUCCESS_CLONE';
                    else
                        $return_flag = 'FAIL_CLONE';
                }else
                    $return_flag = 'FAIL_CLONE';
            }
            return $return_flag;
        }
        
        function timetable_value_filter_date_report($cust,$date_from,$date_to){
            $obj_emp = new employee();
            $employees_display = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
            $extra_condition = array('OR');
            for($i=0;$i<count($employees_display);$i++){
               $extra_condition[] = "tb.employee = '".$employees_display[$i]['username']."'"; 
            }
            $this->tables = array('timetable` AS `tb','employee` AS `emp');
            $this->fields = array('tb.time_from','tb.time_to','tb.date','tb.customer','tb.employee','emp.first_name','emp.last_name','tb.fkkn');
            $this->conditions = array('AND','tb.customer = ?',array('BETWEEN','tb.date','?','?'),'emp.username = tb.employee','tb.status = 1',$extra_condition,'tb.type NOT IN (1,2,7,8,9,10,11,15)');
            $this->condition_values = array($cust,$date_from,$date_to);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
            
        }
        
        function get_customer_monthly_contract($cust,$year,$month,$fkkn){
            $employee = new employee();
            $this->tables = array('customer_contract');
            $this->fields = array('date_from','date_to','hour','fkkn');
            if($fkkn = 1)
                $this->conditions = array('AND','customer = ?',array('OR','YEAR(date_from) = ?','YEAR(date_to) = ?',array('BETWEEN','?','YEAR(date_from)','YEAR(date_to)')),array('OR','MONTH(date_from) = ?','MONTH(date_to) = ?',array('BETWEEN','?','MONTH(date_from)','MONTH(date_to)')),'fkkn = ?');
            else
                $this->conditions = array('AND','customer = ?',array('OR','YEAR(date_from) = ?','YEAR(date_to) = ?',array('BETWEEN','?','YEAR(date_from)','YEAR(date_to)')),array('OR','MONTH(date_from) = ?','MONTH(date_to) = ?',array('BETWEEN','?','MONTH(date_from)','MONTH(date_to)')),array('OR','fkkn = 3','fkkn = ?'));
            $this->condition_values = array($cust,$year,$year,$year,$month,$month,$month,$fkkn);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                $contract_hours = '0.00';
                for($i=0;$i<count($data);$i++){
                    $datediff = strtotime($data[$i]['date_to']) - strtotime($data[$i]['date_from']);
                    $days =  floor($datediff/(60*60*24) + 1);
                    $hour_per_day = round($data[$i]['hour'] / $days,2);
                    $num = cal_days_in_month(CAL_GREGORIAN, sprintf('%02s',$month ), $year);
                    if(strtotime($year.'-'.$month.'-01') >= strtotime($data[$i]['date_from']) && strtotime($year.'-'.$month.'-'.$num) <= strtotime($data[$i]['date_to'])){
                        $hours_of_month = $num * $hour_per_day;
                        $contract_hours = $employee->time_sum($contract_hours,$hours_of_month);
                    }else{
                        if(strtotime($data[$i]['date_from']) < strtotime($year.'-'.$month.'-01') && strtotime($year.'-'.$month.'-'.$num) <= strtotime($data[$i]['date_to'])){
                            $days_of_month = floor((strtotime($year.'-'.$month.'-'.$num) - strtotime($data[$i]['date_from']))/(60*60*24));
                             $hours_of_month = $days_of_month * $hour_per_day;
                            $contract_hours = $employee->time_sum($contract_hours,$hours_of_month);
                        }elseif(strtotime($data[$i]['date_from']) > strtotime($year.'-'.$month.'-01') && strtotime($year.'-'.$month.'-'.$num) > strtotime($data[$i]['date_to'])){
                            $days_of_month = floor((strtotime($data[$i]['date_to']) - strtotime($year.'-'.$month.'-01'))/(60*60*24));
                            $contract_hours = $employee->time_sum($contract_hours,$hours_of_month);
                        }else{
                            $contract_hours = $employee->time_sum($contract_hours,$data[$i]['hour']);
                        }
                    }
                }
                return $contract_hours;
            }else{
                return '0.00';
            }
        }
        
        function get_employees_after_checking_overlap($customer_username,$ids){
            $team = new team();
            $employee_array = array();
            $id_slots = explode("-", $ids);
            $employees_of_customer = $team->employees_for_customer_team($customer_username);
            $this->tables = array('timetable');
            $this->fields = array('time_from','time_to','date');
            $this->conditions[] = 'OR';
            for($i=0;$i<count($id_slots) - 1;$i++){
                $this->conditions[] = 'id = ?';
                $this->condition_values[] = $id_slots[$i];
            }
            $this->query_generate();
            $slots_of_id = $this->query_fetch();
            for($i=0;$i<count($slots_of_id);$i++){
                $left_slot[0] = $slots_of_id[$i]['time_from'];
                $left_slot[1] = $slots_of_id[$i]['time_to'];
                for($j=0;$j<count($slots_of_id);$j++){

                    if($i != $j && $slots_of_id[$i]['date'] == $slots_of_id[$j]['date']){
                       $right_slot[0] = $slots_of_id[$j]['time_from'];
                    $right_slot[1] = $slots_of_id[$j]['time_to'];
                       if(($left_slot[0] > $right_slot[0] && $left_slot[0] < $right_slot[1]) || ($left_slot[1] > $right_slot[0] && $left_slot[1] < $right_slot[1]) || ($left_slot[0] == $right_slot[0] && $left_slot[1] == $right_slot[1])){
                           break; 
                           //break;
                             //echo $left_slot[1]." >= ".$right_slot[1]." && ".$left_slot[1]." <= ".$right_slot[2].") || (".$left_slot[2]." >= ".$right_slot[1]." && ".$left_slot[2]." <= ".$right_slot[2].")";
                       }
                    }
                }
                if($j != count($slots_of_id)){
                    break;
                }
            }
         //   echo $i." ".$j;
            if($i != count($slots_of_id)){
                return array();
            }else{
                $this->tables = array('timetable');
                $this->fields = array('DISTINCT(date)');
                $this->conditions[] = 'OR';
                for($i=0;$i<count($id_slots) - 1;$i++){
                    $this->conditions[] = 'id = ?';
                    $this->condition_values[] = $id_slots[$i];
                }
                $this->query_generate();
                $data = $this->query_fetch();

                // get the ids of the slots with particular date

                
                for($i=0;$i<count($data);$i++){
                    $employee_array[$i]['date'] = $data[$i]['date'];
                    $k = 0;
                    for($j=0;$j<count($employees_of_customer);$j++){
                        $this->tables = array('timetable');
                        $this->fields = array('time_from','time_to','status','date','employee','id');
                        $this->conditions = array('AND','date = ?','employee = ?');
                        $this->condition_values = array($data[$i]['date'],$employees_of_customer[$j]['username']);
                        $this->query_generate();
                        $data1 = $this->query_fetch();
    //                    echo "<pre>". print_r($data1, 1)."</pre>";
                        if($data1){
                            for($h=0;$h<count($data1);$h++){
                                $left_slot[0] = $data1[$h]['time_from'];
                                $left_slot[1] = $data1[$h]['time_to'];
                                for($x=0;$x<count($id_slots);$x++){
                                    if($data1[$h]['id'] != $id_slots[$x]){
                                        $this->tables = array('timetable');
                                        $this->fields = array('time_from','time_to','status','date','employee','id');
                                        $this->conditions = array('AND','date = ?','id = ?');
                                        $this->condition_values = array($data[$i]['date'],$id_slots[$x]);
                                        $this->query_generate();
                                        $check_slot = $this->query_fetch();
                                        if($check_slot){
                                            $right_slot[0] = $check_slot[0]['time_from'];
                                            $right_slot[1] = $check_slot[0]['time_to'];
                                            if(($left_slot[0] > $right_slot[0] && $left_slot[0] < $right_slot[1]) || ($left_slot[1] > $right_slot[0] && $left_slot[1] < $right_slot[1]) || ($left_slot[0] == $right_slot[0] && $left_slot[1] == $right_slot[1])){
                                                break; 
                                           }


                                        }else{
                                            continue;
                                        }
                                    }else{
                                        continue;
                                    }
                                }
                                if($x != count($id_slots)){
                                    break;
                                }
                                
                            }
                            if($h == count($data1)){
                                $employee_array[$i]['emp'][$k] =  $employees_of_customer[$j]['username'];
                                $k++;
                            }
                        }else{
                           $employee_array[$i]['emp'][$k] =  $employees_of_customer[$j]['username'];
                           $k++;
                        }
                    }
                }
            }
            $intersect = $employee_array[0]['emp'];
            for($i=0;$i<count($employee_array);$i++){
                if($i == count($employee_array)-1){
                    break;
                }
                $intersect = array_intersect($employee_array[$i+1]['emp'], $intersect);
//                echo "<pre>". print_r($employee_array[$i], 1)."</pre>";
            }
            if($intersect){
                $this->tables = array('employee');
                $this->fields = array('first_name','last_name','username');
                $this->conditions[] = 'OR';
                foreach($intersect AS $inte){
                     $this->conditions[] = 'username = ?';
                    $this->condition_values[] = $inte;
                }
                $this->query_generate();
                $emp_display = $this->query_fetch();
                return $emp_display;
            }else{
                return array();
            }
        }
        
        
        
        function check_overlap_slots($ids, $emp){
//            $team = new team();
            $id_slots = explode("-", $ids);
            
            // get the distinct date of the slots passed to the function
            $dates = $this->get_distinct_dates_for_slots($id_slots);
            $overlap = '';
            for($i=0;$i<count($dates);$i++){
                $this->flush();
                $this->tables = array('timetable');
                $this->fields = array('time_from','time_to','date','id');
                $this->conditions = array('AND','date = ?');
                $this->condition_values[] = $dates[$i]['date'];
                $conditions = array('OR');
                for($j=0;$j<count($id_slots);$j++){
                   $conditions[] = 'id = ?';
                   $this->condition_values[] = $id_slots[$j];
                }
                $conditions[] = 'employee = ?';
                $this->condition_values[] = $emp;
                $this->conditions[] = $conditions;
                $this->query_generate();
                $data1 = $this->query_fetch();
                $array_count = count($data1);
                for($j=0;$j<$array_count;$j++){
                    $left_slot[0] = $data1[$j]['time_from'];
                    $left_slot[1] = $data1[$j]['time_to'];
                    for($k=0;$k<$array_count;$k++){
                        if($j != $k){
                            $right_slot[0] = $data1[$k]['time_from'];
                            $right_slot[1] = $data1[$k]['time_to'];
                            if(($left_slot[0] > $right_slot[0] && $left_slot[0] < $right_slot[1]) || ($left_slot[1] > $right_slot[0] && $left_slot[1] < $right_slot[1]) || ($left_slot[0] == $right_slot[0] && $left_slot[1] == $right_slot[1])){
                                $overlap = $data1[$j]['date'] . '=>' . $left_slot[0]."-".$left_slot[1]." & ".$right_slot[0]."-".$right_slot[1];
                                break; 
                           }
                        }
                    }
                    if($k != $array_count){
                        break;
                    }
                }
                if($j != $array_count){
                    break;
                }
            }
            if($i != count($dates)){
//                return 'overlap '.$overlap;
                return $overlap;
            }else{
                return 'sucess';
            }
        }
        
        
        // This function returns the distinct dates from the the given ids of the slots
        
    function get_distinct_dates_for_slots($ids){
        $this->tables = array('timetable');
        $this->fields = array('DISTINCT(date) as date');
        $this->conditions[] = 'OR';
        for($i=0;$i<count($ids) - 1;$i++){
            $this->conditions[] = 'id = ?';
            $this->condition_values[] = $ids[$i];
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function check_login_employee_to_access_customer($check_user){
        if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6){
            return TRUE;
        }else if($_SESSION['user_role'] == 3){
             $this->sql_query = "SELECT employee FROM `team` WHERE employee='" . $_SESSION['user_id'] . "' AND customer='". $check_user ."'";
             $datas = $this->query_fetch();
            if(empty($datas))
                return FALSE;
            else
                return TRUE;
        }
        elseif($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
            $this->sql_query = "SELECT employee FROM team WHERE employee='" . $_SESSION['user_id'] . "' AND role='" . $_SESSION['user_role'] ."' 
                                    AND customer='". $check_user ."'";
            $datas = $this->query_fetch();
            if(empty($datas)){
//                $this->sql_query = "SELECT employee FROM `team` WHERE employee='" . $_SESSION['user_id'] . "' AND customer='". $check_user ."'";
//                $dat = $this->query_fetch();
//                if(empty($dat))
//                    return FALSE;
//                else
//                    return TRUE;
                return FALSE;
            }
            else
                return TRUE;
        }
    }
    
    function customers_list_for_employee_report($status = 1, $session_user= '') {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @for: get customers list for employee work report listing
         */
        $user = new user();
        $login_user = $session_user;
        if($session_user == '')
            $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $customer_data = array();
        
        $this->flush();
        switch ($login_user_role) {
            case 1:
            case 6:
                $this->tables = array('customer');
                $this->fields = array('username', 'first_name', 'last_name','mobile', 'email');
                if($status != -1){ //status checking, -1 indiated no need to check status
                    $this->conditions = array('AND', 'status = ?');
                    $this->condition_values = array($status);
                }
                $this->order_by = array('LOWER(last_name)', 'LOWER(first_name)');
                $this->query_generate();
                $customer_data = $this->query_fetch();
                break;
            case 2:
            case 7:
            case 3:
            case 5:
                $obj_employee = new employee();
                $customer_data = $obj_employee->get_team_customers_of_employee($login_user, NULL, $status);
                break;
            case 4:
                $customer_data = array($this->customer_detail($login_user));
                break;
        }
        return $customer_data;
    }
    
    
    function save_sick_form_defaults($this_customer, $uppdrag, $fullmakt, $reference_number, $check_box) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to save sick form values for defaults usage
         */
        $defaults = $this->get_sick_form_defaults($this_customer);
        $check_box_value_string = $check_box['value1'] . '||' . $check_box['value2'] . '||' . $check_box['value3'] . '||' . $check_box['value4'];
        $fullmakt_value_string = $fullmakt['value1'] . '||' . $fullmakt['value2'];
        $result = FALSE;
        if (!empty($defaults)) {
            //updation
            $this->tables = array('sick_form_defaults');
            $this->fields = array('uppdrag', 'fullmakt', 'reference_number', 'check_values');
            $this->field_values = array($uppdrag, $fullmakt_value_string, $reference_number, $check_box_value_string);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($this_customer);
            $result = $this->query_update();
        } else {
            //insertion
            $this->tables = array('sick_form_defaults');
            $this->fields = array('customer', 'uppdrag', 'fullmakt', 'reference_number', 'check_values');
            $this->field_values = array($this_customer, $uppdrag, $fullmakt_value_string, $reference_number, $check_box_value_string);
            $result = $this->query_insert();
        }
        return $result;
    }

    function get_sick_form_defaults($this_customer) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for:  to get sick form default values
         */
        $this->tables = array('sick_form_defaults');
        $this->fields = array('id', 'customer', 'uppdrag', 'fullmakt', 'reference_number', 'check_values');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($this_customer);
        $this->query_generate();
        $records = $this->query_fetch();
        return $records;
    }
}
?>