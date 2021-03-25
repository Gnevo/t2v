<?php
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('configs/config.inc.php');
global $leave_type;
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();

/*$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
$name = $pram[$totparam-3];*/

$query_string = explode("&", $_SERVER['QUERY_STRING']);
$name = $query_string[1];
$fromdate = $query_string[2];
$todate = $query_string[3];
$leave_types = $query_string[4];
$leave_types_array = trim($leave_types) != '' ? explode(':', $leave_types) : array();

$employees = $customer->custgriddata($name,$fromdate,$todate);
/* filter distinct employees to get "leave only employees"*/
$except_employees = array();
if(count($employees)> 0){
    foreach ($employees as $this_employee){
        if(!in_array($this_employee['username'], $except_employees)){
            $except_employees[] = $this_employee['username'];
        }
    }
}
$except_employees_string = '\'' . implode('\', \'', $except_employees) . '\'';
$leave_only_employees = $customer->custgriddata_leave($name,$fromdate,$todate, $except_employees_string);
$employees = array_merge($employees, $leave_only_employees);
for($i=0;$i<count($employees);$i++){
    if($employee->check_slot_leave($employees[$i]['username'],$employees[$i]['customer'],$fromdate,$todate, $leave_types_array)){
//        echo "<br> dfsfad".$employees[$i]['username']."  ".$employees[$i]['customer'];
        $temp_employee[] = $employees[$i];
    }
}
$employees =$temp_employee;
$tot = count($employees);

