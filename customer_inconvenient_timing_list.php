<?php
require_once('class/setup.php');
require_once('class/inconvenient_timing.php');
require_once('class/customer.php');
require_once('class/company.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("gdschema.xml", "customer.xml", "inconvenient_timing.xml", "messages.xml", "button.xml", "month.xml", "user.xml", "common.xml", "privilege.xml"));
$inc_timing = new inconvenient_timing();
$customer = new customer();
$messages = new message();
$obj_company = new company();
$datecalc = new datecalc();
$employee = new employee();
$user = new user();
$obj_general = new general();

$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));


$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_oncall'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if (!empty($_POST)) {

    $w_days = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");  // checkbox name
    $w_days_count = count($w_days);
    $pararms = explode('&', $_SERVER['QUERY_STRING']);
//echo "<pre>".print_r($_POST, 1)."</pre>";
    $smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
    $customer_username = $pararms[0];
    $customer_id = $_POST['cust_id'];
//$flag = ($pararms[1] == 'newentry') ? 1 : 0;
    $flag = ($_POST['action'] == 'newentry') ? 1 : 0;
    $smarty->assign('flag', $flag);
    $company_detail = $obj_company->get_company_detail($_SESSION['company_id']);
    $salary_system = $company_detail['salary_system'];
    $smarty->assign('salary_system', $salary_system);
    $action = '';
//if(!empty($pararms) && trim($pararms[1]) != "" && count($pararms)== 3 && trim($pararms[2]) == "edit") { $action = 'edit'; }
    if ($_POST['action'] == "edit") {
        $action = 'edit';
    }
//else if(!empty($pararms) && trim($pararms[1]) != "" && count($pararms)== 3 && trim($pararms[2]) == "clone") { $action = 'clone'; }
    else if ($_POST['action'] == "clone") {
        $action = 'clone';
    }
//else if(!empty($pararms) && trim($pararms[1]) != "" && count($pararms)== 3 && trim($pararms[2]) == "delete") { $action = 'delete'; }
    else if ($_POST['action'] == "delete") {
        $action = 'delete';
    } else {
        $action = 'new';
    }
    $this_id = NULL;
    $this_timing = array();
    $timetable_timings = array();

