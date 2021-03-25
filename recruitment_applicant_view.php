<?php

// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);


require_once('class/setup.php');
require_once('class/recruitment.php');
require_once('class/mail.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("month.xml", 'button.xml', 'recruitment.xml', 'recruitment_button.xml'));
$obj_recruitment = new recruitment();
$obj_customer = new customer();
$employee = new employee();
$message = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
global $company;
$app_id = explode("-", $_SERVER['QUERY_STRING']);
if ($app_id[1] == "1" || $app_id[1] == 1) {
    $smarty->assign('show_all', '1');
} else {
    $smarty->assign('show_all', '0');
}
$smarty->assign('url_app', $_SERVER['QUERY_STRING']);
$smarty->assign('download_folder', $obj_customer->get_folder_name($_SESSION['company_id']) . "/");
$applicant_skills = $obj_recruitment->get_all_skills_applicant($app_id[0]);
// echo "<pre>". print_r($applicant_skills, 1)."</pre>"; exit();
if ($app_id[2] == "1" || $app_id[2] == 1) {

    $applicant_detail = $obj_recruitment->get_applicant_detail($app_id[0]);
    if ($applicant_detail['status'] == 1) {
        $status = 5;
    } else {
        $status = $applicant_detail['status'] + 1;
    }
    $offer_letter_date = NULL;
    if ($app_id[3] == "1" || $app_id[3] == 1) {
        if ($applicant_detail['status'] == 1) {
            $employee->social_security = strip_tags($applicant_detail['personal_number']);
            $employee->company_id = $_SESSION['company_id'];
            $employee->begin_transaction();
            if ($employee->company_update()) {
                $message->set_message("success", 'applicant_selected_employee');
                $obj_recruitment->change_interview_candidate_status($app_id[0], $status, $offer_letter_date);
                $compony_detail = $obj_customer->get_company_detail($_SESSION['company_id']);
                $company_home = $compony_detail['website'];
                $cirrus_link = $company['website'];
                $logo = $compony_detail['logo'];
                $company_name = $compony_detail['name'];
                $contact_person = $compony_detail['contact_person1'];
                $subject = $smarty->translate[employee_add];
                $msg = $smarty->translate[name] . ' : ' . trim($applicant_detail['first_name']) . ' ' . trim($applicant_detail['last_name']) . '<br>' . $smarty->translate[address] . ' : ' . $applicant_detail['address'] . '<br>' . $smarty->translate[email] . ' : ' . $applicant_detail['email'] . '<br>' . $smarty->translate[phone] . ' : ' . $applicant_detail['phone'] . '<br>' . $smarty->translate[mobile] . ' : ' . $applicant_detail['mobile'] . '<br>' . $smarty->translate[username] . ' : ' . $username;
                $msg .= '<br>' . $smarty->translate[contact_person_in_the_office] . ' : ' . $contact_person . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;
                $mailer = new SimpleMail($subject, $msg);
                $mailer->addSender("cirrus-noreplay@time2view.se");
                $mailer->addRecipient($applicant_detail['email'], trim($applicant_detail['first_name']) . ' ' . trim($applicant_detail['last_name']));
                $mailer->send();
                $employee->commit_transaction();
            }
        } else {
            $obj_recruitment->change_interview_candidate_status($app_id[0], $status, $offer_letter_date);
        }
        header("location:" . $smarty->url . "view/recruitment/applicant/" . $app_id[0] . "/");
        exit();
    } else {

        //        $recruitment->change_interview_candidate_status($applicant_ids[$i],$status,$offer_letter_date);

        if ($applicant_detail['status'] == 1) {
            $offer_letter_date = date('Y-m-d H:i:s');
            $replacable = array('Ä', 'Å', 'É', 'Ö', 'ä', 'å', 'é', 'ö');
            $replac_with = array('a', 'a', 'e', 'o', 'a', 'a', 'e', 'o');
            $first_name = str_replace($replacable, $replac_with, $applicant_detail['first_name']);
            $last_name = str_replace($replacable, $replac_with, $applicant_detail['last_name']);

            $first_remove = array();
            $last_remove = array();
            for ($i = 0; $i < strlen($first_name); $i++) {
                if ((ord(substr($first_name, $i, 1)) >= 97 && ord(substr($first_name, $i, 1)) <= 122) || (ord(substr($first_name, $i, 1)) >= 65 && ord(substr($first_name, $i, 1)) <= 90)) {
                    continue;
                } else {
                    $first_remove[] = substr($first_name, $i, 1);
                }
            }
            for ($i = 0; $i < count($first_remove); $i++) {
                $first_name = str_replace($first_remove[$i], "", $first_name);
            }
            for ($i = 0; $i < strlen($last_name); $i++) {
                if ((ord(substr($last_name, $i, 1)) >= 97 && ord(substr($last_name, $i, 1)) <= 122) || (ord(substr($last_name, $i, 1)) >= 65 && ord(substr($last_name, $i, 1)) <= 90)) {
                    continue;
                } else {
                    $last_remove[] = substr($last_name, $i, 1);
                }
            }
            for ($i = 0; $i < count($last_remove); $i++) {
                $last_name = str_replace($last_remove[$i], "", $last_name);
            }
            if ((ord(substr($first_name, 0, 1)) >= 97 && ord(substr($first_name, 0, 1)) <= 122) || (ord(substr($first_name, 0, 1)) >= 65 && ord(substr($first_name, 0, 1)) <= 90)) {
                $first_name_1 = substr($first_name, 0, 1);
            } else {
                $first_name_1 = "a";
            }
            if ((ord(substr($first_name, 1, 1)) >= 97 && ord(substr($first_name, 1, 1)) <= 122) || (ord(substr($first_name, 1, 1)) >= 65 && ord(substr($first_name, 1, 1)) <= 90)) {
                $first_name_2 = substr($first_name, 1, 1);
            } else {
                $first_name_2 = "a";
            }
            $obj_customer->first_name = $first_name_1 . $first_name_2;
            if ((ord(substr($last_name, 0, 1)) >= 97 && ord(substr($last_name, 0, 1)) <= 122) || (ord(substr($last_name, 0, 1)) >= 65 && ord(substr($last_name, 0, 1)) <= 90)) {
                $last_name_1 = substr($last_name, 0, 1);
            } else {
                $last_name_1 = "a";
            }
            if ((ord(substr($last_name, 1, 1)) >= 97 && ord(substr($last_name, 1, 1)) <= 122) || (ord(substr($last_name, 1, 1)) >= 65 && ord(substr($last_name, 1, 1)) <= 90)) {
                $last_name_2 = substr($last_name, 1, 1);
            } else {
                $last_name_2 = "0";
            }
            $obj_customer->last_name = $last_name_1 . $last_name_2;
            $username = $obj_customer->get_username(strtolower(substr($obj_customer->first_name, 0, 2)) . strtolower(substr($obj_customer->last_name, 0, 2)));

            // ADding Employee To Get the company

            $employee->first_name = strip_tags(trim(urldecode($applicant_detail['first_name'])));
            $employee->last_name = strip_tags(trim(urldecode($applicant_detail['last_name'])));
            $employee->gender = strip_tags($applicant_detail['gender']);
            $employee->username = $username;
            $employee->century = $applicant_detail['century'];
            $employee->role = 3;
            $employee->social_security = strip_tags($applicant_detail['personal_number']);
            $employee->address = strip_tags($applicant_detail['address']);
            $employee->city = strip_tags($applicant_detail['city']);
            $employee->post = strip_tags($applicant_detail['post']);
            $applicant_detail['telephone'] = substr($applicant_detail['telephone'], 1);
            $applicant_detail['telephone'] = str_replace("-", "", $applicant_detail['telephone']);
            $applicant_detail['telephone'] = str_replace(" ", "", $applicant_detail['telephone']);
            $applicant_detail['mobile'] = substr($applicant_detail['mobile'], 1);
            $applicant_detail['mobile'] = str_replace("-", "", $applicant_detail['mobile']);
            $applicant_detail['mobile'] = str_replace(" ", "", $applicant_detail['mobile']);
            $employee->phone = $applicant_detail['telephone'];
            $employee->mobile = $applicant_detail['mobile'];
            $employee->email = strip_tags($applicant_detail['email']);
            $employee->company_id = $_SESSION['company_id'];
            // echo "<script>alert('".$username."')</script>;";
            $employee->begin_transaction();
            if ($employee->login_add(TRUE)) {
                if ($employee->employee_add()) {
                    if ($employee->company_update()) {
                        $message->set_message("success", 'applicant_selected_employee');
                        if ($applicant_skills) {
                            for ($i = 0; $i < count($applicant_skills); $i++) {
                                /*$description = '';
                                for ($j = 0; $j < count($applicant_skills[$i]['description']); $j++) {
                                    if ($description == '') {
                                        $description = $applicant_skills[$i]['description'][$j]['desc'];
                                    } else {
                                        $description = $description . "\n" . $applicant_skills[$i]['description'][$j]['desc'];
                                    }
                                }*/
                                $employee->employee_skill_add($applicant_skills[$i]['title'], $applicant_skills[$i]['description'], $employee->username);
                            }
                        }
                        $obj_recruitment->change_interview_candidate_status($app_id[0], $status, $offer_letter_date);
                        $compony_detail = $obj_customer->get_company_detail($_SESSION['company_id']);
                        $company_home = $compony_detail['website'];
                        $cirrus_link = $company['website'];
                        $logo = $compony_detail['logo'];
                        $company_name = $compony_detail['name'];
                        $contact_person = $compony_detail['contact_person1'];
                        $subject = $smarty->translate[employee_add];
                        $msg = $smarty->translate[name] . ' : ' . trim($applicant_detail['first_name']) . ' ' . trim($applicant_detail['last_name']) . '<br>' . $smarty->translate[address] . ' : ' . $applicant_detail['address'] . '<br>' . $smarty->translate[email] . ' : ' . $applicant_detail['email'] . '<br>' . $smarty->translate[phone] . ' : ' . $applicant_detail['phone'] . '<br>' . $smarty->translate[mobile] . ' : ' . $applicant_detail['mobile'] . '<br>' . $smarty->translate[username] . ' : ' . $username;
                        $msg .= '<br>' . $smarty->translate[contact_person_in_the_office] . ' : ' . $contact_person . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;
                        $mailer = new SimpleMail($subject, $msg);
                        $mailer->addSender("cirrus-noreplay@time2view.se");
                        $mailer->addRecipient($applicant_detail['email'], trim($applicant_detail['first_name']) . ' ' . trim($applicant_detail['last_name']));
                        $mailer->send();
                        $employee->commit_transaction();
                    }
                }
            }
            header("location:" . $smarty->url . "view/recruitment/applicant/" . $app_id[0] . "/");
            exit();
        } else {
            $obj_recruitment->change_interview_candidate_status($app_id[0], $status, $offer_letter_date);
            header("location:" . $smarty->url . "view/recruitment/applicant/" . $app_id[0] . "/");
            exit();
        }
    }
}
if ($_POST['action'] == 'update') {
    if ($obj_recruitment->social_security_check($_POST['personal_number'])) {
        $exist_app_id = $obj_recruitment->applicant_social_security_check($_POST['personal_number']);

        // echo $_POST['personal_number'].'<br/>';
        // echo "<pre>".print_r($exist_app_id, 1)."<pre>";
        // echo $app_id[0]; exit();
        if ($exist_app_id === FALSE || $exist_app_id == $app_id[0]) {
            $obj_recruitment->century         = $_POST['century'];
            $obj_recruitment->personal_number = preg_replace('/-/', '', $_POST['personal_number'], 1);
            $obj_recruitment->first_name      = $_POST['first_name'];
            $obj_recruitment->last_name       = $_POST['last_name'];
            $obj_recruitment->gender          = $_POST['gender'];
            $obj_recruitment->address         = $_POST['address'];
            $obj_recruitment->post_no         = $_POST['post_no'];
            $obj_recruitment->city            = $_POST['city'];
            $obj_recruitment->telephone       = $_POST['telephone'];
            $obj_recruitment->mobile          = $_POST['mobile'];
            $obj_recruitment->email           = $_POST['email'];
            $obj_recruitment->experience      = $_POST['experience'];
            $obj_recruitment->ref_name        = $_POST['ref_name'];
            $obj_recruitment->ref_mobile      = $_POST['ref_mobile'];
            // var_dump( $obj_recruitment->personal_number);exit();
            if ($obj_recruitment->recruitment_update_details($app_id[0])) {
                //Adding skill To the applicant
                // exit('exit');
                $message->set_message('success', 'data_saved');
                $obj_recruitment->skill_delete($app_id[0]);
                $title = $_POST['skill_title'];
                $description_skill = $_POST['skill_desc'];
                for ($i = 0; $i < count($title); $i++) {
                    $obj_recruitment->application_id = $app_id[0];
                    $obj_recruitment->title = $title[$i];
                    $obj_recruitment->description = $description_skill[$i];
                    if ($obj_recruitment->title != '' || $obj_recruitment->description != '') {
                        $obj_recruitment->skill_insert();
                    }
                }
                if ($_POST['Date_of_Interview']) {
                    $obj_recruitment->date_of_interview = $_POST['Date_of_Interview'];
                    $application_detail = $obj_recruitment->recruitment_details($app_id[0]);
                    $interview_detail = $obj_recruitment->get_interview_call_detail($app_id[0]);
                    $obj_recruitment->application_id = $application_detail['id'];
                    $obj_recruitment->personal_number = $application_detail['personal_number'];
                    $obj_recruitment->interview_call_date = date('Y-m-d H:i:s');
                    $obj_recruitment->status = 1;
                    $obj_recruitment->mail_date = date('Y-m-d H:i:s');
                    $obj_recruitment->company_id = $_SESSION['company_id'];
                    $interview_detail_check = $obj_recruitment->get_interview_call_detail($obj_recruitment->application_id);
                    if($obj_recruitment->backup_old_interview_date($interview_detail_check['date_of_interview'])){ 
                        if ($obj_recruitment->reschedule_interview_date()) {
                            $compony_detail = $obj_customer->get_company_detail($_SESSION['company_id']);
                            $message->set_message("success", 'interview_date_reschedule_sucess');
                            $company_home = $compony_detail['website'];
                            $cirrus_link = $company['website'];
                            $contact_person = $compony_detail['contact_person1'];
                            $logo = $compony_detail['logo'];
                            $company_name = $compony_detail['name'];
                            $subject = $smarty->translate[interview_call];
                            $msg = $smarty->translate[name] . ' : ' . trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']) . '<br/>';
                            $msg .= $smarty->translate[selected_for_the_interview_on] . "<br/>" . $smarty->translate[re_scheduled_to] . " " . $obj_recruitment->date_of_interview . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;

                            $mailer = new SimpleMail($subject, $msg);
                            $mailer->addSender("cirrus-noreplay@time2view.se");
                            $mailer->addRecipient($application_detail['email'], trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']));
                            $mailer->send();
                        }
                    }
                }
            } else {
                $message->set_message("fail", 'error_saving');
            }
        } else {
            $message->set_message('fail', 'social_security_exist');
        }
    } else {
        $message->set_message('fail', 'this_social_security_number_is_wrong');
    }
    header("location:" . $smarty->url . "view/recruitment/applicant/" . $app_id[0] . "/");
    exit();
}
if ($_POST['reschedule'] == 'reschedule') {
    $dtz = new DateTime; // current time = server time
    $dtz->setTimestamp(time());
    $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
    $today = $dtz->format('Y-m-d H:i:s');
    $obj_recruitment->date_of_interview = $_POST['Date_of_Interview'];
    $application_detail = $obj_recruitment->recruitment_details($app_id[0]);
    // $interview_detail = $obj_recruitment->get_interview_call_detail($app_id[0]);
    $obj_recruitment->application_id = $application_detail['id'];
    $obj_recruitment->personal_number = $application_detail['personal_number'];
    $obj_recruitment->date_of_offer_letter_send = $today;
    $obj_recruitment->status = 1;
    $obj_recruitment->mail_date = $today;
    $obj_recruitment->company_id = $_SESSION['company_id'];
    // $obj_recruitment->batch_id = 1;

    // last edit sreerag 13/02/2018 intreview date insert and update;

    $interview_detail_check = $obj_recruitment->get_interview_call_detail($obj_recruitment->application_id);
    // echo $obj_recruitment->application_id;
    // echo "<pre>".print_r($interview_detail_check,1)."</pre>";
    // exit();

    
        if(empty($interview_detail_check)){
            $flag=$obj_recruitment->get_interview_add(0);
        }
        else{
            $flag=$obj_recruitment->reschedule_interview_date();
            $obj_recruitment->backup_old_interview_date($interview_detail_check['date_of_interview']);
        }
    // echo "_POST<pre>".print_r($_POST, 1)."<pre>";
    // echo "app_id<pre>".print_r($app_id, 1)."<pre>"; 
    // echo "application_detail<pre>".print_r($application_detail, 1)."<pre>";
    //get_interview_call_detail

    if ($flag) {
        // echo 'Entered'; exit();
        $message->set_message('success', 'interview_date_reschedule_sucess');
        $compony_detail = $obj_customer->get_company_detail($_SESSION['company_id']);
        $company_home   = $compony_detail['website'];
        $cirrus_link    = $company['website'];
        $contact_person = $compony_detail['contact_person1'];
        $logo           = $compony_detail['logo'];
        $company_name   = $compony_detail['name'];
        $subject        = $smarty->translate[interview_call];
        $msg = $smarty->translate[name] . ' : ' . trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']) . '<br/>';
        $msg .= $smarty->translate[selected_for_the_interview_on] . '<br/> ' . $smarty->translate[re_scheduled_to] . " " . $obj_recruitment->date_of_interview . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;
        $mailer = new SimpleMail($subject, $msg);
        $mailer->addSender("cirrus-noreplay@time2view.se");
        $mailer->addRecipient($application_detail['email'], trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']));
        $mailer->send();
    }
    header("location:" . $smarty->url . "view/recruitment/applicant/" . $app_id[0] . "/");
    exit();

    // last edit sreerag 13/02/2018 intreview date insert and update;
}


$prev_schedule = $obj_recruitment->get_previous_schedules($app_id[0]);
if ($prev_schedule) {
    $smarty->assign('show_prev', '1');
} else {
    $smarty->assign('show_prev', '0');
}


$applicant_detail = $obj_recruitment->get_applicant_detail($app_id[0]);
$employee_name    = $_SESSION['company_sort_by'] == 1 ?  $applicant_detail['first_name']. ' '. $applicant_detail['last_name'] : $applicant_detail['last_name']. ' '. $applicant_detail['first_name'];

$applicant_comments = $obj_recruitment->get_all_comments_applicant($app_id[0]);
$smarty->assign('employee_name', $employee_name);
$smarty->assign('applicant', $applicant_detail);
$smarty->assign('applicant_skills', $applicant_skills);
$smarty->assign('comments', $applicant_comments);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|recruitment_applicant_view.tpl');
?>