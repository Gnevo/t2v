<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_employee_termination extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
		$this->smarty = new smartySetup(array("user.xml", "button.xml","month.xml", "forms.xml", 'company.xml','mail.xml','contract.xml'),FALSE);
		$this->AliasNbPages();
    }

    function header(){

    	$this->SetFont('Arial', 'B', 15);
		$this->setXY(70,5);
		$this->Cell(80,10,utf8_decode($this->smarty->translate['employee_termination_form']), 0, 0, 'C', FALSE);
    }

    function employer_details($company_detail){

    	$this->SetFont('Arial', '', 9); 
    	$this->setXY(20,40);
    	$this->Cell(170,10,utf8_decode($company_detail['name']), 0, 0, 'L', FALSE);
    	$this->setXY(20,$this->getY()+9);
    	$this->Cell(120	,10,utf8_decode($company_detail['address']), 0, 0, 'L', FALSE);
    	$this->setXY($this->getX()+10,$this->getY());
		$this->Cell(50	,10,utf8_decode($company_detail['org_no']), 0, 0, 'L', FALSE);
		$this->setXY(20,$this->getY()+9);
		$this->Cell(70	,10,utf8_decode($company_detail['zipcode']), 0, 0, 'L', FALSE);
		$this->setXY(50,$this->getY());
		$this->Cell(100	,10,utf8_decode($company_detail['city']), 0, 0, 'L', FALSE);

    	// var_dump($company_detail	);

  //   	$this->SetFont('Arial', 'B', 11); 
		// $this->setXY(20,30);
		// $this->Cell(30,10,utf8_decode($this->smarty->translate['employer']), 0, 1, 'L', FALSE);

		// $this->SetFont('Arial', '', 9); 
		// $this->setXY(20,$this->getY());
		// // $this->Text(22,$this->getY()+3,'dfdsfsd');
		// $this->Cell(170,10,utf8_decode($this->smarty->translate['company'].': '.$company_detail['name']), 1, 1, 'L', FALSE);
		


		// $this->setXY(20,$this->getY());
		// $this->Cell(120	,10,utf8_decode($this->smarty->translate['address'].': '.$company_detail['address']), 1, 0, 'L', FALSE);
		// $this->Cell(50	,10,utf8_decode($this->smarty->translate['organization_number'].': '.$company_detail['org_no']), 1, 1, 'L', FALSE);
		// $this->setXY(20,$this->getY());
		// $this->Cell(70	,10,utf8_decode($this->smarty->translate['post'].': '.$company_detail['zipcode']), 1, 0, 'L', FALSE);
		// $this->Cell(100	,10,utf8_decode($this->smarty->translate['city'].': '.$company_detail['city']), 1, 0, 'L', FALSE);

    }

    function employee_details($emp_basic_det,$company_detail,$termination_details){
    	$emp_name = $_SESSION['user_role'] == 1 ? $emp_basic_det['first_name'].' '.$emp_basic_det['last_name'] : $emp_basic_det['last_name'].' '.$emp_basic_det['first_name'] ; 
    	$this->setXY(20,$this->getY()+23);
    	$this->Cell(170,10,utf8_decode($emp_name), 0, 0, 'L', FALSE);
    	$this->setXY(20,$this->getY()+9);
    	$this->Cell(110	,10,utf8_decode($emp_basic_det['address']), 0, 0, 'L', FALSE);
    	$this->setXY($this->getX()+20,$this->getY());
		$this->Cell(60	,10,utf8_decode($emp_basic_det['century'].$emp_basic_det['social_security']), 0, 0, 'L', FALSE);
		$this->setXY(20,$this->getY()+9);
		$this->Cell(70	,10,utf8_decode($emp_basic_det['post']), 0, 0, 'L', FALSE);
		$this->setXY(50,$this->getY());
		$this->Cell(100	,10,utf8_decode($emp_basic_det['city']), 0, 0, 'L', FALSE);

		$this->SetFont('Arial', '', 11); 
		$this->Text(110,$this->getY()+34,utf8_decode($company_detail['name']));
		$this->Ln();
		$this->Text(75,$this->getY()+29,utf8_decode($termination_details['date_of_termination']));




    	// $this->SetFont('Arial', 'B', 11); 
		// $this->setXY(20,$this->getY()+20);
		// $this->Cell(30,10,utf8_decode($this->smarty->translate['employee']), 0, 1, 'L', FALSE);

		// $this->SetFont('Arial', '', 9); 
		// $this->setXY(20,$this->getY());
		// // $this->Text(22,$this->getY()+3,'dfdsfsd');
		// $this->Cell(170,10,utf8_decode($this->smarty->translate['name'].': '.$emp_name), 1, 1, 'L', FALSE);
		


		// $this->setXY(20,$this->getY());
		// $this->Cell(110	,10,utf8_decode($this->smarty->translate['address'].': '.$emp_basic_det['address']), 1, 0, 'L', FALSE);
		// $this->Cell(60	,10,utf8_decode($this->smarty->translate['social_security'].': '.$emp_basic_det['century'].'-'.$emp_basic_det['social_security']), 1, 1, 'L', FALSE);
		// $this->setXY(20,$this->getY());
		// $this->Cell(70	,10,utf8_decode($this->smarty->translate['post'].': '.$emp_basic_det['post']), 1, 0, 'L', FALSE);
		// $this->Cell(100	,10,utf8_decode($this->smarty->translate['city'].': '.$emp_basic_det['city']), 1, 1, 'L', FALSE);

		// $this->SetFont('Arial', '', 11); 
		// $this->setXY(20,$this->getY());
		// $this->Text(20,$this->getY()+10,utf8_decode('Härmed säger jag upp mig från min anställning hos:  '.$company_detail['name']));
		// $this->Ln(2);
		// $this->Text(20,$this->getY()+15,utf8_decode('och min sista anställningsdag är:  '.$termination_details['date_of_termination']));


		

    }
    function part1($termination_details,$employer_name,$emp_basic_det){
    	// var_dump($termination_details);
    	$employer_name = $_SESSION['user_role'] == 1 ? $employer_name['first_name'].' '.$employer_name['last_name'] : $employer_name['last_name'].' '.$employer_name['first_name'] ; 
    	$emp_name = $_SESSION['user_role'] == 1 ? $emp_basic_det['first_name'].' '.$emp_basic_det['last_name'] : $emp_basic_det['last_name'].' '.$emp_basic_det['first_name'] ; 

    	$this->SetFont('Arial', '', 9); 
    	$this->setXY(35,171);
    	$this->Cell(30,10,utf8_decode($termination_details['appr_date']), 0, 0, 'L', FALSE);
    	// $this->setX(25);
    	$this->Cell(30,10,utf8_decode(' '.$termination_details['appr_city']), 0, 0, 'L', FALSE);
    	$this->setXY(20,$this->getY()+15);
    	$this->Cell(30,10,utf8_decode($termination_details['appr_date']), 0, 0, 'L', FALSE);
    	$this->setXY(20,$this->getY()+10);
    	$this->Cell(30,10,utf8_decode($employer_name), 0, 0, 'L', FALSE);

    	$this->setXY(130,171);
    	$this->Cell(30,10,utf8_decode($termination_details['date_of_sign']), 0, 0, 'L', FALSE);
    	// $this->setX(25);
    	$this->Cell(30,10,utf8_decode(' '.$termination_details['city']), 0, 0, 'L', FALSE);
    	$this->setXY(115,$this->getY()+15);
    	$this->Cell(30,10,utf8_decode($termination_details['date_of_sign']), 0, 0, 'L', FALSE);
    	$this->setXY(115,$this->getY()+10);
    	$this->Cell(30,10,utf8_decode($emp_name), 0, 0, 'L', FALSE);

    	// $this->setXY(20,$this->getY()+25);
    	// $this->Cell(30,10,utf8_decode($this->smarty->translate['employee']), 0, 0, 'L', FALSE);
    	// $this->setX(110);
    	// $this->Cell(30,10,utf8_decode($this->smarty->translate['employer']), 0, 1, 'L', FALSE);
    	// $this->setXY(20,$this->getY());
    	// $this->Cell(30,10,utf8_decode($termination_details['date_of_sign']), 0, 0, 'L', FALSE);
    	// $this->setX(110);
    	// $this->Cell(30,10,utf8_decode($termination_details['appr_date']), 0, 0, 'L', FALSE);
    }

    function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 10, $this->smarty->translate['page_no'] . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}