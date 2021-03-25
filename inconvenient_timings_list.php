<?php
require_once('class/setup.php');
require_once('class/inconvenient_timing.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("inconvenient_timing.xml", "messages.xml", "button.xml", "month.xml", "user.xml"));
$inc_timing = new inconvenient_timing();
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 7));

//sorting inconvenient entries
if(isset($_POST) && $_POST['action'] == 'sort_inconvenient_entries'){
    // echo "<pre>".print_r($_POST, 1)."<pre>";
    $result_flag = TRUE;
    if(isset($_POST['sort_data']) && !empty($_POST['sort_data'])){
        $inc_timing->begin_transaction();
        foreach ($_POST['sort_data'] as $sdata) {
            if($sdata['gid'] == '' || $sdata['order'] == '' || (int) $sdata['gid'] <= 0 || (int) $sdata['order'] <= 0)
                continue;
            $result_flag = $inc_timing->update_inconvenient_sort_order($sdata['gid'], $sdata['order']);
            if(!$result_flag) break;
        }
        if($result_flag){
            $inc_timing->commit_transaction();
            $messages->set_message('success', 'inconvenient_entries_sort_success');
        }else {
            $inc_timing->rollback_transaction();
            $messages->set_message('fail', 'inconvenient_entries_sort_fail');
        }

    }
    $obj_return = new stdClass();
    $obj_return->result = $result_flag;
    $obj_return->message = $messages->show_message();
    echo json_encode($obj_return);
    exit();
}

