<?php
require_once('class/setup.php');
require_once('class/recruitment.php');
$recruitment = new recruitment();
$smarty = new smartySetup(array("recruitment.xml","recruitment_button.xml"), FALSE);
$sort_highlight = $_REQUEST['status_type'];
$applicants = $recruitment->display_sorted_candidates($sort_highlight);
$smarty->assign('applicants',$applicants);
$smarty->display('ajax_recruitment_sorted_list.tpl');
?>