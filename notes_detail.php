<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/customer.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"));
$notes = new notes();
$customer = new customer();
$user = new user();
$message = new message();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

$params = explode('&', $_SERVER['QUERY_STRING']);
$note_id = trim($params[0]);
if($params[1] == 1 || $params[1] == "1"){
    $smarty->assign("back", 1);
    $smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>3));
}
$note_delet_permission = 'FALSE';
if($note_id == ''){
    header("Location: " . $smarty->url . "notes/list/");exit;
    
}else if(isset ($params[1]) && trim($params[1]) == 'delete' && $_SESSION['user_role'] == 1){
    $notes_detail = $notes->get_note_detail($note_id);
    if(empty($notes_detail)){
        $smarty->assign("Note_flag",1);
    }else{
        if($notes->delete_note($note_id)){
            $message->set_message('success', 'note_delete_success');
            header("Location: " . $smarty->url . "notes/list/");exit;
        }else
            $message->set_message('fail', 'note_delete_fail');
    }
    
}else{
        $notes_detail = $notes->get_note_detail($note_id);
        $smarty->assign('cust_note',$notes_detail[0]['cust_name']);
        if(empty($notes_detail)){
            $smarty->assign("Note_flag",1);
        }else{
            $all_notes = $notes->get_all_notes();
            $access_flag = FALSE;
            if(!empty($all_notes)){
                foreach($all_notes as $this_note){
                    if($this_note['id'] == $note_id)
                        $access_flag = TRUE;
                }
            }
            if(!$access_flag){
                $smarty->assign("Note_flag",2);
            }else{
                $notes->set_as_read_notes(array(array('id' => $note_id)));
                $customer_name = '';
                if($notes_detail[0]['cust_name'] != ''){
                    $customer_name = $customer->getCustomerName($notes_detail[0]['cust_name']);
                }
                $smarty->assign("customer_name",$customer_name);
                $smarty->assign("notes_detail",$notes_detail[0]);
                $attachment_arr = array();
                if($notes_detail[0]['attachment'] != ''){
                       $attachment_arr = explode(",",$notes_detail[0]['attachment']);	 
                }
                $smarty->assign("attachment_arr",$attachment_arr);
                
                if(isset($_POST['file_id']) && trim($_POST['file_id']) != ''){// this for deleting notes_attachment link (admin purpose)
                    $delete_flag = FALSE;
                    $delete_file = trim($_POST['file_id']);
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
                                $smarty->assign("attachment_arr",$new_attachement_array);
                        }
                    }
                }
            }
            
            if($_SESSION['user_role'] == 1){
                $note_delet_permission = 'TRUE';
            }
        }
}
$smarty->assign('message', $message->show_message());
$smarty->assign("note_delet_permission",$note_delet_permission);
$smarty->display('extends:layouts/dashboard.tpl|notes_detail.tpl');
?>