<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$cls_survey = new survey();
$survey_id = $_REQUEST['survey_id'];
echo "<script>alert('".$survey_id."');</script>";
$survey_questions = $cls_survey->get_questions_survey($survey_id);
echo "<pre>". print_r($survey_questions, 1)."</pre>";
$smarty->display('survey/ajax_compare_questions.tpl');
?>