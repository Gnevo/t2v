<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');

$smarty   = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"), FALSE);
$notes    = new notes();
$customer = new customer();
$message  = new message();

$note_id = trim($_REQUEST['note_id']);
$return_obj = new stdClass();

$return_obj->transaction_flag = TRUE;
$notes_detail = array();

if($_REQUEST['action'] == 'create' || $_REQUEST['action'] == 'update'){
        //    $return_obj->files = $_FILES;
        //    $return_obj->post = $_REQUEST;
    
    if($_REQUEST['title'] && $_REQUEST['description']){
        $notes->customer    = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        $notes->title       = trim($_REQUEST['title']);
        $notes->description = trim($_REQUEST['description']);
        $notes->editable    = trim($_REQUEST['editable']);
        //$notes->note_date = date('Y-m-d H:i:s');
        $notes->login_user  = $_SESSION['user_id'];
        if($_SESSION['user_role'] == '3')
            $notes->visibility = 2;     //set as private note
        else
            $notes->visibility = trim($_REQUEST['visibility']);

        $notes->status = trim($_REQUEST['status']);
        if($_SESSION['user_role'] != '1' &&  $_SESSION['user_role'] != '6')
            $notes->status=($_REQUEST['visibility'] == 1 ? 0 : 1);

        $notes->attachment  = isset($_FILES['attachment']) ? $_FILES['attachment'] : array();


        $update_flag = FALSE;
        //update note
        if($note_id != "" && $_SESSION['user_role'] == 1){
            $notes_detail = $notes->get_note_detail($note_id);
            $notes->status = $notes_detail[0]['status'];
            if((int) $note_id > 0 && !empty($notes_detail)){
                $update_flag = TRUE;
                if ($notes->update_note($note_id, trim($notes_detail[0]['attachment'])))
                    $message->set_message('success', 'note_updated_success');
                else{
                    $message->set_message('fail', 'note_updated_fail');
                    $return_obj->transaction_flag = FALSE;
                }
            }
        }

        //insert note
        if(!$update_flag){
            if ($notes->insert_note())
                $message->set_message('success', 'note_adding_success');
            else{
                $message->set_message('fail', 'note_adding_fail');
                $return_obj->transaction_flag = FALSE;
    //                echo "<pre>".print_r($notes, 1)."</pre>";
            }
        }
        if($note_id != "")
            $return_obj->message = $message->show_message(); 
    }
    
    if($note_id != "" && $return_obj->transaction_flag){
        $notes_detail = $notes->get_note_detail($note_id);  //by default it marked as read
        $return_obj->cust_note = $notes_detail[0]['cust_name'];
        $notes->set_as_read_notes(array(array('id' => $note_id)));
        $customer_name = '';
        if($notes_detail[0]['cust_name'] != ''){
            $customer_name = $customer->getCustomerName($notes_detail[0]['cust_name']);
        }
        $return_obj->customer_name = $customer_name;
        $return_obj->notes_detail = $notes_detail[0];
        $return_obj->attachment_arr = $notes_detail[0]['attachment'] != '' ? explode(",",$notes_detail[0]['attachment']) : array();
    }
    
    echo json_encode($return_obj);
    exit();
}

if($note_id == ''){
    $message->set_message('fail', 'invalid_note');
    $return_obj->transaction_flag = FALSE;
}

if($return_obj->transaction_flag){
    if($note_id != '')
        $notes_detail = $notes->get_note_detail($note_id);
    if(empty($notes_detail)){
        $message->set_message('fail', 'invalid_note');
        $return_obj->transaction_flag = FALSE;
    }
}

if($return_obj->transaction_flag){
    $all_notes = $notes->get_all_notes(NULL, NULL, NULL, NULL, NULL, NULL, 'NO_LIMIT', TRUE);
    $access_flag = FALSE;
    if(!empty($all_notes)){
        foreach($all_notes as $this_note){
            if($this_note['id'] == $note_id) $access_flag = TRUE;
        }
    }
    
    if(!$access_flag){
        $message->set_message('fail', 'permission_denied');
        $return_obj->transaction_flag = FALSE;
    }
}

if($return_obj->transaction_flag){
    //delete note action
    if($_REQUEST['action'] == 'delete'){
        if($_SESSION['user_role'] != 1){
            $message->set_message('fail', 'permission_denied');
            $return_obj->transaction_flag = FALSE;
        }
        else if($notes->delete_note($note_id))
            $message->set_message('success', 'note_delete_success');
        else{
            $message->set_message('fail', 'note_delete_fail');
            $return_obj->transaction_flag = FALSE;
        }
    }
    //delete note attachment action
    else if($_REQUEST['action'] == 'delete_note_attachment' && trim($_REQUEST['file_id']) != ''){
        if($_SESSION['user_role'] != 1){
            $message->set_message('fail', 'permission_denied');
            $return_obj->transaction_flag = FALSE;
        }
        else {
            $delete_flag = FALSE;
            $delete_file = trim($_REQUEST['file_id']);
            $attachment_arr = $notes_detail[0]['attachment'] != '' ? explode(",",$notes_detail[0]['attachment']) : array();
            $new_attachement_array = array();
            if(!empty($attachment_arr)){
                foreach ($attachment_arr as $attachment){
                    if($attachment == $delete_file){
                        $delete_flag = TRUE;
                        continue;
                    }
                    $new_attachement_array[] = $attachment;
                }
                if($delete_flag){
                    $new_attachement_string = implode(',', $new_attachement_array);
                    $notes->id = $note_id;
                    if($notes->update_attachment($new_attachement_string))
                        $return_obj->attachment_arr = $new_attachement_array;
                    
                    $return_obj->transaction_flag = TRUE;
                }
            }
        }
    }

    //get not option
    else {
        $return_obj->cust_note = $notes_detail[0]['cust_name'];
        $notes->set_as_read_notes(array(array('id' => $note_id)));
        $customer_name = '';
        if($notes_detail[0]['cust_name'] != ''){
            $customer_name = $customer->getCustomerName($notes_detail[0]['cust_name']);
        }
        $return_obj->customer_name = $customer_name;
        $breaks = array("<br />","<br>","<br/>");  
        
        $notes_detail[0]['description'] = strip_tags(str_ireplace($breaks, "\r\n", $notes_detail[0]['description'])); 
        $return_obj->notes_detail = $notes_detail[0];
        $return_obj->attachment_arr = $notes_detail[0]['attachment'] != '' ? explode(",",$notes_detail[0]['attachment']) : array();
    }
}

$return_obj->message = $message->show_message();
echo json_encode($return_obj);
//$smarty->display('extends:layouts/dashboard.tpl|notes_detail.tpl');
?>