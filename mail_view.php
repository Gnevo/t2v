<?php
//die(var_dump('23333'));
require_once('class/setup.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml","button.xml","mail.xml"));
require_once('class/mail.php');
require_once('class/employee.php');
require_once('class/equipment.php');
require_once('class/customer.php');
$mail = new mail();
$equipment = new equipment();
$employee = new employee();
$messages = new message();
$customer = new customer();

//require_once('class/user.php');
//$user = new user();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));
$query_string = explode('&', $_SERVER['QUERY_STRING']);
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$mail_view = $mail->get_mail($query_string[0],$query_string[1]);
$compony_id = $_SESSION['company_id'];
$mail->set_as_read_mail($query_string[0]);
$folder = $customer->get_folder_name($compony_id);
$folder = $folder."/mail_attatch/";
$smarty->assign('folder',$folder);
$attachments = explode(',',$mail_view['attachments']);
$smarty->assign('mails',$mail_view);
$smarty->assign('attachments',$attachments);
$smarty->assign('met',$query_string[1]);
$smarty->assign('id_mail',$query_string[0]);
$smarty->display('extends:layouts/dashboard.tpl|mail_view.tpl');
?>
