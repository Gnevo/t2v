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
			//$this->SetTextColor(102,102,102);
			$this->SetDrawColor(0);
			//$this->SetLineWidth(.3);
			//$this->SetFont('Arial','B',8);	
			
			//$this->SetFillColor(255,0,0);
			/*$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.1);
			$this->SetFont('','B');*/
		
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
		$w = array(15,30,30,30,20,25,20,20,35,30,30);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		
		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		foreach($data as $row)
		{
			
			/*echo "<pre>";
			print_r($row);
			exit;*/
			
			


			
			$this->Cell($w[0],6,$row['code'],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row['username'],'LR',0,'L',$fill);
			$this->Cell($w[2],6,$row['last_name'].' '.$row['first_name'],'LR',0,'L',$fill);
			$this->Cell($w[3],6,$row['address'],'LR',0,'L',$fill);
			$this->Cell($w[4],6,$row['post'],'LR',0,'L',$fill);
			$this->Cell($w[5],6,$row['city'],'LR',0,'L',$fill);
			$this->Cell($w[6],6,$row['phone'],'LR',0,'L',$fill);
			$this->Cell($w[7],6,$row['mobile'],'LR',0,'L',$fill);
			$this->Cell($w[8],6,$row['email'],'LR',0,'L',$fill);
			$this->Cell($w[9],6,$row['email'],'LR',0,'L',$fill);
			$this->Cell($w[10],6,$row['email'],'LR',0,'L',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T');
	}
	
	
}

$pdf = new MYPDF();
$equipment = new equipment();
$customer = new customer();
$employee = new employee();
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$order = $pram[$totparam-1];
$status = $pram[$totparam-2];
$name = $pram[$totparam-3];

$order = $pram[$totparam-1];
$status = $pram[$totparam-2];
$name = $pram[$totparam-3];

$employees = $employee->customer_activeinactive_data($name,$status,$order);
$page = 10;
$tot = count($employees);
$div = ceil($tot/$page);

$pdf->AddPage('L');
$pdf->SetFont('Arial','',8);	
$pdf->FillItems($items);




//$w = array(15,30,30,30,20,25,20,20,35,30,30);

$pdf->Cell(15,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['number']),1,0,'C',true);
$pdf->Cell(30,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['SSN']),1,0,'C',true);
$pdf->Cell(30,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['name']),1,0,'C',true);
$pdf->Cell(30,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['address']),1,0,'C',true);
$pdf->Cell(20,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['zipcode']),1,0,'C',true);
$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['city']),1,0,'C',true);
$pdf->Cell(20,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['telephone']),1,0,'C',true);
$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['mobile']),1,0,'C',true);
$pdf->Cell(35,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['email']),1,0,'C',true);
$pdf->Cell(25,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['guardian']),1,0,'C',true);
$pdf->Cell(30,5,iconv("UTF-8", "windows-1252",$smarty->localise->contents['relatives']),1,1,'C',true);
			

 
/*
$header = array($smarty->localise->contents['number'],$smarty->localise->contents['SSN'],$smarty->localise->contents['name'],$smarty->localise->contents['address'],$smarty->localise->contents['zipcode'],$smarty->localise->contents['city'],$smarty->localise->contents['telephone'],$smarty->localise->contents['mobile'],$smarty->localise->contents['email'],$smarty->localise->contents['relatives'],$smarty->localise->contents['guardian']);

$pdf->FancyTable($header,$employees);
//$pdf->ImprovedTable($header,$employees);
$pdf->Output();
exit;*/



