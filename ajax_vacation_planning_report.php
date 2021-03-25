<?php
require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once ('plugins/date_calc.class.php');
//require_once('class/equipment.php');
//require_once('class/newemployee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
$customer = new newcustomer();
$date = new datecalc();
//$equipment = new equipment();
//$employee = new newemployee();
//echo "<pre>". print_r($emp->employees_list_for_right_click($_SESSION['user_id']), 1)."</pre>";
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
$name = str_replace('_',' ',$pram[$totparam-3]);

$Cust_Details = $customer->getcustomer($name);
$Cust_Username = $Cust_Details[0]['username'];

$ssnhtml = '<div class="row-fluid"><div class="pagention span12">            
<span style="margin:7px; float:left;"><b>'.$smarty->localise->contents['SSN'].' : </b>'.$Cust_Social_No.' <b>'.$smarty->localise->contents['address'].' : </b> '.$Cust_Address.'</span>
</div></div>';

$year = date('o',strtotime($fromdate));

$chunk_fromdate	= explode('-',$fromdate);
$fromday = $chunk_fromdate[2];		
$frommonth = $chunk_fromdate[1];	
//$fromyear = $chunk_fromdate[0];		
$fromyear = date('o',strtotime($fromdate));

$chunk_todate	= explode('-',$todate);
$today = $chunk_todate[2];		
$tomonth = $chunk_todate[1];	
$toyear = $chunk_todate[0];		

$YearDiff = $toyear - $fromyear;
$years = $year;
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
	$YearArr[] = $years;
        if(date('W', strtotime($todate)) == "01" && date('m', strtotime($todate)) == "12"){
            $YearArr[] = $years+1;
        }
}

//echo "<pre>".print_r($YearArr,1)."</pre>";
//if($fromday == '01' && $frommonth == '01')
//{
//	$tomorrow = mktime(0,0,0,$frommonth,$fromday+1,$fromyear);
//	$fromdate = date("Y-m-d", $tomorrow);
//}
echo $htmlcontent ='<div class="row-fluid"><div class="span12"><table class="table_list tbl_padding_fix" style="width:100%">';

$weeks = array();
$startTime = strtotime($fromdate);
$endTime = strtotime($todate);
if(date('N',$startTime) != 1){
    $weeks[] = date('W',$startTime);
    $next_week_start_day = 7-date('N',$startTime)+1;
    $startTime = strtotime($fromdate . "+".$next_week_start_day." days");
}
while ($startTime < $endTime) {  
    $weeks[] = date('W', $startTime); 
    $startTime += strtotime('+1 week', 0);
}
$TotalWeek = count($weeks);
//echo "<pre>".print_r($weeks,1)."</pre>";
global $week;
$yearcnt = 0;
for($weekcounter = 0 ; $weekcounter < $TotalWeek; $weekcounter++)
{
	$weekNo = $weeks[$weekcounter];
	$Total_schedule_Final = '';
	$week_no = sprintf("%02d", $weekNo);	
	
	$i = 0;
	
	foreach ($week as $day) 
	{	
		$Total_schedule_Final = '';
		$datas[$weekcounter][$i]['day'] = $day;		
		$date = date("Y-m-d", strtotime($YearArr[$yearcnt] . 'W' . $week_no . $day['id']));
		$datas[$weekcounter][$i]['date'] = $date;
                if(strtotime($date) <= $endTime){
                    $Employee_Schedules = 	$customer->get_employee_schedule_by_customer($Cust_Username,$date);	
                    $Employee_Leaves = 	$customer->get_employee_leave_by_customer($Cust_Username,$date);

                    $datas[$weekcounter][$i]['slots1'] = $Employee_Schedules;
                    $datas[$weekcounter][$i]['slots2'] = $Employee_Leaves;
                    $i++;
                }else{
                    $i++;
                }
	}
	if($weekNo == 52)
	{
		$yearcnt++;
	}
}


