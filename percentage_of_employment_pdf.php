<?php
require_once('plugins/F_pdf.class.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/contract.php');

class MYPDF extends FPDF
{
	
	
	// Load data
	function LoadData($file)
	{
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
			$data[] = explode(';',trim($line));
		return $data;
	}

	// Simple table
	function BasicTable($header, $data)
	{
		// Header
		foreach($header as $col)
			$this->Cell(40,7,$col,1);
		$this->Ln();
		// Data
		foreach($data as $row)
		{
			foreach($row as $col)
				$this->Cell(40,6,$col,1);
			$this->Ln();
		}
	}

	// Better table
	function ImprovedTable($header, $data)
	{
		// Column widths
		$w = array(40, 35, 40, 45);
		// Header
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
		// Data
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
			$this->Ln();
		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T');
	}
	 public function fillItems($items)
     {
          //You'd build the items list much the same way as above, using a foreach loop or whatever
          //Could also easily combine this function and the one above
			$this->SetFillColor(218,242,247);
			$this->SetTextColor(102,102,102);
			//$this->SetDrawColor(128,320,340);
			//$this->SetLineWidth(.3);
			//$this->SetFont('','B');
			
     }

	
	// Colored table
	function FancyTable($header, $data)
	{
		// Colors, line width and bold font
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Header
		$w = array(40, 35, 40, 45);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T');
	}
}

$pdf = new MYPDF();

$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$todate = $pram[$totparam-1];
$fromdate = $pram[$totparam-2];
$name = $pram[$totparam-3];
$obj_contract = new contract();
//echo "<pre>";
$employees = $obj_contract->per_of_employement_data($name,$fromdate,$todate);
//print_r($employees);exit;

$page = 10;
$tot = count($employees);
$div = ceil($tot/$page); 

if($tot > 0)
{
	$pdf->AddPage('L');
	$pdf->SetFont('Arial','',6);
	$pdf->FillItems($items);
	
	$pdf->Cell(35,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['employeename']),1,0,'L',true);
	$pdf->Cell(35,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['username']),1,0,'L',true);
	$pdf->Cell(40,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['contract_date']),1,0,'L',true);
	$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['full_part_time']),1,0,'L',true);
	$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['contract_percent']),1,0,'L',true);
	$pdf->Cell(35,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['expected_working_hours']),1,0,'L',true);
	$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['actual_working_hours']),1,0,'L',true);		
	$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['percent']),1,1,'L',true);
		
	$falg = 0;
	
	$Grandtotworkinghrs = 0;
	$username = '';
	$myname = '';
	$mycode = '';	
	$emprepeat = '';
	for($i=0;$i<$div;$i++)	
	{
							
		/*$grandtotleavehrs = 0;
		$grandtotleavetype = array(0,0,0,0,0,0,0,0);*/
						
		for($j=0;$j<10;$j++)	
		{
				//echo "<pre>";
				//print_r($employees[$falg]);	
				
				$username 	= $employees[$falg]['empusername'];
				$date_from 	= $employees[$falg]['date_from'];
				$date_to	= $employees[$falg]['date_to'];
				$hour		= $employees[$falg]['tothrs'];
				$fulltime	= $employees[$falg]['fulltime'];				
				$fullname	= $employees[$falg]['last_name'].', '.$employees[$falg]['first_name'];	
					
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
				
				
				if($fulltime == '1')
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
					$mycode = '';
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
				 
				/*$totempworkhrs = $employee->getemptothrs($username,$date_from,$date_to);
				$totworkinghrs = $totempworkhrs[0]['tot_hrs'];
				*/
				
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
				//print_r($totempworkhrs);
				//exit;
				
				//echo $totalleavehrs;
								
				//get current month for example
				//$startDate = '2012-09-01';
				//$endDate = '2012-09-30';
				$startDate = $date_from;
				$endDate = $date_to; 
				$working_days = '';
				$actualhours = '';
				$dayhours = '';
				$hourperc = '';
				
				$begin=strtotime($startDate);
				$end=strtotime($endDate);
				if($begin>$end)
				{
					echo "startdate is in the future! <br />";
					return 0;
				}
				else
				{
					$no_days=0;
					$weekends=0;
					while($begin<=$end)
					{
						$no_days++; // no of days in the given interval
						$what_day=date("N",$begin);
						if($what_day>5) 
						{ // 6 and 7 are weekend days
							$weekends++;
						};
						$begin+=86400; // +1 day
					};
					$working_days=$no_days-$weekends;
					//echo  $working_days;
					//echo "<br>";
				}
				
				if($working_days > 0)
				{
					if($part_time != '')
					{
						$dayhours = ($part_time/5);
						$actualhours = number_format(((int)$working_days*(int)$dayhours), 2, '.', '');	
					}
					else
					{
						$actualhours = number_format(((int)$working_days*8), 2, '.', '');
					}					
				}
				/*echo $actualhours;
				echo "<br>";*/
				
				//$hourperc = @number_format(((100*(int)$hour)/(int)$actualhours), 2, '.', '').' %';	
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
			
				$mydate = explode('-',$date_from);
				//print_r($mydate);				
		
				$year = $mydate[0];
				$Jan1 = gmmktime(0, 0, 0, 1, 1, $year);
				$mydate = gmmktime(0, 0, 0, $mydate[1], $mydate[2], $year);
				$delta = (int)(($mydate - $Jan1) / (7 * 24 * 60 * 60)) + 1;
				//echo 'weeknumber: ', $delta; 
				//'.$smarty->url.'customer/gdschema/'.$year.'|'.$delta.'/'.$username.'/
				
				
				if($j%2 == 0 || $j == 0)
				{
					$pdf->SetFillColor(247,251,251);
				}
				else
				{				
					$pdf->SetFillColor(227,237,240);
				}
			
				$pdf->Cell(35,5,iconv("UTF-8", "windows-1252",$myname),1,0,'L',true);
				$pdf->Cell(35,5,iconv("UTF-8", "windows-1252",$mycode),1,0,'L',true);
				$pdf->Cell(40,5,iconv("UTF-8", "windows-1252",$fulldate),1,0,'L',true);
				$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$timing),1,0,'L',true);
				$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$hourperc),1,0,'L',true);
				$pdf->Cell(35,5,$hour,1,0,'L',true);
				$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$exactworkinghrs),1,0,'L',true);		
				$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$percentage),1,1,'L',true);						
			}
			$falg++;
			
		}
		
		//echo $days = (strtotime("2004-03-31") - strtotime("2004-02-01")) / (60 * 60 * 24);
		
		
	}
	
			
	$pdf->Output('Percentage_Of_Employment.pdf','D');
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



$employees = $employee->getemployee($name);

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
exit;

/*$smarty->assign('employees',$employees);
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
if(isset($_POST['add'])){
    $emp = $_POST['employee'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $month = intval($month);
    $smarty->assign('month',$month);
    $smarty->assign('report_year',$year);
    $smarty->assign('emp',$emp);
    $timetable = $equipment->employee_timetable_month($emp,$month,$year);
    //print_r($timetable);
    $sums = $equipment->employee_week_time_sum($timetable);
    $smarty->assign('reports',$timetable);
    $smarty->assign('sums',$sums);
}
$smarty->display('extends:layouts/dashboard.tpl|employee_leave_report.tpl');*/
?>
