<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml","month.xml", "notes.xml","privilege.xml", 'reports.xml'));

require_once('class/employee.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/notes.php');
require_once('class/user.php');
require_once('plugins/message.class.php');
require_once('class/general.php');
$employee = new employee();
$customer = new customer();
$equipment = new equipment();
$notes = new notes();
$user = new user();
$messages = new message();
$obj_general = new general();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'DOCUMENT'));

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_documentation'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

date_default_timezone_set('CET');
$smarty->assign('message', $messages->show_message());
$smarty->assign('today',date("Y-m-d"));
$smarty->assign('years',$customer->get_year_documentation());
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
//print_r($dates_documentation);
$employees = $employee->employee_list();
//print_r($employees);
$customer_username = "";
$_SESSION['autosave'] = '';
$smarty->assign('employees',$employees);
$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass', $pass);
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$count = count($query_string);
$smarty->assign('msg_notes',"0");
if(isset($_POST['username'])){
    //   echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    $customer->customer = $_POST['username'];
    $customer->employee = $_POST['employed'];
    $customer->issue_date = $_POST['date_created'];
    $customer->return_date = $_POST['date_last'];
    $customer->subject = $_POST['subject'];
    $customer->note_type = $_POST['note_type'];
    $customer->notes = trim($_POST['notes']);
    $customer->priority = $_POST['priority'];
    $customer->description = $_POST['more_notes'];
    $customer->status = $_POST['status'];


    // var_dump($_POST['notes']);
    // exit('fgetc');
    
    if(trim(strip_tags($customer->notes)) != ''){
    //        $start_time = new DateTime;
    //        $start_time->setTimezone(new DateTimeZone('CET'));
    //        $cur_dtime = $start_time->format('Y-m-d G:i');
        $customer->notes = '<p class="note_block_head">'.$smarty->translate['date_documentation'].': '.date('Y-m-d H:i').'   '.$smarty->translate['user_documentation'].': '. $_SESSION['user_name'] .'</p></br/>'.$customer->notes;
    }else
       // $customer->notes = trim(strip_tags($customer->notes));
        $customer->notes = trim($customer->notes);
    
    if($_POST['saves'] == "new"){
        $customer->begin_transaction();
        if($customer->insert_documentation($_POST['read_write'])){
            $customer_document_id = $customer->get_id();
            $documents_file = $customer->customer_documentation_documents($customer_document_id);
            //upload files
            $trustedoc = $_POST['tdocs'];
            $trustedoc_del = $_POST['del_doc'];
            $files_count = $_POST['file_count'];
            $files_deletes = explode(',', $trustedoc_del);
            $app_dir = getcwd();
            if($files_deletes[0] == ""){
                $files_deletes = array();
            }
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_documents/';
            if (!is_dir($app_dir . "/" . $upload_path)) {
                mkdir($app_dir . "/" . $upload_path, 0777);
            }
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
                }
            }

            if ($files_count > 0) {

                $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_documents/';
                if (!is_dir($app_dir . "/" . $upload_path)) {
                    mkdir($app_dir . "/" . $upload_path, 0777);
                }
                $max_size = 50000 * 1024;
                $error = 0;
                for ($i = 1; $i <= $files_count; $i++) {

                    if (isset($_FILES['file_' . $i]['name']) && $_FILES['file_' . $i]['name'] != "") {
                        $file_no_change = $_FILES['file_' . $i]['name'];
                        $file_name = $_FILES['file_' . $i]['name'];
                        $size = filesize($_FILES['file_' . $i]['tmp_name']);
                        $str = str_replace(" ", "_", $file_name);

                        if ($size <= $max_size) {

                            $extension = $customer->get_file_extension($file_name);
                            if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                                $file_path = $upload_path . $str;
                                $file_string = $customer->customer_decision_document_string($contract_id);

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
                                    }
                                }
                            } else {

                                $message = 'file_selected_supported_extension';
                                $type = "fail";
                            }
                        } else {

                            $message = 'exceeds_the_limit_file_size';
                            $type = "fail";
                        }
                    }
                }
                $messages->set_message($type, $message);
            }
            if($type == 'success') {
                $customer->update_documentation_doc($customer_document_id, $trustedoc);
                $customer->commit_transaction();
                $messages->set_message('success', 'customer_details_saved');
                
                header("location:" . $smarty->url . 'customer/documentation/' . $_POST['username'] . '/' . $customer_document_id . '/get/');
                exit();
            } else if($type == 'fail') {
                $customer->rollback_transaction();
            } else {
                $customer->commit_transaction();
                $messages->set_message('success', 'customer_details_saved');
                
                header("location:" . $smarty->url . 'customer/documentation/' . $_POST['username'] . '/' . $customer_document_id . '/get/');
                exit();
            }
        } 
        else {
            $customer->rollback_transaction();
            $messages->set_message('fail', 'cant_complete_your_process');
        }
        
        
        $dates_open = $customer->get_dates_equipments($_POST['username'],$_SESSION['type_document']);
        $customer_username = $_POST['username'];
        $last_date = $dates_open[0]['id'];
        $documentation_date = $customer->get_documentation_date($last_date );
        $dates_documentation = $customer->get_dates_equipments($customer_username,$_SESSION['type_document']);
        $smarty->assign('data',$documentation_date);

    }
    else {
        $customer_username = $_POST['username'];
        $customer->begin_transaction();
        $tmp_documentation_saved = $customer->get_documentation_date($_POST['ids']);
        if(!empty($tmp_documentation_saved)){
            if(trim(strip_tags($customer->notes)) != '')
                $customer->notes .= '<hr/>';
            $customer->notes .= $tmp_documentation_saved[0]['notes'];
            
            $customer->employee = $tmp_documentation_saved[0]['employee'];  //can't edit employee while editing
        }
        
        if($customer->edit_documentation($_POST['ids'], $_POST['read_write'])){
           
            $customer_document_id = $_POST['ids'];
            $documents_file = $customer->customer_documentation_documents($customer_document_id);
            //upload files
            $type = 'success';
            $trustedoc = $_POST['tdocs'];
            $trustedoc_del = $_POST['del_doc'];
            $files_count = $_POST['file_count'];
            $files_deletes = explode(',', $trustedoc_del);
            $app_dir = getcwd();
            if($files_deletes[0] == ""){
                $files_deletes = array();
            }
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_documents/';
            if (!is_dir($app_dir . "/" . $upload_path)) {
                mkdir($app_dir . "/" . $upload_path, 0777);
            }
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
                }
            }
            if ($files_count > 0) {

                $upload_path = $customer->get_folder_name($_SESSION['company_id']) . '/customer_documents/';
                if (!is_dir($app_dir . "/" . $upload_path)) {
                    mkdir($app_dir . "/" . $upload_path, 0777);
                }
                $max_size = 50000 * 1024;
                $error = 0;
                for ($i = 1; $i <= $files_count; $i++) {
                    if (isset($_FILES['file_' . $i]['name']) && $_FILES['file_' . $i]['name'] != "") {

                        $file_no_change = $_FILES['file_' . $i]['name'];
                        $file_name = $_FILES['file_' . $i]['name'];
                        $size = filesize($_FILES['file_' . $i]['tmp_name']);
                        $str = str_replace(" ", "_", $file_name);

                        if ($size <= $max_size) {

                            $extension = $customer->get_file_extension($file_name);
                            if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                                $file_path = $upload_path . $str;
                                $file_string = $customer->customer_decision_document_string($contract_id);

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
                                    }
                                }
                            } else {
                                $message = 'file_selected_supported_extension';
                                $type = "fail";
                            }
                        } else {
                            $message = 'exceeds_the_limit_file_size';
                            $type = "fail";
                        }
                    }
                }
                $messages->set_message($type, $message);
            }
            if($type == 'success') {
                $customer->update_documentation_doc($customer_document_id, $trustedoc);
                $customer->commit_transaction();
                $messages->set_message('success', 'customer_details_saved');
                
                header("location:" . $smarty->url . 'customer/documentation/' . $_POST['username'] . '/' . $customer_document_id . '/get/');
                exit();
            } else if($type == 'fail') {
                $customer->rollback_transaction();
            } else {
                $customer->commit_transaction();
                $messages->set_message('success', 'customer_details_saved');
                
                header("location:" . $smarty->url . 'customer/documentation/' . $_POST['username'] . '/' . $customer_document_id . '/get/');
                exit();
            }
        }
        else{
            $customer->rollback_transaction();
            $messages->set_message('fail', 'cant_complete_your_process');
        }
        $dates_documentation = $customer->get_dates_equipments($customer_username,$_SESSION['type_document']);
        $documentation_date = $customer->get_documentation_date($_POST['ids']);
        $smarty->assign('data',$documentation_date);

    }
}
else {
    if (!empty($query_string)) {
        if($query_string[$count-1] == 'get'){
            $customer_username = $query_string[$count-3];
            $documentation_date = $customer->get_documentation_date($query_string[1]);
            $type = 0;
            if($documentation_date[0]['note_type'] == 'dokumentation'){
                $type = 1;
            }elseif($documentation_date[0]['note_type'] == 'protokoll'){
                $type = 2;
            }elseif($documentation_date[0]['note_type'] == 'minnesanteckning'){
                $type = 3;
            }
            $_SESSION['type_document'] = $type;
            $dates_documentation = $customer->get_dates_equipments($customer_username,$type);
            $smarty->assign('data',$documentation_date);
            // var_dump($documentation_date);
            // exit('111');


        }
        else if($query_string[$count-1] == 'new') //($query_string[$count-1] == 'new')
        {
            $customer_username = $query_string[$count-2];
            $new = "new";
            $smarty->assign('new',$new);
        //$data = $equipment->insert_documentation();
        }
        else if($query_string[$count-2] == 'get'){
            
            $customer_username = $query_string[0];
            if($query_string[$count-1] == 'm2'){
                $dates_documentation = $customer->get_dates_equipments($customer_username,3);
                $all_notes = $notes->get_all_notes_of_customer($customer_username);
                $smarty->assign('all_notes',$all_notes);
                $smarty->assign('note_display',"yes");
                $smarty->assign('msg_notes',"1");
                $_SESSION['type_document'] = 3;
            }else{
                $dates_documentation = $customer->get_dates_equipments($customer_username,$query_string[$count-1]);
                $_SESSION['type_document'] = $query_string[$count-1];
                if($dates_documentation){
                    $last_date = $dates_documentation[0]['id'];
                    $documentation_date = $customer->get_documentation_date($last_date );
                    $smarty->assign('data',$documentation_date);
                }else{
                    $new = "new";
                    $smarty->assign('new',$new);
                }
            }
        }
        else{
            $customer_username = $query_string[$count-1];
            $dates_documentation = $customer->get_dates_equipments($customer_username);
            //            $_SESSION['type_document'] = 1;
            if($dates_documentation){
                $last_date = $dates_documentation[0]['id'];
                $documentation_date = $customer->get_documentation_date($last_date );
                $type = 0;
                if($documentation_date[0]['note_type'] == 'dokumentation'){
                    $type = 1;
                }elseif($documentation_date[0]['note_type'] == 'protokoll'){
                    $type = 2;
                }elseif($documentation_date[0]['note_type'] == 'minnesanteckning'){
                    $type = 3;
                }
                $_SESSION['type_document'] = $type;
                $dates_documentation = $customer->get_dates_equipments($customer_username,$type);
                $smarty->assign('data',$documentation_date);
            }else{
                $new = "new";
                $smarty->assign('new',$new);
            }
        }
    }
}
if(!empty($query_string)){
    if ($query_string == 'print') {
        return false;
    } else {
        $customer_username = $query_string[0];
        $customer_detail = $customer->customer_detail($customer_username);
        $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
        $smarty->assign('customer_detail', $customer_detail);
    }
}

//$dates_documentation = $customer->get_dates_equipments($customer_username);
if($dates_documentation){
    $smarty->assign('dates',$dates_documentation);
}else{
    $new = "new";
    $smarty->assign('new',$new);
}
if($customer->is_customer_accessible($customer_username)){
    $smarty->assign('access_flag',1);
}else{
    $smarty->assign('access_flag',0);
}
$smarty->assign('customer_documents', $customer->customer_documentation_documents($documentation_date[0]['id']));
$smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . '/customer_documents/');
$smarty->assign('documentation_type',$_SESSION['type_document']);
$smarty->assign('default_user',$_SESSION['user_id']);
$smarty->assign('message', $messages->show_message());
$smarty->assign('dates',$dates_documentation);

$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);

//echo "<pre>".print_r($dates_documentation, 1)."</pre>";
$smarty->display('extends:layouts/dashboard.tpl|customer_documentation.tpl|layouts/sub_layout_customer_tabs.tpl');
date_default_timezone_set('UTC');
?>