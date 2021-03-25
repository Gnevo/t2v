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
$key3 = $_POST['key3'];
if (!empty($_POST['password']) && !empty($_POST['key1']) && !empty($_POST['key2']) && !empty($_POST['key3'])) {

    if ($_POST['cpassword'] != $_POST['password']) {
        $messages->set_message('fail', 'enter_saime_password_re-password');
        header("Location: " . $smarty->url . "reset_secondary_password/?key1=" . $key1 . "&key2=" . $key2. "&key3=" . $key3);
        exit;
    }
    $username = base64_decode($_POST['key1']);
    $password = base64_decode($_POST['key2']);
    $company = base64_decode($_POST['key3']);
    $user->username = strip_tags($username);
    $user->password = strip_tags($password);
    $user->company_id = strip_tags($company);
//    $valid = $user->check_key();
    $valid = $user->check_secondary_key();
    if ($valid) {
        $newpass = $_POST['password'];
        $user->change_secondary_password($newpass);
        $messages->set_message('success', 'reset_password_success');
        header("Location: " . $smarty->url);
        exit;
    }
    else {
        $messages->set_message('fail', 'password_reset_link_expired');
        header("Location: " . $smarty->url . "reset_secondary_password/?key1=" . $key1 . "&key2=" . $key2. "&key3=" . $key3);
        exit;
    }
} else {
    $messages->set_message('error', 'provide_password');
    header("Location: " . $smarty->url . "reset_secondary_password/?key1=" . $key1 . "&key2=" . $key2. "&key3=" . $key3);
    exit;
}
?>