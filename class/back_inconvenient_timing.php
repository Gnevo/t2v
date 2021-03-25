<?php

/**
 * Description of Inconvenient Timing
 * @author Shamsudheen  <shamsu@arioninfotech.com>
 */
require_once ('class/db.php');
require_once('configs/config.inc.php');

class inconvenient_timing extends db {

    //variable declaration
    var $id = '';
    var $root_id = 0;
    var $name = '';
    var $effect_from = '';
    var $effect_to = '';
    var $time_from = '';
    var $time_to = '';
    var $type = '';
    var $days = '';
    var $group_id = 0;
    var $amount = 0.00;
    var $nature = '';

    function __construct() {

        parent::__construct();
    }

    function inconvenient_timing_list($id = NULL) {

        if ($id) {
            $name = $this->timing_name_get($id);
        }
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'root_id', 'group_id', 'name', 'type', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        if (!$id) {
            $this->conditions = array('AND', 'effect_to IS NULL', 'root_id = 0');
        } else {
            $this->conditions = array('name = ?');
            $this->condition_values = array($name);
        }

        $this->order_by = array('effect_from');
        $this->query_generate(); //echo $this->sql_query ."<br />";
        $datas = $this->query_fetch(); //print_r($data);
        if (!empty($datas)) {
            $inconvenient_timing = array();
            foreach ($datas as $data) {

                $id = $data['id'];
                $days = $data['days'];
                $days_str = $days;
                $day_time_array = array();
                if (substr($days_str, -1) == ',') {
                    $days_str = substr_replace($days_str, '', -1);
                }
                $days_array = explode(',', $days_str);
                foreach ($days_array as $day) {

                    $day_time_array[] = array('day' => $day, 'time' => $data['time_from'] . ' - ' . $data['time_to']);
                }
                $child_datas = $this->inconvenient_timing_child($id);
                if ($child_datas) {

                    foreach ($child_datas as $child_data) {

                        $days = $child_data['days'];
                        $days_str = $days;
                        if (substr($days_str, -1) == ',') {
                            $days_str = substr_replace($days_str, '', -1);
                        }
                        $days_array = explode(',', $days_str); //print_r($days_array);
                        foreach ($days_array as $day) {

                            $day_time_array[] = array('day' => $day, 'time' => $child_data['time_from'] . '-' . $child_data['time_to']);
                        }
                    }
                }
                //print_r($day_time_array);
                $inconvenient_timing[] = array('id' => $id, 'group_id' => $data['group_id'], 'name' => $data['name'], 'type' => $data['type'], 'effect_from' => $data['effect_from'], 'effect_to' => $data['effect_to'], 'day_time' => $day_time_array);
            }
            return $inconvenient_timing;
        } else {

            return array();
        }
    }

