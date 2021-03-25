<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml","survey_button.xml",'survey.xml'));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>9));
$surveys = $cls_survey->get_surveys_list();
$expire = 1;
$valid = 1;
$from_date = '';
$to_date = '';
if(isset($_POST['status'])){
    $survey_id = $_POST['search_id'];
    $from_date = $_POST['date_from'];
    $to_date = $_POST['date_to'];
    $status = $_POST['status'];
    if($status == '1'){
        $expire = 1;
        $valid = 0;
    }else if($status == '2'){
        $expire = 0;
        $valid = 1;
    }else if($status == '3'){
        $expire = 1;
        $valid = 1;
    }
    if($survey_id == "" && $from_date == "" && $to_date == ""){
        $surveys = $cls_survey->get_surveys_list($status);
    }elseif($survey_id != "" && $from_date == ""){
        $surveys = $cls_survey->get_surveys_search_list($survey_id,'','',$status,1);
        if(strtotime($surveys[0]['expire_date']) >= strtotime(date("Y-m-d"))){
            $expire = 0;
            $valid = 1;
        }else{
            $expire = 1;
            $valid = 0;
        }
    }elseif($survey_id == "" && $from_date != ""){
        $surveys = $cls_survey->get_surveys_search_list('',$from_date,$to_date,$status,2);
    }
//    $surveys = $cls_survey->get_surveys_search_list();
}
//echo utf8_encode(utf8_decode($surveys[0]['survey_title']));
//echo "<pre>".print_r($surveys, 1)."</pre>"; exit();
$smarty->assign('surveys',$surveys);
$smarty->assign('expire',$expire);
$smarty->assign('date_from',$from_date);
$smarty->assign('date_to',$to_date);
$smarty->assign('valid',$valid);
$smarty->display('extends:layouts/dashboard.tpl|survey/surveys_list.tpl');
?>