<?php

/**
 * Description of notification
 * @author shamsudheen <shamsu@arioninfotech.com>
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');

class notification extends db {

    //variable declaration
    // var $user_id = '';
    // var $token = '';

    function __construct() {
        parent::__construct();
    }

    function get_user_tokens($user_id) {
        $this->flush();
        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('id', 'user_id', 'fcm_token', 'device_id', 'error');
        $this->conditions = array('AND', 'user_id = ?');
        $this->condition_values = array($user_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data : array();
    }

    function get_token_details_by_user_token($token) {
        $this->flush();
        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('id', 'user_id', 'fcm_token', 'device_id', 'error');
        $this->conditions = array('fcm_token = ?');
        $this->condition_values = array($token);
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data : array();
    }

    function create_user_token($user_id, $token, $device_id, $device_details){
        $this->flush();
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        // $today = date("Y-m-d H:i:s");
        $today = $dtz->format('Y-m-d H:i:s');

        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('user_id', 'fcm_token', 'device_id', 'device_details', 'created_date', 'error');
        $this->field_values = array($user_id, $token, $device_id, $device_details, $today, 0);
        return $this->query_insert();
    }

    function update_user_token_by_userid_deviceid($user_id, $token, $device_id){
        $this->flush();
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        // $today = date("Y-m-d H:i:s");
        $today = $dtz->format('Y-m-d H:i:s');

        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('fcm_token', 'updated_date', 'error');
        $this->field_values = array($token, $today, 0);
        $this->conditions = array('AND', 'user_id = ?', 'device_id = ?');
        $this->condition_values = array($user_id, $device_id);
        return $this->query_update();
    }

    function update_user_by_token_deviceid($user_id, $token, $device_id){
        $this->flush();
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        // $today = date("Y-m-d H:i:s");
        $today = $dtz->format('Y-m-d H:i:s');

        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('user_id', 'updated_date', 'error');
        $this->field_values = array($user_id, $today, 0);
        $this->conditions = array('AND', 'fcm_token = ?', 'device_id = ?');
        $this->condition_values = array($token, $device_id);
        return $this->query_update();
    }

    function refresh_token($user_id, $new_token, $old_token, $device_id){
        $this->flush();
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        // $today = date("Y-m-d H:i:s");
        $today = $dtz->format('Y-m-d H:i:s');

        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('fcm_token', 'updated_date', 'error');
        $this->field_values = array($new_token, $today, 0);
        $this->conditions = array('AND', 'fcm_token = ?', 'user_id = ?', 'device_id = ?');
        $this->condition_values = array($old_token, $user_id, $device_id);
        return $this->query_update();
    }

    function update_token_error($id, $updated_error){
        $this->flush();
        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->fields = array('error');
        $this->field_values = array($updated_error);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function delete_user_token($user_id, $token){
        $this->flush();
        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->conditions = array('AND', 'user_id = ?', 'fcm_token = ?');
        $this->condition_values = array($user_id, $token);
        return $this->query_delete();
    }

    function delete_user_token_by_id($id){
        $this->flush();
        $this->tables = array($this->db_master . '.push_notify_tokens');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete();
    }
}

?>