    function get_all_inconvenient_timing_list($id = NULL) {
        /**
         * Author: Shamsu
         * for: getting all inconvenients 
         * used in inconvenient_timing_list.php
         */
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'root_id', 'group_id', 'name', 'type', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount');
        if ($id == NULL) {
            $this->conditions = array('root_id = 0');
        } else {
            $this->conditions = array('OR', 'id = ?', 'root_id = 0');
            $this->condition_values = array($id);
        }

        $this->order_by = array('effect_from', 'effect_to');
        $this->query_generate(); //echo $this->sql_query ."<br />";
        $datas = $this->query_fetch(); //print_r($data);
        $inconvenient_timing = array();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $id = $data['id'];
                $days = $data['days'];
                $days_array = explode(',', $days);
                $day_time_array = array();
                foreach ($days_array as $day) {
                    if($day != '')
                        $day_time_array[] = array('day' => $day, 'time' => $data['time_from'] . ' - ' . $data['time_to']);
                }
                $child_datas = $this->inconvenient_timing_child($id);
                if ($child_datas) {
                    foreach ($child_datas as $child_data) {
                        $days = $child_data['days'];
                        $days_array = explode(',', $days);
                        foreach ($days_array as $day) {
                            if($day != '')
                                $day_time_array[] = array('day' => $day, 'time' => $child_data['time_from'] . ' - ' . $child_data['time_to']);
                        }
                    }
                }
                $inconvenient_timing[] = array('id' => $id, 
                    'name' => $data['name'], 
                    'type' => $data['type'], 
                    'amount' => $data['amount'], 
                    'effect_from' => $data['effect_from'], 
                    'effect_to' => $data['effect_to'], 
                    'day_time' => $day_time_array);
            }
        }
        return $inconvenient_timing;
    }

    function inconvenient_timing_delete($id) {

        //deleting chield rows
        $this->tables = array('inconvenient_timing');
        $this->conditions = array('root_id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            //deleting parent row
            $this->tables = array('inconvenient_timing');
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            if ($this->query_delete())
                return TRUE;
            else
                return FALSE;
        } else
            return FALSE;
    }

    function inconvenient_timing_child($root_id) {
        /**
         * Author: Shamsu
         * for: getting child inconvenient details using parent id
         */
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'root_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        $this->conditions = array('root_id = ?');
        $this->condition_values = array($root_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (!empty($datas)) 
            return $datas;
        else 
            return FALSE;
    }

    function timing_name_get($id) {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data)) {
            return $data[0]['name'];
        } else {
            return FALSE;
        }
    }

    function inconvenient_timing_add() {
        //updating effect to date
//        if ($this->timing_name_existence_check() && $this->root_id == 0) {
//            $this->inconvenient_timing_make_closed();
//        }
        
        //inserting new one
        $this->tables = array("inconvenient_timing");
        $this->fields = array('root_id', 'group_id','name', 'type', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount', 'nature');
        $this->field_values = array($this->root_id, $this->group_id, $this->name, $this->type, $this->effect_from, $this->effect_to, $this->time_from, $this->time_to, $this->days, $this->amount, $this->nature);

        if ($this->query_insert())
            return TRUE;
        else
            return FALSE;
    }

    function inconvenient_timing_update() {
        //inserting new one
        $this->tables = array("inconvenient_timing");
        $this->fields = array('root_id', 'group_id','name', 'type', 'effect_from', 'time_from', 'time_to', 'days', 'amount', 'nature');
        $this->field_values = array($this->root_id, $this->group_id, $this->name, $this->type, $this->effect_from, $this->time_from, $this->time_to, $this->days, $this->amount, $this->nature);
        $this->conditions = array("AND", "id = ?");
        $this->condition_values = array($this->id);
        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function inconvenient_colide($days, $leave_type, $type, $effect_from, $effect_to, $time_from, $time_to, $action = NULL, $id = NULL) {

        //checking the inconvinent timing coliding
        $flag = 0;
        $days_array = explode(',', $days);
//        echo "<pre>".print_r(func_get_args(), 1)."</pre>";

        $i = 0;
        if ($leave_type == 1) {     //contigeous
            $sorted_days = explode(',', $days);
            $array_count = count($sorted_days);
//            $startval = $sorted_days[0];
//            $endval = $sorted_days[$array_count];
            $old_array = $sorted_days;
            $new_array = array();
            for ($i = 0; $i < $array_count; $i++) {
                if ($i == 0) {
                    $element_val = $sorted_days[$i];
                    $new_array[] = $element_val;
                    array_shift($old_array);
                } else {
                    $element_val = $sorted_days[$i];
                    $next_element_val = $sorted_days[$i - 1];
                    if ($element_val == ($next_element_val + 1)) {
                        $new_array[] = $element_val;
                        array_shift($old_array);
                    } else
                        break;
                }
            }
            if (count($old_array) != count($sorted_days)) {
                $days_array = array_merge($old_array, $new_array);
            }
        }
//        echo "<pre>days_array".print_r($days_array, 1)."</pre>";
        $array_count = count($days_array);
        $i = 0;
        foreach ($days_array as $day) {
            $from_time = $time_from;
            $to_time = $time_to;
            if ($leave_type && $i != 0) { $from_time = 0; }
            if ($leave_type && $i != $array_count - 1) { $to_time = 24; }
            
            if (($leave_type == 0 && $to_time <= $from_time) || ($leave_type == 1 && $array_count == 1 && $to_time <= $from_time)) {
                $this->tables = array("inconvenient_timing");
                $this->fields = array("id");
                if($effect_to == NULL){
                    if($action == 'edit' && $id != NULL){
                        $this->conditions = array('AND', 'id != ?', 'root_id != ?',"days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($id, $id, $type, $effect_from, $effect_from, $from_time, 24, $from_time, 24, $from_time, 24);
                    } else if($action == 'clone' && $id != NULL) {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR',
                                array('AND', 'effect_to IS NULL', 'id != ?', 'root_id != ?'),
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $id, $id, $effect_from, $from_time, 24, $from_time, 24, $from_time, 24);
                    } else {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $effect_from, $from_time, 24, $from_time, 24, $from_time, 24);
                    }
                }else{
                    if($action == 'edit' && $id != NULL){
                        $this->conditions = array('AND', 'id != ?', 'root_id != ?',"days LIKE '%$day%'", 'type = ?', 'effect_from <= ?',
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?')
                                         ))
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($id, $id, $type, $effect_from, $effect_from, $effect_from, $effect_to, $effect_to, $from_time, 24, $from_time, 24, $from_time, 24);
                    } else if($action == 'clone' && $id != NULL) {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?',
                            array('OR', 
                                array('AND', 'effect_to IS NULL', 'id != ?', 'root_id != ?'),
                                array('AND',  'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'))
                                )
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $id, $id, $effect_from, $effect_from, $effect_to, $effect_to, $from_time, 24, $from_time, 24, $from_time, 24);
                    } else {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?',
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'))
                                )
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $effect_from, $effect_from, $effect_to, $effect_to, $from_time, 24, $from_time, 24, $from_time, 24);
                    }
                }
                $this->query_generate();
