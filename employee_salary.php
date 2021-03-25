<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/company.php');
require_once('class/user.php');
require_once('class/general.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array( "messages.xml", "button.xml","gdschema.xml","user.xml", 'reports.xml'));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$employee = new employee();
$company = new company();
$user = new user();
$messages = new message();
$obj_general = new general();

$username = "";
$query_string = explode("&",$_SERVER['QUERY_STRING']);
$smarty->assign('hides',$query_string[3]);

$company_detail = $company->get_company_detail($_SESSION['company_id']);
$salary_system = $company_detail['salary_system'];
$smarty->assign('salary_system',$salary_system);
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_salary'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

if($query_string[1] == 'edit'){
    $smarty->assign('action','edit');
}else if($query_string[1] == 'new'){
    $smarty->assign('action','add');
}else{
    if($query_string[1] == 'clone'){
        
        if($query_string[3] == 'n'){
            $smarty->assign('clone','clone_n');
            $dates = $employee->get_normal_effect_from_and_to($query_string[0]);
            $today = strtotime(date("Y-m-d"));
            $large = strtotime($dates['e_from']);
            if($large >= $today){
                $smarty->assign('effect_from_normal',  date('Y-m-d',strtotime($dates['e_from'] . "+1 day")));
            }else{
                 $smarty->assign('effect_from_normal',  date('Y-m-d'));
            }
        }elseif($query_string[3] == 'i'){
                $smarty->assign('clone','clone_i');
                $dates = $employee->get_inconvenient_effect_from_and_to($query_string[0]);
                $today = strtotime(date("Y-m-d"));
                $large = strtotime($dates['e_from']);
                if($large >= $today){
                    $smarty->assign('effect_from',  date('Y-m-d',strtotime($dates['e_from'] . "+1 day")));
                }else{
                     $smarty->assign('effect_from',  date('Y-m-d'));
                }
        }
    }
    $smarty->assign('action','clone');
}
if($_SERVER['QUERY_STRING']){
    $username = $_SERVER['QUERY_STRING'];
    if($employee->is_employee_accessible($query_string[0]) || $employee->is_employee_inactive_accessible($query_string[0])){
        $smarty->assign('access_flag',1);
    }else{
        $smarty->assign('access_flag',0);
    }
}else
    $smarty->assign('access_flag',1);

if(isset($_POST['user_id']) && $_POST['user_id'] != ""){
    $group_ids = $_POST['group_id'];
    $saved_id = $_POST['saved_id'];
    $amount_inconv = $_POST['amount'];
    
    if($_POST['action'] == 'add'){
        $add = 0;
        // echo '<pre>'.print_r($_POST, 1).'</pre>'; 
        if($_POST['effect_from'] && $_POST['effect_from'] != ''){
            $employee->begin_transaction();
            
            $counts = 0;
            $breaks = 0;
            for($i=0;$i<count($group_ids);$i++){
                $new_effect_from  = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $_POST['effect_from']) ) ));
                
                $employee->inconv_group_id = $group_ids[$i];
                $employee->effect_from_inconv = $_POST['effect_from'];
                $employee->effect_to_inconv = $_POST['effect_to'];
                $employee->amount_inconv =  trim($amount_inconv[$i]) != '' ?  str_replace(",", ".", $amount_inconv[$i]) : NULL;
                
                $check_overlap = $employee->check_overlapp_inconvenient_salary($query_string[0],$_POST['effect_from'],$group_ids[$i]);
                for($j=0;$j<count($check_overlap);$j++){
                    if($check_overlap[$j]['effect_to'] == '0000-00-00'){
                        if($_POST['effect_from'] == $check_overlap[$j]['effect_from']){
                            $breaks = 1;
                            break;
                        }
                    }else{
                        if($_POST['effect_from'] >= $check_overlap[$j]['effect_from'] && $_POST['effect_from'] <= $check_overlap[$j]['effect_to']){
                            $breaks = 1;
                            break;
                        }
                    }
                }
                if($breaks == 1)
                    break;
                $employee->give_effect_to_old_salary($query_string[0],$new_effect_from,$group_ids[$i]);
                if($group_ids[$i] == $group_ids[$i+1]){
                    $employee->sal_call_training = trim($amount_inconv[$i+1]) != '' ?  str_replace(",", ".", $amount_inconv[$i+1]) : NULL;
                    $employee->sal_complementary_oncall = trim($amount_inconv[$i+2]) != '' ?  str_replace(",", ".", $amount_inconv[$i+2]) : NULL;
                    $employee->sal_more_oncall = trim($amount_inconv[$i+3]) != '' ?  str_replace(",", ".", $amount_inconv[$i+3]) : NULL;
                    $employee->sal_dismissal_oncall = trim($amount_inconv[$i+4]) != '' ?  str_replace(",", ".", $amount_inconv[$i+4]) : NULL;
                    $i = $i+4;
                    if($employee->add_inconvenient_salary($query_string[0]))
                        $counts = $counts + 5;
                }else{
                    $employee->sal_call_training = NULL;
                    $employee->sal_complementary_oncall = NULL;
                    $employee->sal_more_oncall = NULL;
                    $employee->sal_dismissal_oncall = NULL;
                    if($employee->add_inconvenient_salary($query_string[0]))
                        $counts++;
                }
                
            }
            if($counts == count($group_ids)){
                $employee->commit_transaction();
                $messages->set_message('success', 'salary_adding_success_normal');
                if($query_string[2] != "both"){
                    header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
                    exit();
                }
            }else{
                $employee->rollback_transaction();
                $messages->set_message('fail', 'salary_adding_failed_inconv');
            }
        }
        if($_POST['effect_from_normal'] && $_POST['effect_from_normal'] != ""){
            $employee->begin_transaction();
            $new_effect_from  = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $_POST['effect_from_normal']) ) ));
            
            $employee->effect_from_normal = $_POST['effect_from_normal'];
            $employee->effect_to_normal = $_POST['effect_to_normal'];
            $employee->normal = trim($_POST['normal']) != '' ?  str_replace(",", ".", $_POST['normal']) : NULL;
            $employee->travel = trim($_POST['travel']) != '' ?  str_replace(",", ".", $_POST['travel']) : NULL;
            $employee->break = trim($_POST['break']) != '' ?  str_replace(",", ".", $_POST['break']) : NULL;
            $employee->overtime = trim($_POST['overtime']) != '' ?  str_replace(",", ".", $_POST['overtime']) : NULL;
            $employee->quality_overtime = trim($_POST['qual_overtime']) != '' ?  str_replace(",", ".", $_POST['qual_overtime']) : NULL;
            $employee->on_call = trim($_POST['oncall']) != '' ?  str_replace(",", ".", $_POST['oncall']) : NULL;
            $employee->more_time = trim($_POST['more_time']) != '' ?  str_replace(",", ".", $_POST['more_time']) : NULL;
            $employee->some_other_time = trim($_POST['some_other_time']) != '' ?  str_replace(",", ".", $_POST['some_other_time']) : NULL;
            $employee->training_time = trim($_POST['training_time']) != '' ?  str_replace(",", ".", $_POST['training_time']) : NULL;
            $employee->call_training = trim($_POST['call_training']) != '' ?  str_replace(",", ".", $_POST['call_training']) : NULL;
            $employee->personal_meeting = trim($_POST['personal_meeting']) != '' ?  str_replace(",", ".", $_POST['personal_meeting']) : NULL;
            $employee->voluntary = trim($_POST['voluntary']) != '' ?  str_replace(",", ".",$_POST['voluntary']) : NULL;
            $employee->complementary = trim($_POST['complementary']) != '' ?  str_replace(",", ".",$_POST['complementary']) : NULL;
            $employee->complementary_oncall = trim($_POST['complementary_oncall']) != '' ?  str_replace(",", ".",$_POST['complementary_oncall']) : NULL;
            $employee->more_oncall = trim($_POST['more_oncall']) != '' ?  str_replace(",", ".",$_POST['more_oncall']) : NULL;
            $employee->standby = trim($_POST['standby']) != '' ?  str_replace(",", ".",$_POST['standby']) : NULL;
            $employee->work_for_dismissal = trim($_POST['work_for_dismissal']) != '' ?  str_replace(",", ".",$_POST['work_for_dismissal']) : NULL;
            $employee->work_for_dismissal_oncall = trim($_POST['work_for_dismissal_oncall']) != '' ?  str_replace(",", ".",$_POST['work_for_dismissal_oncall']) : NULL;
        
            $employee->holiday_big = trim($_POST['holiday_big']) != '' ?  str_replace(",", ".", $_POST['holiday_big']) : NULL;
            $employee->holiday_big_oncall = trim($_POST['holiday_big_oncall']) != '' ?  str_replace(",", ".", $_POST['holiday_big_oncall']) : NULL;
            $employee->holiday_red = trim($_POST['holiday_red']) != '' ?  str_replace(",", ".", $_POST['holiday_red']) : NULL;
            $employee->holiday_red_oncall = trim($_POST['holiday_red_oncall']) != '' ?  str_replace(",", ".", $_POST['holiday_red_oncall']) : NULL;
            $employee->insurance = trim($_POST['insurance']) != '' ?  str_replace(",", ".", $_POST['insurance']) : NULL;
            $employee->week_end_travel = trim($_POST['wkend_travel']) != '' ?  str_replace(",", ".", $_POST['wkend_travel']) : NULL;
            $check_normal_overlap = $employee->check_overlapp_normal_salary($query_string[0]);
            $overlapped = 0;
            for($j=0;$j<count($check_normal_overlap);$j++){
                if($check_normal_overlap[$j]['effect_to'] == '0000-00-00'){
                        if($_POST['effect_from_normal'] <= $check_normal_overlap[$j]['effect_from']){
                            $overlapped = 1;
                        }
                    }else{
                        if($_POST['effect_from_normal'] >= $check_normal_overlap[$j]['effect_from'] && $_POST['effect_from_normal'] <= $check_normal_overlap[$j]['effect_to']){
                           $overlapped = 1;
                        }
                    }
            }
            // echo '<pre>'.print_r($check_normal_overlap, 1).'</pre>';
            if($overlapped == 0){
                $employee->give_effect_to_old_salary_normal($query_string[0],$new_effect_from);
                if($employee->add_normal_time_salary($query_string[0])){
                    $employee->commit_transaction();
                    $add = 1;
                    $messages->set_message('success', 'salary_adding_success_normal');
            // var_dump($overlapped); exit();
                    if($query_string[2] != "both"){
                        header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
                        exit();
                    }
                }else{
                    // echo '<pre>'.print_r($employee->query_error_details, 1).'</pre>'; exit();
                    $employee->rollback_transaction();
                    $messages->set_message('fail', 'salary_adding_failed_normal');
                }
            }else{
                $employee->rollback_transaction();
                $messages->set_message('fail', 'overlap_with_previous');
            }
        }
        if($_POST['salary_per_month'] && $_POST['salary_per_month'] != ""){
            $employee->salary_per_month = str_replace(",", ".", $_POST['salary_per_month']);
            $employee->salary_per_hour = 0;
            $employee->begin_transaction();
            if($employee->employee_salary_monthly($query_string[0],$_POST['effect_from_monthly'])){
                if($_POST['is_monthly_sal'] == 1){
                    $employee->update_employee_monthly_salary($query_string[0],1);
                    $employee->commit_transaction();
                    $messages->set_message('success', 'salary_adding_success_normal');
                    
                }else{
                    $employee->update_employee_monthly_salary($query_string[0],0); 
                    $employee->commit_transaction();
                    $messages->set_message('success', 'salary_adding_success_normal');
                } 
                if($query_string[2] != "both"){
                    header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
                    exit();
                }
            }else
                $employee->rollback_transaction();
        }
    }
    elseif($_POST['action'] == 'edit'){
        if($query_string[3] == 'n'){
            $employee->effect_from_normal = $_POST['effect_from_normal'];
            $employee->effect_to_normal = $_POST['effect_to_normal'];
            $employee->normal = trim($_POST['normal']) != '' ?  str_replace(",", ".", $_POST['normal']) : NULL;
            $employee->travel = trim($_POST['travel']) != '' ?  str_replace(",", ".", $_POST['travel']) : NULL;
            $employee->break = trim($_POST['break']) != '' ?  str_replace(",", ".", $_POST['break']) : NULL;
            $employee->overtime = trim($_POST['overtime']) != '' ?  str_replace(",", ".", $_POST['overtime']) : NULL;
            $employee->quality_overtime = trim($_POST['qual_overtime']) != '' ?  str_replace(",", ".", $_POST['qual_overtime']) : NULL;
            $employee->on_call = trim($_POST['oncall']) != '' ?  str_replace(",", ".", $_POST['oncall']) : NULL;
            $employee->more_time = trim($_POST['more_time']) != '' ?  str_replace(",", ".", $_POST['more_time']) : NULL;
            $employee->some_other_time = trim($_POST['some_other_time']) != '' ?  str_replace(",", ".", $_POST['some_other_time']) : NULL;
            $employee->training_time = trim($_POST['training_time']) != '' ?  str_replace(",", ".", $_POST['training_time']) : NULL;
            $employee->call_training = trim($_POST['call_training']) != '' ?  str_replace(",", ".", $_POST['call_training']) : NULL;
            $employee->personal_meeting = trim($_POST['personal_meeting']) != '' ?  str_replace(",", ".", $_POST['personal_meeting']) : NULL;
            $employee->voluntary = trim($_POST['voluntary']) != '' ?  str_replace(",", ".",$_POST['voluntary']) : NULL;
            $employee->complementary = trim($_POST['complementary']) != '' ?  str_replace(",", ".",$_POST['complementary']) : NULL;
            $employee->complementary_oncall = trim($_POST['complementary_oncall']) != '' ?  str_replace(",", ".",$_POST['complementary_oncall']) : NULL;
            $employee->more_oncall = trim($_POST['more_oncall']) != '' ?  str_replace(",", ".",$_POST['more_oncall']) : NULL;
            $employee->standby = trim($_POST['standby']) != '' ?  str_replace(",", ".",$_POST['standby']) : NULL;
            $employee->work_for_dismissal = trim($_POST['work_for_dismissal']) != '' ?  str_replace(",", ".",$_POST['work_for_dismissal']) : NULL;
            $employee->work_for_dismissal_oncall = trim($_POST['work_for_dismissal_oncall']) != '' ?  str_replace(",", ".",$_POST['work_for_dismissal_oncall']) : NULL;
            
            $employee->holiday_big = trim($_POST['holiday_big']) != '' ?  str_replace(",", ".", $_POST['holiday_big']) : NULL;
            $employee->holiday_big_oncall = trim($_POST['holiday_big_oncall']) != '' ?  str_replace(",", ".", $_POST['holiday_big_oncall']) : NULL;
            $employee->holiday_red = trim($_POST['holiday_red']) != '' ?  str_replace(",", ".", $_POST['holiday_red']) : NULL;
            $employee->holiday_red_oncall = trim($_POST['holiday_red_oncall']) != '' ?  str_replace(",", ".", $_POST['holiday_red_oncall']) : NULL;
            $employee->insurance = trim($_POST['insurance']) != '' ?  str_replace(",", ".", $_POST['insurance']) : NULL;
            $employee->week_end_travel = trim($_POST['wkend_travel']) != '' ?  str_replace(",", ".", $_POST['wkend_travel']) : NULL;
            $check_normal_overlap = $employee->check_overlapp_normal_salary($query_string[0],$query_string[2]);
            for($i=0;$i<count($check_normal_overlap);$i++){
                if($_POST['effect_to_normal'] == "0000-00-00" || $_POST['effect_to_normal'] == '' || $_POST['effect_to_normal'] == null){
                    if($check_normal_overlap[$i]['effect_to'] == '0000-00-00'){
                        if($check_normal_overlap[$i]['effect_from'] <= $_POST['effect_from_normal']){
                            break;
                        }
                    }else{
                        if(($_POST['effect_from_normal'] >= $check_normal_overlap[$i]['effect_from'] && $_POST['effect_from_normal'] <= $check_normal_overlap[$i]['effect_to']) || ($_POST['effect_to_normal'] >= $check_normal_overlap[$i]['effect_from'] && $_POST['effect_to_normal'] <= $check_normal_overlap[$i]['effect_to'])){
                            break;
                        }
                    }
                }
            } 
            if($i == count($check_normal_overlap)){
                if($employee->edit_normal_salary($query_string[0], $query_string[2]))
                    $messages->set_message('success', 'salary_editing_success_normal');
            }else
                $messages->set_message('fail', 'overlap_with_previous');
            
        }
        elseif($query_string[3] == 'i'){
            //$inconv_groups = $employee->ids_groupids_inconvenient_salary($query_string[2]);
            $amount_inconv = $_POST['amount'];
            //echo "<pre>".print_r($amount_inconv, 1)."</pre>"; 
            //echo "<pre>_POST".print_r($_POST, 1)."</pre>";
            //echo "<pre>".print_r($inconv_groups, 1)."</pre>";
            //exit();
            $count = 0;
            $break_point = 0;
            $k=0;
            $transaction_flag = TRUE;
            $employee->begin_transaction();
                //echo "inconv_groups<pre>".print_r($inconv_groups, 1)."</pre>";
                //echo "group_ids<pre>".print_r($group_ids, 1)."</pre>";
            for($i=0;$i<count($group_ids);$i++){
                //$employee->inconv_group_id = $inconv_groups[$i]['inconvenient_group_id'];
                $employee->inconv_group_id = $group_ids[$i];
                $employee->effect_from_inconv = $_POST['effect_from'];
                $employee->amount_inconv =  trim($amount_inconv[$i]) != '' ?  str_replace(",", ".", $amount_inconv[$i]) : NULL;
                if($_POST['effect_to'] == ''){
                   $_POST['effect_to'] = '0000-00-00'; 
                }
                $employee->effect_to_inconv = $_POST['effect_to'];
                //$inconv_overlap = $employee->check_overlapp_inconvenient_salary($query_string[0],$group_ids[$i],$inconv_groups[$k]['ids']);
                $inconv_overlap = $employee->check_overlapp_inconvenient_salary($query_string[0],$group_ids[$i],$saved_id[$i]);
                //echo "<pre>".print_r(array($query_string[0],$group_ids[$i],$saved_id[$i]), 1)."</pre>";
                //echo "<pre>inconv_overlap ".print_r($inconv_overlap, 1)."</pre>";  exit();
                //echo "<pre>".print_r($_POST, 1)."</pre>";
                for($j=0;$j<count($inconv_overlap);$j++){
                    if($_POST['effect_to'] == '0000-00-00' || $_POST['effect_to'] == '' || $_POST['effect_to'] == null){
                        if($inconv_overlap[$j]['effect_to'] == '0000-00-00'){
                            if($inconv_overlap[$j]['effect_from'] <= $_POST['effect_from']){
                                $break_point = 1;
                                break;
                            }
                        }
                    }else{
                        if(($_POST['effect_from'] >= $inconv_overlap[$j]['effect_from'] && $_POST['effect_from'] <= $inconv_overlap[$j]['effect_to']) || ($_POST['effect_to'] >= $inconv_overlap[$j]['effect_from'] && $_POST['effect_to'] <= $inconv_overlap[$j]['effect_to'])){
                            $break_point = 1;
                            break;
                        }
                    }
                }
                if($break_point == 1){
                    break;
                }
                if($group_ids[$i] == $group_ids[$i+1]){
                    $employee->sal_call_training = trim($amount_inconv[$i+1]) != '' ?  str_replace(",", ".", $amount_inconv[$i+1]) : NULL;
                    $employee->sal_complementary_oncall = trim($amount_inconv[$i+2]) != '' ?  str_replace(",", ".", $amount_inconv[$i+2]) : NULL;
                    $employee->sal_more_oncall = trim($amount_inconv[$i+3]) != '' ?  str_replace(",", ".", $amount_inconv[$i+3]) : NULL;
                    $employee->sal_dismissal_oncall = trim($amount_inconv[$i+4]) != '' ?  str_replace(",", ".", $amount_inconv[$i+4]) : NULL;
                    $i = $i+4;
                    //$employee->edit_inconvenient_salary($inconv_groups[$k]['ids']);
                    if($saved_id[$i] != '')
                        $transaction_flag = $employee->edit_inconvenient_salary($saved_id[$i]);
                    else {
                        //get sample data of this group set to get 'clone_from' and 'increment_percentage'
                        $model_data_from_groupset = $employee->get_emp_inconvenient_salary_by_id($saved_id[0]);
                        $transaction_flag = $employee->add_inconvenient_salary($query_string[0], $model_data_from_groupset['clone_from'], $model_data_from_groupset['increment_percentage'], $employee->effect_to_inconv);
                    }
                    $count = $count + 5;
                    $k++;
                }else{
                    $employee->sal_call_training = NULL;
                    $employee->sal_complementary_oncall = NULL;
                    $employee->sal_more_oncall = NULL;
                    $employee->sal_dismissal_oncall = NULL;
                    //$employee->edit_inconvenient_salary($inconv_groups[$k]['ids']);
                    if($saved_id[$i] != '')
                        $transaction_flag = $employee->edit_inconvenient_salary($saved_id[$i]);
                    else {
                        //get sample data of this group set to get 'clone_from' and 'increment_percentage'
                        $model_data_from_groupset = $employee->get_emp_inconvenient_salary_by_id($saved_id[0]);
                        $transaction_flag = $employee->add_inconvenient_salary($query_string[0], $model_data_from_groupset['clone_from'], $model_data_from_groupset['increment_percentage'], $employee->effect_to_inconv);
                    }
                    $count++;
                    $k++;
                }
                
                if(!$transaction_flag){
                    break;
                }
                //echo "<pre>".print_r(array($employee->amount_inconv, $employee->sal_call_training, $employee->sal_complementary_oncall, $employee->sal_more_oncall, $inconv_groups[$k]['ids']), 1)."</pre>"; exit();
                //$employee->edit_inconvenient_salary($inconv_groups[$i]['ids']);
            }
            if($i == $count && $break_point != 1 && $transaction_flag){
                $employee->commit_transaction();
                $messages->set_message('success', 'salary_editing_success_normal');
            }
            else if(!$transaction_flag){
                $employee->rollback_transaction();
                $messages->set_message('fail', 'salary_editing_normal_fail');
            }
            else{
                $employee->rollback_transaction();
                $messages->set_message('fail', 'overlap_with_previous');
            }
            /*for($i=0;$i<count($group_ids);$i++){
                $employee->inconv_group_id = $group_ids[$i];
                $employee->effect_from_inconv = $_POST['effect_from'];
                $employee->effect_to_inconv = $_POST['effect_to'];
                $employee->amount_inconv =  $amount_inconv[$i];
                if($employee->check_overlapp_inconvenient_salary($query_string[0],$_POST['effect_from'],$_POST['effect_to'],$group_ids[$i])){
                    if($employee->edit_inconvenient_salary($query_string[0],$query_string[2])){
                        $counts++;
                    }
                }
            }*/
            
        }
        else if($query_string[3] == 'm'){

            if($_POST['salary_per_month'] && $_POST['salary_per_month'] != ""){
                if(isset($_POST['effect_to_monthly'])){
                    $effect_to = $_POST['effect_to_monthly'];
                }else{
                    $effect_to = null;
                }
                $employee->salary_per_month = str_replace(",", ".", $_POST['salary_per_month']);
                $employee->salary_per_hour = 0;
                $ids = $query_string[2];
                $employee->begin_transaction();
                if($employee->edit_monthly_sal($query_string[0], $_POST['effect_from_monthly'], $effect_to, $ids)){
                    if($_POST['is_monthly_sal'] == 1){
                        $employee->update_employee_monthly_salary($query_string[0],1);
                        $employee->commit_transaction();
                        $messages->set_message('success', 'salary_editing_success_normal');
                        // echo '<pre>'.print_r($_POST, 1).'</pre>'; exit();
                    }else{
                       $employee->update_employee_monthly_salary($query_string[0],0); 
                       $employee->commit_transaction();
                       $messages->set_message('success', 'salary_editing_success_normal');
                    }   
                }else{
                    $messages->set_message('fail', 'overlap_with_previous');
                    $employee->rollback_transaction();
                }
            }
        
        }
    }
    elseif($_POST['action'] == 'clone'){
        if($_POST['clone_type'] == 'clone_n'){
            $employee->begin_transaction();
            $new_effect_from  = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $_POST['effect_from_normal']) ) ));
            
            $employee->effect_from_normal = $_POST['effect_from_normal'];
            $employee->effect_to_normal = $_POST['effect_to_normal'];
            $employee->normal = trim($_POST['normal']) != '' ?  str_replace(",", ".", $_POST['normal']) : NULL;
            $employee->travel = trim($_POST['travel']) != '' ?  str_replace(",", ".", $_POST['travel']) : NULL;
            $employee->break = trim($_POST['break']) != '' ?  str_replace(",", ".", $_POST['break']) : NULL;
            $employee->overtime = trim($_POST['overtime']) != '' ?  str_replace(",", ".", $_POST['overtime']) : NULL;
            $employee->quality_overtime = trim($_POST['qual_overtime']) != '' ?  str_replace(",", ".", $_POST['qual_overtime']) : NULL;
            $employee->on_call = trim($_POST['oncall']) != '' ?  str_replace(",", ".", $_POST['oncall']) : NULL;
            $employee->more_time = trim($_POST['more_time']) != '' ?  str_replace(",", ".", $_POST['more_time']) : NULL;
            $employee->some_other_time = trim($_POST['some_other_time']) != '' ?  str_replace(",", ".", $_POST['some_other_time']) : NULL;
            $employee->training_time = trim($_POST['training_time']) != '' ?  str_replace(",", ".", $_POST['training_time']) : NULL;
            $employee->call_training = trim($_POST['call_training']) != '' ?  str_replace(",", ".", $_POST['call_training']) : NULL;
            $employee->personal_meeting = trim($_POST['personal_meeting']) != '' ?  str_replace(",", ".", $_POST['personal_meeting']) : NULL;
            $employee->voluntary = trim($_POST['voluntary']) != '' ?  str_replace(",", ".",$_POST['voluntary']) : NULL;
            $employee->complementary = trim($_POST['complementary']) != '' ?  str_replace(",", ".",$_POST['complementary']) : NULL;
            $employee->complementary_oncall = trim($_POST['complementary_oncall']) != '' ?  str_replace(",", ".",$_POST['complementary_oncall']) : NULL;
            $employee->more_oncall = trim($_POST['more_oncall']) != '' ?  str_replace(",", ".",$_POST['more_oncall']) : NULL;
            $employee->standby = trim($_POST['standby']) != '' ?  str_replace(",", ".",$_POST['standby']) : NULL;
            $employee->work_for_dismissal = trim($_POST['work_for_dismissal']) != '' ?  str_replace(",", ".",$_POST['work_for_dismissal']) : NULL;
            $employee->work_for_dismissal_oncall = trim($_POST['work_for_dismissal_oncall']) != '' ?  str_replace(",", ".",$_POST['work_for_dismissal_oncall']) : NULL;
            
            $employee->holiday_big = trim($_POST['holiday_big']) != '' ?  str_replace(",", ".", $_POST['holiday_big']) : NULL;
            $employee->holiday_big_oncall = trim($_POST['holiday_big_oncall']) != '' ?  str_replace(",", ".", $_POST['holiday_big_oncall']) : NULL;
            $employee->holiday_red = trim($_POST['holiday_red']) != '' ?  str_replace(",", ".", $_POST['holiday_red']) : NULL;
            $employee->holiday_red_oncall = trim($_POST['holiday_red_oncall']) != '' ?  str_replace(",", ".", $_POST['holiday_red_oncall']) : NULL;
            $employee->insurance = trim($_POST['insurance']) != '' ?  str_replace(",", ".", $_POST['insurance']) : NULL;
            $employee->week_end_travel = trim($_POST['wkend_travel']) != '' ?  str_replace(",", ".", $_POST['wkend_travel']) : NULL;
            $check_normal_overlap = $employee->check_overlapp_normal_salary($query_string[0]);
            $overlapped = 0;
            for($j=0;$j<count($check_normal_overlap);$j++){
                if($check_normal_overlap[$j]['effect_to'] == '0000-00-00'){
                        if($_POST['effect_from_normal'] <= $check_normal_overlap[$j]['effect_from']){
                            $overlapped = 1;
                        }
                    }else{
                        if($_POST['effect_from_normal'] >= $check_normal_overlap[$j]['effect_from'] && $_POST['effect_from_normal'] <= $check_normal_overlap[$j]['effect_to']){
                           $overlapped = 1;
                        }
                    }
            }
            if($overlapped == 0){
                $employee->give_effect_to_old_salary_normal($query_string[0],$new_effect_from);
                if($employee->add_normal_time_salary($query_string[0],$query_string[2],$_POST['increment'])){
                    $employee->commit_transaction();
                    $add = 1;
                    $messages->set_message('success', 'salary_adding_success_normal');
                    if($query_string[2] != "both"){
                        header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
                        exit();
                    }
                }else{
                    $employee->rollback_transaction();
                    $messages->set_message('fail', 'salary_adding_failed_normal');
                    
                }
            }else{
                $employee->rollback_transaction();
                $messages->set_message('fail', 'overlap_with_previous');
            }
        }
        elseif($_POST['clone_type'] == 'clone_i'){
            //echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
            $employee->begin_transaction();
            $counts = 0;
            $breaks = 0;
            for($i=0;$i<count($group_ids);$i++){
                $new_effect_from  = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $_POST['effect_from']) ) ));
                
                $employee->inconv_group_id = $group_ids[$i];
                $employee->effect_from_inconv = $_POST['effect_from'];
                $employee->effect_to_inconv = $_POST['effect_to'];
                $employee->amount_inconv =  trim($amount_inconv[$i]) != '' ?  str_replace(",", ".", $amount_inconv[$i]) : NULL;
                //$check_overlap = $employee->check_overlapp_inconvenient_salary($query_string[0],$_POST['effect_from'],$group_ids[$i]);
                $check_overlap = $employee->check_overlapp_inconvenient_salary($query_string[0],$group_ids[$i]);
                for($j=0;$j<count($check_overlap);$j++){
                    if($check_overlap[$j]['effect_to'] == '0000-00-00'){
                        if($_POST['effect_from'] == $check_overlap[$j]['effect_from']){
                            $breaks = 1;
                            break;
                        }
                    }else{
                        if($_POST['effect_from'] >= $check_overlap[$j]['effect_from'] && $_POST['effect_from'] <= $check_overlap[$j]['effect_to']){
                            $breaks = 1;
                            break;
                        }
                    }
                }
                if($breaks == 1){
                    break;
                }
                $employee->give_effect_to_old_salary($query_string[0],$new_effect_from,$group_ids[$i]);
                if($group_ids[$i] == $group_ids[$i+1]){
                    $employee->sal_call_training = trim($amount_inconv[$i+1]) != '' ?  str_replace(",", ".", $amount_inconv[$i+1]) : NULL;
                    $employee->sal_complementary_oncall = trim($amount_inconv[$i+2]) != '' ?  str_replace(",", ".", $amount_inconv[$i+2]) : NULL;
                    $employee->sal_more_oncall = trim($amount_inconv[$i+3]) != '' ?  str_replace(",", ".", $amount_inconv[$i+3]) : NULL;
                    $employee->sal_dismissal_oncall = trim($amount_inconv[$i+4]) != '' ?  str_replace(",", ".", $amount_inconv[$i+4]) : NULL;
                    $i = $i+4;
                    if($employee->add_inconvenient_salary($query_string[0],$query_string[2],$_POST['increment_i'])){
                        $counts = $counts + 5;
                    }
                    //$counts = $counts + 4;
                }else{
                    $employee->sal_call_training = NULL;
                    $employee->sal_complementary_oncall = NULL;
                    $employee->sal_more_oncall = NULL;
                    $employee->sal_dismissal_oncall = NULL;
                   if($employee->add_inconvenient_salary($query_string[0],$query_string[2],$_POST['increment_i'])){
                        $counts++;
                    }
                }
                //if($employee->add_inconvenient_salary($query_string[0],$query_string[2],$_POST['increment_i'])){
                    //$counts++;
                //}
                
            }
            if($counts == count($group_ids)){
                $employee->commit_transaction();
                $messages->set_message('success', 'salary_adding_success_normal');
                if($query_string[2] != "both"){
                    header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
                    exit();
                }
            }else{
                $employee->rollback_transaction();
                $messages->set_message('fail', 'salary_adding_failed_inconv');
            }
        }
    }
}

