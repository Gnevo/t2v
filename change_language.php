<?php

require_once('class/setup.php');
require_once('class/user.php');

$smarty = new smartySetup(array(), FALSE);
$user = new user();


$redirect_url =  $_POST['redirect_form'];

if (isset($_POST['user_language']) && $_POST['user_language'] != '') {


    if ($_SESSION['lang'] != $_POST['user_language']) {
        if ($user->update_user_language($_SESSION['user_id'], $_SESSION['user_role'], $_POST['user_language'])) {
            $_SESSION['lang'] = $_POST['user_language'];
            if ($redirect_url != '')
                header("Location: " . urldecode($redirect_url));
            else{
                if(isset($_COOKIE['startup_summery_view']) && $_COOKIE['startup_summery_view'] == 'employee')
                    header("Location: " . $smarty->url . "all/employee/gdschema/l/");
                else
                    header("Location: " . $smarty->url . "all/gdschema/l/");
            }
            exit();
        }
    }
}
?>