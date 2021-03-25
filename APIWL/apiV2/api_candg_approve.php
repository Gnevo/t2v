<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/dona.php');
$dona = new dona();
$obj = new stdClass();
$obj->session_status = $session_check;

if ($_REQUEST['action'] == 'slot_approve_candg_new') {
    $slot_id = $_REQUEST['id'];
    if($dona->approve_candg_slot($slot_id,'')){
        $obj->return = TRUE;
    }else{
        $obj->return = FALSE;
    }
}
echo json_encode($obj);
?>