for($WeekCounter = 0; $WeekCounter < count($datas); $WeekCounter++)
{
	$Empcounter = 0;
	$Leavecounter = 0;
	$EmpCompare = '';
	$Weekarray[$WeekCounter] .="<tr><td colspan='9' style='border:none !important;'>&nbsp;</td></tr>";
	$Weekarray[$WeekCounter] .="<tr class='odd'  >";
	$Weekarray[$WeekCounter] .='<th width="231" align="center" style="word-wrap:normal; white-space:normal;">'.$smarty->localise->contents['week'].' '.$weeks[$WeekCounter].'</th>';	
	for($DayCounter = 0; $DayCounter<count($datas[$WeekCounter]); $DayCounter++)
	{
		$Employeearray = array();
		//$datas[$weekcounter][$i]['slots1']
		$label = $datas[$WeekCounter][$DayCounter]['day']['label'];
		$date = $datas[$WeekCounter][$DayCounter]['date'];
		$Weekarray[$WeekCounter] .='<th width="80" align="center" >'.$smarty->localise->contents[$label].'<br>'.$date.'</th>';	
		
		//Start  - Count Schedule Hours array
		$count_Each_employee = count($datas[$WeekCounter][$DayCounter]['slots1']);
		//echo "week ".$WeekCounter." (".$DayCounter.") (".$count_Each_employee.") <br>";
		if($count_Each_employee  > 0)
		{
			for($EmployeeCounter = 0 ; $EmployeeCounter < $count_Each_employee ; $EmployeeCounter++)	
			{
				$Employee_Username 	= $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['employee'];
                                if($_SESSION['company_sort_by'] == 1){
                                    $Employee_Fullname	= $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['empname_ff'];
                                } elseif($_SESSION['company_sort_by'] == 2)
                                    $Employee_Fullname	= $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['empname'];
				$Schedule_Time_From = $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['time_from'];
				$Schedule_Time_To = $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['time_to'];
				$Schedule_Mins_Tot	= $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['totalMinutes'];
				
				if($Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['show'] == $DayCounter && $Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['empfullname'] == $Employee_Fullname)
				{
					$Employeedata[$WeekCounter][$Empcounter]['empfullname']= $Employee_Fullname;
					$Employeedata[$WeekCounter][$Empcounter]['empusername']= $Employee_Username;			
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['empfullname'] = $Employee_Fullname;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['time'] .= '<br>'.$Schedule_Time_From.' - '.$Schedule_Time_To;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['totmins'] += $Schedule_Mins_Tot;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['date'] .= '<br>'.$date;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['show'] = $DayCounter;	
				}
				else
				{
					$Employeedata[$WeekCounter][$Empcounter]['empfullname']= $Employee_Fullname;
					$Employeedata[$WeekCounter][$Empcounter]['empusername']= $Employee_Username;					
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['empfullname'] = $Employee_Fullname;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['time'] = $Schedule_Time_From.' - '.$Schedule_Time_To;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['totmins'] = $Schedule_Mins_Tot;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['date'] = $date;
					$Employeedata[$WeekCounter][$Employee_Username][$DayCounter]['show'] = $DayCounter;	
					$Empcounter++;
				}
			}
		}
		//End  - Count Schedule Hours array	
	
		//Start - Leave Hours calculation array
		
				
		$Leavedata[$WeekCounter][] = $datas[$WeekCounter][$DayCounter]['slots2'];
		
			
	}
	$Leavecounter_array[] = $Leavecounter;	
	$Empcounter_array[] = $Empcounter;	
	$Weekarray[$WeekCounter] .= "<th align='center'>".$smarty->localise->contents['total']."</th>";
	$Weekarray[$WeekCounter] .= "</tr>";
}
for($Showweek_Counter = 0 ; $Showweek_Counter < count($Weekarray); $Showweek_Counter++ )
{
	echo $Weekarray[$Showweek_Counter];
	
	$EmployeeArray = array();	
	if($Empcounter_array[$Showweek_Counter] > 0)
	{
		for($Showemployee_Counter = 0 ; $Showemployee_Counter < $Empcounter_array[$Showweek_Counter] ; $Showemployee_Counter++)
		{		
			$EmployeeName = $Employeedata[$Showweek_Counter][$Showemployee_Counter]["empfullname"];
			$EmployeeUsername = $Employeedata[$Showweek_Counter][$Showemployee_Counter]["empusername"];
			if(!in_array($EmployeeUsername,$EmployeeArray))
			{
				$EmployeeArray[] = $EmployeeUsername;
			}
			else
			{
				continue;	
			}
					
			echo '<tr class="odd">';
			echo '<td align="left">&nbsp;'.$EmployeeName.'</td>';		
			$Day_TotalMinutes = 0;
			for($daycnt = 0 ; $daycnt < 7 ; $daycnt++)
			{
					$Time = $Employeedata[$Showweek_Counter][$EmployeeUsername][$daycnt]['time'];
					if($Time != '')
					{					
						$Day_TotalMinutes += $Employeedata[$Showweek_Counter][$EmployeeUsername][$daycnt]['totmins'];									
						echo '<td align="center">'.$Time.'	</td>';
					}
					else
					{
						echo '<td align="center">--</td>';
					}
			}
			
			if($Day_TotalMinutes > 0)
			{
				$Total_Hrs = floor($Day_TotalMinutes/60);
				$Total_Minutes = $Day_TotalMinutes%60;
				$Total_Hrs_Minutes	= number_format($Total_Hrs.'.'.$Total_Minutes,2,'.','');	
				echo '<td align="center">'.$Total_Hrs_Minutes.'</td>';
			}
			else
			{
				echo '<td align="center">--</td>';
			}
			echo '</tr>';
		}
	}
	else
	{
		echo"<tr class='odd' align='center'><td colspan='9'><b>".$smarty->localise->contents['no_record_found']."</b></td></tr>";
	}
	//echo "<pre>";
	//echo "<br>";
	//print_r($Leavedata[$Showweek_Counter]);
	$Mydata = array();
	$Myemployee = array();
//        echo "<pre>". print_r($Leavedata, 1)."</pre>";
	for($DayCnt = 0 ; $DayCnt < 7 ; $DayCnt++)
	{
		//print_r($Leavedata[$Showweek_Counter][$DayCnt]);
		
			
			if(count($Leavedata[$Showweek_Counter][$DayCnt]) > 0 )
			{
				for($reccnt = 0; $reccnt < count($Leavedata[$Showweek_Counter][$DayCnt]) ; $reccnt++)	
				{
					if(!in_array($Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['employee'],$Mydata))
					{
						$Leave_Type = $Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['type'];
						
						if($Leave_Type == 1)		
						{
							$Leave_Type_Text = 'Sjuk';
						}
						else if($Leave_Type == 2)		
						{
							$Leave_Type_Text = 'Sem';
						}
						else if($Leave_Type == 3)		
						{
							$Leave_Type_Text = 'VAB';
						}
						else if($Leave_Type == 4)		
						{
							$Leave_Type_Text = 'FP';
						}
						else if($Leave_Type == 5)		
						{
							$Leave_Type_Text = 'P-möte';
						}
						else if($Leave_Type == 6)		
						{
							$Leave_Type_Text = 'Utbild';
						}
						else if($Leave_Type == 7)		
						{
							$Leave_Type_Text = 'Övrigt';
						}
						else if($Leave_Type == 8)		
						{
							$Leave_Type_Text = 'Byte';
						}
						
						if(!in_array($Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['employee'],$Myemployee))
						{
							$Myemployee[] = $Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['employee'];
						}
				
						$Mydata[$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['employee']][] =$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['employee'].'|'.$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['empname'].'|'.$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['totalMinutes'].'|'.$DayCnt.'|'.$Leave_Type_Text.'|'.$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['time_from'].' - '.$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['time_to'].'|'.$Leavedata[$Showweek_Counter][$DayCnt][$reccnt]['status'];
					}
				}
			}
		
		//print_r(count($Leavedata[$Showweek_Counter][$DayCnt]));
	}
	//print_r($Mydata);
	//print_r($Myemployee);
//        echo "<pre>". print_r($Mydata, 1)."</pre>";
	if(count($Myemployee) > 0 )
	{
		for($empcnt = 0 ; $empcnt < count($Myemployee); $empcnt++)	
		{
			$EmpUnm = $Myemployee[$empcnt];
			$TotalMinutes = 0;
				
			if(count($Mydata[$EmpUnm]) > 0)
			{
//                            echo "<pre>". print_r($Mydata, 1)."</pre>";
				$html = array();
				for($showleavecnt = 0 ; $showleavecnt < count($Mydata[$EmpUnm]); $showleavecnt++)	
				{
					$Employee = explode('|',$Mydata[$EmpUnm][$showleavecnt]);
					if($showleavecnt == 0)
					{
                                            if($Employee[6] == 0){
						echo '<tr class="even" style="background:#FF0000; color:#000;">';
						echo '<td align="left">&nbsp;'.$Employee[1].'</td>';	
                                            }else if($Employee[6] == 1){
                                                echo '<tr class="even" style="background:#88B524; color:#000;">';
						echo '<td align="left">&nbsp;'.$Employee[1].'</td>';
                                            }elseif($Employee[6] == 2){
                                                echo '<tr class="even" style="background:#999900; color:#000;">';
						echo '<td align="left">&nbsp;'.$Employee[1].'</td>';
                                            }
					}
					for($td = 0 ; $td < 7 ; $td++)
					{							
						if($Employee[3] == $td)
						{
							if($Employee[2] == 1440)
							{
								$LeaveText = $Employee[4].'<br>';	
							}
							else
							{
								$LeaveText = $Employee[4].'<br>'.$Employee[5].'<br>';
							}
							if(isset($html[$td]))
							{
								
								$html[$td] .= $LeaveText;
							}
							else
							{
								$html[$td] = $LeaveText;
							}							
						}
					}
					$TotalMinutes += $Employee[2];
				}
				for($td = 0 ; $td < 7 ; $td++)
				{
					if(isset($html[$td]))
					{
						echo '<td align="center" >'.$html[$td].'</td>';
					}
					else
					{
						echo '<td align="center" ">&nbsp;--</td>';
					}
				}
				
				if($TotalMinutes > 0)
				{
					$Hrs = floor($TotalMinutes/60);
					$Minutes = $TotalMinutes%60;
					$HrsMinutes = number_format($Hrs.'.'.$Minutes,2,'.','');
				}
				else
				{
					$HrsMinutes = '-';
				}
				
				echo '<td align="left" >&nbsp;'.$HrsMinutes.'</td>';	
				echo '</tr>';
			}
		}
	}
	
	
	
	
	
	//THis is leave section
	$LeaveArray = array();
	
	
	/*if($Leavecounter_array[$Showweek_Counter] > 0)
	{
		for($ShowLeave_Counter = 0 ; $ShowLeave_Counter < $Leavecounter_array[$Showweek_Counter] ; $ShowLeave_Counter++)
		{		
			$Leave_EmployeeName = $Leavedata[$Showweek_Counter][$ShowLeave_Counter]["empfullname"];
			$Leave_EmployeeUsername = $Leavedata[$Showweek_Counter][$ShowLeave_Counter]["empusername"];
			/*if($Showweek_Counter == 6)
			{
				echo $Leavecounter_array[$Showweek_Counter];
				echo "<br>";	
				echo "<pre>";
				print_r($Leavedata[$Showweek_Counter]);
			
			echo "<br>";
			echo $Leave_EmployeeUsername;
				
			}*/
			/*if(!in_array($Leave_EmployeeUsername,$LeaveArray))
			{
				$LeaveArray[] = $Leave_EmployeeUsername;
			}
			else
			{
				continue;	
			}
			if($Leave_EmployeeName == '')
			{
				continue;
			}*/
			/*echo '<tr class="even" style="background:#88B524; color:#000;">';
			echo '<td align="left">&nbsp;'.$Leave_EmployeeName.'</td>';		
			$Leave_TotalMinutes = 0;
			for($leavecnt = 0 ; $leavecnt < 7 ; $leavecnt++)
			{
					$Leave_Time = $Leavedata[$Showweek_Counter][$Leave_EmployeeUsername][$leavecnt]['time'];
					$Leave_Type = $Leavedata[$Showweek_Counter][$Leave_EmployeeUsername][$leavecnt]['leavetype'];
					
					if($Leave_Time != '')
					{					
						$Leave_TotalMinutes += $Leavedata[$Showweek_Counter][$Leave_EmployeeUsername][$leavecnt]['totmins'];	
						if($Leavedata[$Showweek_Counter][$Leave_EmployeeUsername][$leavecnt]['totmins'] >= 1440)
						{
							echo '<td align="center">'.$Leave_Type.' </td>';
						}
						else
						{
							echo '<td align="center">'.$Leave_Time.'</td>';
						}
												
					}
					else
					{
						echo '<td align="center">--</td>';
					}
			}
			
			if($Leave_TotalMinutes > 0)
			{
				$Leave_Total_Hrs = floor($Leave_TotalMinutes/60);
				$Leave_Total_Minutes = $Leave_TotalMinutes%60;
				$Leave_Total_Hrs_Minutes	= number_format($Leave_Total_Hrs.'.'.$Leave_Total_Minutes,2,'.','');	
				echo '<td align="center">'.$Leave_Total_Hrs_Minutes.'</td>';
			}
			else
			{
				echo '<td align="center">--</td>';
			}
			echo '</tr>';
			
		}
	}*/
	/*else
	{
		echo"<tr class='even' align='center'><td colspan='9'><b>No recod Found</b></td></tr>";
	}*/
	
}

echo '</table></div></div>';
exit;

/*$year = 2005;
$leap = date('L', mktime(0, 0, 0, 1, 1, $year));
if($leap)
{
	echo "Leap year";	
}
else
{
	echo "Not Leap year";
}*/
?>