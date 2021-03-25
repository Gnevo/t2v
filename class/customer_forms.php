<?php
/**
 * Description of company
 * @author dona
 */
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once ('class/db.php');

class customer_forms extends db {

	function __construct() {

        parent::__construct();
    }

    function get_form_1(){

    	$this->tables = array('form_1');
    	$this->fields = array('id','customer','created_date','created_by', 'version', 'check_r', 'check_s', 'review_employee', 'review_date', 'review_next_date');
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_form_1_by_id($id){

        if($_SESSION['company_sort_by'] == 1) {
        	$this->sql_query = "SELECT f1.id, f1.customer, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f1.created_date, f1.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f1.version, f1.check_r, f1.check_s, f1.review_employee, CONCAT(re.first_name, ' ', re.last_name) AS review_name, f1.review_date, f1.review_next_date, f1.field_1_1_radio, f1.field_1_1_val, f1.field_1_2_radio, f1.field_1_2_val, f1.field_1_3_radio, f1.field_1_3_val, f1.field_1_4_radio, f1.field_1_4_val, f1.field_1_5_radio, f1.field_1_5_val, f1.field_1_6_radio, f1.field_1_6_val, f1.field_1_7_radio, f1.field_1_7_val, f1.field_1_8_radio, f1.field_1_8_val, f1.field_1_9_radio, f1.field_1_9_val, f1.field_1_10_radio, f1.field_1_10_val, f1.field_2_1_radio, f1.field_2_1_val, f1.field_2_2_radio, f1.field_2_2_val, f1.field_2_3_radio, f1.field_2_3_val, f1.field_2_4_radio, f1.field_2_4_val, f1.field_2_5_radio, f1.field_2_5_val, f1.field_3_1_radio, f1.field_3_1_val, f1.field_3_2_radio, f1.field_3_2_val, f1.field_4_1_radio, f1.field_4_1_val, f1.field_4_2_radio, f1.field_4_2_val, f1.field_4_3_radio, f1.field_4_3_val, f1.field_5_1_radio, f1.field_5_1_val, f1.field_5_2_radio, f1.field_5_2_val, f1.field_5_3_radio, f1.field_5_3_val, f1.field_5_4_radio, f1.field_5_4_val, f1.field_6_1_radio, f1.field_6_1_val, f1.field_6_2_radio, f1.field_6_2_val, f1.field_6_3_radio, f1.field_6_3_val FROM form_1 f1 INNER JOIN customer c ON f1.customer = c.username INNER JOIN employee ce ON f1.created_by = ce.username INNER JOIN employee re ON f1.review_employee = re.username WHERE f1.id = $id";
    	} else {
    		$this->sql_query = "SELECT f1.id, f1.customer, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f1.created_date, f1.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f1.version, f1.check_r, f1.check_s, f1.review_employee, CONCAT(re.last_name, ' ', re.first_name) AS review_name, f1.review_date, f1.review_next_date, f1.field_1_1_radio, f1.field_1_1_val, f1.field_1_2_radio, f1.field_1_2_val, f1.field_1_3_radio, f1.field_1_3_val, f1.field_1_4_radio, f1.field_1_4_val, f1.field_1_5_radio, f1.field_1_5_val, f1.field_1_6_radio, f1.field_1_6_val, f1.field_1_7_radio, f1.field_1_7_val, f1.field_1_8_radio, f1.field_1_8_val, f1.field_1_9_radio, f1.field_1_9_val, f1.field_1_10_radio, f1.field_1_10_val, f1.field_2_1_radio, f1.field_2_1_val, f1.field_2_2_radio, f1.field_2_2_val, f1.field_2_3_radio, f1.field_2_3_val, f1.field_2_4_radio, f1.field_2_4_val, f1.field_2_5_radio, f1.field_2_5_val, f1.field_3_1_radio, f1.field_3_1_val, f1.field_3_2_radio, f1.field_3_2_val, f1.field_4_1_radio, f1.field_4_1_val, f1.field_4_2_radio, f1.field_4_2_val, f1.field_4_3_radio, f1.field_4_3_val, f1.field_5_1_radio, f1.field_5_1_val, f1.field_5_2_radio, f1.field_5_2_val, f1.field_5_3_radio, f1.field_5_3_val, f1.field_5_4_radio, f1.field_5_4_val, f1.field_6_1_radio, f1.field_6_1_val, f1.field_6_2_radio, f1.field_6_2_val, f1.field_6_3_radio, f1.field_6_3_val FROM form_1 f1 INNER JOIN customer c ON f1.customer = c.username INNER JOIN employee ce ON f1.created_by = ce.username INNER JOIN employee re ON f1.review_employee = re.username WHERE f1.id = $id";
    	}
        $data = $this->query_fetch();
        if(!empty($data)) {
        	return $data[0];
    	} else {
    		return array();
    	}
    }

    function get_form_1_customer($customer){

    	$this->tables = array('form_1');
    	$this->fields = array('id','created_date','created_by', 'version', 'check_r', 'check_s', 'review_employee', 'review_date', 'review_next_date');
    	$this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_1_insert($data){

    	$this->tables = array('form_1');
    	$this->fields = array('customer','created_date','created_by', 'version', 'check_r', 'check_s', 'review_employee', 'review_date', 'review_next_date', 'field_1_1_radio', 'field_1_1_val', 'field_1_2_radio', 'field_1_2_val', 'field_1_3_radio', 'field_1_3_val', 'field_1_4_radio', 'field_1_4_val', 'field_1_5_radio', 'field_1_5_val', 'field_1_6_radio', 'field_1_6_val', 'field_1_7_radio', 'field_1_7_val', 'field_1_8_radio', 'field_1_8_val', 'field_1_9_radio', 'field_1_9_val', 'field_1_10_radio', 'field_1_10_val', 'field_2_1_radio', 'field_2_1_val', 'field_2_2_radio', 'field_2_2_val', 'field_2_3_radio', 'field_2_3_val', 'field_2_4_radio', 'field_2_4_val', 'field_2_5_radio', 'field_2_5_val', 'field_3_1_radio', 'field_3_1_val', 'field_3_2_radio', 'field_3_2_val', 'field_4_1_radio', 'field_4_1_val', 'field_4_2_radio', 'field_4_2_val', 'field_4_3_radio', 'field_4_3_val', 'field_5_1_radio', 'field_5_1_val', 'field_5_2_radio', 'field_5_2_val', 'field_5_3_radio', 'field_5_3_val', 'field_5_4_radio', 'field_5_4_val', 'field_6_1_radio', 'field_6_1_val', 'field_6_2_radio', 'field_6_2_val', 'field_6_3_radio', 'field_6_3_val');
        $this->field_values = array($data['customer'],$data['created_date'],$data['created_by'], $data['version'], $data['check_r'], $data['check_s'], $data['review_employee'], $data['review_date'], $data['review_next_date'], $data['field_1_1_radio'], $data['field_1_1_val'], $data['field_1_2_radio'], $data['field_1_2_val'], $data['field_1_3_radio'], $data['field_1_3_val'], $data['field_1_4_radio'], $data['field_1_4_val'], $data['field_1_5_radio'], $data['field_1_5_val'], $data['field_1_6_radio'], $data['field_1_6_val'], $data['field_1_7_radio'], $data['field_1_7_val'], $data['field_1_8_radio'], $data['field_1_8_val'], $data['field_1_9_radio'], $data['field_1_9_val'], $data['field_1_10_radio'], $data['field_1_10_val'], $data['field_2_1_radio'], $data['field_2_1_val'], $data['field_2_2_radio'], $data['field_2_2_val'], $data['field_2_3_radio'], $data['field_2_3_val'], $data['field_2_4_radio'], $data['field_2_4_val'], $data['field_2_5_radio'], $data['field_2_5_val'], $data['field_3_1_radio'], $data['field_3_1_val'], $data['field_3_2_radio'], $data['field_3_2_val'], $data['field_4_1_radio'], $data['field_4_1_val'], $data['field_4_2_radio'], $data['field_4_2_val'], $data['field_4_3_radio'], $data['field_4_3_val'], $data['field_5_1_radio'], $data['field_5_1_val'], $data['field_5_2_radio'], $data['field_5_2_val'], $data['field_5_3_radio'], $data['field_5_3_val'], $data['field_5_4_radio'], $data['field_5_4_val'], $data['field_6_1_radio'], $data['field_6_1_val'], $data['field_6_2_radio'], $data['field_6_2_val'], $data['field_6_3_radio'], $data['field_6_3_val']);
        if($this->query_insert()){
            return $this->get_id();
        } else {
        	return FALSE;
        }
    }

    function form_1_update($id, $data){

    	$this->tables = array('form_1');
    	$this->fields = array('check_r', 'check_s', 'review_employee', 'review_date', 'review_next_date', 'field_1_1_radio', 'field_1_1_val', 'field_1_2_radio', 'field_1_2_val', 'field_1_3_radio', 'field_1_3_val', 'field_1_4_radio', 'field_1_4_val', 'field_1_5_radio', 'field_1_5_val', 'field_1_6_radio', 'field_1_6_val', 'field_1_7_radio', 'field_1_7_val', 'field_1_8_radio', 'field_1_8_val', 'field_1_9_radio', 'field_1_9_val', 'field_1_10_radio', 'field_1_10_val', 'field_2_1_radio', 'field_2_1_val', 'field_2_2_radio', 'field_2_2_val', 'field_2_3_radio', 'field_2_3_val', 'field_2_4_radio', 'field_2_4_val', 'field_2_5_radio', 'field_2_5_val', 'field_3_1_radio', 'field_3_1_val', 'field_3_2_radio', 'field_3_2_val', 'field_4_1_radio', 'field_4_1_val', 'field_4_2_radio', 'field_4_2_val', 'field_4_3_radio', 'field_4_3_val', 'field_5_1_radio', 'field_5_1_val', 'field_5_2_radio', 'field_5_2_val', 'field_5_3_radio', 'field_5_3_val', 'field_5_4_radio', 'field_5_4_val', 'field_6_1_radio', 'field_6_1_val', 'field_6_2_radio', 'field_6_2_val', 'field_6_3_radio', 'field_6_3_val');
        $this->field_values = array($data['check_r'], $data['check_s'], $data['review_employee'], $data['review_date'], $data['review_next_date'], $data['field_1_1_radio'], $data['field_1_1_val'], $data['field_1_2_radio'], $data['field_1_2_val'], $data['field_1_3_radio'], $data['field_1_3_val'], $data['field_1_4_radio'], $data['field_1_4_val'], $data['field_1_5_radio'], $data['field_1_5_val'], $data['field_1_6_radio'], $data['field_1_6_val'], $data['field_1_7_radio'], $data['field_1_7_val'], $data['field_1_8_radio'], $data['field_1_8_val'], $data['field_1_9_radio'], $data['field_1_9_val'], $data['field_1_10_radio'], $data['field_1_10_val'], $data['field_2_1_radio'], $data['field_2_1_val'], $data['field_2_2_radio'], $data['field_2_2_val'], $data['field_2_3_radio'], $data['field_2_3_val'], $data['field_2_4_radio'], $data['field_2_4_val'], $data['field_2_5_radio'], $data['field_2_5_val'], $data['field_3_1_radio'], $data['field_3_1_val'], $data['field_3_2_radio'], $data['field_3_2_val'], $data['field_4_1_radio'], $data['field_4_1_val'], $data['field_4_2_radio'], $data['field_4_2_val'], $data['field_4_3_radio'], $data['field_4_3_val'], $data['field_5_1_radio'], $data['field_5_1_val'], $data['field_5_2_radio'], $data['field_5_2_val'], $data['field_5_3_radio'], $data['field_5_3_val'], $data['field_5_4_radio'], $data['field_5_4_val'], $data['field_6_1_radio'], $data['field_6_1_val'], $data['field_6_2_radio'], $data['field_6_2_val'], $data['field_6_3_radio'], $data['field_6_3_val']);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return $id;
        } else {
            return FALSE;
        }
    }

    function get_form_2_questions() {
        $questions = array();
        $this->sql_query = "SELECT id, qorder, question FROM `form_2_question` ORDER BY qorder";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach($datas AS $data) {
                $questions[$data['id']] = $data;
            }
        }
        return $questions;
    }

