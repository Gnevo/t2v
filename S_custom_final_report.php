<?php

require_once('class/setup.php');
require_once('class/survey.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("messages.xml", "month.xml", "button.xml", "notes.xml", "customer.xml", "survey.xml", "survey_button.xml"));
$cls_survey = new survey();
$customer = new customer();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));

$age_from = $_REQUEST['age_from'];
$age_to = $_REQUEST['age_to'];
$gender = $_REQUEST['gender'];
$filter_type = $_REQUEST['selected'];
$filter = $_REQUEST['filter'];
$survey_id = $_REQUEST['survey_id'];


//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
$app_base_path = getcwd().'/';
$survey_base_path = $customer->get_folder_name($_SESSION['company_id']) . '/survey_files/';
$smarty->assign('survey_base_path', $survey_base_path);

//to download file type question files. 
if (isset($_POST['action']) && $_POST['action'] == 'download') {
//    echo 'downloaded'; exit();
    if (trim($_POST['file_name']) != '') {
        $filename = trim($_POST['file_name']);

        //Set the time out
        set_time_limit(0);
        $file_path = $app_base_path . $survey_base_path . $filename;

        if (!file_exists($file_path)) {
            echo "<html><body><BR><B>ERROR:</B> File not found.</body></html>";
            exit;
        }


        $size = filesize($file_path);
        $filename = rawurldecode($filename);
        $mime_type = '';
        /* Figure out the MIME type | Check in array */
        $known_mime_types = array(
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html" => "text/html",
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "png" => "image/png",
            "jpeg" => "image/jpg",
            "jpg" => "image/jpg",
            "php" => "text/plain"
        );

        if ($mime_type == '') {
            $file_extension = strtolower(substr(strrchr($file_path, "."), 1));
            if (array_key_exists($file_extension, $known_mime_types)) {
                $mime_type = $known_mime_types[$file_extension];
            } else {
                $mime_type = "application/force-download";
            };
        };

        //turn off output buffering to decrease cpu usage
        @ob_end_clean();

        // required for IE, otherwise Content-Disposition may be ignored
        /* if(ini_get('zlib.output_compression'))
          ini_set('zlib.output_compression', 'Off'); */

        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');

        /* The three lines below basically make the 
          download non-cacheable */
        header("Cache-control: private");
        header('Pragma: private');
        header("Expires: Tue, 17 Dec 2013 05:00:00 GMT");

        // multipart-download and download resuming support
        if (isset($_SERVER['HTTP_RANGE'])) {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
            list($range) = explode(",", $range, 2);
            list($range, $range_end) = explode("-", $range);
            $range = intval($range);
            if (!$range_end) {
                $range_end = $size - 1;
            } else {
                $range_end = intval($range_end);
            }

            $new_length = $range_end - $range + 1;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
            header("Content-Range: bytes $range-$range_end/$size");
        } else {
            $new_length = $size;
            header("Content-Length: " . $size);
        }


        $chunksize = 1 * (1024 * 1024); //you may want to change this
        $bytes_send = 0;
        if ($file_path = fopen($file_path, 'r')) {
            if (isset($_SERVER['HTTP_RANGE']))
                fseek($file_path, $range);

            while (!feof($file_path) && (!connection_aborted()) && ($bytes_send < $new_length)) {
                $buffer = fread($file_path, $chunksize);
                print($buffer); //echo($buffer); // can also possible
                flush();
                $bytes_send += strlen($buffer);
            }
            fclose($file_path);
        }
        else
            //If no permissiion
            die('Error - can not open file.');
        
        die();
    }
    else {
        echo "<html><body><BR><B>ERROR:</B> File not found.</body></html>";
        exit;
    }
}

$survey_details = $cls_survey->get_surveys_search_list($survey_id, '', '', '', 1);
$smarty->assign('filter_type', $filter_type);
$users = array();
$members = array();
if ($filter_type == 1 && ($filter != "" || $filter != null)) {
    $groups = explode(',', $filter);
} else {
    $groups = $cls_survey->get_groups_survey($survey_id);
    $invite_id = $cls_survey->get_invitation_ids($survey_id);
    $employees_survey = $cls_survey->get_invitations_members($invite_id[0]['invitation_id'], 1);
    for ($j = 0; $j < count($employees_survey); $j++) {
        if (in_array($employees_survey[$j]['username'], $users)) {
            continue;
        } else {
            $users[] = $employees_survey[$j]['username'];
            $members[] = $employees_survey[$j];
        }
    }
}
if ($filter_type == 2) {
    $questions = explode(",", $filter);
    $answers = explode("-", $_REQUEST['ans']);
    $smarty->assign('questions', $questions);
    $smarty->assign('answers', $answers);
}
//echo "<pre>".print_r($questions, 1)."</pre>";