if($tot > 0) {

	$selected_customer_name = ($name != '' && $name != '-' ? ($_SESSION['company_sort_by'] == 1 ? $employees[0]['custfname'].' '.$employees[0]['custlname'] : $employees[0]['custlname'].' '.$employees[0]['custfname']) : NULL);

	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;

	$total_leave_minutes = array(0,0,0,0,0,0,0,0,0);			
	$emprepeat = '';
	$customer_leave_total = 0;
	$totleavehrs = 0;
	$TotalWorkingMinutes = 0;


	$html = '<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				<tr style="background:#DAF2F7; color:#666;">
					<th style="text-align:left;">'.$smarty->localise->contents['customer'].': '.'</th>
					<th style="text-align:left;">'.$smarty->localise->contents['from_date'].': '.'</th>	
					<th style="text-align:left;">'.$smarty->localise->contents['to_date'].': '.'</th>
				<tr>
				<tr style="background:#DAF2F7; color:#666;">
					<td>'.$selected_customer_name.'</td>
					<td>'.$fromdate.'</td>	
					<td>'.$todate.'</td>
				<tr>
			</table><br/>';

	$html .= '<table border="1" cellpadding="0" cellspacing="0"   >
		<tr style="background:#DAF2F7; color:#666;">
		<th>'.$smarty->localise->contents['customer'].'</th>
		<th>'.$smarty->localise->contents['employee'].'</th>	
		<th>'.$smarty->localise->contents['total_working_hours'].'</th>
		<th>'.$leave_type[1].'</th>
		<th>'.$leave_type[2].'</th>
		<th>'.$leave_type[3].'</th>
		<th>'.$leave_type[4].'</th>
		<!--<th>'.$smarty->localise->contents['pmeeting'].'</th>-->
		<!--<th>'.$smarty->localise->contents['education'].'</th>-->
		<th>'.$leave_type[5].'</th>
		<th>'.$leave_type[7].'</th>
		<th>'.$leave_type[9].'</th>
		<!--<th>'.$smarty->localise->contents['bandwidth'].'</th>-->
                    <th>'.$smarty->localise->contents['total_leaves'].'</th>
				<tr>';
		
	
	for($falg=0;$falg<$tot;$falg++)	
	{
		$usernm = $employees[$falg]['username'];
		if($username != $usernm)
		{
			$username = $usernm;	
		}
		//echo $usernm;
		
		$leavearr = array();
		
		$leavearr = $employee->getempleave($usernm,$fromdate,$todate);
		$empusername = $employees[$falg]['username'];			
		$custusername = $employees[$falg]['customer'];
					
		
		$empname = $employees[$falg]['emplname'].', '.$employees[$falg]['empfname'];	
		$custname = $employees[$falg]['custlname'].', '.$employees[$falg]['custfname'];	
		$Tothrs = $employees[$falg]['hrsmins'];
		$Tothrs = number_format($Tothrs, 2, '.', '');
		$totalMinutes = $employees[$falg]["totalMinutes"];
		
		$TotalWorkingMinutes += $totalMinutes;
		
		$totleavehrs = 0;
		$leave0_minutes = 0;
		$leave1_minutes = 0;
		$leave2_minutes = 0;
		$leave3_minutes = 0;
		$leave4_minutes = 0;
		$leave5_minutes = 0;
		$leave6_minutes = 0;
		$leave7_minutes = 0;
		$leave8_minutes = 0;
		
		//$leavearr[$empusername][$custusername][3];
		if(!empty($leavearr[$empusername][$custusername][1]))
		{
			$leave0_minutes += $leavearr[$empusername][$custusername][1];
			$totleavehrs += $leave0_minutes;
			$total_leave_minutes[0] += $leave0_minutes;
		}
		else
		{
			$ltype1 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][2]))
		{
			$leave1_minutes += $leavearr[$empusername][$custusername][2];
			$total_leave_minutes[1] += $leave1_minutes;
			$totleavehrs += $leave1_minutes;
		}
		else
		{
			$ltype2 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][3]))
		{
			$leave2_minutes += $leavearr[$empusername][$custusername][3];
			$total_leave_minutes[2] += $leave2_minutes;
			$totleavehrs += $leave2_minutes;
		}
		else
		{
			$ltype3 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][4]))
		{
			$leave3_minutes += $leavearr[$empusername][$custusername][4];
			$total_leave_minutes[3] += $leave3_minutes;
			$totleavehrs += $leave3_minutes;
		}
		else
		{
			$ltype4 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][5]))
		{
			$leave4_minutes += $leavearr[$empusername][$custusername][5];
			$total_leave_minutes[4] += $leave4_minutes;
			$totleavehrs += $leave4_minutes;
		}
		else
		{
			$ltype5 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][6]))
		{
			$leave5_minutes += $leavearr[$empusername][$custusername][6];
			$total_leave_minutes[5] += $leave5_minutes;
			$totleavehrs += $leave5_minutes;
		}
		else
		{
			$ltype6 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][7]))
		{
			$leave6_minutes += $leavearr[$empusername][$custusername][7];
			$total_leave_minutes[6] += $leave6_minutes;
			$totleavehrs += $leave6_minutes;
		}
		else
		{
			$ltype7 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][8]))
		{
			$leave7_minutes += $leavearr[$empusername][$custusername][8];
			$total_leave_minutes[7] += $leave7_minutes;
			$totleavehrs += $leave7_minutes;
		}
		else
		{
			$ltype8 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][9]))
		{
			$leave8_minutes += $leavearr[$empusername][$custusername][9];
			$total_leave_minutes[8] += $leave8_minutes;
			$totleavehrs += $leave8_minutes;
		}
		else
		{
			$ltype9 = 0;
		}
			
		if($emprepeat == $custname)
		{
			$empnmshow =  '';
		}
		else
		{
			$emprepeat = $custname;
			$empnmshow = $custname;
		}
	
		$leave0_minutes1 = $leave0_minutes;
		$leave0_hours = floor($leave0_minutes /60);
		$leave0_minutes = $leave0_minutes %60;
		$leave0_final = $leave0_hours == 0 ? '--' : number_format($leave0_hours . '.' . $leave0_minutes, 2, '.', '');
		
		$leave1_minutes1 = $leave1_minutes;
		$leave1_hours = floor($leave1_minutes /60);
		$leave1_minutes = number_format($leave1_minutes %60,2);
		$leave1_final = $leave1_hours == 0 ? '--' : number_format($leave1_hours . '.' . $leave1_minutes, 2, '.', '');
		
		$leave2_minutes1 = $leave2_minutes;
		$leave2_hours = floor($leave2_minutes /60);
		$leave2_minutes = number_format($leave2_minutes %60,2);
		$leave2_final = $leave2_hours == 0 ? '--' : number_format($leave2_hours . '.' . $leave2_minutes, 2, '.', '');
		
		$leave3_minutes1 = $leave3_minutes;
		$leave3_hours = floor($leave3_minutes /60);
		$leave3_minutes = $leave3_minutes %60;
		$leave3_final = $leave3_hours == 0 ? '--' : number_format($leave3_hours . '.' . $leave3_minutes, 2, '.', '');
		
		$leave4_minutes1 = $leave4_minutes;
		$leave4_hours = floor($leave4_minutes /60);
		$leave4_minutes = number_format($leave4_minutes %60,2);
		$leave4_final = $leave4_hours == 0 ? '--' : number_format($leave4_hours . '.' . $leave4_minutes, 2, '.', '');
		
		$leave5_minutes1 = $leave5_minutes;
		$leave5_hours = floor($leave5_minutes /60);
		$leave5_minutes = number_format($leave5_minutes %60,2);
		$leave5_final = $leave5_hours == 0 ? '--' : number_format($leave5_hours . '.' . $leave5_minutes, 2, '.', '');
		
		$leave6_minutes1 = $leave6_minutes;
		$leave6_hours = floor($leave6_minutes /60);
		$leave6_minutes = number_format($leave6_minutes %60,2);
		$leave6_final = $leave6_hours == 0 ? '--' : number_format($leave6_hours . '.' . $leave6_minutes, 2, '.', '');
		
		$leave7_minutes1 = $leave7_minutes;
		$leave7_hours = floor($leave7_minutes /60);
		$leave7_minutes = number_format($leave7_minutes %60,2);
		$leave7_final = $leave7_hours == 0 ? '--' : number_format($leave7_hours . '.' . $leave7_minutes, 2, '.', '');

		$leave8_minutes1 = $leave8_minutes;
		$leave8_hours = floor($leave8_minutes /60);
		$leave8_minutes = number_format($leave8_minutes %60,2);
		$leave8_final = $leave8_hours == 0 ? '--' : number_format($leave8_hours . '.' . $leave8_minutes, 2, '.', '');
		
		$totalleaveminutes  = 0;
		for ($leave_counter = 0; $leave_counter<9; $leave_counter++)
		{
			$leave_variable = "leave".$leave_counter . "_minutes1";
			$totalleaveminutes += $$leave_variable;
		}
		
		$totalleavehours = floor($totalleaveminutes / 60);
		$totalleaveminutes = $totalleaveminutes % 60;
		
		$totalleaveminutes = $totalleaveminutes == 0 ? '--' : number_format($totalleavehours . '.' . $totalleaveminutes, 2, '.', '');

		$LeftColTotal_hours = floor($totleavehrs / 60);
		$LeftColTotal_minutes = $totleavehrs % 60;
		$LeftColTotal_hrsmin = $LeftColTotal_hours == 0 ? '--' : number_format($LeftColTotal_hours . '.' . $LeftColTotal_minutes, 2, '.', '');

                $Tothrs = ($Tothrs == '--') ? $Tothrs : $employee->fomate_to_time($Tothrs);
                $leave0_final = ($leave0_final == '--') ? $leave0_final : $employee->fomate_to_time($leave0_final);
                $leave1_final = ($leave1_final == '--') ? $leave1_final : $employee->fomate_to_time($leave1_final);
                $leave2_final= ($leave2_final == '--') ? $leave2_final : $employee->fomate_to_time($leave2_final);
                $leave3_final = ($leave3_final == '--') ? $leave3_final : $employee->fomate_to_time($leave3_final);
                $leave4_final = ($leave4_final == '--') ? $leave4_final : $employee->fomate_to_time($leave4_final);
                $leave5_final = ($leave5_final == '--') ? $leave5_final : $employee->fomate_to_time($leave5_final);
                $leave6_final = ($leave6_final == '--') ? $leave6_final : $employee->fomate_to_time($leave6_final);
                $leave7_final = ($leave7_final == '--') ? $leave7_final : $employee->fomate_to_time($leave7_final);
                $leave8_final = ($leave8_final == '--') ? $leave8_final : $employee->fomate_to_time($leave8_final);
                $LeftColTotal_hrsmin = ($LeftColTotal_hrsmin == '--') ? $LeftColTotal_hrsmin : $employee->fomate_to_time($LeftColTotal_hrsmin);
                if($LeftColTotal_hrsmin != '--'){
                    if($falg%2 == 0)
                    {
                            $html .= '<tr style="color:#666; background:#fff;">
                            <td align="center">'.$empnmshow.'</td>
                            <td align="center">'.$empname.'</td>	
                            <td align="center">'.$Tothrs.'</td>
                            <td align="center">'.$leave0_final.'</td>
                            <td align="center">'.$leave1_final.'</td>
                            <td align="center">'.$leave2_final.'</td>
                            <td align="center">'.$leave3_final.'</td>
                            <td align="center">'.$leave4_final.'</td>
                            <!--<td>'.$leave5_final.'</td>-->
                            <td align="center">'.$leave6_final.'</td>
                            <!--<td>'.$leave7_final.'</td>-->
                            <td align="center">'.$leave8_final.'</td>
                            <td align="center">'.$LeftColTotal_hrsmin.'</td>  
                            </tr>';	
                    }
                    else
                    {
                            $html .= '<tr style="color:#666; background:#E3EDF0;">
                            <td align="center">'.$empnmshow.'</td>
                            <td align="center">'.$empname.'</td>	
                            <td align="center">'.$Tothrs.'</td>
                            <td align="center">'.$leave0_final.'</td>
                            <td align="center">'.$leave1_final.'</td>
                            <td align="center">'.$leave2_final.'</td>
                            <td align="center">'.$leave3_final.'</td>
                            <td align="center">'.$leave4_final.'</td>
                            <!--<td>'.$leave5_final.'</td>-->
                            <td align="center">'.$leave6_final.'</td>
                            <!--<td>'.$leave7_final.'</td>-->
                            <td align="center">'.$leave8_final.'</td>
                            <td align="center">'.$LeftColTotal_hrsmin.'</td>  
                            </tr>';	
                    }	
                }
	}
	
	$leave0_total_hours = floor($total_leave_minutes[0] /60);
	$leave0_total_minutes = $total_leave_minutes[0] %60;
	$leave0_total_final = $leave0_total_hours == 0 ? '--' : number_format($leave0_total_hours . '.' . $leave0_total_minutes, 2, '.', '');
			
	$leave1_total_hours = floor($total_leave_minutes[1] /60);
	$leave1_total_minutes = $total_leave_minutes[1] %60;
	$leave1_total_final = $leave1_total_hours == 0 ? '--' : number_format($leave1_total_hours . '.' . $leave1_total_minutes, 2, '.', '');
	
	$leave2_total_hours = floor($total_leave_minutes[2] /60);
	$leave2_total_minutes = $total_leave_minutes[2] %60;
	$leave2_total_final = $leave2_total_hours == 0 ? '--' : number_format($leave2_total_hours . '.' . $leave2_total_minutes, 2, '.', '');
	
	$leave3_total_hours = floor($total_leave_minutes[3] /60);
	$leave3_total_minutes = $total_leave_minutes[3] %60;
	$leave3_total_final = $leave3_total_hours == 0 ? '--' : number_format($leave3_total_hours . '.' . $leave3_total_minutes, 2, '.', '');

	$leave4_total_hours = floor($total_leave_minutes[4] /60);
	$leave4_total_minutes = $total_leave_minutes[4] %60;
	$leave4_total_final = $leave4_total_hours == 0 ? '--' : number_format($leave4_total_hours . '.' . $leave4_total_minutes, 2, '.', '');

	$leave5_total_hours = floor($total_leave_minutes[5] /60);
	$leave5_total_minutes = $total_leave_minutes[5] %60;
	$leave5_total_final = $leave5_total_hours == 0 ? '--' : number_format($leave5_total_hours . '.' . $leave5_total_minutes, 2, '.', '');

	$leave6_total_hours = floor($total_leave_minutes[6] /60);
	$leave6_total_minutes = $total_leave_minutes[6] %60;
	$leave6_total_final = $leave6_total_hours == 0 ? '--' : number_format($leave6_total_hours . '.' . $leave6_total_minutes, 2, '.', '');

	$leave7_total_hours = floor($total_leave_minutes[7] /60);
	$leave7_total_minutes = $total_leave_minutes[7] %60;
	$leave7_total_final = $leave7_total_hours == 0 ? '--' : number_format($leave7_total_hours . '.' . $leave7_total_minutes, 2, '.', '');

	$leave8_total_hours = floor($total_leave_minutes[8] /60);
	$leave8_total_minutes = $total_leave_minutes[8] %60;
	$leave8_total_final = $leave8_total_hours == 0 ? '--' : number_format($leave8_total_hours . '.' . $leave8_total_minutes, 2, '.', '');
	
	for($leave_counter =0;$leave_counter<9;$leave_counter++)
	{
		$leave_total_final_minutes += $total_leave_minutes[$leave_counter];
	}


	$TotalWorkingHours = floor($TotalWorkingMinutes / 60);
	$TotalWorkingMinutes = $TotalWorkingMinutes % 60;
	$FinalWorkingHours = number_format($TotalWorkingHours.'.'.$TotalWorkingMinutes, 2, '.', '');
	
	$TotalLeaveHours = floor($leave_total_final_minutes / 60);
	$TotalLeaveMinutes = $leave_total_final_minutes % 60;
	$FinalLeaveHours = $TotalLeaveHours > 0 ? number_format($TotalLeaveHours.'.'.$TotalLeaveMinutes, 2, '.', '') : "--";
		
        $FinalWorkingHours = ($FinalWorkingHours == '--') ? $FinalWorkingHours : $employee->fomate_to_time($FinalWorkingHours);
        $leave0_total_final = ($leave0_total_final == '--') ? $leave0_total_final : $employee->fomate_to_time($leave0_total_final);
        $leave1_total_final = ($leave1_total_final == '--') ? $leave1_total_final : $employee->fomate_to_time($leave1_total_final);
        $leave2_total_final = ($leave2_total_final == '--') ? $leave2_total_final : $employee->fomate_to_time($leave2_total_final);
        $leave3_total_final = ($leave3_total_final == '--') ? $leave3_total_final : $employee->fomate_to_time($leave3_total_final);
        $leave4_total_final = ($leave4_total_final == '--') ? $leave4_total_final : $employee->fomate_to_time($leave4_total_final);
        $leave5_total_final = ($leave5_total_final == '--') ? $leave5_total_final : $employee->fomate_to_time($leave5_total_final);
        $leave6_total_final = ($leave6_total_final == '--') ? $leave6_total_final : $employee->fomate_to_time($leave6_total_final);
        $leave7_total_final = ($leave7_total_final == '--') ? $leave7_total_final : $employee->fomate_to_time($leave7_total_final);
        $leave8_total_final = ($leave8_total_final == '--') ? $leave8_total_final : $employee->fomate_to_time($leave8_total_final);
        $FinalLeaveHours = ($FinalLeaveHours == '--') ? $FinalLeaveHours : $employee->fomate_to_time($FinalLeaveHours);

	$html .= '<tr style="background:#DAF2F7; color:#666;">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="center">'.$FinalWorkingHours.'</th>
				<th align="center">'.$leave0_total_final.'</th>
				<th align="center">'.$leave1_total_final.'</th>
				<th align="center">'.$leave2_total_final.'</th>
				<th align="center">'.$leave3_total_final.'</th>
				<th align="center">'.$leave4_total_final.'</th>
				<!--<th>'.$leave5_total_final.'</th>-->
				<th align="center">'.$leave6_total_final.'</th>
				<!--<th>'.$leave7_total_final.'</th>-->
				<th align="center">'.$leave8_total_final.'</th>
				<th align="center">'.$FinalLeaveHours.'</th>                    
			</tr>	
			</table>';	
		
		$FinalLeaveHours = 0;
									
	$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	$mpdf->WriteHTML($html,2);		
	$mpdf->Output('Employee_Absence_Report.pdf', 'D');
	// $mpdf->Output();
	?>
	<script type="application/javascript">
		window.close();
	</script>
	<?php
exit;
}
else
{
	?>
	<script type="application/javascript">
		window.close();
	</script>
	<?php
exit;
}
?>
