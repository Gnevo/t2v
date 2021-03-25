<?php
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_WARNING);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/customer_ai.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml","privilege.xml"));
$customer = new customer();
$messages = new message();
$customer_ai = new customer_ai();
$employee = new employee();
$user = new user();
$obj_general = new general();

date_default_timezone_set('CET');

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_implan'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'change_field'){
    if($customer_ai->update_implan_field_names($_REQUEST['field_name'], $_REQUEST['field_val'] ,$_REQUEST['field_id'])){
        echo TRUE;
    }else{
        echo FALSE;
    }
    exit();
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_field'){
    $delete_id = $_REQUEST['delete_id'];
    $result    = $customer_ai->check_field_exist_atleast_one_implan($delete_id);
    if(empty($result)){
        $customer_ai->delete_implan_field($delete_id);
        $responce = null;
    }
    else{
        $responce = $result;
    }
    echo json_encode($responce);
    exit();
}

//$query_string = explode("/",$_SERVER['QUERY_STRING']);
$query_string = explode("&",$_SERVER['QUERY_STRING']);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$customer_username = $query_string[0];
$smarty->assign('today',date("Y-m-d"));
$smarty->assign('years',$customer->get_year_implimentation());
$_SESSION['autosave'] = '';
$field_names = $customer_ai->get_implan_field_names();
$smarty->assign('implan_field_names', $field_names);
global $___smarty;
$___smarty = $smarty;


