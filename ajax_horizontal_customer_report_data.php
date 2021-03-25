<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new newcustomer();
$employee = new newemployee();
$date = new datecalc();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$yr_mnt_week = $pram[$totparam-1];
$name = str_replace('_',' ',$pram[$totparam-2]);

$sep_data = explode('-',$yr_mnt_week);

$year 	= $sep_data[0];
$month	= $sep_data[1];
$wekkno = $sep_data[2];

$start_date    = $year.'-'.$month.'-'.'01';
$end_date      = date("Y-m-t", strtotime($start_date));


$nextweekno = $wekkno+1; 
if($nextweekno > 52)
{
	$nextyear 	= $year+1;	
	$nextweekno = 1; 
}
else
{
	$nextyear 	= $year;
}

$prevweekno = $wekkno-1; 
if($prevweekno < 1)
{
	$prevyear 	= $year-1;	
	$prevweekno = 52; 
}
else
{
	$prevyear 	= $year;
}
if($nextyear > $prevyear && $wekkno != 52)
{
	$ShowYear = $nextyear;	
}
else
{
	$ShowYear = $prevyear;	
}

$Cust_Details = $customer->getcustomer($name);

$Cust_Social_No = $Cust_Details[0]['social_security'];
$Cust_Username = $Cust_Details[0]['username'];
echo $ssnhtml = '
<input type="hidden" name="hdn_week" id="hdn_week" value="'.$wekkno.'">
<div class="row-fluid">    
<div class="pagention span12">            
	<div class="span3" style="margin:7px; float:left;"><b>'.$smarty->localise->contents['SSN'].' : </b>'.$Cust_Social_No.'</div>
	<div class="span3" style="float: right; padding-right:10px; padding-top:3px;">
                <div class="row-fluid"><div class="span12">
		<div class="arrow_left span3">
		<a href="javascript:void(0);" onclick="changeweek('.$prevweekno.','.$prevyear.','.'\''.$name.'\''.');"></a>
		</div> 
		<div style="padding-top:4px;" class="span6">
		'.$smarty->localise->contents['week'].' '.$wekkno.' '.$smarty->localise->contents['year'].' '.$ShowYear.'	
		</div>
		<div class="arrow_right span3">
		<a href="javascript:void(0);" onclick="changeweek('.$nextweekno.','.$nextyear.','.'\''.$name.'\''.');"></a>
		</div>
                </div></div>
	</div>
</div>
</div>';
			


global $week;
$week_no = sprintf("%02d", $wekkno);
$datas = array();
$i = 0;
//Find OUT total hours for all employee in a week
foreach ($week as $day) {
	$Total_schedule_Final = '';
	$datas[$i]['day'] = $day;
	//$date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
	$date = date("d M", strtotime($year . 'W' . $week_no . $day['id']));
	$param_date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
	$datas[$i]['date'] = $date;	
	$Total_schedule_Hours_emps = $customer->Total_schedule_Hours_of_emps($name,$param_date);
	$Total_schedule_Hours_emps = number_format((float)$Total_schedule_Hours_emps,2,'.','');	
	$Minutes_Total = substr(strstr($Total_schedule_Hours_emps,'.'),1);	
	$Hours_Total = substr($Total_schedule_Hours_emps,0,-3);
	$Convert = ($Hours_Total*60)+ $Minutes_Total;
	$Total_schedule_Hours = floor($Convert/60);
	$Total_schedule_Minutes = round($Convert%60);	
	//$Total_schedule_Final = $Total_schedule_Hours . '.' . $Total_schedule_Minutes.' '.$smarty->localise->contents['h'];	
	$Total_schedule_Final = number_format($Total_schedule_Hours.'.'.$Total_schedule_Minutes,2,'.','');	
	// echo $Total_schedule_Hours_emps;
	//echo "<pre>";
	//print_r($Total_schedule_Hours);
	//$slots = $this->customer_slots_day($customer, $date);
	$datas[$i]['slots'] = $Total_schedule_Final;
	$i++;
}
// var_dump($datas);
// exit;
$date11 = explode(' ',$datas[0]['date']);
$date22 = explode(' ',$datas[1]['date']);
$date33 = explode(' ',$datas[2]['date']);
$date44 = explode(' ',$datas[3]['date']);
$date55 = explode(' ',$datas[4]['date']);
$date66 = explode(' ',$datas[5]['date']);
$date77 = explode(' ',$datas[6]['date']);

