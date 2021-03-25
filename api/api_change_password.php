<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml", "button.xml"), FALSE);
$user = new user();
$messages = new message();

$obj = new stdClass();
$obj->message = '';
$process_flag = TRUE;

$user->username     = strip_tags(trim($_REQUEST['user_id']));
$user->company_id   = strip_tags(trim($_REQUEST['company_id']));

if($user->username == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'enter_username');
    $obj->error_message = $messages->show_message_exact();
}
else if($user->company_id == ''){
    $process_flag = FALSE;
    $obj->error = 1;
    $messages->set_message('fail', 'invalid_company');
    $obj->error_message = $messages->show_message_exact();
}
$old_password = urldecode($_REQUEST['old_password']);
$new_password = urldecode($_REQUEST['new_password']);
$re_password = urldecode($_REQUEST['re_password']);
if ($process_flag && $old_password != '' && $new_password != '' && $re_password != '') {
    if ($new_password == $re_password) {
        $string_pass = strip_tags($new_password);
        if (preg_match('/[A-Z]/', $string_pass) || preg_match('/[\d]/', $string_pass)) {
            if($old_password == $new_password){
                $obj->message = 'old_and_new_passwords_should_not_be_same';
                $obj->status = FALSE;
                $process_flag = FALSE;
                $obj->error = 1;
            }
            else {
    //            $user->username     = $_SESSION['user_id'];
    //            $user->company_id   = $_SESSION['company_id'];
                $old_password = strip_tags($old_password);
                $new_password = strip_tags($new_password);
                $valid_password = $user->validate_secondary_password();
                if (md5($smarty->hash . strip_tags($old_password)) == $valid_password['password']) {

                    $password_log = $user->get_password_log();
                    $passwords = explode(",", $password_log['passwords']);
                    array_push($passwords, $valid_password['password']);
                    $key = array_search(md5($smarty->hash . strip_tags($new_password)), $passwords);
                    if ($key == false) {
                        $user->begin_transaction();
                        $user_update_flag = $user->change_secondary_password($new_password);
                        if ($user_update_flag) {
                            if (!empty($password_log)) {
                                $old_passwords = $password_log['passwords'] . "," . md5($smarty->hash . strip_tags($old_password));
                                if ($user->password_log_update($old_passwords)) {
                                    $user->commit_transaction();
                                    $obj->message = $smarty->translate['password_changing_success'];
                                    $obj->status = TRUE;
                                    $user->login = '1';
                                    $user->reset_login(TRUE);
                                } else {
                                    $user->rollback_transaction();
                                    $obj->message = $smarty->translate['password_changing_failed'];
                                    $obj->status = FALSE;
                                    $process_flag = FALSE;
                                    $obj->error = 1;
                                }
                            } else {

                                if ($user->password_log_add($old_password)) {
                                    $user->commit_transaction();
                                    $user->login = '1';
                                    $user->reset_login(TRUE);
                                    $obj->message = $smarty->translate['password_changing_success'];
                                    $obj->status = TRUE;

                                } else {
                                    $obj->message = $smarty->translate['password_changing_failed'];
                                    $obj->status = FALSE;
                                    $process_flag = FALSE;
                                    $obj->error = 1;
                                }
                            }
                        } else {
                            $obj->message = 'password_changing_failed';
                            $obj->status = FALSE;
                            $process_flag = FALSE;
                            $obj->error = 1;
                        }
                    } else {
                        $obj->message = $smarty->translate['cannot_use_previous_passwords'];
                        $obj->status = FALSE;
                        $process_flag = FALSE;
                        $obj->error = 1;
                    }
                } else {
                    $obj->message = $smarty->translate['incorrect_current_password'];
                    $obj->status = FALSE;
                    $process_flag = FALSE;
                    $obj->error = 1;
                }
            }
        } else {
            $obj->message = $smarty->translate['password_contain_number_or_capital_letter'];
            $obj->status = FALSE;
            $process_flag = FALSE;
            $obj->error = 1;
        }
    } else {
        $obj->message = $smarty->translate['mismatch_passwords'];
        $obj->status = FALSE;
        $process_flag = FALSE;
        $obj->error = 1;
    }
}
else {
    $obj->message = 'password_changing_failed';
    $obj->status = FALSE;
    $process_flag = FALSE;
    $obj->error = 1;
}

echo json_encode($obj);
?>
