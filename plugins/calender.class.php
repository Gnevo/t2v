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
require_once ('class/db.php');

class calender extends db {

    function __construct() {

        parent::__construct();
    }

    function calender_month_weeks($cal_year, $cal_month) {
        //echo $cal_year."-".$cal_month;
        $start_tstamp = mktime(0, 0, 0, $cal_month, 1, $cal_year);
        $day_of_week = date('N', $start_tstamp)-1;
        $start_week_tstamp = $start_tstamp - ($day_of_week * 24 * 60 * 60);
        //echo date('Y-m-d', $start_week_tstamp);
        $start_week = (int) date('W', $start_week_tstamp);
        $start_year = (int) date('Y', $start_week_tstamp);
        $days_in_month = $this->days_in_month($cal_month, $cal_year);
        $end_tstamp = $start_tstamp + ($days_in_month * 24 * 60 * 60);
        $day_of_week = (7 - date('N', $end_tstamp));
        $end_week_tstamp = $end_tstamp + ($day_of_week * 24 * 60 * 60);
        $end_week = (int) date('W', $end_week_tstamp);
        $end_year = (int) date('Y', $end_week_tstamp);
        $week_count = $end_week - $start_week + 1;
        if ($start_week > $end_week) {
            if ($cal_month == 1 || $cal_month == '01') {
                $year_end_week = (int) date('W', $start_week_tstamp);
                if ($year_end_week == 1) {
                    $year_end_week = 53;
                }
            } else if ($cal_month == 12) {

                $year_end_week = (int) date('W', $end_tstamp);
                if ($year_end_week == 1) {
                    $year_end_week = 53;
                }
            }
            if ($year_end_week == $start_week) {

                $week_count = 1 + $end_week;
            } else {

                $week_count = ($year_end_week - $start_week) + $end_week;
            }
        }
        $weeks = array();
        if ($cal_month == 1 || $cal_month == '01') {

            $date_tstamp = $start_week_tstamp;
        } else if ($cal_month == 12) {

            $date_tstamp = $start_week_tstamp + (6 * 24 * 60 * 60);
        } else {

            $date_tstamp = $start_week_tstamp;
        }
        //echo date('Y-m-d', $date_tstamp);
        for ($i = 0; $i < $week_count; $i++) {
            
            $loop_cur_week = date('W', $date_tstamp);
            $loop_cur_year = date('o', $date_tstamp);            
            $loop_cur_month = date('m', $date_tstamp);
            if($loop_cur_week == 1 && $loop_cur_month ==12){
                $loop_cur_year = date('Y', $date_tstamp);
            }
            $weeks[] = array('week' => $loop_cur_week, 'year' => $loop_cur_year, 'month' => $loop_cur_month);
            $date_tstamp = $date_tstamp + (7 * 24 * 60 * 60);
            
        }
        return $weeks;
    }

    function calender_weeks_of_a_month($cal_year, $cal_month) {
        //deprecated - due to incompleteness
        
        $month_start_date = date('Y-m-d', strtotime($cal_year.'-'.$cal_month.'-01'));
        $month_end_date = date('Y-m-t', strtotime($cal_year.'-'.$cal_month.'-01'));
        $month_start_week = date('W', strtotime($month_start_date));
        $month_end_week = date('W', strtotime($month_end_date));
        
        $weeks = array();
        if ($month_start_week <= $month_end_week) {
            for ($i = $month_start_week; $i <= $month_end_week; $i++) {
                $loop_cur_year = date('o', strtotime($month_end_date));
                $loop_cur_month = date('m', $date_tstamp);
                $weeks[] = array('week' => $i, 'year' => $cal_year);
                $date_tstamp = $date_tstamp + (7 * 24 * 60 * 60);

            }
        }
        
        return $weeks;
    }

    function calender_month($cal_year, $cal_month, $cal_day) {

        $all_weeks = $this->calender_month_weeks($cal_year, $cal_month);
        $start_week = $all_weeks[0]['year'] . '|' . $all_weeks[0]['week'];
        $end_week = $all_weeks[(count($all_weeks) - 1)]['year'] . '|' . $all_weeks[(count($all_weeks) - 1)]['week'];
        $vecation_dates = $this->calender_vecation_block($start_week, $end_week);
//        echo "<pre>".print_r($vecation_dates, 1)."</pre>";
        //print_r($vecation_dates);
        $month_weeks = array();
        $j = 0;
        //echo "<pre>\n".print_r($all_weeks, 1)."</pre>";
        foreach ($all_weeks as $all_week) {

            $week_days = array();
            for ($i = 1; $i <= 7; $i++) {
                if($all_week['week'] == 1 && $all_week['month'] == 12){
                    
                    $loop_tstamp = strtotime(($all_week['year'] + 1) . 'W' . $all_week['week'] . $i);
                } else {
                    $loop_tstamp = strtotime($all_week['year'] . 'W' . $all_week['week'] . $i);
                }
                $full_date = date("Y-m-d", $loop_tstamp);
                $day = date('d', $loop_tstamp);
                //echo  date('Y-m-d', $loop_tstamp)."-".$all_week['week']."-".$all_week['year']."-".$i."<br>";
                $loop_month = date('m', $loop_tstamp);
                $type = 'normal';
                if ($loop_month != $cal_month)
                    $type = 'old';
                else if ($day == $cal_day)
                    $type = 'current';
                else if (isset($vecation_dates[$j]['date']) && $vecation_dates[$j]['date'] == $full_date) {
                    if(isset($vecation_dates[$j]['type']) && $vecation_dates[$j]['type'] == 1)
                        $type = 'redday';
                    else if(isset($vecation_dates[$j]['type']) && $vecation_dates[$j]['type'] == 2)
                        $type = 'bigday';
                    $j++;
                }
                else if(date('N', $loop_tstamp) == 7)
                    $type = 'holiday';

                $week_days[] = array('day' => $day, 'type' => $type, 'date' => $full_date, 'week'=> date("W", $loop_tstamp), 'year'=> date("o", $loop_tstamp));
            }
            //$month_weeks[] = array('week' => $all_week, 'days' => $week_days);
            $month_weeks[] = array('week' => array('week' => $all_week['week'],'year' => date("o", $loop_tstamp), 'month' => $all_week['month']), 'days' => $week_days);
        }
        //exit();
        return $month_weeks;
    }

