<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contracts
 *
 * @author dona
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');

class contract extends db {

    //variable diclaration
    var $user = '';
    var $date_from = '';
    var $date_to = '';
    var $hours = '';
    var $customer_name = '';
    var $customer_social_secutrity = '';
    var $tmp_long_assistance_from = '';
    var $tmp_long_assistance_to = '';
    var $tmp_assistance_for = '';
    var $absence_from = '';
    var $absence_to = '';
    var $special_appointment = '';
    var $probationary_from = '';
    var $probationary_to = '';
    var $open_ended_appointment = '';
    var $prevailing_collective = '';
    var $fulltime = '';
    var $part_time = '';
    var $salary_month = '';
    var $salary_hour = '';
    var $incl_salary = '';
    var $excl_salary = '';
    var $incl_wages= '';
    var $act_salary= '';
    var $bank_account= '';
    var $leave_per_year= '';
    var $excl_holiday_pay= '';
    var $incl_salary_compensation= '';
    var $special_condition= '';
    var $notes= '';

    function __construct() {

        parent::__construct();
    }
    
    
	
	function date_difference($fdate,$ldate)
	{
		$diff = strtotime($ldate) - strtotime($fdate);
		return $diff;
	}

 function makeArray($datas = array()){
        
        $data_array = array();
        foreach ($datas as $data){
            
            $data_array[$data['id']] = $data['name'];
        }
        return $data_array;
    }
    function employee_contract_dates($employee){
        $this->tables = array('employee_contract');
        $this->fields = array('id','employee','date_from');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }
        else{
            return FALSE;
        }
    }
    
    function employee_contract_full_detail_update($id,$security){
        $this->tables = array('employee_contract');
        $this->fields = array('date_from','date_to','hour','customer_name','customer_social_secutrity','tmp_long_assistance_from','tmp_long_assistance_to',
            'tmp_assistance_for','absence_from','absence_to','special_appointment','probationary_from','probationary_to','open_ended_appointment',
            'prevailing_collective','fulltime','part_time','salary_month','salary_hour','incl_salary','excl_salary', 'incl_wages','act_salary',
            'bank_account','leave_per_year','excl_holiday_pay','incl_salary_compensation','special_condition',  'notes');
        $this->field_values = array($this->date_from,$this->date_to,$this->hours,$this->customer_name,$security,$this->tmp_long_assistance_from,$this->tmp_long_assistance_to,
            $this->tmp_assistance_for,$this->absence_from,$this->absence_to,$this->special_appointment,$this->probationary_from,$this->probationary_to,$this->open_ended_appointment,
            $this->prevailing_collective,$this->fulltime,$this->part_time,$this->salary_month,$this->salary_hour,$this->incl_salary,$this->excl_salary, $this->incl_wages,$this->act_salary,
            $this->bank_account,$this->leave_per_year,$this->excl_holiday_pay,$this->incl_salary_compensation,$this->special_condition,  $this->notes
);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $data = $this->query_update();
        if($data){
            return true;
        }
            else
                return false;
        
    }
    
      function employee_contract_add(){
          $today = date("Y-m-d H:i:s");  
        $this->tables = array('employee_contract');
        $this->fields = array('employee','date_from','date_to','customer_name','customer_social_secutrity','tmp_long_assistance_from','tmp_long_assistance_to',
            'tmp_assistance_for','absence_from','absence_to','special_appointment','probationary_from','probationary_to','open_ended_appointment',
            'prevailing_collective','fulltime','part_time','salary_month','salary_hour','incl_salary','excl_salary', 'incl_wages','act_salary',
            'bank_account','leave_per_year','excl_holiday_pay','incl_salary_compensation','special_condition',  'notes','alloc_employee','alloc_date');
        $this->field_values = array($this->user,$this->date_from,$this->date_to,$this->customer_name,$this->customer_social_secutrity,$this->tmp_long_assistance_from,$this->tmp_long_assistance_to,
            $this->tmp_assistance_for,$this->absence_from,$this->absence_to,$this->special_appointment,$this->probationary_from,$this->probationary_to,$this->open_ended_appointment,
            $this->prevailing_collective,$this->fulltime,$this->part_time,$this->salary_month,$this->salary_hour,$this->incl_salary,$this->excl_salary, $this->incl_wages,$this->act_salary,
            $this->bank_account,$this->leave_per_year,$this->excl_holiday_pay,$this->incl_salary_compensation,$this->special_condition,  $this->notes,$_SESSION['user_id'],$today
);
      
        $data = $this->query_insert();
        if($data){
            return true;
        }
            else
                return false;
    }
    
    function employee_contract_detail($id){
        $this->tables = array('employee_contract');
        $this->fields = array('employee','date_from','date_to','hour','customer_name','customer_social_secutrity','tmp_long_assistance_from','tmp_long_assistance_to',
            'tmp_assistance_for','absence_from','absence_to','special_appointment','probationary_from','probationary_to','open_ended_appointment',
            'prevailing_collective','fulltime','part_time','salary_month','salary_hour','incl_salary','excl_salary', 'incl_wages','act_salary',
            'bank_account','leave_per_year','excl_holiday_pay','incl_salary_compensation','special_condition',  'notes');
         $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0];
        }
            else
                return false;
        
    }
    
   
    
    function get_working_days($from_date, $to_date) {
        echo "hai";
        echo $from_date."   ".$to_date;
        if ($from_date > $to_date) {
            $from_date ^= $to_date ^= $from_date ^= $to_date;
        }


        // Find the ISO-8601 day of the week for the two dates.
        $sd = date("N", strtotime($from_date));
        $ed = date("N", strtotime($to_date));

        // Find the number of weeks between the dates.
        $w = floor((strtotime($to_date) - strtotime($from_date)) / (86400 * 7));    # Divide the difference in the two times by seven days to get the number of weeks.
        if ($ed >= $sd) {
            $w--;
        }        # If the end date falls on the same day of the week or a later day of the week than the start date, subtract a week.
        // Calculate net working days.
        $nwd = max(6 - $sd, 0);     # If the start day is Saturday or Sunday, add zero, otherewise add six minus the weekday number.
        $nwd += min($ed, 5);    # If the end day is Saturday or Sunday, add five, otherwise add the weekday number.
        $nwd += $w * 5;        # Add five days for each week in between.
        // Iterate through the array of holidays. For each holiday between the start and end dates that isn't a Saturday or a Sunday, remove one day.
        /* foreach ($holidays as $h) {
         $h = strtotime($h);
        if ($h > $from_date && $h < $e && date("N", $h) < 6)
        $nwd--;
        } */

        return $nwd;
    }
    
    function get_customers(){
        $this->tables = array('customer');
        $this->fields = array('username','first_name','last_name','social_security');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function remove_sign_contract($ids){
        $date = "";
        $this->tables = array('employee_contract');
        $this->fields = array('sign_date');
        $this->field_values = array($date);
        $this->conditions = array("id = ?");
        $this->condition_values = array($ids);
        if($this->query_update()){
            return true;
        }else{
            return false;
        }
    }
    function get_password($username){
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('password');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data[0]['password'];
        }else{
            return false;
        }
    }
        
        
}

?>