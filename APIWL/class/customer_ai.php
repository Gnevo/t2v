<?php
require_once ('configs/config.inc.php');
require_once ('class/db.php');


/**
 * Description of customer_ai
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
    
    //customer - 3066
    var $customer = NULL;
    var $employee = NULL;
    var $is_assi_have_pa = NULL;
    var $is_assi_resi_outside_ees = NULL;
    var $assi_resi_outside_ees = NULL;
    var $changes_applies_from = NULl;
    var $i_own_employer = NULL;
    var $hire_assi_provider = NULL;
    var $company_cp_name = NULL;
    var $company_cp_phone = NULL;
    var $is_organizer_employers_assi = NULL;
    var $name_of_another_employer = NULL;
    var $another_employer_org_no = NULL;
    var $signing_date = NULL;
    var $signing_employee = NULL;
    var $new_implan_name = array();
    var $new_implan_description = array();
    var $new_implan_name_employee = array();

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

    function customer_team($customer_username, $except_roles = array()) {

        $this->tables = array('team', 'employee');
        $this->fields = array('DISTINCT team.employee AS employee', 'employee.first_name AS first_name', 'employee.last_name AS last_name', 'employee.social_security AS social_security', 'employee.century AS century', 'employee.date AS activation_date', 'team.role AS role');
        $this->conditions = array('AND', 'team.employee = employee.username', 'team.customer = ?', 'employee.status = 1');
        $this->condition_values = array($customer_username);

        if(!empty($except_roles)){
            $this->conditions[] = array('NOT IN', 'team.role', $except_roles);
        }

        $this->order_by = array('team.orderId');
        
        if ($_SESSION['company_sort_by'] == 1)
            $this->order_by = array_merge($this->order_by, array('LOWER(employee.first_name) collate utf8_bin', 'LOWER(employee.last_name) collate utf8_bin'));
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->order_by = array_merge($this->order_by, array('LOWER(employee.last_name) collate utf8_bin', 'LOWER(employee.first_name) collate utf8_bin'));
        
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

    function customer_alocate_employee($employees, $tl = '',$stl = "",$cust='') {

        $employee_list = array();
        $tls = $stls = array();
        if($tl != ''){
            $tls = explode(",", $tl);
        }
        if($stl != ''){
            $stls = explode(",", $stl);
        }
        foreach ($employees as $employee) {

            $this->tables = array('employee');
            $this->fields = array('username', 'first_name', 'last_name', '(SELECT role FROM ' . $this->db_master . '.login WHERE username = \'' . $employee . '\') AS user_role','code', 'substitute');
            $this->conditions = array('username = ?');
            $this->condition_values = array($employee);
            $this->query_generate();
            $data = $this->query_fetch();
            $tl_status = 0;
            $stl_status = 0;
            for($i=0;$i<count($tls);$i++){
                if ($data[0]['username'] == $tls[$i])
                    $tl_status = 1;
            }
            for($i=0;$i<count($stls);$i++){
                if ($data[0]['username'] == $stls[$i])
                    $stl_status = 1;
            }
//            if ($data[0]['username'] == $stl)
//                $stl_status = 1;
            $employee_list[] = array('username' => $data[0]['username'], 'name' => $data[0]['last_name'] . ' ' . $data[0]['first_name'],'name_ff' => $data[0]['first_name'] . ' ' . $data[0]['last_name'], 'user_role' => $data[0]['user_role'], 'tl' => $tl_status ,'stl' => $stl_status,'code' => $data[0]['code'],'substitute' => $data[0]['substitute']);
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

    function customer_employee_listtoallocate($allocated = NULL) {
        if ($allocated != null) {
            for ($i = 0; $i < count($allocated); $i++) {
                if ($i == 0) {
                    $result = array('AND');
                }
                $result[] = 'employee.username <> "' . $allocated[$i]['username'] . '"';
            }
            $result[] = $this->db_master . '.login.username = employee.username';
            $this->tables = array('employee', $this->db_master . '.login');
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name', $this->db_master . '.login.role AS user_role', 'employee.code', 'employee.substitute');
            $this->conditions = $result;
            $this->conditions[] = 'employee.status = 1';
            $this->order_by = array('employee.last_name');
            $this->query_generate();
            //echo $this->sql_query;
            $datas = $this->query_fetch();
            return $datas;
        } else {
            $this->tables = array('employee', $this->db_master . '.login');
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name', $this->db_master . '.login.role AS user_role', 'employee.code', 'employee.substitute');
            $this->conditions = array('AND', $this->db_master . '.login.username = employee.username', 'employee.status = 1');
            $this->query_generate();
            $datas = $this->query_fetch();
            return $datas;
        }
    }

    function customer_team_leader($customer_username) {

        $this->tables = array('team', 'employee');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'customer = ?', 'role = 2', 'team.employee = employee.username', 'employee.status = 1');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }
    function customer_super_team_leader($customer_username) {
        $this->tables = array('team', 'employee');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'team.customer = ?', 'team.role = 7', 'team.employee = employee.username', 'employee.status = 1');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
//        return !empty($datas) ? $datas[0] : array();
        return !empty($datas) ? $datas : array();
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
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code', 'employee.substitute');
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
                $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code', 'employee.substitute');
                $this->conditions = array('AND', array('IN', 'employee.username', $employees),$this->db_master . '.login.username = employee.username' ,'status = 1');
                $this->order_by = array('employee.last_name');
                $this->query_generate();
                $datas = $this->query_fetch();
            }
        } else if ($type == 'toalloc') {

            if (!empty($users)) {
                $employees = '\'' . implode('\',\'', $users) . '\'';
                $this->tables = array('employee',$this->db_master . '.login');
                $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code', 'employee.substitute');
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
            $this->fields = array('employee.username', 'employee.first_name', 'employee.last_name',$this->db_master . '.login.role AS user_role','employee.code', 'employee.substitute');
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
        $this->order_by = array('date desc');
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
        $this->fields = array('id', 'customer', 'date', 'history', 'diagnosis', 'mission', 'intervention', 'travel', 'work', 'email', 'phone', 'work_comment', 'travel_comment', 'writable', 'created_by');
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
        $this->fields = array('customer', 'history', 'diagnosis', 'mission', 'intervention', 'travel', 'work', 'email', 'phone', 'work_comment', 'travel_comment', 'writable', 'created_by');
        $this->field_values = array($this->username, $this->implementation_history, $this->implementation_diagnosis, $this->implementation_mission, $this->implementation_intervention, $this->implementation_travel, $this->implementation_work, $this->implementation_email, $this->implementation_phone, $this->implementation_work_comment, $this->implementation_travel_comment, $read_write, $_SESSION['user_id']);
        return $this->query_insert();
    }

    function customer_implementation_update($read_write = 0) {
        
        $this->tables = array('customer_implimentation');
        $this->fields = array('history', 'diagnosis', 'mission', 'intervention', 'travel', 'work', 'email', 'phone', 'work_comment', 'travel_comment', 'writable');
        $this->field_values = array($this->implementation_history, $this->implementation_diagnosis, $this->implementation_mission, $this->implementation_intervention, $this->implementation_travel, $this->implementation_work, $this->implementation_email, $this->implementation_phone, $this->implementation_work_comment, $this->implementation_travel_comment, $read_write);
//        echo "<pre>".print_r($this->field_values, 1)."</pre>";
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->implementation_id);
        if ($this->query_update()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }


    function get_implan_field_names(){
        $this->sql_query = "SELECT * FROM customer_implimentation_fields";
        $data = $this->query_fetch();
        return $data[0];

    }

    function get_deswork_field_names(){
        $this->sql_query = "SELECT * FROM customer_work_fields";
        $data = $this->query_fetch();
        return $data[0];

    }

    function update_implan_field_names($field, $field_value,$field_id){
        if($field_id == undefined){
            $this->tables = array('customer_implimentation_fields');
            $this->fields = array($field);
            $this->field_values = array($field_value);
        }
        else{
            $this->tables = array('customer_implimentation_fields_extra');
            $this->fields = array('name');
            $this->field_values = array($field_value);
            $this->conditions = array('id = ?');
            $this->condition_values = array($field_id);
        }
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function update_deswork_field_names($field, $field_value,$field_id){
        if($field_id == undefined){
            $this->tables = array('customer_work_fields');
            $this->fields = array($field);
            $this->field_values = array($field_value);
        }
        else{
            $this->tables = array('customer_work_fields_extra');
            $this->fields = array('name');
            $this->field_values = array($field_value);
            $this->conditions = array('id = ?');
            $this->condition_values = array($field_id);
        }
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function customer_implimentation_attachment_document_string($id) {

        $this->tables = array('customer_implimentation_attachment');
        $this->fields = array('documents');
        $this->conditions = array('implan_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = !empty($datas) ? $datas[0]['documents'] : '';
        return $documents_str;
    }

    function customer_deswork_attachment_document_string($id) {

        $this->tables = array('customer_work_attachment');
        $this->fields = array('documents');
        $this->conditions = array('work_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = !empty($datas) ? $datas[0]['documents'] : '';
        return $documents_str;
    }

    function customer_implimentation_attachment_documents($id) {

        $this->tables = array('customer_implimentation_attachment');
        $this->fields = array('documents');
        $this->conditions = array('implan_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = !empty($datas) ? $datas[0]['documents'] : '';
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
                if (strlen($document) > 20) {
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

    function customer_deswork_attachment_documents($id) {

        $this->tables = array('customer_work_attachment');
        $this->fields = array('documents');
        $this->conditions = array('work_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = !empty($datas) ? $datas[0]['documents'] : '';
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
                if (strlen($document) > 20) {
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

    function customer_implimentation_attachment_documents_add($implan_id, $documents) {

        if (!empty($documents)) {

            $document = implode(',', $documents);
            $this->tables = array('customer_implimentation_attachment');
            $this->fields = array('documents');
            $this->conditions = array('implan_id = ?');
            $this->condition_values = array($implan_id);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {

                $this->tables = array('customer_implimentation_attachment');
                $this->fields = array('documents');
                $this->field_values = array($document);
                $this->conditions = array('implan_id = ?');
                $this->condition_values = array($implan_id);
                if ($this->query_update()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            } else {

                $this->tables = array('customer_implimentation_attachment');
                $this->fields = array('implan_id', 'documents');
                $this->field_values = array($implan_id, $document);
                if ($this->query_insert()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            }
        } else {

            $this->tables = array('customer_implimentation_attachment');
            $this->fields = array('documents');
            $this->conditions = array('implan_id = ?');
            $this->condition_values = array($implan_id);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {

                $this->tables = array('customer_implimentation_attachment');
                $this->fields = array('documents');
                $this->field_values = array("");
                $this->conditions = array('implan_id = ?');
                $this->condition_values = array($implan_id);
                if ($this->query_update()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            }
        }
    }


    function customer_deswork_attachment_documents_add($deswork_id, $documents) {

        if (!empty($documents)) {

            $document = implode(',', $documents);
            $this->tables = array('customer_work_attachment');
            $this->fields = array('documents');
            $this->conditions = array('work_id = ?');
            $this->condition_values = array($deswork_id);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {

                $this->tables = array('customer_work_attachment');
                $this->fields = array('documents');
                $this->field_values = array($document);
                $this->conditions = array('work_id = ?');
                $this->condition_values = array($deswork_id);
                if ($this->query_update()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            } else {

                $this->tables = array('customer_work_attachment');
                $this->fields = array('work_id', 'documents');
                $this->field_values = array($deswork_id, $document);
                if ($this->query_insert()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            }
        } else {

            $this->tables = array('customer_work_attachment');
            $this->fields = array('documents');
            $this->conditions = array('work_id = ?');
            $this->condition_values = array($deswork_id);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {

                $this->tables = array('customer_work_attachment');
                $this->fields = array('documents');
                $this->field_values = array("");
                $this->conditions = array('work_id = ?');
                $this->condition_values = array($deswork_id);
                if ($this->query_update()) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            }
        }
    }


    function get_file_extension($file) {

        $extension = substr(strrchr($file, '.'), 1);
        return $extension;
    }


    function customer_team_add($customer, $employees = NULL, $tl = NULL,$stl =NULL) {

//        $this->tables = array('team');
//        $this->conditions = array('customer = ?');
//        $this->condition_values = array($customer);
//        if ($this->query_delete()) {

//            if ($employees != '' || $employees != NULL) {
               
//                $datas = array();
//                foreach ($employees as $employee) {
//                    $role = 3;
//                    if ($employee == $tl) {
//                        $role = 2;
//                    }
//                    if($employee == $stl){
//                        $role = 7;
//                    }

//                    $datas[] = array($customer, $employee, $role);
//                }

//                $this->tables = array('team');
//                $this->fields = array('customer', 'employee', 'role');
//                $this->field_values = $datas;
//                if ($this->query_insert()) {
//                    echo "frist";
//                    //return TRUE;
//                } else {
//                    echo "second";
//                    //return FALSE;
//                }
//            } else {
//                echo "third";
// //                return TRUE;
//            }
           
//        } else {
//            echo "forth";
// //            return FALSE;
//        }
        $tls = explode(",",$tl);
        $stls = explode(",",$stl);
        $this->tables = array('team');
        $this->fields =array('customer');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('team');
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer);
            $this->query_delete();
            if ($employees != '' || $employees != NULL && is_array($employees) && !empty($employees)) {  
                foreach ($employees as $employee) {
                    $role = 3;
                    for($i=0;$i<count($tls);$i++){
                        if($employee == $tls[$i]){
                            $role = 2;
                        }
                    }
                    for($i=0;$i<count($stls);$i++){
                        if($employee == $stls[$i]){
                            $role = 7;
                        }
                    }
                   // if ($employee == $tl) {
                   //     $role = 2;
                   // }
                   // if($employee == $stl){
                   //     $role = 7;
                   // }

                    $this->tables = array('team');
                    $this->fields = array('customer', 'employee', 'role');
                    $this->field_values = array($customer, $employee, $role);
                   // echo "<pre>".print_r($this->field_values, 1)."</pre>";
                    if($this->query_insert())
                        $true_val[] = 1;
                }
                if(count($employees) == count($true_val))
                    return true;
                else
                    return false;
            }
            return TRUE;
        }
        else{
            if ($employees != '' || $employees != NULL && is_array($employees) && !empty($employees)) { 
                foreach ($employees as $employee) {
                    $role = 3;
                    for($i=0;$i<count($tls);$i++){
                        if($employee == $tls[$i]){
                            $role = 2;
                        }
                    }
                    for($i=0;$i<count($stls);$i++){
                        if($employee == $stls[$i]){
                            $role = 7;
                        }
                    }
                   // if ($employee == $tl) {
                   //     $role = 2;
                   // }
                   // if($employee == $stl){
                   //     $role = 7;
                   // }
                    $this->tables = array('team');
                    $this->fields = array('customer', 'employee', 'role');
                    $this->field_values = array($customer, $employee, $role);
                    if($this->query_insert())
                        $true_val[] = 1;
                    
                }
                if(count($employees) == count($true_val))
                    return true;
                else
                    return false;
               // return true;

            }
            return TRUE;
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
    
    function customer_3066_get($customer_username, $employees = NULL) {

        $this->tables = array('customer_3066` as `c');
        $this->fields = array('c.id', 'c.customer', 'c.employee', 'c.is_assi_have_pa', 'c.is_assi_resi_outside_ees', 'c.assi_resi_outside_ees',
            'c.changes_applies_from', 'c.i_own_employer', 'c.hire_assi_provider', 'c.company_cp_name', 'c.company_cp_phone', 
            'c.is_organizer_employers_assi', 'c.name_of_another_employer', 'c.another_employer_org_no', 'c.signing_date', 'c.signing_employee',
            '(SELECT first_name from employee where username = c.signing_employee) as se_fname',
            '(SELECT last_name from employee where username = c.signing_employee) as se_lname',
            '(SELECT phone from employee where username = c.signing_employee) as se_phone',
            '(SELECT mobile from employee where username = c.signing_employee) as se_mobile');
        $this->conditions = array('AND', 'c.customer = ?');
        $this->condition_values = array($customer_username);
        if(is_array($employees) && !empty($employees))
            $this->conditions[] = array('IN', 'c.employee', '\'' . implode('\',\'', $employees) . '\'');
//            $this->conditions[] = array('IN', 'employee', $employees);
        else if(!is_array($employees) && $employees != NULL){
            $this->conditions[] = 'c.employee = ?';
            $this->condition_values[] = $employees;
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function customer_3066_insert(){
        $this->flush();
        $this->tables = array('customer_3066');
        $this->fields = array('customer', 'employee', 'is_assi_have_pa', 'is_assi_resi_outside_ees', 'assi_resi_outside_ees',
            'changes_applies_from', 'i_own_employer', 'hire_assi_provider', 'company_cp_name', 'company_cp_phone', 
            'is_organizer_employers_assi', 'name_of_another_employer', 'another_employer_org_no', 'signing_date', 'signing_employee');
        $this->field_values = array($this->customer, $this->employee, $this->is_assi_have_pa, $this->is_assi_resi_outside_ees, $this->assi_resi_outside_ees,
            $this->changes_applies_from, $this->i_own_employer, $this->hire_assi_provider, $this->company_cp_name, $this->company_cp_phone,
            $this->is_organizer_employers_assi, $this->name_of_another_employer, $this->another_employer_org_no, $this->signing_date, $this->signing_employee);
        return $this->query_insert();
    }
    
    function customer_3066_update($id){
        $this->flush();
        $this->tables = array('customer_3066');
        $this->fields = array('customer', 'employee', 'is_assi_have_pa', 'is_assi_resi_outside_ees', 'assi_resi_outside_ees',
            'changes_applies_from', 'i_own_employer', 'hire_assi_provider', 'company_cp_name', 'company_cp_phone', 
            'is_organizer_employers_assi', 'name_of_another_employer', 'another_employer_org_no', 'signing_date', 'signing_employee');
        $this->field_values = array($this->customer, $this->employee, $this->is_assi_have_pa, $this->is_assi_resi_outside_ees, $this->assi_resi_outside_ees,
            $this->changes_applies_from, $this->i_own_employer, $this->hire_assi_provider, $this->company_cp_name, $this->company_cp_phone,
            $this->is_organizer_employers_assi, $this->name_of_another_employer, $this->another_employer_org_no, $this->signing_date, $this->signing_employee);
        
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }
    
    function customer_3066_insert_or_update(){
        $customer_employee_3066_data = $this->customer_3066_get($this->customer, $this->employee);
        if(!empty($customer_employee_3066_data))
            return $this->customer_3066_update($customer_employee_3066_data[0]['id']);
        else
            return $this->customer_3066_insert();
    }

    function get_customers_for_search(){
        $table_summary_data = array(
            array('table_name' => 'customer', 'table_alias' => 'cc', 'condition' => '' , 'join' => '', 'multi_rows' => FALSE, 'include_fields' => array('username', 'code', 'first_name', 'last_name', 'century', 'social_security', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'date_inactive')),
            array('table_name' => 'customer_guardian', 'table_alias' => 'cg', 'condition' => 'cg.customer = cc.username', 'join' => 'LEFT', 'multi_rows' => FALSE, 'include_fields' => array('first_name', 'last_name', 'ssn', 'mobile', 'email', 'address', 'first_name2', 'last_name2', 'ssn2', 'mobile2', 'email2', 'address2', 'first_name3', 'last_name3', 'ssn3', 'mobile3', 'email3', 'address3')),
            array('table_name' => 'customer_health', 'table_alias' => 'ch', 'condition' => 'ch.customer = cc.username', 'join' => 'LEFT', 'multi_rows' => FALSE, 'include_fields' => array('health_care', 'occupational_therapists', 'physiotherapists', 'other')),
            array('table_name' => 'customer_relative', 'table_alias' => 'cr', 'condition' => 'cr.customer', 'join' => 'LEFT', 'multi_rows' => TRUE, 'include_fields' => array('name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other')),
        );
        $main_query = "SELECT ";
        $main_query_sub = ' FROM ';
        $j = 0;
        $i=0;
        foreach($table_summary_data as $table_summary){
            if($table_summary['multi_rows'] === TRUE) continue;
            if($j != 0){
                if($table_summary['condition'])
                    $main_query_sub .= $table_summary['join']." ". "JOIN ". $table_summary['table_name']. " ".$table_summary['table_alias']. " ON ". $table_summary['condition']." ";
                else
                    $main_query_sub .= ", ";
            }else{
                $main_query_sub .= $table_summary['table_name']." ".$table_summary['table_alias']." ";
            }
            $this->sql_query = "DESC ".$table_summary['table_name'];
            $table_datas = $this->query_fetch();
            //echo "<pre>".print_r($table_datas,1)."</pre>";
           
            foreach($table_datas as $table_data){
                if(!in_array($table_data['Field'], $table_summary['include_fields'])) continue;
                if($i != 0){
                    $main_query .= ", ";
                }
                $main_query .= $table_summary['table_alias']. ".". $table_data['Field']." as ". $table_summary['table_alias']."_".$table_data['Field'];
                $i++;
            } 
            $j++;

        }
        $this->sql_query = $main_query. $main_query_sub. "ORDER BY ".($_SESSION['company_sort_by'] == 1 ? 'LOWER(cc.first_name) collate utf8_bin, LOWER(cc.last_name) collate utf8_bin' : 'LOWER(cc.last_name) collate utf8_bin, LOWER(cc.first_name) collate utf8_bin');
        $datas = $this->query_fetch();

        //get multivalued datas
        if(!empty($datas)){
            foreach($datas as $dkey => $dval){
                foreach($table_summary_data as $table_summary){
                    if($table_summary['multi_rows'] !== TRUE || empty($table_summary['include_fields'])) continue;

                    $this->flush();
                    $this->sql_query = 'SELECT ';
                    $temp_table_fields = array();
                    foreach($table_summary['include_fields'] as $inc_fields)
                        $temp_table_fields[] = $table_summary['table_alias']. ".". $inc_fields." as ". $table_summary['table_alias']."_".$inc_fields;

                    $this->sql_query .= implode(', ', $temp_table_fields);
                    $this->sql_query .= ' FROM '.$table_summary['table_name']. ' AS '.$table_summary['table_alias'].
                                        ' WHERE '.$table_summary['condition']. ' = "'.$dval['cc_username'].'"';

                    // echo $this->sql_query. '<br/><br/>';
                    $datas[$dkey][$table_summary['table_alias']] = $this->query_fetch();
                }
            }
        }
        return $datas;

    }

    function add_new_implan_details(){
        if(!empty($this->new_implan_name)){
            $this->add_new_implan_names();
            $id = $this->get_id();
            $this->tables           = array('customer_implimentation_fields_extra');
            $this->fields           = array('id');
            $this->conditions       = array('id >= ?');
            $this->condition_values = array($id);
            $this->query_generate();
            $field_ids              = $this->query_fetch();
            $this->add_new_implan_description($field_ids);
        }
    }

    function add_new_implan_names($field_name = null){
        $this->tables = array('customer_implimentation_fields_extra');
        $this->fields = array('name', 'alloc_employee');
        if($field_name != null){
            $this->field_values = array($field_name,$_SESSION['user_id']);
        }
        else{
            $this->field_values = array();
            foreach ($this->new_implan_name as $key => $value) {
                $this->field_values[] = array($value,$_SESSION['user_id']);
            }
        }
        
        return $this->query_insert();
    }

    function add_new_implan_description($field_ids){
        
        $this->tables = array('customer_implimentation_extra');
        $this->fields = array('customer_implan_id', 'field_id','description');
        $this->field_values = array();
        foreach ($this->new_implan_description as $key => $value) {
            if($value != '')
                $this->field_values[] = array($this->implementation_id,$field_ids[$key]['id'],$value);
        }
        $this->query_insert();
    }

    function get_all_new_implan_fields(){
        $this->tables = array('customer_implimentation_fields_extra');
        $this->fields = array('id','name', 'alloc_employee');
        $this->query_generate();
        return $this->query_fetch();
    }

    function new_customer_implementation_details($imp_id){
        $this->tables = array('customer_implimentation_extra');
        $this->fields = array('id', 'customer_implan_id', 'field_id','description');
        $this->conditions = array('customer_implan_id = ?');
        $this->condition_values = array($imp_id);
        $this->query_generate();
        return $data = $this->query_fetch();
    }

    function add_update_implan_description($new_implan_update_description,$implementaion_id){
        $this->tables = array('customer_implimentation_extra');
        $this->fields = array('customer_implan_id', 'field_id','description');
        $this->field_values = array();
        foreach ($new_implan_update_description as $key => $value) {
            if($value != '')
                $this->field_values[] = array($implementaion_id,$key,$value);
        }
        $this->query_insert();
    }

    function add_update_insert_implan_description($new_implan_update_description,$new_implan_array_for_update,$implementaion_id){
        if(!empty($new_implan_update_description))
            $this->add_update_implan_description($new_implan_update_description,$implementaion_id);
        foreach ($new_implan_array_for_update as $key => $value) {
             $this->sql_query = "UPDATE `customer_implimentation_extra` SET `description` = '".$value."' WHERE `customer_implan_id` = '".$implementaion_id."' AND `field_id` = '".$key."'";
            $this->query_fetch();
        }
    }

    function new_implan_description_show($implan_id){
        $this->sql_query = "SELECT cif.id ,cif.name, cie.description FROM `customer_implimentation_extra` cie LEFT JOIN `customer_implimentation_fields_extra` cif ON cie.field_id = cif.id WHERE cie.customer_implan_id =  '".$implan_id."'";
        $data = $this->query_fetch();
        return $data;
    }

    function check_field_exist_atleast_one_implan($delete_id){
        
        $this->sql_query = "SELECT cie.id, cie.customer_implan_id, cie.description,  ci.customer FROM `customer_implimentation_extra` cie LEFT JOIN `customer_implimentation` ci ON cie.customer_implan_id = ci.id WHERE cie.field_id = '".$delete_id."' GROUP BY ci.customer";
        return $data = $this->query_fetch();
    }

    function delete_implan_field($delete_id){
        $this->tables = array('customer_implimentation_fields_extra');
        $this->conditions = array('id = ?');
        $this->condition_values = array($delete_id);
        $this->query_delete();
    }
}
?>