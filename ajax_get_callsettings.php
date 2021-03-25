<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/inconvenient_timing.php');

$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"), FALSE);
$inc_timing = new inconvenient_timing();
$customer = new customer();
$message = new message();

$user_id = trim($_REQUEST['user_id']);

$return_obj = new stdClass();

$return_obj->transaction_flag = TRUE;
$inconvenient_detail = array();
if($user_id == ''){
    $message->set_message('fail', 'appoiment details');
    $return_obj->transaction_flag = FALSE;
}

if($return_obj->transaction_flag){
    if($user_id != '')
        //$inconvenient_detail = $inc_timing->get_all_inconvenient_timing_list_customer($user_name);
    //////////////////////////////////////////////////////////////////////////////////
    $w_days = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");  // checkbox name
    $w_days_count = count($w_days);
    
    $id = trim($user_id);
    $this_timings = array();
    $timing = $inc_timing->customer_inconvenient_timing($id);
//    echo "<pre>".print_r($timing, 1)."</pre>";
    if(!empty($timing)){
        $this_timings['id'] = $timing[0]['id'];;
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
        if($action == 'clone'){
            if($this_timings['effect_to'] != ''){
                $this_timings['effect_from'] = date('Y-m-d', strtotime('+1 day', strtotime($this_timings['effect_to'])));
                $this_timings['effect_to'] = date('Y-m-d', strtotime('+1 day', strtotime($this_timings['effect_from'])));
            }else
                $this_timings['effect_from'] = date('Y-m-d');
        }
        
        $days = explode(",", $timing[0]['days']);
        $child_timings = $inc_timing->customer_inconvenient_child_timings($id);
        if(!empty($child_timings)){
            $child_count = count($child_timings);
            if($action == 'edit' && $child_timings[$child_count-1]['type'] == 3){
                
                
                $days_new = explode(',',$child_timings[$child_count-1]['days']);
                for($i=0;$i<count($days_new)-1;$i++){
//                    echo "<script>alert('".$days_new[$i]."')</script>";
                    $timetable_values = $inc_timing->get_timetable_all($child_timings[$child_count-1]['effect_from'],$child_timings[$child_count-1]['effect_to'],$child_timings[$child_count-1]['time_from'],$child_timings[$child_count-1]['time_to'],$days_new[$i]);
                    if($timetable_values){
                        for($j=0;$j<count($timetable_values);$j++){
                            $timetable_timings[] = $timetable_values[$j];
                        }
                    }
                }
            }
            
            $this_timings['time_to'] = $child_timings[count($child_timings)-1 ]['time_to'];
            foreach($child_timings as $child){
                $child_days = explode(",", $child['days']);
                if($timing[0]['nature'] == 0 /*&& $this_timings['time_from'] >= $this_timings['time_to']*/){  //check descrete type inconvenient spans to next day
                    /* $days_array = explode(',', $days);
                    $next_day_array = array();
                    foreach ($days_array as $day) {
                        if ($day == 7) 
                            $next_day_array[] = 1;
                        else
                            $next_day_array[] = $day + 1;
                    }
                    $final_days = implode(',', $next_day_array) . ',';*/
                }else       //contigeous
                    $days = array_merge($days, $child_days);
            }
        }
        for ($j = 0; $j < $w_days_count; $j++) {
            if (($n = array_search($j + 1, $days)) !== FALSE)
                $d[$w_days[$j]] = 1;
            else
                $d[$w_days[$j]] = 0;
        }
        $this_timings['days']=$d;
        //$smarty->assign('days', $d);
    }
    
    
    //////////////////////////////////////////////////////////////////////////////////
    if(empty($this_timings)){
        $message->set_message('fail', 'appoiment details');
        $return_obj->transaction_flag = FALSE;
    }
}
//echo $this_timings['days'];exit();
//$return_obj->inconvenient_detail = $inconvenient_detail[0];
$return_obj->inconvenient_detail = $this_timings;
$return_obj->message = $message->show_message();
echo json_encode($return_obj);
?>