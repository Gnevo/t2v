<?php

/**
 * Description of timetable
 * @author shamsudheen <donadoniman@arioninfotech.com>
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
    var $company_id = '';
    var $login_user = '';
    var $admin_user = '';
    var $category_type = '';
    var $category_id = '';
    var $ticket_type = '';
    var $priority = '';
    var $affected_user = '';
    var $affected_user_phone = '';
    var $title = '';
    var $description = '';
    var $attachment = '';
    var $status = '';
    var $answer_id = '';
    var $answer_admin_user = '';
    var $answer_category_id = '';
    var $answer_ticket_type = '';
    var $answer_priority = '';
    var $answer = '';
    var $answer_status = '';
    var $answer_hidden = 0;
    var $answer_attachment = '';

    function __construct() {
        parent::__construct();
    }

    function get_companies($id = NULL) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'upload_dir', 'logo', 'org_no', 'address', 'email', 'phone', 'mobile', 'website');
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

    function get_user_companies($username) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.login');
        $this->fields = array('company_ids');
        $this->conditions = array("username = '$username'");
        $this->query_generate();
        $data = $this->query_fetch();
        $company_ids = trim($data[0]['company_ids'], ',');
        //$company_ids = 1;
        $this->tables = array($db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'upload_dir', 'logo', 'org_no', 'address', 'email', 'phone', 'mobile', 'website');
        $this->conditions = array('AND', 'status = 1', "id IN ($company_ids)");
        $this->order_by = array('name');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_user_details($username, $company_id = NULL) {

        $user = new user();
        $user_role = $user->user_role($username);
        if ($created_user_role == 4) {
            if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                $data = $this->get_customer_detail($username, $company_id);
            } else {
                $data = $this->get_customer_detail($username);
            }
        } else {
            if ($company_id != '' && $company_id != 'NULL' && $company_id != NULL && $company_id > 0) {
                $data = $this->get_employee_detail($username, $company_id);
            } else {
                $data = $this->get_employee_detail($username);
            }
        }
        return $data;
    }

    function insert_ticket_master() {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $this->company_id > 0 && (int) $this->category_type > 0) {
            $this->tables = array($db_master . '.support_ticket_master');
            $this->fields = array('company_id', 'category_type');
            $this->field_values = array($this->company_id, $this->category_type);
            if ($this->query_insert()) {
                return $this->get_id();
            }
        }
        return FALSE;
    }

    function get_ticket_master($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_ticket_master');
        $this->fields = array('id', 'company_id', 'category_type');
        $this->conditions = array("id = $ticket_id");
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function update_ticket_master($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $this->category_type > 0) {
            $this->tables = array($db_master . '.support_ticket_master');
            $this->fields = array('category_type');
            $this->field_values = array($this->category_type);
            $this->conditions = array('id = ?');
            $this->condition_values = array($ticket_id);
            if ($this->query_update()) {
                return TRUE;
            }
        }
        return FALSE;
    }

    function insert_internal_ticket() {

        $this->company_id = $_SESSION['company_id'];
        $this->login_user = $_SESSION['user_id'];
        $company_data = $this->get_companies($this->company_id);
        $company_db = $company_data[0]['db_name'];
        $this->tables = array($company_db . '.support_tickets');
        $this->fields = array('id', 'created_user', 'admin_user', 'category_id', 'priority', 'affected_user', 'affected_user_phone', 'title', 'description', 'attachment', 'status');
        $this->field_values = array($this->id, $this->login_user, $this->admin_user, $this->category_id, $this->priority, $this->affected_user, $this->affected_user_phone, $this->title, $this->description, NULL, $this->status);
        if ($this->query_insert()) {
            return TRUE;
        }
        return FALSE;
    }

    function insert_external_ticket() {

        global $db;
        $db_master = $db['database_master'];
        $this->login_user = $_SESSION['user_id'];
        $this->tables = array($db_master . '.support_tickets');
        $this->fields = array('id', 'created_user', 'category_id', 'ticket_type', 'priority', 'title', 'description', 'attachment', 'status');
        $this->field_values = array($this->id, $this->login_user, $this->category_id, $this->ticket_type, $this->priority, $this->title, $this->description, NULL, $this->status);
        if ($this->query_insert()) {
            return TRUE;
        }
        return FALSE;
    }

    function insert_ticket() {
        $this->begin_transaction();
        $this->id = $this->insert_ticket_master();
        if ($this->id) {
            if ($this->category_type == 1) {
//insert internal tickets
                if ($this->insert_internal_ticket()) {
                    $this->append_ticket_attachments($this->id);
                    $this->commit_transaction();
                    
//insert internal ticket to notes
                    $notes = new notes();
                    $notes->login_user = $this->login_user;
                    $notes->customer = NULL;
                    $notes->title = $this->title;
                    $notes->description = $this->description;
                    $notes->visibility = 4; //only for admin
                    $notes->status = 1;
                    $notes->ticket = $this->id;
                    $notes->insert_note();
                    // echo 'Support ID: '. $this->id.'<br/>';
                    $this->mail_send_new_ticket($this->id);
                    return $this->id;
                } else {
                    $this->rollback_transaction();
                    return FALSE;
                }
            } else if ($this->category_type == 2) {
//insert external tickets
                if ($this->insert_external_ticket()) {
                    $this->append_ticket_attachments($this->id);
                    $this->commit_transaction();
                    $this->mail_send_new_ticket($this->id);
                    return $this->id;
                } else {
                    $this->rollback_transaction();
                    return FALSE;
                }
            }
        } else {
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function append_ticket_attachments($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $ticket_id > 0) {
            $ticket_master = $this->get_ticket_master($ticket_id);
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];
            $tmpFilePath = $this->attachment['tmp_name'];
            if ($tmpFilePath != "") {
                $newName = strtotime(date("Y-m-d H:i:s")) . "_" . $this->attachment['name'];
                $newName = str_replace(" ", "_", $newName);
                $company_upload_dir = $company_data[0]['upload_dir'];
                $app_dir = getcwd();
                if (!is_dir($app_dir . "/" . $company_upload_dir . "/")) {
                    mkdir($app_dir . "/" . $company_upload_dir . "/", 0777);
                }
                if (!is_dir($app_dir . "/" . $company_upload_dir . "/tickets/")) {
                    mkdir($app_dir . "/" . $company_upload_dir . "/tickets/", 0777);
                }
                if (!is_dir($app_dir . "/" . $company_upload_dir . "/tickets/attachment/")) {
                    mkdir($app_dir . "/" . $company_upload_dir . "/tickets/attachment/", 0777);
                }
                $newFilePath = $app_dir . "/" . $company_upload_dir . "/tickets/attachment/" . $newName;
//Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                    $attach_string = $newName;
                    if ($ticket_master['category_type'] == 1) {
//internal ticket
                        $this->tables = array($company_db . '.support_tickets');
                    } elseif ($ticket_master['category_type'] == 2) {
//external ticket
                        $this->tables = array($db_master . '.support_tickets');
                    }
                    $this->fields = array('attachment');
                    $this->field_values = array($attach_string);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($ticket_id);
                    if ($this->query_update()) {
                        return TRUE;
                    }
                }
            }
        }
        return FALSE;
    }

    function get_ticket_details($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        $ticket_master = $this->get_ticket_master($ticket_id);
        $company_data = $this->get_companies($ticket_master['company_id']);
        $company_db = $company_data[0]['db_name'];
        if ($ticket_master['category_type'] == 1) {
//get internal ticket details
            $sql_query = "SELECT stm.id, stm.company_id,cm.name as company, stm.category_type, st.created_user, st.admin_user, st.category_id, tcm.name AS category, st.priority, st.affected_user, st.affected_user_phone, st.title, st.description, st.attachment, st.status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 INNER JOIN `" . $db_master . "`.`company` cm ON stm.company_id = cm.id INNER JOIN `" . $db_master . "`.`support_categories` tcm ON st.category_id = tcm.id WHERE stm.id = " . $ticket_id;
        } elseif ($ticket_master['category_type'] == 2) {
//get external ticket details
            $sql_query = "SELECT stm.id, stm.company_id,cm.name as company, stm.category_type, st.created_user, st.ticket_type, st.category_id, tcm.name AS category, st.priority, st.title, st.description, st.attachment, st.status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 INNER JOIN `" . $db_master . "`.`company` cm ON stm.company_id = cm.id INNER JOIN `" . $db_master . "`.`support_categories` tcm ON st.category_id = tcm.id WHERE stm.id = " . $ticket_id;
        }
        $this->sql_query = $sql_query;
        $ticket_data = $this->query_fetch();
        if (!empty($ticket_data)) {
            $ticket_details = $ticket_data[0];
            $created_user_data = $this->get_user_details($ticket_details['created_user'], $ticket_details['company_id']);
            $ticket_details['created_user_data'] = $created_user_data;
            if ($ticket_master['category_type'] == 1) {
                $admin_user_data = $this->get_user_details($ticket_details['admin_user'], $ticket_details['company_id']);
                $affected_user_data = $this->get_user_details($ticket_details['affected_user'], $ticket_details['company_id']);
                $ticket_details['admin_user_data'] = $admin_user_data;
                $ticket_details['affected_user_data'] = $affected_user_data;
            }
            return $ticket_details;
        }
        return FALSE;
    }

    function get_ticket_last_details($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        $ticket_master = $this->get_ticket_master($ticket_id);
        if ($ticket_master) {
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];
            if ($ticket_master['category_type'] == 1) {
//get internal ticket details
                $sql_query = "SELECT stm.id, stm.company_id,mc.name as company, stm.category_type, st.created_user, IF(sta.admin_user != '', sta.admin_user, st.admin_user) AS admin_user, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.affected_user, st.affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status) AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE stm.id = " . $ticket_id;
            } elseif ($ticket_master['category_type'] == 2) {
//get external ticket details
                $sql_query = "SELECT stm.id, stm.company_id,mc.name as company, stm.category_type, st.created_user, IF(sta.ticket_type, sta.ticket_type, st.ticket_type) AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status) AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE stm.id = " . $ticket_id;
            }
            $this->sql_query = $sql_query;
            $ticket_data = $this->query_fetch();
            if (!empty($ticket_data)) {
                $ticket_details = $ticket_data[0];
                if ($ticket_master['category_type'] == 1) {
//get internal ticket details
                    $created_user_data = $this->get_user_details($ticket_details['created_user'], $ticket_details['company_id']);
                    $admin_user_data = $this->get_user_details($ticket_details['admin_user'], $ticket_details['company_id']);
                    $affected_user_data = $this->get_user_details($ticket_details['affected_user'], $ticket_details['company_id']);
                    $ticket_details['created_user_data'] = $created_user_data;
                    $ticket_details['admin_user_data'] = $admin_user_data;
                    $ticket_details['affected_user_data'] = $affected_user_data;
                } elseif ($ticket_master['category_type'] == 2) {
//get external ticket details
                    $created_user_data = $this->get_user_details($ticket_details['created_user'], $ticket_details['company_id']);
                    $ticket_details['created_user_data'] = $created_user_data;
                }
                return $ticket_details;
            }
        }
        return FALSE;
    }

    function mail_send_new_ticket($ticket_id) {

        global $preference, $support_priority, $support_status, $support_ticket_type, $cirrus_support, $cirrus_admins;

        $base_url = $preference['url'];
        $ticket_data = $this->get_ticket_details($ticket_id);
        // echo "<pre>ticket_data".print_r($ticket_data, 1)."</pre>";
        $company_id = $ticket_data['company_id'];
        $company_data = $this->get_companies($company_id);
        $company_details = $company_data[0];
        $created_user_data = $ticket_data['created_user_data'];
        $url = $base_url . 'supporttickets/detail/' . $ticket_id . '/' . $company_id . '/';
        $link = "<a href='$url'>$url</a>";

        $created_user = utf8_encode($ticket_data['created_user']);
        $created_email = utf8_encode($created_user_data['email']);
        $created_name = utf8_encode($created_user_data['first_name'] . ' ' . $created_user_data['last_name']);
        $created_phone = utf8_encode($created_user_data['phone']);
        $created_mobile = utf8_encode($created_user_data['mobile']);

        $ticket_status = utf8_encode($support_status[$ticket_data['status']]);
        $ticket_priority = utf8_encode($support_priority[$ticket_data['priority']]);
        $ticket_category = utf8_encode($ticket_data['category']);
        $ticket_date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
        $ticket_title = utf8_encode($ticket_data['title']);
        $ticket_description = utf8_encode($ticket_data['description']);

        $company_name = $company_details['name'];
        $company_email = $company_details['email'];
        $company_phone = $company_details['phone'];
        $company_mobile = $company_details['mobile'];
        $company_website = $company_details['website'];
        $company_address = $company_details['address'];
        $company_org_no = $company_details['org_no'];

        if ($ticket_data['category_type'] == 1) {
//inernal tickets
            $admin_data = $ticket_data['admin_user_data'];
            $affected_user_data = $ticket_data['affected_user_data'];

            $admin_user = utf8_encode($ticket_data['admin_user']);
            $admin_email = utf8_encode($admin_data['email']);
            $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
            $admin_phone = utf8_encode($admin_data['phone']);
            $admin_mobile = utf8_encode($admin_data['mobile']);

            $affected_user = utf8_encode($ticket_data['affected_user']);
            $affected_name = utf8_encode($affected_user_data['first_name'] . ' ' . $affected_user_data['last_name']);
            $affected_email = utf8_encode($affected_user_data['email']);
            $affected_phone = utf8_encode($affected_user_data['phone']);
            $affected_mobile = utf8_encode($affected_user_data['mobile']);

            $patterns = array();
            $patterns[0] = '/{id}/';
            $patterns[1] = '/{created_user}/';
            $patterns[2] = '/{created_name}/';
            $patterns[3] = '/{created_email}/';
            $patterns[4] = '/{created_phone}/';
            $patterns[5] = '/{created_mobile}/';
            $patterns[6] = '/{admin_user}/';
            $patterns[7] = '/{admin_name}/';
            $patterns[8] = '/{admin_email}/';
            $patterns[9] = '/{admin_phone}/';
            $patterns[10] = '/{admin_mobile}/';
            $patterns[11] = '/{affected_user}/';
            $patterns[12] = '/{affected_name}/';
            $patterns[13] = '/{affected_email}/';
            $patterns[14] = '/{affected_phone}/';
            $patterns[15] = '/{affected_mobile}/';
            $patterns[16] = '/{status}/';
            $patterns[17] = '/{category}/';
            $patterns[18] = '/{priority}/';
            $patterns[19] = '/{title}/';
            $patterns[20] = '/{description}/';
            $patterns[21] = '/{date}/';
            $patterns[22] = '/{url}/';
            $patterns[23] = '/{company_name}/';
            $patterns[24] = '/{company_email}/';
            $patterns[25] = '/{company_phone}/';
            $patterns[26] = '/{company_mobile}/';
            $patterns[27] = '/{company_website}/';
            $patterns[28] = '/{company_org_no}/';
            $patterns[29] = '/{company_address}/';


            $replacements = array();
            $replacements[0] = $ticket_id;
            $replacements[1] = $created_user;
            $replacements[2] = $created_name;
            $replacements[3] = $created_email;
            $replacements[4] = $created_phone;
            $replacements[5] = $created_mobile;
            $replacements[6] = $admin_user;
            $replacements[7] = $admin_name;
            $replacements[8] = $admin_email;
            $replacements[9] = $admin_phone;
            $replacements[10] = $admin_mobile;
            $replacements[11] = $affected_user;
            $replacements[12] = $affected_name;
            $replacements[13] = $affected_email;
            $replacements[14] = $affected_phone;
            $replacements[15] = $affected_mobile;
            $replacements[16] = $ticket_status;
            $replacements[17] = $ticket_category;
            $replacements[18] = $ticket_priority;
            $replacements[19] = $ticket_title;
            $replacements[20] = $ticket_description;
            $replacements[21] = $ticket_date;
            $replacements[22] = $link;
            $replacements[23] = $company_name;
            $replacements[24] = $company_email;
            $replacements[25] = $company_phone;
            $replacements[26] = $company_mobile;
            $replacements[27] = $company_website;
            $replacements[28] = $company_org_no;
            $replacements[29] = $company_address;

//email to admin when posting a new internal tickets
            $email_model = $this->get_email_model(1);
            $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
            $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
            $mail = new SupportMails();
            $mail->setFrom($created_name, $created_email);
            $mail->addRecipient($admin_name, $admin_email);
            // echo "<pre>admin details: ".print_r(array($admin_name, $admin_email), 1)."</pre>";
            $mail->fillSubject(utf8_decode($mail_subject));
            $mail->fillMessage(utf8_decode($mail_message));
            $mail->send($company_id);

//ticket conformation to creator
            $email_model = $this->get_email_model(3);
            $mail_sender = preg_replace($patterns, $replacements, utf8_encode($email_model['sender']));
            $mail_sender_name = preg_replace($patterns, $replacements, utf8_encode($email_model['sender_name']));
            $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
            $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
            $mail = new SupportMails();
            $mail->setFrom($mail_sender_name, $mail_sender);
            $mail->addRecipient($created_name, $created_email);
            $mail->fillSubject(utf8_decode($mail_subject));
            $mail->fillMessage(utf8_decode($mail_message));
            $mail->send($company_id);
        } elseif ($ticket_data['category_type'] == 2) {
//external tickets
            $admin_data = $cirrus_support;

            $admin_email = utf8_encode($admin_data['email']);
            $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
            $admin_phone = utf8_encode($admin_data['phone']);
            $admin_mobile = utf8_encode($admin_data['mobile']);

            $ticket_type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);

            $patterns = array();
            $patterns[0] = '/{id}/';
            $patterns[1] = '/{created_user}/';
            $patterns[2] = '/{created_name}/';
            $patterns[3] = '/{created_email}/';
            $patterns[4] = '/{created_phone}/';
            $patterns[5] = '/{created_mobile}/';
            $patterns[6] = '/{admin_name}/';
            $patterns[7] = '/{admin_email}/';
            $patterns[8] = '/{admin_phone}/';
            $patterns[9] = '/{admin_mobile}/';
            $patterns[10] = '/{affected_user}/';
            $patterns[11] = '/{affected_name}/';
            $patterns[12] = '/{affected_email}/';
            $patterns[13] = '/{affected_phone}/';
            $patterns[14] = '/{affected_mobile}/';
            $patterns[15] = '/{type}/';
            $patterns[16] = '/{status}/';
            $patterns[17] = '/{category}/';
            $patterns[18] = '/{priority}/';
            $patterns[19] = '/{title}/';
            $patterns[20] = '/{description}/';
            $patterns[21] = '/{date}/';
            $patterns[22] = '/{url}/';
            $patterns[23] = '/{company_name}/';
            $patterns[24] = '/{company_email}/';
            $patterns[25] = '/{company_phone}/';
            $patterns[26] = '/{company_mobile}/';
            $patterns[27] = '/{company_website}/';
            $patterns[28] = '/{company_org_no}/';
            $patterns[29] = '/{company_address}/';


            $replacements = array();
            $replacements[0] = $ticket_id;
            $replacements[1] = $created_user;
            $replacements[2] = $created_name;
            $replacements[3] = $created_email;
            $replacements[4] = $created_phone;
            $replacements[5] = $created_mobile;
            $replacements[6] = $admin_name;
            $replacements[7] = $admin_email;
            $replacements[8] = $admin_phone;
            $replacements[9] = $admin_mobile;
            $replacements[10] = $affected_user;
            $replacements[11] = $affected_name;
            $replacements[12] = $affected_email;
            $replacements[13] = $affected_phone;
            $replacements[14] = $affected_mobile;
            $replacements[15] = $ticket_type;
            $replacements[16] = $ticket_status;
            $replacements[17] = $ticket_category;
            $replacements[18] = $ticket_priority;
            $replacements[19] = $ticket_title;
            $replacements[20] = $ticket_description;
            $replacements[21] = $ticket_date;
            $replacements[22] = $link;
            $replacements[23] = $company_name;
            $replacements[24] = $company_email;
            $replacements[25] = $company_phone;
            $replacements[26] = $company_mobile;
            $replacements[27] = $company_website;
            $replacements[28] = $company_org_no;
            $replacements[29] = $company_address;

//email to cirrus team when posting a new external tickets
            $email_model = $this->get_email_model(2);
            $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
            $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
            $mail = new SupportMails();
            $mail->setFrom($created_name, $created_email);
            $mail->addRecipient($admin_name, $admin_email);
            $mail->fillSubject(utf8_decode($mail_subject));
            $mail->fillMessage(utf8_decode($mail_message));
            $mail->send($company_id);

//ticket conformation to creator
            $email_model = $this->get_email_model(4);
            $mail_sender = preg_replace($patterns, $replacements, utf8_encode($email_model['sender']));
            $mail_sender_name = preg_replace($patterns, $replacements, utf8_encode($email_model['sender_name']));
            $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
            $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
            $mail = new SupportMails();
            $mail->setFrom($mail_sender_name, $mail_sender);
            $mail->addRecipient($created_name, $created_email);
            $mail->fillSubject(utf8_decode($mail_subject));
            $mail->fillMessage(utf8_decode($mail_message));
            $mail->send($company_id);
        }
        return TRUE;
    }

    function update_ticket_category_by_admin($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        $ticket_master = $this->get_ticket_master($ticket_id);
        $company_data = $this->get_companies($ticket_master['company_id']);
        $company_db = $company_data[0]['db_name'];
        $this->begin_transaction();
        $ticket_data = $this->get_ticket_details($ticket_id);
        $insert_status = 0;
        if ($this->category_type == 1) {
            $attachment = ($ticket_data['attachment'] != '' ? $ticket_data['attachment'] : NULL);
            $admin_user = ($ticket_data['admin_user'] != '' ? $ticket_data['admin_user'] : NULL);
            $affected_user = ($ticket_data['affected_user'] != '' ? $ticket_data['affected_user'] : NULL);
            $affected_user_phone = ($ticket_data['affected_user_phone'] != '' ? $ticket_data['affected_user_phone'] : NULL);
            $this->tables = array($company_db . '.support_tickets');
            $this->fields = array('id', 'created_user', 'admin_user', 'category_id', 'priority', 'affected_user', 'affected_user_phone', 'title', 'description', 'attachment', 'status', 'date');
            $this->field_values = array($ticket_id, $ticket_data['created_user'], $admin_user, $ticket_data['category_id'], $ticket_data['priority'], $affected_user, $affected_user_phone, $ticket_data['title'], $ticket_data['description'], $attachment, $ticket_data['status'], $ticket_data['date']);
            if ($this->query_insert()) {
                $insert_status = 1;
            }
        } else {
            $attachment = ($ticket_data['attachment'] != '' ? $ticket_data['attachment'] : NULL);
            $this->tables = array($db_master . '.support_tickets');
            $this->fields = array('id', 'created_user', 'ticket_type', 'category_id', 'priority', 'title', 'description', 'attachment', 'status', 'date');
            $this->field_values = array($ticket_id, $ticket_data['created_user'], $this->ticket_type, $ticket_data['category_id'], $ticket_data['priority'], $ticket_data['title'], $ticket_data['description'], $attachment, $ticket_data['status'], $ticket_data['date']);
            if ($this->query_insert()) {
                $insert_status = 1;
            }
        }
        if ($insert_status) {
            $ticket_answer_datas = $this->get_ticket_answers_asc($ticket_id);
            $i = 0;
            foreach ($ticket_answer_datas as $ticket_answer) {
                $attachment = ($ticket_answer['attachment'] != '' ? $ticket_answer['attachment'] : NULL);
                if ($this->category_type == 1) {
                    $admin_user = ($ticket_answer['admin_user'] != '' ? $ticket_answer['admin_user'] : NULL);
                    //insert internal ticket answer details
                    $this->tables = array($company_db . '.support_ticket_answers');
                    $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'admin_user', 'status', 'attachment', 'hidden', 'date');
                    $this->field_values = array($ticket_id, $ticket_answer['submited_user'], $ticket_answer['answer'], $ticket_answer['category_id'], $ticket_answer['priority'], $admin_user, $ticket_answer['status'], $attachment, $ticket_answer['hidden'], $ticket_answer['date']);
                } else {
                    //inser external ticket answer details
                    $this->tables = array($db_master . '.support_ticket_answers');
                    $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'ticket_type', 'status', 'attachment', 'hidden', 'date');
                    $this->field_values = array($ticket_id, $ticket_answer['submited_user'], $ticket_answer['answer'], $ticket_answer['category_id'], $ticket_answer['priority'], NULL, $ticket_answer['status'], $attachment, $ticket_answer['hidden'], $ticket_answer['date']);
                }
                if ($this->query_insert()) {
                    $i++;
                }
            }
            if ($i == count($ticket_answer_datas)) {
                $this->update_ticket_master($ticket_id);
                if ($ticket_master['category_type'] == 1) {
                    $this->tables = array($company_db . '.support_tickets');
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($ticket_id);
                    if ($this->query_delete()) {
                        $this->commit_transaction();
                        return TRUE;
                    } else {
                        $this->rollback_transaction();
                        return FALSE;
                    }
                } else {
                    $this->tables = array($db_master . '.support_tickets');
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($ticket_id);
                    if ($this->query_delete()) {
                        $this->commit_transaction();
                        return TRUE;
                    } else {
                        $this->rollback_transaction();
                        return FALSE;
                    }
                }
            } else {
                $this->rollback_transaction();
                return FALSE;
            }
        } else {
            $this->rollback_transaction();
            return FALSE;
        }
    }

    function insert_ticket_answer() {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $this->id > 0) {

            $ticket_master = $this->get_ticket_master($this->id);
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];
            $this->login_user = $_SESSION['user_id'];
            if (!empty($ticket_master)) {
                if ($ticket_master['category_type'] == $this->category_type) {

                    if ($ticket_master['category_type'] == 1) {
                        //insert internal ticket answer details
                        $this->tables = array($company_db . '.support_ticket_answers');
                        $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'admin_user', 'status', 'hidden');
                        $this->field_values = array($this->id, $this->login_user, $this->answer, $this->answer_category_id, $this->answer_priority, $this->answer_admin_user, $this->answer_status, $this->answer_hidden);
                    } else {
                        //inser external ticket answer details
                        $this->tables = array($db_master . '.support_ticket_answers');
                        $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'ticket_type', 'status', 'hidden');
                        $this->field_values = array($this->id, $this->login_user, $this->answer, $this->answer_category_id, $this->answer_priority, $this->answer_ticket_type, $this->answer_status, $this->answer_hidden);
                    }
                    $this->query_insert();
                    $answer_id = $this->get_id();
                    $this->answer_id = $answer_id;
                    $this->append_ticket_answer_attachments($this->id, $answer_id);
                    $this->mail_send_ticket_answer_update($this->id, $answer_id);
                    return $answer_id;
                } else {
                    if ($this->update_ticket_category_by_admin($this->id)) {
                        if ($this->category_type == 1) {
                            //insert internal ticket answer details
                            $this->tables = array($company_db . '.support_ticket_answers');
                            $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'admin_user', 'status', 'hidden');
                            $this->field_values = array($this->id, $this->login_user, $this->answer, $this->answer_category_id, $this->answer_priority, $this->answer_admin_user, $this->answer_status, $this->answer_hidden);
                        } else {
                            //inser external ticket answer details
                            $this->tables = array($db_master . '.support_ticket_answers');
                            $this->fields = array('ticket_id', 'submited_user', 'answer', 'category_id', 'priority', 'ticket_type', 'status', 'hidden');
                            $this->field_values = array($this->id, $this->login_user, $this->answer, $this->answer_category_id, $this->answer_priority, $this->answer_ticket_type, $this->answer_status, $this->answer_hidden);
                        }
                        $this->query_insert();
                        $answer_id = $this->get_id();
                        $this->answer_id = $answer_id;
                        $this->append_ticket_answer_attachments($this->id, $answer_id);
                        $this->mail_send_ticket_answer_update($this->id, $answer_id);
                        return $answer_id;
                    }
                }
            }
        }
        return FALSE;
    }

    function mail_send_ticket_answer_update($ticket_id, $answer_id) {

        global $preference, $support_priority, $support_status, $support_ticket_type, $cirrus_support, $cirrus_admins;

        $user = new user();
        $base_url = $preference['url'];
        $ticket_data = $this->get_ticket_details($ticket_id);
        $company_id = $ticket_data['company_id'];
        $company_data = $this->get_companies($company_id);
        $company_details = $company_data[0];
        $answer_details = $this->get_ticket_answer_details($ticket_id, $answer_id);
        if ($answer_details['hidden'] != 1) {

            $url = $base_url . 'supporttickets/detail/' . $ticket_id . '/' . $company_id . '/';
            $link = "<a href='$url'>$url</a>";

            $created_user_data = $ticket_data['created_user_data'];
            $answer_submited_user_data = $answer_details['submited_user_data'];

            $created_user = utf8_encode($ticket_data['created_user']);
            $created_email = utf8_encode($created_user_data['email']);
            $created_name = utf8_encode($created_user_data['first_name'] . ' ' . $created_user_data['last_name']);
            $created_phone = utf8_encode($created_user_data['phone']);
            $created_mobile = utf8_encode($created_user_data['mobile']);

            $answer_user = utf8_encode($answer_details['submited_user']);
            $answer_email = utf8_encode($answer_submited_user_data['email']);
            $answer_name = utf8_encode($answer_submited_user_data['first_name'] . ' ' . $answer_submited_user_data['last_name']);
            $answer_phone = utf8_encode($answer_submited_user_data['phone']);
            $answer_mobile = utf8_encode($answer_submited_user_data['mobile']);
            $answer_role = $user->user_role($answer_user);

            $ticket_status = utf8_encode($support_status[$ticket_data['status']]);
            $ticket_priority = utf8_encode($support_priority[$ticket_data['priority']]);
            $ticket_category = utf8_encode($ticket_data['category']);
            $ticket_date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
            $ticket_title = utf8_encode($ticket_data['title']);
            $ticket_description = utf8_encode($ticket_data['description']);

            $answer_status = utf8_encode($support_status[$answer_details['status']]);
            $answer_priority = utf8_encode($support_priority[$answer_details['priority']]);
            $answer_category = utf8_encode($answer_details['category']);
            $answer_date = utf8_encode($answer_details['date']);
            $answer = utf8_encode($answer_details['answer']);

            $company_name = $company_details['name'];
            $company_email = $company_details['email'];
            $company_phone = $company_details['phone'];
            $company_mobile = $company_details['mobile'];
            $company_website = $company_details['website'];
            $company_address = $company_details['address'];
            $company_org_no = $company_details['org_no'];

            if ($ticket_data['category_type'] == 1) {
                //inernal tickets
                $admin_data = $ticket_data['admin_user_data'];
                $affected_user_data = $ticket_data['affected_user_data'];

                $admin_user = utf8_encode($ticket_data['admin_user']);
                $admin_email = utf8_encode($admin_data['email']);
                $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
                $admin_phone = utf8_encode($admin_data['phone']);
                $admin_mobile = utf8_encode($admin_data['mobile']);

                $affected_user = utf8_encode($ticket_data['affected_user']);
                $affected_name = utf8_encode($affected_user_data['first_name'] . ' ' . $affected_user_data['last_name']);
                $affected_email = utf8_encode($affected_user_data['email']);
                $affected_phone = utf8_encode($affected_user_data['phone']);
                $affected_mobile = utf8_encode($affected_user_data['mobile']);

                $answer_admin_user_data = $answer_details['admin_user_data'];
                $answer_admin_user = array();
                $answer_admin_name = array();
                $answer_admin_email = array();
                $answer_admin_phone = array();
                $answer_admin_mobile = array();
                if (is_array($answer_admin_user_data)) {
                    foreach ($answer_admin_user_data as $answer_admin_user) {
                        $answer_admin_user[] = utf8_encode($answer_admin_user['username']);
                        $answer_admin_name[] = utf8_encode($answer_admin_user['first_name'] . ' ' . $answer_admin_user['last_name']);
                        $answer_admin_email[] = utf8_encode($answer_admin_user['email']);
                        $answer_admin_phone[] = utf8_encode($answer_admin_user['phone']);
                        $answer_admin_mobile[] = utf8_encode($answer_admin_user['mobile']);
                    }
                    $answer_admin_users = implode(', ', $answer_admin_user);
                    $answer_admin_names = implode(', ', $answer_admin_name);
                    $answer_admin_emails = implode(', ', $answer_admin_email);
                    $answer_admin_phones = implode(', ', $answer_admin_phone);
                    $answer_admin_mobiles = implode(', ', $answer_admin_mobile);
                } else {
                    $answer_admin_users = utf8_encode($answer_admin_user_data['username']);
                    $answer_admin_names = utf8_encode($answer_admin_user_data['first_name'] . ' ' . $answer_admin_user['last_name']);
                    $answer_admin_emails = utf8_encode($answer_admin_user_data['email']);
                    $answer_admin_phones = utf8_encode($answer_admin_user_data['phone']);
                    $answer_admin_mobiles = utf8_encode($answer_admin_user_data['mobile']);
                }

                $patterns = array();
                $patterns[0] = '/{id}/';
                $patterns[1] = '/{created_user}/';
                $patterns[2] = '/{created_name}/';
                $patterns[3] = '/{created_email}/';
                $patterns[4] = '/{created_phone}/';
                $patterns[5] = '/{created_mobile}/';
                $patterns[6] = '/{admin_user}/';
                $patterns[7] = '/{admin_name}/';
                $patterns[8] = '/{admin_email}/';
                $patterns[9] = '/{admin_phone}/';
                $patterns[10] = '/{admin_mobile}/';
                $patterns[11] = '/{affected_user}/';
                $patterns[12] = '/{affected_name}/';
                $patterns[13] = '/{affected_email}/';
                $patterns[14] = '/{affected_phone}/';
                $patterns[15] = '/{affected_mobile}/';
                $patterns[16] = '/{status}/';
                $patterns[17] = '/{category}/';
                $patterns[18] = '/{priority}/';
                $patterns[19] = '/{title}/';
                $patterns[20] = '/{description}/';
                $patterns[21] = '/{date}/';
                $patterns[22] = '/{url}/';
                $patterns[23] = '/{company_name}/';
                $patterns[24] = '/{company_email}/';
                $patterns[25] = '/{company_phone}/';
                $patterns[26] = '/{company_mobile}/';
                $patterns[27] = '/{company_website}/';
                $patterns[28] = '/{company_org_no}/';
                $patterns[29] = '/{company_address}/';
                $patterns[30] = '/{answer_user}/';
                $patterns[31] = '/{answer_name}/';
                $patterns[32] = '/{answer_email}/';
                $patterns[33] = '/{answer_phone}/';
                $patterns[34] = '/{answer_mobile}/';
                $patterns[35] = '/{answer_status}/';
                $patterns[36] = '/{answer_priority}/';
                $patterns[37] = '/{answer_category}/';
                $patterns[38] = '/{answer_date}/';
                $patterns[39] = '/{answer}/';
                $patterns[40] = '/{answer_admin_user}/';
                $patterns[41] = '/{answer_admin_name}/';
                $patterns[42] = '/{answer_admin_email}/';
                $patterns[43] = '/{answer_admin_phone}/';
                $patterns[44] = '/{answer_admin_mobile}/';

                $replacements = array();
                $replacements[0] = $ticket_id;
                $replacements[1] = $created_user;
                $replacements[2] = $created_name;
                $replacements[3] = $created_email;
                $replacements[4] = $created_phone;
                $replacements[5] = $created_mobile;
                $replacements[6] = $admin_user;
                $replacements[7] = $admin_name;
                $replacements[8] = $admin_email;
                $replacements[9] = $admin_phone;
                $replacements[10] = $admin_mobile;
                $replacements[11] = $affected_user;
                $replacements[12] = $affected_name;
                $replacements[13] = $affected_email;
                $replacements[14] = $affected_phone;
                $replacements[15] = $affected_mobile;
                $replacements[16] = $ticket_status;
                $replacements[17] = $ticket_category;
                $replacements[18] = $ticket_priority;
                $replacements[19] = $ticket_title;
                $replacements[20] = $ticket_description;
                $replacements[21] = $ticket_date;
                $replacements[22] = $link;
                $replacements[23] = $company_name;
                $replacements[24] = $company_email;
                $replacements[25] = $company_phone;
                $replacements[26] = $company_mobile;
                $replacements[27] = $company_website;
                $replacements[28] = $company_org_no;
                $replacements[29] = $company_address;
                $replacements[30] = $answer_user;
                $replacements[31] = $answer_name;
                $replacements[32] = $answer_email;
                $replacements[33] = $answer_phone;
                $replacements[34] = $answer_mobile;
                $replacements[35] = $answer_status;
                $replacements[36] = $answer_priority;
                $replacements[37] = $answer_category;
                $replacements[38] = $answer_date;
                $replacements[39] = $answer;
                $replacements[40] = $answer_admin_users;
                $replacements[41] = $answer_admin_names;
                $replacements[42] = $answer_admin_emails;
                $replacements[43] = $answer_admin_phones;
                $replacements[44] = $answer_admin_mobiles;

                if ($answer_user == $created_user) {
                    //email to admin when posting answer for a tickets by created user
                    $email_model = $this->get_email_model(5);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($created_name, $created_email);
                    for ($i = 0; $i < count($answer_admin_email); $i++) {
                        if ($answer_admin_email[$i] != '') {
                            $mail->addRecipient($answer_admin_name[$i], $answer_admin_email[$i]);
                        }
                    }
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
                } elseif ($answer_role == 1 || $answer_role == 2 || $answer_role == 6 || $answer_role == 7) {
                    //email to creator when posting answer by admin for a ticket
                    $email_model = $this->get_email_model(6);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($answer_name, $answer_email);
                    $mail->addRecipient($created_name, $created_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
                }
            } elseif ($ticket_data['category_type'] == 2) {
                //external tickets
                $admin_data = $cirrus_support;

                $admin_email = utf8_encode($admin_data['email']);
                $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
                $admin_phone = utf8_encode($admin_data['phone']);
                $admin_mobile = utf8_encode($admin_data['mobile']);

                $ticket_type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);
                $answer_type = utf8_encode($support_ticket_type[$answer_details['ticket_type']]);

                $patterns = array();
                $patterns[0] = '/{id}/';
                $patterns[1] = '/{created_user}/';
                $patterns[2] = '/{created_name}/';
                $patterns[3] = '/{created_email}/';
                $patterns[4] = '/{created_phone}/';
                $patterns[5] = '/{created_mobile}/';
                $patterns[6] = '/{admin_name}/';
                $patterns[7] = '/{admin_email}/';
                $patterns[8] = '/{admin_phone}/';
                $patterns[9] = '/{admin_mobile}/';
                $patterns[10] = '/{affected_user}/';
                $patterns[11] = '/{affected_name}/';
                $patterns[12] = '/{affected_email}/';
                $patterns[13] = '/{affected_phone}/';
                $patterns[14] = '/{affected_mobile}/';
                $patterns[15] = '/{type}/';
                $patterns[16] = '/{status}/';
                $patterns[17] = '/{category}/';
                $patterns[18] = '/{priority}/';
                $patterns[19] = '/{title}/';
                $patterns[20] = '/{description}/';
                $patterns[21] = '/{date}/';
                $patterns[22] = '/{url}/';
                $patterns[23] = '/{company_name}/';
                $patterns[24] = '/{company_email}/';
                $patterns[25] = '/{company_phone}/';
                $patterns[26] = '/{company_mobile}/';
                $patterns[27] = '/{company_website}/';
                $patterns[28] = '/{company_org_no}/';
                $patterns[29] = '/{company_address}/';
                $patterns[30] = '/{answer_user}/';
                $patterns[31] = '/{answer_name}/';
                $patterns[32] = '/{answer_email}/';
                $patterns[33] = '/{answer_phone}/';
                $patterns[34] = '/{answer_mobile}/';
                $patterns[35] = '/{answer_status}/';
                $patterns[36] = '/{answer_type}/';
                $patterns[37] = '/{answer_priority}/';
                $patterns[38] = '/{answer_category}/';
                $patterns[39] = '/{answer_date}/';
                $patterns[40] = '/{answer}/';


                $replacements = array();
                $replacements[0] = $ticket_id;
                $replacements[1] = $created_user;
                $replacements[2] = $created_name;
                $replacements[3] = $created_email;
                $replacements[4] = $created_phone;
                $replacements[5] = $created_mobile;
                $replacements[6] = $admin_name;
                $replacements[7] = $admin_email;
                $replacements[8] = $admin_phone;
                $replacements[9] = $admin_mobile;
                $replacements[10] = $affected_user;
                $replacements[11] = $affected_name;
                $replacements[12] = $affected_email;
                $replacements[13] = $affected_phone;
                $replacements[14] = $affected_mobile;
                $replacements[15] = $ticket_type;
                $replacements[16] = $ticket_status;
                $replacements[17] = $ticket_category;
                $replacements[18] = $ticket_priority;
                $replacements[19] = $ticket_title;
                $replacements[20] = $ticket_description;
                $replacements[21] = $ticket_date;
                $replacements[22] = $link;
                $replacements[23] = $company_name;
                $replacements[24] = $company_email;
                $replacements[25] = $company_phone;
                $replacements[26] = $company_mobile;
                $replacements[27] = $company_website;
                $replacements[28] = $company_org_no;
                $replacements[29] = $company_address;
                $replacements[30] = $answer_user;
                $replacements[31] = $answer_name;
                $replacements[32] = $answer_email;
                $replacements[33] = $answer_phone;
                $replacements[34] = $answer_mobile;
                $replacements[35] = $answer_status;
                $replacements[36] = $answer_type;
                $replacements[37] = $answer_priority;
                $replacements[38] = $answer_category;
                $replacements[39] = $answer_date;
                $replacements[40] = $answer;
                if ($answer_user == $created_user) {
                    //email to admin when posting answer for a tickets by created user
                    $email_model = $this->get_email_model(7);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($created_name, $created_email);
                    $mail->addRecipient($admin_name, $admin_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
                    //send mail to answered user
                    $email_model = $this->get_email_model(12);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($admin_name, $admin_email);
                    $mail->addRecipient($answer_name, $answer_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
                } elseif (in_array($answer_user, $cirrus_admins)) {
                    //email to creator when posting answer by cirrus admin for a ticket
                    $email_model = $this->get_email_model(8);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();

                    $mail->setFrom($answer_name, $answer_email);
                    $mail->addRecipient($created_name, $created_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);

                    //send mail to answered user
                    $email_model = $this->get_email_model(12);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($admin_name, $admin_email);
                    $mail->addRecipient($answer_name, $answer_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
                } elseif ($answer_role == 1 || $answer_role == 2 || $answer_role == 6 || $answer_role == 7) {
                    //email to creator when posting answer by admin for a ticket
                    $email_model = $this->get_email_model(9);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($answer_name, $answer_email);
                    $mail->addRecipient($created_name, $created_email);
                    $mail->addRecipient($answer_name, $answer_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
                }
            }
        }else{
            $url = $base_url . 'supporttickets/detail/' . $ticket_id . '/' . $company_id . '/';
            $link = "<a href='$url'>$url</a>";

            $created_user_data = $ticket_data['created_user_data'];
            $answer_submited_user_data = $answer_details['submited_user_data'];
            //echo "<pre>".print_r($ticket_data['created_user_data'], 1)."</pre>";
            //exit;
            $created_user = utf8_encode($ticket_data['created_user']);
            $created_email = utf8_encode($created_user_data['email']);
            $created_name = utf8_encode($created_user_data['first_name'] . ' ' . $created_user_data['last_name']);
            $created_phone = utf8_encode($created_user_data['phone']);
            $created_mobile = utf8_encode($created_user_data['mobile']);

            $answer_user = utf8_encode($answer_details['submited_user']);
            $answer_email = utf8_encode($answer_submited_user_data['email']);
            $answer_name = utf8_encode($answer_submited_user_data['first_name'] . ' ' . $answer_submited_user_data['last_name']);
            $answer_phone = utf8_encode($answer_submited_user_data['phone']);
            $answer_mobile = utf8_encode($answer_submited_user_data['mobile']);
            $answer_role = $user->user_role($answer_user);

            $ticket_status = utf8_encode($support_status[$ticket_data['status']]);
            $ticket_priority = utf8_encode($support_priority[$ticket_data['priority']]);
            $ticket_category = utf8_encode($ticket_data['category']);
            $ticket_date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
            $ticket_title = utf8_encode($ticket_data['title']);
            $ticket_description = utf8_encode($ticket_data['description']);

            $answer_status = utf8_encode($support_status[$answer_details['status']]);
            $answer_priority = utf8_encode($support_priority[$answer_details['priority']]);
            $answer_category = utf8_encode($answer_details['category']);
            $answer_date = utf8_encode($answer_details['date']);
            $answer = utf8_encode($answer_details['answer']);

            $company_name = $company_details['name'];
            $company_email = $company_details['email'];
            $company_phone = $company_details['phone'];
            $company_mobile = $company_details['mobile'];
            $company_website = $company_details['website'];
            $company_address = $company_details['address'];
            $company_org_no = $company_details['org_no'];
            
            if ($ticket_data['category_type'] == 2) {
                //external tickets
                $admin_data = $cirrus_support;

                $admin_email = utf8_encode($admin_data['email']);
                $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
                $admin_phone = utf8_encode($admin_data['phone']);
                $admin_mobile = utf8_encode($admin_data['mobile']);

                $ticket_type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);
                $answer_type = utf8_encode($support_ticket_type[$answer_details['ticket_type']]);

                $patterns = array();
                $patterns[0] = '/{id}/';
                $patterns[1] = '/{created_user}/';
                $patterns[2] = '/{created_name}/';
                $patterns[3] = '/{created_email}/';
                $patterns[4] = '/{created_phone}/';
                $patterns[5] = '/{created_mobile}/';
                $patterns[6] = '/{admin_name}/';
                $patterns[7] = '/{admin_email}/';
                $patterns[8] = '/{admin_phone}/';
                $patterns[9] = '/{admin_mobile}/';
                $patterns[10] = '/{affected_user}/';
                $patterns[11] = '/{affected_name}/';
                $patterns[12] = '/{affected_email}/';
                $patterns[13] = '/{affected_phone}/';
                $patterns[14] = '/{affected_mobile}/';
                $patterns[15] = '/{type}/';
                $patterns[16] = '/{status}/';
                $patterns[17] = '/{category}/';
                $patterns[18] = '/{priority}/';
                $patterns[19] = '/{title}/';
                $patterns[20] = '/{description}/';
                $patterns[21] = '/{date}/';
                $patterns[22] = '/{url}/';
                $patterns[23] = '/{company_name}/';
                $patterns[24] = '/{company_email}/';
                $patterns[25] = '/{company_phone}/';
                $patterns[26] = '/{company_mobile}/';
                $patterns[27] = '/{company_website}/';
                $patterns[28] = '/{company_org_no}/';
                $patterns[29] = '/{company_address}/';
                $patterns[30] = '/{answer_user}/';
                $patterns[31] = '/{answer_name}/';
                $patterns[32] = '/{answer_email}/';
                $patterns[33] = '/{answer_phone}/';
                $patterns[34] = '/{answer_mobile}/';
                $patterns[35] = '/{answer_status}/';
                $patterns[36] = '/{answer_type}/';
                $patterns[37] = '/{answer_priority}/';
                $patterns[38] = '/{answer_category}/';
                $patterns[39] = '/{answer_date}/';
                $patterns[40] = '/{answer}/';


                $replacements = array();
                $replacements[0] = $ticket_id;
                $replacements[1] = $created_user;
                $replacements[2] = $created_name;
                $replacements[3] = $created_email;
                $replacements[4] = $created_phone;
                $replacements[5] = $created_mobile;
                $replacements[6] = $admin_name;
                $replacements[7] = $admin_email;
                $replacements[8] = $admin_phone;
                $replacements[9] = $admin_mobile;
                $replacements[10] = $affected_user;
                $replacements[11] = $affected_name;
                $replacements[12] = $affected_email;
                $replacements[13] = $affected_phone;
                $replacements[14] = $affected_mobile;
                $replacements[15] = $ticket_type;
                $replacements[16] = $ticket_status;
                $replacements[17] = $ticket_category;
                $replacements[18] = $ticket_priority;
                $replacements[19] = $ticket_title;
                $replacements[20] = $ticket_description;
                $replacements[21] = $ticket_date;
                $replacements[22] = $link;
                $replacements[23] = $company_name;
                $replacements[24] = $company_email;
                $replacements[25] = $company_phone;
                $replacements[26] = $company_mobile;
                $replacements[27] = $company_website;
                $replacements[28] = $company_org_no;
                $replacements[29] = $company_address;
                $replacements[30] = $answer_user;
                $replacements[31] = $answer_name;
                $replacements[32] = $answer_email;
                $replacements[33] = $answer_phone;
                $replacements[34] = $answer_mobile;
                $replacements[35] = $answer_status;
                $replacements[36] = $answer_type;
                $replacements[37] = $answer_priority;
                $replacements[38] = $answer_category;
                $replacements[39] = $answer_date;
                $replacements[40] = $answer;
                    //email to admin when posting answer for a tickets by created user
                    $email_model = $this->get_email_model(7);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    
                    $mail->setFrom($answer_user, $answer_email);
                    $mail->addRecipient($admin_name, $admin_email);
                    $mail->addRecipient('Shaju KT', 'shajukt@entraze.com'); 
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);

                    //send mail to answered user
                    $email_model = $this->get_email_model(12);
                    $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                    $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                    $mail = new SupportMails ();
                    $mail->setFrom($admin_name, $admin_email);
                    $mail->addRecipient($answer_name, $answer_email);
                    $mail->fillSubject(utf8_decode($mail_subject));
                    $mail->fillMessage(utf8_decode($mail_message));
                    $mail->send($company_id);
            }

            
        }
        return TRUE;
    }

    function get_ticket_answer_details($ticket_id, $answer_id) {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $ticket_id > 0 && (int) $answer_id > 0) {
            $ticket_master = $this->get_ticket_master($ticket_id);
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];

            if ($ticket_master['category_type'] == 1) {
                //internal ticket
                $sql_query = 'SELECT '
                        . 'ta.id, ta.submited_user, ta.answer, '
                        . 'ta.category_id, sc.name AS category, ta.priority, '
                        . 'ta.admin_user, ta.attachment, ta.status, ta.date, ta.hidden '
                        . 'FROM ' . $company_db . '.support_ticket_answers ta INNER JOIN ' . $db_master . '.support_categories sc ON sc.id = ta.category_id '
                        . 'WHERE ta.id = ' . $answer_id;
                $this->sql_query = $sql_query;
                $data = $this->query_fetch();
                $data[0]['company_id'] = $ticket_master['company_id'];
                $data[0]['category_type'] = $ticket_master['category_type'];
                $submited_user_data = $this->get_user_details($data[0]['submited_user'], $ticket_master['company_id']);
                $data[0]['submited_user_data'] = $submited_user_data;
                if ($data[0]['admin_user'] != "") {
                    $admin_users = explode(',', $data[0]['admin_user']);
                    $admin_user_data = array();
                    foreach ($admin_users as $admin_user) {
                        $admin_user_data[] = $this->get_user_details($admin_user, $ticket_master['company_id']);
                    }
                    $data[0]['admin_user_data'] = $admin_user_data;
                }
            } elseif ($ticket_master['category_type'] == 2) {
                //external ticket
                $sql_query = 'SELECT '
                        . 'ta.id, ta.submited_user, ta.answer, '
                        . 'ta.category_id, sc.name AS category, ta.priority, '
                        . 'ta.ticket_type, ta.attachment, ta.status, ta.date, ta.hidden '
                        . 'FROM ' . $db_master . '.support_ticket_answers ta INNER JOIN ' . $db_master . '.support_categories sc ON sc.id = ta.category_id '
                        . 'WHERE ta.id = ' . $answer_id;
                $this->sql_query = $sql_query;
                $data = $this->query_fetch();
                $data[0]['company_id'] = $ticket_master['company_id'];
                $data[0]['category_type'] = $ticket_master['category_type'];
                $submited_user_data = $this->get_user_details($data[0]['submited_user'], $ticket_master['company_id']);
                $data[0]['submited_user_data'] = $submited_user_data;
            }
            return $data[0];
        }
        return FALSE;
    }

    function get_ticket_answers($ticket_id, $strip_tag_outputs = TRUE) {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $ticket_id > 0) {
            $ticket_master = $this->get_ticket_master($ticket_id);
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];
            $ticket_answers = array();
            if ($ticket_master['category_type'] == 1) {
                //internal ticket
                $this->sql_query = "SELECT sta.ticket_id as id, sta.submited_user, sta.admin_user, sta.answer, sta.category_id, sc.name AS category, sta.priority, sta.attachment, sta.status, sta.date, sta.hidden FROM " . $company_db . ".support_ticket_answers sta INNER JOIN " . $db_master . ".support_categories sc ON sta.category_id = sc.id WHERE sta.ticket_id = $ticket_id ORDER BY sta.id DESC";
                $datas = $this->query_fetch();
                if (!empty($datas)) {
                    foreach ($datas as $data) 
                    {
                        
                        $attachment = $data['attachment'];
                        //this condition added by sanket 18032021
                        if($attachment != "")
                        {
                            $data['attachment'] = 'https://' . $_SERVER['SERVER_NAME'] . '/' . $folder . '/tickets/attachment/' . $attachment;
                            $data['file_name'] = $attachment;
                        }else
                        {
                            $data['attachment'] = "";
                             $data['file_name'] = "";
                        }
                        
                        $data['company_id'] = $ticket_master['company_id'];
                        $data['category_type'] = $ticket_master['category_type'];
                        $submited_user_data = $this->get_user_details($data['submited_user'], $ticket_master['company_id']);
                        $data['submited_user_data'] = $submited_user_data;
                        $data['answer'] = $strip_tag_outputs ? strip_tags($data['answer']) : $data['answer'];
                        if ($data['admin_user'] != "") {
                            $admin_users = explode(',', $data['admin_user']);
                            $admin_user_data = array();
                            foreach ($admin_users as $admin_user) {
                                $admin_user_data[] = $this->get_user_details($admin_user, $ticket_master['company_id']);
                            }
                            $data['admin_user_data'] = $admin_user_data;
                        }
                        $ticket_answers[] = $data;
                    }
                }
            } elseif ($ticket_master['category_type'] == 2) {
                //external ticket
                $this->sql_query = "SELECT sta.ticket_id as id, sta.submited_user, sta.answer, sta.category_id, sc.name AS category, sta.ticket_type, sta.priority, sta.attachment, sta.status, sta.date, sta.hidden FROM " . $db_master . ".support_ticket_answers sta INNER JOIN " . $db_master . ".support_categories sc ON sta.category_id = sc.id WHERE sta.ticket_id = $ticket_id ORDER BY sta.id DESC";
                $datas = $this->query_fetch();
                if (!empty($datas)) {
                    foreach ($datas as $data) 
                    {
                        $attachment = $data['attachment'];
                        //this condition added by sanket 18032021
                        if($attachment != "")
                        {
                            $data['attachment'] = 'https://' . $_SERVER['SERVER_NAME'] . '/' . $folder . '/tickets/attachment/' . $attachment;
                             $data['file_name'] = $attachment;
                        }else
                        {
                            $data['attachment'] = "";
                             $data['file_name'] = "";
                        }
                       
                        $data['company_id'] = $ticket_master['company_id'];
                        $data['answer'] = $strip_tag_outputs ? strip_tags($data['answer']) : $data['answer'];
                        $data['category_type'] = $ticket_master['category_type'];
                        $submited_user_data = $this->get_user_details($data['submited_user'], $ticket_master['company_id']);
                        $data['submited_user_data'] = $submited_user_data;
                        $ticket_answers[] = $data;
                    }
                }
            }
            return $ticket_answers;
        }
        return FALSE;
    }

    function get_ticket_answers_asc($ticket_id) {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $ticket_id > 0) {
            $ticket_master = $this->get_ticket_master($ticket_id);
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];
            $ticket_answers = array();
            if ($ticket_master['category_type'] == 1) {
                //internal ticket
                $this->sql_query = "SELECT sta.id, sta.submited_user, sta.admin_user, sta.answer, sta.category_id, sc.name AS category, sta.priority, sta.attachment, sta.status, sta.date, sta.hidden FROM " . $company_db . ".support_ticket_answers sta INNER JOIN " . $db_master . ".support_categories sc ON sta.category_id = sc.id WHERE sta.ticket_id = $ticket_id ORDER BY sta.id";
                $datas = $this->query_fetch();
                if (!empty($datas)) {
                    foreach ($datas as $data) {

                        $data['company_id'] = $ticket_master['company_id'];
                        $data['category_type'] = $ticket_master['category_type'];
                        $submited_user_data = $this->get_user_details($data['submited_user'], $ticket_master['company_id']);
                        $data['submited_user_data'] = $submited_user_data;
                        if ($data['admin_user'] != "") {
                            $admin_users = explode(',', $data['admin_user']);
                            $admin_user_data = array();
                            foreach ($admin_users as $admin_user) {
                                $admin_user_data[] = $this->get_user_details($admin_user, $ticket_master['company_id']);
                            }
                            $data['admin_user_data'] = $admin_user_data;
                        }
                        $ticket_answers[] = $data;
                    }
                }
            } elseif ($ticket_master['category_type'] == 2) {
                //external ticket
                $this->sql_query = "SELECT sta.id, sta.submited_user, sta.answer, sta.category_id, sc.name AS category, sta.ticket_type, sta.priority, sta.attachment, sta.status, sta.date, sta.hidden FROM " . $db_master . ".support_ticket_answers sta INNER JOIN " . $db_master . ".support_categories sc ON sta.category_id = sc.id WHERE sta.ticket_id = $ticket_id ORDER BY sta.id";
                $datas = $this->query_fetch();
                if (!empty($datas)) {
                    foreach ($datas as $data) {
                        $data['company_id'] = $ticket_master['company_id'];
                        $data['category_type'] = $ticket_master['category_type'];
                        $submited_user_data = $this->get_user_details($data['submited_user'], $ticket_master['company_id']);
                        $data['submited_user_data'] = $submited_user_data;
                        $ticket_answers[] = $data;
                    }
                }
            }
            return $ticket_answers;
        }
        return FALSE;
    }

    function append_ticket_answer_attachments($ticket_id, $answer_id) {

        global $db;
        $db_master = $db['database_master'];
        if ((int) $ticket_id > 0 && (int) $answer_id > 0) {
            $ticket_master = $this->get_ticket_master($ticket_id);
            $company_data = $this->get_companies($ticket_master['company_id']);
            $company_db = $company_data[0]['db_name'];
            $tmpFilePath = $this->answer_attachment['tmp_name'];
            if ($tmpFilePath != "") {
                $newName = strtotime(date("Y-m-d H:i:s")) . "_" . $this->answer_attachment['name'];
                $newName = str_replace(" ", "_", $newName);
                $company_upload_dir = $company_data[0]['upload_dir'];
                $app_dir = getcwd();
                if (!is_dir($app_dir . "/" . $company_upload_dir . "/")) {
                    mkdir($app_dir . "/" . $company_upload_dir . "/", 0777);
                }
                if (!is_dir($app_dir . "/" . $company_upload_dir . "/tickets/")) {
                    mkdir($app_dir . "/" . $company_upload_dir . "/tickets/", 0777);
                }
                if (!is_dir($app_dir . "/" . $company_upload_dir . "/tickets/attachment/")) {
                    mkdir($app_dir . "/" . $company_upload_dir . "/tickets/attachment/", 0777);
                }
                $newFilePath = $app_dir . "/" . $company_upload_dir . "/tickets/attachment/" . $newName;
                //Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                    $attach_string = $newName;
                    if ($ticket_master['category_type'] == 1) {
                        //internal ticket
                        $this->tables = array($company_db . '.support_ticket_answers');
                    } elseif ($ticket_master['category_type'] == 2) {
                        //external ticket
                        $this->tables = array($db_master . '.support_ticket_answers');
                    }
                    $this->fields = array('attachment');
                    $this->field_values = array($attach_string);
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($answer_id);
                    if ($this->query_update()) {
                        return TRUE;
                    }
                }
            }
        }
        return FALSE;
    }

    function get_support_categories($company_id) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('id', "`order`", 'type', 'company_id', 'name');
        $this->conditions = array('company_id IN(0,' . $company_id . ')');
        $this->query_generate();
        $this->sql_query .= ' ORDER BY `order`';
        $data = $this->query_fetch();
        return $data;
    }

    function get_support_category_details($category_id) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('id', "`order`", 'type', 'company_id', 'name');
        $this->conditions = array('id = ' . $category_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_support_category_options($type, $company_id) {

        $categories = $this->get_support_categories($company_id);
        $data = array();
        foreach ($categories as $category) {
            if ($category['type'] == $type) {
                $data[$category['id']] = $category['name'];
            }
        }
        return $data;
    }

    function get_support_admin_users($company_id) {

        global $db;
        $db_master = $db['database_master'];
        $company_data = $this->get_companies($company_id);
        $company_db = $company_data[0]['db_name'];
        $this->tables = array($db_master . '.login` as `l', $company_db . '.employee` as `e');
        $this->fields = array('l.username as username', ($_SESSION['company_sort_by'] == 1 ? "concat(e.first_name,' ',e.last_name) as fullname" : "concat(e.last_name,' ',e.first_name) as fullname"));
        $this->conditions = array('AND', 'l.username = e.username', 'l.role IN(1,2,6,7)', 'e.status = 1');
        if ($_SESSION['company_sort_by'] == 1)
            $this->order_by = array('LOWER(e.first_name) collate utf8_bin ASC', 'LOWER(e.last_name) collate utf8_bin ASC');
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->order_by = array('LOWER(e.last_name) collate utf8_bin ASC', 'LOWER(e.first_name) collate utf8_bin ASC');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_support_admin_users_options($company_id) {

        $admin_users = $this->get_support_admin_users($company_id);
        $data = array();
        foreach ($admin_users as $admin_user) {
            $data[$admin_user['username']] = $admin_user['fullname'];
        }
        return $data;
    }

    function get_tickets($support_ticket_status = NULL, $support_priority = NULL, $support_category_type = NULL, $support_key = NULL, $admin = NULL, $company = NULL, $created_user = NULL, $is_hidden = NULL, $st = NULL, $en = NULL) {

        global $cirrus_admins, $support_status, $db;
        $user = new user();
        $db_master = $db['database_master'];

        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        $array_keys = array_keys($support_status);
        $last_key = end($array_keys);
        $closed_status = $last_key - 2;

        // var_dump($array_keys,$last_key,$closed_status);


         // print_r($support_status);
        if (in_array($login_user, $cirrus_admins)) {
            $company_query = array();
            if ($company == 'NULL' || $company == '') {
                $companies = $this->get_companies();
            } else {
                $companies = $this->get_companies($company);
            }

            foreach ($companies as $company) {
                $company_id = $company['id'];
                $company_db = $company['db_name'];
                if ($support_category_type == 1) {
                    $sql_query = "SELECT stm.id, stm.company_id,mc.name as company, stm.category_type, st.created_user, 'NULL' AS ticket_type, IF(sta.admin_user != '', sta.admin_user, st.admin_user) AS admin_user, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.affected_user, st.affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status) AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 AND stm.company_id = ".$company_id." INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE 1 ";
                } else {
                    $sql_query = "SELECT stm.id, stm.company_id,mc.name as company, stm.category_type, st.created_user, IF(sta.ticket_type, sta.ticket_type, st.ticket_type) AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status)AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE stm.company_id = $company_id ";
                }
                if ((int) $support_priority > 0) {
                    $sql_query .= ' AND IF(sta.priority, sta.priority, st.priority) = ' . $support_priority;
                }
                if ((int) $support_ticket_status > 0) {
                    $sql_query .= ' AND IF(sta.status, sta.status, st.status) = ' . $support_ticket_status;
                } else {

                    $sql_query .= ' AND IF(sta.status, sta.status, st.status) IN (1,2,3,6)' ;
                }
                
                if ((int) $is_hidden > 0) {
                    if ($support_category_type == 1) {
                        $sql_query .= ' AND stm.id IN (SELECT ticket_id FROM `' . $company_db . '`.`support_ticket_answers` WHERE ticket_id=stm.id AND hidden=1)';
                    } else {
                        $sql_query .= ' AND stm.id IN (SELECT ticket_id FROM `' . $db_master . '`.`support_ticket_answers` WHERE ticket_id=stm.id AND hidden=1)';
                    }
                }
                if (isset($support_key) && $support_key != 'NULL') {

                    $sql_query .= " AND (st.title LIKE '%" . $support_key . "%' OR st.description LIKE '%" . $support_key . "%' OR sta.answer LIKE '%" . $support_key . "%' OR st.date LIKE '%" . $support_key . "%' OR st.id LIKE '%" . $support_key . "%' ".($support_category_type == 1 ? " OR st.affected_user LIKE '%" . $support_key . "%' " : "").")";
                }
                if(isset($created_user) && $created_user != 'NULL') {
                    
                    $sql_query .= " AND st.created_user = '" . $created_user . "'";
                }
                $company_query[] = '(' . $sql_query . ')';
                
            }
             $company_union_query = implode(' UNION ', $company_query);
            if ($st != NULL)
                $company_union_query .= ' ORDER BY id desc limit ' . $st . ',' . $en . ';';
            else
                $company_union_query .= ' ORDER BY id desc';

            $this->sql_query = $company_union_query;
             $data = $this->query_fetch();
            return $data;
            
        } 
        else if ($login_user_role == 1 || $login_user_role == 6) {
            $company_query = array();
            $companies = $this->get_user_companies($login_user);
            foreach ($companies as $company) {

                $company_id = $company['id'];
                $company_db = $company['db_name'];
                if ($support_category_type == 2) {
                    $sql_query = "SELECT stm.id, stm.company_id,mc.name as company, stm.category_type, st.created_user, IF(sta.ticket_type, sta.ticket_type, st.ticket_type) AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status)AS status, st.date,st.ticket_type FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE 1 AND stm.company_id = $company_id ";
                } else {
                    $sql_query = "SELECT stm.id, stm.company_id,mc.name as company, stm.category_type, st.created_user, 'NULL' AS ticket_type, IF(sta.admin_user != '', sta.admin_user, st.admin_user) AS admin_user, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.affected_user, st.affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status) AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE 1 ";
                    if ($admin != 'NULL') {
                        $sql_query .= " AND IF(sta.admin_user != '', sta.admin_user, st.admin_user) LIKE '%" . $admin . "%'";
                    } 
                }

                if ((int) $support_priority > 0) {
                    $sql_query .= ' AND IF(sta.priority, sta.priority, st.priority) = ' . $support_priority;
                }
                if ((int) $support_ticket_status > 0) {
                    $sql_query .= ' AND IF(sta.status, sta.status, st.status) = ' . $support_ticket_status;
                } else {
                    $sql_query .= ' AND IF(sta.status, sta.status, st.status) IN (1,2,3,6)';
                }
                if ((int) $is_hidden > 0) {
                    if ($support_category_type == 1) {
                        $sql_query .= ' AND stm.id IN (SELECT ticket_id FROM `' . $company_db . '`.`support_ticket_answers` WHERE ticket_id=t.id AND hidden=1)';
                    } else {
                        $sql_query .= ' AND stm.id IN (SELECT ticket_id FROM `' . $db_master . '`.`support_ticket_answers` WHERE ticket_id=t.id AND hidden=1)';
                    }
                }
                if (isset($support_key) && $support_key != 'NULL') {

                    $sql_query .= " AND (st.title LIKE '%" . $support_key . "%' OR st.description LIKE '%" . $support_key . "%' OR sta.answer LIKE '%" . $support_key . "%' OR st.date LIKE '%" . $support_key . "%' OR stm.id LIKE '%" . $support_key . "%' ".($support_category_type == 1 ? " OR st.affected_user LIKE '%" . $support_key . "%' " : "").")";
                }
                if(isset($created_user) && $created_user != 'NULL') {
                    
                    $sql_query .= " AND st.created_user = '" . $created_user . "'";
                }
                //                $sql_query .= ")";
                $company_query[] = '(' . $sql_query . ')';
            }
            $company_union_query = implode(' UNION ', $company_query);
            if ($st != NULL)
                $company_union_query .= ' ORDER BY id desc limit ' . $st . ',' . $en . ';';
            else
                $company_union_query .= ' ORDER BY id desc';
            $this->sql_query = $company_union_query;
            //            if($_COOKIE['debug'] == 'admin') echo "<pre>" . $company_union_query . "</pre>";
            $data = $this->query_fetch();
            //print_r($data);
            return $data;
        } 
        elseif ($login_user_role == 2 || $login_user_role == 7) {

            $company_query = array();
            $companies = $this->get_user_companies($login_user);
            foreach ($companies as $company) {

                $company_db = $company['db_name'];
                if ($support_category_type == 2) 
                    $sql_query_external = "SELECT stm.id AS id, stm.company_id,mc.name as company, stm.category_type, st.created_user, 'NULL' AS admin_user, IF(sta.ticket_type, sta.ticket_type, st.ticket_type) AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, 'NULL' AS affected_user, 'NULL' AS affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status)AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE st.created_user = '$login_user' ";
                else
                    $sql_query_internal = "SELECT stm.id AS id, stm.company_id,mc.name as company, stm.category_type, st.created_user, IF(sta.admin_user != '', sta.admin_user, st.admin_user) AS admin_user, 'NULL' AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.affected_user, st.affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status) AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE ( st.created_user = '$login_user' OR IF(sta.admin_user != '', sta.admin_user, st.admin_user) LIKE '%" . $login_user . "%') ";


                if ((int) $support_priority > 0) {
                    $sql_query_external .= ' AND IF(sta.priority, sta.priority, st.priority) = ' . $support_priority;
                    $sql_query_internal .= ' AND IF(sta.priority, sta.priority, st.priority) = ' . $support_priority;
                }
                if ((int) $support_ticket_status > 0) {
                    $sql_query_external .= ' AND IF(sta.status, sta.status, st.status) = ' . $support_ticket_status;
                    $sql_query_internal .= ' AND IF(sta.status, sta.status, st.status) = ' . $support_ticket_status;
                } else {
                    $sql_query_external .= ' AND IF(sta.status, sta.status, st.status) IN (1,2,3,6)';
                    $sql_query_internal .= ' AND IF(sta.status, sta.status, st.status) IN (1,2,3,6)';
                }
                if (isset($support_key) && $support_key != 'NULL') {
                    $sql_query_external .= " AND (st.title LIKE '%" . $support_key . "%' OR st.description LIKE '%" . $support_key . "%' OR sta.answer LIKE '%" . $support_key . "%' OR st.date LIKE '%" . $support_key . "%' OR stm.id LIKE '%" . $support_key . "%')";
                    $sql_query_internal .= " AND (st.title LIKE '%" . $support_key . "%' OR st.description LIKE '%" . $support_key . "%' OR sta.answer LIKE '%" . $support_key . "%' OR st.date LIKE '%" . $support_key . "%' OR stm.id LIKE '%" . $support_key . "%' OR st.affected_user LIKE '%" . $support_key . "%')";
                }
                if(isset($created_user) && $created_user != 'NULL') {
                    $sql_query_external .= " AND st.created_user = '" . $created_user . "'";
                    $sql_query_internal .= " AND st.created_user = '" . $created_user . "'";
                }
                //$sql_query = '(' . $sql_query_internal . ' ORDER BY id DESC) UNION (' . $sql_query_external . ' ORDER BY id DESC)';
                if ($support_category_type == 2) 
                    $sql_query = $sql_query_external ;
                else    
                    $sql_query = $sql_query_internal ;
                
                if (count($companies) == 1) {
                    $company_query[] = $sql_query;
                } else {
                    $company_query[] = '(' . $sql_query . ')';
                }
            }
            $company_union_query = implode(' UNION ', $company_query);
            if ($st != NULL)
                $company_union_query .= ' ORDER BY id DESC limit ' . $st . ',' . $en . ';';
            else
                $company_union_query .= ' ORDER BY id DESC';
            $this->sql_query = $company_union_query;
            //echo ( "<pre>" . $company_union_query . "</pre>");
            $data = $this->query_fetch();

            return $data;
        } 
        else {

            $company_query = array();
            $companies = $this->get_user_companies($login_user);
            foreach ($companies as $company) {

                $company_db = $company['db_name'];

                $sql_query_external = "SELECT stm.id AS id, stm.company_id,mc.name as company, stm.category_type, st.created_user, 'NULL' AS admin_user, IF(sta.ticket_type, sta.ticket_type, st.ticket_type) AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, 'NULL' AS affected_user, 'NULL' AS affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status)AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE st.created_user = '$login_user' ";

                $sql_query_internal = "SELECT stm.id AS id, stm.company_id,mc.name as company, stm.category_type, st.created_user, IF(sta.admin_user != '', sta.admin_user, st.admin_user) AS admin_user, 'NULL' AS ticket_type, IF(sta.category_id, sta.category_id, st.category_id) AS category_id, tcm.name AS category, IF(sta.priority, sta.priority, st.priority) AS priority, st.affected_user, st.affected_user_phone, st.title, st.description, st.attachment, IF(sta.status, sta.status, st.status) AS status, st.date FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 INNER JOIN `" . $db_master . "`.`company` mc ON stm.company_id = mc.id LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) INNER JOIN `" . $db_master . "`.`support_categories` tcm ON IF(sta.category_id, sta.category_id, st.category_id) = tcm.id WHERE  st.created_user = '$login_user' ";

                if ((int) $support_priority > 0) {
                    $sql_query_external .= ' AND IF(sta.priority, sta.priority, st.priority) = ' . $support_priority;
                    $sql_query_internal .= ' AND IF(sta.priority, sta.priority, st.priority) = ' . $support_priority;
                }
                if ((int) $support_ticket_status > 0) {
                    $sql_query_external .= ' AND IF(sta.status, sta.status, st.status) = ' . $support_ticket_status;
                    $sql_query_internal .= ' AND IF(sta.status, sta.status, st.status) = ' . $support_ticket_status;
                } else {
                    $sql_query_external .= ' AND IF(sta.status, sta.status, st.status) IN (1,2,3,6)';
                    $sql_query_internal .= ' AND IF(sta.status, sta.status, st.status) IN (1,2,3,6)';
                }
                if (isset($support_key) && $support_key != 'NULL') {
                    $sql_query_external .= " AND (st.title LIKE '%" . $support_key . "%' OR st.description LIKE '%" . $support_key . "%' OR sta.answer LIKE '%" . $support_key . "%' OR st.date LIKE '%" . $support_key . "%' OR stm.id LIKE '%" . $support_key . "%')";
                    $sql_query_internal .= " AND (st.title LIKE '%" . $support_key . "%' OR st.description LIKE '%" . $support_key . "%' OR sta.answer LIKE '%" . $support_key . "%' OR st.date LIKE '%" . $support_key . "%' OR stm.id LIKE '%" . $support_key . "%' OR st.affected_user LIKE '%" . $support_key . "%')";
                }
                if(isset($created_user) && $created_user != 'NULL') {
                    $sql_query_external .= " AND st.created_user = '" . $created_user . "'";
                    $sql_query_internal .= " AND st.created_user = '" . $created_user . "'";
                }
                $sql_query = '(' . $sql_query_internal . ' ORDER BY id DESC) UNION (' . $sql_query_external . ' ORDER BY id DESC)';
                if (count($companies) == 1) {
                    $company_query[] = $sql_query;
                } else {
                    $company_query[] = '(' . $sql_query . ')';
                }
            }
            $company_union_query = implode(' UNION ', $company_query);
            if ($st != NULL)
                $company_union_query .= ' ORDER BY id DESC limit ' . $st . ',' . $en . ';';
            else
                $company_union_query .= ' ORDER BY id DESC';
            $this->sql_query = $company_union_query;
            //echo ( "<pre>" . $company_union_query . "</pre>");
            $data = $this->query_fetch();
            return $data;
        }
    }

    function get_ticket_open_count() {

        global $cirrus_admins, $db;
        $user = new user();
        $db_master = $db['database_master'];
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if (in_array($login_user, $cirrus_admins)) {

            $company_query = array();
            $companies = $this->get_companies();
            foreach ($companies as $company) {

                $sql_query = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE IF(sta.status, sta.status, st.status) = 1";
                $company_query[] = '(' . $sql_query . ')';
            }
            $company_union_query = implode(' UNION ', $company_query);
            $this->sql_query = "SELECT SUM(count) as count FROM (" . $company_union_query . ") tc";
        } else if ($login_user_role == 1 || $login_user_role == 2) {

            $company_query = array();
            $companies = $this->get_user_companies($login_user);
            foreach ($companies as $company) {

                $company_db = $company['db_name'];
                $sql_query = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE st.created_user = '$login_user' OR (IF(sta.status, sta.status, st.status) = 1 AND IF(sta.admin_user != '', sta.admin_user, st.admin_user) LIKE '%" . $login_user . "%')";
                $company_query[] = '(' . $sql_query . ')';
            }
            $company_union_query = implode(' UNION ', $company_query);
            $this->sql_query = "SELECT SUM(count) as count FROM (" . $company_union_query . ") tc";
        } else if ($login_user_role == 6 || $login_user_role == 7) {
            $company_query = array();
            $companies = $this->get_user_companies($login_user);
            foreach ($companies as $company) {

                $company_db = $company['db_name'];
                $sql_query_external = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE IF(sta.status, sta.status, st.status) = 1 AND st.created_user = '$login_user'  GROUP BY stm.id ";
                //$sql_query_internal = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE IF(sta.status, sta.status, st.status) = 1 AND st.created_user = '$login_user' GROUP BY stm.id ";
                $sql_query_internal_in = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE IF(sta.status, sta.status, st.status) = 1 AND ( st.created_user = '$login_user' OR IF(sta.admin_user != '', sta.admin_user, st.admin_user) LIKE '%" . $login_user . "%') GROUP BY stm.id ";
                $sql_query = '(' . $sql_query_external . ') UNION ALL (' . $sql_query_internal_in . ')';
                if (count($companies) == 1) {
                    $company_query[] = 'SELECT SUM(count) AS count FROM (' . $sql_query . ') ctc';
                } else {
                    $company_query[] = '(SELECT SUM(count) AS count FROM (' . $sql_query . ') ctc)';
                }
            }
            $company_union_query = implode(' UNION ', $company_query);
            $this->sql_query = "SELECT SUM(count) as count FROM (" . $company_union_query . ") tc";
        } else {

            $company_query = array();
            $companies = $this->get_user_companies($login_user);
            foreach ($companies as $company) {

                $company_db = $company['db_name'];
                $sql_query_external = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $db_master . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 2 LEFT JOIN `" . $db_master . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $db_master . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE IF(sta.status, sta.status, st.status) = 1 AND st.created_user = '$login_user' ";
                $sql_query_internal = "SELECT COUNT(stm.id) AS count FROM `" . $db_master . "`.`support_ticket_master` stm INNER JOIN `" . $company_db . "`.`support_tickets` st ON stm.id = st.id AND stm.category_type = 1 LEFT JOIN `" . $company_db . "`.`support_ticket_answers` sta ON st.id=sta.ticket_id AND sta.id IN( SELECT MAX(id) FROM `" . $company_db . "`.`support_ticket_answers` WHERE ticket_id = st.id) WHERE IF(sta.status, sta.status, st.status) = 1 AND st.created_user = '$login_user' ";
                $sql_query = '(' . $sql_query_internal . ') UNION ALL (' . $sql_query_external . ')';
                if (count($companies) == 1) {
                    $company_query[] = 'SELECT SUM(count) AS count FROM (' . $sql_query . ') ctc';
                } else {
                    $company_query[] = '(SELECT SUM(count) AS count FROM (' . $sql_query . ') ctc)';
                }
            }
            $company_union_query = implode(' UNION ', $company_query);
            $this->sql_query = "SELECT SUM(count) as count FROM (" . $company_union_query . ") tc";
        }
        //echo $this->sql_query;
        $data = $this->query_fetch();
        $count = $data[0]['count'];
        return $count;
    }

    function get_all_users($company_id) {

        global $db;
        $db_master = $db['database_master'];
        $company_data = $this->get_companies($company_id);
        $company_db = $company_data[0]['db_name'];
        $this->tables = array($company_db . '.employee` as `e', $db_master . '.login` as `l');
        $this->fields = array('e.username', 'e.first_name', 'e.last_name', 'e.code', 'e.phone', 'e.mobile', 'l.role');
        $this->conditions = array('AND', 'l.username = e.username', 'e.status = 1');
        $this->query_generate();
        $employee_query = $this->sql_query;
        $this->tables = array($company_db . '.customer` as `c', $db_master . '.login` as `l');
        $this->fields = array('c.username', 'c.first_name', 'c.last_name', 'c.code', 'c.phone', 'c.mobile', 'l.role');
        $this->conditions = array('AND', 'l.username = c.username', 'c.status = 1');
        $this->query_generate();
        $customer_query = $this->sql_query;

        $all_user_union_query = '(' . $employee_query . ') UNION (' . $customer_query . ')';

        $this->sql_query = $all_user_union_query;
        
        if ($_SESSION['company_sort_by'] == 1)
            $this->sql_query .= ' ORDER BY LOWER(first_name) collate utf8_bin,LOWER(last_name) collate utf8_bin ';
        elseif ($_SESSION['company_sort_by'] == 2)
            $this->sql_query .= ' ORDER BY LOWER(last_name) collate utf8_bin,LOWER(first_name) collate utf8_bin ';
        //print_r("<pre>" . $all_user_union_query . "</pre>");
        $data = $this->query_fetch();
        return $data;
    }

    function get_all_user_json($company_id) {

        $datas = $this->get_all_users($company_id);
        $users = array();
        foreach ($datas as $data) {
            $phone = ($data['mobile'] != '') ? $data['mobile'] : $data['phone'];
            if ((int) $phone > 0) {
                $phone = (substr($phone, 0, 1) != 0) ? '0' . $phone : $phone;
            }
            $users[] = array('id' => $data['username'], 'phone' => $phone, 'label' => $data['first_name'] . ' ' . $data['last_name'] . '(' . $data['code'] . ')');
        }
        $json_users = json_encode($users);
        return $json_users;
    }
    
    function get_all_user_options($company_id=NULL, $mode=NULL) {
        //mode from api(NOT NULL) and support_list
        $users = array();
        $obj_employee = new employee();
        //$users = $this->get_all_users($company_id);
        $a1 = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
        $a2 = $obj_employee->customers_list_for_right_click($_SESSION['user_id']);
        $users = array_merge($a1,$a2);
        $data = array();
        if($mode == NULL){
            foreach ($users as $user) {
                $data[$user['username']] = ($_SESSION['company_sort_by'] == 1 ? $user['first_name'] . ' ' . $user['last_name'] : $user['last_name'] . ' ' . $user['first_name']);
            }
            return $data;
        }else{
            return $users;
        }
    }
    
    function get_customer_detail($username, $company_id) {

        $company_data = $this->get_companies($company_id);
        $company_db = $company_data[0]['db_name'];
        $this->tables = array($company_db . '.customer');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status', 'gender');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_employee_detail($username, $company_id) {

        $company_data = $this->get_companies($company_id);
        $company_db = $company_data[0]['db_name'];
        $this->tables = array($company_db . '.employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'status');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function update_email_model($id, $sender, $sender_name, $subject, $body) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_emails');
        $this->fields = array('sender', 'sender_name', 'subject', 'body');
        $this->field_values = array($sender, $sender_name, $subject, $body);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_email_model($id) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_emails');
        $this->fields = array('id', 'sender', 'sender_name', 'subject', 'body', 'help');
        $this->conditions = array('id = "' . $id . '"');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function update_tickets_noreplay() {

        global $support_status, $db;
        $db_master = $db['database_master'];
        //get tickets that answered waiting for replay
        $array_keys = array_keys($support_status);
        $last_key = 5;
        $status_check = ($last_key - 1);
        //External Tickets
        $this->sql_query = "SELECT DISTINCT stm.id FROM " . $db_master . ".support_ticket_master AS stm INNER JOIN " . $db_master . ".support_ticket_answers AS sta1 INNER JOIN " . $db_master . ".support_ticket_answers AS sta2 ON stm.id = sta1.ticket_id AND sta2.id=sta1.id AND stm.category_type = 2 AND sta1.status=" . $status_check . " AND sta2.ticket_id NOT IN(SELECT ticket_id FROM " . $db_master . ".support_ticket_answers WHERE status = " . $last_key . ") WHERE sta1.date < NOW() - INTERVAL 3 DAY";
        $datas = $this->query_fetch();
        //print_r($datas);
        foreach ($datas as $data) {
            $ticket_id = $data['id'];
            $this->update_tickets_to_close($ticket_id);
        }
        //Internal Tickets of all companies
        $company_query = array();
        $companies = $this->get_companies();
        foreach ($companies as $company) {

            $company_id = $company['id'];
            $company_db = $company['db_name'];
            $sql_query = "SELECT DISTINCT stm.id FROM " . $db_master . ".support_ticket_master AS stm INNER JOIN " . $company_db . ".support_ticket_answers AS sta1 INNER JOIN " . $company_db . ".support_ticket_answers AS sta2 ON stm.id = sta1.ticket_id AND sta2.id=sta1.id AND stm.category_type = 1 AND company_id = " . $company_id . " AND sta1.status=" . $status_check . " AND sta2.ticket_id NOT IN(SELECT ticket_id FROM " . $company_db . ".support_ticket_answers WHERE status = " . $last_key . ") WHERE sta1.date < NOW() - INTERVAL 3 DAY";
            $company_query[] = '(' . $sql_query . ')';
        }
        $company_union_query = implode(' UNION ', $company_query);
        $this->sql_query = $company_union_query;
        $datas = $this->query_fetch();
        //print_r($datas);
        foreach ($datas as $data) {
            $ticket_id = $data['id'];
            $this->update_tickets_to_close($ticket_id);
        }
    }

    function update_tickets_to_close($ticket_id) {

        global $db, $preference, $support_priority, $support_status, $support_ticket_type, $cirrus_support, $cirrus_admins;
        $db_master = $db['database_master'];
        
        $user = new user();
        $base_url = $preference['url'];
        $answer = "Ärendet stängs automatiskt.";
        $array_keys = array_keys($support_status);
        $last_key = end($array_keys);
        //$status = $last_key;
        $status = 5;
        $ticket_master = $this->get_ticket_master($ticket_id);
        $company_data = $this->get_companies($ticket_master['company_id']);
        $company_details = $company_data[0];
        $company_id = $ticket_master['company_id'];
        $company_db = $company_details['db_name'];
        $ticket_last_data = $this->get_ticket_last_details($ticket_id);
        $ticket_data = $this->get_ticket_details($ticket_id);

        if ($ticket_master['category_type'] == 1) {
            //insert internal ticket answer details
            $this->tables = array($company_db . '.support_ticket_answers');
            $this->fields = array('ticket_id', 'answer', 'category_id', 'priority', 'admin_user', 'status');
            $this->field_values = array($ticket_id, $answer, $ticket_last_data['category_id'], $ticket_last_data['priority'], $ticket_last_data['admin_user'], $status);
        } else {
            //insert external ticket answer details
            $this->tables = array($db_master . '.support_ticket_answers');
            $this->fields = array('ticket_id', 'answer', 'category_id', 'priority', 'ticket_type', 'status');
            $this->field_values = array($ticket_id, $answer, $ticket_last_data['category_id'], $ticket_last_data['priority'], $ticket_last_data['ticket_type'], $status);
        }
        $this->query_insert();
        //print_r($this->field_values);
        //echo $this->sql_query;
        //echo $this->last_query();
        $answer_id = $this->get_id();
        if ($answer_id) {

            $answer_details = $this->get_ticket_answer_details($ticket_id, $answer_id);
            $url = $base_url . 'supporttickets/detail/' . $ticket_id . '/' . $company_id . '/';
            $link = "<a href='$url'>$url</a>";

            $created_user_data = $ticket_data['created_user_data'];
            $answer_submited_user_data = $answer_details['submited_user_data'];

            $created_user = utf8_encode($ticket_data['created_user']);
            $created_email = utf8_encode($created_user_data['email']);
            $created_name = utf8_encode($created_user_data['first_name'] . ' ' . $created_user_data['last_name']);
            $created_phone = utf8_encode($created_user_data['phone']);
            $created_mobile = utf8_encode($created_user_data['mobile']);

            $answer_user = utf8_encode($answer_details['submited_user']);
            $answer_email = utf8_encode($answer_submited_user_data['email']);
            $answer_name = utf8_encode($answer_submited_user_data['first_name'] . ' ' . $answer_submited_user_data['last_name']);
            $answer_phone = utf8_encode($answer_submited_user_data['phone']);
            $answer_mobile = utf8_encode($answer_submited_user_data['mobile']);
            $answer_role = $user->user_role($answer_user);

            $ticket_status = utf8_encode($support_status[$ticket_data['status']]);
            $ticket_priority = utf8_encode($support_priority[$ticket_data['priority']]);
            $ticket_category = utf8_encode($ticket_data['category']);
            $ticket_date = date('Y-m-d, H:i', strtotime($ticket_data['date']));
            $ticket_title = utf8_encode($ticket_data['title']);
            $ticket_description = utf8_encode($ticket_data['description']);

            $answer_status = utf8_encode($support_status[$answer_details['status']]);
            $answer_priority = utf8_encode($support_priority[$answer_details['priority']]);
            $answer_category = utf8_encode($answer_details['category']);
            $answer_date = utf8_encode($answer_details['date']);
            $answer = utf8_encode($answer_details['answer']);

            $company_name = $company_details['name'];
            $company_email = $company_details['email'];
            $company_phone = $company_details['phone'];
            $company_mobile = $company_details['mobile'];
            $company_website = $company_details['website'];
            $company_address = $company_details['address'];
            $company_org_no = $company_details['org_no'];

            if ($ticket_master['category_type'] == 1) {
                //inernal tickets
                $admin_data = $ticket_data['admin_user_data'];
                $affected_user_data = $ticket_data['affected_user_data'];

                $admin_user = utf8_encode($ticket_data['admin_user']);
                $admin_email = utf8_encode($admin_data['email']);
                $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
                $admin_phone = utf8_encode($admin_data['phone']);
                $admin_mobile = utf8_encode($admin_data['mobile']);

                $affected_user = utf8_encode($ticket_data['affected_user']);
                $affected_name = utf8_encode($affected_user_data['first_name'] . ' ' . $affected_user_data['last_name']);
                $affected_email = utf8_encode($affected_user_data['email']);
                $affected_phone = utf8_encode($affected_user_data['phone']);
                $affected_mobile = utf8_encode($affected_user_data['mobile']);

                $answer_admin_user_data = $answer_details['admin_user_data'];
                $answer_admin_user = array();
                $answer_admin_name = array();
                $answer_admin_email = array();
                $answer_admin_phone = array();
                $answer_admin_mobile = array();
                if (is_array($answer_admin_user_data)) {
                    foreach ($answer_admin_user_data as $answer_admin_user) {
                        $answer_admin_user[] = utf8_encode($answer_admin_user['username']);
                        $answer_admin_name[] = utf8_encode($answer_admin_user['first_name'] . ' ' . $answer_admin_user['last_name']);
                        $answer_admin_email[] = utf8_encode($answer_admin_user['email']);
                        $answer_admin_phone[] = utf8_encode($answer_admin_user['phone']);
                        $answer_admin_mobile[] = utf8_encode($answer_admin_user['mobile']);
                    }
                    $answer_admin_users = implode(', ', $answer_admin_user);
                    $answer_admin_names = implode(', ', $answer_admin_name);
                    $answer_admin_emails = implode(', ', $answer_admin_email);
                    $answer_admin_phones = implode(', ', $answer_admin_phone);
                    $answer_admin_mobiles = implode(', ', $answer_admin_mobile);
                } else {
                    $answer_admin_users = utf8_encode($answer_admin_user_data['username']);
                    $answer_admin_names = utf8_encode($answer_admin_user_data['first_name'] . ' ' . $answer_admin_user['last_name']);
                    $answer_admin_emails = utf8_encode($answer_admin_user_data['email']);
                    $answer_admin_phones = utf8_encode($answer_admin_user_data['phone']);
                    $answer_admin_mobiles = utf8_encode($answer_admin_user_data['mobile']);
                }

                $patterns = array();
                $patterns[0] = '/{id}/';
                $patterns[1] = '/{created_user}/';
                $patterns[2] = '/{created_name}/';
                $patterns[3] = '/{created_email}/';
                $patterns[4] = '/{created_phone}/';
                $patterns[5] = '/{created_mobile}/';
                $patterns[6] = '/{admin_user}/';
                $patterns[7] = '/{admin_name}/';
                $patterns[8] = '/{admin_email}/';
                $patterns[9] = '/{admin_phone}/';
                $patterns[10] = '/{admin_mobile}/';
                $patterns[11] = '/{affected_user}/';
                $patterns[12] = '/{affected_name}/';
                $patterns[13] = '/{affected_email}/';
                $patterns[14] = '/{affected_phone}/';
                $patterns[15] = '/{affected_mobile}/';
                $patterns[16] = '/{status}/';
                $patterns[17] = '/{category}/';
                $patterns[18] = '/{priority}/';
                $patterns[19] = '/{title}/';
                $patterns[20] = '/{description}/';
                $patterns[21] = '/{date}/';
                $patterns[22] = '/{url}/';
                $patterns[23] = '/{company_name}/';
                $patterns[24] = '/{company_email}/';
                $patterns[25] = '/{company_phone}/';
                $patterns[26] = '/{company_mobile}/';
                $patterns[27] = '/{company_website}/';
                $patterns[28] = '/{company_org_no}/';
                $patterns[29] = '/{company_address}/';
                $patterns[30] = '/{answer_user}/';
                $patterns[31] = '/{answer_name}/';
                $patterns[32] = '/{answer_email}/';
                $patterns[33] = '/{answer_phone}/';
                $patterns[34] = '/{answer_mobile}/';
                $patterns[35] = '/{answer_status}/';
                $patterns[36] = '/{answer_priority}/';
                $patterns[37] = '/{answer_category}/';
                $patterns[38] = '/{answer_date}/';
                $patterns[39] = '/{answer}/';
                $patterns[40] = '/{answer_admin_user}/';
                $patterns[41] = '/{answer_admin_name}/';
                $patterns[42] = '/{answer_admin_email}/';
                $patterns[43] = '/{answer_admin_phone}/';
                $patterns[44] = '/{answer_admin_mobile}/';

                $replacements = array();
                $replacements[0] = $ticket_id;
                $replacements[1] = $created_user;
                $replacements[2] = $created_name;
                $replacements[3] = $created_email;
                $replacements[4] = $created_phone;
                $replacements[5] = $created_mobile;
                $replacements[6] = $admin_user;
                $replacements[7] = $admin_name;
                $replacements[8] = $admin_email;
                $replacements[9] = $admin_phone;
                $replacements[10] = $admin_mobile;
                $replacements[11] = $affected_user;
                $replacements[12] = $affected_name;
                $replacements[13] = $affected_email;
                $replacements[14] = $affected_phone;
                $replacements[15] = $affected_mobile;
                $replacements[16] = $ticket_status;
                $replacements[17] = $ticket_category;
                $replacements[18] = $ticket_priority;
                $replacements[19] = $ticket_title;
                $replacements[20] = $ticket_description;
                $replacements[21] = $ticket_date;
                $replacements[22] = $link;
                $replacements[23] = $company_name;
                $replacements[24] = $company_email;
                $replacements[25] = $company_phone;
                $replacements[26] = $company_mobile;
                $replacements[27] = $company_website;
                $replacements[28] = $company_org_no;
                $replacements[29] = $company_address;
                $replacements[30] = $answer_user;
                $replacements[31] = $answer_name;
                $replacements[32] = $answer_email;
                $replacements[33] = $answer_phone;
                $replacements[34] = $answer_mobile;
                $replacements[35] = $answer_status;
                $replacements[36] = $answer_priority;
                $replacements[37] = $answer_category;
                $replacements[38] = $answer_date;
                $replacements[39] = $answer;
                $replacements[40] = $answer_admin_users;
                $replacements[41] = $answer_admin_names;
                $replacements[42] = $answer_admin_emails;
                $replacements[43] = $answer_admin_phones;
                $replacements[44] = $answer_admin_mobiles;

                //internal ticket close notification to ticket creator
                $email_model = $this->get_email_model(10);
                $mail_sender = preg_replace($patterns, $replacements, utf8_encode($email_model['sender']));
                $mail_sender_name = preg_replace($patterns, $replacements, utf8_encode($email_model['sender_name']));
                $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                $mail = new SupportMails();
                $mail->setFrom($mail_sender_name, $mail_sender);
                $mail->addRecipient($created_name, $created_email);
                $mail->fillSubject(utf8_decode($mail_subject));
                $mail->fillMessage(utf8_decode($mail_message));
                $mail->send($company_id);
            } elseif ($ticket_master['category_type'] == 2) {
                //external tickets
                $admin_data = $cirrus_support;

                $admin_email = utf8_encode($admin_data['email']);
                $admin_name = utf8_encode($admin_data['first_name'] . ' ' . $admin_data['last_name']);
                $admin_phone = utf8_encode($admin_data['phone']);
                $admin_mobile = utf8_encode($admin_data['mobile']);

                $ticket_type = utf8_encode($support_ticket_type[$ticket_data['ticket_type']]);
                $answer_type = utf8_encode($support_ticket_type[$answer_details['ticket_type']]);

                $patterns = array();
                $patterns[0] = '/{id}/';
                $patterns[1] = '/{created_user}/';
                $patterns[2] = '/{created_name}/';
                $patterns[3] = '/{created_email}/';
                $patterns[4] = '/{created_phone}/';
                $patterns[5] = '/{created_mobile}/';
                $patterns[6] = '/{admin_name}/';
                $patterns[7] = '/{admin_email}/';
                $patterns[8] = '/{admin_phone}/';
                $patterns[9] = '/{admin_mobile}/';
                $patterns[10] = '/{affected_user}/';
                $patterns[11] = '/{affected_name}/';
                $patterns[12] = '/{affected_email}/';
                $patterns[13] = '/{affected_phone}/';
                $patterns[14] = '/{affected_mobile}/';
                $patterns[15] = '/{type}/';
                $patterns[16] = '/{status}/';
                $patterns[17] = '/{category}/';
                $patterns[18] = '/{priority}/';
                $patterns[19] = '/{title}/';
                $patterns[20] = '/{description}/';
                $patterns[21] = '/{date}/';
                $patterns[22] = '/{url}/';
                $patterns[23] = '/{company_name}/';
                $patterns[24] = '/{company_email}/';
                $patterns[25] = '/{company_phone}/';
                $patterns[26] = '/{company_mobile}/';
                $patterns[27] = '/{company_website}/';
                $patterns[28] = '/{company_org_no}/';
                $patterns[29] = '/{company_address}/';
                $patterns[30] = '/{answer_user}/';
                $patterns[31] = '/{answer_name}/';
                $patterns[32] = '/{answer_email}/';
                $patterns[33] = '/{answer_phone}/';
                $patterns[34] = '/{answer_mobile}/';
                $patterns[35] = '/{answer_status}/';
                $patterns[36] = '/{answer_type}/';
                $patterns[37] = '/{answer_priority}/';
                $patterns[38] = '/{answer_category}/';
                $patterns[39] = '/{answer_date}/';
                $patterns[40] = '/{answer}/';


                $replacements = array();
                $replacements[0] = $ticket_id;
                $replacements[1] = $created_user;
                $replacements[2] = $created_name;
                $replacements[3] = $created_email;
                $replacements[4] = $created_phone;
                $replacements[5] = $created_mobile;
                $replacements[6] = $admin_name;
                $replacements[7] = $admin_email;
                $replacements[8] = $admin_phone;
                $replacements[9] = $admin_mobile;
                $replacements[10] = $affected_user;
                $replacements[11] = $affected_name;
                $replacements[12] = $affected_email;
                $replacements[13] = $affected_phone;
                $replacements[14] = $affected_mobile;
                $replacements[15] = $ticket_type;
                $replacements[16] = $ticket_status;
                $replacements[17] = $ticket_category;
                $replacements[18] = $ticket_priority;
                $replacements[19] = $ticket_title;
                $replacements[20] = $ticket_description;
                $replacements[21] = $ticket_date;
                $replacements[22] = $link;
                $replacements[23] = $company_name;
                $replacements[24] = $company_email;
                $replacements[25] = $company_phone;
                $replacements[26] = $company_mobile;
                $replacements[27] = $company_website;
                $replacements[28] = $company_org_no;
                $replacements[29] = $company_address;
                $replacements[30] = $answer_user;
                $replacements[31] = $answer_name;
                $replacements[32] = $answer_email;
                $replacements[33] = $answer_phone;
                $replacements[34] = $answer_mobile;
                $replacements[35] = $answer_status;
                $replacements[36] = $answer_type;
                $replacements[37] = $answer_priority;
                $replacements[38] = $answer_category;
                $replacements[39] = $answer_date;
                $replacements[40] = $answer;

                //external ticket close notification to ticket creator
                $email_model = $this->get_email_model(11);
                $mail_sender = preg_replace($patterns, $replacements, utf8_encode($email_model['sender']));
                $mail_sender_name = preg_replace($patterns, $replacements, utf8_encode($email_model['sender_name']));
                $mail_subject = preg_replace($patterns, $replacements, utf8_encode($email_model['subject']));
                $mail_message = preg_replace($patterns, $replacements, utf8_encode($email_model['body']));
                $mail = new SupportMails();
                $mail->setFrom($mail_sender_name, $mail_sender);
                $mail->addRecipient($created_name, $created_email);
                $mail->fillSubject(utf8_decode($mail_subject));
                $mail->fillMessage(utf8_decode($mail_message));
                $mail->send($company_id);
            }
        }
    }

    function insert_ticket_category($cat_order, $category_type, $company_id, $cat_name) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('`order`', 'type', 'company_id', 'name');
        $this->field_values = array($cat_order, $category_type, $company_id, $cat_name);
        if ($this->query_insert()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_ticket_category($cat_id, $cat_order, $cat_type, $company_id, $cat_name) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('`order`', 'type', 'company_id', 'name');
        $this->field_values = array($cat_order, $cat_type, $company_id, $cat_name);
        $this->conditions = array('id = ?');
        $this->condition_values = array($cat_id);
        if ($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_ticket_category($cat_id) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->conditions = array('id = ?');
        $this->condition_values = array($cat_id);
        if ($this->query_delete()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_ticket_categories() {

        global $cirrus_admins, $db;
        $user = new user();
        $db_master = $db['database_master'];
        $login_user = $_SESSION['user_id'];
        $company_id = $_SESSION['company_id'];
        $login_user_role = $user->user_role($login_user);

        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('id', '`order`', 'type', 'company_id', 'name');
        if (in_array($login_user, $cirrus_admins)) {
            $this->conditions = array('1');
        } else if ($login_user_role == 1) {
            $this->conditions = array('company_id IN(0,' . $company_id . ')');
        }
        $this->query_generate();
        $this->sql_query .= ' ORDER BY `order`';
        $data = $this->query_fetch();
        return $data;
    }

    function get_ticket_category_details($category_id) {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('id', '`order`', 'type', 'company_id', 'name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($category_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_ticket_category_count() {

        global $db;
        $db_master = $db['database_master'];
        $this->tables = array($db_master . '.support_categories');
        $this->fields = array('COUNT(id) AS count');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['count'];
    }

    function save_remainder_ticket($remainder_user_id, $remainder_ticket_id, $remainder_date, $remainder_subject){
        $this->tables = array('my_ticket_remainder');
        $this->fields = array('user_id', 'ticket_id', 'remainder_date', 'subject');
        $this->field_values = array($remainder_user_id, $remainder_ticket_id, $remainder_date, $remainder_subject);
        return $this->query_insert();
    }

    function check_single_remainder_in_a_date($remainder_user_id, $remainder_ticket_id, $remainder_date){
        $this->tables = array('my_ticket_remainder');
        $this->fields = array('id', 'ticket_id');
        $this->conditions = array('AND','ticket_id = ?', 'user_id = ?', 'remainder_date = ?');
        $this->condition_values = array($remainder_ticket_id, $remainder_user_id, DATE($remainder_date));
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_user_all_remainders($ticket_id){
        $this->tables = array('my_ticket_remainder');
        $this->fields = array('id', 'ticket_id','subject','remainder_date');
        $this->conditions = array('AND','user_id = ?','ticket_id = ?');
        $this->condition_values = array($_SESSION['user_id'], $ticket_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function delete_single_remainder($id){
        $this->tables = array('my_ticket_remainder');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete();
    }

    function get_all_support_ticket_remainder(){
        global $db;
        $db_master    = $db['database_master'];
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $current_date = $dtz->format('Y-m-d');
        $this->sql_query = "SELECT mtr.id,mtr.ticket_id,mtr.subject,mtr.remainder_date,e.first_name,e.last_name,e.email,stm.category_type FROM `my_ticket_remainder` mtr  left JOIN `employee` e ON mtr.user_id = e.username LEFT JOIN `" . $db_master . "`.`support_ticket_master` stm ON mtr.ticket_id = stm.id WHERE date(mtr.remainder_date) = '".$current_date."' ";
        return $this->query_fetch();
    }

}

class SupportMails {

    private $to = NULL;
    private $subject = NULL;
    private $message = NULL;
    private $headers = NULL;
    private $recipients = NULL;
    private $from = NULL;
    private $attachments = array();

    public function __construct($to = NULL, $subject = NULL, $message = NULL, $headers = NULL) {

        $this->to = $to;
        $this->recipients = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
        return $this;
    }

    public function send($company_id) {

        global $preference;
        $support = new support();
        $company_data = $support->get_companies($company_id);
        $compony_detail = $company_data[0];
        $smarty = new smartySetup(array("user.xml", "messages.xml", "mail.xml"));

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
        " . preg_replace('/\r?\n|\r/', '<br/>', $this->message) . "
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
</table></body></html>";
        $this->message = $mail_template;

        $this->packHeaders();
        $sent = mail($this->to, $this->subject, $this->message, $this->headers, '-fcirrus-noreply@time2view.se');
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

    public function setFrom($name, $address) {
        $this->from = "$name <cirrus-noreply@time2view.se>" . PHP_EOL;
        if (is_null($this->replyTo)) {
            $this->replyTo = ($address != '' ? $address  : 'cirrus-noreply@time2view.se') . PHP_EOL;
        }
        return $this;
    }

    public function fillSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function fillMessage($textMessage) {
        $this->message = $textMessage;
        return $this;
    }

    public function attachFile($filePath) {
        $this->attachments[] = $filePath;
        return $this;
    }

    private function packHeaders() {

        if (!$this->headers) {
            ini_set("sendmail_from", 'cirrus-noreply@time2view.se');
            $this->headers = "MIME-Version: 1.0" . PHP_EOL;
            $this->headers .= "Content-Type: text/html; charset=\"utf-8\"" . PHP_EOL;
            $this->headers .= "To: " . $this->recipients . PHP_EOL;
            $this->headers .= "From: " . $this->from . PHP_EOL;
        }
    }

    

}
