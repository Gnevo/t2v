<?php
//Rahul : ajax_auto_scheduler.php

require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once('class/customer.php');
require_once('class/newemployee.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml","user.xml"), FALSE);
$dateobj = new datecalc();
$newcustomer = new newcustomer();
$newemployee = new newemployee();
$obj_customer = new customer();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$tot = sizeof($pram);

$customer = $pram[$tot-4];
$tid = $pram[$tot-3];
$map_with = $pram[$tot-2];
$start_date = $pram[$tot-1];

$start_day = date("D",strtotime($start_date));
$ResultArray = $newcustomer->getCustomerScheduleTemplate($customer, $tid, $start_date); 
$template_days = sizeof($ResultArray); 
$day_diff = $dateobj->get_days($ResultArray[0]["date"],$ResultArray[$template_days-1]["date"]);
$tday = sizeof($day_diff); 
$old_stat_date = $ResultArray[0]["date"];


$sdate = $start_date;
if($template_days > 0){
	$template_days =$template_days-1;
	$edate = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($start_date)) . " +".$tday." days")));
}else{
	$edate = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($start_date)) . " +".$tday." days")));	
}

$fromdate = $sdate;
$MaxDate = $edate;
$todate = $edate;
if($fromdate == '0000-00-00'){
	$fromdate = date('Y-m-d');
	$chunk_fromdate = explode('-',$fromdate);
	$FromDay	= $chunk_fromdate[2];
	$FromMonth	= $chunk_fromdate[1];
	$FromYear	= $chunk_fromdate[0];	
	$date = mktime(0, 0, 0, $FromMonth, $FromDay, $FromYear);
	$week = (int)date('W', $date); 		
}
else{
	$chunk_fromdate = explode('-',$fromdate);
	$FromDay	= $chunk_fromdate[2];
	$FromMonth	= $chunk_fromdate[1];
	$FromYear	= $chunk_fromdate[0];	
	$date = mktime(0, 0, 0, $FromMonth, $FromDay, $FromYear);
	$week = (int)date('W', $date); 	
}

$chunk_todate	= explode('-',$MaxDate);
$today = $chunk_todate[2];		
$tomonth = $chunk_todate[1];	
$toyear = $chunk_todate[0];		

$YearDiff = $MaxDate - $fromdate;
$years = $FromYear;
if($YearDiff > 0){
	for($y = 0 ; $y <= $YearDiff ; $y++){
		$YearArr[] = $years;
		$years++;	
	}
}
else{
	$YearArr[] = $FromYear;
}
$YearsString = implode('|',$YearArr);

$diff = $dateobj->get_days($fromdate,$MaxDate);
$totWeeks = ceil(count($diff)/7)+1;	

$year_week = $YearsString.'|'.$week;
$week_position = 1;

//$week_numbers = $dateobj->get_weeks_moreyears($year_week, $totWeeks, $week_position);
$week_numbers = $dateobj->get_weeks_moreyears_new($year_week, $totWeeks, $week_position, $start_date);

//Add Dates in week array
$cnt = 0;
$flag = 0;
$emp_assign_array = array();
foreach($week_numbers as $week_number){
	if($week_number['date'] > $MaxDate)
		break;	
	
	$ts = strtotime($week_number['date']);
	$dow = date('w', $week_number['date']);
	$offset = $dow - 1;
	if ($offset < 0) 
		$offset = 6;
	for ($i = 0; $i < 7; $i++, $ts += 86400){
		//$week_numbers[$cnt]['week'][] = date("Y-m-d l", $ts);
		$week_numbers[$cnt]['week'][] = date("Y-m-d", $ts);
		$myday = date("d", $ts);
		$mymonth = date("m", $ts);
		if($myday == 30 || $myday == 31 && $mymonth != 2)
		{
			$flag = 1;
		}
		else if($myday == 29 && $mymonth == 2)
		{
			$flag = 1;
		}		
		if($week_number['value'] == 'V02')
		{
			$flag = 0;
		}
	}
	$cnt++;
}

