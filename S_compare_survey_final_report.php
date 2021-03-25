<?php
require_once('class/setup.php');
require_once('class/survey.php');
$smarty = new smartySetup(array("messages.xml", "month.xml", "button.xml", "notes.xml", "customer.xml"));
$cls_survey = new survey();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$age_from = $_REQUEST['age_from'];
$age_to = $_REQUEST['age_to'];
$gender = $_REQUEST['gender'];
$filter = $_REQUEST['filter'];
$survey_id = $_REQUEST['survey_id'];
$survey_details = $cls_survey->get_surveys_search_list($survey_id,'','','',1);
if($filter == "" || $filter == null){
    $forms = $cls_survey->get_forms_by_surveyID($survey_id);
    $groups = $cls_survey->get_groups_survey($survey_id);
}else{
    $surveys = explode(",", $filter);
    for($k=0;$k<count($surveys);$k++){
        echo $surveys[$i]."<br>";
        $forms_temp[] = $cls_survey->get_forms_by_surveyID($surveys[$k]);
        $groups_temp[] = $cls_survey->get_groups_survey($surveys[$k]);
        $groups = $cls_survey->get_groups_survey($surveys[$k]);
        $users = array();
        $members = array();
        for($i=0;$i < count($groups);$i++){
            if($gender != 3 && $age_from != ''){
                $members_group = $cls_survey->get_survey_members($groups[$i]['group_id'],$gender,$age_from,$age_to);
            }elseif($gender != 3 && $age_from == ''){
                $members_group = $cls_survey->get_survey_members($groups[$i]['group_id'],$gender);
            }elseif($gender == 3 && $age_from != ''){
                $members_group = $cls_survey->get_survey_members($groups[$i]['group_id'],'',$age_from,$age_to);
            }else{
                $members_group = $cls_survey->get_survey_members($groups[$i]['group_id']);
            }
            for($j=0;$j<count($members_group);$j++){
                if(in_array($members_group[$j]['username'], $users)){
                    continue;
                }else{
                    $users[] = $members_group[$j]['username'];
                    $members[] = $members_group[$j];
                }
            }
        }
        $users_array[] = $users;
//        $quests_report[] = $cls_survey->questions_survey_and_report($surveys[$k],$users);
        
    }
//    echo "<pre>". print_r($quests_report, 1)."</pre>";
    $smarty->assign('total_users',  $users_array);
    $forms_array = array();
    $forms = array();
    for($i=0;$i<count($forms_temp);$i++){
       for($j=0;$j<count($forms_temp[$i]);$j++){
           if(in_array($forms_temp[$i][$j]['id'], $forms_array)){
               continue;
           }else{
               $forms[] = $forms_temp[$i][$j];
               $forms_array[] = $forms_temp[$i][$j]['id'];
           }
       } 
    }
    
//    $groups = $cls_survey->get_groups_survey($surveys);
    for($i=0;$i<count($forms);$i++){
        $questions = $cls_survey->get_form_questions($forms[$i]['id']);
        $answers = $cls_survey->get_answers_survey($questions,$surveys);
        $forms[$i]['questions'] = $answers;
    }
        for($i=0;$i<count($forms);$i++){
            for($j=0;$j<count($forms[$i]['questions']);$j++){
                for($l=0;$l<count($forms[$i]['questions'][$j]['answers']);$l++){
                    for($k=0;$k<count($surveys);$k++){
                        for($x=0;$x<count($users_array[$k]);$x++){
                            $answer = $cls_survey->get_answer_compare_survey_quest($forms[$i]['id'],$forms[$i]['questions'][$j]['question_id'],$surveys[$k],$forms[$i]['questions'][$j]['answers'][$l]['id'],$forms[$i]['questions'][$j]['answers'][$l]['answer_text'],$users_array[$k][$x]);
                            if($answer == 1){
                                if(isset($forms[$i]['questions'][$j]['answers'][$l]['surveys'][$k]['count'])){
                                    $forms[$i]['questions'][$j]['answers'][$l]['surveys'][$k]['count'] = $forms[$i]['questions'][$j]['answers'][$l]['surveys'][$k]['count'] +1;
                                }else{
                                    $forms[$i]['questions'][$j]['answers'][$l]['surveys'][$k]['count']  = 1;
                                }
                            }else{
                                
                            }
                        }
                    } 
                }
                
                
//                echo "<pre>". print_r($forms[$j]['questions'][$k]['answers'], 1)."</pre>";
//                for($l=0;$l<count($users_array[$i]);$l++){
//                    $result_ids = $cls_survey->get_result_ids_compare_survey($surveys[$i],$forms[$j]['id'],$users_array[$i][$l]);
////                    echo "<pre>". print_r($result_ids, 1)."</pre>";
//                    for($x=0;$x<count($result_ids);$x++){
//                        $answer = $cls_survey->get_answer_compare_survey_quest($result_ids[$x]['result_id'],$forms[$j]['questions'][$k]['question_id']);
////                        echo "<pre>". print_r($answer, 1)."</pre>";
//                    }
//                }
            }
    }
    
     echo "<pre>". print_r($forms, 1)."</pre>";
//     echo "<pre>". print_r($groups, 1)."</pre>";
    
}
$smarty->assign('survey_detail',$survey_details);
$smarty->display('extends:layouts/dashboard.tpl|survey/custom_final_report.tpl');
?>