if(isset($_POST['username'])){
    //    echo $_POST['history'].'----------'.stripslashes($_POST['diagnosis']);
       // echo "<pre>\n".print_r($_POST, 1)."</pre>"; exit('gf');
    $new_implan_update_description = array();
    $new_implan_description        = array();
    $new_implan_description        = $_POST['new_implan_description'] != '' ? $_POST['new_implan_description'] : array();
    $customer_ai->new_implan_name  = $_POST['new_implan_name'];
    $new_implan_update_description = $_POST['new_implan_update'] != '' ? $_POST['new_implan_update'] : array() ;

    // var_dump($_POST['new_implan_name']);

    function striphtml($value){
        global $___smarty;
        $value  = stripslashes($value);
        return strip_tags($value) != '' ? $value = '<p class="note_block_head mt ml mr">'.$___smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$___smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($value).'</p>': $value = '' ;
        
    }
    $customer_ai->new_implan_description = array_map(striphtml, $new_implan_description);
    $new_implan_update_description       = array_map(striphtml, $new_implan_update_description);
    
    // var_dump($customer_ai->new_implan_description);
    // exit('fg');
    // 
    // exit('qqwqwwqqw');

    $customer_ai->username                      = $customer_username;
    $customer_ai->implementation_history        = stripslashes($_POST['history']);
    $customer_ai->implementation_diagnosis      = stripslashes($_POST['diagnosis']);
    $customer_ai->implementation_mission        = stripslashes($_POST['mission']);
    $customer_ai->implementation_intervention   = stripslashes($_POST['intervention']);
    $customer_ai->implementation_travel         = stripslashes($_POST['travels']);
    $customer_ai->implementation_work           = isset($_POST['work'])?stripslashes($_POST['work']) : '';
    $customer_ai->implementation_email          = stripslashes($_POST['email']);
    $customer_ai->implementation_phone          = stripslashes($_POST['phone']);
    $customer_ai->implementation_work_comment   = stripslashes($_POST['comment_work']);
    $customer_ai->implementation_travel_comment = stripslashes($_POST['comment_travel']);

    strip_tags($customer_ai->implementation_history) != '' ? $customer_ai->implementation_history = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($customer_ai->implementation_history).'</p>': $customer_ai->implementation_history = ''; 

    strip_tags($customer_ai->implementation_diagnosis) != '' ? $customer_ai->implementation_diagnosis = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br><p class="ml">'.strip_tags($customer_ai->implementation_diagnosis).'</p>' : $customer_ai->implementation_diagnosis = '' ;

    strip_tags($customer_ai->implementation_mission) !='' ? $customer_ai->implementation_mission = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br><p class="ml">'.strip_tags($customer_ai->implementation_mission).'</p>' : $customer_ai->implementation_mission = '' ;

    strip_tags($customer_ai->implementation_email) != '' ? $customer_ai->implementation_email = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br><p class="ml">'.strip_tags($customer_ai->implementation_email).'</p>' : $customer_ai->implementation_email = '';

    strip_tags($customer_ai->implementation_intervention) != '' ? $customer_ai->implementation_intervention = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br><p class="ml">'.strip_tags($customer_ai->implementation_intervention).'</p>' : $customer_ai->implementation_intervention = '';

    strip_tags($customer_ai->implementation_work_comment) != '' ? $customer_ai->implementation_work_comment = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br><p class="ml">'.strip_tags($customer_ai->implementation_work_comment).'</p>' : $customer_ai->implementation_work_comment = '';

    strip_tags($customer_ai->implementation_travel_comment) != '' ? $customer_ai->implementation_travel_comment = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_implan_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br><p class="ml">'.strip_tags($customer_ai->implementation_travel_comment).'</p>' : $customer_ai->implementation_travel_comment = '';

    if($_POST['new'] !='new'){
        $implementaion_id = $_POST['date'];
        $tmp_implan_details = $customer_ai->customer_implementation_details($implementaion_id);
        $tmp_new_implan_details = $customer_ai->new_customer_implementation_details($implementaion_id);
        foreach ($tmp_new_implan_details as $key => $value) {
            $tmp_new_implan_details_index[$value['field_id']] = $value;
        }
        // var_dump($tmp_new_implan_details_index); 
        if(!empty($tmp_implan_details)){
                $customer_ai->implementation_history != '' ? $customer_ai->implementation_history.= '<hr/>' : $customer_ai->implementation_history.= '';
                $customer_ai->implementation_history        .= $tmp_implan_details['history'];

                $customer_ai->implementation_diagnosis != '' ? $customer_ai->implementation_diagnosis.= '<hr/>' : $customer_ai->implementation_diagnosis.= '';
                $customer_ai->implementation_diagnosis      .= $tmp_implan_details['diagnosis'];

                $customer_ai->implementation_mission != '' ? $customer_ai->implementation_mission.= '<hr/>' : $customer_ai->implementation_mission.= '';
                $customer_ai->implementation_mission        .= $tmp_implan_details['mission'];

                $customer_ai->implementation_email != '' ? $customer_ai->implementation_email.= '<hr/>' : $customer_ai->implementation_email.= '';
                $customer_ai->implementation_email          .= $tmp_implan_details['email'];

                $customer_ai->implementation_intervention != '' ? $customer_ai->implementation_intervention.= '<hr/>' : $customer_ai->implementation_intervention.= '';
                $customer_ai->implementation_intervention   .= $tmp_implan_details['intervention'];

                $customer_ai->implementation_work_comment != '' ? $customer_ai->implementation_work_comment.= '<hr/>' : $customer_ai->implementation_work_comment.= '';
                $customer_ai->implementation_work_comment   .= $tmp_implan_details['work_comment'];

                $customer_ai->implementation_travel_comment != '' ? $customer_ai->implementation_travel_comment.= '<hr/>' : $customer_ai->implementation_travel_comment.= '';
                $customer_ai->implementation_travel_comment .= $tmp_implan_details['travel_comment'];
            // $customer->employee = $tmp_documentation_saved['employee'];  //can't edit employee while editing
        }
        if(!empty($new_implan_update_description)){
            if(!empty($tmp_new_implan_details)){ // both insert and update
                $update = 1;
                foreach ($new_implan_update_description as $key => $value) {
                   
                    if($key == $tmp_new_implan_details_index[$key]['field_id']){

                        $value != '' ? $value.= '<hr/>' : $value.= '';
                        $value .= $tmp_new_implan_details_index[$key]['description'];
                        $new_implan_array_for_update[$key] = $value; 
                        unset($new_implan_update_description[$key]);
                    }
                }
            }   
            else{// insert 
                $update = 0;
            }
        }
        // var_dump($new_implan_update_description,$new_implan_array_for_update,$implementaion_id);
        // var_dump($_POST['read_write']);
        // var_dump($update_implan_field_namesate);        exit('fdg');
       // echo "<pre>".print_r($tmp_implan_details, 1)."</pre>"; exit();
        // echo "<script>alert(\"".$_POST['read_write']."\")</script>";
        $customer_ai->implementation_id = $_POST['date'];
        
        $customer_ai->begin_transaction();
        if($customer_ai->customer_implementation_update($_POST['read_write'])) {
            $customer_ai->add_new_implan_details();
            if($update == 0){  // insert description of  dynamicaly created fields 
                $customer_ai->add_update_implan_description($new_implan_update_description,$implementaion_id);
            }
            else{ // insert & update description of  dynamicaly created fields
                 $customer_ai->add_update_insert_implan_description($new_implan_update_description,$new_implan_array_for_update,$implementaion_id);
            }
            $customer_ai->commit_transaction();
            $messages->set_message('success', 'customer_details_saved');
            $saving_success = TRUE; 
        } else {
            
            $customer_ai->rollback_transaction();
            $messages->set_message('fail', 'cant_complete_your_process');
        }

        //saving attached documents
        $documents_file = $customer_ai->customer_implimentation_attachment_documents($customer_ai->implementation_id);
        
        //upload files
        $trustedoc = $_POST['tdocs'];
        $trustedoc_del = $_POST['del_doc'];
        $files_count = $_POST['file_count'];
        //$trustedoc = $_POST['tdocs'];
        $files_deletes = explode(',', $trustedoc_del);
        $app_dir = getcwd();
        if($files_deletes[0] == ""){
            $files_deletes = array();
        }
        $upload_path = $app_dir . "/" . $customer->get_folder_name($_SESSION['company_id']) . "/customer_implan_attachments/";
        for ($j = 0; $j < count($documents_file); $j++) {
            for ($i = 0; $i < count($files_deletes); $i++) {
                if ($documents_file[$j]['file'] == $files_deletes[$i]) {
                    
                    break;
                }
            }
            if ($i != count($files_deletes)) {
                
                $move_path = $upload_path . "deleted_files/" . $documents_file[$j]['file'];
                $str = $documents_file[$j]['file'];
                if (file_exists($move_path)) {
                               
                    $num = 1;
                    $x = 0;
                    $str1 = explode('.', $str);
                    $str = $str1[0] . "_" . $num . "." . $str1[1];
                    $move_path = $upload_path . "deleted_files/" . $str;
                    while ($x == 0) {
                        if (file_exists($move_path)) {
                            $num++;
                            $str1 = explode('.', $str);
                            $str1[0] = substr($str1[0], 0, -2);
                            $str = $str1[0] . "_" . $num . "." . $str1[1];
                            $move_path = $upload_path . "deleted_files/" . $str;
                        } else {
                            $x++;
                        }
                    }
                    

                }
                
                rename($upload_path . $documents_file[$j]['file'] , $move_path);
                //@unlink($upload_path . $documents_file[$j]['file']);
            }
        }
        
        if ($files_count > 0) {
            
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_implan_attachments/';
            $max_size = 50000 * 1024;
            $error = 0;
            $message = '';
            $type = '';
            for ($i = 1; $i <= $files_count; $i++) {
                if (isset($_FILES['file_' . $i]['name']) && $_FILES['file_' . $i]['name'] != "") {
                    $file_no_change = $_FILES['file_' . $i]['name'];
                    $file_name = $_FILES['file_' . $i]['name'];
                    $size = filesize($_FILES['file_' . $i]['tmp_name']);
                    $file_info = pathinfo($file_name);
                    // $str = str_replace(" ", "_", $file_name);
                    $str = str_replace(array(" ", ","), "_", $file_info['filename']).'_'.date('Y-m-d').'.'.$file_info['extension'];
                    if ($size <= $max_size) {
                        // $extension = $customer->get_file_extension($file_name);
                        $extension = $file_info['extension'];
                        if (in_array($extension, array("doc", "docx", 'dot', "pdf", "odt", "txt", 'oxps', 'ppt', 'pptx', 'ppsm', 'ppsx', 'pps', 'ods', 'xls', 'xlsx'))) {
                        // if (!in_array($extension, array("php", "phtml", "sh", "exe"))) {

                            //$upload_path = "customer_attachments/";
                            $file_path = $upload_path . $str;

                            if (file_exists($file_path)) {
                                    $num = 1;
                                    $x = 0;
                                    $str1 = explode('.', $str);
                                    $str = $str1[0] . "_" . $num . "." . $str1[1];
                                    $file_path = $upload_path . $str;
                                    while ($x == 0) {
                                        if (file_exists($file_path)) {
                                            $num++;
                                            $str1 = explode('.', $str);
                                            $str1[0] = substr($str1[0], 0, -2);
                                            $str = $str1[0] . "_" . $num . "." . $str1[1];
                                            $file_path = $upload_path . $str;
                                        } else {
                                            $x++;
                                        }
                                    }
                                    if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                        //rename($upload_path.$file_no_change, $file_path);
                                        if ($trustedoc != "") {
                                            $trustedoc .= "," . $str;
                                        } else {
                                            $trustedoc = $str;
                                        }
                                        $message = 'customer_updating_success';
                                        $type = "success";
                                        $messages->set_message($type, $message);
                                    }
                            } else {
                                if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                     //rename($upload_path.$file_no_change, $file_path);
                                    if ($trustedoc != "") {
                                        $trustedoc .= "," . $str;
                                    } else {
                                        $trustedoc = $str;
                                    }
                                    $message = 'customer_updating_success';
                                    $type = "success";
                                } else {
                                    $message = 'failed_to_post_documents';
                                    $type = "fail";
                                    break;
                                }
                            }
                        } else {
                            $message = 'file_selected_supported_extension';
                            $type = "fail";
                            break;
                        }
                    } else {
                        $message = 'exceeds_the_limit_file_size';
                        $type = "fail";
                        break;
                    }
                }
            }


            $documents = array();
            if ($trustedoc != '') {
                $documents = explode(',', $trustedoc);
                
            }
            
            //if($transaction_flag){
                
                if ($customer_ai->customer_implimentation_attachment_documents_add($customer_ai->implementation_id, $documents)) {
                    
                    $messages->set_message($type, $message);
                } else {
                    
                    $messages->set_message($type, $message);
                }
            //}
        }
        if(isset($_POST['date']) != '' && $_POST['new'] != "new")
            $url = $smarty->url.'customer/implan/'.$customer_username.'/'.$_POST['date'].'/get/';   



    } 
    else { // new implan deatils adding.
        $customer_ai->begin_transaction();
        // var_dump($customer_ai->new_implan_name,$customer_ai->new_implan_description);
        // exit('g');

        // var_dump($customer_ai->new_implan_name);
        if($customer_ai->customer_implementation_add($_POST['read_write'])) {
            $implementaion_id = $customer_ai->implementation_id = $customer_ai->last_insert_id;
                $customer_ai->add_new_implan_details();
                if(!empty($new_implan_update_description)){
                    $customer_ai->add_update_implan_description($new_implan_update_description,$implementaion_id);
                }
            $customer_ai->commit_transaction(); 
            $messages->set_message('success', 'customer_details_saved');
            $saving_success = TRUE; 

            //  header("location:".$smarty->url."customer/implan/".$customer_username."/");

        } else {
            $customer_ai->rollback_transaction();
            $messages->set_message('fail', 'cant_complete_your_process');
        }
        //saving attached documents
        $documents_file = $customer_ai->customer_implimentation_attachment_documents($customer_ai->implementation_id);
        
        //upload files
        $trustedoc = $_POST['tdocs'];
        $trustedoc_del = $_POST['del_doc'];
        $files_count = $_POST['file_count'];
        //$trustedoc = $_POST['tdocs'];
        $files_deletes = explode(',', $trustedoc_del);
        $app_dir = getcwd();
        if($files_deletes[0] == ""){
            $files_deletes = array();
        }
        $upload_path = $app_dir . "/" . $customer->get_folder_name($_SESSION['company_id']) . "/customer_implan_attachments/";
        for ($j = 0; $j < count($documents_file); $j++) {
            for ($i = 0; $i < count($files_deletes); $i++) {
                if ($documents_file[$j]['file'] == $files_deletes[$i]) {
                    
                    break;
                }
            }
            if ($i != count($files_deletes)) {
                
                $move_path = $upload_path . "deleted_files/" . $documents_file[$j]['file'];
                $str = $documents_file[$j]['file'];
                if (file_exists($move_path)) {
                               
                    $num = 1;
                    $x = 0;
                    $str1 = explode('.', $str);
                    $str = $str1[0] . "_" . $num . "." . $str1[1];
                    $move_path = $upload_path . "deleted_files/" . $str;
                    while ($x == 0) {
                        if (file_exists($move_path)) {
                            $num++;
                            $str1 = explode('.', $str);
                            $str1[0] = substr($str1[0], 0, -2);
                            $str = $str1[0] . "_" . $num . "." . $str1[1];
                            $move_path = $upload_path . "deleted_files/" . $str;
                        } else {
                            $x++;
                        }
                    }
                    

                }
                
                rename($upload_path . $documents_file[$j]['file'] , $move_path);
                //@unlink($upload_path . $documents_file[$j]['file']);
            }
        }
        
        if ($files_count > 0) {
            
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_implan_attachments/';
            $max_size = 50000 * 1024;
            $error = 0;
            $message = '';
            $type = '';
            for ($i = 1; $i <= $files_count; $i++) {
                if (isset($_FILES['file_' . $i]['name']) && $_FILES['file_' . $i]['name'] != "") {
                    $file_no_change = $_FILES['file_' . $i]['name'];
                    $file_name = $_FILES['file_' . $i]['name'];
                    $size = filesize($_FILES['file_' . $i]['tmp_name']);
                    $file_info = pathinfo($file_name);
                    // $str = str_replace(" ", "_", $file_name);
                    $str = str_replace(array(" ", ","), "_", $file_info['filename']).'_'.date('Y-m-d').'.'.$file_info['extension'];
                    if ($size <= $max_size) {
                        // $extension = $customer->get_file_extension($file_name);
                        $extension = $file_info['extension'];
                        if (in_array($extension, array("doc", "docx", 'dot', "pdf", "odt", "txt", 'oxps', 'ppt', 'pptx', 'ppsm', 'ppsx', 'pps', 'ods', 'xls', 'xlsx'))) {
                        // if (!in_array($extension, array("php", "phtml", "sh", "exe"))) {

                            //$upload_path = "customer_attachments/";
                            $file_path = $upload_path . $str;

                            if (file_exists($file_path)) {
                                    $num = 1;
                                    $x = 0;
                                    $str1 = explode('.', $str);
                                    $str = $str1[0] . "_" . $num . "." . $str1[1];
                                    $file_path = $upload_path . $str;
                                    while ($x == 0) {
                                        if (file_exists($file_path)) {
                                            $num++;
                                            $str1 = explode('.', $str);
                                            $str1[0] = substr($str1[0], 0, -2);
                                            $str = $str1[0] . "_" . $num . "." . $str1[1];
                                            $file_path = $upload_path . $str;
                                        } else {
                                            $x++;
                                        }
                                    }
                                    if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                        //rename($upload_path.$file_no_change, $file_path);
                                        if ($trustedoc != "") {
                                            $trustedoc .= "," . $str;
                                        } else {
                                            $trustedoc = $str;
                                        }
                                        $message = 'customer_updating_success';
                                        $type = "success";
                                        $messages->set_message($type, $message);
                                    }
                            } else {
                                if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                     //rename($upload_path.$file_no_change, $file_path);
                                    if ($trustedoc != "") {
                                        $trustedoc .= "," . $str;
                                    } else {
                                        $trustedoc = $str;
                                    }
                                    $message = 'customer_updating_success';
                                    $type = "success";
                                } else {
                                    $message = 'failed_to_post_documents';
                                    $type = "fail";
                                    break;
                                }
                            }
                        } else {
                            $message = 'file_selected_supported_extension';
                            $type = "fail";
                            break;
                        }
                    } else {
                        $message = 'exceeds_the_limit_file_size';
                        $type = "fail";
                        break;
                    }
                }
            }


            $documents = array();
            if ($trustedoc != '') {
                $documents = explode(',', $trustedoc);
                
            }
            
            //if($transaction_flag){
                
                if ($customer_ai->customer_implimentation_attachment_documents_add($customer_ai->implementation_id, $documents)) {
                    
                    $messages->set_message($type, $message);
                } else {
                    
                    $messages->set_message($type, $message);
                }
            //}
        }
    $url = $smarty->url.'customer/implan/'.$customer_username.'/'.$implementaion_id.'/get/';
    }
    if($saving_success == TRUE){
        $message = 'customer_details_saved';
        $type = "success";
        $messages->set_message($type, $message);
    }
    // var_dump($url);
    // var_dump($customer_ai->last_insert_id);
        // exit('dsf');
    header('Location:'.$url);
    exit();
    // isset(! $_POST['val']);
    // echo "<meta http-equiv='refresh' content='0'>";
    // unset($_POST);
    // header('Location:'.$_SERVER['PHP_SELF']);   
    // $url = $smarty->url.'customer/implan/'.$customer_username.'/'.$_POST['date'].'/';
    // header('Location:'.$url);
    // exit();
}

