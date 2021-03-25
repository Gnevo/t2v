<?php
/**
 * Author: Shamsu
 * for: manage survey questions activities
 */
require_once('class/setup.php');
require_once('class/survey.php');
require_once('class/customer.php');
require_once ('plugins/message.class.php');
require_once('class/mail.php');

$smarty = new smartySetup(array("messages.xml","survey.xml","survey_button.xml", "button.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$smarty->assign('survey_tab', 5);
$obj_customer = new customer();
$msg = new message();
$cls_survey = new survey();
$mail = new mail();
if($_SESSION['user_role'] != 1){        //check privilege
    echo "<html><body><BR><B>ERROR:</B> ".$smarty->translate['permission_denied'] ."</body></html>";
    exit;
}

if(isset($_POST['action'])){
    $action = trim($_POST['action']);   //1-Save, 2- delete
    $this_action = 0;
    switch ($action){
        case 1:
            $this_action = 1; break;
        case 2:
            $this_action = 2; break;
        default :
            $this_action = 1;
    }
    if($this_action == 2){  //delete condition
        $this_invitation_id = trim($_POST['this_Iid']);
        if($this_invitation_id == '')
            $msg->set_message('fail', 'group_not_exist');
        else{
            if($cls_survey->delete_invitation($this_invitation_id)){
                $msg->set_message('success', 'invitation_has_been_successfully_deleted');
                header('Location:'. $smarty->url.'manage/invitations/list/');
                exit();
            }else
                $msg->set_message('fail', 'invitation_delete_failed');
        }
    }else{  //save condition
        $current_invitation = trim($_POST['this_Iid']);
        $edit_flag = FALSE;
        if($current_invitation != ''){
            $this_invitation = $cls_survey->get_invitations($current_invitation);
            if(!empty($this_invitation))
                $edit_flag = TRUE;
        }
        $invitation_subject = trim($_POST['txtSubject']);
        $invitation_message = trim($_POST['txtMessage']);
        $count_users = count($_POST['user_ids']);
        $count_groups = count($_POST['group_ids']);
        $count_customers = count($_POST['customer_ids']);
        $count_surveys = count($_POST['suvery_ids']);
        
        $proceed_flag = TRUE;
        if($invitation_subject == ''){
            $msg->set_message('fail', 'invitation_subject_should_not_be_empty');
            $proceed_flag = FALSE;
        }elseif($count_users <= 0 && $count_groups <= 0 && $count_customers <= 0){
            $msg->set_message('fail', 'select_atleast_one_user_or_group');
            $proceed_flag = FALSE;
        }elseif($count_surveys <= 0){
            $msg->set_message('fail', 'select_atleast_one_survey');
            $proceed_flag = FALSE;
        }
        if($proceed_flag){
            $cls_survey->begin_transaction();
            $success_flag = TRUE;
            if($edit_flag){     //editing already existed invitation
                if($cls_survey->update_invitation($current_invitation, $invitation_subject, $invitation_message)){
                    $old_groups = $cls_survey->get_invitations_group_members($current_invitation);
                    $old_members = array();
                    $old_members_array = $cls_survey->get_invitations_members($current_invitation, 1);
                    foreach ($old_members_array as $old_member) {
                        $old_members[]['username'] =  $old_member['username'];
                    }
                    if(!empty($old_groups)) {
                        $old_members = array_merge($old_groups, $old_members);
                    }
                    $existing_users = array();
                    $new_users = array();
                    foreach ($old_members as $old_member) {
                        $existing_users[] = $old_member['username'];
                    }
                    $existing_users = array_unique($existing_users);
                    
                    if(!$cls_survey->delete_invitation_members($current_invitation))
                        $success_flag = FALSE;
                    if(!$cls_survey->delete_invitation_surveys($current_invitation))
                        $success_flag = FALSE;
                    if($count_users > 0){       //insert Individual Users
                        foreach ($_POST['user_ids'] as $member) {
                            if(trim($member) == '')
                                continue;
                            $new_users[] = $member;
                            if(!$cls_survey->create_invitation_members($current_invitation, 1, $member))
                                    $success_flag = FALSE;        
                        }
                    }
                    if($count_groups > 0){       //insert group id's
                        foreach ($_POST['group_ids'] as $group) {
                            if(trim($group) == '')
                                continue;
                            $group_members = $cls_survey->get_invitations_group_members($group);
                            foreach ($group_members as $group_member) {
                                $new_users[] = $group_member;
                            }
                            if(!$cls_survey->create_invitation_members($current_invitation, 0, $group))
                                    $success_flag = FALSE;        
                        }
                    }
                    if($count_customers > 0){       //insert customer id's
                        foreach ($_POST['customer_ids'] as $sel_customer) {
                            if(trim($sel_customer) == '') continue;
                            $new_users[] = $sel_customer;
                            if(!$cls_survey->create_invitation_members($current_invitation, 2, $sel_customer))
                                    $success_flag = FALSE;        
                        }
                    }
                    if($count_surveys > 0){       //insert survey id's
                        foreach ($_POST['suvery_ids'] as $survey_id) {
                            if(trim($survey_id) == '')
                                continue;
                            if(!$cls_survey->create_invitation_surveys($current_invitation, $survey_id))
                                    $success_flag = FALSE;        
                        }
                    }
                    //print_r($existing_users);exit();
                    if(!empty($new_users)) {
                        foreach ($new_users as $user) {
                            if(!in_array($user, $existing_users)) {
                                //echo $user . '<br/>';
                                $mail->root_id = 0;
                                $mail->method = 0;
                                $mail->from = $_SESSION['user_id'];
                                $mail->to = $user;
                                $mail->subject = $smarty->translate['survey_subject_pre'].$invitation_subject.$smarty->translate['survey_subject_post'];
                                $mail->message = $smarty->translate['survey_body_pre'].$invitation_message.$smarty->translate['survey_body_post'];
                                $mail->status = 0;
                                //echo '<pre>' . print_r($mail,1) . '</pre>';
                                if (!$mail->insert_mail(true)) {
                                    $success_flag = FALSE;
                                }
                            }
                        }
                    }
                }
                if($success_flag){
                        $cls_survey->commit_transaction ();
                        $msg->set_message('success', 'invitation_details_has_been_successfully_edited');
                }else{
                        $cls_survey->rollback_transaction ();
                        $msg->set_message('fail', 'invitation_details_edit_failed');
                }
                //exit();
            }else{  //create new invitation
                if($cls_survey->create_invitation($invitation_subject, $invitation_message)){
                    $invite_id = $cls_survey->get_id();
                    if($count_users > 0){       //insert Individual Users
                        foreach ($_POST['user_ids'] as $member) {
                            if(trim($member) == '')
                                continue;
                            
                            if(!$cls_survey->create_invitation_members($invite_id, 1, $member))
                                    $success_flag = FALSE;
                            else{
                                $mail->root_id = 0;
                                $mail->method = 0;
                                $mail->from = $_SESSION['user_id'];
                                $mail->to = $member;
                                $mail->subject = $smarty->translate['survey_subject_pre'].$invitation_subject.$smarty->translate['survey_subject_post'];
                                $mail->message = $smarty->translate['survey_body_pre'].$invitation_message.$smarty->translate['survey_body_post'];
                                $mail->status = 0;
                                if (!$mail->insert_mail(true)) {
                                    $success_flag = FALSE;
                                }

                            }
                        }
                    }
                    if($count_groups > 0){       //insert group id's
                        foreach ($_POST['group_ids'] as $group) {
                            if(trim($group) == '')
                                continue;
                            if(!$cls_survey->create_invitation_members($invite_id, 0, $group))
                                    $success_flag = FALSE;        
                        }
                    }
                    if($count_customers > 0){       //insert customer id's
                        foreach ($_POST['customer_ids'] as $sel_customer) {
                            if(trim($sel_customer) == '') continue;
                            if(!$cls_survey->create_invitation_members($invite_id, 2, $sel_customer))
                                    $success_flag = FALSE;        
                        }
                    }
                    if($count_surveys > 0){       //insert survey id's
                        foreach ($_POST['suvery_ids'] as $survey_id) {
                            if(trim($survey_id) == '')
                                continue;
                            if(!$cls_survey->create_invitation_surveys($invite_id, $survey_id))
                                    $success_flag = FALSE;        
                        }
                    }
                }
                if($success_flag){
                        $cls_survey->commit_transaction ();
                        $msg->set_message('success', 'invitation_has_been_successfully_created');
                        header('Location:'. $smarty->url.'manage/invitations/'.$invite_id.'/');
                        exit();
                }else{
                        $cls_survey->rollback_transaction ();
                        $msg->set_message('fail', 'invitation_creation_failed');
                }
            }
        }
    }
}

$available_users = $cls_survey->get_survey_employees();
$smarty->assign('users', $available_users);
$customers_list = $obj_customer->customer_list();
$smarty->assign('customers_list', $customers_list);
$available_groups = $cls_survey->get_survey_groups();
$smarty->assign('groups', $available_groups);
$list_invitations = $cls_survey->get_invitations();
$smarty->assign('invitations', $list_invitations);
$list_surveys = $cls_survey->get_surveys();
$smarty->assign('surveys', $list_surveys);

$qry_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('show_invitation', 0);
if(!empty($qry_string) && $qry_string[0] != '' && $qry_string[0] != 'list'){
    $this_invitation_id = $qry_string[0];
    $this_ivite_details = $cls_survey->get_invitations($this_invitation_id);
    if(!empty($this_ivite_details)){
        $this_invitation_groups = $cls_survey->get_invitations_members($this_invitation_id, 0);
        $this_invitation_individuals = $cls_survey->get_invitations_members($this_invitation_id, 1);
        $this_invitation_customers = $cls_survey->get_invitations_members($this_invitation_id, 2);
        $this_invitation_surveys = $cls_survey->get_invitations_surveys($this_invitation_id);
        $filter_member_ids = array();
        $filter_group_ids = array();
        $filter_survey_ids = array();
        if(count($this_invitation_individuals)> 0){
            foreach ($this_invitation_individuals as $member){
                $filter_member_ids[] = $member['username'];
            }
        }
        if(count($this_invitation_groups)> 0){
            foreach ($this_invitation_groups as $group){
                $filter_group_ids[] = $group['id'];
            }
        }
        if(count($this_invitation_customers)> 0){
            foreach ($this_invitation_customers as $save_customers){
                $filter_customer_ids[] = $save_customers['username'];
            }
        }
        if(count($this_invitation_surveys)> 0){
            foreach ($this_invitation_surveys as $survey){
                $filter_survey_ids[] = $survey['id'];
            }
        }
        $smarty->assign('this_invitation_id', $this_invitation_id);
        $smarty->assign('this_ivite_details', $this_ivite_details[0]);
        $smarty->assign('this_invitation_groups', $this_invitation_groups);
        $smarty->assign('this_invitation_individuals', $this_invitation_individuals);
        $smarty->assign('this_invitation_customers', $this_invitation_customers);
        $smarty->assign('this_invitation_surveys', $this_invitation_surveys);
        $smarty->assign('filter_members_ids', $filter_member_ids);
        $smarty->assign('filter_customer_ids', $filter_customer_ids);
        $smarty->assign('filter_group_ids', $filter_group_ids);
        $smarty->assign('filter_survey_ids', $filter_survey_ids);
        $smarty->assign('show_invitation', 1);
    }
}

$smarty->assign('display_page', ($qry_string[0] == 'list' ? 'list' : 'manage'));
$smarty->assign('message', $msg->show_message());
//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_invitations.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_invitations_test.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_invitations_test_accordion.tpl');
$smarty->display('extends:layouts/dashboard.tpl|survey/surveys_manage_sub_layout.tpl|survey/manage_invitations_test_accordion.tpl');
?>