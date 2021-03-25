<?php
require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Emp_test extends FPDI     //FPDF
{

function __construct() {

    parent::__construct();
    //$this->k=2;
}
function Pl_header($emp_details){

    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);

    $this->SetFont('Times','B',16);                          
    $this->SetXY(70, 10);
    $this->Cell(65,8   ,utf8_decode('Information om anställda'),0,0,'R',FALSE);   
    // $this->line(0, 5, 250, 5);

    $this->SetFont('Times','B',10);
    $this->SetXY(105, 0);
    $this->Cell(50,6 ,utf8_decode('www.arioninfotech.com'),0,0,'R',FALSE, 'www.arioninfotech.com');  
    // $this->link(118, 0, 37, 5,'http://www.arioninfotech.com');
    $this->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',10,5,30,30,'PNG');
    $this->Ln(10);

}
function P1_mid_left($emp_details)
{
    
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);

    $this->SetFont('Times','B',16);                          
    $this->SetXY(10,  50);
    $this->Cell(65,30   ,utf8_decode(''),0,0,'C',FALSE);

    $this->SetFont('Times','B',12);                          
    $this->SetXY(10, 40);
    $this->Cell(65,30   ,utf8_decode('Name:     ................................................................................'),0,1,'L',FALSE);
    $this->SetXY(10, 50);
    $this->Cell(65,30  ,utf8_decode('Age:     ................................................................................'),0,0,'L',FALSE);
    $this->SetXY(10, 60);
    $this->Cell(65,30  ,utf8_decode('D-O-B:     ................................................................................'),0,0,'L',FALSE);
    $this->SetXY(10, 70);
    $this->Cell(65,30  ,utf8_decode('Address:     ................................................................................'),0,0,'L',FALSE);
    $this->SetXY(10, 80);
    $this->Cell(65,30  ,utf8_decode('Email:     ................................................................................'),0,0,'L',FALSE);
}
function Pl_right(){
    $this->SetFont('Times','',10);                          
    $this->SetXY(120,  50);
    $string='The goal of this script is to show how to build a table from MultiCells. As MultiCells go to the next line after being output, the base idea consists in saving the current position, the .';
    $this->MultiCell(65,10 ,$string,0,j,FALSE);

}
function P1_photo($emp_details)
{
    
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);

    $this->SetFont('Times','B',16);                          
    $this->SetXY(160,  10);
    $this->Cell(35, 35  ,utf8_decode('Paste Photo'),1,0,'c',FALSE);   
    // $this->Ln(7);
}
function P1_sign(){
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);
    $this->SetFont('Times','B',10);                          
    $this->SetXY(150,  110);
    $this->Write(0,  'Your Faithfully');
    $this->line(0, 120, 250, 120);


}


}


?>
