<?php

/**
 * Description of survey
 * @author Shamsudheen  shamsu<shamsu@arioninfotech.com>
 */

require_once('configs/config.inc.php');
require_once ('class/db.php');

class survey extends db {

    var $suvey_table_prefix = 'srv_';
    var $current_survey = 0;
    var $current_form = 0;
    var $current_question = 0;
    
    function __construct() {
        parent::__construct();
    }

    /* ------------------------------------manage questions begins----------------------------------------------------- */
    function insert_question($question = NULL, $type = 4, $answer_hint = NULL, $status = 1, $parent_id = 0, $categories = NULL, $display_style = 0, $comment_flag = 0) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->fields = array('question', 'answer_hint', 'answer_type', 'parent_question_ID', 'status', 'categories', 'display_style', 'comment_flag');
        $this->field_values = array($question, $answer_hint, $type, $parent_id, $status, $categories, $display_style, $comment_flag);
        if ($this->query_insert()) 
            return true;
        else
            return false;
    }

    function update_question($question_id, $question = NULL, $type = 4, $answer_hint = NULL, $status = 1, $parent_id = 0, $categories = NULL, $display_style = 0, $comment_flag = 0) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->fields = array('question', 'answer_hint', 'answer_type', 'parent_question_ID', 'status', 'categories', 'display_style', 'comment_flag');
        $this->field_values = array($question, $answer_hint, $type, $parent_id, $status, $categories, $display_style, $comment_flag);
        $this->conditions = array('id = ?');
        $this->condition_values = array($question_id);
        if ($this->query_update()) 
            return true;
        else
            return false;
    }
    
    function insert_answer($question_id = NULL, $answer_text = NULL, $point = 0, $correct_flag = 0, $default_flag = 0) {
        $this->tables = array($this->suvey_table_prefix.'question_answer');
        $this->fields = array('question_id', 'answer_text', 'point', 'correct_flag', 'default_flag');
        $this->field_values = array($question_id, $answer_text, $point, $correct_flag, $default_flag);
        if ($this->query_insert()) 
            return true;
        else
            return false;
    }
    
    function update_answer($question_id, $answer_text = NULL, $point = 0, $correct_flag = 0, $default_flag = 0) {
        $this->tables = array($this->suvey_table_prefix.'question_answer');
        $this->fields = array('answer_text', 'point', 'correct_flag', 'default_flag');
        $this->field_values = array($answer_text, $point, $correct_flag, $default_flag);
        $this->conditions = array('question_id = ?');
        $this->condition_values = array($question_id);
        if ($this->query_update())
            return true;
        else
            return false;
    }
    
    function update_answer_by_ID($id, $question_id, $answer_text = NULL, $point = 0, $correct_flag = 0, $default_flag = 0) {
        $this->tables = array($this->suvey_table_prefix.'question_answer');
        $this->fields = array('question_id', 'answer_text', 'point', 'correct_flag', 'default_flag');
        $this->field_values = array($question_id, $answer_text, $point, $correct_flag, $default_flag);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update())
            return true;
        else
            return false;
    }
    
    function get_questions($question_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->fields = array('id', 'question', 'answer_hint', 'answer_type', 'parent_question_ID', 'categories', 'status', 'display_style', 'comment_flag');
        if($question_id != NULL){
            $this->conditions = array('AND', 'id = ?', 'parent_question_ID = 0');
            $this->condition_values = array($question_id);
        }else{
            $this->conditions = array('AND', 'parent_question_ID = 0');
        }
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_questions_by_formID($form_id) {
        $this->tables = array($this->suvey_table_prefix.'form_questions` as `fq', $this->suvey_table_prefix.'questions` as `q');
        $this->fields = array('q.id', 'q.question', 'q.answer_hint', 'q.answer_type', 'q.parent_question_ID', 'q.categories', 'q.status', 'q.display_style', 'q.comment_flag');
        $this->conditions = array('AND', 'fq.form_id = ?', 'fq.question_id = q.id');
        $this->condition_values = array($form_id);
        $this->order_by = array('q.id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_child_question($question_id) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->fields = array('id', 'question', 'answer_hint', 'answer_type', 'categories', 'status', 'display_style', 'comment_flag');
        $this->conditions = array('AND', 'parent_question_ID = ?');
        $this->condition_values = array($question_id);
        $this->order_by = array('id');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_detailed_question($question_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'questions` as `q', $this->suvey_table_prefix.'question_answer` as `qa');
        $this->fields = array('q.question', 'q.answer_hint', 'q.answer_type', 'q.parent_question_ID', 'q.categories', 'q.display_style', 'q.comment_flag');
        if($question_id != NULL){
            $this->conditions = array('AND', 'q.id = ?', 'q.parent_question_ID = 0');
            $this->condition_values = array($question_id);
        }else{
            $this->conditions = array('AND', 'q.parent_question_ID = 0');
        }
        $this->order_by = array('q.id');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_question_answers($question_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'question_answer');
        $this->fields = array('id', 'answer_text', 'point', 'correct_flag', 'default_flag');
        if($question_id != NULL){
            $this->conditions = array('AND', 'question_id = ?');
            $this->condition_values = array($question_id);
        }
        $this->order_by = array('id');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function delete_question($question_id) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->conditions = array('id = ?');
        $this->condition_values = array($question_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }

    function delete_subquestions($question_id) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->conditions = array('parent_question_ID = ?');
        $this->condition_values = array($question_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }

    function delete_answer_by_ID($id) {
        $this->tables = array($this->suvey_table_prefix.'question_answer');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }

    function delete_answer_by_questionID($id) {
        $this->tables = array($this->suvey_table_prefix.'question_answer');
        $this->conditions = array('question_id = ?');
        $this->condition_values = array($id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
	
    /* ------------------------------------manage questions endz----------------------------------------------------- */
    
    /* ------------------------------------manage groups begins----------------------------------------------------- */
    function get_survey_employees($employee_id = NULL) { //for just listing all employees to create new group
        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'social_security', 'first_name' ,'last_name', 'address', 'city', 'email', 'status');
        if($employee_id != NULL){
            $this->conditions = array('username = ?');
            $this->condition_values = array($employee_id);
        }
        $this->order_by = array('last_name', 'first_name');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }  
    
    function get_survey_groups($group_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'groups');
        $this->fields = array('id', 'group_name', 'group_description', 'group_leader', 'created_date');
        if($group_id != NULL){
            $this->conditions = array('id = ?');
            $this->condition_values = array($group_id);
        }
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_survey_members($group_id,$gender='',$age_from='',$age_to='') {
        $this->tables = array($this->suvey_table_prefix.'group_members` as `gm', 'employee` as `e');
        if($gender != '' && $age_from != ''){
            $this->fields = array('gm.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 'gm.group_id = ?', 'e.username = gm.username','e.gender = ?','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) >= ?','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) <= ?');
            $this->condition_values = array($group_id,$gender,$age_from,$age_to);
        }elseif($gender == '' && $age_from != ''){
            $this->fields = array('gm.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 'gm.group_id = ?', 'e.username = gm.username','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) >= ?','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) <= ?');
            $this->condition_values = array($group_id,$age_from,$age_to);
        }elseif($gender != '' && $age_from == ''){
            $this->fields = array('gm.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 'gm.group_id = ?', 'e.username = gm.username','e.gender = ?');
            $this->condition_values = array($group_id,$gender);
        }else{
            $this->fields = array('gm.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 'gm.group_id = ?', 'e.username = gm.username');
            $this->condition_values = array($group_id);
        }
        $this->query_generate();
//        echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_survey_members_answered_question($survey_id,$question_id,$gender='',$age_from='',$age_to='') {
        $this->tables = array($this->suvey_table_prefix.'user_Results_data` AS `urd',$this->suvey_table_prefix.'user_Results` AS `ur','employee` as `e');
        $this->fields = array('ur.username', 'e.first_name', 'e.last_name');
        $this->conditions = array('AND','urd.question_id = ?','ur.survey_id = ?','e.username = ur.username','ur.id = urd.result_id');
        $this->condition_values = array($question_id,$survey_id);
//        $this->query_generate();
//        $result = $this->query_fetch();
//        if($result){
//            $condition = array('OR');
//            for($i=0;$i<count($result);$i++){
//                $condition[] = 'ur.id <> '.$result[$i]['result_id'];
//            }
        if($gender != '' && $age_from != ''){
            $this->conditions[] = array('AND','e.gender = ?','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) >= ?','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) <= ?');
            $this->condition_values[] = array($gender,$age_from,$age_to);
        }elseif($gender == '' && $age_from != ''){
            $this->conditions[] = array('AND','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) >= ?','TIMESTAMPDIFF(YEAR,CONCAT(MID(CONCAT(e.century,e.social_security),1,4),"-",MID(CONCAT(e.century,e.social_security),5,2),"-",MID(CONCAT(e.century,e.social_security),7,2)),CURDATE()) <= ?');
            $this->condition_values[] = array($age_from,$age_to);
        }elseif($gender != '' && $age_from == ''){
            $this->conditions = 'e.gender = ?';
            $this->condition_values[] = $gender;
        }
//        echo "<pre> dsdddddd". print_r($this->condition_values, 1)."</pre>";
            $this->query_generate();
//            echo $this->sql_query;
            $datas = $this->query_fetch();
            return $datas;  
        
        
    }
    
    function get_max_question_order_by_formID($form_id) {
        $this->tables = array($this->suvey_table_prefix.'form_questions');
        $this->fields = array('COALESCE(max(question_order), 0) as max_order');
        $this->conditions = array('form_id = ?');
        $this->condition_values = array($form_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }
    
    function get_max_forder_order_by_surveyID($survey_id) {
        $this->tables = array($this->suvey_table_prefix.'survey_forms');
        $this->fields = array('COALESCE(max(forms_order), 0) as max_order');
        $this->conditions = array('survey_id = ?');
        $this->condition_values = array($survey_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }
    
    function create_group($group_name, $group_description = NULL, $group_leader = NULL) {
        $this->tables = array($this->suvey_table_prefix.'groups');
        $this->fields = array('group_name', 'group_description', 'group_leader');
        $this->field_values = array($group_name, $group_description, $group_leader);
        if ($this->query_insert()) 
            return true;
        else
            return false;
    }
    
    function update_group($group_id, $group_name, $group_description = NULL, $group_leader = NULL) {
        $this->tables = array($this->suvey_table_prefix.'groups');
        $this->fields = array('group_name', 'group_description', 'group_leader');
        $this->field_values = array($group_name, $group_description, $group_leader);
        $this->conditions = array('id = ?');
        $this->condition_values = array($group_id);
        if ($this->query_update()) 
            return true;
        else
            return false;
    }
    
    function insert_group_members($group_id, $user) {
        $this->tables = array($this->suvey_table_prefix.'group_members');
        $this->fields = array('group_id', 'username');
        $this->field_values = array($group_id, $user);
        if ($this->query_insert()) 
            return true;
        else
            return false;
    }
    
    function delete_group($group_id) {
        $this->tables = array($this->suvey_table_prefix.'groups');
        $this->conditions = array('id = ?');
        $this->condition_values = array($group_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
    
    function delete_group_members_by_group_id($group_id) {
        $this->tables = array($this->suvey_table_prefix.'group_members');
        $this->conditions = array('group_id = ?');
        $this->condition_values = array($group_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
    /* ------------------------------------manage groups endz----------------------------------------------------- */
    
    /* ------------------------------------manage Invitation begins----------------------------------------------------- */
    function get_invitations($invite_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'invitation');
        $this->fields = array('id', 'invite_date', 'invite_subject', 'invite_message');
        if($invite_id != NULL){
            $this->conditions = array('id = ?');
            $this->condition_values = array($invite_id);
        }
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_invitations_group_members($invite_id) {
        $datas = array();
        $this->tables = array($this->suvey_table_prefix.'invitation_members` as `im', $this->suvey_table_prefix.'group_members` as `gm');
            $this->fields = array('gm.username');
            $this->conditions = array('AND', 'im.invitation_id = ?', 'im.grp_indv_id = gm.group_id', 'im.grp_indv_flag = 0');
            $this->condition_values = array($invite_id);
            $this->query_generate();
            $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_invitations_members($invite_id, $user_type) {
        $datas = array();
        if($user_type == 0){    //for getting groups
            $this->tables = array($this->suvey_table_prefix.'invitation_members` as `im', $this->suvey_table_prefix.'groups` as `g');
            $this->fields = array('g.id', 'g.group_name', 'g.group_description', 'g.group_leader');
            $this->conditions = array('AND', 'im.invitation_id = ?', 'im.grp_indv_id = g.id', 'im.grp_indv_flag = 0');
            $this->condition_values = array($invite_id);
            $this->query_generate();
            $datas = $this->query_fetch();
        }else if($user_type == 1){    //for getting individuals
            $this->tables = array($this->suvey_table_prefix.'invitation_members` as `im', 'employee` as `e');
            $this->fields = array('e.username', 'e.first_name', 'e.last_name');
            $this->conditions = array('AND', 'im.invitation_id = ?', 'im.grp_indv_id = e.username', 'im.grp_indv_flag = 1');
            $this->condition_values = array($invite_id);
            $this->query_generate();
            $datas = $this->query_fetch();
        }else if($user_type == 2){    //for getting customers
            $this->tables = array($this->suvey_table_prefix.'invitation_members` as `im', 'customer` as `c');
            $this->fields = array('c.username', 'c.first_name', 'c.last_name');
            $this->conditions = array('AND', 'im.invitation_id = ?', 'im.grp_indv_id = c.username', 'im.grp_indv_flag = 2');
            $this->condition_values = array($invite_id);
            $this->query_generate();
            $datas = $this->query_fetch();
        }
        return $datas;
    }
    
    function get_invitations_surveys($invite_id) {
        $this->tables = array($this->suvey_table_prefix.'invitation_surveys` as `is', $this->suvey_table_prefix.'surveys` as `s');
        $this->fields = array('DISTINCT s.id', 's.survey_title');
        $this->conditions = array('AND', 'is.invitation_id = ?', 'is.survey_id = s.id');
        $this->condition_values = array($invite_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function create_invitation($subject, $message = NULL) {
        $this->tables = array($this->suvey_table_prefix.'invitation');
        $this->fields = array('invite_subject', 'invite_message');
        $this->field_values = array($subject, $message);
        if ($this->query_insert())
            return true;
        else
            return false;
    }
    
    function create_invitation_members($invitation_id, $user_type_flag, $user_group_id) {
        $this->tables = array($this->suvey_table_prefix.'invitation_members');
        $this->fields = array('invitation_id', 'grp_indv_flag', 'grp_indv_id');
        $this->field_values = array($invitation_id, $user_type_flag, $user_group_id);
        if ($this->query_insert())
            return true;
        else
            return false;
    }
    
    function create_invitation_surveys($invitation_id, $survey_id) {
        $this->tables = array($this->suvey_table_prefix.'invitation_surveys');
        $this->fields = array('invitation_id', 'survey_id');
        $this->field_values = array($invitation_id, $survey_id);
        if ($this->query_insert())
            return true;
        else
            return false;
    }
    
    function update_invitation($invitation_id, $subject, $message = NULL) {
        $this->tables = array($this->suvey_table_prefix.'invitation');
        $this->fields = array('invite_subject', 'invite_message');
        $this->field_values = array($subject, $message);
        $this->conditions = array('id = ?');
        $this->condition_values = array($invitation_id);
        if ($this->query_update()) 
            return true;
        else
            return false;
    }
    
    function delete_invitation_members($invitation_id) {
        $this->tables = array($this->suvey_table_prefix.'invitation_members');
        $this->conditions = array('invitation_id = ?');
        $this->condition_values = array($invitation_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
    
    function delete_invitation_surveys($invitation_id) {
        $this->tables = array($this->suvey_table_prefix.'invitation_surveys');
        $this->conditions = array('invitation_id = ?');
        $this->condition_values = array($invitation_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
    
    function delete_invitation($invitation_id) {
        $this->tables = array($this->suvey_table_prefix.'invitation');
        $this->conditions = array('id = ?');
        $this->condition_values = array($invitation_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
    
    /* ------------------------------------manage Invitation endz----------------------------------------------------- */
    /*------------- Niyaz survey begin ----------------------------*/
    
    function get_questions_for_form($form_id = NULL){
        $this->tables = array($this->suvey_table_prefix.'form_questions` as `fq',$this->suvey_table_prefix.'questions` as `q');
        $this->fields = array('fq.form_id as form_id','fq.question_id as question_id','q.question as question','q.answer_type as answer_type');
        $this->conditions = array('AND', 'fq.question_id = q.id', 'fq.form_id = ?');
        $this->condition_values = array($form_id);
        $this->query_generate();
        $data = $this->query_fetch();
        
        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->fields = array('break_numbers');
        $this->conditions = array('id = ?');
        $this->condition_values = array($form_id);
        $this->query_generate();
        $data1 = $this->query_fetch();
        $break_numbers = explode(',', $data1[0]['break_numbers']);
         
        $result = array();
        $k=0;
        $j=0;
        for($i=0;$i<count($data);$i++){
           if($k == $break_numbers[$j] && $break_numbers[$j] != count($data)){
               $result[] = array('question_id' => 'null');
               $k=0;
               $j++;
           } 
               $result[] = $data[$i];
               $k++;
           
        }
        if($result){
            return $result;
        }else{
            return array();
        }
    }
    
     // function to add new categery
    
    function add_new_categery($categery, $category_type = NULL){
        $this->tables = array($this->suvey_table_prefix.'categories');
        $this->fields = array('category_name', 'category_type');
        $this->field_values = array($categery, $category_type);
        if($this->query_insert()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    // function to retrieve categories
    function get_categeries(){
        $this->tables = array($this->suvey_table_prefix.'categories');
        $this->fields = array('id','category_name');
        $this->order_by = array('LOWER(category_name)', 'category_name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    // function to retrieve categories by name
    function get_category_by_name($cat_name){
        $this->tables = array($this->suvey_table_prefix.'categories');
        $this->fields = array('id','category_name');
        $this->conditions = array('lower(category_name) = lower(?)');
        $this->condition_values = array($cat_name);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    //fuction to get the surveys present for the user
    
    function get_surveys_user(){
//        if($_SESSION['user_role'] == 1){
//            $surveys_user = $this->get_surveys();
//        }else{
            $ids_survey = array();
            $surveys_user = array();
            $condition_array = array('OR');
            $this->tables = array('srv_group_members');
            $this->fields = array('group_id');
            $this->conditions = array('username = ?');
            $this->condition_values = array($_SESSION['user_id']);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $condition_array[] = 'grp_indv_id = '.$data[$i]['group_id'];
                }
            }
            
            $this->tables = array('srv_invitation_members');
            $this->fields = array('distinct invitation_id');
            if(count($condition_array) == 1){
                $this->conditions = array('grp_indv_id = ?');
                $this->condition_values = array($_SESSION['user_id']);
            }else{
                $condition_array[] = 'grp_indv_id = ?';
                $this->conditions = $condition_array;
                $this->condition_values = array($_SESSION['user_id']);
            }
            $this->query_generate();
            
            $data1 = $this->query_fetch();
            if($data1){
                for($i=0;$i<count($data1);$i++){
                    $this->tables = array('srv_invitation_surveys');
                    $this->fields = array('distinct survey_id');
                    $this->conditions = array('invitation_id = ?');
                    $this->condition_values = array($data1[$i]['invitation_id']);
                    $this->query_generate();
                    $data2 = $this->query_fetch();
                    //echo "<pre>---".$data1[$i]['invitation_id']."----".print_r($data2,1)."</pre>";
                    for($j=0;$j<count($data2);$j++){
                        $this->tables = array($this->suvey_table_prefix.'user_Results');
                        $this->fields = array('count(id) as result_count');
                        $this->conditions = array('AND', 'survey_id = ?', 'username LIKE ?');
                        $this->condition_values = array($data2[$j]['survey_id'], $_SESSION['user_id']);
                        $this->query_generate();
                        $result_datas = $this->query_fetch();
                        //echo $data2[$j]['survey_id']."-----".$result_datas[0]['result_count']."<br>";
                        
                        if($result_datas[0]['result_count'] == 0){
                            if(in_array($data2[$j]['survey_id'], $ids_survey)){
                                continue;
                            }else{
                                $surveys_user_temp = $this->get_surveys($data2[$j]['survey_id']);
                                $surveys_user[] = $surveys_user_temp[0];
                                $ids_survey[] = $data2[$j]['survey_id'];
                            }
                        }
                    }
                }
            }
            
//        }
        for($i=0;$i<count($surveys_user);$i++){
            
                $this->tables = array($this->suvey_table_prefix.'survey_forms');
                $this->fields = array('COUNT(form_id) as counts');
                $this->conditions = array('survey_id =?');
                $this->condition_values = array($surveys_user[$i]['id']);
                $this->query_generate();
                $datas = $this->query_fetch();
                $surveys_user[$i]['form_count'] = $datas[0]['counts'];
            
        }
        //echo "<pre>".print_r($surveys_user,1)."</pre>";
        return $surveys_user;
    }
    
    // function to get the questions for the survey
    
    function get_user_questions($survey_id,$page,$count = null){
        $result = array();
        $this->tables = array($this->suvey_table_prefix.'survey_forms` as `sf',$this->suvey_table_prefix.'forms` as `f');
        $this->fields = array('sf.form_id','f.title','f.break_numbers');
        $this->conditions = array('AND','sf.survey_id = ?','sf.form_id = f.id');
        $this->condition_values = array($survey_id);
        $this->order_by = array('sf.forms_order ASC');
        $this->query_generate();
        $data = $this->query_fetch();
        for($i=0;$i<count($data);$i++){
            $this->tables = array($this->suvey_table_prefix.'form_questions` as `fq',$this->suvey_table_prefix.'questions` as `q');
            $this->fields = array('q.question','q.id as q_id','q.answer_type','q.comment_flag','q.display_style','q.answer_hint');
            $this->conditions = array('AND','fq.form_id = ?','q.id = fq.question_id');
            $this->condition_values = array($data[$i]['form_id']);
            $this->query_generate();
            $data1 = $this->query_fetch();
            if($data1){
                for($j=0;$j<count($data1);$j++){
                    
                        $this->tables = array($this->suvey_table_prefix.'question_answer');
                        $this->fields = array('answer_text','point','correct_flag','id as answer_id');
                        $this->conditions = array('question_id = ?');
                        $this->condition_values = array($data1[$j]['q_id']);
                        $this->query_generate();
                        $data2 = $this->query_fetch();
                        if($data2)
                            $data1[$j]['answers'] = $data2;
                        else {
                            $data1[$j]['answers'] = array();
                        }
                    if($data1[$j]['answer_type'] == 10){
                        $this->tables = array($this->suvey_table_prefix.'questions');
                        $this->fields = array('question','id as q_id_forchild','parent_question_ID');
                        $this->conditions = array('parent_question_ID = ?');
                        $this->condition_values = array($data1[$j]['q_id']);
                        $this->query_generate();
                        $child_quests = $this->query_fetch();
                        if($child_quests)
                            $data1[$j]['child_quest'] = $child_quests;
                        else {
                            $data1[$j]['child_quest'] = array();
                        }
                    }
                }
                if($data[$i]['break_numbers'] == null || $data[$i]['break_numbers'] == ""){
                    $result[] = array('form'=>$data[$i]['title'],'form_id'=>$data[$i]['form_id'],'questions'=>$data1);
                }
                else{
                    $questions_array = array();
                    $x = 0;
                    $breaknumbers = explode(",",$data[$i]['break_numbers']);
                    for($j=0;$j<count($breaknumbers);$j++){
                        $h = 1;
                        $m = $breaknumbers[$j];
                        for($k=$x;$k<count($data1);$k++){
                            if($h>$m){
                                break;
                            }else{
                                $h++;
                                $questions_array[] = $data1[$k];
                            }
                        }
                        $result[] = array('form'=>$data[$i]['title'],'form_id'=>$data[$i]['form_id'],'questions'=>$questions_array);
                        $questions_array = array();
                        $x=$k;
                    }
                }
            }
        }
//        echo "<pre>". print_r($result, 1)."</pre>";
//        echo count($result);
        if($result){
            if($count == null){
                if(count($result) < $page){
                    return 'page_end';
                }else{
                    return $result[$page-1];
                }
            }else{
                return count($result);
            }
        }else{
            return array();
        }
        
        
    }
    
    function check_is_survey_started($survey_id,$user_id){
        $this->tables = array($this->suvey_table_prefix.'user_Results');
        $this->fields = array('MAX(survey_page) AS survey_max','form_id');
        $this->conditions = array('AND','survey_id  = ?','username = ?');
        $this->condition_values = array($survey_id,$user_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data[0]['survey_max'] != NULL && $data[0]['form_id'] != NULL){
            return $data[0];
        }else{
            return FALSE;
        }
    }
    
    function add_user_results($s_id,$page,$f_id){
        $this->tables = array($this->suvey_table_prefix.'user_Results');
        $this->fields = array('survey_id','form_id','username','user_IP','survey_page');
        $this->field_values = array($s_id,$f_id,$_SESSION['user_id'],'',$page);
        if($this->query_insert()){
            return $this->get_id();
        }else{
            return FALSE;
        } 
    }
    
    function add_user_results_data($result_id,$quest,$ans,$comments){
        $k=0;
        for($i=0;$i<count($quest);$i++){
            $this->tables = array($this->suvey_table_prefix.'user_Results_data');
            $this->fields = array('result_id','question_id','answer_id_txt','user_comment');
            $this->field_values = array($result_id,$quest[$i],$ans[$i],$comments[$i]);
            if($this->query_insert()){
                $k++;
            } 
        }
        if($k == count($quest)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function get_questions_forms($question_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->fields = array('id', 'question', 'answer_hint', 'answer_type', 'parent_question_ID', 'categories', 'status', 'display_style', 'comment_flag');
        if($question_id != NULL){
            $this->conditions = array('AND', 'id = ?', 'parent_question_ID = 0','status = 0');
            $this->condition_values = array($question_id);
        }else{
            $this->conditions = array('AND', 'parent_question_ID = 0','status = 0');
        }
        $this->order_by = array('id desc');
        $this->query_generate();
//        echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }
    
    // Function get the parent id for the new version of survey
    function get_parent_id_survey($survey_id){
        $this->tables = array($this->suvey_table_prefix.'surveys');
        $this->fields = array('parent_survey_ID');
        $this->conditions = array('id = ?');
        $this->condition_values = array($survey_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data[0]['parent_survey_ID'] == 0){
            return $survey_id;
        }else{
            return $data[0]['parent_survey_ID'];
        }
    }


    /*------------- Niyaz survey end ----------------------------*/
	
    /*------------- Nithin survey begin ----------------------------*/

	/*********Survey Form Section*********/
    //Function for getting form data - Handled by Nithin Vaniyankandy
    function get_forms($form_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->fields = array('id', 'title', 'description', 'date_creation', 'categories', 'break_numbers', 'question_limit', 'status');
        if($form_id != NULL){
            $this->conditions = array('id = ?');
            $this->condition_values = array($form_id);
        }
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function get_forms_for_survey_page() {
        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->fields = array('id', 'title', 'description', 'date_creation', 'categories', 'break_numbers', 'question_limit');
        $this->conditions = array('status = 0');
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    function get_forms_by_surveyID($survey_id) {
        $this->tables = array($this->suvey_table_prefix.'forms` as `f', $this->suvey_table_prefix.'survey_forms` as `sf');
        $this->fields = array('f.id', 'f.title', 'f.description', 'f.date_creation', 'f.categories', 'f.break_numbers', 'f.question_limit', 'f.status');
        $this->conditions = array('AND', 'sf.survey_id = ?', 'sf.form_id = f.id');
        $this->condition_values = array($survey_id);
        $this->order_by = array('f.id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
	//Form insertion function - Handled by Nithin Vaniyankandy
    function insert_form($title = NULL, $description = NULL, $categories = NULL, $break_numbers  = NULL,$status = 1, $question_limit = 0) {
        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->fields = array('title', 'description', 'categories', 'break_numbers ', 'question_limit','status');
        $this->field_values = array($title, $description, $categories, $break_numbers , $question_limit,$status);
        if ($this->query_insert()) 
            return $this->get_id();
        else
            return false;
    }
	//Form updation function - Handled by Nithin Vaniyankandy
    function update_form($form_id = NULL, $title = NULL, $description = NULL, $categories = NULL, $break_numbers  = NULL, $status = 1,$question_limit = 0) {
        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->fields = array('title', 'description', 'categories', 'break_numbers ', 'question_limit','status');
        $this->field_values = array($title, $description, $categories, $break_numbers , $question_limit,$status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($form_id);
        if ($this->query_update()) 
            return true;
        else
            return false;
    }
	//Form deletion function - Handled by Nithin Vaniyankandy
    function delete_form($form_id) {
        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->conditions = array('id = ?');
        $this->condition_values = array($form_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
	//Form question insertion function - Handled by Nithin Vaniyankandy
    function insert_form_questions($form_id = NULL, $question_id = NULL, $question_order = NULL) {
        $this->tables = array($this->suvey_table_prefix.'form_questions');
        $this->fields = array('form_id');
		$this->conditions = array('AND', 'form_id = ?', 'question_id = ?');
		$this->condition_values = array($form_id, $question_id);
		$this->query_generate();
        $datas = $this->query_fetch();

		if($datas[0]['form_id'] == '') {
			$this->tables = array($this->suvey_table_prefix.'form_questions');
			$this->fields = array('form_id', 'question_id', 'question_order');
			$this->field_values = array($form_id, $question_id, $question_order);
			if ($this->query_insert()) 
				return true;
			else
				return false;
		}
		else
			return false;
    }
	//Form question delete function - Handled by Nithin Vaniyankandy
	function delete_form_questions($form_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'form_questions');
        $this->conditions = array('form_id = ?');
        $this->condition_values = array($form_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
	}
	//Function to avoid already selected quiestions on the form - Handled by Nithin Vaniyankandy
	function avoid_questions_selected($form_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'form_questions');
        $this->fields = array('question_id');
        $this->conditions = array('form_id = ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array($this->suvey_table_prefix.'questions');
        $this->fields = array('id', 'question', 'answer_hint', 'answer_type', 'parent_question_ID', 'categories', 'status', 'display_style', 'comment_flag');
        $this->conditions = array('AND', array('NOT IN', 'id', $query_inner), 'parent_question_ID = 0','status = 0');
        $this->condition_values = array($form_id);
        $this->order_by = array('id');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

	/*********Survey Section*********/
	//Function for getting form data - Handled by Nithin Vaniyankandy
    function get_surveys($survey_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'surveys');
        $this->fields = array('id', 'survey_title', 'description', 'created_by','created_date', 'expire_date', 'status');
        if($survey_id != NULL){
            $this->conditions = array('id = ?');
            $this->condition_values = array($survey_id);
        }else{
           $this->conditions = array('status = "0"');
        }
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        if($survey_id != NULL){
            $datas[0]['expire_date'] = date("Y-m-d",  strtotime($datas[0]['expire_date']));
        }
        return $datas;
    }
    
    function get_surveys_all() {
        $this->tables = array($this->suvey_table_prefix.'surveys');
        $this->fields = array('id', 'survey_title', 'description', 'created_by','created_date', 'expire_date', 'status');
        $this->order_by = array('id desc');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    //Function for getting forms for survey - Handled by Nithin Vaniyankandy
    function get_forms_for_survey($survey_id = NULL){
        $this->tables = array($this->suvey_table_prefix.'survey_forms` as `sf',$this->suvey_table_prefix.'forms` as `f');
        $this->fields = array('sf.survey_id as survey_id','sf.form_id as form_id','f.title as title');
        $this->conditions = array('AND', 'sf.form_id = f.id', 'sf.survey_id = ?');
        $this->condition_values = array($survey_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
	//Survey insertion function - Handled by Nithin Vaniyankandy
    function insert_survey($survey_title = NULL, $description = NULL, $created_by = NULL, $expire_date  = NULL, $status = 1,$parent_id = 0) {
        $this->tables = array($this->suvey_table_prefix.'surveys');
        $this->fields = array('survey_title', 'description', 'created_by', 'expire_date ', 'status','parent_survey_ID');
        $this->field_values = array($survey_title, $description, $created_by, $expire_date , $status,$parent_id);
        if ($this->query_insert()) 
            return $this->get_id();
        else
            return false;
    }
	//Survey updation function - Handled by Nithin Vaniyankandy
    function update_survey($survey_id = NULL, $survey_title = NULL, $description = NULL, $created_by = NULL, $expire_date  = NULL, $status = 1) {
        $this->tables = array($this->suvey_table_prefix.'surveys');
        $this->fields = array('survey_title', 'description', 'created_by', 'expire_date ', 'status');
        $this->field_values = array($survey_title, $description, $created_by, $expire_date , $status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($survey_id);
        if ($this->query_update()) 
            return true;
        else
            return false;
    }
	//Survey deletion function - Handled by Nithin Vaniyankandy
    function delete_survey($survey_id) {
        $this->tables = array($this->suvey_table_prefix.'surveys');
        $this->conditions = array('id = ?');
        $this->condition_values = array($survey_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
    }
	//Survey form insertion function - Handled by Nithin Vaniyankandy
    function insert_survey_forms($survey_id = NULL, $form_id = NULL, $forms_order = NULL) {
        $this->tables = array($this->suvey_table_prefix.'survey_forms');
        $this->fields = array('survey_id');
        $this->conditions = array('AND', 'survey_id = ?', 'form_id = ?');
        $this->condition_values = array($survey_id, $form_id);
        $this->query_generate();
        $datas = $this->query_fetch();
		if($datas[0]['survey_id'] == '') {
			$this->tables = array($this->suvey_table_prefix.'survey_forms');
			$this->fields = array('survey_id', 'form_id', 'forms_order');
			$this->field_values = array($survey_id, $form_id, $forms_order);
			if ($this->query_insert()) 
				return true;
			else
				return false;
		}
		else
			return false;
    }
	//Survey form delete function - Handled by Nithin Vaniyankandy
	function delete_survey_forms($survey_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'survey_forms');
        $this->conditions = array('survey_id = ?');
        $this->condition_values = array($survey_id);
        if($this->query_delete()){
            return true;
        }else{
            return false;
        }
	}
	//Function to avoid already selected quiestions on the form - Handled by Nithin Vaniyankandy
	function avoid_forms_selected($survey_id = NULL) {
        $this->tables = array($this->suvey_table_prefix.'survey_forms');
        $this->fields = array('form_id');
        $this->conditions = array('survey_id = ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array($this->suvey_table_prefix.'forms');
        $this->fields = array('id', 'title', 'description', 'date_creation', 'categories', 'break_numbers', 'question_limit');
        $this->conditions = array('AND',array('NOT IN', 'id', $query_inner),'status = 0');
        $this->condition_values = array($survey_id);
        $this->order_by = array('id');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

	/*------------- Nithin survey end ----------------------------*/
    
        function get_surveys_list($method = null){
            $this->tables = array('srv_surveys');
            $this->fields = array('id','parent_survey_ID','survey_title','description','created_by','created_date','expire_date','status');
            if($method == null || $method == '3'){
                $this->conditions = array('status = "0"');
            }else{
                $date = date('Y-m-d');
//                echo $date;
                if($method == 1){
                   $this->conditions = array('AND','status = "0"',array('OR','DATE_FORMAT(expire_date, "%Y-%m-%d") < ?','expire_date IS NULL')); 
                   $this->condition_values = array($date);
                }
                if($method == 2){
                   $this->conditions = array('AND','status = "0"','DATE_FORMAT(expire_date, "%Y-%m-%d") > ?'); 
                   $this->condition_values = array($date);
                }
            }
            $this->query_generate();
            $data = $this->query_fetch();
            
            if($data){
                for($i=0;$i<count($data);$i++){
                    $this->tables = array('srv_survey_forms');
                    $this->fields = array('COUNT(survey_id) AS form_count');
                    $this->conditions = array('survey_id = ?');
                    $this->condition_values = array($data[$i]['id']);
                    $this->query_generate();
                    $data1 = $this->query_fetch();
                    $data[$i]['form_count'] = $data1[0]['form_count'];
                    
                    $this->tables = array('srv_user_Results');
                    $this->fields = array('COUNT(DISTINCT(username)) AS user_count');
                    $this->conditions = array('survey_id = ?');
                    $this->condition_values = array($data[$i]['id']);
                    $this->query_generate();
                    $data2 = $this->query_fetch();
                    $data[$i]['user_count'] = $data2[0]['user_count'];
                }
                return $data;
            }else{
                return array();
            }
        }
        
        
        function get_surveys_search_list($search_id,$from_date,$to_date,$status,$method){
            $this->tables = array('srv_surveys');
            $this->fields = array('id','parent_survey_ID','survey_title','description','created_by','created_date','expire_date','status');
            if($method == 1){
                $this->conditions = array('id = ?');
                $this->condition_values = array($search_id);
            }else if($method == 2){
                $date = date('Y-m-d');
                if($status == 1){
                   $this->conditions = array('AND','status = "0"',array('OR','DATE_FORMAT(expire_date, "%Y-%m-%d") < ?','expire_date IS NULL'),array('BETWEEN', 'DATE_FORMAT(created_date, "%Y-%m-%d")', '?', '?')); 
                   $this->condition_values = array($date,$from_date,$to_date);
                }
                if($status == 2){
                   $this->conditions = array('AND','status = "0"','DATE_FORMAT(expire_date, "%Y-%m-%d") > ?',array('BETWEEN', 'DATE_FORMAT(created_date, "%Y-%m-%d")', '?', '?')); 
                   $this->condition_values = array($date,$from_date,$to_date);
                }
                if($status == 3){
                    $this->conditions = array('AND','status = "0"',array('BETWEEN', 'DATE_FORMAT(created_date, "%Y-%m-%d")', '?', '?')); 
                   $this->condition_values = array($from_date,$to_date);
                }
//                $this->conditions = array('AND',array('BETWEEN', 'created_date', '?', '?'),'status = 0',);
//                $this->condition_values = array($from_date,$to_date);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $this->tables = array('srv_survey_forms');
                    $this->fields = array('COUNT(survey_id) AS form_count');
                    $this->conditions = array('survey_id = ?');
                    $this->condition_values = array($data[$i]['id']);
                    $this->query_generate();
                    $data1 = $this->query_fetch();
                    $data[$i]['form_count'] = $data1[0]['form_count'];
                    
                    $this->tables = array('srv_user_Results');
                    $this->fields = array('COUNT(DISTINCT(username)) AS user_count');
                    $this->conditions = array('survey_id = ?');
                    $this->condition_values = array($data[$i]['id']);
                    $this->query_generate();
                    $data2 = $this->query_fetch();
                    $data[$i]['user_count'] = $data2[0]['user_count'];
                }
                return $data;
            }else{
                return array();
            }
        }
        
        
        function get_groups_survey($survey_id){
            $this->tables = array('srv_invitation_surveys');
            $this->fields = array('invitation_id','survey_id');
            if(count($survey_id) == 1){
                $this->conditions = array('survey_id = ?');
                $this->condition_values = array($survey_id);
            }else{
                $this->conditions = array('OR');
                for($i=0;$i<count($survey_id);$i++){
                    $this->conditions[] = 'survey_id = ?';
                    $this->condition_values[] = $survey_id[$i];
                }
            }
            $this->query_generate();
            $data = $this->query_fetch();
            $result = array();
            $array_group_list = array();
            for($i=0;$i<count($data);$i++){
                $this->tables = array('srv_invitation_members` AS `im','srv_groups` AS `grp');
                $this->fields = array('im.invitation_id','im.grp_indv_id','grp.group_name','grp.id AS group_id');
                $this->conditions = array('AND','invitation_id = ?','grp_indv_flag = 0','im.grp_indv_id = grp.id');
                $this->condition_values = array($data[$i]['invitation_id']);
                $this->query_generate();
                $data1 = $this->query_fetch();
                for($j=0;$j<count($data1);$j++){
                    if(in_array($data1[$j]['group_id'], $array_group_list)){
                        continue;
                    }else{
                        $result[] = $data1[$j];
                        $array_group_list[] = $data1[$j]['group_id'];
                    }
                    
                }
            }
            if($result){
                return $result;
            }else{
                return array();
            }
        }
        
        function get_questions_survey($ids,$page = NULL){
            $result = array();
            $this->tables = array('srv_survey_forms');
            $this->fields = array('form_id');
            $this->conditions = array('survey_id = ?');
            $this->condition_values = array($ids);
            $this->query_generate();
            $data = $this->query_fetch();
            if($data){
                for($i=0;$i<count($data);$i++){
                    $this->tables = array('srv_form_questions');
                    $this->fields = array('question_id');
                    $this->conditions = array('form_id = ?');
                    $this->condition_values = array($data[$i]['form_id']);
                    $this->order_by = array('question_order ASC');
                    $this->query_generate();
                    $data1 = $this->query_fetch();
                    if($data1){
                        for($k=0;$k<count($data1);$k++){
                            $this->flush();
                            $this->tables = array('srv_questions');
                            $this->fields = array('id','question','parent_question_ID','answer_type');
                            if($page == NULL){
                                $this->conditions = array('id = ?');
                                $this->condition_values = array($data1[$k]['question_id']);
                            }else{
                                $this->conditions = array('AND','id = ?',array('OR','answer_type = 1','answer_type = 2','answer_type = 3','answer_type = 6'));
                                $this->condition_values = array($data1[$k]['question_id']); 
                            }
                            $this->query_generate();
                            $data2 = $this->query_fetch();
                            if($data2){
                                for($j=0;$j<count($data2);$j++){
                                    $result[] = $data2[$j];
                                }
                            }
                        }
//                        
                    }
                }
                $temp_result = array();
                $temp_ids_array = array();
                for($i=0;$i<count($result);$i++){
                    if(in_array($result[$i]['id'], $temp_ids_array)){
                        continue;
                    }else{
                        $temp_result[] = $result[$i];
                        $temp_ids_array[] = $result[$i]['id'];
                    }
                }
                $result = $temp_result;
                return $result;
            }else{
                return array();
            }
        }
        
     
     function get_invitation_ids($sur_id){
         $this->tables = array('srv_invitation_surveys');
         $this->fields = array('invitation_id');
         $this->conditions = array('survey_id = ?');
         $this->condition_values = array($sur_id);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             return $data;
         }else{
             return array();
         }
     }
     
     function get_total_num_pages($survey_id){
         $this->tables = array('srv_survey_forms');
         $this->fields = array('form_id');
         $this->conditions = array('survey_id = ?');
         $this->condition_values = array($survey_id);
         $this->query_generate();
         $data = $this->query_fetch();
         $page_count = 0;
         if($data){
            
            for($i = 0;$i<count($data);$i++){
               $this->tables = array('srv_forms');
               $this->fields = array('break_numbers');
               $this->conditions = array('id = ?');
               $this->condition_values = array($data[$i]['form_id']);
               $this->query_generate();
               $data1 = $this->query_fetch();
               $page_count = $page_count + count(explode(',',$data1[0]['break_numbers']));
            }
            
         }else{
            $page_count = $page_count + 1; 
         }
         return $page_count;
     }
     
     
     function  check_survey_completed_by_user($user,$survey_id,$total_pages){
        $this->tables = array('srv_user_Results');
        $this->fields = array('MAX(survey_page) AS max_page','username');
        $this->conditions = array('AND','survey_id = ?','username = ?');
        $this->condition_values = array($survey_id,$user);
        $this->query_generate();
        $data = $this->query_fetch();
//        echo "<pre>". print_r($data, 1)."</pre>";
        if($data[0]['max_page'] != ""){
            if($data[0]['max_page'] == $total_pages){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 2;
        }
     }

     function questions_survey_and_report($survey_id,$users, $get_restricted_questions_only = TRUE){
         $result = array();
         $questions = array();
         $this->tables = array('srv_survey_forms');
         $this->fields = array('form_id');
         $this->conditions = array('survey_id = ?');
         $this->condition_values = array($survey_id);
         $this->order_by = array('forms_order');
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             for($i=0;$i<count($data);$i++){
                 $this->tables = array('srv_form_questions');
                 $this->fields = array('question_id');
                 $this->conditions = array('form_id = ?');
                 $this->condition_values = array($data[$i]['form_id']);
                 $this->order_by = array('question_order');
                 $this->query_generate();
                 $data1 = $this->query_fetch();
                 if($data1){
                     for($j=0;$j<count($data1);$j++){
                         if(in_array($data1[$j]['question_id'], $questions)){
                             continue;
                         }else{
                             $questions[] = $data1[$j]['question_id'];
                             $this->tables = array('srv_questions');
                             $this->fields = array('id','parent_question_ID','question','answer_type');
                             $this->conditions = array('AND',array('OR','parent_question_ID = ?','id = ?'));
                             $this->condition_values = array($data1[$j]['question_id'],$data1[$j]['question_id']);
                             if($get_restricted_questions_only){
                                 $this->conditions[] = array('OR','answer_type = 1','answer_type = 2','answer_type = 3','answer_type = 6');
                             }
                             $this->query_generate();
                             $data2 = $this->query_fetch();
                             if($data2){
                                 for($k=0;$k<count($data2);$k++){
                                     $result[] = $data2[$k];
                                 }
                             }
                         }
                     }
                 }
             }
         }
         
         for($i=0;$i<count($result);$i++){
             $result[$i]['ans_count'] = 0;
             if(in_array($result[$i]['answer_type'], array(1,2,3,6,10))/* && $result[$i]['parent_question_ID'] == 0*/){
                $this->tables = array('srv_question_answer');
                $this->fields = array('answer_text','id');
                $this->conditions = array('question_id = ?');
                $this->condition_values = array($result[$i]['id']);
                $this->query_generate();
                $data = $this->query_fetch();
                if($data){
                    if($result[$i]['answer_type'] == 6){
                       $data_temp = array();
                       $limits = explode('||',$data[0]['answer_text']);
                       for($j=1;$j<=$limits[2];$j++){
                           $rate = floatval((intval($limits[1])-intval($limits[0]))/(intval($limits[2])-1));
                           $star_rate = floatval(intval($limits[0]) + ($rate * ($j-1)));
                           $temp['answer_text'] = $star_rate;
                           $temp['id'] = $data[0]['id'];
                           $data_temp[] = $temp;
                       }
                       $result[$i]['answers'] = $data_temp;
                       $result[$i]['ans_count'] = 0;
   //                        $temp =  
                    }else{
                       $result[$i]['answers'] = $data;
                       $result[$i]['ans_count'] = 0;
                    }
                }else{
                    $result[$i]['answers'] = array();
                    $result[$i]['ans_count'] = 0;
                }
             }
//             else if($result[$i]['answer_type'] == 10 && $result[$i]['parent_question_ID'] != 0){
//                 $result[$i]['ans_count'] = 0;
//             }
         }
//         echo "<pre>".print_r($result, 1)."</pre>";
         
         // re-indexing as question id
         if(!empty($result)){
             $temp_result = array();
             foreach($result as $rKey => $rValue){
                 $temp_result[$rValue['id']] = $rValue;
             }
             
             $result = $temp_result;
         }
         
         // assign answers to each subquestions of likert matrix
         if(!empty($result)){
             foreach($result as $rKey => $rValue){
                 if($rValue['answer_type'] == 10 && $rValue['parent_question_ID'] != 0){
                     $result[$rKey]['answers'] = $result[$rValue['parent_question_ID']]['answers'];
                     $result[$rKey]['ans_count'] = 0;
                 }
             }
         }
         
//         $quest_count = array();
//        echo "result -------------<pre>".print_r($result, 1)."</pre>";
         for($i=0;$i<count($users);$i++){
             $this->tables = array('srv_user_Results');
             $this->fields = array('id','form_id','username');
             $this->conditions = array('AND','username = ?','survey_id = ?');
             $this->condition_values = array($users[$i],$survey_id);
             $this->query_generate();
             $data = $this->query_fetch();
             if($data){
                 foreach($data as $j => $uresult){
                    $this->tables = array('srv_user_Results_data');
                    $this->fields = array('answer_id_txt','question_id');
                    $this->conditions = array('result_id = ?');
                    $this->condition_values = array($uresult['id']);
                    $this->query_generate();
                    $data1 = $this->query_fetch();
                    
                    if(!empty($data1)){
                        foreach($data1 as $k => $uresult_data){
                            if(!empty($result)){
                                foreach($result as $l => $result_data){
                                    if($result_data['id'] == $uresult_data['question_id']){

                                        //radio, check, combo, star rating
                                        if(in_array($result_data['answer_type'], array(1,2,3,6,10))/* && $result_data['parent_question_ID'] == 0*/){
                                            $result[$l]['ans_count'] += 1;

                                            if($result_data['answer_type'] == 6){
                                                if(!empty($result_data['answers'])){
                                                    foreach($result_data['answers'] as $x => $result_answer){

                                                            if(($result_answer['answer_text'] ==  $uresult_data['answer_id_txt']) && ($result_data['id'] == $uresult_data['question_id'])){
                                                                if(isset($result_data['answers'][$x]['count']))
                                                                    $result[$l]['answers'][$x]['count'] = $result[$l]['answers'][$x]['count'] + 1;
                                                                else
                                                                    $result[$l]['answers'][$x]['count'] = 1;
                                                            }
                                                    }
                                                }
                                            }else{
                                                if(!empty($result_data['answers'])){
                                                    foreach($result_data['answers'] as $x => $result_answer){

                                                        if(($result_answer['id'] ==  $uresult_data['answer_id_txt']) && ($result_data['id'] == $uresult_data['question_id'])){
                                                            if(isset($result[$l]['answers'][$x]['count'])){
                                                                $result[$l]['answers'][$x]['count'] = $result[$l]['answers'][$x]['count'] + 1;
                                                            }else{
                                                                $result[$l]['answers'][$x]['count'] = 1;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        else {
                                            if(trim($uresult_data['answer_id_txt']) != ''){
                                                $result[$l]['ans_count'] += 1;
                                                $result[$l]['user_responds'][] = $uresult_data['answer_id_txt'];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                 }
             }else{
                 continue;
             }
         }
         
//         echo "++++<pre>".print_r($result, 1)."</pre>";
         
         
         // re-indexing as question id
         /*if(!empty($result)){
             $temp_result = array();
             foreach($result as $rKey => $rValue){
                 $temp_result[$rValue['id']] = $rValue;
             }
             
             $result = $temp_result;
         }*/
         
         // custome rating format changed to star rating format
         if(!empty($result)){
             foreach($result as $rKey => $rValue){
                 if($rValue['answer_type'] == 7){
                     $grouped_responds = array();
                     if(!empty($rValue['user_responds'])){
                         $response_grouped_counts = array_count_values($rValue['user_responds']);
                         foreach($response_grouped_counts as $groupRespond => $groupCount){
                             //remove empty responds
                             if(trim($groupRespond) != ''){
                                 $grouped_responds[] = array(
                                     'answer_text' => $groupRespond,
                                     'count' => $groupCount
                                 );
                             }
                         }
                     }
                     $result[$rKey]['answers'] = $grouped_responds;
                 }
             }
         }
         
         // grouping likert matrix questions
         if(!empty($result)){
             foreach($result as $rKey => $rValue){
                 if($rValue['answer_type'] == 10 && $rValue['parent_question_ID'] != 0){
                     $result[$rValue['parent_question_ID']]['sub_questions'][] = $rValue;
                     unset($result[$rKey]);
                 }
             }
         }
         
//         echo "result alterd<pre>".print_r($result, 1)."</pre>";
         return $result;
     }
     
     
     function get_answers_survey($questions,$survey_ids=null){
         for($i=0;$i<count($questions);$i++){
            $this->tables = array('srv_question_answer');
            $this->fields = array('answer_text','id');
            $this->conditions = array('question_id = ?');
            $this->condition_values = array($questions[$i]['id']);
            $this->query_generate();
//            echo $this->sql_query."<br>".$questions[$i]['id'];
            $data = $this->query_fetch();
            if($data){
                if($questions[$i]['answer_type'] == 6){
                    $data_temp = array();
                    $limits = explode('||',$data[0]['answer_text']);
                    for($j=1;$j<=$limits[2];$j++){
                        $rate = floatval((intval($limits[1])-intval($limits[0]))/(intval($limits[2])-1));
                        $star_rate = floatval(intval($limits[0]) + ($rate * ($j-1)));
                        $temp['answer_text'] = $star_rate;
                        $temp['id'] = $data[0]['id'];
                        $data_temp[] = $temp;
                    }
                    $questions[$i]['answers'] = $data_temp;
                    if($survey_ids != NULL){
                        for($k=0;$k<count($questions[$i]['answers']);$k++){
                            
                            for($j=0;$j<count($survey_ids);$j++){
                                $questions[$i]['answers'][$k]['surveys'][] = array('survey_id' => $survey_ids[$j]);
                            }
                        }
                    }
                }else{
                    $questions[$i]['answers'] = $data;
                    if($survey_ids != NULL){
                        for($k=0;$k<count($questions[$i]['answers']);$k++){ 
                            for($j=0;$j<count($survey_ids);$j++){
                                $questions[$i]['answers'][$k]['surveys'][] = array('survey_id' => $survey_ids[$j]);
                            }
                        }
                    }
                }
            }else{
                $questions[$i]['answers'] = array();
            }
         }
         return $questions;
     }
     
     
     function get_members_answered_quest($quest_ans,$ans,$survey_id){
         $quest_ids = array();
         $ans_ids = array();
         $ans_text = explode(",",$ans);
         $temp_ids = explode(",",$quest_ans);
//         echo "<pre>". print_r($ans_text, 1)."</pre>";
//         echo "<pre>". print_r($temp_ids, 1)."</pre>";
         for($i=0;$i<count($temp_ids);$i++){
            $temp_iquest_ds[] = explode("_",$temp_ids[$i]);
         }
         for($i=0;$i<count($temp_iquest_ds);$i++){
            $quest_ids[] =  $temp_iquest_ds[$i][1];
            $ans_ids[] =  $temp_iquest_ds[$i][2];
         }
         $quest_answer_type = array();
         for($i=0;$i<count($quest_ids);$i++){
            $this->tables = array('srv_questions');
            $this->fields = array('answer_type');
            $this->conditions = array('id = ?');
            $this->condition_values = array($quest_ids[$i]);
            $this->query_generate();
            $data = $this->query_fetch();
            $quest_answer_type[] = $data[0]['answer_type'];
         }
         $users = array();
         for($i=0;$i<count($quest_ids);$i++){
            $this->tables = array('srv_user_Results_data` AS `urd','srv_user_Results` AS `ur');
            $this->fields = array('ur.username');
            $this->conditions = array('AND','urd.question_id = ?','urd.answer_id_txt = ?','urd.result_id = ur.id','ur.survey_id = ?');
            if($quest_answer_type[$i] == 6){
                $this->condition_values = array($quest_ids[$i],$ans_text[$i],$survey_id);
            }else{
                $this->condition_values = array($quest_ids[$i],$ans_ids[$i],$survey_id);
            }
            $this->query_generate();
            $data = $this->query_fetch();
            
            for($j=0;$j<count($data);$j++){
                if(in_array($data[$j]['username'], $users)){
                    continue;
                }else{
                    $users[] = $data[$j]['username'];
                }
            }
         }
        return $users;
         
         
     }
     
     function get_survey_versions($survey_id){
        $survey_detail = $this->get_surveys_search_list($survey_id,'','','',1);
        $this->tables = array('srv_surveys');
        $this->fields = array('id','parent_survey_ID','survey_title','description','created_by','created_date','expire_date','status');
        if($survey_detail[0]['parent_survey_ID'] == 0){
            $this->conditions = array('OR','id = ?','parent_survey_ID = ?');
            $this->condition_values = array($survey_id,$survey_id);
        }else{
            $this->conditions = array('OR','id = ?','parent_survey_ID = ?');
            $this->condition_values = array($survey_detail[0]['parent_survey_ID'],$survey_detail[0]['parent_survey_ID']);
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
         
     }
     
     function get_form_questions($form_id){
         $this->tables = array('srv_form_questions` AS `fq','srv_questions` AS `q');
         $this->fields =  array('fq.question_id','q.question','q.answer_type','q.id');
         $this->conditions = array('AND','fq.form_id = ?',array('OR','q.answer_type = 1','q.answer_type = 2','q.answer_type = 3','q.answer_type = 6'),'q.id = fq.question_id');
         $this->condition_values = array($form_id);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             return $data;
         }else{
             return array();
         }
     }
     
     function get_result_ids_compare_survey($survey_id,$form_id,$username){
         $this->tables = array('srv_user_Results');
         $this->fields = array('id AS result_id');
         $this->conditions = array('AND','survey_id = ?','form_id = ?','username = ?');
         $this->condition_values = array($survey_id,$form_id,$username);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             return $data;
         }else{
             return array();
         }
     }
     
     function get_answer_compare_survey_quest($form_id,$question_id,$survey_id,$ans_id,$ans_text,$username){
         $this->tables = array('srv_user_Results` AS `r','srv_user_Results_data` AS `rd','srv_questions` AS `q');
         $this->fields = array('rd.answer_id_txt','q.answer_type');
         $this->conditions = array('AND','rd.question_id = ?','rd.question_id = q.id','r.form_id = ?','r.survey_id = ?','r.username = ?','r.id = rd.result_id');
         $this->condition_values = array($question_id,$form_id,$survey_id,$username);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
//             echo "<pre>". print_r($data, 1)."</pre>";
             if($data[0]['answer_type'] == 6){
                 if($ans_text == $data[0]['answer_id_txt']){
                     echo $ans_text."  ".$data[0]['answer_id_txt']."<br><br>";
                     return 1;
                 }
             }elseif($data[0]['answer_type'] == 2){
                 return $data;
             }else{
                 if($ans_id == $data[0]['answer_id_txt']){
                     echo $ans_id."  ".$data[0]['answer_id_txt']."<br><br>";
                     return 1;
                 }
             }
//             for($i=0;$i<count($data);$i++){
//                 $this->tables = array('srv_question_answer');
//                 $this->fields = array('answer_text','id');
//                 $this->conditions = array('id = ?');
//                 $this->condition_values = array($data[$i]['answer_id_txt']);
//                 $this->query_generate();
//                 $data1 = $this->query_fetch();
//                 $data[$i]['ans']= $data1[0]['answer_text'];
//             }
//             return $data;
         }else{
             return 0;
         }
     }
     
     
     function get_users_attended_survey($survey_id){
         $this->tables = array('srv_user_Results` AS `ur','employee` AS `emp');
         $this->fields = array('DISTINCT(ur.username) AS users','CONCAT(emp.last_name," ",emp.first_name) AS name' );
//         $this->fields = array('username');
         $this->conditions = array('AND','survey_id = ?','ur.username = emp.username');
         $this->condition_values = array($survey_id);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
//             echo "<pre>". print_r($data, 1)."</pre>";
             return $data;
         }else{
             return array();
         }
     }
     
     function get_summery_report_user($survey_id,$user){
         $this->tables = array('srv_user_Results` AS `ur','srv_user_Results_data` AS `urd','srv_questions` AS `q');
         $this->fields = array('ur.id AS ids','ur.form_id','urd.question_id','urd.answer_id_txt','q.answer_type');
         $this->conditions = array('AND','ur.survey_id = ?','ur.username = ?','ur.id = urd.result_id','urd.question_id = q.id');
         $this->condition_values = array($survey_id,$user);
         $this->order_by = array('ur.form_id');
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             for($i=0;$i<count($data);$i++){
                 $this->tables = array('srv_questions` AS `q','srv_question_answer` AS `a');
                 $this->fields = array('q.question','a.answer_text');
                 if($data[$i]['answer_type'] == 1 || $data[$i]['answer_type'] == 2 || $data[$i]['answer_type'] == 3 || $data[$i]['answer_type'] == 6){
                    $this->conditions = array('AND',array('OR','q.id = ?','q.parent_question_ID = ?'),'q.id = a.question_id','a.id = ?');
                    $this->condition_values = array($data[$i]['question_id'],$data[$i]['question_id'],$data[$i]['answer_id_txt']); 
                 }else{
                    $this->conditions = array('AND',array('OR','q.id = ?','q.parent_question_ID = ?'),'q.id = a.question_id');
                    $this->condition_values = array($data[$i]['question_id'],$data[$i]['question_id']);
                 }
                 $this->query_generate();
                 $data1 = $this->query_fetch();
                 if($data1){
                     $data[$i]['quest'] = $data1;
                 }else{
                     $data[$i]['quest'] = array();
                 }
                 
             }
             return $data;
         }else{
             return array();
         }
     }
     
     
     function get_combined_question_survey($quest_id){
         $this->tables = array('srv_user_Results_data` AS `urd','srv_user_Results` AS `ur');
         $this->fields = array('urd.answer_id_txt','ur.survey_id','urd.result_id','urd.question_id');
         $this->conditions = array('AND','urd.question_id = ?','ur.id = urd.result_id');
         $this->condition_values = array($quest_id);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             $this->tables = array('srv_question_answer` AS `qa','srv_questions` AS `q');
             $this->fields = array('qa.id','qa.answer_text','q.question');
             $this->conditions = array('AND','qa.question_id = ?','qa.question_id = q.id');
             $this->condition_values = array($quest_id);
             $this->query_generate();
             $data1 = $this->query_fetch();
             for($i=0;$i<count($data1);$i++){
                 $data1[$i]['count'] = 0;
             }
             $complete_count = 0;
            for($i=0;$i<count($data);$i++){
                for($j=0;$j<count($data1);$j++){
                    if($data[$i]['answer_id_txt'] == $data1[$j]['id']){
                        $complete_count++;
                        $data1[$j]['count'] = $data1[$j]['count'] + 1;
                        break;
                    }
                }
                if($j == count($data1)){
                    $complete_count++;
                }
            }
            $data1[count($data1)]['full_count'] = count($data);
//            echo "<pre>". print_r($data1, 1)."</pre>";
            return $data1;
         }else{
             return array();
         }
     }
     
     function set_break_num($brek_num,$form_id){
         $this->tables = array('srv_forms');
         $this->fields = array('break_numbers');
         $this->field_values = array($brek_num);
         $this->conditions = array('id = ?');
         $this->condition_values = array($form_id);
         if($this->query_update()){
             return true;
         }else{
             return false;
         }
        
     }
//    function get_answers_survey_questions($question){
//    }
     
     
     
     // Function To check whether form is present in the survey during the form  delete 
     function check_form_in_survey($form_id){
         $this->tables = array('srv_survey_forms');
         $this->fields = array('form_id');
         $this->conditions = array('form_id = ?');
         $this->condition_values = array($form_id);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             return 1;
         }else{
             return 0;
         }
     }
     
     function check_survey_in_use($survey_id){
         $this->tables = array('srv_invitation_surveys');
         $this->fields = array('survey_id');
         $this->conditions = array('survey_id = ?');
         $this->condition_values = array($survey_id);
         $this->query_generate();
         $data = $this->query_fetch();
         if($data){
             return 1;
         }else{
             return 0;
         }
     }
     
     
     /* Function to Check if the survey new form has questions in the old forms */
     function check_survey_question_repeat($old_forms){
         $this->tables = array('srv_form_questions');
         $this->fields = array('question_id','COUNT(question_id) AS cnt');
         $this->conditions = array('AND',array('IN','form_id',$old_forms));
         $this->group_by = array('question_id HAVING cnt > 1');
         $this->query_generate();
//         echo $this->sql_query;
         $data = $this->query_fetch();
         if($data){
             return 'Fail';
         }else{
             return 'success';
         }
         
     }
}
?>