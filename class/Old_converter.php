<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'setup.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'db.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'equipment.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'employee.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'dona.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'leave.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'customer.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'user.php';
//require_once __DIR__.DIRECTORY_SEPARATOR.'inconvenient_timing.php';

class user_exp extends user
{
    function get_company($id) {

        $this->tables = array('' . $this->db_master . '.company');
        $this->fields = array('*');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {

            return false;
        }
    }   
}

class leaveConverter extends leave
{
    function employee_get_leave_slot($employee, $date, $time_from, $time_to) {

        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', array('IN', 'status', '2'), 'employee = ?', 'date = ?', 'time_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment');
        $this->conditions = array('AND', array('IN', 'status', '2'), 'employee = ?', 'date = ?', 'time_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($employee, $date, $time_to, $employee, $date, $time_from);
        $this->order_by = array('time_from');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $slot_datas = $this->query_fetch();
        foreach ($slot_datas as $slot) {

            $datas[] = array('id' => $slot['id'], 'customer' => $slot['customer'], 'employee' => $slot['employee'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name']);
        }
        if(!empty($datas))
            return $datas;
        else
            return array();
    }
}

/**
 * Converts employee time data into the export format of the selected payment sistem.
 */
class Converter 
{
    private $result;
    private $meta;
    private $year;

    private $timeCodes = array();
    private $bookDistributionProjects = array();
    private $bookDistributionProjectsSum = 0;

    private $db;

    public $employeeObj;

    const VISMA_DATE_FORMAT = 'Y-m-d';
    const VISMA_PAY_DATE_FORMAT = 'Ymd';
    const HOGIA_DATE_FORMAT = 'ymd';

    public function __construct($meta, $result, $year)
    {
        $this->year = $year;
        $this->result = $result;
        $this->meta = $meta;

        $this->db = new db;
        $this->equipment = new equipment();
    }

    /*
    public function normalizeResult($result)
    {
        return $result;
        $temp = array();
        foreach ($result as $week)
            foreach ($week['employee'] as $employee)
                $temp[$employee['name']] = $this->convEmployee($employee, $week['week']);
    }
     */
    
    private function getEmployeeWorkReportDetailsNormal(&$rpt_content, &$inconv_normal_slots, &$flag, $employee, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type=-1, $isOnCall=-1)
    {
        $holidays               = $employee->get_holiday_details($month, $yr);
        
        /*
        if($isOnCall==0)
        {
            $inconv_normal_category = $employee->get_distinct_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);
        }
        else
        {
            $inconv_normal_category = $employee->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);
        }
        */
        $inconv_normal_category = $employee->get_distinct_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);
        

        $flag = 0;
        $flag_holiday = 0;
        //checking whether it is a holiday


        foreach ($holidays as $holiday) {
            $holidayTmp = $holiday['id']+1000;
            //$holidayTmp = $leave_type==1 ? '2001.'.$holidayTmp : $holidayTmp;
            $holidayTmp = $leave_type>0 ? ($leave_type==1 ? '2001.'.$holidayTmp : 2000+$leave_type) : $holidayTmp;
            if($isOnCall == 1 && $leave_type==1)
            //if($isOnCall || $leave_type)
            {
                $holidayTmp = '1000.'.$holidayTmp;
            }
            

            if ($slot_time_from < $holiday['start'] && $slot_time_to > $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $holiday['end'], round(($holiday['end'] - $holiday['start']) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H-i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H-i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from >= $holiday['start'] && $slot_time_from < $holiday['end'] && $slot_time_to >= $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $holiday['end'], round(($holiday['end'] - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                if ($slot_time_to > $holiday['end']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H.i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from <= $holiday['start'] && $slot_time_to > $holiday['start'] && $slot_time_to <= $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $slot_time_to, round(($slot_time_to - $holiday['start']) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                if ($slot_time_from < $holiday['start']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H.i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from > $holiday['start'] && $slot_time_to < $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) {
            return;
        }

        foreach ($inconv_normal_category as $inconv_normal) {
            $days = explode(',', $inconv_normal['days']);
            $leaveTypeTmp = $inconv_normal['id'];
            $leaveTypeTmp = $leave_type>0 ? ($leave_type==1 ? '2001.'.$leaveTypeTmp : 2000+$leave_type) : $leaveTypeTmp;
            //$leaveTypeTmp = $leave_type>0 ? '2001.'.$leaveTypeTmp : $leaveTypeTmp;
            if($isOnCall == 1 && $leave_type==1)
            //if($isOnCall || $leave_type)
            {
                $leaveTypeTmp = '2001.'.$inconv_normal['id'];
            }
           
            $inconv_time_from = mktime(intval($inconv_normal['time_from']), bcmod($inconv_normal['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            $inconv_time_to = mktime(intval($inconv_normal['time_to']), bcmod($inconv_normal['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    if ($slot_time_to > $inconv_time_to) {
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    }
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    if ($slot_time_from < $inconv_time_from) {
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    }
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                }
            }
            if($flag == 1){
                return;
            }    

            $inconv_normal_category_cont = $employee->get_distinct_normal_inconvenient_details_by_month_and_year_cont($inconv_normal['id']);            
            foreach ($inconv_normal_category_cont as $inconv_normal_cont) {

                $days = explode(',', $inconv_normal_cont['days']);
                $leaveTypeTmp = $inconv_normal['id'];
                $leaveTypeTmp = $leave_type>0 ? ($leave_type==1 ? '2001.'.$leaveTypeTmp : 2000+$leave_type) : $leaveTypeTmp;
                //$leaveTypeTmp = $leave_type>0 ? '2001.'.$leaveTypeTmp : $leaveTypeTmp;
                if($isOnCall == 1 && $leave_type==1)
                //if($isOnCall || $leave_type)
                {
                    $leaveTypeTmp = '2001.'.$inconv_normal['id'];
                }

                $inconv_time_from = mktime(intval($inconv_normal_cont['time_from']), bcmod($inconv_normal_cont['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $inconv_time_to = mktime(intval($inconv_normal_cont['time_to']), bcmod($inconv_normal_cont['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));

                if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                    if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        if ($slot_time_to > $inconv_time_to) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        if ($slot_time_from < $inconv_time_from) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    }
                }
            }
            if ($flag == 1) {
                return;
            }
        }
    }

    private function getEmployeeWorkReportDetailsOnCall(&$rpt_content, &$inconv_normal_slots, &$flag, $employee, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type=-1)
    {
        $holidays               = $employee->get_holiday_details($month, $yr);
        $inconv_oncall_category = $employee->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);

        foreach ($holidays as $holiday) {
            //$holidayTmp = '1000.'.($holiday['id']+1000);
            $holidayTmp = $holiday['id']+1000;
            $holidayTmp = $leave_type>0 ? ($leave_type==1 ? '2001.'.$holidayTmp : 2000+$leave_type) : '1000.'.$holidayTmp;
           

            if ($slot_time_from < $holiday['start'] && $slot_time_to > $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $holiday['end'], round(($holiday['end'] - $holiday['start']) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H-i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H-i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from >= $holiday['start'] && $slot_time_from < $holiday['end'] && $slot_time_to >= $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $holiday['end'], round(($holiday['end'] - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                if ($slot_time_to > $holiday['end']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H.i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from <= $holiday['start'] && $slot_time_to > $holiday['start'] && $slot_time_to <= $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $slot_time_to, round(($slot_time_to - $holiday['start']) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                if ($slot_time_from < $holiday['start']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H.i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from > $holiday['start'] && $slot_time_to < $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp);
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) {
            return;
        }
        foreach ($inconv_oncall_category as $inconv_oncall) {
            $days = explode(',', $inconv_oncall['days']);
            $leaveTypeTmp = $inconv_oncall['id'];
            $leaveTypeTmp = $leave_type>0 ? ($leave_type==1 ? '2001.'.$leaveTypeTmp : 2000+$leave_type) : $leaveTypeTmp;
            $inconv_time_from = mktime(intval($inconv_oncall['time_from']), bcmod($inconv_oncall['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            $inconv_time_to = mktime(intval($inconv_oncall['time_to']), bcmod($inconv_oncall['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    if ($slot_time_to > $inconv_time_to) {
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    }
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    if ($slot_time_from < $inconv_time_from) {
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                    }
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                    //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                    unset($inconv_normal_slots[$key]);
                    $flag = 1;
                    break;
                }
            }
            if ($flag == 1) {
                return;
            }
            $inconv_oncall_category_cont = $employee->get_distinct_normal_inconvenient_details_by_month_and_year_cont($inconv_oncall['id']);
            foreach ($inconv_oncall_category_cont as $inconv_oncall_cont) {
                $days = explode(',', $inconv_oncall_cont['days']);
                $leaveTypeTmp = $inconv_oncall['id'];
                $leaveTypeTmp = $leave_type>0 ? ($leave_type==1 ? '2001.'.$leaveTypeTmp : 2000+$leave_type) : $leaveTypeTmp;
                $inconv_time_from = mktime(intval($inconv_oncall_cont['time_from']), bcmod($inconv_oncall_cont['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $inconv_time_to = mktime(intval($inconv_oncall_cont['time_to']), bcmod($inconv_oncall_cont['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                    if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                       // $rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        if ($slot_time_to > $inconv_time_to) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        if ($slot_time_from < $inconv_time_from) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp);
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    }
                }
            }
            if ($flag == 1) {
                return;
            }
        }
    }

    public function convEmployee($employee, $weekNo)
    {
        $out = array();
        //$customer = $employee['customer'];
        //unset($employee['name'], $employee['sum'], $employee['customer']);

        foreach ($employee as $day => $time)
        {
            switch ($day)
            {
                case 'Mon':
                    $day = ($weekNo*7)-7;
                    break;
                case 'Tue':
                    $day = ($weekNo*7)-6;
                    break;
                case 'Wen':
                    $day = ($weekNo*7)-5;
                    break;
                case 'Thu':
                    $day = ($weekNo*7)-4;
                    break;
                case 'Fri':
                    $day = ($weekNo*7)-3;
                    break;
                case 'Sat':
                    $day = ($weekNo*7)-2;
                    break;
                case 'Sun':
                    $day = ($weekNo*7)-1;
                    break;

                default:
                    $day = NULL;
                    break;
            }

            if($day==NULL)
            {
                continue;
            }

            $date = date_create_from_format('z Y', $day.' '.$this->year)->format(self::VISMA_DATE_FORMAT);
            $out[$date]['work'] = 0;
            $out[$date]['leave'] = 0;

            foreach ($time as $hours)
            {
                list($hours, $typeOfWork, $onLeave) = explode(',', $hours);
                $hours = explode(' - ', $hours);
                //$out[$date]['time_start'] = $hours[0];
                //$out[$date]['time_end'] = $hours[1];
                $out[$date]['customer'] = $employee['customer'];
                $out[$date]['emp_username'] = $employee['emp_username'];
                $out[$date]['time_code'] = $typeOfWork;
                $outTmp = array(
                    'time_start' => $hours[0],
                    'time_end' => $hours[1],
                );

                if ($onLeave==1)
                {
                    //$out[$date]['work'] += $this->diffHours($hours[0], $hours[1]);
                    //$outTmp['work'] = $this->diffHours($hours[0], $hours[1]);
                    $outTmp['work'] = $this->equipment->time_difference($hours[0], $hours[1]);
                }
                else
                {
                    //$out[$date]['leave'] += $this->diffHours($hours[0], $hours[1]);
                    //$outTmp['leave'] = $this->diffHours($hours[0], $hours[1]);
                    $outTmp['leave'] = $this->equipment->time_difference($hours[0], $hours[1]);
                }

                $out[$date]['times'][] = $outTmp;
            }
        }

        /*
        if ($out[$date]['work']!==0)
        {
            //$out[$date]['work'] = number_format($out[$date]['work'], 2);
            $out[$date]['work'] = $out[$date]['work'];
        }
        else
        {
            unset($out[$date]['work']);
        }

        if ($out[$date]['leave']!==0)
        {
            //$out[$date]['leave'] = number_format($out[$date]['leave'], 2);
            $out[$date]['leave'] = $out[$date]['leave'];
        }
        else
        {
            unset($out[$date]['leave']);
        }
         */

        return $out;
    }

    public function diffHours($h1, $h2)
    {
        $h1 = floor($h1)*60 + ($h1-floor($h1))*100;
        $h2 = floor($h2)*60 + ($h2-floor($h2))*100;
        $r = $h2-$h1;
        //$r = floor($r/60) + ($r-floor($r/60)*60)/100;

        return $r;


        if ($r-floor($r)<0.6)
            return number_format($r, 2);
        else
        {
            $r += 1.00;
            $r -= 0.60;

            return number_format($r, 2);
        }
    }

    private function findRecordInLeaves($timeStart, $timeEnd, $dateStart, $employee)
    {
        foreach($this->leaves as $key => $value)
        {
            if($value['employee']==$employee)
            {
                // convention for 24.00 and 24.0 !!!
                $value['To_date'] = str_replace('24.00', '23.59', $value['To_date']);
                $value['To_date'] = str_replace('24.0', '23.59', $value['To_date']);
                $timeEnd = str_replace('24.00', '23.59', $timeEnd);
                $timeEnd = str_replace('24.0', '23.59', $timeEnd);
                // convention end

                $leaveStart = DateTime::createFromFormat('Y-m-d G.i', $value['From_date']);
                $leaveEnd = DateTime::createFromFormat('Y-m-d G.i', $value['To_date']);

                $timeStartTmp = DateTime::createFromFormat('Y-m-d G.i', $dateStart.' '.$timeStart);
                $timeEndTmp = DateTime::createFromFormat('Y-m-d G.i', $dateStart.' '.$timeEnd);

                if($leaveStart<=$timeStartTmp && $timeStartTmp<$leaveEnd && $leaveStart<$timeEndTmp && $timeEndTmp<=$leaveEnd)
                {
                    return $value;
                }
            }
        }

        return FALSE;
    }

    private function identifyTimeCode($timeCode, $iInc=0, $salary_mod=0)
    {
        $timeCode += $iInc;

        foreach ($this->timeCodes as $key => $value)
        {
            if($value['id']==$timeCode)
            {
                if($salary_mod == 0)
                    return $value['id_external'];
                else
                    return $value['id_monthly'];

            }
        }

        return $timeCode;
    }

    private function appendTimeTagElement($xmlDoc, $key, $item, $valueItem, &$empTag)
    {
        if(!empty($item['time_code']))
        {
            $timeTag = $xmlDoc->createElement('Time');
            $timeTag->setAttribute('DateOfReport', $key);
            $timeTag->setAttribute('TimeCode', $item['time_code']);
            $timeTag->setAttribute('SumOfHours', $valueItem['time_diff']);
            $timeTag->setAttribute('TimeStart', $valueItem['time_start']);
            $timeTag->setAttribute('TimeEnd', $valueItem['time_end']);
            $timeTag->setAttribute('ProjectCode', $item['customer']);
            //$timeTag->setAttribute('ResultUnitCode', '');
            $empTag->appendChild($timeTag);

            // for BookDistributionProjects TAG
            $this->bookDistributionProjects[$item['customer']] += $valueItem['time_diff'];
            $this->bookDistributionProjectsSum += $valueItem['time_diff'];
        }
    }

    public function walkDataNonXML($item, $key)
    {
        if (isset($item['work']) && $item['work']!=0)
        {
            $item['work'] = floor($item['work']/60) + ($item['work']-floor($item['work']/60)*60)/100;

            $timeTag = array(
                'DateOfReport'  => $key,
                'TimeCode'      => 300,
                'SumOfHours'    => $item['work'],
            );
            $this->times[] = $timeTag;
        }
        if (isset($item['leave']) && $item['leave']!=0)
        {
            $item['leave'] = floor($item['leave']/60) + ($item['leave']-floor($item['leave']/60)*60)/100;

            $timeTag = array(
                'DateOfReport'  => $key,
                'TimeCode'      => 401,
                'SumOfHours'    => $item['leave'],
            );
            $this->times[] = $timeTag;
        }
    }

    private function getTimingList($smarty)
    {
        $incTiming = new inconvenient_timing();
        $inconvenientTimingList = $incTiming->inconvenient_timing_list();
        $inconvenientTimingList = !is_array($inconvenientTimingList) ? array() : $inconvenientTimingList;
        $temp_array = array();
        foreach($inconvenientTimingList as $key=>$entry)
        {
            
            //$inconvenientTimingList[$key]['name'] = $smarty->translate['lc_label_'.$entry['id']];
            $inconvenientTimingList[$key]['name'] = utf8_encode($entry['name']);
            if($entry['type'] == 3){
                $entry['id'] = $entry['id'].'.1';
                $entry['name'] = $entry['name'].'. intro';
                $temp_array[] = $entry;
               // array_push($inconvenientTimingList, $entry);
                
                //$inconvenientTimingList[count($inconvenientTimingListvar)-1]['id'] = $entry['id'].'.1';
                //$inconvenientTimingList[count($inconvenientTimingListvar)-1]['name'] = $entry['name'].'. intro';
            }
        }
        $inconvenientTimingList = array_merge($inconvenientTimingList, $temp_array);
        
        $holidayTimingList = $incTiming->holiday_timing_list();
        $holidayTimingList = !is_array($holidayTimingList) ? array() : $holidayTimingList;
        $holidayTimingListJour = array();
        foreach($holidayTimingList as $key=>$entry)
        {
            $holidayTimingList[$key]['id'] += 1000;

            $entry['id'] = '1000.'.($entry['id']+1000);
            $entry['name'] = 'Jour '.$entry['name'];
            $holidayTimingListJour[] = $entry;
        }
        $holidayTimingList = array_merge($holidayTimingList,$holidayTimingListJour);

        $leaveTimingList = array();
        $leaveTimingList[] = array(
            'id' => 2000,
            'name' => $smarty->translate['lc_label_2000'],
            'leave' => 1,
        );
        foreach($smarty->leave_type as $key=>$entry)
        {
            $leaveTimingList[] = array(
                'id' => 2000+$key,
                'name' => $smarty->translate['lc_label_'.(2000+$key)],
                'leave' => 1,
            );

            // add the sick combinations
            if($key==1)
            {
                $leaveTimingList[] = array(
                    'id' => '2001.0',
                    'name' => $smarty->translate['lc_label_2001.0'],
                    'leave' => 1,
                );

                foreach($inconvenientTimingList as $entryTmp)
                {
                    $leaveTimingList[] = array(
                        'id' => '2001'.'.'.$entryTmp['id'],
                        'name' => $smarty->translate['lc_label_2001.'.$entryTmp['id']],
                        'leave' => 1,
                    );
                }

                foreach($holidayTimingList as $entryTmp)
                {
                    $leaveTimingList[] = array(
                        'id' => '2001'.'.'.$entryTmp['id'],
                        'name' => $smarty->translate['lc_label_2001.'.$entryTmp['id']],
                        'leave' => 1,
                    );
                }
            }           
        }

        // status codes from "timetable"
        $timetableStatusList[] = array('id' => 3000, 'name' => $smarty->translate['lc_label_3000'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3001, 'name' => $smarty->translate['lc_label_3001'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3002, 'name' => $smarty->translate['lc_label_3002'], 'leave' => 0);
        //$timetableStatusList[] = array('id' => 3003, 'name' => $smarty->translate['lc_label_3003'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3004, 'name' => $smarty->translate['lc_label_3004'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3005, 'name' => $smarty->translate['lc_label_3005'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3006, 'name' => $smarty->translate['lc_label_3006'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3007, 'name' => $smarty->translate['lc_label_3007'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3008, 'name' => $smarty->translate['lc_label_3008'], 'leave' => 0);
        $timetableStatusList[] = array('id' => 3009, 'name' => $smarty->translate['lc_label_3009'], 'leave' => 0);


        $list = array_merge($inconvenientTimingList, $holidayTimingList, $leaveTimingList, $timetableStatusList);       
        //$list = array_merge($inconvenientTimingList, $holidayTimingList, $leaveTimingList);       

        // add the internal codes
        $this->db->tables = array('export_lon_config');             
        foreach ($this->db->query_fetch() as $entry)
        {
            foreach($list as $key => $value)
            {
                if((string)$value['id'] === (string)$entry['internal'])
                {
                    $list[$key]['id_external'] = !empty($entry['external']) ? $entry['external'] : $entry['internal'];
                    $list[$key]['id_monthly'] = !empty($entry['monthly']) ? $entry['monthly'] : $entry['internal'];
                }
            }
        }
        // rerun the list codes to add the id_external if not set
        foreach($list as $key => $value)
        {
            if(!isset($value['id_external']))
            {
                $list[$key]['id_external'] = $value['id'];
            }
            if(!isset($value['id_monthly']))
            {
                $list[$key]['id_monthly'] = $value['id'];
            }
        }

        return $list;
    }

    private function generateNormalWorkingTimes($startDate, $endDate, $xmlDoc)
    {
        $startDate = DateTime::createFromFormat('U', $startDate);
        $endDate = DateTime::createFromFormat('U', $endDate);
        $normalWorkingTimes = $xmlDoc->createElement('NormalWorkingTimes');

        while($startDate<=$endDate)
        {
            $normalWorkingTime = $xmlDoc->createElement('NormalWorkingTime');
            $normalWorkingTime->setAttribute('DateOfReport', $startDate->format('Y-m-d'));
            $normalWorkingTime->setAttribute('NormalWorkingTimeHours', '');
            $normalWorkingTime->setAttribute('FlexTimeHours', '');
            $normalWorkingTimes->appendChild($normalWorkingTime);

            $startDate->add(new DateInterval('P1D'));
        }

        return $normalWorkingTimes;
    }

    public function sortWorkingTimeInFullDay($a, $b)
    {
        usort($a['times'], array("self", "sortWorkingTimeInDay"));
        usort($b['times'], array("self", "sortWorkingTimeInDay"));

        if ($a['times'][0][0] == $b['times'][0][0])
        {
            return 0;
        }

        return ($a['times'][0][0] < $b['times'][0][0]) ? -1 : 1;
    }

    public function sortWorkingTimeInDay($a, $b)
    {
        if ($a[0] == $b[0])
        {
            return 0;
        }

        return ($a[0] < $b[0]) ? -1 : 1;
    }

    private function combineWorkingHours(&$rpt_content_leave, &$rpt_content_leave_over, &$rpt_content_leave_quality, &$rpt_content_leave_more, &$rpt_content_leave_some, &$rpt_content_leave_oncall, &$rpt_content_leave_training, &$rpt_content_leave_personal, &$rpt_content_leave_calltraining)
    {
        $rpt_content_merged = array();
        $rpt_content_all = array(
            &$rpt_content_leave,
            &$rpt_content_leave_over,
            &$rpt_content_leave_quality,
            &$rpt_content_leave_more,
            &$rpt_content_leave_some,
            &$rpt_content_leave_oncall,
            &$rpt_content_leave_training,
            &$rpt_content_leave_personal,
            &$rpt_content_leave_calltraining
        );
        foreach($rpt_content_all as $rpt_key=>$rpt_content)
        {
            if(!is_array($rpt_content))
            {
                continue;
            }

            foreach($rpt_content as $keyNormal=>$valueNormal)
            {
                if(!isset($rpt_content_merged[$keyNormal]))
                {
                    $rpt_content_merged[$keyNormal] = $valueNormal;
                }
                else
                {
                    foreach ($valueNormal as $keyTimeCode => $valueTimeCode)
                    {
                        if(!isset($rpt_content_merged[$keyNormal][$keyTimeCode]))
                        {
                            $rpt_content_merged[$keyNormal][$keyTimeCode] = $valueTimeCode;
                        }
                        else
                        {
                            if(!isset($valueTimeCode['times']) || !is_array($valueTimeCode['times']))
                            {
                                continue;
                            }

                            $rpt_content_merged[$keyNormal][$keyTimeCode]['total'] += $valueTimeCode['total'];
                            $rpt_content_merged[$keyNormal][$keyTimeCode]['times'] = array_merge($rpt_content_merged[$keyNormal][$keyTimeCode]['times'], $valueTimeCode['times']);
                            /*
                            foreach ($valueTimeCode['times'] as $keyTime => $valueTime)
                            {
                                $rpt_content_merged[$keyNormal][$keyTimeCode]['times'][] = $valueTime;
                            }
                            */
                        }
                    }
                }
            }
        }

        return $rpt_content_merged;
    }

   
    
    
    
    private function processWorkingTime($passed_employee, $month, $yr, &$rpt_content_normal, &$rpt_content_over, &$rpt_content_quality, &$rpt_content_more, &$rpt_content_some, &$rpt_content_oncall, &$rpt_content_leave, &$rpt_content_leave_over, &$rpt_content_leave_quality, &$rpt_content_leave_more, &$rpt_content_leave_some, &$rpt_content_leave_oncall, &$rpt_content_training, &$rpt_content_personal, &$rpt_content_calltraining, &$rpt_content_leave_training, &$rpt_content_leave_personal, &$rpt_content_leave_calltraining, &$rpt_content_travell, &$rpt_content_break)
    {
        $inconv_normal_slots    = $this->employeeObj->get_employee_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);
        
        $i = 0;
        do{
            $i++;
            foreach ($inconv_normal_slots as $key => $inconv_normal_slot) {
                $this->db->tables = array('timetable');
                $this->db->fields = array('customer');
                $this->db->conditions = array('id = ?');
                $this->db->condition_values = array($inconv_normal_slot['id']);
                $this->db->query_generate();
                $customer_data = $this->db->query_fetch();
                $inconv_normal_slot['customer'] = $inconv_normal_slots[$key]['customer'] = $customer_data[0]['customer'];

                $current_date = mktime(0, 0, 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $slot_time_from = mktime(intval($inconv_normal_slot['time_from']), bcmod($inconv_normal_slot['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $slot_time_to = mktime(intval($inconv_normal_slot['time_to']), bcmod($inconv_normal_slot['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $flag = 0;
                
                if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '0')) {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_normal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '1') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_travell, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '2') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_break, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '4') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_over, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '5') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_quality, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '6') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_more, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '7') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_some, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '8') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_training, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '10') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_personal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '3') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '9') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_calltraining, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                }else if ($inconv_normal_slot['status'] == 2) {
                    $leave_type = $this->employeeObj->getLeaveType($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                    if($leave_type){
                        if ($inconv_normal_slot['type'] == '0' || $inconv_normal_slot['type'] == '1' || $inconv_normal_slot['type'] == '2') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '4') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_over, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '5') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_quality, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '6') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_more, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '7') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_some, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '8') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_training, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '10') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_personal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '3') {
                            $this->getEmployeeWorkReportDetailsOnCall($rpt_content_leave_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        } else if ($inconv_normal_slot['type'] == '9') {
                            $this->getEmployeeWorkReportDetailsOnCall($rpt_content_leave_calltraining, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type']);
                        }
                    }
                }
            }

            // re-run
            if($i<3)
            {
                $flag = 1;
            }
        }while($flag ==  1 && !empty ($inconv_normal_slots));
        //$this->testWork($inconv_normal_slots, $passed_employee, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall);
        foreach ($inconv_normal_slots as $inconv_normal_slot) {
            $this->db->tables = array('timetable');
            $this->db->fields = array('customer');
            $this->db->conditions = array('id = ?');
            $this->db->condition_values = array($inconv_normal_slot['id']);
            $this->db->query_generate();
            $customer_data = $this->db->query_fetch();
            $inconv_normal_slot['customer'] = $inconv_normal_slots[$key]['customer'] = $customer_data[0]['customer'];

            $slot_time_from = mktime(intval($inconv_normal_slot['time_from']), bcmod($inconv_normal_slot['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));

            $slot_time_to = mktime(intval($inconv_normal_slot['time_to']), bcmod($inconv_normal_slot['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            //if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '0' || $inconv_normal_slot['type'] == '1' || $inconv_normal_slot['type'] == '2')) {
            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '0') {
                
                $rpt_content_normal[$inconv_normal_slot['date']]['3000']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_normal[$inconv_normal_slot['date']]['3000']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
                
            }
            
            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '1') {
                
                $rpt_content_travell[$inconv_normal_slot['date']]['3001']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_travell[$inconv_normal_slot['date']]['3001']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
                
            }
            
            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '2') {
                
                $rpt_content_break[$inconv_normal_slot['date']]['3002']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_break[$inconv_normal_slot['date']]['3002']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
                
            }
            
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '4')) {
                $rpt_content_over[$inconv_normal_slot['date']]['3004']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_over[$inconv_normal_slot['date']]['3004']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '5')) {
                $rpt_content_quality[$inconv_normal_slot['date']]['3005']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_quality[$inconv_normal_slot['date']]['3005']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '6')) {
                $rpt_content_more[$inconv_normal_slot['date']]['3006']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_more[$inconv_normal_slot['date']]['3006']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '7')) {
                $rpt_content_some[$inconv_normal_slot['date']]['3007']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_some[$inconv_normal_slot['date']]['3007']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '8')) {
                $rpt_content_training[$inconv_normal_slot['date']]['3008']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_training[$inconv_normal_slot['date']]['3008']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '10')) {
                $rpt_content_personal[$inconv_normal_slot['date']]['3009']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_personal[$inconv_normal_slot['date']]['3009']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            
            // TODO: test this
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '3')) {
                $rpt_content_oncall[$inconv_normal_slot['date']]['3000']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_oncall[$inconv_normal_slot['date']]['3000']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '9')) {
                $rpt_content_calltraining[$inconv_normal_slot['date']]['3008']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content_calltraining[$inconv_normal_slot['date']]['3008']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);
            }

