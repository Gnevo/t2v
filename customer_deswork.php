<?php
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_WARNING);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/equipment.php');
require_once('plugins/message.class.php');
require_once('class/employee.php');
require_once('class/customer_ai.php');
require_once('class/user.php');
require_once('class/general.php');

$customer = new customer();
$equipment = new equipment();
$messages = new message();
$employee = new employee();
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml","privilege.xml","common.xml"));
$customer_ai = new customer_ai();
$obj_general = new general();
$user = new user();

$query_string  = explode("&",$_SERVER['QUERY_STRING']);
$customer_name = $query_string[0];

$new_deswork_description_show = array();

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_deswork'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'change_field'){
    if($customer_ai->update_deswork_field_names($_REQUEST['field_name'], $_REQUEST['field_val'] ,$_REQUEST['field_id'])){
        echo TRUE;
    }else{
        echo FALSE;
    }
    exit();
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_field'){
    $delete_id = $_REQUEST['delete_id'];
    $result    = $customer->check_field_exist_atleast_one_work($delete_id);
    if(empty($result)){
        $customer->delete_work_field($delete_id);
        $responce = null;
    }
    else{
        $responce = $result;
    }
    echo json_encode($responce);
    exit();
}

    // $url = $smarty->url.'customer/deswork/'.$query_string[0].'/';
    // var_dump($url);
    // exit('df');
