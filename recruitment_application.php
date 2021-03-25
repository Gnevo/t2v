<?php
require_once('class/setup.php');
require_once('class/recruitment.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/mail.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("month.xml", 'button.xml', 'recruitment.xml'),FALSE);
$recruitment=new recruitment();
$obj_company = new company();
$customer = new customer();
$messages = new message();

$company=$recruitment->get_company_name();
$app_dir = getcwd();
$key_value = "!@#$%^&*";
$encrypted_text = $_REQUEST['company_id'] ;
$decrypted_text = mcrypt_ecb(MCRYPT_DES, $key_value, base64_decode($encrypted_text), MCRYPT_DECRYPT); 
$company_details = $obj_company->get_company_detail($decrypted_text);
$db_name = $company_details['db_name'];
$_SESSION['db_name'] = $db_name;
$smarty->assign('company_encript_id',$encrypted_text);
//echo $db_name;
$skills = $recruitment->get_skill();
$smarty->assign('skills',$skills);
//echo "<pre>". print_r($skills, 1)."</pre>";
$smarty->assign('companies',$company);
if (isset($_POST['Submit'])) {
//    echo "<pre>".print_r($_POST, 1)."</pre>";exit();
    $error = 0;
    $allowedExts = array("gif", "jpeg", "jpg", "pjpeg", "x-png", "png");
    $temp = explode(".", $_FILES['fileField']['name']);
    $extension = end($temp);
    if($_FILES["fileField"]["name"] != ''){
        
        if ((($_FILES["fileField"]["type"] == "image/gif") || ($_FILES["fileField"]["type"] == "image/jpeg") || ($_FILES["fileField"]["type"] == "image/jpg") || ($_FILES["fileField"]["type"] == "image/pjpeg") || ($_FILES["fileField"]["type"] == "image/x-png") || ($_FILES["fileField"]["type"] == "image/png"))  && in_array($extension, $allowedExts)) {
            if ($_FILES["fileField"]["error"] > 0) {
                $error = 1;
            }elseif($_FILES["fileField"]["size"] > 200000){ 
//                echo "<script>alert('" .$smarty->translate[photo_size_large]." ".$smarty->translate[min_2mb]."');</script>";
                $messages->set_message_exact('fail', $smarty->translate[photo_size_large]." ".$smarty->translate[min_2mb]);
            }else {
                if (file_exists($app_dir . "/recruitment/photo" . $_FILES["fileField"]["name"])) {
                    $messages->set_message_exact('fail', $_FILES["fileField"]["name"] . " " . $smarty->translate[of_photo] . " " . $smarty->translate[already_exist]);
//                    echo "<script>alert(" . $_FILES["fileField"]["name"] . " " . $smarty->translate[of_photo] . " " . $smarty->translate[already_exist].");</script>";
                    $error = 1;
                } //else {
                    //print_r($_FILES);
    //                move_uploaded_file($_FILES["fileField"]["tmp_name"], $app_dir . "/recruitment/photo/" . $_FILES["fileField"]["name"]);
    //
    //            }
            }
        } else {
            $messages->set_message_exact('fail', $smarty->translate[invalid_file]);
//            echo "<script>alert('" . $smarty->translate[invalid_file] . "')</script>";
            $error = 1;
        }
    
    }
    $allowedExt=array("doc","pdf","txt");
    $temp1=  explode(".", $_FILES["fileField2"]["name"]);
    $extension1=end($temp1);
    if($_FILES["fileField2"]["name"] != ''){
        if ((($_FILES["fileField2"]["type"] == "application/pdf")
                || ($_FILES["fileField2"]["type"] == "application/msword")
                || ($_FILES["fileField2"]["type"] == "text/plain"))
                && ($_FILES["fileField2"]["size"] < 2097152)
                && in_array($extension1, $allowedExt)) {
            if ($_FILES["fileField2"]["error"] > 0) {
                //        echo "Return code:" . $_FILES["fileField2"]["error"];
                $error = 1;
            } else {
                if (file_exists($app_dir . "/recruitment/resume/" . $_FILES["fileField2"]["name"])) {

//                    echo "<script>alert('" . $_FILES["fileField2"]["name"] . " " . $smarty->translate[file_already_exist] . "')</script>";
                    $messages->set_message_exact('fail', $_FILES["fileField2"]["name"] . " " . $smarty->translate[file_already_exist]);
                    $error = 1;
                } //else {
    //                // print_r($_FILES);
    //                move_uploaded_file($_FILES["fileField2"]["tmp_name"], $app_dir . "/recruitment/resume/" . $_FILES["fileField2"]["name"]);
    //                //      
    //            }
            }
        } else {
            $messages->set_message_exact('fail', $smarty->translate[invalid_file]);
//            echo "<script>alert('" . $smarty->translate[invalid_file] . "')</script>";
            $error = 1;
        }
    }
    

    if($error == 0){
        /*$new_id = $recruitment->get_next_new_id();
        
        
        if($_FILES["fileField"]["name"] != ''){
            $temp_photo = explode(".", $_FILES["fileField"]["name"]);
            $_FILES["fileField"]["name"] = 'photo_'.$new_id.".".$temp_photo[1];
            move_uploaded_file($_FILES["fileField"]["tmp_name"], $app_dir . "/recruitment/photo/" . $_FILES["fileField"]["name"]);
        }
        if($_FILES["fileField2"]["name"] != ''){
            $temp_resume = explode(".", $_FILES["fileField2"]["name"]);
            $_FILES["fileField2"]["name"] = 'resume_'.$new_id.".".$temp_resume[1];
            move_uploaded_file($_FILES["fileField2"]["tmp_name"], $app_dir . "/recruitment/resume/" . $_FILES["fileField2"]["name"]);
        }*/
            
        $recruitment->century = $_POST['Century'];
        $recruitment->personal_number =  preg_replace('/-/', '', $_POST['personal_number'], 1);
        $recruitment->first_name = $_POST['first_name'];
        $recruitment->last_name = $_POST['last_name'];
        $recruitment->gender = $_POST['gender'];
        $recruitment->address = $_POST['address'];
        $recruitment->post_no = $_POST['post_no'];
        $recruitment->city = $_POST['city'];
        $recruitment->telephone = $_POST['telephone'];
        $recruitment->mobile = $_POST['mobile'];
        $recruitment->email = $_POST['email'];
        $recruitment->photo = $_FILES["fileField"]["name"];
        $recruitment->qualification = $_POST['qualification'];
        $recruitment->experience = $_POST['experience'];
        $recruitment->former_company = $_POST['former_company_name'];
        $recruitment->contact_no = $_POST['contact_no'];
        $recruitment->language_known = $_POST['languages_known'];
        $recruitment->resume_title = $_POST['resume_title'];
        $recruitment->attach_resume = $_FILES["fileField2"]["name"];
        $recruitment->type_resume = $_POST['type_resume'];
        $recruitment->ref_social_security_no = $_POST['ref_social_security_no'];
        $recruitment->ref_name = $_POST['ref_name'];
        $recruitment->ref_mobile = $_POST['ref_mobile'];
        if($id_new = $recruitment->recruitment_add()){
            $compony_detail = $customer->get_company_detail($company_details['id']);
            $company_home = $compony_detail['website'];
            $contact_person = $compony_detail['contact_person1'];
            $logo = $compony_detail['logo'];
            $company_name = $compony_detail['name'];
            $subject = $smarty->translate[application_recieved];
            $msg = $smarty->translate[application_recieved_mail]." ".$compony_detail['name']." ". $smarty->translate[on]." ".date("Y-m-d");
            $mailer = new SimpleMail($subject, $msg);
            $mailer->addSender("cirrus-noreplay@time2view.se");
            $mailer->addRecipient($recruitment->email, trim($recruitment->first_name) . ' ' . trim($recruitment->last_name));
            $mailer->send();
            
            
            if($_FILES["fileField"]["name"] != ''){
                $temp_photo = explode(".", $_FILES["fileField"]["name"]);
                $_FILES["fileField"]["name"] = 'photo_'.$id_new.".".$temp_photo[1];
                move_uploaded_file($_FILES["fileField"]["tmp_name"], $app_dir . "/recruitment/photo/" . $_FILES["fileField"]["name"]);
            }
            if($_FILES["fileField2"]["name"] != ''){
                $temp_resume = explode(".", $_FILES["fileField2"]["name"]);
                $_FILES["fileField2"]["name"] = 'resume_'.$id_new.".".$temp_resume[1];
                move_uploaded_file($_FILES["fileField2"]["tmp_name"], $app_dir . "/recruitment/resume/" . $_FILES["fileField2"]["name"]);
            }

            
            //Adding skill To the applicant
            $title= $_POST['textfield12'];
            $description_skill = $_POST['textarea3'];
            for($i=0;$i<count($title);$i++){
                $recruitment->application_id = $id_new; 
                $recruitment->title = $title[$i];
                $recruitment->description = $description_skill[$i];
                $recruitment->skill_insert();
            }
            
            $messages->set_message_exact('success', $smarty->translate[application_successfully_saved]);
        }
        else {
//            echo "<pre>".print_r($recruitment->query_error_details, 1)."</pre>"; exit();
            $messages->set_message_exact('fail', $smarty->translate[error_in_application_processing]);
        }
//        $recuitment->exp_name = $_POST['experience'];
//        $recruitment->experience_ins();
//        $recuitment->lang_name = $_POST['languages_known'];
//        $recruitment->language_ins();
//        $recuitment->qual_name = $_POST['qualification'];
//        $recruitment->qualification_ins();
        header("location:".$smarty->url."recruitment_application.php?company_id=".$encrypted_text);
        exit();
    }else{
        header("location:".$smarty->url."recruitment_application.php?company_id=".$encrypted_text);
        exit();
    }
}

$smarty->assign('message', $messages->show_message());

$smarty->display('recruitment_application.tpl');
?>