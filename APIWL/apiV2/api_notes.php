<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/user.php');
require_once('class/employee.php');
$smarty     = new smartySetup(array("user.xml"), FALSE);
$obj_notes  = new notes();
$obj_employee = new employee();

$action     = trim($_REQUEST['action']);

$action     = ($action != "" && $action != "NULL" && in_array($action, array('GET_LIST', 'GET_UNREAD_LIST', 'SET_AS_READ', 'UPDATE_STATUS')) ? $action : NULL );
$obj        = array();

if($action == 'GET_LIST' || $action == 'GET_UNREAD_LIST'){
    $start_index= trim($_REQUEST['start_index']);
    $res_length = trim($_REQUEST['res_length']);

    $start_index= ($start_index != "" && $start_index != "NULL" ? $start_index : 0);
    $res_length = ($res_length != "" && $res_length != "NULL" ? $res_length : 20);
    $breaks     = array("<br />","<br>","<br/>");
    $privileges_mc = $obj_employee->get_privileges($_SESSION['user_id'], 3);
    if($action == 'GET_LIST'){
        $req_year   = trim($_REQUEST['year']);
        $req_month  = trim($_REQUEST['month']);
        $sel_year   = ($req_year != "" && $req_year != "NULL" ? $req_year : date('Y') );
        $sel_month  = ($req_month != "" && $req_month != "NULL" ? $req_month : date('m'));

        $unread_notes = $obj_notes->get_unread_note(100);
        $data = $obj_notes->get_all_notes($sel_year, $sel_month, $start_index, $res_length);
        
        if(!empty($data)){
            $obj_user = new user();
            $note_attachment_upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/notes/attachment/';

            foreach($data as $notes) {
                $notes['description']   = strip_tags(str_ireplace($breaks, "\r\n", $notes['description'])); 
                $notes['is_unread']     = in_array($notes['id'], $unread_notes) ? 1 : 0; 
                
                $attachments___ = array();
                if($notes['attachment'] != ''){
                    $attachments = explode(',',$notes['attachment']);
                    if(!empty($attachments)){
                        foreach ($attachments as $akey => $attachment) {
                            if(trim($attachment) != '' && file_exists(getcwd()  . '/' . $note_attachment_upload_path . trim($attachment))){
                                $attachments___[] = array(
                                    'title' => trim($attachment),
                                    'path' => $smarty->url.$note_attachment_upload_path . trim($attachment)
                                );
                            }
                        }
                    }
                }
                $notes['attachments'] = $attachments___;
                $notes['privilege_approve'] = $privileges_mc['notes_approval'] ? TRUE : FALSE;
                $notes['privilege_reject'] = $privileges_mc['notes_rejection'] ? TRUE : FALSE;
                $obj[] = $notes;
            }
        }
    }
    elseif($action == 'GET_UNREAD_LIST') {
        //check unread year month notes
        $notes_list     = $obj_notes->get_all_notes();
        $unread_notes   = $obj_notes->get_unread_note();
        $all_unread_list= $obj_notes->get_all_unread_notes($notes_list,$unread_notes);
        $unread_list    = array_slice($all_unread_list, $start_index, $res_length);
        if(!empty($unread_list)){
            $obj_user = new user();
            $note_attachment_upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/notes/attachment/';
            
            foreach($unread_list as $notes) {
                $notes['description']    = strip_tags(str_ireplace($breaks, "\r\n", $notes['description'])); 
                $notes['is_unread']      = 1;

                $attachments___ = array();
                if($notes['attachment'] != ''){
                    $attachments = explode(',',$notes['attachment']);
                    if(!empty($attachments)){
                        foreach ($attachments as $akey => $attachment) {
                            if(trim($attachment) != '' && file_exists(getcwd()  . '/' . $note_attachment_upload_path . trim($attachment))){
                                $attachments___[] = array(
                                    'title' => trim($attachment),
                                    'path' => $smarty->url.$note_attachment_upload_path . trim($attachment)
                                );
                            }
                        }
                    }
                }
                $notes['attachments'] = $attachments___;
                $notes['privilege_approve'] = $privileges_mc['notes_approval'] ? TRUE : FALSE;
                $notes['privilege_reject'] = $privileges_mc['notes_rejection'] ? TRUE : FALSE;
                $obj[] = $notes;
            }
            // $obj_notes->set_as_read_notes($unread_list);
        }
    }
}
elseif($action == 'SET_AS_READ') {
    $note_id   = trim($_REQUEST['note_id']);
    $note_id   = ($note_id != "" && $note_id != "NULL" ? $note_id : NULL );
    $result_flag = FALSE;
    if($note_id != NULL)
        $result_flag = $obj_notes->set_as_read_notes(array(array('id' => $note_id)));

    $obj['transaction'] = $result_flag;
}
elseif($action == 'UPDATE_STATUS'){
    $obj_notes->id = $_POST['id'];
    $obj_notes->status = $_POST['status'];

    $obj['transaction'] = $obj_notes->update_note_status();
       
}elseif($action = 'EDIT_NOTE'){
    $note_id = $_REQUEST['id'];
    if($_REQUEST['title'] && $_REQUEST['description']){
        $obj_notes->customer    = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        $obj_notes->title       = trim($_REQUEST['title']);
        $obj_notes->description = trim($_REQUEST['description']);
        $obj_notes->editable    = trim($_REQUEST['editable']);
        //$notes->note_date = date('Y-m-d H:i:s');
        $obj_notes->login_user  = $_SESSION['user_id'];
        if($_SESSION['user_role'] == '3')
            $obj_notes->visibility = 2;     //set as private note
        else
            $obj_notes->visibility = trim($_REQUEST['visibility']);

        $obj_notes->status = trim($_REQUEST['status']);
        if($_SESSION['user_role'] != '1' &&  $_SESSION['user_role'] != '6')
            $obj_notes->status=($_REQUEST['visibility'] == 1 ? 0 : 1);

       

        $update_flag = FALSE;
        //update note
        if($note_id != "" && $_SESSION['user_role'] == 1){
            $notes_detail = $obj_notes->get_note_detail($note_id);
            $obj_notes->status = $notes_detail[0]['status'];
            if((int) $note_id > 0 && !empty($notes_detail)){
                $update_flag = TRUE;
                $obj['transaction'] = TRUE;
                if ($obj_notes->update_note($note_id, trim($notes_detail[0]['attachment'])))
                    $obj['transaction'] = TRUE;
                else{
                    $obj['transaction'] = FALSE;
                }
            }
        }

        
    }
    
    if($note_id != "" && $obj->transaction_flag){
        $notes_detail = $obj_notes->get_note_detail($note_id);  //by default it marked as read
        $obj['cust_note'] = $notes_detail[0]['cust_name'];
        $obj_notes->set_as_read_notes(array(array('id' => $note_id)));
        $customer_name = '';
        if($notes_detail[0]['cust_name'] != ''){
            $customer_name = $customer->getCustomerName($notes_detail[0]['cust_name']);
        }
        $obj['customer_name'] = $customer_name;
        $obj['notes_detail'] = $notes_detail[0];
        $obj['attachment_arr'] = $notes_detail[0]['attachment'] != '' ? explode(",",$notes_detail[0]['attachment']) : array();
    }
}

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $obj;
echo json_encode($main_obj);
?>