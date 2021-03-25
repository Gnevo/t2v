<?php
require_once('class/setup.php');
require_once('class/employee.php');
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
//echo "<pre>". print_r($unique_emp_names, 1)."</pre>";exit();
$karense_details = array();
if(!empty($unique_emp_names)){
    $obj_dona->leave_customer = NULL;
    foreach($unique_emp_names as $emp){
        $all_leave_works = $obj_dona->get_employee_leaved_timetable_works_between_dates($emp, $fromdate, $todate);
       //echo "<pre>$emp, $fromdate, $todate: ".print_r($all_leave_works, 1)."</pre>";exit();
        if(!empty($all_leave_works)){
            $obj_dona->leave_employee = $emp;
//            $get_previous_date_of_searched_leaves = date('Y-m-d', strtotime($fromdate . ' -10 days'));
//            $previous_days_leave_works = $obj_dona->get_employee_leaved_timetable_works_before_the_date($emp, $fromdate);
            //$qualifying_leave_works = $obj_dona->get_employee_leave_Qualifying_day_works_using_input_before_leaves($all_leave_works, $emp, $fromdate);
            
            $salary_mode = $employees[array_search($emp, array_column($employees, 'uid'))]['salary_type'];
            $all_leave_works = format_leave_array($all_leave_works);
            //echo "<pre>". print_r($all_leave_works, 1)."</pre>";exit();
            $qualifying_leave_works = $obj_converter->get_karens_data($emp, '', $all_leave_works, 'YEAR_MONTH', date('m', strtotime($fromdate)), date('Y', strtotime($fromdate)), NULL, 0.00,24.00,FALSE,'FROM_FORM',$salary_mode);
            //$karense_details[$emp] = array_column($qualifying_leave_works, 'actual_karens');
            $karense_details[$emp] = $qualifying_leave_works;
            
        }
    }
}
//echo "<pre>". print_r($karense_details, 1)."</pre>";exit();
//-----------------------------------calculating karense details endz---------------------------------------------------

//............................................calculating vab details....................................................
	$vab_details = array();
	$employee_vab_details = array();
	$single_emp_vab_details = array();
	if(!empty($unique_emp_names)){
	    $obj_dona->leave_customer = NULL;
	    foreach($unique_emp_names as $emp){
	        $all_vab_details = $obj_dona->get_employee_vab_details_timetable_works_between_dates($emp, $fromdate, $todate);
            if(!empty($all_vab_details)){
                // echo "<pre>".print_r($all_vab_details, 1)."<pre>";
    	        for($i = 0;$i<count($all_vab_details);$i++){
           		 	$single_emp_vab_details[] = $all_vab_details[$i]['date'];
    	        }
    	        $employee_vab_details[$emp] = array_unique($single_emp_vab_details);
            }
	    }
	     // echo "<pre>abc".print_r($employee_vab_details, 1)."</pre>";  
	}



//............................................ end of calculating vab details....................................................

// echo count($all_leave_works);
// echo "<pre>".print_r($all_leave_works,1)."</pre>";