//                echo $this->sql_query;
//                echo "<pre>".print_r($this->condition_values, 1)."</pre>";
                $data = $this->query_fetch();
//                echo "<pre>".print_r($data, 1)."</pre>";
                if (!empty($data)) {
                    $flag = 1;
                    break;
                }
                if ($day == 7) { $day = 1; }
                else { $day++; }
                $this->tables = array("inconvenient_timing");
                $this->fields = array("id");
                if($effect_to == NULL){
                    if($action == 'edit' && $id != NULL){
                        $this->conditions = array('AND', 'id != ?', 'root_id != ?', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?',
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($id, $id, $type, $effect_from, $effect_from, 0, $to_time, 0, $to_time, 0, $to_time);
                    } else if($action == 'clone' && $id != NULL) {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR',
                                array('AND', 'effect_to IS NULL', 'id != ?', 'root_id != ?'),
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $id, $id, $effect_from, 0, $to_time, 0, $to_time, 0, $to_time);
                    } else {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $effect_from, 0, $to_time, 0, $to_time, 0, $to_time);
                    }
                }else{
                    if($action == 'edit' && $id != NULL){
                        $this->conditions = array('AND', 'id != ?', 'root_id != ?', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?')
                                         ))
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($id, $id, $type, $effect_from, $effect_from, $effect_from, $effect_to, $effect_to, 0, $to_time, 0, $to_time, 0, $to_time);
                    } else if($action == 'clone' && $id != NULL) {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                array('AND', 'effect_to IS NULL', 'id != ?', 'root_id != ?'),
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'))
                                )
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $id, $id, $effect_from, $effect_from, $effect_to, $effect_to, 0, $to_time, 0, $to_time, 0, $to_time);
                    } else {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'))
                                )
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $effect_from, $effect_from, $effect_to, $effect_to, 0, $to_time, 0, $to_time, 0, $to_time);
                    }
                }
                $this->query_generate(); 
                $data = $this->query_fetch();
                if (!empty($data)) {
                    $flag = 1;
                    break;
                }
            } 
            else {
                $this->tables = array("inconvenient_timing");
                $this->fields = array("id");
                if($effect_to == NULL){
                    if($action == 'edit' && $id != NULL){
                        $this->conditions = array('AND', 'id != ?', 'root_id != ?', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($id, $id, $type, $effect_from, $effect_from, $from_time, $to_time, $from_time, $to_time, $from_time, $to_time);
                    } else if($action == 'clone' && $id != NULL) {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                array('AND', 'effect_to IS NULL', 'id != ?', 'root_id != ?'),
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?')));
                        $this->condition_values = array($type, $effect_from, $id, $id, $effect_from, $from_time, $to_time, $from_time, $to_time, $from_time, $to_time);
                    } else {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?')));
                        $this->condition_values = array($type, $effect_from, $effect_from, $from_time, $to_time, $from_time, $to_time, $from_time, $to_time);
                    }
                }else{
                    if($action == 'edit' && $id != NULL){
                        $this->conditions = array('AND', 'id != ?', 'root_id != ?', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?')
                                         ))
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($id, $id, $type, $effect_from, $effect_from, $effect_from, $effect_to, $effect_to, $from_time, $to_time, $from_time, $to_time, $from_time, $to_time);
                    } else if($action == 'clone' && $id != NULL) {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                array('AND', 'effect_to IS NULL', 'id != ?', 'root_id != ?'),
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'))
                                )
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $id, $id, $effect_from, $effect_from, $effect_to, $effect_to, $from_time, $to_time, $from_time, $to_time, $from_time, $to_time);
                    } else {
                        $this->conditions = array('AND', "days LIKE '%$day%'", 'type = ?', 'effect_from <= ?', 
                            array('OR', 
                                'effect_to IS NULL', 
                                array('AND', 
                                    'effect_to IS NOT NULL',
                                     array('OR', 
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                         array('AND', 'effect_from <= ?', 'effect_to >= ?'))
                                )
                            ),
                            array('OR', 
                                array('AND', 'time_from >= ? ', 'time_from < ?'), 
                                array('AND', 'time_to > ?', 'time_to <= ?'), 
                                array('AND', 'time_from < ?', 'time_to > ?'))
                            );
                        $this->condition_values = array($type, $effect_from, $effect_from, $effect_from, $effect_to, $effect_to, $from_time, $to_time, $from_time, $to_time, $from_time, $to_time);
                    }
                }
                $this->query_generate();
