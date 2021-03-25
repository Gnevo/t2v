<?php

/*
 * created by: shaju
 * purpose : sending sms for report sign in
 * and open the template in the editor.
 */

session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/sms.php');

$obj = new stdClass();
$smarty = new smartySetup(array("export.xml"), FALSE);
$obj_sms = new sms('hai');
$obj_sms->addRecipient($_REQUEST['mobile']);
$obj_sms->message = $smarty->translate['sms_export_message'];
if($obj_sms->send_export($_REQUEST['user']))
    $obj->success = true;
else
    $obj->success = false;
//header("content-type: text/javascript");
echo json_encode($obj);
?>