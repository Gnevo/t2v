<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/newcustomer.php');
//require_once('class/newemployee.php');
//require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$customer = new newcustomer();
//$employee = new newemployee();
//$equipment = new equipment();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
//Get current year first date and today date and pass it to tempalte file

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
if($fromdate =='0000-00-00' || $fromdate ==''){
	 $fromdate = '2012-01-01';
}
if($todate =='0000-00-00' || $todate ==''){
	 $today = date('Y-m-d');
	 $todate = $today;	
} 
$Cust_Username = $pram[$totparam-3];

$year = date('Y',strtotime($fromdate));

//$CurrentYear = date('Y');
//$FirstDateOfCurrentYear = $CurrentYear.'-01-01';
//$TodatDate = date('Y-m-d');
$smarty->assign('TodatDate',$TodatDate);
$smarty->assign('FirstDateOfCurrentYear',$FirstDateOfCurrentYear);

/* coded by viteb */
$previewdata = '';
$Cust_Username = $pram[$totparam-3];

$year = date('Y',strtotime($fromdate));

$name = $customer->getcustomerName($Cust_Username);

$smarty->assign('name',$name[0]['first_name'].' '.$name[0]['last_name']);
$smarty->assign('frmdate',$fromdate);
$smarty->assign('todate',$todate);
$smarty->assign('username',$Cust_Username);

$chunk_fromdate	= explode('-',$fromdate);
$fromday = $chunk_fromdate[2];		
$frommonth = $chunk_fromdate[1];	
$fromyear = $chunk_fromdate[0];		

if($fromday == '01' && $frommonth == '01')
{
	$tomorrow = mktime(0,0,0,$frommonth,$fromday+1,$fromyear);
	//echo "Tomorrow is ".date("Y-m-d", $tomorrow);
	$fromdate = date("Y-m-d", $tomorrow);
}
 $htmlcontent ='<div><table class="table_list tbl_padding_fix">';

$weeks = array();
$startTime = strtotime($fromdate);
$endTime = strtotime($todate);
while ($startTime < $endTime) {  
    $weeks[] = date('W', $startTime); 
    $startTime += strtotime('+1 week', 0);
}
$TotalWeek = count($weeks);

global $week;
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
		$date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
		$datas[$weekcounter][$i]['date'] = $date;
		$Employee_Schedules = 	$customer->temp_get_employee_schedule_by_customer($Cust_Username,$date);	
		$Employee_Leaves = 	$customer->get_employee_leave_by_customer($Cust_Username,$date);
				
		$datas[$weekcounter][$i]['slots1'] = $Employee_Schedules;
		$datas[$weekcounter][$i]['slots2'] = $Employee_Leaves;
		$i++;
	}
}

