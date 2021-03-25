<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('class/db.php');
require_once ('configs/config.inc.php');

/**
 * Description of customer_ai
 *
 * @author dona
 */
class customer_ai extends db {

    var $username = '';
    //implimentation plan variables
    var $implementation_id = '';
    var $implementation_date = '';
    var $implementation_history = '';
    var $implementation_diagnosis = '';
    var $implementation_mission = '';
    var $implementation_intervention = '';
    var $implementation_travel = '';
    var $implementation_work = '';
    var $implementation_email = '';
    var $implementation_phone = '';
    var $implementation_work_comment = '';
    var $implementation_travel_comment = '';

    /* function customer_detail($customer_username, $name = NULL) {

      $this->tables = array('customer');
      $this->fields = array('username', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status');
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
      $this->fields = array('name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
      $this->conditions = array('customer = ?');
      $this->condition_values = array($customer_username);
      $this->query_generate();
      $datas = $this->query_fetch();
      return $datas;
      }

      function customer_health($customer_username) {

      $this->tables = array('customer_helth');
      $this->fields = array('helth_care', 'occupational_therapists', 'physiotherapists', 'other');
      $this->conditions = array('customer = ?');
      $this->condition_values = array($customer_username);
      $this->query_generate();
      $datas = $this->query_fetch();
      return $datas[0];
      }

      function customer_guardian($customer_username) {

      $this->tables = array('customer_guardian');
      $this->fields = array('first_name', 'last_name', 'mobile', 'email');
      $this->conditions = array('customer = ?');
      $this->condition_values = array($customer_username);
      $this->query_generate();
      $datas = $this->query_fetch();
      return $datas[0];
      } */

    function customer_team($customer_username) {

        $this->tables = array('team', 'employee');
        $this->fields = array('team.employee AS employee', 'employee.first_name AS first_name', 'employee.last_name AS last_name', 'team.role AS role');
        $this->conditions = array('AND', 'team.employee = employee.username', 'team.customer = ?');
        $this->condition_values = array($customer_username);
		$this->order_by = array('team.orderId');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function customer_allocated_employees($customer_username) {

        $employee_list = array();
        $team = $this->customer_team($customer_username);
        foreach ($team as $employee) {

            $employee_list[] = $employee['employee'] . ':' . $employee['role'];
        }
        return $employee_list;
    }

    function customer_team_members($customer_username) {

        $employee_list = array();
        $team = $this->customer_team($customer_username);
        foreach ($team as $employee) {

            $employee_list[] = $employee['employee'];
        }
        return $employee_list;
    }

    function customer_alocate_employee($employees, $tl = '',$stl = "") {

        $employee_list = array();
        foreach ($employees as $employee) {

            $this->tables = array('employee');
            $this->fields = array('username', 'first_name', 'last_name', '(SELECT role FROM ' . $this->db_master . '.login WHERE username = \'' . $employee . '\') AS user_role','code');
            $this->conditions = array('username = ?');
            $this->condition_values = array($employee);
            $this->query_generate();
            $data = $this->query_fetch();
            $tl_status = 0;
            $stl_status = 0;
            if ($data[0]['username'] == $tl) {
                $tl_status = 1;
            }
            if ($data[0]['username'] == $stl) {
                $stl_status = 1;
            }
            $employee_list[] = array('username' => $data[0]['username'], 'name' => $data[0]['last_name'] . ' ' . $data[0]['first_name'], 'user_role' => $data[0]['user_role'], 'tl' => $tl_status ,'stl' => $stl_status,'code' => $data[0]['code']);
        }
        return $employee_list;
    }

    function customer_employee_list() {

        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->order_by = array('last_name');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();

        return $datas;
    }

    function customer_employee_listtoallocate($allocated) {

        for ($i = 0; $i < count($allocated); $i++) {
            if ($i == 0) {
                $result = array('AND');
            }
            $result[] = 'employee.username <> "' . $allocated[$i]['username'] . '"';
        }
        $result[] = $this->db_master . '.login.username = employee.username';
         $this->tables = array('employee',$this->db_master . '.login');
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code');
        $this->conditions = $result;
        $this->order_by = array('employee.last_name');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function customer_team_leader($customer_username) {

        $this->tables = array('team', 'employee');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'customer = ?', 'role = 2', 'team.employee = employee.username', 'employee.status = 1');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas[0];
    }
    function customer_super_team_leader($customer_username) {
        $this->tables = array('team', 'employee');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'team.customer = ?', 'team.role = 7', 'team.employee = employee.username', 'employee.status = 1');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }
    