    function get_form_2(){

        $this->tables = array('form_2');
        $this->fields = array('id','customer','created_date','created_by', 'version', 'check_r', 'check_s');
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_form_2_report($customer_id = 0) {
        $data_report = array();
        if($customer_id) {
            $this->sql_query = "SELECT fa.question_id, q.question, COUNT(fa.answer) AS count,
                SUM(CASE WHEN fa.answer = 1 THEN 1 ELSE 0 END) AS answer_1,
                SUM(CASE WHEN fa.answer = 2 THEN 1 ELSE 0 END) AS answer_2,
                SUM(CASE WHEN fa.answer = 3 THEN 1 ELSE 0 END) AS answer_3,
                SUM(CASE WHEN fa.answer = 4 THEN 1 ELSE 0 END) AS answer_4,
                SUM(CASE WHEN fa.answer = 5 THEN 1 ELSE 0 END) AS answer_5,
                SUM(CASE WHEN fa.answer = 6 THEN 1 ELSE 0 END) AS answer_6
                FROM form_2_answer fa 
                INNER JOIN form_2 f ON f.id = fa.id 
                INNER JOIN form_2_question q ON q.id = fa.question_id 
                WHERE f.customer = '$customer_id' 
                GROUP BY fa.question_id 
                ORDER BY q.qorder";
        } else {
            $this->sql_query = "SELECT fa.question_id, q.question, COUNT(fa.answer) AS count,
                SUM(CASE WHEN fa.answer = 1 THEN 1 ELSE 0 END) AS answer_1,
                SUM(CASE WHEN fa.answer = 2 THEN 1 ELSE 0 END) AS answer_2,
                SUM(CASE WHEN fa.answer = 3 THEN 1 ELSE 0 END) AS answer_3,
                SUM(CASE WHEN fa.answer = 4 THEN 1 ELSE 0 END) AS answer_4,
                SUM(CASE WHEN fa.answer = 5 THEN 1 ELSE 0 END) AS answer_5,
                SUM(CASE WHEN fa.answer = 6 THEN 1 ELSE 0 END) AS answer_6
                FROM form_2_answer fa 
                INNER JOIN form_2 f ON f.id = fa.id 
                INNER JOIN form_2_question q ON q.id = fa.question_id 
                WHERE 1 
                GROUP BY fa.question_id 
                ORDER BY q.qorder";
        }
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $data_report = $datas;
        }
        return $data_report;
    }

