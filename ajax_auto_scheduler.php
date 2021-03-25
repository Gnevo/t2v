<?php
//Rahul : ajax_auto_scheduler.php
require_once('class/setup.php');
//require_once('class/customer.php');
//require_once ('class/employee.php');
require_once('class/newcustomer.php');
require_once ('class/newemployee.php');
//require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml"), FALSE);
$dateobj = new datecalc();
//$employee = new employee();
//$customer = new customer();
$newcustomer = new newcustomer();
//$msg = new message();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
$name = $pram[$totparam-3];

$QueryStringHtml = '
<input type="hidden" name="ToDate" id="ToDate" value="'.$todate.'" />
<input type="hidden" name="FromDate" id="FromDate" value="'.$fromdate.'" />
<input type="hidden" name="Name" id="Name" value="'.$name.'" />
<input type="hidden" name="hdn_start" id="hdn_start" value="0" />
<input type="hidden" name="hdn_end" id="hdn_end" value="14" />';

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
				//Get customer slot from timetable
				$UserName = $CustomerDetail['username'];					
				$CustomerSlot = $newcustomer->GetCustomerDateSlot($UserName,$days);
				$CustomerSlotHtml = '';
				if(count($CustomerSlot) > 0)
				{	
					foreach($CustomerSlot as $SlotDetail)
					{
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
						$CustomerSlotHtml .= '
						<a class="'.$status_class.'"  href="javascript:void(0);">
						<div class="block_left_color">
						<span class="fkkn_type">
						'.$fkkn.'
						</span>
						<span class="color_code" style="background-color: '.$SlotDetail["color"].';"></span>
						</div>
						<div class="single_sloat_detail">
						<span class="customer_week_time">'.$SlotDetail["time_from"].'-'.$SlotDetail["time_to"].' ('.$SlotDetail["timediff"].')</span>'.
                                                $type_class.        
						'<span class="customer_used_item">';
                                                if($_SESSION['company_sort_by'] == 1)
                                                    $CustomerSlotHtml .= '<span>'.$SlotDetail["first_name"].' '.$SlotDetail["last_name"].'</span>';
                                                elseif($_SESSION['company_sort_by'] == 2)
                                                    $CustomerSlotHtml .= '<span>'.$SlotDetail["last_name"].' '.$SlotDetail["first_name"].'</span>';
						$CustomerSlotHtml .= '</span>
						</div>
						</a>';
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
		$FullHtml .= '<span class="titles_tab"> '.$CustomerDetail["first_name"].' '.$CustomerDetail["last_name"].' ('.$CustomerDetail["username"].') </span>';
        elseif($_SESSION['company_sort_by'] == 2)
		$FullHtml .= '<span class="titles_tab"> '.$CustomerDetail["last_name"].' '.$CustomerDetail["first_name"].' ('.$CustomerDetail["username"].') </span>';		
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
	</div>';
}	

echo $ContetnHtml = $QueryStringHtml.'<div class="week_num" style="float:"left; cursor:pointer;" onclick="autoschedule();"><img src="'.$smarty->url.'images/go_next.png" style="cursor:pointer;" title="'.$smarty->localise->contents["label_auto_schedule"].'" /><a href="javascript:void(0);" style="cursor:pointer;">'.$smarty->localise->contents["auto_schedule"].'</a></div>'.$FullHtml.'<input type="hidden" name="hdn_total" id="hdn_total" value="'.$cnt.'" />';
exit;
?>