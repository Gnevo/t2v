<?php
require_once('./plugins/F_pdf.class.php');

class PDF extends FPDF
{

// Colored table
function FancyTable($header, $data,$total_cap)
{
    // Colors, line width and bold font
    $this->SetX(12.5);
    //$this->SetFillColor(232,235,255);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.2);
    $this->SetFont('Arial','B',8); 
    // Header
    $w = array(25, 25, 35, 25, 25, 25, 25);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    //$this->SetFont('');
    $this->SetFont('Arial','B',6);
    // Data
    $fill = false;
    $n_total=0;
    $t_total=0;
    $b_total=0;
    $total=0;
    foreach($data as $row)
    {
        $this->SetX(12.5);
        $normal = ($row[5]!="")?$row[5]:0;
        $travel = ($row[6]!="")?$row[6]:0;
        $break = ($row[7]!="")?$row[7]:0;
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[4],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$normal,'LR',0,'R',$fill);
        $this->Cell($w[4],6,$travel,'LR',0,'R',$fill);
        $this->Cell($w[5],6,$break,'LR',0,'R',$fill);
        $column_total=$normal+$travel+$break;
        $this->Cell($w[6],6,$column_total,'LR',0,'R',$fill);
        $this->Ln();
        
        //$fill = !$fill;
        $n_total=$n_total+$row[5];
        $t_total=$t_total+$row[6];
        $b_total=$b_total+$row[7];
        $total=$total+$column_total;
    }
    // Closing line
    //$this->Cell(array_sum($w),0,'','T');
    $fill = false;
    $this->SetFont('Arial','B',7.5);
    $this->SetX(12.5);
    $this->Cell($w[0],6,$total_cap,'LTB',0,'L',$fill);
    $this->Cell($w[1],6,'','TB',0,'R',$fill);
    $this->Cell($w[2],6,'','TB',0,'R',$fill);
    $this->Cell($w[3],6,$n_total,'LRTB',0,'R',$fill);
    $this->Cell($w[4],6,$t_total,'LRTB',0,'R',$fill);
    $this->Cell($w[5],6,$b_total,'LRTB',0,'R',$fill);
    $this->Cell($w[6],6,$total,'LRTB',0,'R',$fill);
    //$this->Ln();
    //$this->Cell(array_sum($w),0,'','T');
}

function report_Header($title)
{
    $this->SetFont('Times','UB',12.5);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);
    $this->Cell($w,9,$title,0,1,'C',true);
    $this->Ln(7);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function SubHeading($sub_head,$cust_name,$month,$year)
{

    $this->SetFont('Times','B',9);
    $this->SetX(12);
    $this->Cell(35,5,$sub_head.': '.$cust_name,0,0,'L',true);
    $this->SetX(-15-($this->GetStringWidth($month. ', '. $year)));
    $this->Cell(25,5,$month. ', '. $year,0,0,'L',true);
    $this->Ln();
}

function Footer()
{
    // Page footer
    $this->SetY(-15);
    $this->SetFont('Arial','',5);
    $this->SetTextColor(128);
    $this->Cell(30,10,date("F d, Y h:i:s A"),0,0,'C');
    $this->SetX(-15);
    //$this->SetX(105);
    $this->Cell(10,10,$this->PageNo(),0,0,'C');
}

function SetCol($col)
{
    // Set position at a given column
    $this->col = $col;
    $x = 10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}
}


?>
