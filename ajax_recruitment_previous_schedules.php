<?php
require_once('class/setup.php');
require_once('class/recruitment.php');
$recruitment = new recruitment();
$smarty = new smartySetup(array("recruitment.xml","recruitment_button.xml"), FALSE);
$app_id = $_REQUEST['app_id'];
$schedules = $recruitment->get_previous_schedules($app_id);
$smarty->assign('schedules',$schedules);
$smarty->display('ajax_recruitment_previous_schedules.tpl');
?>