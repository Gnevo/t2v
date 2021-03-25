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
$smarty->assign('survey_tab', 1);
$msg = new message();
$cls_survey = new survey();
if($_SESSION['user_role'] != 1){        //check privilege
    echo "<html><body><BR><B>ERROR:</B> ".$smarty->translate['permission_denied'] ."</body></html>";
    exit;
}

$qry_string = explode('&', $_SERVER['QUERY_STRING']);
$form_id = NULL;
if(!empty($qry_string) && trim($qry_string[1]) != '' && trim($qry_string[1]) != 'NULL'){
    $form_id = trim($qry_string[1]);
    $selected_form = $cls_survey->get_forms($form_id);
    if(empty($selected_form))
        $form_id = NULL;
    $smarty->assign('selected_form_title', $selected_form[0]['title']);
}
$survey_id = NULL;
if(!empty($qry_string) && trim($qry_string[2]) != '' && trim($qry_string[2]) != 'NULL'){
    $survey_id = trim($qry_string[2]);
    $selected_survey = $cls_survey->get_surveys($survey_id);
    if(empty($selected_survey))
        $survey_id = NULL;
    $smarty->assign('selected_survey_title', $selected_survey[0]['survey_title']);
}
$smarty->assign('selected_form', $form_id);
$smarty->assign('selected_survey', $survey_id);