//echo "groups<pre>". print_r($groups, 1)."</pre>";
for ($i = 0; $i < count($groups); $i++) {
    if ($gender != 3 && $age_from != '') {
        $members_group = $cls_survey->get_survey_members($groups[$i]['group_id'], $gender, $age_from, $age_to);
    } elseif ($gender != 3 && $age_from == '') {
        $members_group = $cls_survey->get_survey_members($groups[$i]['group_id'], $gender);
    } elseif ($gender == 3 && $age_from != '') {
        $members_group = $cls_survey->get_survey_members($groups[$i]['group_id'], '', $age_from, $age_to);
    } else {
        $members_group = $cls_survey->get_survey_members($groups[$i]['group_id']);
    }

    for ($j = 0; $j < count($members_group); $j++) {
        if (in_array($members_group[$j]['username'], $users)) {
            continue;
        } else {
            $users[] = $members_group[$j]['username'];
            $members[] = $members_group[$j];
        }
    }
}

$smarty->assign('total_users', count($users));
$totoal_pages_survey = $cls_survey->get_total_num_pages($survey_id);
$not_complete = 0;
$complete = 0;
for ($i = 0; $i < count($users); $i++) {
    $status_survey = $cls_survey->check_survey_completed_by_user($users[$i], $survey_id, $totoal_pages_survey);

    if ($status_survey == 0) {
        $not_complete++;
    } elseif ($status_survey == 1) {
        $complete++;
    } else {
        continue;
    }
}

//echo "users<pre>".print_r($users, 1)."</pre>";
$quests_report = $cls_survey->questions_survey_and_report($survey_id, $users, FALSE);
$val_cof = 0;

