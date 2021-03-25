<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of date
 *
 * @author dona
 */
require_once('configs/config.inc.php');

class datecalc {
    
    function __construct() {
        
    }
    
    function get_week_no($date) {
        
        $week_no = date('W', strtotime($date));
        $year = date('Y', strtotime($date));
        $week = array('week' => $week_no, 'year' => $year);
        return $week;
    }
    
    function get_weeks ($year_week, $total, $position) {
        
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $before = $position - 1;
        
        $cur_date_tstamp = strtotime($year . 'W' . $week_no . '1');
        $new_date_tstamp = strtotime($year . 'W' . $week_no . '4' .' -' . $before . ' week');
        $week_numbers = array();
        for($i = 1; $i <= $total; $i++){
            
            
            $week_count = date('W', $new_date_tstamp);
            $week_year = date('Y', $new_date_tstamp);
            $week_mon_date = date('Y-m-d', $new_date_tstamp);
            $week_value = $week_year . '|' . $week_count;
            $selected = 0;
            if($i == $position) {
                $selected = 1;
            }
            $week_days = array();
            for($day=1; $day<=7; $day++)
            {
                $temp_date = strtotime($week_year."W".$week_count.$day);
                $week_days[] = array('date'=> date('Y-m-d', $temp_date), 'day' => strtolower(date('D', $temp_date)), 'month' => substr(strtolower(date('F', $temp_date)),0,3), 'day_num' => strtolower(date('d', $temp_date)),);
            }
            $week_numbers[] = array('id' => $week_value, 'value' => 'V' . $week_count, 'date' => $week_mon_date, 'selected' => $selected, 'week_days' => $week_days);
            $new_date_tstamp += (7 * 24 * 60 * 60);
			//$new_date_tstamp = strtotime($week_year . 'W' . $week_count . ' +1 week');
        }
        return$week_numbers;
    }
	
	function get_weeks_moreyears ($year_week, $total, $position) {
      		
        $week_data = explode('|', $year_week);
		$week_data_cnt = count($week_data);
		
		if($week_data_cnt > 2)
		{
			$week_no = $week_data[$week_data_cnt-1];
			array_pop($week_data);
			$YearArr = $week_data;
		}
		else
		{
			$week_no = $week_data[1];
			$YearArr[] = $week_data[0];
		}
				
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_no);
        $before = $position - 1;
        