if($tot > 0)
{
	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	for($i=0;$i<$div;$i++)	
	{
		if($i == 0)
		{
			$show = 'style="display:block;"';
		}
		else
		{
			$show = 'style="display:none;"';	
		}
			
		if($tot == ($falg+1))
		{
			$last = $tot;	
		}
		else
		{
			$last = $falg+10 ;
		}
		
		if($div == ($i+1))
		{
			$last = $tot;
		}
		/*echo '<span style="margin:4px 0 3px 10px; float:left;">'.($falg+1).' to '.$last.' out of  '.$tot.'</span>';	
		//(Englishword - swedis word) (Employee - anställd) (customer - kund) 
		*/
	
		for($j=0;$j<10;$j++)	
		{
			/*print_r($employees[$falg]);
			exit;*/			
			$username = $employees[$falg]['username'];
			$lastname = $employees[$falg]['last_name'];
			$firstname = $employees[$falg]['first_name'];
			$ssn = $employees[$falg]['social_security'];
			$city = $employees[$falg]['city'];
			$phone = $employees[$falg]['phone'];
			$mobile = $employees[$falg]['mobile'];
			$status = $employees[$falg]['status'];
			$email = $employees[$falg]['email'];
			$address = $employees[$falg]['address'];
			$code = $employees[$falg]['code'];	
			$post = $employees[$falg]['post'];	
			
			$usernm = $employees[$falg]['username'];
			
			$relatives = $employee->customer_getrelatives($username);
			$gardians = $employee->customer_getgardins($username);
			/*echo "<pre>";
			print_r($gardians);	*/		
			
			
			
			$relcnt = count($relatives);
			$relarray = '';
			//echo "<pre>";
			if($relcnt)
			{
				for($e=0;$e<$relcnt;$e++)
				{
					if($relatives[$e]['mobile'] != '')
					{
						$mynumber = $relatives[$e]['mobile'];	
					}
					elseif($relatives[$e]['phone'] != '')
					{
						$mynumber = $relatives[$e]['phone'];
					}
					else
					{
						$mynumber = '';	
					}
			
					//print_r($relatives[$e]);
					if($e == 0)
					{
						$relarray .= $relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];	
					}
					else
					{
						$relarray .= ', '.$relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];			
					}
				}
			}
			else
			{
				$relarray = '--';
			}
			
			if(count($gardians)>0)
			{
				$guardianstr = $gardians[0]['first_name'].'  '.$gardians[0]['last_name'].'  '.$gardians[0]['mobile'].' '.$gardians[0]['email'];
			}
			else
			{
				$guardianstr = 	'--';
			}
			
			if($username != $usernm)
			{
				$username = $usernm;	
			}
			//echo $usernm;
			if($tot >= $falg+1)
			{
				
				$style = '';
				if($status == 0)
				{
					//$style = 'style="color:red;margin:2px;padding:2px;"';
					$pdf->SetTextColor(255,0,0);
				}
				else
				{
					//$style = 'style="margin:2px;padding:2px;"';
					$pdf->SetTextColor(0);
				}
				
				if($j%2 == 0 || $j == 0)
				{
					$pdf->SetFillColor(247,251,251);
				}
				else
				{				
					$pdf->SetFillColor(227,237,240);
				}
				
				//$w = array(15,30,30,30,20,25,20,20,35,30,30);
				
				/*$row_height = 5; // set the default
				// multicell content
				$description = $row['desciption'];
				// get column width from a column widths array
				$column_width = strlen();
				$number_of_lines = ceil( $pdf->GetStringWidth($description) / ($column_width - 1) );
				// I subtracted one from column width as a kind of cell padding
				// height of resulting cell
				$cell_height = 5; 
				$height_of_cell = ceil( $number_of_lines * $cell_height ); 
				// do this again for any other multicell cells (or create a function for more DRY code)
				// and compare the cell_height with the row_height
				if ( $cell_height > $row_height ) {
				  $row_height = $cell_height;
				}*/
			

				
				$pdf->Cell(15,5,iconv("UTF-8", "windows-1252", $code),1,0,'C',true);
				$pdf->Cell(30,5,$ssn,1,0,'C',true);
				$pdf->Cell(30,5,iconv("UTF-8", "windows-1252", $lastname.', '.$firstname),1,0,'C',true);
				$pdf->Cell(30,5,iconv("UTF-8", "windows-1252", $address),1,0,'C',true);
				$pdf->Cell(20,5,iconv("UTF-8", "windows-1252", $post),1,0,'C',true);
				$pdf->Cell(25,5,iconv("UTF-8", "windows-1252", $city),1,0,'C',true);
				
				$pdf->Cell(20,5,$phone,1,0,'C',true);
				$pdf->Cell(25,5,$mobile,1,0,'C',true);
				$pdf->Cell(35,5,iconv("UTF-8", "windows-1252", $email),1,0,'L',true);					
				$current_y = $pdf->GetY();
				$current_x = $pdf->GetX();				
				$cell_width = 30;
				//MultiCell($cell_width, 1, "abcd", currentBorders, Alignment.LEFT, false);			
				//$current_x = $pdf->GetX();
				//MultiCell($cell_width, 1, "abcd", currentBorders, Alignment.LEFT, false);		
				$pdf->MultiCell(25,5,iconv("UTF-8", "windows-1252", $relarray),1,'L',true);
				$pdf->SetXY($current_x + $cell_width, $current_y);
				$pdf->MultiCell(30,5,iconv("UTF-8", "windows-1252", $guardianstr),1,'L',true);
				//$pdf->MultiCell(70,5,iconv("UTF-8", "windows-1252", $email),1,1,'C',true);
				//function myMultiCell($w, $h, $txt, $border=0, $align='J', $fill=false)
				//$pdf->Ln();
			}
			$falg++;
		}
		$pdf->Output();
		exit;
		
		
		$Grandtotworkinghrs = 0;
		/*$pdf->Output();
		exit;*/
	}
	$pdf->Output('Customers_Data.pdf','D');
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