//                echo $this->sql_query;
//                echo "<pre>".print_r($this->condition_values , 1)."</pre>";
                $data = $this->query_fetch();
//                echo "<pre>data".print_r($data, 1)."</pre>";
                if (!empty($data)) {
                    $flag = 1;
                    break;
                }
            }
            $i++;
        }
        return ($flag ? FALSE : TRUE);
    }

    function inconvenient_timing_make_closed($id = NULL) {
        $effect_from = date("Y-m-d", strtotime("-1 DAY", strtotime($this->effect_from)));
        
        if (strtotime($this->effect_from) >= strtotime($effect_from)) {
            $this->tables = array("inconvenient_timing");
            $this->fields = array("effect_to");
            $this->field_values = array($effect_from);
            if($id == NULL){
                $this->conditions = array("AND", "name = ?", "effect_to IS NULL");
                $this->condition_values = array($this->name);
            } else {
                $this->conditions = array("AND", array('OR','id = ?', 'root_id = ?'), "effect_to IS NULL");
                $this->condition_values = array($id, $id);
            }
            if ($this->query_update()) 
                return TRUE;
            else 
                return FALSE;
        } else{
            return FALSE;
        }
    }

    function timing_name_existence_check() {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name');
        $this->conditions = array('name = ?');
        $this->condition_values = array($this->name);
        $this->query_generate(); //echo $this->sql_query;
        $data = $this->query_fetch();
        if (!empty($data)) {
            return true;
        }else
            return FALSE;
    }

    function inconvenient_timing($id) {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'type', 'days', 'amount', 'nature');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate(); //echo $this->sql_query;
        $data = $this->query_fetch();
        if (!empty($data)) {
            return $data;
        }else
            return FALSE;
    }

    function inconvenient_child_timings($root_id) {
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'type', 'days', 'amount', 'nature');
        $this->conditions = array('root_id = ?');
        $this->condition_values = array($root_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function timing_name_get_all() {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('DISTINCT name');
        $this->query_generate(); //echo $this->sql_query;
        $data = $this->query_fetch(2);
        if (!empty($data)) {
            return $data;
        }else
            return FALSE;
    }

    function format_date($date) {
        $date = explode("/", $date);
        return($date[2] . '-' . $date[0] . '-' . $date[1]);
    }

    function convert_date($date) {
        $date = explode("-", $date);
        return($date[1] . '/' . $date[2] . '/' . $date[0]);
    }

    function format_time_part($time) {
        $hr = ((int) ($time / 100) < 10) ? "0" . (int) ($time / 100) : (int) ($time / 100);
        $min = ((int) ($time % 100) * (60 / 100) < 10) ? "0" . (int) ($time % 100) * (60 / 100) : (int) ($time % 100) * (60 / 100);
        return $hr . '.' . $min;
    }

    function convert_time_part($time) {

        $hr = (int) $time;
        $min = ((($time - $hr) * 100) / 60) * 100;
        return ($hr * 100) + ($min);
    }
    function from_date_check($name, $date_from) {
        //// for ajax ajax_incon_timing_from_date_check.php

        $this->tables = array("inconvenient_timing");
        $this->fields = array("id", "name");
        $this->conditions = array("AND", "name = ?", "effect_from >= ?");
        $this->condition_values = array($name, $date_from);
        $this->query_generate(); 
//        echo $this->sql_query;
//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
        $data = $this->query_fetch(); //print_r($data);
        if (!empty($data))
            return TRUE;
        else
            return FALSE;
    }

    function get_date_limits($month, $year) {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lower_limit = $year . "-" . $month . "-01";
        $upper_limit = $year . "-" . $month . "-" . $num;
        return $lower_limit . "/" . $upper_limit;
    }

    function get_inconvinient_timing_month($month, $year) {
        $limits = $this->get_date_limits($month, $year);
        $dates = explode("/", $limits);
        //echo $dates[0]."      ";
        //print_r($dates);
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'type', 'days');
        $this->conditions = array('OR', array('BETWEEN', 'effect_to', '?', '?'), array('BETWEEN', 'effect_from', '?', '?'));
        $this->condition_values = array($dates[0], $dates[1], $dates[0], $dates[1]);
        $this->order_by = array('effect_from');
        $this->query_generate();
        // echo $this->sql_query;
        $data = $this->query_fetch();
        //print_r($data);
        if (!empty($data)) {
            return $data;
        }
        else
            return FALSE;
    }

    function time_difference($t1, $t2, $mod=60) {
//        if(floatval($t1) < floatval($t2)){
//            echo "<script>alert('".$t1." ". $t2."')</script>";
//        }
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        //$time1 = ((intval($a1[0]) * 60 * 60) + (str_pad(intval($a1[1]), 2, '0', STR_PAD_RIGHT) * 60));
        //$time2 = ((intval($a2[0]) * 60 * 60) + (str_pad(intval($a2[1]), 2, '0', STR_PAD_RIGHT) * 60));
        $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        if($mod == 100)
            $mins = round($mins*100/60);
        //$result = $hours . "." . sprintf('%02d', $mins);
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }

    function time_sum($t1, $t2) {
        
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = (($a1[0] * 60 * 60) + (str_pad($a1[1], 2, '0', STR_PAD_RIGHT) * 60));
        $time2 = (($a2[0] * 60 * 60) + (str_pad($a2[1], 2, '0', STR_PAD_RIGHT) * 60));
        $sum = abs($time1 + $time2);
        $hours = floor($sum / (60 * 60));
        $mins = floor(($sum - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }

    function get_normal_inconv($time_from, $time_to, $inconv_from, $inconv_to, $method) {
        //echo "<br>".$time_from."<br>".$time_to."<br>".$inconv_from."<br>".$inconv_to."<br>";
        switch ($method) {
            case 1: {

                    $normal = $this->time_sum($this->time_difference($inconv_from, $time_from), $this->time_difference($time_to, $inconv_to));
                    $inconvinient_time = $this->time_difference($inconv_to, $inconv_from);
                    //$inconvinient_time = ($this->convert_time_part($inconv_to) - $this->convert_time_part($inconv_from));
                    //echo $inconvinient_time;
                    return $normal . "/" . $inconvinient_time;
                }
            case 2: {
                    $normal = $this->time_difference($inconv_from, $time_from);
                    $inconvinient_time = $this->time_difference($time_to, $inconv_from);
                    return $normal . "/" . $inconvinient_time;
                }
            case 3: {
                    $normal = $this->time_difference($time_to, $inconv_to);
                    $inconvinient_time = $this->time_difference($inconv_to, $time_from);
                    return $normal . "/" . $this->$inconvinient_time;
                }

            case 4: {
                    $normal = "0.00"; //($this->convert_time_part($inconv_from) - $this->convert_time_part($time_from)) + ($this->convert_time_part($time_to) - $this->convert_time_part($inconv_to));           
                    $inconvinient_time = $this->time_difference($time_from, $time_to);
                    return $normal . "/" . $inconvinient_time;
                }
        }
        /* if($method == 1)
          {
          $normal = ($this->convert_time_part($inconv_from) - $this->convert_time_part($time_from)) + ($this->convert_time_part($time_to) - $this->convert_time_part($inconv_to));
          $inconvinient_time = ($this->convert_time_part($inconv_to) - $this->convert_time_part($inconv_from));
          return $this->format_time_part($normal)."/".$this->format_time_part($inconvinient_time);
          }
          else if($method == 2)
          {

          $normal = ($this->convert_time_part($inconv_from) - $this->convert_time_part($time_from));
          $inconvinient_time = ($this->convert_time_part($time_to) - $this->convert_time_part($inconv_from));
          return $this->format_time_part($normal)."/".$this->format_time_part($inconvinient_time);
          }
          else if($method == 3)
          {
          $normal = ($this->convert_time_part($time_to) - $this->convert_time_part($inconv_to));
          $inconvinient_time = ($this->convert_time_part($inconv_to) - $this->convert_time_part($time_from));
          return $this->format_time_part($normal)."/".$this->format_time_part($inconvinient_time);
          }
          else if($method == 4)
          {
          $normal ="0.00"; //($this->convert_time_part($inconv_from) - $this->convert_time_part($time_from)) + ($this->convert_time_part($time_to) - $this->convert_time_part($inconv_to));
          $inconvinient_time = ($this->convert_time_part(time_to) - $this->convert_time_part($time_from));
          return $normal."/".$this->format_time_part($inconvinient_time);
          } */
    }

    function get_inconvinient_name() {
        $this->tables = array('inconvenient_timing');
        $this->fields = array('name');
        //$this->group_by = array('name');
        $this->query_generate();
        // echo $this->sql_query;
        $data = $this->query_fetch();

        if (!empty($data)) {
            return $data;
        }
        else
            return FALSE;
    }

    /*     * ****************************shamsu************************ */

    function timing_holiday_names() {
        // change database name
        $this->tables = array($this->db_master . '.holiday_block_master');
        $this->fields = array('DISTINCT(name) as name', 'id as id');
        $this->query_generate(); //echo $this->sql_query;
        $data = $this->query_fetch();
        //print_r($data);
        if (!empty($data)) {
            return $data;
        }else
            return FALSE;
    }

    function distinct_years_from_timetable() {
        $this->tables = array('timetable');
        $this->fields = array('DISTINCT(year(date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate(); //echo $this->sql_query;
        $datas = $this->query_fetch(2);
        //print_r($datas);
        //if (!empty($datas)) {
        return $datas;
        //}else
        //    return FALSE;
    }

    function timing_holiday_year_from_years() {
        //$years=array();
        $timetable_years = $this->distinct_years_from_timetable();
        if (!empty($timetable_years)) {
            if (!in_array(Date("Y"), $timetable_years))
                $timetable_years[] = Date("Y");
            if (!in_array(date('Y', strtotime('+1 year')), $timetable_years))
                $timetable_years[] = date('Y', strtotime('+1 year'));
            //echo "world";
        }
        else {
            $timetable_years[] = Date("Y");
            $timetable_years[] = date('Y', strtotime('+1 year'));
            //echo "hello";
        }

        sort($timetable_years);
        //print_r($timetable_years);
        return $timetable_years;
    }

    function holiday_details($id) {
        $this->tables = array($this->db_master . '.holiday_block');
        $this->fields = array('day', 'type');
        $this->conditions = array('block_master_id  = ?');
        $this->condition_values = array($id);
        $this->order_by = array('day');
        $this->query_generate(); //echo $this->sql_query;
        $datas = $this->query_fetch();

        //if (!empty($datas)) {
        return $datas;
        /* }else
          return FALSE;
         */
    }

    function holiday_time($id) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('start_time', 'end_time');
        $this->conditions = array('id  = ?');
        $this->condition_values = array($id);
        $this->query_generate(); //echo $this->sql_query;
        $datas = $this->query_fetch();
        //print_r($datas);
        return $datas;
    }

    function holidays_count($id) {
        $this->tables = array('holiday_block');
        $this->fields = array('count(day) as count');
        $this->conditions = array('block_master_id  = ?');
        $this->condition_values = array($id);
        //$this->order_by = array('day');
        $this->query_generate(); //echo $this->sql_query;
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function holiday_timing_list($id = NULL) {

        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'name', 'TIME_FORMAT(replace(start_time,".",":"),"%H:%i") as start_time',
            'TIME_FORMAT(replace(end_time,".",":"),"%H:%i") as end_time',
            'effect_from as year_from', 'effect_to as year_to', 'date_from', 'date_to');
        if ($id != Null) {
            $this->conditions = array('AND', 'id = ?');
            $this->condition_values = array($id);
        } else {
             $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')));
             $this->condition_values = array(date('Y'), date('Y'), date('Y'));
        }

        $this->order_by = array('year_from', 'date_from');
        $this->query_generate(); //echo $this->sql_query;
        $data = $this->query_fetch();
        //print_r($data);
        if(!empty($data))
            return $data;
        else
            return array();
    }
    
    function holiday_timing_list_full($id = NULL) {

        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'name', 'TIME_FORMAT(replace(start_time,".",":"),"%H:%i") as start_time',
            'TIME_FORMAT(replace(end_time,".",":"),"%H:%i") as end_time',
            'effect_from as year_from', 'effect_to as year_to', 'date_from', 'date_to','type');
        if ($id != Null) {
            $this->conditions = array('AND', 'id = ?');
            $this->condition_values = array($id);
        }

        $this->order_by = array('year_from desc', 'date_from desc');
        $this->query_generate(); //echo $this->sql_query;
        $data = $this->query_fetch();
        //print_r($data);
        for($i=0;$i<count($data);$i++){
            $this->tables = array('holiday_block');
            $this->fields = array('COUNT(block_master_id) AS days');
            $this->conditions = array('block_master_id = ?');
            $this->condition_values = array($data[$i]['id']);
            $this->query_generate();
            $data1 = $this->query_fetch();
            $data[$i]['num_days'] = $data1[0]['days'];
//            $this->tables = array('salary_main');
//            $this->fields = array('effect_from','effect_to','holiday_big','holiday_red');
//            $this->query_generate();
//            $data2 = $this->query_fetch();
////            echo "<pre>". print_r($data2, 1)."</pre>";
//            for($j=0;$j<count($data2);$j++){
//                if($data2[$i]['effect_to'] == '0000-00-00'){
////                    echo $i;
////                    echo $date = $data[$i]['year_from'].'-'.$data[$i]['date_from']."<br><br>";
//                    $date = $data[$i]['year_from'].'-'.$data[$i]['date_from'];
//                    if(strtotime($date) >= strtotime($data2[$j]['effect_from'])){
//                        if($data[$i]['type'] == 1){
//                            $data[$i]['amount'] = $data2[$j]['holiday_red'];
//                        }
//                        else {
//                            $data[$i]['amount'] = $data2[$j]['holiday_big'];
//                        }
//                    }
//                }
//            }
//            $data[$i]['num_days'] = $data1[0]['days'];
        }
//        echo "<pre>". print_r($data, 1)."</pre>";
        return $data;
    }
    
    function get_holiday_blockmaster_details_byId($bm_id) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'name', 'start_time', 'end_time', 'type');
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    /*
    function get_local_holiday_blockmaster_details_byId($bm_id) {
        $this->tables = array('per_holiday_block_master');
        $this->fields = array('start_time', 'end_time');
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function check_local_holiday_blockmaster_details_byId($bm_id) {
        $this->tables = array('per_holiday_block_master');
        $this->fields = array('id', 'start_time', 'end_time');
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if(!empty($data))
            return TRUE;
        else
            return FALSE;
    }
    
    function create_local_holiday_blockmaster_details_byId($bm_id,$bm_tfrom, $bm_tto) {
        $this->tables = array('per_holiday_block_master');
        $this->fields = array('id', 'start_time', 'end_time');
        $this->field_values = array($bm_id,$bm_tfrom, $bm_tto);
//        $this->query_generate();
        if($this->query_insert())
            return TRUE;
        else
            return FALSE;
    }
    
    function update_local_holiday_blockmaster_details_byId($bm_id,$bm_tfrom, $bm_tto) {
        $this->tables = array('per_holiday_block_master');
        $this->fields = array('start_time', 'end_time');
        $this->field_values = array($bm_tfrom, $bm_tto);
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
//        echo "<pre>".print_r(array($bm_id,$bm_tfrom, $bm_tto), 1)."</pre>";
//        $this->query_generate();
        if($this->query_update())
            return TRUE;
        else
            return FALSE;
    }*/

    function create_local_holiday_blockmaster_data($new_name, $group_id, $year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('name','group_id','effect_from', 'effect_to', 'date_from', 'date_to', 'start_time', 'end_time', 'type');
        $year_to = ($year_to == '' ? NULL : $year_to);
        $this->field_values = array($new_name,$group_id, $year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type);
        if($this->query_insert())
            return TRUE;
        else
            return FALSE;
    }

    function update_local_holiday_blockmaster_data($bm_id,$group_id,$new_name, $year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('name','group_id', 'effect_from', 'effect_to', 'date_from', 'date_to', 'start_time', 'end_time', 'type');
        $year_to = ($year_to == '') ? NULL : $year_to;
        $this->field_values = array($new_name,$group_id, $year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type);
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        if($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function update_clone_parent_yearTo_of_Holiday($bm_id, $new_year_to) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('effect_to');
        $this->field_values = array($new_year_to);
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        if($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function create_local_holiday_block_day_details($bm_id, $day_number, $red_big) {
        $this->tables = array('holiday_block');
        $this->fields = array('block_master_id', 'day', 'type');
        $this->field_values = array($bm_id, $day_number, $red_big);
        if($this->query_insert())
            return TRUE;
        else
            return FALSE;
    }

    function delete_local_holiday_block_day_details($bm_id) {
        $this->tables = array('holiday_block');
        $this->conditions = array('block_master_id = ?');
        $this->condition_values = array($bm_id);
        if($this->query_delete())
            return TRUE;
        else
            return FALSE;
    }

    function get_holiday_details_byId($bm_id) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'date_from', 'date_to', 'start_time', 'end_time', 'type');
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        $this->query_generate();
        $data = $this->query_fetch();
        if(!empty($data)){
            $day_details = $this->get_holiday_day_details_byId($bm_id);
            if(!empty($day_details))
                $data[0]['day_data'] = $day_details;
            return $data;
        }else
            return FALSE;
    }
    
    function delete_holiday_details_byId($bm_id) {
        $this->tables = array('holiday_block_master');
        $this->conditions = array('id = ?');
        $this->condition_values = array($bm_id);
        if ($this->query_delete()) {
            $this->tables = array('holiday_block');
            $this->conditions = array('block_master_id = ?');
            $this->condition_values = array($bm_id);
            $this->query_delete();
            return TRUE;
        }else
            return FALSE;
    }
    
    function get_holiday_day_details_byId($bm_id) {
        $this->tables = array('holiday_block');
        $this->fields = array('day', 'type');
        $this->conditions = array('block_master_id = ?');
        $this->condition_values = array($bm_id);
        $this->query_generate();
        $day_data = $this->query_fetch();
        return $day_data;
    }
    
    function get_holiday_by_years($year_from, $year_to, $bm_id = NULL) {
        $this->tables = array('holiday_block_master');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'date_from', 'date_to', 'start_time', 'end_time', 'type');
        if($year_to == ""){
            $this->conditions = array('AND',
                                        array('OR', 
                                            'effect_to IS NULL', 
                                            array('AND', 'effect_to IS NOT NULL', 'effect_to >= ?')),
                                        'id != ?'
                                    );
            $this->condition_values = array($year_from, $bm_id);
        }else{
            $this->conditions = array('AND', 
                                        array('OR', 
                                            array('AND', 'effect_to IS NULL', 'effect_from <= ?'),
                                            array('AND', 
                                                'effect_to IS NOT NULL',
                                                 array('OR', 
                                                     array('AND', 'effect_from <= ?', 'effect_to >= ?'),
                                                     array('AND', 'effect_from <= ?', 'effect_to >= ?')
                                                     ))
                                        ),
                                        'id != ?'
                                    );
            $this->condition_values = array($year_to, $year_from, $year_from, $year_to, $year_to,$bm_id);
        }
        $this->query_generate();
//        echo $this->sql_query;
        $day_data = $this->query_fetch();
        return $day_data;
    }
    
     function get_inconvenient_group_id($mod, $id = NULL) {
         /**
         * Author: Shamsu
         * for: for getting inconvenient group id to create or edit new inconvenient with respect to mod
         */
        $this->tables = array('inconvenient_timing');
         switch ($mod){
            case 'new' :
                $this->fields = array('COALESCE(max(`group_id`)+1, 1) as group_id');
                break;
            case 'edit' :
            case 'clone' :
                $this->fields = array('group_id');
                $this->conditions = array('id = ?');
                $this->condition_values = array($id);
        }
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }
    
    function change_inconvenient_name_by_group_id($gid, $new_name) {
        $this->tables = array("inconvenient_timing");
        $this->fields = array("name");
        $this->field_values = array($new_name);
        $this->conditions = array("group_id = ?");
        $this->condition_values = array($gid);
        if ($this->query_update()) 
            return TRUE;
        else 
            return FALSE;
    }
    /*     * ********************shamsu   end*************** */