//if (!empty($pararms) && trim($pararms[1]) != "" && ($action == "edit" || $action == "clone" || $action == "delete")){
    if (!empty($pararms) && trim($customer_id) != "" && ($action == "edit" || $action == "clone" || $action == "delete")) {

        $this_id = trim($customer_id);
        $this_timing = $inc_timing->customer_inconvenient_timing($this_id);
        if (empty($this_timing)) {
            $action = 'new';
            $this_id = NULL;
        } else {
            if ($action == "edit") {
                $days_new = explode(',', $this_timing[0]['days']);
                for ($i = 0; $i < count($days_new) - 1; $i++) {
                    //echo "<script>alert('".$days_new[$i]."')</script>";
                    $timetable_values = $inc_timing->get_timetable_all($this_timing[0]['effect_from'], $this_timing[0]['effect_to'], $this_timing[0]['time_from'], $this_timing[0]['time_to'], $days_new[$i]);

                    if ($timetable_values) {
                        for ($j = 0; $j < count($timetable_values); $j++) {
                            $timetable_timings[] = $timetable_values[$j];
                        }
                    }
                }
//            $smarty->assign('timetable',$inc_timing->get_timetable_all());
            }
        }
    }

    /* ---------------------------------- Delete action--------------------------------------------- */
    if ($action == 'delete' && $this_id != NULL) {      //delete inconvenient
        $inc_timing->begin_transaction();
        if ($inc_timing->customer_inconvenient_timing_delete($this_id)) {
            $inc_timing->commit_transaction();
            $messages->set_message('success', 'inconvenient_details_deleted_successfully');
        } else {
            $inc_timing->rollback_transaction();
            $messages->set_message('fail', 'inconvenient_details_deletion_failed');
        }
        header("Location: " . $smarty->url . 'customer/inconvenient/timings/list/' . $customer_username . '/');
        exit();
    } else if ($action == 'clone' && $this_timing[0]['effect_to'] != '') {
        $messages->set_message('fail', 'inconvenient_cloning_can_possible_only_from_leaf_child');
        header("Location: " . $smarty->url . 'customer/inconvenient/timings/list/' . $customer_username . '/');
        exit();
    }

    if ((trim($_POST['name']) != '' || trim($_POST['new_name']) != '' || $action == 'clone') && trim($_POST['date_from']) != '' && trim($_POST['time_from']) != '' && trim($_POST['time_to']) != ''/* && trim($_POST['salary']) != ''*/) {
        $error_flag = FALSE;
        $final_id = '';
        $inc_timing->name = !empty($_POST['new_name']) ? trim($_POST['new_name']) : trim($_POST['name']);
        if ($action == 'clone' || $action == 'edit') {
            $inc_timing->name = $this_timing[0]['name'];
        }
        $inc_timing->effect_from = trim($_POST['date_from']);
        if ($action == 'edit' && $this_timing[0]['effect_to'] != '')
            $inc_timing->effect_to = trim($_POST['date_to']) != '' ? trim($_POST['date_to']) : NULL;
        else
            $inc_timing->effect_to = NULL;
        $inc_timing->type = $_POST['intype'];       // normal/oncall
        $inc_timing->amount = trim($_POST['salary']) != '' ? trim($_POST['salary']) : NULL;
        $inc_timing->salary_call_training = trim($_POST['salary_call_training']) != '' ? trim($_POST['salary_call_training']) : NULL;
        $inc_timing->salary_complimentary_oncall = trim($_POST['salary_complimentary_oncall']) != '' ? trim($_POST['salary_complimentary_oncall']) : NULL;
        $inc_timing->salary_more_oncall = trim($_POST['salary_more_oncall']) != '' ? trim($_POST['salary_more_oncall']) : NULL;
        $inc_timing->salary_dismissal_oncall = trim($_POST['salary_dismissal_oncall']) != '' ? trim($_POST['salary_dismissal_oncall']) : NULL;
        $inc_timing->nature = trim($_POST['ltype']) != '' ? trim($_POST['ltype']) : 0;
        $grp_ids = $inc_timing->customer_timing_name_get_all();

        for ($i = 0; $i < count($grp_ids); $i++) {
            //echo $inc_timing->name." == ".$grp_ids[$i]['name']."<br>";
            if ($inc_timing->name == $grp_ids[$i]['name']) {
                //echo "hai fiestcakss";
                $group_id = $grp_ids[$i]['group_id'];
            }
        }
        //$group_id = $inc_timing->get_customer_inconvenient_group_id($action, $this_id);
        $inc_timing->group_id = $group_id['group_id'];
//    $inc_timing->group_id = $group_id;
        for ($i = 0; $i < $w_days_count; $i++) {
            if (!empty($_POST[$w_days[$i]]))
                $days .= $_POST[$w_days[$i]] . ',';
        }
        $days = preg_replace('/,$/', '', $days);
        $inc_timing->days = $days . ',';
        $in_type = $_POST['intype'];
        $effect_from = $_POST['date_from'];
        $effect_to = trim($_POST['date_to']) != '' ? trim($_POST['date_to']) : NULL;
        $leave_type = $_POST['ltype'];      // descrete/contigeous

        $from_time = $datecalc->time_to_sixty($_POST['time_from']);
        $to_time = $datecalc->time_to_sixty($_POST['time_to']);
        if ($to_time == 0) {
            $to_time = 24;
        }

        if ($inc_timing->effect_to != NULL && $inc_timing->effect_from >= $inc_timing->effect_to) {
            $messages->set_message('fail', 'date_to_must_greater_than_date_from');
        } else if (!$inc_timing->customer_inconvenient_colide($days, $leave_type, $customer_username, $effect_from, $effect_to, $from_time, $to_time, $action, $this_id)) {

            $messages->set_message('fail', 'slot_collide');
        } else if ($from_time == FALSE || $to_time == FALSE) {
            $messages->set_message('fail', 'invalid_time');
        } else {
            //////////////////////////////////////////////Edit////////////////////////////////////////////////
            $inc_timing->begin_transaction();
            if ($action == 'edit') {
                if (!$inc_timing->customer_inconvenient_timing_delete($this_id)) {    // delete old inconvenient entries for creating new entries
                    $error_flag = TRUE;
                    $inc_timing->rollback_transaction();
                    $messages->set_message('fail', 'inconvenient_details_editing_failed');
                } else if ($this_timing[0]['name'] != $inc_timing->name) {
                    if (!$inc_timing->change_customer_inconvenient_name_by_group_id($this_timing[0]['group_id'], $inc_timing->name)) {
                        $error_flag = TRUE;
                        $inc_timing->rollback_transaction();
                        $messages->set_message('fail', 'inconvenient_details_editing_failed');
                    }
                }
            } else if ($action == 'clone') {  // get parent inconvenient details///////////////////////////////clone////////////////
                $timing = $inc_timing->customer_inconvenient_timing($this_id);
                if (empty($timing)) {
                    $error_flag = TRUE;
                    $inc_timing->rollback_transaction();
                    $messages->set_message('fail', 'inconvenient_details_not_exist');
                } elseif ($timing[0]['effect_to'] != '' && $inc_timing->effect_from < date('Y-m-d', strtotime('+2 day', $timing[0]['effect_from']))) {
                    $error_flag = TRUE;
                    $inc_timing->rollback_transaction();
                    $messages->set_message('fail', 'effect_from_must_2day_greater_than_of_parent_effect_to');
                } elseif (!$inc_timing->customer_inconvenient_timing_make_closed($this_id)) {
                    $error_flag = TRUE;
                    $inc_timing->rollback_transaction();
                    $messages->set_message('fail', 'inconvenient_cloning_failed');
                } else {
                    $inc_timing->name = $timing[0]['name'];
                }
            }
            if (!$error_flag) {
                if ($_POST['ltype']) { //if continus day
                    $sorted_days = explode(',', $days);
                    $array_count = count($sorted_days);
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
                            } else {
                                break;
                            }
                        }
                    }
                    if (count($old_array) != count($sorted_days)) {
                        $sorted_days = array_merge($old_array, $new_array);
                    }

                    $i = 0;
                    $flag = 0;
                    switch ($action) {
                        case 'new' :
                        case 'edit' :
                        case 'clone' :

                            if ($array_count > 1) {     //if have more than two continus day
                                $between_days_array = $sorted_days;
                                //remove first index
                                array_shift($between_days_array);
                                //remove last index
                                array_pop($between_days_array);
                                $between_days = implode(',', $between_days_array);

                                //inserting first day
                                $inc_timing->days = $sorted_days[0] . ',';
                                $inc_timing->time_from = $from_time;
                                $inc_timing->time_to = 24;
                                $inc_timing->customer = $customer_username;
                                if ($inc_timing->customer_inconvenient_timing_add()) {
                                    $inc_timing->root_id = $inc_timing->get_id();
                                    $final_id = $inc_timing->root_id;
                                    //inserting between days
                                    $inc_timing->days = $between_days . ',';
                                    $inc_timing->time_from = 0;
                                    $inc_timing->time_to = 24;
                                    if ($inc_timing->customer_inconvenient_timing_add()) {
                                        //inserting last day
                                        $inc_timing->days = $sorted_days[$array_count - 1] . ',';
                                        $inc_timing->time_from = 0;
                                        $inc_timing->time_to = $to_time;
                                        if ($inc_timing->customer_inconvenient_timing_add()) {
                                            $inc_timing->commit_transaction();
                                            $messages->set_message('success', 'saved_inconvinent_timing');
                                        } else {
                                            $inc_timing->rollback_transaction();
                                            $messages->set_message('fail', 'cant_save_inconvinent_time');
                                        }
                                    } else {
                                        $inc_timing->rollback_transaction();
                                        $messages->set_message('fail', 'cant_save_inconvinent_time');
                                    }
                                } else {
                                    $inc_timing->rollback_transaction();
                                    $messages->set_message('fail', 'cant_save_inconvinent_time');
                                }
                            } else if ($array_count == 1) {
                                $inc_timing->customer = $customer_username;
                                //inserting first day
                                $inc_timing->days = $sorted_days[0] . ',';
                                $inc_timing->time_from = $from_time;
                                $inc_timing->time_to = 24;
                                if ($inc_timing->customer_inconvenient_timing_add()) {
                                    $inc_timing->root_id = $inc_timing->get_id();
                                    $final_id = $inc_timing->root_id;
                                    //inserting between days
                                    $inc_timing->days = $sorted_days[1] . ',';
                                    $inc_timing->time_from = 0;
                                    $inc_timing->time_to = $to_time;
                                    if ($inc_timing->customer_inconvenient_timing_add()) {
                                        $inc_timing->commit_transaction();
                                        $messages->set_message('success', 'saved_inconvinent_timing');
                                    } else {
                                        $inc_timing->rollback_transaction();
                                        $messages->set_message('fail', 'cant_save_inconvinent_time');
                                    }
                                } else {
                                    $inc_timing->rollback_transaction();
                                    $messages->set_message('fail', 'cant_save_inconvinent_time');
                                }
                            } else {        //if only have one day
                                $inc_timing->customer = $customer_username;
                                $inc_timing->time_from = $from_time;
                                $inc_timing->time_to = $to_time;
                                if ($inc_timing->customer_inconvenient_timing_add()) {
                                    $final_id = $inc_timing->get_id();
                                    $inc_timing->commit_transaction();
                                    $messages->set_message('success', 'saved_inconvinent_timing');
                                } else {
                                    $inc_timing->rollback_transaction();
                                    $messages->set_message('fail', 'cant_save_inconvinent_time');
                                }
                            }
                            break;
                    }
                } else {        //if descrete days
                    switch ($action) {
                        case 'new' :
                        case 'edit' :
                        case 'clone' :
                            if ($from_time >= $to_time) {
                                $inc_timing->customer = $customer_username;
                                $inc_timing->time_from = $from_time;
                                $inc_timing->time_to = 24;
                                if ($inc_timing->customer_inconvenient_timing_add()) {
                                    //taking next day
                                    $days_array = explode(',', $days);
                                    $next_day_array = array();
                                    foreach ($days_array as $day) {
                                        if ($day == 7)
                                            $next_day_array[] = 1;
                                        else
                                            $next_day_array[] = $day + 1;
                                    }
                                    $inc_timing->days = implode(',', $next_day_array) . ',';
                                    $inc_timing->root_id = $inc_timing->get_id();
                                    $final_id = $inc_timing->root_id;
                                    $inc_timing->time_from = 0;
                                    $inc_timing->time_to = $to_time;
                                    if ($inc_timing->customer_inconvenient_timing_add()) {
                                        $inc_timing->commit_transaction();
                                        $messages->set_message('success', 'saved_inconvinent_timing');
                                    } else {
                                        $inc_timing->rollback_transaction();
                                        $messages->set_message('fail', 'cant_save_inconvinent_time');
                                    }
                                } else {
                                    $inc_timing->rollback_transaction();
                                    $messages->set_message('fail', 'cant_save_inconvinent_time');
                                }
                            } else {
                                $inc_timing->customer = $customer_username;
                                $inc_timing->time_from = $from_time;
                                $inc_timing->time_to = $to_time;
                                if ($inc_timing->customer_inconvenient_timing_add()) {
                                    $final_id = $inc_timing->get_id();
                                    $inc_timing->commit_transaction();
                                    $messages->set_message('success', 'saved_inconvinent_timing');
                                } else {
                                    $inc_timing->rollback_transaction();
                                    $messages->set_message('fail', 'cant_save_inconvinent_time');
                                }
                            }

                            break;
                    }
                }
                //if(($action == 'edit' || $action == 'new' || $action == 'clone') && $final_id != ''){
                // header ('Location: '. $smarty->url.'customer/inconvenient/timing/'.$customer_username.'/'.$final_id.'/edit/');
                // exit();
                //}
                header('Location: ' . $smarty->url . 'customer/inconvenient/timings/list/' . $customer_username . '/');
                exit();
            }
        }
        header('Location: ' . $smarty->url . 'customer/inconvenient/timings/list/' . $customer_username . '/');
        exit();
    } else if (!empty($_POST)) {
        $messages->set_message('fail', 'fill_required_fields');
        header('Location: ' . $smarty->url . 'customer/inconvenient/timings/list/' . $customer_username . '/');
        exit();
    }



