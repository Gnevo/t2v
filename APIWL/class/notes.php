<?php
/**
 * Description of notes
 *
 * @author Shamsudheen  shamsu<shamsu@arioninfotech.com>
 */

require_once('configs/config.inc.php');
require_once ('class/user.php');
require_once ('class/employee.php');
//require_once ('plugins/date_calc.class.php');
require_once ('class/db.php');
//require_once ('class/inconvenient_timing.php');



class notes extends db {
    //variable diclaration
    var $id = '';
    var $title = '';
    var $description = '';
    var $visibility = '';
    var $note_date = '';
    var $login_user = '';
    var $status = '';
    var $customer = '';
    var $ticket = '';
    var $editable = '';

    function __construct() {
        parent::__construct();
    }

    function insert_note() {
        $this->tables = array('note'); 
        $this->fields = array('created_user','title','description','visibility','status','customer', 'ticket','attachment','editable');
        $this->field_values = array($this->login_user,  $this->title,  $this->description,  $this->visibility,  $this->status,  $this->customer, $this->ticket, NULL,$this->editable); 
        if($this->query_insert()){

            $id = $this->get_id();
            $this->append_note_attachments($id);
            return TRUE;
        }else{ 
            return FALSE;
        }
    }

    function append_note_attachments($note_id, $old_attachment_string = '') {
        
        $attach_string = ($old_attachment_string != '' ? $old_attachment_string : '');
        $file_counter = ($old_attachment_string != '' ? 1 : 0);
        $new_attachments_count = count($this->attachment['name']);
        for($i=0; $i < $new_attachments_count; $i++) {
                  //Get the temp file path
                  $tmpFilePath = $this->attachment['tmp_name'][$i];
                  //Make sure we have a filepath
                  if($this->attachment['error'][$i] != 0)   //for more details about file errors http://php.net/manual/en/features.file-upload.errors.php
                      continue;
                  elseif ($tmpFilePath != ""){
                         $ext = pathinfo($this->attachment['name'][$i]);
                         //$name_arr = explode(".",$this->attachment['name'][$i]);
                        //Setup our new file path

                        $newName = strtotime(date("Y-m-d H:i:s")).$i."_".$this->attachment['name'][$i];
                        $newName = str_replace(" ","_",$newName);
                        $get_CompanyName = $this->get_company_name($_SESSION['company_id']);
                        $app_dir = getcwd(); 
                        if(!is_dir($app_dir."/".$get_CompanyName."/")){ 
                                mkdir($app_dir."/".$get_CompanyName."/" ,0777);
                        }
                        if(!is_dir($app_dir."/".$get_CompanyName."/notes/")){
                                mkdir($app_dir."/".$get_CompanyName."/notes/" ,0777);
                        }
                        if(!is_dir($app_dir."/".$get_CompanyName."/notes/attachment/")){	
                                mkdir($app_dir."/".$get_CompanyName."/notes/attachment/" ,0777);
                        }

                        $newFilePath = $app_dir."/".$get_CompanyName."/notes/attachment/" . $newName;

                        //Upload the file into the temp dir
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                          //Handle other code here
                        }
                        if($file_counter == 0)
                            $comma = ""; 
                        else
                            $comma = ",";
                        $attach_string .= $comma.$newName;
                        $file_counter++;
                  }
         }

