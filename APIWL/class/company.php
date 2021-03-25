<?php
/**
 * Description of company
 * @author dona
 */
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once ('class/db.php');
require_once ('plugins/customize_pdf_billing.php');

class company extends db {

    var $name = '';
    var $db_name = '';
    var $language = '';
    var $logo = '';
    var $org_no = '';
    var $address = '';
    var $box = NULL;
    var $city = '';
    var $zipcode = '';
    var $email = '';
    var $phone = '';
    var $mobile = '';
    var $website = '';
    var $first_name = '';
    var $last_name = '';
    var $post = '';
    var $contact_person1 = '';
    var $contact_person1_firstname = '';
    var $contact_person1_lastname = '';
    var $contact_person1_usernmae = '';
    var $contact_person1_role = '';
    var $contact_person1_email = '';
    var $contact_person2 = '';
    var $contact_person2_firstname = '';
    var $contact_person2_lastname = '';
    var $contact_person2_usernmae = '';
    var $contact_person2_role = '';
    var $contact_person2_email = '';
    var $upload_dir = '';
    var $status = 1;
    var $username = "";
    var $password = "";
    var $role = "";
    var $company_id= "";
    var $social_security= "";
    var $land_code= "";
    var $price= NULL;
    var $salary_system= "";
    var $price_per_sms= NULL;
    var $price_per_sign= '';
    var $bill_status= "";
    var $start_day= "";
    var $weekly_hour= "";
    var $max_daily_hour= "";
    var $min_daily_rest= "";
    var $montly_oncall_hour= NULL;
    var $check_atl= 1;
    var $check_contract= 1;
    var $signing_mail= 1;
    var $bank_account= NULL;
    var $fk_kr_per_time= NULL;
    var $kn_kr_per_time= NULL;
    var $contract_from= '';
    var $contract_to= '';
    var $username1= '';
    var $username2= '';
    var $leave_in_advance= '';
    var $sem_year_start_month= '';
    var $use_inconvenient = NULL;
    var $candg_on = '';
    var $candg = '';
    var $candg_break = '';
    var $apply_max_karens = '';
    var $day_light_saving = '';
    var $sick_15_90_oncall = '';
    var $employee_contract_start_month = NULL;
    var $employee_contract_month_start_date = NULL;
    var $employee_contract_period_length = NULL;
    var $sort_name_by = '';
    var $vacation_percentage = '';
    var $vacation_percentage_slots = NULL;
    var $sem_leave_days = 0;
    var $vab_leave_days = 0;
    var $fp_leave_days = 0;
    var $nopay_leave_days = 0;
    var $other_leave_days = 0;
    var $include_sick = 0;
    var $sick_annex_calculation_mode = 2;
    var $contract_auto_renewal = 0;
    var $contract_auto_renewal_mail = NULL;
    var $include_karense_salary = 0;
    var $include_sem_2_14_oncall_salary = 1;
    var $fkkn_split = 0;
    var $sms_pw_recovery = 0;
    var $contact_mail_send  = 0;
    var $kfo  = 0;
    var $karens_full = 0;

    function __construct() {

        parent::__construct();
    }
    
    function company_list(){
        $val = 1;
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'language', 'logo', 'org_no', 'address', 'city', 'zipcode','email','land_code', 'phone', 'mobile', 'website', 'contact_person1', 'contact_person1_email', 'contact_person2', 'contact_person2_email', 'upload_dir', 'created_date', 'status','price_per_customer', 'price_per_sms', 'price_per_sign', 'salary_system','billing_status', 'start_day', 'weekly_hour', 'monthly_oncall_hour', 'max_daily_hour', 'contract_exceed_check', 'atl_check', 'signing_mail', 'candg_break', 'contract_auto_renewal', 'contract_auto_renewal_mail', 'sort_name_by', 'day_light_saving','sem_year_start_month','leave_in_advance','include_sick', 'min_daily_rest', 'kfo', 'karens_full');
        $this->conditions = array('status = 1');
        $this->order_by = array('name');
        $this->query_generate();
        $companies = $this->query_fetch();
        
