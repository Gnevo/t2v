<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('plugins/message.class.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/user.php');
require_once('class/general.php');
$employee = new employee();
$customer = new customer();
$messages = new message();
$user = new user();
$obj_general = new general();
$smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", 'company.xml'));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2 , 'tabmenu'=>'employee_documentations'));
$query_string = explode('&', $_SERVER['QUERY_STRING']);
// assigning  sort by first or last name

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_documentation'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
if (!empty($query_string[0])) {
    $employee_detail[0] = $employee->get_employee_detail($query_string[0]);
    $smarty->assign('employee_detail', $employee_detail);
    $smarty->assign('employee_username', $query_string[0]);
    $smarty->assign('employee_role', $user->user_role($query_string[0]));
    if (isset($_POST['action']) && $_POST['action'] == '1') {
        $max_size = 50000 * 1024; //50MB
        $file_name = $_FILES['file']['name'];
        $size = $_FILES['file']['size']; 
        $str = str_replace(" ", "_", $file_name);
        //     echo "<pre>".print_r($_FILES, 1)."<pre>";
        // echo "asfd<pre>".print_r(array($extension, $size, $max_size), 1)."<pre>";exit();
        if ($size <= $max_size) {
            $extension = $customer->get_file_extension($str);
            if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt" || $extension == "xls" || $extension == "xlsx") {
              
                $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/documents_attach/";
                //$upload_path = "documents_attach/";
                $file_path = $upload_path . $str;
                // echo $file_path; exit();
                if (!file_exists($file_path)) {
                        
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                       
                        $datas = $employee->employee_documents_add($query_string[0], $str,$_SESSION['user_id']);
                        $message = 'document_add_success';
                        $type = "success";
                        $messages->set_message($type, $message);
                    } else {

                        $message = 'failed_to_post_documents';
                        $type = "fail";
                        $messages->set_message($type, $message);
                    }
                } else {
                    
                    $present = 0;
//                    $documents_file = $employee->get_all_files_user($query_string[0]);
//
//                    for ($x = 0; $x < count($documents_file); $x++) {
//                        $str1 = explode('.', $documents_file[$x]['documents']);
//                        $str1[0] = substr($str1[0], 0, -2);
//                        $str1 = $str1[0] . "." . $str1[1];
//                        if ($documents_file[$x]['documents'] == $str || $str == $str1) {
//                            $present = 1;
//                            break;
//                        }
//                    }
//                    if ($present == 1) {
//                        echo "<br>6";
//                        $message = 'file_exists';
//                        $type = "fail";
//                        $messages->set_message($type, $message);
//                        $error = "1";
//                    } else {
                        
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
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                            // echo $file_path;
                            $datas = $employee->employee_documents_add($query_string[0], $str,$_SESSION['user_id']);
                            $message = 'document_add_success';
                            $type = "success";
                            $messages->set_message($type, $message);
                        }
//                    }
                }
            } else {
                
                $message = 'file_selected_supported_extension';
                $type = "fail";
                $messages->set_message($type, $message);
            }
        } else {
            
            $message = 'exceeds_the_limit_file_size';
            $type = "fail";
            $messages->set_message($type, $message);
        }

    } elseif (isset($_POST['action']) && $_POST['action'] == '2') {
        $doc_id = $_POST['doc_id'];
        if($employee->delete_employee_attachment($doc_id)){
            $message = 'document_delete_success';
            $type = "success";
            $messages->set_message($type, $message);
        }else{
            $message = 'document_delete_fail';
            $type = "fail";
            $messages->set_message($type, $message);
        }
    }
    else if (isset($_POST['action']) && $_POST['action'] == '3'){
        $doc_id = $_POST['doc_id'];
        $check_status = $employee->check_documnet_status($doc_id);
        if($check_status == 1) {
            if($employee->change_document_status($doc_id,0)){
                $message = 'Document_Status_Changed';
                $type = "success";
                $messages->set_message($type, $message);
            }
            else{
                $message = 'document_delete_fail';
                $type = "fail";
                $messages->set_message($type, $message);
            }
            $smarty->assign('check_status',0);
        }
        else{
            if($employee->change_document_status($doc_id,1)){
                $message = 'Document_Status_Changed';
                $type = "success";
                $messages->set_message($type, $message);
            }
            else{
                $message = 'document_delete_fail';
                $type = "fail";
                $messages->set_message($type, $message);
            }
            $smarty->assign('check_status',1);
        }
    }
    $documents = $employee->employee_documents($query_string[0]);
    $smarty->assign('documents', $documents);
}
$smarty->assign('user_id', $_SESSION['user_id']);
$smarty->assign('user_roles_login', $_SESSION['user_role']);
$smarty->assign('message', $messages->show_message());
$smarty->assign('download_folder', $customer->get_folder_name($_SESSION['company_id']) . "/documents_attach");
$smarty->display('extends:layouts/dashboard.tpl|employee_documentations.tpl|layouts/sub_layout_employee_tabs.tpl');
?>