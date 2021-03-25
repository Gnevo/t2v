<?php

/**
 * Author: Shamsu
 * for: manage survey foms activities
 */
require_once('class/setup.php');
require_once('class/survey.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "survey.xml", "survey_button.xml", "button.xml"));
$cls_survey = new survey();
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$smarty->assign('survey_tab', 2);

$qry_string = explode('&', $_SERVER['QUERY_STRING']);

$survey_id = NULL;
if (!empty($qry_string) && trim($qry_string[1]) != '' && $qry_string[1] != 'clone') {
    $survey_id = trim($qry_string[1]);
    $selected_survey = $cls_survey->get_surveys($survey_id);
    if (empty($selected_survey))
        $survey_id = NULL;
    $smarty->assign('selected_survey_title', $selected_survey[0]['survey_title']);
}
$smarty->assign('selected_survey', $survey_id);

if (isset($_POST['categery_text']) && $_POST['categery_text'] != "") {
    $cls_survey->add_new_categery($_POST['categery_text']);
}
if (isset($_POST['action']) && !isset($_POST['categery_text'])) {
    $action = trim($_POST['action']);
    switch ($action) {
        case "0":
            $title = trim($_POST['title']);
            $form_discription = trim($_POST['form_discription']);
            $quest_ids = $_POST['quest_ids'];
            $categories = $_POST['categores'];
            $status = $_POST['finalise'];
            $break_numbers = "";
            $break_count = 0;
            $k = 1;
            $questions_selected = array();
            $questions_order = array();
            for ($i = 0; $i < count($quest_ids); $i++) {
                if ($quest_ids[$i] == "null" && $i == 0) {
                    continue;
                }
                if ($quest_ids[$i] == "null") {
                    if ($quest_ids[$i - 1] == "null") {
                        continue;
                    } else {
                        if ($break_numbers == "") {
                            $break_numbers = $break_count;
                        } else {
                            $break_numbers = $break_numbers . "," . $break_count;
                        }
                        $break_count = 0;
                        continue;
                    }
                } else {
                    $questions_selected[] = $quest_ids[$i];
                    $questions_order[] = $k++;
                }
                $break_count++;
            }
            if ($break_numbers == "") {
                $break_numbers = $i;
            } else {
                $break_numbers = $break_numbers . "," . $break_count;
            }

            $form_id = $cls_survey->insert_form($title, $form_discription, $categories, $break_numbers, $status);
            for ($i = 0; $i < count($questions_order); $i++) {
                $cls_survey->insert_form_questions($form_id, $questions_selected[$i], $questions_order[$i]);
            }

            if ($survey_id != NULL && $form_id) { //it creates new survey-form entry in survey_form table
                $order_number = $cls_survey->get_max_forder_order_by_surveyID($survey_id);
                $next_order = $order_number['max_order'] + 1;
                $cls_survey->insert_survey_forms($survey_id, $form_id, $next_order);
            }
            
            $messages->set_message('success', 'survey_form_save_success');
            if ($survey_id == NULL)
                header("location:" . $smarty->url . "manage/forms/" . $form_id . "/");
            else
                header("location:" . $smarty->url . "manage/forms/" . $form_id . "/" . $survey_id . "/");
            exit();
            break;
        case "1":
            $title = trim($_POST['title']);
            $form_discription = trim($_POST['form_discription']);
            $form_id = trim($_POST['form_id']);
            $quest_ids = $_POST['quest_ids'];
            $categories = $_POST['categores'];
            $status = $_POST['finalise'];
            $break_numbers = "";
            $break_count = 0;
            $k = 1;
            $questions_selected = array();
            $questions_order = array();
            for ($i = 0; $i < count($quest_ids); $i++) {
                if ($quest_ids[$i] == "null" && $i == 0) {
                    continue;
                } else {
                    if ($quest_ids[$i] == "null") {
                        if ($quest_ids[$i - 1] == "null") {
                            continue;
                        } else {
                            if ($break_numbers == "") {
                                $break_numbers = $break_count;
                            } else {
                                $break_numbers = $break_numbers . "," . $break_count;
                            }
                            $break_count = 0;
                            continue;
                        }
                    } else {
                        $questions_selected[] = $quest_ids[$i];
                        $questions_order[] = $k++;
                    }
                    $break_count++;
                }
            }
            if ($break_numbers == "") {
                $break_numbers = $i;
            } else {
                $break_numbers = $break_numbers . "," . $break_count;
            }
            
            $cls_survey->delete_form_questions($form_id);
            for ($i = 0; $i < count($questions_order); $i++) {
                $cls_survey->insert_form_questions($form_id, $questions_selected[$i], $questions_order[$i]);
            }
            $cls_survey->update_form($form_id, $title, $form_discription, $categories, $break_numbers, $status);
            $messages->set_message('success', 'survey_form_save_success');
            break;
        case "2":
            $form_id = trim($_POST['form_id']);
            if ($cls_survey->check_form_in_survey($form_id) == 0) {
                if ($cls_survey->delete_form($form_id)) {
                    $messages->set_message('success', 'survey_form_delete_success');
                    header("location:" . $smarty->url . "manage/forms/list/");
                    exit();
                }
                else
                    $messages->set_message('fail', 'survey_form_delete_fail');
            }
            else
                $messages->set_message('fail', 'cannot_delete');
            break;
    }
}


if (!empty($qry_string) && $qry_string[0] != '' && $qry_string[0] != 'NULL' && $qry_string[0] != 'list') {
    $form_id = $qry_string[0];
    $selected_form = $cls_survey->get_forms($form_id);
    $smarty->assign('selected_form', $selected_form[0]);
    if ($qry_string[1] == 'clone')
        $smarty->assign('status', 1);
    else
        $smarty->assign('status', $selected_form[0]['status']);

    $categories_form = explode(",", $selected_form[0]['categories']);
    $smarty->assign('category_forms', $categories_form);

    $form_questions = $cls_survey->get_questions_for_form($form_id);
//        echo "<pre>".print_r($form_questions, 1)."</pre>"; exit();
    $smarty->assign('form_questions', $form_questions);

    $questions = $cls_survey->avoid_questions_selected($form_id);
    $smarty->assign('questions', $questions);

    $categories = $cls_survey->get_categeries();
    $smarty->assign('categories', $categories);
    if ($qry_string[1] != 'clone')
        $smarty->assign('action', '1');
    else {
        $smarty->assign('action', '0');
        $smarty->assign('clone', 'clone');
    }
} else {
    $questions = $cls_survey->get_questions_forms();
    $smarty->assign('questions', $questions);
    $smarty->assign('status', 1);

    $categories = $cls_survey->get_categeries();
    $smarty->assign('categories', $categories);

    $categories_form = array();
    $smarty->assign('category_forms', $categories_form);

    $smarty->assign('action', '0');
}

$smarty->assign('form_id', $form_id);

if ($survey_id == NULL)
    $available_forms = $cls_survey->get_forms();
else
    $available_forms = $cls_survey->get_forms_by_surveyID($survey_id);
//echo "<pre>".print_r($available_forms, 1)."</pre>"; exit();
$smarty->assign('forms', $available_forms);
$questions = $cls_survey->get_questions_forms();
$smarty->assign('questions_list', $questions);
$smarty->assign('display_page', ($qry_string[0] == 'list' ? 'list' : 'manage'));
$smarty->assign('message', $messages->show_message());

$smarty->display('extends:layouts/dashboard.tpl|survey/surveys_manage_sub_layout.tpl|survey/manage_forms.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_forms.tpl');
?>