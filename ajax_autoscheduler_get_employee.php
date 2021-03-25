<?php
//Rahul : ajax_auto_scheduler.php

require_once('class/setup.php');
//require_once('class/customer.php');
require_once ('class/employee.php');
require_once('class/newcustomer.php');
require_once ('class/newemployee.php');
//require_once ('plugins/message.class.php');
//require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml","user.xml","reports.xml"), FALSE);
//$dateobj = new datecalc();
$employee = new employee();
//$customer = new customer();
$newcustomer = new newcustomer();
$newemployee = new newemployee();
//$msg = new message();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);

$Employees = $pram[5];
$SlotId = $pram[6];
$Employeeskip = $pram[7];



$ResultArray = array();

$SlotDertails = $newemployee->getSlotDetails($SlotId);



$days = $SlotDertails[0]['date'];
$TimeFrom = $SlotDertails[0]['time_from'];
$TimeTo = $SlotDertails[0]['time_to'];
$Customerunm = $SlotDertails[0]['customer'];

$TimeDiff = $TimeTo - $TimeFrom;
$TimeDiff = number_format($TimeDiff,2,'.','');
$ChunkDiff = explode('.',$TimeDiff);
$SlotMinutes = floor($ChunkDiff[0]*60)+number_format($ChunkDiff[1]);

$GlobalSetting = $newcustomer->GetGlobalSetting();
$GlobalTimeDiff = $GlobalSetting[0]['schedule_time_diff'];
$GlobalTimeHours =  floor($GlobalTimeDiff/60);
$GlobalTimeMinutes = $GlobalTimeDiff%60;
$GlobalTimeHoursMinutes = (float)number_format($GlobalTimeHours.'.'.$GlobalTimeMinutes,2,'.','');	
	
$GlobalMaxHours = $GlobalSetting[0]['emp_max_hours'];	
$ChunkMaxHours = explode('.',$GlobalMaxHours);				
$MaxHours = floor($ChunkMaxHours[0]*60)+$ChunkMaxHours[1];
$GlobalMaxHours = $MaxHours;




if($Employees != '')
{
	$EmployeeArray = explode(',',$Employees);

	if(count($EmployeeArray) > 0)
	{
		foreach($EmployeeArray  as $employee)
		{
			
			$AvailableEmpUnm = $employee;	
						
			//If the slot is allocated to this employee
			if($AvailableEmpUnm == $Employeeskip)
			{
				continue;	
			}
								
			$EmpMaxHours = $newemployee->Get_Employee_Max_Hours($AvailableEmpUnm);
			if($EmpMaxHours > 0)
			{
				$chunkmax = explode('.',$EmpMaxHours);
				$chunkMinutes = ($chunkmax[0]*60)+$chunkmax[1];
				$MaxWorkingHours = $chunkMinutes;
			}
			else
			{
				$MaxWorkingHours = $GlobalMaxHours;
			}	
			
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
			
			
			
			if($PreferredTimeCheck == 0)
			{
				//Skeep Employee
				continue;	
			}
			
			
			$GetPreviousSchedule = $newemployee->Get_Previous_Schedule_of_Employee($AvailableEmpUnm,$days,$TimeFrom,0,$Customerunm,$SlotId);
			
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
			
			
			
			if($PreviousTaskTotMinutes <= $MaxWorkingHours && $PreviousTaskTotMinutes <= 900)
			{
				$SumOfTimeDiff  = $TimeFrom+$GlobalTimeHoursMinutes;																
				
				if($GetPreviousSchedule['yesterday']['time_to'] == '' && $GetPreviousSchedule['today']['time_to'] == '')
				{
					$TimeDiffCheck = 1;
				}
				else if(($GetPreviousSchedule['yesterday']['time_to'] != '' && $GetPreviousSchedule['yesterday']['time_to'] > $SumOfTimeDiff) || ($GetPreviousSchedule['today']['time_to'] != '' && $GetPreviousSchedule['today']['time_to'] < $SumOfTimeDiff))												
				{
					$TimeDiffCheck = 1;
				}
				else
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
			
			///Check For Maximum hours set in global setting or employee setting											
			if($MaxWorkingHours >= $SlotMinutes || $Overtime == 1)
			{										
				$AvlEmpDetails = $newemployee->get_employee_detail($AvailableEmpUnm);
				$EmpUname = $AvlEmpDetails['username'];												
				$EmpFname = $AvlEmpDetails['first_name'];
				$EmplName = $AvlEmpDetails['last_name']; 
				$ResultArray[] = $EmpUname;			
			}
			else
			{
				//Skeep Employee
				continue;	
			}			
		}
	}
}



if(!empty($ResultArray))
{
		//START - Create Edit employee for slot POPUP
$html =  '<div id="timetable_assign" style="background:none repeat scroll 0 0 #FFFFFF;border:5px solid #D8D8D8;min-height:200px !important;top:200px; !important; position:absolute !important; left:700px !important; width:310px !important;overflow-x:hidden;overflow-y:scroll; z-index:99999; ">							
	<div id="options" class="clearfix" style="border:none !important;">
	<span style="float:left; left:0px !important; position:absolute; z-index:999999 !important; margin-left:-3px; margin-top:-10px; height:15px; width:15px; background:#94CCD9; color:red; cursor:pointer;" align="center" onclick="closeit();">&nbsp;X</span>	
		<div id="assigned_slots" style="position: absolute; top: 5px;">
			<div class="option_head">Minnespass</div>';
			
				foreach($ResultArray as $CustEmployee)
				{
					
					$EmpDetails = $newemployee->get_employee_detail($CustEmployee);										
					$hex = "#";
					$hex .= str_pad(dechex($EmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
					$hex .= str_pad(dechex($EmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
					$hex .= str_pad(dechex($EmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
																	
					$html .= '<div id="add_new_slot" class="ui-droppable">
						<a href="javascript:void(0);" onclick="hideemployee(\''.$EmpDetails['first_name'].' '.$EmpDetails['last_name'].'\',\''.$hex.'\',\''.$EmpDetails['username'].'\')">'.$EmpDetails['first_name'].' '.$EmpDetails['last_name'].'</a>
						</div>';
				}
			$html .='</div>
		</div>							
	</div>';
//End - Create Edit employee for slot POPUP	
echo $html;	
exit;
}
else
{
	$html =  '<div id="timetable_assign" style="background:none repeat scroll 0 0 #FFFFFF;border:5px solid #D8D8D8;min-height:200px !important;top:200px; !important; position:absolute !important; left:700px !important; width:310px !important;overflow-x:hidden;overflow-y:scroll; z-index:99999; ">							
	<div id="options" class="clearfix" style="border:none !important;">
	<span style="float:left; left:0px !important; position:absolute; z-index:999999 !important; margin-left:-3px; margin-top:-10px; height:15px; width:15px; background:#94CCD9; color:red; cursor:pointer;" align="center" onclick="closeit();">&nbsp;X</span>	
		<div id="assigned_slots" style="position: absolute; top: 5px;">
			<div class="option_head">Minnespass</div>';
			
				
					$html .= '<div id="add_new_slot" class="ui-droppable">
						'.$smarty->localise->contents["No_employee_available"].'
						</div>';
			
			$html .='</div>
		</div>							
	</div>';
	//End - Create Edit employee for slot POPUP	
	echo $html;	
	exit;
}
?>