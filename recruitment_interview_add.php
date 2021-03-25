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
$smarty = new smartySetup(array('recruitment.xml','recruitment_button.xml'));
$recruitment = new recruitment();
$customer = new customer();
$employee = new employee();
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
global $company;
$search_type = 1;
$filter_type = '';
$action = $_POST['action'];
$query_string = $_SERVER['QUERY_STRING'];
if($query_string){
    $type_recruitment = $query_string;
    $action = "4";
}elseif(isset($_POST['type_recruitment'])){
    $type_recruitment = $_POST['type_recruitment'];
}
else
    $type_recruitment = 5;

if($_POST['selection_search'] == "")
    $search_type = 1;
else
   $search_type = $_POST['selection_search']; 
if ($action == "2") {

    $dtz = new DateTime; // current time = server time
    $dtz->setTimestamp(time());
    $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
    // $today = date("Y-m-d H:i:s");
    $today = $dtz->format('Y-m-d H:i:s');


    $applicant_ids = explode(",", $_POST['selected_per_num']);
    $recruitment->interview_call_date = $today;
    $recruitment->date_of_interview = $_POST['Date_of_Interview'];
    $recruitment->status = 1;
    
   // $recruitment->date_of_offer_letter_send = date('Y-m-d H:i:s');
    $recruitment->mail_date = $today;
    $recruitment->company_id = $_SESSION['company_id'];
    for ($i = 0; $i < count($applicant_ids); $i++) {
        $application_detail = $recruitment->recruitment_details($applicant_ids[$i]);
        $recruitment->application_id = $application_detail['id'];
        $recruitment->personal_number = $application_detail['personal_number'];
        if($recruitment->get_interview_add()){
            $compony_detail = $customer->get_company_detail($_SESSION['company_id']);
            
            $message = 'interview_date_giving_sucess';
            $type = "success";
            $messages->set_message($type, $message);
            
            $company_home   = $compony_detail['website'];
            $cirrus_link    = $company['website'];
            $contact_person = $compony_detail['contact_person1'];
            $logo           = $compony_detail['logo'];
            $company_name   = $compony_detail['name'];
            $subject = $smarty->translate[interview_call];
            $msg = $smarty->translate[name] . ' : ' . trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']). '<br>';
            $msg .=  $smarty->translate[selected_for_the_interview_on] . '  ' . $recruitment->date_of_interview . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;
            $mailer = new SimpleMail($subject, $msg);
            $mailer->addSender("cirrus-noreplay@time2view.se");
            $mailer->addRecipient($application_detail['email'], trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']));
            $mailer->send();
            
            
        }
    }
    $smarty->assign('applicants', $recruitment->recruitment_selectall());
    $search_type = $_POST['selection_search'];
} 
elseif ($action == "1") {
    
    
   // echo $_POST['serach_key'];
    $search_type = $_POST['selection_search'];
    if($search_type == '1'){
        $type_recruitment = $_POST['type_recruitment'];
        $personal_number = $_POST['serach_key'];
        $applicants = $recruitment->recruitment_personal_check($personal_number,$type_recruitment);
    //    $search_type = $_POST['selection_search'];
       // if($applicants)
       //     $type_recruitment = $applicants[0]['status'];
       // else
            
    }else if($search_type == '2'){
        $name = $_POST['serach_key'];
        $type_recruitment = $_POST['type_recruitment'];
        $applicants = $recruitment->recruitment_name_check($name,$type_recruitment);
    }
    $smarty->assign('ssn_num',$_POST['serach_key']);
    $smarty->assign('applicants', $applicants);
}
elseif($action == "3"){
    $age_from = $_POST['age_from'];
    $age_to = $_POST['age_to'];
    $current_year = date("Y");
    if($age_from != ''){
        $year_from = $current_year-$age_from;
        $year_to = $current_year-$age_to;
    }else{
        $year_from = '';
        $year_to = '';
    }
    $qual = $_POST['qual'];
    $lang = $_POST['lang'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $search_type = $_POST['selection_search'];
    $filter_type = $_POST['filter_type'];
    $smarty->assign('filter_type',$filter_type);
    $smarty->assign('value_filter_qual',$qual);
    $smarty->assign('value_filter_lang',$lang);
    $smarty->assign('value_filter_city',$city);
    $smarty->assign('value_filter_gender',$gender);
    $smarty->assign('value_filter_age_from',$age_from);
    $smarty->assign('value_filter_age_to',$age_to);
    $smarty->assign('filter_type',$filter_type);
    $type_recruitment = $_POST['type_recruitment'];
    $applicants = $recruitment->get_applicants_depending_filter($year_from,$year_to,$qual,$lang,$city,$gender,$type_recruitment);
    $smarty->assign('applicants', $applicants);  
}
elseif($action == "4"){
   // $type_recruitment = $_POST['type_recruitment'];
    $smarty->assign('type_recruitment',$type_recruitment);
    if($type_recruitment == '5')
       $smarty->assign('applicants', $recruitment->recruitment_all_candidates()); 
    else if($type_recruitment == '0')
       $smarty->assign('applicants', $recruitment->recruitment_selectall()); 
    else
        $smarty->assign('applicants', $recruitment->recruitment_select_applicant($type_recruitment));
}
elseif($action == "5"){
    // echo "<pre>".print_r($_POST, 1)."<pre>"; exit();
    $type_recruitment = $_POST['type_recruitment'];
    $smarty->assign('type_recruitment',$type_recruitment);
    $applicant_ids = explode(",", $_POST['selected_per_num']);
    if($type_recruitment == 1){
        $status = 5;
    }else{
        $status = $type_recruitment+1;
    }
    $offer_letter_date = NULL;
   // if($type_recruitment ==  4)
    if($type_recruitment == 1){
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        // $today = date("Y-m-d H:i:s");
        $offer_letter_date = $dtz->format('Y-m-d H:i:s');
        // $offer_letter_date = date('Y-m-d H:i:s');
    }

    // last edit sreerag 15/02/2018 employee creation from applicants

    for ($k = 0; $k < count($applicant_ids); $k++) {
       // $recruitment->change_interview_candidate_status($applicant_ids[$i],$status,$offer_letter_date);
        $application_detail = $recruitment->recruitment_details($applicant_ids[$k]);
        if($type_recruitment == 1){
            $replacable = array('Ä','Å','É','Ö','ä','å','é','ö');
            $replac_with = array('a','a','e','o','a','a','e','o');
            $first_name = str_replace($replacable, $replac_with, $application_detail['first_name']);
            $last_name = str_replace($replacable, $replac_with, $application_detail['last_name']);
            
           // $first_name = strip_tags($application_detail['first_name']);
           // $last_name = strip_tags($application_detail['last_name']);
            $first_remove = array();
            $last_remove = array();
            for($i=0;$i<strlen($first_name);$i++){
                if((ord(substr($first_name,$i,1)) >= 97 && ord(substr($first_name,$i,1)) <= 122) || (ord(substr($first_name,$i,1)) >= 65 && ord(substr($first_name,$i,1)) <= 90)){
                    continue;
                }else{
                    $first_remove[] = substr($first_name,$i,1);
                }
            }
            for($i=0;$i<count($first_remove);$i++){
                $first_name = str_replace($first_remove[$i],"",$first_name);
            }
            for($i=0;$i<strlen($last_name);$i++){
                if((ord(substr($last_name,$i,1)) >= 97 && ord(substr($last_name,$i,1)) <= 122) || (ord(substr($last_name,$i,1)) >= 65 && ord(substr($last_name,$i,1)) <= 90)){
                    continue;
                }else{
                    $last_remove[] = substr($last_name,$i,1);
                }
            }
            for($i=0;$i<count($last_remove);$i++){
                $last_name = str_replace($last_remove[$i],"",$last_name);
            }

            if((ord(substr($first_name,0,1)) >= 97 && ord(substr($first_name,0,1)) <= 122) || (ord(substr($first_name,0,1)) >= 65 && ord(substr($first_name,0,1)) <= 90)){
                $first_name_1 = substr($first_name,0,1);
            }else{
                $first_name_1 = "a";
            }
            if((ord(substr($first_name,1,1)) >= 97 && ord(substr($first_name,1,1)) <= 122) || (ord(substr($first_name,1,1)) >= 65 && ord(substr($first_name,1,1)) <= 90)){
                $first_name_2 = substr($first_name,1,1);
            }else{
                $first_name_2 = "a";
            }
            $customer->first_name = $first_name_1.$first_name_2;
            if((ord(substr($last_name,0,1)) >= 97 && ord(substr($last_name,0,1)) <= 122) || (ord(substr($last_name,0,1)) >= 65 && ord(substr($last_name,0,1)) <= 90)){
                $last_name_1 = substr($last_name,0,1);
            }else{
                $last_name_1 = "a";
            }
            if((ord(substr($last_name,1,1)) >= 97 && ord(substr($last_name,1,1)) <= 122) || (ord(substr($last_name,1,1)) >= 65 && ord(substr($last_name,1,1)) <= 90)){
                $last_name_2 = substr($last_name,1,1);
            }else{
                $last_name_2 = "0";
            }
            $customer->last_name = $last_name_1.$last_name_2;
            $username = $customer->get_username(strtolower(substr($customer->first_name,0,2)).strtolower(substr($customer->last_name,0,2)));
            
            // echo $username; //exit();
            // echo '<br/>'.$status; exit();
            // ADding Employee To Get the company
        
            //echo "<pre>".print_r($application_detail,1)."<pre>";exit();
            $employee->first_name = strip_tags(trim(urldecode($application_detail['first_name'])));
            $employee->last_name = strip_tags(trim(urldecode($application_detail['last_name'])));
            $employee->gender = strip_tags($application_detail['gender']) == 1 ? 1 : 2; //$application_detail['gender'] => 1(Male) | 2(Female)
            $employee->username = $username;
            $employee->century = $application_detail['century'];
            $employee->role = 3;
            $employee->social_security =  strip_tags($application_detail['personal_number']);
            $employee->address = strip_tags($application_detail['address']);
            $employee->city = strip_tags($application_detail['city']);
            $employee->post = strip_tags($application_detail['post_no']);
            $application_detail['telephone'] = substr($application_detail['telephone'], 1);
            $application_detail['telephone'] = str_replace("-", "", $application_detail['telephone']);
            $application_detail['telephone'] = str_replace(" ", "", $application_detail['telephone']);
            $application_detail['mobile'] = substr($application_detail['mobile'], 1);
            $application_detail['mobile'] = str_replace("-", "", $application_detail['mobile']);
            $application_detail['mobile'] = str_replace(" ", "", $application_detail['mobile']);
            $employee->phone = $application_detail['telephone'];
            $employee->mobile = $application_detail['mobile'];
            $employee->email = strip_tags($application_detail['email']);
            $employee->company_id = $_SESSION['company_id'];
            $employee->date = $offer_letter_date;
            $employee->password = '12345678';
            // echo "<script>alert('".$username."')</script>;";
             
             $social_security_check_flag = $recruitment->interviwed_applicant_social_security_check($application_detail['personal_number']);
             if($social_security_check_flag == 1){
                $messages->set_message('fail', 'social_security_exist');
                break;
             }
             else{
                $employee->begin_transaction();
                if ($employee->login_add(TRUE)) {
                    if ($employee->employee_add()) {
                        if($employee->company_update()){
                            $message = 'applicant_selected_employee';
                            $type = "success";
                            $messages->set_message($type, $message);
                            $applicant_skills = $recruitment->get_all_skills_applicant($applicant_ids[$k]);
                            if($applicant_skills){
                                for($i=0;$i<count($applicant_skills);$i++){
                                    /*$description = '';
                                    for($j=0;$j<count($applicant_skills[$i]['description']);$j++){
                                       if($description == ''){
                                           $description = $applicant_skills[$i]['description'][$j]['desc'];
                                       }else{
                                           $description = $description."\n".$applicant_skills[$i]['description'][$j]['desc'];
                                       }
                                    }*/
                                    $employee->employee_skill_add($applicant_skills[$i]['title'],$applicant_skills[$i]['description'],date('Y-m-d H:i:s'), $employee->username, $_SESSION['user_id']);
                                }
                            } 
                            // echo "change_interview_candidate_status<pre>".print_r(array($applicant_ids[$i],$status,$offer_letter_date), 1)."<pre>";
                            $recruitment->change_interview_candidate_status($applicant_ids[$k],$status,$offer_letter_date);
                            $compony_detail = $customer->get_company_detail($_SESSION['company_id']);
                            $company_home = $compony_detail['website'];
                            $cirrus_link = $company['website'];
                            $logo = $compony_detail['logo'];
                            $company_name = $compony_detail['name'];
                            $contact_person = $compony_detail['contact_person1'];
                            $subject = $smarty->translate[employee_add];
                            $msg = $smarty->translate[name] . ' : ' . trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']) . '<br>' . $smarty->translate[address] . ' : ' . $application_detail['address'] . '<br>' . $smarty->translate[email] . ' : ' . $application_detail['email'] . '<br>' . $smarty->translate[telephone] . ' : ' . $application_detail['phone'] . '<br>' . $smarty->translate[mobile] . ' : ' . $application_detail['mobile'] . '<br>' . $smarty->translate[username] . ' : ' . $username;
                            $msg .= '<br>' . $smarty->translate[contact_person_in_the_office] . ' : ' . $contact_person . '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;
                            $mailer = new SimpleMail($subject, $msg);
                            $mailer->addSender("cirrus-noreplay@time2view.se");
                            $mailer->addRecipient($application_detail['email'], trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']));
                            $mailer->send();
                            $employee->commit_transaction();
                        }
                    }
                }
            }
            
        }else{
            
            $recruitment->change_interview_candidate_status($applicant_ids[$k],$status,$offer_letter_date);
            $message = 'interview_date_giving_sucess';
            $type = "success";
            $messages->set_message($type, $message);
        }
    }

    // last edit sreerag 15/02/2018 employee creation  from applicants

    $smarty->assign('applicants', $recruitment->recruitment_select_applicant($type_recruitment));
}
elseif($action == "6"){
    $type_recruitment = $_POST['type_recruitment'];
    $applicant_ids = explode(",", $_POST['selected_per_num']);
    $recruitment->date_of_interview = $_POST['Date_of_Interview'];
    for ($i = 0; $i < count($applicant_ids); $i++) {
        $application_detail = $recruitment->recruitment_details($applicant_ids[$i]);
        $interview_detail = $recruitment->get_interview_call_detail($applicant_ids[$i]);
        $recruitment->application_id = $application_detail['id'];
        if($recruitment->backup_old_interview_date($interview_detail['date_of_interview'])){
            if($recruitment->reschedule_interview_date()){
                $message = 'interview_date_reschedule_sucess';
                $type = "success";
                $messages->set_message($type, $message);
                $compony_detail = $customer->get_company_detail($_SESSION['company_id']);

                $company_home   = $compony_detail['website'];
                $cirrus_link    = $company['website'];
                $contact_person = $compony_detail['contact_person1'];
                $logo           = $compony_detail['logo'];
                $company_name   = $compony_detail['name'];
                $subject        = $smarty->translate[interview_call];
                $msg = $smarty->translate[name] . ' : ' . trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']). '<br>';
                $msg .=  $smarty->translate[selected_for_the_interview_on] . '  ' . $interview_detail['date_of_interview'] ." ".$smarty->translate[re_scheduled_to]." ".$recruitment->date_of_interview. '<br>' . $smarty->translate[link_to_company_home_page] . ' : ' . $company_home . '<br>' . $smarty->translate[link_to_cirrus] . ' : ' . $cirrus_link;
                $mailer = new SimpleMail($subject, $msg);
                $mailer->addSender("cirrus-noreplay@time2view.se");
                $mailer->addRecipient($application_detail['email'], trim($application_detail['first_name']) . ' ' . trim($application_detail['last_name']));
                $mailer->send();
            }
        }
    }
    $smarty->assign('applicants', $recruitment->recruitment_select_applicant($type_recruitment));
}
else{
    $type_recruitment = '5';
    $smarty->assign('applicants', $recruitment->recruitment_all_candidates());
    // echo '<pre>'.print_r($recruitment->recruitment_all_candidates(), 1).'</pre>'; exit();
}
    //$smarty->assign('applicants', $recruitment->recruitment_selectall());
$smarty->assign('type_recruitment',$type_recruitment);
$smarty->assign('filter_type', $filter_type);
$smarty->assign('search_type', $search_type);
$qualifications = $recruitment->get_qualifications_applicant();
$language = $recruitment->get_language_applicant();
$city = $recruitment->get_city_applicant();
$smarty->assign('qualifications',$qualifications);
$smarty->assign('languages_applicant',$language);
$smarty->assign('cities',$city);
$smarty->assign('search_type',$search_type);
//echo "<pre>". print_r($qualifications, 1)."</pre>";


//$x = $recruitment->recruitment_selectall();
//$smarty->assign('applicants', $recruitment->recruitment_selectall());


$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|recruitment_interview_add.tpl');
?>