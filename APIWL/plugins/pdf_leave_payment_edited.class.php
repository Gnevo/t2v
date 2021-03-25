<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('./plugins/F_pdf.class.php');
require_once('./class/setup.php');
require_once('./configs/config.inc.php');

class PDF_replacement_employee_report extends FPDF {

	var $relations       = array();
	var $company_details = array();
	var $basic_details   = array();
 
	function __construct(){
		parent::__construct();
		$this->smarty = new smartySetup(array( "gdschema.xml", "user.xml", "messages.xml", "button.xml","month.xml", "forms.xml","reports.xml"),FALSE);

		$this->AliasNbPages();
	}


	function main_part(){
		$translate_month = array('');
		if($this->relations != ''){
			$height = 8;
			// if($this->PageNo()>1){
			// }
			// else{
				$this->SetFont('Arial', 'B', 15);
				$this->setXY(10, 13);
				$this->Cell(190, 10,utf8_decode($this->smarty->translate['replacement_employee_report']), 0, 1, 'C', FALSE);
				if($this->company_details['logo'] != ''){
            		$this->Image($preference['url'].'company_logo/'.$this->company_details['logo'], 15, 29, 70, 30);
       		 	}
				$this->setXY(110,30);
				foreach ($this->basic_details as $key => $value) {
					$this->SetFont('Arial', '', 9);
					$this->setX(130);
					$this->Cell(20,7,utf8_decode($this->smarty->translate[$key]).'  :', 0, 0, 'R', FALSE);
					$this->setX($this->getX());
					$this->SetFont('Arial', 'B', 9);
					$key == 'month' ?  $this->Cell(50,7,utf8_decode($this->smarty->translate[$value]), 0, 1, 'L', FALSE) : $this->Cell(50,7,utf8_decode($value), 0, 1, 'L', FALSE);
					
				}
				$this->setXY(10, 70);
			// }

			$this->SetFont('Arial', 'B', 11);
			$this->Cell(60,$height,utf8_decode('Namn på vikarie'), 1, 0, 'L', FALSE);
			$this->setXY($this->getX(),$this->getY());
			$this->Cell(25,$height,utf8_decode('Datum'), 1, 0, 'C', FALSE);
			$this->setXY($this->getX(),$this->getY());
			$this->Cell(25,$height,utf8_decode('Klockslag'), 1, 0, 'C', FALSE);
			$this->setXY($this->getX(),$this->getY());
			$this->Cell(25,$height,utf8_decode('Löntyp'), 1, 0, 'C', FALSE);
			$this->setXY($this->getX(),$this->getY());
			$this->Cell(25,$height,utf8_decode('Ant tim'), 1, 0, 'R', FALSE);
			$this->setXY($this->getX(),$this->getY());
			$this->Cell(25,$height,utf8_decode('Soc.'), 1, 0, 'C', FALSE);
			// if($this->PageNo() > 1)
			// 	$this->Ln($height);
			
		}

		$this->Ln();
		$this->setXY(10,$this->getY());
		$this->SetFont('Arial', '', 8);
		$needed_array = array('employee','date','time_from','time_to','inconv','tot_time','age');
		foreach ($this->relations as $key => $value) {
			foreach ($needed_array as $key1 => $value1) {
				$new_realtions[$key][$value1] = $this->relations[$key][$needed_array[$key1]]; 
			}
		}

		foreach ($new_realtions as $key1 => $single_relation) {
				foreach ($single_relation as $key2 => $value) {
					// if($this->PageNo() > 1 &&) ;
					if ($key2 == 'employee')
						$this->Cell(60,8,utf8_decode($value), 1, 0, 'L', FALSE);
					else if ($key2 == 'time_from')
						$this->Cell(25,8,$single_relation['time_from'].'-'.$single_relation['time_to'], 1, 0, 'C', FALSE);
					else if ($key2 == 'time_to') $a;
					else if ($key2 == 'age'){
						if ($value < 25) $age_value = 31.42;
						else if($value <65) $age_value = 31.42;
						else if($value>=65) $age_value = 16.36;
					$this->Cell(25,8,$age_value, 1, 0, 'C', FALSE);
					}

					else
						$this->Cell(25,8,$value, 1, 0, $key2 == 'tot_time' ? 'R': 'C', FALSE);
				}
				$this->Ln();
		}
		$this->Cell(60,8,$this->smarty->translate['total'], 1, 0, 'L', FALSE);
		$this->Cell(75,8,'', 1, 0, 'C', FALSE);
		$this->Cell(25,8,$this->tot_time_sum, 1, 0, 'R', FALSE);
		$this->Cell(25,8,'', 1, 0, 'C', FALSE);
	}

	function no_data_avialable(){
		// var_dump('dsfsdfsdf');
		$this->SetFont('Arial', 'B', 15);
		$this->setXY(65,50);
		$this->Cell(80,20,utf8_decode($this->smarty->translate['no_work_data_available']), 0, 0, 'C', FALSE);
		// $this->Cell(40,10,'Hello World !',1);
	}

	function Footer() {
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		//Page number
		$this->Cell(0, 10, $this->smarty->translate['page_no'] . $this->PageNo() . '/{nb}', 0, 0, 'C');
	} 
    
}
?>