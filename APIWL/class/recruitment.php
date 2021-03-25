<?php

require_once('configs/config.inc.php');
require_once ('class/db.php');

class recruitment extends db {

    //variable declaration

    var $century = '';
    var $personal_number = '';
    var $first_name = '';
    var $last_name = '';
    var $gender = '';
    var $post_no = '';
    var $city = '';
    var $telephone = '';
    var $mobile = '';
    var $email = '';
    var $photo = '';
    var $preferred_company = '';
    var $qualification = '';
    var $experience = '';
    var $former_company = '';
    var $contact_no = '';
    var $language_known = '';
    var $resume_title = '';
    var $attach_resume = '';
    var $type_resume = '';
    var $ref_social_security_no = '';
    var $ref_name = '';
    var $ref_mobile = '';
    var $exp_name = '';
    var $qual_name = '';
    var $lang_name = '';
    var $title = '';
    var $description = '';
    var $social_security = '';
    var $batch_id = '0';
    var $interview_call_date = '';
    var $date_of_interview = '';
    var $mail_date = '';
    var $remarks = '';
    var $status = '';
    var $date_of_offer_letter_send = '';
    var $application_id = '';
    var $company_id = '';
    var $date = '';
    var $comment = '';

    function __construct() {
        parent::__construct();
    }

    function recruitment_add() {
        $this->tables = array('applicant');
        $this->fields = array('century', 'personal_number', 'first_name', 'last_name', 'gender', 'address', 'post_no', 'city', 'telephone', 'mobile', 'email', 'photo', 'qualification', 'experience', 'former_company', 'contact_no', 'language_known', 'resume_title', 'attach_resume', 'type_resume', 'ref_social_security_no', 'ref_name', 'ref_mobile', 'password');
        $this->field_values = array($this->century, $this->personal_number, $this->first_name, $this->last_name, $this->gender, $this->address, $this->post_no, $this->city, $this->telephone, $this->mobile, $this->email, $this->photo, $this->qualification, $this->experience, $this->former_company, $this->contact_no, $this->language_known, $this->resume_title, $this->attach_resume, $this->type_resume, $this->ref_social_security_no, $this->ref_name, $this->ref_mobile, '');
//     echo '<pre>fields: '.print_r($this->fields, 1).'</pre>';
//     echo '<pre>field_values: '.print_r($this->field_values, 1).'</pre>';
        if ($this->query_insert()) {
            return $this->get_id();
        } else {
            return FALSE;
        }
//        return TRUE;
    }



