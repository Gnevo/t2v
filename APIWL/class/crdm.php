<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customer
 *
 * @author dona
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');

class c2dm extends db {

    //variable diclaration
    var $username = "";
    var $authcode = "";
    var $device_registration_id = 0;
    var $msgtype = ":Arion:";
    var $messagetext = "";
    

    function __construct() {

        parent::__construct();
    }

    function send_message_to_phone() {
        
        $headers = array('Authorization: GoogleLogin auth=' . $this->authcode);
        $data = array(
            'registration_id' => $this->device_registration_id,
            'collapse_key' => $this->msgtype,
            'delay_while_idle' => true,
            'data.message' => $this->messagetext
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://android.apis.google.com/c2dm/send");
        if ($headers)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function google_authenticate() {
        
        global $crdm;
        session_start();
        if (isset($_SESSION['google_auth_id']) && $_SESSION['google_auth_id'] != null)
            return $_SESSION['google_auth_id'];
        $ch = curl_init();
        if (!ch) {
            return false;
        }
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin");
        $post_fields = "accountType=" . urlencode('HOSTED_OR_GOOGLE')
                . "&Email=" . urlencode($crdm['username'])
                . "&Passwd=" . urlencode($crdm['password'])
                . "&source=" . urlencode($crdm['source'])
                . "&service=" . urlencode($crdm['service']);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        if (strpos($response, '200 OK') === false) {
            return false;
        }
        preg_match("/(Auth=)([\w|-]+)/", $response, $matches);

        if (!$matches[2]) {
            return false;
        }
        $_SESSION['google_auth_id'] = $matches[2];
        return $matches[2];
    }

    function get_device_registration_id() {

        $this->tables = array('devicetokens');
        $this->fields = array('devicetoken');
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (!empty($datas))
            return $datas[0]['devicetoken '];
        else
            return FALSE;
    }

}
?>
<!--
****************Usage************************

$var = new c2dm();
$var->username = "shkt001";
$var->device_registration_id = $var->get_device_registration_id();
$var->messagetext = "Hello World";
$var->authCode = $var->googleAuthenticate();
sendMessageToPhone();

****************Usage************************
-->