    function calender_vecation_block($start_week, $end_week) {

        $year_week = explode('|', $start_week);
        $start_date_tstamp = strtotime($year_week[0] . 'W' . $year_week[1] . '1');
        $current_month = (int) date('m', strtotime($year_week[0] . 'W' . $year_week[1] . '1+1 week'));
        $start_month_date = date('Y-m-d', $start_date_tstamp);
        $start_date_year = date('Y', $start_date_tstamp);
        $start_date_month = date('m', $start_date_tstamp);
        
        $year_week = explode('|', $end_week);
        $end_date_tstamp = strtotime($year_week[0] . 'W' . $year_week[1] . '7');
        $end_month_date = date('Y-m-d', $end_date_tstamp);
        $end_date_year = date('Y', $end_date_tstamp);
        $end_date_month = date('m', $end_date_tstamp);

        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'effect_from', 'effect_to', 'date_from', 'date_to');
        $this->conditions = array('AND', 'effect_from <= ' . $start_date_year, array('OR', 'effect_to >= ' . $end_date_year, 'ISNULL(effect_to)'), array('OR', array('BETWEEN', 'CAST(CONCAT(\'' . $start_date_year . '-\', date_from) AS DATE)', '\'' . $start_month_date . '\'', '\'' . $end_month_date . '\''), array('BETWEEN', 'CAST(CONCAT(\'' . $end_date_year . '-\', date_to) AS DATE)', '\'' . $start_month_date . '\'', '\'' . $end_month_date . '\'')));
        $this->order_by = array('CAST(CONCAT(\'' . $start_date_year . '-\', date_from) AS DATE)');
        $this->query_generate();
//        echo $this->sql_query;
        $vecation_datas = $this->query_fetch();
        $start_month = (int) $start_date_month;
        $day_count = ($end_date_tstamp - $start_date_tstamp) / (24 * 60 * 60) + 1;
        $loop_tstamp = $start_date_tstamp;

        $vecation_dates = array();
        foreach ($vecation_datas as $vecation_data) {
            
            $loop_year_from =  $loop_year_to = $start_date_year;
            //echo $current_month;
            $loop_month_from = (int) substr($vecation_data['date_from'], 0, 2);
            $loop_month_to = (int) substr($vecation_data['date_to'], 0, 2);

            if ($current_month < $loop_month_from) {
                
                if ($loop_month_from < $loop_month_to) {
                    $loop_year_from++;
                }
                $vecation_from_date = $loop_year_from . '-' . $vecation_data['date_from'];
            } else {
                
                if ($current_month > $loop_month_from) {
                    $loop_year_from++;
                }
                $vecation_from_date = $loop_year_from . '-' . $vecation_data['date_from'];
            }
            if ($current_month > $loop_month_to) {
                
                if ($loop_month_from > $loop_month_to) {
                    $loop_year_to++;
                }
                $vecation_to_date = $loop_year_to . '-' . $vecation_data['date_to'];
            } else {
                
                if ($current_month < $loop_month_from) {
                    $loop_year_to++;
                }
                $vecation_to_date = $loop_year_to . '-' . $vecation_data['date_to'];
            }

            $block_master_types = $this->leave_block_types($vecation_data['id']);
            
            $vecation_from_tstamp = strtotime($vecation_from_date);
            $vecation_to_tstamp = strtotime($vecation_to_date);
            $i = 1;
            $j = 0;
            for ($current_date_ts = $vecation_from_tstamp; $current_date_ts <= $vecation_to_tstamp; $current_date_ts += (60 * 60 * 24)) {
                
                if($block_master_types[$j]['day'] == $i){
                    
                    $type = $block_master_types[$j]['type'];
                    $j++;
                }
                $vecation_dates[] = array('date' => date('Y-m-d', $current_date_ts), 'type' => $type);
                $i++;
            }
        }
        //print_r($vecation_dates);
        return $vecation_dates;
    }
    
    function leave_block_types($block_master_id) {
        
        $this->tables = array('holiday_block');
        $this->fields = array('day', 'type');
        $this->conditions = array('block_master_id = ' . $block_master_id);
        $this->order_by = array('day');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }
    
    function days_in_month($cal_month, $cal_year) {

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $cal_month, $cal_year);
        return $days_in_month;
    }

    function get_months() {

        global $month;
        return $month;
    }

    function get_weeks() {

        global $week;
        return $week;
    }

}

?>