$smarty->assign('employee_username',$query_string[0]);

if(!empty($query_string[0])){ 
	$employee_detail[0] = $employee->get_employee_detail($query_string[0]);
	$smarty->assign('employee_detail', $employee_detail);
        if($query_string[1] == 'edit'){
            $normals = $employee->get_normal_sal_acc_id($query_string[2]);
            $inconvs= $employee->get_inconv_sal_acc_id($query_string[2]);
            $effects = $employee->get_effects_acc_id($query_string[2]);
            $monthly = $employee->get_monthly_sal_acc_id($query_string[2]);
        }else if($query_string[1] == 'new'){
            if($query_string[2] == "both" && $_POST['action'] == 'add'){
                header("Location: " . $smarty->url . "employee/list/salary/".$query_string[0]."/");
                exit();
            }else{
                $inconvs = $employee->get_inconvenient_names($query_string[0]);
                $effects = $normals = $monthly = array();
                $smarty->assign('hides',$query_string[2]);
            }
        }else{
            $inconvs = $employee->get_inconvenient_amount($query_string[0]);
            $effects = $employee->get_inconvenient_amount($query_string[0],1);
            $normals = $employee->get_normal_work_salaries($query_string[0]);
            $monthly = $employee->get_monthly_sal_acc_id($query_string[2]);
        }
//        echo "<pre>".print_r($inconvs, 1)."</pre>"; exit();
        $smarty->assign('inconvs',$inconvs);
        $smarty->assign('effects',$effects);
        $smarty->assign('normals',$normals);
        $smarty->assign('monthly',$monthly);
}
//echo "<pre>". print_r($inconvs, 1)."</pre>";
$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->assign('message', $messages->show_message());
$monthly_sals = $employee->get_employee_salary_monthly($query_string[0]);
$smarty->assign('monthly_sals',$monthly_sals[0]['monthly_salary']);
$smarty->assign('user_roles',$user->user_role($_SERVER['QUERY_STRING']));
$smarty->assign('users_in',$query_string[0]);
$smarty->display('extends:layouts/dashboard.tpl|employee_salary.tpl');
?>