        $cur_date_tstamp = strtotime($year . 'W' . $week_no . '1');
        $new_date_tstamp = strtotime($year . 'W' . $week_no . ' -' . $before . ' week');
        $week_numbers = array();
		$flag = 0;
        for($i = 1; $i <= $total; $i++){
            
            $week_count = date('W', $new_date_tstamp);
            $week_year = date('Y', $new_date_tstamp);
            $week_mon_date = date('Y-m-d', $new_date_tstamp);
            $week_value = $week_year . '|' . $week_count;
            $selected = 0;
            if($i == $position) {
                $selected = 1;
            }
			
            $week_numbers[] = array('id' => $week_value, 'value' => 'V' . $week_count, 'date' => $week_mon_date, 'selected' => $selected);
			if($flag == 1)
			{
				$week_year = $week_year+1;	
				$flag = 0;
			}
			$new_date_tstamp = strtotime($week_year . 'W' . $week_count . ' +1 week');
			if(count($YearArr) > 1 && $week_count == 52)
			{
				$flag = 1;
			}	
        }
        return $week_numbers;
    }
	
	function get_weeks_moreyears_new ($year_week, $total, $position, $start_date) {
      		
        $week_data = explode('|', $year_week);
		$week_data_cnt = count($week_data);
		
		if($week_data_cnt > 2)
		{ 
			$week_no = $week_data[$week_data_cnt-1];
			array_pop($week_data);
			$YearArr = $week_data;
		}
		else
		{
			$week_no = $week_data[1];
			$YearArr[] = $week_data[0];
		}
				
       
		$year = $week_data[0];
        $week_no = sprintf("%02d", $week_no);
        $before = $position - 1;
        
        $cur_date_tstamp = strtotime($year . 'W' . $week_no . '1'); 
		
         if($start_date == $year.'-12-31'){
			$new_date_tstamp = strtotime($year.'-12-31');
		}else{
			$new_date_tstamp = strtotime($year . 'W' . $week_no . ' -' . $before . ' week');	
		}
		
        $week_numbers = array();
		$flag = 0; 
		//$new_date_tstamp = strtotime($start_date);
        for($i = 1; $i <= $total; $i++){
          
            $week_count = date('W', $new_date_tstamp);
            $week_year = date('Y', $new_date_tstamp);
            $week_mon_date = date('Y-m-d', $new_date_tstamp);
            $week_value = $week_year . '|' . $week_count;
            $selected = 0;
            if($i == $position) {
                $selected = 1;
            }
			
            $week_numbers[] = array('id' => $week_value, 'value' => 'V' . $week_count, 'date' => $week_mon_date, 'selected' => $selected);
			if($flag == 1)
			{
				$week_year = $week_year+1;	
				$flag = 0;
			}
			
			
			$new_date_tstamp =  strtotime('+1 week', strtotime($week_mon_date)); //strtotime($week_mon_date . ' +1 week'); 
			if(count($YearArr) > 1 && $week_count == 52)
			{
				$flag = 1;
			}	
        } 
        return $week_numbers;
    }

    
    function get_week_days($year_week, $date = "") {
        
        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        if($date == "") {
            
            $date = date('Y-m-d', strtotime($year . 'W' . $week_no . '1'));
        }
        $monday_tstamp = strtotime($year . 'W' . $week_no . '1');
        $week_days = array();
        $date_day = date('Y-m-d', $monday_tstamp);
        foreach ($week as $day) {
            
            $active = 0;
            if($date_day == $date) {
                
                $active = 1;
            }
            $week_days[] = array('id' => $day['id'], 'week' => $year_week, 'day' => $day['day'], 'label' => $day['label'], 'date'=> $date_day, 'active' => $active);
            $date_day = date('Y-m-d',  strtotime($date_day)+24*60*60);
        }
        return $week_days;
    }
    
    function get_days($from, $to) {
        
        $days = array();
        $date = $from;
        $days[] = $date;
        while($date < $to){
            
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            $days[] = $date;
        }
        return $days;
    }
    
    function get_five_weeks($year_week) {
        
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        
        $start_date_tstamp = strtotime($year . 'W' . $week_no . '4' . '-2 week');
        $weeks = array();
        for($i = 0; $i < 5; $i++) {
            
            $week_count = date('W', $start_date_tstamp);
            $week_year = date('Y', $start_date_tstamp);
            $weeks[] = array('week' => $week_count, 'year_week' => $week_year . '|' . $week_count);
            $start_date_tstamp = $start_date_tstamp + (7 * 24 * 60 * 60);
        }
        return $weeks;
    }
    
    //converting an entered time to sixty hours
    function time_to_sixty_old($time) {
        //$allowed = array(0, 5, 10 15, 30, 45);
        $time_sixty = "";
        if ($time >= 48 && $time <=4800) {
            $minute = intval($time % 100);
            $minute_sixty = intval($time % 100 * 60 / 100);
            if($minute >= 60){
                if($minute_sixty%5 ==0)
                    return ((intval($time / 100))%24 . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                else
                    return false;
            }else if($minute < 60){
                if($minute%5 ==0)
                    return ((intval($time / 100))%24 . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                else
                    return false;
            }
            else
                return false;
        }
        else if ($time < 48) {
            
            if (strstr($time, '.')) {
                
                $time_sixty = intval($time) % 24;
                $minute = intval(sprintf(($time - intval($time)) * 100));

                /*echo "<script>alert(\"".in_array($minute, $allowed)."\")</script>";*/
                $minute_sixty = intval($minute / 100 * 60);
                if($minute >= 60){
                    if($minute_sixty%5 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }else if($minute < 60){
                    if($minute%5 ==0)
                        return ($time_sixty . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }
            else if(substr($time, 0, 2) == '00'){
                
                $time_sixty = 0;
                $minute = intval($time);
                $minute_sixty = intval($minute / 100 * 60);
                if($minute >= 60){
                    if($minute_sixty%5 ==0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }else if($minute < 60){
                    if($minute%5 ==0)
                        return ($time_sixty . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
                
            }else{
                
                return ($time % 24);
            }
            
        }
        else
            return false;
    }
    function time_to_sixty($time) {
        $time_sixty = "";
        if ($time >= 48 && $time <=4800) {
            $minute = intval($time % 100);
            $minute_sixty = intval($time % 100 * 60 / 100);
            if($minute >= 60){
                if($minute_sixty%1 ==0)
                    return ((intval($time / 100))%24 . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                else
                    return false;
            }else if($minute < 60){
                if($minute%1 ==0)
                    return ((intval($time / 100))%24 . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                else
                    return false;
            }
            else
                return false;
        }
        else if ($time < 48) {
            
            if (strstr($time, '.')) {
                
                $time_sixty = intval($time) % 24;
                $minute = intval(sprintf(($time - intval($time)) * 100));

                /*echo "<script>alert(\"".in_array($minute, $allowed)."\")</script>";*/
                $minute_sixty = intval($minute / 100 * 60);
                if($minute >= 60){
                    if($minute_sixty%1 == 0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }else if($minute < 60){
                    if($minute%1 ==0)
                        return ($time_sixty . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
            }
            else if(substr($time, 0, 2) == '00'){
                
                $time_sixty = 0;
                $minute = intval($time);
                $minute_sixty = intval($minute / 100 * 60);
                if($minute >= 60){
                    if($minute_sixty%1 ==0)
                        return ($time_sixty . '.' . (str_pad($minute_sixty,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }else if($minute < 60){
                    if($minute%1 ==0)
                        return ($time_sixty . '.' . (str_pad($minute,2,'0',STR_PAD_LEFT)));
                    else
                        return false;
                }
                else
                    return false;
                
            }else{
                
                return ($time % 24);
            }
            
        }
        else
            return false;
    }
}

?>