for($WeekCounter = 0; $WeekCounter < count($datas); $WeekCounter++)
{
	/*echo "<pre>";
	print_r($datas[$WeekCounter]);
	exit;*/
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
		$Weekarray[$WeekCounter] .='<th width="80" align="center" >'.$smarty->localise->contents[$label].'<br>('.$date.')</th>';	
		
		//Start  - Count Schedule Hours array
		$count_Each_employee = count($datas[$WeekCounter][$DayCounter]['slots1']);
		//echo "week ".$WeekCounter." (".$DayCounter.") (".$count_Each_employee.") <br>";
		if($count_Each_employee  > 0)
		{
			for($EmployeeCounter = 0 ; $EmployeeCounter < $count_Each_employee ; $EmployeeCounter++)	
			{
				$Employee_Username 	= $datas[$WeekCounter][$DayCounter]['slots1'][$EmployeeCounter]['employee'];
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
		$count_Each_employee_Leave = count($datas[$WeekCounter][$DayCounter]['slots2']);		
		if($count_Each_employee_Leave > 0)
		{
			for($Leave_Counter = 0 ; $Leave_Counter < $count_Each_employee_Leave ; $Leave_Counter++)	
			{
				$Leave_Employee_Username 	= $datas[$WeekCounter][$DayCounter]['slots2'][$Leave_Counter]['employee'];
				$Leave_Employee_Fullname	= $datas[$WeekCounter][$DayCounter]['slots2'][$Leave_Counter]['empname'];
				$Leave_Time_From = $datas[$WeekCounter][$DayCounter]['slots2'][$Leave_Counter]['time_from'];
				$Leave_Time_To = $datas[$WeekCounter][$DayCounter]['slots2'][$Leave_Counter]['time_to'];
				$Leave_Mins_Tot	= $datas[$WeekCounter][$DayCounter]['slots2'][$Leave_Counter]['totalMinutes'];
				$Leave_Type	= $datas[$WeekCounter][$DayCounter]['slots2'][$Leave_Counter]['type'];	
				
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
				
				if($Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['show'] == $DayCounter && $Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['empfullname'] == $Leave_Employee_Fullname)
				{
					$Leavedata[$WeekCounter][$Leave_Counter]['empfullname']= $Leave_Employee_Fullname;
					$Leavedata[$WeekCounter][$Leave_Counter]['empusername']= $Leave_Employee_Username;			
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['empfullname'] = $Leave_Employee_Fullname;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['time'] .= '<br>'.$Leave_Type_Text.' <br> '.$Leave_Time_From.' - '.$Leave_Time_To;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['totmins'] += $Leave_Mins_Tot;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['date'] .= '<br>'.$date;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['show'] = $DayCounter;	
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['leavetype'] = $Leave_Type_Text;	
					
				}
				else
				{
					$Leavedata[$WeekCounter][$Leave_Counter]['empfullname']= $Leave_Employee_Fullname;
					$Leavedata[$WeekCounter][$Leave_Counter]['empusername']= $Leave_Employee_Username;					
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['empfullname'] = $Leave_Employee_Fullname;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['time'] = $Leave_Type_Text.' <br> '.$Leave_Time_From.' - '.$Leave_Time_To;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['totmins'] = $Leave_Mins_Tot;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['date'] = $date;
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['show'] = $DayCounter;	
					$Leavedata[$WeekCounter][$Leave_Employee_Username][$DayCounter]['leavetype'] = $Leave_Type_Text;	
					$Leavecounter++;
				}
			}
		}
		//End - Leave Hours calculation array		
	}
	$Leavecounter_array[] = $Leavecounter;	
	$Empcounter_array[] = $Empcounter;	
	$Weekarray[$WeekCounter] .= "<th align='center'>".$smarty->localise->contents['total']."</th>";
	$Weekarray[$WeekCounter] .= "</tr>";
}

$htmlcontent2 ='';
for($Showweek_Counter = 0 ; $Showweek_Counter < count($Weekarray); $Showweek_Counter++ )
{
	$htmlcontent2 .= $Weekarray[$Showweek_Counter];
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
					
			$htmlcontent2 .= '<tr class="odd">';
			$htmlcontent2 .= '<td align="left">&nbsp;'.$EmployeeName.'</td>';		
			$Day_TotalMinutes = 0;
			for($daycnt = 0 ; $daycnt < 7 ; $daycnt++)
			{
					$Time = $Employeedata[$Showweek_Counter][$EmployeeUsername][$daycnt]['time'];
					if($Time != '')
					{					
						$Day_TotalMinutes += $Employeedata[$Showweek_Counter][$EmployeeUsername][$daycnt]['totmins'];									
						$htmlcontent2 .= '<td align="center">'.$Time.'	</td>';
					}
					else
					{
						$htmlcontent2 .= '<td align="center">--</td>';
					}
			}
			
			if($Day_TotalMinutes > 0)
			{
				$Total_Hrs = floor($Day_TotalMinutes/60);
				$Total_Minutes = $Day_TotalMinutes%60;
				$Total_Hrs_Minutes	= number_format($Total_Hrs.'.'.$Total_Minutes,2,'.','');	
				$htmlcontent2 .= '<td align="center">'.$Total_Hrs_Minutes.'</td>';
			}
			else
			{
				$htmlcontent2 .= '<td align="center">--</td>';
			}
			$htmlcontent2 .= '</tr>';
		}
	}
	else
	{
		$htmlcontent2 .="<tr class='odd' align='center'><td colspan='9'><b>".$smarty->localise->contents['no_record_found']."</b></td></tr>";
	}
	
	//THis is leave section
	$LeaveArray = array();	
	if($Leavecounter_array[$Showweek_Counter] > 0)
	{
		for($ShowLeave_Counter = 0 ; $ShowLeave_Counter < $Leavecounter_array[$Showweek_Counter] ; $ShowLeave_Counter++)
		{		
			$Leave_EmployeeName = $Leavedata[$Showweek_Counter][$ShowLeave_Counter]["empfullname"];
			$Leave_EmployeeUsername = $Leavedata[$Showweek_Counter][$ShowLeave_Counter]["empusername"];
			if(!in_array($EmployeeUsername,$LeaveArray))
			{
				$LeaveArray[] = $EmployeeUsername;
			}
			else
			{
				continue;	
			}
					
			$htmlcontent2 .= '<tr class="even" style="background:#88B524; color:#000;">';
			$htmlcontent2 .= '<td align="left">&nbsp;'.$Leave_EmployeeName.'</td>';		
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
							$htmlcontent2 .= '<td align="center">'.$Leave_Type.' </td>';
						}
						else
						{
							$htmlcontent2 .= '<td align="center">'.$Leave_Time.'</td>';
						}
												
					}
					else
					{
						$htmlcontent2 .= '<td align="center">--</td>';
					}
			}
			
			if($Leave_TotalMinutes > 0)
			{
				$Leave_Total_Hrs = floor($Leave_TotalMinutes/60);
				$Leave_Total_Minutes = $Leave_TotalMinutes%60;
				$Leave_Total_Hrs_Minutes	= number_format($Leave_Total_Hrs.'.'.$Leave_Total_Minutes,2,'.','');	
				$htmlcontent2 .= '<td align="center">'.$Leave_Total_Hrs_Minutes.'</td>';
			}
			else
			{
				$htmlcontent2 .= '<td align="center">--</td>';
			}
			$htmlcontent2 .= '</tr>';
		}
	}
	
}
$htmlcontent .= $htmlcontent2;
$htmlcontent .='</table></div>';

$smarty->assign('previewdata',$htmlcontent);
/* end coded by viteb */


$smarty->display('extends:layouts/dashboard.tpl|vacation_planning_report_preview.tpl');
?>
