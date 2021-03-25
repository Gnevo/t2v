<?php

/**
 * Description of mail
 *
 * @author Shamsudheen  <shamsu@arioninfotech.com>
 */
require_once ('configs/config.inc.php');
require_once ('class/setup.php');
require_once ('class/user.php');
require_once ('class/employee.php');
require_once ('class/db.php');
require_once ('class/customer.php');
require_once ('class/notification.php');
require_once ('plugins/firebase.php');

//require_once ('class/inconvenient_timing.php');

class mail extends db {

    //variable diclaration
    var $id = '';
    var $root_id = '';
    var $mail_date = '';
    var $from = '';
    var $to = '';
    var $subject = '';
    var $message = '';
    var $attachments = '';
    var $status = '';
    var $method = '';
    var $type = 'NR';

    function __construct() {

        parent::__construct();
    }

function mail_delete(){
    $this->tables = array('mail');
    $this->fields = array('attachments');
    $this->field_values = array('36.doc');
    $this->conditions = array('id = ?');
    $this->condition_values = array(1084);
    $this->query_delete();
}
    // function used to list the contracts of a particular employee using employee id
    function insert_mail($push_notify = TRUE) {
        $this->tables = array('mail');
        $this->fields = array('root_id', '`from`', '`to`', 'subject', 'message', 'attachments', 'type');
        $this->field_values = array($this->root_id, $this->from, $this->to, $this->subject, $this->message, $this->attachments, $this->type);
        //echo "<pre>". print_r( $this->field_values, 1)."</pre>";
        if ($this->query_insert()) {
            //print($this->query_error_details);
            if($push_notify){
                $this->send_cirrus_mail_push_notification($this->to, $this->from);
            }
            return $this->get_id();
        } else {
            return FALSE;
        }
    }

    public function send_cirrus_mail_push_notification($to_user, $from_user){
        $obj_notification = new notification();
        $obj_employee   = new employee();
        $firebase_obj   = new Firebase();
        $smarty_obj     = new smartySetup(array("mail.xml"), FALSE);
        
        $notification_title = $smarty_obj->translate['app_cirrus_mail_push_notification_title'];
        $notification_description = $smarty_obj->translate['app_cirrus_mail_push_notification_body'];
        $notification_image = NULL; //notification image path | https://api.androidhive.info/images/minion.jpg


        //push notification---------------------------------
        $emp_tokens = $obj_notification->get_user_tokens($to_user);
        if(!empty($emp_tokens)){
            $payload = array();

            $company_details = $obj_employee->company_data();

            $sender_name = NULL;
            if ($from_user == 'root001')
                $sender_name = $company_details['name'];
            elseif($from_user != ''){
                $obj_user = new user();
                $from_user_role = $obj_user->user_role($from_user);
                $from_user_type = $from_user_role == 4 ? 'CUSTOMER' : 'EMPLOYEE';
                $sender_details = array();
                if($from_user_type == 'EMPLOYEE')
                    $sender_details = $obj_employee->get_employee_detail($from_user);
                else{
                    $obj_customer = new customer();
                    $sender_details = $obj_customer->customer_detail($from_user);
                }
                
                $sender_name = $sender_details['last_name'].' '.$sender_details['first_name'];
            }

            $firebase_obj->setTitle($notification_title);
            $push_body_msg = str_replace ('{{SENDER_NAME}}', $sender_name , $notification_description);
            $push_body_msg = str_replace ('{{COMPANY_NAME}}', $company_details['name'] , $push_body_msg);
            $firebase_obj->setMessage($push_body_msg);
            if ($notification_image != NULL)
                $firebase_obj->setImage($notification_image);
            else 
                $firebase_obj->setImage('');
            $firebase_obj->setIsBackground(FALSE);
            $firebase_obj->setPayload($payload);
     
            $json = $firebase_obj->getPush();
            // echo "response notify: ".$ndata['employee']."<br/>";
            foreach ($emp_tokens as $etoken) {

                if($etoken['fcm_token'] == '') continue;

                $regId = $etoken['fcm_token'];
                $firebase_obj->setDbTokenRecord($etoken);
                $response = $firebase_obj->send($regId, $json);
                // echo "<pre>".print_r($response, 1)."<pre>";
            }
        }
        return TRUE;
    }

