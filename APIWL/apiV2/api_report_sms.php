<?php

/*
 * created by: shaju
 * purpose : sending sms for report sign in
 * and open the template in the editor.
 */

require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/sms.php');

$smarty = new smartySetup(array("export.xml"), FALSE);
$obj_sms = new sms('hai');
$obj = new stdClass();
$obj->session_status = $session_check;
$obj_sms->addRecipient($_REQUEST['mobile']);
$obj_sms->message = $smarty->translate['sms_export_message'];
if($obj_sms->send_export($_REQUEST['user']))
    $obj->success = true;
else
    $obj->success = false;
echo json_encode($obj);
?>