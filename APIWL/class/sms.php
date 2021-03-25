<?php
/**
 * Description of sms
 * @author dona
 */
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/db.php');


class sms extends db {

    var $recipients = array();
    var $message = '';
    var $tag = false;
    var $callback = false;
    var $debug = false; // Change this to true to only emulate sending messages. This will also dump the $senders array on send.
    var $login_user  = '';
    var $sender;

    function __construct($message = '') {
        
        parent::__construct();
        $this->message = $message;
        $this->sender = 72323;
    }

    function cleanNumber($number) {

        $number = preg_replace('/[\s\-]/', '', $number);
        $number = preg_replace('/^0/', '', $number);
        return $number;
    }
    
    function clearRecipients(){
        $this->recipients = array();
    }

    function addRecipient($number) {
       if($number) 
        $this->recipients[] = $this->cleanNumber($number);
    }

    function setTag($tag) {

        $this->tag = $tag;
    }

    function setCallback($url) {

        $this->callback = $url;
    }

    function send() {
        
        global $sms;
        $senders = array();
        //$sender = '72323';//$sms['sender']; // Global number.
        
        foreach ($this->recipients as $recipient) {
            $senders[$sender][] = '46' . $recipient;
           // $senders[] = '46' . $recipient;
            $this->tables = array('employee');
            $this->fields = array('username');
            $this->conditions = array('mobile = ?');
            $this->condition_values = array($recipient);
            $this->query_generate();
            $datas_emp = $this->query_fetch();
            if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')
                $this->login_user = $_SESSION['user_id'];
            $send_user = 'unknown';
            if(!empty($datas_emp)){
                $send_user = $datas_emp[0]['username'];
            }
            //echo "I am in sms <br>";
            $this->update_sms_log($this->login_user, $send_user, $recipient, $this->message, 1);
            //print_r($this->query_error_details);   
        }
        if ($this->debug) {
            echo "<pre>".print_r($senders, 1)."</pre>";
            return true;
        }
        
        /*foreach ($senders as $sender => $foo) {
            
            
            file_get_contents('http://smsserver.pixie.se/sendsms' .
                    '?account=' . $sms['username'] .
                    '&pwd=' . $sms['password'] .
                    '&receivers=' . implode(',', $senders[$sender]) .
                    '&sender=' . $this->sender .
                    '&message=' . urlencode($this->message) .
                    '&quality=2' .
                    '&reply_to_client=yes' .
                    ($this->tag != false ? '&tag=' . $this->tag : '') .
                    ($this->callback != false ? '&callback=' . $this->callback : '')
            );
        }*/

        return true;
    }
    
    function send_export($sending_user = '') {
        if($sending_user == '')
            $sending_user = $_SESSION['user_id'];
        $smarty = new smartySetup(array('mail.xml'), FALSE);
        global $sms;
        $senders = array();
        $sender = '72323';//$sms['sender']; // Global number.
        foreach ($this->recipients as $recipient) {
            
           // $senders[] = '46' . $recipient;
            $this->tables = array('employee');
            $this->fields = array('username','first_name','last_name');
            $this->conditions = array('mobile = ?');
            $this->condition_values = array($recipient);
            $this->query_generate();
            $datas_emp = $this->query_fetch();
            if(!empty($datas_emp)){
                $senders[$sender][] = array("number"=>'46' . $recipient,"message"=> $smarty->translate['label_hi']." ".$datas_emp[0]['last_name']." ".$datas_emp[0]['first_name']." ".$this->message);
                $this->update_sms_log($sending_user, $datas_emp[0]['username'], $recipient, $this->message, 1);
                
            }    
        }
        if ($this->debug) {
            echo "<pre>".print_r($senders, 1)."</pre>";
            return true;
        }
        
        /*foreach ($senders as $sender => $foo) {
            foreach($foo as $details){
                $this->message = $details['message'];
                file_get_contents('http://smsserver.pixie.se/sendsms' .
                        '?account=' . $sms['username'] .
                        '&pwd=' . $sms['password'] .
                        '&receivers=' . $details['number'] .
                        '&sender=' . $sender .
                        '&message=' . urlencode($this->message) .
                        '&quality=2' .
                        '&reply_to_client=yes' .
                        ($this->tag != false ? '&tag=' . $this->tag : '') .
                        ($this->callback != false ? '&callback=' . $this->callback : '')
                );
           }
        }*/
        return true;
    }


