<?php

/*
 * This class is for export pupose
 * Initially a person named Jim coded this
 * Then One from Brisk code
 * Later Entraze Shaju edited this..
 * So it is a mixture of different style of coding.
 * More over the functionality changed more than 10 times... so the flow of controll is not very easy to pick up
 * Sorry to those who are doing this later
 *
 */
?>
<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'setup.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'equipment.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'employee.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'dona.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'leave.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'customer.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'user.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inconvenient.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'timetable.php';

//require_once __DIR__.DIRECTORY_SEPARATOR.'inconvenient_timing.php';

class user_exp extends user {

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

class leaveConverter extends leave {

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
        if (!empty($datas))
            return $datas;
        else
            return array();
    }

}

/**
 * Converts employee time data into the export format of the selected payment sistem.
 */
class Converter {

    private $result;
    private $meta;
    private $year;
    private $timeCodes = array();
    private $bookDistributionProjects = array();
    private $bookDistributionProjectsSum = 0;
    private $db;
    private $apply_max_karens;
    public $employeeObj;
    public $customerObj;
    public $inconv_normal_category;
    public $inconv_normal_category_cont;
    public $inconv_oncall_category;
    public $holidays;
    public $sem_leave_days = 0;
    public $vab_leave_days = 0;
    public $fp_leave_days = 0;
    public $nopay_leave_days = 0;
    public $other_leave_days = 0;
    public $sick_15_90_oncall = 0;
    
    const VISMA_DATE_FORMAT = 'Y-m-d';
    const VISMA_PAY_DATE_FORMAT = 'Ymd';
    const HOGIA_DATE_FORMAT = 'ymd';

