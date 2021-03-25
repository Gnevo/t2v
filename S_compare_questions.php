<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$survey_id = $_REQUEST['survey_id'];
$surveys = $cls_survey->get_surveys();
$survey_questions = $cls_survey->get_questions_survey($survey_id,1);
$smarty->assign('survey_id',$survey_id);
$smarty->assign('surveys',$surveys);
$smarty->assign('survey_questions',$survey_questions);
$smarty->display('extends:layouts/dashboard.tpl|survey/compare_questions.tpl');
?>