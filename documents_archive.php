<?php

    // error_reporting(E_ALL);
    //                     error_reporting(E_WARNING);
    //                     ini_set('error_reporting', E_ALL);
    //                     ini_set("display_errors", 1);
    require_once('class/setup.php');
    require_once('class/equipment.php');
    require_once('class/customer.php');
    require_once('class/employee.php');
    require_once('class/mail.php');
    require_once('configs/config.inc.php');
    require_once('plugins/message.class.php');
    $obj_equipment = new equipment();
    $obj_employee = new employee();
    $obj_mail = new mail();
    $customer      = new customer();
    $messages      = new message();
    $obj_user      = new user();
    $smarty        = new smartySetup(array("notes.xml", "reports.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", "common.xml"));

    global $bank_id;

    $documents     = $obj_equipment->get_all_document_archive('0');
    // var_dump('first'.$documents[0]['users']);
    $query_string  = explode('&', $_SERVER['QUERY_STRING']);
    $privileges_mc = $obj_user->get_privileges($_SESSION['user_id'], 3);
    // $category_all  = $obj_equipment->get_category_all($query_string[0]);

    // var_dump($privileges_document_archive);
    // exit('fdsds');  
    $smarty->assign('menu', array('mainmenu' => 1, 'su$query_stringbmenu' => 5));
    // header('location: https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true');
    //$data = $obj_equipment->get_document_sign_by_user('dodo001');
    
    if($_POST['action'] == 'mark_read'){
        // header('Access-Control-Allow-Origin: *');
        // $savename = 'download';
        // header('location: https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true');
        // echo $_POST['filename'];
        // // echo mime_content_type($_POST['filename']);
        // $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/document_archive/";
        // echo $upload_path;
         // header('Content-Disposition: inline; filename=' . $savename);
        // header('Content-type: application/msword'); // not sure if this is the correct MIME type
        // readfile($_POST['filename']);
        // exit;
       
        // exit('fg');
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6)
            $obj_equipment->document_archive_mark_read($_REQUEST['document_id']);   
        echo TRUE;
        exit();
    }

    if (isset($_POST['action_common']) && $_POST['action_common'] == 'document_sign') {

        $string_data = $smarty->translate['document_sign'];
        $string_non_visible = $smarty->translate['document_sign'];
        //$string_non_visible = "91eb5e00-0010-2016-0001-69fada001002,d0e0b2aff0c6303ecb869059ccfa5b9d029cdfcbdc7de29a3bf8d5583889b336";
        
        $string_data = base64_encode($string_data);
        $string_non_visible = base64_encode($string_non_visible);
        
        $url_send = $bank_id['url'];
                    
        $data = array(
            "toBeSigned" => array(
                "data" => $string_data,
                "hiddenData" => $string_non_visible
            )
        );
        $str_data = json_encode($data);
        //echo '<pre>' . print_r($str_data, 1) . '</pre>';
        $headers =  sendPostData($url_send, $str_data);
        //echo '<pre>' . print_r($headers, 1) . '</pre>';
        //exit();
        
        if($headers[1]['X-Diglias-Location']){
            $_SESSION['url_back_back'] = $_SERVER['HTTP_REFERER'];
            echo '<script>window.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'document_sign_back_url.php"</script>';
        }
        else{
            echo $smarty->translate['can_not_connect_to_bank_id'];
        }
    } else if(isset($_POST['action_common']) && $_POST['action_common'] == 'document_sign_delete'){
        $sign_id = $_POST['sign_id'];
        $obj_equipment->delete_document_sign($sign_id, $_SESSION['user_id']);
    }

    if (isset($_POST['action']) && $_POST['action'] == '1' ) {
        if( $privileges_mc['document_archive'] == 1){

            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/document_archive/";

            require('class/UploadHandler.php');
            $upload_handler = new UploadHandler($upload_path,$_POST['user_privilege_add'],$_POST['category_select']);
            if($_POST['category_select'] == -1) {
                $employees = $obj_employee->employee_list();
                $obj_mail->root_id = 0;
                $obj_mail->status = 0;
                $obj_mail->subject = $smarty->translate['you_have_new_document_to_sign_subject'];
                $obj_mail->message = $smarty->translate['you_have_new_document_to_sign_message'];
                foreach ($employees as $employee_data) {
                    $obj_mail->from = $_SESSION['user_id'];
                    $obj_mail->to = $employee_data['username'];
                    $obj_mail->insert_mail();
                }
            }

        //    header('Location:'. $smarty->url.'documents/archive/');
            
        //    $max_size = 5000 * 1024;
        //    foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
        //        $file_name = $key.$_FILES['file']['name'][$key];
        //        $size = filesize($_FILES['file']['tmp_name'][$key]);
        //        $str = str_replace(" ", "_", $file_name);
        //        if ($size <= $max_size) {
        //            $extension = $customer->get_file_extension($str);
        //            //if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {
        //
        //                $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/document_archive/";
        //                //$upload_path = "documents_attach/";
        //                $file_path = $upload_path . $str;
        //                if (!file_exists($file_path)) {
        //                    if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $file_path)) {
        //
        //                        $obj_equipment->employee = $_SESSION['user_id'];
        //                        $obj_equipment->filename = $str;
        //                        $obj_equipment->status = 1;
        //                        $datas = $obj_equipment->document_archive_add();
        //                        $message = 'document_add_success';
        //                        $type = "success";
        //                        $messages->set_message($type, $message);
        //                    } else {
        //                        $message = 'failed_to_post_documents';
        //                        $type = "fail";
        //                        $messages->set_message($type, $message);
        //                    }
        //                } else {
        //
        //                    $present = 0;
        ////                    $documents_file = $employee->get_all_files_user($query_string[0]);
        ////
        ////                    for ($x = 0; $x < count($documents_file); $x++) {
        ////                        $str1 = explode('.', $documents_file[$x]['documents']);
        ////                        $str1[0] = substr($str1[0], 0, -2);
        ////                        $str1 = $str1[0] . "." . $str1[1];
        ////                        if ($documents_file[$x]['documents'] == $str || $str == $str1) {
        ////                            $present = 1;
        ////                            break;
        ////                        }
        ////                    }
        ////                    if ($present == 1) {
        ////                        echo "<br>6";
        ////                        $message = 'file_exists';
        ////                        $type = "fail";
        ////                        $messages->set_message($type, $message);
        ////                        $error = "1";
        ////                    } else {
        //
        //                    $num = 1;
        //                    $x = 0;
        //                    $str1 = explode('.', $str);
        //                    $str = $str1[0] . "_" . $num . "." . $str1[1];
        //                    $file_path = $upload_path . $str;
        //                    while ($x == 0) {
        //                        if (file_exists($file_path)) {
        //                            $num++;
        //                            $str1 = explode('.', $str);
        //                            $str1[0] = substr($str1[0], 0, -2);
        //                            $str = $str1[0] . "_" . $num . "." . $str1[1];
        //                            $file_path = $upload_path . $str;
        //                        } else {
        //                            $x++;
        //                        }
        //                    }
        //                    if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $file_path)) {
        //
        //                        $obj_equipment->employee = $_SESSION['user_id'];
        //                        $obj_equipment->filename = $str;
        //                        $obj_equipment->status = 1;
        //                        $datas = $obj_equipment->document_archive_add();
        //                        $message = 'document_add_success';
        //                        $type = "success";
        //                        $messages->set_message($type, $message);
        //                    }
        ////                    }
        //                }
        ////            } else {
        ////                $message = 'file_selected_supported_extension';
        ////                $type = "fail";
        ////                $messages->set_message($type, $message);
        ////            }
        //        } else {
        //            $message = 'exceeds_the_limit_file_size';
        //            $type = "fail";
        //            $messages->set_message($type, $message);
        //        }
        //    }
        }
    }elseif (isset($_POST['action_common']) && $_POST['action_common'] == '2') {
        $doc_id    = $_POST['doc_id'];
        $file_name = $_POST['file_name_delete'];
        if ($obj_equipment->document_archive_delete($doc_id)) {
            $app_dir     = getcwd();
            $folder_name = $customer->get_folder_name($_SESSION['company_id']) . "/document_archive/";
            @unlink($app_dir . "/" . $folder_name . $file_name);
            $message = 'document_delete_success';
            $type    = "success";
            $messages->set_message($type, $message);
        } else {
            $message = 'document_delete_fail';
            $type = "fail";
            $messages->set_message($type, $message);
        }
    }elseif (isset($_POST['action_common']) && $_POST['action_common'] == '3') {
        // echo '<pre>'.print_r($_POST, 1).'</pre>'; exit();
        $doc_id = $_POST['doc_id'];
        $priv_users = $_POST['user_privilege'];
        if ($obj_equipment->document_archive_update_privilege($doc_id, $priv_users)) {
            $message = 'document_privilege_updation_success';
            $type    = "success";
            $messages->set_message($type, $message);
        }else{
            $message = 'document_privilege_updation_fail';
            $type = "fail";
            $messages->set_message($type, $message);
        }
    }elseif (isset($_POST['action_common']) && $_POST['action_common'] == '4' && $privileges_mc['document_archive'] == 1) {

            $obj_equipment->category_id_move = $_POST['move_category'];
            $obj_equipment->files_to_move = $_POST['categorys_to_move'];
            if($obj_equipment->document_archieve_category_move()){
                $message = 'document_category_move_success';
                $type    = "success";
                $messages->set_message($type, $message);
            }
            else{
                $message = 'document_category_move_fail';
                $type    = "fail";
                $messages->set_message($type, $message);
            }
            header("location:" . $smarty->url . "documents/archive/".$query_string[0]."/");
            exit();
    }



    if ($query_string[0]) {
        // var_dump('fdgdfgfdgfdg');
        $key = strip_tags($_POST['folder_id']);
        if($query_string[0] == -1) {
            $documents = $obj_equipment->get_public_document_archive();
        } else {
            $documents = $obj_equipment->get_all_document_archive($query_string[0]);
        }
        // var_dump('second'.$documents[0]['users']);

    }
    else{
        $documents = $obj_equipment->get_all_document_archive('0');
    }

    // var_dump($_POST);
    if (isset($_POST['category_save'])) {

        if($_POST['category'] != '' && $_POST['category'] && $privileges_mc['document_archive'] == 1){
            $obj_equipment->category_name = $_POST['category'];
            $obj_equipment->alloc_emp     = $_SESSION['user_id'];
            $obj_equipment->parent_cat    = $_POST['parent_cat'];
            $obj_equipment->document_archieve_category_add();
            header("location:" . $smarty->url . "documents/archive/");
            exit();
        }
    }

    if (isset($_POST['action_cat']) && $_POST['action_cat'] == '1') { // delete category
         $data_bfr_del = array();
         $data_afr_del = array();
         $data = $obj_equipment->document_archieve_category_select_file();
         foreach ($data as $key => $value) {
             $data_bfr_del[] = $value['file_name'];
         }
         $category_id = $_POST['delete_category_id'];
         $status      = $obj_equipment->document_category_delete($category_id);
         $data        = $obj_equipment->document_archieve_category_select_file();
         foreach ($data as $key => $value) {
             $data_afr_del[] = $value['file_name'];
         }
         $del_array = array_diff($data_bfr_del, $data_afr_del);
         if($status == 1){
            $app_dir = getcwd();
            $folder_name = $customer->get_folder_name($_SESSION['company_id']) . "/document_archive/";
            foreach ($del_array as $key => $value) {
                @unlink($app_dir . "/" . $folder_name . $value);
            }
         }
    }

    elseif (isset($_POST['action_cat']) && $_POST['action_cat'] == '2') { // category name & parent change
        $category_edit_id = $_POST['edit_id'];
        $parent_cat_ids    = $_POST['parent_change'];
        foreach ($parent_cat_ids as $key => $value) {
           if($key == $category_edit_id){
                $parent_cat_id = $value;
                break;
           }
        }
        $obj_equipment->category_edit_name = $_POST['edit_category'];
        $obj_equipment->document_category_change($parent_cat_id,$category_edit_id);

    }

    if ($_POST['action'] == 'category_filter') {
        $key = strip_tags($_POST['key']);
        if($key == 0){
            $document_filter = $obj_equipment->get_all_document_archive();
        }
        else{
            $document_filter = $obj_equipment->get_all_document_archive($key);
        }
        echo json_encode($document_filter);
        exit();
    }
    
    $smarty->assign('privileges_mc' , $obj_user->get_privileges($_SESSION['user_id'], 3));
    $category_names        = $obj_equipment->get_direct_childrens($query_string[0]);
    $exact_employees_group = $obj_equipment->employee_mailabe_group($_SESSION['user_id']);
    $count_of_categorys    = $obj_equipment->get_all_document_archive_count();
    $all_level_child       = $obj_equipment->get_all_level_child($query_string[0]);
    $all_level_child_names = $obj_equipment->get_all_level_child_names($all_level_child);

   


