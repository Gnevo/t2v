<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_insurance extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
        //$this->k=2;
        $this->smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml","month.xml","common.xml","privilege.xml"), FALSE);
    }

    function Header(){
        $this->AliasNbPages();
        $this->SetXY(10,1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(195, 10, $this->PageNo() . ' ({nb})', 0, 0, 'R');
        $this->SetXY(10,15);
    }
    
    function report_header($company_details){
        global $preference;
        
        if($company_details['logo'] != ''){
            $this->Image($preference['url'].'company_logo/'.$company_details['logo'], 10, 10, 30);
        }
        
        $this->SetXY(10, 20);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(190, 6, utf8_decode($company_details['name']), 0, 1, 'R');
        $this->Ln(0.5);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 6, utf8_decode($preference['app_version']), 0, 1, 'R');
            
        $this->SetXY(10, 40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['equipment']), '', 1, 'C');
        $this->Ln(7);
    }
    
    function customer_personal_info($customer_details) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['personal_information']), 1, 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['social_security']), 'L', 0, 'L');//Personnummer
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['code']), 'L', 0, 'L');         //Anst.nr
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['username']), 'LR', 1, 'L');    //Användarnamn

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_details['social_security']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($customer_details['code']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($customer_details['username']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');   //Förnamn
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['last_name']), 'L', 0, 'L');    //Efternamn
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['address']), 'LR', 1, 'L');     //Adress
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($customer_details['first_name']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['last_name']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['address']), 'LBR', 1, 'L');


        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 6, utf8_decode($this->smarty->translate['city']), 'L', 0, 'L'); //Ort
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['post']), 'L', 0, 'L'); //Postnr
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['phone']), 'LR', 1, 'L');//Telefon
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($customer_details['city']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['post']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['phone']), 'LBR', 1, 'L');


        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 6, utf8_decode($this->smarty->translate['mobile']), 'L', 0, 'L');   //Mobil
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['email']), 'L', 0, 'L');    //E-post
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['date']), 'LR', 1, 'L');    //Tillträdes dag
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($customer_details['mobile']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['email']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['date']), 'LBR', 1, 'L');
        $this->Ln(7);
    }

    function customer_equipment($equipment_issues, $year, $month_txt) {

        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 6, utf8_decode($this->smarty->translate['year']), 'TL', 0, 'L');
        $this->Cell(95, 6, utf8_decode($this->smarty->translate['month']), 'TLR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(95, 6, utf8_decode($year), 'LB', 0, 'L');
        $this->Cell(95, 6, utf8_decode($month_txt), 'LBR', 1, 'L');


        $this->SetFont('Arial', 'B', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['equipment']), 'LB', 0, 'L');
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['serial_number']), 'LB', 0, 'L');
        $this->Cell(35, 4, utf8_decode($this->smarty->translate['issue_date']), 'LB', 0, 'L');
        $this->Cell(35, 4, utf8_decode($this->smarty->translate['return_date']), 'LRB', 1, 'L');


        $this->SetFont('Arial', '', 9);
        foreach ($equipment_issues as $equipment) {
            $this->Cell(60, 4, utf8_decode($equipment['equipment']), 'LB', 0, 'L');
            $this->Cell(60, 4, utf8_decode($equipment['serial_number']), 'LB', 0, 'L');
            $this->Cell(35, 4, utf8_decode($equipment['issue_date']), 'LB', 0, 'L');
            $this->Cell(35, 4, utf8_decode($equipment['return_date']), 'LRB', 1, 'L');
        }
        
//        $this->custom_footer();
    }
    
    function footer(){
        global $preference;
        
//        $this->Ln(5);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_on'].': '.date('Y-m-d H:i:s')), 0, 0, 'L');
        $this->setX(10);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_by'].': '.$_SESSION['user_name']), 0, 1, 'R');
        $this->setX(10);
//        $this->Cell(190, 4, utf8_decode('time2view.se - Cirrus'), 0, 1, 'R');
        $this->Cell(190, 4, utf8_decode($preference['url']), 0, 1, 'R');
    }

}

?>