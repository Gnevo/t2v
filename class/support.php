<?php

/**
 * Description of timetable
 * @author shamsudheen <shamsu@arioninfotech.com>
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once('class/user.php');
require_once ('class/employee.php');
require_once ('class/customer.php');
require_once ('class/notes.php');

class support extends db {

    //variable declaration
    var $id = '';
    var $login_user = '';
    var $admin_user = '';
    var $ticket_type = '';
    var $category_id = '';
    var $priority = '';
    var $title = '';
    var $description = '';
    var $attachment = '';
    var $affected_user = '';
    var $affected_user_phone = '';
    var $answer = '';
    var $status = '';
    var $hidden = 0;
    var $to = NULL;
    var $subject = NULL;
    var $textMessage = NULL;
    var $headers = NULL;
    var $recipients = NULL;
    var $cc = NULL;
    var $cco = NULL;
    var $from = NULL;
    var $replyTo = NULL;
    var $attachments = array();

    function __construct() {
        parent::__construct();
    }

    function insert_ticket() {

        $this->tables = array('support_tickets');
        $this->fields = array('created_user', 'admin_user', 'ticket_type', 'category_id', 'priority', 'title', 'description', 'attachment', 'status', 'affected_user', 'affected_user_phone');
        $this->field_values = array($this->login_user, $this->admin_user, $this->ticket_type, $this->category_id, $this->priority, $this->title, $this->description, NULL, $this->status, $this->affected_user, $this->affected_user_phone);
        if ($this->query_insert()) {
            
            $id = $this->get_id();
            global $preference, $support_priority, $support_status, $support_ticket_type, $cirrus_support, $cirrus_admins;
            $ticket_id = $id;
            $ticket_data = $this->get_ticket_details($ticket_id);
            $this->append_ticket_attachments($id);
            $category_data = $this->get_support_category_details($ticket_data['category_id']);
            if ($category_data['type'] == 'Internal') {
                $notes = new notes();
                $notes->login_user = $this->login_user;
                $notes->customer = NULL;
                $notes->title = $this->title;
                $notes->description = $this->description;
                $notes->visibility = 4; //only for admin
                $notes->status = 1;
                $notes->ticket = $id;
                if ($notes->insert_note()) {
                    //nothing
                }
            }

            /*             * *******************************************
             * *
             * *   Send a new ticket notification to the admin
             * *
             * ******************************************* */

            $user_data = $this->get_created_user_details($ticket_data['created_user']);
            $affected_user_data = $this->get_created_user_details($ticket_data['affected_user']);
            $base_url = $preference['url'];
            if ($category_data['type'] == 'Internal') {
                $admin_data = $this->get_employee_detail($ticket_data['admin_user']);
                $url = $base_url . 'tickets/detail/' . $ticket_id . '/';
            } else {
                $admin_data = $cirrus_support;
                $admin_data['username'] = $cirrus_admins[0];
                $url = $base_url . 'tickets/detail/' . $ticket_id . '/' . $_SESSION['company_id'] . '/';
            }
            $link = "<a href='$url'>$url</a>";
            $admin_user_email = utf8_encode($admin_data['email']);
            $created_user = utf8_encode($ticket_data['created_user']);
            $created_user_email = utf8_encode($user_data['email']);
            $created_username = utf8_encode($user_data['first_name'] . ' ' . $user_data['last_name']);
            $created_userphone = utf8_encode($user_data['phone']);
            $created_usermobile = utf8_encode($user_data['mobile']);
            $admin_userphone = utf8_encode($admin_data['phone']);
            $admin_usermobile = utf8_encode($admin_data['mobile']);
            $admin = utf8_encode($admin_data['username']);
            $admin_username = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
            $affected_user = utf8_encode($affected_user_data['username']);
            $affected_username = utf8_encode($affected_user_data['first_name'] . ' ' . $affected_user_data['last_name']);
            $affected_user_phone = utf8_encode($ticket_data['affected_user_phone']);
            $type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);
            $status = utf8_encode($support_status[$this->status]);
            $priority = utf8_encode($support_priority[$ticket_data['priority']]);
            $category = utf8_encode($ticket_data['category']);
            $date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
            $title = utf8_encode($ticket_data['title']);
            $description = utf8_encode($ticket_data['description']);


            $patterns = array();
            $patterns[0] = '/{id}/';
            $patterns[1] = '/{created_user}/';
            $patterns[2] = '/{created_username}/';
            $patterns[3] = '/{admin}/';
            $patterns[4] = '/{admin_username}/';
            $patterns[5] = '/{date}/';
            $patterns[6] = '/{type}/';
            $patterns[7] = '/{status}/';
            $patterns[8] = '/{category}/';
            $patterns[9] = '/{priority}/';
            $patterns[10] = '/{title}/';
            $patterns[11] = '/{description}/';
            $patterns[12] = '/{url}/';
            $patterns[13] = '/{created_userphone}/';
            $patterns[14] = '/{created_usermobile}/';
            $patterns[15] = '/{admin_userphone}/';
            $patterns[16] = '/{admin_usermobile}/';
            $patterns[17] = '/{affected_user}/';
            $patterns[18] = '/{affected_user_phone}/';
            $patterns[19] = '/{affected_username}/';


            $replacements = array();
            $replacements[0] = $ticket_id;
            $replacements[1] = $created_user;
            $replacements[2] = $created_username;
            $replacements[3] = $admin;
            $replacements[4] = $admin_username;
            $replacements[5] = $date;
            $replacements[6] = $type;
            $replacements[7] = $status;
            $replacements[8] = $category;
            $replacements[9] = $priority;
            $replacements[10] = $title;
            $replacements[11] = $description;
            $replacements[12] = $link;
            $replacements[13] = $created_userphone;
            $replacements[14] = $created_usermobile;
            $replacements[15] = $admin_userphone;
            $replacements[16] = $admin_usermobile;
            $replacements[17] = $affected_user;
            $replacements[18] = $affected_user_phone;
            $replacements[19] = $affected_username;


            if ($category_data['type'] == 'Internal') {
                //email to admin when posting a new ticket
                $email_model = $this->get_email_model(1);
            } else {
                //email to tech support admin when posting a new ticket
                $email_model = $this->get_email_model(5);
            }

            $emailSubject = utf8_encode($email_model['subject']);
            $emailBody = utf8_encode($email_model['body']);
            $emailFooter = utf8_encode($email_model['footer']);
            $senderName = utf8_encode($created_username);
            $sender = utf8_encode($created_user_email);

            $subject = preg_replace($patterns, $replacements, $emailSubject);
            $message = preg_replace($patterns, $replacements, $emailBody);
            $footer = preg_replace($patterns, $replacements, $emailFooter);
            $message .= "<br/><br/>" . $footer;

            $mailer = new SupportMailer();
            $mailer->setFrom($senderName, $sender);
            $mailer->addRecipient($admin_username, $admin_user_email);
            $mailer->fillSubject(utf8_decode($subject));
            $mailer->fillMessage(utf8_decode($message));
            $mailer->send();

            //email to user who post
            $email_model = $this->get_email_model(2);
            $emailSubject = utf8_encode($email_model['subject']);
            $emailBody = utf8_encode($email_model['body']);
            $emailFooter = utf8_encode($email_model['footer']);
            $senderName = utf8_encode($email_model['sender_name']);
            $sender = utf8_encode($email_model['sender']);

            $subject = preg_replace($patterns, $replacements, $emailSubject);
            $message = preg_replace($patterns, $replacements, $emailBody);
            $footer = preg_replace($patterns, $replacements, $emailFooter);
            $message .= "<br/><br/>" . $footer;

            $mailer = new SupportMailer();
            $mailer->setFrom($senderName, $sender);
            $mailer->addRecipient($created_username, $created_user_email);
            $mailer->fillSubject(utf8_decode($subject));
            $mailer->fillMessage(utf8_decode($message));
            $mailer->send();

            return $id;
        } else {
            return FALSE;
        }
    }

    function append_ticket_attachments($ticket_id, $old_attachment_string = '') {

        $attach_string = ($old_attachment_string != '' ? $old_attachment_string : '');
        //Get the temp file path
        $tmpFilePath = $this->attachment['tmp_name'];
        //Make sure we have a filepath
        if ($tmpFilePath != "") {
            $newName = strtotime(date("Y-m-d H:i:s")) . "_" . $this->attachment['name'];
            $newName = str_replace(" ", "_", $newName);
            $get_CompanyName = $this->get_company_name($_SESSION['company_id']);
            $app_dir = getcwd();
            if (!is_dir($app_dir . "/" . $get_CompanyName . "/")) {
                mkdir($app_dir . "/" . $get_CompanyName . "/", 0777);
            }
            if (!is_dir($app_dir . "/" . $get_CompanyName . "/tickets/")) {
                mkdir($app_dir . "/" . $get_CompanyName . "/tickets/", 0777);
            }
            if (!is_dir($app_dir . "/" . $get_CompanyName . "/tickets/attachment/")) {
                mkdir($app_dir . "/" . $get_CompanyName . "/tickets/attachment/", 0777);
            }

            $newFilePath = $app_dir . "/" . $get_CompanyName . "/tickets/attachment/" . $newName;

            //Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Handle other code here
            }
            $attach_string = $newName;
        }
        $this->tables = array('support_tickets');
        $this->fields = array('attachment');
        $this->field_values = array($attach_string);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ticket_id);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function update_ticket($ticket_id, $company_id = NULL) {

        $login_user = $_SESSION['user_id'];
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_tickets');
        } else {
            $this->tables = array('support_tickets');
        }
        $this->fields = array('admin_user', 'ticket_type', 'priority');
        $this->field_values = array($this->admin_user, $this->ticket_type, $this->priority);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ticket_id);
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_ticket_category_by_admin($ticket_id, $category_id, $company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_tickets');
        } else {
            $this->tables = array('support_tickets');
        }
        $this->fields = array('category_id');
        $this->field_values = array($category_id);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ticket_id);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function update_ticket_status() {
        $this->tables = array('support_tickets');
        $this->fields = array('status');
        $this->field_values = array($this->status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->id);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function update_ticket_attachment($attachment_string) {
        $this->tables = array('support_tickets');
        $this->fields = array('attachment');
        $this->field_values = array($attachment_string);
        $this->conditions = array('id = ?');
        $this->condition_values = array($this->id);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function insert_ticket_answer($company_id = NULL) {

        $login_user = $_SESSION['user_id'];
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_ticket_answers');
        } else {
            $this->tables = array('support_ticket_answers');
        }
        $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'ticket_type', 'admin_user', 'status', 'hidden');
        $this->field_values = array($this->id, $login_user, $this->answer, $this->category_id, $this->priority, $this->ticket_type, $this->admin_user, $this->status, $this->hidden);
        if ($this->query_insert()) {
            $id = $this->get_id();
            $this->append_ticket_answer_attachments($id);
            /*             * *******************************************
             * *
             * *   Send a new ticket notification to the admin
             * *
             * ******************************************* */
            global $preference, $support_priority, $support_status, $support_ticket_type, $cirrus_support, $cirrus_admins;
            $ticket_id = $this->id;
            $base_url = $preference['url'];
            if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                $ticket_data = $this->get_ticket_details($ticket_id, $company_id);
                $category_data = $this->get_support_category_details($ticket_data['category_id'], $company_id);
                $answer_data = $this->get_ticket_answer_details($id, $company_id);
                $user_data = $this->get_created_user_details($ticket_data['created_user'], $company_id);
                $answer_admin_userdata = array();
                if ($answer_data['category_type'] == 'Internal') {
                    $answered_user_data = $this->get_created_user_details($answer_data['submited_user'], $company_id);
                    $admin_user_array = explode(',', $answer_data['admin_user']);
                    if (!empty($admin_user_array)) {
                        foreach ($admin_user_array as $admin_user) {
                            $answer_admin_userdata[] = $this->get_employee_detail($admin_user, $company_id);
                        }
                    }
                    $admin_data = $this->get_employee_detail($ticket_data['admin_user'], $company_id);
                    $url = $base_url . 'tickets/detail/' . $ticket_id . '/';
                } else {
                    $answered_user_data = $cirrus_support;
                    $answer_admin_userdata[] = $cirrus_support;
                    $admin_data = $cirrus_support;
                    $admin_data['username'] = $cirrus_admins[0];
                    $url = $base_url . 'tickets/detail/' . $ticket_id . '/' . $company_id . '/';
                }
            } else {
                $ticket_data = $this->get_ticket_details($ticket_id);
                $category_data = $this->get_support_category_details($ticket_data['category_id']);
                $answer_data = $this->get_ticket_answer_details($id);
                $user_data = $this->get_created_user_details($ticket_data['created_user']);
                $answer_admin_userdata = array();
                if ($answer_data['category_type'] == 'Internal') {
                    $answered_user_data = $this->get_created_user_details($answer_data['submited_user']);
                    $admin_user_array = explode(',', $answer_data['admin_user']);
                    if (!empty($admin_user_array)) {
                        foreach ($admin_user_array as $admin_user) {
                            $answer_admin_userdata[] = $this->get_employee_detail($admin_user, $company_id);
                        }
                    }
                    $admin_data = $this->get_employee_detail($ticket_data['admin_user']);
                } else {
                    $answered_user_data = $cirrus_support;
                    $answer_admin_userdata[] = $cirrus_support;
                    $admin_data = $cirrus_support;
                    $admin_data['username'] = $cirrus_admins[0];
                    $url = $base_url . 'tickets/detail/' . $ticket_id . '/';
                }
            }
            $link = "<a href='$url'>$url</a>";

            $created_user = utf8_encode($ticket_data['created_user']);
            $created_user_email = utf8_encode($user_data['email']);
            $created_username = utf8_encode($user_data['first_name'] . ' ' . $user_data['last_name']);
            $admin = utf8_encode($admin_data['username']);
            $admin_username = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
            $admin_user_email = $admin_data['email'];
            $created_userphone = utf8_encode($user_data['phone']);
            $created_usermobile = utf8_encode($user_data['mobile']);
            $admin_userphone = utf8_encode($admin_data['phone']);
            $admin_usermobile = utf8_encode($admin_data['mobile']);
            $type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);
            $status = utf8_encode($support_status[$this->status]);
            $priority = utf8_encode($support_priority[$ticket_data['priority']]);
            $category = utf8_encode($ticket_data['category']);
            $date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
            $title = utf8_encode($ticket_data['title']);
            $description = utf8_encode($ticket_data['description']);

            $answer = utf8_encode($answer_data['answer']);
            $answer_user = utf8_encode($answer_data['submited_user']);
            $answer_username = utf8_encode($answered_user_data['first_name'] . ' ' . $answered_user_data['last_name']);
            $answer_useremail = utf8_encode($answered_user_data['email']);
            $answer_status = utf8_encode($support_status[$answer_data['status']]);
            $answer_priority = utf8_encode($support_priority[$answer_data['priority']]);
            $answer_admin_user = utf8_encode($answer_admin_userdata[0]['username']);
            $answer_admin_username = utf8_encode($answer_admin_userdata[0]['first_name'] . ' ' . $answer_admin_userdata[0]['last_name']);
            $answer_admin_useremail = utf8_encode($answer_admin_userdata[0]['email']);
            $answer_date = date('Y-m-d, H:i', strtotime($answer_data['date']));

            if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                $email_model = $this->get_email_model(3, $company_id);
            } else {
                $email_model = $this->get_email_model(3);
            }
            $emailSubject = utf8_encode($email_model['subject']);
            $emailBody = utf8_encode($email_model['body']);
            $emailFooter = utf8_encode($email_model['footer']);
            $senderName = utf8_encode($answer_username);
            $sender = utf8_encode($answer_useremail);

            $patterns = array();
            $patterns[0] = '/{id}/';
            $patterns[1] = '/{created_user}/';
            $patterns[2] = '/{created_username}/';
            $patterns[3] = '/{admin}/';
            $patterns[4] = '/{admin_username}/';
            $patterns[5] = '/{date}/';
            $patterns[6] = '/{type}/';
            $patterns[7] = '/{status}/';
            $patterns[8] = '/{category}/';
            $patterns[9] = '/{priority}/';
            $patterns[10] = '/{title}/';
            $patterns[11] = '/{description}/';
            $patterns[12] = '/{answer}/';
            $patterns[13] = '/{answer_user}/';
            $patterns[14] = '/{answer_username}/';
            $patterns[15] = '/{answer_priority}/';
            $patterns[16] = '/{answer_adminusername}/';
            $patterns[17] = '/{answer_status}/';
            $patterns[18] = '/{answer_date}/';
            $patterns[19] = '/{url}/';
            $patterns[20] = '/{created_userphone}/';
            $patterns[21] = '/{created_usermobile}/';
            $patterns[22] = '/{admin_userphone}/';
            $patterns[23] = '/{admin_usermobile}/';
            $patterns[24] = '/{answered_username}/';

            $replacements = array();
            $replacements[0] = $ticket_id;
            $replacements[1] = $created_user;
            $replacements[2] = $created_username;
            $replacements[3] = $admin;
            $replacements[4] = $admin_username;
            $replacements[5] = $date;
            $replacements[6] = $type;
            $replacements[7] = $status;
            $replacements[8] = $category;
            $replacements[9] = $priority;
            $replacements[10] = $title;
            $replacements[11] = $description;
            $replacements[12] = $answer;
            $replacements[13] = $answer_user;
            $replacements[14] = $answer_username;
            $replacements[15] = $answer_priority;
            $replacements[16] = $answer_admin_username;
            $replacements[17] = $answer_status;
            $replacements[18] = $answer_date;
            $replacements[19] = $link;
            $replacements[20] = $created_userphone;
            $replacements[21] = $created_usermobile;
            $replacements[22] = $admin_userphone;
            $replacements[23] = $admin_usermobile;
            $replacements[24] = $answer_username;


            $subject = preg_replace($patterns, $replacements, $emailSubject);
            $message = preg_replace($patterns, $replacements, $emailBody);
            $footer = preg_replace($patterns, $replacements, $emailFooter);
            $message .= "<br/><br/>" . $footer;
            if ($answer_data['hidden'] == 0) {
                
                $mailer = new SupportMailer();
                $mailer->setFrom($answer_username, $answer_useremail);
                $mailer->addRecipient($created_username, $created_user_email);
                $mailer->fillSubject(utf8_decode($subject));
                $mailer->fillMessage(utf8_decode($message));
                $mailer->send();
                
                $mailer1 = new SupportMailer();
                $mailer1->setFrom($answer_username, $answer_useremail);
                foreach ($answer_admin_userdata as $answer_admin_user) {
                    $mailer1->addRecipient($answer_admin_user['first_name'] . ' ' . $answer_admin_user['last_name'], $answer_admin_user['email']);
                }
                $mailer1->fillSubject(utf8_decode($subject));
                $mailer1->fillMessage(utf8_decode($message));
                $mailer1->send();
            }
            return $id;
        } else {
            return FALSE;
        }
    }

    function append_ticket_answer_attachments($answer_id, $old_attachment_string = '') {

        $attach_string = ($old_attachment_string != '' ? $old_attachment_string : '');
        //Get the temp file path
        $tmpFilePath = $this->attachment['tmp_name'];
        //Make sure we have a filepath
        if ($tmpFilePath != "") {
            $newName = strtotime(date("Y-m-d H:i:s")) . "_" . $this->attachment['name'];
            $newName = str_replace(" ", "_", $newName);
            $get_CompanyName = $this->get_company_name($_SESSION['company_id']);
            $app_dir = getcwd();
            if (!is_dir($app_dir . "/" . $get_CompanyName . "/")) {
                mkdir($app_dir . "/" . $get_CompanyName . "/", 0777);
            }
            if (!is_dir($app_dir . "/" . $get_CompanyName . "/tickets/")) {
                mkdir($app_dir . "/" . $get_CompanyName . "/tickets/", 0777);
            }
            if (!is_dir($app_dir . "/" . $get_CompanyName . "/tickets/attachment/")) {
                mkdir($app_dir . "/" . $get_CompanyName . "/tickets/attachment/", 0777);
            }

            $newFilePath = $app_dir . "/" . $get_CompanyName . "/tickets/attachment/" . $newName;

            //Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Handle other code here
            }
            $attach_string = $newName;
        }
        $this->tables = array('support_ticket_answers');
        $this->fields = array('attachment');
        $this->field_values = array($attach_string);
        $this->conditions = array('id = ?');
        $this->condition_values = array($answer_id);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function get_support_categories($company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_categories');
        } else {
            $this->tables = array('support_categories');
        }
        $this->fields = array('id', "`order`", 'type', 'name');
        $this->query_generate();
        $this->sql_query .= ' ORDER BY `order`';
        $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    function get_support_category_details($category_id, $company_id = NULL) {
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_categories');
        } else {
            $this->tables = array('support_categories');
        }
        $this->fields = array('id', "`order`", 'type', 'name');
        $this->conditions = array('id = ' . $category_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_support_category_options($type = NULL, $company_id = NULL) {

        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $categories = $this->get_support_categories($company_id);
        } else {
            $categories = $this->get_support_categories();
        }
        $data = array();
        foreach ($categories as $category) {
            if ($type != NULL && $type != '' && $category['type'] == $type) {
                $data[$category['id']] = $category['name'];
            } else if ($type == NULL || $type == '') {
                $data[$category['id']] = $category['name'];
            }
        }
        return $data;
    }

    function get_support_admin_users($company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($this->db_master . '.login` as `l', $company_db . '.employee` as `e');
        } else {
            $this->tables = array($this->db_master . '.login` as `l', $this->db_name . '.employee` as `e');
        }
        $this->fields = array('l.username as username', "concat(e.first_name,' ',e.last_name) as fullname");
        $this->conditions = array('AND', 'l.username = e.username', 'l.role = 1', 'e.status = 1');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_support_admin_users_options($company_id = NULL) {
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $admin_users = $this->get_support_admin_users($company_id);
        } else {
            $admin_users = $this->get_support_admin_users();
        }
        $data = array();
        foreach ($admin_users as $admin_user) {
            $data[$admin_user['username']] = $admin_user['fullname'];
        }
        return $data;
    }

    function get_companies($id = NULL) {

        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'db_name');
        if ($id == NULL || $id == '') {
            //$this->conditions = array('AND', 'status = 1', 'id = 1');
            $this->conditions = array('status = 1');
        } else {
            $this->conditions = array('id = ' . $id);
        }
        $this->order_by = array('name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_all_companies_options() {

        $companies = $this->get_companies();
        $data = array();
        foreach ($companies as $company) {
            $data[$company['id']] = $company['name'];
        }
        return $data;
    }

    function get_tickets($support_ticket_status = NULL, $support_priority = NULL, $support_category = NULL, $support_ticket_type = NULL, $support_key = NULL, $admin = NULL, $company = NULL, $st = NULL, $en = NULL) {

        global $cirrus_admins, $support_status;
        $array_keys = array_keys($support_status);
        $last_key = end($array_keys);
        $closed_status = ($last_key - 1);
        
        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if (in_array($login_user, $cirrus_admins)) {

            $company_query = array();
            if ($company == 'NULL' || $company == '') {
                $companies = $this->get_companies();
            } else {
                $companies = $this->get_companies($company);
            }
            foreach ($companies as $company) {
                
                $this->tables = array($company['db_name'] . '.support_tickets` as `t');
                $this->fields = array('DISTINCT t.id as id', "'" . $company['id'] . "' as company_id", "'" . $company['name'] . "' as company", 't.created_user', 'IF((SELECT admin_user FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT admin_user FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.admin_user) as admin_user', 'IF((SELECT ticket_type FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT ticket_type FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.ticket_type) as ticket_type', 'IF((SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) as category_id', '(SELECT name FROM ' . $company['db_name'] . '.support_categories WHERE id = IF((SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id)) as category', '(SELECT type FROM ' . $company['db_name'] . '.support_categories WHERE id = IF((SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id)) as category_type', 'IF((SELECT priority FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT priority FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.priority) as priority', 't.title', 't.description', 't.attachment', 'IF((SELECT status FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) as status', 't.date', 't.affected_user', 't.affected_user_phone');
                $this->conditions = array();
                $this->conditions[] = 'AND';

                if ($support_category == 'External' || $support_category == 'Internal') {
                    $this->conditions[] = 'IF((SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) IN(SELECT id FROM ' . $company['db_name'] . '.support_categories WHERE type = \'' . $support_category . '\')';
                    //$this->conditions[] = "c.type = '" . $support_category . "'";
                } else if ($support_category != 'ALL') {
                    $this->conditions[] = 'IF((SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) IN(SELECT id FROM ' . $company['db_name'] . '.support_categories WHERE type = \'External\')';
                    //$this->conditions[] = "c.type = 'External'";
                }
                if (isset($support_ticket_type) && $support_ticket_type != 'NULL' && $support_ticket_type != '') {
                    $this->conditions[] = 'IF((SELECT ticket_type FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT ticket_type FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.ticket_type) = ' . $support_ticket_type;
                }
                if (isset($support_priority) && $support_priority != 'NULL') {
                    $this->conditions[] = 'IF((SELECT priority FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT priority FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.priority) = ' . $support_priority;
                }
                if (isset($support_ticket_status) && $support_ticket_status != 'NULL' && $support_ticket_status != '') {
                    $this->conditions[] = 'IF((SELECT status FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) = ' . $support_ticket_status;
                } else {
                    $this->conditions[] = 'IF((SELECT status FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) < ' . $closed_status;
                }
                if (isset($support_key) && $support_key != 'NULL') {
                    $this->conditions[] = array('OR', "t.title LIKE '%" . $support_key . "%' ", "t.description LIKE '%" . $support_key . "%' ");
                }
                $this->query_generate();
                $company_query[] = '(' . $this->sql_query . ')';
            }
            $company_union_query = implode(' UNION ', $company_query);
            if ($st != NULL)
                $company_union_query .= ' ORDER BY date desc limit ' . $st . ',' . $en . ';';
            else
                $company_union_query .= ' ORDER BY date desc';
            $this->sql_query = $company_union_query;
            //echo ( "<pre>" . $company_union_query . "</pre>");
            $data = $this->query_fetch();
            return $data;
        } else {

            $this->tables = array('support_tickets` as `t');
            $this->fields = array('DISTINCT t.id as id', 't.created_user', 'IF((SELECT admin_user FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT admin_user FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.admin_user) as admin_user', 'IF((SELECT ticket_type FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT ticket_type FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.ticket_type) as ticket_type', 'IF((SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) as category_id', '(SELECT name FROM support_categories WHERE id = IF((SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id)) as category', '(SELECT type FROM support_categories WHERE id = IF((SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id)) as category_type', 'IF((SELECT priority FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT priority FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.priority) as priority', 't.title', 't.description', 't.attachment', 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) as status', 't.date', 't.affected_user', 't.affected_user_phone');
            $this->conditions = array();
            $this->conditions[] = 'AND';

            if ($login_user_role == 0 || $login_user_role == 1) {

                if (isset($support_category) && $support_category != 'NULL' && $support_category != 'ALL' && $support_category != '') {
                    $this->conditions[] = 'IF((SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) = \'' . $support_category . '\'';
                    //$this->conditions[] = 't.category_id = ' . $support_category;
                }
                if (isset($support_ticket_type) && $support_ticket_type != 'NULL' && $support_ticket_type != '') {
                    $this->conditions[] = 't.ticket_type = ' . $support_ticket_type;
                }
                if (isset($support_priority) && $support_priority != 'NULL') {
                    $this->conditions[] = 't.priority = ' . $support_priority;
                }
                if (isset($support_ticket_status) && $support_ticket_status != 'NULL' && $support_ticket_status != '') {
                    $this->conditions[] = 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) = ' . $support_ticket_status;
                } else {
                    $this->conditions[] = 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) < ' . $closed_status;
                }
                if (isset($support_key) && $support_key != 'NULL') {
                    $this->conditions[] = array('OR', "t.title LIKE '%" . $support_key . "%' ", "t.description LIKE '%" . $support_key . "%' ");
                }
                if (isset($admin) && $admin != 'NULL') {
                    $this->conditions[] = 't.admin_user = "' . $admin . '"';
                }
            } else {
                if (isset($support_category) && $support_category != 'NULL' && $support_category != 'ALL' && $support_category != '') {
                    $this->conditions[] = 'IF((SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) = \'' . $support_category . '\'';
                    //$this->conditions[] = 't.category_id = ' . $support_category;
                }
                if (isset($support_ticket_type) && $support_ticket_type != 'NULL' && $support_ticket_type != '') {
                    $this->conditions[] = 'IF((SELECT ticket_type FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT ticket_type FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.ticket_type) = ' . $support_ticket_type;
                }
                if (isset($support_priority) && $support_priority != 'NULL') {
                    $this->conditions[] = 'IF((SELECT priority FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT priority FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.priority) = ' . $support_priority;
                }
                if (isset($support_ticket_status) && $support_ticket_status != 'NULL' && $support_ticket_status != '') {
                    $this->conditions[] = 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) = ' . $support_ticket_status;
                } else {
                    $this->conditions[] = 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) < ' . $closed_status;
                }
                if (isset($support_key) && $support_key != 'NULL') {
                    $this->conditions[] = array('OR', "t.title LIKE '%" . $support_key . "%' ", "t.description LIKE '%" . $support_key . "%' ");
                }
                $this->conditions[] = 't.created_user = "' . $login_user . '"';
            }

            $this->query_generate();

            if ($st != NULL)
                $this->sql_query .= ' ORDER BY t.date desc limit ' . $st . ',' . $en . ';';
            else
                $this->sql_query .= ' ORDER BY t.date desc';

            // echo $this->sql_query;
            $data = $this->query_fetch();
            return $data;
        }
    }

    function get_ticket_details($ticket_id, $company_id = NULL) {

        $employee = new employee();
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {

            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $company_name = $company_data[0]['name'];

            $this->tables = array($company_db . '.support_tickets` as `t', $company_db . '.support_categories` as `c');
            $this->fields = array('t.id as id', "'" . $company_id . "' as company_id", "'" . $company_name . "' as company", 't.created_user', 't.admin_user', 'IF((SELECT admin_user FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT admin_user FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.admin_user) as last_admin_user', 't.ticket_type', 'IF((SELECT ticket_type FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT ticket_type FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.ticket_type) as last_ticket_type', 't.category_id', 'IF((SELECT category_id FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM ' . $company['db_name'] . '.support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) as last_category_id', 'c.name as category', 'c.type as category_type', 't.priority', 'IF((SELECT priority FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT priority FROM ' . $company_db . '.support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.priority) as last_priority', 't.title', 't.description', 't.attachment', 'IF((SELECT status FROM `' . $company_db . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM `' . $company_db . '`.`support_ticket_answers` WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) as status', 't.date', 't.affected_user', 't.affected_user_phone');
            $this->conditions = array('AND', 't.category_id = c.id', 't.id = "' . $ticket_id . '"');
            $this->query_generate();
            $ticket_data = $this->query_fetch();
            $ticket_answer_data = $this->get_ticket_answers($ticket_id, $company_id);
            $created_user = $ticket_data[0]['created_user'];
            $last_category_id = ($ticket_data[0]['last_category_id']) ? $ticket_data[0]['last_category_id'] : $ticket_data[0]['category_id'];
            $ticket_data[0]['last_category_id'] = $last_category_id;
            $last_category_data = $this->get_ticket_category_details($last_category_id);
            $ticket_data[0]['last_category'] = $last_category_data['name'];
            $ticket_data[0]['last_category_type'] = $last_category_data['type'];
            $created_user_data = $this->get_created_user_details($created_user, $company_id);
            $affected_user_data = $this->get_created_user_details($ticket_data[0]['affected_user'], $company_id);
            $ticket_data[0]['answers'] = $ticket_answer_data;
            $ticket_data[0]['created_user_data'] = $created_user_data;
            $ticket_data[0]['affected_user_data'] = $affected_user_data;
            $admin_data = $this->get_employee_detail($ticket_data[0]['admin_user'], $company_id);
            $ticket_data[0]['admin_username'] = $admin_data['first_name'] . ' ' . $admin_data['last_name'];
            $result = $ticket_data[0];
        } else {

            $this->tables = array('support_tickets` as `t', 'support_categories` as `c');
            $this->fields = array('t.id as id',"'".$_SESSION['company_id']."' as company_id", 't.created_user', 't.admin_user', 'IF((SELECT admin_user FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT admin_user FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.admin_user) as last_admin_user', 't.ticket_type', 'IF((SELECT ticket_type FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT ticket_type FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.ticket_type) as last_ticket_type', 't.category_id','IF((SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), (SELECT category_id FROM support_ticket_answers WHERE ticket_id=t.id AND category_id != 0 ORDER BY id DESC LIMIT 0,1), t.category_id) as last_category_id', 'c.name as category', "IF(c.type = 'External', 'C', 'I') as cat_type", 't.priority', 'IF((SELECT priority FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT priority FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.priority) as last_priority', 't.title', 't.description', 't.attachment', 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) as status', 't.date', 't.affected_user', 't.affected_user_phone');
            $this->conditions = array('AND', 't.category_id = c.id', 't.id = "' . $ticket_id . '"');
            $this->query_generate();
            $ticket_data = $this->query_fetch();
            $ticket_answer_data = $this->get_ticket_answers($ticket_id);
            $created_user = $ticket_data[0]['created_user'];
            $created_user_data = $this->get_created_user_details($created_user);
            $affected_user_data = $this->get_created_user_details($ticket_data[0]['affected_user']);

            $ticket_data[0]['answers'] = $ticket_answer_data;
            $ticket_data[0]['created_user_data'] = $created_user_data;
            $ticket_data[0]['affected_user_data'] = $affected_user_data;
            $admin_data = $this->get_employee_detail($ticket_data[0]['admin_user']);
            $ticket_data[0]['admin_username'] = $admin_data['first_name'] . ' ' . $admin_data['last_name'];
            $result = $ticket_data[0];
        }                    
        return $result;
    }

    function get_ticket_answers($ticket_id, $company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_ticket_answers` as `ta');
        } else {
            $this->tables = array('support_ticket_answers` as `ta');
        }
        $this->fields = array('ta.id as id', 'ta.submited_user', 'ta.answer', 'ta.category_id', 'ta.priority', 'ta.ticket_type', 'ta.admin_user', 'ta.attachment', 'ta.status', 'ta.date', 'ta.hidden');
        $this->conditions = array('ta.ticket_id = "' . $ticket_id . '"');
        $this->query_generate();
        $this->sql_query .= ' ORDER BY ta.id DESC';
        $datas = $this->query_fetch();
        $answer_data = array();
        foreach ($datas as $data) {

            if ($data['admin_user'] != "") {
                $admin_users = explode(',', $data['admin_user']);
                $admin_user_data = array();
                foreach ($admin_users as $admin_user) {
                    $admin_user_data[] = $this->get_employee_detail($admin_user);
                }
            }
            $category_data = $this->get_ticket_category_details($data['category_id']);
            $data['category'] = $category_data['name'];
            $data['cat_type'] = 'I';
            if ($category_data['type'] == 'External') {
                $data['cat_type'] = 'C';
            }
            $data['admin_user_data'] = $admin_user_data;
            $created_user = $data['submited_user'];
            $user_data = $this->get_created_user_details($created_user);
            $data['submited_name'] = $user_data['first_name'] . ' ' . $user_data['last_name'];
            $answer_data[] = $data;
        }
        return $answer_data;
    }

    function get_ticket_answer_details($answer_id, $company_id = NULL) {
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_ticket_answers');
        } else {
            $this->tables = array('support_ticket_answers');
        }
        $this->fields = array('id', 'submited_user', 'answer', 'category_id', 'priority', 'ticket_type', 'admin_user', 'attachment', 'status', 'date', 'hidden');
        $this->conditions = array('id = "' . $answer_id . '"');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['admin_user'] != "") {
            $admin_users = explode(',', $data[0]['admin_user']);
            if (count($admin_users) > 1) {
                $admin_user_data = array();
                foreach ($admin_users as $admin_user) {
                    $admin_user_data[] = $this->get_employee_detail($admin_user);
                }
            } else {
                $admin_user_data = $this->get_employee_detail($admin_users[0]);
            }
        }
        $data[0]['admin_user_data'] = $admin_user_data;
        $category_data = $this->get_ticket_category_details($data[0]['category_id']);
        $data[0]['category'] = $category_data['name'];
        $data[0]['category_type'] = $category_data['type'];
        $data[0]['cat_type'] = 'I';
        if ($category_data['type'] == 'External') {
            $data[0]['cat_type'] = 'C';
        }
        $created_user = $data[0]['submited_user'];
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $user_data = $this->get_created_user_details($created_user, $company_id);
        } else {
            $user_data = $this->get_created_user_details($created_user);
        }
        $data[0]['submited_name'] = $user_data['first_name'] . ' ' . $user_data['last_name'];
        return $data[0];
    }

    function get_ticket_open_count() {

        global $cirrus_admins;
        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if (in_array($login_user, $cirrus_admins)) {

            $company_query = array();
            $companies = $this->get_companies();

            foreach ($companies as $company) {

                $this->tables = array($company['db_name'] . '.support_tickets` AS `st');
                $this->fields = array('COUNT(st.id) as count');
                $this->conditions = array('AND', 'IF((SELECT status FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=st.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM `' . $company['db_name'] . '`.`support_ticket_answers` WHERE ticket_id=st.id ORDER BY id DESC LIMIT 0,1), st.status) = 1');
                $this->query_generate();
                $company_query[] = '(' . $this->sql_query . ')';
            }
            $company_union_query = implode(' UNION ', $company_query);
            $this->sql_query = "SELECT SUM(count) as count FROM (" . $company_union_query . ") tc";
        } else {

            $this->tables = array('support_tickets` AS `st');
            $this->fields = array('COUNT(st.id) as count');
            if ($login_user_role == 1 || $login_user_role == 0) {
                $this->conditions = array('AND', 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=st.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=st.id ORDER BY id DESC LIMIT 0,1), st.status) = 1');
            } else {
                $this->conditions = array('AND', "created_user = '" . $login_user . "'", 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=st.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=st.id ORDER BY id DESC LIMIT 0,1), st.status) = 1');
            }
            $this->query_generate();
        }
        //echo $this->sql_query;
        $data = $this->query_fetch();
        $count = $data[0]['count'];
        return $count;
    }

    function get_company_name($cid) {

        global $db;
        $this->tables = array($db['database_master'] . '.company');
        $this->fields = array('*');
        $this->conditions = array('id = ?');
        $this->condition_values = array($cid);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['upload_dir'];
    }

    function get_all_users($company_id) {

        $company_data = $this->get_companies($company_id);
        $company_db = $company_data[0]['db_name'];
        $this->tables = array($company_db . '.employee` as `e', $this->db_master . '.login` as `l');
        $this->fields = array('e.username', 'e.first_name', 'e.last_name', 'e.code', 'e.phone', 'e.mobile', 'l.role');
        $this->conditions = array('AND', 'l.username = e.username', 'e.status = 1');
        $this->query_generate();
        $employee_query = $this->sql_query;
        $this->tables = array($company_db . '.customer` as `c', $this->db_master . '.login` as `l');
        $this->fields = array('c.username', 'c.first_name', 'c.last_name', 'c.code', 'c.phone', 'c.mobile', 'l.role');
        $this->conditions = array('AND', 'l.username = c.username', 'c.status = 1');
        $this->query_generate();
        $customer_query = $this->sql_query;

        $all_user_union_query = '(' . $employee_query . ') UNION (' . $customer_query . ')';

        $this->sql_query = $all_user_union_query;
        //print_r("<pre>" . $all_user_union_query . "</pre>");
        $data = $this->query_fetch();
        return $data;
    }

    function get_all_user_json($company_id) {

        $datas = $this->get_all_users($company_id);
        $users = array();
        foreach ($datas as $data) {
            $phone = ($data['mobile'] != '') ? $data['mobile'] : $data['phone'];
            $users[] = array('id' => $data['username'], 'phone' => $phone, 'label' => $data['first_name'] . ' ' . $data['last_name'] . '(' . $data['code'] . ')');
        }
        $json_users = json_encode($users);
        return $json_users;
    }

    function get_created_user_details($created_user, $company_id = NULL) {

        global $cirrus_admins, $cirrus_support;

        if (in_array($created_user, $cirrus_admins)) {
            $data = $cirrus_support;
            $data['username'] = $created_user;
        } else {
            $user = new user();
            $created_user_role = $user->user_role($created_user);
            if ($created_user_role == 4) {
                if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                    $data = $this->get_customer_detail($created_user, $company_id);
                } else {
                    $data = $this->get_customer_detail($created_user);
                }
            } else {
                if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                    $data = $this->get_employee_detail($created_user, $company_id);
                } else {
                    $data = $this->get_employee_detail($created_user);
                }
            }
        }
        return $data;
    }

    function get_customer_detail($username, $company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.customer');
        } else {
            $this->tables = array('customer');
        }
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status', 'gender');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();

        return $datas[0];
    }

    function get_employee_detail($username, $company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.employee');
        } else {
            $this->tables = array('employee');
        }
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'status');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function update_email_model($id, $sender, $sender_name, $subject, $body, $footer) {

        $this->tables = array('support_emails');
        $this->fields = array('sender', 'sender_name', 'subject', 'body', 'footer');
        $this->field_values = array($sender, $sender_name, $subject, $body, $footer);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_email_model($id, $company_id = NULL) {

        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_emails');
        } else {
            $this->tables = array('support_emails');
        }
        $this->fields = array('id', 'sender', 'sender_name', 'subject', 'body', 'footer');
        $this->conditions = array('id = "' . $id . '"');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function update_tickets_noreplay($company_id = NULL) {

        global $support_status;
        //get tickets that answered waiting for replay
        $array_keys = array_keys($support_status);
        $last_key = end($array_keys);
        $status_check = ($last_key - 1);
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $this->tables = array($company_db . '.support_tickets` AS `t');
            $this->fields = array('t.id');
            $this->conditions = array('AND', 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) = ' . $status_check, 'IF((SELECT date FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT date FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.date) < NOW() - INTERVAL 3 DAY');
            $this->query_generate();
            $datas = $this->query_fetch();
            foreach ($datas as $data) {
                $ticket_id = $data['id'];
                $this->update_tickets_to_close($ticket_id, $company_id);
            }
        } else {
            $this->tables = array('support_tickets` AS `t');
            $this->fields = array('t.id');
            $this->conditions = array('AND', 'IF((SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT status FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.status) = ' . $status_check, 'IF((SELECT date FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), (SELECT date FROM support_ticket_answers WHERE ticket_id=t.id ORDER BY id DESC LIMIT 0,1), t.date) < NOW() - INTERVAL 3 DAY');
            $this->query_generate();
            $datas = $this->query_fetch();
            foreach ($datas as $data) {
                $ticket_id = $data['id'];
                $this->update_tickets_to_close($ticket_id);
            }
        }
    }

    function update_tickets_to_close($ticket_id, $company_id = NULL) {

        global $support_status;
        $answer = "biljett stängs automatiskt";
        $array_keys = array_keys($support_status);
        $last_key = end($array_keys);
        $status = $last_key;
        if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {

            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $ticket_data = $this->get_ticket_details($ticket_id, $company_id);
            $ticket_ansers = $ticket_data['answers'];
            $last_ticket_answer = $ticket_ansers[(count($ticket_ansers) - 1)];
            $submited_user = 'gine001';
            $priority = $last_ticket_answer['priority'];
            $this->tables = array($company_db . '.support_ticket_answers');
        } else {
            $company_data = $this->get_companies($company_id);
            $company_db = $company_data[0]['db_name'];
            $ticket_data = $this->get_ticket_details($ticket_id);
            $ticket_ansers = $ticket_data['answers'];
            $last_ticket_answer = $ticket_ansers[(count($ticket_ansers) - 1)];
            $submited_user = 'gine001';
            $priority = $last_ticket_answer['priority'];
            $this->tables = array('support_ticket_answers');
        }
        $this->fields = array('ticket_id', 'submited_user', 'answer', 'priority', 'admin_user', 'status', 'hidden');
        $this->field_values = array($ticket_id, $submited_user, $answer, $priority, NULL, $status, 0);
        if ($this->query_insert()) {

            /*             * *******************************************
             * *
             * *   Send a new ticket notification to the admin
             * *
             * ******************************************* */
            global $preference, $support_priority, $support_status, $support_ticket_type, $cirrus_support;
            $answer_id = $this->get_id();
            $category_data = $this->get_support_category_details($ticket_data['category_id']);
            $user_data = $this->get_created_user_details($ticket_data['created_user']);
            $base_url = $preference['url'];
            if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                if ($category_data['type'] == 'Internal') {
                    $admin_data = $this->get_employee_detail($ticket_data['admin_user'], $company_id);
                } else {
                    $admin_data = $cirrus_support;
                    $admin_data['username'] = 'gine001';
                }
                $answer_data = $this->get_ticket_answer_details($answer_id, $company_id);
                $url = $base_url . 'tickets/detail/' . $ticket_id . '/' . $company_id . '/';
            } else {
                if ($category_data['type'] == 'Internal') {
                    $admin_data = $this->get_employee_detail($ticket_data['admin_user']);
                } else {
                    $admin_data = $cirrus_support;
                    $admin_data['username'] = 'gine001';
                }
                $answer_data = $this->get_ticket_answer_details($answer_id);
                $url = $base_url . 'tickets/detail/' . $ticket_id . '/';
            }
            $link = "<a href='$url'>$url</a>";
            $admin_user_email = $admin_data['email'];
            $created_user = utf8_encode($ticket_data['created_user']);
            $created_user_email = utf8_encode($user_data['email']);
            $created_username = utf8_encode($user_data['first_name'] . ' ' . $user_data['last_name']);
            $admin = utf8_encode($admin_data['username']);
            $admin_username = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
            $created_userphone = utf8_encode($user_data['phone']);
            $created_usermobile = utf8_encode($user_data['mobile']);
            $admin_userphone = utf8_encode($admin_data['phone']);
            $admin_usermobile = utf8_encode($admin_data['mobile']);
            $type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);
            $status = utf8_encode($support_status[$this->status]);
            $priority = utf8_encode($support_priority[$ticket_data['priority']]);
            $category = utf8_encode($ticket_data['category']);
            $date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
            $title = utf8_encode($ticket_data['title']);
            $description = utf8_encode($ticket_data['description']);
            $answer = utf8_encode($answer_data['answer']);
            $answered_user = utf8_encode($answer_data['submited_user']);
            $answered_username = utf8_encode($answer_data['submited_name']);
            $answer_status = utf8_encode($support_status[$answer_data['status']]);
            $answer_date = date('Y-m-d, H:i', strtotime($answer_data['date']));

            if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                $email_model = $this->get_email_model(4, $company_id);
            } else {
                $email_model = $this->get_email_model(4);
            }
            $emailSubject = utf8_encode($email_model['subject']);
            $emailBody = utf8_encode($email_model['body']);
            $emailFooter = utf8_encode($email_model['footer']);
            $senderName = utf8_encode($email_model['sender_name']);
            $sender = utf8_encode($email_model['sender']);

            $patterns = array();
            $patterns[0] = '/{id}/';
            $patterns[1] = '/{created_user}/';
            $patterns[2] = '/{created_username}/';
            $patterns[3] = '/{admin}/';
            $patterns[4] = '/{admin_username}/';
            $patterns[5] = '/{date}/';
            $patterns[6] = '/{type}/';
            $patterns[7] = '/{status}/';
            $patterns[8] = '/{category}/';
            $patterns[9] = '/{priority}/';
            $patterns[10] = '/{title}/';
            $patterns[11] = '/{description}/';
            $patterns[12] = '/{answer}/';
            $patterns[13] = '/{answered_user}/';
            $patterns[14] = '/{answered_username}/';
            $patterns[15] = '/{answer_status}/';
            $patterns[16] = '/{answer_date}/';
            $patterns[17] = '/{url}/';
            $patterns[18] = '/{created_userphone}/';
            $patterns[19] = '/{created_usermobile}/';
            $patterns[20] = '/{admin_userphone}/';
            $patterns[21] = '/{admin_usermobile}/';

            $replacements = array();
            $replacements[0] = $ticket_id;
            $replacements[1] = $created_user;
            $replacements[2] = $created_username;
            $replacements[3] = $admin;
            $replacements[4] = $admin_username;
            $replacements[5] = $date;
            $replacements[6] = $type;
            $replacements[7] = $status;
            $replacements[8] = $category;
            $replacements[9] = $priority;
            $replacements[10] = $title;
            $replacements[11] = $description;
            $replacements[12] = $answer;
            $replacements[13] = $answered_user;
            $replacements[14] = $answered_username;
            $replacements[15] = $answer_status;
            $replacements[16] = $answer_date;
            $replacements[17] = $link;
            $replacements[18] = $created_userphone;
            $replacements[19] = $created_usermobile;
            $replacements[20] = $admin_userphone;
            $replacements[21] = $admin_usermobile;


            $subject = preg_replace($patterns, $replacements, $emailSubject);
            $message = preg_replace($patterns, $replacements, $emailBody);
            $footer = preg_replace($patterns, $replacements, $emailFooter);
            $message .= "<br/><br/>" . $footer;

            $mailer = new SupportMailer();
            $mailer->setFrom($senderName, $sender);
            $mailer->addRecipient($created_user, $created_user_email);
            $mailer->fillSubject(utf8_decode($subject));
            $mailer->fillMessage(utf8_decode($message));
            $mailer->send();

            return TRUE;
        } else {
            return FALSE;
        }
    }

    function insert_ticket_category($cat_order, $cat_type, $cat_name) {

        $this->tables = array('support_categories');
        $this->fields = array('`order`', 'type', 'name');
        $this->field_values = array($cat_order, $cat_type, $cat_name);
        if ($this->query_insert()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_ticket_category($cat_id, $cat_order, $cat_type, $cat_name) {
        $this->tables = array('support_categories');
        $this->fields = array('`order`', 'type', 'name');
        $this->field_values = array($cat_order, $cat_type, $cat_name);
        $this->conditions = array('id = ?');
        $this->condition_values = array($cat_id);
        if ($this->query_update()) {
            return TRUE;
        } else {
            print_r($this->query_error_details);
            return FALSE;
        }
    }

    function delete_ticket_category($cat_id) {

        $this->tables = array('support_categories');
        $this->conditions = array('id = ?');
        $this->condition_values = array($cat_id);
        if ($this->query_delete()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_ticket_categories() {

        $this->tables = array('support_categories');
        $this->fields = array('id', '`order`', 'type', 'name');
        $this->query_generate();
        $this->sql_query .= ' ORDER BY `order`';

        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    function get_ticket_types() {

        global $cirrus_admins;
        $login_user = $_SESSION['user_id'];
        if (in_array($login_user, $cirrus_admins)) {
            $this->tables = array('support_categories');
            $this->fields = array('DISTINCT type AS type');
        } else {
            $this->tables = array('support_categories');
            $this->fields = array('DISTINCT type AS type');
            $this->conditions = array("type != 'External'");
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_ticket_category_details($category_id) {

        $this->tables = array('support_categories');
        $this->fields = array('id', '`order`', 'type', 'name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($category_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_ticket_category_count() {

        $this->tables = array('support_categories');
        $this->fields = array('COUNT(id) AS count');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['count'];
    }

}

class SupportMailer extends db {

    const STRIP_RETURN_PATH = TRUE;

    private $to = NULL;
    private $subject = NULL;
    private $textMessage = NULL;
    private $headers = NULL;
    private $recipients = NULL;
    private $cc = NULL;
    private $cco = NULL;
    private $from = NULL;
    private $replyTo = NULL;
    private $attachments = array();

    public function __construct($to = NULL, $subject = NULL, $textMessage = NULL, $headers = NULL) {
        $this->to = $to;
        $this->recipients = $to;
        $this->subject = $subject;
        $this->textMessage = $textMessage;
        $this->headers = $headers;
        return $this;
    }

    public function send() {

        global $preference;
        $customer = new customer();
        $smarty = new smartySetup(array("user.xml", "messages.xml", "mail.xml"), FALSE);
        $compony_detail = $customer->get_company_detail($_SESSION['company_id']);

        if (is_null($this->to)) {
            throw new Exception("Must have at least one recipient.");
        }

        if (is_null($this->from)) {
            throw new Exception("Must have one, and only one sender set.");
        }

        if (is_null($this->subject)) {
            throw new Exception("Subject is empty.");
        }

        if (is_null($this->textMessage)) {
            throw new Exception("Message is empty.");
        }

        $mail_template = "<html><body><table width='650' border='0' cellspacing='0' cellpadding='0' style=' background-color:#fff; margin:0 auto; margin-top:3%;'>
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
        <td width='209' style='font:normal 12px/19px Tahoma, Geneva, sans-serif; text-align:left; color:#a8a8a8;'>" . $date . "</td>
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
        " . preg_replace('/\r?\n|\r/', '<br/>', $this->textMessage) . "
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
            $mail_template .= "<td style='font-size: 18px; font-family: Arial,sans-serif; color:#8bb9c3; text-transform:uppercase;' width='201' height='96' valign='middle'>" . $compony_detail['name'] . "</td>";
        } else {
            $mail_template .= "<td width='201' height='96' valign='middle'><img height='60px' src='" . $preference['url'] . "company_logo/" . $compony_detail['logo'] . "' /></td>";
        }
        $mail_template .= "<td width='63' headers='101'>&nbsp;</td>
    <td width='274' height='76' valign='top'style='padding-top:25px; font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>" . $smarty->translate[footer_mail] . " </td>
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
</table></body></html>";
        $this->textMessage = $mail_template;

        $this->packHeaders();
        $sent = mail($this->to, $this->subject, $this->textMessage, $this->headers);
        if (!$sent) {
            return FALSE;
        } else {
            return true;
        }
    }

    public function addRecipient($name, $address) {
        $this->recipients .= (is_null($this->recipients)) ? ("$name <$address>") : (", " . "$name <$address>");
        $this->to .= (is_null($this->to)) ? $address : (", " . $address);
        return $this;
    }

    public function addCC($name, $address) {
        $this->cc .= (is_null($this->cc)) ? ("$name <$address>") : (", " . "$name <$address>");
        return $this;
    }

    public function addCCO($name, $address) {
        $this->cc .= (is_null($this->cc)) ? ("$name <$address>") : (", " . "$name <$address>");
        return $this;
    }

    public function setFrom($name, $address) {
        $this->from = "$name <$address>" . PHP_EOL;
        if (is_null($this->replyTo)) {
            $this->replyTo = $address . PHP_EOL;
        }
        return $this;
    }

    public function setReplyTo($address) {
        $this->replyTo = $address . PHP_EOL;
        return $this;
    }

    public function fillSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function fillMessage($textMessage) {
        $this->textMessage = $textMessage;
        return $this;
    }

    public function attachFile($filePath) {
        $this->attachments[] = $filePath;
        return $this;
    }

    private function packHeaders() {

        if (!$this->headers) {
            $this->headers = "MIME-Version: 1.0" . PHP_EOL;
            $this->headers .= "Content-Type: text/html; charset=\"utf-8\"" . PHP_EOL;
            $this->headers .= "To: " . $this->recipients . PHP_EOL;
            $this->headers .= "From: " . $this->from . PHP_EOL;

            if (self::STRIP_RETURN_PATH !== TRUE) {
                $this->headers .= "Reply-To: " . $this->replyTo . PHP_EOL;
                $this->headers .= "Return-Path: " . $this->from . PHP_EOL;
            }

            if ($this->cc) {
                $this->headers .= "Cc: " . $this->cc . PHP_EOL;
            }

            if ($this->cco) {
                $this->headers .= "Bcc: " . $this->cco . PHP_EOL;
            }
        }
    }

}
