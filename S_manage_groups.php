<?php
/**
 * Author: Shamsu
 * for: manage survey questions activities
 */
require_once('class/setup.php');
require_once('class/survey.php');
require_once ('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml","survey.xml","survey_button.xml", "button.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$smarty->assign('survey_tab', 4);
$msg = new message();
$cls_survey = new survey();
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
        $this_group_id = trim($_POST['this_gid']);
        if($this_group_id == '')
            $msg->set_message('fail', 'group_not_exist');
        else{
            if($cls_survey->delete_group($this_group_id)){
                $msg->set_message('success', 'group_has_been_successfully_deleted');
                header('Location:'. $smarty->url.'manage/groups/list/');
                exit();
            }else
                $msg->set_message('fail', 'group_delete_failed');
        }
    }else{  //save condition
        $current_group = trim($_POST['this_gid']);
        $edit_flag = FALSE;
        if($current_group != ''){
            $this_questions = $cls_survey->get_survey_groups($current_group);
            if(!empty($this_questions))
                $edit_flag = TRUE;
        }
        $group_name = trim($_POST['txt_group_title']);
        $group_description = trim($_POST['group_description']);
        $count_users = count($_POST['user_ids']);
        $group_leader = '';
        if(isset($_POST['rd_groupleader'])){        //check valid group leader
            $group_leader = trim($_POST['rd_groupleader']);
            if(!in_array($group_leader, $_POST['user_ids']))
                $group_leader = '';
        }
        $proceed_flag = TRUE;
        if($group_name == ''){
            $msg->set_message('fail', 'group_name_should_not_be_empty');
            $proceed_flag = FALSE;
        }elseif($count_users <= 0){
            $msg->set_message('fail', 'select_atleast_one_user');
            $proceed_flag = FALSE;
        }
        if($proceed_flag){
            $cls_survey->begin_transaction();
            $success_flag = TRUE;
            if($edit_flag){     //editing already existed group
                if($cls_survey->update_group($current_group, $group_name, $group_description, $group_leader)){
                    if(!$cls_survey->delete_group_members_by_group_id($current_group))
                        $success_flag = FALSE;
                    foreach ($_POST['user_ids'] as $member) {
                        if(trim($member) == '')
                            continue;
                        if(!$cls_survey->insert_group_members($current_group, $member))
                                $success_flag = FALSE;        
                    }
                }
                if($success_flag){
                        $cls_survey->commit_transaction ();
                        $msg->set_message('success', 'group_has_been_successfully_edited');
                }else{
                        $cls_survey->rollback_transaction ();
                        $msg->set_message('fail', 'group_edit_failed');
                }
            }else{  //create new group
                if($cls_survey->create_group($group_name, $group_description, $group_leader)){
                    $group_id = $cls_survey->get_id();
                    foreach ($_POST['user_ids'] as $member) {
                        if(trim($member) == '')
                            continue;
                        if(!$cls_survey->insert_group_members($group_id, $member))
                                $success_flag = FALSE;        
                    }
                }
                if($success_flag){
                        $cls_survey->commit_transaction ();
                        $msg->set_message('success', 'group_has_been_successfully_saved');
                        header('Location:'. $smarty->url.'manage/groups/'.$group_id.'/');
                        exit();
                }else{
                        $cls_survey->rollback_transaction ();
                        $msg->set_message('fail', 'group_save_failed');
                }
            }
        }
    }
}

$available_users = $cls_survey->get_survey_employees();
$smarty->assign('users', $available_users);
$available_groups = $cls_survey->get_survey_groups();
$smarty->assign('groups', $available_groups);

$qry_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('show_group', 0);
if(!empty($qry_string) && $qry_string[0] != '' && $qry_string[0] != 'list'){
    $this_group_id = $qry_string[0];
    $this_group_details = $cls_survey->get_survey_groups($this_group_id);
    if(!empty($this_group_details)){
        $this_group_members = $cls_survey->get_survey_members($this_group_id);
        $filter_member_ids = array();
        if(count($this_group_members)> 0){
            foreach ($this_group_members as $member){
                $filter_member_ids[] = $member['username'];
            }
        }
        $smarty->assign('this_group_id', $this_group_id);
        $smarty->assign('this_group_details', $this_group_details[0]);
        $smarty->assign('this_group_members', $this_group_members);
        $smarty->assign('filter_members_ids', $filter_member_ids);
        $smarty->assign('show_group', 1);
    }
}

$smarty->assign('display_page', ($qry_string[0] == 'list' ? 'list' : 'manage'));
$smarty->assign('message', $msg->show_message());
$smarty->display('extends:layouts/dashboard.tpl|survey/surveys_manage_sub_layout.tpl|survey/manage_groups.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_groups.tpl');
?>