    function get_form_2_description_report($customer_id = 0) {
        $data_report = array();
        if($customer_id) {
            $this->sql_query = "SELECT field_description FROM `form_2` WHERE field_description IS NOT NULL AND customer = '$customer_id'";
        } else {
            $this->sql_query = "SELECT field_description FROM `form_2` WHERE field_description IS NOT NULL";
        }
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $data_report = $datas;
        }
        return $data_report;
    }

    function get_form_2_by_id($id){
        $review_data = array();
        if($_SESSION['company_sort_by'] == 1) {
            $this->sql_query = "SELECT f2.id, f2.customer, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f2.created_date, f2.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f2.version, f2.check_r, f2.check_s, f2.field_description FROM form_2 f2 INNER JOIN customer c ON f2.customer = c.username INNER JOIN employee ce ON f2.created_by = ce.username WHERE f2.id = $id";
        } else {
            $this->sql_query = "SELECT f2.id, f2.customer, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f2.created_date, f2.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f2.version, f2.check_r, f2.check_s, f2.field_description FROM form_2 f2 INNER JOIN customer c ON f2.customer = c.username INNER JOIN employee ce ON f2.created_by = ce.username WHERE f2.id = $id";
        }
        $data = $this->query_fetch();
        if(!empty($data)) {
            $answer_datas = $this->get_form_2_answers_by_id($id);
            $review_data = $data[0];
            $review_data['answers'] = $answer_datas;
        }
        return $review_data;
    }

    function get_form_2_answers_by_id($id){
        $answers = array();
        $this->sql_query = "SELECT id, question_id, answer FROM `form_2_answer` WHERE id = $id";
        $datas = $this->query_fetch();
        foreach($datas as $data) {
            $answers[$data['question_id']] = $data['answer'];
        }
        return $answers;
    }

    function get_form_2_customer($customer){

        $this->tables = array('form_2');
        $this->fields = array('id','created_date','created_by', 'version', 'check_r', 'check_s');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_2_insert($data){

        $this->tables = array('form_2');
        $this->fields = array('customer','created_date','created_by', 'version', 'check_r', 'check_s', 'field_description');
        $this->field_values = array($data['customer'],$data['created_date'],$data['created_by'], $data['version'], $data['check_r'], $data['check_s'], $data['field_description']);
        if($this->query_insert()){
            $review_id = $this->get_id();
            $answers_data = array();
            for($i=0; $i < count($data['questions']); $i++) {
                $answers_data[] = array($review_id, $data['questions'][$i], $data['answers'][$i]);
            }
            if(!empty($answers_data)) {
                $this->tables = array('form_2_answer');
                $this->fields = array('id','question_id','answer');
                $this->field_values = $answers_data;
                $this->query_insert();
                return $review_id;
            }
        }
        return FALSE;
    }

    function form_2_question_insert($datas){
        $questions = array();
        foreach($datas as $data) {
            $questions[] = array($data['order'], $data['question']);
        }
        $this->tables = array('form_2_question');
        $this->fields = array('qorder','question');
        $this->field_values = $questions;
        if($this->query_insert()){
            return TRUE;
        }
        return FALSE;
    }

    function form_2_question_update($datas){
        $flag = TRUE;
        foreach($datas as $data) {
            $this->tables = array('form_2_question');
            $this->fields = array('qorder','question');
            $this->field_values = array($data['order'], $data['question']);
            $this->conditions = array('id = ?');
            $this->condition_values = array($data['id']);
            if(!$this->query_update()) {
                $flag = FALSE;
            }
        }
        return $flag;
    }

    function form_2_question_delete($id){
        $this->tables = array('form_2_question');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return TRUE;
        }
        return FALSE;
    }

    function get_form_3(){

        $this->tables = array('form_3');
        $this->fields = array('id','customer','created_date','created_by', 'version', 'check_r', 'check_s');
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_form_3_report($customer_id = 0) {
        $form_data = array(
            'field_1' => "",
            'field_2' => "",
            'field_3' => "",
            'field_4' => "",
            'field_5' => "",
            'field_6' => "",
            'field_7' => ""
        );
        $data_report = array();
        if($customer_id) {
            $this->sql_query = "SELECT fa.question_id, q.question, COUNT(fa.answer) AS count,
                SUM(CASE WHEN fa.answer = 1 THEN 1 ELSE 0 END) AS answer_1,
                SUM(CASE WHEN fa.answer = 2 THEN 1 ELSE 0 END) AS answer_2,
                SUM(CASE WHEN fa.answer = 3 THEN 1 ELSE 0 END) AS answer_3,
                SUM(CASE WHEN fa.answer = 4 THEN 1 ELSE 0 END) AS answer_4,
                SUM(CASE WHEN fa.answer = 5 THEN 1 ELSE 0 END) AS answer_5,
                SUM(CASE WHEN fa.answer = 6 THEN 1 ELSE 0 END) AS answer_6
                FROM form_3_answer fa 
                INNER JOIN form_3 f ON f.id = fa.id 
                INNER JOIN form_3_question q ON q.id = fa.question_id 
                WHERE f.customer = '$customer_id' 
                GROUP BY fa.question_id 
                ORDER BY q.qorder";
        } else {
            $this->sql_query = "SELECT fa.question_id, q.question, COUNT(fa.answer) AS count,
                SUM(CASE WHEN fa.answer = 1 THEN 1 ELSE 0 END) AS answer_1,
                SUM(CASE WHEN fa.answer = 2 THEN 1 ELSE 0 END) AS answer_2,
                SUM(CASE WHEN fa.answer = 3 THEN 1 ELSE 0 END) AS answer_3,
                SUM(CASE WHEN fa.answer = 4 THEN 1 ELSE 0 END) AS answer_4,
                SUM(CASE WHEN fa.answer = 5 THEN 1 ELSE 0 END) AS answer_5,
                SUM(CASE WHEN fa.answer = 6 THEN 1 ELSE 0 END) AS answer_6
                FROM form_3_answer fa 
                INNER JOIN form_3 f ON f.id = fa.id 
                INNER JOIN form_3_question q ON q.id = fa.question_id 
                WHERE 1 
                GROUP BY fa.question_id 
                ORDER BY q.qorder";
        }
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $data_report = $datas;
        }
        return $data_report;
    }

    function get_form_3_description_report($customer_id = 0) {
        $data_report = array();
        if($customer_id) {
            $this->sql_query = "SELECT field_description FROM `form_3` WHERE field_description IS NOT NULL AND customer = '$customer_id'";
        } else {
            $this->sql_query = "SELECT field_description FROM `form_3` WHERE field_description IS NOT NULL";
        }
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $data_report = $datas;
        }
        return $data_report;
    }

    function get_form_3_by_id($id){
        $review_data = array();
        if($_SESSION['company_sort_by'] == 1) {
            $this->sql_query = "SELECT f3.id, f3.customer, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f3.created_date, f3.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f3.version, f3.check_r, f3.check_s, f3.field_description FROM form_3 f3 INNER JOIN customer c ON f3.customer = c.username INNER JOIN employee ce ON f3.created_by = ce.username WHERE f3.id = $id";
        } else {
            $this->sql_query = "SELECT f3.id, f3.customer, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f3.created_date, f3.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f3.version, f3.check_r, f3.check_s, f3.field_description FROM form_3 f3 INNER JOIN customer c ON f3.customer = c.username INNER JOIN employee ce ON f3.created_by = ce.username WHERE f3.id = $id";
        }
        $data = $this->query_fetch();
        if(!empty($data)) {
            $answer_datas = $this->get_form_3_answers_by_id($id);
            $review_data = $data[0];
            $review_data['answers'] = $answer_datas;
        }
        return $review_data;
    }

    function get_form_3_answers_by_id($id){
        $answers = array();
        $this->sql_query = "SELECT id, question_id, answer FROM `form_3_answer` WHERE id = $id";
        $datas = $this->query_fetch();
        foreach($datas as $data) {
            $answers[$data['question_id']] = $data['answer'];
        }
        return $answers;
    }

    function get_form_3_customer($customer){

        $this->tables = array('form_3');
        $this->fields = array('id','created_date','created_by', 'version', 'check_r', 'check_s');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_3_insert($data){

        $this->tables = array('form_3');
        $this->fields = array('customer','created_date','created_by', 'version', 'check_r', 'check_s', 'field_description');
        $this->field_values = array($data['customer'],$data['created_date'],$data['created_by'], $data['version'], $data['check_r'], $data['check_s'], $data['field_description']);
        if($this->query_insert()){
            $review_id = $this->get_id();
            $answers_data = array();
            for($i=0; $i < count($data['questions']); $i++) {
                $answers_data[] = array($review_id, $data['questions'][$i], $data['answers'][$i]);
            }
            if(!empty($answers_data)) {
                $this->tables = array('form_3_answer');
                $this->fields = array('id','question_id','answer');
                $this->field_values = $answers_data;
                $this->query_insert();
                return $review_id;
            }
        } else {
            return FALSE;
        }
    }

    function get_form_3_questions() {
        $questions = array();
        $this->sql_query = "SELECT id, qorder, question FROM `form_3_question` ORDER BY qorder";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach($datas AS $data) {
                $questions[$data['id']] = $data;
            }
        }
        return $questions;
    }

    function form_3_question_insert($datas){
        $questions = array();
        foreach($datas as $data) {
            $questions[] = array($data['order'], $data['question']);
        }
        $this->tables = array('form_3_question');
        $this->fields = array('qorder','question');
        $this->field_values = $questions;
        if($this->query_insert()){
            return TRUE;
        }
        return FALSE;
    }

    function form_3_question_update($datas){
        $flag = TRUE;
        foreach($datas as $data) {
            $this->tables = array('form_3_question');
            $this->fields = array('qorder','question');
            $this->field_values = array($data['order'], $data['question']);
            $this->conditions = array('id = ?');
            $this->condition_values = array($data['id']);
            if(!$this->query_update()) {
                $flag = FALSE;
            }
        }
        return $flag;
    }

    function form_3_question_delete($id){
        $this->tables = array('form_3_question');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return TRUE;
        }
        return FALSE;
    }

    function form_4_fields() {
        $fields = array();
        $this->sql_query = "SELECT f.id, g.id AS group_id, g.gorder, g.name AS group_name, g.caption AS group_caption, f.forder, f.name, f.type FROM `form_4_fields` f RIGHT JOIN form_4_field_groups g ON f.group_id = g.id ORDER BY g.gorder, f.forder";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach($datas AS $data) {
                $group_id = $data['group_id'];
                $field_id = $data['id'];
                $fields[$group_id]['name'] = $data['group_name'];
                $fields[$group_id]['caption'] = $data['group_caption'];
                $fields[$group_id]['order'] = $data['gorder'];
                $fields[$group_id]['fields'][] = array(
                    'id' => $field_id,
                    'name' => $data['name'],
                    'order' => $data['forder'],
                    'type' => $data['type']
                );
            }
        }
        return $fields;
    }

    function form_4_field_update($id, $value) {
        $this->tables = array('form_4_fields');
        $this->fields = array('name');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_form_4_by_id($id){
        $form_data = array();
        if($_SESSION['company_sort_by'] == 1) {
            $this->sql_query = "SELECT f.id, f.customer, f.fullname, f.social_security, f.address, f.email, f.phone, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, c.email AS customer_email, c.phone AS customer_phone, f.created_date, f.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f.check_r, f.check_s, f.onskemal_angaende_kontakter, f.ny_uppdragsgivare, f.uppfoljning, f.forandring, f.schemalagd, f.samtycker_till_genomforandeplan, f.datum_for_uppfoljning_bokad, f.datum_for_uppfoljning_genomford, f.datum_for_ordinarie_bokad, f.datum_for_ordinarie_genomford, f.datum_for_upprattandet_av_gp, f.deltagare_vid_upprattandet_av_gp_name1, f.deltagare_vid_upprattandet_av_gp_roll1, f.deltagare_vid_upprattandet_av_gp_name2, f.deltagare_vid_upprattandet_av_gp_roll2, f.deltagare_vid_upprattandet_av_gp_name3, f.deltagare_vid_upprattandet_av_gp_roll3, f.deltagare_vid_upprattandet_av_gp_name4, f.deltagare_vid_upprattandet_av_gp_roll4, f.deltagare_vid_upprattandet_av_gp_name5, f.deltagare_vid_upprattandet_av_gp_roll5, f.dagens_datum_1, f.dagens_datum_2, f.befattning_roll_1, f.befattning_roll_2, f.namnfortydligande_1, f.namnfortydligande_2 FROM form_4 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username WHERE f.id = $id";
        } else {
            $this->sql_query = "SELECT f.id, f.customer, f.fullname, f.social_security, f.address, f.email, f.phone, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, c.email AS customer_email, c.phone AS customer_phone, f.created_date, f.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f.check_r, f.check_s, f.onskemal_angaende_kontakter, f.ny_uppdragsgivare, f.uppfoljning, f.forandring, f.schemalagd, f.samtycker_till_genomforandeplan, f.datum_for_uppfoljning_bokad, f.datum_for_uppfoljning_genomford, f.datum_for_ordinarie_bokad, f.datum_for_ordinarie_genomford, f.datum_for_upprattandet_av_gp, f.deltagare_vid_upprattandet_av_gp_name1, f.deltagare_vid_upprattandet_av_gp_roll1, f.deltagare_vid_upprattandet_av_gp_name2, f.deltagare_vid_upprattandet_av_gp_roll2, f.deltagare_vid_upprattandet_av_gp_name3, f.deltagare_vid_upprattandet_av_gp_roll3, f.deltagare_vid_upprattandet_av_gp_name4, f.deltagare_vid_upprattandet_av_gp_roll4, f.deltagare_vid_upprattandet_av_gp_name5, f.deltagare_vid_upprattandet_av_gp_roll5, f.dagens_datum_1, f.dagens_datum_2, f.befattning_roll_1, f.befattning_roll_2, f.namnfortydligande_1, f.namnfortydligande_2  FROM form_4 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username WHERE f.id = $id";
        }
        $data = $this->query_fetch();
        if(!empty($data)) {
            $answer_datas = $this->get_form_4_answers_by_id($id);
            $form_data = $data[0];
            $form_data['answers'] = $answer_datas;
        }
        return $form_data;
    }

    function get_form_4_answers_by_id($id){
        $answers = array();
        $this->sql_query = "SELECT id, field_id, answer FROM `form_4_answers` WHERE id = $id";
        $datas = $this->query_fetch();
        foreach($datas as $data) {
            $answers[$data['field_id']] = $data['answer'];
        }
        return $answers;
    }

    function get_form_4_customer($customer){

        $this->tables = array('form_4');
        $this->fields = array('id', 'customer','created_date','created_by', 'check_r', 'check_s');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_4_insert($data){

        $this->tables = array('form_4');
        $this->fields = array('customer','created_by', 'check_r', 'check_s', 'fullname', 'social_security', 'address', 'email', 'phone', 'onskemal_angaende_kontakter', 'ny_uppdragsgivare', 'uppfoljning', 'forandring', 'schemalagd', 'samtycker_till_genomforandeplan', 'datum_for_uppfoljning_bokad', 'datum_for_uppfoljning_genomford', 'datum_for_ordinarie_bokad', 'datum_for_ordinarie_genomford', 'datum_for_upprattandet_av_gp', 'deltagare_vid_upprattandet_av_gp_name1', 'deltagare_vid_upprattandet_av_gp_roll1', 'deltagare_vid_upprattandet_av_gp_name2', 'deltagare_vid_upprattandet_av_gp_roll2', 'deltagare_vid_upprattandet_av_gp_name3', 'deltagare_vid_upprattandet_av_gp_roll3', 'deltagare_vid_upprattandet_av_gp_name4', 'deltagare_vid_upprattandet_av_gp_roll4', 'deltagare_vid_upprattandet_av_gp_name5', 'deltagare_vid_upprattandet_av_gp_roll5', 'dagens_datum_1' , 'dagens_datum_2', 'befattning_roll_1', 'befattning_roll_2', 'namnfortydligande_1', 'namnfortydligande_2');
        $this->field_values = array($data['customer'], $data['created_by'], $data['check_r'], $data['check_s'], $data['fullname'], $data['social_security'], $data['address'], $data['email'], $data['phone'], $data['onskemal_angaende_kontakter'], $data['ny_uppdragsgivare'], $data['uppfoljning'], $data['forandring'], $data['schemalagd'], $data['samtycker_till_genomforandeplan'], $data['datum_for_uppfoljning_bokad'], $data['datum_for_uppfoljning_genomford'], $data['datum_for_ordinarie_bokad'], $data['datum_for_ordinarie_genomford'], $data['datum_for_upprattandet_av_gp'], $data['deltagare_vid_upprattandet_av_gp_name1'], $data['deltagare_vid_upprattandet_av_gp_roll1'], $data['deltagare_vid_upprattandet_av_gp_name2'], $data['deltagare_vid_upprattandet_av_gp_roll2'], $data['deltagare_vid_upprattandet_av_gp_name3'], $data['deltagare_vid_upprattandet_av_gp_roll3'], $data['deltagare_vid_upprattandet_av_gp_name4'], $data['deltagare_vid_upprattandet_av_gp_roll4'], $data['deltagare_vid_upprattandet_av_gp_name5'], $data['deltagare_vid_upprattandet_av_gp_roll5'], $data['dagens_datum_1'], $data['dagens_datum_2'], $data['befattning_roll_1'], $data['befattning_roll_2'], $data['namnfortydligande_1'], $data['namnfortydligande_2']);
        if($this->query_insert()){
            $answer_id = $this->get_id();
            $answers_data = array();
            foreach($data['fields'] as $field) {
                $answers_data[] = array($answer_id, $field['field_id'], $field['answer']);
            }
            //echo '<pre>' . print_r($answers_data, 1) . '</pre>'; 
            if(!empty($answers_data)) {
                $this->tables = array('form_4_answers');
                $this->fields = array('id','field_id','answer');
                $this->field_values = $answers_data;
                $this->query_insert();
                //echo '<pre>' . print_r($this->query_error_details, 1) . '</pre>'; exit();
                return $answer_id;
            }
        } else {
            return FALSE;
        }
    }

    function form_4_update($id, $data){
        
        $this->tables = array('form_4');
        $this->fields = array('check_r', 'check_s', 'fullname', 'social_security', 'address', 'email', 'phone', 'onskemal_angaende_kontakter', 'ny_uppdragsgivare', 'uppfoljning', 'forandring', 'schemalagd', 'samtycker_till_genomforandeplan', 'datum_for_uppfoljning_bokad', 'datum_for_uppfoljning_genomford', 'datum_for_ordinarie_bokad', 'datum_for_ordinarie_genomford', 'datum_for_upprattandet_av_gp', 'deltagare_vid_upprattandet_av_gp_name1', 'deltagare_vid_upprattandet_av_gp_roll1', 'deltagare_vid_upprattandet_av_gp_name2', 'deltagare_vid_upprattandet_av_gp_roll2', 'deltagare_vid_upprattandet_av_gp_name3', 'deltagare_vid_upprattandet_av_gp_roll3', 'deltagare_vid_upprattandet_av_gp_name4', 'deltagare_vid_upprattandet_av_gp_roll4', 'deltagare_vid_upprattandet_av_gp_name5', 'deltagare_vid_upprattandet_av_gp_roll5', 'dagens_datum_1' , 'dagens_datum_2', 'befattning_roll_1', 'befattning_roll_2', 'namnfortydligande_1', 'namnfortydligande_2');
        $this->field_values = array($data['check_r'], $data['check_s'], $data['fullname'], $data['social_security'], $data['address'], $data['email'], $data['phone'], $data['onskemal_angaende_kontakter'], $data['ny_uppdragsgivare'], $data['uppfoljning'], $data['forandring'], $data['schemalagd'], $data['samtycker_till_genomforandeplan'], $data['datum_for_uppfoljning_bokad'], $data['datum_for_uppfoljning_genomford'], $data['datum_for_ordinarie_bokad'], $data['datum_for_ordinarie_genomford'], $data['datum_for_upprattandet_av_gp'], $data['deltagare_vid_upprattandet_av_gp_name1'], $data['deltagare_vid_upprattandet_av_gp_roll1'], $data['deltagare_vid_upprattandet_av_gp_name2'], $data['deltagare_vid_upprattandet_av_gp_roll2'], $data['deltagare_vid_upprattandet_av_gp_name3'], $data['deltagare_vid_upprattandet_av_gp_roll3'], $data['deltagare_vid_upprattandet_av_gp_name4'], $data['deltagare_vid_upprattandet_av_gp_roll4'], $data['deltagare_vid_upprattandet_av_gp_name5'], $data['deltagare_vid_upprattandet_av_gp_roll5'], $data['dagens_datum_1'], $data['dagens_datum_2'], $data['befattning_roll_1'], $data['befattning_roll_2'], $data['namnfortydligande_1'], $data['namnfortydligande_2']);
        //echo '<pre>' . print_r($this->field_values,1) . '</pre>';exit();
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            $this->tables = array('form_4_answers');
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            if ($this->query_delete()) {
                $answers_data = array();
                foreach($data['fields'] as $field) {
                    $answers_data[] = array($id, $field['field_id'], $field['answer']);
                }
                if(!empty($answers_data)) {
                    $this->tables = array('form_4_answers');
                    $this->fields = array('id','field_id','answer');
                    $this->field_values = $answers_data;
                    $this->query_insert();
                    return $id;
                }
            }
        } else {
            return FALSE;
        }
    }

    function get_form_5(){

        $this->tables = array('form_5');
        $this->fields = array('id','customer','created_date','created_by', 'deviation_date', 'deviation_time', 'error_from', 'error_to', 'where_did_deviation', 'main_diagnosis', 'relatives_informed', 'good_man_informed');
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_5_fields() {
        $fields = array();
        $this->sql_query = "SELECT f.id, g.id AS group_id, g.gorder, g.name AS group_name, g.caption AS group_caption, f.forder, f.name, f.options, f.other FROM `form_5_fields` f RIGHT JOIN form_5_field_groups g ON f.group_id = g.id ORDER BY g.gorder, f.forder";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach($datas AS $data) {
                $group_id = $data['group_id'];
                $field_id = $data['id'];
                $fields[$group_id]['name'] = $data['group_name'];
                $fields[$group_id]['caption'] = $data['group_caption'];
                $fields[$group_id]['order'] = $data['gorder'];
                $fields[$group_id]['fields'][] = array(
                    'id' => $field_id,
                    'name' => $data['name'],
                    'order' => $data['forder'],
                    'options' => ($data['options'] != '' ? explode('|', $data['options']): array()),
                    'other' => $data['other']
                );
            }
        }
        return $fields;
    }

    function form_5_field_options($field_id) {
        $options = array();
        $this->sql_query = "SELECT options FROM `form_5_fields` WHERE id=$field_id";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $data = $datas[0];
            $options = ($data['options'] != '' ? explode('|', $data['options']): array());
        }
        return $options;
    }

    function form_5_field_update($id, $value) {
        $this->tables = array('form_5_fields');
        $this->fields = array('name');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function form_5_field_option_update($id, $value) {
        $this->tables = array('form_5_fields');
        $this->fields = array('options');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_form_5_by_id($id){
        $form_data = array();
        if($_SESSION['company_sort_by'] == 1) {
            $this->sql_query = "SELECT f.id, f.customer, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f.created_date, f.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f.deviation_date, f.deviation_time, f.error_from, f.error_to, f.where_did_deviation, f.main_diagnosis, f.relatives_informed, f.good_man_informed, f.type_fall, f.type_hot_vald, f.type_lakemedel, f.type_mtp, f.type_utebliven_felaktig, f.vad_hande_och_varfor_hande_det, f.vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen, f.vad_blev_resultatet_av_ovanstaende_atgarder FROM form_5 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username WHERE f.id = $id";
        } else {
            $this->sql_query = "SELECT f.id, f.customer, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f.created_date, f.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f.deviation_date, f.deviation_time, f.error_from, f.error_to, f.where_did_deviation, f.main_diagnosis, f.relatives_informed, f.good_man_informed, f.type_fall, f.type_hot_vald, f.type_lakemedel, f.type_mtp, f.type_utebliven_felaktig, f.vad_hande_och_varfor_hande_det, f.vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen, f.vad_blev_resultatet_av_ovanstaende_atgarder FROM form_5 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username WHERE f.id = $id";
        }
        $data = $this->query_fetch();
        if(!empty($data)) {
            $answer_datas = $this->get_form_5_answers_by_id($id);
            $form_data = $data[0];
            $form_data['answers'] = $answer_datas;
        }
        return $form_data;
    }

    function get_form_5_answers_by_id($id){
        $answers = array();
        $this->sql_query = "SELECT id, field_id, answer FROM `form_5_answers` WHERE id = $id";
        $datas = $this->query_fetch();
        foreach($datas as $data) {
            $answers[$data['field_id']] = $data['answer'];
        }
        return $answers;
    }

    function get_form_5_customer($customer){

        $this->tables = array('form_5');
        $this->fields = array('id', 'customer','created_date','created_by', 'deviation_date', 'deviation_time', 'error_from', 'error_to', 'where_did_deviation', 'main_diagnosis', 'relatives_informed', 'good_man_informed');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_5_insert($data){

        $this->tables = array('form_5');
        $this->fields = array('customer','created_date','created_by', 'deviation_date', 'deviation_time', 'error_from', 'error_to', 'where_did_deviation', 'main_diagnosis', 'relatives_informed', 'good_man_informed', 'type_fall', 'type_hot_vald', 'type_lakemedel', 'type_mtp', 'type_utebliven_felaktig', 'vad_hande_och_varfor_hande_det', 'vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen', 'vad_blev_resultatet_av_ovanstaende_atgarder');
        $this->field_values = array($data['customer'],$data['created_date'],$data['created_by'], $data['deviation_date'], $data['deviation_time'], $data['error_from'], $data['error_to'], $data['where_did_deviation'], $data['main_diagnosis'], $data['relatives_informed'], $data['good_man_informed'], $data['type_fall'], $data['type_hot_vald'], $data['type_lakemedel'], $data['type_mtp'], $data['type_utebliven_felaktig'], $data['vad_hande_och_varfor_hande_det'], $data['vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen'], $data['vad_blev_resultatet_av_ovanstaende_atgarder']);
        if($this->query_insert()){
            $answer_id = $this->get_id();
            $answers_data = array();
            foreach($data['fields'] as $field) {
                $answers_data[] = array($answer_id, $field['field_id'], $field['answer']);
            }
            //echo '<pre>' . print_r($answers_data, 1) . '</pre>'; 
            if(!empty($answers_data)) {
                $this->tables = array('form_5_answers');
                $this->fields = array('id','field_id','answer');
                $this->field_values = $answers_data;
                $this->query_insert();
                return $answer_id;
            }
        } else {
            return FALSE;
        }
    }

    function form_5_update($id, $data){

        $this->tables = array('form_5');
        $this->fields = array('deviation_date', 'deviation_time', 'error_from', 'error_to', 'where_did_deviation', 'main_diagnosis', 'relatives_informed', 'good_man_informed', 'type_fall', 'type_hot_vald', 'type_lakemedel', 'type_mtp', 'type_utebliven_felaktig', 'vad_hande_och_varfor_hande_det', 'vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen', 'vad_blev_resultatet_av_ovanstaende_atgarder');
        $this->field_values = array($data['deviation_date'], $data['deviation_time'], $data['error_from'], $data['error_to'], $data['where_did_deviation'], $data['main_diagnosis'], $data['relatives_informed'], $data['good_man_informed'], $data['type_fall'], $data['type_hot_vald'], $data['type_lakemedel'], $data['type_mtp'], $data['type_utebliven_felaktig'], $data['vad_hande_och_varfor_hande_det'], $data['vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen'], $data['vad_blev_resultatet_av_ovanstaende_atgarder']);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            $this->tables = array('form_5_answers');
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            if ($this->query_delete()) {
                $answers_data = array();
                foreach($data['fields'] as $field) {
                    $answers_data[] = array($id, $field['field_id'], $field['answer']);
                }
                if(!empty($answers_data)) {
                    $this->tables = array('form_5_answers');
                    $this->fields = array('id','field_id','answer');
                    $this->field_values = $answers_data;
                    $this->query_insert();
                    return $id;
                }
            }
        } else {
            return FALSE;
        }
    }


    function get_form_6(){

        $this->tables = array('form_6');
        $this->fields = array('id','customer','created_date','created_by', 'ett_allvarligt_missforhallande', 'en_pataglig_risk_for_ett_allvarligt_missforhallande', 'avsandarens_diarienummer');
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_6_fields() {
        $fields = array();
        $this->sql_query = "SELECT id, type, forder, name, options, other FROM `form_6_fields` ORDER BY forder";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach($datas AS $data) {
                $field_id = $data['id'];
                $fields[$field_id] = array(
                    'id' => $field_id,
                    'type' => $data['type'],
                    'name' => $data['name'],
                    'order' => $data['forder'],
                    'options' => ($data['options'] != '' ? explode('|', $data['options']): array()),
                    'other' => $data['other']
                );
            }
        }
        return $fields;
    }

    function form_6_field_options($field_id) {
        $options = array();
        $this->sql_query = "SELECT options FROM `form_6_fields` WHERE id=$field_id";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            $data = $datas[0];
            $options = ($data['options'] != '' ? explode('|', $data['options']): array());
        }
        return $options;
    }

    function form_6_field_update($id, $value) {
        $this->tables = array('form_6_fields');
        $this->fields = array('name');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function form_6_field_option_update($id, $value) {
        $this->tables = array('form_6_fields');
        $this->fields = array('options');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_form_6_by_id($id){
        $form_data = array();
        if($_SESSION['company_sort_by'] == 1) {
            $this->sql_query = "SELECT f.id, f.customer, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f.created_date, f.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f.ett_allvarligt_missforhallande, f.en_pataglig_risk_for_ett_allvarligt_missforhallande, f.avsandarens_diarienummer FROM form_6 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username WHERE f.id = $id";
        } else {
            $this->sql_query = "SELECT f.id, f.customer, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.address AS customer_address, c.social_security AS customer_social_security, c.century AS customer_century, f.created_date, f.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f.ett_allvarligt_missforhallande, f.en_pataglig_risk_for_ett_allvarligt_missforhallande, f.avsandarens_diarienummer FROM form_6 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username WHERE f.id = $id";
        }
        $data = $this->query_fetch();
        if(!empty($data)) {
            $answer_datas = $this->get_form_6_answers_by_id($id);
            $form_data = $data[0];
            $form_data['answers'] = $answer_datas;
        }
        return $form_data;
    }

    function get_form_6_answers_by_id($id){
        $answers = array();
        $this->sql_query = "SELECT id, field_id, answer FROM `form_6_answers` WHERE id = $id";
        $datas = $this->query_fetch();
        foreach($datas as $data) {
            $answers[$data['field_id']] = $data['answer'];
        }
        return $answers;
    }

    function get_form_6_customer($customer){

        $this->tables = array('form_6');
        $this->fields = array('id', 'customer','created_date','created_by', 'ett_allvarligt_missforhallande', 'en_pataglig_risk_for_ett_allvarligt_missforhallande', 'avsandarens_diarienummer');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_6_insert($data){

        $this->tables = array('form_6');
        $this->fields = array('customer','created_date','created_by', 'ett_allvarligt_missforhallande', 'en_pataglig_risk_for_ett_allvarligt_missforhallande', 'avsandarens_diarienummer');
        $this->field_values = array($data['customer'],$data['created_date'],$data['created_by'], $data['ett_allvarligt_missforhallande'], $data['en_pataglig_risk_for_ett_allvarligt_missforhallande'], $data['avsandarens_diarienummer']);
        if($this->query_insert()){
            $answer_id = $this->get_id();
            $answers_data = array();
            foreach($data['fields'] as $field) {
                $answers_data[] = array($answer_id, $field['field_id'], $field['answer']);
            }
            //echo '<pre>' . print_r($answers_data, 1) . '</pre>'; 
            if(!empty($answers_data)) {
                $this->tables = array('form_6_answers');
                $this->fields = array('id','field_id','answer');
                $this->field_values = $answers_data;
                $this->query_insert();
                return $answer_id;
            }
        } else {
            return FALSE;
        }
    }

    function form_6_update($id, $data){

        $this->tables = array('form_6');
        $this->fields = array('ett_allvarligt_missforhallande', 'en_pataglig_risk_for_ett_allvarligt_missforhallande', 'avsandarens_diarienummer');
        $this->field_values = array($data['ett_allvarligt_missforhallande'], $data['en_pataglig_risk_for_ett_allvarligt_missforhallande'], $data['avsandarens_diarienummer']);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            $this->tables = array('form_6_answers');
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            if ($this->query_delete()) {
                $answers_data = array();
                foreach($data['fields'] as $field) {
                    $answers_data[] = array($id, $field['field_id'], $field['answer']);
                }
                if(!empty($answers_data)) {
                    $this->tables = array('form_6_answers');
                    $this->fields = array('id','field_id','answer');
                    $this->field_values = $answers_data;
                    $this->query_insert();
                    return $id;
                }
            }
        } else {
            return FALSE;
        }
    }

    function get_form_7(){

        $this->tables = array('form_7');
        $this->fields = array('id','customer','created_date','created_by', 'modified_by', 'utgava', 'r', 's', 'datum_for_delgivning', 'manad_och_ar_for_nasta_delgivning', 'narvarande_person_1', 'narvarande_person_roll_1', 'narvarande_person_2', 'narvarande_person_roll_2', 'narvarande_person_3', 'narvarande_person_roll_3');
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_7_fields() {
        $fields = array();
        $this->sql_query = "SELECT id, forder, name, other FROM `form_7_fields` ORDER BY forder";
        $datas = $this->query_fetch();
        if(!empty($datas)) {
            foreach($datas AS $data) {
                $field_id = $data['id'];
                $fields[$field_id] = array(
                    'id' => $field_id,
                    'name' => $data['name'],
                    'order' => $data['forder'],
                    'other' => $data['other']
                );
            }
        }
        return $fields;
    }


    function form_7_field_update($id, $value) {
        $this->tables = array('form_7_fields');
        $this->fields = array('name');
        $this->field_values = array($value);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_form_7_by_id($id){
        $form_data = array();
        if($_SESSION['company_sort_by'] == 1) {
            $this->sql_query = "SELECT f.id, f.customer, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, c.social_security AS customer_social_security, c.century AS customer_century, f.created_date, f.created_by, CONCAT(ce.first_name, ' ', ce.last_name) AS created_name, f.modified_by, CONCAT(me.first_name, ' ', me.last_name) AS modified_name, f.utgava, f.r, f.s, f.datum_for_delgivning, f.manad_och_ar_for_nasta_delgivning, f.narvarande_person_1, f.narvarande_person_roll_1, f.narvarande_person_2, f.narvarande_person_roll_2, f.narvarande_person_3, f.narvarande_person_roll_3 FROM form_7 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username INNER JOIN employee me ON f.modified_by = me.username WHERE f.id = $id";
        } else {
            $this->sql_query = "SELECT f.id, f.customer, CONCAT(c.last_name, ' ', c.first_name) AS customer_name, c.social_security AS customer_social_security, c.century AS customer_century, f.created_date, f.created_by, CONCAT(ce.last_name, ' ', ce.first_name) AS created_name, f.modified_by, CONCAT(me.first_name, ' ', me.last_name) AS modified_name, f.utgava, f.r, f.s, f.datum_for_delgivning, f.manad_och_ar_for_nasta_delgivning, f.narvarande_person_1, f.narvarande_person_roll_1, f.narvarande_person_2, f.narvarande_person_roll_2, f.narvarande_person_3, f.narvarande_person_roll_3 FROM form_7 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee ce ON f.created_by = ce.username INNER JOIN employee me ON f.modified_by = me.username WHERE f.id = $id";
        }
        $data = $this->query_fetch();
        if(!empty($data)) {
            $answer_datas = $this->get_form_7_answers_by_id($id);
            $form_data = $data[0];
            $form_data['answers'] = $answer_datas;
        }
        return $form_data;
    }

    function get_form_7_answers_by_id($id){
        $answers = array();
        $this->sql_query = "SELECT id, field_id, answer FROM `form_7_answers` WHERE id = $id";
        $datas = $this->query_fetch();
        foreach($datas as $data) {
            $answers[$data['field_id']] = $data['answer'];
        }
        return $answers;
    }

    function get_form_7_customer($customer){

        $this->tables = array('form_7');
        $this->fields = array('id', 'customer','created_date','created_by', 'modified_by', 'utgava', 'r', 's', 'datum_for_delgivning', 'manad_och_ar_for_nasta_delgivning', 'narvarande_person_1', 'narvarande_person_roll_1', 'narvarande_person_2', 'narvarande_person_roll_2', 'narvarande_person_3', 'narvarande_person_roll_3');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        return $this->query_fetch();
    }

    function form_7_insert($data){

        $this->tables = array('form_7');
        $this->fields = array('customer','created_date','created_by', 'modified_by', 'utgava', 'r', 's', 'datum_for_delgivning', 'manad_och_ar_for_nasta_delgivning', 'narvarande_person_1', 'narvarande_person_roll_1', 'narvarande_person_2', 'narvarande_person_roll_2', 'narvarande_person_3', 'narvarande_person_roll_3');
        $this->field_values = array($data['customer'],$data['created_date'],$data['created_by'], $data['modified_by'], $data['utgava'], $data['r'], $data['s'], $data['datum_for_delgivning'], $data['manad_och_ar_for_nasta_delgivning'], $data['narvarande_person_1'], $data['narvarande_person_roll_1'], $data['narvarande_person_2'], $data['narvarande_person_roll_2'], $data['narvarande_person_3'], $data['narvarande_person_roll_3']);
        if($this->query_insert()){
            $answer_id = $this->get_id();
            $answers_data = array();
            foreach($data['fields'] as $field) {
                $answers_data[] = array($answer_id, $field['field_id'], $field['answer']);
            }
            //echo '<pre>' . print_r($answers_data, 1) . '</pre>'; 
            if(!empty($answers_data)) {
                $this->tables = array('form_7_answers');
                $this->fields = array('id','field_id','answer');
                $this->field_values = $answers_data;
                $this->query_insert();
                return $answer_id;
            }
        } else {
            return FALSE;
        }
    }

    function form_7_update($id, $data){

        $this->tables = array('form_7');
        $this->fields = array('modified_by', 'utgava', 'r', 's', 'datum_for_delgivning', 'manad_och_ar_for_nasta_delgivning', 'narvarande_person_1', 'narvarande_person_roll_1', 'narvarande_person_2', 'narvarande_person_roll_2', 'narvarande_person_3', 'narvarande_person_roll_3');
        $this->field_values = array($data['modified_by'], $data['utgava'], $data['r'], $data['s'], $data['datum_for_delgivning'], $data['manad_och_ar_for_nasta_delgivning'], $data['narvarande_person_1'], $data['narvarande_person_roll_1'], $data['narvarande_person_2'], $data['narvarande_person_roll_2'], $data['narvarande_person_3'], $data['narvarande_person_roll_3']);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if($this->query_update()) {
            $this->tables = array('form_7_answers');
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            if ($this->query_delete()) {
                $answers_data = array();
                foreach($data['fields'] as $field) {
                    $answers_data[] = array($id, $field['field_id'], $field['answer']);
                }
                if(!empty($answers_data)) {
                    $this->tables = array('form_7_answers');
                    $this->fields = array('id','field_id','answer');
                    $this->field_values = $answers_data;
                    $this->query_insert();
                    return $id;
                }
            }
        } else {
            return FALSE;
        }
    }

    function get_form1_notification_details($sort_name_by){
        if($sort_name_by == 1){
            $this->sql_query = "SELECT f.customer, CONCAT(c.first_name, ' ', c.last_name) as customer_name, f.review_next_date, CONCAT(e.first_name, ' ', e.last_name) as created_user, e.email as created_user_email FROM form_1 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee e ON e.username = f.created_by WHERE review_next_date = curdate() + interval 14 day";
        }else{
            $this->sql_query = "SELECT f.customer, CONCAT(c.last_name, ' ', c.first_name) as customer_name, f.review_next_date, CONCAT(e.last_name, ' ', e.first_name) as created_user, e.email as created_user_email FROM form_1 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee e ON e.username = f.created_by WHERE review_next_date = curdate() + interval 14 day";
        }
        return $this->query_fetch();
    }

    function get_form4_notification_details($sort_name_by){
        if($sort_name_by == 1){
            $this->sql_query = "SELECT f.customer, CONCAT(c.first_name, ' ', c.last_name) as customer_name, f.datum_for_uppfoljning_bokad, CONCAT(e.first_name, ' ', e.last_name) as created_user, e.email as created_user_email FROM form_4 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee e ON e.username = f.created_by WHERE datum_for_uppfoljning_bokad = curdate() + interval 14 day";
        }else{
            $this->sql_query = "SELECT f.customer, CONCAT(c.last_name, ' ', c.first_name) as customer_name, f.datum_for_uppfoljning_bokad, CONCAT(e.last_name, ' ', e.first_name) as created_user, e.email as created_user_email FROM form_4 f INNER JOIN customer c ON f.customer = c.username INNER JOIN employee e ON e.username = f.created_by WHERE datum_for_uppfoljning_bokad = curdate() + interval 14 day";
        }
        return $this->query_fetch();
    }
}
?>