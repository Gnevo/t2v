<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$dona = new dona();

/*$data = $dona->get_all_employee_leave($_REQUEST['year'],$_REQUEST['month']);
$pending_count= 0;
foreach($data as $content){
    if($content["status"] == 0)
        $pending_count++;
}

$total_data_count = count($data);
$obj->count = $total_data_count;
if($total_data_count > 0 && $pending_count > 0){
    $obj->count .= " (". $pending_count.")";
}*/

$leave_list = $dona->get_all_employee_leave();
$unread_leave = $dona->get_unread_leave();
$updated_unread_leave=$dona->get_all_unread_leaves($leave_list,$unread_leave);
$obj = new stdClass();
$obj->count = count($updated_unread_leave);

//header("content-type: text/javascript");
echo json_encode($obj);
?>