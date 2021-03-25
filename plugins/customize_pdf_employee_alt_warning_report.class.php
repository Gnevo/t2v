<?php

require_once('./plugins/F_pdf.class.php');
require_once('class/setup.php');
//require_once('./plugins/fpdi/fpdi.php');
//FPDI
class PDF_employee_atl_warning_report extends FPDF     { //FPDF
    
    var $report_month = '';
    var $report_year = '';
    var $report_customer = '';

    var $rpt_contents = array();
    var $rpt_sum = array();
    
    function __construct($orientation) {
//        echo $orientation;
        parent::__construct($orientation);
        $this->FPDF($orientation);
        //$this->k=2;
    }

    function P1_Part1($month,$year) {
        $smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml",'reports.xml'),FALSE);
        $year = $this->report_year;
        $month = $this->report_month;
        
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 15);     
        $this->SetXY(10, $this->GetY()+ 5);
        $this->Cell(180, 5, utf8_decode($smarty->translate['atl_warning']), 0, 0, 'C', FALSE);
        
        $this->SetXY(10, $this->GetY()+10);


        $this->Ln();
    }

    function P1_Part2() {
        
        $smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml",'reports.xml'),FALSE);
        $y_val = $this->GetY();
        $this->SetFont('Arial','B',12);
        $this->SetXY(18,  $y_val);
        $this->Cell(40, 8,utf8_decode($smarty->translate[date]),1,1,'C',FALSE);
        
//        echo $this->GetX();
        $this->SetXY($this->GetX()+48,  $y_val);
        $this->Cell(52, 8,utf8_decode($smarty->translate[name]),1,1,'C',FALSE);
        $this->SetXY($this->GetX()+100,  $y_val);
        $this->Cell(40, 8,utf8_decode($smarty->translate[time_from]),1,1,'C',FALSE);
        $this->SetXY($this->GetX()+140,  $y_val);
        $this->Cell(40, 8,utf8_decode($smarty->translate[time_to]),1,1,'C',FALSE);
        $y_val = $y_val + 8;
        foreach($this->rpt_contents as $report){
            
            $this->SetXY(18,  $y_val);
            $this->SetFont('Arial','',10);
            $this->Cell(40, 6,utf8_decode($report['date']),1,1,'C',FALSE);
//        echo $this->GetX();
            $this->SetXY($this->GetX()+48,  $y_val);
            $this->Cell(52, 6,utf8_decode($report['last_name']." ".$report['first_name']),1,1,'C',FALSE);
            $this->SetXY($this->GetX()+100,  $y_val);
            $this->Cell(40, 6,utf8_decode($report['time_from']),1,1,'C',FALSE);
            $this->SetXY($this->GetX()+140,  $y_val);
            $this->Cell(40, 6,utf8_decode($report['time_to']),1,1,'C',FALSE);
            $y_val = $y_val + 6;
            
            
            if($y_val >= 270){
                $this->AddPage();
                $y_val = 20;
            }
//            $this->Cell($w[0], $current_rh, utf8_decode($emp['name']), 1, 0, 'L', FALSE);
            
        }

    }




    

}

?>