            if ($inconv_normal_slot['status'] == 2) {
                
                $leave_type = $this->employeeObj->getLeaveType($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                if($leave_type)
                {
                    
                
                $timeCodeTmp = $leave_type['type']+2000;
                $timeCodeTmp = $leave_type['type']==1 ? 2001 : $timeCodeTmp;
                
                //$rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                //$rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);

                if ($inconv_normal_slot['type'] == '0' || $inconv_normal_slot['type'] == '1' || $inconv_normal_slot['type'] == '2'){
                    
                    $rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                } else if ($inconv_normal_slot['type'] == '4') {
                    $rpt_content_leave_over[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_over[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                } else if ($inconv_normal_slot['type'] == '5') {
                    $rpt_content_leave_quality[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_quality[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                } else if ($inconv_normal_slot['type'] == '6') {
                    $rpt_content_leave_more[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_more[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                } else if ($inconv_normal_slot['type'] == '7') {
                    $rpt_content_leave_some[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_some[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                // TODO: test this
                } else if ($inconv_normal_slot['type'] == '8') {
                    $rpt_content_leave_training[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_training[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                // TODO: test this
                } else if ($inconv_normal_slot['type'] == '10') {
                    $rpt_content_leave_personal[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_personal[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                // TODO: test this
                } else if ($inconv_normal_slot['type'] == '3') {
                    //$timeCodeTmp = '2001.'.$leave_type['type'];
                    $rpt_content_leave_oncall[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_oncall[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                } else if ($inconv_normal_slot['type'] == '9') {
                    //$timeCodeTmp = '2001.'.$leave_type['type'];
                    $rpt_content_leave_calltraining[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    $rpt_content_leave_calltraining[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp);
                }
                }
            }
        }
        //echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
        // process for doubling with normal time value
        $keyLeaveType = 9;
        $rpt_content_all = array(
            &$rpt_content_normal, 
            &$rpt_content_travell,
            &$rpt_content_break,
            &$rpt_content_over, 
            &$rpt_content_quality, 
            &$rpt_content_more, 
            &$rpt_content_some, 
            &$rpt_content_training, 
            &$rpt_content_personal, 
            /*
            &$rpt_content_leave,
            &$rpt_content_leave_over,
            &$rpt_content_leave_quality,
            &$rpt_content_leave_more,
            &$rpt_content_leave_some,
            */
        );
        //echo "<pre>".print_r($rpt_content_all, 1)."</pre>";
        foreach($rpt_content_all as $rpt_key=>$rpt_content)
        {
            if(!is_array($rpt_content))
            {
                continue;
            }

            foreach($rpt_content as $keyNormal=>$valueNormal)
            {
                foreach($valueNormal as $subkeyNormal=>$subvalueNormal)
                {
                    $subkeyNormal = (float) $subkeyNormal;

                    //if(floatval($subkeyNormal)<2000 || (2001.1<=floatval($subkeyNormal) && floatval($subkeyNormal)<2002))
                    if($subkeyNormal<2000)
                    {
                        /*
                        if(!isset($rpt_content_all[$rpt_key][$keyNormal][$rpt_key>=$keyLeaveType ? '2000' : '3000']))
                        {
                            $rpt_content_all[$rpt_key][$keyNormal][$rpt_key>=$keyLeaveType ? '2000' : '3000'] = array();
                        }
                        */
                        foreach($subvalueNormal['times'] as $subsubkeyNormal=>$subsubvalueNormal)
                        {
                            $add_key = $rpt_key < 3 ? $rpt_key:$rpt_key+1;
                            $rpt_content_all[$rpt_key][$keyNormal][$rpt_key>=$keyLeaveType ? '2000' : 3000+$add_key]['total'] += $subsubvalueNormal[2];
                            $rpt_content_all[$rpt_key][$keyNormal][$rpt_key>=$keyLeaveType ? '2000' : 3000+$add_key]['times'][] = $subsubvalueNormal;

                            // update the normal codes
                            if(!isset($subsubvalueNormal[4]))
                            {
                                //$rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal+2000] = $rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal];
                                unset($rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal]);
                                if(empty($rpt_content_all[$rpt_key][$keyNormal]))
                                {
                                    unset($rpt_content_all[$rpt_key][$keyNormal]);
                                }
                            }
                        }
                    }
                }
            }
        }
        
         
        
        // sort the arrays (the date keys)
        ksort($rpt_content_leave);
        ksort($rpt_content_leave_over);
        ksort($rpt_content_leave_quality);
        ksort($rpt_content_leave_more);
        ksort($rpt_content_leave_some);
        ksort($rpt_content_leave_training);
        ksort($rpt_content_leave_personal);
        ksort($rpt_content_leave_oncall);
        ksort($rpt_content_leave_calltraining);
        
        // combine all leaves
        $rpt_content_leave_tmp = $this->combineWorkingHours($rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some,$rpt_content_leave_oncall, $rpt_content_leave_training,$rpt_content_leave_personal, $rpt_content_leave_calltraining);
        $rpt_content_leave = $rpt_content_leave_tmp;
        unset($rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_tmp, $rpt_content_leave_training,$rpt_content_leave_personal, $rpt_content_leave_calltraining);
        ksort($rpt_content_leave);
        //echo "<pre>\n".print_r($rpt_content_leave, 1)."</pre>"; 
        // sorting (needed for Karens)
        foreach($rpt_content_leave as $key_leave => $value_leave)
        {
            uasort($value_leave, array("self", "sortWorkingTimeInFullDay"));
            $rpt_content_leave[$key_leave] = $value_leave;
        }
        
        
        
        
        
        
        
        

        // process the leave for sick, karens, sick2to14 and sick 15to90
        $rpt_content_all = array(
            &$rpt_content_leave,
            
            /*
            &$rpt_content_leave_over,
            &$rpt_content_leave_quality,
            &$rpt_content_leave_more,
            &$rpt_content_leave_some,
            &$rpt_content_leave_oncall,
            */
        );
        $prevDate = '';
        $isKarens = 0;
        $isKarensInterval = 5;
        $maxTimeKarens = 8;
        $maxTimeLeave = 8;
        $leaveDays = 0;
        $leaveMaxDays = 14;
        $leaveMaxDays2 = 90;
        $aKarensExtra = array();
        $karensTime = 0;
       
        
        foreach($rpt_content_all as $rpt_key=>$rpt_content)
        {
            if(!is_array($rpt_content))
            {
                continue;
            }
            foreach($rpt_content as $rpt_date_key=>$rpt_date_value)
            {
                foreach($rpt_date_value as $rpt_content_key=>$rpt_content_value)
                {
                    // convert to float
                    $rpt_content_key = (float) $rpt_content_key;

                    // take out the 2008 code
                    if($rpt_content_key==2008)
                    {
                        unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                        continue;
                    }

                    //if($rpt_content_key=='2000')
                    if($rpt_content_key>=2000 && $rpt_content_key<2002)
                    {
                            
                        if(!empty($prevDate) && $prevDate!=$rpt_date_key)
                        {
                            $startDate = DateTime::createFromFormat('Y-m-d', $prevDate);
                            $endDate = DateTime::createFromFormat('Y-m-d', $rpt_date_key);
                            $intervalDate = $startDate->diff($endDate);

                            if($intervalDate->format('%a')>=$isKarensInterval)
                            {
                                $prevDate = '';
                                $leaveDays = 0;
                                $isKarens = 0;
                            }
                            else
                            {
                                $prevDate = $rpt_date_key;
                                $leaveDays++;
                            }
                        }

                        if(empty($prevDate) || $leaveDays==1)
                        {
                            if(empty($prevDate))
                            {
                                $prevDate = $rpt_date_key;
                                $leaveDays = 1;
                                $isKarens = 1;
                            }

                            // store the date for the extra Karens time
                            $aKarensExtra[0] = $rpt_date_key;

                            // take out the extra time for Karens
                            if(($karensTime+$rpt_content_value['total'])>$maxTimeKarens)
                            {
                                usort($rpt_content_value['times'], array("self", "sortWorkingTimeInDay"));

                                foreach ($rpt_content_value['times'] as $keyTime => $valueTime)
                                {
                                    
                                    if(($karensTime+$valueTime[2])>$maxTimeKarens)
                                    {
                                        if($maxTimeKarens>$karensTime)
                                        {
                                            $rpt_content_value['total'] -= ($valueTime[2]-($maxTimeKarens-$karensTime));
                                            

                                            $valueTimeTmp = $valueTime;
                                            $valueTime[2] = $maxTimeKarens-$karensTime;
                                            $valueTime[1] = $valueTime[0]+$valueTime[2]*3600;

                                            // Karens remaining time moving for the next day
                                            $valueTimeTmp[0] = $valueTime[1];
                                            $valueTimeTmp[2] = number_format(($valueTimeTmp[1]-$valueTimeTmp[0])/3600, 2);
                                            $aKarensExtra[] = $valueTimeTmp;

                                            $karensTime += $valueTime[2];
                                            //$karensTime += $valueTimeTmp[2];/// commented by shaju

                                            unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                        }
                                        else
                                        {
                                            // Karens remaining time moving for the next day
                                            $aKarensExtra[] = $valueTime;
                                            
                                            if($maxTimeKarens == $karensTime)
                                                $rpt_content_value['total'] -= $valueTime[2];
                                            $karensTime += $valueTime[2];
                                            unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times'][$keyTime]);
                                            if(empty($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times']))
                                            {
                                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                            }
                                            unset($rpt_content_value['times'][$keyTime]);
                                            unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                            continue;
                                        }

                                        $rpt_content_value['times'][$keyTime] = $valueTime;
                                    }
                                    else
                                    {
                                        $karensTime += $valueTime[2];
                                       
                                        
                                    }
                                }
                                
                                if(count($rpt_content_value['times']))
                                {
                                    $rpt_content_all[$rpt_key][$rpt_date_key][$rpt_content_key] = $rpt_content_value;
                                }
                            }
                            else
                            {
                                $karensTime += $rpt_content_value['total'];
                                
                            }

                            if($rpt_content_key==2000)
                            {
                                continue;
                            }
                            
                            
                            // delete the current key
                            
                                
                            if(empty($rpt_content_all[$rpt_key][$rpt_date_key]))
                            {
                                unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                            }
                            
                            // delete times from the current day form all other records as well
                            //THE NEXT 4 lines are commented by shaju
                            /*unset($rpt_content_normal[$rpt_date_key]);
                            unset($rpt_content_over[$rpt_date_key]);
                            unset($rpt_content_quality[$rpt_date_key]);
                            unset($rpt_content_more[$rpt_date_key]);
                            unset($rpt_content_some[$rpt_date_key]);*/
                            //SOMETIMES NEEDED SHAJU
                            //unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                        }
                        else
                        {
                            
                            
                            //$leaveTimeCode = '2001';
                            if($leaveDays>1 && $leaveDays<=$leaveMaxDays)
                            {
                                // add Karens remaining time 
                                if(count($aKarensExtra)>1)
                                {
                                    //$leaveTimeCode = '2001';   actual
                                   
                                    //$leaveTimeCode = (String)$rpt_content_key;
                                            

                                    foreach ($aKarensExtra as $keyKarens => $valueKarens)
                                    {
                                        // key 0 is the Karens date, we do not need it here so we skip it
                                        if($keyKarens>0)
                                        {
                                            // add the data in the "$leaveTimeCode" key
                                            
                                            $rpt_content_all[$rpt_key][$rpt_date_key][$valueKarens[5]]['total'] += $valueKarens[2];
                                            $rpt_content_all[$rpt_key][$rpt_date_key][$valueKarens[5]]['times'][] = $valueKarens;
                                        }
                                    }
                                    
                                    
                                    // keep the Karens date
                                    $aKarensExtra = array($aKarensExtra[0]);
                                }

                                if($rpt_content_key==2000)
                                {
                                    $leaveTimeCode = '2001';
                                }
                                else
                                {
                                    continue;
                                }                                
                            }
                            elseif($leaveMaxDays>$leaveDays && $leaveDays<=$leaveMaxDays2)
                            {
                                if($rpt_content_key==2000)
                                {
                                    $leaveTimeCode = '2001.0';
                                }
                                else
                                {
                                    continue;
                                }
                            }
                            elseif($leaveDays>$leaveMaxDays2)
                            {
                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                if(empty($rpt_content_all[$rpt_key][$rpt_date_key]))
                                {
                                    unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                                }
                                continue;
                            }
                            else
                            {
                                continue;
                            }

                            /*
                            // take out the extra time for the day
                            if($rpt_content_value['total']>$maxTimeLeave)
                            {
                                usort($rpt_content_value['times'], array("self", "sortWorkingTimeInDay"));

                                $leaveTime = 0;
                                foreach ($rpt_content_value['times'] as $keyTime => $valueTime)
                                {
                                    if(($leaveTime+$valueTime[2])>$maxTimeLeave)
                                    {
                                        $valueTime[2] = $valueTime[2]-($leaveTime+$valueTime[2]-$maxTimeLeave);

                                        if($valueTime[2]>0)
                                        {
                                            $valueTime[1] = $valueTime[0]+$valueTime[2]*3600;
                                        }
                                        else
                                        {
                                            unset($rpt_content_value['times'][$keyTime]);
                                            continue;
                                        }

                                        $rpt_content_value['times'][$keyTime] = $valueTime;
                                    }

                                    $leaveTime += $valueTime[2];
                                }

                                $rpt_content_value['total'] = $leaveTime;
                            }
                            */

                            /*
                            // create the "$leaveTimeCode" key if it does not exist
                            if(!isset($rpt_content_all[$rpt_key][$rpt_date_key][$leaveTimeCode]))
                            {
                                $rpt_content_all[$rpt_key][$rpt_date_key][$leaveTimeCode] = array();
                            }
                            */

                            // add the data in the "$leaveTimeCode" key
                            $rpt_content_all[$rpt_key][$rpt_date_key][$leaveTimeCode]['total'] += $rpt_content_value['total'];
                            foreach ($rpt_content_value['times'] as $keyTime => $valueTime)
                            {
                                $rpt_content_all[$rpt_key][$rpt_date_key][$leaveTimeCode]['times'][] = $valueTime;
                            }

                            // delete the "2000" key that was the source
                            //unset($rpt_content_all[$rpt_key][$rpt_date_key]['2000']);
                            if($rpt_content_key!=$leaveTimeCode)
                            {
                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                if(empty($rpt_content_all[$rpt_key][$rpt_date_key]))
                                {
                                    unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                                }                                
                            }
                        }
                    }
                }
            }
        } 
       
        
        
        
        
        // Karens post-processing
        
        if(isset($aKarensExtra[0]) && !empty($aKarensExtra[0]))
        {
                foreach($rpt_content_leave[$aKarensExtra[0]] as $rpt_content_key=>$rpt_content_value)
            {
                // convert to float
                $rpt_content_key = (float) $rpt_content_key;
                

                if($rpt_content_key!=2000)
                {
                    $rpt_content_leave[$aKarensExtra[0]]['2000']['total'] += $rpt_content_value['total'];
                    if(!isset($rpt_content_leave[$aKarensExtra[0]]['2000']['times']))
                    {
                        $rpt_content_leave[$aKarensExtra[0]]['2000']['times'] = array();
                    }
                    $rpt_content_leave[$aKarensExtra[0]]['2000']['times'] = array_merge($rpt_content_leave[$aKarensExtra[0]]['2000']['times'], $rpt_content_value['times']);

                    unset($rpt_content_leave[$aKarensExtra[0]][(string) $rpt_content_key]);
                }
                
            }
            $i_karen = 0;
            $post_date = $aKarensExtra[0];
            foreach ($aKarensExtra as $shift_values){
                if($i_karen == 0){
                    $i_karen++;
                    $post_date = date('Y-m-d', strtotime('+1 day', strtotime($post_date)));
                }    
                else{
                    
                    $i_karen++;
                    $rpt_content_leave[$post_date][$shift_values[5]]['total'] += $shift_values[2];
                    
                    if(!isset($rpt_content_leave[$post_date][$shift_values[5]]['times']))
                    {
                        $rpt_content_leave[$post_date][$shift_values[5]]['times'] = array();
                    }
                    $rpt_content_leave[$post_date][$shift_values[5]]['times'] = array_merge($rpt_content_leave[$post_date][$shift_values[5]]['times'], array($shift_values));
                }
                    
                
                
            }
            
        }
//         echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
//        echo "----------------------------------------------------------------" ;
//        echo "<pre>".print_r($aKarensExtra, 1)."</pre>";
//        echo "----------------------------------------------------------------" ;
       
        
        foreach($rpt_content_all as $rpt_key=>$rpt_content)
        {
            if(!is_array($rpt_content))
            {
                continue;
            }

            foreach($rpt_content as $keyNormal=>$valueNormal)
            {
                foreach($valueNormal as $subkeyNormal=>$subvalueNormal)
                {
                    $subkeyNormal = (float) $subkeyNormal;

                    //if(floatval($subkeyNormal)<2000 || (2001.1<=floatval($subkeyNormal) && floatval($subkeyNormal)<2002))
                    if($subkeyNormal > 2001 && $subkeyNormal < 2002)
                    {
                       
                        foreach($subvalueNormal['times'] as $subsubkeyNormal=>$subsubvalueNormal)
                        {
                            $rpt_content_all[$rpt_key][$keyNormal]['2001']['total'] += $subsubvalueNormal[2];
                            $rpt_content_all[$rpt_key][$keyNormal]['2001']['times'][] = $subsubvalueNormal;

                            // update the normal codes
                            if(!isset($subsubvalueNormal[4]))
                            {
                                //$rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal+2000] = $rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal];
                                unset($rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal]);
                                if(empty($rpt_content_all[$rpt_key][$keyNormal]))
                                {
                                    unset($rpt_content_all[$rpt_key][$keyNormal]);
                                }
                            }
                        }
                    }
                }
            }
        }
        
        //echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
        //for taking FP and SEM values to 1
        
        foreach($rpt_content_leave as $key_leave => $value_leave)
        {
            foreach($value_leave as $key_time => $key_time_array){
                if($key_time == '2002' || $key_time == '2004'){
                    $rpt_content_leave[$key_leave][$key_time]['total'] = 1;
                    $loop_i = 0;
                    foreach($key_time_array['times'] as $key_cust_time => $cust_time_array){
                        if($loop_i == 0){
                            $rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time][2] = 1;
                            $rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time][0] = 0;
                            $rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time][1] = 0;
                        }else{
                            unset($rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time]);
                        }
                        $loop_i++;
                        
                    } 
                }
                  
            }
        }
        
        
        
        
        
        
    }

    public function toVisma600($return = false, $date = null, $c_list = null, $userSigned = array())
    {
        //$smarty = new smartySetup(array('export-config.xml'));
        $smarty = new smartySetup(array('export-config.xml', "user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml", "gdschema.xml"));

        // leaves
        list($donaYear, $donaMonth) = explode('-', date('Y-n', $date[0]));
        $leave = new dona();
        $this->leaves = $leave->get_all_employee_leave($donaYear, $donaMonth);
        unset($leave, $donaYear, $donaMonth);
        
        
        //wrote by shaju commenetd because not tested
//        $this->leaves = $leave->get_all_employee_leave_for_export($donaYear, $donaMonth);
//        unset($leave, $donaYear, $donaMonth);
        
        // time codes
        $this->timeCodes = self::getTimingList($smarty);

        // company details
        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        // orgNo formating 
        $company_details['org_no'] = preg_replace('/[^0-9]/i', '', $company_details['org_no']);
        $company_details['org_no'] = substr($company_details['org_no'], 0, 6) . '-' . substr($company_details['org_no'], 6);
        unset($user);

        $this->db->flush();
        $xmlDoc = new DOMDocument();
        $xmlDoc->formatOutput = true;
        $xmlDoc->encoding = 'ISO-8859-1';
        //$xmlDoc->encoding = 'utf-8';
        $rootElement = $xmlDoc->createElement('SalaryData');
        $rootElement->setAttribute('ProgramName', 'Time2View');
        $rootElement->setAttribute('Version', '12.41 2011-01-10');
        $rootElement->setAttribute('ExportVersion', '1.3');
        $rootElement->setAttribute('Created', date(self::VISMA_DATE_FORMAT));
        $rootElement->setAttribute('Type', 'SalaryData');
        $rootElement->setAttribute('Language', 'Swedish'); // TODO: Get from system settings?
        $rootElement->setAttribute('CompanyName', $company_details['name']);
        $rootElement->setAttribute('OrgNo', $company_details['org_no']);
        $rootElement->setAttribute('Imported', 0);
        $rootElement->setAttribute('BookDistributionProject', 1);
        $rootElement->setAttribute('BookDistributionResultUnit', 1);


        // TAG: TimeCodes
        $timeCodes = $xmlDoc->createElement('TimeCodes');
        foreach ($this->timeCodes as $tItem)
        {
            if(!empty($tItem['name']) && !empty($tItem['id_external']))
            {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['id_external']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                //$tc->setAttribute('AbsenceType', isset($tItem['leave']) ? 1 : 0);
                //$tc->setAttribute('RegularWorkingTime', isset($tItem['leave']) ? 0 : 1);
                //$tc->setAttribute('ConversionFactorTime', '');
                //$tc->setAttribute('Active', 1);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        
        $timeCodes = $xmlDoc->createElement('TimeCodes');
        foreach ($this->timeCodes as $tItem)
        {
            if(!empty($tItem['name']) && !empty($tItem['id_monthly']))
            {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['id_monthly']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                //$tc->setAttribute('AbsenceType', isset($tItem['leave']) ? 1 : 0);
                //$tc->setAttribute('RegularWorkingTime', isset($tItem['leave']) ? 0 : 1);
                //$tc->setAttribute('ConversionFactorTime', '');
                //$tc->setAttribute('Active', 1);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        // TAG: TimeCodes - end

        // TAG: Projects
        $Projects = $xmlDoc->createElement('Projects');
        /*
        if(isset($c_list) && is_array($c_list))
        {
            foreach($c_list as $keyProject=>$valueProject)
            {
                if(!empty($valueProject['code']))
                {
                    $Project = $xmlDoc->createElement('Project');
                    $Project->setAttribute('Code', $valueProject['code']);
                    $Project->setAttribute('Description', $valueProject['first_name'].' '.$valueProject['last_name']);
                    $Projects->appendChild($Project);
                }
            }
        }
        */
        $projectsData = $rootElement->appendChild($Projects);
        // TAG: Projects - end

        // TAG: ResultUnits
        $ResultUnits = $xmlDoc->createElement('ResultUnits');
        /*
        if(isset($c_list) && is_array($c_list))
        {
            foreach($c_list as $keyProject=>$valueProject)
            {
                $ResultUnit = $xmlDoc->createElement('ResultUnit');
                $ResultUnit->setAttribute('Code', $valueProject['code']);
                $ResultUnit->setAttribute('Description', $valueProject['first_name'].' '.$valueProject['last_name']);
                $ResultUnits->appendChild($ResultUnit);
            }
        }
        */
        $resultUnitsData = $rootElement->appendChild($ResultUnits);
        // TAG: ResultUnits - end

        $salaryDataEmployee = $xmlDoc->createElement('SalaryDataEmployee');
        if(isset($date[0]) && isset($date[1]))
        {
            $salaryDataEmployee->setAttribute('FromDate', date(self::VISMA_DATE_FORMAT, $date[0]));
            $salaryDataEmployee->setAttribute('ToDate', date(self::VISMA_DATE_FORMAT, $date[1]));
        }
        $salaryData = $rootElement->appendChild($salaryDataEmployee);
        $employeeTimes = array();

        if(isset($c_list) && is_array($c_list))
        {
            $customer_list = array();

            foreach($c_list as $c_list_item)
            {
                $customer_list[$c_list_item['username']] = $c_list_item;
            }
        }


        $userSignedEmp = array();

        foreach ($this->result as $keyResult=>$employes)
        {
            foreach ($employes['employee'] as $keyEmployee=>$employee)
            {
                if(count($userSigned) && !in_array($employee['emp_username'], $userSigned))
                {
                    unset($this->result[$keyResult]['employee'][$keyEmployee]);
                    continue;
                }

                $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
                $this->db->tables = array('employee');
                $this->db->conditions = array('username="'.$employee['emp_username'].'"');

                $empData = $this->db->query_fetch();

                // TAG: Employee
                $empTag = $xmlDoc->createElement('Employee');
                $empTag->setAttribute('EmploymentNo', $empData[0]['code']);
                $empTag->setAttribute('Signature', mb_substr($empData[0]['first_name'], 0, 1).mb_substr($empData[0]['last_name'], 0, 1));
                $empTag->setAttribute('FirstName', $empData[0]['first_name']);
                $empTag->setAttribute('Name', $empData[0]['last_name']);
                //$empTag->setAttribute('PersonalNo', substr($empData[0]['social_security'], 0, 6).'-'.substr($empData[0]['social_security'], -4));
                $empTag->setAttribute('PersonalNo', $empData[0]['century'].$empData[0]['social_security']);
                $empTag->setAttribute('HourlyWage', '0');
                $empTag->setAttribute('EmplCategory', '1');
                $empTag->setAttribute('FromDate', date(self::VISMA_DATE_FORMAT, $this->meta['fromDate']));
                $empTag->setAttribute('ToDate', date(self::VISMA_DATE_FORMAT, $this->meta['toDate']));
                // TAG: Employee - end

                // TAG: NormalWorkingTimes
                $normalWorkingTimes = $this->generateNormalWorkingTimes($this->meta['fromDate'], $this->meta['toDate'], $xmlDoc);
                $empTag->appendChild($normalWorkingTimes);
                // TAG: NormalWorkingTimes - end

                if(isset($employee['customer']) && isset($customer_list[$employee['customer']]))
                {
                    $employee['customer'] = $customer_list[$employee['customer']]['code'];
                }

                $data = $this->convEmployee($employee, $employes['week']);

                $userSignedEmp[$employee['emp_username']] = $empTag;

                $employeeTimes[$empData[0]['social_security']]['tag'] = $empTag;
                $employeeTimes[$empData[0]['social_security']]['times'] = !is_array($employeeTimes[$empData[0]['social_security']]['times']) ? array() : $employeeTimes[$empData[0]['social_security']]['times'];
                $employeeTimes[$empData[0]['social_security']]['times'] = array_merge($employeeTimes[$empData[0]['social_security']]['times'], $data);
            }
        }

        $month = $this->exportMonth;
        $yr = $this->exportYear;
        
        foreach ($userSigned as $key => $value)
        {
            //if($value == 'majo011'){
            $rpt_content_normal         = array();
            $rpt_content_travell        = array();
            $rpt_content_break          = array();
            $rpt_content_oncall         = array();
            $rpt_content_leave          = array();
            $rpt_content_leave_over     = array();
            $rpt_content_leave_quality  = array();
            $rpt_content_leave_more     = array();
            $rpt_content_leave_some     = array();
            $rpt_content_leave_training    = array();
            $rpt_content_leave_oncall   = array();
            $rpt_content_over           = array();
            $rpt_content_quality        = array();
            $rpt_content_more           = array();
            $rpt_content_some           = array();
            $rpt_content_training       = array();
            $rpt_content_personal       = array();
            $rpt_content_calltraining   = array();
            $rpt_content_leave_personal       = array();
            $rpt_content_leave_calltraining   = array();
            $passed_employee            = $value;

            $this->bookDistributionProjects = array();
            $this->bookDistributionProjectsSum = 0;
            $salary_mod = $this->get_salary_mod($value);

            //$month = 9;
            //$passed_employee = 'joni001';

            $this->processWorkingTime($passed_employee, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break);
/*
//if($passed_employee=='emsv003')
{
echo 'rpt_content_normal';
print_r($rpt_content_normal);
echo 'rpt_content_over';
print_r($rpt_content_over);
echo 'rpt_content_quality';
print_r($rpt_content_quality);
echo 'rpt_content_more';
print_r($rpt_content_more);
echo 'rpt_content_some';
print_r($rpt_content_some);
echo 'rpt_content_oncall';
print_r($rpt_content_oncall);
echo 'rpt_content_leave';
print_r($rpt_content_leave);
//echo 'rpt_content_leave_over';
//print_r($rpt_content_leave_over);
//echo 'rpt_content_leave_quality';
//print_r($rpt_content_leave_quality);
//echo 'rpt_content_leave_more';
//print_r($rpt_content_leave_more);
//echo 'rpt_content_leave_some';
//print_r($rpt_content_leave_some);
//echo 'rpt_content_leave_oncall';
//print_r($rpt_content_leave_oncall);
echo "\n\n\n";

//die();    
}
*/
            
            
            // TAG: Times
            //echo "<pre>".print_r($rpt_content_oncall, 1)."</pre>";
            $times = $xmlDoc->createElement('Times');

            $rpt_content_all = array(
                $rpt_content_normal, 
                $rpt_content_travell,
                $rpt_content_break,
                $rpt_content_over, 
                $rpt_content_quality, 
                $rpt_content_more, 
                $rpt_content_some,
                $rpt_content_training,
                $rpt_content_personal,
                $rpt_content_oncall, 
                $rpt_content_calltraining,
                $rpt_content_leave,
                /*
                $rpt_content_leave_over,
                $rpt_content_leave_quality,
                $rpt_content_leave_more,
                $rpt_content_leave_some,
                $rpt_content_leave_oncall,
                */
            );
            
            //echo "<pre>\n".print_r($rpt_content_all, 1)."</pre>";
            // free up some memory
            unset($rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal,$rpt_content_calltraining, $rpt_content_leave_training,$rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break);

            $iWriteEmployee = 0;
            foreach($rpt_content_all as $key_array => $rpt_content)
            {
                
                if(!is_array($rpt_content) || count($rpt_content)==0)
                {
                    continue;
                }

                foreach($rpt_content as $keyDate=>$valueDate)
                {
                    if(!is_array($valueDate))
                    {
                        continue;
                    }
                    
                    foreach($valueDate as $timeCode=>$timeValue)
                    {
                        if(!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times']))
                        {
                            continue;
                        }
                        
                        foreach($timeValue['times'] as $keyTimeValue=>$valueTimeValue)
                        {
                            //if(!empty($customer_list[$valueTimeValue[3]]['code']))
                            //{
                                // TAG: Time
                                $time = $xmlDoc->createElement('Time');
                                $time->setAttribute('DateOfReport', $keyDate);
                                if($key_array == 10){
                                    $time->setAttribute('TimeCode', $this->identifyTimeCode($timeCode.'.1',0,$salary_mod));
                                }
                                else{
//                                    if($key_array == 8){
//                                        $time->setAttribute('TimeCode', $this->identifyTimeCode($timeCode,0,$salary_mod));
//                                        echo $timeCode."<br>".$this->identifyTimeCode($timeCode,0,$salary_mod)."<br>";
//                                    }
                                    $time->setAttribute('TimeCode', $this->identifyTimeCode($timeCode,0,$salary_mod));
                                }    
                                $time->setAttribute('SumOfHours', $valueTimeValue[2]);
                                $time->setAttribute('TimeStart', date('H.i', (int)$valueTimeValue[0]));
                                $time->setAttribute('TimeEnd', str_replace('00.00', '24.00', date('H.i', (int)$valueTimeValue[1])));
                                //$time->setAttribute('ProjectCode', $customer_list[$valueTimeValue[3]]['code']);
                                $time->setAttribute('ResultUnit', $customer_list[$valueTimeValue[3]]['code']);
                                // TAG: Time - end

                                $times->appendChild($time);

                                // for BookDistributionProjects TAG
                                /*
                                $this->bookDistributionProjects[$customer_list[$valueTimeValue[3]]['code']] += $this->identifyTimeCode($timeCode);
                                $this->bookDistributionProjectsSum += $this->identifyTimeCode($timeCode);
                                */
                                $this->bookDistributionProjects[$customer_list[$valueTimeValue[3]]['code']] += $valueTimeValue[2];
                                $this->bookDistributionProjectsSum += $valueTimeValue[2];

                                $iWriteEmployee = 1;
                            //}
                        }
                    }
                }                
            }

            // no valid / complete time data stored do not write the info in the export
            if($iWriteEmployee==0)
            {
                continue;
            }
            
            $empTag = $userSignedEmp[$value];
            $empTag->appendChild($times);
            // TAG: Times - end

            // TAG: TimeAdjustments
            $timeAdjustments = $xmlDoc->createElement('TimeAdjustments');
            $empTag->appendChild($timeAdjustments);
            // TAG: TimeAdjustments - end

            // TAG: TimeBalances
            $timeBalances = $xmlDoc->createElement('TimeBalances');
            $timeBalance = $xmlDoc->createElement('TimeBalances');
            $timeBalance->setAttribute('TimeCode', '##SumComp##');
            $timeBalance->setAttribute('PeriodRegHours', '');
            $timeBalance->setAttribute('ConvPeriodRegHours', '0.00');
            $timeBalance->setAttribute('AccRegHours', '');
            $timeBalance->setAttribute('ConvAccRegHours', '0.00');
            $timeBalances->appendChild($timeBalance);
            $empTag->appendChild($timeBalances);
            // TAG: TimeBalances - end

            // TAG: BookDistributionProjects
            $bookDistributionProjects = $xmlDoc->createElement('BookDistributionProjects');
            $bookDistributionResultUnits = $xmlDoc->createElement('BookDistributionResultUnits');
            foreach($this->bookDistributionProjects as $keyBook=>$valueBook)
            {
                $bookDistributionProject = $xmlDoc->createElement('BookDistributionProject');
                $bookDistributionProject->setAttribute('ProjectCode', $keyBook);
                $bookDistributionProject->setAttribute('Distribution', number_format($valueBook*100/$this->bookDistributionProjectsSum, 6));
                $bookDistributionProjects->appendChild($bookDistributionProject);
                
                $bookDistributionResultUnit = $xmlDoc->createElement('BookDistributionResultUnit');
                $bookDistributionResultUnit->setAttribute('ResultUnitCode', $keyBook);
                $bookDistributionResultUnit->setAttribute('Distribution', number_format($valueBook*100/$this->bookDistributionProjectsSum, 6));
                $bookDistributionResultUnits->appendChild($bookDistributionResultUnit);

                // save the used project in the "project" node
                if(isset($c_list) && is_array($c_list))
                {
                    foreach($c_list as $keyProject=>$valueProject)
                    {
                        if(!empty($valueProject['code']) && $valueProject['code']==$keyBook)
                        {
                            $Project = $xmlDoc->createElement('Project');
                            $Project->setAttribute('Code', $valueProject['code']);
                            $Project->setAttribute('Description', $valueProject['first_name'].' '.$valueProject['last_name']);
                            $projectsData->appendChild($Project);

                            $ResultUnit = $xmlDoc->createElement('ResultUnit');
                            $ResultUnit->setAttribute('Code', $valueProject['code']);
                            $ResultUnit->setAttribute('Description', $valueProject['first_name'].' '.$valueProject['last_name']);
                            $resultUnitsData->appendChild($ResultUnit);

                            //
                            unset($c_list[$keyProject]);
                            break;
                        }
                    }
                }                
            }
            $empTag->appendChild($bookDistributionProjects);
            // TAG: BookDistributionProjects - end

            // TAG: BookDistributionResultUnits
            
           
            $empTag->appendChild($bookDistributionResultUnits);
            // TAG: BookDistributionResultUnits - end

            // TAG: RegOutlays
            $regOutlays = $xmlDoc->createElement('RegOutlays');
            $empTag->appendChild($regOutlays);
            // TAG: RegOutlays - end

            // add Employee TAG to SalaryDataEmployee TAG
            $salaryData->appendChild($empTag);
        
        //}
        }
    
//die();
        // finish
        $xmlDoc->appendChild($rootElement);

        if ($return)
        {
            return $xmlDoc->saveXml();
        }
        else
        {
            echo $xmlDoc->saveXml();
        }
    }

    public function toVismaPay($return = false, $date = null, $customer = null)
    {
        $sOutput = '
#FLAGGA 0
#PROGRAM "Time2View"
#SKAPAD '.date(self::VISMA_PAY_DATE_FORMAT).'
#ORGNR 556694-1554
#FTGNAMN "firma AB"
'.(isset($date[0]) ? '#PERIODFROM '.date(self::VISMA_PAY_DATE_FORMAT, $date[0]) : '').'
'.(isset($date[1]) ? '#PERIODTOM '.date(self::VISMA_PAY_DATE_FORMAT, $date[1]) : '').'
        ';
        $this->db->flush();
        $incTiming = new inconvenient_timing();
        $inconvenientTimingList = $incTiming->inconvenient_timing_list();
        $inconvenientTimingList = !is_array($inconvenientTimingList) ? array() : $inconvenientTimingList;
        $holidayTimingList = $incTiming->holiday_timing_list();
        $holidayTimingList = !is_array($holidayTimingList) ? array() : $holidayTimingList;

        $i = 0;
        $list = array_merge($inconvenientTimingList, $holidayTimingList);

        $employeeTimes = array();

        foreach ($this->result as $employes)
        {
            foreach ($employes['employee'] as $employee)
            {
                $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
                $this->db->tables = array('employee');
                $this->db->conditions = array('username="'.$employee['emp_username'].'"');

                $empData = $this->db->query_fetch();
                $data = $this->convEmployee($employee, $employes['week']);

                $employeeTimes[$empData[0]['social_security']]['tag'] = array(
                    'EmploymentNo'  => $empData[0]['code'],
                    'Signature'     => mb_substr($empName[0], 0, 1).mb_substr($empName[1], 0, 1),
                    'FirstName'     => $empName[0],
                    'Name'          => $empName[1],
                    //'PersonalNo'  => substr($empData[0]['social_security'], 0, 6).'-'.substr($empData[0]['social_security'], -4),
                    'PersonalNo'    => $empData[0]['century'].$empData[0]['social_security'],
                    'HourlyWage'    => '0',
                    'FromData'      => date(self::VISMA_PAY_DATE_FORMAT, $this->meta['fromDate']),
                    'ToData'        => date(self::VISMA_PAY_DATE_FORMAT, $this->meta['toDate']),
                );
                $employeeTimes[$empData[0]['social_security']]['times'] = !is_array($employeeTimes[$empData[0]['social_security']]['times']) ? array() : $employeeTimes[$empData[0]['social_security']]['times'];
                $employeeTimes[$empData[0]['social_security']]['times'] = array_merge($employeeTimes[$empData[0]['social_security']]['times'], $data);
            }       
        }

        foreach($employeeTimes as $key=>$value)
        {
            $this->times = array();
            array_walk($value['times'], array($this, 'walkDataNonXML'));

            $sOutput .= '
#ANST '.$value['tag']['EmploymentNo'].'
#PNR '.$value['tag']['PersonalNo'];

            if(is_array($this->times) && count($this->times))
            {
                $sOutput .= '
{';

                foreach($this->times as $key1 => $value1)
                {           
                    $sOutput .= '
    #LART '.$value1['TimeCode'].' '.$value1['SumOfHours'].' 0.00
    [
    ]
                    ';              
                }

                $sOutput .= '
}';
            }
        }

        if ($return)
            return $sOutput;
        else
            echo $sOutput;
    }

    public function toHogiaXML($return = false, $date = null, $c_list = null, $userSigned = array())
    {
        $smarty = new smartySetup(array('export-config.xml'));

        $this->db->flush();
        $xmlDoc = new DOMDocument();
        $xmlDoc->formatOutput = true;
        $xmlDoc->encoding = 'utf-8';
        $rootElement = $xmlDoc->createElement('l√∂neberedning');
        $rootElement->setAttribute('xmlns', 'http://www.hogia.se/XMLSchemas/lon/2005/loneberedningsimport/1');

        // TAG: f√∂retag
        $org = $rootElement->appendChild($xmlDoc->createElement('f√∂retag'));
        $org->appendChild($xmlDoc->createElement('namn', 'Time2View'));
        // TAG: f√∂retag - end

        // TAG: program
        $rootElement->appendChild($xmlDoc->createElement('program', 'Time2View'));
        // TAG: program - end

        // TAG: datum
        $rootElement->appendChild($xmlDoc->createElement('datum', date('Y-m-d')));
        // TAG: datum - end

        // TAG: transaktioner
        $transaktioner = $rootElement->appendChild($xmlDoc->createElement('transaktioner'));
        $thisResults = array();

        // process the times
        foreach ($this->result as $employes)
        {
            foreach ($employes['employee'] as $emp)
            {
                $thisResults[$emp['emp_username']]['emp'] = $emp;
                $data = $this->convEmployee($emp, $employes['week']);

                foreach ($data as $keyData => $valueData)
                {
                    $timeWorked = 0;
                    foreach($valueData['times'] as $keyTimes => $valueTimes)
                    {
                        $timeMinutes = floor($valueTimes['work']-floor($valueTimes['work']))*100;
                        // add the hours worked transformed in minuntes
                        $timeWorked += (floor($valueTimes['work'])*60 + $timeMinutes);
                    }

                    if($timeWorked)
                    {
                        $timeHours = floor($timeWorked/60);
                        $thisResults[$emp['emp_username']]['times'][$keyData] = $timeHours+($timeWorked-$timeHours*60)/100;
                    }
                }
            }
        }

        foreach ($thisResults as $emp)
        {
            // skip employees with no working time
            if(!is_array($emp['times']))
            {
                continue;
            }
            //commente by shaju and added after lines
            /*$empName = explode(' ', $emp['emp']['name']);
            $this->db->fields = array('code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone');
            $this->db->tables = array('employee');
            $this->db->conditions = array('AND', 'first_name="'.$empName[0].'"', 'last_name="'.$empName[1].'"');
            $empData = $this->db->query_fetch();*/
            
            
            $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
            $this->db->tables = array('employee');
            $this->db->conditions = array('username="'.$employee['emp_username'].'"');

            $empData = $this->db->query_fetch();

            // skip if no "code"
            /*
            if(!is_array($empData[0]['code']))
            {
                continue;
            }
            */

            $schema = $xmlDoc->createElement('schema');
            $schema->setAttribute('anstid', utf8_encode($empData[0]['code']));

            $timeTotal = 0;
            foreach ($emp['times'] as $keyTimes => $valueTime)
            {
                $timeMinutes = floor($valueTime-floor($valueTime))*100;
                // add the hours worked transformed in minuntes
                $timeTotal += (floor($valueTime)*60 + $timeMinutes);
            }

            // convert from minutes to hours.minutes
            $timeHours = floor($timeTotal/60);
            $timeTotal = $timeHours+($timeTotal-$timeHours*60)/100;

            // TAG: transaktion
            $transaktion = $xmlDoc->createElement('transaktion');
                // TAG: anst√§llningsnummer
                //ssssssssssssssssssssss$anst√§llningsnummer = $xmlDoc->createElement('anst√§llningsnummer', utf8_encode($empData[0]['code']));
                // TAG: anst√§llningsnummer - end

                // TAG: l√∂neart
                //sssssssssssssssssss$l√∂neart = $xmlDoc->createElement('l√∂neart', '');
                // TAG: l√∂neart - end

                // TAG: resultatenhet
                $resultatenhet = $xmlDoc->createElement('resultatenhet', 'ett');
                // TAG: resultatenhet - end

                // TAG: projekt
                $projekt = $xmlDoc->createElement('projekt', $empName[0].' '.$empName[1]);
                // TAG: projekt - end

                // TAG: belopp
                $belopp = $xmlDoc->createElement('belopp');
                    // TAG: totalt
                    $totalt = $xmlDoc->createElement('totalt', $timeTotal);
                    // TAG: totalt - end
                $belopp->appendChild($totalt);
                // TAG: belopp - end
                
                // TAG: startdatum
                $startdatum = $xmlDoc->createElement('startdatum', date(self::VISMA_DATE_FORMAT, $date[0]));
                // TAG: startdatum - end

                // TAG: slutdatum
                $slutdatum = $xmlDoc->createElement('slutdatum', date(self::VISMA_DATE_FORMAT, $date[1]));
                // TAG: slutdatum - end

                // TAG: konto
                $konto = $xmlDoc->createElement('konto', '');
                // TAG: konto - end
            //$transaktion->appendChild($anst√§llningsnummer);
            //$transaktion->appendChild($l√∂neart);
            $transaktion->appendChild($resultatenhet);
            $transaktion->appendChild($projekt);
            $transaktion->appendChild($belopp);
            $transaktion->appendChild($startdatum);
            $transaktion->appendChild($slutdatum);
            //$transaktion->appendChild($konto);
            // TAG: transaktion - end
            
            $transaktioner->appendChild($transaktion);
        }

        $rootElement->appendChild($transaktioner);
        $xmlDoc->appendChild($rootElement);

        if ($return)
            return $xmlDoc->saveXml();
        else
            echo $xmlDoc->saveXml();
    }

    public function toHogia($return = false, $date = null, $c_list = null, $userSigned = array())
    {
        $smarty = new smartySetup(array('export-config.xml'));
        $userSignedEmp = array();
        $customer_list = array();
        // time codes
        $this->timeCodes = self::getTimingList($smarty);

        
        foreach ($this->result as $keyResult=>$employes)
        {
            foreach ($employes['employee'] as $keyEmployee=>$employee)
            {
                if(count($userSigned) && !in_array($employee['emp_username'], $userSigned))
                {
                    unset($this->result[$keyResult]['employee'][$keyEmployee]);
                    continue;
                }

                $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
                $this->db->tables = array('employee');
                $this->db->conditions = array('username="'.$employee['emp_username'].'"');

                $empData = $this->db->query_fetch();
                $userSignedEmp[$employee['emp_username']] = $empData[0];
            }
        }

        $this->db->flush();
        $output = '';
        //echo "<pre>".print_r($userSignedEmp, 1)."</pre>";
        // data for "dimensioner" and "resultatenheter"
        if(isset($c_list) && is_array($c_list))
        {
            foreach($c_list as $keyProject=>$valueProject)
            {
                if(!empty($valueProject['code']))
                {
                    // other things
                    $customer_list[$valueProject['username']] = $valueProject;
                }
            }
        }

        $month = $this->exportMonth;
        $yr = $this->exportYear;

        foreach ($userSigned as $key => $value)
        {
            //if($value == 'jost001'){
            $rpt_content_normal         = array();
            $rpt_content_travell        = array();
            $rpt_content_break          = array();
            $rpt_content_oncall         = array();
            $rpt_content_leave          = array();
            $rpt_content_leave_over     = array();
            $rpt_content_leave_quality  = array();
            $rpt_content_leave_more     = array();
            $rpt_content_leave_some     = array();
            $rpt_content_leave_oncall   = array();
            $rpt_content_over           = array();
            $rpt_content_quality        = array();
            $rpt_content_more           = array();
            $rpt_content_some           = array();
            $rpt_content_training       = array();
            $rpt_content_personal       = array();
            $rpt_content_calltraining   = array();
            $rpt_content_leave_training = array();
            $rpt_content_leave_personal = array();
            $rpt_content_leave_calltraining = array();
            $passed_employee            = $value;
            $salary_mod = $this->get_salary_mod($value);

            $this->processWorkingTime($passed_employee, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break);

            $timePerTimeCode = array();
            $rpt_content_all = array(
                $rpt_content_normal,
                $rpt_content_travell,
                $rpt_content_break,
                $rpt_content_over, 
                $rpt_content_quality, 
                $rpt_content_more, 
                $rpt_content_some,
                $rpt_content_training,
                $rpt_content_personal,
                $rpt_content_oncall,
                $rpt_content_calltraining,
                $rpt_content_leave,
                /*
                $rpt_content_leave_over,
                $rpt_content_leave_quality,
                $rpt_content_leave_more,
                $rpt_content_leave_some,
                $rpt_content_leave_oncall,
                */
            );
            
            unset($rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall,$rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break);
            foreach($rpt_content_all as $key_array => $rpt_content)
            {
                if(!is_array($rpt_content))
                {
                    continue;
                }

                foreach($rpt_content as $keyDate=>$valueDate)
                {
                    if(!is_array($valueDate))
                    {
                        continue;
                    }

                    foreach($valueDate as $timeCode=>$timeValue)
                    {
                        if(!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times']))
                        {
                            continue;
                        }

                        foreach($timeValue['times'] as $keyTimeValue=>$valueTimeValue)
                        {
                            if(!empty($customer_list[$valueTimeValue[3]]['code']))
                            {
                                $timePerTimeCode[$timeCode]['total'] += $valueTimeValue[2];
                                //$timePerTimeCode[$timeCode]['clients'][$valueTimeValue[3]] = 1;
                                $timePerTimeCode[$timeCode]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];
                                //$timePerTimeCode[$timeCode]['dates'][$keyDate][$valueTimeValue[3]] += $valueTimeValue[2];
                            }
                        }
                    }
                }                
            }            
            
            $userSignedEmp[$value]['code'] = preg_replace('/[^0-9]/i', '', $userSignedEmp[$value]['code']);
            $userSignedEmp[$value]['social_security'] = preg_replace('/[^0-9]/i', '', $userSignedEmp[$value]['social_security']);
            $userSocialSecurity = substr($userSignedEmp[$value]['social_security'], 0, 6) . '-' . substr($userSignedEmp[$value]['social_security'], 6);
            $output .= utf8_decode("; {$userSocialSecurity} {$userSignedEmp[$value]['first_name']} {$userSignedEmp[$value]['last_name']} {$userSignedEmp[$value]['address']} {$userSignedEmp[$value]['city']}")."\r\n";

            foreach($timePerTimeCode as $timeCode=>$timeCodeData)
            {
                if($key_array == 10){
                    $outputLine = '214003'.
                              sprintf('%010s', (string) $userSignedEmp[$value]['social_security']).
                              sprintf('%03d', $this->identifyTimeCode($timeCode.'.1',0,$salary_mod));
                }else{
                $outputLine = '214003'.
                              sprintf('%010s', (string) $userSignedEmp[$value]['social_security']).
                              sprintf('%03d', $this->identifyTimeCode($timeCode,0,$salary_mod));
                }

                foreach($timeCodeData['clients'] as $keyTimeCodeEmployee=>$valueTimeCodeDataEmployee)
                {
                    //if(!empty($customer_list[$keyTimeCodeEmployee]['code']))
                    //{
                        $customer_list[$keyTimeCodeEmployee]['code'] = preg_replace('/[^0-9]/i', '', $customer_list[$keyTimeCodeEmployee]['code']);
                        $outputTmp = $outputLine.
                                     sprintf('%010s', (string) $customer_list[$keyTimeCodeEmployee]['code']).
                                     sprintf('%014s', (string) $userSignedEmp[$value]['century'].$userSignedEmp[$value]['social_security']).
                                     sprintf('%010d', (int) ($valueTimeCodeDataEmployee*100)).
                                     '0000000000'.
                                     '00000000000000000'.
                                     date(self::HOGIA_DATE_FORMAT, $date[0]).
                                     date(self::HOGIA_DATE_FORMAT, $date[1]);

                        $output .= $outputTmp."\r\n";
                    //}
                }                
            }

        }
    //}
        $output = '000000'."\r\n".$output.'999999'."\r\n";

        if ($return)
            return $output;
        else
            echo $output;
    }

    public function toCrona($return = false, $date = null, $c_list = null, $userSigned = array())
    {
        $smarty = new smartySetup(array('export-config.xml'));
        
        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        
        unset($user);
        
        $userSignedEmp = array();
        $customer_list = array();
        // time codes
        $this->timeCodes = self::getTimingList($smarty);
        
        foreach ($this->result as $keyResult=>$employes)
        {
            foreach ($employes['employee'] as $keyEmployee=>$employee)
            {
                if(count($userSigned) && !in_array($employee['emp_username'], $userSigned))
                {
                    unset($this->result[$keyResult]['employee'][$keyEmployee]);
                    continue;
                }

                
                $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
                $this->db->tables = array('employee');
                $this->db->conditions = array('username="'.$employee['emp_username'].'"');

                $empData = $this->db->query_fetch();
                $userSignedEmp[$employee['emp_username']] = $empData[0];
            }
        }
        
        $this->db->flush();
        $xmlDoc = new DOMDocument();
        $xmlDoc->formatOutput = true;
        $xmlDoc->encoding = 'UTF-8';//'ISO-8859-1';
        $rootElement = $xmlDoc->createElement('paxml');
        $rootElement->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $rootElement->setAttribute('xsi:noNamespaceSchemaLocation', 'http://www.paxml.se/1.0/paxml.xsd');

        // TAG: header
        $header = $xmlDoc->createElement('header');
        $format = $xmlDoc->createElement('format', 'LONIN');
        $header->appendChild($format);
        $version = $xmlDoc->createElement('version', '1.0');
        $header->appendChild($version);
        $foretagnamn = $xmlDoc->createElement('foretagnamn', $company_details['name']);
        $header->appendChild($foretagnamn);
        $rootElement->appendChild($header);
        // TAG: header - end

        // TAG: dimensioner
        $dimensioner = $xmlDoc->createElement('dimensioner');
        $dimension = $xmlDoc->createElement('dimension');
        $dimension->setAttribute('dim', '1');
        $dimension->setAttribute('namn', 'Brukare');
        $dimensioner->appendChild($dimension);
        $dimensionerData = $rootElement->appendChild($dimensioner);
        // TAG: dimensioner - end

        /*
        // TAG: resultatenheter
        $resultatenheter = $xmlDoc->createElement('resultatenheter');
        $resultatenheterData = $rootElement->appendChild($resultatenheter);
        // TAG: resultatenheter - end
        */

        // data for "dimensioner" and "resultatenheter"
        if(isset($c_list) && is_array($c_list))
        {
            foreach($c_list as $keyProject=>$valueProject)
            {
                /*if(!empty($valueProject['code']))
                {
                    
                    $dimension = $xmlDoc->createElement('dimension');
                    $dimension->setAttribute('dim', 1);
                    $dimension->setAttribute('namn', $valueProject['first_name'].' '.$valueProject['last_name']);
                    $dimensionerData->appendChild($dimension);

                    $resultatenhet = $xmlDoc->createElement('resultatenhet');
                    $resultatenhet->setAttribute('dim', '1');
                    $resultatenhet->setAttribute('id', $valueProject['code']);
                    $resultatenhet->setAttribute('namn', $valueProject['first_name'].' '.$valueProject['last_name']);
                    $resultatenheterData->appendChild($resultatenhet);                    
                    */

                    // other things
                    $customer_list[$valueProject['username']] = $valueProject;
                //}
            }
        }

        /*
        // time codes
        $this->timeCodes = self::getTimingList($smarty);

        // TAG: resultatenheter
        $resultatenheter = $xmlDoc->createElement('resultatenheter');
        foreach ($this->timeCodes as $tItem)
        {
            $resultatenhet = $xmlDoc->createElement('resultatenhet');
            $resultatenhet->setAttribute('dim', 1);
            $resultatenhet->setAttribute('id', $tItem['id_external']);
            $resultatenhet->setAttribute('namn', $tItem['name']);
            $resultatenheter->appendChild($resultatenhet);
        }
        $rootElement->appendChild($resultatenheter);
        // TAG: resultatenheter - end
        */

        $month = $this->exportMonth;
        $yr = $this->exportYear;

        // TAG: lonetransaktioner
        $lonetransaktioner = $xmlDoc->createElement('lonetransaktioner');

        /*
        // TAG: schematransaktioner
        $schematransaktioner = $xmlDoc->createElement('schematransaktioner');
        */

        // TAG: personal
        $personal = $xmlDoc->createElement('personal');
        
        foreach ($userSigned as $key => $value)
        {
            //if($value == 'alal002'){
            $rpt_content_normal         = array();
            $rpt_content_travell        = array();
            $rpt_content_break          = array();
            $rpt_content_oncall         = array();
            $rpt_content_leave          = array();
            $rpt_content_leave_over     = array();
            $rpt_content_leave_quality  = array();
            $rpt_content_leave_more     = array();
            $rpt_content_leave_some     = array();
            $rpt_content_leave_oncall   = array();
            $rpt_content_over           = array();
            $rpt_content_quality        = array();
            $rpt_content_more           = array();
            $rpt_content_some           = array();
            $rpt_content_training       = array();
            $rpt_content_personal       = array();
            $rpt_content_calltraining   = array();
            $rpt_content_leave_training = array();
            $rpt_content_leave_personal = array();
            $rpt_content_leave_calltraining = array();
            
            $passed_employee            = $value;

            $this->bookDistributionProjects = array();
            $this->bookDistributionProjectsSum = 0;
            $salary_mod = $this->get_salary_mod($value);

            $this->processWorkingTime($passed_employee, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break);
            
            $timePerTimeCode = array();
            $timePerDay = array();
            $rpt_content_all = array(
                $rpt_content_normal,
                $rpt_content_travell,
                $rpt_content_break,
                $rpt_content_over, 
                $rpt_content_quality, 
                $rpt_content_more, 
                $rpt_content_some,
                $rpt_content_training, 
                $rpt_content_personal,
                $rpt_content_oncall,
                $rpt_content_calltraining,
                $rpt_content_leave,
                
                /*
                $rpt_content_leave_over,
                $rpt_content_leave_quality,
                $rpt_content_leave_more,
                $rpt_content_leave_some,
                $rpt_content_leave_oncall,
                */
            );
            
            //echo "<pre>".print_r($rpt_content_training, 1)."</pre>";
            unset($rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break);
            
            //echo "<pre>".print_r($rpt_content_all, 1)."</pre>";
            
            foreach($rpt_content_all as $key_array => $rpt_content)
            {
                if(!is_array($rpt_content))
                {
                    continue;
                }

                foreach($rpt_content as $keyDate=>$valueDate)
                {
                    if(!is_array($valueDate))
                    {
                        continue;
                    }

                    foreach($valueDate as $timeCode=>$timeValue)
                    {
                        if(!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times']))
                        {
                            continue;
                        }

                        if(!isset($timePerDay[$keyDate]))
                        {
                            $timePerDay[$keyDate] = 0;
                        }

                        //$timePerDay[$keyDate] += $timeValue['total'];                    
                        /*
                        if(!isset($timePerTimeCode[$timeCode]))
                        {
                            $timePerTimeCode[$timeCode] = array(
                                'total' => $timeValue['total'],
                                'clients' => array()
                            );
                        }
                        */
                        
                        foreach($timeValue['times'] as $keyTimeValue=>$valueTimeValue)
                        {
                            //if(!empty($customer_list[$valueTimeValue[3]]['code']))
                            //{
                                $timePerDay[$keyDate] += $valueTimeValue[2];
                                if($key_array == 10){
                                    $timePerTimeCode[$timeCode.'.1']['total'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode.'.1']['clients'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }else{
                                    $timePerTimeCode[$timeCode]['total'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                            //}
                        }
                    }
                }                
            }
            
            //echo "<pre>".print_r($timePerTimeCode, 1)."</pre>";
            //echo "-----------------------------------------------------------------------";
            // for "lonetransaktioner"
            $iWriteTimes = 0;
            foreach($timePerTimeCode as $timeCode=>$timeCodeData)
            {
                
                
                foreach($timeCodeData['clients'] as $keyTimeCodeEmployee=>$valueTimeCodeDataEmployee)
                {
                    
                    if(!empty($customer_list[$keyTimeCodeEmployee]))
                    {
                        
                        // TAG: lonetrans
                        $lonetrans = $xmlDoc->createElement('lonetrans');
                        $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'].$userSignedEmp[$value]['social_security']);
                        $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($timeCode,0,$salary_mod)));
                        $lonetrans->appendChild($xmlDoc->createElement('antal', $valueTimeCodeDataEmployee));
                        // TAG: resenheter
                        //$resenheter = $lonetrans->appendChild($xmlDoc->createElement('resenheter'));
                        $resenheter = $xmlDoc->createElement('resenheter');
                        // TAG: lonetrans - end

                        
                        // TAG: resenhet
                        $resenhet = $xmlDoc->createElement('resenhet');
                        $resenhet->setAttribute('dim', '1');
                        $resenhet->setAttribute('id', $customer_list[$keyTimeCodeEmployee]['code']);
                        // TAG: resenhet - end
                        
                        $resenheter->appendChild($resenhet);
                        $lonetrans->appendChild($resenheter);
                        $lonetransaktioner->appendChild($lonetrans);

                        $iWriteTimes = 1;

                        // save the used project in the "resultatenheter" node
                        if(isset($c_list) && is_array($c_list))
                        {
                            foreach($c_list as $keyProject=>$valueProject)
                            {
                                if(!empty($valueProject['code']) && $valueProject['code']==$customer_list[$keyTimeCodeEmployee]['code'])
                                {
                                    /*
                                    $dimension = $xmlDoc->createElement('dimension');
                                    $dimension->setAttribute('dim', 1);
                                    $dimension->setAttribute('namn', $valueProject['first_name'].' '.$valueProject['last_name']);
                                    $dimensionerData->appendChild($dimension);
                                    

                                    
                                    $resultatenhet = $xmlDoc->createElement('resultatenhet');
                                    $resultatenhet->setAttribute('dim', '1');
                                    $resultatenhet->setAttribute('id', $valueProject['code']);
                                    $resultatenhet->setAttribute('namn', $valueProject['first_name'].' '.$valueProject['last_name']);
                                    $resultatenheterData->appendChild($resultatenhet);
                                    

                                    //*/
                                    unset($c_list[$keyProject]);
                                    break;
                                }
                            }
                        }                        
                    }
                }
                // TAG: lonetrans - end

                /*if($iWriteTimes)
                {
                    
                }*/
            }

            /*
            // for "schematransaktioner"
            // TAG: schema
            $schema = $xmlDoc->createElement('schema');
            $schema->setAttribute('anstid', $userSignedEmp[$value]['code']);

            foreach($timePerDay as $keyDate=>$valueDate)
            {
                // TAG: dag
                $dag = $xmlDoc->createElement('dag');
                $dag->setAttribute('datum', $keyDate);
                $dag->setAttribute('timmar', $valueDate);
                // TAG: dag - end

                $schema->appendChild($dag);
            }

            $schematransaktioner->appendChild($schema);
            */

            // for "personal"
            // TAG: person   avoided temporariry
            /*if($iWriteTimes == 1){
                $person = $xmlDoc->createElement('person');
                //$person->setAttribute('anstid', $userSignedEmp[$value]['code']);
                $person->setAttribute('persnr', $userSignedEmp[$value]['century'].$userSignedEmp[$value]['social_security']);
                $person->appendChild($xmlDoc->createElement('fornamn', $userSignedEmp[$value]['first_name']));
                $person->appendChild($xmlDoc->createElement('efternamn', $userSignedEmp[$value]['last_name']));
                //$person->appendChild($xmlDoc->createElement('extraadress', ''));
                if($userSignedEmp[$value]['address'])
                    $person->appendChild($xmlDoc->createElement('postadress', $userSignedEmp[$value]['address']));
                if($userSignedEmp[$value]['post'])
                    $person->appendChild($xmlDoc->createElement('postnr', $userSignedEmp[$value]['post']));
                if($userSignedEmp[$value]['city'])
                    $person->appendChild($xmlDoc->createElement('ort', $userSignedEmp[$value]['city']));
                $person->appendChild($xmlDoc->createElement('land', 'Sverige'));
                if($userSignedEmp[$value]['mobile'])
                    $person->appendChild($xmlDoc->createElement('mobiltelefon', $userSignedEmp[$value]['mobile']));
                //$person->appendChild($xmlDoc->createElement('hemtelefon', $userSignedEmp[$value]['phone']));
                if($userSignedEmp[$value]['phone'])
                    $person->appendChild($xmlDoc->createElement('arbetstelefon', $userSignedEmp[$value]['phone']));
                if($userSignedEmp[$value]['date'] != '0000-00-00')
                    $person->appendChild($xmlDoc->createElement('anstdatum', $userSignedEmp[$value]['date']));
                $personal->appendChild($person);
            }*/
            // TAG: person - end
        
        }
    //}
   

        $rootElement->appendChild($lonetransaktioner);
        // TAG: lonetransaktioner - end

        //$rootElement->appendChild($schematransaktioner);
        // TAG: schematransaktioner - end

        //$rootElement->appendChild($personal); avoided temporariry
        // TAG: personal - end

        $xmlDoc->appendChild($rootElement);
        if ($return)
            return $xmlDoc->saveXml();
        else
            echo $xmlDoc->saveXml();
    
    
    }

    public function toAgda($return = false, $date = null, $c_list = null, $userSigned = array())
    {
    }
    
    
    //monthly salry or hourly based 1-monthly,0-hourly used in to_Visma,to_hogia,to_crona functions
    public function get_salary_mod($employee){
       
        $this->db->tables = array('employee');
        $this->db->fields = array('monthly_salary');
        $this->db->conditions = array('username=?');
        $this->db->condition_values = array($employee);
        $this->db->query_generate();
        $empData = $this->db->query_fetch();
        if(!empty($empData)){
            return $empData[0]['monthly_salary'];
        }else{
            return 0;
        }
    }
}