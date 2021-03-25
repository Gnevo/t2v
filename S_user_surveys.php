<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","survey.xml","survey_button.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$smarty->assign('surveys',$data = $cls_survey->get_surveys_user());
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->display('extends:layouts/dashboard.tpl|survey/user_survey.tpl');
?>