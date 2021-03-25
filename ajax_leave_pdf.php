<?php

//This file is for creating pdf based on criteria
require_once('plugins/F_pdf.class.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');


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


/*
$pdf->Output();
exit;
// Column headings
$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
exit;*/

$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
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
//$name = str_replace('_',' ',$pram[$totparam-3]);

/*if($name == '-')
{
	echo "in 1";
}
if($fromdate == '0000-00-00')
{
	echo "in 2";
}
if($todate == '0000-00-00')
{
	echo "in 3";
}*/

$employees = $employee->empgriddata($name,$fromdate,$todate);
$page = 10;
$tot = count($employees);
$div = ceil($tot/$page);

if($tot > 0)
{
	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	
	$recors = $tot.'  Records Found';
	
	/*$pdf->AddPage();
	$pdf->SetFont('Arial','B',6);		
	$pdf->Cell(185,5,$recors,0,1);				
	*/
	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',6);
	$pdf->FillItems($items);
		
	$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['employee']),1,0,'L',true);
	$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['customer']),1,0,'L',true);
	$pdf->Cell(18,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['total_working_hours']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['sickness']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['sem']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['vab']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['fp']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['pmeeting']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['education']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['other']),1,0,'L',true);
	$pdf->Cell(13,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['bandwidth']),1,0,'L',true);
	$pdf->Cell(15,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['total_leaves']),1,1,'L',true);
	
	$grandtotleavehrs = 0;
	$grandtotleavetype = array(0,0,0,0,0,0,0,0);
	$emprepeat = '';
	for($i=0;$i<$tot;$i++)	
	{			
		$usernm = $employees[$i]['username'];
		if($username != $usernm)
		{
			$username = $usernm;	
		}
		//echo $usernm;
		
		$leavearr = array();
		$leavearr = $employee->getempleave($usernm,$fromdate,$todate);
		$empusername = $employees[$i]['username'];			
		$custusername = $employees[$i]['customer'];	
					
		$empname = $employees[$i]['empfname'].' '.$employees[$i]['emplname'];	
		$custname = $employees[$i]['custfname'].' '.$employees[$i]['custlname'];	
		$Tothrs = $employees[$i]['Total Hours'];
		
		$Tothrs = number_format($Tothrs, 2, '.', ',');
		$divi = substr(strstr($Tothrs,'.'),1);
		$base = substr($Tothrs,0,-3);
		$integarthrs = floor((($base*60)+$divi)/60);
		$modulothrs	= (($base*60)+$divi)%60;		
		$empTothrs = number_format($integarthrs.'.'.$modulothrs, 2, '.', '');	
		
		$Grandtotworkinghrs += $empTothrs;
		
		//Rahul 15-9-2012 (convert grand total to hrs:minus)
		$rtotworkinghrs = number_format($Grandtotworkinghrs, 2, '.', '');
		$rGranddivihrs1 = substr(strstr($rtotworkinghrs ,'.'),1);
		$rGrandbasehrs1 = substr($rtotworkinghrs,0,-3);
		$rGrandintegarhrs1 = floor((($rGrandbasehrs1*60)+$rGranddivihrs1)/60);			
		$rGrandmodulohrs1	= (($rGrandbasehrs1*60)+$rGranddivihrs1)%60;	
		$rgrantotalhrs = number_format($rGrandintegarhrs1.'.'.$rGrandmodulohrs1, 2, '.', '');
		$Grandtotworkinghrs = $rgrantotalhrs;
		
		$totleavehrs = 0;			
		//$leavearr[$empusername][$custusername][3];
		if(!empty($leavearr[$empusername][$custusername][1]))
		{
			$ltype1 = number_format($leavearr[$empusername][$custusername][1], 2, '.', '');
			$divi1 = substr(strstr($ltype1,'.'),1);
			$base1 = substr($ltype1,0,-3);
			$integar1 = floor((($base1*60)+$divi1)/60);
			$modulo1	= (($base1*60)+$divi1)%60;		
			$empltype1 = number_format($integar1.'.'.$modulo1, 2, '.', '');							
			$totleavehrs += $empltype1;
			$grandtotleavetype[0] += $empltype1;
		}
		else
		{
			$ltype1 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][2]))
		{
			$ltype2 = number_format($leavearr[$empusername][$custusername][2], 2, '.', '');
			$divi2 = substr(strstr($ltype2,'.'),1);
			$base2 = substr($ltype2,0,-3);
			/*$empltype2 = number_format((($base2*60)+$divi2)/60, 2, '.', ',');		
			$totleavehrs += $ltype2;
			$grandtotleavetype[1] += $ltype2;*/				
			$integar2 = floor((($base2*60)+$divi2)/60);
			$modulo2	= (($base2*60)+$divi2)%60;		
			$empltype2 = number_format($integar2.'.'.$modulo2, 2, '.', '');							
			$totleavehrs += $empltype2;
			$grandtotleavetype[1] += $empltype2;
		}
		else
		{
			$ltype2 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][3]))
		{
			$ltype3 = number_format($leavearr[$empusername][$custusername][3], 2, '.', '');
			$divi3 = substr(strstr($ltype3,'.'),1);
			$base3 = substr($ltype3,0,-3);
			/*$empltype3 = number_format((($base3*60)+$divi3)/60, 2, '.', ',');		
			$totleavehrs += $ltype3;
			$grandtotleavetype[2] += $ltype3;*/				
			$integar3 = floor((($base3*60)+$divi3)/60);
			$modulo3	= (($base3*60)+$divi3)%60;		
			$empltype3 = number_format($integar3.'.'.$modulo3, 2, '.', '');							
			$totleavehrs += $empltype3;
			$grandtotleavetype[2] += $empltype3;
		}
		else
		{
			$ltype3 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][4]))
		{
			$ltype4 = number_format($leavearr[$empusername][$custusername][4], 2, '.', '');
			$divi4 = substr(strstr($ltype4,'.'),1);
			$base4 = substr($ltype4,0,-3);
			/*$empltype4 = number_format((($base4*60)+$divi4)/60, 2, '.', ',');	
			$totleavehrs += $ltype4;
			$grandtotleavetype[3] += $ltype4;*/
			$integar4 = floor((($base4*60)+$divi4)/60);
			$modulo4	= (($base4*60)+$divi4)%60;		
			$empltype4 = number_format($integar4.'.'.$modulo4, 2, '.', '');							
			$totleavehrs += $empltype4;
			$grandtotleavetype[3] += $empltype4;
		}
		else
		{
			$ltype4 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][5]))
		{
			$ltype5 = number_format($leavearr[$empusername][$custusername][5], 2, '.', '');
			$divi5 = substr(strstr($ltype5,'.'),1);
			$base5 = substr($ltype5,0,-3);
			/*$empltype5 = number_format((($base5*60)+$divi5)/60, 2, '.', ',');	
			$totleavehrs += $ltype5;
			$grandtotleavetype[4] += $ltype5;*/				
			$integar5 = floor((($base5*60)+$divi5)/60);
			$modulo5	= (($base5*60)+$divi5)%60;		
			$empltype5 = number_format($integar5.'.'.$modulo5, 2, '.', '');							
			$totleavehrs += $empltype5;
			$grandtotleavetype[4] += $empltype5;
		}
		else
		{
			$ltype5 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][6]))
		{
			$ltype6 = number_format($leavearr[$empusername][$custusername][6], 2, '.', '');
			$divi6 = substr(strstr($ltype6,'.'),1);
			$base6 = substr($ltype6,0,-3);
			/*$empltype6 = number_format((($base6*60)+$divi6)/60, 2, '.', ',');	
			$totleavehrs += $ltype6;
			$grandtotleavetype[5] += $ltype6;*/
			$integar6 = floor((($base6*60)+$divi6)/60);
			$modulo6	= (($base6*60)+$divi6)%60;		
			$empltype6 = number_format($integar6.'.'.$modulo6, 2, '.', '');							
			$totleavehrs += $empltype6;
			$grandtotleavetype[5] += $empltype6;
		}
		else
		{
			$ltype6 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][7]))
		{
			$ltype7 = number_format($leavearr[$empusername][$custusername][7], 2, '.', '');
			$divi7 = substr(strstr($ltype7,'.'),1);
			$base7 = substr($ltype7,0,-3);
			/*$empltype7 = number_format((($base7*60)+$divi7)/60, 2, '.', ',');	
			$totleavehrs += $ltype7;
			$grandtotleavetype[6] += $ltype7;*/
			$integar7 = floor((($base7*60)+$divi7)/60);
			$modulo7	= (($base7*60)+$divi7)%60;		
			$empltype7 = number_format($integar7.'.'.$modulo7, 2, '.', '');							
			$totleavehrs += $empltype7;
			$grandtotleavetype[6] += $empltype7;
		}
		else
		{
			$ltype7 = 0;
		}
		if(!empty($leavearr[$empusername][$custusername][8]))
		{
			$ltype8 = number_format($leavearr[$empusername][$custusername][8], 2, '.', '');
			$divi8 = substr(strstr($ltype8,'.'),1);
			$base8 = substr($ltype8,0,-3);
			/*$empltype8 = number_format((($base8*60)+$divi8)/60, 2, '.', ',');	
			$totleavehrs += $ltype8;
			$grandtotleavetype[7] += $ltype8;*/
			$integar8 = floor((($base8*60)+$divi8)/60);
			$modulo8	= (($base8*60)+$divi8)%60;		
			$empltype8 = number_format($integar8.'.'.$modulo8, 2, '.', '');							
			$totleavehrs += $empltype8;
			$grandtotleavetype[7] += $empltype8;
		}
		else
		{
			$ltype8 = 0;
		}
			
		if($totleavehrs != 0)
		{
			$grandtotleavehrs += $totleavehrs;	
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
		
		$totleavehrs = number_format($totleavehrs, 2, '.', '');
		$divit = substr(strstr($totleavehrs,'.'),1);
		$baset = substr($totleavehrs,0,-3);
		//$emptotleavehrs = number_format((($baset*60)+$divit)/60, 2, '.', ',');	
		$integart = floor((($baset*60)+$divit)/60);
		$modulot	= (($baset*60)+$divit)%60;	
		$emptotleavehrs = number_format($integart.'.'.$modulot, 2, '.', '');
		
		if($Tothrs == 0){ $totalhrs = '--';  }else{ $totalhrs = $empTothrs; }
		if($ltype1 == 0){ $leavetype1 = '--';  }else{ $leavetype1 = $empltype1; }
		if($ltype2 == 0){ $leavetype2 = '--';  }else{ $leavetype2 = $empltype2; }
		if($ltype3 == 0){ $leavetype3 = '--';  }else{ $leavetype3 = $empltype3; }
		if($ltype4 == 0){ $leavetype4 = '--';  }else{ $leavetype4 = $empltype4; }
		if($ltype5 == 0){ $leavetype5 = '--';  }else{ $leavetype5 = $empltype5; }
		if($ltype6 == 0){ $leavetype6 = '--';  }else{ $leavetype6 = $empltype6; }
		if($ltype7 == 0){ $leavetype7 = '--';  }else{ $leavetype7 = $empltype7; }
		if($ltype8 == 0){ $leavetype8 = '--';  }else{ $leavetype8 = $empltype8; }
		if($totleavehrs == 0){ $totalleavehrs = '--';  }else{ $totalleavehrs = $emptotleavehrs; }
		
		if($tot >= $i+1)
		{
			$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$empnmshow),1,0);
			$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$custname),1,0);
			$pdf->Cell(18,5,$totalhrs,1,0);
			$pdf->Cell(13,5,$leavetype1,1,0);
			$pdf->Cell(13,5,$leavetype2,1,0);
			$pdf->Cell(13,5,$leavetype3,1,0);
			$pdf->Cell(13,5,$leavetype4,1,0);
			$pdf->Cell(13,5,$leavetype5,1,0);
			$pdf->Cell(13,5,$leavetype6,1,0);
			$pdf->Cell(13,5,$leavetype7,1,0);
			$pdf->Cell(13,5,$leavetype8,1,0);
			$pdf->Cell(15,5,$totalleavehrs,1,1,'L',true);	
		}	
	}
	$grandtotleavetype[0] = number_format($grandtotleavetype[0], 2, '.', '');	
	$divihrs2 = substr(strstr($grandtotleavetype[0],'.'),1);
	$basehrs2 = substr($grandtotleavetype[0],0,-3);	
	/*$grandtotleavetype[0] = number_format((($basehrs2*60)+$divihrs2)/60, 2, '.', ',');*/	
	$integarhrs2 = floor((($basehrs2*60)+$divihrs2)/60);
	$modulohrs2	= (($basehrs2*60)+$divihrs2)%60;	
	$grandtotleavetype[0] = number_format($integarhrs2.'.'.$modulohrs2, 2, '.', '');
	
	
	$grandtotleavetype[1] = number_format($grandtotleavetype[1], 2, '.', '');
	$divihrs3 = substr(strstr($grandtotleavetype[1],'.'),1);
	$basehrs3 = substr($grandtotleavetype[1],0,-3);
	/*$grandtotleavetype[1] = number_format((($basehrs3*60)+$divihrs3)/60, 2, '.', ',');*/
	$integarhrs3 = floor((($basehrs3*60)+$divihrs3)/60);
	$modulohrs3	= (($basehrs3*60)+$divihrs3)%60;	
	$grandtotleavetype[1] = number_format($integarhrs3.'.'.$modulohrs3, 2, '.', '');
	
	
	$grandtotleavetype[2] = number_format($grandtotleavetype[2], 2, '.', '');
	$divihrs4 = substr(strstr($grandtotleavetype[2],'.'),1);
	$basehrs4 = substr($grandtotleavetype[2],0,-3);
	/*$grandtotleavetype[2] = number_format((($basehrs4*60)+$divihrs4)/60, 2, '.', ',');	*/
	$integarhrs4 = floor((($basehrs4*60)+$divihrs4)/60);
	$modulohrs4	= (($basehrs4*60)+$divihrs4)%60;	
	$grandtotleavetype[2] = number_format($integarhrs4.'.'.$modulohrs4, 2, '.', '');
	
	$grandtotleavetype[3] = number_format($grandtotleavetype[3], 2, '.', '');
	$divihrs5 = substr(strstr($grandtotleavetype[3],'.'),1);
	$basehrs5 = substr($grandtotleavetype[3],0,-3);
	/*$grandtotleavetype[3] = number_format((($basehrs5*60)+$divihrs5)/60, 2, '.', ',');*/	
	$integarhrs5 = floor((($basehrs5*60)+$divihrs5)/60);
	$modulohrs5	= (($basehrs5*60)+$divihrs5)%60;	
	$grandtotleavetype[3] = number_format($integarhrs5.'.'.$modulohrs5, 2, '.', '');
	
	$grandtotleavetype[4] = number_format($grandtotleavetype[4], 2, '.', '');
	$divihrs6 = substr(strstr($grandtotleavetype[4],'.'),1);
	$basehrs6 = substr($grandtotleavetype[4],0,-3);
	/*$grandtotleavetype[4] = number_format((($basehrs6*60)+$divihrs6)/60, 2, '.', ',');	*/
	$integarhrs6 = floor((($basehrs6*60)+$divihrs6)/60);
	$modulohrs6	= (($basehrs6*60)+$divihrs6)%60;	
	$grandtotleavetype[4] = number_format($integarhrs6.'.'.$modulohrs6, 2, '.', '');
	
	
	$grandtotleavetype[5] = number_format($grandtotleavetype[5], 2, '.', '');
	$divihrs7 = substr(strstr($grandtotleavetype[5],'.'),1);
	$basehrs7 = substr($grandtotleavetype[5],0,-3);
	/*$grandtotleavetype[5] = number_format((($basehrs7*60)+$divihrs7)/60, 2, '.', ',');	*/
	$integarhrs7 = floor((($basehrs7*60)+$divihrs7)/60);
	$modulohrs7	= (($basehrs7*60)+$divihrs7)%60;	
	$grandtotleavetype[5] = number_format($integarhrs7.'.'.$modulohrs7, 2, '.', '');	
	
	
	$grandtotleavetype[6] = number_format($grandtotleavetype[6], 2, '.', '');
	$divihrs8 = substr(strstr($grandtotleavetype[6],'.'),1);
	$basehrs8 = substr($grandtotleavetype[6],0,-3);
	/*$grandtotleavetype[6] = number_format((($basehrs8*60)+$divihrs8)/60, 2, '.', ',');	*/
	$integarhrs8 = floor((($basehrs8*60)+$divihrs8)/60);
	$modulohrs8	= (($basehrs8*60)+$divihrs8)%60;	
	$grandtotleavetype[6] = number_format($integarhrs8.'.'.$modulohrs8, 2, '.', '');	
	
	$grandtotleavetype[7] = number_format($grandtotleavetype[7], 2, '.', '');
	$divihrs9 = substr(strstr($grandtotleavetype[7],'.'),1);
	$basehrs9 = substr($grandtotleavetype[7],0,-3);
	//$grandtotleavetype[7] = number_format((($basehrs9*60)+$divihrs9)/60, 2, '.', ',');			
	$integarhrs9 = floor((($basehrs9*60)+$divihrs9)/60);
	$modulohrs9	= (($basehrs9*60)+$divihrs9)%60;	
	$grandtotleavetype[7] = number_format($integarhrs9.'.'.$modulohrs9, 2, '.', '');	
	
	$grandtotleavehrs = number_format($grandtotleavehrs, 2, '.', '');		
	$divihrs10 = substr(strstr($grandtotleavehrs,'.'),1);	
	$basehrs10 = substr($grandtotleavehrs,0,-3);	
	//$empgrandtotleavehrs = number_format((($basehrs10*60)+$divihrs10)/60, 2, '.', ',');	
	$integarhrs10 = floor((($basehrs10*60)+$divihrs10)/60);
	$modulohrs10	= (($basehrs10*60)+$divihrs10)%60;	
	$empgrandtotleavehrs = number_format($integarhrs10.'.'.$modulohrs10, 2, '.', '');	
	
	$Grandtotworkinghrs = number_format($Grandtotworkinghrs, 2, '.', '');
	$Granddivihrs1 = substr(strstr($Grandtotworkinghrs,'.'),1);
	$Grandbasehrs1 = substr($Grandtotworkinghrs,0,-3);
	//$Grandtotworkinghrs = number_format((($basehrs1*60)+$divihrs1)/60, 2, '.', ',');	
	$Grandintegarhrs1 = floor((($Grandbasehrs1*60)+$Granddivihrs1)/60);
	$Grandmodulohrs1	= (($Grandbasehrs1*60)+$Granddivihrs1)%60;	
	$grantotalhrs = number_format($Grandintegarhrs1.'.'.$Grandmodulohrs1, 2, '.', '');
	
	
	if($Grandtotworkinghrs == 0){ $granttalhrs = '--';  }else{ $granttalhrs = $grantotalhrs; }		
	if($grandtotleavetype[0] == 0){ $grandleavetype1 = '--';  }else{ $grandleavetype1 = $grandtotleavetype[0]	; }		
	if($grandtotleavetype[1] == 0){ $grandleavetype2 = '--';  }else{ $grandleavetype2 = $grandtotleavetype[1]; }
	if($grandtotleavetype[2] == 0){ $grandleavetype3 = '--';  }else{ $grandleavetype3 = $grandtotleavetype[2]; }
	if($grandtotleavetype[3] == 0){ $grandleavetype4 = '--';  }else{ $grandleavetype4 = $grandtotleavetype[3]; }
	if($grandtotleavetype[4] == 0){ $grandleavetype5 = '--';  }else{ $grandleavetype5 = $grandtotleavetype[4]; }
	if($grandtotleavetype[5] == 0){ $grandleavetype6 = '--';  }else{ $grandleavetype6 = $grandtotleavetype[5]; }
	if($grandtotleavetype[6] == 0){ $grandleavetype7 = '--';  }else{ $grandleavetype7 = $grandtotleavetype[6]; }
	if($grandtotleavetype[7] == 0){ $grandleavetype8 = '--';  }else{ $grandleavetype8 = $grandtotleavetype[7]; }
	if($grandtotleavehrs == 0){ $grandtotalleaveshrsfinal = '--';  }else{ $grandtotalleaveshrsfinal = $empgrandtotleavehrs; }
	
	$pdf->FillItems($items);
	$pdf->Cell(25,5,'',1,0,'L',true);
	$pdf->Cell(25,5,'',1,0,'L',true);
	$pdf->Cell(18,5,$granttalhrs,1,0,'L',true);			
	$pdf->Cell(13,5,$grandleavetype1,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype2,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype3,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype4,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype5,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype6,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype7,1,0,'L',true);
	$pdf->Cell(13,5,$grandleavetype8,1,0,'L',true);
	$pdf->Cell(15,5,$grandtotalleaveshrsfinal,1,0,'L',true);	
	$Grandtotworkinghrs = 0;
	
			
	$pdf->Output('employee_leave.pdf','D');
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
	echo '
		<div id="showmain" >
		<input type="hidden" name="pages" id="pages" value="0"/>
		<div class="pagention" >
                <div class="alphbts">
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
				
				echo '<div class="pagention_dv">
						<div class="pagination">
							<ul id="pagination">	
                        </ul>
                    </div>
                </div>
            </div>';
			echo '<table class="table_list tbl_padding_fix">
                <tr>
					<th>anställd</th>
					<th>kund</th>
					<th>Total Working Hours/Period</th>
					<th>Leave Types 1 (1-Sjuk)</th>
					<th>Leave Types 2 (2-Sem)</th>
					<th>Leave Types 3 (3-VAB)</th>
					<th>Leave Types 4 (4-FP)</th>
					<th>Leave Types 5 (5-P-möte)</th>
					<th>Leave Types 6 (6-Utbild)</th>
					<th>Leave Types 7 (7-Övrigt)</th>
					<th>Leave Types 8 (8-Byte)</th>
					<th>Total Leaves</th>                    
                </tr>
				<tr>
					<td colspan="12" align="center"  class="usertdname" height="30px;" >&nbsp;<strong> No records found</strong></td>
				</tr>
				</table>';				
		
}

//print_r($employees);	
exit;



$employees = $employee->getemployee($name);

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