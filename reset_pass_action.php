<?php

require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
//require_once('class/mail.php');

$smarty = new smartySetup(array("messages.xml"), FALSE);
$user = new user();
$messages = new message();
//$mail = new mail();
//$email = new email();

$key1 = $_POST['key1'];
$key2 = $_POST['key2'];
if (!empty($_POST['password']) && !empty($_POST['key1']) && !empty($_POST['key2'])) {

    if ($_POST['cpassword'] != $_POST['password']) {
        $messages->set_message('fail', 'enter_saime_password_re-password');
        header("Location: " . $smarty->url . "resetpassword/?key1=" . $key1 . "&key2=" . $key2);
        exit;
    }
    $username = base64_decode($_POST['key1']);
    $password = base64_decode($_POST['key2']);
    $user->username = strip_tags($username);
    $user->password = strip_tags($password);
    $valid = $user->check_key();
    //echo "<pre>";print_r($valid);exit;
    if (!empty($valid)) {
        $newpass = $_POST['password'];
        $user->username = $valid['username'];
        $user->change_password($newpass);
        $messages->set_message('success', 'reset_password_success');
        header("Location: " . $smarty->url);
        exit;
    }
    $messages->set_message('fail', 'password_reset_link_expired');
    header("Location: " . $smarty->url . "resetpassword/?key1=" . $key1 . "&key2=" . $key2);
    exit;
} else {
    $messages->set_message('error', 'provide_password');
    header("Location: " . $smarty->url . "resetpassword/?key1=" . $key1 . "&key2=" . $key2);
    exit;
}
?>