else{
    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $count = count($query_string);
    if (!empty($query_string)) {

        if($query_string[$count-1] == "get"){
            $implan_id = $query_string[1];
            $smarty->assign('implementation', $customer_ai->customer_implementation_details($implan_id));
            $smarty->assign('customer_implan_document_string', $customer_ai->customer_implimentation_attachment_document_string($implan_id));
            $smarty->assign('customer_implan_documents', $customer_ai->customer_implimentation_attachment_documents($implan_id));
            $new_implan_description_show = $customer_ai->new_implan_description_show($implan_id);
        }

        else if($query_string[$count-1] == "new") {
            $new = "new";
            $smarty->assign('new',$new);
        }

        else{
            $dates1 = $customer_ai->customer_implementation_dates($customer_username);
            $last_id = (!empty($dates1) ? $dates1[0]['id'] : NULL);
            if($last_id != NULL){
                $smarty->assign('implementation', $customer_ai->customer_implementation_details($last_id));
                $smarty->assign('customer_implan_document_string', $customer_ai->customer_implimentation_attachment_document_string($last_id));
                $smarty->assign('customer_implan_documents', $customer_ai->customer_implimentation_attachment_documents($last_id));
                $new_implan_description_show = $customer_ai->new_implan_description_show($last_id);
            }
        }
    }
}




