<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/contract.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/mail.php');
require_once('class/dona.php');
require_once('plugins/message.class.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
require_once('class/employee_ext.php');

$contract    = new contract();
$messages    = new message();
$customer    = new customer();
$employee    = new employee();
$equipment   = new equipment();
$newcustomer = new newcustomer();
$newemployee = new newemployee();
$dona        = new dona();
$user        = new user();
$obj_emp     = new employee_ext();

$smarty = new smartySetup(array("messages.xml", "button.xml","month.xml","forms.xml","reports.xml", "gdschema.xml", "user.xml", "mail.xml", "employee.xml"));
global $week;
$smarty->assign('week', $week);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$emp = $_SESSION['user_id'];
$employee_role = $user->user_role($emp);
$smarty->assign('employee_role', $user->user_role($emp));
$employee->role = $employee_role;
global $company, $preference;
$hash = $preference['hash'];
$smarty->assign('hash',$hash);
$smarty->assign('passwrd',$contract->get_password($_SESSION['user_id']));
$employee_detail_temp = $employee->employee_detail_main($emp);
$employee->social_security = $employee_detail_temp[0]['social_security'];
$query_string = explode('&',$_SERVER['QUERY_STRING']);

$smarty->assign('user_id',$_SESSION['user_id']);
$preference_mode = isset($_POST['pref_selection'])?$_POST['pref_selection']:(isset($_SESSION['preference_mode'])?$_SESSION['preference_mode']:1);
$smarty->assign('preference_mode',$preference_mode);

$selected_email_options_number = $obj_emp->get_email_option_of_employee($_SESSION['user_id'])['email'];
$selected_email_options_number = explode(",",$selected_email_options_number);
array_pop($selected_email_options_number);
$smarty->assign('selected_email_options', $selected_email_options_number);
// echo 'dfgdfgfg';
// var_dump($selected_email_options_number);
// exit('fdg');


if($query_string[3] == "print"){
    $dona->Employee_contract_pdf($query_string[2],$query_string[1]);
}
if($query_string[3] == "sign"){
    $data=$contract->employee_contract_detail($query_string[1]);
    /*
        sreerag  Last Edit date:6/02/2018  sending mail for contracts
    */
    if($data){
        if($data['employee']==$_SESSION['user_id']){
            $contract_mail=$dona->sign_contract($query_string[1]);
            if($contract_mail==true){
                $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
                $company_detail = $customer->get_company_detail($_SESSION['company_id']);
                $contact_person = $company_detail['contact_person1'];
                $company_home = $company_detail['website'];
                $cirrus_link = $company['website'];
                $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_details['first_name']. ' '. $employee_details['last_name'] : $employee_details['last_name']. ' '. $employee_details['first_name'];
                $contract_alloc_employee = $data['alloc_employee'];
                $contract_current_employee = $data['employee'];
                $contract_current_emp_det = $employee->employee_detail("'" . $contract_current_employee . "'");
                $contract_current_employee_email=$contract_current_emp_det[0]['email'];
                $contract_alloc_emp_det = $employee->employee_detail( "'" . $contract_alloc_employee . "'");
                $contract_alloc_employee_email=$contract_alloc_emp_det[0]['email'];
                $subject = $smarty->translate[contract_acknowledgement_mail_subject];
                $msg_header = $smarty->translate[contract_acknowledgement_mail_message].'<br><br><br>';
                // if( $_SESSION['company_sort_by']==1){
                //     $msg .=$smarty->translate[contract_employee_name].$contract_current_emp_det[0]['first_name'].' '.$contract_current_emp_det[0]['last_name'].'<br><br>';
                // }
                // if( $_SESSION['company_sort_by']==2){
                //     $msg .=$smarty->translate[contract_employee_name].$contract_current_emp_det[0]['last_name'].' '.$contract_current_emp_det[0]['first_name'].'<br><br>';
                // }
                // echo $data['sign_date']; exit('dfd');
                $msg = $smarty->translate[contract_employee_signed_date].''.$data['sign_date'].'<br><br>';
                $msg .= $smarty->translate[click_here_to_see_more_details].'<br>'.$smarty->url . 'employee/administration/4/'.$query_string[1].'/' . $data['employee'] . '/print/';
                $msg_footer = mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_details);
                $msg = $msg_header.$msg.$msg_footer;
                mail_send($msg,$subject,$employee_details,$company_detail,$contract_alloc_emp_det);
                $messages->set_message("success", 'contract_hasbeen_signed');
            }
        }else{
            $messages->set_message("fail", 'contract_employee_has_no_privilege');
        }
    }else{
        $messages->set_message("fail", 'contract_employee_has_no_exists');
    }

    header('Location: ' . $smarty->url . 'employee/administration/');
    exit();
    /*
        sreerag  Last Edit date:6/02/2018  sending mail for contracts
    */
}
$smarty->assign('tab',$query_string[0]);
if (!empty($_POST['first_name'])){
    $new_email_options = array('25','27');
    $email_option      = $checked_option = $_POST['email_option'];
    if(empty($email_option)) {
        $email_option = array();
    }
    // exit('fgfd');
        $selected_email_options = $obj_emp->get_email_option_of_employee($_SESSION['user_id']);
        // insert email_options of employee
    if(empty($selected_email_options)){  
        $obj_emp->insert_email_options($_SESSION['user_id'],$email_option);
    }
    // update email_options of employee
    else{
        $action = 'update';
        $exist_email_options = explode(",",$selected_email_options['email']);
        array_pop($exist_email_options);
        // exit('fd');
        $uncheked_options    = array_diff($new_email_options,$email_option);

        if(empty($uncheked_options)){
            $uncheked_options = $checked_option = $new_email_options;
        }
        if(!empty($uncheked_options)){
            foreach ($uncheked_options as $key => $value) {
                if(in_array($value, $exist_email_options)){
                    if (($key = array_search($value, $exist_email_options)) !== false) {
                        // unset($exist_email_options[$key]);
                        array_splice($exist_email_options, $key, 1);
                    }
                }
            }
        }
        // var_dump($exist_email_options);
        // var_dump($exist_email_options,$checked_option);
        if($email_option == null){
            $new_email_options_insert = $exist_email_options;
        }
        else{
            foreach ($email_option as $key => $value) {
                if(!in_array($value, $exist_email_options)){
                    $exist_email_options[] = $value;
                }
            }
            $new_email_options_insert = $exist_email_options;
            // $new_email_options_insert = array_merge($exist_email_options,$checked_option);
        }
        if($new_email_options_insert[0] == ''){
            $action = 'delete';
        }
        $obj_emp->insert_email_options($_SESSION['user_id'],$new_email_options_insert,$action);
    }
    
    $change_msg='';
    $mobile = "";
    if(isset($_POST['mobile']) && $_POST['mobile'] != ""){
        $mobile = strip_tags($_POST['mobile']);
        $mobile = str_replace("-", "", $mobile);
        $mobile = str_replace(" ", "", $mobile);
        $mobile = str_replace(",", "", $mobile);
        $mobile = str_replace(".", "", $mobile);
        $mobile = str_replace("_", "", $mobile);
        while (substr($mobile,0,1) == '0' && strlen($mobile )>=1) { $mobile = substr($mobile,1,9999); }
        $phone = strip_tags($_POST['phone']);
        $phone = str_replace("-", "", $phone);
        $phone = str_replace(" ", "", $phone);
        $phone = str_replace(",", "", $phone);
        $phone = str_replace(".", "", $phone);
        $phone = str_replace("_", "", $phone);
        while (substr($phone,0,1) == '0' && strlen($phone )>=1) { $phone = substr($phone,1,9999); }
        
    }else{
        $mobile = strip_tags($_POST['mobile']);
    }
    $employee->first_name = strip_tags($_POST['first_name']);
    $employee->last_name = strip_tags($_POST['last_name']);
    $employee->password = strip_tags($_POST['password']);
    $employee->username = $_SESSION['user_id'];
    $employee->code = strip_tags($_POST['code']);
    // $employee->social_security = strip_tags($_POST['social_security']);
    $employee->address = strip_tags($_POST['adress']);
    $employee->city = strip_tags($_POST['city']);
    $employee->post = strip_tags($_POST['post']);
    $employee->phone = $phone;
    $employee->mobile = $mobile;
    $employee->email = strip_tags($_POST['email']);
    $employee->date = $_POST['date'];
    //$employee->status = $_POST['status'];
    $employee->company_id = $_SESSION['company_id'];
    $employee->ice = trim(strip_tags($_POST['txt_ice'])) != '' ? trim(strip_tags($_POST['txt_ice'])) : NULL;
    $employee->begin_transaction();
    $employee_old_details=$employee->get_employee_detail($_SESSION['user_id']);
    $company_detail = $customer->get_company_detail($_SESSION['company_id']);
    $contact_person = $company_detail['contact_person1'];
    $company_home = $company_detail['website'];
    $cirrus_link = $company['website'];
    $logged_employee_name=$_SESSION['company_sort_by'] == 1 ? $employee_old_details['first_name']. ' '. $employee_old_details['last_name'] : $employee_old_details['last_name']. ' '. $employee_old_details['first_name'];
    if ($employee->login_update(TRUE)) {
            if ($employee->employee_update_self()) {
                // echo "<pre>".print_r($employee->query_error_details, 1)."<pre>";
                /*
                    sreerag  Last Edit date:8/02/2018  sending mail for upading employee details
                */
                $change_msg_header  =$smarty->translate['employee_upadte_mail_message'].'<br><br><br>';
                $change_msg  = $employee->address != $employee_old_details['address'] ? $smarty->translate['employee_address_update']. ' : ' . $employee->address. ($employee_old_details['address'] != '' ? '('.$employee_old_details['address'].')' : '' ).'<br>' : '';
                $change_msg .= $employee->post != $employee_old_details['post'] ?  $smarty->translate['employee_post_update']. ' : ' .$employee->post. ($employee_old_details['post'] != '' ? '('.$employee_old_details['post'].')' : '' ).'<br>' : '';
                $change_msg .= $employee->city != $employee_old_details['city'] ?  $smarty->translate['employee_city_update']. ' : ' .$employee->city. ($employee_old_details[0]['city'] != '' ? '('.$employee_old_details['city'].')' : '' ).'<br>' : '';
                $change_msg .= $employee->phone != $employee_old_details['phone'] ?  $smarty->translate['employee_phone_update']. ' : ' .$employee->phone. ($employee_old_details['phone'] != '' ? '('.phone_check($employee_old_details['phone'],'phone').')' : '' ).'<br>' : '';
                $change_msg .= $employee->mobile != $employee_old_details['mobile'] ?  $smarty->translate['employee_mobile_update']. ' : ' .$employee->mobile. ($employee_old_details['mobile'] != '' ? '('.phone_check($employee_old_details['mobile'],'mobile').')' : '' ).'<br>' : '';
                $change_msg .= $employee->email != $employee_old_details['email'] ?  $smarty->translate['employee_email_update']. ' : ' .$employee->email. ($employee_old_details['email'] != '' ? '('.$employee_old_details['email'].')' : '' ).'<br>' : '';
                $change_msg .= $employee->date != $employee_old_details['date'] ?  $smarty->translate['employee_date_update']. ' : ' .$employee->date. ($employee_old_details['date'] != '' ? '('.$employee_old_details['date'].')' : '' ).'<br>' : '';
                $change_msg .= $employee->ice != $employee_old_details['ice'] ?  $smarty->translate['employee_ice_update']. ' : ' .$employee->ice. ($employee_old_details['ice'] != '' ? '('.$employee_old_details['ice'].')' : '' ).'<br>' : '';
                $msg_password_emp = $employee->password  ?  $smarty->translate['employee_password_update']. ' : ' .$employee->password.'<br>' : '';
                $msg_password_con = $employee->password  ?  $smarty->translate['employee_password_changed'] : '' ;

                // $change_msg .= $employee->password  ?  $smarty->translate['employee_password_update']. ' : ' .$employee->password.'<br>' : '';
                $change_msg_footer = mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_old_details);
                $change_msg = array(
                    'change_msg_emp' => $change_msg_header.$change_msg.$msg_password_emp.$change_msg_footer,
                    'change_msg_con' => $change_msg_header.$change_msg.$msg_password_con.$change_msg_footer
                );
                if(!empty($change_msg)){
                    $subject_update                = $smarty->translate['employee_update_mail_subject'];
                    mail_send_employee_send($change_msg,$subject_update,$employee_old_details,$company_detail);
                }
                 /*
                    sreerag  Last Edit date:8/02/2018  sending mail for upading employee details
                */
                $employee->commit_transaction();
                $message = 'employee_updating_success';
                $type = "success";
                $messages->set_message($type, $message);

            } else {
                $employee->rollback_transaction();
                $message = 'employee_updating_failed';
                $type = "fail";
                $messages->set_message($type, $message);
            }
        } else {

            $message = 'employee_updating_failed';
            $type = "fail";
            $messages->set_message($type, $message);
        }
        header('Location: ' . $smarty->url . 'employee/administration/');
        exit();
} 
$employee_detail_temp = $employee->employee_detail_main($emp);
$social_security = $employee_detail_temp[0]['social_security'];
$smarty->assign('social_security_check', $user->social_security_check($social_security));
if($employee_detail_temp[0]['mobile'] != ""){
    $length_mobile_display = (strlen($employee_detail_temp[0]['mobile'])-5)/2;
    //$employee_detail_temp[0]['mobile'] = "0".substr($employee_detail_temp[0]['mobile'], 0,2) . "-" . substr($employee_detail_temp[0]['mobile'], 2,3)." ".substr($employee_detail_temp[0]['mobile'], 5,2)." ".substr($employee_detail_temp[0]['mobile'], 7,2)." ".substr($employee_detail_temp[0]['mobile'],9,2);
    $temp_mobile = '';
    $pos = 5;
    for($i=0;$i<$length_mobile_display;$i++){
        $temp_mobile = $temp_mobile." ".substr($employee_detail_temp[0]['mobile'], $pos,2);
        $pos = $pos +2;
    }
    $employee_detail_temp[0]['mobile'] = "0".substr($employee_detail_temp[0]['mobile'], 0,2) . "-" . substr($employee_detail_temp[0]['mobile'], 2,3)." ".$temp_mobile;
}
$employee_detail_temp[0]['social_security'] = substr($employee_detail_temp[0]['social_security'], 0, -4) . "-" . substr($employee_detail_temp[0]['social_security'], 6);
$smarty->assign('employee_detail', $employee_detail_temp);

