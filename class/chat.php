<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of chat
 *
 * @author Shamsudheen
 */

//require_once('configs/config.inc.php');
require_once('class/db.php');
require_once('class/user.php');
require_once ('class/employee.php');
require_once ('class/customer.php');

class chat extends db {

    function __construct() {

        parent::__construct();
    }

    function online_employee_list() {
//        echo 'welcome';
        $user = new user();
        $employee = new employee();
        $customer = new customer();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
//        echo $_SESSION['company_id'];
//        echo "<pre>".print_r(array($login_user, $_SESSION['company_id']), 1)."</pre>";
        switch ($login_user_role) {

            case 1:
                $this->tables = array($this->db_master. '.login');
                $this->fields = array('username as u_name', 'role');
                $this->conditions = array('AND', 'login = 1','role in (1,2,3,4,5,6,7)','username != ?',array('OR','company_ids like ?','company_ids like ?'));
                $this->condition_values = array($login_user, $_SESSION['company_id'].',%', '%,'.$_SESSION['company_id'].',%');
                break;
            case 2:
            case 3:
                $team_members = $this->team_members_for_chatting($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                
                $this->tables = array($this->db_master. '.login');
                $this->fields = array('username as u_name', 'role');
                $this->conditions = array('AND', 'login = 1','role in (1,2,3,4,5,6,7)','username != ?',array('IN', 'username', $team_employee_data));
                $this->condition_values = array($login_user);
                break;
            case 4:
                $this->tables = array('team');
                $this->fields = array('employee');
                $this->conditions = array('customer = ?');
                $this->condition_values = array($login_user);
                $this->query_generate();
//                $team_employees = $this->sql_query;
                $team_members = $this->query_fetch(2);
//                print_r($team_members);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                
                $this->tables = array($this->db_master. '.login');
                $this->fields = array('username as u_name', 'role');
                $this->conditions = array('AND', 'login = 1','role in (1,2,3,4,5,6,7)','username != ?',array('IN', 'username', $team_employee_data));
                $this->condition_values = array($login_user);
                break;
            case 7:
                $team_members = $employee->super_team_members($login_user, 1);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                
                $this->tables = array($this->db_master. '.login');
                $this->fields = array('username as u_name', 'role');
                $this->conditions = array('AND', 'login = 1','role in (1,2,3,4,5,6,7)','username != ?',array('IN', 'username', $team_employee_data));
                $this->condition_values = array($login_user);
                break;
        }
        $this->query_generate();
//        echo $this->sql_query;
        $datas = $this->query_fetch();
        
        $updated_list = array();
        for($i=0 ; $i<count($datas); $i++){
            if($datas[$i]['role']== 1 || $datas[$i]['role']== 2 || $datas[$i]['role']== 3 || $datas[$i]['role']== 5 || $datas[$i]['role']== 6 || $datas[$i]['role']== 7){
//                echo $datas[$i]['u_name'];
                $full_name = $employee->get_employee_name('\''.$datas[$i]['u_name'].'\'');
                $updated_list[$i]['u_name'] = $datas[$i]['u_name'];
                $updated_list[$i]['emp_name'] = $full_name;
            }else if($datas[$i]['role']== 4){
                $cust_details = $customer->customer_detail($datas[$i]['u_name']);
                $full_name = $cust_details['first_name'] . " " . $cust_details['last_name'];
                $updated_list[$i]['u_name'] = $datas[$i]['u_name'];
                $updated_list[$i]['emp_name'] = $full_name;
            }
        }
//        print_r($updated_list);
//        if(!empty($updated_list)){
//            echo 'succes';
            return $updated_list;
//        else
//            return FALSE;
    }

    function team_members_for_chatting($username) {
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $cust_data = $this->query_fetch(2);
        if (count($cust_data)) {
            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $emp_data = $this->query_fetch(2);
            $data = array_merge($emp_data, $cust_data);
            return $data;
        } else {
            $emp_data = array('employee' => $username);
            return $emp_data;
        }
    }
    
    function get_not_received_chats() {
        //$sql = "select * from chat where (chat.to = '" . mysql_real_escape_string($_SESSION['user_id']) . "' AND recd = 0) order by id ASC";
        $this->tables = array('chat');
        $this->fields = array('id', 'from_chat', 'to_chat', 'message', 'sent', 'recd');
        $this->conditions = array('AND', 'to_chat = ?','recd = 0');
        $this->condition_values = array($_SESSION['user_id']);
        $this->order_by = array('id ASC');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function update_chat_received_flag() {
        //$sql = "update chat set recd = 1 where chat.to = '" . mysql_real_escape_string($_SESSION['user_id']) . "' and recd = 0";
        $this->tables = array('chat');
        $this->fields = array('recd');
        $this->field_values = array('1');
        $this->conditions = array('AND', 'to_chat = ?','recd = 0');
//        $this->condition_values = array(mysql_real_escape_string($_SESSION['user_id']));
        $this->condition_values = array($_SESSION['user_id']);
        if($this->query_update())
            return TRUE;
//            echo "<script>alert(\"Success\");</script>";
        else
//            echo "<script>alert(\"Failed\");</script>";
            return FALSE;
    }

    function insert_new_chat($from, $to, $message) {
        //$sql = "insert into chat (chat.from,chat.to,message,sent) values ('" . mysql_real_escape_string($from) . "', '" . mysql_real_escape_string($to) . "','" . mysql_real_escape_string($message) . "',NOW())";
        $this->tables = array('chat');
        $this->fields = array('from_chat', 'to_chat', 'message');
//        $this->field_values = array(mysql_real_escape_string($from),mysql_real_escape_string($to),mysql_real_escape_string($message));
        $this->field_values = array($from,$to,$message);
        if($this->query_insert())
            return TRUE;
//            echo "<script>alert(\"Success\");</script>";
        else
//            echo "<script>alert(\"Failed\");</script>";
            return FALSE;
    }

    
}

?>
