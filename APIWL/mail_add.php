<?php
//die(var_dump('ya na stv'));
require_once('class/setup.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml", "button.xml", "mail.xml"));
require_once('class/mail.php');
require_once('class/employee.php');
require_once('class/equipment.php');
require_once('class/customer.php');
$mail = new mail();
$equipment = new equipment();
$employee = new employee();
$messages = new message();
$customer = new customer();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
if ($_SERVER['QUERY_STRING']) {
    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $method = $query_string[0];
    $id_mail = $query_string[1];
    $smarty->assign('method', $method);
    $smarty->assign('id_mail', $id_mail);
    
    $mails = $mail->get_mail($id_mail,$method);
    $attachments = explode(',',$mails['attachments']);
    if(count($attachments) == 0){
        $smarty->assign('no_attach',1);
    }
    $smarty->assign('attachments',$attachments);
    $smarty->assign('old_files',$mails['attachments']);
    $smarty->assign('mails', $mails);
    $compony_id = $_SESSION['company_id'];
    $folder = $customer->get_folder_name($compony_id);
    $folder = $folder."/mail_attatch/";
    $smarty->assign('folder',$folder);
    
}

if ($_POST['to'] && $_POST['subject'] && $_POST['mail_body']) {
    if (isset($_POST['method']) && $_POST['method'] == 2) {
        $files_attached_old = $_POST['file_names'];
        $error =0;
        $upload_path = $smarty->url.$customer->get_folder_name($_SESSION['company_id']).'/mail_attatch/';
        $max_size = 50000 * 1024;
        if (strpos($_POST['to'], ', ')) {
            $to_mails = explode(',', $_POST['to']);
            if (substr($_POST['to'], -2) == ', ' || substr($_POST['to'], -2) == '),') {
                $count = count($to_mails) - 1;
            } else {
                $count = count($to_mails);
            }
        } else {
            $to_mails[0] = $_POST['to'];
            $count = 1;
        }

        for ($j = 0; $j < $count; $j++) {
            $error = 0;
            if (strpos($to_mails[$j], '(')) {
                $mailing = explode('(', $to_mails[$j]);
                $mailes = substr($mailing[1], 0, -1);
            } else {
                if (substr($to_mails[$j], 0, 1) == " ") {
                    $mailes = substr($to_mails[$j], 1);
                } else {
                    $mailes = $to_mails[$i];
                }
            }
            if($root_id = $mail->get_mail($_POST['id_mail'],$_POST['method'])){
                if($root_id['root_id'] == 0){
                    $mail->root_id = $_POST['id_mail'];
                }else{
                    $mail->root_id = $root_id['root_id'];
                }
            }
            else{
                $mail->root_id = $_POST['id_mail'];
            }
            
            $temp_files = "";
            for($i=0; $i<=count($_FILES['attachments']['name']);$i++){
                $temp_path = $_FILES['attachments']['tmp_name'][$i];
                if ($temp_path != "") {
                    $file_name = $_FILES['attachments']['name'][$i];
                    $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                    $str = str_replace(" ", "_", $file_name);
                    if ($size <= $max_size) {


                        $extension = $customer->get_file_extension($str);
                        if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                            //$upload_path = "document_decision/";
                            $file_path = $upload_path . $str;

                            if (file_exists($file_path)) {



                                    $num = 1;
                                    $x = 0;
                                    $str1 = explode('.',$str);
                                    $str = $str1[0]."_".$num.".".$str1[1];
                                    $file_path = $upload_path . $str;
                                    while($x == 0){
                                        if(file_exists($file_path)){                                            
                                            $num++;
                                            $str1 = explode('.',$str);
                                            $str1[0] = substr($str1[0],0,-2);
                                            $str = $str1[0]."_".$num.".".$str1[1];
                                            $file_path = $upload_path . $str;
                                        }
                                        else{
                                            $x++;
                                        }
                                    }
                                    move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                    if($temp_files == ""){
                                        $temp_files = $str;
                                    }  else {
                                        $temp_files = $temp_files.",".$str;
                                    }

                            } else {

                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                if($temp_files == ""){
                                    $temp_files = $str;
                                }  else {
                                    $temp_files = $temp_files.",".$str;
                                }

                                //                             else {
                                //                                  
                                //                                $message = 'failed_to_post_documents';
                                //                                $type = "fail";
                                //                                $error = 1;
                                //                            }
                            }
                        } else {

                            $message = 'file_selected_supported_extension';
                            $type = "fail";
                            $error = 1;
                        }
                    } else {

                        $message = 'exceeds_the_limit_file_size';
                        $type = "fail";
                        $error = 1;
                    }
                } 
            }
        
            if ($error == 0) {
                
                // $to_emp = explode(',',$_POST['to']);
                if($root_id = $mail->get_mail($_POST['id_mail'],$_POST['method'])){
                    if($root_id['root_id'] == 0){
                        $mail->root_id = $_POST['id_mail'];
                    }else{
                        $mail->root_id = $root_id['root_id'];
                    }
                }
                else{
                    $mail->root_id = $_POST['id_mail'];
                }
                $mail->method = 2;
                $mail->from = $_SESSION['user_id'];
                $mail->to = $mailes;
                $mail->subject = $_POST['subject'];
                //$mail->mail_date = date('Y-m-d H:i:s');
                $mail->message = $_POST['mail_body'];
                if($files_attached_old != ""){
                    if($temp_files == ""){
                        $mail->attachments = $files_attached_old;
                    }else{
                        $mail->attachments = $temp_files.",".$files_attached_old;
                    }
                }else{
                    $mail->attachments = $temp_files;//$_POST['attachement'];
                }
                $mail->status = 0; //indicate unread mail
                if ($mail->insert_mail()) {
                    $message = 'mail_send_sucesfully';
                    $type = "success";
                    $messages->set_message($type, $message);
                } else {
                    $message = 'mail_send_fail';
                    $type = "fail";
                    $messages->set_message($type, $message);
                }
                
                $smarty->assign('message', $messages->show_message());
            }
        }
        //$smarty->assign('message', $messages->show_message());
    } else if (isset($_POST['method']) && $_POST['method'] == 1) {

        $max_size = 2000 * 1024;
        $compony_id = $_SESSION['company_id'];
        $upload_path = $customer->get_folder_name($compony_id);
        $upload_path = $upload_path . "/mail_attatch/";
        $error = 0;
        $temp_files = "";
            for($i=0; $i<=count($_FILES['attachments']['name']);$i++){
                $temp_path = $_FILES['attachments']['tmp_name'][$i];
                if ($temp_path != "") {
                    $file_name = $_FILES['attachments']['name'][$i];
                    $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                    $str = str_replace(" ", "_", $file_name);
                    if ($size <= $max_size) {


                        $extension = $customer->get_file_extension($str);
                        if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                            //$upload_path = "document_decision/";
                            $file_path = $upload_path . $str;

                            if (file_exists($file_path)) {



                                    $num = 1;
                                    $x = 0;
                                    $str1 = explode('.',$str);
                                    $str = $str1[0]."_".$num.".".$str1[1];
                                    $file_path = $upload_path . $str;
                                    while($x == 0){
                                        if(file_exists($file_path)){                                            
                                            $num++;
                                            $str1 = explode('.',$str);
                                            $str1[0] = substr($str1[0],0,-2);
                                            $str = $str1[0]."_".$num.".".$str1[1];
                                            $file_path = $upload_path . $str;
                                        }
                                        else{
                                            $x++;
                                        }
                                    }
                                    move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                    if($temp_files == ""){
                                        $temp_files = $str;
                                    }  else {
                                        $temp_files = $temp_files.",".$str;
                                    }

                            } else {

                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                if($temp_files == ""){
                                    $temp_files = $str;
                                }  else {
                                    $temp_files = $temp_files.",".$str;
                                }

                                //                             else {
                                //                                  
                                //                                $message = 'failed_to_post_documents';
                                //                                $type = "fail";
                                //                                $error = 1;
                                //                            }
                            }
                        } else {

                            $message = 'file_selected_supported_extension';
                            $type = "fail";
                            $error = 1;
                        }
                    } else {

                        $message = 'exceeds_the_limit_file_size';
                        $type = "fail";
                        $error = 1;
                    }
                } 
            }
        
        if ($error == 0) {
            // $to_emp = explode(',',$_POST['to']);
            if($root_id = $mail->get_mail($_POST['id_mail'],$_POST['method'])){
                if($root_id['root_id'] == 0){
                    $mail->root_id = $_POST['id_mail'];
                }else{
                    $mail->root_id = $root_id['root_id'];
                }
            }
            else{
                $mail->root_id = $_POST['id_mail'];
            }
            $mail->method = 1;
            $mail->from = $_SESSION['user_id'];
            $mail->to = $_POST['to'];
            $mail->subject = $_POST['subject'];
            //$mail->mail_date = date('Y-m-d H:i:s');
            $mail->message = $_POST['mail_body'];
            $mail->attachments = $temp_files; //$_POST['attachement'];
            $mail->status = 0; //indicate unread mail
            if ($mail->insert_mail()) {
                $message = 'mail_send_sucesfully';
                $type = "success";
                $messages->set_message($type, $message);
            } else {
                $message = 'mail_send_fail';
                $type = "fail";
                $messages->set_message($type, $message);
            }
            $smarty->assign('message', $messages->show_message());
        }
    } else {//echo 'hi';
        $max_size = 2000 * 1024;
        $compony_id = $_SESSION['company_id'];
        $upload_path = $customer->get_folder_name($compony_id);
        $upload_path = $upload_path . "/mail_attatch/";
        $error = 0;
        

        $temp_files = "";
            for($i=0; $i<=count($_FILES['attachments']['name']);$i++){
                $temp_path = $_FILES['attachments']['tmp_name'][$i];
                if ($temp_path != "") {


                    $file_name = $_FILES['attachments']['name'][$i];
                    $size = filesize($_FILES['attachments']['tmp_name'][$i]);
                    $str = str_replace(" ", "_", $file_name);

                    if ($size <= $max_size) {


                        $extension = $customer->get_file_extension($str);
                        if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {

                            //$upload_path = "document_decision/";
                            $file_path = $upload_path . $str;

                            if (file_exists($file_path)) {

                               $num = 1;
                                    $x = 0;
                                    $str1 = explode('.',$str);
                                    $str = $str1[0]."_".$num.".".$str1[1];
                                    $file_path = $upload_path . $str;
                                    while($x == 0){
                                        if(file_exists($file_path)){                                            
                                            $num++;
                                            $str1 = explode('.',$str);
                                            $str1[0] = substr($str1[0],0,-2);
                                            $str = $str1[0]."_".$num.".".$str1[1];
                                            $file_path = $upload_path . $str;
                                        }
                                        else{
                                            $x++;
                                        }
                                    }
                                    move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                    if($temp_files == ""){
                                        $temp_files = $str;
                                    }  else {
                                        $temp_files = $temp_files.",".$str;
                                    }
                            } else {

                                move_uploaded_file($_FILES['attachments']['tmp_name'][$i], $file_path);
                                if($temp_files == ""){
                                    $temp_files = $str;
                                }  else {
                                    $temp_files = $temp_files.",".$str;
                                }

        //                             else {
        //                                  
        //                                $message = 'failed_to_post_documents';
        //                                $type = "fail";
        //                                $error = 1;
        //                            }
                            }
                        } else {

                            $message = 'file_selected_supported_extension';
                            $type = "fail";
                            $error = 1;
                        }
                    } else {

                        $message = 'exceeds_the_limit_file_size';
                        $type = "fail";
                        $error = 1;
                    }
                }
            }
        
        if ($error != 1) {
            if (strpos($_POST['to'], ',')) {
                $to_mails = explode(',', $_POST['to']);
                if (substr($_POST['to'], -2) == ', ' || substr($_POST['to'], -2) == '),') {
                    $count = count($to_mails) - 1;
                } else {
                    $count = count($to_mails);
                }
            } else {
                $to_mails[0] = $_POST['to'];
                $count = 1;
            }
            for ($i = 0; $i < $count; $i++) {
                if (strpos($to_mails[$i], '(')) {
                    $mailing = explode('(', $to_mails[$i]);
                    $mailes = substr($mailing[1], 0, -1);
                } else {
                    if (substr($to_mails[$i], 0, 1) == " ") {
                        $mailes = substr($to_mails[$i], 1);
                    } else {
                        $mailes = $to_mails[$i];
                    }
                }
                $mail->root_id = 0;
                $mail->method = 0;
                $mail->from = $_SESSION['user_id'];
                $mail->to = $mailes;
                $mail->subject = $_POST['subject'];
                //$mail->mail_date = date('Y-m-d H:i:s');
                $mail->message = $_POST['mail_body'];
                $mail->attachments = $temp_files; //$_POST['attachement'];
                $mail->status = 0; //indicate unread mail
                if ($mail->insert_mail()) {
                    $message = 'mail_send_sucesfully';
                    $type = "success";
                    $messages->set_message($type, $message);
                } else {
                    $message = 'mail_send_fail';
                    $type = "fail";
                    $messages->set_message($type, $message);
                }
            }

            $smarty->assign('message', $messages->show_message());
        }
    }
}   
$exact_employees = $equipment->employee_mailable($_SESSION['user_id']);
$smarty->assign('employees', $exact_employees);

/* if($_SERVER['QUERY_STRING'])
  {
  $timing = $mail->get_mail_by_id($_SERVER['QUERY_STRING']);
  $timing[0]['effect_from'] = $timing[0]['effect_from'];
  $timing[0]['time_from'] = $inc_timing->convert_time_part($timing[0]['time_from']);
  $timing[0]['time_to'] = $inc_timing->convert_time_part($timing[0]['time_to']);

  $days = explode(",",$timing[0]['days']);
  //array_pop($days);
  for($j = 0;$j<count($w_days);$j++)
  {
  if(($n = array_search($j+1,$days)) !== FALSE)
  $d[$w_days[$j]] = 1;
  else
  $d[$w_days[$j]] = 0;
  }//print_r($d);
  $smarty->assign('days', $d);
  } */

$smarty->display('extends:layouts/dashboard.tpl|mail_add_new.tpl');
?>