//////////////////////// for getting which folders are accesible /////////////////////

    $all_category          = $obj_equipment->get_all_category();
    foreach ($all_category as $key => $value) {
        $full_category[$value['id']] = $value;  
    }
    $accesible_folders     = $obj_equipment->get_all_folder_acceseble($query_string[0],$_SESSION['user_id']);
    foreach ($accesible_folders as $key => $value) {
        $last_parent_id[] = recursive_get_path($value['id'],$full_category);
    }


    function recursive_get_path($id,$full_category){
        $query_string  = explode('&', $_SERVER['QUERY_STRING'])[0];
        $query_string == '' ? $query_string = 0 : $query_string;  
        if($full_category[$id]['parent_category'] != $query_string){
            return recursive_get_path($full_category[$id]['parent_category'],$full_category);
        }
        else{
            return $id;
        }
    }

//////////////                        End                    //////////////////////


    $path_name = get_full_category_path($query_string[0],$full_category);
    function get_full_category_path($id,$full_category){ // get full path from child to parent.
        $id == '' ? $id = 0 : $id;  
        if($full_category[$id]['parent_category'] != null){
              $path[$id] = $full_category[$id]['name'];
              $path  = get_full_category_path($full_category[$id]['parent_category'],$full_category);
        }
        $path[$id] = $full_category[$id]['name'];
        return $path;
    }
    
    //$document_sign = $obj_equipment->get_document_sign_by_user($_SESSION['user_id']);
    //echo '<pre>' . print_r($documents, 1) . '</pre>';exit();
    $sign_flag = FALSE;
    foreach ($documents as $key => $value) {
            if(!$value['signed_id']) {
                $sign_flag = TRUE;
            }
            $single_user = preg_split('/(,)/', $value['users']);
            $documents[$key]['priv_users'] = $single_user;
    }
    //echo '<pre>' . print_r($last_parent_id, 1) . '</pre>';exit();
    // echo "<pre>".print_r($accesible_folders,1)."</pre>";
      // echo "<pre>".print_r($last_parent_id,1)."</pre>";
    // exit();
    //var_dump($category_names);
    // var_dump($_SESSION);
    // exit('gf');
    $smarty->assign('path_name',$path_name);
    $smarty->assign('all_level_child_names',$all_level_child_names);
    $smarty->assign('last_parent_id',$last_parent_id);
    $smarty->assign('sign_flag', $sign_flag);
    $smarty->assign('category_id', $query_string[0]);
    $smarty->assign('category_names', $category_names);
    $smarty->assign('all_category', $all_category);
    $smarty->assign('count_of_categorys', $count_of_categorys);
    $smarty->assign('employees_group', $exact_employees_group);
    $smarty->assign('message', $messages->show_message());
    $smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . "/document_archive");

    // echo "<pre>".print_r($documents,1)."</pre>";exit();
    $smarty->assign('documents', $documents);
    $smarty->assign('login_user', $_SESSION['user_id']);
    $smarty->assign('login_user_role', $_SESSION['user_role']);
    $smarty->display('extends:layouts/dashboard.tpl|documents_archive.tpl');

function sendPostData($url, $post){
    global $bank_id;  
    $headers= array('Accept: application/json',
    'Content-Type: application/json',
    'Connection: keep-alive',
    'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36'
    ); 
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_USERPWD, $bank_id['userpaswd']);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$post);    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $headers = get_headers_from_curl_response($header);
    //echo "<pre>".  print_r($headers,1)."</pre>";
    file_put_contents('sign.txt', print_r($headers, true));
    curl_close($ch);
    return $headers;
}

function get_headers_from_curl_response($headerContent){
    $headers = array();
    $arrRequests = explode("\r\n\r\n", $headerContent); 
    for ($index = 0; $index < count($arrRequests) -1; $index++) {

        foreach (explode("\r\n", $arrRequests[$index]) as $i => $line)
        {
            if ($i === 0)
                $headers[$index]['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                $headers[$index][$key] = $value;
            }
        }
    }
    return $headers;
}
?>