    function recruitment_update_details($id) {
        $this->tables = array('applicant');
        $this->fields = array('century', 'personal_number', 'first_name', 'last_name', 'gender', 'address', 'post_no', 'city', 'telephone', 'mobile', 'email', 'photo', 'qualification', 'experience', 'former_company', 'contact_no', 'language_known', 'resume_title', 'attach_resume', 'type_resume', 'ref_social_security_no', 'ref_name', 'ref_mobile');
        $this->field_values = array($this->century, $this->personal_number, $this->first_name, $this->last_name, $this->gender, $this->address, $this->post_no, $this->city, $this->telephone, $this->mobile, $this->email, $this->photo, $this->qualification, $this->experience, $this->former_company, $this->contact_no, $this->language_known, $this->resume_title, $this->attach_resume, $this->type_resume, $this->ref_social_security_no, $this->ref_name, $this->ref_mobile);
        $this->conditions = array('id=?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function recruitment_details($id) {
        $this->tables = array('applicant');
        $this->fields = array('id','century', 'personal_number', 'first_name', 'last_name', 'gender', 'address', 'post_no', 'city', 'telephone', 'mobile', 'email', 'photo', 'qualification', 'experience', 'former_company', 'contact_no', 'language_known', 'resume_title', 'attach_resume', 'type_resume', 'ref_social_security_no', 'ref_name', 'ref_mobile');
        $this->conditions = array('id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function recruitment_selectall() {
        $this->tables = array('interview_candidates` AS `ic');
        $this->fields = array('ic.application_id');
        $this->query_generate();
        $query = $this->sql_query;
        $this->tables = array('applicant` AS `ap');
        $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile', 'ap.created_date');
        $this->conditions = array('NOT IN','ap.id',$query);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data : array());
    }
    // function recruitment_selectall_my() {
    //     $this->tables = array('interview_candidates` AS `ic');
    //     $this->fields = array('ic.application_id');
    //     $this->conditions = array('AND','CONCAT(ic.abc=?,ic.qwe=?)',array('OR','abc','def'));
    //     // $this->condition_values = array(100,200);
    //     $this->query_generate();
    //     $query = $this->sql_query;
    //     $this->tables = array('applicant` AS `ap');
    //     $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender');
    //     $this->conditions = array('NOT IN','ap.id',$query);
    //     $this->query_generate();
    //     echo $this->sql_query;
    //     $data = $this->query_fetch();
    //     return ($data ? $data : array());
    // }

    function recruitment_personal_check($personal_number,$type_recruitment) {
        if($type_recruitment == 0){
            $this->tables = array('applicant` AS `ap');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile', 'ap.created_date');
            $this->conditions = array('AND','ap.personal_number LIKE ?');
            $this->condition_values = array("%".$personal_number."%");
            $this->query_generate();
            $data = $this->query_fetch();
        }elseif($type_recruitment == 5){
            $this->tables = array('applicant` AS `ap');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile', 'ap.created_date');
            $this->conditions = array('AND','ap.personal_number LIKE ?');
            $this->condition_values = array("%".$personal_number."%");
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $this->tables = array('interview_candidates` AS `ic');
                    $this->fields = array('ic.status','ic.date_of_interview');
                    $this->conditions = array('ic.application_id = ?');
                    $this->condition_values = array($data[$i]['id']);
                    $this->query_generate();
                    $data1 = $this->query_fetch();
                    if($data1){
                      $data[$i]['status'] =  $data1[0]['status'];
                      $data[$i]['date_of_interview'] =  $data1[0]['date_of_interview'];
                    }
                    else
                        $data[$i]['status'] =  0;
                }
            }
            
        }else{
            $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.status','ic.date_of_interview', 'ap.created_date');
            $this->conditions = array('AND','ap.personal_number LIKE ?','ic.status = ?','ap.id = ic.application_id');
            $this->condition_values = array("%".$personal_number."%",$type_recruitment);
            $this->query_generate();
            $data = $this->query_fetch();
        }
        
