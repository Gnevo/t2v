<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/mail.php');
require_once('class/user.php');
require_once('class/dona.php');
require_once('class/notes.php');
require_once('class/support_new.php');
require_once('plugins/message.class.php');
require_once('class/survey.php');
require_once('class/company.php');
require_once('class/equipment.php');
$smarty        = new smartySetup(array("button.xml","messages.xml","notes.xml","mail.xml","user.xml", "support.xml"));
$messages      = new message();
$mail          = new mail();
//setting the menu
$dona          = new dona();
$notes         = new notes();
$support       = new support();
$obj_user      = new user();
$cls_survey    = new survey();
$obj_company   = new company();
$obj_equipment = new equipment();

$smarty->assign('message', $messages->show_message());
$smarty->assign('privileges_mc' , $obj_user->get_privileges($_SESSION['user_id'], 3));
$smarty->assign('emp_role' , $_SESSION['user_role']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));

$company_det = $obj_company->get_company_detail($_SESSION['company_id']);
$candg = $company_det['candg'];
$privileges_general = $obj_user->get_privileges($_SESSION['user_id'], 2);
if($_SESSION['user_role'] != 4){
    if($privileges_general['candg_wi'] == 1)
        $candg = 0;
    if($privileges_general['candg_wo'] == 1)
        $candg = 1;
}
$smarty->assign('candg', $candg);
$smarty->assign('candg_on', $privileges_general['candg_on']);
// start- fetch count of unread leaves
/*$leave_list = $dona->get_all_employee_leave();
$unread_leave = $dona->get_unread_leave();
$updated_unread_leave=$dona->get_all_unread_leaves($leave_list,$unread_leave);
$smarty->assign('unread_leaves_count', count($updated_unread_leave));*/
$smarty->assign('unread_leaves_count', $dona->get_employee_unread_leave_count());
// end- fetch count of unread leaves

// start- fetch count of unread notes
/*$notes_list = $notes->get_all_notes();
$unread_notes = $notes->get_unread_note(); 
$updated_unread_notes=$notes->get_all_unread_notes($notes_list,$unread_notes);
$smarty->assign('unread_notes_count', count($updated_unread_notes));*/
$smarty->assign('unread_notes_count', $notes->get_unread_note_count());
// end- fetch count of unread notes

$open_ticket_count = $support->get_ticket_open_count();
$smarty->assign('open_ticket_count', $open_ticket_count);

$count_of_categorys = $obj_equipment->get_all_document_archive_count();
if(!empty($count_of_categorys)){
	$smarty->assign('count_of_categorys', true);
}
else{	
	$smarty->assign('count_of_categorys', false);
}
$smarty->assign('unread_doc_count', $notes->document_archive_get_unread());


$unread_mail = $mail->get_all_unread_mail();
$smarty->assign('mail_count',count($unread_mail));
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in

$data = $cls_survey->get_surveys_user();
//echo "<pre>".print_r($data,1)."</pre>";
$smarty->assign('surveys',count($data));

//Setting layout and page
$smarty->display('extends:layouts/dashboard.tpl|message_center.tpl');
?>