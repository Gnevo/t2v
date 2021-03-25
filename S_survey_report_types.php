<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$survey_id = $_GET['survey_id'];
$smarty->assign('survey_id',$survey_id);
$smarty->display('extends:layouts/dashboard.tpl|survey/survey_report_types.tpl');
?>