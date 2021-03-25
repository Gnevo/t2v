<?php

/**
 * Author: Shamsu
 * for: manage surveys main activities
 */
require_once('class/setup.php');
require_once('class/survey.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("survey.xml", "survey_button.xml", "messages.xml", "button.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$smarty->assign('survey_tab', 3);
$qry_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('current_date', date('Y-m-d'));
$messages = new message();
if (isset($_POST['action'])) {
    $action = trim($_POST['action']);
    switch ($action) {
        case "0":
            $survey_title = trim($_POST['survey_title']);
            $description = $_POST['survey_discription'];
            $form_ids = $_POST['survey_ids'];
            $survey_id_selected = trim($_POST['survey_id']);
            $created_by = $_SESSION['user_id'];
            $expire_date = $_POST['expire_date'];
            $status = $_POST['finalise'];
            $form_ids_hidden = $_POST['hidden_survey_ids'];
//                        $cls_survey->check_survey_question_repeat($form_ids_hidden);
            if ($cls_survey->check_survey_question_repeat($form_ids_hidden) == 'success') {
                if (isset($qry_string) && $qry_string[1] == 'new_version') {
                    $parent_id = $cls_survey->get_parent_id_survey($survey_id_selected);
                } else {
                    $parent_id = 0;
                }
                $survey_id = $cls_survey->insert_survey($survey_title, $description, $created_by, $expire_date, $status, $parent_id);
                foreach ($form_ids AS $order => $forms) {
                    $cls_survey->insert_survey_forms($survey_id, $forms, $order);
                }
                $messages->set_message('success', 'survey_save_success');
                header("location:" . $smarty->url . "manage/surveys/" . $survey_id . "/");
                exit();
            } else
                $messages->set_message('fail', 'survey_save_failed_repeat_questions');
            break;
        case "1":
            $survey_title = trim($_POST['survey_title']);
            $description = $_POST['survey_discription'];
            $form_ids = $_POST['survey_ids'];
            $survey_id = trim($_POST['survey_id']);
            $created_by = $_SESSION['user_id'];
            $expire_date = $_POST['expire_date'];
            $status = $_POST['finalise'];
            $form_ids_hidden = $_POST['hidden_survey_ids'];
            if ($cls_survey->check_survey_question_repeat($form_ids_hidden) == 'success') {
                $cls_survey->delete_survey_forms($survey_id);
                foreach ($form_ids AS $order => $forms) {
                    $cls_survey->insert_survey_forms($survey_id, $forms, $order + 1);
                }
                $cls_survey->update_survey($survey_id, $survey_title, $description, $created_by, $expire_date, $status);
                $messages->set_message('success', 'survey_save_success');
            } else
                $messages->set_message('fail', 'survey_save_failed_repeat_questions');

            break;
        case "2":
            $survey_id = trim($_POST['survey_id']);
            if ($cls_survey->check_survey_in_use($survey_id) == 0) {
                $cls_survey->delete_survey($survey_id);
                $messages->set_message('success', 'survey_delete_success');
                header("location:" . $smarty->url . "manage/surveys/list/");
                exit();
            } else 
                $messages->set_message('fail', 'survey_delete_fail');
            break;
    }
}

$surveys = $cls_survey->get_surveys_all();
$smarty->assign('surveys', $surveys);
//echo "<pre>".print_r($surveys, 1)."</pre>"; exit();

if (!empty($qry_string) && $qry_string[0] != '' && $qry_string[0] != 'list') {
    $survey_id = $qry_string[0];
    if ($qry_string[1] != '') {
        $selected_survey = $cls_survey->get_surveys($survey_id);
        $smarty->assign('selected_survey', $selected_survey[0]);
        $smarty->assign('status', 1);

        $survey_forms = $cls_survey->get_forms_for_survey($survey_id);
        $smarty->assign('survey_forms', $survey_forms);

        $forms = $cls_survey->avoid_forms_selected($survey_id);
        $smarty->assign('forms', $forms);

        $smarty->assign('action', '0');
        $smarty->assign('version', '1');
    } else {
        $selected_survey = $cls_survey->get_surveys($survey_id);
        $smarty->assign('selected_survey', $selected_survey[0]);
        $smarty->assign('status', $selected_survey[0]['status']);

        $survey_forms = $cls_survey->get_forms_for_survey($survey_id);
        $smarty->assign('survey_forms', $survey_forms);

        $forms = $cls_survey->avoid_forms_selected($survey_id);
        $smarty->assign('forms', $forms);

        $smarty->assign('action', '1');
        $smarty->assign('version', '0');
    }
    $temp_forms = '';
    for ($i = 0; $i < count($survey_forms); $i++) {
        if ($temp_forms == '')
            $temp_forms = $survey_forms[$i]['form_id'];
        else
            $temp_forms = $temp_forms . "," . $survey_forms[$i]['form_id'];
    }
    $smarty->assign('hidden_form_ids', $temp_forms);
} 
else {
    $forms = $cls_survey->get_forms_for_survey_page();
    $smarty->assign('forms', $forms);
    $smarty->assign('action', '0');
    $smarty->assign('status', 1);
}

$smarty->assign('display_page', ($qry_string[0] == 'list' ? 'list' : 'manage'));
$smarty->assign('survey_id', $survey_id);

$forms = $cls_survey->get_forms_for_survey_page();
$smarty->assign('forms_list', $forms);

$smarty->assign('message', $messages->show_message());

//$smarty->display('extends:layouts/dashboard.tpl|survey/manage_survey.tpl');
$smarty->display('extends:layouts/dashboard.tpl|survey/surveys_manage_sub_layout.tpl|survey/manage_survey.tpl');
?>