<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$survey_id = $_REQUEST['survey_id'];
$user = $_REQUEST['user'];
$report = $cls_survey->get_summery_report_user($survey_id,$user); 
$k = 0;
$report_new = array();
for($i=0;$i<count($report);$i++){
    if($i == 0){
        $report_new[$k]['form_id'] =  $report[$i]['form_id'];
        $report_new[$k]['report'][] =  $report[$i];
    }else{
        if($report_new[$k]['form_id'] == $report[$i]['form_id']){
            $report_new[$k]['report'][] =  $report[$i];
        }else{
            $k++;
            $report_new[$k]['form_id'] =  $report[$i]['form_id'];
            $report_new[$k]['report'][] =  $report[$i];
        }
    }
}
//echo "<pre>". print_r($report_new, 1)."</pre>";
$smarty->display('extends:layouts/dashboard.tpl|survey/summery_report_final.tpl');
?>