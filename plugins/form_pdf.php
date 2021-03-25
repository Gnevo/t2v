<?php
/**
* Author: Shamsudheen <shamsu@arioninfotech.com>
* for: FKKN customer work report
*/

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_form extends FPDI {
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->SetTitle('Forms');
        $this->SetAutoPageBreak(FALSE);
    }



    function Footer() {
        /*$this->AliasNbPages();
        $this->SetY(-15);
        $this->SetFont('Arial', '', 6);
        $this->SetX(-25);
        $this->Cell(10, 10, $this->PageNo() . '/{nb}', 0, 0, 'C');*/
    }
    
    function Header(){
        /*$this->AliasNbPages();
        $this->SetXY(-25,8);
        $this->SetFont('Arial', '', 9);
        $this->Cell(10, 10, $this->PageNo() . ' ({nb})', 0, 0, 'C');*/
    }   

}

class PDF_customer_form extends FPDI {

    var $company;
    var $date;
    var $check_r;
    var $check_s;
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->SetTitle('Forms');
        $this->SetAutoPageBreak(TRUE, 18);
    }

    function Footer() {
        $this->SetFont('Arial', '', 10);
        $this->setY(-15);
        $starty = $this->GetY();
        $this->SetX(10);
        $this->Cell(8, 6, 'R', 0, 0, 'C', FALSE);
        $this->Cell(8, 6, 'S', 0, 0, 'C', FALSE);
        $this->SetX(26);
        $this->Cell(100, 6, utf8_decode('Dokumentet skapat ' . date('Y-m-d', strtotime($this->date))), 0, 1, 'L', FALSE);
        $this->setY($this->GetY());
        $this->SetX(10);
        $this->Cell(8, 6, ($this->check_r == 1 ? 'X' : '[]'), 0, 0, 'C', FALSE);
        $this->Cell(8, 6, ($this->check_s == 1 ? 'X' : '[]'), 0, 1, 'C', FALSE);
        $endy = $this->GetY();
        $this->SetLineWidth(0.2);
        $this->Line(10, $starty, 25, $starty);
        $this->Line(10, $starty, 10, $endy);
        $this->Line(25, $starty, 25, $endy);
        $this->Line(10, $endy , 25, $endy);

        $this->AliasNbPages();
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->SetX(-25);
        $this->Cell(10, 10, 'Sida ' . $this->PageNo() . ' av ' . '{nb}', 0, 0, 'C');
    }
    
    function Header(){
        //$this->SetFillColor(255, 255, 255);
        //$this->SetTextColor(0, 50, 50);
        $this->SetFont('Arial', '', 16);
        $this->setY(10);
        $this->SetX(10);
        $this->Cell(95, 10, utf8_decode('Genomförandeplan - myndig'), 1, 0, 'L', FALSE);
        $this->SetX(105);
        $this->Cell(95, 10, utf8_decode($this->company), 1, 1, 'L', FALSE);
    }   

}
?>