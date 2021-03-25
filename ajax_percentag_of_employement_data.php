<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
require_once('class/contract.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
$equipment = new equipment();
$employee = new employee();
$obj_contract = new contract();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$uri = substr($_SERVER['REQUEST_URI'], 0, -1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-2];
$fromdate = $pram[$totparam-3];
$employee_id = $pram[$totparam-4];
$customer_id = $pram[$totparam-1];
$sort_by = isset($pram[$totparam-6]) && trim($pram[$totparam-6]) != '' ? $pram[$totparam-6] : NULL;
$sort_direction = $sort_by != NULL && isset($pram[$totparam-5]) && trim($pram[$totparam-5]) != '' && in_array(trim($pram[$totparam-5]), array('ASC', 'DESC')) ? trim($pram[$totparam-5]) : 'ASC';
//sort_by => SORT_BY_PERCENTAGE | SORT_BY_CONTRACT_PERCENTAGE

if($customer_id == '-' || $customer_id == '') $customer_id = NULL;
else $employee_id = '-';

// echo "<pre>".print_r(array($employee_id,$fromdate,$todate, $customer_id), 1)."<pre>";
$employees = $obj_contract->per_of_employement_data($employee_id,$fromdate,$todate, $customer_id);
// echo "<pre>".print_r($employees, 1)."</pre>";
$page = 10;
$tot = count($employees);
$div = ceil($tot/$page); 

if($tot > 0) {	

	foreach($employees as $key => $emp_data) {
		$hour		= $emp_data['tothrs'];
		$totempworkhrs = $employee->getemptothrs($emp_data['empusername'],$fromdate,$todate);
		$myworkhoutstot = 0;
		if(count($totempworkhrs) > 0) {
			for($c=0;$c<count($totempworkhrs);$c++) {
				$totempworkhrs[$c]['hrsmins'];																		
				$myworkhoutstot += $totempworkhrs[$c]['hrsmins'];		
			}
		}	
		$totworkinghrs = $myworkhoutstot;
		$totalleavehrs = 0;
		$employees[$key]['exactworkinghrs'] = number_format(($totworkinghrs - $totalleavehrs), 2, '.', '');
		$employees[$key]['exactworkinghrs'] = $equipment->time_user_format($employees[$key]['exactworkinghrs'], 100);	
		$employees[$key]['final_percentage'] = @number_format((($employees[$key]['exactworkinghrs']*100)/$hour), 2, '.', '');
	}

	if($sort_by == 'SORT_BY_CONTRACT_PERCENTAGE'){
		if($sort_direction == 'DESC'){
			usort($employees, function($a, $b) {
			    return $b['percentage'] - $a['percentage'];
			});
		}
		else {
			usort($employees, function($a, $b) {
			    return $a['percentage'] - $b['percentage'];
			});
		}
	}
	else if($sort_by == 'SORT_BY_PERCENTAGE'){
		if($sort_direction == 'DESC'){
			usort($employees, function($a, $b) {
			    return $b['final_percentage'] - $a['final_percentage'];
			});
		}
		else {
			usort($employees, function($a, $b) {
			    return $a['final_percentage'] - $b['final_percentage'];
			});
		}
	}


	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	
	for($i=0;$i<$div;$i++) {
		if($i == 0){
			$show = 'style="display:block;"';
		}else{
			$show = 'style="display:none;"';
		}
		echo '
		<div id="showmain'.$i.'" '.$show.' >
		<input type="hidden" name="pages" id="pages" value="'.$div.'"/>
                <div class="row-fluid">     
		<div class="pagention span12" >
                <div class="alphbts span8">
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
                        	<a onclick="select_employee(this.id);" id="Å" name="Å" style="cursor:pointer;" >Å</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ä" name="Ä" style="cursor:pointer;" >Ä</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ö" name="Ö" style="cursor:pointer;" >Ö</a>
                        </li>
                    </ul>
                </div>';
				
				$start = $i;
                                $end = $start+3 > $div ? $div: $start+3;
				echo '<div class="pagention_dv span4">
						<div class="pagination" style="margin:0px;float:right;">
							<ul id="pagination">';						
							if($div > 0)
							{
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
								for($k=$start;$k<$end;$k++)
								{
									if($k == $i)
									{
										echo '<li><a class="selected">'.($k+1).'</a></li>';
									}
									else
									{
										echo '<li>
											<a href="javascript:void(0);" onclick="showgrid('.$k.')">'.($k+1).'</a>
										</li>';	
									}
								}
							}
                            if($div > ($i+1))                                                      
                            echo '<li>
                            	<a class="nxt" href="javascript:void(0);" onclick="showgrid('.($i+1).')">
                            		<img src="'.$smarty->url.'images/nxt.png" style="margin-bottom:3px;">
                            	</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="showgrid('.($div-1).')">
                                	<img src="'.$smarty->url.'images/last.png" style="margin-bottom:3px;">
                                </a>
                            </li>';
                            
                        echo '</ul>
                    </div>
                </div>
                </div>
            </div>';
			
		if($tot == ($falg+1)) {
			$last = $tot;	
		}
		else {
			$last = $falg+10 ;
		}
		
		if($div == ($i+1)) {
			$last = $tot;
		}
		echo '<span style="margin:4px 0 3px 10px; float:left;">'.($falg+1).' '.$smarty->localise->contents['to'].' '.$last.' '.$smarty->localise->contents['outof'].'  '.$tot.' '.$smarty->localise->contents['employee'].'</span>';	
			//(Englishword - swedis word) (Employee - anställd) (customer - kund) 
			
		echo '
                <div class="row-fluid">    
		<div style="float:left; overflow-x:scroll; overflow-y:hidden;" class="span12">
		<table class="table_list " border="1" style="width:100%;">               
                <tr>
					<th >'.$smarty->localise->contents['employeename'].'</th>
					<th>'.$smarty->localise->contents['username'].'</th>
					<th>'.$smarty->localise->contents['contract_date'].'</th>
					<th>'.$smarty->localise->contents['full_part_time'].'</th>
					<th class="sort_by_field sort_by_contract_percentage" data-order="'.($sort_by == 'SORT_BY_CONTRACT_PERCENTAGE' ? ($sort_direction != 'ASC' ? 'DESC' : 'ASC') : '').'">'.$smarty->localise->contents['contract_percent'].($sort_by == 'SORT_BY_CONTRACT_PERCENTAGE' ? ($sort_direction != 'ASC' ? ' <i class="icon icon-chevron-up"></i>' : ' <i class="icon icon-chevron-down"></i>') : '').'</th>
					<th>'.$smarty->localise->contents['expected_working_hours'].'</th>					
					<th>'.$smarty->localise->contents['actual_working_hours'].'</th>					
					<th class="sort_by_field sort_by_percentage" data-order="'.($sort_by == 'SORT_BY_PERCENTAGE' ? ($sort_direction != 'ASC' ? 'DESC' : 'ASC') : '').'">'.$smarty->localise->contents['percent'].($sort_by == 'SORT_BY_PERCENTAGE' ? ($sort_direction != 'ASC' ? ' <i class="icon icon-chevron-up"></i>' : ' <i class="icon icon-chevron-down"></i>') : '').'</th>
				<tr>';	
		
		$emprepeat = '';
		$myname = '';
		$mycode = '';		
		for($j=0;$j<10;$j++) {
			
			$username 	= $employees[$falg]['empusername'];
			$date_from 	= $employees[$falg]['date_from'];
			$date_to	= $employees[$falg]['date_to'];
			$hour		= $employees[$falg]['tothrs'];
			$fulltime	= $employees[$falg]['fulltime'];
			$exactworkinghrs	= $employees[$falg]['exactworkinghrs'];

            if($_SESSION['company_sort_by'] == 1)
                $fullname	= $employees[$falg]['first_name'].', '.$employees[$falg]['last_name'];
            elseif($_SESSION['company_sort_by'] == 2)
                $fullname	= $employees[$falg]['last_name'].', '.$employees[$falg]['first_name'];

			$contract_weeks = $employees[$falg]['contract_weeks'];				
				
			if($date_from == '0000-00-00' && $date_to == '0000-00-00')
			{
				$fulldate	= $smarty->localise->contents['no_contract'];
			}
			else
			{
				$fulldate	= $date_from.' '.$smarty->localise->contents['to'].' '.$date_to;
			}	
				
			if($date_from == '0000-00-00' && $date_to == '0000-00-00')
			{
				$mydate_from 	= $fromdate;
				$mydate_to		= $todate;
			}
			else
			{
				$mydate_from 	= $date_from;
				$mydate_to		= $date_to;
			}
				
			if($fulltime == 1) {
				$timing = $smarty->localise->contents['F'];
			}
			$part_time	= $employees[$falg]['part_time'];
			
			if($part_time == '1') {
				$timing = $smarty->localise->contents['P'].'('.$part_time.')';
			}
			$empname	= $fullname;		
				
			if($emprepeat == $username)	{
				$myname = '';
				$mycode = $username;
			}
			else {
				$myname = $empname;
				$emprepeat = $username;
				$mycode = $username;
			}
				
			if($part_time != '') {				
				@$contract_percentage = @($hour * 100) / ($contract_weeks * $part_time);
			}
			else {
				@$contract_percentage = @($hour * 100) / ($contract_weeks * 40);					
			}	
					
            $hourperc = $employees[$falg]['percentage'].' %';
			
			if($tot >= $falg+1) {
				
				//calculation for percentage
				$percentage = $employees[$falg]['final_percentage'].' %';
				
				if($date_from == '0000-00-00' && $date_to == '0000-00-00') {
					$percentage = $smarty->localise->contents['no_contract'];
					$hourperc = '--';
					$timing = '--';
					$hour = '--';
				}
				else {
					$hour = number_format($hour, 2, '.', '');
				}
			
				$mydate = explode('-',$date_from);
		
				$year = $mydate[0];
				$Jan1 = gmmktime(0, 0, 0, 1, 1, $year);
				$mydate = gmmktime(0, 0, 0, $mydate[1], $mydate[2], $year);
				$delta = (int)(($mydate - $Jan1) / (7 * 24 * 60 * 60)) + 1;
				
				if($date_from == '0000-00-00' && $date_to == '0000-00-00') {
					echo'<tr class="odd">
						<td align="left">&nbsp;'.$myname.'</td>
						<td align="center">&nbsp;'.$mycode.'</td>	
						<td align="center">&nbsp;'.$fulldate.'</td>
						<td align="center">&nbsp;'.$timing.'</td>
						<td align="center">&nbsp;'.$hourperc.'</td>
						<td align="center">&nbsp;'.$hour.'</td>
						<td align="center">&nbsp;'.$exactworkinghrs.'</td>
						<td align="center">&nbsp;'.$percentage.'</td>	                   
					</tr>';					
				}
				else {
					echo'<tr class="odd">
						<td align="left">&nbsp;'.$myname.'</td>
						<td align="center">&nbsp;<a href="javascript:void(0);" onclick="navigatePage(\''.$smarty->url.'employee/gdschema/'.$year.'|'.$delta.'/'.$username.'/\',1)" style="text-decoration:underline;" >'.$mycode.'</a></td>	
						<td align="center">&nbsp;'.$fulldate.'</td>
						<td align="center">&nbsp;'.$timing.'</td>
						<td align="center">&nbsp;'.$hourperc.'</td>
						<td align="center">&nbsp;'.number_format($hour, 2, '.', '').'</td>
						<td align="center">&nbsp;'.$exactworkinghrs.'</td>
						<td align="center">&nbsp;'.$percentage.'</td>	                   
					</tr>';
				}
				
				
			}
			$falg++;
		}
		
		echo '<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>		
			</tr>	
		</table></div></div></div>';
		
	}
}
else
{
	echo '
		<div id="showmain" >
		<input type="hidden" name="pages" id="pages" value="0"/>
                <div class="row-fluid">
		<div class="pagention span12" >
                <div class="alphbts span8">
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
				
				echo '<div class="pagention_dv span4">
						<div class="pagination">
							<ul id="pagination">	
                        </ul>
                    </div>
                </div>
                </div>
            </div>';	
					
			echo '<div class="row-fluid"><div class="span12"><table class="table_list tbl_padding_fix" style="width:100%">
                <tr>
					<th>'.$smarty->localise->contents['employeename'].'</th>
					<th>'.$smarty->localise->contents['username'].'</th>
					<th>'.$smarty->localise->contents['contract_date'].'</th>
					<th>'.$smarty->localise->contents['full_part_time'].'</th>
					<th>'.$smarty->localise->contents['contract_percent'].'</th>
					<th>'.$smarty->localise->contents['expected_working_hours'].'</th>					
					<th>'.$smarty->localise->contents['actual_working_hours'].'</th>					
					<th>'.$smarty->localise->contents['percent'].'</th>
				</tr>
				<tr>
					<td colspan="12" align="center"  class="usertdname" height="30px;" >&nbsp;<strong>'.$smarty->localise->contents['no_record_found'].'</strong></td>
				</tr>
				</table></div></div>';	
}
exit;
?>