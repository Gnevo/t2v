<?php
// error_reporting(E_ALL);
//                         error_reporting(E_WARNING);
//                         ini_set('error_reporting', E_ALL);
//                         ini_set("display_errors", 1);
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml", "button.xml", "support.xml", "customer.xml"));
$support = new support();
$user = new user();
$message = new message();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('loggedin_user', $_SESSION['user_id']);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

$params = explode('&', $_SERVER['QUERY_STRING']);
if(count($params) > 2){
    $smarty->assign('page_from', 'normal');
}else{
    $smarty->assign('page_from', 'mail');
}


$ticket_id = trim($params[0]);
$company_id = trim($params[1]);
$this_status = (trim($params[2]) != '') ? trim($params[2]) : 'NULL';
$this_priority = (trim($params[3]) != '') ? trim($params[3]) : 'NULL';
$this_category_type = trim($params[4]) != '';
$this_admin_company = (trim($params[5]) != '') ? trim($params[5]) : 'NULL';
$this_hidden = ((int)$params[6] > 0) ? 1 : 0;
$this_key = ($params[7] != '') ? trim($params[7]) : 'NULL';
$this_user_page = trim($params[8]);
$array_user_page = explode("-", $this_user_page);
$this_user = ($array_user_page[0] != '') ? $array_user_page[0] : 'NULL';
$this_page = ((int)$array_user_page[1] > 0) ? $array_user_page[1] : 1;


$_POST['priority'] != NULL ? $priority = $_POST['priority'] : $priority = 2;

/////////////  ajax starts   ///////////////////

if($_REQUEST['action'] == 'save_remainder' && $_REQUEST['subject'] != ''  && $_REQUEST['date'] != ''){

    $responce            = new stdClass();
    $remainder_subject   = $_REQUEST['subject'];
    $remainder_date      = $_REQUEST['date'];
    $remainder_user_id   = $_SESSION['user_id'];
    $remainder_ticket_id = $_REQUEST['ticket_id'];
    $data  = $support->check_single_remainder_in_a_date($remainder_user_id, $remainder_ticket_id, $remainder_date);
    if(empty($data)){
        $support->save_remainder_ticket($remainder_user_id, $remainder_ticket_id, $remainder_date, $remainder_subject);
        $responce->result_flag = TRUE;
        $message->set_message('success', "remainder_saved_sucessfully");
    }
    else{
        $responce->result_flag = FALSE;
        $message->set_message('fail', "only_single_remainder_for_a_day");
        $responce->error_message =  $message->show_message();
    }
    echo json_encode($responce);
    exit();
}

if($_REQUEST['action'] == 'delete_single_remainder'){

    $responce = new stdClass();
    $id       = $_REQUEST['id'];
    $delete   = $support->delete_single_remainder($id);
    if($delete){
        $responce->result_flag = TRUE;
        $message->set_message_exact('success', "remainder_deleted_sucessfully");
    }
    else{
        $responce->result_flag = FALSE;
        $message->set_message('fail', "something_went_wrong");
        $responce->error_message =  $message->show_message();
    }
    echo json_encode($responce);
    exit();
}

////////////    ajax ends    ///////////////
$user_all_remainders = $support->get_user_all_remainders($ticket_id);
$smarty->assign('user_all_remainders',$user_all_remainders);


if ($_POST['answer'] != '') {
    // echo "<pre>".print_r($_POST, 1)."<pre>"; exit();
    $company_id                  = $_REQUEST['company_id'];
    $this_status                 = $_REQUEST['selected_status'];
    $this_priority               = $_REQUEST['selected_priority'];
    $this_category_type          = $_REQUEST['selected_category_type'];
    $this_admin_company          = $_REQUEST['selected_admin_company'];
    $this_hidden                 = $_REQUEST['selected_hidden'];
    $this_key                    = $_REQUEST['selected_key'];
    $this_user                   = $_REQUEST['selected_user'];
    $this_page                   = $_REQUEST['selected_page'];
    $support->id                 = $ticket_id;
    $support->answer             = trim($_POST['answer']);
    $support->login_user         = $_SESSION['user_id'];
    $support->answer_status      = $_POST['status'];
    $support->category_type      = $_POST['category_type'];
    $support->answer_category_id = $_POST['sprt_category'];
    $support->answer_priority    =  $priority;
    $support->answer_ticket_type = $_POST['ticket_type'];
    $support->answer_attachment  = $_FILES['attachment'] ? $_FILES['attachment'] : NULL;
    if (is_array($_POST['admin'])) {
        $support->answer_admin_user = implode(',', $_POST['admin']);
    } else {
        $support->answer_admin_user = $_POST['admin'];
    }
    $support->answer_hidden = ($_POST['is_hidden'] != '' ? $_POST['is_hidden'] : 0);
    if ((int) $ticket_id > 0) {
        $insert_status = $support->insert_ticket_answer();
        if ($insert_status) {
            $message->set_message('success', 'ticket_answer_success');
            header("Location: " . $smarty->url . "supporttickets/detail/" . $ticket_id . "/" . $company_id . "/" . $this_status . "/" . $this_priority . "/" . $this_category_type . "/" . $this_admin_company . "/" . $this_hidden . "/" . $this_key. "/" . $this_user . "-" . $this_page . "/");
            exit;
        } else {
            $message->set_message('fail', 'ticket_answer_fail');
            header("Location: " . $smarty->url . "supporttickets/detail/" . $ticket_id . "/" . $company_id . "/" . $this_status . "/" . $this_priority . "/" . $this_category_type . "/" . $this_admin_company . "/" . $this_hidden . "/" . $this_key. "/" . $this_user . "-" . $this_page . "/");
            exit;
        }
    }
}

$array_keys = array_keys($support_status);
$last_key = end($array_keys);
//$closed_status = ($last_key);
$closed_status = 5;
// echo $closed_status;
// echo "<pre>".print_r($array_keys, 1)."<pre>"; exit();
$smarty->assign('company_id', $company_id);
$smarty->assign('support_closed_status', $closed_status);
$smarty->assign('support_status', $support_status);
$smarty->assign('support_priority', $support_priority);
$smarty->assign('support_ticket_type', $support_ticket_type);
$smarty->assign('cirrus_admins', $cirrus_admins);
$smarty->assign('support_admin_users', $support->get_support_admin_users_options($company_id));
$smarty->assign('selected_status', $this_status);
$smarty->assign('selected_priority', $this_priority);
$smarty->assign('selected_category_type', $this_category_type);
$smarty->assign('selected_admin_company', $this_admin_company);
$smarty->assign('selected_hidden', $this_hidden);
$smarty->assign('selected_key', $this_key);
$smarty->assign('selected_user', $this_user);
$smarty->assign('selected_page', $this_page);


$smarty->assign('message', $message->show_message());
$ticket_data = $support->get_ticket_details($ticket_id);
$smarty->assign("ticket", $ticket_data);
$smarty->assign('selected_category_type', $ticket_data['category_type']);
$ticket_last_data = $support->get_ticket_last_details($ticket_id);
$smarty->assign("ticket_last", $ticket_last_data);
$smarty->assign("ticket_id", $ticket_id);

// echo "<pre>".print_r($ticket_last_data,1)."</pre>";  exit();
// echo "<pre>".print_r($closed_status,1)."</pre>"; exit();
$ticket_answers = $support->get_ticket_answers($ticket_id, FALSE);
// echo "<pre>".print_r($ticket_answers, 1)."</pre>"; exit();
$smarty->assign("answers", $ticket_answers);

$smarty->display('extends:layouts/dashboard.tpl|support_ticket_detail.tpl');