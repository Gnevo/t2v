<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$cls_survey = new survey();
$question_id = $_POST['question_id'];
$answers = $cls_survey->get_answers_for_questions_survey($question_id);
$smarty->assign('answers',$answers);
$smarty->display('ajax_answer_question_survey.tpl');
?>