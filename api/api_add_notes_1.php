<?php

/*
 * Author : Shaju
 * description: to get all the accessible employees
 * 
 */
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/notes.php');
$smarty = new smartySetup(array("user.xml"), FALSE);

$obj = array();
$i = 0;
$flag = 1;
//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
if($_REQUEST['role'] == 1 || $_REQUEST['role'] == 6){
    
    $customer = new customer();
    $customer->customer = $_REQUEST['customer'];
    $customer->employee = $_REQUEST['user'];
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
    $notes->login_user  = $_REQUEST['user'];

    
    if($_REQUEST['role'] == '1' || $_REQUEST['role'] == '6')
        $notes->visibility = 4;
    else
        $notes->visibility = trim($_REQUEST['type']);

    $notes->status=$_REQUEST['type'];
    if($_REQUEST['role'] != '1' &&  $_REQUEST['role'] != '6')
        $notes->status=($_REQUEST['type'] == 1 ? 0 : 1);

    if ($notes->insert_note())
        $obj[$i]->transaction = 'success';
    else
        $obj[$i]->transaction = 'fail';
}else{
    $obj[$i]->transaction = 'fail';
}

//header("content-type: text/javascript");
echo json_encode($obj);
?>