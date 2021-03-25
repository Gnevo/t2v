<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('plugins/message.class.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/general.php');
require_once('class/customer.php');
$employee = new employee();
$messages = new message();
$user = new user();
$obj_general = new general();
$customer = new customer();
$smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", 'company.xml'));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2, 'tabmenu'=>'employee_skills'));
$query_string = explode('&',$_SERVER['QUERY_STRING']);

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);


$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_cv'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if(!empty($query_string[0])){
    if(isset($_POST['action']) && $_POST['action'] == "1"){
        $error = 0;
        $names = array();
        $skill = $_POST['title'];
        $description = $_POST['skill_desc'];
        $date_of_exam = $_POST['date_of_qualification'];
        $emp = $query_string[0];
        for($i=0;$i<3;$i++){
            if($_FILES['file']['name'][$i] != ''){
                $names[] = $_FILES['file']['name'][$i];
            }
        }
        $max_size = 50000 * 1024; //50MB
         if(empty($names)){
            if($data = $employee->employee_skill_add($skill,$description,$date_of_exam,$emp,$_SESSION['user_id'])){
                $message = 'document_add_success';
                $type = "success";
                $messages->set_message($type, $message);
            }
            else{
                $message = 'failed_to_post_documents';
                $type = "fail";
                $messages->set_message($type, $message);
            }
        }
        else{
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/skills/";
            for($i = 0;$i<count($_FILES['file']['name']);$i++){
                if($_FILES['file']['name'][$i] != ''){
                    $size = $_FILES['file']['size'][$i]; 
                    $file_name = $_FILES['file']['name'][$i];
                    $str = str_replace(" ", "_", $file_name);
                    $file_names[] =  $str;
                // print_r($file_name);
                if ($size <= $max_size) {
                    $extension = $customer->get_file_extension($str);
                    if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt" ||$extension == "xls" ||$extension == "txt" ||$extension == "xlsx" ) {
                        
                        $temp_names[] = $_FILES['file']['tmp_name'][$i];
                         

                    }
                    else{
                        $error = 1;
                        $error_type = 'support';
                    }
                }
                else{
                    $error = 1;
                    $error_type = 'size';
                }
             }   
            }
            // echo count($file_names);exit();
            if($error != 1){
               
                // print_r($file_names);
                for ($i=0; $i<count($file_names); $i++) { 
                    
                    $str = str_replace(" ", "_", $file_names[$i]);
                    $file_path_check = $upload_path .$str;

                    // var_dump($file_path_check);
                    // exit('ffdg');
                    
                    if(!file_exists($file_path_check)){
                        $file_path[] = $upload_path .$str;
                        $upload_file_status =  move_uploaded_file($temp_names[$i],$file_path[$i]);
                        $changed_file_name[] = $str;
                    }
                    else{
                                $count = 0;
                                $x = 0;
                                $file_path_check = $upload_path .$str;
                                while ($x == 0) {
                                    if(file_exists($file_path_check)){
                                        $str = unique_files($str);
                                        $file_path_check = $upload_path .$str;
                                    }
                                    else{
                                        $x++;
                                    }
                                }
                                $file_path[] = $upload_path .$str;
                                $changed_file_name[] = $str;
                        
                        $upload_file_status =  move_uploaded_file($temp_names[$i],$file_path[$i]);
                    }
                }

                if($upload_file_status == true){

                    if($data = $employee->employee_skill_add($skill,$description,$date_of_exam,$emp,$_SESSION['user_id'],$changed_file_name)){
                        $message = 'document_add_success';
                        $type = "success";
                        $messages->set_message($type, $message);
                    }
                    else{
                        $message = 'failed_to_post_documents';
                        $type = "fail";
                        $messages->set_message($type, $message);
                    }
                }
            } 
            else{
                $message = 'failed_to_post_documents';
                if($error_type == 'size'){
                    $message = 'exceeds_the_limit_file_size';
                } 
                if($error_type == 'support'){
                    $message = 'file_selected_supported_extension_skill';
                }
                $type = "fail";
                $messages->set_message($type, $message);
            }
        }
       
        // exit();
       // if (move_uploaded_file($_FILES['file']['tmp_name'][$i],$file_path)) {
       //      echo 'fs';exit();
       //     
        // if($data = $employee->employee_skill_add($skill,$description,$emp)){
        //     $message = 'skills_adding_success';
        //     $type = "success";
        //     $messages->set_message($type, $message);
        // }else{
        //    $message = 'skills_adding_failed';
        //     $type = "fail";
        //     $messages->set_message($type, $message); 
        // }
        
    }
    elseif(isset($_POST['action']) && $_POST['action'] == "2"){
        $skill_id           = $_POST['skill_id'];
        $app_dir            = getcwd();
        $folder_name        = $customer->get_folder_name($_SESSION['company_id'])."/skills/";
        $skill_details      = $employee->get_employee_skill_by_id($skill_id);
        $delete_skill_array = array($skill_details['attachment1'],$skill_details['attachment2'],$skill_details['attachment3']);
        foreach ($delete_skill_array as $key => $value) {
            if($value != null){
                if(file_exists($app_dir."/".$folder_name.$value)){
                    @unlink($app_dir."/".$folder_name.$value);
                }
            }
        }
            if($employee->delete_employee_skill($skill_id)){
                $message = 'skills_deleting_success';
                $type = "success";
                $messages->set_message($type, $message); 
            }
            else{
                $message = 'skills_deleting_failed';
                $type = "fail";
                $messages->set_message($type, $message); 
            }

        
    }
    else if(isset($_POST['action']) && $_POST['action'] == "3"){
        $not_null_array = array();
        $app_dir        = getcwd();
        $skill_id       = $_POST['skill_h_id'];
        $skill          = $_POST['title'];
        $description    = $_POST['skill_desc'];
        $date_of_exam   = $_POST['date_of_qualification'];
        $columns        = $_POST['db_column'];
        $emp = $query_string[0];
        // print_r($_FILES['file']['name']);
        // print_r($_POST['db_column']); 
        $skill_details = $employee->get_employee_skill_by_id($skill_id);
        $folder_name = $customer->get_folder_name($_SESSION['company_id'])."/skills/";
        // echo $folder_name;
        // echo "<pre>".print_r($skill_details,1)."</pre>";
        if($columns){
            for($i=0;$i<count($columns);$i++){
                @unlink($app_dir."/".$folder_name.$skill_details[$columns[$i]]);
                $skill_details[$columns[$i]] = null;
                // $not_null_array[] = $skill_details[$columns[$i]];
            }   
        }
        $keys = array_keys($skill_details);
        // print_r($skill_details[$keys[4]]);
        // echo "<pre>".print_r($skill_details,1)."</pre>";
        for($i=4;$i<7;$i++){
           
                 $not_null_array[$keys[$i]] = $skill_details[$keys[$i]];
        }
        // echo "<pre>".print_r($not_null_array,1)."</pre>";
        // echo "<pre>".print_r($_FILES,1)."</pre>";
        if($_FILES){
            $max_size = 50000 * 1024;
            $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/skills/";
            for($i = 0;$i<count($_FILES['file']['name']);$i++){

                if($_FILES['file']['name'][$i] != ''){

                    $size = $_FILES['file']['size'][$i]; 
                    $file_name = $_FILES['file']['name'][$i];
                    $str = str_replace(" ", "_", $file_name);
                    $file_names[] =  $str;
                // print_r($file_name);
                if ($size <= $max_size) {
                    $extension = $customer->get_file_extension($str);
                    if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt" ||$extension == "xls" ||$extension == "txt" ||$extension == "xlsx" ) {
                        
                        $temp_names[] = $_FILES['file']['tmp_name'][$i];
                       
                    }
                    else{
                        $error = 1;
                        $error_type = 'support';
                    }
                }
                else{
                    $error = 1;
                    $error_type = 'size';
                }
             }   
            }

          

                // echo "<pre>".print_r($file_names,1)."</pre>"; 
                // echo "<pre>".print_r($not_null_array,1)."</pre>"; 
             if($error != 1){

                for ($i=0; $i <count($file_names); $i++) { 
                     $str = str_replace(" ", "_", $file_names[$i]);
                     $file_path_check = $upload_path .$str;
                    
                    if(!file_exists($file_path_check)){
                        $file_path[] = $upload_path .$str;
                        move_uploaded_file($temp_names[$i],$file_path[$i]);
                        $changed_file_name[] = $str;
                    }
                    else{
                                $count = 0;
                                $x = 0;
                                $file_path_check = $upload_path .$str;
                                while ($x == 0) {
                                    if(file_exists($file_path_check)){
                                        $str = unique_files($str);
                                        $file_path_check = $upload_path .$str;
                                    }
                                    else{
                                        $x++;
                                    }
                                }
                                $file_path[] = $upload_path .$str;
                                $changed_file_name[] = $str;
                        
                        move_uploaded_file($temp_names[$i],$file_path[$i]);
                    }
                }

                $key = array_keys($not_null_array);
                for($k=0,$j=0;$k<3;$k++){
                    if($not_null_array[$key[$k]] == null){
                         $not_null_array[$key[$k]] = $changed_file_name[$j];
                         $j++;
                    }
                }

                if($data = $employee->employee_skill_update($skill,$description,$skill_id,$date_of_exam,$_SESSION['user_id'],$not_null_array)){
                    $message = 'document_add_success';
                    $type = "success";
                    $messages->set_message($type, $message);
                }
                else{
                    $message = 'failed_to_post_documents';
                    $type = "fail";
                    $messages->set_message($type, $message);
                }
            } 
            else{
                $message = 'failed_to_post_documents';
                if($error_type == 'size'){
                    $message = 'exceeds_the_limit_file_size';
                } 
                if($error_type == 'support'){
                    $message = 'file_selected_supported_extension_skill';
                }
                $type = "fail";
                $messages->set_message($type, $message);
            }
        }
        else{
            $data = $employee->employee_skill_update($skill,$description,$skill_id,$date_of_exam,$_SESSION['user_id']);
        }
        // exit();


        // if($_POST['db_column']){
        //     for($i=0;$i<count($_FILES['file']['name']);$i++){
        //         if(empty($_FILES['file']['name'][$i]) && array_key_exists($i,$_FILES['file']['name'])){
        //             $employee->employee_skill_update($skill,$description,$skill_id,$_SESSION['user_id'],$_POST['db_column'][$i]);
        //         }
        //         else{
        //             $employee->employee_skill_update($skill,$description,$skill_id,$_SESSION['user_id'],$_POST['db_column'][$i],$_FILES['file']['name'][$i]);
        //         }
        //     }        
        // }
        // else{
        //     if(!empty($_FILES['file']['name'][0]) || !empty($_FILES['file']['name'][1]) || !empty($_FILES['file']['name'][2])){
        //         echo 'ddddd';
        //     }
        //     else{
        //         $employee->employee_skill_update($skill,$description,$skill_id,$_SESSION['user_id']);
        //     }
        // }
        // exit();

    }



    $employee_detail[0] = $employee->get_employee_detail($query_string[0]);
    $employee_detail[0]['social_security'] = substr($employee_detail[0]['social_security'], 0, 6) . "-" . substr($employee_detail[0]['social_security'], 6);
    $skills = $employee->employee_skills($query_string[0]);
    // echo "<pre>".print_r($skills,1)."</pre>"; exit();
    $smarty->assign('skills',$skills);
    $smarty->assign('employee_detail', $employee_detail);
    $smarty->assign('employee_username',$query_string[0]);
    $smarty->assign('employee_role', $user->user_role($query_string[0]));
}

  function unique_files($str){
        static $counter = 0;
        $counter++; 
        $name_parts = explode('.',$str);
        $name_part = $name_parts; 
        array_pop($name_part);
        $file_name_string = '';
        $file_name_string = implode('.',$name_part);
        return $file_name_string .'('.$counter.')'.'.'.end($name_parts);
    }
$smarty->assign('current_date',date('Y-m-d'));
$smarty->assign('download_folder',$customer->get_folder_name($_SESSION['company_id'])."/skills");
$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|employee_skills.tpl|layouts/sub_layout_employee_tabs.tpl');
?>