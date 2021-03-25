<?php
require_once('class/setup.php');
require_once('class/survey.php');
require_once ('plugins/message.class.php');
$survey = new survey();
$smarty = new smartySetup(array("messages.xml"), FALSE);
$old_surveys = $_POST['old_surveys'];
$new_survey = $_POST['new_survey'];
$check = $survey->check_survey_question_repeat($old_surveys,$new_survey);
echo $check;
?>