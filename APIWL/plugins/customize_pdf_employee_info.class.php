<?php
require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Emp_info extends FPDI     //FPDF
{

function __construct() {

    parent::__construct();
    //$this->k=2;
}

function P1_top($emp_details)
{
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);

    
                //row 1
    $this->SetFont('Times','B',16);                           //Den assistansberättigades namn
    $this->SetXY(22,  $this->GetY()+8);
    $this->Cell(178,5,utf8_decode('Information om anställda'),0,0,'R',FALSE);     
        
    $this->SetXY(10,  $this->GetY()+20);
    $this->Cell(50,10,'',1,0,'L',FALSE);         //set border    
    $this->Cell(140,10,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','',8);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(50,4,utf8_decode('35.00125Personnummer'),0,0,'L',FALSE); 
    $this->Cell(140,4,utf8_decode('Anställningsnr'),0,0,'L',FALSE); 
    
    $this->SetFont('Arial','',12);                           
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(50,5,utf8_decode($emp_details['social_security']),0,0,'L',FALSE);       //personal number
    $this->Cell(140,5,utf8_decode($emp_details['code']),0,0,'L',FALSE);      //Anställningsnr

    $this->Ln(7);
}

function P1_table_2($emp_details)
{
    
                //row 1
    $this->SetXY(10,  $this->GetY());
    $this->Cell(50,10,'',1,0,'L',FALSE);         //set border    
    $this->Cell(140,10,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','',8);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(50,4,utf8_decode('FFörnamn'),0,0,'L',FALSE); 
    $this->Cell(140,4,utf8_decode('Efternamn'),0,0,'L',FALSE); 
    
    $this->SetFont('Arial','',12);                           
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(50,5,utf8_decode($emp_details['first_name']),0,0,'L',FALSE);       //FFörnamn
    $this->Cell(140,5,utf8_decode($emp_details['last_name']),0,0,'L',FALSE);      //Efternamn
    
                //row 2
    $this->SetXY(10,  $this->GetY()+5); 
    $this->Cell(190,10,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','',8);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(190,4,utf8_decode('Address'),0,0,'L',FALSE); 
    
    $this->SetFont('Arial','',12);                           
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(190,5,utf8_decode($emp_details['address']),0,0,'L',FALSE);      //Address
    
    
                //row 3
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(50,10,'',1,0,'L',FALSE);         //set border    
    $this->Cell(140,10,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','',8);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(50,4,utf8_decode('Ort'),0,0,'L',FALSE); 
    $this->Cell(140,4,utf8_decode('Postnummer'),0,0,'L',FALSE); 
    
    $this->SetFont('Arial','',12);                           
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(50,5,utf8_decode($emp_details['city']),0,0,'L',FALSE);       //Ort
    $this->Cell(140,5,utf8_decode($emp_details['post']),0,0,'L',FALSE);      //Postnummer
    
    
                //row 4
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(50,10,'',1,0,'L',FALSE);         //set border    
    $this->Cell(140,10,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','',8);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(50,4,utf8_decode('Telefon'),0,0,'L',FALSE); 
    $this->Cell(140,4,utf8_decode('Mobil'),0,0,'L',FALSE); 
    
    $this->SetFont('Arial','',12);                           
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(50,5,utf8_decode($emp_details['phone']),0,0,'L',FALSE);       //Telefon
    $this->Cell(140,5,utf8_decode($emp_details['mobile']),0,0,'L',FALSE);      //Mobil
    
        
                //row 5
    $this->SetXY(10,  $this->GetY()+5); 
    $this->Cell(190,10,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','',8);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(190,4,utf8_decode('E-post'),0,0,'L',FALSE); 
    
    $this->SetFont('Arial','',12);                           
    $this->SetXY(10,  $this->GetY()+5);
    $this->Cell(190,5,utf8_decode($emp_details['email']),0,0,'L',FALSE);      //E-post
    
    $this->Ln(7);
}

function P1_table_3($skills)
{
        
                //row 1
    $this->SetXY(10,  $this->GetY()); 
    $this->Cell(190,5,'',1,0,'L',FALSE);        //set border    
    
    $this->SetFont('Arial','B',12);                           
    $this->SetXY(10,  $this->GetY());
    $this->Cell(190,5,utf8_decode('Kompetens'),1,0,'L',FALSE); 
    
    
                //row 2
    $this->SetXY(10,  $this->GetY()+5); 
    foreach($skills as $entry)
    {
        //$this->Cell(190,10,'',1,0,'L',FALSE);        //set border    
        $y_top = $this->GetY();
        $this->SetFont('Arial','B',9);                           
        $this->SetXY(10,  $this->GetY());
        $this->Cell(190,4,utf8_decode($entry['skill']),0,0,'L',FALSE); 

        $this->SetFont('Arial','',10);                           
        $this->SetXY(10,  $this->GetY()+5);
        $this->MultiCell(190,3,utf8_decode($entry['description']));      //Address
        
        $this->Rect(10, $y_top, 190, $this->y - $y_top + 3);
        $this->Ln(3);
    }
    $this->Ln(7);
}


}


?>
