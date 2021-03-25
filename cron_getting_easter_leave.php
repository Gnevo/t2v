<?php
/*
 * created by: sreerag.
 * purpose : for getting easter leave period  of next year.
 * the cron will be run on every first of a month of current year.
 */


require_once('class/company.php');
require_once('class/setup.php');
require_once('class/inconvenient_timing.php');
// require_once('class/leave.php');

$obj_cmp   = new company();
$obj_inv   = new inconvenient_timing();
// $obj_leave = new leave();

$companies = $obj_cmp->company_list();
//echo "<pre>".print_r($companies,1)."</pre>";
$next_year     = date('Y', strtotime('+1 year'));
$easter_base   = new DateTime("$next_year-03-21");
$days          = easter_days($next_year);
$easter_object = $easter_base->add(new DateInterval("P{$days}D"));

$date_to     	= $easter_object->modify('+2 day')->format('m-d');
$date_from      = $easter_object->modify('-5 day')->format('m-d');
$start_time    	= 18.00;
$end_time      	= 7.00;
$day_type 		= array(2,1,2,1,1,2);

$easter_holiday_name = 'Påsk';
foreach ($companies as $key => $single_company) {
    $obj_inv->select_db($single_company['db_name']);
    $group_id = $obj_inv->get_groupid_byname_from_holiday_block_master($easter_holiday_name);

    //Generate a new group ID if no 'Easter' Holiday already exists
    if($group_id == FALSE)
    	$group_id = $obj_inv->get_next_holiday_group_id();


    //checking collide with other holiday, if any, then skip
    $possible_holidays = $obj_inv->get_holiday_by_years($next_year, NULL);
    $collide_flag = FALSE;
    $records_needs_to_set_effect_to = array();
    $already_created_for_this_year = FALSE;
    if(!empty($possible_holidays)){
	    foreach ($possible_holidays as $possible_holiday) { 

	    	if($possible_holiday['name'] == $easter_holiday_name) {
	    		if($possible_holiday['effect_from'] == $next_year){
	    			$already_created_for_this_year = TRUE;
	    		}
	    		if($possible_holiday['effect_to'] == NULL){
	    			$records_needs_to_set_effect_to[] = $possible_holiday['id'];
	    		}
	    		continue; 
	    	}

	        $db_datefrom = $possible_holiday['date_from'];
	        $db_dateto = $possible_holiday['date_to'];
	        $temp_start_date = $possible_holiday['effect_from'].'-'.$db_datefrom;
	        $temp_year_to = (substr($db_datefrom, 0, 2) > substr($db_dateto, 0, 2)) ? ($possible_holiday['effect_from']+1) : $possible_holiday['effect_from'];
	        $temp_end_date = $temp_year_to.'-'.$db_dateto;

	        $ip_start_date = $possible_holiday['effect_from'].'-'.$date_from;
	        $tmp_ip_year_to = (substr($date_from, 0, 2) > substr($date_to, 0, 2)) ? ($possible_holiday['effect_from']+1) : $possible_holiday['effect_from'];
	        $ip_end_date = $tmp_ip_year_to.'-'.$date_to;

	        $flg = 0;
	        if(($temp_start_date <= $ip_start_date && $temp_end_date >= $ip_start_date) || ($temp_start_date <= $ip_end_date && $temp_end_date >= $ip_end_date) || ($temp_start_date >= $ip_start_date && $temp_start_date <= $ip_end_date)){
	           
	            if(($temp_start_date == $ip_end_date)){
	                if($possible_holiday['start_time'] < $end_time){
	                   $collide_flag = TRUE;
	                    $flg = 1; 
	                }
	            }
	            elseif($temp_end_date == $ip_start_date){
	                if($possible_holiday['end_time'] > $start_time){
	                    $collide_flag = TRUE;
	                    $flg = 1; 
	                }
	            }else{
	                $collide_flag = TRUE;
	                $flg = 1;
	            }
	        }

	        if($flg == 0){
	            $ip_start_date = ($possible_holiday['effect_from']-1).'-'.$date_from;
	            $tmp_ip_year_to = (substr($date_from, 0, 2) > substr($date_to, 0, 2)) ? $possible_holiday['effect_from'] : ($possible_holiday['effect_from']-1);
	            $ip_end_date = $tmp_ip_year_to.'-'.$date_to;
	            if(($temp_start_date <= $ip_start_date && $temp_end_date >= $ip_start_date) || ($temp_start_date <= $ip_end_date && $temp_end_date >= $ip_end_date) || ($temp_start_date >= $ip_start_date && $temp_start_date <= $ip_end_date)){
	                if(($temp_start_date == $ip_end_date)){
	                    if($possible_holiday['start_time'] < $end_time){
	                       $collide_flag = TRUE;
	                        $flg = 1; 
	                    }
	                }
	                elseif($temp_end_date == $ip_start_date){
	                    if($possible_holiday['end_time'] > $start_time){
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

	    }
    }
    
    // echo "<pre>".$single_company['name'].'*********************'."</pre>";
    // echo "group_id: <pre>".print_r(array($group_id), 1)."</pre>";
    // var_dump($already_created_for_this_year);
    // var_dump($collide_flag);
    // echo "records_needs_to_set_effect_to: <pre>".print_r($records_needs_to_set_effect_to, 1)."</pre>";

    $operation_flag = FALSE;
    if($group_id != FALSE && !$collide_flag && !$already_created_for_this_year){
	    if($obj_inv->create_local_holiday_blockmaster_data($easter_holiday_name, $group_id ,$next_year, NULL, $date_from, $date_to, $start_time, $end_time, 2)){
	    	$operation_flag = TRUE;
		    $block_master_id = $obj_inv->get_id();
		    foreach ($day_type as $day => $type) {
		    	$obj_inv->create_local_holiday_block_day_details($block_master_id, $day+1, $type);
		    }

		    //set effect-to for previously opened easter holidays
		    if(!empty($records_needs_to_set_effect_to)){
		    	foreach ($records_needs_to_set_effect_to as $rec) { 
			    	$just_previous_year = $next_year - 1;
	                $obj_inv->update_clone_parent_yearTo_of_Holiday($rec, $just_previous_year);
	            }
		    }
	    }
    }

    echo $single_company['name']. ': ' . ($operation_flag ? 'CREATED' : 'NOT CREATED') . '<br/>';
}