        $this->tables = array('note');
        $this->fields = array('attachment');
        $this->field_values = array($attach_string);
        $this->conditions = array('id = ?');
        $this->condition_values = array($note_id);
        if($this->query_update())
                return TRUE;
        else
                return FALSE;
    }

    function update_note($note_id, $old_attachment_string = '') {
        $this->tables = array('note'); 
        $this->fields = array('title','description','visibility','customer', 'last_updated_user', 'last_updated_date','editable');
        $this->field_values = array($this->title,  $this->description,  $this->visibility, $this->customer,$this->login_user, date('Y-m-d H:i:s'),$this->editable);
        $this->conditions = array('id = ?');
        $this->condition_values = array($note_id);
        if($this->query_update()){
                $this->append_note_attachments($note_id, $old_attachment_string);
                return TRUE;
        }else{ 
                return FALSE;
        }
    }

    function delete_note($note_id) {
        $notes_detail = $this->get_note_detail($note_id);
        $this->tables = array('note');
        $this->conditions = array('id = ?');
        $this->condition_values = array($note_id);
        if($this->query_delete()){
            $attachment_arr = array();
            if(trim($notes_detail[0]['attachment']) != ''){
                   $attachment_arr = explode(",",$notes_detail[0]['attachment']);
                   $this_companyName = $this->get_company_name($_SESSION['company_id']);
                   $app_dir = getcwd(); 
                   foreach ($attachment_arr as $attachment){
                        if($attachment == '')
                            continue;
                        if(file_exists($app_dir. "/". $this_companyName . "/notes/attachment/" . $attachment))
                            unlink ($app_dir . "/". $this_companyName . "/notes/attachment/" . $attachment);
                        
                    }
            }
            return TRUE;
        }else{ 
            return FALSE;
        }
    }
    
    function update_note_status() {
        $this->tables = array('note');
        $this->fields = array('status');
        $this->field_values = array($this->status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->id);
        if($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function update_attachment($attachment_string) {
        $this->tables = array('note');
        $this->fields = array('attachment');
        $this->field_values = array($attachment_string);
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->id);
        if($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    /*function get_all_notes() {
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($login_user_role == 2){
            $team_members = $employee->team_members($login_user);
            $team_employee_data = '\'' . implode('\',\'', $team_members) . '\'';
        }
        $this->tables = array('note` as `n','employee` as `e');
        $this->fields = array('n.created_user',"concat(e.first_name,' ',e.last_name) as emp_name", 'n.title','n.description','n.visibility','n.date','n.status');
        switch ($login_user_role) {
            case 1:
                $this->conditions = array('n.created_user like e.username');
                break;
            case 2:
                $this->conditions = array('AND','n.status = 1',array('IN', 'n.created_user', $team_employee_data),'n.created_user like e.username');
                break;
            case 3:
                $this->conditions = array('AND','n.status = 1','n.created_user like ?','n.created_user like e.username');
                $this->condition_values = array($login_user);
                break;
        }

        $this->order_by = array('n.date desc');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }*/

    function get_all_notes($year = NULL, $month = NULL, $st = NULL, $en = NULL, $cust_id = NULL, $search_text = NULL, $show = 'LIMIT', $get_ids_only = FALSE, $emp_user_id = NULL, $search_date = NULL ) {
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];

        $login_user_role = $user->user_role($login_user);
        $team_employee_data = '';
        $team_emp_query = '';

        if ($login_user_role == 2 || $login_user_role == 7){
            $team_members = $employee->team_members_for_employee_report($login_user);
            $team_employee_data = '\'' . implode('\',\'', $team_members) . '\'';
        }

        if ($login_user_role == 3 || $login_user_role == 2 || $login_user_role == 7){
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($login_user);
            $this->query_generate();
            $cust_query = $this->sql_query;

            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->query_generate();
            $team_emp_query = $this->sql_query;
        }
        
        $employee_detail = $employee->employee_detail_main($login_user);
        $office_personal_flag = $employee_detail[0]['office_personal'];
        
        //$this->flush();
        $this->tables = array('note` as `n','employee` as `e');
        if($get_ids_only)
            $this->fields = array('n.id as id', 'n.date');
        else
            $this->fields = array('n.id as id','n.created_user', 'n.attachment',"concat(e.first_name,' ',e.last_name) as emp_name","concat(e.last_name,' ',e.first_name) as emp_name_lf", 'n.title','n.description','n.visibility','n.date','n.status','n.customer', "(SELECT concat(first_name,' ',last_name) FROM customer where username = n.customer)as cust_name", "(SELECT concat(last_name,' ',first_name) FROM customer where username = n.customer)as cust_name_lf", 'n.editable');

        if ($login_user_role == 1){
            if ($year != NULL && $month != NULL){
                if($cust_id == NULL)
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"','( n.visibility = 1 OR  n.visibility = 4 OR  e.office_personal = 1)', 'n.created_user like e.username');
                else
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', 'n.customer = "'.$cust_id.'"','( n.visibility = 1 OR  n.visibility = 4)', 'n.created_user like e.username');
            }else if ($year != NULL && $month == NULL){
                if($cust_id == NULL)
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', '( n.visibility = 1 OR  n.visibility = 4)', 'n.created_user like e.username');
                else
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'n.customer = "'.$cust_id.'"', '( n.visibility = 1 OR  n.visibility = 4)', 'n.created_user like e.username');
            }else{
                if($cust_id == NULL)
                    $this->conditions = array('AND','( n.visibility = 1 OR  n.visibility = 4)', 'n.created_user like e.username');
                else
                    $this->conditions = array('AND', 'n.customer = "'.$cust_id.'"', '( n.visibility = 1 OR  n.visibility = 4)', 'n.created_user like e.username');
            }
            //if($office_personal_flag == 1){
                //$this->conditions[] = '';
            //}else{
                //$this->conditions[] = '';
            //}
        }else{
            if ($year != NULL && $month != NULL){
                if($cust_id == NULL)
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"',array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'),'n.created_user like e.username');
                else
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', 'n.customer = "'.$cust_id.'"',array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'), 'n.created_user like e.username');
            }else if ($year != NULL && $month == NULL){
                if($cust_id == NULL)
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"',array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'),'n.created_user like e.username');
                else
                    $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'n.customer = "'.$cust_id.'"', array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'),'n.created_user like e.username');
            }else{
                if($cust_id == NULL)
                    $this->conditions = array('AND',array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'),'n.created_user like e.username');
                else
                    $this->conditions = array('AND', 'n.customer = "'.$cust_id.'"',array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'),'n.created_user like e.username');
            }
            if($office_personal_flag == 1){
                $this->conditions[] = '( n.visibility = 1 OR n.visibility = 4 )';
            }else{
                $this->conditions[] = '( n.visibility = 1)';
            }
        }
        //include search text
        if($search_text != NULL)
                $this->conditions[] = array('OR', 'n.title like "%'.$search_text.'%"', 'n.description like "%'.$search_text.'%"');
        if($emp_user_id != NULL){
            $this->conditions[] = array('n.created_user = "'.$emp_user_id.'"');
        }
        if($search_date != NULL){
            $this->conditions[] = array('DATE(n.date) = "'.$search_date.'"');
        }
        
        $this->query_generate();
        $qry1 =  $this->sql_query;   // qry1 gets all public notes (and admin-only files -when login-user = 1)
        // echo $this->sql_query;
        // exit('df');
        //$this->tables = array('note` as `n','employee` as `e');
        //$this->fields = array('n.created_user',"concat(e.first_name,' ',e.last_name) as emp_name", 'n.title','n.description','n.visibility','n.date','n.status');
        switch ($login_user_role) {
            case 1:
                if ($year != NULL && $month != NULL){
                    if($cust_id == NULL)
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"','n.created_user like e.username');
                    else
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', 'n.customer = "'.$cust_id.'"','n.created_user like e.username');
                }else if ($year != NULL && $month == NULL){
                    if($cust_id == NULL)
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"','n.created_user like e.username');
                    else
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'n.customer = "'.$cust_id.'"','n.created_user like e.username');
                }else{
                    if($cust_id == NULL)
                        $this->conditions = array('AND','n.created_user like e.username');
                    else
                        $this->conditions = array('AND', 'n.customer = "'.$cust_id.'"','n.created_user like e.username');
                }
                if($office_personal_flag == 1){
                    $this->conditions[] = '( n.visibility = 2 OR  n.visibility = 3  OR n.visibility = 4 )';
                }else{
                    $this->conditions[] = '( n.visibility = 2 OR  n.visibility = 3 )';
                }
                break;
            case 2:
            case 7:    
                if ($year != NULL && $month != NULL){
                    if($cust_id == NULL)
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"',array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'),array('IN', 'n.customer', $cust_query),array('IN', 'n.created_user', $team_employee_data),'n.created_user like e.username');
                    else
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"',array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'),array('IN', 'n.customer', $cust_query),array('IN', 'n.created_user', $team_employee_data), 'n.customer = "'.$cust_id.'"', 'n.created_user like e.username');
                }else if ($year != NULL && $month == NULL){
                    if($cust_id == NULL)
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"',array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'),array('IN', 'n.customer', $cust_query),array('IN', 'n.created_user', $team_employee_data),'n.created_user like e.username');
                    else
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"',array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'),array('IN', 'n.customer', $cust_query),array('IN', 'n.created_user', $team_employee_data), 'n.customer = "'.$cust_id.'"', 'n.created_user like e.username');
                }else{
                    if($cust_id == NULL)
                        $this->conditions = array('AND', array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),array('IN', 'n.created_user', $team_employee_data),'n.created_user like e.username');
                    else
                        $this->conditions = array('AND', array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),array('IN', 'n.created_user', $team_employee_data), 'n.customer = "'.$cust_id.'"', 'n.created_user like e.username');
                }
                if($office_personal_flag == 1 || $login_user_role == 7){
                    $this->conditions[] = '( n.visibility = 2 OR  n.visibility = 3  OR n.visibility = 4 )';
                }else{
                    $this->conditions[] = '( n.visibility = 2 OR  n.visibility = 3 )';
                }
                break;
            case 3:
                if ($year != NULL && $month != NULL){
                    if($cust_id == NULL)
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),'n.created_user like e.username');
                    else
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', 'n.customer = "'.$cust_id.'"', array('OR', 'n.status != 0', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),'n.created_user like e.username');
                    //$this->condition_values = array($login_user);
                }else if ($year != NULL && $month == NULL){
                    if($cust_id == NULL)
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),'n.created_user like e.username');
                    else
                        $this->conditions = array('AND','year(n.date) = "'.$year.'"', 'month(n.date) = "'.$month .'"', 'n.customer = "'.$cust_id.'"', array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),'n.created_user like e.username');
                    //$this->condition_values = array($login_user);
                }else{
                    if($cust_id == NULL)
                        $this->conditions = array('AND', array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),'n.created_user like e.username');
                    else
                        $this->conditions = array('AND', 'n.customer = "'.$cust_id.'"', array('OR', 'n.status = 1', 'n.created_user = "'.$login_user.'"'), array('IN', 'n.customer', $cust_query),'n.created_user like e.username');
                    //$this->condition_values = array($login_user);
                }
                if($office_personal_flag == 1){
                    $this->conditions[] = '( n.visibility = 2 OR  n.visibility = 3  OR n.visibility = 4 )';
                }else{
                    $this->conditions[] = '( n.visibility = 2 OR  n.visibility = 3 )';
                }
                break; 
        }
        
        //include search text
        if($search_text != NULL)
                $this->conditions[] = array('OR', 'n.title like "%'.$search_text.'%"', 'n.description like "%'.$search_text.'%"');
        if($emp_user_id != NULL){
            $this->conditions[] = array('n.created_user = "'.$emp_user_id.'"');
        }
        if($search_date != NULL){
            $this->conditions[] = array('DATE(n.date) = "'.$search_date.'"');
        }

        if ($year == NULL && $month == NULL && $show == 'LIMIT')
            $this->limit = 100;
        else
            $this->limit = 0;

        $this->query_generate();
        $qry2 = $this->sql_query;   //qry2 gets specified private notes
        //echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        if($st != NULL)
        	$this->sql_query = '( '.$qry1. ' ) UNION ( ' .$qry2 . ' )  ORDER BY date desc limit '.$st.','.$en.';';
        else
        	$this->sql_query = '( '.$qry1. ' ) UNION ( ' .$qry2 . ' )  ORDER BY date desc';
        
        // echo $this->sql_query;
        // exit('g');
        $data = $this->query_fetch();
        // echo "<pre>".print_r($data, 1)."</pre>";
        return $data;
    }

    function distinct_note_years(){
        $this->tables = array('note');
        $this->fields = array('distinct(year(date)) as years');
        $this->order_by= array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function get_note_detail($id){
		$this->tables = array("SELECT n.id AS id, n.attachment, n.created_user,n.editable, CONCAT(e.first_name,' ',e.last_name) AS emp_name, n.title, 
                    n.description, n.visibility, n.date, n.status, n.customer AS cust_name 
                    FROM note AS n
                    LEFT JOIN  employee AS e ON n.created_user = e.username
                    where n.id = $id");
        $this->query_generate_leftjoin();
        $data = $this->query_fetch();
        return $data;
    }
        
    function get_unread_note($limit = 'SHOW_ALL') {
        $login_user = $_SESSION['user_id'];
        /*$this->tables = array('mc_note');
        $this->fields = array('note_id');
        $this->conditions = array('read_users LIKE \'%'.$login_user.'%\' ');
        $this->query_generate();
        $sub_query = $this->sql_query;

        $this->tables = array('note');
        $this->fields = array('id');
        $this->conditions = array('id NOT IN ('.$sub_query.')');

        $this->query_generate();
        $datas = $this->query_fetch(2);*/
        if($limit == 'SHOW_ALL'){
            $this->tables = array("SELECT DISTINCT m.id
                                FROM `note` AS m
                                LEFT JOIN `mc_note` AS mcn ON ( mcn.note_id = m.id )
                                WHERE mcn.read_users NOT LIKE '%$login_user%'
                                OR mcn.note_id IS NULL ORDER BY m.id DESC");
        }else{
            $this->tables = array("SELECT DISTINCT m.id
                                FROM `note` AS m
                                LEFT JOIN `mc_note` AS mcn ON ( mcn.note_id = m.id )
                                WHERE mcn.read_users NOT LIKE '%$login_user%'
                                OR mcn.note_id IS NULL ORDER BY m.id DESC LIMIT 200");
        }
        $this->query_generate_leftjoin();
        //echo $this->sql_query;
        $datas = $this->query_fetch(2);
        return $datas;

    }

    function get_all_unread_notes($all_list,$unread_list, &$note_ids = array()) {
        // this function is used to take all unread leaves according to that loged user when he is first taking message center leave option
        $u_note = array();
        for ($i=0; $i<count($all_list); $i++){
            if(in_array($all_list[$i]['id'], $unread_list)){
                    $all_list[$i]['is_unread'] = 1;
                    $u_note[]=$all_list[$i];
                    $note_ids[]['id'] = $all_list[$i]['id'];
            }
        }
        return ($u_note);
    }

    function set_as_read_notes($data){
        
        $return_flag = TRUE;
        if(!empty($data)){
            foreach($data as $row){
                if($this->check_noteID_exist($row['id'])){
                    //updation
                    $read_users_list=  $this->get_note_read_users($row['id']); // get already leave readed users
                    $this->tables = array('mc_note');
                    $this->fields = array('read_users');
                    $this->field_values = array($read_users_list[0].','.$_SESSION['user_id']);
                    $this->conditions = array('note_id = ?');
                    $this->condition_values = array($row['id']);
                    $return_flag = $this->query_update();
                }else{
                    //insertion
                    $this->tables = array('mc_note');
                    $this->fields = array('note_id','read_users');
                    $this->field_values = array($row['id'],$_SESSION['user_id']);
                    $return_flag = $this->query_insert();
                }

                if(!$return_flag) break;
            }
        }
        return $return_flag;
    }

    // function process_all_notes_read($note_ids){
    //     $this->tables = array('mc_note');
    //     $this->fields = array('read_users');
    //     $this->field_values = array('CONCAT(`read_users`,\',\',\''.$_SESSION['user_id'].'\')');
    //     $this->conditions = array('IN','note_id',$note_ids);
    //     $return_flag = $this->query_update();
    // }

    function check_noteID_exist($id){
        $this->tables = array('mc_note');
        $this->fields = array('note_id');
        $this->conditions = array('note_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (!empty($datas))
            return TRUE;  //return true if id exist in mc_leave
        else
            return FALSE;  //return false if id not exist in mc_leave
    }
    
    function get_note_read_users($id){
        $this->tables = array('mc_note');
        $this->fields = array('read_users');
        $this->conditions = array('note_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }
	
    function get_company_name($cid){
            global $db; 
            $this->tables = array($db['database_master'].'.company');
            $this->fields = array('*');
            $this->conditions = array('id = ?');
            $this->condition_values = array($cid);
            $this->query_generate();
            $datas = $this->query_fetch();
            return $datas[0]['upload_dir'];
    }
    
    function get_all_notes_of_customer($cust){
        $this->tables = array("SELECT n.id AS id, n.attachment, n.created_user, CONCAT(e.first_name,' ',e.last_name) AS emp_name, n.title, 
                    n.description, n.visibility, n.date, n.status, n.customer AS cust_name 
                    FROM note AS n
                    LEFT JOIN  employee AS e ON n.created_user = e.username
                    where n.customer = '$cust' ORDER BY n.date DESC");
        $this->query_generate_leftjoin();
        $data = $this->query_fetch();
        return $data;
    }
    
    function get_unread_note_count() {
        $user = new user();
        $employee = new employee();
        $login_user = $_SESSION['user_id'];

        $login_user_role = $user->user_role($login_user);
        $team_employee_data = '';

        $employee_detail = $employee->employee_detail_main($login_user);
        $office_personal_flag = $employee_detail[0]['office_personal'];
        
        if ($login_user_role == 2 || $login_user_role == 7){
            $team_members = $employee->team_members_for_employee_report($login_user);
            $team_employee_data = '\'' . implode('\',\'', $team_members) . '\'';
        }

        if ($login_user_role == 3 || $login_user_role == 2 || $login_user_role == 7){
            $cust_query = "SELECT customer
                            FROM team
                            WHERE employee = '$login_user' ";
        }
        
        
        // qry1 gets all public notes (and admin-only files -when login-user = 1)
        /*$qry1 = "SELECT count(DISTINCT n.id) as unread_note_count
                                FROM `note` AS n
                                LEFT JOIN `mc_note` AS mcn ON ( mcn.note_id = n.id )
                                WHERE (mcn.read_users NOT LIKE '%$login_user%' OR mcn.note_id IS NULL) 
                ";*/
        $qry1 = "SELECT n.id
                FROM `note` AS n
                WHERE 1
                ";
        
        if ($login_user_role == 1){
            $qry1 .=' AND ( n.visibility = 1 OR  n.visibility = 4)';
        }else{
            $qry1 .=" AND ( n.status = 1 OR  n.created_user = '$login_user')";
            if($office_personal_flag == 1)
                $qry1 .=" AND ( n.visibility = 1 OR n.visibility = 4 )";
            else
                $qry1 .=" AND ( n.visibility = 1 )";
        }  
        
        //**************************************************************************
        //qry2 gets specified private notes
        $qry2 = "SELECT n.id
                FROM `note` AS n
                WHERE 1
                ";
        switch ($login_user_role) {
            case 1:
                if($office_personal_flag == 1)
                    $qry2 .=" AND ( n.visibility = 2 OR  n.visibility = 3  OR n.visibility = 4 )";
                else
                    $qry2 .=" AND ( n.visibility = 2 OR  n.visibility = 3 )";
                break;
            case 2:
            case 7:
                $qry2 .=" AND ( n.status != 0 OR  n.created_user = '$login_user')
                                    AND n.customer IN ($cust_query)
                                    AND n.created_user IN ($team_employee_data)";
                    
                if($office_personal_flag == 1 || $login_user_role == 7)
                    $qry2 .=" AND ( n.visibility = 2 OR  n.visibility = 3  OR n.visibility = 4 )";
                else
                    $qry2 .=" AND ( n.visibility = 2 OR  n.visibility = 3 )";
                break;
            case 3:
                $qry2 .=" AND ( n.status = 1 OR  n.created_user = '$login_user')
                                    AND n.customer IN ($cust_query)";
                    
                if($office_personal_flag == 1)
                    $qry2 .=" AND ( n.visibility = 2 OR  n.visibility = 3  OR n.visibility = 4 )";
                else
                    $qry2 .=" AND ( n.visibility = 2 OR  n.visibility = 3 )";
                break; 
        }
        
        $this->flush();
        $this->sql_query = "SELECT count(DISTINCT nu.id) as unread_note_count
                                FROM ( ( $qry1 ) UNION ALL ( $qry2 ) ) as nu
                                    
                                LEFT JOIN `mc_note` AS mcn ON ( mcn.note_id = nu.id )
                                WHERE (mcn.read_users NOT LIKE '%$login_user%' OR mcn.note_id IS NULL) 
                ";

        $data = $this->query_fetch();
//        echo "<pre>".print_r($this->query_error_details, 1)."</pre>";
//        echo "<pre>".print_r($data, 1)."</pre>";
        return (!empty($data) ? $data[0]['unread_note_count'] : 0);
    }


    function document_archive_get_unread(){
        $this->sql_query = "SELECT count(da.id) as unread_count FROM document_archive da LEFT JOIN mc_document_archive mda ON mda.document_id = da.id AND mda.user = '". $_SESSION['user_id'] ."' WHERE mda.document_id IS NULL AND da.employee != '". $_SESSION['user_id'] ."' AND da.users LIKE '%". $_SESSION['user_id']."%'";
        $data = $this->query_fetch();
        return $data[0]['unread_count'];
    }


}
?>