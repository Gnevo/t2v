<?php

/**
 * Description of dona
 * @author dona
 */
require_once ('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/user.php');
require_once ('class/employee_ext.php');

class copy_paste extends db {

    var $employees = array();
    var $customers = array();
    var $employee_details = array();
    var $customer_details = array();

    function __construct() {

        parent::__construct();
        require_once ('plugins/message.class.php');
    }

    function check_given_slots_copiable($slot_details, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times) {

        $msg = new message();
        $this->employees = $this->get_distinct_employees_from_given_slots($slot_details);
        $this->customers = $this->get_distinct_customers_from_given_slots($slot_details);
        $target_slots = $this->get_employee_slot_between_dates($this->employees, $paste_start, $paste_end,array());
        $leave_timings = $this->get_employee_leave_between_dates($this->employees, $paste_start, $paste_end);
        //echo "<pre>".print_r($this->employees,1)."</pre>";
        // echo $paste_start."=".$paste_end;
        // echo "<pre>".print_r($target_slots,1)."</pre>";exit();
        if (!$this->check_given_employees_are_active($this->employees)) {
            $msg->set_message('fail', 'employee_is_inactive');
            return FALSE;
        } elseif (!$this->check_given_customers_are_active($this->customers)) {
            $msg->set_message('fail', 'customer_is_inactive');
            return FALSE;
        } elseif (!$this->check_employees_in_customer_team($this->employees, $this->customers[0])) {
            $msg->set_message('fail', 'team_error');
            return FALSE;
        } elseif (!$this->check_employees_signed_between_dates($this->employees, $customer, $paste_start, $paste_end)) {
            $msg->set_message('fail', 'employee_signed_in');
            return FALSE;
        } elseif (!$this->check_given_slots_colliding_with_target_slots_datewise($slot_details, $target_slots, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
            $msg->set_message('fail', 'slot_collide');
            return FALSE;
        } elseif (!$this->check_given_slots_colliding_with_target_slots_datewise($slot_details, $leave_timings, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
            $msg->set_message('fail', 'employee_took_a_leave');
            return FALSE;
        } else if (!$this->check_non_prefered_time_overlap_in_pastedays($slot_details , $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
            // new 
            $msg->set_message('fail', 'slot_collide_with_non_preferred_time');
            return FALSE;
        }
         elseif (!$this->check_oncall_slot_range_permissible_datewise($slot_details, $this->customers[0], $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
            $msg->set_message('fail', 'time_outside_oncall');
            return FALSE;
        }
        return TRUE;
    }

    //check type 1- monthly, 2-week, 3-day,
    function check_given_slots_copiable_between_dates($slot_details, $start_date, $end_date, $check_type, $customer = '', $employee = '', $manned = 1) {
        $msg = new message();
        if ($customer != '') {
            //gettings distinct employees from slots to copy

            $this->employees = $this->get_distinct_employees_from_given_slots($slot_details);
            $target_slots = $this->get_employee_slot_between_dates($this->employees, $start_date, $end_date, array());
            $leave_timings = $this->get_employee_leave_between_dates($this->employees, $start_date, $end_date);
            //check these employees are activeemployees are active

            // exit('collide');

            if (!$this->check_given_employees_are_active($this->employees)) {
                
                $msg->set_message('fail', 'employee_is_inactive');
                return FALSE;
            } else if (!$this->check_given_customers_are_active(array($customer))) {
                
                $msg->set_message('fail', 'customer_is_inactive');
                return FALSE;
            } else if (!$this->check_given_slots_colliding_with_target_slots($slot_details, $target_slots, $check_type)) {
                    
                $msg->set_message('fail', 'slot_collide');
                return FALSE;
            } else if (!$this->check_given_slots_colliding_with_target_slots($slot_details, $leave_timings, $check_type)) {
                
                $msg->set_message('fail', 'employee_took_a_leave');
                return FALSE;
            } else if (!$this->check_employees_in_customer_team($this->employees, $customer)) {
               
                $msg->set_message('fail', 'team_error');
                return FALSE;
            } else if (!$this->check_employees_signed_between_dates($this->employees, $customer, $start_date, $end_date)) {
                
                $msg->set_message('fail', 'employee_signed_in');
                return FALSE;
            } else if (!$this->check_non_prefered_time_overlap($slot_details, $start_date, $end_date, $check_type)) {
                // new 
                $msg->set_message('fail', 'slot_collide_with_non_preferred_time');
                return FALSE;
            } else if (!$this->check_oncall_slot_range_permissible($slot_details, $customer, $start_date, $end_date, $check_type)) {
                
                $msg->set_message('fail', 'time_outside_oncall');
                return FALSE;
            } else if ($check_type != 1) {
                
                if (!$this->check_slots_colllide_internally($slot_details, $start_date, $end_date, $check_type)) {
                    $msg->set_message('fail', 'copy_colliding_slots_to_same_daay');
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
            return TRUE;
        }
        
    }

    function check_oncall_slot_range_permissible_datewise($slot_details, $customer, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times) {
        //echo $check_type;
        $msg = new message();
        $oncall_slots = $this->get_specific_slot_types_from_give_slots($slot_details, 3);
        if (empty($oncall_slots))
            return TRUE;
        $inconv_oncalls = $this->get_inconvenient_oncall_between_dates($customer, $paste_start, $paste_end);
        //echo "<pre>".$employee.print_r($oncall_slots,1)."</pre>";
        if (!empty($inconv_oncalls)) {
            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
            for ($i = 1; $i <= $no_of_times; $i++) {
                foreach ($oncall_slots as $oncall_slot) {
                    $is_oncall = FALSE;
                    $time_from = $oncall_slot['time_from'];
                    $time_to = $oncall_slot['time_to'];
                    $date = $oncall_slot['date'];
                    $new_date = date('Y-m-d', strtotime($oncall_slot['date'] . " +" . ($date_diff + (($i-1)*7)) . " days"));
                    foreach ($inconv_oncalls as $inconv_timing) {
                        $flag = 0;
                        $cur_date_day = date('N', strtotime($new_date));

                        if (preg_match('/' . $cur_date_day . ',/', $inconv_timing['days']))
                            $flag = 1;
                        if ($flag) {
                            if (($inconv_timing['effect_to'] == '' && strtotime($inconv_timing['effect_from']) <= strtotime($new_date)) || (strtotime($inconv_timing['effect_from']) <= strtotime($new_date) && strtotime($inconv_timing['effect_to']) >= strtotime($new_date))) {




                                if (((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to']) &&
                                        ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])) {
                                    $is_oncall = TRUE;
                                }
                            }
                        }
                    }
                    if (!$is_oncall) {
                        $msg->set_message_exact('fail', $new_date . ' => ' . str_pad(sprintf('%.02f', (float) $time_from), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $time_to), 5, '0', STR_PAD_LEFT));
                        return FALSE;
                    } else {
                        return TRUE;
                    }
                }
            }
        } else {
            $msg->set_message_exact('fail', 'No oncall Defined');
            return FALSE;
        }
    }

    function check_given_slots_colliding_with_target_slots($slot_details, $target_slots, $check_type) {
        // exit('coliide');
        $msg = new message();
        if (empty($target_slots))
            return TRUE;
        else {
            foreach ($this->employees as $employee) {
                $employee_source_slots = $this->get_given_slots_of_an_employee($slot_details, $employee);
                $employee_target_slots = $this->get_given_slots_of_an_employee($target_slots, $employee);
               // echo "<pre>".$employee.print_r($employee_source_slots,1)."</pre>";
                // echo "<pre>".$employee.print_r($employee_target_slots,1)."</pre>";
                               
                // var_dump($check_type);
                if (!empty($employee_target_slots)) {
                    foreach ($employee_source_slots as $source_slot) {
                        foreach ($employee_target_slots as $target_slot) {
                            $flag = 0;
                            if ($check_type == 1) {
                                if (date('d', strtotime($source_slot['date'])) == date('d', strtotime($target_slot['date'])))
                                    $flag = 1;
                            }elseif ($check_type == 2) {
                                if (date('N', strtotime($source_slot['date'])) == date('N', strtotime($target_slot['date'])))
                                    $flag = 1;
                            }elseif ($check_type == 3) {
                                $flag = 1;
                            }
                            if ($flag) {
                                if (($source_slot['time_from'] >= $target_slot['time_from'] && $source_slot['time_from'] < $target_slot['time_to']) ||
                                        ($source_slot['time_to'] > $target_slot['time_from'] && $source_slot['time_to'] <= $target_slot['time_to']) ||
                                        ($source_slot['time_from'] < $target_slot['time_from'] && $source_slot['time_to'] > $target_slot['time_to'])) {
                                    $emp_name = $_SESSION['company_sort_by'] == 1 ? $source_slot['emp_first_name'] . " " . $source_slot['emp_last_name'] : $source_slot['emp_last_name'] . " " . $source_slot['emp_first_name'];
                                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_slot['date'] . ' ' . str_pad(sprintf('%.02f', (float) $source_slot['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $source_slot['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . ' ' . $target_slot['date'] . ' ' . str_pad(sprintf('%.02f', $target_slot['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $target_slot['time_to']), 5, '0', STR_PAD_LEFT));
                                    return FALSE;
                                }
                            }
                        }
                    }
                }
            }
            return TRUE;
        }
    }

    function check_given_slots_colliding_with_target_slots_datewise($slot_details, $target_slots, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times) {
        $msg = new message();
        if (empty($target_slots)) {
            return TRUE;
        } else {
            //echo "<pre>".print_r($slot_details,1)."</pre>";
            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
            foreach ($this->employees as $employee) {
                $employee_source_slots = $this->get_given_slots_of_an_employee($slot_details, $employee);
                //echo "<pre>".print_r($employee_source_slots,1)."</pre>";
                for ($i = 1; $i <= $no_of_times; $i++) {

                    foreach ($employee_source_slots as $source_slot) {
                        $new_date = date('Y-m-d', strtotime($source_slot['date'] . " +" . ($date_diff * $i) . " days"));
                        //echo $new_date."<br>";
                        $employee_target_slots = $this->get_given_slots_of_an_employee($target_slots, $employee, $new_date);
                        if (!empty($employee_target_slots)) {
                            foreach ($employee_target_slots as $target_slot) {

                                if (($source_slot['time_from'] >= $target_slot['time_from'] && $source_slot['time_from'] < $target_slot['time_to']) ||
                                        ($source_slot['time_to'] > $target_slot['time_from'] && $source_slot['time_to'] <= $target_slot['time_to']) ||
                                        ($source_slot['time_from'] < $target_slot['time_from'] && $source_slot['time_to'] > $target_slot['time_to'])) {
                                    $emp_name = $_SESSION['company_sort_by'] == 1 ? $source_slot['emp_first_name'] . " " . $source_slot['emp_last_name'] : $source_slot['emp_last_name'] . " " . $source_slot['emp_first_name'];
                                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_slot['date'] . ' ' . str_pad(sprintf('%.02f', (float) $source_slot['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $source_slot['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . ' ' . $target_slot['date'] . ' ' . str_pad(sprintf('%.02f', $target_slot['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $target_slot['time_to']), 5, '0', STR_PAD_LEFT));
                                    return FALSE;
                                }
                            }
                        }
                    }
                }
            }
            return TRUE;
        }
    }

    function get_distinct_employees_from_given_slots($slot_details) {
        $employees = array();
        foreach ($slot_details as $slot_detail) {
            if (!in_array($slot_detail['employee'], $employees) && $slot_detail['employee'] != '')
                $employees[] = $slot_detail['employee'];
            $emp_name = $_SESSION['company_sort_by'] == 1 ? $slot_detail['emp_first_name'] . " " . $slot_detail['emp_last_name'] : $slot_detail['emp_last_name'] . " " . $slot_detail['emp_first_name'];
            $this->employee_details[$slot_detail['employee']] = $emp_name;
        }
        return $employees;
    }

    function get_distinct_customers_from_given_slots($slot_details) {
        $customers = array();
        foreach ($slot_details as $slot_detail) {
            if (!in_array($slot_detail['customer'], $customers) && $slot_detail['customer'] != '')
                $customers[] = $slot_detail['customer'];
        }
        return $customers;
    }

    function get_given_slots_of_an_employee($slot_details, $employee, $date = '') {
        $slots = array();
        foreach ($slot_details as $slot_detail) {
            if ($date == '') {
                if ($slot_detail['employee'] == $employee)
                    $slots[] = $slot_detail;
            }else {
                if ($slot_detail['employee'] == $employee && $slot_detail['date'] == $date)
                    $slots[] = $slot_detail;
            }
        }
        return $slots;
    }

    function get_specific_slot_types_from_give_slots($slot_details, $type) {
        $type;
        $slots = array();
        foreach ($slot_details as $slot_detail) {
            if ($slot_detail['type'] == $type)
                $slots[] = $slot_detail;
        }
        return $slots;
    }

    // to check the given array of employees are active
    function check_given_employees_are_active($employees) {
        $msg = new message();
        $employees_string = "'" . implode("','", $employees) . "'";
        $this->sql_query = "SELECT username,first_name,last_name from employee WHERE status=0 and username IN(" . $employees_string . ")";
        $datas = $this->query_fetch();
        if (empty($datas))
            return TRUE;
        else {

            $emp_name = '';
            $i = 0;
            foreach ($datas as $data) {
                if ($i != 0)
                    $emp_name .= ",";
                $emp_name .= $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . " " . $data['last_name'] : $data['last_name'] . " " . $data['first_name'];
                $i++;
            }
            $msg->set_message_exact('fail', ' - ' . $emp_name);
            return FALSE;
        }
    }

    // to check the given array of customers are active
    function check_given_customers_are_active($customers) {
        $msg = new message();
        $customers_string = "'" . implode("','", $customers) . "'";
        $this->sql_query = "SELECT username,first_name,last_name from customer WHERE status=0 and username IN(" . $customers_string . ")";
        $datas = $this->query_fetch();
        if (empty($datas))
            return TRUE;
        else {

            $cust_name = '';
            $i = 0;
            foreach ($datas as $data) {
                if ($i != 0)
                    $cust_name .= ",";
                $cust_name .= $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . " " . $data['last_name'] : $data['last_name'] . " " . $data['first_name'];
                //$this->customer_details[$data['username']] = $cust_name;
                $i++;
            }
            $msg->set_message_exact('fail', ' - ' . $cust_name);
            return FALSE;
        }
    }

    function get_employee_slot_between_dates($employees, $start_date, $end_date, $customers) {
        $customers_string = "";

        $employees_string = "'" . implode("','", $employees) . "'";
        $this->sql_query = "SELECT *, (SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name, (SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name FROM timetable WHERE status IN(0,1) AND employee IN(" . $employees_string . ") AND date between '" . $start_date . "' AND '" . $end_date . "'";
        if (!empty($customers)) {
            $customers_string = "'" . implode("','", $customers) . "'";
            $this->sql_query .= " AND customer IN(" . $customers_string . ")";
        }
        $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_leave_between_dates($employees, $start_date, $end_date) {
        $employees_string = "'" . implode("','", $employees) . "'";
        $this->sql_query = "SELECT *, (SELECT first_name FROM employee where username = `leave`.employee) AS emp_first_name, (SELECT last_name FROM employee where username = `leave`.employee) AS emp_last_name FROM `leave` WHERE status IN(0,1) AND employee IN(" . $employees_string . ") AND date between '" . $start_date . "' AND '" . $end_date . "'";
        $datas = $this->query_fetch();
        return $datas;
    }

    function check_employees_in_customer_team($employees, $customer) {
        $msg = new message();
        $employees_string = "'" . implode("','", $employees) . "'";
        $this->sql_query = "SELECT username,first_name,last_name,(SELECT first_name FROM customer where username = '" . $customer . "') AS cust_first_name, (SELECT last_name FROM customer where username = '" . $customer . "') AS cust_last_name FROM employee e 
                                 LEFT JOIN team tm ON e.username LIKE tm.employee AND tm.customer = '" . $customer . "' 
                                 WHERE e.username IN (" . $employees_string . ") AND tm.employee IS NULL";
        $datas = $this->query_fetch();
        if (empty($datas))
            return TRUE;
        else {
            $i = 0;
            $emp_name = '';
            $cust_name = '';
            foreach ($datas as $data) {
                if ($i != 0)
                    $emp_name .= ",";
                else
                    $cust_name .= $_SESSION['company_sort_by'] == 1 ? $data['cust_first_name'] . " " . $data['cust_last_name'] : $data['cust_last_name'] . " " . $data['cust_first_name'];
                $emp_name .= $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . " " . $data['last_name'] : $data['last_name'] . " " . $data['first_name'];
                $i++;
            }
            $msg->set_message_exact('fail', $cust_name . " <=> " . $emp_name);
            return FALSE;
        }
    }

    function check_employees_signed_between_dates($employees, $customer, $start_date, $end_date) {
        $msg = new message();
        $employees_string = "'" . implode("','", $employees) . "'";
        $start_date = date('Y-m-d', strtotime('first day of this month', strtotime($start_date)));
        $end_date = date('Y-m-d', strtotime('last day of this month', strtotime($end_date)));
        $this->sql_query = "SELECT employee, customer, date, (SELECT first_name FROM employee where username = report_signing.employee) AS emp_first_name, (SELECT last_name FROM employee where username = report_signing.employee) AS emp_last_name, (SELECT first_name FROM customer where username = report_signing.customer) AS cust_first_name, (SELECT last_name FROM customer where username = report_signing.customer) AS cust_last_name FROM report_signing WHERE signin_employee IS NOT NULL AND signin_employee != '' AND customer = '" . $customer . "' AND employee IN(" . $employees_string . ") AND date BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        $datas = $this->query_fetch();
        if (!$datas) {
            return TRUE;
        } else {
            $i = 0;
            $emp_name = '';
            $cust_name = '';
            foreach ($datas as $data) {
                if ($i != 0)
                    $emp_name .= ",";
                else
                    $cust_name .= $_SESSION['company_sort_by'] == 1 ? $data['cust_first_name'] . " " . $data['cust_last_name'] : $data['cust_last_name'] . " " . $data['cust_first_name'];
                $emp_name .= $_SESSION['company_sort_by'] == 1 ? $data['emp_first_name'] . " " . $data['emp_last_name'] . "=>" . $data['date'] : $data['emp_last_name'] . " " . $data['emp_first_name'] . "=>" . $data['date'];
                $i++;
            }
            $msg->set_message_exact('fail', $cust_name . " <=> " . $emp_name);
        }
    }

    function check_oncall_slot_range_permissible($slot_details, $customer, $start_date, $end_date, $check_type) {
        //echo $check_type;
        //echo "<pre>".print_r(func_get_args(),1)."</pre>";
        $msg = new message();
        $oncall_slots = $this->get_specific_slot_types_from_give_slots($slot_details, 3);
        if (empty($oncall_slots))
            return TRUE;
        $inconv_oncalls = $this->get_inconvenient_oncall_between_dates($customer, $start_date, $end_date);
//        echo "<pre>".print_r($oncall_slots,1)."</pre>";
        if (!empty($inconv_oncalls)) {
            foreach ($oncall_slots as $oncall_slot) {
                $is_oncall = FALSE;
                $time_from = $oncall_slot['time_from'];
                $time_to = $oncall_slot['time_to'];
                $date = $oncall_slot['date'];
                foreach ($inconv_oncalls as $inconv_timing) {
                    $flag = 0;
                    echo $cur_date_day = date('N', strtotime($oncall_slot['date']));
                    if ($check_type == 3) {
                        $cur_date_day = date('N', strtotime($start_date));
                        $date = $start_date;
                    }
                    if (preg_match('/' . $cur_date_day . ',/', $inconv_timing['days']))
                        $flag = 1;

                    if ($flag) {

                        if (((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to']) &&
                                ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])) {
                            $is_oncall = TRUE;
                        }
                    }
                }
                if (!$is_oncall) {
                    $msg->set_message_exact('fail', $date . ' => ' . str_pad(sprintf('%.02f', (float) $time_from), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $time_to), 5, '0', STR_PAD_LEFT));
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        } else {
            $msg->set_message_exact('fail', 'No oncall Defined');
            return FALSE;
        }
    }

    function get_inconvenient_oncall_between_dates($customer, $start_date, $end_date, $get_from_global_if_not_exist = TRUE) {
        if (trim($customer) == '') {
            if ($get_from_global_if_not_exist)
                return $this->get_global_inconvenient_oncall_between_dates($start_date, $end_date);
            else
                return array();
        } else {
            $timing = array();
            $this->flush();
            //check any customer inconvenience for this date included period
            $this->tables = array('inconvenient_timing_customer');
            $this->fields = array('id', 'group_id', 'customer', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount');
            $this->conditions = array('AND', 'customer = ?', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')));
            $this->condition_values = array($customer, $start_date, $start_date, $end_date);
            $this->query_generate();
            $datas = $this->query_fetch();
//            echo "<pre>**$customer++".print_r($datas, 1)."</pre>";

            if ($get_from_global_if_not_exist && empty($datas)) {

                return $this->get_global_inconvenient_oncall_between_dates($start_date, $end_date);
            }
            else
                return $datas;
        }
    }

    function get_global_inconvenient_oncall_between_dates($start_date, $end_date) {
        //for taking inconvenient timings for a day
        // $normal_oncall : 1- normal, 3-oncall

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'group_id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days', 'amount', 'sal_call_training', 'sal_complementary_oncall', 'sal_more_oncall');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), 'type=3');
        $this->condition_values = array($start_date, $start_date, $end_date);
        $this->query_generate();

        return $this->query_fetch();
    }

    function check_slots_colllide_internally($slot_periods, $start_date, $end_date, $to_single_day) {
        $msg = new message();
        $date = $start_date;
        for ($i = 0; $i < count($slot_periods); $i++) {

            if ($slot_periods[$i]['employee'] == '')
                continue;
            for ($j = $i + 1; $j < count($slot_periods); $j++) {

                if ($slot_periods[$j]['employee'] == '')
                    continue;

                if ($slot_periods[$j]['employee'] != $slot_periods[$i]['employee'])
                    continue;

                if ($to_single_day != 3 && date('N', strtotime($slot_periods[$j]['date'])) != date('N', strtotime($slot_periods[$i]['date'])))
                    continue;

                if (($slot_periods[$j]['time_from'] >= $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_from'] < $slot_periods[$i]['time_to']) ||
                        ($slot_periods[$j]['time_to'] > $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_to'] <= $slot_periods[$i]['time_to']) ||
                        ($slot_periods[$j]['time_from'] < $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_to'] > $slot_periods[$i]['time_to'])) {


                    $emp_name = $_SESSION['company_sort_by'] == 1 ? $slot_periods[$j]['emp_first_name'] . " " . $slot_periods[$j]['emp_last_name'] : $slot_periods[$j]['emp_last_name'] . " " . $slot_periods[$j]['emp_first_name'];
                    if ($to_single_day != 3)
                        $date = $slot_periods[$j]['date'];
                    $msg->set_message_exact('fail', $emp_name . ' ' . $date . ' ' . str_pad(sprintf('%.02f', (float) $slot_periods[$i]['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $slot_periods[$i]['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . str_pad(sprintf('%.02f', (float) $slot_periods[$j]['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $slot_periods[$j]['time_to']), 5, '0', STR_PAD_LEFT));
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

    function backup_data($single_company){
        $backup_year = date('Y')-1;
        $this->select_db($single_company['db_name']);
        //backup timetable
        $this->sql_query = "INSERT INTO backup_timetable (SELECT * from timetable where date < '01')";
        $datas = $this->query_fetch();
        if (empty($datas))
            return TRUE;
    }

    function check_non_prefered_time_overlap($slot_details, $start_date, $end_date ,$check_type){
        $msg        = new message();
        $is_overlap = FALSE;
        $obj_emp    = new employee_ext();
        // $days       = [7,1,2,3,4,5,6]; // 7-sunday ... 1-monday table day number.
        // var_dump($start_date, $end_date ,$check_type,$slot_details);
       
        // var_dump($leave_timings = $this->get_employee_leave_between_dates($this->employees, $start_date, $end_date));
       
        if(empty($slot_details))
            return TRUE;
        else{
            foreach ($slot_details as $key => $value) {
                $all_employees_from_slots[] = $value['employee']; 
            }
            $unique_employee_of_slots = array_unique($all_employees_from_slots);
            if(!empty($unique_employee_of_slots)){
                $non_preferred_details =  $obj_emp->get_non_preferred_unique_employee($unique_employee_of_slots, $start_date, $end_date);
                 // var_dump($non_preferred_details);
                foreach ($slot_details as $slot_key => $slot_det) {
                    if($check_type == 1){
                        $slot_date_number   = date('d', strtotime($slot_det['date']));
                        $paste_date = date('Y-m', strtotime($start_date)).'-'.$slot_date_number;
                        // var_dump($start_date, $slot_date_number, $paste_date,date('N',strtotime($paste_date)));
                    }
                    else if($check_type == 2){
                        $slot_day   = date('N', strtotime($slot_det['date']));
                        $inr        = $slot_day-1;
                        $paste_date = date('Y-m-d', strtotime("+".$inr." day", strtotime($start_date)));
                    }
                    foreach ($non_preferred_details as $prefer_key => $preferred_det) {
                        $flag = 0;
                        if ($check_type == 1) {
                            if (date('N',strtotime($paste_date)) == $preferred_det['day'] && ( $paste_date >= $preferred_det['date_from'] && $paste_date <= $preferred_det['date_to'])){
                                $preferred_det['date'] = $paste_date; 
                                $flag = 1;
                            }
                        }elseif ($check_type == 2) {
                            if (date('N',strtotime($paste_date)) == $preferred_det['day'] && ( $paste_date >= $preferred_det['date_from'] && $paste_date <= $preferred_det['date_to'])){
                                $preferred_det['date'] = $paste_date; 
                                $flag = 1;
                            }
                        }elseif ($check_type == 3) {
                             $day       = date('N', strtotime($start_date));
                             if($day == $preferred_det['day']){
                                $flag = 1;
                                $preferred_det['date'] = $start_date;
                             }
                        }
                        if ($flag) {
                            if($slot_det['time_from']<$preferred_det['time_to'] && $slot_det['time_to']>$preferred_det['time_from']  && $slot_det['employee'] == $preferred_det['employee']){
                                $emp_name = $_SESSION['company_sort_by'] == 1 ? $slot_det['emp_first_name'] . " " . $slot_det['emp_last_name'] : $slot_det['emp_last_name'] . " " . $slot_det['emp_first_name'];

                            $msg->set_message_exact('fail', $emp_name . ' ' . $slot_det['date'] . ' ' . str_pad(sprintf('%.02f', (float) $slot_det['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $slot_det['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . ' ' . $preferred_det['date'] . ' ' . str_pad(sprintf('%.02f', $preferred_det['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $preferred_det['time_to']), 5, '0', STR_PAD_LEFT));

                                // $msg->set_message_exact('fail', $emp_name . ' ' . $slot_det['date'] . ' ' . str_pad(sprintf('%.02f',$slot_det['time_from'] ), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $slot_det['time_to']), 5, '0', STR_PAD_LEFT));
                            return FALSE;

                                // $is_overlap = TRUE;
                                // break;
                            }
                        }


                        // var_dump($slot_det['time_from'],$preferred_det['time_to'] , $slot_det['time_to'],$preferred_det['time_from'] , (string)$day , $preferred_det['day'] , $slot_det['employee'] , $preferred_det['employee']);
                        
                    }
                    // if($is_overlap)
                    //     break;
                }
                return TRUE;
            }
        }
        
        // $slot_date
        // $this->sql_query = "SELECT count(id),`time_from`,`time_to` FROM `employee_non_preferred_timings` WHERE (`slot_date`  BETWEEN `date_from` AND `date_to`) AND `day` = WEEKDAY(slot_date)+1 AND  (t_from<`time_to` AND t_to>`time_from`) AND employee=emp ;";
        // exit();
    }

    function check_non_prefered_time_overlap_in_pastedays($slot_details , $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times){
        $msg        = new message();
        $is_overlap = FALSE;
        $obj_emp    = new employee_ext();

        if(empty($slot_details))
            return TRUE;
        else{
            foreach ($slot_details as $key => $value) {
                $all_employees_from_slots[] = $value['employee']; 
            }
            $unique_employee_of_slots = array_unique($all_employees_from_slots);
            if(!empty($unique_employee_of_slots)){
                $non_preferred_details =  $obj_emp->get_non_preferred_unique_employee($unique_employee_of_slots, $paste_start, $paste_end);
                foreach ($slot_details as $slot_key => $slot_det) {
                    $slot_day = date('N', strtotime($slot_det['date']));
                    $days     = $this->get_multiple_day_between_two_dates($paste_start, $paste_end, $slot_day);
                    foreach ($days as $key => $day) {
                        foreach ($non_preferred_details as $prefer_key => $preferred_det) {
                            if (date('N',strtotime($day)) == $preferred_det['day'] && ( $day >= $preferred_det['date_from'] && $day <= $preferred_det['date_to'])){
                                $preferred_det['date'] = $day; 
                                $flag = 1;
                            }

                            if ($flag) {
                                if($slot_det['time_from']<$preferred_det['time_to'] && $slot_det['time_to']>$preferred_det['time_from']  && $slot_det['employee'] == $preferred_det['employee']){
                                    $emp_name = $_SESSION['company_sort_by'] == 1 ? $slot_det['emp_first_name'] . " " . $slot_det['emp_last_name'] : $slot_det['emp_last_name'] . " " . $slot_det['emp_first_name'];

                                $msg->set_message_exact('fail', $emp_name . ' ' . $slot_det['date'] . ' ' . str_pad(sprintf('%.02f', (float) $slot_det['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $slot_det['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . ' ' . $preferred_det['date'] . ' ' . str_pad(sprintf('%.02f', $preferred_det['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $preferred_det['time_to']), 5, '0', STR_PAD_LEFT));
                                return FALSE;
                                }
                            }
                        }
                    }
                }
                return TRUE;
            }
        }
    }

    function get_multiple_day_between_two_dates($startDate, $endDate, $day){
        $startDate = new DateTime($startDate);
        $endDate   = new DateTime($endDate);
        $days      = array();

        while ($startDate <= $endDate) {
            if ($startDate->format('N') == $day) {
                $days[] = $startDate->format('Y-m-d');
            }

            $startDate->modify('+1 day');
        }
        return $days;
    }

}

?>