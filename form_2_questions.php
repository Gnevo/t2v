<?php
//error_reporting(E_ERROR);
//error_reporting(E_WARNING);
//ini_set('error_reporting', E_ERROR);
//ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/customer_forms.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml", "forms.xml", "messages.xml", "button.xml", "month.xml"));
$messages = new message();
$customer_forms = new customer_forms();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('login_user', $_SESSION['user_id']);

if($_POST['action'] == 'save') {
    $question_ids = $_POST['question_ids'];
    $orders = $_POST['orders'];
    $questions = $_POST['questions'];
    $question_update_datas = array();
    $question_insert_datas = array();
    $i = 0;
    foreach ($questions as $question) {
        if($question_ids[$i]) {
            $question_update_datas[] = array(
                'id' => $question_ids[$i],
                'order' => $orders[$i],
                'question' => $questions[$i]
            );
        } else {
            if($questions[$i] != '') {
                $question_insert_datas[] = array(
                    'order' => $orders[$i],
                    'question' => $questions[$i]
                );
            }
        }
        $i++;
    }
    $result = FALSE;
    if(!empty($question_update_datas)) {
        $result = $customer_forms->form_2_question_update($question_update_datas);
    }
    if(!empty($question_insert_datas)) {
        $result = $customer_forms->form_2_question_insert($question_insert_datas);
    }
    if($result) {
        $messages->set_message("success", 'form_2_question_adding_success');
    } else {
        $messages->set_message("fail", 'form_2_question_adding_fail');
    }
}
if($_POST['action'] == 'delete' && $_POST['action_id']) {
    $action_id = $_POST['action_id'];
    if($customer_forms->form_2_question_delete($action_id)) {
        $messages->set_message("success", 'form_2_question_delete_success');
    } else {
        $messages->set_message("fail", 'form_2_question_delete_fail');
    }
}

$form_questions = $customer_forms->get_form_2_questions();
$smarty->assign('form_questions', $form_questions);

$smarty->assign('message', $messages->show_message());
if($_REQUEST['action'] == 'save' || $_REQUEST['action'] == 'delete') {
    $smarty->display('extends:layouts/dashboard.tpl|forms/form_2_questions.tpl');
} else {
    $smarty->display('forms/form_2_questions.tpl');
}
?>