    public function __construct($meta, $result, $year) {
        $this->year = $year;
        $this->result = $result;
        $this->meta = $meta;

        $this->db = new db;
        $this->equipment = new equipment();
        $this->inconv_oncall_category = array();
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

    private function getEmployeeWorkReportDetailsNormal(&$rpt_content, &$inconv_normal_slots, &$flag, $employee, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type = -1, $isOnCall = -1, $leave_no_pay = '', $leave_max_date = '', $inconv_mod = 1) {
//        if ($employee->is_ob_on_for_a_employee($passed_employee))
//            $holidays = $employee->get_holiday_details($month, $yr);
//        else
//            $holidays = array();
        $holidays = $this->holidays;
        $obj_inconv = new inconvenient();

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

        //$inconv_normal_category = $employee->get_distinct_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);
        $inconv_normal_category = $this->inconv_normal_category;

        if ($inconv_mod == 2) {
            $inconv_counter = 0;
            $inconv_weekend = $obj_inconv->get_weekend_inconvenient_group_id();
            foreach ($inconv_normal_category as $inconv_normal) {
                if (!in_array($inconv_normal['group_id'], $inconv_weekend)) {
                    unset($inconv_normal_category[$inconv_counter]);
                }
                $inconv_counter++;
            }
        }


        $flag = 0;
        $flag_holiday = 0;
        //checking whether it is a holiday


        foreach ($holidays as $holiday) {
            $holidayTmp = $holiday['group_id'] + 1000;
            //$holidayTmp = $leave_type==1 ? '2001.'.$holidayTmp : $holidayTmp;
            $holidayTmp = $leave_type > 0 ? ($leave_type == 1 ? '2001.' . $holidayTmp : 2000 + $leave_type) : $holidayTmp;
            if ($isOnCall == 1 && $leave_type == 1) {
                //if($isOnCall || $leave_type)
                $holidayTmp = '1000.' . $holidayTmp;
            }


            if ($slot_time_from < $holiday['start'] && $slot_time_to > $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $holiday['start']) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $holiday['end'], round(($holiday['end'] - $holiday['start']) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H-i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H-i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from >= $holiday['start'] && $slot_time_from < $holiday['end'] && $slot_time_to >= $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $slot_time_from) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $holiday['end'], round(($holiday['end'] - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                if ($slot_time_to > $holiday['end']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H.i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from <= $holiday['start'] && $slot_time_to > $holiday['start'] && $slot_time_to <= $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $holiday['start']) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $slot_time_to, round(($slot_time_to - $holiday['start']) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                if ($slot_time_from < $holiday['start']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H.i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from > $holiday['start'] && $slot_time_to < $holiday['end']) {
                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) {
            return;
        }
        if ($inconv_mod != 0) {
            foreach ($inconv_normal_category as $inconv_normal) {
                $days = explode(',', $inconv_normal['days']);
                $leaveTypeTmp = $inconv_normal['group_id'];
                $leaveTypeTmp = $leave_type > 0 ? ($leave_type == 1 ? '2001.' . $leaveTypeTmp : 2000 + $leave_type) : $leaveTypeTmp;
                //$leaveTypeTmp = $leave_type>0 ? '2001.'.$leaveTypeTmp : $leaveTypeTmp;
                if ($isOnCall == 1 && $leave_type == 1) {
                    //if($isOnCall || $leave_type)
                    $leaveTypeTmp = '2001.' . $inconv_normal['group_id'];
                }

                $inconv_time_from = mktime(intval($inconv_normal['time_from']), bcmod($inconv_normal['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $inconv_time_to = mktime(intval($inconv_normal['time_to']), bcmod($inconv_normal['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                    if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        if ($slot_time_to > $inconv_time_to) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        if ($slot_time_from < $inconv_time_from) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    }
                }
                if ($flag == 1) {
                    return;
                }

                //$inconv_normal_category_cont = $employee->get_distinct_normal_inconvenient_details_by_month_and_year_cont($inconv_normal['id']);
                $inconv_normal_category_cont = array();
                if(array_key_exists($inconv_normal['id'], $this->inconv_normal_category_cont))
                    $inconv_normal_category_cont = $this->inconv_normal_category_cont[$inconv_normal['id']];
                //echo "<pre>\n".print_r($inconv_normal_category_cont , 1)."</pre>";
                foreach ($inconv_normal_category_cont as $inconv_normal_cont) {

                    $days = explode(',', $inconv_normal_cont['days']);
                    $leaveTypeTmp = $inconv_normal['group_id'];
                    $leaveTypeTmp = $leave_type > 0 ? ($leave_type == 1 ? '2001.' . $leaveTypeTmp : 2000 + $leave_type) : $leaveTypeTmp;
                    //$leaveTypeTmp = $leave_type>0 ? '2001.'.$leaveTypeTmp : $leaveTypeTmp;
                    if ($isOnCall == 1 && $leave_type == 1) {
                        //if($isOnCall || $leave_type)
                        $leaveTypeTmp = '2001.' . $inconv_normal['group_id'];
                    }

                    $inconv_time_from = mktime(intval($inconv_normal_cont['time_from']), bcmod($inconv_normal_cont['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                    $inconv_time_to = mktime(intval($inconv_normal_cont['time_to']), bcmod($inconv_normal_cont['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));

                    if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                        if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            unset($inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                            if ($slot_time_to > $inconv_time_to) {
                                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            }
                            unset($inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                            if ($slot_time_from < $inconv_time_from) {
                                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_normal_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            }
                            unset($inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_normal['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
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
    }

    private function getEmployeeWorkReportDetailsOnCall(&$rpt_content, &$inconv_normal_slots, &$flag, $employee, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type = -1, $leave_no_pay = '', $leave_max_date = '') {
        // if ($employee->is_ob_on_for_a_employee($passed_employee))
        //     $holidays = $employee->get_holiday_details($month, $yr);
        // else
        //     $holidays = array();
        //$inconv_oncall_category = $employee->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $inconv_normal_slot['customer']);
        $holidays = $this->holidays;
        $inconv_oncall_category = $this->get_distinct_oncall_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $inconv_normal_slot['customer']);
        //echo date('Y-m-d H:i',$slot_time_from)."---".date('Y-m-d H:i',$slot_time_to);
        //echo "<pre>".print_r($inconv_oncall_category,1)."</pre>";
        foreach ($holidays as $holiday) {
            //$holidayTmp = '1000.'.($holiday['id']+1000);
            $holidayTmp = $holiday['group_id'] + 1000;
            $holidayTmp = $leave_type > 0 ? ($leave_type == 1 ? '2001.1000.' . $holidayTmp : ($leave_type == 2? "2002.1" : 2000 + $leave_type)) : '1000.' . $holidayTmp;


            if ($slot_time_from < $holiday['start'] && $slot_time_to > $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $holiday['start']) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $holiday['end'], round(($holiday['end'] - $holiday['start']) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H-i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H-i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from >= $holiday['start'] && $slot_time_from < $holiday['end'] && $slot_time_to >= $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($holiday['end'] - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($holiday['end'] - $slot_time_from) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $holiday['end'], round(($holiday['end'] - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                if ($slot_time_to > $holiday['end']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => date('H.i', $holiday['end']), 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from <= $holiday['start'] && $slot_time_to > $holiday['start'] && $slot_time_to <= $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $holiday['start']) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $holiday['start']) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($holiday['start'], $slot_time_to, round(($slot_time_to - $holiday['start']) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                if ($slot_time_from < $holiday['start']) {
                    array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => date('H.i', $holiday['start']), 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                }
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            } else if ($slot_time_from > $holiday['start'] && $slot_time_to < $holiday['end']) {

                //$rpt_content[$inconv_normal_slot['date']][$holiday['id']+1000] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content[$inconv_normal_slot['date']][$holidayTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $holidayTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                unset($inconv_normal_slots[$key]);
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) {
            return;
        }
        foreach ($inconv_oncall_category as $inconv_oncall) {
            if (strtotime($inconv_normal_slot['date']) >= strtotime($inconv_oncall['effect_from']) && strtotime($inconv_normal_slot['date']) <= strtotime($inconv_oncall['effect_to'])) {
                $days = explode(',', $inconv_oncall['days']);
                $leaveTypeTmp = $inconv_oncall['group_id'];
                $leaveTypeTmp = $leave_type > 0 ? ($leave_type == 1 ? '2001.' . $leaveTypeTmp : ($leave_type == 2?'2002.1' : 2000 + $leave_type)) : $leaveTypeTmp;
                $inconv_time_from = mktime(intval($inconv_oncall['time_from']), bcmod($inconv_oncall['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $inconv_time_to = mktime(intval($inconv_oncall['time_to']), bcmod($inconv_oncall['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                    if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        if ($slot_time_to > $inconv_time_to) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        if ($slot_time_from < $inconv_time_from) {
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                        }
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                        //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                        unset($inconv_normal_slots[$key]);
                        $flag = 1;
                        break;
                    }
                }
                if ($flag == 1) {
                    return;
                }
                //$inconv_oncall_category_cont = $employee->get_distinct_normal_inconvenient_details_by_month_and_year_cont($inconv_oncall['id'], $inconv_oncall['source']);
                $inconv_oncall_category_cont = array();
                if(array_key_exists($inconv_normal_slot['customer'], $this->inconv_normal_category_cont) && array_key_exists($inconv_oncall['id'], $this->inconv_normal_category_cont[$inconv_normal_slot['customer']])){
                    $inconv_oncall_category_cont = $this->inconv_normal_category_cont[$inconv_normal_slot['customer']][$inconv_oncall['id']];

                }else{
                    $inconv_oncall_category_cont = $this->inconv_normal_category_cont[$inconv_oncall['id']];
                }

                //echo "<pre>".print_r($inconv_oncall_category_cont,1)."</pre>";
                foreach ($inconv_oncall_category_cont as $inconv_oncall_cont) {
                    $days = explode(',', $inconv_oncall_cont['days']);
                    $leaveTypeTmp = $inconv_oncall['group_id'];
                    $leaveTypeTmp = $leave_type > 0 ? ($leave_type == 1 ? '2001.' . $leaveTypeTmp : ($leave_type == 2?'2002.1' : 2000 + $leave_type)) : $leaveTypeTmp;
                    $inconv_time_from = mktime(intval($inconv_oncall_cont['time_from']), bcmod($inconv_oncall_cont['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                    $inconv_time_to = mktime(intval($inconv_oncall_cont['time_to']), bcmod($inconv_oncall_cont['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                    if (in_array(date('N', strtotime($inconv_normal_slot['date'])), $days)) {
                        if ($slot_time_from < $inconv_time_from && $slot_time_to > $inconv_time_to) {
                            // $rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $inconv_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $inconv_time_to, round(($inconv_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            unset($inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from >= $inconv_time_from && $slot_time_from < $inconv_time_to && $slot_time_to >= $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($inconv_time_to - $slot_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($inconv_time_to - $slot_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $inconv_time_to, round(($inconv_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                            if ($slot_time_to > $inconv_time_to) {
                                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_oncall_cont['time_to'], 'time_to' => $inconv_normal_slot['time_to'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            }
                            unset($inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from <= $inconv_time_from && $slot_time_to > $inconv_time_from && $slot_time_to <= $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $inconv_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $inconv_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($inconv_time_from, $slot_time_to, round(($slot_time_to - $inconv_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
                            if ($slot_time_from < $inconv_time_from) {
                                array_push($inconv_normal_slots, array('id' => $inconv_normal_slot['id'], 'time_from' => $inconv_normal_slot['time_from'], 'time_to' => $inconv_oncall_cont['time_from'], 'date' => $inconv_normal_slot['date'], 'type' => $inconv_normal_slot['type'], 'status' => $inconv_normal_slot['status'], "fkkn" => $inconv_normal_slot['fkkn'], "customer" => $inconv_normal_slot['customer']));
                            }
                            unset($inconv_normal_slots[$key]);
                            $flag = 1;
                            break;
                        } else if ($slot_time_from > $inconv_time_from && $slot_time_to < $inconv_time_to) {
                            //$rpt_content[$inconv_normal_slot['date']][$inconv_oncall['id']] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                            $rpt_content[$inconv_normal_slot['date']][$leaveTypeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type, $leaveTypeTmp, $leave_no_pay, $leave_max_date, $inconv_normal_slot['fkkn']);
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
    }

    public function convEmployee($employee, $weekNo) {
        $out = array();
        //$customer = $employee['customer'];
        //unset($employee['name'], $employee['sum'], $employee['customer']);

        foreach ($employee as $day => $time) {
            switch ($day) {
                case 'Mon':
                    $day = ($weekNo * 7) - 7;
                    break;
                case 'Tue':
                    $day = ($weekNo * 7) - 6;
                    break;
                case 'Wen':
                    $day = ($weekNo * 7) - 5;
                    break;
                case 'Thu':
                    $day = ($weekNo * 7) - 4;
                    break;
                case 'Fri':
                    $day = ($weekNo * 7) - 3;
                    break;
                case 'Sat':
                    $day = ($weekNo * 7) - 2;
                    break;
                case 'Sun':
                    $day = ($weekNo * 7) - 1;
                    break;

                default:
                    $day = NULL;
                    break;
            }

            if ($day == NULL) {
                continue;
            }

            $date = date_create_from_format('z Y', $day . ' ' . $this->year)->format(self::VISMA_DATE_FORMAT);
            $out[$date]['work'] = 0;
            $out[$date]['leave'] = 0;

            foreach ($time as $hours) {
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

                if ($onLeave == 1) {
                    //$out[$date]['work'] += $this->diffHours($hours[0], $hours[1]);
                    //$outTmp['work'] = $this->diffHours($hours[0], $hours[1]);
                    $outTmp['work'] = $this->equipment->time_difference($hours[0], $hours[1]);
                } else {
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

    public function diffHours($h1, $h2) {
        $h1 = floor($h1) * 60 + ($h1 - floor($h1)) * 100;
        $h2 = floor($h2) * 60 + ($h2 - floor($h2)) * 100;
        $r = $h2 - $h1;
        //$r = floor($r/60) + ($r-floor($r/60)*60)/100;

        return $r;


        if ($r - floor($r) < 0.6)
            return number_format($r, 2);
        else {
            $r += 1.00;
            $r -= 0.60;

            return number_format($r, 2);
        }
    }

    private function findRecordInLeaves($timeStart, $timeEnd, $dateStart, $employee) {
        foreach ($this->leaves as $key => $value) {
            if ($value['employee'] == $employee) {
                // convention for 24.00 and 24.0 !!!
                $value['To_date'] = str_replace('24.00', '23.59', $value['To_date']);
                $value['To_date'] = str_replace('24.0', '23.59', $value['To_date']);
                $timeEnd = str_replace('24.00', '23.59', $timeEnd);
                $timeEnd = str_replace('24.0', '23.59', $timeEnd);
                // convention end

                $leaveStart = DateTime::createFromFormat('Y-m-d G.i', $value['From_date']);
                $leaveEnd = DateTime::createFromFormat('Y-m-d G.i', $value['To_date']);

                $timeStartTmp = DateTime::createFromFormat('Y-m-d G.i', $dateStart . ' ' . $timeStart);
                $timeEndTmp = DateTime::createFromFormat('Y-m-d G.i', $dateStart . ' ' . $timeEnd);

                if ($leaveStart <= $timeStartTmp && $timeStartTmp < $leaveEnd && $leaveStart < $timeEndTmp && $timeEndTmp <= $leaveEnd) {
                    return $value;
                }
            }
        }

        return FALSE;
    }

    private function identifyTimeCode($timeCode, $iInc = 0, $salary_mod = 1, $fkkn = 0) {
        //$timeCode += $iInc;  //COMMENTED BY SHAJU
        $timeCode = (string) $timeCode;
        //echo "<pre>".print_r($this->timeCodes,1)."</pre>";
        foreach ($this->timeCodes as $key => $value) {
            $value['group_id'] = (string) $value['group_id'];

            if ((string)$value['group_id'] === $timeCode) {
                if ($salary_mod == 1){
                    if($fkkn == 0)
                        return $value['vacation_saving'];
                    elseif($fkkn == 1)
                        return $value['vacation_saving_fk'];
                    elseif($fkkn == 2)
                        return $value['vacation_saving_kn'];
                    elseif($fkkn == 3)
                        return $value['vacation_saving_tu'];
                }
                elseif($salary_mod == 2){
                    if($fkkn == 0)
                        return $value['vacation_paid'];
                    elseif($fkkn == 1)
                        return $value['vacation_paid_fk'];
                    elseif($fkkn == 2)
                        return $value['vacation_paid_kn'];
                    elseif($fkkn == 3)
                        return $value['vacation_paid_tu'];
                }
                elseif($salary_mod == 3){
                    if($fkkn == 0)
                        return $value['monthly'];
                    elseif($fkkn == 1)
                        return $value['monthly_fk'];
                    elseif($fkkn == 2)
                        return $value['monthly_kn'];
                    elseif($fkkn == 3)
                        return $value['monthly_tu'];
                }
                elseif($salary_mod == 4){
                    if($fkkn == 0)
                        return $value['monthly_office'];
                    elseif($fkkn == 1)
                        return $value['monthly_office_fk'];
                    elseif($fkkn == 2)
                        return $value['monthly_office_kn'];
                    elseif($fkkn == 3)
                        return $value['monthly_office_tu'];
                }
                elseif($salary_mod == 5){
                    if($fkkn == 0)
                        return $value['monthly_office_hour'];
                    elseif($fkkn == 1)
                        return $value['monthly_office_hour_fk'];
                    elseif($fkkn == 2)
                        return $value['monthly_office_hour_kn'];
                    elseif($fkkn == 3)
                        return $value['monthly_office_hour_tu'];
                }
            }
        }

        //return $timeCode;
        return '';
    }
    
    private function identifyTimeCodeName($timeCode, $iInc = 0, $salary_mod = 1) {
        //$timeCode += $iInc;  //COMMENTED BY SHAJU
        $timeCode = (string) $timeCode;
        //echo "<pre>".print_r($this->timeCodes,2)."</pre>";
        foreach ($this->timeCodes as $key => $value) {
            $value['group_id'] = (string) $value['group_id'];

            if ((string)$value['group_id'] === $timeCode) {
                return $value['name'];
            }
        }

        //return $timeCode;
        return '';
    }

    private function appendTimeTagElement($xmlDoc, $key, $item, $valueItem, &$empTag) {
        if (!empty($item['time_code'])) {
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

    public function walkDataNonXML($item, $key) {
        if (isset($item['work']) && $item['work'] != 0) {
            $item['work'] = floor($item['work'] / 60) + ($item['work'] - floor($item['work'] / 60) * 60) / 100;

            $timeTag = array(
                'DateOfReport' => $key,
                'TimeCode' => 300,
                'SumOfHours' => $item['work'],
            );
            $this->times[] = $timeTag;
        }
        if (isset($item['leave']) && $item['leave'] != 0) {
            $item['leave'] = floor($item['leave'] / 60) + ($item['leave'] - floor($item['leave'] / 60) * 60) / 100;

            $timeTag = array(
                'DateOfReport' => $key,
                'TimeCode' => 401,
                'SumOfHours' => $item['leave'],
            );
            $this->times[] = $timeTag;
        }
    }

    private function getTimingList($smarty) {
        //$oncall_status = $this->employeeObj->get_salary_code_count(1, array(3003, 3012, 3013)) && $this->customerObj->get_salary_code($_SESSION['company_id']) == 3 ? 1 : 0;
        $oncall_status = $this->customerObj->get_salary_code($_SESSION['company_id']) == 3 ? 1 : 0;
        $incTiming = new inconvenient_timing();
//        $inconvenientTimingList_exact = $incTiming->inconvenient_timing_list();
        $inconvenientTimingList_exact = $incTiming->inconvenient_timing_list_copy();
        $inconvenientTimingList = $inconvenientTimingList_exact;
        $temp_array = array();

        foreach ($inconvenientTimingList as $key => $entry) {

            //$inconvenientTimingList[$key]['name'] = $smarty->translate['lc_label_'.$entry['id']];
            $tmp_name = $entry['name'];
            $inconvenientTimingList[$key]['name'] = $entry['name'];
            $group_id_temp = $entry['group_id'];
            $entry['group_id'] = $group_id_temp . '.1';
            $entry['name'] = $tmp_name . '. intro';
            $temp_array[] = $entry;

            $entry['group_id'] = $group_id_temp . '.2';
            $entry['name'] = $tmp_name . '. komp';
            $temp_array[] = $entry;
            if ($entry['type'] == 3) {
                $entry['group_id'] = $group_id_temp . '.3';
                $entry['name'] = $tmp_name . '. mertid';
                $temp_array[] = $entry;
            }
            $entry['group_id'] = $group_id_temp . '.4';
            $entry['name'] = $tmp_name . '. dismissal';
            $temp_array[] = $entry;
            // array_push($inconvenientTimingList, $entry);
            //$inconvenientTimingList[count($inconvenientTimingListvar)-1]['id'] = $entry['id'].'.1';
            //$inconvenientTimingList[count($inconvenientTimingListvar)-1]['name'] = $entry['name'].'. intro';
        }
        $inconvenientTimingList = array_merge($inconvenientTimingList, $temp_array);

        $holidayTimingList_exact = $incTiming->holiday_timing_list();
        $holidayTimingList = $holidayTimingList_exact;
        $holidayTimingListJour = array();

        foreach ($holidayTimingList as $key => $entry) {
            $holidayTimingList[$key]['group_id'] += 1000;

            $entry['group_id'] = '1000.' . ($entry['group_id'] + 1000);
            $entry['name'] = 'Jour ' . $entry['name'];
            $holidayTimingListJour[] = $entry;
        }
        $holidayTimingList = array_merge($holidayTimingList, $holidayTimingListJour);

        $leaveTimingList = array();
        $leaveTimingList[] = array(
            'group_id' => 2000,
            'name' => $smarty->translate['lc_label_2000'],
            'leave' => 1,
        );
        foreach ($smarty->leave_type as $key => $entry) {
            $leaveTimingList[] = array(
                'group_id' => 2000 + $key,
                'name' => $smarty->translate['lc_label_' . (2000 + $key)],
                'leave' => 1,
            );

            // add the sick combinations
            if ($key == 1) {
                $leaveTimingList[] = array(
                    'group_id' => '2001.0',
                    'name' => $smarty->translate['lc_label_2001.0'],
                    'leave' => 1,
                );

                $leaveTimingList[] = array(
                    'group_id' => '2001.0.1',
                    'name' => $smarty->translate['lc_label_2001.0.1'],
                    'leave' => 1,
                );

                $leaveTimingList[] = array(
                    'group_id' => '2001.0.2',
                    'name' => $smarty->translate['lc_label_2001.0.2'],
                    'leave' => 1,
                );

                foreach ($inconvenientTimingList_exact as $entryTmp) {
                    $leaveTimingList[] = array(
                        'group_id' => '2001' . '.' . $entryTmp['group_id'],
                        'name' => 'Sick ' . $entryTmp['name'],
                        'leave' => 1,
                    );

                    $leaveTimingList[] = array(
                        'group_id' => '2001' . '.' . $entryTmp['group_id'] . '.1',
                        'name' => 'Sick ' . $entryTmp['name'] . ' Intro',
                        'leave' => 1,
                    );
                    if ($entryTmp['type'] == 3) {
                        $leaveTimingList[] = array(
                            'group_id' => '2001' . '.' . $entryTmp['group_id'] . '.3',
                            'name' => 'Sick ' . $entryTmp['name'] . ' mertid',
                            'leave' => 1,
                        );
                    }
                }

                foreach ($holidayTimingList_exact as $entryTmp) {
                    $leaveTimingList[] = array(
                        'group_id' => '2001' . '.' . (1000 + $entryTmp['group_id']),
                        'name' => 'Sick ' . $entryTmp['name'],
                        'leave' => 1,
                    );
                }

                foreach ($holidayTimingList_exact as $entryTmp) {
                    $leaveTimingList[] = array(
                        'group_id' => '2001' . '.1000.' . (1000 + $entryTmp['group_id']),
                        'name' => 'Sick Jour ' . $entryTmp['name'],
                        'leave' => 1,
                    );
                }
            }elseif($key == 2){
                $leaveTimingList[] = array(
                    'group_id' => '2002.1',
                    'name' => $smarty->translate['lc_label_2002']." Jour",
                    'leave' => 1,
                );
                $leaveTimingList[] = array(
                    'group_id' => '2002.2',
                    'name' => $smarty->translate['vacation_taken'],
                    'leave' => 1,
                );
                $leaveTimingList[] = array(
                    'group_id' => '2002.3',
                    'name' => $smarty->translate['vacation_saving'],
                    'leave' => 1,
                );
            }
        }

        // status codes from "timetable"
        $timetableStatusList[] = array('group_id' => 3000, 'name' => $smarty->translate['lc_label_3000'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3001, 'name' => $smarty->translate['lc_label_3001'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3002, 'name' => $smarty->translate['lc_label_3002'], 'leave' => 0);
        if ($oncall_status)
            $timetableStatusList[] = array('group_id' => 3003, 'name' => $smarty->translate['lc_label_3003'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3004, 'name' => $smarty->translate['lc_label_3004'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3005, 'name' => $smarty->translate['lc_label_3005'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3006, 'name' => $smarty->translate['lc_label_3006'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3007, 'name' => $smarty->translate['lc_label_3007'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3008, 'name' => $smarty->translate['lc_label_3008'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3009, 'name' => $smarty->translate['lc_label_3009'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3010, 'name' => $smarty->translate['lc_label_3010'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3011, 'name' => $smarty->translate['lc_label_3011'], 'leave' => 0);
        if ($oncall_status) {
            $timetableStatusList[] = array('group_id' => 3012, 'name' => $smarty->translate['lc_label_3012'], 'leave' => 0);
            $timetableStatusList[] = array('group_id' => 3013, 'name' => $smarty->translate['lc_label_3013'], 'leave' => 0);
        }
        $timetableStatusList[] = array('group_id' => 3014, 'name' => $smarty->translate['lc_label_3014'], 'leave' => 0);
        $timetableStatusList[] = array('group_id' => 3015, 'name' => $smarty->translate['lc_label_3015'], 'leave' => 0);
        if ($oncall_status) {
            $timetableStatusList[] = array('group_id' => 3016, 'name' => $smarty->translate['lc_label_3016'], 'leave' => 0);
        }
        $timetableStatusList[] = array('group_id' => 4000, 'name' => $smarty->translate['lc_label_4000'], 'leave' => 0);

        $list = array_merge($inconvenientTimingList, $holidayTimingList, $leaveTimingList, $timetableStatusList);
        //$list = array_merge($inconvenientTimingList, $holidayTimingList, $leaveTimingList);       
        // add the internal codes
        $this->db->tables = array('export_lon_config');

        foreach ($this->db->query_fetch() as $entry) {
            foreach ($list as $key => $value) {
                if ((string) $value['group_id'] === (string) $entry['internal']) {
                        //                    $list[$key]['vacation_saving'] = !empty($entry['vacation_saving']) ? $entry['vacation_saving'] : $entry['internal'];
                        //                    $list[$key]['vacation_paid'] = !empty($entry['vacation_paid']) ? $entry['vacation_paid'] : $entry['internal'];
                        //                    $list[$key]['monthly'] = !empty($entry['monthly']) ? $entry['monthly'] : $entry['internal'];
                        //                    $list[$key]['monthly_office'] = !empty($entry['monthly_office']) ? $entry['monthly_office'] : $entry['internal'];
                        //                    $list[$key]['monthly_office_hour'] = !empty($entry['monthly_office_hour']) ? $entry['monthly_office_hour'] : $entry['internal'];
                        $list[$key]['vacation_saving'] = !empty($entry['vacation_saving']) ? $entry['vacation_saving'] : '';
                        $list[$key]['vacation_saving_fk'] = !empty($entry['vacation_saving_fk']) ? $entry['vacation_saving_fk'] : '';
                        $list[$key]['vacation_saving_kn'] = !empty($entry['vacation_saving_kn']) ? $entry['vacation_saving_kn'] : '';
                        $list[$key]['vacation_saving_tu'] = !empty($entry['vacation_saving_tu']) ? $entry['vacation_saving_tu'] : '';
                        $list[$key]['vacation_paid'] = !empty($entry['vacation_paid']) ? $entry['vacation_paid'] : '';
                        $list[$key]['vacation_paid_fk'] = !empty($entry['vacation_paid_fk']) ? $entry['vacation_paid_fk'] : '';
                        $list[$key]['vacation_paid_kn'] = !empty($entry['vacation_paid_kn']) ? $entry['vacation_paid_kn'] : '';
                        $list[$key]['vacation_paid_tu'] = !empty($entry['vacation_paid_tu']) ? $entry['vacation_paid_tu'] : '';
                        $list[$key]['monthly'] = !empty($entry['monthly']) ? $entry['monthly'] : '';
                        $list[$key]['monthly_fk'] = !empty($entry['monthly_fk']) ? $entry['monthly_fk'] : '';
                        $list[$key]['monthly_kn'] = !empty($entry['monthly_kn']) ? $entry['monthly_kn'] : '';
                        $list[$key]['monthly_tu'] = !empty($entry['monthly_tu']) ? $entry['monthly_tu'] : '';
                        $list[$key]['monthly_office'] = !empty($entry['monthly_office']) ? $entry['monthly_office'] : '';
                        $list[$key]['monthly_office_fk'] = !empty($entry['monthly_office_fk']) ? $entry['monthly_office_fk'] : '';
                        $list[$key]['monthly_office_kn'] = !empty($entry['monthly_office_kn']) ? $entry['monthly_office_kn'] : '';
                        $list[$key]['monthly_office_tu'] = !empty($entry['monthly_office_tu']) ? $entry['monthly_office_tu'] : '';
                        $list[$key]['monthly_office_hour'] = !empty($entry['monthly_office_hour']) ? $entry['monthly_office_hour'] : '';
                        $list[$key]['monthly_office_hour_fk'] = !empty($entry['monthly_office_hour_fk']) ? $entry['monthly_office_hour_fk'] : '';
                        $list[$key]['monthly_office_hour_kn'] = !empty($entry['monthly_office_hour_kn']) ? $entry['monthly_office_hour_kn'] : '';
                        $list[$key]['monthly_office_hour_tu'] = !empty($entry['monthly_office_hour_tu']) ? $entry['monthly_office_hour_tu'] : '';
                }
            }
        }
        
        

        // rerun the list codes to add the id_external if not set
//        foreach ($list as $key => $value) {
//            if (!isset($value['id_external'])) {
//                $list[$key]['id_external'] = $value['group_id'];
//            }
//            if (!isset($value['id_monthly'])) {
//                $list[$key]['id_monthly'] = $value['group_id'];
//            }
//        }
        
        //echo "<pre>".print_r($list,2)."</pre>";
        return $list;
    }

    private function generateNormalWorkingTimes($startDate, $endDate, $xmlDoc) {
        $startDate = DateTime::createFromFormat('U', $startDate);
        $endDate = DateTime::createFromFormat('U', $endDate);
        $normalWorkingTimes = $xmlDoc->createElement('NormalWorkingTimes');

        while ($startDate <= $endDate) {
            $normalWorkingTime = $xmlDoc->createElement('NormalWorkingTime');
            $normalWorkingTime->setAttribute('DateOfReport', $startDate->format('Y-m-d'));
            $normalWorkingTime->setAttribute('NormalWorkingTimeHours', '');
            $normalWorkingTime->setAttribute('FlexTimeHours', '');
            $normalWorkingTimes->appendChild($normalWorkingTime);

            $startDate->add(new DateInterval('P1D'));
        }

        return $normalWorkingTimes;
    }

    public function sortWorkingTimeInFullDay($a, $b) {
        usort($a['times'], array("self", "sortWorkingTimeInDay"));
        usort($b['times'], array("self", "sortWorkingTimeInDay"));

        if ($a['times'][0][0] == $b['times'][0][0]) {
            return 0;
        }

        return ($a['times'][0][0] < $b['times'][0][0]) ? -1 : 1;
    }

    public function sortWorkingTimeInDay($a, $b) {
        if ($a[0] == $b[0]) {
            return 0;
        }

        return ($a[0] < $b[0]) ? -1 : 1;
    }

    private function combineWorkingHours(&$rpt_content_leave, &$rpt_content_leave_over, &$rpt_content_leave_quality, &$rpt_content_leave_more, &$rpt_content_leave_some, &$rpt_content_leave_oncall, &$rpt_content_leave_training, &$rpt_content_leave_personal, &$rpt_content_leave_calltraining, &$rpt_content_leave_voluntary, &$rpt_content_leave_more_oncall, &$rpt_content_leave_standby) {
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
            &$rpt_content_leave_calltraining,
            &$rpt_content_leave_voluntary,
            &$rpt_content_leave_more_oncall,
            &$rpt_content_leave_standby
        );
        foreach ($rpt_content_all as $rpt_key => $rpt_content) {
            if (!is_array($rpt_content)) {
                continue;
            }

            foreach ($rpt_content as $keyNormal => $valueNormal) {
                if (!isset($rpt_content_merged[$keyNormal])) {
                    $rpt_content_merged[$keyNormal] = $valueNormal;
                } else {
                    foreach ($valueNormal as $keyTimeCode => $valueTimeCode) {
                        if (!isset($rpt_content_merged[$keyNormal][$keyTimeCode])) {
                            $rpt_content_merged[$keyNormal][$keyTimeCode] = $valueTimeCode;
                        } else {
                            if (!isset($valueTimeCode['times']) || !is_array($valueTimeCode['times'])) {
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

    private function processWorkingTime($passed_employee, $paseed_customers, $month, $yr, &$rpt_content_normal, &$rpt_content_over, &$rpt_content_quality, &$rpt_content_more, &$rpt_content_some, &$rpt_content_oncall, &$rpt_content_leave, &$rpt_content_leave_over, &$rpt_content_leave_quality, &$rpt_content_leave_more, &$rpt_content_leave_some, &$rpt_content_leave_oncall, &$rpt_content_training, &$rpt_content_personal, &$rpt_content_calltraining, &$rpt_content_leave_training, &$rpt_content_leave_personal, &$rpt_content_leave_calltraining, &$rpt_content_travell, &$rpt_content_break, &$rpt_content_voluntary, &$rpt_content_complementary, &$rpt_content_complementary_oncall, &$rpt_content_leave_voluntary, &$rpt_content_more_oncall, &$rpt_content_leave_more_oncall, &$rpt_content_standby, &$rpt_content_leave_standby, &$rpt_content_dismissal, &$rpt_content_dismissal_oncall) {
        //echo "<pre>\n".print_r(func_get_args(oid) , 1)."</pre>"; 
        //$oncall_status = $this->employeeObj->get_salary_code_count(1, array(3003, 3012, 3013)) && $this->customerObj->get_salary_code($_SESSION['company_id']) == 3 ? 1 : 0;
        $oncall_status = $this->customerObj->get_salary_code($_SESSION['company_id']) == 3 ? 1 : 0;
        $inconv_normal_slots = $this->employeeObj->get_employee_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee, $paseed_customers);
        //echo "<pre>\n".print_r($inconv_normal_slots , 1)."</pre>";
        if ($this->employeeObj->is_ob_on_for_a_employee($passed_employee))
            $this->holidays = $this->employeeObj->get_holiday_details($month, $yr);
        else
            $this->holidays = array();
        //echo "<pre>\n".print_r($holidays , 1)."</pre>";
        $this->inconv_normal_category = $this->employeeObj->get_distinct_normal_inconvenient_details_by_month_and_year($month, $yr, $passed_employee);
        //aecho "<pre>\n".print_r($this->inconv_normal_category , 1)."</pre>";
        $this->inconv_normal_category_cont = $this->get_global_inconvenient_periods_cont();
        //echo "<pre>\n".print_r($this->inconv_normal_category_cont , 1)."</pre>";
        $i = 0;
        do {
            $i++;
            foreach ($inconv_normal_slots as $key => $inconv_normal_slot) {
                // $this->db->tables = array('timetable');
                // $this->db->fields = array('customer');
                // $this->db->conditions = array('id = ?');
                // $this->db->condition_values = array($inconv_normal_slot['id']);
                // $this->db->query_generate();
                // $customer_data = $this->db->query_fetch();
                //echo $inconv_normal_slot['id']."-".$inconv_normal_slot['customer']."-".$inconv_normal_slots[$key]['customer']."-".$customer_data[0]['customer']."<br>";
                //$inconv_normal_slot['customer'] = $inconv_normal_slots[$key]['customer'] = $customer_data[0]['customer'];

                // if($inconv_normal_slot['customer'] == ''){
                //     echo $customer_data[0]['customer']."<br>";
                // }

                $current_date = mktime(0, 0, 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $slot_time_from = mktime(intval($inconv_normal_slot['time_from']), bcmod($inconv_normal_slot['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $slot_time_to = mktime(intval($inconv_normal_slot['time_to']), bcmod($inconv_normal_slot['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
                $flag = 0;

                if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '0')) {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_normal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '1') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_travell, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, -1, -1, '', '', 2);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '2') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_break, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '4') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_over, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '5') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_quality, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '6') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_more, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '7') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_some, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, -1, -1, '', '', 0);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '8') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_training, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '10') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_personal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, -1, -1, '', '', 0);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '11') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_voluntary, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '12') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_complementary, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '15') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_standby, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '16') {
                    $this->getEmployeeWorkReportDetailsNormal($rpt_content_dismissal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '3') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '9') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_calltraining, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '13') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_complementary_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '14') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_more_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                } else if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '17') {
                    $this->getEmployeeWorkReportDetailsOnCall($rpt_content_dismissal_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key);
                }else if ($inconv_normal_slot['status'] == 2) {

                    $leave_type = $this->employeeObj->getLeaveType($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                    $leave_max_date = $this->employeeObj->get_leave_max_date($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                    if ($leave_type) {

                        if ($inconv_normal_slot['type'] == '0' || $inconv_normal_slot['type'] == '1' || $inconv_normal_slot['type'] == '2') {
                            $inconv_mod = 1;
                            if ($inconv_normal_slot['type'] == '1') {
                                $inconv_mod = 2;
                            }
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date, $inconv_mod);
                        } else if ($inconv_normal_slot['type'] == '4') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_over, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '5') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_quality, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '6') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_more, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '7') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_some, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date, 0);
                        } else if ($inconv_normal_slot['type'] == '8') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_training, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '10') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_personal, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date, 10);
                        } else if ($inconv_normal_slot['type'] == '11') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_voluntary, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '15') {
                            $this->getEmployeeWorkReportDetailsNormal($rpt_content_leave_standby, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], -1, $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '3') {
                            $this->getEmployeeWorkReportDetailsOnCall($rpt_content_leave_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '9') {
                            $this->getEmployeeWorkReportDetailsOnCall($rpt_content_leave_calltraining, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], $leave_type['no_pay'], $leave_max_date);
                        } else if ($inconv_normal_slot['type'] == '14') {
                            $this->getEmployeeWorkReportDetailsOnCall($rpt_content_leave_more_oncall, $inconv_normal_slots, $flag, $this->employeeObj, $month, $yr, $passed_employee, $slot_time_from, $slot_time_to, $inconv_normal_slot, $key, $leave_type['type'], $leave_type['no_pay'], $leave_max_date);
                        }
                    }
                }
            }

            // re-run
            if ($i < 3) {
                $flag = 1;
            }
        } while ($flag == 1 && !empty($inconv_normal_slots));
        //$this->testWork($inconv_normal_slots, $passed_employee, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall);
        foreach ($inconv_normal_slots as $inconv_normal_slot) {
            // $this->db->tables = array('timetable');
            // $this->db->fields = array('customer');
            // $this->db->conditions = array('id = ?');
            // $this->db->condition_values = array($inconv_normal_slot['id']);
            // $this->db->query_generate();
            // $customer_data = $this->db->query_fetch();
            // $inconv_normal_slot['customer'] = $inconv_normal_slots[$key]['customer'] = $customer_data[0]['customer'];

            $slot_time_from = mktime(intval($inconv_normal_slot['time_from']), bcmod($inconv_normal_slot['time_from'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));

            $slot_time_to = mktime(intval($inconv_normal_slot['time_to']), bcmod($inconv_normal_slot['time_to'] * 100, 100), 0, date('m', strtotime($inconv_normal_slot['date'])), date('d', strtotime($inconv_normal_slot['date'])), date('y', strtotime($inconv_normal_slot['date'])));
            //if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '0' || $inconv_normal_slot['type'] == '1' || $inconv_normal_slot['type'] == '2')) {
            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '0') {

                $rpt_content_normal[$inconv_normal_slot['date']]['3000']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_normal[$inconv_normal_slot['date']]['3000']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '1') {

                $rpt_content_travell[$inconv_normal_slot['date']]['3001']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_travell[$inconv_normal_slot['date']]['3001']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && $inconv_normal_slot['type'] == '2') {

                $rpt_content_break[$inconv_normal_slot['date']]['3002']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_break[$inconv_normal_slot['date']]['3002']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '4')) {
                $rpt_content_over[$inconv_normal_slot['date']]['3004']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_over[$inconv_normal_slot['date']]['3004']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '5')) {
                $rpt_content_quality[$inconv_normal_slot['date']]['3005']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_quality[$inconv_normal_slot['date']]['3005']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '6')) {
                $rpt_content_more[$inconv_normal_slot['date']]['3006']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_more[$inconv_normal_slot['date']]['3006']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '7')) {
                $rpt_content_some[$inconv_normal_slot['date']]['3007']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_some[$inconv_normal_slot['date']]['3007']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '8')) {
                $rpt_content_training[$inconv_normal_slot['date']]['3008']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_training[$inconv_normal_slot['date']]['3008']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '10')) {
                $rpt_content_personal[$inconv_normal_slot['date']]['3009']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_personal[$inconv_normal_slot['date']]['3009']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '11')) {
                $rpt_content_voluntary[$inconv_normal_slot['date']]['3010']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_voluntary[$inconv_normal_slot['date']]['3010']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '12')) {
                $rpt_content_complementary[$inconv_normal_slot['date']]['3011']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_complementary[$inconv_normal_slot['date']]['3011']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '15')) {
                $rpt_content_standby[$inconv_normal_slot['date']]['3014']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_standby[$inconv_normal_slot['date']]['3014']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '16')) {
                $rpt_content_dismissal[$inconv_normal_slot['date']]['3015']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_dismissal[$inconv_normal_slot['date']]['3015']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            // TODO: test this
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '3')) {
                $rpt_content_oncall[$inconv_normal_slot['date']]['3003']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_oncall[$inconv_normal_slot['date']]['3003']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '9')) {
                $rpt_content_calltraining[$inconv_normal_slot['date']]['3003']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_calltraining[$inconv_normal_slot['date']]['3003']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '13')) {
                $rpt_content_complementary_oncall[$inconv_normal_slot['date']]['3012']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_complementary_oncall[$inconv_normal_slot['date']]['3012']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '14')) {
                $rpt_content_more_oncall[$inconv_normal_slot['date']]['3013']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_more_oncall[$inconv_normal_slot['date']]['3013']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }
            if ($inconv_normal_slot['status'] == 1 && ($inconv_normal_slot['type'] == '17')) {
                $rpt_content_dismissal_oncall[$inconv_normal_slot['date']]['3016']['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                $rpt_content_dismissal_oncall[$inconv_normal_slot['date']]['3016']['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], '', '', '', '', $inconv_normal_slot['fkkn']);
            }

            if ($inconv_normal_slot['status'] == 2) {

                $leave_type = $this->employeeObj->getLeaveType($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                $leave_max_date = $this->employeeObj->get_leave_max_date($passed_employee, $inconv_normal_slot['date'], $inconv_normal_slot['time_from'], $inconv_normal_slot['time_to']);
                if ($leave_type) {


                    $timeCodeTmp = $leave_type['type'] + 2000;
                    $timeCodeTmp = $leave_type['type'] == 1 ? 2001 : $timeCodeTmp;

                    //$rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60),2);
                    //$rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60),2), $inconv_normal_slot['customer']);

                    if ($inconv_normal_slot['type'] == '0' || $inconv_normal_slot['type'] == '1' || $inconv_normal_slot['type'] == '2') {

                        $rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    } else if ($inconv_normal_slot['type'] == '4') {
                        $rpt_content_leave_over[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_over[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    } else if ($inconv_normal_slot['type'] == '5') {
                        $rpt_content_leave_quality[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_quality[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    } else if ($inconv_normal_slot['type'] == '6') {
                        $rpt_content_leave_more[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_more[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    } else if ($inconv_normal_slot['type'] == '7') {
                        $rpt_content_leave_some[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_some[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                        // TODO: test this
                    } else if ($inconv_normal_slot['type'] == '8') {
                        $rpt_content_leave_training[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_training[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                        // TODO: test this
                    } else if ($inconv_normal_slot['type'] == '10') {
                        $rpt_content_leave_personal[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_personal[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                        // TODO: test this
                    } else if ($inconv_normal_slot['type'] == '11') {
                        $rpt_content_leave_voluntary[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_voluntary[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                        // TODO: test this
                    } else if ($inconv_normal_slot['type'] == '15') {
                        $rpt_content_leave_standby[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_standby[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                        // TODO: test this
                    } else if ($inconv_normal_slot['type'] == '3') {
                        //$timeCodeTmp = '2001.'.$leave_type['type'];
                        if($timeCodeTmp == '2002'){
                            $timeCodeTmp = '2002.1';
                        }
                        $rpt_content_leave_oncall[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_oncall[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    } else if ($inconv_normal_slot['type'] == '9') {
                        //$timeCodeTmp = '2001.'.$leave_type['type'];
                        if($timeCodeTmp == '2002'){
                            $timeCodeTmp = '2002.1';
                        }
                        $rpt_content_leave_calltraining[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_calltraining[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    } else if ($inconv_normal_slot['type'] == '14') {
                        if($timeCodeTmp == '2002'){
                            $timeCodeTmp = '2002.1';
                        }
                        //$timeCodeTmp = '2001.'.$leave_type['type'];
                        $rpt_content_leave_more_oncall[$inconv_normal_slot['date']][$timeCodeTmp]['total'] += round(($slot_time_to - $slot_time_from) / (60 * 60), 2);
                        $rpt_content_leave_more_oncall[$inconv_normal_slot['date']][$timeCodeTmp]['times'][] = array($slot_time_from, $slot_time_to, round(($slot_time_to - $slot_time_from) / (60 * 60), 2), $inconv_normal_slot['customer'], $leave_type['type'], $timeCodeTmp, $leave_type['no_pay'], $leave_max_date, $inconv_normal_slot['fkkn']);
                    }
                }
            }
        }

        // process for doubling with normal time value
        $keyLeaveType = 13;
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
            &$rpt_content_voluntary,
            &$rpt_content_complementary,
            &$rpt_content_standby,
            &$rpt_content_dismissal,
                /*
                  &$rpt_content_leave,
                  &$rpt_content_leave_over,
                  &$rpt_content_leave_quality,
                  &$rpt_content_leave_more,
                  &$rpt_content_leave_some,
                 */
        );
        if ($oncall_status == 1) {
            $keyLeaveType = 17;
            $rpt_content_all = array(
                &$rpt_content_normal,
                &$rpt_content_travell,
                &$rpt_content_break,
                &$rpt_content_oncall,
                &$rpt_content_over,
                &$rpt_content_quality,
                &$rpt_content_more,
                &$rpt_content_some,
                &$rpt_content_training,
                &$rpt_content_personal,
                &$rpt_content_voluntary,
                &$rpt_content_complementary,
                &$rpt_content_complementary_oncall,
                &$rpt_content_more_oncall,
                &$rpt_content_standby,
                &$rpt_content_dismissal,
                &$rpt_content_dismissal_oncall
                    /*
                      &$rpt_content_leave,
                      &$rpt_content_leave_over,
                      &$rpt_content_leave_quality,
                      &$rpt_content_leave_more,
                      &$rpt_content_leave_some,
                     */
            );
        }
        //echo "<pre>".print_r($rpt_content_dismissal, 1)."</pre>";
        //echo "<pre>".print_r($rpt_content_standby, 1)."</pre>";
        //Converting travel weekend inconvenient to seperate entry
        foreach ($rpt_content_travell as $rpt_key => $rpt_content) {
            foreach ($rpt_content as $keyNormal => $valueNormal) {
                if ((float) $keyNormal < 2000) {
                    $rpt_content_travell[$rpt_key][4000] = $valueNormal;
                    unset($rpt_content_travell[$rpt_key][$keyNormal]);
                }
            }
        }

        //duplicating inconvenients
        foreach ($rpt_content_all as $rpt_key => $rpt_content) {

            if (!is_array($rpt_content)) {
                continue;
            }

            foreach ($rpt_content as $keyNormal => $valueNormal) {
                foreach ($valueNormal as $subkeyNormal => $subvalueNormal) {
                    $subkeyNormal = (float) $subkeyNormal;


                    if ($subkeyNormal < 2000) {

                        foreach ($subvalueNormal['times'] as $subsubkeyNormal => $subsubvalueNormal) {
                            $add_key = ($rpt_key < 3 || $oncall_status == 1) ? $rpt_key : $rpt_key + 1;
                            $add_key = (($rpt_key == 11 || $rpt_key == 12) && $oncall_status != 1) ? $add_key + 2 : $add_key;
                            $rpt_content_all[$rpt_key][$keyNormal][$rpt_key >= $keyLeaveType ? '2000' : 3000 + $add_key]['total'] += $subsubvalueNormal[2];
                            $rpt_content_all[$rpt_key][$keyNormal][$rpt_key >= $keyLeaveType ? '2000' : 3000 + $add_key]['times'][] = $subsubvalueNormal;

                            // update the normal codes
//                            if(!isset($subsubvalueNormal[4]))
//                            {
//                                //$rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal+2000] = $rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal];
//                                unset($rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal]);
//                                if(empty($rpt_content_all[$rpt_key][$keyNormal]))
//                                {
//                                    unset($rpt_content_all[$rpt_key][$keyNormal]);
//                                }
//                            }
                        }
                    }
                }
            }
        }

//        echo "<pre>\n".print_r($rpt_content_dismissal, 1)."</pre>"; 
//        echo "--------------------------------------------------";

        
        /*foreach ($rpt_content_leave_training as $rpt_key => $rpt_content) {
            foreach ($rpt_content as $keyNormal => $valueNormal) {
                if ((float) $keyNormal != '2001' && (float) $keyNormal < 2002) {
                    unset($rpt_content_leave_training[$rpt_key][$keyNormal]);
                    $rpt_content_leave_training[$rpt_key][$keyNormal . ".1"] = $valueNormal;
                }
            }
        }

        foreach ($rpt_content_leave_calltraining as $rpt_key => $rpt_content) {
            foreach ($rpt_content as $keyNormal => $valueNormal) {
                if ((float) $keyNormal != '2001' && (float) $keyNormal < 2002) {
                    unset($rpt_content_leave_calltraining[$rpt_key][$keyNormal]);
                    $rpt_content_leave_calltraining[$rpt_key][$keyNormal . ".1"] = $valueNormal;
                }
            }
        }
        
        foreach ($rpt_content_leave_more_oncall as $rpt_key => $rpt_content) {
            foreach ($rpt_content as $keyNormal => $valueNormal) {
                if ((float) $keyNormal != '2001' && (float) $keyNormal < 2002) {
                    unset($rpt_content_leave_more_oncall[$rpt_key][$keyNormal]);
                    $rpt_content_leave_more_oncall[$rpt_key][$keyNormal . ".3"] = $valueNormal;
                }
            }
        }*/
        
        //echo "<pre>\n".print_r($rpt_content_leave, 1)."</pre>"; 
        //echo "<pre>\n".print_r($rpt_content_leave_oncall, 1)."</pre>"; 
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
        ksort($rpt_content_leave_more_oncall);
        ksort($rpt_content_leave_standby);

        // combine all leaves
        $rpt_content_leave_tmp = $this->combineWorkingHours($rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_leave_voluntary, $rpt_content_leave_more_oncall, $rpt_content_leave_standby);
        $rpt_content_leave = $rpt_content_leave_tmp;
        unset($rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_tmp, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_leave_voluntary, $rpt_content_leave_more_oncall, $rpt_content_leave_standby);
        ksort($rpt_content_leave);


        /////////////////////////////// usig this block for getting oncall ids. using inside for 15-90 and ouside for duplicating non oncall slots to 2014//////////////////////////////////////////
        $inconv_oncall_ids = array();
        $inconv_oncall_dets = $this->employeeObj->get_distinct_oncall_inconvenient_by_month_and_year($month, $yr);
        //echo "<pre>\n".print_r($inconv_oncall_dets, 1)."</pre>";
        //exit();
        foreach ($inconv_oncall_dets as $inconv_oncall_det) {
            $inconv_oncall_ids[] = '2001.' . $inconv_oncall_det['group_id'];
            $inconv_oncall_ids[] = '2001.' . $inconv_oncall_det['group_id'] . '.1';
            $inconv_oncall_ids[] = '2001.' . $inconv_oncall_det['group_id'] . '.2';
            $inconv_oncall_ids[] = '2001.' . $inconv_oncall_det['group_id'] . '.3';

        }

        $inconv_oncall_dets = $this->employeeObj->get_holiday_details($month, $yr);
        foreach ($inconv_oncall_dets as $inconv_oncall_det) {
            //$inconv_oncall_ids[] = '2001.1000.' . $inconv_oncall_det['id'];
            $inconv_oncall_ids[] = '2001.1000.' . (1000+$inconv_oncall_det['group_id']);
        }

        //echo "<pre>".print_r($inconv_oncall_ids, 1)."</pre>"; 
        //exit();
        ///////////////////////////////////////////////////////////////////////////////////////////




        // sorting (needed for Karens)
        foreach ($rpt_content_leave as $key_leave => $value_leave) {
            uasort($value_leave, array("self", "sortWorkingTimeInFullDay"));
            $rpt_content_leave[$key_leave] = $value_leave;
        }
        $temp = array();
        foreach ($rpt_content_leave as $key_leave => $value_leave) {
            foreach ($value_leave as $key => $value) {

                $temp[$key_leave][$key]['total'] = $value['total'];
                usort($value['times'], array("self", "sortWorkingTimeInDay"));
                $temp[$key_leave][$key]['times'] = $value['times'];
            }
        }
        $rpt_content_leave = $temp;
        //echo "<pre>\n".print_r($rpt_content_dismissal, 1)."</pre>"; 
        //$temp = array();
        //echo "<pre>\n".print_r($paseed_customers, 1)."</pre>"; 
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
        $prevDateKarens = '';
        $prev_moth = $month - 12;
        $prev_year = $yr;
        if ($prev_moth <= 0) {
            $prev_moth = 12+$prev_moth;
            $prev_year--;
        }


        $isKarens = 0;
        $isKarensInterval = 5;
        $maxTimeKarens = 8;
        $maxTimeKarens_real = 8;
        $maxTimeLeave = 8;
        $leaveDays = 0;
        $leaveMaxDays = 14;
        $leaveMaxDays2 = 180;
        $aKarensExtra = array();
        $karensTime = 0;
        $karen_i = 0;
        $karens_days = array();
        $karen_over_flow = 0;
        $last_day_time = 0;
        $last_day_customer = '';
        $last_day_slot_type = '';
        $sick_array = array();
        $obj_dona = new dona();


        

        
        
        $prev_sick_start_date = $prev_year."-".str_pad($prev_moth, 2, '0', STR_PAD_LEFT)."-01";
        $prev_sick_end_date = date('Y-m-d',  strtotime("-1 day", strtotime("+12 months", strtotime($prev_sick_start_date))));                                                                                                
        $karens_date_data = $this->get_leave_approved_slots_between_dates($passed_employee, $prev_sick_start_date, $prev_sick_end_date);
        //echo "<pre>\n".print_r($karens_date_data, 1)."</pre>"; 
        
        if (!empty($karens_date_data)) {
            $prevDate = $karens_date_data[0]['date'];
            $prevDateKarens = $karens_date_data[0]['date'];
            $leaveDays = 1;
        }
        
        //echo $this->get_15_90_count($karens_date_data, $isKarensInterval);

        //echo "<pre>\n".print_r($karens_date_data, 1)."</pre>"; exit();
        //echo "----------------------------------------------------------------------------------------------------  <br>";
        foreach ($rpt_content_all as $rpt_key => $rpt_content) {
            if (!is_array($rpt_content)) {
                continue;
            }

            foreach ($rpt_content as $rpt_date_key => $rpt_date_value) {

                foreach ($rpt_date_value as $rpt_content_key => $rpt_content_value) {
                    // convert to float
                    $rpt_content_key_float = (float) $rpt_content_key;


                    //Finding the max_karens_time for this employee on a particular customer
                    // take out the 2008 code
                    if ($rpt_content_key_float == 2008) {
                        unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                        continue;
                    }

                    //if($rpt_content_key=='2000')
                    if ($rpt_content_key_float >= 2000 && $rpt_content_key_float < 2002) {
                        //echo date('Y-m-d H:i', $last_day_time) . "----". $rpt_content_value['times'][0][0] ."<br>";
                        //echo $prevDateKarens."---".$rpt_date_key."<br>";
                        //echo "<pre>\n".$rpt_date_key."".$passed_employee."\n".print_r($sick_summary, 1)."</pre>"; 
                        $sick_summary = $obj_dona->get_employee_sick_summary_between_2_dates($rpt_date_key, $rpt_date_key, $passed_employee);
                        $total_sick = 0;
                        $total_customers_sick = 0;
                        $total_customers_sick_fk = 0;
                        $total_customers_sick_kn = 0;
                        $total_customers_sick_tu = 0;
                        $customer_count = 0;
                        foreach ($sick_summary as $customer_total_hours) {
                            $total_sick += $customer_total_hours['total_time'];
                            if (in_array($customer_total_hours['customer'], $paseed_customers)) {
                                $total_customers_sick += $customer_total_hours['total_time'];
                                if(array_key_exists('fk', $customer_total_hours)){
                                    $total_customers_sick_fk += $customer_total_hours['fk'];
                                }
                                if(array_key_exists('kn', $customer_total_hours)){
                                    $total_customers_sick_kn += $customer_total_hours['kn'];
                                }
                                if(array_key_exists('tu', $customer_total_hours)){
                                    $total_customers_sick_tu += $customer_total_hours['tu'];
                                }

                            }
                            $customer_count++;
                        }
                        $sick_array[$rpt_date_key]['total'] = $total_sick;
                        $sick_array[$rpt_date_key]['customer_total'] = $total_customers_sick;
                        $sick_array[$rpt_date_key]['customer_total_fk'] = $total_customers_sick_fk;
                        $sick_array[$rpt_date_key]['customer_total_kn'] = $total_customers_sick_kn;
                        $sick_array[$rpt_date_key]['customer_total_tu'] = $total_customers_sick_tu;
                        $sick_array[$rpt_date_key]['customer_count'] = $customer_count++;

                        $maxTimeKarens = round($maxTimeKarens_real * $total_customers_sick / $total_sick, 2);
                        //echo $total_sick."-------".$total_customers_sick."-----------".$maxTimeKarens."------".($total_customers_sick/$total_sick*100)."<br>";
                        if (!empty($prevDateKarens) && strtotime($prevDate) != strtotime($rpt_date_key)) {
                            $startDate = DateTime::createFromFormat('Y-m-d', $prevDateKarens); //it was $prevDate. changed because on multi date leaves, it was not splitting8 hours and tranfering rest to next date
                            
                            $endDate = DateTime::createFromFormat('Y-m-d', $rpt_date_key);
                            $intervalDate = $startDate->diff($endDate);
                            //echo $intervalDate->format('%r%a')."<br>";
                            if ($intervalDate->format('%r%a') > $isKarensInterval && $rpt_content_value['times'][0][6] == 1) {
                                
                                $prevDate = '';
                                $prevDateKarens = '';
                                $leaveDays = 0;
                                $isKarens = 0;
                                $karen_i++;
                                $karensTime = 0;
                            } else {
                                if($leaveDays == 1 && $isKarens == 0){
                                    //$karens_date_data)."-".$isKarensInterval;
                                    //echo "<pre>".print_r($karens_date_data,1)."</pre>";
                                    
                                    $leaveDays = $this->get_15_90_count($karens_date_data, $isKarensInterval);//+1 is removed by me as there a problem occured with new life
                                    // problem is 2-14 not taking 14th day executing it to 15-90
                                    //leave start on 25-04 and ends on 29-05
                                    //karens 25-04
                                    // so 08-05 should be in 2-14, but it was in 15-90
                                    
                                }
                                
                                $temp_startDate = DateTime::createFromFormat('Y-m-d', $prevDate);
                                $temp_endDate = DateTime::createFromFormat('Y-m-d', $rpt_date_key);
                                $temp_intervalDate = $temp_startDate->diff($temp_endDate);
                                //echo$prevDate."---".$rpt_date_key."---".$temp_intervalDate->format('%r%a');
                                
                                $prevDateKarens = $rpt_content_value['times'][0][7];
                                $prevDate = $rpt_date_key; // $prevDate was $rpt_content_value['times'][0][7]
                                
                                $leaveDays = $leaveDays + $temp_intervalDate->format('%r%a');
                                //echo "---".$leaveDays."<br>";
                                //usort($rpt_content_value['times'], array("self", "sortWorkingTimeInDay"));

                                if ($last_day_time == $rpt_content_value['times'][0][0] && $karensTime < $maxTimeKarens && $last_day_customer == $rpt_content_value['times'][0][3] && $last_day_slot_type == $rpt_content_value['times'][0][5]
                                ) {

                                    $last_day_time = $last_day_time - 60;
                                    $karen_over_flow = 1;
                                }
                            }
                        }

                        if ((empty($prevDateKarens) || $leaveDays == 1 || $karen_over_flow == 1) && $rpt_content_value['times'][0][6] == 1) {

                            if ($karen_over_flow == 1) {
                                $karen_over_flow = 0;
                                if (($rpt_content_value['times'][0][2] + $karensTime) <= $maxTimeKarens) {
                                    $rpt_content_all[$rpt_key][date('Y-m-d', $last_day_time)][2000]['total'] += $rpt_content_value['times'][0][2];
                                    $rpt_content_all[$rpt_key][date('Y-m-d', $last_day_time)][2000]['times'][] = $rpt_content_value['times'][0];
                                    $rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['total'] -= $rpt_content_value['times'][0][2];
                                    if ($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['total'] == 0) {
                                        unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                    } else {
                                        unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times'][0]);
                                        if (empty($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times']))
                                            unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                    }
                                    if (empty($rpt_content_all[$rpt_key][$rpt_date_key]))
                                        unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                                }else {
                                    
                                    $count_of_slots_in_prev_day_times = count($rpt_content_all[$rpt_key][date('Y-m-d', $last_day_time)][2000]['times']);
                                    $rem_value = $maxTimeKarens - $rpt_content_all[$rpt_key][date('Y-m-d', $last_day_time)][2000]['total'];
                                    $rpt_content_all[$rpt_key][date('Y-m-d', $last_day_time)][2000]['total'] = $maxTimeKarens;
                                    $temp = $rpt_content_value['times'][0];
                                    $temp[2] = $rem_value;
                                    $temp[1] = $temp[0] + $rem_value * 3600;
                                    $rpt_content_all[$rpt_key][date('Y-m-d', $last_day_time)][2000]['times'][$count_of_slots_in_prev_day_times] = $temp;

                                    $rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['total'] -= $rem_value;
                                    $temp = $rpt_content_value['times'][0];
                                    $temp[2] -= $rem_value;
                                    $temp[0] = $temp[0] + $rem_value * 3600;
                                    $rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times'][0] = $temp;
                                }
                                $last_day_time = $rpt_content_value['times'][0][1];
                                $last_day_customer = $rpt_content_value['times'][0][3];
                                $last_day_slot_type = $rpt_content_value['times'][0][5];
                            } else {
                                if (empty($prevDateKarens)) {

                                    $prevDateKarens = $rpt_content_value['times'][0][7];
                                    $prevDate = $rpt_date_key;
                                    $karens_days[] = $rpt_date_key;

                                    $leaveDays = 1;
                                    $isKarens = 1;
                                }

                                // store the date for the extra Karens time

                                $aKarensExtra[0] = $rpt_date_key;
                                // take out the extra time for Karens
                                //usort($rpt_content_value['times'], array("self", "sortWorkingTimeInDay"));
                                if (($karensTime + $rpt_content_value['total']) > $maxTimeKarens) {
                                    foreach ($rpt_content_value['times'] as $keyTime => $valueTime) {
                                        $last_day_time = $valueTime[1];
                                        $last_day_customer = $valueTime[3];
                                        $last_day_slot_type = $valueTime[5];
                                        if (($karensTime + $valueTime[2]) > $maxTimeKarens) {
                                            if ($maxTimeKarens > $karensTime) {
                                                $rpt_content_value['total'] -= ($valueTime[2] - ($maxTimeKarens - $karensTime));


                                                $valueTimeTmp = $valueTime;
                                                $valueTime[2] = $maxTimeKarens - $karensTime;
                                                $valueTime[1] = $valueTime[0] + $valueTime[2] * 3600;

                                                // Karens remaining time moving for the next day
                                                $valueTimeTmp[0] = $valueTime[1];
                                                $valueTimeTmp[2] = number_format(($valueTimeTmp[1] - $valueTimeTmp[0]) / 3600, 2);
                                                $aKarensExtra[] = $valueTimeTmp;

                                                $karensTime += $valueTime[2];
                                                //$karensTime += $valueTimeTmp[2];/// commented by shaju

                                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                            } else {

                                                // Karens remaining time moving for the next day
                                                $aKarensExtra[] = $valueTime;

                                                if ($maxTimeKarens == $karensTime)
                                                    $rpt_content_value['total'] -= $valueTime[2];
                                                $karensTime += $valueTime[2];
                                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times'][$keyTime]);
                                                if (empty($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]['times'])) {
                                                    unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                                }

                                                unset($rpt_content_value['times'][$keyTime]);
                                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                                continue;
                                            }

                                            $rpt_content_value['times'][$keyTime] = $valueTime;
                                        } else {
                                            $karensTime += $valueTime[2];
                                        }
                                    }

                                    if (count($rpt_content_value['times'])) {
                                        
                                    
                                        //commented this for changing 2-14 to 1-14
                                        //$rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key] = $rpt_content_value;
                                        if (array_key_exists(2000, $rpt_content_all[$rpt_key][$rpt_date_key])) {
                                            $rpt_content_all[$rpt_key][$rpt_date_key][2000]['total'] += $rpt_content_value['total'];
                                            $rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'] = array_merge($rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'], $rpt_content_value['times']);
                                        } else {
                                            $rpt_content_all[$rpt_key][$rpt_date_key][2000] = $rpt_content_value;
                                        }
                                    }
                                    if ($karen_over_flow == 1)
                                        $karen_over_flow = 0;
                                } else {
                                    
                                    $count_of_slots_in_time = count($rpt_content_value['times']);
                                    $karensTime += $rpt_content_value['total'];
                                    $last_day_time = $rpt_content_value['times'][$count_of_slots_in_time - 1][1];
                                    $last_day_customer = $rpt_content_value['times'][$count_of_slots_in_time - 1][3];
                                    $last_day_slot_type = $rpt_content_value['times'][$count_of_slots_in_time - 1][5];
                                    if (array_key_exists(2000, $rpt_content_all[$rpt_key][$rpt_date_key])) {
                                        $rpt_content_all[$rpt_key][$rpt_date_key][2000]['total'] += $rpt_content_value['total'];
                                        $rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'] = array_merge($rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'], $rpt_content_value['times']);
                                    } else {

                                        $rpt_content_all[$rpt_key][$rpt_date_key][2000] = $rpt_content_value;
                                    }
                                    unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                }

                                if ($rpt_content_key_float == 2000) {
                                    continue;
                                }


                                // delete the current key


                                if (empty($rpt_content_all[$rpt_key][$rpt_date_key])) {
                                    unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                                }

                                // delete times from the current day form all other records as well
                                //THE NEXT 4 lines are commented by shaju
                                /* unset($rpt_content_normal[$rpt_date_key]);
                                  unset($rpt_content_over[$rpt_date_key]);
                                  unset($rpt_content_quality[$rpt_date_key]);
                                  unset($rpt_content_more[$rpt_date_key]);
                                  unset($rpt_content_some[$rpt_date_key]); */
                                //SOMETIMES NEEDED SHAJU
                                //unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                            }
                        } else {

                            //$leaveTimeCode = '2001';
                            if ($leaveDays > 1 && $leaveDays <= $leaveMaxDays) {
                                // add Karens remaining time 
                                if (count($aKarensExtra) > 1) {
                                    //$leaveTimeCode = '2001';   actual
                                    //$leaveTimeCode = (String)$rpt_content_key;

                                    $temp_karens_date = '';
                                    foreach ($aKarensExtra as $keyKarens => $valueKarens) {
                                        // key 0 is the Karens date, we do not need it here so we skip it

                                        if ($keyKarens > 0) {
                                            //the commented code is for making the overflowed karen hours to the next date..This is changing to the same date.. simply changing 2-14 to 1-14
                                            // add the data in the "$leaveTimeCode" key
                                            //$rpt_content_all[$rpt_key][$rpt_date_key][$valueKarens[5]]['total'] += $valueKarens[2];
                                            //$rpt_content_all[$rpt_key][$rpt_date_key][$valueKarens[5]]['times'][] = $valueKarens;
                                            $rpt_content_all[$rpt_key][$temp_karens_date][$valueKarens[5]]['total'] += $valueKarens[2];
                                            $rpt_content_all[$rpt_key][$temp_karens_date][$valueKarens[5]]['times'][] = $valueKarens;
                                        } else {
                                            $temp_karens_date = $valueKarens;
                                        }
                                    }
                                    // keep the Karens date
                                    $aKarensExtra = array($aKarensExtra[0]);
                                }

                                if ($rpt_content_key_float == 2000) {
                                    
                                    $leaveTimeCode = '2001';
                                } else {
                                    continue;
                                }
                            } elseif ($leaveDays > $leaveMaxDays && $leaveDays <= $leaveMaxDays2) {
                                if(in_array($rpt_content_key_float, $inconv_oncall_ids) && $this->sick_15_90_oncall == 1)
                                    $leaveTimeCode = '2001.0.1';
                                else
                                    $leaveTimeCode = '2001.0';

                                unset($rpt_content_all[$rpt_key][$rpt_date_key][$rpt_content_key_float]);
                                /*if ($rpt_content_key_float == 2000) {
                                    $leaveTimeCode = '2001.0';
                                }
                                elseif($rpt_content_key_float == 2001){
                                    $rpt_content_all[$rpt_key][$rpt_date_key]['2001.0'] = $rpt_content_value;
                                    unset($rpt_content_all[$rpt_key][$rpt_date_key]['2001']);
                                    continue;
                                }
                                else {
                                    continue;
                                }*/
//                                
                                
                            } elseif ($leaveDays > $leaveMaxDays2) {
                                $leaveTimeCode = '2001.0.2';
                                unset($rpt_content_all[$rpt_key][$rpt_date_key][$rpt_content_key_float]);
                            } else {
                                $prevDateKarens = $rpt_content_value['times'][0][7];
                                $prevDate = $rpt_content_value['times'][0][7];
                                continue;
                            }


                            
                            // add the data in the "$leaveTimeCode" key
                            $rpt_content_all[$rpt_key][$rpt_date_key][$leaveTimeCode]['total'] += $rpt_content_value['total'];
                            foreach ($rpt_content_value['times'] as $keyTime => $valueTime) {
                                $rpt_content_all[$rpt_key][$rpt_date_key][$leaveTimeCode]['times'][] = $valueTime;
                            }

                            // delete the "2000" key that was the source
                            //unset($rpt_content_all[$rpt_key][$rpt_date_key]['2000']);
                            if ($rpt_content_key != $leaveTimeCode) {
                                unset($rpt_content_all[$rpt_key][$rpt_date_key][(string) $rpt_content_key]);
                                if (empty($rpt_content_all[$rpt_key][$rpt_date_key])) {
                                    unset($rpt_content_all[$rpt_key][$rpt_date_key]);
                                }
                            }
                        }
                    }
                }
            }
        }

        //              echo "<pre>".print_r($sick_array, 1)."</pre>";
        //
        //        echo "<pre>".print_r($karens_days, 1)."</pre>";
        //        echo "-----------------------------------------------------------------------------------------------";
        //        echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
        //        echo "<pre>".print_r($aKarensExtra, 1)."</pre>";
        // Karens post-processing
        // making all sick karens less than 8 to 8
        if ($this->apply_max_karens == 1) {
            foreach ($rpt_content_all as $rpt_key => $rpt_content) {
                if (!is_array($rpt_content)) {
                    continue;
                }

                foreach ($rpt_content as $rpt_date_key => $rpt_date_value) {

                    foreach ($rpt_date_value as $rpt_content_key => $rpt_content_value) {
                        if ($rpt_content_key == '2000' && $sick_array[$rpt_date_key]['total'] < 8) {
                            $individual_sick_to_be_added = (8 - $sick_array[$rpt_date_key]['total']) / $sick_array[$rpt_date_key]['customer_count'];
                            $rpt_content_all[$rpt_key][$rpt_date_key][2000]['total'] += $individual_sick_to_be_added;
                            if($sick_array[$rpt_date_key]['customer_total_fk'] != 0){
                                $individual_sick_to_be_added_fk = $individual_sick_to_be_added * $sick_array[$rpt_date_key]['customer_total_fk']/($sick_array[$rpt_date_key]['customer_total_fk'] + $sick_array[$rpt_date_key]['customer_total_kn'] + $sick_array[$rpt_date_key]['customer_total_tu']);
                                $rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'][] = array(0, 0, $individual_sick_to_be_added_fk, $rpt_content_value['times'][0][3],'','','','',1);
                            }
                            if($sick_array[$rpt_date_key]['customer_total_kn'] != 0){
                                $individual_sick_to_be_added_kn = $individual_sick_to_be_added * $sick_array[$rpt_date_key]['customer_total_kn']/($sick_array[$rpt_date_key]['customer_total_fk'] + $sick_array[$rpt_date_key]['customer_total_kn'] + $sick_array[$rpt_date_key]['customer_total_tu']);
                                $rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'][] = array(0, 0, $individual_sick_to_be_added_kn, $rpt_content_value['times'][0][3],'','','','',2);
                            }
                            if($sick_array[$rpt_date_key]['customer_total_tu'] != 0){
                                $individual_sick_to_be_added_tu = $individual_sick_to_be_added * $sick_array[$rpt_date_key]['customer_total_tu']/($sick_array[$rpt_date_key]['customer_total_fk'] + $sick_array[$rpt_date_key]['customer_total_kn'] + $sick_array[$rpt_date_key]['customer_total_tu']);
                                $rpt_content_all[$rpt_key][$rpt_date_key][2000]['times'][] = array(0, 0, $individual_sick_to_be_added_tu, $rpt_content_value['times'][0][3],'','','','',3);
                            }
                            
                        }
                    }
                }
            }
            //echo "<pre>".print_r($rpt_content_all, 1)."</pre>";
        }

        if (isset($aKarensExtra[0]) && !empty($aKarensExtra[0])) {
            /* foreach ($karens_days as $karens_day) {

              foreach ($rpt_content_leave[$karens_day] as $rpt_content_key => $rpt_content_value) {
              // convert to float
              $rpt_content_key_float = (float) $rpt_content_key;


              if ($rpt_content_key_float != 2000) {
              $rpt_content_leave[$karens_day]['2000']['total'] += $rpt_content_value['total'];
              if (!isset($rpt_content_leave[$karens_day]['2000']['times'])) {
              $rpt_content_leave[$karens_day]['2000']['times'] = array();
              }
              $rpt_content_leave[$karens_day]['2000']['times'] = array_merge($rpt_content_leave[$karens_day]['2000']['times'], $rpt_content_value['times']);

              unset($rpt_content_leave[$karens_day][(string) $rpt_content_key]);
              }
              }
              } */

//            echo "-----------------------------------------------------------------------------------------------";
//            echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
//            
            // This loop is to take the over flowed karens to next date-- only when there is one leave date in a karens period
            $i_karen = 0;
            $post_date = $aKarensExtra[0];
            foreach ($aKarensExtra as $shift_values) {
                if ($i_karen == 0) {
                    $i_karen++;
                    //commented to make 2-14 to 1-14
                    //$post_date = date('Y-m-d', strtotime('+1 day', strtotime($post_date)));
                } else {

                    $i_karen++;
                    $rpt_content_leave[$post_date][$shift_values[5]]['total'] += $shift_values[2];

                    if (!isset($rpt_content_leave[$post_date][$shift_values[5]]['times'])) {
                        $rpt_content_leave[$post_date][$shift_values[5]]['times'] = array();
                    }
                    $rpt_content_leave[$post_date][$shift_values[5]]['times'] = array_merge($rpt_content_leave[$post_date][$shift_values[5]]['times'], array($shift_values));
                }
            }
        }
//               echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
//        echo "----------------------------------------------------------------" ;
//        echo "<pre>".print_r($aKarensExtra, 1)."</pre>";
//        echo "----------------------------------------------------------------" ;
        //This block is for repeating all non-oncall leaves at 2-14


        //echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
        //inorder to add all leave values in sick 2-14
        foreach ($rpt_content_all as $rpt_key => $rpt_content) {
            if (!is_array($rpt_content)) {
                continue;
            }

            foreach ($rpt_content as $keyNormal => $valueNormal) {

                foreach ($valueNormal as $subkeyNormal => $subvalueNormal) {
                    $subkeyNormal_st = $subkeyNormal;
                    $subkeyNormal = (float) $subkeyNormal;
                    //echo $keyNormal."-".$subkeyNormal."<br>";
                    //if(floatval($subkeyNormal)<2000 || (2001.1<=floatval($subkeyNormal) && floatval($subkeyNormal)<2002))
                    if ($subkeyNormal > 2001 && $subkeyNormal < 2002) {
                        if (!in_array($subkeyNormal_st, $inconv_oncall_ids)) {
                            foreach ($subvalueNormal['times'] as $subsubkeyNormal => $subsubvalueNormal) {

                                $rpt_content_all[$rpt_key][$keyNormal]['2001']['total'] += $subsubvalueNormal[2];
                                $rpt_content_all[$rpt_key][$keyNormal]['2001']['times'][] = $subsubvalueNormal;

                                // update the normal codes
                                if (!isset($subsubvalueNormal[4])) {
                                    //$rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal+2000] = $rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal];
                                    unset($rpt_content_all[$rpt_key][$keyNormal][$subkeyNormal]);
                                    if (empty($rpt_content_all[$rpt_key][$keyNormal])) {
                                        unset($rpt_content_all[$rpt_key][$keyNormal]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //echo "--------------------------------------------------------------------------------";
        //echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
        //for taking FP and SEM values to 1

        //$hour_to_days = array('2004', '2002','2002.1');
        $hour_to_days = array();
        if($this->sem_leave_days == 1){
            array_push($hour_to_days, '2002');
            array_push($hour_to_days, '2002.1');
        }
        if($this->vab_leave_days == 1){
            array_push($hour_to_days, '2003');
        }
        if($this->fp_leave_days == 1){
            array_push($hour_to_days, '2004');
        }
        if($this->nopay_leave_days == 1){
            array_push($hour_to_days, '2005');
        }
        if($this->other_leave_days == 1){
            array_push($hour_to_days, '2007');
        }
        if ($_SESSION['company_id'] == 8 || $_SESSION['company_id'] == 7){
            array_pop($hour_to_days);
            array_pop($hour_to_days);
        }
        //echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
        foreach ($rpt_content_leave as $key_leave => $value_leave) {
            foreach ($value_leave as $key_time => $key_time_array) {
                $org_key_time = $key_time;
                if($key_time == '2002.1'){
                    $key_time = '2002';
                }

                if (in_array($key_time, $hour_to_days)) {
                    $rpt_content_leave[$key_leave][$key_time]['total'] = 1;
                    $loop_i = 0;
                    $temp_fk_sum = array("1"=>0,"2"=>0,"3"=>0);
                   
                    foreach ($key_time_array['times'] as $key_cust_time => $cust_time_array) {
                        if ($loop_i == 0) {
                            $rpt_content_leave[$key_leave][$key_time]['times'] = $key_time_array['times'];
                            $rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time][2] = 1;
                            $rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time][0] = 0;
                            $rpt_content_leave[$key_leave][$key_time]['times'][$key_cust_time][1] = 0;
                            $temp_fk_sum[$cust_time_array[8]] += $cust_time_array[2];
                        } else {
                            $temp_fk_sum[$cust_time_array[8]] += $cust_time_array[2];
                            unset($rpt_content_leave[$key_leave][$org_key_time]['times'][$key_cust_time]);

                        }

                        if($org_key_time == '2002.1'){
                            //echo $key_leave."--".$org_key_time;
                                unset($rpt_content_leave[$key_leave][$org_key_time]);
                        }
                        $loop_i++;
                    }
                    $rpt_content_leave[$key_leave][$key_time]['times'][0][8] = array_search(max($temp_fk_sum), $temp_fk_sum);
                }
            }
        }

                           //echo "<pre>".print_r($rpt_content_leave, 1)."</pre>";
    }

    public function toVisma600($return = false, $date = null, $c_list = null, $userSigned = array() ,&$export, &$error, $fkkn_split) {
        //$smarty = new smartySetup(array('export-config.xml'));
        $smarty = new smartySetup(array('export-config.xml', "user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml", "gdschema.xml"),FALSE);
        $obj_timetable = new timetable();
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
        $this->apply_max_karens = $company_details['apply_max_karens'];
        $this->sem_leave_days = $company_details['sem_leave_days'];
        $this->vab_leave_days = $company_details['vab_leave_days'];
        $this->fp_leave_days = $company_details['fp_leave_days'];
        $this->nopay_leave_days = $company_details['nopay_leave_days'];
        $this->other_leave_days = $company_details['other_leave_days'];
        $this->sick_15_90_oncall = $company_details['sick_15_90_oncall'];

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
        foreach ($this->timeCodes as $tItem) {
            if (!empty($tItem['name']) && !empty($tItem['vacation_saving'])) {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['vacation_saving']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        
        $timeCodes = $xmlDoc->createElement('TimeCodes');
        foreach ($this->timeCodes as $tItem) {
            if (!empty($tItem['name']) && !empty($tItem['vacation_paid'])) {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['vacation_paid']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        
        $timeCodes = $xmlDoc->createElement('TimeCodes');
        foreach ($this->timeCodes as $tItem) {
            if (!empty($tItem['name']) && !empty($tItem['monthly'])) {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['monthly']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        
        $timeCodes = $xmlDoc->createElement('TimeCodes');
        foreach ($this->timeCodes as $tItem) {
            if (!empty($tItem['name']) && !empty($tItem['monthly_office'])) {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['monthly_office']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        
        $timeCodes = $xmlDoc->createElement('TimeCodes');
        foreach ($this->timeCodes as $tItem) {
            if (!empty($tItem['name']) && !empty($tItem['monthly_office_hour'])) {
                //$sItem['name'] = mb_convert_encoding($tItem['name'], 'ISO-8859-1');
                $tc = $xmlDoc->createElement('TimeCode');
                $tc->setAttribute('Code', $tItem['monthly_office_hour']);
                $tc->setAttribute('TimeCodeName', $tItem['name']);
                $timeCodes->appendChild($tc);
            }
        }
        $rootElement->appendChild($timeCodes);
        
        // TAG: TimeCodes - end
        
        
        
        
        
        // TAG: Projects
        $Projects = $xmlDoc->createElement('Projects');

        /* if(isset($c_list) && is_array($c_list))
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
          } */

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
        if (isset($date[0]) && isset($date[1])) {
            $salaryDataEmployee->setAttribute('FromDate', date(self::VISMA_DATE_FORMAT, $date[0]));
            $salaryDataEmployee->setAttribute('ToDate', date(self::VISMA_DATE_FORMAT, $date[1]));
        }
        $salaryData = $rootElement->appendChild($salaryDataEmployee);
        $employeeTimes = array();

        $customer_list = array();

        if (isset($c_list) && is_array($c_list)) {


            foreach ($c_list as $c_list_item) {
                $customer_list[$c_list_item['username']] = $c_list_item;
            }
        }


        $userSignedEmp = array();



        foreach ($this->result as $keyResult => $employes) {
            if (!empty($employes['employee'])) {
                foreach ($employes['employee'] as $keyEmployee => $employee) {
                    if (count(array_keys($userSigned)) && !in_array($employee['emp_username'], array_keys($userSigned))) {
                        unset($this->result[$keyResult]['employee'][$keyEmployee]);
                        continue;
                    }

                    $this->db->fields = array('username','century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date', 'salary_type', 'leave_in_advance', 'remaining_sem_leave', 'sem_leave_todate', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days');
                    $this->db->tables = array('employee');
                    $this->db->conditions = array('username="' . $employee['emp_username'] . '"');

                    $empData = $this->db->query_fetch();
                    $userSignedEmp[$employee['emp_username']] = $empData[0];
                    
                    /*$this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
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
                      $employeeTimes[$empData[0]['social_security']]['times'] = array_merge($employeeTimes[$empData[0]['social_security']]['times'], $data); */
                }
            }
        }

        $month = $this->exportMonth;
        $yr = $this->exportYear;
        $error_flag = 0;
        $div_style = 'background-color: #e0e0d1';
        //echo "<pre>".print_r($userSignedEmp,1)."</pre>";
        foreach ($userSigned as $key => $value) {

            //if($key == 'dodo001'){

            $rpt_content_normal = array();
            $rpt_content_travell = array();
            $rpt_content_break = array();
            $rpt_content_oncall = array();
            $rpt_content_over = array();
            $rpt_content_quality = array();
            $rpt_content_more = array();
            $rpt_content_some = array();
            $rpt_content_training = array();
            $rpt_content_personal = array();
            $rpt_content_calltraining = array();
            $rpt_content_voluntary = array();
            $rpt_content_complementary = array();
            $rpt_content_complementary_oncall = array();
            $rpt_content_more_oncall = array();
            $rpt_content_standby = array();
            $rpt_content_dismissal = array();
            $rpt_content_dismissal_oncall = array();

            $rpt_content_leave = array();
            $rpt_content_leave_over = array();
            $rpt_content_leave_quality = array();
            $rpt_content_leave_more = array();
            $rpt_content_leave_some = array();
            $rpt_content_leave_training = array();
            $rpt_content_leave_personal = array();
            $rpt_content_leave_voluntary = array();
            $rpt_content_leave_oncall = array();
            $rpt_content_leave_calltraining = array();
            $rpt_content_leave_more_oncall = array();
            $rpt_content_leave_standby = array();

            $passed_employee = $key;
            $passed_customers = $value;

            $this->bookDistributionProjects = array();
            $this->bookDistributionProjectsSum = 0;
            $salary_mod = $userSignedEmp[$key]['salary_type'];
            
            if($userSignedEmp[$key]['sem_leave_days'] != $this->sem_leave_days)
                $this->sem_leave_days  =  $userSignedEmp[$key]['sem_leave_days'];
            if($userSignedEmp[$key]['vab_leave_days'] != $this->vab_leave_days)
                $this->vab_leave_days  =  $userSignedEmp[$key]['vab_leave_days'];
            if($userSignedEmp[$key]['fp_leave_days'] != $this->fp_leave_days)
                $this->fp_leave_days  =  $userSignedEmp[$key]['fp_leave_days'];
            if($userSignedEmp[$key]['nopay_leave_days'] != $this->nopay_leave_days)
                $this->nopay_leave_days  =  $userSignedEmp[$key]['nopay_leave_days'];
            if($userSignedEmp[$key]['other_leave_days'] != $this->other_leave_days)
                $this->other_leave_days  =  $userSignedEmp[$key]['other_leave_days'];
            
            
             $salary_name = '';
            if($userSignedEmp[$key]['salary_type'] == 1)
                $salary_name = $smarty->translate['external_vacation_saving'];
            elseif($userSignedEmp[$key]['salary_type'] == 2)
                $salary_name = $smarty->translate['external_vacation_paid'];
            elseif($userSignedEmp[$key]['salary_type'] == 3)
                $salary_name = $smarty->translate['external_monthly'];
            elseif($userSignedEmp[$key]['salary_type'] == 4)
                $salary_name = $smarty->translate['external_monthly_office'];
            elseif($userSignedEmp[$key]['salary_type'] == 5)
                $salary_name = $smarty->translate['external_monthly_office_hour'];
            
            //$month = 9;
            //$passed_employee = 'joni001';

            $this->processWorkingTime($passed_employee, $passed_customers, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal, $rpt_content_dismissal_oncall);


            // TAG: Times

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
                $rpt_content_voluntary,
                $rpt_content_complementary,
                $rpt_content_oncall,
                $rpt_content_calltraining,
                $rpt_content_complementary_oncall,
                $rpt_content_more_oncall,
                $rpt_content_standby,
                $rpt_content_dismissal, 
                $rpt_content_dismissal_oncall, 
                $rpt_content_leave,
                    /*
                      $rpt_content_leave_over,
                      $rpt_content_leave_quality,
                      $rpt_content_leave_more,
                      $rpt_content_leave_some,
                      $rpt_content_leave_oncall,
                     */
            );
//            echo "-----------------------Ordinary-------------------------";
//            echo "<pre>".print_r($rpt_content_normal, 1)."</pre>";
//            echo "-----------------------Travel-------------------------";
//            echo "<pre>".print_r($rpt_content_travell, 1)."</pre>";
//            echo "-----------------------Break-------------------------";
//            echo "<pre>".print_r($rpt_content_break, 1)."</pre>";
//            echo "-----------------------Over-------------------------";
//            echo "<pre>".print_r($rpt_content_over, 1)."</pre>";
//            echo "-----------------------quality-------------------------";
//            echo "<pre>".print_r($rpt_content_quality, 1)."</pre>";
//            echo "-----------------------more-------------------------";
//            echo "<pre>".print_r($rpt_content_more, 1)."</pre>";
//            echo "-----------------------Some-------------------------";
//            echo "<pre>".print_r($rpt_content_some, 1)."</pre>";
//            echo "-----------------------Trainig-------------------------";
//            echo "<pre>".print_r($rpt_content_training, 1)."</pre>";
//            echo "-----------------------Personal-------------------------";
//            echo "<pre>".print_r($rpt_content_personal, 1)."</pre>";
//            echo "-----------------------Voluntary-------------------------";
//            echo "<pre>".print_r($rpt_content_voluntary, 1)."</pre>";
//            echo "-----------------------Complementary-------------------------";
//            echo "<pre>".print_r($rpt_content_complementary, 1)."</pre>";
//            echo "-----------------------oncall-------------------------";
//            echo "<pre>".print_r($rpt_content_oncall, 1)."</pre>";
//            echo "-----------------------Call Training-------------------------";
//            echo "<pre>".print_r($rpt_content_calltraining, 1)."</pre>";
//            echo "-----------------------complementary oncall-------------------------";
//            echo "<pre>".print_r($rpt_content_complementary_oncall, 1)."</pre>";
            //echo "<pre>".print_r($rpt_content_more_oncall, 1)."</pre>";
           //echo "<pre>".print_r($rpt_content_all, 1)."</pre>";
            // free up some memory
            unset(
                    $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal, $rpt_content_dismissal_oncall
            );

            $iWriteEmployee = 0;
            foreach ($rpt_content_all as $key_array => $rpt_content) {

                if (!is_array($rpt_content) || count($rpt_content) == 0) {
                    continue;
                }
                
                foreach ($rpt_content as $keyDate => $valueDate) {
                    if (!is_array($valueDate)) {
                        continue;
                    }

                    foreach ($valueDate as $timeCode => $timeValue) {
                        if (!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times'])) {
                            continue;
                        }
                        
                        foreach ($timeValue['times'] as $keyTimeValue => $valueTimeValue) {
                            $temp_time_code = $timeCode;
                            $extern_time_code = '';
                            if ($key_array == 10 || $key_array == 13 || $key_array == 12 || $key_array == 7 || $key_array == 14 || $key_array == 16 || $key_array == 17) {
                                if ($timeCode != '3008' && $timeCode != '3011' && $timeCode != '3015' && $timeCode != '3016' && ($timeCode < 1000 || $timeCode >= 2000)) {
                                    if ($key_array == 12 || $key_array == 7){
                                        if($fkkn_split){
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.1', 0, $salary_mod, $valueTimeValue[8]);
                                            $temp_time_code = $timeCode . '.1';
                                        }else{
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.1', 0, $salary_mod);
                                            $temp_time_code = $timeCode . '.1';
                                        }
                                    }
                                    elseif ($key_array == 13 || $key_array == 10){
                                        if($fkkn_split){
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.2', 0, $salary_mod, $valueTimeValue[8]);
                                            $temp_time_code = $timeCode . '.2';
                                        }else{
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.2', 0, $salary_mod);
                                            $temp_time_code = $timeCode . '.2';
                                        }
                                    }
                                    elseif ($key_array == 14){
                                        if($fkkn_split){
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.3', 0, $salary_mod, $valueTimeValue[8]);
                                            $temp_time_code = $timeCode . '.3';
                                        }else{
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.3', 0, $salary_mod);
                                            $temp_time_code = $timeCode . '.3';
                                        }
                                    }
                                    elseif ($key_array == 16 || $key_array == 17){
                                        if($fkkn_split){
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.4', 0, $salary_mod, $valueTimeValue[8]);
                                            $temp_time_code = $timeCode . '.4';
                                        }else{
                                            $extern_time_code = $this->identifyTimeCode($timeCode . '.4', 0, $salary_mod);
                                            $temp_time_code = $timeCode . '.4';
                                        }
                                    }
                                    
                                }
                                else {
                                    if($fkkn_split){
                                        $extern_time_code = $this->identifyTimeCode($timeCode, 0, $salary_mod, $valueTimeValue[8]);
                                    }else{
                                        $extern_time_code = $this->identifyTimeCode($timeCode, 0, $salary_mod);
                                    }
                                }
                            } else {
                                if($fkkn_split){
                                    $extern_time_code = $this->identifyTimeCode($timeCode, 0, $salary_mod, $valueTimeValue[8]);
                                }else{
                                    $extern_time_code = $this->identifyTimeCode($timeCode, 0, $salary_mod);
                                }
                            }
                            if($extern_time_code && $customer_list[$valueTimeValue[3]]['code']){
                                $time = $xmlDoc->createElement('Time');
                                $time->setAttribute('DateOfReport', $keyDate);

    //                                    
                                $time->setAttribute('TimeCode', $extern_time_code);

                                $time->setAttribute('SumOfHours', $valueTimeValue[2]);
                                $time->setAttribute('TimeStart', date('H.i', (int) $valueTimeValue[0]));
                                $time->setAttribute('TimeEnd', str_replace('00.00', '24.00', date('H.i', (int) $valueTimeValue[1])));
                                //$time->setAttribute('ProjectCode', $customer_list[$valueTimeValue[3]]['code']);
                                $time->setAttribute('ResultUnitCode', $customer_list[$valueTimeValue[3]]['code']);
                                // TAG: Time - end

                                $times->appendChild($time);
                            }else{
                                
                                if($error_flag == 0)
                                    $error = '<div style="" class="alert alert-success export-error-box">';
                                $error_flag = 1;
                                $hour_check_flag = 0;
                                $cust_name = '';
                                $emp_name = '';
                                if($_SESSION['company_sort_by'] == 2){
                                   $cust_name =  $customer_list[$valueTimeValue[3]]['last_name']. ' ' .$customer_list[$valueTimeValue[3]]['first_name']; 
                                   $emp_name = $userSignedEmp[$key]['last_name']. ' ' .$userSignedEmp[$key]['first_name'];
                                }elseif($_SESSION['company_sort_by'] == 1){
                                    $cust_name =  $customer_list[$valueTimeValue[3]]['first_name']. ' ' .$customer_list[$valueTimeValue[3]]['last_name']; 
                                    $emp_name = $userSignedEmp[$key]['first_name']. ' ' .$userSignedEmp[$key]['last_name'];
                                }
                                
                                $timeCodeName = $this->identifyTimeCodeName((string)$temp_time_code);
                                if($div_style == 'background-color: #e0e0d1')
                                    $div_style = 'background-color: #e3edf0';
                                else
                                    $div_style = 'background-color: #e0e0d1';
                                
                                $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">';
                                $error .= '<div style="padding-left:10px; margin-bottom:2px; background:white">'.htmlentities('<Time DateOfReport="'.$keyDate.'"');
                                if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type'])){
                                    $error .=   '<font style="color:red;"> TimeCode="'.$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type']).'"</font> ' ;
                                }else{
                                    $error .= htmlentities(' TimeCode="'.$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type']).'" ');
                                }
                                $error .= htmlentities('SumOfHours="'.$valueTimeValue[2].'" TimeStart="'.date('H.i', (int) $valueTimeValue[0]).'" TimeEnd="'.str_replace('00.00', '24.00', date('H.i', (int) $valueTimeValue[1])).'"');
                                if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                                    $error .= '<font style="color:red;"> ResultUnitCode="'.$customer_list[$valueTimeValue[3]]['code'].'"</font>';
                                }else{
                                    $error .= htmlentities('ResultUnitCode="'.$customer_list[$valueTimeValue[3]]['code'].'"');
                                }
                            //echo $timeCode.$emp_name.$salary_name;
                            $error .= htmlentities('/>')."</div><br>".
                                       $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                       $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                       $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$keyDate.'&employee='.$key.'&customer='.$valueTimeValue[3].'&return_page=export\',1)">'.$keyDate.'</a><br>'.
                                       $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                       $smarty->translate['internal_code'].': '.$temp_time_code.'<br>'.
                                       $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$temp_time_code).'<br>';
                                       if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type'])){
                                        $hour_check_flag = 1;   
                                        if($timeCodeName)
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                        else
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                        $error .= $smarty->translate['hours_missing'].': '.$valueTimeValue[2]."<br>";
                                       }
                                       if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                                        if(empty($customer_list[$valueTimeValue[3]]))
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                        elseif($customer_list[$valueTimeValue[3]]['code'] == '')
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                        if(!$hour_check_flag)
                                            $error .= $smarty->translate['hours'].': '.$valueTimeValue[2]."<br>";
                                       }
                                       $error .= '</div>';
                                
                            }
                            // for BookDistributionProjects TAG
                            
                            $this->bookDistributionProjects[$customer_list[$valueTimeValue[3]]['code']] += $valueTimeValue[2];
                            $this->bookDistributionProjectsSum += $valueTimeValue[2];

                            $iWriteEmployee = 1;
                            //}
                        }
                    }
                }
            }
            
            ///////////////////////// start of code for vacation saving and ////////////////////////////////
            if($userSignedEmp[$key]['salary_type'] != 2){
                $extra_time_code_taken = '2002.2';
                $extra_time_code_saved = '2002.3';
                $external = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$key]['salary_type']);
                $external_saved = $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$key]['salary_type']);
                
                if((string)$external !== $extra_time_code_taken && $external != '' && (string)$external_saved !== $extra_time_code_saved && $external_saved != ''){

                    $saved_sem_credentials = $obj_timetable->get_saved_sem_leave_credentials($company_details, $userSignedEmp[$key], $month, $yr);
                    
                    $taken_sem_leaves = $saved_sem_credentials['this_fyear_takens_sem_leave_days']+0;
                    $cumulated_earned_sem_leaves = $saved_sem_credentials['this_fyear_earned_days'] + $saved_sem_credentials['former_year_remaining_days'];
                    
                    if($taken_sem_leaves !=0 || $cumulated_earned_sem_leaves != 0){
                        
                        $time = $xmlDoc->createElement('Time');
                        $time->setAttribute('DateOfReport', $yr."-".$month."-01");
                        $time->setAttribute('TimeCode', $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$key]['salary_type']));
                        $time->setAttribute('SumOfHours', $taken_sem_leaves);
                        $time->setAttribute('TimeStart', "00.00");
                        $time->setAttribute('TimeEnd', "23.59");
                        $time->setAttribute('ResultUnitCode', $customer_list[$valueTimeValue[3]]['code']);
                        $times->appendChild($time);
                        
                        
                        $time = $xmlDoc->createElement('Time');
                        $time->setAttribute('DateOfReport', $yr."-".$month."-01");
                        $time->setAttribute('TimeCode', $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$key]['salary_type']));
                        $time->setAttribute('SumOfHours', $cumulated_earned_sem_leaves);
                        $time->setAttribute('TimeStart', "00.00");
                        $time->setAttribute('TimeEnd', "23.59");
                        $time->setAttribute('ResultUnitCode', $customer_list[$valueTimeValue[3]]['code']);
                        $times->appendChild($time);
                        
                    }
                }else{
                    if($error_flag == 0)
                        $error = '<div style="" class="alert alert-success export-error-box">';
                    $error_flag = 1;
                    $hour_check_flag = 0;
                    $cust_name = '';
                    $emp_name = '';
                    if($_SESSION['company_sort_by'] == 2){
                       $cust_name =  $customer_list[$valueTimeValue[3]]['last_name']. ' ' .$customer_list[$valueTimeValue[3]]['first_name']; 
                       $emp_name = $userSignedEmp[$key]['last_name']. ' ' .$userSignedEmp[$key]['first_name'];
                    }elseif($_SESSION['company_sort_by'] == 1){
                        $cust_name =  $customer_list[$valueTimeValue[3]]['first_name']. ' ' .$customer_list[$valueTimeValue[3]]['last_name']; 
                        $emp_name = $userSignedEmp[$key]['first_name']. ' ' .$userSignedEmp[$key]['last_name'];
                    }

                    if((string)$external == $extra_time_code_taken || $external == ''){
                        $temp_time_code = $extra_time_code_taken;
                        $timeCodeName = $this->identifyTimeCodeName((string)$temp_time_code);
                        if($div_style == 'background-color: #e0e0d1')
                            $div_style = 'background-color: #e3edf0';
                        else
                            $div_style = 'background-color: #e0e0d1';
                        
                        $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">';
                        $error .= '<div style="padding-left:10px; margin-bottom:2px; background:white">'.htmlentities('<Time DateOfReport="'.$keyDate.'"');
                        if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type'])){
                            $error .=   '<font style="color:red;"> TimeCode="'.$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type']).'"</font> ' ;
                        }else{
                            $error .= htmlentities(' TimeCode="'.$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type']).'" ');
                        }
                        $error .= htmlentities('SumOfHours="'.$valueTimeValue[2].'" TimeStart="'.date('H.i', (int) $valueTimeValue[0]).'" TimeEnd="'.str_replace('00.00', '24.00', date('H.i', (int) $valueTimeValue[1])).'"');
                        if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                            $error .= '<font style="color:red;"> ResultUnitCode="'.$customer_list[$valueTimeValue[3]]['code'].'"</font>';
                        }else{
                            $error .= htmlentities('ResultUnitCode="'.$customer_list[$valueTimeValue[3]]['code'].'"');
                        }
                        //echo $timeCode.$emp_name.$salary_name;
                        $error .= htmlentities('/>')."</div><br>".
                               $smarty->translate['customer'].': '.$cust_name.'<br>'.
                               $smarty->translate['employee'].': '.$emp_name.'<br>'.
                               $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$keyDate.'&employee='.$key.'&customer='.$valueTimeValue[3].'&return_page=export\',1)">'.$keyDate.'</a><br>'.
                               $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                               $smarty->translate['internal_code'].': '.$temp_time_code.'<br>'.
                               $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$temp_time_code).'<br>';
                               if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type'])){
                                $hour_check_flag = 1;   
                                if($timeCodeName)
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                else
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                $error .= $smarty->translate['hours_missing'].': '.$valueTimeValue[2]."<br>";
                               }
                               if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                                if(empty($customer_list[$valueTimeValue[3]]))
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                elseif($customer_list[$valueTimeValue[3]]['code'] == '')
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                if(!$hour_check_flag)
                                    $error .= $smarty->translate['hours'].': '.$valueTimeValue[2]."<br>";
                               }
                               $error .= '</div>';
                    }

                    if((string)$external_saved == $extra_time_code_saved || $external_saved == ''){
                        $temp_time_code = $extra_time_code_saved;
                        $timeCodeName = $this->identifyTimeCodeName((string)$temp_time_code);
                        if($div_style == 'background-color: #e0e0d1')
                            $div_style = 'background-color: #e3edf0';
                        else
                            $div_style = 'background-color: #e0e0d1';
                        
                        $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">';
                        $error .= '<div style="padding-left:10px; margin-bottom:2px; background:white">'.htmlentities('<Time DateOfReport="'.$keyDate.'"');
                        if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type'])){
                            $error .=   '<font style="color:red;"> TimeCode="'.$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type']).'"</font> ' ;
                        }else{
                            $error .= htmlentities(' TimeCode="'.$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type']).'" ');
                        }
                        $error .= htmlentities('SumOfHours="'.$valueTimeValue[2].'" TimeStart="'.date('H.i', (int) $valueTimeValue[0]).'" TimeEnd="'.str_replace('00.00', '24.00', date('H.i', (int) $valueTimeValue[1])).'"');
                        if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                            $error .= '<font style="color:red;"> ResultUnitCode="'.$customer_list[$valueTimeValue[3]]['code'].'"</font>';
                        }else{
                            $error .= htmlentities('ResultUnitCode="'.$customer_list[$valueTimeValue[3]]['code'].'"');
                        }
                        //echo $timeCode.$emp_name.$salary_name;
                        $error .= htmlentities('/>')."</div><br>".
                               $smarty->translate['customer'].': '.$cust_name.'<br>'.
                               $smarty->translate['employee'].': '.$emp_name.'<br>'.
                               $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$keyDate.'&employee='.$key.'&customer='.$valueTimeValue[3].'&return_page=export\',1)">'.$keyDate.'</a><br>'.
                               $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                               $smarty->translate['internal_code'].': '.$temp_time_code.'<br>'.
                               $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$temp_time_code).'<br>';
                               if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$key]['salary_type'])){
                                $hour_check_flag = 1;   
                                if($timeCodeName)
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                else
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                $error .= $smarty->translate['hours_missing'].': '.$valueTimeValue[2]."<br>";
                               }
                               if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                                if(empty($customer_list[$valueTimeValue[3]]))
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                elseif($customer_list[$valueTimeValue[3]]['code'] == '')
                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                if(!$hour_check_flag)
                                    $error .= $smarty->translate['hours'].': '.$valueTimeValue[2]."<br>";
                               }
                               $error .= '</div>';
                    }
                    
                }
            }
            
            /////////////////////////end of code for vacation saving and ////////////////////////////////
            
            
            

            // no valid / complete time data stored do not write the info in the export
            if ($iWriteEmployee == 0) {
                continue;
            }

            //$empTag = $userSignedEmp[$value];
            ///////////////////////////////////////////////////////////////////////////


            $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date');
            $this->db->tables = array('employee');
            $this->db->conditions = array('username="' . $key . '"');
            $this->db->query_generate();
            $empData = $this->db->query_fetch();
            // TAG: Employee
            $empTag = $xmlDoc->createElement('Employee');
            $empTag->setAttribute('EmploymentNo', ltrim($empData[0]['code']));
            $empTag->setAttribute('Signature', mb_substr($empData[0]['first_name'], 0, 1) . mb_substr($empData[0]['last_name'], 0, 1));
            $empTag->setAttribute('FirstName', $empData[0]['first_name']);
            $empTag->setAttribute('Name', $empData[0]['last_name']);
            //$empTag->setAttribute('PersonalNo', substr($empData[0]['social_security'], 0, 6).'-'.substr($empData[0]['social_security'], -4));
            $empTag->setAttribute('PersonalNo', $empData[0]['century'] . $empData[0]['social_security']);
            $empTag->setAttribute('HourlyWage', '0');
            $empTag->setAttribute('EmplCategory', '1');
            $empTag->setAttribute('FromDate', date(self::VISMA_DATE_FORMAT, $this->meta['fromDate']));
            $empTag->setAttribute('ToDate', date(self::VISMA_DATE_FORMAT, $this->meta['toDate']));
            // TAG: Employee - end
            // TAG: NormalWorkingTimes
            $normalWorkingTimes = $this->generateNormalWorkingTimes($this->meta['fromDate'], $this->meta['toDate'], $xmlDoc);
            $empTag->appendChild($normalWorkingTimes);
            // TAG: echo "<pre>\n".print_r($userSignedEmp , 1)."</pre>";NormalWorkingTimes - end

            if (isset($employee['customer']) && isset($customer_list[$employee['customer']])) {
                $employee['customer'] = $customer_list[$employee['customer']]['code'];
            }

            $data = $this->convEmployee($employee, $employes['week']);

            //$userSignedEmp[$employee['emp_username']] = $empTag;

            $employeeTimes[$empData[0]['social_security']]['tag'] = $empTag;
            $employeeTimes[$empData[0]['social_security']]['times'] = !is_array($employeeTimes[$empData[0]['social_security']]['times']) ? array() : $employeeTimes[$empData[0]['social_security']]['times'];
            $employeeTimes[$empData[0]['social_security']]['times'] = array_merge($employeeTimes[$empData[0]['social_security']]['times'], $data);

            //////////////////////////////////////////////////////////////////////////



            $empTag->appendChild($times);
            // TAG: Times - end
            // TAG: TimeAdjustments
            $timeAdjustments = $xmlDoc->createElement('TimeAdjustments');
            $empTag->appendChild($timeAdjustments);
            // TAG: TimeAdjustments - end
            // TAG: TimeBalances
            $timeBalances = $xmlDoc->createElement('TimeBalances');
            $timeBalance = $xmlDoc->createElement('TimeBalance');
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
            foreach ($this->bookDistributionProjects as $keyBook => $valueBook) {
                $bookDistributionProject = $xmlDoc->createElement('BookDistributionProject');
                $bookDistributionProject->setAttribute('ProjectCode', $keyBook);
                $bookDistributionProject->setAttribute('Distribution', number_format($valueBook * 100 / $this->bookDistributionProjectsSum, 6));
                $bookDistributionProjects->appendChild($bookDistributionProject);

                $bookDistributionResultUnit = $xmlDoc->createElement('BookDistributionResultUnit');
                $bookDistributionResultUnit->setAttribute('ResultUnitCode', $keyBook);
                $bookDistributionResultUnit->setAttribute('Distribution', number_format($valueBook * 100 / $this->bookDistributionProjectsSum, 6));
                $bookDistributionResultUnits->appendChild($bookDistributionResultUnit);

                // save the used project in the "project" node
                if (isset($c_list) && is_array($c_list)) {
                    foreach ($c_list as $keyProject => $valueProject) {
                        if (!empty($valueProject['code']) && $valueProject['code'] == $keyBook) {
                            $Project = $xmlDoc->createElement('Project');
                            $Project->setAttribute('Code', $valueProject['code']);
                            $Project->setAttribute('Description', $valueProject['first_name'] . ' ' . $valueProject['last_name']);
                            $projectsData->appendChild($Project);

                            $ResultUnit = $xmlDoc->createElement('ResultUnit');
                            $ResultUnit->setAttribute('Code', $valueProject['code']);
                            $ResultUnit->setAttribute('Description', $valueProject['first_name'] . ' ' . $valueProject['last_name']);
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

        //    } // employee ends
        }

//die();

        if($error_flag == 1)
            $error .= '</div>';
        // finish
        $xmlDoc->appendChild($rootElement);

        if ($return) {
            $export = $xmlDoc->saveXml();
            return true;
        } else {
            echo $xmlDoc->saveXml();
        }
    }

    public function toVismaPay($return = false, $date = null, $customer = null) {
        $sOutput = '
#FLAGGA 0
#PROGRAM "Time2View"
#SKAPAD ' . date(self::VISMA_PAY_DATE_FORMAT) . '
#ORGNR 556694-1554
#FTGNAMN "firma AB"
' . (isset($date[0]) ? '#PERIODFROM ' . date(self::VISMA_PAY_DATE_FORMAT, $date[0]) : '') . '
' . (isset($date[1]) ? '#PERIODTOM ' . date(self::VISMA_PAY_DATE_FORMAT, $date[1]) : '') . '
        ';

        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        $this->apply_max_karens = $company_details['apply_max_karens'];
        $this->sem_leave_days = $company_details['sem_leave_days'];
        $this->vab_leave_days = $company_details['vab_leave_days'];
        $this->fp_leave_days = $company_details['fp_leave_days'];
        $this->nopay_leave_days = $company_details['nopay_leave_days'];
        $this->other_leave_days = $company_details['other_leave_days'];
        $this->sick_15_90_oncall = $company_details['sick_15_90_oncall'];
        unset($user);

        $this->db->flush();
        $incTiming = new inconvenient_timing();
//        $inconvenientTimingList = $incTiming->inconvenient_timing_list();
        $inconvenientTimingList = $incTiming->inconvenient_timing_list_copy();
        $inconvenientTimingList = !is_array($inconvenientTimingList) ? array() : $inconvenientTimingList;
        $holidayTimingList = $incTiming->holiday_timing_list();
        $holidayTimingList = !is_array($holidayTimingList) ? array() : $holidayTimingList;

        $i = 0;
        $list = array_merge($inconvenientTimingList, $holidayTimingList);

        $employeeTimes = array();

        foreach ($this->result as $employes) {
            if (!empty($employes['employee'])) {
                foreach ($employes['employee'] as $employee) {
                    $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date', 'salary_type', 'leave_in_advance', 'remaining_sem_leave', 'sem_leave_todate', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days');
                    $this->db->tables = array('employee');
                    $this->db->conditions = array('username="' . $employee['emp_username'] . '"');

                    $empData = $this->db->query_fetch();
                    $data = $this->convEmployee($employee, $employes['week']);

                    $employeeTimes[$empData[0]['social_security']]['tag'] = array(
                        'EmploymentNo' => $empData[0]['code'],
                        'Signature' => mb_substr($empName[0], 0, 1) . mb_substr($empName[1], 0, 1),
                        'FirstName' => $empName[0],
                        'Name' => $empName[1],
                        //'PersonalNo'  => substr($empData[0]['social_security'], 0, 6).'-'.substr($empData[0]['social_security'], -4),
                        'PersonalNo' => $empData[0]['century'] . $empData[0]['social_security'],
                        'HourlyWage' => '0',
                        'FromData' => date(self::VISMA_PAY_DATE_FORMAT, $this->meta['fromDate']),
                        'ToData' => date(self::VISMA_PAY_DATE_FORMAT, $this->meta['toDate']),
                    );
                    $employeeTimes[$empData[0]['social_security']]['times'] = !is_array($employeeTimes[$empData[0]['social_security']]['times']) ? array() : $employeeTimes[$empData[0]['social_security']]['times'];
                    $employeeTimes[$empData[0]['social_security']]['times'] = array_merge($employeeTimes[$empData[0]['social_security']]['times'], $data);
                }
            }
        }

        foreach ($employeeTimes as $key => $value) {
            
            if($value['sem_leave_days'] != $this->sem_leave_days)
                $this->sem_leave_days  =  $value['sem_leave_days'];
            if($value['vab_leave_days'] != $this->vab_leave_days)
                $this->vab_leave_days  =  $value['vab_leave_days'];
            if($value['fp_leave_days'] != $this->fp_leave_days)
                $this->fp_leave_days  =  $value['fp_leave_days'];
            if($value['nopay_leave_days'] != $this->nopay_leave_days)
                $this->nopay_leave_days  =  $value['nopay_leave_days'];
            if($value['other_leave_days'] != $this->other_leave_days)
                $this->other_leave_days  =  $value['other_leave_days'];
            
            $this->times = array();
            array_walk($value['times'], array($this, 'walkDataNonXML'));

            $sOutput .= '
#ANST ' . $value['tag']['EmploymentNo'] . '
#PNR ' . $value['tag']['PersonalNo'];

            if (is_array($this->times) && count($this->times)) {
                $sOutput .= '
{';

                foreach ($this->times as $key1 => $value1) {
                    $sOutput .= '
    #LART ' . $value1['TimeCode'] . ' ' . $value1['SumOfHours'] . ' 0.00
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

    public function toHogiaXML($return = false, $date = null, $c_list = null, $userSigned = array()) {
        $smarty = new smartySetup(array('export-config.xml'),FALSE);
        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        $this->apply_max_karens = $company_details['apply_max_karens'];
        $this->sem_leave_days = $company_details['sem_leave_days'];
        $this->vab_leave_days = $company_details['vab_leave_days'];
        $this->fp_leave_days = $company_details['fp_leave_days'];
        $this->nopay_leave_days = $company_details['nopay_leave_days'];
        $this->other_leave_days = $company_details['other_leave_days'];
        $this->sick_15_90_oncall = $company_details['sick_15_90_oncall'];
        unset($user);
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
        foreach ($this->result as $employes) {
            foreach ($employes['employee'] as $emp) {
                $thisResults[$emp['emp_username']]['emp'] = $emp;
                $data = $this->convEmployee($emp, $employes['week']);

                foreach ($data as $keyData => $valueData) {
                    $timeWorked = 0;
                    foreach ($valueData['times'] as $keyTimes => $valueTimes) {
                        $timeMinutes = floor($valueTimes['work'] - floor($valueTimes['work'])) * 100;
                        // add the hours worked transformed in minuntes
                        $timeWorked += (floor($valueTimes['work']) * 60 + $timeMinutes);
                    }

                    if ($timeWorked) {
                        $timeHours = floor($timeWorked / 60);
                        $thisResults[$emp['emp_username']]['times'][$keyData] = $timeHours + ($timeWorked - $timeHours * 60) / 100;
                    }
                }
            }
        }

        foreach ($thisResults as $emp) {
            // skip employees with no working time
            if (!is_array($emp['times'])) {
                continue;
            }
            //commente by shaju and added after lines
            /* $empName = explode(' ', $emp['emp']['name']);
              $this->db->fields = array('code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone');
              $this->db->tables = array('employee');
              $this->db->conditions = array('AND', 'first_name="'.$empName[0].'"', 'last_name="'.$empName[1].'"');
              $empData = $this->db->query_fetch(); */


            $this->db->fields = array('century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date', 'salary_type', 'leave_in_advance', 'remaining_sem_leave', 'sem_leave_todate', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days');
            $this->db->tables = array('employee');
            $this->db->conditions = array('username="' . $employee['emp_username'] . '"');

            $empData = $this->db->query_fetch();
            
            
            if($empData[0]['code']['sem_leave_days'] != $this->sem_leave_days)
                $this->sem_leave_days  =  $empData[0]['code']['sem_leave_days'];
            if($empData[0]['code']['vab_leave_days'] != $this->vab_leave_days)
                $this->vab_leave_days  =  $empData[0]['code']['vab_leave_days'];
            if($empData[0]['code']['fp_leave_days'] != $this->fp_leave_days)
                $this->fp_leave_days  =  $empData[0]['code']['fp_leave_days'];
            if($empData[0]['code']['nopay_leave_days'] != $this->nopay_leave_days)
                $this->nopay_leave_days  =  $empData[0]['code']['nopay_leave_days'];
            if($empData[0]['code']['other_leave_days'] != $this->other_leave_days)
                $this->other_leave_days  =  $empData[0]['code']['other_leave_days'];

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
            foreach ($emp['times'] as $keyTimes => $valueTime) {
                $timeMinutes = floor($valueTime - floor($valueTime)) * 100;
                // add the hours worked transformed in minuntes
                $timeTotal += (floor($valueTime) * 60 + $timeMinutes);
            }

            // convert from minutes to hours.minutes
            $timeHours = floor($timeTotal / 60);
            $timeTotal = $timeHours + ($timeTotal - $timeHours * 60) / 100;

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
            $projekt = $xmlDoc->createElement('projekt', $empName[0] . ' ' . $empName[1]);
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

    public function toHogia($return = false, $date = null, $c_list = null, $userSigned = array(),&$export, &$error) {
        $smarty = new smartySetup(array('export-config.xml'),FALSE);
        $userSignedEmp = array();
        $customer_list = array();
        $obj_timetable = new timetable();
        
        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        $this->apply_max_karens = $company_details['apply_max_karens'];
        $this->sem_leave_days = $company_details['sem_leave_days'];
        $this->vab_leave_days = $company_details['vab_leave_days'];
        $this->fp_leave_days = $company_details['fp_leave_days'];
        $this->nopay_leave_days = $company_details['nopay_leave_days'];
        $this->other_leave_days = $company_details['other_leave_days'];
        $this->sick_15_90_oncall = $company_details['sick_15_90_oncall'];
        unset($user);

        // time codes
        $this->timeCodes = self::getTimingList($smarty);


        foreach ($this->result as $keyResult => $employes) {
            if (!empty($employes['employee'])) {
                foreach ($employes['employee'] as $keyEmployee => $employee) {
                    if (count(array_keys($userSigned)) && !in_array($employee['emp_username'], array_keys($userSigned))) {
                        unset($this->result[$keyResult]['employee'][$keyEmployee]);
                        continue;
                    }

                    $this->db->fields = array('username','century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date', 'salary_type', 'leave_in_advance', 'remaining_sem_leave', 'sem_leave_todate', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days');
                    $this->db->tables = array('employee');
                    $this->db->conditions = array('username="' . $employee['emp_username'] . '"');

                    $empData = $this->db->query_fetch();
                    $userSignedEmp[$employee['emp_username']] = $empData[0];
                }
            }
        }
        $this->db->flush();
        $output = '';
        //echo "<pre>".print_r($userSignedEmp, 1)."</pre>";
        // data for "dimensioner" and "resultatenheter"
        if (isset($c_list) && is_array($c_list)) {
            foreach ($c_list as $keyProject => $valueProject) {
                if (!empty($valueProject['code'])) {
                    // other things
                    $customer_list[$valueProject['username']] = $valueProject;
                }
            }
        }

        $month = $this->exportMonth;
        $yr = $this->exportYear;
        $error_flag = 0;
        $div_style = 'background-color: #e0e0d1';
        //print_r($userSigned);
        foreach ($userSigned as $value => $key) { //value and key interchanged 
            //if($value == 'insv001'){
            $rpt_content_normal = array();
            $rpt_content_travell = array();
            $rpt_content_break = array();
            $rpt_content_oncall = array();
            $rpt_content_over = array();
            $rpt_content_quality = array();
            $rpt_content_more = array();
            $rpt_content_some = array();
            $rpt_content_training = array();
            $rpt_content_personal = array();
            $rpt_content_calltraining = array();
            $rpt_content_voluntary = array();
            $rpt_content_complementary = array();
            $rpt_content_complementary_oncall = array();
            $rpt_content_more_oncall = array();
            $rpt_content_standby = array();
            $rpt_content_dismissal = array();
            $rpt_content_dismissal_oncall = array();

            $rpt_content_leave = array();
            $rpt_content_leave_over = array();
            $rpt_content_leave_quality = array();
            $rpt_content_leave_more = array();
            $rpt_content_leave_some = array();
            $rpt_content_leave_training = array();
            $rpt_content_leave_personal = array();
            $rpt_content_leave_voluntary = array();
            $rpt_content_leave_oncall = array();
            $rpt_content_leave_calltraining = array();
            $rpt_content_leave_more_oncall = array();
            $rpt_content_leave_standby = array();

            $passed_employee = $value;
            $passed_customers = $key;
            
            if($userSignedEmp[$value]['sem_leave_days'] != $this->sem_leave_days)
                $this->sem_leave_days  =  $userSignedEmp[$value]['sem_leave_days'];
            if($userSignedEmp[$value]['vab_leave_days'] != $this->vab_leave_days)
                $this->vab_leave_days  =  $userSignedEmp[$value]['vab_leave_days'];
            if($userSignedEmp[$value]['fp_leave_days'] != $this->fp_leave_days)
                $this->fp_leave_days  =  $userSignedEmp[$value]['fp_leave_days'];
            if($userSignedEmp[$value]['nopay_leave_days'] != $this->nopay_leave_days)
                $this->nopay_leave_days  =  $userSignedEmp[$value]['nopay_leave_days'];
            if($userSignedEmp[$value]['other_leave_days'] != $this->other_leave_days)
                $this->other_leave_days  =  $userSignedEmp[$value]['other_leave_days'];
            
            
            $salary_name = '';
            if($userSignedEmp[$value]['salary_type'] == 1)
                $salary_name = $smarty->translate['external_vacation_saving'];
            elseif($userSignedEmp[$value]['salary_type'] == 2)
                $salary_name = $smarty->translate['external_vacation_paid'];
            elseif($userSignedEmp[$value]['salary_type'] == 3)
                $salary_name = $smarty->translate['external_monthly'];
            elseif($userSignedEmp[$value]['salary_type'] == 4)
                $salary_name = $smarty->translate['external_monthly_office'];
            elseif($userSignedEmp[$value]['salary_type'] == 5)
                $salary_name = $smarty->translate['external_monthly_office_hour'];

            $salary_mod = $userSignedEmp[$value]['salary_type'];

            $this->processWorkingTime($passed_employee, $passed_customers, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal, $rpt_content_dismissal_oncall);

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
                $rpt_content_voluntary,
                $rpt_content_complementary,
                $rpt_content_oncall,
                $rpt_content_calltraining,
                $rpt_content_complementary_oncall,
                $rpt_content_more_oncall,
                $rpt_content_standby,
                $rpt_content_dismissal,
                $rpt_content_dismissal_oncall,
                $rpt_content_leave,
                    /*
                      $rpt_content_leave_over,
                      $rpt_content_leave_quality,
                      $rpt_content_leave_more,
                      $rpt_content_leave_some,
                      $rpt_content_leave_oncall,
                     */
            );
            //echo "<pre>\n".print_r($rpt_content_oncall, 1)."</pre>";
            unset(
                    $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall,$rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal, $rpt_content_dismissal_oncall
            );


            foreach ($rpt_content_all as $key_array => $rpt_content) {
                if (!is_array($rpt_content)) {
                    continue;
                }

                foreach ($rpt_content as $keyDate => $valueDate) {
                    if (!is_array($valueDate)) {
                        continue;
                    }

                    foreach ($valueDate as $timeCode => $timeValue) {
                        if (!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times'])) {
                            continue;
                        }

                        foreach ($timeValue['times'] as $keyTimeValue => $valueTimeValue) {
                            if (!empty($customer_list[$valueTimeValue[3]]['code'])) {
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
            $output .= utf8_decode("; {$userSocialSecurity} {$userSignedEmp[$value]['first_name']} {$userSignedEmp[$value]['last_name']} {$userSignedEmp[$value]['address']} {$userSignedEmp[$value]['city']}") . "\r\n";
            //$temp_out = '';
            //$temp_out1 = '';
            foreach ($timePerTimeCode as $timeCode => $timeCodeData) {
                //if ($timeCode == "3003" || $timeCode == '3012' || $timeCode == '3013') {
                $outputLine = '';
                $external_code = '';
                $temp_time_code = $timeCode;
                //$temp_out = utf8_decode("; {$userSocialSecurity} {$userSignedEmp[$value]['first_name']} {$userSignedEmp[$value]['last_name']} {$userSignedEmp[$value]['address']} {$userSignedEmp[$value]['city']}") . "\r\n";
                if ($key_array == 7) {
                    if ($timeCode != "3008" && ($timeCode < 1000 || $timeCode >= 2000)) {
                        $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode . '.1', 0, $salary_mod));
                        $temp_time_code = $timeCode . '.1';
                    } else {
                        $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode, 0, $salary_mod));
                    }
                } elseif ($key_array == 12 && ($timeCode < 1000 || $timeCode >= 2000)) {
                    $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode . '.1', 0, $salary_mod));
                    $temp_time_code = $timeCode . '.1';
                } elseif (($key_array == 10 || $key_array == 13) && ($timeCode < 1000 || $timeCode >= 2000) && $timeCode != 3011) {
                    $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode . '.2', 0, $salary_mod));
                    $temp_time_code = $timeCode . '.2';
                } elseif ($key_array == 14 && ($timeCode < 1000 || $timeCode >= 2000)) {
                    $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode . '.3', 0, $salary_mod));
                    $temp_time_code = $timeCode . '.3';
                } elseif (($key_array == 16 || $key_array == 17) && ($timeCode < 1000 || $timeCode >= 2000)) {
                    if($timeCode != 3015 && $timeCode != 3016){
                        $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode . '.4', 0, $salary_mod));
                        $temp_time_code = $timeCode . '.4';
                    }else{
                        
                       $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode, 0, $salary_mod)); 
                       
                    }
                } else {
                    $external_code = sprintf('%03d', $this->identifyTimeCode($timeCode, 0, $salary_mod));
                }
                //echo $key_array."----".$timeCode."---".$external_code."<br>";
       
                
                //if($external_code != '000'){
                    $outputLine = '214003' .
                            sprintf('%010s', (string) $userSignedEmp[$value]['social_security']).$external_code;
                    foreach ($timeCodeData['clients'] as $keyTimeCodeEmployee => $valueTimeCodeDataEmployee) {
                        if($external_code && $external_code != '000' && !empty($customer_list[$keyTimeCodeEmployee]) && $customer_list[$keyTimeCodeEmployee]['code'] != ''){
                            $customer_list[$keyTimeCodeEmployee]['code'] = preg_replace('/[^0-9]/i', '', $customer_list[$keyTimeCodeEmployee]['code']);
                            $outputTmp = $outputLine .
                                sprintf('%010s', (string) $customer_list[$keyTimeCodeEmployee]['code']) .
                                sprintf('%014s', (string) $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']) .
                                sprintf('%010d', (int) ($valueTimeCodeDataEmployee * 100)) .
                                '0000000000' .
                                '00000000000000000' .
                                date(self::HOGIA_DATE_FORMAT, $date[0]) .
                                date(self::HOGIA_DATE_FORMAT, $date[1]);
                        
                            $output .= $outputTmp . "\r\n";
                        
                        }else{
                            if($error_flag == 0)
                                $error = '<div style="" class="alert alert-success export-error-box">';
                            $hour_check_flag = 0;
                            $error_flag = 1;
                            $cust_name = '';
                            $emp_name = '';
                            if($_SESSION['company_sort_by'] == 2){
                               $cust_name =  $customer_list[$keyTimeCodeEmployee]['last_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['first_name']; 
                               $emp_name = $userSignedEmp[$value]['last_name']. ' ' .$userSignedEmp[$value]['first_name'];
                            }elseif($_SESSION['company_sort_by'] == 1){
                                $cust_name =  $customer_list[$keyTimeCodeEmployee]['first_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['last_name']; 
                                $emp_name = $userSignedEmp[$value]['first_name']. ' ' .$userSignedEmp[$value]['last_name'];
                            }
                            
                            $timeCodeName = $this->identifyTimeCodeName((string)$temp_time_code);
                            if($div_style == 'background-color: #e0e0d1')
                                $div_style = 'background-color: #e3edf0';
                            else
                                $div_style = 'background-color: #e0e0d1';

                            $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">'.
                            $smarty->translate['customer'].': '.$cust_name.'<br>'.
                            $smarty->translate['employee'].': '.$emp_name.'<br>'.
                            $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.date(self::HOGIA_DATE_FORMAT, $date[0]).'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.date(self::HOGIA_DATE_FORMAT, $date[0]).'</a><br>'.
                            $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                            $smarty->translate['internal_code'].': '.$temp_time_code.'<br>'.
                            $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$temp_time_code).'<br>';
                            if(!$external_code){
                             $hour_check_flag = 1;   
                             if($timeCodeName)
                              $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                             else
                              $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                             $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                            }
                            if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                             if(empty($customer_list[$keyTimeCodeEmployee]))
                              $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                             elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                              $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                             if(!$hour_check_flag)
                                 $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                            }
                            $error .= '</div>';
                        }
                    }
            //    }
            //}
                
            }
            //$output .= $temp_out.$temp_out1 . "\r\n";
            /////////////////////////start of code for vacation saving and ////////////////////////////////
                $extra_time_code_taken = '2002.2';
                $extra_time_code_saved = '2002.3';
                $external = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type']);
                if((string)$external !== $extra_time_code_taken && $external != ''){
                   
                    $saved_sem_credentials = $obj_timetable->get_saved_sem_leave_credentials($company_details, $userSignedEmp[$value], $month, $yr);
             
                    //echo "<pre>".print_r($saved_sem_credentials)."</pre>";
                    $taken_sem_leaves = $saved_sem_credentials['this_fyear_takens_sem_leave_days']+0;
                    $cumulated_earned_sem_leaves = $saved_sem_credentials['this_fyear_earned_days'] + $saved_sem_credentials['former_year_remaining_days'];

                    if($taken_sem_leaves !=0 || $cumulated_earned_sem_leaves != 0){
                        
                        $outputTmp = '214003' .
                            sprintf('%010s', (string) $userSignedEmp[$value]['social_security']) .
                            sprintf('%03d', $thisResults->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type']));
                        $outputTmp .= sprintf('%010s', (string) $customer_list[$keyTimeCodeEmployee]['code']) .
                            sprintf('%014s', (string) $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']) .
                            sprintf('%010d', (int) ($taken_sem_leaves * 100)) .
                            '0000000000' .
                            '00000000000000000' .
                            date(self::HOGIA_DATE_FORMAT, $date[0]) .
                            date(self::HOGIA_DATE_FORMAT, $date[1]);

                        $output .= $outputTmp . "\r\n";
                        
                        
                        
                        $outputTmp = '214003' .
                            sprintf('%010s', (string) $userSignedEmp[$value]['social_security']) .
                            sprintf('%03d', $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type']));
                        $outputTmp .= sprintf('%010s', (string) $customer_list[$keyTimeCodeEmployee]['code']) .
                            sprintf('%014s', (string) $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']) .
                            sprintf('%010d', (int) ($cumulated_earned_sem_leaves * 100)) .
                            '0000000000' .
                            '00000000000000000' .
                            date(self::HOGIA_DATE_FORMAT, $date[0]) .
                            date(self::HOGIA_DATE_FORMAT, $date[1]);

                        $output .= $outputTmp . "\r\n";


                        
                    }
                }
            
            /////////////////////////end of code for vacation saving and ////////////////////////////////
        //}
            
        }
        
        
        
        if($error_flag == 1)
            $error .= '</div>';
        
        $output = '000000' . "\r\n" . $output . '999999' . "\r\n";

        if ($return){
            $export = $output;
            return true;
        }
        else
            echo $output;
    }
    
    public function Crona($return = false, $date = null, $c_list = null, $userSigned = array(), &$export, &$error, $fkkn_split) {
        $smarty = new smartySetup(array('export-config.xml'),FALSE);
        $obj_timetable = new timetable();
        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        
        $this->apply_max_karens = $company_details['apply_max_karens'];
        $this->sem_leave_days = $company_details['sem_leave_days'];
        $this->vab_leave_days = $company_details['vab_leave_days'];
        $this->fp_leave_days = $company_details['fp_leave_days'];
        $this->nopay_leave_days = $company_details['nopay_leave_days'];
        $this->other_leave_days = $company_details['other_leave_days'];
        $this->sick_15_90_oncall = $company_details['sick_15_90_oncall'];
        
        unset($user);

        $userSignedEmp = array();
        $customer_list = array();
        // time codes
        $this->timeCodes = self::getTimingList($smarty);
        //echo "<pre>".print_r($this->result,1)."</pre>";
        foreach ($this->result as $keyResult => $employes) {
            if (!empty($employes['employee'])) {
                foreach ($employes['employee'] as $keyEmployee => $employee) {
                    if (count(array_keys($userSigned)) && !in_array($employee['emp_username'], array_keys($userSigned))) {
                        unset($this->result[$keyResult]['employee'][$keyEmployee]);
                        continue;
                    }


                    $this->db->fields = array('username','century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date', 'salary_type', 'leave_in_advance', 'remaining_sem_leave', 'sem_leave_todate', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days');
                    $this->db->tables = array('employee');
                    $this->db->conditions = array('username="' . $employee['emp_username'] . '"');

                    $empData = $this->db->query_fetch();
                    $userSignedEmp[$employee['emp_username']] = $empData[0];
                }
            }
        }
        //echo "<pre>".print_r($userSignedEmp,1)."</pre>";
        
        $this->db->flush();
        $xmlDoc = new DOMDocument();
        $xmlDoc->formatOutput = true;
        $xmlDoc->encoding = 'ISO-8859-1'; //'ISO-8859-1';
        $rootElement = $xmlDoc->createElement('paxml');
        $rootElement->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $rootElement->setAttribute('xsi:noNamespaceSchemaLocation', 'http://www.paxml.se/2.0/paxml.xsd');

        // TAG: header
        $header = $xmlDoc->createElement('header');
        $format = $xmlDoc->createElement('format', 'LÖNIN');
        $header->appendChild($format);
        $version = $xmlDoc->createElement('version', '2.0');
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
        // TAG: resultatenheter
        $resultatenheter = $xmlDoc->createElement('resultatenheter');



        // data for "dimensioner" and "resultatenheter"
        //echo "<pre>".print_r($c_list, 1)."</pre>";
        if (isset($c_list) && is_array($c_list)) {
            foreach ($c_list as $keyProject => $valueProject) {
                if (!empty($valueProject['code'])) {


                    $resultatenhet = $xmlDoc->createElement('resultatenhet');
                    $resultatenhet->setAttribute('dim', '1');
                    $resultatenhet->setAttribute('id', $valueProject['code']);
                    $resultatenhet->setAttribute('namn', $valueProject['first_name'] . ' ' . $valueProject['last_name']);
                    $resultatenheter->appendChild($resultatenhet);


                    // other things
                    $customer_list[$valueProject['username']] = $valueProject;
                }
            }
        }

        $resultatenheterData = $rootElement->appendChild($resultatenheter);

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
        $error_flag = 0;
        $div_style = 'background-color: #e0e0d1';
        //echo "<pre>".print_r($customer_list, 1)."</pre>";
        foreach ($userSigned as $value => $key) {
           //echo $value;
            //if($value == 'dodo001'){
            $rpt_content_normal = array();
            $rpt_content_travell = array();
            $rpt_content_break = array();
            $rpt_content_oncall = array();
            $rpt_content_over = array();
            $rpt_content_quality = array();
            $rpt_content_more = array();
            $rpt_content_some = array();
            $rpt_content_training = array();
            $rpt_content_personal = array();
            $rpt_content_calltraining = array();
            $rpt_content_voluntary = array();
            $rpt_content_complementary = array();
            $rpt_content_complementary_oncall = array();
            $rpt_content_more_oncall = array();
            $rpt_content_standby = array();
            $rpt_content_dismissal = array();
            $rpt_content_dismissal_oncall = array();

            $rpt_content_leave = array();
            $rpt_content_leave_over = array();
            $rpt_content_leave_quality = array();
            $rpt_content_leave_more = array();
            $rpt_content_leave_some = array();
            $rpt_content_leave_training = array();
            $rpt_content_leave_personal = array();
            $rpt_content_leave_voluntary = array();
            $rpt_content_leave_oncall = array();
            $rpt_content_leave_calltraining = array();
            $rpt_content_leave_more_oncall = array();
            $rpt_content_leave_standby = array();

            $passed_employee = $value;
            $passed_customers = $key;
            
            if($userSignedEmp[$value]['sem_leave_days'] != $this->sem_leave_days)
                $this->sem_leave_days  =  $userSignedEmp[$value]['sem_leave_days'];
            if($userSignedEmp[$value]['vab_leave_days'] != $this->vab_leave_days)
                $this->vab_leave_days  =  $userSignedEmp[$value]['vab_leave_days'];
            if($userSignedEmp[$value]['fp_leave_days'] != $this->fp_leave_days)
                $this->fp_leave_days  =  $userSignedEmp[$value]['fp_leave_days'];
            if($userSignedEmp[$value]['nopay_leave_days'] != $this->nopay_leave_days)
                $this->nopay_leave_days  =  $userSignedEmp[$value]['nopay_leave_days'];
            if($userSignedEmp[$value]['other_leave_days'] != $this->other_leave_days)
                $this->other_leave_days  =  $userSignedEmp[$value]['other_leave_days'];

            $this->bookDistributionProjects = array();
            $this->bookDistributionProjectsSum = 0;
            //$salary_mod = $this->get_salary_mod($value);
            $salary_name = '';
            if($userSignedEmp[$value]['salary_type'] == 1)
                $salary_name = $smarty->translate['external_vacation_saving'];
            elseif($userSignedEmp[$value]['salary_type'] == 2)
                $salary_name = $smarty->translate['external_vacation_paid'];
            elseif($userSignedEmp[$value]['salary_type'] == 3)
                $salary_name = $smarty->translate['external_monthly'];
            elseif($userSignedEmp[$value]['salary_type'] == 4)
                $salary_name = $smarty->translate['external_monthly_office'];
            elseif($userSignedEmp[$value]['salary_type'] == 5)
                $salary_name = $smarty->translate['external_monthly_office_hour'];
            
            
            $this->processWorkingTime($passed_employee, $passed_customers, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal, $rpt_content_dismissal_oncall);

            $consolidated_leave = array();
            $rpt_content_leave_consolidated = array();
            //            echo "<pre>" . print_r($rpt_content_complementary, 1) . "</pre>";
            //            echo "------------------------------------------------------------------------";
            //            if($value == 'mite001'){
                             //echo "<pre>" . print_r($rpt_content_leave, 1) . "</pre>";
            //                
            //                  
            //            }
            //echo "<pre>" . print_r($rpt_content_leave, 1) . "</pre>";exit();
            $i_consol = 0;
            foreach ($rpt_content_leave as $keyDate => $valueDate) {
                foreach ($valueDate as $timeCode => $timeValue) {
                    if ($timeCode >= 2002 && $timeCode <= 2007) {
                        //                        echo "<pre>" . print_r($rpt_content_leave, 1) . "</pre>";
                        //                        echo "------------------------------------------------------------------------";
                                                //echo "<pre>" . print_r($consolidated_leave, 1) . "</pre>";

                        if (array_key_exists($timeCode, $consolidated_leave) &&
                                strtotime('+1 day', strtotime($consolidated_leave[$timeCode])) == strtotime($keyDate)) {
                            //echo "<pre>" . print_r(array_keys( $rpt_content_leave_consolidated[$timeCode]), 1) . "</pre>";
                            //echo "<pre>" . print_r($rpt_content_leave_consolidated, 1) . "</pre>";
                            $i_consol_array = array_keys($rpt_content_leave_consolidated[$timeCode]);
                            $i_consol = end($i_consol_array);
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['to'] = $keyDate;
                            /* if (date('w', strtotime($keyDate)) == 0 || date('w', strtotime($keyDate)) == 6) {
                              $rpt_content_leave_consolidated[$timeCode][$i_consol]['unused'] = $this->equipment->time_sum($rpt_content_leave_consolidated[$timeCode][$i_consol]['unused'], $timeValue['total']);
                              $rpt_content_leave_consolidated[$timeCode][$i_consol]['unused_days']++;
                              $rpt_content_leave_consolidated[$timeCode][$i_consol]['customer'] = $timeValue['times'][0][3];
                              } else { */
                            //$rpt_content_leave_consolidated[$timeCode][$i_consol]['used'] = $this->equipment->time_sum($rpt_content_leave_consolidated[$timeCode][$i_consol]['used'], $timeValue['total']);
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used'] += $timeValue['total'];
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_days']++;
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['customer'] = $timeValue['times'][0][3];
                            foreach($timeValue['times'] as $timeslots){
                                if($timeslots[8] == 1)
                                    $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_fk'] += $timeslots[2];
                                if($timeslots[8] == 2)
                                    $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_kn'] += $timeslots[2];
                                if($timeslots[8] == 3)
                                    $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_tu'] += $timeslots[2];
                                
                            }
                            //}
                            //echo "<pre>" . print_r($rpt_content_leave_consolidated, 1) . "</pre>";
                        } else {
                            if (array_key_exists($timeCode, $consolidated_leave)){
                                //echo "<pre>".print_r(array_keys($rpt_content_leave_consolidated[$timeCode]),1)."</pre>";
                                $x = array_keys($rpt_content_leave_consolidated[$timeCode]);
                                $i_consol = end($x) + 1;
                            }
                            else
                                $i_consol = 0;
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['from'] = $keyDate;
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['to'] = $keyDate;
                            /* if (date('w', strtotime($keyDate)) == 0 || date('w', strtotime($keyDate)) == 6) {
                              $rpt_content_leave_consolidated[$timeCode][$i_consol]['unused'] = $timeValue['total'];
                              $rpt_content_leave_consolidated[$timeCode][$i_consol]['unused_days'] = 1;
                              $rpt_content_leave_consolidated[$timeCode][$i_consol]['customer'] = $timeValue['times'][0][3];
                              } else { */
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used'] = $timeValue['total'];
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_days'] = 1;
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['customer'] = $timeValue['times'][0][3];
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_fk'] = 0;
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_kn'] = 0;
                            $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_tu'] = 0;
                            foreach($timeValue['times'] as $timeslots){
                                if($timeslots[8] == 1)
                                    $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_fk'] += $timeslots[2];
                                if($timeslots[8] == 2)
                                    $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_kn'] += $timeslots[2];
                                if($timeslots[8] == 3)
                                    $rpt_content_leave_consolidated[$timeCode][$i_consol]['used_tu'] += $timeslots[2];
                                
                            }
                            
                            //}
                        }
                        $consolidated_leave[$timeCode] = $keyDate;

                        unset($rpt_content_leave[$keyDate][$timeCode]);
                        if (empty($rpt_content_leave[$keyDate]))
                            unset($rpt_content_leave[$keyDate]);

                                //                        echo "<pre>" . print_r($rpt_content_leave_consolidated, 1) . "</pre>";
                                //                        echo "============================================================================================";
                    }
                }
            }
            //            if($value == 'mite001'){
            //                 
            //                 echo "<pre>" . print_r($rpt_content_leave_consolidated, 1) . "</pre>";
            //                  
            //            }
            //            echo "<pre>" . print_r($rpt_content_leave, 1) . "</pre>";
            //echo "============================================================================================";
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
                $rpt_content_voluntary,
                $rpt_content_complementary,
                $rpt_content_oncall,
                $rpt_content_calltraining,
                $rpt_content_complementary_oncall,
                $rpt_content_more_oncall,
                $rpt_content_standby,
                $rpt_content_dismissal,
                $rpt_content_dismissal_oncall,
                $rpt_content_leave,
                    /*
                      $rpt_content_leave_over,
                      $rpt_content_leave_quality,
                      $rpt_content_leave_more,
                      $rpt_content_leave_some,
                      $rpt_content_leave_oncall,
                     */
            );

            //echo "<pre>".print_r($rpt_content_all, 1)."</pre>";
            //echo "<pre>".print_r($rpt_content_over, 1)."</pre>";
            unset(
                    $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal
            );

            //echo "<pre>".print_r($rpt_content_all, 1)."</pre>";

            foreach ($rpt_content_all as $key_array => $rpt_content) {
                if (!is_array($rpt_content)) {
                    continue;
                }

                foreach ($rpt_content as $keyDate => $valueDate) {
                    if (!is_array($valueDate)) {
                        continue;
                    }

                    foreach ($valueDate as $timeCode => $timeValue) {
                        if (!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times'])) {
                            continue;
                        }

                        if (!isset($timePerDay[$keyDate])) {
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

                        foreach ($timeValue['times'] as $keyTimeValue => $valueTimeValue) {
                            //if(!empty($customer_list[$valueTimeValue[3]]['code']))
                            //{
                            
                            $timePerDay[$keyDate] += $valueTimeValue[2];
                            if ($key_array == 7) {
                                if ($timeCode != "3008" && ($timeCode < 1000 || $timeCode >= 2000)) {

                                    $timePerTimeCode[$timeCode . '.1'][$keyDate]['total'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                    if($valueTimeValue[8] == 1){
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['total_fk'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }
                                    elseif($valueTimeValue[8] == 2){
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['total_kn'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }
                                    elseif($valueTimeValue[8] == 3){
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['total_tu'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }

                                    
                                } else {

                                    $timePerTimeCode[$timeCode][$keyDate]['total'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                    if($valueTimeValue[8] == 1){
                                        $timePerTimeCode[$timeCode][$keyDate]['total_fk'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }
                                    elseif($valueTimeValue[8] == 2){
                                        $timePerTimeCode[$timeCode][$keyDate]['total_kn'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }
                                    elseif($valueTimeValue[8] == 3){
                                        $timePerTimeCode[$timeCode][$keyDate]['total_tu'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }

                                    
                                }
                            } elseif ($key_array == 12 && ($timeCode < 1000 || $timeCode >= 2000)) {

                                    $timePerTimeCode[$timeCode . '.1'][$keyDate]['total'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                    if($valueTimeValue[8] == 1){
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['total_fk'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }
                                    elseif($valueTimeValue[8] == 2){
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['total_kn'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }
                                    elseif($valueTimeValue[8] == 3){
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['total_tu'] += $valueTimeValue[2];
                                        $timePerTimeCode[$timeCode . '.1'][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                    }

                                    
                            } elseif (($key_array == 13 || $key_array == 10) && ($timeCode < 1000 || $timeCode >= 2000) && $timeCode != 3011) {
                                
                                $timePerTimeCode[$timeCode . '.2'][$keyDate]['total'] += $valueTimeValue[2];
                                $timePerTimeCode[$timeCode . '.2'][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                if($valueTimeValue[8] == 1){
                                    $timePerTimeCode[$timeCode . '.2'][$keyDate]['total_fk'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.2'][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 2){
                                    $timePerTimeCode[$timeCode . '.2'][$keyDate]['total_kn'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.2'][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 3){
                                    $timePerTimeCode[$timeCode . '.2'][$keyDate]['total_tu'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.2'][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }

                                
                            } elseif ($key_array == 14 && ($timeCode < 1000 || $timeCode >= 2000)) {

                                $timePerTimeCode[$timeCode . '.3'][$keyDate]['total'] += $valueTimeValue[2];
                                $timePerTimeCode[$timeCode . '.3'][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                if($valueTimeValue[8] == 1){
                                    $timePerTimeCode[$timeCode . '.3'][$keyDate]['total_fk'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.3'][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 2){
                                    $timePerTimeCode[$timeCode . '.3'][$keyDate]['total_kn'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.3'][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 3){
                                    $timePerTimeCode[$timeCode . '.3'][$keyDate]['total_tu'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.3'][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }

                                
                            } elseif (($key_array == 16 || $key_array == 17) && ($timeCode < 1000 || $timeCode >= 2000) && $timeCode != 3015) {
                                
                                $timePerTimeCode[$timeCode . '.4'][$keyDate]['total'] += $valueTimeValue[2];
                                $timePerTimeCode[$timeCode . '.4'][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                if($valueTimeValue[8] == 1){
                                    $timePerTimeCode[$timeCode . '.4'][$keyDate]['total_fk'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.4'][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 2){
                                    $timePerTimeCode[$timeCode . '.4'][$keyDate]['total_kn'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.4'][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 3){
                                    $timePerTimeCode[$timeCode . '.4'][$keyDate]['total_tu'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode . '.4'][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }

                                
                            }else {
                                $timePerTimeCode[$timeCode][$keyDate]['total'] += $valueTimeValue[2];
                                $timePerTimeCode[$timeCode][$keyDate]['clients'][$valueTimeValue[3]] += $valueTimeValue[2];

                                if($valueTimeValue[8] == 1){
                                    $timePerTimeCode[$timeCode][$keyDate]['total_fk'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode][$keyDate]['clients_fk'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 2){
                                    $timePerTimeCode[$timeCode][$keyDate]['total_kn'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode][$keyDate]['clients_kn'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }
                                elseif($valueTimeValue[8] == 3){
                                    $timePerTimeCode[$timeCode][$keyDate]['total_tu'] += $valueTimeValue[2];
                                    $timePerTimeCode[$timeCode][$keyDate]['clients_tu'][$valueTimeValue[3]] += $valueTimeValue[2];
                                }

                                
                            }
                            //}
                        }
                    }
                }
            }

            //echo "-----------------------------------------------------------------------";
            //echo "<pre>".print_r($timePerTimeCode, 1)."</pre>";
            // for "lonetransaktioner"
            $iWriteTimes = 0;
            
            //echo "sja".$userSignedEmp[$value]['salary_type'];
            foreach ($timePerTimeCode as $timeCode => $timeCodeDates) {

                foreach ($timeCodeDates as $key_date => $timeCodeData) {
                    //echo "<pre>".print_r($timeCodeData,1)."</pre>";
                    if($fkkn_split){
                        for($fkkn_i = 1; $fkkn_i <= 3 ; $fkkn_i++){
                            if($fkkn_i == 1)
                                $timeCodeData['clients'] = !array_key_exists('clients_fk',$timeCodeData)?array():$timeCodeData['clients_fk'];
                            if($fkkn_i == 2)
                                $timeCodeData['clients'] = !array_key_exists('clients_kn',$timeCodeData)?array():$timeCodeData['clients_kn'];
                            if($fkkn_i == 3)
                                $timeCodeData['clients'] = !array_key_exists('clients_tu',$timeCodeData)?array():$timeCodeData['clients_tu'];

                            foreach ($timeCodeData['clients'] as $keyTimeCodeEmployee => $valueTimeCodeDataEmployee) {
                                // TAG: lonetrans
                                    
                                if($this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], $fkkn_i) && !empty($customer_list[$keyTimeCodeEmployee]) && $customer_list[$keyTimeCodeEmployee]['code'] != ''){
                                    $lonetrans = $xmlDoc->createElement('lonetrans');
                                    $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                                    $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], $fkkn_i)));

                                    $lonetrans->appendChild($xmlDoc->createElement('antal', $valueTimeCodeDataEmployee));
                                    if ($timeCode >= 2000 && $timeCode < 3000)
                                        $lonetrans->appendChild($xmlDoc->createElement('datum', $key_date));
                                    //if(!in_array($userSignedEmp[$value]['salary_type'], array(3,4,5))){
                                        $resenheter = $xmlDoc->createElement('resenheter');
                                        $resenhet = $xmlDoc->createElement('resenhet');
                                        $resenhet->setAttribute('dim', '1');
                                        $resenhet->setAttribute('id', $customer_list[$keyTimeCodeEmployee]['code']);
                                        $resenheter->appendChild($resenhet);
                                        $lonetrans->appendChild($resenheter);
                                    //}
                                    $lonetransaktioner->appendChild($lonetrans);
                                }
                                else{
                                    if($error_flag == 0)
                                        $error = '<div style="" class="alert alert-success export-error-box">';
                                    $hour_check_flag = 0;
                                    $error_flag = 1;
                                    $cust_name = '';
                                    $emp_name = '';
                                    if($_SESSION['company_sort_by'] == 2){
                                       $cust_name =  $customer_list[$keyTimeCodeEmployee]['last_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['first_name']; 
                                       $emp_name = $userSignedEmp[$value]['last_name']. ' ' .$userSignedEmp[$value]['first_name'];
                                    }elseif($_SESSION['company_sort_by'] == 1){
                                        $cust_name =  $customer_list[$keyTimeCodeEmployee]['first_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['last_name']; 
                                        $emp_name = $userSignedEmp[$value]['first_name']. ' ' .$userSignedEmp[$value]['last_name'];
                                    }
                                    
                                    $timeCodeName = $this->identifyTimeCodeName((string)$timeCode, $fkkn_i);
                                    if($div_style == 'background-color: #e0e0d1')
                                        $div_style = 'background-color: #e3edf0';
                                    else
                                        $div_style = 'background-color: #e0e0d1';

                                    $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">
        <xmp><lonetrans persnr="'. $userSignedEmp[$value]['social_security'].'">';
                                    if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], $fkkn_i)){
                                        $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], $fkkn_i).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                                    }else{
                                        $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], $fkkn_i).'</lonart></xmp><xmp style="padding:0px;">   ';
                                    }
                                    $error .= '<antal>'.$valueTimeCodeDataEmployee.'</antal>
   <datum>'.$key_date.'</datum>';
                                    if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                        $error .= '</xmp><font style="color:red;"><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp></font><xmp style="padding:0px;">';
                                    }else{
                                        $error .= '</xmp><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp><xmp style="padding:0px;">';
                                    }

                                    $error .= '</lonetrans></xmp><br/>'.
                                               $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                               $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                               $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$key_date.'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.$key_date.'</a><br>'.
                                               $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                               $smarty->translate['internal_code'].': '.$timeCode.'<br>'.
                                               $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$timeCode).'<br>';
                                               if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], $fkkn_i)){
                                                $hour_check_flag = 1;   
                                                if($timeCodeName)
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                                else
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                                $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                                               }
                                               if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                                if(empty($customer_list[$keyTimeCodeEmployee]))
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                                elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                                if(!$hour_check_flag)
                                                    $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                                               }
                                               $error .= '</div>';
                                }
                                $iWriteTimes = 1;

                                
                                
                            }
                        }

                    }else{
                        foreach ($timeCodeData['clients'] as $keyTimeCodeEmployee => $valueTimeCodeDataEmployee) {
                            // TAG: lonetrans
                                
                            if($this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']) && !empty($customer_list[$keyTimeCodeEmployee]) && $customer_list[$keyTimeCodeEmployee]['code'] != ''){
                                $lonetrans = $xmlDoc->createElement('lonetrans');
                                $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                                $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])));

                                $lonetrans->appendChild($xmlDoc->createElement('antal', $valueTimeCodeDataEmployee));
                                if ($timeCode >= 2000 && $timeCode < 3000)
                                    $lonetrans->appendChild($xmlDoc->createElement('datum', $key_date));
                                //if(!in_array($userSignedEmp[$value]['salary_type'], array(3,4,5))){
                                    $resenheter = $xmlDoc->createElement('resenheter');
                                    $resenhet = $xmlDoc->createElement('resenhet');
                                    $resenhet->setAttribute('dim', '1');
                                    $resenhet->setAttribute('id', $customer_list[$keyTimeCodeEmployee]['code']);
                                    $resenheter->appendChild($resenhet);
                                    $lonetrans->appendChild($resenheter);
                                //}
                                $lonetransaktioner->appendChild($lonetrans);
                            }
                            else{
                                if($error_flag == 0)
                                    $error = '<div style="" class="alert alert-success export-error-box">';
                                $hour_check_flag = 0;
                                $error_flag = 1;
                                $cust_name = '';
                                $emp_name = '';
                                if($_SESSION['company_sort_by'] == 2){
                                   $cust_name =  $customer_list[$keyTimeCodeEmployee]['last_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['first_name']; 
                                   $emp_name = $userSignedEmp[$value]['last_name']. ' ' .$userSignedEmp[$value]['first_name'];
                                }elseif($_SESSION['company_sort_by'] == 1){
                                    $cust_name =  $customer_list[$keyTimeCodeEmployee]['first_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['last_name']; 
                                    $emp_name = $userSignedEmp[$value]['first_name']. ' ' .$userSignedEmp[$value]['last_name'];
                                }
                                
                                $timeCodeName = $this->identifyTimeCodeName((string)$timeCode);
                                if($div_style == 'background-color: #e0e0d1')
                                    $div_style = 'background-color: #e3edf0';
                                else
                                    $div_style = 'background-color: #e0e0d1';

                                $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">
    <xmp><lonetrans persnr="'. $userSignedEmp[$value]['social_security'].'">';
                                if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                    $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                                }else{
                                    $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp><xmp style="padding:0px;">   ';
                                }
                                $error .= '<antal>'.$valueTimeCodeDataEmployee.'</antal>
   <datum>'.$key_date.'</datum>';
                                if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                    $error .= '</xmp><font style="color:red;"><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp></font><xmp style="padding:0px;">';
                                }else{
                                    $error .= '</xmp><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp><xmp style="padding:0px;">';
                                }

                                $error .= '</lonetrans></xmp><br/>'.
                                           $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                           $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                           $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$key_date.'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.$key_date.'</a><br>'.
                                           $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                           $smarty->translate['internal_code'].': '.$timeCode.'<br>'.
                                           $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$timeCode).'<br>';
                                           if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                            $hour_check_flag = 1;   
                                            if($timeCodeName)
                                             $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                            else
                                             $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                            $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                                           }
                                           if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                            if(empty($customer_list[$keyTimeCodeEmployee]))
                                             $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                            elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                                             $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                            if(!$hour_check_flag)
                                                $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                                           }
                                           $error .= '</div>';
                            }
                            $iWriteTimes = 1;

                            
                            
                        }
                        // TAG: lonetrans - end
                    }
                    
                }
            }

            //echo "<pre>".print_r($rpt_content_leave_consolidated, 1)."</pre>";

            foreach ($rpt_content_leave_consolidated as $timeCode => $rpt_content_leave_consolidated_group) {
                foreach ($rpt_content_leave_consolidated_group as $time_values) {

                    if(
                        (
                            $fkkn_split == 1 && 
                            (
                                (($time_values['used_fk'] && $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'], 1)) || $time_values['used_fk'] == 0)
                                &&
                                (($time_values['used_kn'] && $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'], 2)) || $time_values['used_kn'] == 0)
                                &&
                                (($time_values['used_tu'] && $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'], 3)) || $time_values['used_tu'] == 0)
                            ) && $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'], 2)
                        )
                        || 
                        (
                            $fkkn_split == 0 && $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'])
                        ) 
                        && 
                        !empty($customer_list[$time_values['customer']]) && $customer_list[$time_values['customer']]['code'] != ''
                      ){
                        
                        if($fkkn_split == 0){
                            $lonetrans = $xmlDoc->createElement('lonetrans');
                            $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                            $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'])));

                            if ($time_values['used']){
                                
                                $lonetrans->appendChild($xmlDoc->createElement('antal', $time_values['used']));
                            }
                            else{
                                $lonetrans->appendChild($xmlDoc->createElement('antal', '0'));
                            }

                            if ($time_values['from'] != $time_values['to']) {
                                $lonetrans->appendChild($xmlDoc->createElement('datumfrom', $time_values['from'] . "T00:00:00"));
                                $lonetrans->appendChild($xmlDoc->createElement('datumtom', $time_values['to'] . "T00:00:00"));
                            } else {
                                $lonetrans->appendChild($xmlDoc->createElement('datum', $time_values['from']));
                            }

                            $resenheter = $xmlDoc->createElement('resenheter');
                            $resenhet = $xmlDoc->createElement('resenhet');
                            $resenhet->setAttribute('dim', '1');
                            $resenhet->setAttribute('id', $customer_list[$time_values['customer']]['code']);

                            $resenheter->appendChild($resenhet);
                            $lonetrans->appendChild($resenheter);
                            $lonetransaktioner->appendChild($lonetrans);

                        }else{
                            if ($time_values['used_fk']){
                                $lonetrans = $xmlDoc->createElement('lonetrans');
                                $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                                $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'])));
                                $lonetrans->appendChild($xmlDoc->createElement('antal', $time_values['used_fk']));

                                if ($time_values['from'] != $time_values['to']) {
                                    $lonetrans->appendChild($xmlDoc->createElement('datumfrom', $time_values['from'] . "T00:00:00"));
                                    $lonetrans->appendChild($xmlDoc->createElement('datumtom', $time_values['to'] . "T00:00:00"));
                                } else {
                                    $lonetrans->appendChild($xmlDoc->createElement('datum', $time_values['from']));
                                }

                                $resenheter = $xmlDoc->createElement('resenheter');
                                $resenhet = $xmlDoc->createElement('resenhet');
                                $resenhet->setAttribute('dim', '1');
                                $resenhet->setAttribute('id', $customer_list[$time_values['customer']]['code']);

                                $resenheter->appendChild($resenhet);
                                $lonetrans->appendChild($resenheter);
                                $lonetransaktioner->appendChild($lonetrans);
                            }
                            if ($time_values['used_kn']){
                                $lonetrans = $xmlDoc->createElement('lonetrans');
                                $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                                $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'])));

                                $lonetrans->appendChild($xmlDoc->createElement('antal', $time_values['used_kn']));

                                if ($time_values['from'] != $time_values['to']) {
                                    $lonetrans->appendChild($xmlDoc->createElement('datumfrom', $time_values['from'] . "T00:00:00"));
                                    $lonetrans->appendChild($xmlDoc->createElement('datumtom', $time_values['to'] . "T00:00:00"));
                                } else {
                                    $lonetrans->appendChild($xmlDoc->createElement('datum', $time_values['from']));
                                }

                                $resenheter = $xmlDoc->createElement('resenheter');
                                $resenhet = $xmlDoc->createElement('resenhet');
                                $resenhet->setAttribute('dim', '1');
                                $resenhet->setAttribute('id', $customer_list[$time_values['customer']]['code']);

                                $resenheter->appendChild($resenhet);
                                $lonetrans->appendChild($resenheter);
                                $lonetransaktioner->appendChild($lonetrans);
                            }
                            if ($time_values['used_tu']){
                                $lonetrans = $xmlDoc->createElement('lonetrans');
                                $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                                $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($timeCode, 0, $userSignedEmp[$value]['salary_type'])));

                                $lonetrans->appendChild($xmlDoc->createElement('antal', $time_values['used_tu']));

                                if ($time_values['from'] != $time_values['to']) {
                                    $lonetrans->appendChild($xmlDoc->createElement('datumfrom', $time_values['from'] . "T00:00:00"));
                                    $lonetrans->appendChild($xmlDoc->createElement('datumtom', $time_values['to'] . "T00:00:00"));
                                } else {
                                    $lonetrans->appendChild($xmlDoc->createElement('datum', $time_values['from']));
                                }


                                $resenheter = $xmlDoc->createElement('resenheter');
                                $resenhet = $xmlDoc->createElement('resenhet');
                                $resenhet->setAttribute('dim', '1');
                                $resenhet->setAttribute('id', $customer_list[$time_values['customer']]['code']);

                                $resenheter->appendChild($resenhet);
                                $lonetrans->appendChild($resenheter);
                                $lonetransaktioner->appendChild($lonetrans);
                            }
                            
                        }                       
                        

                        
                    
                    }else{
                        if($error_flag == 0)
                            $error = '<div style="" class="alert alert-success export-error-box">';
                        $hour_check_flag = 0;
                        $error_flag = 1;
                        $cust_name = '';
                        $emp_name = '';
                        if($_SESSION['company_sort_by'] == 2){
                           $cust_name =  $customer_list[$keyTimeCodeEmployee]['last_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['first_name']; 
                           $emp_name = $userSignedEmp[$value]['last_name']. ' ' .$userSignedEmp[$value]['first_name'];
                        }elseif($_SESSION['company_sort_by'] == 1){
                            $cust_name =  $customer_list[$keyTimeCodeEmployee]['first_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['last_name']; 
                            $emp_name = $userSignedEmp[$value]['first_name']. ' ' .$userSignedEmp[$value]['last_name'];
                        }
                        $timeCodeName = $this->identifyTimeCodeName((string)$timeCode);
                        if($div_style == 'background-color: #e0e0d1')
                            $div_style = 'background-color: #e3edf0';
                        else
                            $div_style = 'background-color: #e0e0d1';
                        
                        $temp_antal = 0;
                        $temp_antal_fk = 0;
                        $temp_antal_kn = 0;
                        $temp_antal_tu = 0;
                        if($fkkn_split == 0){
                            if ($time_values['used'])
                                $temp_antal = $time_values['used'];
                            else
                                $temp_antal = 0;
                        }else{
                            if($time_values['used_fk'])
                                $temp_antal_fk = 0;
                            if($time_values['used_kn'])
                                $temp_antal_kn = 0;
                            if($time_values['used_tu'])
                                $temp_antal_tu = 0;
                        }
                        
                        $temp_datum = '';
                        $temp_datum_ex = $time_values['from'];
                        if ($time_values['from'] != $time_values['to']) {
                            $temp_datum = '<datumfrom>'. $time_values['from']. '</datumfrom>';
                            $temp_datum = '<datumtom>'. $time_values['to']. '</datumtom>';
                            $temp_datum_ex .= ' - '. $time_values['to'];
                        } else {
                            $temp_datum = '<datum>'. $time_values['from']. '</datum>';
                        }

                        $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">
<xmp><lonetrans persnr="'. $userSignedEmp[$value]['social_security'].'">';
                        if($fkkn_split == 0){
                            if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                            }else{
                                $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp><xmp style="padding:0px;">   ';
                            }
                            $error .= '<antal>'.$temp_antal.'</antal>
    '.$temp_datum;
                        }else{
                            if($time_values['used_fk']){
                                if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 1)){
                                    $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                                }else{
                                    $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'],1).'</lonart></xmp><xmp style="padding:0px;">   ';
                                }
                                $error .= '<antal>'.$temp_antal_fk.'</antal>
        '.$temp_datum;
                            }
                            if($time_values['used_kn']){
                                if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 2)){
                                    $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 2).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                                }else{
                                    $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 2).'</lonart></xmp><xmp style="padding:0px;">   ';
                                }
                                $error .= '<antal>'.$temp_antal_fk.'</antal>
        '.$temp_datum;
                            }

                            if($time_values['used_tu']){
                                if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 3)){
                                    $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 3).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                                }else{
                                    $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'], 3).'</lonart></xmp><xmp style="padding:0px;">   ';
                                }
                                $error .= '<antal>'.$temp_antal_tu.'</antal>
        '.$temp_datum;
                            }      
                        }
                        if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                            $error .= '</xmp><font style="color:red;"><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp></font><xmp style="padding:0px;">';
                        }else{
                            $error .= '</xmp><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp><xmp style="padding:0px;">';
                        }

                        $error .= '</lonetrans></xmp><br/>'.
                                   $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                   $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                   $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$key_date.'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.$key_date.'</a><br>'.
                                   $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                   $smarty->translate['internal_code'].': '.$timeCode.'<br>'.
                                   $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$timeCode).'<br>';
                                   if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                    $hour_check_flag = 1;   
                                    if($timeCodeName)
                                     $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                    else
                                     $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                    $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                                   }
                                   if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                    if(empty($customer_list[$keyTimeCodeEmployee]))
                                     $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                    elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                                     $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                    if(!$hour_check_flag)
                                        $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                                   }
                                   $error .= '</div>';
                        
                    }

                    $iWriteTimes = 1;
                }
            }
            
            
            /////////////////////////start of code for vacation saving and ////////////////////////////////
            if($userSignedEmp[$value]['salary_type'] != 2){
              
                $saved_sem_credentials = $obj_timetable->get_saved_sem_leave_credentials($company_details, $userSignedEmp[$value], $month, $yr);
                $taken_sem_leaves = $saved_sem_credentials['this_fyear_takens_sem_leave_days']+0;
                $cumulated_earned_sem_leaves = $saved_sem_credentials['this_fyear_earned_days'] + $saved_sem_credentials['former_year_remaining_days'];

                if($taken_sem_leaves !=0 || $cumulated_earned_sem_leaves != 0){
                    $extra_time_code_taken = '2002.2';
                    $extra_time_code_saved = '2002.3';
                    $external = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type']);
                    $external_saved = $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type']);

                    $external_fk = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type'], 1);
                    $external_saved_fk = $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type'], 1);

                    $external_kn = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type'], 2);
                    $external_saved_kn = $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type'], 2);

                    $external_tu = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type'], 3);
                    $external_saved_tu = $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type'], 3);

                    if(
                        (string)$external !== $extra_time_code_taken && $external_saved != '' && (string)$external_saved !== $extra_time_code_saved && $external != '' && $external_saved != ''

                    ){                    
                        $lonetrans = $xmlDoc->createElement('lonetrans');
                        $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                        $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type'])));
                        $lonetrans->appendChild($xmlDoc->createElement('antal', $taken_sem_leaves));
                        $resenheter = $xmlDoc->createElement('resenheter');
                        $resenhet = $xmlDoc->createElement('resenhet');
                        $resenhet->setAttribute('dim', '1');
                        $resenhet->setAttribute('id', $customer_list[$time_values['customer']]['code']);
                        $resenheter->appendChild($resenhet);
                        $lonetrans->appendChild($resenheter);
                        $lonetransaktioner->appendChild($lonetrans);


                        $lonetrans = $xmlDoc->createElement('lonetrans');
                        $lonetrans->setAttribute('persnr', $userSignedEmp[$value]['century'] . $userSignedEmp[$value]['social_security']);
                        $lonetrans->appendChild($xmlDoc->createElement('lonart', $this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type'])));
                        $lonetrans->appendChild($xmlDoc->createElement('antal', $cumulated_earned_sem_leaves));
                        $resenheter = $xmlDoc->createElement('resenheter');
                        $resenhet = $xmlDoc->createElement('resenhet');
                        $resenhet->setAttribute('dim', '1');
                        $resenhet->setAttribute('id', $customer_list[$time_values['customer']]['code']);
                        $resenheter->appendChild($resenhet);
                        $lonetrans->appendChild($resenheter);
                        $lonetransaktioner->appendChild($lonetrans);
                        
                    }

                    // elseif(
                    //     ((string)$external !== $extra_time_code_taken && $external_saved != '' && (string)$external_saved !== $extra_time_code_saved && $external != '')

                    // ){

                    // }    
                    else{
                        if($error_flag == 0)
                            $error = '<div style="" class="alert alert-success export-error-box">';
                        $hour_check_flag = 0;
                        $error_flag = 1;
                        $cust_name = '';
                        $emp_name = '';
                        if($_SESSION['company_sort_by'] == 2){
                           $cust_name =  $customer_list[$keyTimeCodeEmployee]['last_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['first_name']; 
                           $emp_name = $userSignedEmp[$value]['last_name']. ' ' .$userSignedEmp[$value]['first_name'];
                        }elseif($_SESSION['company_sort_by'] == 1){
                            $cust_name =  $customer_list[$keyTimeCodeEmployee]['first_name']. ' ' .$customer_list[$keyTimeCodeEmployee]['last_name']; 
                            $emp_name = $userSignedEmp[$value]['first_name']. ' ' .$userSignedEmp[$value]['last_name'];
                        }
                        if((string)$external === $extra_time_code_taken || $external == ''){
                            $timeCode = $extra_time_code_taken;
                            $timeCodeName = $this->identifyTimeCodeName((string)$timeCode);
                            if($div_style == 'background-color: #e0e0d1')
                                $div_style = 'background-color: #e3edf0';
                            else
                                $div_style = 'background-color: #e0e0d1';

                            $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">
        <xmp><lonetrans persnr="'. $userSignedEmp[$value]['social_security'].'">';
                            if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                            }else{
                                $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp><xmp style="padding:0px;">   ';
                            }
                            $error .= '<antal>'.$valueTimeCodeDataEmployee.'</antal>
        <datum>'.$key_date.'</datum>';
                            if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                $error .= '</xmp><font style="color:red;"><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp></font><xmp style="padding:0px;">';
                            }else{
                                $error .= '</xmp><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp><xmp style="padding:0px;">';
                            }

                            $error .= '</lonetrans></xmp><br/>'.
                                       $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                       $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                       $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$key_date.'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.$key_date.'</a><br>'.
                                       $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                       $smarty->translate['internal_code'].': '.$timeCode.'<br>'.
                                       $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$timeCode).'<br>';
                                       if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                        $hour_check_flag = 1;   
                                        if($timeCodeName)
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                        else
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                        $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                                       }
                                       if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                        if(empty($customer_list[$keyTimeCodeEmployee]))
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                        elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                        if(!$hour_check_flag)
                                            $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                                       }
                        }

                        if((string)$external_saved === $extra_time_code_saved || $external_saved == ''){
                            $timeCode = $extra_time_code_saved;
                            $timeCodeName = $this->identifyTimeCodeName((string)$timeCode);
                            if($div_style == 'background-color: #e0e0d1')
                                $div_style = 'background-color: #e3edf0';
                            else
                                $div_style = 'background-color: #e0e0d1';

                            $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;">
        <xmp><lonetrans persnr="'. $userSignedEmp[$value]['social_security'].'">';
                            if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                $error .=   '</xmp><font style="color:red;"><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp></font><xmp style="padding:0px;">   ';
                            }else{
                                $error .= '</xmp><xmp style="padding:0px;">   <lonart>'.$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type']).'</lonart></xmp><xmp style="padding:0px;">   ';
                            }
                            $error .= '<antal>'.$valueTimeCodeDataEmployee.'</antal>
        <datum>'.$key_date.'</datum>';
                            if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                $error .= '</xmp><font style="color:red;"><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp></font><xmp style="padding:0px;">';
                            }else{
                                $error .= '</xmp><xmp style="padding:0px;">   <resenheter> <resenhet dim="1" id="'.$customer_list[$keyTimeCodeEmployee]['code'].'"/> </resenheter></xmp><xmp style="padding:0px;">';
                            }

                            $error .= '</lonetrans></xmp><br/>'.
                                       $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                       $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                       $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$key_date.'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.$key_date.'</a><br>'.
                                       $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                       $smarty->translate['internal_code'].': '.$timeCode.'<br>'.
                                       $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$timeCode).'<br>';
                                       if(!$this->identifyTimeCode((string)$timeCode, 0, $userSignedEmp[$value]['salary_type'])){
                                        $hour_check_flag = 1;   
                                        if($timeCodeName)
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                        else
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                        $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                                       }
                                       if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                        if(empty($customer_list[$keyTimeCodeEmployee]))
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                        elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                                         $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                        if(!$hour_check_flag)
                                            $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                                       }
                        }
                                   $error .= '</div>';
                    }
                }
            }
            
            /////////////////////////end of code for vacation saving and ////////////////////////////////

            
            // TAG: person - end
         //    }// end for single user
        }
        if($error_flag == 1)
            $error .= '</div>';

        $rootElement->appendChild($lonetransaktioner);
        // TAG: lonetransaktioner - end
        //$rootElement->appendChild($schematransaktioner);
        // TAG: schematransaktioner - end
        //$rootElement->appendChild($personal); avoided temporariry
        // TAG: personal - end

        $xmlDoc->appendChild($rootElement);
        if ($return){
            $export =  $xmlDoc->saveXml();
            return true;
        }
        else{
            echo $xmlDoc->saveXml();
        }
    }

    public function toAgda($return = false, $date = null, $c_list = null, $userSigned = array()) {
        
    }

    //bl salary
    public function toBl($return = false, $date = null, $c_list = null, $userSigned = array(), &$export, &$error) {
        $smarty = new smartySetup(array('export-config.xml'),FALSE);
        $userSignedEmp = array();
        $customer_list = array();
        $obj_timetable = new timetable();
        
        $user = new user_exp();
        $company_details = $user->get_company($_SESSION['company_id']);
        $this->apply_max_karens = $company_details['apply_max_karens'];
        $this->sem_leave_days = $company_details['sem_leave_days'];
        $this->vab_leave_days = $company_details['vab_leave_days'];
        $this->fp_leave_days = $company_details['fp_leave_days'];
        $this->nopay_leave_days = $company_details['nopay_leave_days'];
        $this->other_leave_days = $company_details['other_leave_days'];
        $this->sick_15_90_oncall = $company_details['sick_15_90_oncall'];
        unset($user);

        // time codes
        $this->timeCodes = self::getTimingList($smarty);


        foreach ($this->result as $keyResult => $employes) {
            if (!empty($employes['employee'])) {
                foreach ($employes['employee'] as $keyEmployee => $employee) {
                    if (count(array_keys($userSigned)) && !in_array($employee['emp_username'], array_keys($userSigned))) {
                        unset($this->result[$keyResult]['employee'][$keyEmployee]);
                        continue;
                    }

                    $this->db->fields = array('username','century', 'code', 'social_security', 'address', 'post', 'city', 'mobile', 'phone', 'first_name', 'last_name', 'date', 'salary_type', 'leave_in_advance', 'remaining_sem_leave', 'sem_leave_todate', 'sem_leave_days', 'vab_leave_days', 'fp_leave_days', 'nopay_leave_days', 'other_leave_days');
                    $this->db->tables = array('employee');
                    $this->db->conditions = array('username="' . $employee['emp_username'] . '"');

                    $empData = $this->db->query_fetch();
                    $userSignedEmp[$employee['emp_username']] = $empData[0];
                }
            }
        }
        $this->db->flush();
        $output = '';
        //echo "<pre>".print_r($userSignedEmp, 1)."</pre>";
        // data for "dimensioner" and "resultatenheter"
        if (isset($c_list) && is_array($c_list)) {
            foreach ($c_list as $keyProject => $valueProject) {
                if (!empty($valueProject['code'])) {
                    // other things
                    $customer_list[$valueProject['username']] = $valueProject;
                }
            }
        }

        $month = $this->exportMonth;
        $yr = $this->exportYear;
        //print_r($userSigned);
        $outputTmp = "[TidTr]\n";
        $error_flag = 0;
        $div_style = 'background-color: #e0e0d1';
        foreach ($userSigned as $value => $key) { //value and key interchanged 
            //if($value == 'emfa001'){
            $rpt_content_normal = array();
            $rpt_content_travell = array();
            $rpt_content_break = array();
            $rpt_content_oncall = array();
            $rpt_content_over = array();
            $rpt_content_quality = array();
            $rpt_content_more = array();
            $rpt_content_some = array();
            $rpt_content_training = array();
            $rpt_content_personal = array();
            $rpt_content_calltraining = array();
            $rpt_content_voluntary = array();
            $rpt_content_complementary = array();
            $rpt_content_complementary_oncall = array();
            $rpt_content_more_oncall = array();
            $rpt_content_standby = array();
            $rpt_content_dismissal = array();
            $rpt_content_dismissal_oncall = array();

            $rpt_content_leave = array();
            $rpt_content_leave_over = array();
            $rpt_content_leave_quality = array();
            $rpt_content_leave_more = array();
            $rpt_content_leave_some = array();
            $rpt_content_leave_training = array();
            $rpt_content_leave_personal = array();
            $rpt_content_leave_voluntary = array();
            $rpt_content_leave_oncall = array();
            $rpt_content_leave_calltraining = array();
            $rpt_content_leave_more_oncall = array();
            $rpt_content_leave_standby = array();

            $passed_employee = $value;
            $passed_customers = $key;
            
            if($userSignedEmp[$value]['sem_leave_days'] != $this->sem_leave_days)
                $this->sem_leave_days  =  $userSignedEmp[$value]['sem_leave_days'];
            if($userSignedEmp[$value]['vab_leave_days'] != $this->vab_leave_days)
                $this->vab_leave_days  =  $userSignedEmp[$value]['vab_leave_days'];
            if($userSignedEmp[$value]['fp_leave_days'] != $this->fp_leave_days)
                $this->fp_leave_days  =  $userSignedEmp[$value]['fp_leave_days'];
            if($userSignedEmp[$value]['nopay_leave_days'] != $this->nopay_leave_days)
                $this->nopay_leave_days  =  $userSignedEmp[$value]['nopay_leave_days'];
            if($userSignedEmp[$value]['other_leave_days'] != $this->other_leave_days)
                $this->other_leave_days  =  $userSignedEmp[$value]['other_leave_days'];
            
            $salary_name = '';
            if($userSignedEmp[$value]['salary_type'] == 1)
                $salary_name = $smarty->translate['external_vacation_saving'];
            elseif($userSignedEmp[$value]['salary_type'] == 2)
                $salary_name = $smarty->translate['external_vacation_paid'];
            elseif($userSignedEmp[$value]['salary_type'] == 3)
                $salary_name = $smarty->translate['external_monthly'];
            elseif($userSignedEmp[$value]['salary_type'] == 4)
                $salary_name = $smarty->translate['external_monthly_office'];
            elseif($userSignedEmp[$value]['salary_type'] == 5)
                $salary_name = $smarty->translate['external_monthly_office_hour'];

            $salary_mod = $userSignedEmp[$value]['salary_type'];
            
            

            $this->processWorkingTime($passed_employee, $passed_customers, $month, $yr, $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal, $rpt_content_dismissal_oncall, $rpt_content_dismissal_oncall);

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
                $rpt_content_voluntary,
                $rpt_content_complementary,
                $rpt_content_oncall,
                $rpt_content_calltraining,
                $rpt_content_complementary_oncall,
                $rpt_content_more_oncall,
                $rpt_content_standby,
                $rpt_content_dismissal,
                $rpt_content_dismissal_oncall,
                $rpt_content_leave,
                    /*
                      $rpt_content_leave_over,
                      $rpt_content_leave_quality,
                      $rpt_content_leave_more,
                      $rpt_content_leave_some,
                      $rpt_content_leave_oncall,
                     */
            );
            //echo "<pre>\n" . print_r($rpt_content_all, 1) . "</pre>";
            unset(
                    $rpt_content_normal, $rpt_content_over, $rpt_content_quality, $rpt_content_more, $rpt_content_some, $rpt_content_oncall, $rpt_content_leave, $rpt_content_leave_over, $rpt_content_leave_quality, $rpt_content_leave_more, $rpt_content_leave_some, $rpt_content_leave_oncall, $rpt_content_training, $rpt_content_personal, $rpt_content_calltraining, $rpt_content_leave_training, $rpt_content_leave_personal, $rpt_content_leave_calltraining, $rpt_content_travell, $rpt_content_break, $rpt_content_voluntary, $rpt_content_complementary, $rpt_content_complementary_oncall, $rpt_content_leave_voluntary, $rpt_content_more_oncall, $rpt_content_leave_more_oncall, $rpt_content_standby, $rpt_content_leave_standby, $rpt_content_dismissal
            );

            
            foreach ($rpt_content_all as $key_array => $rpt_content) {
                if (!is_array($rpt_content)) {
                    continue;
                }

                foreach ($rpt_content as $keyDate => $valueDate) {
                    if (!is_array($valueDate)) {
                        continue;
                    }

                    foreach ($valueDate as $timeCode => $timeValue) {
                        if (!is_array($timeValue) || !isset($timeValue['times']) || !is_array($timeValue['times'])) {
                            continue;
                        }
                        $prod_id = $timeCode;
                        $temp_time_code = $timeCode;
                        if ($key_array == 7) {
                            if ($timeCode != "3008" && ($timeCode < 1000 || $timeCode >= 2000)) {
                                
                                     $prod_id = $this->identifyTimeCode($timeCode . '.1', 0, $salary_mod);
                                     $temp_time_code = $timeCode . '.1';
                            } else {
                                $prod_id = $this->identifyTimeCode($timeCode, 0, $salary_mod);
                            }
                        } elseif ($key_array == 12 && ($timeCode < 1000 || $timeCode >= 2000)) {
                            $prod_id = $this->identifyTimeCode($timeCode . '.1', 0, $salary_mod);
                            $temp_time_code = $timeCode . '.1';
                        } elseif (($key_array == 13 || $key_array == 10) && ($timeCode < 1000 || $timeCode >= 2000) && $timeCode != 3011) {
                            $prod_id = $this->identifyTimeCode($timeCode . '.2', 0, $salary_mod);
                            $temp_time_code = $timeCode . '.2';
                        } elseif ($key_array == 14 && ($timeCode < 1000 || $timeCode >= 2000)) {
                            $prod_id = $this->identifyTimeCode($timeCode . '.3', 0, $salary_mod);
                            $temp_time_code = $timeCode . '.3';
                        }  elseif (($key_array == 16 || $key_array == 17) && ($timeCode < 1000 || $timeCode >= 2000) && $timeCode != 3015 && $timeCode != 3016) {
                            $prod_id = $this->identifyTimeCode($timeCode . '.4', 0, $salary_mod);
                            $temp_time_code = $timeCode . '.4';
                        } else {
                            $prod_id = $this->identifyTimeCode($timeCode, 0, $salary_mod);
                        }
                        //echo "<pre>\n" . print_r($timeValue, 1) . "</pre>";
                        
                            foreach ($timeValue['times'] as $keyTimeValue => $valueTimeValue) {
                                if($prod_id && !empty($customer_list[$valueTimeValue[3]]) && $customer_list[$valueTimeValue[3]]['code'] != ''){
                                    $outputTmp .= $userSignedEmp[$value]['code'].";".$keyDate.";".$prod_id.";Timdebitering;".$customer_list[$valueTimeValue[3]]['code'].";".str_replace(".", ",", $valueTimeValue[2])."\n";
                                }else{
                                    if($error_flag == 0)
                                        $error = '<div style="" class="alert alert-success export-error-box">';
                                    $hour_check_flag = 0;
                                    $error_flag = 1;
                                    $cust_name = '';
                                    $emp_name = '';
                                    if($_SESSION['company_sort_by'] == 2){
                                       $cust_name =  $customer_list[$valueTimeValue[3]]['last_name']. ' ' .$customer_list[$valueTimeValue[3]]['first_name']; 
                                       $emp_name = $userSignedEmp[$value]['last_name']. ' ' .$userSignedEmp[$value]['first_name'];
                                    }elseif($_SESSION['company_sort_by'] == 1){
                                        $cust_name =  $customer_list[$valueTimeValue[3]]['first_name']. ' ' .$customer_list[$valueTimeValue[3]]['last_name']; 
                                        $emp_name = $userSignedEmp[$value]['first_name']. ' ' .$userSignedEmp[$value]['last_name'];
                                    }

                                    $timeCodeName = $this->identifyTimeCodeName((string)$temp_time_code);
                                    if($div_style == 'background-color: #e0e0d1')
                                        $div_style = 'background-color: #e3edf0';
                                    else
                                        $div_style = 'background-color: #e0e0d1';
                                   
                                    $error .= '<div style="'.$div_style.'; padding-left:10px; margin-bottom:20px;"><div style="padding-left:10px; margin-bottom:2px; background:white">';
                                    if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                                        $error = '<font style="color:red;">------</font>';
                                    }else{
                                        $error .=$customer_list[$valueTimeValue[3]]['code'];
                                    }
                                    $error .= ";".$keyDate.";";
                                    if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$value]['salary_type'])){
                                        $error .= '<font style="color:red;">------</font>';
                                    }else{
                                        $error .= $prod_id;
                                    }
                                    $error .= ";Timdebitering;";
                                    if(empty($customer_list[$valueTimeValue[3]]) || $customer_list[$valueTimeValue[3]]['code'] == ''){
                                        $error = '<font style="color:red;">------</font>';
                                    }else{
                                        $error .= $customer_list[$valueTimeValue[3]]['code'];
                                    }        
                                    $error .= ";".str_replace(".", ",", $valueTimeValue[2]);
                                    $error .= '</div><br/>';

                                    $error .=  $smarty->translate['customer'].': '.$cust_name.'<br>'.
                                               $smarty->translate['employee'].': '.$emp_name.'<br>'.
                                               $smarty->translate['date'].': <a style="text-decoration:underline;" href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'gdschema_alloc_window.php?date='.$keyDate.'&employee='.$value.'&customer='.$keyTimeCodeEmployee.'&return_page=export\',1)">'.$keyDate.'</a><br>'.
                                               $smarty->translate['salary_mode'].': '.$salary_name.'<br>'.
                                               $smarty->translate['internal_code'].': '.$temp_time_code.'<br>'.
                                               $smarty->translate['internal'].': '.$this->identifyTimeCodeName((string)$temp_time_code).'<br>';
                                               if(!$this->identifyTimeCode((string)$temp_time_code, 0, $userSignedEmp[$value]['salary_type'])){
                                                $hour_check_flag = 1;   
                                                if($timeCodeName)
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['external_salary_code_missing'].'</font><br>'; 
                                                else
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['outside_slot_range'].'</font><br>'; 

                                                $error .= $smarty->translate['hours_missing'].': '.$valueTimeCodeDataEmployee."<br>";
                                               }
                                               if(empty($customer_list[$keyTimeCodeEmployee]) || $customer_list[$keyTimeCodeEmployee]['code'] == ''){
                                                if(empty($customer_list[$keyTimeCodeEmployee]))
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_data_missing'].'</font><br>'; 
                                                elseif($customer_list[$keyTimeCodeEmployee]['code'] == '')
                                                 $error .= '<font style="color:red;">'.$smarty->translate['error_reason'].': '.$smarty->translate['customer_code_missing'].'</font><br>'; 
                                                if(!$hour_check_flag)
                                                    $error .= $smarty->translate['hours'].': '.$valueTimeCodeDataEmployee."<br>";
                                               }
                                               $error .= '</div>';
                                }
                            }
                        
                    }
                }
            }
            

            //}
            
            /////////////////////////start of code for vacation saving and ////////////////////////////////
            $extra_time_code_taken = '2002.2';
            $extra_time_code_saved = '2002.3';
            $external = $this->identifyTimeCode($extra_time_code_taken, 0, $userSignedEmp[$value]['salary_type']);
            if((string)$external !== $extra_time_code_taken && $external != ''){

                $saved_sem_credentials = $obj_timetable->get_saved_sem_leave_credentials($company_details, $userSignedEmp[$value], $month, $yr);
                $taken_sem_leaves = $saved_sem_credentials['this_fyear_takens_sem_leave_days']+0;
                $cumulated_earned_sem_leaves = $saved_sem_credentials['this_fyear_earned_days'] + $saved_sem_credentials['former_year_remaining_days'];
                
                if($taken_sem_leaves !=0 || $cumulated_earned_sem_leaves != 0){
                    $outputTmp .= $userSignedEmp[$value]['code'].";01-".$month."-".$yr.";".$external.";Timdebitering;".$customer_list[$valueTimeValue[3]]['code'].";".str_replace(".", ",", $taken_sem_leaves)."\n";
                    $outputTmp .= $userSignedEmp[$value]['code'].";01-".$month."-".$yr.";".$this->identifyTimeCode($extra_time_code_saved, 0, $userSignedEmp[$value]['salary_type']).";Timdebitering;".$customer_list[$valueTimeValue[3]]['code'].";".str_replace(".", ",", $cumulated_earned_sem_leaves)."\n";


                    
                }
            }
            
            /////////////////////////end of code for vacation saving and ////////////////////////////////
            
        }
        
        if($error_flag == 1)
            $error .= '</div>';

        if ($return){
            $export = $outputTmp;
            return true;
        }
        else
            echo $outputTmp;
    }

    //monthly salry or hourly based 1-monthly,0-hourly used in to_Visma,to_hogia,to_crona functions
    public function get_salary_mod($employee) {

        $this->db->tables = array('employee');
        $this->db->fields = array('monthly_salary');
        $this->db->conditions = array('username=?');
        $this->db->condition_values = array($employee);
        $this->db->query_generate();
        $empData = $this->db->query_fetch();
        if (!empty($empData)) {
            return $empData[0]['monthly_salary'];
        } else {
            return 0;
        }
    }

    public function record_sort($records, $field, $reverse = false) {
        $hash = array();

        foreach ($records as $record) {
            $hash[$record[$field]] = $record;
        }

        ($reverse) ? krsort($hash) : ksort($hash);

        $records = array();

        foreach ($hash as $record) {
            $records [] = $record;
        }

        return $records;
    }
    
    public function get_leave_approved_slots_between_dates($employee, $sdate, $edate){
        $this->db->flush();
        $this->db->tables = array('timetable` as `t', 'leave` as `l');
        $this->db->fields = array('t.id as id', 't.employee as employee', 't.customer as customer', 't.date as date', 't.fkkn as fkkn',
            't.time_from as time_from', 't.time_to as time_to', 't.type as type', 't.status as status', 'l.no_pay as no_pay');
        $this->db->conditions = array('AND', array('BETWEEN', 't.date', '?', '?'), 't.status = 2', 't.employee = ?',
            'l.type = 1', 'l.status = 1','t.employee like l.employee', 't.date = l.date', 'l.time_from <= t.time_from', 'l.time_to >= t.time_to');
        $this->db->condition_values = array($sdate, $edate, $employee);
        
        
        $this->db->order_by = array('t.date DESC', 't.time_from DESC', 't.time_to DESC');
        
        $this->db->query_generate();
        $data = $this->db->query_fetch();
        return $data;
    }

    function get_global_inconvenient_periods_cont() {
        /**
         * @author: shaju <shajukt@arioninfotech.com>
         * 
         * @since: 2017-02-16
         */

        $this->db->flush();
        $this->db->tables = array('inconvenient_timing_customer');
        $this->db->fields = array('id', 'customer', 'root_id', 'group_id', 'name', 'time_from', 'time_to', 'days');
        $this->db->conditions = array('AND', 'root_id != ?', 'root_id IS NOT NULL');
        $this->db->condition_values = array('');
        $this->db->query_generate();
        $data_inconvenients = $this->db->query_fetch();
        $data = array();
        foreach ($data_inconvenients as $data_inconvenient) {
            $data[$data_inconvenient['customer']][$data_inconvenient['root_id']][] = $data_inconvenient;
        }


        $this->db->flush();
        $this->db->tables = array('inconvenient_timing');
        $this->db->fields = array('id', 'root_id', 'group_id', 'name', 'time_from', 'time_to', 'days');
        $this->db->conditions = array('AND', 'root_id != ?', 'root_id IS NOT NULL');
        $this->db->condition_values = array('');
        $this->db->query_generate();
        $data_inconvenients = $this->db->query_fetch();
       
        foreach ($data_inconvenients as $data_inconvenient) {
            $data[$data_inconvenient['root_id']][] = $data_inconvenient;
        }
        return $data;
    }


    function get_distinct_oncall_inconvenient_details_by_month_and_year($month, $year, $employee, $customer = '') {

//        if(!$this->is_ob_on_for_a_employee($employee)) return array();
        if(array_key_exists($customer, $this->inconv_oncall_category)){
            return $this->inconv_oncall_category[$customer];
        }else{  
            $datas = $this->employeeObj->get_distinct_oncall_inconvenient_by_month_and_year_for_customer($month, $year, $customer);
            $this->inconv_oncall_category[$customer] = $datas;
            return $datas;
        }
    }


    
    public function get_15_90_count($datas, $isKarensInterval){
        $formatted_slots = array();
        $prev_date = '';
        foreach($datas as $data){
            $formatted_slots[$data['date']][] = $data;
        }
        reset($formatted_slots);
        $prev_date = key($formatted_slots);
        $days_count = 0;
        //echo "<pre>".print_r($formatted_slots,1)."<pre>";
        foreach($formatted_slots as $key_date => $data){
            $current_date = DateTime::createFromFormat('Y-m-d', $key_date);
            $temp_date = DateTime::createFromFormat('Y-m-d', $prev_date); 
            
            $intervalDate = $current_date->diff($temp_date);
            $intervalDate->format('%r%a')."<br>";
            $days_count = $days_count + 1;
            
            if($intervalDate->format('%r%a') > $isKarensInterval){
                foreach($data as $time_slots){
                    if($time_slots['no_pay'] == 1)
                     return $days_count;   
                }
                $days_count += $intervalDate->format('%r%a');
                $prev_date = $key_date;
            }else{
                if($intervalDate->format('%r%a') > 0)
                    $days_count += $intervalDate->format('%r%a')-1;
                $prev_date = $key_date;
            }  
        }
        
        return $days_count;
    }

}

    
