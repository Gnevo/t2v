<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>10));
$survey_id = $_REQUEST['survey_id'];
$survey_detail = $cls_survey->get_surveys_search_list($survey_id,'','','',1);
$survey_versions = $cls_survey->get_survey_versions($survey_id);
$smarty->assign('survey_versions',$survey_versions);
$smarty->assign('survey_detail',$survey_detail);
$smarty->assign('survey_id',$survey_id);
$smarty->display('extends:layouts/dashboard.tpl|survey/compare_survey_report.tpl');
?>