$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'IMPLAN'));
$smarty->assign('message', $messages->show_message());

$smarty->assign('customer_username', $customer_username);
$customer_detail = $customer->customer_detail($customer_username);
$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
$smarty->assign('customer_detail', $customer_detail);
$implan_dates = $customer_ai->customer_implementation_dates($customer_username);
// echo '<pre>'.print_r($implan_dates, 1).'</pre>'; exit();
if($implan_dates){
    $smarty->assign('implan_date', $implan_dates);
}else{
   $smarty->assign('new','new'); 
}
$smarty->assign('implan_date', $implan_dates);
$work_array = array('School' => 'Skola', 'Hospital' => 'Sjukhus', 'Bank' => 'Bank');
$smarty->assign('work_array', $work_array);

$smarty->assign('travel_type', $smarty->travel_type);
// echo '<pre>'.print_r($query_string, 1).'</pre>'; exit();

/*if(isset ($_POST['date']) && $_POST['date'] != '') {
    $implan_id = $_POST['date'];
    $smarty->assign('implementation', $customer_ai->customer_implementation_details($implan_id));
    $smarty->assign('customer_implan_document_string', $customer_ai->customer_implimentation_attachment_document_string($implan_id));
    $smarty->assign('customer_implan_documents', $customer_ai->customer_implimentation_attachment_documents($implan_id));
    $new_implan_description_show = $customer_ai->new_implan_description_show($implan_id);
    // $url = $smarty->url.'customer/implan/'.$customer_username.'/'.$_POST['date'].'/';
    // header('Location:'.$url);
}
else if($query_string[1] != "new"){
    $dates1 = $customer_ai->customer_implementation_dates($customer_username);
    // var_dump($dates1);
    // exit('');
     // $last_id = $dates1[count($dates1) - 1]['id'];
    $last_id = (!empty($dates1) ? $dates1[0]['id'] : NULL);
    if($last_id != NULL){
        $smarty->assign('implementation', $customer_ai->customer_implementation_details($last_id));
        $smarty->assign('customer_implan_document_string', $customer_ai->customer_implimentation_attachment_document_string($last_id));
        $smarty->assign('customer_implan_documents', $customer_ai->customer_implimentation_attachment_documents($last_id));
        $new_implan_description_show = $customer_ai->new_implan_description_show($last_id);
    }
    // var_dump($customer_ai->customer_implementation_details($last_id));
    // exit('22222'); 
}
else{
    $smarty->assign('new','new');
}*/
if($customer->is_customer_accessible($customer_username)){
    $smarty->assign('access_flag',1);
}else{
    $smarty->assign('access_flag',0);
}