//    SELECT DAYOFWEEK('2007-02-03');
//        -> 7
    
    function get_timetable_all($effect_from,$effect_to,$time_from,$time_to,$day){
        $this->tables = array('timetable');
        $this->fields = array('id','employee','time_from','time_to','date','DAYOFWEEK(`date`) AS day','type');
        if($effect_to == NULL || $effect_to == ""){
            $this->conditions = array('AND','DAYOFWEEK(`date`) = ?','`date` >= ?',array('OR',array('BETWEEN','time_from','?','?'),array('BETWEEN','time_to','?','?')),array('OR','type = 3','type = 9'));
            $this->condition_values = array($day,$effect_from,$time_from,$time_to,$time_from,$time_to); 
        }else{
            $this->conditions = array('AND','DAYOFWEEK(`date`) = ?',array('BETWEEN','`date`','?','?'),array('OR',array('BETWEEN','time_from','?','?'),array('BETWEEN','time_to','?','?'),'type = 3','type = 9'));
            $this->condition_values = array($day,$effect_from,$effect_to,$time_from,$time_to,$time_from,$time_to);
        }
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            return $data;
        }else{
            return array();
        }
    }
    
    function get_next_holiday_group_id() {
         /**
         * Author: Shamsu
         * for: getting next group-id to create new holiday
         */
        $this->tables = array('holiday_block_master');
        $this->fields = array('COALESCE(max(`group_id`)+1, 1) as group_id');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['group_id'];
    }
}
?>