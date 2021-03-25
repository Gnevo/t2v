<?php
require_once('class/setup.php');
require_once('class/inconvenient_timing.php');
require_once('class/dona.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("month.xml", "messages.xml", "button.xml", "inconvenient_timing.xml"));
$inc_timing = new inconvenient_timing();
$dona = new dona();
$messages = new message();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 7));
$qry_string = explode('&', $_SERVER['QUERY_STRING']);

//echo "<pre>".print_r($qry_string, 1)."</pre>";
/* ---------------------------------- Delete action--------------------------------------------- */
if(!empty($qry_string) && $qry_string[0] != "" && $qry_string[1] == "delete" && count($qry_string)== 2){
    $holiday_id = $qry_string[0];
    $d_data = $inc_timing->delete_holiday_details_byId($holiday_id);
    header("Location: " . $smarty->url . "inconvenient/timings/list/");
//    exit();
}


if($_POST){
    $error_flag = FALSE;
    $action = '';
    if(!empty($qry_string) && $qry_string[0] != "" && count($qry_string)== 2 && $qry_string[1] == "edit")
        $action = 'edit';
    else if(!empty($qry_string) && $qry_string[0] != "" && count($qry_string)== 2 && $qry_string[1] == "clone")
        $action = 'clone';
    else
        $action = 'new';
    
    $holiday_type = trim($_POST['holiday_type']);
//    $bm_id = trim($_POST['bm_id']);
    $bm_id = trim($qry_string[0]);
    $group_id = trim($_POST['grp_id']);
    $new_name = trim($_POST['new_name']);
    $year_from = trim($_POST['year_from']);
    $year_to = trim($_POST['year_to']);
    
    
    $day_cat = $_POST['day_cat'];
    $datefrom = trim($_POST['datefrom']);
    $dateto = trim($_POST['dateto']);
    $timefrom = $dona->time_to_sixty(trim($_POST['timefrom']));
    $timeto = $dona->time_to_sixty(trim($_POST['timeto']));
    
    
//    $nos_days = trim($_POST['nos_days']);
    $nos_days = 0;
    if(trim($year_from) != '' && trim($datefrom) != '' && trim($dateto) != ''){
        $year_to__ = $year_from;
        $tmp_full_from_date = date('Y-m-d', strtotime($year_from.'-'.$datefrom));
        $tmp_full_to_date = date('Y-m-d', strtotime($year_from.'-'.$dateto));
        if(date('m', strtotime($tmp_full_from_date)) > date('m', strtotime($tmp_full_to_date)))
            $year_to__ = $year_from+1;

        $calc_full_from_date = $tmp_full_from_date;
        $calc_full_to_date = date('Y-m-d', strtotime($year_to__.'-'.$dateto));

        $diff = floor((strtotime($calc_full_to_date) - strtotime($calc_full_from_date)) / (60*60*24)); // ms per day
        $nos_days = abs($diff) + 1;
    }
    
    if ($timeto == 0) $timeto = 24;
    if ($timeto == 24) $timeto = 24.00;
    if ($timefrom == false || $timeto == false) {
        $messages->set_message('fail', 'invalid_time');
    }else{
         //validation starts here
        $dStart = new DateTime(date('Y').'-'.date($datefrom));
        $tmp_ip_year_to_ = (substr($datefrom, 0, 2) > substr($dateto, 0, 2)) ? (date('Y')+1) : date('Y');
        $dEnd  = new DateTime($tmp_ip_year_to_.'-'.date($dateto));
        $dDiff = $dStart->diff($dEnd);
    //    echo $dDiff->format('%R'); // use for point out relation: smaller/greater
        $cal_date_diff = $dDiff->days+1;
        if($nos_days <= 0){
            $messages->set_message("fail", "no_of_days_should_atleast_1");
            $error_flag = TRUE;
        }else if($cal_date_diff != $nos_days){
            $messages->set_message("fail", "no_of_days_does_not_match_date_effected_days");
            $error_flag = TRUE;
        }
        //validation end here

        $day_n_type = array();
        if($nos_days != 0 && $nos_days != ''){
            for($i = 1 ; $i<=$nos_days ; $i++){
                if(isset($day_cat[$i]))
                    $day_n_type[$i] = 1; //indicates Red day 
                else
                    $day_n_type[$i] = 2; //indicates Big day 
            }
        }
        if(!$error_flag){


            /* ---------------------------------- Clone action--------------------------------------------- */
            $possible_holidays = array();
            if($action == 'new'){
                $possible_holidays = $inc_timing->get_holiday_by_years($year_from, $year_to);
            }elseif($action ==  'edit' || $action ==  'clone'){
                $possible_holidays = $inc_timing->get_holiday_by_years($year_from, $year_to,$bm_id);
            }
    //        echo "<pre>".print_r(array($year_from,$year_to,$datefrom,$dateto), 1)."</pre>";
    //        $possible_holidays = $inc_timing->get_holiday_by_years($year_from, $year_to);
    //        echo "<pre>".print_r($possible_holidays, 1)."</pre>";
            $collide_flag = FALSE;
            foreach ($possible_holidays as $possible_holiday) { 
                $db_datefrom = $possible_holiday['date_from'];
                $db_dateto = $possible_holiday['date_to'];
                $temp_start_date = $possible_holiday['effect_from'].'-'.$db_datefrom;
                $temp_year_to = (substr($db_datefrom, 0, 2) > substr($db_dateto, 0, 2)) ? ($possible_holiday['effect_from']+1) : $possible_holiday['effect_from'];
                $temp_end_date = $temp_year_to.'-'.$db_dateto;

                $ip_start_date = $possible_holiday['effect_from'].'-'.$datefrom;
                $tmp_ip_year_to = (substr($datefrom, 0, 2) > substr($dateto, 0, 2)) ? ($possible_holiday['effect_from']+1) : $possible_holiday['effect_from'];
                $ip_end_date = $tmp_ip_year_to.'-'.$dateto;

    //            echo "<pre>".print_r(array($temp_start_date,$temp_end_date,$ip_start_date,$ip_end_date), 1)."</pre>";
                $flg = 0;
                if(($temp_start_date <= $ip_start_date && $temp_end_date >= $ip_start_date) || ($temp_start_date <= $ip_end_date && $temp_end_date >= $ip_end_date) || ($temp_start_date >= $ip_start_date && $temp_start_date <= $ip_end_date)){
                   
//                    if(($possible_holiday['start_time'] <= $timefrom && $possible_holiday['end_time'] >= $timefrom) || ($possible_holiday['start_time'] <= $timeto && $possible_holiday['end_time'] >= $timeto) || ($possible_holiday['start_time'] >= $timefrom && $possible_holiday['start_time'] <= $timeto)){
//                    
                    if(($temp_start_date == $ip_end_date)){
                        if($possible_holiday['start_time'] < $timeto){
                           $collide_flag = TRUE;
                            $flg = 1; 
                        }
                    }
                    elseif($temp_end_date == $ip_start_date){
                        if($possible_holiday['end_time'] > $timefrom){
                            $collide_flag = TRUE;
                            $flg = 1; 
                        }
                    }else{
                        $collide_flag = TRUE;
                        $flg = 1;
                    }
//                    if($possible_holiday['start_time'] < $timeto || $possible_holiday['end_time'] > $timefrom){
//                        echo "<pre>". print_r($possible_holiday, 1)."</pre>";
//                        echo "(".$possible_holiday['start_time']." < ".$timeto." || ".$possible_holiday['end_time']." > ".$timefrom.")";
////                        echo $possible_holiday['start_time']." <= ".$timefrom."  && ".$possible_holiday['end_time']."  >= ".$timeto." ) || (".$possible_holiday['start_time']."  < ".$timeto."  && ".$possible_holiday['end_time']."  <= ".$timeto." ) || (".$possible_holiday['start_time']."  >= ".$timefrom."  && ".$possible_holiday['start_time']."  < ".$timeto." ) || (".$possible_holiday['start_time']."  >= ".$timefrom ." && ".$possible_holiday['end_time']."  <= ".$timeto;
//                        $collide_flag = TRUE;
//                        $flg = 1;
//                    }
                }

                if($flg == 0){
                    $ip_start_date = ($possible_holiday['effect_from']-1).'-'.$datefrom;
                    $tmp_ip_year_to = (substr($datefrom, 0, 2) > substr($dateto, 0, 2)) ? $possible_holiday['effect_from'] : ($possible_holiday['effect_from']-1);
                    $ip_end_date = $tmp_ip_year_to.'-'.$dateto;
    //                echo "<pre>".print_r(array($temp_start_date,$temp_end_date,$ip_start_date,$ip_end_date), 1)."</pre>";
                    if(($temp_start_date <= $ip_start_date && $temp_end_date >= $ip_start_date) || ($temp_start_date <= $ip_end_date && $temp_end_date >= $ip_end_date) || ($temp_start_date >= $ip_start_date && $temp_start_date <= $ip_end_date)){
//                        if($possible_holiday['end_time'] <= $timefrom || $possible_holiday['start_time'] >= $timeto)
//                            $flg = 0;
                        if(($temp_start_date == $ip_end_date)){
                            if($possible_holiday['start_time'] < $timeto){
                               $collide_flag = TRUE;
                                $flg = 1; 
                            }
                        }
                        elseif($temp_end_date == $ip_start_date){
                            if($possible_holiday['end_time'] > $timefrom){
                                $collide_flag = TRUE;
                                $flg = 1; 
                            }
                        }else{
                            $collide_flag = TRUE;
                            $flg = 1;
                        }
                    }
                }

                if($collide_flag){
                    break;
                }
        //        
    //            echo "<pre>".print_r($possible_holiday, 1)."</pre>";
    //            echo "<pre>------------------------------------</pre>";
        //        echo "<pre>".print_r(array($temp_start_date,$temp_end_date), 1)."</pre>";
            }

            if($collide_flag)
                    $messages->set_message("fail", "holiday_collide");
            else if($action == 'new'){       //create new block
                
                $group_id = $inc_timing->get_next_holiday_group_id();
                if($inc_timing->create_local_holiday_blockmaster_data($new_name, $group_id ,$year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type)){
                    $new_bm_id = $inc_timing->get_id();
                    foreach($day_n_type as $day => $type)
                        $inc_timing->create_local_holiday_block_day_details($new_bm_id, $day, $type);
                    $messages->set_message("success", "holiday_adding_success");
                }else{
                    $messages->set_message("fail", "holiday_adding_failed");
                }
            }else if($action == 'edit'){  //update existing 
                if($inc_timing->update_local_holiday_blockmaster_data($bm_id,$group_id, $new_name, $year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type)){
                    $inc_timing->delete_local_holiday_block_day_details($bm_id);
                    foreach($day_n_type as $day => $type)
                        $inc_timing->create_local_holiday_block_day_details($bm_id, $day, $type);
                    $messages->set_message("success", "holiday_update_success");
                }else{
                    $messages->set_message("fail", "holiday_updating_failed");
                }
            }else if($action == 'clone'){  //Clone existing 
                $clone_parent_data = $inc_timing->get_holiday_details_byId($bm_id);
                if(empty($clone_parent_data))
                    $messages->set_message("fail", "clone_parent_holiday_does_not_exist");
                else if($clone_parent_data[0]['name'] != $new_name)
                    $messages->set_message("fail", "cloned_holiday_must_have_same_name");
                else if($clone_parent_data[0]['effect_to'] != '' && $clone_parent_data[0]['effect_to'] >= $year_from)
                    $messages->set_message("fail", "holiday_collide");
                else if($clone_parent_data[0]['effect_from'] >= $year_from || ($clone_parent_data[0]['effect_from'] == $year_from))
                    $messages->set_message("fail", "holiday_collide");
                else{
                    if($inc_timing->create_local_holiday_blockmaster_data($new_name, $group_id,$year_from, $year_to, $datefrom, $dateto, $timefrom, $timeto, $holiday_type)){
                        $new_bm_id = $inc_timing->get_id();
                        foreach($day_n_type as $day => $type)
                            $inc_timing->create_local_holiday_block_day_details($new_bm_id, $day, $type);
                        if($clone_parent_data[0]['effect_to'] == ''){  //update parents effect_to (year to)
                            $just_previous_year = $year_from - 1;
//                            $inc_timing->update_clone_parent_yearTo_of_Holiday($bm_id, $year_from);
                            $inc_timing->update_clone_parent_yearTo_of_Holiday($bm_id, $just_previous_year);
                        }
                        $messages->set_message("success", "holiday_cloning_success");
                        header("Location: " . $smarty->url . 'holiday/new/'.$new_bm_id.'/edit/');
                        exit();
                    }else{
                        $messages->set_message("fail", "holiday_cloning_failed");
                    }
                }
            }
        }
    }
    
    
   
}


$holiay_data = array();
if(!empty($qry_string) && $qry_string[0] != ""){
    $holiday_id = $qry_string[0];
    $holiay_data = $inc_timing->get_holiday_details_byId($holiday_id);
    $holiay_data = $holiay_data[0];
//    echo "<pre>".print_r($holiay_data, 1)."</pre>";
}
$smarty->assign('action', $qry_string[1]);
$smarty->assign('holi_data', $holiay_data);
$smarty->assign('cur_year', date('Y'));
$smarty->assign('message', $messages->show_message());
//$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
//$smarty->assign('timing_names', $names);

$action__ = '';
if(!empty($qry_string) && $qry_string[0] != "" && count($qry_string)== 2 && $qry_string[1] == "edit")
    $action__ = 'edit';
else if(!empty($qry_string) && $qry_string[0] != "" && count($qry_string)== 2 && $qry_string[1] == "clone")
    $action__ = 'clone';
else
    $action__ = 'new';
    
$smarty->assign('action__', $action__);
$smarty->assign('current_month_day', date('m-d'));
$smarty->display('extends:layouts/dashboard.tpl|holiday_new.tpl');
?>