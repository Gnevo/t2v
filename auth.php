<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("messages.xml"));
require_once('class/user.php');
$user = new user();
require_once('plugins/message.class.php');
$messages = new message();

$redirect_url = '';
if(isset($_GET['redirect']) && $_GET['redirect'] != '')
    $redirect_url = $_GET['redirect'];

if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $user->username = strip_tags($_POST['username']);
    $user->password = strip_tags($_POST['password']);
    
    if(isset($_POST['rtacc']) && $_POST['rtacc'] != ""){
        $cur_user = $user->validate_login('rtacc');
    }else{
        $cur_user = $user->validate_login();
    }
    if (!empty($cur_user)) {    //if valid user do following
       
        $create_date = $cur_user['date'];
        $date_after = strtotime(date("Y-m-d", strtotime($create_date)) . "+6 month"); // calculating date after 3 month
        $company_id = explode(",", substr($cur_user['company_ids'], 0, -1));
        $comp_count = count($company_id);
        $_SESSION['user_id'] = $cur_user['username'];
        $_SESSION['user_role'] = $cur_user['role'];
        $user->update_session();
        $error_active = 0;
        if ($cur_user['role'] == 0) {   //root user

            $user_data = $cur_user['username'];
            $_SESSION['user_name'] = $user_data;

            $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
            $_SESSION['log_id'] = $log_id;

            if ($cur_user['last_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $date_after)) {
                header("Location: " . $smarty->url . "change/password/");
            } elseif ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] < '4') {
                $_SESSION['secondary_auth'] = TRUE;
                $user->login = '1';
                $user->reset_login();
                if ($cur_user['error'] != '0') {
                    $error = $user->reset_error();
                }
                header("Location: " . $smarty->url . "dashboard/");
                exit();
            } elseif ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] > '3') {
                $message = 'contact_administrator';
                $type = "fail";
                $messages->set_message($type, $message);
                header("Location: " . $smarty->url . "");
            }
        }
        else {
            if ($comp_count == '1') {
                
                $company_db_name = $user->get_company($company_id[0]);
                $_SESSION['db_name'] = $company_db_name['db_name'];
                $_SESSION['company_id'] = $company_db_name['id'];
                $_SESSION['company_sort_by'] = $company_db_name['sort_name_by'];
                $user->select_db($_SESSION['db_name']);
                if ($cur_user['role'] == '4') {
                    $user_detail = $user->get_customer_detail();
                    if (!empty($user_detail)) {
                        if($user_detail['status'] == '1')
                            $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                        else
                            $error_active = 1;
                    }
                } else {
                    $user_detail = $user->get_employee_detail();
                    if (!empty($user_detail)) {
                        if($user_detail['status'] == '1' || $user_detail['is_genuine'] == '0')
                            $user_data = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                        else   
                            $error_active = 1;
                    } else {
                        $user_data = $cur_user['username'];
                    }
                }
                if($error_active == 0){
                    $_SESSION['user_name'] = $user_data;

                    $user->username = $cur_user['username'];

                    $log_id = $user->log_login_add($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['log_id'] = $log_id;

                    if ($cur_user['last_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $date_after)) {
                        header("Location: " . $smarty->url . "change/password/");
                        exit();
                    } elseif ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] < '4') {
                        $user->login = '1';
                        $user->reset_login();
                        if ($cur_user['error'] != '0') {
                            $error = $user->reset_error();
                        }
                        
                        $_SESSION['secondary_auth'] = TRUE;
                        
//                        header("Location: " . $smarty->url . "gdschema/");
//                        echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
                          if($redirect_url != '')
                            header("Location: " . urldecode($redirect_url));
                          else
                            header("Location: " . $smarty->url . "all/gdschema/l/1/");
                          exit();
                    } elseif ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] > '3') {
                        $message = 'contact_administrator';
                        $type = "fail";
                        $messages->set_message($type, $message);
                        if($redirect_url != '')
                            header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
                        else
                            header("Location: " . $smarty->url . "");
                        exit();
                    }
                }else{
                    $_SESSION['inactive_user'] = "1";
                    $message = 'user_inactive';
                    $type = "fail";
                    $messages->set_message($type, $message);
                    if($redirect_url != '')
                        header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "");
                }
            } 
            else {
                if ($cur_user['last_time'] != '0000-00-00 00:00:00' && $cur_user['error'] > '3') {
                    $messages->set_message('fail', 'contact_administrator');
                    if($redirect_url != '')
                        header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "");
                    exit();
                }
                else {
                
                    //echo "<script>alert(\"".$_SESSION['user_id']."\")</script>";
                    if($redirect_url != '')
                        header("Location: " . $smarty->url . "select/company/?redirect=".urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "select/company/");
                    exit();
                }
            }
        }
    } 
    else {  //if not valid user
        $cur_username = $user->validate_username();
        if (!empty($cur_username)) {
            if ($cur_username['password'] != NULL) {

                $user->username = $cur_username['username'];
                $user->error = $cur_username['error'];
                if (md5($smarty->hash . strip_tags($_POST['password'])) != $cur_username['password']/* && $_POST['password'] !='9895757717'*/) {

                    if ($cur_username['last_time'] != '0000-00-00 00:00:00') {
                        $set_error = $user->set_error();
                    }

                    $message = 'invalid_username_or_password';
                    $type = "fail";
                    $messages->set_message($type, $message);
                    if($redirect_url != '')
                        header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "");
                }
            } else {
                $message = 'contact_administrator';
                $type = "fail";
                $messages->set_message($type, $message);
                if($redirect_url != '')
                    header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
                else
                    header("Location: " . $smarty->url . "");
            }
        } else {
            $message = 'invalid_user';
            $type = "fail";
            $messages->set_message($type, $message);
            if($redirect_url != '')
                header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
            else
                header("Location: " . $smarty->url . "");
        }
    }
} else {
    $message = 'enter_username_password';
    $type = "fail";
    $messages->set_message($type, $message);
    if($redirect_url != '')
        header("Location: " . $smarty->url . "?redirect=".urlencode($redirect_url));
    else
        header("Location: " . $smarty->url . "");
}
?>