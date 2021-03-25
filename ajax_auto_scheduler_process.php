<?php
//Rahul : ajax_auto_scheduler.php

require_once('class/setup.php');
//require_once('class/customer.php');
//require_once ('class/employee.php');
require_once('class/newcustomer.php');
require_once ('class/newemployee.php');
//require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml","user.xml"), FALSE);
$dateobj = new datecalc();
//$employee = new employee();
//$customer = new customer();
$newcustomer = new newcustomer();
$newemployee = new newemployee();
//$msg = new message();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
$name = $pram[$totparam-3];

$QueryStringHtml = '
<form name="autoscheduleform" method="post" action="">
<input type="hidden" name="ToDate" id="ToDate" value="'.$todate.'" />
<input type="hidden" name="FromDate" id="FromDate" value="'.$fromdate.'" />
<input type="hidden" name="Name" id="Name" value="'.$name.'" />';

if($fromdate == '0000-00-00')
{
	$fromdate = date('Y-m-d');
	$chunk_fromdate = explode('-',$fromdate);
	$FromDay	= $chunk_fromdate[2];
	$FromMonth	= $chunk_fromdate[1];
	$FromYear	= $chunk_fromdate[0];	
	$date = mktime(0, 0, 0, $FromMonth, $FromDay, 2012);
	$week = (int)date('W', $date); 		
}
else	
{
	$chunk_fromdate = explode('-',$fromdate);
	$FromDay	= $chunk_fromdate[2];
	$FromMonth	= $chunk_fromdate[1];
	$FromYear	= $chunk_fromdate[0];	
	$date = mktime(0, 0, 0, $FromMonth, $FromDay, 2012);
	$week = (int)date('W', $date); 	
}

//Get Max date from timetable
$MaxDate = $newcustomer->GetMaxScheduleDate();
//This is for set the max date as a todate when user not selected todate
if($todate >= $MaxDate || $todate == '0000-00-00')
{
	$todate = $MaxDate;
}
else
{
	//This condition is for break out the loop to ToDate
	$MaxDate = $todate;
}
$chunk_todate	= explode('-',$MaxDate);
$today = $chunk_todate[2];		
$tomonth = $chunk_todate[1];	
$toyear = $chunk_todate[0];		

$YearDiff = $MaxDate - $fromdate;
$years = $FromYear;
if($YearDiff > 0)
{
	for($y = 0 ; $y <= $YearDiff ; $y++)	
	{
		$YearArr[] = $years;
		$years++;	
	}
}
else
{
	$YearArr[] = $FromYear;
}
$YearsString = implode('|',$YearArr);

$diff = $dateobj->get_days($fromdate,$MaxDate);
$totWeeks = ceil(count($diff)/7)+1;	

$year_week = $YearsString.'|'.$week;
$week_position = 1;

$week_numbers = $dateobj->get_weeks_moreyears($year_week, $totWeeks, $week_position);