        if(!empty($companies)){
            foreach($companies as $key => $cmp){
                $companies[$key]['price_per_customer'] = $companies[$key]['price_per_sms'] = $companies[$key]['price_per_sign'] =  0;
                $company_contract_details = $this->get_company_current_contract_in_date($cmp['id']);
                if(!empty($company_contract_details)){
                    $companies[$key]['price_per_customer'] = $company_contract_details['price_per_customer'];
                    $companies[$key]['price_per_sms'] = $company_contract_details['price_per_sms'];
                    $companies[$key]['price_per_sign'] = $company_contract_details['price_per_sign'];
                }
            }
        }
        
//        echo "<pre>".print_r($companies, 1)."</pre>"; exit();
        return $companies;
    }
    function get_support_info($id){
        $this->tables = array($this->db_master .'.company');
        $this->fields = array('id','phone','email','suport_hours');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function set_support_info($id,$request){
        $this->tables = array($this->db_master.'.company');
        $this->fields = array('phone','email','suport_hours');
        $this->field_values = array($_REQUEST['phone'],$_REQUEST['email'],$_REQUEST['support_hours']);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }
    /*function company_add() {

        if ($this->name != '' && $this->language = '') {
            
            //setting dbname
            $this->company_db_name_generate();
            //setting upload folder name
            $this->company_upload_dir_generate();

            //
            $this->tables = array($this->db_master . '.company');
            $this->fields = array('name', 'db_name', 'language', 'logo', 'org_no', 'address', 'city', 'email', 'phone', 'mobile', 'website', 'contact_person1', 'contact_person1_email', 'contact_person2', 'contact_person2_email', 'upload_dir', 'status');
            $this->field_values = array($this->name, $this->db_name, $this->language, $this->logo, $this->org_no, $this->address, $this->city, $this->email, $this->phone, $this->mobile, $this->website, $this->contact_person1, $this->contact_person1_email, $this->contact_person2, $this->contact_person2_email, $this->upload_dir, $this->status);
            return $this->query_insert();
        } else {

            return FALSE;
        }
    }*/
    
    function company_update($id,$mode = NULL) {
        if ($this->name != '') {
            $this->tables = array($this->db_master .'.company');
            if($mode == NULL){
                //'price_per_customer','price_per_sms'
//                $this->price,$this->price_per_sms
                $this->fields = array('name','logo','org_no','address','city','email','land_code','phone','mobile','website','upload_dir','status',
                    'salary_system','zipcode','billing_status','start_day',
                    'username1','username2','contact_person1', 'contact_person1_email', 'contact_person2', 'contact_person2_email', 'box', 'contract_auto_renewal', 'contract_auto_renewal_mail');
                $this->field_values = array($this->name,$this->logo,$this->org_no,$this->address,$this->city,$this->email,$this->land_code,$this->phone,$this->mobile,$this->website,$this->upload_dir,'1',
                    $this->salary_system,$this->zipcode,$this->bill_status,$this->company_start_day,
                    $this->username1,$this->username2,$this->contact_person1,$this->contact_person1_email,$this->contact_person2,$this->contact_person2_email, $this->box, $this->contract_auto_renewal, $this->contract_auto_renewal_mail);
            }else{
                //'price_per_customer','price_per_sms'
//                $this->price,$this->price_per_sms
                $this->fields = array('name','logo','org_no','address','city','email','land_code','phone','mobile','website','upload_dir','status',
                    'salary_system','zipcode','billing_status','start_day',
                    'contact_person1','contact_person2','contact_person1_email','contact_person2_email','weekly_hour','max_daily_hour', 'monthly_oncall_hour', 'contract_exceed_check', 'atl_check', 'signing_mail', 
                    'bank_account', 'fk_kr_per_time', 'kn_kr_per_time','leave_in_advance','sem_year_start_month', 'box', 'inconvenient_on','candg', 'candg_on', 'candg_break','apply_max_karens', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length','sort_name_by', 
                    'vacation_percentage', 'vacation_percentage_slots', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days', 'include_sick', 'contract_auto_renewal', 'contract_auto_renewal_mail',
                    'include_karense_salary', 'include_sem_2_14_oncall_salary', 'fkkn_split', 'day_light_saving', 'sick_15_90_oncall', 'sick_annex_calculation_mode', 'recovery_pw_by_mobile', 'mail_send_to_contact_person', 'min_daily_rest', 'kfo', 'karens_full');
                $this->field_values = array($this->name,$this->logo,$this->org_no,$this->address,$this->city,$this->email,$this->land_code,$this->phone,$this->mobile,$this->website,$this->upload_dir,'1',
                    $this->salary_system,$this->zipcode,$this->bill_status,$this->company_start_day,
                    $this->contact_person1,$this->contact_person2,$this->contact_person1_email,$this->contact_person2_email,$this->weekly_hour,$this->max_daily_hour, $this->montly_oncall_hour, $this->check_contract, $this->check_atl, $this->signing_mail, 
                    $this->bank_account, $this->fk_kr_per_time, $this->kn_kr_per_time,$this->leave_in_advance,$this->sem_year_start_month, $this->box, $this->use_inconvenient,$this->candg,$this->candg_on,$this->candg_break,$this->apply_max_karens, $this->employee_contract_start_month, $this->employee_contract_month_start_date, $this->employee_contract_period_length, $this->sort_name_by, $this->vacation_percentage, $this->vacation_percentage_slots, $this->sem_leave_days, $this->vab_leave_days, $this->fp_leave_days, $this->nopay_leave_days, $this->other_leave_days, $this->include_sick, $this->contract_auto_renewal, $this->contract_auto_renewal_mail,
                    $this->include_karense_salary, $this->include_sem_2_14_oncall_salary, $this->fkkn_split, $this->day_light_saving, $this->sick_15_90_oncall, $this->sick_annex_calculation_mode, $this->sms_pw_recovery, $this->contact_mail_send, $this->min_daily_rest, $this->kfo, $this->karens_full);
            }
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            //echo "<pre>".print_r($this->field_values,1)."</pre>";
            return $this->query_update();
            
        } else
            return FALSE;
    }
    
    function update_employee_against_company($fields, $field_values){
//        echo "<pre>".print_r($fields, 1)."</pre>"
//                echo "<pre>".print_r($field_values, 1)."</pre>";
        $this->tables = array('employee');
        $this->fields = $fields;
        $this->field_values = $field_values;
        return $this->query_update();
    }

    function update_privilege_against_company($type, $fields, $field_values){
        $table = '';
        switch ($type) {
            case 'general':
                $table = 'privileges_general';
                break;
        }
        $this->tables = array($table);
        $this->fields = $fields;
        $this->field_values = $field_values;
        return $this->query_update();
    }
            
    function company_db_name_generate() {

        $db_prifix = 't2v_';
        $this->db_name = strtolower(str_replace(' ', '_', substr($this->name, 0, 4)));
    }

    function company_upload_dir_generate() {

        $this->upload_dir = strtolower(str_replace(' ', '_', substr($this->name, 0, 4)));
    }
    
    function get_empty_database(){
        global $db;
//        $con1 = mysql_connect($db['host'],$db['username'], $db['password']);
//        mysql_select_db('information_schema', $con1);
        $this->tables = array('information_schema.TABLES');
        $this->fields = array('DISTINCT(TABLE_SCHEMA)');
        $this->query_generate();
        $data1=  $this->query_fetch();
        $this->tables = array('information_schema.SCHEMATA');
        $this->fields = array('SCHEMA_NAME');
        $this->query_generate();
        $data2=  $this->query_fetch();
        $result = array();
        for($i=0;$i<count($data2);$i++){
            for($j=0;$j<count($data1);$j++){
                if($data2[$i]['SCHEMA_NAME']==$data1[$j]['TABLE_SCHEMA']){
                    break;
                }
            }
            if($j == count($data1)){
                $result[]=$data2[$i]['SCHEMA_NAME'];
            }
        }
        return $result;
    }
    
    function company_add(){
        //'price_per_customer','price_per_sms',
        //$this->price,$this->price_per_sms
        $this->tables = array($this->db_master .'.company');
        $this->fields = array('name','logo','db_name','org_no','address', 'box','city','email','land_code','phone','mobile','website',
            'contact_person1','contact_person1_email','contact_person2','contact_person2_email','upload_dir',
            'salary_system','zipcode','billing_status','start_day','username1','username2');
        $this->field_values = array($this->name,$this->logo,$this->db_name,$this->org_no,$this->address, $this->box, $this->city,$this->email,$this->land_code,$this->phone,$this->mobile,$this->website,
            $this->contact_person1,$this->contact_person1_email,$this->contact_person2,$this->contact_person2_email,$this->upload_dir,
            $this->salary_system,$this->zipcode,$this->bill_status,$this->company_start_day,$this->username1,$this->username2);
       
        if($this->query_insert()){
            $last_inserted_id = $this->get_id();
            if($this->contract_from != '' || $this->contract_from != NULL){
                $this->tables = array($this->db_master .'.company_contract');
                $this->fields = array('company_id','contract_from','contract_to','price_per_customer','price_per_sms', 'price_per_sign');
                $this->field_values = array($last_inserted_id,$this->contract_from,$this->contract_to,$this->price,$this->price_per_sms, $this->price_per_sign); 
                if($this->query_insert())
                    return $last_inserted_id;
                else
                    return false;
            }else
                return $last_inserted_id;
        }else
            return false;
    }
    
    function generate_database_tables($filename,$dbname){
        global $db;
//        $con1 = mysql_connect($db['host'],$db['username'], $db['password']);
//        mysql_select_db($dbname,$con1);
        $this->select_db($dbname);
        /* Read the file */
        $lines = file($filename);
        
        if(!$lines){
            $errmsg = "cannot open file ";
            return false;
        }
        $scriptfile = false;

        /* Get rid of the comments and form one jumbo line */
        foreach($lines as $line){        
            $line = trim($line);
            if(preg_match('^--^', $line)){            
               
            }else{
                 $scriptfile.=" ".$line;
            }
        }
//        echo "<br><br>".$scriptfile;
        if(!$scriptfile){        
            $errmsg = "no text found in $filename";
            return false;
        }

        /* Split the jumbo line into smaller lines */
        $queries = explode(';', $scriptfile);
        foreach($queries as $query){ 
            
           $this->sql_query = trim($query);
            
            if($this->sql_query == "" || substr($this->sql_query, 0,2) == "/*") { continue; }
            $count = $this->con->exec( $this->sql_query);
//            $result = $this->con->prepare($this->sql_query.';');
//            if($result->execute()){            
//                $errmsg = "query ".$query." failed";
//                return false;
//            }
        }
        return true;
        
    }
    function login_add($secondary_login = FALSE) {

        global $preference, $db;
        if ($this->username != NULL) {
            if($this->password == '' || $this->password == NULL) $this->password = "12345678";
            $this->hash = $preference['hash'];
            $this->tables = array($db['database_master'] . '.login');
            $this->fields = array('username', 'password', 'role', 'date', 'company_ids','social_security');
            $this->field_values = array($this->username, md5($preference['hash'] . $this->password), $this->role, date('Y-m-d'), $this->company_id . ',',$this->social_security);          
            if($this->query_insert()){
                if($secondary_login) $this->secondary_login_add();
                return TRUE;
            }else
                return FALSE;
        } else
            return FALSE;
    }
    
    function secondary_login_add() {

        global $preference, $db;

        $this->tables = array($db['database_master'] . '.secondary_login');
        $this->fields = array('username');
        $this->conditions = array('AND', 'username = ?', 'company_id = ?');
        $this->condition_values = array($this->username, $this->company_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['username'])
            return TRUE;

        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($db['database_master'] . '.secondary_login');
            $this->fields = array('username', 'company_id', 'last_login_time', 'last_pw_update_date', 'error');
            $this->field_values = array($this->username, $this->company_id, '0000-00-00 00:00:00', date('Y-m-d'), 0);
            if ($this->password != NULL) {
                $this->fields[] = 'password';
                $this->field_values[] = md5($this->hash . $this->password);
            } else {
                $this->fields[] = 'password';
                $this->field_values[] = md5($this->hash . '12345678');
            }
            return $this->query_insert();
        } else
            return FALSE;
    }
        
    function employee_add_newdb($data){
        global $db;
        $this->tables = array($data.'.employee');
        $this->fields = array('username','first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'status','social_security');                
        $this->field_values = array($this->username, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email,'1',$this->social_security);
        return $this->query_insert();
    }
   
    function create_new_directory_company($directory){
        $thisdir = getcwd();
        if(!file_exists($thisdir ."/".$directory)){
            mkdir($thisdir ."/".$directory , 777);
            exec('cd '.$thisdir .'/' );
            exec('chmod -R 777 '.$directory);
            mkdir($thisdir ."/".$directory."/attachments" , 777);
            mkdir($thisdir ."/".$directory."/created_pdf_files"  , 777);
            mkdir($thisdir ."/".$directory."/customer_attachments"  , 777);
            mkdir($thisdir ."/".$directory."/document_decision" , 777);
            mkdir($thisdir ."/".$directory."/documents_attach" , 777);
            mkdir($thisdir ."/".$directory."/mail_attatch" , 777);
            mkdir($thisdir ."/".$directory."/log" , 777);
            mkdir($thisdir ."/".$directory."/cost" , 777);
            mkdir($thisdir ."/".$directory."/survey_files" , 777);
            mkdir($thisdir ."/".$directory."/notes" , 777);
            mkdir($thisdir ."/".$directory."/salary" , 777);
            mkdir($thisdir ."/".$directory."/document_archive" , 777);
            exec('cd '.$thisdir .'/' );
            exec('chmod -R 777 '.$directory);
        }
    }
    
    function company_deactive($ids){
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('status');
        $this->field_values = array("0");
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        return $this->query_update();
    } 
    
    function get_company_detail($ids){
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'language', 'logo', 'org_no', 'address', 'city', 'zipcode', 'box', 'email','land_code', 'phone', 'mobile', 'website', 'contact_person1', 'contact_person1_email', 'contact_person2', 'contact_person2_email', 'upload_dir', 'created_date', 'status',
            'price_per_customer','salary_system','price_per_sms', 'price_per_sign', 'billing_status','start_day','weekly_hour','max_daily_hour', 'monthly_oncall_hour', 'contract_exceed_check', 'atl_check', 'signing_mail', 'bank_account', 'fk_kr_per_time', 'kn_kr_per_time','username1','username2','leave_in_advance',
            'sem_year_start_month', 'inconvenient_on','candg', 'candg_on', 'candg_break','apply_max_karens', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length','sort_name_by', 'vacation_percentage', 'vacation_percentage_slots', 'sem_leave_days', 'vab_leave_days', 
            'fp_leave_days', 'nopay_leave_days', 'other_leave_days', 'include_sick', 'contract_auto_renewal', 'contract_auto_renewal_mail', 'include_karense_salary', 'include_sem_2_14_oncall_salary', 'fkkn_split', 'day_light_saving', 'sick_15_90_oncall', 'sick_annex_calculation_mode', 'recovery_pw_by_mobile', 'mail_send_to_contact_person', 'min_daily_rest', 'kfo', 'karens_full');
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        $this->query_generate();
        $data = $this->query_fetch();
//        return ($data ? $data[0] : FALSE);
        if($data){
            $current_company_contract_details = $this->get_company_current_contract_in_date($ids);
            $data[0]['price_per_customer'] = $data[0]['price_per_sms'] = 0;
            if(!empty($current_company_contract_details)){
                $data[0]['price_per_customer'] = $current_company_contract_details['price_per_customer'];
                $data[0]['price_per_sms'] = $current_company_contract_details['price_per_sms'];
                $data[0]['price_per_sign'] = $current_company_contract_details['price_per_sign'];
            }
            return $data[0];
        }
        else 
            return FALSE;
    }
    
    function get_company_current_contract_in_date($company_id = NULL, $date = NULL){
        if($date == NULL){
            $start_time = new DateTime;
            $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $date = $start_time->format('Y-m-d');
        }
        if($company_id == NULL){
            $company_id = $_SESSION['company_id'];
        }
        $this->flush();
        $this->tables = array($this->db_master . '.company_contract');
        $this->fields = array('id', 'contract_from', 'contract_to', 'price_per_customer', 'price_per_sms', 'price_per_sign');
        $this->conditions = array('AND', 'company_id = ?', array('BETWEEN','?','contract_from','contract_to'));
        $this->condition_values = array($company_id, $date);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : array());
    }
    
    
    
    
    /****************************** start shamsu *****************************************/
    function distinct_billing_years(){
        $this->tables = array('billing');
        $this->fields = array('distinct(year(bill_date)) as years');
       // $this->conditions = array('employee = ?');
        //$this->condition_values = array($employee);
        $this->order_by= array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }
    
    function get_bills_by_year($year){
        $this->tables = array('billing');
        $this->fields = array('id', 'file_number', 'month(bill_date) as bill_month', 'no_active_customers', 'price_per_customer', 'no_sms', 'price_per_sms', 'no_sign', 'price_per_sign');
        $this->conditions = array('year(bill_date) = ?');
        $this->condition_values = array($year);
        $this->order_by= array('bill_date asc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_bills_by_id($id){
        $this->tables = array('billing');
        $this->fields = array('id', 'file_number', 'bill_date', 'month(bill_date) as bill_month', 'no_active_customers', 'price_per_customer', 'no_sms', 'price_per_sms', 'no_sign', 'price_per_sign');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->order_by= array('bill_date asc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_no_of_outgoing_sms(){
        $this->tables = array('log_sms');
        $this->fields = array('count(id) as count');
        $this->conditions = array('AND', 'status = 1','month(date) = ?', 'year(date) = ?');
        $this->condition_values = array(date('m'),date('Y'));
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function check_bill_existance($month, $year){
        $this->tables = array('billing');
        $this->fields = array('id', 'file_number', 'bill_date', 'no_active_customers', 'price_per_customer', 'no_sms', 'price_per_sms');
        $this->conditions = array('AND','month(bill_date) = ?', 'year(bill_date) = ?');
        $this->condition_values = array($month, $year);
        $this->query_generate();
        $datas_bills = $this->query_fetch();
        return (empty($datas_bills) ? TRUE : FALSE);
    }
    
    function create_bill_entry($file_number, $no_of_active_customers, $price_per_customer, $no_of_sms, $price_per_sms, $price_per_sign, $no_of_sign, $mail_address, $company_id = NULL){
        if($this->check_bill_existance(date('m'),date('Y'))){
            $this->tables = array('billing');
            $this->fields = array('file_number', 'bill_date', 'no_active_customers', 'price_per_customer', 'no_sms', 'price_per_sms', 'price_per_sign', 'no_sign');
            $this->field_values = array($file_number, date('Y-m-d'), $no_of_active_customers, $price_per_customer, $no_of_sms, $price_per_sms, $price_per_sign, $no_of_sign);
            $res = $this->query_insert();
            print_r($this->query_error_details);
            $bill_id = $this->get_id();
            $this->create_bill_pdf($bill_id, $company_id, TRUE, $mail_address);
        }
    }
    
    function create_bill_pdf($id, $company_id = NULL, $out_put = FALSE, $mail_address = NULL){
        
        $smarty_obj = new smartySetup(array("mail.xml", 'month.xml'),FALSE);
        
        $pdf = new PDF_billing();
        $pdf->AliasNbPages();
        $pdf->AddPage();        //page1
        $bill_info= $this->get_bills_by_id($id);
//        $company_details = $this->get_company_detail($_SESSION['company_id']);
        $company_details = $this->get_company_detail($company_id);
        $pdf->bill_info = $bill_info;
        $pdf->company_info = $company_details;
        $pdf->page_header_org();
        $pdf->P1_Part1();
        $pdf->P1_Part2();
        $pdf->P1_Part3_org();
        if(!$out_put){      // for normal display
            $pdf->Output(); 
        }else{              
            //for sending mail when cron job running
            global $company;
            require_once('class/general.php');
            $obj_general = new general();
            $obj_general->utf8_string_array_encode($company);
            //            $company = $this->get_company_directory($_SESSION['company_id']);
            //            $pdf->Output("./". $company['upload_dir'] ."/bills/".$bill_rand_name,'F');
            $eol = PHP_EOL;
            //            $filename = "example.pdf"; 
            //            $bill_rand_name= 'bill_'. rand().'.pdf';
            $bill_rand_name= 'Faktura_'. $smarty_obj->translate[strtolower(date("F"))]. '_'. date("Y").'_'.utf8_decode($company_details['name']).'.pdf';
            $pdfdoc = $pdf->Output("", "S");
            $attachment = chunk_split(base64_encode($pdfdoc));
            
            $accounts_manager_name = $company['accounts_manager_name'];
            $accounts_manager_email = $company['accounts_manager_email'];
            $to = $mail_address; 
            //$to = "Shaju<shajukt@entraze.com>,Gilad<gn.nevo@gmail.com>";
            $to .= ",".$accounts_manager_name."<".$accounts_manager_email.">"; 
            $to .= ",".$company['contact_person1']."<".$company['email'].">"; 
            $from = $company['mail_server'];
            $subject = $smarty_obj->translate['before_subject_bill_cron'].' ' . $smarty_obj->translate[strtolower(date("F"))]. ', '.date("Y") . ' ' . $smarty_obj->translate['after_subject_bill_cron']; 
//            $message = 'Avgift för månad ' . date("F, Y");
            $message = $smarty_obj->translate['mail_body_bill_cron'];
            $message .= '<br />'.$smarty_obj->translate['e_mail']. ': '.$company['email'];
            $separator = md5(time());

            // main header (multipart mandatory)
            /*$headers  = "From: ".$from.$eol;
            $headers .= "MIME-Version: 1.0".$eol; 
            $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol; 
            $headers .= "Content-Transfer-Encoding: 7bit".$eol;
            $headers .= "This is a MIME encoded message.".$eol;
            // message
            $headers .= "--".$separator.$eol;
//            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
            $headers .= "Content-Type: text/html; charset=\"utf-8\"".$eol;
            $headers .= "Content-Transfer-Encoding: 8bit".$eol;
            $headers .= $message.$eol;
            // attachment
            $headers .= "--".$separator.$eol;
            $headers .= "Content-Type: application/octet-stream; name=\"".$bill_rand_name."\"".$eol; 
            $headers .= "Content-Transfer-Encoding: base64".$eol;
            $headers .= "Content-Disposition: attachment;filename=\"".$bill_rand_name."\"".$eol;
            $headers .= $attachment.$eol;
            $headers .= "--".$separator."--";  */
            
            
            $separator = md5(time());

            // carriage return type (we use a PHP end of line constant)
            $eol = PHP_EOL;




            // main header
            //$headers  = "From: ' .'cirrus-noreply@time2view.se".$eol;
            $headers  = "From: Cirrus<cirrus-noreply@time2view.se>".$eol;
            $headers .= "MIME-Version: 1.0".$eol; 
            $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol;
            $headers .= "To: " . $to . $eol;

            // no more headers after this, we start the body! //

            $body = "--".$separator.$eol;
            $body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;

            // message
            $body .= "--".$separator.$eol;
            $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
            $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
            $body .= $message.$eol;

            // attachment
            $body .= "--".$separator.$eol;
            $body .= "Content-Type: application/octet-stream; name=\"".$bill_rand_name."\"".$eol; 
            $body .= "Content-Transfer-Encoding: base64".$eol;
            $body .= "Content-Disposition: attachment".$eol.$eol;
            $body .= $attachment.$eol;
            $body .= "--".$separator."--";

            // send message
            mail($to, $subject, $body, $headers, '-fcirrus-noreply@time2view.se');
            //mail('shajukt@gmail.com', $subject, $body, $headers);
            
            //mail($to, $subject, $message, $headers,"-f".$company['mail_server']);
            echo 'Bill Created...';
        }
    }
    
    function getMonthDetails($month) {
        $val = array();
        switch($month){
            case '01':
                    $val = array('02', '06');break;
            case '02':
                    $val = array('03', '09');break;
            case "03":
                    $val = array('04', '06');break;
            case "04":
                    $val = array('05', '05');break;
            case "05":
                    $val = array('06', '06');break;
            case "06":
                    $val = array('07', '07');break;
            case "07":
                    $val = array('08', '06');break;
            case "08":
                    $val = array('09', '06');break;
            case "09":
                    $val = array('10', '07');break;
            case "10":
                    $val = array('11', '06');break;
            case "11":
                    $val = array('12', '07');break;
            case "12":
                    $val = array('01', '06');break;
        }
        return $val;
    }
    /****************************** end shamsu *****************************************/
    
    function get_company_contract($company_id){
        $this->tables = array($this->db_master . '.company_contract');
        $this->fields = array('MAX(id) AS ids');
        $this->conditions = array('company_id = ?');
        $this->condition_values = array($company_id);
        $this->query_generate();
        $data1 = $this->query_fetch();
        if($data1){
            $this->tables = array($this->db_master . '.company_contract');
            $this->fields = array('id','company_id','contract_from','contract_to','price_per_sms','price_per_customer', 'price_per_sign');
            $this->conditions = array('id = ?');
            $this->condition_values = array($data1[0]['ids']);
            $this->query_generate();
            $data = $this->query_fetch();
            return ($data ? $data : array());
        }else
            return array();
    }
    
    function get_company_contract_detail($company_id){
        $this->tables = array($this->db_master . '.company_contract');
        $this->fields = array('id','company_id','contract_from','contract_to','price_per_sms','price_per_customer', 'price_per_sign');
        $this->conditions = array('company_id = ?');
        $this->condition_values = array($company_id);
        $this->order_by = array('contract_from DESC','contract_to');
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }
    
    function check_company_contract_overlap($company_id,$id_contract = 0){
        $this->tables = array($this->db_master . '.company_contract');
        $this->fields = array('id','company_id','contract_from','contract_to','price_per_sms','price_per_customer', 'price_per_sign');
        if($id_contract == 0){
            $this->conditions = array('AND','company_id = ?',array('BETWEEN','?','contract_from','contract_to'),array('BETWEEN','?','contract_from','contract_to'));
            $this->condition_values = array($company_id,$this->contract_from,$this->contract_to);
        }else{
            $this->conditions = array('AND','company_id = ?',array('BETWEEN','?','contract_from','contract_to'),array('BETWEEN','?','contract_from','contract_to'),'id <> ?');
            $this->condition_values = array($company_id,$this->contract_from,$this->contract_to,$id_contract);
        }
        
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }
    
    function add_company_contract($company_id){
        $company_contracts = $this->check_company_contract_overlap($company_id);
        if($company_contracts){
            return array('type'=>'fail','msg'=>'overlap_error_company_contract');
        }else{
            $this->tables = array($this->db_master . '.company_contract');
            $this->fields = array('company_id','contract_from','contract_to','price_per_sms','price_per_customer', 'price_per_sign');
            $this->field_values = array($company_id,$this->contract_from,$this->contract_to,$this->price_per_sms,$this->price, $this->price_per_sign);
            if($this->query_insert()){
                /*if(strtotime(date('Y-m-d'))>= strtotime($this->contract_from) && strtotime(date('Y-m-d')) < strtotime($this->contract_to)){
                    $this->tables = array($this->db_master . '.company');
                    $this->fields = array('price_per_sms','price_per_customer');
                    $this->field_values = array($this->price_per_sms,$this->price);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($company_id);
                    if($this->query_update()){
                        return array('type'=>'success','msg'=>'sucess_company_contract_add');
                    }else{
                        return array('type'=>'fail','msg'=>'adding_error_company_contract_add');
                    }
                }*/
                return array('type'=>'success','msg'=>'sucess_company_contract_add');
                
            }else{
                return array('type'=>'fail','msg'=>'adding_error_company_contract_add');
            }
        }
    }
    
    function get_contract_detail($contract_id){
        $this->tables = array($this->db_master . '.company_contract');
        $this->fields = array('id','company_id','contract_from','contract_to','price_per_sms','price_per_customer', 'price_per_sign');
        $this->conditions = array('id = ?');
        $this->condition_values = array($contract_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function edit_company_contract($contract_id,$company_id){
        $company_contracts = $this->check_company_contract_overlap($company_id,$contract_id);
        if($company_contracts){
            return array('type'=>'fail','msg'=>'overlap_error_company_contract');
        }else{
            $this->tables = array($this->db_master . '.company_contract');
            $this->fields = array('contract_from','contract_to','price_per_sms','price_per_customer', 'price_per_sign');
            $this->field_values = array($this->contract_from,$this->contract_to,$this->price_per_sms,$this->price, $this->price_per_sign);
            $this->conditions = array('id = ?');
            $this->condition_values = array($contract_id);
            if($this->query_update()){
                /*if(strtotime(date('Y-m-d'))>= strtotime($this->contract_from) && strtotime(date('Y-m-d')) < strtotime($this->contract_to)){
                     $this->tables = array($this->db_master . '.company');
                    $this->fields = array('price_per_sms','price_per_customer');
                    $this->field_values = array($this->price_per_sms,$this->price);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($company_id);
                    if($this->query_update()){
                        return  array('type'=>'success','msg'=>'sucess_company_contract_edit');
                    }else{
                        return array('type'=>'fail','msg'=>'editting_error_company_contract_add');
                    }
                }*/
                
                return  array('type'=>'success','msg'=>'sucess_company_contract_edit');
                
            }
            else
                return array('type'=>'fail','msg'=>'editting_error_company_contract_add');
        }
    }
    
    function delete_company_contract($contract_id){
        $this->tables = array($this->db_master . '.company_contract');
        $this->conditions = array('id = ?');
        $this->condition_values = array($contract_id);
        if($this->query_delete())
            return  array('type'=>'success','msg'=>'sucess_company_contract_delete');
        else
            return array('type'=>'fail','msg'=>'deletting_error_company_contract_add');
    }
    function employee_detail_main($username,$db_name) {
        $this->tables = array($db_name.'.employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name','address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
        $this->conditions = array('AND', 'username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
        
    function employee_edit_newdb($dbname){
        $this->tables = array($dbname.'.employee');
        $this->fields = array('first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'status','social_security');                
        $this->field_values = array( $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email,'1',$this->social_security);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        return $this->query_update();
    }
    
    function login_edit() {

        global $preference, $db;
        if($this->password == '' || $this->password == NULL){
            $this->password = "12345678";
        }
        $this->hash = $preference['hash'];
        $this->tables = array('' . $db['database_master'] . '.login');
        $this->fields = array( 'password', 'role', 'company_ids','social_security');
        $this->field_values = array( md5($preference['hash'] . $this->password), $this->role, $this->company_id . ',',$this->social_security);  
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        return $this->query_insert();
    }
    
    function find_employees_by_name($name){
        global $db;
        $this->flush();
        $this->tables = array('employee` as `e', $db['database_master'].'.login` as `l');
        $this->fields = array('e.username', 'e.century', 'e.code', 'e.social_security', 'e.first_name', 'e.last_name', 'e.city', 'e.phone', 'e.mobile', 'e.status', 'l.role');
        $this->conditions = array('AND', 'l.username = e.username', array('OR', 'CONCAT(e.first_name," ",e.last_name) like ?', 'CONCAT(e.last_name," ",e.first_name) like ?'));
        $this->condition_values = array('%'.$name.'%', '%'.$name.'%');
        $this->order_by = array('e.first_name', 'e.last_name');
        $this->query_generate();
//        echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function find_customers_by_name($name){
        global $db;
        $this->flush();
        $this->tables = array('customer` as `c', $db['database_master'].'.login` as `l');
        $this->fields = array('c.username', 'c.century', 'c.code', 'c.social_security', 'c.first_name', 'c.last_name', 'c.city', 'c.phone', 'c.mobile', 'c.status', 'l.role');
        $this->conditions = array('AND', 'l.username = c.username', array('OR', 'CONCAT(c.first_name," ",c.last_name) like ?', 'CONCAT(c.last_name," ",c.first_name) like ?'));
        $this->condition_values = array('%'.$name.'%', '%'.$name.'%');
        $this->order_by = array('c.first_name', 'c.last_name');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_company_contracts_end_with_date($date, $available_company_ids = array()){
        $this->flush();
        $this->tables = array($this->db_master . '.company_contract` as `cc', $this->db_master . '.company` as `c');
        $this->fields = array('cc.id', 'cc.company_id', 'c.name as company_name', 'cc.contract_from', 'cc.contract_to', 'cc.price_per_customer', 'cc.price_per_sms', 'cc.price_per_sign', 
            'IF ((SELECT count(id) FROM '.$this->db_master.'.company_contract where contract_from = DATE_ADD(cc.contract_to, INTERVAL 1 DAY) AND company_id = cc.company_id), "1", "0") as exist_next_day_contract');
        $this->conditions = array('AND', 'cc.contract_to = ?', 'cc.company_id = c.id');
        $this->condition_values = array($date);
        
        if(!empty($available_company_ids)){
            $this->conditions[] = array('IN', 'cc.company_id', $available_company_ids);
        }
        $this->query_generate();
//        echo $this->sql_query;
//        return $this->query_fetch();
        $data = $this->query_fetch();
//        echo "<pre>".print_r($this->query_error_details, 1)."</pre>";
        return $data;
        
        //================================
        /*$this->tables = array('customer_contract` as `cc', 'customer` as `c');
        $this->fields = array('cc.id', 'cc.customer', 'cc.date_from', 'cc.date_to', 'cc.hour', 'cc.fkkn',
            'IF ((SELECT count(id) FROM customer_contract where date_from >= cc.date_to AND customer = cc.customer AND fkkn = cc.fkkn), "1", "0") as have_future_contracts',
            'c.first_name', 'c.last_name');
        $this->conditions = array('AND', 'cc.date_to = ?', 'cc.customer = c.username');
        $this->condition_values = array($date);
        $this->order_by = array('cc.customer', 'cc.date_from');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;*/
    }

    function get_timeslots_for_daylight($daylight_saving_date){
        $datas = array();
        $this->sql_query = "SELECT t.id as slot_id, t.employee, t.customer, t.time_from, t.time_to,t.type,t.fkkn,t.alloc_emp,t.relation_id,t.status,t.created_status,r.id FROM `timetable` t LEFT JOIN report_signing r ON t.employee=r.employee AND t.customer = r.customer AND r.date='".substr($daylight_saving_date,0,4)."-".substr($daylight_saving_date,5,2)."-01' WHERE r.id IS NULL AND t.date = '".$daylight_saving_date."' AND ((t.time_from >=2  AND t.time_from <3) OR (t.time_to > 2 AND t.time_to <=3) OR (t.time_from < 2 AND t.time_to > 3)) AND t.created_status IS NULL";
        $datas = $this->query_fetch();
        //exit();
        return $datas;

    }
}
?>