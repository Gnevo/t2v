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
$table = $pram[$totparam-1];
$yr_mnt_week = $pram[$totparam-2];
$name = str_replace('_',' ',$pram[$totparam-3]);
$sep_data = explode('-',$yr_mnt_week);

$year 	= $sep_data[0];
$month	= $sep_data[1];
$wekkno = $sep_data[2];

$start_date    = $year.'-'.$month.'-'.'01';
$end_date      = date("Y-m-t", strtotime($start_date));

$mainhtml = '';

$Cust_Details = $customer->getcustomer($name);
$Cust_Social_No = $Cust_Details[0]['social_security'];
$Cust_Username = $Cust_Details[0]['username'];
$Cust_FirstName		= $Cust_Details[0]['first_name'];
$Cust_LastName		= $Cust_Details[0]['last_name'];
$Cust_FullName		= $Cust_FirstName.' '.$Cust_LastName;

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
	$Total_schedule_Hours_emps = number_format(	(float)$Total_schedule_Hours_emps,2,'.','');	
	$Minutes_Total = substr(strstr($Total_schedule_Hours_emps,'.'),1);	
	$Hours_Total = substr($Total_schedule_Hours_emps,0,-3);
	$Convert = ($Hours_Total*60)+ $Minutes_Total;
	$Total_schedule_Hours = floor($Convert/60);
	$Total_schedule_Minutes = round($Convert%60);	
	//$Total_schedule_Final = $Total_schedule_Hours . '.' . $Total_schedule_Minutes.' '.$smarty->localise->contents['h'];	
	$Total_schedule_Final = number_format($Total_schedule_Hours.'.'.$Total_schedule_Minutes,2,'.','');	
	
	//echo "<pre>";
	//print_r($Total_schedule_Hours);
	//$slots = $this->customer_slots_day($customer, $date);
	$datas[$i]['slots'] = $Total_schedule_Final;
	$i++;
}
/*print_r($datas);
exit;*/
$date11 = explode(' ',$datas[0]['date']);
$date22 = explode(' ',$datas[1]['date']);
$date33 = explode(' ',$datas[2]['date']);
$date44 = explode(' ',$datas[3]['date']);
$date55 = explode(' ',$datas[4]['date']);
$date66 = explode(' ',$datas[5]['date']);
$date77 = explode(' ',$datas[6]['date']);

$htmlcontent ='<table class="table_list tbl_padding_fix" style="width:871px;border-collapse:collapse;margin:0 auto 5px;" border="1">            
                <tr>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date11[0].' '.$smarty->localise->contents[strtolower($date11[1])].'</th>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date22[0].' '.$smarty->localise->contents[strtolower($date22[1])].'</th>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date33[0].' '.$smarty->localise->contents[strtolower($date33[1])].'</th>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date44[0].' '.$smarty->localise->contents[strtolower($date44[1])].'</th>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date55[0].' '.$smarty->localise->contents[strtolower($date55[1])].'</th>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date66[0].' '.$smarty->localise->contents[strtolower($date66[1])].'</th>
                    <th style="height:25px;background-color:#DAF2F7;padding:3px 10px;border: 1px solid #d6d6d6;">'.$date77[0].' '.$smarty->localise->contents[strtolower($date77[1])].'</th>                    
                </tr>
                <tr class="odd">
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[0]['day']['label']].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[1]['day']['label']].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[2]['day']['label']].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[3]['day']['label']].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[4]['day']['label']].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[5]['day']['label']].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$smarty->localise->contents[$datas[6]['day']['label']].'</td>
                </tr>
                <tr class="even">
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[0]['slots'].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[1]['slots'].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[2]['slots'].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[3]['slots'].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[4]['slots'].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[5]['slots'].'</td>
                    <td align="center" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;">'.$datas[6]['slots'].'</td>
                </tr>
            </table>';
			
			$mainhtml .= $htmlcontent;
			
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
				
					$EmplName = ucwords($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['empname']);	
					
					$Schedule_Type = $Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['type'];
					
					if($Schedule_Type == 3)
					{	
						if($Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['fkkn'] == 1)
						{
							$fkkn = $smarty->localise->contents['fk'];
						}
						else
						{
							$fkkn = $smarty->localise->contents['kn'];
						}
						$type = 'title="'.$fkkn.'"';
					}
					else
					{
						$type = '';
					}
				
					$RowsHtml .= '<tr style="height:40px;">
					<td width="295" align="left" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;word-wrap: normal; white-space: normal; word-spacing:normal;">'.iconv("UTF-8", "Windows-1252", $EmplName).' '.$TodaysHours.' '.$WeekHoursTotal.'</td>
					<td width="576" colspan="13">
						<table style="height:20px; width:'.$CalToBar.'px; background:'.$Schduled_Employee_List[$employee_counter]['hrs'][$Each_Employee_counter]['color'].'; float:left; border:1px solid #CCC; margin-left:'.$CalFromBar.'px; float:left;" '.$type.'>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
					</tr>';
				}
				
				if($table == $employee_counter)
				{
					$show = 'style="display:block"';	
				}
				else
				{
					$show = 'style="display:none"';	
				}
				
				$HeaderHtml .= '<div id="mytables'.$employee_counter.'" '.$show.' >
				<table cellspacing="0" cellpadding="0" style="width:871px;border-collapse:collapse;margin:0 auto 5px; border: 1px solid #d6d6d6;" >
				<tr>
					<td colspan="14" style="padding:0px;padding:3px 10px;border: 1px solid #d6d6d6;" align="center" > <b>'.$smarty->localise->contents["customer"].'</b> : '.urldecode($Cust_FullName).' <b>'.$smarty->localise->contents['SSN'].'</b> : '.$Cust_Social_No.' ( '.$WeekDates[$employee_counter].' )</td>
				</tr>
				<tr class="odd">
				<td align="center" width="295" style="padding:0px; ">'.$smarty->localise->contents['employeename'].'</td> 
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">0</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">2</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">4</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">6</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">8</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">10</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">12</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">14</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">16</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">18</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">20</td>
				<td align="left" width="24px" style="border: 1px solid #d6d6d6;">22</td>
				</tr>'.$RowsHtml.'</table></div>';
			}
			 
			$mainhtml .= $HeaderHtml;
			
			$mpdf=new mPDF('', 'A4-L');
			$mpdf->useKerning=true;
			$mpdf->restrictColorSpace=3; // forces everything to convert to CMYK colors
			$mpdf->AddSpotColor('PANTONE 534 EC',85,65,47,9);
			//==============================================================
			//==============================================================
			$mpdf->WriteHTML($mainhtml);
			//==============================================================
			//==============================================================
			// OUTPUT
			$mpdf->Output('Horizontal_Customer_Report.pdf','D'); 
			?>
			<script type="text/javascript">
            window.close();
            </script>
            <?php
            exit;
			?>