//Add Dates in week array
$cnt = 0;
$flag = 0;
foreach($week_numbers as $week_number)
{
	if($week_number['date'] > $MaxDate)
	{		
		break;	
	}
	
	$ts = strtotime($week_number['date']);
	$dow = date('w', $week_number['date']);
	$offset = $dow - 1;
	if ($offset < 0) 
	{
		$offset = 6;
	}
	for ($i = 0; $i < 7; $i++, $ts += 86400)
	{
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

$DaysName = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');

if($name == '-')
{
	$CustomerData = $newcustomer->GetAllCustomers();
}
else
{
	$CustomerData = $newcustomer->getcustomer($name);
}

//This is array For Storing all Auto Schedule Data
$AllAutoScheduleSlots = array();
foreach($CustomerData as $CustomerDetail)
{
	$WeekHtml = '';
	$listr = '';
	
	$listr .= '<ul class="weeks">';
	$showhidecounter = 0;
	$WeekHtml = '';
	foreach($week_numbers as $week_number)
	{			
		$daycounter = 0;
		$DayHtml = '';
		if(!empty($week_number['week']))
		{
			if($showhidecounter != 0)
			{
				$show = 'style="display:none;"';	
			}
			else
			{
				$show = '';	
			}
			
			$DayHtml .= '<div class="fixedArea clearfix" '.$show.' id="'.$CustomerDetail['username'].$showhidecounter.'">
			<div id="slot_list_week" class="cstmr_wk_main jspScrollable" style="overflow: hidden; padding: 0px; width: 882px;" tabindex="0">
				<div class="jspContainer" style="width: 882px; height: auto;"><div class="jspPane" style="padding: 0px; width: 870px; top: 0px;" >';
			foreach($week_number['week'] as $days)
			{
				$HoursArray = array();
				$MaxWorkingHours = array();
				$EmployeeTurnCounter = array();
				$GlobalSetting = $newcustomer->GetGlobalSetting();
				$GlobalTimeDiff = $GlobalSetting[0]['schedule_time_diff'];
				$GlobalTimeHours =  floor($GlobalTimeDiff/60);
				$GlobalTimeMinutes = $GlobalTimeDiff%60;
				$GlobalTimeHoursMinutes = (float)number_format($GlobalTimeHours.'.'.$GlobalTimeMinutes,2,'.','');	
						
				$GlobalMaxHours = $GlobalSetting[0]['emp_max_hours'];	
				$ChunkMaxHours = explode('.',$GlobalMaxHours);				
				$MaxHours = floor($ChunkMaxHours[0]*60)+$ChunkMaxHours[1];
				$GlobalMaxHours = $MaxHours;
				
				//Get customer slot from timetable
				$UserName = $CustomerDetail['username'];					
				$CustomerSlot = $newcustomer->GetCustomerDateSlot($UserName,$days);
				$EmpAssignFulldayName='';
				$EmpAssignHalfdayName='';
				$CustomerSlotHtml = '';
				if(count($CustomerSlot) > 0)
				{	
					foreach($CustomerSlot as $SlotDetail)
					{
						
						
						$Slot_Id = $SlotDetail['id'];
						$TimeDifference = $SlotDetail['timediff'];						
						$TimeFrom = $SlotDetail['time_from'];
						$SlotType = $SlotDetail['type'];
						
						if($TimeFrom == '')
						{
							$TimeFrom = 0.00;	
						}
						$TimeTo = $SlotDetail['time_to'];
						if($TimeTo == 0)
						{
							$TimeTo = 0.00;
						}
						
						//Convert SlotHours to Minutes
						$ConvertDiffToMinutes = explode('.',$TimeDifference);
						$SlotMinutes = ($ConvertDiffToMinutes[0]*60)+$ConvertDiffToMinutes[1];
						//Skip Employee if Slot wroking hours more than 900 Minutes (15 Hours)
						// Rest Fro day Minimum 9 hours so 
						/*if($SlotMinutes >= 900)
						{
							//Skip Timeslot set it as blank
							$inputHtml = '';
							$hex = '';
							continue;
						}
						else
						{*/ 
							$EmployeeList = $newcustomer->GetCustEmployeesList($CustomerDetail['username']);
							
							if(empty($EmployeeList))
							{
								echo '<div align="center" style="color:red;">'.$smarty->localise->contents["no_employee_for_customer"].'</div>';
								exit;
							}
							//START - Create Edit employee for slot POPUP
							/*echo '<div id="timetable_assign" style="background:none repeat scroll 0 0 #FFFFFF;border:5px solid #D8D8D8;min-height:200px !important;top:200px; !important; position:absolute !important; left:700px !important; width:310px !important;overflow-x:hidden;overflow-y:scroll; z-index:99999; ">	
											
								<div id="options" class="clearfix" style="border:none !important;">
									<span style="float:left; left:0px !important; position:absolute; z-index:999999 !important; margin-left:-3px; margin-top:-10px; height:15px; width:15px; background:#94CCD9; color:red; " align="center" id="closeit">&nbsp;X</span>	
									<div id="assigned_slots" style="position: absolute; top: 5px;">
										<div class="option_head">Minnespass</div>';
										if(count($EmployeeList) > 0)
										{
											foreach($EmployeeList As $CustEmployee)
											{
												$EmpDetails = $newemployee->get_employee_detail($CustEmployee);	
												$hex = "#";
												$hex .= str_pad(dechex($EmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
												$hex .= str_pad(dechex($EmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
												$hex .= str_pad(dechex($EmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
																								
												echo '<div id="add_new_slot" class="ui-droppable">
													<a href="javascript:void(0);" onclick="hideemployee(\''.$EmpDetails['first_name'].' '.$EmpDetails['last_name'].'\',\''.$hex.'\',\''.$EmpDetails['username'].'\')">'.$EmpDetails['first_name'].' '.$EmpDetails['last_name'].'</a>
													</div>';
											}
										}
										echo'</div>
									</div>							
								</div>';*/
							//End - Create Edit employee for slot POPUP							
							
							if(count($EmployeeList) > 0)
							{
								//Check In timetable for availability for date and time 
								$UnAvailableEmployees = $newemployee->Check_Employee_UnAvailability_For_DateAndTime($EmployeeList,$days,$TimeFrom,$TimeTo,$CustomerDetail['username']);
								if(count($UnAvailableEmployees) > 0)
								{
									//Remove unavailable employee from array and reset array index
									$AvailableEmployees =  array_values(array_diff($EmployeeList, $UnAvailableEmployees));	
								}
								else
								{
									$AvailableEmployees =  $EmployeeList;	
								}
								//Create Minutes array for available employee for check max hours working 
								$AvailableEmpCount = count($AvailableEmployees);
														
								for($hourscounter = 0 ; $hourscounter < $AvailableEmpCount; $hourscounter++)
								{
									$HoursArray[] = 900;
									$EmployeeTurnCounter[$AvailableEmployees[$hourscounter]][] = 0;									
										
									$AvailableEmpUnm = $AvailableEmployees[$hourscounter];
									//Check For employee Max hours else set it as a global Hours
									$EmpMaxHours = $newemployee->Get_Employee_Max_Hours($AvailableEmpUnm);
									if($EmpMaxHours > 0)
									{
										$chunkmax = explode('.',$EmpMaxHours);
										$chunkMinutes = ($chunkmax[0]*60)+$chunkmax[1];
										$MaxWorkingHours[] = $chunkMinutes;
									}
									else
									{
										$MaxWorkingHours[] = $GlobalMaxHours;
									}	
											
								}
																
								/*echo "<pre>";
								print_r($AvailableEmployees);	print_r($MaxWorkingHours);	
								exit;*/
								
								if($AvailableEmpCount > 0)
								{
									for($EachEmpCounter = 0 ; $EachEmpCounter < $AvailableEmpCount; $EachEmpCounter++)
									{										
										$AvailableEmpUnm = $AvailableEmployees[$EachEmpCounter];
										
										//Check Leave for employee
										$EmpLeaveData = $newemployee->Check_Emp_Leave($AvailableEmpUnm,$days);											
										if(!empty($EmpLeaveData))
										{
											for($leaveCounter = 0 ; $leaveCounter < count($EmpLeaveData) ; $leaveCounter++)
											{												
												if($EmpLeaveData[$leaveCounter]['time_from'] <= $TimeTo && $TimeTo <= $EmpLeaveData[$leaveCounter]['time_to'])
												{
													$LeaveCheckFlag = 0;	
												}
											}
											if(!isset($LeaveCheckFlag))
											{
												$LeaveCheckFlag = 1;
											}
										}
										else
										{
											$LeaveCheckFlag = 1;
										}
										if($LeaveCheckFlag == 0)
										{
											continue;	
										}
										
										//Get Preferred Time slot for the date
										$PrefferedTime = $newemployee->Check_Emp_PreferredTime($AvailableEmpUnm,$days);
										$CountPreferredTime = count($PrefferedTime);
										
										if($CountPreferredTime > 0)
										{
												
											/*if($days == '2012-08-06' && $EachEmpCounter == 1)
											{
												echo $AvailableEmpUnm;
												print_r($PrefferedTime);
											}*/
											$PreferredTimeSlot = $PrefferedTime[0]['preferredtime'];
											$ChunkPrefTime = explode(',',$PreferredTimeSlot);
											$CntChunk = count($ChunkPrefTime);
											for($count = 0 ; $count < $CntChunk ; $count++)
											{
												$PrefChunk = explode('-',$ChunkPrefTime[$count]);
												for($HourTimeCounter = 0 ; $HourTimeCounter < count($PrefChunk) ; $HourTimeCounter++)
												{
													$HourMinutes = $PrefChunk[$HourTimeCounter];
													$PrefHours = substr($HourMinutes,0,2);
													$PerfMinus = substr($HourMinutes,2,4);
													$ConvertToHrsMin[$HourTimeCounter] = $PrefHours.'.'.$PerfMinus;
												}
												
												/*if($days == '2012-08-06' && $EachEmpCounter == 1)
												{
													echo "<br>";
													echo $TimeFrom.'  '.$TimeTo;
													echo $ConvertToHrsMin[0].'  '.$ConvertToHrsMin[1];
													echo "<br>";
												}*/
											
																				
												if($TimeFrom >= $ConvertToHrsMin[0] && $TimeTo <= $ConvertToHrsMin[1])
												{
													$PreferredTimeCheck = 1;
												}
												else
												{
													$PreferredTimeCheck = 0;
												}
											}
											$Overtime = $PrefferedTime[0]['overtime'];	
										}
										else
										{
											$PreferredTimeCheck = 1;
											$Overtime = 0;
										}
																				
										/*if($days == '2012-08-06' && $EachEmpCounter == 1)
										{
											echo $PreferredTimeCheck;
											echo "<br>";
											echo $CountPreferredTime;
											exit;
										}*/
										/*echo $PreferredTimeCheck;
										exit;*/
										
										if($PreferredTimeCheck == 0)
										{
											//Skeep Employee
											continue;	
										}												
										
										//Check for previous schedule if there is no previous scheuld for this day then look for yesterdaty's scheudle
										$GetPreviousSchedule = $newemployee->Get_Previous_Schedule_of_Employee($AvailableEmpUnm,$days,$TimeFrom,$EmployeeTurnCounter[$AvailableEmpUnm][0],$CustomerDetail['username'],$SlotDetail['id']);
										
										$GetTomorrowSchedule = $newemployee->Get_tomorrow_Schedule_of_Employee($AvailableEmpUnm,$days,$TimeFrom,$EmployeeTurnCounter[$AvailableEmpUnm][0],$CustomerDetail['username'],$SlotDetail['id']);
										
										/*if($days == '2012-08-06' && $SlotDetail['id'] == '1627')
										{
											echo "in";
											echo "<pre>";
											echo $AvailableEmpUnm;
											echo "<br>";
											echo $EmployeeTurnCounter[$EachEmpCounter];
											echo "<br>";
											print_r($GetPreviousSchedule);
											
											exit;
										}*/
										
										/*if($days == '2012-08-06' && $EachEmpCounter == 1 && $EmployeeTurnCounter[$EachEmpCounter] > 0)
										{
											echo "<pre>";
											print_r($GetPreviousSchedule);
											
											
											
										}*/
										
										//Skip Employee if there are two shceule in table with same time for customer 
										//When employee come 1st time allocate slot for the second time allocate other employee
										if($GetPreviousSchedule['skip'] == 1)
										{											
											continue;	
										}
										
										if($GetPreviousSchedule['today']['totalMinutes'] != '')
										{
											$PreviousTaskTotMinutes = $GetPreviousSchedule['today']['totalMinutes'];
										}
										else if($GetPreviousSchedule['yesterday']['totalMinutes'] != '')
										{
											$PreviousTaskTotMinutes = $GetPreviousSchedule['yesterday']['totalMinutes'];
										}
										else
										{
											$PreviousTaskTotMinutes = 0;
										}																	
									
										
										
										if($PreviousTaskTotMinutes <= $MaxWorkingHours[$EachEmpCounter] && $PreviousTaskTotMinutes <= 900)
										{
											$SumOfTimeDiff  = $TimeFrom+$GlobalTimeHoursMinutes;												
											
											if($GetPreviousSchedule['yesterday']['time_to'] == '' && $GetPreviousSchedule['today']['time_to'] == '')
											{
												$TimeDiffCheck = 1;
											}
											else if(($GetPreviousSchedule['yesterday']['time_to'] != '' && $GetPreviousSchedule['yesterday']['time_to'] > $SumOfTimeDiff) || ($GetPreviousSchedule['today']['time_to'] != '' && $GetPreviousSchedule['today']['time_to'] < $SumOfTimeDiff))												
											{
												$TimeDiffCheck = 1;
												
											}else
											{
												$TimeDiffCheck = 0;
											}
										}
										else
										{
												$TimeDiffCheck = 1;
										}												
										
										if($TimeDiffCheck == 0)
										{
											continue;
										}
										//Check For Max Working Hours 900 As Per LAW
										
										if($HoursArray[$EachEmpCounter] >= $SlotMinutes && $SlotDetail["timediff"] < 15)
										{  
											///Check For Maximum hours set in global setting or employee setting
											$AvlEmpDetails = $newemployee->get_employee_detail($AvailableEmpUnm);											
											if(($MaxWorkingHours[$EachEmpCounter] >= $SlotMinutes || $Overtime == 1) && $GetPreviousSchedule['yesterday']['time_to'] <= 15 && $EmpAssignFulldayName != $AvlEmpDetails['username'])
											{		
											
												//Set Slot type = 9 if there is overtime for an employee
												if($MaxWorkingHours[$EachEmpCounter] < $SlotMinutes && $Overtime == 1)
												{
													$SlotType = 9;
												}
																						
												
												
												/*print_r($AvlEmpDetails);
												exit;*/
												$hex = "#";
												$hex .= str_pad(dechex($AvlEmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
												$hex .= str_pad(dechex($AvlEmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
												$hex .= str_pad(dechex($AvlEmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
												
												$HoursArray[$EachEmpCounter] = $HoursArray[$EachEmpCounter] - $SlotMinutes;
												$MaxWorkingHours[$EachEmpCounter] = $MaxWorkingHours[$EachEmpCounter] - $SlotMinutes;
												$EmployeeTurnCounter[$AvailableEmpUnm][0] = $EmployeeTurnCounter[$AvailableEmpUnm][0]+1;
												
												$EmpAssignHalfdayName = $AvlEmpDetails['username'];
												$EmpUname = $AvlEmpDetails['username'];												
												$EmpFname = $AvlEmpDetails['first_name'];
												$EmplName = $AvlEmpDetails['last_name']; 
												//$inputHtml = '<input type="text" name="" id="" value="'.$EmpFname.' '.$EmplName.'" style="width:50px;" />';
												//$inputHtml = $EmpFname.' '.$EmplName;
												
                                                                                                if($_SESSION['company_sort_by'] == 1)
                                                                                                    $inputHtml = ''.$EmpFname.','.$EmplName.'</span><span><input type="hidden" name="emp[]" id="emp'.$Slot_Id.'" value="'.$Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType.'" style="width:50px;" />';							
												elseif($_SESSION['company_sort_by'] == 2)
                                                                                                    $inputHtml = ''.$EmplName.','.$EmpFname.'</span><span><input type="hidden" name="emp[]" id="emp'.$Slot_Id.'" value="'.$Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType.'" style="width:50px;" />';							
												
												$AllAutoScheduleSlots['emp'][] = $Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType;
												break;
											}
											else
											{
												$inputHtml = '</span><span><input type="hidden" name="emp[]" id="emp'.$Slot_Id.'" value="'.$Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType.'" style="width:50px;" />';	
												$AllAutoScheduleSlots['emp'][] = $Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType;
												//Skeep Employee
												continue;	
											}	
									/* more than 15 hr slot assign */		
									// employee not working on previous day and yesterday and time schedule need more than 15 Hr than assign this employee												
										}else if($SlotDetail["timediff"] >= 15 && $PreviousTaskTotMinutes == 0
											&& $GetPreviousSchedule['tomorrow']['time_to'] == ''){
												$AvlEmpDetails = $newemployee->get_employee_detail($AvailableEmpUnm);
												if(($MaxWorkingHours[$EachEmpCounter] >= $SlotDetail["timediff"] || $Overtime == 1) && $EmpAssignHalfdayName != $AvlEmpDetails['username'])
												{	
											
														//Set Slot type = 9 if there is overtime for an employee
														if($MaxWorkingHours[$EachEmpCounter] < $SlotDetail["timediff"] && $Overtime == 1)
														{
															$SlotType = 9;
														}
																								
														
														
														/*print_r($AvlEmpDetails);
														exit;*/
														$hex = "#";
														$hex .= str_pad(dechex($AvlEmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
														$hex .= str_pad(dechex($AvlEmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
														$hex .= str_pad(dechex($AvlEmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
														
														$HoursArray[$EachEmpCounter] = $HoursArray[$EachEmpCounter] - $SlotMinutes;
														$MaxWorkingHours[$EachEmpCounter] = $MaxWorkingHours[$EachEmpCounter] - $SlotMinutes;
														$EmployeeTurnCounter[$AvailableEmpUnm][0] = $EmployeeTurnCounter[$AvailableEmpUnm][0]+1;
														$EmpAssignFulldayName  = $AvlEmpDetails['username'];
														$EmpUname = $AvlEmpDetails['username'];												
														$EmpFname = $AvlEmpDetails['first_name'];
														$EmplName = $AvlEmpDetails['last_name']; 
														//$inputHtml = '<input type="text" name="" id="" value="'.$EmpFname.' '.$EmplName.'" style="width:50px;" />';
														//$inputHtml = $EmpFname.' '.$EmplName;
														
														$inputHtml = ''.$EmpFname.','.$EmplName.'</span><span><input type="hidden" name="emp[]" id="emp'.$Slot_Id.'" value="'.$Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType.'" style="width:50px;" />';							
														
														$AllAutoScheduleSlots['emp'][] = $Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType;											
														break;
												}
												else
												{
													$inputHtml = '</span><span><input type="hidden" name="emp[]" id="emp'.$Slot_Id.'" value="'.$Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType.'" style="width:50px;" />';	
													$AllAutoScheduleSlots['emp'][] = $Slot_Id.','.$EmpUname.','.$EmpFname.','.$EmplName.','.$SlotType;
													//Skeep Employee
													continue;	
												}
										  // end here //
										
										}
										else
										{  
											$inputHtml = '</span><span><input type="hidden" name="emp[]" id="emp'.$Slot_Id.'" value="'.$Slot_Id.',,,,'.$SlotType.'" style="width:50px;" />';	
											$AllAutoScheduleSlots['emp'][] = $Slot_Id.',,,,'.$SlotType;
											$hex = '';
											//Skip Employee 
											continue;	
										}
									}									
								}
							}
							else
							{
								//Skip Timeslot set it as blank
								//$inputHtml = '';
								//$hex = '';
								continue;	
							}
						//}						
						
						if($SlotDetail["fkkn"] == 1)
						{
							$fkkn = '<img src="'.$smarty->url.'images/icon_fk.gif">';
						}
						else
						{
							$fkkn = '<img src="'.$smarty->url.'images/icon_kn.gif">';
						}	
						
						$status_class = 'time_slot_btn';
                                                if($SlotDetail['status'] == 0)
                                                    $status_class = 'time_slot_incomplete';
                                                $type_class = '<span class="work"></span>';
                                                if($SlotDetail['type'] == 3)
                                                    $type_class = '<span class="oncall"></span>';
						$CustomerSlotHtml .= "
						<a class='".$status_class."' onclick='showemployee(".$Slot_Id.",".json_encode($AvailableEmployees).",\"".$AvailableEmpUnm."\")' href='javascript:void(0);'>
						<div class='block_left_color'>
						<span class='fkkn_type'>
						".$fkkn."
						</span>
						<span class='color_code' id='color".$Slot_Id."' style='background-color: ".$hex.";'></span>
						</div>
						<div class='single_sloat_detail'>
						<span class='customer_week_time'>".$SlotDetail["time_from"]."-".$SlotDetail["time_to"]." (".$SlotDetail["timediff"].")</span>".
                                                $type_class.          
						"<span class='customer_used_item'>
						<span id='div".$Slot_Id."'>".$inputHtml."</span>						
						</span>
						</div>
						</a>";						
							
					}
				}
				else
				{
				$CustomerSlotHtml = '<a class="time_slot_btn_add" onclick="loadPopupProcess()" href="javascript:void(0);">No Slot</a>';
				}
									
				$DayHtml .='<div class="customer_week" id="myid'.$showhidecounter.'">
				<a class="customer_week_days" onclick="loadPopup()" href="javascript:void(0);">'.$smarty->localise->contents[$DaysName[$daycounter]].'<br>'.$days.'</a>					
				'.$CustomerSlotHtml.'
				</div>';
								
				/*if($days == '2012-08-06')
				{
					echo $DayHtml;
					//echo print_r($MaxWorkingHours);
					//echo $DayHtml;
					exit;	
				}*/
				
			$daycounter++;
			}
			$DayHtml .= '</div>
			</div>
			</div>
		</div>';
					
		}	
		$WeekHtml .=	$DayHtml;
		if($week_number['date'] > $MaxDate)
		{		
			break;	
		}
		if($showhidecounter > 14)
		{
			$MyStyle = 'style="display:none;"';
		}
		else
		{
			$MyStyle = '';	
		}
			
		if($week_number['selected'] ==  1)	
		{
			$listr .= '<li '.$MyStyle.' id="'.$CustomerDetail['username'].'class'.$showhidecounter.'" class="active" onclick="showhide('.$cnt.','.$showhidecounter.',\''.$CustomerDetail['username'].'\')"><a href="javascript:void(0);">'.$week_number["value"].'</a></li>';
		}
		else
		{
			$listr .= '<li '.$MyStyle.' id="'.$CustomerDetail['username'].'class'.$showhidecounter.'" onclick="showhide('.$cnt.','.$showhidecounter.',\''.$CustomerDetail['username'].'\')"><a href="javascript:void(0);">'.$week_number["value"].'</li>';	
		}
	$showhidecounter++;
	}
	$listr .= '</ul>';
		


	$FullHtml .= '<div class="block_head">';
        if($_SESSION['company_sort_by'] == 1)
            $FullHtml .=	'<span class="titles_tab"> '.$CustomerDetail["first_name"].' '.$CustomerDetail["last_name"].' ('.$CustomerDetail["username"].') </span>';		
        elseif($_SESSION['company_sort_by'] == 2)
	$FullHtml .=	'<span class="titles_tab"> '.$CustomerDetail["last_name"].' '.$CustomerDetail["first_name"].' ('.$CustomerDetail["username"].') </span>';		
	$FullHtml .= '</div>
	<div id="tble_list" class="scroll_fix">
		<input type="hidden" name="'.$CustomerDetail["username"].'showdiv" id="'.$CustomerDetail["username"].'showdiv" value="0" />
		<div id="tableDiv_General" class="tableDiv scroll_fix">
			<div class="week_strip clearfix">
				<div class="arrow_left">
					<a href="javascript:void(0);" onclick="nextprev(\'prev\',\''.$CustomerDetail["username"].'\');"></a>
				</div>'.$listr.'<div class="arrow_right"><a href="javascript:void(0);" onclick="nextprev(\'next\',\''.$CustomerDetail["username"].'\');" ></a></div>
			</div>
			'.$WeekHtml.'               
		</div>
	</div><div id="whitebg" class="ui-widget-overlay" style="width: 1583px; height: 830px; z-index: 1001; display:none;"></div>';
}	

$AutoschedulerArray = $AllAutoScheduleSlots['emp'];
// Insert data in temp table 
if(count($AutoschedulerArray) > 0)
{
	
echo $ContetnHtml = 
//$QueryStringHtml.$FullHtml.'<input type="hidden" name="hdn_autoschedule" id="hdn_autoschedule" value="1" /><div style="width:300px; margin:2px auto;"><div class="week_num" style="float:left; cursor:pointer;" onclick="document.autoscheduleform.submit();"><a href="javascript:void(0);" style="cursor:pointer;">'.$smarty->localise->contents['save'].'</a></div>'.'<div class="week_num" style="float:right; cursor:pointer;" onclick=""><a href="javascript:void(0);" style="cursor:pointer;">'.$smarty->localise->contents['cancel'].'</a></div></div>'.'<input type="hidden" name="hdn_total" id="hdn_total" value="'.$cnt.'" /></form>';

$QueryStringHtml.$FullHtml.'<input type="hidden" name="hdn_autoschedule" id="hdn_autoschedule" value="1" /><div style="width:300px; margin:2px auto;"><div class="week_num" style="float:left; cursor:pointer;" onclick="showconfirmbox();"><a href="javascript:void(0);" style="cursor:pointer;">'.$smarty->localise->contents['save'].'</a></div>'.'<div class="week_num" style="float:right; cursor:pointer;" onclick=""><a href="javascript:void(0);" onclick="adddata();" style="cursor:pointer;">'.$smarty->localise->contents['cancel'].'</a></div></div>'.'<input type="hidden" name="hdn_total" id="hdn_total" value="'.$cnt.'" /></form>';

/*echo "<pre>";
print_r($AllAutoScheduleSlots['emp']);
exit;*/

	//Truncate temp Timetable 
	$TruncTempTimetable = $newemployee->TruncateTempTimetable();
	$insertflag = 0;	
	foreach($AutoschedulerArray as $schedule)
	{
		
		$ChunkData = explode(',',$schedule);
		$Timetable_Id			= $ChunkData[0];
		$Timetable_Employee		= $ChunkData[1];
		$Timetable_Fname		= $ChunkData[2];
		$Timetable_Lname		= $ChunkData[3];	
		$Timetable_Type			= $ChunkData[4];	
				
		//$UpdateSchedule = $employee->UpdateTimetable($Timetable_Id,$Timetable_Employee,$Timetable_Fname,$Timetable_Lname);
		
		if($TruncTempTimetable)
		{
			//Insert into temp timetable 
			$InsertTempTimetable = $newemployee->InsertTempTimetable($Timetable_Id,$Timetable_Employee,$Timetable_Fname,$Timetable_Lname,$Timetable_Type);
		}
		$insertflag = 1;
	}		
}
exit;