<?php

/*
 * Author : Shamsudheen
 * description: tasks related to push notifications
 * 
 */
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/notification.php');
$smarty = new smartySetup(array("user.xml"), FALSE);

$obj = new stdClass();

if(isset($_REQUEST['action']) && trim($_REQUEST['action']) != ''){
    $action = trim($_REQUEST['action']);
    if($action == 'create_token'){
        $obj_notification = new notification();
        $user_id    = trim($_REQUEST['user_id']);
        $token      = trim($_REQUEST['token']);
        $device_id  = trim($_REQUEST['device_id']);
        // $device_details = trim($_REQUEST['device_details']);
        $device_details = $_SERVER['HTTP_USER_AGENT'];

        $have_errors = FALSE;
        $existing_token_details = $obj_notification->get_token_details_by_user_token($token);
        if(!empty($existing_token_details)){
            $have_errors = TRUE;
            // $obj->saved_device = $existing_token_details[0];
            if($existing_token_details[0]['user_id'] != $user_id)
                $obj->error_info = 'TOKEN_ALREADY_REGISTERED_WITH_ANOTHER_USER';
            elseif($existing_token_details[0]['device_id'] != $device_id)
                $obj->error_info = 'TOKEN_ALREADY_REGISTERED_FROM_ANOTHER_DEVICE';
            else
                $obj->error_info = 'TOKEN_ALREADY_REGISTERED';
        }

        if(!$have_errors){
            $flag = $obj_notification->create_user_token($user_id, $token, $device_id, $device_details);
            $obj->response = $flag ? TRUE : FALSE;
            $obj->response_id = $obj->response == TRUE ? $obj_notification->get_id() : FALSE;
            // $obj->error_msg = $obj_notification->query_error_details;
            if(!$obj->response)
                $obj->error_info = 'ERROR_WHILE_PROCESSING_TOKEN_SAVE';
        }
        else {
            $obj->response = FALSE;
            $obj->response_id = FALSE;
        }
    }
    else if($action == 'update_token'){
        $obj_notification = new notification();
        $user_id    = trim($_REQUEST['user_id']);
        $token      = trim($_REQUEST['token']);
        $device_id  = trim($_REQUEST['device_id']);

        $flag = $obj_notification->update_user_by_token_deviceid($user_id, $token, $device_id);
        $obj->response = $flag ? TRUE : FALSE;
    }
    else if($action == 'refresh_token'){
        $obj_notification = new notification();
        $user_id    = trim($_REQUEST['user_id']);
        $new_token  = trim($_REQUEST['new_token']);
        $old_token  = trim($_REQUEST['old_token']);
        $device_id  = trim($_REQUEST['device_id']);

        $have_errors = FALSE;
        if($new_token == ''){
            $have_errors = TRUE;
            $obj->error_info = 'NEW_TOKEN_SHOULD_NOT_BE_EMPTY';
        }
        if(!$have_errors){
            $existing_token_details = $obj_notification->get_token_details_by_user_token($old_token);
            if(!empty($existing_token_details)){
                if($existing_token_details[0]['user_id'] != $user_id){
                    $have_errors = TRUE;
                    $obj->error_info = 'TOKEN_ALREADY_REGISTERED_WITH_ANOTHER_USER';
                }
                elseif($existing_token_details[0]['device_id'] != $device_id){
                    $have_errors = TRUE;
                    $obj->error_info = 'TOKEN_ALREADY_REGISTERED_FROM_ANOTHER_DEVICE';
                }
            } else {
                $have_errors = TRUE;
                $obj->error_info = 'OLD_TOKEN_NOT_EXISTS';
            }
        }

        if(!$have_errors){
            $flag = $obj_notification->refresh_token($user_id, $new_token, $old_token, $device_id);
            $obj->response = $flag ? TRUE : FALSE;
            // $obj->error_msg = $obj_notification->query_error_details;
            if(!$obj->response)
                $obj->error_info = 'ERROR_WHILE_PROCESSING_TOKEN_SAVE';
        }
        else {
            $obj->response = FALSE;
        }
    }
    else if($action == 'delete_token'){
        $obj_notification = new notification();
        $user_id    = trim($_REQUEST['user_id']);
        $token      = trim($_REQUEST['token']);

        $flag = $obj_notification->delete_user_token($user_id, $token);
        $obj->response = $flag ? TRUE : FALSE;
    }
}

echo json_encode($obj);
?>