<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once ('class/db.php');
require_once ('class/employee.php');
require_once ('class/customer.php');
require_once ('class/company.php');
require_once ('class/dona.php');
require_once ('class/general.php');


class equipment extends db {

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
    var $status = "";
    var $date = "";
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
    var $da_users = "";
    var $category_name = "";
    var $alloc_emp = "";
    var $category = "";
    var $category_id_move = "";
    var $files_to_move = array();
    var $category_edit_name = "";
    var $parent_cat = "";

    function get_all_issue_data($customer, $year, $month) {
        //$result = array();
        $this->tables = array('customer_equipment');
        $this->fields = array('id', 'equipment', 'serial_number', 'issue_date', 'return_date');
        $this->conditions = array('AND', 'customer = ?', 'month(issue_date) = ?', 'year(issue_date) = ?');
        $this->condition_values = array($customer, $month, $year);
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

    function get_dates_equipments() {
        $this->tables = array('customer_documentation');
        $this->fields = array('id', 'created_date');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_documentation_date($id) {

        $this->tables = array('customer_documentation');
        $this->fields = array('id', 'created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status');
        $this->conditions = array('AND', 'id = ?');
        $this->condition_values = array($id);
        $this->query_generate();

        $data = $this->query_fetch();
        return $data;
    }

    function insert_documentation() {
        $created_date = date('Y-m-d H:i:s', strtotime($this->issue_date));
        $complete_date = date('Y-m-d H:i:s', strtotime($this->return_date));
        $this->tables = array('customer_documentation');
        $this->fields = array('created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status');

        $this->field_values = array($created_date, $this->customer, $this->employee, $complete_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status);

        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function edit_documentation($id) {
        $created_date = date('Y-m-d H:i:s', strtotime($this->issue_date));
        $complete_date = date('Y-m-d H:i:s', strtotime($this->return_date));
        $this->tables = array('customer_documentation');
        $this->fields = array('created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status');
        $this->field_values = array($created_date, $this->customer, $this->employee, $complete_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
        if ($data)
            return TRUE;
        else
            return FALSE;
    }

    function get_dates_customer_work() {
        $this->tables = array('customer_work');
        $this->fields = array('id', 'date');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_customer_works_date($id) {
        $this->tables = array('customer_work');
        $this->fields = array('id', 'customer', 'date', 'work', 'history', 'clinical_picture', 'medications', 'devolution', 'special_diet');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function insert_work_customer() {
        $date = date('Y-m-d');
        $this->tables = array('customer_work');
        $this->fields = array('customer', 'date', 'work', 'history', 'clinical_picture', 'devolution', 'medications', 'special_diet');
        $this->field_values = array($this->customer, $date, $this->work, $this->history, $this->clinical_picture, $this->devolution, $this->medications, $this->special_diet);

        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function edit_work_customer($id) {
        // $date = date('Y-m-d');

        $this->tables = array('customer_work');
        $this->fields = array('customer', 'work', 'history', 'clinical_picture', 'devolution', 'medications', 'special_diet');
        $this->field_values = array($this->customer, $this->work, $this->history, $this->clinical_picture, $this->devolution, $this->medications, $this->special_diet);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);

        $data = $this->query_update();

        if ($data)
            return TRUE;
        else
            return FALSE;
    }

    function get_date_period($customer, $fkkn) {
        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to');
        if($fkkn == 1)
           $this->conditions = array('AND', 'customer = ?', 'fkkn = ?'); 
        else
            $this->conditions = array('AND', 'customer = ?', array('OR','fkkn = 3','fkkn = ?'));
        $this->condition_values = array($customer, $fkkn);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_ful_contract_detail($id) {
        //echo "id = ".$id."<br>";
        $result = array();
        $data = array();
        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'hour');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data1 = $this->query_fetch();
        //print_r($data1);
        $this->tables = array( 'customer_contract_billing');
        $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'awake', 'oncall2', 'something', 'comments','iss','sol');
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
        
        $result[0] = array('id' => $data1[0]['id'],'date_from'=>$data1[0]['date_from'], 'date_to' =>$data1[0]['date_to'], 'hour'=>$data1[0]['hour'],
            'first_name'=>$data2[0]['first_name'], 'last_name'=>$data2[0]['last_name'], 'mobile'=>$data2[0]['mobile'], 'email'=>$data2[0]['email'], 'city'=>$data2[0]['city'], 'oncall'=>$data2[0]['oncall'], 'awake'=>$data2[0]['awake'], 'oncall2'=>$data2[0]['oncall2'], 'something'=>$data2[0]['something'], 'comments'=>$data2[0]['comments'],'iss'=>$data2[0]['iss'],'sol'=>$data2[0]['sol'],
            'first'=>$data3[0]['first'], 'last'=>$data3[0]['last'], 'mob'=>$data3[0]['mob'], 'mail'=>$data3[0]['mail'], 'cities'=>$data3[0]['cities'], 'comments_time'=>$data3[0]['comments_time'], 'comments_other'=>$data3[0]['comments_other'], 'documents'=>$data3[0]['documents']
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

                    $icon = "open.jpg";
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

    function get_file_extension($file) {

        $extension = substr(strrchr($file, '.'), 1);
        return $extension;
    }

    function add_customer_contract( $user,$hours, $fromdate, $todate, $fkkn) {
        $from = date('Y-m-d', strtotime($fromdate));
        $to = date('Y-m-d', strtotime($todate));
        $this->tables = array('customer_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fkkn', 'customer');
        $this->field_values = array($hours, $from, $to, $fkkn, $user);
        $data = $this->query_insert();
        $id = $this->get_id();
        if ($data)
            return $id;
        else
            return FALSE;
        
        /*if( $this->b_fname != "" || $this->b_lname != "" || $this->b_mobile!= "" || $this->b_email!= "" || $this->b_city!= "" || $this->b_oncall!= "" || $this->b_oncall2!= "" || $this->b_awake!= "" || $this->b_something!= "" ){
         
          
              $this->customer_contract_billing_insert($fkkn,$last_id);
              
        }
        if( $this->d_fname != "" || $this->d_lname != "" || $this->d_mobile != "" || $this->d_email != "" || $this->d_city != "" || $this->d_comment_time != "" || $this->d_comment_other != "" || $this->d_document != ""){
          
               $this->customer_contract_decision_insert($fkkn,$last_id);
                   
            
        }*/
        
        
    }
       /* $this->tables = array('customer_contract');
        $this->fields = array('max(id) AS id');
        $this->query_generate();
        $data1 = $this->query_fetch();*/

    function customer_contract_billing_insert($id,$fkkn) {
        $this->tables = array('customer_contract_billing');
        if($fkkn == 2){
            $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something','iss','sol');
            $this->field_values = array($id, $this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something,$this->b_iss,$this->b_sol);
        }
        else{
            $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something');
            $this->field_values = array($id, $this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something);
        }
        $data2 = $this->query_insert();
        if ($data2)
            return TRUE;
        else
            return FALSE;
    }
    function customer_contract_decision_insert($id){

        $this->tables = array('customer_contract_decision');
        $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'comments_time', 'comments_other', 'documents');
        $this->field_values = array($id, $this->d_fname, $this->d_lname, $this->d_mobile, $this->d_email, $this->d_city, $this->d_comment_time, $this->d_comment_other, $this->d_document);
        //$this->conditions = array('contract_id')
        $data3 = $this->query_insert();
        
         
        if ($data3)
            return TRUE;
        else
            return FALSE;
    }

    function customer_contract_update($id,$hours, $fromdate, $todate,$fkkn) {
         
        $from = date('Y-m-d', strtotime($fromdate));
        $to = date('Y-m-d', strtotime($todate));
        $this->tables = array('customer_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fkkn');
        $this->field_values = array($hours, $from, $to, $fkkn);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
         
        /*if( $this->b_fname != "" || $this->b_lname != "" || $this->b_mobile!= "" || $this->b_email!= "" || $this->b_city!= "" || $this->b_oncall!= "" || $this->b_oncall2!= "" || $this->b_awake!= "" || $this->b_something!= "" ){
         
          
         
          if($this->customer_id_present_billing($id)){
              
              $this->customer_contract_billing_update($fkkn,$id);
                  
             
          }else{
               $this->customer_contract_billing_insert($fkkn,$id);
          }
          
        }
        if( $this->d_fname != "" || $this->d_lname != "" || $this->d_mobile != "" || $this->d_email != "" || $this->d_city != "" || $this->d_comment_time != "" || $this->d_comment_other != "" || $this->d_document != ""){
          
          if($this->customer_id_present_decision($id)){
               $this->customer_contract_decision_update($id);
          }              
               
          }else {
              $this->customer_contract_decision_insert($id);
          
              
        }*/
        if ($data)
            return TRUE;
        else
            return FALSE;
    }
    function customer_contract_billing_update($id,$fkkn) {

        $this->tables = array('customer_contract_billing');
        if($fkkn == 2){
            $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something','iss','sol');
            $this->field_values = array($this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something,$this->b_iss,$this->b_sol);
        }
        else{
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

    function get_timetable_customer($customer, $from_date, $to_date, $fkkn) {
        $this->tables = array('timetable');
        $this->fields = array('customer', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'date BETWEEN ? AND ?', 'fkkn = ?', 'customer = ?');
        $this->condition_values = array($from_date, $to_date, $fkkn, $customer);
        $this->query_generate();


        $data = $this->query_fetch();

        $result = "0.00";
        for ($i = 0; $i < count($data); $i++) {
            $result = $this->time_sum($result, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
        }
        return $result;
    }

    function time_difference($t1, $t2, $mod = 60, $round = true) {
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

    
    function time_user_format($t1, $mod=60, $round_minutes = TRUE) {
        $a1 = explode(".", round($t1,2));
        $hours = $a1[0];
        $mins = str_pad($a1[1], 2, '0', STR_PAD_RIGHT);
        if($mod == 100)
            $mins = $round_minutes ? round($mins*100/60) : $mins*100/60;
        else
            $mins = $round_minutes ? round($mins*60/100) : $mins*60/100;
        //$result = $hours . "." . sprintf('%02d', $mins);
        if($round_minutes)
            $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        else
            $result = $hours+($mins/100);
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
    
    function time_sub($t1, $t2) {
        
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = (($a1[0] * 60 * 60) + (str_pad($a1[1], 2, '0', STR_PAD_RIGHT) * 60));
        $time2 = (($a2[0] * 60 * 60) + (str_pad($a2[1], 2, '0', STR_PAD_RIGHT) * 60));
        $sum = $time1 - $time2;
        $hours = floor($sum / (60 * 60));
        $mins = floor(($sum - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }
    
    
    function  customer_id_present_decision($id)
    {
        
        $this->tables = array('customer_contract_decision');
        $this->fields = array('contract_id');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();        
        if($data){
            return TRUE;
        }
        else 
            return FALSE;
    }
    function  customer_id_present_billing($id)
    {
       
        $this->tables = array('customer_contract_billing');
        $this->fields = array('contract_id');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? TRUE : FALSE;
    }
  
//   function customer_timetable_month($cust,$month,$year,$emp,$role,$condition_array = array())
    // this is used in export to get the timetable data
   function customer_timetable_month($cust,$start_date,$end_date,$emp,$role,$condition_array = array()) {
      // echo "<pre>".print_r(func_get_args(), 1)."</pre>";
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        $month = date('m',  strtotime($end_date));
        $year  = date('Y',  strtotime($end_date));
        $select_employees = array();
        if($cust == '' || $cust == null){
            $obj_emp = new employee();
            $employee_acc_role = $obj_emp->employee_list(NULL, NULL, 'NO');
            $select_employees = array('OR');
            for($i=0;$i<count($employee_acc_role);$i++){
                $select_employees[] = 'employee = "'.$employee_acc_role[$i]['username'].'"';
              // if($select_employees == '')
              //     $select_employees = $employee_acc_role[$i]['username'];
              // else
              //    $select_employees = $select_employees.",".$employee_acc_role[$i]['username']; 
            }
        }
       
       $cond = array();
        if($cust == "" && $role == '7'){
            $cond = array('OR');
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $cond[] = 'customer = "'.$data[$i]['customer'].'"';
                }
            }
        }
        elseif($cust == "" && $role == '1'){
            $cond = array('OR');
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer');
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $cond[] = 'customer = "'.$data[$i]['customer'].'"';
                }
            }
        }
        elseif($cust == "" && $role == '3'){
            $cond = array('OR');
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $cond[] = 'customer = "'.$data[$i]['customer'].'"';
                }
            }
        }
         elseif($cust == "" && $role == '2'){
            $cond = array('OR');
            $this->tables = array('team');
            $this->fields = array('customer','role');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    if($data[$i]['role'] == "2"){
                        $cond[] = 'customer = "'.$data[$i]['customer'].'"';
                    }else{
                        $cond[] = 'employee = "'.$emp.'"';
                    }
                    
                }
            }
        }

        if(!empty($select_employees) && !empty($cond)){
            $select_employees[] = array('AND', array('OR', 'employee IS NULL', 'employee = ""'), $cond);
        }

        // echo "<pre>".print_r($select_employees, 1)."<pre>";
      // array('BETWEEN', 'timetable.date', '?', '?')
        $result = array();
        if($start_date <= $boundary_date && $end_date > $boundary_date){
            $this->tables = array('timetable');
            $this->fields = array('employee','customer','date','time_from','time_to','type','status','fkkn',
                "(SELECT type FROM `leave` where timetable.employee like employee AND timetable.date = date AND time_from <= timetable.time_from AND time_to >= timetable.time_to) AS leave_type");
            $this->field_values = array();        
            if($cust){
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'customer = ?',array('OR','status = 1','status = 2', 'status = 0'));
                $this->condition_values = array($start_date,$end_date,$cust);
            }
            else{
                if($role == 3){
                    $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2', 'status = 0')/*,$cond*/,'employee = ?');
                    $this->condition_values = array($start_date,$end_date,$emp);
                }else{
                    $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2', 'status = 0')/*,$cond*/,$select_employees);
                    $this->condition_values = array($start_date,$end_date);
                }
            }
            if(!empty($condition_array))
                $this->conditions[] = $condition_array;
            $this->order_by = array('date','time_from', 'time_to', 'employee');
            $this->query_generate();
            $real_table_data = $this->sql_query;


            $this->tables = array('backup_timetable');
            $this->fields = array('employee','customer','date','time_from','time_to','type','status','fkkn',
                "(SELECT type FROM `backup_leave` where t.employee like employee AND t.date = date AND time_from <= t.time_from AND time_to >= t.time_to) AS leave_type");
            $this->field_values = array();        
            if($cust){
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'customer = ?',array('OR','status = 1','status = 2', 'status = 0'));
                $condition_values = array($start_date,$end_date,$cust);
            }
            else{
                if($role == 3){
                    $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2', 'status = 0')/*,$cond*/,'employee = ?');
                    $condition_values = array($start_date,$end_date,$emp);
                }else{
                    $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2', 'status = 0')/*,$cond*/,$select_employees);
                    $condition_values = array($start_date,$end_date);
                }
            }
            if(!empty($condition_array))
                $this->conditions[] = $condition_array;
            $this->order_by = array('date','time_from', 'time_to', 'employee');
            $this->query_generate();
            $backup_table_data = $this->sql_query;


            $this->condition_values = array_merge($this->condition_values, $condition_values);
            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY date, time_from, time_to, employee ' ;

        }
        else if($start_date <= $boundary_date && $end_date <= $boundary_date){
            $this->tables = array('backup_timetable` as `t');
            $table_leave  = 'backup_leave'; 
            $proceed      = TRUE;
        }
        else if($start_date > $boundary_date && $end_date > $boundary_date){
            $this->tables = array('timetable` as `t');
            $table_leave  = 'leave'; 
            $proceed      = TRUE;
        }
        if($proceed == TRUE){
            $this->fields = array('employee','customer','date','time_from','time_to','type','status','fkkn',
                "(SELECT type FROM `".$table_leave."` where t.employee like employee AND t.date = date AND time_from <= t.time_from AND time_to >= t.time_to) AS leave_type");
            $this->field_values = array();        
            if($cust){
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'customer = ?',array('OR','status = 1','status = 2', 'status = 0'));
                $condition_values = array($start_date,$end_date,$cust);
            }
            else{
                if($role == 3){
                    $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2', 'status = 0')/*,$cond*/,'employee = ?');
                    $condition_values = array($start_date,$end_date,$emp);
                }else{
                    $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2', 'status = 0')/*,$cond*/,$select_employees);
                    $condition_values = array($start_date,$end_date);
                }
            }
            if(!empty($condition_array))
                $this->conditions[] = $condition_array;
            $this->order_by = array('date','time_from', 'time_to', 'employee');
            $condition_values = $this->condition_values = array_merge($this->condition_values, $condition_values);
            $this->query_generate();
            // if($_SESSION['user_id'] == 'dodo001'){
            //     echo $this->sql_query;
            // }
            
        }
        
        $data1 = array();
        if($_SESSION['user_id'] == 'dodo001'){
            $query = $this->sql_query;
            $query_iteration = 0;
            do{
                $offset = '';                
                if($query_iteration){
                    $offset = 1000 * $query_iteration;
                }
                $this->sql_query = $query.' LIMIT 1000';
                $this->condition_values = $condition_values;
                if($offset){
                    $this->sql_query .= ' OFFSET '.$offset;
                }
                $result_query = $this->query_fetch();
                //echo "<pre>".$query_iteration. print_r($result_query, 1)."</pre>";
                $data1 = array_merge($data1,$result_query);
                $query_iteration ++;
                
            }while(count($result_query));
        }else{
            $data1 = $this->query_fetch();
        }
        $data1 = $this->query_fetch();
        
        $datas = $this->employees_present();
        $cust_datas = $this->customers_present();
        // if($_SESSION['user_id'] == 'dodo001'){
        //     echo "<pre>b". print_r($data1, 1)."</pre>";
        //     echo "<pre>c". print_r($datas, 1)."</pre>";
        // }
        
        
        $data = array();
        $i=0;
        for($i=0;$i<count($data1);$i++){
            $data[$i]['customer'] = $data1[$i]['customer'];
            $data[$i]['date'] = $data1[$i]['date'];
            $data[$i]['time_from'] = $data1[$i]['time_from'];
            $data[$i]['time_to'] = $data1[$i]['time_to'];
            $data[$i]['type'] = $data1[$i]['type'];
            $data[$i]['status'] = $data1[$i]['status'];
            $data[$i]['emp_username'] = $data1[$i]['employee'];
            $data[$i]['fkkn'] = $data1[$i]['fkkn'];
            $data[$i]['leave_type'] = $data1[$i]['leave_type'];
            for($j=0;$j<count($datas);$j++){
                if($data1[$i]['employee'] == $datas[$j]['username']){
                    if($_SESSION['company_sort_by'] == 1)
                        $data[$i]['employee'] = $datas[$j]['first_name']." ".$datas[$j]['last_name'];
                    elseif($_SESSION['company_sort_by'] == 2)
                        $data[$i]['employee'] = $datas[$j]['last_name']." ".$datas[$j]['first_name'];
                    $data[$i]['color'] = $datas[$j]['color'];
                }
            }
            for($j=0;$j<count($datas);$j++){
                if($data1[$i]['customer'] == $cust_datas[$j]['username']){
                    if($_SESSION['company_sort_by'] == 1)
                        $data[$i]['customer_name'] = $cust_datas[$j]['first_name']." ".$cust_datas[$j]['last_name'];
                    elseif($_SESSION['company_sort_by'] == 2)
                        $data[$i]['customer_name'] = $cust_datas[$j]['last_name']." ".$cust_datas[$j]['first_name'];
                    $data[$i]['customer_first_name'] = $cust_datas[$j]['first_name'];
                    $data[$i]['customer_last_name'] = $cust_datas[$j]['last_name'];
                    
                }
            }
        }

        // if($_SESSION['user_id'] == 'dodo001'){
            
            
        //     echo "<pre>a". print_r($data, 1)."</pre>"; 
        //     exit();
        // }
           // echo "<pre>b". print_r($data, 1)."</pre>";
        
       // $days1 = cal_days_in_month(CAL_GREGORIAN, $month, $year);     old code on month and year
       // $week_num_start = date('W',  strtotime($year."-".$month."-01"));
       
        $week_num_start = date('W',  strtotime($start_date));
        
        
        /* echo $week_num_start = date('d',  strtotime($year."-".$month."-01"));
        echo $week_num_start = date('W',  strtotime('-1 day', strtotime($year."-".$month."-01")));
        echo $week_num_start = date('d',  strtotime('-1 day', strtotime($year."-".$month."-01")));*/
        
        
        $val = $week_num_start;
        if($month == '12'){
           $week_num_end = date('W',  strtotime($end_date));
           if($week_num_end == '01'){
               for($i=31;$i>0;$i--){
                   $week_num_end = date('W',  strtotime($year."-".$month."-".$i));
                   if($week_num_end != '01'){
                       break;
                   }
               }
                $week_num_end = $week_num_end +1;
           }
        }else{
            $week_num_end = date('W',  strtotime($end_date));
        }
        $week_num_end_new = date('W',  strtotime($end_date));
        if($week_num_end_new == '01'){
           // echo "$week_num_end ---- $week_num_start --- $week_num_end_new --- $year  _ ";
            for($i=0;$i<(($week_num_end)-$week_num_start);$i++){
                $result[$i] = array(
                    'week' => $val ,
                    'employee'=>array(),
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w")),date("Y", strtotime($year."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w")),date("Y", strtotime($year."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w")),date("Y", strtotime($year."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w")),date("Y", strtotime($year."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w")),date("Y", strtotime($year."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")),date("Y", strtotime($year."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
               // $result[$i] = array('week' => $val ,'employee'=>array(),'sun'=>date("d", strtotime($year."-W".$val."-". 0 ."w")),'mon'=>$year."-W".$val."-". 1 ."w",'tue'=>$year."-W".$val."-". 2 ."w",'wed'=>$year."-W".$val."-". 3 ."w",'thu'=>$year."-W".$val."-". 4 ."w",'fri'=>$year."-W".$val."-". 5 ."w",'sat'=>$year."-W".$val."-". 6 ."w"); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            }
            
            /*//keep year as previous year if the date from previous year
            echo $tmp_year_sun = date("Y", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"));// > 15 ? $year : ($year+1);
            echo $tmp_year_mon = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w"));// > 15 ? $year : ($year+1);
            echo $tmp_year_tue = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w"));// > 15 ? $year : ($year+1);
            echo $tmp_year_wed = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w"));// > 15 ? $year : ($year+1);
            echo $tmp_year_thu = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w"));// > 15 ? $year : ($year+1);
            echo $tmp_year_fri = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w"));// > 15 ? $year : ($year+1);
            echo $tmp_year_sat = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w"));// > 15 ? $year : ($year+1);*/
            $result[$i] = array(
                'week' => $week_num_end_new,
                'sun'=>array(date("d", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("m", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("Y", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"))),
                'mon'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w"))),
                'tue'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w"))),
                'wed'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w"))),
                'thu'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w"))),
                'fri'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w"))),
                'sat'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w"))),
                /*'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())*/);
               // echo "<pre>result".print_r($result[$i], 1)."</pre>";
           // $result[$i] = array('week' => $week_num_end_new,'sun'=>date("d", strtotime($year."-W".$week_num_end_new."-". 0 ."w")),'mon'=>date("d", strtotime($year."-W".$week_num_end_new."-". 1 ."w")),'tue'=>date("d", strtotime($year."-W".$week_num_end_new."-". 2 ."w")),'wed'=>date("d", strtotime($year."-W".$week_num_end_new."-". 3 ."w")),'thu'=>date("d", strtotime($year."-W".$week_num_end_new."-". 4 ."w")),'fri'=>date("d", strtotime($year."-W".$week_num_end_new."-". 5 ."w")),'sat'=>date("d", strtotime($year."-W".$week_num_end_new."-". 6 ."w")),'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array()));
        }
        else{
            
            $i=0;
           // echo $week_num_start .'>'. $week_num_end;
            $m = 0;
            if($week_num_start > $week_num_end){
                 $result[$i] = array(
                    'week' => $val ,
                    'employee'=>array(),
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", 1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", 1) ."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", 1) ."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime(($year-1)."-W".$val."-". 1 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 1 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime(($year-1)."-W".$val."-". 2 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 2 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime(($year-1)."-W".$val."-". 3 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 3 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime(($year-1)."-W".$val."-". 4 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 4 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime(($year-1)."-W".$val."-". 5 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 5 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime(($year-1)."-W".$val."-". 6 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 6 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val=1;
                $val = sprintf("%02d", $val);
                $week_num_start = 1;
                $i++;
                $m = 1;
            }
           // echo '<br>'.$i.'=='.$week_num_start .'>'. $week_num_end;
            for(;$i<(($week_num_end+1)-$week_num_start+$m);$i++){
                $result[$i] = array(
                    'week' => $val ,
                    'employee'=>array(),
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w")),date("Y", strtotime($year."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w")),date("Y", strtotime($year."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w")),date("Y", strtotime($year."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w")),date("Y", strtotime($year."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w")),date("Y", strtotime($year."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")),date("Y", strtotime($year."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
               // $result[$i] = array('week' => $val ,'employee'=>array(),'sun'=>date("d", strtotime($year."-W".$val."-". 0 ."w")),'mon'=>$year."-W".$val."-". 1 ."w",'tue'=>$year."-W".$val."-". 2 ."w",'wed'=>$year."-W".$val."-". 3 ."w",'thu'=>$year."-W".$val."-". 4 ."w",'fri'=>$year."-W".$val."-". 5 ."w",'sat'=>$year."-W".$val."-". 6 ."w"); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            } 
        }
        //$week_num_end = date('W',  strtotime($year."-".$month."-".$days1));
        //echo "<pre>b". print_r($data, 1)."</pre>";
        $val1=0;
        for($i=0;$i<count($data);$i++){
            $week_num = date('W',  strtotime($data[$i]['date']));
            $day = date('w', strtotime($data[$i]['date']));
            $days = date('D', strtotime($data[$i]['date']));
            for($j=0;$j<count($result);$j++){
                $weekly_sum = "0.0";
                if($result[$j]['week'] == $week_num){ 
                    if($data[$i]['emp_username'] != ''){
                        if(count($result[$j]['employee']) == 0){
                            $result[$j]['employee'][0]['name'] = $data[$i]['employee'];
                            $result[$j]['employee'][0]['color'] = $data[$i]['color'];
                            $result[$j]['employee'][0]['sum'] = "0.0";
                            //sun'] = "0.0";
                            //$result[$j]['employee'][0]['sum_
                            //$result[$j]['employee'][0][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
                            $result[$j]['employee'][0][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
                            if($data[$i]['status'] != 2){
                                $result[$j]['employee'][0]['sum'] = $this->time_sum($result[$j]['employee'][0]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                            }
                            $result[$j]['employee'][0]['emp_username'] = $data[$i]['emp_username'];//added for new comp
                            $result[$j]['employee'][0]['customer'] = $data[$i]['customer'];//added for geroge
                        }
                        else{
                            
                            for($k=0;$k<count($result[$j]['employee']);$k++){
                                
                                if($result[$j]['employee'][$k]['emp_username'] == $data[$i]['emp_username']){
                                    
                                   // if($data[$i]['status'] == 1){
                                   //     if($day == 0){
                                   //         if($data[$i]['type'] == 0){
                                                //$result[$j]['employee'][$k][$days][count($result[$j]['employee'][$k][$days])] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
                                                $result[$j]['employee'][$k][$days][count($result[$j]['employee'][$k][$days])] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
                                                if($data[$i]['status'] != 2){
                                                    $result[$j]['employee'][$k]['sum'] = $this->time_sum($result[$j]['employee'][$k]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                                                    
                                                }
                                                break;
                                }
                            }
                            
                            if($k == count($result[$j]['employee'])){
                                $result[$j]['employee'][$k]['name'] = $data[$i]['employee'];
                                $result[$j]['employee'][$k]['color'] = $data[$i]['color'];
                               // if($data[$i]['status'] == 1){
                               // if($day == 0){
                               //     if($data[$i]['type'] == 0){
                                        //$result[$j]['employee'][$k][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
                                        $result[$j]['employee'][$k][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
                                        if($data[$i]['status'] != 2){
                                            $result[$j]['employee'][$k]['sum'] = date('H.i',  strtotime($this->time_sum($result[$j]['employee'][$k]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))));
                                        
                                        }//sun'] = $this->time_sum(//sun'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                                $result[$j]['employee'][$k]['emp_username'] = $data[$i]['emp_username']; //Added for new comp     
                                $result[$j]['employee'][$k]['customer'] = $data[$i]['customer'];//added for geroge
                            }
                        }
                    } 
                    //unmanned
                    else {
                        // $result[$j]['unmanned']['sum'] = "0.0";
                        $result[$j]['unmanned'][$days][] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
                        if($data[$i]['status'] != 2){
                            $result[$j]['unmanned']['sum'] = $this->time_sum($result[$j]['unmanned']['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                        }
                        // $result[$j]['unmanned']['customer'] = $data[$i]['customer'];//added for geroge
                    }
                    break;
                }
                  
            } 
             
        }
       $i=0;
       if(!empty($result)){
            foreach($result as $res){
                $j=0;
                if(!empty($res['employee'])){
                     foreach($res['employee'] as $emp){
                         if(array_key_exists('sum', $emp)){
                             $result[$i]['employee'][$j]['sum'] = $this->time_user_format($emp['sum'], 100);
                         }
                         $j++;
                     }
                }
                $i++;
            }
       }
       //echo "<pre>b". print_r($result, 1)."</pre>";
       return $result;
      
    }

    // function customer_timetable_month1($cust,$start_date,$end_date,$emp,$role,$condition_array = array()) {
    //   // echo "<pre>".print_r(func_get_args(), 1)."</pre>";
    //     $obj_gen       = new general();

    //     $month = date('m',  strtotime($end_date));
    //     $year  = date('Y',  strtotime($end_date));
        
    //     $this->sql_query = "SELECT t.employee, t.customer, t.date, t.time_from, t.time_to, t.type, t.status, t.fkkn, l.type as leave_type FROM timetable t LEFT JOIN `leave` l ON  t.employee = l.employee AND t.date = l.date AND l.time_from <= t.time_from AND l.time_to >= t.time_to where t.date BETWEEN '".$start_date."' and '".$end_date."' and t.status IN(1,2)";
    //     if($cust){
    //         $this->sql_query .= " AND t.customer='".$cust."'";
    //     }
    //     $this->order_by = array('date','time_from', 'time_to', 'employee');
       
        
    //     $data1 = array();
       
    //     $query = $this->sql_query;
    //     $query_iteration = 0;
    //     do{
    //         $offset = '';                
    //         if($query_iteration){
    //             $offset = 5000 * $query_iteration;
    //         }
    //         $this->sql_query = $query.' LIMIT 5000';
    //         if($offset){
    //             $this->sql_query .= ' OFFSET '.$offset;
    //         }
    //         echo $this->sql_query;
    //         exit();
    //         $result_query = $this->query_fetch();
    //         $data1 = array_merge($data1,$result_query);
    //         $query_iteration ++;
    //     }while(count($result_query));
    //     // if($_SESSION['user_id'] == 'dodo001'){
    //     //     echo "<pre>b". print_r($data1, 1)."</pre>";
    //     // }
    //     $datas = $this->employees_present();
    //     $cust_datas = $this->customers_present();

    //     //echo "<pre>b". print_r($datas, 1)."</pre>";
    //     //echo "<pre>c". print_r($cust_datas, 1)."</pre>";
        
    //     $data = array();
    //     $i=0;
    //     for($i=0;$i<count($data1);$i++){
    //         $data[$i]['customer'] = $data1[$i]['customer'];
    //         $data[$i]['date'] = $data1[$i]['date'];
    //         $data[$i]['time_from'] = $data1[$i]['time_from'];
    //         $data[$i]['time_to'] = $data1[$i]['time_to'];
    //         $data[$i]['type'] = $data1[$i]['type'];
    //         $data[$i]['status'] = $data1[$i]['status'];
    //         $data[$i]['emp_username'] = $data1[$i]['employee'];
    //         $data[$i]['fkkn'] = $data1[$i]['fkkn'];
    //         $data[$i]['leave_type'] = $data1[$i]['leave_type'];
    //         for($j=0;$j<count($datas);$j++){
    //             if($data1[$i]['employee'] == $datas[$j]['username']){
    //                 if($_SESSION['company_sort_by'] == 1)
    //                     $data[$i]['employee'] = $datas[$j]['first_name']." ".$datas[$j]['last_name'];
    //                 elseif($_SESSION['company_sort_by'] == 2)
    //                     $data[$i]['employee'] = $datas[$j]['last_name']." ".$datas[$j]['first_name'];
    //                 $data[$i]['color'] = $datas[$j]['color'];
    //             }
    //         }
    //         for($j=0;$j<count($datas);$j++){
    //             if($data1[$i]['customer'] == $cust_datas[$j]['username']){
    //                 if($_SESSION['company_sort_by'] == 1)
    //                     $data[$i]['customer_name'] = $cust_datas[$j]['first_name']." ".$cust_datas[$j]['last_name'];
    //                 elseif($_SESSION['company_sort_by'] == 2)
    //                     $data[$i]['customer_name'] = $cust_datas[$j]['last_name']." ".$cust_datas[$j]['first_name'];
    //                 $data[$i]['customer_first_name'] = $cust_datas[$j]['first_name'];
    //                 $data[$i]['customer_last_name'] = $cust_datas[$j]['last_name'];
                    
    //             }
    //         }
    //     }

    //     if($_SESSION['user_id'] == 'dodo001'){
            
            
    //         echo "<pre>a". print_r($data, 1)."</pre>"; 
    //         exit();
    //     }
    //        // echo "<pre>b". print_r($data, 1)."</pre>";
        
    //    // $days1 = cal_days_in_month(CAL_GREGORIAN, $month, $year);     old code on month and year
    //    // $week_num_start = date('W',  strtotime($year."-".$month."-01"));
       
    //     $week_num_start = date('W',  strtotime($start_date));
        
        
    //     /* echo $week_num_start = date('d',  strtotime($year."-".$month."-01"));
    //     echo $week_num_start = date('W',  strtotime('-1 day', strtotime($year."-".$month."-01")));
    //     echo $week_num_start = date('d',  strtotime('-1 day', strtotime($year."-".$month."-01")));*/
        
        
    //     $val = $week_num_start;
    //     if($month == '12'){
    //        $week_num_end = date('W',  strtotime($end_date));
    //        if($week_num_end == '01'){
    //            for($i=31;$i>0;$i--){
    //                $week_num_end = date('W',  strtotime($year."-".$month."-".$i));
    //                if($week_num_end != '01'){
    //                    break;
    //                }
    //            }
    //             $week_num_end = $week_num_end +1;
    //        }
    //     }else{
    //         $week_num_end = date('W',  strtotime($end_date));
    //     }
    //     $week_num_end_new = date('W',  strtotime($end_date));
    //     if($week_num_end_new == '01'){
    //        // echo "$week_num_end ---- $week_num_start --- $week_num_end_new --- $year  _ ";
    //         for($i=0;$i<(($week_num_end)-$week_num_start);$i++){
    //             $result[$i] = array(
    //                 'week' => $val ,
    //                 'employee'=>array(),
    //                 'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w"))),
    //                 'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w")),date("Y", strtotime($year."-W".$val."-". 1 ."w"))),
    //                 'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w")),date("Y", strtotime($year."-W".$val."-". 2 ."w"))),
    //                 'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w")),date("Y", strtotime($year."-W".$val."-". 3 ."w"))),
    //                 'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w")),date("Y", strtotime($year."-W".$val."-". 4 ."w"))),
    //                 'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w")),date("Y", strtotime($year."-W".$val."-". 5 ."w"))),
    //                 'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")),date("Y", strtotime($year."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
    //            // $result[$i] = array('week' => $val ,'employee'=>array(),'sun'=>date("d", strtotime($year."-W".$val."-". 0 ."w")),'mon'=>$year."-W".$val."-". 1 ."w",'tue'=>$year."-W".$val."-". 2 ."w",'wed'=>$year."-W".$val."-". 3 ."w",'thu'=>$year."-W".$val."-". 4 ."w",'fri'=>$year."-W".$val."-". 5 ."w",'sat'=>$year."-W".$val."-". 6 ."w"); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
    //             $val++;
    //             $val = sprintf("%02d", $val);
    //         }
            
    //         /*//keep year as previous year if the date from previous year
    //         echo $tmp_year_sun = date("Y", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"));// > 15 ? $year : ($year+1);
    //         echo $tmp_year_mon = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w"));// > 15 ? $year : ($year+1);
    //         echo $tmp_year_tue = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w"));// > 15 ? $year : ($year+1);
    //         echo $tmp_year_wed = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w"));// > 15 ? $year : ($year+1);
    //         echo $tmp_year_thu = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w"));// > 15 ? $year : ($year+1);
    //         echo $tmp_year_fri = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w"));// > 15 ? $year : ($year+1);
    //         echo $tmp_year_sat = date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w"));// > 15 ? $year : ($year+1);*/
    //         $result[$i] = array(
    //             'week' => $week_num_end_new,
    //             'sun'=>array(date("d", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("m", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("Y", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"))),
    //             'mon'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w"))),
    //             'tue'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w"))),
    //             'wed'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w"))),
    //             'thu'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w"))),
    //             'fri'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w"))),
    //             'sat'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w")),date("Y", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w"))),
    //             /*'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())*/);
    //            // echo "<pre>result".print_r($result[$i], 1)."</pre>";
    //        // $result[$i] = array('week' => $week_num_end_new,'sun'=>date("d", strtotime($year."-W".$week_num_end_new."-". 0 ."w")),'mon'=>date("d", strtotime($year."-W".$week_num_end_new."-". 1 ."w")),'tue'=>date("d", strtotime($year."-W".$week_num_end_new."-". 2 ."w")),'wed'=>date("d", strtotime($year."-W".$week_num_end_new."-". 3 ."w")),'thu'=>date("d", strtotime($year."-W".$week_num_end_new."-". 4 ."w")),'fri'=>date("d", strtotime($year."-W".$week_num_end_new."-". 5 ."w")),'sat'=>date("d", strtotime($year."-W".$week_num_end_new."-". 6 ."w")),'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array()));
    //     }
    //     else{
            
    //         $i=0;
    //        // echo $week_num_start .'>'. $week_num_end;
    //         $m = 0;
    //         if($week_num_start > $week_num_end){
    //              $result[$i] = array(
    //                 'week' => $val ,
    //                 'employee'=>array(),
    //                 'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", 1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", 1) ."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", 1) ."-". 0 ."w"))),
    //                 'mon'=>array(date("d", strtotime(($year-1)."-W".$val."-". 1 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 1 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 1 ."w"))),
    //                 'tue'=>array(date("d", strtotime(($year-1)."-W".$val."-". 2 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 2 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 2 ."w"))),
    //                 'wed'=>array(date("d", strtotime(($year-1)."-W".$val."-". 3 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 3 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 3 ."w"))),
    //                 'thu'=>array(date("d", strtotime(($year-1)."-W".$val."-". 4 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 4 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 4 ."w"))),
    //                 'fri'=>array(date("d", strtotime(($year-1)."-W".$val."-". 5 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 5 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 5 ."w"))),
    //                 'sat'=>array(date("d", strtotime(($year-1)."-W".$val."-". 6 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 6 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
    //             $val=1;
    //             $val = sprintf("%02d", $val);
    //             $week_num_start = 1;
    //             $i++;
    //             $m = 1;
    //         }
    //        // echo '<br>'.$i.'=='.$week_num_start .'>'. $week_num_end;
    //         for(;$i<(($week_num_end+1)-$week_num_start+$m);$i++){
    //             $result[$i] = array(
    //                 'week' => $val ,
    //                 'employee'=>array(),
    //                 'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w"))),
    //                 'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w")),date("Y", strtotime($year."-W".$val."-". 1 ."w"))),
    //                 'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w")),date("Y", strtotime($year."-W".$val."-". 2 ."w"))),
    //                 'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w")),date("Y", strtotime($year."-W".$val."-". 3 ."w"))),
    //                 'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w")),date("Y", strtotime($year."-W".$val."-". 4 ."w"))),
    //                 'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w")),date("Y", strtotime($year."-W".$val."-". 5 ."w"))),
    //                 'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")),date("Y", strtotime($year."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
    //            // $result[$i] = array('week' => $val ,'employee'=>array(),'sun'=>date("d", strtotime($year."-W".$val."-". 0 ."w")),'mon'=>$year."-W".$val."-". 1 ."w",'tue'=>$year."-W".$val."-". 2 ."w",'wed'=>$year."-W".$val."-". 3 ."w",'thu'=>$year."-W".$val."-". 4 ."w",'fri'=>$year."-W".$val."-". 5 ."w",'sat'=>$year."-W".$val."-". 6 ."w"); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
    //             $val++;
    //             $val = sprintf("%02d", $val);
    //         } 
    //     }
    //     //$week_num_end = date('W',  strtotime($year."-".$month."-".$days1));
    //     // echo "<pre>b". print_r($data, 1)."</pre>";
    //     $val1=0;
    //     for($i=0;$i<count($data);$i++){
    //         $week_num = date('W',  strtotime($data[$i]['date']));
    //         $day = date('w', strtotime($data[$i]['date']));
    //         $days = date('D', strtotime($data[$i]['date']));
    //         for($j=0;$j<count($result);$j++){
    //             $weekly_sum = "0.0";
    //             if($result[$j]['week'] == $week_num){ 
    //                 if($data[$i]['emp_username'] != ''){
    //                     if(count($result[$j]['employee']) == 0){
    //                         $result[$j]['employee'][0]['name'] = $data[$i]['employee'];
    //                         $result[$j]['employee'][0]['color'] = $data[$i]['color'];
    //                         $result[$j]['employee'][0]['sum'] = "0.0";
    //                         //sun'] = "0.0";
    //                         //$result[$j]['employee'][0]['sum_
    //                         //$result[$j]['employee'][0][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
    //                         $result[$j]['employee'][0][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
    //                         if($data[$i]['status'] != 2){
    //                             $result[$j]['employee'][0]['sum'] = $this->time_sum($result[$j]['employee'][0]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
    //                         }
    //                         $result[$j]['employee'][0]['emp_username'] = $data[$i]['emp_username'];//added for new comp
    //                         $result[$j]['employee'][0]['customer'] = $data[$i]['customer'];//added for geroge
    //                     }
    //                     else{
                            
    //                         for($k=0;$k<count($result[$j]['employee']);$k++){
                                
    //                             if($result[$j]['employee'][$k]['emp_username'] == $data[$i]['emp_username']){
                                    
    //                                // if($data[$i]['status'] == 1){
    //                                //     if($day == 0){
    //                                //         if($data[$i]['type'] == 0){
    //                                             //$result[$j]['employee'][$k][$days][count($result[$j]['employee'][$k][$days])] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
    //                                             $result[$j]['employee'][$k][$days][count($result[$j]['employee'][$k][$days])] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
    //                                             if($data[$i]['status'] != 2){
    //                                                 $result[$j]['employee'][$k]['sum'] = $this->time_sum($result[$j]['employee'][$k]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                                                    
    //                                             }
    //                                             break;
    //                             }
    //                         }
                            
    //                         if($k == count($result[$j]['employee'])){
    //                             $result[$j]['employee'][$k]['name'] = $data[$i]['employee'];
    //                             $result[$j]['employee'][$k]['color'] = $data[$i]['color'];
    //                            // if($data[$i]['status'] == 1){
    //                            // if($day == 0){
    //                            //     if($data[$i]['type'] == 0){
    //                                     //$result[$j]['employee'][$k][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
    //                                     $result[$j]['employee'][$k][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
    //                                     if($data[$i]['status'] != 2){
    //                                         $result[$j]['employee'][$k]['sum'] = date('H.i',  strtotime($this->time_sum($result[$j]['employee'][$k]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))));
                                        
    //                                     }//sun'] = $this->time_sum(//sun'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
    //                             $result[$j]['employee'][$k]['emp_username'] = $data[$i]['emp_username']; //Added for new comp     
    //                             $result[$j]['employee'][$k]['customer'] = $data[$i]['customer'];//added for geroge
    //                         }
    //                     }
    //                 } 
    //                 //unmanned
    //                 else {
    //                     // $result[$j]['unmanned']['sum'] = "0.0";
    //                     $result[$j]['unmanned'][$days][] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'].",".$data[$i]['leave_type'];
    //                     if($data[$i]['status'] != 2){
    //                         $result[$j]['unmanned']['sum'] = $this->time_sum($result[$j]['unmanned']['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
    //                     }
    //                     // $result[$j]['unmanned']['customer'] = $data[$i]['customer'];//added for geroge
    //                 }
    //                 break;
    //             }
                  
    //         } 
             
    //     }
    //    $i=0;
    //    if(!empty($result)){
    //         foreach($result as $res){
    //             $j=0;
    //             if(!empty($res['employee'])){
    //                  foreach($res['employee'] as $emp){
    //                      if(array_key_exists('sum', $emp)){
    //                          $result[$i]['employee'][$j]['sum'] = $this->time_user_format($emp['sum'], 100);
    //                      }
    //                      $j++;
    //                  }
    //             }
    //             $i++;
    //         }
    //    }
    //    //echo "<pre>b". print_r($result, 1)."</pre>";
    //    return $result;
      
    // }
    
    function customer_list(){
        $this->tables = array('customer');
        $this->fields = array('username','first_name','last_name');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data)
            return $data;
        else
            return false;
    }
    
    function customer_team(){
        $this->tables = array('team');
        $this->fields = array('username','first_name','last_name');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data)
            return $data;
        else
            return false;
    }
    
    function employees_present(){
        $this->tables = array('employee');
        $this->fields = array('username','first_name','last_name','color');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
//    function employee_timetable_month($emp,$month,$year,$conditions_extra = array()){
    function employee_timetable_month($emp,$start_date,$end_date,$conditions_extra = array()){
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $smarty = new smartySetup(array('messages.xml'),FALSE);
        $obj_customer = new customer();
        $month = date('m',  strtotime($end_date));
        $year= date('Y',  strtotime($end_date));
        if($emp == "" || $emp == NULL){
            $customers_list = $obj_customer->customer_list();
            $cust_conditions = array('OR');
            for($i=0;$i<count($customers_list);$i++){
                $cust_conditions[] = 'customer = "'.$customers_list[$i]['username'].'"';
            }
        }


        $tl_accessible_customers = array();
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6 && $emp != $_SESSION['user_id']){
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer');
            $this->conditions = array('AND', 'employee = ?', 'role = ?');
            $this->condition_values = array($_SESSION['user_id'],$_SESSION['user_role']);
            $this->query_generate();
            $tl_accessible_customers_temp = $this->query_fetch();            
            $tl_accessible_customers = array_column($tl_accessible_customers_temp, 'customer');
        }
        if($start_date <= $boundary_date && $end_date > $boundary_date){
            $this->tables = array('timetable` as `t');
            $this->fields = array('employee','customer','date','time_from','time_to','type','status',
                "(SELECT type FROM `leave` where t.employee like employee AND t.date = date AND time_from <= t.time_from AND time_to >= t.time_to) AS leave_type");
            if($emp == "" || $emp == NULL){
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2','status = 0'),$cust_conditions); 
                $this->condition_real = array($start_date,$end_date);
            }
            else{
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'employee = ?',array('OR','status = 1','status = 2','status = 0'));
                $condition_real = array($start_date,$end_date,$emp);
            }
            if(!empty($conditions_extra))
                $this->conditions[] = $conditions_extra;
            $this->order_by = array('date','time_from');
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $this->tables = array('backup_timetable` as `t');
            $this->fields = array('employee','customer','date','time_from','time_to','type','status',
                "(SELECT type FROM `backup_leave` where t.employee like employee AND t.date = date AND time_from <= t.time_from AND time_to >= t.time_to) AS leave_type");
            if($emp == "" || $emp == NULL){
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2','status = 0'),$cust_conditions); 
                $condition_backup = array($start_date,$end_date);
            }
            else{
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'employee = ?',array('OR','status = 1','status = 2','status = 0'));
                $condition_backup = array($start_date,$end_date,$emp);
            }
            if(!empty($conditions_extra))
                $this->conditions[] = $conditions_extra;
            $this->order_by = array('date','time_from');
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->condition_values = array_merge($condition_real, $condition_backup);
            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($start_date <= $boundary_date && $end_date <= $boundary_date){
            $this->tables = array('backup_timetable` as `t'); 
            $leave_table  = 'backup_leave'; 
            $proceed = true;
        }
        else if($start_date > $boundary_date && $end_date > $boundary_date){
            $this->tables = array('timetable` as `t');
            $leave_table  = 'leave';
            $proceed = true;
        }
        if($proceed == true){
            $this->fields = array('employee','customer','date','time_from','time_to','type','status',
                "(SELECT type FROM `".$leave_table."`where t.employee like employee AND t.date = date AND time_from <= t.time_from AND time_to >= t.time_to) AS leave_type");
            if($emp == "" || $emp == NULL){
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),array('OR','status = 1','status = 2','status = 0'),$cust_conditions); 
                $this->condition_values = array($start_date,$end_date);
            }
            else{
                $this->conditions = array('AND',array('BETWEEN', 'date', '?', '?'),'employee = ?',array('OR','status = 1','status = 2','status = 0'));
                $this->condition_values = array($start_date,$end_date,$emp);
            }
            if(!empty($conditions_extra))
                $this->conditions[] = $conditions_extra;
    //        $this->condition_values = array($month,$year,$emp);
            $this->order_by = array('date','time_from');
            $this->query_generate();
        }
        $data1 = $this->query_fetch();
        // echo "<pre>".print_r($this->query_error_details, 1)."<pre>";
        // echo "<pre>".print_r($data1, 1)."<pre>"; exit();
        $result = array();
        $datas1 = $this->customers_present();
        $emp_data = $this->employees_present();
        for($i=0;$i<count($data1);$i++){
            $datas[$i]['customers_ids'] = $data1[$i]['customer'];
            $datas[$i]['date'] = $data1[$i]['date'];
            $datas[$i]['time_from'] = $data1[$i]['time_from'];
            $datas[$i]['time_to'] = $data1[$i]['time_to'];
            $datas[$i]['type'] = $data1[$i]['type'];
            $datas[$i]['status'] = $data1[$i]['status'];
            $datas[$i]['emp_username'] = $data1[$i]['employee'];
            $datas[$i]['leave_type'] = $data1[$i]['leave_type'];
            if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6  && $emp != $_SESSION['user_id'] && !in_array($data1[$i]['customer'], $tl_accessible_customers)){
                $datas[$i]['customer'] = $smarty->translate['works_on_another_customer'];                

            }
            else{
                for($j=0;$j<count($datas1);$j++){
                    if($data1[$i]['customer'] == $datas1[$j]['username']){
                        if($_SESSION['company_sort_by'] == 1)
                            $datas[$i]['customer'] = $datas1[$j]['first_name']." ".$datas1[$j]['last_name'];
                        elseif($_SESSION['company_sort_by'] == 2)
                            $datas[$i]['customer'] = $datas1[$j]['last_name']." ".$datas1[$j]['first_name'];
                    }
                }
            }

            for($j=0;$j<count($emp_data);$j++){
                if($data1[$i]['employee'] == $emp_data[$j]['username']){
                    $datas[$i]['employee_name'] = $emp_data[$j]['last_name']." ".$emp_data[$j]['first_name'];
                    $datas[$i]['employee_first_name'] = $emp_data[$j]['first_name'];
                    $datas[$i]['employee_last_name'] = $emp_data[$j]['last_name'];
                }
            }
        }
        //print_r($datas);
//        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);    old code regarning month and year
        $week_num_start = date('W',  strtotime($start_date));
        $val = $week_num_start;
        if($month == '12'){
           $week_num_end = date('W',  strtotime($end_date));
           if($week_num_end == '01'){
               for($i=30;$i>0;$i--){
                   $week_num_end = date('W',  strtotime($year."-".$month."-".$i));
                   if($week_num_end != '01'){
                       break;
                   }
               }
               $week_num_end = $week_num_end +1;
           }
        }else{
            $week_num_end = date('W',  strtotime($end_date));
        }
        $week_num_end_new = date('W',  strtotime($end_date));
        
        if($week_num_end_new == '01'){
           for($i=0;$i<(($week_num_end)-$week_num_start);$i++){
                $result[$i] = array('week' => $val,
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w")),date("Y", strtotime($year."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w")),date("Y", strtotime($year."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w")),date("Y", strtotime($year."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w")),date("Y", strtotime($year."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w")),date("Y", strtotime($year."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")),date("Y", strtotime($year."-W".$val."-". 6 ."w"))),
                    'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            } 
            $result[$i] = array('week' => $week_num_end_new,
                'sun'=>array(date("d", strtotime($year+1 ."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("m", strtotime($year+1 ."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("Y", strtotime($year+1 ."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"))),
                'mon'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 1 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 1 ."w")),date("Y", strtotime($year+1 ."-W".$week_num_end_new."-". 1 ."w"))),
                'tue'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 2 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 2 ."w")),date("Y", strtotime($year+1 ."-W".$week_num_end_new."-". 2 ."w"))),
                'wed'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 3 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 3 ."w")),date("Y", strtotime($year+1 ."-W".$week_num_end_new."-". 3 ."w"))),
                'thu'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 4 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 4 ."w")),date("Y", strtotime($year+1 ."-W".$week_num_end_new."-". 4 ."w"))),
                'fri'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 5 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 5 ."w")),date("Y", strtotime($year+1 ."-W".$week_num_end_new."-". 5 ."w"))),
                'sat'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 6 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 6 ."w")),date("Y", strtotime($year+1 ."-W".$week_num_end_new."-". 6 ."w"))),
                'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array()));
        }else{
            //echo $val."-".$week_num_end."-".$week_num_start."<br>";
            $i=0;
            $m = 0;
            if($week_num_start > $week_num_end){
                 $result[$i] = array('week' => $val,
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", 01)."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", 01)."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", 01)."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime(($year-1)."-W".$val."-". 1 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 1 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime(($year-1)."-W".$val."-". 2 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 2 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime(($year-1)."-W".$val."-". 3 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 3 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime(($year-1)."-W".$val."-". 4 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 4 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime(($year-1)."-W".$val."-". 5 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 5 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime(($year-1)."-W".$val."-". 6 ."w")),date("m", strtotime(($year-1)."-W".$val."-". 6 ."w")),date("Y", strtotime(($year-1)."-W".$val."-". 6 ."w"))),
                    'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val=1;
                $val = sprintf("%02d", $val);
                $week_num_start = 1;
                $i++;
                $m = 1;
            }
            
            for(;$i<(($week_num_end+1)-$week_num_start+$m);$i++){
                $result[$i] = array('week' => $val,
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w")),date("Y", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w")),date("Y", strtotime($year."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w")),date("Y", strtotime($year."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w")),date("Y", strtotime($year."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w")),date("Y", strtotime($year."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w")),date("Y", strtotime($year."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")),date("Y", strtotime($year."-W".$val."-". 6 ."w"))),
                    'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            }
        }
        //echo "<pre>".print_r($result, 1)."</pre>";
        for($i=0;$i<count($datas);$i++){
            $week_num = date('W',  strtotime($datas[$i]['date']));
            $day = date('w', strtotime($datas[$i]['date']));
            for($j=0;$j<count($result);$j++){
                if($result[$j]['week'] == $week_num){
                    //$result[$j]['data']['sum'] = "0.0";
                  if($day == 0){
                    //$result[$j]['data']['sum'] = "0.0";
                    if(count($result[$j]['data']['sun']) == 0){
                        //echo "hello";
                        $result[$j]['data']['sun'][0]['customer'] = $datas[$i]['customer'];
                        //$result[$j]['data']['sun'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".date('H.i',  strtotime($datas[$i]['time_to'])).",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100);
                        $result[$j]['data']['sun'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['sun']);
                        $result[$j]['data']['sun'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['sun'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                        
                    }
                  }
                  if($day == 1){
                     if(count($result[$j]['data']['mon']) == 0){
                        $result[$j]['data']['mon'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['mon'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['mon']);
                        $result[$j]['data']['mon'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['mon'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 2){
                     if(count($result[$j]['data']['tue']) == 0){
                        $result[$j]['data']['tue'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['tue'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['tue']);
                        $result[$j]['data']['tue'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['tue'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 3){
                     if(count($result[$j]['data']['wed']) == 0){
                        $result[$j]['data']['wed'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['wed'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['wed']);
                        $result[$j]['data']['wed'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['wed'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 4){
                     if(count($result[$j]['data']['thu']) == 0){
                        $result[$j]['data']['thu'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['thu'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['thu']);
                        $result[$j]['data']['thu'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['thu'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 5){
                     if(count($result[$j]['data']['fri']) == 0){
                        $result[$j]['data']['fri'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['fri'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['fri']);
                        $result[$j]['data']['fri'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['fri'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 6){
                     if(count($result[$j]['data']['sat']) == 0){
                        $result[$j]['data']['sat'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['sat'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['sat']);
                        $result[$j]['data']['sat'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['sat'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'].",".$datas[$i]['leave_type'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                }
            }
        }
        $i=0;
        for($i=0;$i<count($result);$i++){
            $time_sum =  $this->time_user_format($result[$i]['data']['sum'], 100);
            if($time_sum == .00){
                $time_sum = '';
            }
            $result[$i]['data']['sum'] = $time_sum;
        }
        return $result;
        
    }
    function customers_present(){
        $this->tables = array('customer');
        $this->fields = array('username','first_name','last_name');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function customer_week_time_sum($arrays){
        for($i=0;$i<count($arrays);$i++){
            $result[$i] = array('sun'=>'0.0','mon'=>'0.0','tue'=>'0.0','wed'=>'0.0','thu'=>'0.0','fri'=>'0.0','sat'=>'0.0');
        }

        for($i=0;$i<count($arrays);$i++){
            //print_r($arrays[$i]['employee']);
            
            for($j=0;$j<count($arrays[$i]['employee']);$j++){                
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Mon']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Mon'][$k]);
                   if($time_view[2] == 1){
                       
                        $result[$i]['mon'] = $this->time_sum($result[$i]['mon'],$this->time_user_format($time_view[3]));
                        
                   } 
               }
               
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Sun']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Sun'][$k]);
                   if($time_view[2] == 1){
                       
                        $result[$i]['sun'] = $this->time_sum($result[$i]['sun'], $this->time_user_format($time_view[3]));
                   } 
               }
               
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Tue']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Tue'][$k]);
                   if($time_view[2] == 1){
                       $result[$i]['tue'] = $this->time_sum($result[$i]['tue'], $this->time_user_format($time_view[3]));
                   } 
               }
               
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Wed']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Wed'][$k]);
                   if($time_view[2] == 1){
                        $result[$i]['wed'] = $this->time_sum($result[$i]['wed'],$this->time_user_format($time_view[3]));
                   } 
               }
               
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Thu']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Thu'][$k]);
                   if($time_view[2] == 1){
                        $result[$i]['thu'] = $this->time_sum($result[$i]['thu'], $this->time_user_format($time_view[3]));
                   } 
               }
               
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Fri']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Fri'][$k]);
                   if($time_view[2] == 1){
                        $result[$i]['fri'] = $this->time_sum($result[$i]['fri'], $this->time_user_format($time_view[3]));
                   } 
               }
               
               for($k=0;$k<count($arrays[$i]['employee'][$j]['Sat']);$k++){
                   $time_view = explode(",", $arrays[$i]['employee'][$j]['Sat'][$k]);
                   if($time_view[2] == 1){
                        $result[$i]['sat'] = $this->time_sum($result[$i]['sat'],$this->time_user_format($time_view[3]));
                   } 
               }
               
               
            }
           
        }
        $i=0;
        if(!empty($result)){
            foreach($result as $res){
                foreach($res as $key => $time){
                    $result[$i][$key] = $this->time_user_format($time,100);
                }
                $i++;
            }
        }
        return $result;
    }
    
    function employee_week_time_sum($arrays){
        //print_r($arrays);
        for($i=0;$i<count($arrays);$i++){
            $result[$i] = array('sun'=>'0.0','mon'=>'0.0','tue'=>'0.0','wed'=>'0.0','thu'=>'0.0','fri'=>'0.0','sat'=>'0.0');
        }
        for($i=0;$i<count($arrays);$i++){
            //echo "<br>".count($arrays[$i]['data']['wed']);
            for($j=0;$j<count($arrays[$i]['data']['mon']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['mon'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['mon'] = $this->time_sum($result[$i]['mon'],$this->time_user_format($time_view[3]));
                   } 
            }
            
            for($j=0;$j<count($arrays[$i]['data']['tue']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['tue'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['tue'] = $this->time_sum($result[$i]['tue'], $this->time_user_format($time_view[3]));
                   } 
            }
            
            for($j=0;$j<count($arrays[$i]['data']['wed']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['wed'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['wed'] = $this->time_sum($result[$i]['wed'],$this->time_user_format($time_view[3]));
                   } 
            }
            
            for($j=0;$j<count($arrays[$i]['data']['thu']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['thu'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['thu'] = $this->time_sum($result[$i]['thu'], $this->time_user_format($time_view[3]));
                   } 
            }
            
            for($j=0;$j<count($arrays[$i]['data']['fri']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['fri'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['fri'] = $this->time_sum($result[$i]['fri'],$this->time_user_format($time_view[3]));
                   } 
            }
           
            for($j=0;$j<count($arrays[$i]['data']['sat']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['sat'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['sat'] = $this->time_sum($result[$i]['sat'],$this->time_user_format($time_view[3]));
                   } 
            }
            
            for($j=0;$j<count($arrays[$i]['data']['sun']);$j++){
                $time_view = explode(",", $arrays[$i]['data']['sun'][$j]['time']);
                   if($time_view[2] == 1){
                        $time = explode("-",$time_view[0]);
                        $result[$i]['sun'] = $this->time_sum($result[$i]['sun'],$this->time_user_format($time_view[3]));
                   } 
            }
            
        }
        $i=0;
        foreach($result as $res){
            foreach($res as $key => $time){
                $result[$i][$key] = $this->time_user_format($time,100);
            }
            $i++;
        }
        return $result;
    }

    function customers_under_leave_employee($cur_month,$cur_year){
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$cur_year-$cur_month-01"));
        $todate = date('Y-m-t', strtotime("$cur_year-$cur_month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->customers_under_leave_employee_process($cur_month,$cur_year, 1);
            $query_2_action = $this->customers_under_leave_employee_process($cur_month,$cur_year, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY LOWER(last_name), LOWER(first_name)';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->customers_under_leave_employee_process($cur_month,$cur_year, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->customers_under_leave_employee_process($cur_month,$cur_year, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return $datas;
        
    }
    function customers_under_leave_employee_process($cur_month,$cur_year, $mode = 1){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all customers who have atleast one employee he tooks atleast 1 sick leave(type = 1) on a specified year-month
         * last edited on : 2014-02-15
         */
        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        $timetable = $mode == 1 ? '`timetable`' : '`backup_timetable`';
        $leave = $mode == 1 ? '`leave`' : '`backup_leave`';
        
        $this->flush();
        switch ($login_user_role) {

            case 1:
            case 6:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust , concat(c.first_name, " ", c.last_name) as cust_ff, c.first_name, c.last_name 
                                    FROM '.$timetable.' AS t
                                    JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 1 AND l.status = 1)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != ""
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month,$cur_year);
                return array(
                    'sql_query'         => $this->sql_query,
                    'condition_values'  => $this->condition_values
                );
                // $data = $this->query_fetch();
                break;
            case 2:
            case 3:
            case 5:
            case 7:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust, concat(c.first_name, " ", c.last_name) as cust_ff, c.first_name, c.last_name   
                                    FROM '.$timetable.' AS t
                                    JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 1)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != ""
                                    AND c.username IN (
                                                        SELECT customer 
                                                        FROM `team`
                                                        WHERE employee = ?
                                                        )
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month, $cur_year, $login_user);
                return array(
                    'sql_query'         => $this->sql_query,
                    'condition_values'  => $this->condition_values
                );
                // $data = $this->query_fetch();
                break;
            case 4:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust, concat(c.first_name, " ", c.last_name) as cust_ff, c.first_name, c.last_name  
                                    FROM '.$timetable.' AS t
                                    JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 1)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != "" AND c.username = ?
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month, $cur_year, $login_user);
                return array(
                    'sql_query'         => $this->sql_query,
                    'condition_values'  => $this->condition_values
                );
                // $data = $this->query_fetch();
                break;
        }
        
        return array();
        
    }
    
    function employees_leave_under_customer($month, $year, $cust){
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->employees_leave_under_customer_process($month, $year, $cust, 1);
            $query_2_action = $this->employees_leave_under_customer_process($month, $year, $cust, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY LOWER(last_name), LOWER(first_name)';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->employees_leave_under_customer_process($month, $year, $cust, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->employees_leave_under_customer_process($month, $year, $cust, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return (!empty($datas) ? $datas : FALSE);
    }

    function employees_leave_under_customer_process($month, $year, $cust, $mode = 1){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all employees who have atleast one sick leave(type = 1) on a specified customer-year-month
         * last edited on : 2014-02-15
         */

        $timetable = $mode == 1 ? '`timetable`' : '`backup_timetable`';
        $leave = $mode == 1 ? '`leave`' : '`backup_leave`';

        $this->flush();
        $this->sql_query = 'SELECT DISTINCT t.employee as employee_id, CONCAT(e.last_name, " ", e.first_name) as employee , CONCAT(e.first_name, " ", e.last_name) as employee_ff, e.first_name, e.last_name  
                            FROM '.$timetable.' AS t
                            JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                AND l.time_to >= t.time_to AND l.type = 1 AND l.status = 1)
                            JOIN `employee` AS e ON (e.username = t.employee)
                            WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer = ? 
                            ORDER BY LOWER(e.last_name), LOWER(e.first_name)';
        $this->condition_values = array($month, $year, $cust);
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
        // $data = $this->query_fetch();
        // return (!empty($data) ? $data : FALSE);
    }
    
    function relations_leave_employee($month, $year, $cust, $emp, $sort = TRUE){
        $employee = new employee();
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $data = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->relations_leave_employee_process($month, $year, $cust, $emp, 1);
            $query_2_action = $this->relations_leave_employee_process($month, $year, $cust, $emp, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $data = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->relations_leave_employee_process($month, $year, $cust, $emp, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $data = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->relations_leave_employee_process($month, $year, $cust, $emp, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $data = $this->query_fetch();
            }
        }
        
        $flg_holiday = 0;
        $inconv = $employee->get_holiday_details($month, $year);
        if(empty ($inconv)){ 
            $this->tables = array('inconvenient_timing');
            $this->fields = array('name','effect_from','effect_to','time_from','time_to','type','days', '"INCONVENIENT" as category');
            $this->conditions = array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?'));
            $this->condition_values = array($month,$year,$month,$year,$month,$year);
            $this->query_generate();
            $inconv = $this->query_fetch();
        }else
            $flg_holiday = 1;
        
        
        if(!empty($data))
        {
            $query_1_action = $this->relations_leave_employee_process_empty_slots($month, $year, $cust, $emp, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $dataEmptySlots = $this->query_fetch();
                $i=0;
                $emptySlotsArr = array();
                if(!empty($dataEmptySlots))
                {
                    foreach($dataEmptySlots as $emptySlots)
                    {
                        $emptySlotsArr[$i] = $emptySlots;
                        $emptySlotsArr[$i]['employee'] = "";
                         $i++;
                    }
                }
                
                if(!empty($emptySlotsArr))
                {
                    $data = array_merge($data,$emptySlotsArr);
                }
                
               /*if($sort){
                   $data = $this->sort_array1($data);
                }*/
               //$data = $this->sort_array1($data);
               $data = $this->phparraysort($data, array('date','time_from'));
               $data = array_values($data);
            //echo "<pre>";
            //print_r($data);exit;
            }
        }
        
        $result = array();
        if(!empty($data)){
            $relations_counts = count($data);
            $inconvenients_count = count($inconv);
            // $process_normal_slot_types = array(0,1,2,4,5,6,7,8,10,11,12,15);
            // $process_oncall_slot_types = array(3,9,13,14);
        
            for($i=0 ; $i < $relations_counts ; $i++){
               // $date_day = date('N', strtotime($data[$i]['date']));
                $result[$i]['date']     = $data[$i]['date'];
                $result[$i]['time_from']= $data[$i]['time_from'];
                $result[$i]['time_to']  = $data[$i]['time_to'];
                $result[$i]['type']     = $data[$i]['type'];
                $result[$i]['status']   = $data[$i]['status'];
                $result[$i]['tot_time'] = $this->time_user_format($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']), 100);
                $result[$i]['employee'] = $data[$i]['employee'];
                $result[$i]['employee_id'] = $data[$i]['employee_id'];
                $result[$i]['relation_id'] = $data[$i]['relation_id'];
               // $result[$i]['inconv'] = $employee->check_condition_holiday($data[$i], $inconv);
                $result[$i]['inconv'] = $this->get_work_hours_inconvenience($data[$i], $inconv);
                $result[$i]['inconv'] = (!empty($result[$i]['inconv']) ? implode(', ', $result[$i]['inconv']) : '');    //set as single string with , seperated
            }
            
            $tmp_relations = array();
            for($i = 0 ; $i<count($result); $i++){
                $flg=0;
                foreach($tmp_relations as $tmp){
                    if(in_array($tmp['employee_id'], $result[$i])){
                        $flg = 1;
                        break;
                    }
                }
                $tmp_relations[$i] = $result[$i];
                $tmp_relations[$i]['repeat'] = $flg == 1 ? 1 :  0;
            }
            return $tmp_relations;
        }
        else
            return array();
    }
    
    function phparraysort($Array, $SortBy=array(), $Sort = SORT_REGULAR) {
    if (is_array($Array) && count($Array) > 0 && !empty($SortBy)) {
            $Map = array();
            foreach ($Array as $Key => $Val) {
                $Sort_key = '';
                    foreach ($SortBy as $Key_key) {
                        $Sort_key .= $Val[$Key_key];
                    }                
                $Map[$Key] = $Sort_key;
            }   
            asort($Map, $Sort);
            $Sorted = array();
            foreach ($Map as $Key => $Val) {
                $Sorted[] = $Array[$Key];
            }
            return $Sorted;
    }
    return $Array;
}
    
    function sort_array1($array)	
    {	
        $keys = array_keys($array);	
    	
        $out = array();	
        $listorder = array();	
    	
        foreach($array as $key => $row)	
        {	
            $listorder[$key] = $row["date"];
            //$listorder[$key] = $row["time_from"];
        }	
    	
        array_multisort($listorder, SORT_ASC, $keys);	
        foreach($keys as $k)	
        {	
            $out[$k] = $array[$k];
        }	
        
        return $out;	
    }
    
    function sort_array2($array)	
    {	
        $keys = array_keys($array);	
    	
        $out = array();	
        $listorder = array();	
    	
        foreach($array as $key => $row)	
        {	
            $listorder[$key] = $row["time_from"];
        }	
    	
        array_multisort($listorder, SORT_ASC, $keys);	
        foreach($keys as $k)	
        {	
            $out[$k] = $array[$k];
        }	
        
        return $out;	
    }

    function relations_leave_employee_process($month, $year, $cust, $emp, $mode = 1){

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        // join with leave table to filter leave from vacation leave
        $this->flush();
        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 2' ,'t.customer = ?','t.employee = ?',
                    'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to', 'l.status = 1');
        $this->condition_values = array($month,$year,$cust,$emp);
        $this->query_generate();
        $time_table_ids = $this->query_fetch(2); 
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';
        
        $this->flush();
        $this->tables = array($timetable.'` as `t','employee` as `e');
        $this->fields = array('t.employee as employee_id','concat(first_name ," ", last_name) as employee','t.customer as customer','t.date as date','t.fkkn as fkkn','t.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status','t.relation_id as relation_id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 1',array('IN','t.relation_id',$ids),'t.customer = ?','e.username like t.employee');
        $this->condition_values = array($month,$year,$cust);
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
        // $data = $this->query_fetch();

        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }
    
    function relations_leave_employee_process_empty_slots($month, $year, $cust, $emp, $mode = 1){

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';
        
        /*
        // join with leave table to filter leave from vacation leave
        $this->flush();
        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 2' ,'t.customer = ?','t.employee = ?',
                    'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to', 'l.status = 1');
        $this->condition_values = array($month,$year,$cust,$emp);
        $this->query_generate();
        $time_table_ids = $this->query_fetch(2); 
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';
        */
        
         $tmpNul  = NULL;
        $this->flush();
        $this->tables = array($timetable.'` as `t');
        $this->fields = array('t.employee as employee_id','t.customer as customer','t.date as date','t.fkkn as fkkn','t.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status','t.relation_id as relation_id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 0','t.customer = ?','t.employee IS NULL');
        $this->condition_values = array($month,$year,$cust);
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
       
        // $data = $this->query_fetch();

        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }
    
    function relations_leave_employee_btwn_dates($date1, $date2, $cust, $emp){
        $employee = new employee();
        $obj_gen       = new general();

        $boundary_date = $obj_gen->get_boundary_date();
        $data = array();
        $fromdate = $date1;
        $todate = $date2;
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->relations_leave_employee_btwn_dates_process($date1, $date2, $cust, $emp, 1);
            $query_2_action = $this->relations_leave_employee_btwn_dates_process($date1, $date2, $cust, $emp, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $data = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->relations_leave_employee_btwn_dates_process($date1, $date2, $cust, $emp, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $data = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->relations_leave_employee_btwn_dates_process($date1, $date2, $cust, $emp, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $data = $this->query_fetch();
            }
        }
        
        $flg_holiday = 0;
        $temp_month = date('m', strtotime($date1));
        $temp_year = date('Y', strtotime($date1));
        $inconv = $employee->get_holiday_details($temp_month, $temp_year);
        if(empty ($inconv)){ 
            $this->tables = array('inconvenient_timing');
            $this->fields = array('name','effect_from','effect_to','time_from','time_to','type','days', '"INCONVENIENT" as category');
            $this->conditions = array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', array('BETWEEN', '?', 'effect_from', 'effect_to'), array('BETWEEN', '?', 'effect_from', 'effect_to')));
            $this->condition_values = array($date1, $date1, $date2);
            $this->query_generate();
            $inconv = $this->query_fetch();
        }else
            $flg_holiday = 1;
        
        $result = array();
        if(!empty($data)){
            $relations_counts = count($data);
            $inconvenients_count = count($inconv);
            // $process_normal_slot_types = array(0,1,2,4,5,6,7,8,10,11,12,15);
            // $process_oncall_slot_types = array(3,9,13,14);
        
            for($i=0 ; $i < $relations_counts ; $i++){
               // $date_day = date('N', strtotime($data[$i]['date']));
                $result[$i]['date'] = $data[$i]['date'];
                $result[$i]['time_from'] = $data[$i]['time_from'];
                $result[$i]['time_to'] = $data[$i]['time_to'];
                $result[$i]['type'] = $data[$i]['type'];
                $result[$i]['status'] = $data[$i]['status'];
                $result[$i]['tot_time'] = $this->time_user_format($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']), 100);
                $result[$i]['employee'] = $data[$i]['employee'];
                $result[$i]['employee_id'] = $data[$i]['employee_id'];
               // $result[$i]['inconv'] = $employee->check_condition_holiday($data[$i], $inconv);
                $result[$i]['inconv'] = $this->get_work_hours_inconvenience($data[$i], $inconv);
                $result[$i]['inconv'] = (!empty($result[$i]['inconv']) ? implode(', ', $result[$i]['inconv']) : '');    //set as single string with , seperated
            }
            
            $tmp_relations = array();
            for($i = 0 ; $i<count($result); $i++){
                $flg=0;
                foreach($tmp_relations as $tmp){
                    if(in_array($tmp['employee_id'], $result[$i])){
                        $flg = 1;
                        break;
                    }
                }
                $tmp_relations[$i] = $result[$i];
                $tmp_relations[$i]['repeat'] = $flg == 1 ? 1 :  0;
            }
            return $tmp_relations;
        }
        else
            return array();
    }

    function relations_leave_employee_btwn_dates_process($date1, $date2, $cust, $emp, $mode = 1){

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        // join with leave table to filter leave from vacation leave
        $this->flush();
        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 2' ,'t.customer = ?','t.employee = ?',
                    'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to', 'l.status = 1');
        $this->condition_values = array($date1, $date2, $cust, $emp);
        $this->query_generate();
        $time_table_ids = $this->query_fetch(2); 
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';
        
        $this->flush();
        $this->tables = array($timetable.'` as `t','employee` as `e');
        $this->fields = array('t.employee as employee_id','concat(first_name ," ", last_name) as employee','t.customer as customer','t.date as date','t.fkkn as fkkn','t.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status','t.relation_id as relation_id');
        $this->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 1',array('IN','t.relation_id',$ids),'t.customer = ?','e.username like t.employee');
        $this->condition_values = array($date1, $date2, $cust);
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
        // $data = $this->query_fetch();
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }
    
    function get_work_hours_inconvenience($work, $inconvenients) {
        
        $process_normal_slot_types = array(0,1,2,4,5,6,7,8,10,11,12,15);
        $process_oncall_slot_types = array(3,9,13,14);
        $work_day = date('N', strtotime($work['date']));
        
        if(empty($inconvenients)){
            if(in_array($work['type'], $process_normal_slot_types))
                    $included_slot_categories = array('Ord');
            else if(in_array($work['type'], $process_oncall_slot_types))
                    $included_slot_categories = array('Jour');
            
            return $included_slot_categories;
        }
        
        $employee = new employee();
        $work_from = $employee->convert_time_part($work['time_from']);
        $work_to = $employee->convert_time_part($work['time_to']);
        $included_slot_categories = array();
        
        $is_found = FALSE;
        foreach($inconvenients as $inconv){
            $i_days = explode(",", $inconv['days']);
            if (!in_array($work_day, $i_days)) continue;
                    
            if(in_array($work['type'], $process_normal_slot_types)){
                if($inconv['type'] != 0) continue;
            }
            else if(in_array($work['type'], $process_oncall_slot_types)){
                    if($inconv['type'] != 3) continue;
            }
            
            $holiday_from = $employee->convert_time_part($inconv['time_from']);
            $holiday_to = $employee->convert_time_part($inconv['time_to']);
                    
            if (
                    ($work_from <= $holiday_from && $work_to >= $holiday_to) ||
                    ($work_from <= $holiday_from && $work_to <= $holiday_to && $holiday_from < $work_to) ||
                    ($work_from >= $holiday_from && $work_to >= $holiday_to && !($work_from > $holiday_to)) ||
                    ($work_from >= $holiday_from && $work_to <= $holiday_to)
                ){
                $is_found = TRUE;
                $included_slot_categories[] = $inconv['name'];
            }
        }
        if(!$is_found){
            if(in_array($work['type'], $process_normal_slot_types))
                $included_slot_categories[] = 'Ord';
            else if(in_array($work['type'], $process_oncall_slot_types))
                $included_slot_categories[] = 'Jour';
        }
        
        if(!empty($included_slot_categories))
            $included_slot_categories = array_values(array_unique($included_slot_categories));    //remove dublicates values & re-index array
        return $included_slot_categories;
    }
    
    function get_contact_detail($user){
        $this->tables = array('employee');
        $this->fields = array('mobile','email','username');
        $this->conditions = array('username = ?');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : FALSE;
    }
    function add_leave_notification($username,$mail,$mobile){
        $this->tables = array('leave_notification');
        $this->fields = array('employee','email','mobile');
        $this->field_values = array($username,$mail,$mobile);
        return $this->query_insert();
    }
    function update_leave_notification($username,$mail,$mobile){
        $this->tables = array('leave_notification');
        $this->fields = array('email','mobile');
        $this->field_values = array($mail,$mobile);
        $this->conditions =array('employee = ?');
        $this->condition_values = array($username);
        return $this->query_update();
    }
    
    function get_notification_employee($user){
       $this->tables = array('leave_notification');
       $this->fields = array('employee','email','mobile');
       $this->conditions = array('employee = ?');
       $this->condition_values = array($user);
       $this->query_generate();
       $data = $this->query_fetch();
       $result = array('employee' => '','sjuk_mob' => '' , 'sjuk_mail' =>  '','sem_mob' => '', 'sem_mail' => '','vab_mob' => '','vab_mail'=> '','fp_mob' => '','fp_mail'=> '','pmote_mob' => '','pmote_mail'=> '',
           'utbild_mob' => '','utbilled_mail'=> '','ovrigt_mob' => '','ovrigt_mail'=> '','byte_mob' => '','byte_mail'=> '','leave_permission_mob' => '','leave_permission_mail'=> '' ,'employee_profile_mail'=> '' ,'customer_profile_mail'=> '' ,'employee_non_preferred_time_mail'=> '','employee_contract_mail' => '');
       if($data){
           $mob = explode(",",$data[0]['mobile']);
           $mail = explode(",",$data[0]['email']);
           $result['employee'] = $data[0]['employee'];
           for($i=0;$i<count($mob);$i++){
               if($mob[$i] == 1){
                   $result['sjuk_mob'] = 1;
               }
               if($mob[$i] == 2){
                    $result['sem_mob'] = 1;
               }
               if($mob[$i] == 3){
                    $result['vab_mob'] = 1;
               }
               if($mob[$i] == 4){
                    $result['fp_mob'] = 1;
               }
               if($mob[$i] == 5){
                    $result['pmote_mob'] = 1;
               }
               if($mob[$i] == 6){
                    $result['utbild_mob'] = 1;
               }
               if($mob[$i] == 7){
                    $result['ovrigt_mob'] = 1;
               }
               if($mob[$i] == 8){
                    $result['byte_mob'] = 1;
               }
               if($mob[$i] == 9){
                    $result['atl_mob'] = 1;
               }
               if($mob[$i] == 10){
                    $result['emp_overtime_mob'] = 1;
               }
               if($mob[$i] == 11){
                    $result['cust_overtime_mob'] = 1;
               }
               if($mob[$i] == 12){
                    $result['leave_permission_mob'] = 1;
               }
           }
           for($i=0;$i<count($mail);$i++){               
               if($mail[$i] == 1){
                   $result['sjuk_mail'] = 1;
               }
               if($mail[$i] == 2){
                    $result['sem_mail'] = 1;
               }
               if($mail[$i] == 3){
                    $result['vab_mail'] = 1;
               }
               if($mail[$i] == 4){
                    $result['fp_mail'] = 1;
               }
               if($mail[$i] == 5){
                    $result['pmote_mail'] = 1;
               }
               if($mail[$i] == 6){
                    $result['utbild_mail'] = 1;
               }
               if($mail[$i] == 7){
                    $result['ovrigt_mail'] = 1;
               }
               if($mail[$i] == 8){
                    $result['byte_mail'] = 1;
               }
               if($mail[$i] == 9){
                    $result['atl_mail'] = 1;
               }
               if($mail[$i] == 10){
                    $result['emp_overtime_mail'] = 1;
               }
               if($mail[$i] == 11){
                    $result['cust_overtime_mail'] = 1;
               }
               if($mail[$i] == 12){
                    $result['leave_permission_mail'] = 1;
               }
               if($mail[$i] == 25){
                    $result['employee_profile_mail'] = 1;
               }
               if($mail[$i] == 26){
                    $result['customer_profile_mail'] = 1;
               }
               if($mail[$i] == 27){
                    $result['employee_non_preferred_time_mail'] = 1;
               }
               if($mail[$i] == 28){
                    $result['employee_contract_mail'] = 1;
               }
           }
           return $result;
       }
       else{
           return 1;
       }
    }
    
    function add_employee_previlege($user,$swap,$process){
        $this->tables = array('privileges');
        $this->fields = array('employee','swap','process');
        $this->field_values = array($user,$swap,$process);
        return $this->query_insert();
    }
    
    function update_employee_previlege($user,$swap,$process){
        $this->tables = array('privileges');
        $this->fields = array('swap','process');
        $this->field_values = array($swap,$process);
        $this->conditions =  array('employee = ?');
        $this->condition_values = array($user);
        return $this->query_update();
    }
    
    function get_employee_previlege($user){
        $this->tables = array('privileges');
        $this->fields = array('employee','swap','process');
        $this->conditions =  array('employee = ?');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : 1;
    }
    
    function employee_mailabe_group($user){
        if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6){
            $result = array();
            $condition = array('AND', 'status = 1');
            $this->tables = array('team','customer');
            $this->fields = array('distinct(team.customer)','customer.first_name','customer.last_name','customer.username');
            $this->conditions = array('AND', 'team.customer = customer.username', 'customer.status = 1');
            $this->query_generate();
            $data = $this->query_fetch();
            for($i=0;$i<count($data);$i++){
                $this->tables = array('team','employee');
                $this->fields = array('distinct(team.employee)','team.role','employee.username','employee.first_name','employee.last_name','employee.email');
                $this->conditions = array('AND','team.customer = ?','team.employee = employee.username', 'employee.status = 1');
                $this->condition_values = array($data[$i]['customer']);
                $this->order_by = array('team.customer','team.role ASC');
                $this->query_generate();
                $data1 = $this->query_fetch();
                for($j=0;$j<count($data1);$j++){
                    $condition[] = 'username <> "'.$data1[$j]['employee'].'"';
                }                
                $result[] = array('customer_name' => $data[$i]['first_name']." ".$data[$i]['last_name'],'customer_username' => $data[$i]['username'], 'employees_customer' => $data1);
            }
            $this->tables = array('employee');
            $this->fields = array('username','first_name','last_name','email');
            $this->conditions = $condition;
            $this->query_generate();
            $data2 = $this->query_fetch();
            for($i=0;$i<count($data2);$i++){
                $result[] = array('customer_name' => 'ALL','employees' => $data2[$i]);
            }
            return $result ? $result : FALSE;
        }
        else{
            $result = array();
            $this->tables = array('team','customer');
            $this->fields = array('distinct(team.customer)','customer.first_name','customer.last_name','customer.username');
            $this->conditions = array('AND','team.customer = customer.username','team.employee = ?', 'customer.status = 1');
            $this->condition_values = array($user);
            $this->query_generate();
            $data = $this->query_fetch();
            for($i=0;$i<count($data);$i++){
                $this->tables = array('team','employee');
                $this->fields = array('team.employee','team.role','employee.username','employee.first_name','employee.last_name','employee.email');
                $this->conditions = array('AND','team.customer = ?','team.employee = employee.username', 'employee.status = 1');
                $this->condition_values = array($data[$i]['customer']);
                $this->order_by = array('team.customer','team.role ASC');
                $this->query_generate();
                $data1 = $this->query_fetch();               
                $result[] = array('customer_name' => $data[$i]['first_name']." ".$data[$i]['last_name'],'customer_username' => $data[$i]['username'], 'employees_customer' => $data1);
            }
            return $result ? $result : FALSE;
        }
    }
    
    function employee_mailable($user){
        if($_SESSION['user_role'] == 1){
            $this->tables = array('employee');
            $this->fields =array('username','first_name','last_name','email');
            $this->conditions = array('status = 1');
            if($_SESSION['company_sort_by'] == 2)
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
            else
                $this->order_by = array('LOWER(first_name) collate utf8_bin');
            $this->query_generate();
            $data2 = $this->query_fetch();
            return $data2 ? $data2 : array();
        }
        else{
            $obj_user = new user();
            $passed_user_role = $obj_user->user_role($user);

            $result = array('OR');
            if($passed_user_role != 4){
                $this->tables = array('team');
                $this->fields =array('customer');
                $this->conditions = array('employee = ?');
                $this->condition_values = array($user);
                $this->query_generate();
                $data = $this->query_fetch();
                for($i=0; $i< count($data);$i++){
                    $result[] = 'customer = "'.$data[$i]['customer'].'"';
                }
            }
            //customer
            else{
                $result[] = 'customer = "'.$user.'"';
            }
            $this->tables = array('team');
            $this->fields =array('distinct(employee) as emp');
            $this->conditions = $result;
            $this->query_generate();
            $data1 = $this->query_fetch(1);
            $result1 = array('OR');
            foreach($data1 as $data_emp){
                $result1[] = 'username = "'.$data_emp['emp'].'"';
            }

            $this->tables = array('employee');
            $this->fields =array('username','first_name','last_name','email');
            $this->conditions = $result1;
            if($_SESSION['company_sort_by'] == 2)
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
            else
                $this->order_by = array('LOWER(first_name) collate utf8_bin');
            $this->query_generate();
            $data2 = $this->query_fetch();
            return $data2 ? $data2 : array();
        }
                
    }
    function get_employee_name($user){
        $this->tables = array('employee');
        $this->fields =array('username','first_name','last_name','email');
        $this->conditions = array('username = ?');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['first_name']." ".$data[0]['last_name'];
        }
        else{
            return false;
        }
    }
    function get_employee_email($user){
        $this->tables = array('employee');
        $this->fields =array('username','first_name','last_name','email');
        $this->conditions = array('username = ?');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['email'];
        }
        else{
            return false;
        }
    }
    
    function assigned_customers_to_employee($user_id){
        $this->tables = array('team','customer');
        $this->fields = array(
            'team.customer',
            'team.employee',
            'team.role',
            'customer.username',
            'customer.first_name',
            'customer.last_name',
            'customer.code',
            'customer.social_security',
            'customer.century'
            );
        $this->conditions = array('AND','team.customer = customer.username','team.employee = ?', 'customer.status=1');
        $this->condition_values = array($user_id);
        if($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(first_name) collate utf8_bin');
        elseif($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(last_name) collate utf8_bin');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }
        else{
            return array();
        }
    }
    function customers_to_assign($assigned,$key = null){
        $result = array('AND', 'status = 1');
        for($i=0;$i<count($assigned);$i++){
            $result[] = 'username <> "'.$assigned[$i]['username'].'"';
        }
        $this->tables = array('customer');
        $this->fields = array('username','first_name','last_name','code');
        if($key != null){
            $this->conditions = $result;
        }else{
            $result[] = 'username LIKE ?';
            $result[] = 'username LIKE ?';
            $this->conditions = $result;
            $this->condition_values = array($key."%", strtolower($key)."%");
        }
        if($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(first_name) collate utf8_bin');
        elseif($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(last_name) collate utf8_bin');
        $this->query_generate();    
        $data = $this->query_fetch();
        if($data){
            return $data;
        }
        else
            return array();
    }
    
    function delete_team_employee($customers,$employee){
        
        $this->tables = array('team');
        $this->conditions = array('AND','employee = ?','customer = ?');
        $this->condition_values = array($employee,$customers[0]);
        if($this->query_delete()){
            return true;
        }
        else{
            return false;
        }
    }
    
    function add_team_employee($customers,$employee){
                  
            $this->tables = array('team');
            $this->fields = array('customer','employee','role');
            $this->field_values = array($customers[0],$employee,'3');
            $data = $this->query_insert();
            if($data){
                return true;
            }
            else{
                return false;
            }
       
    }
    
    /* ----------------------shamsu start-------------------------------- */
    
    function generate_pdf_customer_week_month_report($r_customer,$start_date,$end_date,$method,$condition_array, $return_as_html_content = FALSE) {
        
        require_once ('plugins/customize_pdf_customer_week_report.class.php');
        require_once ('class/customer.php');
        $cust_obj = new customer();
       
        if($method == 1){
            $pdf = new PDF_Customer_week_report("P");
        }else if($method == 2){
            $pdf = new PDF_Customer_week_report("L");
        }
        $pdf->report_customer = $r_customer;
        $pdf->report_start_date = $start_date;
        $pdf->report_end_date = $end_date;
        
        $cust_details = $cust_obj->customer_detail($r_customer);
        $year_diff = intval(date('Y',  strtotime($end_date))) - intval(date('Y',  strtotime($start_date)));
        if($year_diff == 0){
            $timetable = $this->customer_timetable_month($r_customer,$start_date,$end_date,$_SESSION['user_id'],$_SESSION['user_role'],$condition_array);
        // echo "<pre>timetable". print_r($timetable, 1)."</pre>";
        }else{
            $timetable = array();
            $start_year = intval(date('Y',  strtotime($start_date)));
            $end_year = intval(date('Y',  strtotime($end_date)));
            for($i=0;$i<=$year_diff;$i++){
                $year_check = $start_year + $i;
                if($year_check == $start_year){
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $this->customer_timetable_month($r_customer,$start_date,$temp_end_date,$_SESSION['user_id'],$_SESSION['user_role'],$condition_array);
                }elseif($year_check == $end_year){
                    $temp_start_date = $year_check."-01-01";
                    $timetable_temp = $this->customer_timetable_month($r_customer,$temp_start_date,$end_date,$_SESSION['user_id'],$_SESSION['user_role'],$condition_array);
                    $prev_year = $year_check-1;
                    if(date('W',  strtotime($prev_year."-12-31")) == 1 && date('W',  strtotime($year_check."-01-01")) == 1){
                        $last_key_timetable = count($timetable) - 1;
                        for($j=0;$j<count($timetable[$last_key_timetable]['employee']);$j++){
                            for($k=0;$k<count($timetable_temp[0]['employee']);$k++){
                                if($timetable[$last_key_timetable]['employee'][$j]['emp_username'] == $timetable_temp[0]['employee'][$k]['emp_username']){
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Mon']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Mon'][] = $timetable_temp[0]['employee'][$k]['Mon'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Tue']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Tue'][] = $timetable_temp[0]['employee'][$k]['Tue'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Wed']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Wed'][] = $timetable_temp[0]['employee'][$k]['Wed'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Thu']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Thu'][] = $timetable_temp[0]['employee'][$k]['Thu'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Fri']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Fri'][] = $timetable_temp[0]['employee'][$k]['Fri'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sat']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sat'][] = $timetable_temp[0]['employee'][$k]['Sat'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sun']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sun'][] = $timetable_temp[0]['employee'][$k]['Sun'][$x];
                                    }
                                    $timetable[$last_key_timetable]['employee'][$j]['sum'] = $timetable[$last_key_timetable]['employee'][$j]['sum']+$timetable_temp[0]['employee'][$k]['sum'];
                                }
                            }
                        }
                        unset($timetable_temp[0]);
                    }
                }else{
                    $temp_start_date = $year_check."-01-01";
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $this->customer_timetable_month($r_customer,$temp_start_date,$temp_end_date,$_SESSION['user_id'],$_SESSION['user_role'],$condition_array);
                    if(date('W',  strtotime($prev_year."-12-31")) == 1 && date('W',  strtotime($year_check."-01-01")) == 1){
                        $last_key_timetable = count($timetable) - 1;
                        for($j=0;$j<count($timetable[$last_key_timetable]['employee']);$j++){
                            for($k=0;$k<count($timetable_temp[0]['employee']);$k++){
                                if($timetable[$last_key_timetable]['employee'][$j]['emp_username'] == $timetable_temp[0]['employee'][$k]['emp_username']){
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Mon']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Mon'][] = $timetable_temp[0]['employee'][$k]['Mon'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Tue']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Tue'][] = $timetable_temp[0]['employee'][$k]['Tue'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Wed']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Wed'][] = $timetable_temp[0]['employee'][$k]['Wed'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Thu']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Thu'][] = $timetable_temp[0]['employee'][$k]['Thu'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Fri']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Fri'][] = $timetable_temp[0]['employee'][$k]['Fri'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sat']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sat'][] = $timetable_temp[0]['employee'][$k]['Sat'][$x];
                                    }
                                    for($x=0;$x<count($timetable_temp[0]['employee'][$k]['Sun']);$x++){
                                        $timetable[$last_key_timetable]['employee'][$j]['Sun'][] = $timetable_temp[0]['employee'][$k]['Sun'][$x];
                                    }
                                    $timetable[$last_key_timetable]['employee'][$j]['sum'] = $timetable[$last_key_timetable]['employee'][$j]['sum']+$timetable_temp[0]['employee'][$k]['sum'];
                                }
                            }
                        }
                        unset($timetable_temp[0]);
                    }
                }
                $timetable = array_merge($timetable,$timetable_temp); 
                
            }
        }
       // echo "<pre>timetable". print_r($timetable, 1)."</pre>";
       // $timetable = $this->customer_timetable_month($r_customer,$start_date,$end_date,$_SESSION['user_id'],$_SESSION['user_role'],$condition_array);
        $sums = $this->customer_week_time_sum($timetable);
        $result = array();
        $data = array();
        $week_days_for_processing = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');
        $week_days_for_processing_cap = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $a1 = 0;
        for($i=0;$i<count($timetable);$i++){
            $data = array();
            $result[$a1]['week'] = $timetable[$i]['week'];
            
            $result[$a1]['mon'] = $timetable[$i]['mon'];
            $result[$a1]['tue'] = $timetable[$i]['tue'];
            $result[$a1]['wed'] = $timetable[$i]['wed'];
            $result[$a1]['thu'] = $timetable[$i]['thu'];
            $result[$a1]['fri'] = $timetable[$i]['fri'];
            $result[$a1]['sat'] = $timetable[$i]['sat'];
            $result[$a1]['sun'] = $timetable[$i]['sun'];
            
            $a2 = 0;
            $time_table_employees_count = count($timetable[$i]['employee']);
            for($j=0 ; $j < $time_table_employees_count ; $j++){
                foreach($week_days_for_processing_cap as $day_key => $process_day){
                    if(isset($timetable[$i]['employee'][$j][$process_day]) && !empty($timetable[$i]['employee'][$j][$process_day])){
                        $weed_day_entries_count = count($timetable[$i]['employee'][$j][$process_day]);
                        for($k=0 ; $k<$weed_day_entries_count ; $k++){
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                            $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['r'] = hexdec(substr($hex,0,2));
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['g'] = hexdec(substr($hex,2,2));
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['b'] = hexdec(substr($hex,4,2));
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['time'] = $timetable[$i]['employee'][$j][$process_day][$k];
                            //-----------------
                            $slot_values = explode(',', $timetable[$i]['employee'][$j][$process_day][$k]);
                            $time_ranges = explode('-', $slot_values[0]);
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['time_from'] = trim($time_ranges[0]);
                            $result[$a1]['data'][$week_days_for_processing[$day_key]][$a2]['time_to'] = trim($time_ranges[1]);
                            $a2++;
                        }
                    }
                }
            }

            //arrange unmanned slots
            $a2 = 0;
            if(!empty($timetable[$i]['unmanned'])){
                foreach($week_days_for_processing_cap as $day_key => $process_day){
                    if(isset($timetable[$i]['unmanned'][$process_day]) && !empty($timetable[$i]['unmanned'][$process_day])){
                        $weed_day_entries_count = count($timetable[$i]['unmanned'][$process_day]);
                        for($k=0 ; $k<$weed_day_entries_count ; $k++){
                            $result[$a1]['unmanned-data'][$week_days_for_processing[$day_key]][$a2]['time'] = $timetable[$i]['unmanned'][$process_day][$k];
                            //-----------------
                            $slot_values = explode(',', $timetable[$i]['unmanned'][$process_day][$k]);
                            $time_ranges = explode('-', $slot_values[0]);
                            $result[$a1]['unmanned-data'][$week_days_for_processing[$day_key]][$a2]['time_from'] = trim($time_ranges[0]);
                            $result[$a1]['unmanned-data'][$week_days_for_processing[$day_key]][$a2]['time_to'] = trim($time_ranges[1]);
                            $a2++;
                        }
                    }
                }
            }

            $a1++;
        }
       // echo "<pre>".print_r($timetable, 1)."</pre>"; 
        
        $worked_hours_fk = $worked_hours_kn = 0.00;
        for($i=0;$i<count($timetable);$i++){
            if(!empty($timetable[$i]['employee'])){
                foreach($timetable[$i]['employee'] as $emp_data_key => $emp_datas){
                    foreach(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat') as $day_key){
                        if(isset($timetable[$i]['employee'][$emp_data_key][$day_key]) && !empty($timetable[$i]['employee'][$emp_data_key][$day_key])){
                            foreach($timetable[$i]['employee'][$emp_data_key][$day_key] as $data_elements){
                                $exploded_data_set = explode(',', $data_elements);
                                if($exploded_data_set[4] == 1 && $exploded_data_set[2] == 1){ //pick only fk slots
                                    $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                    $worked_hours_fk =  $this->time_sum($worked_hours_fk, $this->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                                }
                                else if(in_array($exploded_data_set[4], array(2,3)) && $exploded_data_set[2] == 1){ //pick only kn/tu slots
                                    $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                    $worked_hours_kn =  $this->time_sum($worked_hours_kn, $this->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                                }
                            }
                        }
                    }
                }
            }
        }
        
        //this for sorting the week day time slot entries as ascenting by time_from-time_to
        $count_result = count($result);
        for($i=0; $i < $count_result; $i++){
            foreach($week_days_for_processing as $process_day){
                if(isset($result[$i]['data'][$process_day]) && !empty($result[$i]['data'][$process_day])){
                    usort($result[$i]['data'][$process_day], function($a, $b){
                                        if($a['time_from'] == $b['time_from'])
                                            return ($a['time_to'] > $b['time_to']);
                                        else
                                            return ($a['time_from'] > $b['time_from']);
                                    });
                    
                }
            }
        }
       // echo "<pre>".print_r($result, 1)."</pre>";exit();
        
        $contract_data = $cust_obj->get_filter_date_report($r_customer,$start_date,$end_date,'10');
        // var_dump($contract_data);

                
        $pdf->contract_hours_fk = $contract_data['fk_granted'];
        $pdf->contract_hours_kn = $contract_data['kn_granted'];
       // $pdf->worked_hour_fk = $contract_data['fk_used'];
       // $pdf->worked_hour_kn = $contract_data['kn_used'];
        $pdf->worked_hour_fk = $this->time_user_format($worked_hours_fk,100);
        $pdf->worked_hour_kn = $this->time_user_format($worked_hours_kn,100);
        
        //PDF block
        if(!$return_as_html_content){
            if($method == 1){
                $pdf->rpt_contents = $result;
                $pdf->rpt_sum = $sums;
                $pdf->AddPage();        //page1
                $pdf->P1_Part1($cust_details);
                if($cust_details)
                    $pdf->P1_Part2_New($start_date,$end_date);
                else
                   $pdf->P1_Part2_New($start_date,$end_date,1); 
            }else if($method == 2){
                $pdf->rpt_contents = $timetable;
                $pdf->rpt_sum = $sums;
                $pdf->AddPage();        //page1
                $pdf->P1_Part1_L($cust_details);
                if($cust_details)
                    $pdf->P1_Part2_Landscape();
                else
                   $pdf->P1_Part2_Landscape(1); 
               // $pdf->P1_Part2_New($r_year,$r_month);
            }
           // $pdf->rpt_contents = $result;
           // $pdf->rpt_sum = $sums;
            $pdf->Output();
        }
        //excel block
        else {
            $pdf->rpt_contents = $timetable;
            $pdf->rpt_sum = $sums;

            $total_number_of_columns = 9;
            $html_content = '<table border="1" cellpadding="0" cellspacing="0">';
            $html_content .= $pdf->P1_Part1_for_excel($cust_details, '', $total_number_of_columns);
            $html_content .= $pdf->P1_Part2_Landscape_for_excel(($cust_details ? 0 : 1), '', $total_number_of_columns);
            $html_content .= '</table>';
            return $html_content;
        }
    }

    function generate_pdf_employee_week_month_report($r_employee,$start_date,$end_date,$print_method,$condition, $return_as_html_content = FALSE) {
        //$app_dir = getcwd();
        //echo $app_dir;
        require_once ('plugins/customize_pdf_employee_week_report.class.php');
        require_once ('class/employee.php');
        require_once ('plugins/MPDF54/mpdf.php');
        require_once ('class/equipment.php');
        require_once('class/contract.php');
        
       // $customer = new customer();
        $employee = new employee();
        $equipment = new equipment();
        $obj_contract = new contract();
       
        if($print_method == 1){
            $pdf = new PDF_Employee_week_report("P");
        }else{
           $pdf = new PDF_Employee_week_report("L"); 
        }
        $pdf->report_customer = $r_employee;
        $pdf->report_start_date = $start_date;
        $pdf->report_end_date = $end_date;
        
        $emp_details = $employee->get_employee_detail($r_employee);
        $year_diff = intval(date('Y',  strtotime($end_date))) - intval(date('Y',  strtotime($start_date)));
        if($year_diff == 0){
            $timetable = $this->employee_timetable_month($r_employee,$start_date,$end_date,$condition);
        }else{
            $timetable = array();
            $start_year = intval(date('Y',  strtotime($start_date)));
            $end_year = intval(date('Y',  strtotime($end_date)));
            for($i=0;$i<=$year_diff;$i++){
                $year_check = $start_year + $i;
                if($year_check == $start_year){
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $this->employee_timetable_month($r_employee,$start_date,$temp_end_date,$condition);
                }elseif($year_check == $end_year){
                    $temp_start_date = $year_check."-01-01";
                    $timetable_temp = $this->employee_timetable_month($r_employee,$temp_start_date,$end_date,$condition);
                    $prev_year = $year_check-1;
                    if(date('W',  strtotime($prev_year."-12-31")) ==  date('W',  strtotime($year_check."-01-01"))){
                        $last_key_timetable = count($timetable) - 1;
                        $timetable[$last_key_timetable]['data']['mon'] = array_merge($timetable[$last_key_timetable]['data']['mon'],$timetable_temp[0]['data']['mon']);
                        $timetable[$last_key_timetable]['data']['tue'] = array_merge($timetable[$last_key_timetable]['data']['tue'],$timetable_temp[0]['data']['tue']);
                        $timetable[$last_key_timetable]['data']['wed'] = array_merge($timetable[$last_key_timetable]['data']['wed'],$timetable_temp[0]['data']['wed']);
                        $timetable[$last_key_timetable]['data']['thu'] = array_merge($timetable[$last_key_timetable]['data']['thu'],$timetable_temp[0]['data']['thu']);
                        $timetable[$last_key_timetable]['data']['fri'] = array_merge($timetable[$last_key_timetable]['data']['fri'],$timetable_temp[0]['data']['fri']);
                        $timetable[$last_key_timetable]['data']['sat'] = array_merge($timetable[$last_key_timetable]['data']['sat'],$timetable_temp[0]['data']['sat']);
                        $timetable[$last_key_timetable]['data']['sun'] = array_merge($timetable[$last_key_timetable]['data']['sun'],$timetable_temp[0]['data']['sun']);
                        $timetable[$last_key_timetable]['data']['sum'] = $timetable[$last_key_timetable]['data']['sum']+$timetable_temp[0]['data']['sum'];
                        unset($timetable_temp[0]);
                        
                    }
                }else{
                    $temp_start_date = $year_check."-01-01";
                    $temp_end_date = $year_check."-12-31";
                    $timetable_temp = $this->employee_timetable_month($r_employee,$temp_start_date,$temp_end_date,$condition);
                    $prev_year = $year_check-1;
                    if(date('W',  strtotime($prev_year."-12-31")) == date('W',  strtotime($year_check."-01-01"))){
                        $last_key_timetable = count($timetable) - 1;
                        $timetable[$last_key_timetable]['data']['mon'] = array_merge($timetable[$last_key_timetable]['data']['mon'],$timetable_temp[0]['data']['mon']);
                        $timetable[$last_key_timetable]['data']['tue'] = array_merge($timetable[$last_key_timetable]['data']['tue'],$timetable_temp[0]['data']['tue']);
                        $timetable[$last_key_timetable]['data']['wed'] = array_merge($timetable[$last_key_timetable]['data']['wed'],$timetable_temp[0]['data']['wed']);
                        $timetable[$last_key_timetable]['data']['thu'] = array_merge($timetable[$last_key_timetable]['data']['thu'],$timetable_temp[0]['data']['thu']);
                        $timetable[$last_key_timetable]['data']['fri'] = array_merge($timetable[$last_key_timetable]['data']['fri'],$timetable_temp[0]['data']['fri']);
                        $timetable[$last_key_timetable]['data']['sat'] = array_merge($timetable[$last_key_timetable]['data']['sat'],$timetable_temp[0]['data']['sat']);
                        $timetable[$last_key_timetable]['data']['sun'] = array_merge($timetable[$last_key_timetable]['data']['sun'],$timetable_temp[0]['data']['sun']);
                        $timetable[$last_key_timetable]['data']['sum'] = $timetable[$last_key_timetable]['data']['sum']+$timetable_temp[0]['data']['sum'];
                        unset($timetable_temp[0]);
                        
                    }
                }
                $timetable = array_merge($timetable,$timetable_temp); 
                
            }
        }
        $sums = $this->employee_week_time_sum($timetable);
        
        $time_sum = '0.00';
        for($i=0;$i<count($timetable);$i++){
            $time_sum =  $employee->time_sum($time_sum, $equipment->time_user_format($timetable[$i]['data']['sum']));
        }
        $pdf->time_sum = $equipment->time_user_format($time_sum,100);
        
        $jour_time_sum = 0.00;
        for($i=0;$i<count($timetable);$i++){
            $time_sum =  $employee->time_sum($time_sum, $equipment->time_user_format($timetable[$i]['data']['sum'])); 
            
            if(!empty($timetable[$i]['data'])/* && $check_array[0] == 1*/){
                foreach(array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat') as $day_key){
                    if(!empty($timetable[$i]['data'][$day_key])){
                        foreach($timetable[$i]['data'][$day_key] as $data_elements){
                            $exploded_data_set = explode(',', $data_elements['time']);
                            if(in_array($exploded_data_set[1], array(3,9,13,14,17)) && $exploded_data_set[2] == 1){ //pick only oncall slots
                                $tmp_time_ranges = explode('-', $exploded_data_set[0]);
                                $jour_time_sum =  $equipment->time_sum($jour_time_sum, $equipment->time_difference($tmp_time_ranges[0], $tmp_time_ranges[1]));
                            }
                        }
                    }
                }
            }
        }
        
        /*$cur_employee_contract_oncall = round($employee->employee_total_work_hours($r_employee, 'date_between', $start_date.'|'.$end_date, 3), 2);
        if($cur_employee_contract_oncall == '')
            $cur_employee_contract_oncall ='0.00';
        $pdf->oncall_worked = $cur_employee_contract_oncall;*/
        $pdf->oncall_worked = $equipment->time_user_format($jour_time_sum,100);;
        
        $cur_employee_contracts = $obj_contract->get_employee_contract_between_dates($r_employee, $start_date, $end_date);
        $pdf->contract_hours = $cur_employee_contracts['contract_hours'];
        
        $pdf->rpt_contents = $timetable;
            // echo "<pre>".print_r($timetable, 1)."<pre>";
        $pdf->rpt_sum = $sums;
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////  
        $pdf->AddPage();        //page1
       // $pdf->P1_Part1($emp_details);
       // echo "<pre>". print_r($emp_details, 1)."</pre>";
        $emp_flag = 0;
        if($emp_details['username'] == '')
            $emp_flag = 1;

        //PDF block
        if(!$return_as_html_content){
            if($print_method == 1){
                $pdf->P1_Part1_P($emp_details);
                $pdf->report_part($start_date,$end_date,$emp_flag);
                
            }elseif($print_method == 2){
                $pdf->P1_Part1($emp_details);
                $pdf->P1_Part2($emp_flag);
            }
            $pdf->Output();
        }
        //excel block
        else {
            $total_number_of_columns = 8;
            $html_content = '<table border="1" cellpadding="0" cellspacing="0">';
            $html_content .= $pdf->P1_Part1_for_excel($emp_details, $total_number_of_columns);
            $html_content .= $pdf->P1_Part2_for_excel($emp_flag, $total_number_of_columns);
            $html_content .= '</table>';
            return $html_content;
        }
    }
    /* ----------------------shamsu end-------------------------------- */
    
    /*---------------------- Niyas Privilege---------------------------*/
    
    function employee_privilege_schedule_al($emp){
        $this->tables = array('privileges');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges');
            $this->fields = array('swap','process','add_slot','fkkn','slot_type','add_employee','remove_employee','`leave`','copy_single_slot','copy_single_slot_option','copy_day_slot','copy_day_slot_option','split_slot','delete_slot','delete_day_slot','add_customer','remove_customer');
            $this->field_values = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges');
            $this->fields = array('employee','swap','process','add_slot','fkkn','slot_type','add_employee','remove_employee','`leave`','copy_single_slot','copy_single_slot_option','copy_day_slot','copy_day_slot_option','split_slot','delete_slot','delete_day_slot','add_customer','remove_customer');
            $this->field_values = array($emp,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0);
            $this->query_insert();
        }
    }
    
    function employee_privilege_schedule_gl($emp){
        $this->tables = array('privileges');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges');
            $this->fields = array('swap','process','add_slot','fkkn','slot_type','add_employee','remove_employee','`leave`','copy_single_slot','copy_single_slot_option','copy_day_slot','copy_day_slot_option','split_slot','delete_slot','delete_day_slot','add_customer','remove_customer');
            $this->field_values = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            
            $this->tables = array('privileges');
            $this->fields = array('employee','swap','process','add_slot','fkkn','slot_type','add_customer','add_employee','remove_customer','remove_employee','`leave`','copy_single_slot','copy_single_slot_option','copy_day_slot','copy_day_slot_option','split_slot','delete_slot','delete_day_slot');
            $this->field_values = array($emp,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
            $this->query_insert();
        }
    }
    
    function employee_privilege_schedule_delete($emp){
        $this->tables = array('privileges');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_delete();
        }
    }
    
    function employee_privilege_forms_al($emp){
        
        $this->tables = array('privileges_forms');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        $dt = FALSE;       
        if($data){
            $this->tables = array('privileges_forms');
            $this->fields = array('fkkn','`leave`','certificate');
            $this->field_values = array(1,0,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $dt = $this->query_update();
        }else{
            $this->tables = array('privileges_forms');
            $this->fields = array('employee','fkkn','`leave`','certificate');
            $this->field_values = array($emp,'1','0','0');
            
            return $this->query_insert();
            
        }
        
        if($dt){
            return TRUE;
        }else{
            return false;
        }
    }
    
    function employee_privilege_forms_gl($emp){
        $this->tables = array('privileges_forms');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_forms');
            $this->fields = array('fkkn','`leave`','certificate');
            $this->field_values = array(1,1,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_forms');
            $this->fields = array('employee','fkkn','`leave`','certificate');
            $this->field_values = array($emp,1,1,0);
            $this->query_insert();
        }
    }
    
    function employee_privilege_forms_delete($emp){
        $this->tables = array('privileges_forms');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_forms');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_delete();
        }
    }
    
    function employee_privilege_general_al($emp){
        $this->tables = array('privileges_general');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_general');
            $this->fields = array('chat','add_employee','add_customer','edit_employee','edit_customer','inconvenient_timing','administration');
            $this->field_values = array(1,0,0,0,0,0,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_general');
            $this->fields = array('employee','chat','add_employee','add_customer','edit_employee','edit_customer','inconvenient_timing','administration');
            $this->field_values = array($emp,1,0,0,0,0,0,0);
            $this->query_insert();
        }
    }
    
    function employee_privilege_general_gl($emp){
        $this->tables = array('privileges_general');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_general');
            $this->fields = array('chat','add_employee','add_customer','edit_employee','edit_customer','inconvenient_timing','administration');
            $this->field_values = array(1,1,1,1,1,1,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_general');
            $this->fields = array('employee','chat','add_employee','add_customer','edit_employee','edit_customer','inconvenient_timing','administration');
            $this->field_values = array($emp,1,1,1,1,1,1,0);
            $this->query_insert();
        }
    }
    
    function employee_privilege_general_delete($emp){
        $this->tables = array('privileges_general');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_general');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_delete();
        }
    }
    
    function employee_privilege_mc_al($emp){
        $this->tables = array('privileges_mc');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_mc');
            $this->fields = array('`cirrus_mail`','`external_mail`','`leave_notification`','`notes`','`leave_rejection`','`leave_approval`','`leave_edit`','`notes_approval`','`notes_rejection`','`sms`','`notes_attchment`');
            $this->field_values = array(1,1,1,1,0,0,0,0,0,0,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_mc');
            $this->fields = array('employee','`cirrus_mail`','`external_mail`','`leave_notification`','`notes`','`leave_rejection`','`leave_approval`','`leave_edit`','`notes_approval`','`notes_rejection`','`sms`','`notes_attchment`');
            $this->field_values = array($emp,1,1,1,1,0,0,0,0,0,0,0);
            
            $this->query_insert();
        }
    }
    
    function employee_privilege_mc_gl($emp){
        $this->tables = array('privileges_mc');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_mc');
            $this->fields = array('cirrus_mail','external_mail','leave_notification','notes','leave_rejection','leave_approval','leave_edit','notes_approval','notes_rejection','sms','notes_attchment');
            $this->field_values = array(1,1,1,1,1,1,1,1,1,1,1);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_mc');
            $this->fields = array('employee','cirrus_mail','external_mail','leave_notification','notes','leave_rejection','leave_approval','leave_edit','notes_approval','notes_rejection','sms','notes_attchment');
            $this->field_values = array($emp,1,1,1,1,1,1,1,1,1,1,1);
            $this->query_insert();
        }
    }
    function employee_privilege_mc_delete($emp){
        $this->tables = array('privileges_mc');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_mc');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_delete();
        }
    }
    
    function employee_privilege_reports_al($emp){
        $this->tables = array('privileges_reports');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_reports');
            $this->fields = array('customer_schedule','customer_horizontal','customer_overview','customer_vacation_planning','employee_leave','employee_percentage','employee_schedule','employee_workreport','customer_data','customer_leave','customer_granded_vs_used','customer_employee_connection','employee_data');
            $this->field_values = array(1,1,1,1,1,1,1,1,0,0,0,0,0);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_reports');
            $this->fields = array('employee','customer_schedule','customer_horizontal','customer_overview','customer_vacation_planning','employee_leave','employee_percentage','employee_schedule','employee_workreport','customer_data','customer_leave','customer_granded_vs_used','customer_employee_connection','employee_data');
            $this->field_values = array($emp,1,1,1,1,1,1,1,1,0,0,0,0,0);
            $this->query_insert();
        }
    }
    
    function employee_privilege_reports_gl($emp){
        $this->tables = array('privileges_reports');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_reports');
            $this->fields = array('customer_data','customer_leave','customer_granded_vs_used','customer_employee_connection','customer_schedule','customer_horizontal','customer_overview','customer_vacation_planning','employee_data','employee_leave','employee_percentage','employee_schedule','employee_workreport');
            $this->field_values = array(1,1,1,1,1,1,1,1,1,1,1,1,1);
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_update();
        }else{
            $this->tables = array('privileges_reports');
            $this->fields = array('employee','customer_data','customer_leave','customer_granded_vs_used','customer_employee_connection','customer_schedule','customer_horizontal','customer_overview','customer_vacation_planning','employee_data','employee_leave','employee_percentage','employee_schedule','employee_workreport');
            $this->field_values = array($emp,1,1,1,1,1,1,1,1,1,1,1,1,1);
            $this->query_insert();
        }
    }
    
    function employee_privilege_reports_delete($emp){
        $this->tables = array('privileges_reports');
        $this->fields = array('employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('privileges_reports');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($emp);
            $this->query_delete();
        }
    }
    
    /*---------------------- niyas priviolegew end --------------------*/
    
    // function get the distinct year
    function get_years_atl_warning(){
        $this->tables = array('atl_warnings');
        $this->fields = array('DISTINCT(YEAR(date)) as year');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    //function to the reports acc to month and year
    function get_reports_atl_warning($month,$year,$emp = NULL){
        $obj_dona = new dona();
        $this->tables = array('timetable');
        $this->fields = array('distinct employee as employee');
        if($emp == NULL){
            $this->conditions = array('AND','MONTH(date) = ?','YEAR(date) = ?','employee != ?', 'employee IS NOT NULL');
            $this->condition_values = array($month,$year, '');
        }else{
            $this->conditions = array('AND','MONTH(date) = ?','YEAR(date) = ?','employee != ?', 'employee IS NOT NULL');
            $this->condition_values = array($month,$year, '');
            $extra_condition = array('OR');
            for($i=0;$i<count($emp);$i++){
                $extra_condition[] = 'employee = "'.$emp[$i]['username'].'"';
            }
            $this->conditions[] = $extra_condition; 
        }
        
        $this->query_generate();
        $datas = $this->query_fetch();
        
        $atl_warnings = array();
        foreach ($datas as $data){
            $tmp = $obj_dona->checkATL_monthly($data['employee'], $month, $year);
            if(!empty($tmp))
                $atl_warnings[$data['employee']] =  $tmp;
            
        }
        return $atl_warnings;
    }
    
    function get_reports_atl_warning_count($month,$year){
        $this->tables = array('atl_warnings` AS `atl','employee` AS `emp','customer` AS `cust');
        $this->fields = array('emp.first_name AS ef','emp.last_name AS el','atl.employee','atl.customer','cust.first_name AS cf','cust.last_name AS cl');
        $this->conditions = array('AND','MONTH(atl.date) = ?','YEAR(atl.date) = ?','emp.username = atl.employee','cust.username = atl.customer');
        $this->condition_values = array($month,$year);
        $this->group_by = array('atl.employee','atl.customer');
        $this->query_generate();
        $data = $this->query_fetch();
        if(count($data) > 15){
            $pages = 1;
            if((count($data) % 15) == 0){
                $pages = intval(count($data) / 15);
            }else{
                $pages = intval((count($data) / 15) + 1);
            }
            return $pages;
        }else{
            return 0;
        }
    }
    
    
    function generate_atl_warning_report_pdf($month,$year){
        require_once ('plugins/customize_pdf_employee_alt_warning_report.class.php');
        require_once('plugins/MPDF54/mpdf.php');
        $pdf = new PDF_employee_atl_warning_report("P");
        $report_content = $this->get_reports_atl_warning($month,$year);
        $pdf->report_month = $month;
        $pdf->report_year = $year;
        $pdf->rpt_contents = $report_content;
        $pdf->AddPage();
        $pdf->P1_Part1($month,$year);
        $pdf->P1_Part2();
        $pdf->Output();
        
    }
    
    function get_all_atl_warning_weekly($month,$year,$empl,$cust){
        $this->tables = array('atl_warnings');
        $this->fields = array('date','time_from','time_to','extra_hours');
        $this->conditions = array('AND','MONTH(date) = ?','YEAR(date) = ?','employee = ?','customer = ?');
        $this->condition_values = array($month,$year,$empl,$cust);
        $this->order_by = array('date');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $result = array();
           $week_num_start = date('W',  strtotime($year."-".$month."-01"));
           $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
           if($month == '12'){
                $week_num_end = date('W',  strtotime($year."-".$month."-".$days));
                if($week_num_end == '01'){
                    for($i=30;$i>0;$i--){
                        $week_num_end = date('W',  strtotime($year."-".$month."-".$i));
                        if($week_num_end != '01'){
                            break;
                        }
                    }
                    $week_num_end = $week_num_end +1;
                }
             }else{
                 $week_num_end = date('W',  strtotime($year."-".$month."-".$days));
             }
             $diff_week = $week_num_end-$week_num_start;
             for($i=0;$i <= $diff_week;$i++){;
                 $result[] = array('week' => $week_num_start+$i);
             }
             for($i=0;$i<count($data);$i++){
                 $day = date('D',  strtotime($data[$i]['date']));
                 $data[$i]['day']= $day;
                 for($j=0;$j<count($result);$j++){
                     $week = date('W',  strtotime($data[$i]['date']));
                     if($result[$j]['week'] == $week){
                         $result[$j]['data'][] = $data[$i];
                     }else{
                         continue;
                     }
                 }
             }
             for($i=0;$i<count($result);$i++){
                 $result[$i]['count'] = count($result[$i]['data']);
                 $sum = 0.00;
                 for($j=0;$j<count($result[$i]['data']);$j++){
                     $sum = $this->time_sum($sum,$result[$i]['data'][$j]['extra_hours']);
                 }
                 $result[$i]['sum'] = $sum;
             }
            return $result;
        }else{
            return array();
        }
    }
    
    function  get_employee_contract_timing($month,$year,$empl){
        require_once('class/employee.php');
        $employee = new employee();
        $this->tables = array('employee_contract');
        $this->fields = array('date_from','date_to','hour','part_time');
        $this->conditions = array('AND',array('OR','MONTH(date_from) = ?','MONTH(date_to) = ?'),array('OR','YEAR(date_from) = ?','YEAR(date_to) = ?'),'employee = ?');
        $this->condition_values = array($month,$month,$year,$year,$empl);
        $this->query_generate();
        $data = $this->query_fetch();
        $monthly = 0;
        $weekly = 0 ;
        for($i=0;$i<count($data);$i++){
//            $working_days = get_working_days();
            $hrs = $data[$i]['hour'];
            $diff = $employee->date_difference($data[$i]['date_from'], $data[$i]['date_to']);
            $tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
            $tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
//            $tot_day = floor($diff / (24 * 60 * 60)) == 0 ? 1 : floor($diff / (24 * 60 * 60));
//            $current_date = date('Y-m-d');
            $monthly = $monthly + number_format($hrs / $tot_month,1);
            $weekly = $weekly + number_format($hrs / $tot_week,1);
            $data[$i]['monthly'] = number_format($hrs / $tot_month,1);
            $data[$i]['weekly'] = number_format($hrs / $tot_week,1);
        }
        return $monthly."/".$weekly;
    }
    
    function employee_no_contract_report($month,$year){
        $company = new company();
        $employee = new employee();
        $no_contract_employee = array();
        $company_details = $company->get_company_detail($_SESSION['company_id']);
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $week_start_num = date('W', strtotime("01-".$month."-".$year));
        $week_end_num = date('W', strtotime($num."-".$month."-".$year));
        $weeks_array = array();
        $number_of_weeks = $week_end_num - $week_start_num;
        for($i=0;$i<=$number_of_weeks;$i++){
            $weeks_array[]['num'] = $week_start_num+$i;
        } 
        for($i=0;$i<count($weeks_array);$i++){
            $weeks_array[$i]['time_emp'] = '0.00';
        } 
        $employees_detail = $employee->employee_list();
        $this->tables = array('employee_contract');
        $this->fields = array('employee');
        $this->conditions = array('AND',array('OR','MONTH(date_from) = ?','MONTH(date_to) = ?'),'YEAR(date_from) = ?','YEAR(date_to) = ?');
        $this->condition_values = array($month,$month,$year,$year);
        $this->query_generate();
        $data = $this->query_fetch();
        for($i=0;$i<count($data);$i++){
            $contract_employee[] = $data[$i]['employee'];
        }
        for($i=0;$i<count($employees_detail);$i++){
            $employees[] = $employees_detail[$i]['username'];
        }
        for($i=0;$i<count($employees);$i++){
            if(in_array($employees[$i], $contract_employee)){
                continue;
            }else{
                $no_contract_employee[]['username'] = $employees[$i];
            }
        }
        for($i=0;$i<count($no_contract_employee);$i++){
            for($j=0;$j<count($employees_detail);$j++){
                if($employees_detail[$j]['username'] == $no_contract_employee[$i]['username']){
                    $no_contract_employee[$i]['first_name'] = $employees_detail[$j]['first_name'];
                    $no_contract_employee[$i]['last_name'] = $employees_detail[$j]['last_name'];
                }
            }
        }
//         $no_contract_employee = $employees;
//        $no_contract_employee = array_diff($employees, $contract_employee);
        for($i=0;$i<count($no_contract_employee);$i++){
            if($no_contract_employee[$i]){
                $weeks = $weeks_array;
                $this->tables = array('timetable');
                $this->fields = array('time_from','time_to','date');
                $this->conditions = array('AND','employee = ?','MONTH(date) = ?','YEAR(date) = ?','status = 1');
                $this->condition_values = array($no_contract_employee[$i]['username'],$month,$year);
                $this->query_generate();
                $data1 = $this->query_fetch();
                if($data1){
                    for($j=0;$j<count($data1);$j++){
                        $week_num_date = date('W', strtotime($data1[$j]['date']));
                        for($k=0;$k<count($weeks);$k++){
                            $weeks[$k]['time_contract'] = $company_details['weekly_hour'];
                           if($week_num_date == $weeks[$k]['num']){
                               $weeks[$k]['time_emp'] = $employee->time_sum($employee->time_difference($data1[$j]['time_to'], $data1[$j]['time_from']), $weeks[$k]['time_emp']);
                           } 
                        }
                    }
                }else{
                    for($k=0;$k<count($weeks);$k++){
                            $weeks[$k]['time_contract'] = $company_details['weekly_hour'];
                            $weeks[$k]['time_emp'] = "0.00";

                        }
                }
                $no_contract_employee[$i]['weeks'] = $weeks;
            }

        } 
        return $no_contract_employee;
    }
    
    function get_timetable_to_add_calender($emp,$start_date,$end_date){
        $this->tables = array('timetable');
        $this->fields = array('id','employee','customer','date','time_from','time_to','type','status','google_id');
        $this->conditions = array('AND','date >= ?','date <= ?','employee = ?','status = 1');
        $this->condition_values = array($start_date,$end_date,$emp);
        $this->order_by = array('date','time_from');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function set_google_id($ids,$google_id){
        $this->tables = array('timetable');
        $this->fields = array('google_id');
        $this->field_values = array($google_id);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        if($this->query_update()){
            return true;
        }else{
            return false;
        }
    }
    
    
    function get_all_document_archive($id = null){

        if($_SESSION['user_role'] == 1){
            $this->sql_query = "SELECT da.id, da.employee, da.file_name, da.category, da.status, da.date, e.first_name, e.last_name, da.users, mda.document_id FROM document_archive da INNER JOIN employee e ON da.employee = e.username LEFT JOIN mc_document_archive mda ON da.id = mda.document_id AND mda.user = '".$_SESSION['user_id']."'";
        }elseif($_SESSION['user_role'] == 4){
            $this->sql_query = "SELECT da.id, da.employee, da.file_name, da.category, da.status, da.date, e.first_name, e.last_name, da.users, mda.document_id FROM document_archive da INNER JOIN employee e ON da.employee = e.username AND (da.employee = '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id'].",%' OR da.users LIKE '%,".$_SESSION['user_id']."' OR da.users LIKE '%,".$_SESSION['user_id'].",%' OR da.users = '".$_SESSION['user_id']."' OR da.users = '*') LEFT JOIN mc_document_archive mda ON da.id = mda.document_id AND mda.user = '".$_SESSION['user_id']."'";
        }else{
            $this->sql_query = "SELECT da.id, da.employee, da.file_name, da.category, da.status, da.date, e.first_name, e.last_name, da.users, mda.document_id FROM document_archive da INNER JOIN employee e ON da.employee = e.username AND (da.employee = '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id'].",%' OR da.users LIKE '%".$_SESSION['user_id']."-%' OR da.users = '".$_SESSION['user_id']."' OR da.users = '*') LEFT JOIN mc_document_archive mda ON da.id = mda.document_id AND mda.user = '".$_SESSION['user_id']."'";
        }

        if($id !=null){
            $this->sql_query .= " WHERE da.category = ".$id;
        }

        $this->sql_query .= " ORDER BY da.date DESC";

        $data = $this->query_fetch();
        return ($data ? $data : array());
    }
    
    function document_archive_add(){
        $start_time = new DateTime;
        $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $start_time->setTimestamp(time());
        $date = $start_time->format('Y-m-d G:i:s');
        //$date = date('Y-m-d H:i:s');
        $this->tables = array('document_archive');
        $this->fields = array('employee','file_name','status','users','category','date');
        $this->field_values = array($this->employee,$this->filename,$this->status, $this->da_users,$this->category,$date);
        if($this->query_insert()){
            return true;
        }else{
            return false;
        }
         
    }
    
    function document_archive_edit($doc_id){
        $this->tables = array('document_archive');
        $this->fields = array('employee','file_name','status');
        $this->field_values = array($this->employee,$this->filename,$this->status);
        $this->conditions = array('id= ?');
        $this->condition_values = array($doc_id);
        if($this->query_update()){
            return true;
        }else{
            return false;
        }
        
    }
    
    function document_archive_delete($doc_id){
        $this->tables = array('document_archive');
        $this->conditions = array('id= ?');
        $this->condition_values = array($doc_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
        
    }
    
    function document_archive_update_privilege($doc_id, $users){
        $this->tables = array('document_archive');
        $this->fields = array('users');
        $this->field_values = array($users);
        $this->conditions = array('id= ?');
        $this->condition_values = array($doc_id);
        if($this->query_update()){
            return true;
        }else{
            return false;
        }
        
    }

    function document_archive_mark_read($document_id){
        $this->sql_query = "SELECT count(document_id) as read_status FROM mc_document_archive WHERE document_id = ". $document_id. " AND user = '". $_SESSION['user_id']. "'";
        
        $data = $this->query_fetch();
        if($data[0]['read_status'] == 0){
            $this->tables = array('mc_document_archive');
            $this->fields = array('document_id', 'user');
            $this->field_values = array($document_id, $_SESSION['user_id']);
            if($this->query_insert()){
                return true;
            }else{
                return false;
            }
        }

    }

    function get_no_of_signs_in_a_month(){
        $this->tables = array('document_sign');
        $this->fields = array('count(id) as count');
        $this->conditions = array('AND', 'month(date_to) = ?', 'year(date_to) = ?');
        $this->condition_values = array(date('m'),date('Y'));
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    
    
    function employee_export_group_bank_signed($user, $month, $year, $sel_employee = NULL, $allowed_employees = array(), $allowed_customers = array(), $privilege_general = array()){
        
        $result = array();
        $this->flush();
        $this->sql_query = 'SELECT DISTINCT t.employee as employee, e.first_name, e.last_name, e.username
                            FROM `timetable` AS t
                            JOIN `employee` AS e ON (t.employee = e.username)
                            WHERE t.status = 1 AND t.fkkn = 1 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.employee IS NOT NULL AND t.employee != "" ';
        $this->condition_values = array($month, $year);
        
        if($_SESSION['user_role'] != 1 && $privilege_general['administration_fk_export'] != 1){
            $this->sql_query .= ' AND t.employee = ?';
            $this->condition_values[] = $user;
        }
        
        if($sel_employee != NULL){
            $this->sql_query .= ' AND t.employee = ?';
            $this->condition_values[] = $sel_employee;
        }
        
        if($allowed_employees !== NULL && is_array($allowed_employees)){
            $this->sql_query .= ' AND t.employee IN (\'' . implode('\',\'', $allowed_employees) . '\') ';
        }
        
        $this->sql_query .= ' ORDER BY LOWER(e.last_name) collate utf8_bin, LOWER(e.first_name) collate utf8_bin';
        
        /*$this->tables = array('team','employee');
        $this->fields = array('distinct(team.employee)','employee.first_name','employee.last_name','employee.username');
        $this->conditions = array('AND', 'team.employee = employee.username', 'employee.status = 1');

        if($_SESSION['user_role'] != 1){
            $this->conditions[] = 'team.employee = ?';
            $this->condition_values = array($user);
        }
        
        if($sel_employee != NULL){
            $this->conditions[] = 'team.employee = ?';
            $this->condition_values = array($sel_employee);
        }
        
        if($allowed_employees !== NULL && is_array($allowed_employees)){
            $this->conditions[] = array('IN', 'team.employee', '\'' . implode('\',\'', $allowed_employees) . '\'');
        }

        $this->query_generate();*/
        $data = $this->query_fetch();
        for($i=0;$i<count($data);$i++){
            $this->flush();
            $this->sql_query = 'SELECT DISTINCT t.customer as customer, c.username, c.first_name, c.last_name, c.email, ersd.signing_date as employer_sign_date
                                FROM `timetable` AS t
                                JOIN `customer` AS c ON (t.customer = c.username)
                                LEFT JOIN `report_signing` AS r ON (t.customer = r.customer AND t.employee = r.employee AND MONTH(r.date) = '.$month.' AND YEAR(r.date) = '.$year.'  AND r.employee = r.signin_employee)
                                LEFT JOIN `signing_employer` AS ers ON (t.customer = ers.customer AND ers.month = '.$month.' AND ers.year = '.$year.'  AND ers.fkkn = 1)
                                LEFT JOIN `signing_employer_data` AS ersd ON (ersd.master_id = ers.id AND t.employee = ersd.employee)
                                WHERE t.status = 1 AND t.fkkn = 1 AND t.employee = ? AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != "" 
                                AND (r.employee_sign IS NOT NULL AND r.employee_sign != "") 
                                AND (ersd.employer_sign IS NOT NULL AND ersd.employer_sign != "") ';
            $this->condition_values = array($data[$i]['employee'], $month, $year);

            if($allowed_customers !== NULL && is_array($allowed_customers)){
                $this->sql_query .= ' AND t.customer IN (\'' . implode('\',\'', $allowed_customers) . '\') ';
            }
            
            $this->sql_query .= ' ORDER BY LOWER(c.last_name) collate utf8_bin, LOWER(c.first_name) collate utf8_bin';

            /*$this->tables = array('team` as `t', 'customer` as `c', 'report_signing` as `r', 'signing_employer` as `ers', 'signing_employer_data` as `ersd');
            $this->fields = array('distinct(t.customer)','t.role','c.username','c.first_name','c.last_name','c.email');
            $this->conditions = array('AND','t.employee = ?','t.customer = c.username', 'c.status = 1',
                't.customer = r.customer', 't.employee = r.employee', 'MONTH(r.date) = ?', 'YEAR(r.date) = ?', 'r.employee_sign IS NOT NULL', 'r.employee_sign != ?',
                't.customer = ers.customer', 'ers.month = ?', 'ers.year = ?',
                'ersd.master_id = ers.id', 't.employee = ersd.employee', 'ersd.employer_sign IS NOT NULL', 'ersd.employer_sign != ?');
            $this->condition_values = array($data[$i]['employee'], $month, $year, "", $month, $year, "");
            
            if($allowed_customers !== NULL && is_array($allowed_customers)){
                $this->conditions[] = array('IN', 't.customer', '\'' . implode('\',\'', $allowed_customers) . '\'');
            }
            
            $this->order_by = array('t.employee','t.role ASC');
            $this->query_generate();*/
            $data1 = $this->query_fetch();      
            $result[] = array('employee_username' => $data[$i]['username'], 'employee_fname' => $data[$i]['first_name'], 'employee_lname' => $data[$i]['last_name'], 'employee_customers' => $data1);
        }
        return $result;
    }
    
    function customer_export_group_bank_signed($user, $month, $year, $sel_customer = NULL, $allowed_employees = array(), $allowed_customers = array(), $privilege_general = array()){
        
        if($sel_customer == NULL) return array();
        
        $result = array();
        $this->tables = array('customer');
        $this->fields = array('first_name','last_name','username', 'email');
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($sel_customer);
        
        if($allowed_customers !== NULL && is_array($allowed_customers)){
            $this->conditions[] = array('IN', 'username', '\'' . implode('\',\'', $allowed_customers) . '\'');
        }

        $this->query_generate();
        $data = $this->query_fetch();
        if(!empty($data)){
            $this->flush();
            $this->sql_query = 'SELECT DISTINCT t.employee as employee, e.first_name, e.last_name, e.email, ersd.signing_date as employer_sign_date
                                FROM `timetable` AS t
                                JOIN `employee` AS e ON (t.employee = e.username)
                                LEFT JOIN `report_signing` AS r ON (t.customer = r.customer AND t.employee = r.employee AND MONTH(r.date) = '.$month.' AND YEAR(r.date) = '.$year.' AND r.employee = r.signin_employee) 
                                LEFT JOIN `signing_employer` AS ers ON (t.customer = ers.customer AND ers.month = '.$month.' AND ers.year = '.$year.' AND ers.fkkn = 1)
                                LEFT JOIN `signing_employer_data` AS ersd ON (ersd.master_id = ers.id AND t.employee = ersd.employee)
                                WHERE t.status = 1 AND t.fkkn = 1 AND t.customer = ? AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.employee IS NOT NULL AND t.employee != "" 
                                AND (r.employee_sign IS NOT NULL AND  r.employee_sign != "")  
                                AND (ersd.employer_sign IS NOT NULL AND ersd.employer_sign != "") ';
            $this->condition_values = array($sel_customer, $month, $year);
            
            if($_SESSION['user_role'] != 1 && $privilege_general['administration_fk_export'] != 1){
                $this->sql_query .= ' AND t.employee = ?';
                $this->condition_values[] = $user;
            }
            if($allowed_employees !== NULL && is_array($allowed_employees)){
                $this->sql_query .= ' AND t.employee IN (\'' . implode('\',\'', $allowed_employees) . '\') ';
            }
            $this->sql_query .= ' ORDER BY LOWER(e.last_name) collate utf8_bin, LOWER(e.first_name) collate utf8_bin';

            /*$this->tables = array('team` as `t','employee` as `e', 'report_signing` as `r', 'signing_employer` as `ers', 'signing_employer_data` as `ersd');
            $this->fields = array('distinct(t.employee)','t.role','e.username','e.first_name','e.last_name','e.email');
            $this->conditions = array('AND','t.customer = ?','t.employee = e.username', 'e.status = 1',
                't.customer = r.customer', 't.employee = r.employee', 'MONTH(r.date) = ?', 'YEAR(r.date) = ?', 'r.employee_sign IS NOT NULL', 'r.employee_sign != ?',
                't.customer = ers.customer', 'ers.month = ?', 'ers.year = ?',
                'ersd.master_id = ers.id', 't.employee = ersd.employee', 'ersd.employer_sign IS NOT NULL', 'ersd.employer_sign != ?');
            $this->condition_values = array($sel_customer, $month, $year, "", $month, $year, "");
            

            if($_SESSION['user_role'] != 1){
                $this->conditions[] = 't.employee = ?';
                $this->condition_values = array($user);
            }
            if($allowed_employees !== NULL && is_array($allowed_employees)){
                $this->conditions[] = array('IN', 't.employee', '\'' . implode('\',\'', $allowed_employees) . '\'');
            }
            
            $this->order_by = array('t.employee','t.role ASC');
            $this->query_generate();*/
            $data1 = $this->query_fetch();
            
           // echo "<pre>".print_r($data1, 1)."</pre>";
            if(!empty($data1)){
                foreach($data1 as $edata){
                    $result[] = array(
                        'employee_username' => $edata['employee'], 
                        'employee_fname' => $edata['first_name'], 
                        'employee_lname' => $edata['last_name'], 
                        'employee_customers' => array(
                            array(
                            'customer'  => $data[0]['username'],
                            'role'      => $edata['role'],
                            'username'  => $data[0]['username'],
                            'first_name'=> $data[0]['first_name'],
                            'last_name' => $data[0]['last_name'],
                            'email'     => $data[0]['email'],
                            'employer_sign_date'     => $edata['employer_sign_date']
                        )));
                }
            }
        }
        return $result;
    }
    
    function customer_export_group_bank_signed_dt($user, $month, $year, $sel_customer = NULL, $allowed_employees = array(), $allowed_customers = array(), $privilege_general = array()){
        
        //if($sel_customer == NULL) return array();
    
        $result = array();
        $this->tables = array('customer');
        $this->fields = array('first_name','last_name','username', 'email');
        $this->conditions = array('AND', 'username != ?');
        $this->condition_values = array('');
        
        if($allowed_customers !== NULL && is_array($allowed_customers)){
            $this->conditions[] = array('IN', 'username', '\'' . implode('\',\'', $allowed_customers) . '\'');
        }

        $this->query_generate();
        $data = $this->query_fetch();
        if(!empty($data)){
            $this->flush();
            $this->sql_query = 'SELECT DISTINCT t.employee as employee
                                FROM `timetable` AS t
                                JOIN `employee` AS e ON (t.employee = e.username)
                                LEFT JOIN `report_signing` AS r ON (t.customer = r.customer AND t.employee = r.employee AND MONTH(r.date) = '.$month.' AND YEAR(r.date) = '.$year.' AND r.employee = r.signin_employee) 
                                LEFT JOIN `signing_employer` AS ers ON (t.customer = ers.customer AND ers.month = '.$month.' AND ers.year = '.$year.' AND ers.fkkn = 1)
                                LEFT JOIN `signing_employer_data` AS ersd ON (ersd.master_id = ers.id AND t.employee = ersd.employee)
                                WHERE t.status = 1 AND t.fkkn = 1 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.employee IS NOT NULL AND t.employee != "" 
                                AND (r.employee_sign IS NOT NULL AND  r.employee_sign != "")  
                                AND (ersd.employer_sign IS NOT NULL AND ersd.employer_sign != "") ';
            $this->condition_values = array($month, $year);
            
            if($_SESSION['user_role'] != 1 && $privilege_general['administration_fk_export'] != 1){
                $this->sql_query .= ' AND t.employee = ?';
                $this->condition_values[] = $user;
            }
            if($allowed_employees !== NULL && is_array($allowed_employees)){
                $this->sql_query .= ' AND t.employee IN (\'' . implode('\',\'', $allowed_employees) . '\') ';
            }
            $this->sql_query .= ' ORDER BY LOWER(e.last_name) collate utf8_bin, LOWER(e.first_name) collate utf8_bin';

            $data1 = $this->query_fetch();
            
            //echo "<pre>".print_r($data1, 1)."</pre>";
            if(!empty($data1)){
                foreach($data1 as $edata){
                    $result[] = array(
                        'employee_username' => $edata['employee'], 
                        'employee_fname' => $edata['first_name'], 
                        'employee_lname' => $edata['last_name'], 
                        'employee_customers' => array(
                            array(
                            'customer'  => $data[0]['username'],
                            'role'      => $edata['role'],
                            'username'  => $data[0]['username'],
                            'first_name'=> $data[0]['first_name'],
                            'last_name' => $data[0]['last_name'],
                            'email'     => $data[0]['email'],
                            'employer_sign_date'     => $edata['employer_sign_date']
                        )));
                }
            }
        }
        return $result;
    }
    
    function document_archieve_category_add(){
        $date               = date('Y-m-d');
        $this->tables       = array('document_archive_category');
        $this->fields       = array('parent_category','name','alloc_emp','created_date');
        $this->field_values = array($this->parent_cat,$this->category_name,$this->alloc_emp,$date);
        $data               = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;

    }
    function get_direct_childrens($parent_cat,$grp_concat = NULL){
        if($grp_concat != NULL){
            $this->sql_query = "SELECT GROUP_CONCAT(`id`) as id FROM `document_archive_category` WHERE `parent_category` = '".$parent_cat."'";
            $child = $this->query_fetch()[0];
        }
        else{
            $this->sql_query = "SELECT `id`,`name` FROM `document_archive_category` WHERE `parent_category` = '".$parent_cat."'";
            $child = $this->query_fetch();
        }
        

        // $this->tables           = array('document_archive_category');
        // $this->fields           = array('id','name');
        // $this->conditions       = array('parent_category = ?');
        // $this->condition_values = array($parent_cat);
        // $this->query_generate();
        // $child = $this->query_fetch();

        $this->tables           = array('document_archive_category');
        $this->fields           = array('id','name');
        $this->conditions       = array('id = ?');
        $this->condition_values = array($parent_cat);
        $this->query_generate();
        $parent = $this->query_fetch()[0];

        $data = array('parent'=>$parent,'child'=>$child);

        // $this->sql_query = "SELECT (SELECT `name` FROM `document_archive_category` AS `parent_name` WHERE `id` = '".$parent_cat."') AS `parent_name` ,`name`,`id` FROM `document_archive_category` WHERE `parent_category` = '".$parent_cat."'";

        // var_dump($data);
        // $data = $this->query_fetch();
        // exit('fgf');
        return $data;
    }

    function get_all_category(){
        $this->tables           = array('document_archive_category');
        $this->fields           = array('id','name', 'parent_category');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    function document_category_delete($id){
        $all_childes = $this->get_all_level_child($id);
         // array_push($all_childes['child'], $id);
        // exit('dfds');
        // $this->begin_transaction();
        $this->flush();
        if($all_childes['child'] != null){
            $this->sql_query        = "DELETE FROM `document_archive_category` WHERE `id` IN(".$all_childes['child'].','.$id.")";
            $delete = 'multiple';
            $success =$this->query_fetch();
        }
        else{
            $this->tables           = array('document_archive_category');
            $this->conditions       = array('id = ?');
            $this->condition_values = array($id);
            $success = $this->query_delete();
            $delete = 'single';
        }
       
           if($delete == 'single'){
                $this->tables           = array('document_archive');
                $this->conditions       = array('category = ?');
                $this->condition_values = array($id);
                $this->query_delete();
           }
           else if($delete == 'multiple'){
            $this->sql_query        = "DELETE FROM `document_archive` WHERE `category` IN(".$all_childes['child'].','.$id.")";
            $this->query_fetch();
           }
        
        return 1;
    }

    function document_archieve_category_select_file(){
        $this->tables = array('document_archive');
        $this->fields = array('file_name');
        $this->query_generate();
        $data         = $this->query_fetch();
        return $data;
    }

    function document_archieve_category_move(){
        foreach ($this->files_to_move as $key => $value) {
            $this->tables           = array('document_archive');
            $this->fields           = array('category');
            $this->field_values     = array($this->category_id_move);
            $this->conditions       = array('id = ?');
            $this->condition_values = array($value);
            $data                   = $this->query_update();
        }
        if ($data)
            return TRUE;
        else
            return FALSE;
    }   

   function document_category_change($parent_cat_id,$category_edit_id){
        if($parent_cat_id == $category_edit_id){
            $this->tables           = array('document_archive_category');
            $this->fields           = array('name');
            $this->field_values     = array($this->category_edit_name);
            $this->conditions       = array('id = ?');
            $this->condition_values = array($category_edit_id);
            $data                   = $this->query_update();
        }
        else{
            $this->tables           = array('document_archive_category');
            $this->fields           = array('name','parent_category');
            $this->field_values     = array($this->category_edit_name,$parent_cat_id);
            $this->conditions       = array('id = ?');
            $this->condition_values = array($category_edit_id);
            $data                   = $this->query_update();
        }
        if ($data)
            return TRUE;
        else
            return FALSE;
    }


    // function get_category_all($id){
    //     $parent_child_category = $this->document_archieve_category_select($id);
    //     // var_dump($parent_child_category);
    //     // exit('fg');

    // }


    function get_all_folder_acceseble($parent_cat,$user_id){
        // var_dump($user_id);
        $direct_childrens = $this->get_direct_childrens($parent_cat,'grp_concat');
        if(!empty($direct_childrens['child'])){
            $all_level_child = $this->get_all_level_child($parent_cat);
            if($parent_cat == 0) {
            $this->sql_query = "SELECT dac.id,dac.parent_category,dac.name FROM `document_archive_category` dac  LEFT JOIN `document_archive` da ON da.category = dac.id WHERE da.category IN(".implode(" ", $all_level_child).")
                AND (da.users LIKE 'vive001' OR da.users LIKE '".$user_id.",%' OR da.users LIKE '%".$user_id."-%' OR da.users = '".$user_id."' OR da.users = '*' ) OR (dac.alloc_emp = '".$user_id."'  AND dac.id IN (".implode(" ", $direct_childrens['child']).")) OR dac.id = -1 GROUP BY dac.id";
            } else {
                $this->sql_query = "SELECT dac.id,dac.parent_category,dac.name FROM `document_archive_category` dac  LEFT JOIN `document_archive` da ON da.category = dac.id WHERE da.category IN(".implode(" ", $all_level_child).")
                AND (da.users LIKE 'vive001' OR da.users LIKE '".$user_id.",%' OR da.users LIKE '%".$user_id."-%' OR da.users = '".$user_id."' OR da.users = '*' ) OR (dac.alloc_emp = '".$user_id."'  AND dac.id IN (".implode(" ", $direct_childrens['child']).")) GROUP BY dac.id";
            }
                //echo "<pre>".print_r($direct_childrens,1)."</pre>";exit();
                //if($parent_cat) {
                    /*$this->sql_query = "SELECT dac.id,dac.parent_category,dac.name FROM `document_archive_category` dac  LEFT JOIN `document_archive` da ON da.category = dac.id WHERE da.category IN(".implode(" ", $all_level_child).")
                    AND 
                    ( da.users LIKE '".$user_id.",%' OR da.users LIKE '%".$user_id."-%' OR da.users = '".$user_id."' OR da.users = '*'  OR dac.alloc_emp = '".$user_id."'
                    )
                    AND
                    (  
                        dac.id IN (".implode(" ", $direct_childrens['child']).") 
                        OR 
                        ( 
                            dac.id = -1 AND dac.parent_category = $parent_cat
                        )
                    ) 
                    
                    GROUP BY dac.id";*/
                // } else {

                // }
            $data            = $this->query_fetch();
        }
        //var_dump($all_level_child);
        // var_dump($direct_childrens['child']);
        // var_dump($data);
        return $data;        
    }

    function get_all_level_child($parent_cat){
        $parent_cat == '' ? $parent_cat = 0 : $parent_cat;
        $this->sql_query = "SELECT GROUP_CONCAT(lv SEPARATOR ',') child FROM ( SELECT @pv:=(SELECT GROUP_CONCAT(`id` SEPARATOR ',') FROM `document_archive_category` WHERE FIND_IN_SET(`parent_category`, @pv)) AS lv FROM `document_archive_category` JOIN (SELECT @pv:='".$parent_cat."') tmp ) a";
        $data            = $this->query_fetch();
        return $data[0];

    }

    function get_all_level_child_names($all_level_child){
        $this->sql_query = "SELECT `id`,`name`,`parent_category` FROM `document_archive_category` WHERE `id` IN (".implode(" ", $all_level_child).")";
        return $this->query_fetch();
    }

    function get_all_document_archive_count(){

        if($_SESSION['user_role'] == 1){
            $this->sql_query = "SELECT  da.category ,count(*) as count FROM document_archive da INNER JOIN employee e ON da.employee = e.username LEFT JOIN mc_document_archive mda ON da.id = mda.document_id AND mda.user = '".$_SESSION['user_id']."'";
        }elseif($_SESSION['user_role'] == 4){
            $this->sql_query = "SELECT da.category, count(*) as count  FROM document_archive da INNER JOIN employee e ON da.employee = e.username AND (da.employee = '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id'].",%' OR da.users LIKE '%,".$_SESSION['user_id']."' OR da.users LIKE '%,".$_SESSION['user_id'].",%' OR da.users = '".$_SESSION['user_id']."' OR da.users = '*') LEFT JOIN mc_document_archive mda ON da.id = mda.document_id AND mda.user = '".$_SESSION['user_id']."'";
        }else{
            $this->sql_query = "SELECT da.category, count(*) as count FROM document_archive da INNER JOIN employee e ON da.employee = e.username AND (da.employee = '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id']."' OR da.users LIKE '".$_SESSION['user_id'].",%' OR da.users LIKE '%".$_SESSION['user_id']."-%' OR da.users = '".$_SESSION['user_id']."' OR da.users = '*') LEFT JOIN mc_document_archive mda ON da.id = mda.document_id AND mda.user = '".$_SESSION['user_id']."'";
        }
        $this->sql_query .= " GROUP BY da.category";
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }

    function customers_under_vab_leave_employee($cur_month, $cur_year){
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$cur_year-$cur_month-01"));
        $todate = date('Y-m-t', strtotime("$cur_year-$cur_month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->customers_under_vab_leave_employee_process($cur_month, $cur_year, 1);
            $query_2_action = $this->customers_under_vab_leave_employee_process($cur_month, $cur_year, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY LOWER(last_name), LOWER(first_name)';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->customers_under_vab_leave_employee_process($cur_month, $cur_year, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->customers_under_vab_leave_employee_process($cur_month, $cur_year, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        return $datas;
    }
    function customers_under_vab_leave_employee_process($cur_month, $cur_year, $mode = 1){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all customers who have atleast one employee he tooks atleast 1 sick leave(type = 1) on a specified year-month
         * last edited on : 2014-02-15
         */
        // leave type = 3 date : 31-05-2018; 

        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        $timetable = $mode == 1 ? '`timetable`' : '`backup_timetable`';
        $leave = $mode == 1 ? '`leave`' : '`backup_leave`';
        
        $this->flush();
        switch ($login_user_role) {

            case 1:
            case 6:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust , concat(c.first_name, " ", c.last_name) as cust_ff, c.first_name, c.last_name 
                                    FROM '.$timetable.' AS t
                                    JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 3)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != ""
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month,$cur_year);
                // $data = $this->query_fetch();
                return array(
                    'sql_query'         => $this->sql_query,
                    'condition_values'  => $this->condition_values
                );
                break;
            case 2:
            case 3:
            case 5:
            case 7:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust, concat(c.first_name, " ", c.last_name) as cust_ff, c.first_name, c.last_name   
                                    FROM '.$timetable.' AS t
                                    JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 3)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != ""
                                    AND c.username IN (
                                                        SELECT customer 
                                                        FROM `team`
                                                        WHERE employee = ?
                                                        )
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month, $cur_year, $login_user);
                // $data = $this->query_fetch();
                return array(
                    'sql_query'         => $this->sql_query,
                    'condition_values'  => $this->condition_values
                );
                break;
            case 4:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust, concat(c.first_name, " ", c.last_name) as cust_ff, c.first_name, c.last_name   
                                    FROM '.$timetable.' AS t
                                    JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 3)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != "" AND c.username = ?
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month, $cur_year, $login_user);
                // $data = $this->query_fetch();
                return array(
                    'sql_query'         => $this->sql_query,
                    'condition_values'  => $this->condition_values
                );
                break;
        }
        
        return array();
    }

    function employees_vab_leave_under_customer($month, $year, $cust){
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $datas = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->employees_vab_leave_under_customer_process($month, $year, $cust, 1);
            $query_2_action = $this->employees_vab_leave_under_customer_process($month, $year, $cust, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY LOWER(last_name), LOWER(first_name)';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $datas = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->employees_vab_leave_under_customer_process($month, $year, $cust, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->employees_vab_leave_under_customer_process($month, $year, $cust, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $datas = $this->query_fetch();
            }
        }

        return (!empty($datas) ? $datas : FALSE);
    }
    function employees_vab_leave_under_customer_process($month, $year, $cust, $mode = 1){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all employees who have atleast one sick leave(type = 1) on a specified customer-year-month
         * last edited on : 2014-02-15
         */

        $timetable = $mode == 1 ? '`timetable`' : '`backup_timetable`';
        $leave = $mode == 1 ? '`leave`' : '`backup_leave`';

        $this->flush();
        $this->sql_query = 'SELECT DISTINCT t.employee as employee_id, CONCAT(e.last_name, " ", e.first_name) as employee , CONCAT(e.first_name, " ", e.last_name) as employee_ff, e.first_name, e.last_name 
                            FROM '.$timetable.' AS t
                            JOIN '.$leave.' AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                AND l.time_to >= t.time_to AND l.type = 3)
                            JOIN `employee` AS e ON (e.username = t.employee)
                            WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer = ? 
                            ORDER BY LOWER(e.last_name), LOWER(e.first_name)';
        $this->condition_values = array($month, $year, $cust);
        // $data = $this->query_fetch();
        // return (!empty($data) ? $data : FALSE);
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function relations_leave_vab_employee($month, $year, $cust, $emp){
        $employee = new employee();
        $obj_gen       = new general();

        $boundary_date = $obj_gen->get_boundary_date();
        $data = array();
        $fromdate = date('Y-m-d', strtotime("$year-$month-01"));
        $todate = date('Y-m-t', strtotime("$year-$month-01"));
        
        if($fromdate <= $boundary_date && $todate > $boundary_date){

            $query_1_action = $this->relations_leave_vab_employee_process($month, $year, $cust, $emp, 1);
            $query_2_action = $this->relations_leave_vab_employee_process($month, $year, $cust, $emp, 2);
            if(!empty($query_1_action) && !empty($query_2_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $query_2 = $query_2_action['sql_query'];
                $query_2_condition_values = $query_2_action['condition_values'];

                $this->flush();
                $this->sql_query = 'SELECT *
                    FROM (( ' . $query_1 . ' )' . ' UNION ' . '( ' . $query_2 . ' ) ) As sample1
                    ORDER BY date, time_from ';
                $this->condition_values = array_merge($query_1_condition_values, $query_2_condition_values);
                $data = $this->query_fetch();
            }

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $query_1_action = $this->relations_leave_vab_employee_process($month, $year, $cust, $emp, 2);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $data = $this->query_fetch();
            }
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $query_1_action = $this->relations_leave_vab_employee_process($month, $year, $cust, $emp, 1);
            if(!empty($query_1_action)){
                $query_1 = $query_1_action['sql_query'];
                $query_1_condition_values = $query_1_action['condition_values'];

                $this->flush();
                $this->sql_query = $query_1;
                $this->condition_values = $query_1_condition_values;
                $data = $this->query_fetch();
            }
        }
        
        $flg_holiday = 0;
        $inconv = $employee->get_holiday_details($month, $year);
        if(empty ($inconv)){ 
            $this->tables = array('inconvenient_timing');
            $this->fields = array('name','effect_from','effect_to','time_from','time_to','type','days', '"INCONVENIENT" as category');
            $this->conditions = array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?'));
            $this->condition_values = array($month,$year,$month,$year,$month,$year);
            $this->query_generate();
            $inconv = $this->query_fetch();
        }else
            $flg_holiday = 1;
        
        $result = array();
        if(!empty($data)){
            $relations_counts = count($data);
            $inconvenients_count = count($inconv);
            $process_normal_slot_types = array(0,1,2,4,5,6,7,8,10,11,12,15);
            $process_oncall_slot_types = array(3,9,13,14);
        
            for($i=0 ; $i < $relations_counts ; $i++){
               // $date_day = date('N', strtotime($data[$i]['date']));
                $result[$i]['date'] = $data[$i]['date'];
                $result[$i]['time_from'] = $data[$i]['time_from'];
                $result[$i]['time_to'] = $data[$i]['time_to'];
                $result[$i]['type'] = $data[$i]['type'];
                $result[$i]['status'] = $data[$i]['status'];
                $result[$i]['tot_time'] = $this->time_user_format($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']), 100);
                $result[$i]['employee'] = $data[$i]['employee'];
                $result[$i]['employee_id'] = $data[$i]['employee_id'];
               // $result[$i]['inconv'] = $employee->check_condition_holiday($data[$i], $inconv);
                $result[$i]['inconv'] = $this->get_work_hours_inconvenience($data[$i], $inconv);
                
                $result[$i]['inconv'] = (!empty($result[$i]['inconv']) ? implode(', ', $result[$i]['inconv']) : '');    //set as single string with , seperated
            }
            
            $tmp_relations = array();
            for($i = 0 ; $i<count($result); $i++){
                $flg=0;
                foreach($tmp_relations as $tmp){
                    if(in_array($tmp['employee_id'], $result[$i])){
                        $flg = 1;
                        break;
                    }
                }
                $tmp_relations[$i] = $result[$i];
                if($flg == 1)
                    $tmp_relations[$i]['repeat'] = 1;
                else
                    $tmp_relations[$i]['repeat'] = 0;
            }
           // echo "--------------------<pre>Output ".print_r($tmp_relations, 1)."</pre>";
            return $tmp_relations;
        }
        else
            return array();
    }
    function relations_leave_vab_employee_process($month, $year, $cust, $emp, $mode = 1){

        $timetable = $mode == 1 ? 'timetable' : 'backup_timetable';
        $leave = $mode == 1 ? 'leave' : 'backup_leave';

        // join with leave table to filter leave from vacation leave
        $this->tables = array($timetable.'` as `t', $leave.'` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 2' ,'t.customer = ?','t.employee = ?',
                    'l.type = 3', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to');
        $this->condition_values = array($month,$year,$cust,$emp);
        $this->query_generate();
        $time_table_ids = $this->query_fetch(2); 
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';
        
        
        $this->tables = array($timetable.'` as `t','employee` as `e');
        $this->fields = array('t.employee as employee_id','concat(first_name ," ", last_name) as employee','t.customer as customer','t.date as date','t.fkkn as fkkn','t.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status','t.relation_id as relation_id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 1',array('IN','t.relation_id',$ids),'t.customer = ?','e.username like t.employee');
        $this->condition_values = array($month,$year,$cust);
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
        // $data = $this->query_fetch();
        return array(
            'sql_query'         => $this->sql_query,
            'condition_values'  => $this->condition_values
        );
    }

    function get_public_documents($month = NULL, $year = NULL){
        if(!$month) {
            $month = date('m');
        }
        if(!$year) {
            $year = date('Y');
        }
        $from_date = $year . '-' . $month . '-01';
        $day = date('t', strtotime($from_date));
        $to_date = $year . '-' . $month . '-' . $day;
        $this->sql_query = "SELECT id, employee, file_name, category, status, date 
        FROM document_archive 
        WHERE (date BETWEEN '$from_date' AND '$to_date') 
        AND category = '-1' 
        ORDER BY date ASC";
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }

    function get_employee_signed_document($month = NULL, $year = NULL){
        if(!$month) {
            $month = date('m');
        }
        if(!$year) {
            $year = date('Y');
        }
        $from_date = $year . '-' . $month . '-01';
        $day = date('t', strtotime($from_date));
        $to_date = $year . '-' . $month . '-' . $day;

        $this->sql_query = "SELECT e.username, e.first_name, e.last_name, 
        ds.date_from, ds.date_to, ds.sign, ds.ocs, ds.deleted_username, ds.deleted_date 
        FROM employee e 
        LEFT JOIN document_sign ds ON ds.username = e.username AND ds.sign=1 AND ds.ocs=1 
        WHERE (ds.date_from <= '$to_date' AND ds.date_to >= '$from_date') OR (ds.date_from >= '$to_date' AND ds.date_to >= '$from_date') OR (ds.date_from <= '$from_date' AND ds.date_to >= '$to_date') OR (ds.date_from <= '$from_date' AND ds.date_to >= '$to_date') OR (ds.date_from IS NULL AND ds.date_to IS NULL)  
        ORDER BY ds.date_to";
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }

    function get_public_document_archive($username = null){
        if(!$username) {
            $username = $_SESSION['user_id'];
        }
        $this->sql_query = "SELECT da.id, da.employee, da.file_name, da.category, da.status, da.date, e.first_name, e.last_name, da.users,(SELECT ds.id FROM document_sign ds WHERE ds.sign = 1 AND ds.ocs = 1 AND da.date BETWEEN ds.date_from AND ds.date_to AND ds.username = '$username') AS signed_id,  
        (SELECT ds.date_to FROM document_sign ds WHERE ds.sign = 1 AND ds.ocs = 1 AND da.date BETWEEN ds.date_from AND ds.date_to AND ds.username = '$username' LIMIT 0, 1) AS signed_date 
        FROM document_archive da 
        INNER JOIN employee e ON da.employee = e.username 
        WHERE da.category = '-1' 
        ORDER BY da.date DESC";
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }

    function get_document_sign_by_user($username) {
        $result = FALSE;
        $this->tables = array('document_sign');
        $this->fields = array('id', 'username', 'date_from', 'date_to', 'sign', 'ocs', 'deleted_username');
        $this->conditions = array('AND', 'username = ?', 'sign = 1', 'ocs = 1');
        $this->condition_values = array($username);
        $this->order_by = array('date_to ASC');
        $this->query_generate();
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $prev_date = '';
            foreach ($datas as $data) {
                if(!$prev_date) {
                    $prev_date = $data['date'];
                }
                $data['from_date'] = $prev_date;
                $data['to_date'] = $data['date'];
                $prev_date = date('Y-m-d H:i:s', (strtotime($data['date']) + 1));
                $result[] = $data;
            }
        }
        return $result;
    }

    function get_document_sign_from_date($username) {
        $from_date = FALSE;
        $this->tables = array('document_sign');
        $this->fields = array('id', 'username', 'date_from', 'date_to', 'sign', 'ocs', 'deleted_username');
        $this->conditions = array('AND', 'username = ?', 'sign = 1', 'ocs = 1');
        $this->condition_values = array($username);
        $this->order_by = array('id DESC');
        $this->query_generate();
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $from_date = date('Y-m-d H:i:s', (strtotime($datas[0]['date_to']) + 1));
        } else {
            $from_date = date('Y-m-d H:i:s');
            $this->sql_query = "SELECT da.date FROM document_archive da 
            WHERE da.category = '-1' 
            ORDER BY da.date ASC
            LIMIT 0, 1";
            $datas = $this->query_fetch();
            if(!empty($datas)){
                $from_date = $datas[0]['date'];
            }
        }
        return $from_date;
    }

    function get_document_sign($id) {
        $this->tables = array('document_sign');
        $this->fields = array('id', 'username', 'date_from', 'date_to', 'sign', 'ocs', 'deleted_username');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function insert_document_sign($username) {
        $to_date = date('Y-m-d H:i:s');
        $from_date = $this->get_document_sign_from_date($username);
        $this->tables = array('document_sign');
        $this->fields = array('username', 'date_from', 'date_to', 'sign', 'ocs');
        $this->field_values = array($username, $from_date, $to_date, 1, 1);
        $query = $this->query_insert();
        if ($query) {
            return $this->last_insert_id;
        } else {
            return FALSE;
        }
    }

    function insert_document_sign_details($data = array()) {
        $this->tables = array('document_sign_details');
        $this->fields = array('id', 'sign', 'ocs');
        $this->field_values = array($data['id'], $data['sign'], $data['ocs']);
        $query = $this->query_insert();
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_document_sign($id, $deleted_username) {
        $data = $this->get_document_sign($id);
        $this->tables = array('document_sign');
        $this->fields = array('sign', 'ocs', 'deleted_username', 'deleted_date');
        $this->field_values = array(0, 0, $deleted_username, date('Y-m-d H:i:s'));
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $query = $this->query_update();
        if ($query) {
            return $this->delete_document_sign_details($id);
        } else {
            return FALSE;
        }
    }

    function delete_document_sign_details($id) {
        $this->tables = array('document_sign_details');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_delete()){
            return true;
        } else {
            return false;
        }
    }
}
?>