<?php
/**
 * Description of root_operation
 * @author Shamsudheen
 */
require_once('configs/config.inc.php');
require_once('class/db.php');

class root_operation extends db {

    var $boundary_date = '';

    function __construct() {

        parent::__construct();
    }
    
    function change_customer_user_name($old_uname, $new_uname){
        
        return FALSE; 
        
        $transaction_flag = TRUE;
        $process_error_details = array();
        
        //Customer
        $this->flush();
        $this->tables = array('customer');
        $this->fields = array('username');
        $this->field_values = array($new_uname);
        $this->conditions = array('username = ?');
        $this->condition_values = array($old_uname);
        $transaction_flag = $this->query_update();
        if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        
        //ATL Warning
        if($transaction_flag){
            $this->flush();
            $this->tables = array('atl_warnings');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Customer Appoiments
        if($transaction_flag){
            $this->flush();
            $this->tables = array('customer_appoiments');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Exports Lon
        if($transaction_flag){
            $this->flush();
            $this->sql_query = 'UPDATE exports_lon SET `customers` = REPLACE( `customers` , "'.$old_uname.'", "'.$new_uname.'" ) ';
            $this->query_fetch();
        }
        
        //Fkkn Form Defaults
        if($transaction_flag){
            $this->flush();
            $this->tables = array('fkkn_form_defaults');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //General Customer Employee Settings
        if($transaction_flag){
            $this->flush();
            $this->tables = array('general_customer_employee_settings');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Inconvenient Timing Customer
        if($transaction_flag){
            $this->flush();
            $this->tables = array('inconvenient_timing_customer');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Memory Slots
        if($transaction_flag){
            $this->flush();
            $this->tables = array('memory_slots');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Privileges
        if($transaction_flag){
            $this->flush();
            $this->tables = array('privileges');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Schedule Copy
        if($transaction_flag){
            $this->flush();
            $this->tables = array('schedule_copy');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Schedule Template
        if($transaction_flag){
            $this->flush();
            $this->tables = array('schedule_template');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Signing Employer
        if($transaction_flag){
            $this->flush();
            $this->tables = array('signing_employer');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //Timetable
        if($transaction_flag){
            $this->flush();
            $this->tables = array('timetable');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        //User Task
        if($transaction_flag){
            $this->flush();
            $this->tables = array('user_task');
            $this->fields = array('customer');
            $this->field_values = array($new_uname);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($old_uname);
            $transaction_flag = $this->query_update();
            if(!$transaction_flag) $process_error_details =  $this->query_error_details;
        }
        
        if($transaction_flag)
            echo "Customer username successfully changed ($old_uname => $new_uname)";
        else{
            echo "Error in customer username changing..!<br/>";
            echo "Error details: <br/>";
            echo "<pre>".print_r($process_error_details, 1)."</pre>";
        } 
    }
    
    function create_secondary_dummy_logins(){
        
        return FALSE;
        
        $this->flush();
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username', 'password', 'error', 'last_time', 'date', 'company_ids');
        $this->query_generate();
        $login_datas = $this->query_fetch();
        
        $this->flush();
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id');
        $this->query_generate();
        $available_company_ids = $this->query_fetch(2);
       // echo "<pre>".print_r($available_company_ids, 1)."</pre>";
        
       // echo "<pre>".print_r($login_datas, 1)."</pre>";
        $transaction_flag = TRUE;
        $inserted_data_set = array();
        
        if(!empty($login_datas)){
            foreach($login_datas as $key => $ldata){
                $this_company_ids = array_filter(explode(',', $ldata['company_ids']));  //remove NULL, 0 , '' values
                $this_company_ids = array_intersect($this_company_ids, $available_company_ids); //filter only available companies 
               // echo "<pre>".print_r($this_company_ids, 1)."</pre>----------";
                if(!empty($this_company_ids)){
                    
                    $data_set = array();
                    foreach($this_company_ids as $cid){
                        $data_set[] = array($ldata['username'], $ldata['password'], $cid, $ldata['last_time'], $ldata['date'], $ldata['error']);
                    }
                    $this->flush();
                    $this->hash = $preference['hash'];
                    $this->tables = array($this->db_master . '.secondary_login');
                    $this->fields = array('username', 'password', 'company_id', 'last_login_time', 'last_pw_update_date', 'error');
                    $this->field_values = $data_set;
                    $transaction_flag =  $this->query_insert();
                    
                    if($transaction_flag){
                        $inserted_data_set = array_merge($inserted_data_set, $data_set);
                    }
                }
               // echo "<pre>".print_r($this_company_ids, 1)."</pre>";
                
                if(!$transaction_flag) {
                    echo "Error: <pre>".print_r($this->query_error_details, 1)."</pre>";
                    break;
                }
               // if($key == 10) break;
            }
        }
        
        echo "Inserted Data set: <pre>".print_r($inserted_data_set, 1)."</pre>";
    }
    
    function create_new_employees($emp_datas) {

        return FALSE;
        
        global $preference;
        $new_company_id = 11;   //Akilles Personlig Assistans AB
       // $new_company_name = 't2v_cirrus';
        $new_company_name = 'time2vie_cirrus11'; //Akilles Personlig Assistans AB
        $this->hash = $preference['hash'];
        $default_pword = md5($this->hash . '12345678');


        $data_set_for_login = $data_set_for_seclogin = $data_set_for_emp_tbl = array();
        foreach ($emp_datas as $edata) {
            // $data_set_for_login[] = array($edata['Username'], $default_pword, $edata['SSN'], $edata['Mobile_modified'], 3, date('Y-m-d H:i:s'), 0, 0, date('Y-m-d'), "$new_company_id,");
            // $data_set_for_seclogin[] = array($edata['Username'], $default_pword, $new_company_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 0);
            // $data_set_for_emp_tbl[] = array($edata['Username'], 19, $edata['Code'], $edata['SSN'], $edata['FirstName'], $edata['LastName'],
            //     $edata['Gender'], $edata['Mobile_modified'], $edata['Email'], date('Y-m-d'), '#FFFFFF', 1, 0, 0, 0, 0,
            //     1, 0, 0, 1, 0, 0, 0,
            //     0, 0, 1);
            $data_set_for_login[] = array($edata['Username'], $default_pword, $edata['SSN'], 3, date('Y-m-d H:i:s'), 0, 0, date('Y-m-d'), "$new_company_id,");
            $data_set_for_seclogin[] = array($edata['Username'], $default_pword, $new_company_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 0);
            $data_set_for_emp_tbl[] = array($edata['Username'], 19, $edata['Code'], $edata['SSN'], $edata['FirstName'], $edata['LastName'],
                $edata['Gender'], $edata['Adress'], $edata['POST'], $edata['City'], date('Y-m-d'), '#FFFFFF', 1, 0, 0, 0, 0,
                1, 0, 0, 1, 0, 0, 0,
                0, 0, 1);
        }

        $transaction_flag = TRUE;

        //create login_table entry
        $this->flush();
        $this->tables = array($this->db_master . '.login');
        // $this->fields = array('username', 'password', 'social_security', 'mobile', 'role', 'last_time', 'error', 'login', 'date', 'company_ids');
        $this->fields = array('username', 'password', 'social_security', 'role', 'last_time', 'error', 'login', 'date', 'company_ids');
        $this->field_values = $data_set_for_login;
        $transaction_flag = $this->query_insert();

        if ($transaction_flag) {
            //create secondary login table entry
            $this->flush();
            $this->tables = array($this->db_master . '.secondary_login');
            $this->fields = array('username', 'password', 'company_id', 'last_login_time', 'last_pw_update_date', 'error');
            $this->field_values = $data_set_for_seclogin;
            $transaction_flag = $this->query_insert();
        }
        
        if ($transaction_flag) {
            $this->select_db($new_company_name);
            //create employee table entry
            $this->flush();
            $this->tables = array('employee');
            // $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name',
            //     'gender', 'mobile', 'email', 'date', 'color', 'status', 'prv_swap', 'monthly_salary', 'sem_leave', 'leave_in_advance',
            //     'inconvenient_on', 'office_personal', 'substitute', 'salary_type', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days',
            //     'nopay_leave_days', 'other_leave_days', 'is_genuine');
            $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name',
                'gender', 'address', 'post', 'city', 'date', 'color', 'status', 'prv_swap', 'monthly_salary', 'sem_leave', 'leave_in_advance',
                'inconvenient_on', 'office_personal', 'substitute', 'salary_type', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days',
                'nopay_leave_days', 'other_leave_days', 'is_genuine');
            $this->field_values = $data_set_for_emp_tbl;
            $transaction_flag = $this->query_insert();
            
        }
        if(!$transaction_flag){
            echo "query_error_details: <pre>".print_r($this->query_error_details, 1)."</pre>";
        }
        
        echo "data_set_for_login : <pre>".print_r($data_set_for_login, 1)."</pre>";
        echo '<br/><br/>*************************************************************************************<br/><br/>';
        echo "data_set_for_seclogin: <pre>".print_r($data_set_for_seclogin, 1)."</pre>";
        echo '<br/><br/>*************************************************************************************<br/><br/>';
        echo "data_set_for_emp_tbl: <pre>".print_r($data_set_for_emp_tbl, 1)."</pre>";
        echo '<br/><br/>*************************************************************************************<br/><br/>';
        return $transaction_flag;
    }
    
    function create_new_fake_employees($emp_datas, $company_id, $company_db) {

        if(empty($emp_datas) || $company_id == '' || $company_db == '')
            return FALSE;
        
        global $preference;
        $new_company_id = $company_id; //10;
       // $new_company_name = 't2v_cirrus';
        $new_company_name = $company_db; //'time2vie_cirrus10';
        $new_role = 2;  //TL
        $this->hash = $preference['hash'];
        $default_pword = md5($this->hash . '12345678');


        $data_set_for_login = $data_set_for_seclogin = $data_set_for_emp_tbl = array();
        foreach ($emp_datas as $edata) {
            $data_set_for_login[] = array($edata['username'], $default_pword, $edata['social_security'], /*$edata['mobile_modified'],*/ $new_role, date('Y-m-d H:i:s'), 0, 0, date('Y-m-d'), "$new_company_id,");
            $data_set_for_seclogin[] = array($edata['username'], $default_pword, $new_company_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 0);
            $data_set_for_emp_tbl[] = array($edata['username'], $edata['century'], $edata['code'], $edata['social_security'], $edata['first_name'], $edata['last_name'],
                $edata['gender'], $edata['address'], $edata['city'], $edata['post'], $edata['phone'], $edata['mobile_modified'], $edata['email'], $edata['date'], '#FFFFFF', $edata['status'], 0);
        }

        // echo "data_set_for_login<pre>".print_r($data_set_for_login, 1)."<pre>";
        // echo "data_set_for_seclogin<pre>".print_r($data_set_for_seclogin, 1)."<pre>";
        // echo "data_set_for_emp_tbl<pre>".print_r($data_set_for_emp_tbl, 1)."<pre>";
        
        // return FALSE;
        // exit();

        $transaction_flag = TRUE;

        //create login_table entry
        $this->flush();
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username', 'password', 'social_security', 'role', 'last_time', 'error', 'login', 'date', 'company_ids');
        $this->field_values = $data_set_for_login;
        $transaction_flag = $this->query_insert();
        if ($transaction_flag) {
            //create secondary login table entry
            $this->flush();
            $this->tables = array($this->db_master . '.secondary_login');
            $this->fields = array('username', 'password', 'company_id', 'last_login_time', 'last_pw_update_date', 'error');
            $this->field_values = $data_set_for_seclogin;
            $transaction_flag = $this->query_insert();
        }
        
        if ($transaction_flag) {
            $this->select_db($new_company_name);
            //create employee table entry
            $this->flush();
            $this->tables = array('employee');
            $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name',
                'gender', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status', 'is_genuine');
            $this->field_values = $data_set_for_emp_tbl;
            $transaction_flag = $this->query_insert();
            
        }
        // if(!$transaction_flag){
        //     echo "query_error_details: <pre>".print_r($this->query_error_details, 1)."</pre>";
        // }
        
        // echo "data_set_for_login : <pre>".print_r($data_set_for_login, 1)."</pre>";
        // echo '<br/><br/>*************************************************************************************<br/><br/>';
        // echo "data_set_for_seclogin: <pre>".print_r($data_set_for_seclogin, 1)."</pre>";
        // echo '<br/><br/>*************************************************************************************<br/><br/>';
        // echo "data_set_for_emp_tbl: <pre>".print_r($data_set_for_emp_tbl, 1)."</pre>";
        // echo '<br/><br/>*************************************************************************************<br/><br/>';
        return $transaction_flag;
    }

    function check_table_exists($table_name){
        $this->sql_query = "show tables like '".$table_name."' ";
        return $this->query_fetch();
    }

    function move_data($org_table, $backup_table){
        $flag = FALSE;
        $check_org_table    = $this->check_table_exists($org_table);
        $check_backup_table = $this->check_table_exists($backup_table);

        if(!empty($check_org_table) && !empty($check_backup_table)){
            $flag = $this->insert_data_to_backup_table($org_table, $backup_table);
            if($flag){
                $this->flush();
                $this->sql_query = "DELETE FROM `$org_table` WHERE `date`<= '".$this->boundary_date."'";
                $this->query_fetch();
                $flag = empty($this->query_error_details) ? TRUE : FALSE;
            }
        }
        return $flag;
    }

    function backup_data(){
        $flag = TRUE;
        $flag = $this->move_data('timetable','backup_timetable'); // moving  data to backup_tables.
        if($flag)
            $flag = $this->move_data('leave','backup_leave');
        if($flag)
            $flag = $this->move_data('report_signing','backup_report_signing');

        return $flag;
    }

    function insert_data_to_backup_table($org_table, $backup_table){
        $this->flush();
        $this->sql_query = "INSERT INTO `$backup_table` SELECT * FROM `$org_table` WHERE `date`<= '".$this->boundary_date."'";
        $this->query_fetch();
        return empty($this->query_error_details) ? TRUE : FALSE;
    }

    function employee_list($db_name) {
        // $this->select_db($db_name);
        $this->flush();
        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name', 'prv_swap');
        $this->conditions = array('status = ?');
        $this->condition_values = array(1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return !empty($datas) ? $datas : FALSE;
    }

    function new_reminaing_semleave_add_employee_table($db_name, $employee, $rem_sem_leave){
        // $this->select_db($db_name);
        $this->flush();
        $this->tables           = array('employee');
        $this->fields           = array('remaining_sem_leave','sem_leave_todate');
        $this->field_values     = array($rem_sem_leave, $this->boundary_date);
        $this->conditions       = array('username = ?');
        $this->condition_values = array($employee);
        return $this->query_update();
    }

    function copy_details_to_backup_column(){
        $this->flush();
        $this->sql_query = "UPDATE `employee` SET `remaining_sem_leave_backup`= `remaining_sem_leave`, `sem_leave_todate_backup`= `sem_leave_todate` WHERE `remaining_sem_leave_backup` IS NULL OR `remaining_sem_leave_backup` = '' OR `sem_leave_todate_backup` IS NULL OR `sem_leave_todate_backup` = '' ";
        $this->query_fetch();
        return empty($this->query_error_details) ? TRUE : FALSE;
    }
}
?>