<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
$cls_survey = new survey();
$question_id = $_REQUEST['question_id'];
$survey_report = $cls_survey->get_combined_question_survey($question_id);
$total_count = 0;
for($i=0;$i<count($survey_report);$i++){
    if($i == (count($survey_report)-1)){
        $total_count = $survey_report[$i]['full_count'];
        break;
    }
    $survey_report_temp[] = $survey_report[$i];
}
$smarty->assign('totol_count',$total_count);
$smarty->assign('survey_report',$survey_report_temp);
$smarty->display('extends:layouts/dashboard.tpl|survey/compare_question_final_report.tpl');
?>