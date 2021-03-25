<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');
require_once('class/dona.php');
require_once('class/contract.php');

class Note_pdf_genarator extends FPDI{
        
    var $y_value_descr = '';

    function __construct() {

        parent::__construct();
        //$this->k=2;
		$this->smarty = new smartySetup(array("messages.xml","month.xml","button.xml", "customer.xml", "notes.xml", "reports.xml"));
		$this->AliasNbPages();

    }


    function heading($company_details){
    	if($company_details['logo'] != ''){
            $this->Image($preference['url'].'company_logo/'.$company_details['logo'], 30, 5, 30);
//            $this->Ln();
        }
        $this->SetXY(10, 15);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(170, 6, utf8_decode($company_details['name']), 0, 1, 'R');
    }

    function part1($notes_detail){
    	$visibility = array('',$this->smarty->translate['public'],$this->smarty->translate['private'],$this->smarty->translate['all'],$this->smarty->translate['admin_only']);
    	$status  	= array($this->smarty->translate['forbidden'],$this->smarty->translate['active']);
    	$this->SetFont('Arial', '', 9);                                      //     Arbetstagarens efternamn 
        $this->SetXY(15,40);
        	$this->Cell(50, 8, utf8_decode($this->smarty->translate['writer']), 1, 0, 'L', FALSE);
        	$this->Cell(130, 8, utf8_decode($notes_detail['emp_name']), 1, 0, 'L', FALSE);
        $this->SetXY(15,48);
        	$this->Cell(50, 8, utf8_decode($this->smarty->translate['customer']), 1, 0, 'L', FALSE);
        	$this->Cell(130, 8, utf8_decode($notes_detail['customer_name']), 1, 0, 'L', FALSE);
        $this->SetXY(15,56);
        	$this->Cell(50, 8, utf8_decode($this->smarty->translate['title']), 1, 0, 'L', FALSE);
        	$this->Cell(130, 8, utf8_decode($notes_detail['title']), 1, 0, 'L', FALSE);
        $this->SetXY(15,64);
        	$this->Cell(50, 8, utf8_decode($this->smarty->translate['date_written']), 1, 0, 'L', FALSE);
        	$this->Cell(130, 8, utf8_decode($notes_detail['date']), 1, 0, 'L', FALSE);
        $this->SetXY(15,72);
        	$this->Cell(50, 8, utf8_decode($this->smarty->translate['visibility']), 1, 0, 'L', FALSE);
        	$this->Cell(130, 8, utf8_decode($visibility[$notes_detail['visibility']]), 1, 0, 'L', FALSE);
        $this->SetXY(15,80);
        	$this->Cell(50, 8, utf8_decode($this->smarty->translate['status']), 1, 0, 'L', FALSE);
        	$this->Cell(130, 8, utf8_decode($status[$notes_detail['status']]), 1, 0, 'L', FALSE);
        $this->SetXY(65,88);
        	$this->MultiCell(130, 8, utf8_decode($notes_detail['attachment'])? $notes_detail['attachment'] :$this->smarty->translate['no_attachment'], 1);
            $y_value             = $this->GetY()-88;
            $this->y_value_descr = $this->GetY()+8;
        $this->SetXY(15,88);
            $this->Cell(50, $y_value, utf8_decode($this->smarty->translate['attachments']), 1, 0, 'L', FALSE);
            // $this->MultiCell(180, 5, utf8_decode($notes_detail['description']),0);
            // echo $y_value_descr;
	        // 
    }

    function description($notes_detail){
    	
        // echo $this->y_value_descr;
    	// var_dump($this->AliasNbPages());

    	// exit();
    	$this->SetXY(15,$this->y_value_descr);
    	$this->SetFont('Arial', '', 12); 
    	$this->Cell(170, 8, utf8_decode($this->smarty->translate['discription']), 0, 0, 'C', FALSE);
    	$this->line(15,$this->GetY()+8,195,$this->GetY()+8);
    	$this->SetXY(15,$this->GetY()+10);
    	$this->SetFont('Arial', '', 9); 
    	// $this->InFooter = false;
    	$this->MultiCell(180, 5, utf8_decode($notes_detail['description']),0);

    }

 //    function Header(){
 //    	// $total_page[] = 1;
 //    	// $total_page = 1;
 //        // var_dump($total_page);
 //    	// exit();
 //    	// $total_page++;

 //    	if($this->PageNo() == 1){
 //    	}
 //    	else{
 //    		$this->line(15,10,195,10);
 //    	}
	// }

	// function a($a,$count){
	// 	// $a = 10;
	// 	static $count = 1;
	// 	array_push($a,$count++);
	// 	// $a++;
	// 	return $a;
	// }

    function Footer(){
    	// echo $this->AliasNbPages();
    	// echo $this->InFooter;
    	// echo count($total_page);
    	// echo $this->InFooter;
    	// static $a = array();
    	// static $count = 0;
    	// $a = $this->a($a);
    	// var_dump($a);
    	// echo  $this->PageNo();
    	// echo end($a);
    	// $this->AliasNbPages();
    	//echo $this->PageNo().'/{nb}';
    	// if($this->PageNo() == '{nb}' ){

    	// }
    	// else{
    	// 	 //$this->line(15,276,195,276);
    	// }
    	// global $total_page;
    	// if($this->PageNo() == $tota)
    	// var_dump( $total_page);
    	// $total_page = $this->totalpage();
    	// echo $total_page;
    	// exit();
    	// echo $total_page;
    	// exit();
    	// Position at 1.5 cm from bottom
    	$this->SetY(-15);
    	// Arial italic 8
    	$this->SetFont('Arial','I',8);
    	// Page number
    	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

	}
	// $aa = new Note_pdf_genarator(); 
	// $this->Output();
}

?>