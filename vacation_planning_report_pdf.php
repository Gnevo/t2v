<?php
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
require_once ('plugins/date_calc.class.php');


$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);

$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new newcustomer();
$employee = new newemployee();
$date = new datecalc();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
$name = str_replace('_',' ',$pram[$totparam-3]);

$Cust_Details = $customer->getcustomer($name);
$Cust_Username = $Cust_Details[0]['username'];

	$ssnhtml = ' <div class="pagention">            
<span style="margin:7px; float:left;"><b>'.$smarty->localise->contents['SSN'].' : </b>'.$Cust_Social_No.' <b>'.$smarty->localise->contents['address'].' : </b> '.$Cust_Address.'</span>
</div>';

$year = date('Y',strtotime($fromdate));

$chunk_fromdate	= explode('-',$fromdate);
$fromday = $chunk_fromdate[2];		
$frommonth = $chunk_fromdate[1];	
$fromyear = $chunk_fromdate[0];		

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
}


if($fromday == '01' && $frommonth == '01')
{
	$tomorrow = mktime(0,0,0,$frommonth,$fromday+1,$fromyear);
	//echo "Tomorrow is ".date("Y-m-d", $tomorrow);
	$fromdate = date("Y-m-d", $tomorrow);
}
$htmlcontent ='<div>'.$smarty->localise->contents['customer'].' : '.$name.'  '.$smarty->localise->contents['from_date'].' : '.$fromdate.' '.$smarty->localise->contents['to_date'].' : '.$todate.' <table class="table_list tbl_padding_fix" border="1">';
$mainhtml .= $htmlcontent;

