<?php

//This file is for creating pdf based on criteria
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');


$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);

$name = $pram[$totparam-2];
$year = $pram[$totparam-1];

$employees = $employee->employee_emptocust_data($year,$name);

$page = 10;
$tot = count($employees);
$div = ceil($tot/$page);

$html .= '<table border="1" cellpadding="0" cellspacing="0"   >
	<tr style="background:#DAF2F7; color:#666;">
		<th >&nbsp;'.$smarty->localise->contents['number'].'&nbsp;</th>
		<th>&nbsp;'.$smarty->localise->contents['customer'].'&nbsp;</th>
		<th>&nbsp;'.$smarty->localise->contents['username'].'&nbsp;</th>
		<th>&nbsp;'.$smarty->localise->contents['employeename'].'&nbsp;</th>
		<th>&nbsp;'.$smarty->localise->contents['employeephonenumber'].'&nbsp;</th>
	<tr>';	

if($tot > 0)
{
	$falg = 0;
	$chkusername = '';
	$mycnt = 0;
	$number = '';
	for($i=0;$i<$div;$i++)	
	{
		for($j=0;$j<10;$j++)	
		{
			$empfname	= $employees[$falg]['empfname'];
			$emplname	= $employees[$falg]['emplname'];
			$custfname	= $employees[$falg]['custfname'];
			$custlname	= $employees[$falg]['custlname'];
			$username	= $employees[$falg]['username'];
			$phone		= $employees[$falg]['phone'];
                        $tmp_mobile     = trim($employees[$falg]['mobile']) != '' ? '+46'.trim($employees[$falg]['mobile']) : '';
			$custid		= $employees[$falg]['custid'];
			$custssn	= $employees[$falg]['custssn'];
			
			$customer_to_emp_count = $customer->count_cust_employee($year,$custid);				
			
			$usernm = $employees[$falg]['username'];
			if($username != $usernm)
			{
				$username = $usernm;	
			}
			//echo $usernm;
			if($tot >= $falg+1)
			{
				
				if($chkusername == $employees[$falg]['custfname'] )
				{
					$custfullname = '';
					$number = $mycnt+1;	
					$custssnno = '';			
				}				
				else
				{
					$mycnt = 0;
					$chkusername = $employees[$falg]['custfname'];
					$custfullname = $custlname.', '.$custfname;
					$number = ($mycnt+1).'('.$customer_to_emp_count.')';
					$custssnno = $custssn;					
				}			
				
				if($j%2 == 0)
				{
					$html .= '<tr style="background:#E3EDF0;" >
					<td>&nbsp;&nbsp;'.$number.'</td>
					<td>&nbsp;&nbsp;'.$custssnno.' '.$custfullname.'</td>	
					<td>&nbsp;&nbsp;'.$username.'</td>						
					<td>&nbsp;&nbsp;'.$emplname.', '.$empfname.'</td>
					<td>&nbsp;&nbsp;'.$phone.'<br>&nbsp;'.$tmp_mobile.'</td>
					</tr>';	
				}
				else
				{
					$html .= '<tr style="background:#FFF;" >
					<td>&nbsp;&nbsp;'.$number.'</td>
					<td>&nbsp;&nbsp;'.$custssnno.' '.$custfullname.'</td>	
					<td>&nbsp;&nbsp;'.$username.'</td>						
					<td>&nbsp;&nbsp;'.$emplname.', '.$empfname.'</td>
					<td>&nbsp;&nbsp;'.$phone.'<br>&nbsp;'.$tmp_mobile.'</td>
					</tr>';	
					
				}	
				
			}
			$falg++;
			$mycnt++;
		}
			
		$Grandtotworkinghrs = 0;
	}
	
	$html .='</table>';
	
	
		
		/*$pdf->Output();
		exit;
		*/
$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($html,2);

$mpdf->Output('Employees_to_Customer.pdf','D');
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

//print_r($employees);	
exit;



//$employees = $employee->getemployee($name);

/*if(count($employees) > 0)
{
	
	exit;
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
}*/
exit;
?>