date_default_timezone_set('CET');
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'DESWORK'));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('today',date("Y-m-d"));
$smarty->assign('years',$customer->get_year_work());
$_SESSION['autosave'] = '';
$field_names = $customer_ai->get_deswork_field_names();
$smarty->assign('deswork_field_names', $field_names);
global $___smarty;
$___smarty = $smarty;
if(isset($_POST['username'])){


    // var_dump($url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    // var_dump($query_string);
    // var_dump($_POST['date']);
    // exit('df');

    $customer->work             = $_POST['work'];
    $customer->history          = $_POST['history'];
    $customer->clinical_picture = $_POST['clinical_picture'];
    $customer->medications      = $_POST['medication'];
    $customer->devolution       = $_POST['ja'];
    $customer->customer         = $_POST['username'];
    $customer->special_diet     = $_POST['special_diet'];

    strip_tags($customer->work) != '' ? $customer->work = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_deswork_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($customer->work).'</p>': $customer->work = '' ;
    strip_tags($customer->history) != '' ? $customer->history = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_deswork_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($customer->history).'</p>': $customer->history = '' ;
    strip_tags($customer->clinical_picture) != '' ? $customer->clinical_picture = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_deswork_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($customer->clinical_picture).'</p>': $customer->clinical_picture = '' ;
    strip_tags($customer->medications) != '' ? $customer->medications = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_deswork_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($customer->medications).'</p>': $customer->medications = '' ;
    strip_tags($customer->special_diet) != '' ? $customer->special_diet = '<p class="note_block_head mt ml mr">'.$smarty->translate['customer_deswork_date'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($customer->special_diet).'</p>': $customer->special_diet = '' ;

    $new_deswork_description = array();
    $new_deswork_update_description = array();

    $new_deswork_description        = $_POST['new_deswork_description'] != '' ? $_POST['new_deswork_description'] : array();
    $customer->new_deswork_name     = $_POST['new_deswork_name'];
    $new_deswork_update_description = $_POST['new_deswork_update'] != '' ?  $_POST['new_deswork_update'] : array();


    function striphtml($value){
        global $___smarty;
        return strip_tags($value) != '' ? $value = '<p class="note_block_head mt ml mr">'.$___smarty->translate['customer_deswork_date'].': '.date('Y-m-d H:i').'   '.$___smarty->translate['user_name'].': '. $_SESSION['user_name'] .'</p></br/><p class="ml">'.strip_tags($value).'</p>': $value = '' ;
        
    }
    $customer->new_deswork_description = array_map(striphtml, $new_deswork_description);
    $new_deswork_update_description    = array_map(striphtml, $new_deswork_update_description);



    $temp_deswork_id = '';
    if($_POST['new'] == "new"){ // adding new deswork.
        $customer->begin_transaction();
        if($customer->insert_work_customer($_POST['read_write'])){
            $work_id = $customer->deswork_id = $customer->last_insert_id;
            $customer->add_new_deswork_details();
            if(!empty($new_deswork_update_description)){
                // var_dump($new_deswork_update_description);
                // exit('f');
                $customer->add_update_deswork_description($new_deswork_update_description,$work_id);
            }
            $customer->commit_transaction();
            $message = 'customer_details_saved';
            $type    = "success";
            $saving_success = TRUE; 
        }else{
            $customer->rollback_transaction();
            $message = 'cant_complete_your_process';
            $type    = "success";
        }
        
        $messages->set_message($type, $message);
        // var_dump($messages);
        // exit('fgfd');
        // $messages->set_message('success', 'customer_details_saved');
        $dates1 = $customer->get_dates_customer_work($_SERVER['QUERY_STRING']);
        $id_last = (!empty($dates1) ? $dates1[0]['id'] : NULL);
        $works_date = $customer->get_customer_works_date($id_last);
        $new_deswork_description_show = $customer->new_deswork_description_show($id_last);
        $smarty->assign('data',$works_date);
        $temp_deswork_id = $id_last;
        // var_dump($work_id,$temp_deswork_id);
        // exit('dfds');
       
        $url = $smarty->url.'customer/deswork/'.$customer_name.'/'.$work_id.'/get/';
		// header("location:".$url);
        
    }
    else{
        $customer->deswork_id = $_POST['ids'];
        $tmp_new_deswork_details = $customer->new_customer_deswork_details($_POST['ids']);
        foreach ($tmp_new_deswork_details as $key => $value) {
            $tmp_new_deswork_details_index[$value['field_id']] = $value;
        }
        $tmp_details = $customer->get_customer_works_date($_POST['ids'])[0];
        if(!empty($tmp_details)){
            $customer->work != '' ? $customer->work.= '<hr/>' : $customer->work.= '';
            $customer->work .= $tmp_details['work'];

            $customer->history != '' ? $customer->history.= '<hr/>' : $customer->history.= '';
            $customer->history .= $tmp_details['history'];

            $customer->clinical_picture != '' ? $customer->clinical_picture.= '<hr/>' : $customer->clinical_picture.= '';
            $customer->clinical_picture .= $tmp_details['clinical_picture'];

            $customer->medications != '' ? $customer->medications.= '<hr/>' : $customer->medications.= '';
            $customer->medications .= $tmp_details['medications'];

            $customer->special_diet != '' ? $customer->special_diet.= '<hr/>' : $customer->special_diet.= '';
            $customer->special_diet .= $tmp_details['special_diet'];
        }

        if(!empty($new_deswork_update_description)){
            if(!empty($tmp_new_deswork_details)){ // both insert and update
                $update = 1;
                foreach ($new_deswork_update_description as $key => $value) {
                   
                    if($key == $tmp_new_deswork_details_index[$key]['field_id']){

                        $value != '' ? $value.= '<hr/>' : $value.= '';
                        $value .= $tmp_new_deswork_details_index[$key]['description'];
                        $new_deswork_array_for_update[$key] = $value; 
                        unset($new_deswork_update_description[$key]);
                    }
                }
            }   
            else{// insert 
                $update = 0;
            }
        }
        // var_dump($update);
        // var_dump($new_deswork_array_for_update,$new_deswork_update_description);exit('fg');
        $data = $customer->edit_work_customer($_POST['ids'], $_POST['read_write']);

        if($data){
                $customer->add_new_deswork_details();
            if($update == 0){  // insert description of  dynamicaly created fields 
                $customer->add_update_deswork_description($new_deswork_update_description,$_POST['ids']);
            }
            else{ // insert & update description of  dynamicaly created fields
                 $customer->add_update_insert_deswork_description($new_deswork_update_description,$new_deswork_array_for_update,$_POST['ids']);
            }
            $saving_success = TRUE; 
        }

        
        $works_date = $customer->get_customer_works_date($_POST['ids']);
        $new_deswork_description_show = $customer->new_deswork_description_show($_POST['ids']);
        $smarty->assign('data',$works_date);
        $temp_deswork_id = $_POST['ids'];
        //header("location:".$smarty->url."customer/deswork/".$_POST['username']."/");
    }

    //saving attached documents
        $documents_file = $customer_ai->customer_deswork_attachment_documents($temp_deswork_id);
        //echo "<pre>".print_r($documents_file,1)."</pre>";exit();
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
        $upload_path = $app_dir . "/" . $customer->get_folder_name($_SESSION['company_id']) . "/customer_deswork_attachments/";
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
            
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_deswork_attachments/';
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
                
                if ($customer_ai->customer_deswork_attachment_documents_add($temp_deswork_id, $documents)) {
                    
                    $messages->set_message($type, $message);
                } else {
                    
                    $messages->set_message($type, $message);
                }
            //}
        }
        $smarty->assign('customer_deswork_document_string', $customer_ai->customer_deswork_attachment_document_string($temp_deswork_id));
            $smarty->assign('customer_deswork_documents', $customer_ai->customer_deswork_attachment_documents($temp_deswork_id));

        if(isset($_POST['date']) != '' && $_POST['new'] != "new")
            $url = $smarty->url.'customer/deswork/'.$customer_name.'/'.$_POST['date'].'/get/';
        // var_dump($query_string[1]);
        // exit('df');
        // $url = $smarty->url.'customer/deswork/'.$customer_name.'/';
        if($saving_success == TRUE){
            $message = 'customer_details_saved';
            $type = "success";
            $messages->set_message($type, $message);
        }
        // $message = 'customer_updating_success';
        // $type = "success";
        // $messages->set_message($type, $message);
        header('Location:'.$url);
        exit();

}
else{
    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $count = count($query_string);
    if (!empty($query_string)) {
      
        if($query_string[$count-1] == "get"){
            $works_date = $customer->get_customer_works_date($query_string[1]);
            $smarty->assign('data',$works_date);
            $new_deswork_description_show = $customer->new_deswork_description_show($query_string[1]);
            // var_dump($new_deswork_description_show);
            $dates = $customer->get_dates_customer_work($query_string[0]);
            $smarty->assign('customer_deswork_document_string', $customer_ai->customer_deswork_attachment_document_string($query_string[1]));
            $smarty->assign('customer_deswork_documents', $customer_ai->customer_deswork_attachment_documents($query_string[1]));
        }
        else if($query_string[$count-1] == "new")
        {
           
            $new = "new";
            $smarty->assign('new',$new);
        }
        else{
            $dates1 = $customer->get_dates_customer_work($query_string[$count-1]);
            if($dates1){
                $id_last = (!empty($dates1) ? $dates1[0]['id'] : NULL);
                $works_date = $customer->get_customer_works_date($id_last);
                $smarty->assign('data',$works_date);
                $new_deswork_description_show = $customer->new_deswork_description_show($id_last);
                $smarty->assign('customer_deswork_document_string', $customer_ai->customer_deswork_attachment_document_string($id_last));
            $smarty->assign('customer_deswork_documents', $customer_ai->customer_deswork_attachment_documents($id_last));
            }else{
                $new = "new";
                $smarty->assign('new',$new);
            }
            
        }
    }
    // $url = $smarty->url.'customer/deswork/'.$query_string[0].'/';
    // header('Location:'.$url);
}
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$count = count($query_string);
if (!empty($query_string)) {
    if ($query_string == 'print') {
        return false;
    } else {

        $customer_username = $query_string[0];
        $customer_detail = $customer->customer_detail($customer_username);
        $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
        $smarty->assign('customer_detail', $customer_detail);
        $smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));

    }
}
$smarty->assign('message', $messages->show_message());
$dates = $customer->get_dates_customer_work($query_string[0]);
if($dates){
    $smarty->assign('dates',$dates);
    $smarty->assign('last_date',$dates[0]['date']);   
}else{
    $new = "new";
    $smarty->assign('new',$new);
}


if($customer->is_customer_accessible($customer_username)){
    $smarty->assign('access_flag',1);
}else{
    $smarty->assign('access_flag',0);
}
// $new_deswork_description_show = $customer->new_deswork_description_show($_POST['ids']);
// var_dump($new_deswork_description_show);
//             exit('gfg');
    foreach ($new_deswork_description_show as $key => $value) {
       $new_deswork_description_show_div[$value['id']] = $value;
    }

////////////// ajax block ////////////////////////

if($_POST['action'] == 'save_single_field'){
    $field_name = $_POST['field_name'];
    $customer->add_new_deswork_names($field_name);
    echo json_encode($customer->last_insert_id);
    exit();
}


////////////   End        //////////////////    

$new_deswork_fields = $customer->get_all_new_deswork_fields();
$smarty->assign('new_deswork_description_show_div',$new_deswork_description_show_div);
$smarty->assign('new_deswork_fields',$new_deswork_fields);
$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . '/customer_deswork_attachments');

$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->display('extends:layouts/dashboard.tpl|customer_deswork.tpl|layouts/sub_layout_customer_tabs.tpl');
date_default_timezone_set('UTC');
?>