$listr .= '<ul class="weeks">';
$showhidecounter = 0;
$week_date = array();
$l=0; 
foreach($week_numbers as $week_number)
{
	if($showhidecounter > 14)
		{
			$MyStyle = 'style="display:none;width:52px;"';
		}
		else
		{
			$MyStyle = 'style="width:54px;"';	
		}
	if($week_number["week"]){
			
			if(@in_array($sdate, $week_number["week"]))	
			{ $l=1;
				$listr .= '<li '.$MyStyle.' id="'.$customer.'class'.$showhidecounter.'" class="active" onclick="showhide('.$cnt.','.$showhidecounter.',\''.$customer.'\')"><a href="javascript:void(0);">'.$week_number["value"].'</a></li>';
				if(@in_array($edate, $week_number["week"])){
					$l=0;
				}	
			}
			else
			{	
				if($l==1){
					$listr .= '<li '.$MyStyle.' id="'.$customer.'class'.$showhidecounter.'" onclick="showhide('.$cnt.','.$showhidecounter.',\''.$customer.'\')"><a href="javascript:void(0);">'.$week_number["value"].'</a></li>';	
				}
				
				if(@in_array($edate, $week_number["week"])){
					$l=0;
				}	
			}
			
		if($week_number["week"] != ""){
			$week_date[] = $week_number["week"];		
		}		
	}
			$showhidecounter++;
}
$listr .= '</ul>';	


echo '<form name="frmadddata" id="frmadddata" action="" method="post" ><input type="hidden" name="customer" value="'.$customer.'" ><input type="hidden" name="template_id" value="'.$tid.'" >';
echo '<input type="hidden" id="atl_warnings" name="atl_warnings" value="" >';