// Vab details 
// print_r($leave_types_array);
// print_r($leavearre_type);
// echo $leave_type[$leave_types_array[2]];
$page = 10;
//if($_COOKIE['debug'] == 'true') echo "employees<pre>".print_r($employees, 1)."</pre>";
$tot = count($employees);
$div = ceil($tot/$page); 
if($tot > 0){
	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	
	for($i=0;$i<$div;$i++){
		if($i == 0){
			$show = 'style="display:block;"';
		}else{
			$show = 'style="display:none;"';	
		}
		?>
		<div id="showmain<?php echo $i;?>" <?php echo $show;?> >
		<input type="hidden" name="pages" id="pages" value="<?php echo $div;?>"/>
                <div class="row-fluid">
		<div class="pagention span12">
                    <div class="alphbts span8">
                        <ul>
                            <li><a onclick="select_employee(this.id);" id="A" style="cursor:pointer;" >A</a></li>
                            <li><a onclick="select_employee(this.id);" id="B" style="cursor:pointer;" >B</a></li>
                            <li><a onclick="select_employee(this.id);" id="C" style="cursor:pointer;" >C</a></li>
                            <li><a onclick="select_employee(this.id);" id="D" style="cursor:pointer;" >D</a></li>
                            <li><a onclick="select_employee(this.id);" id="E" style="cursor:pointer;" >E</a></li>
                            <li><a onclick="select_employee(this.id);" id="F"  style="cursor:pointer;">F</a></li>
                            <li><a onclick="select_employee(this.id);" id="G"  style="cursor:pointer;">G</a></li>
                            <li><a onclick="select_employee(this.id);" id="H" style="cursor:pointer;" >H</a></li>
                            <li><a onclick="select_employee(this.id);" id="I" style="cursor:pointer;" >I</a></li>
                            <li><a onclick="select_employee(this.id);" id="J" style="cursor:pointer;" >J</a></li>
                            <li><a onclick="select_employee(this.id);" id="K" style="cursor:pointer;" >K</a></li>
                            <li><a onclick="select_employee(this.id);" id="L" style="cursor:pointer;" >L</a></li>
                            <li><a onclick="select_employee(this.id);" id="M" style="cursor:pointer;" >M</a></li>
                            <li><a onclick="select_employee(this.id);" id="N" style="cursor:pointer;" >N</a></li>
                            <li><a onclick="select_employee(this.id);" id="O"  style="cursor:pointer;">O</a></li>
                            <li><a onclick="select_employee(this.id);" id="P" style="cursor:pointer;" >P</a></li>
                            <li><a onclick="select_employee(this.id);" id="Q"  style="cursor:pointer;" >Q</a></li>
                            <li><a onclick="select_employee(this.id);" id="R" style="cursor:pointer;" >R</a></li>
                            <li><a onclick="select_employee(this.id);" id="S" style="cursor:pointer;" >S</a></li>
                            <li><a onclick="select_employee(this.id);" id="T" style="cursor:pointer;" >T</a></li>
                            <li><a onclick="select_employee(this.id);" id="U"  style="cursor:pointer;">U</a></li>
                            <li><a onclick="select_employee(this.id);" id="V"  style="cursor:pointer;">V</a></li>
                            <li><a onclick="select_employee(this.id);" id="W" style="cursor:pointer;" >W</a></li>
                            <li><a onclick="select_employee(this.id);" id="X"  style="cursor:pointer;">X</a></li>
                            <li><a onclick="select_employee(this.id);" id="Y" style="cursor:pointer;" >Y</a></li>
                            <li><a onclick="select_employee(this.id);" id="Z" style="cursor:pointer;" >Z</a></li>
                            <li><a onclick="select_employee(this.id);" id="Å" name="Å" style="cursor:pointer;" >Å</a></li>
                            <li><a onclick="select_employee(this.id);" id="Ä" name="Ä" style="cursor:pointer;" >Ä</a></li>
                            <li><a onclick="select_employee(this.id);" id="Ö" name="Ö" style="cursor:pointer;" >Ö</a></li>
                        </ul>
                    </div>

                    <div class="pagention_dv span4">
                        <div class="pagination" style="margin:0px;float:right;">
                            <ul id="pagination">
                                    <?php
                                    $start = $i;
                                    $end = $start+3 > $div ? $div: $start+3;
                                    if($div > 0){
                                        if($i > 0){
                                            echo  '<li>
                                                  <a class="nxt" href="javascript:void(0);" onclick="showgrid('.($i).')">
                                                          <img src="'.$smarty->url.'images/first.png" style="margin-bottom:3px;">
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="javascript:void(0);" onclick="showgrid('.($i-1).')">
                                                          <img src="'.$smarty->url.'images/prev.png" style="margin-bottom:3px;">
                                                  </a>
                                              </li>';
                                         }
                                        for($k=$start;$k<$end;$k++){
                                                if($k == $i){
                                                        echo '<li><a class="selected">'.($k+1).'</a></li>';
                                                }else{
                                                        echo '<li><a href="javascript:void(0);" onclick="showgrid('.$k.')">'.($k+1).'</a></li>';	
                                                }
                                        }
                                    }
                                    if($div > ($i+1)){ 
                                    ?>
                                    <li>
                                        <a class="nxt" href="javascript:void(0);" onclick="showgrid(<?php echo ($i+1); ?>)">
                                                <img src="<?php echo $smarty->url; ?>images/nxt.png">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" onclick="showgrid(<?php echo ($div-1); ?>)">
                                                <img src="<?php echo $smarty->url; ?>images/last.png">
                                        </a>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                        </div>
                    </div></div>
                </div><?php
			
		if($tot == ($falg+1)){
			$last = $tot;	
		}else{
			$last = $falg+10 ;
		}
		
		if($div == ($i+1)){
			$last = $tot;
		}
		// print_r($leave_type); exit();
		echo '<div class="row-fluid"><div style="overflow-x:auto;" class="span12"><span style="margin:4px 0 3px 10px; float:left; overflow:hidden; ">'.($falg+1).' '.$smarty->localise->contents['to'].' '.$last.' '.$smarty->localise->contents['outof'].'  '.$tot.' '.$smarty->localise->contents['employee'].'</span>';	
		echo '<table class="table_list tbl_padding_fix" style="width:100%">
				<tr>
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
					echo '<th>'.$leave_type[$leave_types_array[$k]].'</th>';
				}	

                // foreach($leave_type AS $leave=>$type){
                //     echo '<th>'.$type.'</th>';
                // }

                echo    '
					<th>'.$smarty->localise->contents['total_leaves'].'</th>
				</tr>';
				
		$grandtotleavetype = array();
		$total_leave_minutes = array();			
		$emprepeat = '';
		$customer_leave_total = 0;
		$totleavehrs = 0;
		$TotalWorkingMinutes = 0;
		$MyFinalLeave_Toal = 0;
		$get_minutes = array();
		for($j=0;$j<10;$j++){
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
                    	echo '<tr class="odd">
                                <td class="usertdname" align="left">&nbsp;'.$empnmshow.'&nbsp;</td>
                                <td class="usertdname" align="left">&nbsp;'.$custname.'&nbsp;</td>	
                                <td align="center">'.$Tothrs.'</td>';
                         for($k = 0;$k<count($leave_types_array);$k++){
                         	 echo  '<td align="center">'.$leave_final[$leave_types_array[$k]].'</td>';   
                         }
                         echo '<td align="center">'.$sumof_all_leaves.'</td>';
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
		echo '<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>'. $FinalWorkingHours .'</th>';
		for($k = 0;$k<count($leave_types_array);$k++){
	     	 echo  '<th>'.$leave_total_final[$leave_types_array[$k]].'</th>'; 
	    }  
        echo '<th>'.$global_total	.'</th>
        		</tr></table></div></div></div>';
		$MyFinalLeave_Toal = 0;
		$global_totalm = 0;
		
	}
        
        // print_r($leave_types_array[0]); exit();
    
        if(!empty($employees) && !empty($karense_details)){
        	if($leave_types_array[0] == 1){
            echo '<div class="row-fluid"  style="margin-top: 21px;"><div style="overflow-x:auto;" class="span12">
                        <div class="tbl_hd"><span class="titles_tab">'.$smarty->localise->contents['karense_days'].'</span></div>';	
            echo '<table class="table_list" style="width:100%">
                            <tr>
                                    <th align="left">'.$smarty->localise->contents['employee'].'</th>
                                    <th align="left">'.$smarty->localise->contents['unmanned_slot_Karensdag'].'</th>
                            </tr>';
                    /*foreach($employees as $emp){
                        if(isset($karense_details[$emp['username']])){
                            $count_karense_days = count($karense_details[$emp['username']]);
                            echo'<tr class="odd">
                                        <td align="left" rowspan="'.$count_karense_days.'">'.($_SESSION['company_sort_by'] == 1 ? $emp['empfname'].', '.$emp['emplname'] : $emp['emplname'].', '.$emp['empfname']).'</td>';
                                foreach($karense_details[$emp['username']] as $kKey => $karense_days){
                                     echo '<td align="left">'.$karense_days['date'].'</td>';
                                     if($count_karense_days != $kKey+1) echo'</tr><tr class="odd">';
                                }
                            echo'</tr>';
                        }
                    }*/
            	}

           

            $printed_emp_names = array();
            foreach($employees as $emp){
                if(in_array($emp['username'], $printed_emp_names)) continue;
                if(isset($karense_details[$emp['username']])){
                    $count_karense_days = count($karense_details[$emp['username']]);
                    // rowspan="'.$count_karense_days.'"
                     if($leave_types_array[0] == 1){
                   	 echo'<tr class="odd">
                                <td align="left">'.($_SESSION['company_sort_by'] == 1 ? $emp['empfname'].', '.$emp['emplname'] : $emp['emplname'].', '.$emp['empfname']).'</td>';
                        /*foreach($karense_details[$emp['username']] as $kKey => $karense_days){
                             echo '<td align="left">'.$karense_days['date'].'</td>';
                             if($count_karense_days != $kKey+1) echo'</tr><tr class="odd">';
                        }*/
                        echo '<td align="left">';
                       
		                    foreach($karense_details[$emp['username']] as $kKey1 => $karense_days){
                                //echo "<pre>".print_r($karense_days,1)."</pre>";
                                if($karense_days['karens']){
                                    echo key($karense_days['karens']).'&nbsp;&nbsp;<span class="label">'.'('.number_format($karense_days['actual_karens'],2).')</span>&nbsp;&nbsp;';
                                }

		                    }
                        }
                    echo'</td></tr>';
                    $printed_emp_names[] = $emp['username'];
                }
            }
            echo '</table></div></div>';
        }
        if (in_array("3",$leave_types_array) && !empty($employee_vab_details)){
        	 echo '<div class="row-fluid"  style="margin-top: 21px;"><div style="overflow-x:auto;" class="span12">
                        <div class="tbl_hd"><span class="titles_tab">'.$smarty->localise->contents['vab'].'</span></div>';	
            echo '<table class="table_list" style="width:100%">
                            <tr>
                                    <th align="left">'.$smarty->localise->contents['employee'].'</th>
                                    <th align="left">'.$smarty->localise->contents['dates'].'</th>
                            </tr>';
                            // echo "<pre>".print_r($employees, 1)."<pre>";
            $printed_emp_names = array();
            foreach($employees as $emp){
                if(in_array($emp['username'], $printed_emp_names)) continue;
                if(isset($employee_vab_details[$emp['username']])){

                     echo '<tr><td align="left">'.($_SESSION['company_sort_by'] == 1 ? $emp['empfname'].', '.$emp['emplname'] : $emp['emplname'].', '.$emp['empfname']).'</td>';
                     echo '<td align="left">';
                    foreach($employee_vab_details[$emp['username']] as $value) {
                    	 		
                    		echo ' <span class="label">'.$value.'</span>';
                    }
                     echo '</td></tr>';
                     $printed_emp_names[] = $emp['username'];
                }
            }
        }

}
else{
	echo '
		<div id="showmain" >
		<input type="hidden" name="pages" id="pages" value="0"/>
                <div class="row-fluid">
		<div class="pagention class12" >
                <div class="alphbts class8">
                    <ul>
                        <li>
                        	<a onclick="select_employee(this.id);" id="A" style="cursor:pointer;" >A</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="B" style="cursor:pointer;" >B</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="C" style="cursor:pointer;" >C</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="D" style="cursor:pointer;" >D</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="E" style="cursor:pointer;" >E</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="F"  style="cursor:pointer;">F</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="G"  style="cursor:pointer;">G</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="H" style="cursor:pointer;" >H</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="I" style="cursor:pointer;" >I</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="J" style="cursor:pointer;" >J</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="K" style="cursor:pointer;" >K</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="L" style="cursor:pointer;" >L</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="M" style="cursor:pointer;" >M</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="N" style="cursor:pointer;" >N</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="O"  style="cursor:pointer;">O</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="P" style="cursor:pointer;" >P</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Q"  style="cursor:pointer;" >Q</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="R" style="cursor:pointer;" >R</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="S" style="cursor:pointer;" >S</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="T" style="cursor:pointer;" >T</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="U"  style="cursor:pointer;">U</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="V"  style="cursor:pointer;">V</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="W" style="cursor:pointer;" >W</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="X"  style="cursor:pointer;">X</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Y" style="cursor:pointer;" >Y</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Z" style="cursor:pointer;" >Z</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Å" style="cursor:pointer;" >Å</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ä" style="cursor:pointer;" >Ä</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ö" style="cursor:pointer;" >Ö</a>
                        </li>
                    </ul>
                </div>';
				
				echo '<div class="pagention_dv class4">
						<div class="pagination" style="margin:0px;float:right;">
							<ul id="pagination">	
                        </ul>
                    </div>
                </div></div>
            </div>';			
			
					
			echo '<div class="row-fluid"><div class="span12"><table class="table_list tbl_padding_fix" style="width:100%">
                <tr>
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
                                    foreach($leave_type AS $leave=>$type){
                                       // echo "<br>".$leave." ".$type;
                                        echo '<th>'.$type.'</th>';
                                    }
                        
					echo '<th>'.$smarty->localise->contents['total_leaves'].'</th>
				</tr>
				<tr>
					<td colspan="12" align="center"  class="usertdname" height="30px;" >&nbsp;<strong>'.$smarty->localise->contents['no_record_found'].'</strong></td>
				</tr>
				</table><div></div>';				
		
}



//print_r($employees);	
exit;



$employees = $employee->getemployee($name);
//echo "<pre>".print_r($employees, 1)."</pre>";

if(count($employees) > 0)
{
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	for($i=0;$i<count($employees);$i++)		
	{		
		echo '<li style=" border:1px solid #000; padding:2px; background:#fff; cursor:pointer;" onclick="fillemp(this.id);" id="'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'" >'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'</li>';
	}
	echo '</ul>';
}
else
{
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	echo '<li style=" border:1px solid #000; padding:2px; background:#fff;">Not Found</li>';
	echo '</ul>';
}

function format_leave_array($datas){
    $formatted_array = array();
    foreach ($datas as $key => $data) {
        $formatted_array[$data['date']][] = $data;
    }
    return $formatted_array;
}

exit;
?>