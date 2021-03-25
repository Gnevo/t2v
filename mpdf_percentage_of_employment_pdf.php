<?php
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
//require_once('class/equipment.php');
//require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/contract.php');
$obj_contract = new contract();
//$equipment = new equipment();
//$customer = new customer();
$employee = new employee();
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-2];
$fromdate = $pram[$totparam-3];
$employee_id = $pram[$totparam-4];
$customer_id = $pram[$totparam-1];

if($customer_id == '-' || $customer_id == '') $customer_id = NULL;
else $employee_id = '-';

$employees = $obj_contract->per_of_employement_data($employee_id, $fromdate, $todate, $customer_id);

$page = 10;
$tot = count($employees);
$div = ceil($tot/$page); 

if($tot > 0){	
	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	
	$emprepeat = '';
	$myname = '';
	$mycode = '';	
	$html = '';
		
		
		$html .= '<table border="1" cellpadding="0" cellspacing="0"   >
	<tr style="background:#DAF2F7; color:#666;">
					<th >'.$smarty->localise->contents['employeename'].'</th>
					<th>'.$smarty->localise->contents['username'].'</th>
					<th>'.$smarty->localise->contents['contract_date'].'</th>
					<th>'.$smarty->localise->contents['full_part_time'].'</th>
					<th>'.$smarty->localise->contents['contract_percent'].'</th>
					<th>'.$smarty->localise->contents['expected_working_hours'].'</th>					
					<th>'.$smarty->localise->contents['actual_working_hours'].'</th>					
					<th>'.$smarty->localise->contents['percent'].'</th>
				<tr>';	
	
	for($falg=0;$falg<$tot;$falg++)	
	{
		$username 	= $employees[$falg]['empusername'];
		$date_from 	= $employees[$falg]['date_from'];
		$date_to	= $employees[$falg]['date_to'];
		$hour		= $employees[$falg]['tothrs'];
		$fulltime	= $employees[$falg]['fulltime'];				
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
			
		if($fulltime == 1)
		{
			$timing = $smarty->localise->contents['F'];
		}
		$part_time	= $employees[$falg]['part_time'];
		
		if($part_time == '1')
		{
			$timing = $smarty->localise->contents['P'].'('.$part_time.')';
		}
		$empname	= $fullname;		
				
		if($emprepeat == $username)	
		{
			$myname = '';
			$mycode = $username;
		}
		else
		{
			$myname = $empname;
			$emprepeat = $username;
			$mycode = $username;
		}
		//get employee leaves
		//echo "<pre>";

		$totalleavehrs = '';
		$totworkinghrs = '';
		$empleaves = $employee->getempleave_exclude_some($username,$mydate_from,$mydate_to);
		if(count($empleaves) > 0)
		{
			$mykeys = array_keys($empleaves[$username]);
			$keycnt = count($mykeys);
			if($keycnt > 0)
			{
				for($g=0;$g<$keycnt;$g++)
				{
					$mycount = $mykeys[$g];
					//print_r($empleaves[$username][$mycount]);
					$hrskeys = array_keys($empleaves[$username][$mycount]);
					if(count($hrskeys) > 0)
					{
						for($d=0;$d<count($hrskeys);$d++)
						{
							$myhrskey = $hrskeys[$d];
							$totalleavehrs = $empleaves[$username][$mycount][$myhrskey];
						}
					}
					//print_r($hrskeys);
				}
			}
		}		
				 
		$totempworkhrs = $employee->getemptothrs($username,$mydate_from,$mydate_to);
		
		$myworkhoutstot = 0;
		if(count($totempworkhrs) > 0)
		{
				for($c=0;$c<count($totempworkhrs);$c++)
				{
					$totempworkhrs[$c]['hrsmins'];																		
					$myworkhoutstot += $totempworkhrs[$c]['hrsmins'];		
				}
		}
				
		//echo $myworkhoutstot;				
		//$totworkinghrs = $totempworkhrs[0]['tot_hrs'];			
		$totworkinghrs = $myworkhoutstot;
		
		if($totalleavehrs == '')
		{
			$totalleavehrs = 0;
		}
		
		$exactworkinghrs = number_format(($totworkinghrs - $totalleavehrs), 2, '.', '');
				
		if($part_time != '')
		{				
			@$contract_percentage = @($hour * 100) / ($contract_weeks * $part_time);
		}
		else
		{
			@$contract_percentage = @($hour * 100) / ($contract_weeks * 40);					
		}	

		//$hourperc = @number_format($contract_percentage, 2, '.', '').' %';
                $hourperc = $employees[$falg]['percentage'].' %';
                
			
		if($tot >= $falg+1)
		{
			
			//calculation for percentage
			$percentage = '';
			$percentage = @number_format((($exactworkinghrs*100)/$hour), 2, '.', '').' %';
			
			if($date_from == '0000-00-00' && $date_to == '0000-00-00')
			{
				$percentage = $smarty->localise->contents['no_contract'];
				$hourperc = '--';
				$timing = '--';
				$hour = '--';
			}
			else
			{
				$hour = number_format($hour, 2, '.', '');
			}
		
			$mydate = explode('-',$date_from);
			//print_r($mydate);				
	
			$year = $mydate[0];
			$Jan1 = gmmktime(0, 0, 0, 1, 1, $year);
			$mydate = gmmktime(0, 0, 0, $mydate[1], $mydate[2], $year);
			$delta = (int)(($mydate - $Jan1) / (7 * 24 * 60 * 60)) + 1;
			//echo 'weeknumber: ', $delta; 
			//'.$smarty->url.'customer/gdschema/'.$year.'|'.$delta.'/'.$username.'/
			
			if($date_from == '0000-00-00' && $date_to == '0000-00-00')
			{
				$html.= '<tr style="color:#666; background:#E3EDF0;">
				<td align="center">&nbsp;'.$myname.'</td>
				<td align="center">&nbsp;'.$mycode.'</td>	
				<td align="center">&nbsp;'.$fulldate.'</td>
				<td align="center">&nbsp;'.$timing.'</td>
				<td align="center">&nbsp;'.$hourperc.'</td>
				<td align="center">&nbsp;'.$hour.'</td>
				<td align="center">&nbsp;'.$exactworkinghrs.'</td>
				<td align="center">&nbsp;'.$percentage.'</td>	                   
			</tr>';					
			}
			else
			{
				  $html.= '<tr style="color:#666; background:#E3EDF0;">
				<td align="center">&nbsp;'.$myname.'</td>
				<td align="center">&nbsp;'.$mycode.'</td>	
				<td align="center">&nbsp;'.$fulldate.'</td>
				<td align="center">&nbsp;'.$timing.'</td>
				<td align="center">&nbsp;'.$hourperc.'</td>
				<td align="center">&nbsp;'.number_format($hour, 2, '.', '').'</td>
				<td align="center">&nbsp;'.$exactworkinghrs.'</td>
				<td align="center">&nbsp;'.$percentage.'</td>	                   
			</tr>';				
			}
			
		}
	}
	 $html.= '<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>		
			</tr>	
		</table>';
		
		
		
	$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13); 
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	$mpdf->WriteHTML($html,2);
	$mpdf->Output('Percentage_Of_Employment.pdf','D');
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
