<?php
//require_once('class/php_Session.php');
require_once('class/setup.php');
$smarty = new smartySetup(array(),FALSE);
require_once('class/user.php');
$user = new user();

$user->login = '0';
$user->username = $_SESSION['user_id'];
$user->company_id = $_SESSION['company_id'];
$id = $_SESSION['log_id'];

$user->reset_login(TRUE);

unset($_SESSION['user_id']);
unset($_SESSION['user_role']); 
unset($_SESSION['user_name']); 
unset($_SESSION['log_id']); 
unset($_SESSION['db_name']); 
unset($_SESSION['db_id']); 
unset($_SESSION['copy_slot']);
unset($_SESSION['message']);
unset($_SESSION['message_exact']);
unset($_SESSION['type']);
unset ($_REQUEST['action']);
unset ($_REQUEST['fkkn']);
unset ($_REQUEST['lang']);
unset ($_SESSION['report_return_url']);
unset ($_SESSION['from_page']);
unset ($_SESSION['last_activity']);
unset ($_SESSION['secondary_auth']);


unset ($_SESSION['company_change_access']);
unset ($_SESSION['previous_selected_company_details']);
//session_write_close();

//session_regenerate_id(true);


$user->log_login_update($id);
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Finally, destroy the session.
session_destroy();
//header("Location: ".$smarty->url);
if(isset($_GET['redirect']) && $_GET['redirect'] != '')
    echo '<script>document.location.href=\'' . $smarty->url . '?redirect='.urlencode($_GET['redirect']).'\'</script>';
else
    echo '<script>document.location.href=\'' . $smarty->url . '\'</script>';
?>