///////////////////////////////////////////////////NEW Entry/////////////////////////////////////////////


    if ($action == 'new' && isset($_POST)) {
        $this_timings['name'] = !empty($_POST['new_name']) ? trim($_POST['new_name']) : trim($_POST['name']);
        ;
        $this_timings['effect_from'] = trim($_POST['date_from']);
        $this_timings['effect_to'] = trim($_POST['date_to']) != '' ? trim($_POST['date_to']) : NULL;
        $this_timings['time_from'] = trim($_POST['time_from']);
        $this_timings['time_to'] = trim($_POST['time_to']);
        $this_timings['amount'] = trim($_POST['salary']) != '' ? trim($_POST['salary']) : NULL;
        $this_timings['sal_call_training'] = trim($_POST['salary_call_training']) != '' ? trim($_POST['salary_call_training']) : NULL;
        $this_timings['sal_complementary_oncall'] = trim($_POST['salary_complimentary_oncall']) != '' ? trim($_POST['salary_complimentary_oncall']) : NULL;
        $this_timings['sal_more_oncall'] = trim($_POST['salary_more_oncall']) != '' ? trim($_POST['salary_more_oncall']) : NULL;
        $this_timings['sal_dismissal_oncall'] = trim($_POST['salary_dismissal_oncall']) != '' ? trim($_POST['salary_dismissal_oncall']) : NULL;

        $this_timings['nature'] = trim($_POST['ltype']) != '' ? trim($_POST['ltype']) : 0;
//    $this_timings['type'] = $_POST['intype'];

        for ($j = 0; $j < $w_days_count; $j++) {
            if (!empty($_POST[$w_days[$j]]))
                $d[$w_days[$j]] = 1;
            else
                $d[$w_days[$j]] = 0;
        }
        $smarty->assign('days', $d);
    }
    elseif (!empty($pararms) && trim($pararms[1]) != "") {
        $id = trim($pararms[1]);
        $this_timings = array();
        $timing = $inc_timing->customer_inconvenient_timing($id);
//    echo "<pre>".print_r($timing, 1)."</pre>";
        if (!empty($timing)) {
            $this_timings['id'] = $id;
            $this_timings['name'] = $timing[0]['name'];
            $this_timings['effect_from'] = $timing[0]['effect_from'];
            $this_timings['effect_to'] = $timing[0]['effect_to'];
//        $this_timings['time_from'] = $inc_timing->convert_time_part($timing[0]['time_from']);
            $this_timings['time_from'] = $timing[0]['time_from'];
            $this_timings['time_to'] = $timing[0]['time_to'];
//        $this_timings['days'] = $timing[0]['days'];
            $this_timings['amount'] = $timing[0]['amount'];
            $this_timings['sal_call_training'] = $timing[0]['sal_call_training'];
            $this_timings['sal_complementary_oncall'] = $timing[0]['sal_complementary_oncall'];
            $this_timings['sal_more_oncall'] = $timing[0]['sal_more_oncall'];
            $this_timings['sal_dismissal_oncall'] = $timing[0]['sal_dismissal_oncall'];
            $this_timings['nature'] = $timing[0]['nature'];
            $this_timings['type'] = $timing[0]['type'];
            if ($action == 'clone') {
                if ($this_timings['effect_to'] != '') {
                    $this_timings['effect_from'] = date('Y-m-d', strtotime('+1 day', strtotime($this_timings['effect_to'])));
                    $this_timings['effect_to'] = date('Y-m-d', strtotime('+1 day', strtotime($this_timings['effect_from'])));
                }
                else
                    $this_timings['effect_from'] = date('Y-m-d');
            }

            $days = explode(",", $timing[0]['days']);
            $child_timings = $inc_timing->customer_inconvenient_child_timings($id);
            if (!empty($child_timings)) {
                $child_count = count($child_timings);
                if ($action == 'edit' && $child_timings[$child_count - 1]['type'] == 3) {


                    $days_new = explode(',', $child_timings[$child_count - 1]['days']);
                    for ($i = 0; $i < count($days_new) - 1; $i++) {
//                    echo "<script>alert('".$days_new[$i]."')</script>";
                        $timetable_values = $inc_timing->get_timetable_all($child_timings[$child_count - 1]['effect_from'], $child_timings[$child_count - 1]['effect_to'], $child_timings[$child_count - 1]['time_from'], $child_timings[$child_count - 1]['time_to'], $days_new[$i]);
                        if ($timetable_values) {
                            for ($j = 0; $j < count($timetable_values); $j++) {
                                $timetable_timings[] = $timetable_values[$j];
                            }
                        }
                    }
                }

                $this_timings['time_to'] = $child_timings[count($child_timings) - 1]['time_to'];
                foreach ($child_timings as $child) {
                    $child_days = explode(",", $child['days']);
                    if ($timing[0]['nature'] == 0 /* && $this_timings['time_from'] >= $this_timings['time_to'] */) {  //check descrete type inconvenient spans to next day
                        /* $days_array = explode(',', $days);
                          $next_day_array = array();
                          foreach ($days_array as $day) {
                          if ($day == 7)
                          $next_day_array[] = 1;
                          else
                          $next_day_array[] = $day + 1;
                          }
                          $final_days = implode(',', $next_day_array) . ','; */
                    }
                    else       //contigeous
                        $days = array_merge($days, $child_days);
                }
            }
            for ($j = 0; $j < $w_days_count; $j++) {
                if (($n = array_search($j + 1, $days)) !== FALSE)
                    $d[$w_days[$j]] = 1;
                else
                    $d[$w_days[$j]] = 0;
            }
            $smarty->assign('days', $d);
        }
    }
    $change_check_count = count($timetable_timings);
    $names = $inc_timing->customer_timing_name_get_all();
    $smarty->assign('timing', $this_timings);
    $smarty->assign('timing_names', $names);
    $smarty->assign('change_check_count', $change_check_count);
    $smarty->assign('customer_username', $customer_username);
    $customer_detail = $customer->customer_detail($customer_username);
    $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
    $smarty->assign('customer_detail', $customer_detail);
