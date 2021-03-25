<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/notes.php');
$smarty = new smartySetup(array("user.xml"), FALSE);

$flag = 1;
$obj = new stdClass();
$obj->session_status = $session_check;

if(($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6) && $_REQUEST['customer'] != ''){
    
    $customer = new customer();
    $customer->customer = $_REQUEST['customer'];
    $customer->employee = $_SESSION['user_id']; //$_REQUEST['user'];
    $customer->subject = urldecode(trim($_REQUEST['title']));
    $customer->note_type = 'minnesanteckning';
    $customer->notes = urldecode(trim($_REQUEST['description']));
    //$customer->begin_transaction();
    if($customer->insert_documentation()){
        //$customer->commit_transaction();
         $flag = 1;
    }else{
        //$customer->rollback_transaction();
         $flag = 0;
    }
    
}

if($flag == 1){    
    $notes = new notes();
    
    $notes->customer    = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
    $notes->title       = urldecode(trim($_REQUEST['title']));
    $notes->description = urldecode(trim($_REQUEST['description']));
    $notes->editable    = trim($_REQUEST['editable']);
    $notes->login_user  = $_SESSION['user_id']; //$_REQUEST['user'];
    
    if($_SESSION['user_role'] == '3')
        $notes->visibility = 2;     //set as private note
    elseif($_SESSION['user_role'] == '1' || $_SESSION['user_role'] == '6')
        $notes->visibility = trim($_REQUEST['type']);
    else{
        if($notes->customer != '')
            $notes->visibility = 2;
        else
            $notes->visibility = 1;
    }

    $notes->status=0;
    if($_SESSION['user_role'] != '1' && $_SESSION['user_role'] != '6')
        $notes->status = $notes->visibility == 1 ? 0 : 1;

    if ($notes->insert_note())
        $obj->transaction = TRUE;
    else
        $obj->transaction = FALSE;
}else
    $obj->transaction = FALSE;

$obj->title = $_REQUEST['title'];
echo json_encode($obj);
?>