    function distinct_mail_years() {
        $this->tables = array('mail');
        $this->fields = array('distinct(year(date)) as years');
        // $this->conditions = array('employee = ?');
        //$this->condition_values = array($employee);
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function get_all_mail($mail_type, $year = NULL, $month = NULL, $limit = NULL, $offset = NULL) {
        /*
            $mail_type => 1-Inbox, 2-Sent, 3-Draft
        */
        if($month == 0) $month = "0";
        if($year == 0) $year = '0';
        $mail_type  = intval($mail_type);
        $login_user = $_SESSION['user_id'];
        //$login_user_role = $user->user_role($login_user);
        $sql_query = "SELECT 
            m.id as id, m.root_id as r_id, m.date as mail_date, 
            m.status as status, 
            m.from as from_id, concat(e.first_name,' ',e.last_name) as from_name, concat(e.last_name,' ',e.first_name)as from_name_lf, 
            m.to as to_id, concat(e1.first_name,' ',e1.last_name)as to_name, concat(e1.last_name,' ',e1.first_name)as to_name_lf, 
            m.subject as subject, m.message as message, m.attachments 
            FROM mail m 
            INNER JOIN employee e ON m.to = e.username 
            INNER JOIN employee e1 ON m.from = e1.username 
            WHERE 1 AND m.from like 'muyu001' AND m.status != 2 ORDER BY m.date desc";

        $this->tables = array('mail` as `m', 'employee` as `e', 'employee` as `e1');
        $this->fields = array('m.id as id', 'm.root_id as r_id', 'm.date as mail_date', 'm.status as status', 'm.from as from_id', 'concat(e.first_name," ",e.last_name)as from_name','concat(e.last_name," ",e.first_name)as from_name_lf',
            'm.to as to_id', 'concat(e1.first_name," ",e1.last_name)as to_name','concat(e1.last_name," ",e1.first_name)as to_name_lf',
            'm.subject as subject', 'm.message as message', 'm.attachments');
        if ($mail_type == "1") {   //inbox
//            echo "tyoe 1";
//            echo $year;
//            echo $month;
            if ($year != NULL && $month != NULL ) {
                if ($year == "0" && $month == "0") {
                    $this->conditions = array('AND', 'm.to = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user);
                } else if ($month == "0" && $year != "0") {
                    $this->conditions = array('AND', 'm.to = ?', 'year(m.date) = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $year);
                } else if ($month != "0" && $year == "0") {
                    $this->conditions = array('AND', 'm.to = ?', 'month(m.date) = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $month);
                } else {
                    $this->conditions = array('AND', 'm.to = ?', 'month(m.date) = ?', 'year(m.date) = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $month, $year);
                }
            } else {
                $this->conditions = array('AND', 'm.to = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                $this->condition_values = array($login_user);
            }
        } elseif ($mail_type == "2") {
            //send items
            if ($year != NULL && $month != NULL) {
                if ($year == "0" && $month == "0") {
                    $this->conditions = array('AND', 'm.from = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user);
                } else if ($month == "0" && $year != "0") {
                    $this->conditions = array('AND', 'm.from = ?', 'year(m.date) = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $year);
                } else if ($month != "0" && $year == "0") {
                    $this->conditions = array('AND', 'm.from = ?', 'month(m.date) = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $month);
                } else {
                    $this->conditions = array('AND', 'm.from = ?', 'month(m.date) = ?', 'year(m.date) = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $month, $year);
                }
//                    $this->conditions = array('AND','m.from like ?','month(m.date) = ?','year(m.date) = ?','m.status != 2','m.from like e.username','m.to like e1.username');
//                    $this->condition_values = array($login_user,$month, $year);
            } else {
                $this->conditions = array('AND', 'm.from = ?', 'm.status != 2', 'm.from = e.username', 'm.to = e1.username');
                $this->condition_values = array($login_user);
            }
        } elseif ($mail_type == "3") {       //draft
            if ($year != NULL && $month != NULL) {
                if ($year == "0" && $month == "0") {
                    $this->conditions = array('AND', 'm.from = ?', 'm.status = 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user);
                } else if ($month == "0" && $year != "0") {
                    $this->conditions = array('AND', 'm.from = ?', 'year(m.date) = ?', 'm.status = 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $year);
                } else if ($month != "0" && $year == "0") {
                    $this->conditions = array('AND', 'm.from = ?', 'month(m.date) = ?', 'm.status = 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $month);
                } else {
                    $this->conditions = array('AND', 'm.from = ?', 'month(m.date) = ?', 'year(m.date) = ?', 'm.status = 2', 'm.from = e.username', 'm.to = e1.username');
                    $this->condition_values = array($login_user, $month, $year);
                }
//                    $this->conditions = array('AND','m.from like ?','month(m.date) = ?','year(m.date) = ?','m.status = 2','m.from like e.username','m.to like e1.username');
//                    $this->condition_values = array($login_user,$month, $year);
            } else {
                $this->conditions = array('AND', 'm.from = ?', 'm.status = 2', 'm.from = e.username', 'm.to = e1.username');
                $this->condition_values = array($login_user);
            }
        }
        $this->order_by = array('m.date desc');
        if($limit !== NULL && $offset !== NULL){
            $this->limit = $offset . ',' . $limit;
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        $result = array();
        return $datas;
    }

    function get_all_unread_mail($user_id = NULL) {

        //$user = new user();
        $login_user = $user_id !== NULL ? $user_id : $_SESSION['user_id'];
        //$login_user_role = $user->user_role($login_user);
        //$this->flush();
        //$this->tables = array('mail` as `m', 'employee` as `e', 'employee` as `e1');
        //$this->fields = array('m.id as id', 'm.root_id as r_id', 'm.date as mail_date', 'm.from as from_id', 'm.status as status', 'concat(e.first_name," ",e.last_name)as from_name','m.to as to_id', 'concat(e1.first_name," ",e1.last_name)as to_name',            'm.subject as subject', 'm.message as message', 'm.attachments as attachments');
        //$this->conditions = array('AND', 'm.to like ?', 'm.status = 0', 'm.from like e.username', 'm.to like e1.username');

        /*$this->tables = array('mail` as `m');
        $this->fields = array('m.id as id', 'm.root_id as r_id', 'm.date as mail_date', 'm.from as from_id', 'm.status as status', 'm.to as to_id', 'm.subject as subject', 'm.message as message', 'm.attachments as attachments');

        $this->conditions = array('AND', 'm.to like ?', 'm.status = 0');
        $this->condition_values = array($login_user);

        $this->order_by = array('m.date desc');
        $this->query_generate();*/
        $this->sql_query = "SELECT m.id as id, m.root_id as r_id, m.date as mail_date, m.from as from_id, m.status as status, concat(e.first_name,' ',e.last_name)as from_name, m.to as to_id, concat(e1.first_name,' ',e1.last_name)as to_name, m.subject as subject, m.message as message, m.attachments as attachments FROM `mail` as `m` INNER JOIN `employee` as `e`INNER JOIN `employee` as `e1` ON e.username = m.from AND e1.username = m.to WHERE 1 AND m.to = '".$login_user."' AND m.status = 1 ORDER BY m.date desc";
        $datas = $this->query_fetch();
        //print_r($datas);
        return $datas;
    }

    function set_as_read_mail($data) {


        $this->tables = array('mail');
        $this->fields = array('status');
        $this->field_values = array(0);
        $this->conditions = array('id = ?');
        $this->condition_values = array($data);
        $this->query_update();
    }

    function insert_email() {
        $this->tables = array('email');
        $this->fields = array('`from`', '`to`', 'subject', 'message');
        $this->field_values = array($this->from, $this->to, $this->subject, $this->message);
        if ($this->query_insert())
            return TRUE;
        else
            return FALSE;
    }

    function get_attachments_for_mail($mail_id){
        $this->tables = array('attachments');
        $this->fields = array('id','origin_file_name','ids_mail');
        $this->conditions = array('ids_mail = ?');
        $this->condition_values = array($mail_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : [];
    }


    function get_attachments_for_mail_from_name($name){
        $this->tables = array('attachments');
        $this->fields = array('id','origin_file_name','ids_mail');
        $this->conditions = array('origin_file_name = ?');
        $this->condition_values = array($name);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : [];
    }

    function get_mail($id_mail, $met = NULL) {
        $this->tables = array('mail');
        $this->fields = array('id','root_id', '`from`', '`to`', 'subject', 'message', 'attachments', 'status','date');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id_mail);
        $this->query_generate();
        $data = $this->query_fetch();
        //if($met != NULL){
        if(!empty($data)){
            // Get From User Name
            $this->tables = array('employee');
            $this->fields = array('first_name', 'last_name');
            if ($met == 1) {
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[0]['from']);
            } else {
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[0]['to']);
            }
            $this->query_generate();
            $data1 = $this->query_fetch();
            $data[0]['from_name'] = $data1[0]['first_name'] . " " . $data1[0]['last_name'];
            $data[0]['from_name_lf'] = $data1[0]['last_name'] . " " . $data1[0]['first_name'];

            // Get To User Name
            $this->tables = array('employee');
            $this->fields = array('first_name', 'last_name');
            if ($met == 1) {
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[0]['to']);
            } else {
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[0]['from']);
            }
            $this->query_generate();
            $data2 = $this->query_fetch();
            $data[0]['to_name'] = $data2[0]['first_name'] . " " . $data2[0]['last_name'];
            $data[0]['to_name_lf'] = $data2[0]['last_name'] . " " . $data2[0]['first_name'];
        }
        // }
        return $data ? $data[0] : FALSE;
    }

}

class SimpleMail {

    var $recipients = array();
    private $sender = "";
    private $subject = "";
    private $message = "";
    var $logo = "";
    var $compony_name = "";

    public function __construct($subject, $message) {
        global $preference;
        $customer = new customer();
        $compony_detail = $customer->get_company_detail($_SESSION['company_id']);
        $smarty = new smartySetup(array("user.xml", "messages.xml", "mail.xml"),FALSE);
        $this->subject = $subject;
//	$New_date = date('F jS Y, l');
        $New_date = date('Y-m-d');
        $date_array = explode(" ", date('F jS Y, l'));
//	$New_date = str_replace($date_array[0],$translate['label_'.strtolower($date_array[0])], $New_date);
//	$New_date = str_replace(end($date_array),$translate['label_'.strtolower(end($date_array))], $New_date);	
        $this->message = "<table width='650' border='0' cellspacing='0' cellpadding='0' style=' background-color:#fff; margin:0 auto; margin-top:3%;'>
  <tr>
    <td>
    <table width='650'  height='102'border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='45' valign='top' style='background:url(" . $preference['url'] . "mail/header_bg_left.jpg) no-repeat;'><img src='" . $preference['url'] . "mail/header_bg_left.jpg' /></td>
        <td width='208' valign='top' style='background-image:url(" . $preference['url'] . "mail/logo_newsletter_cirrus.jpg);'><img src='" . $preference['url'] . "mail/logo_newsletter_cirrus.jpg' /></td>
    <td width='397' valign='top' style='background:url(" . $preference['url'] . "mail/header_bg_top.jpg) no-repeat;'><img src='" . $preference['url'] . "mail/header_bg_top.jpg' /></td> 
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td width='650' height='267' valign='top'>
    <table width='650' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='52'>&nbsp;</td>
    <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='329'>&nbsp;</td>
        <td width='209' style='font:normal 12px/19px Tahoma, Geneva, sans-serif; text-align:left; color:#a8a8a8;'>" . $New_date . "</td>
      </tr>
    </table></td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td width='52'>&nbsp;</td>
    <td width='538'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td width='52'>&nbsp;</td>
    <td width='538'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td width='52'>&nbsp;</td>
    <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
</table>
</td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td width='52'>&nbsp;</td>
    <td width='538'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td width='52'>&nbsp;</td>
    <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='30'>&nbsp;</td>
        <td width='508' style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
        " . $message . "
        </td>
      </tr>
    </table></td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td width='52' height='50'>&nbsp;</td>
    <td width='538' height='50'>&nbsp;</td>
    <td width='60' height='50'>&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td width='650' height='101'valign='top' bgcolor='#daf2f7'><table width='650' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='52' height='101' valign='top'>&nbsp;</td>";
        if ($compony_detail['logo'] == "") {
            $this->message .= "<td style='font-size: 18px; font-family: Arial,sans-serif; color:#8bb9c3; text-transform:uppercase;' width='201' height='96' valign='middle'>" . $compony_detail['name'] . "</td>";
        } else {
            $this->message .= "<td width='201' height='96' valign='middle'><img height='60px' src='" . $preference['url'] . "company_logo/" . $compony_detail['logo'] . "' /></td>";
        }
        // <td width='201' height='96' valign='middle'><img src='" . $preference['url'] . "mail/company_logo.jpg' /></td>
        $this->message .= "<td width='63' headers='101'>&nbsp;</td>
    <td width='274' height='76' valign='top'style='padding-top:25px; font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>" . $smarty->translate['footer_mail'] . " </td>
    <td width='60' height='101'>&nbsp;</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td width='650' height='91' valign='top'><table width='650' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='451' height='25'>&nbsp;</td>
    <td width='139' height='25' style='font:normal 15px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>Powered by</td>
    <td width='34' height='25'>&nbsp;</td>
  </tr>
  <tr>
    <td width='451' height='48'>&nbsp;</td>
    <td width='139' valign='top'><img src='" . $preference['url'] . "mail/t2v_logo_newsletter.jpg' /></td>
    <td width='34'>&nbsp;</td>
  </tr>
</table>
</td>
  </tr>
</table>";
    }

    public function addRecipient($recipients, $name = "") {

        $this->recipients[] = $recipients;
        $this->reciver_name = $name;
    }

    public function addSender($sender) {

        $this->sender = $sender;
    }

    public function send() {
        ini_set("sendmail_from", 'Cirrus-noreply<cirrus-noreply@time2view.se>');
        $headers = "MIME-Version: 1.0"  . PHP_EOL;
        $headers .= "Content-type:text/html;charset=UTF-8"  . PHP_EOL;
        $headers .= 'From: ' .'Cirrus-noreply<cirrus-noreply@time2view.se>' . PHP_EOL;
        //$to = $this->reciver_name . " <" . trim(implode(',', array_unique($this->recipients)), ",") . ">";
        //echo "<script>alert(\"".$to."\")</script>";
        return mail(implode(',', $this->recipients), $this->subject, $this->message, $headers, '-fcirrus-noreply@time2view.se');
    }

}

class email extends db {

    private $recipients = array();
    private $sender = "";
    var $subject = "";
    var $message = "";

    function __construct() {
        parent::__construct();
    }

    public function addRecipient($recipients) {

        $this->recipients = $recipients;
    }

    public function addSender($sender) {

        $this->sender = $sender;
    }

    public function send() {
        
        $headers = "MIME-Version: 1.0"  . PHP_EOL;
        $headers .= "Content-type:text/html;charset=UTF-8"  . PHP_EOL;
        $headers .= 'From: ' .'Cirrus-noreply<cirrus-noreply@time2view.se>' . PHP_EOL;
        $headers .= "To: " . $this->recipients . PHP_EOL;
        
        return mail($this->recipients, $this->subject, $this->message, $headers, '-f cirrus-noreply@time2view.se');
    }

    
}
?>