echo $htmlcontent ='<div class="row-fluid"><div class="span12"><table class="table_list tbl_padding_fix" style="width:100%"> 
                <tr>
                    <th id="th0"><a href="javascript:void(0);" onclick="showdates(0);" style="text-decoration:underline; cursor:pointer;">'.$date11[0].' '.$smarty->localise->contents[strtolower($date11[1])].'</a></th>
                    <th id="th1"><a href="javascript:void(0);" onclick="showdates(1);" style="text-decoration:underline; cursor:pointer;">'.$date22[0].' '.$smarty->localise->contents[strtolower($date22[1])].'</a></th>
                    <th id="th2"><a href="javascript:void(0);" onclick="showdates(2);" style="text-decoration:underline; cursor:pointer;">'.$date33[0].' '.$smarty->localise->contents[strtolower($date33[1])].'</a></th>
                    <th id="th3"><a href="javascript:void(0);" onclick="showdates(3);" style="text-decoration:underline; cursor:pointer;">'.$date44[0].' '.$smarty->localise->contents[strtolower($date44[1])].'</a></th>
                    <th id="th4"><a href="javascript:void(0);" onclick="showdates(4);" style="text-decoration:underline; cursor:pointer;">'.$date55[0].' '.$smarty->localise->contents[strtolower($date55[1])].'</a></th>
                    <th id="th5"><a href="javascript:void(0);" onclick="showdates(5);" style="text-decoration:underline; cursor:pointer;">'.$date66[0].' '.$smarty->localise->contents[strtolower($date66[1])].'</a></th>
                    <th id="th6"><a href="javascript:void(0);" onclick="showdates(6);" style="text-decoration:underline; cursor:pointer;">'.$date77[0].' '.$smarty->localise->contents[strtolower($date77[1])].'</a></th>                    
                </tr>
                <tr class="odd">
                    <td align="center">'.$smarty->localise->contents[$datas[0]['day']['label']].'</td>
                    <td align="center">'.$smarty->localise->contents[$datas[1]['day']['label']].'</td>
                    <td align="center">'.$smarty->localise->contents[$datas[2]['day']['label']].'</td>
                    <td align="center">'.$smarty->localise->contents[$datas[3]['day']['label']].'</td>
                    <td align="center">'.$smarty->localise->contents[$datas[4]['day']['label']].'</td>
                    <td align="center">'.$smarty->localise->contents[$datas[5]['day']['label']].'</td>
                    <td align="center">'.$smarty->localise->contents[$datas[6]['day']['label']].'</td>
                </tr>
                <tr class="even">
                    <td align="center">'.$datas[0]['slots'].'</td>
                    <td align="center">'.$datas[1]['slots'].'</td>
                    <td align="center">'.$datas[2]['slots'].'</td>
                    <td align="center">'.$datas[3]['slots'].'</td>
                    <td align="center">'.$datas[4]['slots'].'</td>
                    <td align="center">'.$datas[5]['slots'].'</td>
                    <td align="center">'.$datas[6]['slots'].'</td>
                </tr>
            </table></div></div>';
			
			$j = 0;
			$Schduled_Employee_List = array();
			//Find OUT total hours for each employee in a week
			foreach ($week as $day) {
				$Total_schedule_Final = '';
				$param_date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
				$WeekDates[$j] = $param_date;
				$Schduled_Employee_List[$j]['date']	 = $param_date;
				$Schduled_Employee_List[$j]['hrs'] = $customer->Total_schedule_Hours_each_emps($name,$param_date);
				$j++;
			}
			/*echo "<pre>";
			echo count($Schduled_Employee_List);
			exit;*/
			
			for($employee_counter = 0;$employee_counter<count($Schduled_Employee_List);$employee_counter++)
			{
				$RowsHtml = '';
				for($Each_Employee_counter=0;$Each_Employee_counter<count($Schduled_Employee_List[$employee_counter]['hrs']);$Each_Employee_counter++)
				{
					$FindWeekHoursTotal = $customer->get_emp_cust_hrs($Cust_Username,$Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['empusername'],$WeekDates[0],$WeekDates[6]);
					$WeekHoursTotal = '('.$FindWeekHoursTotal[0]['hrsmins'].$smarty->localise->contents['h'].')';
					
					$TodaysHours = $Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['hrsmins'].$smarty->localise->contents['h'];	
					
					$From_Minutes_employee = round(substr(strstr($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['time_from'],'.'),1)/5);				
					$From_Hours_employee = substr($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['time_from'],0,-3);
					$hour_multiplier = 12;
					$CalFromBar = ((($From_Hours_employee*$hour_multiplier)+$From_Minutes_employee)*2) + round($From_Hours_employee/2) - 2;
					
					
					$To_Minutes_employee = round(substr(strstr($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['time_to'],'.'),1)/5);
					$To_Hours_employee = substr($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['time_to'],0,-3);
					$CalToBar = ((($To_Hours_employee*$hour_multiplier)+$To_Minutes_employee)*2) - $CalFromBar  + round($To_Hours_employee/2) - 2;
					
					if($CalToBar >= 587)
					{
						$CalToBar = 587;
					}
					
				
					$EmplName = ucwords($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['empname']);	
					$EmplName = iconv("UTF-8", "windows-1252",$EmplName);
					
					$Schedule_Type = $Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['type'];
					
					if($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['fkkn'] == 1)
					{
						$fkkn = $smarty->localise->contents['fk'];
					}
					else
					{
						$fkkn = $smarty->localise->contents['kn'];
					}
					$type = 'title="'.$fkkn.'"';
						
					
					if($Schedule_Type == 3)
					{
						$call = $smarty->localise->contents['on_call'];
					}
					else
					{
						$call = '';
					}
					
					$type = $type.$call;
					
					
					
				
					$RowsHtml .= '<tr style="height:40px;">
					<td width="295" align="center" style="word-wrap: normal; white-space: normal;">'.$EmplName.' '.$TodaysHours.' '.$WeekHoursTotal.'</td>
					<td width="576" colspan="13"><span style="height:20px; width:'.$CalToBar.'px; background:'.$Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['color'].'; float:left; border:1px solid #CCC; margin-left:'.$CalFromBar.'px;" '.$type.' >&nbsp;</span></td>
					</tr>';
				}
				
				$hour_td_width = "48px";
				
				$HeaderHtml .= '<div class="row-fluid"><div class="span12"><div id="mytables'.$employee_counter.'" style="display:none;" >
				<table cellspacing="0" cellpadding="0" class="table_list tbl_padding_fix mytable" style="width:871px; clear:both;">
				<tr class="odd">
				<td align="center" width="295" style="word-wrap: normal; white-space: normal;">'.$smarty->localise->contents['employeename'].'</td> 
				<td align="left" width="' . $hour_td_width . '">0</td>
				<td align="left" width="' . $hour_td_width . '">2</td>
				<td align="left" width="' . $hour_td_width . '">4</td>
				<td align="left" width="' . $hour_td_width . '">6</td>
				<td align="left" width="' . $hour_td_width . '">8</td>
				<td align="left" width="' . $hour_td_width . '">10</td>
				<td align="left" width="' . $hour_td_width . '">12</td>
				<td align="left" width="' . $hour_td_width . '">14</td>
				<td align="left" width="' . $hour_td_width . '"	>16</td>
				<td align="left" width="' . $hour_td_width . '">18</td>
				<td align="left" width="' . $hour_td_width . '">20</td>
				<td align="left" width="' . $hour_td_width . '">22</td>
				</tr>'.$RowsHtml.'</table></div></div></div>';
			}
			echo $HeaderHtml;
			exit;
?>