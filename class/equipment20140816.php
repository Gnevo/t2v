<?php
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/employee.php');
require_once ('class/customer.php');
require_once ('class/company.php');
require_once ('class/dona.php');


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
    function time_user_format($t1, $mod=60) {
        $a1 = explode(".", $t1);
        $hours = $a1[0];
        $mins = str_pad($a1[1], 2, '0', STR_PAD_RIGHT);
        if($mod == 100)
            $mins = round($mins*100/60);
        else
            $mins = round($mins*60/100);
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
        if($data){
            return TRUE;
        }
        else 
            return FALSE;
    }
  
   function customer_timetable_month($cust,$month,$year,$emp,$role,$condition_array = array())
    {
        if($cust == '' || $cust == null){
            $obj_emp = new employee();
            $employee_acc_role = $obj_emp->employee_list();
            $select_employees = array('OR');
            for($i=0;$i<count($employee_acc_role);$i++){
                $select_employees[] = 'employee = "'.$employee_acc_role[$i]['username'].'"';
//               if($select_employees == '')
//                   $select_employees = $employee_acc_role[$i]['username'];
//               else
//                  $select_employees = $select_employees.",".$employee_acc_role[$i]['username']; 
            }
        }
       
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
       
        $result = array();
        $this->tables = array('timetable');
        $this->fields = array('employee','customer','date','time_from','time_to','type','status','fkkn');
        $this->field_values = array();        
        if($cust){
            $this->conditions = array('AND','month(date) = ?','year(date) = ?','customer = ?',array('OR','status = 1','status = 2'));
            //$this->conditions = array('AND','month(date) = ?','year(date) = ?','customer = ?');
            $this->condition_values = array($month,$year,$cust);
        }
        else{
            if($role == 3){
                $this->conditions = array('AND','month(date) = ?','year(date) = ?',array('OR','status = 1','status = 2')/*,$cond*/,'employee = ?');
                $this->condition_values = array($month,$year,$emp);
            }else{
                $this->conditions = array('AND','month(date) = ?','year(date) = ?',array('OR','status = 1','status = 2')/*,$cond*/,$select_employees);
                $this->condition_values = array($month,$year);
            }
            
        }
        if(!empty($condition_array))
            $this->conditions[] = $condition_array;
        $this->order_by = array('date','time_from', 'time_to', 'employee');
//        echo "<pre>". print_r($this->condition_values, 1)."</pre>";
        $this->query_generate();
//        echo $this->sql_query;
        $data1 = $this->query_fetch();
//            echo "<pre>a". print_r($data1, 1)."</pre>";
        
        $datas = $this->employees_present();
        $cust_datas = $this->customers_present();
        $data = array();
        for($i=0;$i<count($data1);$i++){
            $data[$i]['customer'] = $data1[$i]['customer'];
            $data[$i]['date'] = $data1[$i]['date'];
            $data[$i]['time_from'] = $data1[$i]['time_from'];
            $data[$i]['time_to'] = $data1[$i]['time_to'];
            $data[$i]['type'] = $data1[$i]['type'];
            $data[$i]['status'] = $data1[$i]['status'];
            $data[$i]['emp_username'] = $data1[$i]['employee'];
            $data[$i]['fkkn'] = $data1[$i]['fkkn'];
            for($j=0;$j<count($datas);$j++){
                if($data1[$i]['employee'] == $datas[$j]['username']){
                    if($_SESSION['company_sort_by'] == 1)
                        $data[$i]['employee'] = $datas[$j]['first_name']." ".$datas[$j]['last_name'];
                    elseif($_SESSION['company_sort_by'] == 2)
                        $data[$i]['employee'] = $datas[$j]['last_name']." ".$datas[$j]['first_name'];
                    $data[$i]['color'] = $datas[$j]['color'];
                }
            }for($j=0;$j<count($datas);$j++){
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
//            echo "<pre>b". print_r($data, 1)."</pre>";
        $days1 = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $week_num_start = date('W',  strtotime($year."-".$month."-01"));
//        echo $week_num_start = date('d',  strtotime($year."-".$month."-01"));
//        echo $week_num_start = date('W',  strtotime('-1 day', strtotime($year."-".$month."-01")));
//        echo $week_num_start = date('d',  strtotime('-1 day', strtotime($year."-".$month."-01")));
        $val = $week_num_start;
        if($month == '12'){
            
           $week_num_end = date('W',  strtotime($year."-".$month."-".$days1));
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
            $week_num_end = date('W',  strtotime($year."-".$month."-".$days1));
        }
        $week_num_end_new = date('W',  strtotime($year."-".$month."-".$days1));
        if($week_num_end_new == '01'){
            for($i=0;$i<(($week_num_end)-$week_num_start);$i++){
                $result[$i] = array(
                    'week' => $val ,
                    'employee'=>array(),
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
//                $result[$i] = array('week' => $val ,'employee'=>array(),'sun'=>date("d", strtotime($year."-W".$val."-". 0 ."w")),'mon'=>$year."-W".$val."-". 1 ."w",'tue'=>$year."-W".$val."-". 2 ."w",'wed'=>$year."-W".$val."-". 3 ."w",'thu'=>$year."-W".$val."-". 4 ."w",'fri'=>$year."-W".$val."-". 5 ."w",'sat'=>$year."-W".$val."-". 6 ."w"); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            }
            $result[$i] = array(
                'week' => $week_num_end_new,
                'sun'=>array(date("d", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("m", strtotime(($year+1)."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"))),
                'mon'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 1 ."w"))),
                'tue'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 2 ."w"))),
                'wed'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 3 ."w"))),
                'thu'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 4 ."w"))),
                'fri'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 5 ."w"))),
                'sat'=>array(date("d", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w")),date("m", strtotime(($year+1)."-W".$week_num_end_new."-". 6 ."w"))),
                /*'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())*/);
//            $result[$i] = array('week' => $week_num_end_new,'sun'=>date("d", strtotime($year."-W".$week_num_end_new."-". 0 ."w")),'mon'=>date("d", strtotime($year."-W".$week_num_end_new."-". 1 ."w")),'tue'=>date("d", strtotime($year."-W".$week_num_end_new."-". 2 ."w")),'wed'=>date("d", strtotime($year."-W".$week_num_end_new."-". 3 ."w")),'thu'=>date("d", strtotime($year."-W".$week_num_end_new."-". 4 ."w")),'fri'=>date("d", strtotime($year."-W".$week_num_end_new."-". 5 ."w")),'sat'=>date("d", strtotime($year."-W".$week_num_end_new."-". 6 ."w")),'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array()));
        }else{
            for($i=0;$i<(($week_num_end+1)-$week_num_start);$i++){
                $result[$i] = array(
                    'week' => $val ,
                    'employee'=>array(),
                    'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1) ."-". 0 ."w"))),
                    'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w"))),
                    'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w"))),
                    'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w"))),
                    'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w"))),
                    'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w"))),
                    'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w")))); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
//                $result[$i] = array('week' => $val ,'employee'=>array(),'sun'=>date("d", strtotime($year."-W".$val."-". 0 ."w")),'mon'=>$year."-W".$val."-". 1 ."w",'tue'=>$year."-W".$val."-". 2 ."w",'wed'=>$year."-W".$val."-". 3 ."w",'thu'=>$year."-W".$val."-". 4 ."w",'fri'=>$year."-W".$val."-". 5 ."w",'sat'=>$year."-W".$val."-". 6 ."w"); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            } 
        }
        //$week_num_end = date('W',  strtotime($year."-".$month."-".$days1));
       // echo "<pre>b". print_r($result, 1)."</pre>";
        $val1=0;
        for($i=0;$i<count($data);$i++){
            $week_num = date('W',  strtotime($data[$i]['date']));
            $day = date('w', strtotime($data[$i]['date']));
            $days = date('D', strtotime($data[$i]['date']));
            for($j=0;$j<count($result);$j++){
                $weekly_sum = "0.0";
                if($result[$j]['week'] == $week_num){ 
                    if(count($result[$j]['employee']) == 0){
                        $result[$j]['employee'][0]['name'] = $data[$i]['employee'];
                        $result[$j]['employee'][0]['color'] = $data[$i]['color'];
                        $result[$j]['employee'][0]['sum'] = "0.0";
                        //sun'] = "0.0";
                        //$result[$j]['employee'][0]['sum_
                        //$result[$j]['employee'][0][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
                        $result[$j]['employee'][0][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime( $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'];
                        if($data[$i]['status'] != 2){
                            $result[$j]['employee'][0]['sum'] = $this->time_sum($result[$j]['employee'][0]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                        }
                        $result[$j]['employee'][0]['emp_username'] = $data[$i]['emp_username'];//added for new comp
                        $result[$j]['employee'][0]['customer'] = $data[$i]['customer'];//added for geroge
                    }
                    else{
                        
                        for($k=0;$k<count($result[$j]['employee']);$k++){
                            
                            if($result[$j]['employee'][$k]['emp_username'] == $data[$i]['emp_username']){
                                
//                                if($data[$i]['status'] == 1){
//                                    if($day == 0){
//                                        if($data[$i]['type'] == 0){
                                            //$result[$j]['employee'][$k][$days][count($result[$j]['employee'][$k][$days])] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
                                            $result[$j]['employee'][$k][$days][count($result[$j]['employee'][$k][$days])] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'];
                                            if($data[$i]['status'] != 2){
                                                $result[$j]['employee'][$k]['sum'] = $this->time_sum($result[$j]['employee'][$k]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                                                
                                            }
                                            break;
                            }
                        }
                        
                        if($k == count($result[$j]['employee'])){
                            $result[$j]['employee'][$k]['name'] = $data[$i]['employee'];
                            $result[$j]['employee'][$k]['color'] = $data[$i]['color'];
//                            if($data[$i]['status'] == 1){
//                            if($day == 0){
//                                if($data[$i]['type'] == 0){
                                    //$result[$j]['employee'][$k][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".date('H.i',  strtotime($data[$i]['time_to'])).",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100);
                                    $result[$j]['employee'][$k][$days][0] = date('H.i',  strtotime($data[$i]['time_from']))."-".$data[$i]['time_to'].",".$data[$i]['type'].",".$data[$i]['status'].",".$this->time_user_format( date('H.i',  strtotime($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))),100).",".$data[$i]['fkkn'].",".$data[$i]['customer_last_name'].",".$data[$i]['customer_first_name'];
                                    if($data[$i]['status'] != 2){
                                        $result[$j]['employee'][$k]['sum'] = date('H.i',  strtotime($this->time_sum($result[$j]['employee'][$k]['sum'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']))));
                                    
                                    }//sun'] = $this->time_sum(//sun'], $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']));
                            $result[$j]['employee'][$k]['emp_username'] = $data[$i]['emp_username']; //Added for new comp     
                            $result[$j]['employee'][$k]['customer'] = $data[$i]['customer'];//added for geroge
                        }
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
    
    function employee_timetable_month($emp,$month,$year,$conditions_extra = array()){
        $obj_customer = new customer();
        if($emp == "" || $emp == NULL){
            $customers_list = $obj_customer->customer_list();
            $cust_conditions = array('OR');
            for($i=0;$i<count($customers_list);$i++){
                $cust_conditions[] = 'customer = "'.$customers_list[$i]['username'].'"';
            }
        }
        
        $this->tables = array('timetable');
        $this->fields = array('employee','customer','date','time_from','time_to','type','status');
        if($emp == "" || $emp == NULL){
            $this->conditions = array('AND','month(date) = ?','year(date) = ?',array('OR','status = 1','status = 2','status = 0'),$cust_conditions); 
            $this->condition_values = array($month,$year);
        }
        else{
            $this->conditions = array('AND','month(date) = ?','year(date) = ?','employee = ?',array('OR','status = 1','status = 2','status = 0'));
            $this->condition_values = array($month,$year,$emp);
        }
        if(!empty($conditions_extra))
            $this->conditions[] = $conditions_extra;
//        $this->condition_values = array($month,$year,$emp);
        $this->order_by = array('date','time_from');
        $this->query_generate();        
        $data1 = $this->query_fetch();
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
            for($j=0;$j<count($datas1);$j++){
                if($data1[$i]['customer'] == $datas1[$j]['username']){
                    if($_SESSION['company_sort_by'] == 1)
                        $datas[$i]['customer'] = $datas1[$j]['first_name']." ".$datas1[$j]['last_name'];
                    elseif($_SESSION['company_sort_by'] == 2)
                        $datas[$i]['customer'] = $datas1[$j]['last_name']." ".$datas1[$j]['first_name'];
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
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $week_num_start = date('W',  strtotime($year."-".$month."-01"));
        $val = $week_num_start;
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
        $week_num_end_new = date('W',  strtotime($year."-".$month."-".$days));
        
        if($week_num_end_new == '01'){
           for($i=0;$i<(($week_num_end)-$week_num_start);$i++){
                $result[$i] = array('week' => $val,'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w"))),'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w"))),'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w"))),'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w"))),'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w"))),'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w"))),'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w"))),'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            } 
            $result[$i] = array('week' => $week_num_end_new,'sun'=>array(date("d", strtotime($year+1 ."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w")),date("m", strtotime($year+1 ."-W".sprintf("%02d", $week_num_end_new+1)."-". 0 ."w"))),'mon'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 1 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 1 ."w"))),'tue'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 2 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 2 ."w"))),'wed'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 3 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 3 ."w"))),'thu'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 4 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 4 ."w"))),'fri'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 5 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 5 ."w"))),'sat'=>array(date("d", strtotime($year+1 ."-W".$week_num_end_new."-". 6 ."w")),date("m", strtotime($year+1 ."-W".$week_num_end_new."-". 6 ."w"))),'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array()));
        }else{
            for($i=0;$i<(($week_num_end+1)-$week_num_start);$i++){
                $result[$i] = array('week' => $val,'sun'=>array(date("d", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w")),date("m", strtotime($year."-W".sprintf("%02d", $val+1)."-". 0 ."w"))),'mon'=>array(date("d", strtotime($year."-W".$val."-". 1 ."w")),date("m", strtotime($year."-W".$val."-". 1 ."w"))),'tue'=>array(date("d", strtotime($year."-W".$val."-". 2 ."w")),date("m", strtotime($year."-W".$val."-". 2 ."w"))),'wed'=>array(date("d", strtotime($year."-W".$val."-". 3 ."w")),date("m", strtotime($year."-W".$val."-". 3 ."w"))),'thu'=>array(date("d", strtotime($year."-W".$val."-". 4 ."w")),date("m", strtotime($year."-W".$val."-". 4 ."w"))),'fri'=>array(date("d", strtotime($year."-W".$val."-". 5 ."w")),date("m", strtotime($year."-W".$val."-". 5 ."w"))),'sat'=>array(date("d", strtotime($year."-W".$val."-". 6 ."w")),date("m", strtotime($year."-W".$val."-". 6 ."w"))),'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
                $val++;
                $val = sprintf("%02d", $val);
            }
        }
        //echo "<pre>".print_r($leave_data, 1)."</pre>";
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
                        $result[$j]['data']['sun'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['sun']);
                        $result[$j]['data']['sun'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['sun'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                        
                    }
                  }
                  if($day == 1){
                     if(count($result[$j]['data']['mon']) == 0){
                        $result[$j]['data']['mon'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['mon'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['mon']);
                        $result[$j]['data']['mon'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['mon'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 2){
                     if(count($result[$j]['data']['tue']) == 0){
                        $result[$j]['data']['tue'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['tue'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['tue']);
                        $result[$j]['data']['tue'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['tue'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 3){
                     if(count($result[$j]['data']['wed']) == 0){
                        $result[$j]['data']['wed'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['wed'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['wed']);
                        $result[$j]['data']['wed'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['wed'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 4){
                     if(count($result[$j]['data']['thu']) == 0){
                        $result[$j]['data']['thu'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['thu'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['thu']);
                        $result[$j]['data']['thu'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['thu'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 5){
                     if(count($result[$j]['data']['fri']) == 0){
                        $result[$j]['data']['fri'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['fri'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['fri']);
                        $result[$j]['data']['fri'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['fri'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }
                    }
                  }
                  if($day == 6){
                     if(count($result[$j]['data']['sat']) == 0){
                        $result[$j]['data']['sat'][0]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['sat'][0]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
                        if($datas[$i]['status'] == 1){
                            $result[$j]['data']['sum'] = $this->time_sum($result[$j]['data']['sum'], $this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']));
                            
                        }

                    }
                    else{
                        $count = count($result[$j]['data']['sat']);
                        $result[$j]['data']['sat'][$count]['customer'] = $datas[$i]['customer'];
                        $result[$j]['data']['sat'][$count]['time'] = date('H.i',  strtotime($datas[$i]['time_from']))."-".$datas[$i]['time_to'].",".$datas[$i]['type'].",".$datas[$i]['status'].",".$this->time_user_format(date('H.i',  strtotime($this->time_difference($datas[$i]['time_to'], $datas[$i]['time_from']))),100).",".$datas[$i]['employee_last_name'].",".$datas[$i]['employee_first_name'];
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
        foreach($result as $res){
            foreach($res as $key => $time){
                $result[$i][$key] = $this->time_user_format($time,100);
            }
            $i++;
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
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all customers who have atleast one employee he tooks atleast 1 sick leave(type = 1) on a specified year-month
         * last edited on : 2014-02-15
         */
        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        
        $this->flush();
        switch ($login_user_role) {

            case 1:
            case 6:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust 
                                    FROM `timetable` AS t
                                    JOIN `leave` AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 1)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != ""
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month,$cur_year);
                
                /*$this->tables = array('timetable` as `t', 'customer` as `c');
                $this->fields = array('distinct t.customer as customer_id', 'concat(c.last_name, " ", c.first_name) as cust');
                $this->conditions = array('AND','MONTH(t.date) = ?','YEAR(t.date) =?','t.status = 2', "t.customer != 'NULL'", 't.customer = c.username', 'c.status = 1');
                $this->condition_values = array($cur_month,$cur_year);
                $this->order_by = array('LOWER(c.last_name)');
                $this->query_generate();*/
                $data = $this->query_fetch();
                break;
            case 2:
            case 3:
            case 5:
            case 7:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust 
                                    FROM `timetable` AS t
                                    JOIN `leave` AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
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
                
                /*$this->tables = array('team');
                $this->fields = array('customer');
                $this->conditions = array('employee = ?');
                $this->query_generate();
                $team_query = $this->sql_query;

                $this->tables = array('timetable` as `t', 'customer` as `c');
                $this->fields = array('distinct(t.customer) as customer_id', 'concat(c.last_name, " ", c.first_name) as cust');
                $this->conditions = array('AND','month(t.date) = ?','year(t.date) =?','t.status = 2', array('IN', 'c.username', $team_query), "t.customer != 'NULL'", 't.customer = c.username','c.status = 1');
                $this->condition_values = array($cur_month,$cur_year,$login_user);
                $this->order_by = array('LOWER(c.last_name)');
                $this->query_generate();*/
                $data = $this->query_fetch();
                break;
            case 4:
                $this->sql_query = 'SELECT DISTINCT t.customer as customer_id, concat(c.last_name, " ", c.first_name) as cust 
                                    FROM `timetable` AS t
                                    JOIN `leave` AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                        AND l.time_to >= t.time_to AND l.type = 1)
                                    JOIN `customer` AS c ON (t.customer = c.username AND c.status = 1)
                                    WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer IS NOT NULL AND t.customer != "" AND c.username = ?
                                    ORDER BY LOWER(c.last_name), LOWER(c.first_name)';
                $this->condition_values = array($cur_month, $cur_year, $login_user);
                
                /*$this->tables = array('timetable` as `t', 'customer` as `c');
                $this->fields = array('distinct(t.customer) as customer_id', 'concat(c.last_name, " ", c.first_name) as cust');
                $this->conditions = array('AND','month(t.date) = ?','year(t.date) =?','t.status = 2', "t.customer != 'NULL'", 't.customer = c.username', 'c.username = ?','c.status = 1');
                $this->condition_values = array($cur_month,$cur_year, $login_user);
                $this->order_by = array('LOWER(c.last_name)');
                $this->query_generate();*/
                $data = $this->query_fetch();
                break;
        }
        
        return $data;
        
    }
    
    function employees_leave_under_customer($month,$year,$cust){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: getting all employees who have atleast one sick leave(type = 1) on a specified customer-year-month
         * last edited on : 2014-02-15
         */
        $this->flush();
        $this->sql_query = 'SELECT DISTINCT t.employee as employee_id, CONCAT(e.last_name, " ", e.first_name) as employee 
                            FROM `timetable` AS t
                            JOIN `leave` AS l ON (l.employee like t.employee AND t.date = l.date AND l.time_from <= t.time_from
                                                AND l.time_to >= t.time_to AND l.type = 1)
                            JOIN `employee` AS e ON (e.username = t.employee)
                            WHERE t.status = 2 AND MONTH(t.date) = ? AND YEAR(t.date) = ? AND t.customer = ? 
                            ORDER BY LOWER(e.last_name), LOWER(e.first_name)';
        $this->condition_values = array($month, $year, $cust);
                
        /*$this->tables = array('timetable` as `t', 'employee` as `e');
        $this->fields = array('distinct t.employee as employee_id', 'CONCAT(e.last_name, " ", e.first_name) as employee');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) =?','t.status = 2','t.customer = ?', 'e.username = t.employee');
        $this->condition_values = array($month,$year,$cust);
        $this->query_generate();*/
        $data = $this->query_fetch();
        return (!empty($data) ? $data : FALSE);
    }
    
    function relations_leave_employee($month,$year,$cust,$emp){
        $employee = new employee();
        
        // join with leave table to filter leave from vacation leave
        $this->tables = array('timetable` as `t','leave` as `l');
        $this->fields = array('t.id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 2' ,'t.customer = ?','t.employee = ?',
                    'l.type = 1', 't.employee like l.employee', 't.date = l.date','l.time_from <= t.time_from','l.time_to >= t.time_to');
        $this->condition_values = array($month,$year,$cust,$emp);
        $this->query_generate();
        $time_table_ids = $this->query_fetch(2); 
        $ids = '\'' . implode('\', \'', $time_table_ids) . '\'';
        
        
        $this->tables = array('timetable` as `t','employee` as `e');
        $this->fields = array('t.employee as employee_id','concat(first_name ," ", last_name) as employee','t.customer as customer','t.date as date','t.fkkn as fkkn','t.time_from as time_from','t.time_to as time_to','t.type as type','t.status as status','t.relation_id as relation_id');
        $this->conditions = array('AND','month(t.date) = ?','year(t.date) = ?','t.status = 1',array('IN','t.relation_id',$ids),'t.customer = ?','e.username like t.employee');
        $this->condition_values = array($month,$year,$cust);
        $this->order_by = array('t.date', 't.time_from');
        $this->query_generate();
        $data = $this->query_fetch();
        
        $flg_holiday = 0;
        $inconv = $employee->get_holiday_details($month, $year);
        if(empty ($inconv)){ 
            $this->tables = array('inconvenient_timing');
            $this->fields = array('name','effect_from','effect_to','time_from','time_to','type','days');
            $this->conditions = array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?'));
            $this->condition_values = array($month,$year,$month,$year,$month,$year);
            $this->query_generate();
            $inconv = $this->query_fetch();
        }else{
            $flg_holiday = 1;
        }    
        
        $result = array();
        if($data){
            for($i=0;$i<count($data);$i++){
                $date_day = date('w',$data[$i]['date']);
                $result[$i]['date'] = $data[$i]['date'];
                $result[$i]['time_from'] = $data[$i]['time_from'];
                $result[$i]['time_to'] = $data[$i]['time_to'];
                $result[$i]['type'] = $data[$i]['type'];
                $result[$i]['status'] = $data[$i]['status'];
//                $result[$i]['tot_time'] = $this->time_difference($data[$i]['time_from'], $data[$i]['time_to']);
                $result[$i]['tot_time'] = $this->time_user_format($this->time_difference($data[$i]['time_from'], $data[$i]['time_to']), 100);
                $result[$i]['employee'] = $data[$i]['employee'];
                $result[$i]['employee_id'] = $data[$i]['employee_id'];
                
                for($j=0;$j<count($inconv);$j++){
                    $condition = $employee->check_condition_holiday($data[$i]['time_from'], $data[$i]['time_to'], $inconv[$j]['time_from'], $inconv[$j]['time_to'],$inconv[$j]['days'],$date_day);
                   
                    if($condition == 5){
                        $norm_oncall_type = '';
                        if($result[$i]['type'] == 0 || $result[$i]['type'] == 1 ||$result[$i]['type'] == 2)
                                $norm_oncall_type = "Ord";
                        else if($result[$i]['type'] == 3)
                                $norm_oncall_type = "Jour";
                            
                        if($result[$i]['inconv'] == ""){
                                $result[$i]['inconv'] = $norm_oncall_type;
                        }else{
                            $incl_slot_types = explode(",", $result[$i]['inconv']);
                            if(!in_array($norm_oncall_type,$incl_slot_types))
                                $result[$i]['inconv'] = $result[$i]['inconv'].",".$norm_oncall_type;
                        }
                    }
                    else{
                        if($result[$i]['inconv'] == "")
                            $result[$i]['inconv']= $inconv[$j]['name'];
                        else{
                            $incl_slot_types = explode(",", $result[$i]['inconv']);
                            if(!in_array($inconv[$j]['name'],$incl_slot_types))
                                $result[$i]['inconv']= $result[$i]['inconv'].",".$inconv[$j]['name'];
                        }
                    }
                }
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
            return $tmp_relations;
        }
        else{
            return array();
        }
    }
    
    function get_contact_detail($user){
        $this->tables = array('employee');
        $this->fields = array('mobile','email','username');
        $this->conditions = array('username = ?');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0];
        }
        else{
            return false;
        }
    }
    function add_leave_notification($username,$mail,$mobile){
        $this->tables = array('leave_notification');
        $this->fields = array('employee','email','mobile');
        $this->field_values = array($username,$mail,$mobile);
        $data = $this->query_insert();
        if($data){
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    function update_leave_notification($username,$mail,$mobile){
        $this->tables = array('leave_notification');
        $this->fields = array('email','mobile');
        $this->field_values = array($mail,$mobile);
        $this->conditions =array('employee = ?');
        $this->condition_values = array($username);
        $data = $this->query_update();
        if($data){
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    
    function get_notification_employee($user){
       $this->tables = array('leave_notification');
       $this->fields = array('employee','email','mobile');
       $this->conditions = array('employee = ?');
       $this->condition_values = array($user);
       $this->query_generate();
       $data = $this->query_fetch();
       $result = array('employee' => '','sjuk_mob' => '' , 'sjuk_mail' =>  '','sem_mob' => '', 'sem_mail' => '','vab_mob' => '','vab_mail'=> '','fp_mob' => '','fp_mail'=> '','pmote_mob' => '','pmote_mail'=> '',
           'utbild_mob' => '','utbilled_mail'=> '','ovrigt_mob' => '','ovrigt_mail'=> '','byte_mob' => '','byte_mail'=> '');
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
        $data = $this->query_insert();
        if($data){
            return true;
        }
        else{
            return false;
        }
    }
    
    function update_employee_previlege($user,$swap,$process){
        $this->tables = array('privileges');
        $this->fields = array('swap','process');
        $this->field_values = array($swap,$process);
        $this->conditions =  array('employee = ?');
        $this->condition_values = array($user);
        $data = $this->query_update();
        if($data){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function get_employee_previlege($user){
        $this->tables = array('privileges');
        $this->fields = array('employee','swap','process');
        $this->conditions =  array('employee = ?');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0];
        }
        else{
            return 1;
        }
    }
    
    function employee_mailabe_group($user){
        if($_SESSION['user_role'] == 1){
            $result = array();
            $condition = array('AND');
            $this->tables = array('team','customer');
            $this->fields = array('distinct(team.customer)','customer.first_name','customer.last_name','customer.username');
            $this->conditions = array('team.customer = customer.username');
            $this->query_generate();
            $data = $this->query_fetch();
            for($i=0;$i<count($data);$i++){
                $this->tables = array('team','employee');
                $this->fields = array('team.employee','team.role','employee.username','employee.first_name','employee.last_name','employee.email');
                $this->conditions = array('AND','team.customer = ?','team.employee = employee.username');
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
            if($result){
                return $result;
            }else{
                return false;
            }                        
        }
        else{
            $result = array();
            $this->tables = array('team','customer');
            $this->fields = array('distinct(team.customer)','customer.first_name','customer.last_name','customer.username');
            $this->conditions = array('AND','team.customer = customer.username','team.employee = ?');
            $this->condition_values = array($user);
            $this->query_generate();
            $data = $this->query_fetch();
            for($i=0;$i<count($data);$i++){
                $this->tables = array('team','employee');
                $this->fields = array('team.employee','team.role','employee.username','employee.first_name','employee.last_name','employee.email');
                $this->conditions = array('AND','team.customer = ?','team.employee = employee.username');
                $this->condition_values = array($data[$i]['customer']);
                $this->order_by = array('team.customer','team.role ASC');
                $this->query_generate();
                $data1 = $this->query_fetch();               
                $result[] = array('customer_name' => $data[$i]['first_name']." ".$data[$i]['last_name'],'customer_username' => $data[$i]['username'], 'employees_customer' => $data1);
            }
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }
    
    function employee_mailable($user){
//        echo $_SESSION['user_role'];
        if($_SESSION['user_role'] == 1){
//            echo "hai";
            $this->tables = array('employee');
            $this->fields =array('username','first_name','last_name','email');
            $this->conditions = array('status = 1');
            if($_SESSION['company_sort_by'] == 1)
                $this->order_by = array('LOWER(first_name) collate utf8_bin');
            elseif($_SESSION['company_sort_by'] == 2)
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
            $this->query_generate();
//            echo $this->sql_query;
            $data2 = $this->query_fetch();
            if($data2){
                return $data2;
            }
            else{
                return array();
            }
        }
        else{
            $this->tables = array('team');
            $this->fields =array('customer');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($user);
            $this->query_generate();
            $data = $this->query_fetch();
            //print_r($data);
            $result = array('OR');
            for($i=0;$i<count($data);$i++){
                $result[] = 'customer = "'.$data[$i]['customer'].'"';
            }
            $this->tables = array('team');
            $this->fields =array('distinct(employee) as emp');
            $this->conditions = $result;
            //$this->condition_values = array($user);
            $this->query_generate();
            $data1 = $this->query_fetch(1);
            $result1 = array('OR');
            for($i=0;$i<count($data1);$i++){
                $result1[] = 'username = "'.$data1[$i]['emp'].'"';
            }
            $this->tables = array('employee');
            $this->fields =array('username','first_name','last_name','email');
            $this->conditions = $result1;
            if($_SESSION['company_sort_by'] == 1)
                $this->order_by = array('LOWER(first_name) collate utf8_bin');
            elseif($_SESSION['company_sort_by'] == 2)
                $this->order_by = array('LOWER(last_name) collate utf8_bin');
            $this->query_generate();
            $data2 = $this->query_fetch();
            if($data2){
                return $data2;
            }
            else{
                return array();
            }
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
            'customer.social_security'
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
        $result = array('AND');
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
    
    function generate_pdf_customer_week_month_report($r_customer,$r_year,$r_month,$method,$condition_array) {
        require_once ('plugins/customize_pdf_customer_week_report.class.php');
        require_once ('class/customer.php');
        $cust_obj = new customer();
       
        if($method == 1){
            $pdf = new PDF_Customer_week_report("P");
        }else if($method == 2){
            $pdf = new PDF_Customer_week_report("L");
        }
        $pdf->report_customer = $r_customer;
        $pdf->report_month = $r_month;
        $pdf->report_year = $r_year;
        
        $cust_details = $cust_obj->customer_detail($r_customer);
        $timetable = $this->customer_timetable_month($r_customer,$r_month,$r_year,$_SESSION['user_id'],$_SESSION['user_role'],$condition_array);
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
            //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            /*$a2 = 0;
             for($j=0;$j<count($timetable[$i]['employee']);$j++){
                
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Mon']);$k++){
                    $result[$a1]['data']['mon'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['mon'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['mon'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['mon'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['mon'][$a2]['time'] = $timetable[$i]['employee'][$j]['Mon'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Mon'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['mon'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['mon'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }
            $a2 = 0;
            for($j=0;$j<count($timetable[$i]['employee']);$j++){
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Tue']);$k++){
                    $result[$a1]['data']['tue'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['tue'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['tue'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['tue'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['tue'][$a2]['time'] = $timetable[$i]['employee'][$j]['Tue'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Tue'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['tue'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['tue'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }
            $a2 = 0;
            for($j=0;$j<count($timetable[$i]['employee']);$j++){
                
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Wed']);$k++){
                    $result[$a1]['data']['wed'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['wed'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['wed'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['wed'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['wed'][$a2]['time'] = $timetable[$i]['employee'][$j]['Wed'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Wed'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['wed'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['wed'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }
            $a2 = 0;
            for($j=0;$j<count($timetable[$i]['employee']);$j++){
                
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Thu']);$k++){
                    $result[$a1]['data']['thu'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['thu'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['thu'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['thu'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['thu'][$a2]['time'] = $timetable[$i]['employee'][$j]['Thu'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Thu'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['thu'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['thu'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }
            $a2 = 0;
            for($j=0;$j<count($timetable[$i]['employee']);$j++){
                
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Fri']);$k++){
                    $result[$a1]['data']['fri'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['fri'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['fri'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['fri'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['fri'][$a2]['time'] = $timetable[$i]['employee'][$j]['Fri'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Fri'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['fri'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['fri'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }
            $a2 = 0;
            for($j=0;$j<count($timetable[$i]['employee']);$j++){
                
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Sat']);$k++){
                    $result[$a1]['data']['sat'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['sat'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['sat'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['sat'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['sat'][$a2]['time'] = $timetable[$i]['employee'][$j]['Sat'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Sat'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['sat'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['sat'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }
             $a2 = 0;
            for($j=0;$j<count($timetable[$i]['employee']);$j++){
               
                for($k=0;$k<count($timetable[$i]['employee'][$j]['Sun']);$k++){
                    $result[$a1]['data']['sun'][$a2]['empl'] = $timetable[$i]['employee'][$j]['name'];
                    $hex = str_replace("#", "", $timetable[$i]['employee'][$j]['color']);
                    $result[$a1]['data']['sun'][$a2]['r'] = hexdec(substr($hex,0,2));
                    $result[$a1]['data']['sun'][$a2]['g'] = hexdec(substr($hex,2,2));
                    $result[$a1]['data']['sun'][$a2]['b'] = hexdec(substr($hex,4,2));
                    $result[$a1]['data']['sun'][$a2]['time'] = $timetable[$i]['employee'][$j]['Sun'][$k];
                    //-----------------
                    $slot_values = explode(',', $timetable[$i]['employee'][$j]['Sun'][$k]);
                    $time_ranges = explode('-', $slot_values[0]);
                    $result[$a1]['data']['sun'][$a2]['time_from'] = trim($time_ranges[0]);
                    $result[$a1]['data']['sun'][$a2]['time_to'] = trim($time_ranges[1]);
                    $a2++;
                }
            }*/
//             $result[$a1]['data'] = $data;
             $a1++;
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
//        echo "<pre>".print_r($result, 1)."</pre>";
        if($method == 1){
            $pdf->rpt_contents = $result;
            $pdf->rpt_sum = $sums;
            $pdf->AddPage();        //page1
            $pdf->P1_Part1($cust_details);
//        $pdf->P1_Part2_Landscape();
            if($cust_details)
                $pdf->P1_Part2_New($r_year,$r_month);
            else
               $pdf->P1_Part2_New($r_year,$r_month,1); 
        }else if($method == 2){
            $pdf->rpt_contents = $timetable;
            $pdf->rpt_sum = $sums;
            $pdf->AddPage();        //page1
            $pdf->P1_Part1_L($cust_details);
            if($cust_details)
                $pdf->P1_Part2_Landscape();
            else
               $pdf->P1_Part2_Landscape(1); 
//            $pdf->P1_Part2_New($r_year,$r_month);
        }
//        $pdf->rpt_contents = $result;
//        $pdf->rpt_sum = $sums;
//        //$obj_emp= new employee();
//        ///////////////////////////////////////////page 1/////////////////////////////////////////////////  
//        $pdf->AddPage();        //page1
//        $pdf->P1_Part1($cust_details);
////        $pdf->P1_Part2_Landscape();
//        $pdf->P1_Part2_New($r_year,$r_month);
        
        $pdf->Output();
    }

    function generate_pdf_employee_week_month_report($r_employee,$r_year,$r_month,$print_method,$condition) {
        //$app_dir = getcwd();
        //echo $app_dir;
        require_once ('plugins/customize_pdf_employee_week_report.class.php');
        require_once ('class/employee.php');
        require_once ('plugins/MPDF54/mpdf.php');
        
        
//        $customer = new customer();
        $employee = new employee();
       
        if($print_method == 1){
            $pdf = new PDF_Employee_week_report("P");
        }else{
           $pdf = new PDF_Employee_week_report("L"); 
        }
        $pdf->report_customer = $r_employee;
        $pdf->report_month = $r_month;
        $pdf->report_year = $r_year;
        
        $emp_details = $employee->get_employee_detail($r_employee);
        $timetable = $this->employee_timetable_month($r_employee,$r_month,$r_year,$condition);
        $sums = $this->employee_week_time_sum($timetable);
        $pdf->rpt_contents = $timetable;
        $pdf->rpt_sum = $sums;
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////  
        $pdf->AddPage();        //page1
//        $pdf->P1_Part1($emp_details);
//        echo "<pre>". print_r($emp_details, 1)."</pre>";
        $emp_flag = 0;
        if($emp_details['username'] == '')
            $emp_flag = 1;
        if($print_method == 1){
            $pdf->P1_Part1_P($emp_details);
            $pdf->report_part($r_year,$r_month,$emp_flag);
            
        }elseif($print_method == 2){
            $pdf->P1_Part1($emp_details);
            $pdf->P1_Part2($emp_flag);
        }
        $pdf->Output();
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
            
            $dt = $this->query_insert();
            
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
    
    function get_timetable_to_add_calender($emp,$month,$year){
        $this->tables = array('timetable');
        $this->fields = array('id','employee','customer','date','time_from','time_to','type','status','google_id');
        $this->conditions = array('AND','month(date) = ?','year(date) = ?','employee = ?','status = 1');
        $this->condition_values = array($month,$year,$emp);
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
    
    
    function get_all_document_archive(){
        $this->tables = array('document_archive` AS `da','employee` AS `e');
        $this->fields = array('da.id','da.employee','da.file_name','da.status','da.date','e.first_name','e.last_name');
        $this->conditions = array('da.employee = e.username');
        $this->order_by = array('da.date DESC');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function document_archive_add(){
        $this->tables = array('document_archive');
        $this->fields = array('employee','file_name','status');
        $this->field_values = array($this->employee,$this->filename,$this->status);
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
    
}

?>
