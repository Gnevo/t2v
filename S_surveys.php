<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("survey.xml","survey_button.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$smarty->display('extends:layouts/dashboard.tpl|survey/surveys.tpl');
?>