//echo "<pre>".print_r($quests_report, 1)."</pre>";
// calculate mean, standerd_deviation, confidence_low_limit, confidence_high_limit for each questions
if(!empty($quests_report)){
    foreach ($quests_report as $i => $quest_report) {
        if(in_array($quest_report['answer_type'], array(1,2,3,6,7))){
            $k = 1;
            $val = 0;
            $l = 0;
            
            if(!empty($quest_report['answers'])){
                foreach ($quest_report['answers'] as $j => $quests_report_answer) {

                    if (isset($quests_report[$i]['answers'][$j]['count'])) {
                        $single_val = $quests_report[$i]['answers'][$j]['count'] * $k;
                        $k++;
                        $val = $val + $single_val;
                        $l++;
                    } else
                        $k++;
                }
            }
            if ($k != 1) {
                if ($l != 0) {
                    $quests_report[$i]['mean'] = round(($val / $l), 2);
                    $val_cof = $l;
                } else {
                    $quests_report[$i]['mean'] = 0;
                    $val_cof = 0;
                }
            } else
                $quests_report[$i]['mean'] = '';
            
            $k = 1;
            $l = 0;
            $val = 0;
            if(!empty($quest_report['answers'])){
                foreach ($quest_report['answers'] as $j => $quests_report_answer) {

                    if (isset($quests_report[$i]['answers'][$j]['count'])) {
                        if ($quests_report[$i]['mean'] != '')
                            $single_val = $quests_report[$i]['answers'][$j]['count'] * ($k - $quests_report[$i]['mean']) * ($k - $quests_report[$i]['mean']);
                        else
                            $single_val = 0;
                        $k++;
                        $val = $val + $single_val;
                        $l++;
                    } else 
                        $k++;
                }
            }
            if ($l > 1)
                $sample_verience = $val / ($l - 1);
            else
                $sample_verience = 0;
            $standerd_deviation = sqrt($sample_verience);
            if ($k != 1) {
                if (sqrt($val_cof) != 0) {
                    $quests_report[$i]['standerd_deviation'] = round($standerd_deviation, 2);
                    $quests_report[$i]['confidence_low_limit'] = round($quests_report[$i]['mean'] - ($standerd_deviation / sqrt($val_cof)), 2);
                    $quests_report[$i]['confidence_high_limit'] = round($quests_report[$i]['mean'] + ($standerd_deviation / sqrt($val_cof)), 2);
                } else {
                    $quests_report[$i]['standerd_deviation'] = round($standerd_deviation, 2);
                    $quests_report[$i]['confidence_low_limit'] = round($quests_report[$i]['mean'], 2);
                    $quests_report[$i]['confidence_high_limit'] = round($quests_report[$i]['mean'], 2);
                }
            } else {
                $quests_report[$i]['standerd_deviation'] = '';
                $quests_report[$i]['confidence_low_limit'] = '';
                $quests_report[$i]['confidence_high_limit'] = '';
            }
        }
        /*else if($quest_report['answer_type'] == 10){
            if(!empty($quest_report['sub_questions'])){
                foreach ($quest_report['sub_questions'] as $m => $subquestion) {
                    $k = 1;
                    $val = 0;
                    $l = 0;

                    if(!empty($subquestion['answers'])){
                        foreach ($subquestion['answers'] as $j => $quests_report_answer) {

                            if (isset($quests_report_answer['count'])) {
                                $single_val = $quests_report_answer['count'] * $k;
                                $k++;
                                $val = $val + $single_val;
                                $l++;
                            } else
                                $k++;
                        }
                    }
                    if ($k != 1) {
                        if ($l != 0) {
                            $quests_report[$i]['sub_questions'][$m]['mean'] = round(($val / $l), 2);
                            $val_cof = $l;
                        } else {
                            $quests_report[$i]['sub_questions'][$m]['mean'] = 0;
                            $val_cof = 0;
                        }
                    } else
                        $quests_report[$i]['sub_questions'][$m]['mean'] = '';

                    $k = 1;
                    $l = 0;
                    $val = 0;
                    if(!empty($subquestion['answers'])){
                        foreach ($subquestion['answers'] as $j => $quests_report_answer) {

                            if (isset($quests_report_answer['count'])) {
                                if ($quests_report[$i]['sub_questions'][$m]['mean'] != '')
                                    $single_val = $quests_report[$i]['sub_questions'][$m]['answers'][$j]['count'] * ($k - $quests_report[$i]['sub_questions'][$m]['mean']) * ($k - $quests_report[$i]['sub_questions'][$m]['mean']);
                                else
                                    $single_val = 0;
                                $k++;
                                $val = $val + $single_val;
                                $l++;
                            } else 
                                $k++;
                        }
                    }
                    if ($l > 1)
                        $sample_verience = $val / ($l - 1);
                    else
                        $sample_verience = 0;
                    $standerd_deviation = sqrt($sample_verience);
                    if ($k != 1) {
                        if (sqrt($val_cof) != 0) {
                            $quests_report[$i]['sub_questions'][$m]['standerd_deviation'] = round($standerd_deviation, 2);
                            $quests_report[$i]['sub_questions'][$m]['confidence_low_limit'] = round($quests_report[$i]['sub_questions'][$m]['mean'] - ($standerd_deviation / sqrt($val_cof)), 2);
                            $quests_report[$i]['sub_questions'][$m]['confidence_high_limit'] = round($quests_report[$i]['sub_questions'][$m]['mean'] + ($standerd_deviation / sqrt($val_cof)), 2);
                        } else {
                            $quests_report[$i]['sub_questions'][$m]['standerd_deviation'] = round($standerd_deviation, 2);
                            $quests_report[$i]['sub_questions'][$m]['confidence_low_limit'] = round($quests_report[$i]['sub_questions'][$m]['mean'], 2);
                            $quests_report[$i]['sub_questions'][$m]['confidence_high_limit'] = round($quests_report[$i]['sub_questions'][$m]['mean'], 2);
                        }
                    } else {
                        $quests_report[$i]['sub_questions'][$m]['standerd_deviation'] = '';
                        $quests_report[$i]['sub_questions'][$m]['confidence_low_limit'] = '';
                        $quests_report[$i]['sub_questions'][$m]['confidence_high_limit'] = '';
                    }
                }
            }
        }*/
        
        //remove not existed files
        else if ($quest_report['answer_type'] == 9){
            if(!empty($quest_report['user_responds'])){
                foreach($quest_report['user_responds'] as $z => $file_name){
                    if(trim($file_name) == '' || !file_exists($app_base_path.$survey_base_path.$file_name))
                            unset($quests_report[$i]['user_responds'][$z]);
//                    echo $app_base_path.$survey_base_path.$file_name.'<br/>';
                }
                $quests_report[$i]['user_responds'] = array_values($quests_report[$i]['user_responds']);
                $quests_report[$i]['ans_count'] = count($quests_report[$i]['user_responds']);
            }
            
        }
    }
}
//echo "Final<pre>". print_r($quests_report, 1)."</pre>";
//echo "quests_report<pre>".print_r($quests_report, 1)."</pre>";
$smarty->assign('question_reports', $quests_report);
$smarty->assign('completed', $complete);
$smarty->assign('not_completed', $not_complete);
$smarty->assign('not_started', count($users) - ($complete + $not_complete));
/*
//    for($i=0;$i<count())
//}else{
//    if($filter_type == 2){
//        $questions = explode(",", $filter);
//        $answers = explode("-", $_REQUEST['ans']);
//        $users = array();
//        for($i=0;$i<count($questions);$i++){
////            $ans_particular_quest = explode(",", $answers[$i]);
//            echo "<br>count i".$i;
//            if($gender != 3 && $age_from != ''){
//                $members_answered_question = $cls_survey->get_survey_members_answered_question($survey_id,$questions[$i],$gender,$age_from,$age_to);
//            }elseif($gender != 3 && $age_from == ''){
//                $members_answered_question = $cls_survey->get_survey_members_answered_question($survey_id,$questions[$i],$gender,'','');
//            }elseif($gender == 3 && $age_from != ''){
//                $members_answered_question = $cls_survey->get_survey_members_answered_question($survey_id,$questions[$i],'',$age_from,$age_to);
//            }else{
//                $members_answered_question = $cls_survey->get_survey_members_answered_question($survey_id,$questions[$i],'','','');
//            }
////                $members_answered_question = $cls_survey->get_survey_members_answered_question($questions[$i],$gender,$age_from,$age_to);
//            if($members_answered_question){
//                for($j=0;$j<count($members_answered_question);$j++){
//                    if(in_array($members_answered_question[$j]['username'], $users)){
//                        continue;
//                    }else{
//                        $users[] = $members_answered_question[$j]['username'];
//                        $members[] = $members_group[$j];
//                    }
//                }
//            }
//            
//        }
//        $quests_report = $cls_survey->custom_survey_report_questions($survey_id,$users,$questions,$answers);
//        
////        $quests_report = $cls_survey->custome_question_report();
//        
////        $members = $cls_survey->get_survey_members_answered_question($groups[$i]['group_id'],$gender,$age_from,$age_to);
////        $users = array();
////        $members = array();
////        $quest_ans = $_REQUEST['quest_ans'];
////        $ans = $_REQUEST['ans'];
////        $users = $cls_survey->get_members_answered_quest($quest_ans,$ans,$survey_id);
////        $smarty->assign('total_users',  count($users));
////        $totoal_pages_survey = $cls_survey->get_total_num_pages($survey_id);
////        $not_complete = 0;
////        $complete = 0;
////        for($i=0;$i<count($users);$i++){
////            
////            $status_survey = $cls_survey->check_survey_completed_by_user($users[$i],$survey_id,$totoal_pages_survey);
////            if($status_survey == 0){
////                $not_complete++;
////            }elseif($status_survey == 1) {
////                $complete++;
////            }else{
////                continue;
////            }
////        }
////        $quests_report = $cls_survey->questions_survey_and_report($survey_id,$users);
//////        echo "<pre>". print_r($quests_report, 1)."</pre>";
////        $smarty->assign('question_reports',$quests_report);
////        $smarty->assign('completed',$complete);
////        $smarty->assign('not_completed',$not_complete);
////        $smarty->assign('not_started',count($users)-($complete+$not_complete));
//      
//    }
//}
 */
$smarty->assign('survey_detail', $survey_details);
$smarty->display('extends:layouts/dashboard.tpl|survey/custom_final_report.tpl');
?>