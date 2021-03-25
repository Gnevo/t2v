<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/recruitment.php');
require_once('class/company.php');
require_once('plugins/message.class.php');
require_once('class/mail.php');
$smarty = new smartySetup(array("month.xml", 'button.xml', 'recruitment.xml', 'recruitment_button.xml'));
$recruitment = new recruitment();
$obj_company = new company();
$message = new message();
$application_data = array();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$company_id = $_SESSION['company_id'];
$company_details = $obj_company->get_company_detail($company_id);
$smarty->assign('download_folder', $company_details['upload_dir'] . "/");

if ($_POST['action'] == 'save') {
    // echo '<pre>'.print_r($_POST, 1).'</pre>'; exit();

    $application_data = array(
        'century' => $_POST['Century'],
        'personal_number' => preg_replace('/-/', '', $_POST['personal_number'], 1),
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'gender' => $_POST['gender'],
        'address' => $_POST['address'],
        'post_no' => $_POST['post_no'],
        'city' => $_POST['city'],
        'telephone' => $_POST['telephone'],
        'mobile' => $_POST['mobile'],
        'email' => $_POST['email'],
        'qualification' => $_POST['qualification'],
        'experience' => $_POST['experience'],
        'ref_name' => $_POST['ref_name'],
        'ref_mobile' => $_POST['ref_mobile'],
        'skill_title' => $_POST['skill_title'],
        'skill_description' => $_POST['skill_desc']
    );

    if ($recruitment->social_security_check($_POST['personal_number'])) {
        $exist_app_id = $recruitment->applicant_social_security_check($_POST['personal_number']);
        if ($exist_app_id === FALSE) {

            $allowedExts_photo = array("gif", "jpeg", "jpg", "pjpeg", "x-png", "png");
            $filename_photo_array = explode(".", $_FILES['photo']['name']);
            $extension_photo = end($filename_photo_array);
            $photo_file = 1;
            if ($_FILES["photo"]["name"] != '') {
                $photo_file = 0;
                if ((($_FILES["photo"]["type"] == "image/gif") || ($_FILES["photo"]["type"] == "image/jpeg") || ($_FILES["photo"]["type"] == "image/jpg") || ($_FILES["photo"]["type"] == "image/pjpeg") || ($_FILES["photo"]["type"] == "image/x-png") || ($_FILES["photo"]["type"] == "image/png")) && in_array($extension_photo, $allowedExts_photo)) {
                    if ($_FILES["photo"]["error"] > 0) {
                        $message->set_message('fail', 'photo_invalid_file');
                    } elseif ($_FILES["photo"]["size"] > 200000) {
                        $message->set_message('fail', 'photo_invalid_file_size');
                    } else {
                        if (file_exists($app_dir . '/' . $company_details['upload_dir'] . "/recruitment/photo/" . $_FILES["photo"]["name"])) {
                            $message->set_message('fail', 'photo_file_already_exist');
                        } else {
                            $photo_file = 1;
                        }
                    }
                } else {
                    $message->set_message('fail', 'photo_invalid_file_type');
                }
            }
            $allowedExt_resume = array("doc", "pdf", "txt", "docx");
            $filename_resume_array = explode(".", $_FILES["resume"]["name"]);
            $extension_resume = end($filename_resume_array);
            $resume_file = 1;
            if ($_FILES["resume"]["name"] != '') {
                $resume_file = 0;
                if ((($_FILES["resume"]["type"] == "application/pdf") || ($_FILES["resume"]["type"] == "application/msword") || ($_FILES["resume"]["type"] == "text/plain")) && ($_FILES["resume"]["size"] < 2097152) && in_array($extension_resume, $allowedExt_resume)) {
                    if ($_FILES["resume"]["error"] > 0) {
                        $message->set_message('fail', 'resume_invalid_file');
                    } elseif ($_FILES["resume"]["size"] > 200000) {
                        $message->set_message('fail', 'resume_invalid_file_size');
                    } else {
                        if (file_exists($app_dir . '/' . $company_details['upload_dir'] . "/recruitment/resume/" . $_FILES["resume"]["name"])) {
                            $message->set_message('fail', 'resume_file_already_exist');
                        } else {
                            $resume_file = 1;
                        }
                    }
                } else {
                    $message->set_message('fail', 'resume_invalid_file_type');
                }
            }
            if ($photo_file && $resume_file) {

                $recruitment->century = $_POST['century'];
                $recruitment->personal_number = preg_replace('/-/', '', $_POST['personal_number'], 1);
                $recruitment->first_name = $_POST['first_name'];
                $recruitment->last_name = $_POST['last_name'];
                $recruitment->gender = $_POST['gender'];
                $recruitment->address = $_POST['address'];
                $recruitment->post_no = $_POST['post_no'];
                $recruitment->city = $_POST['city'];
                $recruitment->telephone = $_POST['telephone'];
                $recruitment->mobile = $_POST['mobile'];
                $recruitment->email = $_POST['email'];
                $recruitment->experience = $_POST['experience'];
                $recruitment->ref_name = $_POST['ref_name'];
                $recruitment->ref_mobile = $_POST['ref_mobile'];
                if ($id_new = $recruitment->recruitment_add()) {
                    //Adding skill To the applicant
                    $title = $_POST['skill_title'];
                    $description_skill = $_POST['skill_desc'];
                    for ($i = 0; $i < count($title); $i++) {
                        $recruitment->application_id = $id_new;
                        $recruitment->title = $title[$i];
                        $recruitment->description = $description_skill[$i];
                        if ($recruitment->title != '' || $recruitment->description != '') {
                            $recruitment->skill_insert();
                        }
                    }

                    $company_home = $company_details['website'];
                    $contact_person = $company_details['contact_person1'];
                    $logo = $company_details['logo'];
                    $company_name = $company_details['name'];
                    $subject = $smarty->translate[application_recieved];
                    // $msg = $smarty->translate[application_recieved_mail] . " " . $smarty->translate[on] . " " . date("Y-m-d") . ".<br/>" . $smarty->translate[username] . " : " . $recruitment->email . "<br/>" . $smarty->translate[password] . " : " . $recruitment->password . "<br/>" . $company_details['name'];
                    $msg = $smarty->translate[application_recieved_mail] . " " . $smarty->translate[on] . " " . date("Y-m-d") . ".<br/>" . $smarty->translate[username] . " : " . $recruitment->email . "<br/>" . $company_details['name'];
                    $mailer = new SimpleMail($subject, $msg);
                    $mailer->addSender("cirrus-noreplay@time2view.se");
                    $mailer->addRecipient($recruitment->email, trim($recruitment->first_name) . ' ' . trim($recruitment->last_name));
                    $mailer->send();

                    //update photo
                    if ($_FILES["photo"]["name"] != '') {

                        $_FILES["photo"]["name"] = 'photo_' . $id_new . "." . $extension_photo;
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $app_dir . '/' . $company_details['upload_dir'] . "/recruitment/photo/" . $_FILES["photo"]["name"])) {
                            $recruitment->photo = $_FILES["photo"]["name"];
                            $recruitment->recruitment_update_photo($id_new);
                        }
                    }

                    //upload resume
                    if ($_FILES["resume"]["name"] != '') {

                        $_FILES["resume"]["name"] = 'resume_' . $id_new . "." . $extension_resume;
                        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $app_dir . '/' . $company_details['upload_dir'] . "/recruitment/resume/" . $_FILES["resume"]["name"])) {
                            $recruitment->attach_resume = $_FILES["resume"]["name"];
                            $recruitment->recruitment_update_resume($id_new);
                        }
                    }
                    $message->set_message('success', 'data_saved');
                    header("location:" . $smarty->url . "add/recruitment/applicant/");
                    exit();
                } else {
                    $message->set_message('fail', 'error_saving');
                }
            }
        } else {
            $message->set_message('fail', 'social_security_exist');
        }
    } else {
        $message->set_message('fail', 'this_social_security_number_is_wrong');
    }
}
$smarty->assign('application_data', $application_data);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|recruitment_applicant_add.tpl');
?>