<?php
 
/**
 * @author Shamsudheen
 * Usage before using this class function, you should assign "FIREBASE_API_KEY" constant
    notification for those whose start time beteen current time and 20 minutes before
 */
require_once('configs/config.inc.php');
require_once('class/notification.php');
global $firebase_settings;

// Firebase API Key
define('FIREBASE_API_KEY', $firebase_settings['api_key']);

class Firebase {
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
    private $maximum_error_attemps_to_delete_token = 5;
    private $db_token_record = array();

    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }

    public function setDbTokenRecord($record) {
        $this->db_token_record = $record;
    }
 
    public function getPush() {
        $res = array();
        // $res['data']['title'] = $this->title;
        // $res['data']['is_background'] = $this->is_background;
        // $res['data']['message'] = $this->message;
        // $res['data']['image'] = $this->image;
        // $res['data']['payload'] = $this->data;
        // $res['data']['timestamp'] = date('Y-m-d G:i:s');
        $res['title']   = $this->title;
        $res['is_background']   = $this->is_background;
        $res['body']    = $this->message;
        $res['icon']    = $this->image;
        $res['payload'] = $this->data;
        $res['timestamp']       = date('Y-m-d G:i:s');
        $res['vibrate'] = 1;
        // $res['sound']   = 1;
        $res['sound']   = "default";
        return $res;
    }

    /****************************FirebasePush-Endzz**************************************/

    // sending push message to single user by firebase reg id
    public function send($to, $message, $handle_response = TRUE) {
        // $fields = array(
        //     'to' => $to,
        //     'data' => $message,
        // );
        $fields = array(
            'to' => $to,
            // 'registration_ids' => array('id1', 'id2'),
            'notification' => $message,
        );
        return $this->sendPushNotification($fields, $handle_response);
    }
 
    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
 
    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
        );
 
        return $this->sendPushNotification($fields);
    }
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields, $handle_response = FALSE) {

        if(defined('FIREBASE_API_KEY')){
            // echo "<pre>".print_r($fields, 1)."<pre>";
            // Set POST variables
            $url = 'https://fcm.googleapis.com/fcm/send';
     
            $headers = array(
                'Authorization: key=' . FIREBASE_API_KEY,
                'Content-Type: application/json'
            );
            // Open connection
            $ch = curl_init();
     
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
     
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
     
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
     
            // Close connection
            curl_close($ch);
     
            if($handle_response && !empty($this->db_token_record)){
                // echo "<pre>".print_r($result, 1)."<pre>";
                $decoded_response = array();
                if($result != '')
                    $decoded_response = json_decode($result);
                // echo "response notify: <pre>".print_r($decoded_response, 1)."<pre>";

                //validate any error raised and treat the curresponding token
                if(!empty($decoded_response) && 
                    isset($decoded_response->failure) && $decoded_response->failure == 1 &&
                    isset($decoded_response->results) && count($decoded_response->results) > 0 && $decoded_response->results[0]->error === 'NotRegistered'){

                    $obj_notification = new notification();
                    if($this->maximum_error_attemps_to_delete_token <= ($this->db_token_record['error'] + 1))
                        $obj_notification->delete_user_token_by_id($this->db_token_record['id']);
                    else
                        $obj_notification->update_token_error($this->db_token_record['id'], $this->db_token_record['error'] + 1);
                }
                //reset error for the curresponding token
                else if(!empty($decoded_response) && isset($decoded_response->success) && $decoded_response->success == 1 && $this->db_token_record['error'] > 0){
                    $obj_notification = new notification();
                    $obj_notification->update_token_error($this->db_token_record['id'], 0);
                }
            }

            return $result;
        }
        return FALSE;
    }
}
?>