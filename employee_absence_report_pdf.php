<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('plugins/MPDF54/mpdf.php');
require_once('class/dona.php');
require_once('configs/config.inc.php');
require_once ('class/converter.php');
//require_once('class/equipment.php');
//require_once('class/customer.php');
$smarty = new smartySetup(array("gdschema.xml", "user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
$employee = new employee();
$obj_dona = new dona();
$obj_converter = new converter(array(), array(), date('Y'));
//$customer = new customer();
//$equipment = new equipment();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

//echo "<pre>".print_r($query_string, 1)."</pre>";

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
global $leave_type;
//$name = str_replace('_',' ',$pram[$totparam-3]);
/*
//if($_COOKIE['debug'] == 'true') echo "params <pre>".print_r(array($name,$fromdate,$todate), 1)."</pre>";
$employees = $employee->empgriddata($name,$fromdate,$todate);
//if($_COOKIE['debug'] == 'true') 
//    echo "except_employees<pre>".print_r($employees, 1)."</pre>";
$except_employees = array();
if(count($employees)> 0){
    foreach ($employees as $this_employee){
        if(!in_array($this_employee['username'], $except_employees)){
            $except_employees[] = $this_employee['username'];
        }
    }
}

//if($_COOKIE['debug'] == 'true') echo "except_employees after<pre>".print_r($except_employees, 1)."</pre>";
$except_employees_string = '\'' . implode('\', \'', $except_employees) . '\'';
$leave_only_employees = $employee->empgriddata_leave($name,$fromdate,$todate, $except_employees_string);
//echo "<pre>leave_only_employees".print_r($leave_only_employees, 1)."</pre>";

$employees = array_merge($employees, $leave_only_employees);*/
// print_r($leave_types_array);exit();
$employees = $employee->empgriddata_including_leave($name,$fromdate,$todate, $leave_types_array);
$employee_typeof_leave = $employees;
// print_r($leave_types_array);exit();
for($i=0;$i<count($employees);$i++){
    $low = $employees[$i];
    for($j=$i+1;$j<count($employees);$j++){
        if(strcasecmp($employees[$j]['emplname']." ".$employees[$j]['empfname'],$low['emplname']." ".$low['empfname']) < 0){
            $temp = $low;
            $low = $employees[$j];
            $employees[$j] = $temp;
        }
    }
    $employees[$i] = $low;
}
//if($_COOKIE['debug'] == 'true') echo "employees pre<pre>".print_r($employees, 1)."</pre>";
/*$temp_employee = array();
for($i=0;$i<count($employees);$i++){
    if($employee->check_slot_leave($employees[$i]['username'],$employees[$i]['customer'],$fromdate,$todate)){
        $temp_employee[] = $employees[$i];
    }
}

$employees = $temp_employee;*/
//echo "<pre>". print_r($employees, 1)."</pre>";exit();

//-----------------------------------calculating karense details---------------------------------------------------
$unique_emp_names = array();
if(!empty($employees)){
    foreach($employees as $emp){
        if(!in_array($emp['username'], $unique_emp_names))
                $unique_emp_names[] = $emp['username'];
    }
}
$tot = count($employees);
$div = $tot; 
if($tot > 0){
	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	
	for($i=0;$i<$div;$i++){
	
			
		if($tot == ($falg+1)){
			$last = $tot;	
		}else{
			$last = $falg+10 ;
		}
		
		if($div == ($i+1)){
			$last = $tot;
		}
		$last = $tot;
		//echo $last;exit();
	    
	    $html = '<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				<tr style="background:#DAF2F7; color:#666;">
					<th style="text-align:left;">'.$smarty->localise->contents['employee'].': '.'</th>
					<th style="text-align:left;">'.$smarty->localise->contents['from_date'].': '.'</th>	
					<th style="text-align:left;">'.$smarty->localise->contents['to_date'].': '.'</th>
				<tr>
				<tr style="background:#DAF2F7; color:#666;">
					<td>'.$selected_employee_name.'</td>
					<td>'.$fromdate.'</td>	
					<td>'.$todate.'</td>
				<tr>
			</table><br/>';
			
		$html .='<table border="1" cellpadding="0" cellspacing="0"   >
		<tr style="background:#DAF2F7; color:#666;">
					<th align="left">'.$smarty->localise->contents['employee'].'</th>
					<th align="left">'.$smarty->localise->contents['customer'].'</th>
					<th>'.$smarty->localise->contents['total_working_hours'].'</th>
					<!--<th>'.$smarty->localise->contents['sickness'].'</th>
					<th>'.$smarty->localise->contents['sem'].'</th>
					<th>'.$smarty->localise->contents['vab'].'</th>
					<th>'.$smarty->localise->contents['fp'].'</th>
					<th>'.$smarty->localise->contents['pmeeting'].'</th>
					<th>'.$smarty->localise->contents['education'].'</th>
					<th>'.$smarty->localise->contents['other'].'</th>
					<th>'.$smarty->localise->contents['bandwidth'].'</th>-->';
					// print_r($leave_type);

				for($k = 0;$k<count($leave_types_array);$k++){
					$html .='<th>'.$leave_type[$leave_types_array[$k]].'</th>';
				}	

                // foreach($leave_type AS $leave=>$type){
                //     echo '<th>'.$type.'</th>';
                // }

                $html .='<th>'.$smarty->localise->contents['total_leaves'].'</th>
				</tr>';
				
		$grandtotleavetype = array();
		$total_leave_minutes = array();			
		$emprepeat = '';
		$customer_leave_total = 0;
		$totleavehrs = 0;
		$TotalWorkingMinutes = 0;
		$MyFinalLeave_Toal = 0;
		$get_minutes = array();
		for($j=0;$j<$last;$j++){
			$usernm = $employees[$falg]['username'];
			if($username != $usernm){
				$username = $usernm;	
			}
			
			$leavearr = array();			
			$leavearr = $employee->getempleave($usernm,$fromdate,$todate);
			// echo "<pre>". print_r($leavearr, 1)."</pre>";exit();
			$empusername = $employees[$falg]['username'];			
			$custusername = $employees[$falg]['customer'];
			if($_SESSION['company_sort_by'] == 1){
                            $empname = $employees[$falg]['empfname'].', '.$employees[$falg]['emplname'];	
                            $custname = $employees[$falg]['custfname'].', '.$employees[$falg]['custlname'];
                        }elseif($_SESSION['company_sort_by'] == 2){
                            $empname = $employees[$falg]['emplname'].', '.$employees[$falg]['empfname'];	
                            $custname = $employees[$falg]['custlname'].', '.$employees[$falg]['custfname'];
                        }
			$Tothrs = $employees[$falg]['hrsmins'];
			$Tothrs = number_format($Tothrs, 2, '.', '');
			
			$ltype = number_format($Tothrs, 2, '.', '');
			$divi = substr(strstr($ltype,'.'),1);
			$base = substr($ltype,0,-3);
			$Hours_minutes = ($base*60)+$divi;
				
			$totalMinutes = 0;
			$totalMinutes = $employees[$falg]["totalMinutes"];
			
			$TotalWorkingMinutes += $Hours_minutes;
			//$TotalWorkingMinutes += $totalMinutes;

			$totleavehrs = 0;
			$leave_minutes = array();
			for($k =0; $k<count($leave_types_array);$k++){
                if(!empty($leavearr[$empusername][$custusername][$leave_types_array[$k]])){
                    $leave_minutes[$leave_types_array[$k]] = $leavearr[$empusername][$custusername][$leave_types_array[$k]];
                    $totleavehrs += $leavearr[$empusername][$custusername][$leave_types_array[$k]]; 
                    $total_leave_minutes[$leave_types_array[$k]] += $leavearr[$empusername][$custusername][$leave_types_array[$k]];
                }
                else{
                    $leave_minutes[$leave_types_array[$k]] = 0;
                }
            }	
			if($tot >= $falg+1)
			{
				
				if($emprepeat == $empname)
				{
					$empnmshow =  '';
				}
				else
				{
					$emprepeat = $empname;
					$empnmshow = $empname;
				}				
				
				$leave_minutes1 = array();
				$leave_final = array();
				$get_minutes = array();
				for($k=0;$k<count($leave_types_array);$k++){
					$leave_minutes1[$leave_types_array[$k]] =  $leave_minutes[$leave_types_array[$k]];
					$leave0_hours = floor($leave_minutes1[$leave_types_array[$k]] /60);
					$leave0_minutes = $leave_minutes1[$leave_types_array[$k]] %60;
					$leave_final[$leave_types_array[$k]] = $leave0_hours == 0 ? '--' : number_format($leave0_hours . '.' . $leave0_minutes, 2, '.', '');
           			$leave_final[$leave_types_array[$k]] = ($leave_final[$leave_types_array[$k]] == '--') ? $leave_final[$leave_types_array[$k]] : $employee->fomate_to_time($leave_final[$leave_types_array[$k]]);
					$ltype = $leave_final[$leave_types_array[$k]];
					$divi = substr(strstr($ltype,'.'),1);
					$base = substr($ltype,0,-3);
					$get_minutes[$leave_types_array[$k]] += ($base*60)+$divi;
					// $leave_final = ($leave_final == '--') ? $leave_final : $employee->fomate_to_time($leave_final);
				}
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
				
				$My_totalMinutes_hrs = floor($totalMinutes / 60);
				$My_totalMinutes_mins = $totalMinutes % 60;
				$My_totalMinutes_final = $My_totalMinutes_hrs == 0 ? '--' : number_format($My_totalMinutes_hrs . '.' . $My_totalMinutes_mins, 2, '.', '');
				// echo "<pre>". print_r($leave_final)."</pre>";
				// echo array_sum($leave_final);
				$leav_final_sum = array_sum($leave_final);
                // echo $sumof_all_leaves = ($leav_final_sum == '--') ? $leav_final_sum : $employee->fomate_to_time($leav_final_sum);
                $sumof_all_leaves = ($leav_final_sum == '--') ? $leav_final_sum : sprintf('%05.02f', round($leav_final_sum, 2));
				$Tothrs = ($Tothrs == '--') ? $Tothrs : $employee->fomate_to_time($Tothrs);
                $LeftColTotal_hrsmin = ($LeftColTotal_hrsmin == '--') ? $LeftColTotal_hrsmin : $employee->fomate_to_time($LeftColTotal_hrsmin);
               	$toatal_leave_array = array($leave0_final,$leave1_final,$leave2_final,$leave3_final,$leave4_final,$leave5_final,$leave6_final,$leave7_final,$leave8_final);
                               // echo "<pre>".print_r($leave_final,1)."</pre>"; 
                   if($LeftColTotal_hrsmin != '--'){
                    	$html .='<tr style="color:#666; background:#fff;">
                                <td class="usertdname" align="left">&nbsp;'.$empnmshow.'&nbsp;</td>
                                <td class="usertdname" align="left">&nbsp;'.$custname.'&nbsp;</td>	
                                <td align="center">'.$Tothrs.'</td>';
                         for($k = 0;$k<count($leave_types_array);$k++){
                         	 $html .='<td align="center">'.$leave_final[$leave_types_array[$k]].'</td>';   
                         }
                         $html .='<td align="center">'.$sumof_all_leaves.'</td>';
                    }
			}
			$falg++;
		}
		
		$leave_total_final =array();
		for($k=0;$k<count($leave_types_array);$k++){
			$leave_total_hours = floor($total_leave_minutes[$leave_types_array[$k]] /60);
			$leave_total_minutes = $total_leave_minutes[$leave_types_array[$k]] %60;
			$leave_total_final[$leave_types_array[$k]] = $leave_total_hours == 0 ? '--' : number_format($leave_total_hours . '.' . $leave_total_minutes, 2, '.', '');
        	$leave_total_final[$leave_types_array[$k]] = ($leave_total_final[$leave_types_array[$k]] == '--') ? $leave_total_final[$leave_types_array[$k]] : $employee->fomate_to_time($leave_total_final[$leave_types_array[$k]]);

		}
		// echo "<pre>".print_r($leave_total_final)."</pre>";

		
		
		$leave_total_final_minutes = 0;
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

		$get_minutes_final = array();
		// echo "<pre>".print_r($get_minutes)."</pre>";
		for($k=0;$k<count($leave_types_array);$k++){
			$myhrs = $get_minutes[$leave_types_array[$k]];
			$get_minutes_hrs = floor($myhrs/60);
			$get_minutes_mins = $myhrs%60; 
			$get_minutes_final[$leave_types_array[$k]] = $get_minutes_hrs > 0 ? number_format($get_minutes_hrs.'.'.$get_minutes_mins, 2, '.', '') : '--';
			// $get_minutes_final_actual[$leave_types_array[$i]] = ($get_minutes_final[$leave_types_array[$i]] == '--') ? $get_minutes_final[$leave_types_array[$i]] : $employee->fomate_to_time($get_minutes_final[$leave_types_array[$i]]);
		}
		// echo "<pre>".print_r($get_minutes_final)."</pre>";
		
		$MyFinalLeave = 0;
		for($y=0;$y<9;$y++)
		{
			$MyFinalLeave	+= $get_minutes[$y];
		}
		$MyFinalLeave_Toal = 0;	
		$MyFinalLeave_hours		= floor($MyFinalLeave/60);
		$MyFinalLeave_Minutes	= $MyFinalLeave%60; 
		//$MyFinalLeave_Toal		=  $MyFinalLeave_hours.'.'.$MyFinalLeave_Minutes;
		$MyFinalLeave_Toal = $MyFinalLeave_hours > 0 ? number_format($MyFinalLeave_hours.'.'.$MyFinalLeave_Minutes, 2, '.', '') : '--';		
	
                
                $FinalWorkingHours = ($FinalWorkingHours == '--') ? $FinalWorkingHours : $employee->fomate_to_time($FinalWorkingHours);
                $MyFinalLeave_Toal = ($MyFinalLeave_Toal == '--') ? $MyFinalLeave_Toal : $employee->fomate_to_time($MyFinalLeave_Toal);
                $global_total = array_sum($leave_total_final);
                // $global_total = ($global_total == '--') ? $global_total : $employee->fomate_to_time($global_total);
                $global_total = ($global_total == '--') ? $global_total : sprintf('%05.02f', round($global_total, 2));
		$html .='<tr style="background:#DAF2F7; color:#666;">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>'. $FinalWorkingHours .'</th>';
		for($k = 0;$k<count($leave_types_array);$k++){
	     	 $html .='<th>'.$leave_total_final[$leave_types_array[$k]].'</th>'; 
	    }  
        $html .='<th>'.$global_total	.'</th>
        		</tr></table></div></div></div>';
		
		$FinalLeaveHours = 0;
		
	//echo "<pre>".print_r($html,1)."</pre>";  	
									
	$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	$mpdf->WriteHTML($html,2);		
	$mpdf->Output('Employee_Absence_Report.pdf','D');
	// $mpdf->Output();
	?>
	<script type="application/javascript">
	window.close();
	</script>
	<?php
exit;
}
}else
{
	?>
	<script type="application/javascript">
	window.close();
	</script>
	<?php
exit;
}
exit;


// error_reporting(E_ALL);
// 						error_reporting(E_WARNING);
// 						ini_set('error_reporting', E_ALL);
// 						ini_set("display_errors", 1);
//custgriddata/
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
//require_once('class/equipment.php');
//require_once('class/customer.php');
require_once('class/employee.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
//$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
//$customer = new customer();
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
//var_dump($leave_types_array);exit();

global $leave_type;
/*$employees = $employee->empgriddata($name,$fromdate,$todate);
$except_employees = array();
if(count($employees)> 0){
    foreach ($employees as $this_employee){
        if(!in_array($this_employee['username'], $except_employees)){
            $except_employees[] = $this_employee['username'];
        }
    }
}
$except_employees_string = '\'' . implode('\', \'', $except_employees) . '\'';
$leave_only_employees = $employee->empgriddata_leave($name,$fromdate,$todate, $except_employees_string);
$employees = array_merge($employees, $leave_only_employees);
for($i=0;$i<count($employees);$i++){
    if($employee->check_slot_leave($employees[$i]['username'],$employees[$i]['customer'],$fromdate,$todate)){
//        echo "<br> dfsfad".$employees[$i]['username']."  ".$employees[$i]['customer'];
        $temp_employee[] = $employees[$i];
    }
}
$employees =$temp_employee;
*/
$employees = $employee->empgriddata_including_leave($name,$fromdate,$todate, $leave_types_array);
//echo "<pre>".print_r($employees, 1)."<pre>"; exit();
$tot = count($employees);


if($tot > 0){

	$selected_employee_name = ($name != '' && $name != '-' ? ($_SESSION['company_sort_by'] == 1 ? $employees[0]['empfname'].' '.$employees[0]['emplname'] : $employees[0]['emplname'].' '.$employees[0]['empfname']) : NULL);

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
					<th style="text-align:left;">'.$smarty->localise->contents['employee'].': '.'</th>
					<th style="text-align:left;">'.$smarty->localise->contents['from_date'].': '.'</th>	
					<th style="text-align:left;">'.$smarty->localise->contents['to_date'].': '.'</th>
				<tr>
				<tr style="background:#DAF2F7; color:#666;">
					<td>'.$selected_employee_name.'</td>
					<td>'.$fromdate.'</td>	
					<td>'.$todate.'</td>
				<tr>
			</table><br/>';


	$html .= '<table border="1" cellpadding="0" cellspacing="0"   >
		<tr style="background:#DAF2F7; color:#666;">
			<th>'.$smarty->localise->contents['employee'].'</th>
			<th>'.$smarty->localise->contents['customer'].'</th>	
			<th>'.$smarty->localise->contents['total_working_hours'].'</th>
			<!--<th>'.$smarty->localise->contents['sickness'].'</th>
			<th>'.$smarty->localise->contents['sem'].'</th>
			<th>'.$smarty->localise->contents['vab'].'</th>
			<th>'.$smarty->localise->contents['fp'].'</th>
			<th>'.$smarty->localise->contents['pmeeting'].'</th>
			<th>'.$smarty->localise->contents['education'].'</th>
			<th>'.$smarty->localise->contents['other'].'</th>
			<th>'.$smarty->localise->contents['bandwidth'].'</th>-->';
			// print_r($leave_types_array);  print_r($leave_type); exit();
			for($i =1;$i<=count($leave_types_array);$i++){
			     if($leave_type[$leave_types_array[$i]] != '' && $leave_type[$leave_types_array[$i]] != null)
				    $html .= '<th>'.$leave_type[$leave_types_array[$i]].'</th>';
			}	
			// $html ='<!--<th>'.$smarty->localise->contents['bandwidth'].'</th>-->;

	        
	        $html .= '<th>'.$smarty->localise->contents['total_leaves'].'</th>
		<tr>';
		
	for($falg=0;$falg<$tot;$falg++)	 {
		$usernm = $employees[$falg]['username'];
		if($username != $usernm)
		{
			$username = $usernm;	
		}
		
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

		$leave_minutes = array();
		$ltype = array();
		$leave_minutes1 = array();
		for($i=1; $i<=count($leave_types_array);$i++){
	
		    $val = $leavearr[$empusername][$custusername][$i];
		 
			if(!empty($leavearr[$empusername][$custusername][$i])){
			   
				$leave_minutes[$i] = $leavearr[$empusername][$custusername][$i];
				$totleavehrs += $leave_minutes[$i];
				$total_leave_minutes[$i] += $leavearr[$empusername][$custusername][$i];
			}
			else{
				$ltype[$i] = 0;
			}
		}
		//echo $custusername;
		
		for($i=1;$i<=count($leave_types_array);$i++){
			$leave_minutes1[$leave_types_array[$i]] =  $leave_minutes[$leave_types_array[$i]];
			echo $i;var_dump($leave_minutes1);var_dump($leave_types_array[$i]);
			$leave0_hours = floor($leave_minutes1[$leave_types_array[$i]] /60);
			$leave0_minutes = $leave_minutes1[$leave_types_array[$i]] %60;
			$leave_final[$leave_types_array[$i]] = $leave0_hours == 0 ? '--' : number_format($leave0_hours . '.' . $leave0_minutes, 2, '.', '');
            $leave_final[$leave_types_array[$i]] = ($leave_final[$leave_types_array[$i]] == '--') ? $leave_final[$leave_types_array[$i]] : $employee->fomate_to_time($leave_final[$leave_types_array[$i]]);

		}
		var_dump($leave_minutes1);exit();
		$totalleaveminutes  = 0;
		for ($leave_counter = 0; $leave_counter<9; $leave_counter++)
		{
			$leave_variable = "leave".$leave_counter . "_minutes1";
			$totalleaveminutes += $$leave_variable;
		}
		if($emprepeat == $empname)
				{
					$empnmshow =  '';
				}
				else
				{
					$emprepeat = $empname;
					$empnmshow = $empname;
				}	
				
		$totalleavehours = floor($totalleaveminutes / 60);
		$totalleaveminutes = $totalleaveminutes % 60;
		
		$totalleaveminutes = $totalleaveminutes == 0 ? '--' : number_format($totalleavehours . '.' . $totalleaveminutes, 2, '.', '');

		$LeftColTotal_hours = floor($totleavehrs / 60);
		$LeftColTotal_minutes = $totleavehrs % 60;
		$LeftColTotal_hrsmin = $LeftColTotal_hours == 0 ? '--' : number_format($LeftColTotal_hours . '.' . $LeftColTotal_minutes, 2, '.', '');
		$leav_final_sum = array_sum($leave_final);
		//echo '<pre>';print_r($leave_final);exit();
        // $sumof_all_leaves = ($leav_final_sum == '--') ? $leav_final_sum : $employee->fomate_to_time($leav_final_sum);
        $sumof_all_leaves = ($leav_final_sum == '--') ? $leav_final_sum : sprintf('%05.02f', round($leav_final_sum, 2));
                $Tothrs = ($Tothrs == '--') ? $Tothrs : $employee->fomate_to_time($Tothrs);
                $LeftColTotal_hrsmin = ($LeftColTotal_hrsmin == '--') ? $LeftColTotal_hrsmin : $employee->fomate_to_time($LeftColTotal_hrsmin);
                if($LeftColTotal_hrsmin != "--"){               
                    if($falg%2 == 0)
                    {
                            $html .= '<tr style="color:#666; background:#fff;">
                            <td align="center">'.$empnmshow.'</td>
                            <td align="center">'.$custname.'</td>	
                            <td align="center">'.$Tothrs.'</td>';
                            for($i =1;$i<=count($leave_types_array);$i++){
                               if($leave_type[$leave_types_array[$i]] == '' && $leave_type[$leave_types_array[$i]] == null)
		                            continue;
                         	   $html .=  '<td align="center">'.$leave_final[$leave_types_array[$i]].'</td>';   
                         	}	
                             $html .= '<td align="center">'.$sumof_all_leaves.'</td>  
                            </tr>';	
                    }
                    else
                    {
                            $html .= '<tr style="color:#666; background:#fff;">
                            <td align="center">'.$empnmshow.'</td>
                            <td align="center">'.$custname.'</td>	
                            <td align="center">'.$Tothrs.'</td>';
                            for($i =1;$i<=count($leave_types_array);$i++){
                                if($leave_type[$leave_types_array[$i]] == '' && $leave_type[$leave_types_array[$i]] == null)
		                            continue;
                         	   $html .=  '<td align="center">'.$leave_final[$leave_types_array[$i]].'</td>';   
                         	}	
                             $html .= '<td align="center">'.$sumof_all_leaves.'</td>  
                            </tr>';		
                    }	
                }
	}
	
	var_dump($html);exit();
			
	$leave_total_final = array();
	for($i=1;$i<=count($leave_types_array);$i++){
		$leave_total_hours = floor($total_leave_minutes[$leave_types_array[$i]] /60);
		$leave_total_minutes = $total_leave_minutes[$leave_types_array[$i]] %60;
		$leave_total_final[$leave_types_array[$i]] = $leave_total_hours == 0 ? '--' : number_format($leave_total_hours . '.' . $leave_total_minutes, 2, '.', '');
        $leave_total_final[$leave_types_array[$i]] = ($leave_total_final[$leave_types_array[$i]] == '--') ? $leave_total_final[$leave_types_array[$i]] : $employee->fomate_to_time($leave_total_final[$leave_types_array[$i]]);

	}	
	// echo "<pre>".print_r($leave_total_final,1)."</pre>";  exit();
	// $leave0_total_hours = floor($total_leave_minutes[0] /60);
	// $leave0_total_minutes = $total_leave_minutes[0] %60;
	// $leave0_total_final = $leave0_total_hours == 0 ? '--' : number_format($leave0_total_hours . '.' . $leave0_total_minutes, 2, '.', '');
			
	// $leave1_total_hours = floor($total_leave_minutes[1] /60);
	// $leave1_total_minutes = $total_leave_minutes[1] %60;
	// $leave1_total_final = $leave1_total_hours == 0 ? '--' : number_format($leave1_total_hours . '.' . $leave1_total_minutes, 2, '.', '');
	
	// $leave2_total_hours = floor($total_leave_minutes[2] /60);
	// $leave2_total_minutes = $total_leave_minutes[2] %60;
	// $leave2_total_final = $leave2_total_hours == 0 ? '--' : number_format($leave2_total_hours . '.' . $leave2_total_minutes, 2, '.', '');
	
	// $leave3_total_hours = floor($total_leave_minutes[3] /60);
	// $leave3_total_minutes = $total_leave_minutes[3] %60;
	// $leave3_total_final = $leave3_total_hours == 0 ? '--' : number_format($leave3_total_hours . '.' . $leave3_total_minutes, 2, '.', '');

	// $leave4_total_hours = floor($total_leave_minutes[4] /60);
	// $leave4_total_minutes = $total_leave_minutes[4] %60;
	// $leave4_total_final = $leave4_total_hours == 0 ? '--' : number_format($leave4_total_hours . '.' . $leave4_total_minutes, 2, '.', '');

	// $leave5_total_hours = floor($total_leave_minutes[5] /60);
	// $leave5_total_minutes = $total_leave_minutes[5] %60;
	// $leave5_total_final = $leave5_total_hours == 0 ? '--' : number_format($leave5_total_hours . '.' . $leave5_total_minutes, 2, '.', '');

	// $leave6_total_hours = floor($total_leave_minutes[6] /60);
	// $leave6_total_minutes = $total_leave_minutes[6] %60;
	// $leave6_total_final = $leave6_total_hours == 0 ? '--' : number_format($leave6_total_hours . '.' . $leave6_total_minutes, 2, '.', '');

	// $leave7_total_hours = floor($total_leave_minutes[7] /60);
	// $leave7_total_minutes = $total_leave_minutes[7] %60;
	// $leave7_total_final = $leave7_total_hours == 0 ? '--' : number_format($leave7_total_hours . '.' . $leave7_total_minutes, 2, '.', '');

	// $leave8_total_hours = floor($total_leave_minutes[8] /60);
	// $leave8_total_minutes = $total_leave_minutes[8] %60;
	// $leave8_total_final = $leave8_total_hours == 0 ? '--' : number_format($leave8_total_hours . '.' . $leave8_total_minutes, 2, '.', '');
	
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
	$global_total = array_sum($leave_total_final);
    // $global_total = ($global_total == '--') ? $global_total : $employee->fomate_to_time($global_total);
    $global_total = ($global_total == '--') ? $global_total : sprintf('%05.02f', round($global_total, 2));
        $FinalWorkingHours = ($FinalWorkingHours == '--') ? $FinalWorkingHours : $employee->fomate_to_time($FinalWorkingHours);
        // $leave0_total_final = ($leave0_total_final == '--') ? $leave0_total_final : $employee->fomate_to_time($leave0_total_final);
        // $leave1_total_final = ($leave1_total_final == '--') ? $leave1_total_final : $employee->fomate_to_time($leave1_total_final);
        // $leave2_total_final = ($leave2_total_final == '--') ? $leave2_total_final : $employee->fomate_to_time($leave2_total_final);
        // $leave3_total_final = ($leave3_total_final == '--') ? $leave3_total_final : $employee->fomate_to_time($leave3_total_final);
        // $leave4_total_final = ($leave4_total_final == '--') ? $leave4_total_final : $employee->fomate_to_time($leave4_total_final);
        // $leave5_total_final = ($leave5_total_final == '--') ? $leave5_total_final : $employee->fomate_to_time($leave5_total_final);
        // $leave6_total_final = ($leave6_total_final == '--') ? $leave6_total_final : $employee->fomate_to_time($leave6_total_final);
        // $leave7_total_final = ($leave7_total_final == '--') ? $leave7_total_final : $employee->fomate_to_time($leave7_total_final);
        // $leave8_total_final = ($leave8_total_final == '--') ? $leave8_total_final : $employee->fomate_to_time($leave8_total_final);
        // echo $global_total; exit();
        $FinalLeaveHours = ($FinalLeaveHours == '--') ? $FinalLeaveHours : $employee->fomate_to_time($FinalLeaveHours);
        // $FinalLeaveHours = ($FinalLeaveHours == '--') ? $FinalLeaveHours : sprintf('%05.02f', round($FinalLeaveHours, 2));
	$html .= '<tr style="background:#DAF2F7; color:#666;">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="center">'.$FinalWorkingHours.'</th>';
				for($i =0;$i<=count($leave_types_array);$i++){
				    if($leave_type[$leave_types_array[$i]] == '' && $leave_type[$leave_types_array[$i]] == null)
	                    continue;
	     	 		 $html .= '<th>'.$leave_total_final[$leave_types_array[$i]].'</th>'; 
	    		}
				
				$html .= '<th align="center">'.$global_total.'</th>                    
			</tr>	
			</table>';	
		
		$FinalLeaveHours = 0;
		
	//echo "<pre>".print_r($html,1)."</pre>";  	
									
	$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	$mpdf->WriteHTML($html,2);		
	$mpdf->Output('Employee_Absence_Report.pdf','D');
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