//show messages
    $smarty->assign('message', $messages->show_message());
    $smarty->assign('action', $action);
    
    $cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
    $smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);

    $smarty->display('extends:layouts/dashboard.tpl|customer_inconvenient_timing_list.tpl|layouts/sub_layout_customer_tabs.tpl');
}
else {
    global $week;
    $names = $inc_timing->customer_timing_name_get_all();
    $smarty->assign('timing_names', $names);
    $smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'INCONVINIENCE'));
    $query_string = explode("&", $_SERVER['QUERY_STRING']);
    $customer_username = $query_string[0];
    $customer_detail = $customer->customer_detail($customer_username);
    $customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
    $smarty->assign('customer_detail', $customer_detail);
    $list = $inc_timing->get_all_inconvenient_timing_list_customer($customer_username);
    $smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
    $smarty->assign('week', $week);
    $inconv_list_nested = array();
    if (!empty($list)) {
        /* $inconv_list_count = count($list);
          for ($i = 0; $i < $inconv_list_count; $i++) {
          if (($a = strpos($list[$i]['days'], '-')) !== FALSE) {
          $list[$i]['days'] = date("d F", strtotime('00-' . $list[$i]['days']));
          } else {
          $month_nos = $list[$i]['day_time'];
          $day_time = "<table border='0' cellpadding='0' cellspacing='0'><tr>";
          foreach ($month_nos as $mlabels) {
          $day_time .= '<td>' . $smarty->translate[$week[$mlabels['day'] - 1]['label']] . '</td>';
          }
          $day_time .= "</tr><tr>";
          foreach ($month_nos as $mlabels) {
          $day_time .= '<td>' . $mlabels['time'] . '</td>';
          }
          $day_time .= "</tr></table>";
          $list[$i]['days'] = $day_time;
          }
          } */

        
        //merging same day times
        foreach ($list as $inc_key => $inc_entry){
            $list[$inc_key]['day_time_merged'] = array();
            if(!empty($inc_entry['day_time'])){
                foreach ($inc_entry['day_time'] as $inc_time_entry){
                    $list[$inc_key]['day_time_merged'][$inc_time_entry['day']][] = $inc_time_entry['time'];
                }
                if(!empty($list[$inc_key]['day_time_merged'])){
                    foreach ($list[$inc_key]['day_time_merged'] as $mKey => $inc_time_entry){
                        sort($list[$inc_key]['day_time_merged'][$mKey]);
                    }
                }
            }
        }

        foreach ($list as $incov) {
//        echo "<pre>". print_r(array_keys($inconv_list_nested), 1)."</pre>";
            if (in_array($incov['group_id'], array_keys($inconv_list_nested))) {
                $inconv_list_nested[$incov['group_id']]['privious_versions'][] = $incov;
            } else {
                $inconv_list_nested[$incov['group_id']] = $incov;
                $inconv_list_nested[$incov['group_id']]['privious_versions'] = array();
            }
        }
        
        //ordering inner inconvenient days from monday to sun
        foreach ($inconv_list_nested as $keygroup_id => $incov){
            ksort($inconv_list_nested[$keygroup_id]['day_time_merged']);
            if(!empty($incov['privious_versions'])){
                foreach ($incov['privious_versions'] as $keyprivious_version => $incov_privious_version){
                    if(!empty($incov_privious_version['day_time_merged'])){
                        ksort($inconv_list_nested[$keygroup_id]['privious_versions'][$keyprivious_version]['day_time_merged']);
                    }
                }
            }
        }
    }
    $smarty->assign('message', $messages->show_message());
//    echo "<pre>".print_r($inconv_list_nested, 1)."</pre>"; exit();
    $smarty->assign('timing_list', $inconv_list_nested);
    
    $cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
    $smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);

    $smarty->display('extends:layouts/dashboard.tpl|customer_inconvenient_timing_list.tpl|layouts/sub_layout_customer_tabs.tpl');
}
?>