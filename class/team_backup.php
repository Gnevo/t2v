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

class team extends db {

    //variable diclaration
    var $id = '';
    var $name = '';
    var $tl = '';
    var $members = '';

    function __construct() {

        parent::__construct();
    }

    function team_add() {

        if ($this->name != NULL) {

            $this->tables = array('team');
           // $this->fields = array('name', 'tl', 'members');
           // $this->field_values = array($this->name, $this->tl, $this->members);
		    $this->fields = array('name', 'tl');
            $this->field_values = array($this->name, $this->tl);
		   
            if ($this->query_insert()) {
//echo $this->sql_query;
                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function team_update() {

        if ($this->id != NULL && $this->name != NULL) {

            $this->tables = array('team');
            $this->fields = array('name', 'tl', 'members');
            $this->field_values = array($this->name, $this->tl, $this->members);
            $this->conditions = array('id = ?');
            $this->condition_values = array($this->id);
            if ($this->query_update()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function get_available_members($team_members = NULL) {

        $this->tables = array('employee', 'login');
        $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name');
        if ($team_members != NULL) {
            $this->conditions = array('AND', 'login.role = ?', 'login.username = employee.username', 'employee.status = ?', array('NOT IN', 'employee.username', $team_members));
            $this->condition_values = array(3, 1);
        } else {
            $this->conditions = array('AND', 'login.role = ?', 'login.username = employee.username', 'employee.status = ?');
            $this->condition_values = array(3, 1);
        }
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_assigned_employees($team_members) {

        $this->tables = array('employee', 'login');
        $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name');
        $this->conditions = array('AND', 'login.username = employee.username', array('IN', 'employee.username', $team_members));
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function employee_detail($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->conditions = array('AND', array('IN', 'username', $username));
        $this->query_generate();
        //	echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_team_detail() {

        $this->tables = array('team');
        $this->fields = array('id', 'name', 'tl', 'members');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_one_team_detail() {

        $this->tables = array('team');
        $this->fields = array('id', 'name', 'tl', 'members');
        $this->conditions = array('AND', 'id = ?');
        $this->condition_values = array($this->id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_all_team_members() {

        $this->tables = array('team');
        $this->fields = array('GROUP_CONCAT(members) as members');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_all_team_leaders() {

        $this->tables = array('team');
        $this->fields = array('GROUP_CONCAT(tl) as tl');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_team_leaders() {

        $this->tables = array('team');
        $this->fields = array('GROUP_CONCAT(tl) as tl');
        $this->conditions = array('NOT IN', 'id', $this->id);
        $this->query_generate();
        //	echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_available_teamleaders($team_leaders = NULL) {

        $this->tables = array('employee', 'login');
        $this->fields = array('employee.username as username', 'employee.first_name as first_name', 'employee.last_name ');
        if ($team_leaders != NULL) {
            $this->conditions = array('AND', 'login.role <= ?', 'login.username = employee.username', 'employee.status = ?', array('NOT IN', 'employee.username', $team_leaders));
            $this->condition_values = array(2, 1);
        } else {
            $this->conditions = array('AND', 'login.role <= ?', 'login.username = employee.username', 'employee.status = ?');
            $this->condition_values = array(2, 1);
        }
        $this->query_generate();
        //echo $this->sql_query;
        $result = $this->query_fetch();
        $datas = $this->make_array($result);
        return $datas;
    }

    function make_array($datas = array()) {

        $data_array = array();
        foreach ($datas as $data) {

            $data_array[$data['username']] = $data['first_name'] . $data['last_name'];
        }
        return $data_array;
    }

    function make_quotes($datas = array()) {

        $data_array = explode(",", $datas);

        for ($i = 0; $i < count($data_array); $i++) {
            $data_array[$i] = "'" . $data_array[$i] . "'";
        }

        $data = implode(",", $data_array);
        return $data;
    }

    function get_customer_team_employees($customer,$role,$search,$page){
        $result = array();
        require_once('class/employee.php');
        $employee = new employee();
        $page = $page-1;
        $offset = $page*10;
        if($customer != ""){
            $customer = $this->get_customer_username($customer);
        }
        if($customer == "" && $role == "" && $search == ""){
            $empl = $employee->employee_list_privilege($offset);
            $empl_role = $this->get_employees_with_role($empl);
            return $empl_role;
        }
        if($customer == "" && $role == "" && $search != ""){
            $search = str_replace("_"," ", $search);
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.username',$this->db_name.'.employee.code',$this->db_master.'.login.role');
            $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
            $this->condition_values = array($search);
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data1 = $this->query_fetch();
            if($data1){
                return $data1;
            }else{
                return array();
            }
        }
        if($customer == "" && $role != ""){
            $this->tables = array($this->db_master.'.login',$this->db_name.'.employee');
            $this->fields = array($this->db_master.'.login.username',$this->db_master.'.login.role',$this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.code');
            if($search != "" || $search != null){
                $search = str_replace("_"," ", $search);
                $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%", $search);
            }else{
                $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username');
                $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%");
            }
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }

             
        }
        if($customer != "" && $role == ""){
            $this->tables = array('team','employee');
            $this->fields = array('team.employee AS username','employee.first_name','employee.last_name','employee.code');
            if($search != ""){
                $search = str_replace("_"," ", $search);
                $this->conditions = array('AND','customer = ?','team.employee = employee.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                $this->condition_values = array($customer,$search);
            }else{
                $this->conditions = array('AND','customer = ?','team.employee = employee.username');
                $this->condition_values = array($customer);
            }
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
               for($i=0;$i<count($data);$i++){
                    $this->tables = array($this->db_master.'.login');
                    $this->fields = array('username','role');
                    $this->conditions = array('AND',$this->db_master.'.login.username = ?');
                    $this->condition_values = array($data[$i]['username']);
                    $this->query_generate();
                    $data2 = $this->query_fetch();
                    $data[$i]['role'] = $data2[0]['role'];
                }
                return $data;
               
            }else{
                return array();
            }
            
        }
        if($customer != "" && $role != ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username',$this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_master.'.login.role',$this->db_name.'.employee.code');
            if($search != "" || $search != null){
                $search = str_replace("_"," ", $search);
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                $this->condition_values = array($customer,$role,$search);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?');
                $this->condition_values = array($customer,$role);
            }
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
//            
        }
        
    }
    
    function get_customer_team_employees_count($customer,$role,$search){
        $result = array();
        if($customer != ""){
            $customer = $this->get_customer_username($customer);
        }
        require_once('class/employee.php');
        $employee = new employee();
        if($customer == "" && $role == "" && $search == ""){
            $empl = $employee->employee_list();
            return count($empl);
        }
        if($customer == "" && $role == "" && $search != ""){
            $search = str_replace("_"," ", $search);
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.employee.username) AS count');
            if(strlen($search) == 1){
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','LOWER('.$this->db_name.'.employee.last_name) LIKE ?');
                $this->condition_values = array(strtolower($search)."%");
            }else{
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                $this->condition_values = array($search);
            }
            $this->query_generate();
            $data1 = $this->query_fetch();
            if($data1){
                return $data1[0]['count'];
            }else{
                return array();
            }
        }
        if($customer == "" && $role != ""){
            $this->tables = array($this->db_master.'.login',$this->db_name.'.employee');
            $this->fields = array('COUNT('.$this->db_master.'.login.username) AS count');
            if($search != "" || $search != null){
                if(strlen($search) == 1){
                    $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username','LOWER('.$this->db_name.'.employee.last_name) LIKE ?');
                    $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%", strtolower($search)."%");
                }else{
                     $search = str_replace("_"," ", $search);
                    $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                    $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%", $search);
                }
                
            }else{
                $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username');
                $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%");
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0]['count'];
            }else{
                return array();
            }

             
        }
        if($customer != "" && $role == ""){
            $this->tables = array('team','employee');
            $this->fields = array('COUNT(team.employee) AS count');
            if($search != ""){
                if(strlen($search == 1)){
                    $this->conditions = array('AND','customer = ?','team.employee = employee.username','LOWER('.$this->db_name.'.employee.last_name) LIKE ?');
                    $this->condition_values = array($customer,strtolower($search)."%");
                }else{
                   
                    $this->conditions = array('AND','customer = ?','team.employee = employee.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                    $this->condition_values = array($customer,$search);
                }
                
            }else{
                $this->conditions = array('AND','customer = ?','team.employee = employee.username');
                $this->condition_values = array($customer);
            }
            
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
               for($i=0;$i<count($data);$i++){
                    $this->tables = array($this->db_master.'.login');
                    $this->fields = array('COUNT(username) AS count');
                    $this->conditions = array('AND',$this->db_master.'.login.username = ?');
                    $this->condition_values = array($data[$i]['username']);
                    $this->query_generate();
                    $data2 = $this->query_fetch();
                    $data[$i]['role'] = $data2[0]['role'];
                }
                return $data[0]['count'];
               
            }else{
                return array();
            }
            
        }
        if($customer != "" && $role != ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.employee.username) AS count');
            if($search != "" || $search != null){
                if(strlen($search) == 1){
                    $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?','LOWER('.$this->db_name.'.employee.last_name) LIKE ?');
                    $this->condition_values = array($customer,$role,strtolower($search)."%");
                }else{
                    $search = str_replace("_"," ", $search);
                    $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?');
                    $this->condition_values = array($customer,$role,$search);
                }
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?');
                $this->condition_values = array($customer,$role);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0]['count'];
            }else{
                return array();
            }
//            
        }
        
    }
    
    function get_customer_team_employees_alphabet($customer,$role,$search,$page){
        $result = array();
        if($customer != ""){
            $customer = $this->get_customer_username($customer);
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        require_once('class/employee.php');
        $page=$page-1;
        $offset = $page * 10;
        $employee = new employee();
        if($customer == "" && $role == "" && $search == ""){
            $empl = $employee->employee_list();
            $empl_role = $this->get_employees_with_role($empl);
            return $empl_role;
        }
        if($customer == "" && $role == "" && $search != ""){
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.username',$this->db_master.'.login.role',$this->db_name.'.employee.code');
            $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'));
            $this->condition_values = array(str_replace($convert_from, $convert_to, $search)."%",$search."%");
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data1 = $this->query_fetch();
            if($data1){
                return $data1;
            }else{
                return array();
            }
        }
        if($customer == "" && $role != ""){
            $this->tables = array($this->db_master.'.login',$this->db_name.'.employee');
            $this->fields = array($this->db_master.'.login.username',$this->db_master.'.login.role',$this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.code');
            if($search != "" || $search != null){
                $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'));
                $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%", str_replace($convert_from, $convert_to, $search)."%",$search."%");
            }else{
                $this->conditions = array('AND',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'),$this->db_master.'.login.username = '.$this->db_name.'.employee.username');
                $this->condition_values = array($role,'%,'.$_SESSION['company_id'].",%",$_SESSION['company_id'].",%");
            }
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }

             
        }
        if($customer != "" && $role == ""){
            $this->tables = array('team','employee');
            $this->fields = array('team.employee AS username','employee.first_name','employee.last_name','employee.code');
            if($search != ""){
                $this->conditions = array('AND','customer = ?','team.employee = employee.username',array('OR','employee.last_name LIKE ?','employee.last_name LIKE ?'));
                $this->condition_values = array($customer,str_replace($convert_from, $convert_to, $search)."%",$search."%");
            }else{
                $this->conditions = array('AND','customer = ?','team.employee = employee.username');
                $this->condition_values = array($customer);
            }
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
               for($i=0;$i<count($data);$i++){
                    $this->tables = array($this->db_master.'.login');
                    $this->fields = array('username','role');
                    $this->conditions = array('AND',$this->db_master.'.login.username = ?');
                    $this->condition_values = array($data[$i]['username']);
                    
                    $this->query_generate();
                    $data2 = $this->query_fetch();
                    $data[$i]['role'] = $data2[0]['role'];
                }
                return $data;
               
            }else{
                return array();
            }
            
        }
        if($customer != "" && $role != ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username',$this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_master.'.login.role',$this->db_name.'.employee.code');
            if($search != "" || $search != null){
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'));
                $this->condition_values = array($customer,$role,str_replace($convert_from, $convert_to, $search)."%",$search."%");
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?');
                $this->condition_values = array($customer,$role);
            }
            $this->order_by = array($this->db_name.'.employee.last_name');
            $this->limit = $offset.',10' ;
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
//            
        }
        
    }
    function get_employees_with_role($empl){
        for($i=0;$i<count($empl);$i++){
            $this->tables = array($this->db_master.'.login');
            $this->fields = array('role');
            $this->conditions = array('AND',$this->db_master.'.login.username = ?');
            $this->condition_values = array($empl[$i]['username']);
            $this->query_generate();
            $data = $this->query_fetch();
            $empl[$i]['role'] = $data[0]['role'];
        }
        return $empl;
        
    }
    
    function get_employee_autocomplete($cust,$role){
        if($cust != ""){
            $cust = $this->get_customer_username($cust);
        }
        if($cust != "" && $role != ""){
            $this->tables = array($this->db_master.'.login',$this->db_name.'.team',$this->db_name.'.employee');
            $this->fields = array($this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.code'); 
            $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'));
            $this->condition_values = array($cust,$role,'%,'.$_SESSION['company_id'].'%',$_SESSION['company_id'].'%');
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return  $data;
            }else{
                return array();
            }
              
        }
        else if($cust != ""){
            $this->tables = array($this->db_master.'.login',$this->db_name.'.team',$this->db_name.'.employee');
            $this->fields = array($this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.code');
            $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_name.'.team.employee',$this->db_name.'.team.customer = ?',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'));
            $this->condition_values = array($cust,'%,'.$_SESSION['company_id'].'%',$_SESSION['company_id'].'%');
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return  $data;
            }else{
                return array();
            }
        }
        else if($role != ""){
            $this->tables = array($this->db_master.'.login',$this->db_name.'.employee');
            $this->fields = array($this->db_name.'.employee.first_name',$this->db_name.'.employee.last_name',$this->db_name.'.employee.code');
            $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_master.'.login.role = ?',array('OR',$this->db_master.'.login.company_ids LIKE ?',$this->db_master.'.login.company_ids LIKE ?'));
            $this->condition_values = array($role,'%,'.$_SESSION['company_id'].'%',$_SESSION['company_id'].'%');
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return  $data;
            }else{
                return array();
            }
        }
        else{
            $this->tables = array('employee');
            $this->fields = array('employee.first_name','employee.last_name','employee.code');
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return  $data;
            }else{
                return array();
            }
        }
        
    }
    
    function get_team_employees($role,$customer){
        $this->tables = array('employee','team');
        $this->fields = array('employee.first_name','employee.last_name','employee.username');
        $this->conditions = array('AND','employee.username = team.employee','team.customer = ?','team.role = ?');
        $this->condition_values = array($customer,$role);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    function get_customers_of_employee($empl){
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($empl);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    function remove_employee_privileges($empl){
        $this->tables = array('privileges');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($empl);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
            
    }
    
    function remove_employee_privilege_form($empl){
        $this->tables = array('privileges_forms');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($empl);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
            
    }
    
    function remove_employee_privilege_general($empl){
        $this->tables = array('privileges_general');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($empl);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
            
    }
    
    function remove_employee_privilege_mc($empl){
        $this->tables = array('privileges_mc');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($empl);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
            
    }
    
    function remove_employee_privilege_report($empl){
        $this->tables = array('privileges_reports');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($empl);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
            
    }
    
    function list_employee($cust,$emp,$act,$page,$sort_by){
        
        require_once('class/employee.php');
        require_once('class/setup.php');
        if($cust != ""){
            $cust = $this->get_customer_username_list($cust);
        }
        if($sort_by == "n"){
            $sorting = 'LOWER('.$this->db_name.'.employee.last_name) collate utf8_bin';
        }elseif($sort_by == "el"){
            $sorting = $this->db_master.'.login.error DESC';
        }elseif($sort_by == "r"){
            $sorting = $this->db_master.'.login.role';
        }elseif($sort_by == "lg"){
            $sorting = $this->db_master.'.login.login DESC';
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        if($act == "act"){
            $status = 1;
        }else{
            $status = 0;
        }
        $employee = new employee();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
        $page = $page-1;
        $offset = $page*10;
         if($cust != "" && $emp == ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_name.'.employee.status = ?');
            $this->condition_values = array($cust,$status);
            $this->order_by = array($sorting);
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }
        elseif($cust == "" && $emp != ""){
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.status = ?',$this->db_name.'.employee.last_name NOT LIKE "Ö%"',$this->db_name.'.employee.last_name NOT LIKE "Ä%"',$this->db_name.'.employee.last_name NOT LIKE "Å%"',$this->db_name.'.employee.last_name NOT LIKE "ä%"',$this->db_name.'.employee.last_name NOT LIKE "å%"',$this->db_name.'.employee.last_name NOT LIKE "ö%"');
                $this->condition_values = array(str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($emp,$status);
            }
            $this->order_by = array($sorting);
            $this->limit = $offset.',10';
            $this->query_generate();
//            echo $this->sql_query."<br><br>";
//            print_r($this->condition_values);
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }else if($cust != "" && $emp != ""){
           $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
           
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.status = ?');
                $this->condition_values = array($cust,str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($cust,$emp,$status);
            }
            $this->order_by = array($sorting);
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
            
        }else{
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($status);
            
            $this->order_by = array($sorting);
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
        }
    }
    
    function list_employee_full($cust,$emp,$act,$page){
        require_once('class/employee.php');
        require_once('class/setup.php');
        if($cust != ""){
            $cust = $this->get_customer_username_list($cust);
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        if($act == "act"){
            $status = 1;
        }else{
            $status = 0;
        }
        $employee = new employee();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
        $page = $page-1;
        $offset = $page*10;
         if($cust != "" && $emp == ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_name.'.employee.status = ?');
            $this->condition_values = array($cust,$status);
            $this->order_by = array($this->db_name.'.employee.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }
        elseif($cust == "" && $emp != ""){
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.status = ?');
                $this->condition_values = array(str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($emp,$status);
            }
            $this->order_by = array($this->db_name.'.employee.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
//            echo $this->sql_query."<br><br>";
//            print_r($this->condition_values);
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }else if($cust != "" && $emp != ""){
           $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.status = ?');
                $this->condition_values = array($cust,str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($cust,$emp,$status);
            }
            $this->order_by = array($this->db_name.'.employee.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
            
        }else{
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.employee.username', $this->db_name.'.employee.code', $this->db_name.'.employee.first_name', $this->db_name.'.employee.last_name', $this->db_name.'.employee.social_security', $this->db_name.'.employee.city', $this->db_name.'.employee.phone', $this->db_name.'.employee.mobile', $this->db_name.'.employee.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($status);
            
            $this->order_by = array($this->db_name.'.employee.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
        }
    }
    
    function list_employee_count($cust,$emp,$act){
        require_once('class/employee.php');
        require_once('class/setup.php');
        if($cust != ""){
            $cust = $this->get_customer_username_list($cust);
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        if($act == "act"){
            $status = 1;
        }else{
            $status = 0;
        }
        $employee = new employee();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
        $page = $page-1;
        $offset = $page*10;
         if($cust != "" && $emp == ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.employee.username) AS count');
            $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_name.'.employee.status = ?');
            $this->condition_values = array($cust,$status);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            }
        }
        elseif($cust == "" && $emp != ""){
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.employee.username) AS count');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.status = ?');
                $this->condition_values = array(str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($emp,$status);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            }
        }else if($cust != "" && $emp != ""){
           $this->tables = array($this->db_name.'.team',$this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.employee.username) AS count');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.employee.last_name LIKE ?',$this->db_name.'.employee.last_name LIKE ?'),$this->db_name.'.employee.status = ?');
                $this->condition_values = array($cust,str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.customer = ?',$this->db_name.'.team.employee = '.$this->db_name.'.employee.username',$this->db_name.'.employee.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.employee.last_name," ",'.$this->db_name.'.employee.first_name,"(",'.$this->db_name.'.employee.code,")") = ?',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($cust,$emp,$status);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            } 
            
        }else{
            $this->tables = array($this->db_name.'.employee',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.employee.username) AS count');
            
                $this->conditions = array('AND',$this->db_name.'.employee.username = '.$this->db_master.'.login.username',$this->db_name.'.employee.status = ?');
                $this->condition_values = array($status);
            
            $this->order_by = array($this->db_name.'.employee.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            } 
        }
    }
    
    function customers_team_employee(){
        $this->tables = array('customer');
        $this->fields = array('username','first_name','last_name','code');
        $this->conditions = array('status = 1');
        $this->order_by = array('last_name');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function customers_team_employee_inact(){
        $this->tables = array('customer');
        $this->fields = array('username','first_name','last_name','code');
        $this->conditions = array('status = 0');
        $this->order_by = array('last_name');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function list_customer($cust,$emp,$act,$page){
        require_once('class/customer.php');
        require_once('class/setup.php');
         if($cust != ""){
            $cust = $this->get_employee_username($cust);
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        if($act == "act"){
            $status = 1;
        }else{
            $status = 0;
        }
        $customer = new customer();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
        $page = $page-1;
        $offset = $page*10;
         if($cust != "" && $emp == ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',$this->db_name.'.customer.status = ?');
            $this->condition_values = array($cust,$status);
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }
        elseif($cust == "" && $emp != ""){
            $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.customer.last_name LIKE ?',$this->db_name.'.customer.last_name LIKE ?'),$this->db_name.'.customer.status = ?');
                $this->condition_values = array(str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.customer.last_name," ",'.$this->db_name.'.customer.first_name,"(",'.$this->db_name.'.customer.code,")") = ?',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($emp,$status);
            }
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }else if($cust != "" && $emp != ""){
           $this->tables = array($this->db_name.'.team',$this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.customer.last_name LIKE ?',$this->db_name.'.customer.last_name LIKE ?'),$this->db_name.'.customer.status = ?');
                $this->condition_values = array($cust,str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.customer.last_name," ",'.$this->db_name.'.customer.first_name,"(",'.$this->db_name.'.customer.code,")") = ?',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($cust,$emp,$status);
            }
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
            
        }else{
            $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($status);
            
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
        }
    }
    
    function list_customer_full($cust,$emp,$act,$page){
        require_once('class/customer.php');
        require_once('class/setup.php');
        if($cust != ""){
            $cust = $this->get_employee_username($cust);
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        if($act == "act"){
            $status = 1;
        }else{
            $status = 0;
        }
        $customer = new customer();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
        $page = $page-1;
        $offset = $page*10;
         if($cust != "" && $emp == ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',$this->db_name.'.customer.status = ?');
            $this->condition_values = array($cust,$status);
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
            //$this->limit = $offset.',10';
            $this->query_generate();
           
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }
        elseif($cust == "" && $emp != ""){
            $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.customer.last_name LIKE ?',$this->db_name.'.customer.last_name LIKE ?'),$this->db_name.'.customer.status = ?');
                $this->condition_values = array(str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.customer.last_name," ",'.$this->db_name.'.customer.first_name,"(",'.$this->db_name.'.customer.code,")") = ?',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($emp,$status);
            }
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
            //$this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            }
        }else if($cust != "" && $emp != ""){
           $this->tables = array($this->db_name.'.team',$this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.customer.last_name LIKE ?',$this->db_name.'.customer.last_name LIKE ?'),$this->db_name.'.customer.status = ?');
                $this->condition_values = array($cust,str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.customer.last_name," ",'.$this->db_name.'.customer.first_name,"(",'.$this->db_name.'.customer.code,")") = ?',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($cust,$emp,$status);
            }
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
            
        }else{
            $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array($this->db_name.'.customer.username', $this->db_name.'.customer.code', $this->db_name.'.customer.first_name', $this->db_name.'.customer.last_name', $this->db_name.'.customer.social_security', $this->db_name.'.customer.city', $this->db_name.'.customer.phone', $this->db_name.'.customer.mobile', $this->db_name.'.customer.status',$this->db_master.'.login.role',$this->db_master.'.login.error AS error_login',$this->db_master.'.login.login');
            
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($status);
            
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data;
            }else{
                return array();
            } 
        }
    }
    function list_customer_count($cust,$emp,$act){
        require_once('class/customer.php');
        require_once('class/setup.php');
        if($cust != ""){
            $cust = $this->get_employee_username($cust);
        }
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z",  "ä", "å", "ö",
          );
          $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "Ä", "Å", "Ö", 
          ); 
        if($act == "act"){
            $status = 1;
        }else{
            $status = 0;
        }
        $customer = new customer();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"));
        $page = $page-1;
        $offset = $page*10;
         if($cust != "" && $emp == ""){
            $this->tables = array($this->db_name.'.team',$this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.customer.username) AS count');
            $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',$this->db_name.'.customer.status = ?');
            $this->condition_values = array($cust,$status);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            }
        }
        elseif($cust == "" && $emp != ""){
            $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.customer.username) AS count');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.customer.last_name LIKE ?',$this->db_name.'.customer.last_name LIKE ?'),$this->db_name.'.customer.status = ?');
                $this->condition_values = array(str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.customer.last_name," ",'.$this->db_name.'.customer.first_name,"(",'.$this->db_name.'.customer.code,")") = ?',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($emp,$status);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            }
        }else if($cust != "" && $emp != ""){
           $this->tables = array($this->db_name.'.team',$this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.customer.username) AS count');
            if(strlen($emp) == 1 || $emp == "Ö" || $emp == "Ä" || $emp == "Å"){
                $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',array('OR',$this->db_name.'.customer.last_name LIKE ?',$this->db_name.'.customer.last_name LIKE ?'),$this->db_name.'.customer.status = ?');
                $this->condition_values = array($cust,str_replace($convert_from, $convert_to, $emp)."%",$emp."%",$status);
            }else{
                $this->conditions = array('AND',$this->db_name.'.team.employee = ?',$this->db_name.'.team.customer = '.$this->db_name.'.customer.username',$this->db_name.'.customer.username = '.$this->db_master.'.login.username','CONCAT('.$this->db_name.'.customer.last_name," ",'.$this->db_name.'.customer.first_name,"(",'.$this->db_name.'.customer.code,")") = ?',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($cust,$emp,$status);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            } 
            
        }else{
             $this->tables = array($this->db_name.'.customer',$this->db_master.'.login');
            $this->fields = array('COUNT('.$this->db_name.'.customer.username) AS count');
            
                $this->conditions = array('AND',$this->db_name.'.customer.username = '.$this->db_master.'.login.username',$this->db_name.'.customer.status = ?');
                $this->condition_values = array($status);
            
            $this->order_by = array($this->db_name.'.customer.last_name collate utf8_bin');
//            $this->limit = $offset.',10';
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                return $data[0];
            }else{
                return array();
            } 
        }
    }
    
    function get_customer_username($cust){
        $this->tables = array('customer');
        $this->fields = array('username');
        $this->conditions = array('CONCAT(last_name," ",first_name,"(",code,")") = ?');
        $this->condition_values = array($cust);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['username'];
        }else{
            return "";
        }
    }
    
    function get_customer_username_list($cust){
        $this->tables = array('customer');
        $this->fields = array('username');
        $this->conditions = array('CONCAT(last_name," ",first_name,"(",code,")") = ?');
        $this->condition_values = array($cust);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['username'];
        }else{
            return "";
        }
    }
    
    function get_employee_username($emp){
        $this->tables = array('employee');
        $this->fields = array('username');
        $this->conditions = array('CONCAT(last_name," ",first_name,"(",code,")") = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['username'];
        }else{
            return "";
        }
    }
    
    function employees_for_customer_team($cust){
        $this->tables = array('team','employee');
        $this->fields = array('employee.first_name','employee.last_name','employee.code','employee.username');
        $this->conditions = array('AND','team.employee = employee.username','team.customer = ?');
        $this->condition_values = array($cust);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
        
    }
    
    function customers_for_employee_team($emp){
        $this->tables = array('team','customer');
        $this->fields = array('customer.first_name','customer.last_name','customer.code','customer.username');
        $this->conditions = array('AND','team.customer = customer.username','team.employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
        
    }
    
    /*function employees_for_customer_team_gdschema_alloc($cust,$date){
//        $this->tables = array('team','employee');
//        $this->fields = array('employee.first_name','employee.last_name','employee.code','employee.username');
//        $this->conditions = array('AND','team.employee = employee.username','team.customer = ?');
//        $this->condition_values = array($cust);
//        $this->query_generate();
        $this->tables = array('timetable');
        $this->fields = array('distinct employee');
        $this->conditions = array('AND','customer = ?','date = ?', 'employee <> ""', 'status <> 2');
        $this->query_generate();
        $emp_query = $this->sql_query;
        
        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('customer = ?');
        $this->query_generate();
        $team_emp = $this->sql_query;
        
        $this->tables = array('leave');
        $this->fields = array('distinct employee');
        $this->conditions = array('AND','date = ?', 'status <> 2');
        $this->query_generate();
        $not_emp_query_leave = $this->sql_query;
        
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        
        $this->tables = array('report_signing');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'MONTH(date) = ?', 'YEAR(date) = ?');
        //$this->condition_values = array($date_month, $date_year);
        $this->query_generate();
        $emp_query_sign = $this->sql_query;
        
        $this->tables = array('employee');
        $this->fields = array('first_name','last_name','code','username');
        $this->conditions = array('AND',array('OR',array('IN', 'username', $emp_query),array('IN', 'username', $team_emp)), array('NOT IN', 'username', $not_emp_query_leave), array('NOT IN', 'username', $emp_query_sign));
        $this->condition_values = array($cust,$date,$cust,$date,$date_month,$date_year);
        $this->query_generate();
        $data = $this->query_fetch();
        
        if($data){
            $result = array();
            $i=0;
            foreach($data AS $employees){
                $result[$i] = $employees;
                $this->tables = array('timetable');
                $this->fields = array('time_from','time_to');
                $this->conditions = array('AND','employee = ?','date = ?');
                $this->condition_values = array($employees['username'],$date);
                $datas = $this->query_fetch();
                $result[$i]['time_slot'] = $datas;
                $i++;
            }
            //echo "<pre>".print_r($result,1)."</pre>";
            return $result;
        }else{
            return array();
        }
        
    }*/
    
    function employees_for_customer_team_gdschema_alloc($cust,$date){

        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        
        $this->sql_query = "SELECT e.username, e.first_name, e.last_name, e.code, e.mobile FROM `employee` as `e` 
                            INNER JOIN `team` as `tm` ON tm.employee like e.username AND tm.customer='$cust' AND e.status=1   
                            LEFT JOIN `report_signing` as `r` ON r.employee like e.username AND MONTH(r.date) = $date_month AND YEAR(r.date) = $date_year 
                            LEFT JOIN  `leave` as `l` ON l.employee like e.username AND l.date='$date' AND l.status!=2 AND l.time_from=0.00 AND l.time_to=24.00
                            where r.employee IS NULL  AND l.employee IS NULL";
        $data = $this->query_fetch();
        
        if($data){
            $result = array();
            $i=0;
            foreach($data AS $employees){
                $result[$i] = $employees;
//                $this->tables = array('timetable');
//                $this->fields = array('time_from','time_to');
//                $this->conditions = array('AND','employee = ?','date = ?');
//                $this->condition_values = array($employees['username'],$date);
                $this->sql_query = "SELECT time_from, time_to FROM timetable WHERE employee= '".$employees['username']."' AND date='$date' 
                                    UNION SELECT time_from, time_to FROM `leave` WHERE employee= '".$employees['username']."' AND date='$date'";
                $datas = $this->query_fetch();
                $result[$i]['time_slot'] = $datas;
                $i++;
            }
            //echo "<pre>".print_r($result,1)."</pre>";
            return $result;
        }else{
            return array();
        }
        
    }
    
    function employees_for_customer_team_with_timeslot($employees_of_customer,$date){
        $result = array();
        $i=0;
        foreach($employees_of_customer AS $employees){
            $result[$i] = $employees;
            $this->tables = array('timetable');
            $this->fields = array('time_from','time_to');
            $this->conditions = array('AND','employee = ?','date = ?');
            $this->condition_values = array($employees['username'],$date);
            $this->query_generate();
            $datas = $this->query_fetch();
            $j = 0;
            foreach($datas AS $data){
                $result[$i]['time_slot'][$j]['time_from'] = $data['time_from'];
                $result[$i]['time_slot'][$j]['time_to'] = $data['time_to'];
                $j++;
            }
            $i++;
        }
        
    }
    function customers_for_employee_team_gdschema_alloc($emp,$date){
        $cur_date = strtotime($date . ' 00:00:00');

        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('employee=?');
        //$this->condition_values = array($time_from, $time_to, $time_from,$time_to,$time_from,$time_to,$date);
        $this->query_generate();
        $cust_query = $this->sql_query;
        if ($_SESSION['user_role'] == 4) {
            $cust_query = "'" . $_SESSION['user_id'] . "'";
        }

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name', 'code');
        $this->conditions = array('AND', 'status=1', array('IN', 'username', $cust_query));
        if ($_SESSION['user_role'] != 4) {
            $this->condition_values = array($emp);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
       
        if ($datas) {

            return $datas;
        } else {
            return array();
        }
    }

}

?>
