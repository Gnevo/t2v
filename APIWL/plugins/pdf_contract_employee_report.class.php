<?php
require_once('./plugins/F_pdf.class.php');
require_once('./class/setup.php');
require_once('./configs/config.inc.php');

class PDF_contract_report extends FPDF {

	var $contract_details = '';
 
	function __construct(){
		parent::__construct();
		$this->smarty = new smartySetup(array( "messages.xml","month.xml","button.xml", "user.xml","reports.xml","contract.xml"),FALSE);

		$this->AliasNbPages();
	}

	function main_part(){
		$this->SetFont('Arial', 'B', 15);
		$this->setXY(70,5);
		$this->Cell(80,10,utf8_decode($this->smarty->translate['Contract_Employee_List']), 0, 0, 'C', FALSE);

		$this->SetFont('Arial', '', 11); // table_heading
		$this->setXY(20,20);
		$this->Cell(15,10,utf8_decode($this->smarty->translate['serial_no']), 1, 0, 'C', FALSE);
		$this->Cell(75,10,utf8_decode($this->smarty->translate['employee']), 1,$this->contract_details['without_contract'] ? 1 : 0, 'C', FALSE);
		if($this->contract_details['expired_contract'] || $this->contract_details['active_contract']){
			$this->Cell(45,10,utf8_decode($this->smarty->translate['Contract_Start_Date']), 1, 0, 'C', FALSE);
			$this->Cell(45,10,utf8_decode($this->smarty->translate['Contract_Expiry_Date']), 1, 1, 'C', FALSE);
		}

		// table_body_content
		$this->SetFont('Arial', '', 9);
		
		if($this->contract_details['expired_contract']){ // expired_contract_details
			foreach ($this->contract_details['expired_contract'] as $key => $expired_contract) {
				$this->setX(20);
				$this->Cell(15,7,utf8_decode($key+1), 1, 0, 'C', FALSE);
				foreach ($expired_contract as $key2 => $value) {
					$key2 == 'emp_name'? $wi = 75 : $wi = 45 ;
					$this->Cell($wi,7,utf8_decode($value), 1, $key2 == 'contract_expiry_date' ? 1 : 0, 'C', FALSE);
				}
			}
		}

		if($this->contract_details['active_contract']){ // active_contract_details
			$i = 1;
			foreach ($this->contract_details['active_contract'] as $key => $active_contract) {
					$this->setX(20);
				foreach ($active_contract as $key2 => $value) {
					if($key2 == 'emp_name'){
						if($value != $old_value){

							$this->Cell(15,7*$active_contract['count'],utf8_decode($i++), 1, 0, 'C', 0);
							$this->Cell(75,7*$active_contract['count'],utf8_decode($value), 1, 0, 'C', FALSE);
							$old_value = $value;
						}
						else{
							$this->Cell(15,7,'', 0, 0, 'C', FALSE);
							$this->Cell(75,7,'', 0, 0, 'C', FALSE);
						}
					}
					else{
						$this->Cell(45,7,utf8_decode($value), 1, $key2 == 'contract_expiry_date' ? 1 : 0, 'C', FALSE);
						if($key2 == 'contract_expiry_date') break;	
					}
				}
			}
		}

		if($this->contract_details['without_contract']){ // without_contract_details
			foreach ($this->contract_details['without_contract'] as $key => $without_contract) {
					$this->setX(20);
					$this->Cell(15,7,utf8_decode($key+1), 1, 0, 'C', FALSE);
				foreach ($without_contract as $key2 => $value) {
					$key2 == 'emp_name'? $wi = 75 : $wi = 45 ;
					$this->Cell($wi,7,utf8_decode($value), 1, $key2 == 'emp_name' ? 1 : 0, 'C', FALSE);
				}
			}
		}



	}

	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 10, $this->smarty->translate['page_no'] . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}
?>