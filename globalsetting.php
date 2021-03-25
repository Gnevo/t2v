<?php

require_once('class/setup.php');
require_once('class/company.php');
require_once('class/newcustomer.php');
require_once('plugins/message.class.php');
require_once('class/inconvenient_timing.php');
//require_once('class/equipment.php');
//require_once('class/dona.php');
$smarty = new smartySetup(array('company.xml', 'reports.xml', 'gdschema.xml', 'user.xml', 'messages.xml', 'button.xml', 'month.xml','tooltip.xml'));
$company = new company();
$customer = new newcustomer();
$obj_inc_timing = new inconvenient_timing();
$messages = new message();
//$employee = new equipment();
//$dona = new dona();
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$smarty->assign('companies', $company->company_list());
$query_string = explode('&', $_SERVER['QUERY_STRING']);

$company_detail = $company->get_company_detail($_SESSION['company_id']);
$salary_system = $company_detail['salary_system'];
$smarty->assign('salary_system', $salary_system);

if ($_SERVER['QUERY_STRING']) {
    $smarty->assign('action', $query_string[0]);
} else {
    $sal_main = $customer->getsalary_main();
    if ($sal_main) {
        header("Location: " . $smarty->url . "globalsettings/get/" . $sal_main['id'] . "/");
    } else {
        header("Location: " . $smarty->url . "globalsettings/add/");
    }
    exit();
}
if ($query_string[0] != 'add') {
    $smarty->assign('action', '');
    $smarty->assign('salary_main', $customer->getsalary_main());
//   header("Location: " . $smarty->url . "globalsettings/get/".$sal_main['id']."/");
}
if ($query_string[0] == 'edit') {
    $smarty->assign('salary_main', $customer->getsalary_main());
} 
else if ($query_string[0] == 'del') {
    $customer->delete_salary_main($query_string[1]);
    $smarty->assign('salary_main', $customer->getsalary_main());
    header("location:" . $smarty->url . "globalsettings/");
} 
else if ($query_string[0] == 'clone') {
    $smarty->assign('action', 'add');
    $smarty->assign('clone_action', 'clone');
    $latest = $customer->getsalary_main();
    if (strtotime($latest['effect_from']) > strtotime(date('Y-m-d'))) {
        $new_date = date("Y-m-d", strtotime($latest['effect_from'] . "+1 day"));
    } else {
        $new_date = date("Y-m-d");
    }
    $latest['effect_from'] = $new_date;
    $smarty->assign('salary_main', $latest);
    if (!empty($_POST)) {
        $customer->insurance_personal = str_replace(",", ".", $_POST['insurance']);
        $customer->normal = str_replace(",", ".", $_POST['normal']);
        $customer->travel = str_replace(",", ".", $_POST['travel']);
        $customer->break = str_replace(",", ".", $_POST['break']);
        $customer->oncall = str_replace(",", ".", $_POST['oncall']);
        $customer->overtime = str_replace(",", ".", $_POST['overtime']);
        $customer->qual_overtime = str_replace(",", ".", $_POST['qual_overtime']);
        $customer->more_time = str_replace(",", ".", $_POST['more_time']);
        $customer->some_other_time = str_replace(",", ".", $_POST['some_other_time']);
        $customer->training_time = str_replace(",", ".", $_POST['training_time']);
        $customer->call_training = str_replace(",", ".", $_POST['call_training']);
        $customer->personal_meeting = str_replace(",", ".", $_POST['personal_meeting']);
        $customer->voluntary = str_replace(",", ".", $_POST['voluntary']);
        $customer->complementary = str_replace(",", ".", $_POST['complementary']);
        $customer->complementary_oncall = str_replace(",", ".", $_POST['complementary_oncall']);
        $customer->more_oncall = str_replace(",", ".", $_POST['more_oncall']);
        $customer->standby = str_replace(",", ".", $_POST['standby']);
        $customer->work_for_dismissal = str_replace(",", ".", $_POST['work_for_dismissal']);
        $customer->work_for_dismissal_oncall = str_replace(",", ".", $_POST['work_for_dismissal_oncall']);

        $customer->holiday_big = str_replace(",", ".", $_POST['holiday_big']);
        $customer->holiday_big_oncall = str_replace(",", ".", $_POST['holiday_big_oncall']);
        $customer->holiday_red = str_replace(",", ".", $_POST['holiday_red']);
        $customer->holiday_red_oncall = str_replace(",", ".", $_POST['holiday_red_oncall']);
        $customer->week_end_travel = str_replace(",", ".", $_POST['wkend_travel']);
        $customer->begin_transaction();
//        $customer->edit_default_start_time_and_day_company();
        $overlap = 0;
        if ($customer->give_effect_to_old_data($_POST['effect_from'])) {
            $data = $customer->check_overlap();
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['effect_to'] == "0000-00-00") {
                    if ($_POST['effect_from'] <= $data[$i]['effect_from'])
                        $overlap = 1;
                }else {
                    if (($_POST['effect_from'] >= $data[$i]['effect_from']) && ($_POST['effect_from'] <= $data[$i]['effect_to']))
                        $overlap = 1;
                }
            }
            if ($overlap == 0) {
                if ($customer->add_new_salary_main($_POST['effect_from'], $query_string[1], $_POST['increment'])) {
                    
                    if(isset($_POST['ob_inconv']) && !empty($_POST['ob_inconv'])){
                        $ob_inconvenients = array();
                        foreach($_POST['ob_inconv'] as $ob_id => $ob_salary){
                            if(trim($ob_id) != ''){
//                                $ob_inconvenients[] = array('id' => trim($ob_id), 'salary' => floatval(trim($ob_salary)));
                                $ob_inconvenients[] = array('id' => trim($ob_id), 
                                    'normal'            => floatval(trim($ob_salary['normal'])),
                                    'training'          => floatval(trim($ob_salary['training_time'])),
                                    'complementary'     => floatval(trim($ob_salary['complementary'])),
                                    'work_for_dismissal'=> floatval(trim($ob_salary['work_for_dismissal']))
                                );
                            }
                        }

                        //Update ob inconvenients
    //                    echo "<pre>".print_r($ob_inconvenients, 1)."</pre>";
                        if(!empty($ob_inconvenients)){
                            $ob_transaction_flag = TRUE;
                            $obj_inc_timing->begin_transaction();
                            foreach($ob_inconvenients as $ob_entry){
//                                $ob_transaction_flag = $obj_inc_timing->inconvenient_timing_update_amount($ob_entry['id'], $ob_entry['salary']);
                                $ob_transaction_flag = $obj_inc_timing->inconvenient_timing_update_amount($ob_entry['id'], $ob_entry['normal'], $ob_entry['training'], $ob_entry['complementary'], $ob_entry['work_for_dismissal']);
                                
                                if(!$ob_transaction_flag) break;
                            }

                            if($ob_transaction_flag) $obj_inc_timing->commit_transaction();
                            else $obj_inc_timing->rollback_transaction();
                        }
                    }
                
                    if(isset($_POST['jour_inconv']) && !empty($_POST['jour_inconv'])){
                        $jour_inconvenients = array();
                        foreach($_POST['jour_inconv'] as $jour_id => $jour_salaries){
                            if(trim($jour_id) != ''){
                                $jour_inconvenients[] = array('id' => trim($jour_id), 
                                    'oncall'                => floatval(trim($jour_salaries['oncall'])),
                                    'call_training'         => floatval(trim($jour_salaries['call_training'])),
                                    'complementary_oncall'  => floatval(trim($jour_salaries['complementary_oncall'])),
                                    'more_oncall'           => floatval(trim($jour_salaries['more_oncall'])),
                                    'work_for_dismissal_oncall'=> floatval(trim($jour_salaries['work_for_dismissal_oncall'])));
                            }
                        }

    //                    echo "<pre>".print_r($jour_inconvenients, 1)."</pre>";
                        //Update jour inconvenients
                        if(!empty($jour_inconvenients)){
                            $jour_transaction_flag = TRUE;
                            $obj_inc_timing->begin_transaction();
                            foreach($jour_inconvenients as $jour_entry){
                                $jour_transaction_flag = $obj_inc_timing->inconvenient_timing_update_jour_salaries($jour_entry['id'], $jour_entry['oncall'], $jour_entry['call_training'], $jour_entry['complementary_oncall'], $jour_entry['more_oncall'], $jour_entry['work_for_dismissal_oncall']);
                                if(!$jour_transaction_flag) break;
                            }

                            if($jour_transaction_flag) $obj_inc_timing->commit_transaction();
                            else $obj_inc_timing->rollback_transaction();
                        }
                    }
                
                    $messages->set_message('success', 'salary_adding_success_normal');
                    $customer->commit_transaction();
                    header("Location: " . $smarty->url . "globalsettings/get/" . $customer->salary_main_last_id . "/");
                    exit();
                } else {
                    $messages->set_message('fail', 'adding_failed_global');
                    $customer->rollback_transaction();
                }
            } else {
                $messages->set_message('fail', 'overlap_with_previous');
                $customer->rollback_transaction();
            }
        }
        $sal_main = $customer->getsalary_main();
        if ($sal_main) {
            header("Location: " . $smarty->url . "globalsettings/get/" . $sal_main['id'] . "/");
            exit();
        }
    }
}
else if ($query_string[0] == 'get') {
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $customer->insurance_personal = str_replace(",", ".", $_POST['insurance']);
        $customer->normal = str_replace(",", ".", $_POST['normal']);
        $customer->travel = str_replace(",", ".", $_POST['travel']);
        $customer->break = str_replace(",", ".", $_POST['break']);
        $customer->oncall = str_replace(",", ".", $_POST['oncall']);
        $customer->overtime = str_replace(",", ".", $_POST['overtime']);
        $customer->qual_overtime = str_replace(",", ".", $_POST['qual_overtime']);
        $customer->more_time = str_replace(",", ".", $_POST['more_time']);
        $customer->some_other_time = str_replace(",", ".", $_POST['some_other_time']);
        $customer->training_time = str_replace(",", ".", $_POST['training_time']);
        $customer->call_training = str_replace(",", ".", $_POST['call_training']);
        $customer->personal_meeting = str_replace(",", ".", $_POST['personal_meeting']);
        $customer->voluntary = str_replace(",", ".", $_POST['voluntary']);
        $customer->complementary = str_replace(",", ".", $_POST['complementary']);
        $customer->complementary_oncall = str_replace(",", ".", $_POST['complementary_oncall']);
        $customer->more_oncall = str_replace(",", ".", $_POST['more_oncall']);
        $customer->standby = str_replace(",", ".", $_POST['standby']);
        $customer->work_for_dismissal = str_replace(",", ".", $_POST['work_for_dismissal']);
        $customer->work_for_dismissal_oncall = str_replace(",", ".", $_POST['work_for_dismissal_oncall']);

        $customer->holiday_big = str_replace(",", ".", $_POST['holiday_big']);
        $customer->holiday_big_oncall = str_replace(",", ".", $_POST['holiday_big_oncall']);
        $customer->holiday_red = str_replace(",", ".", $_POST['holiday_red']);
        $customer->holiday_red_oncall = str_replace(",", ".", $_POST['holiday_red_oncall']);
        $customer->week_end_travel = str_replace(",", ".", $_POST['wkend_travel']);
//        $customer->start_day = $_POST['start_day'].$dona->time_to_sixty($_POST['start_time']);
//        $customer->start_time = $_POST['start_time'];
//            $customer->AddGlobalSetting_new();
//            $customer->edit_default_start_time_and_day_company();
        $customer->begin_transaction();
//            $customer->edit_default_start_time_and_day_company();
        $check_overlap = $customer->check_overlap_edit($_POST['selected']);
        $overlap = 0;
        $great = 0;
        for ($i = 0; $i < count($check_overlap); $i++) {
            if ($_POST['effect_to'] == "" || $_POST['effect_to'] == null) {
                if ($check_overlap[$i]['effect_to'] == '0000-00-00') {
                    if (strtotime($check_overlap[$i]['effect_from']) <= strtotime($_POST['effect_from']))
                        $overlap = 1;
                }else {
                    if ((strtotime($_POST['effect_from']) >= strtotime($check_overlap[$i]['effect_from'])) && (strtotime($_POST['effect_from']) <= strtotime($check_overlap[$i]['effect_to'])))
                        $overlap = 1;
                }
            }else {
                if (strtotime($_POST['effect_to']) < strtotime($_POST['effect_from'])) {
                    $great = 1;
                } else if ($check_overlap[$i]['effect_to'] == '0000-00-00') {
                    if (strtotime($check_overlap[$i]['effect_from']) <= strtotime($_POST['effect_from']))
                        $overlap = 1;
                    if (strtotime($check_overlap[$i]['effect_from']) <= strtotime($_POST['effect_to']))
                        $overlap = 1;
                }else {
                    if ((strtotime($_POST['effect_from']) >= strtotime($check_overlap[$i]['effect_from'])) && (strtotime($_POST['effect_from']) <= strtotime($check_overlap[$i]['effect_to'])))
                        $overlap = 1;
                    if ((strtotime($_POST['effect_to']) >= strtotime($check_overlap[$i]['effect_from'])) && (strtotime($_POST['effect_to']) <= strtotime($check_overlap[$i]['effect_to'])))
                        $overlap = 1;
                }
            }
        }
//        echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
        if ($great == 1)
            $messages->set_message('fail', 'effect_to_greater');
        else if ($overlap == 0) {
                $salary_details = $customer->getsalary_main($query_string[1]);
                $ob_inconvenient_timing = $obj_inc_timing->get_all_last_ob_inconvenient_timings();
                $jour_inconvenient_timing = $obj_inc_timing->get_all_last_jour_inconvenient_timings();
                
                foreach ($ob_inconvenient_timing as $key => $value) {
                    $ob_details[] = array(
                        'id'=>$value['id'],
                        'name'=>$value['name'],
                        'normal'=>trim($value['amount']),
                        'training_time'=>trim($value['sal_call_training']),
                        'complementary'=>trim($value['sal_complementary_oncall']),
                        'work_for_dismissal'=>trim($value['sal_dismissal_oncall']),
                        );
                }

                foreach ($jour_inconvenient_timing as $key => $value) {
                    $jour_details[] = array(
                        'id'=>$value['id'],
                        'name'=>$value['name'],
                        'oncall'=>floatval(trim($value['amount'])),
                        'call_training'=>floatval(trim($value['sal_call_training'])),
                        'complementary_oncall'=>floatval(trim($value['sal_complementary_oncall'])),
                        'more_oncall'  =>floatval(trim($value['sal_more_oncall'])),
                        'work_for_dismissal_oncall'=>floatval(trim($value['sal_dismissal_oncall'])),
                        );
                }
                // var_dump($salary_details);

            if ($customer->edit_salary_main($_POST['effect_from'], $_POST['effect_to'], $_POST['selected'])) {
                
                if(isset($_POST['ob_inconv']) && !empty($_POST['ob_inconv'])){
                    $ob_inconvenients = array();
                    foreach($_POST['ob_inconv'] as $ob_id => $ob_salary){
                        if(trim($ob_id) != ''){
                            $ob_inconvenients[] = array('id' => trim($ob_id), 
//                               'salary'                => floatval(trim($ob_salary)),
                                'normal'            => floatval(trim($ob_salary['normal'])),
                                'training'          => floatval(trim($ob_salary['training_time'])),
                                'complementary'     => floatval(trim($ob_salary['complementary'])),
                                'work_for_dismissal'=> floatval(trim($ob_salary['work_for_dismissal']))
                            );
                        }
                    }
                    
                    //Update ob inconvenients
//                    echo "<pre>".print_r($ob_inconvenients, 1)."</pre>";
                    if(!empty($ob_inconvenients)){
                        $ob_transaction_flag = TRUE;
                        $obj_inc_timing->begin_transaction();
                        foreach($ob_inconvenients as $ob_entry){
                            $ob_transaction_flag = $obj_inc_timing->inconvenient_timing_update_amount($ob_entry['id'], $ob_entry['normal'], $ob_entry['training'], $ob_entry['complementary'], $ob_entry['work_for_dismissal']);
                            if(!$ob_transaction_flag) break;
                        }
                        
                        if($ob_transaction_flag){
                            $obj_inc_timing->commit_transaction();
                            foreach ($ob_details as $key1 => $value1) {
                                foreach($value1 as $key2=> $value2){
                                    if($key2 == 'id'){

                                    }
                                    else if($key2 == 'name'){
                                        $ob_msg_head = '';
                                        $ob_msg_head .=  $value1['name'].' :'.'<br>' ;
                                    }
                                    else{
                                        // echo $_POST['ob_inconv'][$value1['id']][$key2].':';
                                        $ob_msg_body .= $value2 != $_POST['ob_inconv'][$value1['id']][$key2] ? ' * '.$smarty->translate[$key2]. ' : ' . $_POST['ob_inconv'][$value1['id']][$key2]. ($value2 != '' ? '('.$value2.')' : '' ).'<br>' : '';
                                    }
                                }
                                 $ob_msg .= $ob_msg_body != '' ? $ob_msg_head.$ob_msg_body : '';
                                 $ob_msg_body = '';
                            }
                        }
                        else $obj_inc_timing->rollback_transaction();
                    }
                }
                
                if(isset($_POST['jour_inconv']) && !empty($_POST['jour_inconv'])){
                    $jour_inconvenients = array();
                    foreach($_POST['jour_inconv'] as $jour_id => $jour_salaries){
                        if(trim($jour_id) != ''){
                            $jour_inconvenients[] = array('id' => trim($jour_id), 
                                'oncall'                => floatval(trim($jour_salaries['oncall'])),
                                'call_training'         => floatval(trim($jour_salaries['call_training'])),
                                'complementary_oncall'  => floatval(trim($jour_salaries['complementary_oncall'])),
                                'more_oncall'           => floatval(trim($jour_salaries['more_oncall'])),
                                'work_for_dismissal_oncall'=> floatval(trim($jour_salaries['work_for_dismissal_oncall'])));
                        }
                    }
                    
                    //Update jour inconvenients
                    if(!empty($jour_inconvenients)){
                        $jour_transaction_flag = TRUE;
                        $obj_inc_timing->begin_transaction();
                        foreach($jour_inconvenients as $jour_entry){
                            $jour_transaction_flag = $obj_inc_timing->inconvenient_timing_update_jour_salaries($jour_entry['id'], $jour_entry['oncall'], $jour_entry['call_training'], $jour_entry['complementary_oncall'], $jour_entry['more_oncall'], $jour_entry['work_for_dismissal_oncall']);
                            if(!$jour_transaction_flag) break;
                        }
                        
                        if($jour_transaction_flag) {
                            $obj_inc_timing->commit_transaction();
                            foreach ($jour_details as $key1 => $value1) {
                                foreach($value1 as $key2=> $value2){
                                    if($key2 == 'id'){
                                        
                                    }
                                    else if($key2 == 'name'){
                                        $jour_msg_head = '';
                                        $jour_msg_head .= $value1['name'].' :'.'<br>' ;
                                    }
                                    else{
                                        $jour_msg_body .= $value2 != $_POST['jour_inconv'][$value1['id']][$key2] ? ' * '.$smarty->translate[$key2]. ' : ' .$_POST['jour_inconv'][$value1['id']][$key2]. ($value2 != '' ? '('.$value2.')' : '' ).'<br>' : '';
                                    }
                                    // var_dump($jour_msg_head.$jour_msg_body);
                                   
                                }
                                $jour_msg .= $jour_msg_body != '' ? $jour_msg_head.$jour_msg_body : '';
                                $jour_msg_body = '';
                            }
                        }
                        else $obj_inc_timing->rollback_transaction();
                    }
                }

                $customer->commit_transaction();
                $messages->set_message('success', 'edit_sucess_global');


                /////////// sending mail to companys contact persons /////////////////
                // $msg  = $customer->insurance_personal != $salary_details['insurance'] ? $smarty->translate['global_setting_insurance_personal']. ' : ' .$customer->insurance_personal. ($salary_details['insurance'] != '' ? '('.$salary_details['insurance'].')' : '' ).'<br>' : '';
                 $msg     = $customer->insurance_personal != $salary_details['insurance'] ? $smarty->translate['global_setting_insurance_personal']. ' : ' .$customer->insurance_personal. ($salary_details['insurance'] != '' ? '('.$salary_details['insurance'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->normal != $salary_details['normal'] ? $smarty->translate['normal']. ' : ' .$customer->normal. ($salary_details['normal'] != '' ? '('.$salary_details['normal'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->travel != $salary_details['travel'] ? $smarty->translate['travel']. ' : ' .$customer->travel. ($salary_details['travel'] != '' ? '('.$salary_details['travel'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->break != $salary_details['break'] ? $smarty->translate['break']. ' : ' .$customer->break. ($salary_details['break'] != '' ? '('.$salary_details['break'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->overtime != $salary_details['overtime'] ? $smarty->translate['overtime']. ' : ' .$customer->overtime. ($salary_details['overtime'] != '' ? '('.$salary_details['overtime'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->qual_overtime != $salary_details['quality_overtime'] ? $smarty->translate['qual_overtime']. ' : ' .$customer->qual_overtime. ($salary_details['quality_overtime'] != '' ? '('.$salary_details['quality_overtime'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->more_time != $salary_details['more_time'] ? $smarty->translate['more_time']. ' : ' .$customer->more_time. ($salary_details['more_time'] != '' ? '('.$salary_details['more_time'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->some_other_time != $salary_details['some_other_time'] ? $smarty->translate['some_other_time']. ' : ' .$customer->some_other_time. ($salary_details['some_other_time'] != '' ? '('.$salary_details['some_other_time'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->training_time != $salary_details['training_time'] ? $smarty->translate['training_time']. ' : ' .$customer->training_time. ($salary_details['training_time'] != '' ? '('.$salary_details['training_time'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->voluntary != $salary_details['voluntary'] ? $smarty->translate['voluntary']. ' : ' .$customer->voluntary. ($salary_details['voluntary'] != '' ? '('.$salary_details['voluntary'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->complementary != $salary_details['complementary'] ? $smarty->translate['complementary']. ' : ' .$customer->complementary. ($salary_details['complementary'] != '' ? '('.$salary_details['complementary'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->standby != $salary_details['standby'] ? $smarty->translate['standby']. ' : ' .$customer->standby. ($salary_details['standby'] != '' ? '('.$salary_details['standby'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->work_for_dismissal != $salary_details['w_dismissal'] ? $smarty->translate['work_for_dismissal']. ' : ' .$customer->work_for_dismissal. ($salary_details['w_dismissal'] != '' ? '('.$salary_details['w_dismissal'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->holiday_big != $salary_details['holiday_big'] ? $smarty->translate['holiday_big']. ' : ' .$customer->holiday_big. ($salary_details['holiday_big'] != '' ? '('.$salary_details['holiday_big'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->holiday_big_oncall != $salary_details['holiday_big_oncall'] ? $smarty->translate['holiday_big'].' '.$smarty->translate['oncall']. ' : ' .$customer->holiday_big_oncall. ($salary_details['holiday_big_oncall'] != '' ? '('.$salary_details['holiday_big_oncall'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->holiday_red != $salary_details['holiday_red'] ? $smarty->translate['holiday']. ' : ' .$customer->holiday_red. ($salary_details['holiday_red'] != '' ? '('.$salary_details['holiday_red'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->holiday_red_oncall != $salary_details['holiday_red_oncall'] ? $smarty->translate['holiday'].' '.$smarty->translate['oncall']. ' : ' .$customer->holiday_red_oncall. ($salary_details['holiday_red_oncall'] != '' ? '('.$salary_details['holiday_red_oncall'].')' : '' ).'<br>' : '';
                 $msg    .= $customer->week_end_travel != $salary_details['week_end_travel'] ? $smarty->translate['week_end_travel']. ' : ' .$customer->week_end_travel. ($salary_details['week_end_travel'] != '' ? '('.$salary_details['week_end_travel'].')' : '' ).'<br>' : '';
                 if($salary_system == 3){
                    $msg    .= $customer->oncall != $salary_details['oncall'] ? $smarty->translate['oncall']. ' : ' .$customer->oncall. ($salary_details['oncall'] != '' ? '('.$salary_details['oncall'].')' : '' ).'<br>' : '';
                    $msg    .= $customer->call_training != $salary_details['call_training'] ? $smarty->translate['call_training']. ' : ' .$customer->call_training. ($salary_details['call_training'] != '' ? '('.$salary_details['call_training'].')' : '' ).'<br>' : '';
                    $msg    .= $customer->complementary_oncall != $salary_details['complementary_oncall'] ? $smarty->translate['complementary_oncall']. ' : ' .$customer->complementary_oncall. ($salary_details['complementary_oncall'] != '' ? '('.$salary_details['complementary_oncall'].')' : '' ).'<br>' : '';
                    $msg    .= $customer->more_oncall != $salary_details['more_oncall'] ? $smarty->translate['more_oncall']. ' : ' .$customer->more_oncall. ($salary_details['more_oncall'] != '' ? '('.$salary_details['more_oncall'].')' : '' ).'<br>' : '';
                    $msg    .= $customer->work_for_dismissal_oncall != $salary_details['w_dismissal_oncall'] ? $smarty->translate['work_for_dismissal_oncall']. ' : ' .$customer->work_for_dismissal_oncall. ($salary_details['w_dismissal_oncall'] != '' ? '('.$salary_details['w_dismissal_oncall'].')' : '' ).'<br>' : '';
                 }
                
                $msg.$ob_msg.$jour_msg !='' ? $msg_header = $smarty->translate['global_setting'].' '.$smarty->translate['effect_from']. ' : '.$salary_details['effect_from'].' '.$smarty->translate['effect_to']. ' : '.$salary_details['effect_to'].'<br><br>' : $msg_header = '' ; 
                
                $msg = $msg_header.$msg.$ob_msg.$jour_msg;
                $mail_subject     = $smarty->translate['global_setting'];

                if($msg){
                    $mailer = new SimpleMail($mail_subject,$msg);
                    $mailer->addSender("cirrus-noreplay@time2view.se");
                    if($company_detail['mail_send_to_contact_person'] == 1){
                        if($company_detail['contact_person2_email'] != '')
                                $mailer->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
                        else if($company_detail['contact_person1_email'] != '')
                                $mailer->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
                    }
                    $mailer->send();
                }
                // echo "<pre>".print_r($msg,1)."</pre>";
                // echo "<pre>".print_r($_POST['jour_inconv'],1)."</pre>";
                // echo "<pre>".print_r($jour_inconvenients,1)."</pre>";
                
                // var_dump($jour_details);
            } else {
                $messages->set_message('fail', 'effect_to_greater');
                $customer->rollback_transaction();
            }
        } else {
            $messages->set_message('fail', 'overlap_with_previous');
            $customer->rollback_transaction();
        }
    }
    $smarty->assign('salary_main', $customer->getsalary_main($query_string[1]));
}
else {
    if (!empty($_POST)) {
        $customer->insurance_personal = str_replace(",", ".", $_POST['insurance']);
        $customer->normal = str_replace(",", ".", $_POST['normal']);
        $customer->travel = str_replace(",", ".", $_POST['travel']);
        $customer->break = str_replace(",", ".", $_POST['break']);
        $customer->oncall = str_replace(",", ".", $_POST['oncall']);
        $customer->overtime = str_replace(",", ".", $_POST['overtime']);
        $customer->qual_overtime = str_replace(",", ".", $_POST['qual_overtime']);
        $customer->more_time = str_replace(",", ".", $_POST['more_time']);
        $customer->some_other_time = str_replace(",", ".", $_POST['some_other_time']);
        $customer->training_time = str_replace(",", ".", $_POST['training_time']);
        $customer->call_training = str_replace(",", ".", $_POST['call_training']);
        $customer->personal_meeting = str_replace(",", ".", $_POST['personal_meeting']);
        $customer->voluntary = str_replace(",", ".", $_POST['voluntary']);
        $customer->complementary = str_replace(",", ".", $_POST['complementary']);
        $customer->complementary_oncall = str_replace(",", ".", $_POST['complementary_oncall']);
        $customer->more_oncall = str_replace(",", ".", $_POST['more_oncall']);
        $customer->standby = str_replace(",", ".", $_POST['standby']);
        $customer->work_for_dismissal = str_replace(",", ".", $_POST['work_for_dismissal']);
        $customer->work_for_dismissal_oncall = str_replace(",", ".", $_POST['work_for_dismissal_oncall']);

        $customer->holiday_big = str_replace(",", ".", $_POST['holiday_big']);
        $customer->holiday_big_oncall = str_replace(",", ".", $_POST['holiday_big_oncall']);
        $customer->holiday_red = str_replace(",", ".", $_POST['holiday_red']);
        $customer->holiday_red_oncall = str_replace(",", ".", $_POST['holiday_red_oncall']);
        $customer->week_end_travel = str_replace(",", ".", $_POST['wkend_travel']);
//        $customer->start_day = $_POST['start_day'].$dona->time_to_sixty($_POST['start_time']);
        if (isset($_POST['action']) && $_POST['action'] == 'edit') {
//            $customer->AddGlobalSetting_new();
            $customer->begin_transaction();
            //$customer->edit_default_start_time_and_day_company();
            if ($customer->check_overlap_edit($_POST['effect_from'], $_POST['effect_to'], $_POST['selected'])) {
                if ($customer->edit_salary_main($_POST['effect_from'], $_POST['effect_to'], $_POST['selected'])) {
                    
                    if(isset($_POST['ob_inconv']) && !empty($_POST['ob_inconv'])){
                        $ob_inconvenients = array();
                        foreach($_POST['ob_inconv'] as $ob_id => $ob_salary){
                            if(trim($ob_id) != ''){
//                                $ob_inconvenients[] = array('id' => trim($ob_id), 'salary' => floatval(trim($ob_salary)));
                                $ob_inconvenients[] = array('id' => trim($ob_id), 
                                    'normal'            => floatval(trim($ob_salary['normal'])),
                                    'training'          => floatval(trim($ob_salary['training_time'])),
                                    'complementary'     => floatval(trim($ob_salary['complementary'])),
                                    'work_for_dismissal'=> floatval(trim($ob_salary['work_for_dismissal']))
                                );
                            }
                        }

                        //Update ob inconvenients
    //                    echo "<pre>".print_r($ob_inconvenients, 1)."</pre>";
                        if(!empty($ob_inconvenients)){
                            $ob_transaction_flag = TRUE;
                            $obj_inc_timing->begin_transaction();
                            foreach($ob_inconvenients as $ob_entry){
//                                $ob_transaction_flag = $obj_inc_timing->inconvenient_timing_update_amount($ob_entry['id'], $ob_entry['salary']);
                                $ob_transaction_flag = $obj_inc_timing->inconvenient_timing_update_amount($ob_entry['id'], $ob_entry['normal'], $ob_entry['training'], $ob_entry['complementary'], $ob_entry['work_for_dismissal']);
                                if(!$ob_transaction_flag) break;
                            }

                            if($ob_transaction_flag) $obj_inc_timing->commit_transaction();
                            else $obj_inc_timing->rollback_transaction();
                        }
                    }
                    
                    if(isset($_POST['jour_inconv']) && !empty($_POST['jour_inconv'])){
                        $jour_inconvenients = array();
                        foreach($_POST['jour_inconv'] as $jour_id => $jour_salaries){
                            if(trim($jour_id) != ''){
                                $jour_inconvenients[] = array('id' => trim($jour_id), 
                                    'oncall'                => floatval(trim($jour_salaries['oncall'])),
                                    'call_training'         => floatval(trim($jour_salaries['call_training'])),
                                    'complementary_oncall'  => floatval(trim($jour_salaries['complementary_oncall'])),
                                    'more_oncall'           => floatval(trim($jour_salaries['more_oncall'])),
                                    'work_for_dismissal_oncall'=> floatval(trim($jour_salaries['work_for_dismissal_oncall'])));
                            }
                        }

    //                    echo "<pre>".print_r($jour_inconvenients, 1)."</pre>";
                        //Update jour inconvenients
                        if(!empty($jour_inconvenients)){
                            $jour_transaction_flag = TRUE;
                            $obj_inc_timing->begin_transaction();
                            foreach($jour_inconvenients as $jour_entry){
                                $jour_transaction_flag = $obj_inc_timing->inconvenient_timing_update_jour_salaries($jour_entry['id'], $jour_entry['oncall'], $jour_entry['call_training'], $jour_entry['complementary_oncall'], $jour_entry['more_oncall'], $jour_entry['work_for_dismissal_oncall']);
                                if(!$jour_transaction_flag) break;
                            }

                            if($jour_transaction_flag) $obj_inc_timing->commit_transaction();
                            else $obj_inc_timing->rollback_transaction();
                        }
                    }

                    $customer->commit_transaction();
                } else {
                    $messages->set_message('fail', 'edit_failed_global');
                    $customer->rollback_transaction();
                }
            } else {
                $messages->set_message('fail', 'overlap_with_previous');
                $customer->rollback_transaction();
            }
        } else {
            $customer->begin_transaction();
//            $customer->edit_default_start_time_and_day_company();
            $overlap = 0;
            if ($customer->give_effect_to_old_data($_POST['effect_from'])) {
                $data = $customer->check_overlap();
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i]['effect_to'] == "0000-00-00") {
                        if ($_POST['effect_from'] <= $data[$i]['effect_from']) {
                            $overlap = 1;
                        }
                    } else {
                        if (($_POST['effect_from'] >= $data[$i]['effect_from']) && ($_POST['effect_from'] <= $data[$i]['effect_to'])) {
                            $overlap = 1;
                        }
                    }
                }
                if ($overlap == 0) {
                    if ($customer->add_new_salary_main($_POST['effect_from'])) {
                        $messages->set_message('success', 'salary_adding_success_normal');
                        $customer->commit_transaction();
                        header("Location: " . $smarty->url . "globalsettings/get/" . $customer->salary_main_last_id . "/");
                        exit();
                    } else {
                        $messages->set_message('fail', 'adding_failed_global');
                        $customer->rollback_transaction();
                    }
                } else {
                    $messages->set_message('fail', 'overlap_with_previous');
                    $customer->rollback_transaction();
                }
            }
        }
        $sal_main = $customer->getsalary_main();
        if ($sal_main) {
            header("Location: " . $smarty->url . "globalsettings/get/" . $sal_main['id'] . "/");
        }
    }
}

if ($query_string[0] == 'add') {
    $smarty->assign('action', 'add');
    $smarty->assign('salary_main_dates', $customer->get_salary_main_dates());
} else {
    $smarty->assign('salary_main_dates', $customer->get_salary_main_dates());
    $GlobalSetting = $customer->GetGlobalSetting();
    $timediff = $GlobalSetting[0]['schedule_time_diff'];
    $maxhours = $GlobalSetting[0]['emp_max_hours'];
    $maxhours_per_week = $GlobalSetting[0]['maxhours_per_week'];
    $max_overtime = $GlobalSetting[0]['max_overtime'];
    $insurance_personal = $GlobalSetting[0]['insurance_personal'];
    $insurance_subsitute = $GlobalSetting[0]['insurance_subsitute'];
    $on_call = $GlobalSetting[0]['on_call'];
    $inconvinient_week_holiday = $GlobalSetting[0]['inconvinient_week_holiday'];
    $inconvinient_evening = $GlobalSetting[0]['inconvinient_evening'];
    $inconvinient_night = $GlobalSetting[0]['inconvinient_night'];
    $inconvinient_holiday = $GlobalSetting[0]['inconvinient_holiday'];
    $oncall_holiday = $GlobalSetting[0]['on_call_holiday'];
    $oncall_bigholiday = $GlobalSetting[0]['on_call_bigholiday'];


    $smarty->assign('timediff', $timediff);
    $smarty->assign('maxhours', $maxhours);
    $smarty->assign('maxhours_per_week', $maxhours_per_week);
    $smarty->assign('max_overtime', $max_overtime);
    $smarty->assign('maxhours_per_week', $maxhours_per_week);
    $smarty->assign('insurance_personal', $insurance_personal);
    $smarty->assign('insurance_subsitute', $insurance_subsitute);
    $smarty->assign('on_call', $on_call);
    $smarty->assign('inconvinient_week_holiday', $inconvinient_week_holiday);
    $smarty->assign('inconvinient_evening', $inconvinient_evening);
    $smarty->assign('inconvinient_night', $inconvinient_night);
    $smarty->assign('inconvinient_holiday', $inconvinient_holiday);
    $smarty->assign('oncall_holiday', $oncall_holiday);
    $smarty->assign('oncall_bigholiday', $oncall_bigholiday);
}

//$inconvenient_timings = $obj_inc_timing->get_all_inconvenient_timing_list();
$ob_inconvenient_timings = $obj_inc_timing->get_all_last_ob_inconvenient_timings();
$smarty->assign('ob_inconvenient_timings', $ob_inconvenient_timings);
// echo "<pre>".print_r($ob_inconvenient_timings, 1)."</pre>"; exit();

$jour_inconvenient_timings = $obj_inc_timing->get_all_last_jour_inconvenient_timings();
$smarty->assign('jour_inconvenient_timings', $jour_inconvenient_timings);
//echo "<pre>".print_r($jour_inconvenient_timings, 1)."</pre>"; exit();

$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|globalsetting.tpl');
?>