$current_team = $employee->get_current_team();
$current_team[0]['tl'] = $employee->get_employee_name("'" . $current_team[0]['tl'] . "'");
$smarty->assign('current_team', $current_team);
//get team leader name
$available_team = $employee->get_available_team($current_team[0]['id']);
for ($i = 0; $i < count($available_team); $i++) {
    $available_team[$i]['tl'] = $employee->get_employee_name("'" . $available_team[$i]['tl'] . "'");
}
$smarty->assign('available_team', $available_team);

/*
            sreerag  Last Edit date:8/02/2018  sending mail for deleting document & skill.
*/

if(isset($query_string[1])){
    $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
    $company_detail = $customer->get_company_detail($_SESSION['company_id']);
    $contact_person = $company_detail['contact_person1'];
    $company_home = $company_detail['website'];
    $cirrus_link = $company['website'];
    $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_details['first_name']. ' '. $employee_details['last_name'] : $employee_details['last_name']. ' '. $employee_details['first_name'];
    if($query_string[0] == 1){
        $app_dir = getcwd();
        $file_name = $employee->get_file_name_employee_attachment($query_string[1]);
        $folder_name = $customer->get_folder_name($_SESSION['company_id'])."/documents_attach/";
        @unlink($app_dir."/".$folder_name.$file_name['documents']);
        $data = $employee->delete_employee_attachment($query_string[1]);
        if($data){ 
                $subject = $smarty->translate['employee_upload_document_deletion_subject'];
                $msg_header = $smarty->translate['employee_upload_document_deletion_message'].'<br><br><br>';
                $msg = $smarty->translate['employee_delete_filename'].' : '.$file_name['documents'].'<br>';
        }
        //header("location:".$smarty->url."employee/administration/03/");
        $smarty->assign('tab','03');
    }
    else if($query_string[0] == 2){
        $skill_id           = $query_string[1];
        $app_dir            = getcwd();
        $folder_name        = $customer->get_folder_name($_SESSION['company_id'])."/skills/";
        $skill_name         = $employee->get_employee_skill_by_id($skill_id);
        $delete_skill_array = array($skill_name['attachment1'],$skill_name['attachment2'],$skill_name['attachment3']);
        foreach ($delete_skill_array as $key => $value) {
            if($value != null){
                if(file_exists($app_dir."/".$folder_name.$value)){
                    @unlink($app_dir."/".$folder_name.$value);
                }
            }
        }
        if($data = $employee->delete_employee_skill($skill_id)){
                $message = 'skills_deleting_success';
                $type = "success";
                $messages->set_message($type, $message); 
            }
            else{
                $message = 'skills_deleting_failed';
                $type = "fail";
                $messages->set_message($type, $message); 
            }



        if($data){
            $subject=$smarty->translate['employee_skill_deletion_subject'];
            $msg_header = $smarty->translate['employee_skill_deletion_message'].'<br><br><br>';
            $msg =$smarty->translate['employee_delete_skillname'].' : '.$skill_name['skill'].'<br>';
        }
        // header("location:".$smarty->url."employee/administration/02/");

        $smarty->assign('tab','02');
    }
    if($query_string[0] == 1 || $query_string[0] == 2){
        $msg_footer=mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_details);
        $msg=$msg_header.$msg.$msg_footer;
        mail_send($msg,$subject,$employee_details,$company_detail);
    }
}
/*
            sreerag  Last Edit date:8/02/2018  sending mail for deleting document & skill.
*/
if(isset($_POST['save_doc'])){
    $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
    $company_detail = $customer->get_company_detail($_SESSION['company_id']);
    $contact_person = $company_detail['contact_person1'];
    $company_home = $company_detail['website'];
    $cirrus_link = $company['website'];
    $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_details['first_name']. ' '. $employee_details['last_name'] : $employee_details['last_name']. ' '. $employee_details['first_name'];
    $subject=$smarty->translate['employee_documentation_upload'];
    $msg_header = $smarty->translate['employee_documentation_upload_message'].'<br><br><br>'; 
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") { 

        $max_size = 50000 * 1024;        
        $file_name = $_FILES['file']['name'];
        $size = filesize($_FILES['file']['tmp_name']);
        $str = str_replace(" ", "_", $file_name );
        if ($size <= $max_size) {  
            $extension = $customer->get_file_extension($str);
            if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt" || $extension == "xls"
||$extension == "xlsx") { 
        
               $upload_path = $customer->get_folder_name($_SESSION['company_id'])."/documents_attach/";
                //$upload_path = "documents_attach/";
                $file_path = $upload_path . $str;
                if(!file_exists($file_path)){
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                        $msg = $smarty->translate['employee_upload_filename'].' : '.$str.'<br>';
                         $datas = $employee->employee_documents_add($emp,$str,$_SESSION['user_id']);
                        $message = 'document_add_success';
                        $type = "success";
                        $messages->set_message($type, $message);
                        $msg_footer = mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_details);
                        $msg = $msg_header.$msg.$msg_footer;
                        mail_send($msg,$subject,$employee_details,$company_detail);
    
                    } else {

                        $message = 'failed_to_post_documents';
                        $type = "fail";
                        $messages->set_message($type, $message);
                    }
                }
                else{
                    $present = 0;
                    $documents_file = $employee->get_all_files_user($_SESSION['user_id']);
                    
                    for($x=0;$x<count($documents_file);$x++){
                        $str1 = explode('.',$documents_file[$x]['documents']);
                        $str1[0] = substr($str1[0],0,-2);
                        $str1 = $str1[0].".".$str1[1];
                        if($documents_file[$x]['documents'] == $str || $str == $str1 ){
                            $present = 1;
                            break;
                        }
                    }
                    if($present == 1){
                        $message = 'file_exists';
                        $type = "fail";
                        $messages->set_message($type, $message);
                        $error = "1";
                    }
                    else{
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
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                            $msg = $smarty->translate['employee_upload_filename'].' : '.$str.'<br>';
                            $datas = $employee->employee_documents_add($emp,$str,$_SESSION['user_id']);
                            $message = 'document_add_success';
                            $type = "success";
                            $messages->set_message($type, $message);
                            $msg_footer = mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_details);
                            $msg = $msg_header.$msg.$msg_footer;
                            mail_send($msg,$subject,$employee_details,$company_detail);
    
                        }   
                          

                        }
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
    }
    //$smarty->assign('message', $messages->show_message());
    //$datas = $employee->employee_documents_add($emp,$file_name);
   // header("location:".$smarty->url."employee/administration/03/");
    /*
            sreerag  Last Edit date:8/02/2018  sending mail for uploading document by employee.
    */
    
    $smarty->assign('tab','03');
}
/*
            sreerag  Last Edit date:8/02/2018  sending mail for skill added by employee.
*/
if(isset($_POST['add_skills'])){
    $names = array();
    $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
    $company_detail = $customer->get_company_detail($_SESSION['company_id']);
    $emp = $_SESSION['user_id'];
    $skill = $_POST['skills'];
    $description = $_POST['description'];
    $contact_person = $company_detail['contact_person1'];
    $company_home = $company_detail['website'];
    $cirrus_link = $company['website'];
    $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_details['first_name']. ' '. $employee_details['last_name'] : $employee_details['last_name']. ' '. $employee_details['first_name'];
    if($_POST['skills'] != '' && $_POST['description'] != '') {
        for($i=0;$i<3;$i++){
            if($_FILES['file']['name'][$i] != ''){
                $names[] = $_FILES['file']['name'][$i];
            }
        }
        $max_size = 50000 * 1024; //50MB
         if(empty($names)){
            if($data = $employee->employee_skill_add($skill,$description,$emp,$_SESSION['user_id'])){
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

            if($error != 1){
                for ($i=0; $i<count($file_names); $i++) { 
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

                if($data = $employee->employee_skill_add($skill,$description,$emp,$_SESSION['user_id'],$changed_file_name)){
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



        // $data = $employee->employee_skill_add($skill,$description,$emp,$_SESSION['user_id']);

        if($data){
            $subject = $smarty->translate['employee_add_skill_subject'];
            $msg_header = $smarty->translate['employee_add_skill_message'].': <br><br><br>';
            $msg  = $smarty->translate['employee_add_skill_name'].' : '.$skill.'<br>';
            $msg .= $smarty->translate['employee_add_skill_description'].' : '.$description .'<br>';
            $msg_footer = mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_details);
            $msg = $msg_header.$msg.$msg_footer;
            mail_send($msg,$subject,$employee_details,$company_detail);
        }
        // header("location:".$smarty->url."employee/administration/");

        header('Location: ' . $smarty->url . 'employee/administration/');
        exit();
    }
}
/*
            sreerag  Last Edit date:8/02/2018  sending mail for skill added by employee.
*/

$smarty->assign('message', $messages->show_message());
$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass', $pass);
$customers = $customer->customer_of_employee($emp);
//echo "<pre>".print_r($customers,1)."</pre>";exit();
$skills = $employee->employee_skills($emp);
// echo "<pre>".print_r($skills,1)."</pre>"; exit();
//documents page
$move = $_GET['move'];
$smarty->assign('move',$move);
$documents = $employee->employee_documents($emp);
$smarty->assign('documents',$documents);
$smarty->assign('employee',$emp);
$smarty->assign('download_folder',$customer->get_folder_name($_SESSION['company_id'])."/documents_attach");
//contract sign
$employee_normal_dates = $employee->get_all_salary_dates($emp,1);
$employee_inconvenient_dates = $employee->get_all_salary_dates_inconv($emp);
$smarty->assign('employee_normal_dates',$employee_normal_dates);
$smarty->assign('employee_inconvenient_dates',$employee_inconvenient_dates);
$contract_sign = $contract->get_contracts_employee($emp);
$smarty->assign("contracts",$contract_sign);
if((isset($_GET['normal_select']) && $_GET['normal_select'] != "") || (isset($_GET['inconv_select']) && $_GET['inconv_select'] != "")){
    
    if($_GET['inconv_select'] == '0')
        $_GET['inconv_select'] = $employee->get_last_id($emp,2);
    if($_GET['normal_select'] == '0')
        $_GET['normal_select'] = $employee->get_last_id($emp,1);
    $smarty->assign('normal_last_id',$_GET['normal_select']);
    $smarty->assign('inconv_last_id',$_GET['inconv_select']);
    $smarty->assign('normal_salaries',$employee->get_normal_sal_acc_id($_GET['normal_select']));
    $smarty->assign('inconveninet_salaries',$employee->get_inconv_sal_acc_id($_GET['inconv_select']));
    $smarty->assign('effects',$employee->get_effects_acc_id($_GET['inconv_select']));
}else{
    $normal_salaries = $employee->get_normal_work_salaries($emp);
    $inconveninet_salaries = $employee->get_inconvenient_amount($emp);
    $effects = $employee->get_inconvenient_amount($emp,1);
    $normal_last_id = $employee->get_last_id($emp,1);
    $inconv_last_id = $employee->get_last_id($emp,2);
    $smarty->assign("inconveninet_salaries",$inconveninet_salaries);
    $smarty->assign("normal_salaries",$normal_salaries);
    $smarty->assign('effects',$effects);
    $smarty->assign('inconv_last_id',$inconv_last_id);
    $smarty->assign('normal_last_id',$normal_last_id);
}
//employee time prefarance
//Create array for employee preferred time 
$Employee_username = $emp;
$Employee_Preferred_time_Array = array();
$emp_preferred_times = $newemployee->get_employee_preferredtime($Employee_username);
$emp_count = count($emp_preferred_times);
if ($emp_count > 0) {
    for ($EmpCounter = 0; $EmpCounter < $emp_count; $EmpCounter++) {
        $EmpFromDate = $emp_preferred_times[$EmpCounter]['fromdate'];
        $EmpToDate = $emp_preferred_times[$EmpCounter]['todate'];
        $EmpSlot = $emp_preferred_times[$EmpCounter]['timeid'];
        $EmpTimeId = $emp_preferred_times[$EmpCounter]['timeid'];

        $Employee_Preferred_time_Array[$EmpCounter]['fromdate'] = $EmpFromDate;
        $Employee_Preferred_time_Array[$EmpCounter]['todate'] = $EmpToDate;
        $Employee_Preferred_time_Array[$EmpCounter]['timeid'] = $EmpSlot;
        $Employee_Preferred_time_Array[$EmpCounter]['timeid'] = $EmpTimeId;

        $SlotArray = $newemployee->get_employee_preferredtime_slot($EmpSlot);

        for ($SlotCounter = 0; $SlotCounter < count($SlotArray); $SlotCounter++) {
            $Day = $SlotArray[$SlotCounter]['day'];
            $PreferredTime = $SlotArray[$SlotCounter]['preferredtime'];
            $ovetimevalue = $SlotArray[$SlotCounter]['overtime'];
            if ($ovetimevalue == 1) {
                $ovetime = $smarty->localise->contents["yes"];
            } else {
                $ovetime = $smarty->localise->contents["no"];
            }
            $Employee_Preferred_time_Array[$EmpCounter][$SlotCounter]['day'] = $Day;
            $Employee_Preferred_time_Array[$EmpCounter][$SlotCounter]['preferredtime'] = $PreferredTime;
            $Employee_Preferred_time_Array[$EmpCounter][$SlotCounter]['overtime'] = $ovetime;
            $Employee_Preferred_time_Array[$EmpCounter][$SlotCounter]['overtimeval'] = $ovetimevalue;
        }
    }
}

    if(isset($_POST['save_edit_doc'])){
        if($_POST['skills'] != '' && $_POST['description'] != '') {
            $not_null_array = array();
            $app_dir        = getcwd();
            $skill_id       = $_POST['skill_h_id'];
            $skill          = $_POST['skills'];
            $description    = $_POST['description'];
            $columns        = $_POST['db_column'];
            $emp            = $_SESSION['user_id'];
            $skill_details  = $employee->get_employee_skill_by_id($skill_id);
            $folder_name    = $customer->get_folder_name($_SESSION['company_id'])."/skills/";

            if($columns){
                for($i=0;$i<count($columns);$i++){
                    @unlink($app_dir."/".$folder_name.$skill_details[$columns[$i]]);
                    $skill_details[$columns[$i]] = null;
                }   
            }

            $keys = array_keys($skill_details);
            for($i=4;$i<7;$i++){
                 $not_null_array[$keys[$i]] = $skill_details[$keys[$i]];
            }

            if($_FILES){
                $max_size = 50000 * 1024;
                $upload_path = $customer->get_folder_name($_SESSION['company_id']) . "/skills/";
                
                for($i = 0;$i<count($_FILES['file']['name']);$i++){
                    if($_FILES['file']['name'][$i] != ''){
                        $size = $_FILES['file']['size'][$i]; 
                        $file_name = $_FILES['file']['name'][$i];
                        $str = str_replace(" ", "_", $file_name);
                        $file_names[] =  $str;
                            if ($size <= $max_size) {
                                $extension = $customer->get_file_extension($str);
                                    if($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt" ||$extension == "xls" ||$extension == "txt" ||$extension == "xlsx" ) {
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

                    if($data = $employee->employee_skill_update($skill,$description,$skill_id,$_SESSION['user_id'],$not_null_array)){
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
                $data = $employee->employee_skill_update($skill,$description,$skill_id,$_SESSION['user_id']);
            }  
            header('Location: ' . $smarty->url . 'employee/administration/');
            exit();  
        }
    }

$smarty->assign('emp_count', $emp_count);
$smarty->assign('preferred_time', $Employee_Preferred_time_Array);
$smarty->assign('employees_username', $Employee_username);
//$smarty->assign('employees',$employees);
$years_work = $newemployee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years', $years_work);
$smarty->assign('skills',$skills);
$smarty->assign('customers',$customers);
// if($_COOKIE['debug'] == 'admin') { 
//     echo "$emp<pre>".print_r($customers, 1)."<pre>"; 
//     exit();
// }

////////////////////////////////          ajax block for non-prefered-time           ///////////

if($_POST['action'] && $_POST['action'] == 'save_time_interval'){
    $responce         = new stdClass();
    $user_name        = $_POST['username'];
    $fromDate         = $_POST['fromDate'];
    $toDate           = $_POST['toDate'];
    $dayInterval      = $_POST['dayInterval'];
    $preference_mode      = $_POST['preference_mode'];
    $_SESSION['preference_mode']  = $preference_mode;
    $overlapedDetails = $obj_emp->check_overlapping_time_peroid($fromDate,$toDate,$dayInterval,$user_name);
    if(!empty($overlapedDetails)){
        // return $responce = array('status'=>'collide','overlapedDetails'=>$overlapedDetails);
        $error_flag = 'collide';
    }
    else{
        $overlaped_slot_det = $obj_emp->check_time_interval_overlap_with_existing_slots($fromDate,$toDate,$dayInterval,$user_name);
        if(!empty($overlaped_slot_det)){
            $error_flag = 'collide_slot';
        }
        else{
            $group_id = $obj_emp->get_group_id();
            $result   = $obj_emp->save_employee_non_prefered_time($user_name,$fromDate,$toDate,$dayInterval,$group_id, $preference_mode);
            $result == TRUE ? $error_flag = 'success' :  $error_flag = 'insertion_error';
        }
    }
    
    if($error_flag == 'success'){
        // mail 
        $employee_old_details = $employee->get_employee_detail($_SESSION['user_id']);
        $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_old_details['first_name']. ' '. $employee_old_details['last_name'] : $employee_old_details['last_name']. ' '. $employee_old_details['first_name'];
        $mail_sub = $smarty->translate['non_prefered_mail_add_subject'];
        $mail_msg = $smarty->translate['non_prefered_mail_add_heading'];
        $mail_msg .= '<br><br>'.'<strong>'.$logged_employee_name.'</strong>'.' '.$smarty->translate['emp_take_non_preferd_time_range'].'<br>'.'<strong>'.$fromDate.'&nbsp;&nbsp;'.$smarty->translate['to'].'&nbsp;&nbsp;'.$toDate.'</strong>'.'<br>';
        foreach ($dayInterval as $day => $times) {
            $mail_msg .= '<strong>'.$smarty->translate[$week[$day-1]['day']].'</strong>'.'<br>';
            foreach ($times as $key => $value) {
               $mail_msg .= sprintf('%05.02f', $value['timeFrom']).'-'.sprintf('%05.02f', $value['timeTo']).'<br>';
            }
        }
        mail_send_to_admin_tl_stl($mail_sub,$mail_msg,$employee_old_details);

        $responce->result_flag = TRUE;
        $messages->set_message('success', 'employee_non_prefered_time_saved_successfully');
    }
    else if($error_flag == 'collide') {
        $error_message_translate = $smarty->translate['employee_non_prefered_time_overlap'];
        $error_message = str_replace ('{{fromDate}}', $overlapedDetails[0]['date_from'], $error_message_translate);
        $error_message = str_replace ('{{toDate}}', $overlapedDetails[0]['date_to'] , $error_message);
        $responce->result_flag = FALSE;
        $messages->set_message_exact('fail',$error_message);
        $responce->error_message =  $messages->show_message();
    }
    else if($error_flag == 'collide_slot'){
        $error_message = $smarty->translate['collide_with_existing_slot'].$overlaped_slot_det[0]['date'].' => '.$overlaped_slot_det[0]['time_from'].' - '.$overlaped_slot_det[0]['time_to'];
        $responce->result_flag = FALSE;
        $messages->set_message_exact('fail', $error_message);
        $responce->error_message =  $messages->show_message();
    }
    else if($error_flag == 'insertion_error'){
        $responce->result_flag = FALSE;
        $messages->set_message('fail', "something_went_wrong");
        $responce->error_message =  $messages->show_message();
    }
    echo json_encode($responce);
    exit();
}

else if($_POST['action'] && $_POST['action'] == 'delete_single_time_interval'){
    $id       = $_POST['id'];
    $responce = new stdClass();
    $result   = $obj_emp->delete_single_non_preferred_imterval($id);
    $preference_mode      = $_POST['preference_mode'];
    $_SESSION['preference_mode']  = $preference_mode;
    if($result){
        $responce->result_flag = $result;
        $messages->set_message('success', "deleted_sucessfully");
    }
    else{
        $responce->result_flag = $result;
        $messages->set_message('fail', "something_went_wrong");
        $responce->error_message =  $messages->show_message();
    }
    echo json_encode($responce);
    exit();
}

else if($_POST['action'] && $_POST['action'] == 'delete_time_interval'){

    $responce  = new stdClass();
    $group_id  = $_POST['group_id'];
    $preference_mode      = $_POST['preference_mode'];
    $_SESSION['preference_mode']  = $preference_mode; 
    $result    = $obj_emp->delete_employee_non_preferd_time($group_id);
    if($result){
        $responce->result_flag = $result;
        $messages->set_message('success', "deleted_sucessfully");
    }
    else{
        $responce->result_flag = $result;
        $messages->set_message('fail', "something_went_wrong");
        $responce->error_message =  $messages->show_message();
    }
    echo json_encode($responce);
    exit();
}

else if($_POST['action'] && $_POST['action'] == 'edit_time_interval'){
    $responce    = new stdClass();
    $user_name   = $_POST['username'];
    $fromDate    = $_POST['fromDate'];
    $toDate      = $_POST['toDate'];
    $dayInterval = $_POST['dayInterval'];
    $group_id    = $_POST['group_id']; 
    $preference_mode      = $_POST['preference_mode'];
    $_SESSION['preference_mode']  = $preference_mode;
    $overlapedDetails = $obj_emp->check_overlapping_time_peroid($fromDate,$toDate,$dayInterval,$user_name,$group_id);
    if(!empty($overlapedDetails)){
        $error_flag = 'collide';

    }
    else{
        $obj_emp->begin_transaction();
        $delete   = $obj_emp->delete_employee_non_preferd_time($group_id);
        $group_id = $obj_emp->get_group_id();
        if($delete){
            $result   = $obj_emp->save_employee_non_prefered_time($user_name,$fromDate,$toDate,$dayInterval,$group_id);
            if($result){
                $error_flag = 'success';
                $obj_emp->commit_transaction();
                
            }
        }
        else{
            $error_flag = 'update_error';
            $obj_emp->rollback_transaction();
            
        }
    }
    if($error_flag == 'success'){
        $employee_old_details = $employee->get_employee_detail($_SESSION['user_id']);
        $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $employee_old_details['first_name']. ' '. $employee_old_details['last_name'] : $employee_old_details['last_name']. ' '. $employee_old_details['first_name'];
        $mail_sub = $smarty->translate['non_prefered_mail_edit_subject'];
        $mail_msg = $smarty->translate['non_prefered_mail_edit_heading'];
        $mail_msg .= '<br><br>'.'<strong>'.$logged_employee_name.'</strong>'.' '.$smarty->translate['emp_take_non_preferd_time_range'].'<br>'.'<strong>'.$fromDate.'&nbsp;&nbsp;'.$smarty->translate['to'].'&nbsp;&nbsp;'.$toDate.'</strong>'.'<br>';
        foreach ($dayInterval as $day => $times) {
            $mail_msg .= '<strong>'.$smarty->translate[$week[$day-1]['day']].'</strong>'.'<br>';
            foreach ($times as $key => $value) {
               $mail_msg .= sprintf('%05.02f', $value['timeFrom']).'-'.sprintf('%05.02f', $value['timeTo']).'<br>';

            }
        }
        
        mail_send_to_admin_tl_stl($mail_sub,$mail_msg,$employee_old_details);
        $responce->result_flag = TRUE;
        $messages->set_message('success', 'employee_non_prefered_time_saved_successfully');
    }
    else if($error_flag == 'collide') {
        $error_message_translate = $smarty->translate['employee_non_prefered_time_overlap'];
        $error_message = str_replace ('{{fromDate}}', $overlapedDetails[0]['date_from'], $error_message_translate);
        $error_message = str_replace ('{{toDate}}', $overlapedDetails[0]['date_to'] , $error_message);
        $responce->result_flag = FALSE;
        $messages->set_message_exact('fail',$error_message);
        $responce->error_message =  $messages->show_message();
    }
    else if($error_flag == 'update_error'){
        $responce->result_flag = FALSE;
        $messages->set_message('fail', "something_went_wrong");
        $responce->error_message =  $messages->show_message();
    }

    echo json_encode($responce);
    exit();
}






////////////////////////////////                        end                         ////////////


$allNonPreferedTime = $obj_emp->get_all_employee_non_prefered_rime($_SESSION['user_id'], $preference_mode);
foreach ($allNonPreferedTime as $key => $value) {
    $orderdAllNonPreferedTime[$value['group_id']][] =  $value;
}

$selected_email_options_number = $obj_emp->get_email_option_of_employee($_SESSION['user_id'])['email'];
$selected_email_options_number = explode(",",$selected_email_options_number);
array_pop($selected_email_options_number);

$smarty->assign('selected_email_options', $selected_email_options_number);
$smarty->assign('orderdAllNonPreferedTime', $orderdAllNonPreferedTime);
$smarty->display('extends:layouts/dashboard.tpl|employee_administration.tpl');

function mail_send_to_admin_tl_stl($mail_sub,$mail_msg,$employee_old_details){
    // $selected_email_options_number = $obj_emp->get_email_option_of_employee($_SESSION['user_id'])['email'];
    //     $selected_email_options_number = explode(",",$selected_email_options_number);
    //     array_pop($selected_email_options_number);
    //     if(in_array(27, $selected_email_options_number) || empty($selected_email_options_number))
    require_once('class/employee_ext.php');
    $obj_emp           = new employee_ext();
    $tl_of_employee    = $obj_emp->get_team_leader_or_super_tl_of_employee($_SESSION['user_id'],2); // get tl
    array_walk($tl_of_employee, "change_key_name");
    $stl_of_employee   = $obj_emp->get_team_leader_or_super_tl_of_employee($_SESSION['user_id'],7); // get super tl 
    array_walk($stl_of_employee, "change_key_name");
    $admin_of_employee = $obj_emp->get_admin_data();
    $mailer = new SimpleMail($mail_sub, $mail_msg);
    $mailer->addSender("cirrus-noreplay@time2view.se");
    $selected_email_options_number = $obj_emp->get_email_option_of_employee($_SESSION['user_id'])['email'];
    $selected_email_options_number = explode(",",$selected_email_options_number);
    array_pop($selected_email_options_number);
    if(in_array(27, $selected_email_options_number)){
        if($employee_old_details['email'] != '')
            $mailer->addRecipient($employee_old_details['email'], trim($employee_old_details['first_name']) . ' ' . trim($employee_old_details['last_name']));
    }
    $mail_persons     = array_merge($tl_of_employee, $stl_of_employee,$admin_of_employee);
    if(!empty($mail_persons)){
        foreach ($mail_persons as $key => $value) {
            $mail_persons_employee[] = $value['username'];
        }
        $mail_persons_with_email_option = $obj_emp->get_email_option_mail_person($mail_persons_employee);
        foreach ($mail_persons_with_email_option as $key => $value) {
            if($value['email'] != ''){
                $mailer->addRecipient($value['email'], trim($value['first_name']) . ' ' . trim($value['last_name']));
            }
        }
        $mailer->send();
    }
}

function change_key_name(& $item){
    $item['username'] = $item['employee'];
    unset($item['employee']);
}

function mail_send_employee_send($change_msg,$subject_update,$employee_old_details,$company_detail){
    $mailer_emp =  new SimpleMail($subject_update,$change_msg['change_msg_emp']);
    $mailer_con =  new SimpleMail($subject_update,$change_msg['change_msg_con']);
    $mailer_emp->addSender("cirrus-noreplay@time2view.se");
    $mailer_con->addSender("cirrus-noreplay@time2view.se");
    if($employee_old_details['email'] != ''){
        $mailer_emp->addRecipient($employee_old_details['email'], trim($employee_old_details['first_name']) . ' ' . trim($employee_old_details['last_name']));
        $mailer_emp->send();
    }
    if($company_detail['mail_send_to_contact_person'] == 1){
        if($company_detail['contact_person2_email'] != '')
                $mailer_con->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
        else if($company_detail['contact_person1_email'] != '')
                $mailer_con->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
           $mailer_con->send();
    }
}



// sreerag last edit 8/02/2018 function for sending mail
function mail_send($change_msg,$subject_update,$employee_old_details,$company_detail,$contract_alloc_emp_det = '' ,$msg_password_emp = ''){
    $mailer_upadte = new SimpleMail($subject_update,$change_msg);
    $mailer_upadte->addSender("cirrus-noreplay@time2view.se");

    if($contract_alloc_emp_det != '' && $contract_alloc_emp_det[0]['email'] !=''){
        $mailer_upadte->addRecipient($contract_alloc_emp_det[0]['email'], trim($contract_alloc_emp_det[0]['last_name']) . ' ' . trim($contract_alloc_emp_det[0]['first_name']));
    }
    if($employee_old_details['email'] != ''){
        $mailer_upadte->addRecipient($employee_old_details['email'], trim($employee_old_details['first_name']) . ' ' . trim($employee_old_details['last_name']));
    }
    if($company_detail['mail_send_to_contact_person'] == 1){
        if($company_detail['contact_person2_email'] != '')
                $mailer_upadte->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
        else if($company_detail['contact_person1_email'] != '')
                $mailer_upadte->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
           
    }       
    if(($contract_alloc_emp_det != '' && $contract_alloc_emp_det[0]['email'] !='') || $employee_old_details['email']  != '' || $company_detail['contact_person2_email'] != '' || $company_detail['contact_person1_email'] != ''){
             $mailer_upadte->send();
    }
}
// sreerag last edit 8/02/2018 function for mail footer
function mail_footer_content($smarty,$contact_person,$company_home,$cirrus_link,$logged_employee_name,$employee_old_details){
    $change_msg_footer  = '<br><br>'. $smarty->translate['profile_employee_name'] . ' : ' .  ($_SESSION['company_sort_by'] == 1 ? $employee_old_details['first_name']. ' '. $employee_old_details['last_name'] : $employee_old_details['last_name']. ' '. $employee_old_details['first_name']).'<br>';
    $change_msg_footer .= $smarty->translate[contact_person_in_the_office] . ' : ' . $contact_person . '<br>';
    $change_msg_footer .= $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link. '<br>' . $smarty->translate['edited_by'] . ' : ' . $logged_employee_name;
    return $change_msg_footer;
}
function phone_check($phone,$type){
     if($type == 'mobile'){   
         if ($phone != "") {
            $length_mobile_display = (strlen($phone) - 5) / 2;
            //$employee_detail[0]['mobile'] = "0".substr($employee_detail[0]['mobile'], 0,2) . "-" . substr($employee_detail[0]['mobile'], 2,3)." ".substr($employee_detail[0]['mobile'], 5,2)." ".substr($employee_detail[0]['mobile'], 7,2)." ".substr($employee_detail[0]['mobile'],9,2);
            $temp_mobile = '';
            $pos = 5;
            for ($i = 0; $i < $length_mobile_display; $i++) {
                $temp_mobile = $temp_mobile . " " . substr($phone, $pos, 2);
                $pos = $pos + 2;
            }
            return $phone = "+46" . substr($phone, 0, 3) . " " . substr($phone, 3, 2) . " " . $temp_mobile;
        }
    }
    if($type == 'phone'){
        if ($phone != "") {
            return $phone = "0" . substr($phone, 0, 2) . "-" . substr($phone, 2);
        }
    }
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
?>