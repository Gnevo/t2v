<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml","survey_button.xml",'survey.xml'));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$qry_string = explode('&', $_SERVER['QUERY_STRING']);
$survey_id = $qry_string[0]; 
$groups = $cls_survey->get_groups_survey($survey_id);
$surveys = $cls_survey->get_surveys_search_list($survey_id,'','','',1);
//$questions = $cls_survey->get_questions_survey($survey_id,'cust_report');
$questions = $cls_survey->get_questions_survey($survey_id);
$questions_answers = $cls_survey->get_answers_survey($questions);
//echo "questions<pre>".print_r($questions_answers, 1)."</pre>";
//echo "questions_answers<pre>".print_r($questions_answers, 1)."</pre>";
$smarty->assign('groups',$groups);
$smarty->assign('survey',$surveys);
$smarty->assign('questions',$questions_answers);
$smarty->assign('survey_id',$survey_id);
$smarty->display('extends:layouts/dashboard.tpl|survey/custom_report.tpl');
?>