$weeks = array();
$startTime = strtotime($fromdate);
$endTime = strtotime($todate);
while ($startTime < $endTime) {  
    $weeks[] = date('W', $startTime); 
    $startTime += strtotime('+1 week', 0);
}
$TotalWeek = count($weeks);

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
		$Employee_Schedules = 	$customer->get_employee_schedule_by_customer($Cust_Username,$date);	
		$Employee_Leaves = 	$customer->get_employee_leave_by_customer($Cust_Username,$date);
				
		$datas[$weekcounter][$i]['slots1'] = $Employee_Schedules;
		$datas[$weekcounter][$i]['slots2'] = $Employee_Leaves;
		$i++;
	}
	if($weekNo == 52)
	{
		$yearcnt++;
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
	$Weekarray[$WeekCounter] .="<tr class='odd' style='background:#DAF2F7: color:#D6D6D6;'  >";
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
		//End - Leave Hours calculation array		
	}
	$Leavecounter_array[] = $Leavecounter;	
	$Empcounter_array[] = $Empcounter;	
	$Weekarray[$WeekCounter] .= "<th align='center'>".$smarty->localise->contents['total']."</th>";
	$Weekarray[$WeekCounter] .= "</tr>";
}	
/*echo "<pre>";
//print_r($Empcounter_array);
print_r($Employeedata);
//print_r($Empcounter_array);
//print_r($Employee_date_we	kk);
exit;*/
/*echo "<pre>";
//print_r($Empcounter_array);
//print_r($Leavecounter_array);
print_r($Leavedata);
exit;
*/
for($Showweek_Counter = 0 ; $Showweek_Counter < count($Weekarray); $Showweek_Counter++ )
{
	$mainhtml .=  $Weekarray[$Showweek_Counter];
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
					
			$mainhtml .= '<tr class="odd" style="background:#F7FBFB;">';
			$mainhtml .= '<td align="center">'.$EmployeeName.'</td>';		
			$Day_TotalMinutes = 0;
			for($daycnt = 0 ; $daycnt < 7 ; $daycnt++)
			{
					$Time = $Employeedata[$Showweek_Counter][$EmployeeUsername][$daycnt]['time'];
					if($Time != '')
					{					
						$Day_TotalMinutes += $Employeedata[$Showweek_Counter][$EmployeeUsername][$daycnt]['totmins'];									
						$mainhtml .= '<td align="center">'.$Time.'	</td>';
					}
					else
					{
						$mainhtml .= '<td align="center">--</td>';
					}
			}
			
			if($Day_TotalMinutes > 0)
			{
				$Total_Hrs = floor($Day_TotalMinutes/60);
				$Total_Minutes = $Day_TotalMinutes%60;
				$Total_Hrs_Minutes	= number_format($Total_Hrs.'.'.$Total_Minutes,2,'.','');	
				$mainhtml .= '<td align="center">'.$Total_Hrs_Minutes.'</td>';
			}
			else
			{
				$mainhtml .= '<td align="center">--</td>';
			}
			$mainhtml .= '</tr>';
		}
	}
	else
	{
		$mainhtml .="<tr class='odd' align='center'><td colspan='9' align='center'><b>".$smarty->localise->contents['no_record_found']."</b></td></tr>";
	}
		
	//THis is leave section
	//echo "<pre>";
	//echo "<br>";
	//print_r($Leavedata[$Showweek_Counter]);
	$Mydata = array();
	$Myemployee = array();
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
							$Leave_Type_Text = 'Sjuk';
						else if($Leave_Type == 2)	
							$Leave_Type_Text = 'Sem';
						else if($Leave_Type == 3)	
							$Leave_Type_Text = 'VAB';
						else if($Leave_Type == 4)	
							$Leave_Type_Text = 'FP';
						else if($Leave_Type == 5)	
							$Leave_Type_Text = 'P-möte';
						else if($Leave_Type == 6)	
							$Leave_Type_Text = 'Utbild';
						else if($Leave_Type == 7)	
							$Leave_Type_Text = 'Övrigt';
						else if($Leave_Type == 8)	
							$Leave_Type_Text = 'Byte';
						
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
	if(count($Myemployee) > 0 )
	{
		for($empcnt = 0 ; $empcnt < count($Myemployee); $empcnt++)	
		{
			$EmpUnm = $Myemployee[$empcnt];
			$TotalMinutes = 0;
				
			if(count($Mydata[$EmpUnm]) > 0)
			{
				$html = array();
				for($showleavecnt = 0 ; $showleavecnt < count($Mydata[$EmpUnm]); $showleavecnt++)	
				{
					$Employee = explode('|',$Mydata[$EmpUnm][$showleavecnt]);
					if($showleavecnt == 0)
					{
//						$mainhtml .= '<tr class="even"  style="background:#88B524; color:#000;">';
//						$mainhtml .= '<td align="center">'.$Employee[1].'</td>';		
                                            if($Employee[6] == 0 || $Employee[6] == '0'){
						$mainhtml .= '<tr class="even" style="background:#FF0000; color:#000;">';
						$mainhtml .= '<td align="center">'.$Employee[1].'</td>';	
                                            }
                                            else if($Employee[6] == 1 || $Employee[6] == '1'){
                                                $mainhtml .= '<tr class="even"  style="background:#88B524; color:#000;">';
						$mainhtml .= '<td align="center">'.$Employee[1].'</td>';	
                                            }
                                            elseif($Employee[6] == 2){
                                                $mainhtml .= '<tr class="even" style="background:#999900; color:#000;">';
						$mainhtml .= '<td align="center">'.$Employee[1].'</td>';
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
						$mainhtml .= '<td align="center">'.$html[$td].' </td>';
					}
					else
					{
						$mainhtml .= '<td align="center">--</td>';
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
				
				$mainhtml .= '<td align="center">'.$HrsMinutes.'</td>';
				$mainhtml .= '</tr>';
			}
		}
	}
	
	
	/*$LeaveArray = array();	
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
					
			$mainhtml .= '<tr class="even"  style="background:#88B524; color:#000;">';
			$mainhtml .= '<td align="center">'.$Leave_EmployeeName.'</td>';		
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
							$mainhtml .= '<td align="center">'.$Leave_Type.' </td>';
						}
						else
						{
							$mainhtml .= '<td align="center">'.$Leave_Time.'</td>';
						}
							
					}
					else
					{
						$mainhtml .= '<td align="center">--</td>';
					}
			}
			
			if($Leave_TotalMinutes > 0)
			{
				$Leave_Total_Hrs = floor($Leave_TotalMinutes/60);
				$Leave_Total_Minutes = $Leave_TotalMinutes%60;
				$Leave_Total_Hrs_Minutes	= number_format($Leave_Total_Hrs.'.'.$Leave_Total_Minutes,2,'.','');	
				$mainhtml .= '<td align="center">'.$Leave_Total_Hrs_Minutes.'</td>';
			}
			else
			{
				$mainhtml .= '<td align="center">--</td>';
			}
			$mainhtml .= '</tr>';
		}
	}*/
	/*else
	{
		echo"<tr class='even' align='center'><td colspan='9'><b>No recod Found</b></td></tr>";
	}*/
	
}

$mainhtml .=  '</table></div>';
//echo $mainhtml;
$mpdf=new mPDF('');
$mpdf->useKerning=true;
$mpdf->restrictColorSpace=3; // forces everything to convert to CMYK colors
$mpdf->AddSpotColor('PANTONE 534 EC',85,65,47,9);
$mpdf->WriteHTML($mainhtml);
$mpdf->Output('Vacation_Planning_Report.pdf','D'); 
?>
<script type="text/javascript">
    window.close();
</script>
<?php
exit;
?>