    function customer_team_employee($customer = '', $key = '', $type = 'all', $not = array(), $users = array()) {
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
            );
            $convert_from = array(
              "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
              "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
            );
        if ($type == 'toadd') {
            $method = 0;
            $not_employee = '';
            if (!empty($not)) {
                $not_employee = '\'' . implode('\',\'', $not) . '\'';
            }
            if(strlen($key) == 1 || $key == "Ä" || $key == "Å" || $key == "Ö" || $key == "ä" || $key =="å" || $key == "ö" || $key == "É" || $key == "é"){
                $method = 1;
                if(in_array($key, $convert_to)){
                    $key1 = str_replace($convert_to, $convert_from, $key);

                }else if(in_array($key, $convert_from)){
                   $key1 = str_replace($convert_from, $convert_to, $key);
                }
                
            }else{
                $key = strtolower($key);
                $key1 = strtoupper($key);
            }
            $this->tables = array('employee',$this->db_master . '.login');
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code');
            if($method == 1){
                $this->conditions = array('AND', array('OR',  'employee.last_name LIKE ?',  'employee.last_name LIKE ?',  'employee.first_name LIKE ?',  'employee.first_name LIKE ?','employee.code LIKE ?'), array('NOT IN', 'employee.username', $not_employee),$this->db_master . '.login.username = employee.username' ,'status = 1');
            }else{
                $this->conditions = array('AND', array('OR',  'UPPER(employee.last_name) LIKE ?',  'LOWER(employee.last_name) LIKE ?',  'UPPER(employee.first_name) LIKE ?',  'LOWER(employee.first_name) LIKE ?','employee.code LIKE ?'), array('NOT IN', 'employee.username', $not_employee),$this->db_master . '.login.username = employee.username' ,'status = 1');
            }
            $this->condition_values = array($key1."%",$key."%",$key1."%",$key."%",$key."%");
            $this->order_by = array('employee.last_name');
            $this->query_generate();
            $datas = $this->query_fetch();
        } else if ($type == 'listed') {

            if (!empty($users)) {
                $employees = '\'' . implode('\',\'', $users) . '\'';
                $this->tables = array('employee',$this->db_master . '.login');
                $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code');
                $this->conditions = array('AND', array('IN', 'employee.username', $employees),$this->db_master . '.login.username = employee.username' ,'status = 1');
                $this->order_by = array('employee.last_name');
                $this->query_generate();
                $datas = $this->query_fetch();
            }
        } else if ($type == 'toalloc') {

            if (!empty($users)) {
                $employees = '\'' . implode('\',\'', $users) . '\'';
                $this->tables = array('employee',$this->db_master . '.login');
                $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code');
                $this->conditions = array('AND', array('IN', 'employee.username', $employees), $this->db_master . '.login.username = employee.username','status = 1');
                $this->order_by = array('employee.last_name');
                $this->query_generate();
                $datas = $this->query_fetch();
            }
        } else {
            
            $method = 0;
            if(strlen($key) == 1 || $key == "Ä" || $key == "Å" || $key == "Ö" || $key == "ä" || $key =="å" || $key == "ö" || $key == "É" || $key == "é"){
                $method = 1;
                if(in_array($key, $convert_to)){
                    $key1 = str_replace($convert_to, $convert_from, $key);

                }else if(in_array($key, $convert_from)){
                   $key1 = str_replace($convert_from, $convert_to, $key);
                }
                
            }else{
                $key = strtolower($key);
                $key1 = strtoupper($key);
            }
            $this->tables = array('employee',$this->db_master . '.login');
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code');
            if($method == 1){
                $this->conditions = array('AND', array('OR', 'employee.last_name LIKE ?',  'employee.last_name LIKE ?','employee.first_name LIKE ?',  'employee.first_name LIKE ?','employee.code LIKE ?'), $this->db_master . '.login.username = employee.username', 'status = 1');
            }else{
                $this->conditions = array('AND', array('OR', 'UPPER(employee.last_name) LIKE ?',  'LOWER(employee.last_name) LIKE ?',  'UPPER(employee.first_name) LIKE ?',  'LOWER(employee.first_name) LIKE ?','employee.code LIKE ?'), $this->db_master . '.login.username = employee.username', 'status = 1');
            }
            $this->conditions = array('AND', array('OR', 'employee.last_name LIKE ?',  'employee.last_name LIKE ?','employee.first_name LIKE ?',  'employee.first_name LIKE ?','employee.code LIKE ?'), $this->db_master . '.login.username = employee.username', 'status = 1');
            $this->condition_values = array($key1."%",$key."%",$key1."%",$key."%",$key."%");
            $this->order_by = array('employee.last_name');
            $this->query_generate();
            //echo $this->sql_query;
            $datas = $this->query_fetch();
        }