// echo "<pre>".print_r($customer_ai->customer_implementation_details('cybr001'))."</pre>";
// exit('fgfd');
$implan_id = $_POST['date'];
$new_implan_fields = $customer_ai->get_all_new_implan_fields();
// var_dump($new_implan_fields);
// $new_implan_description_show = $customer_ai->new_implan_description_show($implan_id);
if(!empty($new_implan_description_show)){
    foreach ($new_implan_description_show as $key => $value) {
       $new_implan_description_show_div[$value['id']] = $value;
    }
}

////////////// ajax block ////////////////////////

if($_POST['action'] == 'save_single_field'){
    $field_name = $_POST['field_name'];
    $customer_ai->add_new_implan_names($field_name);
    echo json_encode($customer_ai->last_insert_id);
    exit();
}


////////////   End        //////////////////



// var_dump($new_implan_description_show_div); exit();
$smarty->assign('new_implan_fields',$new_implan_fields);
$smarty->assign('new_implan_description_show_div',$new_implan_description_show_div);


$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
//echo "<pre>".print_r($s[0]['travel'],1)."</pre>";  
$smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . '/customer_implan_attachments');

$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->display('extends:layouts/dashboard.tpl|customer_implan.tpl|layouts/sub_layout_customer_tabs.tpl');
?>