global $week;
$test = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('type', $test[0]);
$smarty->assign('week', $week);
/*if(isset($_POST) && $_POST['action'] == 'bm_edit'){
    $bm_id = $_POST['bm_id'];
    $bm_tfrom = $_POST['tfrom'];
    $bm_tto = $_POST['tto'];
    if($inc_timing->check_local_holiday_blockmaster_details_byId($bm_id)){      //update local blockmaster table
        $inc_timing->update_local_holiday_blockmaster_details_byId($bm_id,$bm_tfrom,$bm_tto);
    }else{ //create new entry in local blockmaster table
        $inc_timing->create_local_holiday_blockmaster_details_byId($bm_id,$bm_tfrom,$bm_tto);
    }
}*/
$list = $inc_timing->get_all_inconvenient_timing_list(NULL, TRUE);
//echo "<pre>".print_r($list, 1)."</pre>";
$inconv_list_nested = array();
// echo "<pre>".print_r($list, 1)."</pre>"; exit();
if(!empty($list)){
    
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
    /*$inconv_list_count = count($list);
    for ($i = 0; $i < $inconv_list_count; $i++) {
        if (($a = strpos($list[$i]['days'], '-')) !== FALSE) {
            $list[$i]['days'] = date("d F", strtotime('00-' . $list[$i]['days']));
        } else {
            $month_nos = $list[$i]['day_time'];
            $day_time = "";
            //foreach ($month_nos as $mlabels) {
                //$day_time .= '<div class="day-report"><h1>' . $smarty->translate[$week[$mlabels['day'] - 1]['label']] . '</h1>' . $mlabels['time'] . '</div></td>';
            //}
            $list[$i]['days'] = $day_time;
        }
    }*/
   // echo "after<pre>".print_r($list, 1)."</pre>"; exit();
    //organizing previous versions as child
    foreach ($list as $incov){
        if(in_array($incov['group_id'], array_keys($inconv_list_nested))){
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
//echo "<pre>".print_r($inconv_list_nested, 1)."</pre>"; exit();
//echo "<pre>".print_r($inconv_list_nested[5], 1)."</pre>"; exit();

$holi_list = $inc_timing->holiday_timing_list_full();
//echo "<pre>".print_r($holi_list, 1)."</pre>";
$holi_list_nested = array();
if(!empty($holi_list)){
   // $holi_list_count = count($holi_list);
   // $previous_holi_group_ids = array();
    foreach ($holi_list as $holi){
        if(in_array($holi['group_id'], array_keys($holi_list_nested))){
            $holi_list_nested[$holi['group_id']]['privious_versions'][] = $holi;
        } else {
            $holi_list_nested[$holi['group_id']] = $holi;
            $holi_list_nested[$holi['group_id']]['privious_versions'] = array();
        }
    }
}
/*if (!empty($holi_list)) {
    for ($i = 0; $i < count($holi_list); $i++) {   // this loop is used to find year of upperlimit of 'days' field in the table
        //$local_bm = $inc_timing->get_local_holiday_blockmaster_details_byId($holi_list[$i][id]);
        $count = $inc_timing->holidays_count($holi_list[$i][id]);
        $start = strtotime(date('Y') . '-' . $holi_list[$i][date_from]);
        $holi_list[$i]['calc_year_to'] = date('Y', strtotime("+$count[0] day", $start));
//        if(!empty($local_bm)){
//            $holi_list[$i][start_time] = $local_bm[0]['start_time'];
//            $holi_list[$i][end_time] = $local_bm[0]['end_time'];
//        }
    }
}*/

//echo "<pre>nested: ".print_r($inconv_list_nested, 1)."</pre>"; exit();
//echo "<pre>".print_r($list, 1)."</pre>";
//sorting holi nested array as active first manner
$cur_year = date('Y');
$cur_date = date('Y-m-d');
$temp_holi_nested_array_active = array();
$temp_holi_nested_array_past = array();
$temp_holi_nested_array_future = array();
//$temp_holi_nested_array__1 = array();
//$temp_holi_nested_array__2 = array();
if(!empty($holi_list_nested)){
    foreach ($holi_list_nested as $holi){
        if($holi['year_to'] == '' && $holi['year_from'] <= $cur_year){
            $make_date = date('Y-m-d', strtotime($cur_year.'-'.$holi['date_from']));
            $holi['sort_date'] = $make_date;
            $holi['active_flag'] = TRUE;
            $temp_holi_nested_array_active[] = $holi;
           // $temp_holi_nested_array__1[] = array('sort_date' => $make_date);
        }
        else if($holi['year_to'] != '' && 
                date('Y-m-d', strtotime($holi['year_from'].'-'.$holi['date_from'])) <= $cur_date &&
                date('Y-m-d', strtotime($holi['year_to'].'-'.$holi['date_to'])) >= $cur_date){
            $make_date = date('Y-m-d', strtotime($cur_year.'-'.$holi['date_from']));
            $holi['sort_date'] = $make_date;
            $holi['active_flag'] = TRUE;
            $temp_holi_nested_array_active[] = $holi;
           // $temp_holi_nested_array__1[] = array('sort_date' => $make_date);
        }
        else if($holi['year_from'] > $cur_year){
            $make_date = date('Y-m-d', strtotime($holi['year_from'].'-'.$holi['date_from']));
            $holi['sort_date'] = $make_date;
            $temp_holi_nested_array_future[] = $holi;
        }
        else {
            $make_date = date('Y-m-d', strtotime($holi['year_from'].'-'.$holi['date_from']));
            $holi['sort_date'] = $make_date;
            $temp_holi_nested_array_past[] = $holi;
        }
    }
}

//echo "<pre>".print_r($holi_list_nested, 1)."</pre>";
//usort($temp_holi_nested_array__1, build_sorter('sort_date'));
//usort($temp_holi_nested_array__2, build_sorter('sort_date'));
//echo "<pre>: ".print_r(array_merge($temp_holi_nested_array__1, array_reverse($temp_holi_nested_array__2)), 1)."</pre>";
//echo "<pre>b4: ".print_r($temp_holi_nested_array, 1)."</pre>";
if(!empty($temp_holi_nested_array_active)) usort($temp_holi_nested_array_active, build_sorter('sort_date'));
if(!empty($temp_holi_nested_array_past)) usort($temp_holi_nested_array_past, build_sorter('sort_date'));
if(!empty($temp_holi_nested_array_future)) usort($temp_holi_nested_array_future, build_sorter('sort_date'));
$holi_list_nested = array_merge(array_reverse($temp_holi_nested_array_future), $temp_holi_nested_array_active, array_reverse($temp_holi_nested_array_past));
//echo "<pre>after: ".print_r($holi_list_nested, 1)."</pre>";
//exit();
//echo "------------<pre>holi_list_nested".print_r($holi_list_nested, 1)."</pre>";
$smarty->assign('message', $messages->show_message());
//$smarty->assign('timing_list', $list);

// echo "<pre>".print_r($inconv_list_nested, 1)."</pre>"; exit();
$smarty->assign('timing_list', $inconv_list_nested);
//$smarty->assign('holi_timing_list', $holi_list);
$smarty->assign('holi_timing_list', $holi_list_nested);
$smarty->display('extends:layouts/dashboard.tpl|inconvenient_timings_list.tpl');
function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}
?>