    function send_password_otp($to_user, $to_user_company) {
        
        global $sms;
        $senders = array();
        //$sender = '72323';//$sms['sender']; // Global number.
        
        foreach ($this->recipients as $recipient) {
            $senders[$sender][] = '46' . $recipient;
           // $senders[] = '46' . $recipient;
            $send_user = 'unknown';
            $this->update_sms_log($send_user, $to_user, $recipient, $this->message, 1, $to_user_company);
            //print_r($this->query_error_details);   
        }
        if ($this->debug) {
            echo "<pre>".print_r($senders, 1)."</pre>";
            return true;
        }
        
        /*foreach ($senders as $sender => $foo) {
            
            
            file_get_contents('http://smsserver.pixie.se/sendsms' .
                    '?account=' . $sms['username'] .
                    '&pwd=' . $sms['password'] .
                    '&receivers=' . implode(',', $senders[$sender]) .
                    '&sender=' . $this->sender .
                    '&message=' . urlencode($this->message) .
                    '&quality=2' .
                    '&reply_to_client=yes' .
                    ($this->tag != false ? '&tag=' . $this->tag : '') .
                    ($this->callback != false ? '&callback=' . $this->callback : '')
            );
        }*/

        return true;
    }
    
    function update_sms_log($from, $to_user, $to_number, $message, $status, $company_db = NULL){
        
        if($to_number){
            if($company_db != NULL)
                $this->tables = array($company_db . '.log_sms');
            else
                $this->tables = array('log_sms');
            $this->fields = array('from_user', 'to_user', 'to_no', 'message', 'status');
            $this->field_values = array($from, $to_user, $to_number, $message, $status);
            return $this->query_insert();
        }else
            return true;
            
    }
    
    function update_sms_log_incomming($from, $message){
        $this->tables = array('log_sms_incomming');
        $this->fields = array('from_user', 'message');
        $this->field_values = array($from, $message);
        return $this->query_insert();
    }
    
    function distinct_sms_log_years(){
        $this->tables = array('log_sms');
        $this->fields = array('distinct(year(date)) as years');
//        $this->order_by= array('years desc');
        $this->query_generate();
        $og_sms_year_query = $this->sql_query;
        
        $this->flush();
        $this->tables = array('log_sms_incomming');
        $this->fields = array('distinct(year(date)) as years');
//        $this->order_by= array('years desc');
        $this->query_generate();
        $ic_sms_year_query = $this->sql_query;
        
        $this->sql_query = "($og_sms_year_query) UNION ($ic_sms_year_query) ORDER BY years DESC";
        $datas = $this->query_fetch(2);
        return $datas;
    }
    
    function get_all_incoming_sms($year, $month){
        if($year == '' || $month == '')            return array();
        $this->tables = array('log_sms_incomming` as `si', 'employee` as `e');
        $this->fields = array('si.id', 'si.from_user', 'si.message', 'si.date', 'e.first_name', 'e.last_name', 'e.mobile');
        $this->conditions = array('AND', 'year(si.date) = ?', 'month(si.date) = ?', 'e.username = si.from_user');
        $this->condition_values = array($year, $month);
        $this->order_by= array('si.date desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    function get_all_outgoing_sms($year, $month){
        if($year == '' || $month == '')            return array();
        $this->tables = array('log_sms` as `s', 'employee` as `e');
        $this->fields = array('s.id', 's.to_user', 's.to_no', 's.message', 's.date', 'e.first_name', 'e.last_name', 'e.mobile');
        $this->conditions = array('AND', 'year(s.date) = ?', 'month(s.date) = ?', 'e.username = s.to_user');
        $this->condition_values = array($year, $month);
        $this->order_by= array('s.date desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
}
?>