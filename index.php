<?php

require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array('messages.xml','user.xml'),FALSE);
$messages = new message();
$user = new user();

$smarty->assign('message', $messages->show_message());
if(isset($_SESSION['inactive_user']) && $_SESSION['inactive_user'] == "1"){
    session_destroy();
}
$files_contents = file_get_contents($smarty->url.'notification.txt');
$smarty->assign('file_content',$files_contents);

$redirect_url = '';
if(isset($_GET['redirect']) && $_GET['redirect'] != ''){
    $redirect_url = $_GET['redirect'];
    $smarty->assign('redirect', urlencode($redirect_url));
}


if (!empty($_POST)) {
    if (!empty($_POST['username'])) {
        $user->username = strip_tags($_POST['username']);
        $cur_user = $user->validate_username();
        if (!empty($cur_user)) {
            $_SESSION['user_id'] = $cur_user['username'];
            $_SESSION['user_role'] = $cur_user['role'];
            
            $companies = $user->get_user_companies($user->username);
            $comp_count = count($companies);
            
            $error_active = 0;
            if ($cur_user['role'] == 0) {   //root user
                $user_data = $cur_user['username'];
                $_SESSION['user_name'] = $user_data;
                
                header("Location: " . $smarty->url . "secondary/login/");
//                echo "<pre>".print_r($cur_user, 1)."</pre>"; exit();
                exit();
            } else {
                if ($comp_count == 1) {
                    $company_id = $companies[0]['id'];
                    $company_db_name = $user->get_company($company_id);
                    $_SESSION['db_name'] = $company_db_name['db_name'];
                    $_SESSION['company_id'] = $company_db_name['id'];
                    $_SESSION['company_sort_by'] = $company_db_name['sort_name_by'];
                    $user->select_db($_SESSION['db_name']);
                    
                    if ($redirect_url != '')
                        header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "secondary/login/");
                    exit();
                }
                else {
                    if ($redirect_url != '')
                        header("Location: " . $smarty->url . "secondary/login/?redirect=" . urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "secondary/login/");
                    exit();
                    
                    /*if ($redirect_url != '')
                        header("Location: " . $smarty->url . "select/company/?redirect=" . urlencode($redirect_url));
                    else
                        header("Location: " . $smarty->url . "select/company/");
                    exit();*/
                }
            }
        } else {
            $messages->set_message('fail', 'invalid_user');
            if ($redirect_url != '')
                header("Location: " . $smarty->url . "?redirect=" . urlencode($redirect_url));
            else
                header("Location: " . $smarty->url . "");
            exit();
        }
    }
    else {
        $messages->set_message('fail', 'enter_username');
        if ($redirect_url != '')
            header("Location: " . $smarty->url . "?redirect=" . urlencode($redirect_url));
        else
            header("Location: " . $smarty->url . "");
        exit();
    }
}

// !isset($_SESSION['user_role'])
//setting layout and page
//if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" )
    $smarty->display('extends:layouts/login.tpl|index.tpl');
//else
//    header("Location: " . $smarty->url . "gdschema/");
?>