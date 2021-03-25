<?php
function update_user_task($user_id, $status, $candg, $customer, $break_time) {

        $obj_equipment = new equipment();
        $obj_dona = new dona();
        $login_user = $user_id;
        $obj_emp = new employee();
        $recipents = $obj_emp->employee_leave_recipients($employee_username, 8);
        $employe_data = $this->get_employee_detail($login_user);
        $mail_message = 'Skickat från Come & Go<br>Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
        $mail_subject = "Arbetspass uppdaterat via C&G";
        $mail_slots = '';
        if ($status == "0") {
            //$start_time = new DateTime('2014-03-29 16:00:00');  

            $start_time = new DateTime;
            $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $start_time->setTimestamp(time());
            $current_date_time = $start_time->format('Y-m-d G:i:s');
            $current_date = $start_time->format('Y-m-d');
            $current_time = $start_time->format('G:i:s');
            $start_time->sub(new DateInterval('PT15M'));
            $start_date = $start_time->format('Y-m-d G:i:s');
            $start_time = $start_time->format('G:i:s');
            $task_slots = $this->check_slot_start($start_date, $start_time);
            if (count($task_slots) <= 0 && $candg == 0) {
                return -1;
            } else {

                $slot_det = $task_slots[0];
                //echo "<pre>\n".print_r($slot_det , 1)."</pre>";
                $current_date_time = round(strtotime($current_date_time) / (5 * 60)) * (5 * 60);
                $slot_date_time = strtotime($slot_det['time_from']);
                //echo date('Y-m-d G:i:s', $slot_date_time);
                $date = date('Y-m-d', $current_date_time);
                $time_from = date('G.i', $current_date_time);
                $time_to = date('G.i', strtotime($slot_det['time_to']));
                if ($time_to == 0.00)
                    $time_to = 24.00;
                $flag = 1;
                $second_flag = 1; // for checking more than one slot in the task
                $this->begin_transaction();
                $obj_dona->begin_transaction();
                if (!empty($slot_det)) {
                    if ($current_date_time < strtotime($slot_det['time_from'])) {
                        // Here checking if there is any slots exists for this employee between current time and the slot going to start
                        //inorder to add a slot between the gap

                        $slots_before_starting_slot = $this->get_slots_between_two_times($login_user, ($current_date . ' ' . $current_time), $slot_det['time_from'], '', 'id');
                        if (!empty($slots_before_starting_slot))
                            return -2;
                    }
                    if (abs($current_date_time - $slot_date_time) >= 300) { // checkingg whether there is a difference of 5 minutes with start time
                        if (strtotime(date('Y-m-d', $current_date_time)) > strtotime(date('Y-m-d', $slot_date_time))) {//if work starts in the next day
                            $this->tables = array('timetable');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_det['id']);
                            if ($this->query_delete()) {
                                if (!empty($task_slots[1])) {
                                    $slot_det = $task_slots[1];
                                } else {
                                    $second_flag = 0;
                                }
                            } else {
                                $flag = 0;
                            }
                        } elseif (strtotime(date('Y-m-d', $current_date_time)) < strtotime(date('Y-m-d', $slot_date_time))) {//if work starts in the previous day
                            if ($obj_dona->$this->slot_add_custom_type($slot_det['employee'], $slot_det['customer'], $date, $time_from, 24.00, $login_user, $slot_det['fkkn'], $slot_det['type'], '', null, 4)) {
                                $time_from = 0.00;
                                $mail_slots .= $date . " " . $time_from . "-" . 24.00 . "<br>Kund: " . $slot_det['cust_name'] . "<br>";
                            } else {
                                $flag = 0;
                            }
                        }
                        if ($flag == 1 && $second_flag == 1) {

                            if ($current_date_time < strtotime($slot_det['time_to'])) {

                                $this->tables = array('timetable');
                                $this->fields = array('time_from', 'status', 'created_status', 'alloc_emp');
                                $this->field_values = array($time_from, '4', '1', $login_user);
                                $this->conditions = array('id = ?');
                                $this->condition_values = array($slot_det['id']);
                                if (!$this->query_update()) {
                                    $flag = 0;
                                } else {
                                    $mail_slots .= substr($slot_det['time_to'], 0, 10) . " " . $time_from . "-" . substr($slot_det['time_to'], 11) . "<br>Kund: " . $slot_det['cust_name'] . "<br>";
                                }
                            } else {
                                $this->tables = array('timetable');
                                $this->conditions = array('id = ?');
                                $this->condition_values = array($slot_det['id']);
                                if (!$this->query_delete()) {
                                    $flag = 0;
                                }
                            }
                        }
                    }
                }
                if ($flag == 1) {
                    $this->tables = array('user_task');
                    $this->fields = array('userid', 'dag', 'start_time', 'customer');
                    $this->field_values = array($login_user, date('Y-m-d', $current_date_time), date('G:i:s', $current_date_time), $customer);
                    if ($this->query_insert()) {
                        $this->commit_transaction();
                        $obj_dona->commit_transaction();
                        if ($mail_slots != '') {
                            $mail = new SimpleMail($mail_subject, $mail_message . "Datum och pass:<br>" . $mail_slots);
                            $mail->addSender("cirrus-noreplay@time2view.se");
                            foreach ($recipents as $recipent) {

                                if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

                                    $mail->addRecipient($recipent['email']);
                                }
                            }
                            $mail->send();
                        }
                        return $this->get_id();
                    } else {
                        $this->rollback_transaction();
                        $obj_dona->rollback_transaction();
                        return FALSE;
                    }
                } else {
                    $this->rollback_transaction();
                    $obj_dona->rollback_transaction();
                    return FALSE;
                }
            }
        } else {

            //$stop_time = new DateTime('2014-10-04 00:05:00');  
            $stop_time = new DateTime();
            $stop_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
            $stop_time->setTimestamp(time());
            $stop_time = $stop_time->format('Y-m-d G:i:s');
            $data = $this->get_task_by_id($this->task_id);
            $date = $data[0]['dag'];
            $start_time = $data[0]['start_time'];
            $start_date_time = $data[0]['start_date_time'];
            $previous_end = strtotime($start_date_time);
            $datas = $this->employee_get_task_slots($login_user, $date, $start_time, 'all');
            $previous_data = $this->get_previous_slot_details($start_date_time, $login_user);
            $slot_end = '';
            //echo "<pre>\ndatas".print_r($datas , 1)."</pre>";
            //echo "<pre>\nprevious data".print_r($previous_data , 1)."</pre>";
            $flag = 1;
            $candg_flag = 0;
            $slots = '';
            $this->begin_transaction();
            $obj_dona->begin_transaction();
            if ($candg == 1 && empty($datas)) {
                $candg_flag = 1;
                $customer = $data[0]['customer'];
                if (strtotime($stop_time) - $previous_end >= 300) {
                    $slots_between = $this->get_slots_between_two_times($login_user, date('Y-m-d G:i:s', $previous_end), date('Y-m-d G:i:s', strtotime($stop_time)), '', 'id');
                    //echo "<pre>\ndatas".print_r($slots_between , 1)."</pre>";
                    foreach ($slots_between as $slot_ids) {
                        if (!$obj_dona->customer_employee_slot_remove($slot_ids)) {
                            $flag = 0;
                        }
                    }
                    //$stop_time = "2014-07-01 10:00:00";
                    $round_start = round($previous_end / (5 * 60)) * (5 * 60);
                    $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                    $temp_date = strtotime(date('Y-m-d', $round_start));
                    $previous_break_excess = 0;
                    $test_i = 0;


                    while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                        $test_i++;
                        $tmp_time_from = 0.00;
                        $tmp_time_to = 24.00;
                        if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                            $tmp_time_from = date('G.i', $round_start);
                        }
                        if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                            $tmp_time_to = date('G.i', $round_stop);
                        }
                        //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                        if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                            //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                            //When there is break hours need to be inserted 
                            $customer = $previous_data['customer'];
                            $slot_time_from = $tmp_time_from;
                            $slot_time_to = $tmp_time_to;

                            if ($previous_break_excess > 0) {
                                $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                if ($slot_time_from != $slot_time_to) {
                                    //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                        $slots .= $tmp_slots;
                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                        if ($slot_time_to != $tmp_break_time) {
                                            //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                $slots .= $obj_dona->get_id() . ',';
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                        }
                                        $slot_time_from = $tmp_break_time;
                                    } else {
                                        $flag = 0;
                                        break;
                                    }
                                }
                            }


                            $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);


                            while ($tmp_break_time <= $tmp_time_to) {
                                $previous_break_excess = 0;
                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                if ($slot_time_from != $slot_time_to) {
                                    //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                        $slots .= $tmp_slots;
                                        //echo $slots;
                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                        if ($slot_time_to != $tmp_break_time) {
                                            //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                $slots .= $obj_dona->get_id() . ',';
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                        }
                                    } else {
                                        $flag = 0;
                                        break;
                                    }
                                    //echo "-------------------------------------------------------------------------------------\n";
                                }
                                $slot_time_from = $tmp_break_time;
                                $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                $slot_time_to = $tmp_time_to;
                            }
                            if ($tmp_break_time > $tmp_time_to) {
                                if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                    $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                    if ($slot_time_from != $slot_time_to) {
                                        //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";

                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                            $slots .= $tmp_slots;
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                            if ($slot_time_to != $tmp_time_to) {
                                                //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "\n";
                                                if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                        //echo "-------------------------------------------------------------------------------------\n";
                                    }
                                } else {
                                    $slot_time_to = $tmp_time_to;
                                    if ($slot_time_from != $slot_time_to) {
//                                        echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
//                                        echo "-------------------------------------------------------------------------------------\n";
                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                            $slots .= $tmp_slots;
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }
                                }

                                $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                            }
                            /** End of break hours block* */
                        } else {
                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, 1, 0, '', null, 4)) {
                                $slots .= $tmp_slots;
                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                            } else {
                                $flag = 0;
                                break;
                            }
                        }
                        $temp_date = strtotime('+1 day', $temp_date);
                    }
                }
            } else {

                if (empty($previous_data)) {
                    if (!empty($datas))
                        $previous_data = $datas[0];
                    else
                        return FALSE;
                }


                foreach ($datas as $row) {
                    $slot_start = strtotime($row['slot_start']);
                    $slot_end = strtotime($row['slot_end']);
                    $test_i++;
                    if ($slot_start - $previous_end >= 300) {

                        //echo $test_i."---".$row['slot_start']."--".$row['slot_end']."-----------". date('Y-m-d H:i:s', $previous_end)."\n";
                        $round_start = round($previous_end / (5 * 60)) * (5 * 60);
                        $round_stop = round($slot_start / (5 * 60)) * (5 * 60);
                        $temp_date = strtotime(date('Y-m-d', $round_start));
                        $previous_break_excess = 0;
                        //echo $test_i . "---" . date('Y-m-d H:i:s', $round_start) . "--" . date('Y-m-d H:i:s', $round_stop) . "-----------" . date('Y-m-d H:i:s', $temp_date) . "\n";
                        while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                            $tmp_time_from = 0.00;
                            $tmp_time_to = 24.00;
                            if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                                $tmp_time_from = date('G.i', $round_start);
                            }
                            if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                $tmp_time_to = date('G.i', $round_stop);
                            }

                            //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                            if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                //echo $test_i . "---" . date('Y-m-d', $temp_date) . "-----" . $tmp_time_from . "--" . $tmp_time_to . "-----" . $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) . "\n";
                                //When there is break hours need to be inserted 
                                $customer = $previous_data['customer'];
                                $slot_time_from = $tmp_time_from;
                                $slot_time_to = $tmp_time_to;

                                if ($previous_break_excess > 0) {
                                    $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                    $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                    if ($slot_time_from != $slot_time_to) {
                                        //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                        if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                            $slots .= $obj_dona->get_id() . ',';
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                            if ($slot_time_to != $tmp_break_time) {
                                                //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                            $slot_time_from = $tmp_break_time;
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }
                                }


                                $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);

                                while ($tmp_break_time <= $tmp_time_to) {
                                    $previous_break_excess = 0;
                                    $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                    if ($slot_time_from != $slot_time_to) {
                                        //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                        if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                            $slots .= $obj_dona->get_id() . ',';
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                            if ($slot_time_to != $tmp_break_time) {
                                                //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                    $slots .= $obj_dona->get_id() . ',';
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                        //echo "-------------------------------------------------------------------------------------\n";
                                    }
                                    $slot_time_from = $tmp_break_time;
                                    $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                    $slot_time_to = $tmp_time_to;
                                }
                                if ($tmp_break_time > $tmp_time_to) {
                                    if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                        $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                        if ($slot_time_from != $slot_time_to) {
                                            //echo "\n" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";

                                            if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $obj_dona->get_id() . ',';
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                if ($slot_time_to != $tmp_time_to) {
                                                    //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "\n";
                                                    if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                        $slots .= $obj_dona->get_id() . ',';
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                            //echo "-------------------------------------------------------------------------------------\n";
                                        }
                                    } else {
                                        $slot_time_to = $tmp_time_to;
                                        if ($slot_time_from != $slot_time_to) {
                                            //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                            //echo "-------------------------------------------------------------------------------------\n";
                                            if ($this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $obj_dona->get_id() . ',';
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                        }
                                    }

                                    $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                }
                                /** End of break hours block* */
                            } else {
                                if ($tmp_time_from != $tmp_time_to) {
                                    //echo $test_i . "---" . date('Y-m-d', $temp_date) . "-----" . $tmp_time_from . "--" . $tmp_time_to . "\n";
                                    if ($this->slot_add_custom_type($login_user, $previous_data['customer'], date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, $previous_data['fkkn'], 0, '', null, 4)) {
                                        $slots .= $obj_dona->get_id() . ',';
                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $previous_data['customer'] . "<br>";
                                    } else {
                                        $flag = 0;
                                        break;
                                    }
                                }
                            }
                            $temp_date = strtotime('+1 day', $temp_date);
                        }
                    }
                    if (strtotime($stop_time) <= $slot_end) {
                        //echo "fjdshfjkhdjkhdjkshhsgkjfhgjkfdshgfdskjghkfdsjg<br>";
                        //Here to fix for break
                        if ($slot_end - strtotime($stop_time) >= 300) {
                            $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                            $this->tables = array('timetable');
                            $this->fields = array('time_to', 'status', 'created_status', 'alloc_emp');
                            $this->field_values = array(date('G.i', $round_stop), '4', '1', $login_user);
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($row['id']);
                            if ($this->query_update()) {
                                $mail_slots .= date('Y-m-d', $round_stop) . " " . date('G.i', $slot_start) . "-" . date('G.i', $round_stop) . "<br>Kund: " . $slot_det['cust_name'] . "<br>";
                                $flag = 1;
                                $slots .= $row['id'] . ',';
                                break;
                            } else {
                                $flag = 0;
                                break;
                            }
                        }
                    }
                    $previous_end = $slot_end;
                }
            }
            if ($flag == 1) {

                //echo "=====================================================================================<br>";
                if ($candg_flag == 0) {

                    if (strtotime($stop_time) > $slot_end || $slot_end == '') {
                        if ($slot_end != '') {

                            $round_start = round($slot_end / (5 * 60)) * (5 * 60);
                            $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                            $temp_date = strtotime(date('Y-m-d', $round_start));
                            $previous_break_excess = 0;
                            while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {

                                if ($temp_date == strtotime(date('Y-m-d', $round_start)) && $temp_date == strtotime(date('Y-m-d', $slot_start))) {
                                    if ($temp_date == strtotime(date('Y-m-d', $round_stop)))
                                        $time_to = date('G.i', $round_stop);
                                    else
                                        $time_to = 24.00;
                                    $this->tables = array('timetable');
                                    $this->fields = array('status', 'created_status', 'alloc_emp');
                                    $this->field_values = array('4', '1', $login_user);
                                    $this->conditions = array('id = ?');
                                    $this->condition_values = array($row['id']);
                                    if (!$this->query_update()) {
                                        $this->rollback_transaction();
                                        $obj_dona->rollback_transaction();
                                        $flag = 0;
                                    } else {///HERE BREAK NOT INCLUDED
                                        $mail_slots .= date('Y-m-d', $round_stop) . " " . date('G.i', $slot_start) . "-" . date('G.i', $round_stop) . "<br>Kund: " . $slot_det['cust_name'] . "<br>";
                                        $slots .= $row['id'] . ',';
                                        $tmp_time_from = date('G.i', $slot_end);
                                        $tmp_time_to = date('G.i', $round_stop);
                                        $customer = $previous_data['customer'];
                                        if($tmp_time_from != $tmp_time_to){
                                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $tmp_slots;
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                            } else {
                                                $this->rollback_transaction();
                                                $obj_dona->rollback_transaction();
                                                $flag = 0;
                                            }
                                        }
                                    }
                                } else {
                                    $tmp_time_from = 0.00;
                                    $tmp_time_to = 24.00;
                                    if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                        $tmp_time_to = date('G.i', $round_stop);
                                    }
                                    //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                    if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                        //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                        //When there is break hours need to be inserted 
                                        $customer = $previous_data['customer'];
                                        $slot_time_from = $tmp_time_from;
                                        $slot_time_to = $tmp_time_to;

                                        if ($previous_break_excess > 0) {   
                                            $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_break_time) {
                                                        //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                    $slot_time_from = $tmp_break_time;
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        }


                                        $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);

                                        while ($tmp_break_time <= $tmp_time_to) {
                                            $previous_break_excess = 0;
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_break_time) {
                                                        //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "<br>";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                                //echo "-------------------------------------------------------------------------------------<br>";
                                            }
                                            $slot_time_from = $tmp_break_time;
                                            $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                            $slot_time_to = $tmp_time_to;
                                        }
                                        if ($tmp_break_time > $tmp_time_to) {
                                            if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                                $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                                if ($slot_time_from != $slot_time_to) {
                                                    //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";

                                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $tmp_slots;
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                        if ($slot_time_to != $tmp_time_to) {
                                                            //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "<br>";
                                                            if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                                $slots .= $obj_dona->get_id() . ',';
                                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                            } else {
                                                                $flag = 0;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                    //echo "-------------------------------------------------------------------------------------<br>";
                                                }
                                            } else {
                                                $slot_time_to = $tmp_time_to;
                                                if ($slot_time_from != $slot_time_to) {
//                                                    echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
//                                                    echo "-------------------------------------------------------------------------------------<br>";
                                                    if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                        $slots .= $tmp_slots;
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            }

                                            $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                        }
                                        /** End of break hours block* */
                                    } else {
                                        if ($tmp_slots = $this->slot_add_custom_type($login_user, $previous_data['customer'], date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, $previous_data['fkkn'], 0, '', null, 4)) {
                                            $slots .= $tmp_slots;
                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $previous_data['cust_name'] . "<br>";
                                        } else {
                                            $flag = 0;
                                            break;
                                        }
                                    }
                                }
                                $temp_date = strtotime('+1 day', $temp_date);
                            }
                        } else {
                            $round_start = round(strtotime($start_date_time) / (5 * 60)) * (5 * 60);
                            $round_stop = round(strtotime($stop_time) / (5 * 60)) * (5 * 60);
                            $temp_date = strtotime(date('Y-m-d', $round_start));
                            $previous_break_excess = 0;
                            while ($temp_date <= strtotime(date('Y-m-d', $round_stop))) {
                                $tmp_time_from = 0.00;
                                $tmp_time_to = 24.00;
                                if ($temp_date == strtotime(date('Y-m-d', $round_start))) {
                                    $tmp_time_from = date('G.i', $round_start);
                                }
                                if ($temp_date == strtotime(date('Y-m-d', $round_stop))) {
                                    $tmp_time_to = date('G.i', $round_stop);
                                }
                                //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                if ($break_time > 0 && $obj_equipment->time_difference($tmp_time_from, $tmp_time_to) >= $break_time) {
                                    //echo $test_i."---".date('Y-m-d', $temp_date)."-----".$tmp_time_from."--".$tmp_time_to."-----".$obj_equipment->time_difference($tmp_time_from, $tmp_time_to)."\n";
                                    //When there is break hours need to be inserted 
                                    $customer = $previous_data['customer'];
                                    $slot_time_from = $tmp_time_from;
                                    $slot_time_to = $tmp_time_to;

                                    if ($previous_break_excess > 0) {
                                        $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $previous_break_excess);
                                        $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                        if ($slot_time_from != $slot_time_to) {
                                            //echo "\ntype1" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "\n";
                                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $tmp_slots;
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $obj_equipment->time_sum($slot_time_from, $previous_break_excess) . "<br>Kund: " . $customer . "<br>";
                                                if ($slot_time_to != $tmp_break_time) {
                                                    //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "\n";
                                                    if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                        $slots .= $obj_dona->get_id() . ',';
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                                $slot_time_from = $tmp_break_time;
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                        }
                                    }


                                    $tmp_break_time = $obj_equipment->time_sum($slot_time_from, $break_time);

                                    while ($tmp_break_time <= $tmp_time_to) {
                                        $previous_break_excess = 0;
                                        $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                        if ($slot_time_from != $slot_time_to) {
                                            //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
                                            if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                $slots .= $tmp_slots;
                                                $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                if ($slot_time_to != $tmp_break_time) {
                                                    //echo date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_break_time . "<br>";
                                                    if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_break_time, $login_user, 1, 2, '', null, 4)) {
                                                        $slots .= $obj_dona->get_id() . ',';
                                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_break_time . "<br>Kund: " . $customer . "<br>";
                                                    } else {
                                                        $flag = 0;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                $flag = 0;
                                                break;
                                            }
                                            //echo "-------------------------------------------------------------------------------------<br>";
                                        }
                                        $slot_time_from = $tmp_break_time;
                                        $tmp_break_time = $obj_equipment->time_sum($tmp_break_time, $break_time);
                                        $slot_time_to = $tmp_time_to;
                                    }
                                    if ($tmp_break_time > $tmp_time_to) {
                                        if ($obj_equipment->time_sub($tmp_break_time, 0.30) < $tmp_time_to) {
                                            $slot_time_to = $obj_equipment->time_sub($tmp_break_time, 0.30);
                                            if ($slot_time_from != $slot_time_to) {
                                                //echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";

                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                    if ($slot_time_to != $tmp_time_to) {
                                                        //      echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_to . "--" . $tmp_time_to . "<br>";
                                                        if ($obj_dona->customer_employee_slot_add($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_to, $tmp_time_to, $login_user, 1, 2, '', null, 4)) {
                                                            $slots .= $obj_dona->get_id() . ',';
                                                            $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_to . "-" . $tmp_time_to . "<br>Kund: " . $customer . "<br>";
                                                        } else {
                                                            $flag = 0;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                                //echo "-------------------------------------------------------------------------------------<br>";
                                            }
                                        } else {
                                            $slot_time_to = $tmp_time_to;
                                            if ($slot_time_from != $slot_time_to) {
//                                                echo "<br>" . date('Y-m-d', $temp_date) . "-----" . $slot_time_from . "--" . $slot_time_to . "<br>";
//                                                echo "-------------------------------------------------------------------------------------<br>";
                                                if ($tmp_slots = $this->slot_add_custom_type($login_user, $customer, date('Y-m-d', $temp_date), $slot_time_from, $slot_time_to, $login_user, 1, 0, '', null, 4)) {
                                                    $slots .= $tmp_slots;
                                                    $mail_slots .= date('Y-m-d', $temp_date) . " " . $slot_time_from . "-" . $slot_time_to . "<br>Kund: " . $customer . "<br>";
                                                } else {
                                                    $flag = 0;
                                                    break;
                                                }
                                            }
                                        }

                                        $previous_break_excess = $obj_equipment->time_sub($tmp_break_time, $tmp_time_to);
                                    }
                                    /** End of break hours block* */
                                } else {
                                    if ($obj_dona->$this->slot_add_custom_type($login_user, $previous_data['customer'], date('Y-m-d', $temp_date), $tmp_time_from, $tmp_time_to, $login_user, $previous_data['fkkn'], 0, '', null, 4)) {
                                        $slots .= $obj_dona->get_id() . ',';
                                        $mail_slots .= date('Y-m-d', $temp_date) . " " . $tmp_time_from . "-" . $tmp_time_to . "<br>Kund: " . $previous_data['cust_name'] . "<br>";
                                    } else {
                                        $flag = 0;
                                        break;
                                    }
                                }
                                $temp_date = strtotime('+1 day', $temp_date);
                            }
                        }
                    }
                }
                if ($flag == 1) {
                    $this->tables = array('user_task');
                    $this->fields = array('slotids=?', 'end_time=?', 'dur=TIMEDIFF(`end_time`,`start_time`)', 'status=?');
                    $this->field_values = array($slots, $stop_time, '1');
                    $this->conditions = array('id = ?');
                    $this->condition_values = array($this->task_id);
                    if ($this->query_update(1)) {
                        $this->commit_transaction();
                        $obj_dona->commit_transaction();
                        if ($mail_slots != '') {
                            $mail = new SimpleMail($mail_subject, $mail_message . "Datum och pass:<br>" . $mail_slots);
                            $mail->addSender("cirrus-noreplay@time2view.se");
                            foreach ($recipents as $recipent) {

                                if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

                                    $mail->addRecipient($recipent['email']);
                                }
                            }
                            $mail->send();
                        }
                        return TRUE;
                    } else {
                        $this->rollback_transaction();
                        $obj_dona->rollback_transaction();
                        return FALSE;
                    }
                } else {
                    $this->rollback_transaction();
                    $obj_dona->rollback_transaction();
                    return FALSE;
                }
            } else {
                $this->rollback_transaction();
                $obj_dona->rollback_transaction();
                return FALSE;
            }
        }
    }
    ?>