        return $datas;
    }

    function customer_implementation_dates($username) {

        $this->tables = array('customer_implimentation');
        $this->fields = array('id', 'date');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $result = $this->query_fetch();
        return $result;
    }

    function make_array($datas = array()) {

        $data_array = array();
        foreach ($datas as $data) {
            $data_array[$data[0]] = $data[1];
        }
        return $data_array;
    }

    function customer_implementation_details($id) {

        $this->tables = array('customer_implimentation');
        $this->fields = array('id', 'customer', 'date', 'history', 'diagnosis', 'mission', 'intervention', 'travel', 'work', 'email', 'phone', 'work_comment', 'travel_comment', 'writable');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
           $result = $data[0];
            $travel = explode(',', $result['travel']);
            $result['travel'] = $travel; 
            return $result;
        }else{
            return array();
        }
    }

    function customer_implementation_add($read_write = 0) {

        $this->tables = array('customer_implimentation');
        $this->fields = array('customer', 'history', 'diagnosis', 'mission', 'intervention', 'travel', 'work', 'email', 'phone', 'work_comment', 'travel_comment', 'writable');
        $this->field_values = array($this->username, $this->implementation_history, $this->implementation_diagnosis, $this->implementation_mission, $this->implementation_intervention, $this->implementation_travel, $this->implementation_work, $this->implementation_email, $this->implementation_phone, $this->implementation_work_comment, $this->implementation_travel_comment, $read_write);
        if ($this->query_insert()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    function customer_implementation_update($read_write = 0) {
        
        $this->tables = array('customer_implimentation');
        $this->fields = array('history', 'diagnosis', 'mission', 'intervention', 'travel', 'work', 'email', 'phone', 'work_comment', 'travel_comment', 'writable');
        $this->field_values = array($this->implementation_history, $this->implementation_diagnosis, $this->implementation_mission, $this->implementation_intervention, $this->implementation_travel, $this->implementation_work, $this->implementation_email, $this->implementation_phone, $this->implementation_work_comment, $this->implementation_travel_comment, $read_write);
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->implementation_id);
        if ($this->query_update()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    function customer_team_add($customer, $employees = NULL, $tl = NULL,$stl =NULL) {

        $this->tables = array('team');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        if ($this->query_delete()) {

            if ($employees != '' || $employees != NULL) {
                
                $datas = array();
                foreach ($employees as $employee) {
                    $role = 3;
                    if ($employee == $tl) {
                        $role = 2;
                    }
                    if($employee == $stl){
                        $role = 7;
                    }

                    $datas[] = array($customer, $employee, $role);
                }

                $this->tables = array('team');
                $this->fields = array('customer', 'employee', 'role');
                $this->field_values = $datas;
                if ($this->query_insert()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            } else {
                
                return TRUE;
            }
            
        } else {

            return FALSE;
        }
    }

    function customer_list() {

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->order_by = array('first_name');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

}

?>