if(isset($_POST['action'])){
    /*  Answer type values on db
        1 	Radio Button
	2 	Check Box
	3 	Combo box
	4 	plain Text
	5 	Text area
	6 	Star Rating
	7 	Custom Rating
	8 	Date/Time
	9 	File Upload
	10 	Likert Matrix*/
    $questionType_with_multipleAnswers = array(1,2,3,10);
    $action = trim($_POST['action']);   //0- Save & Finalize, 1-Save, 2- delete
    $this_action = 0;
    switch ($action){
        case 0:
            $this_action = 0; break;
        case 2:
            $this_action = 2; break;
        default :
            $this_action = 1;
    }
    if($this_action == 2){  //delete condition
        $this_question_id = trim($_POST['this_qid']);
        if($this_question_id == '')
            $msg->set_message('fail', 'question_not_exist');
        else{
            $this_questions = $cls_survey->get_questions($this_question_id);
            if($cls_survey->delete_question($this_question_id)){
                if($this_questions[0]['answer_type'] == 10)     //for likert matrix type question -delete subquestions
                    $result = $cls_survey->delete_subquestions($this_question_id);
                $msg->set_message('success', 'question_has_been_successfully_deleted');
                header('Location:'. $smarty->url.'manage/questions/');
                exit();
            }else
                $msg->set_message('fail', 'question_delete_failed');
        }
    }else{  //save condition
        $current_question = trim($_POST['this_qid']);
        $edit_flag = FALSE;
        $edit_flag_for_form_question = FALSE;
        if($current_question != ''){
            $this_questions = $cls_survey->get_questions($current_question);
            $old_answer_type = $this_questions[0]['answer_type'];
            if(!empty($this_questions) && $this_questions[0]['status'] != 0)    // checking is finalized question?
                $edit_flag = TRUE;
            if(!empty($this_questions))    // checking is finalized question?
                $edit_flag_for_form_question = TRUE;
        }
        $question_type = trim($_POST['q_type']);
        $question_text = trim($_POST['txt_question']);
        $proceed_flag = TRUE;
        if($question_text == ''){
            $msg->set_message('fail', 'question_should_not_be_empty');
            $proceed_flag = FALSE;
        }else if($question_type == ''){
            $msg->set_message('fail', 'select_an_answer_type');
            $proceed_flag = FALSE;
        }
        $question_status = $this_action;
        if($proceed_flag){
            $selected_categories = NULL;
            if(isset($_POST['categories']) && !empty($_POST['categories'])){
                $selected_categories = implode(',', $_POST['categories']). ',';
            }
            switch ($question_type){
                case 'text':
                    $answer_point = trim($_POST['answer_point']);
                    $answer_hint = trim($_POST['answer_hint']);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){     //Add new record
                        if($cls_survey->insert_question($question_text, 4, $answer_hint, $question_status, 0, $selected_categories)){
                            $question_id = $cls_survey->get_id();
                            if($cls_survey->insert_answer($question_id, NULL, $answer_point)){
                                    $cls_survey->commit_transaction ();
                                    $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                    $cls_survey->rollback_transaction ();
                                    $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 4, $answer_hint, $question_status, 0, $selected_categories)){
                            if(in_array($old_answer_type, $questionType_with_multipleAnswers)){    //check is answer type changed(different behaviour of question types)?
                                if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                                if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                                }
                                if($cls_survey->insert_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_saved');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_save_failed');
                                }
                            }else{      // similar question type
                                if($cls_survey->update_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'textarea':
                    $answer_point = trim($_POST['answer_point']);
                    $answer_hint = trim($_POST['answer_hint']);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 5, $answer_hint, $question_status, 0, $selected_categories)){
                            $question_id = $cls_survey->get_id();
                            if($cls_survey->insert_answer($question_id, NULL, $answer_point)){
                                    $cls_survey->commit_transaction ();
                                    $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                    $cls_survey->rollback_transaction ();
                                    $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 5, $answer_hint, $question_status, 0, $selected_categories)){
                            if(in_array($old_answer_type, $questionType_with_multipleAnswers)){    //check is answer type changed(different behaviour of question types)?
                                if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                                if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                                }
                                if($cls_survey->insert_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }else{      // similar question type
                                if($cls_survey->update_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'check':
                    $answer_hint = trim($_POST['answer_hint']);
                    $display_style = trim($_POST['ckbox_sel_disp_style']);  // 1-vertical, 2-horizontal
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $option_count = count($_POST['ckbox']);
                    $default_values = array();
                    for($i = 0 ; $i < $option_count ; $i++){
                        if($_POST['ckbox'][$i] == 'NULL'){
                            $default_values[] = 0;
                        }else{
                            $default_values[] = 1;
                            $i++;
                        }
                    }
                    $option_count = count($_POST['ckbox_txt']);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 2, $answer_hint, $question_status, 0, $selected_categories, $display_style, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            $success_flag = TRUE;
                            for($i = 0 ; $i < $option_count ; $i++){
                                    if(trim($_POST['ckbox_txt'][$i]) == '')
                                        continue;
                                    $answer_text = trim($_POST['ckbox_txt'][$i]);
                                    $answer_point = trim($_POST['ckbox_point'][$i]);
                                    if($cls_survey->insert_answer($question_id, $answer_text, $answer_point, 0, $default_values[$i])){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 2, $answer_hint, $question_status, 0, $selected_categories, $display_style, $comment_flag)){
                            $success_flag = TRUE;
                            if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                            if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                            }
                            for($i = 0 ; $i < $option_count ; $i++){
                                    if(trim($_POST['ckbox_txt'][$i]) == '')
                                        continue;
                                    $answer_text = trim($_POST['ckbox_txt'][$i]);
                                    $answer_point = trim($_POST['ckbox_point'][$i]);
                                    if($cls_survey->insert_answer($current_question, $answer_text, $answer_point, 0, $default_values[$i])){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_edited');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_edit_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'radio':
                    $answer_hint = trim($_POST['answer_hint']);
                    $display_style = trim($_POST['rdbox_sel_disp_style']);  // 1-vertical, 2-horizontal
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $option_count = count($_POST['rdbox']);
                    $default_values = array();
                    for($i = 0 ; $i < $option_count ; $i++){
                        if($_POST['rdbox'][$i] == 'NULL'){
                            $default_values[] = 0;
                        }else{
                            $default_values[] = 1;
                            $i++;
                        }
                    }
                    $option_count = count($_POST['rdbox_txt']);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 1, $answer_hint, $question_status, 0, $selected_categories, $display_style, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            $success_flag = TRUE;
                            for($i = 0 ; $i < $option_count ; $i++){
                                    if(trim($_POST['rdbox_txt'][$i]) == '')
                                        continue;
                                    $answer_text = trim($_POST['rdbox_txt'][$i]);
                                    $answer_point = trim($_POST['rdbox_point'][$i]);
                                    if($cls_survey->insert_answer($question_id, $answer_text, $answer_point, 0, $default_values[$i])){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 1, $answer_hint, $question_status, 0, $selected_categories, $display_style, $comment_flag)){
                            $success_flag = TRUE;
                            if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                            if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                            }
                            for($i = 0 ; $i < $option_count ; $i++){
                                    if(trim($_POST['rdbox_txt'][$i]) == '')
                                        continue;
                                    $answer_text = trim($_POST['rdbox_txt'][$i]);
                                    $answer_point = trim($_POST['rdbox_point'][$i]);
                                    if($cls_survey->insert_answer($current_question, $answer_text, $answer_point, 0, $default_values[$i])){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_edited');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_edit_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'combo':
                    $answer_hint = trim($_POST['answer_hint']);
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $option_count = count($_POST['cmbbox']);
                    $default_values = array();
                    for($i = 0 ; $i < $option_count ; $i++){
                        if($_POST['cmbbox'][$i] == 'NULL'){
                            $default_values[] = 0;
                        }else{
                            $default_values[] = 1;
                            $i++;
                        }
                    }
                    $option_count = count($_POST['cmbbox_txt']);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 3, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            $success_flag = TRUE;
                            for($i = 0 ; $i < $option_count ; $i++){
                                    if(trim($_POST['cmbbox_txt'][$i]) == '')
                                        continue;
                                    $answer_text = trim($_POST['cmbbox_txt'][$i]);
                                    $answer_point = trim($_POST['cmbbox_point'][$i]);
                                    if($cls_survey->insert_answer($question_id, $answer_text, $answer_point, 0, $default_values[$i])){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 3, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            $success_flag = TRUE;
                            if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                            if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                            }
                            for($i = 0 ; $i < $option_count ; $i++){
                                    if(trim($_POST['cmbbox_txt'][$i]) == '')
                                        continue;
                                    $answer_text = trim($_POST['cmbbox_txt'][$i]);
                                    $answer_point = trim($_POST['cmbbox_point'][$i]);
                                    if($cls_survey->insert_answer($current_question, $answer_text, $answer_point, 0, $default_values[$i])){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_edited');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_edit_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'star_rating':
                    $answer_point = trim($_POST['answer_point']);
                    $answer_hint = trim($_POST['answer_hint']);
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $lower_value = trim($_POST['lower_value']);
                    $upper_value = trim($_POST['upper_value']);
                    $star_count = trim($_POST['star_count']);
                    $answer_params = $lower_value.'||'.$upper_value.'||'.$star_count; //to generate stars
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 6, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            if($cls_survey->insert_answer($question_id, $answer_params, $answer_point)){
                                    $cls_survey->commit_transaction ();
                                    $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                    $cls_survey->rollback_transaction ();
                                    $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 6, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            if(in_array($old_answer_type, $questionType_with_multipleAnswers)){    //check is answer type changed(different behaviour of question types)?
                                if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                                if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                                }
                                if($cls_survey->insert_answer($current_question, $answer_params, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }else{      // similar question type
                                if($cls_survey->update_answer($current_question, $answer_params, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'custom_rating':
                    $answer_point = trim($_POST['answer_point']);
                    $answer_hint = trim($_POST['answer_hint']);
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $out_of_rate = trim($_POST['out_of']);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 7, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            if($cls_survey->insert_answer($question_id, $out_of_rate, $answer_point)){
                                    $cls_survey->commit_transaction ();
                                    $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                    $cls_survey->rollback_transaction ();
                                    $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 7, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            if(in_array($old_answer_type, $questionType_with_multipleAnswers)){    //check is answer type changed(different behaviour of question types)?
                                if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                                if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                                }
                                if($cls_survey->insert_answer($current_question, $out_of_rate, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }else{      // similar question type
                                if($cls_survey->update_answer($current_question, $out_of_rate, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'date':
                    $answer_point = trim($_POST['answer_point']);
                    $answer_hint = trim($_POST['answer_hint']);
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 8, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            if($cls_survey->insert_answer($question_id, NULL, $answer_point)){
                                    $cls_survey->commit_transaction ();
                                    $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                    $cls_survey->rollback_transaction ();
                                    $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 8, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            if(in_array($old_answer_type, $questionType_with_multipleAnswers)){    //check is answer type changed(different behaviour of question types)?
                                if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                                if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                                }
                                if($cls_survey->insert_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }else{      // similar question type
                                if($cls_survey->update_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'file':
                    $answer_point = trim($_POST['answer_point']);
                    $answer_hint = trim($_POST['answer_hint']);
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 9, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            if($cls_survey->insert_answer($question_id, NULL, $answer_point)){
                                    $cls_survey->commit_transaction ();
                                    $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                    $cls_survey->rollback_transaction ();
                                    $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 9, $answer_hint, $question_status, 0, $selected_categories, 0, $comment_flag)){
                            if(in_array($old_answer_type, $questionType_with_multipleAnswers)){    //check is answer type changed(different behaviour of question types)?
                                if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                                if($old_answer_type == 10){     //check old question type is likert to delete subquestions
                                    if(!$cls_survey->delete_subquestions($current_question))
                                        $success_flag = FALSE;
                                }
                                if($cls_survey->insert_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }else{      // similar question type
                                if($cls_survey->update_answer($current_question, NULL, $answer_point)){
                                        $cls_survey->commit_transaction ();
                                        $msg->set_message('success', 'question_has_been_successfully_edited');
                                }else{
                                        $cls_survey->rollback_transaction ();
                                        $msg->set_message('fail', 'question_edit_failed');
                                }
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                case 'likert':
                    $answer_hint = trim($_POST['answer_hint']);
                    $display_style = trim($_POST['sel_disp_style']);  // 1-vertical, 2-horizontal
                    $comment_flag = isset($_POST['txt_comment'])? 1 : (isset($_POST['txtArea_comment'])? 2 : 0);
                    $cls_survey->begin_transaction();
                    if(!$edit_flag){    //Add new record
                        if($cls_survey->insert_question($question_text, 10, $answer_hint, $question_status, 0, $selected_categories, $display_style, $comment_flag)){
                            $question_id = $cls_survey->get_id();
                            $success_flag = TRUE;
                            $question_count = count($_POST['subquestion']);
                            for($i = 0 ; $i < $question_count ; $i++){  //insert subquestions
                                    if(trim($_POST['subquestion'][$i]) == '')
                                        continue;
                                    $subquestion = trim($_POST['subquestion'][$i]);
                                    if($cls_survey->insert_question($subquestion, 10, NULL, $question_status, $question_id, NULL, 0, 0)){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            $column_count = count($_POST['subcolumn']);
                            for($i = 0 ; $i < $column_count ; $i++){
                                    if(trim($_POST['subcolumn'][$i]) == '')
                                        continue;
                                    $column_head = trim($_POST['subcolumn'][$i]);
                                    $column_point = trim($_POST['point'][$i]);
                                    if($cls_survey->insert_answer($question_id, $column_head, $column_point)){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_saved');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_save_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_save_failed');
                        }
                    }else{      //Update existing record
                        if($cls_survey->update_question($current_question, $question_text, 10, $answer_hint, $question_status, 0, $selected_categories, $display_style, $comment_flag)){
                            $success_flag = TRUE;
                            
                            //subquestion manipulation
                            if(!$cls_survey->delete_subquestions($current_question))
                                    $success_flag = FALSE;
                            $question_count = count($_POST['subquestion']);
                            for($i = 0 ; $i < $question_count ; $i++){  //insert subquestions
                                    if(trim($_POST['subquestion'][$i]) == '')
                                        continue;
                                    $subquestion = trim($_POST['subquestion'][$i]);
                                    if($cls_survey->insert_question($subquestion, 10, NULL, $question_status, $current_question, NULL, 0, 0)){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            
                            //column manipulation
                            if(!$cls_survey->delete_answer_by_questionID($current_question))
                                    $success_flag = FALSE;
                            
                            $column_count = count($_POST['subcolumn']);
                            for($i = 0 ; $i < $column_count ; $i++){
                                    if(trim($_POST['subcolumn'][$i]) == '')
                                        continue;
                                    $column_head = trim($_POST['subcolumn'][$i]);
                                    $column_point = trim($_POST['point'][$i]);
                                    if($cls_survey->insert_answer($current_question, $column_head, $column_point)){
                                            $success_flag = ($success_flag) ? TRUE : FALSE;
                                    }else{
                                            $success_flag = FALSE;
                                            break;
                                    }
                                    if(!$success_flag)
                                        break;
                            }
                            
                            if($success_flag){
                                $cls_survey->commit_transaction ();
                                $msg->set_message('success', 'question_has_been_successfully_edited');
                            }else{
                                $cls_survey->rollback_transaction ();
                                $msg->set_message('fail', 'question_edit_failed');
                            }
                        }else{
                            $cls_survey->rollback_transaction ();
                            $msg->set_message('fail', 'question_edit_failed');
                        }
                    }
                    break;
                default:
                    $msg->set_message('fail', 'ivalid_question_type');
            }
            
            //this part is used to assign question to form if an form instance is existed on the form
            //it creates new question-form entry in form_question table
            if(!$edit_flag_for_form_question && $form_id != NULL){ //check is this a new question (otherwise already existed on the form)
                $order_number = $cls_survey->get_max_question_order_by_formID($form_id);
                $next_order = $order_number['max_order']+1;
                $cls_survey->insert_form_questions($form_id,$question_id,$next_order);
                $form_detail = $cls_survey->get_forms($form_id);
                $break_numbers = explode(",",$form_detail[0]['break_numbers']);
                $brek_num = intval($break_numbers[count($break_numbers) - 1]) + 1;
                $break_numbers_temp = '';
                if(count($break_numbers) == 1){
                    $break_numbers_temp = $brek_num;
                }else{
                    for($i=0;$i<count($break_numbers)-1;$i++){
                        if($break_numbers_temp == ''){
                            $break_numbers_temp = $break_numbers[$i];
                        }
                        else{
                            $break_numbers_temp = $break_numbers_temp.",".$break_numbers[$i];
                        }
                    }
                    $break_numbers_temp = $break_numbers_temp.",".$brek_num;
                }
                $cls_survey->set_break_num($break_numbers_temp,$form_id);
                
            }
        }
    }
}

$smarty->assign('show_questions', 0);
if(!empty($qry_string) && $qry_string[0] != '' && $qry_string[0] != 'NULL' && $qry_string[0] != 'list'){
    $this_question_id = $qry_string[0];
    $this_questions = $cls_survey->get_questions($this_question_id);
    if(!empty($this_questions)){
        $question_categories = explode(",",$this_questions[0]['categories']);
        $this_questions_answers = $cls_survey->get_question_answers($this_question_id);
        $smarty->assign('question_categories',$question_categories);
        $smarty->assign('this_question_id', $this_question_id);
        $smarty->assign('this_question', $this_questions);
        $smarty->assign('this_question_answers', $this_questions_answers);
        $smarty->assign('show_questions', 1);
        if($this_questions[0]['answer_type'] == 6){         //For star rating
            $answer_params = explode('||', $this_questions_answers[0]['answer_text']);
            $smarty->assign('lower_val', $answer_params[0]);
            $smarty->assign('upper_val', $answer_params[1]);
            $smarty->assign('star_count', $answer_params[2]);
        }else if($this_questions[0]['answer_type'] == 10){         //For Likert Matrix
            $child_questions = $cls_survey->get_child_question($this_question_id);
//            echo "<pre>".print_r($child_questions, 1)."</pre>";
            $smarty->assign('sub_questions', $child_questions);
        }
    }
}


if($form_id == NULL)
    $available_questions = $cls_survey->get_questions();
else
    $available_questions = $cls_survey->get_questions_by_formID($form_id);

$smarty->assign('questions', $available_questions);
$categories = $cls_survey->get_categeries();
$smarty->assign('categories',$categories);

$smarty->assign('display_page', ($qry_string[0] == 'list' ? 'list' : 'manage'));
$smarty->assign('message', $msg->show_message());
$smarty->display('extends:layouts/dashboard.tpl|survey/surveys_manage_sub_layout.tpl|survey/manage_questions.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_questions.tpl');
?>