if(!empty($ResultArray) && $map_with == 1){  	
	/* if $map_with == 1 than Start in template day with start in schedule day */
   
	$first_part = $newcustomer->getStartDateTouptoDatdate($ResultArray, $start_day);
	$start_date_first_part = array_values($first_part); 
	$second_part = $newcustomer->getShiftOtherDayBack($ResultArray, $start_date_first_part[0], end($start_date_first_part));
	$all_part = array_merge($first_part,$second_part);
	
	//echo "<pre>";print_r($all_part);
	$DaysName = array("Mon"=>'monday',"Tue"=>'tuesday',"Wed"=>'wednesday',"Thu"=>'thursday',"Fri"=>'friday',"Sat"=>'saturday',"Sun"=>'sunday');
	
	$WeekHtml .= '<input type="hidden" name="hdn_total" id="hdn_total" value="'.$cnt.'" />
					<input id="hdn_start" type="hidden" value="0" name="hdn_start">
					<input id="hdn_end" type="hidden" value="14" name="hdn_end">';
		$f = 0; 
		$start = 0;
		$k = 0;
		foreach($week_date as $curweek){
				$show ="";	
				if($curweek){
					if(!in_array($start_date, $curweek))
						$show = 'style="float:left;margin-left:8px;;border:1px solid #C6C6C6;display:none;"';
					else
						$show = 'style="float:left;margin-left:8px;;border:1px solid #C6C6C6;"';
				}
		
			$WeekHtml .= '<div id="'.$customer.$f.'" class="fixedArea" '.$show .' >
									<div id="slot_list_week" style="border:none;" >';
						
			$curr_date = '1';
			
			$i = 0;
		
	
			foreach($curweek as $timeTableData){	
			  
			  if($timeTableData == $start_date)
				 	$start = 1; 
			 
			   
			 	// $NewDate = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($start_date)) . " +".$i." days")));
				$NewDate = $timeTableData;
				
			    if($start == 1){
					
					
                                    if(($curr_date != $timeTableData) || $curr_date ==1){	

                                          $WeekHtml .= '<div id="myid0" class="cstmr_wk_main customer_week" style="width:120px;" >
                                                          <a class="customer_week_days" style="width:120px;">'.$smarty->localise->contents[$DaysName[date("D",strtotime($NewDate))]].'<br>'.$NewDate.'</a>';					
                                    } 
                                    $get_slote_per_date = $newcustomer->get_copy_slote_per_date($all_part[$i], $customer, $tid);

				    if(sizeof($get_slote_per_date) > 0 && $k < sizeof($all_part) ){	 
						foreach($get_slote_per_date as $slote){
	
								$EmpUname ='';												
								$EmpFname = '';
								$EmplName = ''; 
								$hex = "";
								$class="time_slot_incomplete";
								if($slote['employee'] != ''){
									
									$err1 = $newcustomer->check_employee_leave_customer($slote['employee'], $customer);
									$err2 = $newcustomer->check_leave_employee_to_template_set($slote['employee'],$NewDate,$slote['time_to']);
									$err3 = $newcustomer->check_employee_schedule_to_other_customer($slote['employee'], $slote['customer'], $NewDate,
									$slote['time_from'], $slote['time_to']);	
									$err_sum = $err1 + $err2 + $err3;
									
									if($err_sum == 0){	
									
										$AvlEmpDetails = $newemployee->get_employee_detail($slote['employee']);
										$EmpUname = $AvlEmpDetails['username'];												
										$EmpFname = $AvlEmpDetails['first_name'];
										$EmplName = $AvlEmpDetails['last_name']; 
										
										$hex = "#";
										$hex .= str_pad(dechex($AvlEmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
										$hex .= str_pad(dechex($AvlEmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
										$hex .= str_pad(dechex($AvlEmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
										$class="time_slot_btn";
									}
								}
								
								
								if($slote["fkkn"] == 1)
									$fkkn = '<img src="'.$smarty->url.'images/icon_fk.gif">';
								else
									$fkkn = '<img src="'.$smarty->url.'images/icon_kn.gif">';
                                                                $type_class = '<span class="work"></span>';
                                                                if($slote['type'] == 3)
                                                                    $type_class = '<span class="oncall"></span>';
//                                                                $s_diff = $slote['time_to'] - $slote['time_from'];
                                                                $s_diff = $obj_customer->time_difference($slote['time_from'], $slote['time_to'], 100);
								$input_slote = array(
                                                                    'employee'  =>$EmpUname,
                                                                    'customer'  =>$slote['customer'], 
                                                                    'date'      =>$NewDate, 
                                                                    'time_from' =>$slote['time_from'], 
                                                                    'time_to'   =>$slote['time_to'], 
                                                                    'type'      =>$slote['type'], 
                                                                    'status'    =>$slote['status'], 
                                                                    'comment'   =>$slote['comment'], 
                                                                    'alloc_emp' =>$slote['alloc_emp'], 
                                                                    'relation_id'=>$slote['relation_id'],
                                                                    'fkkn'      =>$slote['fkkn']);
								
								$input_slote_date = array($NewDate);
									
								$WeekHtml .= '<a class="'.$class.'" style="width:106px;" >
								<div class="block_left_color">
								<span class="fkkn_type">
									'.$fkkn.'
								</span>
								<span class="color_code" style="background-color: '.$hex.';"></span>
								</div>
								<div class="single_sloat_detail" style="width:87px;" >
								<span class="customer_week_time">'.$slote['time_from'].'-'.$slote['time_to'].' ('.$s_diff.')</span>'.
                                                                $type_class.        
								'<span class="customer_used_item">';
								if($_SESSION['company_sort_by'] == 1)
                                                                    $WeekHtml .= '<span>'.(strlen($EmpFname.' '.$EmplName)>10?substr($EmpFname.' '.$EmplName, 0, 7).'...':$EmpFname.' '.$EmplName).'</span>';
								elseif($_SESSION['company_sort_by'] == 2)
                                                                    $WeekHtml .= '<span>'.(strlen($EmpFname.' '.$EmplName)>10?substr($EmplName.' '.$EmpFname, 0, 7).'...':$EmplName.' '.$EmpFname).'</span>';
								$WeekHtml .= '</span>
								</div>
								</a><input type="hidden" name="postdata[]" value="'.implode(",",$input_slote).'" ><input type="hidden" name="postdataDate[]" value="'.implode(",",$input_slote_date).'" >';
							 
						}
						$k++;
					 }else{
							 $WeekHtml .= '<a class="time_slot_btn_add" >'.$smarty->localise->contents['no_slot'].'</a>'; 
					  }
				  		if(($curr_date != $timeTableData) || $curr_date ==1){	 
								$WeekHtml .= '</div>';
						}
						$curr_date = $timeTableData;
						$i++; 	
			   }else{
				   
				   	 $WeekHtml .= '<div id="myid0" class="cstmr_wk_main customer_week" style="width:120px;" >
										<a class="customer_week_days" style="width:120px;">'.$smarty->localise->contents[$DaysName[date("D",strtotime($NewDate))]].'<br>'.$NewDate.'</a><a class="time_slot_btn_add"  href="javascript:void(0);">'.$smarty->localise->contents['no_slot'].'</a></div>';
				 }
				 
			}
			
			$WeekHtml .= '</div>
				</div>';
			$f++;
		}
				
		
		$save = '<div style="float: left; clear: both; margin-left: 287px; width: 445px;" >
			<a onclick="return showconfirmbox();" ><div style="cursor: pointer; float: left; margin-right:10px;" class="week_num">
			'.$smarty->localise->contents['save_schedule'].'</div></a>
			<a  href="'.$smarty->url.'use/schedule/templates/" 
			 ><div style="cursor: pointer; text-align: center; width: 169px; float: left; margin-right:10px;" class="week_num">
			'.$smarty->localise->contents['reset_schedule'].'</div></a>
                        <a onclick="return showconfirmdelete();" ><div style="cursor: pointer; float: left;" class="week_num">
			'.$smarty->localise->contents['delete_schedule'].'</div></a>     
		</div>
                <input type="hidden" name="action" id="action">
		 </form>';
		 
		 echo '<div id="tble_list" class="scroll_fix" style="width:866px;border:none;" >
		<input type="hidden" name="'.$customer.'showdiv" id="'.$customer.'showdiv" value="1" />
		<div id="tableDiv_General" class="tableDiv scroll_fix"  style="padding-left:5px;width:867px;" >
			<div class="week_strip clearfix">
				<div class="arrow_left">
					<a href="javascript:void(0);" onclick="nextprev(\'prev\',\''.$customer.'\');"></a>
				</div>'.$listr.'<div class="arrow_right"><a href="javascript:void(0);" onclick="nextprev(\'next\',\''.$customer.'\');" ></a></div>
			</div>'.$WeekHtml.$save.'
		</div>
	</div></form>';	
		
	exit;
} 
else if(!empty($ResultArray) && $map_with == 2){
	
	/* if $map_with == 2 than Start in template with start in schedule date */
	
	$DaysName = array("Mon"=>'monday',"Tue"=>'tuesday',"Wed"=>'wednesday',"Thu"=>'thursday',"Fri"=>'friday',"Sat"=>'saturday',"Sun"=>'sunday');
	$k =0;
	$WeekHtml .= '<input type="hidden" name="hdn_total" id="hdn_total" value="'.$cnt.'" />
					<input id="hdn_start" type="hidden" value="0" name="hdn_start">
					<input id="hdn_end" type="hidden" value="14" name="hdn_end">';
			$f = 0; 
				$i = 0;
				
			foreach($week_date as $curweek){
					$show ="";	
					if($curweek){
						if(!in_array($sdate, $curweek))	
						{
							$show = 'style="float:left;margin-left:8px;;border:1px solid #C6C6C6;display:none;"';	
						}
						else
						{
							$show = 'style="float:left;margin-left:8px;;border:1px solid #C6C6C6;"';	
						}	
					}
			
				$WeekHtml .= '<div id="'.$customer.$f.'" class="fixedArea" '.$show .' >
										<div id="slot_list_week" style="border:none;" >';
							
				$curr_date = '1';
				
				foreach($curweek as $timeTableData){	
				 
				// if($timeTableData == $start_date){ 
				 //	$start = 1; 
				// }
				
				  $NewDate = $timeTableData;

					 
					  
				  // if($start == 1 ){
					 	 $oldDate = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($old_stat_date)) . " +".$i." days")));	  
						  if(($curr_date != $timeTableData) || $curr_date ==1){	
						  
							$WeekHtml .= '<div id="myid0" class="cstmr_wk_main customer_week" style="border:1px solid #c6c6c6;width:120px;" >
									<a class="customer_week_days" style="width:120px;" >'.$smarty->localise->contents[$DaysName[date("D",strtotime($NewDate))]].'<br>'.$NewDate.'</a>';					
						  }
							$get_slote_per_date = $newcustomer->get_copy_slote_per_date($oldDate, $customer, $tid);
							 if(sizeof($get_slote_per_date) > 0 ){	
								foreach($get_slote_per_date as $slote){
									
									$EmpUname ='';												
									$EmpFname = '';
									$EmplName = ''; 
									$hex = "";
									$class="time_slot_incomplete";
									if($slote['employee'] != ''){
										//$err1 = $newcustomer->check_employee_expired($slote['employee']);
										$err1 = $newcustomer->check_employee_leave_customer($slote['employee'], $customer);
										$err2 = $newcustomer->check_leave_employee_to_template_set($slote['employee'],$NewDate,$slote['time_to']);
										$err3 = $newcustomer->check_employee_schedule_to_other_customer($slote['employee'], $slote['customer'], $NewDate,$slote['time_from'], $slote['time_to']);	
										$err_sum = $err1 + $err2 + $err3;
										
										if($err_sum == 0){
											$AvlEmpDetails = $newemployee->get_employee_detail($slote['employee']);	
											$EmpUname = $AvlEmpDetails['username'];												
											$EmpFname = $AvlEmpDetails['first_name'];
											$EmplName = $AvlEmpDetails['last_name']; 
											
											$hex = "#";
											$hex .= str_pad(dechex($AvlEmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
											$hex .= str_pad(dechex($AvlEmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
											$hex .= str_pad(dechex($AvlEmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
											$class="time_slot_btn";
										}
									}
									
									if($slote["fkkn"] == 1)
									{
										$fkkn = '<img src="'.$smarty->url.'images/icon_fk.gif">';
									}
									else
									{
										$fkkn = '<img src="'.$smarty->url.'images/icon_kn.gif">';
									}
                                                                        $type_class = '<span class="work"></span>';
                                                                        if($slote['type'] == 3)
                                                                            $type_class = '<span class="oncall"></span>';
//									$s_diff = $slote['time_to'] - $slote['time_from'];
                                                                        $s_diff = $obj_customer->time_difference($slote['time_from'], $slote['time_to'], 100);
									$input_slote = array(
                                                                            'employee'=>$EmpUname,
                                                                            'customer'=>$slote['customer'], 
                                                                            'date'=>$NewDate, 
                                                                            'time_from'=>$slote['time_from'], 
                                                                            'time_to'=>$slote['time_to'], 
                                                                            'type'=>$slote['type'], 
                                                                            'status'=>$slote['status'], 
                                                                            'comment'=>$slote['comment'], 
                                                                            'alloc_emp'=>$slote['alloc_emp'], 
                                                                            'relation_id'=>$slote['relation_id'],
                                                                            'fkkn'=>$slote['fkkn']);
									
									$input_slote_date = array($NewDate);	
									
									$WeekHtml .= '<a class="'.$class.'" style="width:106px;" >
									<div class="block_left_color">
									<span class="fkkn_type">
										'.$fkkn.'
									</span>
									<span class="color_code" style="background-color: '.$hex.';"></span>
									</div>
									<div class="single_sloat_detail" style="width:87px;">
									<span class="customer_week_time">'.$slote['time_from'].'-'.$slote['time_to'].' ('.$s_diff.')</span>'.
                                                                        $type_class.        
									'<span class="customer_used_item">';
									if($_SESSION['company_sort_by'] == 1)
                                                                            $WeekHtml .= '<span>'.(strlen($EmpFname.' '.$EmplName)>10 ? substr($EmpFname.' '.$EmplName, 0, 7).'...' : $EmpFname.' '.$EmplName).'</span>';
									elseif($_SESSION['company_sort_by'] == 2)
                                                                        $WeekHtml .= '<span>'.(strlen($EmpFname.' '.$EmplName)>10 ? substr($EmplName.' '.$EmpFname, 0, 7).'...' : $EmplName.' '.$EmpFname).'</span>';
									$WeekHtml .= '</span>
									</div>
									</a><input type="hidden" name="postdata[]" value="'.implode(",",$input_slote).'" ><input type="hidden" name="postdataDate[]" value="'.implode(",",$input_slote_date).'" >';
									
								}
							$k++;
							
						}else{
						
						 //$start = 1;
						 $WeekHtml .= '<a class="time_slot_btn_add"  >'.$smarty->localise->contents['no_slot'].'</a>';
						 	
						}
								
					  if(($curr_date != $timeTableData) || $curr_date ==1){	 
							$WeekHtml .= '</div>';
						}
					/*}else{
						
						// $start = 0;	
						 	$WeekHtml .= '<div id="myid0" class="customer_week" style="border:1px solid #c6c6c6;width:120px;" >
									<a class="customer_week_days" style="width:120px;" >'.$smarty->localise->contents[$DaysName[date("D",strtotime($NewDate))]].'<br>'.$NewDate.'</a><a class="time_slot_btn_add"  href="javascript:void(0);">'.$smarty->localise->contents['no_slot'].'</a></div>';
						 	
						}
							$curr_date = $timeTableData;*/
						$i++;
				}
			
			$WeekHtml .= '</div>
				</div>';
			$f++;
		}
				
			
		$save = '<div style="float: left; clear: both; margin-left: 287px; width: 445px;" >
			<a onclick="return showconfirmbox();" ><div style="cursor: pointer; float: left; margin-right:10px;" class="week_num">
			'.$smarty->localise->contents['save_schedule'].'</div></a>
			<a  href="'.$smarty->url.'use/schedule/templates/" 
			 ><div style="cursor: pointer; text-align: center; width: 169px; float:left; margin-right:10px;" class="week_num">
			'.$smarty->localise->contents['reset_schedule'].'</div></a>
                        <a onclick="return showconfirmdelete();" ><div style="cursor: pointer; float: left;" class="week_num">
			'.$smarty->localise->contents['delete_schedule'].'</div></a>   
		</div>
                <input type="hidden" name="action" id="action">
		 </form>';
		 
		 echo '<div id="tble_list" class="scroll_fix" style="width:866px;border:none;">
		<input type="hidden" name="'.$customer.'showdiv" id="'.$customer.'showdiv" value="1" />
		<div id="tableDiv_General" class="tableDiv scroll_fix"  style="padding-left:5px;width:867px;">
			<div class="week_strip clearfix">
				<div class="arrow_left">
					<a href="javascript:void(0);" onclick="nextprev(\'prev\',\''.$customer.'\');"></a>
				</div>'.$listr.'<div class="arrow_right"><a href="javascript:void(0);" onclick="nextprev(\'next\',\''.$customer.'\');" ></a></div>
			</div>'.$WeekHtml.$save.'
		</div>
	</div></form>';	
	//echo $html;	
	exit;

}
else{
	$html =  '<div id="timetable_assign" style="background:none repeat scroll 0 0 #FFFFFF;border:3px solid #D8D8D8; !important;!important; margin-left:8px !important; width:847px !important;height:14px;position:relative; ">							
	<div id="options" class="clearfix" style="border:none !important;position:relative;	">
	<span style="float:right; left:0px !important;  z-index:999999 !important; margin-left:-20px; margin-top:-7px; height:17px; width:19px; background:#daf2f7; color:red; cursor:pointer;vertical-align:middle;padding:1px 0px 0px 5px;" align="center" onclick="closeit();">&nbsp;X&nbsp;</span>	
		<div id="assigned_slots" style="position: absolute;border:none; top: 0px;text-align:center;font-weight:bold;width:90%;">
			'.$smarty->localise->contents['no_schedule_available'].'</div>
		</div>							
	</div></form>';
	
//End - Create Edit employee for slot POPUP	
echo $html;	
exit;
}
exit;
?>