        if($type_recruitment == 0 && $data){
            for($i=0;$i<count($data);$i++){
                $data[$i]['status'] =  0;
            }
            return $data;
        }elseif($data)
            return $data;
        else
            return array();
    }

    function recruitment_delete() {
        $this->tables = array('applicant');
        $this->field = array('century', 'personal_number', 'first_name', 'last_name', 'gender', 'address', 'post_no', 'city', 'telephone', 'mobile', 'email', 'photo', 'qualification', 'experience',  'former_company', 'contact_no', 'language_known', 'resume_title', 'attach_resume', 'type_resume', 'ref_social_security_no', 'ref_name', 'ref_mobile');
        $this->field_values = array($this->century, $this->personal_number, $this->first_name, $this->last_name, $this->gender, $this->address, $this->post_no, $this->city, $this->telephone, $this->mobile, $this->email, $this->photo, $this->qualification, $this->experience, $this->former_company_name, $this->contact_no, $this->languages_known, $this->resume_title, $this->attach_resume, $this->type_resume, $this->ref_social_security_no, $this->ref_name, $this->ref_mobile);
        $this->condition = array('id=?');
        $this->condition_values = array($id);
    }

    function get_company_name() {
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'status');
        $this->conditions = array('status = 1');
        $this->query_generate();
        $data = $this->query_fetch();
        return($data);
    }

    function skill_insert() {
        $this->tables = array('skill');
        $this->fields = array('application_id', 'title', 'description');
        $this->field_values = array($this->application_id, $this->title, $this->description);
        if ($this->query_insert()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    function skill_delete($application_id){
        $this->tables = array('skill');
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($application_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
    
    function get_skill() {
        $this->tables = array('skill');
        $this->fields = array('id','application_id', 'title', 'description');
        $this->query_generate();
        $data = $this->query_fetch();
         return ($data ? $data : array());
    }

    function skill_details($id) {
        $this->tables = array('skill');
        $this->fields = array('personal_number', 'title', 'description');
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function skill_update_details($id) {
        $this->tables = array('skill');
        $this->fields = array('personal_number', 'title', 'description');
        $this->field_values = array($this->personal_number, $this->title, $this->description);
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function experience_ins() {
        $this->tables = array('experience');
        $this->fields = array('exp_name');
        $this->field_values = array($this->exp_name);
        if ($this->query_insert()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function exp_details($id) {
        $this->tables = array('experience');
        $this->fields = array('exp_name');
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function exp_update_details($id) {
        $this->tables = array('experience');
        $this->fields = array('exp_name');
        $this->field_values = array($this->exp_name);
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function language_ins() {
        $this->tables = array('language');
        $this->fields = array('lang_name');
        $this->field_values = array($this->lang_name);
        if ($this->query_insert()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function language_details($id) {
        $this->tables = array('language');
        $this->fields = array('lang_name');
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function language_update_details($id) {
        $this->tables = array('language');
        $this->fields = array('lang_name');
        $this->field_values = array($this->lang_name);
        $this->condition = array('id=?');
        $this->condition_valuepersonal_numbers = array($id);
        return $this->query_update();
    }

    function qualification_ins() {
        $this->tables = array('qualification');
        $this->fields = array('qual_name');
        $this->field_values = array($this->qual_name);
        if ($this->query_insert()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function qualification_details($id) {
        $this->tables = array('qualification');
        $this->fields = array('qual_name');
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function qualification_update_details($id) {
        $this->tables = array('qualification');
        $this->fields = array('qual_name');
        $this->field_values = array($this->qual_name);
        $this->condition = array('id=?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function get_interview_add($insert_id_too = FALSE) {
        $this->tables = array('interview_candidates');
        $this->fields = array('application_id','social_security', 'batch_id', 'date_of_interview', 'mail_date', 'remarks', 'status', 'date_of_offer_letter_send','company_id');
        $this->field_values = array($this->application_id,$this->personal_number, $this->batch_id, $this->date_of_interview, $this->mail_date, $this->remarks, $this->status, $this->date_of_offer_letter_send,$this->company_id);
       
       if($insert_id_too !== FALSE){
            $this->fields[] = 'id';
            $this->field_values[] = $insert_id_too;
       }

        if ($this->query_insert()) {

            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_interview_add($id) {
        $this->tables = array('interview_candidates');
        $this->fields = array('social_security', 'batch_id', 'interview_call_date', 'date_of_interview', 'mail_date', 'remarks', 'status', 'date_of_offer_letter_send');
        $this->field_values = array($this->social_security, $this->batch_id, $this->interview_call_date, $this->date_of_interview, $this->mail_date, $this->remarks, $this->status, $this->date_of_offer_letter_send);
        $this->conditions = array('id=?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function select_interview_add($id) {
        $this->tables = array('interview_candidates');
        $this->fields = array('social_security', 'batch_id', 'interview_call_date', 'date_of_interview', 'mail_date', 'remarks', 'status', 'date_of_offer_letter_send');
        $this->conditions = array('id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data[0] : FALSE);
    }

    function delete_interview_add($id) {
        $this->tables = array('interview_candidates');
        $this->fields = array('social_security', 'batch_id', 'interview_call_date', 'date_of_interview', 'mail_date', 'remarks', 'status', 'date_of_offer_letter_send');
        $this->field_values = array($this->social_security, $this->batch_id, $this->interview_call_date, $this->date_of_interview, $this->mail_date, $this->remarks, $this->status, $this->date_of_offer_letter_send);
        $this->conditions = array('$id=?');
        $this->condition_values = array($id);
    }
    
    // function to get the Qualifications 
    function get_qualifications_applicant(){
        $this->tables = array('applicant');
        $this->fields = array('DISTINCT(qualification)');
        $this->conditions = array('AND','qualification != ""','qualification IS NOT NULL');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data){
            return $data;
        }else
            return array();
    }
    
    function get_language_applicant(){
        $this->tables = array('applicant');
        $this->fields = array('DISTINCT(language_known)');
        $this->conditions = array('AND','language_known != ""','language_known IS NOT NULL');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data){
            return $data;
        }else
            return array();
    }
    function get_city_applicant(){
        $this->tables = array('applicant');
        $this->fields = array('DISTINCT(city)');
        $this->conditions = array('AND','city != ""','city IS NOT NULL');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data){
            return $data;
        }else
            return array();
    }
    
    
    function get_applicants_depending_filter($year_from,$year_to,$qual,$lang,$city,$gender,$type_recruitment){
        $this->tables = array('interview_candidates` AS `ic');
        $this->fields = array('ic.application_id');
        if($type_recruitment != 0 && $type_recruitment != 5){
            $this->conditions = array('AND','ic.status = "'.$type_recruitment.'"');
            $this->conditions[] = 'ic.company_id = "'.$_SESSION['company_id'].'"';
//            $this->condition_values = array($type_recruitment);
        }
        $this->query_generate();
        $query = $this->sql_query;
        $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
        $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status', 'ap.created_date');
        if($type_recruitment == 0){
            $this->conditions = array('AND',array('NOT IN','ap.id',$query));
        }else{
            $this->conditions = array('AND',array('IN','ap.id',$query));
        }
//        $this->conditions = array('AND',array('NOT IN','ap.id',$query));
        if($gender != ''){
            $this->conditions[] = array('ap.gender = "'.$gender.'"');
        }
//        $this->condition_values = array();
        if($year_from != ''){
            if($year_to > $year_from){
                $start_year = $year_from;
                $end_year = $year_to;
            }else{
                $start_year = $year_to;
                $end_year = $year_from; 
            }
            $this->conditions[] = array('BETWEEN','CONCAT(ap.century,SUBSTRING(ap.personal_number,1,2))','?','?');
            $this->condition_values[] = $start_year;
            $this->condition_values[] = $end_year;
        }if($qual != ''){
            $this->conditions[] = 'ap.qualification = ?';
            $this->condition_values[] = $qual;
        }if($lang != ''){
            $this->conditions[] = 'ap.language_known = ?';
            $this->condition_values[] = $lang;
        }if($city != ''){
            $this->conditions[] = 'ap.city = ?';
            $this->condition_values[] = $city;
        }
        $this->conditions[] = 'ap.id = ic.application_id';
//        if($type_recruitment != 0){
//            $this->conditions[] = 'company_id = "'.$_SESSION['company_id'].'"';
//        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($type_recruitment == 5){
            $this->tables = array('applicant` AS `ap');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile', 'ap.created_date');
        
            $this->conditions = array('AND',array('NOT IN','ap.id',$query));
//        $this->conditions = array('AND',array('NOT IN','ap.id',$query));
        if($gender != ''){
            $this->conditions[] = array('ap.gender = "'.$gender.'"');
        }
//        $this->condition_values = array();
        if($year_from != ''){
            if($year_to > $year_from){
                $start_year = $year_from;
                $end_year = $year_to;
            }else{
                $start_year = $year_to;
                $end_year = $year_from; 
            }
            $this->conditions[] = array('BETWEEN','CONCAT(ap.century,SUBSTRING(ap.personal_number,1,2))','?','?');
            $this->condition_values[] = $start_year;
            $this->condition_values[] = $end_year;
        }if($qual != ''){
            $this->conditions[] = 'ap.qualification = ?';
            $this->condition_values[] = $qual;
        }if($lang != ''){
            $this->conditions[] = 'ap.language_known = ?';
            $this->condition_values[] = $lang;
        }if($city != ''){
            $this->conditions[] = 'ap.city = ?';
            $this->condition_values[] = $city;
        }
//        if($type_recruitment != 0){
//            $this->conditions[] = 'company_id = "'.$_SESSION['company_id'].'"';
//        }
        $this->query_generate();
        $data1 = $this->query_fetch();
        $data = array_merge($data,$data1);
        }
        return ($data ? $data : array());
    }
    
    
    
    function recruitment_select_applicant($type_recruitment){
        $this->tables = array('interview_candidates` AS `ic');
        $this->fields = array('ic.application_id');
        $this->conditions = array('ic.status = ?');
        $this->condition_values = array($type_recruitment);
        $this->query_generate();
        $query = $this->sql_query;
        $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
        $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview', 'ap.created_date');
        $this->conditions = array('AND',array('IN','ap.id',$query),'ap.id = ic.application_id');
        $this->query_generate();
        $data = $this->query_fetch();
        return ($data ? $data : array());
        
        
    }
    function change_interview_candidate_status($applicant_ids,$status,$offer_letter_date){

        $this->tables = array('interview_candidates');
        if($offer_letter_date == NULL){
            $this->fields = array('status');
            $this->field_values = array($status);
        }else{
            $this->fields = array('status','date_of_offer_letter_send');
            $this->field_values = array($status,$offer_letter_date);
        }
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($applicant_ids);
        return ($this->query_update() ? TRUE : FALSE);
    }
    
    
   function recruitment_name_check($name,$type_recruitment) {
       
        $this->tables = array('interview_candidates` AS `ic');
        $this->fields = array('ic.application_id');
        if($type_recruitment != 0 && $type_recruitment != 5){
            $this->conditions = array('ic.status = "'.$type_recruitment.'"');
//            $this->condition_values = array($type_recruitment);
        }
        $this->query_generate();
        $query = $this->sql_query;

        $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
        $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status', 'ap.created_date');
        if($type_recruitment == 0){
           $this->conditions = array('AND',array('NOT IN','ap.id',$query));
        }else{
           $this->conditions = array('AND',array('IN','ap.id',$query)); 
        }
        $this->conditions[] = array('OR','CONCAT(ap.last_name," ",ap.first_name) = ?','ap.last_name LIKE ?','ap.first_name LIKE ?');
        $this->conditions[] = 'ic.application_id = ap.id';
        $this->condition_values = array($name,"%".$name."%","%".$name."%");
        $this->query_generate();
        $data = $this->query_fetch();
        
        if($type_recruitment == 5){
            $this->tables = array('applicant` AS `ap');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile', 'ap.created_date');
            $this->conditions = array('AND',array('NOT IN','ap.id',$query));
            $this->conditions[] = array('OR','CONCAT(ap.last_name," ",ap.first_name) = ?','ap.last_name LIKE ?','ap.first_name LIKE ?');
            
            $this->condition_values = array($name,"%".$name."%","%".$name."%");
            $this->query_generate();
            $data1 = $this->query_fetch();
            $data = array_merge($data,$data1);
        }
        return ($data ? $data : array());
        
    } 
    
    
    function recruitment_all_candidates(){
        
        $applied = $this->recruitment_selectall();
        $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
        $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status', 'ap.created_date');
        $this->conditions = array('ap.id = ic.application_id');
        $this->query_generate();
        $data = $this->query_fetch();
        $result = array_merge($data,$applied);
        return ($result ? $result : array());
    }
    
    
    
    function display_sorted_candidates($sort){
        if($sort == 0){
            $applied = $this->recruitment_selectall();
            $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status', 'ap.created_date');
            $this->conditions = array('ap.id = ic.application_id');
            $this->query_generate();
            $data = $this->query_fetch();
            $result = array_merge($applied,$data);
        }else{
            $applied = $this->recruitment_selectall();
            
            $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status', 'ap.created_date');
            $this->conditions = array('AND','ap.id = ic.application_id','ic.status = ?');
            $this->condition_values = array($sort);
            $this->query_generate();
            $data1 = $this->query_fetch();
            
            
            $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
            $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status', 'ap.created_date');
            $this->conditions = array('AND','ap.id = ic.application_id','ic.status != ?');
            $this->condition_values = array($sort);
            $this->query_generate();
            $data2 = $this->query_fetch();
            
            $result1 = array_merge($data1,$data2);
            
            $result = array_merge($result1,$applied);
        }
//        $applied = $this->recruitment_selectall();
//        $this->tables = array('applicant` AS `ap','interview_candidates` AS `ic');
//        $this->fields = array('ap.id','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ic.date_of_interview','ic.status');
//        $this->conditions = array('ap.id = ic.application_id');
//        $this->query_generate();
//        $data = $this->query_fetch();
//        $result = array_merge($data,$applied);
        return ($result ? $result : array());
    }
    
    
    function reschedule_interview_date(){
        $this->tables = array('interview_candidates');
        $this->fields = array('date_of_interview');
        $this->field_values = array($this->date_of_interview);
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($this->application_id);
        return $this->query_update();
    }
    
    function backup_old_interview_date($old_date){
        $this->tables = array('backup_interview_date');
        $this->fields = array('application_id','old_interview_date','date_made_change');
        $this->field_values = array($this->application_id,$old_date,date("Y-m-d H:i:s"));
        if($this->query_insert()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function get_interview_call_detail($app_id){
        $this->tables = array('interview_candidates` AS `ic');
        $this->fields = array('application_id','date_of_interview','status');
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($app_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0];
        }else{
            return array();
        }
    }
    
    
    function get_applicant_detail($app_id){
        $this->tables = array('applicant` AS `ap');
        $this->fields = array('ap.id','ap.century','ap.personal_number', 'ap.first_name', 'ap.last_name', 'ap.gender', 'ap.address', 'ap.post_no', 'ap.city', 'ap.telephone', 'ap.mobile','ap.email','ap.photo','ap.qualification','ap.experience','ap.former_company','ap.contact_no','ap.language_known','ap.resume_title','ap.attach_resume','ap.type_resume','ap.ref_social_security_no','ap.ref_name','ap.ref_mobile','ap.comment','ap.created_date');
        $this->conditions = array('AND','ap.id =  ?');
        $this->condition_values = array($app_id);
        $this->query_generate();
        $data = $this->query_fetch();
        
        $status = $this->get_interview_call_detail($app_id);
        if($status){
            $data[0]['status'] = $status['status'];
            $data[0]['date_of_interview'] = $status['date_of_interview'];
        }else{
            $data[0]['status'] = 0;
            $data[0]['date_of_interview'] = '';
        }
        
        if($data){
            return $data[0];
        }else{
            return array();
        }
        
        
    }
    
    
    function get_next_new_id(){
        $this->tables = array('applicant` AS `ap');
        $this->fields = array('MAX(ap.id) as max_id');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['max_id']+1;
        }
    }
    
    
    function add_comment_recruitment(){
        $this->tables = array('applicant_comment');
        $this->fields = array('application_id','application_status','date','comment');
        $this->field_values = array($this->application_id,$this->status,$this->date,$this->comment);
        if($this->query_insert()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function edit_comment_recruitment($comment_id){
        $this->tables = array('applicant_comment');
        $this->fields = array('application_id','application_status','date','comment');
        $this->field_values = array($this->application_id,$this->status,$this->date,$this->comment);
        $this->conditions = array('id = ?');
        $this->condition_values = array($comment_id);
        if($this->query_update()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    
    function get_previous_schedules($app_id){
        $this->tables = array('backup_interview_date');
        $this->fields = array('old_interview_date','date_made_change');
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($app_id);
        $this->query_generate();
        
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    
    function get_all_skills_applicant($app_id){
        $result = array();
        $this->tables = array('skill');
        $this->fields = array('id','application_id', 'title', 'description');
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($app_id);
        $this->query_generate();
        return $data = $this->query_fetch();
        /*if($data){
            for ($i = 0; $i < count($data); $i++) {
                $result[$i]['id'] = $data[$i]['id'];
                $result[$i]['application_id'] = $data[$i]['application_id'];
                $result[$i]['title'] = $data[$i]['title'];
                $description = explode("\n", $data[$i]['description']);
                for ($j = 0; $j < count($description); $j++) {
                    $result[$i]['description'][$j]['desc'] = $description[$j];
                }
            }
            return $result;
        
        }else{
            return array();
        }*/
    }
    
    function get_all_comments_applicant($app_id){
        $this->tables = array('applicant_comment');
        $this->fields = array('id','application_id','application_status','date','comment');
        $this->conditions = array('application_id = ?');
        $this->condition_values = array($app_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    
    function get_comment_recruitment_detail($comment_id){
        $this->tables = array('applicant_comment');
        $this->fields = array('id','application_id','application_status','date','comment');
        $this->conditions = array('id = ?');
        $this->condition_values = array($comment_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0];
        }else{
            return array();
        }
    }
    
    function delete_comment_recruitment($comment_id){
        $this->tables = array('applicant_comment');
        $this->conditions = array('id = ?');
        $this->condition_values = array($comment_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }

    function social_security_check($social_security) {

        $temp = '212121212';
        if ($social_security[6] == '-') {
            $social_security = preg_replace('/-/', '', $social_security, 1);
        }

        if (strlen($social_security) == '10') {
            $mult_array = '';
            for ($i = 0; $i < strlen($social_security) - 1; $i++) {

                $mult = $social_security[$i] * $temp[$i];
                $mult_array.= $mult;
            }
            $sum = array_sum(str_split($mult_array));
            $last_dig = substr($sum, -1);
            if ($last_dig != '0')
                $sub = 10 - $last_dig;
            else
                $sub = 0;
            if ($sub != substr($social_security, -1)) {

                return FALSE;
            } else {
                return 1;
            }
        } else {

            return FALSE;
        }
    }

    function applicant_social_security_check($social_security){
        global $db;
        if ($social_security[6] == '-') {
            $social_security = preg_replace('/-/', '', $social_security, 1);
        }

        $this->sql_query = "SELECT username as 'id', 'LOGIN' as 'source' FROM ".$db['database_master'] . ".login". " WHERE social_security = '". $social_security. "' ". 
            " UNION SELECT id as 'id', 'CANDIDATE' as 'source' FROM ".$_SESSION['db_name'].".applicant where personal_number = '".$social_security."' ";
        $data = $this->query_fetch();
        // var_dump($data); exit('df');
        // echo "<pre>".print_r($data, 1)."</pre>";//exit();
        if(!empty($data)){
            return $data[0]['id'];
        }else{
            return FALSE;
        }


    }
    function interviwed_applicant_social_security_check($social_security){
        global $db;
        $this->sql_query = "SELECT username FROM ".$db['database_master'] . ".login". " WHERE social_security = '". $social_security. "' " ;
        $data = $this->query_fetch();
        if(empty($data)){
            return 0;
        }
        else{
            return 1;
        }
                    
    }
    // function  social_security_check_applicant($dbname){
    //     $this->tables = array($dbname . '.applicant');
    //     $this->fields = array('first_name');
    //     $this->conditions = array('personal_number = ?');
    //     $this->condition_values = array($this->personal_number);
    //     $this->query_generate();
    //     $data = $this->query_fetch();
    //     if(empty($data)){
    //         return 0;
    //     }
    //     else{
    //         return 1;
    //     }
    // }


    // sample pdf
     function sample_pdf(){
        $emp='rolu001';
        require_once ('plugins/test_pdf_sreerag.php');
        $employee = new employee();
        $emp_details = $employee->employee_detail('\'' . $emp . '\'');
        // var_dump($emp_details);
        $pdf = new PDF_Emp_test();
        $pdf->SetMargins(5,5);
        $pdf->AddPage();
        $pdf->setTitle('test pdf');
        $pdf->Pl_header($emp_details[0]);
        $pdf->P1_mid_left();
        $pdf->Pl_right();
        $pdf->P1_photo();
        $pdf->P1_sign();


        $pdf->Output();
     }

}

?>