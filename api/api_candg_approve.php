<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);


require_once('class/dona.php');
$dona = new dona();
$obj = new stdClass();

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