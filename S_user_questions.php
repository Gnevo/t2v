<?php

require_once('class/setup.php');
require_once('class/survey.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "survey.xml", "survey_button.xml"));
$cls_survey = new survey();
$customer = new customer();
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$query_string = explode("&", $_SERVER['QUERY_STRING']);
//echo "<pre>".print_r($_POST, 1)."</pre>";
//echo "<pre>".print_r($_FILES, 1)."</pre>";
if (isset($_POST['quest'])) {
//    echo "<pre>". print_r($_POST['quest'], 1)."</pre>";
//    echo "<pre>". print_r($_POST['answer'], 1)."</pre>";
//    echo "<pre>". print_r($_POST['textarea'], 1)."</pre>";
////    echo "hai";
//    echo "<pre>". print_r($_FILES, 1)."</pre>";
    $max_size = 2000 * 1024;
    $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/survey_files/';
    if(!empty($_FILES['attachments']['name'])){
        foreach ($_FILES['attachments']['name'] as $i => $attachment) {
            $temp_path = $_FILES['attachments']['tmp_name'][$i];
            if ($temp_path != "") {
                $file_name = $_FILES['attachments']['name'][$i];
                $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                $str = str_replace(" ", "_", $file_name);
                
                //reseting filename as answer
                if(!empty($_POST['quest'])){
                    foreach($_POST['quest'] as $z => $pquest){
                        if($pquest == $i){
                            $_POST['answer'][$z] = $str;
                            break;
                        }
                    }
                }
                
                if ($size <= $max_size) {


                    $extension = $customer->get_file_extension($str);
                    if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                        //$upload_path = "document_decision/";
                        $file_path = $upload_path . $str;
//                        echo '<br/>'.$_FILES['attachments']['tmp_name'][$i];
//                        exit();

                        if (file_exists($file_path)) {



                            $num = 1;
                            $x = 0;
                            $str1 = explode('.', $str);
                            $str = $str1[0] . "_" . $num . "." . $str1[1];
                            $file_path = $upload_path . $str;
                            while ($x == 0) {
                                if (file_exists($file_path)) {
                                    $num++;
                                    $str1 = explode('.', $str);
                                    $str1[0] = substr($str1[0], 0, -2);
                                    $str = $str1[0] . "_" . $num . "." . $str1[1];
                                    $file_path = $upload_path . $str;
                                } else {
                                    $x++;
                                }
                            }
                            move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                        } else {
    //                        echo $file_path;
                            move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                        }
                    } else {
                        $message = 'file_selected_supported_extension';
                        $type = "fail";
                        $error = 1;
                    }
                } else {
                    $message = 'exceeds_the_limit_file_size';
                    $type = "fail";
                    $error = 1;
                }
            }
        }
    }
    $cls_survey->begin_transaction();
    $dat = $cls_survey->add_user_results($query_string[0], $_POST['page_num'], $_POST['form_id']);
    if ($dat) {
        if ($cls_survey->add_user_results_data($dat, $_POST['quest'], $_POST['answer'], $_POST['textarea'])) {
            $cls_survey->commit_transaction();
        }
    }
}
$page = $cls_survey->check_is_survey_started($query_string[0], $_SESSION['user_id']);

//echo $page['survey_max']+1;
if ($page) {
    $user_questions = $cls_survey->get_user_questions($query_string[0], $page['survey_max'] + 1);
    $count = $cls_survey->get_user_questions($query_string[0], $page['survey_max'] + 1, 'get_count');
    $percentage = intval(($page['survey_max'] / $count) * 100);
    $smarty->assign('percentage_complete', $percentage);
    if ($user_questions == 'page_end') {
        $smarty->assign('no_page', 1);
        $message = 'survey_complete';
        $type = "success";
        $messages->set_message($type, $message);
    } else {
        $smarty->assign('questions_forms', $user_questions);
        $smarty->assign('page_num', $page['survey_max'] + 1);
    }
    $smarty->assign('counts_page', $count);
} else {
    $smarty->assign('percentage_complete', 0);
    $user_questions = $cls_survey->get_user_questions($query_string[0], 1);
    $count = $cls_survey->get_user_questions($query_string[0], 1, 'get_count');
    if ($user_questions == 'page_end') {
        $smarty->assign('no_page', 1);
        $message = 'survey_complete';
        $type = "success";
        $messages->set_message($type, $message);
    } else {
        $smarty->assign('questions_forms', $user_questions);
//        echo "<pre>".print_r($user_questions, 1)."</pre>"; exit();
        $smarty->assign('page_num', $page['survey_max'] + 1);
    }
    $smarty->assign('counts_page', $count);
}
$smarty->assign('survey_details', $cls_survey->get_surveys_search_list($query_string[0], '', '', '', 1));
$smarty->assign('message', $messages->show_message());
//echo "<pre>". print_r($x, 1)."</pre>";
$smarty->assign('form_id', isset($user_questions['form_id']) ? $user_questions['form_id'] : NULL);
$smarty->display('extends:layouts/dashboard.tpl|survey/user_questions.tpl');
?>