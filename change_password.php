<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "button.xml"), FALSE);
$user = new user();
$messages = new message();

//echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
if ($_SESSION['user_id'] == '') {
    header("Location: " . $smarty->url);
    exit();
} 
else if ($_SESSION['company_id'] == '' && $_SESSION['user_role'] != '0' ) {
    header("Location: " . $smarty->url . "select/company/");
    exit();
}

if ($_POST['old_password'] != '' && $_POST['new_password'] != '' && $_POST['re_password'] != '') {
//    echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    if ($_POST['new_password'] == $_POST['re_password']) {
        $string_pass = strip_tags($_POST['new_password']);
        if (preg_match('/[A-Z]/', $string_pass) || preg_match('/[\d]/', $string_pass)) {
            
            if($_POST['old_password'] == $_POST['new_password']){
                $messages->set_message('fail', 'old_and_new_passwords_should_not_be_same');
                header("Location: " . $smarty->url . "change/password/");
                exit();
            }
            else {
                $user->username     = $_SESSION['user_id'];
                $user->company_id   = $_SESSION['company_id'];
                $old_password = strip_tags($_POST['old_password']);
                $new_password = strip_tags($_POST['new_password']);
                $valid_password = array();
                if ($_SESSION['user_role'] == 0)
                    $valid_password = $user->validate_password();
                else
                    $valid_password = $user->validate_secondary_password();
                if (md5($smarty->hash . strip_tags($_POST['old_password'])) == $valid_password['password']) {

                    $password_log = $user->get_password_log();
                    $passwords = explode(",", $password_log['passwords']);
                    array_push($passwords, $valid_password['password']);
                    $key = array_search(md5($smarty->hash . strip_tags($_POST['new_password'])), $passwords);
                    if ($key == false) {
                        $user->begin_transaction();
                        $user_update_flag = TRUE;
                        if ($_SESSION['user_role'] == 0)
                            $user_update_flag = $user->change_password($new_password);
                        else
                            $user_update_flag = $user->change_secondary_password($new_password);
                        if ($user_update_flag) {
                            if (!empty($password_log)) {
                                $old_passwords = $password_log['passwords'] . "," . md5($smarty->hash . strip_tags($_POST['old_password']));
                                if ($user->password_log_update($old_passwords)) {
                                    $user->commit_transaction();
                                    $messages->set_message('success', 'password_changing_success');
                                    $user->login = '1';
                                    if ($_SESSION['user_role'] == 0)
                                        $user->reset_login();
                                    else
                                        $user->reset_login(TRUE);

                                    unset($_COOKIE['PWORD_RESET']);
                                    setcookie('PWORD_RESET', '', time() - 3600, '/');

                                    if ($_SESSION['user_role'] == 0)
                                        header("Location: " . $smarty->url . "dashboard/");
                                    else{
                                        if(isset($_COOKIE['startup_summery_view']) && $_COOKIE['startup_summery_view'] == 'employee')
                                            header("Location: " . $smarty->url . "all/employee/gdschema/l/1/");
                                        else
                                            header("Location: " . $smarty->url . "all/gdschema/l/1/");
                                    }
                                    exit();
                                } else {
                                    $user->rollback_transaction();
                                    $messages->set_message('fail', 'password_changing_failed');
                                    header("Location: " . $smarty->url . "change/password/");
                                    exit();
                                }
                            } else {

                                if ($user->password_log_add($old_password)) {
                                    $user->commit_transaction();
                                    $messages->set_message('success', 'password_changing_success');
                                    $user->login = '1';
                                    $user->reset_login(TRUE);

                                    unset($_COOKIE['PWORD_RESET']);
                                    setcookie('PWORD_RESET', '', time() - 3600, '/');

                                    if ($_SESSION['user_role'] == 0)
                                        header("Location: " . $smarty->url . "dashboard/");
                                    else{
                                        if(isset($_COOKIE['startup_summery_view']) && $_COOKIE['startup_summery_view'] == 'employee')
                                            header("Location: " . $smarty->url . "all/employee/gdschema/l/1/");
                                        else
                                            header("Location: " . $smarty->url . "all/gdschema/l/1/");
                                    }
                                    exit();
                                } else {
                                    $user->rollback_transaction();
                                    $messages->set_message('fail', 'password_changing_failed');
                                    header("Location: " . $smarty->url . "change/password/");
                                    exit();
                                }
                            }
                        } else {
                            $messages->set_message('fail', 'password_changing_failed');
                            header("Location: " . $smarty->url . "change/password/");
                            exit();
                        }
                    } else {
                        $messages->set_message('fail', 'cannot_use_previous_passwords');
                        header("Location: " . $smarty->url . "change/password/");
                        exit();
                    }
                } else {
                    $messages->set_message('fail', 'incorrect_current_password');
                    header("Location: " . $smarty->url . "change/password/");
                    exit();
                }
            }
        } else {
            $messages->set_message('fail', 'password_contain_number_or_capital_letter');
            header("Location: " . $smarty->url . "change/password/");
            exit();
        }
    } else {
        $messages->set_message('fail', 'mismatch_passwords');
        header("Location: " . $smarty->url . "change/password/");
        exit();
    }
}

setcookie('PWORD_RESET', TRUE, strtotime("tomorrow"), "/");

$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/login.tpl|change_password.tpl');
?>